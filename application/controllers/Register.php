<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends MY_Controller{

    protected $layout = 'layouts/login_layout';
    
    public function __construct() {
        parent::__construct();
        $this->data['js_links']    = array('global/plugins/jquery-validation/js/jquery.validate.min.js','global/plugins/jquery-validation/js/additional-methods.min.js');
        $this->data['javascripts']  = array('registartion.js');
    }

    public function index(){
        $stmt = sqlsrv_query($this->db->conn_id, 'EXEC stormconfig.USP_GetUserDetailbyId @UserId = 0');
        if (!$stmt) {
            return false;
        }

        $user_resultSets = array();
        do {
            $resultSet = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultSet[] = $row;
            }
            $user_resultSets[] = $resultSet;
        } while (sqlsrv_next_result($stmt));
        $office_details = array();
        if(isset($user_resultSets[1])){
            $office_details = $user_resultSets[1];
        }
        sqlsrv_free_stmt($stmt);
        $this->data['office_details'] = $office_details; 
    }
    public function save_user()
    {
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'last Name', 'trim|required');
        $this->form_validation->set_rules('localoffice', 'Local Office', 'trim|required');
        $this->form_validation->set_rules('agree_eul', 'End User License', 'trim|required');
        $this->form_validation->set_rules('agree_tou', 'Terms of Use', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_user_exist');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_password_check');
        $this->form_validation->set_rules('rpassword', 'Re-type Password', 'trim|matches[password]');

        if ($this->form_validation->run() != FALSE){      
            $agree_eul  = 0;
            if ($this->input->post('agree_eul')) {
                $agree_eul  = 1;
            }
            $agree_tou  = 0;
            if ($this->input->post('agree_tou')) {
                $agree_tou  = 1;
            }
            $param = array(
                'UserID'                                                   => 0,
                'SectionId'                                                => '',
                'FirstName'                                                => $this->input->post('firstname'),
                'MiddleName'                                               => '',
                'LastName'                                                 => $this->input->post('lastname'),
                'Email'                                                    => $this->input->post('email'),
                'OfficeId'                                                 => $this->input->post('localoffice'),
                'Password'                                                 => md5($this->input->post('password')),
                'CompanyName'                                              => '',
                'Phone'                                                    => '',
                'Address1'                                                 => '',
                'Address2'                                                 => '',
                'City'                                                     => '',
                'StateId'                                                  => '',
                'ZipCode'                                                  => '',
                'AgreeUserLicense'                                         => $agree_eul,
                'AgreeTermsOfUse'                                          => $agree_tou,
                'IsAgreeToRecPromEmailFromLaneStormStorage'                => 0,
                'IsAgreeToRecNotifEmailFromLaneStormStorage'               => 0,
                'IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage'   => 0,
                'LoggedInUserID'                                           => '-1'
            );
            $add_user_db = "EXEC stormconfig.USP_InsertUpdateUserData 
                @UserID                                                    = ?,  
                @SectionId                                                 = ?,  
                @FirstName                                                 = ?,  
                @MiddleName                                                = ?,  
                @LastName                                                  = ?,  
                @Email                                                     = ?,  
                @OfficeId                                                  = ?,  
                @Password                                                  = ?,  
                @CompanyName                                               = ?,  
                @Phone                                                     = ?,  
                @Address1                                                  = ?,  
                @Address2                                                  = ?,  
                @City                                                      = ?,  
                @StateId                                                   = ?,  
                @ZipCode                                                   = ?,  
                @AgreeUserLicense                                          = ?,  
                @AgreeTermsOfUse                                           = ?,  
                @IsAgreeToRecPromEmailFromLaneStormStorage                 = ?,  
                @IsAgreeToRecNotifEmailFromLaneStormStorage                = ?,  
                @IsAgreeToRecMonthlyNewsLetterEmailFromLaneStormStorage    = ?,  
                @LoggedInUserID                                            = ?;";
                $user_add = $this->db->query($add_user_db,$param);
                $result   = $user_add->result_array();
                $this->session->set_flashdata('success',"Account Created. Details sent via email.");
                redirect(site_url('login'));
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect(site_url('register'));
        }
    }
    public function check_email()
    {
        $email          = $this->input->post('email');
        $email_query    = $this->db->query("EXEC stormconfig.USP_CheckEmailAddress @EmailAddress = ?;",$email);
        $result         = $email_query->row_array();

        if (!empty($result)) {
            $response = ['exists' => true];
        } else {
            $response = ['exists' => false];
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

        if (!empty($result)) {
            $this->form_validation->set_message('check_user_exist', 'User with same email already exist!');
            return false;
        }else{
            return true;
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