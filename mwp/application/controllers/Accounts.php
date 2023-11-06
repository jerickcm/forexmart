<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller
{
    public function __construct()
    {
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

    public function index()
    {
        UserAccess::checkUserPermission("acc");
        $this->form_validation->set_rules('search', 'Search', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $index = $this->input->post('checkbox');
            $val = $this->input->post('search');
            $data['header'] = $index;
            $data['user_documents'] = $this->account_model->getSearchAccount($index, $val);
        } else {
            $data['user_documents'] = array('result' => false,
                'column' => array('Account Number', 'Full name', 'Country')
            );
            $data['header'] = array();
        }

        $tms = $this->session->userdata('sideLinkMenu');
        if(empty($tms)){
            $this->session->set_userdata('sideLinkMenu', 'sideLinkMenus');
        }
        else{
            $data['menu'] = "index";
        }
        $data['menu'] = "index";
//        print_r($data['menu']);exit;
        //$data['menu'] = "accordion-account";
        $data['active'] = "index";

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                <link rel='stylesheet' href='" . $css . "summernote.css'>
            ")
            ->append_metadata_js("
                <script src='" . $js . "summernote.js'></script>
                <script src='" . $js . "jquery.validate.js'></script>
                <script type='text/javascript'>
                    $(document).ready(function(){
                        $('#adm_mailer').addClass('active-sidenav');
                        $('#mailer').addClass('active-int-nav');
                    });
                </script>
            ")
            ->set_layout('mwp/main')
            ->build('accounts/search_account', $data);
    }

    function search_account()
    {
//        $this->index();
        UserAccess::checkUserPermission("acc");
        $this->form_validation->set_rules('search', 'Search', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $index = $this->input->post('checkbox');
            $val = $this->input->post('search');
            $data['header'] = $index;
            $data['user_documents'] = $this->account_model->getSearchAccount($index, $val);
        } else {
            $data['user_documents'] = array('result' => false,
                                            'column' => array('Account Number', 'Full name', 'Country')
            );
            $data['header'] = array();
        }

        $tms = $this->session->userdata('sideLinkMenu');
        if(empty($tms)){
            $this->session->set_userdata('sideLinkMenu', 'sideLinkMenus');
        }
        else{
            $data['menu'] = "accordion-account";
        }

        //$data['menu'] = "accordion-account";
        $data['active'] = "search-account";

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                <link rel='stylesheet' href='" . $css . "summernote.css'>
            ")
            ->append_metadata_js("
                <script src='" . $js . "summernote.js'></script>
                <script src='" . $js . "jquery.validate.js'></script>
                <script type='text/javascript'>
                    $(document).ready(function(){
                        $('#adm_mailer').addClass('active-sidenav');
                        $('#mailer').addClass('active-int-nav');
                    });
                </script>
            ")
            ->set_layout('mwp/main')
            ->build('accounts/search_account', $data);
    }

    function open_account(){
        UserAccess::checkUserPermission("openacc");
        $this->form_validation->set_rules('search', 'Search', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $index = $this->input->post('check');
            $val = $this->input->post('search');

            if (is_array($index)) {
                $data['index'] = $index;
                $data['open_account'] = $this->account_model->getOpenAccount($index, $val);

                if(count($data['open_account']['result'])==1){
                    $data['personal_log'] = $this->account_model->getHistoryLog($data['open_account']['result'][0]->account_number);
                }
            }
        } else {
            $data['open_account'] = array('result' => false,
                'column' => array('Account Number', 'Full name', 'Country')
            );
        }

        $data['active'] = "quick-jump";
        $data['li_active'] = "li_openacct";
        $data['fields'] = $this->getFields();

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/v2_main')
            ->build('accounts/v2_open_account', $data);
    }


    function check_phone_password()
    {

        UserAccess::checkUserPermission("acc");

        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_password', 'Phone password', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $this->load->model('Finance_model');

            $account_number = $this->input->post('account_number');
            $phone_password = $this->input->post('phone_password');
            $isExisting1 = $this->Finance_model->showssingle('partnership','reference_num',$account_number,'*','');
            $isExisting2 = $this->Finance_model->showssingle('partnership','reference_subnum',$account_number,'*','');
            $isExisting3 = $this->Finance_model->showssingle('mt_accounts_set','account_number',$account_number,'*','');
            if($isExisting1 >0 || $isExisting2 >0 || $isExisting3 >0){
                $data['flag'] = false;
                if ($this->account_model->getPhonePassword($account_number, $phone_password)) {
                    $data['result'] = "pp_match";
                    $data['flag'] = true;
                } else {
                    // $data['result'] = "Invalid Phone Password.";
                    $data['result'] = "ph_err";
                }
            }else{
                // $data['result'] = "Account no. does not exist.";
                $data['result'] = "acc_err";
            }



        } else {
            $data['user_documents'] = false;
        }

        $data['menu'] = "accordion-account";
        $data['active'] = "check-phone-password";

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/check_phone_password', $data);
    }


    function incomplete_accounts()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        UserAccess::checkUserPermission("acc");


        $data['menu'] = "accordion-account";
        $data['active'] = "incompleted_accounts";

        $user_id = $this->session->userdata('user_id');
        //  $data['inc_reg'] = $this->general_model->showmy("incomplete_registers");
        // $data['inc_reg'] = $this->account_model->getIncRegistrationClients();

        //$data['inc_reg'] = $this->account_model->incompleteRegistration();

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/incompleteRegistration', $data);
    }

    function incomplete_accounts_data(){
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['menu'] = "accordion-account";
        $data['active'] = "incompleted_accounts";
        $user_id = $this->session->userdata('user_id');
        //$data['inc_reg'] = $this->account_model->incompleteRegistration();

        $draw = (int)$this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $data_accounts = $this->account_model->incompleteRegistration1(trim($search['value']));
        $row_accounts = $this->account_model->incompleteRegistration2($length, $start, trim($search['value']));
        $accounts = array();

        //print_r($start.$length);
        //print_r($data_accounts); exit;
        //print_r($row_accounts); exit;
        
        foreach ($row_accounts as $key => $value) {
            $accounts[] = array(
                $value['email'],
                $value['full_name'],
                $value['created'],
                $value['account_number'],
            );
        }

        $recordsTotal = count($data_accounts);
        $recordsFiltered = count($data_accounts);
        $data = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $accounts
        );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function balance_transaction()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        UserAccess::checkUserPermission("acc");


        $data['menu'] = "accordion-account";
        $data['active'] = "balance_transactions";

        $user_id = $this->session->userdata('user_id');

        $data['bal_tran'] = $this->account_model->balanceTransaction();
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = "balance";
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                ")
            ->append_metadata_js("
                <script src='".$js."jquery.validate.js'></script>
                <script src='".$js."jquery.dataTables.js'></script>
                <script src='".$js."Moment.js'></script>
                <script src='".$js."bootstrap-datetimepicker.min.js'></script>
                <script src='".$js."dataTables.bootstrap.min.js'></script>
                <script src='".$js."bootstrap-datepicker.min.js'></script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/balanceTransaction', $data);
    }

    public function get_balanceTransaction(){
      //if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $this->load->library('WebService');


        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        $from = date('Y-m-d\T00:00:00', strtotime($this->input->post('from')));
        $to = date('Y-m-d\T23:59:59', strtotime($this->input->post('to')));

        $data['none'] = date('Y-m-d\T00:00:00', strtotime("2015/5/5"));

        $account_info = 
        array(
          'from' =>  $from=$this->input->post('from') !=''? $from:$data['none'] ,
          'to' => $to=$this->input->post('to') !=''? $to:$data['none']
          );

        $invalid = $to < $from;

  
        if($invalid){
            $data['success']='false';
            $data['msg']= "There are no data yet.";
        }

        else{
          $WebService->RequestAllFinanceRecordsByDate($account_info);

            if ($WebService->request_status === 'RET_OK') {
                $data['success']='true';
                $data['result'] = $WebService->get_all_result();
                
                $data['result1']= $data['result']['FinanceRecords']->FinanceRecordData;

                //print_r($data['result']['FinanceRecords']->FinanceRecordData);
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
                  // $data['tr'].='<tr>';

                  // $data['tr'].='<td>' .$key->Stamp;
                  // $data['tr'].='</td>';

                  // $data['tr'].='<td>' .$key->Comment;
                  // $data['tr'].='</td>';

                  // $data['tr'].='<td>' .$key->Status;
                  // $data['tr'].='</td>';

                  // $data['tr'].='<td>'.$key->AccountNumber;
                  // $data['tr'].='</td>';

                  // $data['tr'].='<td>' .$key->AccountReceiver;
                  // $data['tr'].='</td>';

                  // $data['tr'].='<td>' .$key->Amount;
                  // $data['tr'].='</td>';

                  // $data['tr'].='<td>' .$key->Ticket;
                  // $data['tr'].='</td>';

                  // $data['tr'].='</tr>';
                 }
            }
        }
            echo json_encode($data);
    }


    public function findOrders()
    {

        UserAccess::checkUserPermission("ord");

        $this->form_validation->set_rules('order_ticket', 'Ticket Number', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {

            $order_ticket = $this->input->post('order_ticket');

            $this->load->library('WebService');
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $data['accountDetils'] = "";

            $account_info = array('mt_ticket' => $order_ticket);
            $WebService->GetFinanceRecordOfTicket($account_info);

           if(IPLoc::Office()){
               $WebService->GetTicketsAccount($account_info);
               if ($WebService->request_status === 'RET_OK') {
                   $data['ticket'] = $order_ticket;
                   $a = (array)$WebService->get_all_result();
                   $data['ticketget'] = $a['LogIn'];
                   $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");
                   $to = DateTime::createFromFormat('Y/d/m H:i:s',  date('Y/d/m').'23:59:59');

                   if($a['LogIn']!='' || $a['LogIn']!= null){

                       $account_infoArray = array(
                           'iLogin' => $a['LogIn'],
                           'from' => $from->format('Y-m-d\TH:i:s') ,
                           'to' => $to->format('Y-m-d\TH:i:s'),
                       );
                       $WebServiceGetAccounts = new WebService($webservice_config);
                       $WebServiceGetAccounts->open_GetAccountTradesHistory($account_infoArray);
                       if($WebServiceGetAccounts->request_status === 'RET_OK'){
                           $data['acct'] = true;
                           //  $data['acctinfo'] = (array)$WebServiceGetAccounts->get_all_result('TradeDataList');
                           $abc = (array)$WebServiceGetAccounts->get_all_result('TradeDataList')['TradeDataList']->TradeData;
                           for($i=0; $i<count($abc); $i++){
                               if($abc[$i]->OrderTicket ==$order_ticket){
                                   $data['traninfo1'] = $abc[$i]->OpenTIme;
                                   $data['traninfo2'] = $abc[$i]->TradeType;
                                   $data['traninfo3'] = $abc[$i]->Symbol;
                                   $data['traninfo4'] = $abc[$i]->Volume;
                                   $data['traninfo5'] = $abc[$i]->OpenPrice;
                                   $data['traninfo6'] = $abc[$i]->StopLoss;
                                   $data['traninfo7'] = $abc[$i]->TakeProfit;
                                   $data['traninfo8'] = $abc[$i]->CloseTime;
                                   $data['traninfo9'] = $abc[$i]->ClosePrice;
                                   $data['traninfo10'] = $abc[$i]->Comment;
                                   $data['traninfo11'] = $abc[$i]->Profit;
                                   $data['traninfo12'] = $abc[$i]->OrderTicket;
                                   $data['traninfo13'] = $abc[$i]->LogIn;
                               }
                           }
                       }else{
                           $data['acct'] = false;
                       }

                   }else{
                       $data['acct'] = false;
                   }

               }else{
                   $data['ticketget'] = '';
               }
           }
        } else {
            $data['order_ticket'] = array();
            $data['result'] = "";
        }

        $data['access'] = UserAccess::ManageAccessList();

        $data['menu'] = "accordion-orders";
        $data['active'] = "find-orders";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/find_orders', $data);

    }


// show order list
    public function findOrderList()
    {
        UserAccess::checkUserPermission("ord");


        $this->form_validation->set_rules('order_ticket', 'Ticket Number', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {

            $order_ticket = $this->input->post('order_ticket');
//           $data['order_ticket'] = $this->account_model->getInfromUseTricket($order_ticket);
//           //print_r($data['order_ticket']);exit;
//           $data['result']="Data not found";

            $this->load->library('WebService');
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $data['accountDetils'] = "";

            $account_info = array('mt_ticket' => $order_ticket);
            $WebService->GetFinanceRecordOfTicket($account_info);

            switch ($WebService->request_status) {
                case 'RET_OK':
                    $financeData = (array)$WebService->get_all_result();
                    break;
                default:
                    $data['data']['error'] = true;
            }

            // accoutns details
            $account_infoArray = array('iLogin' => $financeData['AccountNumber']);
            $WebServiceGetAccounts = new WebService($webservice_config);
            $WebServiceGetAccounts->request_account_details($account_infoArray);
            switch ($WebServiceGetAccounts->request_status) {
                case 'RET_OK':
                    $totalAccountDetials = (array)$WebServiceGetAccounts->get_all_result();

                    if (!empty($totalAccountDetials)) {
                        $accountDetils = $totalAccountDetials;
                    }
                    break;
                default:
                    $data['data']['error'] = true;
            }

            $accountDetils['AccountNumber'] = $financeData['AccountNumber'];
            $accountDetils['Amount'] = $financeData['Amount'];
            $accountDetils['Ticket'] = $financeData['Ticket'];
            $data['order_ticket'] = $accountDetils;
            $data['result'] = "Data not found";

        } else {
            $data['order_ticket'] = array();
            $data['result'] = "";
        }


        $data['access'] = UserAccess::ManageAccessList();


        $data['menu'] = "accordion-orders";
        $data['active'] = "orders-list";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/find_order_list', $data);


    }


    public function findOrderListEdit()
    {


        UserAccess::checkUserPermission("ord");


        $this->form_validation->set_rules('Name', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('PhoneNumber', 'Pnone Number', 'trim|xss_clean');
        $this->form_validation->set_rules('State', 'State', 'trim|required|xss_clean');
        $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ZipCode', 'Zip', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');

        $this->load->library('WebService');
        $webservice_config = array('server' => 'live_new');
        $data['result'] = "";
        if ($this->form_validation->run()) {

            $account_info = array(
                'City' => $this->input->post('City'),
                'Comment' => $this->input->post('Comment'),
                'Country' => $this->input->post('Country'),
                'Email' => $this->input->post('Email'),
                'Name' => $this->input->post('Name'),
                'PhoneNumber' => $this->input->post('PhoneNumber'),
                'State' => $this->input->post('State'),
                'StreetAddress' => $this->input->post('Address'),
                'AccountNumber' => $this->input->post('AccountNumber'),
                'ZipCode' => $this->input->post('ZipCode')
            );


            $whereData = array('account_number' => $account_info['AccountNumber']);
            $userMt = $this->g_m->getQueryStringRow('mt_accounts_set', '*', $whereData);
            $user_id = $userMt->user_id;
            $manager_id = $this->session->userdata('user_id');
            $date_modified = FXPP::getCurrentDateTime();

            $WebService = new WebService($webservice_config);
            $WebService->update_live_account_details($account_info);


            if ($WebService->request_status === 'RET_OK') {
                //add Account Update History
                $update_history_data = array(
                    'user_id' => $user_id,
                    'manager_id' => $manager_id,
                    'date_modified' => date('Y-m-d H:i:s', strtotime($date_modified))
                );
                $update_history_id = $this->account_model->insertAccountUpdateHistory($update_history_data);


                $contructTable = array(
                    'email1' => $account_info['Email'],
                    'phone1' => $account_info['PhoneNumber'],
                );

                $cdata = array('user_id' => $user_id);
                $condata = $this->account_model->getQueryStirng("contacts", "*", $cdata);
                if (!empty($condata)) {
                    $this->g_m->update('contacts', 'user_id', $user_id, $contructTable);
                } else {
                    $contructTable['user_id'] = $user_id;
                    $this->g_m->insert('contacts', $contructTable);
                }

                //update user profile info
                $user_profile_data = array(
                    'full_name' => $account_info['Name'],
                    'country' => $account_info['Country'],
                    'state' => $account_info['State'],
                    'zip' => $account_info['ZipCode'],
                    'city' => $account_info['City']
                );
                $this->g_m->update('user_profiles', 'user_id', $user_id, $user_profile_data);
                $data['result'] = "Update Successful";
            }


        }
//else
//{


        //$mt_ticket= $this->input->get('id');
        // $data['order_ticket'] = $this->account_model->getInfromUseTricket($mt_ticket);


        // accoutns details
        $gid = $this->input->get('id');
        $getId = explode("_", $gid);
        $AccountNumber = $getId[0];
        $Ticket = $getId[1];
        $account_infoArray = array('iLogin' => $AccountNumber);
        $WebServiceGetAccounts = new WebService($webservice_config);
        $WebServiceGetAccounts->request_account_details($account_infoArray);
        switch ($WebServiceGetAccounts->request_status) {
            case 'RET_OK':
                $totalAccountDetials = (array)$WebServiceGetAccounts->get_all_result();

                if (!empty($totalAccountDetials)) {
                    $accountDetils = $totalAccountDetials;
                }
                break;
            default:
                $data['data']['error'] = true;
        }

        $accountDetils['Ticket'] = $Ticket;
        $data['order_ticket'] = $accountDetils;


        if (empty($data['order_ticket'])) {
            redirect('orders-list');
            exit;
        }
//}


        $data['access'] = UserAccess::ManageAccessList();

        $data['menu'] = "accordion-orders";
        $data['active'] = "orders-list";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/edit_orders', $data);


    }


//format('Y-m-d\TH:i:s')

    public function financeDepositWithdraw()
    {


        $logUserId = $this->session->userdata('user_id');
        $gdata = array('user_id' => '69402');
        $accData = $this->General_model->getQueryStirngRow("mt_accounts_set", "*", $gdata);
        $user_info = $this->General_model->getQueryStirngRow("user_profiles", "*", $gdata);


        $account_info = array(
            'iLogin' => $accData->account_number
        );
        $webservice_config = array('server' => 'live_new');

// accoutns details
        $WebServiceGetBalance = new WebService($webservice_config);
        $WebServiceGetBalance->request_live_account_balance($account_info);
        switch ($WebServiceGetBalance->request_status) {
            case 'RET_OK':
                $totalAccountBlance = (array)$WebServiceGetBalance->get_all_result();

                if (!empty($totalAccountBlance)) {

                    $accountBalance = $totalAccountBlance;
                }
                break;
            default:
                $data['data']['error'] = true;
        }
        $accountBalance['account_number'] = $accData->account_number;
        $accountBalance['full_name'] = $user_info->full_name;
        $data['accountDetails'] = $accountBalance;


        UserAccess::checkUserPermission("fina");
        $data['access'] = UserAccess::ManageAccessList();

        $data['menu'] = "accordion-finance";
        $data['active'] = "finance-deposit-withdraw";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Forexmart | Deposit Withdrawal")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>

                ")
            ->append_metadata_js("
                      <script src='" . $js . "summernote.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('accounts/finance_deposit_withdraw', $data);


    }


    public function getDepositWithdrawlSlado()
    {

        $start_date = $this->input->post("start_date");
        $start_end = $this->input->post("start_end");
        $data['ccss'] = 'hidediv';
        if ($start_date) {
            $amountDepo = $this->getTotalDepositsWithdrawls($start_date, $start_end, 1);
            $amountwithd = $this->getTotalDepositsWithdrawls($start_date, $start_end, 2);
            $amountSald = $this->getTotalDepositsWithdrawls($start_date, $start_end, 3);
            $dwsdata = "";
            $uiu = 0;
            foreach ($amountSald as $key) {
                $dwsdata[$uiu]['payment_date'] = $key['payment_date'];
                $dcheck = $this->findDateWiseArrayValueGet($amountDepo, 'payment_date', $key['payment_date'], 'depositAmount');
                $wcheck = $this->findDateWiseArrayValueGet($amountwithd, 'payment_date', $key['payment_date'], 'withdrawAmount');

                $dwsdata[$uiu]['depositAmount'] = ($dcheck != false) ? $dcheck : 0;
                $dwsdata[$uiu]['withdrawAmount'] = ($wcheck != false) ? $wcheck : 0;
                $dwsdata[$uiu]['sladow'] = $key['sladow'];
                $uiu++;
            }
            $data['data'] = $dwsdata;
            $data['ccss'] = '';
        }


    }


    public function getTotalDepositsWithdrawls($startDate, $EndDate, $return)
    {


        $account_info = array(
            'from' => $startDate,
            'to' => $EndDate
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        // Deposit Method
        $WebService->GetTotalDailyDeposits($account_info);
        switch ($WebService->request_status) {
            case 'RET_OK':
                $totalDeposit = (array)$WebService->get_result('WithdrawalsDepositsList');

                if (!empty($totalDeposit['TotalDepositWithdrawData'])) {
                    $apideposit = $totalDeposit['TotalDepositWithdrawData'];
                }

                break;
            default:
                $data['data']['error'] = true;
        }

        // Withdrawals Method
        $WebService->GetTotalDailyWithdrawals($account_info);
        switch ($WebService->request_status) {
            case 'RET_OK':
                $totalWithdraw = (array)$WebService->get_result('WithdrawalsDepositsList');

                if (!empty($totalWithdraw['TotalDepositWithdrawData'])) {
                    $apiwithdrawls = $totalWithdraw['TotalDepositWithdrawData'];
                }

                break;
            default:
                $data['data']['error'] = true;
        }

        $DepositData = "";
        $i = 0;
        $extraDepositArray = "";
        foreach ($apideposit as $key) {
            $dateT = explode("T", $key->Stamp);
            $DepositData[$i]['payment_date'] = $dateT[0];
            $DepositData[$i]['depositAmount'] = $key->Total;
            $extraDepositArray[$dateT[0]] = $key->Total;
            $i++;
        }

        $WithdrawData = "";
        $j = 0;
        $extraWithdrawArray = "";
        foreach ($apiwithdrawls as $key) {
            $dateT = explode("T", $key->Stamp);
            $WithdrawData[$j]['payment_date'] = $dateT[0];
            $WithdrawData[$j]['withdrawAmount'] = str_replace("-", "", $key->Total);
            $extraWithdrawArray[$dateT[0]] = str_replace("-", "", $key->Total);
            $j++;
        }


        $Saldo = "";
        $k = 0;
        foreach ($DepositData as $tkey) {

            //str_ireplace
            $check = $this->checkArrayValue($WithdrawData, $tkey['payment_date']);
            $Saldo[$k]['payment_date'] = $tkey['payment_date'];
            if ($check != false) {
                $newVal = $tkey['depositAmount'] - $check;
                $Saldo[$k]['sladow'] = $newVal;
            } else {
                $Saldo[$k]['sladow'] = $tkey['depositAmount'];
            }


            $k++;
        }

        // Extra withdraw key geta and saldo set
        $result = array_diff_key($extraWithdrawArray, $extraDepositArray);
        $v = sizeof($Saldo);
        foreach ($result as $key => $val) {
            $Saldo[$v]['payment_date'] = $key;
            $Saldo[$k]['sladow'] = $val;

            $v++;
        }

        uasort($Saldo, array($this, 'sortByDate'));
        $Saldo = array_values($Saldo);

        if ($return == 1) {
            return $DepositData;
        }
        if ($return == 2) {
            return $WithdrawData;
        }
        if ($return == 3) {
            return $Saldo;
        }


    }


    function findDateWiseArrayValueGet($arry, $findKey, $findVal, $returnKey)
    {
        $return = false;
        foreach ($arry as $key) {
            if ($key[$findKey] == $findVal) {
                $return = $key[$returnKey];

            }
        }
        return $return;
    }


    function sortByDate($a, $b)
    {
        $d1 = strtotime($a['payment_date']);
        $d2 = strtotime($b['payment_date']);
        return $d1 == $d2 ? 0 : ($d1 > $d2 ? 1 : -1);
    }


    function  checkArrayValue($WithdrawData, $date)
    {
        $return = false;
        foreach ($WithdrawData as $key) {
            if ($key['payment_date'] == $date) {
                $return = $key['withdrawAmount'];

            }
        }
        return $return;
    }

    function getFields()
    {
        return $data = array(
            'group' => "Group",
            'full_name' => "Name",
            'city' => "City",
            'state' => "State",
            'street' => 'Address',
            'email' => "Email",
            'mt_comment' => "Comment",
            'leverage' => "Laverage",
            'zip' => "Zip code",
            'country' => "Country",
            'account_number' => "Account Number",
            'mt_status' => "Status",
            'phone1' => "Phone"
        );
    }


    public function filterManager()
    {
        $status = $this->input->post('statusActivied');
        $this->ManageAccess($status);

    }

    public function manageAccess($status = NULL)
    {
        UserAccess::checkUserPermission("mana");
        $data['filter'] = 2;
        if($status == 3){
            $data['data'] = $this->general_model->showsfields('mwp_deletedlogs','*');
            $data['filter'] = $status;
        }else if ($status == 1 or $status == 0 and $status != "") {
            $data['data'] = $this->general_model->getAdministratorListWhere($status, 3, 3);
            $data['filter'] = $status;
        } else {
            $data['data'] = $this->general_model->getAdministratorList(3, 3);
        }
        $data['access'] = UserAccess::ManageAccessList();
        $data['menu'] = "manage-access";
        $data['active'] = "manage-access";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('accounts/manage_access', $data);
    }

    private function autoPassword($nc, $a = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
    {
        $l = strlen($a) - 1;
        $r = '';
        while ($nc-- > 0) $r .= $a{mt_rand(0, $l)};
        return $r;
    }

    public function ManagerAdd()
    {
        $email = $this->input->post('email');
        $whereData = array('email' => $email, 'type' => 3, 'admin' => 3);
        $finalCheck = "";
        $data = $this->general_model->getDataQueryString('manage_access', '*', $whereData, "id", "DESC", "1");
        if (!empty($data)) {
            redirect('manage-access');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean');

        $checkPass = $this->input->post('auto_generate');
        if ($checkPass == 1 or $checkPass == "None" and $checkPass != "") {
        } else {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('rePassword', 'Re-Password', 'required|matches[password]');
        }

        if ($this->form_validation->run()) {
            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');

            $login_type = 0; //login_type 0 = client user / 1 = partner user
            $use_username = $this->config->item('use_username', 'tank_auth');
            $email_activation = $this->config->item('email_activation', 'tank_auth');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $autoGe = $this->input->post('auto_generate');

            $permission = $this->input->post('permission');

            if ($permission != "" or !empty($permission)) {
                $perlist = "";
                $i = 0;
                foreach ($permission as $key) {
                    if ($i < 1) {
                        $perlist = $key;
                    } else {
                        $perlist = $perlist . "," . $key;
                    }
                    $i++;
                }

                $permission = $perlist;
            }
            if ($autoGe == 1 or $autoGe == "None" and $autoGe != "") {
                $password = $this->autoPassword(8);
            }
            $data = $this->tank_auth->create_user($use_username ? $this->form_validation->set_value('username') : '', $email, $password, $email_activation, 1, $login_type, FALSE);
            $user_country = FXPP::getUserCountryCode();
            $profile = array(
                'full_name' => $this->input->post('name'),
                'user_id' => $data['user_id'],
                'country' => $user_country

            );
            $this->general_model->insert('user_profiles', $profile);
            $access = array(
                'permission' => $permission,
                'user_id' => $data['user_id'],
                'email' => $email,
                'status' => 1,
                'type' => 3,
                'admin' => 3

            );
            $this->general_model->insert('manage_access', $access);
            $adminPower = 1;
            $user = array('administration' => $adminPower, 'activated' => 1);
            $this->general_model->update('users', 'id', $data['user_id'], $user);


            $email_data = array(
                'full_name' => $this->input->post('name'),
                'email' => $email,
                'user_id' => $email,
                'password' => $password,
                'header' => 'ForexMart Mwp account details',
                'title' => 'An account has been created for you to be able to access ForexMart Mwp Admin Panel.'
            );
            $config = array('mailtype' => 'html');

            $this->general_model->sendEmail('manage_access-html', "ForexMart Team", $email_data['email'], $email_data, $config);
            $this->load->model('Adminslogs_model');
            $arr=array( 'process' => 'Add Manager Permission', 'status' => 'Added', 'Manager_IP'=>$this->input->ip_address(), 'permission'=> $permission,'email'=>$email,'name'=> $this->input->post('name'));
            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => 'MWP/manage-access',
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$email.' - '.$this->input->post('name'),
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $email,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );
            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
            $data['success'] = 'User successfully added.';
        }
        $data['filter'] = 2;
        $data['data'] = $this->general_model->getAdministratorList(3, 3);
        $data['access'] = UserAccess::ManageAccessList();
        $data['menu'] = "manage-access";
        $data['active'] = "manage-access";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('accounts/manage_access', $data);
    }


    public function chekcAreadyEmail()
    {
        $email = $this->input->post('email');

        $whereData = array('email' => $email, 'type' => 3, 'admin' => 3);
        $finalCheck = "";
        $data = $this->general_model->getDataQueryString('manage_access', '*', $whereData, "id", "DESC", "1");
        if (!empty($data)) {
            $finalCheck = "already Done";
        }

        echo $finalCheck;
    }


    public function ManagerAccessUpdate()
    {


        $manage_in_userid = $this->input->post('manage_in_userid');
        $permission = $this->input->post('permission');

        if ($permission != "" or !empty($permission)) {
            $perlist = "";
            $i = 0;
            foreach ($permission as $key) {
                if ($i < 1) {
                    $perlist = $key;
                } else {
                    $perlist = $perlist . "," . $key;
                }
                $i++;
            }

            $permission = $perlist;
        }

        $data = array('permission' => $permission);
        //echo "<pre>";print_r($data);exit;
        $this->general_model->updatet1w3('manage_access', 'user_id', $manage_in_userid, 'type', 3, 'admin', 3, $data);
        $this->load->model('Adminslogs_model');
        $dbInfo = $this->account_model->getshow($manage_in_userid);
        $data['success'] = 'User permission successfully updated.';
        $arr=array( 'process' => 'Update Manager Permission', 'status' => 'Updated', 'Manager_IP'=>$this->input->ip_address(), 'permission'=> $permission , 'email'=>$dbInfo[0]['email']);
        $data['log']=array(
            'users_id'=>$_SESSION['user_id'],
            'page' => 'MWP/manage-access',
            'date_processed'=> FXPP::getCurrentDateTime(),
            'processed_users_id'=>$manage_in_userid,
            'data'=> json_encode($arr),
            'processed_users_id_accountnumber' => $dbInfo['email'],
            'comment'=>'',
            'admin_fullname'=>$_SESSION['full_name'],
            'admin_email'=>$_SESSION['email'],
        );
        $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
        $data['filter'] = 2;
        $data['data'] = $this->general_model->getAdministratorList(3, 3);
        $data['access'] = UserAccess::ManageAccessList();
        $data['menu'] = "manage-access";
        $data['active'] = "manage-access";
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('accounts/manage_access', $data);
    }


    public function AdminMangeDelete()
    {

        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }
        $user_id = $this->input->post('user_id');
        $user_info = $this->general_model->getuserinfo($user_id)['rows'];
        $data['insert'] = array(
            'email'=>$user_info[0]->email,
            'name'=>$user_info[0]->full_name,
            'permission'=>$user_info[0]->permission,
            'date_deleted'=>date("Y-m-d h:i:s"),
            'deleted_by'=>$this->session->userdata('user_id'),
            'user_id'=>$user_id
        );
        $this->General_model->insertup('mwp_deletedlogs', $data['insert']);

        $whereData = array('user_id' => $user_id, 'type' => 3, 'admin' => 3);
        $this->general_model->deleteQueryString('manage_access', $whereData);
        $this->load->model('Adminslogs_model');
        $dbInfo = $this->account_model->getshow($user_id);
        $arr=array( 'process' => 'Delete Manager', 'status' => 'Deleted', 'Manager_IP'=>$this->input->ip_address(), 'permission'=> $user_info[0]->permission,'email'=> $user_info[0]->email,'name'=>$user_info[0]->full_name);
        $data['log']=array(
            'users_id'=>$_SESSION['user_id'],
            'page' => 'MWP/manage-access',
            'date_processed'=> FXPP::getCurrentDateTime(),
            'processed_users_id'=>$user_id,
            'data'=> json_encode($arr),
            'processed_users_id_accountnumber' => $user_info[0]->email,
            'comment'=>'',
            'admin_fullname'=>$_SESSION['full_name'],
            'admin_email'=>$_SESSION['email'],
        );
        $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
        $data = array('administration' => '0');
        echo $d = $this->general_model->updatemy('users', 'id', $user_id, $data);


    }

    public function ManagerActiveDeactive()
    {


        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }


        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');


        $data = array('activated' => $status);
        $this->general_model->update('users', 'id', $user_id, $data);
    }

    public function ManagerEdit()
    {


        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');


            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $user_id = $this->input->post('manage_in_userid');
            $autoGe = $this->input->post('toggleData');
            $newpass = $this->input->post('newpass');
            $password = "";
            if ($autoGe == 1) {
                $password = ($newpass != 0) ? $newpass : '';
            }

            $permission = $this->input->post('permission');
            if ($permission != "" or !empty($permission)) {
                $perlist = "";
                $i = 0;
                foreach ($permission as $key) {
                    if ($i < 1) {
                        $perlist = $key;
                    } else {
                        $perlist = $perlist . "," . $key;
                    }
                    $i++;
                }

                $permission = $perlist;
            }

            $user = array('email' => $email);
            $this->general_model->update('users', 'id', $user_id, $user);

            $userpro = array('full_name' => $name);
            $this->general_model->update('user_profiles', 'user_id', $user_id, $userpro);

            $userpermi = array('permission' => $permission);
            $this->general_model->updatet1w3('manage_access', 'user_id', $user_id, 'type', 3, 'admin', 3, $userpermi);
            $data['success'] = 'User access and permission successfully updated.';

            $this->load->model('Adminslogs_model');
            $arr=array( 'process' => 'Edit Manager Permission', 'status' => 'Edited', 'Manager_IP'=>$this->input->ip_address(), 'permission'=> $permission,'email'=>$email,'name'=>$name );
            $data['log']=array(
                'users_id'=>$_SESSION['user_id'],
                'page' => 'MWP/manage-access',
                'date_processed'=> FXPP::getCurrentDateTime(),
                'processed_users_id'=>$user_id,
                'data'=> json_encode($arr),
                'processed_users_id_accountnumber' => $email,
                'comment'=>'',
                'admin_fullname'=>$_SESSION['full_name'],
                'admin_email'=>$_SESSION['email'],
            );
            $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
        }
        $data['filter'] = 2;
        $data['data'] = $this->general_model->getAdministratorList(3, 3);
        $data['access'] = UserAccess::ManageAccessList();
        $data['menu'] = "manage-access";
        $data['active'] = "manage-access";

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('accounts/manage_access', $data);
    }


    public function resetPasswoard()
    {

        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }


        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');

        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $user_id = $this->input->post('manage_in_userid');
        $autoGe = $this->input->post('toggleData');

        $password = $this->autoPassword(8);


        $check == false;

        if ($password != "") {
            $check = $password;
            $this->ci =& get_instance();
            $this->ci->load->config('tank_auth', TRUE);
            $this->load->model('tank_auth/Users');

            // Hash password using phpass
            $hasher = new PasswordHash(
                $this->ci->config->item('phpass_hash_strength', 'tank_auth'),
                $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
            $hashed_password = $hasher->HashPassword($password);

            $this->users->reset_passwordNokey($user_id, $hashed_password, $expire_period = 900);


            $email_data = array(
                'full_name' => $name,
                'email' => $email,
                'user_id' => $email,
                'password' => $password,
                'header' => 'ForexMart Mwp account details',
                'title' => 'You have requested to reset your password for ForexMart Mwp Admin Panel. Please see the details below.'
            );
            $config = array('mailtype' => 'html');
            $this->general_model->sendEmail('manage_access-html', "ForexMart Mwp Admin Panel", $email, $email_data, $config);
        }
        $user = array('email' => $email);
        $this->general_model->update('users', 'id', $user_id, $user);

        echo $check;

    }


    public function referralsfor2($entry = 10){
        $page = $_GET['page'] ? $_GET['page'] : 0;
        $per_page = $entry;
        $result = $this->accounts_model->show_manage_referrals12($per_page,$page);
        $total_rows = $result['count'];
        $base_url = $entry > 10 ? 'manage-referrals/index/'. $entry : 'manage-referrals';

        $config['base_url'] = base_url() . $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $data['manage_referrals'] = $result['result'];
        $data['links'] = $this->pagination->create_links();
        $data['entries'] = $entry > 10 ? $entry : '';
        $data['total'] = $total_rows;
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='" . $css . "summernote.css'>
                ")
            ->append_metadata_js("  ")
            ->set_layout('mwp/v2_main')
            ->build('accounts/referrals', $data);
    }
    public function search($type,$account_number, $per_page) {
        $page = $_GET['page'] ? $_GET['page'] : 0;
        $account_number = urldecode($account_number);

        switch ($type) {
            case 'client':
                $result = $this->manage_accounts_model->show_manage_referral_by_client_account($per_page,$page,$account_number);
                break;
            case 'partner':
                $result = $this->manage_accounts_model->show_manage_referral_by_partner_account($per_page,$page,$account_number);
                break;
            case 'affiliate-code':
                $result = $this->manage_accounts_model->show_manage_referral_by_affiliate_code($per_page,$page,$account_number);
                break;
            case 'type':
                $result = $this->manage_accounts_model->show_manage_referral_by_partner_type($per_page,$page,$account_number);
                break;
            case 'all':
                $this->index();
                break;
        }
        $total_rows = $result['count'];

        $config['base_url'] = base_url() . 'manage-referrals/search/'. $type .'/'. $account_number .'/'. $per_page;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $data['manage_referrals'] = $result['result'];
        $data['links'] = $this->pagination->create_links();

        $data['entries'] = $per_page >= 10 ? $per_page : '';
        $data['account_number'] = $account_number;
        $data['search_by'] = $type;

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("  ")
            ->append_metadata_js(" ")
            ->set_layout('mwp/v2_main')
            ->build('accounts/referrals', $data);
    }
    public function profileView(){

        $account_number = $this->input->post('account_number');

        if(strlen($account_number)>5){

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
            switch($WebService->request_status){
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
                    $data['currency_base'] = $current_account_data['mt_currency_base'];
                    $data['mt_account_set_id'] =  $this->general_model->getAccountType($current_account_data['mt_account_set_id']);


                    break;
                default:
                    $data['msg']= "There are no data yet.";
            }



            $this->load->view('accounts/profile_modal',$data);


        }else{
            redirect('accounts');
        }
    }

    public function get_profileInfo(){
         $ac = $this->input->post('account_no');

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
            switch($WebService->request_status){
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
                    $data['error'] = '0';

                    break;
                default:
                    $data['msg']= "Account number incorrect.";
                    $data['error'] = '1';
            }

            $WebService->open_RequestAccountBalance($account_info);

            switch($WebService->request_status){
                case 'RET_OK':

                    $data['Balance'] = $WebService->get_result('Balance');
                    $data['error'] = '0';
                    break;
                default:
                    $data['msg']= "Account number incorrect.";
                    $data['error'] = '1';
            }

            $data['access']= UserAccess::ManageAccessList();
            echo json_encode($data);
    }

    //     public function update_accounts(){ //for Incomplete Registration
    //         $draw = (int)$this->input->post('draw');
    //         $start = $this->input->post('start');
    //         $length = $this->input->post('length');
    //         $search = $this->input->post('search');

    //         $data['inc_reg'] = $this->account_model->incompleteRegistration();
    //         $data_accounts = $this->account_model->getAccountsByType($type, trim($search['value']));
    //         $row_accounts = $this->account_model->getLimitAccountsByType($type, $length, $start, trim($search['value']));
    //         $accounts = array();
    //         $account_types = $this->general_model->getAccountType();
    //         foreach ($row_accounts as $key => $value) {
    //             $date_registered = strtotime($value['registration_time']) ? date('m/d/Y H:i:s', strtotime($value['registration_time'])) : '';
    //             $account_type = array_key_exists($value['mt_account_set_id'], $account_types) ? $account_types[$value['mt_account_set_id']] : '';
    //                 $accounts[] = array(
    //                     $value['account_number'],
    //                     $value['full_name'],
    //                     $date_registered,
    //                     $account_type,
    //                     $value['mt_currency_base'],
    //                     $value['fb'],
    //                     ((!isset($value['mt_status']) || trim($value['mt_status']) === '')) ? "Read only" : "Verified",
    //                     '<a href="javascript:void(0)" id="account_edit" data-id="' . $value['id'] . '" class="open-edit" >Manage</i></a> | <a href="javascript:void(0)" id="account_update_history" data-id="' . $value['user_id'] . '" class="open-update-history" >Update History</i></a>'
    //                 );
    //         }
    //         $recordsTotal = count($data_accounts);
    //         $recordsFiltered = count($data_accounts);
    //         $data = array(
    //             'draw' => $draw,
    //             'recordsTotal' => $recordsTotal,
    //             'recordsFiltered' => $recordsFiltered,
    //             'data' => $accounts
    //         );
    //         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    // }
}