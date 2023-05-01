<?php

class Compare_m extends CI_Model {

    //SELECT SCOPE_IDENTITY() AS RowId

    function doLoadValueDriven($userid) {                		
        $sql = " SELECT * FROM ViewGroupKPIValueDriver ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function doLoadKPI($userid, $valuedrivencode) {              
        $sql = " SELECT * FROM ViewGroupKPIMetrics WHERE ('' = '$valuedrivencode' OR ValueDriverCode = '$valuedrivencode')  ";
        //echo $sql; exit();
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function doLoadKPICompareData($userid, $business, $valuedriver, $matrics, $cyear) {
        
        $sql = " usp_doLoadKPICompareData '$business', '$valuedriver', '$matrics', '$cyear' ";
        //echo $sql; exit();
        $query = $this->db->query($sql);
        //print_r($query->result_array()); exit();
        return $query->result_array();
    }
      

}
