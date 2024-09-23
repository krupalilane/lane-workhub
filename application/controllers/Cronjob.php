<?php
class Cronjob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->ppq_form_db = $this->load->database('ppq_form_db', TRUE);
    }

    function send_email_based_complain(){
        $complain_data      = $this->ppq_form_db->query('EXEC USP_GetQAComplaintDataForCronJob');
        $complain_details   = $complain_data->result_array();
        if (!empty($complain_details)) {
            //start code for send email for complain
               $jelliott_to_email          = 'pj@lane-enterprises.com';
               $lkim_to_email              = 'kpatel@lane-enterprises.com';
               // $markd_to_email             = 'lkim@lane-enterprises.com';
               $subject                    = 'Complaint Details';
               $complain_info['complain_data'] = $complain_details;
               $user_email_message         = $this->load->view('email/cron_job_complaint_email', $complain_info, TRUE);
               $jelliott_email_send        =  email_send_php_mailer($subject,$user_email_message,$jelliott_to_email,'');
               $lkim_email_send            =  email_send_php_mailer($subject,$user_email_message,$lkim_to_email,'');
               // $markd_email_send           =  email_send_php_mailer($subject,$user_email_message,$markd_to_email,'');
            //end code for send email for complain
        }
    } 
}