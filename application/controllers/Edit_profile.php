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
		$this->load->helper('project_helper');
		$this->load->database();
		$this->data['project_lists'] = get_project_data();
		$this->data['style_links'] 	= array('pages/css/profile.min.css');
		$this->data['js_links']    = array('global/plugins/jquery-validation/js/jquery.validate.min.js','global/plugins/jquery-validation/js/additional-methods.min.js');
		$this->data['javascripts']  = array('edit_profile.js');
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
		$stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetUserDetailbyId @UserId = '.$this->session->userdata('user')['id']);
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
		$user_details = array();
		if(isset($user_resultSets[0][0])){
		    $user_details = $user_resultSets[0][0];
		}
		$office_details = array();
		if(isset($user_resultSets[1])){
		    $office_details = $user_resultSets[1];
		}

		$state = array();
		if(isset($user_resultSets[2])){
		    $state = $user_resultSets[2];
		}

		sqlsrv_free_stmt($stmt);
		$this->data['state'] 			= $state;
		$this->data['office_details'] 	= $office_details;
		$this->data['user_details'] 	= $user_details;
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
	public function check_email()
	{
	    $email          = $this->input->post('email');
	    $email_query    = $this->db->query("EXEC stormconfig.USP_CheckEmailAddress @EmailAddress = ?;",$email);
	    $result         = $email_query->row_array();

	    if (!empty($result)) {
	        $response = ['exists' => true];
	    } else {
	        $response = ['exists' => false];
	    }
	    $this->output
	    ->set_status_header(200)
	    ->set_content_type('application/json')
	    ->set_output(json_encode($response))
	    ->_display();
	    die;
	}
	public function check_current_pasword()
	{
		$password  = md5($this->input->post('password'));

		//start code for get office details
		$stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetUserDetailbyId @UserId = '.$this->session->userdata('user')['id']);
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
		$user_details = array();
		if(isset($user_resultSets[0][0])){
		    $user_details = $user_resultSets[0][0];
		}
		if (!empty($user_details)) {
			if ($user_details['Password'] != $password) {
		    	$response = ['exists' => true];
			}else{
				$response = ['exists' => false];
			}
		}else{
		    $response = ['exists' => true];
		}
		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response))
		->_display();
		die;
	}
	function check_user_exist(){
	    $email          = $this->input->post('emailnew');
	    $email_query    = $this->db->query("EXEC stormconfig.USP_CheckEmailAddress @EmailAddress = ?;",$email);
	    $result         = $email_query->row_array();

	    if (!empty($result)) {
	        $this->form_validation->set_message('check_user_exist', 'User with same email already exist!');
	        return false;
	    }else{
	        return true;
	    }
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
	public function password_check_exist() {
	    $password  = md5($this->input->post('currentpassword'));
	    $user_id   = $this->input->post('user_id');

	    //start code for get office details
	    $stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetUserDetailbyId @UserId = '.$this->session->userdata('user')['id']);
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
	    $user_details = array();
	    if(isset($user_resultSets[0][0])){
	        $user_details = $user_resultSets[0][0];
	    }
	    if (!empty($user_details)) {
	    	if ($user_details['Password'] != $password) {
	        	$this->form_validation->set_message('password_check_exist', 'The current password  not matched!');
	        	return FALSE;
	    	}else{
	    		return true;
	    	}
	    }else{
	        $this->form_validation->set_message('password_check_exist', 'Something went wrong!');
	        return FALSE;
	    }
	}
	public function update_user_profile()
	{
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'last Name', 'trim|required');
		$this->form_validation->set_rules('localoffice', 'Local Office', 'trim|required');

		if ($this->form_validation->run() != FALSE){      
		    $param = array(
		        'UserID'                                                   => $this->input->post('user_id'),
		        'SectionId'                                                => 1,
		        'FirstName'                                                => $this->input->post('firstname'),
		        'MiddleName'                                               => '',
		        'LastName'                                                 => $this->input->post('lastname'),
		        'Email'                                                    => '',
		        'OfficeId'                                                 => $this->input->post('localoffice'),
		        'Password'                                                 => '',
		        'CompanyName'                                              => $this->input->post('company_name'),
		        'Phone'                                                    => $this->input->post('phone'),
		        'Address1'                                                 => $this->input->post('address1'),
		        'Address2'                                                 => $this->input->post('address2'),
		        'City'                                                     => $this->input->post('city'),
		        'StateId'                                                  => $this->input->post('state'),
		        'ZipCode'                                                  => $this->input->post('zip'),
		        'AgreeUserLicense'                                         => '',
		        'AgreeTermsOfUse'                                          => '',
		        'IsAgreeToRecPromEmailFromLaneStormStorage'                => 0,
		        'IsAgreeToRecNotifEmailFromLaneStormStorage'               => 0,
		        'IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage'   => 0,
		        'LoggedInUserID'                                           => $this->session->userdata('user')['id']
		    );
		    $add_user_db = "EXEC stormconfig.USP_InsertUpdateUserData 
		        @UserID                                                    = ?,  
		        @SectionId                                                 = ?,  
		        @FirstName                                                 = ?,  
		        @MiddleName                                                = ?,  
		        @LastName                                                  = ?,  
		        @Email                                                     = ?,  
		        @OfficeId                                                  = ?,  
		        @Password                                                  = ?,  
		        @CompanyName                                               = ?,  
		        @Phone                                                     = ?,  
		        @Address1                                                  = ?,  
		        @Address2                                                  = ?,  
		        @City                                                      = ?,  
		        @StateId                                                   = ?,  
		        @ZipCode                                                   = ?,  
		        @AgreeUserLicense                                          = ?,  
		        @AgreeTermsOfUse                                           = ?,  
		        @IsAgreeToRecPromEmailFromLaneStormStorage                 = ?,  
		        @IsAgreeToRecNotifEmailFromLaneStormStorage                = ?,  
		        @IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage    = ?,  
		        @LoggedInUserID                                            = ?;";
		        $user_add = $this->db->query($add_user_db,$param);
		        $result   = $user_add->result_array();
		        $new_data = ['id' => $this->input->post('user_id'),'firstname' => $this->input->post('firstname'),'lastname' => $this->input->post('lastname')];

                $this->session->set_userdata('user', $new_data);
		        $this->session->set_flashdata('success',"Profile Information Updated.");
		        redirect(site_url('edit_profile'));
		}else{
		    $this->session->set_flashdata('error',validation_errors());
		    redirect(site_url('edit_profile'));
		}
	}
	public function update_user_email()
	{
		$this->form_validation->set_rules('emailnew', 'Email', 'trim|required|valid_email|callback_check_user_exist');
		$this->form_validation->set_rules('remailnew', 'Re-type Email', 'trim|matches[emailnew]');

		if ($this->form_validation->run() != FALSE){      
			$param = array(
		        'UserID'                                                   => $this->input->post('user_id'),
		        'SectionId'                                                => 2,
		        'FirstName'                                                => '',
		        'MiddleName'                                               => '',
		        'LastName'                                                 => '',
		        'Email'                                                    => $this->input->post('emailnew'),
		        'OfficeId'                                                 => '',
		        'Password'                                                 => '',
		        'CompanyName'                                              => '',
		        'Phone'                                                    => '',
		        'Address1'                                                 => '',
		        'Address2'                                                 => '',
		        'City'                                                     => '',
		        'StateId'                                                  => '',
		        'ZipCode'                                                  => '',
		        'AgreeUserLicense'                                         => '',
		        'AgreeTermsOfUse'                                          => '',
		        'IsAgreeToRecPromEmailFromLaneStormStorage'                => 0,
		        'IsAgreeToRecNotifEmailFromLaneStormStorage'               => 0,
		        'IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage'   => 0,
		        'LoggedInUserID'                                           => $this->session->userdata('user')['id']
		    );
		    $add_user_db = "EXEC stormconfig.USP_InsertUpdateUserData 
		        @UserID                                                    = ?,  
		        @SectionId                                                 = ?,  
		        @FirstName                                                 = ?,  
		        @MiddleName                                                = ?,  
		        @LastName                                                  = ?,  
		        @Email                                                     = ?,  
		        @OfficeId                                                  = ?,  
		        @Password                                                  = ?,  
		        @CompanyName                                               = ?,  
		        @Phone                                                     = ?,  
		        @Address1                                                  = ?,  
		        @Address2                                                  = ?,  
		        @City                                                      = ?,  
		        @StateId                                                   = ?,  
		        @ZipCode                                                   = ?,  
		        @AgreeUserLicense                                          = ?,  
		        @AgreeTermsOfUse                                           = ?,  
		        @IsAgreeToRecPromEmailFromLaneStormStorage                 = ?,  
		        @IsAgreeToRecNotifEmailFromLaneStormStorage                = ?,  
		        @IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage    = ?,  
		        @LoggedInUserID                                            = ?;";
		        $user_add = $this->db->query($add_user_db,$param);
		        $result   = $user_add->result_array();

		        $this->session->unset_userdata('user');
		        $this->session->sess_destroy();
		        
		        $this->session->set_flashdata('success',"Email details Updated.");
		        redirect(site_url('login'));
		}else{
		    $this->session->set_flashdata('error',validation_errors());
		    redirect(site_url('register'));
		}
		
	}
	public function update_user_password()
	{
		$this->form_validation->set_rules('currentpassword', 'Current Password', 'trim|required|callback_password_check_exist');
		$this->form_validation->set_rules('newpassword', 'Password', 'trim|required|callback_password_check');
		$this->form_validation->set_rules('rnewpassword', 'Re-type Password', 'trim|matches[newpassword]');
		if ($this->form_validation->run() != FALSE){
		    $param = array(
		        'UserID'                                                   => $this->input->post('user_id'),
		        'SectionId'                                                => 3,
		        'FirstName'                                                => '',
		        'MiddleName'                                               => '',
		        'LastName'                                                 => '',
		        'Email'                                                    => '',
		        'OfficeId'                                                 => '',
		        'Password'                                                 => md5($this->input->post('newpassword')),
		        'CompanyName'                                              => '',
		        'Phone'                                                    => '',
		        'Address1'                                                 => '',
		        'Address2'                                                 => '',
		        'City'                                                     => '',
		        'StateId'                                                  => '',
		        'ZipCode'                                                  => '',
		        'AgreeUserLicense'                                         => '',
		        'AgreeTermsOfUse'                                          => '',
		        'IsAgreeToRecPromEmailFromLaneStormStorage'                => 0,
		        'IsAgreeToRecNotifEmailFromLaneStormStorage'               => 0,
		        'IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage'   => 0,
		        'LoggedInUserID'                                           => $this->session->userdata('user')['id']
		    );
		    $add_user_db = "EXEC stormconfig.USP_InsertUpdateUserData 
		        @UserID                                                    = ?,  
		        @SectionId                                                 = ?,  
		        @FirstName                                                 = ?,  
		        @MiddleName                                                = ?,  
		        @LastName                                                  = ?,  
		        @Email                                                     = ?,  
		        @OfficeId                                                  = ?,  
		        @Password                                                  = ?,  
		        @CompanyName                                               = ?,  
		        @Phone                                                     = ?,  
		        @Address1                                                  = ?,  
		        @Address2                                                  = ?,  
		        @City                                                      = ?,  
		        @StateId                                                   = ?,  
		        @ZipCode                                                   = ?,  
		        @AgreeUserLicense                                          = ?,  
		        @AgreeTermsOfUse                                           = ?,  
		        @IsAgreeToRecPromEmailFromLaneStormStorage                 = ?,  
		        @IsAgreeToRecNotifEmailFromLaneStormStorage                = ?,  
		        @IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage    = ?,  
		        @LoggedInUserID                                            = ?;";
		        $user_add = $this->db->query($add_user_db,$param);
		        $result   = $user_add->result_array();

		        $this->session->unset_userdata('user');
		        $this->session->sess_destroy();

		        $this->session->set_flashdata('success',"Password is updated.");
		        redirect(site_url('login'));
		}else{
		    $this->session->set_flashdata('error',validation_errors());
		    redirect(site_url('edit_profile'));
		}
	}
	public function update_user_privacy()
	{
		$param = array(
	        'UserID'                                                   => $this->input->post('user_id'),
	        'SectionId'                                                => 4,
	        'FirstName'                                                => '',
	        'MiddleName'                                               => '',
	        'LastName'                                                 => '',
	        'Email'                                                    => '',
	        'OfficeId'                                                 => '',
	        'Password'                                                 => '',
	        'CompanyName'                                              => '',
	        'Phone'                                                    => '',
	        'Address1'                                                 => '',
	        'Address2'                                                 => '',
	        'City'                                                     => '',
	        'StateId'                                                  => '',
	        'ZipCode'                                                  => '',
	        'AgreeUserLicense'                                         => '',
	        'AgreeTermsOfUse'                                          => '',
	        'IsAgreeToRecPromEmailFromLaneStormStorage'                => $this->input->post('subscribe_promo'),
	        'IsAgreeToRecNotifEmailFromLaneStormStorage'               => $this->input->post('subscribe_notify'),
	        'IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage'   => $this->input->post('subscribe_news'),
	        'LoggedInUserID'                                           => $this->session->userdata('user')['id']
	    );
	    $add_user_db = "EXEC stormconfig.USP_InsertUpdateUserData 
	        @UserID                                                    = ?,  
	        @SectionId                                                 = ?,  
	        @FirstName                                                 = ?,  
	        @MiddleName                                                = ?,  
	        @LastName                                                  = ?,  
	        @Email                                                     = ?,  
	        @OfficeId                                                  = ?,  
	        @Password                                                  = ?,  
	        @CompanyName                                               = ?,  
	        @Phone                                                     = ?,  
	        @Address1                                                  = ?,  
	        @Address2                                                  = ?,  
	        @City                                                      = ?,  
	        @StateId                                                   = ?,  
	        @ZipCode                                                   = ?,  
	        @AgreeUserLicense                                          = ?,  
	        @AgreeTermsOfUse                                           = ?,  
	        @IsAgreeToRecPromEmailFromLaneStormStorage                 = ?,  
	        @IsAgreeToRecNotifEmailFromLaneStormStorage                = ?,  
	        @IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage    = ?,  
	        @LoggedInUserID                                            = ?;";
	        $user_add = $this->db->query($add_user_db,$param);
	        $result   = $user_add->result_array();

	        $this->session->set_flashdata('success',"Privacy Settings Updated!");
		    redirect(site_url('edit_profile'));
	}
}
