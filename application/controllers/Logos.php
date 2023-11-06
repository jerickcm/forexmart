<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logos extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load('logos');
	}

	public function index(){
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = 'Integrate our eye-catching, sophisticated banner on your website, blog, or personal site to advertise our offerings.';
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart logos';
		$this->template->title("ForexMart Logos")
			->set_layout('external/main')
			->build('external_logos', $data['data']);
	}
}
