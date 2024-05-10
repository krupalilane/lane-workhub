<?php
class Notification{
	private $title;
	private $message;
	private $image_url;
	private $action;
	private $action_destination;
	private $data;
	private static $CI;

	function __construct(){
		if (empty(self::$CI))
			self::$CI = &get_instance();
	}
 
	public function setTitle($title){
		$this->title = $title;
	}
 
	public function setMessage($message){
		$this->message = $message;
	}
 
	public function setImage($imageUrl){
		$this->image_url = $imageUrl;
	}

	public function setAction($action){
		$this->action = $action;
	}
 
	public function setActionDestination($actionDestination){
		$this->action_destination = $actionDestination;
	}
 
	public function setPayload($data){
		$this->data = $data;
	}
	
	public function getNotification(){
		$notification = array();
		$notification['title'] = $this->title;
		$notification['message'] = $this->message;
		// $notification['image'] = $this->image_url;
		// $notification['action'] = $this->action;
		// $notification['action_destination'] = $this->action_destination;
		return $notification;
	}

	public function setNotificationParams($title,$message){
		$this->setTitle($title);
		$this->setMessage($message);
		$requestData = $this->getNotification();
		return $requestData;
	}

	public function sendNotification($firebase_token,$requestData,$os){
		$firebase_api = FIREBASE_SERVER_KEY;
			
		if($os == 1){
			$firebase_api = FIREBASE_IOS_SERVER_KEY;
			$requestData['text'] = $requestData['message']; 
			$requestData['sound'] = 'default'; 
			$requestData['badge'] = '1'; 
			
			$extra_data = array();
			$extra_data['timestamp'] = time();

			$fields = array(
				'to' => $firebase_token,
				'notification' => $requestData,
				'data' => $extra_data 
			);
		}
		else{
			$device_details = self::$CI->db->get_where('notification', array('verification_code' => $firebase_token))->row();
			$requestData['notification_id'] = $device_details->id; 
			
			$fields = array(
				'to' => $firebase_token,
				'data' => $requestData,
			);
		}
		
		// Set POST variables
		$url = 'https://fcm.googleapis.com/fcm/send';

		$headers = array(
			'Authorization: key=' . $firebase_api,
			'Content-Type: application/json'
		);
		
		// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Disabling SSL Certificate support temporarily
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		// Execute post
		$result = curl_exec($ch);
		
		if($result === FALSE){
			log_message('error','Push Notification Curl failed: ' .json_encode($ch));
		}

		// Close connection
		curl_close($ch);
		
		log_message('error','Push Notification Request: ' .json_encode($fields,JSON_PRETTY_PRINT));
		log_message('error','Push Notification Response: ' .json_encode($result));
	}
}
?>