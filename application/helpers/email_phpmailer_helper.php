<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(!function_exists('email_send_php_mailer')){
    function email_send_php_mailer($subject,$email_message,$to_email,$attachment='') {
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    $mail->SMTPDebug = SMTP::DEBUG_OFF;               
		    $mail->isSMTP();                                      
		    $mail->Host       = SMTP_HOST;        
		    $mail->SMTPAuth   = true;                       
		    $mail->Username   = SMTP_FROM_EMAIL; 
		    $mail->Password   = SMTP_PASSWORD;    
		    $mail->SMTPSecure = 'tls';
		    $mail->Port       = SMTP_PORT;   
		    $mail->SMTPOptions = array(
		        'ssl' => array(
		            'verify_peer' => false,
		            'verify_peer_name' => false,
		            'allow_self_signed' => true
		        )
		    );
		    $mail->CharSet    = 'UTF-8'; 

		    //Recipients
		    $mail->setFrom(SMTP_FROM_EMAIL, 'Storm-storage');
		    $mail->addAddress($to_email);
		    if (!empty($attachment)) {
		    	foreach ($attachment as $key => $attachment_path) {
		    		$mail->addAttachment($attachment_path);
		    	}
		    }

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $email_message;
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    return TRUE;
		} catch (Exception $e) {
			return FALSE;
		    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}