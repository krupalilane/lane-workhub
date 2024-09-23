<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['javascripts'] 	= array('holiday.js');
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
				'name'	=> 'Holiday'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function get_all_holiday_data()
	{
		$oder_column = [
			'1' => 'Id',
			'2' => 'Year',
			'3' => 'HolidayDate',
			'4' => 'WeekDay',
			'5' => 'HolidayName'
		];
		$searchText 	= $this->input->post('search')['value'];
		$sql  = 'EXEC USP_GetHolidays @Id = ?,@IsActive = ?,@Search = ?,@StartIndex = ?,@PageSize = ?,@SortBy = ?,@SortOrder = ?;';
		$param = array(
		    0,
		    $this->input->post('active'),
		    $searchText,
		    $this->input->post('start'),
		    $this->input->post('length'),
		    $oder_column[$this->input->post('order')[0]['column']],
		    $this->input->post('order')[0]['dir'],
		);
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
    			$checkbox 	= '';
    			$action 	= '';
    			if ($this->input->post('active') == 1) {
    				$action .= '<a data-holiadyid="'.$form_details['Id'].'" data-activedata="0" type="button" class="delete_holiday_button btn dark">Delete</a>';
    				$checkbox = '<a href="#" data-holiadyid="'.$form_details['Id'].'" type="button" class="btn red edit_holiday">Edit</a>';
    			}else{
    				$action .= '<a data-holiadyid="'.$form_details['Id'].'" data-activedata="1" type="button" class="delete_holiday_button btn dark">Active</a>';
    			}
        		
        		$data[] = array(
        			'Checkbox' 			=> $checkbox,
        			'Id' 				=> $form_details['Id'],
        			'Year' 				=> $form_details['Year'],
        		    'HolidayDate' 		=> date('F d,Y', strtotime($form_details['HolidayDate'])),
        		    'WeekDay' 			=> $form_details['WeekDay'],
        		    'HolidayName' 		=> $form_details['HolidayName'],
        		    'Action' 			=> $action
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
	public function get_holiday_data()
	{
		$id = $this->input->post('id');
		$get_holiday_query  = 'EXEC USP_GetHolidays @Id = ?,@IsActive = ?,@Search = ?,@StartIndex = ?,@PageSize = ?,@SortBy = ?,@SortOrder = ?;';
		$param = array(
		    'Id'      	  		  => $id,
		    'IsActive'      	  => 1,
		    'Search'              => '',
		    'StartIndex'          => '',
		    'PageSize'            => '',
		    'SortBy'              => '',
		    'SortOrder'           => '',
		);
		$holiday_list       = $this->db->query($get_holiday_query,$param);
		$result     		= $holiday_list->row_array();
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($result))
        ->_display();
        die;
	}
	public function form_submit()
	{
		$add_holiday_db = "EXEC USP_InsertUpdateHoliday  
			@Id 					= ?,
			@HolidayDate 			= ?,
			@Year 					= ?,
			@WeekDay 				= ?,
			@HolidayName 			= ?,
			@HolidayType 			= ?	,
			@LoggedInUserId 		= ?";
		$param = array($this->input->post('Id'),$this->input->post('holiday_date'),$this->input->post('week_year'),$this->input->post('week_day'),$this->input->post('holiday_name'),1,$this->session->userdata('user')['id']);
		$user_submit_query = $this->db->query($add_holiday_db,$param);
		$result = $user_submit_query->row_array();
		if ($this->input->post('Id') != 0) {
			$this->session->set_flashdata('success','Holiday data updated successfully!');
		}else{
			$this->session->set_flashdata('success','Holiday data added successfully!');
		}
		redirect(site_url('holiday'));
	}
	public function check_duplicate_date()
	{
	    $HolidayId         = $this->input->post('HolidayId');
	    $HolidayDate       = $this->input->post('HolidayDate');
		$get_user_data  = 'EXEC USP_CheckDuplicateHoliday @HolidayId = ?,@HolidayDate = ?;';
		$param = array(
            'HolidayId'      	=> $HolidayId,
            'HolidayDate' 		=> $HolidayDate
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
	public function delete_holiday()
	{
		$holiday_id 	= $this->input->post('holiday_id');
		$holidayActive = $this->input->post('holidayActive');
		$holiday_delete_query = $this->db->query('EXEC USP_ActiveInActiveHoliday  @Id = '.$holiday_id.', @IsActive = '.$holidayActive.',@LoggedInUserId = '.$this->session->userdata('user')['id']);
		$result = $holiday_delete_query->result_array();
		echo 'success';die;
	}
}
