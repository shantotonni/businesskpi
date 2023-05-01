<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $CI = & get_instance();
        $CI->db = $this->load->database('emp', true);
        /*        SELECT TOP 1 empcode, password, postaccess, worklocation, poweruser, group_id 
          FROM [192.168.100.2].[PIMSNEW].dbo.UserManagerOnlineApp WHERE empcode = '05785' */
    }

    public function doUserLogin($userid, $password) {
        $sql = "SELECT TOP 1 empcode, password, postaccess, worklocation, poweruser, group_id
                FROM UserManagerOnlineApp
                WHERE empcode = '$userid'";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
		
        if ($query) {
            $rows = $query->result_array();
			
            if ($rows !== false && count($rows) > 0) {
				//print_r($rows[0]['password']);
				if(substr($userid,0,1) == 'C'){
					$result = array();
					$result['success'] = true;
					return $result;
				}
                if ($rows[0]['password'] == $password) {					
                    $data = $rows[0];
                    $sql = "SELECT TOP 1 p.empcode, p.Name AS empname, e.jobtypecategory, 
								Left(e.JoiningDate, 11) AS joiningdate, 
                                datediff(month,e.joiningdate,Getdate())/12.0 As yearserved, e.authcode,
                                ISNULL(c.JobTypeCategoryDeatils, 'Fix Personal File') AS jobtypecategorydeatils,
                                d.desgname, e.deptcode, dep.deptname,
                                (SELECT ISNULL(EmailID, '')
                                    FROM EmployeeEmailId 
                                    WHERE empcode = '{$rows[0]['empcode']}') AS emailid
                            FROM Personal p LEFT JOIN Employer e ON 
                                    e.empcode = p.empcode 
                                LEFT JOIN JobTypeCategory c ON 
                                    e.JobTypeCategory= c.JobTypeCategory
                                INNER JOIN Designation d ON
                                    e.DesgCode = d.DesgCode
                                 INNER JOIN Department dep ON 
                                    e.DeptCode = dep.DeptCode 
                        	WHERE p.empcode = '{$rows[0]['empcode']}'";
                    $query = $this->db->query($sql);
                    if ($query) {
                        $rows = $query->result_array();
                        if ($rows !== false) {
                            $result['success'] = true;
                            $result = array_merge($result, $data, $rows[0]);
                        }
                        $sql = "SELECT deptcode AS kpideptcode FROM KPIDepartment
								WHERE empcode = '" . $data['empcode'] . "'";
                        $query = $this->db->query($sql);
                        if ($query) {
                            $rows = $query->result_array();
                            if ($rows !== false AND count($rows) > 0) {
                                $result = array_merge($result, $rows[0]);
                            }
                        }
                    }
                }
            }
        }
		//print_r($result);exit();
        return $result;
    }

    public function doUserHitCount($userid) {
        $CI = & get_instance();
        $CI->db = $this->load->database('sdms', true);
        $sql = "SELECT RIGHT(YEAR(GETDATE()),4)+ 
				REPLICATE('0',11-len(ISNULL(Max(CONVERT(INT, Right(SessionID,11))),0) + 1)) + 
				CONVERT(VARCHAR,ISNULL(Max(CONVERT(INT, Right(SessionID,11))),0) + 1) AS NewSessionID
				FROM UserLog WHERE LEFT(SessionId,4) = RIGHT(YEAR(GETDATE()),4)";
        $query = $this->db->query($sql);
        if ($query) {
            $rows = $query->result_array();
            if ($rows !== false && count($rows) > 0) {
                $maxid = $rows[0]['NewSessionID'];
                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                $currdate = $dt->format('Y-m-d H:i:s');
                $PanelName = 'BusinessKPI';
                $IPAddress = $_SERVER['REMOTE_ADDR'];
                $query_insert = "INSERT INTO userLog (SessionID,UserId,Login,LogOut,PanelName,IPAddress) VALUES ('$maxid','$userid','$currdate','','$PanelName','$IPAddress');";
                $this->db->query($query_insert);
            }
        }
    }
    
    public function getBusinessId($userid){
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);        
        $sql = "SELECT BusinessId FROM UserManager WHERE Active = 'Y' AND EmpCode = '$userid' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
                return $query->result_array();
        }
    }

}
