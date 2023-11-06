<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ForexMartClientAPI extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('WebService');
    }

    public function index(){

    }

    public function CheckTradeHistory(){


        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        $loginId    = "101491";      // this must be changed
        $fdate = "12/2/2009 05:20:20";
        $fromDate = date('Y-m-d\TH:i:s', strtotime($fdate));
        $tDate   = '1/1/2017 12:40:20 AM';  // this must be changed
        $toDate     = date('Y-m-d\TH:i:s', strtotime($tDate)); // this must be changed

        $data_array = array(
            'iLogin'    => $loginId,
            'from'      => $fromDate,
            'to'        => $toDate,
        );

        $WebService->ClientGetAccountTradesHistory($data_array);
      // echo $WebService->request_status ;exit;

        if( $WebService->request_status === 'RET_OK' ){
            $tradeHistory = (array) $WebService->get_result('TradeDataList');

            if(IPLoc::Office()){
                echo '<pre>';
                print_r($tradeHistory);
                exit;
            }
        }
    }

    public function AffiliateProgram(){
        $webservice_config = array(
            'server' => 'live_new'
        );
        $WebService = new WebService($webservice_config);

        $address    = '';
        $city       = 'Bandar Puncak Alam';
        $country    = 'MY';
        $email      = '';
        $group      = '';
        $leverage   = '';
        $name       = 'Muhammad Bin Zainal Abiddin';
        $phone      = '';
        $state      = '';
        $zipCode    = '42300';
        $password   = '';

        $service_data = array(
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'email' => $email,
            'group' => $group,
            'leverage' => $leverage,
            'name' => $name,
            'phone_number' => $phone,
            'state' => $state,
            'zip_code' => $zipCode,
            'phone_password' => $password
        );


        $WebService->open_account_standard($service_data);

        $affiliateHistory = (array) $WebService->request_status();
        print_r($affiliateHistory);
    }
}

?>