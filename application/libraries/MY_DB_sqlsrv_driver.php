<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_DB_sqlsrv_driver extends CI_DB_sqlsrv_driver {}

class CI_DB_sqlsrv_result extends CI_DB_result {

    public function _next_result()
    {
        sqlsrv_next_result($this->result_id);
        sqlsrv_fetch($this->result_id);
    }
}
