<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rpj_racing extends MY_Controller {

    public function index(){
        $this->lang->load('rpjracing');
        $data = array('errors' => '');

        $data['metadata_description'] = lang('x_tr_dsc');
        $data['metadata_keyword'] = lang('x_tr_kew');
//        $build = IPLoc::Office()?'external_partnership_with_rpj':'external_partnership_with_rpj1';
        $this->template->title(lang('rpj_23') . ' | ' . lang('rpj_10'))
            ->set_layout('external/main')
            ->build('external_partnership_with_rpj', $data);
    }
    public function index_test(){
        $this->lang->load('rpjracing');
        $data = array('errors' => '');

        $data['metadata_description'] = lang('x_tr_dsc');
        $data['metadata_keyword'] = lang('x_tr_kew');
//        $build = IPLoc::Office()?'external_partnership_with_rpj':'external_partnership_with_rpj1';
        $this->template->title(lang('rpj_23') . ' | ' . lang('rpj_10'))
            ->set_layout('external/main')
            ->build('external_partnership_with_rpj1', $data);
    }
}