<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class quickjump_model extends CI_Model {

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
        $result= $this->db->get_where('business_account_info',array('mt_accounts_set.id'=>$acc_id));
        return $result->row();
    }
}