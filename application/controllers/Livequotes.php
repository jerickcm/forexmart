<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livequotes extends CI_Controller {
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

        $this->load->view('widget/livequotes',$data);
    }
    public function Modules($id){
        redirect('http://s-www.forexmart.com/assets/js/tickchart2/Modules/Worker.js');
    }
    public function original(){
        $this->load->view('tickchart');
    }

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

        //        if (in_array($data['symbol'], $validforGetTicksHistory)) {
        //
        //
        //            //ISO 8601 week starts at monday ends in sunday
        //
        //            //php server time + 2hrs to offset the api server time
        //            $weekend=array('Sat','Sun');
        //            $weekdaysExceptMonday=array('Tue','Wed','Thu','Fri');
        //            //add offset of 2 hrs php servertime is behind 2hrs in API Method
        //            //$serverAPIday = date('D', time());
        //            $serverAPIday = date('D', strtotime("+2 hour"));
        //
        //            if(in_array($serverAPIday,$weekend)){
        //                $datefriday =(date('Y-m-d H:i:s',strtotime("friday this week")));
        //                $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
        //                $data_in['from']->setTime(22,00,00);
        //                $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
        //                $data_in['to']->setTime(23,0,0);
        //
        //                $data['from']=  $data_in['from'];
        //                $data['to']=  $data_in['to'];
        //                //}else if(date('D', time()) === 'Mon'){
        //                //add offset of 2 hrs php servertime is behind 2hrs in API Method
        //            }else if(date('D', strtotime("+2 hour")) === 'Mon'){
        //                $hr = (int) date('H');
        //                if ( $hr < 6 ){ //php server time 6am , api chart time 8am
        //                    $datefriday =(date('Y-m-d H:i:s',strtotime("last week friday")));
        //                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
        //                    $data_in['from']->setTime(22,00,00);
        //                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $datefriday);
        //                    $data_in['to']->setTime(23,0,0);
        //                }else{
        //                    $data_in['from'] = date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))));
        //                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );
        //                    $data_in['to'] = date("Y-m-d H:i:s", strtotime("+2 hour", strtotime(date('Y-m-d H:i:s'))));
        //                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s', $data_in['to']);
        //                }
        //                $data['time'] = $hr;
        //                $data['from']=  $data_in['from'];
        //                $data['to']=  $data_in['to'];
        //
        //            }else if(in_array($serverAPIday,$weekdaysExceptMonday)) {
        //                $hr = (int) date('H');
        //                if ( $hr < 6 ){ //php server time 6am , api chart time 8am
        //
        //                    $yesterday =(date('Y-m-d H:i:s',strtotime("-1 days")));
        //                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $yesterday);
        //                    $data_in['from']->setTime(22,00,00);
        //                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  $yesterday);
        //                    $data_in['to']->setTime(23,0,0);
        //
        //                }else{
        //
        //                    $data_in['to'] = date("Y-m-d H:i:s", strtotime("+2 hour", strtotime(date('Y-m-d H:i:s'))));
        //                    $data_in['to'] = DateTime::createFromFormat('Y-m-d H:i:s',    $data_in['to']);
        //
        //                    $data_in['from'] = date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))));
        //                    $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );
        //                }
        //
        //            }
        //            $data['err']=false;
        //            $datax = array(
        //                'strSymbol' => $data['symbol'],
        //                'from' => $data_in['from']->format('Y-m-d\TH:i:s'),
        //                'to' => $data_in['to']->format('Y-m-d\TH:i:s')
        //            );
        //
        //
        //        }else{
        //
        //
        //
        //        }

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


}



