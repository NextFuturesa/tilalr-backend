# Quick Start Guide - NDC API Integration

**For: Software Engineers at Al Tilal & Al Rimmal**
**By: Development Team**
**Date: February 2026**

## What You Need to Know

You've completed the website frontend. Now you need to integrate with Wonder Travel's NDC APIs for **real flight booking**. This guide tells you exactly what to do.

## Step-by-Step: Testing on Localhost

### 1. Get Your API Credentials

Contact your manager to get from Wonder Travel:
- **Subscription Key** (API Key)
- **Agency Code**
- **Sandbox API URL**

You'll receive these after contract signing. For now, wait for kickoff meeting on **March 4, 2026**.

### 2. Setup Your Local Environment

```bash
# Navigate to project
cd tilalr-backend

# Copy environment file (if not done)
cp .env.example .env

# Install dependencies
composer install

# Generate app key
php artisan key:generate

# Setup database
touch database/database.sqlite
php artisan migrate

# Start server
php artisan serve
```

Your API is now running at: `http://localhost:8000`

### 3. Configure NDC API

Edit `.env` file and add:

```env
# Enable NDC Integration
NDC_ENABLED=true
NDC_SANDBOX_MODE=true

# API Credentials (you'll get these from Wonder Travel)
NDC_API_BASE_URL=https://sandbox.ndceg.com/api
NDC_API_KEY=paste_your_subscription_key_here

# Your Agency Info
NDC_AGENCY_CODE=your_agency_code
NDC_AGENCY_NAME="Al Tilal & Al Rimmal"
NDC_AGENCY_EMAIL=omaqbool3@hotmail.com
NDC_DEVELOPER_EMAIL=yousef@nextfuturetech.net
```

### 4. Test the Connection

```bash
# Clear config cache
php artisan config:clear

# Test NDC connection
php artisan ndc:test-connection

# Check agency balance
php artisan ndc:check-balance
```

**Expected Output:**
```
✓ Successfully connected to NDC API!

Agency Balance:
  Topup Balance: 7858.95 EGP
  Wallet Amount: 3012.10 EGP
  ✓ Account Status: Active
```

If this works, you're ready to test APIs! 🎉

### 5. Test Your First API Call

Open a new terminal and test:

```bash
curl -X GET http://localhost:8000/api/ndc/test-connection
```

Should return:
```json
{
  "success": true,
  "message": "Successfully connected to NDC API"
}
```

### 6. Search for Flights

```bash
curl -X POST http://localhost:8000/api/ndc/search-flights \
  -H "Content-Type: application/json" \
  -d '{
    "searchCriteria": [
      {
        "origin": "CAI",
        "destination": "RUH", 
        "departureDate": "2026-03-20"
      }
    ],
    "passengers": [
      {
        "passengerTypeCode": "ADT",
        "numberOfPassengers": 1
      }
    ]
  }'
```

This will return available flights from Cairo to Riyadh!

## Available Endpoints

All endpoints start with: `http://localhost:8000/api/ndc/`

| Endpoint | Method | Purpose |
|----------|--------|---------|
| `/test-connection` | GET | Test API is working |
| `/agency/balance` | GET | Check balance |
| `/search-flights` | POST | Search flights |
| `/confirm-fare` | POST | Confirm price |
| `/add-passengers` | POST | Add passenger info |
| `/book` | POST | Complete booking |
| `/hold` | POST | Hold booking |
| `/bookings/{ref}` | GET | Get booking details |

## Complete Booking Flow

```bash
# 1. Search Flights
POST /api/ndc/search-flights
# → Get: searchResponseId, offerId

# 2. Confirm Fare
POST /api/ndc/confirm-fare
# → Get: confirmedOfferId

# 3. Add Passengers
POST /api/ndc/add-passengers
# → Get: offerWithPassengersId

# 4. Book
POST /api/ndc/book
# → Get: ndcBookingReference, PNR
```

## Using Postman

1. Download Postman: https://www.postman.com/downloads/
2. Import collection from Wonder Travel (you'll get URL)
3. Set environment variable:
   - `base_url`: `http://localhost:8000/api`
4. Run requests one by one

## Important Notes for Frontend Integration

### When Calling from Your Website

```javascript
// Example: Search flights from your frontend
const searchFlights = async (origin, destination, date) => {
  const response = await fetch('http://localhost:8000/api/ndc/search-flights', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      searchCriteria: [{
        origin: origin,
        destination: destination,
        departureDate: date
      }],
      passengers: [{
        passengerTypeCode: 'ADT',
        numberOfPassengers: 1
      }]
    })
  });
  
  return await response.json();
};

// Usage
const flights = await searchFlights('CAI', 'RUH', '2026-03-20');
console.log(flights);
```

### CORS for Frontend

If you get CORS errors, update `config/cors.php`:

```php
'allowed_origins' => ['http://localhost:3000'], // Your frontend URL
```

## Common Issues & Solutions

### "NDC API key is not configured"
→ Add `NDC_API_KEY` to `.env` file
→ Run `php artisan config:clear`

### "401 Unauthorized"
→ Check your API key is correct
→ Verify key has no extra spaces

### "Connection timeout"
→ Check internet connection
→ Verify sandbox URL is correct

### "409 No Available Offers"
→ Try different dates (future dates)
→ Use valid airport codes (CAI, RUH, JED, DXB)

## Airport Codes Reference

Common airports you'll need:

**Saudi Arabia:**
- RUH - Riyadh
- JED - Jeddah
- DMM - Dammam
- MED - Medina

**Egypt:**
- CAI - Cairo
- HRG - Hurghada
- SSH - Sharm El Sheikh

**UAE:**
- DXB - Dubai
- AUH - Abu Dhabi

## Next Steps

1. ✅ **Setup local environment** (follow steps 1-5)
2. ✅ **Test all endpoints** with Postman/cURL
3. ✅ **Integrate with frontend** (your website)
4. ✅ **Test complete booking flow**
5. ✅ **Prepare questions** for kickoff meeting
6. ✅ **Attend kickoff** (March 4, 2026, 1:00 PM Cairo Time)

## Documentation Files

- `README.md` - Complete documentation
- `docs/NDC_API_EXAMPLES.md` - Detailed API examples
- `docs/QUICKSTART.md` - This file

## Testing Checklist

Before kickoff meeting:

- [ ] Environment configured
- [ ] API connection successful
- [ ] Can search flights
- [ ] Can confirm fare
- [ ] Can add passengers
- [ ] Can complete booking
- [ ] Tested with Postman
- [ ] Integrated with frontend (basic)
- [ ] Prepared questions

## Support

**Wonder Travel:**
- Email: coordination@wondertravel-eg.com
- Documentation: Check PDF provided

**Internal:**
- Manager: Omar Maqbool (omaqbool3@hotmail.com)
- Developer: yousef@nextfuturetech.net

## Important Dates

- **Contract Signed**: February 2026
- **Kickoff Meeting**: March 4, 2026 @ 1:00 PM Cairo Time
- **Must Review Before Meeting**:
  - API Documentation (PDF)
  - Postman Collection
  - This guide

## What to Ask in Kickoff Meeting

Prepare these questions:

1. How to handle payment in sandbox vs production?
2. Rate limits for API calls?
3. How to test different scenarios (cancellations, refunds)?
4. SLA for production support?
5. Migration plan from sandbox to production?
6. Any specific security requirements?

Good luck! 🚀
