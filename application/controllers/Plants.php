<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plants extends MY_Controller {

	protected $asides = array('header' => 'layouts/business_plan/_header',
							'footer' => 'layouts/business_plan/_footer',
	                        'js' => 'layouts/business_plan/_js',
	                    );
	protected $layout = 'layouts/business_plan/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'plants';
	    $this->business_plan_db = $this->load->database('business_plan_db', TRUE);
        $this->s_user = $this->session->userdata('user');
        if(empty($this->s_user)){
            $full_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
            $this->session->set_userdata('redirect_to', $full_url);
            redirect(site_url('login'));
        }else{
        	$all_site_permission = $this->session->userdata('user_site_permissions');
	    	$folder_name = 'Businessplan';
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
	}

	public function index()
	{
		if ($this->permission_for_site == 'add_edit') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('plants.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'Business Plan'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Plants'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$all_division_db 				= $this->business_plan_db->query("EXEC USP_GetBusinessPlanLocation;");
		$this->data['all_division_db']	= $all_division_db->result_array();
		$all_year_db 				= $this->business_plan_db->query("EXEC USP_GetBusinessPlanYear;");
		$this->data['all_year_db']	= $all_year_db->result_array();
	}
	public function plants2()
	{
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'Business Plan'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Plants'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function plants3()
	{
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'Business Plan'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Plants'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function add()
	{
		if ($this->permission_for_site == 'view') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('add_plants.js');
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'Business Plan'
			),
			'2' => array(
				'url'	=> site_url('plants'),
				'name'	=> 'Plants'
			),
			'3' => array(
				'url'	=> '',
				'name'	=> 'Add Plants'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		$all_division_db 				= $this->business_plan_db->query("EXEC USP_GetBusinessPlanLocation;");
		$this->data['all_division_db']	= $all_division_db->result_array();
		$all_year_db 				= $this->business_plan_db->query("EXEC USP_GetBusinessPlanYear;");
		$this->data['all_year_db']	= $all_year_db->result_array();
		if ($this->input->method() == 'post'){ 

			$add_quotes_db = "EXEC USP_InsertUpdateBusinessPlanData  
				@Plant 			= ?,
				@Category 		= ?,
				@SubCategory 	= ?,
				@Year 			= ?,
				@Quarter 		= ?,
				@Planned_Actual	= ?,
				@Value 			= ?,
				@LoggedInUserId = ?;";
				$param = array($this->input->post('plant'),$this->input->post('category'),$this->input->post('sub_categories'),$this->input->post('year'),$this->input->post('quater'),$this->input->post('actual_planned'),$this->input->post('plan_value'),$this->session->userdata('user')['id']);
				$user_submit_query = $this->business_plan_db->query($add_quotes_db,$param);
				$result = $user_submit_query->row_array();
				$this->session->set_flashdata('success','Plants data added successfully!');
				redirect(site_url('plants'));
			
		}
	}
	public function edit()
	{
		$add_quotes_db = "EXEC USP_InsertUpdateBusinessPlanData  
			@Id 			= ?,
			@Plant 			= ?,
			@Category 		= ?,
			@SubCategory 	= ?,
			@Year 			= ?,
			@Quarter 		= ?,
			@Planned_Actual	= ?,
			@Value 			= ?,
			@LoggedInUserId = ?;";
			$param = array($this->input->post('edit_plan_id'),$this->input->post('edit_plan_division'),$this->input->post('edit_plan_category'),$this->input->post('edit_plan_sub_category'),$this->input->post('edit_plan_year'),$this->input->post('edit_plan_quarter'),$this->input->post('edit_plan_actual'),$this->input->post('edit_plan_value'),$this->session->userdata('user')['id']);
			$user_submit_query = $this->business_plan_db->query($add_quotes_db,$param);
			$result = $user_submit_query->row_array();

			$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json')
	        ->set_output(json_encode($result))
	        ->_display();
	        die;
			
		
	}
	public function get_category()
	{
		$category_db = "EXEC USP_GetBusinessPlanCategoriesByLocation  
			@Plant 			= ?;";
			$param = array($this->input->post('plant'));
			$plant_query = $this->business_plan_db->query($category_db,$param);
			$result = $plant_query->result_array();
		$this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($result))
        ->_display();
        die;
	}
	public function get_sub_category()
	{
		$category_db = "EXEC USP_GetBusinessPlanSubCategoriesByLocationAndCategory  
			@Plant = '".$this->input->post('plant')."', 
			@Category = '".$this->input->post('category')."';";
			$category_query = $this->business_plan_db->query($category_db);
			$sub_categories_details = $category_query->result_array();
		$this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($sub_categories_details))
        ->_display();
        die;
	}
	public function get_all_plants_data()
	{
		$get_plants_data  = 'EXEC USP_GetBusinessPlanData  @Id = ?,@Plant = ?,@Year = ?;';
		$param = array(
            'Id'      		=> 0,
            'Plant'      	=> $this->input->post('plant_name'),
            'Year'      	=> $this->input->post('year')
        );
        $plants_data 	= $this->business_plan_db->query($get_plants_data,$param);
        $result   		= $plants_data->result_array();
        $quater 		= array('Q1','Q2','Q3','Q4');
        $ap_array 		= array('Actual','Planned');
        $year_array 		= array_values(array_unique(array_column($result, 'Year')));
        $data['year']   	= $year_array;
        if (!empty($result)) {
        	$plant_details_array = array();
        	foreach ($result as $key => $plant_values) {
        		$plant_details_cat = array();
        		$row_num = 0;
        		for ($i=0; $i < count($year_array); $i++) { 
        			for ($j=0; $j < count($quater); $j++) { 
        				for ($p=0; $p < count($ap_array); $p++) { 
        					$criteria = [
        					    "Category" 			=> $plant_values['Category'],
        					    "SubCategory"		=> $plant_values['SubCategory'],
        					    "Year" 				=> $year_array[$i],
        					    "Quarter" 			=> $quater[$j],
        					    "Planned_Actual" 	=> $ap_array[$p]
        					];
        					$key_plant_data = $this->plan_data_filter($result,$criteria);
        					$plant_details_cat[$row_num]['Value'] 			= !empty($result[$key_plant_data]['Value']) ? $result[$key_plant_data]['Value'] : '0';
        					$plant_details_cat[$row_num]['ID'] 				= $result[$key_plant_data]['ID'];
        					$plant_details_cat[$row_num]['Planned_Actual'] 	= $result[$key_plant_data]['Planned_Actual'];
        					$plant_details_cat[$row_num]['Quarter'] 		= $result[$key_plant_data]['Quarter'];
        					$plant_details_cat[$row_num]['Year'] 			= $result[$key_plant_data]['Year'];
        					$row_num++;
        				}
        			}
        		}
        		$plant_details_array[trim($plant_values['Category'])][$plant_values['SubCategory']] = $plant_details_cat;
        	}
    		$data['plant_details'] = $plant_details_array;
        }
        $data['result'] 	= $result;
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($data))
        ->_display();
        die;
	}
	public function plan_data_filter($result,$criteria)
	{
		$filtered = array_filter($result, function($item) use ($criteria) {
		    return $item['Year'] == $criteria['Year'] && 
		           $item['Quarter'] == $criteria['Quarter'] &&
		           $item['Planned_Actual'] == $criteria['Planned_Actual'] &&
		           $item['Category'] == $criteria['Category'] &&
		           $item['SubCategory'] == $criteria['SubCategory'];
		});

		$key = array_search(reset($filtered), $result);
		return $key;
	}
}
