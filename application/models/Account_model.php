<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAccountsByUserId($user_id)
    {
        $this->db->select('mt_accounts_set.*, users.type');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getMtAccountType($user_id)
    {
        $mtAccounts = $this->getAccountsByUserId($user_id);
        foreach ($mtAccounts as $acct) {
            if ($acct['mt_type']) {
                return true;
            }
        }
        return false;
    }

    function upload_documents($data)
    {
        $this->db->insert('user_documents', $data);
        return $this->db->insert_id();
    }

    function update_upload_documents($user_id, $doc_type, $updatedata)
    {
        $passAraray = array(
            'user_id' => $user_id,
            'doc_type' => $doc_type
        );
        $this->db->where($passAraray);
        $this->db->update('user_documents', $updatedata);
    }

    function checkUserDocs($user_id, $doc_type)
    {
        $this->db->select('*');
        $this->db->from('user_documents');
        $passArray = array(
            'user_id' => $user_id,
            'doc_type' => $doc_type
        );
        $this->db->where($passArray);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateUserDetails($table, $field, $id, $data)
    {
        $this->db->where($field, $id);
        $this->db->update($table, $data);
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    //get users details
    function getUserEmailByUserId($user_id)
    {
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    //get user details for filter
    function getUserDetailsFilter($user_id, $filterField)
    {
        $this->db->distinct();
        $this->db->select($filterField);
        $this->db->from('mt_accounts_set');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function selectedDetailsFilter($user_id, $flts, $test, $test2)
    {
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->where_in('mt_type', $flts);
        $this->db->where_in('mt_currency_base', $test);
        $this->db->where_in('mt_account_set_id', $test2);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function checkIfUniqueAccountNumber($accountnum)
    {
        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->like('account_number', $accountnum, 'before');
        $queryResult = $this->db->get();

        return ($queryResult->num_rows() > 0) ? false : true;
    }

    function getAccountsByType($type)
    {
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', $type);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getLimitAccountsByType($type, $limit, $offset)
    {
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAffiliateAccounts()
    {
        $this->db->select('partnership.*, users.email, user_profiles.country, user_profiles.full_name');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getLimitAffiliateAccounts($limit, $offset)
    {
        $this->db->select('partnership.*, users.email, user_profiles.country, user_profiles.full_name');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAccountsByIdType($id, $type)
    {
        $this->db->select('mt_accounts_set.*,
                           users.email, users.type, users.affiliate_code,
                           user_profiles.full_name, user_profiles.country, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.zip, user_profiles.dob,
                           contacts.phone1,
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
        $data = $this->db->get();
        return $data->row_array();
    }

    function getAffiliateById($id)
    {
        $this->db->select('partnership.*, users.email, user_profiles.country, user_profiles.full_name');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->where('partnership.id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    function getContestAccountsByDateRange($start_date, $end_date)
    {
        $this->db->select('mt_accounts_set.*, contestmoneyfall.FullName');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
        $this->db->join('users', 'users.id = contestmoneyfall.users_id', 'inner');
        $this->db->where('contestmoneyfall.Activation', 1);
        $this->db->where('users.created >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('users.created <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->order_by('users.created');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getContestUnclosedAccountsByEndDate($end_date)
    {
        $this->db->select('mt_accounts_set.*, contestmoneyfall.FullName');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
        $this->db->join('users', 'users.id = contestmoneyfall.users_id', 'inner');
        $this->db->where('contestmoneyfall.Activation', 1);
        $this->db->where('contestmoneyfall.is_closed', 0);
        $this->db->where('users.created <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->order_by('users.created');
        $data = $this->db->get();
        return $data->result_array();
    }

    function updateAmountByAccountNumber($account_number, $amount)
    {
        $data = array(
            'amount' => $amount
        );
        $this->db->where('account_number', $account_number);
        $this->db->update('mt_accounts_set', $data);
    }

    function updateCurrentWinners($startdate, $winners)
    {
        $this->db->trans_start();
        $this->db->delete('contest_winners', array('start_date' => $startdate));
        $this->db->insert_batch('contest_winners', $winners);
        $this->db->trans_complete();
        return true;
    }


    function getContestWinners($start_date, $end_date)
    {
        $this->db->select('mt_accounts_set.*, contestmoneyfall.NickName, user_profiles.country, users.created');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
        $this->db->join('users', 'users.id = contestmoneyfall.users_id', 'inner');
        $this->db->join('user_profiles', 'mt_accounts_set.user_id = user_profiles.user_id', 'inner');
        $this->db->where('contestmoneyfall.Activation = 1');
        $this->db->where('users.created >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('users.created <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->order_by('mt_accounts_set.amount', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
//        $result = $this->db->query("CALL getContestWinners('" . $start_date . "','" . $end_date . "')");
//        $data =  $result->result_array();
//        $result->next_result();
//        $result->free_result();
//        return $data;
    }

    function getContestWinnersArchive()
    {

        $this->db->select('contest_winners.account_number,contest_winners.nickname,contest_winners.amount,contest_winners.rank,mt_accounts_set.swap_free,mt_accounts_set.leverage,contest_winners.start_date,contest_winners.end_date,mt_accounts_set.mt_status');
        $this->db->from('contest_winners');
        $this->db->join('mt_accounts_set', 'contest_winners.account_number = mt_accounts_set.account_number');
        $this->db->where('contest_winners.show = 1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    function getAllContestWinnersByToken($token = '', $search_by = '')
    {
        $this->db->from('contest_winners');

        if ($token != '') {
            switch ($search_by) {
                case 'account_number' :
                    $search = "contest_winners.account_number LIKE '%$token%'";
                    break;
                case 'nickname' :
                    $search = "contest_winners.nickname LIKE '%$token%'";
                    break;
            }
            if (trim($search) != '') {
//                $this->db->where('contest_winners.rank <=', 10);
                $this->db->where($search, null, false);
            }
        }
        $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
        $this->db->where('contest_winners.show', 1);
        $this->db->order_by('contest_winners.rank');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getLimitAllContestWinnersByToken($limit, $offset, $token = '', $search_by = '', $order = 'contest_winners.rank', $sort = 'asc')
    {
        $this->db->select('contest_winners.*, contestmoneyfall.City');
        $this->db->from('contest_winners');
        $this->db->join('contestmoneyfall', 'contestmoneyfall.users_id = contest_winners.user_id', 'inner');
        if ($token != '') {
            switch ($search_by) {
                case 'account_number' :
                    $search = "contest_winners.account_number LIKE '%$token%'";
                    break;
                case 'nickname' :
                    $search = "contest_winners.nickname LIKE '%$token%'";
                    break;
            }
            if (trim($search) != '') {
//                $this->db->where('contest_winners.rank <=', 10);
                $this->db->where($search, null, false);
            }
        }
        $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
        $this->db->where('contest_winners.show', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by($order, $sort);
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAllContestWinnersByDates($datefrom = '', $dateto = '')
    {
        $this->db->from('contest_winners');
        if (strtotime($datefrom) && strtotime($dateto)) {
            $this->db->where('contest_winners.start_date >=', date('Y-m-d 00:00:00', strtotime($datefrom)));
            $this->db->where('contest_winners.end_date <=', date('Y-m-d 01:00:00', strtotime($dateto)));
            $this->db->where('contest_winners.end_date <=', date('Y-m-d 01:00:00', strtotime('last friday', strtotime('yesterday'))));
//            $this->db->where('contest_winners.rank <=', 10);
        } else {
            $this->db->where('contest_winners.end_date <=', date('Y-m-d 01:00:00', strtotime('last friday', strtotime('yesterday'))));
//            $this->db->where('contest_winners.rank <=', 10);
        }
        $this->db->where('contest_winners.show', 1);
        $this->db->order_by('contest_winners.rank');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getLimitAllContestWinnersByDates($limit, $offset, $datefrom = '', $dateto = '', $order = 'contest_winners.rank', $sort = 'asc')
    {
        $this->db->select('contest_winners.*, contestmoneyfall.City');
        $this->db->from('contest_winners');
        $this->db->join('contestmoneyfall', 'contestmoneyfall.users_id = contest_winners.user_id', 'inner');
        if (strtotime($datefrom) && strtotime($dateto)) {
            $this->db->where('contest_winners.start_date >=', date('Y-m-d 00:00:00', strtotime($datefrom)));
            $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime($dateto)));
            $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
//            $this->db->where('contest_winners.rank <=', 10);
        } else {
            $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
//            $this->db->where('contest_winners.rank <=', 10);
        }
        $this->db->where('contest_winners.show', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by($order, $sort);
        $data = $this->db->get();
        return $data->result_array();
    }

    function getMoneyFallContestantByEmailFullName($email = '', $full_name = '')
    {
        $this->db->where('Email', $email);
        $this->db->where('FullName', $full_name);
        $this->db->from('contestmoneyfall');
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $result = $this->db->get();
        return $result->row_array();
    }

    function getMoneyFallContestantByUserId($user_id)
    {
        $this->db->where('users_id', $user_id);
        $this->db->from('contestmoneyfall');
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $result = $this->db->get();
        return $result->row_array();
    }

    function updateAccountByUserId($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        if ($this->db->update('mt_accounts_set', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function updateAffiliateByUserId($partner_id, $data)
    {
        $this->db->where('partner_id', $partner_id);
        if ($this->db->update('partnership', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function insertAccountUpdateHistory($data)
    {
        if ($this->db->insert('account_update_history', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function insertAccountUpdateFieldHistory($data)
    {
        if ($this->db->insert_batch('account_field_update_history', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function getAccountUpdateHistoryByUserId($user_id)
    {
        $this->db->select('account_update_history.*, user_profile.full_name as user_name, manager_profile.full_name as manager_name');
        $this->db->from('account_update_history');
        $this->db->join('user_profiles as user_profile', 'account_update_history.user_id = user_profile.user_id');
        $this->db->join('user_profiles as manager_profile', 'account_update_history.manager_id = manager_profile.user_id');
        $this->db->where('account_update_history.user_id', $user_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getAccountFieldUpdateHistoryById($id)
    {
        $this->db->select('account_field_update_history.*, user_profiles.full_name as manager_name');
        $this->db->from('account_field_update_history');
        $this->db->join('account_update_history', 'account_field_update_history.update_id = account_update_history.id');
        $this->db->join('user_profiles', 'account_update_history.manager_id = user_profiles.user_id');
        $this->db->where('account_field_update_history.update_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getAllAccounts()
    {
        $this->db->select('mt_accounts_set.*, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $result = $this->db->get();
        return $result->result_array();
    }

    function updateAffiliateAccountById($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('partnership', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function getRegisteredNoAccounts($as_of_date)
    {
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

    function getEmailNoAccounts($from_account = 0, $to_account = 0)
    {
        $this->db->select('mt_accounts_set.*, user_profiles.full_name, users.email');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'mt_accounts_set.user_id = user_profiles.user_id');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->where('mt_accounts_set.account_number >=', $from_account);
        $this->db->where('mt_accounts_set.account_number <=', $to_account);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getEmailNoAccountsByAccounts($accounts)
    {
        $this->db->select('mt_accounts_set.*, user_profiles.full_name, users.email');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'mt_accounts_set.user_id = user_profiles.user_id');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id');
        $this->db->where_in('mt_accounts_set.account_number', $accounts);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getAccountNumberByAffiliateCode($affiliate_code)
    {
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
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function insertTicketRaffle($userId)
    {
        $sql = 'INSERT INTO ticket_raffle (user_id)
        VALUES (?)
        ON DUPLICATE KEY UPDATE
            user_id=VALUES(user_id)';

        $this->db->query($sql, array($userId));
        return $this->db->insert_id();
    }

    public function getTicketRaffleRecord($userId)
    {

        $this->db->select('ticket_raffle.*, user_profiles.country, user_profiles.full_name, mt_accounts_set.account_number, mt_accounts_set.amount, users.email')
            ->from('ticket_raffle')
            ->join('users', 'users.id = ticket_raffle.user_id', 'left')
            ->join('user_profiles', 'user_profiles.user_id = ticket_raffle.user_id', 'left')
            ->join('mt_accounts_set', 'mt_accounts_set.user_id = ticket_raffle.user_id', 'left')
            ->where('ticket_raffle.user_id', $userId)
            ->order_by('ticket_raffle.date', 'DESC')
            ->limit(1);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->row_array() : false;
    }

    public function checkUniqueAffiliateCode($affiliateCode)
    {
        $query = 'SELECT * FROM
                    (
                      SELECT affiliate_code FROM users_affiliate_code AS uac
	                  UNION
	                  SELECT affiliate_code FROM partnership_affiliate_code AS pac
                    ) as sac WHERE affiliate_code = ?;
        ';

        $result = $this->db->query($query, array($affiliateCode));
        return ($result->num_rows() > 0) ? false : true;

    }

    public function getAccountNumberByAffiliateCodeTest($affiliate_code)
    {
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
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function getAccountsCountByDateRange($start_date, $end_date, $type = 1)
    {
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('registration_time >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('registration_time <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        return $this->db->count_all_results();
    }

    function getAccountsCountByDateRangeCountry($start_date, $end_date, $type = 1, $country = '')
    {
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('registration_time >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('registration_time <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->where('user_profiles.country', $country);
        return $this->db->count_all_results();
    }

    function getAccountsCount($type = 1)
    {
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.test', 0);
        $this->db->where('CHAR_LENGTH(account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $query = $this->db->get();
        return $query->num_rows();
        //return $this->db->count_all_results();
    }

    function getAccountsVerifiedCountByDateRange($start_date, $end_date, $type = 1)
    {
        $this->db->distinct();
        $this->db->select("mt_accounts_set.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.verified >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('users.verified <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $this->db->where('users.accountstatus', 1);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsVerifiedCountByDateRangeCountry($start_date, $end_date, $type = 1, $country = '')
    {
        $this->db->distinct();
        $this->db->select("mt_accounts_set.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('users.verified >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('users.verified <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $this->db->where('user_profiles.country', $country);
        $this->db->where('users.accountstatus', 1);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsVerifiedCount($type = 1)
    {
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $this->db->where('users.accountstatus', 1);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsPendingCountByDateRange($start_date, $end_date, $type = 1)
    {
        $where = "((user_documents.date_uploaded < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND users.accountstatus = 0)
                    OR (user_documents.date_uploaded >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'
                    AND user_documents.date_uploaded <= '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'
                    AND users.accountstatus = 0))";
        $this->db->distinct();
        $this->db->select("mt_accounts_set.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
//        $this->db->where('user_documents.date_uploaded >=', date('Y-m-d H:i:s', strtotime($start_date)));
//        $this->db->where('user_documents.date_uploaded <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where($where, null, false);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
//        $this->db->where('users.accountstatus', 0);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsPendingCount($type = 1)
    {
        $this->db->distinct();
        $this->db->select('mt_accounts_set.*, users.*');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $this->db->where('users.accountstatus', 0);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsDeclinedCountByDateRange($start_date, $end_date, $type = 1)
    {
        $this->db->distinct();
        $this->db->select("mt_accounts_set.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('user_documents.date_declined >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_declined <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $this->db->where('users.accountstatus', 2);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsDeclinedCountByDateRangeCountry($start_date, $end_date, $type = 1, $country = '')
    {
        $this->db->distinct();
        $this->db->select("mt_accounts_set.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('user_documents.date_declined >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('user_documents.date_declined <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $this->db->where('user_profiles.country', $country);
        $this->db->where('users.accountstatus', 2);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getAccountsDeclinedCount($type = 1)
    {
        $this->db->distinct();
        $this->db->select("mt_accounts_set.*, users.*, DATE_FORMAT(user_documents.date_uploaded, '%m/%d/%Y') date_upload", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_documents', 'user_documents.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->where('mt_type', $type);
        $this->db->where('users.accountstatus', 2);
        $query = $this->db->get();
        return $query->num_rows();
//        return $this->db->count_all_results();
    }

    function getReferralByCode($affiliate_code, $date_created)
    {
        $sql = "select DISTINCT ma.account_number,u.email,up.full_name,up.user_id
                from user_profiles up
                inner join  users_affiliate_code ua on ua.users_id = up.user_id
                inner join users u on u.id=up.user_id
                inner join mt_accounts_set ma on ma.user_id=up.user_id where ua.referral_affiliate_code=? and u.created>=? and u.created<=?";

        $query = $this->db->query($sql, array($affiliate_code, date('Y-m-d 00:00:00', strtotime($date_created)), date('Y-m-d 23:59:59', strtotime($date_created))));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getAccTop10ByCountry($type = 0)
    {
        $sql = "SELECT up.country, count(u.id) as num from users u inner join user_profiles up on u.id=up.user_id where u.type=?  group by country order by num desc limit 10";

        $query = $this->db->query($sql, array($type));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getRegisteredAccountsByCountry($as_of_date, $country_code)
    {
        $this->db->select('users.id, users.email, user_profiles.street, user_profiles.city, user_profiles.country, user_profiles.state, user_profiles.zip,
        user_profiles.full_name, contacts.phone1, mt_accounts_set.account_number');
        $this->db->from('users');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
        $this->db->join('contacts', 'users.id = contacts.user_id');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id', 'left');
        $this->db->where('users.type', 1);
        $this->db->where('users.login_type', 0);
        $this->db->where('users.created <=', date('Y-m-d H:i:s', strtotime($as_of_date)));
        $this->db->where('user_profiles.country', $country_code);
        $this->db->where('users.test', 0);
        $this->db->where('mt_accounts_set.account_number is not null');
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $result = $this->db->get();
        return $result->result_array();
    }


    function oneTimeReport($country_code)
    {
        $sql = "select u.id, up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country
from users u inner join user_profiles up on u.id= up.user_id inner join mt_accounts_set mt on mt.user_id=u.id left join contacts c on u.id=c.user_id
where up.country=? and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street) NOT LIKE '%test%' and LOWER(up.city) NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by u.id desc

";

        $query = $this->db->query($sql, array($country_code));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function oneTimeReport2()
    {
        $sql = "select u.id, up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country from users u inner join user_profiles up on u.id= up.user_id inner join mt_accounts_set mt on mt.user_id=u.id left join contacts c on u.id=c.user_id where DATE(u.created)= date(NOW() - INTERVAL 1 DAY) and up.country in('GR','CY') and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street) NOT LIKE '%test%' and LOWER(up.city) NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by up.country, u.id desc";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    function dailyDifferentCountryReport($country_code)
    {
        $sql = "select u.email,u.created,u.id,up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country from users u inner join user_profiles up on u.id= up.user_id inner join mt_accounts_set mt on mt.user_id=u.id left join contacts c on u.id=c.user_id where u.type=1 and DATE(u.created)= date(NOW() - INTERVAL 1 DAY) and up.country in ('$country_code') and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street)   NOT LIKE '%test%' and LOWER(up.city) NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by up.country, u.id desc ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getClientInfoByUserId($user_id)
    {
        $sql = "select u.email,u.created,u.id,up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country
from users u inner join user_profiles up on u.id= up.user_id
left join mt_accounts_set mt on mt.user_id=u.id
left join contacts c on u.id=c.user_id
where u.id =  ?
";
        $query = $this->db->query($sql, array($user_id));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function dailyDifferentCountryReportFull($country_code)
    {
        $sql = "select u.email,u.created,u.id,up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country from users u inner join user_profiles up on u.id= up.user_id inner join mt_accounts_set mt on mt.user_id=u.id left join contacts c on u.id=c.user_id where length(mt.account_number)>5 and  up.country in ('$country_code') and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street)   NOT LIKE '%test%' and LOWER(up.city) NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by up.country, u.id desc ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function dailyCISCountryReport($group_id)
    {
        $sql = "select u.email,u.created,u.id,up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country,ml.group_id
from users u inner join user_profiles up on u.id= up.user_id
inner join mt_accounts_set mt on mt.user_id=u.id
left join contacts c on u.id=c.user_id
left join cis_group_mail_list ml on ml.account_number= mt.account_number
 where ml.group_id=? and
 u.type=1 and DATE(u.created)= date(NOW() - INTERVAL 1 DAY) and up.country in ('AM','BY','KZ','KG','RU','TJ','TM','UA','UZ')
 and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street)   NOT LIKE '%test%' and LOWER(up.city)
NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by up.country, u.id desc
";
        $query = $this->db->query($sql, array($group_id));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAffiliateStatisticByCode($code)
    {
        $this->db->select('partnership.reference_num, partnership_affiliate_code.affiliate_code, count(users_affiliate_code.referral_affiliate_code) as total_count');
        $this->db->from('partnership_affiliate_code');
        $this->db->join('partnership', 'partnership.partner_id = partnership_affiliate_code.partner_id', 'left');
        $this->db->join('users_affiliate_code users_affiliate_code', 'users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code', 'left');
        $this->db->where_in('partnership_affiliate_code.affiliate_code', $code);
        $this->db->group_by('partnership.reference_num, partnership_affiliate_code.affiliate_code');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAffiliateStatisticLastWeekByCode($code, $date_last_week)
    {
        $this->db->select('partnership.reference_num, partnership_affiliate_code.affiliate_code, count(users_affiliate_code.referral_affiliate_code) as total_count');
        $this->db->from('partnership_affiliate_code');
        $this->db->join('partnership', 'partnership.partner_id = partnership_affiliate_code.partner_id', 'left');
        $this->db->join('users_affiliate_code', "users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code and users_affiliate_code.date_created >= '" . date('Y-m-d H:i:s', strtotime($date_last_week)) . "'", 'left');
        $this->db->where('partnership_affiliate_code.affiliate_code', $code);
        $this->db->group_by('partnership.reference_num, partnership_affiliate_code.affiliate_code');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAllNullAffiliateCode()
    {
        $this->db->select('partnership.*, partnership_affiliate_code.affiliate_code, users.email, user_profiles.full_name');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'left');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id', 'left');
        $this->db->join('partnership_affiliate_code', 'partnership.partner_id = partnership_affiliate_code.partner_id', 'left');
        $this->db->where('partnership_affiliate_code.date_created', '2015-12-21 12:56:28');
        $this->db->or_where('partnership_affiliate_code.date_created', '2015-12-21 12:56:27');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAccountBalances($exclude_accounts = array())
    {
        $this->db->select('mt_accounts_set.*, users.type, users.micro, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        if (count($exclude_accounts) > 0) {
            $this->db->where_not_in('mt_accounts_set.account_number', $exclude_accounts);
        }
        $this->db->where('mt_accounts_set.mt_type', 1);
        $this->db->where('mt_accounts_set.amount >', 0);
        $this->db->where('users.test', 0);
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->order_by('mt_accounts_set.amount', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getTop10Country($type)
    {
//    FXPP-1374
//    added users.login_type=0 partner is 1 , real and demo is 0
//    added not like keyword test in user accounts

        $sql = "SELECT topten.totalId,topten.countryten,totalusa.totalUser,CONCAT((ROUND(((topten.totalId/totalusa.totalUser)*100),2)),'%') persen from
(
SELECT count(uspro.user_id) totalId,uspro.country countryten,0 totalcol from user_profiles uspro
INNER JOIN users on uspro.user_id=users.id
INNER JOIN mt_accounts_set mtac on users.id=mtac.user_id
where users.type=? and users.login_type=0 and

users.test_1=1

and
CHARACTER_LENGTH(account_number)>5
and not(users.last_ip='210.213.232.26')
GROUP BY uspro.country ORDER BY count(uspro.user_id) DESC  LIMIT 10
) as topten

 INNER JOIN (
SELECT count(uspro.user_id) totalUser,0 totalzero from user_profiles uspro
INNER JOIN users on uspro.user_id=users.id
INNER JOIN mt_accounts_set mtac on users.id=mtac.user_id
where users.type=?
) as totalusa

on topten.totalcol=totalusa.totalzero ORDER BY topten.totalId DESC";

        $query = $this->db->query($sql, array((int)$type, (int)$type));
        return $query->result();
    }

    public function getTop10CountrySort($type, $values)
    {
//    FXPP-1374
//    added users.login_type=0 partner is 1 , real and demo is 0
//    added not like keyword test in user accounts

        $sql = "SELECT topten.totalId,topten.countryten,totalusa.totalUser,CONCAT((ROUND(((topten.totalId/totalusa.totalUser)*100),2)),'%') persen from
(
SELECT count(uspro.user_id) totalId,uspro.country countryten,0 totalcol from user_profiles uspro
INNER JOIN users on uspro.user_id=users.id
INNER JOIN mt_accounts_set mtac on users.id=mtac.user_id
where users.type=? and users.login_type=0 and

users.test_1=1

and
CHARACTER_LENGTH(account_number)>5
and not(users.last_ip='210.213.232.26')

GROUP BY uspro.country ORDER BY count(uspro.user_id) DESC  LIMIT 10
) as topten
 INNER JOIN (
SELECT count(uspro.user_id) totalUser,0 totalzero from user_profiles uspro
INNER JOIN users on uspro.user_id=users.id
INNER JOIN mt_accounts_set mtac on users.id=mtac.user_id
where users.type=?
) as totalusa
on topten.totalcol=totalusa.totalzero where topten.countryten in ($values)";

        $query = $this->db->query($sql, array((int)$type, (int)$type));

        return $query->result();
    }

    public function getSortList($table, $column = "", $val = "")
    {
        $condition = ($column != "") ? 'where ' . $column . '=' . $val : '';
        $sql = "SELECT * from " . $table . "" . $condition . "";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getDemoAndRealPartUser($type, $country)
    {
        $sql = "SELECT date(users.created) dates,count(date(users.created)) val from  user_profiles usf
INNER JOIN users on usf.user_id=users.id
INNER JOIN mt_accounts_set on mt_accounts_set.user_id=users.id
WHERE usf.country=? and users.type=? and
CHARACTER_LENGTH(account_number)>5 and  users.login_type=0
and not(users.last_ip='210.213.232.26') and
users.test_1=1

GROUP BY date(users.created) ORDER BY date(users.created) ASC";

        $query = $this->db->query($sql, array($country, (int)$type));
        return $query->result();
    }

    public function getUserLeveragesByCountry($country = '')
    {
        $this->db->select('SUBSTRING(mt_accounts_set.leverage, 3) actual_leverage, mt_accounts_set.*', false);
        $this->db->from('user_profiles');
        $this->db->join('mt_accounts_set', 'user_profiles.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->where('country', $country);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function updateAccountLeverage($account_number, $leverage)
    {
        $data = array(
            'leverage' => $leverage
        );
        $this->db->where('account_number', $account_number);
        if ($this->db->update('mt_accounts_set', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getRealAccountsCountByDate($start_date, $end_date)
    {
        $this->db->select("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y') registration_date, count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 1);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->group_by("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y')", false);
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getDemoAccountsCountByDate($start_date, $end_date)
    {
        $this->db->select("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y') registration_date, count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 0);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->group_by("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y')", false);
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getPartnerAccountsCountByDate($start_date, $end_date)
    {
        $this->db->select("DATE_FORMAT(partnership.dateregistered, '%m/%d/%Y') registration_date, count(partnership.reference_num) registration_count", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id');
        $this->db->where('users.test', 0);
        $this->db->where('partnership.dateregistered >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('partnership.dateregistered <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->group_by("DATE_FORMAT(partnership.dateregistered, '%m/%d/%Y')", false);
        $this->db->order_by("partnership.dateregistered");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getTopRealAccountsCountByCountry($start_date, $end_date, $limit)
    {
        $this->db->select("user_profiles.country, count(mt_accounts_set.account_number) account_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 1);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->group_by('user_profiles.country');
        $this->db->order_by("COUNT(mt_accounts_set.account_number) DESC", false);
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getRealAccountsCountByCountry($start_date, $end_date, $country)
    {
        $this->db->select("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y') registration_date, count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 1);
        $this->db->where('user_profiles.country', strtoupper(trim($country)));
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->group_by("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y')", false);
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getTopDemoAccountsCountByCountry($start_date, $end_date, $limit)
    {
        $this->db->select("user_profiles.country, count(mt_accounts_set.account_number) account_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 0);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->group_by('user_profiles.country');
        $this->db->order_by("COUNT(mt_accounts_set.account_number) DESC", false);
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getDemoAccountsCountByCountry($start_date, $end_date, $country)
    {
        $this->db->select("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y') registration_date, count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where_not_in('user_profiles.country', array('PH'));
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 0);
        $this->db->where('user_profiles.country', strtoupper(trim($country)));
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(mt_accounts_set.account_number) > 4', null, false);
        $this->db->group_by("DATE_FORMAT(mt_accounts_set.registration_time, '%m/%d/%Y')", false);
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getTopPartnerAccountsCountByCountry($start_date, $end_date, $limit)
    {
        $this->db->select("user_profiles.country, count(partnership.reference_num) account_count", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id');
        $this->db->where('users.test', 0);
        $this->db->where('partnership.dateregistered >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('partnership.dateregistered <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->group_by('user_profiles.country');
        $this->db->order_by("COUNT(partnership.reference_num) DESC", false);
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getPartnerAccountsCountByCountry($start_date, $end_date, $country)
    {
        $this->db->select("DATE_FORMAT(partnership.dateregistered, '%m/%d/%Y') registration_date, count(partnership.reference_num) registration_count", false);
        $this->db->from('partnership');
        $this->db->join('users', 'users.id = partnership.partner_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id');
        $this->db->where('users.test', 0);
        $this->db->where('user_profiles.country', strtoupper(trim($country)));
        $this->db->where('partnership.dateregistered >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('partnership.dateregistered <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(partnership.reference_num) > 4', null, false);
        $this->db->group_by("DATE_FORMAT(partnership.dateregistered, '%m/%d/%Y')", false);
        $this->db->order_by("partnership.dateregistered");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getPopularCountries($date_from, $date_to, $limit = 0)
    {
        $this->db->select('user_profiles.country, sum(deposit.conv_amount) user_count', false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id');
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 1);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where("IFNULL(user_profiles.country, '') <> ''", null, false);
        $this->db->where('deposit.status', 2);
        $this->db->group_by("user_profiles.country");
        $this->db->order_by('sum(deposit.conv_amount)', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getOtherPopularCountriesCount($date_from, $date_to, $exclude_countries = array())
    {
        $this->db->select('sum(deposit.conv_amount) user_count', false);
        $this->db->from('deposit');
        $this->db->join('users', 'users.id = deposit.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = deposit.user_id');
        $this->db->where('users.test', 0);
        $this->db->where('users.type', 1);
        $this->db->where('deposit.payment_date >=', date('Y-m-d 00:00:00', strtotime($date_from)));
        $this->db->where('deposit.payment_date <=', date('Y-m-d 23:59:59', strtotime($date_to)));
        $this->db->where("IFNULL(user_profiles.country, '') <> ''", null, false);
        $this->db->where('deposit.status', 2);
        $this->db->where_not_in("user_profiles.country", $exclude_countries);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['user_count'];
//        if($query->num_rows() > 0){
//            return $query->result_array();
//        }else{
//            return false;
//        }
    }

    public function getNoDepositLeverageExceed()
    {
        $this->db->select('mt_accounts_set.account_number, mt_accounts_set.leverage');
        $this->db->from('users');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users.id');
        $this->db->where('users.nodepositbonus', 1);
        $this->db->where('cast(substr(leverage, 3) as int) > 200');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAccountDetailsByAccountNumber($account_number)
    {
        $this->db->select('mt_accounts_set.account_number, user_profiles.city, user_profiles.country, user_profiles.full_name, contacts.phone1, user_profiles.street, user_profiles.state, user_profiles.zip, users.email,
                            users.id user_id, user_profiles.dob, mt_accounts_set.swap_free, mt_accounts_set.mt_currency_base, mt_accounts_set.leverage, mt_accounts_set.mt_account_set_id, mt_accounts_set.registration_ip');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('contacts', 'contacts.user_id = mt_accounts_set.user_id', 'left');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    public function getAccountsByDateRange($start_date, $end_date)
    {
        $this->db->select('account_number');
        $this->db->from('mt_accounts_set');
        $this->db->where('registration_time >=', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('registration_time <=', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->where('CHAR_LENGTH(account_number) > 4', null, false);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getContestRegistrants()
    {
        $this->db->select('mt_accounts_set.account_number, mt_accounts_set.leverage');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id');
        $this->db->where('contestmoneyfall.Activation', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getContestWinnerRank($contest_date, $user_id)
    {
        $sql_pre_query = 'SET @rank=0';
        $sql_query = "SELECT * FROM
                    (SELECT @rank:=@rank+1 AS rank, user_id
                      FROM contest_winners
                    where start_date = ? and contest_winners.show = 1
                      ORDER BY amount DESC) winners
                    WHERE winners.user_id = ?";
        $this->db->query($sql_pre_query);
        $result = $this->db->query($sql_query, array(date('Y-m-d 00:00:00', strtotime($contest_date)), (int)$user_id));
        return $result->row_array();
    }

    public function getExistingCPAPartners()
    {
        $this->db->from('partnership');
        $this->db->join('users', 'partnership.partner_id = users.id', 'inner');
        $this->db->join('user_profiles', 'partnership.partner_id = user_profiles.user_id', 'inner');
        $this->db->where('partnership.type_of_partnership', 'cpa');
        $this->db->where('users.test', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getAllClients($start = 0)
    {
        $this->db->select('mt_accounts_set.account_number, user_profiles.full_name,user_profiles.country');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->order_by('mt_accounts_set.user_id', 'desc');
        $this->db->limit(10, $start);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getAllClientsCount()
    {
        $this->db->select('count(*) as total');
        $this->db->from('mt_accounts_set');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return false;
        }
    }

    public function isContestAccountActivated($account_number)
    {
        $this->db->select('contestmoneyfall.is_activated');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->is_activated;
        } else {
            return false;
        }
    }

    public function setContestAccountActivated($account_info = array())
    {
        $data = array('contestmoneyfall.is_activated' => 1, 'contestmoneyfall.date_activated' => $account_info['date_activated']);

        $this->db->where('contestmoneyfall.users_id', $account_info['user_id']);

        if ($this->db->update('contestmoneyfall', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function setContestAccountClosed($account_info = array())
    {
        $data = array(
            'contestmoneyfall.is_closed' => 1,
            'contestmoneyfall.date_closed' => $account_info['date_closed'],
            'contestmoneyfall.api_equity' => $account_info['equity'],
            'contestmoneyfall.api_completed_time' => date('Y-m-d H:i:s', strtotime($account_info['completed_time'])),
            'contestmoneyfall.api_profit_loss' => $account_info['profit_loss'],
            'contestmoneyfall.api_trades_closed_count' => $account_info['trades_closed_count']
        );

        $this->db->where('contestmoneyfall.users_id', $account_info['user_id']);

        if ($this->db->update('contestmoneyfall', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function getLimitAllContestArchiveByToken($limit, $offset, $token = '', $search_by = '')
    {
        $this->db->select('contest_winners.*, mt_accounts_set.*');
        $this->db->from('contest_winners');
        // $this->db->join('contestmoneyfall', 'contestmoneyfall.users_id = contest_winners.user_id', 'inner');
        $this->db->join('mt_accounts_set', 'contest_winners.account_number = mt_accounts_set.account_number', 'inner');

        if ($token != '') {
            switch ($search_by) {
                case 'account_number' :
                    $search = "contest_winners.account_number LIKE '%$token%'";
                    break;
                case 'nickname' :
                    $search = "contest_winners.nickname LIKE '%$token%'";
                    break;
            }
            if (trim($search) != '') {
                // $this->db->where('contest_winners.rank <=', 10);
                $this->db->where($search, null, false);
            }
        }
        // $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
        // $this->db->where('contest_winners.show', 1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('contest_winners.rank');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getAllContestArchiveByToken($token = '', $search_by = '')
    {
        $this->db->from('contest_winners');

        if ($token != '') {
            switch ($search_by) {
                case 'account_number' :
                    $search = "contest_winners.account_number LIKE '%$token%'";
                    break;
                case 'nickname' :
                    $search = "contest_winners.nickname LIKE '%$token%'";
                    break;
            }
            if (trim($search) != '') {
                // $this->db->where('contest_winners.rank <=', 10);
                $this->db->where($search, null, false);
            }
        }
        $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
        // $this->db->where('contest_winners.show', 1);
        $this->db->order_by('contest_winners.rank');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getLimitAllContestArchive($limit, $offset, $datefrom = '', $dateto = '')
    {
        $getallranksql = $this->db->select('contest_winners.*, mt_accounts_set.*');
        $getallranksql = $this->db->from('contest_winners');
        // $this->db->join('contestmoneyfall', 'contestmoneyfall.users_id = contest_winners.user_id', 'inner');
        $getallranksql = $this->db->join('mt_accounts_set', 'contest_winners.account_number = mt_accounts_set.account_number', 'inner');
        if (strtotime($datefrom) && strtotime($dateto)) {
            $getallranksql = $this->db->where('contest_winners.start_date >=', date('Y-m-d 00:00:00', strtotime($datefrom)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime($dateto)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
            // $getallranksql = $this->db->where('contest_winners.rank <=', 10);
        } else {
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
            // $getallranksql = $this->db->where('contest_winners.rank <=', 10);
        }
        // $getallranksql = $this->db->where('contest_winners.show', '1');
        $getallranksql = $this->db->limit($limit, $offset);
        $getallranksql = $this->db->order_by('contest_winners.show', 'DESC');
        $getallranksql = $this->db->order_by('contest_winners.rank');
        $getallrank = $this->db->get();
        $getoverall = $getallrank->result_array();
        // if ($getoverall[0]['show']=="0") {
        //     return false;
        // }
        return $getoverall;
    }

    public function getAllContestArchiveByDates($datefrom = '', $dateto = '')
    {
        $getallranksql = $this->db->select('contest_winners.*, mt_accounts_set.*');
        $getallranksql = $this->db->from('contest_winners');

        $getallranksql = $this->db->join('mt_accounts_set', 'contest_winners.account_number = mt_accounts_set.account_number', 'inner');
        if (strtotime($datefrom) && strtotime($dateto)) {
            $getallranksql = $this->db->where('contest_winners.start_date >=', date('Y-m-d 00:00:00', strtotime($datefrom)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime($dateto)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));

        } else {
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime('last friday', strtotime('yesterday'))));
        }
        $getallranksql = $this->db->order_by('contest_winners.show', 'DESC');
        $getallranksql = $this->db->order_by('contest_winners.rank');

        $getallrank = $this->db->get();
        $getoverall = $getallrank->result_array();
        // if ($getoverall[0]['show']=="0") {
        //     return false;
        // }
        return $getoverall;
    }
// test vic
    // $getallranksql = $this->db->order_by('contest_winners.amount', 'DESC');.


    public function getLimitAllContestArchivetest($limit, $offset, $datefrom = '', $dateto = '')
    {
        $getallranksql = $this->db->select('contest_winners.*, mt_accounts_set.*, `contest_winners`.`amount` as ammount');
        $getallranksql = $this->db->from('contest_winners');
        $getallranksql = $this->db->join('mt_accounts_set', 'contest_winners.account_number = mt_accounts_set.account_number', 'inner');
        if (strtotime($datefrom) && strtotime($dateto)) {
            $getallranksql = $this->db->where('contest_winners.start_date >=', date('Y-m-d 00:00:00', strtotime($datefrom)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime($dateto)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d', strtotime('last saturday', strtotime('yesterday'))));
        } else {
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d', strtotime('last saturday', strtotime('yesterday'))));
        }
        $getallranksql = $this->db->limit($limit, $offset);
        $getallranksql = $this->db->order_by('ammount', 'DESC');
        $getallranksql = $this->db->get();
        $getallranksql = $getallranksql->result_array();
        return $getallranksql;
    }


    // function getContestAccountsByDateRange( $start_date, $end_date ){
    //     $this->db->select('mt_accounts_set.*, contestmoneyfall.FullName');
    //     $this->db->from('contestmoneyfall');
    //     $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
    //     $this->db->join('users', 'users.id = contestmoneyfall.users_id', 'inner');
    //     $this->db->where('contestmoneyfall.Activation', 1);
    //     $this->db->where('users.created >=', date('Y-m-d H:i:s', strtotime($start_date)));
    //     $this->db->where('users.created <=', date('Y-m-d H:i:s', strtotime($end_date)));
    //     $this->db->order_by('users.created');
    //     $data = $this->db->get();
    //     return $data->result_array();
    // }

    public function getAllContestArchiveByDatestest($datefrom = '', $dateto = '')
    {
        $getallranksql = $this->db->select('contest_winners.*, mt_accounts_set.*');
        $getallranksql = $this->db->from('contest_winners');
        $getallranksql = $this->db->join('mt_accounts_set', 'contest_winners.account_number = mt_accounts_set.account_number', 'inner');
        if (strtotime($datefrom) && strtotime($dateto)) {
            $getallranksql = $this->db->where('contest_winners.start_date >=', date('Y-m-d', strtotime($datefrom)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d', strtotime($dateto)));
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d ', strtotime('last saturday', strtotime('yesterday'))));

        } else {
            $getallranksql = $this->db->where('contest_winners.end_date <=', date('Y-m-d', strtotime('last saturday', strtotime('yesterday'))));
        }
        $getallranksql = $this->db->order_by('contest_winners.amount', 'DESC');
        $getallranksql = $this->db->get();
        $getallranksql = $getallranksql->result_array();
        return $getallranksql;
    }


    public function getAccountNumberByUserId($user_id)
    {
        $sql = "SELECT account_number as account_number FROM mt_accounts_set WHERE user_id = ?
                  UNION ALL
                  SELECT reference_num as account_number FROM partnership WHERE partner_id = ?";

        $query = $this->db->query($sql, array($user_id, $user_id));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getAccountNumberByCode($code)
    {
        $sql = "SELECT * FROM
                    (
                      SELECT affiliate_code, account_number FROM users_affiliate_code AS uac left join mt_accounts_set as mas on uac.users_id = mas.user_id
	                  UNION
	                  SELECT affiliate_code, reference_num as account_number FROM partnership_affiliate_code AS pac left join partnership as p on pac.partner_id = p.partner_id
                    ) as sac WHERE affiliate_code = ?";
        $query = $this->db->query($sql, array($code));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getAllUser()
    {

        $sql = "SELECT mt.account_number,up.country,up.full_name from users u inner join mt_accounts_set mt on u.id=mt.user_id left join user_profiles up on up.user_id=u.id
union all
select p.reference_num,up.country,up.full_name from users u inner join partnership p on u.id=p.partner_id left join user_profiles up on up.user_id=u.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getRealAccountsCountByDateRange($start_date, $end_date)
    {
        $this->db->select("count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where('users.type', 1);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getDemoAccountsCountByDateRange($start_date, $end_date)
    {
        $this->db->select("count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where('users.type', 0);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getUnverifiedRealAccountsCountByDateRange($start_date, $end_date)
    {
        $this->db->select("count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where('users.type', 1);
        $this->db->where('users.accountstatus', 0);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getTestRealAccountsCountByDateRange($start_date, $end_date)
    {
        $this->db->select("count(mt_accounts_set.account_number) registration_count", false);
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = mt_accounts_set.user_id');
        $this->db->where('users.type', 1);
        $this->db->where('users.test', 1);
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d 00:00:00', strtotime($start_date)));
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d 23:59:59', strtotime($end_date)));
        $this->db->order_by("mt_accounts_set.registration_time");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function setContestWinnerBalanceByAccountNumber($account_number, $balance)
    {
        $data = array(
            'amount' => $balance
        );

        $this->db->where('account_number', $account_number);

        if ($this->db->update('contest_winners', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function setContestWinnerRankByAccountNumber($account_number, $rank)
    {
        $data = array(
            'rank' => $rank
        );

        $this->db->where('account_number', $account_number);

        if ($this->db->update('contest_winners', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getContestWinnersByDate($start_date, $end_date)
    {
        $this->db->from('contest_winners');
        $this->db->where('start_date', date('Y-m-d H:i:s', strtotime($start_date)));
        $this->db->where('end_date', date('Y-m-d H:i:s', strtotime($end_date)));
        $this->db->order_by('amount', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getVerificationDocumentsCountByDate($start_date, $end_date, $is_old = false)
    {

        if ($is_old) {
            $where = "WHERE verification.date_upload < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        } else {
            $where = "WHERE verification.date_upload >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }

        $sql = "SELECT * FROM
                (SELECT DISTINCT mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE mt_type = 1 AND CHAR_LENGTH(mt_accounts_set.account_number) > 4 and users.test = 0
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

    public function getAllVerificationDocumentsCountByDate($start_date, $end_date, $is_old = false)
    {

        if ($is_old) {
            $where = "WHERE verification.date_upload < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        } else {
            $where = "WHERE verification.date_upload >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }

        $sql = "SELECT DISTINCT verification.account_number, verification.user_id, verification.accountstatus, verification.account_status FROM
                (SELECT DISTINCT mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE mt_type = 1 AND CHAR_LENGTH(mt_accounts_set.account_number) > 4 and users.test = 0
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

    public function getVerificationDocumentsCountByStatus($start_date, $end_date, $status = 0)
    {

        $where = "WHERE verification.account_status = $status";

        $sql = "SELECT * FROM
                (SELECT DISTINCT mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE mt_type = 1 AND CHAR_LENGTH(mt_accounts_set.account_number) > 4 and users.test = 0
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

    public function getAllVerificationDocumentsCountByStatus($start_date, $end_date, $status = 0)
    {

        $where = "WHERE verification.account_status = $status";

        $sql = "SELECT * FROM
                (SELECT DISTINCT mt_accounts_set.account_number, user_documents.user_id, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    WHERE mt_type = 1 AND CHAR_LENGTH(mt_accounts_set.account_number) > 4 and users.test = 0
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

    public function getVerificationDocumentsCountByCountryDate($start_date, $end_date, $country, $is_old = false)
    {

        if ($is_old) {
            $where = "WHERE verification.date_upload < '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        } else {
            $where = "WHERE verification.date_upload >= '" . date('Y-m-d H:i:s', strtotime($start_date)) . "'";
        }

        $sql = "SELECT * FROM
                (SELECT DISTINCT mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    INNER JOIN user_profiles ON user_profiles.user_id = users.id
                    WHERE mt_type = 1 AND CHAR_LENGTH(mt_accounts_set.account_number) > 4 AND users.test = 0 AND user_profiles.country = '" . $country . "'
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

    public function getVerificationDocumentsCountByCountryStatus($start_date, $end_date, $country, $status = 0)
    {

        $where = "WHERE verification.account_status = $status";

        $sql = "SELECT * FROM
                (SELECT DISTINCT mt_accounts_set.account_number, user_documents.user_id, DATE_FORMAT(user_documents.date_uploaded, '%Y-%m-%d') date_upload, users.accountstatus,
                        CASE WHEN users.verified > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "' AND users.accountstatus = 1 THEN 0
                                 WHEN user_documents.date_declined > '" . date('Y-m-d H:i:s', strtotime($end_date)) . "'AND users.accountstatus = 2 THEN 0
                                 ELSE users.accountstatus
                        END account_status
                    FROM user_documents
                    INNER JOIN mt_accounts_set ON user_documents.user_id = mt_accounts_set.user_id
                    INNER JOIN users ON users.id = user_documents.user_id
                    INNER JOIN user_profiles ON user_profiles.user_id = users.id
                    WHERE mt_type = 1 AND CHAR_LENGTH(mt_accounts_set.account_number) > 4 AND users.test = 0 AND user_profiles.country = '" . $country . "'
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

    public function getCISRegPerDay()
    {

        $sql = "select count(*) num
from users u inner join user_profiles up on u.id= up.user_id inner join mt_accounts_set mt on mt.user_id=u.id
 left join contacts c on u.id=c.user_id where u.type=1 and DATE(u.created)= date(NOW() - INTERVAL 0 DAY)
 and up.country in ('AM','BY','KZ','KG','MD','RU','TJ','TM','UA','UZ') and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street)
 NOT LIKE '%test%' and LOWER(up.city) NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by up.country, u.id desc ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row()->num;
        } else {
            return false;
        }

    }

    public function getAccountByUserId($user_id)
    {
        $this->db->from('mt_accounts_set');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return false;
        }
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


    public function getAllEmailByLogintype($login_type)
    {
        $this->db->distinct();
        $this->db->select('users.email');
        $this->db->from('users');
        $this->db->where('users.login_type', $login_type);
        // $this->db->limit('10', '10');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllEmailAfter($date)
    {
        $this->db->distinct();
        $this->db->select('users.email');
        $this->db->from('users');
        $this->db->where('users.created >', date('Y-m-d H:i:s', strtotime($date)));
        // $this->db->limit(1000, 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllVerifiedEmail()
    {
        $this->db->select('mailer_test_recipients.email');
        $this->db->from('mailer_test_recipients');
        // $this->db->where('mailer_test_recipients.recipient_type', $type);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    public function insertmailer_test_recipients($data)
    {
        $this->db->insert('mailer_test_recipients', $data);
        return $this->db->insert_id();
    }

    public function insertmailerSingapore($data)
    {
        $this->db->insert('mailer_singapore', $data);
        return $this->db->insert_id();
    }

    public function selectAllUnsentEmailforSingapore()
    {
        $this->db->select('*');
        $this->db->from('mailer_singapore');
        $this->db->where('counter', '0');
        // $result = $this->db->get();
        // if($result->num_rows() > 0){
        //     return $result->row_array();
        // }else{
        //     return false;
        // }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function selectAllUnsentEmailforSingaporeCounter($id)
    {
        $passAraray = array(
            'counter' => '1'
        );
        $this->db->where('id', $id);
        $this->db->update('mailer_singapore', $passAraray);
    }

    public function getFullnameByEmail($email)
    {
        $this->db->select('full_name');
        $this->db->from('users');
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id', 'inner');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $obj = $query->result();
            return $obj{0}->full_name;
        } else {
            return '[client’s Full name]';
        }
    }


    function monthlyDifferentCountryReport()
    {
        $sql = "select u.email,u.created,u.id,up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country
from users u inner join user_profiles up on u.id= up.user_id inner join mt_accounts_set mt on mt.user_id=u.id left join contacts c on u.id=c.user_id
where u.type=1 and u.created BETWEEN  date(NOW() - INTERVAL 1 MONTH) and date(NOW())
 and LOWER(up.full_name) NOT LIKE '%test%' and LOWER(up.street)   NOT LIKE '%test%' and LOWER(up.city) NOT LIKE LOWER('%test%') and LOWER(up.state) NOT LIKE '%test%' order by up.country, u.id desc
";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllUnsentformassMailing($mailerId)
    {
        $this->db->select('*');
        $this->db->from('MassMailerConnection');
        $this->db->where('counter', '0');
        $this->db->where('mailerId', $mailerId);
        $this->db->limit(5000, 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllUnsentformassMailingCounter($id)
    {
        $passAraray = array(
            'counter' => '1'
        );
        $this->db->where('id', $id);
        $this->db->update('MassMailerConnection', $passAraray);
    }

    public function updateAccountGroupCode($account_number, $group_code)
    {
        $data = array(
            'group_code' => $group_code
        );
        $this->db->where('account_number', $account_number);
        if ($this->db->update('mt_accounts_set', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertFailedSetAgent($data)
    {

        $db_data = array(
            'user_id' => $data['user_id'],
            'account_number' => $data['account_number'],
            'agent_account_number' => $data['agent_account_number']
        );

        $this->db->insert('failed_set_agent', $db_data);
        return $this->db->insert_id();
    }

    function getWeekContestWinnersByDates($datefrom = '', $dateto = '')
    {

        $sql = "select t.*,count(cmf.email) as  num  from (
SELECT cw.*,cm.email,count(cm.email) as dup from contest_winners cw left join contestmoneyfall cm on cm.users_id = cw.user_id
where  cw.start_date >= ? and cw.end_date <= ?  group by cm.email) t left join contestmoneyfall cmf on t.email = cmf.email
group by t.email
order by t.amount desc";

        $query = $this->db->query($sql, array($datefrom, $dateto));

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;

      /*  $this->db->select('contest_winners.*,users.email,count(users.email) as  num');
        $this->db->from('contest_winners');
        $this->db->join('users', 'users.id = contest_winners.user_id', 'left');
        $this->db->where('contest_winners.start_date >=', date('Y-m-d 00:00:00', strtotime($datefrom)));
        $this->db->where('contest_winners.end_date <=', date('Y-m-d 23:59:59', strtotime($dateto)));
        $this->db->group_by('users.email');
        $this->db->order_by('contest_winners.amount', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;*/


    }
    function getWeekContestWinnersByEmail($email)
    {
        $this->db->select('contest_winners.*');
        $this->db->from('contest_winners');
        $this->db->join('contestmoneyfall', 'contestmoneyfall.users_id = contest_winners.user_id', 'right');
        $this->db->where('contestmoneyfall.email',$email);
        $this->db->order_by('contestmoneyfall.id', 'desc');
        $this->db->limit(1,1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function getLimitedBonusByDate($from, $to)
    {
        $sql = "select mas.account_number,d.user_id, uac.referral_affiliate_code,d.payment_date,d.amount,up.full_name,up.country, p.reference_num
from deposit d left join user_profiles up on d.user_id=up.user_id
inner join mt_accounts_set mas on mas.user_id=d.user_id
left join users_affiliate_code uac on uac.users_id = d.user_id
left join partnership_affiliate_code pac on pac.affiliate_code = uac.referral_affiliate_code
left join partnership p on pac.partner_id = p.partner_id
where (d.hundredpercentbonus=1 or d.fiftypercentlimitedbonus=1) and payment_date BETWEEN ? and ?";

        $query = $this->db->query($sql, array($from, $to));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function ndbAndLimitedBonusReport($from, $to)
    {
       /* $sql = "select * from (
select nd.account_number, nd.date_request as no_deposit,db.DateProcessed as hpb, nd.user_id,nd.is_approved from no_deposit nd left join  deposit_bonus db  on nd.user_id = db.UserId where nd.date_request BETWEEN ? AND ?
union all
select db.AccountNumber, nd.date_request as no_deposit,db.DateProcessed as hpb,  db.UserId,nd.is_approved from no_deposit nd right join  deposit_bonus db  on nd.user_id = db.UserId where db.DateProcessed BETWEEN ? AND ?
) t group by t.no_deposit,t.hpb,t.user_id  order by t.account_number desc";

        $query = $this->db->query($sql, array($from, $to, $from, $to));*/


        $sql = "select nd.account_number, nd.date_request as no_deposit,db.DateProcessed as hpb, nd.user_id,nd.is_approved
from no_deposit nd left join  deposit_bonus db  on nd.user_id = db.UserId left join users u on u.id = nd.user_id where u.nodepositbonus=0 and db.BonusType='hplb' and u.test <> 1 and u.test_1 <> 0  and nd.date_request between ? and ?";
     /*   $sql = "select * from (
select nd.account_number, nd.date_request as no_deposit,0 as hpb, nd.user_id , nd.date_request as sortdate
from no_deposit nd inner join
users u on u.id = nd.user_id where u.test <> 1 and u.test_1 <> 0  and nd.date_request between ? and ? and u.nodepositbonus=0

union all
select db.AccountNumber, 0 as no_deposit,db.DateProcessed as hpb, db.UserId ,db.DateProcessed as sortdate
from deposit_bonus db inner join
users u on u.id = db.UserId where u.test <> 1 and u.test_1 <> 0  and db.DateProcessed between ? and ? and db.BonusType='hplb'

) t  order by t.sortdate desc"; */
        $query = $this->db->query($sql, array($from, $to));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }


    public function getAllNdbRequestByDate($from, $to)
    {

        $this->db->select('no_deposit.id, users.email, no_deposit.account_number, users.id as user_id, user_profiles.country');
        $this->db->from('no_deposit');
        $this->db->join('users', 'no_deposit.user_id = users.id', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = no_deposit.user_id', 'inner');
        $this->db->where('no_deposit.date_request >=', $from);
        $this->db->where('no_deposit.date_request <= ', $to);
        $this->db->where('no_deposit.is_sent_3days', 0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function checkIdOnDeposittable($id)
    {
        $this->db->select('*');
        $this->db->from('deposit');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return true;
        }else{
            return false;
        }
    }

    public function checkIfEmailSent($email)
    {
        $this->db->select('*');
        $this->db->from('mail_hundred_precent_bonus');
        $this->db->where('email',$email);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return true;
        }else{
            return false;
        }
    }



    public function getnumberOfDeposit($email)
    {
        $this->db->select('count(*) as numberOfDeposit');
        $this->db->from('users');
        $this->db->join('deposit', 'users.id = deposit.user_id', 'inner');
        $this->db->where('users.email',$email);
        $query = $this->db->get();
        $numberOfDeposit = $query->result_array();
        return $numberOfDeposit[0]['numberOfDeposit'];
       
    }



    public function getNewlyRegForMassmailer($date)
    {
        $this->db->select('users.email,user_profiles.full_name,user_profiles.country,users.login_type');
        $this->db->from('users');///'2016-10-12'
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'inner');
        $this->db->where('users.created >', $date);
        // $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    function getContestWinnersLimit( $start_date, $end_date, $limit = 0 ){
        $this->db->select('mt_accounts_set.*, contestmoneyfall.NickName, user_profiles.country, users.created');
        $this->db->from('contestmoneyfall');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = contestmoneyfall.users_id', 'inner');
        $this->db->join('users', 'users.id = contestmoneyfall.users_id', 'inner');
        $this->db->join('user_profiles', 'mt_accounts_set.user_id = user_profiles.user_id', 'inner');
        $this->db->where('contestmoneyfall.Activation = 1');
        $this->db->where('mt_accounts_set.registration_time >=', date('Y-m-d H:i:s', strtotime($start_date)) );
        $this->db->where('mt_accounts_set.registration_time <=', date('Y-m-d H:i:s', strtotime($end_date)) );
        $this->db->order_by('mt_accounts_set.amount', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
//        $result = $this->db->query("CALL getContestWinners('" . $start_date . "','" . $end_date . "')");
//        $data =  $result->result_array();
//        $result->next_result();
//        $result->free_result();
//        return $data;
    }

    public function getAllAccountWithoutTest()
    {

        $sql = "SELECT mt.account_number,up.country,up.full_name from mt_accounts_set mt left join users u  on u.id=mt.user_id left join user_profiles up on up.user_id=u.id where  u.test <> 1 and u.test_1 <> 0
union all
select p.reference_num,up.country,up.full_name from partnership p left join users u on u.id=p.partner_id left join user_profiles up on up.user_id=u.id where  u.test <> 1 and u.test_1 <> 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getClientReferralAffiliateCode($email){

        $sql = "select uac.referral_affiliate_code from users u inner join users_affiliate_code uac on u.id= uac.users_id
where u.email=? and length(uac.referral_affiliate_code)>3 and uac.referral_affiliate_code<>'IHXBM' and uac.referral_affiliate_code is not null";
        $query = $this->db->query($sql,array($email));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getCashBackAccountList($ref_code){

        $this->db->select('uac.*,mas.account_number,mas.mt_currency_base,u.id,u.email,u.nodepositbonus');
          $this->db->from('users_affiliate_code uac');
          $this->db->join('mt_accounts_set mas','uac.users_id=mas.user_id','left');
          $this->db->join('users u','u.id=mas.user_id','left');
          $this->db->where('mas.mt_type',1);
        $this->db->where('uac.referral_affiliate_code',$ref_code);
          $this->db->where('u.nodepositbonus',0);
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->result();
          }
          return false;
/*
      $sql = "select u2.email,uac2.*,mac.mt_currency_base,mac.account_number from (
select  u.email, uac.users_id,uac.referral_affiliate_code
from users_affiliate_code uac left join users u on uac.users_id= u.id
where uac.referral_affiliate_code=? group by u.email) as t
inner join users u2 on u2.email=t.email
inner join users_affiliate_code uac2  on uac2.users_id=u2.id
inner join mt_accounts_set mac on mac.user_id=u2.id
where mac.mt_type=1
group by u2.email having sum(if(length(uac2.referral_affiliate_code)>2,1,0))=1";
        $query = $this->db->query($sql,array($ref_code));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;*/


    }
}
