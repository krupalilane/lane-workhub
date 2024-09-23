<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weekly_territory_report extends MY_Controller {

	protected $asides = array('header' => 'layouts/weekly_territory_report/_header',
							'footer' => 'layouts/weekly_territory_report/_footer',
	                        'js' => 'layouts/weekly_territory_report/_js',
	                    );
	protected $layout = 'layouts/weekly_territory_report/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->s_user = $this->session->userdata('user');
	    if(empty($this->s_user)){
	        $full_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
	        $this->session->set_userdata('redirect_to', $full_url);
	        redirect(site_url('login'));
	    }else{
	    	$all_site_permission = $this->session->userdata('user_site_permissions');
	    	$folder_name = 'weekly_territory_report';
	    	$found_site = array_filter($all_site_permission, function($site) use ($folder_name) {
    	        return isset($site['FolderName']) && $site['FolderName'] == $folder_name;
    	    });

    	    // Return the first match or a message if no match was found
    	    $this->permission_for_site = '';
    	    if (!empty($found_site)) {
    	    	$permission_site_array = array_shift($found_site);
    	    	if (!empty($permission_site_array['SiteRoleId'])) {
    	    		if ($permission_site_array['SiteRoleId'] == ALL_PERMISSION) {
    	    			$this->permission_for_site = 'all';
    	    		}elseif ($permission_site_array['SiteRoleId'] == VIEW_PERMISSION) {
    	    			$this->permission_for_site = 'view';
    	    		}elseif ($permission_site_array['SiteRoleId'] == ADD_EDIT_PERMISSION) {
    	    			$this->permission_for_site = 'add_edit';
    	    		}
    	    	}else{
    	    		redirect(site_url('Access_denied'));
    	    	}
    	    } else {
    	        redirect(site_url('Access_denied'));
    	    }
	    }
	    $this->data['active_menu'] 	= 'dashboard';
	    $this->weekly_db = $this->load->database('weekly_territory', TRUE);
	    $this->load->library('upload');
        $this->load->helper('url');
	}

	public function index()
	{
		if ($this->permission_for_site == 'add_edit') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('weekly_territory.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'West Coast Weekly Territory Report'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$param = array(
		    $this->session->userdata('user')['id'],
		    $this->session->userdata('user')['Role']
		);
		$get_sql 	= 'EXEC USP_GetTerritoryUsers @LoggedInUserId=?, @RoleId = ?;';
		$sql 		= $this->weekly_db->query($get_sql,$param);
		$result   	= $sql->result_array();
		$this->data['user_data'] = $result;
 
	}
	public function add()
	{
		if ($this->permission_for_site == 'view') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('add_weekly_territory_report.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> site_url('weekly_territory_report'),
				'name'	=> 'West Coast Weekly Territory Report'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Add West Coast Weekly Territory Report'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		$get_site_data  			= 'EXEC USP_GetSiteList;';
		$site_data 					= $this->db->query($get_site_data);
        $this->data['site_details']	= $site_data->result_array();
        if ($this->input->method() == 'post'){ 

        	$this->form_validation->set_rules('WeekEnding', 'Week Ending', 'trim|required');
        	$this->form_validation->set_rules('Name', 'Name', 'trim|required');
        	$this->form_validation->set_rules('GeneralOverview', 'General Overview', 'trim|required');
        	$this->form_validation->set_rules('GoalforthisWeek', 'Goal for this Week', 'trim|required');

        	if ($this->form_validation->run() != FALSE){
	    		if (!empty($_FILES['attachment1']['name'])) {
	    			// Set upload path and allowed file types
			        $config['upload_path'] 		= './assets/images/weekly_territory_report/';
			        $config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			        $newFileName 				= 'report_' . $this->session->userdata('user')['id'] . '_' . time();
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
	    			$image_name = '';
	    		}
        		$add_report_db = "EXEC USP_SaveTerritoryReviewData  
        			@ID							= ?,
    				@WeekEnding					= ?,
    				@Name						= ?,
    				@GeneralOverview			= ?,
    				@GoalforthisWeek			= ?,
    				@KeySalesCalls				= ?,
    				@InsightsAccomplishments	= ?,
    				@CompetitiveInsights		= ?,
    				@NextWeekPlansGoals			= ?,
    				@ImageUrl					= ?,
    				@LoggedInUserId				= ?;";
        			$param = array(
        				0,
        				$this->input->post('WeekEnding'),
        				$this->input->post('Name'),
        				$this->input->post('GeneralOverview'),
        				$this->input->post('GoalforthisWeek'),
        				$this->input->post('KeySalesCalls'),
        				$this->input->post('InsightsAccomplishments'),
        				$this->input->post('CompetitiveInsights'),
        				$this->input->post('NextWeekPlansGoals'),
        				$image_name,
        				$this->session->userdata('user')['id']
        			);
        			$report_submit_query = $this->weekly_db->query($add_report_db,$param);
        			$result = $report_submit_query->row_array();
        			$this->session->set_flashdata('success','Report data added successfully!');
        			redirect(site_url('weekly_territory_report'));
        	}else{
        	    $this->session->set_flashdata('error',validation_errors());
        	}
        	
        }
	}
	public function edit($id)
	{
		if ($this->permission_for_site == 'view') {
			redirect(site_url('Access_denied'));
		}
		if (in_array($session_user_id, $user_ids_array)) {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('add_weekly_territory_report.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> site_url('weekly_territory_report'),
				'name'	=> 'West Coast Weekly Territory Report'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Edit West Coast Weekly Territory Report'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		$param = array(
		    $id
		);
		$get_sql 	= 'EXEC USP_GetTerritoryReviewData @Id = ?;';
		$sql 		= $this->weekly_db->query($get_sql,$param);
		$result   	= $sql->row_array();
		$this->data['report_data'] = $result;
        if ($this->input->method() == 'post'){ 

        	$this->form_validation->set_rules('WeekEnding', 'Week Ending', 'trim|required');
        	$this->form_validation->set_rules('Name', 'Name', 'trim|required');
        	$this->form_validation->set_rules('GeneralOverview', 'General Overview', 'trim|required');
        	$this->form_validation->set_rules('GoalforthisWeek', 'Email', 'trim|required');

        	if ($this->form_validation->run() != FALSE){ 
        		if (!empty($_FILES['attachment1']['name'])) {
        			// Set upload path and allowed file types
			        $config['upload_path'] 		= './assets/images/weekly_territory_report/';
			        $config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			        $newFileName 				= 'report_' . $this->session->userdata('user')['id'] . '_' . time();
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
        		$add_report_db = "EXEC USP_SaveTerritoryReviewData  
        			@ID							= ?,
    				@WeekEnding					= ?,
    				@Name						= ?,
    				@GeneralOverview			= ?,
    				@GoalforthisWeek			= ?,
    				@KeySalesCalls				= ?,
    				@InsightsAccomplishments	= ?,
    				@CompetitiveInsights		= ?,
    				@NextWeekPlansGoals			= ?,
    				@ImageUrl					= ?,
    				@LoggedInUserId				= ?;";
        			$param = array(
        				$this->input->post('ID'),
        				$this->input->post('WeekEnding'),
        				$this->input->post('Name'),
        				$this->input->post('GeneralOverview'),
        				$this->input->post('GoalforthisWeek'),
        				$this->input->post('KeySalesCalls'),
        				$this->input->post('InsightsAccomplishments'),
        				$this->input->post('CompetitiveInsights'),
        				$this->input->post('NextWeekPlansGoals'),
        				$image_name,
        				$this->session->userdata('user')['id']
        			);
        			$report_submit_query = $this->weekly_db->query($add_report_db,$param);
        			$result = $report_submit_query->row_array();
        			$this->session->set_flashdata('success','Report data updated successfully!');
        			redirect(site_url('weekly_territory_report'));
        	}else{
        	    $this->session->set_flashdata('error',validation_errors());
        	}
        	
        }
	}
	public function get_all_weekly_report()
	{
		$order_column = [
		    '0' => '',
		    '1' => 'WeekEnding',
		    '2' => 'Name',
		    '3' => 'GeneralOverview',
		    '4' => 'GoalforthisWeek',
		    '5' => 'KeySalesCalls',
		    '6' => 'InsightsAccomplishments',
		    '7' => 'CompetitiveInsights',
		    '8' => 'NextWeekPlansGoals'
		];
		$searchText = $this->input->post('search')['value'];
		$params = [
		    $this->input->post('start_date'),
		    $this->input->post('end_date'),
		    $this->input->post('employee'),
		    $searchText,
		    $this->input->post('start'),
		    $this->input->post('length'),
		    $order_column[$this->input->post('order')[0]['column']],
		    $this->input->post('order')[0]['dir'],
		    0,
		    $this->session->userdata('user')['Role']
		];
		$sql = 'EXEC USP_GetTerritoryReviewData 
		        @WeekEndingFrom = ?, 
		        @WeekEndingTo = ?, 
		        @UserId = ?, 
		        @Search = ?, 
		        @StartIndex = ?, 
		        @PageSize = ?, 
		        @SortBy = ?, 
		        @SortOrder = ?,
		        @ID = ?,
		        @Role = ?;';

		// Prepare the statement
		$stmt = sqlsrv_prepare($this->weekly_db->conn_id, $sql, $params);
		if ($stmt === false) {
		    // die(print_r(sqlsrv_errors(), true));  // Print errors if preparation fails
		    return false;
		}

		// Execute the prepared statement
		$executeResult = sqlsrv_execute($stmt);

		if ($executeResult === false) {
		    return false;
		    // die(print_r(sqlsrv_errors(), true));  // Print errors if execution fails
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
			if (isset($query_data[0][0])) {
				$totalRecords 	= $query_data[0][0]['TotalRows'];
			}
			if (isset($query_data[1])) {
				$datatable_detail 	= $query_data[1];
			}
		}
		
	    $data = array();
	    // echo "<pre>";
	    // print_r($totalRecords);
	    // exit;
	    if (!empty($datatable_detail)) {
	    	foreach($datatable_detail as $form_details){
	    		$edit_url 	= site_url('weekly_territory_report/edit/'.$form_details['ID']);
	    		$checkbox 	= '<a href="#" data-id="'.$form_details['ID'].'" type="button" class="btn dark view_report"><i class="fa fa-eye" aria-hidden="true"></i></a>';
	    		$session_user_id = $this->session->userdata('user')['id'];
	    		$user_ids_list = '46,221,307,346,361,398,399';
	    		$user_ids_array = explode(',', $user_ids_list);
	    		$action = '';
	    		if ($this->permission_for_site != 'view') {
	    			$action    = '<a href="'.$edit_url.'" type="button" class="btn red"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
	    		}
	    		$data[] 	= array(
	    		    'Checkbox' 					=> $checkbox,
	    		    'WeekEnding' 				=> $form_details['WeekEnding'],
	    		    'Name' 						=> $form_details['Name'],
	    		    'GeneralOverview' 			=> $this->shorten_text($form_details['GeneralOverview']),
	    		    'GoalforthisWeek' 			=> $this->shorten_text($form_details['GoalforthisWeek']),
	    		    'KeySalesCalls' 			=> $this->shorten_text($form_details['KeySalesCalls']),
	    		    'InsightsAccomplishments' 	=> $this->shorten_text($form_details['InsightsAccomplishments']),
	    		    'CompetitiveInsights' 		=> $this->shorten_text($form_details['CompetitiveInsights']),
	    		    'NextWeekPlansGoals' 		=> $this->shorten_text($form_details['NextWeekPlansGoals']),
	    		    'Action' 					=> $action,
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
	function shorten_text($text, $word_limit = 5) {
	    // Split the text by spaces into an array of words
	    $words = explode(' ', $text);

	    // If the number of words is less than or equal to the limit, return the full text
	    if (count($words) <= $word_limit) {
	        return $text;
	    }

	    // Slice the array to get the first 15 words, and join them back into a string
	    $shortened_text = implode(' ', array_slice($words, 0, $word_limit));

	    // Append the "..." at the end of the string
	    return $shortened_text . '...';
	}
	public function get_report_data()
	{
		$id = $this->input->post('id');
		$param = array(
		    $id
		);
		$get_sql 	= 'EXEC USP_GetTerritoryReviewData @Id = ?;';
		$sql 		= $this->weekly_db->query($get_sql,$param);
		$result   	= $sql->row_array();
		$image_url = '';
		if ($result['ImageUrl'] != '') {
			$image_url = asset_url().'/images/weekly_territory_report/'.$result['ImageUrl'];
		}
		$response['report_data'] = $result;
		$response['image_url'] = $image_url;
		$this->output
	    ->set_status_header(200)
	    ->set_content_type('application/json')
	    ->set_output(json_encode($response))
	    ->_display();
	    die;
	}
}
