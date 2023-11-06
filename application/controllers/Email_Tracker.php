<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_Tracker extends CI_Controller {



	public function index(){
		if(!IPLoc::Office()){
			redirect('https://www.forexmart.com/');
			return false;
		}

		// if($_SERVER['REMOTE_ADDR'] != '88.198.94.228'){
		// 	redirect('https://www.forexmart.com/');
		// 	return false;
		// }
		 	$this->load->model('General_Model');

		 	// Client

			$PeriodicClient_mailSent = $this->General_Model->show_mailer_periodic_emailTracker('2017-03-23','0');
			$PeriodicClient_mailOpened = $this->General_Model->show_emailTracker_mailerPeriodic('0');
			$openRate =  $PeriodicClient_mailOpened[0]['counter_email_tracker'] / $PeriodicClient_mailSent[0]['counter'];
			$total_OpenRate = $openRate * 100;
			$data['PeriodicClient_mailSent'] = $PeriodicClient_mailSent[0]['counter'];
			$data['PeriodicClient_mailOpened'] = $PeriodicClient_mailOpened[0]['counter_email_tracker'];
			$data['PeriodicClient_mailOpenRate'] = round($total_OpenRate,2);
			$data['PeriodicClient_mailOpenRate_Overall_Percent'] = 100 - round($total_OpenRate,2);

			// -- Client End --

			// Partner

				$PeriodicPartner_mailSent = $this->General_Model->show_mailer_periodic_emailTracker('2017-03-23','1');
				$PeriodicPartner_mailOpened = $this->General_Model->show_emailTracker_mailerPeriodic('1');
				$openRatePartner =  $PeriodicPartner_mailOpened[0]['counter_email_tracker'] / $PeriodicPartner_mailSent[0]['counter'];
				$total_OpenRatePartner = $openRatePartner * 100;
				$data['PeriodicPartner_mailSent'] = $PeriodicPartner_mailSent[0]['counter'];
				$data['PeriodicPartner_mailOpened'] = $PeriodicPartner_mailOpened[0]['counter_email_tracker'];
				$data['PeriodicPartner_mailOpenRate'] = round($total_OpenRatePartner,2);
				$data['PeriodicPartner_mailOpenRate_Overall_Percent'] = 100 - round($total_OpenRatePartner,2);

			// -- Partner End --
		    $this->template->title('Email Tracker')
            ->append_metadata_js('
                <script src="https://code.jquery.com/jquery-1.12.0.min.js" ></script>
                <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
                <script src="'.$this->template->js().'highcharts.js"></script>
                <script src="'.$this->template->js().'exporting.js"></script>
                ')
            ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'email_tracker.css">')
            ->set_layout('external/main')
            ->build('external_email_tracker', $data);
	}

	public function request_image(){
			$this->load->Model('General_Model');
			$file = 'https://www.forexmart.com/assets/images/mailer_image1x1.png';
		    ob_end_clean();
		    $this->output->set_header('Content-Type: images/');
		    readfile($file);

		    $email = filter_var(str_replace("'","",$_GET['email']), FILTER_SANITIZE_URL);
			$unsubscribekey = filter_var(str_replace("'","",$_GET['key']), FILTER_SANITIZE_URL);
			$methodname = filter_var(str_replace("'","",$_GET['methodname']), FILTER_SANITIZE_URL);

			$data = array(
					'email' => $email,
					'unsubscribekey' => $unsubscribekey,
					'date_opened' => date('Y-m-d H:i:s'),
					'methodname' => $methodname
				);

          	$validator = $this->General_Model->show_emailTracker($email,$unsubscribekey);
          	if(empty($validator)){
          		$this->General_Model->insert('email_tracker',$data);
          	
          	}
	}

	public function request_image_to(){
			$this->load->Model('General_Model');
			$file = 'https://www.forexmart.com/assets/images/mailer_image1x1.png';
		    ob_end_clean();
		    $this->output->set_header('Content-Type: images/');
		    readfile($file);
			$data = array(
					'email' => $_GET['email'],
					'unsubscribekey' => $_GET['key'],
					'date_opened' => date('Y-m-d H:i:s'),
					'email_id' => $_GET['email_id'],
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'ip_address2' => $_SERVER['HTTP_X_FORWARDED_FOR'],
				);
          	$validator = $this->General_Model->checkEmailTracker($data['email'],$data['email_id']);
          	if($validator){
          		$this->General_Model->insert('emailstats_tradeoffer',$data);
          	}
	}


	public function requestImageForMassMail(){
			$this->load->Model('General_Model');
			$file = 'https://www.forexmart.com/assets/images/mailer_image1x1.png';
		    ob_end_clean();
		    $this->output->set_header('Content-Type: images/');
		    readfile($file);

			$data = array(
				'Mailer6' => 1
			);

			$data2 = array(
				'Mailer7' => 1
			);

			$data3 = array(
				'Mailer8' => 1
			);
				// print_r($_GET);

			if ($_GET['Mailer'] == 'Mailer6') {
				$this->General_Model->updatemy('MassMailer', 'Email', filter_var(str_replace("'","",$_GET['email']), FILTER_SANITIZE_URL), $data);
			}elseif ($_GET['Mailer'] == 'Mailer7') {
				$this->General_Model->updatemy('MassMailer', 'Email', filter_var(str_replace("'","",$_GET['email']), FILTER_SANITIZE_URL), $data2);
			}elseif ($_GET['Mailer'] == 'Mailer8') {
				$this->General_Model->updatemy('MassMailer', 'Email', filter_var(str_replace("'","",$_GET['email']), FILTER_SANITIZE_URL), $data3);
			
			}
	}


	public function testingGet(){
		echo $_GET['email'];
		echo "<br>";
		echo filter_var(str_replace("'","",$_GET['email']), FILTER_SANITIZE_URL);
	}





	// public function checkIfFieldExist($Mailer){
	// 	error_reporting(E_ALL);
 //        ini_set('display_errors', 1);
 //        ini_set('memory_limit', '-1');
 //      @ini_set('max_execution_time',0);
	// 	$this->load->Model('Mailer_model');
	// 	if ($this->Mailer_model->checkIfFieldExist($Mailer)) {
	// 		echo "true";
	// 	}else{
	// 		echo "false";
	// 	}
	// }



}