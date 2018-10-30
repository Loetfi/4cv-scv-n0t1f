<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSendgrid extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'ahmaddjunaedi92@gmail.com';
        $subject = 'This is a demo!';
        $name = 'Jane Doe';

        // print_r($this->data['message']);die();
        
        return $this->view('email_sendgrid')
                    ->from($address, $name)
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    // ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'text' => $this->data['message'] ]);
    }
}