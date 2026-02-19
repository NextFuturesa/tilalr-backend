<?php

namespace App\Console\Commands;

use App\Services\NDCService;
use Illuminate\Console\Command;
use Exception;

class NDCCheckBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ndc:check-balance 
                            {--json : Output as JSON}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check NDC agency balance';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $ndcService = app(NDCService::class);
            
            if (!$this->option('json')) {
                $this->info('Checking NDC Agency Balance...');
                $this->newLine();
            }

            $balance = $ndcService->getAgencyBalance();

            if ($this->option('json')) {
                $this->line(json_encode($balance, JSON_PRETTY_PRINT));
                return self::SUCCESS;
            }

            $this->info('Agency Balance Information:');
            $this->newLine();

            if (isset($balance['TopupBalance'])) {
                $amount = $balance['TopupBalance']['amount'];
                $currency = $balance['TopupBalance']['currency'];
                $this->line('  💰 Topup Balance: ' . number_format($amount, 2) . ' ' . $currency);
            }

            if (isset($balance['WalletAmount'])) {
                $amount = $balance['WalletAmount']['amount'];
                $currency = $balance['WalletAmount']['currency'];
                $this->line('  💳 Wallet Amount: ' . number_format($amount, 2) . ' ' . $currency);
            }

            if (isset($balance['CreditLimitBalance'])) {
                $amount = $balance['CreditLimitBalance']['amount'];
                $currency = $balance['CreditLimitBalance']['currency'];
                $this->line('  💎 Credit Limit: ' . number_format($amount, 2) . ' ' . $currency);
            }

            if (isset($balance['OdeysysOs'])) {
                $amount = $balance['OdeysysOs']['amount'];
                $currency = $balance['OdeysysOs']['currency'];
                $this->line('  📊 Odeysys OS: ' . number_format($amount, 2) . ' ' . $currency);
            }

            $this->newLine();

            if (isset($balance['IsBlocked'])) {
                if ($balance['IsBlocked']) {
                    $this->error('  ⚠️  Account Status: BLOCKED');
                    $this->warn('     Please contact Wonder Travel support');
                } else {
                    $this->info('  ✓ Account Status: Active');
                }
            }

            return self::SUCCESS;

        } catch (Exception $e) {
            if ($this->option('json')) {
                $this->line(json_encode([
                    'error' => true,
                    'message' => $e->getMessage(),
                ], JSON_PRETTY_PRINT));
            } else {
                $this->error('❌ Failed to retrieve balance');
                $this->line('   Error: ' . $e->getMessage());
            }

            return self::FAILURE;
        }
    }
}
