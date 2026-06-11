# BNPL API Usage Examples

## Authentication Setup

All BNPL endpoints require authenticated user. Include auth token in header:

```bash
Authorization: Bearer YOUR_SANCTUM_TOKEN
# or via session cookie if testing in browser
```

---

## 1. Check BNPL Eligibility

**Request**
```http
GET /bnpl/check-eligibility
```

**cURL**
```bash
curl -H "Authorization: Bearer token" \
  http://localhost:8000/bnpl/check-eligibility
```

**Response (Eligible)**
```json
{
    "eligible": true,
    "credit_score": 750,
    "available_limit": 5000
}
```

**Response (Not Eligible)**
```json
{
    "eligible": false,
    "reason": "Credit score too low (minimum 400 required)"
}
```

---

## 2. Get Credit Score Details

**Request**
```http
GET /bnpl/credit-score
```

**cURL**
```bash
curl -H "Authorization: Bearer token" \
  http://localhost:8000/bnpl/credit-score
```

**Response**
```json
{
    "score": 750,
    "tier": {
        "id": 3,
        "min_score": 80,
        "max_score": 89,
        "max_limit": 2000,
        "limit_amount": 2000,
        "display_name": "Standard",
        "description": "Regular BNPL access"
    },
    "available_limit": 1500
}
```

**Interpretation**
- Score 750 falls in "Standard" tier (80-89 percentile)
- Max borrowing limit: $2000
- Currently can borrow: $1500 (after existing loans)

---

## 3. Create a New Loan

**Request**
```http
POST /bnpl/create-loan
Content-Type: application/json
```

**Payload**
```json
{
    "amount": 500,
    "tenure_months": 3
}
```

**cURL**
```bash
curl -X POST \
  -H "Authorization: Bearer token" \
  -H "Content-Type: application/json" \
  -d '{"amount": 500, "tenure_months": 3}' \
  http://localhost:8000/bnpl/create-loan
```

**JavaScript/Fetch**
```javascript
const response = await fetch('/bnpl/create-loan', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer token'
    },
    body: JSON.stringify({
        amount: 500,
        tenure_months: 3
    })
});
const data = await response.json();
console.log('Loan created:', data.loan_id);
```

**Success Response (201/200)**
```json
{
    "success": true,
    "loan_id": 42,
    "message": "Loan created successfully"
}
```

**Error Response (400)**
```json
{
    "success": false,
    "message": "Amount exceeds available limit"
}
```

**Common Errors**
- "No BNPL profile found" - User not enrolled in BNPL
- "Credit score too low" - Score below 400
- "Outstanding overdue payments" - Can't create new loans
- "Amount exceeds available limit" - Requested amount too high

**Generated Payment Schedule**
After loan creation, the system automatically generates:
- N payment records (one per tenure month)
- Each payment amount: `(amount × (1 + interest_rate/100 × tenure)) / tenure`
- Example: $500 over 3 months = ~$166.67/month

---

## 4. Make a Payment

First, get upcoming payments to find a payment ID.

**Request**
```http
POST /bnpl/make-payment
Content-Type: application/json
```

**Payload**
```json
{
    "payment_id": 123,
    "amount": 166.67,
    "payment_method": "online"
}
```

**Payment Methods**
- `online` - Credit/debit card
- `bank_transfer` - Direct bank transfer
- `wallet` - In-app wallet payment

**cURL**
```bash
curl -X POST \
  -H "Authorization: Bearer token" \
  -H "Content-Type: application/json" \
  -d '{
    "payment_id": 123,
    "amount": 166.67,
    "payment_method": "online"
  }' \
  http://localhost:8000/bnpl/make-payment
```

**Success Response**
```json
{
    "success": true,
    "payment_id": 123,
    "message": "Payment processed successfully"
}
```

**Error Response**
```json
{
    "success": false,
    "message": "Payment already processed"
}
```

**Side Effects**
- Payment status updated to 'paid'
- Credit score recalculated
- If all payments paid → Loan status = 'completed'
- Milestones updated accordingly

---

## 5. Get Upcoming Payments

**Request**
```http
GET /bnpl/upcoming-payments?limit=5
```

**Parameters**
- `limit` (optional): Number of payments to return (default: 5, max: 100)

**cURL**
```bash
curl -H "Authorization: Bearer token" \
  'http://localhost:8000/bnpl/upcoming-payments?limit=5'
```

**JavaScript**
```javascript
const payments = await fetch('/bnpl/upcoming-payments?limit=10')
    .then(r => r.json());

payments.forEach(payment => {
    console.log(`Due ${payment.due_date}: $${payment.amount}`);
});
```

**Response**
```json
[
    {
        "id": 123,
        "loan_id": 42,
        "amount": 166.67,
        "due_date": "2024-04-21T00:00:00.000000Z",
        "status": "pending",
        "amount_paid": null,
        "paid_at": null,
        "payment_method": null
    },
    {
        "id": 124,
        "loan_id": 42,
        "amount": 166.67,
        "due_date": "2024-05-21T00:00:00.000000Z",
        "status": "pending",
        "amount_paid": null,
        "paid_at": null,
        "payment_method": null
    }
]
```

---

## 6. Get Payment History

**Request**
```http
GET /bnpl/payment-history?limit=10
```

**cURL**
```bash
curl -H "Authorization: Bearer token" \
  'http://localhost:8000/bnpl/payment-history?limit=10'
```

**Response**
```json
[
    {
        "id": 121,
        "loan_id": 41,
        "amount": 100,
        "due_date": "2024-03-21T00:00:00.000000Z",
        "status": "paid",
        "amount_paid": 100,
        "paid_at": "2024-03-20T10:30:00.000000Z",
        "payment_method": "online"
    },
    {
        "id": 122,
        "loan_id": 41,
        "amount": 100,
        "due_date": "2024-04-21T00:00:00.000000Z",
        "status": "paid",
        "amount_paid": 100,
        "paid_at": "2024-04-21T09:15:00.000000Z",
        "payment_method": "online"
    }
]
```

---

## 7. Get All Loans

**Request**
```http
GET /bnpl/loans
```

**cURL**
```bash
curl -H "Authorization: Bearer token" \
  http://localhost:8000/bnpl/loans
```

**Response**
```json
[
    {
        "id": 42,
        "user_id": 1,
        "amount": 500,
        "tenure_months": 3,
        "interest_rate": 2.5,
        "status": "active",
        "approved_at": "2024-03-21T10:00:00.000000Z",
        "created_at": "2024-03-21T10:00:00.000000Z",
        "updated_at": "2024-03-21T10:00:00.000000Z",
        "payments": [
            {"id": 123, "amount": 166.67, "due_date": "2024-04-21"},
            {"id": 124, "amount": 166.67, "due_date": "2024-05-21"},
            {"id": 125, "amount": 166.67, "due_date": "2024-06-21"}
        ]
    }
]
```

---

## 8. Get Single Loan Details

**Request**
```http
GET /bnpl/loans/{loan_id}
```

**Example**
```http
GET /bnpl/loans/42
```

**cURL**
```bash
curl -H "Authorization: Bearer token" \
  http://localhost:8000/bnpl/loans/42
```

**Response**
```json
{
    "id": 42,
    "user_id": 1,
    "amount": 500,
    "tenure_months": 3,
    "interest_rate": 2.5,
    "status": "active",
    "approved_at": "2024-03-21T10:00:00.000000Z",
    "created_at": "2024-03-21T10:00:00.000000Z",
    "updated_at": "2024-03-21T10:00:00.000000Z",
    "payments": [
        {
            "id": 123,
            "loan_id": 42,
            "amount": 166.67,
            "due_date": "2024-04-21",
            "status": "pending",
            "payment_method": null
        },
        {
            "id": 124,
            "loan_id": 42,
            "amount": 166.67,
            "due_date": "2024-05-21",
            "status": "pending",
            "payment_method": null
        }
    ]
}
```

---

## 9. Recalculate Credit Score

Force a credit score recalculation (useful for testing or post-payment).

**Request**
```http
POST /bnpl/recalculate-score
```

**cURL**
```bash
curl -X POST \
  -H "Authorization: Bearer token" \
  http://localhost:8000/bnpl/recalculate-score
```

**Response**
```json
{
    "success": true,
    "new_score": 765,
    "message": "Credit score updated"
}
```

---

## JavaScript Integration Example

```javascript
class BnplAPI {
    constructor(token) {
        this.token = token;
        this.baseURL = '/bnpl';
    }

    async checkEligibility() {
        const response = await fetch(`${this.baseURL}/check-eligibility`, {
            headers: { 'Authorization': `Bearer ${this.token}` }
        });
        return response.json();
    }

    async getCreditScore() {
        const response = await fetch(`${this.baseURL}/credit-score`, {
            headers: { 'Authorization': `Bearer ${this.token}` }
        });
        return response.json();
    }

    async createLoan(amount, months) {
        const response = await fetch(`${this.baseURL}/create-loan`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${this.token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ amount, tenure_months: months })
        });
        return response.json();
    }

    async makePayment(paymentId, amount, method = 'online') {
        const response = await fetch(`${this.baseURL}/make-payment`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${this.token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ payment_id: paymentId, amount, payment_method: method })
        });
        return response.json();
    }

    async getUpcomingPayments(limit = 5) {
        const response = await fetch(`${this.baseURL}/upcoming-payments?limit=${limit}`, {
            headers: { 'Authorization': `Bearer ${this.token}` }
        });
        return response.json();
    }

    async getPaymentHistory(limit = 10) {
        const response = await fetch(`${this.baseURL}/payment-history?limit=${limit}`, {
            headers: { 'Authorization': `Bearer ${this.token}` }
        });
        return response.json();
    }
}

// Usage
const api = new BnplAPI(userToken);

// Check eligibility before showing BNPL offer
const eligibility = await api.checkEligibility();
if (eligibility.eligible) {
    console.log(`User can borrow up to $${eligibility.available_limit}`);
}

// Create a loan
const loan = await api.createLoan(500, 3);
if (loan.success) {
    console.log(`Loan ${loan.loan_id} created!`);
}

// Show upcoming payments
const upcoming = await api.getUpcomingPayments(5);
upcoming.forEach(payment => {
    console.log(`${payment.due_date}: $${payment.amount}`);
});
```

---

## HTML Form Example

```html
<form id="bnpl-form">
    <input type="number" name="amount" placeholder="Loan amount" required>
    <select name="tenure_months" required>
        <option value="">Select tenure</option>
        <option value="1">1 Month</option>
        <option value="3">3 Months</option>
        <option value="6">6 Months</option>
        <option value="12">12 Months</option>
    </select>
    <button type="submit">Apply for BNPL</button>
</form>

<script>
document.getElementById('bnpl-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const amount = e.target.amount.value;
    const months = e.target.tenure_months.value;
    
    const response = await fetch('/bnpl/create-loan', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ amount, tenure_months: months })
    });
    
    const data = await response.json();
    
    if (data.success) {
        alert(`Loan #${data.loan_id} created successfully!`);
    } else {
        alert(`Error: ${data.message}`);
    }
});
</script>
```

---

## Error Handling

All endpoints return proper HTTP status codes:

```
200 OK          - Successful request
400 Bad Request - Validation error
403 Forbidden   - Access denied (not your loan)
404 Not Found   - Resource not found
500 Server Error - Internal error
```

Example error handling:

```javascript
async function handleBnplRequest(url, options = {}) {
    try {
        const response = await fetch(url, options);
        
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Request failed');
        }
        
        return await response.json();
    } catch (error) {
        console.error('BNPL Error:', error.message);
        // Show user-friendly error message
        return null;
    }
}
```

---

## Testing Workflow

1. **Check Eligibility**
   ```
   GET /bnpl/check-eligibility → eligible: true
   ```

2. **Get Credit Details**
   ```
   GET /bnpl/credit-score → score: 750, limit: $5000
   ```

3. **Create Loan**
   ```
   POST /bnpl/create-loan → loan_id: 42
   ```

4. **View Upcoming Payments**
   ```
   GET /bnpl/upcoming-payments → 3 payments, first due in 30 days
   ```

5. **Make Payment**
   ```
   POST /bnpl/make-payment → success: true
   ```

6. **Check Updated Score**
   ```
   GET /bnpl/credit-score → score: 765 (improved!)
   ```

---

**API Version**: 1.0  
**Last Updated**: March 2024
