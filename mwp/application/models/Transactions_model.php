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

    public function processTransactionRequest($transId, $action, $comment){
        $data = array(
            'status' => $action,
            'comment' => $comment
        );
        $this->db->where('id',$transId);
        $this->db->update('withdraw',$data);
    }
}