<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends AppController {

	/**
	 * Send newsletter
	 * email id
	 *
	 */
	public function sendNewsletter()
	{
		try {

			$NewsletterUser = Input::all();
			$userArray = $NewsletterUser['data'];
			$emailString = $userArray['emailIds'];
			$content = $userArray['message'];
			$sender_id = $userArray['sender_id'];
			$sender_email = User::with('profile')->where('id', $sender_id)->first();
			$sender = $sender_email->email;

			$emailArray = explode(',', $emailString);

			foreach ($emailArray as $email) {

				$user = array(
					'email' => $email,
					'fromUser' => $sender
				);
				
				$data = array(
					'name'	=> $email,
					'content' => $content
				);

				Mail::send('emails.newsletter', $data, function($message) use ($user)
				{
					$message->from($user['fromUser'], $user['fromUser']);
					$message->to($user['email'], 'Evezown')->subject('Evezown Newsletter');
				});
			}

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}

		$successResponse = [
			'status' => true,
			'message' => 'Invite sent successfully!'
		];

		return $this->setStatusCode(200)->respond($successResponse);
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