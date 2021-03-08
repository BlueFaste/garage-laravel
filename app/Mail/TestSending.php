<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mockery\Exception;

class TestSending extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            echo('mail:mailable');
            return $this->from('caro.fassot@outlook.com')
                ->view('mail.test');
        } catch (Exception $e){
            echo($e);
        }
    }
}
