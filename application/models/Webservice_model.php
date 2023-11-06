<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Webservice_model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->log_db = $this->load->database('logs', true);

    }

    function insertmy($table,$data){
        $this->log_db->reconnect();
        if ($this->log_db->insert($table, $data)){
            return $this->db->insert_id();
        }
        return false;
        $this->log_db->close();
    }
}
