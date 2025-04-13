<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationOTP extends Notification
{
    use Queueable;

    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to Trattoria - Verify Your Email')
            ->markdown('emails.verification-otp', ['otp' => $this->otp])
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Welcome to Trattoria. We\'re excited to have you join us!')
            ->line('To complete your registration and ensure the security of your account, please use the verification code above.')
            ->line('This code will expire in 10 minutes for security purposes.')
            ->line('If you didn\'t create an account with us, please ignore this email.')
            ->salutation('Thank you for choosing Trattoria');
    }
}
