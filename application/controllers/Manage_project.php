<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_project extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'manage_project';
	    $this->load->helper('project_helper');
	    $this->data['project_lists'] = get_project_data();
	    $this->data['javascripts'] 	= array('manage_project.js');
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
				'name'	=> 'Manage Projects'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$quotes_submit_query  = $this->db->query('EXEC stormconfig.USP_GetQuoteProductList');
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
				'url'	=> site_url('manage_project'),
				'name'	=> 'Manage Projects'
			),
			'2' => array(
				'url'	=> '',
				'name'	=> $project_id
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		// Execute the stored procedure using SQLSRV driver
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
		// echo "<pre>";
		// print_r($quote_resultSets);
		// exit;
		
		$quote_data 		= array();
		$product_data 		= array();
		$product_file_data	= array();
		if (!empty($quote_resultSets)) {
			if (isset($quote_resultSets[0][0])) {
				$quote_data = $quote_resultSets[0][0];
			}
			if (isset($quote_resultSets[1][0])) {
				$product_data = $quote_resultSets[1][0];
			}
			if (isset($quote_resultSets[2])) {
				$product_file_data = $quote_resultSets[2];
			}
		}
		$this->data['quote_data'] 			= $quote_data;
		$this->data['product_data'] 		= $product_data;
		$this->data['product_file_data']	= $product_file_data;
		echo "<pre>";
		print_r($this->data);
		exit;
	}
}
