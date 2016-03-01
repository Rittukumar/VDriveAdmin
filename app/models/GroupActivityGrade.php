<?php

class GroupActivityGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'group_activity_id', 'grade_id'];

    protected $table = 'group_activity_grades';

    public function grade() {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }

    public function user(){
        return $this->belongsTo('UserProfile', 'owner_id', 'user_id');
    }
}