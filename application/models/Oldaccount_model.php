<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Oldaccount_model extends CI_Model
{
    function __construct(){
        parent::__construct();
        $this->log_db = $this->load->database('oldaccount', true);
    }

    function insert_log($table,$data){
        $this->log_db->reconnect();
        if ($this->log_db->insert($table, $data)){
            return $this->log_db->insert_id();
        }else{
            return false;
        }
        $this->log_db->close();
    }
    function update_log($table,$field,$id,$data){
        $this->log_db->reconnect();
        $this->log_db->where($field, $id);
        $this->log_db->update($table, $data);
        if ($this->log_db->affected_rows() > 0){
            return true;
        }
        return false;
        $this->log_db->close();
    }
    function rowdelete1($table,$field,$id){
        $this->log_db->reconnect();
        $this->log_db->where($field, $id);
        $this->log_db->delete($table);
        if ($this->log_db->affected_rows() > 0){
            return true;
        }
        return false;
        $this->log_db->close();
    }
    function rowdelet2($table,$field,$id,$field2,$id2){
        $this->log_db->reconnect();
        $this->log_db->where($field, $id);
        $this->log_db->where($field2, $id2);
        $this->log_db->delete($table);
        if ($this->log_db->affected_rows() > 0){
            return true;
        }
        return false;

    }
    function showsaccount($table,$field="",$id="",$select=""){
        $this->log_db->reconnect();
        $this->log_db->select($select);
        $this->log_db->from($table);
        $this->log_db->where($field, $id);
        $data = $this->log_db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
        $this->log_db->close();
    }
}