<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Export extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load database library
        $this->business_plan_db = $this->load->database('business_plan_db', TRUE);
        $this->s_user = $this->session->userdata('user');
        if(empty($this->s_user)){
            redirect(site_url('login'));
        }
    }

    public function exportExcel()
    {
        $year = $this->input->post('year');
        $stmt = sqlsrv_query($this->business_plan_db->conn_id, 'EXEC USP_GetBusinessPlanDataForExcelExport @Year = '.$year);
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
        $spreadsheet = new Spreadsheet();

        if (!empty($division_data)) {
            if (isset($division_data[0])) {
                $sheet_data = array_column($division_data[0], 'Division');
            }
        
            if (!empty($sheet_data)) {
                $all_division_details_array = array();
                foreach ($division_data as $plant_key => $plant_values) {
                    if ($plant_key > 0) {
                        $plant_details_array = array();
                        $year_array     = array_values(array_unique(array_column($plant_values, 'Year')));
                        $quater         = array('Q1','Q2','Q3','Q4');
                        $ap_array       = array('Actual','Planned');
                        foreach ($plant_values as $pkey => $plant_data) {
                            $plant_details_cat = array();
                            for ($i=0; $i < count($year_array); $i++) { 
                                for ($j=0; $j < count($quater); $j++) { 
                                    for ($p=0; $p < count($ap_array); $p++) { 
                                        $criteria = [
                                            "Category"          => $plant_data['Category'],
                                            "SubCategory"       => $plant_data['SubCategory'],
                                            "Year"              => $year_array[$i],
                                            "Quarter"           => $quater[$j],
                                            "Planned_Actual"    => $ap_array[$p]
                                        ];
                                        $key_plant_data = $this->plan_data_filter($plant_values,$criteria);
                                        $plant_details_cat[] = $plant_values[$key_plant_data]['Value'];
                                    }
                                }
                            }
                            $plant_details_array[trim($plant_data['Category'])][$plant_data['SubCategory']] = $plant_details_cat;
                        }
                        $all_division_details_array[$plant_key] = $plant_details_array;
                    }
                }
                foreach ($sheet_data as $key => $sheet_name) {
                    // Create a new sheet for each division
                    if ($key > 0) {
                        $spreadsheet->createSheet();
                    }
                    $spreadsheet->setActiveSheetIndex($key);
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setTitle($sheet_name);

                    $sheet_details = $division_data[$key + 1];
                    $year_array = array_values(array_unique(array_column($sheet_details, 'Year')));
                    
                    // Populate the first row with years, merging columns for each year
                    $row = 1;
                    $col = 'B';
                    foreach ($year_array as $year) {
                        $sheet->setCellValue($col . $row, $year);
                        $merge_end_col = chr(ord($col) + 7); // Merge 8 columns (4 quarters with actual and planned)
                        $sheet->mergeCells($col . $row . ':' . $merge_end_col . $row);
                        $col = chr(ord($col) + 8); // Move to the next set of 8 columns
                    }

                    // Populate the second row with quarters, merging columns for each quarter
                    $row = 2;
                    $col = 'B';
                    foreach ($year_array as $year) {
                        for ($q = 1; $q <= 4; $q++) {
                            $sheet->setCellValue($col . $row, "Q$q");
                            $merge_end_col = chr(ord($col) + 1); // Merge 2 columns (Actual and Planned)
                            $sheet->mergeCells($col . $row . ':' . $merge_end_col . $row);
                            $col = chr(ord($col) + 2); // Move to the next set of 2 columns
                        }
                    }

                    // Populate the third row with 'Actual' and 'Planned' for each quarter
                    $row = 3;
                    $col = 'B';
                    foreach ($year_array as $year) {
                        for ($q = 1; $q <= 4; $q++) {
                            $sheet->setCellValue($col . $row, "Actual");
                            $col++;
                            $sheet->setCellValue($col . $row, "Planned");
                            $col++;
                        }
                    }
                    $data_keys = array_keys($all_division_details_array[$key + 1]);

                    // Define a style array for the red highlight
                    $redStyle = [
                        'font' => [
                            'color' => ['rgb' => 'b52024'],
                        ],
                    ];

                    // Populate dynamic data sections
                    $row = 4;
                    foreach ($data_keys as $section) {
                        $sub_keys = array_keys($all_division_details_array[$key + 1][$section]);
                        $has_same_name = in_array($section, $sub_keys); // Check if the section name matches any subcategory name

                        if (!$has_same_name) {
                            // Print the section name only if no subcategory has the same name
                            $sheet->setCellValue('A' . $row, $section);
                            $sheet->getStyle('A' . $row)->applyFromArray($redStyle); // Apply the red style
                            $row++;
                        }

                        foreach ($sub_keys as $sub_key) {
                            // Print the subcategory name
                            $sheet->setCellValue('A' . $row, $sub_key);
                            if ($section == $sub_key) {
                                // Apply red style if the subcategory name is the same as the category name
                                $sheet->getStyle('A' . $row)->applyFromArray($redStyle);
                            }
                            $col = 'B';
                            $data = $all_division_details_array[$key + 1][$section][$sub_key];
                            foreach ($data as $index => $value) {
                                $sheet->setCellValue($col . $row, $value);
                                $col++;
                            }
                            $row++;
                        }
                    }

                    // Apply center alignment to all cells
                    $highestColumn = $sheet->getHighestColumn();
                    $highestRow = $sheet->getHighestRow();
                    $sheet->getStyle('B1:' . $highestColumn . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('B1:' . $highestColumn . $highestRow)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                }
            }
        }

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $file_name = $year." Business Plan.xlsx";
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
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
