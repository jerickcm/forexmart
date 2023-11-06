<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partnership_model extends CI_Model
{
    private $table = 'partnership';
    function __construct()
    {
        parent::__construct();
    }

    public function getAccountByUserId( $user_id ){
        $this->db->from($this->table);
        $this->db->where('partner_id', $user_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function getAccountByAccountNumber( $account_number = '' ){
        $this->db->from($this->table);
        $this->db->where('reference_num', $account_number);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }else{
            return false;
        }
    }

    function updateAccountByPartnerId( $user_id, $data ){
        $this->db->where('partner_id', $user_id);
        if($this->db->update('partnership', $data)){
            return true;
        }else{
            return false;
        }
    }

    function getAccountsCountByDateRange($start_date, $end_date)
    {
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('partnership.dateregistered >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('partnership.dateregistered <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(reference_num) > 4', null, false);
        return $this->db->count_all_results();
    }

    function getAccountsCountByDateRangeCountry($start_date, $end_date, $country = '')
    {
        $this->db->from('partnership');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id', 'inner');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('partnership.dateregistered >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('partnership.dateregistered <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(reference_num) > 4', null, false);
        $this->db->where('user_profiles.country', $country);
        return $this->db->count_all_results();
    }

    function getAccountsCount()
    {
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('CHAR_LENGTH(reference_num) > 4', null, false);
        $query = $this->db->get();
        return $query->num_rows();
        //return $this->db->count_all_results();
    }

    function getAccountsVerifiedCountByDateRange($start_date, $end_date)
    {
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where('users.verified >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('users.verified <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('users.accountstatus', 1);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsVerifiedCountByDateRangeCountry($start_date, $end_date, $country = '')
    {
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where('users.verified >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('users.verified <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('user_profiles.country', $country);
        $this->db->where('users.accountstatus', 1);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsVerifiedCount()
    {
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('users.accountstatus', 1);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsPendingCountByDateRange($start_date, $end_date)
    {
        $where = "((user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND users.accountstatus = 0)
                    OR (user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    AND users.accountstatus = 0))";
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where($where, null, false);
//        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
//        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
//        $this->db->where('users.accountstatus', 0);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsPendingCount()
    {
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('users.accountstatus', 0);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsDeclinedCountByDateRange($start_date, $end_date)
    {
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where('user_documents.date_declined >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_declined <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('users.accountstatus', 2);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsDeclinedCountByDateRangeCountry($start_date, $end_date, $country = '')
    {
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id', 'inner');
        $this->db->where('user_documents.date_declined >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_declined <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('user_profiles.country', $country);
        $this->db->where('users.accountstatus', 2);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsDeclinedCount()
    {
        $this->db->distinct();
        $this->db->select("partnership.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = partnership.partner_id', 'inner');
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->where('users.accountstatus', 2);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    public function getAccountDetailsByAccountNumber( $account_number ){
        $this->db->select('partnership.reference_num, user_profiles.city, user_profiles.country, user_profiles.full_name, contacts.phone1, user_profiles.street, user_profiles.state, user_profiles.zip, users.email');
        $this->db->from('partnership');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id', 'inner');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('contacts', 'contacts.user_id = partnership.partner_id', 'left');
        $this->db->where('partnership.reference_num', $account_number);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function getVerificationDocumentsCountByDate( $start_date, $end_date, $is_old = false ){

        if($is_old){
            $where = "WHERE verification.date_upload < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }else{
            $where = "WHERE verification.date_upload >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }

        $sql = "SELECT * FROM
                (SELECT DISTINCT partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.test = 0
                    AND (
                        (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 2
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 1
                        )
                        OR (
                            user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                  )
                ) verification $where";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getAllVerificationDocumentsCountByDate( $start_date, $end_date, $is_old = false ){

        if($is_old){
            $where = "WHERE verification.date_upload < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }else{
            $where = "WHERE verification.date_upload >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }

        $sql = "SELECT DISTINCT verification.reference_num, verification.user_id, verification.accountstatus, verification.account_status FROM
                (SELECT DISTINCT partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.test = 0
                    AND (
                        (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 2
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 1
                        )
                        OR (
                            user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                  )
                ) verification $where";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getVerificationDocumentsCountByStatus( $start_date, $end_date, $status = 0){

        $where = "WHERE verification.account_status = $status";

        $sql = "SELECT * FROM
                (SELECT DISTINCT partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.test = 0
                    AND (
                        (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 2
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 1
                        )
                        OR (
                            user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                  )
                ) verification $where";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getAllVerificationDocumentsCountByStatus( $start_date, $end_date, $status = 0){

        $where = "WHERE verification.account_status = $status";

        $sql = "SELECT * FROM
                (SELECT DISTINCT partnership.reference_num, user_documents.user_id, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.test = 0
                    AND (
                        (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 2
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 1
                        )
                        OR (
                            user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                  )
                ) verification $where";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getVerificationDocumentsCountByCountryDate( $start_date, $end_date, $country, $is_old = false){

        if($is_old){
            $where = "WHERE verification.date_upload < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }else{
            $where = "WHERE verification.date_upload >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }

        $sql = "SELECT * FROM
                (SELECT DISTINCT partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    INNER JOIN user_profiles ON user_profiles.user_id = users.id
                    WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.test = 0 AND user_profiles.country = '" . $country . "'
                    AND (
                        (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 2
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 1
                        )
                        OR (
                            user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                  )
                ) verification $where";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getVerificationDocumentsCountByCountryStatus( $start_date, $end_date, $country, $status = 0){

        $where = "WHERE verification.account_status = $status";

        $sql = "SELECT * FROM
                (SELECT DISTINCT partnership.reference_num, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN partnership ON user_documents.user_id = partnership.partner_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    INNER JOIN user_profiles ON user_profiles.user_id = users.id
                    WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.test = 0 AND user_profiles.country = '" . $country . "'
                    AND (
                        (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 2
                        )
                        OR (
                            user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND (
                                users.verified >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                                AND users.verified <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                            AND users.accountstatus = 1
                        )
                        OR (
                            user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                            AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            AND (
                                users.accountstatus = 0
                                OR users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                                OR user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                            )
                        )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                    OR (
                        user_documents.date_declined >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_declined <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                        AND user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                        AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    )
                  )
                ) verification $where";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}