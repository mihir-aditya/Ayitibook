<?php

namespace Database\Seeders;

use App\Models\BnplProfile;
use App\Models\BnplLoan;
use App\Models\BnplPayment;
use App\Models\BnplMilestone;
use App\Models\BnplCreditScore;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BnplDemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user or create one for demo
        $user = User::first();
        if (!$user) {
            return; // No users to seed
        }

        // Create BNPL Profile
        $profile = BnplProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'is_eligible' => true,
                'is_enabled' => true,
                'credit_score' => 85,
                'current_limit' => 19.00,
                'available_limit' => 15.50,
                'used_limit' => 3.50,
                'tier' => 'growth',
                'total_loans' => 2,
                'completed_loans' => 1,
                'active_loans' => 1,
                'total_borrowed' => 150.00,
                'total_repaid' => 146.50,
                'outstanding_amount' => 3.50,
                'on_time_payments' => 8,
                'late_payments' => 0,
                'missed_payments' => 0,
                'last_payment_date' => now()->subDays(5),
                'eligibility_checked_at' => now(),
                'milestone_progress' => [
                    'tenure' => 4,
                    'spending' => 250,
                    'purchases' => 5,
                    'bnpl_orders' => 2
                ]
            ]
        );

        // Create Credit Score History
        BnplCreditScore::updateOrCreate(
            ['user_id' => $user->id, 'calculated_at' => now()],
            [
                'score' => 85,
                'tier' => 'growth',
                'limit_amount' => 19.00,
                'reason' => 'Initial credit score calculation',
                'factors' => [
                    'on_time_payments' => 8,
                    'total_payments' => 8,
                    'account_tenure' => 4,
                    'total_spent' => 250
                ]
            ]
        );

        // Create Milestones
        $milestones = [
            [
                'milestone_type' => 'tenure',
                'label' => 'Account Tenure',
                'current_value' => 4,
                'required_value' => 3,
                'is_completed' => true,
                'completed_at' => now()->subDays(30)
            ],
            [
                'milestone_type' => 'spending',
                'label' => 'Total Spending',
                'current_value' => 250,
                'required_value' => 190,
                'is_completed' => true,
                'completed_at' => now()->subDays(15)
            ],
            [
                'milestone_type' => 'purchases',
                'label' => 'Total Orders',
                'current_value' => 5,
                'required_value' => 3,
                'is_completed' => true,
                'completed_at' => now()->subDays(10)
            ],
            [
                'milestone_type' => 'bnpl_orders',
                'label' => 'BNPL Orders',
                'current_value' => 2,
                'required_value' => 2,
                'is_completed' => true,
                'completed_at' => now()->subDays(5)
            ]
        ];

        foreach ($milestones as $milestone) {
            BnplMilestone::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'milestone_type' => $milestone['milestone_type']
                ],
                $milestone
            );
        }

        // Create Sample Loans
        $loan1 = BnplLoan::updateOrCreate(
            ['user_id' => $user->id, 'loan_number' => 'BNPL-001'],
            [
                'product_title' => 'Gaming Laptop',
                'loan_amount' => 100.00,
                'total_installments' => 4,
                'paid_installments' => 3,
                'installment_amount' => 25.00,
                'remaining_amount' => 25.00,
                'paid_amount' => 75.00,
                'status' => 'active',
                'loan_date' => now()->subDays(30),
                'next_payment_due' => now()->addDays(5),
                'interest_rate' => 0,
                'late_fees' => 0,
                'notes' => 'Gaming laptop purchase'
            ]
        );

        $loan2 = BnplLoan::updateOrCreate(
            ['user_id' => $user->id, 'loan_number' => 'BNPL-002'],
            [
                'product_title' => 'Wireless Headphones',
                'loan_amount' => 50.00,
                'total_installments' => 2,
                'paid_installments' => 2,
                'installment_amount' => 25.00,
                'remaining_amount' => 0,
                'paid_amount' => 50.00,
                'status' => 'completed',
                'loan_date' => now()->subDays(60),
                'completed_at' => now()->subDays(30),
                'interest_rate' => 0,
                'late_fees' => 0,
                'notes' => 'Headphones purchase - completed'
            ]
        );

        // Create Payments for Loan 1
        $payments = [
            [
                'installment_number' => 1,
                'amount_due' => 25.00,
                'amount_paid' => 25.00,
                'status' => 'paid',
                'due_date' => now()->subDays(30),
                'paid_at' => now()->subDays(30),
            ],
            [
                'installment_number' => 2,
                'amount_due' => 25.00,
                'amount_paid' => 25.00,
                'status' => 'paid',
                'due_date' => now()->subDays(20),
                'paid_at' => now()->subDays(20),
            ],
            [
                'installment_number' => 3,
                'amount_due' => 25.00,
                'amount_paid' => 25.00,
                'status' => 'paid',
                'due_date' => now()->subDays(10),
                'paid_at' => now()->subDays(10),
            ],
            [
                'installment_number' => 4,
                'amount_due' => 25.00,
                'amount_paid' => 0,
                'status' => 'pending',
                'due_date' => now()->addDays(5),
            ]
        ];

        foreach ($payments as $payment) {
            BnplPayment::updateOrCreate(
                [
                    'loan_id' => $loan1->id,
                    'installment_number' => $payment['installment_number']
                ],
                array_merge($payment, [
                    'user_id' => $user->id,
                    'payment_reference' => 'PAY-' . $loan1->loan_number . '-' . $payment['installment_number']
                ])
            );
        }

        // Create Payments for Loan 2 (completed)
        BnplPayment::updateOrCreate(
            ['loan_id' => $loan2->id, 'installment_number' => 1],
            [
                'user_id' => $user->id,
                'payment_reference' => 'PAY-' . $loan2->loan_number . '-1',
                'amount_due' => 25.00,
                'amount_paid' => 25.00,
                'status' => 'paid',
                'due_date' => now()->subDays(60),
                'paid_at' => now()->subDays(60),
            ]
        );

        BnplPayment::updateOrCreate(
            ['loan_id' => $loan2->id, 'installment_number' => 2],
            [
                'user_id' => $user->id,
                'payment_reference' => 'PAY-' . $loan2->loan_number . '-2',
                'amount_due' => 25.00,
                'amount_paid' => 25.00,
                'status' => 'paid',
                'due_date' => now()->subDays(30),
                'paid_at' => now()->subDays(30),
            ]
        );
    }
}
