<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_m');
        $this->load->model('Compare_m');
    }

    public function index() {
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
        $data['Business'] = $Business = '';
        $data['charttype'] = 'line'; 
        $data['row_business'] = $this->Common_m->selectBusiness();
        $data['row_cyear'] = $this->Common_m->selectCYEAR();
        $data['valuedriven'] = $this->Compare_m->doLoadValueDriven($data['userid']);

        $data['kpilist'] = $this->Compare_m->doLoadKPI($data['userid'], "");
        $data['yearstring']   = "";
        if(!empty($_POST)){
            // print_r($_POST['KPIMetrics']); 
            $data['Business'] = $Business           = $this->input->post('Business',TRUE);
            $CYEAR              = $this->input->post('CYEAR',TRUE);
            $data['charttype']  = $this->input->post('charttype',TRUE);
            $data['KPIMetrics'] = $KPIMetrics         = $this->input->post('KPIMetrics',TRUE);
            $data['ValueDriver'] = $ValueDriver        = $this->input->post('ValueDriver',TRUE);
            //print_r($KPIMetrics); exit();
            if(!empty($data['ValueDriver'])){
                $data['kpilist'] = $this->Compare_m->doLoadKPI($data['userid'], $data['ValueDriver']);
            }

            $data['yearstring'] = $yearstring = "";
            for($i = 0; $i < count($CYEAR); $i++){
                $data['yearstring'] = $yearstring =  $yearstring . $CYEAR[$i]   . ',';
            }
            
            $matricsstring = "";
            for($i = 0; $i < count($KPIMetrics); $i++){
                $matricsstring =  $matricsstring . $KPIMetrics[$i]   . ',';
            }
            //echo  substr($matricsstring,0,-1);
            $data['comparedata'] = $this->Compare_m->doLoadKPICompareData($data['userid'], $Business, $ValueDriver, substr($matricsstring,0,-1), $data['yearstring'] =  substr($yearstring,0,-1));

        }

        $year = array();
        foreach ($data['row_cyear'] AS $y){
            $year[] = $y->CYEAR;
        }
        $this->load->view('compare_report', $data);
    }

    public function loadkpi(){
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';
        $data['userid'] = $this->session->userdata('userid');
        $valuedrivencode     = $this->input->post("valuedrivencode", true);
        $data['valuedriven'] = $this->Compare_m->doLoadKPI($data['userid'], $valuedrivencode);
        echo json_encode($data['valuedriven']);

    }

    public function kpi_report_ajax() {
        //echo '<pre/>';print_r($_POST);//exit();
        $data = array();
        $data['page'] = 'kpi_report';
        $data['page_title'] = 'KPI Report';

        $Business           = $this->input->post('Business',TRUE);
        $CYEAR              = $this->input->post('CYEAR',TRUE);
        $data['charttype']  = $this->input->post('charttype',TRUE);
        $KPIMetrics         = $this->input->post('KPIMetrics',TRUE);
        $ValueDriver        = $this->input->post('ValueDriver',TRUE);
        $year               = array();
        $year               = explode(',', $CYEAR);

        $this->load->view('compare_kpi_report_ajax', $data);
    }



}
