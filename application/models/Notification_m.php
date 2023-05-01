<?php

class Notification_m extends CI_Model {

   function select_KPI_Anomolies() {
		$CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT DISTINCT B.New_Name As Business,KI.KPICode,KC.KPIName , KI.Period
					FROM KPIIndexLM KI 
					INNER JOIN KPIConfiguration KC ON KI.KPICode = KC.KPICode
					INNER JOIN Business B ON KI.Business = B.Business
					WHERE KI.Active = 'Y' 
					AND KI.IndexType = 'Anomolies' 
					AND KI.Period = '202102'
					ORDER BY 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	
	function select_KPI_Anomolies_B_P($Business,$Period) {
		$CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
         $sql = "SELECT DISTINCT B.New_Name As Business,KI.KPICode,KC.KPIName , KI.Period
					FROM KPIIndexLM KI 
					INNER JOIN KPIConfiguration KC ON KI.KPICode = KC.KPICode
					INNER JOIN Business B ON KI.Business = B.Business
					WHERE KI.Active = 'Y' 
					AND KI.IndexType = 'Anomolies' 
					AND B.New_Name LIKE '$Business'
					AND KI.Period LIKE '$Period'
					ORDER BY 1";
			//	exit();	
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function select_business() {
		$CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT DISTINCT New_Name As Business FROM Business	ORDER BY 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	
	function select_period() {
		$CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT DISTINCT KI.Period
				FROM KPIIndexLM KI 
				INNER JOIN KPIConfiguration KC ON KI.KPICode = KC.KPICode
				INNER JOIN Business B ON KI.Business = B.Business
				WHERE KI.Active = 'Y' 
				AND IndexType = 'Anomolies' 
				ORDER BY 1 DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function doInsertFeedback($data) {
		$CI = & get_instance();
        $CI->db = $this->load->database('kpi', true);
        $insert = $this->db->insert('Feedback', $data);
        if ($insert == true) {
            return true;
        } else {
            return false;
        }
    }

}
