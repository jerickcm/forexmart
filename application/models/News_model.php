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
        return $this->db->count_all_results();
    }
    function getAllNewsCount2($language)
    {
        $this->db->from('news');
        $this->db->where('language',$language);
        return $this->db->count_all_results();
    }

    function getLimitNews( $limit, $offset ){
        $this->db->from('news');
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getNewsById( $id ){
        $this->db->from('news');
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
        $this->db->order_by('date_published', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getLatestNewsByLimit($limit, $offset, $lang){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->where('language', $lang);
        $this->db->order_by('date_published DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getMostReadNewsByLimit($limit, $offset, $lang){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->where('language', $lang);
        $this->db->order_by('news.read DESC, news.date_published DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getArchiveNewsByLimit($limit, $offset, $news_id, $lang){
        $this->db->from('news');
        $this->db->where('enabled', 1);
        $this->db->where('language', $lang);
        $this->db->where('id !=', $news_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by('date_published DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function isNewsExist( $id ){
        $this->db->from('news');
        $this->db->where('id', $id);
        $this->db->where('enabled', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function isDisabledNewsExist( $id ){
        $this->db->from('news');
        $this->db->where('id', $id);
        $this->db->where('enabled', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function getNewsImagesByNewsId( $news_id ){
        $this->db->from('news_images');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getNewsHeadline2($lang='en'){
        $this->db->select('news.*');
        $this->db->from('news');
        $this->db->join('news_images', 'news.id = news_images.news_id', 'left');
        $this->db->where('enabled', 1);
        $this->db->where('featured', 1);
        $this->db->where('language', $lang);
        $this->db->group_by('news.id');
        $this->db->order_by('date_published', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}