<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_m');
        $this->load->model('Goodbad_m');
    }

    public function index() {
        //echo '<pre/>';print_r($this->session->userdata('userid'));exit();
        //echo myBusinessId($data['BusinessId']);
        // myBusinessId('BusinessId',$this->session->userdata('BusinessId'));
        //exit();
        $data = array();
        $data['page'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
//        $data['userid'] = $this->session->userdata('userid');
//        $data['emp_name'] = $this->session->userdata('emp_name');
//        $data['dept_name'] = $this->session->userdata('dept_name');
//        $data['designation'] = $this->session->userdata('designation');
//        $data['BusinessId'] = $this->session->userdata('BusinessId');

        //$data['row'] = $this->Common_m->SelectCountDashboard();
        // echo '<pre/>';print_r($data);exit();
      //  $data['rowQuiz'] = $this->Common_m->SelectCountQuiz($data['BusinessId']);
        //echo '<pre/>';print_r($data['rowQuiz']);exit();
//        $data['header'] = $this->load->view('inc/header', $data, true);
//        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
//        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('dash', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function kpi_report() {
        //echo '<pre/>';print_r($this->session);exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['BusinessId'] = $this->session->userdata('BusinessId');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['Business'] = $Business = 'Pharma';
		$data['charttype'] = 'line'; 
        $data['row_business'] = $this->Common_m->selectBusiness();
        $data['row_cyear'] = $this->Common_m->selectCYEAR();
		
        $year = array();
        //$year = explode(',', $CYEAR);
        foreach ($data['row_cyear'] AS $y){
            $year[] = $y->CYEAR;
        }
        //print_r($year);exit();
        $data['row_count'] = $this->Common_m->SelectCountVW_KPIDETAILSDATA($Business,$year);
        $data['row_KPI_Business'] = $this->Common_m->SelectKPIBusiness($Business,$year);
        $data['row_KPIDriven'] = $this->Common_m->SelectKPIDriven($Business,$year);
        $data['row_KPIMetrics'] = $this->Common_m->SelectKPIMetrics($Business,$year);

		$data['row_KPIMetricsdistinct'] = array_unique(array_column($data['row_KPIMetrics'], 'KPIMetrics'));
        $data['rows'] = $this->Common_m->SelectData($Business,$year);
        $data['rows_period'] = $this->Common_m->SelectDataMinPeriod($Business,$year);
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
        //echo '<pre/>';print_r( $data['min_period']		);exit();
        //$data['main_content'] = $this->load->view('kpi_report', $data, TRUE);
        $this->load->view('kpi_report', $data);
    }
	    
    public function kpi_report_ajax() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';

        $Business = $this->input->post('Business',TRUE);
        $CYEAR = $this->input->post('CYEAR',TRUE);
		$data['charttype'] = $this->input->post('charttype',TRUE);
		$KPIMetrics = $this->input->post('KPIMetrics',TRUE);
		
        
        $year = array();
        $year = explode(',', $CYEAR);
        //echo '<pre/>';print_r(myBusinessId('CYEAR' ,$year));
       // exit();
        
        $data['row_business'] = $this->Common_m->selectBusiness();
        $data['row_cyear'] = $this->Common_m->selectCYEAR();
        
        $data['row_count'] = $this->Common_m->SelectCountVW_KPIDETAILSDATA($Business,$year, $KPIMetrics);
        $data['row_KPI_Business'] = $this->Common_m->SelectKPIBusiness($Business,$year, $KPIMetrics);
        $data['row_KPIDriven'] = $this->Common_m->SelectKPIDriven($Business,$year, $KPIMetrics);
        $data['row_KPIMetrics'] = $this->Common_m->SelectKPIMetrics($Business,$year , $KPIMetrics);
        $data['rows'] = $this->Common_m->SelectData($Business,$year, $KPIMetrics);
		$data['rows_period'] = $this->Common_m->SelectDataMinPeriod($Business,$year);
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
         // echo '<pre/>'; print_r( $data['row_count']); exit();
        //$data['main_content'] = $this->load->view('kpi_report', $data, TRUE);
        //$this->load->view('kpi_report_ajax', $data);
		if(!empty($KPIMetrics)){
			$this->load->view('kpi_report_ajax_kpi_single', $data);
		}else{
			$this->load->view('kpi_report_ajax', $data);
		}
    }
	
	
	public function kpi_report_ajax_anomaly() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report Anomaly';

        $Business = $this->input->post('Business',TRUE);
        $CYEAR = $this->input->post('CYEAR',TRUE);
		$data['charttype'] = $this->input->post('charttype',TRUE);
		$KPIMetrics = $this->input->post('KPIMetrics',TRUE);       
        
        $year = array();
        $year = explode(',', $CYEAR);
    
        
        $data['row_business'] = $this->Common_m->selectBusiness();
        $data['row_cyear'] = $this->Common_m->selectCYEAR();
        
        $data['row_count'] = $this->Common_m->SelectCountVW_KPIDETAILSDATA($Business,$year, $KPIMetrics);
        $data['row_KPI_Business'] = $this->Common_m->SelectKPIBusiness($Business,$year, $KPIMetrics);
        $data['row_KPIDriven'] = $this->Common_m->SelectKPIDriven($Business,$year, $KPIMetrics);
        $data['row_KPIMetrics'] = $this->Common_m->SelectKPIMetrics_anomaly($Business,$year , $KPIMetrics);
        $data['rows'] = $this->Common_m->SelectData_anomaly($Business,$year, $KPIMetrics);
		$data['rows_period'] = $this->Common_m->SelectDataMinPeriod($Business,$year);
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
          //echo '<pre/>'; print_r( $data['row_count']); exit();
        //$data['main_content'] = $this->load->view('kpi_report', $data, TRUE);
       // $this->load->view('kpi_report_ajax_anomaly', $data);
		
		
		//$this->load->view('kpi_report_ajax_anomaly_test', $data);
		if(!empty($KPIMetrics)){
			$this->load->view('kpi_report_ajax_anomaly_kpi_single', $data);
		}else{
			$this->load->view('kpi_report_ajax_anomaly', $data);
		}
		
		
    }
	
	
	public function kpi_report_ajax_single() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';

        $data['Business'] 		= $this->input->get_post('Business',TRUE);
		$data['ValueDriver'] 	= str_replace("___", "&", $this->input->get_post('ValueDriver',TRUE));
		$data['KPIMetrics'] 	= str_replace("___", "&", $this->input->get_post('KPIMetrics',TRUE));
		$data['ChartType'] 		= $this->input->get_post('ChartType',TRUE);
		$data['CYEAR'] 			= $this->input->get_post('CYEAR',TRUE);
		$year = array();
        $year = explode(',', $data['CYEAR']);
		$Business = $data['Business'];
        $data['rows'] = $this->Common_m->selectChartData($data['Business'] , $data['ValueDriver'], $data['KPIMetrics'], $data['CYEAR']);
		$data['rows_period'] = $this->Common_m->SelectDataMinPeriod($Business,$year);
		
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
 //echo '<pre/>';print_r( $data['rows']);exit();		
        $this->load->view('kpi_report_ajax_single', $data);
    }
	
	
	

}
