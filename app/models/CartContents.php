<?php

/**
 * Class and Function List:
 * Function list:
 * - author()
 * Classes list:
 * - Buyer extends \
 */

class CartContents extends \Eloquent
{
    protected $table = 'cart_contents';
    protected $fillable = [];

    /**
     * Get the account's owner.
     *
     * @return User
     */
    public function owner()
    {
        return $this->belongsTo('User', 'user_id');
    }
}
