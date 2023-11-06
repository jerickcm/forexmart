<?php
class Agent_commission_calculator extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('General_model');
        $this->load->model('account_model');
        $this->load->model('administrator_model');
        $this->load->model('Mailer_model');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->load->library('Fx_mailer');
        $this->g_m=$this->General_model;
        $this->flag = 1;
    }

    public function index(){
        if ($this->session->userdata('admin_manage')) {
            // Check permission
            $data['access']= UserAccess::ManageAccessList();

            $this->template->title("Administration | Agent Commission Calculator")
                ->append_metadata_css("
                    
                    <link rel='stylesheet' href='".$this->template->Css()."inscrolling-nav.css'>")
                ->append_metadata_js("")
                ->set_layout('mwp/v2_main')
                ->build('total_information/agent-commission-calculator',$data);
        } else {
            redirect('signout/admin');
        }
    }

    public function findAccountNumber() {
        if ($this->session->userdata('admin_manage')) {
            $account_number = $this->input->post('account_number');
            $findAgent = $this->administrator_model->getAgentByAccountNumber($account_number);
            $result = $this->administrator_model->getAccountNumfromAffliateCode($findAgent[0]->user_id);

            if(!empty($result)){
                return json_encode($result,true);
            }else{
                return false;
            }
        } else {
            redirect('signout/admin');
            return false;
        }
    }

    public function calculate() {
        $data = array(
            'iAgent'    =>  $this->input->post('account'),
            'affiliate' =>  $this->input->post('affiliate'),
            'type'      =>  $this->input->post('type'),
            'from'      =>  date('Y-m-d\TH:i:s', strtotime($this->input->post('from'))),
            'to'        =>  date('Y-m-d\TH:i:s', strtotime($this->input->post('to'))),
        );
        $result = $this->getCommission($data);

        $this->output->set_content_type('application/json')
            ->set_output(
                json_encode(
                    array(
                        'error' => $result['isError'],
                        'message' => $result['message'],
                        'result' => $result['result'],
                    )
                )
            );
    }

    public function getCommission($array) {
        $returnResult = array(
            'isError'   =>  true,
            'message'   =>  '',
        );

        $result = array();

        //search partner
        $findAgent = $this->administrator_model->getAgentByAccountNumber($array['iAgent']);
        if (!$findAgent || $array['iAgent'] == 0) {
            $returnResult['message'] = 'Agent account number does not exist.';
            return $returnResult;
        }

        if ($array['type'] === 'specific') {
            $affiliates = $this->administrator_model->getAgentsAffiliateByAccountNum($findAgent['user_id'],$array['affiliate']);
            if (!$affiliates || $array['affiliate'] == 0) {
                $returnResult['message'] = 'Affiliate account number does not exist.';
                return $returnResult;
            }
        }

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        switch ($array['type']) {
            case 'all':
                $account_info = array('iAgent'=>$array['iAgent'],'from'=>$array['from'],'to'=>$array['to']);
                $result[] = $WebService->getTotalCommissionFromAllAccount($account_info);
                break;
            case 'group':
                $account_info = array('iAgent'=>$array['iAgent'],'from'=>$array['from'],'to'=>$array['to']);
                $WebService->getTotalCommissionGroupByAccount($account_info);
                $result = $WebService->get_result('CommissionTotal');
                break;
            case 'specific':
                $account_info = array('iAgent'=>$array['iAgent'],'iAccount'=>$array['affiliate'],'from'=>$array['from'],'to'=>$array['to']);
                $result[] = $WebService->getTotalCommissionFromAccount($account_info);
                break;
        }

        if (!$result) {
            $returnResult['message'] = 'WebService is not available. Please try again later.';
            return $returnResult;
        }

        $returnResult['result'] = $result;
        $returnResult['isError'] = false;
        return $returnResult;
    }

}