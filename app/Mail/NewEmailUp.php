<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEmailUp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $data;
     public $pass;
     public $users;
 
     public function __construct($data)
     {
         $this->data = $data;
     }
 
     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
        
            $user['name'] = $this->data['nombre'];
            $user['email'] = $this->data['email'];
            $user['rut'] = $this->data['rut'];
            $user['tel'] = $this->data['tel'];
            $user['cadena'] = $this->data['cadena'];
         return $this->from("cco92479@reddocenteinnovador.congresocied.cl", "Red Docente Innovador")
         ->subject('Solicitud de Ingreso RedDocente.cl')
         ->view('emails.newusersup', ['user' => $user]);
     }
}
