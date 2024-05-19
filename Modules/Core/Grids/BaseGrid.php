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
    protected $showModals = [];
    /**
    * Configure rendered buttons, or add your own
    *
    * @return void
    */
    protected function configureButtons()
    {
        parent::configureButtons();
        $modalAttrs = [];
        if (!blank($this->modalSize)) {
            $modalAttrs = [
                'dataAttributes' => [
                    'modal-size' => $this->modalSize,
                    'loading' => translate('table.loading_text')
                ]
            ];
        }
        $this->editCreateButton($modalAttrs);
        $modalAttrs['mergeClass'] = ['grid-row-button'];
        $this->editEditButton($modalAttrs);
    }

    private function setShowModal($name, &$options)
    {
        if (array_has($this->showModals, $name)) {
            data_set($options, 'showModal', $this->showModals[$name]);
        }
        return $options;
    }
    protected function editCreateButton($options)
    {
        $this->setShowModal('create', $options);
        $this->editToolbarButton('create', $options);
    }
    protected function editEditButton($options)
    {
        $this->setShowModal('edit', $options);
        $this->editRowButton('edit', $options);
    }
    protected function editDeleteButton($options)
    {
        $this->setShowModal('destroy', $options);
        $this->editRowButton('destroy', $options);
    }
    protected function editRefreshButton($options)
    {
        $this->setShowModal('refresh', $options);
        $this->editToolbarButton('refresh', $options);
    }
    protected function editDetailButton($options)
    {
        $this->setShowModal('show', $options);
        $this->editRowButton('show', $options);
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
