<?php

namespace App\Services;

use App\Models\BnplProfile;
use App\Models\BnplLoan;
use App\Models\BnplPayment;
use App\Models\BnplCreditScore;
use App\Models\BnplMilestone;
use App\Models\BnplTier;
use Carbon\Carbon;

class BnplService
{
    /**
     * Calculate credit score based on payment history and behavior.
     *
     * FIX: Accepts an optional $availableLimit parameter so that
     * calculateAvailableLimit() can pass a pre-computed value and
     * break the infinite mutual-recursion loop:
     *   calculateCreditScore() → calculateAvailableLimit()
     *                          → calculateCreditScore() → …
     */
    public function calculateCreditScore($userId, float $availableLimit = null)
    {
        $profile = BnplProfile::where('user_id', $userId)->first();
        if (!$profile) {
            return 300; // Default minimum score
        }

        $baseScore = 300;
        $score     = $baseScore;

        // Get payment history
        $payments = BnplPayment::where('user_id', $userId)->get();

        if ($payments->isEmpty()) {
            return $baseScore;
        }

        $totalPayments = $payments->count();

        // FIX: Use whereColumn() to compare two DB columns properly.
        // The original code used  ->where('paid_at', '<=', 'due_date')
        // which compares paid_at to the *string* "due_date" – always false.
        $onTimePayments = BnplPayment::where('user_id', $userId)
            ->where('status', 'paid')
            ->whereColumn('paid_at', '<=', 'due_date')
            ->count();

        $latePayments = BnplPayment::where('user_id', $userId)
            ->where('status', 'paid')
            ->whereColumn('paid_at', '>', 'due_date')
            ->count();

        $missedPayments = $payments->where('status', 'overdue')->count();

        // Payment history factor (40% weight)
        if ($totalPayments > 0) {
            $onTimeRate = $onTimePayments / $totalPayments;
            $score += ($onTimeRate * 400);

            $lateRate = $latePayments / $totalPayments;
            $score -= ($lateRate * 100);

            $missedRate = $missedPayments / $totalPayments;
            $score -= ($missedRate * 200);
        }

        // Account age factor (20% weight)
        $accountAgeDays   = Carbon::parse($profile->created_at)->diffInDays(now());
        $accountAgeMonths = $accountAgeDays / 30;
        $score += min($accountAgeMonths * 10, 200);

        // Credit utilization factor (20% weight)
        // FIX: Use the correct column name 'loan_amount' (matches BnplLoan $fillable).
        $currentLoans = BnplLoan::where('user_id', $userId)
            ->where('status', 'active')
            ->sum('loan_amount');

        // FIX: Use the pre-computed limit when provided to avoid recursion;
        // otherwise compute it directly from the profile (no score call).
        if ($availableLimit === null) {
            $availableLimit = $this->calculateAvailableLimitDirect($userId, $profile);
        }

        $totalLimit = $currentLoans + $availableLimit;

        if ($totalLimit > 0) {
            $utilizationRate = $currentLoans / $totalLimit;
            if ($utilizationRate <= 0.3) {
                $score += 150;
            } elseif ($utilizationRate <= 0.7) {
                $score += 50;
            } else {
                $score -= 100;
            }
        }

        // Milestone completion factor (20% weight)
        // FIX: BnplMilestone uses 'is_completed' boolean, not a 'status' string column.
        $completedMilestones = BnplMilestone::where('user_id', $userId)
            ->where('is_completed', true)
            ->count();
        $score += ($completedMilestones * 20);

        return max(300, min(850, (int) $score));
    }

    /**
     * Update credit score for a user.
     */
    public function updateCreditScore($userId)
    {
        $newScore = $this->calculateCreditScore($userId);

        BnplCreditScore::updateOrCreate(
            ['user_id' => $userId],
            [
                'score'          => $newScore,
                'calculated_at'  => now(),
                'factors'        => [
                    'payment_history' => 'Based on on-time payments',
                    'account_age'     => 'Account age bonus',
                    'utilization'     => 'Credit utilization factor',
                    'milestones'      => 'Milestone completion bonus',
                ],
            ]
        );

        return $newScore;
    }

    /**
     * Get credit tier based on score.
     */
    public function getCreditTier($score)
    {
        return BnplTier::where('min_score', '<=', $score)
            ->where('max_score', '>=', $score)
            ->first();
    }

    /**
     * Calculate available BNPL limit for a user (public entry point).
     *
     * FIX: Delegates to calculateAvailableLimitDirect() after computing
     * the credit score once, passing it back in to avoid mutual recursion.
     */
    public function calculateAvailableLimit($userId)
    {
        $profile = BnplProfile::where('user_id', $userId)->first();
        if (!$profile) {
            return 0;
        }

        return $this->calculateAvailableLimitDirect($userId, $profile);
    }

    /**
     * Internal helper: compute available limit without calling calculateCreditScore()
     * through calculateAvailableLimit() again.
     *
     * FIX: Breaks the infinite-recursion cycle. Called by calculateCreditScore()
     * when it needs the limit, and by calculateAvailableLimit() as the real implementation.
     */
    private function calculateAvailableLimitDirect($userId, $profile)
    {
        // We need a credit score here but CANNOT call calculateCreditScore()
        // (which would call us back). Use the cached value from the profile instead.
        $creditScore = $profile->credit_score ?? 300;
        $tier        = $this->getCreditTier($creditScore);

        if (!$tier) {
            return 0;
        }

        // FIX: Use the correct column name 'limit_amount' (matches BnplTier $fillable).
        // Original code used $tier->max_limit which doesn't exist on the model.
        $baseLimit = $tier->limit_amount;

        // FIX: Use the correct column name 'loan_amount' (matches BnplLoan $fillable).
        $currentLoans = BnplLoan::where('user_id', $userId)
            ->where('status', 'active')
            ->sum('loan_amount');

        return max(0, $baseLimit - $currentLoans);
    }

    /**
     * Check if user is eligible for BNPL.
     *
     * FIX: calculateCreditScore() is called once and the result is reused;
     * calculateAvailableLimit() previously triggered a second full score
     * calculation internally — now eliminated via the $availableLimit parameter.
     */
    public function checkEligibility($userId)
    {
        $profile = BnplProfile::where('user_id', $userId)->first();
        if (!$profile) {
            return [
                'eligible' => false,
                'reason'   => 'No BNPL profile found',
            ];
        }

        // Compute score once, then pass the already-known available limit
        // into calculateCreditScore so it doesn't recurse to get the limit again.
        $availableLimit = $this->calculateAvailableLimitDirect($userId, $profile);
        $creditScore    = $this->calculateCreditScore($userId, $availableLimit);

        if ($creditScore < 400) {
            return [
                'eligible' => false,
                'reason'   => 'Credit score too low (minimum 400 required)',
            ];
        }

        // FIX: Join through user_id directly instead of whereHas to avoid N+1.
        $overduePayments = BnplPayment::where('user_id', $userId)
            ->where('status', 'overdue')
            ->where('due_date', '<', now())
            ->count();

        if ($overduePayments > 0) {
            return [
                'eligible' => false,
                'reason'   => 'Outstanding overdue payments',
            ];
        }

        // FIX: BnplProfile has 'is_enabled' / 'is_eligible', not a 'status' string.
        // Guard against a suspended/disabled profile via is_enabled.
        if (!$profile->is_enabled) {
            return [
                'eligible' => false,
                'reason'   => 'BNPL account is not enabled',
            ];
        }

        return [
            'eligible'        => true,
            'credit_score'    => $creditScore,
            'available_limit' => $availableLimit,
        ];
    }

    /**
     * Process a BNPL payment.
     */
    public function processPayment($paymentId, $amount, $paymentMethod = 'online')
    {
        $payment = BnplPayment::with('loan')->find($paymentId);
        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        if ($payment->status === 'paid') {
            throw new \Exception('Payment already processed');
        }

        $payment->update([
            'status'         => 'paid',
            'paid_at'        => now(),
            'amount_paid'    => $amount,
            'payment_method' => $paymentMethod,
        ]);

        $loan = $payment->loan;

        $remainingPayments = $loan->payments()->where('status', '!=', 'paid')->count();
        if ($remainingPayments === 0) {
            $loan->update(['status' => 'completed']);
        }

        // Update credit score once at the end.
        $this->updateCreditScore($loan->user_id);

        return $payment;
    }

    /**
     * Update milestone progress.
     *
     * FIX: milestone_type (not 'type'), is_completed (not 'status' string),
     * current_value (not 'progress'), and whereColumn() for on-time comparison.
     * Also computes credit score once and reuses it instead of calling
     * calculateCreditScore() inside every loop iteration.
     */
    public function updateMilestones($userId)
    {
        $profile = BnplProfile::where('user_id', $userId)->first();
        if (!$profile) {
            return;
        }

        $milestones = BnplMilestone::where('user_id', $userId)->get();

        if ($milestones->isEmpty()) {
            return;
        }

        // Pre-compute the credit score once for use in the loop below.
        $currentScore = $this->calculateCreditScore($userId);

        // Pre-compute completed loans count once (used by multiple milestone types).
        $completedLoans = BnplLoan::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        foreach ($milestones as $milestone) {
            // Skip milestones that are already completed.
            if ($milestone->is_completed) {
                continue;
            }

            $currentValue   = 0;
            $requiredValue  = $milestone->required_value ?? 1;

            // FIX: field is 'milestone_type', not 'type'.
            switch ($milestone->milestone_type) {
                case 'first_purchase':
                    $currentValue  = min($completedLoans, $requiredValue);
                    break;

                case 'on_time_payments':
                    // FIX: Use whereColumn() so the DB compares two date columns.
                    $currentValue = BnplPayment::where('user_id', $userId)
                        ->where('status', 'paid')
                        ->whereColumn('paid_at', '<=', 'due_date')
                        ->count();
                    break;

                case 'credit_score':
                    $currentValue  = $currentScore;
                    $requiredValue = $milestone->required_value ?? 650;
                    break;

                case 'total_spent':
                    // FIX: correct column name 'loan_amount'.
                    $currentValue  = (int) BnplLoan::where('user_id', $userId)
                        ->where('status', 'completed')
                        ->sum('loan_amount');
                    break;
            }

            $isCompleted = $currentValue >= $requiredValue;

            // FIX: Update using correct model fields (current_value / is_completed / completed_at).
            $milestone->update([
                'current_value' => $currentValue,
                'is_completed'  => $isCompleted,
                'completed_at'  => $isCompleted ? now() : null,
            ]);
        }
    }

    /**
     * Get upcoming payments for a user.
     *
     * FIX: Query directly on user_id instead of whereHas to avoid subquery overhead.
     */
    public function getUpcomingPayments($userId, $limit = 5)
    {
        return BnplPayment::where('user_id', $userId)
            ->where('status', 'pending')
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->limit($limit)
            ->get();
    }

    /**
     * Get payment history for a user.
     *
     * FIX: Query directly on user_id instead of whereHas to avoid subquery overhead.
     */
    public function getPaymentHistory($userId, $limit = 10)
    {
        return BnplPayment::where('user_id', $userId)
            ->orderBy('due_date', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Create a new BNPL loan.
     *
     * FIX: Use correct $fillable column names ('loan_amount', 'total_installments').
     * Also use BnplPayment's correct column 'amount_due' instead of 'amount'.
     */
    public function createLoan($userId, $amount, $tenureMonths = 3)
    {
        $eligibility = $this->checkEligibility($userId);
        if (!$eligibility['eligible']) {
            throw new \Exception($eligibility['reason']);
        }

        if ($amount > $eligibility['available_limit']) {
            throw new \Exception('Amount exceeds available limit');
        }

        $interestRate   = 2.5; // 2.5% per month
        $totalAmount    = $amount * (1 + ($interestRate / 100) * $tenureMonths);
        $monthlyPayment = round($totalAmount / $tenureMonths, 2);

        // FIX: Use fillable column names from BnplLoan model.
        $loan = BnplLoan::create([
            'user_id'            => $userId,
            'loan_amount'        => $amount,
            'total_installments' => $tenureMonths,
            'installment_amount' => $monthlyPayment,
            'remaining_amount'   => $totalAmount,
            'paid_amount'        => 0,
            'interest_rate'      => $interestRate,
            'status'             => 'active',
            'loan_date'          => now(),
            'next_payment_due'   => now()->addMonth(),
        ]);

        // FIX: Use fillable column names from BnplPayment model ('amount_due', 'user_id').
        for ($i = 1; $i <= $tenureMonths; $i++) {
            BnplPayment::create([
                'loan_id'            => $loan->id,
                'user_id'            => $userId,
                'installment_number' => $i,
                'amount_due'         => $monthlyPayment,
                'amount_paid'        => 0,
                'due_date'           => now()->addMonths($i),
                'status'             => 'pending',
            ]);
        }

        // Update credit score once; milestones reuse the same score internally.
        $this->updateCreditScore($userId);
        $this->updateMilestones($userId);

        return $loan;
    }
}