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
	    // $this->s_user = $this->session->userdata('user');
	    // if(empty($this->s_user)){
	    //     redirect(site_url('login'));
	    // } 
	    $this->data['active_menu'] = 'project';
		$this->load->helper('project_helper');
		$this->load->database();
		$this->data['project_lists'] = get_project_data();
		$this->data['style_links'] 	= array('pages/css/profile.min.css');
	}
	public function index()
	{
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('manage_project'),
				'name'	=> 'Home'
			), 
			'1' => array(
				'url'	=> '',
				'name'	=> 'Edit profile'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$passwords = $this->generateMultipleRandomPasswords(4);
		$this->data['passwords'] = $passwords;

		//start code for get office details
		$stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetUserDetailbyId @UserId = 0');
		if (!$stmt) {
		    return false;
		}

		$user_resultSets = array();
		do {
		    $resultSet = array();
		    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		        $resultSet[] = $row;
		    }
		    $user_resultSets[] = $resultSet;
		} while (sqlsrv_next_result($stmt));
		$office_details = array();
		if(isset($user_resultSets[1])){
		    $office_details = $user_resultSets[1];
		}
		$state = array();
		if(isset($user_resultSets[2])){
		    $state = $user_resultSets[2];
		}
		sqlsrv_free_stmt($stmt);
		$this->data['state'] = $state;
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
}
