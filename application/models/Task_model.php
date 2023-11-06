<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function showView1Where3( $table,$field0,$id0, $field1,$id1,$field2,$id2,$select="" ){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where('Lower('.$field0.')',strtolower($id0)); //email
        $this->db->where($field1,$id1); // fullname
        $this->db->where($field2,$id2); // last ip

        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }

    /*
     * FXPP-3154 - Fix bug in the saving of accounts who registered from the landing page in FXPP
     * */
    public function getFMLandingRealAccounts( $limit = 0 ){
        $this->db->select('users.id, users.type, mt_accounts_set.account_number');
        $this->db->from('forexmart_landing');
        $this->db->join('users', 'users.id = forexmart_landing.users_Id', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = forexmart_landing.users_Id', 'inner');
        $this->db->where('users.type', 0);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->limit($limit);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    /*
     * FXPP-3154 - Fix bug in the saving of accounts who registered from the landing page in FXPP
     * */
    public function getFMLandingDemoAccounts( $limit = 0 ){
        $this->db->select('users.id, users.type, mt_accounts_set.account_number');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.type', 1);
        $this->db->where('mt_accounts_set.account_number >', 1000000);
        $this->db->limit($limit);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function taggingDoubeNDB(){
        $this->db->select('email,account_number,registration_time,amount,mt_currency_base,open_trading');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.type', 1);
        $this->db->where('registration_time >=', '2017-03-01 00:00:01');
//        $this->db->limit(1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function taggingDoubeNDB_test(){
        $this->db->select('email,account_number,registration_time,amount,mt_currency_base,open_trading');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.type', 1);
        $this->db->where('registration_time >=', '2017-03-12 00:00:01');
        $this->db->where('account_number',249636);
        $this->db->limit(1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }


    public function taggingDoubeNDB2(){
        $this->db->select('email,account_number,registration_time,amount,mt_currency_base,open_trading');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.type', 1);
        $this->db->where('registration_time >=', '2017-03-13 00:00:01');
        $this->db->where('registration_time <=', '2017-03-17 23:00:01');
        $this->db->order_by("email", "asc");
        //        $this->db->limit(1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function get_ndbm1317(){
        $this->db->select('*');
        $this->db->from('logfxpp_7528');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

//    public function getThisWeekContestRegistrations_old(){
//
//        $this->db->select('FullName,Email,NickName');
//        $this->db->from('contestmoneyfall');
//        $this->db->where('date_activated >', DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday this week")))->format('Y-m-d'));
//        $this->db->where('date_activated<', DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday next week")))->format('Y-m-d'));
//        $data = $this->db->get();
//        if($data->num_rows() > 0) {
//            return $data->result_array();
//        }else{
//            return false;
//        }
//
//    }
    public function get_ndbmcredited(){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->where('mini_bonus_credit', 1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    public function get_ndbmcredited_ofall(){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('type', 1);
        $this->db->where('nodepositbonus', 1);
        $this->db->where('check_inactivity',0);
//        $this->db->limit(100);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function gettest(){
        $this->db->select('*');
        $this->db->from('test_view');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function getThisWeekContestRegistrations(){
        date_default_timezone_set('Europe/Minsk');
        $this->db->select('FullName,Email,NickName,date_activated');
        $this->db->from('contestmoneyfall');
        $this->db->where('date_activated >', DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d 22:59:59',strtotime("sunday last week")))->format('Y-m-d H:i:s'));
        $this->db->where('date_activated <', DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d 23:00:00',strtotime("sunday this week")))->format('Y-m-d H:i:s'));
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }

    }

    function count_registrationclient_F_IP( $full_name='', $ip='' ){

        $this->db->select('count(0) AS `count`');
        $this->db->from('users');
        $this->db->join('user_profiles', '`user_profiles`.`user_id` = `users`.`id`');
        $this->db->where('cast(`users`.`created` AS date) = curdate()');
        $this->db->where('`users`.`login_type`',0);
        $this->db->where('`user_profiles`.`full_name`',$full_name);
        $this->db->where('`users`.`last_ip`',$ip);

        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }

    function count_registrationpartner_F_IP( $full_name='', $ip='' ){

        $this->db->select('count(0) AS `count`');
        $this->db->from('users');
        $this->db->join('user_profiles', '`user_profiles`.`user_id` = `users`.`id`');
        $this->db->where('cast(`users`.`created` AS date) = curdate()');
        $this->db->where('`users`.`login_type`',1);
        $this->db->where('`user_profiles`.`full_name`',$full_name);
        $this->db->where('`users`.`last_ip`',$ip);

        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    function getclickstat(){
        $this->db->select('ip,referrer,date');
        $this->db->from('webtrader_logs');
        $this->db->order_by('date','asc');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function getclickstat_period(){
        $this->db->select('date,count(*) as clicks');
        $this->db->from('webtrader_logs');
        $this->db->group_by('date');
        $this->db->order_by('date','asc');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function getclickstat_period_week(){
        $this->db->select('YEAR(date),MONTH(date), WEEK(date),date,count(*) as clicks');
        $this->db->from('webtrader_logs');
        $this->db->group_by('WEEK(date)');
        $this->db->order_by('YEAR(date)','asc');
        $this->db->order_by("MONTH(date)", "asc");
        $this->db->order_by("WEEK(date)", "asc");
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    function getclickstat_period_month(){
        $this->db->select('YEAR(date),MONTH(date), WEEK(date),date,count(*) as clicks');
        $this->db->from('webtrader_logs');
        $this->db->group_by('MONTH(date)');
        $this->db->order_by('YEAR(date)','asc');
        $this->db->order_by("MONTH(date)", "asc");
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }


    }

    function check_not_removedagent(){
        $this->db->select('account_number,nodepositbonus,ndba_acquired');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
        $this->db->where('registration_time >','2017-03-12 00:00:01' );
        $this->db->where('nodepositbonus',1 );
        $this->db->where('agent_ndbtag IS NULL');
        $this->db->where('type',1 );
        $this->db->where('test !=',1 );
        $this->db->where('test_1 !=',0 );
        $this->db->limit(1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

    function check_agentremovedbymanager(){
        $this->db->select('account_number');
        $this->db->from('test_removedagent_others');
        $this->db->where('status',0 );
        $this->db->limit(1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }
    function check_agent(){
        $this->db->select('account_number');
        $this->db->from('test_removedagent_others');
        $this->db->where('status_agent',0 );
        $this->db->limit(1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

    function data2(){
        $this->db->select('account_number');
        $this->db->from('test_ndbremovedagents');
        $this->db->where('status',0 );
        $this->db->limit(1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }
    function check_agent_data2(){
        $this->db->select('account_number');
        $this->db->from('test_ndbremovedagents');
        $this->db->where('status_agent',0 );
        $this->db->limit(1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

    function migrate($table,$userid){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('user_id',$userid);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    function migrate_users($table,$userid){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$userid);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    function ptestaccount(){
        $this->db->select('user_id,email');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
        $this->db->where('lower(email)','trowabarton00005@gmail.com');
        $this->db->where('login_type',0);
        $this->db->where('type',1);
        $this->db->limit(200);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function checklive(){
        $this->db->select('account_number');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
        $this->db->where('login_type',0);
        $this->db->where('type',1);
        $this->db->where('check_inactivity',0);
        $this->db->or_where('check_inactivity',1);
        $this->db->where('account_number!=','');
        $this->db->limit(1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    function allinactiveaccounts(){
        $this->db->select('user_id,email,account_number');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
        $this->db->where('active',5);
        $this->db->where('login_type',0);
        $this->db->where('type',1);
        $this->db->limit(1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function songtestaccount(){
        $this->db->select('user_id,email');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
//        $this->db->where('lower(email)','fxtest025@gmail.com');
        $this->db->where('lower(email)','fxtest026@gmail.com');
        $this->db->where('login_type',0);
        $this->db->where('type',1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function jomaritestaccount(){
        $this->db->select('user_id,email');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
        $this->db->where('lower(email)','kent86407@gmail.com');
        $this->db->where('login_type',0);
        $this->db->where('type',1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function jtestaccount(){
        $this->db->select('user_id,email,account_number');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id=mt_accounts_set.user_id');
        $this->db->where('lower(email)','tdum574@gmail.com');
        $this->db->where('login_type',0);
        $this->db->where('type',1);
        $this->db->where('account_number!=','');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    function get_contestprize_bonusaccounts(){
        die();
        $this->db->distinct('account_number');
        $this->db->from('credit_prize');
        $this->db->where('comment','FOREXMART SHOWFX BONUS');
        $this->db->where('tag','0');
        $this->db->group_by('account_number');
        $this->db->limit(250);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function get_showfxusers(){
        die();
        $query = $this->db->query('Select DISTINCT credit_prize.account_number,is_showfxbonus,users.id,email from credit_prize join users on users.id=credit_prize.user_id   where credit_prize.comment="FOREXMART SHOWFX BONUS" and tag=2;');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    function get_showfxusers_exhibitions(){
        die();
        $this->log_db = $this->load->database('logs', true);
        $this->log_db->reconnect();
        $query=$this->log_db->query('select id,processed_users_id_accountnumber from admin_log where admin_log.page="manage-bonus/exhibition_bonus" and processed_users_id=0');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
        $this->log_db->close();
    }

    function update_log($table,$field,$id,$data){
        die();
        $this->log_db->reconnect();
        $this->log_db->where($field, $id);
        $this->log_db->update($table, $data);
        if ($this->log_db->affected_rows() > 0){
            return true;
        }
        return false;
        $this->log_db->close();
    }
    function get_showfxusers_exhibitions2(){
        die();
        $this->log_db = $this->load->database('logs', true);
        $this->log_db->reconnect();
        $query=$this->log_db->query('select processed_users_id,processed_users_id_accountnumber from admin_log where admin_log.page="manage-bonus/exhibition_bonus" and processed_users_id!=0');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
        $this->log_db->close();
    }
    function get_liveaccount_endofmarch2017(){

        $this->db->select('account_number');
        $this->db->from('test_tally_march2017');
        $this->db->where('tag',0);
        $this->db->limit(1000);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    public function getMicroByAccountNumber($account_number = null){
        $sql = "select micro from (select user_id from mt_accounts_set where account_number = ? union all select partner_id from partnership where reference_num = ?) as t left join users  u on u.id = t.user_id where u.micro=1";
        $query =  $this->db->query($sql,array($account_number,$account_number));
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    function tagmicro(){
        die();
        $this->db->select('account_number');
        $this->db->from('test_tally_march2017');
        $this->db->where('tag_micro',0);
        $this->db->limit(1000);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }

    }

    function tagtrades(){
        die();
        $this->db->select('account_number');
        $this->db->from('test_tally_march2017');
        $this->db->where('tag_trades',0);
        $this->db->limit(1000);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }

    }

    function tagcommission(){
        $this->db->select('account_number');
        $this->db->from('test_tally_march2017');
        $this->db->where('tag_commission',0);
//        $this->db->limit(1000);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

}
