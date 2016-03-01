<?php

class EventGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'event_id', 'grade_id'];

    protected $table = 'event_grades';

    public function grade()
    {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}