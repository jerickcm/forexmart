
<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Quick_jump extends CI_Controller {
    private $transaction_type = array(
        'BT' => 'Bank Transfer',
        'CC' => 'Debit/Credit Card (CardPay)',
        'SK' => 'Skrill',
        'UP' => 'China UnionPay',
        'NT' => 'Neteller',
        'WM' => 'WebMoney',
        'PX' => 'Paxum',
        'UK' => 'Ukash',
        'PC' => 'Payco',
        'FP' => 'FILSPay',
        'CU' => 'CashU',
        'PP' => 'PayPal',
        'QW' => 'Qiwi',
        'MT' => 'MegaTransfer',
        'MTC' => 'MegaTransfer card',
        'YAN' => 'Yandex Money',
        'BC' => 'BitCoin',
        'MN' => 'Moneta',
        'SF' => 'Sofort'
    );
    public function __construct()
    {

        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {                                    // logged in
            redirect('signin');
        }
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
        $this->lang->load('ForexMart_Internal', 'english');
        $this->load->model('account_model');
        $this->load->model('User_model');
        $this->load->model('Finance_model');
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        $this->load->model('Quick_model');
        $this->q_m = $this->Quick_model;
        $this->load->library('WebService');
    }


    public function index()
    {
        UserAccess::checkUserPermission("qjum");
        $data['active'] = 'quick-jump';
        $data['li_active'] = 'li_personal';
        $data['access'] = UserAccess::ManageAccessList();
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->form_validation->set_rules('account', 'account', 'trim|required|xss_clean');
        if ($this->form_validation->run()){
            $field = $this->input->post('account');
            $dbInfo  = $this->q_m->getSearch($field);
            $success = count($dbInfo)>0?true:false;
            $record = '';
            foreach ($dbInfo as $key){
                $str = urlencode(utf8_encode($field));
                $info = $this->getUserdetails($key['account_number']);
                $name = $info['Name']!=''?$info['Name']:$key['full_name'];
                $email = $info['Email']!=''?$info['Email']:$key['email'];
                $user_type = $key['login_type']==1?'Partner':'Client';
                $record .= '<tr><td>'.$key['account_number'].'</td>';
                $record .= '<td>'.$name.'</td>';
                $record .= '<td>'.$email.'</td>';
                $record .= '<td>'.$user_type.'</td>';
                $record .= '<td><a href="'.FXPP::loc_url("quick-jump/personal-profile/".$key['account_number'].'/'.$str).'" class="style-table-in-button view-profile" data-search="'.$str.'">View Full Profile</a></td></tr>';
            }
            $data['success'] = $success;
            $data['info'] = $record;
            $data['previous'] = $field;
        }
        $this->template->title("Administration | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('quick_jump/new_landing', $data);
    }
    public function search_accountNumber(){
        if ($this->input->is_ajax_request()) {
            $field = $this->input->post('account');
            $dbInfo  = $this->q_m->getSearch($field);
            $success = count($dbInfo)>0?true:false;
            $record = '';
            foreach ($dbInfo as $key){
                $str = urlencode(utf8_encode($field));
                $info = $this->getUserdetails($key['account_number']);
                $name = $info['Name']!=''?$info['Name']:$key['full_name'];
                $email = $info['Email']!=''?$info['Email']:$key['email'];
                $user_type = $key['login_type']==1?'Partner':'Client';
                $record .= '<tr><td>'.$key['account_number'].'</td>';
                $record .= '<td>'.$name.'</td>';
                $record .= '<td>'.$email.'</td>';
                $record .= '<td>'.$user_type.'</td>';
                $record .= '<td><a href="'.FXPP::loc_url("quick-jump/personal-profile/".$key['account_number'].'/'.$str).'" class="style-table-in-button view-profile" data-search="'.$field.'">View Full Profile</a></td></tr>';
            }
            $data = array(
                'success'=>$success,
                'info' => $record,
                'search' =>$field
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function get_all(){
        if ($this->input->is_ajax_request()) {
            $draw = (int)$this->input->post('draw');
            $start = $this->input->post('start');
            $length = $this->input->post('length');
            $search = $this->input->post('search');
            if( trim($search['value'])!=''){
                $row_accounts = $this->q_m->getPendingSearch($length, $start, trim($search['value']));
                $data_accounts = $this->q_m->getPendingSearchCount(trim($search['value']));
            }else{
                $row_accounts = $this->q_m->getPending($length, $start);
                $data_accounts = $this->q_m->getPendingCount();
            }
            $accounts = array();
            foreach ($row_accounts as $key) {
                $info= $this->getUserdetails($key['account_number']);
                $name = $key['account_number']!=''?$info['Name']:$key['full_name'];
                $email = $key['account_number']!=''?$info['Email']:$key['email'];
                $usertype = $key['login_type']==1?'Partner':'Client';
                $accounts[] = array(
                    '<tr role="row" class="odd"><td>'.$key['account_number'].'<td>',
                    '<td>'.$name.'</td>',
                    '<td>'.$email.'</td>',
                    '<td>'.$usertype.'</td>',
                    '<td><a href="'.FXPP::loc_url("quick-jump/personal-profile/".$key["account_number"]).'" class="style-table-in-button view-profile">View Full Profile</a></td></tr>'
                );
            }
            $recordsTotal = count($data_accounts);
            $recordsFiltered = count($data_accounts);
            $data = array(
                'token'=>$search,
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $accounts
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    public function getInactivedetails($account_number){
        $webservice_config = array(  'server' => 'live_new'  );
        $webService = new WebService($webservice_config);
        $data = array( 'iLogin' => $account_number );
        $webService->request_inactive_details($data);
        if ($webService->request_status === 'RET_OK') {
            $data = $webService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }
    public function personal_profile($account){
        UserAccess::checkUserPermission("qjum");
        $data['access'] = UserAccess::ManageAccessList();
        $apiInfo_active= $this->getUserdetails($account);
        $apiInfo_inactive= $this->getInactivedetails($account);
        $data['apiInfo']=$apiInfo_active==false?$apiInfo_inactive:$apiInfo_active;
        if($apiInfo_active==false){
            $data['apiStatus'] = 'Inactive';
        }else if($apiInfo_active!=false && $apiInfo_inactive!=false ){
            $data['apiStatus'] = 'Restored';
        }else{ $data['apiStatus'] = ''; }
        $data['dbInfo']= $this->q_m->getAccountsByIdType1($account);
        $user_id0 = $this->general_model->showssingle('mt_accounts_set', 'account_number', $account, 'user_id')['user_id'];
        $user_id1 = $this->general_model->showssingle('partnership', 'reference_num', $account, 'partner_id')['partner_id'];
        $user_id = count($user_id0)>0?$user_id0:$user_id1;
        $logintype =  $this->general_model->showssingle('users', 'id', $user_id, '*')['login_type'];
        $data['logintype'] =  $this->general_model->showssingle('users', 'id', $user_id, '*')['login_type'];
        $data['agentStats'] =  $this->GetAgentStats($account);
        
        $data['affiliate_code'] =  $logintype==1?$this->general_model->showssingle('partnership_affiliate_code', 'partner_id', $user_id, 'affiliate_code')['affiliate_code']:$this->general_model->showssingle('users_affiliate_code', 'users_id', $user_id, 'affiliate_code')['affiliate_code'];
        $agent_id = $this->general_model->showssingle('mt_accounts_set', 'account_number', $data['apiInfo']['Agent'], 'user_id')['user_id'];
        if($data['apiInfo']['Agent']!=0){
            $agent = count($agent_id)>0?$agent_id:$this->general_model->showssingle('partnership', 'reference_num', $data['apiInfo']['Agent'], 'partner_id')['partner_id'];
            if(count($agent)>0){
                $logintype =  $this->general_model->showssingle('users', 'id', $agent, '*')['login_type'];
                $data['referral_code'] =  $logintype==0?$this->general_model->showssingle('users_affiliate_code', 'users_id', $agent, 'affiliate_code')['affiliate_code']:$this->general_model->showssingle('partnership_affiliate_code', 'partner_id', $agent, 'affiliate_code')['affiliate_code'];
            }
        }
        $data['history'] = $this->q_m->getAccountUpdateHistoryByUserId1($user_id);
        $data['corp0'] = $this->q_m->getCompanyInfo($account)->business_id;
        $data['corp1'] = $this->q_m->getCompanyInfo($account)->company_name;
        $data['corp2'] = $this->q_m->getCompanyInfo($account)->contact;
        $data['corp3'] = $this->q_m->getCompanyInfo($account)->website;
        $data['corp4'] = $this->q_m->getCompanyInfo($account)->company_trading_name;
        $data['corp5'] = $this->q_m->getCompanyInfo($account)->business_type;
        $data['country'] = $this->general_model->selectOptionList($this->general_model->getCountries());
        $data['leverage'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), "1:200");
        $data['transactions'] = $this->get_transactions($account)['result']['FinanceRecords']->FinanceRecordData;
        $data['previousSearch'] = utf8_decode(urldecode($this->uri->segment(4)));
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("")
            ->append_metadata_js("")
            ->set_layout('mwp/v2_main')
            ->build('quick_jump/v2_personal', $data);
    }
    public function GetAgentStats($iLogin){
        $account_info = array( 'iLogin' => $iLogin );
        $webservice_config = array(  'server' => 'live_new' );
        $WebService2 = new WebService($webservice_config);
        $WebService2->ReqAgentStats($account_info);
        switch ($WebService2->request_status) {
            case 'RET_OK':
                $ReqAgentStats = (array)  $WebService2->get_all_result();
                $data['user_referrals']  = $ReqAgentStats["ReferralsCount"];
                $data['user_commission'] = $ReqAgentStats["TotalCommission"];
                break;
            default:
                $data['user_commission'] = 0;
                $data['user_referrals']  = 0;
        }
        return $data;
    }
    public function update_agent(){
        if ($this->input->is_ajax_request()) {
            $this->load->library('WebService');
            $this->load->model('account_model');
            $this->load->model('general_model');
            $account_number = $this->input->post('account_number');
            $new_agent = $this->input->post('new_agent');
            $old_agent = $this->input->post('old_agent');
            $data['referral_code'] = 'N/A';
            $success = false;
            $user_id = $this->general_model->showssingle('mt_accounts_set', 'account_number', $account_number, 'user_id')['user_id'];
            $data['apiInfo']= $this->getUserdetails($new_agent);
            if($data['apiInfo']['ReqResult']=='RET_OK'){
                $service_data = array(  'AccountNumber' => $account_number,   'AgentAccountNumber' => $new_agent  );
                $webservice_config = array( 'server' => 'live_new' );
                $WebService = new WebService($webservice_config);
                $WebService->SetAccountAgent($service_data);
                if ($WebService->request_status === 'RET_OK') {
                    $success = true;
                    $error='Success.';
                    $agent_id = $this->general_model->showssingle('mt_accounts_set', 'account_number', $new_agent, 'user_id')['user_id'];
                    $agent = count($agent_id)>0?$agent_id:$this->general_model->showssingle('partnership', 'reference_num',$new_agent, 'partner_id')['partner_id'];
                    if(count($agent)>0){
                        $logintype =  $this->general_model->showssingle('users', 'id', $agent, '*')['login_type'];
                        $data['referral_code'] =  $logintype==0?$this->general_model->showssingle('users_affiliate_code', 'users_id', $agent, 'affiliate_code')['affiliate_code']:$this->general_model->showssingle('partnership_affiliate_code', 'partner_id', $agent, 'affiliate_code')['affiliate_code'];
                    }
                    $referral_data = array(  'referral_affiliate_code' => $data['referral_code'] );
                    $this->account_model->updateUserDetails('users_affiliate_code', 'users_id', $user_id, $referral_data);
                }else{
                    $success = false;
                    $error='Web service is not available '. $WebService->request_status;
                    $agent_data = array(
                        'user_id' => $user_id,
                        'account_number' => $account_number,
                        'agent_account_number' => $new_agent
                    );
                    $this->account_model->insertFailedSetAgent($agent_data);
                }
            }else{
                $success = false;
                $error='Account does not exist.';
            }
            if($new_agent!=$old_agent){
                $update_history_data = array(
                    'user_id'       => $user_id,
                    'manager_id'    => $_SESSION['user_id'],
                    'update_url'    => 'MWP/quick-jump/update_agent',
                    'date_modified' => FXPP::getCurrentDateTime()
                );
                $update_history_id = $this->q_m->insertAccountUpdateHistory($update_history_data);
                $update_history_field_data = array();
                $update_history_field_data[] = array('field' => 'Agent', 'old_value' => $old_agent, 'new_value' => $new_agent, 'date_modified' => FXPP::getCurrentDateTime(), 'update_id' => $update_history_id);
                $this->q_m->insertAccountUpdateFieldHistory($update_history_field_data);
            }
            $message = $success?'Successfully updated.':'Failed to update account agent.';
            $this->load->model('Adminslogs_model');
            $arr=array( 'process' => 'Update account agent', 'old agent'=>$old_agent,'new agent'=>$new_agent,'status' => $message, 'Manager_IP'=>$this->input->ip_address() );
            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => 'MWP/quick_jump/update_agent',
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$user_id,
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );
            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            $data = array( 'success' => $success , 'error'=>$error, 'code'=>$data['referral_code'],'agent'=>$new_agent );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    public function getLogs(){
        if ($this->input->is_ajax_request()) {
            $this->load->model('Adminslogs_model');
            $log = $this->Adminslogs_model->getLastLogs();
            $notifs = '';
            foreach($log as $key){
                $date = date('M d, Y | H:i a',strtotime($key['date_processed']));
                $notifs .= '<li><a href="'.FXPP::loc_url('manage-logs/view/').'/'.$key['id'].'">';
                $notifs .= '<span class="style-login-name">'.$key['admin_fullname'].'</span>';
                $notifs .= '<span class="style-login-date">Last modification: <label>'.$date.'</label></span>';
                $notifs .= '</a></li>';
            }
            $notifs .= '<li><a href="'.FXPP::loc_url('manage-logs').'">See All logs</a></li>';
            $data['notifs'] = $notifs;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
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
    public function trades()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->library('WebService');
            $account_number = $this->input->post('account_number');
            $data['totalTradedVolume'] = $this->getTotalTrade($account_number)['TotalVolume'];
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
            $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
            $account_info = array(
                'iLogin' => $account_number,
                'from'   => $from->format('Y-m-d\TH:i:s'),
                'to'     => $to->format('Y-m-d\TH:i:s'),
            );
            $WebService->open_GetAccountTradesHistory($account_info);
            $data['flag'] = false;
            switch ($WebService->request_status) {
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('TradeDataList');
                    if ($tradatalist) {
                        $opened = '';
                        foreach ($tradatalist['TradeData'] as $object) {
                            if (floatval($object->Volume)!=0 ){
                                $data['volume']=(floatval($object->Volume)/100);
                            }else{
                                $data['volume']=floatval($object->Volume);
                            }
                            $opened .= '<tr role="row">';
                            $opened .= '<td>' . date('Y-M-d H:i:s',strtotime($object->CloseTime)) . '</td>';
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
                        $data['flag'] = true;
                    } else {
                        $data['Opened'] = '';
                        $data['msg'] = "There are no data yet.";
                    }
                    break;
                default:
                    $data['msg'] = "There are no data yet.";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function historyOfTrades()
    {

        $this->load->library('WebService');
        $account_number = $this->input->post('account_number');

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        //$data['mtas'] = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");

        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService->open_GetAccountTradesHistory($account_info);
        $data['flag'] = false;
        switch ($WebService->request_status) {
            case 'RET_OK':
                $tradatalist = (array) $WebService->get_result('TradeDataList');

                if ($tradatalist) {
                    $opened = '';
                    foreach ($tradatalist['TradeData'] as $object) {
                        $opened .= '<tr>';
                        $opened .= '<td>' . $object->OrderTicket . '</td>';
                        $opened .= '<td>' . $object->TradeType . '</td>';
                        $opened .= '<td>' . $object->Volume . '</td>';
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
                    $data['Opened'] = $opened;
                    $data['flag'] = true;
                } else {
                    $data['Opened'] = '';
                    $data['msg'] = "There are no data yet.";
                }
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }

        $this->load->view("quick_jump/historyOfTrades", $data);


    }

    public function withdrawal_queue(){
        if ($this->input->is_ajax_request()) {
            $account_number = $this->input->post('account_number');
            $request = $this->q_m->getWithdrawPendingAll($account_number);
//            print_r($request);
            $queue = '';
            foreach ($request as $key){
                $recalled = $key['recall'] ? 'Yes' : 'No';
                $queue .= '<tr><td>'.$key['reference_number'].'</td>';
                $queue .= '<td>'.$key['amount'].' '.$key['currency'].'</td>';
                $queue .= '<td>'.$key['amount_deducted'].' '.$key['currency'].'</td>';
                $queue .= '<td>'.$this->transaction_type[$key['transaction_type']].'</td>';
                $queue .= '<td>'.$key['date_withdraw'].'</td>';
                $queue .= '<td>'.$recalled.'</td></tr>';
            }
            $data['queue'] = $queue;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function testPV($account_number)
    {
        /*$getData = array();
        $select = array();
        $res = array();

        $account_number = $this->input->post('search');
        foreach ($_POST['checkbox'] as $key => $value) {
            $explodedData = explode('.',$value);
            $getData[$explodedData[1]] = $value;
            array_push($select,$value);
        }

        $result = $this->account_model->getSearchAccount($select,$account_number)['column'];

        foreach ($result as $key => $value) {
            $res[$value.'Exist'] = true;
        }

        print_r(json_encode($res));*/

        $user_id = $this->account_model->getUserId($account_number);
        $login_type = $this->account_model->getUserInfo($user_id->id)->login_type;

        $res = array();

        if (strlen($account_number) > 5) {
            $isAccountExist = $this->account_model->getUserId($account_number)->id;

            if ($isAccountExist) {
                //$data['personal_log'] = $this->account_model->getHistoryLog($account_number);
                $searchData = $this->account_model->getSearchData($account_number);
                $this->load->library('WebService');

                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iLogin' => $account_number,
                );

                if ($login_type) {
                    $current_account_data = $this->account_model->getSearchData($account_number);
                } else {
                    $current_account_data = $this->account_model->getAccountsByIdType($account_number, 1);
                }

                //$data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), isset($current_account_data['country']) ? $current_account_data['country'] : "");
                //$data['leverages'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), isset($current_account_data['leverage']) ? $current_account_data['leverage'] : "1:200");
                $WebService->request_account_details($account_info);
                //$data['flag'] = false;

                switch ($WebService->request_status) {
                    case 'RET_OK':
                        $data['street'] = $WebService->get_result('Address');
                        //$data['street']['label'] = 'Street';
                        $data['city'] = $WebService->get_result('City');
                        //$data['city']['label'] = 'City';
                        $data['country'] = $WebService->get_result('Country');
                        //$data['country']['label'] = 'Country';
                        $data['email'] = array('value' => $WebService->get_result('Email'), 'lbl' => 'Email');
                        //$data['email']['label'] = 'Email';
                        $data['full_name'] = array('value' => $WebService->get_result('Name'), 'lbl' => 'Name');
//                        $data['full_name']['label'] = 'Name';
                        $data['phone1'] = $WebService->get_result('PhoneNumber');
                        //$data['phone1']['label'] = 'Phone Number';
                        $data['state'] = $WebService->get_result('State');
                        //$data['state']['label'] = 'State';
                        $data['zip'] = $WebService->get_result('ZipCode');
//                        $data['zip']['label'] = 'Zip Code';

                        $data['Agent'] = $WebService->get_result('Agent');
                        $data['AgentSpecified'] = $WebService->get_result('AgentSpecified');
                        $data['Comment'] = $WebService->get_result('comment');
                        $data['Group'] = $WebService->get_result('Group');
                        $data['IsEnable'] = $WebService->get_result('IsEnable');
                        $data['IsReadOnly'] = $WebService->get_result('IsReadOnly');
                        $data['Leverage'] = $WebService->get_result('Leverage');
                        $data['LogIn'] = $WebService->get_result('LogIn');
                        $data['RegDate'] = $WebService->get_result('RegDate');
                        $data['ShortDealsCount'] = $WebService->get_result('ShortDealsCount');
                        break;
                    default:
                        $data['msg'] = "There are no data yet.";
                }

                $WebService->open_RequestAccountBalance($account_info);

                switch ($WebService->request_status) {
                    case 'RET_OK':

                        $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                        break;
                    default:
                        $data['msg'] = "There are no data yet.";
                }

                $data['menu'] = "accordion-quick-jump";
                $data['active'] = "personal";

                $data['FullNameVal'] = $searchData['full_name'];
                $data['DobVal'] = $searchData['dob'];
                $data['StreetAddressVal'] = $searchData['street'];
                $data['access'] = UserAccess::ManageAccessList();

                $getData = array();
                $select = array('email', 'full_name');

                $selectData = $this->account_model->getSearchAccount($select, $account_number)['column'];
                $row = '';
                $testValue = array();

                $selectData = array_diff($selectData, array('reference_num', 'account_number'));

                foreach ($selectData as $key => $value) {
                    if (in_array($key, $data)) {
                        array_push($testValue, $value);
                        $row .= '<tr>
                            <td class="col-md-4"><label for="name">' . $data[$value]['lbl'] . ':</label></td>
                            <td class="col-md-8"><input class="form-control input-sm" type="text" id="' . $value . '" value="' . $data[$value]['value'] . '"></td>
                        </tr>';
                    } else {
                        $res[$value] = false;
                    }
                }

                $result['res'] = $testValue;
                $result['data'] = $data;
                $result['str'] = $row;

//                }
            }
            echo '<pre>';
            print_r($result);
            echo '</pre>';
        }
    }

    public function profileView()
    {
        //$account_number = $this->input->post('search');
        $account_number = $this->input->post('account_number');
        //$account_number = 104429;

        $user_id = $this->account_model->getUserId($account_number);
        $login_type = $this->account_model->getUserInfo($user_id->id)->login_type;

        if (strlen($account_number) > 5) {
            $isAccountExist = $this->account_model->getUserId($account_number)->id;

//            print_r($isAccountExist );exit;
            if ($isAccountExist) {
                $data['personal_log'] = $this->account_model->getHistoryLog($account_number);
                $this->load->library('WebService');

                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array('iLogin' => $account_number,);

                if ($login_type) {
                    $current_account_data = $this->account_model->getSearchData($account_number);
                } else {
                    $current_account_data = $this->account_model->getAccountsByIdType($account_number, 1);
                }

                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), isset($current_account_data['country']) ? $current_account_data['country'] : "");
                $data['leverages'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), isset($current_account_data['leverage']) ? $current_account_data['leverage'] : "1:200");
                $WebService->request_account_details($account_info);
                $data['flag'] = false;

                $row = '';

                switch ($WebService->request_status) {
                    case 'RET_OK':
                        $data['street'] = array('value' => $WebService->get_result('Address'), 'label' => 'Street');
                        $data['city'] = array('value' => $WebService->get_result('City'), 'label' => 'City');
                        $data['country'] = array('value' => $WebService->get_result('Country'), 'label' => 'Country');
                        $data['email'] = array('value' => $WebService->get_result('Email'), 'label' => 'Email');
                        $data['full_name'] = array('value' => $WebService->get_result('Name'), 'label' => 'Name');
                        $data['phone1'] = array('value' => $WebService->get_result('PhoneNumber'), 'label' => 'Phone Number');
                        $data['state'] = array('value' => $WebService->get_result('State'), 'label' => 'State');
                        $data['zip'] = array('value' => $WebService->get_result('ZipCode'), 'label' => 'Zip Code');

                        $data['Agent'] = $WebService->get_result('Agent');
                        $data['AgentSpecified'] = $WebService->get_result('AgentSpecified');
                        $data['Comment'] = $WebService->get_result('comment');
                        $data['Group'] = $WebService->get_result('Group');
                        $data['IsEnable'] = $WebService->get_result('IsEnable');
                        $data['IsReadOnly'] = $WebService->get_result('IsReadOnly');
                        $data['Leverage'] = $WebService->get_result('Leverage');
                        $data['LogIn'] = $WebService->get_result('LogIn');
                        $data['RegDate'] = $WebService->get_result('RegDate');
                        $data['ShortDealsCount'] = $WebService->get_result('ShortDealsCount');
                        break;
                    default:
                        $data['msg'] = "There are no data yet.";
                }

                $WebService->open_RequestAccountBalance($account_info);

                switch ($WebService->request_status) {
                    case 'RET_OK':

                        $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                        break;
                    default:
                        $data['msg'] = "There are no data yet.";
                }

                $data['menu'] = "accordion-quick-jump";
                $data['active'] = "personal";

                $data['FullNameVal'] = $current_account_data['full_name'];
                $data['dob'] = array('value' => $current_account_data['dob'], 'label' => 'Date of Birth');
                $data['StreetAddressVal'] = $current_account_data['street'];
                $data['access'] = UserAccess::ManageAccessList();

                $getData = array();
                $select = array();

                if (isset($_POST['checkbox'])) {
                    foreach ($_POST['checkbox'] as $key => $value) {
                        $explodedData = explode('.', $value);
                        $getData[$explodedData[1]] = $value;
                        array_push($select, $value);
                    }

                    $selectData = $this->account_model->getSearchAccount($select, $account_number)['column'];
                    $selectData = array_diff($selectData, array('reference_num', 'account_number'));

                    foreach ($selectData as $key => $value) {
                        if (in_array($value, $data)) {
                            if ($value === 'country') {
                                $row .= '<tr>
                                    <td class="col-md-4"><label for="name">' . $data[$value]['label'] . ':</label></td>
                                    <td class="col-md-8">
                                        <div class="col-md-8">'
                                    . form_dropdown('country', $data['countries'], $current_account_data['country'], 'class="form-control input-sm" id="country"') .
                                    '</div>
                                        <span class="col-md-4"></span>
                                    </td>
                                </tr>';
                            } else if ($value === 'dob') {
                                $row .= '<tr>
                                    <td class="col-md-4"><label for="name">' . $data[$value]['label'] . ':</label></td>
                                    <td class="col-md-8">
                                        <div class="col-md-8">
                                            <input class="form-control input-sm datepicker" type="text" id="' . $value . '" value="' . $data[$value]['value'] . '">
                                        </div>
                                        <span class="col-md-4"></span>
                                    </td>
                                </tr>';
                            } else {
                                $row .= '<tr>
                                    <td class="col-md-4"><label for="name">' . $data[$value]['label'] . ':</label></td>
                                    <td class="col-md-8">
                                        <div class="col-md-8">
                                            <input class="form-control input-sm" type="text" id="' . $value . '" value="' . $data[$value]['value'] . '">
                                        </div>
                                        <span class="col-md-4"></span>
                                    </td>
                                </tr>';
                            }
                        }
                    }

                    $FullName = isset($getData['full_name']) ? $getData['full_name'] : '';
                    $StreetAddress = isset($getData['streeta']) ? $getData['streeta'] : '';

                } else {
                    $FullName = '';
                    $StreetAddress = '';
                }

                $data['FullName'] = $FullName;
                $data['StreetAddress'] = $StreetAddress;
                $data['table_data'] = $row;

                $resultData['view'] = $data;
                $resultData = $this->load->view('quick_jump/profile_view', $data, true);
                $success = 'true';
            } else {
                $resultData = null;
                $success = 'false';
            }
            $this->output->set_content_type('application/json')
                ->set_output(
                    json_encode(
                        array(
                            'data'       => $resultData,
                            'login_type' => $login_type,
                            'success'    => $success,
                            'row'        => $data,
                        )
                    )
                );
        } else {
            redirect('accounts');
        }
    }


    public function checkLevelShow()
    {
        $account_number = $this->input->post('account_number');

        echo $this->account_model->getCheckLevelData($account_number);
    }


    public function profileViewSearch()
    {

        $account_number = $this->input->post('account_number');

        if (strlen($account_number) > 5) {
            $isAccountExist = $this->account_model->getUserId($account_number);

            if ($isAccountExist) {
                $data['personal_log'] = $this->account_model->getHistoryLog($account_number);

                $this->load->library('WebService');
                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iLogin' => $account_number,
                );
                $current_account_data = $this->account_model->getAccountsByIdType($account_number, 1);
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), isset($current_account_data['country']) ? $current_account_data['country'] : "");
                $data['leverages'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), isset($current_account_data['leverage']) ? $current_account_data['leverage'] : "1:200");
                $WebService->request_account_details($account_info);
                $data['flag'] = false;
                switch ($WebService->request_status) {
                    case 'RET_OK':

                        $data['Address'] = $WebService->get_result('Address');
                        $data['Agent'] = $WebService->get_result('Agent');
                        $data['AgentSpecified'] = $WebService->get_result('AgentSpecified');
                        $data['City'] = $WebService->get_result('City');
                        $data['comment'] = $WebService->get_result('comment');
                        $data['Country'] = $WebService->get_result('Country');
                        $data['Email'] = $WebService->get_result('Email');
                        $data['Group'] = $WebService->get_result('Group');
                        $data['Leverage'] = $WebService->get_result('Leverage');
                        $data['LogIn'] = $WebService->get_result('LogIn');
                        $data['Name'] = $WebService->get_result('Name');
                        $data['PhoneNumber'] = $WebService->get_result('PhoneNumber');
                        $data['RegDate'] = $WebService->get_result('RegDate');
                        $data['State'] = $WebService->get_result('State');
                        $data['ZipCode'] = $WebService->get_result('ZipCode');
                        $data['IsEnable'] = $WebService->get_result('IsEnable');
                        $data['IsReadOnly'] = $WebService->get_result('IsReadOnly');
                        $data['ShortDealsCount'] = $WebService->get_result('ShortDealsCount');

//                    $data['FullName'] = $WebService->get_result('FullName');
//                    $data['StreetAddress'] = $WebService->get_result('StreetAddress');
//                    $data['Dob'] = $WebService->get_result('Dob');
                        //$data['ShortDealsCount'] = $WebService->get_result('ShortDealsCount');

                        break;
                    default:
                        $data['msg'] = "There are no data yet.";
                }

                $WebService->open_RequestAccountBalance($account_info);

                switch ($WebService->request_status) {
                    case 'RET_OK':

                        $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                        break;
                    default:
                        $data['msg'] = "There are no data yet.";
                }

                $data['menu'] = "accordion-quick-jump";
                $data['active'] = "personal";

                $data['access'] = UserAccess::ManageAccessList();

                $user_id = $this->account_model->getUserId($account_number);
                $data['login_type'] = $this->account_model->getUserInfo($user_id->id)->login_type;

                $this->load->view('quick_jump/personal', $data);
            } else {
                echo 'false';
            }
        } else {
            redirect('accounts');
        }
    }


    public function balanceRecords()
    {

        UserAccess::checkUserPermission("vef");
        $this->load->library('WebService');
        $account_number = $this->input->post('account_number');
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $account_info = array(
            'iLogin' => $account_number,
        );
        $WebService->open_RequestAccountBalance($account_info);
        $data['flag'] = false;
        switch ($WebService->request_status) {
            case 'RET_OK':

                $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                $data['Equity'] = $this->roundno(floatval($WebService->get_result('Equity')), 2);
                $data['FreeMargin'] = $WebService->get_result('FreeMargin');
                $data['LogIn'] = $WebService->get_result('LogIn');
                $data['Margin'] = $WebService->get_result('Margin');
                $data['Ticket'] = $WebService->get_result('Ticket');
                $data['result'] = true;
                $data['flag'] = true;
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }


        $WebService1 = new WebService(array('server' => 'live_new'));
        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService1->GetAccountDailyDeposits($account_info);
        $data['flag'] = false;
        $deposit = 0;
        if ($WebService1->request_status == "RET_OK") {

            $result = $WebService1->get_all_result();
            if (is_object($result['WithdrawalsDepositsList'])) {
                foreach ($result['WithdrawalsDepositsList']->TotalDepositWithdrawData as $d) {
                    $deposit += $d->Total;
                }
            }


        }
        $data['deposit'] = $deposit;

        $WebService1 = new WebService(array('server' => 'live_new'));
        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService1->GetAccountDailyWithdrawals($account_info);
        $data['flag'] = false;
        $withdrawal = 0;
        if ($WebService1->request_status == "RET_OK") {

            $result = $WebService1->get_all_result();
            if (is_object($result['WithdrawalsDepositsList'])) {
                foreach ($result['WithdrawalsDepositsList']->TotalDepositWithdrawData as $d) {
                    $withdrawal += $d->Total;
                }
            }
        }
        $data['withdrawal'] = $withdrawal;

        $data['access'] = UserAccess::ManageAccessList();

        $this->load->view('quick_jump/balance', $data);


    }

    public function allRecords()
    {
        UserAccess::checkUserPermission("vef");
        $account_number = $this->input->post('account_number');
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $account_info = array( 'iLogin' => $account_number );
        $WebService->request_account_details($account_info);
        $data['flag'] = false;
        switch ($WebService->request_status) {
            case 'RET_OK':
                $data['Address'] = $WebService->get_result('Address');
                $data['Agent'] = $WebService->get_result('Agent');
                $data['AgentSpecified'] = $WebService->get_result('AgentSpecified');
                $data['City'] = $WebService->get_result('City');
                $data['comment'] = $WebService->get_result('comment');
                $data['Country'] = $WebService->get_result('Country');
                $data['Email'] = $WebService->get_result('Email');
                $data['Group'] = $WebService->get_result('Group');
                $data['Leverage'] = $WebService->get_result('Leverage');
                $data['LogIn'] = $WebService->get_result('LogIn');
                $data['Name'] = $WebService->get_result('Name');
                $data['PhoneNumber'] = $WebService->get_result('PhoneNumber');
                $data['RegDate'] = $WebService->get_result('RegDate');
                $data['State'] = $WebService->get_result('State');
                $data['ZipCode'] = $WebService->get_result('ZipCode');
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }
        $WebService->open_RequestAccountBalance($account_info);
        switch ($WebService->request_status) {
            case 'RET_OK':
                $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }

        $data['user_info'] = true;
        $account_number = $this->input->post('account_number');
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $account_info = array(
            'iLogin' => $account_number,
        );
        $WebService->open_RequestAccountBalance($account_info);
        $data['flag'] = false;
        switch ($WebService->request_status) {
            case 'RET_OK':

                $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                $data['Equity'] = $this->roundno(floatval($WebService->get_result('Equity')), 2);
                $data['FreeMargin'] = $WebService->get_result('FreeMargin');
                $data['LogIn'] = $WebService->get_result('LogIn');
                $data['Margin'] = $WebService->get_result('Margin');
                $data['Ticket'] = $WebService->get_result('Ticket');
                $data['result'] = true;
                $data['flag'] = true;
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }


        $WebService1 = new WebService(array('server' => 'live_new'));
        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService1->GetAccountDailyDeposits($account_info);
        $data['flag'] = false;
        $deposit = 0;
        if ($WebService1->request_status == "RET_OK") {

            $result = $WebService1->get_all_result();
            if (is_object($result['WithdrawalsDepositsList'])) {
                foreach ($result['WithdrawalsDepositsList']->TotalDepositWithdrawData as $d) {
                    $deposit += $d->Total;
                }
            }


        }
        $data['deposit'] = $deposit;

        $WebService1 = new WebService(array('server' => 'live_new'));
        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService1->GetAccountDailyWithdrawals($account_info);
        $data['flag'] = false;
        $withdrawal = 0;
        if ($WebService1->request_status == "RET_OK") {

            $result = $WebService1->get_all_result();
            if (is_object($result['WithdrawalsDepositsList'])) {
                foreach ($result['WithdrawalsDepositsList']->TotalDepositWithdrawData as $d) {
                    $withdrawal += $d->Total;
                }
            }
        }
        $data['withdrawal'] = $withdrawal;

        // only trade list
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        //$data['mtas'] = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService->open_GetAccountTradesHistory($account_info);
        $data['flag'] = false;
        switch ($WebService->request_status) {
            case 'RET_OK':
                $tradatalist = (array) $WebService->get_result('TradeDataList');

                if ($tradatalist) {
                    $opened = '';
                    foreach ($tradatalist['TradeData'] as $object) {
                        $opened .= '<tr>';
                        $opened .= '<td>' . $object->OrderTicket . '</td>';
                        $opened .= '<td>' . $object->TradeType . '</td>';
                        $opened .= '<td>' . $object->Volume . '</td>';
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
                    $data['Opened'] = $opened;
                    $data['flag'] = true;
                } else {
                    $data['Opened'] = '';
                    $data['msg'] = "There are no data yet.";
                }
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }

        /*Finance transction history*/

        $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from->format('Y-m-d\TH:i:s'),
            'to'     => $to->format('Y-m-d\TH:i:s'),
        );

        $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
        $data['flag'] = false;
        switch ($WebService->request_status) {
            case 'RET_OK':
                $FinanceRecordData = (array) $WebService->get_result('FinanceRecords');

                if ($tradatalist) {
                    $Finance = '';
                    foreach ($FinanceRecordData['FinanceRecordData'] as $object) {
                        $Finance .= '<tr>';
                        $Finance .= '<td>' . $object->AccountNumber . '</td>';
                        $Finance .= '<td>' . $object->Amount . '</td>';
                        $Finance .= '<td>' . $object->Comment . '</td>';
                        $Finance .= '<td>' . $object->FundType . '</td>';
                        $Finance .= '<td>' . $object->Operation . '</td>';
                        $Finance .= '<td>' . $object->Ticket . '</td>';
                        $Finance .= '<td>' . $object->Stamp . '</td>';
                        $Finance .= '</tr>';
                    }
                    $data['result_finance'] = true;
                    $data['finance'] = $Finance;
                    $data['flag'] = true;
                } else {
                    $data['finance'] = '';
                    $data['msg'] = "There are no data yet.";
                }
                break;
            default:
                $data['msg'] = "There are no data yet.";
        }


        $data['access'] = UserAccess::ManageAccessList();
        $this->load->view('quick_jump/all_record', $data);

    }

    public function history_of_trades()
    {
        UserAccess::checkUserPermission("vef");
        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $this->load->library('WebService');
            $account_number = $this->input->post('account_number');
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            //$data['mtas'] = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
            $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");

            $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m') . '23:59:59');
            $account_info = array(
                'iLogin' => $account_number,
                'from'   => $from->format('Y-m-d\TH:i:s'),
                'to'     => $to->format('Y-m-d\TH:i:s'),

            );

            $WebService->open_GetAccountTradesHistory($account_info);
            $data['flag'] = false;
            switch ($WebService->request_status) {
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('TradeDataList');

                    if ($tradatalist) {
                        $opened = '';
                        foreach ($tradatalist['TradeData'] as $object) {
                            $opened .= '<tr>';
                            $opened .= '<td>' . $object->OrderTicket . '</td>';
                            $opened .= '<td>' . $object->TradeType . '</td>';
                            $opened .= '<td>' . $object->Volume . '</td>';
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
                        $data['Opened'] = $opened;
                        $data['flag'] = true;
                    } else {
                        $data['Opened'] = '';
                        $data['msg'] = "Account number incorrect.";
                    }
                    break;
                default:
                    $data['msg'] = "Account number incorrect.";
            }


        } else {
            $data['user_documents'] = false;
        }

        $data['menu'] = "accordion-quick-jump";
        $data['active'] = "only-traders";

        $data['status'] = array("Pending", "Approved", "Declined");

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("

                ")
            ->set_layout('mwp/main')
            ->build('quick_jump/history_of_trades', $data);
    }

    public function profile()
    {

        $ac = $this->input->get('ac');

        if (strlen($ac) > 5) {

            $data['personal_log'] = $this->account_model->getHistoryLog($ac);
            $this->load->library('WebService');
            $account_number = $ac;

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $account_number,


            );

            $current_account_data = $this->account_model->getAccountsByIdType($account_number, 1);
            $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), isset($current_account_data['country']) ? $current_account_data['country'] : "");
            $data['leverages'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), isset($current_account_data['leverage']) ? $current_account_data['leverage'] : "1:200");
            $WebService->request_account_details($account_info);
            $data['flag'] = false;
            switch ($WebService->request_status) {
                case 'RET_OK':

                    $data['Address'] = $WebService->get_result('Address');
                    $data['Agent'] = $WebService->get_result('Agent');
                    $data['AgentSpecified'] = $WebService->get_result('AgentSpecified');
                    $data['City'] = $WebService->get_result('City');
                    $data['comment'] = $WebService->get_result('comment');
                    $data['Country'] = $WebService->get_result('Country');
                    $data['Email'] = $WebService->get_result('Email');
                    $data['Group'] = $WebService->get_result('Group');
                    $data['Leverage'] = $WebService->get_result('Leverage');
                    $data['LogIn'] = $WebService->get_result('LogIn');
                    $data['Name'] = $WebService->get_result('Name');
                    $data['PhoneNumber'] = $WebService->get_result('PhoneNumber');
                    $data['RegDate'] = $WebService->get_result('RegDate');
                    $data['State'] = $WebService->get_result('State');
                    $data['ZipCode'] = $WebService->get_result('ZipCode');
                    $data['IsEnable'] = $WebService->get_result('IsEnable');
                    $data['IsReadOnly'] = $WebService->get_result('IsReadOnly');
                    $data['ShortDealsCount'] = $WebService->get_result('ShortDealsCount');

                    break;
                default:
                    $data['msg'] = "Account number incorrect.";
            }

            $WebService->open_RequestAccountBalance($account_info);

            switch ($WebService->request_status) {
                case 'RET_OK':

                    $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                    break;
                default:
                    $data['msg'] = "Account number incorrect.";
            }

            $data['menu'] = "accordion-quick-jump";
            $data['active'] = "personal";

            $data['access'] = UserAccess::ManageAccessList();


            $js = $this->template->Js();
            $css = $this->template->Css();
            $this->template->title("Administration | Forexmart")
                ->append_metadata_css("

                ")
                ->append_metadata_js("

                ")
                ->set_layout('mwp/main')
                ->build('quick_jump/personal', $data);

        } else {
            redirect('accounts');
        }
    }

    public function balance_records()
    {

        UserAccess::checkUserPermission("vef");

        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $this->load->library('WebService');
            $account_number = $this->input->post('account_number');

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $account_number,


            );

            $WebService->open_RequestAccountBalance($account_info);
            $data['flag'] = false;
            switch ($WebService->request_status) {
                case 'RET_OK':

                    $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                    $data['Equity'] = $this->roundno(floatval($WebService->get_result('Equity')), 2);
                    $data['FreeMargin'] = $WebService->get_result('FreeMargin');
                    $data['LogIn'] = $WebService->get_result('LogIn');
                    $data['Margin'] = $WebService->get_result('Margin');
                    $data['Ticket'] = $WebService->get_result('Ticket');
                    $data['result'] = true;
                    $data['flag'] = true;
                    break;
                default:
                    $data['msg'] = "Account number incorrect.";
            }

        }

        $data['menu'] = "accordion-quick-jump";
        $data['active'] = "balance_records";

        $data['status'] = array("Pending", "Approved", "Declined");

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("

                ")
            ->set_layout('mwp/main')
            ->build('quick_jump/balance_recordes', $data);
    }


    public function go_to_cabinet()
    {

        UserAccess::checkUserPermission("qjum");
        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $account_number = $this->input->post('account_number');
            if ($user = $this->account_model->getUserId($account_number)) {
                if ($user_info = $this->account_model->getUserInfo($user->id)) {
                    $insertData = array(
                        'account_number' => $account_number,
                        'key'            => md5(uniqid()),
                        'user_id'        => $user->id,
                        'creator'        => $this->session->userdata('user_id')
                    );
                    $this->general_model->delete('go_to_cabinet', 'creator', $this->session->userdata('user_id'));
                    $this->general_model->insertmy('go_to_cabinet', $insertData);
                    //redirect($this->config->item('domain-my')."cabinet?key=".$insertData['key']."&ui=".$insertData['user_id']);
                    $data['user_info'] = array(
                        'full_name'      => $user_info->full_name,
                        'account_number' => $account_number,
                        'key'            => $insertData['key'],
                        'user_id'        => $insertData['user_id'],
                        'email'          => $user_info->email
                    );
                }
            } else {
                $data['noinfo'] = true;
            }
        }
        $data['menu'] = "accordion-quick-jump";
        $data['active'] = "go-to-cabinet";
        $data['access'] = UserAccess::ManageAccessList();
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("")
            ->append_metadata_js("")
            ->set_layout('mwp/v2_main')
            ->build('quick_jump/cabinet', $data);
    }


    public function all_records()
    {

        UserAccess::checkUserPermission("vef");

        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {
            $account_number = $this->input->post('account_number');

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $account_number,


            );

            $WebService->request_account_details($account_info);
            $data['flag'] = false;
            switch ($WebService->request_status) {
                case 'RET_OK':


                    $data['Address'] = $WebService->get_result('Address');
                    $data['Agent'] = $WebService->get_result('Agent');
                    $data['AgentSpecified'] = $WebService->get_result('AgentSpecified');
                    $data['City'] = $WebService->get_result('City');
                    $data['comment'] = $WebService->get_result('comment');
                    $data['Country'] = $WebService->get_result('Country');
                    $data['Email'] = $WebService->get_result('Email');
                    $data['Group'] = $WebService->get_result('Group');
                    $data['Leverage'] = $WebService->get_result('Leverage');
                    $data['LogIn'] = $WebService->get_result('LogIn');
                    $data['Name'] = $WebService->get_result('Name');
                    $data['PhoneNumber'] = $WebService->get_result('PhoneNumber');
                    $data['RegDate'] = $WebService->get_result('RegDate');
                    $data['State'] = $WebService->get_result('State');
                    $data['ZipCode'] = $WebService->get_result('ZipCode');


                    break;
                default:
                    $data['msg'] = "Account number incorrect.";
            }

            $WebService->open_RequestAccountBalance($account_info);

            switch ($WebService->request_status) {
                case 'RET_OK':

                    $data['Balance'] = $this->roundno(floatval($WebService->get_result('Balance')), 2);
                    break;
                default:
                    $data['msg'] = "Account number incorrect.";
            }

            $data['user_info'] = true;
        }

        $data['menu'] = "accordion-quick-jump";
        $data['active'] = "all-records";

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("

                ")
            ->set_layout('mwp/main')
            ->build('quick_jump/all_records', $data);
    }

    private function roundno($number, $dp)
    {
        return number_format((float) $number, $dp, '.', '');
    }

    public function update_live_account()
    {

        if ($this->input->is_ajax_request()) {
            $this->load->model('user_model');
            $account_number = $this->input->post('account_number');
            $field_alias = array(
                'email'     => 'Email',
                'full_name' => 'Name',
                'street'    => 'Street Address',
                'city'      => 'City',
                'state'     => 'State/Province',
                'country'   => 'Country',
                'zip'       => 'Postal/Zip Code',
                'phone1'    => 'Phone Number',
                'dob'       => 'Date of Birth',
                'leverage'  => 'Leverage',
                'swap_free' => 'Swap-free'
            );

            $field['email'] = $this->input->post('email');
            $field['full_name'] = $this->input->post('name');
            $field['street'] = $this->input->post('address');
            $field['city'] = $this->input->post('city');
            $field['state'] = $this->input->post('state');
            $field['country'] = $this->input->post('country');
            $field['zip'] = $this->input->post('zip_code');
            $field['phone1'] = $this->input->post('phone_number');
            $field['leverage'] = $this->input->post('leverage');
            //count($ex_leverage = explode(":", $this->input->post('leverage'))) > 1 ? $ex_leverage[1] : $this->input->post('leverage');

            $dob = $this->input->post('dob');
            $stret = $this->input->post('street');


            //  $date_modified = FXPP::getCurrentDateTime();
            $date_modified = date('Y-m-d h:i:s');
            $current_account_data = $this->account_model->getAccountsByIdType($account_number, 1);
            //print_r($field); exit();
            $change_fields = array();
            foreach ($field as $key => $value) {
                if ($value != $current_account_data[$key]) {
                    $change_fields[$key] = array(
                        'field'         => $field_alias[$key],
                        'old_value'     => $current_account_data[$key],
                        'new_value'     => $value,
                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                    );
                }
            }

            $isUpdate = false;
            if (count($change_fields) > 0) {
                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'AccountNumber' => $account_number,
                    'City'          => $field['city'],
                    'Country'       => $this->general_model->getCountries($field['country']),
                    'Email'         => $field['email'],
                    //  'swap_free' => $field['swap_free'] ? true : false,
                    'Leverage'      => count($ex_leverage = explode(":", $field['leverage'])) > 1 ? $ex_leverage[1] : $field['leverage'],
                    'Name'          => $field['full_name'],
                    'PhoneNumber'   => $field['phone1'],
                    'State'         => $field['state'],
                    'StreetAddress' => $field['street'],
                    'ZipCode'       => $field['zip'],
                    'comment'       => "test"
                );

                $WebService->update_live_account_details($account_info);

                if ($WebService->request_status === 'RET_OK') {
                    //add Account Update History
                    $update_history_data = array(
                        'user_id'       => $current_account_data['user_id'],
                        'manager_id'    => $this->session->userdata('user_id'),
                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                    );
                    $update_history_id = $this->account_model->insertAccountUpdateHistory($update_history_data);

                    //add Account Update Fields History
                    if ($update_history_id) {
                        $update_history_field_data = array();
                        foreach ($change_fields as $field_key => $field_value) {
                            $update_history_field_data[] = array(
                                'field'         => $field_value['field'],
                                'old_value'     => $field_value['old_value'],
                                'new_value'     => $field_value['new_value'],
                                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                                'update_id'     => $update_history_id
                            );
                        }
                        $this->account_model->insertAccountUpdateFieldHistory($update_history_field_data);
                    }

                    //update users info
                    $user_data = array(
                        'email'    => $field['email'],
                        'modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                    );
                    $isUpdateUserInfo = $this->user_model->updateUserById($current_account_data['user_id'], $user_data);

                    //update user profile info
                    $user_profile_data = array(
                        'full_name' => $field['full_name'],
                        'street'    => $field['street'],
                        'city'      => $field['city'],
                        'state'     => $field['state'],
                        'country'   => $field['country'],
                        'zip'       => $field['zip'],
                        'dob'       => date('Y-m-d', strtotime($field['dob']))
                    );
                    $isUpdateUserProfileInfo = $this->user_model->updateUserProfileInfoById($current_account_data['user_id'], $user_profile_data);

                    //update user phone info
                    $user_contact_data = array(
                        'phone1' => $field['phone1']
                    );
                    $isUpdateUserPhoneInfo = $this->account_model->updateContactByUserId($current_account_data['user_id'], $user_contact_data);

                    //update account info
                    $user_account_data = array(
                        // 'swap_free' => $field['swap_free'],
                        'leverage' => $field['leverage']
                    );
                    $isUpdateUserAccountInfo = $this->account_model->updateAccountByUserId($current_account_data['user_id'], $user_account_data);

                    if ($isUpdateUserInfo && $isUpdateUserProfileInfo && $isUpdateUserPhoneInfo && $isUpdateUserAccountInfo) {
                        $isUpdate = true;
                        $message = '<i class="fa fa-check-circle"></i> Account ' . $account_number . ' successfuly updated.';
                    }
                } else {
                    $message = '<i class="fa fa-exclamation-circle"></i> Web Service is not available';
                }

            } else {
                $isUpdate = true;
                $message = '<i class="fa fa-check-circle"></i> Account ' . $account_number . ' successfuly updated.';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'message' => $message)));
        } else {
            show_404();
        }
    }


    public function update_user_personal_info()
    {
        if ($this->input->is_ajax_request()) {
            $field_alias = array(
                'email'     => 'Email',
                'full_name' => 'Name',
                'street'    => 'Street Address',
                'city'      => 'City',
                'state'     => 'State/Province',
                'country'   => 'Country',
                'zip'       => 'Postal/Zip Code',
                'phone1'    => 'Phone Number',
                'dob'       => 'Date of Birth',
                'leverage'  => 'Leverage',
                'swap_free' => 'Swap-free'
            );

            $field['account_number'] = $this->input->post('account_number');
            $field['email'] = $this->input->post('email');
            $field['full_name'] = $this->input->post('name');
            $field['street'] = $this->input->post('address');
            $field['city'] = $this->input->post('city');
            $field['state'] = $this->input->post('state');
            $field['country'] = $this->input->post('country');
            $field['zip'] = $this->input->post('zip_code');
            $field['phone1'] = $this->input->post('phone_number');
            $dob = $this->input->post('dob');
            $stret = $this->input->post('street');

            $date_modified = date('Y-m-d h:i:s');

            //$client = $this->Finance_model->getAccountDetailsByAcctNumber($field['account_number'], 'client')['rows'];
//            $acct_id = $this->Finance_model->showssingle2('mt_accounts_set','account_number',$field['account_number'],'*');
//            $login_type = count($acct_id)>0?:$this->Finance_model->showssingle2('partnership','reference_num',$field['account_number'],'*');
            //  $partner = $this->Finance_model->getAccountDetailsByAcctNumber($field['account_number'], 'partner')['rows'];
            //   $user_type = count($login_type)>0?'client':'partner';
//            print_r('This is entering current part'); exit;
            //print_r('This is entering current part'); exit;
            //$current_account_data = $this->account_model->getAccountsByIdType1($field['account_number'], 1,$user_type);
            $current_account_data = $this->account_model->getAccountsByIdType($field['account_number'], 1);
//            print_r($current_account_data); exit();
            $change_fields = array();
            foreach ($field as $key => $value) {
                if ($value != $current_account_data[$key]) {
                    $change_fields[$key] = array(
                        'field'         => $field_alias[$key],
                        'old_value'     => $current_account_data[$key],
                        'new_value'     => $value,
                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                    );
                }
            }

            $isUpdate = false;
            if (count($change_fields) > 0) {
                $webservice_config = array('server' => 'live_new');
                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'AccountNumber' => $field['account_number'],
                    'City'          => $field['city'],
                    'Country'       => $this->general_model->getCountries($field['country']),
                    'Email'         => $field['email'],
                    'Name'          => $field['full_name'],
                    'PhoneNumber'   => $field['phone1'],
                    'State'         => $field['state'],
                    'StreetAddress' => $field['street'],
                    'ZipCode'       => $field['zip'],
                    'comment'       => "test-mwp"
                );

                $WebService->update_live_account_details($account_info);

                $pageURL = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
                $pageURL .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//                return $pageURL;
                if ($WebService->request_status === 'RET_OK') {
                    //add Account Update History
                    $update_history_data = array(
                        'user_id'       => $current_account_data['user_id'],
                        'manager_id'    => $this->session->userdata('user_id'),
                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                        'update_url'    => $pageURL
                    );
                    $update_history_id = $this->account_model->insertAccountUpdateHistory($update_history_data);
                    //add Account Update Fields History
                    if ($update_history_id) {
                        $update_history_field_data = array();
                        foreach ($change_fields as $field_key => $field_value) {
                            $update_history_field_data[] = array(
                                'field'         => $field_value['field'],
                                'old_value'     => $field_value['old_value'],
                                'new_value'     => $field_value['new_value'],
                                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                                'update_id'     => $update_history_id
                            );
                        }
                        $this->account_model->insertAccountUpdateFieldHistory($update_history_field_data);
                    }

                    //update users info
                    $user_data = array(
                        'email'    => $field['email'],
                        'modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                    );
                    $user_profile = array(
                        'city'      => $field['city'],
                        'country'   => $this->general_model->getCountries($field['country']),
                        'full_name' => $field['full_name'],
                        'state'     => $field['state'],
                        'street'    => $field['street'],
                        'zip'       => $field['zip']
                    );
//                    print_r($current_account_data['user_id'], $user_data,$user_profile,$field['phone1']);exit;
                    $isUpdateUserInfo = $this->User_model->updateUserById1($current_account_data['user_id'], $user_data, $user_profile, $field['phone1']);


                    if ($isUpdateUserInfo['success']) {
                        $isUpdate = true;
                        $data['$message'] = '<i class="fa fa-check-circle"></i> Account ' . $field['account_number'] . ' successfully updated.';
                    }
                } else {
                    $isUpdate = false;
                    $data['$message'] = $message = '<i class="fa fa-exclamation-circle"></i> Web Service is not available';
                }
            }
//            print_r($data);
//            exit;
            $data['success'] = $isUpdate;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }//ajax
    }

    public function get_account_details()
    {
        $success = false;
        $account = array();
        $data = array();
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $acctnum = $this->input->post('id');
            $valid = $this->q_m->isValid($acctnum);
            if($valid){
                $account_id = $this->q_m->get('mt_accounts_set', 'account_number', $acctnum, 'user_id')['user_id'];
                $type = $this->q_m->get('mt_accounts_set', 'account_number', $acctnum, 'mt_type')['mt_type'];
                $data['leverage'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), "1:200");
//            print_r($account_id );
//            echo "<br>";
//            print_r($data['leverage']);
//            exit;
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries());
//            if ($type == 1) {
                $data['modal_manage_account'] = $this->load->ext_view('modal', 'manage_accounts_live', $data, true);
                $data['manage_account_live_corporate'] = $this->load->ext_view('modal', 'manage_account_live_corporate', $data, true);
//            }
                $account = $this->q_m->getAccountsByIdType1($acctnum);
//            print_r($account);exit;
                if (count($account) > 0) {
                    $success = true;
                    if ($type == 1) {
                        $account_info = array(
                            'iLogin' => $account['account_number']
                        );
                        $webservice_config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($webservice_config);
                        $WebService->open_RequestAccountDetails($account_info);

                        if ($WebService->request_status == 'RET_OK') {

                            $field_alias = array(
                                'email'             => 'Email',
                                'full_name'         => 'Name',
                                'street'            => 'Street Address',
                                'city'              => 'City',
                                'state'             => 'State/Province',
                                'zip'               => 'Postal/Zip Code',
                                'phone1'            => 'Phone Number',
                                'leverage'          => 'Leverage',
                                'fb'                => 'fb',
                                'social_media_type' => 'social_media_type'
                            );

                            $field['email'] = $account['email'];
                            $field['full_name'] = $account['full_name'];
                            $field['street'] = $account['street'];
                            $field['city'] = $account['city'];
                            $field['state'] = $account['state'];
                            $field['zip'] = $account['zip'];
                            $field['phone1'] = $account['phone1'];
                            $field['leverage'] = $account['leverage'];
                            // FXPP-3420
                            $field['fb'] = $account['fb'];
                            $field['social_media_type'] = $account['social_media_type'];

                            $service['email'] = $WebService->get_result('Email');
                            $service['full_name'] = $WebService->get_result('Name');
                            $service['street'] = $WebService->get_result('Address');
                            $service['city'] = $WebService->get_result('City');
                            $service['state'] = $WebService->get_result('State');
                            $service['zip'] = $WebService->get_result('ZipCode');
                            $service['phone1'] = $WebService->get_result('PhoneNumber');
                            $service['leverage'] = '1:' . $WebService->get_result('Leverage');
                            $date_modified = FXPP::getCurrentDateTime();
                            $has_changes = false;
                            $update_history_field_data = array();
                            foreach ($field as $key => $value) {
                                if ($value != $service[$key]) {
                                    $has_changes = true;
                                    $update_history_field_data[] = array(
                                        'field'         => $field_alias[$key],
                                        'old_value'     => $value,
                                        'new_value'     => $service[$key],
                                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                                    );

                                    switch ($key) {
                                        case "email":
                                            $user_data = array(
                                                'email'    => $service[$key],
                                                'modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                                            );
                                            $this->q_m->updateUserById($account['user_id'], $user_data);
                                            $user_contact_data = array(
                                                'email1' => $service[$key]
                                            );
                                            $this->q_m->updateContactByUserId($account['user_id'], $user_contact_data);
                                            break;
                                        case "full_name":
                                        case "street":
                                        case "city":
                                        case "state":
                                        case "zip":
                                            $user_profile_data = array(
                                                $key => $service[$key]
                                            );
                                            $this->q_m->updateUserProfileInfoById($account['user_id'], $user_profile_data);
                                            break;
                                        case "phone1":
                                            $user_contact_data = array(
                                                'phone1' => $service[$key]
                                            );
                                            $this->q_m->updateContactByUserId($account['user_id'], $user_contact_data);
                                            break;
                                        case "leverage":
                                            $user_account_data = array(
                                                'leverage' => $service[$key]
                                            );
                                            $this->q_m->updateAccountByUserId($account['user_id'], $user_account_data);
                                            break;
                                    }
                                }
                            }

                            if ($has_changes) {

                                $update_history_data = array(
                                    'user_id'       => $account['user_id'],
                                    'manager_id'    => $this->session->userdata('user_id'),
                                    'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                                );

                                $update_history_id = $this->q_m->insertAccountUpdateHistory($update_history_data);
                                if ($update_history_id) {
                                    foreach ($update_history_field_data as $key => $value) {
                                        $update_history_field_data[$key]['update_id'] = $update_history_id;
                                    }
                                    $this->q_m->insertAccountUpdateFieldHistory($update_history_field_data);
                                }
                                $account = $this->q_m->getAccountsByIdType1($acctnum);
                            }
                        }

                        if (FXPP::update_auto_leverage($account['user_id'])) { //for checking
                            $account = $this->q_m->getAccountsByIdType1($acctnum);
                        }
                        $trading_experience = explode(',', $account['experience']);
                        $trading_experience_value = array();
                        if (count($trading_experience) > 2) {
                            foreach ($trading_experience as $experience) {
                                if ($experience) {
                                    $trading_experience_value[] = true;
                                } else {
                                    $trading_experience_value[] = false;
                                }
                            }
                        } else {
                            $trading_experience_value = array(false, false, false);
                        }

                        $ndb_comment = '';
                        if ($account['nodepositbonus'] == 1) {
                            $ndb_comment = 'NDB has been credited.';
                        } else {
                            $hasNoDepositRequest = $this->q_m->hasNoDepositRequest($account['user_id']);
                            if ($hasNoDepositRequest) {
                                $ndb_comment = 'NDB has been requested.';
                            }
                        }

                        $getAffiliateDetailsByUserId = $this->q_m->getAffiliateDetailsByUserId($account['user_id']);
                        $referralCode = $getAffiliateDetailsByUserId['referral_affiliate_code'];
                        $dateOfBirth = $account['dob'];
                        //:date('m/d/Y', strtotime($account['dob']));
                        $data = array(
                            'success'              => $success,
                            'corporate_acc_status' => $account['corporate_acc_status'],
                            'account_number'       => $account['account_number'],
                            'mt_status'            => trim($account['mt_status']),
                            'account_data'         => array(
                                'email'                   => $account['email'],
                                'name'                    => $account['full_name'],
                                'address'                 => $account['street'],
                                'city'                    => $account['city'],
                                'state'                   => $account['state'],
                                'country'                 => $account['country'],
                                'zip_code'                => $account['zip'],
                                'phone_number'            => $account['phone1'],
                                'birth_date'              => $dateOfBirth,
                                'account_type'            => $this->q_m->getAccountType($account['mt_account_set_id']),
                                'currency_base'           => $account['mt_currency_base'],
                                'leverage'                => $account['leverage'],
                                'investment_knowledge'    => $this->q_m->getInvestmentKnowledge($account['investment_knowledge']),
                                'trade_duration'          => $this->q_m->getTradeDuration($account['trade_duration']),
                                'employment_status'       => $this->q_m->getEmploymentStatus($account['employment_status']),
                                'industry'                => $this->q_m->getIndustry($account['industry']),
                                'estimated_annual_income' => $this->q_m->getEstimatedAnnualIncome($account['estimated_annual_income']),
                                'estimated_net_worth'     => $this->q_m->getEstimatedNetWorth($account['estimated_net_worth']),
                                'education_level'         => $this->q_m->getEducationLevel($account['education_level']),
                                'affiliate_code'          => $referralCode,
                                'auto_leverage'           => $account['auto_leverage'] == 0 ? false : true,
                                'ndb_status'              => $ndb_comment,
                                'fb'                      => $account['fb'],
                                'social_media_type'       => $account['social_media_type'],
                                'user_id'                 => $account['user_id']

                            ),
                            'trading_data'         => array(
                                'swap_free'                  => $account['swap_free'] ? true : false,
                                'trading_experience'         => $trading_experience_value,
                                'politically_exposed_person' => ($account['politically_exposed_person']) ? 'Yes' : 'No',
                                'risk'                       => ($account['risk']) ? 'Yes' : 'No'
                            ),
                            'employee_data'        => array(
                                'us_resident' => ($account['us_resident']) ? 'Yes' : 'No',
                                'us_citizen'  => ($account['us_citizen']) ? 'Yes' : 'No'
                            )
                        );
                    } else {
                        $data = array(
//                        'corporate_acc_status' => 0,
                            'success'        => $success,
                            'account_number' => $account['account_number'],
                            'account_data'   => array(
                                'email'         => $account['email'],
                                'name'          => $account['full_name'],
                                'country'       => $account['country'],
                                'phone_number'  => $account['phone1'],
                                'amount'        => $account['amount'],
                                'account_type'  => $this->q_m->getAccountType($account['mt_account_set_id']),
                                'currency_base' => $account['mt_currency_base'],
                                'leverage'      => $account['leverage']
                            )
                        );
                    }

                    $company_info = $this->q_m->getCompanyInfo($acctnum);
                    $c_info = array(
                        'c_id'            => $company_info->business_id,
                        'c_name'          => $company_info->company_name,
                        'c_trd_name'      => $company_info->company_trading_name,
                        'c_website'       => $company_info->website,
                        'c_business_type' => $company_info->business_type,
                        'c_contact'       => $company_info->contact
                    );

                    $data = array_merge($data, $c_info);


                } else {
                    $data = array(
                        'success'        => $success,
                        'account_number' => '',
                        'account_data'   => $account
                    );
                }
            }else {
                $data = array(
                    'success'        => false,
                    'account_number' => '',
                    'message'        => 'Please enter a valid account number.'
                );
            }
//        print_r($data);exit;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function update_live_account1()
    {
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $isValidate = false;
            $isUpdate = false;
            $account_info = array();
            try {
                $this->form_validation->set_rules('name', 'Full name', 'trim|required|max_length[128]|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[48]|valid_email|xss_clean');
                $this->form_validation->set_rules('email2', 'Email (2)', 'trim|valid_email|max_length[48]|xss_clean');
                $this->form_validation->set_rules('email3', 'Email (3)', 'trim|valid_email|max_length[48]|xss_clean');
                $this->form_validation->set_rules('address', 'Street Address', 'trim|required|max_length[128]|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[32]|xss_clean');
                $this->form_validation->set_rules('state', 'State/Province', 'trim|required|max_length[32]|xss_clean');
                $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
                $this->form_validation->set_rules('zip_code', 'Postal/Zip Code', 'trim|required|max_length[16]|xss_clean');
                $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|max_length[32]|xss_clean');
                $this->form_validation->set_rules('phone_number2', 'Phone number', 'trim|max_length[32]|xss_clean');
                $this->form_validation->set_rules('birth_date', 'Date of Birth', 'trim|required|xss_clean');
                $this->form_validation->set_rules('leverage', 'Leverage', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $isValidate = true;
                    $account_id = $this->input->post('account_id');
                    $account_number = $this->input->post('account_number');
                    $field_alias = array(
                        'email'         => 'Email',
                        'email2'        => 'Email(2)',
                        'email3'        => 'Email(3)',
                        'full_name'     => 'Name',
                        'street'        => 'Street Address',
                        'city'          => 'City',
                        'state'         => 'State/Province',
                        'country'       => 'Country',
                        'zip'           => 'Postal/Zip Code',
                        'phone1'        => 'Phone Number',
                        'phone2'        => 'Phone Number(2)',
                        'dob'           => 'Date of Birth',
                        'leverage'      => 'Leverage',
                        'swap_free'     => 'Swap-free',
                        'auto_leverage' => 'Turn off leverage auto change'
                    );

                    $field['email'] = $this->input->post('email');
                    $field['email2'] = $this->input->post('email2');
                    $field['email3'] = $this->input->post('email3');
                    $field['full_name'] = $this->input->post('name');
                    $field['street'] = $this->input->post('address');
                    $field['city'] = $this->input->post('city');
                    $field['state'] = $this->input->post('state');
                    $field['country'] = $this->input->post('country');
                    $field['zip'] = $this->input->post('zip_code');
                    $field['phone1'] = $this->input->post('phone_number');
                    $field['phone2'] = $this->input->post('phone_number2');
                    $field['dob'] = date('Y-m-d', strtotime($this->input->post('birth_date')));
                    $field['leverage'] = $this->input->post('leverage'); //count($ex_leverage = explode(":", $this->input->post('leverage'))) > 1 ? $ex_leverage[1] : $this->input->post('leverage');

                    $swap = $this->input->post('swap_free');
                    $field['swap_free'] = empty($swap) ? 0 : 1;
                    $auto_leverage = $this->input->post('auto_leverage');
                    $field['auto_leverage'] = empty($auto_leverage) ? 0 : 1;
                    $date_modified = FXPP::getCurrentDateTime();
                    $current_account_data = $this->q_m->getAccountsByIdType1($account_number);
                    $change_fields = array();
                    foreach ($field as $key => $value) {
                        if ($value != $current_account_data[$key]) {
                            $change_fields[$key] = array(
                                'field_key'     => $key,
                                'field'         => $field_alias[$key],
                                'old_value'     => $current_account_data[$key],
                                'new_value'     => $value,
                                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                            );
                        }
                    }

                    $isUpdate = false;
                    if (count($change_fields) > 0) {
                        $this->load->model('user_model');
                        $this->load->model('contact_model');
                        $webservice_config = array('server' => 'live_new');

                        $service_account_info = array(
                            'iLogin' => $account_number
                        );
                        $AccountWebService = new WebService($webservice_config);
                        $AccountWebService->open_RequestAccountDetails($service_account_info);

                        $account_comment = '';
                        if ($AccountWebService->request_status == 'RET_OK') {
                            $account_comment = $AccountWebService->get_result('Comment');
                        }

                        $WebService = new WebService($webservice_config);
                        $groupCurrency = $this->g_m->getGroupCurrency($current_account_data['mt_account_set_id'], $current_account_data['mt_currency_base'], $field['swap_free']);
                        FXPP::update_account_group();
                        $account_details = $this->q_m->getAccountByUserId($_SESSION['user_id']);
                        $account_info = array(
                            'AccountNumber' => $account_number,
                            'City'          => $field['city'],
                            'Country'       => $this->g_m->getCountries($field['country']),
                            'Email'         => $field['email'],
                            'group'         => $groupCurrency . $account_details['group_code'],
                            'leverage'      => count($ex_leverage = explode(":", $field['leverage'])) > 1 ? $ex_leverage[1] : $field['leverage'],
                            'Name'          => $field['full_name'],
                            'PhoneNumber'   => $field['phone1'],
                            'State'         => $field['state'],
                            'StreetAddress' => $field['street'],
                            'ZipCode'       => $field['zip'],
                            'Comment'       => $account_comment
                        );
//                    var_dump($account_info);die();
                        $WebService->update_live_account_details($account_info);
                        if ($WebService->request_status === 'RET_OK') {
                            //add Account Update History
                            $update_history_data = array(
                                'user_id'       => $current_account_data['user_id'],
                                'manager_id'    => $this->session->userdata('user_id'),
                                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                            );
                            $update_history_id = $this->q_m->insertAccountUpdateHistory($update_history_data);

                            //add Account Update Fields History
                            if ($update_history_id) {
                                $update_history_field_data = array();
                                foreach ($change_fields as $field_key => $field_value) {
                                    if ($field_value['field_key'] == 'auto_leverage') {
                                        $field_value['old_value'] = ($field_value['old_value'] == 0 ? 'ON' : 'OFF');
                                        $field_value['new_value'] = ($field_value['new_value'] == 0 ? 'ON' : 'OFF');
                                    } elseif ($field_value['field_key'] == 'swap_free') {
                                        $field_value['old_value'] = ($field_value['old_value'] == 0 ? 'OFF' : 'ON');
                                        $field_value['new_value'] = ($field_value['new_value'] == 0 ? 'OFF' : 'ON');
                                    }

                                    $update_history_field_data[] = array(
                                        'field'         => $field_value['field'],
                                        'old_value'     => $field_value['old_value'],
                                        'new_value'     => $field_value['new_value'],
                                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                                        'update_id'     => $update_history_id
                                    );
                                    if ($field_value['field_key'] == 'auto_leverage') {
                                        $update_leverage_data = array(
                                            'user_id'       => $current_account_data['user_id'],
                                            'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                                            'action'        => $field_value['new_value'],
                                            'manager_id'    => $this->session->userdata('user_id'),
                                            'leverage'      => $current_account_data['leverage']
                                        );
                                        $this->q_m->insertLeverageUpdateHistory($update_leverage_data);
                                    }
                                }
                                $this->q_m->insertAccountUpdateFieldHistory($update_history_field_data);
                            }

                            //update users info
                            $user_data = array(
                                'email'    => $field['email'],
                                'modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                            );
                            $isUpdateUserInfo = $this->q_m->updateUserById($current_account_data['user_id'], $user_data);

                            //update user profile info
                            $user_profile_data = array(
                                'full_name' => $field['full_name'],
                                'street'    => $field['street'],
                                'city'      => $field['city'],
                                'state'     => $field['state'],
                                'country'   => $field['country'],
                                'zip'       => $field['zip'],
                                'dob'       => date('Y-m-d', strtotime($field['dob']))
                            );
                            $isUpdateUserProfileInfo = $this->q_m->updateUserProfileInfoById($current_account_data['user_id'], $user_profile_data);

                            //update user phone info
                            $user_contact_data = array(
                                'email1' => $field['email'],
                                'email2' => $field['email2'],
                                'email3' => $field['email3'],
                                'phone1' => $field['phone1'],
                                'phone2' => $field['phone2']
                            );
                            $isUpdateUserPhoneInfo = $this->q_m->updateContactByUserId($current_account_data['user_id'], $user_contact_data);

                            //update account info
                            $user_account_data = array(
                                'swap_free'     => $field['swap_free'],
                                'leverage'      => $field['leverage'],
                                'auto_leverage' => $field['auto_leverage']
                            );

                            $WebService2 = new WebService($webservice_config);
                            $info = array(
                                'iLogin'    => $account_info['account_number'],
                                'iLeverage' => $account_info['leverage']
                            );

                            $WebService2->open_ChangeAccountLeverage($info);
                            if ($WebService->request_status === 'RET_OK') {
                                $isUpdateUserAccountInfo = $this->q_m->updateAccountByUserId($current_account_data['user_id'], $user_account_data);
                            }

                            if ($isUpdateUserInfo && $isUpdateUserProfileInfo && $isUpdateUserPhoneInfo && $isUpdateUserAccountInfo) {
                                /*admin_log*/
                                $this->load->model('Adminslogs_model');
                                $arr = array('Manager_IP' => $this->input->ip_address());
                                foreach ($change_fields as $key => $fields) {
                                    $arr[$fields['field']] = $fields['new_value'];
                                }

                                $data['log'] = array(
                                    'users_id'                         => $_SESSION['user_id'],
                                    'page'                             => 'mwp/Quick_jump',
                                    'date_processed'                   => FXPP::getCurrentDateTime(),
                                    'processed_users_id'               => $current_account_data['user_id'],
                                    'data'                             => json_encode($arr),
                                    'processed_users_id_accountnumber' => $account_number,
                                    'comment'                          => '',
                                    'admin_fullname'                   => $_SESSION['full_name'],
                                    'admin_email'                      => $_SESSION['email'],
                                );

                                $this->Adminslogs_model->insertmy($table = "admin_log", $data['log']);
                                /*admin_log*/
                                $isUpdate = true;
                                $message = '<i class="fa fa-check-circle" style="color: green;"></i> Account ' . $account_number . ' successfuly updated.';
                            } else {
                                $isUpdate = true;
                                $message = '<i class="fa fa-exclamation-circle" style="color: red;"></i> Account ' . $account_number . ' failed to updated.';

                            }
                        } else {
                            $message = '<i class="fa fa-exclamation-circle" style="color: red;"></i> Web Service is not available. ' . $WebService->request_status;
//                            var_dump($WebService);
                        }

                    } else {
                        $isUpdate = true;
                        $message = '<i class="fa fa-check-circle" style="color: green;"></i> Account ' . $account_number . ' successfuly updated.';
                    }
                } else {
                    $message = validation_errors();
                }

                $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'validation' => $isValidate, 'message' => $message, 'info' => $account_info, 'data' => $_POST)));
            } catch (Exception $e) {
                $message = 'Caught exception: ' . $e->getMessage();
                $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'validation' => $isValidate, 'message' => $message)));
            }

        } else {
            show_404();
        }
    }

    public function corporate_info_save()
    {
        if ($this->input->is_ajax_request()) {
            $data['success'] = false;
            $acctid = $this->q_m->getAccouTypeStatus('*', 'mt_accounts_set', array('account_number' => $this->input->post('acctid')));
            $company_info = array(
                'user_id'              => $acctid->user_id,
                'company_name'         => $this->input->post('name'),
                'company_trading_name' => $this->input->post('company_trading_name'),
                'website'              => $this->input->post('company_website'),
                'business_type'        => $this->input->post('business_type'),
                'contact'              => $this->input->post('number'),
                'status'               => 0,
                'added_date'           => date('Y-m-d H:i:s')
            );
            //print_r($company_info);exit;
            $this->update_bus_history($company_info);
            if ($this->input->post('action') == 'save') {
                $company_id = $this->g_m->insert('business_account_info', $company_info);
                $data['message'] = 'Company information successfully added';
                $data['success'] = true;
            } else {
                $company_id = $this->q_m->updateUserDetails('business_account_info', 'user_id', $acctid->user_id, $company_info);
                $data['message'] = 'Company information successfully updated';
                $data['success'] = true;
            }


            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function update_bus_history($new)
    {
        $user_id = $this->session->userdata('user_id');
        $info = $this->q_m->getaccountshow('*', 'business_account_info', array('user_id' => $new['user_id']));
        $info1 = $this->q_m->getaccountshow('*', 'mt_accounts_set', array('user_id' => $new['user_id']));
        $old = array(
            'company_name'         => $info['company_name'],
            'company_trading_name' => $info['company_trading_name'],
            'website'              => $info['website'],
            'business_type'        => $info['business_type'],
            'contact'              => $info['contact']
        );
        $changes = array();
        $old['company_name'] == $new['company_name'] ? '' : array_push($changes, 'company_name');
        $old['company_trading_name'] == $new['company_trading_name'] ? '' : array_push($changes, 'company_trading_name');
        $old['website'] == $new['website'] ? '' : array_push($changes, 'website');
        $old['business_type'] == $new['business_type'] ? '' : array_push($changes, 'business_type');
        $old['contact'] == $new['contact'] ? '' : array_push($changes, 'contact');
        $date_modified = FXPP::getCurrentDateTime();
        if ($changes) {
            $update_history_data = array(
                'user_id'       => $new['user_id'],
                'manager_id'    => $user_id,
                'update_url'    => 'MWP/quick-jump/save_account',
                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
            );
            $update_history_id = $this->q_m->insertAccountUpdateHistory($update_history_data);
            $update_history_field_data = array();
            $arr = array('Manager_IP' => $this->input->ip_address());
            if ($update_history_id) {
                foreach ($changes as $key) {
                    $update_history_field_data[] = array('field' => $key, 'old_value' => $old[$key], 'new_value' => $new[$key], 'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)), 'update_id' => $update_history_id);
                    $arr[$key] = $new[$key];
                }
                $this->q_m->insertAccountUpdateFieldHistory($update_history_field_data);
            }
            return $arr;
        }
    }

    public function reset_password()
    {
        if ($this->input->is_ajax_request()) {
            ini_set('max_execution_time', 0);
            $account_number = $this->input->post('account_number');
            $email = $this->input->post('email');
            $isSuccess = false;
            $message = '';
            $isValid = $this->q_m->validateForgotDetails($email, $account_number);
            if ($isValid) {
                $getUserId = $this->q_m->getUserIdbyAccountNumber($account_number);

                $forgotpass = array(
                    'Email' => $email,
                    'Hash' => $hash=FXPP::generateGUIDForgotPassword1(),
                    'Account_number' => $account_number,
                    'user_id' => $getUserId[0]['user_id'],
                    'is_admin' => 1,
                );

                $this->general_model->insert("user_forgot_password", $forgotpass);
                $usr_prfl=$this->general_model->showssingle2($table='user_profiles',$field="user_id",$id=$getUserId[0]['user_id'],$select="full_name",$order_by="");

                $forgotpass2 = array(
                    'Email' => $email,
                    'Hash' =>$hash,
                    'Account_number' => $account_number,
                    'user_id' => $getUserId[0]['user_id'],
                    'is_admin' => 1,
                    'full_name'=>$usr_prfl['full_name']

                );

                Fx_mailer::forgot_password_v2($forgotpass2);
                $isSuccess = true;
                $message = '<span style="color: #29A643"><i class="fa fa-check-circle"></i></span> An email containing the link to reset the password has been sent to the user.';
            } else {
                $isSuccess = false;
                $message = '<span style="color: #FF0000"><i class="fa fa-exclamation-circle"></i></span> Failed to reset password.';
            }

            $data = array(
                'success' => $isSuccess,
                'message' => $message
            );
            if($isSuccess){
                $this->load->model('Adminslogs_model');
                $arr=array( 'process' => 'Request Reset Password', 'status' => $message, 'Manager_IP'=>$this->input->ip_address() );
                $getUserId = $this->q_m->getUserIdbyAccountNumber($account_number);
                $data['log']=array(
                    'users_id'=>$_SESSION['user_id'],
                    'page' => 'MWP/quick_jump/reset_password',
                    'date_processed'=> FXPP::getCurrentDateTime(),
                    'processed_users_id'=>$getUserId[0]['user_id'],
                    'data'=> json_encode($arr),
                    'processed_users_id_accountnumber' => $account_number,
                    'comment'=>'',
                    'admin_fullname'=>$_SESSION['full_name'],
                    'admin_email'=>$_SESSION['email'],
                );
                $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }


    public function resend_live_account()
    {
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $account_number = $this->input->post('account_number');
            $account = $this->q_m->getEmailNoAccountsByAccount($account_number);
            $isUpdate = false;
            if (!empty($account)) {
                $forgotpass = array(
                    'Email'          => $account['email'],
                    'Hash'           => FXPP::generateGUIDForgotPassword(21),
                    'Account_number' => $account['account_number'],
                    'user_id'        => $account['user_id'],
                    'is_admin'       => 0,
                );

                $this->general_model->insert("user_forgot_password", $forgotpass);

                $email_data = array(
                    'full_name'           => $account['full_name'],
                    'email'               => $account['email'],
                    'hash_reset_password' => $forgotpass['Hash'],
                    'account_number'      => $account['account_number'],
                    'trader_password'     => $account['trader_password'],
                    'investor_password'   => $account['investor_password'],
                    'phone_password'      => $account['phone_password'],
                );

                $subject = "ForexMart MT4 Live Trading Account details";
                $config = array(
                    'mailtype' => 'html'
                );

                if ($this->q_m->sendBCCEmail('live-resend-account-html', $subject, $email_data['email'], $email_data, $config)) {
                    $isUpdate = true;
                    $message = '<i class="fa fa-check-circle" style="color:green;"></i> Access details has been successfully re-sent to Account ' . $account_number;
                    /*admin_log*/
                    $this->load->model('Adminslogs_model');
                    $arr = array(
                        'Re-send Access Details' => 'Yes',
                        'Manager_IP'             => $this->input->ip_address()
                    );

                    $data['log'] = array(
                        'users_id'                         => $_SESSION['user_id'],
                        'page'                             => 'MWP/resend-access-details',
                        'date_processed'                   => FXPP::getCurrentDateTime(),
                        'processed_users_id'               => $account['user_id'],
                        'data'                             => json_encode($arr),
                        'processed_users_id_accountnumber' => $account_number,
                        'comment'                          => '',
                        'admin_fullname'                   => $_SESSION['full_name'],
                        'admin_email'                      => $_SESSION['email'],
                    );

                    $this->Adminslogs_model->insertmy($table = "admin_log", $data['log']);
                    /*admin_log*/
                } else {
                    $message = '<i class="fa fa-exclamation-circle" style="color:red;"></i> Account ' . $account_number . ' registration failed to re-send.';
                }
            } else {
                $message = '<i class="fa fa-exclamation-circle"></i> Account ' . $account_number . ' is invalid.';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'message' => $message, 'account_info' => $account)));
        } else {
            show_404();
        }
    }

    public function get_account_update_history()
    {
        if ($this->input->is_ajax_request()) {
            $user_id = $this->general_model->showssingle('mt_accounts_set', 'account_number', $this->input->post('id'), 'user_id')['user_id'];
//             print_r($user_id );exit;
            $account_update_history = $this->q_m->getAccountUpdateHistoryByUserId($user_id);
            $login_type = $this->general_model->showssingle('users', 'id', $user_id, 'login_type');
//            print_r($account_update_history);exit;

            if (!$login_type['login_type']) {
                $account_number = $this->general_model->showssingle('mt_accounts_set', 'user_id', $user_id, 'account_number');
            } else {
                $account_number = $this->general_model->showssingle('partnership', 'partner_id', $user_id, 'reference_num as account_number');
            }

            $update_history = '';
            foreach ($account_update_history as $key => $value) {
//                $who_modify = $value['manager_id'] == $value['user_id'] ? 'Client' : 'Manager';
//                $name = $value['manager_id'] == $value['user_id'] ? $value['user_name'] : $value['manager_name'];
                $who_modify = $value['manager_id'] == 0 ? 'Client' : 'Manager';
                $name = $value['manager_id'] == 0 ? $value['user_name'] : $value['manager_name'];
                $update_history .= '<tr>
                    <td>' . $who_modify . '</td>
                    <td>' . $name . '</td>
                    <td>' . date('m/d/Y h:i:s A', strtotime($value['date_modified'])) . '</td>
                    <td><a href="#" id="update_view" data-id="' . $value['id'] . '" data-anum="' . $account_number['account_number'] . '" class="open-update-view" style="color:#2988ca;">View</i></a></td>
                </tr>';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('update_history_data' => $update_history, 'account_number' => $account_number['account_number'])));
        } else {
            show_404();
        }
    }

    public function get_account_field_update_history()
    {
        if ($this->input->is_ajax_request()) {
            $update_id = $this->input->post('id');
            $account_number = $this->input->post('anum');
            $account_field_update_history = $this->q_m->getAccountFieldUpdateHistoryById($update_id);
            $update_history = '';
            $manager_name = '';
            foreach ($account_field_update_history as $key => $value) {
                $manager_name = $value['manager_name'];
                $update_history .= '<tr>
                    <td>' . $value['field'] . '</td>
                    <td>' . $value['old_value'] . '</td>
                    <td>' . $value['new_value'] . '</td>
                    <td>' . date('m/d/Y h:i:s A', strtotime($value['date_modified'])) . '</td>
                </tr>';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('manager_name' => $manager_name, 'update_field_history_data' => $update_history, 'account_number' => $account_number, 'result' => $update_id)));
        } else {
            show_404();
        }
    }

    function switchTpoCorporateAccount()
    {
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $account_number = $this->input->post('account_number');
            $email = $this->input->post('email');
            $isSuccess = false;
            $message = '';
            $isValid = $this->q_m->validateForgotDetails($email, $account_number);
            if ($isValid) {
                $data_to_update = array(  'corporate_acc_status' => 1 );

                $mailer_data = array(
                    'email' => $email,
                    // 'email' => 'gil@f.zetaol.com',
                    'full_name' => $this->input->post('full_name')
                );
                Fx_mailer::mailer_corporate($mailer_data);

                $this->general_model->update("mt_accounts_set", 'account_number', $account_number, $data_to_update);
                $message = '<span style="color: #29A643"><i class="fa fa-check-circle"></i></span> Account is switched to corporate.';
                $isSuccess = true;
            } else {
                $isSuccess = false;
                $message = '<span style="color: #FF0000"><i class="fa fa-exclamation-circle"></i></span> Failed to switch account to corporate.';
            }

            $data = array( 'success' => $isSuccess, 'message' => $message );
            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr=array( 'process' => 'Switch To Corporate Account', 'account_status' => $message, 'Manager_IP'=>$this->input->ip_address() );
            $getUserId = $this->q_m->getUserIdbyAccountNumber($account_number);
            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => 'account-verification',
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$getUserId[0]['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );
            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            show_404();
        }
    }
    public function getUserdetails($account_number){
        $webservice_config = array(  'server' => 'live_new'  );
        $webService = new WebService($webservice_config);
        $data = array( 'iLogin' => $account_number );
        $webService->request_account_details($data);
        if ($webService->request_status === 'RET_OK') {
            $data = $webService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }
    public function get_account_details1()
    {
        $success = false;
        $account = array();
        $data = array();
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $view = $this->load->view('quick_jump/v2_profile');
            $acctnum = $this->input->post('id');
            $valid = $this->q_m->isValid($acctnum);
            if($valid){
                $account_id = $this->q_m->get('mt_accounts_set', 'account_number', $acctnum, 'user_id')['user_id'];
                $type = $this->q_m->get('mt_accounts_set', 'account_number', $acctnum, 'mt_type')['mt_type'];
                $data['leverage'] = $this->general_model->selectOptionList($this->general_model->getLeverage(), "1:200");
//            print_r($account_id );
//            echo "<br>";
//            print_r($data['leverage']);
//            exit;
                $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries());
//            if ($type == 1) {
                $data['modal_manage_account'] = $this->load->ext_view('modal', 'manage_accounts_live', $data, true);
                $data['manage_account_live_corporate'] = $this->load->ext_view('modal', 'manage_account_live_corporate', $data, true);
//            }
                $account = $this->q_m->getAccountsByIdType1($acctnum);
//            print_r($account);exit;
                if (count($account) > 0) {
                    $success = true;
                    if ($type == 1) {
                        $account_info = array(
                            'iLogin' => $account['account_number']
                        );
                        $webservice_config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($webservice_config);
                        $WebService->open_RequestAccountDetails($account_info);

                        if ($WebService->request_status == 'RET_OK') {

                            $field_alias = array(
                                'email'             => 'Email',
                                'full_name'         => 'Name',
                                'street'            => 'Street Address',
                                'city'              => 'City',
                                'state'             => 'State/Province',
                                'zip'               => 'Postal/Zip Code',
                                'phone1'            => 'Phone Number',
                                'leverage'          => 'Leverage',
                                'fb'                => 'fb',
                                'social_media_type' => 'social_media_type'
                            );

                            $field['email'] = $account['email'];
                            $field['full_name'] = $account['full_name'];
                            $field['street'] = $account['street'];
                            $field['city'] = $account['city'];
                            $field['state'] = $account['state'];
                            $field['zip'] = $account['zip'];
                            $field['phone1'] = $account['phone1'];
                            $field['leverage'] = $account['leverage'];
                            // FXPP-3420
                            $field['fb'] = $account['fb'];
                            $field['social_media_type'] = $account['social_media_type'];

                            $service['email'] = $WebService->get_result('Email');
                            $service['full_name'] = $WebService->get_result('Name');
                            $service['street'] = $WebService->get_result('Address');
                            $service['city'] = $WebService->get_result('City');
                            $service['state'] = $WebService->get_result('State');
                            $service['zip'] = $WebService->get_result('ZipCode');
                            $service['phone1'] = $WebService->get_result('PhoneNumber');
                            $service['leverage'] = '1:' . $WebService->get_result('Leverage');
                            $date_modified = FXPP::getCurrentDateTime();
                            $has_changes = false;
                            $update_history_field_data = array();
                            foreach ($field as $key => $value) {
                                if ($value != $service[$key]) {
                                    $has_changes = true;
                                    $update_history_field_data[] = array(
                                        'field'         => $field_alias[$key],
                                        'old_value'     => $value,
                                        'new_value'     => $service[$key],
                                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                                    );

                                    switch ($key) {
                                        case "email":
                                            $user_data = array(
                                                'email'    => $service[$key],
                                                'modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                                            );
                                            $this->q_m->updateUserById($account['user_id'], $user_data);
                                            $user_contact_data = array(
                                                'email1' => $service[$key]
                                            );
                                            $this->q_m->updateContactByUserId($account['user_id'], $user_contact_data);
                                            break;
                                        case "full_name":
                                        case "street":
                                        case "city":
                                        case "state":
                                        case "zip":
                                            $user_profile_data = array(
                                                $key => $service[$key]
                                            );
                                            $this->q_m->updateUserProfileInfoById($account['user_id'], $user_profile_data);
                                            break;
                                        case "phone1":
                                            $user_contact_data = array(
                                                'phone1' => $service[$key]
                                            );
                                            $this->q_m->updateContactByUserId($account['user_id'], $user_contact_data);
                                            break;
                                        case "leverage":
                                            $user_account_data = array(
                                                'leverage' => $service[$key]
                                            );
                                            $this->q_m->updateAccountByUserId($account['user_id'], $user_account_data);
                                            break;
                                    }
                                }
                            }

                            if ($has_changes) {

                                $update_history_data = array(
                                    'user_id'       => $account['user_id'],
                                    'manager_id'    => $this->session->userdata('user_id'),
                                    'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                                );

                                $update_history_id = $this->q_m->insertAccountUpdateHistory($update_history_data);
                                if ($update_history_id) {
                                    foreach ($update_history_field_data as $key => $value) {
                                        $update_history_field_data[$key]['update_id'] = $update_history_id;
                                    }
                                    $this->q_m->insertAccountUpdateFieldHistory($update_history_field_data);
                                }
                                $account = $this->q_m->getAccountsByIdType1($acctnum);
                            }
                        }

                        if (FXPP::update_auto_leverage($account['user_id'])) { //for checking
                            $account = $this->q_m->getAccountsByIdType1($acctnum);
                        }
                        $trading_experience = explode(',', $account['experience']);
                        $trading_experience_value = array();
                        if (count($trading_experience) > 2) {
                            foreach ($trading_experience as $experience) {
                                if ($experience) {
                                    $trading_experience_value[] = true;
                                } else {
                                    $trading_experience_value[] = false;
                                }
                            }
                        } else {
                            $trading_experience_value = array(false, false, false);
                        }

                        $ndb_comment = '';
                        if ($account['nodepositbonus'] == 1) {
                            $ndb_comment = 'NDB has been credited.';
                        } else {
                            $hasNoDepositRequest = $this->q_m->hasNoDepositRequest($account['user_id']);
                            if ($hasNoDepositRequest) {
                                $ndb_comment = 'NDB has been requested.';
                            }
                        }

                        $getAffiliateDetailsByUserId = $this->q_m->getAffiliateDetailsByUserId($account['user_id']);
                        $referralCode = $getAffiliateDetailsByUserId['referral_affiliate_code'];

                        $data = array(
                            'success'              => $success,
                            'corporate_acc_status' => $account['corporate_acc_status'],
                            'account_number'       => $account['account_number'],
                            'mt_status'            => trim($account['mt_status']),
                            'account_data'         => array(
                                'email'                   => $account['email'],
                                'name'                    => $account['full_name'],
                                'address'                 => $account['street'],
                                'city'                    => $account['city'],
                                'state'                   => $account['state'],
                                'country'                 => $account['country'],
                                'zip_code'                => $account['zip'],
                                'phone_number'            => $account['phone1'],
                                'birth_date'              => date('m/d/Y', strtotime($account['dob'])),
                                'account_type'            => $this->q_m->getAccountType($account['mt_account_set_id']),
                                'currency_base'           => $account['mt_currency_base'],
                                'leverage'                => $account['leverage'],
                                'investment_knowledge'    => $this->q_m->getInvestmentKnowledge($account['investment_knowledge']),
                                'trade_duration'          => $this->q_m->getTradeDuration($account['trade_duration']),
                                'employment_status'       => $this->q_m->getEmploymentStatus($account['employment_status']),
                                'industry'                => $this->q_m->getIndustry($account['industry']),
                                'estimated_annual_income' => $this->q_m->getEstimatedAnnualIncome($account['estimated_annual_income']),
                                'estimated_net_worth'     => $this->q_m->getEstimatedNetWorth($account['estimated_net_worth']),
                                'education_level'         => $this->q_m->getEducationLevel($account['education_level']),
                                'affiliate_code'          => $referralCode,
                                'auto_leverage'           => $account['auto_leverage'] == 0 ? false : true,
                                'ndb_status'              => $ndb_comment,
                                'fb'                      => $account['fb'],
                                'social_media_type'       => $account['social_media_type'],
                                'user_id'                 => $account['user_id']

                            ),
                            'trading_data'         => array(
                                'swap_free'                  => $account['swap_free'] ? true : false,
                                'trading_experience'         => $trading_experience_value,
                                'politically_exposed_person' => ($account['politically_exposed_person']) ? 'Yes' : 'No',
                                'risk'                       => ($account['risk']) ? 'Yes' : 'No'
                            ),
                            'employee_data'        => array(
                                'us_resident' => ($account['us_resident']) ? 'Yes' : 'No',
                                'us_citizen'  => ($account['us_citizen']) ? 'Yes' : 'No'
                            )
                        );
                    } else {
                        $data = array(
//                        'corporate_acc_status' => 0,
                            'success'        => $success,
                            'account_number' => $account['account_number'],
                            'account_data'   => array(
                                'email'         => $account['email'],
                                'name'          => $account['full_name'],
                                'country'       => $account['country'],
                                'phone_number'  => $account['phone1'],
                                'amount'        => $account['amount'],
                                'account_type'  => $this->q_m->getAccountType($account['mt_account_set_id']),
                                'currency_base' => $account['mt_currency_base'],
                                'leverage'      => $account['leverage']
                            )
                        );
                    }

                    $company_info = $this->q_m->getCompanyInfo($acctnum);
                    $c_info = array(
                        'c_id'            => $company_info->business_id,
                        'c_name'          => $company_info->company_name,
                        'c_trd_name'      => $company_info->company_trading_name,
                        'c_website'       => $company_info->website,
                        'c_business_type' => $company_info->business_type,
                        'c_contact'       => $company_info->contact
                    );

                    $data = array_merge($data, $c_info);


                } else {
                    $data = array(
                        'success'        => $success,
                        'account_number' => '',
                        'account_data'   => $account,
                        'viewfile'           =>$this->load->view("views/quick_jump/v2_personal",'')
                    );
                }
            }else {
                $data = array(
                    'success'        => false,
                    'account_number' => '',
                    'message'        => 'Please enter a valid account number.',
                    'viewfile'           => $this->load->view("views/quick_jump/v2_personal",'')
                );
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    public function save_account(){
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $isValidate = false;
            $isUpdate = false;
            $account_info = array();
            try {
                $this->form_validation->set_rules('name', 'Full name', 'trim|required|max_length[128]|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[48]|valid_email|xss_clean');
//                $this->form_validation->set_rules('email2', 'Email (2)', 'trim|valid_email|max_length[48]|xss_clean');
//                $this->form_validation->set_rules('email3', 'Email (3)', 'trim|valid_email|max_length[48]|xss_clean');
                $this->form_validation->set_rules('address', 'Street Address', 'trim|required|max_length[128]|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[32]|xss_clean');
                $this->form_validation->set_rules('state', 'State/Province', 'trim|required|max_length[32]|xss_clean');
                $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
                $this->form_validation->set_rules('zip_code', 'Postal/Zip Code', 'trim|required|max_length[16]|xss_clean');
                $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|max_length[32]|xss_clean');
//                $this->form_validation->set_rules('phone_number2', 'Phone number', 'trim|max_length[32]|xss_clean');
                $this->form_validation->set_rules('birth_date', 'Date of Birth', 'trim|required|xss_clean');
                $this->form_validation->set_rules('leverage', 'Leverage', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $isValidate = true;
                    $account_id = $this->input->post('account_id');
                    $account_number = $this->input->post('account_number');
                    $field_alias = array(
                        'email'         => 'Email',
//                        'email2'        => 'Email(2)',
//                        'email3'        => 'Email(3)',
                        'full_name'     => 'Name',
                        'street'        => 'Street Address',
                        'city'          => 'City',
                        'state'         => 'State/Province',
                        'country'       => 'Country',
                        'zip'           => 'Postal/Zip Code',
                        'phone1'        => 'Phone Number',
//                        'phone2'        => 'Phone Number(2)',
                        'dob'           => 'Date of Birth',
                        'leverage'      => 'Leverage',
                        'swap_free'     => 'Swap-free',
                        'auto_leverage' => 'Turn off leverage auto change',
                    );
                    $current_account_data = $this->q_m->getAccountsByIdType1($account_number);
                    $company_info = array(
                        'user_id'              => $current_account_data['user_id'],
                        'company_name'         => $this->input->post('company_name'),
                        'company_trading_name' => $this->input->post('trading_name'),
                        'website'              => $this->input->post('company_website'),
                        'business_type'        => $this->input->post('business_type'),
                        'contact'              => $this->input->post('Contact_num'),
                        'status'               => 0,
                        'added_date'           => date('Y-m-d H:i:s')
                    );
                    $arr1 = $this->update_bus_history($company_info);
                    if ($this->input->post('action') == 'save') {
                        $company_id = $this->g_m->insert('business_account_info', $company_info);
                        $data['message'] = 'Company information successfully added';
                        $data['success'] = true;
                    } else {
                        $company_id = $this->q_m->updateUserDetails('business_account_info', 'user_id',$current_account_data['user_id'], $company_info);
                        $data['message'] = 'Company information successfully updated';
                        $data['success'] = true;
                    }

                    $field['email'] = $this->input->post('email');
//                    $field['email2'] = $this->input->post('email2');
//                    $field['email3'] = $this->input->post('email3');
                    $field['full_name'] = $this->input->post('name');
                    $field['street'] = $this->input->post('address');
                    $field['city'] = $this->input->post('city');
                    $field['state'] = $this->input->post('state');
                    $field['country'] = $this->input->post('country');
                    $field['zip'] = $this->input->post('zip_code');
                    $field['phone1'] = $this->input->post('phone_number');
//                    $field['phone2'] = $this->input->post('phone_number2');
                    $field['dob'] = date('Y-m-d', strtotime($this->input->post('birth_date')));
                    $field['leverage'] = $this->input->post('leverage'); //count($ex_leverage = explode(":", $this->input->post('leverage'))) > 1 ? $ex_leverage[1] : $this->input->post('leverage');

                    $swap = $this->input->post('swap_free');
                    $field['swap_free'] = empty($swap) ? 0 : 1;
                    $auto_leverage = $this->input->post('auto_leverage');
                    $field['auto_leverage'] = empty($auto_leverage) ? 0 : 1;
                    $date_modified = FXPP::getCurrentDateTime();
                    $current_account_data = $this->q_m->getAccountsByIdType1($account_number);
                    $change_fields = array();
                    foreach ($field as $key => $value) {
                        if ($value != $current_account_data[$key]) {
                            $change_fields[$key] = array(
                                'field_key'     => $key,
                                'field'         => $field_alias[$key],
                                'old_value'     => $current_account_data[$key],
                                'new_value'     => $value,
                                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                            );
                        }
                    }

                    $isUpdate = false;
                    if (count($change_fields) > 0) {
                        $this->load->model('user_model');
                        $this->load->model('contact_model');
                        $webservice_config = array('server' => 'live_new');
                        $service_account_info = array( 'iLogin' => $account_number );
                        $AccountWebService = new WebService($webservice_config);
                        $AccountWebService->open_RequestAccountDetails($service_account_info);

                        $account_comment = '';
                        if ($AccountWebService->request_status == 'RET_OK') {
                            $account_comment = $AccountWebService->get_result('Comment');
                        }

                        $WebService = new WebService($webservice_config);
                        $groupCurrency = $this->g_m->getGroupCurrency($current_account_data['mt_account_set_id'], $current_account_data['mt_currency_base'], $field['swap_free']);
                        FXPP::update_account_group();
                        $account_details = $this->q_m->getAccountByUserId($_SESSION['user_id']);
                        $account_info = array(
                            'AccountNumber' => $account_number,
                            'City'          => $field['city'],
                            'Country'       => $this->g_m->getCountries($field['country']),
                            'Email'         => $field['email'],
                            'group'         => $groupCurrency . $account_details['group_code'],
                            'leverage'      => count($ex_leverage = explode(":", $field['leverage'])) > 1 ? $ex_leverage[1] : $field['leverage'],
                            'Name'          => $field['full_name'],
                            'PhoneNumber'   => $field['phone1'],
                            'State'         => $field['state'],
                            'StreetAddress' => $field['street'],
                            'ZipCode'       => $field['zip'],
                            'Comment'       => $account_comment
                        );
//                    var_dump($account_info);die();
                        $WebService->update_live_account_details($account_info);
                        if ($WebService->request_status === 'RET_OK') {
                            //add Account Update History
                            $update_history_data = array(
                                'user_id'       => $current_account_data['user_id'],
                                'manager_id'    => $this->session->userdata('user_id'),
                                'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                            );
                            $update_history_id = $this->q_m->insertAccountUpdateHistory($update_history_data);

                            //add Account Update Fields History
                            if ($update_history_id) {
                                $update_history_field_data = array();
                                foreach ($change_fields as $field_key => $field_value) {
                                    if ($field_value['field_key'] == 'auto_leverage') {
                                        $field_value['old_value'] = ($field_value['old_value'] == 0 ? 'ON' : 'OFF');
                                        $field_value['new_value'] = ($field_value['new_value'] == 0 ? 'ON' : 'OFF');
                                    } elseif ($field_value['field_key'] == 'swap_free') {
                                        $field_value['old_value'] = ($field_value['old_value'] == 0 ? 'OFF' : 'ON');
                                        $field_value['new_value'] = ($field_value['new_value'] == 0 ? 'OFF' : 'ON');
                                    }

                                    $update_history_field_data[] = array(
                                        'field'         => $field_value['field'],
                                        'old_value'     => $field_value['old_value'],
                                        'new_value'     => $field_value['new_value'],
                                        'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                                        'update_id'     => $update_history_id
                                    );
                                    if ($field_value['field_key'] == 'auto_leverage') {
                                        $update_leverage_data = array(
                                            'user_id'       => $current_account_data['user_id'],
                                            'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified)),
                                            'action'        => $field_value['new_value'],
                                            'manager_id'    => $this->session->userdata('user_id'),
                                            'leverage'      => $current_account_data['leverage']
                                        );
                                        $this->q_m->insertLeverageUpdateHistory($update_leverage_data);
                                    }
                                }
                                $this->q_m->insertAccountUpdateFieldHistory($update_history_field_data);
                            }

                            //update users info
                            $user_data = array(
                                'email'    => $field['email'],
                                'modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                            );
                            $isUpdateUserInfo = $this->q_m->updateUserById($current_account_data['user_id'], $user_data);

                            //update user profile info
                            $user_profile_data = array(
                                'full_name' => $field['full_name'],
                                'street'    => $field['street'],
                                'city'      => $field['city'],
                                'state'     => $field['state'],
                                'country'   => $field['country'],
                                'zip'       => $field['zip'],
                                'dob'       => date('Y-m-d', strtotime($field['dob']))
                            );
                            $isUpdateUserProfileInfo = $this->q_m->updateUserProfileInfoById($current_account_data['user_id'], $user_profile_data);

                            //update user phone info
                            $user_contact_data = array(
                                'email1' => $field['email'],
                                'email2' => $field['email2'],
                                'email3' => $field['email3'],
                                'phone1' => $field['phone1'],
                                'phone2' => $field['phone2']
                            );
                            $isUpdateUserPhoneInfo = $this->q_m->updateContactByUserId($current_account_data['user_id'], $user_contact_data);

                            //update account info
                            $user_account_data = array(
                                'swap_free'     => $field['swap_free'],
                                'leverage'      => $field['leverage'],
                                'auto_leverage' => $field['auto_leverage']
                            );

                            $WebService2 = new WebService($webservice_config);
                            $info = array(
                                'iLogin'    => $account_info['account_number'],
                                'iLeverage' => $account_info['leverage']
                            );

                            $WebService2->open_ChangeAccountLeverage($info);
                            if ($WebService->request_status === 'RET_OK') {
                                $isUpdateUserAccountInfo = $this->q_m->updateAccountByUserId($current_account_data['user_id'], $user_account_data);
                            }
                            $isUpdateUserAccountInfo = $this->q_m->updateAccountByUserId($current_account_data['user_id'], $user_account_data);
                            if ($isUpdateUserInfo && $isUpdateUserProfileInfo && $isUpdateUserPhoneInfo && $isUpdateUserAccountInfo) {
                                $isUpdate = true;
                                $message = '<i class="fa fa-check-circle" style="color: green;"></i> Account ' . $account_number . ' successfuly updated.';
                            } else {
                                $isUpdate = true;
                                $message = '<i class="fa fa-exclamation-circle" style="color: red;"></i> Account ' . $account_number . ' failed to updated.';

                            }
                        } else {
                            $message = '<i class="fa fa-exclamation-circle" style="color: red;"></i> Web Service is not available. ' . $WebService->request_status;
//                            var_dump($WebService);
                        }
                    } else {
                        $isUpdate = true;
                        $message = '<i class="fa fa-check-circle" style="color: green;"></i> Account ' . $account_number . ' successfuly updated.';
                    }
                    /*admin_log*/
                    $this->db->trans_start();
                    $this->load->model('Adminslogs_model');
                    $arr = array('Manager_IP' => $this->input->ip_address());
                    foreach ($change_fields as $key => $fields) {
                        $arr[$fields['field']] = $fields['new_value'];
                    }
                    $arr = array_merge($arr,$arr1);
                    $data['log'] = array(
                        'users_id'                         => $_SESSION['user_id'],
                        'page'                             => 'mwp/Quick_jump/save_account',
                        'date_processed'                   => FXPP::getCurrentDateTime(),
                        'processed_users_id'               => $current_account_data['user_id'],
                        'data'                             => json_encode($arr),
                        'processed_users_id_accountnumber' => $account_number,
                        'comment'                          => '',
                        'admin_fullname'                   => $_SESSION['full_name'],
                        'admin_email'                      => $_SESSION['email'],
                    );
                    $this->Adminslogs_model->insertmy($table = "admin_log", $data['log']);
                    $this->db->trans_complete();
                    /*admin_log*/
                } else {
                    $message = validation_errors();
                }

                $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'validation' => $isValidate, 'message' => $message, 'info' => $account_info, 'data' => $_POST)));
            } catch (Exception $e) {
                $message = 'Caught exception: ' . $e->getMessage();
                $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'validation' => $isValidate, 'message' => $message)));
            }

        } else {
            show_404();
        }
    }
    public function get_transactions($account_number)
    {
        $this->load->library('WebService');
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $from = date('Y-m-d\T00:00:00', strtotime("2015/5/5"));
        $to = date('Y-m-d\T23:59:59', strtotime('today'));
        $account_info = array(
            'iLogin' => $account_number,
            'from'   => $from,
            'to'     => $to
        );
        $invalid = $to < $from;
        if($invalid){
            $data['success']='false';
            $data['msg']= "There are no data yet.";
        }else{
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
            if ($WebService->request_status === 'RET_OK') {
                $data['success']='true';
                $data['result'] = $WebService->get_all_result();
                $data['result1']= $data['result']['FinanceRecords']->FinanceRecordData;
            }
        }
        return $data;
    }
}