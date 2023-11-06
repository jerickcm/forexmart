<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Balance extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) { // logged in
            redirect('signin');
        }
        $this->load->model('account_model');
        $this->load->model('Finance_model');
        $this->load->model('general_model');
        $this->load->library('Fx_mailer');
        // $this->load->library('IPLoc');
        $this->load->library('UserAccess');

        //for advertisement cookie
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        if ($this->session->userdata('logged')) {
            $data['cookie'] = array(
                'name'     => 'fullname',
                'value'    => $_SESSION['full_name'],
                'expire'   => time() + (10 * 365 * 24 * 60 * 60),
                'domain'   => '.forexmart.com',
                'secure'   => true,
                'path'     => '/',
                'prefix'   => '',
                'httponly' => true,
            );

            $this->input->set_cookie($data['cookie'], true);

            $nodepositbonus = $this->g_m->showssingle2($table = 'users', $field = 'id', $id = $_SESSION['user_id'], $select = 'nodepositbonus,created,createdforadvertising');

            $data['cookie']['name'] = 'nodepositbonus';
            $data['cookie']['value'] = $nodepositbonus['nodepositbonus'];

            $this->input->set_cookie($data['cookie'], true);
            if (is_null($nodepositbonus['createdforadvertising'])) {
                $data['datecreated'] = $nodepositbonus['created'];
            } else {
                $data['datecreated'] = $nodepositbonus['createdforadvertising'];
            }
            $datecreated = DateTime::createFromFormat('Y-m-d H:i:s', $data['datecreated']);
            $datedifference = $this->g_m->difference_day($datecreated->format('Y-m-d'), $datecurrent = date('Y-m-d'));
            $data['cookie']['name'] = 'datedifference';
            $data['cookie']['value'] = $datedifference;

            $this->input->set_cookie($data['cookie'], true);
            unset($data['cookie']);
            unset($data);
        }//for advertisement cookie
    }

    function balance_transaction(){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        UserAccess::checkUserPermission("baltran");

        $data['active'] = "balance_transactions";
        $data['li_active'] = "li_baltran";

        $user_id = $this->session->userdata('user_id');

        $data['bal_tran'] = $this->account_model->balanceTransaction();
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = "balance";
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->append_metadata_css("  ")
            ->append_metadata_js("   ")
            ->set_layout('mwp/v2_main')
            ->build('balance/balanceTransaction', $data);
    }

    public function get_balanceTransaction(){
        $this->load->library('WebService');
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        $from = date('Y-m-d\T00:00:00', strtotime($this->input->post('from')));
        $to = date('Y-m-d\T23:59:59', strtotime($this->input->post('to')));

        $data['none'] = date('Y-m-d\T00:00:00', strtotime("2015/5/5"));

        $account_info =
            array(
                'from' => $from = $this->input->post('from') != '' ? $from : $data['none'],
                'to'   => $to = $this->input->post('to') != '' ? $to : $data['none']
            );

        $invalid = $to < $from;

        if ($invalid) {
            $data['success'] = 'false';
            $data['msg'] = "There are no data yet.";
        } else {
            $WebService->RequestAllFinanceRecordsByDate($account_info);

            if ($WebService->request_status === 'RET_OK') {
                $data['success'] = 'true';
                $data['result'] = $WebService->get_all_result();

                $data['result1'] = $data['result']['FinanceRecords']->FinanceRecordData;
                foreach ($data['result1'] as $key) {
                    $data['tr'][] = array(
                        $key->Stamp,
                        $key->Comment,
                        $key->Status,
                        $key->AccountNumber,
                        $key->AccountReceiver,
                        $key->Amount,
                        $key->Ticket
                    );
                }
            }
        }
        echo json_encode($data);
    }


    function balance_operations(){
        $this->lang->load('balance_operations');
        UserAccess::checkUserPermission("balops");
        if($this->session->userdata('logged')){
            $data['access'] = UserAccess::ManageAccessList();
            $data['active'] = "balance";
            $data['li_active'] = "li_balops";
            $data['title_page'] = lang('sb_li_0');
            $data['metadata_description'] = lang('hot_dsc');
            $data['metadata_keyword'] = lang('hot_kew');
            $js = $this->template->Js();
            $css = $this->template->Css();
            $this->template->title(lang('hot_tit'))
                ->set_layout('mwp/v2_main')
                ->build('balance/balance_operations',$data);
        }else{
            redirect('signout');
        }
    }

    public function BalOps_History(){
        UserAccess::checkUserPermission("balops");
         if(!$this->input->is_ajax_request()){die('Not authorized!');}
            
             $account = $this->input->post('account_number');
            // $account = 159802;   TEST
            // $data['none1'] = DateTime::createFromFormat('Y/d/m', date('2016/13/11'));    TEST
            // $data['none2'] = DateTime::createFromFormat('Y/d/m', date('2017/23/2'));     TEST

            $data['from'] = DateTime::createFromFormat('Y/d/m', $this->input->post('from',true));
            $data['none'] = DateTime::createFromFormat('Y/d/m', date('2015/5/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', $this->input->post('to',true).' 23:59:59');

            $data['mtas'] = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
            // $data['data']['accountnumber']=$data['mtas']['account_number'];
            $account_info = array(
                'iLogin' => $account,
                'from' => $this->input->post('from',true) !=''? $data['from']->format('Y-m-d\TH:i:s'):Null ,
                'to' => $this->input->post('to',true) !=''?$data['to']->format('Y-m-d\TH:i:s'):Null
            );

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_GetAccountTradesHistory($account_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('TradeDataList');
                    if($tradatalist){
                        $closed='';
                        foreach ( $tradatalist['TradeData'] as $object){

                            if (floatval($object->Volume)!=0 ){
                                $data['volume']=(floatval($object->Volume)/100);
                            }else{
                                $data['volume']=floatval($object->Volume);
                            }

                            $closed.='<tr>';
                            $closed.='<td>'.$object->OrderTicket.'</td>';
                            $closed.='<td>'.$object->TradeType.'</td>';
                            $closed.='<td>'. $data['volume'].'</td>';
                            $closed.='<td>'.$object->Symbol.'</td>';
                            $closed.='<td>'.$object->OpenPrice.'</td>';
                            $closed.='<td>'.$object->StopLoss.'</td>';
                            $closed.='<td>'.$object->TakeProfit.'</td>';
                            $closed.='<td>'.$object->ClosePrice.'</td>';
                            $closed.='<td>N/A</td>';
                            $closed.='<td>'.$object->Profit.'</td>';
                            $closed.='</tr>';
                        }
                        $data['data']['CancelledPendingOrder']= '';
                        $data['data']['Closed']= $closed;
                    }else{
                        $data['data']['CancelledPendingOrder']= '';
                        $data['data']['Closed']= '';
                    }
                    break;
                default:
                    $data['data']['error']=true;
            }
            $account_info2 = array(
                'iLogin' => $account,
                'from' => $this->input->post('from',true) !=''? $data['from']->format('Y-m-d\TH:i:s'):$data['none']->format('Y-m-d\TH:i:s') ,
                'to' => $this->input->post('to',true) !=''?$data['to']->format('Y-m-d\TH:i:s'):$data['none']->format('Y-m-d\TH:i:s')
                // 'from' => $this->input->post('from',true) !=''? $data['from']->format('Y-m-d\TH:i:s'):$data['none1']->format('Y-m-d\TH:i:s') ,   TEST
                // 'to' => $this->input->post('to',true) !=''?$data['to']->format('Y-m-d\TH:i:s'):$data['none2']->format('Y-m-d\TH:i:s')    TEST
            );
            $WebServiceBalOpe = new WebService($webservice_config);
            $WebServiceBalOpe->open_RequestAccountFinanceRecordsByDate($account_info2);

            switch($WebServiceBalOpe->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebServiceBalOpe->get_result('FinanceRecords');

                    if($tradatalist){
                        $holder1='';
                        $holder2='';
                        $holder3='';
                        $holder4='';
                        $data['data']['bonus']=false;
                        $data['data']['deposit']=false;
                        $data['data']['withdraw']=false;
                        $data['data']['transfer']=false;
                        foreach ( $tradatalist['FinanceRecordData'] as $object){

                            if ($object->FundType=='BONUS'){
                                $data['data']['bonus']=true;
                                $holder1.='<tr>';
                                $holder1.='<td>'.$object->Ticket.'</td>';
                                $holder1.='<td>'.$object->FundType.'</td>';
                                $holder1.='<td>'.$object->Amount.'</td>';
                                $holder1.='<td>'.$object->Status.'</td>';
                                $holder1.='<td>'.$object->Stamp.'</td>';
                                $holder1.='<td>'.$object->Operation.'</td>';
                                $holder1.='</tr>';
                            }
                            if ($object->Operation=='REAL_FUND_DEPOSIT'){
                                $data['data']['deposit']=true;
                                $holder2.='<tr>';
                                $holder2.='<td>'.$object->Ticket.'</td>';
                                $holder2.='<td>'.$object->FundType.'</td>';
                                $holder2.='<td>'.$object->Amount.'</td>';
                                $holder2.='<td>'.$object->Status.'</td>';
                                $holder2.='<td>'.$object->Stamp.'</td>';
                                $holder2.='<td>'.$object->Operation.'</td>';
                                $holder2.='</tr>';
                            }
                            if ($object->Operation=='REAL_FUND_WITHDRAW'){
                                $data['data']['withdraw']=true;
                                $holder3.='<tr>';
                                $holder3.='<td>'.$object->Ticket.'</td>';
                                $holder3.='<td>'.$object->FundType.'</td>';
                                $holder3.='<td>'.$object->Amount.'</td>';
                                $holder3.='<td>'.$object->Status.'</td>';
                                $holder3.='<td>'.$object->Stamp.'</td>';
                                $holder3.='<td>'.$object->Operation.'</td>';
                                $holder3.='</tr>';

                            }
                            if ($object->Operation=='REAL_FUND_TRANSFER'){
                                $data['data']['transfer']=true;
                                $holder4.='<tr>';
                                $holder4.='<td>'.$object->Ticket.'</td>';
                                $holder4.='<td>'.$object->FundType.'</td>';
                                $holder4.='<td>'.$object->Amount.'</td>';
                                $holder4.='<td>'.$object->Status.'</td>';
                                $holder4.='<td>'.$object->Stamp.'</td>';
                                $holder4.='<td>'.$object->Operation.'</td>';
                                $holder4.='</tr>';
                            }
                        }
                        $data['data']['BalOpe_bonus'] = $holder1;
                        $data['data']['BalOpe_deposit'] = $holder2;
                        $data['data']['BalOpe_withdraw'] = $holder3;
                        $data['data']['BalOpe_transfer'] = $holder4;
                    }else{
                        $data['data']['BalOpe_bonus'] = '';
                        $data['data']['BalOpe_deposit'] = '';
                        $data['data']['BalOpe_withdraw'] = '';
                        $data['data']['BalOpe_transfer'] = '';
                    }
                    break;
                default:
                    $data['data']['error2']=true;
                    $data['data']['bonus']=false;
                    $data['data']['deposit']=false;
                    $data['data']['withdraw']=false;
                    $data['data']['transfer']=false;
            }
            //print_r($data['data']); exit;     TEST
            echo json_encode($data['data']);
            unset($data);
        }

    public function records(){
        $this->lang->load('balance_operations');
        UserAccess::checkUserPermission("balrecords");

        if($this->session->userdata('logged')){
            $data['access'] = UserAccess::ManageAccessList();
            $data['active'] = "balance";

            $this->template->title("MWP | Forexmart")
                ->set_layout('mwp/v2_main')
                ->build('balance/records',$data);
        }else{
            redirect('signout');
        }
    }
    public function HistoryOfTrades(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $this->load->model('General_model');
        $this->g_m= $this->General_model;
        $data['from'] = date('Y-m-d\T00:00:00',strtotime($this->input->post('from')));

        $data['none'] = date('Y-m-d\T00:00:00',strtotime('2015/5/5'));
//        $data['from'] = $data['none'];
        $data['to'] = date('Y-m-d\T23:59:59',strtotime($this->input->post('to')));
        $account_number = $this->input->post('account_number');
        $data['data']['accountnumber']=$account_number;
        $account_info = array(
            'iLogin' => $account_number,
            'from' => $this->input->post('from')!=''?$data['from']:$data['none'],
            'to' => $this->input->post('to')!=''?$data['to']: date('Y-m-d\T23:59:59',strtotime("today")),
        );
//        print_r($account_info);
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->open_GetAccountTradesHistory($account_info);
        switch($WebService->request_status){
            case 'RET_OK':
                $tradatalist = (array) $WebService->get_result('TradeDataList');
                if($tradatalist){
                    $closed='';
                    foreach ( $tradatalist['TradeData'] as $object){
                        $closed.='<tr>';
                        $closed.='<td>'.$object->OrderTicket.'</td>';
                        $closed.='<td>'.$object->TradeType.'</td>';
                        $closed.='<td>'.$object->Volume.'</td>';
                        $closed.='<td>'.$object->Symbol.'</td>';
                        $closed.='<td>'.$object->OpenPrice.'</td>';
                        $closed.='<td>'.$object->StopLoss.'</td>';
                        $closed.='<td>'.$object->TakeProfit.'</td>';
                        $closed.='<td>'.$object->ClosePrice.'</td>';
                        $closed.='<td>N/A</td>';
                        $closed.='<td>'.$object->Profit.'</td>';
                        $closed.='</tr>';
                    }
                    $data['data']['CancelledPendingOrder']= '';
                    $data['data']['Closed']= $closed;
                }else{
                    $data['data']['CancelledPendingOrder']= '';
                    $data['data']['Closed']= '';
                }
                break;
            default:
                $data['data']['error']=true;
        }

//        print_r($data['data']['Closed']);
        $account_info2 = array(
            'iLogin' => $account_number,
//            'iLogin' => 183973,
            'from' => $this->input->post('from')!=''?$data['from']:$data['none'],
            'to' => $this->input->post('to')!=''?$data['to']: date('Y-m-d\T23:59:59',strtotime("today")),
        );
//        print_r($account_info2);
        $WebServiceBalOpe = new WebService($webservice_config);
        $WebServiceBalOpe->open_RequestAccountFinanceRecordsByDate2($account_info2);
        $holder1='';
        $holder2='';
        $holder3='';
        $holder4='';
        $data['data']['success'] = false;
        switch($WebServiceBalOpe->request_status){
            case 'RET_OK':
                $tradatalist = (array) $WebServiceBalOpe->finance;
                if($tradatalist){

                    $data['data']['bonus']=false;
                    $data['data']['deposit']=false;
                    $data['data']['withdraw']=false;
                    $data['data']['transfer']=false;
                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS'){
                            $data['data']['bonus']=true;
                            $holder1.='<tr>';
                            $holder1.='<td>'.$object->Ticket.'</td>';
                            $holder1.='<td>'.$object->FundType.'</td>';
                            $holder1.='<td>'.$object->Amount.'</td>';
                            $holder1.='<td>'.$object->Status.'</td>';
                            $holder1.='<td>'.$object->Stamp.'</td>';
                            $holder1.='<td>'.$object->Operation.'</td>';
                            $holder1.='</tr>';
                        }
                        if ($object->Operation=='REAL_FUND_DEPOSIT'){
                            $data['data']['deposit']=true;
                            $holder2.='<tr>';
                            $holder2.='<td>'.$object->Ticket.'</td>';
                            $holder2.='<td>'.$object->FundType.'</td>';
                            $holder2.='<td>'.$object->Amount.'</td>';
                            $holder2.='<td>'.$object->Status.'</td>';
                            $holder2.='<td>'.$object->Stamp.'</td>';
                            $holder2.='<td>'.$object->Operation.'</td>';
                            $holder2.='</tr>';
                        }
                        if ($object->Operation=='REAL_FUND_WITHDRAW'){
                            $data['data']['withdraw']=true;
                            $holder3.='<tr>';
                            $holder3.='<td>'.$object->Ticket.'</td>';
                            $holder3.='<td>'.$object->FundType.'</td>';
                            $holder3.='<td>'.$object->Amount.'</td>';
                            $holder3.='<td>'.$object->Status.'</td>';
                            $holder3.='<td>'.$object->Stamp.'</td>';
                            $holder3.='<td>'.$object->Operation.'</td>';
                            $holder3.='</tr>';

                        }
                        if ($object->Operation=='REAL_FUND_TRANSFER'){
                            $data['data']['transfer']=true;
                            $holder4.='<tr>';
                            $holder4.='<td>'.$object->Ticket.'</td>';
                            $holder4.='<td>'.$object->FundType.'</td>';
                            $holder4.='<td>'.$object->Amount.'</td>';
                            $holder4.='<td>'.$object->Status.'</td>';
                            $holder4.='<td>'.$object->Stamp.'</td>';
                            $holder4.='<td>'.$object->Operation.'</td>';
                            $holder4.='</tr>';
                        }
                    }
                    $data['data']['BalOpe_bonus'] = $holder1;
                    $data['data']['BalOpe_deposit'] = $holder2;
                    $data['data']['BalOpe_withdraw'] = $holder3;
                    $data['data']['BalOpe_transfer'] = $holder4;
                    $data['data']['success'] = true;
                }else{
                    $data['data']['BalOpe_bonus'] = '';
                    $data['data']['BalOpe_deposit'] = '';
                    $data['data']['BalOpe_withdraw'] = '';
                    $data['data']['BalOpe_transfer'] = '';
                    $data['data']['success'] = true;
                }
                break;
            default:
                $data['data']['error2']=true;
                $data['data']['bonus']=false;
                $data['data']['deposit']=false;
                $data['data']['withdraw']=false;
                $data['data']['transfer']=false;
                $data['data']['success'] = false;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data['data']));
        unset($data);

    }
    public function CancelledPendingOrders(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        UserAccess::checkUserPermission("balops");
        $this->load->model('General_model');
        $this->g_m= $this->General_model;
        $data['from'] = DateTime::createFromFormat('Y/d/m', $this->input->post('from',true));
        $data['none'] = DateTime::createFromFormat('Y/d/m', date('2015/5/5'));
        $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', $this->input->post('to',true).' 23:59:59');

        $account_number = $this->input->post('account_number');
        $data['data']['accountnumber']=$account_number;
        $account_info = array(
            'iLogin' =>$account_number,
            'from' => $this->input->post('from',true) !=''? date('Y-m-d\TH:i:s',strtotime($data['from'])):Null ,
            'to' => $this->input->post('to',true) !=''?date('Y-m-d\TH:i:s',strtotime($data['to'])):Null
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->GetAccountCancelledPendingOrders($account_info);
        switch($WebService->request_status){
            case 'RET_OK':
                $tradatalist = (array) $WebService->get_result('TradeDataList');
                if($tradatalist){
                    $closed='';
                    foreach ( $tradatalist['TradeData'] as $object){
                        $closed.='<tr>';
                        $closed.='<td>'.$object->OrderTicket.'</td>';
                        $closed.='<td>'.$object->TradeType.'</td>';
                        $closed.='<td>'.number_format((float) $object->Volume,2).'</td>';
                        $closed.='<td>'.$object->Symbol.'</td>';
                        $closed.='<td>'.$object->OpenPrice.'</td>';
                        $closed.='<td>'.number_format((float) $object->StopLoss,5).'</td>';
                        $closed.='<td>'.number_format((float) $object->TakeProfit,5).'</td>';
                        $closed.='<td>'.$object->ClosePrice.'</td>';
                        $closed.='<td>N/A</td>';
                        $closed.='<td>'.number_format((float) $object->Profit,5).'</td>';
                        $closed.='</tr>';
                    }
                    $data['data']['CancelledPendingOrder']= '';
                    $data['data']['Closed']= $closed;
                }else{
                    $data['data']['CancelledPendingOrder']= '';
                    $data['data']['Closed']= '';
                }
                break;
            default:
                $data['data']['error']=true;
        }


        echo json_encode($data['data']);
        unset($data);

    }

}











