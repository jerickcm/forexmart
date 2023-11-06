<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_mini_bonus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) { // logged in

            redirect('signin');

        }

        $this->load->model('Finance_model');
        $this->load->library('Fx_mailer');
        // $this->load->library('iploc');
        $this->load->library('UserAccess');
        $this->load->model('account_model');

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
           $success = false;
           if ($this->form_validation->run()) {

               $OtherAccount_is_enable=True;
               $ThisAccount_is_enable=True;

               $account_number = $this->input->post('account_number');
               $account = $this->account_model->getAccountsByAccountNumber_minibonus( $account_number );
               $no_deposit = $this->Finance_model->showssingle2($table='no_deposit',$field='account_number',$id=$account_number,$select='*');
               if($account){
                   if ($no_deposit){
                       $message = '<i class="fa fa-exclamation-circle"></i> Account Number has already have a nodeposit bonus request.';
                       $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                   }else{
                       if($account['accountstatus']==1){ // check if user is verified
                           if($account['nodepositbonus']!=1 ) { // check nodepositbonus if acquired by this account
                               $account_info = array(
                                   'iLogin' => $account_number
                               );
                               $webservice_config = array('server' => 'live_new');
                               $WebService = new WebService($webservice_config);
                               $WebService->open_RequestAccountDetails($account_info);

                               if( $WebService->request_status === 'RET_OK' ) {
                                   $group=$WebService->get_result('Group');
                                   if ($WebService->get_result('IsEnable')==False){
                                       $ThisAccount_is_enable=False;
                                   }

                                   $ForMarStaAcc = array(
                                       "StSwUS1", "StSwEU1", "StSwGB1", "StSwRU1", "StSFUS1", "StSFEU1", "StSFGB1", "StSFRU1",
                                       "StSwUS2", "StSwEU2", "StSwGB2", "StSwRU2", "StSFUS2", "StSFEU2", "StSFGB2", "StSFRU2",
                                       "StSwUS3", "StSwEU3", "StSwGB3", "StSwRU3", "StSFUS3", "StSFEU3", "StSFGB3", "StSFRU3"
                                   );
                                   if (in_array($group, $ForMarStaAcc)) {
                                       $is_standardaccount=true;
                                   } else {
                                       $is_standardaccount=false;
                                   }

                                   $this->load->model('Task_model');
                                   $this->t_m = $this->Task_model;
                                   $IsAcquiredFromOtherAccount = false;

                                   //check for account fullname
                                   $data['accountfullname'] = $this->t_m->showFullname_v2(
                                       $table1 = 'users',$table2 = 'user_profiles',$table3='mt_accounts_set',
                                       $field2 = 'user_profiles.full_name', $id2 = trim($account['full_name']),
                                       $field1 = 'user_profiles.dob', $id1 = trim($account['dob']),
                                       $field3 = 'users.ndb_bonus!=', $id3 = '',
                                       $field4 = 'users.id !=', $id4=$account['user_id'],
                                       $join12 = 'users.id=user_profiles.user_id',
                                       $join13 = 'users.id=mt_accounts_set.user_id',
                                       $select = 'ndb_bonus,users.email,user_profiles.dob,account_number,nodepositbonus'
                                   );

                                   $count_active_accounts = 0;
                                   $accounts='';
                                   if ( $data['accountfullname']) {
                                       foreach ( $data['accountfullname'] as $key1 => $value1) {
                                           if ((!isset($value1['ndb_bonus'])) || trim($value1['ndb_bonus']) === '' ) {

                                           }else if(is_null($value1['ndb_bonus'])) {

                                           } else {

                                               $IsAcquiredFromOtherAccount = true;
                                           }

                                           $account_info = array(
                                               'iLogin' => $value1['account_number']
                                           );
                                           $WebService2 = new WebService($webservice_config);
                                           $WebService2->open_RequestAccountDetails($account_info);
                                           if( $WebService2->request_status === 'RET_OK' ) {
                                               $count_active_accounts=$count_active_accounts+1;
                                               $accounts .= $value1['account_number'].',';
                                               if ($WebService2->get_result('IsEnable')==False){
                                                   $OtherAccount_is_enable=False;
                                               }
                                           }
                                       }

                                   }

                                   //check for account email
                                   $data['accountemail'] = $this->t_m->showEmail_v2(
                                       $table1 = 'users',$table2 = 'user_profiles',$table3='mt_accounts_set',
                                       $field1 = 'UCASE(users.email)', $id1 = strtoupper($account['email']),
                                       $field3 = 'users.ndb_bonus!=', $id3 = '',
                                       $field4 = 'users.id !=', $id4=$account['user_id'],
                                       $join12 = 'users.id=user_profiles.user_id',
                                       $join13 = 'users.id=mt_accounts_set.user_id',
                                       $select = 'ndb_bonus,users.email,account_number,nodepositbonus'
                                   );

                                   if ($data['accountemail']) {
                                       foreach ( $data['accountemail'] as $key2 => $value2) {
                                           if ((!isset($value2['ndb_bonus'])) || trim($value2['ndb_bonus']) === '' ) {

                                           }else if(is_null($value2['ndb_bonus'])) {

                                           } else {
                                               $IsAcquiredFromOtherAccount = true;
                                           }

                                           $account_info = array(
                                               'iLogin' => $value2['account_number']
                                           );
                                           $WebService3 = new WebService($webservice_config);
                                           $WebService3->open_RequestAccountDetails($account_info);
                                           if( $WebService3->request_status === 'RET_OK' ) {
                                               $count_active_accounts=$count_active_accounts+1;
                                               $accounts .= $value2['account_number'].',';
                                           }

                                       }
                                   }


                                   if ($IsAcquiredFromOtherAccount == true){

                                       $message = '<i class="fa fa-exclamation-circle"></i> Bonus has been credited from another account.';
                                       $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

                                   }elseif($count_active_accounts>0){

                                       $message = '<i class="fa fa-exclamation-circle"></i> Account Number has other active accounts. '.rtrim($accounts, ",");
                                       $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

                                   }elseif ($is_standardaccount==false){
                                       $message = '<i class="fa fa-exclamation-circle"></i> Account Number is not a standard account. '.$group ;
                                       $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                                   }elseif ($ThisAccount_is_enable==False){
                                       $message = '<i class="fa fa-exclamation-circle"></i> This account number is not Enabled. ';
                                       $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                                   }elseif ($OtherAccount_is_enable==False){
                                       $message = '<i class="fa fa-exclamation-circle"></i> Another account number is not Enabled. ';
                                       $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                                   }else{

                                       $this->credit_minibonus($account, $account_number,false);

                                   }

                               }else{

                                   $message = '<i class="fa fa-exclamation-circle"></i> Account Number is inactive';
                                   $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

                               }

                           }else{
                               $message = '<i class="fa fa-exclamation-circle"></i> Account Number has already acquired no deposit bonus';
                               $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                           }


                       }else{

                           $message = '<i class="fa fa-exclamation-circle"></i> Account Number is not verified.';
                           $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));

                       }
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


            $data['type'] = 9;

            $data['menu'] = "accordion-finance";
            $data['active'] = "credit-mini-bonus";

           // $data['sidebar'] = $this->load->view('layouts/administration/manage_account_nav', $data, TRUE);
            $this->template->title("Administration | Credit Mini Bonus")
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
                ->build('manage-accounts/credit_mini_bonus_funds',$data);
        }else{
            setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
            redirect('signout/admin');
        }
    }

 private function credit_minibonus( $account, $account_number, $is_cancel = false ){
        $comment = 'FOREXMART NO DEPOSIT BONUS';
        $amount = 10;
        $this->load->model('deposit_model');
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
            if ($account['mt_currency_base']=='USD'){
                $conv_amount = $amount;
            }else{
                $conv_amount =  FXPP::getCurrencyRate($amount=10, $from_currency='USD', $to_currency=$account['mt_currency_base']);
            }
            $account_info = array(
                'Login' => $account_number,
                'FundTransferAccountReciever' => $account_number,
                'Amount' => $conv_amount,
                'Comment' => $comment,
                'ProcessByIP' => $this->input->ip_address()
            );

            $WebService->open_Deposit_NoDepositBonus($account_info);
            //var_dump($WebService->request_status); exit;
            if ($WebService->request_status === 'RET_OK') {
                $WebService2 = new WebService($webservice_config);
                $groupCurrency = $this->g_m->getGroupCurrency($account['mt_account_set_id'], $account['mt_currency_base'], $account['swap_free']);
                /**
                 * $user_details = $this->user_model->getUserProfileByUserId($_SESSION['user_id']);
                 */
                FXPP::update_account_group();
                $account_details = $this->account_model->getAccountByUserId($account['user_id']);

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
                $this->load->model('user_model');
                $user = $this->user_model->getUserProfileByUserId($account['user_id']);
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

                $sum = floatval($conv_amount) + floatval($account['amount']);

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

                $this->deposit_model->setNoDepositRequestStatus($account['user_id'], 1);
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

            //$page = 'manage-accounts/credit-mini-bonus';
            $page = FXPP::loc_url('credit-mini-bonus');
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

                //redirect('manage-accounts/credit-mini-bonus');
                redirect(FXPP::loc_url('credit-mini-bonus'));

        } else {
            $message = '<i class="fa fa-exclamation-circle"></i> Invalid account number.10';
            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
        }
    }


    public function get_account_details_minibonus2(){
            if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {

            UserAccess::checkUserPermission("fina");
            $data['access'] = UserAccess::ManageAccessList();

                $account_number = $this->input->post('account_number', true);
                $client_account = $this->account_model->getAccountsByAccountNumber1($account_number);

                $currency = '';
                if ($client_account) {
                    $currency = $client_account['mt_currency_base'];
                    $user_status = $this->Finance_model->getAccountStatus($client_account['user_id']);
                    
                    if ($user_status) {
                        $verified = true;
                    } else {
                        $verified = false;
                    }

                    $account_info = array(
                        'iLogin' => $account_number
                    );
                    $webservice_config = array('server' => 'live_new');
                    $WebService = new WebService($webservice_config);
                    $WebService->open_RequestAccountDetails($account_info);
                    if ($WebService->request_status === 'RET_OK') {
                        $active_account = true;
                    } else {
                        $active_account = false;
                    }
                    $success = true;
                } else {
                    $success = false;
                }
                $info = array(
                    'currency'       => $currency,
                    'verified'       => $verified,
                    'active_account' => $active_account,
                    'success'        => $success,
                    'ndb'            => $client_account['nodepositbonus'],
                    'thirty'         => $client_account['thirtypercentbonus'],
                    'fifty'          => $client_account['fiftypercentbonus'],
                    'mini'           => $client_account['mini_bonus_credit']
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($info));
            } else {
                show_404();
            }
    }

    public function restore_account(){

        if ($this->session->userdata('admin_manage')) {

            UserAccess::checkUserPermission("fina");
            $data['access'] = UserAccess::ManageAccessList();

            $data['type'] = 10;
            
            $this->template->title("Administration | Credit Mini Bonus Funds")
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
                ->build('manage-accounts/restore_account',$data);

        }else{
            setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
            redirect('signout/admin');
        }
    }

    public function restore_accounts_v2(){

        if (!$this->session->userdata('admin_manage') && !$this->input->is_ajax_request()) {  show_404();}

        $account_number = $this->input->post('account_number',true);

        $webservice_config = array('server' => 'live_new');
        $WebService2 = new WebService($webservice_config);
        $account_info2 = array(
            'iLogin' =>  $account_number
        );
        $WebService2->open_RequestAccountDetails($account_info2);

        if( $WebService2->request_status === 'RET_OK' ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 0 )));
        }else{

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' =>  $account_number
            );
            $account = $this->account_model->getAccountsByAccountNumber_minibonus( $account_number );
            $WebService->open_RestoreInactiveAccount($account_info);
            if( $WebService->request_status === 'RET_OK' ) {
                /*admin_log*/
                $this->load->model('Adminslogs_model');
                $arr = array(
                    'Restore_Inactive_Account' => 'restored',
                    'Manager_IP'=>$this->input->ip_address(),
                );

                //$page = 'manage-accounts/credit-mini-bonus';
                $page = FXPP::loc_url('credit-mini-bonus');
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


                $this->general_model->updatemy($table='mt_accounts_set',$field='account_number',$id=$account_number,$data=array('restored_inactive_account'=>1));
                $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 1 )));

            }else{
                /*admin_log*/
                $this->load->model('Adminslogs_model');
                $arr = array(
                    'Restore_Inactive_Account' => 'failed',
                    'Manager_IP'=>$this->input->ip_address(),
                );

                //$page = 'manage-accounts/credit-mini-bonus';
                $page = FXPP::loc_url('credit-mini-bonus');
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
                $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 2 )));

            }
        }

    }
}