<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use MailerSend\Helpers\Builder\Variable;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\LaravelDriver\MailerSendTrait;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    protected $verificationCode;
    protected $name;

    public function __construct($verificationCode, $name)
    {
        $this->verificationCode = $verificationCode;
        $this->name = $name;
    }

    public function build()
    {
         return $this->view('emails.verify_email') // Specifica il template Blade
                    ->with([
                        'name' => $this->name, // Passa il nome
                        'codice' => $this->verificationCode, // Passa il codice
                    ]);
    }
}
