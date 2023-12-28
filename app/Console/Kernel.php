<?php

namespace App\Console;

use DrewM\MailChimp\MailChimp;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $campaignData = [
                'type' => 'regular',
                'recipients' => ['list_id' => env("MAILCHIMP_LIST_ID")],
                'settings' => [
                    'subject_line' => '20DTHE4-HUTECH',
                    'from_name' => 'LeHieuNghia-20DTHE4-ITHUTECH',
                    'reply_to' => 'lehieunghia2402@gmail.com',
                    'template_id'=>10564776,
                ],
            ];

            $apiKey = env("MAILCHIMP_API_KEY");
            $MailChimp = new MailChimp($apiKey);
            $result = $MailChimp->post('campaigns', $campaignData);

            $campaignId = $result['id'];

            $sendResult = $MailChimp->post("campaigns/{$campaignId}/actions/send");
            echo "giigigi";
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
