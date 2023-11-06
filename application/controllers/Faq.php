<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->lang->load('Faq');
	}
	public function index(){
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('fq_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('fq_kew');
		$this->template->title(lang('fq_tit'))
			->append_metadata_js("
                        <script src='" . $this->template->Js() . "/listfilter.min.js'></script>
                ")
			->set_layout('external/main')
			->build('external_faq', $data['data']);
	}
}
