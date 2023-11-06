<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class How_to_install_ea extends MY_Controller {

    public function index() {
        $this->lang->load('install_ea');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['menu_item'] = array('l_j', 'r_f', 'r_g', 'news');
        $data['data']['metadata_keyword'] = lang('ea_kew');
        $this->template->title(lang('ea_tit'))
                ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'chat-support.css">')
                ->set_layout('external/main')
                ->build('how_to_install_ea', $data['data']);
    }
    

}
