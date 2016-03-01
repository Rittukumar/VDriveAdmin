<?php

class GroupGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'group_id', 'grade_id'];

    protected $table = 'group_grades';

    public function grade() {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}