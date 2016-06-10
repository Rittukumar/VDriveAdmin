<?php


class Role extends \Eloquent {

	protected $table = 'roles';
    protected $fillable = [];

	public function users()
    {
        return $this->belongsToMany('User','assigned_roles');
    }

}