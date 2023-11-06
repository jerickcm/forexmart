<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all_reviews($limit, $offset){
        $q  =   $this->db
            ->select('*')
            ->from('users a')
            ->join('user_profiles b', 'a.id = b.user_id','inner')
            ->join('review_publishes c', 'b.user_id = c.pub_created', 'inner')
            ->where('c.enabled !=', 0)
            ->order_by('c.id', 'DESC')
            ->limit($limit,$offset);
        $ret['rows']    =   $q->get()->result();

        $q      =   $this->db
            ->select('COUNT(*) as count', FALSE)
            ->from('review_publishes a')
            ->join('users b', 'a.pub_created = b.id')
            ->where('a.enabled !=', 0);
        $tmp    =   $q->get()->result();
        $ret['num_rows']    =   $tmp[0]->count;
        return $ret;
    }
    
    function get_yesterday_reviewsWLan($limit, $offset,$lang="en",$date){
        $q  =   $this->db
            ->select('*')
            ->from('users a')
            ->join('user_profiles b', 'a.id = b.user_id','inner')
            ->join('review_publishes c', 'b.user_id = c.pub_created', 'inner')
            ->where("DATE_FORMAT(c.date_created, '%Y-%M-%d') = '$date' ")
            ->where('c.language', strtoupper($lang))
            ->where('c.enabled !=', 0)             
            ->order_by('c.id', 'DESC')
            ->limit($limit,$offset);
        $ret['rows']    =   $q->get()->result();

        $q  = $this->db
            ->select('COUNT(*) as count', FALSE)
            ->from('review_publishes a')
            ->join('users b', 'a.pub_created = b.id')
            ->where("DATE_FORMAT(a.date_created, '%Y-%M-%d') = '$date' ")
            ->where('a.language', strtoupper($lang))
            ->where('a.enabled !=', 0);
        $tmp  =  $q->get()->result();
        $ret['num_rows']    =   $tmp[0]->count;
        return $ret;
    }

     function get_past_reviews($limit, $offset,$lang="en",$date){
         $q  =   $this->db
             ->select('*')
             ->from('users a')
             ->join('user_profiles b', 'a.id = b.user_id','inner')
             ->join('review_publishes c', 'b.user_id = c.pub_created', 'inner')
             ->where("DATE_FORMAT(c.date_created, '%Y-%M-%d') <> '$date' ")
             ->where('c.language', strtoupper($lang))
             ->where('c.enabled !=', 0)
             ->order_by('c.id', 'DESC')
             ->limit($limit,$offset);
         $ret['rows']    =   $q->get()->result();

         $q1  =   $this->db
             ->select('COUNT(*) as count')
             ->from('users a')
             ->join('user_profiles b', 'a.id = b.user_id','inner')
             ->join('review_publishes c', 'b.user_id = c.pub_created', 'inner')
             ->where("DATE_FORMAT(c.date_created, '%Y-%M-%d') <> '$date' ")
             ->where('c.language', strtoupper($lang))
             ->where('c.enabled !=', 0)
             ->order_by('c.id', 'DESC');

         $ret['num_rows']    =   $q->get()->result();
         return $ret;
     }

    function get_all_reviewsWLan($limit, $offset,$lang="en"){
        $q  =   $this->db
            ->select('*')
            ->from('users a')
            ->join('user_profiles b', 'a.id = b.user_id','inner')
            ->join('review_publishes c', 'b.user_id = c.pub_created', 'inner')
           ->where('c.language', strtoupper($lang))
            ->where('c.enabled !=', 0)             
            ->order_by('c.id', 'DESC')
            ->limit($limit,$offset);
        $ret['rows']    =   $q->get()->result();

        $q      =   $this->db
            ->select('COUNT(*) as count', FALSE)
            ->from('review_publishes a')
            ->join('users b', 'a.pub_created = b.id')
            ->where('a.language', strtoupper($lang))
             ->where('a.enabled !=', 0);
        $tmp    =   $q->get()->result();
        $ret['num_rows']    =   $tmp[0]->count;
        return $ret;
    }
    
    function getById( $table, $field, $id){
        $this->db->from($table);
        $this->db->where($field, $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_post($id){
        $q  =   $this->db
            ->select('*')
            ->from('users a')
            ->join('user_profiles b', 'a.id = b.user_id','inner')
            ->join('review_publishes c', 'b.user_id = c.pub_created', 'inner')
            ->where('c.enabled !=', 0)
            ->where('c.id',$id)
            ->order_by('c.id', 'DESC')
            ->limit($limit,$offset);
        $ret['rows']    =   $q->get()->result();

        $q      =   $this->db
            ->select('COUNT(*) as count', FALSE)
            ->from('review_publishes a')
            ->join('users b', 'a.pub_created = b.id')
            ->where('a.enabled !=', 0);
        $tmp    =   $q->get()->result();
        $ret['num_rows']    =   $tmp[0]->count;
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
    function fetchinfo($limit, $offset,$lang)
    {
        $q  =   $this->db
            ->select('a.*,b.full_name')
            ->from('tbl_economicnews a')
            ->join('user_profiles b','a.user_id=b.user_id','left')
            ->where('a.enabled !=', 0)
            ->where('a.language', $lang)
            ->order_by('a.id', 'DESC')
            ->limit($limit,$offset);
        $ret['rows']    =   $q->get()->result();

        $q1      =   $this->db
            ->select('COUNT(*) as count')
            ->from('tbl_economicnews')
            ->where('enabled !=', 0)
            ->where('language', $lang)
            ->order_by('id', 'DESC');
        $tmp    =   $q1->get()->result();
        $ret['num_rows']    =   $tmp[0]->count;
        return $ret;
    }
    function get_news($a , $b, $c, $d, $e, $f){
        $q = $this->db
            ->select($a)
            ->from($b)
            ->where($c, $d)
            ->order_by($e, $f);
        $ret['rows']    =   $q->get()->result();
        return $ret;
    }
    function weeklynews($a,$b,$lang){
        $q = $this->db
            ->select('a.*,b.full_name')
            ->from('tbl_economicnews a')
            ->join('user_profiles b','a.user_id=b.user_id','left')
            ->where('a.enabled',1)
            ->where('language',$lang)
            ->where("a.date_created BETWEEN '$b' AND '$a' ", NULL, FALSE)
            ->order_by('a.date_created','DESC');
        $ret['rows']    =   $q->get()->result();
        return $ret;
    }
    
    function count($lang){
        $q      =   $this->db
            ->select('COUNT(*) as count')
            ->from('tbl_economicnews')
            ->where('enabled !=', 0)
            ->where('language', $lang);
        return $q->get()->result();
    }
    
    function views_counter($id,$data){
        $this->db->where('id', $id);
        $this->db->update('review_publishes' ,$data);
    }
}
?>