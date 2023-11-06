<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct(){
        parent::__construct();
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

    function change_password($user_id, $new_pass)
    {
		$this->db->where('id', $user_id);
		$this->db->update('users', array('password' => $new_pass));
    }

    function updateUserProfileById( $user_id, $data ){
        $query1 = false;
        $query2 = false;

        $user_profiles_data = array(
            'full_name' => $data['full_name'],
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'country' => $data['country']
        );

        if( array_key_exists('image', $data) ){
            $user_profiles_data['image'] = $data['image'];
        }

        $user_contacts_data = array(
            'phone1' => $data['phone1'],
            'phone2' => $data['phone2'],
            'email1' => $data['email1'],
            'email2' => $data['email2'],
            'email3' => $data['email3']
        );

        $user_email = array(
            'email' => $data['email1']
        );

        //update user_profiles
        $this->db->where('user_id', $user_id);
        if($this->db->update('user_profiles', $user_profiles_data)){
            $query1 = true;
        }

        $this->db->where('id', $user_id);
        if($this->db->update('users', $user_email)){
            $query2 = false;
        }

        //update user_contacts
//        $this->db->where('user_id', $user_id);
//        if($this->db->update('contacts', $user_contacts_data)){
//            $query2 = false;
//        }

        return ($query1 || $query2);
    }

    public function checkAffiliateCode($affiliate_code){
        $this->db->select('*');
        $this->db->from('partnership_affiliate_code');
        $this->db->where('affiliate_code', $affiliate_code);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function checkExistingEmail($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function validateToken($token){
        $this->db->select('*');
        $this->db->from('user_forgot_password');
        $this->db->where('Hash', $token);
        $data = $this->db->get();

        return ($data->num_rows() > 0) ? false : true;
    }

    public function getForgotPasswordDetails($token){
        $this->db->select('*');
        $this->db->from('user_forgot_password');
        $this->db->where('Hash', $token);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    public function checkExistingAccountNumber($acc_num){
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->where('account_number', $acc_num);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

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

    public function updateUserById( $user_id, $data ){
        $this->db->where('id', $user_id);
        if($this->db->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function updateUserById0( $user_id, $data ,$table,$fld){
        $this->db->where($fld, $user_id);
        if($this->db->update($table, $data)){
            return true;
        }else{
            return false;
        }
    }
    public function updateUserById1( $user_id, $data,$profile,$phone ){
        $this->db->where('id', $user_id);
        if($this->db->update('users', $data)){
            $q = $this->db->select('*')
                ->from('user_profiles')
                ->where('user_id',$user_id);
            $existing= $q->get()->result();
            if(count($existing)>0){
                $update = $this->updateUserById0($user_id,$profile,'user_profiles','user_id');
                $arr = array('phone1'=>$phone);
                $this->updateUserById0($user_id,$arr,'contacts','user_id');
                if($update){
                    $ret['success'] = true;
                    $ret['msg'] = 'Success';
                }else{
                    $ret['success'] = false;
                    $ret['msg'] = 'Fail to update profile.';
                }
            }else{
                $ins = $this->create_profile('user_profiles',$profile);
                if(count($ins)>0){
                    $ret['success'] = true;
                    $ret['msg'] = 'Insert success.';
                }else{
                    $ret['success'] = true;
                    $ret['msg'] = 'Failed to create.';
                }
            }
        }else{
            $ret['success'] = false;
            $ret['msg'] = 'Fail to update users.';
        }
        return $ret;
    }

    function create_profile($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    public function updateUserProfileInfoById( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('user_profiles', $data)){
            return true;
        }else{
            return false;
        }
    }

        public function getFirstUserDetailsByEmail( $email ){
        $this->db->select('user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip, user_profiles.dob, contacts.phone1, users.affiliate_code,
                           trading_experience.experience, trading_experience.investment_knowledge, trading_experience.trade_duration, trading_experience.risk,
                           employment_details.politically_exposed_person, employment_details.employment_status, employment_details.employment_status, employment_details.industry,
                           employment_details.estimated_annual_income, employment_details.estimated_net_worth, employment_details.education_level, employment_details.us_resident,
                           employment_details.us_citizen, mt_accounts_set.mt_account_set_id, mt_accounts_set.mt_currency_base, mt_accounts_set.leverage, mt_accounts_set.swap_free');
        $this->db->from('users');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->join('contacts', 'contacts.user_id = users.id');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id');
        $this->db->join('trading_experience', 'trading_experience.user_id = users.id', 'left');
        $this->db->join('employment_details', 'employment_details.user_id = users.id', 'left');
        $this->db->where('LOWER(users.email)', strtolower($email));
        $this->db->order_by('users.created');
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->row_array();
        }else{
            return false;
        }
    }
}