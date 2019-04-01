<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model', 'User_m', TRUE); 
		$this->load->library('session'); 
	}

	public function login()
	{
		$email = $this->input->post('email'); 
		$password = $this->input->post('password'); 
		
		$result = $this->User_m->login($email, $password); 

		if(count($result) >0)
		{
			$session_user = array(
			'email' => $email, 
			'user_id' => $result[0]->{'user_id'}, 
			'user_name' =>$result[0]->{'user_name'}, 
			'password' => $password, 
			'logged_in => TRUE');

	 		$this->session->set_userdata($session_user); 
	 		echo json_encode($result); 

		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/board/index");
	}


}