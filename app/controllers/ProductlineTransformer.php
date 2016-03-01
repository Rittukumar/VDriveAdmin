<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 06/01/16
 * Time: 11:51 PM
 */
class ProductlineTransformer extends Fractal\TransformerAbstract
{
    public function transform(ProductLine $productLine)
    {
        return [
            'id'    => (int) $productLine['id'],
            'store_id'    => (int) $productLine['store_id'],
            'title'    => $productLine['title'],
            'description'    => $productLine['description'],
            'type'    => $productLine['type'],
            'store'    => $productLine['store'],
            'products'    => $productLine['products']
        ];
    }
}