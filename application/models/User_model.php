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

    public function updateUserProfileInfoById( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('user_profiles', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function getDocumentsCountByDateRange( $start_date, $end_date, $type = 1 ){
        $this->db->distinct();
        $this->db->select("mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload, users.accountstatus", false);
        $this->db->from('user_documents');
        $this->db->join('mt_accounts_set', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users', 'users.id = user_documents.user_id', 'inner');
        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
//        return $this->db->count_all_results();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getPendingDocumentsCountByEndDate( $prev_date, $start_date, $end_date, $type = 1 ){

        $where = "((user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND users.accountstatus = 0)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 2)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 1))";
        $this->db->distinct();
        $this->db->select("mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload, users.accountstatus", false);
        $this->db->from('user_documents');
        $this->db->join('mt_accounts_set', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users', 'users.id = user_documents.user_id', 'inner');
        $this->db->where($where, null, false);
//        $this->db->where('user_documents.date_uploaded <', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
//        $this->db->where('users.accountstatus', 0);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getDocumentsCountByDateRangeCountry( $start_date, $end_date, $type = 1, $country = '' ){
        $this->db->distinct();
        $this->db->select("mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('user_documents');
        $this->db->join('mt_accounts_set', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_documents.user_id = user_profiles.user_id', 'inner');
        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->where('user_profiles.country', $country);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getPendingDocumentsCountByEndDateCountry( $prev_date, $start_date, $end_date, $type = 1, $country = '' ){

        $where = "((user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND users.accountstatus = 0)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 2)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 1))";
        $this->db->distinct();
        $this->db->select("mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload, users.accountstatus", false);
        $this->db->from('user_documents');
        $this->db->join('mt_accounts_set', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users', 'users.id = user_documents.user_id', 'inner');
        $this->db->join('user_profiles', 'user_documents.user_id = user_profiles.user_id', 'inner');
        $this->db->where($where, null, false);
//        $this->db->where('user_documents.date_uploaded <', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->where('user_profiles.country', $country);
//        $this->db->where('users.accountstatus', 0);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getDocumentsCount( $type = 1 ){
        $this->db->distinct();
        $this->db->select("mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('user_documents');
        $this->db->join('mt_accounts_set', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getTopCountryDocumentsByDateRange( $start_date, $end_date, $type = 1, $limit = 0 ){

        $sql = "SELECT main.country, SUM(main.upload_count) AS upload_count FROM
                (SELECT user_profiles.country, COUNT(user_documents.id) AS upload_count
                FROM user_documents
                INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                INNER JOIN user_profiles ON user_documents.user_id = user_profiles.user_id
                WHERE user_documents.date_uploaded >= ? AND user_documents.date_uploaded <= ?
                AND CHAR_LENGTH(mt_accounts_set.account_number) > 4
                AND mt_accounts_set.mt_type = ?
                GROUP BY user_profiles.country
                UNION ALL
                SELECT user_profiles.country, COUNT(user_documents.id) AS upload_count
                FROM user_documents
                INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                INNER JOIN user_profiles ON user_documents.user_id = user_profiles.user_id
                WHERE user_documents.date_uploaded >= ? AND user_documents.date_uploaded <= ?
                AND CHAR_LENGTH(partnership.reference_num) > 4
                GROUP BY user_profiles.country) main
                GROUP BY main.country
                ORDER BY SUM(main.upload_count) DESC
                LIMIT ?";

//        $this->db->select('user_profiles.country, COUNT(user_documents.id) as upload_count');
//        $this->db->from('user_documents');
//        $this->db->join('mt_accounts_set', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
//        $this->db->join('user_profiles', 'user_documents.user_id = user_profiles.user_id', 'inner');
//        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
//        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
//        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
//        $this->db->where('mt_accounts_set.mt_type', $type);
//        $this->db->group_by('user_profiles.country');
//        $this->db->order_by('COUNT(user_documents.id) DESC', false);
//        $this->db->limit($limit);
//        $query = $this->db->get();
        $query = $this->db->query( $sql, array($start_date, $end_date, $type, $start_date, $end_date, (int) $limit) );
        if($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getPartnersDocumentsCountByDateRange( $start_date, $end_date ){
        $this->db->distinct();
        $this->db->select("partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload, users.accountstatus", false);
        $this->db->from('user_documents');
        $this->db->join('partnership', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->join('users', 'users.id = user_documents.user_id', 'inner');
        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getPartnersPendingDocumentsCountByEndDate( $prev_date, $start_date, $end_date ){

        $where = "((user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND users.accountstatus = 0)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 2)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 1))";
        $this->db->distinct();
        $this->db->select("partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload, users.accountstatus", false);
        $this->db->from('user_documents');
        $this->db->join('partnership', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->join('users', 'users.id = user_documents.user_id', 'inner');
        $this->db->where($where, null, false);
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getPartnersDocumentsCountByDateRangeCountry( $start_date, $end_date, $country = '' ){
        $this->db->distinct();
        $this->db->select("partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('user_documents');
        $this->db->join('partnership', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->join('user_profiles', 'user_documents.user_id = user_profiles.user_id', 'inner');
        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('user_profiles.country', $country);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getPartnersPendingDocumentsCountByEndDateCountry( $prev_date, $start_date, $end_date, $country = '' ){

        $where = "((user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND users.accountstatus = 0)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 2)
                    OR (user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($prev_date)) . "'
                    AND (users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "')
                    AND users.accountstatus = 1))";
        $this->db->distinct();
        $this->db->select("partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload, users.accountstatus", false);
        $this->db->from('user_documents');
        $this->db->join('partnership', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->join('users', 'users.id = user_documents.user_id', 'inner');
        $this->db->join('user_profiles', 'user_documents.user_id = user_profiles.user_id', 'inner');
        $this->db->where($where, null, false);
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('user_profiles.country', $country);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getPartnersDocumentsCount(){
        $this->db->distinct();
        $this->db->select("partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('user_documents');
        $this->db->join('partnership', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
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
        $this->db->where('users.accountstatus', 1);
        $this->db->where('users.verified is not null', null);
        $this->db->order_by('users.verified');
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function isUserTest( $user_id ){
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $where = '(test = 1 or test_1 = 0)';
        $this->db->where($where);
        $result = $this->db->get();
        if( $result->num_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function isUserTestByAccountNumber( $account_number ){
        $this->db->from('users');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id', 'inner');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $where = '(users.test = 1 or users.test_1 = 0)';
        $this->db->where($where);
        $result = $this->db->get();
        if( $result->num_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function isUserMicroByAccountNumber( $account_number ){
        $this->db->from('users');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id', 'inner');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $this->db->where('users.micro = 1');
        $result = $this->db->get();
        if( $result->num_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function getMT4DownloadCountByDate( $date_from, $date_to ){
        $this->db->from('mt4_downloads');
        $this->db->where('mt4_downloads.date >=', date('Y-m-d H:I:s', strtotime($date_from)));
        $this->db->where('mt4_downloads.date <=', date('Y-m-d H:I:s', strtotime($date_to)));
        return $this->db->count_all_results();
    }

    public function getUserReferralAffiliateCode( $user_id ){
        $this->db->from('users_affiliate_code');
        $this->db->where('users_id', $user_id);
        $this->db->order_by('date_created', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $row_result = $result->row_array();
            return $row_result['referral_affiliate_code'];
        }else{
            return '';
        }
    }

    public function getUserTradingExperience( $user_id ){
        $this->db->from('trading_experience');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function getUserContact( $user_id ){
        $this->db->from('contacts');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->row_array();
        }else{
            return false;
        }
    }
}