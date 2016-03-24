<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InviteController extends AppController {

	/**
	 * Validate the invite code received by the user.
	 * @param $code
	 * @return mixed
	 */
	public function getValidInviteByCode($code, $email)
	{
		try {
			$invite = DB::table('invites')
				->where('code', '=', $code)
				->where('email', '=', $email)
				->where('claimed_at', '=', null)
				->first();

			if (is_null($invite)) {
				return $this->setStatusCode(404)->respondWithError("Invite code does not exist for the entered email");
			}

			return $this->setStatusCode(200)->respond($invite);
		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError("Error occurred!");
		}
	}

	/**
	 * Get the user based on invite code.
	 * @param $code
	 * @return mixed
	 */
	public function getInvite($code)
	{
		try {
			$invite = DB::table('invites')
				->where('code', '=', $code)
				->where('claimed_at', '=', null)
				->first();

			if (is_null($invite)) {
				return $this->setStatusCode(404)->respondWithError("Invite code is already claimed!");
			}

			return $this->setStatusCode(200)->respond($invite);
		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError("Error occurred!");
		}
	}

	/**
	 * Get invite code based on email
	 * @param $code
	 * @return mixed
	 */
	public function getInviteCode($email)
	{
		try {
			$invite = DB::table('invites')
				->where('email', '=', $email)
				->where('claimed_at', '=', null)
				->first();

			if (is_null($invite)) {
				return $this->setStatusCode(404)->respondWithError("Invite code does not exist for the entered email");
			} else {
				return $this->setStatusCode(200)->respond($invite->code);
            }
		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError("Error occurred!");
		}
	}

	/**
	 * Request invite
	 * GET /invite
	 *
     */
	public function requestInvite()
	{
		try {

            $inviteArray = Input::all();

			$locationResource = App::make('LocationResource');

			$name = $inviteArray['name'];
			$surname = $inviteArray['surname'];
			$email = $inviteArray['email'];
			$referrer_email = $inviteArray['referrer_email'];
			$referrer_name = $inviteArray['referrer_name'];

			$day = $inviteArray['day'];

			$month = $inviteArray['month'];
			$year = $inviteArray['year'];
			if(isset($inviteArray['is_evezown_member'])) {
				$isEvezownMember = $inviteArray['is_evezown_member'] ? 1 : 0;
			}
			else{
				$isEvezownMember = 0;
			}

			$profession = $inviteArray['profession'];
			$how_hear_evezown = $inviteArray['how_hear_evezown'];

            if(isset($inviteArray['facebook_link']))
                $facebook_link = $inviteArray['facebook_link'];
            else
                $facebook_link = '';

            if(isset($inviteArray['linkedin_link']))
                $linkedin_link = $inviteArray['linkedin_link'];
            else
                $linkedin_link = '';

            // Check if the referrer is already in the system.
			//	if(! DB::table('users')->where('email', $referrer_email)->first())
			//	{
			//				return $this->setStatusCode(404)->respondWithError("Referrer email is not registered with Evezown!");
			//	}



			$invite = DB::table('invites')->where('email', $email)->first();
			$Registred = DB::table('users')->where('email', $email)->first();

			if ($invite) {
				return $this->setStatusCode(409)->respondWithError("You have already sent an invite!");
			}
			if ($Registred) {
				return $this->setStatusCode(409)->respondWithError("You have registered already!");
			}

			$dob = DOB::create([
				'day' => $day,
				'month' => $month,
				'year' => $year
			]);

			// If invite is already not sent, then send one now!
			$invite = Invite::create([
				'name' => $name,
				'surname' => $surname,
				'email' => $email,
				'referrer_name' => $referrer_name,
				'referrer_email' => $referrer_email,
				'facebook_link' => $facebook_link,
				'linkedin_link' => $linkedin_link,
				'is_evezown_member' => $isEvezownMember,
				'how_hear_evezown' => $how_hear_evezown,
				'profession' => $profession
			]);

			$invite->dob_id = $dob->id;
			$invite->save();

			if (isset($inviteArray['location'])) {
				$locatonArray = $locationResource->getLocationDetails($inviteArray['location']);
			}

            // Parse the location details and store in invite_location table.

			$createdLocation = Location::create($locatonArray);

			InviteLocation::create([
				'location_id' => $createdLocation->id,
				'invite_id' => $invite->id
			]);

			// Accept the invite automatically as per the new CR
			$this->acceptInvite($invite['id']);

			// Commenting code as the new invite system should automatically accept invites.
			// Send an invite email to admin notifying the same.
//			$user = array(
//				'email' => $email,
//				'name' => $name
//			);
//
//			$data = array(
//				'name'	=> $name,
//				'surname'	=> $surname,
//				'email'	=> $email,
//				'referrerName'	=> $referrer_name,
//				'referrerEmail' => $referrer_email,
//				'city' => $createdLocation->city,
//				'state' => $createdLocation->state,
//				'country' => $createdLocation->country,
//			);
//
//			$emails = ['varsha.anand13@gmail.com', 'radhakrishnan.radha@gmail.com'];
//
//			Mail::send('emails.invite', $data, function($message) use ($user, $emails)
//			{
//				$message->from($user['email'], $user['name']);
//				$message->to($emails, 'Admin')->subject('Evezown Request Invite!');
//			});

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}

		$successResponse = [
			'status' => true,
			'message' => 'Invite sent successfully! You will receive a mail shortly with Sign up form link.'
		];

		return $this->setStatusCode(200)->respond($successResponse);
	}

	// Approve invite automatically.
	private function acceptInvite($invite_id)
	{
		$generatedCode = bin2hex(openssl_random_pseudo_bytes(16));

		$invite = Invite::find($invite_id);

		$invite->code = $generatedCode;

		if (!$invite->save()) {
			return $this->setStatusCode(422)->respondWithError('Accept invite failed!');
		}

		$user = array(
				'email' => $invite->email,
				'name' => $invite->email
		);

		$data = array(
				'name' => $user['name'],
				'inviteCode' => $invite->code
		);

		Mail::send('emails.register', $data, function ($message) use ($user) {
			$message->from('admin@evezown.com', 'Evezown Admin');
			$message->to($user['email'], $user['name'])->subject('Welcome to Evezown!');
		});
	}

	/**
	 * Request invite
	 * GET /invite
	 *
	 */
	public function sendEmailInvite()
	{
		try {

			$invite = Input::all();

			$inviteArray = $invite['data'];

			$emailString = $inviteArray['emailIds'];
			$referrer_id = $inviteArray['referrer_id'];
			$referrerUser = User::with('profile')->where('id', $referrer_id)->first();

			$ExistUser = array();
			$NewUser = 0;

			foreach ($emailString as $email) {

				$Check = User::where('email', $email)->first();

				if ($Check == null) 
				{
						//check invite is there already
						$GetInvite = Invite::where('referrer_email', $referrerUser->email)
									->where('email', '=', $email)
									->first();
						
						if ($GetInvite == null) 
						{		
								// Sending New Invite.
								$generatedCode = bin2hex(openssl_random_pseudo_bytes(16));
								
								$invite = Invite::create([
									'email' => $email,
									'referrer_name' => $referrerUser->profile['firstname'] . ', ' . $referrerUser->profile['lastname'],
									'referrer_email' => $referrerUser->email,
									'is_evezown_member' => 1,
									'code' => $generatedCode
								]);

								$user = array(
								'email' => $email,
								'name' => $email,
								'fromUser' => $invite['referrer_email']
								);

								$data = array(
									'name'	=> $email,
									'inviteCode'	=> $generatedCode,
								);

								Mail::send('emails.emailInvite', $data, function($message) use ($user)
								{
									$message->from($user['fromUser'], $user['fromUser']);
									$message->to($user['email'], 'Evezown')->subject('Evezown Request Invite!');
								});
								$NewUser = 1;
						}

						else
						{
							// Existing Invite update and sending reminder.
							$data = array(
									'name'	=> $GetInvite->email,
									'inviteCode'	=> $GetInvite->code
								);

							$user = array(
								'email' => $GetInvite->email,
								'name' => $GetInvite->email,
								'fromUser' => $GetInvite->referrer_email
								);

							//send remainder invite
							Mail::send('emails.emailInvite', $data, function($message) use ($user)
								{
									$message->from($user['fromUser'], $user['fromUser']);
									$message->to($user['email'], 'Evezown')->subject('Evezown Request Invite!');
								});

							//increment remainder count
							$GetInvite->reminder = $GetInvite->reminder + 1;

			            	$GetInvite->save();

			            	$NewUser = 1;//This is just for displaying the success message

						}				
						
				}
				else
				{
					$ExistUser[] = $email;
				}
			}
		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}

		$successResponse = [
			'status' => true,
			'message' => 'Invite sent successfully!',
			'ExistUser' => $ExistUser,
			'NewUser'	=> $NewUser
		];

		return $this->setStatusCode(200)->respond($successResponse);
	}

	/**
	 * Remainder invite
	 * sending invite again
	 *
	 */
	public function sendRemainderInvite()
	{
		try {

			$invite = Input::all();

			$inviteArray = $invite['data'];

			$emailString = $inviteArray['emailIds'];

			$referrer_id = $inviteArray['referrer_id'];

			$referrerUser = User::with('profile')->where('id', $referrer_id)->first();

			$Check = User::where('email', $emailString)->first();

			if($Check)
			{
				$successResponse = [
					'status' => true,
					'message' => 'It seems this user registered through other invite'
				];

				return $this->setStatusCode(200)->respond($successResponse);
			}
			else
			{
				//get the invite
				$GetInvite = Invite::where('referrer_email', $referrerUser->email)
					->where('email', '=', $emailString)
					->where('claimed_at', '=', null)
					->first();

				$data = array(
						'name'	=> $GetInvite->email,
						'inviteCode'	=> $GetInvite->code
					);

				$user = array(
					'email' => $GetInvite->email,
					'name' => $GetInvite->email,
					'fromUser' => $GetInvite->referrer_email
					);

				

				//send remainder invite
				Mail::send('emails.emailInvite', $data, function($message) use ($user)
					{
						$message->from($user['fromUser'], $user['fromUser']);
						$message->to($user['email'], 'Evezown')->subject('Evezown Request Invite!');
					});

				//increment remainder count
				$GetInvite->reminder = $GetInvite->reminder + 1;

            	$GetInvite->save();

				$successResponse = [
					'status' => true,
					'message' => 'Remainder sent successfully!'
				];

				return $this->setStatusCode(200)->respond($successResponse);
			}

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Delete Invite
	 * Delete the invite
	 *
	 */
	public function DeleteInvite()
	{
		try {

			$invite = Input::all();

			$inviteArray = $invite['data'];

			$emailString = $inviteArray['emailIds'];

			$referrer_id = $inviteArray['referrer_id'];

			$referrerUser = User::with('profile')->where('id', $referrer_id)->first();

			//get the invite
			$GetInvite = Invite::where('referrer_email', $referrerUser->email)
				->where('email', '=', $emailString)
				->where('claimed_at', '=', null)
				->first();

				if(!$GetInvite)
				{
					$successResponse = [
					'status' => true,
					'message' => 'Something went wrong. Please try again later.'
					];

					return $this->setStatusCode(200)->respond($successResponse);
				}
				else
				{
					//delete the invite from database
					$GetInvite->delete();

					$successResponse = [
					'status' => true,
					'message' => 'Invite Deleted successfully!'
					];

					return $this->setStatusCode(200)->respond($successResponse);
				}

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /invite/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}
}