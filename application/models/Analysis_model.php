<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Analysis_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllAnalysisCount()
    {
        $this->db->from('analysis');
        return $this->db->count_all_results();
    }

    function getLimitAnalysis( $limit, $offset ){
        $this->db->from('analysis');
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAnalysisById( $id ){
        $this->db->from('analysis');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function updateAnalysisById( $id, $data ){
        $this->db->where('id', $id);
        if($this->db->update('analysis', $data)){
            return true;
        }else{
            return false;
        }
    }

    function getAnalysisHeadline(){
        $this->db->from('analysis');
        $this->db->where('enabled', 1);
        $this->db->where('featured', 1);
        $this->db->order_by('date_created', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getLatestAnalysisByLimit($limit, $offset, $lang){
        $this->db->from('analysis');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->where('language', $lang);
        $this->db->order_by('date_created DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getMostReadAnalysisByLimit($limit, $offset){
        $this->db->from('analysis');
        $this->db->where('enabled', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('analysis.read DESC, analysis.date_created DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getArchiveAnalysisByLimit($limit, $offset, $analysis_id, $lang){
        $this->db->from('analysis');
        $this->db->where('enabled', 1);
        $this->db->where('language', $lang);
        $this->db->where('id !=', $analysis_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by('date_created DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function isAnalysisExist( $id ){
        $this->db->from('analysis');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function getAnalysisImagesByAnalysisId( $analysis_id ){
        $this->db->from('analysis_images');
        $this->db->where('analysis_id', $analysis_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}