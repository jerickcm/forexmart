<?php

class Account_verification extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->library('Fx_mailer');
        $this->load->model('General_model');

        $this->g_m=$this->General_model;
        $this->load->model('Accountverification_model');
        $this->av_m=$this->Accountverification_model;
    }

    public function index(){

    }
    // upload verified
    public function declined(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['data'] = array(
            'userid'=>$this->input->post('userid'),
            'accountnumber'=>$this->input->post('accountnumber'),
            'date_approved'=>  date('Y-m-d H:i:s')
        );

        $data['verify']=array(
            'accountstatus'=>2
        );
        $this->g_m->updatemy($table="users","id",$data['data']['userid'],$data['verify']);
        $data['declined']=array(
            'mt_status'=>''
        );
        $this->g_m->updatemy($table="mt_accounts_set","user_id",$data['data']['userid'],$data['declined']);

        $data['data'] = array(
            'move' => true
        );
        echo json_encode($data['data']);

    }
    // upload verified
    public function verified(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $data['data'] = array(
            'userid'=>$this->input->post('userid'),
            'accountnumber'=>$this->input->post('accountnumber'),
            'date_approved'=>  date('Y-m-d H:i:s')
        );

        $data['DocInfo'] = $this->g_m->showssingle($table="user_documents","id",$data['data']['userid'],"*",'');
        $data['UserInfo'] = $this->g_m->showssingle($table="users","id",$data['data']['userid'],"email",'');
        $data['ProfileInfo'] = $this->g_m->showssingle($table="user_profiles","user_id",$data['data']['userid'],"full_name",'');
        $data['MtAccountsSet'] = $this->g_m->showssingle($table="mt_accounts_set","user_id",$data['data']['userid'],"account_number",'');

        $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['data']['userid'],'doc_type','0','status','1',"*",'');
        $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['data']['userid'],'doc_type','1','status','1',"*",'');
        $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['data']['userid'],'doc_type','2','status','1',"*",'');

        if ($data['DocType1']==false){
            $data['DocType1']['client_name']='';
            $data['DocType1']['file_name']='';
            $data['DocType1']['doc_type']='';
        }
        if ($data['DocType2']==false){
            $data['DocType2']['client_name']='';
            $data['DocType2']['file_name']='';
            $data['DocType2']['doc_type']='';
        }
        if ($data['DocType0']==false){
            $data['DocType0']['client_name']='';
            $data['DocType0']['file_name']='';
            $data['DocType0']['doc_type']='';
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

        $webservice_config = array(
            'server' => 'live_new'
        );
        $WebService = new WebService($webservice_config);

        $account_info = array(
            'AccountNumber' => $data['MtAccountsSet']['account_number']
        );

        $WebService->open_ActivateAccountTrading($account_info);

        if( $WebService->request_status === 'RET_OK' ) {

            Fx_mailer::AccountVerificationVerifiedUser($data['senddata']);
            $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $data['verify'] = array(
                'accountstatus' => 1,
                'verified' => $data['DateUp']->format('Y-m-d H:i:s')
            );
            $this->g_m->updatemy($table = "users", "id", $data['data']['userid'], $data['verify']);
            $data['mts_update'] = array(
                'mt_status' => 1
            );
            $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['data']['userid'], $data['mts_update']);

            $data['data'] = array(
                'move' => true
            );
            $this->db->trans_complete();
        }else{
            $this->db->trans_rollback();
            $data['data']['error']='verification error in API';
        }

        echo json_encode($data['data']);
    }

    public function verified_aff(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}


        $data['data'] = array(
            'userid'=>$this->input->post('userid'),
            'accountnumber'=>$this->input->post('accountnumber'),
            'date_approved'=>  date('Y-m-d H:i:s')
        );

        $data['DocInfo'] = $this->g_m->showssingle($table="user_documents","id",$data['data']['userid'],"*",'');
        $data['UserInfo'] = $this->g_m->showssingle($table="users","id",$data['data']['userid'],"email",'');
        $data['ProfileInfo'] = $this->g_m->showssingle($table="user_profiles","user_id",$data['data']['userid'],"full_name",'');

        $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','1',"*",'');
        $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','1',"*",'');
        $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','1',"*",'');

        if ($data['DocType1']==false){
            $data['DocType1']['client_name']='';
            $data['DocType1']['file_name']='';
            $data['DocType1']['doc_type']='';
        }
        if ($data['DocType2']==false){
            $data['DocType2']['client_name']='';
            $data['DocType2']['file_name']='';
            $data['DocType2']['doc_type']='';
        }
        if ($data['DocType0']==false){
            $data['DocType0']['client_name']='';
            $data['DocType0']['file_name']='';
            $data['DocType0']['doc_type']='';
        }


        $data['senddata'] = array(

            'Email' => $data['UserInfo']['email'],
            'AccountNumber' => $data['partnership']['reference_num'],
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

        $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        Fx_mailer::AccountVerificationVerifiedUser_aff($data['senddata']);
        $data['verify'] = array(
            'accountstatus' => 1,
            'verified' => $data['DateUp']->format('Y-m-d H:i:s')
        );
        $this->g_m->updatemy($table = "users", "id", $data['data']['userid'], $data['verify']);

        $data['data'] = array(
            'move' => true
        );

        echo json_encode($data['data']);
    }

    public function upload(){
        if($this->session->userdata('admin_manage')){            
            Admin::checkUserPermission("doseviem","acveri");
            $data['data']['access']=  Admin::ManageAccessList();


            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap2.css">
                         <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 ')
                ->append_metadata_js("
                          <script type='text/javascript'>
                            window.alert = function() {};
                          </script>

                          <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                          <script src='".$this->template->Js()."Moment.js'></script>
                          <script src='".$this->template->Js()."datetime-moment.js'></script>
                          <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                          <script src='".$this->template->Js()."jquery.validate.js'></script>

                          <script type='text/javascript'>
                             $(function() {
                                $('#accountverification').addClass('active-int-nav');

                             });
                              $(window).load(function(){
                                 $('#t4').addClass('active-set-tab');
                              });
                          </script>
                    ")
                ->set_layout('administration/main')
                ->build('account-verification/upload',$data['data']);


        }else{
            setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
            redirect('signout/admin');
        }

    }

    public function save(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $data['account_number']=$this->input->post('account_number');
        $data['client'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number", $this->input->post('account_number'), "*", '');


        if (trim($this->input->post('account_number'))==''){
            $data2['empty']=true;
            echo json_encode($data2);
            exit;
            die();
        }
        //check client account
        if($data['client']){
            $account_info = array(
                'iLogin' =>$this->input->post('account_number')
            );
            $webservice_config = array(
                'server' => 'live_new'
            );
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountDetails($account_info);
            switch ($WebService->request_status) {
                case 'RET_OK':
                    $data2['IsReadOnly']=$WebService->get_result('IsReadOnly');
                    if ($WebService->get_result('IsReadOnly')==false){
                        $this->db->trans_start();
                        $data['mt_account_set'] = $this->g_m->showssingle($table="mt_accounts_set","account_number",$this->input->post('account_number'),"*",'');
                        $data['users'] = $this->g_m->showssingle($table="users","id",$data['mt_account_set']['user_id'],"*",'');
                        $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                        $data['verify'] = array(
                            'accountstatus' => 1,
                            'verified' => $data['DateUp']->format('Y-m-d H:i:s')
                        );
                        $this->g_m->updatemy($table="users","id",$data['mt_account_set']['user_id'],$data['verify']);
                        $data['mts_update'] = array(
                            'mt_status' => 1
                        );
                        $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['mt_account_set']['user_id'], $data['mts_update']);

                        $data['ProfileInfo'] = $this->g_m->showssingle($table = "user_profiles", "user_id", $data['mt_account_set']['user_id'], "full_name", '');
                        $data['DocType0'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['mt_account_set']['user_id'], 'doc_type', '0', 'status', '1', "*", '');
                        $data['DocType1'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['mt_account_set']['user_id'], 'doc_type', '1', 'status', '1', "*", '');
                        $data['DocType2'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['mt_account_set']['user_id'], 'doc_type', '2', 'status', '1', "*", '');

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

                            'Email' => $data['users']['email'],
                            'AccountNumber' => $data['mt_account_set']['account_number'],
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

                        $data2['verification_status']='Verified';
                        $this->load->library('Fx_mailer');
                        Fx_mailer::AccountVerificationVerifiedUser($data['senddata']);

                        $this->db->trans_complete();

                        $data2['verified']='true';
                        $data2['error1']='false';
                    }else{
                        $data2['verified']='false';
                        $data2['error1']='false';
                    }
                    break;
                default:
                    $data2['verified']='false';
                    $data2['error1']='true';
            }
        }else{
            $data2['type']='invalid';
        }

        $data['partner'] = $this->g_m->showssingle($table = "partnership","reference_num",$this->input->post('account_number'),"*",'');
        //check partner account
        if($data['partner'] ){
            $data2['type']='partner';
            $data['mt_account_set'] = $this->g_m->showssingle($table="mt_accounts_set","account_number",$this->input->post('account_number'),"*",'');
            $data['users'] = $this->g_m->showssingle($table="users","id", $data['mt_account_set']['user_id'],"*",'');
            $data2['location']=$data['users']['accountstatus'];
        }

        echo json_encode($data2);
    }

    public function upload_documents(){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->helper(array('form', 'url'));

        $data['account_number']=$this->input->post('account_number');

        $data['client'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number", $this->input->post('account_number'), "*", '');
        $data['partner'] = $this->g_m->showssingle($table = "partnership","reference_num",$this->input->post('account_number'),"*",'');

        //check client account
        if($data['client']){

            $data['save-data']=$data['client'];
            $user_id =  $data['save-data']['user_id'];
        }
        //check partner account
        if($data['partner'] ){
            $data['save-data']=$data['partner'];
            $user_id =  $data['save-data']['partner_id'];
        }
        //check invalid account
        if ($data['partner']==false and $data['client']==false){

            $data['msgError'] = 'Notice:  Invalid account number given.';
            $data['error'] = true;
            echo json_encode($data);
            die();
            exit;

        }


        $data=array();

        if(!empty($_FILES['filename']['name'])){

            $this->load->helper(array('form', 'url'));
            $_FILES['userfile']['name']    = $_FILES['filename']['name'];
            $_FILES['userfile']['type']    = strtolower($_FILES['filename']['type']);
            $_FILES['userfile']['tmp_name'] = $_FILES['filename']['tmp_name'];
            $_FILES['userfile']['error']       = $_FILES['filename']['error'];
            $_FILES['userfile']['size']    = $_FILES['filename']['size'];

//            $config['file_name']     = sha1($_FILES['userfile']['name']);
            $config['file_name']     = hash('haval256,5',$_FILES['userfile']['name']);
            $config['upload_path'] = '/var/www/html/my.forexmart.com/assets/user_docs/';
            $config['allowed_types'] = 'gif|JPG|JPEG|jpg|jpeg|png|bmp|pdf';
            $config['max_size']      = '10000';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $config['overwrite']     = false;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload())
            {
                $uploadData = $this->upload->data();

                $updData = array(
                    'user_id' => $user_id,
                    'doc_type' => $this->input->post('doc_type'),
                    'file_name' => $uploadData['file_name'],
                    'client_name' => $uploadData['client_name'],
                    'admn_upload_userid' => $this->session->userdata('user_id'),
                    'status' => 0,
                );

                $config['source_image'] = '/var/www/html/my.forexmart.com/assets/user_docs/'. $uploadData['file_name'];
                 FXPP::setWaterMark($config['source_image']);

                $accountstatus= $this->g_m->showssingle($table='users',$field="id",$id=$user_id,$select="accountstatus");
                if ($accountstatus['accountstatus']!=1){
                    $data['newupload']=array(
                        'accountstatus'=>0,
                        'recent_fileupload'=> date('Y-m-d H:i:s')
                    );
                    $this->g_m->updatemy($table="users","id",$user_id,$data['newupload']);
                }

                $this->g_m->insertmy($table="user_documents",$updData);
                $data['error'] = false;

            }else{
                $data['msgError'] = $this->upload->display_errors();
                $data['error'] = true;
            }
        }else{
            $data['msgError'] = 'Please select a file.';
            $data['error'] = true;
        }
        echo json_encode($data);
    }

    /*account verification pending loadview*/
    public function av_pending(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '128M');
        if($this->session->userdata('admin_manage')){
            // Check permission
            Admin::checkUserPermission("pending","acveri");
            $data['data']['access']= Admin::ManageAccessList();

            $data['data']['custom_validation']='';
            $data['data']['custom_validation_success']='';
            $data['data']['selectdefault'] = 0;

            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap2.css">
                         <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 ')
                ->append_metadata_js("
                          <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                          <script src='".$this->template->Js()."jquery.dataTables.min.js'></script>
                          <script src='".$this->template->Js()."moment.min.js'></script>
                          <script src='".$this->template->Js()."datetime-moment.min.js'></script>
                          <script src='".$this->template->Js()."dataTables.bootstrap.min.js'></script>
                          <script src='".$this->template->Js()."jquery.validate.min.js'></script>
                          <script type='text/javascript'>
                             $(function() {
                                $('#accountverification').addClass('active-int-nav');
                             });
                          </script>
                    ")

                ->set_layout('administration/main')
                ->build('account-verification/pending',$data['data']);
            unset($data);
        }else{
            setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
            redirect('signout/admin');
        }
    }
    public function get_pending(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $draw = (int) $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $type = $this->input->post('account_type');
        $search = $this->input->post('search');

        $data['user_documents0'] = $this->av_m->showCP_pending();
        $data['user_documents1'] = $this->av_m->showCP_pendingS($length, $start,strtoupper(trim($search['value'])));

        if( $data['user_documents1']) {
            foreach ( $data['user_documents1'] as $key => $value) {
                if (is_null($value['recent_fileupload'])){
                    $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);
                }else{
                    $data['DateUp']= DateTime::createFromFormat('Y-m-d H:i:s',$value['recent_fileupload']);
                }
                $data['data'][$key]['date_submitted'].= $data['DateUp']->format('Y-M-d H:i:s ');
                $data['data'][$key]['account_email'].= $value['email'] ;
                $data['data'][$key]['partner_type'].= trim($value['login_type'])==0? 'Client' :'Partner' ;
                $data['data'][$key]['account_number'].= $value['account_number']  ;
                $data['data'][$key]['full_name'].=$value['full_name'] ;
                $data['data'][$key]['country'].=$value['last_ip'] ;
                $data['data'][$key]['action'].= '<a href="#' . $value['id'] . '"  data-type="'.$data['data'][$key]['partner_type'].'" data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action request" data-toggle="modal" data-target="#pendingStat">' . lang("md") . '</a>';
            }
        }else{
            $data['data']= array(
                "draw"=> 0,
                "recordsTotal"=>0,
                "recordsFiltered"=> 0,
                "data"=>[]
            );
            echo json_encode($data);
            unset($data);die();
        }
        $recordsTotal = count($data['user_documents0']);
        $recordsFiltered = count($data['user_documents0']);

        $data['draw'] = $draw;
        $data['recordsTotal'] = $recordsTotal;
        $data['recordsFiltered'] = $recordsFiltered;
        unset($data['DateUp']);
        unset($data['user_documents0']);
        unset($data['user_documents1']);
        echo json_encode($data);
        unset($data);
    }
    /*account verification verified loadview*/
    public function av_verified(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '128M');
        if($this->session->userdata('admin_manage')){

            // Check permission
            Admin::checkUserPermission("verified","acveri");
            $data['data']['access']= Admin::ManageAccessList();

            $data['data']['custom_validation'] = '';
            $data['data']['custom_validation_success'] = '';
            $data['data']['selectdefault'] = 0;

            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap2.css">
                         <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 ')
                ->append_metadata_js("

                          <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                          <script src='".$this->template->Js()."jquery.dataTables.min.js'></script>
                          <script src='".$this->template->Js()."moment.min.js'></script>
                          <script src='".$this->template->Js()."datetime-moment.min.js'></script>
                          <script src='".$this->template->Js()."dataTables.bootstrap.min.js'></script>
                          <script src='".$this->template->Js()."jquery.validate.min.js'></script>
                          <script type='text/javascript'>
                             $(function() {
                                $('#accountverification').addClass('active-int-nav');
                             });
                          </script>
                    ")

                ->set_layout('administration/main')
                ->build('account-verification/verified',$data['data']);
            unset($data);
        }else{
            setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
            redirect('signout/admin');
        }
    }
    /*account verification declined loadview*/
    public function get_verified(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $draw = (int) $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');

        $data['user_documents0'] = $this->av_m->showCP_verified();
        $data['user_documents1'] = $this->av_m->showCP_verifiedS($length, $start,strtoupper(trim($search['value'])));

        if( $data['user_documents1']) {
            foreach ( $data['user_documents1'] as $key => $value) {
                if (is_null($value['recent_fileupload'])){
                    $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);
                }else{
                    $data['DateUp']= DateTime::createFromFormat('Y-m-d H:i:s',$value['recent_fileupload']);
                }
                $data['data'][$key]['date_submitted'].= $data['DateUp']->format('Y-M-d H:i:s ');
                $data['data'][$key]['account_email'].= $value['email'] ;
                $data['data'][$key]['partner_type'].= trim($value['login_type'])==0? 'Client' :'Partner' ;
                $data['data'][$key]['account_number'].= $value['account_number']  ;
                $data['data'][$key]['full_name'].=$value['full_name'] ;
                $data['data'][$key]['country'].=$value['last_ip'] ;
                $data['data'][$key]['action'].= '<a href="#' . $value['id'] . '"  data-type="'.$data['data'][$key]['partner_type'].'" data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action verified" data-toggle="modal" data-target="#verifiedStat">' . lang("md") . '</a>';
            }
        }else{
            $data['data']= array(
                "draw"=> 0,
                "recordsTotal"=>0,
                "recordsFiltered"=> 0,
                "data"=>[]
            );
            echo json_encode($data);
            unset($data);die();
        }
        $recordsTotal = count($data['user_documents0']);
        $recordsFiltered = count($data['user_documents0']);

        $data['draw'] = $draw;
        $data['recordsTotal'] = $recordsTotal;
        $data['recordsFiltered'] = $recordsFiltered;
        unset($data['DateUp']);
        unset($data['user_documents0']);
        unset($data['user_documents1']);
        echo json_encode($data);
        unset($data);
    }

     public function get_verifiedtab_search(){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '2048M');
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $search = $this->input->post('s_accountnumber');
        $data= $this->av_m->get_verifiedtab_search($search);
        if( $data) {
            if (is_null($data[0]['recent_fileupload'])){
                $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $data[0]['date_uploaded']);
            }else{
                $data['DateUp']= DateTime::createFromFormat('Y-m-d H:i:s',$data[0]['recent_fileupload']);
            }

            $row ='<tr>';
            $row .='<td>';
            $row .=$data['DateUp']->format('Y-M-d H:i:s ');
            $row .='</td>';

            $row .='<td>';
            $row .= $data[0]['account_number'];
            $row .='</td>';

            // $row .='<td>';
            // $row .= $data['partner_type']=trim($data[0]['login_type'])==0? 'Client' :'Partner';
            // $row .='</td>';

            // $row .='<td>';
            // $row .= $data[0]['account_number'];
            // $row .='</td>';

            $row .='<td>';
            $row .=$data[0]['full_name'];
            $row .='</td>';

            $row .='<td>';
            $row .=$data[0]['fb'];
            $row .='</td>';

            $row .='<td>';
            $row .=$data[0]['group'];
            $row .='</td>';

            $row .='<td>';
            $row .='<a href="#' . $data[0]['id'] . '"  data-type="'.$data['partner_type'].'" data-accountnumber="' . $data[0]['account_number'] . '"  data-userid="' . $data[0]['user_id'] . '" data-id="' . $data[0]['id'] . '" data-fullname="' . $data[0]['full_name'] . '" data-email="' . $data[0]['email'] . '" data-address="' . $data[0]['street'] . ',' . $data[0]['city'] . ',' . $data[0]['state'] . ',' . $this->g_m->getCountries($data[0]['country']) . ',' . $data[0]['zip'] . '" class="queue-action verified" data-toggle="modal" data-target="#verifiedStat">' . lang("md") . '</a>
            ' ;
            $row .='</td>';
            $row .='<tr>';
            $data['row']=$row;
            echo json_encode($data);
            unset($data);
            unset($row);
        }else{
            $row='<tr>';
            $row .='<td colspan="7" style="text-align:center;"> No data found.</td>';
            $row.='</tr>';
            $data['row']=$row;
            echo json_encode($data);
            unset($data);
            unset($row);
        }
    }
    
    public function get_declinedtab_search(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '2048M');
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $search = $this->input->post('s_accountnumber');
       // $acctype = $this->input->post('acctype');

        //if($acctype==1){
           // $data= $this->av_m->get_declinedtab_search_bac($search);
        //}else{           
            $data= $this->av_m->get_declinedtab_search($search);
        //}

        if( $data) {
            if (is_null($data[0]['recent_fileupload'])){
                $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $data[0]['date_uploaded']);
            }else{
                $data['DateUp']= DateTime::createFromFormat('Y-m-d H:i:s',$data[0]['recent_fileupload']);
            }
            $address = $data[0]['street'].','.$data[0]['city'].','.$data[0]['state'].','.$this->g_m->getCountries($data[0]['country']).','.$data[0]['zip'];
            $row ='<tr>';
            $row .='<td>';
            $row .=$data['DateUp']->format('Y-m-d H:i:s ');
            $row .='</td> <td>';
            $row .=$data[0]['email'];
            $row .='</td> <td>';
            $row .= $data['partner_type']=trim($data[0]['login_type'])==0? 'Client' :'Partner';
            $row .='</td> <td>';
            $row .= $data[0]['account_number'];
            $row .='</td> <td>';
            $row .=$data[0]['full_name'];
            $row .='</td> <td>';
            $row .=$data[0]['country2'];
            $row .='</td> <td>';
            $row .='<a href="#' . $data[0]['id'] . '"  data-type="'. $data['partner_type'].'" data-accountnumber="' . $data[0]['account_number'] . '"  data-userid="' . $data[0]['user_id'] . '" data-id="' . $data[0]['id'] . '" data-fullname="' . $data[0]['full_name'] . '" data-email="' . $data[0]['email'] . '" data-address="' . $data[0]['street'] . ',' . $data[0]['city'] . ',' . $data[0]['state'] . ',' . $this->g_m->getCountries($data[0]['country']) . ',' . $data[0]['zip'] . '" class="queue-action declined" data-toggle="modal" data-target="#declineStat">' . lang("md") . '</a> |
            <a href="#' . $data[0]['id'] . '"  data-type="Client" data-accountnumber="' . $data[0]['account_number']. '"  data-userid="' . $data[0]['user_id'] . '" data-id="' . $data[0]['id'] . '" data-fullname="' . $data[0]['full_name'] . '" data-email="' . $data[0]['email'] . '" data-address="' . $data[0]['street'] . ',' . $data[0]['city'] . ',' . $data[0]['state'] . ',' . $this->g_m->getCountries($data[0]['country']) . ',' . $data[0]['zip'] . '" class="queue-action declinednotes" data-toggle="modal" data-target="#declineNotes">' . 'View reason of decline' . '</a>
            ' ;
//            }

            $row .='</td> <tr>';
            $data['row']=$row;
            echo json_encode($data);
            unset($data);
            unset($row);
        }else{
            $row='<tr>';
            $row .='<td colspan="7"> No data found.</td>';
            $row.='</tr>';
            $data['row']=$row;
            echo json_encode($data);
            unset($data);
            unset($row);
        }
    }

    public function av_declined(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '128M');
        if($this->session->userdata('admin_manage')){

            // Check permission
            Admin::checkUserPermission("declined","acveri");
            $data['data']['access']= Admin::ManageAccessList();
            $data['data']['custom_validation']='';
            $data['data']['custom_validation_success']='';
            $data['data']['selectdefault'] = 0;
            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                       <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap2.css">
                         <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 ')
                ->append_metadata_js("
                          <script type='text/javascript'>
                            window.alert = function() {};
                          </script>

                      <script src='".$this->template->Js()."jquery.dataTables.min.js'></script>
                          <script src='".$this->template->Js()."moment.min.js'></script>
                          <script src='".$this->template->Js()."datetime-moment.min.js'></script>
                          <script src='".$this->template->Js()."dataTables.bootstrap.min.js'></script>
                          <script src='".$this->template->Js()."jquery.validate.min.js'></script>

                          <script type='text/javascript'>
                             $(function() {
                                $('#accountverification').addClass('active-int-nav');
                             });
                          </script>
                    ")
                ->set_layout('administration/main')
                ->build('account-verification/declined',$data['data']);
            unset($data);
        }else{
            redirect('signout/admin');
        }
    }

    public function get_declined(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $draw = (int) $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');

        $data['user_documents0'] = $this->av_m->showCP_declined();
        $data['user_documents1'] = $this->av_m->showCP_declinedS($length, $start,strtoupper(trim($search['value'])));

        if( $data['user_documents1']) {
            foreach ( $data['user_documents1'] as $key => $value) {
                if (is_null($value['recent_fileupload'])){
                    $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);
                }else{
                    $data['DateUp']= DateTime::createFromFormat('Y-m-d H:i:s',$value['recent_fileupload']);
                }
                $data['data'][$key]['date_submitted'].= $data['DateUp']->format('Y-M-d H:i:s ');
                $data['data'][$key]['account_email'].= $value['email'] ;
                $data['data'][$key]['partner_type'].= trim($value['login_type'])==0? 'Client' :'Partner' ;
                $data['data'][$key]['account_number'].= $value['account_number']  ;
                $data['data'][$key]['full_name'].=$value['full_name'] ;
                $data['data'][$key]['country'].=$value['last_ip'] ;
                $data['data'][$key]['action'].= '<a href="#' . $value['id'] . '"  data-type="'. $data['data'][$key]['partner_type'].'" data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action declined" data-toggle="modal" data-target="#declineStat">' . lang("md") . '</a> |

                <a href="#' . $value['id'] . '"  data-type="Client" data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action declinednotes" data-toggle="modal" data-target="#declineNotes">' . 'View reason of decline' . '</a>
                ' ;
            }
        }else{
            $data['data']= array(
                "draw"=> 0,
                "recordsTotal"=>0,
                "recordsFiltered"=> 0,
                "data"=>[]
            );
            echo json_encode($data);
            unset($data);die();
        }
        $recordsTotal = count($data['user_documents0']);
        $recordsFiltered = count($data['user_documents0']);

        $data['draw'] = $draw;
        $data['recordsTotal'] = $recordsTotal;
        $data['recordsFiltered'] = $recordsFiltered;
        unset($data['DateUp']);
        unset($data['user_documents0']);
        unset($data['user_documents1']);
        echo json_encode($data);
        unset($data);
    }
    public function Pending_request(){

        $data['user_documents'] = $this->g_m->showt4w1jx($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus ',$id2='0','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number,u.recent_fileupload');

        $request='';
        if( $data['user_documents']) {
            foreach ( $data['user_documents'] as $key => $value) {
                if (is_null($value['recent_fileupload'])){
                    $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);
                }else{
                    $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['recent_fileupload']);
                }

                if ($value['accountstatus'] == 0) {
                    $request.= '<tr style="color: green">';
                } else {
                    $request.= '<tr style="color: red">';
                }
                $request.= '<td>' . $data['DateUp']->format('Y-M-d H:i:s ') . '</td>';
                $request.= '<td class="display-n">' . $value['email'] . '</td>';
                $request.= '<td class="display-n">Client</td>';
                $request.= '<td >' . $value['account_number'] . '</td>';
                $request.= '<td >' . $value['full_name'] . '</td>';
                $request.= '<td>' . $value['last_ip'] . '</td>';
                $request.= '<td>
<a href="#' . $value['id'] . '"  data-type="Client" data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action request" data-toggle="modal" data-target="#pendingStat">' . lang("md") . '</a>';
            }
        }else{

        }

        return $request;
        unset($request);
    }

    public function Pending_aff_request(){

        $data['user_documents'] = $this->g_m->showPt4w1jx($table='user_documents',$table2='users',$table3='user_profiles',$table4='partnership',$field2='accountstatus ',$id2='0','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num');

        $request='';
        if( $data['user_documents']) {

            foreach ( $data['user_documents'] as $key => $value) {

                $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);

                if ($value['accountstatus'] == 0) {
                    $request.= '<tr style="color: green">';
                } else {
                    $request.= '<tr style="color: red">';
                }
                $request.= '<td>' . $data['DateUp']->format('Y-M-d H:i:s') . '</td>';
                $request.= '<td class="display-n">' . $value['email'] . '</td>';
                $request.= '<td class="display-n">Partner</td>';
                $request.= '<td >' . $value['reference_num'] . '</td>';
                $request.= '<td >' . $value['full_name'] . '</td>';
                $request.= '<td>' . $value['last_ip'] . '</td>';
                $request.= '<td>
<a href="#' . $value['id'] . '" data-type="Affilliate" data-accountnumber="' . $value['reference_num'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action request" data-toggle="modal" data-target="#pendingStat">' . lang("md") . '</a>';
            }
        }else{
            $request.= '';
        }

        return $request;
        unset($request);
    }

    public function Verified_request(){

        $data['user_documents'] = $this->g_m->showt4w1jxV($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus',$id2='1','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number');

        $request='';

        if( $data['user_documents']) {

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request .= '<tr>';
                $request .= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
                $request .= '<td  class="display-n">'.$value['email'].'</td>';
                $request .= '<td  class="display-n">Client</td>';
                $request .= '<td >'.$value['account_number'].'</td>';
                $request .= '<td>'.$value['full_name'].'</td>';
                $request .= '<td>'.$value['last_ip'].'</td>';
                $request .= '<td><a href="#'.$value['id'].'" data-type="Client"  data-accountnumber="'.$value['account_number'].'" data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->g_m->getCountries($value['country']).','.$value['zip'].'" class="queue-action verified" data-toggle="modal" data-target="#verifiedStat">'.lang("md").'</a></td>';
                $request .= '</tr>';
            }
        }else{
            $request .= '<td colspan="6 class="center">'.lang("norecy").'</td>';
        }

        return $request;
        unset($request);
    }

    public function Verified_aff_request(){
        $data['user_documents'] = $this->g_m->showPt4w1jUV($table='user_documents',$table2='users',$table3='user_profiles',$table4='partnership',$field2='accountstatus ',$id2='1','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num');

        $request='';

        if($data['user_documents']){

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request.= '<tr>';
                $request.= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
                $request.= '<td class="display-n">'.$value['email'].'</td>';
                $request.= '<td class="display-n">Partner</td>';
                $request.= '<td >'.$value['reference_num'].'</td>';
                $request.= '<td>'.$value['full_name'].'</td>';
                $request.= '<td>'.$value['last_ip'].'</td>';
                $request .= '<td><a href="#'.$value['id'].'" data-type="Affiliate" data-accountnumber="'.$value['reference_num'].'" data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->g_m->getCountries($value['country']).','.$value['zip'].'" class="queue-action verified" data-toggle="modal" data-target="#verifiedStat">'.lang("md").'</a></td>';
                $request .= '</tr>';
                $request.= '</tr>';
            }
        }else{
            $request.= '';
        }

        return $request;
        unset($request);
    }

    public function Unverified_request(){

        $data['user_documents'] = $this->g_m->showt4w1jUV($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus',$id2='2','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number');

        $request='';

        if($data['user_documents']){

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request.= '<tr>';
                $request.= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
                $request.= '<td  class="display-n">'.$value['email'].'</td>';
                $request.= '<td  class="display-n">Client</td>';
                $request.= '<td >'.$value['account_number'].'</td>';
                $request.= '<td>'.$value['full_name'].'</td>';
                $request.= '<td>'.$value['last_ip'].'</td>';
                $request.= '<td><a href="#'.$value['id'].'" data-type="Client"  data-accountnumber="'.$value['account_number'].'"  data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->g_m->getCountries($value['country']).','.$value['zip'].'" class="queue-action declined" data-toggle="modal" data-target="#declineStat">'.lang("md").'</a> |

                <a href="#' . $value['id'] . '"  data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action declinednotes" data-toggle="modal" data-target="#declineNotes">' . 'View reason of decline' . '</a>


                </td>';
                $request.= '</tr>';
            }
        }else{
            $request.= '<td colspan="6 class="center">'.lang("norecy").'</td>';
        }

        return $request;
        unset($request);
    }

    public function Unverified_aff_request(){
        $data['user_documents'] = $this->g_m->showPt4w1jUV($table='user_documents',$table2='users',$table3='user_profiles',$table4='partnership',$field2='accountstatus ',$id2='2','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num');

        $request='';

        if($data['user_documents']){

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request.= '<tr>';
                $request.= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
                $request.= '<td class="display-n">'.$value['email'].'</td>';
                $request.= '<td class="display-n">Partner</td>';
                $request.= '<td >'.$value['reference_num'].'</td>';
                $request.= '<td>'.$value['full_name'].'</td>';
                $request.= '<td>'.$value['last_ip'].'</td>';
                $request.= '<td><a href="#'.$value['id'].'" data-type="Affiliate" data-accountnumber="'.$value['reference_num'].'"  data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->g_m->getCountries($value['country']).','.$value['zip'].'" class="queue-action declined" data-toggle="modal" data-target="#declineStat">'.lang("md").'</a> |


                 <a href="#' . $value['id'] . '"  data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->g_m->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action declinednotes" data-toggle="modal" data-target="#declineNotes">' . 'View reason of decline' . '</a>

                </td>';
                $request.= '</tr>';
            }
        }else{
            $request.= '';
        }

        return $request;
        unset($request);
    }

    /*account verification update pending*/
    public function AV_updaterequest(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['userid'] = $this->input->post('userid');
//        $data['data']['request'] = $this->Pending_request();
//        $data['data']['request'] .= $this->Pending_aff_request();
        $data['data']['fd'] = $this->doc1($data['userid']);
        $data['data']['sd'] = $this->doc2($data['userid']);

        echo json_encode($data['data']);
        unset($data);
    }
    /*account verification update verified*/
    public function AV_Verified_updaterequest(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['userid'] = $this->input->post('userid');
//        $data['data']['request'] = $this->Verified_request();
//        $data['data']['request'] .= $this->Verified_aff_request();
        $data['data']['fd'] = $this->doc1($data['userid']);
        $data['data']['sd'] = $this->doc2($data['userid']);

        echo json_encode($data['data']);
        unset($data);
    }
    /*account verification update unverified*/
    public function AV_Unverified_updaterequest(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['userid'] = $this->input->post('userid');
//        $data['data']['request'] = $this->Unverified_request();
//        $data['data']['request'] .= $this->Unverified_aff_request();
        $data['data']['fd'] = $this->doc1($data['userid']);
        $data['data']['sd'] = $this->doc2($data['userid']);
        echo json_encode($data['data']);
        unset($data);
    }

    private function doc1($userid){
        $data['userid']=$userid;

        $data['doc01'] = $this->g_m->showdoc12($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type <>', $id2='2',$select='*');

        $data['data']['fd'] = '';
        $result = array();
        foreach ($data['doc01'] as $data) {
            $id = $data['uploadset'];
            if (isset($result[$id])) {
                $result[$id][] = $data;
            } else {
                $result[$id] = array($data);
            }
        }

        $data['data']['fdx'] = '';

        if($result) {
            foreach ($result as $key => $value) {

                $tdcontent1='<td>';
                $tdcontent2='<td>';
                $tdcontent3='<td>';
                $tdcontent34='<td>';
                $tdcontent4='<td>';

                $tdcontent1_0='';
                $tdcontent2_0='';
                $tdcontent34_0='';
                $tdcontent3_0='';
                $tdcontent4_0='';

                $tdcontent2_1='';
                $tdcontent3_1='';
                $tdcontent34_1='';
                $tdcontent4_1='';

                $tdcontent1_01='';
                $tdcontent2_01='';
                $tdcontent3_01='';
                $tdcontent34_01='';
                $tdcontent4_01='';

                $trImg0='';
                $trImg1='';
                $trImg01='';
                $IsDoc2=false;


                $trrot01='';
                $trrot0 ='';
                $trrot1='';

                foreach ($value as $key2 => $value2) {

                    if($value2['doc_type']==0 ){
                        $doc_caption=' ( front )';
                        switch ($value2['status']) {
                            case 0:
                                $status = 'Pending';
                                break;
                            case 1:
                                $status = 'Approved';
                                break;
                            case 2:
                                $status = 'Declined';
                                break;
                            default:
                                $status = '';
                        }
                        if($status=='Declined'){
                            $data['declined'] ='- ( <a href="#" class="queue-action declinedsingle" data-id="' . $value2['id'] . '" data-toggle="modal" data-target="#declineSingle">View<a/> )';
                            $tdcontent34_0= (isset($value2['date_declined']))?DateTime::createFromFormat('Y-m-d H:i:s',$value2['date_declined'])->format('Y-M-d H:i:s'):'';
                        }else if($status == 'Approved'){
                            $tdcontent34_0= (isset($value2['date_approved']))?DateTime::createFromFormat('Y-m-d H:i:s',$value2['date_approved'])->format('Y-M-d H:i:s'):'' ;
                            $data['declined']= ' ';
                        }else{
                            $data['declined']= ' ';
                            $tdcontent34_0= 'N/A';
                        }

                        $tdcontent1_0.='<button type="button" class="mybutton hitdisplay" data-toggle="collapse" data-target="#collapseme'.$value2['id'].'" data-id="'.$value2['id'].'"> <span id="spn'.$value2['id'].'" class="glyphicon glyphicon-plus"></span>  '. $value2['client_name'].' '. $doc_caption .' ';

                        $tdcontent2_0.=$status ." ".$data['declined'];

                        $tdcontent3_0.= DateTime::createFromFormat('Y-m-d H:i:s',$value2['date_uploaded'])->format('Y-M-d H:i:s');
                        $tdcontent4_0.= '';

                        if ($status == lang('declined') or $status == lang('pending')) {
                            $tdcontent4_0.= '<a href="#" id="request-nth-approve'.$value2['id'].'"  data-id="'.$value2['id'].'" class="request-nth-approve queue-action"  data-target="#viewAcct">'.lang('modal_apprv').'</a>';
                        }
                        if ($status==lang('pending')){
                            $tdcontent4_0.= ' | ';
                        }
                        if ($status=='Approved' or $status==lang('pending')){
                            $tdcontent4_0.= '<a href="#" id="request-nth-decline'.$value2['id'].'"  data-id="'.$value2['id'].'"  data-toggle="modal" data-target="#popAccountVerificationDecline"  class=" queue-action modal-nth-decline"  data-target="#viewAcct">'.lang('modal_dcln').'</a>';
                        }
                        //FXPP-1433 Implement logic of putting Invert options in the Manage Documents of FXPP
                        $trrot0 .= '<tr class="tr1 displayn"><td colspan="5" class="imgr">';
                        $trrot0 .= '<input type="button" class="btnRotate" value="360"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" />';
                        $trrot0 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="90"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90.png'.'"  /></label>';
                        $trrot0 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="-90"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90l.png'.'"  /></label>';
                        $trrot0 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="180"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r180.png'.'"  /></label>';
                        $trrot0 .= '</td></tr>';
                        //FXPP-1433 Implement logic of putting Invert options in the Manage Documents of FXPP

                        $trImg0.= '<tr id="collapseme'.$value2['id'].'" class="collapse lg1"><td colspan="4" ><div class="avlabel">';
                        $trImg0.= '<label><strong><a class="hit" href="'.$this->config->item('domain-my') . '/assets/user_docs/' . $value2['file_name'] . '" target="_blank">FRONT</a></strong></label>
                        <div class="myimage">
                            <img id="img'.$value2['id'].'" src="'.$this->config->item('domain-my').'/assets/user_docs/'.$value2['file_name'].'" class="img'.$value2['user_id'].'  fimage img-responsive acct-ver-img"/>
                        </div>
                        <div class="mylg4">
                        </div>
                        ';
                        if($IsDoc2){

                        }else{
                            $tdcontent1_1 ='<br/>&nbsp;&nbsp;&nbsp; No back copy provided';
                            $IsDoc2=true;
                        }

                    }else{
                        switch ($value2['status']) {
                            case 0:
                                $status = 'Pending';
                                break;
                            case 1:
                                $status = 'Approved';
                                break;
                            case 2:
                                $status = 'Declined';
                                break;
                            default:
                                $status = '';
                        }

                        if($status=='Declined'){
                            $data['declined'] ='- ( <a href="#" class="queue-action declinedsingle" data-id="' . $value2['id'] . '" data-toggle="modal" data-target="#declineSingle">View<a/> )';
                            $tdcontent34_01= (isset($value2['date_declined']))? DateTime::createFromFormat('Y-m-d H:i:s',$value2['date_declined'])->format('Y-M-d H:i:s'):'';
                        }else if($status == 'Approved'){
                            $tdcontent34_01= (isset($value2['date_approved']))?DateTime::createFromFormat('Y-m-d H:i:s',$value2['date_approved'])->format('Y-M-d H:i:s'):'';
                            $data['declined']= '';
                        }else{
                            $tdcontent34_01= 'N/A';
                            $data['declined']= ' ';
                        }

                        $IsDoc2=true;
                        $doc_caption=' ( back )';
                        $tdcontent1_1 ='<br/>&nbsp;&nbsp;&nbsp; '. $value2['client_name'].' '. $doc_caption .'   ';

                        //FXPP-1433 Implement logic of putting Invert options in the Manage Documents of FXPP
                        $trrot1 .= '<tr class="tr1 displayn"><td colspan="5" class="imgr">';
                        $trrot1 .= '<input type="button" class="btnRotate" value="360"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" />';
                        $trrot1 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="90"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90.png'.'"  /></label>';
                        $trrot1 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="-90"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90l.png'.'"  /></label>';
                        $trrot1 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="180"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r180.png'.'"  /></label>';

                        $trrot1 .= '</td></tr>';
                        //FXPP-1433 Implement logic of putting Invert options in the Manage Documents of FXPP

                        $trImg1.= '<label><strong><a class="hit" href="'.$this->config->item('domain-my') . '/assets/user_docs/' . $value2['file_name'] . '" target="_blank">BACK</a></strong></label>
                        <div class="myimage">
                        <img id="img'.$value2['id'].'" src="'.$this->config->item('domain-my').'/assets/user_docs/'.$value2['file_name'].'" class="img'.$value2['user_id'].'  fimage img-responsive acct-ver-img"/>
                        </div>
                        <div class="mylg2">
                        </div>
                        ';

                        //additional
                        $tdcontent1_01.='<button type="button" class="mybutton hitdisplay" data-toggle="collapse" data-target="#collapseme'.$value2['id'].'" data-id="'.$value2['id'].'"> <span id="spn'.$value2['id'].'" class="glyphicon glyphicon-plus"></span>  '. $value2['client_name'].' '. $doc_caption .'<br/>&nbsp;&nbsp;&nbsp; No front copy provided ';
                        $tdcontent2_01.=$status." ".$data['declined'];
                        $tdcontent3_01.= DateTime::createFromFormat('Y-m-d H:i:s',$value2['date_uploaded'])->format('Y-M-d H:i:s');

                        if ($status == lang('declined') or $status == lang('pending')) {
                            $tdcontent4_01.= '<a href="#" id="request-nth-approve'.$value2['id'].'"  data-id="'.$value2['id'].'" class="request-nth-approve queue-action"  data-target="#viewAcct">'.lang('modal_apprv').'</a>';
                        }
                        if ($status==lang('pending')){
                            $tdcontent4_01.= ' | ';
                        }
                        if ($status=='Approved' or $status==lang('pending')){
                            $tdcontent4_01.= '<a href="#" id="request-nth-decline'.$value2['id'].'"  data-id="'.$value2['id'].'"  data-toggle="modal" data-target="#popAccountVerificationDecline"  class=" queue-action modal-nth-decline"  data-target="#viewAcct">'.lang('modal_dcln').'</a>';
                        }


                        //FXPP-1433 Implement logic of putting Invert options in the Manage Documents of FXPP
                        $trrot01 .= '<tr class="tr1 displayn"><td colspan="5" class="imgr">';
                        $trrot01 .= '<input type="button" class="btnRotate" value="360"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" />';
                        $trrot01 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="90"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90.png'.'"  /></label>';
                        $trrot01 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="-90"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90l.png'.'"  /></label>';
                        $trrot01 .= '<label class="curp"><input type="button" class="btnRotate displayn" value="180"  name="img'.$value2['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r180.png'.'"  /></label>';

                        $trrot01 .= '</td></tr>';
                        //FXPP-1433 Implement logic of putting Invert options in the Manage Documents of FXPP

                        $trImg01.= '<tr id="collapseme'.$value2['id'].'" class="collapse lg1"><td colspan="4" ><div class="avlabel">';
                        $trImg01.= '<label><strong><a class="hit" href="'.$this->config->item('domain-my') . '/assets/user_docs/' . $value2['file_name'] . '" target="_blank">BACK</a></strong></label>
                        <div class="myimage">
                         <img id="img'.$value2['id'].'" src="'.$this->config->item('domain-my').'/assets/user_docs/'.$value2['file_name'].'" class="img'.$value2['user_id'].'  fimage img-responsive acct-ver-img"/>
                        </div>
                        <div class="mywatermark">
                        </div>
                        ';

                    }

                }

                if ($tdcontent1_0==''){ // no front document
                    $tdcontent1 .= $tdcontent1_01;
                    $tdcontent2 .= $tdcontent2_01;
                    $tdcontent3 .= $tdcontent3_01;
                    $tdcontent34 .=$tdcontent34_01;
                    $tdcontent4 .= $tdcontent4_01;

                    $trImg = $trrot01.$trImg01;
                    $trImg .= '</div></td></tr>';
                }else{ // with both document
                    $tdcontent1.=$tdcontent1_0.$tdcontent1_1;
                    $tdcontent2.=$tdcontent2_0.$tdcontent2_1;
                    $tdcontent3.=$tdcontent3_0.$tdcontent3_1;
                    $tdcontent34.=$tdcontent34_0.$tdcontent34_1;
                    $tdcontent4.=$tdcontent4_0.$tdcontent4_1;
                    $trImg = $trrot0.$trImg0 .$trImg1;
                    $trImg .= '</div></td></tr>';
                    $trImg .= $trrot1;
                }

                $tdcontent1.='</button></td></td>';
                $tdcontent2.='</td>';
                $tdcontent3.='</td>';
                $tdcontent34.='</td>';
                $tdcontent4.='</td>';
                $tdcontentall=$tdcontent1.$tdcontent2.$tdcontent3.$tdcontent34.$tdcontent4;

                $data['data']['fdx'] .= '<tr id="tr" class="fdocument">'.$tdcontentall.'</tr>';
                $data['data']['fdx'] .= $trImg;
            }
        }

        $data['data']['fd']=$data['data']['fdx'];
        unset($data['data']['fdx']);
        return  $data['data']['fd'];
        unset($data);
    }

    private function doc2($userid){
        $data['userid']=$userid;
        $data['doc2'] = $this->g_m->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='2',$select='*');

        $data['data']['sd'] ='';

        foreach (array_reverse($data['doc2'], true) as $key => $value) {

            switch ($value['status']) {
                case 0:
                    $status = 'Pending';
                    break;
                case 1:
                    $status = 'Approved';
                    break;
                case 2:
                    $status = 'Declined';
                    break;
                default:
                    $status = '';
            }
            if($status=='Declined'){

                $data['declined'] ='- ( <a href="#" class="queue-action declinedsingle" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#declineSingle">View<a/> )';

                $data['FXPP_1358_1359'] = (isset($value['date_declined']))?DateTime::createFromFormat('Y-m-d H:i:s',$value['date_declined'])->format('Y-M-d H:i:s'):'';

            }else if($status=='Approved'){
                $data['FXPP_1358_1359'] =(isset($value['date_approved']))? DateTime::createFromFormat('Y-m-d H:i:s',$value['date_approved'])->format('Y-M-d H:i:s'): '';
                $data['declined']= '';
            }else{
                $data['FXPP_1358_1359'] = 'N/A';
                $data['declined']= ' ';
            }

            $value['date_uploaded'] = DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded'])->format('Y-M-d H:i:s');
            
            $data['data']['sd'] .= '<tr id="tr' . $value['id'] . '" class="tr' . $value['user_id'] . ' sdocument ">';
            $data['data']['sd'] .= '<td><button type="button" class="mybutton hitdisplay" data-toggle="collapse" data-target="#collapseme' . $value['id'] . '" data-id="' . $value['id'] . '"> <span id="spn' . $value['id'] . '" class="glyphicon glyphicon-plus"></span> ' . $value['client_name'] . '</button></td>';
            $data['data']['sd'] .= '<td >' . $status ." ".$data['declined']. '</td>';
            $data['data']['sd'] .= '<td>' . $value['date_uploaded'] . '</td>';
            $data['data']['sd'] .= '<td>' . $data['FXPP_1358_1359'] . '</td>';
            $data['data']['sd'] .= '<td>';
            if ($status == lang('declined') or $status == lang('pending')) {
                $data['data']['sd'] .= '<a href="#" id="request-nth-approve' . $value['id'] . '"  data-id="' . $value['id'] . '" class="request-nth-approve queue-action"  data-target="#viewAcct">' . lang('modal_apprv') . '</a>';
            }
            if ($status == lang('pending')) {
                $data['data']['sd'] .= ' | ';
            }
            if ($status == 'Approved' or $status == lang('pending')) {
                $data['data']['sd'] .= '<a href="#" id="request-nth-decline' . $value['id'] . '"  data-id="' . $value['id'] . '"  data-toggle="modal" data-target="#popAccountVerificationDecline"  class=" queue-action modal-nth-decline"  data-target="#viewAcct">' . lang('modal_dcln') . '</a></td>';
            }
            $data['data']['sd'] .= '</tr>';

            $data['data']['sd'] .= '<tr class="tr2 displayn"><td colspan="5" class="imgr">';
            $data['data']['sd'] .= '<input type="button" class="btnRotate" value="360"  name="img'.$value['id'].'" onClick="rotateImage(this.value,this.name);" />';
            $data['data']['sd'] .= '<label class="curp"><input type="button" class="btnRotate displayn" value="90"  name="img'.$value['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90.png'.'"  /></label>';
            $data['data']['sd'] .= '<label class="curp"><input type="button" class="btnRotate displayn" value="-90"  name="img'.$value['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r90l.png'.'"  /></label>';
            $data['data']['sd'] .= '<label class="curp"><input type="button" class="btnRotate displayn" value="180"  name="img'.$value['id'].'" onClick="rotateImage(this.value,this.name);" /><img src="'.$this->template->Images().'r180.png'.'"  /></label>';
            $data['data']['sd'] .= '</td></tr>';


            $data['data']['sd'] .= '<tr id="collapseme' . $value['id'] . '" class="collapse lg1"><td colspan="4" ><div class="avlabel">';
            $data['data']['sd'] .= '<label><strong><a class="hit" href="'.$this->config->item('domain-my') . '/assets/user_docs/' . $value['file_name'] . '" target="_blank">'.$value['client_name'].'</a></strong></label>
            <div class="myimage">
                <img id="img' . $value['id'] . '" src="' . $this->config->item('domain-my') . '/assets/user_docs/' . $value['file_name'] . '" class="img' . $value['user_id'] . '  fimage img-responsive acct-ver-img"/>
            </div>
            <div class="mywatermark">
            </div>

            ';
            $data['data']['sd'] .= '</div></td></tr>';

        }
        return $data['data']['sd'];
        unset($data);
    }

    public function Pending_doc(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $data['userid'] = $this->input->post('userid');

        $this->db->trans_start();

        $data['doc0'] = $this->g_m->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='0',$select='*');
        $data['doc1'] = $this->g_m->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='1',$select='*');
        $data['doc2'] = $this->g_m->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='2',$select='*');


        if (count($data['doc0'])>1){
            foreach (array_reverse($data['doc0'], true) as $key => $value) {
                $this->g_m->updatemydocs($table = "user_documents",$field1 = "user_id", $id1=$data['userid'],$field2='id',$id2=$value['id'],array( 'uploadset' => $key));
            }
        }

        if (count($data['doc1'])>1){

            foreach (array_reverse($data['doc1'], true) as $key => $value) {
                $this->g_m->updatemydocs($table = "user_documents",$field1 = "user_id", $id1=$data['userid'],$field2='id',$id2=$value['id'],array( 'uploadset' => $key));
            }
        }

        if (count($data['doc2'])>1){

            foreach (array_reverse($data['doc2'], true) as $key => $value) {
                $this->g_m->updatemydocs($table = "user_documents",$field1 = "user_id", $id1=$data['userid'],$field2='id',$id2=$value['id'],array( 'uploadset' => $key));
            }
        }

        $data['data']['fd']=$this->doc1($data['userid']);
        $data['data']['sd']=$this->doc2($data['userid']);
        $this->db->trans_complete();
        echo json_encode($data['data']);
        unset($data);

    }

    //decline clients
    public function AccountVerificationDecline(){

        $this->form_validation->set_rules('SelectReason', 'decline reason', 'trim|xss_clean');
        $this->form_validation->set_rules('location', 'account verification tab', 'trim|xss_clean');
        $this->form_validation->set_rules('DocId', 'Document ID', 'trim|xss_clean');
        $this->form_validation->set_rules('explanation', 'explanation', 'trim|xss_clean');

        if ($this->form_validation->run()) {

            $data['reason'] = $this->input->post('SelectReason');
            $data['location'] = $this->input->post('location');
            $data['explanation'] = $this->input->post('explanation');
            $data['explanation'] = (trim($data['explanation'])!='')?$data['explanation']:'N/A';

            $data['DocumentID'] = $this->input->post('DocId');


            $options = array(
                '0'    => 'Account holder did not reached the age limit.',
                '1'    => 'Address provided and address on document do not match.',
                '2'    => 'Document is altered or modified without proper certification from issuer.',
                '3'    => 'Document is corrupt and cannot be opened.',
                '4'    => 'Document is expired.',

                '5'    => 'Document is password protected.',
                '6'    => 'Document presented page mismatch.',
                '7'    => 'Document presented shows a photo without identity details.',
                '8'    => 'Document presented shows no proof of identity.',
                '9'    => 'Document scanned from the wrong side.',

                '10'    => 'Document shows lack of issuer signatures.',
                '11'    => 'Document shows no country of issuance.',
                '12'    => 'Document shows no signature of the account holder.',
                '13'    => 'Invalid document.',
                '14'    => 'Low resolution scanned document.',

                '15'    => 'Missing pages on scanned document.',
                '16'    => 'Name of the account holder and name on the document mismatch.',
                '17'    => 'No images found on the scanned document.',
                '18'    => 'No second document submitted.',
                '19'    => 'Poor quality scanned document.',

                '20'    => 'Poor quality scanned images.',
                '21'    => 'Same document submitted on the previous.',
                '22'    => 'Translation required.',
            );


            $data['update'] = array(
                'decline_reason'=> $data['reason'],
                'decline_explained'=> $data['explanation'],
                'status'=> '2',
                'date_declined'=>  date('Y-m-d H:i:s')
            );

            $this->db->trans_start();
            $data['data']['return'] = $this->g_m->updatemy($table="user_documents","id",$data['DocumentID'],$data['update']);
            $data['DocInfo'] = $this->g_m->showssingle($table="user_documents","id",$data['DocumentID'],"*",'');

            if ($data['DocInfo']['doc_type']==0){
                $data['check'] = $this->g_m->showssinglesecond($table = "user_documents", "uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'], 'doc_type',1, "*", '');
                if ($data['check']!=false){
                    $data['data']['return2'] = $this->g_m->updatemysecond($table="user_documents","uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'],'doc_type',1,$data['update']);
                }
            }else if($data['DocInfo']['doc_type']==1){
                $data['check'] = $this->g_m->showssinglesecond($table = "user_documents", "uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'], 'doc_type',0, "*", '');
                if ($data['check']!=false){
                    $data['data']['return2'] = $this->g_m->updatemysecond($table="user_documents","uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'],'doc_type',0,$data['update']);
                }
            }

            if($data['data']['return']){


                $data['UserInfo'] = $this->g_m->showssingle($table="users","id",$data['DocInfo']['user_id'],"email",'');
                $data['ProfileInfo'] = $this->g_m->showssingle($table="user_profiles","user_id",$data['DocInfo']['user_id'],"full_name",'');
                $data['MtAccountsSet'] = $this->g_m->showssingle($table="mt_accounts_set","user_id",$data['DocInfo']['user_id'],"account_number",'');

                $prvt_data['vdoc0nostatus'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) ");
                $prvt_data['vdoc1nostatus'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) ");
                $prvt_data['vdoc2nostatus'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) ");

                $prvt_data['vdoc0'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='2')");
                $prvt_data['vdoc1'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='2')");
                $prvt_data['vdoc2'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='2')");

                $prvt_data['vdoc0a'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='1')");
                $prvt_data['vdoc1a'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='1')");
                $prvt_data['vdoc2a'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='1')");

                $prvt_data['notalldeclined'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (status!='2')");

                $doc1_count = floatval($prvt_data['vdoc0nostatus'][0]['count'])+floatval($prvt_data['vdoc1nostatus'][0]['count']);
                $data['data']['counts00']=$prvt_data['vdoc0nostatus'][0]['count'];
                $data['data']['counts01']=$prvt_data['vdoc1nostatus'][0]['count'];
                $data['data']['counts02']=$prvt_data['vdoc2nostatus'][0]['count'];
                $data['data']['counts0']=$doc1_count;
//doc 1  none doc2 declined
                if ( $doc1_count ==0 and $prvt_data['vdoc2'][0]['count']>0 ) {
                    $data['data']['counts1']=true;
                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);

                    $data['mts_update'] = array(
                        'mt_status' => ''
                    );
                    $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['DocInfo']['user_id'], $data['mts_update']);


                    $data['data'] = array(
                        'move' => true
                    );

                }
//doc 2  none doc1 declined
                $data['data']['counts04']=$prvt_data['vdoc0'][0]['count'];
                $data['data']['counts05']=$prvt_data['vdoc1'][0]['count'];
                if ( $prvt_data['vdoc2nostatus'][0]['count'] ==0 and ($prvt_data['vdoc0'][0]['count']>0 or $prvt_data['vdoc1'][0]['count']>0)) {
                    $data['data']['counts2']=true;
                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);

                    $data['mts_update'] = array(
                        'mt_status' => ''
                    );
                    $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['DocInfo']['user_id'], $data['mts_update']);


                    $data['data'] = array(
                        'move' => true
                    );

                }


                if (($prvt_data['vdoc0a'][0]['count'] > 0 or $prvt_data['vdoc1a'][0]['count'] > 0) and $prvt_data['vdoc2'][0]['count'] > 0){
                    $data['mts_update'] = array(
                        'mt_status' => ''
                    );
                    $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['DocInfo']['user_id'], $data['mts_update']);

                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
                }
                if (($prvt_data['vdoc0'][0]['count'] > 0 or $prvt_data['vdoc1'][0]['count'] > 0) and $prvt_data['vdoc2a'][0]['count'] > 0){
                    $data['mts_update'] = array(
                        'mt_status' => ''
                    );
                    $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['DocInfo']['user_id'], $data['mts_update']);

                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);

                }


                $this->load->library('Fx_mailer', null);

                if ( (($prvt_data['vdoc0'][0]['count'] > 0 ) or ($prvt_data['vdoc1'][0]['count'] > 0 ))  and ($prvt_data['vdoc2'][0]['count'] > 0) ) {
                    //FXPP-868
                    $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                    $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                    $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','2',"*",'');

                    if ($data['DocType1']==false){
                        $data['DocType1']['client_name']='';
                        $data['DocType1']['file_name']='';
                        $data['DocType1']['doc_type']='';
                        $data['doc1decline_reason']=$data['DocType0']['decline_reason'];
                        $data['doc1decline_explained']=$data['DocType0']['decline_explained'];
                    }else{
                        $data['doc1decline_reason']=$data['DocType1']['decline_reason'];
                        $data['doc1decline_explained']=$data['DocType1']['decline_explained'];
                    }


                    $data['senddata'] = array(
                        'SelectedReason' => $options[$data['doc1decline_reason']] ,
                        'ReasonExplanation' => $data['doc1decline_explained'],
                        'SelectedReason2' => $options[$data['DocType2']['decline_reason']] ,
                        'ReasonExplanation2' => $data['DocType2']['decline_explained'],
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

                    Fx_mailer::AccountVerificationDeclinedBothDocuments($data['senddata']);
                    $data['mts_update'] = array(
                        'mt_status' => ''
                    );
                    $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['DocInfo']['user_id'], $data['mts_update']);


                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
                    $data['data'] = array(
                        'move' => true
                    );

                }else{
                    if ($data['DocInfo']['doc_type'] == 2) {
                        //FXPP-866
                        $data['DocType0'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                        $data['DocType1'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                        $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','2',"*",'');
                        if (!$data['DocType0']){}
                        $data['senddata'] = array(
                            'SelectedReason' => $options[$data['reason']] ,
                            'ReasonExplanation' => $data['explanation'],
                            'Email' => $data['UserInfo']['email'],
                            'AccountNumber' => $data['MtAccountsSet']['account_number'],
                            'FullName' => $data['ProfileInfo']['full_name'],

                            'ClientName0' => ( $data['DocType0']==false ) ? 'N/A ': $data['DocType0']['client_name'],
                            'FileName0' => ( $data['DocType0']==false ) ? 'N/A ':  $data['DocType0']['file_name'],
                            'DocIdx0' => ( $data['DocType0']==false ) ? 'N/A ':  $data['DocType0']['doc_type'],

                            'ClientName1' => ( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['client_name'],
                            'FileName1' => ( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['file_name'],
                            'DocIdx1' => ( $data['DocType1']==false ) ? 'N/A ': $data['DocType1']['doc_type'],

                            'ClientName2' => ( $data['DocType2']==false ) ? 'N/A ' : $data['DocType2']['client_name'],
                            'FileName2' => ( $data['DocType2']==false ) ? 'N/A ' : $data['DocType2']['file_name'],
                            'DocIdx2' => ( $data['DocType2']==false ) ? 'N/A ' : $data['DocType2']['doc_type']
                        );

                        Fx_mailer::AccountVerificationDeclined2ndDocuments($data['senddata']);
//                        $data['verify']=array(
//                            'accountstatus'=>2
//                        );
//                        $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
//                        $data['data'] = array(
//                            'move' => true
//                        );
                    } else {
                        //FXPP-867
                        if($data['DocInfo']['doc_type'] ==0){
                            $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                            $data['DocType1'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                        }else{
                            $data['DocType0'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                            $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                        }

                        $data['DocType2'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','2',"*",'');

                        $data['senddata'] = array(
                            'SelectedReason' => $options[$data['reason']] ,
                            'ReasonExplanation' => $data['explanation'],
                            'Email' => $data['UserInfo']['email'],
                            'AccountNumber' => $data['MtAccountsSet']['account_number'],
                            'FullName' => $data['ProfileInfo']['full_name'],

                            'ClientName0' => ( $data['DocType0']==false ) ? 'N/A ' :$data['DocType0']['client_name'],
                            'FileName0' => ( $data['DocType0']==false ) ? 'N/A ' :$data['DocType0']['file_name'],
                            'DocIdx0' => ( $data['DocType0']==false ) ? 'N/A ' :$data['DocType0']['doc_type'],

                            'ClientName1' => ( $data['DocType1']==false ) ? 'N/A ' :$data['DocType1']['client_name'],
                            'FileName1' =>( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['file_name'],
                            'DocIdx1' =>( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['doc_type'],

                            'ClientName2' => ( $data['DocType2']==false ) ? 'N/A ' :$data['DocType2']['client_name'],
                            'FileName2' => ( $data['DocType2']==false ) ? 'N/A ' :$data['DocType2']['file_name'],
                            'DocIdx2' => ( $data['DocType2']==false ) ? 'N/A ' :$data['DocType2']['doc_type']
                        );

                        Fx_mailer::AccountVerificationDeclined1stDocuments($data['senddata']);
//                        $data['verify']=array(
//                            'accountstatus'=>2
//                        );
//                        $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
//                        $data['data'] = array(
//                            'move' => true
//                        );
                    }
                }

            }

            $this->db->trans_complete();
            echo json_encode($data['data']);

        }
    }

    //decline affiliates
    public function AccountVerificationDecline_aff(){
        //decline documents.
        $this->form_validation->set_rules('SelectReasons', 'decline reason', 'trim|xss_clean');
        $this->form_validation->set_rules('location', 'account verification tab', 'trim|xss_clean');
        $this->form_validation->set_rules('DocId', 'Document ID', 'trim|xss_clean');
        $this->form_validation->set_rules('explanations', 'explanations', 'trim|xss_clean');

        if ($this->form_validation->run()) {

            $data['reason'] = $this->input->post('SelectReasons');
            $data['location'] = $this->input->post('location');
            $data['explanation'] = $this->input->post('explanations');
            $data['explanation'] = (trim($data['explanation'])!='')? $data['explanation']:'N/A';
            $data['DocumentID'] = $this->input->post('DocId');

            $options = array(
                '0'    => 'Account holder did not reached the age limit.',
                '1'    => 'Address provided and address on document do not match.',
                '2'    => 'Document is altered or modified without proper certification from issuer.',
                '3'    => 'Document is corrupt and cannot be opened.',
                '4'    => 'Document is expired.',

                '5'    => 'Document is password protected.',
                '6'    => 'Document presented page mismatch.',
                '7'    => 'Document presented shows a photo without identity details.',
                '8'    => 'Document presented shows no proof of identity.',
                '9'    => 'Document scanned from the wrong side.',

                '10'    => 'Document shows lack of issuer signatures.',
                '11'    => 'Document shows no country of issuance.',
                '12'    => 'Document shows no signature of the account holder.',
                '13'    => 'Invalid document.',
                '14'    => 'Low resolution scanned document.',

                '15'    => 'Missing pages on scanned document.',
                '16'    => 'Name of the account holder and name on the document mismatch.',
                '17'    => 'No images found on the scanned document.',
                '18'    => 'No second document submitted.',
                '19'    => 'Poor quality scanned document.',

                '20'    => 'Poor quality scanned images.',
                '21'    => 'Same document submitted on the previous.',
                '22'    => 'Translation required.',
            );


            $data['update'] = array(
                'decline_reason'=> $data['reason'],
                'decline_explained'=> ($data['explanation']!='')?$data['explanation']:'N/A',
                'status'=> '2',
                'date_declined'=>  date('Y-m-d H:i:s')
            );

            $this->db->trans_start();

            $data['data']['return'] = $this->g_m->updatemy($table="user_documents","id",$data['DocumentID'],$data['update']);
            $data['DocInfo'] = $this->g_m->showssingle($table="user_documents","id",$data['DocumentID'],"*",'');

            if ($data['DocInfo']['doc_type']==0){
                $data['check'] = $this->g_m->showssinglesecond($table = "user_documents", "uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'], 'doc_type',1, "*", '');
                if ($data['check']!=false){
                    $data['data']['return2'] = $this->g_m->updatemysecond($table="user_documents","uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'],'doc_type',1,$data['update']);
                }
            }else if($data['DocInfo']['doc_type']==1){
                $data['check'] = $this->g_m->showssinglesecond($table = "user_documents", "uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'], 'doc_type',0, "*", '');
                if ($data['check']!=false){
                    $data['data']['return2'] = $this->g_m->updatemysecond($table="user_documents","uploadset",$data['DocInfo']['uploadset'],'user_id',$data['DocInfo']['user_id'],'doc_type',0,$data['update']);
                }
            }

            if($data['data']['return']){

                $data['UserInfo'] = $this->g_m->showssingle($table="users","id",$data['DocInfo']['user_id'],"email",'');
                $data['ProfileInfo'] = $this->g_m->showssingle($table="user_profiles","user_id",$data['DocInfo']['user_id'],"full_name",'');
                $data['partnership'] = $this->g_m->showssingle($table="partnership","partner_id",$data['DocInfo']['user_id'],"reference_num",'');

                $prvt_data['vdoc0nostatus'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) ");
                $prvt_data['vdoc1nostatus'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) ");
                $prvt_data['vdoc2nostatus'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) ");

                $prvt_data['vdoc0'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='2')");
                $prvt_data['vdoc1'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='2')");
                $prvt_data['vdoc2'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='2')");

                $prvt_data['vdoc0a'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='1')");
                $prvt_data['vdoc1a'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='1')");
                $prvt_data['vdoc2a'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='1')");

                $prvt_data['notalldeclined'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (status!='2')");

                $this->load->library('Fx_mailer', null);

                $doc1_count = floatval($prvt_data['vdoc0nostatus'][0]['count'])+floatval($prvt_data['vdoc1nostatus'][0]['count']);
                $data['data']['counts00']=$prvt_data['vdoc0nostatus'][0]['count'];
                $data['data']['counts01']=$prvt_data['vdoc1nostatus'][0]['count'];
                $data['data']['counts02']=$prvt_data['vdoc2nostatus'][0]['count'];
                $data['data']['counts0']=$doc1_count;
//doc 1  none doc2 declined
                if ( $doc1_count ==0 and $prvt_data['vdoc2'][0]['count']>0 ) {
                    $data['data']['counts1']=true;
                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
                    $data['data'] = array(
                        'move' => true
                    );

                }
//doc 2  none doc1 declined
                $data['data']['counts04']=$prvt_data['vdoc0'][0]['count'];
                $data['data']['counts05']=$prvt_data['vdoc1'][0]['count'];
                if ( $prvt_data['vdoc2nostatus'][0]['count'] ==0 and ($prvt_data['vdoc0'][0]['count']>0 or $prvt_data['vdoc1'][0]['count']>0)) {
                    $data['data']['counts2']=true;
                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
                    $data['data'] = array(
                        'move' => true
                    );

                }


                if (($prvt_data['vdoc0a'][0]['count'] > 0 or $prvt_data['vdoc1a'][0]['count'] > 0) and $prvt_data['vdoc2'][0]['count'] > 0){
                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
                }

                if (($prvt_data['vdoc0'][0]['count'] > 0 or $prvt_data['vdoc1'][0]['count'] > 0) and $prvt_data['vdoc2a'][0]['count'] > 0){
                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);

                }

                if ( (($prvt_data['vdoc0'][0]['count'] > 0 ) or ($prvt_data['vdoc1'][0]['count'] > 0 ))  and ($prvt_data['vdoc2'][0]['count'] > 0) ) {
                    //FXPP-868
                    $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                    $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                    $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','2',"*",'');

                    if ($data['DocType1']==false){
                        $data['DocType1']['client_name']='N/A';
                        $data['DocType1']['file_name']='N/A';
                        $data['DocType1']['doc_type']='N/A';
                        $data['doc1decline_reason']=$data['DocType0']['decline_reason'];
                        $data['doc1decline_explained']=$data['DocType0']['decline_explained'];
                    }else{
                        $data['doc1decline_reason']=$data['DocType1']['decline_reason'];
                        $data['doc1decline_explained']=$data['DocType1']['decline_explained'];
                    }


                    $data['senddata'] = array(
                        'SelectedReason' => $options[$data['doc1decline_reason']] ,
                        'ReasonExplanation' => $data['doc1decline_explained'],
                        'SelectedReason2' => $options[$data['DocType2']['decline_reason']] ,
                        'ReasonExplanation2' => $data['DocType2']['decline_explained'],

                        'Email' => $data['UserInfo']['email'],
                        'AccountNumber' => $data['partnership']['reference_num'],
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

                    Fx_mailer::AccountVerificationDeclinedBothDocuments($data['senddata']);


                    $data['verify']=array(
                        'accountstatus'=>2
                    );
                    $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
                    $data['data'] = array(
                        'move' => true
                    );

                }else{
                    if ($data['DocInfo']['doc_type'] == 2) {
                        //FXPP-866
                        $data['DocType0'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                        $data['DocType1'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                        $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','2',"*",'');
                        if (!$data['DocType0']){}
                        $data['senddata'] = array(
                            'SelectedReason' => $options[$data['reason']] ,
                            'ReasonExplanation' => $data['explanation'],
                            'Email' => $data['UserInfo']['email'],
                            'AccountNumber' => $data['partnership']['reference_num'],
                            'FullName' => $data['ProfileInfo']['full_name'],

                            'ClientName0' => ( $data['DocType0']==false ) ? 'N/A ': $data['DocType0']['client_name'],
                            'FileName0' => ( $data['DocType0']==false ) ? 'N/A ':  $data['DocType0']['file_name'],
                            'DocIdx0' => ( $data['DocType0']==false ) ? 'N/A ':  $data['DocType0']['doc_type'],

                            'ClientName1' => ( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['client_name'],
                            'FileName1' => ( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['file_name'],
                            'DocIdx1' => ( $data['DocType1']==false ) ? 'N/A ': $data['DocType1']['doc_type'],

                            'ClientName2' => ( $data['DocType2']==false ) ? 'N/A ' : $data['DocType2']['client_name'],
                            'FileName2' => ( $data['DocType2']==false ) ? 'N/A ' : $data['DocType2']['file_name'],
                            'DocIdx2' => ( $data['DocType2']==false ) ? 'N/A ' : $data['DocType2']['doc_type']
                        );

                        Fx_mailer::AccountVerificationDeclined2ndDocuments($data['senddata']);
//                        $data['verify']=array(
//                            'accountstatus'=>2
//                        );
//                        $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
//                        $data['data'] = array(
//                            'move' => true
//                        );
                    } else {
                        //FXPP-867
                        if($data['DocInfo']['doc_type'] ==0){
                            $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                            $data['DocType1'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                        }else{
                            $data['DocType0'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','2',"*",'');
                            $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','2',"*",'');
                        }

                        $data['DocType2'] = $this->g_m->show1st1w2($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','2',"*",'');

                        $data['senddata'] = array(
                            'SelectedReason' => $options[$data['reason']] ,
                            'ReasonExplanation' => $data['explanation'],
                            'Email' => $data['UserInfo']['email'],
                            'AccountNumber' => $data['partnership']['reference_num'],
                            'FullName' => $data['ProfileInfo']['full_name'],

                            'ClientName0' => ( $data['DocType0']==false ) ? 'N/A ' :$data['DocType0']['client_name'],
                            'FileName0' => ( $data['DocType0']==false ) ? 'N/A ' :$data['DocType0']['file_name'],
                            'DocIdx0' => ( $data['DocType0']==false ) ? 'N/A ' :$data['DocType0']['doc_type'],

                            'ClientName1' => ( $data['DocType1']==false ) ? 'N/A ' :$data['DocType1']['client_name'],
                            'FileName1' =>( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['file_name'],
                            'DocIdx1' =>( $data['DocType1']==false ) ? 'N/A ' : $data['DocType1']['doc_type'],

                            'ClientName2' => ( $data['DocType2']==false ) ? 'N/A ' :$data['DocType2']['client_name'],
                            'FileName2' => ( $data['DocType2']==false ) ? 'N/A ' :$data['DocType2']['file_name'],
                            'DocIdx2' => ( $data['DocType2']==false ) ? 'N/A ' :$data['DocType2']['doc_type']
                        );

                        Fx_mailer::AccountVerificationDeclined1stDocuments($data['senddata']);
//                        $data['verify']=array(
//                            'accountstatus'=>2
//                        );
//                        $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
//                        $data['data'] = array(
//                            'move' => true
//                        );
                    }
                }

            }

            $this->db->trans_complete();

            echo json_encode($data['data']);

        }
    }
    //approve clients
    public function documentverificationchangestatus(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $data['data'] = array(
            'id'=>$this->input->post('id'),
            'status'=>$this->input->post('select'),
            'date_approved'=> Date('Y-m-d H:i:s')
        );

        $this->db->trans_start();

        $data['data']['return'] = $this->g_m->updatemy($table="user_documents","id",$this->input->post('id'),$data['data']);

        $data['DocInfo'] = $this->g_m->showssingle($table="user_documents","id",$data['data']['id'],"*",'');


        if($data['DocInfo']['doc_type']==0){

            $data['data'] = array(
                'status'=>1,
            );

            $data['data']['x'] = $this->g_m->updatet1w3($table="user_documents",$field1="user_id",$id1=$data['DocInfo']['user_id'],$field2="uploadset",$id2=$data['DocInfo']['uploadset'],$field3="doc_type",$id3=1,$data['data']);

        }else if($data['DocInfo']['doc_type']==1) {

            $data['data'] = array(

                'status'=>1
            );

            $data['data']['x'] = $this->g_m->updatet1w3($table="user_documents",$field1="user_id",$id1=$data['DocInfo']['user_id'],$field2="uploadset",$id2=$data['DocInfo']['uploadset'],$field3="doc_type",$id3=1,$data['data']);

        }

        $data['UserInfo'] = $this->g_m->showssingle($table="users","id",$data['DocInfo']['user_id'],"email",'');
        $data['ProfileInfo'] = $this->g_m->showssingle($table="user_profiles","user_id",$data['DocInfo']['user_id'],"full_name",'');
        $data['MtAccountsSet'] = $this->g_m->showssingle($table="mt_accounts_set","user_id",$data['DocInfo']['user_id'],"account_number",'');


        $prvt_data['vdoc0'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='1')");
        $prvt_data['vdoc1'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='1')");
        $prvt_data['vdoc2'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='1')");

        $prvt_data['vdoc0d'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='2')");
        $prvt_data['vdoc1d'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='2')");
        $prvt_data['vdoc2d'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='2')");


        if (($prvt_data['vdoc0d'][0]['count'] > 0 or $prvt_data['vdoc1d'][0]['count'] > 0) and $prvt_data['vdoc2'][0]['count'] > 0){
            $data['verify']=array(
                'accountstatus'=>2
            );
            $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
        }

        if (($prvt_data['vdoc0'][0]['count'] > 0 or $prvt_data['vdoc1'][0]['count'] > 0) and $prvt_data['vdoc2d'][0]['count'] > 0){
            $data['verify']=array(
                'accountstatus'=>2
            );
            $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);

        }


        if ( (($prvt_data['vdoc0'][0]['count'] > 0) or ($prvt_data['vdoc1'][0]['count'] > 0)) and ($prvt_data['vdoc2'][0]['count'] >0)){
            // both doc 1 2 and 3 are approved.
            // FXPP-865
            $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','1',"*",'');
            $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','1',"*",'');
            $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','1',"*",'');

            if ($data['DocType1']==false){
                $data['DocType1']['client_name']='';
                $data['DocType1']['file_name']='';
                $data['DocType1']['doc_type']='';
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

            $webservice_config = array(
                'server' => 'live_new'
            );
            $WebService = new WebService($webservice_config);

            $account_info = array(
                'AccountNumber' => $data['MtAccountsSet']['account_number']
            );

            $WebService->open_ActivateAccountTrading($account_info);

            if( $WebService->request_status === 'RET_OK' ) {

                Fx_mailer::AccountVerificationVerifiedUser($data['senddata']);
                $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                $data['verify'] = array(
                    'accountstatus' => 1,
                    'verified' => $data['DateUp']->format('Y-m-d H:i:s')
                );
                $this->g_m->updatemy($table = "users", "id", $data['DocInfo']['user_id'], $data['verify']);
                $data['mts_update'] = array(
                    'mt_status' => 1
                );
                $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['DocInfo']['user_id'], $data['mts_update']);

                $data['data'] = array(
                    'move' => true
                );
                $this->db->trans_complete();
            }else{
                $this->db->trans_rollback();
                $data['data']['error']='verification error in API';
            }
        }else{
            $data['data']['error']='';
            $this->db->trans_complete();
        }

        echo json_encode($data['data']);
    }
    //approved affiliates
    public function documentverificationchangestatus_aff(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $data['data'] = array(
            'id'=>$this->input->post('id'),
            'status'=>$this->input->post('select'),
            'date_approved'=>  date('Y-m-d H:i:s')
        );

        $this->db->trans_start();

        $data['data']['return'] = $this->g_m->updatemy($table="user_documents","id",$this->input->post('id'),$data['data']);


        $data['DocInfo'] = $this->g_m->showssingle($table="user_documents","id",$data['data']['id'],"*",'');

        if($data['DocInfo']['doc_type']==0){

            $data['data'] = array(
                'status'=>1,
            );

            $data['data']['x'] = $this->g_m->updatet1w3($table="user_documents",$field1="user_id",$id1=$data['DocInfo']['user_id'],$field2="uploadset",$id2=$data['DocInfo']['uploadset'],$field3="doc_type",$id3=1,$data['data']);

        }else if($data['DocInfo']['doc_type']==1) {

            $data['data'] = array(

                'status'=>1
            );

            $data['data']['x'] = $this->g_m->updatet1w3($table="user_documents",$field1="user_id",$id1=$data['DocInfo']['user_id'],$field2="uploadset",$id2=$data['DocInfo']['uploadset'],$field3="doc_type",$id3=1,$data['data']);

        }

        $data['UserInfo'] = $this->g_m->showssingle($table="users","id",$data['DocInfo']['user_id'],"email",'');
        $data['ProfileInfo'] = $this->g_m->showssingle($table="user_profiles","user_id",$data['DocInfo']['user_id'],"full_name",'');
        $data['partnership'] = $this->g_m->showssingle($table="partnership","partner_id",$data['DocInfo']['user_id'],"reference_num",'');

        $prvt_data['vdoc0'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='1')");
        $prvt_data['vdoc1'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='1')");
        $prvt_data['vdoc2'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='1')");


        $prvt_data['vdoc0d'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 0 ) AND (status='2')");
        $prvt_data['vdoc1d'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 1 ) AND (status='2')");
        $prvt_data['vdoc2d'] = $this->g_m->countmy($table='user_documents',$select='COUNT(*) as count',$where="(user_id=".$data['DocInfo']['user_id'].") and (doc_type = 2 ) AND (status='2')");

        if (($prvt_data['vdoc0d'][0]['count'] > 0 or $prvt_data['vdoc1d'][0]['count'] > 0) and $prvt_data['vdoc2'][0]['count'] > 0){
            $data['verify']=array(
                'accountstatus'=>2
            );
            $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);
        }
        if (($prvt_data['vdoc0'][0]['count'] > 0 or $prvt_data['vdoc1'][0]['count'] > 0) and $prvt_data['vdoc2d'][0]['count'] > 0){
            $data['verify']=array(
                'accountstatus'=>2
            );
            $this->g_m->updatemy($table="users","id",$data['DocInfo']['user_id'],$data['verify']);

        }


        if ( (($prvt_data['vdoc0'][0]['count'] > 0) or ($prvt_data['vdoc1'][0]['count'] > 0) ) and ($prvt_data['vdoc2'][0]['count'] >0)){
            // both doc 1 2 and 3 are approved.
            // FXPP-865
            $data['DocType0'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','0','status','1',"*",'');
            $data['DocType1'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','1','status','1',"*",'');
            $data['DocType2'] = $this->g_m->show1st1w3($table="user_documents",'user_id',$data['DocInfo']['user_id'],'doc_type','2','status','1',"*",'');

            if ($data['DocType1']==false){
                $data['DocType1']['client_name']='';
                $data['DocType1']['file_name']='';
                $data['DocType1']['doc_type']='';
            }


            $data['senddata'] = array(

                'Email' => $data['UserInfo']['email'],
                'AccountNumber' => $data['partnership']['reference_num'],
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


            $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            Fx_mailer::AccountVerificationVerifiedUser_aff($data['senddata']);
            $data['verify'] = array(
                'accountstatus' => 1,
                'verified' => $data['DateUp']->format('Y-m-d H:i:s')
            );
            $this->g_m->updatemy($table = "users", "id", $data['DocInfo']['user_id'], $data['verify']);

            $data['data'] = array(
                'move' => true
            );

            $this->db->trans_complete();
        }else{
            $data['data']['error']='';
            $this->db->trans_complete();
        }

        echo json_encode($data['data']);
    }
    public function avdeclinenote(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $data['declined_doc']=$this->g_m->showdoc($table='user_documents',$field1='user_id',$id1=intval($this->input->post('userid')),$field2='status',$id2=2,$select='*','');

        $data['data']['t_reason']='';
        if($data['declined_doc']){
            foreach ($data['declined_doc'] as $key => $value) {
                if($value['doc_type']==2){
                    $data['document']='Document 2';
                }else{
                    $data['document']='Document 1';
                }
                $data['data']['t_reason'].='<tr>';
                $data['data']['t_reason'].='<td>'.$data['document'].'</td>';
                $data['data']['t_reason'].='<td class="dnoteC2">'.$value['file_name'].'</td>';
                $data['data']['t_reason'].='<td>'.$this->g_m->getDeclinedReason($value['decline_reason']).'</td>';
                $data['data']['t_reason'].='<td>'.$value['decline_explained'].'</td>';
                $data['data']['t_reason'].='</tr>';
            }
        }


        echo json_encode($data['data']);
        unset($data);
    }
    public function avdeclinednotessingle(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}

        $data['decdoc']=$this->g_m->showssingle2($table='user_documents',$field1='id',$id1=intval($this->input->post('id')),$select='*','');
        $data['data']['s_t_reason']='';
        if($data['decdoc']){
            if($data['decdoc']['doc_type']==2){
                $data['document']='Document 2';
            }else{
                $data['document']='Document 1';
            }
            $data['data']['s_t_reason'].='<tr>';
            $data['data']['s_t_reason'].='<td>'.$data['document'].'</td>';
            $data['data']['s_t_reason'].='<td>'.$data['decdoc']['file_name'].'</td>';
            $data['data']['s_t_reason'].='<td>'.$this->g_m->getDeclinedReason($data['decdoc']['decline_reason']).'</td>';
            $data['data']['s_t_reason'].='<td>'.$data['decdoc']['decline_explained'].'</td>';
            $data['data']['s_t_reason'].='</tr>';
        }
        echo json_encode($data['data']);
        unset($data);
    }
    public function ppp8(){
            echo 1;
    }


}