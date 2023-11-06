<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Limited_bonus extends MY_Controller {

    private $country_code;

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        // $this->country_code = FXPP::getUserCountryCode() or null;
    }

    public function index(){

    $this->lang->load('limitedbonus');
        // $illicit_country = unserialize(ILLICIT_COUNTRIES);
        // $data['allowed_country'] = true;
        // if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
        //     $data['allowed_country'] = false;
        // }
        $data['countDown']= $this->setCounterCookie();
        // $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        // $data['country_code'] = $this->country_code;


        if($this->session->userdata('logged')){
            $data['flb_user']=$this->session->userdata('full_name');
        }else{
            $data['flb_user']=lang('login');
        }


        switch(FXPP::html_url()){
            case 'en':
            case '':
                $data['flag']='english.png';
                $data['tracon']='forexmart-limited-bonus.pdf';
                break;
            case 'ru':
                $data['flag']='russia.png';
                $data['tracon']='forexmart-limited-bonus-ru.pdf';
                break;
            default:
                $data['flag']='english.png';
                $data['tracon']='forexmart-limited-bonus.pdf';
        }

        $this->load->view('external_forexmart_limited_bonus',$data);


    }

  
    
       

    public function setCounterCookie()
    {

        
        $unlimitedcookie = get_cookie('unlimitedcookie');  
        if($unlimitedcookie=="" or $unlimitedcookie==null )
        {
            
             setcookie(
               "unlimitedcookie",
               round(microtime(true) * 1000).'_'.uniqid(),
               time() + (10 * 365 * 24 * 60 * 60)
               
             ); 
            
        }
     

       

                $current_time = strtotime(date('Y-m-d  H:i'));
                $intertime=60*60*24*2;//60*1*2;//60*60*24*2;
                $cookieData = get_cookie('countdown');  
                $countdownCookie=false; 
                if($cookieData=="" or $cookieData==null) 
                {  
                     $limitResult=$this->pageVisitor();
                         if($limitResult==true) 
                         {
                           set_cookie('countdown',$current_time,$intertime); 
                           $countdownCookie=true;
                         }
                }

               $cookieData=intval($cookieData);
               $current_time=intval($current_time);

                $expaneTime=$current_time-$cookieData;

              if($cookieData==0 or $cookieData=="")
                  {    
                                   
                         if($countdownCookie==false) 
                         {
                             return 0;
                         }
                         else
                         {
                         return $intertime;
                         }

                  }
                  else
                  {


                        $newTime=$intertime-$expaneTime;

                        if ($newTime < 0) {
                             return 0;
                        }else{
                             return $newTime;
                        }

                  }
      
            
      
      
     //   echo "current:".$current_time." log Time:".$cookieData." maintime:".$intertime." expanetime".$expaneTime." finallaodtime:".$newTime;exit;
        
    }
    
    public function pageVisitor() {
            
        $data=array(
            'ip'=>$this->input->ip_address(),
            'user_id'=>$this->session->userdata('user_id'),
            'session_id'=>session_id(),
            'date'=>date('Y-m-d H:i:s'),
            'visit_time'=>strtotime(date('Y-m-d  H:i')),
            'visit_page'=>current_url(),
            'notification_count'=>0,
            'comments'=>'',
            'status'=>1,
            'cookie_id'=>'countdown',
            'browser'=>$this->agent->browser(),//$_SERVER['HTTP_USER_AGENT'],
            'mac_address'=>get_cookie('unlimitedcookie')
        );
                
        $whereData=array('visit_page'=>$data['visit_page'],'cookie_id'=>$data['cookie_id'],'ip'=>$data['ip'],'mac_address'=>$data['mac_address']);        
        $result=$this->general_model->getQueryStringRow('page_visitor','*',$whereData,'id','DESC','1');                        
        if(empty($result) and $data['mac_address']!="")
        {
         $this->general_model->insert('page_visitor',$data);          
         return true;
        }
        else
        {
            return false;
        }
                
        
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
            echo $id=$this->general_model->insert('user_feedback_limited',$mdata);
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
        $this->general_model->update('user_feedback_limited','id',$fid,$data);

    }

    public function d_t(){

        $this->lang->load('limitedbonus');
        $illicit_country = unserialize(ILLICIT_COUNTRIES);
        $data['allowed_country'] = true;
        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
            $data['allowed_country'] = false;
        }
        $data['countDown']=$this->setCounterCookie();
        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['country_code'] = $this->country_code;

        if($this->session->userdata('logged')){
            $data['flb_user']=$this->session->userdata('full_name');
        }else{
            $data['flb_user']=lang('flb_02');
        }

        switch(FXPP::html_url()){
            case 'en':
            case '':
                $data['flag']='english.png';
                break;
            case 'ru':
                $data['flag']='russia.png';
                break;
            case 'my':
                $data['flag']='malaysia.png';
                break;
            case 'id':
                $data['flag']='indonesia.png';
                break;
            case 'de':
                $data['flag']='germany.png';
                break;
            case 'fr':
                $data['flag']='france.png';
                break;
            case 'jp':
                $data['flag']='japan.png';
                break;
            case 'sk':
                $data['flag']='slovakia.png';
                break;
            case 'pt':
                $data['flag']='portugal.png';
                break;
            default:
                $data['flag']='english.png';
        }

        $this->load->view('external_forexmart_limited_bonus_test',$data);

    }
    public function setCounterCookie2()
    {
        // exit;
        $unlimitedcookie = get_cookie('unlimitedcookie');
        echo 'unlimitedcookie'.' = '.$unlimitedcookie;
        if($unlimitedcookie=="" or $unlimitedcookie==null )
        {
            setcookie(
                "unlimitedcookie",
                round(microtime(true) * 1000).'_'.uniqid(),
                time() + (10 * 365 * 24 * 60 * 60)
            );
        }
        $current_time = strtotime(date('Y-m-d  H:i'));
        $intertime=60*60*24*2;//60*1*2;//60*60*24*2;
        $cookieData = get_cookie('countdown');


        $countdownCookie=false;
        if($cookieData=="" or $cookieData==null)
        {
            $limitResult=$this->pageVisitor();
            if($limitResult==true)
            {
                set_cookie('countdown',$current_time,$intertime);
                $countdownCookie=true;
            }
         }

        $cookieData=intval($cookieData);
        $current_time=intval($current_time);

        $expaneTime=$current_time-$cookieData;
        echo $current_time;
        echo "<br>";
        echo $intertime;
        echo "<br>";
        echo '$cookieData = '.$cookieData;
        echo "<br>";
        echo $expaneTime;
        echo "<br>";
        if($cookieData==0 or $cookieData=="")
        {
            if($countdownCookie==false)
            {
                return 0;
            }
            else
            {
                echo $intertime;
            }
        }
        else
        {
             $newTime = $intertime - $expaneTime;
            echo $newTime .''.'='.$intertime.''.'-'.$expaneTime;
        }
    }

}



