<?php

class Goodbad_m extends CI_Model {

    //SELECT SCOPE_IDENTITY() AS RowId
	//ValueType

    function SelectCountGood($Business, $year, $KPIMetrics = '') {
		$CYEAR = myBusinessId('CYEAR' ,$year);
        ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";		
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
		
        $sql = "select Business,count(distinct KPIMetrics) cnt 
		from vwRankKPIDetailSummaryGood
		WHERE  ($CYEAR)   $Business_sql $KPIMetrics_sql
		Group by Business";
		//echo $sql; exit();
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	function SelectKPIBusinessGood($Business,  $year, $KPIMetrics = '') {
        $CYEAR = myBusinessId('CYEAR' ,$year);
        ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
        $sql = "SELECT DISTINCT Business FROM vwRankKPIDetailSummaryGood   WHERE  ($CYEAR)   $Business_sql $KPIMetrics_sql ORDER BY Business";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function SelectKPIDrivenGood($Business, $year , $KPIMetrics = '') {
        $CYEAR = myBusinessId('CYEAR' ,$year);
        ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
        $sql = "SELECT DISTINCT ValueDriver, Business FROM vwRankKPIDetailSummaryGood   WHERE  ($CYEAR)   $Business_sql $KPIMetrics_sql ORDER BY ValueDriver";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function SelectKPIMetricsGood($Business, $year, $KPIMetrics = '') {
         $CYEAR =  myBusinessId('CYEAR' ,$year);
         ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
        $sql = "SELECT DISTINCT ValueDriver, KPIMetrics, Business FROM vwRankKPIDetailSummaryGood   WHERE  ($CYEAR)  $Business_sql $KPIMetrics_sql ORDER BY ValueDriver,KPIMetrics ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function SelectDataGood($Business, $year , $KPIMetrics = '') {
         $CYEAR = myBusinessId('CYEAR' ,$year);
         ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		 if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
         $sql = "SELECT Business, ValueDriver,KPIMetrics,CYEAR,CPERIOD,ValueType, ISNULL(KPIIndex,0) KPIIndex FROM vwRankKPIDetailSummaryGood
                WHERE  ($CYEAR) $Business_sql $KPIMetrics_sql 
                ORDER BY Business, ValueDriver, KPIMetrics, CPERIOD ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function SelectDataGoodMinPeriod($Business, $year , $KPIMetrics = '') {
         $CYEAR = myBusinessId('CYEAR' ,$year);
         ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		 if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
         $sql = "SELECT DISTINCT CPERIOD FROM vwRankKPIDetailSummaryGood
                WHERE  ($CYEAR) $Business_sql $KPIMetrics_sql 
                ORDER BY CPERIOD ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function SelectDataBadMinPeriod($Business, $year , $KPIMetrics = '') {
         $CYEAR = myBusinessId('CYEAR' ,$year);
         ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		 if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
         $sql = "SELECT DISTINCT CPERIOD FROM vwRankKPIDetailSummaryBad
                WHERE  ($CYEAR) $Business_sql $KPIMetrics_sql 
                ORDER BY CPERIOD ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function selectChartDataGood($Business, $ValueDriver, $KPIMetrics, $CYEAR) {
        $sql = "SELECT * FROM vwRankKPIDetailSummaryGood WHERE Business = '$Business' 
					AND ValueDriver = '$ValueDriver' 
					AND KPIMetrics = '$KPIMetrics'
					AND CYEAR IN ($CYEAR) ORDER BY CPeriod";
                    //echo $sql; exit();
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	
	function selectChartDataBad($Business, $ValueDriver, $KPIMetrics, $CYEAR) {
        $sql = "SELECT * FROM vwRankKPIDetailSummaryBad WHERE Business = '$Business' 
					AND ValueDriver = '$ValueDriver' 
					AND KPIMetrics = '$KPIMetrics'
					AND CYEAR IN ($CYEAR) ORDER BY CPeriod";
                    //echo $sql; exit();
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	/*<!-----------------BAD-------------------------->*/
	
	function SelectCountBad($Business, $year, $KPIMetrics = '') {
		$CYEAR = myBusinessId('CYEAR' ,$year);
        ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";		
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
		
        $sql = "select Business,count(distinct KPIMetrics) cnt 
		from vwRankKPIDetailSummaryBad
		WHERE  ($CYEAR)   $Business_sql $KPIMetrics_sql
		Group by Business";
		//echo $sql; exit();
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    
    function SelectKPIBusinessBad($Business,  $year, $KPIMetrics = '') {
        $CYEAR = myBusinessId('CYEAR' ,$year);
        ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
        $sql = "SELECT DISTINCT Business FROM vwRankKPIDetailSummaryBad   WHERE  ($CYEAR)   $Business_sql $KPIMetrics_sql ORDER BY Business";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    function SelectKPIDrivenBad($Business, $year , $KPIMetrics = '') {
        $CYEAR = myBusinessId('CYEAR' ,$year);
        ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
        $sql = "SELECT DISTINCT ValueDriver, Business FROM vwRankKPIDetailSummaryBad   WHERE  ($CYEAR)   $Business_sql $KPIMetrics_sql ORDER BY ValueDriver";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
   function SelectKPIMetricsBad($Business, $year, $KPIMetrics = '') {
         $CYEAR =  myBusinessId('CYEAR' ,$year);
         ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
        $sql = "SELECT DISTINCT ValueDriver, KPIMetrics, Business FROM vwRankKPIDetailSummaryBad   WHERE  ($CYEAR)  $Business_sql $KPIMetrics_sql ORDER BY ValueDriver,KPIMetrics ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function SelectDataBad($Business, $year , $KPIMetrics = '') {
         $CYEAR = myBusinessId('CYEAR' ,$year);
         ($Business == 'All') ? $Business_sql = '' :  $Business_sql = "AND Business = '$Business'";
		 if(empty($KPIMetrics)) { $KPIMetrics_sql = ''; }else{   $KPIMetrics_sql = "AND KPIMetrics = '$KPIMetrics'";		}
         $sql = "SELECT Business, ValueDriver,KPIMetrics,CYEAR,CPERIOD,ValueType, ISNULL(KPIIndex,0) KPIIndex FROM vwRankKPIDetailSummaryBad
                WHERE  ($CYEAR) $Business_sql $KPIMetrics_sql 
                ORDER BY Business, ValueDriver, KPIMetrics, CPERIOD ";
                //echo $sql; exit();
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    function selectBusinessGood() {
        $sql = "SELECT DISTINCT Business FROM vwRankKPIDetailSummaryGood   ORDER BY Business";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    function selectCYEARGood() {
        $sql = "SELECT DISTINCT CYEAR FROM  vwRankKPIDetailSummaryGood";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	function selectBusinessBad() {
        $sql = "SELECT DISTINCT Business FROM vwRankKPIDetailSummaryBad   ORDER BY Business";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    function selectCYEARBad() {
        $sql = "SELECT DISTINCT CYEAR FROM  vwRankKPIDetailSummaryBad";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	
	
    
    
    /**********************/
    
    function select_quiz_info($EmpCode) {
        $sql = "SELECT Q.ExamId,QS.QuizSegmentsName,Q.QuestionId,Q.Title,Q.Details,R.QuesOption As RightAnswer 
            FROM Question Q
            LEFT JOIN QuestionOption R ON Q.QuestionId=R.QuestionId AND Q.RightAnswer=R.QuesValue
            INNER JOIN UserManager U ON U.BusinessId = Q.SBUId
			LEFT JOIN QuizSegments QS ON Q.QuizSegmentsId = QS.QuizSegmentsId
            WHERE U.EmpCode = '$EmpCode' ";
        $query = $this->db->query($sql);
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $sql1 = "SELECT QuestionId,CAST(QuesOption AS nvarchar(500)) AS QuesOption,QuesValue "
                    . "FROM QuestionOption "
                    . "WHERE QuestionId = '" . $value['QuestionId'] . "'";
            $query1 = $this->db->query($sql1);
            $query1 = $query1->result_array();
            $query[$key]['question_option'] = $query1;
        }
        return $query;		
    }
	

    function submitQuizM($data) {
        $ExamId = $data['ExamId'];
		$BusinessId = $data['SBUId'];
		$QuizSegmentsId = $data['QuizSegmentsId'];
		$Portfolio = $data['Portfolio'];
		$Title = $data['Title'];
        $Details = $data['Details'];
        $RightAnswer = $data['RightAnswer'];
        $sql = "exec usp_QuizInsert $ExamId,$BusinessId,'$QuizSegmentsId','$Portfolio','$Title','$Details','$RightAnswer' ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function duplicate_checking($id, $field, $table) {
        $sql = "SELECT * FROM $table WHERE $field = '$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function insert($data, $table) {
        $this->db->insert($table, $data);
        return true;
    }

    function edit_option($action, $id, $field, $table) {
        $this->db->where($field, $id);
        $this->db->update($table, $action);
        return true;
    }

	function edit_option_Question ($data, $id, $field, $table) {
        //echo '<pre/>';print_r($data);exit();
		$ExamId = $data['ExamId'];
		$BusinessId = $data['SBUId'];
		$QuizSegmentsId = $data['QuizSegmentsId'];
		$Portfolio = $data['Portfolio'];
		$Title = $data['Title'];
        $Details = $data['Details'];
        $RightAnswer = $data['RightAnswer'];
		$Active = $data['Active'];
	    $sql = "UPDATE Question SET ExamId = '$ExamId', SBUId = '$BusinessId', QuizSegmentsId = '$QuizSegmentsId', Portfolio = '$Portfolio', Title = '$Title', Details = '$Details',RightAnswer = '$RightAnswer', Active = '$Active' WHERE QuestionId = '$id' ";
		//echo $sql ;exit();
        $query = $this->db->query($sql);
		return true;
		/*$this->db->where($field, $id);
        $this->db->update($table, $action);
        return true;*/
    }
    function delet_option($id, $field, $table) {
        $sql = "DELETE FROM $table WHERE $field = $id";
        $query = $this->db->query($sql);
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function SelectCountQuiz($BusinessId){
        $sql = "SELECT count(*) AS TQuestion FROM Question 
                ";
        $sql .= "WHERE Active  = 'Y' AND ";
        $sql .= myBusinessId('SBUId',$BusinessId);
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function select_exam_time($BusinessId){
        $sql = "SELECT distinct a.*,b.BusinessName FROM ExamTime a
                INNER JOIN Business b ON a.SBUId = b.BusinessId
                INNER JOIN UserManager U ON U.BusinessId = B.BusinessId
                ";
        $sql .= "WHERE ";
        $sql .= myBusinessId('a.SBUId',$BusinessId);
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function select_exam_time_sms($BusinessId){
        $sql = "SELECT distinct a.*,b.BusinessName FROM ExamTime a
                INNER JOIN Business b ON a.SBUId = b.BusinessId
                INNER JOIN UserManager U ON U.BusinessId = B.BusinessId
                ";
        $sql .= "WHERE ";
        $sql .= myBusinessId('a.SBUId',$BusinessId);
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    function select_exam_time_result($BusinessId){
        $sql = "SELECT DISTINCT a.ExamId,b.BusinessName FROM ExamTime a
                INNER JOIN Business b ON a.SBUId = b.BusinessId
                INNER JOIN UserManager U ON U.BusinessId = B.BusinessId ";
        $sql .= "WHERE ";
        $sql .= myBusinessId('a.SBUId',$BusinessId);
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    function select_quiz_id($ExamId) {
        $sql = "SELECT * FROM Question WHERE ExamId = $ExamId AND Active = 'Y' ORDER BY QuestionId ";
        $query = $this->db->query($sql);        
        if ($query) {
            return $query->result_array();
        }
    }

    function selectExamTimeId($ExamId) {
        $sql = "SELECT * FROM ExamTime WHERE ExamId = '$ExamId'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function option_select($table, $field) {
        $sql = "SELECT * FROM $table ORDER BY $field ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    

    function update_exam_status($SBUId) {
        $sql = "UPDATE ExamTime SET Active = 'N' WHERE SBUId = '$SBUId' ";
        $query = $this->db->query($sql);
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function delete_result($data){
        $ExamId = $data['ExamId'];
        $UserId = $data['UserId'];
        $sql = "DELETE FROM AnswerSubmit WHERE ExamId = $ExamId AND UserId = '$UserId'";
        $query = $this->db->query($sql);
        if($query){
                return true;
        }else{
                return false;
        }
    }
    
    function select_option_business($BusinessId){
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        $sql = "SELECT BusinessName FROM Business WHERE BusinessId = '$BusinessId' ";
        $query = $this->db->query($sql);
        if($query){
            return $query->row();
        }else{
                return false;
        }
    }
    
     function select_title_issue_like($q) {
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        $sql = "SELECT QuizTitleId,QuizTitleName FROM QuizTitle WHERE ( QuizTitleName LIKE '%$q%' OR QuizTitleId LIKE '%%' ) AND Active = 'Y' ";                 
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

}
