<?php


class LastSeen extends \Eloquent {
	public $table = 'last_seen';

	public $belongs_to = array( 'user' => array('model'=>'user_model'));

	public function update_lastSeen($user = 0)
	{
		$last_msg = ChatMessage::where('to', $user)->orderBy('time', 'desc')->first();
		$msg = !empty($last_msg) ? $last_msg->id : 0;

		$record = $this->get_by('user_id', $user);
		$details = array('user_id' => $user,'chat_message_id' => $msg);
		if(!empty($msg))
		{
			if(empty($record))
			{
				$this->insert($details);
			}else
			{
				$lastSeen = LastSeen::find($record->id);
				$lastSeen-> user_id = $user;
				$lastSeen-> chat_message_id = $msg;
				$lastSeen->save();
			}
		}
	}
	
	public function get_by($col, $val)
	{
		return DB::table($this->table)->where($col, $val)->first();
	}
}
	