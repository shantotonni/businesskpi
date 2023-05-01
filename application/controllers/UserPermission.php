<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserPermission extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Processkpi_m');
        $this->load->model('UserPermission_m');
    }

    public function index(){
        $data = array();
        $data['page'] = 'user_permission';
        $data['page_title'] = 'User Permission';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['allbusiness'] = $this->Processkpi_m->doLoadBusiness($data['userid']);
        $data['allkpi']      = $this->Processkpi_m->doLoadKPIUpdate($data['userid']);
        $data['allmenu']      = $this->UserPermission_m->doLoadMenu();


        $data['usersPermission'] = $this->UserPermission_m->doLoadUsersPermission();

        // echo '<pre>';print_r($data);die;

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);

        $data['main_content'] = $this->load->view('userpermission/user_permission', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function addPermission(){
        $data = array();
        $data['entryby'] = $this->session->userdata('userid');
        $data['userid'] = $this->input->post('userid');
        $data['business'] = $this->input->post('business');
        $data['kpi'] = $this->input->post('kpi');
        $data['menu'] = $this->input->post('menu');

        // echo '<pre>';print_r($data);die;

        if($data['userid'] != '' && $data['business'] != '' && $data['kpi'] != '' && $data['menu'] != ''){
            $insert = $this->UserPermission_m->doInsertPermission($data);
        }

        if ($insert == true) {
            $msg['message'] = "User Permission Added Successfully.";
        } else {
            $msg['message'] = "Something went wromg. Pleasre try again.";
        }
        $this->session->set_userdata($msg);

        redirect(base_url('UserPermission'));
    }

    public function updatePermission($userId) {
        // echo $userId;die;
        $data = array();
        $data['page'] = 'user_permission';
        $data['page_title'] = 'Update User Permission';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['UserID'] = $userId;

        $data['allbusiness'] = $this->Processkpi_m->doLoadBusiness($data['userid']);
        $data['allkpi']      = $this->Processkpi_m->doLoadKPIUpdate($data['userid']);
        $data['allmenu']      = $this->UserPermission_m->doLoadMenu();
        $data['permissionDetails'] = $this->UserPermission_m->selectPermissionDetails($userId);
        // echo '<pre/>';print_r($data['permissionDetails']);exit();
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
        $data['main_content'] = $this->load->view('userpermission/user_permission_edit', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function saveUpdatedPermission(){
        $data = array();
        $data['entryby'] = $this->session->userdata('userid');
        $data['userid'] = $this->input->post('userid');
        $data['business'] = $this->input->post('business');
        $data['kpi'] = $this->input->post('kpi');
        $data['menu'] = $this->input->post('menu');

        // echo '<pre>';print_r($data);die;

        if($data['userid'] != '' && $data['business'] != '' && $data['kpi'] != '' && $data['menu'] != ''){
            $update = $this->UserPermission_m->doUpdatePermission($data);
        }

        if ($update == true) {
            $msg['message'] = "User Permission Updated Successfully.";
        } else {
            $msg['message'] = "Something went wromg. Pleasre try again.";
        }
        $this->session->set_userdata($msg);

        redirect(base_url('UserPermission'));
    }

    public function autocompleteUserDetails(){

        $empcode = $this->input->post('empcode');

        $userDetails = $this->UserPermission_m->doLoadAutocompleteUserDetails($empcode);

        echo json_encode($userDetails);

    }


}