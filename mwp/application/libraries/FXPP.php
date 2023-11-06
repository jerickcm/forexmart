<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FXPP {

    function __construct(){
        //Unbanned IP procedures
/*
        $allowedCountries = unserialize(ALLOWED_COUNTRIES);

        $allowedIPs = unserialize(ALLOWED_IPS);

        $ip_range = unserialize(ALLOWED_IP_RANGES);
        $is_allowed = false;
        foreach($ip_range as $range) {
            # Get the numeric reprisentation of the IP Address with IP2long
            $min = ip2long($range[0]);
            $max = ip2long($range[1]);
            $needle = ip2long($_SERVER['REMOTE_ADDR']);

            # Then it's as simple as checking whether the needle falls between the lower and upper ranges
            if((($needle >= $min) AND ($needle <= $max))){
                $is_allowed = true;
                break;
            }
        }

        if(!in_array($this->getUserCountryCode(), $allowedCountries) && !in_array($_SERVER['REMOTE_ADDR'], $allowedIPs) && !in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) && !$is_allowed){
            show_error('Website is currently unavailable', 500 );
        }
*/
    }
//    public static function remap($segment){
//        if ($segment=='de'){
//            self::CI()->session->set_userdata('site_lang', 'german');
//        }else{
//            self::CI()->set_userdata('site_lang', 'english');
//        }
//    }
    public static function CI(){
        $CI =& get_instance();
        return $CI;
    }

    public static function Pre($a){
        ob_start();
        ?><pre><?php print_r($a) ?></pre><?php
        echo ob_get_clean();
    }

    public static function canCreateVirtualAccount(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('virtual_account_model');

        $user_id = $ci->session->userdata('user_id');
        $virtual_accounts = $ci->virtual_account_model->getVirtualAccountsByUserId($user_id);

        if( $virtual_accounts === false || count($virtual_accounts) < 5 ){
            return true;
        }else{
            return false;
        }
    }

    public static function hasCreateVirtualAccount(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('virtual_account_model');

        $user_id = $ci->session->userdata('user_id');
        $virtual_accounts = $ci->virtual_account_model->getVirtualAccountsByUserId($user_id);

        if( $virtual_accounts === false ){
            return false;
        }else{
            return true;
        }
    }

    public static function getAccountCurrencyBase(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('general_model');

        $user_id = $ci->session->userdata('user_id');
        $account_currency_base = $ci->general_model->getAccountCurrencyBase();
        $virtual_accounts = $ci->virtual_account_model->getVirtualAccountsByUserId($user_id);

        foreach( $virtual_accounts as $account ){
            if( in_array($account['currency'], $account_currency_base) ){
                unset($account_currency_base[$account['currency']]);
            }
        }
        return $account_currency_base;
    }

    public static function getUserAccountCurrencyBase(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('general_model');

        $user_id = $ci->session->userdata('user_id');
        $account_currency_base = array();
        $virtual_accounts = $ci->virtual_account_model->getVirtualAccountsByUserId($user_id);

        foreach( $virtual_accounts as $account ){
            $account_currency_base[$account['currency']] = $ci->general_model->getAccountCurrencyBase($account['currency']);
        }
        return $account_currency_base;
    }

    public static function getCurrentDateTime(){
        require_once("geoip/geoipcity.inc");
        require_once("geoip/geoipregionvars.php");
        require_once("geoip/timezone.php");

        //Get remote IP
        $ip = $_SERVER['REMOTE_ADDR'];

        //Open GeoIP database and query our IP
        $gi = geoip_open(APPPATH . "libraries/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
        $record = geoip_record_by_addr($gi, $ip);

        //If we for some reason didnt find data about the IP, default to a preset location.
        //You can also print an error here.
        if(!isset($record)){
            redirect('signout');
        }
        log_message('error', 'Test[' . $_SERVER['REMOTE_ADDR'] . '] Country Code' . $record->country_code);
        //Calculate the timezone and local time
        try{
            //Create timezone
            $user_timezone = new DateTimeZone(get_time_zone($record->country_code, ($record->region!='') ? $record->region : 0));

            //Create local time
            $user_localtime = new DateTime("now", $user_timezone);
        } catch(Exception $e){    //Timezone and/or local time detection failed

            $user_localtime = new DateTime("now");
        }

        return $user_localtime->format('Y-m-d H:i:s');
    }

    public static function getUserCountryCode(){
        require_once("geoip/geoipcity.inc");
        require_once("geoip/geoipregionvars.php");
        require_once("geoip/timezone.php");

        //Get remote IP
        $ip = $_SERVER['REMOTE_ADDR'];


        //Open GeoIP database and query our IP
        $gi = geoip_open(APPPATH . "libraries/geoip/GeoLiteCity.dat", GEOIP_STANDARD);

        return geoip_country_code_by_addr($gi, $ip);
    }

    public static function getCountries(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('general_model');
        return $ci->general_model->getCountries();
    }

    public static function getAllCountries(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('general_model');
        return $ci->general_model->getAllCountries();
    }
    public static function getPartnersStatusType(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('general_model');
        return $ci->general_model->getPartnersStatusType();
    }

    public static function getCustomReferenceNum(){
        $date = new DateTime();
        $refnum = $date->getTimestamp();
        return $refnum;
    }

    public static function errorException(){
        $ci =& get_instance();
        $ci->output->set_status_header('404');
        //show_404();
    }
    public static function getVisitorInfo(){
        require_once("geoip/geoipcity.inc");
        require_once("geoip/geoipregionvars.php");
        require_once("geoip/timezone.php");

        //Get remote IP
        $ip = $_SERVER['REMOTE_ADDR'];


        //Open GeoIP database and query our IP
        $gi = geoip_open(APPPATH . "libraries/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
        return( GeoIP_record_by_addr($gi,$ip));
        //return true;

    }

    public static function GetTimezone($ip){
        require_once("geoip/timezone.php");
        require_once("geoip/geoipcity.inc");
        require_once("geoip/geoipregionvars.php");
        $gi = geoip_open(APPPATH . "libraries/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
        $c_code = geoip_country_code_by_addr($gi,$ip);
        $region = geoip_region_by_addr($gi,$ip);
        $result = get_time_zone($c_code, $region);
        return $result;
        geoip_close($gi);
    }

    public static function GenerateWalletNumber(){
        $CI =& get_instance();
        $CI->load->model('account_model');

        $walletNum = 'FM'.self::RandomizeNumber(8);

        $unique = $CI->account_model->checkIfUniqueAccountNumber($walletNum);

        return ($unique) ? $walletNum : self::GenerateWalletNumber();
    }

    private static function RandomizeNumber($length){

        $random = '';
        for($i = 0; $i<$length; $i++){
            $random .= mt_rand(0,9);
        }

        return $random;
    }

    public static function generateGUIDForgotPassword($length){
        $CI =& get_instance();
        $CI->load->model('user_model');

        $create_token = self::RandomizeCharacter($length);
        $unique = $CI->user_model->validateToken($create_token);

        return ($unique) ? $create_token : self::generateGUIDForgotPassword($length);
    }
    public static function generateGUIDForgotPassword1(){
        $CI =& get_instance();
        $CI->load->model('user_model');

        $create_token = self::RandomizeCharacter(21);
        $unique = $CI->user_model->validateToken($create_token);

        return ($unique) ? $create_token : self::generateGUIDForgotPassword();
    }

    public static function RandomizeCharacter($length){

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for($i = 0; $i<$length; $i++){
            $result .= $characters[mt_rand(0, 61)];
        }

        return $result;
    }

    public static function ip_in_range($needle_ip_address)
    {
        $ip_range = unserialize(ALLOWED_IP_RANGES);
        $is_allowed = false;
        foreach($ip_range as $range) {
            # Get the numeric reprisentation of the IP Address with IP2long
            $min = ip2long($range[0]);
            $max = ip2long($range[1]);
            $needle = ip2long($needle_ip_address);

            # Then it's as simple as checking whether the needle falls between the lower and upper ranges
            if((($needle >= $min) AND ($needle <= $max))){
                echo $needle_ip_address;
                $is_allowed = true;
                break;
            }
        }
        return $is_allowed;
    }

    //  Mailer

    public static function getOptionMailer($table, $field){
        $CI = & get_instance();
        $CI->load->model('general_model');
        $getLanguages = $CI->general_model->getOptionMailer($table);
        $select = '';
        foreach($getLanguages as $key => $r){
            $select .= "<option value='".$r['Id']."'>".$r[$field]."</option>";
        }
        return $select;
    }

    public static function getLanguagesMailer(){
        $CI = & get_instance();
        $CI->load->model('general_model');
        $getLanguages = $CI->general_model->getLanguagesMailer();
        $select = '';
        foreach($getLanguages as $key => $r){
            $select .= "<option value='".$r['Id']."'>".$r['Language']."</option>";
        }
        return $select;
    }
    public static function getMailer(){


        $CI = & get_instance();
        $CI->load->model('general_model');
        $getLanguages = $CI->general_model->getMailer();
        $select = '';
        foreach($getLanguages as $key => $r){
            $select .= "<option value=".$r['Id'].">".$r['NameOfMailing']."</option>";
        }
        return $select;
    }

    public static  function settingsreplyto(){
        $CI = & get_instance();
        $CI->load->model('general_model');
        $getLanguages = $CI->general_model->getMailer();
        $select = '';
        foreach($getLanguages as $key => $r){
            $select .= "<option value=".$r['Id'].">".$r['NameOfMailing']."</option>";
        }
        return $select;
    }

    public static function ValidateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }

    public function ForexData($fromCurr, $toCurr){
        $xCurrency = $fromCurr.$toCurr;
        $yahooFinanceUrl = 'http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair = "'.$xCurrency.'"&env=store://datatables.org/alltableswithkeys';
        $xmlResult = simplexml_load_file($yahooFinanceUrl);
        $forexData = json_decode(json_encode($xmlResult),true);

        //var_dump($forexData);
        $forexResult = $forexData['results']['rate'];
        return array(
            'Name' => $forexResult['Name'],
            'Rate' => $forexResult['Rate'],
            'Date' => $forexResult['Date'],
            'Time' => $forexResult['Time']
        );
    }

    public function ForexDataArray($currencyPairArray){
        $currencyPair = implode('","', $currencyPairArray);
        $yahooFinanceUrl = 'http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ("'.$currencyPair.'")&env=store://datatables.org/alltableswithkeys';
        $xmlResult = simplexml_load_file($yahooFinanceUrl);
        $forexData = json_decode(json_encode($xmlResult),true);

        foreach($forexData['results']['rate'] as $data){

            $id = $data['@attributes']['id'];
            $namePair = explode('/',$data['Name']);

            $forexDataArray[$id] = array(
                'FromCurr' => $namePair[0],
                'ToCurr' => $namePair[1],
                'Rate' => $data['Rate'],
                'Date' => $data['Date'],
                'Time' => $data['Time']
            );
        }

        return $forexDataArray;
    }

    public static function get_random_password($chars_min=7, $chars_max=8, $use_upper_case=true, $include_numbers=true, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .=  $current_letter;
        }

        return $password;
    }

    public static function encrypt_data( $str_data, $key ){
        $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
            MCRYPT_DEV_URANDOM
        );

        $encrypted = base64_encode(
            $iv .
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', $key, true),
                $str_data,
                MCRYPT_MODE_CBC,
                $iv
            )
        );

        return $encrypted;
    }

    public static function decrypt_data( $str_data, $key ){
        $data = base64_decode($str_data);
        $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

        $decrypted = rtrim(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', $key, true),
                substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
                MCRYPT_MODE_CBC,
                $iv
            ),
            "\0"
        );

        return $decrypted;
    }

    public static function GenerateRandomAffiliateCode(){
        $CI =& get_instance();
        $CI->load->model('account_model');
        $CI->load->helper('string');

        $generateAffiliateCode = strtoupper(random_string('alpha', 5));
//print_r($generateAffiliateCode);exit;
        $unique = $CI->account_model->checkUniqueAffiliateCode($generateAffiliateCode);

        return ($unique) ? $generateAffiliateCode : self::GenerateRandomAffiliateCode();
    }

    public static function custom_url($uri = '', $protocol = NULL){
        $CI =& get_instance();
        $getAffiliateCode = (isset($_GET['id']))? '?id='.$_GET['id'] : '';

        if(strlen($CI->uri->segment(1,0))==2){
            $uri=$CI->uri->segment(1,0).'/'.$uri;
        }

        $uri = $uri.$getAffiliateCode;
        return get_instance()->config->site_url($uri,$protocol);
    }
    public static function loc_url($uri = ''){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $string=$CI->uri->segment(1,0).'/'.$uri.'/';
        }else{
            $string=$uri;
        }
        return site_url($string);
        unset ($string);
    }
    public static function ajax_url($uri = ''){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $string=$CI->uri->segment(1,0).'/'.$uri;
        }else{
            $string=$uri;
        }
        return (site_url().$string);
    }
    public static function www_url($uri = ''){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $string=$CI->uri->segment(1,0).'/'.$uri;
        }else{
            $string=$uri;
        }
        return ($CI->config->item('domain-www').'/'.$string);
    }
    public static function my_url($uri = ''){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $string=$CI->uri->segment(1,0).'/'.$uri;
        }else{
            $string=$uri;
        }
        return ($CI->config->item('domain-my').'/'.$string);
    }
    public static function html_url($uri = ''){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $string=$CI->uri->segment(1,0);
        }else{
            $string='en';
        }
        return ($string);
    }
    public static function lang_dir(){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $data['uri']=$CI->uri->segment(1,0);
        }else{
            $data['uri']='en';
        }
        switch($data['uri']){
            case in_array( $CI->config->item(['lang_uri_ltr']),$data['uri']):
                return 'ltr';
                break;
            case $data['uri']=="sa":
                return 'rtl';
                break;
            default:
                return 'ltr';
        }
    }

    public static function websiteTraking(){
        $ci =& get_instance();
        $class = $ci->router->class;

        $ci->load->database();
        $ci->load->model('general_model');

        $data = array(
            'id'=>session_id(),
            'page'=>$class
        );

       

        $ci->general_model->insertmy('traking_2102016',$data);

    }
    public static function GetAccountAgent($account_number){
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $account_info = array('iLogin' => $account_number );
        $WebService->open_RequestAccountDetails($account_info);
        if($WebService->request_status === 'RET_OK'){
            $accountDetails = $WebService->get_all_result();
            $getAccountAgent = $accountDetails['Agent'];
            return $getAccountAgent;
        }

        return false;
    }
    public static function leverage_auto_change_50($account_number=''){
        self::CI()->load->model('General_model');
        self::CI()->g_m=self::CI()->General_model;
        $off_leverage = self::CI()->g_m->showssingle2($table='turnedoff_leverage',$field='account_number',$id=$account_number,$select='user_id,action');
        if($off_leverage){

        }else{
            $config = array(
                'server' => 'live_new'
            );

            $info = array(
                'iLogin' => $account_number,
                'iLeverage' => 50
            );
            $WebService = new WebService($config);
            $WebService->open_ChangeAccountLeverage( $info );
            if( $WebService->request_status === 'RET_OK' ) {
                $data['lev_ratio']=array(
                    'leverage'=>'1:50',
                    'auto_leverage_change'=>1
                );
                self::CI()->g_m->updatemy('mt_accounts_set', 'account_number', $account_number, $data['lev_ratio']);

            }
        }

    }

    public static function update_account_group(){
        $CI =& get_instance();
        $CI->load->model('account_model');
        $user_id = $CI->session->userdata('user_id');
        $account = $CI->account_model->getAccountByUserId($user_id);
        if(count($account) > 0){
            $webservice_config = array(
                'server' => 'live_new'
            );
            $WebService = new WebService($webservice_config);
            $data = array(
                'iAccountNumber' => $account['account_number']
            );
            $WebService->request_account_details($data);
            if ($WebService->request_status === 'RET_OK') {
                $group = $WebService->get_result('Group');
                if(in_array(substr($group, -1), array('1' , '2', '3'))){
                    $code = substr($group, -1);
                    $CI->account_model->updateAccountGroupCode($account['account_number'], $code);
                }
            }
        }
    }
    public static function getCurrencyRate($amount, $from_currency, $to_currency){

        $webservice_config = array(
            'server' => 'currency_converter'
        );

        $WebServiceA = new WebService($webservice_config);
        $convertDetails = array(
            'Amount' => $amount,
            'FromCurrency' => $from_currency,
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ',
            'ToCurrency' => $to_currency
        );
        $ConvertCurrency = $WebServiceA->ConvertCurrency($convertDetails);
        $resultConvertCurrency = $ConvertCurrency['ConvertCurrencyResult'];
        if ($resultConvertCurrency['Status'] === 'RET_OK') {
            $convertedAmount = $resultConvertCurrency['ToAmount'];
        } else {
            $convertCurrencies = FXPP::ForexData2($from_currency, $to_currency);
            $convertedAmount =$amount * $convertCurrencies['Rate'];
        }

        return $convertedAmount;
    }
    public static function ForexData2($fromCurr, $toCurr){
        $xCurrency = $fromCurr.$toCurr;
        $yahooFinanceUrl = 'http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair = "'.$xCurrency.'"&env=store://datatables.org/alltableswithkeys';
        $xmlResult = simplexml_load_file($yahooFinanceUrl);
        $forexData = json_decode(json_encode($xmlResult),true);

        //var_dump($forexData);
        $forexResult = $forexData['results']['rate'];
        return array(
            'Name' => $forexResult['Name'],
            'Rate' => $forexResult['Rate'],
            'Date' => $forexResult['Date'],
            'Time' => $forexResult['Time']
        );
    }
    //FXPP-5564
    public static function update_auto_leverage( $user_id = 0 ){
        $CI =& get_instance();
        $CI->load->model('Quick_model');
        $webservice_config = array(
            'server' => 'live_new'
        );
        $isUpdate = false;
        $hasAutoLeverage = $CI->Quick_model->hasUserAutoLeverage($user_id);
        if($hasAutoLeverage){
            $user_detail = $CI->Quick_model->getAccountByUserId($user_id);
            $leverage = count($ex_leverage = explode(":", $user_detail['leverage'])) > 1 ? $ex_leverage[1] : 200;
            if($leverage > 500) {
                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iLogin' => $user_detail['account_number']
                );
                $WebService->open_RequestAccountBalance($account_info);
                if( $WebService->request_status === 'RET_OK' ) {
                    $balance = $WebService->get_result('Balance');
                    if ($balance > 1000) {

                        $leverage = 500;

                        $info = array(
                            'iLogin' => $user_detail['account_number'],
                            'iLeverage' => $leverage
                        );

                        $WebService2 = new WebService($webservice_config);
                        $WebService2->open_ChangeAccountLeverage($info);
                        if ($WebService2->request_status === 'RET_OK') {
                            if($CI->Quick_model->updateAccountLeverage($user_detail['account_number'], '1:500')){
                                $isUpdate = true;
                            }
                        }
                    }
                }
            }
        }

        return $isUpdate;
    }

        public static function limit_15reg_24hrs(){
        // FXPP-2988 Implement logic of putting a limit on the creation of accounts using the same user details in FXPP
        //limit 15 account registration per day
        self::CI()->load->model('General_model');
        self::CI()->load->model('Task_model');
        self::CI()->g_m=self::CI()->General_model;
        self::CI()->t_m=self::CI()->Task_model;


        if($_SESSION['tmp_live_login_type']==0){
            $today_live_registration = self::CI()->t_m->showView1Where3(
                $table='today_live_registration',
                $field0='email',$id0=$_SESSION['tmp_live_email'],
                $field1='full_name',$id1=$_SESSION['tmp_live_full_name'],
                $field2='last_ip',$id1=self::CI()->input->ip_address(),
                $select='count');
            if ($today_live_registration){
                if( floatval($today_live_registration['count'])>=15){
//                if( floatval($today_live_registration['count'])>0){
                    $data['count']=$today_live_registration['count'];
                    $data['return']=true; // means registration > 15
                    return true;
                }else{
                    $data['count']=$today_live_registration['count'];
                    $data['return']=false;
                    return false;
                }
            }
        }
    }

        public static function getServerTime(){
        $webservice_config = array(
            'server' => 'live_new'
        );

        $WebService = new WebService($webservice_config);
        $WebService->open_GetServerTime();
        $serverTime = $WebService->get_all_result();

        return date('Y-m-d H:i:s', strtotime($serverTime));
    }

    public static function setWaterMark($source_image){
        $ci =& get_instance();
        $ci->load->library('image_lib');
        $ci->load->library('watermarkPdf');
        $ext = pathinfo($source_image, PATHINFO_EXTENSION);
        if($ext == "pdf"){
            WatermarkPdf::watermark($source_image);
            return true;
        }
        $config['source_image'] = $source_image;
        chmod($config['source_image'],0777);
        if(strtolower($ext) == "gif"){
            $config['wm_overlay_path'] = './assets/images/watermark_gif.png';
        }else if(strtolower($ext) == "png"){
            $config['wm_overlay_path'] = './assets/images/watermark_gif.png';
        }else{
            $config['wm_overlay_path'] = './assets/images/watermark_s2.png';
        }
        $config['wm_type'] = 'overlay';
        $config['wm_opacity'] = '10';
        $config['wm_padding'] = '0';
        $size = getimagesize($config['source_image']);
        if(isset($size[0])){
            if($size[0]<541){
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_hor_alignment'] = 'center';
                $config['wm_overlay_path'] = './assets/images/watermark_s.png';
                if($ext == "gif"){
                    $config['wm_overlay_path'] = './assets/images/watermark_gif.png';
                }
                $ci->image_lib->initialize($config);
                if (!$ci->image_lib->watermark()) {
                    echo $ci->image_lib->display_errors();
                }
                $ci->image_lib->clear();
                return true;
            }else if($size[0]<900){
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_hor_alignment'] = 'center';
                $config['wm_overlay_path'] = './assets/images/watermark.png';
                if($ext == "gif"){
                    $config['wm_overlay_path'] = './assets/images/watermark_gif.png';
                }
                $ci->image_lib->initialize($config);
                $ci->image_lib->watermark();
                if (!$ci->image_lib->watermark()) {
                    echo $ci->image_lib->display_errors();
                }
                return true;
            }


            if($size[0]>1400){
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_hor_alignment'] = 'center';
                $ci->image_lib->initialize($config);
                if (!$ci->image_lib->watermark()) {
                    echo $ci->image_lib->display_errors();
                }
            }
        }

        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'left';
        $ci->image_lib->initialize($config);
        $ci->image_lib->watermark();
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'right';
        $ci->image_lib->initialize($config);
        $ci->image_lib->watermark();
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'left';
        $ci->image_lib->initialize($config);
        $ci->image_lib->watermark();
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        $ci->image_lib->initialize($config);
        if (!$ci->image_lib->watermark()) {
            echo $ci->image_lib->display_errors();
        }

        $ci->image_lib->clear();
        return true;

    }
    public static function update_account_group_specific($user_id){
        $CI =& get_instance();
        $CI->load->model('account_model');
        $account = $CI->account_model->getAccountByUserId($user_id);
        if (count($account) > 0) {
            $webservice_config = array(
                'server' => 'live_new'
            );
            $WebServiceS = new WebService($webservice_config);
            $data = array(
                'iLogin' => $account['account_number']
            );
            $WebServiceS->request_account_details($data);
            if ($WebServiceS->request_status === 'RET_OK') {
                $group = $WebServiceS->get_result('Group');
                if (in_array(substr($group, -1), array('1', '2', '3'))) {
                    $code = substr($group, -1);
                    $CI->account_model->updateAccountGroupCode($account['account_number'], $code);
                }
            }
        }
    }
}