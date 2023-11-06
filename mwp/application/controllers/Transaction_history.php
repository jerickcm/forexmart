<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_history extends CI_Controller {

    private $transaction_type = array(
        'BOC' => 'BANK OF CYPRUS',
        'BT' => 'BANK TRANSFER',
        'NT' => 'NETELLER',
        'SK' => 'SKRILL',
        'CC' => 'CREDIT CARD',
        'UP' => 'UNIONPAY',
        'WM' => 'WEBMONEY',
        'PX' => 'PAXUM',
        'UK' => 'UKASH',
        'PC' => 'PAYCO',
        'FP' => 'FILSPAY',
        'CU' => 'CASHU',
        'PP' => 'PAYPAL',
        'QW' => 'QIWI',
        'MT' => 'MEGATRANSFER',
        'MTC' => 'MEGATRANSFER CARD',
        'BC' => 'BITCOIN',
        'CP'=> 'CARDPAY',
        'MN'=> 'MONETA',
        'SF'=> 'SOFORT',
        'WIRE_TRANSFER_SL' => 'MegaTransfer SiauLiu',
        'WIRE_TRANSFER_SP' => 'MegaTransfer Sparkasse',
        'WIRE_TRANSFER_PC' => 'Piraeus Cyprus',
        'WIRE_TRANSFER_BOC' => 'Bank of Cyprus',
        'WIRE_TRANSFER_EC' => 'Eurobank Cyprus',
        'N/A' => 'N/A',
        'TR' => 'TRANSIT TRANSFER',
    );

    public function __construct(){
        parent::__construct();
        $this->load->model('Withdraw_model');
        $this->load->model('deposit_model');
        $this->load->model('General_model');

        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('General_model');
        $this->load->model('Account_model');

        $this->user_id = $this->session->userdata('user_id');
        $this->load->library('Transaction');
        $this->g_m=$this->General_model;

    }
    public function index()
    {
        $this->lang->load('transactionhistory');
        $this->lang->load('datatable');
        $this->load->library('IPLoc', null);


        if($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');
            $mtas3 = $this->general_model->showssingle($table='users',$id='id', $field=$user_id,$select='login_type');
            $data['login_type'] = $mtas3['login_type'];
            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2015/5/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            if( $this->session->userdata('login_type') == 1){
                $data['mtas'] = $this->g_m->showssingle2($table='partnership',$field='partner_id',$id=$_SESSION['user_id'],$select='reference_num');
                $data['mtas']['account_number'] = $data['mtas']['reference_num'];
            }else{
                $data['mtas'] = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
            }

//            if(IPLoc::Office()){ //joy
//                $account_info = array(
//                    'iLogin' => 206793,
//                    'from' => $data['from']->format('Y-m-d\TH:i:s'),
//                    'to' => $data['to']->format('Y-m-d\TH:i:s')
//                );
//            }else{
            $account_info = array(
                'iLogin' => $data['mtas']['account_number'],
                'from' => $data['from']->format('Y-m-d\TH:i:s'),
                'to' => $data['to']->format('Y-m-d\TH:i:s')
            );
//            }

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

            $withdrawalCommentsKey = array(
                'comment_w1' => 'withdrawal',
                'comment_w2' => 'w/d'
            );

            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $data['holder1']=''; /*Bonus*/
                    $data['holder2']=''; /*Deposit*/
                    $data['holder3']=''; /*Withdraw*/
                    $data['holder4']=''; /*Transfer*/
                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS'){
                            $data['data']['bonus']=true;
                            $data['holder1'].='<tr>';
                            $data['holder1'].='<td>'.$object->FundType.'</td>';       //type
                            $data['holder1'].='<td>'.$object->Comment.'</td>';      //transaction
                            $data['holder1'].='<td>'.$object->AccountNumber.'</td>';  //account
                            $data['holder1'].='<td>'.$object->Amount.'</td>';         //amount
                            //$data['holder1'].='<td>N/A</td>';                         //pay system
                            $data['holder1'].='<td>'.$object->Stamp.'</td>';          //date
                            $data['holder1'].='</tr>';
                        }

                        if($object->FundType=='REAL' and $object->Operation=='BONUS_SUPPORTER_FULL' ){
                            if($object->Amount < 0){
                                $getWithdrawalTransactionByTicket = $this->Withdraw_model->getWithdrawalTransactionByTicket($object->Ticket);
                                $convertStamp = date("Y-m-d H:i:s", strtotime($object->Stamp));

                                if($getWithdrawalTransactionByTicket){

                                    if($getWithdrawalTransactionByTicket['status'] > 0){
                                        switch($getWithdrawalTransactionByTicket['status']){
                                            case 1:
                                                $withdrawalStatus = 'Processed';
                                                break;
                                            case 2:
                                                if($getWithdrawalTransactionByTicket['decline_reference_number'] > 0){
                                                    $withdrawalStatus = $getWithdrawalTransactionByTicket['recall'] ? 'Recalled' : 'Requested';
                                                }else{
                                                    $withdrawalStatus = 'Requested';
                                                }

                                                break;
                                            default:
                                                $withdrawalStatus = 'N/A';
                                        }

                                        if(!empty($object->Comment)){
                                            $comment = '<a href="javascript:void(0);" class="view-comment" data-wcomment="'.$object->Comment.'">View</a>';
                                        }else{
                                            $comment = 'N/A';
                                        }

                                        if(!empty($getWithdrawalTransactionByTicket["transaction_type"])){
                                            $transactionType = $this->transaction_type[strtoupper($getWithdrawalTransactionByTicket["transaction_type"])];
                                        }else{
                                            $transactionType = 'N/A';
                                        }

                                        $data['data']['withdraw']=true;
                                        $data['holder3'].='<tr>';
                                        $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
                                        $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                        $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                        $data['holder3'].='<td>'.$transactionType.'</td>';                         //pay system
                                        $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                        $data['holder3'].='<td>'.$withdrawalStatus.'</td>';          //status
                                        $data['holder3'].='<td>'.$comment.'</td>';
                                        $data['holder3'].='</tr>';
                                    }

                                }else{
                                    $data['data']['withdraw']=true;
                                    $data['holder3'].='<tr>';
                                    $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                    $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                    $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                    $data['holder3'].='<td>N/A</td>';                         //pay system
                                    $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                    $data['holder3'].='<td>N/A</td>';          //status
                                    $data['holder3'].='</tr>';
                                }
                            }else {
                                $data['data']['bonus'] = true;
                                $data['holder2'] .= '<tr>';
                                $data['holder2'] .= '<td>' . $object->FundType . '</td>';       //type
                                $data['holder2'] .= '<td>' . $object->Comment . '</td>';      //transaction
                                $data['holder2'] .= '<td>' . $object->AccountNumber . '</td>';  //account
                                $data['holder2'] .= '<td>' . $object->Amount . '</td>';         //amount
                                $data['holder2'] .= '<td>N/A</td>';         //amount
                                $data['holder2'] .= '<td>' . $object->Stamp . '</td>';          //date
                                $data['holder2'] .= '</tr>';
                            }
                        }
//

                        if ($object->Operation=='REAL_FUND_DEPOSIT'){
//                            if(strlen($object->Comment) >= 5){
//                                if(substr($object->Comment, 0, 5) == 'FEES_'){
//                                    $operation = 'Covered Fee';
//                                }else{
//                                    $operation = $object->Operation;
//                                }
//                            }else{
//                                $operation = $object->Operation;
//                            }

                            if (strpos(strtolower($object->Comment), $withdrawalCommentsKey['comment_w1'] ) !== false OR strpos(strtolower($object->Comment), $withdrawalCommentsKey['comment_w2'] ) !== false) {

                                $convertStamp = date("Y-m-d H:i:s", strtotime($object->Stamp));
                                $getWithdrawalTransactionByTicket = $this->Withdraw_model->getWithdrawalTransactionByDeclineTicket($object->Ticket);

                                if(!empty($object->Comment)){
                                    $comment = '<a href="javascript:void(0);" class="view-comment" data-wcomment="'.$object->Comment.'">View</a>';
                                }else{
                                    $comment = 'N/A';
                                }

                                if(!empty($getWithdrawalTransactionByTicket["transaction_type"])){
                                    $transactionType = $this->transaction_type[strtoupper($getWithdrawalTransactionByTicket["transaction_type"])];
                                }else{
                                    $transactionType = 'N/A';
                                }

                                $data['data']['withdraw']=true;
                                $data['holder3'].='<tr>';
                                $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                $data['holder3'].='<td>'.$transactionType.'</td>';                         //pay system
                                $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                $data['holder3'].='<td>Declined</td>';          //status
                                $data['holder3'].='<td>'.$comment.'</td>';
                                $data['holder3'].='</tr>';

                            }else{
                                $depositTransaction = $this->deposit_model->getDepositTransactionByTicket($object->Ticket);
                                if($depositTransaction){
                                    $transactionType = strtoupper($depositTransaction["transaction_type"]);
                                }else{
                                    $transactionType = 'N/A';
                                }
                                $data['data']['deposit']=true;
                                $data['holder2'].='<tr>';
                                $data['holder2'].='<td>'.$object->FundType.'</td>';       //type
                                $data['holder2'].='<td>'.$object->Comment.'</td>';      //transaction
                                $data['holder2'].='<td>'.$object->AccountNumber.'</td>';  //account
                                $data['holder2'].='<td>'.$object->Amount.'</td>';         //amount
                                $data['holder2'].='<td>'.$transactionType.'</td>';                         //pay system
                                $data['holder2'].='<td>'.$object->Stamp.'</td>';          //date
                                $data['holder2'].='</tr>';
                            }


                        }
                        if ($object->Operation=='REAL_FUND_WITHDRAW'){

                            $getWithdrawalTransactionByTicket = $this->Withdraw_model->getWithdrawalTransactionByTicket($object->Ticket);
                            $convertStamp = date("Y-m-d H:i:s", strtotime($object->Stamp));

                            if($getWithdrawalTransactionByTicket){

                                if($getWithdrawalTransactionByTicket['status'] > 0){
                                    switch($getWithdrawalTransactionByTicket['status']){
                                        case 1:
                                            $withdrawalStatus = 'Processed';
                                            break;
                                        case 2:
                                            if($getWithdrawalTransactionByTicket['decline_reference_number'] > 0){
                                                $withdrawalStatus = $getWithdrawalTransactionByTicket['recall'] ? 'Recalled' : 'Requested';
                                            }else{
                                                $withdrawalStatus = 'Requested';
                                            }

                                            break;
                                        default:
                                            $withdrawalStatus = 'N/A';
                                    }

                                    if(!empty($object->Comment)){
                                        $comment = '<a href="javascript:void(0);" class="view-comment" data-wcomment="'.$object->Comment.'">View</a>';
                                    }else{
                                        $comment = 'N/A';
                                    }

                                    if(!empty($getWithdrawalTransactionByTicket["transaction_type"])){
                                        $transactionType = $this->transaction_type[strtoupper($getWithdrawalTransactionByTicket["transaction_type"])];
                                    }else{
                                        $transactionType = 'N/A';
                                    }

                                    $data['data']['withdraw']=true;
                                    $data['holder3'].='<tr>';
                                    $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                    $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                    $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                    $data['holder3'].='<td>'.$transactionType.'</td>';                         //pay system
                                    $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                    $data['holder3'].='<td>'.$withdrawalStatus.'</td>';          //status
                                    $data['holder3'].='<td>'.$comment.'</td>';
                                    $data['holder3'].='</tr>';
                                }

                            }else{
                                $data['data']['withdraw']=true;
                                $data['holder3'].='<tr>';
                                $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                $data['holder3'].='<td>N/A</td>';                         //pay system
                                $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                $data['holder3'].='<td>N/A</td>';          //status
                                $data['holder3'].='</tr>';
                            }

                        }
                        if ($object->Operation=='REAL_FUND_TRANSFER'){
                            /*2*/

                            if (strpos($object->Comment, 'INTERNAL_TRANSFER_FROM_') !== false) {

                                $data['trans_to']  = $object->AccountNumber;
                                $data['trans_from'] = str_replace('INTERNAL_TRANSFER_FROM_','',$object->Comment);
                            }else{

                                $data['trans_from']= $object->AccountNumber;
                                $data['trans_to']= $object->AccountReceiver;
                            }


                            $data['data']['transfer']=true;
                            $data['holder4'].='<tr>';
                            $data['holder4'].='<td>'.$object->FundType.'</td>';       //type
                            $data['holder4'].='<td>'.$object->Operation.'</td>';      //transaction
                            $data['holder4'].='<td>'.$data['trans_from'].'</td>';  //account to
                            $data['holder4'].='<td>'.$data['trans_to'].'</td>';  //account from
                            $data['holder4'].='<td>'.$object->Amount.'</td>';         //amount
                            $data['holder4'].='<td>'.$object->Stamp.'</td>';          //date
                            $data['holder4'].='</tr>';
                        }
                    }
                    break;
                default:
                    $data['holder0']='';
            }

            if($WebService->request_status === 'RET_OK'){



                $financeRecords = $WebService->get_result('FinanceRecords');
                foreach($financeRecords->FinanceRecordData as $object){
                    if($object->Operation === 'REAL_FUND_WITHDRAW'){
                        $resultTransaction = $this->Withdraw_model->getWithdrawalTransactionByTicket($object->Ticket);
                        $convertStamp = date("Y-m-d H:i:s", strtotime($object->Stamp));
                        if ($resultTransaction) {
                            if ($resultTransaction['status'] == 0) {
                                $data['withdrawFinance'] .= "<tr id=" . $object->Ticket . "}'>"
                                    . "<td class='FundType' align='center'>" . $object->FundType . "</td>"
                                    . "<td class='Operation' align='center'>" . $object->Operation . "</td>"
                                    . "<td class='AccountNumber'>" . $object->AccountNumber . "</td>"
                                    . "<td class='Amount'>" . $object->Amount . "</td>"
                                    . "<td class='PaySystem'>" . $this->transaction_type[strtoupper($resultTransaction['transaction_type'])] . "</td>"
                                    . "<td class='Stamp'>" . $convertStamp . "</td>"
                                    . "<td class='Recall'><a class='btn-withdraw-option recall-action' data-ticket=" . $object->Ticket . ">Recall</a></td>"
                                    . "</tr>";
                            }
                        }
                    }
                }
            }


            $data['holderincomplete']='';
            $data['title_page'] = lang('sb_li_2');

            $data['metadata_description'] = lang('frahis_dsc');
            $data['metadata_keyword'] = lang('frahis_kew');
            $this->template->title(lang('frahis_tit'))
                ->set_layout('mwp/v2_main')
                ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 ")
                ->append_metadata_js("
                        <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                        <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                       <script src='".$this->template->Js()."bootbox.min.js'></script>
                       <script src='".$this->template->Js()."Moment.js'></script>
                       <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                       <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                 ")

                ->build('quick_jump/transactions',$data);
            unset($data);
        }else{
            redirect('signout');
        }
    }

    public function updateWithdrawTransaction(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        if($this->input->post()){
            $ticket = $this->input->post('ticket',true);
            $updateData = array(
                'recall' => 1
            );
            $this->Withdraw_model->updateWithdrawalDetails($ticket, $updateData);
            echo true;
        }
        echo false;
    }

    public function test_excel(){

        $this->load->library('excel');
        $getTransactionsRecord = $this->getTransactionsRecord();
//        $realFundDeposit = array();
        $realFundDeposit = $getTransactionsRecord['REAL_FUND_DEPOSIT'];

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Forexmart Transactions');

        //set row heading
        $this->excel->getActiveSheet()->setCellValue('A1', 'Type');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Transaction');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Account');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Amount');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Pay System');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Date');

        for($col = ord('A'); $col <= ord('G'); $col++){
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

            $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        }
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        if($realFundDeposit){
            $row = 2;
            foreach($realFundDeposit as $data){

                $convertStamp = date("Y-m-d H:i:s", strtotime($data['Stamp']));

                $this->excel->getActiveSheet()->setCellValue('A'.$row, $data['FundType']);
                $this->excel->getActiveSheet()->setCellValue('B'.$row, $data['Operation']);
                $this->excel->getActiveSheet()->setCellValue('C'.$row, $data['AccountNumber']);
                $this->excel->getActiveSheet()->setCellValue('D'.$row, $data['Amount']);
                $this->excel->getActiveSheet()->setCellValue('E'.$row, 'N/A');
                $this->excel->getActiveSheet()->setCellValue('F'.$row, $convertStamp);
                $row++;
            }
        }else{
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->setCellValue('A2', 'No record found');
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        }

        ob_end_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');

    }

    public function test_pdf(){
        $this->load->library('PDF_MC_Table');
        $pdf=new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
//Table with 20 rows and 4 columns
        $pdf->SetWidths(array(32,32,32,32,32,32));
        $header = array('Type', 'Transaction', 'Account', 'Amount', 'Pay System', 'Date');
        $pdf->Header($header);
        $getTransactionsRecord = $this->getTransactionsRecord();
//        $realFundDeposit = array();
        $realFundDeposit = $getTransactionsRecord['REAL_FUND_DEPOSIT'];

        foreach($realFundDeposit as $data){
            $convertStamp = date("Y-m-d H:i:s", strtotime($data['Stamp']));
            $pdf->Row(
                array(
                    $data['FundType'],
                    $data['Operation'],
                    $data['AccountNumber'],
                    $data['Amount'],
                    'N/A',
                    $convertStamp
                )
            );
        }

        $pdf->Output();
    }

    public function getTransactionsRecord(){

        $getData = null;

        $transactionTypes = array(
            'REAL_FUND_DEPOSIT' => array(),
            'REAL_FUND_WITHDRAW' => array(),
            'REAL_FUND_TRANSFER' => array(),
            'BONUS' => array()
        );

        $from = DateTime::createFromFormat('Y/d/m', date('2015/5/5'));
        $to = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
        $mtAccountsSetData = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
        $account_info = array(
            'iLogin' => $mtAccountsSetData['account_number'],
            'from' => $from->format('Y-m-d\TH:i:s'),
            'to' => $to->format('Y-m-d\TH:i:s')
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

        if($WebService->request_status === 'RET_OK'){
            $financeRecordEncode = json_encode($WebService->get_result('FinanceRecords'));
            $financeRecord = json_decode($financeRecordEncode, true);

            $operations = array_column($financeRecord['FinanceRecordData'], 'Operation');

            $array_keys = array_keys($transactionTypes);

            foreach($operations as $key => $o){

                if(in_array($o, $array_keys)){
                    $transactionTypes[$o][] = $financeRecord['FinanceRecordData'][$key];
                }

            }

        }
        return $transactionTypes;
    }

    public function dt()
    {
        $this->lang->load('transactionhistory');
        $this->load->library('IPLoc', null);


        if($this->session->userdata('logged')) {

            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2015/5/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            $data['mtas'] = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='account_number');
            $account_info = array(
                'iLogin' => $data['mtas']['account_number'],
                'from' => $data['from']->format('Y-m-d\TH:i:s'),
                'to' => $data['to']->format('Y-m-d\TH:i:s')
            );
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

            $withdrawalCommentsKey = array(
                'comment_w1' => 'withdrawal',
                'comment_w2' => 'w/d'
            );

            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $data['holder1']='';
                    $data['holder2']='';
                    $data['holder3']='';
                    $data['holder4']='';
                    foreach ( $tradatalist['FinanceRecordData'] as $object){

                        if ($object->FundType=='BONUS'){
                            $data['data']['bonus']=true;
                            $data['holder1'].='<tr>';
                            $data['holder1'].='<td>'.$object->FundType.'</td>';       //type
                            $data['holder1'].='<td>'.$object->Comment.'</td>';      //transaction
                            $data['holder1'].='<td>'.$object->AccountNumber.'</td>';  //account
                            $data['holder1'].='<td>'.$object->Amount.'</td>';         //amount
//                            $data['holder1'].='<td>N/A</td>';                         //pay system
                            $data['holder1'].='<td>'.$object->Stamp.'</td>';          //date
                            $data['holder1'].='</tr>';
                        }
                        if ($object->Operation=='REAL_FUND_DEPOSIT'){
//                            if(strlen($object->Comment) >= 5){
//                                if(substr($object->Comment, 0, 5) == 'FEES_'){
//                                    $operation = 'Covered Fee';
//                                }else{
//                                    $operation = $object->Operation;
//                                }
//                            }else{
//                                $operation = $object->Operation;
//                            }

                            if (strpos(strtolower($object->Comment), $withdrawalCommentsKey['comment_w1'] ) !== false OR strpos(strtolower($object->Comment), $withdrawalCommentsKey['comment_w2'] ) !== false) {

                                $convertStamp = date("Y-m-d H:i:s", strtotime($object->Stamp));
                                $getWithdrawalTransactionByTicket = $this->Withdraw_model->getWithdrawalTransactionByDeclineTicket($object->Ticket);

                                if(!empty($object->Comment)){
                                    $comment = '<a href="javascript:void(0);" class="view-comment" data-wcomment="'.$object->Comment.'">View</a>';
                                }else{
                                    $comment = 'N/A';
                                }

                                if(!empty($getWithdrawalTransactionByTicket["transaction_type"])){
                                    $transactionType = $this->transaction_type[strtoupper($getWithdrawalTransactionByTicket["transaction_type"])];
                                }else{
                                    $transactionType = 'N/A';
                                }

                                $data['data']['withdraw']=true;
                                $data['holder3'].='<tr>';
                                $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                $data['holder3'].='<td>'.$transactionType.'</td>';                         //pay system
                                $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                $data['holder3'].='<td>Declined</td>';          //status
                                $data['holder3'].='<td>'.$comment.'</td>';
                                $data['holder3'].='</tr>';

                            }else{
                                $depositTransaction = $this->deposit_model->getDepositTransactionByTicket($object->Ticket);
                                if($depositTransaction){
                                    $transactionType = strtoupper($depositTransaction["transaction_type"]);
                                }else{
                                    $transactionType = 'N/A';
                                }
                                $data['data']['deposit']=true;
                                $data['holder2'].='<tr>';
                                $data['holder2'].='<td>'.$object->FundType.'</td>';       //type
                                $data['holder2'].='<td>'.$object->Comment.'</td>';      //transaction
                                $data['holder2'].='<td>'.$object->AccountNumber.'</td>';  //account
                                $data['holder2'].='<td>'.$object->Amount.'</td>';         //amount
                                $data['holder2'].='<td>'.$transactionType.'</td>';                         //pay system
                                $data['holder2'].='<td>'.$object->Stamp.'</td>';          //date
                                $data['holder2'].='</tr>';
                            }


                        }
                        if ($object->Operation=='REAL_FUND_WITHDRAW'){

                            $getWithdrawalTransactionByTicket = $this->Withdraw_model->getWithdrawalTransactionByTicket($object->Ticket);
                            $convertStamp = date("Y-m-d H:i:s", strtotime($object->Stamp));

                            if($getWithdrawalTransactionByTicket){

                                if($getWithdrawalTransactionByTicket['status'] > 0){
                                    switch($getWithdrawalTransactionByTicket['status']){
                                        case 1:
                                            $withdrawalStatus = 'Processed';
                                            break;
                                        case 2:
                                            if($getWithdrawalTransactionByTicket['decline_reference_number'] > 0){
                                                $withdrawalStatus = $getWithdrawalTransactionByTicket['recall'] ? 'Recalled' : 'Requested';
                                            }else{
                                                $withdrawalStatus = 'Requested';
                                            }

                                            break;
                                        default:
                                            $withdrawalStatus = 'N/A';
                                    }

                                    if(!empty($object->Comment)){
                                        $comment = '<a href="javascript:void(0);" class="view-comment" data-wcomment="'.$object->Comment.'">View</a>';
                                    }else{
                                        $comment = 'N/A';
                                    }

                                    if(!empty($getWithdrawalTransactionByTicket["transaction_type"])){
                                        $transactionType = $this->transaction_type[strtoupper($getWithdrawalTransactionByTicket["transaction_type"])];
                                    }else{
                                        $transactionType = 'N/A';
                                    }

                                    $data['data']['withdraw']=true;
                                    $data['holder3'].='<tr>';
                                    $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                    $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                    $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                    $data['holder3'].='<td>'.$transactionType.'</td>';                         //pay system
                                    $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                    $data['holder3'].='<td>'.$withdrawalStatus.'</td>';          //status
                                    $data['holder3'].='<td>'.$comment.'</td>';
                                    $data['holder3'].='</tr>';
                                }

                            }else{
                                $data['data']['withdraw']=true;
                                $data['holder3'].='<tr>';
                                $data['holder3'].='<td>'.$object->FundType.'</td>';       //type
//                            $data['holder3'].='<td>'.$object->Operation.'</td>';      //transaction
                                $data['holder3'].='<td>'.$object->AccountNumber.'</td>';  //account
                                $data['holder3'].='<td>'.$object->Amount.'</td>';         //amount
                                $data['holder3'].='<td>N/A</td>';                         //pay system
                                $data['holder3'].='<td>'.$convertStamp.'</td>';          //date
                                $data['holder3'].='<td>N/A</td>';          //status
                                $data['holder3'].='</tr>';
                            }

                        }
                        if ($object->Operation=='REAL_FUND_TRANSFER'){
                            /*1*/
                            if (strpos($object->Comment, 'INTERNAL_TRANSFER_FROM_') !== false) {
                                $data['trans_to']  = $object->AccountNumber;
                                $data['trans_from'] = str_replace('INTERNAL_TRANSFER_FROM_','',$object->Comment);
                            }else{

                                $data['trans_from']= $object->AccountNumber;
                                $data['trans_to']= $object->AccountReceiver;
                            }

                            $data['data']['transfer']=true;
                            $data['holder4'].='<tr>';
                            $data['holder4'].='<td>'.$object->FundType.'</td>';       //type
                            $data['holder4'].='<td>'.$object->Operation.'</td>';      //transaction
                            $data['holder4'].='<td>'. $data['trans_from'].'</td>';  //account from
                            $data['holder4'].='<td>'. $data['trans_to'].'</td>';  //account to
                            $data['holder4'].='<td>'.$object->Amount.'</td>';         //amount
                            $data['holder4'].='<td>'.$object->Stamp.'</td>';          //date
                            $data['holder4'].='</tr>';
                        }
                    }
                    break;
                default:
                    $data['holder0']='';

            }

            if($WebService->request_status === 'RET_OK'){



                $financeRecords = $WebService->get_result('FinanceRecords');
                foreach($financeRecords->FinanceRecordData as $object){
                    if($object->Operation === 'REAL_FUND_WITHDRAW'){
                        $resultTransaction = $this->Withdraw_model->getWithdrawalTransactionByTicket($object->Ticket);
//                        $convertStamp = date("Y-M-d H:i:s", strtotime($object->Stamp));
//                        $convertStamp = new DateTime($object->Stamp);
                        $convertStamp = DateTime::createFromFormat('Y-m-d\TH:i:s',$object->Stamp);

                        if($resultTransaction){
                            if($resultTransaction['status'] == 0){
                                $data['withdrawFinance'].= "<tr id=".$object->Ticket."}'>"
                                    ."<td class='FundType' align='center'>".$object->FundType."</td>"
                                    ."<td class='Operation' align='center'>".$object->Operation."</td>"
                                    ."<td class='AccountNumber'>".$object->AccountNumber."</td>"
                                    ."<td class='Amount'>".$object->Amount."</td>"
                                    ."<td class='PaySystem'>".$this->transaction_type[strtoupper($resultTransaction['transaction_type'])]."</td>"
                                    ."<td class='Stamp'>".$convertStamp->format('Y-M-d H:i:s')."</td>"
                                    ."<td class='Recall'><a class='btn-withdraw-option recall-action' data-ticket=".$object->Ticket.">Recall</a></td>"
                                    ."</tr>";
                            }
                        }
                    }
                }
            }

            $data['holderincomplete']='';
            $data['title_page'] = lang('sb_li_2');
            $data['active_tab'] = 'finance';
            $data['active_sub_tab'] = 'transaction-history';

            $data['metadata_description'] = lang('frahis_dsc');
            $data['metadata_keyword'] = lang('frahis_kew');
            $this->template->title(lang('frahis_tit'))
                ->set_layout('internal/main')
                ->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 ")
                ->append_metadata_js("
                        <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                        <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                       <script src='".$this->template->Js()."bootbox.min.js'></script>
                       <script src='".$this->template->Js()."Moment.js'></script>
                       <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                       <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                 ")

                ->build('transaction_history_dt',$data);
            unset($data);
        }else{
            redirect('signout');
        }
    }

    public function excel($tranType){

        $pTransactionType = ucfirst($tranType);
        if( $this->session->userdata('login_type') == 1){
            $getAccountsByUserIdRow = $this->Account_model->getAccountByPartnerId($this->user_id);
            //$getAccountsByUserIdRow['account_number'] = $getAccountsByUserIdRow['reference_num'];
        }else{
            $getAccountsByUserIdRow = $this->Account_model->getAccountsByUserIdRow($this->user_id);
        }

        $account_number = $getAccountsByUserIdRow['account_number'];
        $from = DateTime::createFromFormat('Y/m/d', date('2015/5/5'));
        $to = DateTime::createFromFormat('Y/m/d H:i:s', date('Y/m/d').' 23:59:59');

        $Transaction = new Transaction();
        $getAllTransactionData = $Transaction->getAllTransactionData($pTransactionType, $account_number, $from->format('Y-m-d\TH:i:s'), $to->format('Y-m-d\TH:i:s'));

        $this->load->library('excel');

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Forexmart Transactions - '.$getAccountsByUserIdRow['account_number']);

        //set row heading
        $this->excel->getActiveSheet()->setCellValue('A1', 'Type');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Transaction');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Account');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Amount');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Pay System');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Date');

        for($col = ord('A'); $col <= ord('G'); $col++){
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

            $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        }
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        if($getAllTransactionData){
            $row = 2;
            foreach($getAllTransactionData as $data){

                $convertStamp = date("Y-m-d H:i:s", strtotime($data['Stamp']));

                $this->excel->getActiveSheet()->setCellValue('A'.$row, $data['FundType']);
                $this->excel->getActiveSheet()->setCellValue('B'.$row, $data['Operation']);
                $this->excel->getActiveSheet()->setCellValue('C'.$row, $data['AccountNumber']);
                $this->excel->getActiveSheet()->setCellValue('D'.$row, round($data['Amount'], 2));
                $this->excel->getActiveSheet()->setCellValue('E'.$row, 'N/A');
                $this->excel->getActiveSheet()->setCellValue('F'.$row, $convertStamp);
                $row++;
            }
        }else{
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->setCellValue('A2', 'No record found');
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }

        ob_end_clean();

        $filename = $account_number.'-'.strtotime('now').'.xlsx';
        $_SESSION['e-payments-file'] = $filename;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');

    }

    public function pdf($tranType){

        $pTransactionType = ucfirst($tranType);
        if( $this->session->userdata('login_type') == 1){
            $getAccountsByUserIdRow = $this->Account_model->getAccountByPartnerId($this->user_id);
            //$getAccountsByUserIdRow['account_number'] = $getAccountsByUserIdRow['reference_num'];
        }else{
            $getAccountsByUserIdRow = $this->Account_model->getAccountsByUserIdRow($this->user_id);
        }
        //$getAccountsByUserIdRow = $this->Account_model->getAccountsByUserIdRow($this->user_id);

        $account_number = $getAccountsByUserIdRow['account_number'];
        $from = DateTime::createFromFormat('Y/m/d', date('2015/5/5'));
        $to = DateTime::createFromFormat('Y/m/d H:i:s', date('Y/m/d').' 23:59:59');

        $Transaction = new Transaction();
        $getAllTransactionData = $Transaction->getAllTransactionData($pTransactionType, $account_number, $from->format('Y-m-d\TH:i:s'), $to->format('Y-m-d\TH:i:s'));

        $this->load->library('PDF_MC_Table');
        $pdf=new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        $pdf->SetWidths(array(32,32,32,32,32,32));
        $header = array('Type', 'Transaction', 'Account', 'Amount', 'Pay System', 'Date');
        $pdf->Header($header);

        foreach($getAllTransactionData as $data){
            $convertStamp = date("Y-m-d H:i:s", strtotime($data['Stamp']));
            $pdf->Row(
                array(
                    $data['FundType'],
                    $data['Operation'],
                    $data['AccountNumber'],
                    round($data['Amount'], 2),
                    'N/A',
                    $convertStamp
                )
            );
        }

        $pdf->Output();
    }
    public function getAllWithdrawals(){
//       if(IPLoc::Office()){
//           $user_id = 156131;
//       }else{
        $user_id = $this->session->userdata('user_id');
        //}
        $statusId = array();
        $statusId[] = 0;
        switch($_POST['tab']){
            case 'Request':
                $statusId[] = 0;
                break;
            case 'Processed':
                $statusId[] = 1;
                break;
            case 'Declined':
                $statusId[] = 2;
                break;
        }

        $recordsTotal = $this->Withdraw_model->CountAllWithdrawalTransaction($statusId,$user_id);
        $getWithdrawTransactions = $this->Withdraw_model->GetAllWithdrawalTransaction($statusId, $_POST['start'], $_POST['length'],$user_id);

        $data = array();

        foreach($getWithdrawTransactions as $details){
            $recall = $details['recall'];
            //$recalled = $recall ? 'Yes' : 'No';

            $recalled = $recall ? 'Yes' : "<a class='btn-withdraw-option recall-action' data-ticket='".$details['reference_number']."'>Recall</a>";


            switch($_POST['tab']){
                case 'Request':
                    $tempArray = array(
                        'DT_RowId' => $details['wId'],
                        $details['reference_number'],
                        $details['full_name'],
                        $details['account_number'],
                        $details['amount']." ".$details['currency'],
                        $details['amount_deducted']." ".$details['currency'],
                        $this->transaction_type[$details['transaction_type']],
                        $details['date_withdraw'],
                        $recalled
                    );
                    break;
                case 'Processed':
                    $tempArray = array(
                        'DT_RowId' => $details['wId'],
                        $details['reference_number'],
                        $details['full_name'],
                        $details['account_number'],
                        $details['amount']." ".$details['currency'],
                        $details['amount_deducted']." ".$details['currency'],
                        $this->transaction_type[$details['transaction_type']],
                        $details['date_withdraw']
                    );
                    break;
                case 'Declined':
                    $tempArray = array(
                        'DT_RowId' => $details['wId'],
                        $details['reference_number'],
                        $details['full_name'],
                        $details['account_number'],
                        $details['amount']." ".$details['currency'],
                        $details['amount_deducted']." ".$details['currency'],
                        $this->transaction_type[$details['transaction_type']],
                        $details['date_withdraw']
                    );
                    break;
            }

            $transInfo = array(
                'Id' => $details['wId'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

//            switch($_POST['tab']){
//                case 'Request':
//                    if($recall){
//                    //    $action = "<a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
//                    }else{
//                    //    $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
//                    }
//
//                    array_push($tempArray, $action);
//                    break;
//                case 'Processed':
//                    array_push($tempArray, $_POST['tab']);
//                    break;
//                case 'Declined':
//                    $actionPro = $recall ? 'Recalled' : $_POST['tab'];
//                    array_push($tempArray, $actionPro);
//                    break;
//            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data
        );

        echo json_encode($result);
    }
}