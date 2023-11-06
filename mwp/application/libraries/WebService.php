<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class WebService {
//http://136.243.89.90:9000/html/83a79d5a-6822-62f2-efa5-f499c516d2bb.htm
    private $proxy;
    public $request_status;
    private $result = array();
    private $request_ip;
    protected $service_id = '10001';
    protected $service_password = 'Bj4mQBqP';

    private $config_keys_allowed = array(
        'url', 'service_id', 'service_password'
    );

    protected $url;
    protected $server_url = array(
        'demo' =>'http://136.243.89.90:44388/MT4ApiService.svc?wsdl',
        'live' =>'http://136.243.89.90:44360/MT4ApiService.svc?wsdl',
//        'demo_new' => 'http://136.243.89.90:9060/MT4ApiService.svc?wsdl',
//        'live_new' => 'http://136.243.89.90:9050/MT4ApiService.svc?singleWsdl',
//        'currency_converter' => 'http://136.243.89.90:9088/Converter.svc?wsdl'        
        'demo_new' => 'https://78w.forexmart.com:9060/MT4ApiService.svc?wsdl',
        'live_new' => 'https://78w.forexmart.com:9050/MT4ApiService.svc?singleWsdl',
        'live_new_wsdl' => 'https://78w.forexmart.com:9050/MT4ApiService.svc?wsdl',
        'live_new_no_wsdl' => 'https://78w.forexmart.com:9050/MT4ApiService.svc',
        'currency_converter' => 'https://78w.forexmart.com:9088/Converter.svc?singleWsdl'

    );

    public function WebService( $config = array() ){
        ini_set("soap.wsdl_cache_enabled", "0");
        $ci =& get_instance();
        $this->request_ip = $ci->input->ip_address();
        self::initialize($config);
    }

    /**
     * Initialize WebService with given $config
     */

    protected function initialize( $config ){
        try	{

            if( array_key_exists('server', $config) ){
                if( array_key_exists($config['server'], $this->server_url) )
                    $this->url = $this->server_url[$config['server']];
                else
                    $this->url = $this->server_url['demo_new'];
            }else{
                $this->url = $this->server_url['demo_new'];
            }

            if( array_key_exists('service_id', $config) ){
                $this->service_id = $config['service_id'];
            }

            if( array_key_exists('service_password', $config) ){
                $this->service_password = $config['service_password'];
            }

            $this->proxy = new SoapClient($this->url, array(
                'soap_version'=> SOAP_1_1,
                'exceptions' => true,
                'trace' => true,
                'features' => SOAP_SINGLE_ELEMENT_ARRAYS
            ));

            return true;
        }catch (SoapFault $e) {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetProxy',null)
            );
        }
    }

    /**
     * Open Demo Account Method
     * Request result are stored in WebService::result
     */
    public function open_account_demo( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'isStandard' => $account_info['standard'],
                'isStandardSpecified' => true,
                'strName' => $account_info['name'],
                'strEmail' => $account_info['email'],
                'strCurrency' => $account_info['currency'],
                'iLeverage' => $account_info['leverage'],
                'strPhonePassword' => ''
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenAccountDemo($merge_data);
            $this->request_status = $oAccountData->OpenAccountDemoResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->OpenAccountDemoResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountDetails',$eData)
            );
        }
    }

    /**
     * Open Demo Contest Account Method
     * Request result are stored in WebService::result
     */
    public function open_account_demo_contest( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'IsSwapFree' => $account_info['is_swap_on'],
                'IsSwapFreeSpecified' => true,
                'strName' => $account_info['name'],
                'strEmail' => $account_info['email'],
                'strCity' => $account_info['city'],
                'strCountry' => substr($account_info['country'],0,31),
                'strPhone' => $account_info['phone_number'],
                'strPhonePassword' => ''
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenAccountDemoContest($merge_data);
            $this->request_status = $oAccountData->OpenAccountDemoContestResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->OpenAccountDemoContestResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'OpenAccountDemoContest',$eData)
            );
        }
    }

    /**
     * Get Demo Account Details Method and Live
     * Request result are stored in WebService::result
     */
    public function request_account_details( $data = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $data['iLogin']
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAccountDetails($merge_data);
            $this->request_status = $oAccountData->RequestAccountDetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountDetailsResult);
//             echo '<pre>';
//             print_r($this->result);exit;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountDetails',$eData)
            );
        }
    }
    public function request_inactive_details( $data = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $data['iLogin']
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Request_Inactive_Account_Details($merge_data);
            $this->request_status = $oAccountData->Request_Inactive_Account_DetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Request_Inactive_Account_DetailsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Request_Inactive_Account_Details',$eData)
            );
        }
    }

    /**
     * Open Live Standard Account Method
     * Request result are stored in WebService::result
     */
    public function open_account_live_standard( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'accountInfo' => array(
                    'Address' => $account_info['address'],
                    'City' => $account_info['city'],
                    'Country' => substr($account_info['country'],0,31),
                    'Currency' => $account_info['currency'],
                    'Email' => $account_info['email'],
                    'IsSwapFree' => $account_info['is_swap_on'],
                    'IsSwapFreeSpecified' => true,
                    'Leverage' => $account_info['leverage'],
                    'LeverageSpecified' => true,
                    'Name' => $account_info['name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => $account_info['state'],
                    'ZipCode' => $account_info['zip_code'],
                    'IsReadOnly' => true,
                    'IsReadOnlySpecified' => true,
                    'PhonePassword' => $account_info['phone_password']
                )
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenRealStandardAccount($merge_data);
            $this->request_status = $oAccountData->OpenRealStandardAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->OpenRealStandardAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'OpenRealStandardAccount',$eData)
            );
        }
    }

    /**
     * Open Standard Account Method
     * Request result are stored in WebService::result
     */
    public function open_account_standard( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'accountInfo' => array(
                    'Address' => $account_info['address'],
                    'City' => $account_info['city'],
                    'Comment' => '',
                    'Country' => substr($account_info['country'],0,31),
                    'Email' => $account_info['email'],
                    'Group' => $account_info['group'],
                    'Leverage' => $account_info['leverage'],
//                    'LeverageSpecified' => true,
                    'Name' => $account_info['name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => $account_info['state'],
                    'ZipCode' => $account_info['zip_code'],
                    'IsReadOnly' => true,
//                    'IsReadOnlySpecified' => true,
                    'PhonePassword' => $account_info['phone_password']
                )
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenAccount($merge_data);
//            echo "<pre>";
//            print_r($merge_data);
//            echo "<br>";
//            print_r($oAccountData);
            $this->request_status = $oAccountData->OpenAccountResult->ReqResult;

//            $this->request_status = $oAccountData->OpenRealStandardAccountResult->ReqResult;
//            $this->result = self::get_array_object($oAccountData->OpenRealStandardAccountResult);
            $this->result = self::get_array_object($oAccountData->OpenAccountResult);
            return true;
        } catch (SoapFault $e)  {
//            print_r($e);exit;
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'OpenRealStandardAccount',$eData)
            );
        }
    }

    /**
     * Open Live Zero Spread Account Method
     * Request result are stored in WebService::result
     */
    public function open_account_live_zero_spread( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'accountInfo' => array(
                    'Address' => $account_info['address'],
                    'City' => $account_info['city'],
                    'Country' => substr($account_info['country'],0,31),
                    'Currency' => $account_info['currency'],
                    'Email' => $account_info['email'],
                    'IsSwapFree' => $account_info['is_swap_on'],
                    'IsSwapFreeSpecified' => true,
                    'Leverage' => $account_info['leverage'],
                    'LeverageSpecified' => true,
                    'Name' => $account_info['name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => $account_info['state'],
                    'ZipCode' => $account_info['zip_code'],
                    'IsReadOnly' => true,
                    'IsReadOnlySpecified' => true,
                    'PhonePassword' => $account_info['phone_password']
                )
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenRealZeroSpreadAccount($merge_data);
            $this->request_status = $oAccountData->OpenRealZeroSpreadAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->OpenRealZeroSpreadAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'OpenRealZeroSpreadAccount',$eData)
            );
        }
    }

    /**
     * Open Affiliate Account Method
     * Partnership registrations
     * Request result are stored in WebService::result
     */
    public function open_account_affiliate( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'accountInfo' => array(
                    'Country' => substr($account_info['country'],0,31),
                    'Currency' => $account_info['currency'],
                    'Email' => $account_info['email'],
                    'FullName' => $account_info['name'],
                    'Phone' => $account_info['phone_number'],
                    'PhonePassword' => $account_info['phone_password']
                )
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenAffiliateAccount($merge_data);
            $this->request_status = $oAccountData->OpenAffiliateAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->OpenAffiliateAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'OpenAffiliateAccount',$eData)
            );
        }
    }

    /**
     * Update Account Deposit Balance Method
     * Request result are stored in WebService::result
     */
    public function update_demo_deposit_balance( $account_number, $amount = 0 ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Login' => $account_number,
                    'LoginSpecified' => true,
                    'Amount' => (float) $amount,
                    'AmountSpecified' => true,
                    'FundTransferAccountReceiver' => 0,
                    'FundTransferAccountReceiverSpecified' => true,
                    'Comment' => '',
                    'ProcessByIP' => '',
                    'serviceId' =>  $this->service_id,
                    'serviceIdSpecified' =>  true,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->DemoDepositBalance($data);
            $this->request_status = $oAccountData->DemoDepositBalanceResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->DemoDepositBalanceResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'DemoDepositBalance',$eData)
            );
        }
    }

    /**
     * Update Live Account Deposit Balance Method
     * Request result are stored in WebService::result
     */
    public function update_live_deposit_balance( $account_number, $amount = 0 ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => '',
                    'FundTransferAccountReciever' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->DepositRealFund($data);
            $this->request_status = $oAccountData->DepositRealFundResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->DepositRealFundResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'DepositRealFund',$eData)
            );
        }
    }

    /**
     * Update Account Withdraw Balance Method
     * Request result are stored in WebService::result
     */
    public function update_withdraw_balance( $account_number, $amount = 0 ){
        $eData = array();
        try {
            $data = array(
                'iAccountNumber' => $account_number,
                'iAccountNumberSpecified' => true,
                'dPrice' => (float) $amount,
                'dPriceSpecified' => true,
                'strComment' => ''
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->UpdateAccountBalanceWithdraw($merge_data);
            $this->request_status = $oAccountData->UpdateAccountBalanceWithdrawResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->UpdateAccountBalanceWithdrawResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UpdateAccountBalanceWithdraw',$eData)
            );
        }
    }

    /**
     * Get Demo Account Balance Method
     * this is currently used for contest winners
     * Request result are stored in WebService::result
     */
    public function request_demo_account_balance( $account_number ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_number
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAccountBalance($merge_data);
            $this->request_status = $oAccountData->RequestAccountBalanceResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountBalanceResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountBalance',$eData)
            );
        }
    }

    /**
     * Get Demo Account Balance Method
     * this is currently used for contest winners
     * Request result are stored in WebService::result
     */
    public function request_live_account_balance( $account_number ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_number,
                'iAccountNumberSpecified' => true
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAccountBalance($merge_data);
            $this->request_status = $oAccountData->RequestAccountBalanceResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountBalanceResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UpdateAccountBalanceWithdraw',$eData)
            );
        }
    }

    /**
     * Get WebService Request Result Method
     * Returns result value based on the given field
     */
    public function get_result( $field ){
        if( array_key_exists($field, $this->result) ) {
            return $this->result[$field];
        }else{
            return false;
        }
    }

    public function get_all_result(){
        return $this->result;
    }

    public function hello_world(){
        return 'hello world!';
    }

    /**
     * WebService Authentication for every request.
     * Credentials should be merge to the given data parameters for request
     */
    protected function set_service_auth( $data = array() ){
        $service_auth = array(
            'serviceId' =>  $this->service_id,
            'servicePassword' =>  $this->service_password,
        );
        return array_merge($service_auth, $data);
    }

    /**
     * WebService converting object to array data type.
     */
    protected function get_array_object($object){
        $arrayObject = new ArrayObject($object);
        return $arrayObject->getArrayCopy();
    }

    public function __destruct(){
        unset($this);
    }

    public static function Exception($e, $subject, $eData) {
        //error logging
    }

    /**
     * Live No DepositBonus Method
     *
     */
    public function open_Deposit_NoDepositBonus( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Login' => $account_info['Login'],
                    'FundTransferAccountReceiver' => $account_info['FundTransferAccountReciever'],
                    'Amount' => $account_info['Amount'],
                    'Comment' => $account_info['Comment'],
                    'ProcessByIP' => $account_info['ProcessByIP'],
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password,

                )
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_NoDepositBonus($merge_data);
            $this->request_status = $oAccountData->Deposit_NoDepositBonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_NoDepositBonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_NoDepositBonus',$eData)
            );
        }
    }
    /**
     * Live 30PercentBonus Method
     *
     */
    public function open_Deposit_30PercentBonus( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Login' => $account_info['AccountNumber'],
                    'Amount' => $account_info['Amount'],
                    'Comment' => $account_info['Comment'],
                    'FundTransferAccountReceiver' => 0,
                    'FundTransferReceiverAmount' => 0,
                    'ProcessByIP' => $account_info['ProcessByIP'],
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_30PercentBonus($merge_data);
            $this->request_status = $oAccountData->Deposit_30PercentBonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_30PercentBonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_30PercentBonus',$eData)
            );
        }
    }


    /**
     * WebService method for updating live account details
     * this method is used in administration - manage accounts
     */
    public function update_live_account_details( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['AccountNumber'],
                'info' => array(
                    'City' => $account_info['City'],
                    'Country' => $account_info['Country'],
                    'Email' => $account_info['Email'],
//                    'Leverage' => $account_info['leverage'],
//                    'Group' => $account_info['group'],
                    'Name' => $account_info['Name'],
                    'PhoneNumber' => $account_info['PhoneNumber'],
                    'State' => $account_info['State'],
                    'StreetAddress' => $account_info['StreetAddress'],
                    'ZipCode' => $account_info['ZipCode'],
                    'Comment' => $account_info['Comment']
                )
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->UpdateAccountDetails($merge_data);
            $this->request_status = $oAccountData->UpdateAccountDetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->UpdateAccountDetailsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UpdateAccountDetails',$eData)
            );
        }
    }


    /**
     * WebService method for updating live account details
     * this method is used in administration - manage accounts
     */
    public function update_affiliate_account_details( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['account_number'],
                'info' => array(
                    'City' => '',
                    'Country' => substr($account_info['country'],0,31),
                    'Email' => $account_info['email'],
//                    'Group' => $account_info['group'],
//                    'Leverage' => '',
                    'Name' => $account_info['full_name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => '',
                    'StreetAddress' => '',
                    'ZipCode' => ''
                )
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->UpdateAccountDetails($merge_data);
            $this->request_status = $oAccountData->UpdateAccountDetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->UpdateAccountDetailsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UpdateAccountDetails',$eData)
            );
        }
    }


    /**
     * WebService method for updating live account details
     * this method is used in administration - manage accounts
     */
    public function update_demo_account_details( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['account_number'],
                'info' => array(
                    'City' => '',
                    'Country' => substr($account_info['country'],0,31),
                    'Email' => $account_info['email'],
//                    'Group' => $account_info['group'],
//                    'Leverage' => $account_info['leverage'],
                    'Name' => $account_info['full_name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => '',
                    'StreetAddress' => '',
                    'ZipCode' => ''
                )
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->UpdateAccountDetails($merge_data);
            $this->request_status = $oAccountData->UpdateAccountDetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->UpdateAccountDetailsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UpdateAccountDetails',$eData)
            );
        }
    }


    /**
     * FXPP-940
     * GetAccountTradesHistory both have demo and live method
     */
    public function open_GetAccountActiveTrades( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetAccounActiveTrades($data);
            $this->request_status = $oAccountData->GetAccounActiveTradesResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccounActiveTradesResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccounActiveTrades',$eData)
            );
        }
    }
    /**
     * FXPP-936
     * GetAccountTradesHistory both have demo and live method
     *
     */
    public function open_GetAccountTradesHistory( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetAccountTradesHistory($data);
            $this->request_status = $oAccountData->GetAccountTradesHistoryResult->ReqResult;
            $this->history = $oAccountData->GetAccountTradesHistoryResult->TradeDataList;
            $this->result = self::get_array_object($oAccountData->GetAccountTradesHistoryResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccountTradesHistory',$eData)
            );
        }
    }
    /**
     * FXPP-937
     * GetServerTime both have demo and live method
     */
    public function open_GetServerTime( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetServerTime($data);
            $this->request_status = $oAccountData->GetServerTimeResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetServerTimeResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetServerTime',$eData)
            );
        }
    }
    /**
     * ActivateAccountTrading used for Account Verification to activate trading Admin side
     *
     */

    public function open_ActivateAccountTrading( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['AccountNumber'],
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->ActivateAccountTrading($merge_data);
            $this->request_status = $oAccountData->ActivateAccountTradingResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->ActivateAccountTradingResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ActivateAccountTrading',$eData)
            );
        }
    }


    public function SetAccountAgent( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['AccountNumber'],
                'iAgent' => $account_info['AgentAccountNumber'],
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->SetAccountAgent($merge_data);
            $this->request_status = $oAccountData->SetAccountAgentResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->SetAccountAgentResult);
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'SetAccountAgent',$eData)
            );
        }
    }

    /**
     *
     * ChangeAccountGroup used to  change the Account Group in the Live Accounts.
     *
     */

    public function open_ChangeAccountGroup( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'],
                'strGroup' => $account_info['strGroup'],
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );
            $oAccountData = $this->proxy->ChangeAccountGroup($data);

            $this->request_status = $oAccountData->ChangeAccountGroupResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->ChangeAccountGroupResult);
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeAccountGroup',$eData)
            );
        }
    }
    /**
     * WebService method for updating live account details
     * method used in change leverage administation manual test
     */
    public function open_UpdateAccountDetails( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['account_number'],
                'info' => array(
                    'City' => $account_info['city'],
                    'Country' => substr($account_info['country'],0,31),
                    'Email' => $account_info['email'],
//                    'Leverage' => $account_info['leverage'],
//                    'Group' => $account_info['group'],
                    'Name' => $account_info['full_name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => $account_info['state'],
                    'StreetAddress' => $account_info['street_address'],
                    'ZipCode' => $account_info['zip_code']
                )
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->UpdateAccountDetails($merge_data);
            $this->request_status = $oAccountData->UpdateAccountDetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->UpdateAccountDetailsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UpdateAccountDetails',$eData)
            );
        }
    }

    /**
     *
     * ChangeAccountLeverage used to  change the Account Leverage in the Live Accounts.
     *
     */

    public function open_ChangeAccountLeverage( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'],
                'iLeverage' => $account_info['iLeverage'],
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );
            $oAccountData = $this->proxy->ChangeAccountLeverage($data);
            $this->request_status = $oAccountData->ChangeAccountLeverageResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->ChangeAccountLeverageResult);
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeAccountLeverage',$eData)
            );
        }
    }

    public function open_GetBalanceMonitoringDataByDate( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetBalanceMonitoringDataByDate($data);
            $this->request_status = $oAccountData->GetBalanceMonitoringDataByDateResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetBalanceMonitoringDataByDateResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetBalanceMonitoringDataByDate',$eData)
            );
        }
    }

    public function open_GetBalanceMonitoringDataByDate2( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => NULL, // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' =>NULL, // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetBalanceMonitoringDataByDate($data);
            $this->request_status = $oAccountData->GetBalanceMonitoringDataByDateResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetBalanceMonitoringDataByDateResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetBalanceMonitoringDataByDate',$eData)
            );
        }
    }


    /**
     *  Get Live and Demo Account Balance except partners not yet tested
     *
     */

    public function open_RequestAccountBalance( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' =>$account_info['iLogin']
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAccountBalance($merge_data);
            $this->request_status = $oAccountData->RequestAccountBalanceResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountBalanceResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountBalance',$eData)
            );
        }
    }



    public function GetAgentsCommissionByDate( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['account_number'], // int Account Number
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );

            if( array_key_exists('from', $account_info) ){
                $data['from'] = date('Y-m-d\TH:i:s', strtotime($account_info['from'])); // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
            }

            if( array_key_exists('to', $account_info) ){
                $data['to'] = date('Y-m-d\TH:i:s', strtotime($account_info['to'])); // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
            }

            $oAccountData = $this->proxy->GetAgentsCommissionByDate($data);
            $this->request_status = $oAccountData->GetAgentsCommissionByDateResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAgentsCommissionByDateResult);
            return true;
        } catch (SoapFault $e){
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAgentsCommissionByDate',$eData)
            );
        }
    }

    /**
     * This method is used in Deposit Report
     * RequestAccountFinanceRecordsByDate both and live method
     */
    public function open_RequestAccountFinanceRecordsByDate( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->RequestAccountFinanceRecordsByDate($data);
            $this->request_status = $oAccountData->RequestAccountFinanceRecordsByDateResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountFinanceRecordsByDateResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFinanceRecordsByDate',$eData)
            );
        }
    }
    public function open_RequestAccountFinanceRecordsByDate1( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->RequestAccountFinanceRecordsByDate($data);
            print_r($oAccountData);exit;
            $this->request_status = $oAccountData->RequestAccountFinanceRecordsByDateResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountFinanceRecordsByDateResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFinanceRecordsByDate',$eData)
            );
        }
    }

    public function convert_currency_amount( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'request' => array(
                    'Amount' => $account_info['amount'], // int Account Number
                    'FromCurrency' => $account_info['from_currency'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                    'ToCurrency' => $account_info['to_currency'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                    'ServiceLogin' =>  $this->service_id, //int
                    'ServicePassword' =>  $this->service_password //string
                )
            );

            $oAccountData = $this->proxy->ConvertCurrency($data);
            $this->request_status = $oAccountData->ConvertCurrencyResult->Status;
            $this->result = self::get_array_object($oAccountData->ConvertCurrencyResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFinanceRecordsByDate',$eData)
            );
        }
    }
    public function ConvertCurrency($convertDetails = array() ){
        $eData = array();

        try{
            $data = array(
                'request' => array(
                    'Amount' => $convertDetails['Amount'],
                    'FromCurrency' => $convertDetails['FromCurrency'],
                    'ServiceLogin' => $convertDetails['ServiceLogin'],
                    'ServicePassword' => $convertDetails['ServicePassword'],
                    'ToCurrency' => $convertDetails['ToCurrency'])
            );
            $oConvertData = $this->proxy->ConvertCurrency($data);
            $aConvertData = json_encode($oConvertData);
            return json_decode($aConvertData, true);

        }catch (SoapFault $e){
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ConvertCurrency',$eData)
            );
        }

    }

    public function GetShortDealsOfAccount( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iLogin' => $account_info['iLogin']
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetShortDealsOfAccount($merge_data);
            $this->request_status = $oAccountData->GetShortDealsOfAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetShortDealsOfAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetShortDealsOfAccount',$eData)
            );
        }
    }


    public function GetAccountDailyDeposits( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetAccountDailyDeposits($data);
            $this->request_status = $oAccountData->GetAccountDailyDepositsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountDailyDepositsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetBalanceMonitoringDataByDate',$eData)
            );
        }
    }

    public function GetAccountDailyWithdrawals( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetAccountDailyWithdrawals($data);
            $this->request_status = $oAccountData->GetAccountDailyWithdrawalsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountDailyWithdrawalsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetBalanceMonitoringDataByDate',$eData)
            );
        }
    }


    public function GetTicketsAccount( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iTicket' => $account_info['mt_ticket']
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetTicketsAccount($merge_data);
            $this->request_status = $oAccountData->GetTicketsAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetTicketsAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetTicketsAccount',$eData)
            );
        }
    }

    public function GetFinanceRecordOfTicket( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iTicket' => $account_info['mt_ticket']
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetFinanceRecordOfTicket($merge_data);
            $this->request_status = $oAccountData->GetFinanceRecordOfTicketResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetFinanceRecordOfTicketResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetFinanceRecordOfTicket',$eData)
            );
        }
    }

    public function GetTotalDailyDeposits( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetTotalDailyDeposits($merge_data);
            $this->request_status = $oAccountData->GetTotalDailyDepositsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetTotalDailyDepositsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetTotalDailyDeposits',$eData)
            );
        }
    }

    public function GetTotalDailyWithdrawals( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetTotalDailyWithdrawals($merge_data);
            $this->request_status = $oAccountData->GetTotalDailyWithdrawalsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetTotalDailyWithdrawalsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetTotalDailyWithdrawals',$eData)
            );
        }
    }

    public function credit_prize( $account_number, $amount = 0, $comment = '' ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => $comment,
                    'FundTransferAccountReciever' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_ContestPrizeBonus($data);
            $this->request_status = $oAccountData->Deposit_ContestPrizeBonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_ContestPrizeBonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'DepositRealFund',$eData)
            );
        }
    }

    public function RemoveAgentOfAccount($account_number){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_number
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RemoveAgentOfAccount($merge_data);
            $this->request_status = $oAccountData->RemoveAgentOfAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RemoveAgentOfAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RemoveAgentOfAccount',$eData)
            );
        }
    }


    /**
     * Update Live Account Deposit Balance Method
     * Request result are stored in WebService::result
     */
    public function credit_supporter_part( $account_number, $amount = 0, $comment = '' ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => $comment,
                    'FundTransferAccountReciever' => 0,
                    'FundTransferRecieverAmount' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_SupporterPartBonus($data);
            $this->request_status = $oAccountData->Deposit_SupporterPartBonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_SupporterPartBonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_SupporterPartBonus',$eData)
            );
        }
    }

    /**
     * Update Live Account Bonus Method
     * Request result are stored in WebService::result
     */
    public function credit_showfx_bonus( $account_number, $amount = 0, $comment = '' ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => $comment,
                    'FundTransferAccountReciever' => 0,
                    'FundTransferRecieverAmount' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_ShowFXBonus($data);
            $this->request_status = $oAccountData->Deposit_ShowFXBonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_ShowFXBonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_ShowFXBonus',$eData)
            );
        }
    }

    public function credit_mf_Prize( $account_number, $amount = 0, $comment = '' ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => $comment,
                    'FundTransferAccountReciever' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_Contest_MF_Prize_Bonus($data);
            $this->request_status = $oAccountData->Deposit_Contest_MF_Prize_BonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_Contest_MF_Prize_BonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_Contest_MF_Prize_Bonus',$eData)
            );
        }
    }

    /**
     * Live 50PercentBonus Method
     *
     */
    public function open_Deposit_50_PercentBonus( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Login' => $account_info['AccountNumber'],
                    'Amount' => $account_info['Amount'],
                    'Comment' => $account_info['Comment'],
                    'FundTransferAccountReceiver' => 0,
                    'FundTransferReceiverAmount' => 0,
                    'ProcessByIP' => $account_info['ProcessByIP'],
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Deposit_50_PercentBonus($merge_data);
            $this->request_status = $oAccountData->Deposit_50_PercentBonusResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_50_PercentBonusResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_50_PercentBonus',$eData)
            );
        }
    }

        public function open_RequestAccountDetails( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'],
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAccountDetails($merge_data);
            $this->request_status = $oAccountData->RequestAccountDetailsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAccountDetailsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountDetails',$eData)
            );
        }
    }

        public function RequestAllFinanceRecordsByDate( $account_info = array() ){
        $eData = array();
        try {
            // $yes = date("Y-m-d", strtotime("yesterday")) ;
            // $tod = date("Y-m-d", strtotime("today"));

            $data = array(
                // 'from' => date('Y-m-d\T00:00:00', strtotime($yes)),
                // 'to' =>  date('Y-m-d\T23:59:59', strtotime($tod)),
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
//            echo "<pre>";
//            print_r($data);exit;
            $oAccountData = $this->proxy->RequestAllFinanceRecordsByDate($data);
            $this->request_status = $oAccountData->RequestAllFinanceRecordsByDateResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAllFinanceRecordsByDateResult);

            return true;
        } catch (SoapFault $e)  {
          //  print_r($e);
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAllFinanceRecordsByDate',$eData)
            );
        }
    }

    public function GetSupporterBonusFunds( $account_number ){

        $eData = array();
        try {
            $data = array(
                'iAccount' => $account_number, // int Account Number
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );

            $oAccountData = $this->proxy->GetSupporterBonusFundsInfo($data);
            $this->request_status = $oAccountData->GetSupporterBonusFundsInfoResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetSupporterBonusFundsInfoResult);
            return true;
        } catch (SoapFault $e){
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetSupporterBonusFundsInfo',$eData)
            );
        }
    }

    public function update_supporter_withdraw_balance( $account_number, $amount = 0, $comment = '' ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => $comment,
                    'FundTransferAccountReciever' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->Withdraw_Supporter_Full_Fund($data);
            $this->request_status = $oAccountData->Withdraw_Supporter_Full_FundResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Withdraw_Supporter_Full_FundResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Withdraw_Supporter_Full_Fund',$eData)
            );
        }
    }

        public function update_live_withdraw_balance( $account_number, $amount = 0, $comment = '' ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $amount,
                    'Comment' => $comment,
                    'FundTransferAccountReciever' => 0,
                    'Login' => $account_number,
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
//            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->WithdrawRealFund($data);
            $this->request_status = $oAccountData->WithdrawRealFundResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->WithdrawRealFundResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'WithdrawRealFund',$eData)
            );
        }
    }

    public function open_Deposit_Supporter_Full_Fund( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $account_info['Amount'],
                    'Comment' => $account_info['Comment'],
                    'CommentFundTransferReceiver' => $account_info['CommentFundTransferReceiver'],
                    'FundTransferAccountReceiver' => $account_info['FundTransferAccountReceiver'], //Login/Account Number of Fund Transfer Receiver. Set to zero if transaction is not Fund transfer.
                    'FundTransferReceiverAmount' => $account_info['FundTransferReceiverAmount'], //Amount to be received by receiver of fund transfer request. Same to amount transferred if both accounts have same base currency. Converted amount to receiver currency if both account have different currency.
                    'Login' => $account_info['account_number'],
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
            $oAccountData = $this->proxy->Deposit_Supporter_Full_Fund($data);
            $this->request_status = $oAccountData->Deposit_Supporter_Full_FundResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Deposit_Supporter_Full_FundResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Deposit_Supporter_Full_Fund',$eData)
            );
        }
    }

    public function open_Withdraw_Supporter_Full_Fund( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'financeRequest' => array(
                    'Amount' => (float) $account_info['Amount'],
                    'Comment' => $account_info['Comment'],
                    'CommentFundTransferReceiver' => $account_info['CommentFundTransferReceiver'],
                    'FundTransferAccountReceiver' => $account_info['FundTransferAccountReceiver'], //Login/Account Number of Fund Transfer Receiver. Set to zero if transaction is not Fund transfer.
                    'FundTransferReceiverAmount' => $account_info['FundTransferReceiverAmount'], //Amount to be received by receiver of fund transfer request. Same to amount transferred if both accounts have same base currency. Converted amount to receiver currency if both account have different currency.
                    'Login' => $account_info['account_number'],
                    'ProcessByIP' => $this->request_ip,
                    'serviceId' =>  $this->service_id,
                    'servicePassword' =>  $this->service_password
                )
            );
            $oAccountData = $this->proxy->Withdraw_Supporter_Full_Fund($data);
            $this->request_status = $oAccountData->Withdraw_Supporter_Full_FundResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->Withdraw_Supporter_Full_FundResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Withdraw_Supporter_Full_Fund',$eData)
            );
        }
    }

    public function open_RestoreInactiveAccount( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'],
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RestoreInactiveAccount($merge_data);
            $this->request_status = $oAccountData->RestoreInactiveAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RestoreInactiveAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RestoreInactiveAccount',$eData)
            );
        }
    }

     public function GetAccountsWithShortDeals( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
               // 'iLogin' =>$account_info['iLogin']
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAccountsWithShortDeals($merge_data);
            $this->request_status = $oAccountData->GetAccountsWithShortDealsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountsWithShortDealsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccountsWithShortDeals',$eData)
            );
        }
    }

     public function GetAccountCancelledPendingOrders( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetAccountCancelledPendingOrders($data);
            $this->request_status = $oAccountData->GetAccountCancelledPendingOrdersResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountCancelledPendingOrdersResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccountCancelledPendingOrders',$eData)
            );
        }
    }
    public function getTotalCommissionFromAllAccount( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iAgent' => $account_info['iAgent'], // int Agent Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAgentTotalCommissionsFromAllAccounts($merge_data);
            $this->request_status = $oAccountData->GetAgentTotalCommissionsFromAllAccountsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAgentTotalCommissionsFromAllAccountsResult);
            if($this->request_status == "RET_OK"){
                return $this->result;
            }
            return false;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAgentTotalCommissionsFromAllAccounts',$eData)
            );
        }
    }
    public function getTotalCommissionGroupByAccount( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iAgent' => $account_info['iAgent'], // int Agent Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAgentTotalCommissionGroupByAccount($merge_data);
            $this->request_status = $oAccountData->GetAgentTotalCommissionGroupByAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAgentTotalCommissionGroupByAccountResult);
            if($this->request_status == "RET_OK"){
                return $this->result;
            }
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAgentTotalCommissionGroupByAccount',$eData)
            );
        }
    }
    public function getTotalCommissionFromAccount( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iAgent' => $account_info['iAgent'], // int Agent Account Number
                'iAccount' => $account_info['iAccount'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAgentTotalCommissionFromAccount($merge_data);
            $this->request_status = $oAccountData->GetAgentTotalCommissionFromAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAgentTotalCommissionFromAccountResult);
            if($this->request_status == "RET_OK"){
                return $this->result;
            }
            return false;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAgentTotalCommissionFromAccount',$eData)
            );
        }
    }
    public function open_RequestAccountFinanceRecordsByDate2( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->RequestAccountFinanceRecordsByDate($data);
            $this->request_status = $oAccountData->RequestAccountFinanceRecordsByDateResult->ReqResult;
            $this->finance = $oAccountData->RequestAccountFinanceRecordsByDateResult->FinanceRecords;
            $this->result = self::get_array_object($oAccountData->RequestAccountFinanceRecordsByDateResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFinanceRecordsByDate',$eData)
            );
        }
    }
    public function GetAccountTotalTradedVolume( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetAccountTotalTradedVolume($data);
            $this->request_status = $oAccountData->GetAccountTotalTradedVolumeResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountTotalTradedVolumeResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccountTotalTradedVolume',$eData)
            );
        }
    }
    public function ReqAgentStats( $account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'iAgent' => $account_info['iLogin'],
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAgentStats($merge_data);
            $this->request_status = $oAccountData->RequestAgentStatsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestAgentStatsResult);
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAgentStats',$eData)
            );
        }
    }
}