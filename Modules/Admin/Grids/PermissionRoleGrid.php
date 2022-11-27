<?php

namespace Modules\Admin\Grids;

use Collective\Html\FormFacade as Form;

class PermissionRoleGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Permission Role';

    protected $sectionCode = 'role_has_permissions';

    protected $actionColumnOptions = ['visible' => false];

    protected $buttonsToGenerate = [
        'refresh'
    ];

    /**
     * Set the columns to be displayed.
     *
     * @return void
     * @throws \Exception if an error occurs during parsing of the data
     */
    public function setColumns()
    {
        return [
            'section_code',
            [
                'key' => 'permission',
                'cell' => function ($itemData) {
                    $permissions = json_decode($itemData['permission'], true);
                    $section_actions = config('permission.section_action');
                    $actions = config('permission.actions');
                    $listAction = [];
                    foreach ($permissions as $key => $value) {
                        if (!in_array($key, data_get($section_actions, $itemData['section_code'], $actions))) continue;
                        $name = sprintf('%s_%s', $key, $itemData['section_code']);
                        $listAction[] = $this->getTemplateAction($name, $value, $key);
                    }
                    return implode(' ', $listAction);
                }
            ]
        ];
    }

    private function getTemplateAction($name, $value, $key)
    {
        return '<div class="custom-control custom-checkbox custom-control-inline">' .
            Form::checkbox($name, null, $value, ['id' => $name, 'class' => 'custom-control-input']) .
            Form::label($name, $key, ['class' => 'custom-control-label'])
            . '</div>';
    }

    /**
     * Configure rendered buttons, or add your own
     *
     * @return void
     */
    public function configureButtons()
    {
        parent::configureButtons();
        $this->addToolbarButton('save', [
            'key' => 'save',
            'name' => 'save',
            'position' => 3,
            'icon' => 'fa fa-floppy-o',
            'class' => 'btn-save',
            'id' => 'btn-save',
            'size' => '',
            'label' => trans('admin::common.btn_save'),
            'title' => trans('admin::common.btn_save'),
            'url' => function($item) {
                return 'javascript:;';
            },
            'dataAttributes' => [
                'loading' => translate('table.loading_text')
            ],
            'visible' => function($item) {
                return true;
            }
        ]);
    }
}
