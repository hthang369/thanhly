<?php

namespace Modules\Api\Emails;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public $view;
    public $subject;
    public $content;
    public $title;
    public $email;
    public $name;

    public function __construct()
    {
        $this->view = 'api::emails.mail-notify';
    }

    /**
     * Send
     *
     * @return void
     * @throws \Exception
     * @author thang
     * @since  2019-03-14
     */
    public function send()
    {
        $subject = $this->subject;
        if (!isset($subject) || empty($subject)) {
            throw new \Exception('Don\'t have subject');
        }

        $email    = $this->email;
        $name     = $this->name;
        if (!isset($email) || empty($email)) {
            throw new \Exception('Don\'t have email');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email invalid');
        }

        if (!isset($name) || empty($name)) {
            throw new \Exception('Don\'t have name');
        }

        $view     = $this->view;
        if (empty($view)) {
            throw new \Exception('Don\'t have view');
        }

        Mail::send($view, ['content' => $this->content], function ($message) use ($subject, $name, $email) {
            $message->from($email, $name)
                ->to(env('MAIL_TO_ADDRESS'), env('MAIL_TO_NAME'))
                ->subject($subject);
        });

        return 'Send success';
    }
}
