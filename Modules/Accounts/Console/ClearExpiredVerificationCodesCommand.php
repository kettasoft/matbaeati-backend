<?php

namespace Modules\Accounts\Console;

use Illuminate\Console\Command;
use Modules\Accounts\Entities\Verification;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearExpiredVerificationCodesCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'verification:clear-expired-verification-codes';

    /**
     * The console command description.
     */
    protected $description = 'Clear expired verification codes.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Verification::where('expired_at', '<', now())->delete();
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
