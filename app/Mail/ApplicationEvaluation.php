<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Notification;
use App\Application;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationEvaluation extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.application_evaluation', ['application'=>$this->application]);
    }
}
