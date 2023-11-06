<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }



    public function getCalendarEvents( $postData = array()) {
        $events = $this->getEvents( $postData );
        if( empty( $events ) ) {
            return array();
        }
        $pointDate = date( "Y-m-d", strtotime( $events[0]['ReleaseDate'] ) );
        $groupedEvents = array();
        $outerIndex = 0;
        foreach( $events as $event ) {
            if( date( "Y-m-d", strtotime( $event['ReleaseDate'] ) ) == $pointDate ) {
                $groupedEvents[ $outerIndex ][] = $event;
            } else {
                $groupedEvents[ $outerIndex + 1 ][] = $event;
                $outerIndex++;
                $pointDate = date( "Y-m-d", strtotime( $event['ReleaseDate'] ) );
            }
        }
//        if('115.127.83.18'== $this->input->ip_address()) {
//
//            echo $this->db->last_query();

//            echo "<pre>";
//            print_r($groupedEvents);
//            exit();
//        }
        return $groupedEvents;
    }
public function getCun()
{
    $lan = '';

    switch (FXPP::html_url()) {
        case 'en':
            $lan = 'en';
        case '':
            $lan = 'en';
            break;
        case 'ru':
            $lan = 'ru';

            return $lan;
    }
}



    public function getEvents( $postData = array() ) {
        if( empty( $postData ) ) {
            return array();
        }
        // $postdata = Array ( [dateType] => yesterday [date] => 2017-03-16 [offset] => [limit] =>
       // [priority] => Low,Medium,High [country] => au,be,ca,cn,eu [time] => 1 [language] => en ) {"calendarList":"\r\n

            $where = array();
            $query = "SELECT *, DATE_ADD(ReleaseTimestamp, INTERVAL ".$postData['time']." HOUR) AS ReleaseDate FROM calendar";

            if( isset( $postData['date'] ) && !empty( $postData['date'] ) ) {
                $date = $postData["date"];

                $dates = array();
                $whereDate = "";

                switch($postData['dateType']){
                    case 'this_week':
                    case 'next_week':
                        $dates[] = 'DATE_ADD(`ReleaseTimestamp`, INTERVAL '.$postData['time'].' HOUR) BETWEEN "'.$date['week_start'].' 00:00:00" AND "'.$date['week_end'].' 23:59:59"';
                        break;
                    default:
//                    $timestamp = strtotime( $date );
//                    $dates[] = 'DATE( `ReleaseTimestamp` ) = "' . date( "Y-m-d", $timestamp ) . '"';
                        $dates[] = 'DATE_ADD(`ReleaseTimestamp`, INTERVAL '.$postData['time'].' HOUR) BETWEEN "'.$date.' 00:00:00" AND "'.$date.' 23:59:59"';
                        break;
                }


                $where[] = implode( " OR ", $dates );
            }
            //echo "<pre></pre>";print_r($where);
            //Array ( [0] => DATE_ADD(`ReleaseTimestamp`, INTERVAL 1 HOUR) BETWEEN "2017-03-16 00:00:00" AND "2017-03-16 23:59:59" )

            if( isset( $postData['priority'] ) && !empty( $postData['priority'] ) ) {

                $priority = explode(',', $postData['priority']);
                foreach($priority as $pr){
                    $importance[] = '`Importance` = "' . $pr . '"';
                }

                $where[] = '('.implode( " OR ", $importance ).')';
                //echo "<pre></pre>";print_r($where);

            }

            if( isset( $postData['country'] ) && !empty( $postData['country'] ) ) {
                $cntry = explode(',', $postData['country']);
                foreach($cntry as $ct){
                    $country[] = '`Country` = "' . $ct . '"';
                }

                $where[] = '('.implode( " OR ", $country ).')';
            }



            $whereClause = !empty( $where ) ? " WHERE " . implode( " AND ", $where ) : "";
            //        $query .= $whereClause . " ORDER BY `ReleaseTimestamp` LIMIT ".$postData['limit']." OFFSET ".$postData['offset']."";
            $whereClause=str_replace("AND ()","",$whereClause);
            $whereLang = " AND language = '".$postData['language']."' ";
            $query .= $whereClause . $whereLang . " ORDER BY `ReleaseDate`";
            //echo "<pre></pre>";print_r($query);
            //SELECT *, DATE_ADD(ReleaseTimestamp, INTERVAL 1 HOUR) AS ReleaseDate FROM calendar WHERE DATE_ADD(`ReleaseTimestamp`, INTERVAL 1 HOUR)
           // BETWEEN "2017-03-16 00:00:00" AND "2017-03-16 23:59:59" AND (`Importance` = "Medium" AND `Importance` = "High") AND (`Country` = "au")
           // AND language = 'en' ORDER BY `ReleaseDate`

        // $postdata = Array ( [dateType] => yesterday [date] => 2017-03-16 [offset] => [limit] => [priority] => Medium [country] => au [time] => 1 [language] => en )

      //  $country=$this->getCun();


        $result = $this->db->query( $query );
        if( is_object( $result ) ) {
            return $result->result_array();
        }
    }

    public function countEvents( $postData = array() ) {
        if( empty( $postData ) ) {
            return array();
        }

        $where = array();
        $query = "SELECT count(*) as count FROM calendar";

        if( isset( $postData['date'] ) && !empty( $postData['date'] ) ) {
            $date = $postData["date"];

            $dates = array();
            $whereDate = "";

            switch($postData['dateType']){
                case 'this_week':
                case 'next_week':
                    $dates[] = '`ReleaseTimestamp` BETWEEN "'.$date['week_start'].'" AND "'.$date['week_end'].'"';
                    break;
                default:
                    $timestamp = strtotime( $date );
                    $dates[] = 'DATE( `ReleaseTimestamp` ) = "' . date( "Y-m-d", $timestamp ) . '"';
                    break;
            }

            $where[] = implode( " OR ", $dates );
        }

        if( isset( $postData['priority'] ) && !empty( $postData['priority'] ) ) {
            foreach($postData['priority'] as $pr){
                $importance[] = '`Importance` = "' . $pr . '"';
            }

            $where[] = '('.implode( " OR ", $importance ).')';

        }

        if( isset( $postData['country'] ) && !empty( $postData['country'] ) ) {
            foreach($postData['country'] as $ct){
                $country[] = '`Country` = "' . $ct . '"';
            }

            $where[] = '('.implode( " OR ", $country ).')';
        }



//        if( isset( $postData['time'] ) && NULL != $postData['time'] ) {
//            $subtract = false;
//            if( false === strpos( $postData['time'], "-" ) ) {
//                $subtract = true;
//                $offset = intval( $postData['time'] );
//            } else {
//                $offset = $postData['time'];
//            }
//
//            $offset = $offset * 60 * 60; //converting 5 hours to seconds.
//            if( 0 == $offset ) {
//                $offset = 0 * 60 * 60;
//                $time = gmdate( "H", time() - $offset );
//            } else {
//                $dateFormat = "Y-m-d H:i:s";
//                $time = gmdate( "H", ( $subtract ? time() - $offset : time() + $offset ) );
//            }
//            $where[] = 'TIME( `ReleaseTimestamp` ) BETWEEN "' . $time . ':00" AND "' . $time . ':59"';
//        }

        $whereClause = !empty( $where ) ? " WHERE " . implode( " AND ", $where ) : "";
        $whereClause=str_replace("AND ()","",$whereClause);
        $whereLang = " AND language = '".$postData['language']."' ";
        $query .= $whereClause . $whereLang;

        $result = $this->db->query( $query );
        if( is_object( $result ) ) {
            return $result->row_array();
        }
    }

    public function getCalendar($from,$to) {
        $query = sprintf("SELECT * FROM calendar WHERE `ReleaseTimestamp` between '$from' AND '$to' ORDER BY `ReleaseTimestamp` ASC ");
        $result = $this->db->query( $query );
        return $result->result_array();
    }

    public function retrieveLatestCalendar() {
        $client = new SoapClient( "http://client-api.instaforex.com/soapservices/Calendar.svc?wsdl" );
        $lang = array('En','Ru');
        foreach($lang as $key) {
            $getCalendar = $client->GetCalendar(array("lang" => $key, "account" => array("Login" => "", "Password" => "")));

            $elements = array();
            $index = 0;

            foreach ($getCalendar->GetCalendarResult->Event as $element) {
                if (!is_object($element)) {
                    continue;
                }

                $data = array();
                $this->db->where(sprintf('Id = %s', ( string ) $element->Id));
                $query = $this->db->get("calendar");
                if (0 == $query->num_rows()) {
                    $data['Actual'] = ( string ) $element->Actual;
                    $data['Country'] = ( string ) $element->Country;
                    $data['Description'] = ( string ) $element->Description;
                    $data['Forecast'] = ( string ) $element->Forecast;
                    $data['Id'] = ( string ) $element->Id;
                    $data['Importance'] = ( string ) $element->Importance;
                    $data['Name'] = ( string ) $element->Name;
                    $data['Previous'] = ( string ) $element->Previous;
                    $data['ReleaseTimestamp'] = date("Y-m-d H:i:s", ( string ) $element->ReleaseTimestamp);
                    $data['language'] = $key;
                    $this->db->insert("calendar", $data);
                }
            }
        }
    }

    public function getCalendarEventDetails($CalendarId){
        $this->db->select('*')
            ->from('calendar')
            ->where('Id', $CalendarId);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        return false;
    }

    public function fixUsersAccountNumber(){
        $this->db->select('*')
            ->from('users')
            ->join('mt_accounts_set', 'users.id = mt_accounts_set.user_id', 'left')
            ->join('users_affiliate_code', 'users.id = users_affiliate_code.users_id', 'left')
            ->join('user_profiles', 'users.id = user_profiles.user_id', 'left')
            ->where('mt_accounts_set.account_number', '');

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result_array();
        }
    }

}