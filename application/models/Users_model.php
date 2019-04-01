<?php 

class Users_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}

	public function login($email, $password)
	{	
		$sql=" select user_id, user_name, email, password, department_id from users where email='" . $email . "' and password='" . $password . "' ";
		$query = $this->db->query($sql); 
		return $query->result(); 
	}

}