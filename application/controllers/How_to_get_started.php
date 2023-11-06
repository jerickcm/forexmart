<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class How_to_get_started extends MY_Controller {

    public function index() {
        $this->lang->load('Get_started');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['menu_item'] = array('l_j', 'r_f', 'r_g', 'news');
        $data['data']['metadata_keyword'] = lang('gs_kew');
        $this->template->title(lang('gs_tit'))
                ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'chat-support.css">')
                ->set_layout('external/main')
                ->build('external_get_started', $data['data']);
    }
    

}
