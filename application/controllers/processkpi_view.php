<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class processkpi_view extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Processkpi_m');
    }

    public function loadreport_ajax_single() {
        $data = array();
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI Details';

        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';

        //$data['valuedriver']    = $this->input->post("valuedriver", TRUE);
        $data['kpicode']        = $this->input->get_post("kpicode", TRUE);
        $data['business']       = $this->input->get_post("business", TRUE);
        $data['year']           = $this->input->get_post("years", TRUE); //exit();
        $data['startfromzero']  = $this->input->get_post("startfromzero", TRUE); //exit();

        $datas = $this->Processkpi_m->doLoadData("",$data['kpicode'],$data['business'],$data['year'], 'single','normal');
            $data['valuedriver']    = $datas['valuedriver'];
            $data['kpi']            = $datas['kpi'];
            $data['kpidetails']     = $datas['kpidetails'];
            $data['kpidata']        = $datas['kpidata'];
            $data['businesslist']   = $datas['businesslist'];
            $data['kpipivotdata']   = $datas['kpipivotdata'];
            $data['kpiconfiguration']   = $datas['kpiconfiguration'];
        //echo "<pre />"; print_r($datas); exit();
        $this->load->view('processkpi/view_ajax_single_view', $data);          

    }
}
