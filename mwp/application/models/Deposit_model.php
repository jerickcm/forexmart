<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deposit_model extends CI_Model
{
    private $table = 'deposit';

    function __construct()
    {
        parent::__construct();
    }

    public function insertPayment( $data = array() ){
        if($this->db->insert($this->table, $data)){
            return true;
        }else{
            return false;
        }
    }

    public function getDepositCount( $token = '' ){
        $this->db->select('deposit.*, mt_accounts_set.account_number, user_profiles.full_name');
        $this->db->from($this->table);
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id');
        if( $token != '' ) {
            $search = "(mt_accounts_set.account_number LIKE '%$token%'
        OR DATE_FORMAT(deposit.payment_date, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
        OR UCASE(user_profiles.full_name) LIKE '%$token%'
        OR UCASE(deposit.transaction_type) LIKE '%$token%'
        )";
            $this->db->where($search, null, false);
        }
        $this->db->where('users.test', 0);
        $this->db->where('deposit.status', 2);
//        $this->db->where('deposit.admin_manualDeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->order_by('deposit.id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getDepositByTypeCount( $token = '', $transaction_type = '', $status = array(2) ){
        $this->db->select('deposit.*, mt_accounts_set.account_number, user_profiles.full_name');
        $this->db->from($this->table);
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id');
        if( $token != '' ) {
            $search = "(mt_accounts_set.account_number LIKE '%$token%'
        OR DATE_FORMAT(deposit.payment_date, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
        OR UCASE(user_profiles.full_name) LIKE '%$token%'
        OR UCASE(deposit.transaction_type) LIKE '%$token%'
        )";
            $this->db->where($search, null, false);
        }

        $this->db->where('UCASE(deposit.transaction_type)', strtoupper($transaction_type));
        $this->db->where_in('deposit.status', $status);
        $this->db->where('deposit.admin_manualDeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->order_by('deposit.id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getLimitDepositCount( $limit, $offset, $token = '', $order = 'transaction_date', $sort = 'asc' ){
        $this->db->select('deposit.*, mt_accounts_set.account_number, user_profiles.full_name');
        $this->db->from($this->table);
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id');
        if( $token != '' ) {
            $search = "(mt_accounts_set.account_number LIKE '%$token%'
        OR DATE_FORMAT(deposit.payment_date, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
        OR UCASE(user_profiles.full_name) LIKE '%$token%'
        OR UCASE(deposit.transaction_type) LIKE '%$token%'
        )";
            $this->db->where($search, null, false);
        }
        $this->db->where('users.test', 0);
        $this->db->where('deposit.status', 2);
//        $this->db->where('deposit.admin_manualDeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->limit($limit, $offset);
        switch($order){
            case 'account_number':
                $order_by = 'mt_accounts_set.account_number';
                break;
            case 'full_name':
                $order_by = 'user_profiles.full_name';
                break;
            case 'amount':
                $order_by = "deposit.amount";
                break;
            case 'method':
                $order_by = 'UCASE(deposit.transaction_type)';
                break;
            default:
                $order_by = 'deposit.payment_date';
        }

        $this->db->order_by($order_by, $sort);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getLimitDepositByTypeCount( $limit, $offset, $token = '', $transaction_type = '', $status = array(2), $order = 'transaction_date', $sort = 'asc' ){
        $this->db->select('deposit.*, mt_accounts_set.account_number, user_profiles.full_name');
        $this->db->from($this->table);
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id');
        if( $token != '' ) {
            $search = "(mt_accounts_set.account_number LIKE '%$token%'
        OR DATE_FORMAT(deposit.payment_date, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
        OR UCASE(user_profiles.full_name) LIKE '%$token%'
        OR UCASE(deposit.transaction_type) LIKE '%$token%'
        )";
            $this->db->where($search, null, false);
        }

        $this->db->where('UCASE(deposit.transaction_type)', strtoupper($transaction_type));
        $this->db->where_in('deposit.status', $status);
        $this->db->where('deposit.admin_manualDeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->limit($limit, $offset);
        switch($order){
            case 'account_number':
                $order_by = 'mt_accounts_set.account_number';
                break;
            case 'full_name':
                $order_by = 'user_profiles.full_name';
                break;
            case 'amount':
                $order_by = "deposit.amount";
                break;
            case 'method':
                $order_by = 'UCASE(deposit.transaction_type)';
                break;
            default:
                $order_by = 'deposit.payment_date';
        }

        $this->db->order_by($order_by, $sort);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getDepositByID( $id ){
        $this->db->from('deposit');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function getDepositByTranIDAndRef( $transaction_id, $reference_id ){
        $this->db->select('cpa, user_id, currency, sum(amount) as amount');
        $this->db->from('deposit');
        $this->db->where('transaction_id', $transaction_id);
        $this->db->where('reference_id', $reference_id);
        $this->db->group_by('cpa, user_id, currency');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function updateDepositByTranIDAndRef( $transaction_id, $reference_id, $data ){
        $this->db->where('transaction_id',$transaction_id);
        $this->db->where('reference_id',$reference_id);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
    }

    public function updateDepositStatusById( $id, $data ){
        $this->db->where('id',$id);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
    }

    public function updateConvertedAmountById( $id, $amount ){
        $data = array(
            'conv_amount' => $amount
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function hasNoDepositRequest( $user_id ){
        $this->db->from('no_deposit');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_approved', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function setNoDepositRequestStatus( $user_id, $status ){
        $data = array(
            'is_approved' => $status
        );
        $this->db->where('user_id', $user_id);
        if($this->db->update('no_deposit', $data)){
            return true;
        }else{
            false;
        }
    }
}