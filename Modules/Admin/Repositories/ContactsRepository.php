<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\ContactsModel;
use Modules\Admin\Forms\ContactsForm;
use Modules\Admin\Grids\ContactsGrid;
use Laka\Core\Repositories\CoreRepository;

class ContactsRepository extends CoreRepository
{
    protected $presenterClass = ContactsGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactsModel::class;
    }

    public function form()
    {
        return ContactsForm::class;
    }
}
