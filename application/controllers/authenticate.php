<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');     

class Authenticate extends CI_Controller {
    var $data = null;
    
    public function __construct() {
        parent::__construct();        
        $this->load->database('emp',true);                   
        $this->load->model('Users_data');        
        $this->data['currentdate'] = date('l, F d, Y', strtotime('now'));
        $this->data['currenttime'] = date('h:i A', strtotime('now'));
    }

    public function index() {

        $this->data['page'] = 'login';
        $this->data['page_title'] = 'Login Page';
        $this->data['error'] = $this->session->userdata('error');
        $this->data['msg'] = $this->session->userdata('msg');
        $empcode = $this->input->post('empcode', true);
        if ($empcode == FALSE) {
            $empcode = '';
        }
        $this->data['empcode'] = $empcode;
        $this->data['password'] = '';
        
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('msg');    
        $this->data['loginheader'] = $this->load->view('inc/header', $this->data, true);
        $this->data['loginfooter'] = $this->load->view('inc/footer', '', true);        
        $this->load->view('login', $this->data);
    }

     public function login() {       

        $userid = $this->input->post('empcode', true);
        $password = $this->input->post('password', true);
        
        $row = $this->Users_data->doUserLogin($userid, $password);            
		
        if ($row['success']==true){
            //$this->Users_data->doUserHitCount($userid);
            
            $this->session->set_userdata('userid', $userid);
            $this->session->set_userdata('login', true);
		 
            $this->session->set_userdata('emp_name', $row['empname']); 
            $this->session->set_userdata('dept_name', $row['deptname']);
            $this->session->set_userdata('designation', $row['desgname']);
            $this->session->set_userdata('worklocation', $row['worklocation']);

            //redirect(site_url()); 
            redirect(base_url('kpi')); 
            return true;
        }               
	
        $this->session->set_userdata('msg', 'Invalid employee code or password.');        
        redirect('/authenticate');                
    }

    public function logout() {
        $alldata = $this->session->userdata('alldata');
        if (!$alldata) {        
            session_unset();
            $sess = @session_destroy();
            $this->session->sess_destroy();
            $data['success'] = true;
            //print_r($this->session);exit();
            redirect(site_url());
        } else {
            redirect($this->session->userdata('dashobardutl'));
        }
    }
}