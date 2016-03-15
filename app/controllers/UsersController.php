<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Tymon\JWTAuth\Facades\JWTAuth;
use Zizaco\Confide\Facade;


/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends AppController
{
    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $code = $inputs_array['code'];
            $email = $inputs_array['email'];

            if (!$this->isValidInviteCode($code, $email)) {
                return $this->setStatusCode(404)->respondWithError("The invite code in not valid for the email.");
            }

            $isEmailExist = User::where('email', $email)->first();

            if (is_null($isEmailExist)) {

                $repo = App::make('UserRepository');
                $user = $repo->signup($inputs_array);

                // Add default avatar image for user.
                UserProfileImage::create([
                    'user_id' => $user->id,
                    'image_id' => 360
                ]);

                // Claim the code so that it will not be misused by someone else.
                $invite = Invite::where('code', $code)->first();

                $invite->claimed_at = new DateTime('today');

                $invite->save();

                if ($user->id) {
                    // Send confirmation email to user.
                    $emailUser = array(
                        'email' => $user->email,
                        'name' => $user->email
                    );

                    $data = array(
                        'name' => $user->email,
                        'code' => $user->confirmation_code
                    );

                    /*Mail::send('emails.confirmation', $data, function ($message) use ($emailUser) {
                        $message->from('admin@evezown.com', 'Evezown Team');
                        $message->to($emailUser['email'], $emailUser['name'])->subject('Evezown Account Confirmation');
                    });*/

                } else {
                    $error = $user->errors()->all(':message');

                    return $this->setStatusCode(500)->respondWithError($error);
                }

                $successResponse = [
                    'status' => true,
                    'message' => 'User registered successfully!',
                    'UserID' => $user->id
                ];

                return $this->setStatusCode(200)->respond($successResponse);
            }
            else
            {
                return $this->setStatusCode(500)->respondWithError("The account already exists with the e-mail: " .$email);
            }
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * create new user from admin
     *
     * @return  Illuminate\Http\Response
     */
    public function createNewUser()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];
			
            $isEmailExist = User::where('email', $inputs_array['email'])->first();
                        
            if (is_null($isEmailExist)) {
            	$repo = App::make('UserRepository');
            	$user = $repo->signup($inputs_array);
            	
            	// Add default avatar image for user.
            	UserProfileImage::create([
            	'user_id' => $user->id,
            	'image_id' => 360
            	]);
            	
            	
            	if ($user->id) {
            	
            		$successResponse = [
            		'status' => true,
            		'message' => 'User registered successfully!'
            				];
            		return $this->setStatusCode(200)->respond($successResponse);
            	
            	} else {
            		return $this->setStatusCode(500)->respondWithError("User registration failed.");
            	}
            }else{
            	return $this->setStatusCode(500)->respondWithError("The account already exists with the e-mail: ".$inputs_array['email']);
            }
      
        } catch (Exception $e) {
            	return $this->setStatusCode(500)->respondWithError("User registration failed.");
        }
    }

    /**
     * Validate the invite code received by the user.
     * @param $code
     * @return mixed
     */
    private function isValidInviteCode($code, $email)
    {
        try {
            $invite = DB::table('invites')
                ->where('code', '=', $code)
                ->where('email', '=', $email)
                ->where('claimed_at', '=', null)
                ->first();

            if (is_null($invite)) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            $errorResponse = [
                errorValue => $e,
                errorMessage => 'This is failing'
            ];

            return $this->setStatusCode(200)->respondWithError($errorResponse);
        }
    }

    /**
     * Get all the profile details of the user.
     * @param $user_id
     * @return mixed
     */
    public function show($user_id)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($user_id);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new UserTransformer);

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Get all the profile details of the user.
     * @param $api_key
     * @return mixed
     */
    public function getUserDetailsByApiKey()
    {
        try {

            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $api_key = $inputs_array['api_key'];

            $repo = App::make('UserRepository');

            $user = $repo->getUserDetailsByApiKey($api_key);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new UserTransformer);

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password']
        ];

        if ( ! $token = JWTAuth::attempt($credentials)) {

            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');

            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');

            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');

            }

            return $this->setStatusCode(403)->respondWithError($err_msg);
        }
        else {
            // Get the user details and provide a response.
            $user = $repo->getUserProfileDetailsOnLogin($input);

            $user['token'] = $token;

            $fractal = new Manager();

            $usersResource = new Item($user, new UserTransformer);

            return $fractal->createData($usersResource)->toJson();
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {

            // Make the user friend of the referrer on confirm.
            $regUser = User::where('confirmation_code', $code)->first();

            // Send welcome email to user notifying about successful registration.
            $user = array(
                'email' => $regUser->email,
                'name' => $regUser->email
            );

            $data = array(
                'name' => $regUser->email,
            );

            Mail::send('emails.welcome', $data, function ($message) use ($user) {
                $message->from('admin@evezown.com', 'Evezown Team');
                $message->to($user['email'], $user['name'])->subject('Welcome to Evezown');
            });

            $invite = Invite::where('email', $regUser->email)->first();

            // Check whether the referrer is evezown member? If yes, get the details.
            if ($invite != null && $invite->is_evezown_member) {
                $referrerUser = User::where('email', $invite->referrer_email)->first();

                if ($referrerUser != null) {
                    // Get the newly registered user using the registered email.
                    $registeredUser = User::where('email', $invite->email)->first();

                    if ($registeredUser != null) {
                        Friend::create([
                            'friend_user_id' => $referrerUser->id,
                            'user_id' => $registeredUser->id,
                            'status' => 1
                        ]);

                        // Make sure that referred user also has a mapping for the friendship.
                        Friend::create([
                            'friend_user_id' => $registeredUser->id,
                            'user_id' => $referrerUser->id,
                            'status' => 1
                        ]);
                    }
                }
            }

            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return $this->setStatusCode(200)->respond($notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return $this->setStatusCode(403)->respondWithError($error_msg);
        }
    }

    /**
     * Get the invite history for the users)
     *
     * @return  Illuminate\Http\Response
     */
    public function inviteHistory($user_id)
    {

        try {

            $User = User::where('id', $user_id)->first();

            $UserEmail = $User->email;

            $limit = Input::get('limit') ?: 10;

            $invites = Invite::where('referrer_email', $UserEmail)->paginate($limit);
            
            if (!$invites->isEmpty()) 
            {
                foreach ($invites as $key => $value)
                {
                  if(empty($value->claimed_at))
                  {
                    $check_invite_exist = User::where('email', $value->email)->first();

                    if(!$check_invite_exist)
                    {
                      $value->status = 'Pending';
                    }else{
                      $value->status = 'Registered';
                    }
                  }
               }
            }

            if (!$invites) {
                return $this->responseNotFound('Invites Not Found!');
            }

            $fractal = new Manager();

            $invitesResource = new Collection($invites, new InviteTransformer);

            $invitesResource->setPaginator(new IlluminatePaginatorAdapter($invites));

            $data = $fractal->createData($invitesResource);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }

        return $data->toJson();
    }

    /**
     * Attempt to change password in depth profile(programmer defined - sajin)
     *
     * @return  Illuminate\Http\Response
     */
    public function ChangePassword()
    {
        try {

            $input = Input::all();
            $inputArray = $input['data'];
            $Userid = $inputArray['Userid'];
            $CurrentPass = $inputArray['current_password'];
            $NewPass = $inputArray['new_password'];
            $ConfirmPass = $inputArray['confirm_password'];
            
            $OldPass = DB::select('select password from users where id =?', [$Userid]);
            $OldPassword = $OldPass[0]->password;
           
            if (Hash::check($CurrentPass, $OldPassword)) {
                
                $Encpt = Hash::make($NewPass);

                DB::table('users')
                    ->where('id', $Userid)
                    ->update(array('password' => $Encpt));
                return $this->setStatusCode(200)->respond("Password Changed Successfully");
            
            }else{

                return $this->setStatusCode(404)->respondWithError("Invalid Old Password");
            }
            
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError('Error occured! Please try later');
        }
    }

    /**
     * Attempt to send change password link to the given email(Programmer defined - sajin)
     *
     * @return  Illuminate\Http\Response
     */
    public function ForgotPassword()
    {
        try {

            $input = Input::all();
            $inputArray = $input['data'];
            $UserEmail = $inputArray['emailid'];
            $CheckUser = User::where('email', $UserEmail)->first();
            
            if($CheckUser == null)
            {
                //no user exist
                return $this->setStatusCode(404)->respondWithError("No user exist with this Emailid");
            }
            else
            {
                //send link
                $UserID = $CheckUser->id;
                $Code = md5(90*13+$UserID);

                $user = array(
                        'sender'  => "admin@evezown.com",
                        'receiver'    => $UserEmail,
                    );

                $data = array(
                        'email'  => $UserEmail,
                        'Code'    => $Code,
                    );

                Mail::send('emails.forgotPassword', $data, function($message) use ($user)
                {
                    $message->from('admin@evezown.com', 'Evezown Team');
                    $message->to($user['receiver'], $user['receiver'])->subject('Evezown.com Password Assistance');
                });
                return $this->setStatusCode(200)->respond("An email has been sent to the registered emailid");

            }
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError('Error occured! Please try later');
        }
    }

    /**
     * Attempt to send reset the password from the emaillink(Programmer defined - sajin)
     *
     * @return  Illuminate\Http\Response
     */
    public function ResetPassword()
    {
        try {

            $input = Input::all();
            $inputArray = $input['data'];
            $NewPass = $inputArray['Newpassword'];
            $Code = $inputArray['Code'];
            $CheckUser = DB::select('select id from users where md5(90*13+id) = ?', [$Code]);
            $CheckUserID = $CheckUser[0]->id;
            
            if($CheckUser == null)
            {
                return $this->setStatusCode(404)->respondWithError("User Dosen't Exist");
            }
            else
            {
                $Encpt = Hash::make($NewPass);

                DB::table('users')
                    ->where('id', $CheckUserID)
                    ->update(array('password' => $Encpt));
                return $this->setStatusCode(200)->respond("Reset Password Successful");
            }
            
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError('Error occured! Please try later');
        }
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return $this->setStatusCode(200)->respond($notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return $this->setStatusCode(403)->respondWithError($error_msg);
        }
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token' => Input::get('token'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return $this->setStatusCode(200)->respond($notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return $this->setStatusCode(403)->respondWithError($error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return $this->setStatusCode(200)->respond("Logged out successfully!");
    }

    /**
     * Display all the registered users and their status.
     * GET /user
     *
     * @param $admin_id
     * @return Response
     * @internal param $user_id
     */
    public function searchMembers()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $api_key = $inputs_array['api_key'];
            $search_key = $inputs_array['search_key'];

            $isValidApiKey = User::where('api_key', $api_key)->first();

            $user_id = $isValidApiKey['id'];

            if ($isValidApiKey == null) {
                return $this->setStatusCode(403)->respondWithError('Request is not authorized!');
            }

            $limit = Input::get('limit') ?: 15;

            try{
                $users = UserProfile::with('users', 'users.profile.profile_image')
                    ->where('firstname', 'LIKE', "$search_key%")
                    ->where('user_id', '<>', $user_id)
                    ->whereNotExists(function ($query) use ($user_id) {
                        $query->select(DB::raw(1))
                            ->from('friends')
                            ->whereRaw('friends.friend_user_id = user_profile.user_id')
                            ->whereRaw('friends.user_id = ' . $user_id);
                    })
                    ->paginate($limit);
            }
            catch (Exception $ex) {
             return $ex;
            }

            //  $users =UserProfile::with('users')->where('firstname', 'LIKE', "$search_key%");
            if (!$users) {
                return $this->responseNotFound('User Not Found!');
            }

//            $fractal = new Manager();
//
//            $usersResource = new Collection($users, new UserProfileTransformer);
//
//            $usersResource->setPaginator(new IlluminatePaginatorAdapter($users));
//
//            $data = $fractal->createData($usersResource);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }

        return $users->toJson();
    }


    /**
     * Update profile picture.
     * @param $userId
     * @param $imageId
     * @return mixed
     */
    public function updateProfilePic()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $userId = $inputs_array['user_id'];
            $imageName = $inputs_array['image_name'];

            $evezImg = EvezownImage::create([
                    'large_image_url' => $imageName
                ]
            );

            $profileImage = UserProfileImage::create([
                'user_id' => $userId,
                'image_id' => $evezImg->id
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'Profile pic updated successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getCurrentProfilePic($userId)
    {
        try {
            $profileImage = UserProfileImage::with('image')->where('user_id', $userId)->orderBy('created_at', 'DESC')->first();

            if (!$profileImage) {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.
                return null;
            } else {
                return $profileImage->image['large_image_url'];
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }


    /**
     * @param $userId
     * @return mixed|string
     */
    public function getBottomProfilePic($userId)
    {
        try {
            $bottomImagePointer = ProfileCoverPic::where('user_id', $userId)->first();

            if (!$bottomImagePointer) {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.

                return null;
            } else {
                if ($bottomImagePointer->bottom_image_id != 0) {
                    $bottomImage = EvezownImage::where('id', $bottomImagePointer->bottom_image_id)->orderBy('created_at', 'DESC')->first();
                    return $bottomImage->large_image_url;
                } else {
                    return null;
                }

            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getLeftProfilePic($userId)
    {
        try {
            $leftImagePointer = ProfileCoverPic::where('user_id', $userId)->first();

            if (!$leftImagePointer) {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.

                return null;
            } else {
                if ($leftImagePointer->left_image_id != 0) {
                    $leftImage = EvezownImage::where('id', $leftImagePointer->left_image_id)->orderBy('created_at', 'DESC')->first();
                    return $leftImage->large_image_url;
                } else {
                    return null;
                }

            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }


    /**
     * @param $userId
     * @return mixed|string
     */
    public function getRightProfilePic($userId)
    {
        try {
            $rightImagePointer = ProfileCoverPic::where('user_id', $userId)->first();

            if (!$rightImagePointer) {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.

                return null;
            } else {
                if ($rightImagePointer->right_image_id != 0) {
                    $rightImage = EvezownImage::where('id', $rightImagePointer->right_image_id)->orderBy('created_at', 'DESC')->first();
                    return $rightImage->large_image_url;
                } else {
                    return null;
                }
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getAllProfilePics($userId)
    {
        try {
            $profileImages = UserProfileImage::with('image')->where('user_id', $userId)->get();

            if (!$profileImages) {
                return $this->setStatusCode(404)->respondWithError('No profile images updated!');
            }

            $fractal = new Manager();

            $profileImagesResource = new Collection($profileImages, new ProfileImageTransformer());

            $data = $fractal->createData($profileImagesResource);

            return $data->toJson();

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    /**
     * Update profile picture.
     * @param $userId
     * @param $imageId
     * @return mixed
     */
    public function updateLeftCoverPic()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $userId = $inputs_array['user_id'];
            $imageName = $inputs_array['image_name'];

            $evezImg = EvezownImage::create([
                    'large_image_url' => $imageName
                ]
            );

            $profileCoverPic = ProfileCoverPic::firstOrCreate(array('user_id' => $userId));

            $profileCoverPic->left_image_id = $evezImg->id;

            $profileCoverPic->save();

            $successResponse = [
                'status' => true,
                'message' => 'Left cover pic updated successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    /**
     * Update profile picture.
     * @param $userId
     * @param $imageId
     * @return mixed
     */
    public function updateRightCoverPic()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $userId = $inputs_array['user_id'];
            $imageName = $inputs_array['image_name'];

            $evezImg = EvezownImage::create([
                    'large_image_url' => $imageName
                ]
            );

            $profileCoverPic = ProfileCoverPic::firstOrCreate(array('user_id' => $userId));

            $profileCoverPic->right_image_id = $evezImg->id;

            $profileCoverPic->save();

            $successResponse = [
                'status' => true,
                'message' => 'Right cover pic updated successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    /**
     * Update profile picture.
     * @param $userId
     * @param $imageId
     * @return mixed
     */
    public function updateBottomCoverPic()
    {
        try {
            $inputs = Input::all();

            $inputs_array = $inputs['data'];

            $userId = $inputs_array['user_id'];
            $imageName = $inputs_array['image_name'];

            $evezImg = EvezownImage::create([
                    'large_image_url' => $imageName
                ]
            );

            $profileCoverPic = ProfileCoverPic::firstOrCreate(array('user_id' => $userId));

            $profileCoverPic->bottom_image_id = $evezImg->id;

            $profileCoverPic->save();

            $successResponse = [
                'status' => true,
                'message' => 'Bottom cover pic updated successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

}
