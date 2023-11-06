<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->lang->load('contactus');
    }
	public function contact(){

		//$data['data']['metadata_description'] = lang('x_ctu_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('x_ctu_kew');
        $this->lang->load('Location');
		$this->template->title(lang('x_ctu_tit'))
            ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                 ")
			->set_layout('external/main')
			->build('external_contactus', $data['data']);
	}

	public function contact_test(){
        if(IPLoc::Office()){
            $this->lang->load('Location');
            $data['data']['metadata_description'] = lang('x_ctu_dsc');
            $data['data']['metadata_keyword'] = lang('x_ctu_kew');
            $this->template->title(lang('x_ctu_tit'))
                ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                 ")
                ->set_layout('external/main')
                ->build('external_contactus_test', $data['data']);
        }
	}

    public function contact_test2(){
        if(IPLoc::Office()){
            $this->lang->load('Location');
            $data['data']['metadata_description'] = lang('x_ctu_dsc');
            $data['data']['metadata_keyword'] = lang('x_ctu_kew');
            $this->template->title(lang('x_ctu_tit'))
                ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                 ")
                ->set_layout('external/main')
                ->build('external_contactus_test2', $data['data']);
        }
    }
}
