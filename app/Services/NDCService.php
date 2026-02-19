<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class NDCService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected int $timeout;
    protected int $retryTimes;
    protected int $retryDelay;
    protected bool $sandboxMode;
    protected bool $loggingEnabled;

    public function __construct()
    {
        $this->baseUrl = config('ndc.api_base_url');
        $this->apiKey = config('ndc.api_key');
        $this->timeout = config('ndc.timeout', 30);
        $this->retryTimes = config('ndc.retry_times', 2);
        $this->retryDelay = config('ndc.retry_delay', 1000);
        $this->sandboxMode = config('ndc.sandbox_mode', true);
        $this->loggingEnabled = config('ndc.logging.enabled', true);

        // Validate configuration
        if (empty($this->apiKey)) {
            throw new Exception('NDC API key is not configured. Please set NDC_API_KEY in your .env file.');
        }
    }

    /**
     * Search for available flight offers
     *
     * @param array $searchCriteria
     * @param array $passengers
     * @param array $options
     * @return array
     */
    public function searchFlights(array $searchCriteria, array $passengers, array $options = []): array
    {
        $payload = [
            'searchCriteria' => $searchCriteria,
            'passengers' => $passengers,
        ];

        // Add optional parameters
        if (isset($options['cabinClass'])) {
            $payload['cabinClass'] = $options['cabinClass'];
        }

        return $this->makeRequest('POST', config('ndc.endpoints.search_flights'), $payload);
    }

    /**
     * Confirm fare for a selected offer
     *
     * @param string $searchResponseId
     * @param string $offerId
     * @return array
     */
    public function confirmFare(string $searchResponseId, string $offerId): array
    {
        $payload = [
            'searchResponseId' => $searchResponseId,
            'offerId' => $offerId,
        ];

        return $this->makeRequest('POST', config('ndc.endpoints.fare_confirm'), $payload);
    }

    /**
     * Get available bundles for an offer
     *
     * @param string $offerId
     * @return array
     */
    public function getAvailableBundles(string $offerId): array
    {
        $payload = [
            'offerId' => $offerId,
        ];

        return $this->makeRequest('POST', config('ndc.endpoints.get_bundles'), $payload);
    }

    /**
     * Add passenger details to a booking
     *
     * @param string $offerId
     * @param array $passengers
     * @param array $contactInfo
     * @return array
     */
    public function addPassengerDetails(string $offerId, array $passengers, array $contactInfo): array
    {
        $payload = [
            'offerId' => $offerId,
            'passengers' => $passengers,
            'contactInfo' => $contactInfo,
        ];

        return $this->makeRequest('POST', config('ndc.endpoints.add_passengers'), $payload);
    }

    /**
     * Book a flight (finalize booking with payment)
     *
     * @param string $offerId
     * @param array $paymentInfo
     * @param array $bundles (optional)
     * @return array
     */
    public function bookFlight(string $offerId, array $paymentInfo = [], array $bundles = []): array
    {
        $payload = [
            'offerId' => $offerId,
        ];

        if (!empty($paymentInfo)) {
            $payload['paymentInfo'] = $paymentInfo;
        }

        if (!empty($bundles)) {
            $payload['bundles'] = $bundles;
        }

        return $this->makeRequest('POST', config('ndc.endpoints.book'), $payload);
    }

    /**
     * Hold a booking (reserve without payment)
     *
     * @param string $offerId
     * @return array
     */
    public function holdBooking(string $offerId): array
    {
        $payload = [
            'offerId' => $offerId,
        ];

        return $this->makeRequest('POST', config('ndc.endpoints.hold'), $payload);
    }

    /**
     * Book after hold (complete payment for held booking)
     *
     * @param string $ndcBookingReference
     * @param array $paymentInfo
     * @return array
     */
    public function bookAfterHold(string $ndcBookingReference, array $paymentInfo = []): array
    {
        $payload = [
            'ndcBookingReference' => $ndcBookingReference,
        ];

        if (!empty($paymentInfo)) {
            $payload['paymentInfo'] = $paymentInfo;
        }

        return $this->makeRequest('POST', config('ndc.endpoints.book_after_hold'), $payload);
    }

    /**
     * Retrieve booking details
     *
     * @param string $ndcBookingReference
     * @return array
     */
    public function retrieveBooking(string $ndcBookingReference): array
    {
        $payload = [
            'ndcBookingReference' => $ndcBookingReference,
        ];

        return $this->makeRequest('POST', config('ndc.endpoints.retrieve_booking'), $payload);
    }

    /**
     * Reconfirm fare after hold
     *
     * @param string $ndcBookingReference
     * @return array
     */
    public function fareConfirmAfterHold(string $ndcBookingReference): array
    {
        $payload = [
            'ndcBookingReference' => $ndcBookingReference,
        ];

        return $this->makeRequest('POST', config('ndc.endpoints.fare_confirm_after_hold'), $payload);
    }

    /**
     * Get agency balance
     *
     * @return array
     */
    public function getAgencyBalance(): array
    {
        return $this->makeRequest('GET', config('ndc.endpoints.agency_balance'));
    }

    /**
     * Make HTTP request to NDC API
     *
     * @param string $method
     * @param string $endpoint
     * @param array $payload
     * @return array
     */
    protected function makeRequest(string $method, string $endpoint, array $payload = []): array
    {
        $url = $this->baseUrl . $endpoint;

        // Log request if enabled
        if ($this->loggingEnabled && config('ndc.logging.log_requests')) {
            $this->logRequest($method, $url, $payload);
        }

        try {
            // Build HTTP client with headers
            $request = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
                ->timeout($this->timeout)
                ->retry($this->retryTimes, $this->retryDelay, function ($exception, $request) {
                    // Only retry on specific status codes
                    $retryStatuses = config('ndc.errors.retry_on_status', [429, 500, 502, 503, 504]);
                    return $exception instanceof \Illuminate\Http\Client\RequestException 
                        && in_array($exception->response?->status(), $retryStatuses);
                });

            // Make request
            $response = match(strtoupper($method)) {
                'GET' => $request->get($url, $payload),
                'POST' => $request->post($url, $payload),
                'PUT' => $request->put($url, $payload),
                'DELETE' => $request->delete($url, $payload),
                default => throw new Exception("Unsupported HTTP method: $method"),
            };

            // Log response if enabled
            if ($this->loggingEnabled && config('ndc.logging.log_responses')) {
                $this->logResponse($response->status(), $response->json());
            }

            // Handle error responses
            if (!$response->successful()) {
                return $this->handleErrorResponse($response);
            }

            return $response->json();

        } catch (Exception $e) {
            $this->logError($e, $method, $url, $payload);

            if (config('ndc.errors.throw_exceptions', true)) {
                throw $e;
            }

            return [
                'error' => true,
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ];
        }
    }

    /**
     * Handle error responses from API
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array
     */
    protected function handleErrorResponse($response): array
    {
        $data = $response->json();
        
        $error = [
            'error' => true,
            'statusCode' => $response->status(),
            'message' => $data['message'] ?? 'Unknown error occurred',
            'correlationId' => $data['correlationId'] ?? null,
            'timestamp' => $data['timestamp'] ?? now()->toISOString(),
        ];

        // Log error
        Log::channel(config('ndc.logging.channel'))
            ->error('NDC API Error', $error);

        // Notify if critical error
        if (in_array($response->status(), [500, 502, 503, 504])) {
            $this->notifyCriticalError($error);
        }

        return $error;
    }

    /**
     * Log request details
     *
     * @param string $method
     * @param string $url
     * @param array $payload
     * @return void
     */
    protected function logRequest(string $method, string $url, array $payload): void
    {
        $maskedPayload = $this->maskSensitiveData($payload);

        Log::channel(config('ndc.logging.channel'))
            ->info('NDC API Request', [
                'method' => $method,
                'url' => $url,
                'payload' => $maskedPayload,
                'sandbox_mode' => $this->sandboxMode,
            ]);
    }

    /**
     * Log response details
     *
     * @param int $status
     * @param array $data
     * @return void
     */
    protected function logResponse(int $status, array $data): void
    {
        Log::channel(config('ndc.logging.channel'))
            ->info('NDC API Response', [
                'status' => $status,
                'data' => $data,
            ]);
    }

    /**
     * Log error details
     *
     * @param Exception $exception
     * @param string $method
     * @param string $url
     * @param array $payload
     * @return void
     */
    protected function logError(Exception $exception, string $method, string $url, array $payload): void
    {
        Log::channel(config('ndc.logging.channel'))
            ->error('NDC API Exception', [
                'method' => $method,
                'url' => $url,
                'payload' => $this->maskSensitiveData($payload),
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
    }

    /**
     * Mask sensitive data in logs
     *
     * @param array $data
     * @return array
     */
    protected function maskSensitiveData(array $data): array
    {
        if (!config('ndc.logging.mask_sensitive', true)) {
            return $data;
        }

        $sensitiveKeys = [
            'cardNumber',
            'cvv',
            'password',
            'apiKey',
            'subscriptionKey',
            'passportNumber',
            'travelDocumentNumber',
        ];

        array_walk_recursive($data, function (&$value, $key) use ($sensitiveKeys) {
            if (in_array($key, $sensitiveKeys)) {
                $value = '***MASKED***';
            }
        });

        return $data;
    }

    /**
     * Notify about critical errors
     *
     * @param array $error
     * @return void
     */
    protected function notifyCriticalError(array $error): void
    {
        $email = config('ndc.errors.notification_email');
        
        if (empty($email)) {
            return;
        }

        // TODO: Implement email notification
        // Mail::to($email)->send(new NDCCriticalErrorNotification($error));
    }

    /**
     * Test API connection
     *
     * @return array
     */
    public function testConnection(): array
    {
        try {
            $balance = $this->getAgencyBalance();
            
            return [
                'success' => true,
                'message' => 'Successfully connected to NDC API',
                'sandbox_mode' => $this->sandboxMode,
                'balance' => $balance,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to connect to NDC API',
                'error' => $e->getMessage(),
            ];
        }
    }
}
