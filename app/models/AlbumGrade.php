<?php

class AlbumGrade extends \Eloquent {
    protected $fillable = ['id', 'grader_id', 'album_id', 'grade_id'];

    protected $table = 'album_grades';

    public function grade()
    {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}