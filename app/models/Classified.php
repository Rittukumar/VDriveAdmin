<?php

class Classified extends \Eloquent
{
    protected $fillable = ['id', 'classified_type', 'classified_category_id',
        'classified_subcategory_id','title', 'description',
        'deal_description', 'layout_type', 'classified_for', 'start_date',
        'end_date', 'is_my_eves', 'is_my_circles', 'is_only_me', 'is_recco_it_channel',
        'is_open_to_public', 'is_add_enquiry', 'is_facebook_share', 'is_watsapp_share',
        'is_googleplus_share', 'is_twitter_share', 'is_direct_message_share', 'is_gmail_share',
        'is_linkedin_share', 'is_email_share', 'is_views_analytics', 'is_enquires_analytics',
        'is_sends_analytics', 'is_gradeit_analytics', 'is_visibility_summary_analytics', 'user_id'];

    protected $table = 'classifieds';

    public function tags()
    {
        return $this->hasMany('ClassifiedTag');
    }

    public function images()
    {
        return $this->hasMany('ClassifiedImage');
    }

    public function location()
    {
        return $this->hasOne('ClassifiedLocation');
    }

    public function contact()
    {
        return $this->hasOne('ClassifiedContact');
    }
}