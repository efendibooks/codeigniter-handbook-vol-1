<?php

class User_model extends MY_Model
{
	public $before_create = array( 'hash_password' );

	public $validate = array(
		array( 'field' => 'username', 'label' => 'Username', 'rules' => 'required|max_length[20]|alpha_dash' ),
		array( 'field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[8]' ),
		array( 'field' => 'email', 'label' => 'Email', 'rules' => 'valid_email' )
	);

	public function confirmed()
	{
		$this->db->where('confirmed', TRUE);
		return $this;
	}

	public function favorited()
	{
		$db = DB('default');
		
		$fav = $db->select('user_id')->get('favorites')->result();		
		$ids = array();

		foreach ($fav as $row)
		{
			$ids[] = $row->user_id;
		}

		$db->close();
		$this->db->where_in('id', $ids);
		
		return $this;
	}

	public function hash_password($user)
	{
		$user['password'] = sha1($user['password']);
		return $user;
	}
}