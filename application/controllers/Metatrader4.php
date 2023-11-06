<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metatrader4 extends MY_Controller {

	public function index(){
		$this->lang->load('metatrader4');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

		$data['data']['metadata_description'] = lang('mt4_dsc');
		$data['data']['metadata_keyword'] = lang('mt4_kew');
		$data['data']['form'] = Form_key::InputKey_array();
		$this->template->title(lang('mt4_tit'))
			->set_layout('external/main')
			->append_metadata_css("
                            <link rel='stylesheet' href='" . $this->template->Css() . "/mt4.css'>
                        ")
			->build('external_MetaTrader4', $data['data']);
	}

	public function download(){
		if ($this->input->is_ajax_request()) {
			if(Form_key::isValid(trim($this->input->post('key',true)))){
				$this->load->model('general_model');
				$data = array(
					'date' => FXPP::getServerTime(),
					'ip_address' => $this->input->ip_address()
				);
				$this->general_model->insert('mt4_downloads', $data);
				$is_counted = true;
			}else{
				$is_counted = false;
			}

			$data = array(
				'is_counted' => $is_counted
			);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			show_404();
		}
	}
}
