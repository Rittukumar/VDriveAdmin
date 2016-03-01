<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 16/01/16
 * Time: 10:06 PM
 */
class EvezplacePromotionTransformer  extends Fractal\TransformerAbstract
{
    public function transform(EvezplacePromotion $evezplacePromotion)
    {
        return [
            'id'    => (int) $evezplacePromotion->id,
            'left_small_caption' => $evezplacePromotion->left_small_caption,
            'left_large_caption' => $evezplacePromotion->left_large_caption,
            'left_button_text' => $evezplacePromotion->left_button_text,
            'left_link' => $evezplacePromotion->left_link,
            'left_image' => $evezplacePromotion->left_image,
            'right_top_small_caption' => $evezplacePromotion->right_top_small_caption,
            'right_top_link' => $evezplacePromotion->right_top_link,
            'right_top_image' => $evezplacePromotion->right_top_image,
            'right_bottom_small_caption' => $evezplacePromotion->right_bottom_small_caption,
            'right_bottom_link'  => $evezplacePromotion->right_bottom_link,
            'right_bottom_image'  => $evezplacePromotion->right_bottom_image
        ];
    }
}