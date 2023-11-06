<?php

class Query extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Managecontest_model');
        $this->m_c=$this->Managecontest_model;
        $this->load->library('WebService');
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
    }

    function monitor_trades(){
        ini_set('memory_limit', '2048M');
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['from'] = $this->input->post('from');
        $data['from'] = DateTime::createFromFormat('m/d/Y',   $data['from']);
        $data['from']->setTime(00,00,01);
        $data['to'] = $this->input->post('to');
        $data['to'] = DateTime::createFromFormat('m/d/Y',  $data['to']);
        $data['to']->setTime(23,59,59);

        $data['monitor_trades'] = $this->m_c->showt3w2j2SD($table='contestmoneyfall',$table2='users',$table3='mt_accounts_set',$field1='contestmoneyfall.users_id <>',$id1=0,$select='contestmoneyfall.FullName,users.created,mt_accounts_set.account_number',$join12='users.id= contestmoneyfall.users_id',$join23='users.id=mt_accounts_set.user_id',$order='users.created',$data['from']->format('Y-m-d H:i:s'),$data['to']->format('Y-m-d H:i:s'));

        $webservice_config = array(
            'server' => 'demo_new'
        );


        $data['opentime']='';
        $data['date']='';
        $request='';
        if( $data['monitor_trades']) {
            foreach ( $data['monitor_trades'] as $key => $value) {
                $data['from']=  DateTime::createFromFormat('m/d/Y',  $this->input->post('from'));
                $data['to']=  DateTime::createFromFormat('m/d/Y',  $this->input->post('to'));
                $data['from']->setTime(00,00,01);
                $data['to']->setTime(23,59,59);
                $Haccount_info = array(
                    'iLogin' => $value['account_number'],
                    'from' => $data['from']->format('Y-m-d\TH:i:s'),
                    'to' => $data['to']->format('Y-m-d\TH:i:s')
                );
                $data['ticket']='';
                $data['count']=0;
                $WebService = new WebService($webservice_config);
                $WebService->open_GetAccountTradesHistory($Haccount_info);
                switch($WebService->request_status){
                    case 'RET_OK':
                        $tradatalist = (array) $WebService->get_result('TradeDataList');
                        if($tradatalist) {
                            foreach ($tradatalist['TradeData'] as $object) {
                                $data['count']=$data['count']+1;
                                if ($data['count']>5){
                                    $data['ticket'].= $object->OrderTicket.',';
                                }

                                $data['opentime']=$object->OpenTime ;
                            }
                        }
                        $data['ticket']=rtrim( $data['ticket'], ",");
                        $request.= '<tr>';
                        $request.= '<td class="fixwidth">' . $value['account_number'] . '</td>';
                        $request.= '<td class="fixwidth">' . $value['FullName'] . '</td>';


                        $date = DateTime::createFromFormat('Y-m-d\TH:i:s', $object->OpenTIme);

                        if ($data['count']>5){
                            $data['date']=$date->format('Y-M-d H:i:s');
                            $request.= '<td class="fixwidth">' .$date->format('Y-M-d H:i:s') . '</td>';
                        }else{
                            $data['date']='None';
                            $request.= '<td class="fixwidth">' .$data['date'] . '</td>';
                        }

                        if ($data['count']>5){
                            $request.= '<td class="fixwidth">'.$data['ticket'].'</td>';
                        }else{
                            $request.= '<td class="fixwidth">None</td>';
                        }

                        $request.= '</tr>';
                        break;
                    default:
                }

            }
        }
        $data['data']['from']= $data['from']->format('Y-m-d H:i:s');
        $data['data']['to']= $data['to']->format('Y-m-d H:i:s');
        $data['data']['request']= $request;
        echo json_encode($data['data']);
        unset($data);
    }
    function getsymbolprofit(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['account_number'] = $this->input->post('account_number');
        $webservice_config = array(
            'server' => 'demo_new'
        );
        $WebService1 = new WebService($webservice_config);
        $WebService2 = new WebService($webservice_config);

        $account_info = array(
            'iAccount' =>$data['account_number'],
            'strSymbol' =>'USDJPY'
        );
        $WebService1->open_GetSymbolProfitOfAccount($account_info);
        if( $WebService1->request_status === 'RET_OK' ) {
            $data['data']['OverAllProfit1'].=  $WebService1->get_result('OverAllProfit');
            $data['data']['SymbolProfit1'].=  $WebService1->get_result('SymbolProfit');
            $data['data']['SymbolProfitPercentage1'].=  $WebService1->get_result('SymbolProfitPercentage').' %';
        }else{

        }
        $account_info2 = array(
            'iAccount' =>$data['account_number'],
            'strSymbol' =>'EURUSD'
        );
        $WebService2->open_GetSymbolProfitOfAccount($account_info2);
        if( $WebService2->request_status === 'RET_OK' ) {
            $data['data']['OverAllProfit2'].=  $WebService2->get_result('OverAllProfit');
            $data['data']['SymbolProfit2'].=  $WebService2->get_result('SymbolProfit');
            $data['data']['SymbolProfitPercentage2'].=  $WebService2->get_result('SymbolProfitPercentage').' %';
        }else{

        }
        echo json_encode($data['data']);
        unset($data);
    }
    public function av_pending(){
//        Admin::checkUserPermission("pending","acveri");
//        $data['data']['access']= Admin::ManageAccessList();

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
    }
    public function calculate_saldo(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        $data['account_number'] =  str_replace(' ', '', $this->input->post('accountnumbers'));
        $data['from'] = date('Y-m-d\T00:00:00', strtotime($this->input->post('from')));
        $data['to'] =  date('Y-m-d\T23:59:59', strtotime($this->input->post('to')));
        $data['none'] = date('Y-m-d\T00:00:00', strtotime(2015/5/5));
//        print_r($data['account_number']);
//        echo "<br>";
//        print_r($data['from']); echo "<br>";
//        print_r($data['to']); echo "<br>";
//        print_r($data['none']);exit;

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
//            $info1 = $this->General_model->showinfo('mt_accounts_set','*','account_number',$AN_value);
            //            $data['ProfileInfo'] = $this->g_m->showssingle($table = "user_profiles", "user_id", $data['MtAccountsSet']['user_id'], "full_name", '');
//            echo "<pre>";
//            print_r($info1['rows'][0]->user_id);exit;
//            if(count($info1)>0){
//                $data['full_name'] = $this->General_model->showinfo('user_profiles','full_name','user_id', $info1['rows'][0]->user_id)['rows'];
//                $data['full_name'] = $data['full_name'][0]->full_name;
////                print_r( $data['full_name'][0]->full_name );exit;
//            }else{
//                $info1 = $this->General_model->showinfo('partnership','*','reference_num',$AN_value);
//                if(count($info1)>0){
//                    $data['full_name'] = $this->General_model->showinfo('user_profiles','full_name','user_id', $info1['rows'][0]->partner_id)['rows'];
//                    $data['full_name'] = $data['full_name'][0]->full_name;
//                }else{
//                    $info1 = $this->General_model->showinfo('partnership','*','reference_subnum',$AN_value);
//                    if(count($info1)>0){
//                        $data['full_name'] = $this->General_model->showinfo('user_profiles','full_name','user_id', $info1['rows'][0]->partner_id)['rows'];
//                        $data['full_name'] = $data['full_name'][0]->full_name;
//                    }else{
//                        $data['full_name'] = "No name found in the record";
//                    }
//                }
//            }
            $webservice_config = array('server' => 'live_new');
            // accoutns details
            $webservice_config1 = array('server' => 'live_new');
            $WebService1 = new WebService($webservice_config1);
            $accountinfo1 = array(
                'iLogin' => $AN_value,
            );
            $WebService1->request_account_details($accountinfo1);
            switch($WebService1->request_status){
                case 'RET_OK':
                    $data['Name'] = $WebService1->get_result('Name');
                    break;
                default:
                    $data['msg']= "There are no data yet.";
            }


            $account_info = array(
                'iLogin' => $AN_value,
                'from' =>  $from=$this->input->post('from') !=''? $data['from']:$data['none'] ,
                'to' => $to=$this->input->post('to') !=''? $data['to']:$data['none']
            );
            $data['withdraw']=0;
            $data['deposit']=0;
            $data['saldo']=0;
            $cnvrtd_saldo=0;

//            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
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

                        $data['tr'].='<td>' .  $data['Name'];
                        $data['tr'].='</td>';
                        $data['tr'].='<td style="text-align: right;">'. $cnvrtd_saldo =number_format((float)FXPP::getCurrencyRate($data['saldo'], $from_currency=strtoupper(trim($data['MtAccountsSet']['mt_currency_base'])), $to_currency="USD"), 2, '.', '')   . ' USD';
                        $data['tr'].='</td>';

                        $data['tr'].='</tr>';

                    }else{

                        $data['tr'].='<tr>';
                        $data['saldo']=0;
                        $cnvrtd_saldo=0;
                        $data['amount']=0;
                        $data['tr'].='<td>'.$AN_value;
                        $data['tr'].='</td>';

                        $data['tr'].='<td>' .$data['Name'];
                        $data['tr'].='</td>';

                        $data['tr'].='<td style="text-align: right;">'.$data['amount'];
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

        $data['tr'].=' <td colspan="3" class="total-saldo" style="text-align: right;font-weight: bold;">Total Saldo: <span id="totalsaldo" style="text-align: right;font-weight: bold;">'.number_format((float)$data['total_saldo'], 2, '.', '') .' USD</span></td>';

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

    public function delete_mt4comment(){
        $this->load->model('Task_model');
        $this->t_m=$this->Task_model;
        $this->load->model('General_model');
        $this->g_m=$this->General_model;
        $this->g_m->delete($table='mt4_comment',$field='id',$id=$this->input->post('id'));
//        $data['update']=array(
//            'status'=>2
//        );
//        $data['update']= $this->g_m->updatemy($table='mt4_comment',$field='id',$id=$this->input->post('id'),$data['update']);
        $data['request']= $this->reload_mt4comment($this->input->post('type'));

        $data['query'] = $this->t_m->showssingle2($table='mt4_comment',$field="comment_type",$id=$this->input->post('type'),$field2="status",$id2=1,$select="comment,id,api_method",$order_by="date_created");
//        $options=array();
        $data['comments_option']='';
        if ($data['query']) {
            foreach($data['query'] as $key => $value ){
                $data['comments_option'].='<option value="'.$value['id'].'" data-apimethod="'.$value['api_method'].'"> '.$value['comment'].' </option>';
//                $options[$value['id']]= $value['comment'];
            }
//            $data['comments_option'] = $this->General_model->selectOptionList($options);

        }



        echo json_encode($data);
    }
    public function get_mt4comment(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['request']= $this->reload_mt4comment($this->input->post('type'));
        echo json_encode($data);
    }

    public function add_mt4comment(){ 
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $this->load->model('Task_model');
        $this->t_m=$this->Task_model;
        $this->load->model('General_model');
        $this->g_m=$this->General_model;

        $data['date'] = $this->input->post('payment_date');
        $data['date'] = DateTime::createFromFormat('m/d/Y',$data['date']);
        $data['date']->setTime(00,00,01);


        $data['checkcommentexists'] = $this->t_m->check_commentexits($table='mt4_comment',$field='comment_type',$id=$this->input->post('type'),$field2='comment',$id2=$this->input->post('comment'), $select='comment');

        if ($data['checkcommentexists']){
            $data['exist']=true;
        }else{
            $data['exist']=false;
            $data['latest'] = $this->t_m->get_newest_mt4_comment($table='mt4_comment',$field='comment_type',$id=$this->input->post('type'),$select='value');

            if($data['latest']){
                $select_value=intval($data['latest'][0]['value'])+1;
            }else{
                $select_value=1;
            }
            $data['insert']=array(
                'comment_type'=>$this->input->post('type'),
                'comment'=>$this->input->post('comment'),
                'api_method'=>$this->input->post('api_method'),
                'api_comment'=>$this->input->post('api_comment'),
                'value'=>$select_value,
                'transaction_id'=>$this->input->post('transactionid'),
                'date_created'=> FXPP::getCurrentDateTime(),
                'payment_date'=>  $data['date']->format('Y-m-d H:i:s'),
                'payment_option'=> $this->input->post('payment_option'),
                'admin_log'=> $_SESSION['user_id'],
            );
            $data['query1'] = $this->g_m->insertmy($table='mt4_comment',$data['insert']);
            $data['request']= $this->reload_mt4comment($this->input->post('type'),$data['query1']);

            $data['query'] = $this->t_m->showssingle2($table='mt4_comment',$field="comment_type",$id=$this->input->post('type'),$field2="status",$id2=1,$select="comment,id,api_method",$order_by="date_created");
            $data['comments_option']='';
            if ($data['query']) {
                foreach($data['query'] as $key => $value ){
                    $data['comments_option'].='<option value="'.$value['id'].'" data-apimethod="'.$value['api_method'].'"> '.$value['comment'].' </option>';
                }
            }
        }
        echo json_encode($data);
    }
    public function edit_update(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $this->load->model('Task_model');
        $this->t_m=$this->Task_model;
        $data['checkcommentexists'] = $this->t_m->check_commentexits_update($table='mt4_comment',$field='comment_type',$id=$this->input->post('type'),$field2='comment',$id2=$this->input->post('comment'),$field3='id',$id3=$this->input->post('id'), $select='comment');

        if ($data['checkcommentexists']){
            $data['exist']=true;
        }else{
            $data['exist']=false;
            $data['date'] = $this->input->post('payment_date');
            $data['date'] = DateTime::createFromFormat('m/d/Y',   $data['date']);
            $data['date']->setTime(00,00,01);
            $this->load->model('Task_model');
            $this->t_m=$this->Task_model;
            $this->load->model('General_model');
            $this->g_m=$this->General_model;
            $data['update']=array(
                'comment'=>$this->input->post('comment'),
                'api_method'=>$this->input->post('api_method'),
                'api_comment'=>$this->input->post('api_comment'),
                'transaction_id'=>$this->input->post('transactionid'),
                'payment_date'=> $data['date']->format('Y-m-d H:i:s'),
                'payment_option'=> $this->input->post('payment_option'),
                'admin_log'=> $_SESSION['user_id'],
            );
            $data['update']= $this->g_m->updatemy($table='mt4_comment',$field='id',$id=$this->input->post('id'),$data['update']);
            $data['request']= $this->reload_mt4comment($this->input->post('type'),$this->input->post('id'));

            $data['query'] = $this->t_m->showssingle2($table='mt4_comment',$field="comment_type",$id=$this->input->post('type'),$field2="status",$id2=1,$select="comment,id,api_method",$order_by="date_created");
            $data['comments_option']='';
            if ($data['query']) {
                foreach($data['query'] as $key => $value ){
                    $data['comments_option'].='<option value="'.$value['id'].'" data-apimethod="'.$value['api_method'].'"> '.$value['comment'].' </option>';
                }

            }
        }
        echo json_encode($data);
    }
    private function reload_mt4comment($comment_type,$trans_ref = null){

        $this->load->model('Task_model');
        $this->t_m=$this->Task_model;
//        $data['query'] = $this->t_m->showssingle($table='mt4_comment',$field="comment_type",$id= $comment_type,$select="id,comment_type,comment,value,date_created",$order_by="");
        $data['query'] = $this->t_m->showssingle2($table='mt4_comment',$field="comment_type",$id=$comment_type,$field2="status",$id2=1,$select="id,comment_type,comment,value,date_created,api_method,transaction_id,payment_option,payment_date",$order_by="");
        if($comment_type==1){
            $data['comment_type']="Credit Funds";
        }else{
            $data['comment_type']="Cancel Funds";
        }


        $data['request']='';
        if ($data['query']) {
            foreach($data['query'] as $key => $value ){
                if ($value['payment_date']==null){
                    $date='';
                }else{
                    $date = DateTime::createFromFormat('Y-m-d H:i:s',  $value['payment_date']);
                    $date = $date->format('m/d/Y');
                }

                if($trans_ref==$value['id']){
                    $data['request'] .= '<tr style="background-color:#EAF8DC">';
                }else{
                    $data['request'] .= '<tr>';
                }

                $data['request'] .= '<td>'. $data['comment_type'] .'</td>';
                $data['request'] .= '<td>' . $value['comment'] . '</td>';
                $data['request'] .= '<td>' . $value['date_created'] . '</td>';
                $data['request'] .= '<td>
                    <a onclick="pre_def()"  data-poption="'.$value['payment_option'].'"  data-pdate="'.$date.'"  data-id="'.$value['id'].'" data-trid="'.$value['transaction_id'].'" data-api="'.$value['api_method'].'"   data-type="'.$comment_type.'" data-comment="'.$value['comment'].'"  class=" curp queue-action edit" ><i class="fa fa-pencil action "></i>
                    <a onclick="pre_def()"  data-id="'.$value['id'].'"  data-commenttype="'.$data['comment_type'].'"  data-type="'.$comment_type.'" data-comment="'.$value['comment'].'"  data-date="'.$value['date_created'].'" class=" curp queue-action push_delete" data-toggle="modal" data-target="#delete"><i class="fa fa-times-circle action"></i></a>
                    </td>';
                $data['request'] .= '</tr>';
            }
        }
        return $data['request'];
    }
}