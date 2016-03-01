<?php

class AlbumImageComment extends \Eloquent {
	protected $fillable = ['id', 'commenter_id', 'album_image_id', 'comment_id'];

    protected $table = 'album_image_comments';


    public function profile() {
        return $this->belongsTo('UserProfile', 'commenter_id');
    }

    public function comment() {
        return $this->hasOne('Comment', 'comment_id');
    }
}