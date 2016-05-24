<?php

class Post extends \Eloquent {
	protected $fillable = ['title', 'description', 'testimonial', 'visibility_id', 'price_range',
			'owner_id', 'post_type_id', 'brand_id', 'priority','classification_id','cat_id','sub_cat_id','circle_id'];

	public function images(){

		return $this->hasMany('PostImage')->join('images', 'post_images.image_id', '=', 'images.id');
	}

	public function links() {
		return $this->hasMany('PostLink')->join('links', 'post_links.link_id', '=', 'links.id');
	}

	public function user(){
		return $this->belongsTo('UserProfile', 'owner_id');
	}

	public function users(){
		return $this->belongsTo('User', 'owner_id');
	}

	public function brand() {
		return $this->belongsTo('Brand');
	}

    public function post_location(){
        return $this->hasOne('PostLocation')->join('locations', 'post_location.location_id', '=', 'locations.id');;
    }

	public function scopeOrderBySubmitDate($query) {
		return $query->orderBy('updated_at', 'desc');
	}

	public function scopeOrderByPriority($query) {
		return $query->orderBy('priority', 'desc');
	}

	public function comments(){

		return $this->hasMany('PostComment')->join('comments', 'post_comments.comment_id', '=', 'comments.id');
	}

	public function grades(){

		return $this->hasMany('PostGrade')->join('grades', 'post_grades.grade_id', '=', 'grades.id');
	}

	public function rewoices(){

		return $this->hasMany('PostRewoice');
	}

	public function getOriginal($key = null, $default = null)
	{
		return array_get($this->original, $key, $default);
	}
}