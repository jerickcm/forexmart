<?php

//class License extends MY_Controller
//{
//    public function __construct(){
//        parent::__construct();
//        $this->load->helper('url');
//    }
//
//    public function index(){
//        $data = array(
//            'errors' => ''
//        );
//
//        //$this->lang->load('licence');
//        $data['metadata_description'] = 'External Licence';
//        $data['metadata_keyword'] = 'External Licence';
//        $this->template->title('External License')
//            ->append_metadata_js("
//                <script src='".$this->template->Js()."licence/bootstrap.min.js'></script>
//                <script src='".$this->template->Js()."licence/jquery-1.11.3.min.js'></script>
//                <script src='".$this->template->Js()."licence/jquery.fancybox.pack.js'></script>
//                <script src='".$this->template->Js()."licence/jquery.js'></script>
//                <script src='".$this->template->Js()."licence/modernizr.custom.js'></script>
//                <script src='".$this->template->Js()."licence/jquery.bookblock.js'></script>
//                <script src='".$this->template->Js()."owl.carousel.js'></script>
//                <script src='".$this->template->Js()."owl.transitions.js'></script>
//            ")
//            ->append_metadata_css("
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/bootstrap.min.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/license.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/bookblock.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/external-style.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/new-external-style.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/affiliate.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/airview.min.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."licenced/slider-index-style.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."owl.theme.css'>
//                <link rel='stylesheet' href='".$this->template->Css()."external-style.css'>
//
//            ")
//
//            ->set_layout('external/main')
//            ->build('external_licence', $data);
//        //   ->build('external_partnership_with_rpj1', $data);
//    }
//}
class License extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->lang->load('license');
    }

    public function index(){
        $data = array(
            'errors' => ''
        );

        //$this->lang->load('licence');
       // $data['metadata_description'] = 'External Licence';

        $data['metadata_description'] = '';
        $data['metadata_keyword'] = 'External Licence';
        $this->template->title(lang('tit_lang'))
            ->append_metadata_js("
                <script src='".$this->template->Js()."licence/modernizr.custom.js'></script>
                <script src='".$this->template->Js()."owl.carousel.js'></script>
                <script src='".$this->template->Js()."licence/jquery.bookblock.js'></script>
            ")
            ->append_metadata_css("
                <link rel='stylesheet' href='".$this->template->Css()."licenced/bootstrap.min.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/license.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/bookblock.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/external-style.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/new-external-style.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/affiliate.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/airview.min.css'>
                <link rel='stylesheet' href='".$this->template->Css()."licenced/slider-index-style.css'>
                <link rel='stylesheet' href='".$this->template->Css()."owl.theme.css'>
                <link rel='stylesheet' href='".$this->template->Css()."external-style.css'>
                <style>
                    .parent-custom-size,.screnMsg_caption{
                        margin:0px;
                    }
                </style>

            ")

            ->set_layout('external/main')
            ->build('external_licence', $data);
    }
}