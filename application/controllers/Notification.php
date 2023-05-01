<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_m');
        $this->load->model('Notification_m');
		
    }

	public function index(){ 
		$data = array();
        $data['page'] = 'kpi_notification_all';
        $data['page_title'] = 'All Kpi Information Email';
		$data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['dept_name'] = $this->session->userdata('dept_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['menubar'] = $this->load->view('inc/menubar', $data, TRUE);
        $data['footer'] = $this->load->view('inc/footer', $data, TRUE);
		
		$data['business_rows'] = $this->Notification_m->select_business();
		$data['period_rows'] = $this->Notification_m->select_period();
		if(isset($_POST['Business']) || isset($_POST['Period'])){
			empty($_POST['Business']) ? $data['Business'] = '%' : $data['Business'] = $_POST['Business'];
			empty($_POST['Period']) ? $data['Period'] = '%' : $data['Period'] = $_POST['Period'];
			//print_r($Period);exit();
			$data['rows'] = $this->Notification_m->select_KPI_Anomolies_B_P($data['Business'],$data['Period']);
		}else{
			$data['rows'] = $this->Notification_m->select_KPI_Anomolies();
		}
		
        
        //echo '<pre/>';print_r($data['rows']); exit();
        $data['main_content'] = $this->load->view('Notification/view_all', $data, TRUE);
        $this->load->view('index', $data);
	}

    public function send_mail(){ 

		//echo '<pre>'; print_r($_POST);exit();
	
		$KPICode = $this->input->post('KPICode');
		$To = $this->input->post('To');
		$Cc = $this->input->post('Cc');
		$Business = $this->input->post('Business');
		$Remarks = $this->input->post('Remarks');
		$Link = 'http://dashboard.acigroup.info/businesskpi/processkpi_view/loadreport_ajax_single?kpicode='.$KPICode.'&business='.$Business.'&years&startfromzero=';
		$KPIName = $this->input->post('KPIName');		
		$Period = $this->input->post('Period');
		
		$this->sendemail($To, $Cc, $Link, $KPICode, $KPIName, $Period, $Remarks);
		

    }
	
	public function test(){ 	
			$To = 'jisan@aci-bd.com'; 
			$Cc = 'rifatahmed@aci-bd.com'; 
			$KPICode = 'Pharma'; 
			$KPIName = 'Pharmaceutical';
			$Period = '202102';
			$Remarks = '202102';
			$Link= "http://dashboard.acigroup.info/kpireport/";
			
			$this->sendemail($To, $Cc, $Link, $KPICode, $KPIName, $Period, $Remarks);			
	}
	
	public function sendemail($To, $Cc, $Link, $KPICode, $KPIName, $Period, $Remarks){ 

			
		$this->load->library('phpmailer');
		
		//$Link= "http://dashboard.acigroup.info/kpireport/";
		$html = '<style>
					table {
					  font-family: arial, sans-serif;
					  border-collapse: collapse;
					  width: 100%;
					}

					td, th {
					  border: 1px solid #dddddd;
					  text-align: left;
					  padding: 8px;
					}

					tr:nth-child(even) {
					  background-color: #dddddd;
					}
					</style>
					Dear Concern,
					<br /><br />
					Hope you are doing well. <br />
					The KPI Name  "'.$KPIName.'" Need your immediate attention. Please take necessary action.<br />
					For mode details please click into the link : <a href="'.$Link.'">Click for details</a><br /><br />
					
					Remark Form Sender: '.$Remarks.'
					<br /><br />
					
					** This is a system generated Email.

			</br>
		</br>
		';
            $subject = "KPI Notification";

            $this->email = new PHPMailer(true);
            $this->email->IsSMTP(true); // telling the class to use SMTP
            $this->email->IsHTML(true); // telling the class to use HTML
            //$this->email->Host = "smtp.agni.com"; // SMTP server
            
            $emailext = explode('@',$To);
			//$emailextcc = explode('@',$cc);
            if($emailext[1] == 'aci-bd.com'){
                $this->email->Host = "192.168.1.30"; // SMTP server
            }else{
                $this->email->Host = "smtp.agni.com"; // SMTP server
            }   
			$this->email->Host = "smtp.agni.com"; // SMTP server
            $this->email->Port = 25;
        
            $this->email->SetFrom('info@aci-bd.com', $subject);
            $this->email->AddReplyTo('info@aci-bd.com', $subject);

            
			if(!empty($Cc)){
				$this->email->AddCC($Cc);
			}
			//print_r($this->email);exit();
            //$this->email->AddCC('foodsaudit@aci-bd.com');             
            //$this->email->AddBCC('md.rifatahmed@yahoo.com'); 
            $this->email->AddAddress($To);

            $this->email->Subject = $subject;
            $this->email->MsgHTML($html);
        
            ///echo '<pre/>';print_r($to); 
            //echo '<pre/>';print_r($this->email->Send()); exit();
            if ($this->email->Send()) {
                //print "Done";
            } else {
                //print "Failed";            
            }
            
    }

        public function test2(){     
            
            $FirstEmail = 'zamil@aci-bd.com'; 
            $SecondEmail = 'zamil@aci-bd.com'; 
            $Business = 'Pharma'; 
            $CustomerCode = 'ASDF123';
            $CustomerName = 'ABCName';
            $RenewalDate = '2020-11-05';
            
            $this->sendemail_reminder($FirstEmail, $Business, $CustomerCode, $CustomerName);            
    }
    

    public function sendemail_reminder($FirstEmail, $Business, $PolicyName, $RenewalDate){ 

            //$to = get_email_id($PresentDesk);//'zamil@aci-bd.com';
            $this->load->library('phpmailer');
            //$to = "rifatahmed@aci-bd.com";
            $Link= "http://dashboard.acigroup.info/sopbank/";
            $html = 'Dear Sir,<br></br>
            Notification Renewal Remainder</br></br>
            
            BusinessName: '.$Business.'</br>
            PolicyName: '.$PolicyName.'</br>
            RenewalDate: '.$RenewalDate.'</br></br>
            
            Check the details from the link below: </br></br>
            '.$Link.'
            </br>
            </br>
            ';
            $subject = "SOP Renewal Notification";

            $this->email = new PHPMailer(true);
            $this->email->IsSMTP(true); // telling the class to use SMTP
            $this->email->IsHTML(true); // telling the class to use HTML
            //$this->email->Host = "smtp.agni.com"; // SMTP server
            
            $emailext = explode('@',$FirstEmail);
            if($emailext[1] == 'aci-bd.com'){
                $this->email->Host = "192.168.1.30"; // SMTP server
            }else{
                $this->email->Host = "smtp.agni.com"; // SMTP server
            }   
            $this->email->Port = 25;
        
            $this->email->SetFrom('ear@aci-bd.com', $subject);
            $this->email->AddReplyTo('ear@aci-bd.com', $subject);

            //$this->email->AddCC('rashedul.islam@aci-bd.com');
            //$this->email->AddCC('foodsaudit@aci-bd.com');             
            //$this->email->AddBCC('md.rifatahmed@yahoo.com'); 
            $this->email->AddAddress($FirstEmail);

            $this->email->Subject = $subject;
            $this->email->MsgHTML($html);
        
            ///echo '<pre/>';print_r($to); 
            //echo '<pre/>';print_r($this->email->Send()); exit();
            if ($this->email->Send()) {
                //print "Done";
            } else {
                //print "Failed";            
            }
            
    }

    public function feedback(){ 

		// echo '<pre>'; print_r($_POST);exit();
	
        $data = array();
		$data['KPICode'] = $this->input->post('KPICode');
		$data['Business'] = $this->input->post('Business');
		$data['Feedback'] = $this->input->post('Feedback');
		$data['Rating'] = $this->input->post('Rating');
        $data['EntryBy'] = $this->session->userdata('userid');
        $data['EntryDate'] = date('Y-m-d H:i:s');

        if($data['Feedback'] != '' && $data['Rating'] != ''){
            $insert = $this->Notification_m->doInsertFeedback($data);
		    echo json_encode($insert);
        }
    }
}
