<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// --------------------------------------------------------------------
if(!function_exists('email_send')){
    function email_send($email_to,$email_subject,$msg,$attachment_path='',$bcc_send = false) {
        
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom(SENDGRID_FROM_EMAIL, SENDGRID_FROM_NAME);
        $email->setSubject($email_subject);
        $email->addTo($email_to);
        if($bcc_send == true){
            $email->addBcc("jay@onusms.com");
            $email->addBcc("support@onusms.com");
            $email->addBcc("bhavin.jagad@cloudester.com");
            $email->addBcc("sunil.shah@cloudester.com");
            $email->addBcc("pooja.karandikar@cloudester.com");
            $email->addBcc("richa.shah@cloudester.com");
        }
        
        $email->addContent(
            "text/html", $msg
        );
        if(!empty($attachment_path)){
            $attachment = new \SendGrid\Mail\Attachment();
            
            $handle = fopen($attachment_path, "r");
            $contents = fread($handle, filesize($attachment_path));
            fclose($handle);

            $file_encoded = base64_encode($contents);
            $path_info = pathinfo($attachment_path);
            $attachment->setContent($file_encoded);
            $attachment->setType("application/vnd.ms-excel");
            $attachment->setFilename($path_info['filename'].'.'.$path_info['extension']);
            $attachment->setDisposition("attachment");
            $attachment->setContentId($path_info['filename']);
            $email->addAttachment($attachment);
        }
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);                                
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        } 
    }
}