<?php

/**
 * Created by PhpStorm.
 * User: IT
 * Date: 4/13/16
 * Time: 8:55 AM
 */
class Informers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('account_model');
      // if(!IPLoc::Office()){redirect('');}

    }

    public function index()
    {
        ini_set('memory_limit', '-1');
        $all_client = array();
        foreach($this->account_model->getAllUser() as $d){
            $all_client[$d->account_number] = array('full_name'=>$d->full_name,'country'=>$d->country);
        }

        $this->load->library('WebService');
        $commissions = array();
        $amount = array();
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->GetTopAccountsTotalCommissions();
        if($WebService->request_status == "RET_OK"){

            $res =  $WebService->result['TopCommissionsList']->TopCommissionData;
            if(count($res)>0){
                foreach($res as $d){
                    $commissions[$d->Account] = $d;
                }
            }
        }

        $WebService1 = new WebService($webservice_config);
        $WebService1->GetTopaccountsTotalBalances();

        if($WebService1->request_status == "RET_OK"){

             $res =  $WebService1->result['TopBalancesList']->TopBalanceData;

            if(count($res)>0){
                foreach($res as $d){
                    $amount[$d->Account] = $d;
                }
            }
        }

        $data['data']['account'] = $amount;
        $data['data']['commissions'] = $commissions;
        $data['data']['all_client'] = $all_client;

        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['metadata_description'] = lang('b_dsc');
        $data['metadata_keyword'] = lang('b_kew');

        $this->template->title(lang('b_tit'))
            ->append_metadata_js('
                <script src="//code.jquery.com/jquery-1.12.0.min.js" ></script>

                ')
            ->set_layout('external/main')
            ->build('external_informers_partner', $data);
    }
    public function informers_partner()
    {

        ini_set('memory_limit', '-1');
        $this->load->library('pagination');

        $per_page = $this->input->get('per_page');
        $config['page_query_string'] = TRUE;
        $config['base_url'] =  FXPP::ajax_url('Informers');
        $config['total_rows'] = $this->account_model->getAllClientsCount();
        $config['per_page'] = 10;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";



        $this->pagination->initialize($config);

        $data['total_count'] = $this->general_model->CountRecords('partnership');



        $client_list = $this->account_model->getAllClients($per_page);
        $this->load->library('WebService');

        $client = array();
        $webservice_config = array('server' => 'live_new');
        if($client_list){
            foreach ($client_list as $d) {

                $account_number = $d['account_number'];
                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iLogin' => $account_number,


                );

                $WebService->open_RequestAccountBalance($account_info);

                $client[] = array(
                    'account_number' => $d['account_number'],
                    'country' => $d['country'],
                    'full_name' => $d['full_name'],
                    'equity' => $WebService->get_result('Equity'),
                    'balance' => $WebService->get_result('Balance')
                );
            }

            $data['client'] = $client;
        }

        $data['partner'] = $this->account_model->getAffiliateAccounts();

        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['metadata_description'] = lang('b_dsc');
        $data['metadata_keyword'] = lang('b_kew');
        $this->template->title(lang('b_tit'))
            ->append_metadata_js('
                <script src="//code.jquery.com/jquery-1.12.0.min.js" ></script>

                ')
            ->set_layout('external/main')
            ->build('external_informers_partner', $data);
    }
} 