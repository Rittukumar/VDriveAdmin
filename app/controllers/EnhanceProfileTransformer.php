<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class EnhanceProfileTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'    => (int) $user['id'],
            'wantProfilePage' => $user->profile['want_profile'],
            'profilePageType' => $user->profile['profile_page_type'],
            'aboutme' => $user->profile['about_me'],
            'hobbies' => $user->profile['hobbies'],
            'talents' => $user->profile['talents'],
            'achievements' => $user->profile['achievements'],
            'interests' => $user->profile['interests'],
            'interestedInContentCreation' => (bool) $user->profile['interested_in_content_creation'],
            'needEnhancedProfile' => (bool) $user->profile['need_customized_profile_page'],
            'needMarketingSupport' => (bool) $user->profile['need_marketing_support'],
            'needProfessionalWebsiteLink' => (bool) $user->profile['need_professional_website_link'],
            'professionalWebsiteLink' => $user->profile['professional_website_link'],
            'resumeVisibility' => (bool) $user->profile['resume_visibility']
        ];
    }
}