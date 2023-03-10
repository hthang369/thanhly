<?php
namespace Modules\Core\Support;

class PromotionFormular
{
    public function calcalulator($product)
    {
        $promotions = data_get($product, 'promotions');
        if ($promotions) {
            foreach($promotions as $promotion) {
                $method = 'calcalulator'.ucfirst(data_get($promotion, 'promotion_type'));
                $this->{$method}($product, $promotion);
            }
        }
        return $product;
    }

    protected function calcalulatorPercent(&$product, $promotion)
    {
        $price = data_get($product, 'price');
        $promotion_value = data_get($promotion, 'promotion_value');
        $newValue = ($price * $promotion_value) / 100;
        data_set($product, 'promotion_price', ($price - $newValue));
        data_set($product, 'promotion_value', data_get($promotion, 'promotion_name'));
    }

    protected function calcalulatorAmount(&$product, $promotion)
    {
        $price = data_get($product, 'price');
        $promotion_value = data_get($promotion, 'promotion_value');
        data_set($product, 'promotion_price', ($price - $promotion_value));
    }

    protected function calcalulatorAbsolute(&$product, $promotion)
    {
        $promotionText = data_get($product, 'promotion_text');
        if (!$promotionText) {
            $promotionText = data_get($promotion, 'promotion_name');
        } else {
            $promotionText .= ','.data_get($promotion, 'promotion_name');
        }
        data_set($product, 'promotion_text', $promotionText);
    }
}
