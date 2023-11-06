<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ceo extends MY_Controller {

    function __construct(){

    }

    public function index(){
        $this->lang->load('ceo');
        $this->template->title("CEO Letter | ForexMart")
            ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'letter.css">
                 ')
            ->set_layout('external/main')
            ->build('ceo');
    }
}