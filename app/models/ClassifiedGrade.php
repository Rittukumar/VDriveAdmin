<?php

class ClassifiedGrade extends \Eloquent {
	protected $fillable = ['id', 'grader_id', 'classified_id', 'grade_id'];

	public $table = 'classified_grades';

	public function grade() {
		return $this->belongsTo('Grade', 'grade_id', 'id');
	}

	public function grader(){
		return $this->belongsTo('User', 'grader_id', 'id');
	}
}