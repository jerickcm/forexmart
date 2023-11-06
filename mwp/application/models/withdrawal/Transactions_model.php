<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transactions_model extends CI_Model
{
    private $transaction_type = array(
        'BT' => 'bank_transfer',
        'CC' => 'credit_card',
        'SK' => 'skrill',
        'UP' => 'unionpay',
        'NT' => 'neteller',
        'WM' => 'webmoney',
        'PX' => 'paxum',
        'UK' => 'ukash',
        'PC' => 'payco',
        'FP' => 'filspay',
        'CU' => 'cashu'
    );

    function __construct()
    {
        parent::__construct();
    }

    public function getWithdrawalDetails($id, $trantype = ''){
        $table_name = $this->transaction_type[$trantype];
        $this->db->from('withdraw');
        $this->db->join($table_name, $table_name . '.id = withdraw.transaction_id', 'inner');


        $this->db->where('withdraw.id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function getWithdrawTransactionAll($offset, $limit, $status){
        $processedCondi = 1;
        $declinedCondi = 2;
        $requestCondi  = 0;

        $conditionArr = array();
        switch($status){
            case 'Processed':
                $conditionArr['Processed'] = $processedCondi;
                break;
            case 'Declined':
                $conditionArr['Declined'] = $declinedCondi;
                break;
            case 'Request':
                $conditionArr['Request'] = $requestCondi;
                break;
            default:
                $conditionArr['Processed'] = $processedCondi;
                $conditionArr['Declined'] = $declinedCondi;
                $conditionArr['Request'] = $requestCondi;
        }

        foreach($conditionArr as $type => $conditionStr){
            $this->db->start_cache();
            $this->db->select('*,withdraw.id');
            $this->db->from('withdraw');
            $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
            $this->db->where('status', $conditionStr);
            $this->db->order_by('date_withdraw', 'DESC');
            $query = $this->db->get();
            $queryResult[$type] = $query->result_array();
            $this->db->flush_cache();
        }

        return $queryResult;
    }
    public function getWithdrawTransaction($offset, $limit, $status,  $trantype = ''){
        $table_name = $this->transaction_type[$trantype];

//        $processedCondi = " WHERE Status = '0'";
//        $declinedCondi = " WHERE Status = '2'";
//        $requestCondi  = " WHERE Status = '1'";
        $processedCondi = 1;
        $declinedCondi = 2;
        $requestCondi  = 0;

        $conditionArr = array();
        switch($status){
            case 'Processed':
                $conditionArr['Processed'] = $processedCondi;
                break;
            case 'Declined':
                $conditionArr['Declined'] = $declinedCondi;
                break;
            case 'Request':
                $conditionArr['Request'] = $requestCondi;
                break;
            default:
                $conditionArr['Processed'] = $processedCondi;
                $conditionArr['Declined'] = $declinedCondi;
                $conditionArr['Request'] = $requestCondi;
        }

        foreach($conditionArr as $type => $conditionStr){
            $this->db->start_cache();
            $this->db->select('withdraw.*, user_profiles.*,'.$table_name.'.*,withdraw.id');
            $this->db->from($table_name);
            $this->db->join('withdraw', $table_name.'.id = withdraw.transaction_id', 'inner');
            $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left');
            $this->db->where('status', $conditionStr);
            $this->db->where('transaction_type', $trantype);
            $this->db->order_by('date_withdraw', 'DESC');
            $query = $this->db->get();
            $queryResult[$type] = $query->result_array();
            $this->db->flush_cache();
        }



        return $queryResult;
    }

    public function processTransactionRequest($transId, $data){
        $this->db->where('id',$transId);
        $this->db->update('withdraw',$data);
    }

    public function GetAllWithdrawalTransaction($statusId,$offset, $limit){

        $this->db->select('*, withdraw.Id as wId')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner')
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function CountAllWithdrawalTransaction($statusId){
        $this->db->select('count(*) as Count')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner')
            ->where_in('withdraw.status',$statusId);
        $result = $this->db->get();

        return $result->row_array();
    }

    public function getWithdrawalTransactionBankTransfer($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, bank_transfer.beneficiary_bank, bank_transfer.beneficiary_account')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('bank_transfer', 'bank_transfer.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function CountWithdrawalTransaction($statusId, $transactionType){
        $this->db->select('count(*) as Count')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status',$statusId);
        $result = $this->db->get();

        return $result->row_array();
    }

    public function getWithdrawalTransactionDebitCreditCard($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('credit_card', 'credit_card.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionSkrill($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, skrill.skrill_account')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('skrill', 'skrill.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionNeteller($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, neteller.neteller_id')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('neteller', 'neteller.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionWebmoney($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, webmoney.webmoney_purse')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('webmoney', 'webmoney.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionPaxum($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, paxum.paxum_id')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('paxum', 'paxum.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionUkash($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, ukash.ukash_account')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('ukash', 'ukash.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionPayco($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name , payco.wallet')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('payco', 'payco.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionFilspay($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, filspay.filspay_number')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('filspay', 'filspay.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionCashu($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, cashu.cashu_account')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('cashu', 'cashu.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalTransactionChinaUnionPay($statusId,$offset, $limit, $transactionType){
        $this->db->select('withdraw.*, user_profiles.full_name, unionpay.bank_account,unionpay.bank_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('unionpay', 'unionpay.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function getWithdrawalRequestClient($transId){
        $this->db->select('withdraw.*, user_profiles.full_name, users.email')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('users', 'users.id = withdraw.user_id', 'left')
            ->where('withdraw.id', $transId);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function getWithdrawalTransactionYandex($statusId,$offset, $limit, $transactionType){

//        $this->db->select('withdraw.*, user_profiles.full_name, skrill.skrill_account')
        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('yandex_money', 'yandex_money.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }

    public function getWithdrawalTransactionSofort($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('sofort', 'sofort.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }

    public function getWithdrawalTransactionMoneta($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('moneta', 'moneta.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }

    public function getWithdrawalTransactionQiwi($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('qiwi', 'qiwi.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }

    public function getWithdrawalTransactionBitcoin($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('bitcoin', 'bitcoin.Id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }
    public function getWithdrawalTransactionMegatransfer($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('megatransfer', 'megatransfer.Id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }
    public function getWithdrawalTransactionMegatransferCard($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('megatransfer_card', 'megatransfer_card.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }
    public function getWithdrawalTransactionPaypal($statusId,$offset, $limit, $transactionType){

        $this->db->select('withdraw.*, user_profiles.full_name,paypal.paypal_account')
            ->from('withdraw')
            ->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'left')
            ->join('paypal', 'paypal.id = withdraw.transaction_id', 'left')
            ->where('withdraw.transaction_type', $transactionType)
            ->where_in('withdraw.status', $statusId)
            ->order_by('withdraw.date_withdraw', 'DESC')
            ->limit($limit,$offset);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;

    }
}