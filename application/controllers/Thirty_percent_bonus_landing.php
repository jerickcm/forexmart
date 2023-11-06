<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Thirty_percent_bonus_landing extends MY_Controller {

    private $country_code;

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->country_code = FXPP::getUserCountryCode() or null;
    }


    public function index(){
//        $illicit_country = "";// unserialize(ILLICIT_COUNTRIES);
//        $data['allowed_country'] = true;
//        if(in_array(strtoupper(trim($this->country_code)), $illicit_country)){
//            $data['allowed_country'] = false;
//        }

        $data['baseLink']=  base_url('assets/thirty_percent_bonus_landing')."/";
        $this->lang->load('thery_percent_bounus_landing');
        $data['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        $data['country_code'] = $this->country_code;



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
            case 'es':
                $data['flag']='spain.png';
                break;
            case 'bg':
                $data['flag']='bulgaria.png';
                break;
            case 'pk':
                $data['flag']='pakistan.png';
                break;
            case 'pl':
                $data['flag']='poland.png';
                break;
            default:
                $data['flag']='english.png';
        }

        $this->load->view('External_thirty_percent_bonus_landing',$data);

    }

    public function checkEmail() {
        if (!$this->input->is_ajax_request()) {die('Not authorized!');}
        $email=$this->input->post('email');
        if ($email=='agus@zondertag.net' or $email=='trowabarton00005@gmail.com' or $email=='2015august5@gmail.com' or $email=='forexmart132@gmail.com'){
            echo "empty";
        }else{
            $whereData = array('Email' => $email,'type'=>'TBL');
            $result = $this->general_model->getQueryStringRow('forexmart_landing', '*', $whereData);
            //echo $result->Email;
            if(!empty($result)){echo "done";}else{echo "empty";}
        }
    }

    public function thanks(){
        if (isset( $_SESSION['landing_email'])) {
            $this->lang->load('forexmart_landing');
            $this->load->view('external_landing_mail_mgs',TRUE);
        }else{
            redirect(FXPP::www_url('thirty-percent-bonus-landing'));
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
                'rating' => $this->input->post('rating'),
                'category' => $this->input->post('category'),
                'message' => $this->input->post('message'),
                'type'=>'TBL'
            );
            echo $id=$this->general_model->insert('user_feedback',$mdata);
            $email=$this->input->post('email');
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

        $fid=$this->input->post('fid');
        $email=$this->input->post('email');
        $data=array('email'=>$email);
        $this->general_model->update('user_feedback','id',$fid,$data);

    }


}