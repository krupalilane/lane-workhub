<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_edit_profile extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'user-edit-profile';
	    $this->s_user = $this->session->userdata('user');
	    if(empty($this->s_user)){
            $full_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
            $this->session->set_userdata('redirect_to', $full_url);
            redirect(site_url('login'));
        }else{
        	$Role_name = $this->session->userdata('user')['Role'];
        	if ($Role_name == SUPER_ADMIN_ROLE_ID) {
    	    	redirect(site_url('Access_denied'));
        	}
        }
        $this->load->library('upload');
        $this->load->helper('url');
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
		$this->data['javascripts'] 	= array('user_edit_profile.js');
		$this->data['breadcrumb'] = $breadcrumb_data;
		$get_user_data  = 'EXEC USP_GetUserList  @UserId = ?,@IsActive = ?,@SearchOption = ?,@FilterUserId = ?;';
		$param = array(
            'UserId'      		=> 1,
            'IsActive'      	=> 1,
            'SearchOption'      => '',
            'FilterUserId' 		=> $this->session->userdata('user')['id']
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $this->data['user_details']	= $user_data->row_array();

        if ($this->input->method() == 'post'){ 

        	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        	$this->form_validation->set_rules('new_password', 'Password', 'trim|callback_edit_password_check');
        	$this->form_validation->set_rules('DOB', 'DOB', 'trim|required');
        	$this->form_validation->set_rules('DOJ', 'DOJ', 'trim|required');

        	if ($this->form_validation->run() != FALSE){ 
        		if (!empty($_FILES['attachment1']['name'])) {
        			// Set upload path and allowed file types
			        $config['upload_path'] 		= './assets/images/user/';
			        $config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			        $newFileName 				= 'user_' . $this->input->post('user_id') . '_' . time();
			        $config['file_name'] 		= $newFileName; 

			        // Initialize upload library with the config
			        $this->upload->initialize($config);

			        if ($this->upload->do_upload('attachment1')) {
			            // File uploaded successfully
			            $uploadData = $this->upload->data();
			            $fileName 	= $uploadData['file_name'];
			            $image_name = $uploadData['file_name'];
			        } else {
			            // Upload failed, display errors
			            $error = $this->upload->display_errors();
			        }
        		}else{
        			$image_name = $this->input->post('old_image');
        		}
        		$password = $this->input->post('password');
        		if (!empty($this->input->post('new_password'))) {
        			$password = md5($this->input->post('new_password'));
        		}
        		$add_quotes_db = "EXEC USP_UpdateUserDetails  
        			@UserId 		= ?,
        			@FirstName 		= ?,
        			@LastName 		= ?,
        			@Password 		= ?,
        			@DOB 			= ?	,
        			@DOJ 			= ?,
        			@UserImageUrl	= ?,
        			@LoggedInUserId = ?";
        			$param = array($this->input->post('user_id'),$this->input->post('first_name'),$this->input->post('last_name'),$password,$this->input->post('DOB'),$this->input->post('DOJ'),$image_name,$this->session->userdata('user')['id']);
        			$user_submit_query = $this->db->query($add_quotes_db,$param);
        			$result = $user_submit_query->row_array();
        			$this->session->set_flashdata('success','Profile data updated successfully!');
        			redirect(site_url('user_edit_profile'));
        	}else{
        	    $this->session->set_flashdata('error',validation_errors());
        	}
        }
	}
	public function password_check() {
	    $password          = $this->input->post('password');
	    if (preg_match('/[A-Z]/', $password) && 
	        preg_match('/[a-z]/', $password) && 
	        preg_match('/\d/', $password)) {
	        return TRUE;
	    } else {
	        $this->form_validation->set_message('password_check', 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.');
	        return FALSE;
	    }
	}
	public function edit_password_check() {
	    $password          = $this->input->post('new_password');
	    if (!empty($password)) {
		    if (preg_match('/[A-Z]/', $password) && 
		        preg_match('/[a-z]/', $password) && 
		        preg_match('/\d/', $password)) {
		        return TRUE;
		    } else {
		        $this->form_validation->set_message('password_check', 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.');
		        return FALSE;
		    }
	    }else{
	    	return TRUE;
	    }
	}
}
