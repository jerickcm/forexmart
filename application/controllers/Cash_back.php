<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_back extends MY_Controller {

	public function index(){
        if($this->input->cookie('forexmart_affiliate1')!=''){
            redirect('');
        }
        if(!IPLoc::Office()){redirect('');}
        $this->lang->load('whychooseus');
		$data['data']['metadata_description'] = lang('wcu_dsc');
		$data['data']['metadata_keyword'] = lang('wcu_kew');
		$this->template->title("Cashback | ForexMart")
			->set_layout('external/main')
			->build('external_cash_back', $data['data']);
	}


}
