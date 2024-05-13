<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'contact';
	    $this->load->helper('project_helper');
	    $this->data['project_lists'] = get_project_data();
	    $this->data['style_links'] 	= array('pages/css/contact.min.css','global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');
	    $this->data['js_links'] 	= array('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js','global/plugins/jquery.sparkline.min.js','global/plugins/gmaps/gmaps.min.js');
	    $this->data['javascripts'] 	= array('contact.js');
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
				'name'	=> 'Contact Us'
			) 
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
	}
}
