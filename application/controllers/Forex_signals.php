<?php
/**
 * Created by PhpStorm.
 * User: IT4 Admin
 * Date: 2/27/17
 * Time: 2:08 PM
 */

class Forex_signals extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper("url");
        $this->nlanguage = FXPP::html_url();
        $this->load->model('account_model');

    if(IPLoc::Office()){
    } else{
        redirect('not_found');
    }

    }
    public function index(){
        if(IPLoc::Office()){
            $data['data']['metadata_description'] = lang('ar_dsc');
            $data['data']['metadata_keyword'] = lang('ar_dsc');
            $data['data']['menu_item'] = array('l_h','l_i','l_a','l_j','r_a','r_c','r_e','r_f','news','l_k');
            $this->template->title('Forex Signal')
                ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'forexsignals.css">')
                ->set_layout('external/main')
                ->build('external_forex_signals', $data['data']);
           }
        }

    public function bio($url){
        if(IPLoc::Office()){

            $data['data']['bio'] = $this->account_model->getBioData('forex_signal_bio', array('url' =>trim($this->uri->segment(2))));
            $data['data']['metadata_description'] = lang('ar_dsc');
            $data['data']['metadata_keyword'] = lang('ar_dsc');
            $data['data']['menu_item'] = array('l_h','l_i','l_a','l_j','r_a','r_c','r_e','r_f','news','l_k');
            $this->template->title('Forex Signal')
                ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'forexsignals.css">')
                ->set_layout('external/main')
                ->build('external_forex_signals_bio', $data['data']);
        }
    }

} 