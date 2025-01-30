<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClearSessions extends Command
{
    protected $signature = 'session:clear';

    protected $description = 'Clear all sessions';

    public function handle()
    {
        // Clear file-based sessions
        if (config('session.driver') === 'file') {
            Storage::disk('sessions')->delete(Storage::disk('sessions')->files());
            $this->info('File-based sessions cleared.');
        }

        // Clear database sessions
        if (config('session.driver') === 'database') {
            DB::table('sessions')->truncate();
            $this->info('Database sessions cleared.');
        }

        // Clear Redis sessions
        if (config('session.driver') === 'redis') {
            \Redis::flushdb();
            $this->info('Redis sessions cleared.');
        }

        $this->info('All sessions cleared successfully.');
    }
}
