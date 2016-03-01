<?php

class AlbumImageGrade extends \Eloquent {
	protected $fillable = ['id', 'grader_id', 'album_image_id', 'grade_id'];

    protected $table = 'album_image_grades';

    public function grade() {
        return $this->belongsTo('Grade', 'grade_id', 'id');
    }
}