<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MailManual extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        // if(!IPLoc::Office()){redirect("");}
    }


    public function manualAddToStagingAndLive(){
        echo "exit";
        exit();
          error_reporting(E_ALL);
          ini_set('display_errors', 1);
          ini_set('memory_limit', '-1');
        @ini_set('max_execution_time',0);
        $this->load->Model('Mailer_model');
        
        foreach ($arrayName as $key => $value) {
          if ( $this->Mailer_model->massmailuniq($value) ) {
            $Unsubscribe_key = FXPP::generateUnsubscribeKeyMassMailer();
            $insert = array(
                'Email' => $value,
                'Full_name' => 'Client' ,
                'Language' => 'RU' ,
                'Login_type' =>  '3' ,
                'Unsubscribe_key'   => $Unsubscribe_key
            );
            $this->Mailer_model->insert_dynamic('MassMailer',$insert);
            self::addToStaging($value,$Unsubscribe_key);
          }else{
            echo "already in table=====";
            print_r($value);
            echo "<br>";
            
          }

        }


      } 

    public function addToStaging($Email,$Unsubscribe_key){
        $ch = curl_init();
        $data = array('Email' => $Email,'Unsubscribe_key'=> $Unsubscribe_key);
        curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/MailManual/manualAddToStagingAndLive");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        return $server_output;
    }




    // end
}