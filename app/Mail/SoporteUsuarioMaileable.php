<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SoporteUsuarioMaileable extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subject = 'Nuevo Soporte a usuario';
    public $formulario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formulario)
    {
        $this->formulario = $formulario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.solicitudSoporte');
    }
}
