<?php

class Manual_Override extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
    }

    public function indextest(){
       // $data['top20d']=$this->g_m->showt1w1o1($table="deposit",$field="amount",$id=0,$select="*",$order_by="amount",$order="desc",$limit="20");
//        $data['top20d']=$this->g_m->showsfields2($table='deposit',$select='*');

        $data['top20d']=$this->g_m->showt1w1o1($table="deposit",$field="amount >",$id=0,$select="*",$order_by="amount",$order="desc",$limit="20");


        var_dump($data['top20d']);
    }
    public function index(){
        $data['data']=$this->input->get(NULL, TRUE);
        if(isset($data['data']['accountnumber'])) {
            var_dump($data['data']['accountnumber']);
        }
    }

    public function RecoveryPartnership(){
        $this->db->trans_start();
        $y=9740;
        for ($x=103914 ; $x <= 104343;$x++){


            $webservice_config = array(
                'server' => 'live_new'
            );
            $data = array(
                'iLogin' => $x
            );
            $WebService = new WebService($webservice_config);
            $WebService->request_account_details($data);




            if ($WebService->request_status === 'RET_OK') {
                do {
                    $data['decdoc']=$this->g_m->showssingle2($table='users',$field1='id',$id1=$y,$select='*','');
                    $y=$y+1;

                }while($data['decdoc']['email']!=$WebService->get_result('Email'));
                $currency='';
                $par = substr($WebService->get_result('Group'), 0, 2);
                $cur = substr($WebService->get_result('Group'), 2, 2);
                switch($cur){
                    case 'US':
                        $currency='USD';
                        break;
                    case 'EU':
                        $currency='EUR';
                        break;
                    case 'GB':
                        $currency='GBP';
                        break;
                    case 'RU':
                        $currency='RUB';
                        break;
                    default:
                        $currency='';
                }
                if($par=='Pa'){
                    $WebService2 = new WebService($webservice_config);
                    $WebService2->open_RequestAccountBalance($data);

                        if ($WebService2->request_status === 'RET_OK') {
                                $data['reg'] = DateTime::createFromFormat('Y-m-d\TH:i:s',  $WebService->get_result('RegDate'));
                                echo 'account_number = '.$x.' and ';
                                echo 'user_id ='.$data['decdoc']['id'].' group = '.$WebService->get_result('Group') .' reg date ='.$data['reg']->format('Y-m-d H:i:s').' balance ='.$WebService2->get_result('Balance').' <br/>';

                                $data['insert'] = array(
                                    'id'=>NULL,
                                    'partner_id'=>$data['decdoc']['id'],
                                    'reference_num'=>$WebService->get_result('LogIn'),
                                    'target_country'=>$WebService->get_result('Country'),
                                    'dateregistered'=>$data['reg']->format('Y-m-d H:i:s'),
                                    'status_type'=>'',
                                    'currency'=>$currency,
                                    'amount'=>$WebService2->get_result('Balance'),
                                );
                            $data['fix']= $this->g_m->insert('partnership',$data['insert']);
                        }


                }

            }else{

                $y=$y+1;
            }

        }

        $this->db->trans_complete();
    }
    public function RecoveryMTASbalance(){
        $this->db->trans_start();
        for ($x=103914 ; $x <= 104343;$x++) {
            echo 'account_number = ' . $x . ' and ';

            $webservice_config = array(
                'server' => 'live_new'
            );
            $data = array(
                'iLogin' => $x
            );
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountBalance($data);
            if ($WebService->request_status === 'RET_OK') {
                echo ' balance ='.$WebService->get_result('Balance').'<br/>';
                $data['insert'] = array(
                   'amount'=> $WebService->get_result('Balance'),
//                        'id'=>NULL,
//                        'account_number'=>$WebService->get_result('LogIn')
                );
//                $data['fix']= $this->g_m->updatemy($table='mt_accounts_set',$field='account_number',$id=$WebService->get_result('LogIn'),$data['insert']);
//                $data['fix']= $this->g_m->insert($table='mtas_back',$data['insert']);
            } else {

            }
        }
        $this->db->trans_complete();
    }
    public function RecoveryUserProfiles(){

        $this->db->trans_start();
        $y=9740;
        for ($x=103914 ; $x <= 104343;$x++){
            echo 'account_number = '.$x.' and ';

            $webservice_config = array(
                'server' => 'live_new'
            );
            $data = array(
                'iLogin' => $x
            );
            $WebService = new WebService($webservice_config);
            $WebService->request_account_details($data);


            if ($WebService->request_status === 'RET_OK') {
                do {
                    $data['decdoc']=$this->g_m->showssingle2($table='users',$field1='id',$id1=$y,$select='*','');
                    $y=$y+1;

                }while($data['decdoc']['email']!=$WebService->get_result('Email'));

                    echo 'user_id ='.$data['decdoc']['id'].'<br/>';
                    $data['insert'] = array(
                        'full_name'=>$WebService->get_result('Name'),
                    );
//                    $data['fix']= $this->g_m->updatemy('user_profiles',$field='user_id',$id=$data['decdoc']['id'],$data['insert']);

            }else{

                $y=$y+1;
            }

        }

        $this->db->trans_complete();
    }
    public function Recovery(){
        $this->db->trans_start();
        $y=9740;
        $z=0;
        for ($x=103914 ; $x <= 104343;$x++){
             echo 'account_number = '.$x.' and ';

            $webservice_config = array(
                'server' => 'live_new'
            );
            $data = array(
                'iLogin' => $x
            );
            $WebService = new WebService($webservice_config);
            $WebService->request_account_details($data);


            if ($WebService->request_status === 'RET_OK') {
                  do {
                      $data['decdoc']=$this->g_m->showssingle2($table='users',$field1='id',$id1=$y,$select='*','');
                      $y=$y+1;

                  }while($data['decdoc']['email']!=$WebService->get_result('Email'));
                    echo 'user_id ='.$data['decdoc']['id'].'<br/>';

                    $pgroup = array("PaUS", "PaEU", "PaGB", "PaRU");
                    if(!in_array($WebService->get_result('Group'),$pgroup)){
                        $mt_accountset = substr($WebService->get_result('Group'), 0, 2);
                        if($mt_accountset=='St') {
                            $mt_accountset_id=1;
                        }else{
                            $mt_accountset_id=2;
                        }
                        $cur = substr($WebService->get_result('Group'), 4, 2);
                        switch ($cur){
                            case 'US':
                                $mycur='USD';
                                break;
                            case 'GB':
                                $mycur='GBP';
                                break;
                            case 'RU':
                                $mycur='RUB';
                                break;
                            case 'EU':
                                $mycur='EUR';
                                break;
                            default:
                                $mycur='';

                        }
                        $data['insert'] = array(
                            'id'=>NULL,
                            'user_id'=>$data['decdoc']['id'],
                            'account_number'=>$x,
                            'mt_type'=>1,
                            'mt_status'=> ($data['decdoc']['accountstatus']==1)?1:'',
                            'leverage'=>'1:'.$WebService->get_result('Leverage'),
                            'group'=>$WebService->get_result('Group'),
                            'registration_time'=>$data['decdoc']['created'],
                            'registration_ip'=>$data['decdoc']['last_ip'],
                            'mt_currency_base'=>$mycur,
                            'mt_account_set_id'=>$mt_accountset_id
                        );
//                        $data['fix']= $this->g_m->insert('mt_accounts_set',$data['insert']);

                    }
            }else{
                $y=$y+1;
            }

        }
        $this->db->trans_complete();
    }

    public function VerifyAccount(){
        if ($this->session->userdata('admin_manage')) {
            $this->db->trans_start();
            $data['data'] = $this->input->get(NULL, TRUE);
            if (isset($data['data']['accountnumber'])) {
                var_dump($data['data']['accountnumber']);

//            die();
                   $data['accountnumber']=$data['data']['accountnumber']; // enter account number
                $data['mtas'] = $this->g_m->showssingle2($table = 'mt_accounts_set', $field = "account_number", $id = $data['accountnumber'], $select = "user_id,account_number", $order_by = "");
    //                die();
                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);

                $account_info = array(
                    'AccountNumber' => $data['accountnumber']
                );

                $WebService->open_ActivateAccountTrading($account_info);

                if ($WebService->request_status === 'RET_OK') {

                    $data['UserInfo'] = $this->g_m->showssingle($table = "users", "id", $data['mtas']['user_id'], "email", '');
                    $data['ProfileInfo'] = $this->g_m->showssingle($table = "user_profiles", "user_id", $data['mtas']['user_id'], "full_name", '');
                    $data['MtAccountsSet'] = $this->g_m->showssingle($table = "mt_accounts_set", "user_id", $data['mtas']['user_id'], "account_number", '');

                    $data['DocType0'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['DocInfo']['user_id'], 'doc_type', '0', 'status', '1', "*", '');
                    $data['DocType1'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['DocInfo']['user_id'], 'doc_type', '1', 'status', '1', "*", '');
                    $data['DocType2'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['DocInfo']['user_id'], 'doc_type', '2', 'status', '1', "*", '');

                    if ($data['DocType0'] == false) {
                        $data['DocType0']['client_name'] = '';
                        $data['DocType0']['file_name'] = '';
                        $data['DocType0']['doc_type'] = '';
                    }
                    if ($data['DocType1'] == false) {
                        $data['DocType1']['client_name'] = '';
                        $data['DocType1']['file_name'] = '';
                        $data['DocType1']['doc_type'] = '';
                    }
                    if ($data['DocType2'] == false) {
                        $data['DocType2']['client_name'] = '';
                        $data['DocType2']['file_name'] = '';
                        $data['DocType2']['doc_type'] = '';
                    }


                    $data['senddata'] = array(

                        'Email' => $data['UserInfo']['email'],
                        'AccountNumber' => $data['MtAccountsSet']['account_number'],
                        'FullName' => $data['ProfileInfo']['full_name'],

                        'ClientName0' => $data['DocType0']['client_name'],
                        'FileName0' => $data['DocType0']['file_name'],
                        'DocIdx0' => $data['DocType0']['doc_type'],

                        'ClientName1' => $data['DocType1']['client_name'],
                        'FileName1' => $data['DocType1']['file_name'],
                        'DocIdx1' => $data['DocType1']['doc_type'],

                        'ClientName2' => $data['DocType2']['client_name'],
                        'FileName2' => $data['DocType2']['file_name'],
                        'DocIdx2' => $data['DocType2']['doc_type']

                    );
                    $data['senddata2'] = array(

                        'Email' => 'trowabarton00005@gmail.com',
                        'AccountNumber' => $data['MtAccountsSet']['account_number'],
                        'FullName' => $data['ProfileInfo']['full_name'],

                        'ClientName0' => $data['DocType0']['client_name'],
                        'FileName0' => $data['DocType0']['file_name'],
                        'DocIdx0' => $data['DocType0']['doc_type'],

                        'ClientName1' => $data['DocType1']['client_name'],
                        'FileName1' => $data['DocType1']['file_name'],
                        'DocIdx1' => $data['DocType1']['doc_type'],

                        'ClientName2' => $data['DocType2']['client_name'],
                        'FileName2' => $data['DocType2']['file_name'],
                        'DocIdx2' => $data['DocType2']['doc_type']

                    );
                    Fx_mailer::AccountVerificationVerifiedUser($data['senddata']);
                    Fx_mailer::AccountVerificationVerifiedUser($data['senddata2']);

                    $data['verifyMTAS'] = array(
                        'mt_status' => 1
                    );
                    $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['mtas']['user_id'], $data['verifyMTAS']);

                    $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

                    $data['verify'] = array(
                        'accountstatus' => 1,
                        'verified' => $data['DateUp']->format('Y-m-d H:i:s')
                    );

                    $this->g_m->updatemy($table = "users", "id", $data['mtas']['user_id'], $data['verify']);

                    $this->db->trans_complete();
                } else {
                    $this->db->trans_rollback();
                }
            }
        }
    }

}