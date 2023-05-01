<?php

class UserPermission_m extends CI_Model {

    function doInsertPermission($data)
    {
        // echo '<pre>';print_r($userid);die;
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        if (count($data['business']) > 0) {
            foreach ($data['business'] as $business) {
                $businessData['UserID'] = $data['userid'];
                $businessData['Business'] = $business;
                $businessData['EntryBy'] = $data['entryby'];
                $businessData['EntryDate'] = date('Y-m-d H:i:s');
                // echo '<pre>';print_r($businessData);
                $result = $this->db->insert('UserBusiness', $businessData);
            }
        }
        if(count($data['kpi']) > 0){
            foreach ($data['kpi'] as $kpi) {
                $kpiData['UserID'] = $data['userid'];
                $kpiData['KPICode'] = $kpi;
                $kpiData['EntryBy'] = $data['entryby'];
                $kpiData['EntryDate'] = date('Y-m-d H:i:s');
                // echo '<pre>';print_r($kpiData);
                $result = $this->db->insert('UserKPI', $kpiData);
            }
        }
        if(count($data['menu']) > 0){
            foreach ($data['menu'] as $menu) {
                $menuData['UserID'] = $data['userid'];
                $menuData['MenuID'] = $menu;
                $menuData['EntryBy'] = $data['entryby'];
                $menuData['EntryDate'] = date('Y-m-d H:i:s');
                // echo '<pre>';print_r($kpiData);
                $result = $this->db->insert('UserMenu', $menuData);
            }
        }
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    public function doLoadUsersPermission(){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT DISTINCT UB.UserID,P.Name FROM UserBusiness UB
                JOIN [192.168.100.2].PIMSNEW.DBO.Personal P on P.EmpCode=UB.UserID";
        $query = $this->db->query($sql);
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $sql1 = "SELECT K.UserID, K.KPICode, C.KPIName FROM UserKPI K
                    JOIN KPIConfiguration C ON C.KPICode=K.KPICode 
                    WHERE K.UserID = '" . $value['UserID'] . "'";
            $query1 = $this->db->query($sql1);
            $query1 = $query1->result_array();
            $query[$key]['kpi'] = $query1;
            
            $sql2 = "SELECT UserID,Business FROM UserBusiness WHERE UserID = '" . $value['UserID'] . "'";
            $query2 = $this->db->query($sql2);
            $query2 = $query2->result_array();
            $query[$key]['business'] = $query2;

            $sql3 = "SELECT UserMenu.UserID,UserMenu.MenuID,Menu.MenuName
                    FROM UserMenu
                    join Menu on Menu.MenuID=UserMenu.MenuID WHERE UserMenu.UserID = '" . $value['UserID'] . "'";
            $query3 = $this->db->query($sql3);
            $query3 = $query3->result_array();
            $query[$key]['menu'] = $query3;
            
        }
        return $query;
    }

    function selectPermissionDetails($userid){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT KPICode FROM UserKPI
                WHERE UserID = '$userid'";
        $query = $this->db->query($sql);
        $data['kpi'] = $query->result_array();
        $sql2 = "SELECT Business FROM UserBusiness
                WHERE UserID = '" . $userid. "'";
        $query2 = $this->db->query($sql2);
        $data['business'] = $query2->result_array();
        $sql3 = "SELECT MenuID FROM UserMenu
                WHERE UserID = '" . $userid. "'";
        $query3 = $this->db->query($sql3);
        $data['menu'] = $query3->result_array();
        return $data;
    }

    function doUpdatePermission($data)
    {
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);

        $userid = $data['userid'];
        $sql = "DELETE FROM UserBusiness WHERE UserID = '$userid'";
        $this->db->query($sql);

        $sql2 = "DELETE FROM UserKPI WHERE UserID = '$userid'";
        $this->db->query($sql2);

        $sql3 = "DELETE FROM UserMenu WHERE UserID = '$userid'";
        $query = $this->db->query($sql3);

        if (count($data['business']) > 0) {
            foreach ($data['business'] as $business) {
                $businessData['UserID'] = $data['userid'];
                $businessData['Business'] = $business;
                $businessData['EntryBy'] = $data['entryby'];
                $businessData['EntryDate'] = date('Y-m-d H:i:s');
                $result = $this->db->insert('UserBusiness', $businessData);
            }
        }
        if(count($data['kpi']) > 0){
            foreach ($data['kpi'] as $kpi) {
                $kpiData['UserID'] = $data['userid'];
                $kpiData['KPICode'] = $kpi;
                $kpiData['EntryBy'] = $data['entryby'];
                $kpiData['EntryDate'] = date('Y-m-d H:i:s');
                $result = $this->db->insert('UserKPI', $kpiData);
            }
        }

        if(count($data['menu']) > 0){
            foreach ($data['menu'] as $menu) {
                $menuData['UserID'] = $data['userid'];
                $menuData['MenuID'] = $menu;
                $menuData['EntryBy'] = $data['entryby'];
                $menuData['EntryDate'] = date('Y-m-d H:i:s');
                // echo '<pre>';print_r($kpiData);
                $result = $this->db->insert('UserMenu', $menuData);
            }
        }
        
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    public function doLoadMenu(){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT MenuID,MenuName FROM Menu";
        $query = $this->db->query($sql);
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function doLoadPermissionedMenu($userid){
        $CI = &get_instance();
        $CI->db = $this->load->database('kpi', true);
        $sql = "SELECT UserMenu.UserID,Menu.MenuID,Menu.MenuName,Menu.Page,Menu.Url
                FROM Menu
                JOIN UserMenu on UserMenu.MenuID=Menu.MenuID
                WHERE UserMenu.UserID='$userid' ORDER BY OrderSL";
        $query = $this->db->query($sql);
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function doLoadAutocompleteUserDetails($empcode){
        $CI = &get_instance();
        $CI->db = $this->load->database('emp', true);
        $sql = "SELECT P.EMPCODE, P.NAME, D.DesgName DESIGNATION, DE.DeptName 
                FROM Personal P
                INNER JOIN EMPLOYER e ON P.EMPCODE = E.EMPCODE
                INNER JOIN Designation D ON E.DesgCode = D.DesgCode
                INNER JOIN Department DE ON E.DeptCode = DE.DeptCode
                WHERE P.Active ='Y' AND (E.EmpCode LIKE '%$empcode%' OR P.NAME LIKE '%$empcode%') AND E.LeftDate IS NULL";
        $query = $this->db->query($sql);
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }

}