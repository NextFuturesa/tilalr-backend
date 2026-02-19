# NDC API Examples and Testing Guide

This document provides practical examples for testing the NDC Wonder Travel API integration on your localhost.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Configuration](#configuration)
3. [API Testing Examples](#api-testing-examples)
4. [Common Use Cases](#common-use-cases)
5. [Troubleshooting](#troubleshooting)

## Prerequisites

Before testing the API, ensure you have:

1. **Laravel Server Running**
   ```bash
   php artisan serve
   ```
   API will be available at: `http://localhost:8000`

2. **NDC API Credentials Configured**
   - Copy `.env.example` to `.env` (if not already done)
   - Set your NDC API credentials in `.env`:
     ```env
     NDC_ENABLED=true
     NDC_SANDBOX_MODE=true
     NDC_API_KEY=your_subscription_key_here
     ```

3. **Testing Tools**
   - Postman, Insomnia, or cURL
   - Or use provided Postman collection from Wonder Travel

## Configuration

### Step 1: Update Environment Variables

Edit your `.env` file:

```env
# Enable NDC Integration
NDC_ENABLED=true
NDC_SANDBOX_MODE=true

# API Credentials (get these from Wonder Travel)
NDC_API_BASE_URL=https://sandbox.ndceg.com/api
NDC_API_KEY=your_actual_api_key_here

# Agency Information
NDC_AGENCY_CODE=your_agency_code
NDC_AGENCY_NAME="Al Tilal & Al Rimmal"
NDC_AGENCY_EMAIL=omaqbool3@hotmail.com

# Developer Information
NDC_DEVELOPER_EMAIL=yousef@nextfuturetech.net
```

### Step 2: Clear Configuration Cache

```bash
php artisan config:clear
php artisan cache:clear
```

### Step 3: Test Connection

```bash
curl http://localhost:8000/api/ndc/test-connection
```

Expected response:
```json
{
  "success": true,
  "message": "Successfully connected to NDC API",
  "sandbox_mode": true,
  "balance": {
    "TopupBalance": {
      "amount": 7858.95,
      "currency": "EGP"
    }
  }
}
```

## API Testing Examples

### 1. Test API Connection

**Endpoint:** `GET /api/ndc/test-connection`

**cURL:**
```bash
curl -X GET http://localhost:8000/api/ndc/test-connection \
  -H "Accept: application/json"
```

### 2. Search for Flights

**Endpoint:** `POST /api/ndc/search-flights`

**cURL:**
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
    ],
    "cabinClass": "Economy"
  }'
```

### 3. Confirm Fare

**Endpoint:** `POST /api/ndc/confirm-fare`

**cURL:**
```bash
curl -X POST http://localhost:8000/api/ndc/confirm-fare \
  -H "Content-Type: application/json" \
  -d '{
    "searchResponseId": "YOUR_SEARCH_RESPONSE_ID",
    "offerId": "YOUR_OFFER_ID"
  }'
```

### 4. Add Passenger Details

**Endpoint:** `POST /api/ndc/add-passengers`

**cURL:**
```bash
curl -X POST http://localhost:8000/api/ndc/add-passengers \
  -H "Content-Type: application/json" \
  -d '{
    "offerId": "OFFER-CONFIRMED-002",
    "passengers": [
      {
        "title": "Mr",
        "firstName": "Omar",
        "lastName": "Maqbool",
        "gender": "Male",
        "birthDate": "1990-05-15",
        "passengerTypeCode": "ADT",
        "nationalityCountryCode": "SA",
        "residenceCountryCode": "SA"
      }
    ],
    "contactInfo": {
      "email": "omaqbool3@hotmail.com",
      "phoneNumber": "+966533331556"
    }
  }'
```

### 5. Book Flight

**Endpoint:** `POST /api/ndc/book`

**cURL:**
```bash
curl -X POST http://localhost:8000/api/ndc/book \
  -H "Content-Type: application/json" \
  -d '{
    "offerId": "OFFER-WITH-PASSENGERS-003"
  }'
```

## Common Use Cases

### Use Case 1: Complete Booking Flow

```bash
# Step 1: Search flights
# Step 2: Confirm fare  
# Step 3: Add passengers
# Step 4: Book
```

### Use Case 2: Hold & Book Later

```bash
# Steps 1-3: Same as above
# Step 4: Hold booking
# Later: Reconfirm fare
# Finally: Book after hold
```

## Troubleshooting

### "NDC API key is not configured"
Check your `.env` file and clear config cache.

### "401 Unauthorized"
Verify your API key is correct.

### "409 No Available Offers"
Try different dates or routes.

## Common Airport Codes

- CAI - Cairo, Egypt
- RUH - Riyadh, Saudi Arabia
- JED - Jeddah, Saudi Arabia
- DXB - Dubai, UAE

## Support

Contact: coordination@wondertravel-eg.com
