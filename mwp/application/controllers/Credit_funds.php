<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_funds extends CI_Controller
{
    private $transaction_type = array(
        'BT' => 'Bank Transfer',
        'CC' => 'Debit/Credit Card (CardPay)',
        'SK' => 'Skrill',
//        'UP' => 'China UnionPay',
        'NT' => 'Neteller',
//        'WM' => 'WebMoney',
        'PX' => 'Paxum',
//        'UK' => 'Ukash',
        'PC' => 'Payco',
//        'FP' => 'FILSPay',
//        'CU' => 'CashU',
        'PP' => 'PayPal',
        'QW' => 'Qiwi',
        'MT' => 'MegaTransfer',

//        'YM' => 'Yandex Money',
//        'BC' => 'BitCoin'

    );

    private $withtdraw_transaction_type = array(
        'NT'=>'NETELLER',
        'PC'=>'PAYCO',
        'PX'=>'PAXUM',
//        'CU'=>'CashU',
        'SK'=>'SKRILL',
//        'PS'=>'PaySera/WebMoney',
//        'UK'=>'Ukash',
//        'FP'=>'Filspay',
        'CP'=>'CardPay',
//        'CUP'=>'CUP',
        'MT'=>'MegaTransfer',
//        'BS'=>'Bank of Cyprus',
        'PP'=>'Paypal',
//        'YM'=>'Yandex Money',
        'QW'=>'QIWI',
//        'SF'=>'Sofort',
//        'HW'=>'Hipay Wallet',
//        'PM'=>'Paymill',
        'BC' => 'BITCOIN',
        'WIRE_TRANSFER_SL' => 'MegaTransfer SiauLiu',
        'WIRE_TRANSFER_SP' => 'MegaTransfer Sparkasse',
        'WIRE_TRANSFER_PC' => 'Piraeus Cyprus',
        'WIRE_TRANSFER_BOC' => 'Bank of Cyprus',
        'WIRE_TRANSFER_EC' => 'Eurobank Cyprus',
    );

    public function __construct()
    {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) { // logged in

            redirect('signin');

        }
        $this->load->model('Finance_model');
        $this->load->model('Deposits_model');
        $this->load->model('Managecontest_model');
        $this->load->library('Fx_mailer');
        $this->load->library('UserAccess');

        //for advertisement cookie
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        if ($this->session->userdata('logged')) {
            $data['cookie'] = array(
                'name' => 'fullname',
                'value' => $_SESSION['full_name'],
                'expire' => time() + (10 * 365 * 24 * 60 * 60),
                'domain' => '.forexmart.com',
                'secure' => true,
                'path' => '/',
                'prefix' => '',
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
        }
        //for advertisement cookie
    }

        public function  index()
    {
        if ($this->session->userdata('admin_manage')) {

            UserAccess::checkUserPermission("fina");
            $data['access'] = UserAccess::ManageAccessList();

        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('sum', 'Account Number', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|numeric|required|xss_clean');
        $success = false;
        if ($this->form_validation->run()) {
            $account_number = $this->input->post('account_number');
            $amount = $this->input->post('sum');
            $comment_id = $this->input->post('comment');
            $data['credit'] = $this->Finance_model->showssingle($table='mt4_comment',$field="id",$id=$comment_id,$select="id,api_method,comment,payment_date,transaction_id,payment_option",$order_by="");

            $account = $this->Finance_model->getAccountsByAccountNumber( $account_number );
            $partner =  $this->Finance_model->showt2w1j1($table="partnership",$table2="users",$field="reference_num",$id=$account_number,$select="partnership.currency,users.accountstatus,users.id",$join12="users.id=partnership.partner_id",$order="",$group="");
            if($account){
                switch ($data['credit']['api_method']){
                    case 1:
                        $this->credit_prize_v2($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 2:
                        $this->credit_ndb_v2($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 3:
                        $this->credit_supporter_full_v2($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 4:
                        $this->credit_supporter_part_v2($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 5:
                        $this->credit_showfx_bonus_v2($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 6:
                        $this->credit_30percent_bonus_v2($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 7:
                        $this->credit_manualdeposit($account, $account_number, $amount,false,$data['credit']['comment'], $data['credit']);
                        break;
                    case 8:
                        $comment_only=($this->input->post('check')=='true')? true: false;
                        if ($comment_only==false){
                            do {
                                $transaction_id =rand(1000000000000000, 9999999999999999);
                                $deposit=$this->Finance_model->showssingle2($table='deposit',$field="transaction_id",$id=$transaction_id,$select="transaction_id",$order_by="");
                            } while ($deposit);

                            $data['date'] = $this->input->post('dateF');
                            $data['date'] = DateTime::createFromFormat('m/d/Y',   $data['date']);
                            $data['transaction_options']=array(
                                'comment'=> $data['credit']['comment'],
                                'payoption'=> 'N/A',
                                'payment_date'=>$data['date']->format('Y-m-d H:i:s'),
                                'transaction_id'=>$transaction_id,
                            );
                        }else{
                            $data['date'] = $this->input->post('dateF');
                            $data['date'] = DateTime::createFromFormat('m/d/Y',   $data['date']);
                            $data['transaction_options']=array(
                                'comment'=> $this->input->post('TC'),
                                'payoption'=> $this->input->post('payoption2'),
                                'payment_date'=>$data['date']->format('Y-m-d H:i:s'),
                                'transaction_id'=>$this->input->post('transactionidF'),
                            );
                        }
//
                        $this->credit_manualdeposit_v2($account, $account_number, $amount,false,  $data['transaction_options']);
                        break;
                    case 10:
                        $this->credit_mf_prize($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    case 11:
                        $this->credit_50percent_bonus($account, $account_number, $amount,false,$data['credit']['comment']);
                        break;
                    default:
                        $message = '<i class="fa fa-exclamation-circle"></i> Invalid fund option.';
                        $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            }else if ($partner){
                switch ($data['credit']['api_method']){
                    case 8:
                        $comment_only=($this->input->post('check')=='true')? true: false;
                        if ($comment_only==false){
                            do {
                                $transaction_id =rand(1000000000000000, 9999999999999999);
                                $deposit=$this->Finance_model->showssingle2($table='deposit',$field="transaction_id",$id=$transaction_id,$select="transaction_id",$order_by="");
                            } while ($deposit);

                            $data['date'] = $this->input->post('dateF');
                            $data['date'] = DateTime::createFromFormat('m/d/Y',   $data['date']);
                            $data['transaction_options']=array(
                                'comment'=> $data['credit']['comment'],
                                'payoption'=> 'N/A',
                                'payment_date'=>$data['date']->format('Y-m-d H:i:s'),
                                'transaction_id'=>$transaction_id,
                            );
                        }else{
                            $data['date'] = $this->input->post('dateF');
                            $data['date'] = DateTime::createFromFormat('m/d/Y',   $data['date']);
                            $data['transaction_options']=array(
                                'comment'=> $this->input->post('TC'),
                                'payoption'=> $this->input->post('payoption2'),
                                'payment_date'=>$data['date']->format('Y-m-d H:i:s'),
                                'transaction_id'=>$this->input->post('transactionidF'),
                            );
                        }

                        $this->credit_manualdeposit_v2p($partner, $account_number, $amount,false,  $data['transaction_options']);
                        break;
                    default:
                        $message = '<i class="fa fa-exclamation-circle"></i> Invalid fund option.';
                        $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            }else{
                $message = '<i class="fa fa-exclamation-circle"></i> Invalid account number.';
                $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
            }
//
        }else{
            $message = validation_errors('<i class="fa fa-exclamation-circle"></i> ');
            if($message){
                $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
            }
        }
//            Admin::checkUserPermission("creditf","manaccounts");
//            $data['data']['access']=  Admin::ManageAccessList();
//
//        $this->load->model('Task_model');
//        $this->t_m=$this->Task_model;
//
        $data['query'] = $this->Finance_model->showssingle2_tm($table='mt4_comment',$field="comment_type",$id=1,$field2="status",$id2=1,$select="comment,id,api_method",$order_by="date_created");
//            $options=array();
        $data['comments_option']='';
        $data['opt']='';
        if ($data['query']) {
            foreach($data['query'] as $key => $value ){
                $data['comments_option'].='<option value="'.$value['id'].'" data-apimethod="'.$value['api_method'].'"> '.$value['comment'].' </option>';
//                    $options[$value['id']]= $value['comment'];
            }
//                $data['comments_option'] = $this->General_model->selectOptionList($options);
        }
//
        $data['query'] = $this->Finance_model->showssingle2_tm($table='mt4_comment',$field="comment_type",$id=1,$field2="status",$id2=1,$select="id,comment_type,comment,value,date_created,api_method,transaction_id,payment_date,payment_option",$order_by="");
        $data['request']='';
        if ($data['query']) {
            foreach($data['query'] as $key => $value ){
                if ($value['payment_date']==null){
                    $date='';
                }else{
                    $date = DateTime::createFromFormat('Y-m-d H:i:s',  $value['payment_date']);
                    $date = $date->format('m/d/Y');
                }
                $data['request'] .= '<tr>';
                $data['request'] .= '<td> Credit Funds </td>';
                $data['request'] .= '<td>' . $value['comment'] . '</td>';
                $data['request'] .= '<td>' . $value['date_created'] . '</td>';
                $data['request'] .= '<td>
                    <a onclick="pre_def()" data-poption="'.$value['payment_option'].'"  data-pdate="'.$date.'"  data-trid="'.$value['transaction_id'].'"   data-id="'.$value['id'].'" data-api="'.$value['api_method'].'"  data-type="'.$value['comment_type'].'"  data-comment="'.$value['comment'].'"  class="curp queue-action edit" ><i class="fa fa-pencil action "></i>

                    <a onclick="pre_def()" data-id="'.$value['id'].'" data-commenttype="Credit Funds" data-type="'.$value['comment_type'].'"  data-comment="'.$value['comment'].'"  data-date="'.$value['date_created'].'"  class="curp queue-action push_delete" data-toggle="modal" data-target="#delete"><i class="fa fa-times-circle action"></i></a>
                    </td>';
                $data['request'] .= '</tr>';
            }
        }


        $data['menu'] = "accordion-finance";
        $data['active'] = "credit-funds";

        $data['type'] = 5;
        $this->template->title("Administration | Credit Funds")
            ->append_metadata_css("
                <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css'>
                <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css.map'>
                
                ")
            ->append_metadata_js("
                      <script src='".$this->template->Js()."moment.min.js'></script>
                      <script src='".$this->template->Js()."jquery.dataTables.min.js'></script>
                      <script src='".$this->template->Js()."datetime-moment.min.js'></script>
                      <script src='".$this->template->Js()."dataTables.bootstrap.min.js'></script>
                      <script src='".$this->template->Js()."jquery.validate.min.js'></script>
                      
                ")
            ->set_layout('mwp/main')
            ->build('manage-accounts/credit_funds',$data);
    }else{
        setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
        redirect('signout/admin');
    }
}

    private function credit_prize_v2( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;
        $config = array(
            'server' => 'live_new'
        );

        if($is_cancel){
            $amount *= -1;
        }
        $WebService = new WebService($config);
        $WebService->credit_prize($account_number, $amount, $comment);
        if ($WebService->request_status === 'RET_OK') {
            $success = true;
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' from account number [' . $account_number . ']';
            }else{
                $message = '<i class="fa fa-check-circle"></i> You have successfully credited ' . number_format($amount, 2) . ' to account number [' . $account_number . ']';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            FXPP::leverage_auto_change_50($account_number);
        }else{
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
        if($is_cancel) {
            redirect('cancel-funds/');
        }else{
            redirect('credit-funds/');
        }
//        }else{
//            $message = '<i class="fa fa-exclamation-circle"></i> Account is not verified.';
//            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
//        }
    }

    private function credit_ndb_v2( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;

        if ($account) {
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);

            // Remove Agent Account before Deposit Bonus
            $getAccountAgent = FXPP::GetAccountAgent($account_number);

            if($getAccountAgent){
                $webservice_config = array('server' => 'live_new');
                $WebServiceRemove = new WebService($webservice_config);
                $WebServiceRemove->RemoveAgentOfAccount($account_number);
                if ($WebServiceRemove->request_status === 'RET_OK') {
                    $removeData = array(
                        'AccountNumber' => $account_number,
                        'AgentAccountNumber' => $getAccountAgent,
                        'DateRemoved' => FXPP::getCurrentDateTime()
                    );
                    $this->General_model->insertmy($table = "removed_agents",$removeData);
                }
            }

            if($is_cancel){
                $amount *= -1;
            }

            $account_info = array(
                'Login' => $account_number,
                'AccountNumber' => $account_number,
                'FundTransferAccountReciever' => $account_number,
                'Amount' => $amount,
                'Comment' => $comment,
                'ProcessByIP' => $this->input->ip_address()
            );

            $WebService->open_Deposit_NoDepositBonus($account_info);

            if ($WebService->request_status === 'RET_OK') {
                $WebService2 = new WebService($webservice_config);
                $groupCurrency = $this->Deposits_model->getGroupCurrency($account['mt_account_set_id'], $account['mt_currency_base'], $account['swap_free']);
                /**
                 * $user_details = $this->user_model->getUserProfileByUserId($_SESSION['user_id']);
                 */
                FXPP::update_account_group();
                $account_details = $this->Deposits_model->getAccountByUserId($account['user_id']);

                $this->load->model('Managecontest_model');
                $prize_data = array(
                    'user_id' => $account['user_id'],
                    'account_number' => $account_number,
                    'manager_id' => $this->session->userdata('user_id'),
                    'amount' => $amount,
                    'comment' => $comment,
                    'ticket' => $WebService->get_result('Ticket'),
                    'date_processed' => FXPP::getCurrentDateTime()
                );
                $this->Managecontest_model->insertCreditPrize($prize_data);

                $isMicro = $this->account_model->isMicro($account['user_id']);
                if($isMicro){
                    $groupCurrency .= 'C';
                }

                $groupCurrency .= 'ndb' . $account_details['group_code'];

                $account_info2 = array(
                    'iLogin' => $account['account_number'],
                    'strGroup' => $groupCurrency
                );
                $WebService2->open_ChangeAccountGroup($account_info2);

                $user = $this->Deposits_model->getUserProfileByUserId($account['user_id']);
                if (in_array(strtoupper($user['country']), array('PL'))) {
                    $account_info3 = array(
                        'iLogin' => $account['account_number'],
                        'iLeverage' => '100'
                    );
                } else {
                    $account_info3 = array(
                        'iLogin' => $account['account_number'],
                        'iLeverage' => '200'
                    );
                }
                $WebService3 = new WebService($webservice_config);
                $WebService3->open_ChangeAccountLeverage($account_info3);

                $sum = floatval($amount) + floatval($account['amount']);

                $prvt_data['amount'] = array(
                    'amount' => $sum,
                    'leverage' => '1:200'
                );

                $this->g_m->updatemy($table = 'mt_accounts_set', $field = 'id', $id = $account['id'], $prvt_data['amount']);

                $date_updated = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                $prvt_data['nodepositbonus'] = array(
                    'nodepositbonus' => 1,
                    'ndba_acquired' => $date_updated->format('Y-m-d H:i:s'),
                    'ndb_bonus' => floatval($amount)
                );
                //update table users
                $this->g_m->updatemy($table = 'users', $field = 'id', $id = $id = $account['user_id'], $prvt_data['nodepositbonus']);

                $this->Deposits_model->setNoDepositRequestStatus($account['user_id'], 1);
                if ($WebService2->request_status == 'RET_OK' and $WebService3->request_status == 'RET_OK') {
                    $success = true;
                    if($is_cancel){
                        $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
                    }else {
                        $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' No Deposit Bonus';
                    }
                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                } else {
                    $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available for updating account leverage and group.';
                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            } else {
                $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
                $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
            }

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
//                    } else {
//                        $message = '<i class="fa fa-exclamation-circle"></i> Account type should be ForexMart standard.';
//                        $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
//                    }
//                } else {
//                    $message = '<i class="fa fa-exclamation-circle"></i> Account is not verified.';
//                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
//                }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Invalid account number.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
//        } else {
//            $message = '<i class="fa fa-exclamation-circle"></i> Account ' . $account_number . ' has not requested for NDB yet.';
//            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
//        }
    }




    private function credit_supporter_full_v2( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;

        if($is_cancel){
            $amount *= -1;
        }

        $config = array(
            'server' => 'live_new'
        );
        $WebService = new WebService($config);

        $account_info = array(
            'Amount' =>  $amount,
            'Comment' => $comment,
            'CommentFundTransferReceiver' => $comment,
            'FundTransferAccountReceiver' => 0,
            'FundTransferReceiverAmount' => $amount,
            'account_number' => $account_number
        );
        if($is_cancel){
            $WebService->open_Withdraw_Supporter_Full_Fund($account_info);
        }else{
            $WebService->open_Deposit_Supporter_Full_Fund($account_info);
        }
        if ($WebService->request_status === 'RET_OK') {
            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Deposits_model->updateAccountBalance($account_number, $balance);
                FXPP::leverage_auto_change_50($account_number);
            }
            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' SUPPORTER FULL';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }




    private function credit_supporter_part_v2( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;
        if($is_cancel){
            $amount *= -1;
        }
        $config = array(
            'server' => 'live_new_wsdl'
        );
        $WebService = new WebService($config);
        $WebService->credit_supporter_part($account_number, $amount, $comment);
        if ($WebService->request_status === 'RET_OK') {
            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
                FXPP::leverage_auto_change_50($account_number);
            }
            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' SUPPORTER PART';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }



    private function credit_showfx_bonus_v2( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;
        if($is_cancel){
            $amount *= -1;
        }

        $config = array(
            'server' => 'live_new_wsdl'
        );
        $WebService = new WebService($config);

        $WebService->credit_showfx_bonus($account_number, $amount, $comment);
        if ($WebService->request_status === 'RET_OK') {

            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
                FXPP::leverage_auto_change_50($account_number);
            }
            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' SHOWFX BONUS';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }

    private function credit_manualdeposit_v2p( $partner, $account_number, $amount, $is_cancel = false ,$transaction_options=""){
        $success = false;
        if($is_cancel){
            $amount *= -1;
        }
        $config = array(
            'server' => 'live_new_wsdl'
        );

        do {
            $reference_id =rand(1000000000000000, 9999999999999999);
            $deposit=$this->General_model->showssingle2($table='deposit',$field="reference_id",$id=$reference_id,$select="reference_id",$order_by="");
        } while ($deposit);

        $WebService = new WebService($config);
//        $comment="TEST DEPOSIT";
        $WebService->update_live_deposit_balance($account_number, $amount, $transaction_options['comment']);
        if ($WebService->request_status === 'RET_OK') {
            $data['mt_ticket'] = $WebService->get_result('Ticket');
            $data['insert'] = array(
                'transaction_id' =>$transaction_options['transaction_id'],
                'reference_id' => $reference_id,
                'status' => 2,
                'amount' =>   $amount,
                'currency' => $partner[0]['currency'],
                'user_id' => $partner[0]['id'],
                'payment_date' => $transaction_options['payment_date'],
                'note' => 'Manual Deposit',
                'transaction_type' => ($transaction_options['payoption']=='N/A')?'N/A':$this->General_model->getDepositTransactionType($transaction_options['payoption']),
                'mt_ticket' =>   $data['mt_ticket'],
                'conv_amount' =>   $this->get_convert_amount($partner[0]['currency'], $amount, $to_currency = 'USD'),
                'admin_manualdeposit_users_id' => $_SESSION['user_id']
            );
            $data['deposit_insert_id'] = $this->General_model->insertmy($table = "deposit",$data['insert']);

            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $data= array(
                    'amount'=>$balance
                );
                $this->general_model->updatemy($table='partnership',$field='reference_num',$id=$account_number,$data);
            }

            $success = true;

            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $partner[0]['currency'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $partner[0]['currency']. ' Manual Deposit using DepositRealFund ';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }


    private function credit_30percent_bonus_v2( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;

        if($is_cancel){
            $amount *= -1;
        }

        $config = array(
            'server' => 'live_new'
        );
        $WebService = new WebService($config);
        $account_info = array(
            'Login' => $account_number,
            'AccountNumber' => $account_number,
            'Amount' => $amount,
            'Comment' => $comment,
            'ProcessByIP' => $this->input->ip_address()
        );
        $WebService->open_Deposit_30PercentBonus($account_info);
        if ($WebService->request_status === 'RET_OK') {
            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
            }
            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' 30% WELCOME BONUS';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available. [' . $WebService->request_status . ']';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }

    private function get_convert_amount($currency, $amount, $to_currency = 'USD')
    {
        if ($currency == $to_currency) {
            $conv_amount = $amount;
        } else {

            $currency_convert_config = array(
                'server' => 'converter',
                'service_id' => '505641',
                'service_password' => '5fX#p8D^c89bQ'
            );

            $WebService = new WebService($currency_convert_config);
            $data = array(
                'amount' => $amount,
                'from_currency' => strtoupper(trim($currency)),
                'to_currency' => $to_currency
            );

            $WebService->convert_currency_amount($data);
            if ($WebService->request_status === 'RET_OK') {
                $converted_amount = $WebService->get_result('ToAmount');
                $conv_amount = number_format($converted_amount, 2);
            } else {
                $conv_amount = $amount;
            }
        }

        return $conv_amount;
    }

    private function credit_manualdeposit( $account, $account_number, $amount, $is_cancel = false ,$comment,$mt4comment){
        $success = false;
        if($is_cancel){
            $amount *= -1;
        }
        $config = array(
            'server' => 'live_new_wsdl'
        );


        $WebService = new WebService($config);
//        $comment="TEST DEPOSIT";
        $WebService->update_live_deposit_balance($account_number, $amount, $comment);
        do {
            $reference_id =rand(1000000000000000, 9999999999999999);
            $deposit=$this->General_model->showssingle2($table='deposit',$field="reference_id",$id=$reference_id,$select="",$order_by="");
        } while ($deposit);

        if ($WebService->request_status === 'RET_OK') {
            $data['mt_ticket'] = $WebService->get_result('Ticket');
            $data['insert'] = array(
                'transaction_id' => $mt4comment['transaction_id'],
                'reference_id' => $reference_id,
                'status' => 2,
                'amount' =>   $amount,
                'currency' => $account['mt_currency_base'],
                'user_id' => $account['user_id'],
                'payment_date' => $mt4comment['payment_date'],
                'note' => 'Manual Deposit',
                'transaction_type' => $this->Finance_model->getDepositTransactionType($mt4comment['payment_option']),
                'mt_ticket' =>   $data['mt_ticket'],
                'conv_amount' => $this->get_convert_amount($account['mt_currency_base'], $amount, $to_currency = 'USD')
            );
            $data['deposit_insert_id'] = $this->General_model->insertmy($table = "deposit",$data['insert']);

            $data['update'] = array(
                'mt4_ticket' =>   $data['mt_ticket'] ,
            );

            $this->General_model->updatemy($table = "mt4_comment",$field='id',$id=$mt4comment['id'], $data['update']);

            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
            }

            $success = true;

            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' Manual Deposit using DepositRealFund ';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }

    private function credit_manualdeposit_v2( $account, $account_number, $amount, $is_cancel = false ,$transaction_options=""){
        $success = false;
        if($is_cancel){
            $amount *= -1;
        }
        $config = array(
            'server' => 'live_new_wsdl'
        );

        do {
            $reference_id =rand(1000000000000000, 9999999999999999);
            $deposit=$this->General_model->showssingle2($table='deposit',$field="reference_id",$id=$reference_id,$select="reference_id",$order_by="");
        } while ($deposit);

        $WebService = new WebService($config);
//        $comment="TEST DEPOSIT";
        $WebService->update_live_deposit_balance($account_number, $amount, $transaction_options['comment']);
        if ($WebService->request_status === 'RET_OK') {
            $data['mt_ticket'] = $WebService->get_result('Ticket');
            $data['insert'] = array(
                'transaction_id' =>$transaction_options['transaction_id'],
                'reference_id' => $reference_id,
                'status' => 2,
                'amount' =>   $amount,
                'currency' => $account['mt_currency_base'],
                'user_id' => $account['user_id'],
                'payment_date' => $transaction_options['payment_date'],
                'note' => 'Manual Deposit',
                'transaction_type' => ($transaction_options['payoption']=='N/A')?'N/A':$this->Finance_model->getDepositTransactionType($transaction_options['payoption']),
                'mt_ticket' =>   $data['mt_ticket'],
                'conv_amount' =>   $this->get_convert_amount($account['mt_currency_base'], $amount, $to_currency = 'USD'),
                'admin_manualdeposit_users_id' => $_SESSION['user_id']
            );
            $data['deposit_insert_id'] = $this->General_model->insertmy($table = "deposit",$data['insert']);

            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
            }

            $success = true;

            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' Manual Deposit using DepositRealFund ';
            }

                        /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $transaction_options['comment'],
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';

            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }


    private function credit_mf_prize( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $this->load->model('Managecontest_model');
        $success = false;
        $config = array(
            'server' => 'live_new'
        );

        if($is_cancel){
            $amount *= -1;
        }
        $WebService = new WebService($config);
        $WebService->credit_mf_Prize($account_number, $amount, $comment);
        if ($WebService->request_status === 'RET_OK') {
            $success = true;
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment,
                'ticket' => $WebService->get_result('Ticket'),
                'date_processed' => FXPP::getCurrentDateTime()
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' from account number [' . $account_number . ']';
            }else{
                $message = '<i class="fa fa-check-circle"></i> You have successfully credited ' . number_format($amount, 2) . ' to account number [' . $account_number . ']';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            FXPP::leverage_auto_change_50($account_number);
        }else{
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
        if($is_cancel) {
            redirect('cancel-funds/');
        }else{
            redirect('credit-funds/');
        }
//        }else{
//            $message = '<i class="fa fa-exclamation-circle"></i> Account is not verified.';
//            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
//        }
    }

    private function credit_50percent_bonus( $account, $account_number, $amount, $is_cancel = false ,$comment){
        $success = false;

        if($is_cancel){
            $amount *= -1;
        }

        $config = array(
            'server' => 'live_new'
        );
        $WebService = new WebService($config);
        $account_info = array(
            'AccountNumber' => $account_number,
            'Amount' => $amount,
            'Comment' => $comment,
            'ProcessByIP' => $this->input->ip_address()
        );
        $WebService->open_Deposit_50_PercentBonus($account_info);
        if ($WebService->request_status === 'RET_OK') {
            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
            }
            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' DEPOSIT 50% BONUS';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available. [' . $WebService->request_status . ']';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }
    public function get_account_details_v2(){
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {

            $account_number = $this->input->post('account_number',true);
            $client_account = $this->Finance_model->getAccountsByAccountNumber( $account_number );
            $currency = '';
            if($client_account){
                $currency = $client_account['mt_currency_base'];
                $user_status = $this->Finance_model->getAccountStatus($client_account['user_id']);
                if($user_status){
                    $verified = true;
                }else{
                    $verified = false;
                }

                $this->output->set_content_type('application/json')->set_output(json_encode(array('currency' => $currency, 'verified' => $verified)));
            }

            $partner_account = $this->Finance_model->showt2w1j1($table="partnership",$table2="users",$field="reference_num",$id=$account_number,$select="partnership.currency,users.accountstatus",$join12="users.id=partnership.partner_id",$order="",$group="");
            if($partner_account){
                $currency=$partner_account[0]['currency'];
                if($partner_account[0]['accountstatus']==1){
                    $verified = true;
                }else{
                    $verified = false;
                }
                $this->output->set_content_type('application/json')->set_output(json_encode(array('currency' => $currency, 'verified' => $verified)));
            }
        }else{
            show_404();
        }
    }

     private function cancel_by_withdrawal( $account, $account_number, $amount, $type, $is_cancel = false,$comment='W/D',$comment_only=false ){
        date_default_timezone_set('Europe/Minsk');
        $this->load->model('withdraw_model');

        $success = false;

        if($is_cancel){
            $withdraw_comment = '';
        }else{
            $withdraw_comment = 'W/D_';
            $amount *= -1;
        }

        $new_date = new DateTime();
        $generated_transaction_number = $new_date->getTimestamp();
        $withdraw_comment = 'W/D_';
//        $comment = $withdraw_comment . $type ."_". $generated_transaction_number;
        $config = array(
            'server' => 'live_new_wsdl'
        );

        $is_supporter = false;
        $WebService3 = new WebService($config);
        $WebService3->GetSupporterBonusFunds($account_number);
        if ($WebService3->request_status === 'RET_OK') {
            $supporter_full_count = $WebService3->get_result('SupporterFullCount');
            $supporter_part_count = $WebService3->get_result('SupporterPartCount');
            $supporter_count = $supporter_full_count + $supporter_part_count;
            if($supporter_count > 0){
                $is_supporter = true;
                if ($comment_only){
                    $comment = "S_" . $comment ."_". $type ."_". $generated_transaction_number;
                }else{
                    $comment = "S_" . $comment;
                }
            }else{
                if ($comment_only){
                    $comment = $comment ."_". $type ."_". $generated_transaction_number;
                }
            }
        }else{
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }

        $WebService = new WebService($config);

        $date_now = FXPP::getCurrentDateTime();
        if($is_supporter){
            $WebService->update_supporter_withdraw_balance($account_number, $amount, $comment);
        }else{
            $WebService->update_live_withdraw_balance($account_number, $amount, $comment);
        }
        if ($WebService->request_status === 'RET_OK') {
            $ticket = $WebService->get_result('Ticket');
            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
            }

            $withdraw_data = array(
                'comment' => "Manual Withdrawal",
                'account_number' => $account_number,
                'user_id' => $account['user_id'],
                'date_withdraw' => $date_now,
                'currency' => $account['mt_currency_base'],
                'reference_number' => $ticket,
                'transaction_type' => $type,
                'amount' => $amount,
                'amount_deducted' => 0,
                'status' => 1,
                'transaction_id' => 0,
                'fee' => 0,
                'added_fee' => 0,
                'ref_num_mt4' => $generated_transaction_number,
                'admin_manualwithdraw_users_id'=>$_SESSION['user_id']
            );

            $this->withdraw_model->insertWithdraw($withdraw_data);

            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with18 ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' Deposit';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';

            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }

    }

    private function credit_deposit_v2( $account, $account_number, $amount, $is_cancel = false ,$comment)    {
        $success = false;
        if($is_cancel){
            $amount *= -1;
        }

        $config = array(
            'server' => 'live_new_wsdl'
        );
        $WebService = new WebService($config);

        $WebService->update_live_deposit_balance($account_number, $amount, $comment);
        if ($WebService->request_status === 'RET_OK') {
            $WebService2 = new WebService($config);
            $WebService2->request_live_account_balance($account_number);
            if ($WebService2->request_status === 'RET_OK') {
                $balance = $WebService2->get_result('Balance');
                $this->Finance_model->updateAccountBalance($account_number, $balance);
            }
            $success = true;
            if($is_cancel){
                $message = '<i class="fa fa-check-circle"></i> You have successfully cancelled ' . number_format(abs($amount), 2) . ' ' . $account['mt_currency_base'] . ' from account number [' . $account_number . ']';
            }else {
                $message = '<i class="fa fa-check-circle"></i> Account number [' . $account_number . '] has been credited with13 ' . number_format($amount, 2) . ' ' . $account['mt_currency_base'] . ' Deposit';
            }
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

            $this->load->model('Managecontest_model');
            $prize_data = array(
                'user_id' => $account['user_id'],
                'account_number' => $account_number,
                'manager_id' => $this->session->userdata('user_id'),
                'amount' => $amount,
                'comment' => $comment
            );
            $this->Managecontest_model->insertCreditPrize($prize_data);

            /*admin_log*/
            $this->load->model('Adminslogs_model');
            $arr = array(
                'Amount' => $amount,
                'Comment' => $comment,
                'Manager_IP'=>$_SERVER['REMOTE_ADDR']
            );

            if($is_cancel){
                $page = 'cancel-funds/mwp';
            }else{
                $page = 'credit-funds/mwp';
            }

            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => $page,
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$account['user_id'],
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $account_number,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );

            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            /*admin_log*/

            if($is_cancel) {
                redirect('cancel-funds/');
            }else{
                redirect('credit-funds/');
            }
        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Web service is not available.';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }

        public function cancel_funds()
    {
        if ($this->session->userdata('admin_manage')) {

            UserAccess::checkUserPermission("fina");
            $data['access'] = UserAccess::ManageAccessList();
            
            $this->form_validation->set_rules('account_number', 'Account Number', 'trim|numeric|required|xss_clean');
            $this->form_validation->set_rules('sum', 'Account Number', 'trim|numeric|required|xss_clean');
            $this->form_validation->set_rules('comment', 'Comment', 'trim|numeric|required|xss_clean');
            $success = false;

            if ($this->form_validation->run()) {
                $account_number = $this->input->post('account_number');
                $amount = $this->input->post('sum');
                $comment_id = $this->input->post('comment');
                $data['credit'] = $this->Finance_model->showssingle($table='mt4_comment',$field="id",$id=$comment_id,$select="api_method,comment",$order_by="");
                $account = $this->Finance_model->getAccountsByAccountNumber( $account_number );
                $partner =  $this->Finance_model->showt2w1j1($table="partnership",$table2="users",$field="reference_num",$id=$account_number,$select="partnership.currency,users.accountstatus,users.id",$join12="users.id=partnership.partner_id",$order="",$group="");
                if($account){
                    switch ($data['credit']['api_method']){
                        case 1:
                            $this->credit_prize_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            //redirect('Credit_funds/credit_prize_v2/'. $account['user_id'] . '/' . $account_number . '/' . $amount . '/' . true . '/' . $data["credit"]["comment"]);
                            break;
                        case 2:
                            $this->credit_ndb_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 3:
                            $this->credit_supporter_full_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 4:
                            $this->credit_supporter_part_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 5:
                            $this->credit_showfx_bonus_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 6:
                            $this->credit_30percent_bonus_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;  
                        case 7:
                            $this->credit_deposit_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 8:
                            if(IPLoc::Office()){
                                $type = $this->input->post('payment');
                                if(array_key_exists($type, $this->comment_transaction_type)){
                                    $this->credit_withdraw_test_v2($account, $account_number, $amount, $type, true,$data['credit']['comment']);
                                }else{
                                    $message = '<i class="fa fa-exclamation-circle"></i> Invalid payment system.';
                                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                                }
                            }else{
                                $this->credit_withdraw_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            }
                            break;
                        case 9:
                            $comment_only=($this->input->post('check')=='true')? true: false;
                            if ($comment_only==false){
                                $type='N/A';
                            }else{
                                $type = $this->input->post('payoption');
                            }

                            $this->cancel_by_withdrawal($account, $account_number, $amount, $type, true,$data['credit']['comment'],$comment_only);
                            break;
                        case 10:
                            $this->credit_mf_prize($account, $account_number, $amount,true,$data['credit']['comment']);
                            break;
                        case 11:
                            $this->credit_50percent_bonus($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        default:
                            $message = '<i class="fa fa-exclamation-circle"></i> Invalid fund option.';
                            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                    }
                }else if ($partner){
                    switch ($data['credit']['api_method']){
                        case 9:
                            $comment_only=($this->input->post('check')=='true')? true: false;
                            if ($comment_only==false){
                                $type='N/A';
                            }else{
                                $type = $this->input->post('payoption');
                            }

                            $this->cancel_by_withdrawalp($partner, $account_number, $amount, $type, true,$data['credit']['comment'],$comment_only);
                            break;
                        default:
                            $message = '<i class="fa fa-exclamation-circle"></i> Invalid fund option.';
                            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                    }
                }else{
                    $message = '<i class="fa fa-exclamation-circle"></i> Invalid account number.';
                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            }else{
                $message = validation_errors('<i class="fa fa-exclamation-circle"></i> ');
                if($message){
                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            }
//            Admin::checkUserPermission("cancelf","manaccounts");
//            $data['access'] = Admin::ManageAccessList();
//            $this->load->model('Task_model');
//            $this->t_m=$this->Task_model;

            $data['query'] = $this->Finance_model->showssingle2_tm($table='mt4_comment',$field="comment_type",$id=0,$field2="status",$id2=1,$select="comment,id,api_method",$order_by="date_created");

//            $options = array();

            $data['comments_option']='';

            if ($data['query']) {
                foreach($data['query'] as $key => $value ){
//                    $options[$value['id']]= $value['comment'];
                    $data['comments_option'].='<option value="'.$value['id'].'" data-apimethod="'.$value['api_method'].'"> '.$value['comment'].' </option>';
                }
//                $data['comments_option'] = $this->General_model->selectOptionList($options);

            }


            $data['query'] = $this->Finance_model->showssingle2_tm($table='mt4_comment',$field="comment_type",$id=0,$field2="status",$id2=1,$select="id,comment_type,comment,value,date_created,api_method,transaction_id,payment_date,payment_option",$order_by="");
            $data['request']='';
            if ($data['query']) {
                foreach($data['query'] as $key => $value ){
                    if ($value['payment_date']==null){
                        $date='';
                    }else{
                        $date = DateTime::createFromFormat('Y-m-d H:i:s',  $value['payment_date']);
                        $date = $date->format('m/d/Y');
                    }

                    $data['request'] .= '<tr>';
                    $data['request'] .= '<td> Cancel Funds </td>';
                    $data['request'] .= '<td>' . $value['comment'] . '</td>';
                    $data['request'] .= '<td>' . $value['date_created'] . '</td>';
                    $data['request'] .= '<td>
                    <a onclick="pre_def()" data-poption="'.$value['payment_option'].'"  data-pdate="'.$date.'"  data-trid="'.$value['transaction_id'].'"   data-id="'.$value['id'].'" data-api="'.$value['api_method'].'"  data-type="'.$value['comment_type'].'"  data-comment="'.$value['comment'].'"  class="curp queue-action edit" ><i class="fa fa-pencil action "></i>

                    <a onclick="pre_def()" data-id="'.$value['id'].'" data-commenttype="Credit Funds" data-type="'.$value['comment_type'].'"  data-comment="'.$value['comment'].'"  data-date="'.$value['date_created'].'"  class="curp queue-action push_delete" data-toggle="modal" data-target="#delete"><i class="fa fa-times-circle action"></i></a>
                    </td>';
                    $data['request'] .= '</tr>';
                }
            }

            $data['payment_option'] = $this->Finance_model->selectOptionList($this->transaction_type);

            $data['payoption'] = $this->General_model->selectOptionList($this->withtdraw_transaction_type);

            $data['type'] = 7;

            $data['menu'] = "accordion-finance";
            $data['active'] = "cancel-funds";

//            $data['sidebar'] = $this->load->view('layouts/administration/manage_account_nav', $data, TRUE);
            $this->template->title("Administration | Cancel Funds")
                ->append_metadata_css("

                <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                <link rel='stylesheet' type='text/css' href='//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css'/>
                <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css'>
                <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css.map'>

                ")
                ->append_metadata_js("
                      <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                      <script src='".$this->template->Js()."Moment.js'></script>
                      <script src='".$this->template->Js()."datetime-moment.js'></script>
                      <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                      <script src='".$this->template->Js()."jquery.validate.min.js'></script>
                        <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#manageaccounts').addClass('active-int-nav');
                            });
                      </script>
                ")

                ->set_layout('mwp/main')
                ->build('manage-accounts/cancel_funds',$data);
        }
    }
}