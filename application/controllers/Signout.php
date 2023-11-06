<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signout extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');

    }

    public function index(){
        $this->tank_auth->logout();
        //redirect('signin');

        header('Location: '.$this->config->item('domain-my').'/client/signin');
    }
    public function admin(){
        $this->tank_auth->logout();
        //redirect('signin');

        header('Location: '.$this->config->item('domain-www').'/24admin82/signin');
    }
}
