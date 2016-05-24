<?php 

use Config;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Firebase\JWT\JWT;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class AuthController extends AppController {


    private $UserRepository;

    public function __construct()
    {
        $this->UserRepository = App::make('UserRepository');
    }

    /**
     * Generate JSON Web Token.
     */
    protected function createToken($user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }


     /**
      * Login with Facebook.
      */
    public function facebook()
    {
        
        $client = new GuzzleHttp\Client();

        $params = [
            'code'          => \Input::all()['code'],
            'client_id'     => \Input::all()['clientId'],
            'redirect_uri'  => \Input::all()['redirectUri'],
            'client_secret' =>  Config::get('app.facebook_secret')
        ];

       
        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/oauth/access_token', [
            'query' => $params
        ]);
        
        $accessToken = json_decode($accessTokenResponse->getBody(), true);
        
        // Step 2. Retrieve profile information about the current user.
        $fields = 'id,email,first_name,last_name,link,name,picture';
        $profileResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/me', [
            'query' => [
                'access_token' => $accessToken['access_token'],
                'fields' => $fields
            ]
        ]);

        $profile = json_decode($profileResponse->getBody(), true);

        $provider          = 'facebook'; 
        $providerId        = $profile['id']; 
        $providerUsername  = $profile['name'];
        $providerEmail     = $profile['email']; 
        $providerPicture   = isset($profile['picture']['data']['url'])?$profile['picture']['data']['url']: '';
        $providerfirstName = $profile['first_name']; 
        $providerlastName  = $profile['last_name'];
         

        // Step 3a. If user is already exists return an existing one.
        $user = User::where('facebook', '=', $profile['id'])->where('deleted','')->where('blocked','')->first();
        
        if ($user)
        {
            $this->updateUserProfile($user->id, $providerfirstName, $providerlastName, $providerPicture);
            return $this->getUserDetails($user->id);
        }

        // Step 3b. If user is already signed in then link accounts.
        $user = User::where('email', '=', $profile['email'])->where('deleted','')->where('blocked','')->first();

        if ($user)
        {
            $user = User::find($user->id);
            $user->facebook = $profile['id'];
            $user->save();
            
            $this->updateUserProfile($user->id, $providerfirstName, $providerlastName, $providerPicture);
            return $this->getUserDetails($user->id);
        }

        // Step 3c. If user does not exists Create a new user account.
        $user = User::where('email', '=', $profile['email'])->first();

        if ($user)
        {
          return Response::json(['message' => 'There is already a Facebook account that belongs to you is Blocked Or Deleted'], 409);

        }else{

            $user = $this->saveProviderUserDetails($provider, $providerId, $providerUsername, $providerEmail, $providerPicture, $providerfirstName, $providerlastName);
            
            return $this->getUserDetails($user->id);
        }
    }


    /**
     * Login with Google.
     */
    public function google()
    {    

        $client = new GuzzleHttp\Client();

        $params = [
            'code'          => \Input::all()['code'],
            'client_id'     => \Input::all()['clientId'],
            'client_secret' =>  Config::get('app.google_secret'),
            'redirect_uri'  => \Input::all()['redirectUri'],
            'grant_type'    => 'authorization_code',
        ];


        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
            'form_params' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://www.googleapis.com/plus/v1/people/me/openIdConnect', [
            'headers' => array('Authorization' => 'Bearer ' . $accessToken['access_token'])
        ]);

        $profile = json_decode($profileResponse->getBody(), true);

        $provider          = 'google'; 
        $providerId        = $profile['sub']; 
        $providerUsername  = $profile['name'];
        $providerEmail     = $profile['email'];
        $providerPicture   = isset($profile['picture'])?$profile['picture']:'';  
        $providerNames     = explode(' ', $profile['name']);
        $providerfirstName = isset($providerNames[0])?$providerNames[0]:''; 
        $providerlastName  = isset($providerNames[1])?$providerNames[1]:'';
         
      
        // Step 3a. If user is already exists return an existing one.
        $user = User::where('google', '=', $profile['sub'])->where('deleted','')->where('blocked','')->first();

        if ($user)
        {
            $this->updateUserProfile($user->id, $providerfirstName, $providerlastName, $providerPicture);
            return $this->getUserDetails($user->id);
        }
        
        // Step 3b. If user is already signed in then link accounts.
        $user = User::where('email', '=', $profile['email'])->where('deleted','')->where('blocked','')->first();

        if ($user)
        {
            $user = User::find($user->id);
            $user->google = $profile['sub'];
            $user->save();
            
            $this->updateUserProfile($user->id, $providerfirstName, $providerlastName, $providerPicture);
            return $this->getUserDetails($user->id);
        }

        // Step 3c. If user does not exists Create a new user account.
        $user = User::where('email', '=', $profile['email'])->first();

        if ($user)
        {
          return Response::json(['message' => 'There is already a Google account that belongs to you is Blocked Or Deleted'], 409);

        }else{

            $user = $this->saveProviderUserDetails($provider, $providerId, $providerUsername, $providerEmail, $providerPicture, $providerfirstName, $providerlastName);
            
            return $this->getUserDetails($user->id);
        }
    }


    /**
     * Login with LinkedIn.
     */
    public function linkedin()
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'code'          => \Input::all()['code'],
            'client_id'     => \Input::all()['clientId'],
            'client_secret' =>  Config::get('app.linkedin_secret'),
            'redirect_uri'  => \Input::all()['redirectUri'],
            'grant_type'    => 'authorization_code',
        ];

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://www.linkedin.com/uas/oauth2/accessToken', [
            'form_params' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://api.linkedin.com/v1/people/~:(id,first-name,last-name,email-address,picture-url )', [
            'query' => [
                'oauth2_access_token' => $accessToken['access_token'],
                'format' => 'json'
            ]
        ]);

        $profile = json_decode($profileResponse->getBody(), true);

        $provider          = 'linkedin'; 
        $providerId        = $profile['id']; 
        $providerUsername  = $profile['firstName'].' '.$profile['lastName'];
        $providerEmail     = $profile['emailAddress']; 
        $providerPicture   = isset($profile['pictureUrl'])?$profile['pictureUrl']:'';
        $providerfirstName = $profile['firstName']; 
        $providerlastName  = $profile['lastName'];
        
        
        // Step 3a. If user is already exists return an existing one.
        $user = User::where('linkedin', '=', $profile['id'])->where('deleted','')->where('blocked','')->first();

        if ($user)
        {
            $this->updateUserProfile($user->id, $providerfirstName, $providerlastName, $providerPicture);
            return $this->getUserDetails($user->id);
        }
        
        // Step 3b. If user is already signed in then link accounts.
        $user = User::where('email', '=', $profile['emailAddress'])->where('deleted','')->where('blocked','')->first();

        if ($user)
        {
            $user = User::find($user->id);
            $user->linkedin = $profile['id'];
            $user->save();

            $this->updateUserProfile($user->id, $providerfirstName, $providerlastName, $providerPicture);
            return $this->getUserDetails($user->id);
        }

        // Step 3c. If user does not exists Create a new user account.
        $user = User::where('email', '=', $profile['emailAddress'])->first();

        if ($user)
        {
          return Response::json(['message' => 'There is already a Linkedin account that belongs to you is Blocked Or Deleted'], 409);

        }else{

            $user = $this->saveProviderUserDetails($provider, $providerId, $providerUsername, $providerEmail, $providerPicture, $providerfirstName, $providerlastName);
            
            return $this->getUserDetails($user->id);
       
        }

    }


    public function saveProviderUserDetails($provider, $providerId, $providerUsername, $providerEmail, $providerPicture, $providerfirstName, $providerlastName)
    {
        $user = new User;
        $user->$provider = $providerId;
        $user->username  = $providerUsername;
        $user->email     = $providerEmail;
        $user->save();

        $profileId = DB::table('user_profile')->insert(array(
                         'firstname' => $providerfirstName,
                         'lastname'  => $providerlastName,
                         'user_id'   => $user->id
                      ));

        $role = Role::find(3);
        $user = User::find($user->id);
        $user->attachRole($role);
        
        $evezImg = '';

        //create user profile image
        if(!empty($providerPicture)){

            $picture = $this->downloadSocialProfileImage($providerPicture, $user->id);

            $evezImg = EvezownImage::create([
                        'large_image_url' => $picture
                    ]
                );
        }

        //link user profile image (create) /*Add default avatar image for user if profilePicture empty*/.
        UserProfileImage::create([
            'user_id'  => $user->id,
            'image_id' => empty($evezImg)? 360 : $evezImg->id
        ]);

        return $user;
    }


    public function getUserDetails($Id)
    {
        $user = User::find($Id);
        $user->last_login    = new DateTime; 
        $user->online_status = 1;
        $user->save();

        $user = User::with('profile')->find($Id);

        $user['token'] = $this->createToken($user);

        $fractal = new Manager();

        $usersResource = new Item($user, new UserTransformer);

        return $fractal->createData($usersResource)->toJson();
    }


    public function updateUserProfile($userId, $providerfirstName, $providerlastName, $providerPicture)
    {

        UserProfile::where('user_id', $userId)
                     ->update(['firstname' => $providerfirstName,
                               'lastname'  => $providerlastName]);

        $userPictureId = UserProfileImage::where('user_id', $userId)->pluck('image_id');

        if($userPictureId != 360){

            //update user profile image
            if(!empty($providerPicture)){

                $picture = $this->downloadSocialProfileImage($providerPicture, $userId);
                
                $evezImg = EvezownImage::where('id', $userPictureId)
                                         ->update(['large_image_url' => $picture]);

            }
            
        }else{

            //create user profile image
            if(!empty($providerPicture)){

                $picture = $this->downloadSocialProfileImage($providerPicture, $userId);
                
                $evezImg = EvezownImage::create([
                            'large_image_url' => $picture
                        ]
                    );
            
            //link user profile image (update)
            UserProfileImage::where('user_id', $userId)
                              ->update(['image_id' => $evezImg->id]);

            }

        }

    }


    public function downloadSocialProfileImage($providerPicture, $userId){

        $extn      = '.jpg';
        $filename  = $userId.'_'.$userId.''.$extn;
        $imagePath = public_path() . '/images/' . $filename;

        $ch = curl_init($providerPicture);
        $fp = fopen($imagePath, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return $filename;

    }


}
