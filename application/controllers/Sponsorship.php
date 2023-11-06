<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsorship extends MY_Controller {

    public function index()
    {
        $this->lang->load('sponsorship');
        $data['data']['metadata_description'] = lang('s_dsc');
        $data['data']['metadata_keyword'] = lang('s_kew');
        $this->template->title(lang('s_tit'))
            ->set_layout('external/main')
            ->build('external_sponsorship', $data['data']);
    }
}
