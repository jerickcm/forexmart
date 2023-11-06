<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contest extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->g_m=$this->general_model;
        $this->load->model('account_model');
        $this->lang->load('contest');
    }

    public function index(){
        $this->ratings();
    }

    public function ranking(){
       $this->lang->load('moneyfall');
        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
        }else{
            $default_currency = 'USD';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['active'] = 1;
        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['isAutoScroll'] = true;

        $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
        $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
        $contest_data = $this->account_model->getContestWinners( $start_date, $end_date );
        if($contest_data){
            $rank = 0;
            $prev_value = 0;

        $start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
        $end_dates = date('Y-m-d 23:59:59', strtotime($start_dates . ' +4 days'));

            foreach($contest_data as $key => $value){

                if($prev_value <> $value['amount']){
                    $rank++;
                    $prev_value = $value['amount'];
                }

                $country_name = $this->g_m->getCountries($value['country']);
                if(!is_array($country_name)){
                    if($country_name){
                        $contest_data[$key]['country_name'] = $country_name;
                    }else{
                        $contest_data[$key]['country_name'] = '';
                    }
                }else{
                    $contest_data[$key]['country_name'] = '';
                }
                $contest_data[$key]['rank'] = $rank;

                $contest_data[$key]['start_end'] = date("m/d/Y", strtotime($start_dates))." - ". date("m/d/Y", strtotime($end_dates));

            }
        }
        $data['data']['rankings'] = $contest_data;

        $this->template->title(lang('ran_tit'))
            ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."contestpage.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."fonts.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 ")
            ->append_metadata_js("
                        <script src='".$this->template->Js()."jquery.validate.js'></script>
                         <script type='text/javascript'>
                                $(document).ready(function(){
                                     $('#PublicRatings a').addClass('active');
                                     $('#tab0').removeClass('active');
                                        $('#tab1').addClass('active');
                                     $('#tab2').removeClass('active');
                                     $('#tab3').removeClass('active');
                                 });
                         </script>
                                  <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                       <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                       <script src='".$this->template->Js()."Moment.js'></script>
                       <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                       <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                    ")
            ->set_layout('external/main')
            ->build('MoneyFall/rankings',$data['data']);
    }

    public function ratings(){
        $this->lang->load('moneyfall');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['tab'] = $this->load->view('MoneyFall/TabforMoneyFall', NULL, TRUE);

        require_once APPPATH.'/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
        $end_date = date('Y-m-d 22:59:59', strtotime($start_date . ' +6 days'));
        $contest_data = $this->account_model->getContestWinners( $start_date, $end_date );
        if($contest_data){
            $rank = 0;
            $prev_value = 0;
            foreach($contest_data as $key => $value){
                if($prev_value <> $value['amount']){
                    $rank++;
                    $prev_value = $value['amount'];
                }
                $contest_data[$key]['rank'] = $rank;
            }
        }
        $data['data']['rating'] = $contest_data;

        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
        }else{
            $default_currency = 'USD';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['active'] = 1;
        $data['data']['addin_price_specs'] = $this->load->view('MoneyFall/addin_price_specs', $data['data'], TRUE);
        $data['data']['addin_dates_notes'] = $this->load->view('MoneyFall/addin_dates_notes', $data['data'], TRUE);

        $data['return_insert']=false;
        $data['data']['countries'] =   $this->g_m->getCountries();

        $data['data']['metadata_description'] = lang('ran_dsc');
        $data['data']['metadata_keyword'] = lang('ran_kew');
        $this->template->title(lang('ran_tit'))
            ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."contestpage.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."fonts.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 ")
            ->append_metadata_js("
                        <script src='".$this->template->Js()."jquery.validate.js'></script>
                         <script type='text/javascript'>
                                $(document).ready(function(){
                                     $('#PublicRatings a').addClass('active');
                                     $('#tab0').removeClass('active');
                                        $('#tab1').addClass('active');
                                     $('#tab2').removeClass('active');
                                     $('#tab3').removeClass('active');
                                 });
                         </script>
                                  <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                       <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                       <script src='".$this->template->Js()."Moment.js'></script>
                       <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                       <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                    ")
            ->set_layout('external/main')
            ->build('MoneyFall/ratings',$data['data']);
    }

    public function winners(){
        $this->lang->load('moneyfall');

        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");

        $data['data']['insertsuccess'] = false;
        $data['return_insert'] = false;

        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
        }else{
            $default_currency = 'USD';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['active'] = 2;
        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

        $contest_date_start = date('m/d/Y', strtotime('last week monday', strtotime('tomorrow')));
        $data['data']['contest_date_start'] =  $contest_date_start;
        $data['data']['contest_date_end'] = date('m/d/Y', strtotime('friday', strtotime($contest_date_start)));

//        $data['data']['addin_price_specs'] = $this->load->view('MoneyFall/addin_price_specs', $data['data'], TRUE);
//        $data['data']['addin_dates_notes'] = $this->load->view('MoneyFall/addin_dates_notes', $data['data'], TRUE);

        $data['data']['countries'] =   $this->g_m->getCountries();
        //$data['data']['metadata_description'] = lang('win_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('win_kew');
        $this->template->title(lang('win_tit'))
            ->append_metadata_js("
                         <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                         <script src='".$this->template->Js()."jquery.validate.js'></script>

                <link rel='stylesheet' type='text/css' href='//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css'/>
                <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
                <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js'></script>
                          <script type='text/javascript'>
                            $(document).ready(function(){
                              $('#PublicWinners a').addClass('active');
                                    $('#tab2').addClass('active');
                             });
                         </script>
                    ")
            ->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'contestpage.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'fonts.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'select2-bootstrap.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'select2.css">
                 ')
            ->set_layout('external/main')
            ->build('MoneyFall/winners',$data['data']);
    }

//    public function Contestrules(){
//        $this->lang->load('moneyfall');
//        $this->lang->load('contestrules');
//
//        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//        $data['data']['tab'] = $this->load->view('MoneyFall/TabforMoneyFall', NULL, TRUE);
//        require_once APPPATH.'/helpers/recaptchalib_helper.php';
//        $this->load->helper(array('form', 'url'));
//        $this->load->library("pagination");
//        $this->load->library('form_validation');
//
//        $data['data']['custom_validation_success']='';
//        $data['data']['custom_validation']='';
//
//        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
//            $default_currency = 'EUR';
//        }else{
//            $default_currency = 'USD';
//        }
//        $data['data']['default_currency'] = $default_currency;
//
//        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
//        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//
//        $data['data']['insertsuccess']=false;
//
//        $data['return_insert']=false;
//
//        $data['data']['countries'] =   $this->g_m->getCountries();
//        $data['data']['metadata_description'] = lang('ccr_dsc');
//        $data['data']['metadata_keyword'] = lang('ccr_kew');
//        $js = $this->template->Js();
//        $this->template->title(lang('ccr_tit'))
//            ->append_metadata_js("
//                        <script src='".$js."jquery.validate.js'></script>
//                          <script type='text/javascript'>
//                            $(document).ready(function(){
//                              $('#PublicContestRules a').addClass('active');
//                                 $('#tab0').removeClass('active');
//                                 $('#tab1').removeClass('active');
//                                 $('#tab2').removeClass('active');
//                                    $('#tab3').addClass('active');
//                             });
//                         </script>
//                    ")
//            ->set_layout('external/main')
//            ->build('MoneyFall/rules',$data['data']);
//    }

    public function Contest_rulesTEST(){
        $this->lang->load('contestrules');
        $this->lang->load('moneyfall');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['tab'] = $this->load->view('MoneyFall/TabforMoneyFall', NULL, TRUE);
        $data['data']['addin_price_specs'] = $this->load->view('MoneyFall/addin_price_specs', NULL, TRUE);
        $data['data']['addin_dates_notes'] = $this->load->view('MoneyFall/addin_dates_notes', NULL, TRUE);
        require_once APPPATH.'/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $data['data']['custom_validation_success']='';
        $data['data']['custom_validation']='';

        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
        }else{
            $default_currency = 'USD';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['active'] = 3;

        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

        $data['data']['insertsuccess']=false;

        $data['return_insert']=false;

        $data['data']['countries'] =   $this->g_m->getCountries();
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';
        $js = $this->template->Js();
        $this->template->title("Money Fall - Contest Rules | ForexMart")
            ->append_metadata_js("
                        <script src='".$js."jquery.validate.js'></script>
                          <script type='text/javascript'>
                            $(document).ready(function(){
                              $('#PublicContestRules a').addClass('active');
                                 $('#tab0').removeClass('active');
                                 $('#tab1').removeClass('active');
                                 $('#tab2').removeClass('active');
                                    $('#tab3').addClass('active');
                             });
                         </script>
                    ")

            ->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'contestpage.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'fonts.min.css">
                 ')
            ->set_layout('external/main')
            ->build('MoneyFall/rulesZH',$data['data']);

    }

    public function Contest_rules(){
        $this->lang->load('contestrules');
        $this->lang->load('moneyfall');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['tab'] = $this->load->view('MoneyFall/TabforMoneyFall', NULL, TRUE);
        $data['data']['addin_price_specs'] = $this->load->view('MoneyFall/addin_price_specs', NULL, TRUE);
        $data['data']['addin_dates_notes'] = $this->load->view('MoneyFall/addin_dates_notes', NULL, TRUE);
        require_once APPPATH.'/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $data['data']['custom_validation_success']='';
        $data['data']['custom_validation']='';

        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
        }else{
            $default_currency = 'USD';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['active'] = 3;

        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

        $data['data']['insertsuccess']=false;

        $data['return_insert']=false;

        $data['data']['countries'] =   $this->g_m->getCountries();
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';
        $js = $this->template->Js();
        $this->template->title("Money Fall - Contest Rules | ForexMart")
            ->append_metadata_js("
                        <script src='".$js."jquery.validate.js'></script>
                          <script type='text/javascript'>
                            $(document).ready(function(){
                              $('#PublicContestRules a').addClass('active');
                                 $('#tab0').removeClass('active');
                                 $('#tab1').removeClass('active');
                                 $('#tab2').removeClass('active');
                                    $('#tab3').addClass('active');
                             });
                         </script>
                    ")

            ->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'contestpage.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'fonts.min.css">
                 ')
            ->set_layout('external/main')
            ->build('MoneyFall/rules',$data['data']);
    }



     public function Contest_archive(){

        $this->lang->load('moneyfall');

        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");

        $data['data']['insertsuccess'] = false;
        $data['return_insert'] = false;

        if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
            $default_currency = 'EUR';
        }else{
            $default_currency = 'USD';
        }
        $data['data']['default_currency'] = $default_currency;
        $data['data']['active'] = 4;
        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

        $contest_date_start = date('m/d/Y', strtotime('last week monday', strtotime('tomorrow')));
        $data['data']['contest_date_start'] =  $contest_date_start;
        $data['data']['contest_date_end'] = date('m/d/Y', strtotime('friday', strtotime($contest_date_start)));
        $data['data']['countries'] =   $this->g_m->getCountries();
       // $data['data']['metadata_description'] = lang('win_dsc');
         $data['data']['metadata_description'] = '';

         $data['data']['metadata_keyword'] = lang('win_kew');
        $this->template->title(lang('win_tit'))
            ->append_metadata_js("
                         <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                         <script src='".$this->template->Js()."jquery.validate.js'></script>

                <link rel='stylesheet' type='text/css' href='//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css'/>
                <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
                <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js'></script>
                <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
                <script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
                <script src='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/js/select2.min.js'></script>
                          <script type='text/javascript'>
                            $(document).ready(function(){
                              $('#PublicWinners a').addClass('active');
                                    $('#tab2').addClass('active');
                             });
                         </script>
                    ")
            ->append_metadata_css('
                 <link rel="stylesheet" href="'.$this->template->Css().'contestpage.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'fonts.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap.min.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'select2-bootstrap.css">
                 <link rel="stylesheet" href="'.$this->template->Css().'select2.css">
                 <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/css/select2.min.css" rel="stylesheet" />
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" />

                 ')
            ->set_layout('external/main')
            ->build('MoneyFall/archive',$data['data']);


    }


    public function test(){
        //Set Timezone to GMT + 02:00
        date_default_timezone_set('Europe/Minsk');
        $this->load->model('account_model');
        $contest_date_start =  date('Y-m-d 00:00:00', strtotime('last monday', strtotime('tomorrow')));
        $contest_date_end = date('Y-m-d 22:59:59', strtotime('next friday', strtotime('yesterday')));
        if( strtotime(date('m/d/Y H:is')) <= strtotime($contest_date_end) && strtotime(date('m/d/Y H:is')) >= strtotime($contest_date_start)) {
            //Get last week monday to sunday contest registrants
            $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
            $end_date = date('Y-m-d 22:59:59', strtotime($start_date . ' +6 days'));
            $contest_winners = $this->account_model->getContestAccountsByDateRange($start_date, $end_date);

            //Update account balances
            foreach ($contest_winners as $key => $value) {
                $WebService = new WebService();
                $account_number = $value['account_number'];
                $WebService->request_demo_account_balance($account_number);
                if ($WebService->request_status === 'RET_OK') {
                    $amount = $WebService->get_result('Balance');
                    $this->account_model->updateAmountByAccountNumber($account_number, $amount);
                }
            }

            //Get updated contest winners
            $contest_data = $this->account_model->getContestWinners( $start_date, $end_date );

            //Update winner list
            $winners = array();
            foreach($contest_data as $key => $value){
                $winners[] = array(
                    'start_date' => $contest_date_start,
                    'end_date' => $contest_date_end,
                    'user_id' => $value['user_id'],
                    'amount' => $value['amount'],
                    'currency' => $value['mt_currency_base'],
                    'account_number' => $value['account_number'],
                    'rank' => $value['rank']
                );
            }

            $this->account_model->updateCurrentWinners( $contest_date_start, $winners );
        }
    }

    public function contest_winners(){
        $this->load->model('account_model');
        $contest_date_start =  date('m/d/Y 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
        $contest_date_end = date('m/d/Y 22:59:59', strtotime($contest_date_start . ' +6 days'));
        $data = $this->account_model->getContestWinners( $contest_date_start, $contest_date_end );
    }

    public function getNickName(){
        if ($this->input->is_ajax_request()) {
            $this->load->model('account_model');
            $full_name = $this->input->post('full_name',true);
            $email = $this->input->post('email',true);
            $data = $this->account_model->getMoneyFallContestantByEmailFullName($email, $full_name);
            $this->output->set_content_type('application/json')->set_output(json_encode(array('nickname' => $data['NickName'])));
        }else{
            show_404();
        }
    }

    public function search_winners(){
        $draw = (int) $this->input->post('draw',true);
        $start = $this->input->post('start',true);
        $length = $this->input->post('length',true);
        $search_by = $this->input->post('search_by',true);
        $order = $this->input->post('order',true);
//        $search_to = $this->input->post('search_to');
        $search_from = $this->input->post('search_from',true);
        $search_key = $this->input->post('search_key',true);
        $test = array();

        switch ($order[0]['column']) {
            case 0:
                $order_by = 'contest_winners.start_date';
                break;
            case 1:
                $order_by = 'contest_winners.account_number';
                break;
            case 2:
                $order_by = 'contest_winners.nickname';
                break;
            case 3:
                $order_by = 'contestmoneyfall.City';
                break;
            case 4:
                $order_by = 'contest_winners.rank';
                break;
            default:
                $order_by = 'contest_winners.rank';
        }
        $order_sort = $order[0]['dir'];

        switch($search_by){
            case 0 : //by contest dates
                //validate and get contest start date


                if($search_from)
                {
                    $dateGet=explode("-",$search_from);
                    $start_date = date('Y-m-d', strtotime($dateGet[0]));
                    $end_date = date('Y-m-d', strtotime($dateGet[1]));

                }else{

                    if(date('N', strtotime('now')) >= 6){
                        $start_date = date('Y-m-d', strtotime('monday this week', strtotime('now')));
                    }else{
                        $start_date = date('Y-m-d', strtotime('monday last week', strtotime('now')));
                    }


                    if(date('N', strtotime('now')) >= 6){
                        $end_date = date('Y-m-d', strtotime('saturday this week', strtotime('now')));
                    }else{
                        $end_date = date('Y-m-d', strtotime('last saturday', strtotime('now')));
                    }

                }


                if(strtotime($start_date) > strtotime($end_date)){
                    $start_date = '';
                    $end_date = '';
                }
                $data_winners = $this->account_model->getAllContestWinnersByDates($start_date, $end_date);
              //  echo "<<<<<<<<<<<<<<".$this->db->last_query();exit;

                $winners = $this->account_model->getLimitAllContestWinnersByDates($length, $start, $start_date, $end_date, $order_by, $order_sort);
//                if(IPLoc::IPOnlyForMe()){
//                    echo "<<<<<<<<<<<<<<".$this->db->last_query();
//                }


                $test = array(
                    'date_from' => $start_date,
                    'date_to' => $end_date,
                    'd_start' => $start_date,
                    'd_end' => $end_date,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'last' => date('Y-m-d 22:59:59', strtotime('last friday', strtotime('yesterday')))
                );
                break;
            case 1 : //by account number
                $data_winners = $this->account_model->getAllContestWinnersByToken($search_key, 'account_number');
                $winners = $this->account_model->getLimitAllContestWinnersByToken($length, $start, $search_key, 'account_number', $order_by, $order_sort);
                break;
            case 2 : //by nickname
                $data_winners = $this->account_model->getAllContestWinnersByToken($search_key, 'nickname');
                $winners = $this->account_model->getLimitAllContestWinnersByToken($length, $start, $search_key, 'nickname', $order_by, $order_sort);
                break;
            default:
                $data_winners = array();
                $winners = array();
        }


//        switch($search_by){
//            case 0 : //by contest dates
//                //validate and get contest start date
//                $date_from = count($ex_s_date = explode('-', $search_from)) > 1 ? $ex_s_date[0] : $search_from;
//                $d_start = DateTime::createFromFormat('Y-m-d', $date_from);
//                if(strtotime($date_from)){
//                    $start_date = date('Y-m-d', strtotime($date_from));
//                }else{
//                    if(date('N', strtotime('now')) >= 6){
//                        $start_date = date('Y-m-d', strtotime('monday this week', strtotime('now')));
//                    }else{
//                        $start_date = date('Y-m-d', strtotime('monday last week', strtotime('now')));
//                    }
//                }
//                //validate and get contest end date
//                $date_to = count($ex_e_date = explode('-', $search_from)) > 1 ? $ex_e_date[1] : $search_from;
//                $d_end = DateTime::createFromFormat('Y-m-d', $date_to);
//                if(strtotime($date_to)){
//                    $end_date = date('Y-m-d', strtotime($date_to));
//                }else{
//                    if(date('N', strtotime('now')) >= 6){
//                        $end_date = date('Y-m-d', strtotime('saturday this week', strtotime('now')));
//                    }else{
//                        $end_date = date('Y-m-d', strtotime('last saturday', strtotime('now')));
//                    }
//                }
//
//                if(strtotime($date_from) > strtotime($date_to)){
//                    $start_date = '';
//                    $end_date = '';
//                }
//                $data_winners = $this->account_model->getAllContestWinnersByDates($start_date, $end_date);
//                $winners = $this->account_model->getLimitAllContestWinnersByDates($length, $start, $start_date, $end_date, $order_by, $order_sort);
//                $test = array(
//                    'date_from' => $date_from,
//                    'date_to' => $date_to,
//                    'd_start' => $d_start,
//                    'd_end' => $d_end,
//                    'start_date' => $start_date,
//                    'end_date' => $end_date,
//                    'last' => date('Y-m-d 22:59:59', strtotime('last friday', strtotime('yesterday')))
//                );
//                break;
//            case 1 : //by account number
//                $data_winners = $this->account_model->getAllContestWinnersByToken($search_key, 'account_number');
//                $winners = $this->account_model->getLimitAllContestWinnersByToken($length, $start, $search_key, 'account_number', $order_by, $order_sort);
//                break;
//            case 2 : //by nickname
//                $data_winners = $this->account_model->getAllContestWinnersByToken($search_key, 'nickname');
//                $winners = $this->account_model->getLimitAllContestWinnersByToken($length, $start, $search_key, 'nickname', $order_by, $order_sort);
//                break;
//            default:
//                $data_winners = array();
//                $winners = array();
//        }
        $winners_rows = array();
        $ctr_rank = 1;
        foreach( $winners as $key => $value ){
            $contest_date = date('m/d/Y', strtotime($value['start_date'])) . '-' . date('m/d/Y', strtotime($value['end_date']));
            $winner_rank = $this->account_model->getContestWinnerRank( $value['start_date'], $value['user_id'] );
            $winners_rows[] = array(
                $contest_date,
                $value['account_number'],
                $value['nickname'],
                $value['City'],
                $winner_rank['rank'], //$value['rank']
            );
            $ctr_rank++;
        }

        if( $order[0]['column'] == 4 ) {
            if( $order_sort == 'asc' ){
                usort($winners_rows, function ($a, $b) {
                    if ($a[4] == $b[4]) return 0;
                    return $a[4] < $b[4] ? 1 : -1;
                });
            }else{
                usort($winners_rows, function ($a, $b) {
                    if ($a[4] == $b[4]) return 0;
                    return $a[4] > $b[4] ? 1 : -1;
                });
            }
        }

        $data = array(
            'draw' => $draw,
            'recordsTotal' => count($data_winners),
            'recordsFiltered' => count($data_winners),
            'data' => $winners_rows,
            'start' => $start_date,
            'end' => $end_date,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    // public function search_Contest_Archive(){
    //     $draw = (int) $this->input->post('draw',true);
    //     $start = $this->input->post('start',true);
    //     $length = $this->input->post('length',true);
    //     $search_by = $this->input->post('search_by',true);
    //     $search_from = $this->input->post('search_from',true);
    //     $search_key = $this->input->post('search_key',true);
    //     $test = array();
    //     switch($search_by){
    //         case 0 : //by contest dates
    //             //validate and get contest start date
    //             $date_from = count($ex_s_date = explode('-', $search_from)) > 1 ? $ex_s_date[0] : $search_from;
    //             $d_start = DateTime::createFromFormat('Y-m-d 23:00:00', $date_from);
    //             if(strtotime($date_from)){
    //                 $start_date = date('Y-m-d 23:00:00', strtotime($date_from));
    //             }else{
    //                 if(date('N', strtotime('now')) >= 6){
    //                     $start_date = date('Y-m-d 23:00:00', strtotime('monday this week', strtotime('now')));
    //                 }else{
    //                     $start_date = date('Y-m-d 23:00:00', strtotime('monday last week', strtotime('now')));
    //                 }
    //             }
    //             //validate and get contest end date
    //             $date_to = count($ex_e_date = explode('-', $search_from)) > 1 ? $ex_e_date[1] : $search_from;
    //             $d_end = DateTime::createFromFormat('Y-m-d 22:59:59', $date_to);
    //             if(strtotime($date_to)){
    //                 $end_date = date('Y-m-d 22:59:59', strtotime($date_to));
    //             }else{
    //                 if(date('N', strtotime('now')) >= 6){
    //                     $end_date = date('Y-m-d 22:59:59', strtotime('friday this week', strtotime('now')));
    //                 }else{
    //                     $end_date = date('Y-m-d 22:59:59', strtotime('last friday', strtotime('now')));
    //                 }
    //             }

    //             if(strtotime($date_from) > strtotime($date_to)){
    //                 $start_date = '';
    //                 $end_date = '';
    //             }
    //             // echo "$start_date, $end_date";
    //             $start_date1 = date('d-m-Y 23:00:00', strtotime("-7 days", strtotime($start_date)));
    //             $end_date1 = date('d-m-Y 22:59:59', strtotime("-5 days", strtotime($end_date)));
    //             // echo "---->";
    //             // echo "$start_date, $end_date";

    //             // $this->load->library('IPLoc', null);
    //             // if(IPLoc::Office()){ 
    //               // $data_winners = $this->account_model->getAllContestArchiveByDatestest($start_date1, $end_date1);
    //               // $winners = $this->account_model->getLimitAllContestArchivetest($length, $start, $start_date1, $end_date1);
    //             // }else{
    //                 $data_winners = $this->account_model->getAllContestArchiveByDatestest($start_date, $end_date);
    //                 $winners = $this->account_model->getLimitAllContestArchivetest($length, $start, $start_date, $end_date);
    //             // }

    //             $test = array(
    //                 'date_from' => $date_from,
    //                 'date_to' => $date_to,
    //                 'd_start' => $d_start,
    //                 'd_end' => $d_end,
    //                 'start_date' => $start_date,
    //                 'end_date' => $end_date,
    //                 'last' => date('Y-m-d 22:59:59', strtotime('last friday', strtotime('yesterday')))
    //             );

    //             break;
    //         case 1 : //by account number
    //             $data_winners = $this->account_model->getAllContestArchiveByToken($search_key, 'account_number');
    //             $winners = $this->account_model->getLimitAllContestArchiveByToken($length, $start, $search_key, 'account_number');
    //             break;
    //         case 2 : //by nickname
    //             $data_winners = $this->account_model->getAllContestArchiveByToken($search_key, 'nickname');
    //             $winners = $this->account_model->getLimitAllContestArchiveByToken($length, $start, $search_key, 'nickname');
    //             break;
    //         default:
    //             $data_winners = array();
    //             $winners = array();
    //     }
    //     $winners_rows = array();
    //     $ctr_rank = 1;

    //     foreach( $winners as $key => $value ){
    //         $contest_date = date('m/d/Y', strtotime($value['start_date'])) . '-' . date('m/d/Y', strtotime($value['end_date']));
    //         // $winner_rank = $this->account_model->getContestWinnerRank( $value['start_date'], $value['user_id'] );

    //         $swap_free = $value['swap_free']=="1" ? "no" : "yes";
    //             $winners_rows[] = array(
    //             $value['account_number'],
    //             $value['nickname'],
    //             $value['ammount'],
    //             $swap_free,
    //             $value['leverage'],
    //             $contest_date 
    //         );
       
    //      $ctr_rank++;
    //     }

    //     $data = array(
    //         'draw' => $draw,
    //         'recordsTotal' => count($data_winners),
    //         'recordsFiltered' => count($data_winners),
    //         'data' => $winners_rows,
    //         'start' => $start_date,
    //         'end' => $end_date,
    //     );
    //     $this->output->set_content_type('application/json')->set_output(json_encode($data));
    // }
    public function search_Contest_Archive(){
        $draw = (int) $this->input->post('draw',true);
        $start = $this->input->post('start',true);
        $length = $this->input->post('length',true);
        $search_by = $this->input->post('search_by',true);
        $search_from = $this->input->post('search_from',true);
        $search_key = $this->input->post('search_key',true);
        $test = array();
        switch($search_by){
            case 0 : //by contest dates
                //validate and get contest start date
                $date_from = count($ex_s_date = explode('-', $search_from)) > 1 ? $ex_s_date[0] : $search_from;
                $d_start = DateTime::createFromFormat('Y-m-d', $date_from);
                if(strtotime($date_from)){
                    $start_date = date('Y-m-d', strtotime($date_from));
                }else{
                    if(date('N', strtotime('now')) >= 6){
                        $start_date = date('Y-m-d', strtotime('monday this week', strtotime('now')));
                    }else{
                        $start_date = date('Y-m-d', strtotime('monday last week', strtotime('now')));
                    }
                }
                //validate and get contest end date
                $date_to = count($ex_e_date = explode('-', $search_from)) > 1 ? $ex_e_date[1] : $search_from;
                $d_end = DateTime::createFromFormat('Y-m-d', $date_to);
                if(strtotime($date_to)){
                    $end_date = date('Y-m-d', strtotime($date_to));
                }else{
                    if(date('N', strtotime('now')) >= 6){
                        $end_date = date('Y-m-d', strtotime('saturday this week', strtotime('now')));
                    }else{
                        $end_date = date('Y-m-d', strtotime('last saturday', strtotime('now')));
                    }
                }

                if(strtotime($date_from) > strtotime($date_to)){
                    $start_date = '';
                    $end_date = '';
                }

                // $this->load->library('IPLoc', null);
                // if(IPLoc::Office()){ 
                  $data_winners = $this->account_model->getAllContestArchiveByDatestest($start_date, $end_date);

                  $winners = $this->account_model->getLimitAllContestArchivetest($length, $start, $start_date, $end_date);
                // }else{
                    // $data_winners = $this->account_model->getAllContestArchiveByDates($start_date, $end_date);
                    // $winners = $this->account_model->getLimitAllContestArchive($length, $start, $start_date, $end_date);
                // }

                // $test = array(
                //     'date_from' => $date_from,
                //     'date_to' => $date_to,
                //     'd_start' => $d_start,
                //     'd_end' => $d_end,
                //     'start_date' => $start_date,
                //     'end_date' => $end_date,
                //     'last' => date('Y-m-d 22:59:59', strtotime('last friday', strtotime('yesterday')))
                // );

                break;
            case 1 : //by account number
                if ($search_key != '') {
                    $data_winners = $this->account_model->getAllContestArchiveByToken($search_key, 'account_number');
                    $winners = $this->account_model->getLimitAllContestArchiveByToken($length, $start, $search_key, 'account_number');
                } else {
                    $result1 = $this->account_model->getAllContestArchive();
                    $result2 = $this->account_model->getLimitContestArchive($length, $start);

                    $array1 = array();
                    $array2 = array();

                    foreach ($result1['contest'] as $key1 => $res1) {
                        $num = 'key-'. $key1;
                        $array1[$num] = $res1;
                    }

                    foreach ($result1['mt'] as $key2 => $res2) {
                        $num1 = 'key-'. $key2;
                        $array2[$num1] = $res2;
                    }

                    $data_winners = array_replace_recursive($array1,$array2);

                    $array3 = array();
                    $array4 = array();

                    foreach ($result2['contest'] as $key1 => $res1) {
                        $num = 'key-'. $key1;
                        $array3[$num] = $res1;
                    }

                    foreach ($result2['mt'] as $key2 => $res2) {
                        $num1 = 'key-'. $key2;
                        $array4[$num1] = $res2;
                    }

                    $winners = array_replace_recursive($array3,$array4);
                }

                break;
            /*case 2 : //by nickname
                $data_winners = $this->account_model->getAllContestArchiveByToken($search_key, 'nickname');
                $winners = $this->account_model->getLimitAllContestArchiveByToken($length, $start, $search_key, 'nickname');
                break;*/
            default:
                $data_winners = array();
                $winners = array();
        }
        $winners_rows = array();
        $ctr_rank = 1;

        foreach( $winners as $key => $value ){
            $contest_date = date('m/d/Y', strtotime($value['start_date'])) . '-' . date('m/d/Y', strtotime($value['end_date']));
            // $winner_rank = $this->account_model->getContestWinnerRank( $value['start_date'], $value['user_id'] );

            $swap_free = $value['swap_free']=="1" ? "no" : "yes";
                $winners_rows[] = array(
                $value['account_number'],
                $value['nickname'],
                $value['amount'],
                $swap_free,
                $value['leverage'],
                $contest_date 
            );
       
         $ctr_rank++;
        }

        $data = array(
            'draw' => $draw,
            'recordsTotal' => count($data_winners),
            'recordsFiltered' => count($data_winners),
            'data' => $winners_rows,
            'start' => $start_date,
            'end' => $end_date,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    // vic  FXPP3739
    private function GetCodevalidate($length) {
        $loopcode = true;
        do {
            $key = '';
            $keys = array_merge(range(0, 9));

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }

            $loopcode = $this->g_m->showlike2($table = 'contestmoneyfall', $field = 'Code', $id = $key, $select = "Code");
        } while ($loopcode == true);


        return $key;
    }

    private $country_code;
    private $allow_register = true;
    private $user_country;


    public function registration(){
        $this->lang->load('moneyfall');
        $this->lang->load('moneyfallregistration');


        // test1 
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->form_validation->set_rules('FullName', 'FullName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('NickName', 'NickName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');

        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('swapfree', 'swapfree', 'trim|xss_clean');

        $data['data']['custom_validation_success'] = '';
        $data['data']['custom_validation'] = '';
        $data['data']['custom_validation1'] = '';
        
        $data['data']['insertsuccess'] = false;

        $data['return_insert'] = false;

        $data['data']['active'] = 0;
        $data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
        $data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['isAutoScroll'] = true;

        $data['data']['uniquefields'] = $this->g_m->showsfields($table = 'contestmoneyfall', 'FullName,Email,NickName');
        $data['data']['uniqueFullName'] = array();
        $data['data']['uniqueEmail'] = array();
        $data['data']['uniqueNickName'] = array();

        $data['data']['insertsuccess'] = false;

        $data['return_insert'] = false;
        foreach ($data['data']['uniquefields'] as $key => $value) {
            array_push($data['data']['uniqueNickName'], $value['NickName']);
        }

        if ($this->form_validation->run()) {
            if ($_POST["g-recaptcha-response"]) {

                if (in_array($this->input->post('NickName',true), $data['data']['uniqueNickName'])) {
                    $data['data']['custom_validation'].='NickName has already been used.';
                }

                if ($data['data']['custom_validation'] == '') {

                    $data['data']['gencode'] = $this->GetCodevalidate(6);

                    $data['insert'] = array(
                        'FullName' => $data['data']['Fullname'] = $this->input->post('FullName',true),
                        'Email' => $this->input->post('Email',true),
                        'NickName' => $this->input->post('NickName',true),
                        'Country' => $country = $this->input->post('Country',true),
                        'City' => $this->input->post('City',true),
                        'PhoneNumber' => $this->input->post('PhoneNumber',true),
                        'SwapFree' => $this->input->post('swapfree',true),
                        'Code' => $data['data']['gencode']
                    );

                    $data['return_insert'] = $this->g_m->insertmy($table = "contestmoneyfall", $data['insert']);
                }

                if ($data['return_insert'] != false) {
                    $data['insert'] = array(
                        'Title' => 'Thank you for signing up!',
                        'FullName' => $this->input->post('FullName',true),
                        'Code' => $data['data']['gencode'],
                        'Email' => $this->input->post('Email',true)
                    );
                    Fx_mailer::MoneyFallRegistrationCode($data['insert']);
                    $data['data']['insertsuccess'] = true;
                }
            } else {
                $data['data']['custom_validation1'].='Please verify reCAPTCHA';
            }
        } else {

        }

        if(IPLoc::Office()){
            $countrylist = $this->general_model->getAllCountries_localize();
        }else {
            $countrylist= $this->general_model->getAllCountries();
        }
        $set_value = isset($country)?$country:false;
        if($set_value!=false){

            $data['data']['countries'] = $this->general_model->selectOptionList($countrylist, $set_value);
        }else{

            $data['data']['countries'] = $this->general_model->selectOptionList($countrylist, $this->country_code);
        }

        $data['data']['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['data']['country_code'] = $this->country_code;
        /* country list and code coding close */
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';

        $data['data']['Operations'] = true;
        $data['data']['PermitIP'] = true;

        // test 1 end


        $this->template->title(lang('cmf_reg_tit'))
            ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."contestpage.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."fonts.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 ")
            ->append_metadata_js("
                    <script src='".$this->template->Js()."jquery.validate.js'></script>
                    <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                    <script src='".$this->template->Js()."Moment.js'></script>
                    <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                    <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                    <script src='https://www.google.com/recaptcha/api.js'></script>
                    <script src='" .$this->template->Js(). "pwstrength.js'></script>
                    <script type='text/javascript'>
                        $(document).ready(function(){
                            $('#tab0').addClass('active');
                              $('.registerlink').css('visibility','hidden');
                        });
                         $(document).on('change','#countrylist',function(){
                             var CName=$(this).val();
                             $.post('".FXPP::ajax_url()."contest/getCountryCode',{CName:CName},function(view){ 
                                $('#PhoneNumber').val(view);
                                console.log(view);
                            });
                             $.ajax({
                                type: 'POST',
                                url: '".FXPP::ajax_url()."contest/checkCountryLimit',
                                data: {country: $(this).val()},
                                dataType: 'json',
                                beforeSend: function(){
                                    $('#loader-holder').show();
                                },
                                success: function(response){
                                    if( response.banned ){
                                        $('#btnSubmit').attr('disabled', 'disabled');
                                        $('#register_restrict').modal('show');
                                    }else{
                                        $('#btnSubmit').removeAttr('disabled');
                                    }
                                    $('#loader-holder').hide();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    $('#loader-holder').hide();
                                }
                            });
                         });
                      </script>
                    ")
            ->set_layout('external/main')
            ->build('MoneyFall/registration',$data['data']);
        }

    public function getCountryCode() {
        $CName = $this->input->post('CName');
        echo $Ccode = $this->general_model->getCallingCode($CName);
    }


      public function checkCountryLimit(){
        if ($this->input->is_ajax_request()) {
            $country = $this->input->post('country');
            if(in_array(strtoupper($country), array('PL'))){
                $data['leverage_list'] = $this->general_model->selectOptionList($this->general_model->getLeverage(null, 100), isset($user_details['leverage']) ? $user_details['leverage'] : "1:100");
            }else{
                $data['leverage_list'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), isset($user_details['leverage']) ? $user_details['leverage'] : "1:200");
            }

            $illicit_country = unserialize(ILLICIT_COUNTRIES);
            if( in_array(strtoupper(trim($country)), $illicit_country) ){
                $data['banned'] = true;
            }else{
                $data['banned'] = false;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            show_404();
        }
    }
}