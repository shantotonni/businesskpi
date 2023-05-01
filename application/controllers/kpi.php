<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kpi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_m');
        $this->load->model('kpi_m');
        $this->load->model('Processkpi_m');
    }
    
    public function index() {
        $data = array();
        $data['page'] = 'kpi_all';
        $data['page_title'] = 'All Kpi Information';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        // $data['rows'] = $this->kpi_m->select_kpi_info($data['userid']);
        //echo '<pre/>';print_r($data['rows']); exit();
        $data['main_content'] = $this->load->view('kpi/all', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function add() {
        $data = array();
        $data['page'] = 'kpi_add';
        $data['page_title'] = 'Add New Kpi';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        
        //$data['business_rows'] = $this->Common_m->select_business($data['userid']);
        //$data['kpi_segments_rows'] = $this->Common_m->select_kpi_segments($data['userid']);
        //$data['kpi_segments_rows'] = $this->Common_m->select_kpi_segments();
        
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        
        $data['main_content'] = $this->load->view('kpi/add', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    public function submit() {
        //echo '<pre/>';print_r($_POST);exit();
        if ($this->input->post()) {
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            $date_time = $dt->format('Y-m-d H:i:s');            
            
            $ValueDriverName = $this->input->post('ValueDriverName', TRUE);
            $STATUS = $this->input->post('STATUS', TRUE);
            $ReportStatus = $this->input->post('ReportStatus', TRUE);

                        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ValueDriverName', 'Value Driver Name', 'required');
            $this->form_validation->set_rules('STATUS', 'STATUS', 'required');
            //$this->form_validation->set_rules('KPIMetricsName', 'KPI Metrics Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['errors'] = validation_errors();
                $str = $data['errors'];
                $msg['message'] = "<div class=\"alert alert-danger fade in\">
                  		<strong>" . $data['errors'] . "</strong></div>";
                $this->session->set_userdata($msg);
                redirect(base_url('kpi/add'));
            } else {
                $ValueCode = 'V';
                $ValueDriverCode = get_ValueDriverCode($ValueCode);
            
                $data = array(
                    "ValueDriverCode" => $ValueDriverCode,
                    "ValueDriverName" => $ValueDriverName,
                    "STATUS" => $STATUS,
                    "ReportStatus" => $ReportStatus                    
                );
                $RowId_q = $this->kpi_m->insert($data,'GroupKPIValueDriver');
                                
                $KPIMetricsName = mssql_escape($this->input->post('KPIMetricsName',TRUE));
                $CCalculation = mssql_escape($this->input->post('CCalculation',TRUE));
                $DCalculation = mssql_escape($this->input->post('DCalculation',TRUE));
                $IndexValueCalculation = $this->input->post('IndexValueCalculation',TRUE);
                $limit = count($KPIMetricsName);

                for ($i = 0; $i < $limit; $i++) {
                    $MetricsCode = 'M';
                    $KPIMetricsCode = get_KPIMetricsCode($MetricsCode);
                    empty($CCalculation[$i]) ? $CCalculation[$i] = '' : $CCalculation[$i];
                    $data2 = array(
                        'ValueDriverCode' => $ValueDriverCode,
                        'KPIMetricsCode' => $KPIMetricsCode,
                        'KPIMetricsName' => $KPIMetricsName[$i],
                        'CCalculation' => $CCalculation[$i],
                        'DCalculation' => $DCalculation[$i],
                        'IndexValueCalculation' => $IndexValueCalculation[$i]
                    );
                    $id = $this->kpi_m->insert($data2, "GroupKPIMetrics");
					
					$this->kpi_m->doUpdateCalculationKPIOutput ($KPIMetricsCode);
                }
                if ($id) {
                    $msg['message'] = "KPI Successfully Added.";
                } else {
                    $msg['message'] = "KPI Add Unsuccessfully.";
                }
                $this->session->set_userdata($msg);
                redirect(base_url('kpi'));
            }
        }
    }

    public function update($ValueDriverCode) {
        $data = array();
        $data['page'] = 'kpi_add';
        $data['page_title'] = 'Update Kpi';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['ValueDriverCode'] = $ValueDriverCode;

        $data['rows'] = $this->kpi_m->selectKpiDetails($data['ValueDriverCode']);
        //echo '<pre/>';print_r($data['rows']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/edit', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function update_submit() {
        //echo '<pre/>';print_r($_POST);//exit();
        if ($this->input->post()) {
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            $date_time = $dt->format('Y-m-d H:i:s');
            
            $ValueDriverCode = $this->input->post('ValueDriverCode', TRUE);
            $ValueDriverName = $this->input->post('ValueDriverName', TRUE);
            $STATUS = $this->input->post('STATUS', TRUE);
            $ReportStatus = $this->input->post('ReportStatus', TRUE);

            $this->load->library('form_validation');
            $this->form_validation->set_rules('ValueDriverName', 'Value Driver Name', 'required');
            $this->form_validation->set_rules('ValueDriverCode', 'Value Driver Code', 'required');
            $this->form_validation->set_rules('STATUS', 'STATUS', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['errors'] = validation_errors();
                $str = $data['errors'];
                $msg['message'] = "<div class=\"alert alert-danger fade in\">
                  		<strong>" . $data['errors'] . "</strong></div>";
                $this->session->set_userdata($msg);
                redirect(base_url('kpi/update/' . $ValueDriverCode));
            } else {
                $data = array(
                    "ValueDriverName" => $ValueDriverName,
                    "STATUS" => $STATUS,
                    "ReportStatus" => $ReportStatus                    
                );
				//print_r($data);exit();
                $tracking = $this->kpi_m->duplicate_checking($ValueDriverCode, 'ValueDriverCode', 'GroupKPIValueDriver');
//                echo count($tracking);exit();
                if (count($tracking) == 1) {
                    $GroupKPIValueDriver = $this->kpi_m->edit_option_GroupKPIValueDriver($data, $ValueDriverCode, 'ValueDriverCode', 'GroupKPIValueDriver');
                    
                    //echo count($GroupKPIValueDriver);exit();
      
                    if ($GroupKPIValueDriver) {                        
                        $KPIMetricsCode = mssql_escape($this->input->post('KPIMetricsCode', TRUE));
                        $KPIMetricsName = mssql_escape($this->input->post('KPIMetricsName',TRUE));
                        $CCalculation = mssql_escape($this->input->post('CCalculation',TRUE));
                        $DCalculation = mssql_escape($this->input->post('DCalculation',TRUE));
                        $IndexValueCalculation = $this->input->post('IndexValueCalculation',TRUE);
                        $limit = count($KPIMetricsName);
                        for ($i = 0; $i < $limit; $i++) {
                            if(empty($KPIMetricsCode[$i])){
                                $MetricsCode = 'M';
                                $KPIMetricsCode = get_KPIMetricsCode($MetricsCode);
                                $data2 = array(
                                    'ValueDriverCode' => $ValueDriverCode,
                                    'KPIMetricsCode' => $KPIMetricsCode,
                                    'KPIMetricsName' => $KPIMetricsName[$i],
                                    'CCalculation' => $CCalculation[$i],
                                    'DCalculation' => $DCalculation[$i],
                                    'IndexValueCalculation' => $IndexValueCalculation[$i]
                                );
                                $id = $this->kpi_m->insert($data2, "GroupKPIMetrics");
								$this->kpi_m->doUpdateCalculationKPIOutput ($KPIMetricsCode);
                            }else{
                               //$KPIMetricsCode = $KPIMetricsCode[$i];
                                $data2 = array(
                                    'KPIMetricsCode' => $KPIMetricsCode[$i],
                                    'KPIMetricsName' => $KPIMetricsName[$i],
                                    'CCalculation' => $CCalculation[$i],
                                    'DCalculation' => $DCalculation[$i],
                                    'IndexValueCalculation' => $IndexValueCalculation[$i]
                                );
                                $id = $this->kpi_m->edit_option_GroupKPIMetrics($data2, $ValueDriverCode, 'ValueDriverCode', 'GroupKPIMetrics');
                                $this->kpi_m->doUpdateCalculationKPIOutput ($KPIMetricsCode[$i]);
                            }
							
							
                        }
                        //exit();
                        $msg['message'] = "KPI Successfully Updated.";
                    } else {
                        $msg['message'] = "KPI Update Unsuccessfully.";
                    }
                    $this->session->set_userdata($msg);
                    redirect(base_url('kpi/update/'.$ValueDriverCode));
                }
            }
        }
    }

    public function delete($ValueDriverCode, $kpiCode) {
//        //echo $ValueDriverCode;exit();
//        echo '<pre/>';print_r($ValueDriverCode);exit();
//        $Question = $this->Common_m->delet_option($ValueDriverCode, 'ValueDriverCode', 'Question');
//        if ($Question) {
//            $Question = $this->Common_m->delet_option($ValueDriverCode, 'ValueDriverCode', 'QuestionOption');
//            $msg['message'] = "Question Successfully Deleted.";
//        } else {
//            $msg['message'] = "Question Delete Unsuccessfully.";
//        }

        $delete = $this->kpi_m->delet_option($ValueDriverCode, $kpiCode);

        if ($delete == true) {
            $msg['message'] = "Successfully Deleted.";
        } else {
            $msg['message'] = "Delete Unsuccessfully.";
        }

        $this->session->set_userdata($msg);
        redirect(base_url('kpi/kpiconfigList'),'refresh');
    }
	
    public function getValueDriverCode(){
            $ValueDriverCode = $this->input->post('ValueDriverCode', TRUE);
            $data['rows'] = $this->kpi_m->selectGroupKPIMetrics($ValueDriverCode);
            //print_r($data['rows'] );exit();
            $this->load->view('kpi/get_GroupKPIMetrics', $data);
    }

	public function getCPERIOD(){
		//echo '<pre/>';print_r($_POST);
		$ValueDriverCode = $this->input->post('ValueDriverCode', TRUE);
		$KPIMetricsCode = $this->input->post('KPIMetricsCode', TRUE);
		$Business = $this->input->post('Business', TRUE);
		$CYEAR = $this->input->post('CYEAR', TRUE);
		$CPERIOD = $this->input->post('CPERIOD', TRUE);
		$CPERIOD = $CYEAR.$CPERIOD;
		$data['rows'] = $this->kpi_m->select_CPERIOD($ValueDriverCode,$KPIMetricsCode,$Business,$CYEAR,$CPERIOD);
		echo json_encode($data['rows']);
		//print_r($data['rows'] );		exit();
		//$this->load->view('kpi/get_CPERIOD', $data);
    }

	public function getKPIMetricsCode(){
		//echo '<pre/>';print_r($_POST);
		$KPIMetricsCode = $this->input->post('KPIMetricsCode', TRUE);
		$data['rows'] = $this->kpi_m->selectKPIMetricsCode($KPIMetricsCode);
		//echo json_encode($data['rows']);
		$this->load->view('kpi/get_KPIMetricsCode', $data);
    }
        
	public function get_title(){
             $Title = $_GET['q'];
        $Title = $this->Common_m->select_title_issue_like($Title);
        //echo '<pre/>';print_r($Product);exit();
        //echo count($employer);
        if (!empty($Title)) {
            foreach ($Title as $row) {
                echo $row['KpiTitleName'] ; //0
                echo "\n";
            }
        }
    }
    
    public function details_add() {
        $data = array();
        $data['page'] = 'kpi_add';
        $data['page_title'] = 'Add New Kpi';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        
        $data['ValueDriverCode_rows'] = $this->kpi_m->select_ValueDriverCode($data['userid']);
        $data['Business_rows'] = $this->kpi_m->select_Business($data['userid']);
        //$data['kpi_segments_rows'] = $this->Common_m->select_kpi_segments($data['userid']);
        //$data['kpi_segments_rows'] = $this->Common_m->select_kpi_segments();
        
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        
        $data['main_content'] = $this->load->view('kpi/details_add', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    public function details_submit() {
        //echo '<pre/>';print_r($_POST);exit();
        if ($this->input->post()) {
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            $date_time = $dt->format('Y-m-d H:i:s');            
            
            $ValueDriverCode = $this->input->post('ValueDriverCode', TRUE);
            $KPIMetricsCode = $this->input->post('KPIMetricsCode', TRUE);
            $Business = $this->input->post('Business', TRUE);
            
            $CYEAR = $this->input->post('CYEAR', TRUE);
            $CPERIOD_b = $this->input->post('CPERIOD', TRUE);
            $CPERIOD = $CYEAR.$CPERIOD_b;
            $A = $this->input->post('A', TRUE);
            $ATXT = $this->input->post('ATXT', TRUE);
            $B = $this->input->post('B', TRUE);
            $BTXT = $this->input->post('BTXT', TRUE);
            $C = $this->input->post('C', TRUE);
            $CTXT = $this->input->post('CTXT', TRUE);
            $D = $this->input->post('D', TRUE);
            $DTXT = $this->input->post('DTXT', TRUE);            
            $IndexValue = $this->input->post('IndexValue', TRUE); 

                        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ValueDriverCode', 'Value Driver Name', 'required');
            $this->form_validation->set_rules('KPIMetricsCode', 'KPI Metrics Name', 'required');
            $this->form_validation->set_rules('Business', 'Business', 'required');
            $this->form_validation->set_rules('IndexValue', 'IndexValue', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['errors'] = validation_errors();
                $str = $data['errors'];
                $msg['message'] = "<div class=\"alert alert-danger fade in\">
                  		<strong>" . $data['errors'] . "</strong></div>";
                $this->session->set_userdata($msg);
                redirect(base_url('kpi/details_add'));
            } else {            
                $data = array(
                    "ValueDriverCode" => $ValueDriverCode,
                    "KPIMetricsCode" => $KPIMetricsCode,
                    "Business" => $Business,
                    "CYEAR" => $CYEAR,                     
                    "CPERIOD" => $CPERIOD,
                    "A" => $A,
                    "ATXT" => $ATXT,
                    "B" => $B,
                    "BTXT" => $BTXT,
                    "C" => $C,
                    "CTXT" => $CTXT,
                    "D" => $D,
                    "DTXT" => $DTXT,
                    "IndexValue" => $IndexValue 
                );
                $tracking = $this->kpi_m->duplicate_checking_GroupKPIDetailsOutput($ValueDriverCode,$KPIMetricsCode,$Business,$CPERIOD);
                //print_r($tracking);
                //echo count($tracking);exit();
                if (count($tracking) == 1) {
                    $id = $this->kpi_m->update_GroupKPIDetailsOutput($data);
                    $this->kpi_m->doUpdateCalculationKPIOutput($KPIMetricsCode);                    
                }else{
                    $id = $this->kpi_m->insert($data,'GroupKPIDetailsOutput');
                    $this->kpi_m->doUpdateCalculationKPIOutput($KPIMetricsCode);
                }
                
				
         
                if ($id) {
                    $msg['message'] = "GroupKPIDetailsOutput Successfully Added.";
                } else {
                    $msg['message'] = "GroupKPIDetailsOutput Add Unsuccessfully.";
                }
                $this->session->set_userdata($msg);
                redirect(base_url('kpi/details_all'));
            }
        }
    }
    
    public function details_all() {
        $data = array();
        $data['page'] = 'kpi_all';
        $data['page_title'] = 'All Kpi Information';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['rows'] = $this->kpi_m->select_GroupKPIDetailsOutput($data['userid']);
        //echo '<pre/>';print_r($data['rows']); exit();
        $data['main_content'] = $this->load->view('kpi/details_all', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    public function details_all_p() {
        $data = array();
        $data['page'] = 'kpi_details_all';
        $data['page_title'] = 'All Kpi Information';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        //$data['rows'] = $this->kpi_m->select_GroupKPIDetailsOutput($data['userid']);
        //echo '<pre/>';print_r($data['rows']); exit();
        $data['main_content'] = $this->load->view('kpi/details_all_p', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function content_displayer() {
        if (isset($_POST['page']) && !empty($_POST['page'])) {
            $records_per_page = $_POST['records_per_page'];
            $search = '%'.$_POST['search'].'%';
            $vpb_page_limit = $records_per_page;
            $vpb_get_total_pages = $this->kpi_m->selectGroupKPIDetailsOutputCount('GroupKPIDetailsOutput',$search);
            $vpb_get_total_pages = $vpb_get_total_pages[0]['num'];

            $vpb_pagination_stages = 2;
            $vpb_current_page = strip_tags($_POST['page']);
            $vpb_start_page = ($vpb_current_page - 1) * $vpb_page_limit;

            //This initializes the page setup
            if ($vpb_current_page == 0) {
                $vpb_current_page = 1;
            }
            $vpb_previous_page = $vpb_current_page - 1;
            $vpb_next_page = $vpb_current_page + 1;
            $vpb_last_page = ceil($vpb_get_total_pages / $vpb_page_limit);
            $vpb_lastpaged = $vpb_last_page - 1;
            $vpb_pagination_system = '';
            if ($vpb_last_page > 1) {
                $vpb_pagination_system .= "<div class='vpb_pagination_system'>";
                // Previous Page
                if ($vpb_current_page > 1) {
                    $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_previous_page\",\"$search\",\"$records_per_page\");'>Prev</a>";
                } else {
                    $vpb_pagination_system.= "<span class='disabled'>Prev</span>";
                }
                // Pages	
                if ($vpb_last_page < 7 + ($vpb_pagination_stages * 2)) { // Not enough pages to breaking it up
                    for ($vpb_page_counter = 1; $vpb_page_counter <= $vpb_last_page; $vpb_page_counter++) {
                        if ($vpb_page_counter == $vpb_current_page) {
                            $vpb_pagination_system.= "<span class='current'>$vpb_page_counter</span>";
                        } else {
                            $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_page_counter\",\"$search\",\"$records_per_page\");'>$vpb_page_counter</a>";
                        }
                    }
                } elseif ($vpb_last_page > 5 + ($vpb_pagination_stages * 2)) { // This hides few pages when the displayed pages are much
                    //Beginning only hide later pages
                    if ($vpb_current_page < 1 + ($vpb_pagination_stages * 2)) {
                        for ($vpb_page_counter = 1; $vpb_page_counter < 4 + ($vpb_pagination_stages * 2); $vpb_page_counter++) {
                            if ($vpb_page_counter == $vpb_current_page) {
                                $vpb_pagination_system.= "<span class='current'>$vpb_page_counter</span>";
                            } else {
                                $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_page_counter\",\"$search\",\"$records_per_page\");'>$vpb_page_counter</a>";
                            }
                        }
                        $vpb_pagination_system.= "...";
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_lastpaged\",\"$search\",\"$records_per_page\");'>$vpb_lastpaged</a>";
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_last_page\",\"$search\",\"$records_per_page\");'>$vpb_last_page</a>";
                    }
                    //Middle hide some front and some back
                    elseif ($vpb_last_page - ($vpb_pagination_stages * 2) > $vpb_current_page && $vpb_current_page > ($vpb_pagination_stages * 2)) {
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"1\",\"$search\",\"$records_per_page\");'>1</a>";
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"2\",\"$search\",\"$records_per_page\");'>2</a>";
                        $vpb_pagination_system.= "...";
                        for ($vpb_page_counter = $vpb_current_page - $vpb_pagination_stages; $vpb_page_counter <= $vpb_current_page + $vpb_pagination_stages; $vpb_page_counter++) {
                            if ($vpb_page_counter == $vpb_current_page) {
                                $vpb_pagination_system.= "<span class='current'>$vpb_page_counter</span>";
                            } else {
                                $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_page_counter\",\"$search\",\"$records_per_page\");'>$vpb_page_counter</a>";
                            }
                        }
                        $vpb_pagination_system.= "...";
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_lastpaged\",\"$search\",\"$records_per_page\");'>$vpb_lastpaged</a>";
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_last_page\",\"$search\",\"$records_per_page\");'>$vpb_last_page</a>";
                    }
                    //End only hide early pages
                    else {
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"1\",\"$search\",\"$records_per_page\");'>1</a>";
                        $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"2\",\"$search\",\"$records_per_page\");'>2</a>";
                        $vpb_pagination_system.= "...";
                        for ($vpb_page_counter = $vpb_last_page - (2 + ($vpb_pagination_stages * 2)); $vpb_page_counter <= $vpb_last_page; $vpb_page_counter++) {
                            if ($vpb_page_counter == $vpb_current_page) {
                                $vpb_pagination_system.= "<span class='current'>$vpb_page_counter</span>";
                            } else {
                                $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_page_counter\",\"$search\",\"$records_per_page\");'>$vpb_page_counter</a>";
                            }
                        }
                    }
                }
                //Next Page
                if ($vpb_current_page < $vpb_page_counter - 1) {
                    $vpb_pagination_system.= "<a href='javascript:void(0);' onclick='vpb_pagination_system(\"$vpb_next_page\",\"$search\",\"$records_per_page\");'>Next</a>";
                } else {
                    $vpb_pagination_system.= "<span class='disabled'>Next</span>";
                }
                $vpb_pagination_system.= "</div>";
            }
            
            $data['vpb_pagination_system'] = $vpb_pagination_system;
            //Check the contents for this page from the database
            $data['rows'] = $this->kpi_m->selectGroupKPIDetailsOutputData($vpb_start_page, $vpb_page_limit,$search);

            if (count($data['rows']) < 1) {
                echo "<div class='info'>Currently, there are no content in the database to display at the moment. Thanks...</div>";
            } else {
                $this->load->view('kpi/get_details_all_p', $data);
            }
        }
    }
    
    public function details_update($ValueDriverCode) {
        $data = array();
        $data['page'] = 'kpi_add';
        $data['page_title'] = 'Update Kpi';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['ValueDriverCode'] = $ValueDriverCode;
        $data['KPIMetricsCode'] = $this->uri->segment(4);
        $data['CPERIOD'] = $this->uri->segment(5);
        $data['Business'] = $this->uri->segment(6);
        //echo '<pre/>';print_r($data);exit();
        $data['ValueDriverCode_rows'] = $this->kpi_m->select_ValueDriverCode($data['userid']);
        $data['Business_rows'] = $this->kpi_m->select_Business($data['userid']);
        $data['KPIMetricsCode_rows'] = $this->kpi_m->select_KPIMetricsCode($data['KPIMetricsCode']);
        
        $data['row'] = $this->kpi_m->selectGroupKPIDetailsOutputSingle($data['ValueDriverCode'],$data['KPIMetricsCode'],$data['CPERIOD'],$data['Business']);
        //echo '<pre/>';print_r($data['row']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/details_edit', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function valueDriverList() {
        $data = array();
        $data['page'] = 'value_driver_list';
        $data['page_title'] = 'All Value Driver';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['rows'] = $this->kpi_m->doLoadAllValueDriver();
        //echo '<pre/>';print_r($data['rows']); exit();
        $data['main_content'] = $this->load->view('kpi/value_driver_list', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function valueDriverAdd() {
        $data = array();
        $data['page'] = 'value_driver_add';
        $data['page_title'] = 'Add Value Driver';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['ValueDriver'] = $this->input->post('ValueDriver');
        $data['ValueDriverCode'] = $this->input->post('ValueDriverCode');
     
        if(!empty($_POST)){
            $response = $this->kpi_m->addValueDriver($_POST);
            if($response==true){
                $this->session->set_flashdata('message', 'Value Driver Added Successfully.');
                return redirect('/kpi/valueDriverList');
            }else{

            }
        }
        // echo '<pre/>';print_r($data['row']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/value_driver_add', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function valueDriverEdit() {
        $data = array();
        $data['page'] = 'value_driver_edit';
        $data['page_title'] = 'Update Value Driver';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['ValueDriverCode'] = $this->uri->segment(3);
        // echo '<pre/>';print_r($data['ValueDriverCode'] );exit();
        if(!empty($data['ValueDriverCode'])){
            $data['row'] = $this->kpi_m->editValueDriver($data['ValueDriverCode'])[0];
        }
        if(!empty($_POST)){
            $data['ValueDriver'] = $this->input->post('ValueDriver');
            $data['ValueDriverCode'] = $this->input->post('ValueDriverCode');
            $response = $this->kpi_m->updateValueDriver($data['ValueDriverCode'],$data['ValueDriver']);
            if($response==true){
                $this->session->set_flashdata('message', 'Value Driver Updated Successfully.');
                return redirect('/kpi/valueDriverList');
            }else{

            }
        }
        // echo '<pre/>';print_r($data['row']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/value_driver_edit', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    // Sub value driver
    public function subValueDriverList() {
        $data = array();
        $data['page'] = 'value_driver_list';
        $data['page_title'] = 'All SubValue Driver';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        
        $data['rows'] = $this->kpi_m->doLoadAllSubValueDriver();
        // echo '<pre/>';print_r($data['allValueDrivers']); exit();
        $data['main_content'] = $this->load->view('kpi/subvaluedriver/subvalue_driver_list', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function subValueDriverAdd() {
        $data = array();
        $data['page'] = 'value_driver_add';
        $data['page_title'] = 'Add SubValue Driver';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['SubValueDriver'] = $this->input->post('SubValueDriver');
        $data['ValueDriverCode'] = $this->input->post('ValueDriverCode');
        $data['allValueDrivers'] = $this->kpi_m->doLoadAllValueDriver();

        if(!empty($_POST)){
            $response = $this->kpi_m->addSubValueDriver($_POST);
            if($response==true){
                $this->session->set_flashdata('message', 'SubValue Driver Added Successfully.');
                return redirect('/kpi/subValueDriverList');
            }else{

            }
        }
        // echo '<pre/>';print_r($data['row']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/subvaluedriver/subvalue_driver_add', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function subValueDriverEdit() {
        $data = array();
        $data['page'] = 'value_driver_edit';
        $data['page_title'] = 'Update SubValue Driver';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['SubValueDriverCode'] = $this->uri->segment(3);
        $data['allValueDrivers'] = $this->kpi_m->doLoadAllValueDriver();
        // echo '<pre/>';print_r($data['ValueDriverCode'] );exit();
        if(!empty($data['SubValueDriverCode'])){
            $data['row'] = $this->kpi_m->editSubValueDriver($data['SubValueDriverCode'])[0];
        }
        if(!empty($_POST)){
            $data['SubValueDriver'] = $this->input->post('SubValueDriver');
            $data['SubValueDriverCode'] = $this->input->post('SubValueDriverCode');
            $data['ValueDriverCode'] = $this->input->post('ValueDriverCode');
            $response = $this->kpi_m->updateSubValueDriver($_POST);
            if($response==true){
                $this->session->set_flashdata('message', 'SubValue Driver Updated Successfully.');
                return redirect('/kpi/subValueDriverList');
            }else{

            }
        }
        // echo '<pre/>';print_r($data['row']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/subvaluedriver/subvalue_driver_edit', $data, TRUE);
        $this->load->view('index', $data);
    }

    // Sub value driver
    public function kpiconfigList() {
        $data = array();
        $data['page'] = 'value_driver_list';
        $data['page_title'] = 'All KPI Configurations';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        
        $data['rows'] = $this->kpi_m->doLoadAllKpiConfig();
        // echo '<pre/>';print_r($data['rows']); exit();
        $data['main_content'] = $this->load->view('kpi/kpi_configuration/kpiconfig_list', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function kpiconfigAdd() {
        $data = array();
        $data['page'] = 'kpiconfig_add';
        $data['page_title'] = 'Add KPI Configuration';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();

        $data['ValueDriverCode'] = $this->input->post('ValueDriverCode');
        $data['SubDriverCode'] = $this->input->post('SubDriverCode');
        $data['KPIName'] = $this->input->post('KPIName');
        $data['Description'] = $this->input->post('Description');
        $data['Formula'] = $this->input->post('Formula');
        $data['SOURCE'] = $this->input->post('SOURCE');
        $data['active'] = $this->input->post('active');
        $data['Nature'] = $this->input->post('Nature');
        $data['Business'] = $this->input->post('Business');

        $data['title'] = $this->input->post('title');
        $data['valuetype'] = $this->input->post('valuetype');
        $data['charttype'] = $this->input->post('charttype');

        // echo '<pre/>';print_r($data);exit();

        $data['allValueDrivers'] = $this->kpi_m->doLoadAllValueDriver();
        $data['allSubValueDrivers'] = $this->kpi_m->getAllSubValueDriver();

        if(!empty($_POST)){
           // echo '<pre/>';print_r($data);exit();
            $response = $this->kpi_m->addKpiConfig($_POST);
            if($response==true){
                $this->session->set_flashdata('message', 'KPI Configuration Added Successfully.');
                return redirect('/kpi/kpiconfigList');
            }else{

            }
        }
        // echo '<pre/>';print_r($data['allSubValueDrivers']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/kpi_configuration/kpiconfig_add', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function kpiconfigEdit() {
        $data = array();
        $data['page'] = 'kpiconfig_edit';
        $data['page_title'] = 'Update KPI Configuration';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['KPICode'] = $this->uri->segment(3);
        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();

        $data['allValueDrivers'] = $this->kpi_m->doLoadAllValueDriver();
        $data['allSubValueDrivers'] = $this->kpi_m->getAllSubValueDriver();
        if(!empty($data['KPICode'])){
            $response = $this->kpi_m->editKpiConfig($data['KPICode']);
            $data['KpiConfig'] = $response['KpiConfig'][0];
            $data['KpiConfigDetails'] = $response['KpiConfigDetails'];
             //echo '<pre/>';print_r($data['KpiConfig'] );exit();
        }
        if(!empty($_POST)){
            $response = $this->kpi_m->updateKpiConfig($_POST);
            if($response==true){
                $this->session->set_flashdata('message', 'KPI Configuration Updated Successfully.');
                return redirect('/kpi/kpiconfigList');
            }else{

            }
        }
        // echo '<pre/>';print_r($data['row']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/kpi_configuration/kpiconfig_edit', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function getSubValueDriverCodeByValueDriver()
    {
        $ValueDriverCode = $this->input->post('ValueDriverCode');
        $response = $this->kpi_m->loadSubValueDriverCodeByValueDriver($ValueDriverCode);
        $string = '';
        foreach($response as $res){
            $string .= '<option value="'.$res['SubValueDriverCode'].'" >'.$res["SubValueDriver"].'</option>';
        }
        // echo '<pre/>';print_r($string);exit();
        echo json_encode($string);
    }

    public function addResponsiblePerson()
    {
        $modalKpiCode = $this->input->post('modalKpiCode');
        $StaffID = $this->input->post('StaffID');
        $EmpName = $this->input->post('EmpName');
        $Designation = $this->input->post('Designation');
        $Email = $this->input->post('Email');
        $Phone = $this->input->post('Phone');

        $response = $this->kpi_m->addKpiResponsiblePersonData($_POST);

        return redirect('/kpi/kpiconfigList');
    }
    
    public function updateResponsiblePerson()
    {
        $modalKpiCode = $this->input->post('modalKpiCode');
        $StaffID = $this->input->post('StaffID');
        $EmpName = $this->input->post('EmpName');
        $Designation = $this->input->post('Designation');
        $Email = $this->input->post('Email');
        $Phone = $this->input->post('Phone');

        $response = $this->kpi_m->updateKpiResponsiblePersonData($_POST);

        return redirect('/kpi/kpiconfigList');
    }

    public function getKpiResponsiblePersonValue()
    {
        $kpiCode = $this->input->post('kpiCode');
        $response = $this->kpi_m->getKpiResponsiblePersonData($kpiCode);
        if(!empty($response)){
            $response = $response[0];
        }
        echo json_encode($response);
    }

    public function my_kpi_data(){
        $data = array();
        $data['page'] = 'my_kpi_data_list';
        $data['page_title'] = 'KPI Data';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $year = $this->input->post('year');
        $export = $this->input->post('export');

        if (empty($year)){
            //echo '<pre/>';print_r($year);exit();
            $year = date('Y');
            $year = $year-1;
        }

        $data['year'] = $year;
        $data['my_kpi_data'] = $this->kpi_m->doLoadMyKPIData($data['userid'], $data['year']);

        if ($export =='export'){
            $filename = 'MY KPI Data';
                $this->exportexcel($data['my_kpi_data'],$filename);
//            $kpiDataKeySet = [];
//            $index = array_keys($data['my_kpi_data'][0]);
//            for($i = 0; $i < count($index); $i++){
//
//                if ($i < 4){
//                    $kpiDataKeySet [] = $index[$i];
//                }else{
//                    $year = substr($index[$i], 0, 4);
//                    $month = substr($index[$i], -2);
//                    $result = $year.'-'.$month.'-'.'01';
//                    $kpiDataKeySet [] = date('F Y',strtotime($result));
//                }
//            }
//
//            $my_kpi_data = $data['my_kpi_data'];
//            $dateSet = [];
//
//           foreach ($my_kpi_data as $value){
//               $dateSet []= [
//                   $kpiDataKeySet[0] => $value['Business'],
//                   $kpiDataKeySet[1] => $value['Value_Driver'],
//                   $kpiDataKeySet[2] => $value['Sub_Value_Driver'],
//                   $kpiDataKeySet[3] => $value['KPI_Name'],
//                   $kpiDataKeySet[4] => $value['202301'],
//               ];
//           }
//
//
//            echo '<pre/>';print_r($dateSet);exit();

        }

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/my_kpi_data_list', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function adminDashboard(){
        $data = array();
        $data['page'] = 'admin_dashboard';
        $data['page_title'] = 'Performance Dashboard';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();
        $data['allvaluedriver'] 		= $this->Processkpi_m->doLoadValueDriver($data['userid']);

        $data['dashboard_data'] = $this->kpi_m->getDashboardData();
        $data['first'] = $data['dashboard_data']['first'];
        $data['second'] = $data['dashboard_data']['second'];
        //echo '<pre/>';print_r($data['first']);exit();

        $data['Business'] = '';
        $data['valuedriver'] = '';
        $data['subvaluedriver'] = '';

        if ($_POST){
           //echo '<pre/>';print_r($_POST);exit();
            $Business = $this->input->post('Business');
            $valuedriv = $this->input->post('valuedriver');
            $subvaluedriver = $this->input->post('subvaluedriver');
            $data['single_value_driver'] = $this->Processkpi_m->doLoadValueDriverByValueDriverCode($valuedriv);
            if ($data['single_value_driver']){
                $valuedriver = $data['single_value_driver'][0]['ValueDriver'];
            }else{
                $valuedriver = [];
            }

            $data['Business'] = $Business;
            $data['valuedriver'] = $valuedriver;
            $data['subvaluedriver'] = $subvaluedriver;

            if ($Business != 'all'){
                $value = array_filter($data['first'], function ($item) use($data){
                    if (!empty($data['Business']) && !empty($data['valuedriver']) && !empty($data['subvaluedriver'])){
                        return $item['BusinessName'] == $data['Business'] && $item['ValueDriver'] == $data['valuedriver'] && $item['SubValueDriver'] == $data['subvaluedriver'];
                    } elseif (!empty($data['Business']) && !empty($data['valuedriver'])){
                        return $item['BusinessName'] == $data['Business'] && $item['ValueDriver'] == $data['valuedriver'];
                    } elseif (!empty($data['Business'])){
                        return $item['BusinessName'] == $data['Business'];
                    }
                });

                $data['first'] = $value;
            }
        }

        if ($this->input->post('export') == 'export'){
            $this->exportexcel($data['first'], 'Performance Dashboard');
        }

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);

        $data['main_content'] = $this->load->view('kpi/admin_dashboard', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function performanceFiltering(){
        $data = array();
        $data['page'] = 'performance_filtering';
        $data['page_title'] = 'Performance Filtering';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();
        $data['allvaluedriver'] 		= $this->Processkpi_m->doLoadValueDriver($data['userid']);

        $data['dashboard_data'] = [];
        $data['second'] = [];

        $data['Business'] = '';
        $data['valuedriver'] = '';
        $data['criteria'] = '';
        $data['value'] = '';

        if ($_POST){
            //echo '<pre/>';print_r($_POST);exit();

            $data['dashboard_data'] = $this->kpi_m->getDashboardData();
            //echo '<pre/>';print_r($data['dashboard_data']);exit();
            $data['second'] = $data['dashboard_data']['second'];
           // echo '<pre/>';print_r($data['second']);exit();

            $Business = $this->input->post('Business');
            $valuedriver = $this->input->post('valuedriver');
            $criteria = $this->input->post('criteria');
            $val = $this->input->post('value');

            $data['Business'] = $Business;
            $data['valuedriver'] = $valuedriver;
            $data['criteria'] = $criteria;
            $data['value'] = $val;

            $value = array_filter($data['second'], function ($item) use ($data) {
                if (!empty($data['Business']) && !empty($data['valuedriver'])) {
                    if ($data['criteria'] == 'worst') {
                        return $item['BusinessName'] == $data['Business'] && $item['ValueDriver'] == $data['valuedriver'] && $item['BusinessValueDriverPercentile'] <= $data['value'];
                    } else {
                        return $item['BusinessName'] == $data['Business'] && $item['ValueDriver'] == $data['valuedriver'] && $item['BusinessValueDriverPercentile'] >= (100 - $data['value']);
                    }
                } elseif (!empty($data['Business'])) {
                    if ($data['criteria'] == 'worst') {
                        return $item['BusinessName'] == $data['Business'] && $item['BusinessPercentile'] <= $data['value'];
                    } else {
                        return $item['BusinessName'] == $data['Business'] && $item['BusinessPercentile'] >= (100 - $data['value']);
                    }
                }elseif (!empty($data['valuedriver'])) {
                    if ($data['criteria'] == 'worst') {
                        return $item['ValueDriver'] == $data['valuedriver'] && $item['ValueDriverPercentile'] <= $data['value'];
                    } else {
                        return $item['ValueDriver'] == $data['valuedriver'] && $item['ValueDriverPercentile'] >= (100 - $data['value']);
                    }

                }
            });

            $data['result'] = $value;

            $final_data = [];

            if (!empty($data['Business'])){
                foreach ($data['result'] as $vals)
                    $final_data [] = [
                        'BusinessName'=>$vals['BusinessName'],
                        'ValueDriver'=>$vals['ValueDriver'],
                        'SubValueDriver'=>$vals['SubValueDriver'],
                        'AVGScore'=>$vals['AVGScore'],
                        'ScoreInPercentage'=>$vals['ScoreInPercentage'],
                        'BusinessRank'=>$vals['BusinessRank'],
                        'BusinessPercentile'=>$vals['BusinessPercentile'],
                    ];
            }elseif (!empty($data['valuedriver'])){
                foreach ($data['result'] as $vals)
                    $final_data [] = [
                        'BusinessName'=>$vals['BusinessName'],
                        'ValueDriver'=>$vals['ValueDriver'],
                        'SubValueDriver'=>$vals['SubValueDriver'],
                        'AVGScore'=>$vals['AVGScore'],
                        'ScoreInPercentage'=>$vals['ScoreInPercentage'],
                        'ValueDriverRank'=>$vals['ValueDriverRank'],
                        'ValueDriverPercentile'=>$vals['ValueDriverPercentile'],
                    ];
            }elseif (!empty($data['Business']) && !empty($data['valuedriver'])){
                foreach ($data['result'] as $vals)
                    $final_data [] = [
                        'BusinessName'=>$vals['BusinessName'],
                        'ValueDriver'=>$vals['ValueDriver'],
                        'SubValueDriver'=>$vals['SubValueDriver'],
                        'AVGScore'=>$vals['AVGScore'],
                        'ScoreInPercentage'=>$vals['ScoreInPercentage'],
                        'BusinessValueDriverRank'=>$vals['BusinessValueDriverRank'],
                        'BusinessValueDriverPercentile'=>$vals['BusinessValueDriverPercentile'],
                    ];
            }

            $data['second'] = $final_data;

        }

       // echo '<pre/>';print_r($_POST);exit();

        if ($this->input->post('export') == 'export'){
            $this->exportexcel($data['second'], 'Performance Filtering');
        }

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);

        $data['main_content'] = $this->load->view('kpi/performance_filtering', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function AdminDataDetails(){
        $data['business'] = $this->input->post('business');
        $data['valudriver'] = $this->input->post('valudriver');
        $data['subvalue'] = $this->input->post('subvalue');

        $data['dashboard_data'] = $this->kpi_m->getDashboardData();
        $data['first'] = $data['dashboard_data']['first'];

        $value = array_filter($data['first'], function ($item) use($data){
            return $item['BusinessName'] == $data['business'] && $item['ValueDriver'] == $data['valudriver'] && $item['SubValueDriver'] == $data['subvalue'];
        });

        $string = '';
        foreach ($value as $key => $dataval){
            if ($dataval['1P'] < 0){ $p1 = 'background:red;color:white';}elseif ($dataval['1P']==0){$p1 = 'background:yellow;color:black';}else{$p1 = 'background:green;color:white';}
            if ($dataval['2P'] < 0){ $p2 = 'background:red;color:white';}elseif ($dataval['2P']==0){$p2 = 'background:yellow;color:black';}else{$p2 = 'background:green;color:white';}
            if ($dataval['3P'] < 0){ $p3 = 'background:red;color:white';}elseif ($dataval['3P']==0){$p3 = 'background:yellow;color:black';}else{$p3 = 'background:green;color:white';}
            if ($dataval['4P'] < 0){ $p4 = 'background:red;color:white';}elseif ($dataval['4P']==0){$p4 = 'background:yellow;color:black';}else{$p4 = 'background:green;color:white';}
            if ($dataval['5P'] < 0){ $p5 = 'background:red;color:white';}elseif ($dataval['5P']==0){$p5 = 'background:yellow;color:black';}else{$p5 = 'background:green;color:white';}
            if ($dataval['6P'] < 0){ $p6 = 'background:red;color:white';}elseif ($dataval['6P']==0){$p6 = 'background:yellow;color:black';}else{$p6 = 'background:green;color:white';}
            $string .= "<tr>
                           <td>".$dataval["BusinessName"]."</td>
                           <td>".$dataval["ValueDriver"]."</td>
                           <td>".$dataval["SubValueDriver"]."</td>
                           <td>".$dataval["KPIName"]."</td>
                           <td style='text-align: right;".$p1."'>".number_format($dataval['1P'], 2)."</td>
                           <td style='text-align: right;".$p2."'>".number_format($dataval['2P'], 2)."</td>
                           <td style='text-align: right;".$p3."'>".number_format($dataval['3P'], 2)."</td>
                           <td style='text-align: right;".$p4."'>".number_format($dataval['4P'], 2)."</td>
                           <td style='text-align: right;".$p5."'>".number_format($dataval['5P'], 2)."</td>
                           <td style='text-align: right;".$p6."'>".number_format($dataval['6P'], 2)."</td>
                           <td style='text-align: right;'>".number_format($dataval['Score'], 2)."</td>
                           <td><div id='container$key' style='width: 200px; height: 20px;'></div></td>
                       </tr>
                       
                       <script>
                            var stage = anychart.graphics.create('container$key');

                            chart1 = anychart.sparkline();
                            chart1.seriesType('line');
                            
                            chart1.data([0,".$dataval['1P'].",".$dataval['2P'].",".$dataval['3P'].",".$dataval['4P'].",".$dataval['5P'].",".$dataval['6P']."]);
                            
                            chart1.bounds(0, 0, 200, 20);
                            chart1.maxMarkers(true).minMarkers(true);
                            
                            chart1.container(stage);
                            
                            chart1.draw();
                            </script>
                       ";
        }

        $data['string'] = $string;

        echo json_encode($data);
        //echo '<pre/>';print_r($_POST);exit();
    }

    public function kpiStatus(){

        $data = array();
        $data['page'] = 'kpi_status';
        $data['page_title'] = 'KPI Entry Status';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_status_data'] = [];

        $data['Business_rows']    = $this->kpi_m->getAllBusinessForKPIStatus($data['userid']);
        $data['allvaluedriver']   = $this->kpi_m->doLoadValueDriverForKPIStatus($data['userid']);

        $data['Business'] = '';
        $data['valuedriver'] = '';

        if ($_POST){
            $Business = $this->input->post('Business');
            $valuedriver = $this->input->post('valuedriver');

            $data['Business'] = $Business;
            $data['valuedriver'] = $valuedriver;

            $data['kpi_status_data'] = $this->kpi_m->getKPIStatusData($data['userid'],$data['Business'], $data['valuedriver']);
            //echo '<pre/>';print_r($data['kpi_status_data']);exit();
        }

        if ($this->input->post('export') == 'export'){
            $this->exportexcel($data['kpi_status_data'], 'KPI Status');
        }

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/kpi_status', $data, TRUE);
        $this->load->view('index', $data);
    }

    function exportexcel($result, $filename)
    {
        for ($i = 0; $i < count($result); $i++) {
            if (!isset($result[$i]['PageNo'])) {
                break;
            }
            unset($result[$i]['PageNo']);
        }
        $arrayheading[0] = !empty($result) ? array_keys($result[0]) : [];
        $result = array_merge($arrayheading, $result);

        header("Content-Disposition: attachment; filename=\"{$filename}.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($result as $data) {
            fputcsv($out, $data, "\t");
        }
        fclose($out);
        exit();
    }
}
