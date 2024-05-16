<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_in_progress extends MY_Controller {

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
	    $this->data['active_menu'] = '';
		$this->load->helper('project_helper');
		$this->data['project_lists'] = get_project_data();
	}
	public function index()
	{
	}
}
