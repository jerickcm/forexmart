<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_monitoring extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('copytrade');
    }

    public function index() {


    }

    public function special_account($account_number) {

        if(isset($account_number)){
            if($this->session->userdata('logged')){

                $data['data']['button_name']=lang('cpy_mon_box_but1');
                $session_account_number = $_SESSION['account_number'];
                $webservice_config = array('server' => 'minifcservice');
                $WS_I = new WebService($webservice_config);
                $account_info = array('iFollowerAccount' => $session_account_number);
                $WS_I->open_GetFollowerSubscriptionInfo($account_info);
                if ($WS_I->request_status === 'RET_OK') {
                    if ($WS_I->get_result('IsSubscribed')=='true'){
                        if ($account_number==$WS_I->get_result('MasterAccount')){
                            $data['data']['button_name']=lang('cpy_mon_box_but3');
                        }

                    }
                }elseif($WS_I->request_status === 'RET_ACCOUNT_NOT_FOUND'){


                }else{


                }
            }else{
                $data['data']['button_name']= lang('cpy_mon_box_but1');
            }


//            $accnt_no = array('258739','258746','258747');
            $accnt_no = array('258739','265782','258747');
            if (in_array($account_number, $accnt_no)) {
                $webservice_config = array(
                    'server' => 'live_new'
                );

                $data['data']['account_number']=$account_number;
                $account_info = array(
                    'iLogin' => $account_number
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

                            $data['data']['OpenTotal']=   $data['data']['OpenTotal']  + floatval($object->Profit);
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

//                $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-1 days")));
                $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-7 days")));
                $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
                $data['from']->setTime(00,00,01);
                $data['to']->setTime(23,59,59);
                $Haccount_info = array(
                    'iLogin' => $account_number,
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

        }else{

            $data['data']['error']= 'No user to display';
        }

        $data['data']['metadata_description'] = lang('cpy_mon_dsc');
        $data['data']['metadata_keyword'] = lang('cpy_mon_kew');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $this->template->title(lang('cpy_mon_tit'))
            ->append_metadata_css("
                      <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                 <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                   <link rel='stylesheet' href='" . $this->template->Css() . "threecharts.css'>
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
            ->build('special_account', $data['data']);
    }
}
