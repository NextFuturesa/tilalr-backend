# Tilalr Backend - Flight Booking System

Al Tilal & Al Rimmal Travel Organization Company - Backend API System

## Overview

This is a Laravel-based backend system for managing travel bookings, with integration to NDC Wonder Travel Portal APIs for real-time flight booking.

## Technology Stack

- **Framework**: Laravel 12
- **PHP**: 8.2+
- **Admin Panel**: Filament 3
- **Database**: SQLite (development) / MySQL (production)
- **Payment**: Stripe
- **SMS**: Taqnyat (Saudi Arabia)
- **HTTP Client**: Guzzle
- **API Standard**: NDC (New Distribution Capability) via Wonder Travel

## Quick Start - Local Development

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (default) or MySQL

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd tilalr-backend
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
   - For SQLite (default):
     ```bash
     touch database/database.sqlite
     ```
   - For MySQL: Update `.env` with your database credentials

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed Sample Data** (optional)
   ```bash
   php artisan db:seed
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```
   
   The API will be available at: `http://localhost:8000`

### Admin Panel Access

Access Filament admin panel at: `http://localhost:8000/admin`

## NDC Wonder Travel API Integration

### Overview

This system integrates with NDC Wonder Travel Portal APIs for real-time flight search, booking, and management.

### Getting Started with NDC APIs

#### 1. API Credentials Setup

After completing your contract with Wonder Travel, you'll receive:
- API Base URL (Sandbox for testing, Production for live)
- Subscription Key (API Key)
- Developer Email
- Postman Collection URL

#### 2. Configure Environment Variables

Add the following to your `.env` file:

```env
# NDC Wonder Travel API Configuration
NDC_API_BASE_URL=https://sandbox.ndceg.com/api  # Or production URL
NDC_API_KEY=your_subscription_key_here
NDC_API_TIMEOUT=30
NDC_API_RETRY_TIMES=2

# Agency Details (provided by Wonder Travel)
NDC_AGENCY_CODE=your_agency_code
NDC_AGENCY_NAME="Al Tilal & Al Rimmal"
NDC_AGENCY_EMAIL=omaqbool3@hotmail.com
NDC_DEVELOPER_EMAIL=yousef@nextfuturetech.net

# Enable/Disable NDC Integration
NDC_ENABLED=true
NDC_SANDBOX_MODE=true  # Set to false for production
```

#### 3. Testing API Connection

```bash
# Test API health
php artisan ndc:test-connection

# Check agency balance
php artisan ndc:check-balance
```

### Available NDC Endpoints

The system implements the following NDC API operations:

#### Flight Search & Booking Flow

1. **Search Available Offers** - `POST /api/ndc/search-flights`
   - Search for available flights based on origin, destination, dates, passengers
   - Returns list of available offers with prices

2. **Fare Confirmation** - `POST /api/ndc/confirm-fare`
   - Confirms current fare prices before proceeding
   - Validates offer is still available

3. **Add Passenger Details** - `POST /api/ndc/add-passengers`
   - Attaches passenger information to the booking
   - Required before booking or holding

4. **Book Flight** - `POST /api/ndc/book`
   - Finalizes the booking with payment
   - Issues tickets and generates PNR

5. **Hold Booking** - `POST /api/ndc/hold`
   - Places booking on hold without payment
   - Reserves seats for a limited time

6. **Book After Hold** - `POST /api/ndc/book-after-hold`
   - Completes payment for a held booking
   - Converts hold to confirmed booking

7. **Retrieve Booking** - `GET /api/ndc/bookings/{reference}`
   - Retrieves full booking details
   - Shows passenger info, tickets, pricing

8. **Fare Confirm After Hold** - `POST /api/ndc/reconfirm-fare`
   - Revalidates fare before completing held booking

#### Agency Management

9. **Check Agency Balance** - `GET /api/ndc/agency/balance`
   - Check available wallet balance before booking

### Testing APIs Locally

#### Using Postman

1. **Import the Collection**
   - Download Postman collection from Wonder Travel
   - Import into Postman
   - Set up environment variables:
     - `base_url`: Your local URL or sandbox URL
     - `subscription_key`: Your API key

2. **Test Sequence for Direct Booking**
   ```
   1. POST /api/Flight/GetAvailableOffers
   2. POST /api/Flight/FareConfirm
   3. POST /api/Order/AddPassengerDetails
   4. POST /api/Order/Book
   ```

3. **Test Sequence for Hold & Book Later**
   ```
   1. POST /api/Flight/GetAvailableOffers
   2. POST /api/Flight/FareConfirm
   3. POST /api/Order/AddPassengerDetails
   4. POST /api/Order/Hold
   5. POST /api/Order/FareConfirmAfterHold
   6. POST /api/Order/BookAfterHold
   ```

#### Using cURL

Example: Search for flights
```bash
curl -X POST http://localhost:8000/api/ndc/search-flights \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "searchCriteria": [
      {
        "origin": "CAI",
        "destination": "RUH",
        "departureDate": "2026-03-15"
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

#### Using PHP/Laravel HTTP Client

```php
use Illuminate\Support\Facades\Http;

$response = Http::withHeaders([
    'Ocp-Apim-Subscription-Key' => config('ndc.api_key')
])
->post(config('ndc.api_base_url') . '/Flight/GetAvailableOffers', [
    'searchCriteria' => [
        [
            'origin' => 'CAI',
            'destination' => 'RUH',
            'departureDate' => '2026-03-15'
        ]
    ],
    'passengers' => [
        [
            'passengerTypeCode' => 'ADT',
            'numberOfPassengers' => 1
        ]
    ]
]);

$offers = $response->json();
```

### NDC API Response Structure

All NDC responses follow this structure:

**Success Response (200)**
```json
{
  "journeys": {...},
  "segments": {...},
  "offers": [...],
  "priceDetails": {...}
}
```

**Error Response (400/401/409/500)**
```json
{
  "correlationId": "uuid",
  "statusCode": 400,
  "message": "Error description",
  "timestamp": "2026-02-19T07:20:00Z"
}
```

### Understanding Key Concepts

#### Offer-Based Model
- Each search returns **offers** with locked pricing
- Offers expire after a short time
- Must confirm fare before booking

#### Passenger Types
- `ADT`: Adult (12+ years)
- `CHD`: Child (2-11 years)
- `INF`: Infant (0-2 years)

#### Booking References
- **NDC Booking Reference**: Main reference for all operations
- **Airline PNR**: Airline's reservation reference
- **GDS PNR**: GDS system reference (if applicable)

#### Hold vs Book
- **Hold**: Reserve without payment (time-limited)
- **Book**: Finalize with payment, issue tickets

### Common Development Scenarios

#### Scenario 1: Test Flight Search
```bash
# Set your API key in .env
NDC_API_KEY=your_key_here

# Use the test route
curl http://localhost:8000/api/ndc/test-search
```

#### Scenario 2: Debug API Responses
```bash
# Enable query logging
php artisan ndc:test --debug

# Check logs
tail -f storage/logs/laravel.log
```

#### Scenario 3: Test Payment Flow
```bash
# Use sandbox mode
NDC_SANDBOX_MODE=true

# Test booking won't charge real money
```

### Error Handling

Common errors and solutions:

| Error Code | Description | Solution |
|------------|-------------|----------|
| 401 | Invalid subscription key | Check NDC_API_KEY in .env |
| 400 | Bad request format | Validate request payload |
| 409 | No available offers | Try different dates/routes |
| 429 | Rate limit exceeded | Wait and retry |
| 500 | Server error | Check logs, contact support |

### Best Practices

1. **Always Check Balance First**
   ```php
   $balance = app(NDCService::class)->getAgencyBalance();
   if ($balance['TopupBalance']['amount'] < $requiredAmount) {
       // Insufficient funds
   }
   ```

2. **Validate Before Booking**
   - Always call FareConfirm before proceeding
   - Check offer availability before adding passengers

3. **Handle Errors Gracefully**
   - Log all API errors with correlation IDs
   - Show user-friendly messages
   - Retry transient failures

4. **Use Hold for Complex Bookings**
   - When collecting additional passenger info
   - When payment needs approval
   - When confirming with customers

5. **Test in Sandbox First**
   - Never test directly in production
   - Use sandbox for all development
   - Request production access only when ready

## API Documentation

### Public API Endpoints

Base URL: `http://localhost:8000/api`

#### Authentication
- `POST /register` - Register new user
- `POST /login` - Login user
- `POST /auth/send-otp` - Send OTP
- `POST /auth/verify-otp` - Verify OTP

#### Flights (Static Catalog)
- `GET /international/flights` - List all flights
- `GET /international/flights/{id}` - Get flight details

#### NDC Flight Booking (Real-time)
- `POST /ndc/search-flights` - Search real-time flights
- `POST /ndc/confirm-fare` - Confirm fare pricing
- `POST /ndc/add-passengers` - Add passenger details
- `POST /ndc/book` - Complete booking
- `POST /ndc/hold` - Hold booking
- `GET /ndc/bookings/{reference}` - Retrieve booking

See full API documentation in `/docs` folder.

## Development Workflow

### Running Tests
```bash
# Run all tests
composer test

# Run specific test file
php artisan test tests/Feature/NDCServiceTest.php
```

### Code Style
```bash
# Fix code style
./vendor/bin/pint
```

### Database Management
```bash
# Fresh migration with seed
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name
```

## Docker Support

```bash
# Start all services
./start-docker.sh

# Stop services
./stop-docker.sh
```

## Troubleshooting

### Issue: API Connection Failed
**Solution**: Check NDC_API_BASE_URL and network connectivity

### Issue: Invalid Subscription Key
**Solution**: Verify NDC_API_KEY in .env matches Wonder Travel provided key

### Issue: No Available Offers
**Solution**: Try different search dates, ensure routes are valid IATA codes

### Issue: Database Lock
**Solution**: Close all connections, restart php artisan serve

## Support & Resources

### Wonder Travel Documentation
- API Documentation: Provided in project folder
- Postman Collection: Available after onboarding
- Support Email: coordination@wondertravel-eg.com

### Project Contacts
- Project Manager: Essam Saady (esaady@wondertravel-eg.com)
- Client Contact: Omar Maqbool (omaqbool3@hotmail.com)
- Developer: yousef@nextfuturetech.net

### Important Links
- Wonder Travel Portal: https://www.ndceg.com
- API Sandbox: https://sandbox.ndceg.com
- Production API: https://api.ndceg.com

## Deployment

### Environment Setup
1. Set `APP_ENV=production`
2. Set `APP_DEBUG=false`
3. Configure production database
4. Set NDC_SANDBOX_MODE=false
5. Update NDC_API_BASE_URL to production URL

### Pre-deployment Checklist
- [ ] All tests passing
- [ ] Environment variables configured
- [ ] Database migrated
- [ ] API keys configured
- [ ] Balance sufficient in Wonder Travel account
- [ ] Error logging enabled
- [ ] Rate limiting configured

## License

MIT License - See LICENSE file for details.

## Additional Notes

### Kickoff Meeting
- **Date**: March 4, 2026
- **Time**: 1:00 PM Cairo Time
- **Preparation**: Review documentation and test APIs before meeting

### Development Timeline
- Phase 1: Local setup and API testing (Week 1-2)
- Phase 2: Integration implementation (Week 3-4)
- Phase 3: Testing and debugging (Week 5-6)
- Phase 4: Production deployment (Week 7-8)
