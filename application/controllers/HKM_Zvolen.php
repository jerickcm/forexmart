<?php

class HKM_Zvolen extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->lang->load('hkm');
    }

    public function index(){

       //  $data['metadata_description'] = lang('hkm_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('hkm_kew');

        $this->template->title(lang('hkm_tit'))
            ->set_layout('external/main')
            ->append_metadata_css("
                <link rel='stylesheet' href='".$this->template->Css()."rpj/jquery.fancybox.css'>
                <link rel='stylesheet' href='".$this->template->Css()."owl.theme.css'>
                <link rel='stylesheet' href='".$this->template->Css()."owl.carousel.css'>
                <link rel='stylesheet' href='".$this->template->Css()."hkm/animate.css'>
                <link rel='stylesheet' href='".$this->template->Css()."hkm/hkm-partner.css'>
            ")
            ->prepend_metadata("
                <script src='" . $this->template->Js() . "rpj/jquery.fancybox.pack.js'></script>
                <script src='" . $this->template->Js() . "rpj/jquery.slitslider.js'></script>
                <script src='" . $this->template->Js() . "rpj/scrolling-nav.js'></script>
            ")
            ->build('external_Partnership_HKM', $data);
    }
}