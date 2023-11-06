<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webtrader extends CI_Controller {

	public function index(){

        /*registration_log*/
        $data['log']=array(
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'referrer'=>$_SERVER['HTTP_REFERER'],
            'type'=>0
        );

        $this->general_model->insertmy($table="webtrader_logs",$data['log']);
        /*registration_log*/

        header("Location: https://webtrader.forexmart.com/login");
	}
    public function sell(){
        /*registration_log*/
        $data['log']=array(
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'referrer'=>$_SERVER['HTTP_REFERER'],
            'type'=>1
        );

       $this->general_model->insertmy($table="webtrader_logs",$data['log']);
        /*registration_log*/

        header("Location: https://webtrader.forexmart.com/login");
    }
    public function buy(){

        /*registration_log*/

        $data['log']=array(
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'referrer'=>$_SERVER['HTTP_REFERER'],
            'type'=>2
        );

        $this->general_model->insertmy($table="webtrader_logs",$data['log']);
        /*registration_log*/

        header("Location: https://webtrader.forexmart.com/login");
    }
    public function deposit(){

        /*registration_log*/

        $data['log']=array(
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'referrer'=>$_SERVER['HTTP_REFERER'],
            'type'=>3

        );

        $this->general_model->insertmy($table="webtrader_logs",$data['log']);
        /*registration_log*/

        header("Location: https://webtrader.forexmart.com/login");
    }
}
