<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forex_calculator extends MY_Controller {

	public function index(){
		$this->lang->load('calculator');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		$data['data']['CurrencyPair'] = $this->general_model->getCurrenciesPairFI();
		$data['data']['Leverage'] = $this->general_model->getFCLeverage();
		$data['data']['Volume'] = $this->general_model->getFCVolume();
		$data['data']['Currency'] = $this->general_model->getAccountCurrencyBase3();
		//$data['data']['metadata_description'] = lang('x_fc_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('x_fc_kew');
		$this->template->title(lang('x_fc_tit'))
			->append_metadata_css('
                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2-bootstrap.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2.css">
                 ')
			->append_metadata_js('
                <script src="' . $this->template->Js() . 'select2.js" type="text/javascript"></script>
            ')
			->set_layout('external/main')
			->build('external_ForexCalculator', $data['data']);
	}
}
