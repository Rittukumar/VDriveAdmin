<?php

class Album extends \Eloquent {
	protected $fillable = ['id', 'owner_id', 'name', 'description','visibility_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'albums';


	public function images()
    {
		return $this->hasMany('AlbumImage')->join('images', 'album_images.image_id', '=', 'images.id');
	}

    public function comments()
    {
        return $this->hasMany('AlbumComment')->join('comments', 'album_comments.comment_id', '=', 'comments.id');
    }

    public function grades()
    {
        return $this->hasMany('AlbumGrade');
    }
}