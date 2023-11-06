<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_type extends MY_Controller {
	public function index(){
		$this->lang->load('accountcomparison');
		//$data['data']['metadata_description'] = lang('accntcomp_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('accntcomp_kew');
        $data['data']['menu_item']=array('l_c','l_e','l_f','l_g','r_c','r_e','l_k');
		$this->template->title(lang('accntcomp_tit'))
			->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'chat-support.css">')
			->set_layout('external/main')
			->build('account_type',$data['data']);
	}
}
