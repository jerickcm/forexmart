<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copytrading extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(IPLoc::Office()){
            $css = $this->template->Css();
            $this->template->title('ForexMart Copy Trading')
    //            ->append_metadata_css("
    //                            <link rel='stylesheet' href='".$css."/copytrading/customize.css'>
    //                        ")
    //            ->append_metadata_js("
    //                    ")
                ->set_layout('copytrading/External/main')
                ->build('copytrading/home');
        }
    }

    public function monitoring(){
        if(IPLoc::Office()){
            $this->template->title('ForexMart - Monitoring')
                ->set_layout('external/main')
                ->build('copytrading/monitoring');
        }
    }
}