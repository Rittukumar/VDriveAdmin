<?php

use Zizaco\Confide\Facade;


/**
 * Class UserRepository
 *
 * This service abstracts some interactions that occurs between Confide and
 * the Database.
 */
class UserRepository
{
    /**
     * Signup a new account with the given parameters
     *
     * @param  array $input Array containing 'username', 'email' and 'password'.
     *
     * @return  User User object that may or may not be saved successfully. Check the id to make sure.
     */
    public function signup($input)
    {
        $user = new User();
        $user->email = array_get($input, 'email');
        $user->password = array_get($input, 'password');
        $user->password_confirmation = array_get($input, 'password');
        $user->username = array_get($input, 'email');
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->save();

        $profileId = DB::table('user_profile')->insert(array(
            'firstname' => array_get($input, 'firstname'),
            'lastname' => array_get($input, 'lastname'),
            'user_id' => $user->id
        ));

        // Role of User associated to registering member.
        $roleId = array_get($input, 'role');
        $role = Role::find($roleId);

        $user = User::find($user->id);
        $user->attachRole( $role );

        if (!$user->id) {
            Log::info('Unable to create user ' . $user->id, (array)$user->id->errors());
        } else {
            Log::info('Created user "' . $user->id . '" <' . $user->id . '>');
        }


        return $user;
    }

    /**
     * Attempts to login with the given credentials.
     *
     * @param  array $input Array containing the credentials (email/username and password)
     *
     * @return  boolean Success?
     */
    public function login($input)
    {
        if (! isset($input['password'])) {
            $input['password'] = null;
        }

        Event::listen('auth.login', function($user){ 
            $user->last_login    = new DateTime; 
            $user->online_status = 1;
            $user->save();
        });


        return Confide::logAttempt($input, Config::get('confide::signup_confirm'));
    }

    /**
     * Checks if the credentials has been throttled by too
     * much failed login attempts
     *
     * @param $input
     * @return bool Is throttled
     * @internal param array $credentials Array containing the credentials (email/username and password)
     *
     */
    public function isThrottled($input)
    {
        return Confide::isThrottled($input);
    }

    /**
     * Update the specified resource in storage.
     * PUT /user/{id}
     *
     * @param $input
     * @return Response
     * @internal param int $id
     */
    public function updateAboutMe($input)
    {
        try {
            $aboutMe = $input['aboutme'];

            $userid = $input['user_id'];

            $user = User::with('profile')->find($userid);
            $profile = $user->profile ?: new UserProfile;
            $profile->about_me = $aboutMe;
            $user->UserProfile()->save($profile);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $input
     * @return bool
     */
    public function savePersonalInfo($input){
        try {
        	
        	//$userid = $input['userId'];
        	$userid = $input['profileUserId'];       	
        	
        
                      
            $userProfile = UserProfile::find($userid);

            if(!$userProfile) {
                return 404;
            }

            if(isset($input['firstname']))
            {
                $userProfile->firstname = $input['firstname'];
            }

            if(isset($input['lastname']))
            {
                $userProfile->lastname = $input['lastname'];
            } 

            if(isset($input['phone']))
            {
                $userProfile->phone = $input['phone'];
            } 

            if(isset($input['country']))
            {
                $userProfile->country = $input['country'];
            }    
            
            if(isset($input['state']))
            {
                $userProfile->state = $input['state'];
            }  

            if(isset($input['city']))
            {
                $userProfile->city = $input['city'];
            }  

            if(isset($input['streetAddress']))
            {
                $userProfile->street_address = $input['streetAddress'];
            } 

            if(isset($input['zip']))
            {
                $userProfile->zip = $input['zip'];
            } 

            if(isset($input['education1']))
            {
               $userProfile->education1 = $input['education1'];
            } 

            if(isset($input['education2']))
            {
                $userProfile->education2 = $input['education2'];
            } 

            if(isset($input['education3']))
            {
                $userProfile->education3 = $input['education3'];
            }  
            
            if(isset($input['skills']))
            {
                $userProfile->skills = $input['skills'];
            }  
            
            if(isset($input['language1']))
            {
               $userProfile->language1 = $input['language1'];
            }  
            
            if(isset($input['language2']))
            {
                $userProfile->language2 = $input['language2'];
            }  
            
            if(isset($input['language3']))
            {
                $userProfile->language3 = $input['language3'];
            }  
            
            if(isset($input['profession']))
            {
                $userProfile->profession = $input['profession'];
            }  
            
            if(isset($input['name_organization1']))
            {
                $userProfile->name_organization1 = $input['name_organization1'];            
            }

            if(isset($input['designation1']))
            {
                $userProfile->designation1 = $input['designation1'];
            
            }  

            if(isset($input['work_experience1']))
            {
                $userProfile->work_experience1 = $input['work_experience1'];            
            }

            if(isset($input['other_info1']))
            {
               $userProfile->other_info1 = $input['other_info1'];
            }  


            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return 500;
        }
    }
//saveInterestInfo


    public function saveInterestInfo($input){
        try {
                $inputArray = $input['data'];
                $userid = $inputArray['user_id'];
                $userProfile = UserProfile::find($userid);
                if(!$userProfile) {
                    return 404;
                }
                $userProfile->favourite_topic = $inputArray['interests'];
                $userProfile->save();
            return 200;
        } catch (Exception $e)
        {

            return $e;
        }
    }

    /**
     * @param $input
     * @return bool
     */
    public function saveEnhancedProfile($input){
        try {

            $userid = $input['userId'];

            $userProfile = UserProfile::find($userid);

            if(!$userProfile) {
                return 404;
            }

            $userProfile->want_profile = $input['wantProfilePage'];
            $userProfile->about_me = $input['aboutme'];
            $userProfile->profile_page_type = $input['profilePageType'];
            $userProfile->hobbies = $input['hobbies'];
            $userProfile->talents = $input['talents'];
            $userProfile->achievements = $input['achievements'];
            $userProfile->interests = $input['interests'];
            $userProfile->interested_in_content_creation = $input['interestedInContentCreation'];
            $userProfile->need_customized_profile_page = $input['needEnhancedProfile'];
            $userProfile->need_marketing_support = $input['needMarketingSupport'];
            $userProfile->need_professional_website_link = $input['needProfessionalWebsiteLink'];
            $userProfile->professional_website_link = $input['professionalWebsiteLink'];
            $userProfile->resume_visibility = $input['resumeVisibility'];

            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return 500;
        }
    }

    /**
     * @param $input
     * @return int
     */
    public function saveOnlineProfile($input) {
        try {

            $userid = $input['userId'];

            $userProfile = UserProfile::find($userid);

            if(!$userProfile) {
                return 404;
            }

            $userProfile->website_link = $input['website'];
            $userProfile->linkedin_address = $input['linkedin'];
            $userProfile->facebook_address = $input['facebook'];
            $userProfile->twitter_link = $input['twitter'];
            $userProfile->pinterest_link = $input['pinterest'];
            $userProfile->google_plus_link = $input['googlePlus'];
            $userProfile->youtube_link = $input['youtube'];
            $userProfile->other_social_link = $input['otherSocial'];
            $userProfile->ecommerce_link = $input['ecommerce'];

            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return 500;
        }
    }


    //saveOtherServicesProfile

    /**
     * @param $input
     * @return int
     */
    public function saveOtherServicesProfile($input) {
        try {

            $userid = $input['userId'];

            $userProfile = UserProfile::find($userid);


            if(!$userProfile) {
                return 404;
            }

            if(isset($input['need_wopportunity_listing']))
            {
                $userProfile->need_wopportunity_listing = $input['need_wopportunity_listing'];
            }

            if(isset($input['need_resume_upload']))
            {
                $userProfile->need_resume_upload = $input['need_resume_upload'];
            }

            if(isset($input['full_time_job']))
            {
                $userProfile->full_time_job = $input['full_time_job'];
            }

            if(isset($input['part_time_job']))
            {
                $userProfile->part_time_job = $input['part_time_job'];
            }

            if(isset($input['flexi_job']))
            {
                $userProfile->flexi_job = $input['flexi_job'];
            }
            if(isset($input['short_assignment']))
            {
                $userProfile->short_assignment = $input['short_assignment'];
            }

            if(isset($input['freelancing_job']))
            {
                $userProfile->freelancing_job = $input['freelancing_job'];
            }

            if(isset($input['interested_industry_sector']))
            {
                $userProfile->interested_industry_sector = $input['interested_industry_sector'];
            }

            if(isset($input['hire_through_evezown']))
            {
                $userProfile->hire_through_evezown = $input['hire_through_evezown'];
            }

            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * @param $input
     * @return int
     */
    public function saveReferenceProfile($input) {
        try {

            $userid = $input['userId'];

            $userProfile = UserProfile::find($userid);


            if(!$userProfile) {
                return 404;
            }

            if(isset($input['reference_name1']))
            {
                $userProfile->reference_name1 = $input['reference_name1'];
            }

            if(isset($input['reference_email1']))
            {
                $userProfile->referrer_email1 = $input['reference_email1'];
            }

            if(isset($input['reference_phone1']))
            {
                $userProfile->referrer_phone1 = $input['reference_phone1'];
            }

            if(isset($input['reference_name2']))
            {
                $userProfile->reference_name2 = $input['reference_name2'];
            }

            if(isset($input['reference_email2']))
            {
                $userProfile->referrer_email2 = $input['reference_email2'];
            }
            if(isset($input['reference_phone2']))
            {
                $userProfile->referrer_phone2 = $input['reference_phone2'];
            }

            if(isset($input['reference_name3']))
            {
                $userProfile->reference_name3 = $input['reference_name3'];
            }

            if(isset($input['reference_email3']))
            {
                $userProfile->referrer_email3 = $input['reference_email3'];
            }

            if(isset($input['reference_phone3']))
            {
                $userProfile->referrer_phone3 = $input['reference_phone3'];
            }

            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * @param $input
     * @return int
     */
    public function saveParticipationProfile($input) {
        try {

            $userid = $input['userId'];

            $userProfile = UserProfile::find($userid);

            if(!$userProfile) {
                return 404;
            }

            $userProfile->have_physical_online_store = $input['doYouHavePhysicalStore'];
            $userProfile->want_evezown_store = $input['doYouWantToOpenStore'];
            $userProfile->store_without_ecommerce = $input['storeFrontOnly'];
            $userProfile->store_with_payment_gateway = $input['storeWithPayment'];
            $userProfile->logistics_coordination_assistance = $input['needLogistics'];
            $userProfile->post_sales_support = $input['requirePostSalesSupport'];
            $userProfile->need_analytics = $input['likeSurvey'];

            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return 500;
        }
    }

    //savePartneringProfile

    /**
     * @param $input
     * @return int
     */
    public function savePartneringProfile($input) {
        try
        {
            $userid = $input['userId'];
            $userProfile = UserProfile::find($userid);
            if(!$userProfile) {
                return 404;
            }
            $userProfile->through_blogs = $input['through_blogs'];
            $userProfile->through_forums = $input['through_forums'];
            $userProfile->through_events = $input['through_events'];
            $userProfile->through_recco = $input['through_recco'];
            $userProfile->as_woice_user = $input['as_woice_user'];
            $userProfile->as_evangelist = $input['as_evangelist'];
            $userProfile->as_active_writer = $input['as_active_writer'];
            $userProfile->as_ecommerce = $input['as_ecommerce'];
            $userProfile->other_ideas = $input['other_ideas'];
            $userProfile->interested_in_content_creation = $input['interested_in_content_creation'];

            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return $e;
        }
    }

    //savePartneringProfile

    /**
     * @param $input
     * @return int
     */
    public function saveFeedbackProfile($input) {
        try {

            $userid = $input['userId'];

            $userProfile = UserProfile::find($userid);

            if(!$userProfile) {
                return 404;
            }

            $userProfile->feedback = $input['feedback'];
            $userProfile->save();

            return 200;
        } catch (Exception $e) {
            return 500;
        }
    }


    //saveFeedbackProfile

    /**
     * Checks if the given credentials correponds to a user that exists but
     * is not confirmed
     *
     * @param $input
     * @return bool Exists and is not confirmed?
     * @internal param array $credentials Array containing the credentials (email/username and password)
     *
     */
    public function existsButNotConfirmed($input)
    {
        $user = Confide::getUserByEmailOrUsername($input);

        if ($user) {
            $correctPassword = Hash::check(
                isset($input['password']) ? $input['password'] : false,
                $user->password
            );

            return (! $user->confirmed && $correctPassword);
        }
    }

    /**
     * @param $input
     * @return mixed
     */
    public function getUserProfileDetailsOnLogin($input)
    {
        $result = Confide::getUserByEmailOrUsername($input);

        $this->login($input);

        $user = User::with('profile')->find($result->id);

        return $user;
    }

    /**
     * @param $userId
     * @return mixed
     * @internal param $input
     */
    public function getUserProfileDetails($userId)
    {
        $user = User::with('profile')->find($userId);

        return $user;
    }

    /**
     * Get the user based on api key
     * @param $api_key
     * @return mixed
     */
    public function getUserDetailsByApiKey($api_key)
    {
        $user = User::with('profile')->where('api_key', $api_key)->first();

        return $user;
    }

    /**
     * Resets a password of a user. The $input['token'] will tell which user.
     *
     * @param  array $input Array containing 'token', 'password' and 'password_confirmation' keys.
     *
     * @return  boolean Success
     */
    public function resetPassword($input)
    {
        $result = false;
        $user   = Confide::userByResetPasswordToken($input['token']);

        if ($user) {
            $user->password              = $input['password'];
            $result = $this->save($user);
        }

        // If result is positive, destroy token
        if ($result) {
            Confide::destroyForgotPasswordToken($input['token']);
        }

        return $result;
    }

    /**
     * Simply saves the given instance
     *
     * @param  User $instance
     *
     * @return  boolean Success
     */
    public function save(User $instance)
    {
        return $instance->save();
    }
}
