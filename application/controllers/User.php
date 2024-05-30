<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	protected $asides = array('header' => 'layouts/_header',
							'footer' => 'layouts/_footer',
	                        'js' => 'layouts/_js',
	                    );
	protected $layout = 'layouts/master_layout';
	public function __construct() {
	    parent::__construct(); 
	    $this->load->library('email');
	}
	private function _load_email_config() {
	   $config['protocol'] 		= SMTP_PROTOCOL;
        $config['smtp_host'] 	= SMTP_HOST;
        $config['smtp_port'] 	= SMTP_PORT; // or the appropriate port
        $config['smtp_user'] 	= SMTP_FROM_EMAIL;
        $config['smtp_pass'] 	= SMTP_PASSWORD;
        $config['smtp_crypto'] 	= 'tls'; // or 'ssl' if required
        $config['mailtype'] 	= 'html';
        $config['charset'] 		= 'utf-8';
        $config['wordwrap'] 	= true;
        $config['smtp_timeout'] = 30;
        $config['newline'] 		= "\r\n";
        $config['crlf'] 		= "\r\n";

        $this->email->initialize($config);

	}
	public function registration_active($access_token)
	{
		if (!empty($access_token)) {
			$param = array(
			    'AccessToken'    => $access_token,
			    'TokenType'      => REGISTRATION_TOKEN_TYPE
			);
			$check_access_token_db = "EXEC stormconfig.MarkUserAsVerified 
			    @AccessToken = ?,  
			    @TokenType   = ?;";
			    $user_add = $this->db->query($check_access_token_db,$param);
			    $result   = $user_add->result_array();
			    if (isset($result[0]['State'])) {
			    	if ($result[0]['State'] == 1) {
			    		$this->session->set_flashdata('success','Account Activated!');
			    		redirect(site_url('login'));
			    	}else{
			    		$this->session->set_flashdata('error','Something went wrong!');
			    		redirect(site_url('login'));
			    	}
			    }else{
					$this->session->set_flashdata('error','Something went wrong!');
					redirect(site_url('login'));
				}
		}else{
			$this->session->set_flashdata('error','Something went wrong!');
			redirect(site_url('login'));
		}
	}
	public function change_email_active($access_token)
	{
		if (!empty($access_token)) {
			$param = array(
			    'AccessToken'    => $access_token,
			    'TokenType'      => CHANGE_EMAIL_TOKEN_TYPE
			);
			$check_access_token_db = "EXEC stormconfig.MarkUserAsVerified 
			    @AccessToken = ?,  
			    @TokenType   = ?;";
			    $user_add = $this->db->query($check_access_token_db,$param);
			    $result   = $user_add->result_array();
			    if (isset($result[0]['State'])) {
			    	if ($result[0]['State'] == 1) {
			    		$this->session->set_flashdata('success','Account Activated!');
			    		redirect(site_url('login'));
			    	}else{
			    		$this->session->set_flashdata('error','Something went wrong!');
			    		redirect(site_url('login'));
			    	}
			    }else{
					$this->session->set_flashdata('error','Something went wrong!');
					redirect(site_url('login'));
				}
		}else{
			$this->session->set_flashdata('error','Something went wrong!');
			redirect(site_url('login'));
		}
	}
}
