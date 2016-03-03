<?php
/**
 * Created by PhpStorm.
 * User: Viswanathan
 * Date: 7/21/2015
 * Time: 4:41 PM
 */
use League\Fractal;

class ClassifiedsTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Classified $classified
     * @return array
     */
    public function transform(Classified $classified)
    {
        return [
            'id' => (int)$classified['id'],
            'title' => $classified['title'],
            'description' => $classified['description'],
            'deal_description' => $classified->deal_description,
            'layout_type' => $classified->layout_type,
            'classified_type' => (int)$classified->classified_type,
            'classified_for' => (int)$classified->classified_for,
            'classified_category_id' => (int)$classified->classified_category_id,
            'classified_subcategory_id' => (int)$classified->classified_subcategory_id,
            'is_my_eves' => (bool)$classified->is_my_eves,
            'is_my_circles' => (bool)$classified->is_my_circles,
            'is_only_me' => (bool)$classified->is_only_me,
            'is_recco_it_channel' => (bool)$classified->is_recco_it_channel,
            'is_open_to_public' => (bool)$classified->is_open_to_public,
            'is_add_enquiry' => (bool)$classified->is_add_enquiry,
            'is_facebook_share' => (bool)$classified->is_facebook_share,
            'is_watsapp_share' => (bool)$classified->is_watsapp_share,
            'is_googleplus_share' => (bool)$classified->is_googleplus_share,
            'is_twitter_share' => (bool)$classified->is_twitter_share,
            'is_direct_message_share' => (bool)$classified->is_direct_message_share,
            'is_gmail_share' => (bool)$classified->is_gmail_share,
            'is_linkedin_share' => (bool)$classified->is_linkedin_share,
            'is_email_share' => (bool)$classified->is_email_share,
            'is_views_analytics' => (bool)$classified->is_views_analytics,
            'is_enquires_analytics' => (bool)$classified->is_enquires_analytics,
            'is_sends_analytics' => (bool)$classified->is_sends_analytics,
            'is_gradeit_analytics' => (bool)$classified->is_gradeit_analytics,
            'is_visibility_summary_analytics' => (bool)$classified->is_visibility_summary_analytics,
            'start_date' => $classified->start_date,
            'end_date' => $classified->end_date,
            'location' => $classified->location,
            'contact' => $classified->contact,
            'images' => $classified->images,
            'tags' => $classified->tags,
            'created_at' => $classified->created_at,
            'updated_at' => $classified->updated_at,
            'owner_id' => $classified->user_id
        ];
    }
}