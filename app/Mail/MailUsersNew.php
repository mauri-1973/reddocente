<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailUsersNew extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $name;
     public $pass;
     public $users;
 
     public function __construct($name, $pass, $users)
     {
         $this->name = $name;
         $this->pass = $pass;
         $this->users = $users;
     }
 
     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         $user['name'] = $this->name;
         $user['pass'] = $this->pass;
         $user['email'] = $this->users;
 
         return $this->from("cco92479@reddocenteinnovador.congresocied.cl", "Red Docente Innovador")
         ->subject('Nuevo Usuario Creado')
         ->view('emails.newusers', ['user' => $user]);
     }
}
