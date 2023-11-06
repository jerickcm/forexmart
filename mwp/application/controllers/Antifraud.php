<?php

class Antifraud extends CI_Controller{

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
        'PP' => 'PayPal'
    );

    private $deposit_transaction_type = array(
        'WIRE_TRANSFER' => 'BANK TRANSFER',
        'WR_TR' => 'BANK TRANSFER',
        'NT'=>'NETELLER',
        'PC'=>'PAYCO',
        'PX'=>'PAXUM',
        'CU'=>'CashU',
        'SK'=>'SKRILL',
        'PS'=>'PAYSERA',
        'UK'=>'UKASH',
        'FP'=>'FILSPAY',
        'CP'=>'CARDPAY',
        'CUP'=>'CHINA UNIONPAY',
        'MT'=>'MEGATRANSFER',
        'BS'=>'BANK OF CYPRUS',
        'PP'=>'PAYPAL',
        'YM'=>'YANDEX MONEY',
        'QW'=>'QIWI',
        'SF'=>'SOFORT',
        'HW'=>'HIPAY WALLET',
        'PM'=>'PAYMILL',
        'BC' => 'BITCOIN'
    );

    public function __construct(){
        parent::__construct();
        $this->load->model('Finance_model');
        $this->load->library('Fx_mailer');
        $this->load->library('UserAccess');
        $this->load->model('Account_model');
        $this->load->model('General_model');
        $this->load->model('Quick_model');
        $this->load->library('WebService');
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
        $this->country_code = FXPP::getUserCountryCode() or null;
        $this->g_m=$this->General_model;
        $this->q_m=$this->Quick_model;

        if (!$this->tank_auth->is_logged_in()) { // logged in
            redirect('signin');
        }
    }

    public function index(){
        UserAccess::checkUserPermission("antilanding");
        if ($this->session->userdata('admin_manage')) {
            $data['access'] = UserAccess::ManageAccessList();
            $data['active'] = "antifraud";
            $data['li_active'] = "li_fraud";
            $data['showData'] = array();
            $data['result'] = array();
            $data['apiAccounts'] = array();

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->GetAccountsWithShortDeals();

            switch ($WebService->request_status) {
                case 'RET_OK':
                    $totalAccount = (array)$WebService->get_result('AccountsList');

                    if (!empty($totalAccount['AccountData'])) {
                        $data['apiAccounts'] = $totalAccount['AccountData'];
                    }

                    break;
                default:
                    $data['data']['error'] = true;
            }

            $data['countryCode'] = $this->general_model->getCountries();

            $data['nav'] = 0;

            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
                 ')
                ->append_metadata_js("
                ")
                ->set_layout('mwp/v2_main')
                ->build('anti_fraud/antifraud_landing', $data);
        } else {
            setcookie('referer', $_SERVER[REQUEST_URI], time() + (86400 * 30), "/");
            redirect('signout/admin');
        }
    }

        public function getAccountDetails(){
            UserAccess::checkUserPermission("antilanding");
            
            if ($this->session->userdata('admin_manage')){
            $account_number = $this->input->post('id');
            $data['apiGetAccDet'] = array();
            $webservice_config = array('iLogin' => $account_number, 'server' => 'live_new');
            $WebService = new WebService($webservice_config);

            $WebService->GetShortDealsOfAccount($webservice_config);

            switch ($WebService->request_status) {
                case 'RET_OK':
                    $totalAccount = (array)$WebService->get_result('TradeDataList');
                    
                    if (!empty($totalAccount['TradeData'])) {
                        $data['apiGetAccDet'] = $totalAccount['TradeData'];
                    }

                    break;

                default:
                    $data['data']['error'] = true;
            }
            echo json_encode($data['apiGetAccDet']);
        }
    }
}
