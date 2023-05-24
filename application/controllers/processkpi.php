<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Processkpi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Processkpi_m');
    }

    public function index() {
        $data = array();
		$data['userid'] = $this->session->userdata('userid');
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI';

        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';

        $data['allbusiness']    		= $this->Processkpi_m->doLoadBusiness($data['userid']);
        $data['allvaluedriver'] 		= $this->Processkpi_m->doLoadValueDriver($data['userid']);
        $data['allkpi']         		= $this->Processkpi_m->doLoadKPI($data['userid']);
        $data['allyears']       		= $this->Processkpi_m->doLoadtYears();
		$data['businesskpicount']       = $this->Processkpi_m->doLoadKPICount($data['userid']);

        $data['main_content'] = $this->load->view('processkpi/dashboard', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function KpiGraphicalDashboard() {
        $data = array();
		$data['userid'] = $this->session->userdata('userid');
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI';

        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';

        $data['business']   = $this->Processkpi_m->doLoadFactoryBusiness();

        $data['allbusiness']    		= $this->Processkpi_m->doLoadBusiness($data['userid']);
        $data['allvaluedriver'] 		= $this->Processkpi_m->doLoadValueDriver($data['userid']);
        $data['allkpi']         		= $this->Processkpi_m->doLoadKPI($data['userid']);
        $data['allyears']       		= $this->Processkpi_m->doLoadtYears();
		$data['businesskpicount']       = $this->Processkpi_m->doLoadKPICount($data['userid']);

        $data['main_content'] = $this->load->view('processkpi/kpi_dashboard', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function getAllKpiDashboardDate(){
        $business = 'Foods Facotry';
        $dashboard_data   = $this->Processkpi_m->doLoadFoodFactoryKpiDashboardDate($business);
        echo json_encode($dashboard_data);
    }

    public function filterKpiDashboardDate(){
        $business = $this->input->post('business', TRUE);
        if ($business == 'Foods (Local)'){
            $business = 'Foods Facotry';
            $dashboard_data   = $this->Processkpi_m->doLoadFoodFactoryKpiDashboardDate($business);
        }

        if ($business == 'Flour'){
            $business = 'Flour Facotry';
            $dashboard_data   = $this->Processkpi_m->doLoadFlourFactoryKpiDashboardDate($business);
        }
        echo json_encode($dashboard_data);
    }

    public function individualKpiData(){
        $data = array();
        $data['page'] = 'individual_kpi_data';
        $data['page_title'] = 'Individual KPI Dashboard';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['business_name'] = '';
        $data['user_name'] = '';

        $data['business']   = $this->Processkpi_m->doLoadFactoryBusiness();
        $data['user'] 		= $this->Processkpi_m->doLoadFactoryUser();

        $data['userInfo'] = [];
        $data['individual_dashboard'] = [];

        if ($_POST){
            $data['business_name'] = $this->input->post('BusinessName', TRUE);
            $data['user_name'] = $this->input->post('ResponsiblePerson', TRUE);
            $business_individual_dashboard = $this->Processkpi_m->doLoadBusinessIndividualDashBoard($data['business_name'], $data['user_name']);
            //echo "<pre />";print_r($business_individual_dashboard); exit();
            $data['userInfo'] = $business_individual_dashboard['userInfo'];
            $data['individual_dashboard'] = $business_individual_dashboard['individual_dashboard'];
        }

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('processkpi/individual_kpi_data', $data, TRUE);
        $this->load->view('index', $data);

    }

    public function individualKpiDashboard(){
        $data = array();
        $data['page'] = 'individual_kpi_dashboard';
        $data['page_title'] = 'Individual KPI Dashboard';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['business_name'] = '';
        $data['user_name'] = '';

        $data['business']   = $this->Processkpi_m->doLoadFactoryBusiness();
        $data['user'] 		= $this->Processkpi_m->doLoadFactoryUser();

        $data['userInfo'] = [];
        $data['individual_dashboard'] = [];

        if ($_POST){
            $data['business_name'] = $this->input->post('BusinessName', TRUE);
            $data['user_name'] = $this->input->post('ResponsiblePerson', TRUE);
            $business_individual_dashboard = $this->Processkpi_m->doLoadBusinessIndividualDashBoardData($data['business_name'], $data['user_name']);
            $data['userInfo'] = $business_individual_dashboard['userInfo'];
            $data['individual_dashboard'] = $business_individual_dashboard['individual_dashboard'];
            //echo "<pre />"; print_r($data['individual_dashboard']); exit();
        }

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('processkpi/individual_kpi_dashboard', $data, TRUE);
        $this->load->view('index', $data);

    }

	
	public function districtkpi() {
        $data = array();
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI';
		$data['userid'] = $this->session->userdata('userid');
		
        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';
		
		$data['allbusiness']    		= $this->Processkpi_m->doLoadBusiness($data['userid']);
		//print_r($data['allbusiness'][0]['Business']); exit();
		if(!empty($_POST['business'])){
			$data['business'] = $this->input->post("business", TRUE);
		}else{
			$data['business'] = $data['allbusiness'][0]['Business'];
		}
		
		$data['allbusiness']   = $this->Processkpi_m->doLoadBusinessDistrict($data['userid']);
		$datas = $this->Processkpi_m->doLoadDistrictWiseSales($data['business']);
			$data['districtwisesals'] = $datas['districtwisesales'];
			$data['category'] = $datas['category'];
			$data['monthwisedata'] = $datas['monthwisedata'];

        $data['main_content'] = $this->load->view('processkpi/districtkpi', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    public function loadreport_ajax() {
        $data = array();
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI';

        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';

        $data['valuedriver']    = $this->input->post("valuedriver", TRUE);
        $data['kpicode']         = $this->input->post("kpicode", TRUE);
        $data['business']       = $this->input->post("business", TRUE);
        $data['year']           = $this->input->post("years", TRUE); //exit();
        $data['startfromzero']  = $this->input->post("startfromzero", TRUE); //exit();
        $data['type']  = $this->input->post("type", TRUE); //exit();
		
        $datas = $this->Processkpi_m->doLoadData($data['valuedriver'],$data['kpicode'],$data['business'],$data['year'],'', $data['type']);
            $data['valuedriver']    = $datas['valuedriver'];
            $data['kpi']            = $datas['kpi'];
            $data['kpidetails']     = $datas['kpidetails'];
            $data['kpidata']        = $datas['kpidata'];
            $data['businesslist']   = $datas['businesslist'];
            $data['kpicount']       = $datas['kpicount'];
			$data['rangetable']     = $datas['rangetable'];
            //$data['kpicount']       = $datas['kpicount'];
        //echo "<pre />"; print_r($datas['kpidata']); exit();
        if($data['type'] == 'normal'){
            $this->load->view('processkpi/view_ajax', $data);          
        }else if($data['type'] == 'anomaly'){
            $this->load->view('processkpi/view_ajax_anomaly', $data);          
        }else if($data['type'] == 'anomaly_ai'){
            $this->load->view('processkpi/view_ajax_anomaly_ai', $data);          
        }

    }

    public function loadreport_ajax_test() {
        $data = array();
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI';

        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';

        $data['valuedriver']    = $this->input->get_post("valuedriver", TRUE);
        $data['kpicode']         = $this->input->get_post("kpicode", TRUE);
        $data['business']       = $this->input->get_post("business", TRUE);
        $data['year']           = $this->input->get_post("years", TRUE); //exit();
        $data['startfromzero']  = $this->input->get_post("startfromzero", TRUE); //exit();

        $datas = $this->Processkpi_m->doLoadData($data['valuedriver'],$data['kpicode'],$data['business'],$data['year']);
            $data['valuedriver']    = $datas['valuedriver'];
            $data['kpi']            = $datas['kpi'];
            $data['kpidetails']     = $datas['kpidetails'];
            $data['kpidata']        = $datas['kpidata'];
            $data['businesslist']   = $datas['businesslist'];
			
        //echo "<pre />"; print_r($datas); exit();

        $this->load->view('processkpi/view_ajax', $data);          

    }

    public function loadreport_ajax_single() {
        $data = array();
        $data['page'] = 'processkpi';
        $data['page_title'] = 'Process KPI Details';
		$data['userid'] = $this->session->userdata('userid');
        $data['header'] = '';
        $data['menubar'] = '';
        $data['footer'] = '';

        $data['kpicode']         = $this->input->post("kpicode", TRUE);
        $data['business']       = $this->input->get_post("business", TRUE);
        $data['year']           = $this->input->post("years", TRUE); //exit();
        $data['startfromzero']  = $this->input->post("startfromzero", TRUE); //exit();
		
		$data['sendemail']		= 'Y';

        $datas = $this->Processkpi_m->doLoadData("",$data['kpicode'],$data['business'],$data['year'], 'single','normal');
            $data['valuedriver']    = $datas['valuedriver'];
            $data['kpi']            = $datas['kpi'];
            $data['kpidetails']     = $datas['kpidetails'];
            $data['kpidata']        = $datas['kpidata'];
            $data['businesslist']   = $datas['businesslist'];
            $data['kpipivotdata']   = $datas['kpipivotdata'];
            $data['kpiconfiguration']   = $datas['kpiconfiguration'];
        //echo "<pre />"; print_r($datas); exit();
        $this->load->view('processkpi/view_ajax_single', $data);          

    }

    public function processKpiEntry()
    {
        $data = array();
        $data['page'] = 'process_kpi_entry';
        $data['page_title'] = 'Process KPI Entry';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['allvaluedriver'] = $this->Processkpi_m->doLoadValueDriver($data['userid']);
        // $data['allsubvaluedriver'] = $this->Processkpi_m->doLoadSubValueDriver($data['userid']);

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);

        $data['main_content'] = $this->load->view('processkpi/process_kpi_entry', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function getSubValueDriver()
    {
        $valueDriverCode = $this->input->post('ValueDriverCode', TRUE);
        $data['allsubvaluedriver'] = $this->Processkpi_m->doLoadSubValueDriver($valueDriverCode);
        // echo "<pre/>";print_r($data['allsubvaluedriver']);exit();

        echo json_encode($data['allsubvaluedriver']);
    }

    public function getKpi()
    {
        $subValueDriverCode = $this->input->post('SubValueDriverCode', TRUE);
        $data['kpicode'] = $this->Processkpi_m->doLoadKPICode($subValueDriverCode);

        echo json_encode($data['kpicode']);
    }

    public function getKpiComponent()
    {
        $kpicode = $this->input->post('kpicode', TRUE);
        $data['kpicomponent'] = $this->Processkpi_m->doLoadKpiComponent($kpicode);
        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();

        echo json_encode($data);
    }

    public function getKpiValueIfExists()
    {
        $kpiCode = $this->input->post('KPICode', true);
        $componentCode = $this->input->post('ComponentCode', true);
        $business = $this->input->post('Business', true);
        $period = $this->input->post('Month', true);

        if (isset($kpiCode, $componentCode, $business, $period) && !empty($kpiCode . $componentCode . $business . $period)) {
            $data['processkpidata'] = $this->Processkpi_m->checkDuplicateEntry($kpiCode, $componentCode, $business, $period);
        }
        if ($data['processkpidata']['success'] == 1) {
            echo json_encode($data['processkpidata']);
        } else {
            echo json_encode(false);
        }
    }

    public function processKpiEntrySave()
    {
        $data = array();
        $data['userid'] = mssql_escape($this->session->userdata('userid'), true);
        $data['KPICode'] = mssql_escape($this->input->post('kpi'), true);
        $data['ComponentCode'] = mssql_escape($this->input->post('component'), true);
        $data['Business'] = mssql_escape($this->input->post('business'), true);
        $month = mssql_escape($this->input->post('month'), true);
        $data['Period'] = str_replace("-", "", $month);
        $data['Value'] = mssql_escape($this->input->post('value'), true);
        $data['LM'] = mssql_escape($this->input->post('lm'), true);
        $data['SPLY'] = mssql_escape($this->input->post('sply'), true);
        $data['EntryBy'] = $data['userid'];

        if (isset($data) && !empty($data)) {
            foreach ($data['ComponentCode'] as $key => $componentCode) {
                $formdata[$key]['KPICode'] = $data['KPICode'];
                $formdata[$key]['ComponentCode'] = $componentCode;
                $formdata[$key]['Business'] = $data['Business'][$key];
                $formdata[$key]['Period'] = $data['Period'][$key];
                $formdata[$key]['Value'] = $data['Value'][$key];
                $formdata[$key]['LM'] = $data['LM'][$key];
                $formdata[$key]['SPLY'] = $data['SPLY'][$key];
                $formdata[$key]['EntryBy'] = $data['EntryBy'];
            }

            // echo '<pre>';
            // print_r($formdata);
            // die;

            $insertData = $this->Processkpi_m->doInsertProcessKpiEntryData($formdata);
            if ($insertData == true) {
                $msg['message'] = "Process KPI Successfully Added.";
            } else {
                $msg['message'] = "Something went wromg. Pleasre try again.";
            }
            $this->session->set_userdata($msg);
        }
        redirect(base_url('processkpi/processKpiEntry'));
    }

    public function yearlyprocesskpientry(){
        $data = array();
        $data['page'] = 'yearly_process_kpi_entry';
        $data['page_title'] = 'Yearly Process KPI Entry';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['allvaluedriver'] = $this->Processkpi_m->doLoadValueDriver($data['userid']);
        // $data['allsubvaluedriver'] = $this->Processkpi_m->doLoadSubValueDriver($data['userid']);

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);

        $data['main_content'] = $this->load->view('processkpi/yearly/yearly_process_kpi_entry', $data, TRUE);
        $this->load->view('index', $data);

        //echo "<pre />";print_r('ok'); exit();
    }

    public function processYearlyKpiEntrySave(){
        $data_array = array();
        $component = $_POST['component'];
        $value = $_POST['value'];
       // $lm = $_POST['lm'];
        $sply = $_POST['sply'];
        $data['userid'] = mssql_escape($this->session->userdata('userid'), true);

        foreach( $value as $val){
            if (!empty($val)) {
                if (!is_numeric($val)) {
                    $msg['message'] = "Please Inter Numeric value";
                    $msg['type'] = "error";
                    $this->session->set_userdata($msg);
                    return redirect(base_url('/processkpi/yearlyprocesskpientry'));
                }
            }
        }
        //echo "<pre />";print_r('ok'); exit();
//        foreach( $lm as $val2){
//            if( !is_numeric( $val2)){
//                $msg['message'] = "Please Inter Numeric value";
//                $this->session->set_userdata($msg);
//                return redirect(base_url('/processkpi/yearlyprocesskpientry'));
//            }
//        }

       // echo "<pre />";print_r($sply); exit();
        foreach( $sply as $val3){
            if (!empty($val3)) {
                if (!is_numeric($val3)) {
                    $msg['message'] = "Please Inter Numeric value";
                    $msg['type'] = "error";
                    $this->session->set_userdata($msg);
                    return redirect(base_url('/processkpi/yearlyprocesskpientry'));
                }
            }
        }
        foreach ($component as $row => $comp)
        {
            if ($_POST['value'][$row] !== ''){
                $val = $_POST['value'][$row];
            }else{
                $val = null;
            }

            if ($_POST['sply'][$row] !== ''){
                $SPLY = $_POST['sply'][$row];
            }else{
                $SPLY = null;
            }

            $data_array [] = [
                'KPICode' => $_POST['kpi'],
                'ComponentCode' => $_POST['component'][$row],
                'Business' => $_POST['Business'],
                'Period' => $_POST['month'][$row],
                'Value' => $val,
               // 'LM' => $_POST['lm'][$row],
                'LM' => null,
                'SPLY' => $SPLY,
                'EntryBy' => $data['userid'],
                'EntryDate' => date('Y-m-d H:i:s'),
                'EditedBy' => $data['userid'],
                'EditedDate' => date('Y-m-d H:i:s'),
            ];
        }

        //echo "<pre />";print_r($data_array); exit();

        foreach ($data_array as $value){
            $this->Processkpi_m->deleteKPIBYKPICodeYear($value);
        }

        foreach ($data_array as $item){
            $this->Processkpi_m->insertKpi($item);
        }

        $msg['message'] = "Process KPI Successfully Added.";
        $msg['type'] = 'success';
        $this->session->set_userdata($msg);
        return redirect('/processkpi/yearlyprocesskpientry');

    }

    public function getAllKpiComponent(){
        $kpicode = $this->input->post('kpicode', TRUE);
        $year = $this->input->post('year', TRUE);
        $Business = $this->input->post('Business', TRUE);
        $data['kpicomponent'] = $this->Processkpi_m->doLoadKpiComponent($kpicode);
        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();

        $monthssss = $this->Processkpi_m->getAllMonth($year);
        foreach ($monthssss as $m){
            $months[] = $m['Period'];
        }

        $data['kpi_data'] = $this->Processkpi_m->getAllKPIData($kpicode, $months, $Business);
        //echo "<pre />";print_r($data['kpi_data']  ); exit();

//        for ($m=1; count($months) <= 12; $m++) {
//            $months[] = date('Ym', mktime(0,0,0,$m, 1, '2022'));
//        }

        //echo "<pre />";print_r($months); exit();
        $result = [];
        foreach ($months as $key => $month){
           // echo "<pre />";print_r($month); exit();
            $value = array_filter($data['kpi_data'],function ($item) use ($month){
                return $item['Period'] === $month;
            });

            $value = array_values($value);
            //echo "<pre />";print_r($value); exit();
//            if (!empty($value[0]['Value'])){
//                $val = number_format($value[0]['Value'], 2);
//            }else{
//                $val = NULL;
//            }
//
//            if (!empty($value[0]['SPLY'])){
//                $SPLY = number_format($value[0]['Value'], 2);
//            }else{
//                $SPLY = NULL;
//            }

           // echo "<pre />";print_r($data['kpicomponent']); exit();
            if (!empty($data['kpicomponent'])){
                $kpicomponent = $data['kpicomponent'][0]['Title'];
                $ComponentCode = $data['kpicomponent'][0]['ComponentCode'];
            }else{
                $kpicomponent = '';
                $ComponentCode = '';
            }

            $result[] = [
                'YearMonth'=>$month,
                'Title'=>$kpicomponent,
                'Business'=>$Business,
                'ComponentCode'=>$ComponentCode,
                'KPICode'=>$kpicode,
                'LM'=>isset($value[0]['LM']) ? $value[0]['LM'] : null,
                'Period'=>isset($value[0]['Period']) ? $value[0]['Period'] : '',
                'SPLY'=>isset($value[0]['SPLY']) ? $value[0]['SPLY'] : null,
                'Value'=>isset($value[0]['Value']) ? $value[0]['Value'] : null,
            ];
        }

        $data['result'] = $result;

        //echo "<pre />";print_r($data['result']); exit();

        $business_string = '';
        foreach ($data['Business_rows'] as $item){
            if ($item["Business"] === $Business){
                $business_string .= "<option value=".$item["Business"]." selected>".$item["Business"]."</option>";
            }else{
                $business_string .= "<option value=".$item["Business"].">".$item["Business"]."</option>";
            }
        }

        $string = '';
        foreach ($data['result'] as $dataval){
            $string .= "<tr>
                           <td><select class='span10' name='component[]' id='component'><option value=".$dataval["ComponentCode"].">".$dataval["Title"]."</option></select></td>
                           <td><input type='text' name='month[]' class='span10 month' id='month' value=".$dataval["YearMonth"]." readonly></td>
                           <td><input type='number' step='any' name='value[]' class='span10 value' id='value' oninput='validate(this)' value=".$dataval["Value"]."></td>
                           <td><input type='number' name='sply[]' class='span10 sply' id='sply' step='any' oninput='validate(this)' value=".$dataval["SPLY"]."></td>
                       </tr>
                       
                      <script>
                      function validate(input){
                         var number = parseFloat(input.value);
                                if( number == input.value && input.value.length <= number.toFixed(6).length ){
                                     console.log( 'valid' );   
                                }
                                else {
                                     console.warn( 'invalid' );   
                                }
                              }
                        </script> 
                       ";
        }

        $data['string'] = $string;
        echo json_encode($data);
    }

    public function getAllKpiBusiness(){
        $data['Business_rows'] = $this->Processkpi_m->getAllBusiness();
        echo json_encode($data);
    }


}
