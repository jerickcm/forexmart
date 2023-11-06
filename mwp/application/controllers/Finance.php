<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller
{
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
    public function __construct()
    {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) { // logged in
            redirect('signin');
        }
        $this->load->library('UserAccess');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('General_model');
        $this->g_m = $this->General_model;

    }

    public function index()
    {
    }
    public function withdrawal(){
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = 'finance';
        $data['li_active'] = 'withdrawal';
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('finance/withdrawal', $data);
    }
}