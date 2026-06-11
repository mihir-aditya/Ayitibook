# BNPL Service - Quick Reference

## Installation & Setup

```bash
# No additional installation needed - all dependencies are already in Laravel
composer dump-autoload
php artisan migrate
php artisan db:seed --class=BnplTiersSeeder
```

## Using the Service

### In a Controller
```php
use App\Services\BnplService;

class MyController {
    public function checkCredit(BnplService $service) {
        $score = $service->calculateCreditScore(auth()->id());
        return $score; // 300-850
    }
}
```

### In Blade Template
```blade
@php
    $service = new \App\Services\BnplService();
    $score = $service->calculateCreditScore(auth()->id());
    $eligibility = $service->checkEligibility(auth()->id());
@endphp

Score: {{ $score }}/850
Eligible: {{ $eligibility['eligible'] ? 'Yes' : 'No' }}
```

### In Routes
```php
Route::post('/borrow', function(Request $request, BnplService $service) {
    try {
        $loan = $service->createLoan(auth()->id(), 500, 3);
        return response()->json(['loan_id' => $loan->id]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }
});
```

## API Endpoints (POST/GET)

### Check If User Can Borrow
```bash
GET /bnpl/check-eligibility
Response: {"eligible": true/false, "reason": "...", "credit_score": 750, "available_limit": 5000}
```

### Get Credit Score
```bash
GET /bnpl/credit-score
Response: {"score": 750, "tier": {...}, "available_limit": 5000}
```

### Get Upcoming Payments
```bash
GET /bnpl/upcoming-payments?limit=5
Response: [{"amount": 166.67, "due_date": "2024-04-21", "status": "pending"}, ...]
```

### Create a Loan
```bash
POST /bnpl/create-loan
Body: {"amount": 500, "tenure_months": 3}
Response: {"success": true, "loan_id": 42}
```

### Make a Payment
```bash
POST /bnpl/make-payment
Body: {"payment_id": 123, "amount": 166.67, "payment_method": "online"}
Response: {"success": true, "payment_id": 123}
```

## Key Methods Reference

| Method | Params | Returns | Description |
|--------|--------|---------|-------------|
| `calculateCreditScore($userId)` | User ID | Integer (300-850) | Compute user's credit score |
| `checkEligibility($userId)` | User ID | Array with 'eligible' flag | Check if user can borrow |
| `calculateAvailableLimit($userId)` | User ID | Dollar amount | How much user can borrow |
| `getCreditTier($score)` | Score | BnplTier model | Get tier for a score |
| `createLoan($userId, $amt, $months)` | User ID, Amount, Months (1-12) | BnplLoan | Create new loan |
| `processPayment($paymentId, $amt, $method)` | Payment ID, Amount, Method | BnplPayment | Record payment |
| `updateMilestones($userId)` | User ID | void | Refresh milestone progress |
| `getUpcomingPayments($userId, $limit)` | User ID, Count | Collection | Next N due payments |
| `getPaymentHistory($userId, $limit)` | User ID, Count | Collection | Last N payments |

## Credit Tier Thresholds

| Score Range | Limit | Tier |
|------------|-------|------|
| 0-67 | $0 | Not Eligible |
| 68-79 | $500 | Starter |
| 80-89 | $2,000 | Standard |
| 90+ | $10,000 | Premium |

## Error Handling

```php
$service = new BnplService();

try {
    $loan = $service->createLoan(1, 10000, 12);
} catch (\Exception $e) {
    // Check the exception message for reason:
    // "Amount exceeds available limit"
    // "No BNPL profile found"
    // "Credit score too low"
    // "Outstanding overdue payments"
}
```

## Database Quick Access

```php
// Get user's BNPL profile
$user->bnplProfile // BnplProfile model

// Get all user's loans
$user->bnplLoans()->get() // Collection of BnplLoan

// Get all user's payments
$user->bnplPayments()->get() // Collection of BnplPayment

// Get user's latest credit score
$user->bnplCreditScores()->latest('calculated_at')->first()

// Get user's milestones
$user->bnplMilestones()->get()
```

## Seeding Test Data

```bash
# In tinker or console
> Artisan::call('db:seed', ['--class' => 'BnplDemoDataSeeder'])

# Creates test user with:
# - Profile & loans
# - Payment history
# - Credit score
# - Milestones
```

## Common Queries

### Find all overdue payments
```php
BnplPayment::where('status', '!=', 'paid')
    ->where('due_date', '<', now())
    ->get();
```

### Find users below credit score 400
```php
BnplCreditScore::where('score', '<', 400)->get();
```

### Find users with available limit
```php
BnplCreditScore::where('score', '>=', 400)
    ->with('user')
    ->get();
```

### Get payment statistics
```php
$stats = [
    'total_loans' => BnplLoan::count(),
    'active_loans' => BnplLoan::where('status', 'active')->count(),
    'total_paid' => BnplPayment::where('status', 'paid')->sum('amount'),
    'overdue_count' => BnplPayment::where('status', 'overdue')->count(),
];
```

## Debugging

### Check a user's credit score calculation
```php
$service = new \App\Services\BnplService();
$score = $service->calculateCreditScore(1);
echo "User 1 score: $score"; // Output: User 1 score: 450
```

### Check eligibility in detail
```php
$result = $service->checkEligibility(1);
dd($result); // Shows all eligibility info and reason if ineligible
```

### Force recalculate a user's score
```php
$newScore = $service->updateCreditScore($user_id);
echo "New score: $newScore";
```

### Check what tier a score maps to
```php
$tier = $service->getCreditTier(750);
echo "Tier: " . $tier->display_name; // Output: Tier: Premium
echo "Limit: $" . $tier->max_limit; // Output: Limit: $10000
```

## Performance Tips

1. **Cache credit scores**: Don't recalculate every page load
```php
$score = Cache::remember("user_{$id}_bnpl_score", 86400, 
    fn() => $service->calculateCreditScore($id)
);
```

2. **Eager load relationships**: When fetching loans
```php
$loans = $user->bnplLoans()->with('payments', 'creditScores')->get();
```

3. **Index database columns**: On `user_id`, `status`, `due_date`

## Files to Know

- Service: `app/Services/BnplService.php`
- Controller: `app/Http/Controllers/BnplController.php`
- Models: `app/Models/Bnpl*.php` (6 files)
- Migrations: `database/migrations/2026_03_21_*.php` (6 files)
- Seeds: `database/seeders/Bnpl*Seeder.php` (2 files)
- Routes: `routes/web.php` (BNPL group added)
- View: `resources/views/profile/bnpl.blade.php`
- Docs: `BNPL_SERVICE_DOCUMENTATION.md`

---
**Version**: 1.0  
**Last Updated**: March 2024
