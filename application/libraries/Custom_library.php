<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Custom_library {

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

    public function CI(){
        $CI =& get_instance();
        return $CI;
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

    public static function generateGUIDForgotPassword(){
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

}