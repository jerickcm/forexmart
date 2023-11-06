<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickchart extends CI_Controller {


    public function index2(){

        /*charts*/
        $chart['forex'] = array(
            'AUDUSD',
            'EURCHF',
            'EURGBP',
            'EURJPY',
            'EURUSD',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY');

        $chart['fx']='';

        foreach($chart['forex'] as &$value){
            if ($value=='AUDUSD'){
                $chart_tr['symbl_default'] = 'defaultforex';
            }else{
                $chart_tr['symbl_default'] ='';
            }

            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'fx';

            $chart['fx'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);
        }
        $chart['shares'] = array(
            'AAPL',
            'AMZN',
            'BAC',
            'BARC',
            'EBAY',
            'FB',
            'GOOG',
            'LNKD',
            'MSFT',
            'YHOO'
        );

        $chart['share'] = '';

        foreach($chart['shares'] as &$value){
            if ($value=='AAPL'){
                $chart_tr['symbl_default'] = 'defaultshares';
            }else{
                $chart_tr['symbl_default'] ='';
            }

            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = '#'.$value;
            $chart_tr['tr_cls'] = 'sh';

            $chart['share'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }
        $chart['metals'] = array(
            'GOLD',
            'SILVER',
            'XAUUSD',
            'GOLDgr',
            'XAGUSD'
        );

        foreach($chart['metals'] as &$value){
            if ($value=='GOLD'){
                $chart_tr['symbl_default'] = 'defaultmetals';
            }else{
                $chart_tr['symbl_default'] ='';
            }
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'mt';

            $chart['metal'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $chart['bitcoin'] = array(
            'Bitcoin'
        );

        foreach($chart['bitcoin'] as &$value){
            if ($value=='Bitcoin'){
                $chart_tr['symbl_default'] = 'defaultbitcoin';
            }else{
                $chart_tr['symbl_default'] ='';
            }
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'bt';
            $chart['bt'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);
        }

        $chart['tab']=0;
        $data['chart'] = $this->load->view('widget/chart_design', $chart ,TRUE);
        /*charts*/

        $forex = array(
            'AUDUSD',
            'EURGBP',
            'EURCHF',
            'EURJPY',
            'EURUSD',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY'
        );

        $webservice_config = array(
            'server' => 'chart_single'
        );


        foreach ($forex as &$value) {

            $webservice_config = array(
                'server' => 'chart_single'
            );
            $WebServiceChart = new WebService($webservice_config);

            //ISO 8601 week starts at monday ends in sunday

            //php server time + 2hrs to offset the api server time
            $weekend=array('Sat','Sun');
            $weekdaysExceptMonday=array('Tue','Wed','Thu','Fri');
            //add offset of 2 hrs php servertime is behind 2hrs in API Method
            //$serverAPIday = date('D', time());
            $serverAPIday = date('D', strtotime("+2 hour"));

            if(in_array($serverAPIday,$weekend)){
                $datefriday =(date('Y-m-d H:i:s',strtotime("friday this week")));
                $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
                $data_in['from']->setTime(22,00,00);
                $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
                $data_in['to']->setTime(23,0,0);

                $data['from']=  $data_in['from'];
                $data['to']=  $data_in['to'];
                //}else if(date('D', time()) === 'Mon'){
                //add offset of 2 hrs php servertime is behind 2hrs in API Method
            }else if(date('D', strtotime("+2 hour")) === 'Mon'){
                $hr = (int) date('H');
                if ( $hr < 6 ){ //php server time 6am , api chart time 8am
                    $datefriday =(date('Y-m-d H:i:s',strtotime("last week friday")));
                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
                    $data_in['from']->setTime(22,00,00);
                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
                    $data_in['to']->setTime(23,0,0);
                }else{
                    $data_in['from'] = date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))));
                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );
                    $data_in['to'] = date("Y-m-d H:i:s", strtotime("+2 hour", strtotime(date('Y-m-d H:i:s'))));
                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_in['to']);
                }
                $data['time'] = $hr;
                $data['from']=  $data_in['from'];
                $data['to']=  $data_in['to'];

            }else if(in_array($serverAPIday,$weekdaysExceptMonday)) {
                $hr = (int) date('H');
                if ( $hr < 6 ){ //php server time 6am , api chart time 8am

                    $yesterday =(date('Y-m-d H:i:s',strtotime("-1 days")));
                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $yesterday);
                    $data_in['from']->setTime(22,00,00);
                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $yesterday);
                    $data_in['to']->setTime(23,0,0);

                }else{

                    $data_in['to'] = date("Y-m-d H:i:s", strtotime("+2 hour", strtotime(date('Y-m-d H:i:s'))));
                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',    $data_in['to']);

                    $data_in['from'] = date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))));
                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );
                }


            }


            $data['err']=false;
            $datax = array(
                'strSymbol' => $value,
                'from' => $data_in['from']->format('Y-m-d\TH:i:s'),
                'to' => $data_in['to']->format('Y-m-d\TH:i:s')
            );

            $WebServiceChart->open_chart_GetTicksHistory($datax);
            $GetTicksHistoryResult = (array)  $WebServiceChart->result;
            $data[$value]='';

            if($GetTicksHistoryResult['Message']=='RET_OK'){

                $Ticks = (array) $GetTicksHistoryResult['Ticks'];

                foreach($Ticks['TickInfo'] as $object){
                    $data[$value].= '{';

                    $data[$value].= '"Close":'.$object->Bid.',';
                    $data[$value].= '"High":'.$object->High.',';
                    $data[$value].= '"Low":'.$object->Low.',';
                    $data[$value].= '"Open":'.$object->Ask.',';
                    $data[$value].= '"Stamp":"'.$object->TimeStamp.'",';
                    $data[$value].= '"Symbol":"'.$object->Symbol.'",';
                    $data[$value].= '"TimeFrame":1,';
                    $data[$value].= '"Volume":'.$object->Spread.'},';

                }

                $data[$value] = rtrim($data[$value],',');
            }else{
                $data['err']=true;
            }

        }

        $shares = array('#AAPL','#AMZN','#BAC','#BARC','#EBAY','#FB','#GOOG','#LNKD','#MSFT','#YHOO');
        foreach ($shares as &$value) {

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
        $metals = array('GOLD','SILVER','XAUUSD','GOLDgr','XAGUSD');
        $WebServiceQuotes = new WebService($webservice_config);
        $WebServiceQuotes->open_chart_GetCurrentQuotes();
        if ($WebServiceQuotes->result){
            $data['r01']=true; /*with api return*/
            $GetCurrentQuotesResult = (array)  $WebServiceQuotes->result;
            if($GetCurrentQuotesResult['ReqResult']){
                $data['r01'] = true; /*with ReqResult*/
                $Quotes = (array) $GetCurrentQuotesResult['Quotes'];
                foreach($Quotes['QuoteData'] as $object){
                    $symbol=$object->Symbol;
                    if ($symbol[0] == '#'){
                        $symbolid = substr($symbol, 1);
                    }else{
                        $symbolid=$object->Symbol;
                    }

                    if (in_array($object->Symbol, $metals)) {
                        $data_sub[$symbolid] = array(
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
                }


            }
        }else{
            $data['err']=true;
        }

        $bitcoin = array('#Bitcoin');
        foreach ($bitcoin as &$value) {

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

        $this->load->view('home_chart',$data);
    }

    public function all_symbol(){
        $data='';
        $this->load->view('all_chart',$data);
    }

    public function Modules($id){
        redirect('https://www.forexmart.com/assets/js/tickchart2/Modules/Worker.js');
    }

    public function original(){
        $this->load->view('tickchart');
    }

    public function minichart(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        $data['data'] = '';
        $data['data']['metadata_description'] = lang('x_abt_us_dsc');
        $data['data']['metadata_keyword'] = lang('x_abt_us_kew');
        $this->template->title(lang('x_abt_us_tit'))
            ->set_layout('external/main')
            ->build('mini_live_quotes', $data['data']);
    }

//    public function update($symbol){
    public function update($symbol){
        $data='';
        if(isset($symbol)){
//            echo $symbol;
            $data['symbol']=$symbol;
//            var_dump($data['symbol']);
        }else{
            $data['symbol']='AUDUSD';
//            $data['symbol']='EURUSD';

//            var_dump($data['symbol']);
        }
        if ($data['symbol']=='Bitcoin'){
            $data['symbol']='#Bitcoin';
        }

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
        $WebService = new WebService($webservice_config);
        $WebService->open_chart_GetCurrentQuotes();

        if ($WebService->result){
            $GetCurrentQuotesResult = (array)  $WebService->result;
            if($GetCurrentQuotesResult['ReqResult']){
                $Quotes = (array) $GetCurrentQuotesResult['Quotes'];
                foreach($Quotes['QuoteData'] as $object){
                    $symbol=$object->Symbol;
//                    if ($symbol[0] == '#'){
//                        $symbolid = substr($symbol, 1);
//                    }else{
                        $symbolid = $object->Symbol;
//                    }
                    if ($symbolid == $data['symbol']){
                        $data['generatequotes'] ='{"Symbol":"'.$object->Symbol.'","LongName":"'.$object->Symbol.'","Stamp":"'.$object->Timestamp.'","Bid":'.$object->Bid.',"Ask":'.$object->Ask.',"Digits":'.$object->Digits.',"QuoteID":201398155,"AskMovement":"=","BidMovement":"=","IsOpen":true,"IsActive":true,"SessionGroup":"general","DepthData":null}' ;
                        break;
                    }

                }

            }
        }

        $validforGetTicksHistory  = array(
            'AUDUSD',
            'EURGBP',
            'EURCHF',
            'EURJPY',
            'EURUSD',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY',
            'GOLD',
            'SILVER',
            'XAUUSD',
            'GOLDgr',
            'XAGUSD',
            '#Bitcoin'
        );

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
            foreach($Ticks['TickInfo'] as $object){
                $data['tick'].='{"QuoteID":324694790,"Symbol":"'.$object->Symbol.'","Stamp":"'.$object->TimeStamp.'","Bid":'.$object->Bid.',"Ask":'.$object->Ask.',"Volume":'.$object->Spread.',"Digits":'.$object->Digits.',"DigitsInt":'.$object->Digits.'},';
            }

            $data['tick'] = rtrim($data['tick'],',');
        }


        $this->load->view('tickchart_update',$data);
    }

    public function sequence(){
        /*charts*/
        $data['forex'] = array(
            'AUDUSD',
            'EURCHF',
            'EURGBP',
            'EURJPY',
            'EURUSD',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY');

        $data['fx']='';

        foreach($data['forex'] as &$value){
            if ($value=='AUDUSD'){
                $chart_tr['symbl_default'] = 'defaultforex';
            }else{
                $chart_tr['symbl_default'] ='';
            }

            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'fx';

            $data['fx'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $data['shares'] = array(
            'AAPL',
            'AMZN',
            'BAC',
            'BARC',
            'EBAY',
            'FB',
            'GOOG',
            'LNKD',
            'MSFT',
            'YHOO'
        );

        $data['share'] = '';

        foreach($data['shares'] as &$value){

            if ($value=='AAPL'){
                $chart_tr['symbl_default'] = 'defaultshares';
            }else{
                $chart_tr['symbl_default'] ='';
            }

            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = '#'.$value;
            $chart_tr['tr_cls'] = 'sh';

            $data['share'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $data['metals'] = array(
            'GOLD',
            'SILVER',
            'XAUUSD',
            'GOLDgr',
            'XAGUSD'
        );

        foreach($data['metals'] as &$value){
            if ($value=='GOLD'){
                $chart_tr['symbl_default'] = 'defaultmetals';
            }else{
                $chart_tr['symbl_default'] ='';
            }
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'mt';

            $data['metal'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $chart['bitcoin'] = array(
            'Bitcoin'
        );

        foreach($chart['bitcoin'] as &$value){
            if ($value=='Bitcoin'){
                $chart_tr['symbl_default'] = 'defaultbitcoin';
            }else{
                $chart_tr['symbl_default'] ='';
            }
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'bt';
            $data['bt'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);
        }

        $data['tab']=0;
        /*charts*/

        $this->load->view('widget/chart_tab',$data);
    }

    public function check(){
        $forex = array(
            'AUDUSD'
        );
        $webservice_config = array(
            'server' => 'chart_single'
        );
        $WebServiceChart = new WebService($webservice_config);
        //ISO 8601 week starts at monday ends in sunday

        //php server time + 2hrs to offset the api server time
        $weekend=array('Sat','Sun');
        $weekdaysExceptMonday=array('Tue','Wed','Thu','Fri');
        //add offset of 2 hrs php servertime is behind 2hrs in API Method
        //$serverAPIday = date('D', time());
        $serverAPIday = date('D', strtotime("+2 hour"));

        if(in_array($serverAPIday,$weekend)){
            $datefriday =(date('Y-m-d H:i:s',strtotime("friday this week")));
            $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
            $data_in['from']->setTime(22,00,00);
            $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
            $data_in['to']->setTime(23,0,0);

            $data['from']=  $data_in['from'];
            $data['to']=  $data_in['to'];
            //}else if(date('D', time()) === 'Mon'){
            //add offset of 2 hrs php servertime is behind 2hrs in API Method
        }else if(date('D', strtotime("+2 hour")) === 'Mon'){
            $hr = (int) date('H');
            if ( $hr < 6 ){ //php server time 6am , api chart time 8am
                $datefriday =(date('Y-m-d H:i:s',strtotime("last week friday")));
                $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
                $data_in['from']->setTime(22,00,00);
                $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
                $data_in['to']->setTime(23,0,0);
            }else{
                $data_in['from'] = date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))));
                $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );
                $data_in['to'] = date("Y-m-d H:i:s", strtotime("+2 hour", strtotime(date('Y-m-d H:i:s'))));
                $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_in['to']);
            }
            $data['time'] = $hr;
            $data['from']=  $data_in['from'];
            $data['to']=  $data_in['to'];

        }else if(in_array($serverAPIday,$weekdaysExceptMonday)) {
            $hr = (int) date('H');
            if ( $hr < 6 ){ //php server time 6am , api chart time 8am

                $yesterday =(date('Y-m-d H:i:s',strtotime("-1 days")));
                $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $yesterday);
                $data_in['from']->setTime(22,00,00);
                $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $yesterday);
                $data_in['to']->setTime(23,0,0);

            }else{

                $data_in['to'] = date("Y-m-d H:i:s", strtotime("+2 hour", strtotime(date('Y-m-d H:i:s'))));
                $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',    $data_in['to']);

                $data_in['from'] = date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))));
                $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );
            }

        }
        $data['err']=false;
        $datax = array(
            'strSymbol' => 'AUDUSD',
            'from' => $data_in['from']->format('Y-m-d\TH:i:s'),
            'to' => $data_in['to']->format('Y-m-d\TH:i:s')
        );
        var_dump($datax);
//        $data['tick']='';
//        $WebServiceChart->open_chart_GetTicksHistory($datax);
//        $GetTicksHistoryResult = (array)  $WebServiceChart->result;
//        if($GetTicksHistoryResult['Message']=='RET_OK'){
//
//            $Ticks = (array) $GetTicksHistoryResult['Ticks'];
//            foreach($Ticks['TickInfo'] as $object){
//                $data['tick'].='{"QuoteID":324694790,"Symbol":"'.$object->Symbol.'","Stamp":"'.$object->TimeStamp.'","Bid":'.$object->Bid.',"Ask":'.$object->Ask.',"Volume":'.$object->Spread.',"Digits":'.$object->Digits.',"DigitsInt":'.$object->Digits.'},';
//            }
//
//            $data['tick'] = rtrim($data['tick'],',');
//        }

    }

    public function index(){
        /*charts*/
        $data['forex'] = array(
            'AUDUSD',
            'EURCHF',
            'EURGBP',
            'EURJPY',
            'EURUSD',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY');

        $data['fx']='';

        foreach($data['forex'] as &$value){
            if ($value=='AUDUSD'){
                $chart_tr['symbl_default'] = 'defaultforex';
            }else{
                $chart_tr['symbl_default'] ='';
            }

            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'fx';

            $data['fx'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $data['shares'] = array(
            'AAPL',
            'AMZN',
            'BAC',
            'BARC',
            'EBAY',
            'FB',
            'GOOG',
            'LNKD',
            'MSFT',
            'YHOO'
        );

        $data['share'] = '';

        foreach($data['shares'] as &$value){

            if ($value=='AAPL'){
                $chart_tr['symbl_default'] = 'defaultshares';
            }else{
                $chart_tr['symbl_default'] ='';
            }

            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = '#'.$value;
            $chart_tr['tr_cls'] = 'sh';

            $data['share'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $data['metals'] = array(
            'GOLD',
            'SILVER',
            'XAUUSD',
            'GOLDgr',
            'XAGUSD'
        );

        foreach($data['metals'] as &$value){
            if ($value=='GOLD'){
                $chart_tr['symbl_default'] = 'defaultmetals';
            }else{
                $chart_tr['symbl_default'] ='';
            }
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'mt';

            $data['metal'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);

        }

        $chart['bitcoin'] = array(
            'Bitcoin'
        );

        foreach($chart['bitcoin'] as &$value){
            if ($value=='Bitcoin'){
                $chart_tr['symbl_default'] = 'defaultbitcoin';
            }else{
                $chart_tr['symbl_default'] ='';
            }
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'bt';
            $data['bt'].= $this->load->view('widget/tickchart_tr', $chart_tr ,TRUE);
        }

        $data['tab']=0;
        /*charts*/

        $this->load->view('widget/chart_tab',$data);
    }
}



