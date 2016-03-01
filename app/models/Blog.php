<?php

class Blog extends Eloquent {

	protected $fillable = ['id', 'author_id', 'title', 'content', 'status',
							'sub_cat_id', 'blog_image_id','visibility_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blog';

	public function comments() {
		return $this->hasMany('BlogComments')->join('comments', 'blog_comments.comment_id', '=', 'comments.id');;
	}

	public function author(){
		return $this->belongsTo('UserProfile', 'author_id');
	}

    public function blog_image() {
        return $this->hasOne('BlogImage', 'blog_id')->join('images', 'blog_image.image_id', '=', 'images.id');
    }

	public function subcategory(){
		return $this->belongsTo('SubCategory', 'sub_cat_id');
	}

	public function blog_cover_image() {
		return $this->hasMany('EvezownImage', 'blog_image_id');
	}

	public function scopeOrderBySubmitDate($query) {
		return $query->orderBy('created_at', 'desc');
	}

	public function trending() {
		return $this->hasOne('EvezplaceTrendingBlog', 'blog_id');
	}
}