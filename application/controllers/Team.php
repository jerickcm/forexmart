<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends MY_Controller {

    public function index(){
        $this->lang->load('team_lang');
        $data['data']['metadata_description'] = lang('team_dsc');
        $data['data']['metadata_keyword'] = lang('team_kew');
        $this->template->title(lang('team_tit'))
            ->append_metadata_css("
                <link rel='stylesheet' href='".$this->template->Css()."member.css'>
                <link rel='stylesheet' href='".$this->template->Css()."style.css'>
            ")
            ->set_layout('external/main')
            ->build('external_team', $data['data']);
    }
}
