<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Goodbad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Goodbad_m');
    }

    public function kpi_good() {
        //echo '<pre/>';print_r($this->session);exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Good';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['BusinessId'] = $this->session->userdata('BusinessId');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['Business'] = $Business = 'All';
		$data['charttype'] = 'line'; 
        $data['row_business'] = $this->Goodbad_m->selectBusinessGood();
        $data['row_cyear'] = $this->Goodbad_m->selectCYEARGood();
		
        $year = array();
        //$year = explode(',', $CYEAR);
        foreach ($data['row_cyear'] AS $y){
            $year[] = $y->CYEAR;
        }
        //print_r($year);exit();
		
        $data['row_count'] = $this->Goodbad_m->SelectCountGood($Business,$year);
        $data['row_KPI_Business'] = $this->Goodbad_m->SelectKPIBusinessGood($Business,$year);
        $data['row_KPIDriven'] = $this->Goodbad_m->SelectKPIDrivenGood($Business,$year);
        $data['row_KPIMetrics'] = $this->Goodbad_m->SelectKPIMetricsGood($Business,$year);
//echo '<pre/>';print_r( $data['row_KPIMetrics']);exit();
		$data['row_KPIMetricsdistinct'] = array_unique(array_column($data['row_KPIMetrics'], 'KPIMetrics'));
        $data['rows'] = $this->Goodbad_m->SelectDataGood($Business,$year);
		$data['rows_period'] = $this->Goodbad_m->SelectDataGoodMinPeriod($Business,$year);		
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
        //echo '<pre/>';print_r( $data['rows']);exit();
        //$data['main_content'] = $this->load->view('kpi_report', $data, TRUE);
        $this->load->view('kpi_good', $data);
    }
	
	 public function kpi_good_ajax() {
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
        
        $data['row_business'] = $this->Goodbad_m->selectBusinessGood();
        $data['row_cyear'] = $this->Goodbad_m->selectCYEARGood();
        
        $data['row_count'] = $this->Goodbad_m->SelectCountGood($Business,$year, $KPIMetrics);
        $data['row_KPI_Business'] = $this->Goodbad_m->SelectKPIBusinessGood($Business,$year, $KPIMetrics);
        $data['row_KPIDriven'] = $this->Goodbad_m->SelectKPIDrivenGood($Business,$year, $KPIMetrics);
        $data['row_KPIMetrics'] = $this->Goodbad_m->SelectKPIMetricsGood($Business,$year , $KPIMetrics);
        $data['rows'] = $this->Goodbad_m->SelectDataGood($Business,$year, $KPIMetrics);
		$data['rows_period'] = $this->Goodbad_m->SelectDataGoodMinPeriod($Business,$year);		
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
         // echo '<pre/>'; print_r( $data['rows']); exit();
        //$data['main_content'] = $this->load->view('kpi_report', $data, TRUE);
        $this->load->view('kpi_good_ajax_test', $data);
    }
	
	
	public function kpi_good_ajax_single() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';

        $data['Business'] 		= $this->input->get_post('Business',TRUE);
		$Business = $data['Business'];
		$data['ValueDriver'] 	= str_replace("___", "&", $this->input->get_post('ValueDriver',TRUE));
		$data['KPIMetrics'] 	= str_replace("___", "&", $this->input->get_post('KPIMetrics',TRUE));
		$data['ChartType'] 		= $this->input->get_post('ChartType',TRUE);
		$data['CYEAR'] 			= $this->input->get_post('CYEAR',TRUE);
		$year = array();
        $year = explode(',', $data['CYEAR']);
        $data['rows'] = $this->Goodbad_m->selectChartDataGood($data['Business'] , $data['ValueDriver'], $data['KPIMetrics'], $data['CYEAR']);
		$data['rows_period'] = $this->Goodbad_m->SelectDataGoodMinPeriod($Business,$year);		
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
 //echo '<pre/>';print_r( $data['rows']);exit();		
        $this->load->view('kpi_good_ajax_single', $data);
    }
	
	
	
	public function kpi_bad_ajax_single() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';

        $data['Business'] 		= $this->input->get_post('Business',TRUE);
		$Business = $data['Business'];
		$data['ValueDriver'] 	= str_replace("___", "&", $this->input->get_post('ValueDriver',TRUE));
		$data['KPIMetrics'] 	= str_replace("___", "&", $this->input->get_post('KPIMetrics',TRUE));
		$data['ChartType'] 		= $this->input->get_post('ChartType',TRUE);
		$data['CYEAR'] 			= $this->input->get_post('CYEAR',TRUE);
		$year = array();
        $year = explode(',', $data['CYEAR']);
        $data['rows'] = $this->Goodbad_m->selectChartDataBad($data['Business'] , $data['ValueDriver'], $data['KPIMetrics'], $data['CYEAR']);
		
		$data['rows_period'] = $this->Goodbad_m->SelectDataBadMinPeriod($Business,$year);		
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
		//echo '<pre/>';print_r( $data['rows']);exit();		
        $this->load->view('kpi_bad_ajax_single', $data);
    }
	
	public function kpi_bad_ajax() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report Bad';

        $Business = $this->input->post('Business',TRUE);
        $CYEAR = $this->input->post('CYEAR',TRUE);
		$data['charttype'] = $this->input->post('charttype',TRUE);
		$KPIMetrics = $this->input->post('KPIMetrics',TRUE);       
		
        $year = array();
        $year = explode(',', $CYEAR);
    
        
        $data['row_business'] = $this->Goodbad_m->selectBusinessBad();
        $data['row_cyear'] = $this->Goodbad_m->selectCYEARBad();
        
        $data['row_count'] = $this->Goodbad_m->SelectCountBad($Business,$year, $KPIMetrics);
        $data['row_KPI_Business'] = $this->Goodbad_m->SelectKPIBusinessBad($Business,$year, $KPIMetrics);
        $data['row_KPIDriven'] = $this->Goodbad_m->SelectKPIDrivenBad($Business,$year, $KPIMetrics);
        $data['row_KPIMetrics'] = $this->Goodbad_m->SelectKPIMetricsbad($Business,$year , $KPIMetrics);
        $data['rows'] = $this->Goodbad_m->SelectDataBad($Business,$year, $KPIMetrics);
		$data['rows_period'] = $this->Goodbad_m->SelectDataBadMinPeriod($Business,$year);		
		if( (substr($data['rows_period'][0]['CPERIOD'],-2)) == '01'){
			$year_1 = substr($data['rows_period'][0]['CPERIOD'],0,4)-1;
			$data['min_period'] =  $year_1.'12';
		}else{
			$data['min_period'] = $data['rows_period'][0]['CPERIOD']-1;
		}
          //echo '<pre/>'; print_r( $data['row_count']); exit();
        //$data['main_content'] = $this->load->view('kpi_report', $data, TRUE);
       // $this->load->view('kpi_report_ajax_anomaly', $data);
		
		
		$this->load->view('kpi_bad_ajax_test', $data);
		/*if(!empty($KPIMetrics)){
			$this->load->view('kpi_report_ajax_anomaly_kpi_single', $data);
		}else{
			$this->load->view('kpi_report_ajax_anomaly', $data);
		}	*/	
    }

}
