<?php

class EventActivityGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'event_activity_id', 'grade_id'];

    protected $table = 'event_activity_grades';

    public function grade() {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}