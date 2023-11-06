<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signout extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');

    }

    public function index(){
        $this->tank_auth->logout();
        //redirect('signin');

        header('Location: '.$this->config->item('domain-www').'/mwp');
    }
    public function admin(){
        $this->tank_auth->logout();
        header('Location: '.$this->config->item('domain-m7').'');
    }
}
