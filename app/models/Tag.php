<?php

class Tag extends \Eloquent {
    use Illuminate\Auth\UserTrait;

    public $timestamps = false;
    protected $fillable = array('id', 'name');

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';
}