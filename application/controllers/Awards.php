<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awards extends MY_Controller {

    public function index()
    {

            $this->lang->load('awards');
            $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', null, true);
            $data['metadata_description'] = lang('x_awd_dsc');
            $data['metadata_keyword'] = lang('x_awd_kew');
            $this->template->title(lang('x_awd_kew'))
                ->append_metadata_css('
                      <link rel="stylesheet" href="' . $this->template->Css() . 'awards.css">
                      <link rel="stylesheet" href="' . $this->template->Css() . 'hover.css">
                      <link rel="stylesheet" href="' . $this->template->Css() . 'affiliate.css">
                      <link  rel="stylesheet" href="' . $this->template->Css() . 'awardMobile-style.css">
                      <link  rel="stylesheet" href="' . $this->template->Css() . 'new-external-style.css">
                      <link  rel="stylesheet" href="' . $this->template->Css() . 'slider-index-style.css">')
                ->set_layout('external/main')
                ->build('awards', $data);
        }
    
}