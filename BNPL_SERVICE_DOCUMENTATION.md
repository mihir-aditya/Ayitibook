# BNPL Service Implementation Guide

## Overview
The BNPL (Buy Now Pay Later) system has been fully implemented with a comprehensive service layer (`BnplService`) that handles all business logic for credit scoring, payment processing, eligibility checks, and milestone tracking.

## Architecture

### Service Layer: `BnplService`
Location: `app/Services/BnplService.php`

The service provides the following key methods:

#### Credit Score Calculation
```php
public function calculateCreditScore($userId)
```
- **Purpose**: Calculate user's credit score (300-850 range)
- **Factors**:
  - Payment History (40% weight): On-time vs late/missed payments
  - Account Age (20% weight): Credit in months, max 200 points for 20+ months
  - Credit Utilization (20% weight): Current loans vs available limit
  - Milestone Completion (20% weight): Bonuses for completed milestones
- **Returns**: Integer between 300-850

#### Eligibility Check
```php
public function checkEligibility($userId)
```
- **Purpose**: Verify if user can access BNPL
- **Checks**:
  - Minimum credit score (400+)
  - No active overdue payments
  - Account status is 'active'
- **Returns**: Array with `eligible` flag and `reason`

```php
[
    'eligible' => true|false,
    'reason' => 'Reason if not eligible',
    'credit_score' => 750,  // if eligible
    'available_limit' => 5000  // if eligible
]
```

#### Available Limit Calculation
```php
public function calculateAvailableLimit($userId)
```
- **Purpose**: Determine how much user can borrow
- **Logic**: 
  - Get user's credit tier based on score
  - Calculate: Tier Max Limit - Current Outstanding Loans
- **Returns**: Dollar amount available to borrow

#### Create Loan
```php
public function createLoan($userId, $amount, $tenureMonths = 3)
```
- **Purpose**: Create a new BNPL loan with payment schedule
- **Validations**:
  - User must be eligible
  - Amount must not exceed available limit
  - Tenure: 1-12 months
- **Auto-creates**: Payment schedule with monthly installments
- **Side effects**: Updates credit score and milestones
- **Returns**: Created `BnplLoan` model

#### Payment Processing
```php
public function processPayment($paymentId, $amount, $paymentMethod = 'online')
```
- **Purpose**: Record and process BNPL payments
- **Updates**: 
  - Payment status to 'paid'
  - Payment timestamp
  - Amount paid
  - Payment method
  - User's credit score (recalculated)
  - Loan status (if fully paid)
- **Returns**: Updated `BnplPayment` model

#### Milestone Management
```php
public function updateMilestones($userId)
```
- **Purpose**: Track user progress on BNPL milestones
- **Milestone Types**:
  - `first_purchase`: Marks completion when user has 1+ completed loans
  - `on_time_payments`: Percentage of on-time payments
  - `credit_score`: Progress toward target score
  - `total_spent`: Total amount of completed loans
- **Updates**: Progress percentage and status

#### Data Retrieval Methods
```php
public function getUpcomingPayments($userId, $limit = 5)
public function getPaymentHistory($userId, $limit = 10)
public function getCreditTier($score)
public function updateCreditScore($userId)
```

## Controller Integration

### BnplController
Location: `app/Http/Controllers/BnplController.php`

Provides RESTful API endpoints:

```
POST   /bnpl/create-loan           - Create new loan
POST   /bnpl/make-payment          - Process payment
GET    /bnpl/check-eligibility     - Check user eligibility
GET    /bnpl/credit-score          - Get credit score details
GET    /bnpl/upcoming-payments     - Get upcoming payments
GET    /bnpl/payment-history       - Get payment history
GET    /bnpl/loans                 - Get all user loans
GET    /bnpl/loans/{id}            - Get loan details
POST   /bnpl/recalculate-score     - Recalculate credit score
```

All endpoints require authentication (`auth:web` middleware).

## ProfileController Integration

The `ProfileController@show` method handles BNPL dashboard data:

```php
if ($page === 'bnpl') {
    $bnplService = new BnplService();

    // All dashboard data is loaded through the service
    $data['currentCreditScore'] = $bnplService->calculateCreditScore($user->id);
    $data['creditTier'] = $bnplService->getCreditTier($data['currentCreditScore']);
    $data['availableLimit'] = $bnplService->calculateAvailableLimit($user->id);
    $data['eligibility'] = $bnplService->checkEligibility($user->id);
    $data['upcomingPayments'] = $bnplService->getUpcomingPayments($user->id, 5);
    $data['paymentHistory'] = $bnplService->getPaymentHistory($user->id, 10);
    
    // Milestones are updated dynamically
    $bnplService->updateMilestones($user->id);
}
```

## Database Models

### Key Models with Relationships:

**BnplProfile**
- User 1:1 relationship
- Stores user's BNPL account information
- Fields: `is_eligible`, `status`, `kyc_status`

**BnplLoan**
- User 1:Many
- Stores loan information
- Fields: `amount`, `tenure_months`, `interest_rate`, `status`
- Has many `BnplPayments`

**BnplPayment**
- Loan 1:Many
- Stores individual payment records
- Fields: `amount`, `due_date`, `status`, `paid_at`

**BnplCreditScore**
- User 1:Many
- Stores credit score history
- Fields: `score`, `calculated_at`, `factors`

**BnplMilestone**
- User 1:Many
- Stores milestone progress
- Fields: `type`, `progress`, `status`, `target_value`

**BnplTier**
- System-wide (not user-specific)
- Stores credit tiers and limits
- Fields: `min_score`, `max_score`, `max_limit`, `display_name`

## Blade Template Integration

The BNPL dashboard (`resources/views/profile/bnpl.blade.php`) is fully dynamic:

```php
// All variables are calculated and provided by BnplService
$currentCreditScore       // Calculated score 300-850
$credit_score_100         // Score as 0-100 percentage
$creditTier               // User's current tier
$availableLimit           // Amount available to borrow
$eligibility              // Eligibility status
$upcomingPayments         // Next 5 due payments
$paymentHistory           // Last 10 payments
$bnplLoans                // All user loans with relationships
```

## Usage Examples

### Create a BNPL Loan
```php
$service = new BnplService();

$loan = $service->createLoan(
    userId: $user->id,
    amount: 500,
    tenureMonths: 3
);
// Returns BnplLoan with auto-created payment schedule
```

### Process a Payment
```php
$payment = $service->processPayment(
    paymentId: $payment->id,
    amount: 166.67,
    paymentMethod: 'online'
);
// Credit score automatically recalculated
```

### Check Eligibility Before Loan
```php
$eligibility = $service->checkEligibility($user->id);

if ($eligibility['eligible']) {
    $availableLimit = $eligibility['available_limit'];
    // Allow user to borrow up to $availableLimit
} else {
    // Show reason: $eligibility['reason']
}
```

### Get User's Credit Info
```php
$score = $service->calculateCreditScore($user->id);
$tier = $service->getCreditTier($score);
$limit = $service->calculateAvailableLimit($user->id);

echo "Score: $score, Limit: $$limit, Tier: {$tier->display_name}";
```

## Credit Score Algorithm

The credit score is calculated on a 300-850 scale:

```
Base Score = 300

Payment History (40% weight):
  - Perfect on-time rate: +400 points
  - Late payments: -100 points each (rate-based)
  - Missed payments: -200 points each (rate-based)

Account Age (20% weight):
  - 10 points/month up to 200 points (20+ months old)

Credit Utilization (20% weight):
  - Low (0-30%): +150 points
  - Moderate (30-70%): +50 points
  - High (70%+): -100 points

Milestone Completion (20% weight):
  - Each completed milestone: +20 points

Final = max(300, min(850, Base + all factors))
```

## Tier System

Default tiers (from `BnplTiersSeeder`):

| Score Range | Max Limit | Tier Name | Description |
|------------|-----------|-----------|-------------|
| 0-67      | $0        | Not Eligible | Not eligible for BNPL |
| 68-79     | $500      | Starter | Lowest loan tier |
| 80-89     | $2,000    | Standard | Regular BNPL access |
| 90+       | $10,000   | Premium | Highest credit limit |

## Events & Webhooks (Future Enhancement)

Consider implementing Laravel Events for:
- `LoanCreated` - When new loan is created
- `PaymentProcessed` - When payment is made
- `CreditScoreUpdated` - When score changes
- `MilestoneCompleted` - When milestone achieved
- `EligibilityChanged` - When status changes

Example implementation:
```php
event(new LoanCreated($loan));
event(new PaymentProcessed($payment));
event(new CreditScoreUpdated($user->id, $newScore));
```

## Testing

### Unit Test Example
```php
public function test_credit_score_calculation()
{
    $user = User::factory()->create();
    $service = new BnplService();
    
    $score = $service->calculateCreditScore($user->id);
    $this->assertGreaterThanOrEqual(300, $score);
    $this->assertLessThanOrEqual(850, $score);
}

public function test_eligibility_check()
{
    $user = User::factory()->create();
    $service = new BnplService();
    
    $eligibility = $service->checkEligibility($user->id);
    $this->assertArrayHasKey('eligible', $eligibility);
    $this->assertArrayHasKey('reason', $eligibility);
}
```

## API Response Examples

### Create Loan Response
```json
{
    "success": true,
    "loan_id": 42,
    "message": "Loan created successfully"
}
```

### Check Eligibility Response
```json
{
    "eligible": true,
    "credit_score": 750,
    "available_limit": 5000
}
```

### Credit Score Response
```json
{
    "score": 750,
    "tier": {
        "id": 3,
        "min_score": 80,
        "max_score": 89,
        "max_limit": 2000,
        "display_name": "Standard"
    },
    "available_limit": 1500
}
```

## Performance Considerations

### Database Queries
- Credit score calculation queries all payments once
- Eligibility check queries overdue payments
- Consider caching credit scores for 24 hours
- Index on `user_id`, `status`, `due_date` in payment table

### Caching Strategy
```php
// Cache credit score for 24 hours
$score = Cache::remember(
    "bnpl_score_{$userId}",
    86400,
    fn() => $this->calculateCreditScore($userId)
);

// Invalidate when payment is made
Cache::forget("bnpl_score_{$userId}");
```

### Optimization Tips
1. Eager load relationships: `with('payments', 'loans')`
2. Chunk large payment queries
3. Use database indexes on frequently queried columns
4. Schedule credit score recalculation as batch job

## Error Handling

All service methods should handle exceptions:

```php
try {
    $loan = $bnplService->createLoan($userId, $amount, 3);
} catch (\Exception $e) {
    // Log error
    \Log::error('BNPL Loan Creation Failed', [
        'user_id' => $userId,
        'error' => $e->getMessage()
    ]);
    
    // Return user-friendly message
    return response()->json([
        'success' => false,
        'message' => $e->getMessage()
    ], 400);
}
```

## Future Enhancements

1. **Automated Payment Reminders** - Email/SMS before due date
2. **Admin Dashboard** - Manage BNPL users, adjust limits
3. **Payment Plan Adjustments** - Allow users to modify payment schedule
4. **Late Fee Calculation** - Apply fees for overdue payments
5. **Fraud Detection** - Detect suspicious patterns
6. **Integration with Payment Gateway** - Direct payment processing
7. **Mobile App Integration** - BNPL management on mobile
8. **Analytics Dashboard** - Track BNPL metrics and KPIs

---

**Last Updated**: March 2024  
**Version**: 1.0
