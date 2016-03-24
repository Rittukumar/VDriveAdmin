<?php

class OneOnOneChatController extends AppController
{
	protected $smiley_url;
	private $chatAuthRepository;
	private $chatMessage;
	private $lastSeen;

	public function __construct(ChatMessage $chatMessage,LastSeen $lastSeen)
	{
		//parent::__construct();
		$this->smiley_url = asset('app/custom/OneOnOneChat/images/smileys');
		$this->chatAuthRepository = App::make('ChatAuthRepository');
		$this->chatMessage = $chatMessage;
		$this->lastSeen = $lastSeen;
	}


	public function getMessages(){
		
		$per_page = 5; //get paginated messages 
		$post     = \Input::All();
		$buddy    = $post['user'];
		$me       = $post['me'];
		$limit    = !empty($post['limit']) ? $post['limit'] : $per_page ;
        $user     = $this->chatAuthRepository->read('identifier', $me);
		$messages = array_reverse($this->chatMessage ->conversation($user, $buddy, $limit));
		$total    = $this->chatMessage ->thread_len($user, $buddy);
        
		
		$thread = [];
		foreach ($messages as $message) {

			$owner = User::with('profile','profile.profile_image')->where('id', $message->from)->first();
			
			$chat = [
				'msg' 		=> $message->id,
				'sender' 	=> $message->from, 
				'recipient' => $message->to,
				'avatar' 	=> !empty($owner->profile->profile_image->large_image_url)? asset('v1/image/show/'.$owner->profile->profile_image->large_image_url) : asset('images/avatar.png'),
				'body' 		=> UIHelper::parse_smileys($message->message, $this->smiley_url,'',$message->urlPresenter),
				'time' 		=> date("M j, Y, g:i a", strtotime($message->time)),
				'type'		=> $message->from == $user ? 'out' : 'in',
				'name'		=> $message->from == $user ? 'You' : ucwords($owner->profile->firstname)
				];
			array_push($thread, $chat);
		}
		
        
		    $chatbuddy = User::with('profile','profile.profile_image')->where('id', $buddy)->first();
		
			$status    = trim(UIHelper::getchatStatus($chatbuddy->online_status)) == 'success' ? 1 : 0;
		
		$contact = [
			'name'      => ucwords($chatbuddy->profile->firstname),
			'status'    => $status,
			'id'        => $chatbuddy->id,
			'me'        => $me,
			'limit'     => $limit + $per_page,
			'more'      => $total  <= $limit ? false : true, 
			'scroll'    => $limit > $per_page  ?  false : true,
			'remaining' => $total - $limit
			];
       

		$response = [
					'success' => true,
					'errors'  => '',
					'message' => '',
					'buddy'	  => $contact,
					'thread'  => $thread
					];
		
		return $response;
		
	}


	public function saveMessage(){
        
        $me         = \Input::all()['me'];
		$buddy 		= \Input::all()['user'];
		$message 	= \Input::all()['message'];
        
		$logged_user = $this->chatAuthRepository->read('identifier',$me);

		    $regex = '/https?\:\/\/[^\" ]+/i';
	        preg_match_all($regex, $message, $matches);
	        $urls         = $matches[0]; 
	        $urlPresenter = [];
	         
	        if(!empty($urls))
	        {
	         foreach($urls as $url)
	         {
	           $urlPresenter_temp = UIHelper::file_get_contents_curl($url);

	           if(!empty($urlPresenter_temp))
	                $urlPresenter[] = $urlPresenter_temp;

	         }
	        }

	    $message = preg_replace('/(https?|http|ssh|ftp):\/\/[^\s"]+/', '<a href="$0" target="_blank">$0</a>', $message);
       	
		if($message != '' && $buddy != '')
		{
			$message = \ChatMessage::create([
				'from' 		  => $logged_user,
				'to' 		  => $buddy,
				'message' 	  => $message,
				'urlPresenter'=> json_encode($urlPresenter),
			]);
			$msg_id = $message->id;
			$msg = ChatMessage::find($msg_id);

			$owner = User::with('profile','profile.profile_image')->where('id', $msg->from)->first();
			$chat = [
				'msg' 		=> $msg->id,
				'sender' 	=> $msg->from, 
				'recipient' => $msg->to,
				'avatar' 	=> !empty($owner->profile->profile_image->large_image_url)? asset('v1/image/show/'.$owner->profile->profile_image->large_image_url) : asset('images/avatar.png'),
				'body' 		=> UIHelper::parse_smileys($msg->message, $this->smiley_url,'',$message->urlPresenter),
				'time' 		=> date("M j, Y, g:i a", strtotime($msg->time)),
				'type'		=> $msg->from == $logged_user ? 'out' : 'in',
				'name'		=> $msg->from == $logged_user ? 'You' : ucwords($owner->profile->firstname),
				'urlPresenter'=> json_decode($msg->urlPresenter)
				];

			$response = [
				'success' => true,
				'message' => $chat 	  
				];
		}
		else{
			  $response = [
				'success' => false,
				'message' => 'Empty fields exists'
				];
		}
		
		return $response;	
    }


	public function doUpdates(){

        $me         = \Input::all()['me']; 
		$userId 	= $this->chatAuthRepository->read('identifier',$me);

		$lastSeen   = ChatMessage::whereTo($userId)
			                       ->whereIsRead(true)
			                       ->orderBy('time', 'desc')
			                       ->first();

		$unread    = ChatMessage::whereTo($userId)
									->whereIsRead(false)
									->orderBy('time', 'asc')
									->get();

		$senders = [];
		$thread = [];

		foreach($unread as $message) {
			// Create sender array if it does not exist
			if ( ! array_key_exists($message->from, $senders))
				$senders[$message->from] = ['count' => 0];

			// Increase the sender count
			$senders[$message->from]['count']++;

            $owner = User::with('profile','profile.profile_image')->where('id', $message->from)->first();

			$thread[] = [
				'msg'       => $message->id,
				'sender'    => $message->from,
				'recipient' => $message->to,
				'avatar'    => !empty($owner->profile->profile_image->large_image_url)? asset('v1/image/show/'.$owner->profile->profile_image->large_image_url) : asset('images/avatar.png'),
				'body'      => UIHelper::parse_smileys($message->message, $this->smiley_url),
				'time' 		=> date("M j, Y, g:i a", strtotime($message->time)),
				'type'		=> $message->from == $userId ? 'out' : 'in',
				'name'		=> $message->from == $userId ? 'You' : ucwords($owner->profile->firstname)
			];

		};
		$groups = [];
		foreach ($senders as $key=>$sender) {
			$sender = ['user'=> $key, 'count'=>$sender['count'] ];
			array_push($groups, $sender);
		}
		$this->lastSeen->update_lastSeen($userId);
		
		$someArray = array('success' => true,
							'messages' => $thread,
							'senders' => $groups);

		return Response::json($someArray);

	}

	
	public function markRead()
	{

		$Id          = \Input::all()['id']; 
		$chatMessage = ChatMessage::find($Id);
		$chatMessage->mark_read();
	}


	public function chatstatusUpdate()
	{
        
		$Id     = Input::get('id');
		$status = Input::get('status');
		
		$status1 = User::where('id', '=', $Id)->update(['online_status'=> $status]);
		 
		return json_encode(array('return_status' => 'success' ));
		
	}


	public function getUnreadCount()
	{
		$user = Input::get('id');
		$unreadCount = ChatMessage::whereTo($user)->where('is_read', '=', false)->count();
		return json_encode($unreadCount);
	}


	public function getUserOnlineStatus($Id)
	{
		$user   = User::find($Id);
		$status = trim(UIHelper::getchatStatus($user->online_status));

		return $status;
		
	}
	
	
	
	
}
