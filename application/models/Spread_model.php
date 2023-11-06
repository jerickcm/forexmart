<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spread_model extends CI_Model
{
    private $table = 'spreadChangeTable';

    function __construct()
    {
        parent::__construct();
    }

    public function getInstrumentsByID($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function updateSpread($id, $updateData)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $updateData)) {
            return true;
        } else {
            return false;
        }
    }

    public function getInstrumentsByDateTime($date,$time)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('date_start', $date);
        $this->db->where('time_start <', $time);
        $this->db->or_where('date_end', $date);
        $this->db->where('time_end <', $time);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getInstruments()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function saveInstrumentsResponse($data,$id)
    {
        $this->db->where('id', $id);
        if($this->db->update('instrumentresponse', $data) ){
            return true;
        }else{
            return false;
        }
    }
}