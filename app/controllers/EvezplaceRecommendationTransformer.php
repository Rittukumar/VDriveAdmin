<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 18/01/16
 * Time: 2:54 PM
 */
class EvezplaceRecommendationTransformer extends Fractal\TransformerAbstract
{
    public function transform(EvezplaceRecommendation $evezplaceRecommendation)
    {
        return [
            'id'    => (int) $evezplaceRecommendation->id,
            'title' => $evezplaceRecommendation->title,
            'description' => $evezplaceRecommendation->description,
            'link' => $evezplaceRecommendation->link,
            'image' => $evezplaceRecommendation->image,
            'priority' => (int) $evezplaceRecommendation->priority,
            'evezown_section' => $evezplaceRecommendation->evezown_section,
        ];
    }
}