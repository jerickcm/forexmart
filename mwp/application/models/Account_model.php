<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function getAllUsers($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select,$index=null,$value=null) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->join('contacts c',' ud.user_Id = c.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(a.".'account_number) >', 5);
        if(!is_null($index)){
            $this->db->like($index, $value);
        }
//        $this->db->or_where("u.".$field2, 2);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }

    public function getSearchData($accountNumber){
        $this->db->select('user_profiles.full_name,user_profiles.dob,user_profiles.street,user_profiles.country');
        $this->db->from('user_profiles');
        $this->db->join('partnership', 'partnership.partner_id = user_profiles.user_id');
        $this->db->where('partnership.reference_num', $accountNumber);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function upSearchData($account_number, $dob, $stret){
        $this->db->select('partner_id');
        $this->db->from('partnership');
        $this->db->where('reference_num', $account_number);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $userId = $query->row()->partner_id;
        }


        $data = array(
            'dob' => $dob,
            'street' => $stret
        );

        $this->db->where('user_id');
        $this->db->update('user_profiles', $data);

        if($this->db->update('user_profiles', $data)){
            return true;
        } else {
            return false;
        }
    }

    public function getCheckLevelData($accountNumber){
        $this->db->select('accountstatus');
        $this->db->from('users');
        $this->db->join('mt_accounts_set', 'users.id = mt_accounts_set.user_id');
        $this->db->where('mt_accounts_set.account_number', $accountNumber);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $userStatus = $query->row()->accountstatus;
            return $userStatus;
        }
        else{
            return false;
        }
    }

    public function getCheckLevelDataPart($accountNumber){
        $this->db->select('accountstatus');
        $this->db->from('users');
        $this->db->join('partnership', 'users.id = partnership.partner_id');
        $this->db->where('partnership.reference_num', $accountNumber);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $userStatus = $query->row()->accountstatus;
            return $userStatus;
        }
        else{
            return false;
        }
    }


    public function getSearchAccount($select,$value=null) {
        $this->db->distinct();
       if(!is_array($select)){
           $select = array(
               'p.full_name','u.email'
           );
       }
        $selects = join(", ",array_merge($select,array('mt.account_number')));

           $this->db->select($selects.',ph.reference_num');
           $this->db->from('users u');
           $this->db->join('user_profiles p',' u.id = p.user_id','left');
           $this->db->join('contacts c',' u.id = c.user_id','left');
           $this->db->join('mt_accounts_set mt','u.id=mt.user_id','left');
           $this->db->join('partnership ph','u.id=ph.partner_id','left');

           $str= array();
           foreach($select as $d){
               if($d=='p.dob'){
                   $str[] = $d ."= date('".$value."')";
                  //// $this->db->or_where($d,"date('".$value."')");
               } else{
                   $str[] = "$d = '$value'";
                   //$this->db->or_where($d,$value);
               }


           }
           $str = join(" or ",$str);
           $this->db->where($str);
          $this->db->or_where('mt.account_number',$value);
           $this->db->or_where('ph.reference_num',$value);
           $this->db->group_by('u.id');
           $query = $this->db->get();
          // print_r($query->result());
           // echo $this->db->last_query();
           if ($query->num_rows() > 0) {
               $result['column'] = $query->list_fields();
               $result['result'] = $query->result();
               return $result;
           }else{
               $result['column'] = $query->list_fields();
               $result['result'] = false;
               return $result;
           }
    }

    public  function getOpenAccount($index=null,$value=null){

        $selects ="*";
        if(is_array($index)){
            $index[20]='mt.account_number';
            $selects = join(", ", $index);
        };
        $this->db->select($selects);
        $this->db->from('users u');
        $this->db->join('user_profiles up',' up.user_id = u.id');
        $this->db->join('mt_accounts_set mt',' mt.user_id = up.user_id');
        $this->db->join('contacts c',' u.id = c.user_id');

        if(!is_null($index)){
                $str= array();
                foreach($index as $d){
                        $str[] = "$d = '$value'";
                }
                $str = join(" or ",$str);
                $this->db->where($str);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result['column'] = $query->list_fields();
            $result['result'] = $query->result();
            return $result;
        }else{
            $result['column'] = $query->list_fields();
            $result['result'] = false;
            return $result;
        }
    }


    public function getPhonePassword($account_number,$password){

        $sql = "select reference_num,phone_password from partnership where reference_num=? and phone_password = ? limit 1 union all
select account_number,phone_password from mt_accounts_set where account_number = ? and phone_password = ? limit 1
";
        $query = $this->db->query($sql,array($account_number,$password,$account_number,$password));

        if($query->num_rows()>0)
            return true;
        return false;

        
        
    }
    public function getInfromUseTricket($ticket){
        $this->db->select('users.id,users.email,contacts.phone1,
usp.full_name,usp.street,usp.city,usp.state,usp.zip,usp.country,
dp.reference_id, dp.mt_ticket,
mtac.leverage,mtac.mt_status,mtac.account_number,dp.comments');
        $this->db->from('mt_accounts_set mtac');
        $this->db->join('deposit dp' ,'mtac.user_id=dp.user_id');
        $this->db->join('user_profiles usp' ,'mtac.user_id=usp.user_id');
        $this->db->join('users' ,'usp.user_id=users.id');
        $this->db->join('contacts' ,'contacts.user_id=users.id');   
        $this -> db -> where('dp.mt_ticket!=', "");
        if($ticket!=""){
        $this->db->where('dp.mt_ticket' ,$ticket);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    public function getIncRegistrationClients(){
        $this->db->select('users.email,user_profiles.full_name,users.created,deposit.thirtypercentbonus,users.nodepositbonus')
            ->from('employment_details')
            ->join('users', 'employment_details.user_id = users.id', 'left')
            ->join('user_profiles','user_profiles.user_id= users.id','left')
            ->join('deposit','deposit.user_id= users.id','left')
            ->where('users.login_type', 0)
            ->order_by("users.created","desc")
        ;
        $result = $this->db->get();


        if($result->num_rows() > 0){
          return  $result->result();
        }else{

            return false;
        }
    }


    public function getCheckLevel($account){
        $this->db->select('mt_accounts_set.account_number,mt_accounts_set.group,user_documents.*')
                    ->from('mt_accounts_set')
                    ->join('user_documents', 'user_documents.user_id = mt_accounts_set.id', 'left')
                    ->where('mt_accounts_set.account_number',$account)
                    ->order_by("mt_accounts_set.registration_time","desc")  ;
        $result = $this->db->get();
        return  $result->result();

        if($result->num_rows() > 0){
            return  $result->result();
        }else{
            return false;
        }
    }


    public function getQueryStirng($table,$star,$data="",$gropup="",$order="",$join=""){
        $this->db->select($star);
        $this->db->from($table);
        if($join!=""){foreach($join as $key=>$val){$this->db->join($key ,$val);}}
        if($data!=""){foreach($data as $key=>$val){ $this->db->where($key ,$val);}}
        
        if($gropup!=""){foreach($gropup as $key=>$val){ $this->db->group_by($val); }}
        if($order!=""){foreach($order as $key=>$val){ $this->db->order_by($key,$val); }}
  
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }



    public function getHistoryLog($account_number){

        $sql = "
select au.*,af.*,mcs.account_number,up.full_name from account_update_history au
inner join account_field_update_history af on au.id= af.update_id
inner join mt_accounts_set mcs on mcs.user_id=au.user_id
left join user_profiles up on mcs.user_id=up.user_id
where mcs.account_number=?
";
        $query = $this->db->query($sql,array($account_number));

        if($query->num_rows()>0)
            return $query->result();
        return false;



    }
    public function getTotalDeposit($user_id, $status){
//        $sql = "SELECT SUM(deposit.amount) AS TotalAmount FROM deposit inner join mt_accounts_set on deposit.user_id= mt_accounts_set.user_id where mt_accounts_set.account_number=? and deposit.status = ?";
//        $query = $this->db->query($sql, array($user_id, $status));
      //  if ($query->num_rows() > 0) {
//            $ret['rows']    =  $query->row()->TotalAmount;
//            return $ret;
        //}
        //return false;


        $q  =   $this->db
            ->select('SUM(a.amount) as total')
            ->from('deposit a')
            ->join('mt_accounts_set b', 'a.user_id = b.user_id','inner')
            ->where('b.account_number', $user_id)
            ->where('a.status',$status);
        $ret    =   $q->get()->result();
        //$ret    =   $q->row();
        //return $ret->total;
        return $ret;

    }
    public function getUserInfo($user_id=null){
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->join('user_profiles up',' up.user_id = u.id');
        $this->db->where('u.id',$user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) return $query->row();
        return false;

    }

    public function getUserId($account_number){

        $sql = "select * from(
select user_id as id,account_number as acc_num from mt_accounts_set
union all
select partner_id as id,reference_num as acc_num from partnership) t where t.acc_num =?";

        $row = $this->db->query($sql,array($account_number));
        if($row->num_rows()>0)
            return $row->row();
        return false;
    }

    public function incompleteRegistration(){
        $sql = "select u.email,up.full_name,u.created,ed.user_id,mas.account_number,p.reference_num
                from users u
                left join employment_details ed on ed.user_id= u.id
                left join user_profiles up on u.id=up.user_id
                left join mt_accounts_set mas on u.id=mas.user_id
                left join partnership p on u.id= p.partner_id
                where ed.user_id is not null
                order by u.created desc";

        $row = $this->db->query($sql);
        if($row->num_rows()>0)
            return $row->result();
        return false;
    }

    public function incompleteRegistration1($token = ''){
        $this->db->select('count(*) as count');
        $this->db->from('users u');
        $this->db->join('employment_details ed', 'ed.user_id = u.id','left');
        if( $token != '' ){
            $this->db->join('user_profiles up', 'u.id = up.user_id','left');
            $this->db->join('mt_accounts_set mas', 'u.id = mas.user_id','left');
            $this->db->join('partnership p', 'u.id = p.partner_id','left');
            $search = "( mas.account_number LIKE '%$token%'
                OR p.reference_num LIKE '%$token%'
                OR up.full_name LIKE '%$token%'
                OR u.created LIKE '%$token%'
                OR u.email like '%$token%')";
        $this->db->where($search, null, false);
        }
        $this->db->where('ed.user_id', null, false);
        $this->db->order_by('u.created', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function incompleteRegistration2($limit, $offset, $token = '' ){
        if($token!=''){ $sel = 'u.email,u.created,u.id as user_id,mas.account_number,p.reference_num';
        }else{ $sel ='u.email,u.created,u.id as user_id'; }
        $this->db->select($sel);
        $this->db->from('users u');
        $this->db->join('employment_details ed', 'ed.user_id = u.id','left');
        if( $token != '' ){
            $this->db->join('user_profiles up', 'u.id = up.user_id','left');
            $this->db->join('mt_accounts_set mas', 'u.id = mas.user_id','left');
            $this->db->join('partnership p', 'u.id = p.partner_id','left');
            $search = "( mas.account_number LIKE '%$token%'
                OR p.reference_num LIKE '%$token%'
                OR up.full_name LIKE '%$token%'
                OR u.created LIKE '%$token%'
                OR u.email like '%$token%')";
        $this->db->where($search, null, false);
        }
        $this->db->where('ed.user_id', null, false);
        $this->db->limit($limit,$offset);
        $this->db->order_by('u.created', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }
    function getshow1($tbl,$fld,$id){
        $q = $this->db->select('*')
            ->from($tbl)
            ->where($fld, $id);
        $ret = $q->get()->result();
        return $ret;
    }


    public function balanceTransaction(){} //do not remove

    function getAccountsByIdType( $account_number=null, $type ){
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
        $this->db->where('mt_accounts_set.account_number', $account_number);
        $this->db->where('mt_accounts_set.mt_type', $type);
        $data = $this->db->get();
        return $data->row_array();
    }
    function getAccountsByIdType1( $account_number=null, $type,$a ){
        if($a=='client'){
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
            $this->db->join('user_profiles', 'user_profiles.user_id = users.id', 'left');
            $this->db->join('contacts', 'contacts.user_id = users.id', 'left');
            $this->db->join('trading_experience', 'trading_experience.user_id = users.id', 'left');
            $this->db->join('employment_details', 'employment_details.user_id = users.id', 'left');
            $this->db->where('mt_accounts_set.account_number', $account_number);
            $this->db->where('mt_accounts_set.mt_type', $type);
        }else{
            $this->db->select('partnership.*,
                           users.email, users.type, users.affiliate_code,
                           user_profiles.full_name, user_profiles.country, user_profiles.street, user_profiles.city, user_profiles.state, user_profiles.zip, user_profiles.dob,
                           contacts.phone1,
                           trading_experience.experience, trading_experience.investment_knowledge, trading_experience.trade_duration, trading_experience.risk,
                           employment_details.politically_exposed_person, employment_details.employment_status, employment_details.employment_status, employment_details.industry,
                           employment_details.estimated_annual_income, employment_details.estimated_net_worth, employment_details.education_level, employment_details.us_resident,
                           employment_details.us_citizen');
            $this->db->from('partnership');
            $this->db->join('users', 'users.id = partnership.partner_id');
            $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id', 'left');
            $this->db->join('contacts', 'contacts.user_id = partnership.partner_id', 'left');
            $this->db->join('trading_experience', 'trading_experience.user_id = partnership.partner_id', 'left');
            $this->db->join('employment_details', 'employment_details.user_id = partnership.partner_id', 'left');
            $this->db->where('partnership.reference_num', $account_number);
            $this->db->where('partnership.status_type', $type);
        }


        $data = $this->db->get();
        return $data->row_array();
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
    function updateAccountByUserId( $user_id, $data ){
        $this->db->where('user_id', $user_id);
        if($this->db->update('mt_accounts_set', $data)){
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
    function updateUserDetails($table, $field, $id, $data)
    {
        $this->db->where($field, $id);
        $this->db->update($table, $data);
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
    function getInvitedRefCode($email_user,$user_id=null){
        $this->db->select('ref_number');
        $this->db->from('invite_friends');
        $this->db->where('email', $email_user);
        // $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->ref_number;
    }
    function updateInviteDetails($table, $inv_ref, $tbl_code,$email_user,$tbl_email,$invite_data){
        $this->db->where($tbl_email, $email_user);
        $this->db->where($tbl_code, $inv_ref);
        $this->db->update($table, $invite_data);
    }
    public static function createPeriodicMailer($to, $name){
        $email = trim($to);
        $CI =& get_instance();
        $CI->load->model('Mailer_model');
        $getRecipientDetails = $CI->Mailer_model->getRecipientDetails($email);
//        $getRecipientDetails = false;
        if($getRecipientDetails){
            $recipientId = $getRecipientDetails[0]['Id'];
            $getMailer = $CI->Mailer_model->getPeriodicMailerLimit1($recipientId,1);
            if($getMailer){
                $getMailerClient = $CI->Mailer_model->getPeriodicMailerLimit1($recipientId,0);
                if(!$getMailerClient){
                    $periodicSequence = array(
                        'ThirtyPercentBonus',
                        'HowToGetStarted',
                        //            'HundredPercentBonus', //removed - logic in internal not yet done
                        'importantInstruments',
                        //'LasPalmas',
                        //'EuroLicense',
                        'depositInsurance',
                        'moneyfallContest',
                        //'callbackServices',
                        'vpsServices',
                        'leverage',
                        'mt5',
                        'affiliate_program',
                        //'rpj_racing_cooperation'
                    );
                }
            }else{
                $getMailerClient = $CI->Mailer_model->getPeriodicMailerLimit1($recipientId,0);
                if(!$getMailerClient){
                    $periodicSequence = array(
                        'ThirtyPercentBonus',
                        'HowToGetStarted',
                        //            'HundredPercentBonus', //removed - logic in internal not yet done
                        'importantInstruments',
                        'LasPalmas',
                        'EuroLicense',
                        'depositInsurance',
                        'moneyfallContest',
                        'callbackServices',
                        'vpsServices',
                        'leverage',
                        'mt5',
                        'affiliate_program',
                        'rpj_racing_cooperation'
                    );
                }
            }

        }else{
            $periodicSequence = array(
                'ThirtyPercentBonus',
                'HowToGetStarted',
                //            'HundredPercentBonus', //removed - logic in internal not yet done
                'importantInstruments',
                'LasPalmas',
                'EuroLicense',
                'depositInsurance',
                'moneyfallContest',
                'callbackServices',
                'vpsServices',
                'leverage',
                'mt5',
                'affiliate_program',
                'rpj_racing_cooperation'
            );

            $insert = array(
                'Email' => $email,
                'Fullname' => ucwords(strtolower($name)),
                'recipient_type'=> 1,
                'unsubscribekey' => FXPP::generateUnsubscribeKeyForTradeOffer()
            );
            $recipientId = $CI->Mailer_model->insert_dynamic('mailer_test_recipients',$insert);
            //        $recipientId = 72941;
            if(!$recipientId){
                return;
            }
        }

        //insert new recipient mailer_test_recipients


        $dateToday = date('Y-m-d H:i:s');

        foreach($periodicSequence as $key => $method){

            // $getMailerByRecipientId = $CI->Mailer_model->getMailerByRecipientId($method, $recipientId);
            // if(!$getMailerByRecipientId){
            $day = $key + 1;
            $dateTomorrow = date('Y-m-d H:i:s', strtotime($dateToday.' +'.$day.' day'));

            $unsubscribeKey = FXPP::generateUnsubscribeKey();

            $insert = array(
                'RecipientId' => $recipientId,
                'MethodName' => $method,
                'DateRegistered' => $dateToday,
                'DateAvailable' => $dateTomorrow,
                'Unsubscribe_key'   => $unsubscribeKey
            );

            $CI->Mailer_model->insert_dynamic('mailer_periodic',$insert);
            //}
        }

    }

        function checkUniqueAffiliateCode($affiliateCode){
        $query = 'SELECT * FROM
                    (
                      SELECT affiliate_code FROM users_affiliate_code AS uac
                      UNION
                      SELECT affiliate_code FROM partnership_affiliate_code AS pac
                    ) as sac WHERE affiliate_code = ?;
        ';

        $result = $this->db->query( $query, array($affiliateCode) );
        return ($result->num_rows() > 0) ? false : true;

    }

        function getClientInfoByUserId($user_id){
        $sql = "select u.email,u.created,u.id,up.full_name,mt.account_number,c.phone1,up.street,up.city,up.state,up.zip,up.country
from users u inner join user_profiles up on u.id= up.user_id
left join mt_accounts_set mt on mt.user_id=u.id
left join contacts c on u.id=c.user_id
where u.id =  ?
";
        $query = $this->db->query($sql,array($user_id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
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

    function getAccountsByAccountNumber1( $account_number ){
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

    function getAccountsByUserId( $user_id ){
            $this->db->select('mt_accounts_set.*, users.type');
            $this->db->from('mt_accounts_set');
            $this->db->join('users', 'users.id = mt_accounts_set.user_id');
            $this->db->where('user_id', $user_id);
            $this->db->order_by('id', 'DESC');
            $data = $this->db->get();
            return $data->result_array();
    }

     function ret_delete($table,$field,$id){
        $this->db->delete($table, array($field => $id));
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function show_manage_referrals12($limit,$start) {
        $sql = ("select SQL_CALC_FOUND_ROWS table1.* from
			(select distinct `mt_accounts_set`.`account_number` AS `client_account`,'referral account' AS `referral_account`,`partnership`.`reference_num` AS `partner_account`,`partnership`.`reference_subnum` AS `partner_account2`,`users_affiliate_code`.`referral_affiliate_code` AS `partnership_affiliate_code`,`partnership`.`type_of_partnership` AS `partner_type`,`users_affiliate_code`.`date_created` AS `ref_date`
			from (((`users_affiliate_code`
			join `mt_accounts_set` on((`users_affiliate_code`.`users_id` = `mt_accounts_set`.`user_id`)))
			join `partnership_affiliate_code` on((`users_affiliate_code`.`referral_affiliate_code` = `partnership_affiliate_code`.`affiliate_code`)))
			join `partnership` on((`partnership`.`partner_id` = `partnership_affiliate_code`.`partner_id`)))
			where ((`users_affiliate_code`.`referral_affiliate_code` is not null)
			and (`users_affiliate_code`.`referral_affiliate_code` <> '')
			and (`partnership`.`dateregistered` > '2015-09-24 00:00:00')
			and (char_length(`mt_accounts_set`.`account_number`) > 5))) table1

			union all (select distinct `mt_accounts_set`.`account_number` AS `client_account`,`users_affiliate_code`.`referral_affiliate_code` AS `referral_account`,'' AS `partner_account2`,(select max(`users_affiliate_code`.`affiliate_accountnumber`)
			from `users_affiliate_code` where ((`users_affiliate_code`.`affiliate_code` = `referral_account`)
			and (char_length(`users_affiliate_code`.`affiliate_accountnumber`) > 5))) AS `partner_account`,`users_affiliate_code`.`referral_affiliate_code` AS `partnership_affiliate_code`,'Client Partners' AS `partner_type`,`users_affiliate_code`.`date_created` AS `ref_date`
			from ((`users_affiliate_code` join `mt_accounts_set` on((`users_affiliate_code`.`users_id` = `mt_accounts_set`.`user_id`)))
			join `users` on((`users`.`id` = `users_affiliate_code`.`users_id`))) where ((`users_affiliate_code`.`referral_affiliate_code` is not null)
			and (`users_affiliate_code`.`referral_affiliate_code` <> '')
			and (char_length(`mt_accounts_set`.`account_number`) > 5)
			and (`users`.`login_type` = 0) and (`users`.`type` = 1)
			and (`mt_accounts_set`.`user_id` is not null)))
			LIMIT ". $limit ." OFFSET ". $start);

        $query = $this->db->query($sql);
        $count = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;
        if ($query->num_rows() > 0) {
            return array('result' => $query->result_array(), 'count' => $count);
        }
        return false;
    }
    public function show_manage_referral_by_client_account($limit,$start,$account_number) {

        $sql = ("select SQL_CALC_FOUND_ROWS table1.* from
			(select distinct `mt_accounts_set`.`account_number` AS `client_account`,'referral account' AS `referral_account`,`partnership`.`reference_num` AS `partner_account`,`partnership`.`reference_subnum` AS `partner_account2`,`users_affiliate_code`.`referral_affiliate_code` AS `partnership_affiliate_code`,`partnership`.`type_of_partnership` AS `partner_type`,`users_affiliate_code`.`date_created` AS `ref_date`
			from (((`users_affiliate_code`
			join `mt_accounts_set` on((`users_affiliate_code`.`users_id` = `mt_accounts_set`.`user_id`)))
			join `partnership_affiliate_code` on((`users_affiliate_code`.`referral_affiliate_code` = `partnership_affiliate_code`.`affiliate_code`)))
			join `partnership` on((`partnership`.`partner_id` = `partnership_affiliate_code`.`partner_id`)))
			where ((`users_affiliate_code`.`referral_affiliate_code` is not null)
			and (`users_affiliate_code`.`referral_affiliate_code` <> '')
			and (`partnership`.`dateregistered` > '2015-09-24 00:00:00')
			and (char_length(`mt_accounts_set`.`account_number`) > 5))
			and mt_accounts_set.account_number = ? ) table1

			union all (select distinct `mt_accounts_set`.`account_number` AS `client_account`,`users_affiliate_code`.`referral_affiliate_code` AS `referral_account`,'' AS `partner_account2`,(select max(`users_affiliate_code`.`affiliate_accountnumber`)
			from `users_affiliate_code` where ((`users_affiliate_code`.`affiliate_code` = `referral_account`)
			and (char_length(`users_affiliate_code`.`affiliate_accountnumber`) > 5))) AS `partner_account`,`users_affiliate_code`.`referral_affiliate_code` AS `partnership_affiliate_code`,'Client Partners' AS `partner_type`,`users_affiliate_code`.`date_created` AS `ref_date`
			from ((`users_affiliate_code` join `mt_accounts_set` on((`users_affiliate_code`.`users_id` = `mt_accounts_set`.`user_id`)))
			join `users` on((`users`.`id` = `users_affiliate_code`.`users_id`))) where ((`users_affiliate_code`.`referral_affiliate_code` is not null)
			and (`users_affiliate_code`.`referral_affiliate_code` <> '')
			and (char_length(`mt_accounts_set`.`account_number`) > 5)
			and (`users`.`login_type` = 0) and (`users`.`type` = 1)
			and (`mt_accounts_set`.`user_id` is not null))
			and mt_accounts_set.account_number = ?)
			LIMIT ". $limit ." OFFSET ". $start);

        $query = $this->db->query($sql, array($account_number,$account_number));
        $count = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;
        if ($query->num_rows() > 0) {
            return array('result' => $query->result_array(), 'count' => $count);
        }
        return false;
    }
    public function show_manage_referral_by_partner_account($limit,$start,$account_number) {
        $sql = ("SELECT SQL_CALC_FOUND_ROWS table1.* FROM (
					SELECT DISTINCT
						mt1.account_number AS client_account,
						'referral account' AS referral_account,
						p.reference_num AS partner_account,
						p.reference_subnum AS partner_account2,
						uac1.referral_affiliate_code AS partnership_affiliate_code,
						p.type_of_partnership AS partner_type,
						uac1.date_created AS ref_date
					FROM users_affiliate_code uac1
						JOIN mt_accounts_set mt1
						ON mt1.user_id = uac1.users_id
						JOIN partnership_affiliate_code pac1
						ON pac1.affiliate_code = uac1.referral_affiliate_code
						JOIN partnership p
						ON p.partner_id = pac1.partner_id
					WHERE uac1.referral_affiliate_code IS NOT NULL
					AND uac1.referral_affiliate_code <> ''
					AND p.dateregistered > '2015-09-24 00:00:00'
					AND CHAR_LENGTH(mt1.account_number) > 5
					AND p.reference_num = ?) table1

					UNION ALL

					(SELECT DISTINCT
						mt2.account_number AS client_account,
						uac2.referral_affiliate_code AS referral_account,
						'' AS partner_account2,
						(SELECT MAX(uac3.affiliate_accountnumber)
							FROM users_affiliate_code uac3
							WHERE uac3.affiliate_code = referral_account
							AND CHAR_LENGTH(uac2.affiliate_accountnumber) > 5
						) AS partner_account,
						uac2.referral_affiliate_code AS partnership_affiliate_code,
						'Client Partners' AS partner_type,
						uac2.date_created AS ref_date
					FROM users_affiliate_code uac2
						JOIN mt_accounts_set mt2
						ON mt2.user_id = uac2.users_id
						JOIN users
						ON users.id = uac2.users_id
					WHERE uac2.referral_affiliate_code IS NOT NULL
					AND uac2.referral_affiliate_code <> ''
					AND CHAR_LENGTH(mt2.account_number) > 5
					AND users.login_type = 0
					AND users.type = 1
					AND mt2.user_id IS NOT NULL
					AND mt2.account_number = ?)
					LIMIT ". $limit ." OFFSET ". $start);
        $query = $this->db->query($sql, array($account_number,$account_number));
        $count = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;

        if ($query->num_rows() > 0) {
            return array('result' => $query->result_array(), 'count' => $count);
        }
        return false;
    }

    public function show_manage_referral_by_affiliate_code($limit,$start,$code) {
        $sql = ("SELECT SQL_CALC_FOUND_ROWS table1.* FROM (
					SELECT DISTINCT
						mt1.account_number AS client_account,
						'referral account' AS referral_account,
						p.reference_num AS partner_account,
						p.reference_subnum AS partner_account2,
						uac1.referral_affiliate_code AS partnership_affiliate_code,
						p.type_of_partnership AS partner_type,
						uac1.date_created AS ref_date
					FROM users_affiliate_code uac1
						JOIN mt_accounts_set mt1
						ON mt1.user_id = uac1.users_id
						JOIN partnership_affiliate_code pac1
						ON pac1.affiliate_code = uac1.referral_affiliate_code
						JOIN partnership p
						ON p.partner_id = pac1.partner_id
					WHERE uac1.referral_affiliate_code IS NOT NULL
					AND uac1.referral_affiliate_code <> ''
					AND p.dateregistered > '2015-09-24 00:00:00'
					AND CHAR_LENGTH(mt1.account_number) > 5
					AND uac1.referral_affiliate_code = ?) table1

					UNION ALL

					(SELECT DISTINCT
						mt2.account_number AS client_account,
						uac2.referral_affiliate_code AS referral_account,
						'' AS partner_account2,
						(SELECT MAX(uac3.affiliate_accountnumber)
							FROM users_affiliate_code uac3
							WHERE uac3.affiliate_code = referral_account
							AND CHAR_LENGTH(uac2.affiliate_accountnumber) > 5
						) AS partner_account,
						uac2.referral_affiliate_code AS partnership_affiliate_code,
						'Client Partners' AS partner_type,
						uac2.date_created AS ref_date
					FROM users_affiliate_code uac2
						JOIN mt_accounts_set mt2
						ON mt2.user_id = uac2.users_id
						JOIN users
						ON users.id = uac2.users_id
					WHERE uac2.referral_affiliate_code IS NOT NULL
					AND uac2.referral_affiliate_code <> ''
					AND CHAR_LENGTH(mt2.account_number) > 5
					AND users.login_type = 0
					AND users.type = 1
					AND mt2.user_id IS NOT NULL
					AND uac2.referral_affiliate_code = ?)
					LIMIT ". $limit ." OFFSET ". $start);
        $query = $this->db->query($sql, array($code,$code));
        $count = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;

        if ($query->num_rows() > 0) {
            return array('result' => $query->result_array(), 'count' => $count, 'query' => $this->db->last_query());
        }
        return false;
    }

    public function show_manage_referral_by_partner_type($limit,$start,$type) {

        if ($type != 'Client Partners') {
            $sql = ("SELECT SQL_CALC_FOUND_ROWS table1.* FROM (
					SELECT DISTINCT
						mt1.account_number AS client_account,
						'referral account' AS referral_account,
						p.reference_num AS partner_account,
						p.reference_subnum AS partner_account2,
						uac1.referral_affiliate_code AS partnership_affiliate_code,
						p.type_of_partnership AS partner_type,
						uac1.date_created AS ref_date
					FROM users_affiliate_code uac1
						JOIN mt_accounts_set mt1
						ON mt1.user_id = uac1.users_id
						JOIN partnership_affiliate_code pac1
						ON pac1.affiliate_code = uac1.referral_affiliate_code
						JOIN partnership p
						ON p.partner_id = pac1.partner_id
					WHERE uac1.referral_affiliate_code IS NOT NULL
					AND uac1.referral_affiliate_code <> ''
					AND p.dateregistered > '2015-09-24 00:00:00'
					AND CHAR_LENGTH(mt1.account_number) > 5
					AND p.type_of_partnership = ?) table1
					LIMIT ". $limit ." OFFSET ". $start);
            $query = $this->db->query($sql, array($type));
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS table1.* FROM (SELECT DISTINCT
						mt2.account_number AS client_account,
						uac2.referral_affiliate_code AS referral_account,
						'' AS partner_account2,
						(SELECT MAX(uac3.affiliate_accountnumber)
							FROM users_affiliate_code uac3
							WHERE uac3.affiliate_code = referral_account
							AND CHAR_LENGTH(uac2.affiliate_accountnumber) > 5
						) AS partner_account,
						uac2.referral_affiliate_code AS partnership_affiliate_code,
						'Client Partners' AS partner_type,
						uac2.date_created AS ref_date
					FROM users_affiliate_code uac2
						JOIN mt_accounts_set mt2
						ON mt2.user_id = uac2.users_id
						JOIN users
						ON users.id = uac2.users_id
					WHERE uac2.referral_affiliate_code IS NOT NULL
					AND uac2.referral_affiliate_code <> ''
					AND CHAR_LENGTH(mt2.account_number) > 5
					AND users.login_type = 0
					AND users.type = 1
					AND mt2.user_id IS NOT NULL) table1
					LIMIT ". $limit ." OFFSET ". $start;
            $query = $this->db->query($sql);
        }

        $count = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;

        if ($query->num_rows() > 0) {
            return array('result' => $query->result_array(), 'count' => $count, 'query' => $this->db->last_query());
        }
        return false;
    }
    public function get_all_referrals() {
        return $this->db->count_all('manage_referrals');
    }
    function getAccountByType( $type, $token = ''){
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users_affiliate_code', 'users.id = users_affiliate_code.users_id', 'inner');
        $this->db->join('user_profiles', 'users.id = user_profiles.user_id', 'left');
        $this->db->where('mt_type', $type);
        $this->db->where('referral_affiliate_code !="" ');
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
    function getLimitAccountByType( $type, $limit, $offset, $token = '' ){
        $this->db->select('mt_accounts_set.*, users.type, user_profiles.full_name, users.accountstatus');
        $this->db->from('mt_accounts_set');
        $this->db->join('users', 'users.id = mt_accounts_set.user_id', 'inner');
        $this->db->join('users_affiliate_code', 'users.id = users_affiliate_code.users_id', 'left');
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
    function getAccountType($id=null){

        $data= array(
            '1' =>"ForexMart Standard",
            '2' => "ForexMart Zero Spread",
            '4' => "ForexMart Micro Account"
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function get_account_affiliate_code($id){
        $this->db->select('*');
        $this->db->from('users_affiliate_code');
        $this->db->where('users_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function getPartnerType($affiliate_code,$type){
        if($type=='partner'){
            $this->db->select('a.*,b.affiliate_code as code');
            $this->db->from('partnership a');
            $this->db->join('partnership_affiliate_code b','a.id=b.partner_id','inner');
            $this->db->where('b.affiliate_code',$affiliate_code);
        }else{
            $this->db->select('a.*,b.affiliate_code as code');
            $this->db->from('mt_accounts_set a');
            $this->db->join('users_affiliate_code b','a.id=b.users_id','inner');
            $this->db->where('b.affiliate_code',$affiliate_code);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function getshow($userid){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$userid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
