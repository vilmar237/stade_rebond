<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class rebondMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('rebondstade@gmail.com')->subject('nous joindre')
                    ->view('emails.mail')->with('data',$this->data);
    }
    public function ins(){
        return $this->from('rebondstade@gmail.com')->subject('nous joindre')
                    ->view('emails.mail')->with('data',$this->data);
    }
}
