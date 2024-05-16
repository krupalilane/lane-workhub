<?php
class Cronjob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function check_quotes_status(){
        $quotes_query = $this->db->query('EXEC stormconfig.USP_GetQuoteProductList @Status = 1');
        $quotes_details = $quotes_query->result_array();
        if (!empty($quotes_details)) {
            $build_complete_quotes_id = array();
            foreach ($quotes_details as $key => $quotes_data) {
                $user_name      = KBMAX_USER_EMAIL;
                $password       = KBMAX_USER_PASSWORD;
                $headers        = array(
                    "Content-Type: application/json",
                    "Accept: */*",
                    'Authorization: Basic '. base64_encode("$user_name:$password")
                );
                $quote_kbmax_url = sprintf($this->config->item('quotes_details'),$quotes_data['kbmaxQuoteID']);
                //start code for get quotes in kbmax calling API
                    $quote_details_ch       = curl_init();
                    // Set the url, number of POST vars, POST data
                    curl_setopt($quote_details_ch, CURLOPT_URL, $quote_kbmax_url);

                    curl_setopt($quote_details_ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($quote_details_ch, CURLOPT_RETURNTRANSFER, true);

                    // Disabling SSL Certificate support temporarily
                    curl_setopt($quote_details_ch, CURLOPT_SSL_VERIFYPEER, false);

                    // Execute post
                    $quote_get_data = curl_exec($quote_details_ch);

                    if ($quote_get_data === false) {
                        echo 'cURL Error: ' . curl_error($quote_details_ch);
                    } else {
                        // Successful response, decode JSON
                        $quote_get_data = json_decode($quote_get_data);
                        // Handle the decoded result here
                    }
                    // Close connection
                    curl_close($quote_details_ch);

                    if (!empty($quote_get_data)) {
                        if (isset($quote_get_data->state)) {
                            if ($quote_get_data->state == 'Builds Complete') {
                                array_push($build_complete_quotes_id,$quotes_data['QuoteId']);
                            }
                        }
                    }
                //end code for get quotes in kbmax calling API
            }
            if (!empty($build_complete_quotes_id)) {
                $update_quotes_db = "EXEC stormconfig.UpdateQuoteStatus @QuoteIDs = ?";
                $param = implode(",", $build_complete_quotes_id);
                    $quotes_submit_query = $this->db->query($update_quotes_db,$param);
                    $result = $quotes_submit_query->result_array();
            }
        }
    } 
}