<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_and_conditions extends MY_Controller {
    public function index()  {
        $this->lang->load('termsandconditions');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('tac_kew');
        $this->template->title(lang('tac_tit'))
            ->set_layout('external/main')
            ->build('external_TermsandConditions', $data['data']);
    }

}
