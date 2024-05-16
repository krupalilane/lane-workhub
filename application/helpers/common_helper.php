<?php
if (!function_exists('timezone_strtosecond')) {

    function timezone_strtosecond($timezone) {
        list($hour, $minute) = explode(':', $timezone);
        $sign = $hour < 0 ? -1 : 1;
        $seconds = abs($hour) * 3600 + $minute * 60;
        return $seconds * $sign;
    }

}
if (!function_exists('date_timezone')) {

    function date_timezone($offset_seconds) {
        $timezoneName = timezone_name_from_abbr("", $offset_seconds, false);
        return new DateTime("now", new DateTimeZone($timezoneName));
    }

}

if( !function_exists('set_timezone')){
    function set_timezone(){
        $CI =& get_instance();
        $s_user = $CI->session->userdata('user');
        if(!empty($s_user)) {
            $store_id = $s_user['store_id'];

            $store_details = $CI->db->get_where('stores',array('id' => $store_id))->row();
            if(!empty($store_details)) {
                date_default_timezone_set($store_details->store_timezone);
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('utc_timezone')) {

    function utc_timezone($date) {
        $given = new DateTime($date);
        $given->setTimezone(new DateTimeZone("UTC"));
        $output = $given->format("Y-m-d H:i:s"); 
        return $output;
    }

}
if (!function_exists('change_timezone')) {

    function change_timezone($date,$timezone) {
        date_default_timezone_set('UTC');
/*$utc_date = DateTime::createFromFormat(
            'Y-m-d G:i', 
            $date, 
            new DateTimeZone('UTC')
        );*/
        $utc_date = new DateTime($date);

        $nyc_date = $utc_date;
         $nyc_date ->setTimeZone(new DateTimeZone($timezone));

        return $nyc_date->format('m-d-Y h:i A');
    }
}

if (!function_exists('change_timezone_new')) {

    function change_timezone_new($date,$timezone) {
        date_default_timezone_set('UTC');
/*$utc_date = DateTime::createFromFormat(
            'Y-m-d G:i', 
            $date, 
            new DateTimeZone('UTC')
        );*/
        $utc_date = new DateTime($date);

        $nyc_date = $utc_date;
         $nyc_date ->setTimeZone(new DateTimeZone($timezone));

        return $nyc_date->format('Y-m-d h:i A');
    }
}

if (!function_exists('encryptor')) {
    function encryptor($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '2yRnd1jY1Moh1PV';
        $secret_iv = 'x6RuFZtXdcWDqjVAAMOu';

        $key = hash('sha256', $secret_key);

        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

function pr($data){
    echo '<PRE>';
    print_r($data);
    echo '</PRE>';
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 24)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('asset_url')){
    function asset_url(){
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        //return the full asset path
        return base_url() . 'assets/';
    }
}
if (!function_exists('icon_url')){
    function icon_url(){
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();
        //return the full asset path
        return base_url() . 'assets/icons/';
    }
}

if (!function_exists('js_url')){
    function js_url(){
        $CI =& get_instance();
        return base_url() . 'assets/js/';
    }
}

if (!function_exists('js')){
    function js($file, $atts = array()){
        $element = '<script type="text/javascript" src="' . js_url() . $file . '"';

		foreach ( $atts as $key => $val )
			$element .= ' ' . $key . '="' . $val . '"';
		$element .= '></script>'."\n";

		return $element;
    }
}

if (!function_exists('js_link')){
    function js_link($file, $atts = array()){
        $element = '<script type="text/javascript" src="' . asset_url() . $file . '"';

        foreach ( $atts as $key => $val )
            $element .= ' ' . $key . '="' . $val . '"';
        $element .= '></script>'."\n";

        return $element;
    }
}

if (!function_exists('style_link')){
    function style_link($file, $atts = array()){
        $element = ' <link rel="stylesheet" type="text/css" href="' . asset_url() . $file . '"';

        foreach ( $atts as $key => $val )
            $element .= ' ' . $key . '="' . $val . '"';
        $element .= '></link>'."\n";

        return $element;
    }
}

if(!function_exists('adddashes')){
    function adddashes($data){
        $result=preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3",$data);
        return $result;
    }
}

if (!function_exists('decimal_value')) {
    function decimal_value($numb) {
        return number_format(round($numb,2),2, '.', '');
    }
}

if (!function_exists('getValueByIndex')) {
    function getValueByIndex($index,$array) {
       return array_search ($index, $array);
    }
}

if (!function_exists('_group_by')) {
    function _group_by($array, $key) {
        $return = array();
        foreach($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }
}

if (!function_exists('convertdate')) {
function convertdate($string) {
    $string = substr($string, 0, strrpos($string, '(') - 1);
    $dt = new DateTime($string);
    return $dt->format('Y-m-d');
  }
}
