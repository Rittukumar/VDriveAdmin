<?php

class StoreGrade extends \Eloquent {
	protected $fillable = ['id', 'grader_id', 'store_id', 'grade_id'];

	public $table = 'store_front_grades';

	public function grade() {
		return $this->belongsTo('Grade', 'grade_id', 'id');
	}

	public function grader(){
		return $this->belongsTo('User', 'grader_id', 'id');
	}
}