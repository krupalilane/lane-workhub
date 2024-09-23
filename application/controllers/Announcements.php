<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
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
	    $this->data['javascripts'] 	= array('announcements.js');
	    $this->data['active_menu'] 	= 'settings';
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
				'name'	=> 'Announcements'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function get_all_announcements_data()
	{
		$oder_column = [
			'1' => 'AnnoucementHeader',
			'2' => 'AnnouncementContent',
			'3' => 'AnnoucementDate'
		];
		$searchText 	= $this->input->post('search')['value'];
		$param = array(
		    0,
		    $this->input->post('active'),
		    $searchText,
		    $this->input->post('start'),
		    $this->input->post('length'),
		    $oder_column[$this->input->post('order')[0]['column']],
		    $this->input->post('order')[0]['dir'],
		);
		$sql  = 'EXEC USP_GetAnnouncements @Id = ?,@IsActive = ?,@Search = ?,@StartIndex = ?,@PageSize = ?,@SortBy = ?,@SortOrder = ?;';
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
        	foreach($datatable_detail as $form_details){
        		$announcementContent = $form_details['AnnouncementContent'];

        		// Split the content into an array of words
        		$wordsArray = explode(' ', $announcementContent);

        		// Check if the content has more than 20 words
        		if (count($wordsArray) > 20) {
        		    // Get the first 20 words
        		    $announcementContent = implode(' ', array_slice($wordsArray, 0, 15)) . ' ..';
        		}
        		$checkbox 	= '';
        		$action 	= '';
        		if ($this->input->post('active') == 1) {
        			$edit_url = site_url('announcements/edit/'.$form_details['Id']);
        			$action .= '<a data-annoucementid="'.$form_details['Id'].'" data-activedata="0" type="button" class="delete_announcement_button btn dark">Delete</a>';
        			$checkbox = '<a href="'.$edit_url.'" type="button" class="btn red">Edit</a>';
        		}else{
        			$action .= '<a data-annoucementid="'.$form_details['Id'].'" data-activedata="1" type="button" class="delete_announcement_button btn dark">Active</a>';
        		}
        		
        		$data[] = array(
        			'Checkbox' 				=> $checkbox,
        			'Id' 					=> $form_details['Id'],
        		    'AnnoucementHeader' 	=> $form_details['AnnoucementHeader'],
        		    'AnnouncementContent' 	=> $announcementContent,
        		    'AnnoucementDate' 		=>  date('F d,Y', strtotime($form_details['AnnoucementDate'])),
        		    'Action' 				=> $action
        		);
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
		$this->data['javascripts'] 	= array('add_announcements_form.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> site_url('announcements'),
				'name'	=> 'Announcements'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Add Announcements'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
        if ($this->input->method() == 'post'){ 
			$image1_name = '';
			$image2_name = '';
			$image3_name = '';
			$attachment_path = array();
			if (!empty($_FILES['attachment1']['name'])) {
				// Set upload path and allowed file types
		        $config['upload_path'] 		= './assets/images/announcements/';
		        $config['allowed_types'] 	= 'xls|xlsx|pdf|txt|doc|docx|mp4|webm|ogg|jpg|jpeg|png|gif';
		        $newFileName 				= 'announcements_' . $this->session->userdata('user')['id'] . '_' . time();
		        $config['file_name'] 		= $newFileName; 

		        // Initialize upload library with the config
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('attachment1')) {
		            // File uploaded successfully
		            $uploadData = $this->upload->data();
		            $fileName 	= $uploadData['file_name'];
		            $image1_name = $uploadData['file_name'];
		            $file_path1 = FCPATH . 'assets/images/announcements/'.$image1_name;
		            array_push($attachment_path,$file_path1);
		        } else {
		            // Upload failed, display errors
		            $error = $this->upload->display_errors();
		        }
			}
			if (!empty($_FILES['attachment2']['name'])) {
				// Set upload path and allowed file types
		        $config['upload_path'] 		= './assets/images/announcements/';
		        $config['allowed_types'] 	= 'xls|xlsx|pdf|txt|doc|docx|mp4|webm|ogg|jpg|jpeg|png|gif';
		        $newFileName 				= 'announcements_' . $this->session->userdata('user')['id'] . '_' . time();
		        $config['file_name'] 		= $newFileName; 

		        // Initialize upload library with the config
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('attachment2')) {
		            // File uploaded successfully
		            $uploadData = $this->upload->data();
		            $fileName 	= $uploadData['file_name'];
		            $image2_name = $uploadData['file_name'];
		            $file_path2 = FCPATH . 'assets/images/announcements/'.$image2_name;
		            array_push($attachment_path,$file_path2);
		        } else {
		            // Upload failed, display errors
		            $error = $this->upload->display_errors();
		        }
			}
			if (!empty($_FILES['attachment3']['name'])) {
				// Set upload path and allowed file types
		        $config['upload_path'] 		= './assets/images/announcements/';
		        $config['allowed_types'] 	= 'xls|xlsx|pdf|txt|doc|docx|mp4|webm|ogg|jpg|jpeg|png|gif';
		        $newFileName 				= 'announcements_' . $this->session->userdata('user')['id'] . '_' . time();
		        $config['file_name'] 		= $newFileName; 

		        // Initialize upload library with the config
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('attachment3')) {
		            // File uploaded successfully
		            $uploadData = $this->upload->data();
		            $fileName 	= $uploadData['file_name'];
		            $image3_name = $uploadData['file_name'];
		             $file_path3 = FCPATH . 'assets/images/announcements/'.$image3_name;
		            array_push($attachment_path,$file_path3);
		        } else {
		            // Upload failed, display errors
		            $error = $this->upload->display_errors();
		        }
			}
    		$add_quotes_db = "EXEC USP_InsertUpdateAnnouncements  
    			@Id 					= ?,
    			@AnnoucementHeader 		= ?,
    			@AnnoucementDate 		= ?,
    			@AnnouncementContent 	= ?,
    			@FirstImageUrl 			= ?,
    			@SecondImageUrl 		= ?	,
    			@ThirdImageUrl 			= ?	,
    			@LoggedInUserId 		= ?";
			$param = array(0,$this->input->post('header'),$this->input->post('date'),$this->input->post('Content'),$image1_name,$image2_name,$image3_name,$this->session->userdata('user')['id']);
			$user_submit_query = $this->db->query($add_quotes_db,$param);
			$result = $user_submit_query->row_array();
			$kp_to_email              = 'kpatel@lane-enterprises.com';
			$subject                    = 'Announcements Details';
			$email_data				   = array(
					'AnnoucementHeader' 		=> $this->input->post('header'),
					'AnnoucementDate' 			=> $this->input->post('date'),
					'AnnouncementContent' 		=> $this->input->post('Content'),
					'Message'					=> $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'].' Has added an announcement with below details:'
			);
			$user_email_message         = $this->load->view('email/announcement_email', $email_data, TRUE);
			$lkim_email_send        	   =  email_send_php_mailer($subject,$user_email_message,$kp_to_email,$attachment_path);
			$this->session->set_flashdata('success','Announcements data added successfully!');
			redirect(site_url('announcements'));
		}
	}
	public function edit($id)
	{
		$this->data['javascripts'] 	= array('edit_announcements.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> site_url('announcements'),
				'name'	=> 'Announcements'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Edit Announcements'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		$get_ann_query  = 'EXEC USP_GetAnnouncements @Id = ?,@IsActive = ?,@Search = ?,@StartIndex = ?,@PageSize = ?,@SortBy = ?,@SortOrder = ?;';
		$param = array(
		    'Id'      	  		  => $id,
		    'IsActive'      	  => 1,
		    'Search'              => '',
		    'StartIndex'          => '',
		    'PageSize'            => '',
		    'SortBy'              => '',
		    'SortOrder'           => ''
		);
        $ann_data 		= $this->db->query($get_ann_query,$param);
        $this->data['announcements_details']	= $ann_data->row_array();

        if ($this->input->method() == 'post'){ 
			$image1_name = $this->input->post('old_image1');
			$image2_name = $this->input->post('old_image2');
			$image3_name = $this->input->post('old_image3');
			$attachment_path = array();
			if (!empty($_FILES['attachment1']['name'])) {
				// Set upload path and allowed file types
		        $config['upload_path'] 		= './assets/images/announcements/';
		        $config['allowed_types'] 	= 'xls|xlsx|pdf|txt|doc|docx|mp4|webm|ogg|jpg|jpeg|png|gif';
		        $newFileName 				= 'announcements_' . $this->session->userdata('user')['id'] . '_' . time();
		        $config['file_name'] 		= $newFileName; 

		        // Initialize upload library with the config
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('attachment1')) {
		            // File uploaded successfully
		            $uploadData = $this->upload->data();
		            $fileName 	= $uploadData['file_name'];
		            $image1_name = $uploadData['file_name'];
		        } else {
		            // Upload failed, display errors
		            $error = $this->upload->display_errors();
		        }
			}
			$file_path1 = FCPATH . 'assets/images/announcements/'.$image1_name;
			array_push($attachment_path,$file_path1);
			if (!empty($_FILES['attachment2']['name'])) {
				// Set upload path and allowed file types
		        $config['upload_path'] 		= './assets/images/announcements/';
		        $config['allowed_types'] 	= 'xls|xlsx|pdf|txt|doc|docx|mp4|webm|ogg|jpg|jpeg|png|gif';
		        $newFileName 				= 'announcements_' . $this->session->userdata('user')['id'] . '_' . time();
		        $config['file_name'] 		= $newFileName; 

		        // Initialize upload library with the config
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('attachment2')) {
		            // File uploaded successfully
		            $uploadData = $this->upload->data();
		            $fileName 	= $uploadData['file_name'];
		            $image2_name = $uploadData['file_name'];
		        } else {
		            // Upload failed, display errors
		            $error = $this->upload->display_errors();
		        }
			}
			$file_path2 = FCPATH . 'assets/images/announcements/'.$image2_name;
			array_push($attachment_path,$file_path2);
			if (!empty($_FILES['attachment3']['name'])) {
				// Set upload path and allowed file types
		        $config['upload_path'] 		= './assets/images/announcements/';
		        $config['allowed_types'] 	= 'xls|xlsx|pdf|txt|doc|docx|mp4|webm|ogg|jpg|jpeg|png|gif';
		        $newFileName 				= 'announcements_' . $this->session->userdata('user')['id'] . '_' . time();
		        $config['file_name'] 		= $newFileName; 

		        // Initialize upload library with the config
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('attachment3')) {
		            // File uploaded successfully
		            $uploadData = $this->upload->data();
		            $fileName 	= $uploadData['file_name'];
		            $image3_name = $uploadData['file_name'];
		        } else {
		            // Upload failed, display errors
		            $error = $this->upload->display_errors();
		        }
			}
			$file_path3 = FCPATH . 'assets/images/announcements/'.$image3_name;
			array_push($attachment_path,$file_path3);
    		$add_quotes_db = "EXEC USP_InsertUpdateAnnouncements  
    			@Id 					= ?,
    			@AnnoucementHeader 		= ?,
    			@AnnoucementDate 		= ?,
    			@AnnouncementContent 	= ?,
    			@FirstImageUrl 			= ?,
    			@SecondImageUrl 		= ?	,
    			@ThirdImageUrl 			= ?	,
    			@LoggedInUserId 		= ?";
			$param = array($this->input->post('ID'),$this->input->post('header'),$this->input->post('date'),$this->input->post('Content'),$image1_name,$image2_name,$image3_name,$this->session->userdata('user')['id']);
			$user_submit_query = $this->db->query($add_quotes_db,$param);
			$result = $user_submit_query->row_array();
			$kp_to_email              = 'kpatel@lane-enterprises.com';
			$subject                    = 'Announcements Details';
			$email_data				   = array(
					'AnnoucementHeader' 		=> $this->input->post('header'),
					'AnnoucementDate' 			=> $this->input->post('date'),
					'AnnouncementContent' 		=> $this->input->post('Content'),
					'Message'					=> $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'].' Has updated an announcement with below details:'
			);
			$user_email_message         = $this->load->view('email/announcement_email', $email_data, TRUE);
			$lkim_email_send        	   =  email_send_php_mailer($subject,$user_email_message,$kp_to_email,$attachment_path);
			$this->session->set_flashdata('success','Announcements data updated successfully!');
			redirect(site_url('announcements'));
		}
	}
	public function delete_announcements()
	{
		$announcement_id 	= $this->input->post('announcement_id');
		$announcementActive = $this->input->post('announcementActive');
		$announcement_delete_query = $this->db->query('EXEC USP_ActiveInActiveAnnouncements  @Id = '.$announcement_id.', @IsActive = '.$announcementActive.',@LoggedInUserId = '.$this->session->userdata('user')['id']);
		$result = $announcement_delete_query->result_array();
		echo 'success';die;
	}
}
