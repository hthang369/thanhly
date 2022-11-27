<?php

namespace Modules\Admin\Grids;

use Modules\Admin\Facades\StatusType;

class ContactsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Contacts';
    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            'subject',
            'fullname',
            'email',
            'phone'
		];
    }

    protected function visibleDetail($item)
    {
        return user_can("view_{$this->getSectionCode()}");
    }

    protected function configureButtons()
    {
        parent::configureButtons();
        $this->editRowButton('detail', [
            'dataAttributes' => [
                'modal-size' => 'modal-xl',
            ],
        ]);
    }
}
