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
				'url'	=> 'home',
				'name'	=> 'Home'
			), 
			'1' => array(
				'url'	=> '',
				'name'	=> 'Manage Projects'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
	public function get_all_project()
	{
		// code...
	}
}
