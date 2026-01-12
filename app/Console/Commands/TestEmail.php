<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendaftaranBerhasilMail;
use App\Models\User;
use App\Models\GelombangPendaftaran;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email? : Email address to send test to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to verify email configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'test@example.com';

        $this->info("📧 Sending test email to: {$email}");

        try {
            // Create a dummy user and gelombang for testing
            $user = User::first() ?? User::factory()->create(['email' => $email]);
            $gelombang = GelombangPendaftaran::first() ?? GelombangPendaftaran::factory()->create();

            Mail::to($email)->send(new PendaftaranBerhasilMail($user, $gelombang));

            $this->info('✅ Test email sent successfully!');
            $this->comment('💡 Check the email log with: php artisan email:log');

        } catch (\Exception $e) {
            $this->error('❌ Failed to send test email: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
