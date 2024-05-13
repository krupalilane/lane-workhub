<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->load->helper('project_helper');
	    $this->data['project_lists'] = get_project_data();
	    $this->data['active_menu'] = 'support';
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
				'name'	=> 'Support / FAQ'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
}
