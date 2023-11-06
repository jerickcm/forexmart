<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Copytrade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->lang->load('contactus');
        $this->lang->load('copytrade');
    }

    public function index() {

        $data['data']['metadata_description'] = lang('cpy_mon_dsc');
        $data['data']['metadata_keyword'] = lang('cpy_mon_kew');

        $data['acc1'] = 258739;
    //        FXPP-8748  [Urgent] Update the account of Project 2 in copytrade in FXPP
    //        $data['acc2'] = 258746;
        $data['acc2'] = 265782;
        $data['acc3'] = 258747;
        /*get*/
        $this->load->model('Task_model');



        if($this->session->userdata('logged')){

            $data['btn1']= lang('cpy_mon_box_but1');
            $data['btn2']= lang('cpy_mon_box_but1');
            $data['btn3']= lang('cpy_mon_box_but1');

            $session_account_number = $_SESSION['account_number'];
            $webservice_config = array('server' => 'minifcservice');
            $WS_I = new WebService($webservice_config);
            $account_info = array('iFollowerAccount' => $session_account_number);
            $WS_I->open_GetFollowerSubscriptionInfo($account_info);

            if ($WS_I->request_status === 'RET_OK') {
                if ($WS_I->get_result('IsSubscribed')=='true'){
                    switch($WS_I->get_result('MasterAccount')){
                        case $data['acc1']:
                            $data['btn1']=lang('cpy_mon_box_but3');
                            break;
                        case $data['acc2']:
                            $data['btn2']=lang('cpy_mon_box_but3');
                            break;
                        case $data['acc3']:
                            $data['btn3']=lang('cpy_mon_box_but3');
                            break;
                    }
                }
            }elseif($WS_I->request_status === 'RET_ACCOUNT_NOT_FOUND'){

            }else{

            }
        }else{
            $data['btn1']=$data['btn2']=$data['btn3']= lang('cpy_mon_box_but1');
        }


        $css = $this->template->Css();
        $js = $this->template->Js();
        $this->template->title(lang('cpy_mon_tit'))
                ->append_metadata_css("
                      <link rel='stylesheet' href='" . $css . "threecharts.css'>
                 ")
                ->append_metadata_js("
                    <script src='" . $js . "Moment.js'></script>
                    <script src='" . $js . "datetime-moment.js'></script>
                    <script src='https://code.highcharts.com/highcharts.js'></script>
                    <script src='https://code.highcharts.com/modules/exporting.js'></script>
                ")
                ->set_layout('external/main')
                ->build('external_threecharts', $data);
    }

}
