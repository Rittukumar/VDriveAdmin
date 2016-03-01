<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserProfile extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    protected $fillable = array('firstname', 'lastname', 'about_me', 'active', 'profession', 'company', 'street_address', 'city',
        'state', 'country', 'zip', 'email', 'website', 'facebook_address', 'linkedin_address', 'gender', 'education1', 'education2',
        'education3', 'skills', 'language1', 'interests', 'language2', 'language3', 'name_organization1', 'designation1', 'work_experience1', 'other_info1', 'user_id', 'reference_name1', 'reference_email1',
        'reference_phone1', 'reference_name2', 'reference_email2',
        'reference_phone2', 'reference_name3',
        'reference_email3', 'reference_phone3', 'need_wopportunity_listing', 'need_resume_upload',
        'full_time_job', 'part_time_job', 'flexi_job', 'short_assignment', 'freelancing_job',
        'interested_industry_sector', 'hire_through_evezown', 'other_ideas',
        'through_blogs', 'through_forums', 'through_events', 'through_recco',
        'as_woice_user', 'as_evangelist', 'as_active_writer', 'as_ecommerce', 'interested_in_content_creation', 'feedback');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profile';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function friends()
    {
        return $this->belongsToMany('UserProfile', 'friends', 'user_id', 'friend_user_id');
    }

    public function users()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function post()
    {
        return $this->hasmany('posts');
    }

    public function profile_image()
    {

        return $this->hasOne('UserProfileImage', 'user_id')->orderBy('user_profile_image.created_at', 'DESC')->join('images', 'user_profile_image.image_id', '=', 'images.id');
    }

    // Cover pics
    public function right_cover_pic()
    {

        return $this->hasOne('ProfileCoverPic', 'user_id')->join('images', 'profile_cover_pic.right_image_id', '=', 'images.id');
    }

    public function left_cover_pic()
    {

        return $this->hasOne('ProfileCoverPic', 'user_id')->join('images', 'profile_cover_pic.left_image_id', '=', 'images.id');
    }

    public function bottom_cover_pic()
    {

        return $this->hasOne('ProfileCoverPic', 'user_id')->join('images', 'profile_cover_pic.bottom_image_id', '=', 'images.id');
    }

}
