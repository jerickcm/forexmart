<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all_events($limit, $offset,$lang)
    {
        $q  =   $this->db
            ->select('*')
            ->from('offline_exhibitions')
            ->where('enabled !=', 0)
            ->where('featured !=', 1)
            ->where('language', $lang)
            ->order_by('offevents_ID', 'DESC')
            ->limit($limit,$offset);
        $ret['rows']    =   $q->get()->result();

        $q      =   $this->db
            ->select('COUNT(*) as count', FALSE)
            ->from('offline_exhibitions')
            ->where('enabled !=', 0)
            ->where('language', $lang)
            ->where('featured !=', 1);
        $tmp    =   $q->get()->result();
        $ret['num_rows']    =   $tmp[0]->count;
        return $ret;
    }

    function get_featured($lang)
    {        $q  =   $this->db
        ->select('*')
        ->from('offline_exhibitions')
        ->where('enabled =', 1)
        ->where('featured =', 1)
        ->where('language',$lang)
        ->order_by('offevents_ID', 'DESC');

        $ret['rows']    =   $q->get()->result();
        return $ret;
    }

    function totalevents(){
        return $this->db->count_all_results('offline_exhibitions');
    }

    function get_post($table, $field , $postid){
        $q = $this->db
            ->select('*')
            ->from($table)
            ->where($field, $postid);
        $ret['record']    =   $q->get()->result();
        return $ret;
    }
    function get_post1($postid){
        $q = $this->db
            ->select('*')
            ->from('offline_events')
            ->where('offevents_ID', $postid);
        $ret['record']    =   $q->get()->result();
        return $ret;
    }

    function get_fxevents()
    {
        $q  =   $this->db->select('*')
            ->from('offline_events')
            ->where('enabled !=', 0)
            ->order_by('offevents_ID','DESC');
        $ret['rows1']    =   $q->get()->result();
        return $ret;
    }
    function get($a , $b, $c, $d){
        $q = $this->db
            ->select($a)
            ->from($b)
            ->where($c, $d);
        $ret['rec_img']    =   $q->get()->result();
        return $ret;
    }
    function getnext($limit, $offset, $table){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->where('featured!=', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('date DESC');
        $data = $this->db->get();
        return $data->result_array();
    }
    function getAll()
    {
        $this->db->from('offline_exhibitions');
        return $this->db->count_all_results();
    }

    function get1($a , $b, $c, $d,$e,$f){
        $q = $this->db
            ->select($a)
            ->from($b)
            ->where($c, $d)
            ->where('enabled !=',0)
            ->where('language',$f)
            ->order_by($e,'DESC');
        $ret['rec_img']    =   $q->get()->result();
        return $ret;
    }
}

?>