<?php

namespace App\Services\Mail;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendEmail(string $to, string $subject, string $body): bool
    {
        try {
            Mail::raw($body, function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            });

            return true;
        } catch (Throwable $exception) {
            Log::error('Mail sending failed', ['exception' => $exception]);
            return false;
        }
    }
}
