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
        $from_email = "storm-storage@lane-enterprises.com";
        $to_email = $this->input->post('email');
        //Load email library
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.office365.com';
        $config['smtp_port'] = 587; // or the appropriate port
        $config['smtp_user'] = 'storm-storage@lane-enterprises.com';
        $config['smtp_pass'] = 'CHW!nter2024!';
        $config['smtp_crypto'] = 'tls'; // or 'ssl' if required
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $config['smtp_timeout'] = 30;
        $config['newline'] = "\r\n";

        $this->email->initialize($config);

        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        if ($this->email->send()) {
            echo 'Email successfully sent';
        } else {
            echo $this->email->print_debugger();
        }
        exit;
        //Send mail
        if($this->email->send())
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        else
            $this->session->set_flashdata("email_sent","You have encountered an error");
        $this->load->view('email/contact_email_form');
    }
}
?>