<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote_administration extends MY_Controller {

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
	    if ($this->session->userdata('user')['UserClass'] != ADMIN_ROLE) {
	    	redirect(site_url('access_denied'));
	    }
	    $this->data['active_menu'] = 'quote_administration';
		$this->load->helper('project_helper');
		$this->data['project_lists'] = get_project_data();
		$this->data['javascripts'] 	= array('quote_administration.js');
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
				'name'	=> 'Quote Administration'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;

		$quotes_submit_query  = $this->db->query('EXEC stormconfig.USP_GetQuoteProductList @UserId = 0');
		$this->data['quotes'] = $quotes_submit_query->result_array();
	}
	public function view($id)
	{
		$project_id = 'Project #P'.str_pad($id, 5, '0', STR_PAD_LEFT);
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('manage_project'),
				'name'	=> 'Home'
			), 
			'1' => array(
				'url'	=> site_url('quote_administration'),
				'name'	=> 'Quote Administration'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> 'View Quote'
			),
			'3' => array(
				'url'	=> '',
				'name'	=> $project_id
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$this->data['project_id'] = $project_id;
		//start code for get quotes data and check if status is completed or in progress
			$stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetQuoteProductList @QuoteId = '.$id);
			if (!$stmt) {
			    return false;
			}

			$quote_resultSets = array();
			do {
			    $resultSet = array();
			    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			        $resultSet[] = $row;
			    }
			    $quote_resultSets[] = $resultSet;
			} while (sqlsrv_next_result($stmt));

			sqlsrv_free_stmt($stmt);
			
			$quotes_status 		= array();
			$product_data 		= array();
			if (!empty($quote_resultSets)) {
				if (isset($quote_resultSets[0][0])) {
					$quotes_status = $quote_resultSets[0][0];
				}
				if (isset($quote_resultSets[1][0])) {
					$product_data = $quote_resultSets[1][0];
				}
				if (isset($quote_resultSets[2])) {
					$product_file_data = $quote_resultSets[2];
				}
			}
		//end code for get quotes data and check if status is completed or in progress
		// Execute the stored procedure using SQLSRV driver
		if ($quotes_status) {
			if ($quotes_status['Status'] == 2) {
				$user_name 		= KBMAX_USER_EMAIL;
				$password  		= KBMAX_USER_PASSWORD;
				$headers 		= array(
				    "Content-Type: application/json",
				    "Accept: */*",
				    'Authorization: Basic '. base64_encode("$user_name:$password")
				);
				$quote_kbmax_url = sprintf($this->config->item('quotes_details'),$quotes_status['kbmaxQuoteID']);
				//start code for get quotes in kbmax calling API
					$quote_details_ch 		= curl_init();
					// Set the url, number of POST vars, POST data
					curl_setopt($quote_details_ch, CURLOPT_URL, $quote_kbmax_url);

					curl_setopt($quote_details_ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($quote_details_ch, CURLOPT_RETURNTRANSFER, true);

					// Disabling SSL Certificate support temporarily
					curl_setopt($quote_details_ch, CURLOPT_SSL_VERIFYPEER, false);

					// Execute post
					$quote_get_data = curl_exec($quote_details_ch);

					if ($quote_get_data === false) {
					    echo 'cURL Error: ' . curl_error($quote_details_ch);
					} else {
					    // Successful response, decode JSON
					    $quote_get_data = json_decode($quote_get_data);
					    // Handle the decoded result here
					}
					// Close connection
					curl_close($quote_details_ch);
					$kbmax_product_file_data = array();
					if (!empty($quote_get_data)) {
						if ($quote_get_data->state == 'Builds Complete') {
							$product_file_details 	 = $quote_get_data->products[0]->files;
							$kbmax_product_file_data = $product_file_details;
						
							$file_xml_data = '';
							if (!empty($product_file_details)) {
								$file_xml_data .= "<ProductFiles>";
								foreach ($product_file_details as $key => $kbmax_file) {
									$file_ext 		= pathinfo($kbmax_file->filePath, PATHINFO_EXTENSION);
									$ProductFileID 	= 0;
									if (!empty($product_file_data)) {
										$db_file_key = array_search($kbmax_file->id, array_column($product_file_data, 'kbmaxFileID'));
										if ($db_file_key !== false) {
											$ProductFileID = $product_file_data[$db_file_key]['ProductFileId'];
										}
									}											
									$file_xml_data .= "<ProductFile> <ProductFileID>".$ProductFileID."</ProductFileID><QuoteID>".$id."</QuoteID> <ProductID>".$product_data['ID']."</ProductID><kbmaxFileID>".$kbmax_file->id."</kbmaxFileID><FileName>".$kbmax_file->name."</FileName><ProductFilePath>".$kbmax_file->filePath."</ProductFilePath></ProductFile>";
								}
								$file_xml_data .= '</ProductFiles>';
								$quotes_submit_query = $this->db->query('EXEC USP_InsertUpdateDeleteProductFiles @XMLData = ?, @UserID = 0',$file_xml_data);
								$result = $quotes_submit_query->result_array();
							}
						}
					}
				//end code for get quotes in kbmax calling API

				$this->data['quote_data'] 			= $quotes_status;
				$this->data['product_data'] 		= $product_data;
				$this->data['product_file_data']	= $kbmax_product_file_data;
				$this->data['status'] 				= $quotes_status['Status'];
			}else{
				$this->data['quote_data'] 	= $quotes_status;
				$this->data['status'] 		= $quotes_status['Status'];
			}
		}
	}
	public function download_file($kbmax_file_id)
	{
		if ($kbmax_file_id) {
			$prod_file_query 		= $this->db->query('EXEC stormconfig.USP_GetProductFileDetailByKBMaxFileId @KBMaxFileId = '.$kbmax_file_id);
			$product_file_details 	= $prod_file_query->row_array();
			$product_file_name 		= $product_file_details['FileName'];
			$file_ex 				= pathinfo($product_file_details['FilePath'], PATHINFO_EXTENSION);
			$file_name   			= $product_file_name.'.'.$file_ex;
			$user_name 			= KBMAX_USER_EMAIL;
			$password  			= KBMAX_USER_PASSWORD;
			$headers 			= array(
			    "Content-Type: application/json",
			    "Accept: */*",
			    'Authorization: Basic '. base64_encode("$user_name:$password")
			);
			$file_kbmax_url = sprintf($this->config->item('product_file_download'),$kbmax_file_id);
			//start code for get quotes in kbmax calling API
				$quote_details_ch 		= curl_init();
				// Set the url, number of POST vars, POST data
				curl_setopt($quote_details_ch, CURLOPT_URL, $file_kbmax_url);

				curl_setopt($quote_details_ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($quote_details_ch, CURLOPT_RETURNTRANSFER, true);

				// Disabling SSL Certificate support temporarily
				curl_setopt($quote_details_ch, CURLOPT_SSL_VERIFYPEER, false);

				// Execute post
				$file_data = curl_exec($quote_details_ch);

				if ($file_data === false) {
				    echo 'cURL Error: ' . curl_error($quote_details_ch);
				}
				$http_code = curl_getinfo($quote_details_ch, CURLINFO_HTTP_CODE);
				// Close connection
				curl_close($quote_details_ch);

				if ($http_code != 200 || empty($file_data)) {
		           echo 'cURL Error: ';
		        }else{
			       // Load the download helper
			       $this->load->helper('download');
			       // Force download the file
			       force_download($file_name, $file_data);
		       }
		    //end code for get quotes in kbmax calling API
		}
	}
	public function delete_quote()
	{
		$quote_id = $this->input->post('quote_id');
		$quotes_delete_query = $this->db->query('EXEC stormconfig.USP_DeleteQuote @QuoteID = '.$quote_id.', @UserId = '.$this->session->userdata('user')['id']);
		$result = $quotes_delete_query->result_array();
		echo 'success';die;
	}
}
