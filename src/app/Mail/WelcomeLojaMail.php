<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeLojaMail extends Mailable
{
    use Queueable, SerializesModels;
    public $estabelecimento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($estabelecimento)
    {
        $this->estabelecimento = $estabelecimento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcomeEstabelecimento')->subject('Bem vindo ao KetchApp');
    }
}
