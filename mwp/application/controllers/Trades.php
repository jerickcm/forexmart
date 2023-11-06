<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Trades extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) { // logged in
            redirect('signin');
        }
        $this->load->library('UserAccess');
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
    }

    public function index()
    {
        UserAccess::checkUserPermission("part");
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = "trades";
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("")
            ->append_metadata_js("")
            ->set_layout('mwp/v2_main')
            ->build('accounts/trades', $data);
    }
    public function search_current_trades()
    {
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = "trades";
        $this->form_validation->set_rules('account_number_cur', 'account number', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $account = $this->input->post('account_number_cur');
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array('iLogin' => $account);
            $curTotal = 0;
            $WebService->open_GetAccountActiveTrades($account_info);
            if ($WebService->request_status) {
                $tradatalist = (array) $WebService->get_result('TradeDataList');
                $opened = '';
                if ($tradatalist) {
                    foreach ($tradatalist['TradeData'] as $key) {
                        $data['volume'] = floatval($key->Volume)!=0?(floatval($key->Volume)/100):floatval($key->Volume);
                        $curTotal = floatval($curTotal) + floatval($data['volume']);
                    }
                    $data['result'] = true;
                    $data['curtrade'] = $tradatalist['TradeData'];
                    $data['account_number'] = $account;
                } else {
                    $opened .= '<tr><td colspan="10">No data found.</td></tr>';
                    $data['result'] = false;
                    $data['curtrade'] = $opened;
                }
            }
            $data['curtotal'] = $curTotal;
        }
        $this->template->title("Administration | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('accounts/trades', $data);
    }
    public function search_history_trades(){
//        if ($this->input->is_ajax_request()) {
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = "trades";
        $this->form_validation->set_rules('account_number_his', 'account number', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
        $account = $this->input->post('account_number_his');
            $data['totalTradedVolume'] = $this->getTotalTrade($account)['TotalVolume'];
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
            $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
            $account_info = array(
                'iLogin' => $account,
                'from'   => $from->format('Y-m-d\TH:i:s'),
                'to'     => $to->format('Y-m-d\TH:i:s'),
            );
            $WebService->open_GetAccountTradesHistory($account_info);
            if($WebService->request_status){
                $tradatalist = (array) $WebService->get_result('TradeDataList');
                $opened = '';
                if ($tradatalist) {
                    foreach ($tradatalist['TradeData'] as $object) {
                        if (floatval($object->Volume)!=0 ){
                            $data['volume']=(floatval($object->Volume)/100);
                        }else{
                            $data['volume']=floatval($object->Volume);
                        }
                        $opened .= '<tr>';
                        $opened .= '<td>' . date('Y-M-d H:i:s',strtotime($object->CloseTime)). '</td>';
                        $opened .= '<td>' . $object->OrderTicket . '</td>';
                        $opened .= '<td>' . $object->TradeType . '</td>';
                        $opened .= '<td>' . $data['volume'] . '</td>';
                        $opened .= '<td>' . $object->Symbol . '</td>';
                        $opened .= '<td>' . $object->OpenPrice . '</td>';
                        $opened .= '<td>' . $object->StopLoss . '</td>';
                        $opened .= '<td>' . $object->TakeProfit . '</td>';
                        $opened .= '<td>' . $object->ClosePrice . '</td>';
                        $opened .= '<td>N/A</td>';
                        $opened .= '<td>' . $object->Profit . '</td>';
                        $opened .= '</tr>';
                    }
                    $data['his_result'] = true;
                    $data['opened'] = $opened;
                    $data['trade'] = $tradatalist['TradeData'];
//                    echo "<pre>";
//                    print_r($data['trade']);exit;
                }else{
                    $opened .= '<tr><td colspan="10">No data found.</td></tr>';
                    $data['his_result'] = true;
                    $data['opened'] = $opened;
                }
            }
        }

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("")
            ->append_metadata_js("<script> 
             
           </script>")
            ->set_layout('mwp/v2_main')
            ->build('accounts/trades', $data);
    }
    public function getTotalTrade($account){
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $account_info = array( 'iLogin' => $account);
        $WebService->GetAccountTotalTradedVolume($account_info);
        if($WebService->request_status=='RET_OK'){
            $data = $WebService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }

    public function getTrades_test(){
//            $account = $this->input->post('account_number_his');
//            $account = 245444;
            $account = 251278;
            $data['totalTradedVolume'] = $this->getTotalTrade($account)['TotalVolume'];
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
            $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
            $account_info = array(
                'iLogin' => $account,
                'from'   => $from->format('Y-m-d\TH:i:s'),
                'to'     => $to->format('Y-m-d\TH:i:s'),
            );
            $WebService->open_GetAccountTradesHistory($account_info);
            $total = 0;
            if($WebService->request_status){
                $tradatalist = (array) $WebService->get_result('TradeDataList');
                $opened = '';
                if ($tradatalist) {
                    foreach ($tradatalist['TradeData'] as $object) {
                        if (floatval($object->Volume)!=0 ){
                            $data['volume']=(floatval($object->Volume)/100);
                        }else{
                            $data['volume']=floatval($object->Volume);
                        }
                        $total = floatval($total) + floatval($data['volume']);
                        $opened .= '<tr>';
                        $opened .= '<td>' . date('Y-M-d H:i:s',strtotime($object->CloseTime)). '</td>';
                        $opened .= '<td>' . $object->OrderTicket . '</td>';
                        $opened .= '<td>' . $object->TradeType . '</td>';
                        $opened .= '<td>' . $data['volume'] . '</td>';
                        $opened .= '<td>' . $object->Symbol . '</td>';
                        $opened .= '<td>' . $object->OpenPrice . '</td>';
                        $opened .= '<td>' . $object->StopLoss . '</td>';
                        $opened .= '<td>' . $object->TakeProfit . '</td>';
                        $opened .= '<td>' . $object->ClosePrice . '</td>';
                        $opened .= '<td>N/A</td>';
                        $opened .= '<td>' . $object->Profit . '</td>';
                        $opened .= '</tr>';
                    }
                    $data['his_result'] = true;
                    $data['opened'] = $opened;
                    $data['trade'] = $tradatalist['TradeData'];
//                    echo "<pre>";
//                    print_r($data['trade']);exit;
                }else{
                    $opened .= '<tr><td colspan="10">No data found.</td></tr>';
                    $data['his_result'] = true;
                    $data['opened'] = $opened;
                }
            }
            $active = $this->test_current_trades($account);
        $totalv2 = floatval($total) + floatval($active['activeTotal']);
       echo "<pre>";
       print_r($totalv2);
        echo "<br >";
        print_r($total);
        echo "<br >";
       print_r($active['tradalist']);
        echo "<br >";
       print_r($tradatalist);exit;
    }
    public function test_current_trades($account){

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array('iLogin' => $account);
            $WebService->open_GetAccountActiveTrades($account_info);
            $activeTotal = 0;
            if($WebService->request_status){
                $tradatalist = (array) $WebService->get_result('TradeDataList');
                $opened = '';
                if ($tradatalist) {
                    $data['tradalist'] = $tradatalist;
                    foreach ($tradatalist['TradeData'] as $object) {
                        if (floatval($object->Volume)!=0 ){
                            $data['volume']=(floatval($object->Volume)/100);
                        }else{
                            $data['volume']=floatval($object->Volume);
                        }
                        $activeTotal = floatval($activeTotal) + floatval($data['volume']);
                        $opened .= '<tr>';
                        $opened .= '<td>' .date('Y-M-d H:i:s',strtotime($object->CloseTime)). '</td>';
                        $opened .= '<td>' . $object->OrderTicket . '</td>';
                        $opened .= '<td>' . $object->TradeType . '</td>';
                        $opened .= '<td>' . $data['volume'] . '</td>';
                        $opened .= '<td>' . $object->Symbol . '</td>';
                        $opened .= '<td>' . $object->OpenPrice . '</td>';
                        $opened .= '<td>' . $object->StopLoss . '</td>';
                        $opened .= '<td>' . $object->TakeProfit . '</td>';
                        $opened .= '<td>' . $object->ClosePrice . '</td>';
                        $opened .= '<td>N/A</td>';
                        $opened .= '<td>' . $object->Profit . '</td>';
                        $opened .= '</tr>';
                    }
                    $data['result'] = true;
                    $data['opened'] = $opened;
                    $data['account_number'] = $account;
                }else{
                    $opened .= '<tr><td colspan="10">No data found.</td></tr>';
                    $data['result'] = false;
                    $data['opened'] = $opened;
                }
            }
            $data['activeTotal'] = $activeTotal;
        return $data;
    }
}