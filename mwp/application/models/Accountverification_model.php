<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accountverification_model extends CI_Model
{	
	function __construct(){
		parent::__construct();

	}
    public function showt4w1jx($table,$table2,$table3,$table4,$field2,$id2,$limit, $offset,$select,  $token = '') {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(a.".'account_number) >', 5);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    public function showt4w1j4ls($table,$table2,$table3,$table4,$field2,$id2, $limit, $offset,$select, $token = '') {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(a.".'account_number) >', 5);
        $this->db->group_by('ud.user_Id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    public function showPt4w1jx($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' part',' ud.user_Id = part.partner_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("part.dateregistered>", '2015-10-01 00:00:00');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(part.".'reference_num) >', 5);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showPt4w1j4ls($table,$table2,$table3,$table4,$field2,$id2,$limit, $offset,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' part',' ud.user_Id = part.partner_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("part.dateregistered>", '2015-10-01 00:00:00');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(part.".'reference_num) >', 5);
        $this->db->group_by('ud.user_Id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showCP_pending() {
        $query = $this->db->query("SELECT * FROM (
  SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  mt_accounts_set as  a on ud.user_Id = a.user_id
  WHERE u.accountstatus=0 and CHARACTER_LENGTH(a.account_number) > 5
	GROUP BY ud.user_Id
 UNION ALL
SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  partnership as  part on ud.user_Id = part.partner_id
  WHERE u.accountstatus=0 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5
	GROUP BY ud.user_Id

) as resutl_table ORDER BY accountstatus ASC,date_uploaded DESC ;");

       if ($query->num_rows() > 0) {
           return $query->result_array();
       }
        return false;
    }
    public function showCP_pendingS($length, $start,$search) {
        $search = "( id LIKE '%$search%'
                OR UCASE(user_id) LIKE '%$search%'
                OR DATE_FORMAT(date_uploaded, '%Y-%M-%d %H:%i:%s') LIKE '%$search%'
                OR UCASE(full_name) LIKE '%$search%'
                OR UCASE(last_ip) LIKE '%$search%'
                OR UCASE(street) LIKE '%$search%'
                OR UCASE(city) LIKE '%$search%'
                OR UCASE(country) LIKE '%$search%'
                OR UCASE(zip) LIKE '%$search%'
                OR UCASE(doc_type) LIKE '%$search%'
                OR UCASE(file_name) LIKE '%$search%'
                OR UCASE(status) LIKE '%$search%'
                OR UCASE(client_name) LIKE '%$search%'
                OR UCASE(accountstatus) LIKE '%$search%'
                OR UCASE(account_number) LIKE '%$search%'
                OR UCASE(recent_fileupload) LIKE '%$search%')";


        $query = $this->db->query("SELECT * FROM (
  SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  mt_accounts_set as  a on ud.user_Id = a.user_id
  WHERE u.accountstatus=0 and CHARACTER_LENGTH(a.account_number) > 5
	GROUP BY ud.user_Id
 UNION ALL
SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  partnership as  part on ud.user_Id = part.partner_id
  WHERE u.accountstatus=0 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5
	GROUP BY ud.user_Id

) as resutl_table WHERE  ".$search."
ORDER BY accountstatus ASC, date_uploaded DESC
LIMIT ".$start." , ".$length."  ;");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function showCP_declined() {
        $query = $this->db->query("SELECT * FROM (
  SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number as account_number,u.recent_fileupload
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  mt_accounts_set as  a on ud.user_Id = a.user_id
  WHERE u.accountstatus=2 and CHARACTER_LENGTH(a.account_number) > 5
	GROUP BY ud.user_Id
 UNION ALL
SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num as account_number,u.recent_fileupload
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  partnership as  part on ud.user_Id = part.partner_id
  WHERE u.accountstatus=2 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5
	GROUP BY ud.user_Id

) as resutl_table ORDER BY accountstatus ASC,date_uploaded DESC ;");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showCP_declinedS($length, $start,$search) {

        $search = "( id LIKE '%$search%'
                OR UCASE(user_id) LIKE '%$search%'
                OR DATE_FORMAT(date_uploaded, '%Y-%M-%d %H:%i:%s') LIKE '%$search%'
                OR UCASE(full_name) LIKE '%$search%'
                OR UCASE(last_ip) LIKE '%$search%'
                OR UCASE(street) LIKE '%$search%'
                OR UCASE(city) LIKE '%$search%'
                OR UCASE(country) LIKE '%$search%'
                OR UCASE(zip) LIKE '%$search%'
                OR UCASE(doc_type) LIKE '%$search%'
                OR UCASE(file_name) LIKE '%$search%'
                OR UCASE(status) LIKE '%$search%'
                OR UCASE(client_name) LIKE '%$search%'
                OR UCASE(accountstatus) LIKE '%$search%'
                OR UCASE(account_number) LIKE '%$search%'
                OR UCASE(recent_fileupload) LIKE '%$search%')";

        $query = $this->db->query("SELECT * FROM (
  SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  mt_accounts_set as  a on ud.user_Id = a.user_id
  WHERE u.accountstatus=2 and CHARACTER_LENGTH(a.account_number) > 5
	GROUP BY ud.user_Id
 UNION ALL
SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  partnership as  part on ud.user_Id = part.partner_id
  WHERE u.accountstatus=2 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5
	GROUP BY ud.user_Id

) as resutl_table WHERE  ".$search."
ORDER BY accountstatus ASC,date_uploaded DESC
LIMIT ".$start." , ".$length."  ;");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function showCP_verified() {
        $query = $this->db->query("SELECT * FROM (
  SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number as account_number,u.recent_fileupload
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  mt_accounts_set as  a on ud.user_Id = a.user_id
  WHERE u.accountstatus=1 and CHARACTER_LENGTH(a.account_number) > 5
	GROUP BY ud.user_Id
 UNION ALL
SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num as account_number,u.recent_fileupload
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  partnership as  part on ud.user_Id = part.partner_id
  WHERE u.accountstatus=1 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5
	GROUP BY ud.user_Id

) as resutl_table ORDER BY accountstatus ASC,date_uploaded DESC ;");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showCP_verifiedS($length, $start,$search) {

        $search = "( id LIKE '%$search%'
                OR UCASE(user_id) LIKE '%$search%'
                OR DATE_FORMAT(date_uploaded, '%Y-%M-%d %H:%i:%s') LIKE '%$search%'
                OR UCASE(full_name) LIKE '%$search%'
                OR UCASE(last_ip) LIKE '%$search%'
                OR UCASE(street) LIKE '%$search%'
                OR UCASE(city) LIKE '%$search%'
                OR UCASE(country) LIKE '%$search%'
                OR UCASE(zip) LIKE '%$search%'
                OR UCASE(doc_type) LIKE '%$search%'
                OR UCASE(file_name) LIKE '%$search%'
                OR UCASE(status) LIKE '%$search%'
                OR UCASE(client_name) LIKE '%$search%'
                OR UCASE(accountstatus) LIKE '%$search%'
                OR UCASE(account_number) LIKE '%$search%'
                OR UCASE(recent_fileupload) LIKE '%$search%')";

        $query = $this->db->query("SELECT * FROM (
  SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  mt_accounts_set as  a on ud.user_Id = a.user_id
  WHERE u.accountstatus=1 and CHARACTER_LENGTH(a.account_number) > 5
	GROUP BY ud.user_Id
 UNION ALL
SELECT DISTINCT ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num as account_number,u.recent_fileupload,u.login_type
  FROM user_documents  as ud
  JOIN  users as  u on ud.user_Id = u.id
  JOIN  user_profiles as  p on ud.user_Id = p.user_id
  JOIN  partnership as  part on ud.user_Id = part.partner_id
  WHERE u.accountstatus=1 and part.dateregistered >'2015-10-01 00:00:00' and CHARACTER_LENGTH(part.reference_num) > 5
	GROUP BY ud.user_Id

) as resutl_table WHERE  ".$search."
ORDER BY accountstatus ASC,date_uploaded DESC
LIMIT ".$start." , ".$length."  ;");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_verifiedtab_search($search='') {
        if(trim($search) <> ''){
//            if(IPLoc::Office()){
                $sql = "select distinct min(user_documents.id) as id, user_documents.user_id, min(user_documents.date_uploaded) as date_uploaded, users.email, users.login_type, user_profiles.full_name,
                        users.last_ip, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.country,user_profiles.zip, users.accountstatus, mt_accounts_set.account_number,
                        users.recent_fileupload, countries.country AS country2, mt_accounts_set.group, user_profiles.fb
                        from mt_accounts_set
                        inner join user_documents on mt_accounts_set.user_id = user_documents.user_id
                        inner join user_profiles on user_profiles.user_id = mt_accounts_set.user_id
                        inner join users on users.id = mt_accounts_set.user_id
                        left join countries on countries.country_id = user_profiles.country
                        WHERE CHAR_LENGTH(mt_accounts_set.account_number) > 4 AND users.accountstatus = 1 AND mt_accounts_set.account_number like '$search%'
                        GROUP BY user_documents.user_id, users.email, users.login_type, user_profiles.full_name, users.last_ip, user_profiles.street,user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip,
                        users.accountstatus, mt_accounts_set.account_number, users.recent_fileupload, countries.country
                        UNION ALL
                        select distinct min(user_documents.id) as id, user_documents.user_id, min(user_documents.date_uploaded) as date_uploaded, users.email, users.login_type, user_profiles.full_name,
                        users.last_ip, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip, users.accountstatus, partnership.reference_num,
                        users.recent_fileupload, countries.country AS country2, mt.group, user_profiles.fb
                        from partnership
                        inner join user_documents on partnership.partner_id = user_documents.user_id
                        inner join user_profiles on user_profiles.user_id = partnership.partner_id
                        inner join users on users.id = partnership.partner_id
                        left join mt_accounts_set mt on mt.user_id = partnership.partner_id
                        left join countries on countries.country_id = user_profiles.country
                        WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.accountstatus = 1 AND partnership.reference_num like '$search%'
                        GROUP BY user_documents.user_id, users.email, users.login_type, user_profiles.full_name, users.last_ip, user_profiles.street,user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip,
                        users.accountstatus, partnership.reference_num, users.recent_fileupload, countries.country
                        LIMIT 1";
                $query = $this->db->query($sql);
//            }else{
//                $search = "(UCASE(account_number) LIKE '%$search%')";
//                $query = $this->db->query("SELECT * FROM account_verification_verified  WHERE  ".$search." LIMIT 1");
//            }
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }
        return false;
    }

  public function get_declinedtab_search($search='') {
        if(trim($search) <> '') {
            $sql = "select distinct min(user_documents.id) as id, user_documents.user_id, min(user_documents.date_uploaded) as date_uploaded, users.email, users.login_type, user_profiles.full_name,
                        users.last_ip, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.country,user_profiles.zip, users.accountstatus, mt_accounts_set.account_number,
                        users.recent_fileupload, countries.country AS country2,mt_accounts_set.corporate_acc_status as corp_acc_status
                        from mt_accounts_set
                        inner join user_documents on mt_accounts_set.user_id = user_documents.user_id
                        inner join user_profiles on user_profiles.user_id = mt_accounts_set.user_id
                        inner join users on users.id = mt_accounts_set.user_id
                        left join countries on countries.country_id = user_profiles.country
                        WHERE CHAR_LENGTH(mt_accounts_set.account_number) > 4 AND users.accountstatus = 2 AND mt_accounts_set.account_number = $search
                        GROUP BY user_documents.user_id, users.email, users.login_type, user_profiles.full_name, users.last_ip, user_profiles.street,user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip,
                        users.accountstatus, mt_accounts_set.account_number, users.recent_fileupload, countries.country
                        UNION ALL
                        select distinct min(user_documents.id) as id, user_documents.user_id, min(user_documents.date_uploaded) as date_uploaded, users.email, users.login_type, user_profiles.full_name,
                        users.last_ip, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip, users.accountstatus, partnership.reference_num,
                        users.recent_fileupload, countries.country AS country2,'' as corp_acc_status
                        from partnership
                        inner join user_documents on partnership.partner_id = user_documents.user_id
                        inner join user_profiles on user_profiles.user_id = partnership.partner_id
                        inner join users on users.id = partnership.partner_id
                        left join countries on countries.country_id = user_profiles.country
                        WHERE CHAR_LENGTH(partnership.reference_num) > 4 AND users.accountstatus = 2 AND partnership.reference_num LIKE '%$search%'
                        GROUP BY user_documents.user_id, users.email, users.login_type, user_profiles.full_name, users.last_ip, user_profiles.street,user_profiles.city, user_profiles.state, user_profiles.country, user_profiles.zip,
                        users.accountstatus, partnership.reference_num, users.recent_fileupload, countries.country
                        LIMIT 1";
            $query = $this->db->query($sql);
//            $search = "(UCASE(account_number) LIKE '%$search%')";
//            $query = $this->db->query("SELECT * FROM account_verification_declined  WHERE  " . $search . " LIMIT 1");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }
        return false;
    }
}