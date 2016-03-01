<?php

class AlbumComment extends \Eloquent {
    protected $fillable = ['id', 'album_id','comment_id','user_id'];

    protected $table = 'album_comments';


    public function profile() {
        return $this->belongsTo('UserProfile', 'user_id');
    }

    public function comment()
    {
        return $this->hasOne('Comment', 'comment_id');
    }
}