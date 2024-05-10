<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('verify_signature')) {
	function verify_signature($parameters, $secret) {
		if (!isset($parameters['signature']) || empty($parameters['signature'])) {
			return false;
		}
		$signature = $parameters['signature'];
		unset($parameters['signature']);
		ksort($parameters);
		$hash_load = http_build_query($parameters);

		$calculated_hash = hash_hmac("sha256", $hash_load, $secret);
		//echo $calculated_hash;die;
		return strcmp($calculated_hash, $signature) == 0;
	}
}

if (!function_exists('get_verify_signature')) {
	function get_verify_signature($parameters, $secret) {

		ksort($parameters);
		$hash_load = http_build_query($parameters);

		$calculated_hash = hash_hmac("sha256", $hash_load, $secret);

		return array('hash_load' => $hash_load, 'signature' => $calculated_hash);
	}
}

if (!function_exists('get_signature')) {
function get_signature($fields,$secret=BSP_SECRET,$glue='&'){
        ksort($fields);
        $build_string = $secret;
        foreach($fields as $key=>$value) {
            $build_string .= $key.'='.$value.$glue;
        }
		$build_string = rtrim($build_string,'&');
        $signature = md5($build_string);
        return $signature;
    }
}
if (!function_exists('distance')) {
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}
}