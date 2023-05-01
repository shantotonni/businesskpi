<?php

class Kpi_m extends CI_Model {
    
    
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $CI = & get_instance();
        $CI->db = $this->load->database('sm', true);
        /*  SELECT * FROM GroupKPIValueDriver 
            SELECT * FROM GroupKPIMetrics     
            SELECT * FROM GroupKPIDetailsOutput
        */
    }
    
    function doUpdateCalculationKPIOutput($KPIMetricsCode){
        $sql = "EXEC usp_doUpdateCalculationKPIOutput '$KPIMetricsCode' "; 
        $query = $this->db->query($sql);
         return true; 
    }

    function select_ValueDriverCode($EmpCode){
        $sql = "SELECT * FROM GroupKPIValueDriver ORDER BY ValueDriverCode ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function select_GroupKPIDetailsOutput($EmpCode){
        $sql = "SELECT * FROM GroupKPIDetailsOutput  ORDER BY ValueDriverCode ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }  
    }
    
    function selectGroupKPIDetailsOutputSingle($ValueDriverCode,$KPIMetricsCode,$CPERIOD,$Business){
        $sql = "SELECT A.ValueDriverCode,A.KPIMetricsCode,A.Business,A.CYEAR,RIGHT(A.CPERIOD,2) AS CPERIOD,A.A,A.ATXT,A.B,A.BTXT,A.C,A.CTXT,A.D,A.DTXT,A.IndexValue FROM GroupKPIDetailsOutput A "
                . "WHERE A.ValueDriverCode = '$ValueDriverCode' AND A.KPIMetricsCode = '$KPIMetricsCode'"
                . "AND A.CPERIOD = '$CPERIOD' AND A.Business = '$Business'";
        //exit();
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function selectGroupKPIMetrics($ValueDriverCode){
        $sql = "SELECT * FROM GroupKPIMetrics WHERE  ValueDriverCode = '$ValueDriverCode' ORDER BY KPIMetricsCode ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
    }
    
    function select_kpi_info($EmpCode) {
        $sql = "SELECT * FROM GroupKPIValueDriver";
        $query = $this->db->query($sql);
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $sql1 = "SELECT * FROM GroupKPIMetrics WHERE ValueDriverCode = '" . $value['ValueDriverCode'] . "'";
            $query1 = $this->db->query($sql1);
            $query1 = $query1->result_array();
            $query[$key]['GroupKPIMetrics'] = $query1;
            /*
            $sql2 = "SELECT * FROM GroupKPIDetailsOutput WHERE ValueDriverCode = '" . $value['ValueDriverCode'] . "'";
            $query2 = $this->db->query($sql2);
            $query2 = $query2->result_array();
            $query[$key]['GroupKPIDetailsOutput'] = $query2;
            */
        }
        return $query;		
    }
    
    function select_kpi_segments() {
        $sql = "SELECT * FROM GroupKPIMetrics";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function select_Business() {
        $sql = "SELECT DISTINCT Business FROM GroupKPIDetailsOutput ORDER BY Business";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    
    function selectLastValueDriverCode($ValueCode){
        $sql = "SELECT MAX(CAST(RIGHT(ValueDriverCode,3) AS INT)) AS ValueDriverCode FROM GroupKPIValueDriver";
        //WHERE PlantCode='$PlantCode' AND LEFT(Period,4) = LEFT('$Period',4) ORDER BY MAX(CAST(RIGHT(ReceiveNo,6) AS INT))
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function selectLastKPIMetricsCode($MetricsCode){
        $sql = "SELECT MAX(CAST(RIGHT(KPIMetricsCode,3) AS INT)) AS KPIMetricsCode FROM GroupKPIMetrics";
        //WHERE PlantCode='$PlantCode' AND LEFT(Period,4) = LEFT('$Period',4) ORDER BY MAX(CAST(RIGHT(ReceiveNo,6) AS INT))
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function insert($data, $table) {
        $this->db->insert($table, $data);
        return true;
    } 
    
    
    function selectKpiDetails($ValueDriverCode){
        $sql = "SELECT * FROM  GroupKPIValueDriver WHERE ValueDriverCode = '$ValueDriverCode'";
        $query = $this->db->query($sql);
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $sql2 = "SELECT * FROM GroupKPIMetrics
                WHERE ValueDriverCode = '" . $value['ValueDriverCode'] . "'  ORDER BY KPIMetricsCode";
            $query2 = $this->db->query($sql2);
            $query2 = $query2->result_array();
            $query[$key]['GroupKPIMetrics'] = $query2;
			
        }
        return $query;
    }
    
    function duplicate_checking($id, $field, $table) {
        $sql = "SELECT * FROM $table WHERE $field = '$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    
    function duplicate_checking_GroupKPIDetailsOutput($ValueDriverCode,$KPIMetricsCode,$CPERIOD,$Business) {
        $sql = "SELECT * FROM GroupKPIDetailsOutput WHERE ValueDriverCode = '$ValueDriverCode' AND KPIMetricsCode = '$KPIMetricsCode'"
                . "AND CPERIOD = '$CPERIOD' AND Business = '$Business'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $query->result_array();
        }else{
            return FALSE;
        }
    }
    
    function update_GroupKPIDetailsOutput($data){
        // echo '<pre/>';print_r($data);exit();
            $ValueDriverCode = $data['ValueDriverCode'];
            $KPIMetricsCode = $data['KPIMetricsCode'];
            $Business = $data['Business'];
            $CYEAR = $data['CYEAR'];
            $CPERIOD = $data['CPERIOD'];
            $A = $data['A'];
            $ATXT = $data['ATXT'];
            $B = $data['B']; 
            $BTXT = $data['BTXT'];
            $C = $data['C'];
            $CTXT = $data['CTXT']; 
            $D = $data['D'];
            $DTXT = $data['DTXT']; 
            $IndexValue = $data['IndexValue'];
        $sql = "UPDATE GroupKPIDetailsOutput SET A = '$A', ATXT = '$ATXT', B = '$B',C = '$C', CTXT = '$CTXT', D = '$D', DTXT = '$DTXT' WHERE ValueDriverCode = '$ValueDriverCode' "
                . "AND KPIMetricsCode = '$KPIMetricsCode' AND Business = '$Business' AND CPERIOD = '$CPERIOD' ";
		//echo $sql ;exit();
        $query = $this->db->query($sql);
        return true;
    }
            
    function edit_option_GroupKPIValueDriver($data, $id, $field, $table) {
        //echo '<pre/>';print_r($data);exit();
        $ValueDriverCode = $id;
        $ValueDriverName = $data['ValueDriverName'];
        $STATUS = $data['STATUS'];
        $ReportStatus = $data['ReportStatus'];
        $sql = "UPDATE GroupKPIValueDriver SET ValueDriverName = '$ValueDriverName', STATUS = '$STATUS', ReportStatus = '$ReportStatus' WHERE ValueDriverCode = '$ValueDriverCode' ";
		//echo $sql ;exit();
        $query = $this->db->query($sql);
        return true;
    }
    
    function edit_option_GroupKPIMetrics($data, $id, $field, $table) { 
        //echo '<pre/>';print_r($data);
        $ValueDriverCode = $id;
        $KPIMetricsCode = $data['KPIMetricsCode'];
        $KPIMetricsName = $data['KPIMetricsName'];
        $CCalculation = $data['CCalculation'];
        $DCalculation = $data['DCalculation'];
        $IndexValueCalculation = $data['IndexValueCalculation'];
        $sql = "UPDATE GroupKPIMetrics SET KPIMetricsName = '$KPIMetricsName', CCalculation = '$CCalculation', DCalculation = '$DCalculation' , IndexValueCalculation = '$IndexValueCalculation' WHERE ValueDriverCode = '$ValueDriverCode' AND KPIMetricsCode = '$KPIMetricsCode' ";
		//echo $sql ;exit();
        $query = $this->db->query($sql);
        return true;
    }
    
    function selectGroupKPIDetailsOutputCount($table,$search){
        $sql = "SELECT COUNT(*) as num FROM GroupKPIDetailsOutput A
                INNER JOIN GroupKPIValueDriver B ON A.ValueDriverCode = B.ValueDriverCode
                INNER JOIN GroupKPIMetrics C ON A.KPIMetricsCode = C.KPIMetricsCode
                WHERE A.ValueDriverCode LIKE '$search' OR A.KPIMetricsCode LIKE '$search' OR A.Business LIKE '$search' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    function selectGroupKPIDetailsOutputData($vpb_start_page,$vpb_page_limit,$search){
        $vpb_end_page = $vpb_start_page+$vpb_page_limit;
        $sql = "SELECT * FROM ( 
                    SELECT A.*,B.ValueDriverName,C.KPIMetricsName,ROW_NUMBER() OVER (ORDER BY A.ValueDriverCode) as row
                    FROM GroupKPIDetailsOutput A
                    INNER JOIN GroupKPIValueDriver B ON A.ValueDriverCode = B.ValueDriverCode
                    INNER JOIN GroupKPIMetrics C ON A.KPIMetricsCode = C.KPIMetricsCode
                    WHERE A.ValueDriverCode LIKE '$search' OR A.KPIMetricsCode LIKE '$search' OR A.Business LIKE '$search'
                ) aa
                WHERE aa.row > $vpb_start_page and aa.row <= $vpb_end_page";
        $query = $this->db->query($sql);
        $query = $query->result_array();
        return $query;
    }
    
    
    function select_KPIMetricsCode($KPIMetricsCode){
        $sql = "SELECT * FROM GroupKPIMetrics WHERE KPIMetricsCode = '$KPIMetricsCode'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
	
	function select_CPERIOD($ValueDriverCode,$KPIMetricsCode,$Business,$CYEAR,$CPERIOD){
        $sql = "SELECT * FROM GroupKPIDetailsOutput WHERE ValueDriverCode = '$ValueDriverCode' AND KPIMetricsCode = '$KPIMetricsCode' 
		AND Business = '$Business' AND CYEAR = '$CYEAR'  AND CPERIOD = '$CPERIOD'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

	function selectKPIMetricsCode($KPIMetricsCode){
        $sql = "SELECT * FROM GroupKPIDetailsOutput WHERE KPIMetricsCode = '$KPIMetricsCode'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
	
    // My codes
    public function doLoadAllValueDriver()
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT * FROM ValueDriver";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function addValueDriver($postData)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $valueDriver = $postData['ValueDriver'];
        $sql = "INSERT into ValueDriver(ValueDriver) values('$valueDriver')" ;
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    public function editValueDriver($valueDriverCode)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "SELECT * FROM ValueDriver where ValueDriverCode='$valueDriverCode'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }
    
    
    public function updateValueDriver($valueDriverCode,$valueDriver)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "UPDATE ValueDriver set ValueDriver='$valueDriver' 
                where ValueDriverCode='$valueDriverCode'";
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }
    
    // sub value driver
    public function doLoadAllSubValueDriver()
    {
        $sql = "SELECT SV.*,V.ValueDriver FROM SubValueDriver SV 
                left join ValueDriver V on SV.ValueDriverCode=V.ValueDriverCode";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function addSubValueDriver($postData)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $valueDriver = $postData['ValueDriverCode'];
        $subvalueDriver = $postData['SubValueDriver'];
        $sql = "INSERT into SubValueDriver(ValueDriverCode,SubValueDriver) values('$valueDriver','$subvalueDriver')" ;
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    public function editSubValueDriver($subValueDriverCode)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "SELECT * FROM SubValueDriver where SubValueDriverCode='$subValueDriverCode'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function updateSubValueDriver($postData)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $subValueDriverCode = $postData['SubValueDriverCode'];
        $subValueDriver = $postData['SubValueDriver'];
        $ValueDriverCode = $postData['ValueDriverCode'];

        $sql = "UPDATE SubValueDriver set SubValueDriver='$subValueDriver',ValueDriverCode='$ValueDriverCode' where SubValueDriverCode='$subValueDriverCode'";
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }
    
    // kpi config
    public function doLoadAllKpiConfig()
    {
        $sql = "SELECT K.*,V.ValueDriver,SV.SubValueDriver,R.StaffID FROM KPIConfiguration K
                left join ValueDriver V on V.ValueDriverCode=K.ValueDriverCode
                left join SubValueDriver SV on SV.SubValueDriverCode=K.SubDriverCode
                left join KPIResponsible R on R.KPICode=K.KPICode
                where K.active = 'Y'
                ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return [];
        }
    }
    
    public function getAllSubValueDriver()
    {
        $sql = "SELECT * FROM SubValueDriver";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function addKpiConfig($postData)
    {
        $ValueDriverCode = $postData['ValueDriverCode'];
        $SubDriverCode = $postData['SubDriverCode'];
        $KPIName = $postData['KPIName'];
        $Description = $postData['Description'];
        $Formula = $postData['Formula'];
        $SOURCE = $postData['SOURCE'];
        $active = $postData['active'];
        $Nature = $postData['Nature'];
        $Business = $postData['Business'];

        $title = $postData['title'];
        $valuetype = $postData['valuetype'];
        $charttype = $postData['charttype'];

        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "INSERT into KPIConfiguration(ValueDriverCode,SubDriverCode,KPIName,Description,Formula,
                SOURCE,ChartType,active,Nature,BusinessName) values('$ValueDriverCode','$SubDriverCode','$KPIName',
                '$Description','$Formula','$SOURCE','6','$active','$Nature','$Business')" ;
        $query = $this->db->query($sql);
        // echo '<pre/>';print_r($query);exit();
        if ($query) {
            $sql2 = "SELECT TOP 1 KPICode from KPIConfiguration order by KPICode desc";
            $query = $this->db->query($sql2);
            $lastKpiCode = $query->row();
            $lastKpiCode = $lastKpiCode->KPICode;
            // echo '<pre/>';print_r($lastKpiCode);exit();

            for($i=0; $i<count($title); $i++){
                $ComponentCode = $i+1;
                $Title = mssql_escape($title[$i]);
                $ValueType = $valuetype[$i];
                $ChartType = $charttype[$i];

                $sql3 = "INSERT into KPIConfigurationDetails(KPICode,ComponentCode,Title,ValueType,ChartType,
                AxisYIndex) values('$lastKpiCode','$ComponentCode','$Title',
                '$ValueType','$ChartType','0')" ;
                
                $query = $this->db->query($sql3);
            }

            return true;
        }else{
            return false;
        }
    }

    public function editKpiConfig($KPICode)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $data = [];
        $sql = "SELECT * FROM KPIConfiguration where KPICode='$KPICode'";
        $query = $this->db->query($sql);
        // echo '<pre/>';print_r($query);exit();
        if ($query) {
            $data['KpiConfig'] = $query->result_array();

            $sql2 = "SELECT * FROM KPIConfigurationDetails where KPICode='$KPICode'";
            $query2 = $this->db->query($sql2);
            $data['KpiConfigDetails'] = $query2->result_array();
            return $data;
        }else{
            return [];
        }
    }

    public function updateKpiConfig($postData)
    {
        $KPICode = $postData['KPICode'];
        $ValueDriverCode = $postData['ValueDriverCode'];
        $SubDriverCode = $postData['SubDriverCode'];
        $KPIName = mssql_escape($postData['KPIName']);
        $Description = mssql_escape($postData['Description']);
        $Formula = mssql_escape($postData['Formula']);
        $SOURCE = $postData['SOURCE'];
        $active = $postData['active'];
        $Nature = $postData['Nature'];
        $Business = $postData['Business'];

        $title = mssql_escape($postData['title']);
        $valuetype = $postData['valuetype'];
        $charttype = $postData['charttype'];
        // echo '<pre/>';print_r($charttype);exit();

        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "UPDATE KPIConfiguration SET ValueDriverCode='$ValueDriverCode',SubDriverCode='$SubDriverCode',
                KPIName='$KPIName',Description='$Description',Formula='$Formula',
                SOURCE='$SOURCE',ChartType='6',active='$active',Nature='$Nature',BusinessName='$Business'
                where KPICode='$KPICode'";
        $query = $this->db->query($sql);
        // echo '<pre/>';print_r($query);exit();
        if ($query) {
            $sql2 = "DELETE from KPIConfigurationDetails where KPICode='$KPICode'";
            $query = $this->db->query($sql2);
            // echo '<pre/>';print_r($lastKpiCode);exit();

            for($i=0; $i<count($title); $i++){
                $ComponentCode = $i+1;
                $Title = mssql_escape($title[$i]);
                $ValueType = $valuetype[$i];
                $ChartType = $charttype[$i];

                $sql3 = "INSERT into KPIConfigurationDetails(KPICode,ComponentCode,Title,ValueType,ChartType,
                AxisYIndex) values('$KPICode','$ComponentCode','$Title',
                '$ValueType','$ChartType','0')" ;
                
                $query = $this->db->query($sql3);
            }

            return true;
        }else{
            return false;
        }
    }

    public function loadSubValueDriverCodeByValueDriver($ValueDriverCode)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $data = [];
        $sql = "SELECT * FROM SubValueDriver where ValueDriverCode='$ValueDriverCode'";
        $query = $this->db->query($sql);
        if($query){
            return $query->result_array();
        }else{
            return [];
        }
    }
    
    public function addKpiResponsiblePersonData($postData)
    {
        $modalKpiCode = $this->input->post('modalKpiCode');
        $StaffID = $this->input->post('StaffID');
        $EmpName = $this->input->post('EmpName');
        $Designation = $this->input->post('Designation');
        $Email = $this->input->post('Email');
        $Phone = $this->input->post('Phone');
        // echo '<pre/>';print_r($charttype);exit();

        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "INSERT into KPIResponsible(KPICode,StaffID,EmpName,Designation,Email,
                Phone) values('$modalKpiCode','$StaffID','$EmpName',
                '$Designation','$Email','$Phone')" ;
        $query = $this->db->query($sql);
        // echo '<pre/>';print_r($query);exit();
        if ($query) {
            return true;
        }else{
            return false;
        }
    }
    
    public function updateKpiResponsiblePersonData($postData)
    {
        $modalKpiCode = $this->input->post('modalKpiCode');
        $StaffID = $this->input->post('StaffID');
        $EmpName = $this->input->post('EmpName');
        $Designation = $this->input->post('Designation');
        $Email = $this->input->post('Email');
        $Phone = $this->input->post('Phone');
        // echo '<pre/>';print_r($charttype);exit();

        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "UPDATE KPIResponsible 
                SET StaffID='$StaffID',EmpName='$EmpName',Designation='$Designation',Email='$Email',Phone='$Phone'
                where KPICode='$modalKpiCode'" ;
        $query = $this->db->query($sql);
        // echo '<pre/>';print_r($query);exit();
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    public function getKpiResponsiblePersonData($kpiCode)
    {
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "SELECT * from KPIResponsible where KPICode='$kpiCode'" ;
        $query = $this->db->query($sql);
        // echo '<pre/>';print_r($query);exit();
        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function doLoadMyKPIData($userid, $year){
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "exec usp_doLoadMyKPIData '$userid', '$year'" ;
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function delet_option($ValueDriverCode, $kpiCode){
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        //$sql2 = "DELETE FROM KPIConfigurationDetails WHERE KPICode = '$kpiCode'";
        $sql = "Update KPIConfiguration set active='N' WHERE KPICode = '$kpiCode' and ValueDriverCode='$ValueDriverCode'";
        $query = $this->db->query($sql);
        if ($query){
            return TRUE;
        }
       // $query = $this->db->query($sql2);
//        if ($query) {
//            $sql = "DELETE FROM KPIConfiguration WHERE KPICode = '$kpiCode' and ValueDriverCode='$ValueDriverCode'";
//            $query2 = $this->db->query($sql);
//            if ($query2){
//                return TRUE;
//            }
//        } else {
//            return FALSE;
//        }
    }

    public function getDashboardData(){
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $data = [];
        $sql = "EXEC SP_KPIDashBoardPWC";
        $query = $this->db->query($sql);

        if ($query) {
            $data['first'] = $query->result_array();
            $data['second'] = $query->next_result();
            return $data;
        }else{
            return [];
        }
    }

    public function getAllBusinessForKPIStatus($userId){
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT * FROM vw_KPIEntryStatusUserBusiness WHERE UserID='$userId'";
        $query = $this->db->query($sql);

        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function doLoadValueDriverForKPIStatus($userId){
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT * FROM vw_KPIEntryStatusUserValueDriver WHERE UserID='$userId'";
        $query = $this->db->query($sql);

        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function getKPIStatusData($userid, $Business, $valuedriver){
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);

        if (!empty($Business) && !empty($valuedriver)){
            $sql = "SELECT * FROM vw_KPIEntryStatus WHERE UserID='$userid' and BusinessName='$Business' and ValueDriver='$valuedriver'";
            $query = $this->db->query($sql);

            if ($query) {
                return $query->result_array();
            }else{
                return [];
            }
        } elseif (!empty($Business)){
            $sql = "SELECT * FROM vw_KPIEntryStatus WHERE UserID='$userid' and BusinessName='$Business'";
            $query = $this->db->query($sql);

            if ($query) {
                return $query->result_array();
            }else{
                return [];
            }
        } elseif (!empty($valuedriver)){
            $sql = "SELECT * FROM vw_KPIEntryStatus WHERE UserID='$userid' and ValueDriver='$valuedriver'";
            $query = $this->db->query($sql);

            if ($query) {
                return $query->result_array();
            }else{
                return [];
            }
        }else{
            $sql = "SELECT * FROM vw_KPIEntryStatus where UserID='$userid'";
            $query = $this->db->query($sql);

            if ($query) {
                return $query->result_array();
            }else{
                return [];
            }
        }

    }
}
