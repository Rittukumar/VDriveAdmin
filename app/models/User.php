<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements ConfideUserInterface {
	use ConfideUser;
	use HasRole;

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'api_key');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('email', 'password','id');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Password mutator.
	 *
	 * @param  string  $password
	 * @return void
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * Generate a random, unique API key.
	 *
	 * @return string
	 */
	public static function createApiKey()
	{
		return Str::random(32);
	}

	public function profile()
    {
        return $this->belongsTo('UserProfile', 'id','user_id');
    }

	public function roles()
	{
		return $this->belongsToMany('Role','assigned_roles');
	}
}