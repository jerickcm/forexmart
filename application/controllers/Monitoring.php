<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitoring extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(IPLoc::Office()){
        $this->template->title('ForexMart Copy Trading')
//            ->append_metadata_css("
//                 ")
//            ->append_metadata_js("
//                    ")
            ->set_layout('monitoring/main')
            ->build('copytrading/monitoring_internal');
        }
    }
}