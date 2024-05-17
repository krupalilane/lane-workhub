<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends MY_Controller{

    protected $layout = 'layouts/login_layout';
    
    public function __construct() {
        parent::__construct();
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
}