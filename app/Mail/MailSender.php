<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $greeting, $message, $link, $link_name) {
        $this->subject = $subject;
        $this->greeting = $greeting;
        $this->message = $message;
        $this->link = $link;
        $this->link_name = $link_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('emails.sender')->subject($this->subject)->with([
                    'subject' => $this->subject,
                    'greeting' => $this->greeting,
                    'message_send' => $this->message,
                    'link' => $this->link,
                    'link_name' => $this->link_name,
        ]);
    }

}
