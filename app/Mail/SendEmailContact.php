<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $name;
     public $asunto;
     public $mensaje;
     public $desde;
     public $users;
 
     public function __construct($name, $asunto, $mensaje, $desde)
     {
         $this->name = $name;
         $this->asunto = $asunto;
         $this->mensaje = $mensaje;
         $this->desde = $desde;
     }
 
     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         $user['name'] = $this->name;
         $user['mensaje'] = $this->mensaje;
         $user['desde'] = $this->desde;
 
         return $this->from("cco92479@reddocenteinnovador.congresocied.cl", "Contacto Nueva Plataforma")
         ->subject($this->asunto)
         ->view('emails.sendemailcontact', ['user' => $user, 'mensaje'=> $this->mensaje]);
     }
}
