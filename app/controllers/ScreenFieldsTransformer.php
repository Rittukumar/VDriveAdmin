<?php

use League\Fractal;

class ScreenFieldsTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     */
    public function transform(ScreenFields $screenFields)
    {
        return [
            'id'          => (int) $screenFields['id'],
            'label'       => $screenFields['field_name'],
            'description' => $screenFields['field_value']
        ];
    }
}