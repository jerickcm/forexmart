<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 6/21/16
 * Time: 9:05 AM
 */

class Leverage extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->lang->load('FinancialInstruments');
        $this->lang->load('Leverage');
    }
    public function index(){
      //  if(!IPLoc::Office()){ redirect('');}


        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean|callback_character_check');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean|callback_character_check');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run()) {

            $user_data = array(
                'email_live' => $this->input->post('email',true),
                'full_name_live' => $this->input->post('full_name',true)
            );
            $this->session->set_userdata($user_data);
            redirect(FXPP::loc_url('register/index/step2'));
        }

        $data['data']['metadata_description'] = lang('da_dsc');
        $data['data']['metadata_keyword'] = lang('da_kew');
        $this->template->title( lang('da_tit'))
            ->prepend_metadata("
  <script src='" . $this->template->Js() . "/jquery.validate.min.js'></script>
                            ")
            ->set_layout('external/main')
            ->build('external_leverage', $data['data']);
    }

    public  function character_check($str){
        if(preg_match(Cyrillic::register_page(), $str)){
            $this->form_validation->set_message( 'character_check', 'The characters you have entered in the %s field are not yet supported. You can only enter English and Russian characters.' );
            return FALSE;
        }else{
            return TRUE;
        }
    }
}