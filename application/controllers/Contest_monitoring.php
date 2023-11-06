<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest_monitoring extends MY_Controller
{

    public function __construct(){
        parent::__construct();

    }

    public function index(){

        //get parameter pass is ?trader=accountnumber
        $data['data']=$this->input->get(NULL, TRUE);
        if(isset($data['data']['trader'])){
            redirect(FXPP::loc_url('contest-monitoring/trader/'.$data['data']['trader']));
        }
        if(isset($data['data']['trader'])){

            $account_info = array(
                'iLogin' => $data['data']['trader']
            );
            $webservice_config = array(
                'server' => 'demo_new'
            );
            $WebService = new WebService($webservice_config);
            $WebService->open_GetAccountActiveTrades($account_info);

            if( $WebService->request_status === 'RET_OK' ) {

                $tradatalist = (array) $WebService->get_result('TradeDataList');
                if($tradatalist){
                    $opened='';
                    $data['data']['OpenTotal']=0;

                    foreach ( $tradatalist['TradeData'] as $object){

                        $opened.='<tr>';
                        $opened.='<td>'.$object->OrderTicket.'</td>';
                        $opened.='<td>'.$object->TradeType.'</td>';
                        $opened.='<td>'.$object->Volume.'</td>';
                        $opened.='<td>'.$object->Symbol.'</td>';
                        $opened.='<td>'.$object->OpenPrice.'</td>';
                        $opened.='<td>'.$object->StopLoss.'</td>';
                        $opened.='<td>'.$object->TakeProfit.'</td>';
                        $opened.='<td>'.$object->ClosePrice.'</td>';
                        $opened.='<td>'.$object->Profit.'</td>';
                        $opened.='</tr>';

                        $data['data']['OpenTotal']=   $data['data']['OpenTotal']  +floatval($object->Profit);
                    }
                    $data['data']['Opened']= $opened;
                }else{
                    $data['data']['Opened']= '';
                    $data['data']['OpenTotal']= '0';
                }
                $data['data']['service']=true;
            }else{
                $data['data']['service']=false;
                $data['data']['OpenTotal']= '0';
                $data['data']['webservice']=' Server request error.1';
                $data['HasError']=true;
            }

            $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 days")));
            $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
            $data['from']->setTime(00,00,01);
            $data['to']->setTime(23,59,59);
            $Haccount_info = array(
                'iLogin' => $data['data']['trader'],
                'from' => $data['from']->format('Y-m-d\TH:i:s'),
                'to' => $data['to']->format('Y-m-d\TH:i:s')
            );

            $WebService = new WebService($webservice_config);
            $WebService->open_GetAccountTradesHistory($Haccount_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('TradeDataList');
                    if($tradatalist) {
                        $closed='';
                        $data['data']['ClosedTotal']= 0;
                        $data['data']['Margin'] = array();
                        $data['data']['Equity'] = array();
                        $data['data']['Balance'] = array();


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



                        $data['data']['Closed'] = $closed;
                    }else{
                        $data['data']['Closed']= '';
                        $data['data']['ClosedTotal']=0;
                    }
                    $data['data']['service']=true;
                    break;
                default:
                    $data['data']['service']=false;
                    $data['data']['ClosedTotal']=0;
                    $data['data']['webservice']=' Server request error 2. ';
                    $data['HasError']=true;
            }


            $WebService = new WebService($webservice_config);

            $WebService->open_GetBalanceMonitoringDataByDate($Haccount_info);

            switch($WebService->request_status){
                case 'RET_OK':
                    $BalanceMonidtoringDataList = (array) $WebService->get_result('BalanceMonidtoringDataList');
                    $data['data']['Margin'] = array();
                    $data['data']['Equity'] = array();
                    $data['data']['Balance'] = array();
                    foreach ($BalanceMonidtoringDataList['BalanceMonitorData'] as $object) {
                        $date = new DateTime($object->Stamp);
                        $data['Margin'] = array('x' =>strtotime($object->Stamp)*1000, 'y' =>  $object->Margin);
                        array_push($data['data']['Margin'], $data['Margin']);
                        $data['Equity'] = array('x' =>  strtotime($object->Stamp)*1000, 'y' =>  $object->Equity);
                        array_push($data['data']['Equity'], $data['Equity']);
                        $data['Balance'] = array('x' => strtotime($object->Stamp)*1000, 'y' =>  $object->Balance);
                        array_push($data['data']['Balance'], $data['Balance']);
                    }

                    $data['data']['Margin'] =  json_encode($data['data']['Margin'], JSON_NUMERIC_CHECK);
                    $data['data']['Equity'] =  json_encode($data['data']['Equity'], JSON_NUMERIC_CHECK);
                    $data['data']['Balance'] =  json_encode($data['data']['Balance'], JSON_NUMERIC_CHECK);
                    break;
                default:
                    $data['data']['webservice']=' Server request error 3. ';
                    $data['HasError']=true;
            }


        }else{
            $data['data']['error']= 'No user to display';
        }
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['title']='Contest Monitoring';
        $this->template->title("Contest Monitoring | ForexMart")

            ->append_metadata_css("
                 <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
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
                 <script src='".$this->template->Js()."canvasjs.min.js' ></script>
            ")
            ->set_layout('external/main')
            ->build('contest_monitoring',$data['data']);

        unset($data);
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
            'server' => 'demo_new'
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

    public function trader($account){


        if(isset($account)){
            $data['data']['trader']=$account;
            $account_info = array(
                'iLogin' => $account
            );
            $webservice_config = array(
                'server' => 'demo_new'
            );
            $WebService = new WebService($webservice_config);
            $WebService->open_GetAccountActiveTrades($account_info);

            if( $WebService->request_status === 'RET_OK' ) {

                $tradatalist = (array) $WebService->get_result('TradeDataList');
                if($tradatalist){
                    $opened='';
                    $data['data']['OpenTotal']=0;

                    foreach ( $tradatalist['TradeData'] as $object){

                        $opened.='<tr>';
                        $opened.='<td>'.$object->OrderTicket.'</td>';
                        $opened.='<td>'.$object->TradeType.'</td>';
                        $opened.='<td>'.$object->Volume.'</td>';
                        $opened.='<td>'.$object->Symbol.'</td>';
                        $opened.='<td>'.$object->OpenPrice.'</td>';
                        $opened.='<td>'.$object->StopLoss.'</td>';
                        $opened.='<td>'.$object->TakeProfit.'</td>';
                        $opened.='<td>'.$object->ClosePrice.'</td>';
                        $opened.='<td>'.$object->Profit.'</td>';
                        $opened.='</tr>';

                        $data['data']['OpenTotal']=   $data['data']['OpenTotal']  +floatval($object->Profit);
                    }
                    $data['data']['Opened']= $opened;
                }else{
                    $data['data']['Opened']= '';
                    $data['data']['OpenTotal']= '0';
                }
                $data['data']['service']=true;

//                if(IPLoc::Office()){
                    $this->config->load('contestprizes', TRUE);
                    $this->load->model('account_model');
                     $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
                    $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
                    $contest_data = $this->account_model->getContestWinners($start_date, $end_date,$account);
                    if($contest_data){
                        $start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
                        $end_dates = date('Y-m-d 23:59:59', strtotime($start_dates . ' +4 days'));
                        $rank = 0;
                        $prev_value = 0;
                        foreach($contest_data as $key => $value){

                            if($prev_value <> $value['amount']){
                                $rank++;
                                $prev_value = $value['amount'];
                            }

                            $contest_data[$key]['rank'] = $rank;
                            if($value['account_number']==$account){
                                $data['data']['Arank']=$rank;

                                $data['data']['Sdate']= date(" F j, Y", strtotime($start_dates));
                                $data['data']['Edate' ]= date(" F j, Y", strtotime($end_dates));
                                $data['data']['weekno' ]=FXPP::week_difference($date1='5/23/2016', $date2= date("m/d/Y", strtotime($end_dates)));

                                switch($data['data']['Arank']){
                                    case 1:
                                        $data['data']['pricefund'] = $this->config->item('prize_1','contestprizes');
                                        break;
                                    case 2:
                                        $data['data']['pricefund'] = $this->config->item('prize_2','contestprizes');
                                        break;
                                    case 3:
                                        $data['data']['pricefund'] = $this->config->item('prize_3','contestprizes');
                                        break;
                                    case 4:
                                        $data['data']['pricefund'] = $this->config->item('prize_4','contestprizes');
                                        break;
                                    case 5:
                                        $data['data']['pricefund'] = $this->config->item('prize_5','contestprizes');
                                        break;
                                    case 6:
                                        $data['data']['pricefund'] = $this->config->item('prize_6','contestprizes');
                                        break;
                                    case 7:
                                        $data['data']['pricefund'] = $this->config->item('prize_7','contestprizes');
                                        break;
                                    case 8:
                                        $data['data']['pricefund'] = $this->config->item('prize_8','contestprizes');
                                        break;
                                    case 9:
                                        $data['data']['pricefund'] = $this->config->item('prize_9','contestprizes');
                                        break;
                                    case 10:
                                        $data['data']['pricefund'] = $this->config->item('prize_10','contestprizes');
                                        break;
                                    default:
                                         $data['data']['pricefund']=0;
                                }


                            }

                        }

                    }
//                }

            }else{
                $data['data']['service']=false;
                $data['data']['OpenTotal']= '0';
                $data['data']['webservice']=' Server request error.1';
                $data['HasError']=true;
            }

            $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 days")));
            $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
            $data['from']->setTime(00,00,01);
            $data['to']->setTime(23,59,59);
            $Haccount_info = array(
                'iLogin' => $account,
                'from' => $data['from']->format('Y-m-d\TH:i:s'),
                'to' => $data['to']->format('Y-m-d\TH:i:s')
            );

            $WebService = new WebService($webservice_config);
            $WebService->open_GetAccountTradesHistory($Haccount_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('TradeDataList');
                    if($tradatalist) {
                        $closed='';
                        $data['data']['ClosedTotal']= 0;
                        $data['data']['Margin'] = array();
                        $data['data']['Equity'] = array();
                        $data['data']['Balance'] = array();

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

                        $data['data']['Closed'] = $closed;
                    }else{
                        $data['data']['Closed']= '';
                        $data['data']['ClosedTotal']=0;
                    }
                    $data['data']['service']=true;
                    break;
                default:
                    $data['data']['service']=false;
                    $data['data']['ClosedTotal']=0;
                    $data['data']['webservice']=' Server request error 2. ';
                    $data['HasError']=true;
            }


            $WebService = new WebService($webservice_config);

            $WebService->open_GetBalanceMonitoringDataByDate($Haccount_info);

            switch($WebService->request_status){
                case 'RET_OK':
                    $BalanceMonidtoringDataList = (array) $WebService->get_result('BalanceMonidtoringDataList');
                    $data['data']['Margin'] = array();
                    $data['data']['Equity'] = array();
                    $data['data']['Balance'] = array();
                    foreach ($BalanceMonidtoringDataList['BalanceMonitorData'] as $object) {
                        $date = new DateTime($object->Stamp);
                        $data['Margin'] = array('x' =>strtotime($object->Stamp)*1000, 'y' =>  $object->Margin);
                        array_push($data['data']['Margin'], $data['Margin']);
                        $data['Equity'] = array('x' =>  strtotime($object->Stamp)*1000, 'y' =>  $object->Equity);
                        array_push($data['data']['Equity'], $data['Equity']);
                        $data['Balance'] = array('x' => strtotime($object->Stamp)*1000, 'y' =>  $object->Balance);
                        array_push($data['data']['Balance'], $data['Balance']);
                    }

                    $data['data']['Margin'] =  json_encode($data['data']['Margin'], JSON_NUMERIC_CHECK);
                    $data['data']['Equity'] =  json_encode($data['data']['Equity'], JSON_NUMERIC_CHECK);
                    $data['data']['Balance'] =  json_encode($data['data']['Balance'], JSON_NUMERIC_CHECK);
                    break;
                default:
                    $data['data']['webservice']=' Server request error 3. ';
                    $data['HasError']=true;
            }


        }else{
            $data['data']['error']= 'No user to display';
        }
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['title']='Contest Monitoring';
        $this->template->title("Contest Monitoring | ForexMart")

            ->append_metadata_css("
                 <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
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
                 <script src='".$this->template->Js()."canvasjs.min.js' ></script>
            ")
            ->set_layout('external/main')
            ->build('contest_monitoring',$data['data']);

        unset($data);

    }

}