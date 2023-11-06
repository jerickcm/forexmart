
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chance_Bonus extends MY_Controller {

    public function index()
    {

            $this->lang->load('Chance');
            $data['metadata_description'] = lang('x_awd_dsc');
            $data['metadata_keyword'] = lang('x_awd_kew');
            $this->template->title(lang('x_chn_kew'))
                ->append_metadata_css('
                      <link rel="stylesheet" href="' . $this->template->Css() . 'chance-bonus.css">
                      <link  rel="stylesheet" href="' . $this->template->Css() . 'external-style.css">')
                ->set_layout('external/main')
                ->build('chance_bonus', $data);
        }
    

}