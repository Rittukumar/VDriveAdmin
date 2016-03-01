<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 15/10/15
 * Time: 11:34 PM
 */
class ProductSkuTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param ProductSKU $productSKU
     * @return array
     */
    public function transform(ProductSKU $productSKU)
    {
        return [
            'id'    => (int) $productSKU['id'],
            'product_id'    => (int) $productSKU['product_id'],
            'price'    => $productSKU['price'],
            'discount'    => $productSKU['discount'],
            'tax'    => $productSKU['tax'],
            'shipping_charge'    => $productSKU['shipping_charge'],
            'size'    => $productSKU['size'],
            'color'    => $productSKU['color'],
            'weight'    => $productSKU['weight'],
            'volume'    => $productSKU['volume'],
            'is_trending'    => (bool) $productSKU['is_trending'],
            'product_images' => $productSKU->ProductImages,
            'product_stock' =>$productSKU->ProductStock,
            'product' => $productSKU->product
        ];
    }
}