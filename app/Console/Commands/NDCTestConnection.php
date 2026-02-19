<?php

namespace App\Console\Commands;

use App\Services\NDCService;
use Illuminate\Console\Command;
use Exception;

class NDCTestConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ndc:test-connection 
                            {--debug : Show detailed debug information}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test connection to NDC Wonder Travel API';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Testing NDC API Connection...');
        $this->newLine();

        // Check if NDC is enabled
        if (!config('ndc.enabled')) {
            $this->warn('⚠️  NDC integration is DISABLED in configuration');
            $this->info('   Set NDC_ENABLED=true in your .env file');
            return self::FAILURE;
        }

        // Check API key
        $apiKey = config('ndc.api_key');
        if (empty($apiKey)) {
            $this->error('❌ NDC API key is not configured');
            $this->info('   Set NDC_API_KEY in your .env file');
            return self::FAILURE;
        }

        $this->info('Configuration:');
        $this->line('  Base URL: ' . config('ndc.api_base_url'));
        $this->line('  Sandbox Mode: ' . (config('ndc.sandbox_mode') ? 'YES' : 'NO'));
        $this->line('  API Key: ' . substr($apiKey, 0, 8) . '...' . substr($apiKey, -4));
        $this->newLine();

        try {
            $ndcService = app(NDCService::class);
            
            $this->info('Attempting to connect...');
            
            $result = $ndcService->testConnection();

            if ($result['success']) {
                $this->info('✓ Successfully connected to NDC API!');
                $this->newLine();

                if (isset($result['balance'])) {
                    $this->info('Agency Balance:');
                    $balance = $result['balance'];
                    
                    if (isset($balance['TopupBalance'])) {
                        $this->line('  Topup Balance: ' . 
                            $balance['TopupBalance']['amount'] . ' ' . 
                            $balance['TopupBalance']['currency']);
                    }
                    
                    if (isset($balance['WalletAmount'])) {
                        $this->line('  Wallet Amount: ' . 
                            $balance['WalletAmount']['amount'] . ' ' . 
                            $balance['WalletAmount']['currency']);
                    }

                    if (isset($balance['IsBlocked'])) {
                        $blocked = $balance['IsBlocked'];
                        if ($blocked) {
                            $this->warn('  ⚠️  Account Status: BLOCKED');
                        } else {
                            $this->info('  ✓ Account Status: Active');
                        }
                    }
                }

                if ($this->option('debug')) {
                    $this->newLine();
                    $this->info('Full Response:');
                    $this->line(json_encode($result, JSON_PRETTY_PRINT));
                }

                return self::SUCCESS;
            } else {
                $this->error('❌ Failed to connect to NDC API');
                $this->line('   Error: ' . ($result['message'] ?? 'Unknown error'));
                
                if (isset($result['error']) && $this->option('debug')) {
                    $this->newLine();
                    $this->error('Debug Information:');
                    $this->line(json_encode($result, JSON_PRETTY_PRINT));
                }
                
                return self::FAILURE;
            }

        } catch (Exception $e) {
            $this->error('❌ Exception occurred:');
            $this->line('   ' . $e->getMessage());

            if ($this->option('debug')) {
                $this->newLine();
                $this->error('Stack Trace:');
                $this->line($e->getTraceAsString());
            }

            return self::FAILURE;
        }
    }
}
