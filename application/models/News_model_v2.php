<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model_v2 extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllNewsCount($lang='en')
    {
        $this->db->from('news_v2');
        $this->db->where('enabled', 1);
        $this->db->where('language', $lang);
        return $this->db->count_all_results();
    }
    function getAllNewsCount2($language)
    {
        $this->db->from('news_v2');
        $this->db->where('language',$language);
        return $this->db->count_all_results();
    }

    function getLimitNews( $limit, $offset ){
        $this->db->select('news_v2.*,news_images_v2.file_name');
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->group_by('news_v2.id');
        $this->db->limit($limit, $offset);
        $this->db->order_by('news_v2.id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getNewsById( $id ){
        $this->db->select('news_v2.*,news_images_v2.file_name');
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->where('news_v2.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updateNewsById( $id, $data ){
        $this->db->where('id', $id);
        if($this->db->update('news_v2', $data)){
            return true;
        }else{
            return false;
        }
    }



    function getNewsHeadline($lang){
        $this->db->select('news_v2.*,news_images_v2.file_name');
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->where('news_v2.enabled', 1);
        $this->db->where('featured', 1);
        $this->db->where('news_v2.language', $lang);
        $this->db->group_by('news_v2.id');
        $this->db->order_by('date_published DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getNewsHeadline2($lang='en'){
        $this->db->select('news_v2.*');
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->where('enabled', 1);
        $this->db->where('featured', 1);
        $this->db->where('news_v2.language', $lang);
        $this->db->group_by('news_v2.id');
        $this->db->order_by('date_published', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getLatestNewsByLimit($limit, $offset, $lang){
        $this->db->select('news_v2.*,news_images_v2.file_name');
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->where('news_v2.enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->where('news_v2.language', $lang);
        $this->db->group_by('news_v2.id');
        $this->db->order_by('date_published DESC');
        $data = $this->db->get();
        return $data->result_array();
    }


    function getNewsById_v3($id){
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->where('news_v2.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getMostReadNewsByLimit($limit, $offset, $lang){
        $this->db->from('news_v2');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->where('language', $lang);
        $this->db->order_by('news_v2.read DESC, news_v2.date_published DESC');
        $data = $this->db->get();
        return $data->result_array();

    }

    function getArchiveNewsByLimit($limit, $offset, $news_id, $lang){
        $this->db->select('news_v2.*,news_images_v2.file_name');
        $this->db->from('news_v2');
        $this->db->join('news_images_v2', 'news_v2.id = news_images_v2.news_id', 'left');
        $this->db->where('enabled', 1);
        $this->db->where('language', $lang);
        $this->db->where('news_v2.id !=', $news_id);
        $this->db->group_by('news_v2.id');
        $this->db->limit($limit, $offset);
        $this->db->order_by('date_published DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function isNewsExist( $id ){
        $this->db->from('news_v2');
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
        $this->db->from('news_v2');
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
        $this->db->from('news_images_v2');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getMaxCounts($lang='en'){
        $this->db->select('MAX(LENGTH(headline)) AS HeadlineCount');
        $this->db->from('news_v2');
        $this->db->where('enabled', 1);
        //$this->db->where('featured', 1);
        $this->db->where('language', $lang);
        $query = $this->db->get();
        return $query->result_array();
    }



}