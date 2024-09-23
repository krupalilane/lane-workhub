<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_profile extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct(); 
	    $this->s_user = $this->session->userdata('user');
	    if(empty($this->s_user)){
	        redirect(site_url('login'));
	    } 
	    $this->data['active_menu'] = 'edit_profile';
		$this->load->database();
		$this->data['javascripts'] 	= array('edit_profile.js');
	}
	public function index()
	{
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			), 
			'1' => array(
				'url'	=> '',
				'name'	=> 'Edit Profile'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$passwords = $this->generateMultipleRandomPasswords(4);
		$this->data['passwords'] = $passwords;
	}
	function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    
	    return $randomString;
	}

	function generateRandomLength() {
	    return rand(8, 20);
	}

	function generateMultipleRandomPasswords($count = 4) {
	    $passwords = [];
	    
	    for ($i = 0; $i < $count; $i++) {
	        $length 		= $this->generateRandomLength();
	        $passwords[] 	= $this->generateRandomString($length);
	    }
	    
	    return $passwords;
	}
	public function password_check() {
	    $password          = $this->input->post('newpassword');
	    if (preg_match('/[A-Z]/', $password) && 
	        preg_match('/[a-z]/', $password) && 
	        preg_match('/\d/', $password)) {
	        return TRUE;
	    } else {
	        $this->form_validation->set_message('password_check', 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.');
	        return FALSE;
	    }
	}
	
	public function update_user_password()
	{
		$this->form_validation->set_rules('newpassword', 'Password', 'trim|required|callback_password_check');
		$this->form_validation->set_rules('rnewpassword', 'Re-type Password', 'trim|matches[newpassword]');
		if ($this->form_validation->run() != FALSE){
		    $param = array(
		        'UserID'      => $this->session->userdata('user')['id'],
		        'Password'    => md5($this->input->post('newpassword')),
		        'LoggedInUserId'      => $this->session->userdata('user')['id']
		    );
		    $add_user_db = "EXEC USP_UpdateUserPassword 
		        @UserID             = ?,   
		        @NewPassword		= ?,
		        @LoggedInUserId		= ?;";
		        $user_add = $this->db->query($add_user_db,$param);
		        $result   = $user_add->result_array();
		        redirect(site_url('Edit_profile/edit_success'));
		}else{
		    $this->session->set_flashdata('error',validation_errors());
		    redirect(site_url('edit_profile'));
		}
	}
	public function edit_success()
	{
		$this->data['javascripts'] 	= array('edit_profile_success.js');
	}
}
