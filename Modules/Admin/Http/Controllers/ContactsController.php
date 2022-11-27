<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Repositories\ContactsRepository;
use Modules\Admin\Validators\ContactsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

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
