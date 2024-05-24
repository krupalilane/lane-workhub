<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

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
	    $this->data['active_menu'] 	= 'contact';
	    $this->load->helper('project_helper');
	    $this->data['project_lists'] = get_project_data();
	    $this->data['style_links'] 	= array('pages/css/contact.min.css','global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');
	    $this->data['js_links'] 	= array('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js','global/plugins/jquery.sparkline.min.js','global/plugins/gmaps/gmaps.min.js');
	    $this->data['javascripts'] 	= array('contact.js');
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
				'name'	=> 'Contact Us'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
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
		$this->data['user_details'] = $user_details;
	}
	public function send_contact_details()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');

		if ($this->form_validation->run() != FALSE){      
		    $param = array(
		        'UserID'			=> $this->input->post('user_id'),
		        'Name'              => $this->input->post('name'),
		        'Email'             => $this->input->post('email'),
		        'CompanyName'       => $this->input->post('company_name'),
		        'PhoneNumber'       => $this->input->post('phone'),
		        'Message'           => $this->input->post('message'),
		        'Status'            => ''
		    );
		    $add_contact_us_db = "EXEC stormconfig.USP_AddDataFromContactUs 
		        @UserID         = ?,  
		        @Name           = ?,  
		        @Email          = ?,  
		        @CompanyName    = ?,  
		        @PhoneNumber    = ?,  
		        @Message        = ?,  
		        @Status         = ?;";
		        $user_add = $this->db->query($add_contact_us_db,$param);
		        $result   = $user_add->result_array();
		        
		        $this->session->set_flashdata('success',"Details send successfully.");
		        redirect(site_url('contact'));
		}else{
		    $this->session->set_flashdata('error',validation_errors());
		    redirect(site_url('contact'));
		}
	}
}
