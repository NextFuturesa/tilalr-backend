<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NDCService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Exception;

class NDCFlightController extends Controller
{
    protected NDCService $ndcService;

    public function __construct(NDCService $ndcService)
    {
        $this->ndcService = $ndcService;
    }

    /**
     * Search for available flights
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function searchFlights(Request $request): JsonResponse
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'searchCriteria' => 'required|array|min:1',
            'searchCriteria.*.origin' => 'required|string|size:3',
            'searchCriteria.*.destination' => 'required|string|size:3',
            'searchCriteria.*.departureDate' => 'required|date|after:today',
            'passengers' => 'required|array|min:1',
            'passengers.*.passengerTypeCode' => 'required|in:ADT,CHD,INF',
            'passengers.*.numberOfPassengers' => 'required|integer|min:1',
            'cabinClass' => 'sometimes|in:Economy,PremiumEconomy,Business,First',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->searchFlights(
                $request->input('searchCriteria'),
                $request->input('passengers'),
                $request->only(['cabinClass'])
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Confirm fare for selected offer
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function confirmFare(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'searchResponseId' => 'required|string',
            'offerId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->confirmFare(
                $request->input('searchResponseId'),
                $request->input('offerId')
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Get available bundles for an offer
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getAvailableBundles(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'offerId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->getAvailableBundles(
                $request->input('offerId')
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Add passenger details to booking
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function addPassengerDetails(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'offerId' => 'required|string',
            'passengers' => 'required|array|min:1',
            'passengers.*.title' => 'required|in:Mr,Mrs,Ms,Miss,Dr',
            'passengers.*.firstName' => 'required|string|max:100',
            'passengers.*.middleName' => 'nullable|string|max:100',
            'passengers.*.lastName' => 'required|string|max:100',
            'passengers.*.gender' => 'required|in:Male,Female',
            'passengers.*.birthDate' => 'required|date|before:today',
            'passengers.*.passengerTypeCode' => 'required|in:ADT,CHD,INF',
            'passengers.*.nationalityCountryCode' => 'required|string|size:2',
            'passengers.*.residenceCountryCode' => 'required|string|size:2',
            'contactInfo' => 'required|array',
            'contactInfo.email' => 'required|email',
            'contactInfo.phoneNumber' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->addPassengerDetails(
                $request->input('offerId'),
                $request->input('passengers'),
                $request->input('contactInfo')
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Book a flight (finalize booking)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function bookFlight(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'offerId' => 'required|string',
            'paymentInfo' => 'sometimes|array',
            'bundles' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->bookFlight(
                $request->input('offerId'),
                $request->input('paymentInfo', []),
                $request->input('bundles', [])
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Hold a booking (reserve without payment)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function holdBooking(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'offerId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->holdBooking(
                $request->input('offerId')
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Book after hold (complete payment)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function bookAfterHold(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ndcBookingReference' => 'required|string',
            'paymentInfo' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->bookAfterHold(
                $request->input('ndcBookingReference'),
                $request->input('paymentInfo', [])
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Retrieve booking details
     * 
     * @param string $reference
     * @return JsonResponse
     */
    public function retrieveBooking(string $reference): JsonResponse
    {
        try {
            $result = $this->ndcService->retrieveBooking($reference);

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Reconfirm fare after hold
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function fareConfirmAfterHold(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ndcBookingReference' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $result = $this->ndcService->fareConfirmAfterHold(
                $request->input('ndcBookingReference')
            );

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Get agency balance
     * 
     * @return JsonResponse
     */
    public function getAgencyBalance(): JsonResponse
    {
        try {
            $result = $this->ndcService->getAgencyBalance();

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Test API connection
     * 
     * @return JsonResponse
     */
    public function testConnection(): JsonResponse
    {
        try {
            $result = $this->ndcService->testConnection();

            return response()->json($result);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Handle exceptions and return appropriate response
     * 
     * @param Exception $e
     * @return JsonResponse
     */
    protected function handleException(Exception $e): JsonResponse
    {
        $statusCode = $e->getCode() ?: 500;
        
        // Ensure valid HTTP status code
        if ($statusCode < 100 || $statusCode > 599) {
            $statusCode = 500;
        }

        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'statusCode' => $statusCode,
            'timestamp' => now()->toISOString(),
        ], $statusCode);
    }
}
