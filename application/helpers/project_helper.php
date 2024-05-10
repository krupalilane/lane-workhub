<?php
if (!function_exists('get_project_data')) {
    function get_project_data() {
        // Data to be sent in the POST request
        $CI =& get_instance();
        $post_data = array(
           "skip" => 0, 
           "take" => 22, 
           "fields" => [
                 "id", 
                 "name", 
                 "shortDescription", 
                 "sku", 
                 "mfgPartNumber", 
                 "manufacturer", 
                 "unitOfMeasure", 
                 "price", 
                 "maxQty", 
                 "minQty", 
                 "allowFractionalQty", 
                 "score", 
                 "createdDate", 
                 "isConfigured", 
                 "images.id", 
                 "images.imagePath", 
                 "images.imageOrder" 
              ], 
           "sortField" => "score", 
           "descending" => true, 
           "filters" => [
                 ], 
           "nestedPath" => null, 
           "nestedFields" => [
                    ], 
           "categoryIds" => [] 
        ); 

        $headers = array(
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $CI->config->item('product_list'));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        // Execute post
        $result = curl_exec($ch);

        if ($result === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            // Successful response, decode JSON
            $result = json_decode($result);
            // Handle the decoded result here
        }
        // Close connection
        curl_close($ch);
        return $result;
    }
}
