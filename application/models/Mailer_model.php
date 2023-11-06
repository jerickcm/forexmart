<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mailer_model extends CI_Model
{

    public function getDetailsUnsubscribeKey($key){
        $this->db->select('mailer_client_connection.*, mailer_test_recipients.Email');
        $this->db->from('mailer_client_connection');
        $this->db->join('mailer_test_recipients', 'mailer_client_connection.RecipientId = mailer_test_recipients.Id', 'left');
        $this->db->where('mailer_client_connection.Unsubscribe_key', $key);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function getRecipientConnection($email,$mailerId){
        $this->db->select('*')
            ->from('mailer_client_connection')
            ->join('mailer_test_recipients', 'mailer_client_connection.RecipientId = mailer_test_recipients.Id', 'left')
            ->where('mailer_client_connection.ScheduleId', $mailerId)
            ->where('mailer_test_recipients.Email', $email);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }

        return false;
    }

    public function updateClientRecipientCounter($connectionId,$data){
        $this->db->where('ConnectionId',$connectionId);
        $this->db->update('mailer_client_connection', $data);
    }

    public function updateRecipientCounterTest($connectionId,$data){
        $this->db->where('ConnectionId',$connectionId);
        $this->db->update('mailer_test_connection', $data);
    }

    public function updateRecipientCounter($connectionId,$data){
        $this->db->where('Id',$connectionId);
        $this->db->update('mailer_connection', $data);
    }

    public function deleteMailerConnectionTest($connectionId){
        $this->db->where('ConnectionId', $connectionId);
        $this->db->delete('mailer_test_connection');
    }

    public function deleteMailerConnection($connectionId){
        $this->db->where('Id', $connectionId);
        $this->db->delete('mailer_connection');
    }

    public function getSavedScheduleMailerId($mailerId){
        $this->db->select('*, mailer_test_schedules.ScheduleId');
        $this->db->from('mailer_test_schedules');
        $this->db->join('mailer', 'mailer_test_schedules.MailerId = mailer.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->join('mailer_mailbox', 'mailer.Sentfrom = mailer_mailbox.Email', 'inner');
        $this->db->where('mailer.Active', 1);
        $this->db->where('mailer.Id', $mailerId);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function getScheduledMailerClient($mailerId){
        $this->db->select('*, mailer_test_schedules.ScheduleId');
        $this->db->from('mailer_test_schedules');
        $this->db->join('mailer', 'mailer_test_schedules.MailerId = mailer.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
//        $this->db->join('mailer_mailbox', 'mailer.Sentfrom = mailer_mailbox.Email', 'inner');
        $this->db->where('mailer.Active', 1);
        $this->db->where('mailer.Id', $mailerId);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function getSavedSchedule($event){
        $this->db->select('*, mailer_schedules.Id, mailer_schedules.Occurrence');
        $this->db->from('mailer_schedules');
        $this->db->join('mailer', 'mailer_schedules.mailer = mailer.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->join('mailer_mailbox', 'mailer.Sentfrom = mailer_mailbox.Email', 'inner');
        $this->db->where('mailer.Active', 1);
        $this->db->where('mailer_schedules.Date_category', $event);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function getRecipientsofMailerTest($ScheduleId){
        $this->db->select('*, mailer_test_connection.ConnectionId')
            ->from('mailer_test_connection')
            ->join('mailer_test_recipients', 'mailer_test_connection.RecipientId = mailer_test_recipients.Id', 'left')
            ->where('mailer_test_connection.ScheduleId', $ScheduleId)
            ->where('mailer_test_connection.Counter', 0)
            ->where('mailer_test_connection.Unsubscribe', 0)
//            ->where('mailer_test_connection.RecipientId', 69699)
            ->limit(5000, 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;

    }
    public function getRecipientsofMailerTestRU($ScheduleId){
        $this->db->select('*, mailer_test_connection.ConnectionId')
            ->from('mailer_test_connection')
            ->join('mailer_test_recipients', 'mailer_test_connection.RecipientId = mailer_test_recipients.Id', 'left')
            ->where('mailer_test_connection.ScheduleId', $ScheduleId)
            ->where('mailer_test_connection.Counter', 0)
            ->where('mailer_test_connection.Unsubscribe', 0)
//            ->where('mailer_test_connection.RecipientId', 69699)
            ->limit(10000, 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;

    }
    public function getRecipientsClientsMailer($ScheduleId){
        $this->db->select('*, mailer_client_connection.ConnectionId')
            ->from('mailer_client_connection')
            ->join('mailer_test_recipients', 'mailer_client_connection.RecipientId = mailer_test_recipients.Id', 'left')
            ->where('mailer_client_connection.ScheduleId', $ScheduleId)
            ->where('mailer_test_recipients.Active', 1)
            ->where('mailer_client_connection.Counter', 0)
            ->where('mailer_client_connection.Unsubscribe', 0)
//            ->where('mailer_client_connection.RecipientId', 72941)
//            ->where('mailer_client_connection.RecipientId', 71408)
//            ->where('mailer_client_connection.RecipientId', 166948)
            ->limit(15000);
//            ->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;

    }

    public function getRecipientsofMailer($mailerId, $mode){
        $where = array();
        $query = "SELECT *, mailer_connection.Id, mailer_connection.user_id from mailer_connection left join mailer_recipients on mailer_connection.recipient_id = mailer_recipients.Id";

        if(isset($mailerId) && !empty($mailerId)){
            $where[] = 'mailer_connection.mailer_id = "'.$mailerId.'"';
        }

        if($mode == 'Once'){
            $where[] = 'mailer_connection.sent_counter = 0';
        }

        $whereClause = !empty( $where ) ? " WHERE " . implode( " AND ", $where ) : "";
        $query .= $whereClause . " AND mailer_recipients.Email is not null AND mailer_connection.unsubscribe = 0 LIMIT 10000";

        $result = $this->db->query( $query );
        if($result->num_rows() > 0){
            return $result->result_array();
        }
        return false;


    }

    public function getUserDetails($userId){
        $this->db->select()
            ->from('user_profiles')
            ->where('user_id', $userId);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }

        return false;
    }

    public function getAllDistinctEmail()
    {
        $sql = "select distinct(email) from users";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }

    public function getAllDistinctEmailFromMailerTest()
    {
        $sql = "select distinct(email) from mailer_test_recipients where recipient_type = 1;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }
   public function getAllDistinctEmailForMasMail($email)
    {
         $this->db->select('id,login_type');
        $this->db->from('users');
        $this->db->where('Email', $email);
          $query = $this->db->get();
        if($query->num_rows() > 0){
            $return = $query->result_array();
            return $return[0];
        }
        return false;
    }


    public function getFullNameAndCountry($user_id)
    {
        $this->db->select('country , full_name');
        $this->db->from('user_profiles');
        $this->db->where('user_id', $user_id);
          $query = $this->db->get();
        if($query->num_rows() > 0){
            $return = $query->result_array();
            return $return[0];
        }
        return false;
    }
    public function getRecipientDetails($recipient){
        $this->db->select('*');
        $this->db->from('mailer_test_recipients');
        $this->db->where('Email', $recipient);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }

    public function insert_dynamic($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();

    }

    //New Periodic

    public function getUnsubscribeKeyDetails($key){
        $this->db->select('*')
            ->from('mailer_periodic')
            ->where('Unsubscribe_key', $key);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? false : true;
    }

    public function getUnsubscribekeyOnMassMailer($key){
        $this->db->select('*')
            ->from('MassMailer')
            ->where('Unsubscribe_key', $key);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? false : true;
    }

    public function getUnsubscribekeyOnForTradeOffer($key){
        $this->db->select('*')
            ->from('mailer_test_recipients')
            ->where('unsubscribekey', $key);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? false : true;
    }

    public function massmailuniq($email){
        $this->db->select('*')
            ->from('MassMailer')
            ->where('Email', $email);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? false : true;
    }
    public function massmailuniq2($email,$mailerId){
        $this->db->select('*')
            ->from('MassMailerConnection')
            ->where('Email', $email)
            ->where('mailerId', $mailerId);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? false : true;
    }

    public function getAllSubscribeMassMailer(){
        $this->db->select('*')
            ->from('MassMailer')
            ->where('Unsubscribe', '0')
            ->where('created >=', '2016-10-06');
        $data = $this->db->get();
        if($data->num_rows() > 0){
            return $data->result_array();
        }
        return false;
    }

    public function getAllSubscribeMassMailer2(){
        $this->db->select('*')
            ->from('MassMailer')
            ->where('Unsubscribe', '0')
            // ->where('login_type', '1') //partner only for now 20000
            ->limit(20000, 0);
            // ->limit(limit, start);
        $data = $this->db->get();
        if($data->num_rows() > 0){
            return $data->result_array();
        }
        return false;
    }



    public function getMailerByRecipientId($methodName, $recipientId){
        $this->db->select('*')
            ->from('mailer_periodic')
            ->where('MethodName', $methodName)
            ->where('RecipientId', $recipientId); 
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;

    }

    public function getAllPeriodicMailer($dateToday){
        $this->db->select('mailer_periodic.*, mailer_test_recipients.Email, mailer_test_recipients.Fullname')
            ->from('mailer_periodic')
            ->join('mailer_test_recipients', 'mailer_periodic.RecipientId = mailer_test_recipients.Id')
            ->where('Counter', 0)
            ->where('Active', 1)
            ->where('Date(DateAvailable)', $dateToday)
            ->limit(20000);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;
    }

    public function updatePeriodicCounter($periodicId,$data){
        $this->db->where('Id', $periodicId);
        $this->db->update('mailer_periodic', $data);
    }

    public function getDetailsUnsubscribeKey2($key){
        $this->db->select('mailer_periodic.*, mailer_test_recipients.Email');
        $this->db->from('mailer_periodic');
        $this->db->join('mailer_test_recipients', 'mailer_periodic.RecipientId = mailer_test_recipients.Id', 'left');
        $this->db->where('mailer_periodic.Unsubscribe_key', $key);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }


    public function getDetailsUnsubscribeKey3($key){
        $this->db->select('MassMailer.*');
        $this->db->from('MassMailer');
        $this->db->where('MassMailer.Unsubscribe_key', $key);
        $this->db->where('MassMailer.Unsubscribe', 0);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function getRecipientPeriodic($email,$key){
        $this->db->select('*')
            ->from('mailer_periodic')
            ->join('mailer_test_recipients', 'mailer_periodic.RecipientId = mailer_test_recipients.Id', 'left')
            ->where('mailer_periodic.Unsubscribe_key', $key)
            ->where('mailer_periodic.Unsubscribe', 0)
            ->where('mailer_test_recipients.Email', $email);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }

        return false;
    }

    public function getRecipientPeriodic2($email,$key){
        $this->db->select('*')
            ->from('MassMailer')
            // ->join('mailer_test_recipients', 'mailer_periodic.RecipientId = mailer_test_recipients.Id', 'left')
            ->where('MassMailer.Unsubscribe_key', $key)
            ->where('MassMailer.Email', $email);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }

        return false;
    }

    public function manualUnsubscribe($email){
        $this->db->select('*')
            ->from('MassMailer')
            ->where('MassMailer.Email', $email)
            ->where('MassMailer.Unsubscribe', '0');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            $arrayName = array('Unsubscribe' => 1);
            $this->db->where('Email', $email);
            $this->db->update('MassMailer', $arrayName);
                return "true";
        }
        return "false";
    }

    public function getHasQuestionMark()
    {
        $sql = "Select * from mailer_test_recipients where Fullname like '%?%'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }


    public function getAllRUIn_mailer_test_recipients(){
        $this->db->select('*')
            ->from('mailer_test_recipients')
            ->where('Active', '1')
            ->where('Language', 'RU');
        $data = $this->db->get();
        if($data->num_rows() > 0){
            return $data->result_array();
        }
        return false;
    }

    public function getAllPeriodicEmail(){
        $this->db->select('*')
            ->from('mailer_periodic');
        $this->db->join('mailer_test_recipients', 'mailer_test_recipients.Id =  mailer_periodic.RecipientId', 'inner');
        $this->db->group_by('mailer_periodic.RecipientId');
        $data = $this->db->get();
        if($data->num_rows() > 0){
            return $data->result_array();
        }
        return false;
    }

    public function updateMassMail($Email,$data){
        $this->db->where('Email',$Email);
        $this->db->update('MassMailer', $data);
    }

    public function getAllPeriodicMailerTag($dateToday, $tag){
        $this->db->select('mailer_periodic.*, mailer_test_recipients.Email, mailer_test_recipients.Fullname')
            ->from('mailer_periodic')
            ->join('mailer_test_recipients', 'mailer_periodic.RecipientId = mailer_test_recipients.Id')
            ->where('mailer_periodic.Counter', 0)
            ->where('Active', 1)
            ->where('Tag', $tag)
            ->where('Date(DateAvailable)', $dateToday)
            ->limit(3000);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;
    }

    public function getPeriodicMailerLimit1($recipient,$tag){
        $this->db->select('*')
        ->from('mailer_periodic')
        ->where('RecipientId',$recipient)
        ->where('Tag',$tag)
        ->limit(1);

        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;
    }

    public function getAllClient($counter){
        $this->db->select('*')
                ->from('mailer_test_recipients')
                ->where('Active',1)
                ->where('recipient_type',1)
                ->where('counter <>',$counter)
                ->limit(1800);

        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;
    }

    public function getAllMailerTestRecipients($start){
        $this->db->select('mailer_test_recipients.Email, mailer_test_recipients.Id')
        ->from('mailer_test_recipients')
        ->where('Active',1)
        ->where('recipient_type',1)

            ->limit(20000,$start);

        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;
    }

    public function getTradeOfferContent(){
        $this->db->select('*')
                ->from('trade_offer_mailing')
                ->order_by('id', 'DESC')
                ->limit(1);
        $data = $this->db->get();
        return ($data->num_rows() > 0) ? $data->result_array() : false;
    }

    public function getDetailsByKey($key){
            $this->db->select('mailer_test_recipients.Id as recipient_id');
            $this->db->from('mailer_test_recipients');
            $this->db->where('mailer_test_recipients.unsubscribekey', $key);
            $this->db->where('mailer_test_recipients.Active',1);
            $result = $this->db->get();
            if($result->num_rows() > 0){
                return $result->row_array();
            }else{
                return false;
            }
    }

    public function getEmailById($id){
        $this->db->select('Email');
        $this->db->from('mailer_test_recipients');
        $this->db->where('mailer_test_recipients.Id', $id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function unsubcribeThisId($id){
        $this->db->where('Id', $id);
        $data = array(
            'Active' => 0,
            'unsubscribe_date' => date('Y-m-d', strtotime('now') )
        );
        $this->db->update('mailer_test_recipients', $data);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function checkEmailAndKey($email,$key){
        $this->db->select('*')
            ->from('mailer_test_recipients')
            ->where('mailer_test_recipients.unsubscribekey', $key)
            ->where('mailer_test_recipients.Active', 1)
            ->where('mailer_test_recipients.Email', $email);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function counterForMailerTestRecipients($id,$counter){
        $passAraray = array(
            'counter' => $counter
        );
        $this->db->where('Id', $id);
        $this->db->update('mailer_test_recipients', $passAraray);
    }

    // public function checkIfFieldExist($field_name){
    //     if ( $this->db->field_exists($field_name, 'MassMailer') ) {
    //         return true;
    //     } else { 
    //         return false;
    //         // $this->load->dbforge();
    //         // $test = array( 'type' => 'INT' );
    //         // $array[$field_name] = $test;
    //         // $this->dbforge->add_column('MassMailer', $array);
    //     }
    // }
    public function getUnsubscribeEmailAfter4Months(){
        $this->db->select('Email,Unsubscribe_key');
        $this->db->from('MassMailer');
        $this->db->where('Unsubscribe', 1);
        $this->db->where('Unsubscribe_date >=', date( "Y-m-d 00:00:00",strtotime( "-4 month", strtotime('now') ) ) );
        $this->db->where('Unsubscribe_date <=', date( "Y-m-d 23:59:59",strtotime( "-4 month", strtotime('now') ) ) );
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result_array();
        }
        return false;
    }

    public function getUnsubscribeEmailAfter4Months2(){
        $this->db->select('Email,unsubscribekey');
        $this->db->from('mailer_test_recipients');
        $this->db->where('Active', 0);
        $this->db->where('unsubscribe_date >=', date( "Y-m-d 00:00:00",strtotime( "-4 month", strtotime('now') ) ) );
        $this->db->where('unsubscribe_date <=', date( "Y-m-d 23:59:59",strtotime( "-4 month", strtotime('now') ) ) );
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result_array();
        }
        return false;
    }

    public function subscribeThisEmail($Email){
        $this->db->where('Email',$Email);
        $this->db->update('MassMailer', array('Unsubscribe' => 0) );
    }

    public function subscribeThisEmail2($Email){
        $this->db->where('Email',$Email);
        $this->db->update('mailer_test_recipients', array('Active' => 1) );
    }

    public function getCopyTradeEmails(){
        $this->copytrade = $this->load->database('copytrade', true);
        $sql = 'SELECT e_mail FROM unsubscribed_auto WHERE unsubscribed_date BETWEEN (NOW() - INTERVAL 1 HOUR) AND NOW();';
        $query = $this->copytrade->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }


}




