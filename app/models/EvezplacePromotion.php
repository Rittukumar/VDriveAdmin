<?php

class EvezplacePromotion extends \Eloquent
{
    protected $fillable = [
        'id', 'left_small_caption', 'left_large_caption',
        'left_button_text', 'left_link', 'left_image_id',
        'right_top_small_caption', 'right_top_large_caption',
        'right_top_button_text', 'right_top_link',
        'right_top_image_id', 'right_bottom_small_caption',
        'right_bottom_large_caption','right_bottom_button_text',
        'right_bottom_link', 'right_bottom_image_id', 'evezown_section_id'
    ];

    public function left_image() {
        return $this->hasOne('EvezownImage', 'id','left_image_id');
    }

    public function right_top_image() {
        return $this->hasOne('EvezownImage', 'id','right_top_image_id');
    }

    public function right_bottom_image() {
        return $this->hasOne('EvezownImage', 'id','right_bottom_image_id');
    }
}