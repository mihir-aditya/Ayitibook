<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\Commission;
use App\Models\Order;

class CommissionService
{
    /**
     * Create commission for a customer purchase through affiliate
     */
    public function createCommissionFromPurchase(
        int $orderId,
        int $affiliateId,
        int $customerId,
        float $orderAmount,
        float $commissionPercentage = 5.0
    ): Commission {
        $commissionAmount = $this->calculateCommissionAmount($orderAmount, $commissionPercentage);

        return Commission::create([
            'order_id' => $orderId,
            'affiliate_id' => $affiliateId,
            'customer_id' => $customerId,
            'amount' => $commissionAmount,
            'commission_percentage' => $commissionPercentage,
            'status' => 'pending',
        ]);
    }

    /**
     * Calculate commission amount
     */
    public function calculateCommissionAmount(
        float $baseAmount,
        float $commissionPercentage
    ): float {
        return round(($baseAmount * $commissionPercentage) / 100, 2);
    }

    /**
     * Approve commission
     */
    public function approveCommission(Commission $commission): bool
    {
        return $commission->update(['status' => 'approved']);
    }

    /**
     * Mark commission as paid
     */
    public function markCommissionAsPaid(Commission $commission): bool
    {
        $result = $commission->update(['status' => 'paid']);

        if ($result) {
            $this->updateAffiliateEarnings($commission->affiliate_id);
        }

        return $result;
    }

    /**
     * Reject commission
     */
    public function rejectCommission(Commission $commission): bool
    {
        return $commission->update(['status' => 'rejected']);
    }

    /**
     * Get pending commissions for affiliate
     */
    public function getPendingCommissions(int $affiliateId)
    {
        return Commission::where('affiliate_id', $affiliateId)
            ->where('status', 'pending')
            ->get();
    }

    /**
     * Get approved commissions for affiliate
     */
    public function getApprovedCommissions(int $affiliateId)
    {
        return Commission::where('affiliate_id', $affiliateId)
            ->where('status', 'approved')
            ->get();
    }

    /**
     * Get paid commissions for affiliate
     */
    public function getPaidCommissions(int $affiliateId)
    {
        return Commission::where('affiliate_id', $affiliateId)
            ->where('status', 'paid')
            ->get();
    }

    /**
     * Get total commission for affiliate
     */
    public function getTotalCommission(int $affiliateId, string $status = null): float
    {
        $query = Commission::where('affiliate_id', $affiliateId);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->sum('amount');
    }

    /**
     * Update affiliate total earnings
     */
    public function updateAffiliateEarnings(int $affiliateId): void
    {
        $affiliate = Affiliate::find($affiliateId);

        if ($affiliate) {
            $totalEarnings = Commission::where('affiliate_id', $affiliateId)
                ->where('status', 'paid')
                ->sum('amount');

            $affiliate->update(['total_earnings' => $totalEarnings]);
        }
    }

    /**
     * Get monthly earnings
     */
    public function getMonthlyEarnings(int $affiliateId, int $month, int $year): float
    {
        return Commission::where('affiliate_id', $affiliateId)
            ->where('status', 'paid')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('amount');
    }

    /**
     * Get earning statistics for affiliate
     */
    public function getEarningStatistics(int $affiliateId): array
    {
        $affiliate = Affiliate::find($affiliateId);

        if (!$affiliate) {
            return [];
        }

        return [
            'total_earnings' => $this->getTotalCommission($affiliateId, 'paid'),
            'pending_commission' => $this->getTotalCommission($affiliateId, 'pending'),
            'approved_commission' => $this->getTotalCommission($affiliateId, 'approved'),
            'rejected_commission' => $this->getTotalCommission($affiliateId, 'rejected'),
            'pending_count' => Commission::where('affiliate_id', $affiliateId)->where('status', 'pending')->count(),
            'approved_count' => Commission::where('affiliate_id', $affiliateId)->where('status', 'approved')->count(),
            'paid_count' => Commission::where('affiliate_id', $affiliateId)->where('status', 'paid')->count(),
        ];
    }
}
