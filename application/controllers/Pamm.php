<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pamm extends MY_Controller {



    public function __construct()
    {

        parent::__construct();

        if(IPLoc::Office()) {

        }else{
            show_404();
        }

    }


	public function index(){
		error_reporting(E_ALL);
		$this->lang->load('pamm');
		$data = array(
			'data' => 'asd',
		);
		$this->template->title('Pamm | ForexMart')
            ->append_metadata_css('
                  <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'external-res.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css"/>
                  <link rel="stylesheet" href="' . $this->template->Css() . 'flags32.css"/>
                  <link rel="stylesheet" href="' . $this->template->Css() . 'pammmonitoring.css"/>
                  <link rel="stylesheet" href="' . $this->template->Css() . 'flags16.css"/>
                       <link type="text/css" rel="stylesheet" href="' .$this->template->Css(). 'dataTables.bootstrap2.css" >



            ')
            ->append_metadata_js('
                   <script src="'.$this->template->Js().'jquery.dataTables.min.js"></script>
                  <script src="'.$this->template->Js().'dataTables.bootstrap.min.js"></script>

                ')
            ->set_layout('external/main')
            ->build('external_pamm',$data);
	}

	public function get_monitoring(){

        // if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $draw = (int) $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $order =  $this->input->post('order');


        $webservice_config2 = array(
            'server' => 'pamm_livefeeds'
        );
        $PammService = new WebService($webservice_config2);
        $account_info = array(
            'AccountFilter' => '' ,
            /*Filter*/
            'ActiveInvestorsFrom' => 0 ,
            'ActiveInvestorsTo' => 0 ,
            'BalanceFrom' => 0 ,
            'BalanceTo' => 0 ,
            'CurrentTradesFrom' => 0 ,
            'CurrentTradesTo' => 0 ,
            'DailyBalFrom' => 0 ,
            'DailyBalTo' => 0 ,
            'DailyEquityFrom' => 0 ,
            'DailyEquityTo' => 0 ,
            'DailyProfitFrom' => 0 ,
            'DailyProfitTo' => 0 ,
            'EquityFrom' => 0 ,
            'EquityTo' => 0 ,
            'Month_3_ProfitFrom' => 0 ,
            'Month_3_ProfitTo' => 0 ,
            'Month_6_ProfitFrom' => 0 ,
            'Month_6_ProfitTo' => 0 ,
            'Month_9_ProfitFrom' => 0 ,
            'Month_9_ProfitTo' => 0 ,
            'MonthlyProfitFrom' => 0 ,
            'MonthlyProfitTo' => 0 ,
            'SimpleRatingFrom' => 0 ,
            'SimpleRatingTo' => 0 ,
            'SinceRegisteredFrom' => 0 ,
            'SinceRegisteredTo' => 0 ,
            'TotalProfitFrom' => 0 ,
            'TotalProfitTo' => 0 ,
            'TotalTradesFrom' => 0 ,
            'TotalTradesTo' => 0 ,
            'WeeklyProfitFrom' => 0 ,
            'WeeklyProfitTo' => 0 ,
            /*Filter*/
            'HasFilterToColumns' => false,
            'Limit' => 0,
            'Offset' => 0,
            'OrderByAsc' => false,
            'OrderByColumnName' => 'Account'

        );
        $PammService->open_GetPammTradersMonitoringDataCustom($account_info);
        $request = '';
        $arrayName['data'] = [];

        if($PammService->result){
            $MonitroingDataList =  (array) $PammService->result->MonitroingDataList;
            $Message = $PammService->result->ResponseMessage;
            switch($Message){
                case 'RET_OK':
                    if($MonitroingDataList){
                        $key=0;
                        foreach ($MonitroingDataList['MonitoringData'] as $object){

                        	$accountId = '
										<div class="first-data-pamm-holder">
	                                        <div class="pamm-img-data"><a href="javascript:;"><img src="https://www.forexmart.com/assets/images/pamm/acc-icon.png"></a></div>
	                                        <div class="pamm-list-data">
	                                            <ul>
	                                                <li><a href="javascript:;" class="pamm-trophy"></a></li>
	                                                <li><img src="https://www.forexmart.com/assets/images/pamm/pamm-flag/ru.png" width="18" height="14"></li>
	                                                <li>'.$object->AccountId.'</li>
	                                            </ul>
	                                            <p>'.$object->ProjectName.'</p>
	                                        </div>
	                                        <div class="pamm-chart-data"><img src="https://www.forexmart.com/assets/images/pamm/pamm-chart-temp.png" class="img-responsive"></div>
	                                    </div>
                                    ';

                            $data['AccountId'] = $accountId;
                            // $data['AccountId'] = "<a href='https://my.forexmart.com/pamm/invest/".$object->AccountId."'>".$object->AccountId."(".$object->ProjectName.")</a> ";
                            $data['ActiveInvestors'] = $object->ActiveInvestors;
                            $data['Balance'] = $object->Balance;
                            $data['CurrentTrades'] = $object->CurrentTrades;
                            $data['DailyProfit'] = sprintf("%01.2f", $object->DailyProfit);
                            $data['DailyTotalBalance'] = $object->DailyTotalBalance;
                            $data['DailyTotalEquity'] = sprintf("%01.2f", $object->DailyTotalEquity);
                            $data['Equity'] = $object->Equity;
                            $data['Month_3_Profit'] = sprintf("%01.2f", $object->Month_3_Profit);
                            $data['Month_6_Profit'] = sprintf("%01.2f", $object->Month_6_Profit);
                            $data['Month_9_Profit'] = sprintf("%01.2f", $object->Month_9_Profit);
                            $data['MonthlyProfit'] = sprintf("%01.2f", $object->MonthlyProfit);
                            $data['SimpleRating'] = sprintf("%01.2f", $object->SimpleRating) ;
                            $data['SinceRegisteredDays'] = $object->SinceRegisteredDays;
                            $data['TotalProfit'] = sprintf("%01.2f", $object->TotalProfit);
                            $data['TotalTrades'] = sprintf("%01.2f", $object->TotalTrades);
                            $data['WeeklyProfit'] = sprintf("%01.2f", $object->WeeklyProfit);
                            // $data['ActiveFollowers'] = $object->ActiveFollowers;

                            // $data['BrokerId'] = $object->BrokerId;

                            // $data['Currency'] = $object->Currency;

                            array_push($arrayName['data'],$data);


                        }
                    }
                    break;
                default:
            }
        }
        echo json_encode($arrayName);
    }



	

}
