<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegistrationMail extends Notification {

    use Queueable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $subject, $message) {
        $this->message = $message;
        $this->subject = $subject;
        $this->full_name = $full_name;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function toMail($notifiable) {
        $url = url('login');
        return (new MailMessage)
                        ->subject($this->subject)
                        ->line('Dear ' . $this->full_name)
                        ->line($this->message)
                        ->line('Contact us immediately if you did not authorize this registration.')
                        ->line('Thank You.')
        ;
    }

}
