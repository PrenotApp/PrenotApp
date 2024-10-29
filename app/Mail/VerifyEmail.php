<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode; // Codice di verifica

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode; // Assegna il codice di verifica
    }

    public function build()
    {
        // return $this->view('emails.verify_email') // Vista per l'email di verifica
        //             ->with([
        //                 'verificationCode' => $this->verificationCode,
        //             ]);
        return $this->from('tuoindirizzo@tudominio.com')
                    ->to('giordanofabrizi@gmail.com')
                    ->subject('Oggetto dell’email di prova')
                    ->markdown('emails.verify_email');
    }
}
