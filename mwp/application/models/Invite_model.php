<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invite_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function checkPerDayOneInvite($email){

        $this->db->select('id');
        $this->db->from('invite_friends');
        $this->db->where("date(`date`) = current_date()");
        $this->db->where("email",$email);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }
        return false;

    }

    function getInvitePerMonth($user_id){

        $sql = 'SELECT count(*)as number, month(`date`) as `month` from   invite_friends where user_id = ? group by month(`date`)';
        $query =  $this->db->query($sql,array($user_id));

        return  $query->num_rows() > 0 ? $query->result() : false;
    }
    function getReferralPerMonth($user_id){

        $sql = 'SELECT count(*)as number, month(register_date) as `month` from   invite_friends where user_id = ? and `status`= 2 group by month(register_date)';
        $query =  $this->db->query($sql,array($user_id));

        return  $query->num_rows() > 0 ? $query->result() : false;
    }
    function getUserAffiliateCode($user_id){
        $this->db->select('affiliate_code');
        $this->db->from('users_affiliate_code');
        $this->db->where('users_id', $user_id);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->affiliate_code;

    }
    function getInvitedAffiliateCode($email_user){
        $this->db->select('user_affiliate_code');
        $this->db->from('invite_friends');
        $this->db->where('email', $email_user);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->user_affiliate_code;

    }
    function updateInviteDetails($table, $inv_ref, $tbl_code,$email_user,$tbl_email,$invite_data){
        $this->db->where($tbl_email, $email_user);
        $this->db->where($tbl_code, $inv_ref);
        $this->db->update($table, $invite_data);
    }

    function getInvitedRefCode($email_user,$user_id=null){
        $this->db->select('ref_number');
        $this->db->from('invite_friends');
        $this->db->where('email', $email_user);
       // $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->ref_number;

    }

} 