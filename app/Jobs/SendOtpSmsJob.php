<?php

namespace App\Jobs;

use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * Send OTP SMS in the background (queued job)
 * Prevents blocking the HTTP response while waiting for Taqnyat API
 */
class SendOtpSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $phone;
    protected string $message;

    public function __construct(string $phone, string $message)
    {
        $this->phone = $phone;
        $this->message = $message;
        
        // Run immediately in 'sync' queue mode, or in background with 'database' queue
        $this->onQueue('default');
    }

    public function handle(SmsService $smsService)
    {
        try {
            $result = $smsService->send($this->phone, $this->message);
            
            if ($result) {
                Log::info('OTP SMS job completed successfully', [
                    'phone' => $this->phone,
                ]);
            } else {
                Log::warning('OTP SMS job failed', [
                    'phone' => $this->phone,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('OTP SMS job exception', [
                'phone' => $this->phone,
                'error' => $e->getMessage(),
            ]);
            
            // Re-throw to mark job as failed
            throw $e;
        }
    }
}
