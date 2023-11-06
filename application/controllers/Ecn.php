<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecn extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        // $this->load->library('form_validation');
    }

    public function index(){
        $this->lang->load('ecn');
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $js = $this->template->Js();
        // $data['account_currency_base'] = $this->general_model->selectOptionList($this->general_model->getAccountCurrencyBase(),'EUR');
        // to be change
        $data['metadata_description'] = lang('x_exn_dsc');
        $data['metadata_keyword'] = lang('x_exn_dsc');
        $data['menu_item']=array('l_e','l_f','l_g','l_h','l_i','r_d','r_f','r_g','r_h','news');
        $this->template->title(lang('x_ecn_ttle'))
            ->append_metadata_js("
                      <script src='".$js."jquery-1.11.3.min.js'></script>
                      <script src='".$js."simplbox.min.js'></script>
                ")
            ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'ecn.css">')
            ->set_layout('external/main')
            ->build('ecn',$data);
            // end to be hw_changeobject(link, objid, attributes)
    }

 







}

