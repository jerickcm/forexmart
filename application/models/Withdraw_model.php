<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Withdraw_model extends CI_Model
{
    private $table = 'withdraw';

    function __construct()
    {
        parent::__construct();
    }

    public function getWithdrawById( $id ){
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : false;
    }

    public function getAllUnconvertedAmountWithdraw(){
        $this->db->select('id, amount, currency');
        $this->db->from('withdraw');
        $this->db->where('withdraw.conv_amount', 0);
        $this->db->where('withdraw.currency <>', 'USD');
        $this->db->order_by('withdraw.date_withdraw', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateConvertedAmountById( $id, $amount ){
        $data = array(
            'conv_amount' => $amount
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function getWithdrawalsByDate( $date_from, $date_to ){
        $this->db->select("DATE_FORMAT(withdraw.date_withdraw, '%m/%d/%Y') payment_date, SUM(withdraw.conv_amount) amount", false);
        $this->db->from('withdraw');
        $this->db->join('users', 'users.id = withdraw.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = withdraw.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
        $this->db->where('withdraw.status',1);
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('withdraw.date_withdraw >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('withdraw.date_withdraw <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->order_by('withdraw.date_withdraw');
        $this->db->group_by("DATE_FORMAT(withdraw.date_withdraw, '%m/%d/%Y')", false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getTopWithdrawals( $limit = 0 ){
        $this->db->select('withdraw.conv_amount, withdraw.id, withdraw.transaction_type, withdraw.account_number, withdraw.date_withdraw, user_profiles.country, user_profiles.full_name');
        $this->db->from('withdraw');
        $this->db->join('users', 'users.id = withdraw.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('withdraw.status',1);
        $this->db->where('CHAR_LENGTH(withdraw.account_number) > 4', null, false);
        $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
        $this->db->order_by('withdraw.conv_amount', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTopWithdrawalsByDate( $limit = 0, $date_from, $date_to ){
        $this->db->select('withdraw.conv_amount, withdraw.id, withdraw.transaction_type, withdraw.account_number, withdraw.date_withdraw, user_profiles.country, user_profiles.full_name');
        $this->db->from('withdraw');
        $this->db->join('users', 'users.id = withdraw.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('withdraw.status',1);
        $this->db->where('withdraw.date_withdraw >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('withdraw.date_withdraw <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('CHAR_LENGTH(withdraw.account_number) > 4', null, false);
        $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
        $this->db->order_by('withdraw.conv_amount', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLatestWithdrawalsByStatus( $limit = 0, $status = 1, $date_from, $date_to ){
        if($status == 0 or $status == 2){
            $this->db->select('withdraw.amount, withdraw.conv_amount, withdraw.id, withdraw.currency, withdraw.transaction_type, withdraw.account_number, withdraw.date_withdraw, withdraw.status, user_profiles.country, user_profiles.full_name');
        }else{
            $this->db->select('withdraw.conv_amount, withdraw.id, withdraw.transaction_type, withdraw.account_number, withdraw.date_withdraw, user_profiles.country, user_profiles.full_name');
        }
        $this->db->from('withdraw');
        $this->db->join('users', 'users.id = withdraw.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
        $this->db->where('users.test', 0);
        if($status == 0){
            $this->db->where_in('withdraw.status', array(0,1,2));
        }else{
            $this->db->where('withdraw.status',$status);
        }
        $this->db->where('withdraw.date_withdraw >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('withdraw.date_withdraw <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('CHAR_LENGTH(withdraw.account_number) > 4', null, false);
        $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
        $this->db->order_by('withdraw.date_withdraw', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTotalSupporterWithdraw( $date_from, $date_to, $accounts = array() ){

        if( count($accounts) > 0 ){

            $this->db->select('SUM(withdraw.conv_amount) amount_withdraw');
            $this->db->from('withdraw');
            $this->db->join('users', 'users.id = withdraw.user_id', 'inner');
            $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
            $this->db->where('withdraw.status', 1);
            $this->db->where('users.test', 0);
            $this->db->where_in('withdraw.account_number', $accounts);
            $this->db->where("(withdraw.date_withdraw >= '" . date('Y-m-d 00:00:00', strtotime($date_from)) . "' AND withdraw.date_withdraw <= '" . date('Y-m-d 23:59:59', strtotime($date_to)) . "')", null, false);
            $this->db->where('CHAR_LENGTH(withdraw.account_number) > 4', null, false);
            $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $result = $query->row_array();
                return $result['amount_withdraw'];
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function getWithdrawsByDate( $date_from, $date_to ){
        $this->db->select("DATE_FORMAT(withdraw.date_withdraw, '%H:%i:%s') withdraw_time, withdraw.conv_amount as amount, user_profiles.full_name, mt_accounts_set.account_number, partnership.reference_num, user_profiles.country, withdraw.transaction_type, withdraw.comment", false);
        $this->db->from('withdraw');
        $this->db->join('users', 'users.id = withdraw.user_id', 'left');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = withdraw.user_id', 'left');
        $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left');
        $this->db->join('partnership', 'partnership.partner_id = withdraw.user_id', 'left');
        $this->db->where('withdraw.status', 1);
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('withdraw.date_withdraw >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('withdraw.date_withdraw <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
        $this->db->order_by('withdraw.date_withdraw');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getWithdrawSumByDate( $date_from, $date_to, $exclude_withdraw_accounts = array() ){
        $this->db->select('withdraw.amount, withdraw.conv_amount, withdraw.id, withdraw.currency, withdraw.transaction_type, withdraw.account_number, withdraw.date_withdraw, withdraw.status, user_profiles.country, user_profiles.full_name');
        $this->db->from('withdraw');
        $this->db->join('users', 'users.id = withdraw.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
        if(count($exclude_withdraw_accounts) > 0){
            $this->db->where_not_in('withdraw.account_number', $exclude_withdraw_accounts);
        }
        $this->db->where('users.test', 0);
        $this->db->where_in('withdraw.status', array(0,1,2));
        $this->db->where('withdraw.date_withdraw >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('withdraw.date_withdraw <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('CHAR_LENGTH(withdraw.account_number) > 4', null, false);
        $this->db->where('withdraw.admin_manualwithdraw_users_id IS NULL', null, false);
        $this->db->order_by('withdraw.date_withdraw', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}