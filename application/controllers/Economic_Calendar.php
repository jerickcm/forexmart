<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Economic_Calendar extends MY_Controller {

    public function __construct(){
        parent::__construct();

    }

    public function Index(){
        //ISO 8601 week starts at monday ends in sunday
        $data['data']['yesterday'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 days")))->format('l, F j, Y'); // yesterday date
        $data['data']['today'] = DateTime::createFromFormat('Y-m-d H:i:s',   date('Y-m-d H:i:s'))->format('l, F j, Y'); // today date
        $data['data']['tomorrow'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("+1 days")))->format('l, F j, Y'); // tomorrow date


        // this week
        $data['data']['this_week'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday this week")))->format('l, F j, Y');
        $data['data']['this_tue'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("tuesday this week")))->format('l, F j, Y');
        $data['data']['this_wed'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("wednesday this week")))->format('l, F j, Y');
        $data['data']['this_thu'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("thursday this week")))->format('l, F j, Y');
        $data['data']['this_fri'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday this week")))->format('l, F j, Y');
        $data['data']['this_sat'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("saturday this week")))->format('l, F j, Y');
        $data['data']['this_sun'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("sunday this week")))->format('l, F j, Y');
        // next week
        $data['data']['next_week'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday next week ")))->format('l, F j, Y');
        $data['data']['next_tue'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("tuesday next week")))->format('l, F j, Y');
        $data['data']['next_wed'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("wednesday next week")))->format('l, F j, Y');
        $data['data']['next_thu'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("thursday next week")))->format('l, F j, Y');
        $data['data']['next_fri'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday next week")))->format('l, F j, Y');
        $data['data']['next_sat'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("saturday next week")))->format('l, F j, Y');
        $data['data']['next_sun'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("sunday next week")))->format('l, F j, Y');

        $data['data']['GMT'] = $this->general_model->getGMT();

        $url = 'https://api.import.io/store/connector/fb37250e-70c3-4a5f-b6ad-2c75afc6d07f/_query?input=webpage/url:http%3A%2F%2Fbiz.yahoo.com%2Fc%2Fe.html&&_apikey=e9578d4164524599b91db54cc02a7e249163095cd399be703e4c6aae397737ab29d71cf083802b7df2cbf92cbf5b8f02b3e112d643709c17ed8d1a319950d52b00e5ca964a14a837eba154df2b4622fb';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
        $data['data']['yahoo']=$json['results'];

        $data['data']['metadata_description'] = 'ForexMart is regulated by Calendar.';
        $data['data']['metadata_keyword'] = 'Calendar| ForexMart';
        $this->template->title("Calendar | ForexMart")

            ->append_metadata_css("
                 <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."select2.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."select2-bootstrap.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."flags32.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."flags16.css'>
             ")
            ->append_metadata_js("
                 <script type='text/javascript'>
                    window.alert = function() {};
                 </script>
                 <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                 <script src='".$this->template->Js()."Moment.js'></script>
                 <script src='".$this->template->Js()."datetime-moment.js'></script>
                 <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                 <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                  <script src='".$this->template->Js()."select2.js'></script>

            ")
            ->set_layout('external/main')
            ->build('economic_calendar/calendar',$data['data']);


    }




}
