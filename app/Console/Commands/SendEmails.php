<?php

namespace App\Console\Commands;

use App\Services\Mail\MailService;
use Illuminate\Console\Command;
use App\Services\Rate\RateServiceInterface;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily rate emails to subscribers';

    /**
     * Execute the console command.
     */
    public function handle(MailService $mailService, RateServiceInterface $rateService)
    {
        $subscribers = Subscriber::all();
        $rate = $rateService->getRate();

        if (!$rate) {
            $this->error('Failed to retrieve rate');
            return;
        }

        foreach ($subscribers as $subscriber) {
            $subject = "Daily {$rate->currency} Rate";
            $body = "The current {$rate->currency} rate is: {$rate->rate}";

            $success = $mailService->sendEmail($subscriber->email, $subject, $body);

            if ($success) {
                Log::info("Email sent to {$subscriber->email}");
            } else {
                Log::error("Failed to send email to {$subscriber->email}");
            }
        }
    }
}
