<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('convert_to_csv')) {

    function convert_to_csv($input_array, $output_file_name, $delimiter) {
        
        $tempPDFFilePath = FCPATH.'assets/csv';
        if(!is_dir($tempPDFFilePath)){
            mkdir($tempPDFFilePath);
        }

        
        $csvFile = $tempPDFFilePath."/".$output_file_name;
        //@unlink($pdfFile);
        $fp = fopen($csvFile, 'w');
        foreach ($input_array as $line) {
            fputcsv($fp, $line);
        }
        fclose($fp);    
        
    }

}