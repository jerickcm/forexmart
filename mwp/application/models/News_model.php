<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllNewsCount()
    {
        $this->db->from('news');
        $this->db->where('enabled', 1);
        return $this->db->count_all_results();
    }

    function getLimitNews( $limit, $offset ){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getNewsById( $id ){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updateNewsById( $id, $data ){
        $this->db->where('id', $id);
        if($this->db->update('news', $data)){
            return true;
        }else{
            return false;
        }
    }

    function getNewsHeadline(){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->where('featured', 1);
        $this->db->order_by('date_created', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getLatestNewsByLimit($limit, $offset){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('date_created DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getMostReadNewsByLimit($limit, $offset){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('news.read DESC, news.date_created DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function isNewsExist( $id ){
        $this->db->from('news');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}