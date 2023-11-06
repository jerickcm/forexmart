<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Finance_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getAccountsByAccountNumber($account_number)
    {
        $this->db->select('mt_accounts_set.*, users.type');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            return false;
        }
    }

    function showssingle($table, $field = "", $id = "", $select = "", $order_by = "")
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            return false;
        }
    }

    function showt2w1j1($table1, $table2, $field = "", $id = "", $select = "", $join12, $order, $group = "")
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $join12);
        $this->db->where($field, $id);
        $this->db->order_by($order, 'desc');
        $this->db->group_by($group);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

    function showssingle2($table, $field = "", $id = "", $select = "", $order_by = "")
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            return false;
        }
    }

    function showssingle2_tm($table, $field = "", $id = "", $field2 = "", $id2 = "", $select = "", $order_by = "")
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        if ($order_by != "") {
            $this->db->order_by($order_by, 'desc');
        }
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

    function selectOptionList($data, $selected_val = null)
    {
        $selectOption = "";
        if (is_array($data)) {

            foreach ($data as $key => $d) {
                $selected = $selected_val == $key ? "selected" : "";
                $selectOption = $selectOption . "<option " . $selected . " value='" . $key . "'>" . $d . "</option>";
            }
        }

        return $selectOption;
    }

    public function updateAccountBalance($account_number, $amount)
    {
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

    function getDepositTransactionType($payment_option = "")
    {
        $DepositTransactionType = array(
            //existing in deposit table
            'CP_' => 'CARDPAY',
            'NT_' => 'Neteller',
            'PS_' => 'WEBMONEY',
            'SK_' => 'SKRILL',
            'PP_' => 'PAYPAL',
            'PC_' => 'PAYCO',


            'PX_' => 'PAXUM',

            'qw_'     => 'qiwi',
            'YAN_'    => 'yandexMoney',
            'MT_'     => 'MEGATRANSFER',
            'BITCOIN' => 'BITCOIN',

            //missing codes
            'FP_'     => 'FILSPAY',
            'CU_'     => 'CASHU',
            'UK_'     => 'UKASH',
            'HP_'     => 'HIPAY',
            'CUP_'    => 'UNIONPAY',
            'BT_'     => 'BANK TRANSFER',
            'SF_'     => 'SOFORT',
            'MN'      => 'MONETA',
        );
        if ($payment_option) {
            return isset($DepositTransactionType[$payment_option]) ? $DepositTransactionType[$payment_option] : false;
        } else {
            return $DepositTransactionType;
        }
    }

    public function getAccountStatus($user_id)
    {
        $this->db->select('accountstatus');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $getStatus = $query->row();
//            $getStatus->accountstatus;
            if ($getStatus->accountstatus == 1) {
                $this->db->select('*');
                $this->db->from('mt_accounts_set');
                $this->db->join('trading_experience', 'trading_experience.user_id = mt_accounts_set.user_id', 'left');
                $this->db->join('employment_details', 'employment_details.user_id = mt_accounts_set.user_id', 'left');
                $this->db->where('mt_accounts_set.user_id', $user_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->row();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAccountDetailsByAcctNumber($acctno, $type)
    {
        if ($type == 'client') {
            $q = $this->db->select('*')
                ->from('mt_accounts_set a')
                ->join('users b', 'a.user_id = b.id','inner')
                ->join('user_profiles c', 'b.id = c.user_id', 'left')
                ->join('users_affiliate_code d', 'c.user_id = d.users_id', 'left')
                ->where('a.account_number', $acctno)
                ->where('a.account_number !=',NULL)
                ->where('a.account_number !=',0);
            $ret['rows'] = $q->get()->result();
        } else if ($type == 'partner') {
            $q = $this->db->select('*')
                ->from('partnership a')
                ->join('users b', 'a.partner_id = b.id', 'inner')
                ->join('user_profiles c', 'b.id = c.user_id', 'left')
                ->join('partnership_affiliate_code d', 'a.partner_id = d.partner_id', 'inner')
                ->where('a.reference_num', $acctno)
                ->where('a.reference_num !=',NULL)
                ->where('a.reference_num !=',0);
            $ret['rows'] = $q->get()->result();
        }

        return $ret;
    }

    public function getAffiliates($table, $type, $id)
    {
        if ($type == 'client') {
            $q = $this->db->select('a.affiliate_code, a.referral_affiliate_code , c.account_number, b.id, d.full_name,b.login_type ')
                ->from('users_affiliate_code a')
                ->join('users b ', 'a.users_id = b.id', 'inner')
                ->join('mt_accounts_set c', 'b.id = c.user_id', 'inner')
                ->join('user_profiles d', 'b.id = d.user_id', 'left')
                ->where('a.referral_affiliate_code', $id);
            $ret['rows'] = $q->get()->result();
        }

        return $ret;
    }

    public function getAffiliates1($id)
    {
        $q = $this->db->select('a.users_id , a.referral_affiliate_code , b.account_number , c.full_name, a.affiliate_code')
            ->from('users_affiliate_code a')
            ->join('mt_accounts_set b ', 'a.users_id = b.user_id', 'left')
             ->join('user_profiles c ','a.users_id = c.user_id','left')
            ->where('a.referral_affiliate_code', $id)
            ->where('a.referral_affiliate_code!=""');
        $ret['rows'] = $q->get()->result();
        return $ret;
    }
    function getReferrals($code){
        $q = $this->db->select('a.users_id , a.referral_affiliate_code , b.account_number , c.full_name, a.affiliate_code')
            ->from('users_affiliate_code a')
            ->join('mt_accounts_set b ', 'a.users_id = b.user_id', 'left')
            ->join('user_profiles c ','a.users_id = c.user_id','left')
            ->where('a.referral_affiliate_code', $code)
            ->where('a.referral_affiliate_code!=""');
        $ret['rows'] = $q->get()->result();
        return $ret;
    }

}