<?php

class Favorite extends \Eloquent {
	use UserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'favorites';
}