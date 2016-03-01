<?php

/**
 * @property  request_info
 */
class ClassifiedRequestInfo extends \Eloquent {
	protected $fillable = ['rfi_id', 'classified_id'];

	protected $table = 'classified_request_info';

	public function request_info()
	{
		return $this->hasOne('RequestInfo', 'id', 'rfi_id');
	}

	public function classified() {
		return $this->belongsTo('Classified', 'classified_id');
	}
}