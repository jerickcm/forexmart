<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

//    public function get_liveaccounts (){
//        $this->db->select('account_number');
//        $this->db->from('all_liveaccounts');
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return false;
//    }
    public function get_top_20_pages (){
        $this->db->select('*');
        $this->db->from('visited_pages');
        $this->db->order_by('count', 'DESC');
        $this->db->group_by('page');
        $this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function get_top_20_pages_real (){
        $this->db->select('id,actual_page,subdomain,SUM(count) as count');
        $this->db->from('visited_pages');
        $this->db->order_by('count', 'DESC');
        $this->db->group_by('actual_page');
        $this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function show_table($select,$table){
        $this->db->select($select);
        $this->db->from($table);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    public function show_all($select,$table){
        $this->db->select($select);
        $this->db->from($table);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        }
        return false;
    }

    public function show_select_ndbr($select,$table,$length, $start,$search='',$order=''){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->limit($length, $start);

            switch($order['0']['column']){
                case 0:
                    $this->db->order_by('account_number', $order[0]['dir']);
                    break;
                case 1:
                $this->db->order_by('full_name', $order[0]['dir']);
                    break;
                case 2:
                $this->db->order_by('date_request', $order[0]['dir']);
                    break;
                case 3:
                $this->db->order_by('country', $order[0]['dir']);
                    break;
                default:
                    $this->db->order_by('date_request',$order[0]['dir']);
            }
        if( $search != '' ){
            $search = "( user_id LIKE '%$search%'
                OR UCASE(full_name) LIKE '%$search%'
                OR DATE_FORMAT(date_request, '%Y-%M-%d %H:%i:%s') LIKE '%$search%'
                OR UCASE(country) LIKE '%$search%'
                OR UCASE(account_number) LIKE '%$search%'  )";

            $this->db->where($search, null, false);
        }
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        }
        return false;
    }
    function showssingle($table,$field="",$id="",$select="",$order_by=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function showssingle2($table,$field="",$id="",$field2="", $id2="",$select="",$order_by=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        if ($order_by!=""){
            $this->db->order_by($order_by,'desc');
        }
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function get_newest_mt4_comment($table,$field="",$id="",$select=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $this->db->order_by('date_created', 'desc');
        $this->db->limit(1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function deletemy($table,$field,$id){
        $this->db->delete($table, array($field => $id));
    }
    public function get_top_20_pages_real_args ($domain=""){

        $this->db->select('id,actual_page,subdomain,SUM(count) as count');
        $this->db->from('visited_pages');
        $this->db->where('subdomain', $domain);
        $this->db->order_by('count', 'DESC');
        $this->db->group_by('actual_page');
        $this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function check_commentexits($table,$field,$id,$field2,$id2, $select=''){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function check_commentexits_update($table,$field,$id,$field2,$id2,$field3,$id3, $select=''){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        $this->db->where($field3.' != ', $id3);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function showFullname(
        $table1,$table2,
        $field1="",$id1="",
        $field2="",$id2="",
        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field2, $id2);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function showEmail(
        $table1,$table2,
        $field1="",$id1="",
        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    public function get_specific_inactive_users_v2(){
//        $query = $this->db->query("SELECT * from for_inactiveaccounts limit 1000");
//        $query = $this->db->query("SELECT * from inactive_verified_accounts_forminibonus");
        $query = $this->db->query("SELECT * from inactive_verified_accounts_forminibonus_v2 ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public  function showAccountNumberbyEmail($table1,$table2,$field="",$id="",$select="",$join12,$order,$group=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function get_specific_inactive_users_v3(){
//        $query = $this->db->query("SELECT * from for_inactiveaccounts limit 1000");
//        $query = $this->db->query("SELECT * from inactive_verified_accounts_forminibonus");
        $query = $this->db->query("SELECT * from inactive_verified_accounts_forminibonus_v3");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function allrestoredaccounts(){
//        $query = $this->db->query("SELECT * from for_inactiveaccounts limit 1000");
//        $query = $this->db->query("SELECT * from inactive_verified_accounts_forminibonus");
        $query = $this->db->query("SELECT * from all_restored_accounts ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function allrestoredaccounts_v2(){
        $query = $this->db->query("SELECT * from all_restored_accounts_v2 ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function allrestored_standardaccounts(){
        $query = $this->db->query("SELECT * from allrestored_standard_unique_fullname ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function all_inactive_accounts(){
        $query = $this->db->query("SELECT * from all_inactive_accounts ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function restore_all_emailedusers(){
        $query = $this->db->query("SELECT * from all_inactive_recieved_email ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function unmailed_inactive_accounts(){
        $query = $this->db->query("SELECT * from unmailed_inactive_accounts ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function non_usd_creditedbonus(){
        $query = $this->db->query("SELECT * from non_usd_credited_mini_bonus");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function showEmail_v2(
        $table1,$table2,$table3,
        $field1="",$id1="",
        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",
        $join13="",
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join13);
        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function showFullname_v2(
        $table1,$table2,$table3,
        $field1="",$id1="",
        $field2="",$id2="",
        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",$join13,
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join13);
        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field2, $id2);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

//    public function all_live_users(){
//        //FXPP-3989 stable use
//        $query = $this->db->query("SELECT * from all_live_accounts");
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return false;
//    }
    public function all_live_users_validations(){
        //FXPP-3989 stable use
        $query = $this->db->query("SELECT * from all_live_accounts_validations");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function all_live_users_restoration(){
        //FXPP-3989 stable use
        $query = $this->db->query("SELECT * from all_live_accounts_restoration");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
//    public function all_live_users_crediting10usdbonus(){
//        //FXPP-3989 stable use
//        $query = $this->db->query("SELECT * from all_live_accounts_crediting10usdbonus");
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return false;
//    }
//    public function all_account_credited_minibonus(){
//        //FXPP-3989 stable use
//        $query = $this->db->query("SELECT * from all_account_credited_minibonus ");
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return false;
//    }
    function show($table="",$select=""){
        $this->db->select($select);
        $this->db->from($table);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    function update($table,$data){
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function all_minibonusmark(){
        //FXPP-3989 stable use
        $query = $this->db->query("SELECT user_id,account_number,amount,mt_currency_base from mt_accounts_set where mini_bonus_credit=1 ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function checkaccountsbyAC($accountnumber){
        $query = $this->db->query("select email,nodepositbonus,full_name from mt_accounts_set join users on users.id=mt_accounts_set.user_id join user_profiles on user_profiles.user_id=mt_accounts_set.user_id  where account_number=$accountnumber");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function checkaccountsbyemail($email){
        $query = $this->db->query("select mt_accounts_set.user_id,mt_accounts_set.account_number,nodepositbonus from mt_accounts_set join users on users.id=mt_accounts_set.user_id where email='$email'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function checkaccountsbyfullname($full_name){
        $query = $this->db->query("select email,nodepositbonus,full_name,street,state,country,account_number  from user_profiles  join users on users.id=user_profiles.user_id join mt_accounts_set on   mt_accounts_set.user_id=user_profiles.user_id  where full_name='$full_name'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function FXPP_4280(){
        //FXPP-3989 stable use
        $query = $this->db->query("SELECT * from FXPP4280");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
//    public function FXPP_4516(){
//        //FXPP-3989 stable use
//        $query = $this->db->query("SELECT * from FXPP4516");
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return false;
//    }
//
//    public function FXPP_4516_2(){
//        //FXPP-3989 stable use
//        $query = $this->db->query("SELECT * from FXPP4516_2");
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return false;
//    }
    public function get_PL(){

        $query = $this->db->query("SELECT * from PL_liveaccounts");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
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
}
