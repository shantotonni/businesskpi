<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    if (!function_exists('mssql_escape')) {

        function mssql_escape($str) {
            if (get_magic_quotes_gpc()) {
                $str = stripslashes(nl2br($str));
            }
            return str_replace("'", "''", $str);
        }

    }
    
    if (!function_exists('select_option')) {

        function select_option($table, $field_id, $field_name) {
            $ci = get_instance();

            $ci->load->model('common_m');
            $option = $ci->common_m->option_select($table, $field_id);

            foreach ($option as $opt) {
                $opt_id = $opt[$field_id];
                $opt_name = $opt[$field_name];
                echo "<option value=\"$opt_id\">$opt_name</option>";
            }
        }

    }

    if (!function_exists('select_option_selected')) {

        function select_option_selected($table, $field_id, $field_name, $selected_id) {
            $ci = get_instance();

            $ci->load->model('common_m');
            $option = $ci->common_m->option_select($table, $field_id);
            foreach ($option as $opt) {
                $opt_id = $opt[$field_id];
                $opt_name = $opt[$field_name];
                if ($opt_id == $selected_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                echo "<option value=\"$opt_id\" $selected>$opt_name</option>";
            }
        }

    }

    if (!function_exists('get_role_name')) {

        function get_role_name($id) {
            $CI = & get_instance();
            $CI->load->model('Common_m');
            $RoleName_q = $CI->Common_m->select_option_role($id);
            $RoleName = $RoleName_q['0']['RoleName'];
            return $RoleName;
        }

    }


	
	if (!function_exists('get_period_month')) {

        function get_period_month($period) {
            $CI = & get_instance();
            $CI->load->model('Common_m');
            $total_q = $CI->Common_m->select_period_month($period);
            //$Levelname = $Levelname_q['0']['Levelname'];
            return $total_q->Period;
        }
    }
    
    if (!function_exists('get_date_format')) {
        function get_date_format($date) {
            $time = strtotime($date);
            $dateF = date('M d Y', $time);
            return $dateF;
        }
    }
    
    if (!function_exists('get_date_format_2')) {
        function get_date_format_2($date) {
            $time = strtotime($date);
            $dateF = date('Y-m-d', $time);
            return $dateF;
        }
    }


    if (!function_exists('bd_nice_number')) {

        function bd_nice_number($n) {
            $n = (0 + str_replace(",", "", $n));

            // is this a number?
            if (!is_numeric($n))
                return false;

            // now filter it;
            // if($n>1000000000000) return round(($n/1000000000000),1).' trillion';
            // else if($n>1000000000) return round(($n/1000000),1).'';
            // else if($n>1000000) return round(($n/1000000),2).'';
            if ($n > 1000)
                return round(($n / 1000000), 2) . '';

            return number_format($n);
        }

    }

    if (!function_exists('bd_nice_number_hs')) {

        function bd_nice_number_hs($n) {
            $n = (0 + str_replace(",", "", $n));

            // is this a number?
            if (!is_numeric($n))
                return false;

            // now filter it;
            if ($n > 1000000000000)
                return round(($n / 1000000000000), 1) . ' trillion';
            else if ($n > 1000000000)
                return round(($n / 1000000000), 1) . ' billion';
            else if ($n > 1000000)
                return round(($n / 1000), 2) . '';
            else if ($n > 1000)
                return round(($n / 1000), 2) . '';

            return number_format($n);
        }

    }
  
if (!function_exists('myBusinessId')) {
    function myBusinessId($FieldName ,$bid) { 
        $i=1;
        $mybid_sql='(';
        foreach ($bid as $mybid)
        {
            if ($i)
            {
                $mybid_sql.=" ".$FieldName." =".$mybid." ";
            }
            else
            {
                $mybid_sql.=" OR ".$FieldName." = ".$mybid." ";
            }
            $i=0;
        }
        $mybid_sql.=')';
        return $mybid_sql;
    }
}

if (!function_exists('get_business_name')) {

    function get_business_name($id) {
        $CI = & get_instance();
        $CI->load->model('Common_m');
        $RoleName_q = $CI->Common_m->select_option_business($id);
        return $RoleName_q->BusinessName;
    }

}

if (!function_exists('get_ValueDriverCode')) {

    function get_ValueDriverCode($ValueCode) {
        $CI = & get_instance();
        $CI->load->model('kpi_m');
        
        $MaxLastValueDriverCode = $CI->kpi_m->selectLastValueDriverCode($ValueCode);
        $LastValueDriverCode = $MaxLastValueDriverCode->ValueDriverCode+1;
        $LastValueDriverCodeLen = strlen($LastValueDriverCode);
        switch ($LastValueDriverCodeLen) {
            case 1:
                $ValueDriverCode = '00'.$LastValueDriverCode;
                break;
            case 2:
                $ValueDriverCode = '0'.$LastValueDriverCode;
                break;
            default:
                $ValueDriverCode = $LastValueDriverCode;
        }
        $NewValueDriverCode = $ValueCode.$ValueDriverCode;
        return $NewValueDriverCode;
    }
}

if (!function_exists('get_KPIMetricsCode')) {

    function get_KPIMetricsCode($MetricsCode) {
        $CI = & get_instance();
        $CI->load->model('kpi_m');
        
        $MaxLastKPIMetricsCode = $CI->kpi_m->selectLastKPIMetricsCode($MetricsCode);
        $LastKPIMetricsCode = $MaxLastKPIMetricsCode->KPIMetricsCode+1;
        $LastKPIMetricsCodeLen = strlen($LastKPIMetricsCode);
        switch ($LastKPIMetricsCodeLen) {
            case 1:
                $KPIMetricsCode = '00'.$LastKPIMetricsCode;
                break;
            case 2:
                $KPIMetricsCode = '0'.$LastKPIMetricsCode;
                break;
            default:
                $KPIMetricsCode = $LastKPIMetricsCode;
        }
        $NewKPIMetricsCode = $MetricsCode.$KPIMetricsCode;
        return $NewKPIMetricsCode;
    }
}

if (!function_exists('get_menu')) {

    function get_menu($userid) {
        $CI = & get_instance();
        $CI->load->model('UserPermission_m');
        
        $menu = $CI->UserPermission_m->doLoadPermissionedMenu($userid);

        return $menu;
    }
}


