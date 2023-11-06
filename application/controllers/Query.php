<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('General_model');
        $this->g_m=$this->General_model;
    }

    public function upload2(){

        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $user_id = $this->session->userdata('user_id');
        $data=array();
        if(!empty($_FILES['filename']['name'])){
            $this->load->helper(array('form', 'url'));
            $_FILES['userfile']['name']    = $_FILES['filename']['name'];
            $_FILES['userfile']['type']    = strtolower($_FILES['filename']['type']);
            $_FILES['userfile']['tmp_name'] = $_FILES['filename']['tmp_name'];
            $_FILES['userfile']['error']       = $_FILES['filename']['error'];
            $_FILES['userfile']['size']    = $_FILES['filename']['size'];

//            $config['file_name']     = sha1($_FILES['userfile']['name']);
            $config['file_name']     = hash('haval256,5',$_FILES['userfile']['name']);
            $config['upload_path'] = '/var/www/html/my.forexmart.com/assets/user_docs/';
            $config['allowed_types'] = 'gif|JPG|JPEG|jpg|jpeg|png|bmp|pdf';
            $config['max_size']      = '10000';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $config['overwrite']     = false; // DO NOT CHANGE
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload())
            {
                $uploadData = $this->upload->data();

                $updData = array(
                    'user_id' => $user_id,
                    'doc_type' => $this->input->post('doc_type',true),
                    'file_name' => $uploadData['file_name'],
                    'client_name' => $uploadData['client_name'],
                    'admn_upload_userid' => $this->session->userdata('user_id'),
                    'status' => 0,
                );

                $accountstatus= $this->g_m->showssingle($table='users',$field="id",$id=$user_id,$select="accountstatus");

                if ($accountstatus['accountstatus']!=1){
                    $data['newupload']=array(
                        'accountstatus'=>0,
                        'recent_fileupload'=> date('Y-m-d H:i:s')
                    );
                    $this->g_m->updatemy($table="users","id",$user_id,$data['newupload']);
                }

                $this->g_m->insertmy($table="user_documents",$updData);
                $data['error'] = false;

            }else{
                $data['msgError'] = $this->upload->display_errors();
                $data['error'] = true;
            }
        }else{
            $data['msgError'] = 'Please select a file.';
            $data['error'] = true;
        }
        echo json_encode($data);
    }

    public function upload(){

        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $user_id = $this->session->userdata('user_id');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
//        print_r($_FILES);
//        print_r($_POST);
//        die();

        if(!empty($_FILES['file']['name'])){
            $this->load->helper(array('form', 'url'));
            $_FILES['userfile']['name']    = $_FILES['file']['name'];
            $_FILES['userfile']['type']    = strtolower($_FILES['file']['type']);
            $_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
            $_FILES['userfile']['error']       = $_FILES['file']['error'];
            $_FILES['userfile']['size']    = $_FILES['file']['size'];
            $config['file_name']=  hash('sha384',$_FILES['userfile']['name']);// hash for external pages.
            $config['upload_path'] = '/var/www/html/my.forexmart.com/assets/user_docs/';
            $config['allowed_types'] = 'gif|JPG|JPEG|jpg|jpeg|png|bmp|pdf';
            $config['max_size']      = '10240';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $config['overwrite']     = false; //DO NOT CHANGE
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            try{
                if($this->upload->do_upload()){
                    $uploadData = $this->upload->data();
                    $updData = array(
                        'user_id' => $user_id,
                        'doc_type' => $this->input->post('doc_type',true),
                        'file_name' => $uploadData['file_name'],
                        'client_name' => $uploadData['client_name'],
                        'status' => 0,
                    );
                    $this->load->library('image_lib');
                    $config['source_image'] = "/var/www/html/my.forexmart.com/assets/user_docs/". $uploadData['file_name'];
                    /*if (substr(strtolower($uploadData['file_name']), -3)!='pdf'){
                        FXPP::setWaterMark($config['source_image']);
                    }*/
                    FXPP::setWaterMark($config['source_image']);

                    $this->g_m->insertmy($table="user_documents",$updData);
                    $data['error'] = false;
                    $data['msg'] = $this->image_lib->display_errors();
                    $data['msgError_ext']=false;
                }else{
                    $data['msgError'] = $this->upload->display_errors();
                    $data['error'] = true;

                    //http://php.net/manual/en/function.exif-imagetype.php
                    $data['filetype'] = exif_imagetype($_FILES['file']['tmp_name']);
                    $data['filetype2']=strtolower($_FILES['file']['type']);
                    $data['msgError_ext']=false;
                    switch(strtolower($_FILES['file']['type'])){
                        case 'image/gif':
                            if (exif_imagetype($_FILES['file']['tmp_name'])==1){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        case 'image/jpeg':
                            if (exif_imagetype($_FILES['file']['tmp_name'])==2){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        case 'image/png':
                            if (exif_imagetype($_FILES['file']['tmp_name'])==3){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        default:
                    }

                }
            } catch(Exception $e){


                $data['msgError_ext']=false;
                if (strpos($e->getMessage(), 'pdf') !== false) {
                    $data['msgError']="The PDF file type that you uploaded is not supported.";
                }else{
                    $data['msgError'] = $e->getMessage() ;
                }
//                $data['msgError'] =str_replace("/var/www/html/my.forexmart.com/assets/user_docs/", "",$e->getMessage() );
//                $data['msgError'] =str_replace("free parser shipped with FPDI. (See https://www.setasign.com/fpdi-pdf-parser for more details)", " upload engine.",$data['msgError'] );
                $data['error'] = true;
            }

        }else{
            $data['msgError'] = 'Please select a file.';
            $data['error'] = true;
        }
        echo json_encode($data);
    }
    public function us_id(){
        $user_id = $this->session->userdata('user_id');
        var_dump($user_id);
    }
    public function check_15reg_24hrs(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $data['login_type']= $this->input->post('login_type',true);
        $this->load->model('General_model');
        $this->load->model('Task_model');
        $this->g_m = $this->General_model;
        $this->t_m = $this->Task_model;

        if($data['login_type']){
            $today_partner_registration= $this->t_m->showView1Where3(
                $table='today_partner_registration',
                $field0='email',$id0=$this->input->post('email',true),
                $field1='full_name',$id1=$this->input->post('fullname',true),
                $field2='last_ip',$this->input->ip_address(),
                $select='count');
            if ($today_partner_registration){
                if( floatval($today_partner_registration['count'])>=15){
//                if( floatval($today_partner_registration['count'])>0){
                    $data['count']=$today_partner_registration['count'];
                    $data['return']=true; // registration > 15
                }else{
                    $data['count']=$today_partner_registration['count'];
                    $data['return']=false;
                }
            }
            echo json_encode($data);
        }else{
            $today_live_registration = $this->t_m->showView1Where3(
                $table='today_live_registration',
                $field0='email',$id0=$this->input->post('email',true),
                $field1='full_name',$id1=$this->input->post('fullname',true),
                $field2='last_ip',$this->input->ip_address(),
                $select='count');
            if ($today_live_registration){
                if( floatval($today_live_registration['count'])>=15){
//                if( floatval($today_live_registration['count'])>0){
                    $data['count']=$today_live_registration['count'];
                    $data['return']=true; // means registration > 15
                }else{
                    $data['count']=$today_live_registration['count'];
                    $data['return']=false;
                }
            }
            echo json_encode($data);
        }
    }

//    public function update_liveaccount_leverage_1k_5k(){
//        $this->load->model('General_model');
//        $this->g_m = $this->General_model;
//        $this->load->model('Task_model');
//        $this->t_m = $this->Task_model;
//        $this->db->trans_start();
//        $data['LiveAccounts'] = $this->t_m->get_liveaccounts();
//        foreach ($data['LiveAccounts'] as $key => $value) {
//            $webservice_config = array(
//                'server' => 'live_new'
//            );
//            $data = array(
//                'iLogin' => $value['account_number']
//            );
//            $WebService = new WebService($webservice_config);
//            $WebService->request_account_details($data);
//            if ($WebService->request_status === 'RET_OK') {
//                if ($WebService->get_result('Leverage')==1000){
//
//                    $WebService2 = new WebService($webservice_config);
//                    $account_info3 = array(
//                        'iLogin' => $WebService->get_result('LogIn'),
//                        'iLeverage' => '5000'
//                    );
//                    $WebService2->open_ChangeAccountLeverage($account_info3);
//                    if ($WebService2->request_status == 'RET_OK' ){
//
//                        $prvt_data['myleverage'] = array(
//                            'leverage' => '1:5000'
//                        );
//                        $prvt_data['Update_users'] = $this->g_m->updatemy($table = 'mt_accounts_set', $field = 'account_number', $id = $value['account_number'] , $prvt_data['myleverage']);
//                        if($prvt_data['Update_users'] ){
//                            echo "account_number : ".$value['account_number']." leverage 1000 is updated to <b>5000</b> <br/>";
//                        }
//                    }
//                }else{
//                    echo "account_number : ".$value['account_number']." leverage is  ".$WebService->get_result('Leverage')."<br/>";
//                }
//            }else{
//                echo "account_number : ".$value['account_number']." is invalid <br/>";
//            }
//        }
//        $this->db->trans_complete();
//    }

    public function resend_mfr(){
        //test
        if (IPLOC::Office_and_Vpn()){
            $data['insert'] = array(
                'Title' => 'Thank you for signing up!',
                'FullName' => 'Пержаница Сергей �?иколаевич',
                'Code' => 273033,
                'Email' => 'perg0176@mail.ru'
            );
            var_dump($data['insert']);
            Fx_mailer::MoneyFallRegistrationCode_resend($data['insert']);
        }

    }

    public function resend_landing(){
        //test
        if (IPLOC::Office_and_Vpn()){
            $data['insert'] = array(
                'Title' => 'Confirm your email address',
                'Fullname' =>"Kalai Selvan B.C",
                'Code' => 36140739932822438789,
                'Email' =>"ckselvan@hotmail.com"
            );
            Fx_mailer::Forexmart_Landing_RCode_resend($data['insert']);

        }
    }

    public function get_ch1(){

        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $webservice_config = array(
            'server' => 'chart_single'
        );
        $WebService = new WebService($webservice_config);
        $WebService->open_chart_GetCurrentQuotes();
        if ($WebService->result){
            $data['r0']=true; /*with api return*/
            $GetCurrentQuotesResult = (array)  $WebService->result;
            if($GetCurrentQuotesResult['ReqResult']){
                $data['r1'] = true; /*with ReqResult*/
                $Quotes = (array) $GetCurrentQuotesResult['Quotes'];

                foreach($Quotes['QuoteData'] as $object){

                    $symbol=$object->Symbol;
                    if ($symbol[0] == '#'){
                        $symbolid = substr($symbol, 1);
                    }else{
                        $symbolid=$object->Symbol;
                    }
                    $data['symbol'][$symbolid] = array(
                        'Ask' => $object->Ask,
                        'Bid' => $object->Bid,
                        'Digits' => $object->Digits,
                        'Direction' => $object->Direction,
                        'High' => $object->High,
                        'Low' => $object->Low,
                        'Spread' => $object->Spread,
                        'Symbol' => $object->Symbol,
                        'Timestamp' => $object->Timestamp
                    );

                }
                $WebServiceSecurities = new WebService($webservice_config);
                $WebServiceSecurities->open_chart_GetSecurtiesInfo();
                if ($WebServiceSecurities->result){

                    $GetSecurtiesInfoResult = (array)  $WebServiceSecurities->result;
                    $Bitcoin = (array) $GetSecurtiesInfoResult['Bitcoin'];
                    foreach($Bitcoin['SymbolData'] as $object){
                        $data['symbol']['Bitcoin']['CurrentPrice'] =$object->CurrentPrice;
                        $data['symbol']['Bitcoin']['Description'] =$object->Description;
                        $data['symbol']['Bitcoin']['PriceChangePercentage'] =$object->PriceChangePercentage;
                        $data['symbol']['Bitcoin']['PriceChangePips'] =$object->PriceChangePips;

                    }

                    $Forex = (array) $GetSecurtiesInfoResult['Forex'];
                    foreach($Forex['SymbolData'] as $object){

                        $symbol=$object->Symbol;
                        if ($symbol[0] == '#'){
                            $symbolid = substr($symbol, 1);
                        }else{
                            $symbolid=$object->Symbol;
                        }
                        $data['symbol'][$symbolid]['CurrentPrice'] =$object->CurrentPrice;
                        $data['symbol'][$symbolid]['Description'] =$object->Description;
                        $data['symbol'][$symbolid]['PriceChangePercentage'] =$object->PriceChangePercentage;
                        $data['symbol'][$symbolid]['PriceChangePips'] =$object->PriceChangePips;

                    }

                    $Metals = (array) $GetSecurtiesInfoResult['Metals'];
                    foreach($Metals['SymbolData'] as $object){
                        $symbol=$object->Symbol;
                        if ($symbol[0] == '#'){
                            $symbolid = substr($symbol, 1);
                        }else{
                            $symbolid=$object->Symbol;
                        }
                        $data['symbol'][$symbolid]['CurrentPrice'] =$object->CurrentPrice;
                        $data['symbol'][$symbolid]['Description'] =$object->Description;
                        $data['symbol'][$symbolid]['PriceChangePercentage'] =$object->PriceChangePercentage;
                        $data['symbol'][$symbolid]['PriceChangePips'] =$object->PriceChangePips;

                    }

                    $Shares = (array) $GetSecurtiesInfoResult['Shares'];
                    foreach($Shares['SymbolData'] as $object){

                        $symbol=$object->Symbol;
                        if ($symbol[0] == '#'){
                            $symbolid = substr($symbol, 1);
                        }else{
                            $symbolid=$object->Symbol;
                        }
                        $data['symbol'][$symbolid]['CurrentPrice'] = $object->CurrentPrice;
                        $data['symbol'][$symbolid]['Description'] = $object->Description;
                        $data['symbol'][$symbolid]['PriceChangePercentage'] = $object->PriceChangePercentage;
                        $data['symbol'][$symbolid]['PriceChangePips'] = $object->PriceChangePips;

                    }

                }


            }else{
                $data['r1']=true; /*Error ReqResult*/

            }

        }else{
            $data['r0']=false; /*no api return*/
        }



        $instance = $this->input->post('instance',true);
        $data['instance']= $instance;
        if($instance==1){
            $webservice_config = array(
                'server' => 'chart_single'
            );

            $initial_symbols=array(
                'EURCHF',
                '#AAPL',
                'GOLD',
                '#Bitcoin'
            );
            $dt = '';
            $count=0;
            foreach($initial_symbols as &$value){
                $count=$count+1;
                $WebServiceChart = new WebService($webservice_config);
                $dta = array(
                    'strSymbol' => $value
                );
                $WebServiceChart->open_chart_Request1MinuteTimeframeRates($dta);


                $Request1MinuteTimeframeRatesResult = (array)  $WebServiceChart->result;

                if($Request1MinuteTimeframeRatesResult['ReqResult']=='RET_OK'){
                    $Rates = (array) $Request1MinuteTimeframeRatesResult['Rates'];
                    $key=0;
                    foreach($Rates['RateData'] as $object){

                        $dt['chart'][$value][$key]['Rate'] = $object->Rate;
                        $dt['chart'][$value][$key]['Symbol'] = $object->Symbol;
                        $dt['chart'][$value][$key]['TimeStamp'] = $object->TimeStamp;

                        if ($value[0] == '#'){
                            $symbolid = substr($value, 1);
                        }else{
                            $symbolid=$value;
                        }

                        //                        $dt['chart']['tab'][$symbolid][$key]= floatval($object->Rate);
                        $dt['chart']['tab'][$symbolid][$key]= array(strtotime($object->TimeStamp)*1000,floatval($object->Rate));
                        $key=$key+1;
                    }
                    $data['response'][$count]='API OK';
                }else{
                    $data['response'][$count]='API Error';
                }


            }
            $data['chart']=$dt['chart'];
        }
        echo json_encode($data);
        unset($data);
        exit();
    }

    public function get_ch2(){

        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $symbol = $this->input->post('symbol',true);
        $chart = $this->input->post('chart',true);

        $webservice_config = array(
            'server' => 'chart_single'
        );

        $WebService = new WebService($webservice_config);

        $data = array(
            'strSymbol' => $symbol
        );

        $WebService->open_chart_Request1MinuteTimeframeRates($data);

        $Request1MinuteTimeframeRatesResult = (array)  $WebService->result;

        if($Request1MinuteTimeframeRatesResult['ReqResult']=='RET_OK'){

            $Rates = (array) $Request1MinuteTimeframeRatesResult['Rates'];
            $key=0;

            foreach($Rates['RateData'] as $object){
                $data['key'][$key]=array(
                    'Rate' => $object->Rate,
                    'Symbol' => $object->Symbol,
                    'TimeStamp' => $object->TimeStamp
                );
                if ($symbol[0] == '#'){
                    $symbolid = substr($symbol, 1);
                }else{
                    $symbolid=$symbol;
                }

                $dt['chart']['tab'][$key]= array(strtotime($object->TimeStamp)*1000,floatval($object->Rate));
                //                $dt['chart']['tab'][$symbolid][$key]= array(strtotime($object->TimeStamp)*1000,floatval($object->Rate));
                $key=$key+1;
            }
            $data['chart']=$dt['chart'];
            $data['r0']='API OK'; /*with api return*/
        }else{
            $data['r0']='API Error'; /*with api return*/

        }
        echo json_encode($data);
        unset($data);
        exit();
    }

    /*Home chart data request start*/

    public function get_instruments(){

        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $webservice_config = array(
            'server' => 'chart_single'
        );
        $WebService = new WebService($webservice_config);
        $WebService->open_chart_GetCurrentQuotes();
        if ($WebService->result){
            $data['r0']=true; /*with api return*/
            $GetCurrentQuotesResult = (array)  $WebService->result;
            if($GetCurrentQuotesResult['ReqResult']){
                $data['r1'] = true; /*with ReqResult*/
                $Quotes = (array) $GetCurrentQuotesResult['Quotes'];

                foreach($Quotes['QuoteData'] as $object){

                    $symbol=$object->Symbol;
                    if ($symbol[0] == '#'){
                        $symbolid = substr($symbol, 1);
                    }else{
                        $symbolid=$object->Symbol;
                    }
                    $data['symbol'][$symbolid] = array(
                        'Ask' => $object->Ask,
                        'Bid' => $object->Bid,
                        'Digits' => $object->Digits,
                        'Direction' => $object->Direction,
                        'High' => $object->High,
                        'Low' => $object->Low,
                        'Spread' => $object->Spread,
                        'Symbol' => $object->Symbol,
                        'Timestamp' => $object->Timestamp
                    );

                }


                $WebServiceSecurities = new WebService($webservice_config);
                $WebServiceSecurities->open_chart_GetSecurtiesInfo();
                if ($WebServiceSecurities->result){
                    $data['r3'] = true;
                    $GetSecurtiesInfoResult = (array)  $WebServiceSecurities->result;

                    $Bitcoin = (array) $GetSecurtiesInfoResult['Bitcoin'];
                    if ($GetSecurtiesInfoResult){
                        if($Bitcoin){
                            $data['r5']=true;
                        }else{
                            $data['r5']=false;
                        }
                        $data['r4']=true;
                    }else{
                        $data['r4']=false;
                    }


                    foreach($Bitcoin['SymbolData'] as $object){
                        $data['symbol']['Bitcoin']['CurrentPrice'] =$object->CurrentPrice;
                        $data['symbol']['Bitcoin']['Description'] =$object->Description;
                        $data['symbol']['Bitcoin']['PriceChangePercentage'] =$object->PriceChangePercentage;
                        $data['symbol']['Bitcoin']['PriceChangePips'] =$object->PriceChangePips;

                    }

                    $Forex = (array) $GetSecurtiesInfoResult['Forex'];
                    foreach($Forex['SymbolData'] as $object){

                        $symbol=$object->Symbol;
                        if ($symbol[0] == '#'){
                            $symbolid = substr($symbol, 1);
                        }else{
                            $symbolid=$object->Symbol;
                        }
                        $data['symbol'][$symbolid]['CurrentPrice'] =$object->CurrentPrice;
                        $data['symbol'][$symbolid]['Description'] =$object->Description;
                        $data['symbol'][$symbolid]['PriceChangePercentage'] =$object->PriceChangePercentage;
                        $data['symbol'][$symbolid]['PriceChangePips'] =$object->PriceChangePips;

                    }

                    $Metals = (array) $GetSecurtiesInfoResult['Metals'];
                    foreach($Metals['SymbolData'] as $object){
                        $symbol=$object->Symbol;
                        if ($symbol[0] == '#'){
                            $symbolid = substr($symbol, 1);
                        }else{
                            $symbolid=$object->Symbol;
                        }
                        $data['symbol'][$symbolid]['CurrentPrice'] = $object->CurrentPrice;
                        $data['symbol'][$symbolid]['Description'] = $object->Description;
                        $data['symbol'][$symbolid]['PriceChangePercentage'] = $object->PriceChangePercentage;
                        $data['symbol'][$symbolid]['PriceChangePips'] = $object->PriceChangePips;
                    }

                    $Shares = (array) $GetSecurtiesInfoResult['Shares'];
                    foreach($Shares['SymbolData'] as $object){

                        $symbol=$object->Symbol;
                        if ($symbol[0] == '#'){
                            $symbolid = substr($symbol, 1);
                        }else{
                            $symbolid=$object->Symbol;
                        }
                        $data['symbol'][$symbolid]['CurrentPrice'] = $object->CurrentPrice;
                        $data['symbol'][$symbolid]['Description'] = $object->Description;
                        $data['symbol'][$symbolid]['PriceChangePercentage'] = $object->PriceChangePercentage;
                        $data['symbol'][$symbolid]['PriceChangePips'] = $object->PriceChangePips;

                    }

                }else{
                    $data['r3'] = false;
                }


            }else{
                $data['r1']=true; /*Error ReqResult*/

            }

        }else{
            $data['r0']=false; /*no api return*/
        }



        $instance = $this->input->post('instance',true);
        $data['instance']= $instance;

        echo json_encode($data);
        unset($data);
        exit();
    }

    public function get_tab_instruments(){
        die();
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $instruments = array('#AAPL','#AMZN','#BAC','#BARC','#EBAY','#FB','#GOOG','#LNKD','#MSFT','#YHOO','GOLD','SILVER','XAUUSD','GOLDgr','XAGUSD','#Bitcoin');

        $webservice_config = array(
            'server' => 'chart_single'
        );
        foreach ($instruments as &$value) {
            $datax = array(
                'strSymbol' => $value
            );
            $WebService = new WebService($webservice_config);
            $WebService->open_chart_Request1MinuteTimeframeRates($datax);
            $Request1MinuteTimeframeRatesResult = (array)  $WebService->result;
            if ($value[0] == '#'){
                $symbolid = substr($value, 1);
            }else{
                $symbolid=$value;
            }

            $data[$symbolid]='';

            if($Request1MinuteTimeframeRatesResult['ReqResult']=='RET_OK'){
                $Rates = (array) $Request1MinuteTimeframeRatesResult['Rates'];
                foreach($Rates['RateData'] as $object){
                    $data[$symbolid].= '{';
                    $data[$symbolid].= '"Close":'.$object->Rate.',';
                    $data[$symbolid].= '"High":0,';
                    $data[$symbolid].= '"Low":0,';
                    $data[$symbolid].= '"Open":0,';
                    $data[$symbolid].= '"Stamp":"'.$object->TimeStamp.'",';
                    $data[$symbolid].= '"Symbol":"'.$object->Symbol.'",';
                    $data[$symbolid].= '"TimeFrame":1,';
                    $data[$symbolid].= '"Volume":0},';
                }
                $data[$symbolid]=  rtrim($data[$symbolid],',');
                $data['r0']='API OK';
            }else{
                $data['r0']='API Error'; /*with api return*/
                $data['err']=true;

            }
        }

        echo json_encode($data);
        unset($data);
        exit();
    }
    public function stats(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $emailtype = $this->input->post('emailtype',true);
        $period = $this->input->post('period',true);
        $this->load->model('Task_model');
        if($emailtype==0){
            if ($period=='month'){
                $data['statdata'] = $this->Task_model->getclickstat_period_month();
            }elseif($period=='week'){
                $data['statdata'] = $this->Task_model->getclickstat_period_week();
            }else{
                $data['statdata'] = $this->Task_model->getclickstat_period();
            }

        }else{

        }

        echo json_encode($data,JSON_NUMERIC_CHECK);
        unset($data);
        exit();

    }

    public function getTradeHistory(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['from'] = DateTime::createFromFormat('Y/d/m', $this->input->post('from',true));
        $data['none'] = DateTime::createFromFormat('Y/d/m', date('2015/01/01')); //
        $data['to'] = DateTime::createFromFormat('Y/d/m', $this->input->post('to',true));

        $data['from']->setTime(00,00,01);
        $data['to']->setTime(23,59,59);

        $data['trader']=$this->input->post('trader',true);
        $account_info = array(
            'iLogin' => $data['trader'],
            'from' =>   $this->input->post('from',true)!=''? $data['from']->format('Y-m-d\TH:i:s'): $data['none']->format('Y-m-d\TH:i:s'),
            'to' => $data['to']->format('Y-m-d\TH:i:s')
        );

        $webservice_config = array(
            'server' => 'live_new'
        );

        $WebService1 = new WebService($webservice_config);
        $WebService1->open_GetAccountTradesHistory($account_info);

        switch($WebService1->request_status){
            case 'RET_OK':
                $tradatalist = (array) $WebService1->get_result('TradeDataList');
                if($tradatalist) {


                    $closed='';
                    $data['data']['ClosedTotal']=0;
                    foreach ($tradatalist['TradeData'] as $object) {

                        $closed .= '<tr >';
                        $closed .= '<td>' . $object->OrderTicket . '</td>';
                        $closed .= '<td>' . $object->TradeType . '</td>';
                        $closed .= '<td>' . $object->Volume . '</td>';
                        $closed .= '<td>' . $object->Symbol . '</td>';
                        $closed .= '<td>' . $object->OpenPrice . '</td>';
                        $closed .= '<td>' . $object->StopLoss . '</td>';
                        $closed .= '<td>' . $object->TakeProfit . '</td>';
                        $closed .= '<td>' . $object->ClosePrice . '</td>';
                        $closed .= '<td>' . $object->Profit . '</td>';
                        $closed .= '</tr>';
                        $data['data']['ClosedTotal']= $data['data']['ClosedTotal']+floatval($object->Profit);


                    }

                    $data['data']['ClosedTotal']='
                                <tr class="total">
                                    <td colspan="8" align="right">Summary profit/loss : </td>
                                    <td id="closedtotal">'.$data['data']['ClosedTotal'].'</td>
                             </tr>
                    ';

                    $data['data']['Closed'] = $closed;
                }else{
                    $data['data']['history']='';
                    $data['data']['Closed']= '';

                    $data['data']['ClosedTotal']='
                             <tr class="total">
                                    <td colspan="8" align="right">Summary profit/loss : </td>
                                    <td id="closedtotal">0</td>
                             </tr>
                    ';
                }
                break;
            default:
                $data['data']['history']='';
                $data['data']['webservice']=' Server request error.';
                $data['HasError']=true;
        }

        $WebService2 = new WebService($webservice_config);
        $WebService2->open_GetBalanceMonitoringDataByDate($account_info);
        switch($WebService2->request_status){
            case 'RET_OK':
                $BalanceMonidtoringDataList = (array) $WebService2->get_result('BalanceMonidtoringDataList');
                $data['data']['Margin'] = array();
                $data['data']['Equity'] = array();
                $data['data']['Balance'] = array();
                foreach ($BalanceMonidtoringDataList['BalanceMonitorData'] as $object) {
                    $date = new DateTime($object->Stamp);
                    $data['Margin'] = array('x' =>strtotime($object->Stamp)*1000, 'y' =>  $object->Margin);
                    array_push($data['data']['Margin'], $data['Margin']);
                    $data['Equity'] = array('x' =>strtotime($object->Stamp)*1000, 'y' =>  $object->Equity);
                    array_push($data['data']['Equity'], $data['Equity']);
                    $data['Balance'] = array('x' => strtotime($object->Stamp)*1000, 'y' =>  $object->Balance);
                    array_push($data['data']['Balance'], $data['Balance']);
                }
                break;
            default:
                $data['data']['history']='';
                $data['data']['webservice']=' Server request error 2';
                $data['HasError']=true;
        }

        $data['data']['Margin']=  json_encode($data['data']['Margin'], JSON_NUMERIC_CHECK);
        $data['data']['Equity']=  json_encode($data['data']['Equity'], JSON_NUMERIC_CHECK);
        $data['data']['Balance']=  json_encode($data['data']['Balance'], JSON_NUMERIC_CHECK);

        echo json_encode($data['data']);
        unset($data);
    }

    public function sub_unsubaccount(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if($this->session->userdata('logged')){
            $this->lang->load('copytrade');
            $this->load->library('Fxpp_email');

            $data1['err2'] = false;
            $account_number = $_SESSION['account_number'];
            $user_id = $_SESSION['user_id'];
            $data1['account_number'] = $account_number;
            $data['masteraccount'] = $this->input->post('masteraccount',true);
            $data['request'] = trim($this->input->post('request',true));
            $data1['masteraccount'] = $data['masteraccount'];
            $data['ndb'] = $this->general_model->showssingle( $table='users',$field="id",$id=$user_id,$select="nodepositbonus",$order_by="");

            $ndbstat = false;
            $data1['nodeposit'] = 0;
            if($data['ndb']){
                if($data['ndb'] == 1){
                    $data1['nodeposit'] = 1;
                    $ndbstat = true;
                }
            }

            $data['acc1'] = 258739;
 //            $data['acc2'] = 258746;
            $data['acc2'] = 265782;
            $data['acc3'] = 258747;

            $session_account_number = $_SESSION['account_number'];

            $webservice_config = array('server' => 'minifcservice');

            $WS_I = new WebService($webservice_config);
            $account_info = array('iFollowerAccount' => $session_account_number);
            $WS_I->open_GetFollowerSubscriptionInfo($account_info);

            if ($WS_I->request_status === 'RET_OK') { // means with master subscription

                $data1['is_copy2'] = $WS_I->get_result('IsSubscribed');

                if( ($data['request']==lang('cpy_mon_box_but1')) and ($WS_I->get_result('IsSubscribed') == true) ){ // if request is COPY
                    $data1['is_copy'] = 2;

                }else if (($data['request']==lang('cpy_mon_box_but1')) and ($WS_I->get_result('IsSubscribed') == false) ){ // if request is COPY
                    $WS_S = new WebService($webservice_config);
                    $account_info = array(
                        'FollowerAccount' => $account_number,
                        'Is_NDB_Account' => $ndbstat,
                        'MasterTrader' => $data['masteraccount']
                    );
                    $WS_S->open_SubscribeToMasterAccount($account_info);
                    if ($WS_S->request_status === 'RET_OK') {
                        /*Email*/
                        $email_data = array(
                            'email' => $_SESSION['email'],
                        );
                        $logs['is_sent'] = Fxpp_email::ct_subscribe($email_data);
                        /*Email*/
                        $data1['is_copy'] = 1;
                        $data1['err']=false;

                    }else if ($WS_S->request_status === 'RET_ACCOUNT_ALREADY_SUBSCRIBED'){
                        $data1['is_copy'] = 3;
                    }else{
                        $data1['is_copy'] = 4;
                        $data1['err']=true;
                    }
                }else if($WS_I->get_result('IsSubscribed') == true){ // if request is UNSUBSCRIBE

                    $WS_U = new WebService($webservice_config);
                    $account_info = array(
                        'FollowerAccount' => $account_number,
                        'Is_NDB_Account' => $ndbstat,
                        'MasterTrader' => $data['masteraccount']
                    );
                    $WS_U->open_UnsubscribeAccount($account_info);
                    if ($WS_U->request_status === 'RET_OK') {
                        /*Email*/
                        $email_data=array(
                            'AN' => $account_number,
                            'MAN' => $data['masteraccount'],
                            'email' => $_SESSION['email']
                        );
                        $logs['is_sent'] = Fxpp_email::ct_unsubscribe($email_data);
                        /*Email*/
                        $data1['is_copy'] = 0;
                        $data1['err']=false;
                    }else{
                        $data1['err']=true;
                        $data1['is_copy'] = 11;
                    }

                }else{

                    $data1['is_copy'] = 5;
                }

            }elseif($WS_I->request_status === 'RET_ACCOUNT_NOT_FOUND'){ // means no master subscription yet
                if($data['request']==lang('cpy_mon_box_but1')){ // if request is COPY
                    $WS_S = new WebService($webservice_config);
                    $account_info = array(
                        'FollowerAccount' => $account_number,
                        'Is_NDB_Account' => $ndbstat,
                        'MasterTrader' => $data['masteraccount']
                    );
                    $WS_S->open_SubscribeToMasterAccount($account_info);
                    if ($WS_S->request_status === 'RET_OK') {
                        /*Email*/
                        $email_data = array(
                            'email' => $_SESSION['email'],
                        );
                        $logs['is_sent'] = Fxpp_email::ct_subscribe($email_data);
                        /*Email*/
                        $data1['is_copy'] = 1;
                        $data1['err']=false;

                    }else if ($WS_S->request_status === 'RET_ACCOUNT_ALREADY_SUBSCRIBED'){
                        $data1['is_copy'] = 6;
                    }else{
                        $data1['is_copy'] = 7;
                        $data1['err']=true;
                    }

                }else{ // if request is UNSUBSCRIBE
                    $data1['is_copy'] = 8;
                    $data1['err']=true;
                }
            }else{
                $data1['is_copy'] = 9;
                $data1['err']=true;
            }
            echo json_encode($data1);
            unset($data);

        }else{
            $data1['is_copy'] = 10;
            $data1['err2']=true;
            echo json_encode($data1);
            unset($data);
        }

    }


    public function live_accountmonitoring(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
//        $accnt_no = array(258739,258746,258747);
        $accnt_no = array(258739,265782,258747);

        $data2['Balance1']= array();
        $data2['Balance2']= array();
        $data2['Balance3']= array();

        $data2['Current_Balance1']= array();
        $data2['Current_Balance2']= array();
        $data2['Current_Balance3']= array();

        $data2['Current_Equity1']= array();
        $data2['Current_Equity2']= array();
        $data2['Current_Equity3']= array();

        $webservice_config = array(
            'server' => 'live_new'
        );

        foreach ($accnt_no as $key => $value) {



            //        $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 days")));
            $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 month")));
            $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
            $data['from']->setTime(00,00,01);
            $data['to']->setTime(23,59,59);

            $account_info = array(
                'iLogin' => $value,
                'from' => $data['from']->format('Y-m-d\TH:i:s'),
//            'from' => '2017-04-13T17:00:06',
                'to' => $data['to']->format('Y-m-d\TH:i:s')
            );

            $WS1 = new WebService($webservice_config);
            $WS1->open_GetBalanceMonitoringDataByDate($account_info);
            switch($WS1->request_status){
                case 'RET_OK':

                    $BalanceMonidtoringDataList = (array) $WS1->get_result('BalanceMonidtoringDataList');
                    foreach ($BalanceMonidtoringDataList['BalanceMonitorData'] as $object) {
                        $date = DateTime::createFromFormat('Y-m-d\TH:i:s',$object->Stamp);
                        $data['Balance'] = array('x' => $date->format('Y-m-d H:i:s'), 'y' =>  $object->Balance);
                        array_push($data2['Balance'.($key+1).''], $data['Balance']);
                    }
                    break;
                default:
            }


            $account_info = array(
                'iLogin' => $value
            );
            $WS_RAB = new WebService($webservice_config);
            $WS_RAB->open_RequestAccountBalance($account_info);
            switch($WS_RAB->request_status){
                case 'RET_OK':
                    $data2['Current_Balance'.($key+1).'']=  $this->roundno(floatval( $WS_RAB->get_result('Balance')),2);
                    $data2['Current_Equity'.($key+1).'']= $this->roundno(floatval( $WS_RAB->get_result('Equity')),2);
                    break;
                default:
                    $data2['Current_Balance'.($key+1).'']='0';
                    $data2['Current_Equity'.($key+1).'']='0';
            }


        }

        echo json_encode($data2,JSON_NUMERIC_CHECK);
        unset($data2);
        exit();

    }
    private function roundno($number,$dp) {
        return number_format((float)$number, $dp,'.','');
    }
    public function tagagents(){

        die();
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('Task_model');
        $accData = $this->Task_model->check_not_removedagent();

        foreach ( $accData as $key => $value) {
            echo $value['account_number'].'<br/>';
            $webservice_config = array('server' => 'live_new');
            $WSAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $value['account_number']);
            $WSAD->open_RequestAccountDetails($account_info);
            if ($WSAD->request_status === 'RET_OK') {
                $Agent = $WSAD->get_result('Agent');
                $regdate = $WSAD->get_result('RegDate');
                if ($Agent){
                    $removeData = array(
                        'account_number' => $value['account_number'],
                        'agent' => $Agent,
                        'date' =>  date('Y-m-d H:i:s'),
                        'api_registration' => $regdate
                    );
                    $this->general_model->insertmy($table = "test_agent_notremoved",$removeData);
                    $this->general_model->updatemy($table='mt_accounts_set','account_number',$value['account_number'],array('agent_ndbtag'=>'1'));
                }else{
                    $this->general_model->updatemy($table='mt_accounts_set','account_number',$value['account_number'],array('agent_ndbtag'=>'2'));
                }
            }else{
                $this->general_model->updatemy($table='mt_accounts_set','account_number',$value['account_number'],array('agent_ndbtag'=>'3'));
            }
        }
        $data='OK';
        echo json_encode($data);
        unset($data);
        exit();

    }


    public function tag_managerremoved(){
        die();
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('Task_model');
        $accData = $this->Task_model->check_agentremovedbymanager();
        foreach ( $accData as $key => $value) {
            echo $value['account_number'].'<br/>';
            $webservice_config = array('server' => 'live_new');
            $WSAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $value['account_number']);
            $WSAD->open_RequestAccountDetails($account_info);
            if ($WSAD->request_status === 'RET_OK') {
                $Agent = $WSAD->get_result('Agent');
                $regdate = $WSAD->get_result('RegDate');

                $updateData = array(
                    'account_number' => $value['account_number'],
                    'agent' => $Agent,
                    'date' =>  date('Y-m-d H:i:s'),
                    'api_registration' => $regdate,
                    'status' => 1
                );

                $this->general_model->updatemy($table='test_removedagent_others','account_number',$value['account_number'],$updateData);

            }else{

                $this->general_model->updatemy($table='test_removedagent_others','account_number',$value['account_number'],array('status'=>'2'));

            }
        }

        $data='OK';
        echo json_encode($data);
        unset($data);
        exit();


    }

    public function getaffcode(){
        die();
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('Task_model');
        $accData = $this->Task_model->check_agent();
        foreach ( $accData as $key => $value){
            echo $value['account_number'].'<br/>';
            $mtas = $this->general_model->showssingle($table='mt_accounts_set',$field="account_number",$id=$value['account_number'],$select="user_id",$order_by="");
            $uac = $this->general_model->showssingle($table='users_affiliate_code',$field="users_id",$id=$mtas['user_id'],$select="referral_affiliate_code",$order_by="");
            if($uac){
                $this->load->model('account_model');
                $getAccountNumberByAffiliateCode = $this->account_model->getAccountNumberByCode($uac['referral_affiliate_code']);
                $AgentAccountNumber = $getAccountNumberByAffiliateCode['account_number'];
                $updateData = array(
                    'agent' => $AgentAccountNumber,
                    'status_agent' =>1
                );
                $this->general_model->updatemy($table='test_removedagent_others','account_number',$value['account_number'],$updateData);
            }
        }

        $data='OK';
        echo json_encode($data);
        unset($data);
        exit();
    }
    public function data2(){
        die();
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('Task_model');
        $accData = $this->Task_model->data2();
        foreach ( $accData as $key => $value) {
            echo $value['account_number'].'<br/>';
            $webservice_config = array('server' => 'live_new');
            $WSAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $value['account_number']);
            $WSAD->open_RequestAccountDetails($account_info);

            if ($WSAD->request_status === 'RET_OK') {

                $Agent = $WSAD->get_result('Agent');
                $regdate = $WSAD->get_result('RegDate');
                $updateData = array(
                    'agent' => $Agent,
                    'date' =>  date('Y-m-d H:i:s'),
                    'api_registration' => $regdate,
                    'status' => 1
                );

                $this->general_model->updatemy($table='test_ndbremovedagents','account_number',$value['account_number'],$updateData);

            }else{

                $this->general_model->updatemy($table='test_ndbremovedagents','account_number',$value['account_number'],array('status'=>'2'));

            }
        }

        $data='OK';
        echo json_encode($data);
        unset($data);
        exit();

    }

    public function getaffcodedata2(){
        die();
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('Task_model');
        $accData = $this->Task_model->check_agent_data2();
        foreach ( $accData as $key => $value){
            echo $value['account_number'].'<br/>';
            $mtas = $this->general_model->showssingle($table='mt_accounts_set',$field="account_number",$id=$value['account_number'],$select="user_id",$order_by="");
            $uac = $this->general_model->showssingle($table='users_affiliate_code',$field="users_id",$id=$mtas['user_id'],$select="referral_affiliate_code",$order_by="");
            if($uac){
                $this->load->model('account_model');
                $getAccountNumberByAffiliateCode = $this->account_model->getAccountNumberByCode($uac['referral_affiliate_code']);
                $AgentAccountNumber = $getAccountNumberByAffiliateCode['account_number'];
                $updateData = array(
                    'agent' => $AgentAccountNumber,
                    'status_agent' =>1
                );
                $this->general_model->updatemy($table='test_ndbremovedagents','account_number',$value['account_number'],$updateData);
            }
        }

        $data='OK';
        echo json_encode($data);
        unset($data);
        exit();
    }
    public function checkinactiveaccounts(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        if (!IPLOC::Office_and_Vpn()){die();}
        $data='OK';

        $this->load->model('Task_model');
        $accData = $this->Task_model->checklive();

        foreach ( $accData as $key => $value) {

            echo $value['account_number'] . '<br/>';

            $webservice_config = array('server' => 'live_new');
            $WSAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $value['account_number']);
            $WSAD->open_RequestAccountDetails($account_info);
            if ($WSAD->request_status === 'RET_ACCOUNT_NOT_FOUND') {
                $data['in']=2;
                $updateData = array(
                    'check_inactivity' => 2
                );
                $this->general_model->updatemy($table='mt_accounts_set','account_number',$value['account_number'],$updateData);
            }else{
                $data['in']=3;
                $updateData = array(
                    'check_inactivity' => 3
                );
                $this->general_model->updatemy($table='mt_accounts_set','account_number',$value['account_number'],$updateData);
            }

        }


        echo json_encode($data);
        unset($data);
        exit();

    }
    public function live_accountmonitoring_viktor(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $accnt_no = array(282901,282886,282882);
        //        $accnt_no = array(258739,258746,258747); //old
        $data2['Balance1']= array();
        $data2['Balance2']= array();
        $data2['Balance3']= array();

        $data2['Current_Balance1']= array();
        $data2['Current_Balance2']= array();
        $data2['Current_Balance3']= array();

        $data2['Current_Equity1']= array();
        $data2['Current_Equity2']= array();
        $data2['Current_Equity3']= array();

        $webservice_config = array(
            'server' => 'live_new'
        );

        foreach ($accnt_no as $key => $value) {
            //$data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 days")));
            $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 month")));
            $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
            $data['from']->setTime(00,00,01);
            $data['to']->setTime(23,59,59);

            $account_info = array(
                'iLogin' => $value,
                'from' => $data['from']->format('Y-m-d\TH:i:s'),
//            'from' => '2017-04-13T17:00:06',
                'to' => $data['to']->format('Y-m-d\TH:i:s')
            );

            $WS1 = new WebService($webservice_config);
            $WS1->open_GetBalanceMonitoringDataByDate($account_info);
            switch($WS1->request_status){
                case 'RET_OK':

                    $BalanceMonidtoringDataList = (array) $WS1->get_result('BalanceMonidtoringDataList');
                    foreach ($BalanceMonidtoringDataList['BalanceMonitorData'] as $object) {
                        $date = DateTime::createFromFormat('Y-m-d\TH:i:s',$object->Stamp);
                        $data['Balance'] = array('x' => $date->format('Y-m-d H:i:s'), 'y' =>  $object->Balance);
                        array_push($data2['Balance'.($key+1).''], $data['Balance']);
                    }
                    break;
                default:
            }

            $account_info = array(
                'iLogin' => $value
            );
            $WS_RAB = new WebService($webservice_config);
            $WS_RAB->open_RequestAccountBalance($account_info);
            switch($WS_RAB->request_status){
                case 'RET_OK':
                    $data2['Current_Balance'.($key+1).'']=  $this->roundno(floatval( $WS_RAB->get_result('Balance')),2);
                    $data2['Current_Equity'.($key+1).'']= $this->roundno(floatval( $WS_RAB->get_result('Equity')),2);
                    break;
                default:
                    $data2['Current_Balance'.($key+1).'']='0';
                    $data2['Current_Equity'.($key+1).'']='0';
            }

        }

        echo json_encode($data2,JSON_NUMERIC_CHECK);
        unset($data2);
        exit();

    }
    public function sub_unsubaccount_viktor(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if($this->session->userdata('logged')){
            $this->lang->load('copytrade');
            $this->load->library('Fxpp_email');

            $data1['err2'] = false;
            $account_number = $_SESSION['account_number'];
            $user_id = $_SESSION['user_id'];
            $data1['account_number'] = $account_number;
            $data['masteraccount'] = $this->input->post('masteraccount',true);
            $data['request'] = trim($this->input->post('request',true));
            $data1['masteraccount'] = $data['masteraccount'];
            $data['ndb'] = $this->general_model->showssingle( $table='users',$field="id",$id=$user_id,$select="nodepositbonus",$order_by="");

            $ndbstat = false;
            $data1['nodeposit'] = 0;
            if($data['ndb']){
                if($data['ndb'] == 1){
                    $data1['nodeposit'] = 1;
                    $ndbstat = true;
                }
            }

            $data['acc1'] = 282901;
            $data['acc2'] = 282886;
            $data['acc3'] = 282882;

            $session_account_number = $_SESSION['account_number'];

            $webservice_config = array('server' => 'minifcservice');

            $WS_I = new WebService($webservice_config);
            $account_info = array('iFollowerAccount' => $session_account_number);
            $WS_I->open_GetFollowerSubscriptionInfo($account_info);

            if ($WS_I->request_status === 'RET_OK') { // means with master subscription

                $data1['is_copy2'] = $WS_I->get_result('IsSubscribed');

                if( ($data['request']==lang('cpy_mon_box_but1')) and ($WS_I->get_result('IsSubscribed') == true) ){ // if request is COPY
                    $data1['is_copy'] = 2;

                }else if (($data['request']==lang('cpy_mon_box_but1')) and ($WS_I->get_result('IsSubscribed') == false) ){ // if request is COPY
                    $WS_S = new WebService($webservice_config);
                    $account_info = array(
                        'FollowerAccount' => $account_number,
                        'Is_NDB_Account' => $ndbstat,
                        'MasterTrader' => $data['masteraccount']
                    );
                    $WS_S->open_SubscribeToMasterAccount($account_info);
                    if ($WS_S->request_status === 'RET_OK') {
                        /*Email*/
                        $email_data = array(
                            'email' => $_SESSION['email'],
                        );
                        $logs['is_sent'] = Fxpp_email::ct_subscribe_vd($email_data);
                        /*Email*/
                        $data1['is_copy'] = 1;
                        $data1['err']=false;

                    }else if ($WS_S->request_status === 'RET_ACCOUNT_ALREADY_SUBSCRIBED'){
                        $data1['is_copy'] = 3;
                    }else{
                        $data1['is_copy'] = 4;
                        $data1['err']=true;
                    }
                }else if($WS_I->get_result('IsSubscribed') == true){ // if request is UNSUBSCRIBE

                    $WS_U = new WebService($webservice_config);
                    $account_info = array(
                        'FollowerAccount' => $account_number,
                        'Is_NDB_Account' => $ndbstat,
                        'MasterTrader' => $data['masteraccount']
                    );
                    $WS_U->open_UnsubscribeAccount($account_info);
                    if ($WS_U->request_status === 'RET_OK') {
                        /*Email*/
                        $email_data=array(
                            'AN' => $account_number,
                            'MAN' => $data['masteraccount'],
                            'email' => $_SESSION['email']
                        );
                        $logs['is_sent'] = Fxpp_email::ct_unsubscribe_vd($email_data);
                        /*Email*/
                        $data1['is_copy'] = 0;
                        $data1['err']=false;
                    }else{
                        $data1['err']=true;
                        $data1['is_copy'] = 11;
                    }

                }else{

                    $data1['is_copy'] = 5;
                }

            }elseif($WS_I->request_status === 'RET_ACCOUNT_NOT_FOUND'){ // means no master subscription yet
                if($data['request']==lang('cpy_mon_box_but1')){ // if request is COPY
                    $WS_S = new WebService($webservice_config);
                    $account_info = array(
                        'FollowerAccount' => $account_number,
                        'Is_NDB_Account' => $ndbstat,
                        'MasterTrader' => $data['masteraccount']
                    );
                    $WS_S->open_SubscribeToMasterAccount($account_info);
                    if ($WS_S->request_status === 'RET_OK') {
                        /*Email*/
                        $email_data = array(
                            'email' => $_SESSION['email'],
                        );
                        $logs['is_sent'] = Fxpp_email::ct_subscribe($email_data);
                        /*Email*/
                        $data1['is_copy'] = 1;
                        $data1['err']=false;

                    }else if ($WS_S->request_status === 'RET_ACCOUNT_ALREADY_SUBSCRIBED'){
                        $data1['is_copy'] = 6;
                    }else{
                        $data1['is_copy'] = 7;
                        $data1['err']=true;
                    }

                }else{ // if request is UNSUBSCRIBE
                    $data1['is_copy'] = 8;
                    $data1['err']=true;
                }
            }else{
                $data1['is_copy'] = 9;
                $data1['err']=true;
            }
            echo json_encode($data1);
            unset($data);

        }else{
            $data1['is_copy'] = 10;
            $data1['err2']=true;
            echo json_encode($data1);
            unset($data);
        }

    }

    public function get_livequotes(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data='';
        $data['symbol']= $this->input->post('symbol',true);

        if ($data['symbol']=='Bitcoin'){
            $data['symbol']='#Bitcoin';
        }
        $data2['tick']= array();
        $Request1MinuteTimeframeRates1  = array(
            'AAPL',
            'AMZN',
            'BAC',
            'BARC',
            'EBAY',
            'FB',
            'GOOG',
            'LNKD',
            'MSFT',
            'YHOO',
        );

        if (in_array($data['symbol'], $Request1MinuteTimeframeRates1)) {
            $data['symbol']='#'.$data['symbol'];
        }

        $webservice_config = array(
            'server' => 'chart_single'
        );

        $WebServiceChart = new WebService($webservice_config);

        $WebServiceLast = new WebService($webservice_config);
        $datasym = array(
            'strSymbol' => $data['symbol']
        );
        $WebServiceLast->open_chart_GetSymbolLatestQuoteData($datasym);
        $WSL =  $WebServiceLast->result;

        $data_in['to'] = DateTime::createFromFormat('Y-m-d\TH:i:s',$WSL->Timestamp);
        $data_in['from'] = date("Y-m-d\TH:i:s", strtotime("-1 hour", strtotime($WSL->Timestamp)));
        $datax = array(
            'strSymbol' => $data['symbol'],
            'from' =>  $data_in['from'],
            'to' => $data_in['to']->format('Y-m-d\TH:i:s')
        );
        $data['tick']='';
        $WebServiceChart->open_chart_GetTicksHistory($datax);
        $GetTicksHistoryResult = (array)  $WebServiceChart->result;
        if($GetTicksHistoryResult['Message']=='RET_OK'){

            $Ticks = (array) $GetTicksHistoryResult['Ticks'];
            $key=0;
            foreach($Ticks['TickInfo'] as $object){

                $data['chart'][$key]['date'] = strtotime($object->TimeStamp)*1000;
                $data['chart'][$key]['ask'] = $object->Ask;
                $data['chart'][$key]['bid'] = $object->Bid;
                $data['chart'][$key]['digits'] = $object->Digits;
                $data['chart'][$key]['direction'] = $object->Direction;
                $data['chart'][$key]['high'] = $object->High;
                $data['chart'][$key]['low'] =  $object->Low;
                $data['chart'][$key]['spread'] =   $object->Spread;
                $data['chart'][$key]['symbol'] =    $object->Symbol;
                $data['chart'][$key]['digits'] = $object->Digits;
                $key = $key + 1;
            }
        }

        echo json_encode($data);
        unset($data2);
        exit();

    }

}
