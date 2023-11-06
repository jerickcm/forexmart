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
//        require_once("geoip/geoipcity.inc");
//        require_once("geoip/geoipregionvars.php");
//        require_once("geoip/timezone.php");
//
//        //Get remote IP
//        $ip = $_SERVER['REMOTE_ADDR'];
//
//        //Open GeoIP database and query our IP
//        $gi = geoip_open(APPPATH . "libraries/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
//        $record = geoip_record_by_addr($gi, $ip);
//
//        //If we for some reason didnt find data about the IP, default to a preset location.
//        //You can also print an error here.
//        if(!isset($record)){
//            redirect('signout');
//        }
//        log_message('error', 'Test[' . $_SERVER['REMOTE_ADDR'] . '] Country Code' . $record->country_code);
//        //Calculate the timezone and local time
//        try{
//            //Create timezone
//            $user_timezone = new DateTimeZone(get_time_zone($record->country_code, ($record->region!='') ? $record->region : 0));
//
//            //Create local time
//            $user_localtime = new DateTime("now", $user_timezone);
//        } catch(Exception $e){    //Timezone and/or local time detection failed
//
//            $user_localtime = new DateTime("now");
//        }
//
//        return $user_localtime->format('Y-m-d H:i:s');
        try {

            $webservice_config = array(
                'server' => 'live_new'
            );

            $WebService = new WebService($webservice_config);
            $WebService->open_GetServerTime();
            $serverTime = $WebService->get_all_result();

            $user_localtime = date('Y-m-d H:i:s', strtotime($serverTime));
        }catch(Exception $e){
            $user_localtime = new DateTime("now");
        }

        return date('Y-m-d H:i:s', strtotime($user_localtime));
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

    public static function getUserContinentCode(){
        require_once("geoip/geoipcity.inc");
        require_once("geoip/geoipregionvars.php");
        require_once("geoip/timezone.php");

        //Get remote IP
        $ip = $_SERVER['REMOTE_ADDR'];


        //Open GeoIP database and query our IP
        $gi = geoip_open(APPPATH . "libraries/geoip/GeoLiteCity.dat", GEOIP_STANDARD);

        $record = GeoIP_record_by_addr($gi, $ip);

        return $record->continent_code;
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

    public static function generateUnsubscribeKey(){
        $CI =& get_instance();
        $CI->load->model('mailer_model');

        $unsubscribeKey = self::RandomizeCharacter(21);
        $unique = $CI->mailer_model->getUnsubscribeKeyDetails($unsubscribeKey);

        return ($unique) ? $unsubscribeKey : self::generateUnsubscribeKey();
    }

    public static function generateUnsubscribeKeyMassMailer(){
        $CI =& get_instance();
        $CI->load->model('mailer_model');

        $unsubscribeKey = self::RandomizeCharacter(21);
        $unique = $CI->mailer_model->getUnsubscribekeyOnMassMailer($unsubscribeKey);

        return ($unique) ? $unsubscribeKey : self::generateUnsubscribeKeyMassMailer();
    }

    public static function generateUnsubscribeKeyForTradeOffer(){
        $CI =& get_instance();
        $CI->load->model('mailer_model');

        $unsubscribeKey = self::RandomizeCharacter(21);
        $unique = $CI->mailer_model->getUnsubscribekeyOnForTradeOffer($unsubscribeKey);

        return ($unique) ? $unsubscribeKey : self::generateUnsubscribeKeyForTradeOffer();
    }

    public static function generateGUIDForgotPassword($length){
        $CI =& get_instance();
        $CI->load->model('user_model');

        $create_token = self::RandomizeCharacter($length);
        $unique = $CI->user_model->validateToken($create_token);

        return ($unique) ? $create_token : self::generateGUIDForgotPassword($length);
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
//            switch($CI->uri->segment(1,0)){
//                case 'Cz':
//                    $string='Cz';
//                    break;
//                 default:
//                     $string=$CI->uri->segment(1,0);
//            }
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
            case $data['uri']=="pk":
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
        $table = "tracking_".date('Ym');

        if(!$ci->db->table_exists($table)){
            $ci->load->dbforge();


            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'session' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'page' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'date_time' => array(
                    'type' =>'VARCHAR',
                    'constraint' => '100'

                ),
                'ip' => array(
                    'type' =>'VARCHAR',
                    'constraint' => '100'

                ),
                'data' => array(
                    'type' =>'BLOB',

                ),

            );
            $ci->dbforge->add_field($fields);
            $ci->dbforge->add_key('id', TRUE);
            $ci->dbforge->create_table($table);

        }

        if($ci->db->table_exists($table)){
            $data = array(
                'session'=>session_id(),
                'page'=>$class,
                'date_time'=> time(),
                'ip'=>$ci->input->ip_address(),
                'data'=>serialize($ci->session->all_userdata())
            );
            $ci->general_model->insertmy($table,$data);
        }


    }
    public static function getAllCountries_localize(){
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('general_model');
        return $ci->general_model->getAllCountries_localize();
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

    public static function limit_15reg_24hrs(){
        // FXPP-2988 Implement logic of putting a limit on the creation of accounts using the same user details in FXPP
        //limit 15 account registration per day
        self::CI()->load->model('General_model');
        self::CI()->load->model('Task_model');
        self::CI()->g_m=self::CI()->General_model;
        self::CI()->t_m=self::CI()->Task_model;

        $limit = false;
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
                    $limit= true;
                }else{
                    $data['count']=$today_live_registration['count'];
                    $data['return']=false;

                }
            }

            /*FXPP-7733*/
            $FIPlimit=self::CI()->t_m->count_registrationclient_F_IP( $full_name=$_SESSION['tmp_live_full_name'], $ip=self::CI()->input->ip_address());
            if ($FIPlimit){
                if( floatval($FIPlimit['count'])>=15){
                    $limit= true;  // means registration > 15
                }
            }
            /*FXPP-7733*/


        }
        return $limit;
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


    public static function page_counter(){
        die();
        self::CI()->load->model('General_model');
        self::CI()->g_m=self::CI()->General_model;
        $is_existing = self::CI()->g_m->showssingle2($table = 'visited_pages', $field = 'page', $id =strtok($_SERVER["REQUEST_URI"],'?'), $select = 'count,id');
        if($is_existing){
            $actual='';
            if (substr(strtok($_SERVER["REQUEST_URI"],'?'), 3,1)=='/'){
                $actual=substr(strtok($_SERVER["REQUEST_URI"],'?'),3);
            }else{
                $actual=strtok($_SERVER["REQUEST_URI"],'?');
            }

            $is_existing['count']=$is_existing['count']+1;
            $data= array(
                'count'=> $is_existing['count'],
                'subdomain'=>0,
                'actual_page'=>$actual
            );
            self::CI()->g_m->updatemy($table='visited_pages',$field='id',$id=$is_existing['id'],$data);
        }else{
            $actual='';
            if (substr(strtok($_SERVER["REQUEST_URI"],'?'), 3,1)=='/'){
                $actual=substr(strtok($_SERVER["REQUEST_URI"],'?'),3);
            }else{
                $actual=strtok($_SERVER["REQUEST_URI"],'?');
            }
            $data['insert']= array(
                'count'=> 1,
                'page'=>strtok($_SERVER["REQUEST_URI"],'?'),
                'subdomain'=>0,
                'actual_page'=>$actual
            );
            self::CI()->g_m->insertmy($table='visited_pages',$data['insert']);
        }



    }
    public static function unique_counter(){
        die();
        self::CI()->load->model('General_model');
        self::CI()->g_m=self::CI()->General_model;
        require_once APPPATH.'/helpers/geoiploc.php';
        $ip=FXPP::CI()->input->ip_address();
        if(FXPP::CI()->input->valid_ip($ip)){
            $data['Country'] =getCountryFromIP($ip);
            $is_existing = self::CI()->g_m->showssingle2($table = 'unique_visitors', $field = 'IP', $id=$ip, $select = 'id');
            if(!$is_existing){
                $data=array(
                    'IP'=>FXPP::CI()->input->ip_address(),
                    'Country'=>$data['Country'],
                    'first_visit'=> date('Y-m-d H:i:s')
                );
                self::CI()->g_m->insertmy($table='unique_visitors',$data);
            }
        }
    }

    public static function print_data($data){
        echo '<pre>',print_r($data,1),'</pre>';
    }

    public static function generateQuotesRow(){
        $sysmbolData = FXPP::getQuotes();

        $quoteString = '';
        foreach($sysmbolData as $key => $data){
            $quoteString .= '<tr id="symbol_'.$data['symbol'].'">'
                .'<td class="symbol"> '.$data['symbol'].' </td>'
                .'<td><button class="btn-buy"> '.lang('hm_0').' </button></td>'
                .'<td class="bid"> '.round($data['bid'], 4).' </td>'
                .'<td class="ask"> '.round($data['ask'], 4).' </td>'
                .'<td><button class="btn-sell"> '.lang('hm_1').' </button></td>'
                .'</tr>';
        }

        return $quoteString;

    }
    public static function getBuyAndSellStatsResult(){

        $sysmbolData = FXPP::getQuotes();
        $config = array(
            'server' => 'trading'
        );
        $WebService = new WebService($config);
            
              $WebService->GetActiveTradesBuyAndSellStatistics();
             
          if($WebService->request_status === 'RET_OK'){
              
              $StatsInfo=$WebService->get_result('StatsInfo');
             $buySell=$StatsInfo->BuyAndSellStatsInfo;
            
             $newArray=array();
             foreach ($sysmbolData as $key)
             { 
            
                $getExpecteArray=FXPP::getSearchArray($key['symbol'],$buySell,"Symbol");
            
                if($getExpecteArray)
                {
                    $key['BuyVolumePercentage']=$getExpecteArray->BuyVolumePercentage;
                    $key['SellVolumePercentage']=$getExpecteArray->SellVolumePercentage;
                    $key['TotalVolumePercentage']=$getExpecteArray->TotalVolumePercentage;
                  //  $key['test']=$getExpecteArray->Symbol;
                    
                    array_push($newArray, $key);
                }                
            
             }
             return $newArray;
           //  echo "<pre>";print_r($newArray);exit;
          }
          return false;   
            
            
    }
  public static function getSearchArray($srcVal,$array,$arr_key){
      foreach($array as $val)
      {
            
          if($val->$arr_key==$srcVal)
          {
              return $val;
          }
      }
  }    
        
    
    
    
    
    

    public static function getQuotes($gTickers = null){

        $defaultSymbols = array(
            'AUDUSD',
            'EURCHF',
            'EURGBP',
            'EURJPY',
            'EURUSD',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY'
        );
        $exploadeTickers = explode('~',$gTickers);
        $convertArray = array_map('strtoupper',$exploadeTickers);

        $symbols = empty($gTickers) ? $defaultSymbols : $convertArray;

        $config = array(
            'server' => 'trading'
        );

        $WebService = new WebService($config);
        $WebService->open_GetCurrentQuotes();
        if($WebService->request_status === 'RET_OK'){

            $encodeQuotes = json_encode($WebService->get_result('Quotes'));
            $decodeQuotes = json_decode($encodeQuotes, true);
            $quotesData = array_column($decodeQuotes['QuoteData'], 'Symbol');


            foreach($symbols as $val){
                foreach($quotesData as $key => $o){
                    if($val == $o){
                        $sysmbolData[] = array_change_key_case($decodeQuotes['QuoteData'][$key]);
                    }
                }
            }

            return $sysmbolData;
        }

        return false;
    }

    public static function www_mwp($uri = ''){
        $CI =& get_instance();
        if(strlen($CI->uri->segment(1,0))==2){
            $string=$CI->uri->segment(1,0).'/'.$uri;
        }else{
            $string=$uri;
        }
        return ($CI->config->item('domain-mwp').'/'.$string);
    }

    public static function verifyLegitEmail($toemail, $fromemail, $getdetails = false){

        $details='';
        $email_arr = explode("@", $toemail);
        $domain = array_slice($email_arr, -1);
        $domain = $domain[0];
        // Trim [ and ] from beginning and end of domain string, respectively
        $domain = ltrim($domain, "[");
        $domain = rtrim($domain, "]");
        if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {
            $domain = substr($domain, strlen("IPv6") + 1);
        }
        $mxhosts = array();
        if( filter_var($domain, FILTER_VALIDATE_IP) )
            $mx_ip = $domain;
        else
            getmxrr($domain, $mxhosts, $mxweight);
        if(!empty($mxhosts) )
            $mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
        else {
            if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
                $record_a = dns_get_record($domain, DNS_A);
            }
            elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
                $record_a = dns_get_record($domain, DNS_AAAA);
            }
            if( !empty($record_a) )
                $mx_ip = $record_a[0]['ip'];
            else {
                $result   = "invalid";
                $details .= "No suitable MX records found.";
                return ( (true == $getdetails) ? array($result, $details) : $result );
            }
        }

        $connect = @fsockopen($mx_ip, 25);
        if($connect){
            if(preg_match("/^220/i", $out = fgets($connect, 1024))){
                fputs ($connect , "HELO $mx_ip\r\n");
                $out = fgets ($connect, 1024);
                $details .= $out."\n";

                fputs ($connect , "MAIL FROM: <$fromemail>\r\n");
                $from = fgets ($connect, 1024);
                $details .= $from."\n";
                fputs ($connect , "RCPT TO: <$toemail>\r\n");
                $to = fgets ($connect, 1024);
                $details .= $to."\n";
                fputs ($connect , "QUIT");
                fclose($connect);
                if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to)){
                    $result = "invalid";
                }
                else{
                    $result = "valid";
                }
            }
        }
        else{
            $result = "invalid";
            $details .= "Could not connect to server";
        }
        if($getdetails){
            return array($result, $details);
        }
        else{
            return $result;
        }

    }

    public static function limit_15reg_24hrs_p(){
        // FXPP-2988 Implement logic of putting a limit on the creation of accounts using the same user details in FXPP
        //limit 15 account registration per day
        self::CI()->load->model('General_model');
        self::CI()->load->model('Task_model');
        self::CI()->g_m=self::CI()->General_model;
        self::CI()->t_m=self::CI()->Task_model;
        $limit = false;
        if($_SESSION['tmp_login_type']==1){
            $today_partner_registration= self::CI()->t_m->showView1Where3(
                $table='today_partner_registration',
                $field0='email',$id0=$_SESSION['tmp_email'],
                $field1='full_name',$id1=$_SESSION['tmp_full_name'],
                $field2='last_ip',$id1=self::CI()->input->ip_address(),
                $select='count');

            if ($today_partner_registration){
                if( floatval($today_partner_registration['count'])>=15){
                    $data['count']=$today_partner_registration['count'];
                    $data['return']=true; // registration > 15
                    $limit=true;
                }else{
                    $data['count']=$today_partner_registration['count'];
                    $data['return']=false;

                }
            }

            /*FXPP-7733*/
            $FIPlimit=self::CI()->t_m->count_registrationpartner_F_IP( $full_name=$_SESSION['tmp_live_full_name'], $ip=self::CI()->input->ip_address());
            if ($FIPlimit){
                if( floatval($FIPlimit['count'])>=15){
                    $limit= true;  // means registration > 15
                }
            }
            /*FXPP-7733*/


        }
        return $limit;
    }





    public static function test_this(){
        $CI =& get_instance();
        $CI->load->model('Mailer_model');

        $firstKey = FXPP::generateUnsubscribeKey();
        $howToGetStarted = Fx_mailer::HowToGetStarted('kent73150@gmail.com', 'FX Prog3', $firstKey);
        $dateToday = date('Y-m-d H:i:s');
        if($howToGetStarted){
            $firstInsert = array(
                'RecipientId' => 256402,
                'MethodName' => 'HowToGetStarted',
                'DateRegistered' => $dateToday,
                'DateAvailable' => $dateToday,
                'Counter' => 1,
                'Unsubscribe_key'   => $firstKey
            );
            $CI->Mailer_model->insert_dynamic('mailer_periodic',$firstInsert);
        }
    }

    public static function createPeriodicMailer($to, $name){
        $email = trim($to);
        $CI =& get_instance();
        $CI->load->model('Mailer_model');
        $getRecipientDetails = $CI->Mailer_model->getRecipientDetails($email);
//        $getRecipientDetails = false;
        if($getRecipientDetails){
             $recipientId = $getRecipientDetails[0]['Id'];
             $getMailer = $CI->Mailer_model->getPeriodicMailerLimit1($recipientId,1);
             if($getMailer){
                $getMailerClient = $CI->Mailer_model->getPeriodicMailerLimit1($recipientId,0);
                if(!$getMailerClient){
                    if(FXPP::html_url() == 'ru'){
                        $periodicSequence = array(
                            'HowToGetStartedRussian',
                            'ThirtyPercentBonusRussian',
                //            'HundredPercentBonus', //removed - logic in internal not yet done
                            'importantInstrumentsRussian',
                            //'LasPalmas',
                            //'EuroLicense',
                            'depositInsuranceRussian',
                            'moneyfallContestRussian',
                            //'callbackServices',
                            'affiliate_programRussian',
                            'vpsServicesRussian',
                            'leverageRussian',
                            'mt5Russian',
                            //'rpj_racing_cooperation',
                            'web_terminalRussian',
                            'mobile_platform_russian',
                            'awardsRussian'
                            );
                    }else{
                        $periodicSequence = array(
                            'HowToGetStarted',
                            'ThirtyPercentBonus',
                //            'HundredPercentBonus', //removed - logic in internal not yet done
                            'importantInstruments',
                            //'LasPalmas',
                            //'EuroLicense',
                            'depositInsurance',
                            'moneyfallContest',
                            //'callbackServices',
                            'affiliate_program',
                            'vpsServices',
                            'leverage',
                            'mt5',
                            //'rpj_racing_cooperation',
                            'web_terminal',
                            'mobile_platform_periodic',
                            'awards'
                            );
                    }
                    
                }
             }else{
                $getMailerClient = $CI->Mailer_model->getPeriodicMailerLimit1($recipientId,0);
                if(!$getMailerClient){
                    if(FXPP::html_url() == 'ru'){
                        $periodicSequence = array(
                            'HowToGetStartedRussian',
                            'ThirtyPercentBonusRussian',
                //            'HundredPercentBonus', //removed - logic in internal not yet done
                            'importantInstrumentsRussian',
                            'LasPalmasRussian',
                            'EuroLicenseRussian',
                            'depositInsuranceRussian',
                            'moneyfallContestRussian',
                            'callbackServicesRussian',
                            'affiliate_programRussian',
                            'vpsServicesRussian',
                            'leverageRussian',
                            'mt5Russian',
                            // 'rpj_racing_cooperation',
                            'web_terminalRussian',
                            'mobile_platform_russian',
                            'awardsRussian'
                            );
                    }else{
                        $periodicSequence = array(
                            'HowToGetStarted',
                            'ThirtyPercentBonus',
                //            'HundredPercentBonus', //removed - logic in internal not yet done
                            'importantInstruments',
                            'LasPalmas',
                            'EuroLicense',
                            'depositInsurance',
                            'moneyfallContest',
                            'callbackServices',
                            'affiliate_program',
                            'vpsServices',
                            'leverage',
                            'mt5',
                            // 'rpj_racing_cooperation',
                            'web_terminal',
                            'mobile_platform_periodic',
                            'awards'
                            );
                    }                   
                }
             }

        }else{
            if(FXPP::html_url() == 'ru'){
                $periodicSequence = array(
                    'HowToGetStartedRussian',
                    'ThirtyPercentBonusRussian',
        //            'HundredPercentBonus', //removed - logic in internal not yet done
                    'importantInstrumentsRussian',
                    'LasPalmasRussian',
                    'EuroLicenseRussian',
                    'depositInsuranceRussian',
                    'moneyfallContestRussian',
                    'callbackServicesRussian',
                    'affiliate_programRussian',
                    'vpsServicesRussian',
                    'leverageRussian',
                    'mt5Russian',
                    // 'rpj_racing_cooperation',
                    'web_terminalRussian',
                    'mobile_platform_russian',
                    'awardsRussian'
                    );
            }else{
                $periodicSequence = array(
                    'HowToGetStarted',
                    'ThirtyPercentBonus',
        //            'HundredPercentBonus', //removed - logic in internal not yet done
                    'importantInstruments',
                    'LasPalmas',
                    'EuroLicense',
                    'depositInsurance',
                    'moneyfallContest',
                    'callbackServices',
                    'affiliate_program',
                    'vpsServices',
                    'leverage',
                    'mt5',
                    // 'rpj_racing_cooperation',
                    'web_terminal',
                    'mobile_platform_periodic',
                    'awards'
                    );
            }
            

            $insert = array(
                'Email' => $email,
                'Fullname' => ucwords(strtolower($name)),
                'recipient_type'=> 1,
                'unsubscribekey' => FXPP::generateUnsubscribeKeyForTradeOffer()
            );
            $recipientId = $CI->Mailer_model->insert_dynamic('mailer_test_recipients',$insert);
    //        $recipientId = 72941;
            if(!$recipientId){
                return;
            }
        }

        //insert new recipient mailer_test_recipients


        $dateToday = date('Y-m-d H:i:s');

        //yahoo mail detector
        $parts = explode("@", $email);
        $username = $parts[1];
        $domain = explode(".", $parts[1]);

        if ($domain[0] == 'yahoo' or $domain[0] == 'ymail' or  $domain[0] == 'rocketmail') {
            $yahoomail = true;
        }
        foreach($periodicSequence as $key => $method){

            // $getMailerByRecipientId = $CI->Mailer_model->getMailerByRecipientId($method, $recipientId);
            // if(!$getMailerByRecipientId){
                $day = $key + 1;
                $dateTomorrow = date('Y-m-d H:i:s', strtotime($dateToday.' +'.$day.' day'));

                $unsubscribeKey = FXPP::generateUnsubscribeKey();
                $insert = array(
                    'RecipientId' => $recipientId,
                    'MethodName' => $method,
                    'DateRegistered' => $dateToday,
                    'DateAvailable' => $dateTomorrow,
                    'Unsubscribe_key'   => $unsubscribeKey
                );
                if($yahoomail == true){
                    $insert['Counter'] = 1;
                }
                if(FXPP::html_url() == 'ru'){
                    $insert['Lang'] = 'Ru';
                }

                $CI->Mailer_model->insert_dynamic('mailer_periodic',$insert);
            //}
        }

    }

    public static function getCurrencyRate($amount, $from_currency, $to_currency){

        $webservice_config = array(
            'server' => 'converter'
        );

        $WebServiceA = new WebService($webservice_config);
        $convertDetails = array(
            'Amount' => $amount,
            'FromCurrency' => $from_currency,
            'ServiceLogin' => 505641,
            'ServicePassword' => '5fX#p8D^c89bQ',
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

    public static function insert_ndblogs($argument){
        self::CI()->load->model('General_model');
        self::CI()->g_m=self::CI()->General_model;
        $data['insert_ndblogs']=array(
            'admin_user_id'=>$argument['admin_user_id'],
            'user_id'=>$argument['user_id'],
            'date_api'=>FXPP::getServerTime(),
            'account_number'=>$argument['account_number'],
            'amount'=>$argument['amount'],
            'location'=>$argument['location'],
        );
        self::CI()->g_m->insertmy($table='ndb_logs',$data=$data['insert_ndblogs']);
    }

    public static function createPeriodicMailerPartner($to, $name,$country){
        $email = trim($to);
        $CI =& get_instance();
        $CI->load->model('Mailer_model');
        $getRecipientDetails = $CI->Mailer_model->getRecipientDetails($email);
        // $getEmailFromUser = self::CI()->g_m->show_all_join($email);
        // return $getRecipientDetails;
//        $getRecipientDetails = false;
        if($getRecipientDetails){
            if(!$getRecipientDetails[0]['Fullname']){
                
               $getEmailFromUser = self::CI()->g_m->show_all_join($email);

                if(!$getEmailFromUser){
                    return;
                }
                foreach ($getEmailFromUser as $key => $value) {
                    if($value['full_name']){
                        $full_name = $value['full_name'];
                        break;
                    }
                }

                if(!$full_name){
                    $full_name = $name;
                }
                
                $data = array(
                        'Fullname' => $full_name
                    );
                
                self::CI()->g_m->updatemy($table='mailer_test_recipients','id',$getRecipientDetails[0]['Id'],$data);
                //return $getRecipientDetails[0]['Id'];

            }

            $recipientId = $getRecipientDetails[0]['Id'];
            //print_r($getRecipientDetails[0]['Id']);
            //exit;
            $getMailer = $CI->Mailer_model->getPeriodicMailerLimit1($getRecipientDetails[0]['Id'],0);
            // print_r($getMailer);
            // exit;
            if($getMailer){
                $getMailerPartner = $CI->Mailer_model->getPeriodicMailerLimit1($getRecipientDetails[0]['Id'],1);
                if(!$getMailerPartner){
                    if(FXPP::html_url() == 'ru'){
                        $periodicSequence = array(
                            'partnerWelcomeRussian',
                            'partnerGettingStartedRussian',
                            //'partnerLasPalmasRussian',
                            'partnerBannerRussian',
                            //'partnerRJPRussian',
                            'partnerBenenfitsForClientRussian',
                            //'partnerCallBackRussian',
                            'partnerHKMRussian'
                        );
                    }else{
                        $periodicSequence = array(
                            'partnerWelcome',
                            'partnerGettingStarted',
                            //'partnerLasPalmas',
                            'partnerBanner',
                            //'partnerRJP',
                            'partnerBenenfitsForClient',
                            //'partnerCallBack',
                            'partnerHKM'
                        );
                    }
                }
            }else{
                $getMailerPartner = $CI->Mailer_model->getPeriodicMailerLimit1($getRecipientDetails[0]['Id'],1);
                if(!$getMailerPartner){
                    if(FXPP::html_url() == 'ru'){
                        $periodicSequence = array(
                            'partnerWelcomeRussian',
                            'partnerGettingStartedRussian',
                            'partnerLasPalmasRussian',
                            'partnerBannerRussian',
                            // 'partnerRJPRussian',
                            'partnerBenenfitsForClientRussian',
                            'PartnerEuroLicenseRussian',
                            'partnerCallBackRussian',
                            'partnerHKMRussian'
                        );
                    }else{
                        $periodicSequence = array(
                            'partnerWelcome',
                            'partnerGettingStarted',
                            'partnerLasPalmas',
                            'partnerBanner',
                            // 'partnerRJP',
                            'partnerBenenfitsForClient',
                            'PartnerEuroLicense',
                            'partnerCallBack',
                            'partnerHKM'                    
                        );
                    }
                }
            }
        }else{
            if(FXPP::html_url() == 'ru'){
                $periodicSequence = array(
                    'partnerWelcomeRussian',
                    'partnerGettingStartedRussian',
                    'partnerLasPalmasRussian',
                    'partnerBannerRussian',
                    // 'partnerRJPRussian',
                    'partnerBenenfitsForClientRussian',
                    'PartnerEuroLicenseRussian',
                    'partnerCallBackRussian',
                    'partnerHKMRussian'
                );
            }else{
                $periodicSequence = array(
                    'partnerWelcome',
                    'partnerGettingStarted',
                    'partnerLasPalmas',
                    'partnerBanner',
                    // 'partnerRJP',
                    'partnerBenenfitsForClient',
                    'PartnerEuroLicense',
                    'partnerCallBack',
                    'partnerHKM'                    
                );
            }        


        //insert new recipient mailer_test_recipients
            $insert = array(
                'Email' => $email,
                'Fullname' => $name,
                'unsubscribekey' => FXPP::generateUnsubscribeKeyForTradeOffer()
            );
            $recipientId = $CI->Mailer_model->insert_dynamic('mailer_test_recipients',$insert);
    //        $recipientId = 72941;
            if(!$recipientId){
                return;
            }
        }

        $dateToday = date('Y-m-d H:i:s');

        foreach($periodicSequence as $key => $method){

            // $getMailerByRecipientId = $CI->Mailer_model->getMailerByRecipientId($method, $recipientId);
            // if(!$getMailerByRecipientId){
                $day = $key + 1;
                $dateTomorrow = date('Y-m-d H:i:s', strtotime($dateToday.' +'.$day.' day'));

                $insert = array(
                    'RecipientId' => $recipientId,
                    'MethodName' => $method,
                    'DateRegistered' => $dateToday,
                    'DateAvailable' => $dateTomorrow,
                    'Unsubscribe_key'   => FXPP::generateUnsubscribeKey(),
                    'Tag' => 1
                );
                if(FXPP::html_url() == 'ru'){
                    $insert['Lang'] = 'Ru';
                }
                $CI->load->model('Mailer_model');
                $CI->Mailer_model->insert_dynamic('mailer_periodic',$insert);
            // }
        }
    }

    public static function createPeriodicMailerPartnerNew($to, $name,$country){
        $email = trim($to);
        $CI =& get_instance();
        $CI->load->model('Mailer_model');
        $getRecipientDetails = $CI->Mailer_model->getRecipientDetails($email);
//        $getRecipientDetails = false;
        if($getRecipientDetails){

            $recipientId = $getRecipientDetails[0]['Id'];
            //print_r($getRecipientDetails[0]['Id']);
            //exit;
            $getMailer = $CI->Mailer_model->getPeriodicMailerLimit1($getRecipientDetails[0]['Id'],0);
            // print_r($getMailer);
            // exit;
            if($getMailer){
                $getMailerPartner = $CI->Mailer_model->getPeriodicMailerLimit1($getRecipientDetails[0]['Id'],1);
                if(!$getMailerPartner){
                    if(FXPP::html_url() == 'ru'){
                        $periodicSequence = array(
                            'partnerWelcomeRussian',
                            'partnerGettingStartedRussian',
                            //'partnerLasPalmasRussian',
                            'partnerBannerRussian',
                            //'partnerRJPRussian',
                            'partnerBenenfitsForClientRussian',
                            //'partnerCallBackRussian',
                            'partnerHKMRussian'
                        );
                    }else{
                        $periodicSequence = array(
                            'partnerWelcome',
                            'partnerGettingStarted',
                            //'partnerLasPalmas',
                            'partnerBanner',
                            //'partnerRJP',
                            'partnerBenenfitsForClient',
                            //'partnerCallBack',
                            'partnerHKM'
                        );
                    }
                }
            }else{
                $getMailerPartner = $CI->Mailer_model->getPeriodicMailerLimit1($getRecipientDetails[0]['Id'],1);
                if(!$getMailerPartner){
                    if(FXPP::html_url() == 'ru'){
                        $periodicSequence = array(
                            'partnerWelcomeRussian',
                            'partnerGettingStartedRussian',
                            'partnerLasPalmasRussian',
                            'partnerBannerRussian',
                            'partnerRJPRussian',
                            'partnerBenenfitsForClientRussian',
                            'PartnerEuroLicenseRussian',
                            'partnerCallBackRussian',
                            'partnerHKMRussian'
                        );
                    }else{
                        $periodicSequence = array(
                            'partnerWelcome',
                            'partnerGettingStarted',
                            'partnerLasPalmas',
                            'partnerBanner',
                            'partnerRJP',
                            'partnerBenenfitsForClient',
                            'PartnerEuroLicense',
                            'partnerCallBack',
                            'partnerHKM'                    
                        );
                    }
                }
            }
        }else{
            if(FXPP::html_url() == 'ru'){
                $periodicSequence = array(
                    'partnerWelcomeRussian',
                    'partnerGettingStartedRussian',
                    'partnerLasPalmasRussian',
                    'partnerBannerRussian',
                    'partnerRJPRussian',
                    'partnerBenenfitsForClientRussian',
                    'PartnerEuroLicenseRussian',
                    'partnerCallBackRussian',
                    'partnerHKMRussian'
                );
            }else{
                $periodicSequence = array(
                    'partnerWelcome',
                    'partnerGettingStarted',
                    'partnerLasPalmas',
                    'partnerBanner',
                    'partnerRJP',
                    'partnerBenenfitsForClient',
                    'PartnerEuroLicense',
                    'partnerCallBack',
                    'partnerHKM'                    
                );
            }        


        //insert new recipient mailer_test_recipients
            $insert = array(
                'Email' => $email,
                'Fullname' => $name,
                'unsubscribekey' => FXPP::generateUnsubscribeKeyForTradeOffer()
            );
            $recipientId = $CI->Mailer_model->insert_dynamic('mailer_test_recipients',$insert);
    //        $recipientId = 72941;
            if(!$recipientId){
                return;
            }
        }

        $dateToday = date('Y-m-d H:i:s');

        foreach($periodicSequence as $key => $method){

            // $getMailerByRecipientId = $CI->Mailer_model->getMailerByRecipientId($method, $recipientId);
            // if(!$getMailerByRecipientId){
                $day = $key + 1;
                $dateTomorrow = date('Y-m-d H:i:s', strtotime($dateToday.' +'.$day.' day'));

                $insert = array(
                    'RecipientId' => $recipientId,
                    'MethodName' => $method,
                    'DateRegistered' => $dateToday,
                    'DateAvailable' => $dateTomorrow,
                    'Unsubscribe_key'   => FXPP::generateUnsubscribeKey(),
                    'Tag' => 1
                );
                $CI->load->model('Mailer_model');
                $CI->Mailer_model->insert_dynamic('mailer_periodic',$insert);
            // }
        }
    }
    public static function activate_trading_API($userid,$account_number){


        self::CI()->load->model('General_model');
        self::CI()->g_m=self::CI()->General_model;


        $webservice_config = array(
            'server' => 'live_new'
        );

        $WebServiceTrading = new WebService($webservice_config);

        $account_info = array(
            'AccountNumber' => $account_number
        );

        $WebServiceTrading->open_ActivateAccountTrading($account_info);

        if( $WebServiceTrading->request_status === 'RET_OK' ) {
            self::CI()->g_m->updatemy($table = "mt_accounts_set", "user_id", $userid, array('open_trading' => 1));

            return true;
        }else{

            return false;
        }

    }



    public function getLocalTime(){
        $date = date('Y-M-d H:i:s',strtotime('now'));
        return $date;
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
    public static function  week_difference($date1, $date2){
        /*week difference*/
        $first = DateTime::createFromFormat('m/d/Y', $date1);
        $second = DateTime::createFromFormat('m/d/Y', $date2);
        return floor($first->diff($second)->days/7);
    }

    public static function isAllowedCashBack(){
        $CI =& get_instance();
        $spacial_ref_code = array(
            'dep30','JSMUI','HEVGG','JYUOR','KTVDM','YFURM','MJLHV','VYPHE','ZAGJU','KMSdep30','s_hol_zar','s_hol_ter','s_hol_akc','s_hol_par',
            's_tep_for','s_hol_opt','p_bezdep','p_bons','p_hol_zar','p_hol_ter','p_hol_opt','SEZPP','CJVMD','SJFTQ','VTJZV','MIRXG','EBLRV',
            'HOEIZ','WMBZP','ODAZE','SSEOT','NKKLH','YQNKI','JLGNR','IHXBM'
        );
        $affiliate_code = $CI->input->cookie('forexmart_affiliate');


        if(($CI->input->cookie('forexmart_affiliate')=='' || in_array($affiliate_code,$spacial_ref_code) )){
            return true;
        }
        return false;
    }
}