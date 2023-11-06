<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate_link extends MY_Controller {

	public function index(){
		$this->lang->load('affiliatelink');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
       // $data['data']['metadata_description'] = lang('al_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('al_kew');
        $this->template->title(lang('al_tit'))
			->set_layout('external/main')
			->build('external_AffiliateLink', $data['data']);
	}
}
