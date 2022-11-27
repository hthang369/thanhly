<?php

namespace Modules\Admin\Grids;

use Modules\Admin\Entities\CategoriesModel;
use Modules\Admin\Facades\StatusType;

class PagesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Pages';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            [
                'key' => 'post_title',
                'label' => trans('admin::posts.post_title')
            ],
            [
                'key' => 'post_excerpt',
                'label' => trans('admin::posts.post_excerpt'),
            ],
            [
                'key' => 'post_date',
                'label' => trans('admin::posts.post_date'),
            ],
            [
                'key' => 'post_status',
                'label' => trans('admin::posts.post_status'),
                'cell' => function($itemData) {
                    return StatusType::getStatusType($itemData['post_status']);
                }
            ],
        ];
    }

    /**
    * Configure rendered buttons, or add your own
    *
    * @return void
    */
    public function configureButtons()
    {
        parent::configureButtons();
		$this->editToolbarButton('create', [
            'dataAttributes' => [
                'modal-size' => 'modal-xl',
                'loading' => translate('table.loading_text')
            ],
        ]);
        $this->editRowButton('edit', [
            'dataAttributes' => [
                'modal-size' => 'modal-xl',
                'loading' => translate('table.loading_text')
            ],
        ]);
    }
}
