<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct();  
	    $this->data['active_menu'] 	= 'projects';
	    $this->s_user = $this->session->userdata('user');
	    if(empty($this->s_user)){
	        redirect(site_url('login'));
	    }
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
				'name'	=> 'Projects'
			)
		);
		$this->data['breadcrumb'] = $breadcrumb_data;
		$get_project_data  = 'EXEC USP_GetSiteListByUserID @UserId = ?,@IsDashboardLogo = ?;';
		$param = array(
            'UserId'      		=> $this->session->userdata('user')['id'],
            'IsDashboardLogo'   => 1
        );
        $website_data 	= $this->db->query($get_project_data,$param);
        $result   		= $website_data->result_array();
		$this->data['dashboard_data'] = $result;
	}
}
