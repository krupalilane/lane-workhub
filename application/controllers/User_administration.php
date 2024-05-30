<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_administration extends MY_Controller {

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
	    $this->data['active_menu'] = 'user_administration';
		$this->load->helper('project_helper');
		$this->data['project_lists'] = get_project_data();
		$this->data['javascripts'] 	= array('user_administration.js');
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
				'name'	=> 'User Administration'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$users_submit_query  	= $this->db->query('EXEC stormconfig.USP_GetUserDetail');
		$this->data['users'] 	= $users_submit_query->result_array();
	}
	public function delete_user()
	{
		$user_id = $this->input->post('user_id');
		$user_delete_query = $this->db->query('EXEC stormconfig.USP_DeleteUser @UserId = '.$user_id.', @LoggedInUserId = '.$this->session->userdata('user')['id']);
		$result = $user_delete_query->result_array();
		echo 'success';die;
	}
	public function edit($id)
	{
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('manage_project'),
				'name'	=> 'Home'
			), 
			'1' => array(
				'url'	=> '',
				'name'	=> 'Edit User'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		//start code for get office details
		$stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetUserDetailbyId @UserId = '.$id);
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

		$user_class = array();
		if(isset($user_resultSets[3])){
		    $user_class = $user_resultSets[3];
		}

		$user_status = array();
		if(isset($user_resultSets[4])){
		    $user_status = $user_resultSets[4];
		}

		sqlsrv_free_stmt($stmt);
		$this->data['state'] 			= $state;
		$this->data['office_details'] 	= $office_details;
		$this->data['user_details'] 	= $user_details;
		$this->data['user_class'] 		= $user_class;
		$this->data['user_status'] 		= $user_status;
	}
	public function update()
	{
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'last Name', 'trim|required');
		$this->form_validation->set_rules('localoffice', 'Local Office', 'trim|required');

		if ($this->form_validation->run() != FALSE){      
		    $param = array(
		        'UserID'                                                   => $this->input->post('user_id'),
		        'SectionId'                                                => 5,
		        'FirstName'                                                => $this->input->post('firstname'),
		        'MiddleName'                                               => '',
		        'LastName'                                                 => $this->input->post('lastname'),
		        'Email'                                                    => '',
		        'OfficeId'                                                 => $this->input->post('localoffice'),
		        'Class'                                                    => $this->input->post('userclass'),
		        'Status'                                                   => $this->input->post('userstatus'),
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
		        @Class                                                     = ?,  
		        @Status                                                    = ?,  
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
		        $this->session->set_flashdata('success',"User Information Updated.");
		        redirect(site_url('user_administration'));
		}else{
		    $this->session->set_flashdata('error',validation_errors());
		    redirect(site_url('user_administration/edit/'.$this->input->post('user_id')));
		}
	}
}
