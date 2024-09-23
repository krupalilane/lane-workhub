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
        $getMacAddress = $this->getMacAddress();
        $get_user_db = "EXEC USP_GetUserDetailsByMac 
            @MacAddress = ?;";
        $param = array(
            'MacAddress'      => $getMacAddress
        );
        
        $user_add = $this->db->query($get_user_db,$param);
        $result   = $user_add->row_array();
        if (!empty($result)) {
            $this->check_login_data($result['UserName'],$result['Password']);
        }
    }
    function getMacAddress() {
        // Execute the getmac command and capture the output
        $output = shell_exec("getmac");
        
        // Trim any extra whitespace
        $output = trim($output);
     
        // Split the output into lines
        $lines = explode("\n", $output);
        
        // Extract the MAC address from the first non-empty line
        foreach ($lines as $line) {
            // Extract MAC address using a regular expression
            if (preg_match('/^([\w\-:]{17})/', $line, $matches)) {
                return $matches[1];
            }
        }
        
        return "MAC Address not found";
    }
    function isValidMd5($md5 ='')
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    public function check_login(){
        $this->form_validation->set_rules('username', 'User name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $getMacAddress = $this->getMacAddress();
        if ($this->form_validation->run() != FALSE){           
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');
            if ($this->isValidMd5($password)) {
                $password_md5 = $password;
            } else {
                $password_md5 = md5($password);
            }

            $this->check_login_data($username,$password);
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect(site_url('login'));
        }
    }

    public function logout(){
        $getMacAddress = $this->getMacAddress();
        $get_user_db = "EXEC USP_DeleteMacOnLogOut 
            @UserID = ?, @MacAddress = ?;";
        $param = array(
            'UserID'            => $this->session->userdata('user')['id'],
            'MacAddress'        => $getMacAddress
        );
        
        $user_add = $this->db->query($get_user_db,$param);
        $result   = $user_add->row_array();
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
    public function check_login_data($user_name,$password)
    {
        $getMacAddress = $this->getMacAddress();
        $username   = $user_name;
        $password   = $password;
        if ($this->isValidMd5($password)) {
            $password_md5 = $password;
        } else {
            $password_md5 = md5($password);
        }

        $param = array(
            $username,
            $password_md5,
            $getMacAddress
        );
        $sql = 'EXEC USP_UpdateMacOnLogIn  @UserName   = ?,  
            @Password   = ?,@MacAddress = ?;';
        $stmt = sqlsrv_prepare($this->db->conn_id, $sql, $param);

        if ($stmt === false) {
            return false;
        }
        $executeResult = sqlsrv_execute($stmt);

        if ($executeResult === false) {
            return false;
        }
        $query_data = array();
        do {
            $resultSet = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultSet[] = $row;
            }
            $query_data[] = $resultSet;
        } while (sqlsrv_next_result($stmt));
        sqlsrv_free_stmt($stmt);
        $user_data          = array();
        $user_permission    = array();
        if (!empty($query_data)) {
            if (isset($query_data[1][0])) {
                $user_data = $query_data[1][0];
            }
            if (isset($query_data[2])) {
                $user_permission = $query_data[2];
            }
        }
        if($user_data['UserId'] != 0){
            $this->session->set_userdata('user', ['id' => $user_data['UserId'],'firstname' => $user_data['FirstName'],'lastname' => $user_data['LastName'],'IsLoggedInFirstTime' => $user_data['IsLoggedInFirstTime'],'UserClass' => $user_data['UserClass'],'IsTodayBirthday' => $user_data['IsTodayBirthday'],'IsTodayAnniversary' => $user_data['IsTodayAnniversary'],'Email' => $user_data['Email'],'Role' => $user_data['Role'],'PermissionFolderName' => $permission_folder_name,'IsLoggedInFirstTime' => $user_data['IsLoggedInFirstTime']]);
            $this->session->set_userdata('user_site_permissions', $user_permission);
            $redirect_to = $this->session->userdata('redirect_to');
            if ($redirect_to) {
                $this->session->unset_userdata('redirect_to');
                redirect($redirect_to);
            } else {
                redirect(site_url('dashboard'));
            }
        }
        else{
            $this->session->set_flashdata('error','UserName/Password is incorrect');
            redirect(site_url('login'));
        }
    }
}