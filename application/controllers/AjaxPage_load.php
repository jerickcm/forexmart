<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxPage_load extends MY_Controller {

	
  public function forexMajorTab(){
      session_write_close(); // developing a website with heavy AJAX usage
        if($this->input->is_ajax_request()){
          
            $data['majorfX']=FXPP::getBuyAndSellStatsResult();
            $this->load->view('forex_major',$data);
        }
        else
        {
            echo "Not found.";
        }
    }
 
}
