<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SmsService
{
    public function sendOtp(string $phone, int $otp): void
    {
        $message = "Your OTP is: {$otp}";

        $this->send($phone, $message);
    }

    public function sendCredentials(string $phone, string $regNo, string $password): void
    {
        $message = "Registration Successful!\nReg No: {$regNo}\nPassword: {$password}";

        $this->send($phone, $message);
    }

    private function send(string $phone, string $message): void
    {
        Log::info("SMS Sent to {$phone}: {$message}");
    }
}
