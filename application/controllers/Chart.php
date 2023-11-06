<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {


    public function index(){
        $this->load->view('chart');

    }
    public function forex()
    {
        /*charts*/
        $chart['forex'] = array(
//             'AUDCAD',
//             'AUDCHF',
//             'AUDCZK',
//             'AUDDKK',
//             'AUDHKD',
//             'AUDHKD',
//             'AUDHUF',
//             'AUDJPY',
//             'AUDMXN',
//             'AUDNOK',
//             'AUDNZD',
//             'AUDPLN',
//             'AUDSEK',
//             'AUDSGD',
            'AUDUSD',
//             'AUDZAR',
//             'CADCHF',
//             'CADCZK',
//             'CADDKK',
//             'CADHKD',
//             'CADHUF',
//             'CADJPY',
//             'CADMXN',
//             'CADNOK',
//             'CADPLN',
//             'CADSEK',
//             'CADSGD',
//             'CADZAR',
//             'CHFCZK',
//             'CHFDKK',
//             'CHFHKD',
//             'CHFHUF',
//             'CHFJPY',
//             'CHFMXN',
//             'CHFNOK',
//             'CHFPLN',
//             'CHFSEK',
//             'CHFSGD',
//             'CHFZAR',
//             'CZKJPY',
//             'DKKJPY',
//             'EURAUD',
//             'EURCAD',
            'EURCHF',
//             'EURCZK',
//             'EURDKK',
            'EURGBP',
//             'EURHKD',
//             'EURHUF',
            'EURJPY',
//             'EURMXN',
//             'EURNOK',
//             'EURNZD',
//             'EURPLN',
//             'EURRUB',
//             'EURSEK',
//             'EURSGD',
            'EURUSD',
//             'EURZAR',
//             'GBPAUD',
//             'GBPCAD',
//             'GBPCHF',
//             'GBPCZK',
//             'GBPDKK',
//             'GBPHKD',
//             'GBPHUF',
//             'GBPJPY',
//             'GBPMXN',
//             'GBPNOK',
//             'GBPNZD',
//             'GBPPLN',
//             'GBPSEK',
//             'GBPSGD',
            'GBPUSD',
//             'GBPZAR',
//             'HKDJPY',
//             'HUFJPY',
//             'MXNJPY',
//             'NOKJPY',
//             'NZDCAD',
//             'NZDCHF',
//             'NZDCZK',
//             'NZDDKK',
//             'NZDHKD',
//             'NZDHUF',
//             'NZDJPY',
//             'NZDMXN',
//             'NZDNOK',
//             'NZDPLN',
//             'NZDSEK',
//             'NZDSGD',
            'NZDUSD',
//             'NZDZAR',
//             'SEKJPY',
//             'SGDJPY',
//             'USDAED',
            'USDCAD',
            'USDCHF',
//             'USDCNY',
//             'USDCZK',
//             'USDDKK',
//             'USDHKD',
//              'USDHUF',
//             'USDIDR',
//             'USDINR',
//             'USDISL',
            'USDJPY',
//             'USDKWD',
//             'USDLTL',
//             'USDMXN',
//             'USDMYR',
//             'USDNOK',
//             'USDPHP',
//             'USDPLN',
//             'USDRON',
//             'USDRUB',
//             'USDRUR',
//             'USDSAR',
//             'USDSEK',
//             'USDSGD',
//             'USDTHB',
//             'USDZAR',
//             'ZARJPY'
        );

        $chart['fx']='';

        foreach($chart['forex'] as &$value){
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'fx';

            $chart['fx'].= $this->load->view('widget/chart_tr', $chart_tr ,TRUE);
        }

        $chart['tab']=0;
        $data['chart'] = $this->load->view('widget/chart_segments_forex', $chart ,TRUE);
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
        foreach ($forex as &$value) {

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

        $this->load->view('chart_forex',$data);
    }

    public function shares()
    {
        /*charts*/

        $chart['shares2'] = array(
//            '#AA',
//            '#AAL',
            '#AAPL',
//            '#AIG',
            '#AMZN',
//            '#AXP',
//            '#BA',
//            '#BABA',
            '#BAC',
            '#BARC',
//            '#BLT',
//            '#BP',
//            '#BTA',
//            '#C',
//            '#CAT',
//            '#CSCO',
//            '#CVX',
//            '#DD',
//            '#DIS',
            '#EBAY',
            '#FB',
//            '#GEN',
            '#GOOG',
//            '#GS',
//            '#GSK',
//            '#HD',
//            '#HPQ',
//            '#HSBA',
//            '#IBM',
//            '#INTC',
//            '#JNJ',
//            '#JPM',
//            '#KO',
//            '#LLOY',
            '#LNKD',
//            '#MCD',
//            '#MMM',
//            '#MRK',
            '#MSFT',
//            '#ORCL',
//            '#PFE',
//            '#PG',
//            '#T',
//            '#TRV',
//            '#TSCO',
//            '#TWTR',
//            '#UTX',
//            '#VOD',
//            '#VZ',
//            '#WFC',
//            '#WMT',
//            '#XOM',
            '#YHOO'
        );

        $chart['shares'] = array(
//             'AA',
//             'AAL',
            'AAPL',
//             'AIG',
            'AMZN',
//             'AXP',
//             'BA',
//             'BABA',
            'BAC',
            'BARC',
//             'BLT',
//             'BP',
//             'BTA',
//             'C',
//             'CAT',
//             'CSCO',
//             'CVX',
//             'DD',
//             'DIS',
            'EBAY',
            'FB',
//             'GEN',
            'GOOG',
//             'GS',
//             'GSK',
//             'HD',
//             'HPQ',
//             'HSBA',
//             'IBM',
//             'INTC',
//             'JNJ',
//             'JPM',
//             'KO',
//             'LLOY',
            'LNKD',
//             'MCD',
//             'MMM',
//             'MRK',
            'MSFT',
//             'ORCL',
//             'PFE',
//             'PG',
//             'T',
//             'TRV',
//             'TSCO',
//             'TWTR',
//             'UTX',
//             'VOD',
//             'VZ',
//             'WFC',
//             'WMT',
//             'XOM',
            'YHOO'
        );

        $chart['share'] = '';
        foreach($chart['shares'] as &$value){
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = '#'.$value;
            $chart_tr['tr_cls'] = 'sh';

            $chart['share'].= $this->load->view('widget/chart_tr', $chart_tr ,TRUE);

        }

        $chart['tab']=1;
        $data['chart'] = $this->load->view('widget/chart_segments_shares', $chart ,TRUE);
        /*charts*/
        $data['err']=false;

        $shares = array('#AAPL','#AMZN','#BAC','#BARC','#EBAY','#FB','#GOOG','#LNKD','#MSFT','#YHOO');

        $webservice_config = array(
            'server' => 'chart_single'
        );

        $data_sub = '' ;

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

                    if (in_array($object->Symbol, $shares)) {
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
                    //                    $data[$symbolid].= '{';
                    //                    $data[$symbolid].= '"Close":'.$data_sub[$symbolid]['Bid'].',';
                    //                    $data[$symbolid].= '"High":'.$data_sub[$symbolid]['High'].',';
                    //                    $data[$symbolid].= '"Low":'.$data_sub[$symbolid]['Low'].',';
                    //                    $data[$symbolid].= '"Open":'.$object->Rate.',';
                    //                    $data[$symbolid].= '"Stamp":"'.$object->TimeStamp.'",';
                    //                    $data[$symbolid].= '"Symbol":"'.$object->Symbol.'",';
                    //                    $data[$symbolid].= '"TimeFrame":1,';
                    //                    $data[$symbolid].= '"Volume":'.$data_sub[$symbolid]['Spread'].'},';

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
        $this->load->view('chart_shares',$data);
    }

    public function metals()
    {
        /*charts*/

        $chart['metals'] = array(
            'GOLD',
            'SILVER',
            'XAUUSD',
            'GOLDgr',
            'XAGUSD'
        );

        $chart['metal']='';

        foreach($chart['metals'] as &$value){
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'mt';

            $chart['metal'].= $this->load->view('widget/chart_tr', $chart_tr ,TRUE);

        }


        $chart['tab']=2;
        $data['chart'] = $this->load->view('widget/chart_segments_metals', $chart ,TRUE);
        /*charts*/
        $data['err']=false;
        $metals = array('GOLD','SILVER','XAUUSD','GOLDgr','XAGUSD');

        $webservice_config = array(
            'server' => 'chart_single'
        );

        $data_sub = '' ;

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


        //        var_dump($data_sub );die();

        foreach ($metals as &$value) {

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
                    //                    $data[$symbolid].= '{';
                    //                    $data[$symbolid].= '"Close":'.$data_sub[$symbolid]['Bid'].',';
                    //                    $data[$symbolid].= '"High":'.$data_sub[$symbolid]['High'].',';
                    //                    $data[$symbolid].= '"Low":'.$data_sub[$symbolid]['Low'].',';
                    //                    $data[$symbolid].= '"Open":'.$object->Rate.',';
                    //                    $data[$symbolid].= '"Stamp":"'.$object->TimeStamp.'",';
                    //                    $data[$symbolid].= '"Symbol":"'.$object->Symbol.'",';
                    //                    $data[$symbolid].= '"TimeFrame":1,';
                    //                    $data[$symbolid].= '"Volume":'.$data_sub[$symbolid]['Spread'].'},';

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
                //                var_dump($data[$symbolid]);
                $data['r0']='API OK';
            }else{
                $data['r0']='API Error'; /*with api return*/
                $data['err']=true;
            }
        }

        //        die();


        $this->load->view('chart_metals',$data);
    }

    public function bitcoin()
    {
        /*charts*/
        $chart['bitcoin'] = array(
            'Bitcoin'
        );

        $chart['bt']='';
        foreach($chart['bitcoin'] as &$value){
            $chart_tr['symbl_id'] = $value.'_id';
            $chart_tr['symbl_unitvalue'] = $value.'_unitvalue';
            $chart_tr['symbl_hi_low'] = $value.'_hi_low';
            $chart_tr['symbl_down_icon'] = $value.'_down_icon';
            $chart_tr['symbl_low'] = $value.'_low';
            $chart_tr['symbl_high'] = $value.'_high';
            $chart_tr['symbl_value'] = $value;
            $chart_tr['tr_cls'] = 'bt';
            $chart['bt'].= $this->load->view('widget/chart_tr', $chart_tr ,TRUE);
        }
        $chart['tab']=3;
        $data['chart'] = $this->load->view('widget/chart_segments_bitcoin', $chart ,TRUE);
        /*charts*/
        $data['err']=false;
        $bitcoin = array('#Bitcoin');

        $webservice_config = array(
            'server' => 'chart_single'
        );

        $data_sub = '' ;

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

                    if (in_array($object->Symbol, $bitcoin)) {
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
                    //                    $data[$symbolid].= '{';
                    //                    $data[$symbolid].= '"Close":'.$data_sub[$symbolid]['Bid'].',';
                    //                    $data[$symbolid].= '"High":'.$data_sub[$symbolid]['High'].',';
                    //                    $data[$symbolid].= '"Low":'.$data_sub[$symbolid]['Low'].',';
                    //                    $data[$symbolid].= '"Open":'.$object->Rate.',';
                    //                    $data[$symbolid].= '"Stamp":"'.$object->TimeStamp.'",';
                    //                    $data[$symbolid].= '"Symbol":"'.$object->Symbol.'",';
                    //                    $data[$symbolid].= '"TimeFrame":1,';
                    //                    $data[$symbolid].= '"Volume":'.$data_sub[$symbolid]['Spread'].'},';

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


        $this->load->view('chart_bitcoin',$data);

    }
    public function Modules(){
        redirect('https://www.forexmart.com/assets/js/tickchart/Modules/Worker.js');
    }
}



