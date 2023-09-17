<?php
namespace Modules\Home\Support;

use Modules\Core\Facades\PromotionFormular;

class PortfolioSupport
{
    public function convert($data)
    {
        return collect($data)->map(function($item) {
            return $this->convertItem($item);
        });
    }

    public function convertProduct($data)
    {
        return collect($data)->map(function($item) {
            $pro = PromotionFormular::calcalulator($item);
            return [
                'title' => data_get($pro, 'name'),
                'link' => route('page.show-product', data_get($pro, 'link')),
                'excerpt' => data_get($pro, 'excerpt'),
                'price' => currency_format(data_get($pro, 'price'), data_get($pro, 'currency.currency_no')),
                'promotion_price' => data_get($pro, 'promotion_price'),
                'promotion_value' => data_get($pro, 'promotion_value'),
                'promotion_text' => data_get($pro, 'promotion_text'),
                'uom' => data_get($pro, 'uom'),
                'content' => data_get($pro, 'content'),
                'images' => [
                    'name' => data_get($pro, 'name'),
                    'src' => image_asset(data_get($pro, 'image')),
                    'class' => 'img-fluid'
                ]
            ];
        });
    }

    public function convertItem($item)
    {
        return [
            'title' => [
                'text' => data_get($item, 'post_title'),
                'class' => 'text-truncate text-uppercase'
            ],
            'link' => route('page.show-detail', data_get($item, 'post_link')),
            'excerpt' => [
                'text' => data_get($item, 'post_excerpt'),
                'class' => 'text-truncate-3'
            ],
            'images' => [
                'name' => data_get($item, 'post_title'),
                'src' => image_asset(data_get($item, 'post_image')),
                'class' => 'img-fluid'
            ]
        ];
    }
}
