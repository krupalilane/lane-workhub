<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;
ini_set('memory_limit', '512M');
class PdfController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any necessary models, libraries, etc.
        $this->business_plan_db = $this->load->database('business_plan_db', TRUE);
        $this->s_user = $this->session->userdata('user');
        if(empty($this->s_user)){
            redirect(site_url('login'));
        }
    }

    public function generate_pdf() {
        // Instantiate DOMPDF with options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Enable if loading external images
        $dompdf = new Dompdf($options);
            $stmt = sqlsrv_query($this->business_plan_db->conn_id, 'EXEC USP_GetBusinessPlanDataForExcelExport @Year = 2024');
            if (!$stmt) {
                return false;
            }

            $division_data = array();
            do {
                $resultSet = array();
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $resultSet[] = $row;
                }
                $division_data[] = $resultSet;
            } while (sqlsrv_next_result($stmt));
            sqlsrv_free_stmt($stmt);
            $quater             = array('Q1','Q2','Q3','Q4');
            $ap_array           = array('Actual','Planned');
            if (!empty($division_data)) {
                if (isset($division_data[0])) {
                    $sheet_data = array_column($division_data[0], 'Division');
                }
                if (!empty($sheet_data)) {
                    $all_division_details_array = array();
                    foreach ($division_data as $plant_key => $plant_value) {
                        if ($plant_key > 0) {
                            $plant_details_array = array();
                            $year_array  = array_values(array_unique(array_column($plant_value, 'Year')));
                            foreach ($plant_value as $key => $plant_values) {
                                $plant_details_cat = array();
                                for ($i=0; $i < count($year_array); $i++) { 
                                    for ($j=0; $j < count($quater); $j++) { 
                                        for ($p=0; $p < count($ap_array); $p++) {
                                            $criteria = [
                                                "Category"          => $plant_values['Category'],
                                                "SubCategory"       => $plant_values['SubCategory'],
                                                "Year"              => $year_array[$i],
                                                "Quarter"           => $quater[$j],
                                                "Planned_Actual"    => $ap_array[$p]
                                            ];
                                            $key_plant_data = $this->plan_data_filter($plant_value,$criteria);
                                            $plant_details_cat[]           = !empty($plant_value[$key_plant_data]['Value']) ? $plant_value[$key_plant_data]['Value'] : '0';
                                        }
                                    }
                                }
                                $plant_details_array[trim($plant_values['Category'])][$plant_values['SubCategory']] = $plant_details_cat;
                            }
                            $all_division_details_array[$sheet_data[$plant_key - 1]] = $plant_details_array;
                        }
                    }
                }
            }
            $data['all_division_details_array'] = $all_division_details_array;
            $data['quater']                     = $quater;
            $data['ap_array']                   = $ap_array;
            $data['year_array']                 = $year_array;
        // Load your HTML content (from a view or string)
        $html = $this->load->view('plants/pdf_template', $data, true);

        // Set paper size and orientation to landscape
        $dompdf->setPaper('A4', 'landscape');

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (to download)
        $dompdf->stream("document.pdf", array("Attachment" => 1));
        echo "string";
        exit;
    }
    public function plan_data_filter($result,$criteria)
    {
        $filtered = array_filter($result, function($item) use ($criteria) {
            return $item['Year'] == $criteria['Year'] && 
                   $item['Quarter'] == $criteria['Quarter'] &&
                   $item['Planned_Actual'] == $criteria['Planned_Actual'] &&
                   $item['Category'] == $criteria['Category'] &&
                   $item['SubCategory'] == $criteria['SubCategory'];
        });

        $key = array_search(reset($filtered), $result);
        return $key;
    }
}

