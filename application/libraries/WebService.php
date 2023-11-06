<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class WebService {
//http://136.243.89.90:9000/html/83a79d5a-6822-62f2-efa5-f499c516d2bb.htm
    private $proxy;
    public $request_status;
    public $result = array();
    private $request_ip;
    protected $service_id = '10001';
    protected $service_password = 'Bj4mQBqP';

    //forex trading
    protected $trading_id = '10002';
    protected $trading_password = 'PKpSq706';

    //forexmart webservice

    private $config_keys_allowed = array(
        'url', 'service_id', 'service_password'
    );

    protected $url;
    protected $server_url = array(
        'test' =>'https://wstest.ahpra.gov.au/pie_int/svc/PractitionerRegistrationSearch/2.0.0/FindRegistrationService.svc',
        'demo' =>'http://136.243.89.90:44388/MT4ApiService.svc?wsdl',
        'live' =>'http://136.243.89.90:44360/MT4ApiService.svc?wsdl',
//        'demo_new' => 'http://136.243.89.90:9060/MT4ApiService.svc?wsdl',
//        'live_new' => 'http://136.243.89.90:9050/MT4ApiService.svc?singleWsdl',
//        'converter' => 'http://136.243.89.90:9088/Converter.svc?singleWsdl'
        'demo_new' => 'https://78w.forexmart.com:9060/MT4ApiService.svc?wsdl',
        'live_new' => 'https://78w.forexmart.com:9050/MT4ApiService.svc?singleWsdl',
        'converter' => 'https://78w.forexmart.com:9088/Converter.svc?singleWsdl',
        'calendar' => 'http://client-api.instaforex.com/soapservices/Calendar.svc?wsdl',
        'trading' => 'https://78w.forexmart.com:9041/Trading.svc?wsdl', // support https://78w.forexmart.com:9042/html/9184f0f3-b615-656c-10f4-2e2eb11109d3.htm
        'forexmart' => 'https://www.forexmart.com/FM_Webservice?wsdl', // support https://www.forexmart.com/FM_Webservice
        'tradings' => 'https://78w.forexmart.com:4235/Trading.svc?wsdl',
        'charts' => 'https://78w.forexmart.com:6589/TicksMngrService.svc?wsdl',
        'pamm' => 'http://144.76.159.179:8810/PammService.svc?singleWsdl', //http://144.76.159.179:8850/html/92c3be91-5b50-430f-b1a3-8cd52fa6eb6d.htm
        'pamm_livefeeds' => 'http://144.76.159.179:1133/Monitoring.svc?singleWsdl',
        
        'chart_single' => 'https://78w.forexmart.com:6589/TicksMngrService.svc?singleWsdl',
        'minifcservice' => 'https://78w.forexmart.com:2895/MiniFCService.svc?wsdl',
    );

    public function WebService( $config = array() ){
        $ci =& get_instance();
        $this->request_ip = $ci->input->ip_address();
        self::initialize($config);
    }

    /**
     * Initialize WebService with given $config
     */

    protected function initialize( $config ){
        try {

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
            if(array_key_exists('comment', $account_info)){
                $comment = $account_info['comment'];
            }else{
                $comment = '';
            }

            $data = array(
                'accountInfo' => array(
                    'Address' => $account_info['address'],
                    'City' => $account_info['city'],
                    'Comment' => $comment,
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
            $this->request_status = $oAccountData->OpenAccountResult->ReqResult;
//            $this->request_status = $oAccountData->OpenRealStandardAccountResult->ReqResult;
//            $this->result = self::get_array_object($oAccountData->OpenRealStandardAccountResult);
            $this->result = self::get_array_object($oAccountData->OpenAccountResult);
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
    public function update_live_deposit_balance( $account_number, $amount = 0,$comment='' ){
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
                'financeInfo' => array(
                    'AccountNumber' => $account_info['AccountNumber'],
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
                'financeInfo' => array(
                    'AccountNumber' => $account_info['AccountNumber'],
                    'Amount' => $account_info['Amount'],
                    'Comment' => $account_info['Comment'],
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
                'iLogin' => $account_info['account_number'],
                'info' => array(
                    'City' => $account_info['city'],
                    'Comment' => $account_info['comment'],
                    'Country' => substr($account_info['country'],0,31),
                    'Email' => $account_info['email'],
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
//            var_dump($oAccountData);
//            $this->request_status = $oAccountData->GetServerTimeResult->ReqResult;
            $this->result = $oAccountData->GetServerTimeResult;
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

    public function get_accounts_country_code(){
        $eData = array();
        try {
            $merge_data = self::set_service_auth(array());
            $oAccountData = $this->proxy->GetAccountsWithCountryCode($merge_data);
            $this->request_status = $oAccountData->GetAccountsWithCountryCodeResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountsWithCountryCodeResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccountsWithCountryCode',$eData)
            );
        }
    }

    public function get_all_accounts_total_daily_balance( $info = array() ){
        $eData = array();
        try {
            $data = array(
                    'from' => $info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                    'to' => $info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAllAccountsTotalDailyBalance($merge_data);
            $this->request_status = $oAccountData->GetAllAccountsTotalDailyBalanceResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAllAccountsTotalDailyBalanceResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFinanceRecordsByDate',$eData)
            );
        }
    }

    public function GetAgentTotalCommissionFromAccount( $account_info = array() ){
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

            $oAccountData = $this->proxy->GetAgentTotalCommissionFromAccount($data);
            $data = $oAccountData->GetAgentTotalCommissionFromAccountResult;
            if($data->ReqResult == "RET_OK"){
                $this->request_status = $data->ReqResult;

                return $data;
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

    /**
     * Deactivate Demo Account Trading
     * this is currently used for contest registrants
     * Request result are stored in WebService::result
     */
    public function deactivate_demo_account( $account_number ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_number
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->DeActivateAccountTrading($merge_data);
            $this->request_status = $oAccountData->DeActivateAccountTradingResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->DeActivateAccountTradingResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'DeActivateAccountTrading',$eData)
            );
        }
    }

    /**
     * Activate Demo Account Trading
     * this is currently used for contest registrants
     * Request result are stored in WebService::result
     */
    public function activate_demo_account( $account_number ){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $account_number
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

    /**
     * Closing the active trades of an account
     * this is currently used for contest winners at the end of each contest week
     * Request result are stored in WebService::result
     */
    public function close_demo_account( $account_number ){
        $eData = array();
        try {
            $data = array(
                'iAccount' => $account_number
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->CloseAllActiveTradesOfAccount($merge_data);
            $this->request_status = $oAccountData->CloseAllActiveTradesOfAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->CloseAllActiveTradesOfAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'CloseAllActiveTradesOfAccount',$eData)
            );
        }
    }

    public function get_question_mark_name(){
        $eData = array();
        try {
            $merge_data = self::set_service_auth(array());
            $oAccountData = $this->proxy->GetAccountsWithQuestionMarkName($merge_data);
            $this->request_status = $oAccountData->GetAccountsWithQuestionMarkNameResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAccountsWithQuestionMarkNameResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAccountsWithQuestionMarkName',$eData)
            );
        }
    }

    /**
     * Forex Trading
     **/

    public function open_GetCurrentQuotes( ){
        $eData = array();
        try {
            $data = array(
                'serviceId' => $this->trading_id,
                'servicePassword' =>  $this->trading_password
            );
            $oAccountData = $this->proxy->GetCurrentQuotes($data);
            $this->request_status = $oAccountData->GetCurrentQuotesResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetCurrentQuotesResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetCurrentQuotes',$eData)
            );
        }
    }
// BuyAndSellStatsResult recentence
    public function GetActiveTradesBuyAndSellStatistics(){
        $eData = array();
        try {
            $data = array(
                'serviceId' => $this->trading_id,
                'servicePassword' =>  $this->trading_password,
                'isMajorSymbolsOnly'=>true
            );
            $oAccountData = $this->proxy->GetActiveTradesBuyAndSellStatistics($data);
            $this->request_status = $oAccountData->GetActiveTradesBuyAndSellStatisticsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetActiveTradesBuyAndSellStatisticsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetActiveTradesBuyAndSellStatistics',$eData)
            );
        }
    }



    public function open_ChangeAccountLeverage1( $account_info = array() ){

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

    public function GetTopAccountsTotalBalances(){

        $eData = array();
        try {
            $data = array(
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );
            $oAccountData = $this->proxy->GetTopAccountsTotalBalances($data);
            $this->request_status = $oAccountData->GetTopAccountsTotalBalancesResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetTopAccountsTotalBalancesResult);
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeAccountLeverage',$eData)
            );
        }
    }
    public function GetTopAccountsTotalCommissions(){

        $eData = array();
        try {
            $data = array(
                'serviceId' =>  $this->service_id,
                'servicePassword' =>  $this->service_password
            );
            $oAccountData = $this->proxy->GetTopAccountsTotalCommissions($data);
            $this->request_status = $oAccountData->GetTopAccountsTotalCommissionsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetTopAccountsTotalCommissionsResult);
            return $oAccountData;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeAccountLeverage',$eData)
            );
        }
    }

    public function get_deposits_per_account_per_day( $info = array() ){
        $eData = array();
        try {
            $data = array(
                'from' => date('Y-m-d\TH:i:s', strtotime($info['from'])), // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => date('Y-m-d\TH:i:s', strtotime($info['to'])), // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
            );

            var_dump($data);
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetDepositsPerAccountPerDay($merge_data);
            $this->request_status = $oAccountData->GetDepositsPerAccountPerDayResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetDepositsPerAccountPerDayResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFinanceRecordsByDate',$eData)
            );
        }
    }

    public function getFinanceRecordByComment( $comment, $start_date, $end_date ){
        $eData = array();
        try {
            $data = array(
                'strComment' => $comment, // string comment
                'from' => date('Y-m-d\TH:i:s', strtotime($start_date)), // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => date('Y-m-d\TH:i:s', strtotime($end_date)), // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->RequestFinanceRecordsByComment($data);
            $this->request_status = $oAccountData->RequestFinanceRecordsByCommentResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->RequestFinanceRecordsByCommentResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestFinanceRecordsByComment',$eData)
            );
        }
    }

    public function changeUserInvestorPasswordAdmin($arg = array()){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $arg['account_number'],
                'strNewPass' => $arg['password'],
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->ChangeAccountInvestorPasswordAdmin($merge_data);
            $this->request_status = $oAccountData->ChangeAccountInvestorPasswordAdminResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->ChangeAccountInvestorPasswordAdminResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeAccountInvestorPasswordAdmin',$eData)
            );
        }
    }

    public function changeUserMasterPasswordAdmin($arg = array()){
        $eData = array();
        try {
            $data = array(
                'iLogin' => $arg['account_number'],
                'strNewPass' => $arg['password'],
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->ChangeAccountMasterPasswordAdmin($merge_data);
            $this->request_status = $oAccountData->ChangeAccountMasterPasswordAdminResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->ChangeAccountMasterPasswordAdminResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeAccountMasterPasswordAdmin',$eData)
            );
        }
    }


    public function open_Request_Inactive_Account_Details( $account_info = array() ){
        $eData = array();
        try {

            $data = array( 'iLogin' => $account_info['iLogin'], );
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
    public function open_Deposit_NoDepositBonus_working( $account_info = array() ){
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
    public function getcalendarevent($lang){
        $eData = array();
        try {
            $data = array('lang'=>$lang,'account'=>'clientapi.instaforex.com.Calendar.Account','Login'=>0);
            $events = $this->proxy->GetCalendar($data)->GetCalendarResult;
            return $events;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetCalendar',$eData)
            );
        }
    }
    public function open_sendFMEmail($account_info = array() ){
        $eData = array();
        try {
            $data = array(
                'Credentials' => array(
                    'email' => $account_info['email'],
                    'account_number' => $account_info['account_number'],
                    'login_number' => $account_info['login_number'],
                    'investor_password' => $account_info['investor_password'],
                    'trader_password' => $account_info['trader_password'],
                    'server_link' => $account_info['server_link'],
                    'account_name' => $account_info['account_name'],
                    'service_password' =>  'S*2XJ981iR',
                )
            );
            $oAccountData = $this->proxy->sendFMEmail($data);
            $this->accountdata = $oAccountData;
            $this->request_status = $oAccountData->sendFMEmailResult->ReqResult;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'EmailResult',$eData)
            );
        }
    }




    /**
     * Forex Trading
     **/
    public function GetMoneyFallContestReport($account_info= array() ){
        $eData = array();
        try {
            $data = array(
                'iLogin'=>$account_info['iLogin'],
                'from' => date('Y-m-d\TH:i:s', strtotime($account_info['start_date'])), // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => date('Y-m-d\TH:i:s', strtotime($account_info['end_date'])), // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' => $this->trading_id,
                'servicePassword' =>  $this->trading_password
            );

            $oAccountData = $this->proxy->GetMoneyFallContestReport($data);
            $this->request_status = $oAccountData->GetMoneyFallContestReportResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetMoneyFallContestReportResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetCurrentQuotes',$eData)
            );
        }
    }

    public function getmosttraded($tradeinfo = array()){
        $eData = array();
        try {
            $data = array(
                'from'  => date('Y-m-d\TH:i:s', strtotime($tradeinfo['from'])),
                'to'    => date('Y-m-d\TH:i:s', strtotime($tradeinfo['to'])),
                'serviceId' => $this->trading_id,
                'servicePassword' =>  $this->trading_password
            );

            $mostTraded = $this->proxy->GetMostTradedSymbolOfDateRange($data);
            $data['results'] = get_object_vars($mostTraded->GetMostTradedSymbolOfDateRangeResult);
            return $data;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetMostTradedSymbolOfDateRange',$eData)
            );
        }
    }

    /*Home Chart Methods start*/
    /*1*/
    public function open_chart_GetCurrentQuotes($info = array()){
        $eData = array();
        try {
            $oAccountData = $this->proxy->GetCurrentQuotes();
            $this->result = $oAccountData->GetCurrentQuotesResult;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetCurrentQuotes',$eData)
            );
        }
    }
    /*2*/
    public function open_chart_GetSecurtiesInfo($info = array()){
        $eData = array();
        try {
            $oAccountData = $this->proxy->GetSecurtiesInfo();
            $this->result = $oAccountData->GetSecurtiesInfoResult;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetSecurtiesInfo',$eData)
            );
        }
    }
    /*3*/
    public function open_chart_GetTicksHistory($info = array()){
        $eData = array();
        try {
            $data = array(
                'strSymbol' => $info['strSymbol'],
                'from' => $info['from'],
                'to' => $info['to']
            );
            $oAccountData = $this->proxy->GetTicksHistory($data);
            $this->result = $oAccountData->GetTicksHistoryResult;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetTicksHistory',$eData)
            );
        }
    }
    /*4*/
    public function open_chart_Request1MinuteTimeframeRates($info = array()){
        $eData = array();
        try {
            $data = array(
                'strSymbol' => $info['strSymbol']
            );
            $oAccountData = $this->proxy->Request1MinuteTimeframeRates($data);
            $this->result = $oAccountData->Request1MinuteTimeframeRatesResult;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'Request1MinuteTimeframeRates',$eData)
            );
        }
    }
    /*4*/
    public function open_chart_GetSymbolLatestQuoteData($info = array()){
        $eData = array();
        try {
            $data = array(
                'strSymbol' => $info['strSymbol']
            );
            $oAccountData = $this->proxy->GetSymbolLatestQuoteData($data);
            $this->result = $oAccountData->GetSymbolLatestQuoteDataResult;
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetSymbolLatestQuoteData',$eData)
            );
        }
    }
    /*Home Chart Methods end*/
    public function open_partner_special_account( $account_info = array() ){
        $eData = array();
        try {
            if(array_key_exists('comment', $account_info)){
                $comment = $account_info['comment'];
            }else{
                $comment = '';
            }

            $data = array(
                'accountInfo' => array(
                    'Address' => $account_info['address'],
                    'City' => $account_info['city'],
                    'Comment' => $comment,
                    'Country' => substr($account_info['country'],0,31),
                    'Email' => $account_info['email'],
                    'Group' => $account_info['group'],
                    'Leverage' => $account_info['leverage'],
                    'Name' => $account_info['name'],
                    'PhoneNumber' => $account_info['phone_number'],
                    'State' => $account_info['state'],
                    'ZipCode' => $account_info['zip_code'],
                    'IsReadOnly' => true,
                    'PhonePassword' => $account_info['phone_password']
                )
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->OpenPartnerSpecialAccount($merge_data);
            $this->request_status = $oAccountData->OpenPartnerSpecialAccountResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->OpenPartnerSpecialAccountResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'OpenPartnerSpecialAccount',$eData)
            );
        }
    }


    /*
    * FOR SPREAD UPDATES FXPP-3723
    */
    public function change_symbol_spread($strSymbol, $iSpread){
        $eData = array();
        $data = array(
            'strSymbol' => $strSymbol,
            'iSpread' => $iSpread
        );
        try {
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->ChangeSymbolSpread($merge_data);
            $this->request_status = $oAccountData->ChangeSymbolSpreadResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->ChangeSymbolSpreadResult);
        } catch(SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'ChangeSymbolSpread',$eData)
            );
        }
    }



     public function open_GetPammTradersMonitoringDataCustom($account_info = array()){
        $eData = array();
        try {
            $data = array(
                'request' => array(
                    'AccountFilter' => $account_info['AccountFilter'],
                    'Filters' => array(
                        'ActiveInvestorsFrom' => $account_info['ActiveInvestorsFrom'],
                        'ActiveInvestorsTo' => $account_info['ActiveInvestorsTo'],
                        'BalanceFrom' => $account_info['BalanceFrom'],
                        'BalanceTo' => $account_info['BalanceTo'],
                        'CurrentTradesFrom' => $account_info['CurrentTradesFrom'],
                        'CurrentTradesTo' => $account_info['CurrentTradesTo'],
                        'DailyBalFrom' => $account_info['DailyBalFrom'],
                        'DailyBalTo' => $account_info['DailyBalTo'],
                        'DailyEquityFrom' => $account_info['DailyEquityFrom'],
                        'DailyEquityTo' => $account_info['DailyEquityTo'],
                        'DailyProfitFrom' => $account_info['DailyProfitFrom'],
                        'DailyProfitTo' => $account_info['DailyProfitTo'],
                        'EquityFrom' => $account_info['EquityFrom'],
                        'EquityTo' => $account_info['EquityTo'],
                        'Month_3_ProfitFrom' => $account_info['Month_3_ProfitFrom'],
                        'Month_3_ProfitTo' => $account_info['Month_3_ProfitTo'],
                        'Month_6_ProfitFrom' => $account_info['Month_6_ProfitFrom'],
                        'Month_6_ProfitTo' => $account_info['Month_6_ProfitTo'],
                        'Month_9_ProfitFrom' => $account_info['Month_9_ProfitFrom'],
                        'Month_9_ProfitTo' => $account_info['Month_9_ProfitTo'],
                        'MonthlyProfitFrom' => $account_info['MonthlyProfitFrom'],
                        'MonthlyProfitTo' => $account_info['MonthlyProfitTo'],
                        'SimpleRatingFrom' => $account_info['SimpleRatingFrom'],
                        'SimpleRatingTo' => $account_info['SimpleRatingTo'],
                        'SinceRegisteredFrom' => $account_info['SinceRegisteredFrom'],
                        'SinceRegisteredTo' => $account_info['SinceRegisteredTo'],
                        'TotalProfitFrom' => $account_info['TotalProfitFrom'],
                        'TotalProfitTo' => $account_info['TotalProfitTo'],
                        'TotalTradesFrom' => $account_info['TotalTradesFrom'],
                        'TotalTradesTo' => $account_info['TotalTradesTo'],
                        'WeeklyProfitFrom' => $account_info['WeeklyProfitFrom'],
                        'WeeklyProfitTo' => $account_info['WeeklyProfitTo'],
                    ),
                    'HasFilterToColumns' => $account_info['HasFilterToColumns'],
                    'Limit' => $account_info['Limit'],
                    'Offset' => $account_info['Offset'],
                    'OrderByAsc' => $account_info['OrderByAsc'],
                    'OrderByColumnName' => $account_info['OrderByColumnName']
                )
            );

            $oAccountData = $this->proxy->GetPammTradersMonitoringDataCustom($data);
            $this->result = $oAccountData->GetPammTradersMonitoringDataCustomResult;
            return true;

        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetPammTradersMonitoringDataCustom',$eData)
            );
        }
    }
    public function RequestAccountFunds($account_number){
        $eData = array();
        try {
            $data = array('iLogin' => $account_number);
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->RequestAccountFunds($merge_data);
            $this->result = self::get_array_object($oAccountData->RequestAccountFundsResult);
            return true;
        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'RequestAccountFunds',$eData)
            );
        }
    }


    /**
     * This method is used in Total Balance Report
     * RequestAccountFinanceRecordsByDate both and live method
     */
    public function getDailyFundsWithdrawDepositByDateRange( $account_info = array() ){

        $eData = array();
        try {
            $data = array(
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'serviceId' =>  $this->service_id, //int
                'servicePassword' =>  $this->service_password //string
            );
            $oAccountData = $this->proxy->GetDailyFundsWithdrawDepositByDateRange($data);
            $this->request_status = $oAccountData->GetDailyFundsWithdrawDepositByDateRangeResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetDailyFundsWithdrawDepositByDateRangeResult);
            return true;
        } catch (SoapFault $e)  {
            var_dump($e);
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetDailyFundsWithdrawDepositByDateRange',$eData)
            );
        }
    }

    //minifcservice api method

    public function open_SubscribeToMasterAccount($account_info = array()){
        $eData = array();
        $data = array(
            'subscribeRequest' => array(
                'FollowerAccount' => $account_info['FollowerAccount'],
                'Is_NDB_Account' => $account_info['Is_NDB_Account'],
                'MasterTrader' => $account_info['MasterTrader']
            )
        );
        try {
            $oAccountData = $this->proxy->SubscribeToMasterAccount($data);

            $this->request_status = $oAccountData->SubscribeToMasterAccountResult->ReqResult;
            //            $this->result = self::get_array_object($oAccountData->SubscribeToMasterAccountResult);
        } catch(SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'SubscribeToMasterAccount',$eData)
            );
        }
    }

    public function open_UnsubscribeAccount($account_info = array()){
        $eData = array();
        $data = array(
            'subscribeRequest' => array(
                'FollowerAccount' => $account_info['FollowerAccount'],
                'Is_NDB_Account' => $account_info['Is_NDB_Account'],
                'MasterTrader' => $account_info['MasterTrader']
            )
        );
        try {
            $oAccountData = $this->proxy->UnsubscribeAccount($data);
            $this->request_status = $oAccountData->UnsubscribeAccountResult->ReqResult;
            //            $this->result = self::get_array_object($oAccountData->UnsubscribeAccountResult);
        } catch(SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'UnsubscribeAccount',$eData)
            );
        }
    }

    public function open_GetFollowerSubscriptionInfo($account_info = array()){
        $eData = array();
        $data = array(
            'iFollowerAccount' => $account_info['iFollowerAccount']
        );
        try {
            $oAccountData = $this->proxy->GetFollowerSubscriptionInfo($data);
            $this->request_status = $oAccountData->GetFollowerSubscriptionInfoResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetFollowerSubscriptionInfoResult);

        } catch(SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetFollowerSubscriptionInfo',$eData)
            );
        }
    }


    public function open_GetAutomaticallyUnsubscribedAccounts($data = array()){
        $eData = array();
        $req = array(
            'isLastOneHour' => $data['isLastOneHour'],
            'from' => $data['from'],
            'to' => $data['to']
        );
        try {
            $oAccountData = $this->proxy->GetAutomaticallyUnsubscribedAccounts($req);
            $this->result = $oAccountData->GetAutomaticallyUnsubscribedAccountsResult->AccountInfo;

        } catch(SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAutomaticallyUnsubscribedAccounts',$eData)
            );
        }
    }

    //minifcservice api method

    public function GetAgentsCommissionByDateWithLimitAndOffset( $account_info = array() ){
        $eData = array();
        try {

            $data = array(
                'iLogin' => $account_info['iLogin'], // int Account Number
                'from' => $account_info['from'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'to' => $account_info['to'], // DateTime::createFromFormat  format('Y-m-d\TH:i:s')
                'iOffset' => $account_info['offset'],
                'limitCount' => $account_info['limit']
            );
            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAgentsCommissionByDateWithLimitAndOffset($merge_data);
            $this->request_status = $oAccountData->GetAgentsCommissionByDateWithLimitAndOffsetResult->ReqResult;
            $this->result = $oAccountData->GetAgentsCommissionByDateWithLimitAndOffsetResult;
            return $oAccountData;

        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAgentsCommissionByDateWithLimitAndOffset',$eData)
            );
        }
    }


    public function open_GetAgentTotalCommissionsFromAllAccounts( $account_info = array() ){

        $eData = array();
        try {

            $data = array(
                'iAgent' => $account_info['iAgent'],
                'from' => $account_info['from'],
                'to' => $account_info['to']
            );

            $merge_data = self::set_service_auth($data);
            $oAccountData = $this->proxy->GetAgentTotalCommissionsFromAllAccounts($merge_data);
            $this->request_status = $oAccountData->GetAgentTotalCommissionsFromAllAccountsResult->ReqResult;
            $this->result = self::get_array_object($oAccountData->GetAgentTotalCommissionsFromAllAccountsResult);
            return $oAccountData;

        } catch (SoapFault $e)  {
            return array(
                'SOAPError' => true,
                'Message' => $e->getMessage(),
                'LogId' => self::Exception($e,'GetAgentTotalCommissionsFromAllAccounts',$eData)
            );
        }


    }
}