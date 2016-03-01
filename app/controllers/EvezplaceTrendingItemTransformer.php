<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 19/01/16
 * Time: 10:41 AM
 */
class EvezplaceTrendingItemTransformer extends Fractal\TransformerAbstract
{
    public function transform(EvezplaceTrendingItem $evezplaceTrendingItem)
    {
        return [
            'id'    => (int) $evezplaceTrendingItem->id,
            'title' => $evezplaceTrendingItem->title,
            'description' => $evezplaceTrendingItem->description,
            'link' => $evezplaceTrendingItem->link,
            'image' => $evezplaceTrendingItem->image,
            'priority' => (int) $evezplaceTrendingItem->priority,
            'evezown_section' => $evezplaceTrendingItem->evezown_section,
        ];
    }
}