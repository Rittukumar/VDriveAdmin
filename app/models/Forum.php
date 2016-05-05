<?php

class Forum extends \Eloquent {
	protected $fillable = ['owner_id', 'title', 'description', 'sub_cat_id','visibility_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'forums';

	public function replies() {
		return $this->hasMany('ForumReply');
	}

	public function created_by(){
		return $this->belongsTo('UserProfile', 'owner_id');
	}

	public function subcategory(){
		return $this->belongsTo('SubCategory', 'sub_cat_id');
	}

	public function trending() {
		return $this->hasOne('EvezplaceTrendingForum', 'forum_id');
	}

}