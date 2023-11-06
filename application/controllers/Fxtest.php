<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fxtest extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->lang->load('vpshosting');
        $this->lang->load('vpsmailing');
    }

    public function index(){
        //$to = 'imaritelle01@jourrapide.com';
//        $to = 'tomhardy1293@gmail.com';
//        $name = "Imari";
//        Fx_mailer::vpsServices1($to,$name);
//        $data['data']['metadata_description'] = lang('vps_dsc');
//        $data['data']['metadata_keyword'] = lang('vps_kew');
//        $this->template->title(lang('vps_tit'))
//            ->set_layout('external/main')
//            ->build('external_vpsHosting', $data['data']);
    }
}