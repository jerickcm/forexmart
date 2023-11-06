<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminmailer_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->mailer_db = $this->load->database('mailer', true);
    }

// vic
    public function getOptionMailer3($table,$flag){
        $this->mailer_db->select('*');
        $this->mailer_db->from($table);
        $this->mailer_db->where('Flag', $flag);
        $this->mailer_db->order_by('Id','desc');
        $query = $this->mailer_db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


//to be edit
    public function getDetailsByKey($key){
  
            $this->mailer_db->select('mailer_recipients.Id as recipient_id');
            $this->mailer_db->from('mailer_recipients');
            $this->mailer_db->where('mailer_recipients.Unsubscribe_key', $key);
            $this->mailer_db->where('mailer_recipients.Active',1);
            $result = $this->mailer_db->get();
            if($result->num_rows() > 0){
                return $result->row_array();
            }else{
                return false;
            }
        
        
    }

    function update($table,$field,$id,$data){
        $this->mailer_db->trans_start();
        $this->mailer_db->where($field, $id);
        $this->mailer_db->update($table, $data);
        $this->mailer_db->trans_complete();
    }

    function updatemy($table,$field,$id,$data){
        $this->mailer_db->where($field, $id);
        $this->mailer_db->update($table, $data);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
        

    public function getEmailById($id){
        $this->mailer_db->select('Email');
        $this->mailer_db->from('mailer_recipients');
        $this->mailer_db->where('mailer_recipients.Id', $id);
        $result = $this->mailer_db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }


    public function getAllThisEmail($Email){
        $this->mailer_db->select('*');
        $this->mailer_db->from('mailer_recipients');
        $this->mailer_db->where('mailer_recipients.Email', $Email);
        $this->mailer_db->where('mailer_recipients.Active', 1);
        $result = $this->mailer_db->get();
        if($result->num_rows() > 0){
            return $result->result_array();
            
        }
        return false;
    }


    public function checkEmailAndKey($email,$key){
        $this->mailer_db->select('*')
            ->from('mailer_recipients')
            ->where('mailer_recipients.unsubscribe_key', $key)
            ->where('mailer_recipients.Active', 1)
            ->where('mailer_recipients.Email', $email);
        $result = $this->mailer_db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }

        return false;
    }


    // end

}


