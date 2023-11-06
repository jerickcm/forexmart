<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FM_Webservice extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("FMsoap_library");
        $namespace = "https://www.forexmart.com/FM_Webservice";
        $this->FM_SoapServer = new soap_server();
        $this->FM_SoapServer->soap_defencoding = 'UTF-8';
        $this->FM_SoapServer->encode_utf8 = true;
        $this->FM_SoapServer->decode_utf8 = true;
        $this->FM_SoapServer->configureWSDL("FM_Webserver", "urn:FM_Webserver");
        $namespace = "https://www.forexmart.com/FM_Webservice?wsdl";
        $this->FM_SoapServer->wsdl->schemaTargetNamespace = $namespace;
        $this->method0();
        $this->method1();




    }


    function index() {
        ob_clean();
        $this->FM_SoapServer->service(file_get_contents("php://input"));
        //        ob_clean();
        flush();
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
        /*Input Data type*/
        $this->FM_SoapServer->wsdl->addComplexType(
            'EmailResult',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'ReqResult' => array(
                    'MethodParameters' => 'ReqResult',
                    'type' => 'xsd:string'
                ),
            )
        );
        /*Output Data type*/
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

            if (filter_var($data['service_password'], FILTER_SANITIZE_STRING)=='S*2XJ981iR'){


                $email_data = array(
                    'full_name' => $fullname = filter_var($data['account_name'], FILTER_SANITIZE_STRING) ,
                    'email' =>  $email = filter_var($data['email'], FILTER_SANITIZE_STRING) ,
                    'password' => $trader_password = filter_var($data['trader_password'], FILTER_SANITIZE_STRING),
                    'account_number' => $account_number = filter_var($data['account_number'], FILTER_SANITIZE_STRING),
                    'trader_password' => $trader_password,
                    'investor_password' => $investor_password = filter_var($data['investor_password'], FILTER_SANITIZE_STRING),
                    'server_link' => $server_link = filter_var($data['server_link'], FILTER_SANITIZE_STRING)
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

                $data['log'] = array(
                    'email' =>$email,
                    'account_number' =>$account_number,
                    'login_number' => $login_number = filter_var($data['login_number'], FILTER_SANITIZE_STRING),
                    'investor_password' => $investor_password,
                    'trader_password' => $trader_password,
                    'server_link' => $server_link,
                    'account_name' => $fullname,
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

    private function method0() {
        $this->FM_SoapServer->register(
            "echoTest",
            array("tmp" => "xsd:string"),
            array("return" => "tns:Result"),
            "urn:MySoapServer",
            "urn:MySoapServer#echoTest",
            "rpc",
            "encoded",
            "Echo test"
        );
        $this->FM_SoapServer->wsdl->addComplexType(
            'Result',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'ReqResult' => array(
                    'MethodParameters' => 'ReqResult',
                    'type' => 'xsd:string'
                ),
            )
        );
        function echoTest($tmp) {
            return array(
                "ReqResult"         => 'HELLO',
            );
            //            if (!$tmp) {
            //                return new soap_fault('-1', 'Server', 'Parameters missing for echoTest().', 'Please refer documentation.');
            //            } else {
            //                return "from MySoapServer() : $tmp";
            //            }
        }
    }
    private function method2() {

        $this->FM_SoapServer->wsdl->addComplexType(
            'Response',
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
            )
        );
        $this->FM_SoapServer->register(
            'SendFMEmail2',// parameter list:
            array('Credentials'=>'tns:Response'),// return value(s):
            array('return'=>'tns:Response'),// namespace:
            false,// soapaction: (use default)
            false,// style: rpc or document
            'rpc',// use: encoded or literal
            'encoded',// description: documentation for the method
            'Complex Hello World Method'
        );
        function SendFMEmail2($data) {
            return array(
                "email"             => $data['email'],
                "account_number"    => $data['account_number'],
                "login_number"      => $data['login_number'],
                "investor_password" => $data['investor_password'],
                "trader_password"   => $data['trader_password'],
                "server_link"       => $data['server_link'],
                "account_name"      => $data['account_name'],
            );

        }
    }
    function X() {
        echo memory_get_usage();
        echo '<br/>';
        echo memory_get_peak_usage();
    }
}
