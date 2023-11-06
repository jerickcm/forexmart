<?php

class Withdrawal_queue extends CI_Controller{

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

    private $comment_type = array(
        'withdraw' => 'W/D_',
        'deposit' => 'DPST_'
    );

    private $comment_transaction_type = array(
        'BT' => 'WIRE_TRANSFER_BOC_',
        'NT' => 'NT_',
        'SK' => 'SK_',
        'CC' => 'CP_',
        'UP' => 'CUP_',
        'WM' => 'PS_',
        'PX' => 'PX_',
        'UK' => 'UK_',
        'PC' => 'PC_',
        'FP' => 'FP_',
        'CU' => 'CU_',
        'PP' => 'PP_',
        'QW' => 'QIWI_',
        'MT' => 'MT_',
        'MTC' => 'MTC_',
        'YANDEXMONEY' => 'YAN_',
        'BITCOIN' => 'BITCOIN_',
        'MONETA' => 'MN_',
        'SOFORT' => 'SF_'
    );

    private $bonus_comments = array(
        0 => '',
        1 => 'FOREXMART WELCOME BONUS 30%',
        2 => 'FOREXMART NO DEPOSIT BONUS',
        10 => 'FOREXMART WELCOME BONUS 50%',
        12 => 'FOREXMART_CONTEST_MF'
    );

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('General_model');
        $this->load->model('withdrawal/Transactions_model');
        $this->load->model('withdrawal/account_model');
        $this->load->model('withdrawal/withdraw_model');
        $this->load->library('Fx_mailer');
    }

    public function index(){
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = 'finance';
        $data['li_active'] = 'withdrawal';
        $actionStatus = '';
        $data['data'] = '';
        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );

        $js = $this->template->Js();
        $nav=array( 'option'=>1  );
        $data['nav'] = $this->load->view('finance/withdrawal_nav', $nav,TRUE);
        $this->template->title("MWP | Forexmart")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".base_url()."assets/plugins/jQuery/jquery-2.2.3.min.js'></script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                ")
            ->set_layout('mwp/v2_main')
            ->build('finance/withdrawal',$data);
    }

    public function GetWithdrawalTransactionsAll($offset = null, $rowPerPage = null, $status = null){
        $withdrawStatus = array(
            'Request' => null,
            'Processed' => null,
            'Declined' => null
        );
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawTransactionAll($offset, $rowPerPage, $status);
        foreach($getWithdrawTransactions as $status => $rawData){
            if($rawData){
                switch($status){
                    case 'Request':
                        $actionCol = "<a href='javascript:void(0)' class='approve-link'>Approve</a> | <a href='javascript:void(0)' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                        break;
                    default:
                        $actionCol = $status;
                        break;
                }
                foreach($rawData as $logs){
                    $dispStatus = (empty($actionCol)) ? $logs['Status'] : $actionCol;
                    $withdrawStatus[$status].= "<tr id='{$logs['id']}'>"
                        ."<td class='ref_num' align='center'>{$logs['reference_number']}</td>"
                        ."<td class='clientname' align='center'>{$logs['full_name']}</td>"
                        ."<td align='center'>{$logs['account_number']}</td>"
                        ."<td align='center'>{$logs['amount']} {$logs['currency']}</td>"
                        ."<td align='center'>{$logs['amount_deducted']} {$logs['currency']}</td>"
                        ."<td class='transactiontype' align='center'>{$this->transaction_type[$logs['transaction_type']]}</td>"
                        ."<td align='center'>{$logs['date_withdraw']}</td>"
                        ."<td align='center'>$dispStatus</td>"
                        ."</tr>";
                }
            }else{
                $withdrawStatus[$status] = '<tr><td colspan="9" align="center">No Result Found</td></tr>';
            }
        }
        return $withdrawStatus;
    }

    public function getAllWithdrawals(){
        $statusId = array();
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
        $recordsTotal = $this->Transactions_model->CountAllWithdrawalTransaction($statusId);
        $getWithdrawTransactions = $this->Transactions_model->GetAllWithdrawalTransaction($statusId, $_POST['start'], $_POST['length']);

        $data = array();
        foreach($getWithdrawTransactions as $details){
            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';
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

            switch($_POST['tab']){
                case 'Request':
                    if($recall){
                       // if ($this->session->userdata('action_status') == 'read_only') {
                            $action = '<span>Read Only</span>';
//                       joy-disable } else {
//                            $action = "<a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
//                        }
                    }else{
//                        if ($this->session->userdata('action_status') == 'read_only') {
                            $action = '<span>Read Only</span>';
//                        joy-disable} else {
//                            $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
//                        }
                    }
                    array_push($tempArray, $action);
                    break;
                case 'Processed':
                    array_push($tempArray, $_POST['tab']);
                    break;
                case 'Declined':
                    $actionPro = $recall ? 'Recalled' : $_POST['tab'];
                    array_push($tempArray, $actionPro);
                    break;
            }
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

    public function banktransfer(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>4);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."bootbox.min.js'></script>                    
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueBanktransfer',$data);
    }

    public function debit_credit_card(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>2);
        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawal/withdrawalqueue-debit-credit-card.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                     
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueDebitCreditCard',$data);
    }

    public function skrill(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>6);
        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("MWP | Forexmart")
            ->append_metadata_js("
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-skrill.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueSkrill',$data);
    }

    public function neteller(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>9);
        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-neteller.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueNeteller',$data);
    }

    public function webmoney(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>11);
        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-webmoney.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueWebmoney',$data);
    }

    public function paxum(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>7);
        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                 <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-paxum.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueuePaxum',$data);
    }

    public function ukash(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                 <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-ukash.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueUkash',$data);
    }

    public function payco(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>12);
        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                 <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-payco.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueuePayco',$data);
    }

    public function filspay(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-filspay.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueFilspay',$data);
    }

    public function cashu(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-cashu.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueCashu',$data);
    }

    public function unionpay(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                     <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-china-union-pay.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueUnionpay',$data);
    }

    public function GetWithdrawalTransaction(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionBankTransfer($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['beneficiary_bank'],
                $details['beneficiary_account'],
                $details['date_withdraw'],
                $recalled
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionCC(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionDebitCreditCard($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionSK(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionSkrill($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){
            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';


            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionNT(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionNeteller($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['neteller_id'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionWM(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionWebmoney($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['webmoney_purse'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionPX(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionPaxum($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){


            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['paxum_id'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionUK(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionUkash($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){
            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['ukash_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw']
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],

        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionPC(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionPayco($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                ($details['full_name']!=null)?$details['full_name']:"",
                $details['account_number'],
                $details['wallet'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionFP(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionFilspay($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){
            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['filspay_number'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw']
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionCU(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionCashu($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){
            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['cashu_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw']
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionUP(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionChinaUnionPay($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){
            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['bank_account'],
                $details['bank_name'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw']
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function all_withdrawalqueue_update(){

        $error = true;
        $message = null;

        $action = $this->input->post('action');
        $transId = $this->input->post('transId');
        $comment = $this->input->post('comment');

        if(isset($transId) && !empty($transId)){
            switch($action){
                case 'Processed':
                    $actionStat = 1;
                    break;
                case 'Declined':
                    $actionStat = 2;
                    break;
            }

            $getWithdrawalRequestClient = $this->Transactions_model->getWithdrawalRequestClient($transId);

            if($getWithdrawalRequestClient){
                $amount = number_format($getWithdrawalRequestClient['amount'], 2, '.', '');
                $withdrawalType = $getWithdrawalRequestClient['transaction_type'];

                $date = date('Y-m-d H:i:s', strtotime(FXPP::getCurrentDateTime()));

                $withdraw_data = array(
                    'full_name' => $getWithdrawalRequestClient['full_name'],
                    'account_number' => $getWithdrawalRequestClient['account_number'],
                    'date_withdraw' => $getWithdrawalRequestClient['date_withdraw'],
                    'amount' => number_format($getWithdrawalRequestClient['amount'], 2, '.', ''),
                    'currency' => $getWithdrawalRequestClient['currency'],
                    'email' => $getWithdrawalRequestClient['email'],
                    'withdrawal_type' => $this->transaction_type[$withdrawalType],
                    'date_processed' => $date
                );

                if($actionStat == 1){
                    $requestDetails = array(
                        'status' => $actionStat,
                        'comment' => $comment
                    );
                    $this->Transactions_model->processTransactionRequest($transId, $requestDetails);
                    Fx_mailer::withdrawal_process($withdraw_data);

                }else{

                    $amountDeducted = $getWithdrawalRequestClient['amount_deducted'];
                    $declinedCommentMt4 =  $this->comment_type['withdraw'] . $this->comment_transaction_type[$withdrawalType] . 'Declined';
                    $service_config = array(
                        'server' => 'live_new'
                    );
                    $WebService = new WebService($service_config);
                    $WebService->update_live_deposit_balance($getWithdrawalRequestClient['account_number'], $amountDeducted, $declinedCommentMt4);

                    if($WebService->request_status === 'RET_OK'){
                        $transTicket = $WebService->get_result('Ticket');

                        self::credit_back_bonus($transId);

                        $withdraw_data['reason'] = $comment;
                        Fx_mailer::withdrawal_decline($withdraw_data);

                        $requestDetails = array(
                            'status' => $actionStat,
                            'comment' => $comment,
                            'decline_reference_number' => $transTicket
                        );

                        $this->Transactions_model->processTransactionRequest($transId, $requestDetails);

                        $WebService2 = new WebService($service_config);
                        $WebService2->request_live_account_balance($getWithdrawalRequestClient['account_number']);
                        if( $WebService2->request_status === 'RET_OK' ) {
                            $balance = $WebService2->get_result('Balance');
                            $this->account_model->updateAccountBalance($getWithdrawalRequestClient['account_number'], $balance);
                        }

                    }
                }

                $this->load->model('Adminslogs_model');
                $logsPrms=array(
                    'Amount' => number_format($getWithdrawalRequestClient['amount'], 2, '.', ''),
                    'Action' => $action,
                    'Comment' => $comment,
                    'Manager_IP'=>$_SERVER['REMOTE_ADDR']
                );

                $logsData=array(
                    'users_id'=>$_SESSION['user_id'],
                    'page' => 'withdrawal-queue',
                    'date_processed'=> FXPP::getCurrentDateTime(),
                    'processed_users_id'=> $getWithdrawalRequestClient['user_id'],
                    'data'=> json_encode($logsPrms),
                    'processed_users_id_accountnumber' => $getWithdrawalRequestClient['account_number'],
                    'comment'=> $action,
                    'admin_fullname'=> $_SESSION['full_name'],
                    'admin_email'=> $_SESSION['email'],
                );
                $this->Adminslogs_model->insertmy($table="admin_log",$logsData);
            }

            $withdraw_detail = $this->withdraw_model->getWithdrawById($transId);
            if($withdraw_detail){
                $currency = $withdraw_detail['currency'];
                $amount = $withdraw_detail['amount'];
                $conv_amount = $this->get_convert_amount($currency, $amount);
                $this->withdraw_model->updateConvertedAmountById($transId, $conv_amount);
            }
            $error = false;
        }else{
            $error = true;
            $message = 'Something went wrong. Please try again.';
        }

        $returnArray = array(
            'error' => $error,
            'message' => $message
        );

        echo json_encode($returnArray);
        exit;
    }

    public function ManageAccessList(){

        $user_id= $this->session->userdata('user_id');
        //return $this->general_model->getOneDataMange('manage_access','user_id',$user_id,'type',1);
        return $data= $this->general_model->getOneDataMange('manage_access','user_id',$user_id,'type',1,'admin',1);
    }

    public function checkUserPermission($menuTab, $parentTab = "")
    {
        $permit=$this->ManageAccessList();

        $datarray=explode(",",$permit['permission']);

        if (in_array($menuTab, $datarray)) {

        } else{

            $permitArry = array("mailer", "acveri", "manacces","withdqueue","manaccounts","mannews","mangbouns","mandeposits");
            $chekMinPer="";
            foreach($datarray as $key)
            {
                if (in_array($key, $permitArry)) { $chekMinPer=$key; break;}
            }

            switch ($chekMinPer) {
                case "mailer":
                    redirect('administration/mailer');
                    break;
                case "acveri":
                    redirect('administration/personal-account-verification');
                    break;
                case "manacces":
                    redirect('administration/manage-access');
                    break;
                case "withdqueue":
                    redirect('withdrawal-queue');
                    break;
                case "manaccounts":
                    redirect('administration/manage-accounts');
                    break;
                case "mannews":
                    redirect('administration/manage-news');
                    break;
                case "mangbouns":
                    redirect('administration/manage-bonus');
                    break;
                case "mandeposits":
                    redirect('administration/manage-deposits');
                    break;
                default:
                    redirect('signout/admin');
            }

        }

    }

    private function get_convert_amount( $currency, $amount ){
        if($currency == 'USD') {
            $conv_amount = $amount;
        }else{

            $currency_convert_config = array(
                'server' => 'converter',
                'service_id' => '505641',
                'service_password' => '5fX#p8D^c89bQ'
            );

            $WebService = new WebService($currency_convert_config);
            $data = array(
                'amount' => $amount,
                'from_currency' => strtoupper(trim($currency)),
                'to_currency' => 'USD'
            );

            $WebService->convert_currency_amount($data);
            if( $WebService->request_status === 'RET_OK' ) {
                $converted_amount = $WebService->get_result('ToAmount');
                $conv_amount = number_format($converted_amount,2);
            }else{
                $conv_amount = $amount;
            }
        }

        return $conv_amount;
    }

    public function credit_back_bonus($wTransactionId){
        $getWithdrawBonusByTransId = $this->withdraw_model->getWithdrawBonusByTransId($wTransactionId);

        if($getWithdrawBonusByTransId){
            foreach($getWithdrawBonusByTransId as $data){

                $bonusPrms = array(
                    'Amount' => $data['Amount'],
                    'Account_number' => $data['Account_number'],
                    'Bonus_id' => $data['Bonus_id'],
                    'Withdraw_bonus_id' => $data['Id'],
                    'Is_RealFund' => $data['Is_realfund']
                );

                self::processFMBonus($bonusPrms);
            }
        }

    }

    public function processFMBonus($bonusData){
        $amount = $bonusData['Amount'];
        $account_number = $bonusData['Account_number'];
        $bonus_id = $bonusData['Bonus_id'];
        $comment = $this->bonus_comments[$bonus_id];
        $withdraw_bonus_id = $bonusData['Withdraw_bonus_id'];

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        switch($bonus_id){
            case 2:
                //No Deposit Bonus
                $account_info = array(
                    'Login' => $account_number,
                    'FundTransferAccountReciever' => $account_number,
                    'Amount' => $amount,
                    'Comment' => $comment,
                    'ProcessByIP' => $this->input->ip_address()
                );
                $WebService->open_Deposit_NoDepositBonus($account_info);
                break;
            case 12:
                // Forex Contest Bonus
                $WebService->credit_mf_Prize($account_number, $amount, $comment);
                break;
            case 1:
                $account_info = array(
                    'AccountNumber' => $account_number,
                    'Amount' => $amount,
                    'Comment' => $comment,
                    'ProcessByIP' => $this->input->ip_address()
                );
                $WebService->open_Deposit_30PercentBonus($account_info);
                break;
            case 10:
                $account_info = array(
                    'AccountNumber' => $account_number,
                    'Amount' => $amount,
                    'Comment' => $comment,
                    'ProcessByIP' => $this->input->ip_address()
                );
                $WebService->open_Deposit_50_PercentBonus($account_info);
                break;
        }

        if($bonusData['Is_RealFund']){
            $WebService->update_live_deposit_balance($account_number, $amount, 'W/D_payment system_Declined');
        }

        if ($WebService->request_status === 'RET_OK') {
            $bonusTicket = $WebService->get_result('Ticket');
            $this->withdraw_model->updateBonus($withdraw_bonus_id, $bonusTicket);
        }

    }

    public function megatransfer_credit_card(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>3);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-megatransfer-creditcard.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueMegatransferCreditCard',$data);
    }

    public function paypal(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>5);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-paypal.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueuePaypal',$data);
    }

    public function bitcoin(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>8);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-bitcoins.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueBitcoin',$data);
    }

    public function megatransfer(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>10);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-megatransfer.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueMegatransfer',$data);
    }

    public function Yandex(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>13);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-yandex.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueYandex',$data);
    }

    public function Moneta(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>14);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-moneta.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueMoneta',$data);
    }

    public function Sofort(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>15);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-sofort.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueSofort',$data);
    }

    public function Qiwi(){
        // Check permission
        $this->checkUserPermission("withdqueue");

        $data['data']='';

        $numberOfRecords = (int)20;
        $offset = (int) 0;

        $withdrawTrans = $this->GetWithdrawalTransactionsAll($offset, $numberOfRecords);
        $data['all_withdrawal_request'] = array(
            'Request' => array(
                'Data' => $withdrawTrans['Request'],
//                'PagingData' => $withdrawTransCount['Request']['count']."-".$numberOfRecords
            ),
            'Processed' => array(
                'Data' => $withdrawTrans['Processed'],
//                'PagingData' => $withdrawTransCount['Approved']['count']."-".$numberOfRecords
            ),
            'Declined' => array(
                'Data' => $withdrawTrans['Declined'],
//                'PagingData' => $withdrawTransCount['Declined']['count']."-".$numberOfRecords
            )
        );
        $data['access']=  $this->ManageAccessList();
        $js = $this->template->Js();

        $nav=array('option'=>16);

        $data['nav'] = $this->load->view('withdrawal-queue/nav', $nav,TRUE);

        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("
                      <script type='text/javascript'>
                        var site_url='".site_url('')."';
                      </script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script src='".$js."datatables.responsive.1.0.7.js'></script>
                      <script src='".$js."withdrawalqueue-qiwi.js'></script>
                      <script src='".$js."bootbox.min.js'></script>
                      <script type='text/javascript'>
                          $(function() {
                            $('#withdrawalqueue').addClass('active-int-nav');
                         });
                      </script>
                ")
            ->set_layout('administration/main')
            ->build('administrator/withdrawalqueueQiwi',$data);
    }

    public function GetWithdrawalTransactionYM(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionYandex($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionSF(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionSofort($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionMN(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionMoneta($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionQW(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionQiwi($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionBC(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionBitcoin($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionMT(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionMegatransfer($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionMTC(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionMegatransferCard($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
//                $details['skrill_account'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }

    public function GetWithdrawalTransactionPP(){

        $statusId = array();
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

        $recordsTotal = $this->Transactions_model->CountWithdrawalTransaction($statusId, $_POST['activeTransaction']);
        $getWithdrawTransactions = $this->Transactions_model->getWithdrawalTransactionPaypal($statusId, $_POST['start'], $_POST['length'], $_POST['activeTransaction']);

        $data = array();

        foreach($getWithdrawTransactions as $details){

            $recall = $details['recall'];
            $recalled = $recall ? 'Yes' : 'No';

            $tempArray = array(
                'DT_RowId' => $details['id'],
                $details['reference_number'],
                $details['full_name'],
                $details['account_number'],
                $details['amount']." ".$details['currency'],
                $details['amount_deducted']." ".$details['currency'],
                $details['date_withdraw'],
                $recalled,
            );

            $transInfo = array(
                'Id' => $details['id'],
                'clientName' => $details['full_name'],
                'referenceNumber' => $details['reference_number'],
                'transactionType' => $this->transaction_type[$details['transaction_type']]
            );

            switch($_POST['tab']){
                case 'Request':
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = "<a href='javascript:void(0)' data-info='".json_encode($transInfo)."' class='approve-link'>Approve</a> | <a href='#' data-info='".json_encode($transInfo)."' class='decline-link' data-toggle='modal' data-target='#decline_modal'>Decline</a>";
                    }
                    array_push($tempArray, $action);
                    break;
                default:
                    if ($this->session->userdata('action_status') == 'read_only') {
                        $action = 'Read Only';
                    } else {
                        $action = $_POST['tab'];
                    }
                    array_push($tempArray, $action);
                    break;
            }
            $data[] = $tempArray;
        }
        $result = array(
            'draw'              => (int) $_POST['draw'],
            'recordsTotal'      => (int) $recordsTotal['Count'],
            'recordsFiltered'   => (int) $recordsTotal['Count'],
            'data'              => $data,
            'tab'              => $_POST['tab'],
        );

        echo json_encode($result);
    }


}