<?php

return [

    /*
    |--------------------------------------------------------------------------
    | NDC Wonder Travel API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for NDC Portal APIs integration with Wonder Travel.
    | These settings control the connection to the NDC API endpoints.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | API Connection Settings
    |--------------------------------------------------------------------------
    */

    // Enable/disable NDC integration
    'enabled' => env('NDC_ENABLED', false),

    // Sandbox mode (true = testing, false = production)
    'sandbox_mode' => env('NDC_SANDBOX_MODE', true),

    // API Base URL (sandbox or production)
    'api_base_url' => env('NDC_API_BASE_URL', 'https://sandbox.ndceg.com/api'),

    // Production API URL
    'production_url' => env('NDC_PRODUCTION_URL', 'https://api.ndceg.com/api'),

    // API Subscription Key (Ocp-Apim-Subscription-Key header)
    'api_key' => env('NDC_API_KEY', ''),

    // API request timeout in seconds
    'timeout' => env('NDC_API_TIMEOUT', 30),

    // Number of retry attempts for failed requests
    'retry_times' => env('NDC_API_RETRY_TIMES', 2),

    // Delay between retries in milliseconds
    'retry_delay' => env('NDC_API_RETRY_DELAY', 1000),

    /*
    |--------------------------------------------------------------------------
    | Agency Information
    |--------------------------------------------------------------------------
    */

    'agency' => [
        'code' => env('NDC_AGENCY_CODE', ''),
        'name' => env('NDC_AGENCY_NAME', 'Al Tilal & Al Rimmal'),
        'email' => env('NDC_AGENCY_EMAIL', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Developer Information
    |--------------------------------------------------------------------------
    */

    'developer' => [
        'email' => env('NDC_DEVELOPER_EMAIL', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    */

    'endpoints' => [
        // Flight Search & Offers
        'search_flights' => '/Flight/GetAvailableOffers',
        'fare_confirm' => '/Flight/FareConfirm',
        'get_bundles' => '/Flight/GetOfferAvailableBundles',

        // Order Management
        'add_passengers' => '/Order/AddPassengerDetails',
        'book' => '/Order/Book',
        'hold' => '/Order/Hold',
        'book_after_hold' => '/Order/BookAfterHold',
        'retrieve_booking' => '/Order/RetrieveAttributes',
        'fare_confirm_after_hold' => '/Order/FareConfirmAfterHold',

        // Agency Management
        'agency_balance' => '/Agency/AgencyBalance',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Values
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        // Default currency
        'currency' => env('NDC_DEFAULT_CURRENCY', 'EGP'),

        // Default cabin class
        'cabin_class' => env('NDC_DEFAULT_CABIN', 'Economy'),

        // Hold expiration time in minutes
        'hold_expiration_minutes' => env('NDC_HOLD_EXPIRATION', 60),

        // Offer validity in minutes
        'offer_validity_minutes' => env('NDC_OFFER_VALIDITY', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Passenger Type Codes
    |--------------------------------------------------------------------------
    */

    'passenger_types' => [
        'ADT' => 'Adult',       // 12+ years
        'CHD' => 'Child',       // 2-11 years
        'INF' => 'Infant',      // 0-2 years
    ],

    /*
    |--------------------------------------------------------------------------
    | Cabin Classes
    |--------------------------------------------------------------------------
    */

    'cabin_classes' => [
        'Economy',
        'PremiumEconomy',
        'Business',
        'First',
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    */

    'logging' => [
        // Enable detailed API request/response logging
        'enabled' => env('NDC_LOGGING_ENABLED', true),

        // Log channel to use
        'channel' => env('NDC_LOG_CHANNEL', 'stack'),

        // Log level (debug, info, warning, error)
        'level' => env('NDC_LOG_LEVEL', 'info'),

        // Log API requests
        'log_requests' => env('NDC_LOG_REQUESTS', true),

        // Log API responses
        'log_responses' => env('NDC_LOG_RESPONSES', true),

        // Mask sensitive data in logs
        'mask_sensitive' => env('NDC_MASK_SENSITIVE', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Handling
    |--------------------------------------------------------------------------
    */

    'errors' => [
        // Throw exceptions on API errors
        'throw_exceptions' => env('NDC_THROW_EXCEPTIONS', true),

        // Notification email for critical errors
        'notification_email' => env('NDC_ERROR_NOTIFICATION_EMAIL', ''),

        // Retry on specific HTTP status codes
        'retry_on_status' => [429, 500, 502, 503, 504],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    */

    'cache' => [
        // Enable caching of API responses
        'enabled' => env('NDC_CACHE_ENABLED', false),

        // Cache TTL in seconds
        'ttl' => env('NDC_CACHE_TTL', 300),

        // Cache key prefix
        'prefix' => env('NDC_CACHE_PREFIX', 'ndc_'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    */

    'rate_limiting' => [
        // Maximum requests per minute (sandbox)
        'sandbox_max_per_minute' => env('NDC_SANDBOX_RATE_LIMIT', 60),

        // Maximum requests per minute (production)
        'production_max_per_minute' => env('NDC_PRODUCTION_RATE_LIMIT', 300),
    ],

    /*
    |--------------------------------------------------------------------------
    | Testing & Development
    |--------------------------------------------------------------------------
    */

    'testing' => [
        // Use mock responses in tests
        'use_mocks' => env('NDC_USE_MOCKS', false),

        // Mock data directory
        'mock_data_path' => storage_path('app/ndc/mocks'),

        // Test IATA codes
        'test_origin' => env('NDC_TEST_ORIGIN', 'CAI'),      // Cairo
        'test_destination' => env('NDC_TEST_DESTINATION', 'RUH'),  // Riyadh
    ],

];
