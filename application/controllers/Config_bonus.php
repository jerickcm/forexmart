<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_bonus extends CI_Controller {

	public function index(){


			$depositAmount = array("10000", "5000", "3000", "1000", "500", "250", "100", "50", "30", "20", "10");
             $data['depositAmount'] = $depositAmount;
		$this->template->title('Configure Bonus')
            ->append_metadata_js('
                <script src="https://code.jquery.com/jquery-1.12.0.min.js" ></script>
                <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
                <script src="'.$this->template->js().'highcharts.js"></script>
                <script src="'.$this->template->js().'exporting.js"></script>
                ')
            ->set_layout('external/main')
            ->build('external_config_bonus', $data);
	}
}