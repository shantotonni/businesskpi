<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('kpi_model');
    }

    public function kpiCategoryforms() {

        $data = array();
        $data['page'] = 'kpiCategoryforms';
        $data['page_title'] = 'Add KPI Category';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/kpicategory_forms', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function kpiCategoryformsaction() {

        if (isset($_POST)) {
            $dept_name = $this->input->post('kpiCategoryName');

            $kpi_sort_order = $this->kpi_model->getLastSortOrder();
            foreach ($kpi_sort_order as $kso) {
                $sortOrder = $kso['SortOrder'];
            }
            $sortOrder+=10;
            $datakpi = array(
                'KpiCatName' => $dept_name,
                'SortOrder' => $sortOrder
            );
            $res = $this->kpi_model->submitKpiCategory($datakpi, "KpiCategory");
            if ($res) {
                $this->session->set_userdata('success', 'New Category Added');
            } else {
                $this->session->set_userdata('success', 'Failed to add KPI');
            }
            redirect('home/kpiCategoryforms', 'refresh');
        }
    }

    public function view_allkpiCategory() {

        $data = array();
        $data['page'] = 'view_allkpiCategory';
        $data['page_title'] = 'All Kpi Category';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_cat_data'] = $this->kpi_model->selectkpicat();
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/allkpicategory_data', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function edit_kpicategory() {
        if (isset($_POST)) {
            $categoryName = $this->input->post('tag_textTo');
            $categoryId = $this->input->post('tag_idTo');
            $isSuccess = $this->kpi_model->editkpicat($categoryId, $categoryName);
        }
    }

    public function view_appraisal() {
        echo 'Success';
    }

    public function kpiDetailsforms() {

        $data = array();
        $data['page'] = 'kpiDetailsforms';
        $data['page_title'] = 'Add KPI Name';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_cat_data'] = $this->kpi_model->selectkpicat();
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/kpidetails_forms', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function kpiDetailformsaction() {

        if (isset($_POST)) {
            $cat_name = $this->input->post('kpiCategoryName');
            $cat_id = $this->input->post('kpiCategoryId');

            $kpi_sort_order = $this->kpi_model->getLastSortOrderFromDetails();

            foreach ($kpi_sort_order as $kso) {
                $sortOrder = $kso['SortOrder'];
            }
            $sortOrder+=30;
            $datakpi = array(
                'KpiCatId' => $cat_id,
                'KpiName' => $cat_name,
                'SortOrder' => $sortOrder
            );
            $res = $this->kpi_model->submitKpiDetails($datakpi, "KpiDetails");
            if ($res) {
                $this->session->set_userdata('success', 'New KPI Added');
            } else {
                $this->session->set_userdata('success', 'Failed to add KPI');
            }
            redirect('home/kpiDetailsforms', 'refresh');
        }
    }

    public function view_kpiDetails() {

        $data = array();
        $data['page'] = 'view_allkpiDetails';
        $data['page_title'] = 'All Kpi Names';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_cat_data'] = $this->kpi_model->selectkpidetails();
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/allkpidetails_data', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function edit_kpidetails() {
        if (isset($_POST)) {
            $categoryName = $this->input->post('tag_textTo');
            $categoryId = $this->input->post('tag_idTo');
            $isSuccess = $this->kpi_model->editkpidetails($categoryId, $categoryName);
        }
    }

    public function delete_kpidetails() {
        if (isset($_POST)) {
            $categoryId = $this->input->post('tag_idTo');
            $isSuccess = $this->kpi_model->deletekpidetails($categoryId);
        }
    }

    public function assign_kpi() {

        $data = array();
        $data['page'] = 'assign_kpi';
        $data['page_title'] = 'Assign KPI';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_cat_data'] = $this->kpi_model->selectkpicat();
        //$data['kpi_data'] = $this->kpi_model->selectkpi();

        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/assign_kpi_forms', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function getkpi() {
        if (isset($_POST)) {
            $id = $this->input->post('id');
            $data['kpi_data'] = $this->kpi_model->selectkpi($id);
            $this->load->view('kpi/getkpi', $data);
        }
    }

    public function assignkpiformsaction() {

        if (isset($_POST)) {
            $assignkpi_name = $this->input->post('assignkpiName');
            $assignid = $this->input->post('kpiId');
            $assignkpi_id = $this->input->post('kpiCategoryId');
            $assignkpi_target = $this->input->post('assignkpiTarget');
            $assignkpi_weight = $this->input->post('assignkpiWeight');

            $datakpi = array(
                'EmpCode' => $assignkpi_name,
                'KpiId' => $assignid,
                'KpiCatId' => $assignkpi_id,
                'Target' => $assignkpi_target,
                'Weight' => $assignkpi_weight
            );
            $res = $this->kpi_model->submitKpiCategory($datakpi, "AssignKpi");
            if ($res) {
                $this->session->set_userdata('success', 'KPI assingned successfully');
            } else {
                $this->session->set_userdata('success', 'Failed to assingn KPI');
            }
            redirect('home/assign_kpi', 'refresh');
        }
    }

    public function edit_assign_kpi() {

        $data = array();
        $data['page'] = 'edit_assign_kpi';
        $data['page_title'] = 'Edit KPI';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_cat_data'] = $this->kpi_model->selecteditkpidetails($data['userid']);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/edit_kpi', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function edit_kpi_ajax() {

        if (isset($_POST)) {
            $data = array();
            $data['target'] = $this->input->post('Target');
            $data['weight'] = $this->input->post('Weight');
            $data['assignId'] = $this->input->post('AssignId');
            $isSuccess = $this->kpi_model->editkpiajax($data);
        }
    }

    public function delete_kpi_ajax() {
        if (isset($_POST)) {
            $data = array();
            $data['assignId'] = $this->input->post('AssignId');
            $data['isSuccess'] = $this->kpi_model->deletekpiajax($data);
        }
    }

    public function addSupervisor() {

        $data = array();
        $data['page'] = 'addSupervisor';
        $data['page_title'] = 'Add Supervisor';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/addSupervisor', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function supervisoraction() {

        if (isset($_POST)) {
            $empCode = $this->input->post('empCode');
            $superCode = $this->input->post('superCode');

            $datakpi = array(
                'EmpCode' => $empCode,
                'SuperCode' => $superCode
            );
            $res = $this->kpi_model->submitKpiCategory($datakpi, "Supervisor");
            if ($res) {
                $this->session->set_userdata('success', 'Supervisor added successfully');
            } else {
                $this->session->set_userdata('success', 'Failed to add Supervisor');
            }
            redirect('home/addSupervisor', 'refresh');
        }
    }

    public function editSupervisorForm() {
        $data = array();
        $data['page'] = 'addSupervisor';
        $data['page_title'] = 'Add Supervisor';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['kpi_supervisor_data'] = $this->kpi_model->selectSupervisor();
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $data['main_content'] = $this->load->view('kpi/editSupervisor', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function editSupervisorAjaxaction() {
        if (isset($_POST)) {
            $Id = $this->input->post('tag_idTo');
            $superCode = $this->input->post('SuperTo');
            $this->kpi_model->editSupervisor($Id, $superCode);
            //redirect('home/editSupervisorForm', 'refresh'); 
        }
    }

}
