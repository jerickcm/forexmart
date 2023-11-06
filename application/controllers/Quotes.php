<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends MY_Controller {

    public function getForexQuotes()
    {

        session_write_close(); // developing a website with heavy AJAX usage
        if ($this->input->is_ajax_request()) {
            $tickers = $this->input->get('tickers',true);
            $sysmbolData = FXPP::getQuotes($tickers);
            echo json_encode($sysmbolData);
        }else{
            redirect();
        }
        exit;

        $config = array(
            'server' => 'trading'
        );
        $WebService = new WebService($config);
        $WebService->open_GetCurrentQuotes();
        if($WebService->request_status === 'RET_OK'){
            $symbols = array(
                'EURUSD',
                'GBPUSD',
                'USDJPY',
                'USDCHF',
                'USDCAD',
                'EURJPY',
                'EURCHF',
                'GBPJPY',
                'GBPCHF'
            );

            $encodeQuotes = json_encode($WebService->get_result('Quotes'));
            $decodeQuotes = json_decode($encodeQuotes, true);
            $quotesData = array_column($decodeQuotes['QuoteData'], 'Symbol');

            foreach($quotesData as $key => $o){
                if(in_array($o, $symbols)){
                    $sysmbolData[] = array_change_key_case($decodeQuotes['QuoteData'][$key]);
                }
            }
            echo json_encode($sysmbolData);
        }else{
            if(function_exists('file_get_contents')){
                $forexquotes = file_get_contents("http://quotes.instaforex.com/get_quotes.php?m=json");
                echo $forexquotes;
            }
        }

    }

    public function test(){
        $sysmbolData = FXPP::getQuotes();
        foreach($sysmbolData as $r){
            FXPP::print_data($r['symbol']);
        }
    }

    public function getQuotesSample(){
        if ($this->input->is_ajax_request()) {
            $tickers = $this->input->get('tickers',true);
            $sysmbolData = FXPP::getQuotes($tickers);
            echo json_encode($sysmbolData);
        }else{
            redirect();
        }
    }

    public function parseQuotes(){
//        $forexquotes = file_get_contents("http://quotes.instaforex.com/get_quotes.php?m=json");
//
//        $test2 = json_decode($forexquotes, true);
//        echo '<pre>',print_r($test2,1),'</pre>';

        $Login = 123; #Must be Changed
        $apiPassword = "qweqwe"; #Must be Changed
        $data = array("Login" => $Login, "Password" => $apiPassword);
        $data_string = json_encode($data);

        $apiAuthenticationMethod = ''; #Must be Changed
        $ch = curl_init('https://client-api.instaforex.com/'.$apiAuthenticationMethod);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));

        $token = curl_exec($ch);
        curl_close($ch);

        $apiMethodUrl = ''; #Must be Changed
        $ch = curl_init('https://client-api.instaforex.com/'.$apiMethodUrl.$Login); #possibly Must be Changed part with [$Login]. Depends on the method param
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('passkey: '.$token));
        $result = curl_exec($ch);
        echo '<pre>',print_r($result,1),'</pre>';
    }

}
