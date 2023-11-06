<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deposits_model extends CI_Model
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
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
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
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
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
            return false;
        }
    }

    public function getNumberOfDepositsByUser ( $user_id ) {
        $this->db->select('count(*) as counts', false)
            ->from('deposit')
            ->where('user_id', $user_id)
            ->where('status', 2)
            ->group_by('transaction_id');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->num_rows();
        }else{
            return 0;
        }
    }

    public function checkTransactionExist( $transaction_id, $payment_type ){
        $this->db->from($this->table);
        $this->db->where('transaction_id', $transaction_id);
        $this->db->where("UCASE(transaction_type) = '" . $payment_type . "'", null, false);
        $this->db->where('status', 2);
        $count = $this->db->count_all_results();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getGroupCurrency( $account_type, $currency_code, $swap_free = 0 ){

        $data= array(
            1 => array( // API group codes for ForexMart Standard
                'USD' => array(
                    0 => 'StSwUS',
                    1 => 'StSFUS'
                ),
                'EUR' => array(
                    0 => 'StSwEU',
                    1 => 'StSFEU'
                ),
                'GBP' => array(
                    0 => 'StSwGB',
                    1 => 'StSFGB'
                ),
                'RUB' => array(
                    0 => 'StSwRU',
                    1 => 'StSFRU'
                )
            ),
            2 => array( // API group codes for ForeMart Zero Spread
                'USD' => array(
                    0 => 'ZeSwUS',
                    1 => 'ZeSFUS'
                ),
                'EUR' => array(
                    0 => 'ZeSwEU',
                    1 => 'ZeSFEU'
                ),
                'GBP' => array(
                    0 => 'ZeSwGB',
                    1 => 'ZeSFGB'
                ),
                'RUB' => array(
                    0 => 'ZeSwRU',
                    1 => 'ZeSFRU'
                )
            ),
            3 => array( // API group codes for Partners/Affiliates
                'USD' => 'PaUS',
                'EUR' => 'PaEU',
                'GBP' => 'PaGB',
                'RUB' => 'PaRU'
            )
        );

        if(in_array($account_type, array(1,2))){
            return $data[$account_type][$currency_code][$swap_free];
        }elseif(in_array($account_type, array(3))){
            return $data[$account_type][$currency_code];
        }else{
            return '';
        }
    }

    function getUserProfileByUserId( $user_id ){

//        $this->db->trans_start();
        $this->db->from('user_profiles');
        $this->db->where('user_id', $user_id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
        //$this->db->trans_complete();
    }
    public function getAccountByUserId( $user_id ){
        $this->db->from('mt_accounts_set');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function updateAccountBalance( $account_number, $amount ){
        $data = array(
            'amount' => $amount
        );
        $this->db->where('account_number', $account_number);
        if ($this->db->update('mt_accounts_set', $data)) {
            return true;
        } else {
            return false;
        }
    }
}