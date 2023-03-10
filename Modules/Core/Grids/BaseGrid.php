<?php

namespace Modules\Core\Grids;

use Laka\Core\Grids\BaseGridPresenter;
use Modules\Core\Enums\DataType;
use Modules\Core\Facades\StatusType;

abstract class BaseGrid extends BaseGridPresenter
{
    protected $modalSize;

    protected $castFormatter = [
        DataType::STATUS => 'formatterStatusDisplay'
    ];
    /**
    * Configure rendered buttons, or add your own
    *
    * @return void
    */
    protected function configureButtons()
    {
        parent::configureButtons();
        $modalAttrs = null;
        if (!blank($this->modalSize)) {
            $modalAttrs = [
                'dataAttributes' => [
                    'modal-size' => $this->modalSize,
                    'loading' => translate('table.loading_text')
                ]
            ];
            $this->editToolbarButton('create', $modalAttrs);
            $this->editRowButton('edit', $modalAttrs);    
        }
        $this->editRowButton('edit', [
            'renderCustom' => '',
            'mergeClass' => ['grid-row-button', 'show_modal_form'],
        ]);
        $this->editRowButton('detail', [
            'mergeClass' => ['grid-row-button', 'show_modal_form']
        ]);
    }

    protected function visibleDetail($item)
    {
        return false;
    }

    public function formatterStatusDisplay($cellValue, $columnName, $rowData)
    {
        return StatusType::getStatusType($cellValue);
    }
}
