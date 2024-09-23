<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capex extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'dashboard';
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
				'name'	=> 'Capex'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
}
