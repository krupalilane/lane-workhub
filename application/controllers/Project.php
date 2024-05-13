<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] = 'project';
		$this->load->helper('project_helper');
		$this->load->database();
		$this->data['project_lists'] = get_project_data();
	}
	public function create_project($id)
	{
		$this->data['javascripts'] 	= array('project.js');
		$this->data['project_id'] 	= $id;
		$breadcrumb_data = array(
			'0' => array(
				'url'	=> site_url('manage_project'),
				'name'	=> 'Home'
			), 
			'1' => array(
				'url'	=> '',
				'name'	=> 'Create Project'
			) 
		); 
		if ($id == STORMKEEPER) {
			$breadcrumb = array(
				'url'	=> '',
				'name'	=> 'StormKeeper'
			);
			array_push($breadcrumb_data, $breadcrumb);
		}elseif ($id == CMP_SYSTEM) {
			$breadcrumb = array(
				'url'	=> '',
				'name'	=> 'CMP System (Beta)'
			);
			array_push($breadcrumb_data, $breadcrumb);
		}elseif ($id == HDPE_SYSTEM) {
			$breadcrumb = array(
				'url'	=> '',
				'name'	=> 'HDPE System (Beta)'
			);
			array_push($breadcrumb_data, $breadcrumb);
		}
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function save_project()
	{	
		$project_name 	= $this->input->post('project_name');
		$prodidint 		= $this->input->post('prodidint');
		$cfgProduct 	= $this->input->post('cfgProduct');
		$quoteFields	= json_decode($this->input->post('quoteFields'), TRUE);
		$user_name 		= KBMAX_USER_EMAIL;
		$password  		= KBMAX_USER_PASSWORD;
		$headers 		= array(
		    "Content-Type: application/json",
		    "Accept: */*",
		    'Authorization: Basic '. base64_encode("$user_name:$password")
		);
		//start code for add quotes in kbmax calling API
			$quote_post_data	=  [
			    "name" 			=> $project_name,
			    "currency" 		=> "USD",
			    "quoteProducts" => [],
			    "products" 		=> [],
			    "discountPercentage" => 0,
			    "headerValues" 		=> [
			        "configurators" => [],
			        "fields" 		=> [["name" => "UserEmail", "stringValue" => null]],
			        "name" 			=> "User Information",
			        "entityType" 	=> "quoteHeader",
			        "idQuoteHeader" => 1,
			        "validationMessages" 	=> [],
			    ],
			];
			$quote_save_ch 		= curl_init();
			// Set the url, number of POST vars, POST data
			curl_setopt($quote_save_ch, CURLOPT_URL, $this->config->item('quotes_save'));

			curl_setopt($quote_save_ch, CURLOPT_POST, true);
			curl_setopt($quote_save_ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($quote_save_ch, CURLOPT_RETURNTRANSFER, true);

			// Disabling SSL Certificate support temporarily
			curl_setopt($quote_save_ch, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($quote_save_ch, CURLOPT_POSTFIELDS, json_encode($quote_post_data));

			// Execute post
			$quote_saved_data = curl_exec($quote_save_ch);

			if ($quote_saved_data === false) {
			    echo 'cURL Error: ' . curl_error($quote_save_ch);
			} else {
			    // Successful response, decode JSON
			    $quote_saved_data = json_decode($quote_saved_data);
			    // Handle the decoded result here
			}
			// Close connection
			curl_close($quote_save_ch);
		//end code for add quotes in kbmax calling API
		if (!empty($quote_saved_data)) {
			$quote_id = $quote_saved_data->id;
			//start code for add product in last created quote kbmax calling API
				$product_post_data = [
					'idProduct' 		=> $prodidint,
					'qty' 				=> 1,
					'configuredProduct' => json_decode($cfgProduct, TRUE),
				];
				$product_save_url = sprintf($this->config->item('product_save'),$quote_id);
				$product_save_ch  = curl_init();
				// Set the url, number of POST vars, POST data
				curl_setopt($product_save_ch, CURLOPT_URL, $product_save_url);

				curl_setopt($product_save_ch, CURLOPT_POST, true);
				curl_setopt($product_save_ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($product_save_ch, CURLOPT_RETURNTRANSFER, true);

				// Disabling SSL Certificate support temporarily
				curl_setopt($product_save_ch, CURLOPT_SSL_VERIFYPEER, false);

				curl_setopt($product_save_ch, CURLOPT_POSTFIELDS, json_encode($product_post_data));

				// Execute post
				$product_saved_data = curl_exec($product_save_ch);

				if ($product_saved_data === false) {
				    echo 'cURL Error: ' . curl_error($product_save_ch);
				} else {
				    // Successful response, decode JSON
				    $product_saved_data = json_decode($product_saved_data);
				    // Handle the decoded result here
				}
				// Close connection
				curl_close($product_save_ch);
			//end code for add product in last created quote kbmax calling API
			//start code for submit quotes
				$quote_submit_ch  = curl_init();
				// Set the url, number of POST vars, POST data
				curl_setopt($quote_submit_ch, CURLOPT_URL, $this->config->item('quotes_submit'));

				curl_setopt($quote_submit_ch, CURLOPT_POST, true);
				curl_setopt($quote_submit_ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($quote_submit_ch, CURLOPT_RETURNTRANSFER, true);

				// Disabling SSL Certificate support temporarily
				curl_setopt($quote_submit_ch, CURLOPT_SSL_VERIFYPEER, false);

				curl_setopt($quote_submit_ch, CURLOPT_POSTFIELDS, json_encode($product_saved_data));
	
				// Execute post
				$quote_submit_data = curl_exec($quote_submit_ch);
				$quote_submit_code = curl_getinfo($quote_submit_ch,CURLINFO_HTTP_CODE);

				if ($quote_submit_data === false) {
				    echo 'cURL Error: ' . curl_error($quote_submit_ch);
				} else {
					// Successful response, decode JSON
				    $quote_submit_data = json_decode($quote_submit_data);
				    // Handle the decoded result here
				}
				// Close connection
				curl_close($quote_submit_ch);
				
			//end code for submit quotes
			//start code for save details in database quotes and products
				if($quote_submit_code == 200){
					$kbmaxQuoteID 					= $quote_submit_data->id;
					$quoteName 						= $quote_submit_data->name;
					$quoteJSON 						= json_encode($quote_submit_data);
					$status 						= 1;
					$db_product_details 			= $quote_submit_data->products;
					$userId 						= 0;
					$kbmaxProductID 				= '';
					$volumeNeeded 					= '';
					$soilBearing 					= '';
					$maxBuryDepth 					= '';
					$length 						= '';
					$width 							= '';
					$invert 						= '';
					$chamberSelect 					= '';
					$mainfold 						= '';
					$manHeaderSize 					= '';
					$manStubSize 					= '';
					$perforated 					= '';
					$pipeDiamSelection 				= '';
					$manifoldSide 					= '';
					$configuredProductId 			= '';
					$configuredProductDetailsJSON 	= '';
					$configuredProductName 			= '';
					if (!empty($db_product_details)) {
						foreach ($db_product_details as $key => $prod_detail) {
							$kbmaxProductID 				= $prod_detail->id;
							$configuredProductName 			= $prod_detail->configuredProduct->name;
							$configuredProductId 			= $prod_detail->idProduct;
							$volumeNeeded 					= isset($quoteFields['Volume Needed (cf)']) ? $quoteFields['Volume Needed (cf)'] : '';
							$soilBearing 					= isset($quoteFields['SoilBearing']) ? $quoteFields['SoilBearing'] : '';
							$maxBuryDepth 					= isset($quoteFields['MaxBuryDepth']) ? $quoteFields['MaxBuryDepth'] : '';
							$length 						= isset($quoteFields['Length']) ? $quoteFields['Length'] : '';
							$width 							= isset($quoteFields['Width']) ? $quoteFields['Width'] : '';
							$invert 						= isset($quoteFields['Invert']) ? $quoteFields['Invert'] : '';
							$chamberSelect 					= isset($quoteFields['ChamberSelect']) ? $quoteFields['ChamberSelect'] : '';
							$mainfold 						= isset($quoteFields['Mainfold']) ? $quoteFields['Mainfold'] : '';
							$manHeaderSize 					= isset($quoteFields['ManHeaderSize']) ? $quoteFields['ManHeaderSize'] : '';
							$manStubSize 					= isset($quoteFields['ManStubSize']) ? $quoteFields['ManStubSize'] : '';
							$perforated 					= isset($quoteFields['perforated']) ? $quoteFields['perforated'] : '';
							$pipeDiamSelection 				= isset($quoteFields['PipeDiamSelection']) ? $quoteFields['PipeDiamSelection'] : '';
							$manifoldSide 					= isset($quoteFields['Manifold Side']) ? $quoteFields['Manifold Side'] : '';
						}
						$add_quotes_db = "EXEC stormconfig.InsertQuoteProduct 
						 	@kbmaxQuoteID						= ?,			
							@QuoteName							= ?,	
							@QuoteJSON							= ?,
							@Status								= ?,
							@kbmaxProductID						= ?,
							@VolumeNeeded						= ?,
							@SoilBearing						= ?,
							@MaxBuryDepth						= ?,
							@Length								= ?,
							@Width								= ?,
							@Invert								= ?,
							@ChamberSelect						= ?,
							@Mainfold							= ?,
							@ManHeaderSize						= ?,
							@ManStubSize						= ?,
							@Perforated							= ?,
							@PipeDiamSelection					= ?,
							@ManifoldSide						= ?,
							@ConfiguredProductId				= ?,
							@ConfiguredProductDetailsJSON		= ?,
							@ConfiguredProductName				= ?,
							@UserId								= ?";
							$param = array($kbmaxQuoteID,$quoteName,$quoteJSON,$status,$kbmaxProductID,$volumeNeeded,$soilBearing,$maxBuryDepth,$length,$width,$invert,$chamberSelect,$mainfold,$manHeaderSize,$manStubSize,$perforated,$pipeDiamSelection,$manifoldSide,$configuredProductId,$configuredProductDetailsJSON,$configuredProductName,$userId);
							$quotes_submit_query = $this->db->query($add_quotes_db,$param);
							$result = $quotes_submit_query->result_array();
					}
				}
			//end code for save details in database quotes and products
			$response['status'] = 'success';
			$response['message'] = 'Product added successfully';
		}else{
			$response['status'] = 'error';
			$response['message'] = 'Something went wrong. Please try again later!';
		}
		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode($response))
		->_display();
		die;
	}
}
