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
	}
}
