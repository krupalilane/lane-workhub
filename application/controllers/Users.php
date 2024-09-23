<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'settings';
	    $this->s_user = $this->session->userdata('user');
	    if(empty($this->s_user)){
            $full_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
            $this->session->set_userdata('redirect_to', $full_url);
            redirect(site_url('login'));
        }else{
        	$Role_name = $this->session->userdata('user')['Role'];
        	if ($Role_name != SUPER_ADMIN_ROLE_ID) {
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
				'name'	=> 'Users'
			)
		);
		$this->data['javascripts'] 	= array('user_list.js');
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function get_all_user()
	{
		$oder_column = [
			'1' => 'FirstName',
			'2' => 'LastName',
			'3' => 'UserName',
			'4' => 'Email'
		];
		$searchText 	= $this->input->post('search')['value'];
		$param = array(
		    $this->session->userdata('user')['id'],
		    $this->input->post('active_user'),
		    $searchText,
		    $this->input->post('start'),
		    $this->input->post('length'),
		    $oder_column[$this->input->post('order')[0]['column']],
		    $this->input->post('order')[0]['dir'],
		);
		$sql  = 'EXEC USP_GetUserList @UserId = ?,@IsActive = ?,@SearchOption = ?,@StartIndex = ?,@PageSize = ?,@SortBy = ?,@SortOrder = ?;';
		// Prepare the statement
		$stmt = sqlsrv_prepare($this->db->conn_id, $sql, $param);

		if ($stmt === false) {
		    die(print_r(sqlsrv_errors(), true));  // Print errors if preparation fails
		    return false;
		}

		// Execute the prepared statement
		$executeResult = sqlsrv_execute($stmt);

		if ($executeResult === false) {
		    die(print_r(sqlsrv_errors(), true));  // Print errors if execution fails
		    return false;
		}

		// Fetch and process results
		$query_data = array();
		do {
		    $resultSet = array();
		    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		        $resultSet[] = $row;
		    }
		    $query_data[] = $resultSet;
		} while (sqlsrv_next_result($stmt));

		// Free the statement
		sqlsrv_free_stmt($stmt);
		$totalRecords 	=  0;
		if (!empty($query_data)) {
			if (isset($query_data[1][0])) {
				$totalRecords 	= $query_data[1][0]['TotalRows'];
			}
			if (isset($query_data[0])) {
				$datatable_detail 	= $query_data[0];
			}
		}
        $data = array();
        if (!empty($datatable_detail)) {
        	foreach($datatable_detail as $user_details){
        		if ($user_details['Role'] != SUPER_ADMIN_ROLE_ID) {
		    		$edit_url = site_url('users/edit/'.$user_details['ID']);
		    	    $action 	= '';
		    	    $checkbox 	= '';
					if ($this->input->post('active_user') == 1) {
						$checkbox .= '<a href="'.$edit_url.'" type="button" class="btn red">Edit</a>';
						$action .= '<a data-userid="'.$user_details['ID'].'" data-activedata="0" data-username="'.$user_details['FirstName'].' '.$user_details['LastName'].'" type="button" class="delete_user_button btn dark">Delete</a>';
					}else{
						$action .= '<a data-userid="'.$user_details['ID'].'" data-activedata="1" data-username="'.$user_details['FirstName'].' '.$user_details['LastName'].'" type="button" class="delete_user_button btn dark">Active</a>';
					}
		    	    $data[] = array(
		    	        'checkbox' 	=> $checkbox,
		    	        'FirstName' => $user_details['FirstName'],
		    	        'LastName' 	=> $user_details['LastName'],
		    	        'UserName' 	=> $user_details['UserName'],
		    	        'Email' 	=> $user_details['Email'],
		    	        'Action' 	=> $action
		    	    ); 
        		}
        	}
        }
        $response = array(
            "draw" => intval($this->input->post('draw')),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($response))
        ->_display();
        die;
	}
	public function add()
	{
		$this->data['javascripts'] 	= array('add_user_form.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> site_url('users'),
				'name'	=> 'Users'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Add Users'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		$get_site_data  			= 'EXEC USP_GetSiteList;';
		$site_data 					= $this->db->query($get_site_data);
        $this->data['site_details']	= $site_data->result_array();
        if ($this->input->method() == 'post'){ 
        	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        	$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|callback_check_user_name_exist');
        	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email_exist');
        	$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_password_check');
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
    			$image_name = 'default_user.png';
    		}
    		//start code for create site permission xml data
    			$site_xml_data 		= "<SiteAccessInfo>";
    			if (!empty($this->input->post('site_permission_list'))) {
    				$site_p = $this->input->post('site_permission_list');
    				foreach ($site_p as $site_key => $site_value) {
    					$site_role = 2;
    					if (isset($this->input->post('site_permission_role')[$site_key])) {
    						if ($this->input->post('site_permission_role')[$site_key] != 0) {
    							$site_role = $this->input->post('site_permission_role')[$site_key];
    						}
    						$favorite = 0;
    						if (isset($this->input->post('favorite')[$site_key])) {
    							$favorite = 1;
    						}
    						$site_xml_data .= "<SiteAccess>";
    							$site_xml_data .= "<SiteId>".$this->input->post('site_permission_list')[$site_key]."</SiteId>";
    							$site_xml_data .= "<SiteRoleId>".$site_role."</SiteRoleId>";
    							$site_xml_data .= "<IsFavorite>".$favorite."</IsFavorite>";
    						$site_xml_data .= "</SiteAccess>";
    					}
    				}
    			}
    			$site_xml_data .= "</SiteAccessInfo>";
    		//end code for create product dteails xml data

        	if ($this->form_validation->run() != FALSE){ 
        		$add_quotes_db = "EXEC USP_InsertUpdateUserByAdmin  
        			@UserId 		= ?,
        			@FirstName 		= ?,
        			@LastName 		= ?,
        			@UserName 		= ?,
        			@Password 		= ?,
        			@Email 			= ?,
        			@Role 			= ?,
        			@SiteAccessList = ?,
        			@DOB 			= ?,
        			@DOJ 			= ?,
        			@UserImageUrl	= ?,
        			@LoggedInUserId = ?";
        			$param = array(0,$this->input->post('first_name'),$this->input->post('last_name'),$this->input->post('user_name'),md5($this->input->post('password')),$this->input->post('email'),$this->input->post('Role'),$site_xml_data,$this->input->post('DOB'),$this->input->post('DOJ'),$image_name,$this->session->userdata('user')['id']);
        			$user_submit_query = $this->db->query($add_quotes_db,$param);
        			$result = $user_submit_query->row_array();
        			$this->session->set_flashdata('success','User data added successfully!');
        			redirect(site_url('users'));
        	}else{
        	    $this->session->set_flashdata('error',validation_errors());
        	}
        	
        }
	}
	public function edit($id)
	{
		$this->data['javascripts'] 	= array('edit_user_form.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> site_url('users'),
				'name'	=> 'Users'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Edit Users'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		$get_site_data  			= 'EXEC USP_GetSiteList;';
		$site_data 					= $this->db->query($get_site_data);
        $this->data['site_details']	= $site_data->result_array();
        $sql = 'EXEC USP_GetUserDetailByID  @UserId = ?;';
        $param = array($id);
        $stmt = sqlsrv_prepare($this->db->conn_id, $sql, $param);

        if ($stmt === false) {
            return false;
        }
        $executeResult = sqlsrv_execute($stmt);

        if ($executeResult === false) {
            return false;
        }
        $query_data = array();
        do {
            $resultSet = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultSet[] = $row;
            }
            $query_data[] = $resultSet;
        } while (sqlsrv_next_result($stmt));
        sqlsrv_free_stmt($stmt);
        $this->data['user_site_permission']	= array();
        $this->data['user_details']	= array();
        if (!empty($query_data)) {
        	if(isset($query_data[0][0])){
        		$this->data['user_details']	= $query_data[0][0];
        	}
        	if (isset($query_data[1])) {
        		$this->data['user_site_permission']	= $query_data[1];
        	}
        }

        if ($this->input->method() == 'post'){ 

        	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        	$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|callback_edit_check_user_name_exist');
        	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_edit_check_email_exist');
        	$this->form_validation->set_rules('new_password', 'Password', 'trim|callback_edit_password_check');

        	if ($this->form_validation->run() != FALSE){
        		$password = $this->input->post('password');
        		if (!empty($this->input->post('new_password'))) {
        			$password = md5($this->input->post('new_password'));
        		}
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
        		//start code for create site permission xml data
        			$site_xml_data 		= "<SiteAccessInfo>";
	    			if (!empty($this->input->post('site_permission_list'))) {
	    				$site_p = $this->input->post('site_permission_list');
	    				foreach ($site_p as $site_key => $site_value) {
	    					$site_role = 2;
	    					if (isset($this->input->post('site_permission_role')[$site_key])) {
	    						if ($this->input->post('site_permission_role')[$site_key] != 0) {
	    							$site_role = $this->input->post('site_permission_role')[$site_key];
	    						}
	    						$favorite = 0;
	    						if (isset($this->input->post('favorite')[$site_key])) {
	    							$favorite = 1;
	    						}
	    						$site_xml_data .= "<SiteAccess>";
	    							$site_xml_data .= "<SiteId>".$this->input->post('site_permission_list')[$site_key]."</SiteId>";
	    							$site_xml_data .= "<SiteRoleId>".$site_role."</SiteRoleId>";
	    							$site_xml_data .= "<IsFavorite>".$favorite."</IsFavorite>";
	    						$site_xml_data .= "</SiteAccess>";
	    					}
	    				}
	    			}
	    			$site_xml_data .= "</SiteAccessInfo>";
        		//end code for create product dteails xml data
        		$add_quotes_db = "EXEC USP_InsertUpdateUserByAdmin  
        			@UserId 		= ?,
        			@FirstName 		= ?,
        			@LastName 		= ?,
        			@UserName 		= ?,
        			@Password 		= ?,
        			@Email 			= ?	,
        			@Role 			= ?	,
        			@SiteAccessList = ?,
        			@DOB 			= ?	,
        			@DOJ 			= ?,
        			@UserImageUrl	= ?,
        			@LoggedInUserId = ?";
        			$param = array($this->input->post('user_id'),$this->input->post('first_name'),$this->input->post('last_name'),$this->input->post('user_name'),$password,$this->input->post('email'),$this->input->post('Role'),$site_xml_data,$this->input->post('DOB'),$this->input->post('DOJ'),$image_name,$this->session->userdata('user')['id']);
        			$user_submit_query = $this->db->query($add_quotes_db,$param);
        			$result = $user_submit_query->row_array();
        			$this->session->set_flashdata('success','User data updated successfully!');
        			redirect(site_url('users'));
        	}else{
        	    $this->session->set_flashdata('error',validation_errors());
        	}
        	
        }
	}
	public function check_email()
	{
	    $email          = $this->input->post('email');
		$get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> '',
            'UserName'      	=> '',
            'Email'      		=> $email
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if (!empty($result['Result'])) {
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
	public function check_user_name()
	{
	    $user_name      = $this->input->post('user_name');
		$get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> '',
            'UserName'      	=> $user_name,
            'Email'      		=> ''
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if ($result['Result'] == 'This Username/Email Address Already exists!!!') {
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
	function check_email_exist(){
	    $email          = $this->input->post('email');
	    $get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> '',
            'UserName'      	=> '',
            'Email'      		=> $email
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if (!empty($result['Result'])) {
	        $this->form_validation->set_message('check_email_exist', 'User with same email already exist!');
	        return false;
	    }else{
	        return true;
	    }
	}
	function check_user_name_exist(){
	    $user_name      = $this->input->post('user_name');
	    $get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> '',
            'UserName'      	=> $user_name,
            'Email'      		=> ''
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if (!empty($result['Result'])) {
	        $this->form_validation->set_message('check_user_name_exist', 'User with same user name already exist!');
	        return false;
	    }else{
	        return true;
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
	public function edit_check_email()
	{
	    $email          = $this->input->post('email');
	    $user_id        = $this->input->post('user_id');
		$get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> $user_id,
            'UserName'      	=> '',
            'Email'      		=> $email
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if (!empty($result['Result'])) {
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
	public function edit_check_user_name()
	{
	    $user_name      = $this->input->post('user_name');
	    $user_id        = $this->input->post('user_id');
		$get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> $user_id,
            'UserName'      	=> $user_name,
            'Email'      		=> ''
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if ($result['Result'] == 'This Username/Email Address Already exists!!!') {
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
	function edit_check_email_exist(){
	    $email          = $this->input->post('email');
	    $user_id     	= $this->input->post('user_id');
	    $get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> $user_id,
            'UserName'      	=> '',
            'Email'      		=> $email
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if (!empty($result['Result'])) {
	        $this->form_validation->set_message('check_email_exist', 'User with same email already exist!');
	        return false;
	    }else{
	        return true;
	    }
	}
	function edit_check_user_name_exist(){
	    $user_name      = $this->input->post('user_name');
	    $user_id     	= $this->input->post('user_id');
	    $get_user_data  = 'EXEC USP_CheckDuplicateUserNameOrEmail @UserId = ?,@UserName = ?,@Email = ?;';
		$param = array(
            'UserId'      		=> $user_id,
            'UserName'      	=> $user_name,
            'Email'      		=> ''
        );
        $user_data 		= $this->db->query($get_user_data,$param);
        $result   		= $user_data->row_array();	    
	    
	    if (!empty($result['Result'])) {
	        $this->form_validation->set_message('check_user_name_exist', 'User with same user name already exist!');
	        return false;
	    }else{
	        return true;
	    }
	}
	public function delete_user_url()
	{
		$user_id 	= $this->input->post('user_id');
		$userActive = $this->input->post('userActive');
		$user_delete_query = $this->db->query('EXEC USP_ActiveInActiveUser  @UserId = '.$user_id.', @IsActive = '.$userActive.',@LoggedInUserId = '.$this->session->userdata('user')['id']);
		$result = $user_delete_query->result_array();
		echo 'success';die;
	}
}
