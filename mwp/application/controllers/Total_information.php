
<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Total_information extends CI_Controller {
    public function __construct(){

        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {									// logged in
            redirect('signin');
        }
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
        $this->lang->load('ForexMart_Internal','english');
        $this->load->model('account_model');
    }


    public function index(){

    }
    public function trade(){

        UserAccess::checkUserPermission("tinfo");

        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');


        if ($this->form_validation->run()){

            $this->load->library('WebService');
            $account_number = $this->input->post('account_number');
           if($this->general_model->showssingle2('mt_accounts_set','account_number',$account_number,'account_number')){
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);

            $from = DateTime::createFromFormat('Y/d/m', "2015/01/01");

            $to = DateTime::createFromFormat('Y/d/m H:i:s',  date('Y/d/m').'23:59:59');
            $account_info = array(
                'iLogin' => $account_number,
                'from' => $from->format('Y-m-d\TH:i:s') ,
                'to' => $to->format('Y-m-d\TH:i:s'),

            );

               $data['total'] = 0;

            $WebService->open_GetAccountTradesHistory($account_info);
            $data['flag'] = false;
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('TradeDataList');

                    if($tradatalist){
                        $opened='';
                        foreach ( $tradatalist['TradeData'] as $object){
                            $opened.='<tr>';
                            $opened.='<td>'.$object->OrderTicket.'</td>';
                            $opened.='<td>'.$object->TradeType.'</td>';
                            $opened.='<td>'.$object->Volume.'</td>';
                            $opened.='<td>'.$object->Symbol.'</td>';
                            $opened.='<td>'.$object->OpenPrice.'</td>';
                            $opened.='<td>'.$object->StopLoss.'</td>';
                            $opened.='<td>'.$object->TakeProfit.'</td>';
                            $opened.='<td>'.$object->ClosePrice.'</td>';
                            $opened.='<td>N/A</td>';
                            $opened.='<td>'.$object->Profit.'</td>';
                            $opened.='</tr>';
                            $data['total'] += $object->Profit;
                        }
                        $data['result'] = true;
                        $data['Opened']= $opened;
                        $data['flag'] = true;
                    }else{
                        $data['Opened']='';
                        $data['msg']= "No data available";
                    }
                    break;
                default:
                    $data['msg']= "No data available";
            }
           }else{
               $data['msg']= "Account number incorrect.";
           }

        }else{
            $data['user_documents'] = false;
        }

        $data['menu'] = "accordion-total-information";
        $data['active'] = "trade";

        $data['status'] = array("Pending","Approved","Declined");

        $data['access']= UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("

                ")
            ->set_layout('mwp/main')
            ->build('total_information/history_of_trades',$data);
    }

    public function saldo(){
        UserAccess::checkUserPermission("infosaldo");

        $data['active'] = "info";
        $data['li_active'] = "li_saldo";
        $data['access']= UserAccess::ManageAccessList();
        $data['status'] = array("Pending","Approved","Declined");

        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');

        if ($this->form_validation->run()){
            $this->load->library('WebService');
            $account_number = $this->input->post('account_number');

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $account_number,
            );

            $WebService->open_RequestAccountBalance($account_info);
            $data['flag'] = false;
            switch($WebService->request_status){
                case 'RET_OK':
                    $data['Balance'] = $this->roundno(floatval( $WebService->get_result('Balance')),2);
                    $data['Equity'] = $this->roundno(floatval( $WebService->get_result('Equity')),2);
                    $data['FreeMargin'] = $WebService->get_result('FreeMargin');
                    $data['LogIn'] = $WebService->get_result('LogIn');
                    $data['Margin'] = $WebService->get_result('Margin');
                    $data['Ticket'] = $WebService->get_result('Ticket');
                    $data['result'] = true;
                    $data['flag'] = true;
                    break;
                default:
                    $data['msg']= "Account number incorrect.";
            }

        }



        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("

                ")
            ->set_layout('mwp/v2_main')
            ->build('total_information/saldo',$data);
    }

    public function deposits(){

        UserAccess::checkUserPermission("tinfo");

        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');


        if ($this->form_validation->run()){
            $account_number = $this->input->post('account_number');
                $res = $this->account_model->getTotalDeposit($account_number, 2);
                $data['acctno'] = $account_number;
                if ($res[0]->total == null) {
                    $data['totalDeposit'] = 0.00;
                } else {
                    $data['totalDeposit'] = number_format($res[0]->total, 2);
                }
        }

        $data['menu'] = "accordion-total-information";
        $data['active'] = "deposits";

        $data['status'] = array("Pending","Approved","Declined");

        $data['access']= UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("

                ")
            ->append_metadata_js("

                ")
            ->set_layout('mwp/main')
            ->build('total_information/deposits',$data);
    }








    private function roundno($number,$dp) {
        return number_format((float)$number, $dp,'.','');
    }



}