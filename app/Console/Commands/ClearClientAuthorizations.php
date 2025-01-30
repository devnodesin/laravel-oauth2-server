<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class ClearClientAuthorizations extends Command
{
    protected $signature = 'token:clear';

    protected $description = 'Clear all OAuth client authorizations';

    public function handle()
    {
        if (! $this->confirm('Are you sure you want to clear all client authorizations?')) {
            $this->info('Command cancelled.');

            return;
        }

        // Count before clearing
        $tokenCount = Token::where('revoked', false)->count();
        $refreshCount = RefreshToken::where('revoked', false)->count();

        // Revoke all access tokens
        Token::where('revoked', false)
            ->update(['revoked' => true]);

        // Revoke all refresh tokens
        RefreshToken::where('revoked', false)
            ->update(['revoked' => true]);

        $this->info("Cleared {$tokenCount} access tokens and {$refreshCount} refresh tokens.");
    }
}
