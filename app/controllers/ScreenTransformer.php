<?php

use League\Fractal;

class ScreenTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     */
    public function transform(Screens $screens)
    {
        return [
            'id'    => (int) $screens['id'],
            'label' => $screens['screen_name']
        ];
    }
}