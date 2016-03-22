<?php
/**
 * Created by Justin McCombs.
 * Date: 7/10/15
 * Time: 12:30 PM
 */

use Zizaco\Confide\Facade;

class ChatAuthRepository
{
	private $user_table;
	private $identifier_field;
	private $username_field;
	private $email_field;
	private $password_field;
	
	public function __construct()
	{
		$this->user_table       = Config::get('chat')['authentication']['user_table'];
		$this->identifier_field = Config::get('chat')['authentication']['identifier_field'];
		$this->username_field   = Config::get('chat')['authentication']['username_field'];
		$this->email_field      = Config::get('chat')['authentication']['email_field'];
		$this->password_field   = Config::get('chat')['authentication']['password_field'];
	}
	
	/**
	 * Read user details
	 *
	 * @access	public
	 * @return	mixed or FALSE
	 */
	public function read($key, $me)
	{

		// Only allow us to read certain data
		switch ($key)
		{
			case 'identifier': {

				// If the user is not logged in return false
				if (empty($me)) return false;

				// Return user identifier
				return (int) $me;

				break;

			}
			case 'username': {

				// If the user is not logged in return false
				if (empty($me)) return false;
                
				// Return username
				return $username = UserProfile::where('user_id', $me)->pluck('firstname');
				return (string) $username;

				break;

			}
			case 'login': {

				// If the user is not logged in return false
				if (empty($me)) return false;

				// Return time the user logged in at
				return (int) $me;

				break;

			}
			case 'logout': {

				// Return time the user logged out at
				return \Auth::logout();

				break;

			}
		}

		// If nothing has been returned yet
		return false;

	}
}
	