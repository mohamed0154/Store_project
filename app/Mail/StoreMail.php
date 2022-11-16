<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Admin;
class StoreMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */public $d;
    public function __construct(Admin $n)
    { 
        //return $n;
        $this->d=$n->name;;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('welcome');
    }
}
