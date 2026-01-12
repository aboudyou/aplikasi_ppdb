<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ShowEmailLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:log {--clear : Clear the email log after showing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show email log for debugging email notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');

        if (!file_exists($logPath)) {
            $this->error('Log file not found!');
            return;
        }

        $logContent = file_get_contents($logPath);
        $emailLogs = [];

        // Extract email-related log entries
        $lines = explode("\n", $logContent);
        foreach ($lines as $line) {
            if (strpos($line, 'mail') !== false || strpos($line, 'Mail') !== false) {
                $emailLogs[] = $line;
            }
        }

        if (empty($emailLogs)) {
            $this->info('No email logs found.');
            return;
        }

        $this->info('📧 Email Logs:');
        $this->line('================');

        foreach (array_slice($emailLogs, -10) as $log) { // Show last 10 entries
            $this->line($log);
        }

        if ($this->option('clear')) {
            file_put_contents($logPath, '');
            $this->info('Email log cleared!');
        }

        $this->line('');
        $this->comment('💡 Tip: Use --clear to clear logs after viewing');
        $this->comment('💡 Email notifications are working if you see "Queued" or "Sent" messages');
    }
}
