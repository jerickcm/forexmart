<?php

class Calculate_saldo extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('General_model');
        $this->load->library('WebService');
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
//        $this->load->model('account_model');
//        $this->load->model('Mailer_model');
//        $this->load->library('tank_auth');
//        $this->lang->load('tank_auth');
//        $this->load->library('Fx_mailer');
        $this->g_m=$this->General_model;
//        $this->flag = 1;
    }

    function index(){
        if($this->session->userdata('admin_manage')){
            $data['nav'] = 0;
            UserAccess::checkUserPermission("tinfo");
            $data['access']= UserAccess::ManageAccessList();

            $this->template->title("Administration | Manage Contest")
                ->append_metadata_css("
                        <link type='text/css' rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                        <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css'>
                        <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css.map'>
                ")
                ->append_metadata_js("
                      <script type='text/javascript' src='".$this->template->Js()."jquery.dataTables.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."Moment.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."datetime-moment.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."dataTables.bootstrap.js'></script>

                      <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#cal_sal').addClass('active-int-nav');
                            });
                      </script>
                      <script type='text/javascript'>
                            window.alert = function() {};
                      </script>
                ")
                ->set_layout('mwp/main')
                ->build('total_information/saldo',$data);
        }
    }
    function Calculate_saldo(){
        if($this->session->userdata('admin_manage')){
            UserAccess::checkUserPermission("tinfo");
            $data['access']= UserAccess::ManageAccessList();
//            $data['sidebar'] = $this->load->view('calculate-saldo/sidebar', $data, TRUE);
            $this->template->title("Administration | Manage Contest")
                ->append_metadata_css("
                        <link type='text/css' rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                ")
                ->append_metadata_js("
                      <script type='text/javascript' src='".$this->template->Js()."bootstrap-datepicker.min.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."jquery.dataTables.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."Moment.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."datetime-moment.js'></script>
                      <script type='text/javascript' src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                      <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#man_con').addClass('active-int-nav');
                            });
                      </script>
                      <script type='text/javascript'>
                            window.alert = function() {};
                      </script>
                ")
                ->set_layout('mwp/main')
                ->build('total_information/saldo',$data);
        }
    }

    public function saldo1(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        $data['account_number'] =  str_replace(' ', '', $this->input->post('accountnumbers'));
        $data['from'] = DateTime::createFromFormat('m/d/Y\T00:00:00', $this->input->post('from'));
        //$data['from'] date('Y-m-d\T00:00:00', strtotime($date_last_month)),
        //$data['to'] = DateTime::createFromFormat('m/d/Y', $this->input->post('to'));
        $data['to'] = DateTime::createFromFormat('m/d/Y\T23:59:59', $this->input->post('to'));
        $data['none'] = DateTime::createFromFormat('Y/d/m', date('2015/5/5'));
//        $data['from']->setTime(00,00,01);
//        $data['to']->setTime(23,59,59);
        if(strstr( $data['account_number'], "\n")) {
            $pieces1 = explode("\n", $data['account_number']);
        }else if(strstr( $data['account_number'], ",")){
            $pieces2 = explode(",", $data['account_number']);
        }


        $pieces_newline = array();
        $pieces_comma = array();
        $piece1 = array();
        $piece2 = array();



        if($pieces1){
            foreach ($pieces1 as $AN_keyX => $AN_valueX) {
                if(strstr($AN_valueX, ",")) {
                    $piece1 = explode(",", $AN_valueX);
                }else{
                    array_push($pieces_newline, $AN_valueX);
                }

                $pieces_comma =array_merge($pieces_comma, $piece1);
            }

        }

        if($pieces2){
            foreach ($pieces2 as $AN_keyY => $AN_valueY) {
                if(strstr($AN_valueY, "\n")) {
                    $piece2 = explode("\n", $AN_valueY);
                }else{
                    array_push($pieces_comma, $AN_valueY);
                }

                $pieces_newline =array_merge($pieces_newline, $piece2);
            }


        }

        $pieces =array_merge($pieces_newline, $pieces_comma);
        $pieces = array_filter(array_unique($pieces));
        if (!$pieces){
            array_push($pieces, $data['account_number']);
        }



        $data['tr']='';
        $data['total_saldo']=0;
        foreach ($pieces as $AN_key => $AN_value){
            $data['amount']=0;
            $data['MtAccountsSet'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number",$AN_value, "user_id,mt_currency_base", '');
            $data['ProfileInfo'] = $this->g_m->showssingle($table = "user_profiles", "user_id", $data['MtAccountsSet']['user_id'], "full_name", '');
            $account_info = array(
                'iLogin' => $AN_value,
//                'from' => $from=$this->input->post('from') !=''? $data['from']->format('Y-m-d H:i:s'):$data['none']->format('Y-m-d\TH:i:s') ,
//                'to' =>  $to=$this->input->post('to') !=''?$data['to']->format('Y-m-d H:i:s'):$data['none']->format('Y-m-d\TH:i:s')
                'from' => date('Y-m-d\TH:i:s', strtotime($from)),
                'to' =>  date('Y-m-d H:i:s', strtotime($to))
            );
            $data['withdraw']=0;
            $data['deposit']=0;
            $data['saldo']=0;
            $cnvrtd_saldo=0;

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $yo = $WebService->open_RequestAccountFinanceRecordsByDate1($account_info);
//            print_r($yo);exit;
            switch($WebService->request_status){
                case 'RET_OK':
                    $data['success']='true';
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    if($tradatalist){
                        $data['success2']='true';
                        $count=0;
                        foreach ( $tradatalist['FinanceRecordData'] as $object){
                            $count=$count+1;

                            if ($object->FundType=='BONUS'){

                            }
                            if ($object->Operation=='REAL_FUND_DEPOSIT'){
                                $data['deposit']=floatval($data['deposit'])+floatval($object->Amount);
                                $data['d'.$count]=$object->Amount;

                            }
                            if ($object->Operation=='REAL_FUND_WITHDRAW'){
                                $data['withdraw']=floatval($data['withdraw'])+abs(floatval($object->Amount));
                                $data['w'.$count]=abs(floatval($object->Amount));
                            }
                            if ($object->Operation=='REAL_FUND_TRANSFER'){

                            }
                        }

                        $data['saldo']=floatval($data['deposit'])-floatval($data['withdraw']);
                        $data['tr'].='<tr>';

                        $data['tr'].='<td>'.$AN_value;
                        $data['tr'].='</td>';

                        $data['tr'].='<td>' . $data['ProfileInfo']['full_name'] ;
                        $data['tr'].='</td>';
                        $data['tr'].='<td>'. $cnvrtd_saldo =number_format((float)FXPP::getCurrencyRate($data['saldo'], $from_currency=strtoupper(trim($data['MtAccountsSet']['mt_currency_base'])), $to_currency="USD"), 2, '.', '')   . ' USD';
                        $data['tr'].='</td>';

                        $data['tr'].='</tr>';

                    }else{

                        $data['tr'].='<tr>';
                        $data['saldo']=0;
                        $cnvrtd_saldo=0;
                        $data['amount']=0;
                        $data['tr'].='<td>'.$AN_value;
                        $data['tr'].='</td>';

                        $data['tr'].='<td>' . $data['ProfileInfo']['full_name'] ;
                        $data['tr'].='</td>';

                        $data['tr'].='<td>'.$data['amount'];
                        $data['tr'].='</td>';

                        $data['tr'].='</tr>';

                    }

                    if ($cnvrtd_saldo<0){
                        $cnvrtd_saldo=0;
                    }

                    $data['total_saldo'] = $data['total_saldo'] + $cnvrtd_saldo;

                    break;
                default:
                    $data['success']='false';
            }

        }

        $data['tr'].=' <td colspan="3" class="total-saldo">Total Saldo: <span id="totalsaldo">'.number_format((float)$data['total_saldo'], 2, '.', '') .' USD</span></td>';

        echo json_encode($data);

        /*admin_log*/
        $this->load->model('Adminslogs_model');
        $arr = array(
            'Total saldo' => $data['total_saldo'],
            'Comment' => "Page for calculating saldo of  account numbers",
            'Account_numbers_computed' => $data['account_number'],
            'Date_from' => $from,
            'Date_to' => $to,
            'Manager_IP'=>$this->input->ip_address(),
        );

        $data['log']=array(
            'users_id'=>$_SESSION['user_id'],
            'page' => 'calculate-saldo',
            'date_processed'=> FXPP::getCurrentDateTime(),
            'processed_users_id'=>0,
            'data'=> json_encode($arr),
            'processed_users_id_accountnumber' => 0,
            'comment'=>'',
            'admin_fullname'=>$_SESSION['full_name'],
            'admin_email'=>$_SESSION['email'],
        );

        $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);
        /*admin_log*/

        unset($data);
    }
}