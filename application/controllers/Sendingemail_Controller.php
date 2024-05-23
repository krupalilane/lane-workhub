<?php
class Sendingemail_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
    }
    public function index() {
        $this->load->helper('form');
        $this->load->view('email/contact_email_form');
    }
    public function send_mail() {
        $from_email = "email@example.com";
        $to_email = $this->input->post('email');
        //Load email library
        $this->load->library('email');
        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        //Send mail
        if($this->email->send())
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        else
            $this->session->set_flashdata("email_sent","You have encountered an error");
        $this->load->view('email/contact_email_form');
    }
}
?>