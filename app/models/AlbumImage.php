<?php

class AlbumImage extends \Eloquent {
	protected $fillable = ['id', 'image_id', 'album_id', 'comment_id', 'grade_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'album_images';

    public function comments() {
        return $this->hasMany('AlbumImageComment')->join('comments', 'album_image_comments.comment_id', '=', 'comments.id');
    }

    public function user()
    {
        return $this->belongsTo('UserProfile', 'owner_id');
    }

    public function grades() {
        return $this->hasMany('AlbumImageGrade');
    }
}