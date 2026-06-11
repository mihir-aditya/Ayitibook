<?php

namespace App\Http\Controllers;

use App\Models\BnplLoan;
use App\Models\BnplPayment;
use App\Services\BnplService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BnplController extends Controller
{
    protected $bnplService;

    public function __construct(BnplService $bnplService)
    {
        $this->bnplService = $bnplService;
    }

    /**
     * Create a new BNPL loan
     */
    public function createLoan(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'tenure_months' => 'required|integer|min:1|max:12'
        ]);

        try {
            $user = Auth::user();
            $loan = $this->bnplService->createLoan(
                $user->id,
                $request->amount,
                $request->tenure_months
            );

            return response()->json([
                'success' => true,
                'loan_id' => $loan->id,
                'message' => 'Loan created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Make a BNPL payment
     */
    public function makePayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:bnpl_payments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:online,bank_transfer,wallet'
        ]);

        try {
            $user = Auth::user();
            $payment = BnplPayment::find($request->payment_id);

            // Verify payment belongs to user's loan
            if ($payment->loan->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $processedPayment = $this->bnplService->processPayment(
                $request->payment_id,
                $request->amount,
                $request->payment_method
            );

            return response()->json([
                'success' => true,
                'payment_id' => $processedPayment->id,
                'message' => 'Payment processed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Check BNPL eligibility
     */
    public function checkEligibility(Request $request)
    {
        $user = Auth::user();
        $eligibility = $this->bnplService->checkEligibility($user->id);

        return response()->json($eligibility);
    }

    /**
     * Get credit score details
     */
    public function getCreditScore(Request $request)
    {
        $user = Auth::user();
        $score = $this->bnplService->calculateCreditScore($user->id);
        $tier = $this->bnplService->getCreditTier($score);
        $availableLimit = $this->bnplService->calculateAvailableLimit($user->id);

        return response()->json([
            'score' => $score,
            'tier' => $tier,
            'available_limit' => $availableLimit
        ]);
    }

    /**
     * Get upcoming payments
     */
    public function getUpcomingPayments(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 5);
        $payments = $this->bnplService->getUpcomingPayments($user->id, $limit);

        return response()->json($payments);
    }

    /**
     * Get payment history
     */
    public function getPaymentHistory(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 10);
        $history = $this->bnplService->getPaymentHistory($user->id, $limit);

        return response()->json($history);
    }

    /**
     * Get all loans for user
     */
    public function getLoans(Request $request)
    {
        $user = Auth::user();
        $loans = BnplLoan::where('user_id', $user->id)
            ->with('payments')
            ->latest()
            ->get();

        return response()->json($loans);
    }

    /**
     * Get loan details
     */
    public function getLoan(BnplLoan $loan)
    {
        if ($loan->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($loan->load('payments'));
    }

    /**
     * Recalculate credit score
     */
    public function recalculateCreditScore(Request $request)
    {
        $user = Auth::user();
        $newScore = $this->bnplService->updateCreditScore($user->id);

        return response()->json([
            'success' => true,
            'new_score' => $newScore,
            'message' => 'Credit score updated'
        ]);
    }
}
