<?php

class BlogGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'blog_id', 'grade_id'];

    protected $table = 'blog_grades';

    public function grade()
    {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}