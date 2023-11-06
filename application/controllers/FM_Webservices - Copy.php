<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FM_Webservices extends CI_Controller {

    function __construct() {
        parent::__construct();
        ini_set('memory_limit','32M');
        $this->load->library("FMsoap_v2_library");
        $this->FM_SoapServer = new soap_server();
        $this->FM_SoapServer->soap_defencoding = 'UTF-8';
        $this->FM_SoapServer->encode_utf8 = false;
        $this->FM_SoapServer->decode_utf8 = false;
        $this->FM_SoapServer->configureWSDL("FM_Webserver", "urn:FM_Webserver");
//          $this->FM_SoapServer->setGlobalDebugLevel(0);
        $this->method1();
    }

    function index() {
        ob_clean();
        ob_start();
        $this->FM_SoapServer->service(file_get_contents("php://input"));
//        $this->FM_SoapServer->handle();
        ob_end_flush();
    }

    private function method1() {
        /*
        * Method1
        * Send email using FM Server and Template
        */

        //email, account number, login number, investor password, trader password, server link and account name
        $this->FM_SoapServer->wsdl->addComplexType(
            'i_sendemail',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'email' => array(
                    'MethodParameters' => 'email',
                    'type' => 'xsd:string'
                ),
                'account_number' => array(
                    'MethodParameters' => 'account_number',
                    'type' => 'xsd:int'
                ),
                'login_number' => array(
                    'MethodParameters' => 'login_number',
                    'type' => 'xsd:string'
                ),
                'investor_password' => array(
                    'MethodParameters' => 'investor_password',
                    'type' => 'xsd:string'
                ),
                'trader_password' => array(
                    'MethodParameters' => 'trader_password',
                    'type' => 'xsd:string'
                ),
                'server_link' => array(
                    'MethodParameters' => 'server_link',
                    'type' => 'xsd:string'
                ),
                'account_name' => array(
                    'MethodParameters' => 'account_name',
                    'type' => 'xsd:string'
                ),
                'service_password' => array(
                    'MethodParameters' => 'service_password',
                    'type' => 'xsd:string'
                ),
            )
        );
        $this->FM_SoapServer->wsdl->addComplexType(
            'EmailResult',
            'complexType',
            'struct',
            'all',
            'SOAP-ENC:Array',
            array(
                'ReqResult' => array(
                    'MethodParameters' => 'ReqResult',
                    'type' => 'xsd:string'
                ),
            )
        );
        $this->FM_SoapServer->register(
            'SendFMEmail',// parameter list:
            array('Credentials'=>'tns:i_sendemail'),// return value(s):
            array('return'=>'tns:EmailResult'),// namespace:
            false,// soapaction: (use default)
            false,// style: rpc or document
            'rpc',// use: encoded or literal
            'encoded',// description: documentation for the method
            ''
        );

        function SendFMEmail($data) {

            if ($data['service_password']=='S*2XJ981iR'){

                $email_data = array(
                    'full_name' => $data['account_name'],
                    'email' => $data['email'],
                    'password' => $data['trader_password'],
                    'account_number' => $data['account_number'],
                    'trader_password' => $data['trader_password'],
                    'investor_password' => $data['investor_password'],
                    'server_link' => $data['server_link'],
                );

                $isSendSuccess =   Fx_mailer::demo_registration_for_WSFM($email_data);
                if($isSendSuccess){
                    $data['emailsending']=   'RET_OK';
                    $is_emailsent=1;
                }else{
                    $data['emailsending']=   'RET_EMAIL_SENDING_FAILED';
                    $is_emailsent=0;
                }

                FXPP::CI()->load->model("Webservice_model");
                $data['log']=array(
                    'email' => $data['email'],
                    'account_number' => $data['account_number'],
                    'login_number' => $data['login_number'],
                    'investor_password' => $data['investor_password'],
                    'trader_password' => $data['trader_password'],
                    'server_link' => $data['server_link'],
                    'account_name' => $data['account_name'],
                    'IP' =>  FXPP::CI()->input->ip_address(),
                    'date' => FXPP::getCurrentDateTime(),
                    'is_emailsent' => $is_emailsent
                );
                FXPP::CI()->Webservice_model->insertmy($table="webservice",$data['log']);

                return array(
                    "email"             => $data['email'],
                    "account_number"    => $data['account_number'],
                    "login_number"      => $data['login_number'],
                    "investor_password" => $data['investor_password'],
                    "trader_password"   => $data['trader_password'],
                    "server_link"       => $data['server_link'],
                    "account_name"      => $data['account_name'],
                    "ReqResult"         => $data['emailsending']
                );

            }else{

                return array(
                    "ReqResult"         => 'RET_SERVICE_PASSWORD_INCORRECT',
                );
            }



        }
    }

}
