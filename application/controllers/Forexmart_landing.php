<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forexmart_landing extends MY_Controller {

    private $country_code;

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->country_code = FXPP::getUserCountryCode() or null;
    }

    public function index()    
{
       $illicit_country = unserialize(ILLICIT_COUNTRIES);

        $data['allowed_country'] = true;
//        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
//            $data['allowed_country'] = false;
//        }
        
        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['country_code'] = $this->country_code;
        $this->lang->load('forexmart_landing');
        $this->load->view('landing_page/external_landing',$data); 
    
} 
    
    
    public function index1(){

        $illicit_country = unserialize(ILLICIT_COUNTRIES);
//
//        $data['allowed_country'] = true;
//        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
//            $data['allowed_country'] = false;
//        }
        
        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['country_code'] = $this->country_code;
        $this->lang->load('forexmart_landing');
        $this->load->view('external_dev_landing',$data);
        // $this->load->view('external_dev_landing_new',$data);

    }

    
//    public function test_index(){
//        $illicit_country = unserialize(ILLICIT_COUNTRIES);
//        $data['allowed_country'] = true;
//        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
//            $data['allowed_country'] = false;
//        }
//        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
//        $data['country_code'] = $this->country_code;
//        $this->lang->load('forexmart_landing');
//        $this->load->view('external_dev_landing_new',$data);
//
//    }
    
    
    public function d_t(){
        $this->lang->load('forexmart_landing');
        $illicit_country = unserialize(ILLICIT_COUNTRIES);
        $data['allowed_country'] = true;
        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
            $data['allowed_country'] = false;
        }
        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['country_code'] = $this->country_code;

        $data['error']=false;

        if(isset($_POST['register1'])){

            $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email|callback_check_email');
            $this->form_validation->set_rules('phonenumber1', 'Phone Number', 'required|trim|xss_clean|callback_checkphone');
            $this->form_validation->set_rules('condition', 'Agree with conditions', 'required');
            echo $this->form_validation->set_value('phonenumber1');
            echo $this->general_model->getCallingCode($this->country_code);
            if($this->form_validation->run() &&  Form_key::isValid(trim($this->input->post('form_key',true))) ){

                $email = $this->form_validation->set_value('email');
                $full_name = $this->form_validation->set_value('full_name');
                $phonenumber = $this->form_validation->set_value('phonenumber1');
                    $email = $this->test_input($email);
                    $full_name = $this->test_input($full_name);
                    $phonenumber = $this->test_input($phonenumber);

                    $data['data']['code'] = $this->GetCodevalidate(20);

                    // Affiliate Code
                    $forexmart_affiliate = $this->input->cookie('forexmart_affiliate');
                    $affiliateCode = empty($forexmart_affiliate) ? '' : $forexmart_affiliate;

                    $affiliate_referral_codes = $this->input->cookie('forexmart_affiliate_logs');

                    $data['insert'] = array(
                        'users_Id' => 0,
                        'Fullname' => $full_name,
                        'Email' => $email,
                        'Code' => $data['data']['code'],
                        'Activation' => 0,
                        'Affiliate_code' => $affiliateCode,
                        'Affiliate_code_logs' => $affiliate_referral_codes,
                        'phone_number'=>$phonenumber

                    );
                    $data['return_insert'] = $this->g_m->insertmy($table = "forexmart_landing", $data['insert']);
                    $data['insert'] = array(
                        'Title' => 'Confirm your email address',
                        'Fullname' =>$full_name,
                        'Code' => $data['data']['code'],
                        'Email' => $email
                    );
					 
					
                    Fx_mailer::Forexmart_Landing_RCode($data['insert']);
                    $_SESSION['landing_email']=$email;
                    $_SESSION['insert_id']=$data['return_insert'];

                    redirect(FXPP::loc_url('forexmart-landing/thanks'));
            }else{
                $data['error']=true;
            }
        }else if(isset($_POST['register2'])){
            $this->form_validation->set_rules('full_namef', 'Full name', 'trim|required|xss_clean|callback_character_fullname');
            $this->form_validation->set_rules('emailf', 'Email', 'trim|required|valid_email|xss_clean|callback_character_email|callback_check_email');
            $this->form_validation->set_rules('phonenumber2', 'Phone Number', 'required|trim|xss_clean|callback_checkphone');
            $this->form_validation->set_rules('condition', 'Agree with conditions', 'required');
            if($this->form_validation->run() &&  Form_key::isValid(trim($this->input->post('form_key',true))) ){
                $email = $this->form_validation->set_value('email');
                $full_name = $this->form_validation->set_value('full_name');
                $phonenumber = $this->form_validation->set_value('phonenumber2');
                $email = $this->test_input($email);
                $full_name = $this->test_input($full_name);
                $phonenumber = $this->test_input($phonenumber);

                    $data['data']['code'] = $this->GetCodevalidate(20);

                    // Affiliate Code
                    $forexmart_affiliate = $this->input->cookie('forexmart_affiliate');
                    $affiliateCode = empty($forexmart_affiliate) ? '' : $forexmart_affiliate;

                    $affiliate_referral_codes = $this->input->cookie('forexmart_affiliate_logs');

                    $data['insert'] = array(
                        'users_Id' => 0,
                        'Fullname' => $full_name,
                        'Email' => $email,
                        'Code' => $data['data']['code'],
                        'Activation' => 0,
                        'Affiliate_code' => $affiliateCode,
                        'Affiliate_code_logs' => $affiliate_referral_codes,
                        'phone_number'=>$phonenumber

                    );
                    $data['return_insert'] = $this->g_m->insertmy($table = "forexmart_landing", $data['insert']);
                    $data['insert'] = array(
                        'Title' => 'Confirm your email address',
                        'Fullname' =>$full_name,
                        'Code' => $data['data']['code'],
                        'Email' => $email
                    );
                    Fx_mailer::Forexmart_Landing_RCode($data['insert']);
                    $_SESSION['landing_email']=$email;
                    $_SESSION['insert_id']=$data['return_insert'];
                    redirect(FXPP::loc_url('forexmart-landing/thanks'));
            }else{
                $data['error']=true;

            }
        }

        switch(FXPP::html_url()){
            case 'en':
            case '':
                $data['flag']='english.png';

                $data['css_style']='style_e.min.css';
                $data['css_main']='main_e.min.css';
                $data['css_component']='component_e.min.css';

               break;
            case 'ru':
                $data['flag']='russian.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';

                break;
            case 'my':
                $data['flag']='malaysia.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
               break;
            case 'id':
                 $data['flag']='indonesian.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                 break;
            case 'de':
                $data['flag']='germany.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
               break;
            case 'fr':
                $data['flag']='france.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                 break;
            case 'jp':
                $data['flag']='japan.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                break;
            case 'sk':
                $data['flag']='slovakia.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                break;
            case 'pt':
                $data['flag']='portugal.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                 break;
            case 'es':
                $data['flag']='spain.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                 break;
            case 'pk':
                $data['flag']='pakistan.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                break;
            case 'pl':
                $data['flag']='poland.png';

                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
                break;
            default:
                $data['flag']='english.png';
                $data['css_style']='style.min.css';
                $data['css_main']='main.css';
                $data['css_component']='component.css';
        }

        $data['form'] = Form_key::InputKey_array();
        $this->load->view('external_landing_dt',$data);

    }
    public function Feedback(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('rating', 'Rating', 'required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('message', 'Comment', 'trim|xss_clean');
                
       
        if($this->form_validation->run()) 
        {                
                
                $mdata = array(
                    'user_id' => ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0,
                    'rating' => $this->input->post('rating',true),
                    'category' => $this->input->post('category',true),
                    'message' => $this->input->post('message',true)
                );
            echo $id=$this->general_model->insert('user_feedback',$mdata);                
                $email=$this->input->post('email',true);
                $mdata['title']='Client Feedback Details.';
                $mdata['belowThansk']='';
                $mdata['name']='';
                $config = array('mailtype' => 'html');
                $this->general_model->sendEmail('feedback', "User Feedback", 'support@forexmart.com', $mdata, $config);            
        } 
        else 
        {
            echo "error";
        }


    }

    public function feadBackEmailStore(){
     
     $fid=$this->input->post('fid',true);
     $email=$this->input->post('email',true);
     $data=array('email'=>$email);
     $this->general_model->update('user_feedback','id',$fid,$data);

    }
    public function checkEmail() {
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $email=$this->input->post('email',true);
        if ($email=='agus@zondertag.net' or $email=='trowabarton00005@gmail.com'){
            echo "empty";
        }else{
            $whereData = array('Email' => $email);
            $result = $this->general_model->getQueryStringRow('forexmart_landing', '*', $whereData);
            //echo $result->Email;
            if(!empty($result)){echo "done";}else{echo "empty";}
        }
    }

    public function thanks(){
        if (isset( $_SESSION['landing_email'])) {
            $this->lang->load('forexmart_landing');
            $this->load->view('external_dev_land',TRUE);
        }else{
            redirect(FXPP::www_url('forexmart-landing'));
        }

    }
    public function thanks2(){
        $_SESSION['landing_email']='programmertests@gmail.com';
        redirect(FXPP::loc_url('forexmart-landing/thanks'));
    }

     public function testdeposit(){
        $this->load->view('deposit');
     }
    public function landing_registration(){
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $this->form_validation->set_rules('phone', 'Phone', 'trim|callback_character_check');
//        $phone = $this->form_validation->set_value('phone');
//        $phone = $this->test_input($phone);
        $data['update']=array(
            'phone_number'=>$this->input->post('phone',true),
        );
       $data['return_insert'] = $this->g_m->updatemy($table = "forexmart_landing",$field='id',$id= $_SESSION['insert_id'],$data['update']);
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public  function character_check($str){
        if(preg_match('/[^a-zA-Z 0123456789 аБбвГгДдЕеЁёЖжЗзИиЙйКкЛлмнПптУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя !"#$%&()*+,\ :;?{}~@`
ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥ƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ.-_\-\_]/i', $str)){
            $this->form_validation->set_message( 'character_check', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2') );
            return FALSE;
        }else{
            return TRUE;
        }

    }
    public  function character_fullname($str){

        if(preg_match('/[^a-zA-Z 0123456789 аБбвГгДдЕеЁёЖжЗзИиЙйКкЛлмнПптУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя !"#$%&()*+,\ :;?{}~@`
ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥ƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ.-_\-\_]/i', $str)){
            $this->form_validation->set_message( 'character_fullname', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2')  );
            return FALSE;
        }else{
            return TRUE;
        }


    }

    public  function character_email($str){

        if(preg_match('/[^a-zA-Z 0123456789 аБбвГгДдЕеЁёЖжЗзИиЙйКкЛлмнПптУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя !"#$%&()*+,\ :;?{}~@`
ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥ƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ.-_\-\_]/i', $str)){
            $this->form_validation->set_message( 'character_email', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2') );
            return FALSE;
        }else{
            return TRUE;
        }


    }
    public  function checkphone($phone){
        $illicit_country = unserialize(ILLICIT_COUNTRIES);
        $data['allowed_country'] = true;
        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
            $data['allowed_country'] = false;
        }
        $data['calling_code'] = "+".$this->general_model->getCallingCode($this->country_code);
        if ($phone == $data['calling_code']){
            $this->form_validation->set_message('checkphone', 'Please enter your mobile number.');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public  function check_email($email)
    {
        if ($email == 'agus@zondertag.net' or $email=='trowabarton00005@gmail.com') {
            return TRUE;
        } else {
            $whereData = array('Email' => $email);
            $result = $this->general_model->getQueryStringRow('forexmart_landing', '*', $whereData);
            if (!empty($result)) {
                $this->form_validation->set_message('check_email', ' %s ' . ' already exist.');
                return FALSE;
            }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('check_email', ' %s ' . lang('fxLan_Error_3'));
                return FALSE;
            } else {
                return TRUE;
            }
        }


    }
    private function GetCodevalidate($length) {
        $loopcode = true;
        do {
            $key = '';
            $keys = array_merge(range(0, 9));

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }

            $loopcode = $this->g_m->showlike2($table = 'forexmart_landing', $field = 'Code', $id = $key, $select = "Code");
        } while ($loopcode == true);

        return $key;
    }
}