<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Forgot_password extends MY_Controller{

    protected $layout = 'layouts/login_layout';
    
    public function __construct() {
        parent::__construct();
        $this->data['js_links']    = array('global/plugins/jquery-validation/js/jquery.validate.min.js','global/plugins/jquery-validation/js/additional-methods.min.js');
        $this->data['javascripts']  = array('forgot_password.js');
        $this->load->library('email');
    }
    private function _load_email_config() {
       $config['protocol']      = SMTP_PROTOCOL;
        $config['smtp_host']    = SMTP_HOST;
        $config['smtp_port']    = SMTP_PORT; // or the appropriate port
        $config['smtp_user']    = SMTP_FROM_EMAIL;
        $config['smtp_pass']    = SMTP_PASSWORD;
        $config['smtp_crypto']  = 'tls'; // or 'ssl' if required
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['wordwrap']     = true;
        $config['smtp_timeout'] = 30;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";

        $this->email->initialize($config);

    }

    public function index(){
    }
    public function change_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_user_exist');

        if ($this->form_validation->run() != FALSE){
            $user_id = $this->input->post('user_id');
            if (empty($user_id)) {
                $email_query    = $this->db->query("EXEC stormconfig.USP_CheckEmailAddress @EmailAddress = ?;",$this->input->post('email'));
                $result         = $email_query->row_array();
                $user_id        = $result['ID'];
            }
            $param = array(
                'UserID'    => $user_id,
                'TokenType' => FORGET_PASSWORD_TOKEN_TYPE
            );
            $get_access_token_query   = $this->db->query("EXEC stormconfig.USP_SendTokenForForgotPasswordPage @UserID = ?, @TokenType = ?;",$param);
            $get_access_token         = $get_access_token_query->row_array();
                
            if (isset($get_access_token['AccessToken'])) {
                $access_token   = $get_access_token['AccessToken'];
                $email_data     = array(
                    'name'              => $get_access_token['UserName'],
                    'access_token_url'  => site_url('user/reset_password/'.$access_token),
                );

                //start code for send email for active user
                $from_email = SMTP_FROM_EMAIL;
                $to_email   = SMTP_FROM_EMAIL;
                $this->_load_email_config();
                $email_message = $this->load->view('email/forgot_password_email', $email_data, TRUE);
                $this->email->from($from_email, 'Identification');
                $this->email->to($to_email);
                $this->email->subject('Change password');
                $this->email->message($email_message);
                if ($this->email->send()) {
                    echo 'Email successfully sent';
                } else {
                    echo $this->email->print_debugger();
                }
                //end code for send email for active user

                $this->session->set_flashdata('success',"Forgot password link sent via email.");
                redirect(site_url('forgot_password'));
            }else{
                $this->session->set_flashdata('error','Something went wrong!');
                redirect(site_url('forgot_password'));
            }
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect(site_url('forgot_password'));
        }
        
    }
    public function check_email()
    {
        $email          = $this->input->post('email');
        $email_query    = $this->db->query("EXEC stormconfig.USP_CheckEmailAddress @EmailAddress = ?;",$email);
        $result         = $email_query->row_array();
        
        if (!empty($result)) {
            $response = ['exists' => false,'user_id' => $result['ID']];
        } else {
            $response = ['exists' => true];
        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($response))
        ->_display();
        die;
    }
    function check_user_exist(){
        $email          = $this->input->post('email');
        $email_query    = $this->db->query("EXEC stormconfig.USP_CheckEmailAddress @EmailAddress = ?;",$email);
        $result         = $email_query->row_array();

        if (empty($result)) {
            $this->form_validation->set_message('check_user_exist', 'User with this email not exist!');
            return false;
        }else{
            return true;
        }
    }
    public function reset_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_password_check');
        $this->form_validation->set_rules('rpassword', 'Re-type Password', 'trim|matches[password]');
        if ($this->form_validation->run() != FALSE){
            $param = array(
                'VerificationType'  => FORGET_PASSWORD_TOKEN_TYPE,
                'TokenType'         => FORGET_PASSWORD_TOKEN_TYPE,
                'AccessToken'       => $this->input->post('access_token'),
                'NewPassword'       => md5($this->input->post('password')),
                
            );
            $pass_change = "EXEC stormconfig.MarkUserAsVerified 
                @VerificationType   = ?,  
                @TokenType          = ?,  
                @AccessToken        = ?,  
                @NewPassword        = ?;";
                $password_change_query = $this->db->query($pass_change,$param);
                $result   = $password_change_query->result_array();

                $this->session->set_flashdata('success',"Password is updated.");
                redirect(site_url('login'));
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect(site_url('user/reset_password/'.$this->input->post('access_token')));
        }
    }
    public function password_check() {
        $password          = $this->input->post('password');
        if (preg_match('/[A-Z]/', $password) && 
            preg_match('/[a-z]/', $password) && 
            preg_match('/\d/', $password)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('password_check', 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.');
            return FALSE;
        }
    }
}