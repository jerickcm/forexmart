<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 1/12/16
 * Time: 9:46 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Las_palmas_promo  extends MY_Controller{
    public function __construct() {
        parent::__construct();

    }

    public  function index(){
            $this->load->view('external_las_palmas_promo');
    }
} 