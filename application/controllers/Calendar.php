<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Calendar_model');
        $this->load->model('General_model');
        $this->lang->load('calendar');
        $this->load->helper('url');
        $this->load->library('WebService');
        $this->load->library('FXPP');
        $this->nlanguage = FXPP::html_url();
    }

    public function CalendarIndex()
    {
        if(IPLoc::Office()){
            $webservice_config = array('server' => 'calendar');
            $WebService = new WebService($webservice_config);
            $lang=$this->nlanguage!='ru'?'En':'Ru';
            $res = $WebService->getcalendarevent($lang)->Event;
            print_r($res);exit;
            if($res){
                $data['data']['calevents'] = $res;
            }else{
                print_r("No events found");
            }
        }

        //  $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'ForexMart is regulated by Calendar.';
        $data['data']['metadata_keyword'] = 'Calendar| ForexMart';
        $this->template->title("Calendar | ForexMart")
            ->set_layout('external/main')
            ->build('external_calendar',$data['data']);
    }

    public function GetUserTimeZone(){
//        $ip = $_SERVER['REMOTE_ADDR'];
        $ip = '188.40.37.66';
        $userTimezone = FXPP::GetTimezone($ip);
        $dtz = new DateTimeZone($userTimezone);
        $getTimezoneNow = new DateTime('now', $dtz);
        $offset = $dtz->getOffset( $getTimezoneNow ) / 3600;

        $result = array(
            'offset' => $offset,
            'timezone' => $userTimezone
        );

        return $result;

    }

    public function index(){
        $lang = ($this->nlanguage!='ru') ?'En':'Ru';
        $this->Calendar_model->retrieveLatestCalendar();
        $getUserTimezone = $this->GetUserTimeZone();

        $postData = array(
            'dateType' => 'yesterday',
            'date' => date('Y-m-d', strtotime('yesterday')),
            'time' => $getUserTimezone['offset'],
            'language' => $lang
        );

        $calendar['calendarList'] = $this->Calendar_model->getCalendarEvents($postData);

        $data['calendarData'] =$this->load->view('test', $calendar, true);

        $data['currentGMTFilter'] = $getUserTimezone['offset'];
        // $data['metadata_description'] = 'ForexMart is regulated by Calendar.';
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = 'Calendar| ForexMart';
        $this->template->title(lang('x_fcal_dsc'))

            ->append_metadata_css('
                  <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'external-res.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css"/>
                  <link rel="stylesheet" href="' . $this->template->Css() . 'flags32.css"/>
                  <link rel="stylesheet" href="' . $this->template->Css() . 'flags16.css"/>

            ')

            ->append_metadata_js('
                <script src="' . $this->template->Js() . 'Moment.js" type="text/javascript"></script>
                <script src="' . $this->template->Js() . 'bootstrap-datetimepicker.min.js" ></script>
                <script src="' . $this->template->Js() . 'canvasjs.min.js" ></script>
                   
                ')

            ->set_layout('external/main')
            ->build('external_calendar',$data);
    }

    public function getCalendarEventDetails(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $CalendarId = $this->input->post('id',true);
        if($CalendarId){
            $getCalendarEventDetails = $this->Calendar_model->getCalendarEventDetails($CalendarId);
            if($getCalendarEventDetails){

                switch($getCalendarEventDetails['Country']){
                    case 'uk':
                        $flag = 'gb';
                        break;
                    case 'ja':
                        $flag = 'jp';
                        break;
                    default:
                        $flag = $getCalendarEventDetails['Country'];
                        break;
                }

                switch($getCalendarEventDetails['Importance']){
                    case 'Low':
                        $barType = 'low';
                        $barClass = 'low';
                        break;
                    case 'Medium':
                        $barType = 'moderate';
                        $barClass = 'warning';
                        break;
                    case 'High':
                        $barType = 'high';
                        $barClass = 'danger';
                }

                $data = array(
                    'Description' => $getCalendarEventDetails['Description'],
                    'Actual' => $getCalendarEventDetails['Actual'],
                    'Forecast' => $getCalendarEventDetails['Forecast'],
                    'ReleaseTimestamp' =>date( "l, d F Y", strtotime($getCalendarEventDetails['ReleaseTimestamp'] ) ),
                    'Flag' => 'flag'.' '.$flag,
                    'Importance' => $barClass.' '.$barType,
                    'Name' => $getCalendarEventDetails['Name'],
                    'Previous' => $getCalendarEventDetails['Previous']

                );
            }
            echo json_encode($data);
        }

    }

    function getStartAndEndDate($week, $year) {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
    }

    public function getCalendarEvents(){
        $lang=FXPP::html_url()!='ru'?'en':'ru';

        $toDate = null;
        switch($_POST['tab']){
            case 'yesterday':
                $passDate = date('Y-m-d', strtotime('yesterday'));
                break;
            case 'today':
                $passDate = date('Y-m-d', strtotime('today'));
                break;
            case 'tomorrow':
                $passDate = date('Y-m-d', strtotime('tomorrow'));
                break;
            case 'this_week':
                $ddate = date('Y-m-d');
                $date = new DateTime($ddate);
                $week = $date->format("W");
                $year = $date->format("Y");
                $week_array = $this->getStartAndEndDate($week,$year);
                $passDate = $week_array;
                break;
            case 'next_week':
                $ddate = date('Y-m-d');
                $date = new DateTime($ddate);
                $week = $date->format("W");
                $week = $week + 1;
                $year = $date->format("Y");
                $week_array = $this->getStartAndEndDate($week,$year);
                $passDate = $week_array;
                break;
            case 'datetimepicker':
                $passDate = $_POST['selectedDate'];
                break;
        }

        $postData = array(
            'dateType' => $_POST['tab'],
            'date' => $passDate,
            'offset' => $_POST['start'],
            'limit' => $_POST['length'],
            'priority' => $_POST['importance'],
            'country' => $_POST['country'],
            'time' => $_POST['time'],
            'language' => $lang
        );

        //Array ( [dateType] => yesterday [date] => 2017-03-16 [offset] => [limit] => [priority] => Medium [country] => au [time] => 1 [language] => en )

        //echo "<pre></pre>";print_r($postData);

        $data['calendarList'] = $this->Calendar_model->getCalendarEvents($postData);
        $countEvents = $this->Calendar_model->countEvents($postData);
        $result['calendarList'] = $this->load->view('test', $data, true);

     //   echo "<pre></pre>";print_r($countEvents);
        //  $whereClause=str_replace("AND ()","",$whereClause);
        echo json_encode($result);
        exit;

        $data = array();
        $releaseTimestamp = null;
        foreach($calendarList as $calendar){
            foreach($calendar as $eventItem){

                switch($eventItem['Importance']){
                    case 'Low':
                        $barType = 'low';
                        $barClass = 'low';
                        break;
                    case 'Medium':
                        $barType = 'moderate';
                        $barClass = 'warning';
                        break;
                    case 'High':
                        $barType = 'high';
                        $barClass = 'danger';
                }

                $tempArray = array(
                    'DT_RowId' => $eventItem['CalendarId'],
                    date( "H:i", strtotime( $eventItem["ReleaseTimestamp"] ) ),
                    '<i class="flag '.$eventItem['Country'].'"></i>',
                    "<div class='progress calendar-progress'><div class='progress-bar progress-bar-".$barClass." ".$barType."' role='progressbar' aria-valuenow='' aria-valuemin='0' aria-valuemax='100'></div></div>",
                    "<a href='javascript:;' class='show-description' id='show-description-".$eventItem['Id']."'>".$eventItem['Name']."</a>",
                    $eventItem['Actual'],
                    $eventItem['Forecast'],
                    $eventItem['Previous']
                );
                $data[] = $tempArray;
            }
        }

        $result = array(
            'recordsTotal'      => $countEvents['count'],
            'recordsFiltered'   => $countEvents['count'],
            'data'              => $data
        );

        echo json_encode($result);

    }

    public function parseCalendar(){
        $client = new SoapClient( "http://client-api.instaforex.com/soapservices/Calendar.svc?wsdl" );
//        $getCalendar= $client->GetCalendar( array( "lang" => "En", "account" => array( "Login" => "123", "Password" => "qweqwe" ) ) );
//        if(IPLoc::Office()){
//            if($country = ($this->uri->segment(1) === 'ru')){
//                $getCalendar = $client->GetCalendar(array('lang' => 'Ru', 'account' => array('Login' => '', 'Password' => '')));
//            } else {
//                $getCalendar= $client->GetCalendar( array( "lang" => "En", "account" => array( "Login" => "", "Password" => "" ) ) );
//            }
//        }
//        else {
        $getCalendar= $client->GetCalendar( array( "lang" => "En", "account" => array( "Login" => "123", "Password" => "qweqwe" ) ) );
//        }
        var_dump($getCalendar);
    }


    public function testing_economic_calendar(){
        // exit;
        $lang=FXPP::html_url()!='ru'?'en':'ru';
        // $passDate = date('Y-m-d', strtotime('today'));
        $passDate = date('Y-m-d', strtotime('next tuesday'));
        print_r($passDate);
        $postData = array(
            'dateType' => $_POST['tab'],
            'date' => $passDate,
            'offset' => $_POST['start'],
            'limit' => 1,
            'priority' => 'High',
            'country' => $_POST['country'],
            'time' => 2,
            'language' => 'en'
        );
            $data = $this->Calendar_model->getCalendarEvents($postData);
     
            // $to = "mottakaquezo68@gmail.com";
            $to = "test.02914@gmail.com";
            // $to = "german.pavlyak@forexmart.com";            
            $unsubscribe = 'p5VaF0qwHTREp5gLsPaW5';
            $res = $data[0][0];
            echo $to;
            $res['Forecast'] = $res['Forecast'] != null ? $res['Forecast'] : NULL;
            $res['Previous'] = $res['Previous'] != null ? $res['Previous'] : NULL;
            $res['Country'] = $this->countryToCurrency($res['Country']) ;
            Fx_mailer::test_economic_calendar($to,$unsubscribe , $res);
    }

    public function testing_economic_calendar_ru(){
        // exit;
        $lang=FXPP::html_url()!='ru'?'en':'ru';
        // $passDate = date('Y-m-d', strtotime('today'));
        $passDate = date('Y-m-d', strtotime('tomorrow'));
        $postData = array(
            'dateType' => $_POST['tab'],
            'date' => $passDate,
            'offset' => $_POST['start'],
            'limit' => 1,
            'priority' => 'High',
            'country' => $_POST['country'],
            'time' => 2,
            'language' => 'ru'
        );
            $data = $this->Calendar_model->getCalendarEvents($postData);
     
            // $to = "mottakaquezo68@gmail.com";
            $to = "test.02914@gmail.com";
            // $to = "german.pavlyak@forexmart.com";            
            $unsubscribe = 'p5VaF0qwHTREp5gLsPaW5';
            $res = $data[0][0];
            echo $to;
            $res['Forecast'] = $res['Forecast'] != null ? $res['Forecast'] : NULL;
            $res['Previous'] = $res['Previous'] != null ? $res['Previous'] : NULL;
            $res['Country'] = $this->countryToCurrency($res['Country']) ;
            Fx_mailer::test_economic_calendar_ru($to,$unsubscribe , $res);
    }

    private function countryToCurrency($country){
        $currency = 'USD';
        switch ($country) {
            case 'us':
                $currency = 'USD';
                break;
            case 'cn':
                $currency = 'CNY';
                break;
            case 'eu':
                $currency = 'EUR';
                break;
            case 'it':
                $currency = 'EUR';
                break;
            case 'au':
                $currency = 'AUD';
                break;
            case 'nz':
                $currency = 'NZD';
                break;
            case 'uk':
                $currency = 'EUR';
                break;
            case 'ca':
                $currency = 'CAD';
                break;
            case 'ja':
                $currency = 'JPY';
                break;
            case 'ge':
                $currency = 'EUR';
                break;
            case 'ch':
                $currency = 'CHF';
                break;    
            case 'es':
                $currency = 'EUR';
                break;                  
            case 'fr':
                $currency = 'CHF';
                break;  
            case 'ru':
                $currency = 'RUB';
                break;  
            case 'be':
                $currency = 'EUR';
                break; 
            default:
                $currency = 'USD';
                break;
        }

        return $currency;
    }

    private function insert($data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function calendar_tracker() {
        $file = 'https://www.forexmart.com/assets/images/mailer_image1x1.png';
        ob_end_clean();
        $this->output->set_header('Content-Type: images/');
        readfile($file);
        $data = array(
            'email' => $_GET['email'],
            'unsubscribe_key' => $_GET['key'],
            'date_opened' => date('Y-m-d H:i:s'),
            'email_id' => $_GET['email_id'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'ip_address2' => $_SERVER['HTTP_X_FORWARDED_FOR'],
        );
        $validator = $this->Calendar_model->checkEmailExist($data);
        if(!$validator){
            $this->Calendar_model->insertStatistics($data);
        }
    }
}
