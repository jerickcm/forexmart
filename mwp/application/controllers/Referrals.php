<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Referrals extends CI_Controller{

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('account_model');
        $this->load->library('UserAccess');
    }
    public function index(){
        UserAccess::checkUserPermission("part");
        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $account_number = $this->input->post('account_number');
            $data['accountsearch'] = $account_number;
            //FXPP-4975
            $this->load->model('Finance_model');
            $client = $this->Finance_model->getAccountDetailsByAcctNumber($account_number, 'client')['rows'];
            $partner = $this->Finance_model->getAccountDetailsByAcctNumber($account_number, 'partner')['rows'];
            if(count($client) > 0){
                $arrayClient = [];
                foreach ($client as $key => $value) {
                    $info[$key]= $this->getUserdetails($value->account_number);
                    $data['info']= array( array_merge((array) $client[$key],$info[$key]) );
//                    $affiliates = $this->Finance_model->getAffiliates1($value->affiliate_code);
//                    if($affiliates!=null){
//                        array_push($arrayClient, $affiliates['rows']);
//                    }
                }
                $finalRes = [];
//                foreach ($arrayClient as $key => $values) {
//                    if(!empty($value)){
//                        foreach ($values as $value) {
//                            $info1 = (array)$value;
//                            $details = $this->getUserdetails($info1['account_number']);
//                            if($details=='' || $details==false){
//                                $details = $this->getInactivedetails($info1['account_number']);
//                                if($details=='' || $details==false){  $details = array (); }
//                            }else{
//                                $details = $this->getUserdetails($info1['account_number']);
//                            }
//                            array_push($finalRes, array(array_merge($info1,$details)));
//                        }
//                    }
//                }
                $data['info1'] = $finalRes;
            }else if(count($partner)>0){
                $arrayPartner = [];
                foreach ($partner as $key => $value) {
                    $info[$key]= $this->getUserdetails($value->reference_num);
                    $data['info']= array( array_merge((array) $partner[$key],$info[$key]) );
//                    $affiliates = $this->Finance_model->getAffiliates1($value->affiliate_code);
//                    if($affiliates!=null){
//                        array_push($arrayPartner, $affiliates['rows']);
//                    }
                }
                $finalRes = [];
//                foreach ($arrayPartner as $key => $values) {
//                    if(!empty($value)){
//                        foreach ($values as $value) {
//                            $info1 = (array)$value;
//                            $details = $this->getUserdetails($info1['account_number']);
//                            if($details=='' || $details==false){
//                                $details = $this->getInactivedetails($info1['account_number']);
//                                if($details=='' || $details==false){  $details = array (); }
//                            }else{
//                                $details = $this->getUserdetails($info1['account_number']);
//                            }
//                            array_push($finalRes, array(array_merge($info1,$details)));
//                        }
//                    }
//                }
                $data['info1'] = $finalRes;
                $data['test11'] = json_encode($partner);
            }else{
                $data['noinfo'] = false;
            }
        }
        $data['access'] = UserAccess::ManageAccessList();
        $data['active'] = "partners";
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->set_layout('mwp/v2_main')
            ->build('accounts/referrals', $data);
    }
    public function getUserdetails($account_number){
        $webservice_config = array(  'server' => 'live_new'  );
        $webService = new WebService($webservice_config);
        $data = array( 'iLogin' => $account_number );
        $webService->request_account_details($data);
        if ($webService->request_status === 'RET_OK') {
            $data = $webService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }
    public function getInactivedetails($account_number){
        $webservice_config = array(  'server' => 'live_new'  );
        $webService = new WebService($webservice_config);
        $data = array( 'iLogin' => $account_number );
        $webService->request_inactive_details($data);
        if ($webService->request_status === 'RET_OK') {
            $data = $webService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }
    public function search(){
        if ($this->input->is_ajax_request()) {
            $account_number = $this->input->post('account_number');
            $this->load->model('Finance_model');
            $client = $this->Finance_model->getAccountDetailsByAcctNumber($account_number, 'client')['rows'];
            $partner = $this->Finance_model->getAccountDetailsByAcctNumber($account_number, 'partner')['rows'];
            $arrayClient = '';
            $agent = count($client)>0?$client:$partner;
            if(count($agent) > 0){
                foreach ($agent as $key => $value) {
                    $info = $this->getUserdetails($account_number);
                    $type = $value->login_type==0?'Client Partner':$value->type_of_partnership;
                    $data['info']= array( array_merge((array) $partner[$key],$info[$key]) );
                    $arrayClient .= '<tr><td>'.$account_number.'</td>';
                    $arrayClient .= '<td>'.$info['Name'].'</td>';
                    $arrayClient .= '<td>'.$type.'</td>';
                    $arrayClient .= '<td><button class="affiliates" data-code="'.$value->affiliate_code.'">'.$value->affiliate_code.'</button></td></tr>';
                }
                $success = true;
            }else{
                $arrayClient = '<tr><td colspan="4">No data available.</td></tr>tr>';
                $success = false;
            }
            $data['info'] = $arrayClient;
            $data['success'] = $success;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    public function get_code_referrals()
    {
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            $this->load->model('Finance_model');
            $code = $this->input->post('code');
            $account_referrals = $this->Finance_model->getReferrals($code)['rows'];
            $referrals = '';
            foreach ($account_referrals as $key) {
                $referrals .= '<tr>
                    <td>' . $key->account_number. '</td>
                    <td>' .$key->full_name. '</td>
                    <td>' . $key->full_name . '</td>
                    <td>'.$key->affiliate_code.'</td>
                </tr>';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('referrals' => $referrals)));
        }
    }
}