<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quick_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function get($tbl,$fld,$id,$sel){
        $this->db->select($sel)
            ->from($tbl)
            ->where($fld,$id);
        $data = $this->db->get();
        return $data->row_array();
    }
    function getAccountsByIdType($id, $type)
    {
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
    function getAccountsByIdType1($id)
    {
        $this->db->select('mt_accounts_set.*,
                           users.accountstatus,users.email, users.type, users.affiliate_code, users.nodepositbonus,
                            user_profiles.image,user_profiles.full_name, user_profiles.country, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.zip, user_profiles.dob, user_profiles.fb,
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
        $this->db->where('account_number', $id);
        $data = $this->db->get();

        return $data->row_array();
    }
    public function updateUserById( $user_id, $data ){
        $this->db->where('id', $user_id);
        if($this->db->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }
    function updateContactByUserId( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('contacts', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function updateUserProfileInfoById( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('user_profiles', $data)){
            return true;
        }else{
            return false;
        }
    }
    function updateAccountByUserId( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('mt_accounts_set', $data)){
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
    function getAccountType($id=null){
        $data= array(
            '1' =>"ForexMart Standard",
            '2' => "ForexMart Zero Spread"
        );
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }
    function getInvestmentKnowledge($id=null){
        $data= array( "Non-exiting","Limited","Fair","Excellent");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEducationLevel($id=null){
        $data= array( "Elementary","High School","College/University","Masters/PHD","Professional Qualification");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getTradeDuration($id=null){
        $data= array( "Daily","Weekly","Monthly");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }
    function getEmploymentStatus($id=null){
        $data= array( "Employed","Self-employed","Retired","Student","Unemployed");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getIndustry($id=null){
        $data= array( "Accountancy","Admin/Secretarial","Agriculture","Finance Services - Banking","Catering/Hospitality","Creative/Media","Education","Emergency Services","Engineering","Financial Services - Others","Health/Medicine","HM Forces",
            "HR","Financial Services - Insurance","IT","Legal","Leisure/Entertainment/Tourism","Manufacturing","Marketing/PR/Advertising","Pharmaceuticals",
            "Property/Constructions/Trades","Retail","Sales","Social Care/Services","Telecommunications","Transport/Logistics","Others");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEstimatedAnnualIncome($id=null){
        $data= array( ">100,000","50,000 - 100,000","10,000 - 50,000","<10,000");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEstimatedNetWorth($id=null){
        $data= array( ">100,000","50,000 - 100,000","10,000 - 50,000","<10,000");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    public function getCompanyInfo($acc_id){
        $this->db->select('business_account_info.*');
        $this->db->join('mt_accounts_set','mt_accounts_set.user_id=business_account_info.user_id','inner');
        $result= $this->db->get_where('business_account_info',array('mt_accounts_set.account_number'=>$acc_id));
        return $result->row();
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
    public function insertLeverageUpdateHistory($data){
        if($this->db->insert('leverage_update_history', $data)){
            return true;
        }else{
            return false;
        }
    }
    function getAccouTypeStatus($select,$table,$where){
        $query=$this->db->select($select)
            ->get_where($table,$where);
        if($query->num_rows()>0){
            return $query->row();
        } else{
            return false;
        }
    }
    function updateUserDetails($table,$field,$id,$data){
        $this->db->where($field, $id);
        $this->db->update($table, $data);
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
//    public function validateForgotDetails($email, $acc_num){
//        $this->db->select('*');
//        $this->db->from('mt_accounts_set');
//        $this->db->join('users', 'mt_accounts_set.user_Id = users.id');
//        $this->db->where('users.email', $email);
//        $this->db->where('mt_accounts_set.account_number', $acc_num);
//        $query = $this->db->get();
//        if($query->num_rows() > 0) {
//            return true;
//        }else{
//            return false;
//        }
//    }
    public function getUserIdbyAccountNumber($acc_num){
        $this->db->select('user_id');
        $this->db->from('mt_accounts_set');
        $this->db->where('account_number', $acc_num);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
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
    function sendBCCEmail($file_name, $subject, $email, $data,$configemail=null)
    {
        $this->config->load('tank_auth');
        $this->load->library('email');
        if($configemail != null){
            $this->email->initialize($configemail);
        }
        $this->SMTPDebug =1;
        $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->to($email);
//        $this->email->bcc('support@forexmart.com');
        $this->email->subject($subject);
        $this->email->message($this->load->view('email/'.$file_name, $data, TRUE));
        if($this->email->send()){
            return true;
        }else{
            return false;
        }

    }
    function getAccountUpdateHistoryByUserId1( $user_id ){
        $this->db->select('account_update_history.*, user_profile.full_name as user_name, manager_profile.full_name as manager_name,account_field_update_history.field,account_field_update_history.old_value,account_field_update_history.new_value');
        $this->db->from('account_update_history');
        $this->db->join('account_field_update_history', 'account_field_update_history.update_id = account_update_history.id', 'inner');
        $this->db->join('user_profiles as user_profile', 'account_update_history.user_id = user_profile.user_id', 'left');
        $this->db->join('user_profiles as manager_profile', 'account_update_history.manager_id = manager_profile.user_id', 'left');
        $this->db->where('account_update_history.user_id', $user_id);
        $this->db->order_by('account_field_update_history.id','Desc');
        $result = $this->db->get();
        return $result->result_array();
    }
//    function getAccountFieldUpdateHistoryById( $id ){
//        $this->db->select('account_field_update_history.*, user_profiles.full_name as manager_name');
//        $this->db->from('account_field_update_history');
//        $this->db->join('account_update_history', 'account_field_update_history.update_id = account_update_history.id', 'left');
//        $this->db->join('user_profiles', 'account_update_history.manager_id = user_profiles.user_id', 'left');
//        $this->db->where('account_field_update_history.update_id', $id);
//        $result = $this->db->get();
//        return $result->result_array();
//    }
    function getAccountUpdateHistoryByUserId( $user_id ){
        $this->db->select('account_update_history.*, user_profile.full_name as user_name, manager_profile.full_name as manager_name');
        $this->db->from('account_update_history');
        $this->db->join('user_profiles as user_profile', 'account_update_history.user_id = user_profile.user_id', 'left');
        $this->db->join('user_profiles as manager_profile', 'account_update_history.manager_id = manager_profile.user_id', 'left');
        $this->db->where('account_update_history.user_id', $user_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    function getAccountFieldUpdateHistoryById( $id ){
        $this->db->select('account_field_update_history.*, user_profiles.full_name as manager_name');
        $this->db->from('account_field_update_history');
        $this->db->join('account_update_history', 'account_field_update_history.update_id = account_update_history.id', 'left');
        $this->db->join('user_profiles', 'account_update_history.manager_id = user_profiles.user_id', 'left');
        $this->db->where('account_field_update_history.update_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function validateForgotDetails($email, $acc_num){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'mt_accounts_set.user_Id = users.id');
        $this->db->where('users.email', $email);
        $this->db->where('mt_accounts_set.account_number', $acc_num);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function isValid($acc_num){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->where('mt_accounts_set.account_number', $acc_num);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    function countAllVerified(){
        $this->db->select('*');
        $this->db->from('users a');
        $this->db->join('mt_accounts_set b','a.id=b.user_id','left');
        $this->db->join('partnership c','a.id=c.partner_id','left');
        $this->db->where('a.accountstatus', 1);
        $this->db->where("CHARACTER_LENGTH(b.account_number) > 5 OR CHARACTER_LENGTH(c.reference_num)>5");
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function getLimitVerified($limit,$offset){
        $this->db->select('a.id,a.login_type,a.accountstatus,a.email,b.account_number as account_number,c.reference_num as account_number,d.full_name');
        $this->db->from('users a');
        $this->db->join('mt_accounts_set b','a.id=b.user_id','left');
        $this->db->join('partnership c','a.id=c.partner_id','left');
        $this->db->join('user_profiles d','a.id=d.user_id','left');
        $this->db->where('a.accountstatus', 1);
        $this->db->where("CHARACTER_LENGTH(b.account_number) > 5 OR CHARACTER_LENGTH(c.reference_num)>5");
        $this->db->ORDER_BY('a.id','DESC');
        $this->db->limit($limit,$offset);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function getAllV(){
        $this->db->select('users.accountstatus,users.id,mt_accounts_set.account_number');
        $this->db->from('users');
        $this->db->where('accountstatus',1);
        $this->db->where("CHARACTER_LENGTH(".'account_number) >', 5);
        $this->db->limit(10,0);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    function getPendingSearchCount($search){
        $search = "(
                    full_name LIKE '%$search%'
                OR account_number LIKE '%$search%'
                OR email LIKE '%$search%' )";
        $query = $this->db->query("SELECT * FROM (
       SELECT DISTINCT u.*,p.full_name,p.street,p.city,p.state,p.country,p.zip,a.account_number as account_number,c.country as country1
      FROM users u
      LEFT JOIN  user_profiles as  p on u.id = p.user_id
      LEFT JOIN  countries as  c on c.country_id=p.country
      INNER JOIN  mt_accounts_set as  a on u.id = a.user_id
      WHERE u.accountstatus=1 and CHARACTER_LENGTH(a.account_number) > 5
      UNION ALL
       SELECT DISTINCT u.*,p.full_name,p.street,p.city,p.state,p.country,p.zip,part.reference_num as account_number,c.country as country1
      FROM users u
      LEFT JOIN  user_profiles as  p on u.id = p.user_id
      LEFT JOIN  countries as  c on c.country_id=p.country
      JOIN  partnership as  part on u.id = part.partner_id
      WHERE u.accountstatus=1 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5 
      ) as resutl_table WHERE  ".$search."
      ORDER BY id DESC
      ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function getPendingSearch($limit, $offset, $search){
        $search = "(
                    full_name LIKE '%$search%'
                OR account_number LIKE '%$search%'
                OR email LIKE '%$search%' )";
        $query = $this->db->query("SELECT * FROM (
      SELECT DISTINCT u.*,p.full_name,p.street,p.city,p.state,p.country,p.zip,a.account_number as account_number,c.country as country1
      FROM users u
      LEFT JOIN  user_profiles as  p on u.id = p.user_id
      LEFT JOIN  countries as  c on c.country_id=p.country
      INNER JOIN  mt_accounts_set as  a on u.id = a.user_id
      WHERE u.accountstatus=1 and CHARACTER_LENGTH(a.account_number) > 5
      UNION ALL
      SELECT DISTINCT u.*,p.full_name,p.street,p.city,p.state,p.country,p.zip,part.reference_num as account_number,c.country as country1
      FROM users u
      LEFT JOIN  user_profiles as  p on u.id = p.user_id
      LEFT JOIN  countries as  c on c.country_id=p.country
      JOIN  partnership as  part on u.id = part.partner_id
      WHERE u.accountstatus=1 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5 
      ) as resutl_table WHERE  " . $search . "
      ORDER BY id DESC
       LIMIT " . $offset . " , " . $limit . "  ");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function getPendingCount(){
        $query = $this->db->query("
            SELECT DISTINCT u.*,
            case when a.account_number is not null then a.account_number 
            when part.reference_num is not null then part.reference_num else null end as account_number,
            case when a.account_number is not null then a.corporate_acc_status 
            when part.reference_num is not null then 0 else null end as corporate_acc_status,
            u.recent_fileupload,
            u.login_type
            FROM users u
            LEFT JOIN  mt_accounts_set as  a on u.id = a.user_id
            LEFT JOIN partnership as part on u.id = part.partner_id
            WHERE u.accountstatus=1
            and ( part.reference_num is not null or a.account_number is not null ) 
            and case when part.reference_num is not null then (part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5 )
            when a.account_number is not null then (CHARACTER_LENGTH(a.account_number) > 5)
            else false end
            ORDER BY u.id DESC
            ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function getPending($limit, $offset){
        $query = $this->db->query("
            SELECT DISTINCT u.*,
            case when a.account_number is not null then a.account_number 
            when part.reference_num is not null then part.reference_num else null end as account_number,
            case when a.account_number is not null then a.corporate_acc_status 
            when part.reference_num is not null then 0 else null end as corporate_acc_status,
            u.recent_fileupload,
            u.login_type
            FROM users u
            LEFT JOIN  mt_accounts_set as  a on u.id = a.user_id
            LEFT JOIN partnership as part on u.id = part.partner_id
            WHERE u.accountstatus=1 
            and ( part.reference_num is not null or a.account_number is not null ) 
            and case when part.reference_num is not null then (part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5 )
            when a.account_number is not null then (CHARACTER_LENGTH(a.account_number) > 5 )
            else false end
            ORDER BY u.id DESC
            LIMIT $offset , $limit;
            ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function getSearch( $search){
        $search = "(   email LIKE '%$search%'
                OR account_number LIKE '%$search%')";
        $query = $this->db->query("SELECT * FROM (
      SELECT DISTINCT u.*,a.account_number as account_number, up.full_name
      FROM users u 
      INNER JOIN  user_profiles up on u.id = up.user_id
      INNER JOIN  mt_accounts_set a on u.id = a.user_id
      WHERE CHARACTER_LENGTH(a.account_number) > 5
      UNION ALL
      SELECT DISTINCT u.*,part.reference_num as account_number,up.full_name
      FROM users u 
      INNER JOIN  user_profiles up on u.id = up.user_id
      JOIN  partnership part on u.id = part.partner_id
      WHERE part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5 
      ) as resutl_table WHERE  " . $search . "
      ORDER BY id DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    public function getWithdrawPendingAll($account){
        $this->db->start_cache();
            $this->db->select('*,withdraw.id');
            $this->db->from('withdraw');
            $this->db->join('user_profiles', 'user_profiles.user_id = withdraw.user_id', 'inner');
            $this->db->where('status', 0);
            $this->db->where('account_number', $account);
            $this->db->order_by('date_withdraw', 'DESC');
            $query = $this->db->get();
        $queryResult = $query->result_array();
        $this->db->flush_cache();
        return $queryResult;
    }
}