<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends MY_Controller {

	public function index(){
		$this->lang->load('AboutUs');
		$data['data'] = '';
		//$data['data']['metadata_description'] = lang('x_abt_us_dsc');
        $data['data']['metadata_description'] = '';
		$data['data']['metadata_keyword'] = lang('x_=abt_us_kew');
        $data['data']['menu_item']=array('l_a','l_g','r_a','l_k');
		$this->template->title(lang('x_abt_us_tit'))
			->set_layout('external/main')
			->build('external_AboutUs', $data['data']);

	}

}
