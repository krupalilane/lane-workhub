<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Dompdf\Dompdf;
use Dompdf\Options;
ini_set('memory_limit', '512M');

class Plastic_pipe_quality_issue_submittal_form extends MY_Controller {

	protected $asides = array('header' => 'layouts/ppq_submittal_form/_header',
							'footer' => 'layouts/ppq_submittal_form/_footer',
	                        'js' => 'layouts/ppq_submittal_form/_js',
	                    );
	protected $layout = 'layouts/ppq_submittal_form/master_layout';
	public function __construct() {
	    parent::__construct(); 
	    $this->s_user = $this->session->userdata('user');
	    if(empty($this->s_user)){
	        $full_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
	        $this->session->set_userdata('redirect_to', $full_url);
	        redirect(site_url('login'));
	    }else{
	    	$all_site_permission = $this->session->userdata('user_site_permissions');
	    	$folder_name = 'Plastic_pipe_quality_issue_submittal_form';
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
	    $this->load->library('upload');
	    $this->load->helper('url');
	    $this->data['javascripts'] 	= array('submittal_form.js');
	    $this->ppq_form_db = $this->load->database('ppq_form_db', TRUE);
	}
	public function index()
	{
		if ($this->permission_for_site == 'add_edit') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('complaint_list.js');
		$this->data['active_menu'] 	= 'complaint_list';
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Lane Work Hub Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'Plastic Pipe Quality Complaint Submittal Form'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Complaint List'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$categories_data 		= $this->ppq_form_db->query("select distinct ISNULL(Category,'N/A') AS Category from tblPlasticPipeQualityIssueResolution order by 1");
		$this->data['categories_details'] = $categories_data->result_array();
	}
	public function add()
	{
		if ($this->permission_for_site == 'view') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('add_complaint.js');
		$this->data['active_menu'] 	= 'complaint_list';
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Lane Work Hub Dashboard'
			),
			'1' => array(
				'url'	=> site_url('plastic_pipe_quality_issue_submittal_form'),
				'name'	=> 'Plastic Pipe Quality Complaint Submittal Form'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Add'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		//start code for get all dropdown data
		$stmt = sqlsrv_query($this->ppq_form_db->conn_id, 'EXEC USP_GetAllDropDownValues');
		if (!$stmt) {
		    return false;
		}

		$all_dropdown_data = array();
		do {
		    $resultSet = array();
		    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		        $resultSet[] = $row;
		    }
		    $all_dropdown_data[] = $resultSet;
		} while (sqlsrv_next_result($stmt));
		sqlsrv_free_stmt($stmt);
		//start code for get location
			// echo "<pre>";
			// print_r($all_dropdown_data);
			// exit;
			if(isset($all_dropdown_data[0])){
			    $this->data['location'] = $all_dropdown_data[0];
			}
			if(isset($all_dropdown_data[1])){
			    $this->data['linenumberandname'] = $all_dropdown_data[1];
			}
			if(isset($all_dropdown_data[2])){
			    $this->data['ProductDiameter'] = $all_dropdown_data[2];
			}
			if(isset($all_dropdown_data[3])){
			    $this->data['ProductFlavour'] = $all_dropdown_data[3];
			}
			if(isset($all_dropdown_data[4])){
			    $this->data['ProductLength'] = $all_dropdown_data[4];
			}
			if(isset($all_dropdown_data[5])){
			    $this->data['ProductType'] = $all_dropdown_data[5];
			}
			if(isset($all_dropdown_data[6])){
			    $this->data['BellType'] = $all_dropdown_data[6];
			}
			if(isset($all_dropdown_data[7])){
			    $this->data['ProductPerf'] = $all_dropdown_data[7];
			}
			if(isset($all_dropdown_data[8])){
			    $this->data['ProductShift'] = $all_dropdown_data[8];
			}
			if(isset($all_dropdown_data[9])){
			    $this->data['ComplaintCategory'] = $all_dropdown_data[9];
			}
		//end code for get location
	}
	public function edit($id)
	{
		if ($this->permission_for_site == 'view') {
			redirect(site_url('Access_denied'));
		}
		$this->data['javascripts'] 	= array('edit_complaint.js');
		$this->data['active_menu'] 	= 'complaint_list';
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Lane Work Hub Dashboard'
			),
			'1' => array(
				'url'	=> site_url('plastic_pipe_quality_issue_submittal_form'),
				'name'	=> 'Plastic Pipe Quality Complaint Submittal Form'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Edit'
			)
		);
		$this->data['breadcrumb'] 	= $breadcrumb_data;
		
		$param = array(
		    $id,
		    $this->session->userdata('user')['id']
		);
		$sql = 'EXEC USP_GetQAComplaintData @Id = ?, @LoggedInUserId	= ?;';
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
		if (!empty($query_data)) {
			if (isset($query_data[0][0])) {
				$this->data['complaint_details'] = $query_data[0][0];
			}
			if (isset($query_data[1])) {
				$this->data['product_details'] = $query_data[1];
			}
			if (isset($query_data[2])) {
				$this->data['photos'] = $query_data[2];
			}
		}
	}
	public function get_all_archive_data()
	{	
		$oder_column = [
			'1' => 'Timestamp',
			'2' => 'ComplaintNumber',
			'3' => 'CompanyName',
			'4' => 'Location',
			'5' => 'SeverityLevel'
		];
		$searchText 	= $this->input->post('search')['value'];
		$param = array(
		    $searchText,
		    $this->input->post('start'),
		   	$this->input->post('length'),
		    $oder_column[$this->input->post('order')[0]['column']],
		    $this->input->post('order')[0]['dir'],
		);
		$sql = 'EXEC USP_GetPlasticPipeArchivedData @Search = ?, @StartIndex = ?, @PageSize = ?, @SortBy = ?, @SortOrder = ?';

		// Prepare the statement
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
        if (!empty($datatable_detail)) {
        	foreach($datatable_detail as $form_details){
        		$data[] = array(
        		    'Timestamp' 		=> $form_details['Timestamp'],
        		    'CompanyName' 		=> $form_details['CompanyName'],
        		    'Location' 			=> $form_details['Location'],
        		    'SeverityLevel' 	=> $form_details['SeverityLevel'],
        		    'ComplaintNumber' 	=> $form_details['ComplaintNumber'],
        		    'FailurFoundLocation' 	=> $form_details['FailurFoundLocation'],
        		    'FailureFoundBy' 	=> $form_details['FailureFoundBy'],
        		    'FailureFoundOn' 	=> $form_details['FailureFoundOn'],
        		    'DefectiveProductDescription' 	=> $form_details['DefectiveProductDescription'],
        		    'IssueDescription' 	=> $form_details['IssueDescription'],
        		    'QASeverityLevel' 	=> $form_details['QASeverityLevel'],
        		    'Category' 			=> $form_details['Category'],
        		    'RootCause' 		=> $form_details['RootCause'],
        		    'CorrectiveAction' 	=> $form_details['CorrectiveAction'],
        		    'PreventiveMeasuresOrResolution' 	=> $form_details['PreventiveMeasuresOrResolution'],
        		    'DateClosed' 		=> $form_details['DateClosed'],
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
	public function get_all_complaint_data()
	{	
		$oder_column = [
			'0' => '',
			'1' => 'DateOfSubmittal',
			'2' => 'AssociatedLoggingNumber',
			'3' => 'SeverityLevel',
			'4' => 'ComplaintCategory',
			'5' => 'DateOfIssue',
			'6' => 'SubmittedByUser',
			'7' => 'ShippingSiteOrCustomerLocation'
		];
		$searchText 	= $this->input->post('search')['value'];
		$param = array(
		    $searchText,
		    $this->input->post('start'),
		   	$this->input->post('length'),
		    $oder_column[$this->input->post('order')[0]['column']],
		    $this->input->post('order')[0]['dir'],
		    $this->session->userdata('user')['id']
		);
		$sql = 'EXEC USP_GetQAComplaintData @Search = ?, @StartIndex = ?, @PageSize = ?, @SortBy = ?, @SortOrder = ?, @LoggedInUserId	= ?;';

		// Prepare the statement
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
        if (!empty($datatable_detail)) {
        	foreach($datatable_detail as $form_details){
        		$edit_url 	= site_url('plastic_pipe_quality_issue_submittal_form/edit/'.$form_details['ID']);
        		$checkbox 	= '';
        		$action 	= '';
        		$allowed_user = array('1','9','10','11','12');
        		if (empty($form_details['ResolvedDate'])) {
        			if (in_array($this->session->userdata('user')['id'], $allowed_user)) {
        				$action    .= '<a href="'.$edit_url.'" type="button" class="btn red"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
        			}
        		}
        		$checkbox    .= '<a href="#" type="button" class="btn dark view_complaint" data-complaint_id="'.$form_details['ID'].'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
        		$data[] 	= array(
        		    'checkbox' 					=> $checkbox,
        		    'DateOfSubmittal' 			=> $form_details['DateOfSubmittal'],
        		    'AssociatedLoggingNumber' 	=> $form_details['AssociatedLoggingNumber'],
        		    'SeverityLevel' 			=> $form_details['SeverityLevel'],
        		    'ComplaintCategory' 		=> $form_details['ComplaintCategory'],
        		    'DateOfIssue' 				=> $form_details['DateOfIssue'],
        		    'SubmitedBy' 				=> $form_details['SubmittedByUser'],
        		    'ShippingSiteOrCustomerLocation' 			=> $form_details['ShippingSiteOrCustomerLocation'],
        		    'ColorCode' 				=> $form_details['ColorCode'],
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
	public function archive_list()
	{
		$this->data['javascripts'] 	= array('archive_list.js');
		$this->data['active_menu'] 	= 'archive_list';
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('dashboard'),
				'name'	=> 'Lane Work Hub Dashboard'
			),
			'1' => array(
				'url'	=> '',
				'name'	=> 'Plastic Pipe Quality Complaint Submittal Form'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'Archive List'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$categories_data 		= $this->ppq_form_db->query("select distinct ISNULL(Category,'N/A') AS Category from tblPlasticPipeQualityIssueResolution order by 1");
		$this->data['categories_details'] = $categories_data->result_array();
	}
	public function save_complain()
	{
		if (!empty($this->input->post('associated_num'))) {
			$complaint_images = $_FILES;
			$combine_xml_data = '<LocationProductInfo>';
			//start code for create product dteails xml data
				$product_details_count 	= count($this->input->post('location'));
				if ($product_details_count > 0) {
					$email_product_details 	= array();
						if (!empty($this->input->post('location')[0])) {
							for ($i=0; $i < $product_details_count; $i++) { 
								$combine_xml_data .= "<LocationProduct>";
									$combine_xml_data .= "<Location>".$this->input->post('location')[$i]."</Location>";
									$combine_xml_data .= "<LineNumberName>".$this->input->post('line_number_and_name')[$i]."</LineNumberName>";
									$combine_xml_data .= "<ProductDiameter>".$this->input->post('product_diameter')[$i]."</ProductDiameter>";
									$combine_xml_data .= "<ProductFlavour>".$this->input->post('product_flavour')[$i]."</ProductFlavour>";
									$combine_xml_data .= "<ProductLength>".$this->input->post('product_length')[$i]."</ProductLength>";
									$combine_xml_data .= "<ProductType>".$this->input->post('product_type')[$i]."</ProductType>";
									$combine_xml_data .= "<BellType>".$this->input->post('bell_type')[$i]."</BellType>";
									$combine_xml_data .= "<ProductPerf>".$this->input->post('product_perf')[$i]."</ProductPerf>";
									$combine_xml_data .= "<ProductShift>".$this->input->post('product_shift')[$i]."</ProductShift>";
									$combine_xml_data .= "<FittingDescription></FittingDescription>";
								$combine_xml_data .= "</LocationProduct>";
								$product_data = array(
									'Location' => $this->input->post('location')[$i],
									'LineNumberName' => $this->input->post('line_number_and_name')[$i],
									'ProductDiameter' => $this->input->post('product_diameter')[$i],
									'ProductFlavour' => $this->input->post('product_flavour')[$i],
									'ProductLength' => $this->input->post('product_length')[$i],
									'ProductType' => $this->input->post('product_type')[$i],
									'BellType' => $this->input->post('bell_type')[$i],
									'ProductPerf' => $this->input->post('product_perf')[$i],
									'ProductShift' => $this->input->post('product_shift')[$i]
								);
								array_push($email_product_details, $product_data);
							}
						}
				}
			//end code for create product dteails xml data
			//start code for create fitting dteails xml data
				$fitting_details_count 	= count($this->input->post('FabricationLocation'));
				if ($fitting_details_count > 0) {
					$email_fitting_details 	= array();
						if (!empty($this->input->post('FabricationLocation')[0])) {
							for ($j=0; $j < $fitting_details_count; $j++) { 
								$combine_xml_data .= "<LocationProduct>";
									$combine_xml_data .= "<Location>".$this->input->post('FabricationLocation')[$j]."</Location>";
									$combine_xml_data .= "<LineNumberName>Fabrication</LineNumberName>";
									$combine_xml_data .= "<ProductDiameter></ProductDiameter>";
									$combine_xml_data .= "<ProductFlavour></ProductFlavour>";
									$combine_xml_data .= "<ProductLength></ProductLength>";
									$combine_xml_data .= "<ProductType></ProductType>";
									$combine_xml_data .= "<BellType></BellType>";
									$combine_xml_data .= "<ProductPerf></ProductPerf>";
									$combine_xml_data .= "<ProductShift></ProductShift>";
									$combine_xml_data .= "<FittingDescription>".$this->input->post('FittingDescription')[$j]."</FittingDescription>";
								$combine_xml_data .= "</LocationProduct>";
								$fitting_data = array(
									'Location' => $this->input->post('FabricationLocation')[$j],
									'FittingDescription' => $this->input->post('FittingDescription')[$j],
								);
								array_push($email_fitting_details, $fitting_data);
							}
						}
				}
				$combine_xml_data .= "</LocationProductInfo>";
			//end code for create fitting dteails xml data
			//start code for image upload xml data
				$image_xml_data = NULL;
					$product_image_count = count($complaint_images['images']['name']);
					if (!empty($complaint_images['images']['name'][0])) {
						$image_xml_data = "<ProductImageInfo>";
							for ($i=0; $i < $product_image_count; $i++) { 
								$image_xml_data .= "<ImageName>".$complaint_images['images']['name'][$i]."</ImageName>";
							}
						$image_xml_data .= "</ProductImageInfo>";
					}
			//end code for image upload xml data
					
			$add_quotes_db = "EXEC USP_InsertUpdateQAComplaintData  
				@Id 						= ?,
				@DateOfSubmittal 			= ?,
				@AssociatedLoggingNumber 	= ?,
				@DateOfIssue 				= ?,
				@ComplaintCategory 			= ?,
				@SeverityLevel 				= ?,
				@SubmittedByUser			= ?,
				@SubmittedByUserEmailId 	= ?,
				@ShippingSiteOrCustomerLocation = ?,
				@HowFailureNonconformanceIdentified = ?,
				@ComplaintSummary 			= ?,
				@NextStepsTaken 			= ?,
				@ProductSizeAndFlavourXML 	= ?,
				@ImageXML 					= ?,
				@ShipmentDeliveryTNumber	= ?,
				@LoggedInUserId             = ?;";
				$shipment_number = 'N/A';
				if (!empty($this->input->post('shipment_number'))) {
					$shipment_number = $this->input->post('shipment_number');
				}
				$param = array(
					'0',
					$this->input->post('date_submit'),
					$this->input->post('associated_num'),
					$this->input->post('date_issue'),
					$this->input->post('complaint_category'),
					$this->input->post('severity_level'),
					$this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'],
					$this->session->userdata('user')['Email'],
					$this->input->post('location_submitting'),
					$this->input->post('how_failure'),
					$this->input->post('complaint_summary'),
					$this->input->post('next_step'),
					$combine_xml_data,
					$image_xml_data,
					$shipment_number,
					$this->session->userdata('user')['id']
				);
			$complaint_add 	= $this->ppq_form_db->query($add_quotes_db,$param);
			$result   		= $complaint_add->row_array();
			$attachment_path = array();
			if (!empty($result)) {
				$complaint_id 		= $result['QAComplaintId'];
				if (!empty($complaint_images['images']['name'][0])) {
					//start code for check complaint folder
				        $base_upload_path 	= './assets/images/complaint/';
				        $upload_path 		= $base_upload_path . $complaint_id . '/';

				        if (!file_exists($upload_path)) {
				            mkdir($upload_path, 0755, true); // Create directory with permissions
				        }
					//end code for check complaint folder
				    //start code for upload images
				        $config['upload_path'] = $upload_path;
				        $config['allowed_types'] = 'jpg|jpeg|png|gif';
			            $this->upload->initialize($config);

			            // Prepare file data
			            $files = $_FILES;
			            for ($i = 0; $i < $product_image_count; $i++) {
			                $_FILES['file']['name'] 	= $files['images']['name'][$i];
			                $_FILES['file']['type'] 	= $files['images']['type'][$i];
			                $_FILES['file']['tmp_name'] = $files['images']['tmp_name'][$i];
			                $_FILES['file']['error'] 	= $files['images']['error'][$i];
			                $_FILES['file']['size'] 	= $files['images']['size'][$i];

			                if (!$this->upload->do_upload('file')) {
			                    $error = array('error' => $this->upload->display_errors());
			                    // Handle error
			                    // echo json_encode($error); // Send error as JSON response for debugging
			                } else {
			                    $data = $this->upload->data();
			                    $file_path = FCPATH . 'assets/images/complaint/'.$complaint_id.'/'.$files['images']['name'][$i];
			                    array_push($attachment_path,$file_path);
			                    // Process the uploaded file information if needed
			                    // echo json_encode($data); // Send file data as JSON response for debugging
			                }
			            }
				    //end code for upload images
			    }
		    	//start code for send email for complain
		    	   $jelliott_to_email          = 'pj@lane-enterprises.com';
		    	   $lkim_to_email              = 'kpatel@lane-enterprises.com';
		    	   $subject                    = 'Complaint Details';
		    	   $email_data				   = array(
		    	   		'complaint_id'				=> $complaint_id,
		    	   		'DateOfSubmittal' 			=> $this->input->post('date_submit'),
		    	   		'AssociatedLoggingNumber' 	=> $this->input->post('associated_num'),
		    	   		'DateOfIssue' 				=> $this->input->post('date_issue'),
		    	   		'ComplaintCategory' 		=> $this->input->post('complaint_category'),
		    	   		'SeverityLevel' 			=> $this->input->post('severity_level'),
		    	   		'SubmittedByUser'			=> $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'],
		    	   		'SubmittedByUserEmailId' 	=> $this->session->userdata('user')['Email'],
		    	   		'ShippingSiteOrCustomerLocation' => $this->input->post('location_submitting'),
		    	   		'HowFailureNonconformanceIdentified' => $this->input->post('how_failure'),
		    	   		'ComplaintSummary' 			=> $this->input->post('complaint_summary'),
		    	   		'NextStepsTaken' 			=> $this->input->post('next_step'),
		    	   		'ProductSizeAndFlavourXML' 	=> $email_product_details
		    	   );
		    	   $user_email_message         = $this->load->view('email/complaint_email', $email_data, TRUE);
		    	   $jelliott_email_send        =  email_send_php_mailer($subject,$user_email_message,$jelliott_to_email,'');
		    	   $lkim_email_send        	   =  email_send_php_mailer($subject,$user_email_message,$lkim_to_email,'');
		    	//end code for send email for complain
		       $this->session->set_flashdata('success','Complaint data added successfully!');
				
		   		redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
			}
		}else{
			$this->session->set_flashdata('error','Somthing went wrong!');
			
			redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
		}
	}
	public function save_complaint_response()
	{
		if (!empty($this->input->post('root_cause'))) {
			$add_quotes_db = "EXEC USP_ResponseQAComplaintData  
				@Id 					= ?,
				@RootCause 				= ?,
				@PreventativeAction 	= ?,
				@CorrectiveAction 		= ?,
				@ResolvedBy 			= ?,
				@ResolvedDate 			= ?,
				@ShipmentDeliveryTNumber= ?,
				@LoggedInUserId			= ?;";
				$shipment_number = 'N/A';
				if (!empty($this->input->post('shipment_number'))) {
					$shipment_number = $this->input->post('shipment_number');
				}
				$param = array(
					$this->input->post('Id'),
					$this->input->post('root_cause'),
					$this->input->post('resolution'),
					$this->input->post('corrective_action'),
					$this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'],
					$this->input->post('date_colsed'),
					$shipment_number,
					$this->session->userdata('user')['id']
				);
			$complaint_add 	= $this->ppq_form_db->query($add_quotes_db,$param);
			$result   		= $complaint_add->row_array();
			//start code for send email for complain
			   $jelliott_to_email          	= 'pj@lane-enterprises.com';
			   $lkim_to_email          		= 'kpatel@lane-enterprises.com';
			   $subject                    	= 'Complaint Response';
			   $param = array(
			       $this->input->post('Id'),
			       $this->session->userdata('user')['id']
			   );
			   $sql = 'EXEC USP_GetQAComplaintData @Id = ?, @LoggedInUserId	= ?;';
			   $stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
			   if (!empty($query_data)) {
			   	if (isset($query_data[1])) {
			   		$email_product_details = $query_data[1];
			   	}
			   	if (isset($query_data[2])) {
			   		$photos = $query_data[2];
			   	}
			   }
			   $attachment_path = array();
			   if (!empty($photos)) {
			   		foreach ($photos as $key => $photo) {
			   			$file_path = FCPATH . 'assets/images/complaint/'.$photo['QAComplaintId'].'/'.$photo['ImageName'];
			   			array_push($attachment_path,$file_path);
			   		}
			   }
			   $email_data				   = array(
			   		'complaint_id'				=> $this->input->post('Id'),
			   		'DateOfSubmittal' 			=> $this->input->post('date_submit'),
			   		'AssociatedLoggingNumber' 	=> $this->input->post('associated_num'),
			   		'DateOfIssue' 				=> $this->input->post('date_issue'),
			   		'ComplaintCategory' 		=> $this->input->post('complaint_category'),
			   		'SeverityLevel' 			=> $this->input->post('severity_level'),
			   		'SubmittedByUser'			=> $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'],
			   		'SubmittedByUserEmailId' 	=> $this->session->userdata('user')['Email'],
			   		'ShippingSiteOrCustomerLocation' => $this->input->post('location_submitting'),
			   		'HowFailureNonconformanceIdentified' => $this->input->post('how_failure'),
			   		'ComplaintSummary' 			=> $this->input->post('complaint_summary'),
			   		'NextStepsTaken' 			=> $this->input->post('next_step'),
			   		'RootCause' 				=> $this->input->post('root_cause'),
			   		'PreventativeAction' 		=> $this->input->post('resolution'),
			   		'CorrectiveAction' 			=> $this->input->post('corrective_action'),
			   		'ResolvedBy' 				=> $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'],
			   		'ResolvedDate' 				=> $this->input->post('date_colsed'),
			   		'ProductSizeAndFlavourXML' 	=> $email_product_details,
			   );
			   $user_email_message         = $this->load->view('email/complaint_email', $email_data, TRUE);
			   $jelliott_email_send        =  email_send_php_mailer($subject,$user_email_message,$jelliott_to_email,'');
			   $lkim_email_send        	   =  email_send_php_mailer($subject,$user_email_message,$lkim_to_email,'');
			//end code for send email for complain
		   $this->session->set_flashdata('success','Response data added successfully!');
		   redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
		}else{
			$this->session->set_flashdata('error','Somthing went wrong!');
			redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
		}
	}
	public function check_duplicate_complaint()
	{
		//start code for create product dteails xml data
			$product_details_count = count($this->input->post('location'));
			$product_xml_data 		= "<LocationProductInfo>";
			$email_product_details 	= array();
			for ($i=0; $i < $product_details_count; $i++) { 
				$product_xml_data .= "<LocationProduct>";
					$product_xml_data .= "<Location>".$this->input->post('location')[$i]."</Location>";
					$product_xml_data .= "<LineNumberName>".$this->input->post('line_number_and_name')[$i]."</LineNumberName>";
					$product_xml_data .= "<ProductDiameter>".$this->input->post('product_diameter')[$i]."</ProductDiameter>";
					$product_xml_data .= "<ProductFlavour>".$this->input->post('product_flavour')[$i]."</ProductFlavour>";
					$product_xml_data .= "<ProductLength>".$this->input->post('product_length')[$i]."</ProductLength>";
					$product_xml_data .= "<ProductType>".$this->input->post('product_type')[$i]."</ProductType>";
					$product_xml_data .= "<BellType>".$this->input->post('bell_type')[$i]."</BellType>";
					$product_xml_data .= "<ProductPerf>".$this->input->post('product_perf')[$i]."</ProductPerf>";
					$product_xml_data .= "<ProductShift>".$this->input->post('product_shift')[$i]."</ProductShift>";
				$product_xml_data .= "</LocationProduct>";
			}
			$product_xml_data .= "</LocationProductInfo>";
		//end code for create product dteails xml data
			$add_quotes_db = "EXEC USP_CheckDuplicateQAComplaintData  
				@DateOfSubmittal					= ?,
				@AssociatedLoggingNumber			= ?,
				@DateOfIssue						= ?,
				@ComplaintCategory					= ?,
				@SeverityLevel						= ?,
				@SubmittedByUser					= ?,
				@SubmittedByUserEmailId				= ?,
				@ShippingSiteOrCustomerLocation		= ?,
				@HowFailureNonconformanceIdentified	= ?,
				@ComplaintSummary					= ?,
				@NextStepsTaken						= ?,
				@ShipmentDeliveryTNumber			= ?,
				@ProductSizeAndFlavourXML			= ?;";
				$shipment_number = 'N/A';
				if (!empty($this->input->post('shipment_number'))) {
					$shipment_number = $this->input->post('shipment_number');
				}
				$param = array(
					$this->input->post('date_submit'),
					$this->input->post('associated_num'),
					$this->input->post('date_issue'),
					$this->input->post('complaint_category'),
					$this->input->post('severity_level'),
					$this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'],
					$this->session->userdata('user')['Email'],
					$this->input->post('location_submitting'),
					$this->input->post('how_failure'),
					$this->input->post('complaint_summary'),
					$this->input->post('next_step'),
					$shipment_number,
					$product_xml_data
				);
			$complaint_add 	= $this->ppq_form_db->query($add_quotes_db,$param);
			$result   		= $complaint_add->row_array();
			if ($result['State'] == 1) {
				$response['duplicate'] = true;
			}else{
				$response['duplicate'] = false;
			}
		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response))
		->_display();
		die;
	}
	public function get_complaint_details()
	{
		$complaint_id = $this->input->post('complaint_id');
		$param = array(
		    $complaint_id,
		    $this->session->userdata('user')['id']
		);
		$sql = 'EXEC USP_GetQAComplaintData @Id = ?, @LoggedInUserId	= ?;';
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
		if (!empty($query_data)) {
			if (isset($query_data[0][0])) {
				$response['complaint_details'] = $query_data[0][0];
			}
			if (isset($query_data[1])) {
				$response['product_details'] = $query_data[1];
			}
			if (isset($query_data[2])) {
				$photos_array 	= array();
				$photo_array 	= $query_data[2];
				if (!empty($photo_array)) {
					foreach ($photo_array as $key => $photo) {
						$image_path = '<img class="complaint_image zoom_complaint_image" data-imageurl="' . asset_url() . 'images/complaint/' . $photo['QAComplaintId'] . '/' . $photo['ImageName'] . '" src="' . asset_url() . 'images/complaint/' . $photo['QAComplaintId'] . '/' . $photo['ImageName'] . '">';
						array_push($photos_array,$image_path);
					}
				}
				$response['photos'] = $photos_array;
			}
		}
		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response))
		->_display();
		die;
	}
	public function export_archive_excel()
	{
		$param = array(
		    '',
		    0,
		   	5000,
		    'Timestamp',
		    'asc',
		);
		$sql = 'EXEC USP_GetPlasticPipeArchivedData @Search = ?, @StartIndex = ?, @PageSize = ?, @SortBy = ?, @SortOrder = ?';

		// Prepare the statement
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
		
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set spreadsheet headers
        if (isset($query_data[1])) {
	        $sheet_data = $query_data[1];
	        if (isset($sheet_data[0])) {
	        	$spreadsheet 	= new Spreadsheet();
	        	$sheet 			= $spreadsheet->getActiveSheet();
		        $headers 		= array_keys($sheet_data[0]);
		        // echo "<pre>";
		        // print_r($headers);
		        // exit;
		        $sheet->fromArray($headers, null, 'A1');

		        // Populate data rows
		        $rowNumber = 2; // Start at the second row (1-based index)
		        foreach ($sheet_data as $row) {
		            $sheet->fromArray($row, null, 'A' . $rowNumber);
		            $rowNumber++;
		        }

		        // Write the file in Xlsx format
		        $writer = new Xlsx($spreadsheet);

		        // Set headers for download
		        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		        header('Content-Disposition: attachment;filename="archive_list.xlsx"');
		        header('Cache-Control: max-age=0');

		        // Write file to output
		        $writer->save('php://output');
	        }
        }
        redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
	}
	public function export_archive_pdf()
	{
		$param = array(
		    '',
		    0,
		   	5000,
		    'Timestamp',
		    'asc',
		);
		$sql = 'EXEC USP_GetPlasticPipeArchivedData @Search = ?, @StartIndex = ?, @PageSize = ?, @SortBy = ?, @SortOrder = ?';

		// Prepare the statement
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
		
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set spreadsheet headers
        if (isset($query_data[1])) {
	        $sheet_data = $query_data[1];
	        if (isset($sheet_data[0])) {
	        	$spreadsheet 	= new Spreadsheet();
	        	$sheet 			= $spreadsheet->getActiveSheet();
		        $headers 		= array_keys($sheet_data[0]);
		        // Instantiate dompdf
                $dompdf = new Dompdf();
                
                // Set PDF options
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isPhpEnabled', true);
                $dompdf->setOptions($options);

                // Split data into chunks and create multiple tables
                   $chunkSize = 25; // Number of rows per page
                   $columnsPerPage = 5; // Number of columns per page
                   $totalRows = count($sheet_data);
                   $chunks = array_chunk($sheet_data, $chunkSize);
                   $css = '<style>
                               table { 
                                   font-size: 10px; 
                                   border-collapse: collapse; 
                                   width: 100%; 
                               }
                               th, td { 
                                   padding: 5px; 
                                   text-align: left; 
                                   border: 1px solid #ddd; 
                                   word-wrap: break-word;
                               }
                               th {
                                   background-color: #f2f2f2;
                               }
                               .page-break { 
                                   page-break-before: always; 
                               }
                           </style>';
                   
                   $html = $css . '<h1>Archive List</h1>';
                   
                   // Loop through each chunk to create separate tables
                   foreach ($chunks as $index => $chunk) {
                       if ($index > 0) {
                           $html .= '<div class="page-break">New Archive data Start</div>'; // Add page break after each table
                       }

                       // Get the first chunk of column headers (first 5, then next 5, etc.)
                       $columnHeaders = array_keys($chunk[0]);
                       $totalColumns = count($columnHeaders);
                       $columnChunks = array_chunk($columnHeaders, $columnsPerPage);

                       foreach ($columnChunks as $colIndex => $colChunk) {
                           if ($colIndex > 0) {
                               $html .= '<div class="page-break"></div>'; // Add page break after each column set
                           }

                           $html .= '<table>';
                           $html .= '<thead><tr>';
                           foreach ($colChunk as $header) {
                               $html .= '<th>' . htmlspecialchars($header) . '</th>';
                           }
                           $html .= '</tr></thead><tbody>';
                           
                           foreach ($chunk as $row) {
                               $html .= '<tr>';
                               foreach ($colChunk as $header) {
                                   $html .= '<td>' . htmlspecialchars($row[$header]) . '</td>';
                               }
                               $html .= '</tr>';
                           }
                           
                           $html .= '</tbody></table>';
                       }
                   }


                // Load HTML content into dompdf
                $dompdf->loadHtml($html);

                // Set paper size and orientation
                $dompdf->setPaper('A4', 'landscape');

                // Render PDF
                $dompdf->render();

                // Stream the file to the browser
                $dompdf->stream('archive_list.pdf', array('Attachment' => 1));
	        }
        }
        redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
	}
	public function export_complaint_excel()
	{
	    $param = array(
	        $this->session->userdata('user')['id']
	    );
	    $sql = 'EXEC USP_GetQAComplaintData_Export @LoggedInUserId = ?';

	    // Prepare the statement
	    $stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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

	    // Check if results are valid
	    if (empty($query_data) || empty($query_data[0]) || empty($query_data[1])) {
	        return false;  // Handle missing data
	    }

	    $array1 = $query_data[0];
	    $array2 = $query_data[1];

	    // Create new Spreadsheet
	    $spreadsheet = new Spreadsheet();

	    // Sheet 1: ComplaintDetails
	    $sheet1 = $spreadsheet->getActiveSheet();
	    $sheet1->setTitle('ComplaintDetails');

	    // Set header for Sheet 1
	    $headers1 = array_keys($array1[0]);
	    $column = 'A';
	    foreach ($headers1 as $header) {
	        $sheet1->setCellValue($column . '1', $header);
	        $column++;
	    }

	    // Fill data for Sheet 1
	    $row = 2;
	    foreach ($array1 as $data) {
	        $column = 'A';
	        foreach ($data as $value) {
	            $sheet1->setCellValue($column . $row, $value);
	            $column++;
	        }
	        $row++;
	    }

	    // Sheet 2: ProductDetails
	    $spreadsheet->createSheet();
	    $sheet2 = $spreadsheet->getSheet(1);
	    $sheet2->setTitle('ProductDetails');

	    // Set header for Sheet 2
	    $headers2 = array_keys($array2[0]);
	    $column = 'A';
	    foreach ($headers2 as $header) {
	        $sheet2->setCellValue($column . '1', $header);
	        $column++;
	    }

	    // Fill data for Sheet 2
	    $row = 2;
	    foreach ($array2 as $data) {
	        $column = 'A';
	        foreach ($data as $value) {
	            $sheet2->setCellValue($column . $row, $value);
	            $column++;
	        }
	        $row++;
	    }

	    // Save the Excel file
	    $writer = new Xlsx($spreadsheet);
	    $filename = 'complaints_data.xlsx';

	    // Send the file to the browser for download
	    ob_clean();  // Clear buffer to avoid header issues
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment;filename="' . $filename . '"');
	    header('Cache-Control: max-age=0');

	    $writer->save('php://output');
	    exit;  // Ensure no further output is sent
	}

	public function export_complaint_pdf()
	{

		// Initialize Dompdf with options
		$options = new Options();
		$options->set('defaultFont', 'Courier');
		$dompdf = new Dompdf($options);
		$param = array(
		    $this->session->userdata('user')['id']
		);
		$sql = 'EXEC USP_GetQAComplaintData_Export @LoggedInUserId = ?';

		// Prepare the statement
		$stmt = sqlsrv_prepare($this->ppq_form_db->conn_id, $sql, $param);

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
		
		$complaints = $query_data[0];
		$products = $query_data[1];

		// Prepare HTML content for PDF
		$html = '<h1>Complaints Data</h1>';
		
		// Split complaints data into chunks of 5 fields each
		$complaintChunks = array_chunk(array_keys($complaints[0]), 5);
		
		foreach ($complaintChunks as $chunkIndex => $fields) {
		    $html .= '<table border="1" cellpadding="4" cellspacing="0">';
		    $html .= '<thead><tr>';

		    // Add table headers for current chunk
		    foreach ($fields as $field) {
		        $html .= '<th>' . htmlspecialchars($field) . '</th>';
		    }

		    $html .= '</tr></thead><tbody>';

		    // Add complaint data rows for current chunk
		    foreach ($complaints as $complaint) {
		        $html .= '<tr>';
		        foreach ($fields as $field) {
		            $html .= '<td>' . htmlspecialchars($complaint[$field]) . '</td>';
		        }
		        $html .= '</tr>';
		    }

		    $html .= '</tbody></table>';

		    // Add page break after each chunk except the last one
		    if ($chunkIndex < count($complaintChunks) - 1) {
		        $html .= '<div style="page-break-before: always;"></div>';
		    }
		}

		// Add a page break after all complaint data
		$html .= '<div style="page-break-before: always;"></div>';

		// Start product table data
		$html .= '<h1>Products Data</h1>';

		// Split products data into chunks of 5 fields each
		$productChunks = array_chunk(array_keys($products[0]), 5);
		
		foreach ($productChunks as $chunkIndex => $fields) {
		    $html .= '<table border="1" cellpadding="4" cellspacing="0">';
		    $html .= '<thead><tr>';

		    // Add table headers for current chunk
		    foreach ($fields as $field) {
		        $html .= '<th>' . htmlspecialchars($field) . '</th>';
		    }

		    $html .= '</tr></thead><tbody>';

		    // Add product data rows for current chunk
		    foreach ($products as $product) {
		        $html .= '<tr>';
		        foreach ($fields as $field) {
		            $html .= '<td>' . htmlspecialchars($product[$field]) . '</td>';
		        }
		        $html .= '</tr>';
		    }

		    $html .= '</tbody></table>';

		    // Add page break after each chunk except the last one
		    if ($chunkIndex < count($productChunks) - 1) {
		        $html .= '<div style="page-break-before: always;"></div>';
		    }
		}

		// Load HTML content into Dompdf
		$dompdf->loadHtml($html);

		// (Optional) Set paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream('complaint_list.pdf', array('Attachment' => 1));
		redirect(site_url('plastic_pipe_quality_issue_submittal_form'));
	}

}
