<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 6/1/16
 * Time: 12:16 PM
 */

class Qiwi {

    private $request_type;
    private $password;
    private $terminal_id;

    private $result_code ;
    private $number_exist;
    private $amount;
    private $ccy;
    private $service_id;
    private $transaction_number;
    private $phone;
    private $balance;

    private $top_up_response;
    private $from;
    private $to;
    private $tnx_status_check;
    private $error;

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $tnx_status_check
     */
    public function setTnxStatusCheck($tnx_status_check)
    {
        $this->tnx_status_check = $tnx_status_check;
    }

    /**
     * @return mixed
     */
    public function getTnxStatusCheck()
    {
        return $this->tnx_status_check;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $top_up_response
     */
    public function setTopUpResponse($top_up_response)
    {
        $this->top_up_response = $top_up_response;
    }

    /**
     * @return mixed
     */
    public function getTopUpResponse()
    {
        return $this->top_up_response;
    }



    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $ccy
     */
    public function setCcy($ccy)
    {
        $this->ccy = $ccy;
    }

    /**
     * @return mixed
     */
    public function getCcy()
    {
        return $this->ccy;
    }

    /**
     * @param mixed $number_exist
     */
    public function setNumberExist($number_exist)
    {
        $this->number_exist = $number_exist;
    }

    /**
     * @return mixed
     */
    public function getNumberExist()
    {
        return $this->number_exist;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = (int)$phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $request_type
     */
    public function setRequestType($request_type)
    {
        $this->request_type = $request_type;
    }

    /**
     * @return mixed
     */
    public function getRequestType()
    {
        return $this->request_type;
    }

    /**
     * @param mixed $result_code
     */
    public function setResultCode($result_code)
    {
        $this->result_code = $result_code;
    }

    /**
     * @return mixed
     */
    public function getResultCode()
    {
        return $this->result_code;
    }

    /**
     * @param mixed $service_id
     */
    public function setServiceId($service_id)
    {
        $this->service_id = $service_id;
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->service_id;
    }

    /**
     * @param mixed $terminal_id
     */
    public function setTerminalId($terminal_id)
    {
        $this->terminal_id = $terminal_id;
    }

    /**
     * @return mixed
     */
    public function getTerminalId()
    {
        return $this->terminal_id;
    }

    /**
     * @param mixed $transaction_number
     */
    public function setTransactionNumber($transaction_number)
    {
        $this->transaction_number = $transaction_number;
    }

    /**
     * @return mixed
     */
    public function getTransactionNumber()
    {
        return $this->transaction_number;
    }



    public  function sendRequest($xml){
        $url = 'https://api.qiwi.com/xml/topup.jsp';
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function balanceCheck(){
        $xml = '<xml>
            <request>
            <request-type>ping</request-type>
            <extra name="password">'.$this->password.'</extra>
            <terminal-id>'.$this->terminal_id.'</terminal-id>
            </request></xml>';
        $response = simplexml_load_string($this->sendRequest($xml));
        $this->result_code = $response->result_code;
        $this->balance = $response->balances->balance;
    }
    public function availability_check(){
        $xml = '<xml><request>
                                                <request-type>check-user</request-type>
                                                <terminal-id>'.$this->terminal_id.'</terminal-id>
                                                <extra name="password">'.$this->password.'</extra>
                                                <extra name="phone">'.$this->phone.'</extra>

                                                </request></xml>';
        /*<extra name="ccy">'.$this->ccy.'</extra>*/

        $response =  simplexml_load_string($this->sendRequest($xml));

        $this->result_code = $response->result_code;
        $this->number_exist = $response->exist;


    }
    public function top_up(){
        $xml = '<xml>
                <request>
                <request-type>pay</request-type>
                <terminal-id>'.$this->terminal_id.'</terminal-id>
                <extra name="password">'.$this->password.'</extra>
                <auth>
                <payment>
                <transaction-number>'.$this->transaction_number.'</transaction-number>
                <from>
                <ccy>'.$this->ccy.'</ccy>
                </from>
                <to>
                <amount>'.$this->amount.'</amount>
                <ccy>'.$this->ccy.'</ccy>
                <service-id>99</service-id>
                <account-number>'.$this->phone.'</account-number>
                </to>
                </payment>
                </auth>
                </request></xml>';
        $response = simplexml_load_string($this->sendRequest($xml));
        $this->result_code = $response->result_code;
        $this->top_up_response = $response->payment;
        $this->to = $response->payment->to;
        $this->from = $response->payment->from;
    }

    public function status_check(){

        $xml = '<xml><request>
                <request-type>pay</request-type>
                <terminal-id>'.$this->terminal_id.'</terminal-id>
                <extra name="password">'.$this->password.'</extra>
                <status>
                <payment>
                <transaction-number>'.$this->transaction_number.'</transaction-number>
                <to>
                <account-number>'.$this->phone.'</account-number>
                </to>
                </payment>
                </status>
                </request></xml>

                ';

        $response =  simplexml_load_string($this->sendRequest($xml));

        $this->result_code = $response->result_code;
        $this->tnx_status_check = $response->payment->attributes();


    }

    public function sendTopUp($phone,$amount){

        $this->phone = $phone;
        $this->amount = $amount;

        // Check qiwi walate number availability

        $this->availability_check();

        if($this->number_exist == 1){

            $this->top_up(); // send top up request


                if($this->top_up_response['status'] == 60 && $this->top_up_response['final-status'] == true ){


                            $this->error = $this->errorArray((int)$this->top_up_response['status'],(int)$this->top_up_response['result-code']);
                       return true;


                }else{
                    $this->status_check();

                    if($this->tnx_status_check['status'] == 60){
                        $this->error = $this->errorArray((int)$this->top_up_response['status'],(int)$this->top_up_response['result-code']);
                        return true;
                    }else{
                        $this->error = $this->errorArray((int)$this->top_up_response['status'],(int)$this->top_up_response['result-code']);
                    }


                }

        }else{
            $this->error = "The user is not registered in Visa QIWI Wallet system";
        }

        return false;
    }


    public function errorArray($code,$error_code){

$error_msg = "";
        switch ($code) {
            case ($code >= 0 && $code <= 49 ):
                $error_msg =  "The payment is accepted but waiting for the confirmation from Visa QIWI Wallet system.";
                break;
            case ($code >= 50 && $code <= 60 ):
                $error_msg = "Payment is being processed. The amount has been charged from the Agent’s account.";
                break;
            case 60:
                $error_msg = "Payment has been processed successfully.";
                break;
            case 150:
                $error_msg = "Payment declined.";
                break;
            case 160:
                $error_msg = "Payment is not processed or has been canceled.";
                break;
        }

        $error = array(
            '0'=>"",
            '13'=>"Repeat the request in a minute.",
            "50" =>"The payment is accepted for processing.",
            "52" =>"The amount is being credited to the user account.",
            "60" =>"Payment has been processed successfully.",
            "150" =>"Payment declined.",
            "160" =>"Payment is not processed or has been canceled.",
            "155" =>"Invalid service code.",
            "215" =>"Top-up request has payment transaction number (transaction-number) that is already registered in Visa QIWI Wallet but other parameters differ. Payment parameters have to be in agreement with this payment transaction number.",
            "220"=>"Not enough funds available on the Agent’s account to process payment.",
            "241"=>"Payment amount is less than allowed.",
            "242"=>"Payment amount is greater than allowed.",
            "298"=>"User account with specified phone number is not registered in Visa QIWI Wallet system Invalid phone number as user account ID.",
            "300"=>"Unknown processing error.",
            "316"=>"Authorization from the blocked agent.",
            "319"=>"Top-up of this user account is blocked.",
            "700"=>"Monthly limit on operations is exceeded.",
            "702"=>"Visa QIWI Wallet client’s account balance limit is exceeded."
        );

      return  isset($error[$code])?$error[$error_code]." ". $error_msg:"Payment is not processed.";


    }




} 