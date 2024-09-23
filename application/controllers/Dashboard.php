<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    protected $asides = array('header' => 'layouts/_header',
                            'footer' => 'layouts/_footer',
                            'js' => 'layouts/_js',
                        );
    protected $layout = 'layouts/master_layout';
    public function __construct() {
        parent::__construct();  
        $this->s_user = $this->session->userdata('user');
        if(empty($this->s_user)){
            redirect(site_url('login'));
        }
        $this->data['style_links']  = array('css/dashboard.css');
        $this->data['javascripts']  = array('dashboard.js');
        $this->data['active_menu']  = 'dashboard';
    }
    private $locations = [
        'Alachua, FL'      => ['latitude' => 29.7516, 'longitude' => -82.4248, 'timezone' => 'America/New_York'],
        'Ballston spa, NY'      => ['latitude' => 42.9916, 'longitude' => -73.7886, 'timezone' => 'America/New_York'],
        'Bath, NY'              => ['latitude' => 42.3351, 'longitude' => -77.3164, 'timezone' => 'America/New_York'],
        'Bealeton, VA'          => ['latitude' => 38.6128, 'longitude' => -77.7985, 'timezone' => 'America/New_York'],
        'Bedford, PA'           => ['latitude' => 40.0163, 'longitude' => -78.5037, 'timezone' => 'America/New_York'],
        '<i class="fa fa-building" aria-hidden="true"></i> Camp hill, PA'         => ['latitude' => 40.2398, 'longitude' => -76.9197, 'timezone' => 'America/New_York'],
        'Carlisle, PA'          => ['latitude' => 40.2010, 'longitude' => -77.1945, 'timezone' => 'America/New_York'],
        'Casa grande, AZ'       => ['latitude' => 32.8795, 'longitude' => -111.7574, 'timezone' => 'America/Phoenix'],
        'Dublin, VA'            => ['latitude' => 37.1074, 'longitude' => -80.6167, 'timezone' => 'America/New_York'],
        'Eugene, OR'            => ['latitude' => 44.0521, 'longitude' => -123.0868, 'timezone' => 'America/Los_Angeles'],
        'Fontana, CA'           => ['latitude' => 34.0928, 'longitude' => -117.4350, 'timezone' => 'America/Los_Angeles'],
        '<i class="fa fa-building" aria-hidden="true"></i> Irvine, CA'            => ['latitude' => 33.6695, 'longitude' => -117.8231, 'timezone' => 'America/Los_Angeles'],
        'King of prussia, PA'   => ['latitude' => 40.0894, 'longitude' => -75.3879, 'timezone' => 'America/New_York'],
        'Longview, WA'          => ['latitude' => 46.1382, 'longitude' => -122.9382, 'timezone' => 'America/Los_Angeles'],
        'Pulaski, PA'           => ['latitude' => 40.2738, 'longitude' => -80.3727, 'timezone' => 'America/New_York'],
        'Sacramento, CA'        => ['latitude' => 38.5758, 'longitude' => -121.4789, 'timezone' => 'America/Los_Angeles'],
        'Shippensburg, PA'      => ['latitude' => 40.0486, 'longitude' => -77.5231, 'timezone' => 'America/New_York'],
        'Statesville, NC'       => ['latitude' => 35.7821, 'longitude' => -80.8901, 'timezone' => 'America/New_York'],
        'Temple, TX'            => ['latitude' => 31.0982, 'longitude' => -97.3428, 'timezone' => 'America/Chicago'],
        'Wytheville, VA'        => ['latitude' => 36.9445, 'longitude' => -81.0863, 'timezone' => 'America/New_York']
    ];

    public function index()
    {
        $breadcrumb_data = array( 
            '0' => array(
                'url'   => '',
                'name'  => 'Dashboard'
            ) 
        );
        //start code for hoilday card
            $this->data['breadcrumb'] = $breadcrumb_data;
            $get_holiday_query  = 'EXEC USP_GetHolidayList @Year = ?;';
            $param = array(
                'Year'              => date("Y")
            );
            $hoilday_list       = $this->db->query($get_holiday_query,$param);
            $holiday_result     = $hoilday_list->result_array();
            $this->data['hoilday_list'] = $holiday_result;
            $hoilday_year_list               = $this->db->query("EXEC USP_GetHolidayYear");
            $this->data['hoilday_year_list'] = $hoilday_year_list->result_array();
        //end code for hoilday card
        //start code for get birthday data
            $stmt = sqlsrv_query($this->db->conn_id, 'EXEC USP_GetDataForDashboard');
            if (!$stmt) {
                return false;
            }

            $birthday_section = array();
            do {
                $resultSet = array();
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $resultSet[] = $row;
                }
                $birthday_section[] = $resultSet;
            } while (sqlsrv_next_result($stmt));
            sqlsrv_free_stmt($stmt);
            if (isset($birthday_section[1])) {
            	$all_birthday_data = $birthday_section[1];
            	$birthdayToday = array_filter($all_birthday_data, function($user) {
    	            return $user['IsBirthdayToday'] == 1;
    	        });

    	        $birthdayNotToday = array_filter($all_birthday_data, function($user) {
    	            return $user['IsBirthdayToday'] == 0;
    	        });
    	        $this->data['birthdayToday'] 	= array_values($birthdayToday);
    	        $this->data['birthdayNotToday'] = array_values($birthdayNotToday);
            }
            if (isset($birthday_section[2])) {
            	$all_work_data 		= $birthday_section[2];
            	$AnniversaryToday 	= array_filter($all_work_data, function($user) {
    	            return $user['IsAnniversaryToday'] == 1;
    	        });

    	        $AnniversaryNotToday = array_filter($all_work_data, function($user) {
    	            return $user['IsAnniversaryToday'] == 0;
    	        });
    	        $this->data['AnniversaryToday'] 	= array_values($AnniversaryToday);
    	        $this->data['AnniversaryNotToday'] 	= array_values($AnniversaryNotToday);
            }
            if (isset($birthday_section[0])) {
            	$all_annoucement 			= $birthday_section[0];
	        	$count_today_annoucement 	= array_filter($all_annoucement, function($user) {
		            return $user['AnnouncementForToday'] == 1;
		        });
    	        $this->data['count_today_annoucement'] 	= count($count_today_annoucement);
    	        $this->data['all_annoucement'] 			= array_values($all_annoucement);
            }
        //end code for get birthday data
        //start code for get project data
    		$get_project_data  = 'EXEC USP_GetSiteListByUserID @UserId = ?,@IsDashboardLogo = ?;';
    		$param = array(
                'UserId'      		=> $this->session->userdata('user')['id'],
                'IsDashboardLogo'   => 1
            );
            $project_data 			= $this->db->query($get_project_data,$param);
            $all_project_details   	= $project_data->result_array();
            $fav_projects 			= array_filter($all_project_details, function($user) {
                return $user['IsFavorite'] == 1;
            });
    		$this->data['fav_projects'] = $fav_projects;
        //end code for get project data
	    //start code for get website data
			$get_website_data  = 'EXEC USP_GetSiteListByUserID @UserId = ?,@IsDashboardLogo = ?;';
			$param = array(
	            'UserId'      		=> $this->session->userdata('user')['id'],
	            'IsDashboardLogo'   => 0
	        );
	        $website_data 			= $this->db->query($get_website_data,$param);
	        $all_website_details   	= $website_data->result_array();
	        $fav_websites 			= array_filter($all_website_details, function($user) {
	            return $user['IsFavorite'] == 1;
	        });
			$this->data['fav_websites'] = $fav_websites;
	    //end code for get website data
    }
    public function get_weather_data()
    {
        $weather_data = array();
        foreach ($this->locations as $location => $coords) {
            $latitude   = $coords['latitude'];
            $longitude  = $coords['longitude'];
            $timezone   = $coords['timezone'];
            $apiUrl     = "https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&current_weather=true";

            $weatherData    = file_get_contents($apiUrl);
            $weatherArray   = json_decode($weatherData, true);

            if (isset($weatherArray['current_weather'])) {
                $temperatureCelsius     = $weatherArray['current_weather']['temperature'];
                $temperatureFahrenheit  = ($temperatureCelsius * 9/5) + 32; 
                $temperatureFahrenheit  = round($temperatureFahrenheit, 1); // Round for readability

                $weather_code   = $weatherArray['current_weather']['weathercode'];
                $weather_image  = $this->get_weather_image($weather_code);

                // Get current local time in the specified timezone
                $current_time   = new DateTime('now', new DateTimeZone($timezone));
                $formatted_time = $current_time->format('h:i:s A');
                $weather_name = str_replace(".gif", "", $weather_image);
                $weather_name = str_replace("_", " ", $weather_name);
                $weather_data[$location] = [
                    'current_time'  => $formatted_time,
                    'temperature'   => $temperatureFahrenheit,
                    'weather_image' => $weather_image,
                    'weather_name'  => ucfirst($weather_name)
                ];
            } else {
                $weather_data[$location] = [
                    'current_time' => 'Unable to fetch time',
                    'temperature' => "Unable to fetch weather data.",
                    'weather_image' => 'default.png'
                ];
            }
        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($weather_data))
        ->_display();
        die;
    }
    public function get_all_holiday()
    {
        $get_holiday_query  = 'EXEC USP_GetHolidayList @Year = ?;';
        $param = array(
            'Year'              => $this->input->post('year')
        );
        $hoilday_list       = $this->db->query($get_holiday_query,$param);
        $holiday_result     = $hoilday_list->result_array();
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($holiday_result))
        ->_display();
        die;
    }

    private function get_weather_image($weather_code) {
        // Mapping of weather codes to image filenames
        $weather_images = [
            0 => 'clear_sky.gif',
            1 => 'mainly_clear.gif',
            2 => 'partly_cloudy.gif',
            3 => 'overcast.gif',
            45 => 'fog.gif',
            51 => 'drizzle.gif',
            53 => 'drizzle.gif',
            55 => 'drizzle.gif',
            61 => 'rain.gif',
            63 => 'rain.gif',
            65 => 'rain.gif',
            71 => 'snow.gif',
            73 => 'snow.gif',
            75 => 'snow.gif',
            80 => 'showers.gif',
            81 => 'showers.gif',
            82 => 'showers.gif',
            95 => 'thunderstorm.gif',
            99 => 'thunderstorm.gif'
        ];

        return $weather_images[$weather_code] ?? 'default.png';
    }    
}
