<?php

namespace Modules\Api\Repositories;

use Modules\Api\Emails\EmailService;
use Modules\Api\Entities\ContactsModel;

class ContactsRepository extends ContactsBaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactsModel::class;
    }

    public function sendMail($attributes)
    {
        $mail = new EmailService();
        $mail->subject = $attributes['subject'];
        $mail->content = $attributes['message'];
        $mail->email = $attributes['email'];
        $mail->name = $attributes['name'];

        return $mail->send();
    }
}
