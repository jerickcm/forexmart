<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function getAccountsByUserId( $user_id ){
            $this->db->select('mt_accounts_set.*, users.type');
            $this->db->from('mt_accounts_set');
            $this->db->join('users', 'users.id = mt_accounts_set.user_id');
            $this->db->where('user_id', $user_id);
            $this->db->order_by('id', 'DESC');
            $data = $this->db->get();
            return $data->result_array();
    }

    function getAccountsByAccountNumber( $account_number ){
            $this->db->select('mt_accounts_set.*, users.type,users.nodepositbonus,deposit.thirtypercentbonus,deposit.fiftypercentbonus,mt_accounts_set.mini_bonus_credit');
            $this->db->from('mt_accounts_set');
            $this->db->join('users', 'users.id = mt_accounts_set.user_id');
            $this->db->join('deposit', 'users.id = deposit.user_id','left');
            $this->db->where('mt_accounts_set.account_number', $account_number);
            $this->db->order_by('id', 'DESC');
            $this->db->limit('1');
            $data = $this->db->get();
            if($data->num_rows() > 0){
                return $data->row_array();
            }else{
                return false;
            }
    }

    function getMtAccountType( $user_id ){
        $mtAccounts = $this->getAccountsByUserId( $user_id );
        foreach($mtAccounts as $acct){
            if($acct['mt_type']){
                return true;
            }
        }
        return false;
    }

    function upload_documents( $data ){
        $this->db->insert('user_documents' ,$data);
        return $this->db->insert_id();
    }

    function update_upload_documents($user_id, $doc_type, $updatedata){
        $passAraray = array(
            'user_id' => $user_id,
            'doc_type' => $doc_type
        );
        $this->db->where($passAraray);
        $this->db->update('user_documents', $updatedata);
    }

    function checkUserDocs($user_id, $doc_type){
        $this->db->select('*');
        $this->db->from('user_documents');
        $passArray = array(
            'user_id' => $user_id,
            'doc_type' => $doc_type
        );
        $this->db->where($passArray);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function updateUserDetails($table,$field,$id,$data){
        $this->db->where($field, $id);
        $this->db->update($table, $data);
    }

    function insert($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    //get users details
    function getUserEmailByUserId($user_id){
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    //get user details for filter
    function getUserDetailsFilter($user_id, $filterField){
        $this->db->distinct();
        $this->db->select($filterField);
        $this->db->from('mt_accounts_set');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function selectedDetailsFilter($user_id, $flts, $test, $test2){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->where_in('mt_type', $flts);
        $this->db->where_in('mt_currency_base', $test);
        $this->db->where_in('mt_account_set_id', $test2);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function checkIfUniqueAccountNumber($accountnum){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->like('account_number', $accountnum, 'before');
        $queryResult = $this->db->get();

        return ($queryResult->num_rows() > 0) ? false : true;
    }

    function getAccountsByType( $type, $token = ''){
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', $type);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        if( $token != '' ){
            $search = "( mt_accounts_set.account_number LIKE '%$token%'
                OR user_profiles.full_name LIKE '%$token%'
                OR DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
                OR CASE WHEN mt_accounts_set.mt_account_set_id = 1 THEN 'FOREXMART STANDARD' ELSE 'FOREXMART ZERO SPREAD' END like '%$token%'
                OR mt_accounts_set.mt_currency_base like '%$token%'
                OR users.email like '%$token%')";
            $this->db->where($search, null, false);
        }
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getLimitAccountsByType( $type, $limit, $offset, $token = '' ){
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name, users.accountstatus');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        if( $token != '' ){
            $search = "( mt_accounts_set.account_number LIKE '%$token%'
                OR user_profiles.full_name LIKE '%$token%'
                OR DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
                OR CASE WHEN mt_accounts_set.mt_account_set_id = 1 THEN 'FOREXMART STANDARD' ELSE 'FOREXMART ZERO SPREAD' END like '%$token%'
                OR mt_accounts_set.mt_currency_base like '%$token%'
                OR users.email like '%$token%')";
            $this->db->where($search, null, false);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAffiliateAccounts( $token = '', $country = array() ){
        $this->db->select('partnership.*, users.email, user_profiles.country, user_profiles.full_name');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        if( $token != '' ){
            if(count($country) > 0){
                $search_country = "OR UCASE(user_profiles.country) in ('" . implode("', '", $country) . "')";
            }else{
                $search_country = '';
            }
            $search = "( partnership.reference_num LIKE '%$token%'
                OR UCASE(user_profiles.full_name) LIKE '%$token%'
                OR DATE_FORMAT(partnership.dateregistered, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
                OR UCASE(users.email) LIKE '%$token%'
                OR UCASE(partnership.type_of_partnership) like '%$token%'
                OR UCASE(users.email) like '%$token%' $search_country)";
            $this->db->where($search, null, false);
        }
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getLimitAffiliateAccounts( $limit, $offset, $token = '', $country = array() ){
        $this->db->select('partnership.*, users.email, user_profiles.country, user_profiles.full_name');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        if( $token != '' ){
            if(count($country) > 0){
                $search_country = "OR UCASE(user_profiles.country) in ('" . implode("', '", $country) . "')";
            }else{
                $search_country = '';
            }
            $search = "( partnership.reference_num LIKE '%$token%'
                OR UCASE(user_profiles.full_name) LIKE '%$token%'
                OR DATE_FORMAT(partnership.dateregistered, '%m/%d/%Y %h:%i:%s') LIKE '%$token%'
                OR UCASE(users.email) LIKE '%$token%'
                OR UCASE(partnership.type_of_partnership) like '%$token%' $search_country)";
            $this->db->where($search, null, false);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAccountsByIdType( $id, $type ){
        $this->db->select('mt_accounts_set.*,
                           users.email, users.type, users.affiliate_code, users.nodepositbonus,
                           user_profiles.full_name, user_profiles.country, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.zip, user_profiles.dob, user_profiles.fb,
                           contacts.phone1, contacts.phone2, contacts.email2, contacts.email3,
                           trading_experience.experience, trading_experience.investment_knowledge, trading_experience.trade_duration, trading_experience.risk,
                           employment_details.politically_exposed_person, employment_details.employment_status, employment_details.employment_status, employment_details.industry,
                           employment_details.estimated_annual_income, employment_details.estimated_net_worth, employment_details.education_level, employment_details.us_resident,
                           employment_details.us_citizen');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id', 'left');
        $this->db->join('contacts', 'contacts.user_id = mt_accounts_set.user_id', 'left');
        $this->db->join('trading_experience', 'trading_experience.user_id = mt_accounts_set.user_id', 'left');
        $this->db->join('employment_details', 'employment_details.user_id = mt_accounts_set.user_id', 'left');
        $this->db->where('mt_accounts_set.id', $id);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $data = $this->db->get();
        return $data->row_array();
    }



    function getAffiliateById( $id ){
        $this->db->select('partnership.*, users.email, user_profiles.country, user_profiles.full_name,user_profiles.street,user_profiles.city,user_profiles.dob,
                            user_profiles.state,user_profiles.zip,user_profiles.skype, contacts.phone1, contacts.phone2, contacts.email2, contacts.email3');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->join('contacts', 'contacts.user_id = partnership.partner_id', 'left');
        $this->db->where('partnership.id', $id);
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $data = $this->db->get();
        return $data->row_array();
    }

    function getContestAccountsByDateRange( $start_date, $end_date ){
        $this->db->select('mt_accounts_set.*');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
        $this->db->where('contestmoneyfall.Activation', 1);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $data = $this->db->get();
        return $data->result_array();
    }

    function updateAmountByAccountNumber( $account_number, $amount ){
        $data = array(
            'amount' => $amount
        );
        $this->db->where('account_number', $account_number);
        $this->db->update('mt_accounts_set', $data);
    }

    function updateCurrentWinners( $startdate, $winners ){
        $this->db->trans_start();
        $this->db->delete('contest_winners', array('start_date' => $startdate));
        $this->db->insert_batch('contest_winners', $winners);
        $this->db->trans_complete();
        return true;
    }

    function getContestWinners( $start_date, $end_date ){
        $result = $this->db->query("CALL getContestWinners('" . $start_date . "','" . $end_date . "')");
        $data =  $result->result_array();
        $result->next_result();
        $result->free_result();
        return $data;
    }

    function getMoneyFallContestantByEmailFullName($email = '', $full_name = ''){
        $this->db->where('Email', $email);
        $this->db->where('FullName', $full_name);
        $this->db->from('contestmoneyfall');
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $result = $this->db->get();
        return $result->row_array();
    }

    function updateAccountByUserId( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('mt_accounts_set', $data)){
            return true;
        }else{
            return false;
        }
    }

    function updateAffiliateByUserId( $partner_id, $data ){
        $this->db->where('partner_id', $partner_id);
        if($this->db->update('partnership', $data)){
            return true;
        }else{
            return false;
        }
    }

    function insertAccountUpdateHistory( $data ){
        if($this->db->insert('account_update_history', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    function insertAccountUpdateFieldHistory( $data ){
        if($this->db->insert_batch('account_field_update_history', $data)){
            return true;
        }else{
            return false;
        }
    }

    function getAccountUpdateHistoryByUserId( $user_id ){
        $this->db->select('account_update_history.*, user_profile.full_name as user_name, manager_profile.full_name as manager_name');
        $this->db->from('account_update_history');
        $this->db->join('user_profiles as user_profile', 'account_update_history.user_id = user_profile.user_id','left');
        $this->db->join('user_profiles as manager_profile', 'account_update_history.manager_id = manager_profile.user_id','left');
        $this->db->where('account_update_history.user_id', $user_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getLeverageUpdateHistoryByUserId( $user_id ){
        $this->db->select('leverage_update_history.*, user_profile.full_name as user_name, manager_profile.full_name as manager_name');
        $this->db->from('leverage_update_history');
        $this->db->join('user_profiles as user_profile', 'leverage_update_history.user_id = user_profile.user_id');
        $this->db->join('user_profiles as manager_profile', 'leverage_update_history.manager_id = manager_profile.user_id');
        $this->db->where('leverage_update_history.user_id', $user_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getAccountFieldUpdateHistoryById( $id ){
        $this->db->select('account_field_update_history.*, user_profiles.full_name as manager_name');
        $this->db->from('account_field_update_history');
        $this->db->join('account_update_history', 'account_field_update_history.update_id = account_update_history.id');
        $this->db->join('user_profiles', 'account_update_history.manager_id = user_profiles.user_id','left');
        $this->db->where('account_field_update_history.update_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getAllAccounts(){
        $this->db->select('mt_accounts_set.*, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $result = $this->db->get();
        return $result->result_array();
    }

    function updateAffiliateAccountById($id, $data){
        $this->db->where('id', $id);
        if($this->db->update('partnership', $data)){
            return true;
        }else{
            return false;
        }
    }

    function getRegisteredNoAccounts( $as_of_date ){
        $this->db->select('users.id, users.email, user_profiles.street, user_profiles.city, user_profiles.country, user_profiles.state, user_profiles.zip, user_profiles.full_name, contacts.phone1');
        $this->db->from('users');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
        $this->db->join('contacts', 'users.id = contacts.user_id');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id', 'left');
        $this->db->where('users.type', 1);
        $this->db->where('users.login_type', 0);
        $this->db->where('users.created >=', date('Y-m-d', strtotime($as_of_date)));
        $this->db->where('mt_accounts_set.account_number is null');
        $result = $this->db->get();
        return $result->result_array();
    }

    function getEmailNoAccounts( $from_account = 0, $to_account = 0 ){
        $this->db->select('mt_accounts_set.*, user_profiles.full_name, users.email');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'mt_accounts_set.user_id = user_profiles.user_id');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->where('mt_accounts_set.account_number >=', $from_account);
        $this->db->where('mt_accounts_set.account_number <=', $to_account);
        $result = $this->db->get();
        return $result->result_array();
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

    function getEmailNoAccountsByAccount( $account ){
        $this->db->select('mt_accounts_set.*, user_profiles.full_name, users.email');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'mt_accounts_set.user_id = user_profiles.user_id');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->where('mt_accounts_set.account_number', $account);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function updatePartnerAccountBalance( $account_number, $amount ){
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

    function getQuerystirngRow($table,$field,$values,$start){
        $this->db->select($start);
        $this->db->from($table);
        $this->db->where($field, $values);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
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

    public function getAccountsLikeAccountNumber( $account_number ){
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', 1);
        if( trim($account_number) != '' ) {
            $this->db->like('mt_accounts_set.account_number', $account_number, 'after');
        }else{
            $this->db->where('mt_accounts_set.account_number', $account_number);
        }
        $this->db->like('mt_accounts_set.account_number', $account_number);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getLimitAccountsLikeAccountNumber( $account_number, $limit = 0, $offset = 0 ){
        $this->db->select('mt_accounts_set.*, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', 1);
        if( trim($account_number) != '' ) {
            $this->db->like('mt_accounts_set.account_number', $account_number, 'after');
        }else{
            $this->db->where('mt_accounts_set.account_number', $account_number);
        }
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getAutoLeverageAccountsAccountNumber(){
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', 1);
        $this->db->like('mt_accounts_set.auto_leverage', 1);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getLimitAutoLeverageAccountsAccountNumber( $limit = 0, $offset = 0 ){
        $this->db->select('mt_accounts_set.*, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', 1);
        $this->db->like('mt_accounts_set.auto_leverage', 1);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function insertLeverageUpdateHistory($data){
        if($this->db->insert('leverage_update_history', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function hasUserAutoLeverage($user_id){
        $this->db->from('mt_accounts_set');
        $this->db->where('user_id', $user_id);
        $this->db->where('auto_leverage', 0);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateAccountLeverage( $account_number, $leverage ){
        $data = array(
            'leverage' => $leverage
        );
        $this->db->where('account_number', $account_number);
        if($this->db->update('mt_accounts_set', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function getAccountStatus($user_id){
        $this->db->select('accountstatus');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $getStatus = $query->row();
//            $getStatus->accountstatus;
            if($getStatus->accountstatus == 1){
                $this->db->select('*');
                $this->db->from('mt_accounts_set');
                $this->db->join('trading_experience', 'trading_experience.user_id = mt_accounts_set.user_id', 'left');
                $this->db->join('employment_details', 'employment_details.user_id = mt_accounts_set.user_id', 'left');
                $this->db->where('mt_accounts_set.user_id', $user_id);
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    return $query->row();
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function getPartnerInfo($user_id){

        $this->db->select("p.reference_num,p.partner_id,u.email,up.full_name");
        $this->db->from('partnership p');
        $this->db->join('user_profiles up', ' p.partner_id = up.user_id');
        $this->db->join('users u', ' u.id = up.user_id');
        $this->db->where('p.reference_num', $user_id);


        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function getAffiliateCodeByAccountNumber($account_number){
        $this->db->select('*, users_affiliate_code.id as uacID')
            ->from('mt_accounts_set')
            ->join('users_affiliate_code', 'mt_accounts_set.user_id = users_affiliate_code.users_id', 'left')
            ->where('mt_accounts_set.account_number', $account_number);
        $result = $this->db->get();
        if($result->num_rows() > 0 ){
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function getAccountNumberByAffiliateCode($affiliate_code){
        //        select partnership.reference_num, mt_accounts_set.account_number from users
//        left join partnership_affiliate_code on users.id = partnership_affiliate_code.partner_id
//        left join partnership on partnership.partner_id = partnership_affiliate_code.partner_id
//        left join users_affiliate_code on users.id=users_affiliate_code.users_id
//        left join mt_accounts_set on mt_accounts_set.user_id = users_affiliate_code.users_id
//        where partnership_affiliate_code.affiliate_code = 'HGMWM'
//        Order by users.created DESC
//        $this->db->select('partnership.reference_num, mt_accounts_set.account_number');
        $this->db->select('partnership.reference_num, mt_accounts_set.account_number');
        $this->db->from('users');
        $this->db->join('partnership_affiliate_code', 'users.id = partnership_affiliate_code.partner_id', 'left');
        $this->db->join('partnership', 'partnership.partner_id = partnership_affiliate_code.partner_id', 'left');
        $this->db->join('users_affiliate_code', 'users.id=users_affiliate_code.users_id', 'left');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users_affiliate_code.users_id', 'left');
        $this->db->where('partnership_affiliate_code.affiliate_code', $affiliate_code);
        $this->db->or_where('users_affiliate_code.affiliate_code', $affiliate_code);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result_array();
        }else{
            return false;
        }
    }




    public function getAffiliateDetailsByUserId($user_id){
        $this->db->select('*')
            ->from('users_affiliate_code')
            ->where('users_id', $user_id);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function getAccountNumber($account){
        $this->db->select('*')
                    ->from('mt_accounts_set')
                    ->where('account_number',$account);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function searchAgentAffiliateCode($account){
        $query = $this->db->query('select * from (SELECT affiliate_code, users_id userid from users_affiliate_code union all SELECT affiliate_code, partner_id userid from partnership_affiliate_code) t where userid = '.$account);
        $result =  $query->row();
        if(empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function getPayCoRegistrationAttempts($status) {
        $this->db->select('manage_payco_registration.*, user_profiles.full_name, users.login_type, partnership.reference_num, mt_accounts_set.account_number');
        $this->db->from('manage_payco_registration');
        $this->db->join('users', 'users.id = manage_payco_registration.user_id', 'left');
        $this->db->join('user_profiles', 'user_profiles.user_id = manage_payco_registration.user_id', 'left');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id', 'left');
        $this->db->join('partnership', 'partnership.partner_id = users.id', 'left');
        $this->db->order_by('manage_payco_registration.id', 'DESC');
        $this->db->where('manage_payco_registration.status', $status);
        $result = $this->db->get();

        return $result->result_array();
    }
    function getAccountsByAccountNumber_minibonus( $account_number ){
        $this->db->select('mt_accounts_set.*, users.type,users.accountstatus,users.email,user_profiles.full_name,user_profiles.dob,users.nodepositbonus');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id','left');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $data = $this->db->get();
        if($data->num_rows() > 0){
            return $data->row_array();
        }else{
            return false;
        }
    }

    public function getUserReferralCode($user_id) {
        $this->db->select('referral_affiliate_code');
        $this->db->from('users_affiliate_code');
        $this->db->where('users_id', $user_id);
        $this->db->group_by('users_id');
        $this->db->order_by('date_created', 'desc');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            return $query->row_array();
        }
        return false;
    }

    public function getUserAffiliateAgent($referral_aff_code) {
        $this->db->select('partnership_affiliate_code.affiliate_code, user_profiles.full_name, user_profiles.user_id');
        $this->db->from('partnership_affiliate_code');
        $this->db->join('user_profiles','user_profiles.user_id = partnership_affiliate_code.partner_id','left');
        $this->db->where('partnership_affiliate_code.affiliate_code',$referral_aff_code);
        $partner_query = $this->db->get();

        if($partner_query->num_rows() > 0){
            return $partner_query->row_array();
        } else {
            $this->db->select('users_affiliate_code.affiliate_code, user_profiles.full_name, user_profiles.user_id');
            $this->db->from('users_affiliate_code');
            $this->db->join('user_profiles','user_profiles.user_id = users_affiliate_code.users_id','left');
            $this->db->where('users_affiliate_code.affiliate_code',$referral_aff_code);
            $client_query = $this->db->get();

            if($client_query->num_rows() > 0){
                return $client_query->row_array();
            } else {
                return false;
            }
        }
    }

    public function getAccountByPartnerId( $partner_id ){
        $this->db->select('reference_num as account_number');
        $this->db->from('partnership');
        $this->db->where('partner_id', $partner_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function getUserDetailsByUserId($user_id){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $result = $this->db->get();
        if( $result->num_rows() > 0 ){
            return $result->row_array();
        }
        return false;
    }

    public function getUserIdByAccountNumber($account_number){
        $sql = "SELECT user_id FROM mt_accounts_set WHERE account_number = ?
                UNION ALL
                SELECT partner_id as user_id FROM partnership WHERE reference_num = ?";

        $query = $this->db->query($sql, array($account_number, $account_number));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getUserDetailsByAccountNumber($account_number){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('mt_accounts_set', 'users.id = mt_accounts_set.user_id', 'left');
        $this->db->join('contacts', 'users.id = contacts.user_id', 'left');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $result = $this->db->get();
        if($result->num_rows() > 0 ){
            return $result->row_array();
        }
        return false;
    }
    function insertAccountUpdateFieldHistory1( $data ){
        $this->db->insert('account_field_update_history' ,$data);
        return true;
    }
    public function getaccountshow($sel,$table,$data){
        $this->db->select($sel)
            ->from($table)
            ->where($data);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }
    }

    function isMicro( $user_id ){
        $this->db->select('micro');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $this->db->where('micro', 1);
        $data = $this->db->get();
        if($data->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getAffiliateLinkById( $partner_id ) {
        $this->db->select('affiliate_link, affiliate_code');
        $this->db->from('partnership_affiliate_code');
        $this->db->where('partner_id',$partner_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getAccountLoginType( $user_id ){
        $this->db->select('login_type');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }

    }
}
