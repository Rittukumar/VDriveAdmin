<?php
use Illuminate\Database\Eloquent\Model;


class ChatMessage extends Model {

	public $message_rules = array(
		    'message' => array (
					'field' => 'message',
					'label' => 'message',
					'rules' => 'trim|required|xss_clean'
			)
		);
    /**
     * @var string
     */
    protected $table = 'chat_messages';

	protected $guarded = ['id'];
	
	public function conversation($user, $chatbuddy, $limit = 5, $skip =0){
       /* $this->db->where('from', $user);
        $this->db->where('to', $chatbuddy);
        $this->db->or_where('from', $chatbuddy);
        $this->db->where('to', $user);
        $this->db->order_by('id', 'desc');
        $messages = $this->db->get($this->table, $limit);
	    * */
		$messages = DB::table($this->table)-> where('from','=', $user)
					-> where('to', '=', $chatbuddy)->orWhere('from', $chatbuddy)
					-> where('to','=', $user)->orderBy('id', 'desc')->skip($skip)
					->take($limit)->get(); // limit - 5
        
        //$this->db->where('to', $user)->where('from',$chatbuddy)->update($this->table, array('is_read'=>'1'));
		DB::table($this->table)-> where('to', '=', $user)
		->where('from','=', $chatbuddy)
		 ->update(['is_read' => '1']);
		//->update($this->table, array('is_read'=>'1'));
		//DB::table($this->table)-> where('from', $user->id)-> where('to', $chatbuddy->id)->orWhere('from', $chatbuddy->id)
        return $messages;
	}
	
	public function thread_len($user, $chatbuddy)
	{
        $messages  = DB::table($this->table)
        					 -> where('from', '=', $user)
        					 -> where('to', '=', $chatbuddy)
        					 -> orWhere('from', '=', $chatbuddy)
        					 -> where('to','=', $user)
        					 -> orderBy('id', 'desc')
        					 -> count();
        return $messages;
	}

	public function latest_message($userId, $last_seen){
		$messages = DB::table($this->table)->where('to','=', $userId)
							  ->where('id', '>', $last_seen)
							  ->orderBy('time', 'desc')
							  -> count();
							  //->get();

		if($messages > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function new_messages($user, $last_seen){
		$message  = DB::table($this->table)->where('to', '=', $user)
							  ->where('id', '>', $last_seen)
							  ->orderBy('time', 'asc')
							  ->first();

		return $message;
	}

	public function unread($user){
		$messages  =  self::where('to','=', $user)
			->where('is_read','=', '0')
			->orderBy('time', 'asc')
			->first();

		return $messages;
	}
	
	public function mark_read()
	{
		// Correct way
		$this->is_read = true;
		$this->save();
	}

	public function unread_per_user($id, $from){
		$count  =  DB::table($this->table)->where('to', $id)
							->where('from','=', $from->id)
							->where('is_read', '=', '0')
							->count();
		return $count;
	}

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

	public function owner()
	{
		return $this->belongsTo('User', 'from');
	}

	public function getAvatar()
	{
		return ($this->owner && $this->owner->avatar) ? $this->owner->avatar : asset('images/avatar.png');
	}


}