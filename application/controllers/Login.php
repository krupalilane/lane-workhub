<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller{

    protected $layout = 'layouts/login_layout';
    
    public function __construct() {
        parent::__construct();
        $this->data['js_links']    = array('global/plugins/jquery-validation/js/jquery.validate.min.js','global/plugins/jquery-validation/js/additional-methods.min.js');
        $this->data['javascripts']  = array('login.js');
    }

    public function index(){
        
    }
    public function check_login(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() != FALSE){            
            $email      = $this->input->post('email');
            $password   = md5($this->input->post('password'));

            $get_user_db = "EXEC stormconfig.USP_CheckUser 
                @UserName = ?,  
                @Password = ?;";
            $param = array(
                'UserName'      => $email,
                'Password'      => $password
            );
            
            $user_add = $this->db->query($get_user_db,$param);
            $result   = $user_add->row_array();

            if(!empty($result['UserId'])){
                $this->config->load('config');
                $this->config->set_item('sess_expiration', $this->data['setting']['value']); 
                $this->session->set_userdata('user', ['id' => $result['UserId'],'firstname' => $result['FirstName'],'lastname' => $result['LastName'],'IsLoggedInFirstTime' => $result['IsLoggedInFirstTime'],'UserClass' => $result['UserClass']]);
                redirect(site_url('manage_project'));
            }else{
                $this->session->set_flashdata('error','Email/Password is incorrect');
                redirect(site_url('login'));
            }
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect(site_url('login'));
        }
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
}