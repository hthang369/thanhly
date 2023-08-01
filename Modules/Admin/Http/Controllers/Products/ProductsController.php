<?php

namespace Modules\Admin\Http\Controllers\Products;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Products\ProductsRepository;
use Modules\Admin\Validators\Products\ProductsValidator;
use Modules\Setting\Repositories\Attributes\AttributesRepository;

class ProductsController extends CoreController
{
    protected $listViewName = [
        'create' => 'admin::products.product_modal',
        'show' => 'admin::products.product_modal',
        'edit' => 'admin::products.product_modal',
    ];

    protected $attrRepository;

    public function __construct(ProductsRepository $repository, ProductsValidator $validator, BaseResponse $response, AttributesRepository $attrRepository)
    {
        parent::__construct($repository, $validator, $response);
        $this->attrRepository = $attrRepository;
    }

    protected function formGenerateConfig($routeLink, $actionName, $options = [])
    {
        list($modal, $formDatas) = $this->repository->formGenerate($routeLink, $actionName, $options);
        data_set($modal, 'model_attrs', $this->attrRepository->getProductAttributes());
        
        $formOptions = null;
        $form = array_map(function($formData) use($modal, &$formOptions) {
            $formField = $this->formBuilder->create($formData, $modal);
            $formOptions = $formField->getFormOptions();
            return $formField->renderForm([], false, true, false);
        }, $formDatas);
        
        return [$formOptions, $form];
    }
}
