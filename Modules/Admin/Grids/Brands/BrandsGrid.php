<?php

namespace Modules\Admin\Grids\Brands;

use Modules\Core\Enums\DataType;
use Modules\Core\Grids\BaseGrid;

class BrandsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Brands';

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
                'key' => 'brand_name',
                'label' => trans('admin::brands.brand_name'),
            ],
            [
                'key' => 'brand_link',
                'label' => trans('admin::brands.brand_link'),
            ],
            [
                'key' => 'brand_image',
                'label' => trans('admin::brands.brand_image'),
                'dataType' => DataType::IMAGE
            ],
        ];
    }

    protected function formatterImageDisplay($cellValue, $columnName, $rowData)
    {
        return parent::formatterImageDisplay(join(DIRECTORY_SEPARATOR, ['brands', $cellValue]), $columnName, $rowData);
    }
}
