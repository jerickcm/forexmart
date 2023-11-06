<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deposit_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getDepositTopCountries( $limit = 0, $date_from, $date_to ){
        $this->db->select('user_profiles.country, sum(deposit.conv_amount) as amount', null, false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test_1', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
//        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT');
        $this->db->group_by('user_profiles.country');
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepositTopPaymentSystems( $limit = 0, $date_from, $date_to ){
        $this->db->select('UCASE(deposit.transaction_type) as payment_type, sum(deposit.conv_amount) as amount', null, false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test_1', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
//        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT');
        $this->db->group_by('UCASE(deposit.transaction_type)');
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepositAccountsByDate( $date_from, $date_to ){
        $this->db->distinct();
        $this->db->select('mt_accounts_set.account_number, mt_accounts_set.mt_currency_base, sum(deposit.conv_amount) as conv_amount', null, false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT');
        $this->db->group_by('mt_accounts_set.account_number, mt_accounts_set.mt_currency_base');
        $this->db->order_by('deposit.payment_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepositByTicket( $mt_ticket ){
        $this->db->select('user_profiles.full_name, deposit.transaction_type');
        $this->db->from('deposit');
        $this->db->where('deposit.status = 2');
        $this->db->where('deposit.transaction_type !=', 'N/A');
        $this->db->where('deposit.transaction_type !=', 'NA');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('deposit.mt_ticket', $mt_ticket);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function getDepositByAmount( $account_number, $amount ){
        $this->db->select('user_profiles.full_name, deposit.transaction_type');
        $this->db->from('deposit');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $this->db->where('deposit.amount', $amount);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('deposit.transaction_type !=', 'N/A');
        $this->db->where('deposit.transaction_type !=', 'NA');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    public function getAllUnconvertedAmountDeposit(){
        $this->db->select('id, amount, currency');
        $this->db->from('deposit');
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.amount >', 0);
        $this->db->where('deposit.conv_amount', 0);
        $this->db->order_by('deposit.payment_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateConvertedAmountById( $id, $amount ){
        $data = array(
            'conv_amount' => $amount
        );
        $this->db->where('id', $id);
        $this->db->update('deposit', $data);
    }

    public function getDepositsByDate( $date_from, $date_to ){
        $this->db->select("DATE_FORMAT(deposit.payment_date, '%m/%d/%Y') payment_date, SUM(deposit.conv_amount) amount, deposit.currency", false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT');
        $this->db->order_by('deposit.payment_date');
        $this->db->group_by("DATE_FORMAT(deposit.payment_date, '%m/%d/%Y'), deposit.currency", false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getAllSaldoByDate( $date_from, $date_to, $exclude_withdraw_accounts = array()){

        $sql_withdraw = '';
        if(count($exclude_withdraw_accounts) > 0){
            $sql_withdraw = 'AND withdraw.account_number not in (' . implode(',', $exclude_withdraw_accounts) . ')';
        }

        $sql = "SELECT DATE_FORMAT(saldo.payment_date, '%m/%d/%Y') payment_date, sum(saldo.amount_deposit) amount_deposit, sum(saldo.amount_withdraw) amount_withdraw, sum(saldo.amount_deposit - saldo.amount_withdraw) amount, sum(saldo.deposit_count) deposit_count, sum(saldo.withdraw_count) withdraw_count FROM
                (SELECT deposit.payment_date payment_date, SUM(deposit.conv_amount) amount_deposit, 0 amount_withdraw, count(distinct deposit.transaction_id) deposit_count, 0 withdraw_count
                FROM deposit
                INNER JOIN users ON users.id = deposit.user_id
                INNER JOIN mt_accounts_set ON mt_accounts_set.user_id = deposit.user_id
                INNER JOIN user_profiles ON user_profiles.user_id = deposit.user_id
                WHERE deposit.status = 2
                AND deposit.isDeposit = 0
                AND users.test = 0
                AND mt_accounts_set.mt_type = 1
                AND (deposit.payment_date >= '" . date('Y-m-d 00:00:00', strtotime($date_from)) . "' AND deposit.payment_date <= '" . date('Y-m-d 23:59:59', strtotime($date_to)) . "')
                AND CHAR_LENGTH(mt_accounts_set.account_number) > 4
                AND deposit.admin_manualdeposit_users_id IS NULL
                AND UCASE(IFNULL(deposit.note,'')) not like '%TEST DEPOSIT%'
                GROUP BY deposit.payment_date
                UNION ALL
                SELECT withdraw.date_withdraw, 0 amount_deposit, SUM(withdraw.conv_amount) amount_withdraw, 0 deposit_count, count(withdraw.id) withdraw_count
                FROM withdraw
                INNER JOIN users ON users.id = withdraw.user_id
                INNER JOIN user_profiles ON user_profiles.user_id = withdraw.user_id
                WHERE withdraw.status = 1
                AND users.test = 0
                AND (withdraw.date_withdraw >= '" . date('Y-m-d 00:00:00', strtotime($date_from)) . "' AND withdraw.date_withdraw <= '" . date('Y-m-d 23:59:59', strtotime($date_to)) . "')
                AND CHAR_LENGTH(withdraw.account_number) > 4 $sql_withdraw
                GROUP BY withdraw.date_withdraw) saldo
                GROUP BY DATE_FORMAT(saldo.payment_date, '%m/%d/%Y')
                ORDER BY saldo.payment_date";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getTopDeposits( $limit = 0 ){
        $this->db->select('sum(deposit.conv_amount) as conv_amount, deposit.transaction_id, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date, user_profiles.country, user_profiles.full_name');
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT', false);
        $this->db->group_by('deposit.transaction_id, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date, deposit.transaction_id, user_profiles.country, user_profiles.full_name');
        $this->db->having('sum(deposit.conv_amount) >', 0);
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTopDepositsByDate( $limit = 0, $date_from, $date_to ){
        $this->db->select('sum(deposit.conv_amount) as conv_amount, deposit.transaction_id, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date, user_profiles.country, user_profiles.full_name');
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT', false);
        $this->db->group_by('deposit.transaction_id, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date, deposit.transaction_id, user_profiles.country, user_profiles.full_name');
        $this->db->having('sum(deposit.conv_amount) >', 0);
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLatestDeposits( $limit = 0 ){
        $this->db->select('deposit.conv_amount, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date');
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
//        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->order_by('deposit.payment_date', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLatestDepositsByDate( $limit = 0, $date_from, $date_to ){
        $this->db->select('sum(deposit.conv_amount) as conv_amount, deposit.transaction_id, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date, user_profiles.country, user_profiles.full_name');
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT', false);
        $this->db->group_by('deposit.transaction_id, deposit.transaction_type, mt_accounts_set.account_number, deposit.payment_date, deposit.transaction_id, user_profiles.country, user_profiles.full_name');
        $this->db->having('sum(deposit.conv_amount) >', 0);
        $this->db->order_by('deposit.payment_date', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTotalSaldoByDate($date_from, $date_to, $exclude_withdraw_accounts = array()){

        $sql_withdraw = '';
        if(count($exclude_withdraw_accounts) > 0){
            $sql_withdraw = 'AND withdraw.account_number not in (' . implode(',', $exclude_withdraw_accounts) . ')';
        }

        $sql = "SELECT sum(saldo.amount_deposit) amount_deposit, sum(saldo.amount_withdraw) amount_withdraw, sum(saldo.amount_deposit - saldo.amount_withdraw) amount FROM
                (SELECT deposit.payment_date payment_date, deposit.currency, SUM(deposit.conv_amount) amount_deposit, 0 amount_withdraw, count(DISTINCT deposit.transaction_id) deposit_count, 0 withdraw_count
                FROM deposit
                INNER JOIN users ON users.id = deposit.user_id
                INNER JOIN mt_accounts_set ON mt_accounts_set.user_id = deposit.user_id
                INNER JOIN user_profiles ON user_profiles.user_id = deposit.user_id
                WHERE deposit.status = 2
                AND deposit.isDeposit = 0
                AND users.test = 0
                AND mt_accounts_set.mt_type = 1
                AND (deposit.payment_date >= '" . date('Y-m-d 00:00:00', strtotime($date_from)) . "' AND deposit.payment_date <= '" . date('Y-m-d 23:59:59', strtotime($date_to)) . "')
                AND CHAR_LENGTH(mt_accounts_set.account_number) > 4
                AND deposit.admin_manualdeposit_users_id IS NULL
                AND UCASE(IFNULL(deposit.note,'')) not like '%TEST DEPOSIT%'
                GROUP BY deposit.payment_date, deposit.currency
                UNION ALL
                SELECT withdraw.date_withdraw, withdraw.currency, 0 amount_deposit, SUM(withdraw.conv_amount) amount_withdraw, 0 deposit_count, count(withdraw.id) withdraw_count
                FROM withdraw
                INNER JOIN users ON users.id = withdraw.user_id
                INNER JOIN user_profiles ON user_profiles.user_id = withdraw.user_id
                WHERE withdraw.status = 1
                AND users.test = 0
                AND (withdraw.date_withdraw >= '" . date('Y-m-d 00:00:00', strtotime($date_from)) . "' AND withdraw.date_withdraw <= '" . date('Y-m-d 23:59:59', strtotime($date_to)) . "')
                AND CHAR_LENGTH(withdraw.account_number) > 4 $sql_withdraw
                GROUP BY withdraw.date_withdraw, withdraw.currency) saldo ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function getUnsentNoDepositByDate( $date_request ){
        $this->db->from('no_deposit');
        $this->db->where('is_sent', 0);
        $this->db->where('date_request <=', date('Y-m-d H:i:s', strtotime($date_request)));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function updateNoDepositSentByUserID( $user_id ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('no_deposit', array('is_sent' => 1))){
            return true;
        }else{
            return false;
        }
    }
    public function getUnsentNoDepositByDate24( $date_request ){
        $this->db->from('no_deposit');
        $this->db->where('is_sent_24', 0);
        $this->db->where('date_request <=', date('Y-m-d H:i:s', strtotime($date_request)));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function updateNoDepositSentByUserID24( $user_id ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('no_deposit', array('is_sent_24' => 1))){
            return true;
        }else{
            return false;
        }
    }

    public function getRebateList($type){
        $sql = "select * from (
select  0 project_name,0.0 rebate,r.rebate new_value, r.periodicity,1 `status`, r.user_id,r.date_created,r.date_modifided,r.account_number,p.reference_num from personal_rebate r
inner join partnership p on p.partner_id= r.user_id
union all
select rs.project_name,rs.rebate,rs.new_value,rs.periodicity,rs.status,rs.user_id,rs.created_date,rs.modified_date,mas.account_number,p.reference_num
from rebate_system rs inner join partnership_affiliate_code pac on rs.user_id=pac.partner_id
left join partnership p on p.partner_id=pac.partner_id
inner join users_affiliate_code uac on uac.referral_affiliate_code=pac.affiliate_code
inner join mt_accounts_set mas on mas.user_id=uac.users_id
) t where t.periodicity=?  group by t.account_number";

        $query = $this->db->query($sql,array($type));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function updateAccountBalance( $account_number, $amount ){
        $data = array(
            'amount' => $amount
        );
        $this->db->where('account_number', $account_number);
        if($this->db->update('mt_accounts_set', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function updatePartnerBalance( $account_number, $amount ){
        $data = array(
            'amount' => $amount
        );
        $this->db->where('reference_num', $account_number);
        if($this->db->update('partnership', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function getMostDepositMethods( $date_from, $date_to, $country = '' ){
        $this->db->select('deposit.transaction_type, sum(deposit.amount) deposit_amount', false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        if( trim($country) <> '' ){
            $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'inner');
            $this->db->where('user_profiles.country', strtoupper(trim($country)));
        }
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT', false);
        $this->db->group_by('deposit.transaction_type');
        $this->db->order_by('count(deposit.user_id)', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getPopularDepositMethods( $date_from, $date_to ){
        $this->db->select('deposit.transaction_type, count(deposit.user_id) user_count', false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'inner');
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT', false);
        $this->db->group_by('deposit.transaction_type');
        $this->db->order_by('count(deposit.user_id)', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getDepositorsByDate( $date_from, $date_to ) {
        $this->db->select("DATE_FORMAT(deposit.payment_date, '%H:%i:%s') payment_time, deposit.conv_amount as amount, mt_accounts_set.account_number, partnership.reference_num, user_profiles.country, user_profiles.full_name, deposit.transaction_type, deposit.note", false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'left');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'left');
        $this->db->join('partnership', 'partnership.partner_id = deposit.user_id', 'left');
        $this->db->where('deposit.status', 2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('users.test', 0);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT');
        $this->db->order_by('deposit.payment_date');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepositPerCountries( $date_from, $date_to ){
        $this->db->select('user_profiles.country, sum(deposit.conv_amount) as amount', null, false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
//        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->group_by('user_profiles.country');
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepositPerPaymentSystems( $date_from, $date_to ){
        $this->db->select('UCASE(deposit.transaction_type) as payment_type, sum(deposit.conv_amount) as amount', null, false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('deposit.status',2);
        $this->db->where('deposit.isDeposit', 0);
//        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->not_like('UCASE(deposit.note)', 'TEST DEPOSIT', false);
        $this->db->group_by('UCASE(deposit.transaction_type)');
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepositSumByDate( $date_from, $date_to ){
        $this->db->select('SUM(deposit.conv_amount) amount_deposit, count(DISTINCT deposit.user_id) deposit_count, count(DISTINCT deposit.transaction_id) deposit_actual_count');
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'INNER');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id', 'INNER');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id', 'INNER');
        $this->db->where('deposit.status', 2);
        $this->db->where('deposit.isDeposit', 0);
        $this->db->where('users.test', 0);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where('deposit.admin_manualdeposit_users_id IS NULL', null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->not_like("UCASE(IFNULL(deposit.note,''))", 'TEST DEPOSIT', false);
        $query = $this->db->get();
        return $query->row_array();
    }

    function insertPayment( $data = array() ){
        if($this->db->insert('deposit', $data)){
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

    public function getDepositAmountByTransactionId($transaction_id, $account_number){
        $this->db->select('sum(deposit.amount) as amount, sum(deposit.conv_amount) as conv_amount');
        $this->db->from('deposit');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = deposit.user_id');
        $this->db->where('deposit.transaction_id', $transaction_id);
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }
}