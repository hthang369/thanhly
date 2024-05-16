<?php

namespace Modules\Home\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotify extends Mailable
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
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = env('MAIL_FROM_ADDRESS'); //data_get($this->data, 'email');
        $subject = data_get($this->data, 'subject');
        $name = data_get($this->data, 'fullname');
        return $this->view(module_view('email-notify'))
            ->from($from, $name)
            ->subject($subject);
    }
}
