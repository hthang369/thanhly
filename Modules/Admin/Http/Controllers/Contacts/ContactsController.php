<?php

namespace Modules\Admin\Http\Controllers\Contacts;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Contacts\ContactsRepository;
use Modules\Admin\Validators\Contacts\ContactsValidator;

class ContactsController extends CoreController
{
    public function __construct(ContactsRepository $repository, ContactsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::contacts');
        // $this->setRouteName('contact');
        // $this->setPathView([
        //     'show' => 'admin::contacts.contact_modal',
        //     'update' => 'contacts.update',
        //     'store' => 'contacts.store',
        //     'destroy' => 'contacts.destroy',
        // ]);
    }
}
