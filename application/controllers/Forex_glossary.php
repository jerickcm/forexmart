<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forex_glossary extends MY_Controller {
	public function index(){
		/*if (!IPLoc::WhitelistPIPCandCC()) {
			redirect('');
		}*/
		$this->lang->load('forexglossary');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		//$data['data']['metadata_description'] = lang('x_forglo_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('x_forglo_kew');
		$this->template->title(lang('x_forglo_tit'))
			->append_metadata_js("
                          <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                          <script src='" . $this->template->Js() . "jquery.dataTables.js'></script>
                          <script src='" . $this->template->Js() . "Moment.js'></script>
                          <script src='" . $this->template->Js() . "datetime-moment.js'></script>
                          <script src='" . $this->template->Js() . "dataTables.bootstrap.js'></script>
                    ")
			->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">

                 ')
			->set_layout('external/main')
			->build('external_ForexGlossary', $data['data']);
	}
}