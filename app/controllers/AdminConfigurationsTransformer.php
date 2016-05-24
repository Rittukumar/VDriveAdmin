<?php

use League\Fractal;

class AdminConfigurationsTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     */
    public function transform(AdminConfigurations $AdminConfigurations)
    {
        return [
            'id'    => (int) $AdminConfigurations['id'],
            'name' => $AdminConfigurations['config_name'],
            'value' => $AdminConfigurations['config_value']
        ];
    }
}