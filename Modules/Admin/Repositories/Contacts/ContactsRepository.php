<?php

namespace Modules\Admin\Repositories\Contacts;

use Laka\Core\Repositories\CoreRepository;
use Modules\Core\Entities\Contacts\ContactsModel;
use Modules\Admin\Forms\Contacts\ContactsForm;
use Modules\Admin\Grids\Contacts\ContactsGrid;

class ContactsRepository extends CoreRepository
{
    protected $presenterClass = ContactsGrid::class;

    protected $modelClass = ContactsModel::class;

    protected $formClass = ContactsForm::class;
}
