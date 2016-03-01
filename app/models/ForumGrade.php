<?php

class ForumGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'forum_id', 'grade_id'];

    protected $table = 'forum_grades';

    public function grade()
    {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}