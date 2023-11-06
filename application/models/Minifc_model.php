<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Minifc_model extends CI_Model
{

    function __construct(){
        parent::__construct();
        $this->copytrade = $this->load->database('copytrade', true);
    }
    public function test(){
            $this->copytrade->reconnect();
            $this->copytrade->select('*');
            $this->copytrade->from('unsubscribed_auto');
            $this->copytrade->limit(1);
            $data = $this->copytrade->get();
            if($data->num_rows() > 0) {
                return $data->row_array();
            }else{
                return false;
            }
            $this->copytrade->close();

    }

}