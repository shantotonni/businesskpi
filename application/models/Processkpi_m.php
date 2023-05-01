<?php

class Processkpi_m extends CI_Model {

    //SELECT SCOPE_IDENTITY() AS RowId
	//ValueType

    function doLoadData($valuedriver, $kpicode, $business, $years, $single = '', $type = 'anomaly') {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);   
        $data['kpipivotdata']       = array();
        $data['kpiconfiguration']   = array();
                
		$userid = $this->session->userdata('userid'); 		
        $sql = "exec usp_doLoadData '$valuedriver', '$kpicode', '$business', '$years', '$type','$userid' ";

        $query = $this->db->query($sql);
        if (!empty($query)) {
            $data['valuedriver'] = $query->result_array();
            $data['kpi'] = $query->next_result();
            $data['kpidetails'] = $query->next_result();
            $data['kpidata'] = $query->next_result();
            $data['businesslist'] = $query->next_result();
            $data['kpicount'] = $query->next_result();
			$data['rangetable'] = $query->next_result();
            if($single == 'single'){
                $data['kpipivotdata']       = $query->next_result();
                $data['kpiconfiguration']   = $query->next_result();
            }
            //echo "<pre />"; print_r($data['kpicount']); exit();
            return $data;
            
        } else {
            return false;
        }
    }
    
    function doLoadBusiness($useid = '') {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
        $sql = "SELECT 
					DISTINCT New_Name Business 
				FROM Business B
				INNER JOIN UserBusiness UB 
					ON B.New_Name = UB.Business AND UB.UserID = '$useid'
				WHERE New_Name <> '' AND Status = 'Y' ";        
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }

    function doLoadFactoryBusiness() {
        $CI = & get_instance();
        $CI->db = $this->load->database('factory_kpi', true);
        $sql = "SELECT DISTINCT BusinessName FROM FactoryKPI order by BusinessName desc";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function doLoadBusinessIndividualDashBoard($business_name, $user_name) {
        $CI = & get_instance();
        $CI->db = $this->load->database('factory_kpi', true);
        $sql = "EXEC SP_BusinessIndividualDashBoard '$business_name','$user_name'";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            $date['userInfo'] = $query->result_array();
            $date['individual_dashboard'] = $query->next_result();
            return $date;
        } else {
            return false;
        }
    }

    function doLoadBusinessIndividualDashBoardData($business_name, $user_name) {
        $CI = & get_instance();
        $CI->db = $this->load->database('factory_kpi', true);
        $sql = "EXEC SP_BusinessIndividualDashBoardData '$business_name','$user_name'";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            $date['userInfo'] = $query->result_array();
            $date['individual_dashboard'] = $query->next_result();
            return $date;
        } else {
            return false;
        }
    }

    function doLoadFactoryUser() {
        $CI = & get_instance();
        $CI->db = $this->load->database('factory_kpi', true);
        $sql = "SELECT DISTINCT ResponsiblePerson FROM FactoryKPI";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function doLoadBusinessDistrict($userid) {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
        $sql = "SELECT 
					DISTINCT B.New_Name Business
				FROM KPIData K
					INNER JOIN Business B
						ON K.Business = b.Business
					INNER JOIN UserBusiness UB
						ON B.New_Name = UB.Business AND UB.UserID = '$userid'
					INNER JOIN UserKPI UK
						ON K.KPICode = UK.KPICode AND Uk.UserID = '$userid'
				WHERE K.KPICode ='M020'
				ORDER BY 1 ";        
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }
    
    function doLoadValueDriver($userid = '') {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
        $sql = "SELECT 
					DISTINCT VD.ValueDriverCode, VD.ValueDriver 
				FROM ValueDriver VD
					INNER JOIN KPIConfiguration KC
						ON VD.ValueDriverCode = KC.ValueDriverCode
					INNER JOIN UserKPI UK	
						ON KC.KPICode = UK.KPICode
						 AND UK.UserID = '$userid' ";        
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }

    function doLoadSubValueDriver($valueDriverCode) {  
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);   
        $userid = $this->session->userdata('userid');        
        $sql = "SELECT *
                FROM SubValueDriver
                where ValueDriverCode = '$valueDriverCode'
                AND SubValueDriverCode IN (SELECT DISTINCT SubDriverCode FROM ViewKPI V INNER JOIN UserKPI UK ON V.KPICode = UK.KPICode WHERE UK.UserID = '$userid') ";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            // echo "<pre/>";print_r($query->result_array());exit();      
            return $query->result_array();                        
        } else {
            return false;
        }
    }
    
    function doLoadKPI($userid = '') {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
        $sql = "SELECT 
					DISTINCT VD.ValueDriverCode, VD.ValueDriver, KC.KPICode, KPIName 
				FROM KPIConfiguration KC
					INNER JOIN ValueDriver VD
						ON KC.ValueDriverCode = VD.ValueDriverCode
					INNER JOIN UserKPI UK
						ON KC.KPICode = UK.KPICode AND UK.UserID = '$userid' 
				ORDER BY 1  ";        
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }
	
	function doLoadKPIUpdate($userid = '') {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
//        $sql = "SELECT
//					DISTINCT VD.ValueDriverCode, VD.ValueDriver, KC.KPICode, VD.ValueDriver + '-' + SV.SubValueDriver + '-' +  KPIName  as KPIName
//				FROM KPIConfiguration KC
//					INNER JOIN SubValueDriver Sv
//						ON KC.SubDriverCode = SV.SubValueDriverCode
//					INNER JOIN ValueDriver VD
//						ON KC.ValueDriverCode = VD.ValueDriverCode
//					INNER JOIN UserKPI UK
//						ON KC.KPICode = UK.KPICode AND UK.UserID = '25921'
//				ORDER BY 1";

        $sql = "SELECT 
					DISTINCT VD.ValueDriverCode, VD.ValueDriver, KC.KPICode, VD.ValueDriver + '-' + SV.SubValueDriver + '-' +  KPIName  as KPIName
				FROM KPIConfiguration KC
					INNER JOIN SubValueDriver Sv
						ON KC.SubDriverCode = SV.SubValueDriverCode
					INNER JOIN ValueDriver VD
						ON KC.ValueDriverCode = VD.ValueDriverCode
				ORDER BY 1";

        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }
    
    function doLoadtYears() {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
        $sql = "SELECT DISTINCT LEFT(Period,4) Years FROM KPIData";        
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }
	
	function doLoadKPICount($userid) {        
        $CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);           
        $sql = "usp_doLoadKpiCount '$userid' ";        
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();                        
        } else {
            return false;
        }
    }

    function doLoadKPICode($subValueDriverCode)
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $pattern = '/[^A-Za-z0-9\. -#@%()\/]/';
        $data['userid'] = $this->session->userdata('userid');
        $sql = "SELECT DISTINCT K.KPICode, KPIName FROM KPIConfiguration K
                INNER JOIN UserKPI U	ON K.KPICode = U.KPICode AND U.UserID = '".$data['userid']."'
                WHERE SubDriverCode = '$subValueDriverCode'
                ";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            $datas =  $query->result_array();
            for ($i=0; $i < count($datas); $i++) {
                $d = preg_replace($pattern, '', $datas[$i]['KPIName']);
				$datas[$i]['KPIName'] = $d;
            }
            return $datas;
        } else {
            return false;
        }
    }

    public function getAllMonth($year){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "SELECT Period from  FinCalneder WHERE FinYear = '$year' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function doLoadFoodFactoryKpiDashboardDate($business){
        $CI = &get_instance();
        $CI->db = $this->load->database('factory_kpi', true);

        $sql = "EXEC SP_FoodsFactoryDashborad '$business'";

        $query = $this->db->query($sql);
        if (!empty($query)) {
            $data['kpi_title'] = $query->result_array();
            $data['record_one'] = $query->next_result();
            $data['record_two'] = $query->next_result();
            $data['record_three'] = $query->next_result();
            $data['record_four'] = $query->next_result();
            $data['record_five'] = $query->next_result();
            return $data;
        } else {
            return false;
        }
    }

    public function doLoadFlourFactoryKpiDashboardDate($business){
        $CI = &get_instance();
        $CI->db = $this->load->database('factory_kpi', true);

        $sql = "EXEC SP_FlourFactoryDashborad '$business'";

        $query = $this->db->query($sql);
        if (!empty($query)) {
            $data['kpi_title'] = $query->result_array();
            $data['record_one'] = $query->next_result();
            $data['record_two'] = $query->next_result();
            $data['record_three'] = $query->next_result();
            $data['record_four'] = $query->next_result();
            $data['record_five'] = $query->next_result();
            return $data;
        } else {
            return false;
        }
    }

    function doLoadKpiComponent($kpiCode)
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT * FROM KPIConfigurationDetails WHERE KPICode = '$kpiCode'";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getAllBusiness()
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);

        $userid = $this->session->userdata('userid');

        $sql = "SELECT DISTINCT b.Business FROM Business B
                    INNER JOIN UserBusiness UB	ON B.Business = UB.Business
                WHERE UB.UserID = '$userid'";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function doInsertProcessKpiEntryData($data)
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        if (count($data) > 0) {
            foreach ($data as $d) {
                $duplicate = $this->checkDuplicateEntry($d['KPICode'], $d['ComponentCode'], $d['Business'], $d['Period']);
                if ($duplicate['success'] == 1) {
                    $columnNames = array('Value' => $d['Value'], 'LM' => $d['LM'], 'SPLY' => $d['SPLY'], 'EditedBy' => $d['EntryBy'], 'EditedDate' => date('Y-m-d H:i:s'));
                    $this->db->where('KPICode', $d['KPICode']);
                    $this->db->where('ComponentCode', $d['ComponentCode']);
                    $this->db->where('Business', $d['Business']);
                    $this->db->where('Period', $d['Period']);
                    $result = $this->db->update('KPIData', $columnNames);
                } else {
                    $result = $this->db->insert('KPIData', $d);
                }
            }
        }
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function checkDuplicateEntry($kpiCode, $componentCode, $business, $period)
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT * FROM KPIData WHERE KPICode='$kpiCode' AND ComponentCode=$componentCode AND Business='$business' AND Period='$period'";
        //echo $sql; exit();
        $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
            $data['success'] = 1;
            $data['result'] = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    
	function doLoadDistrictWiseSales($business)
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "usp_doLoadDistrictWiseSales '$business' ";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            $data['districtwisesales'] 	= $query->result_array();
			$data['category'] 			= $query->next_result();
			$data['monthwisedata'] 		= $query->next_result();
			return $data;
        } else {
            return false;
        }
    }

    function getAllKPIData($kpiCode, $Period, $business){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        //return $Period;
        $sql = "SELECT * FROM KPIData  
                WHERE KPICode = '$kpiCode' AND Business='$business' AND Period IN('".implode("','",$Period)."') ";
        //return $sql;
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function deleteKPIBYKPICodeYear($data){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "DELETE FROM KPIData 
                WHERE KPICode = '".$data['KPICode']."' AND Business = '".$data['Business']."' AND ComponentCode = '".$data['ComponentCode']."' AND Period= '".$data['Period']."' ";

        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function insertKpi($data){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);

        $result = $this->db->insert('KPIData', $data);
        $this->db->insert('KPIDataLog', $data);

        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function doLoadValueDriverByValueDriverCode($code){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);

        $sql = "SELECT * FROM ValueDriver 
                WHERE ValueDriverCode = '$code'";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
}
