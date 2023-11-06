<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
    public function __construct(){

        parent::__construct();
        $this->load->model('tank_auth/users');
    }


    public function index(){
//        if(!IPLoc::Locale()){
//            header('Location: https://www.forexmart.com');
//        }
        error_reporting(-1);
        $this->lang->load('tank_auth');
        $this->load->library('Tank_auth');
//        if(IPLoc::Office()){
        if ($this->tank_auth->is_logged_in()) {									// logged in

//            redirect('Accounts');
          //  if($this->session->userdata('user_id')==68418){
                redirect('quick-jump');
//            }else{
//                redirect('open_account');
//            }


        } elseif ($this->tank_auth->is_logged_in(FALSE)) {					// logged in, not activated

            redirect('signin');

        } else {


            $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
                $this->config->item('use_username', 'tank_auth'));
            $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

            $data['errors'] = array();

            // Get login for counting attempts to login
            if ($this->config->item('login_count_attempts', 'tank_auth') AND ($login = $this->input->post('login'))) {
                $login = $this->security->xss_clean($login);
            } else {
                $login = '';
            }

            $this->form_validation->set_rules('username', 'Log in', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');

            if ($this->form_validation->run()) {

                // validation ok

                $eemail=$this->input->post('username');

                $mcdata=array('type'=>3,'admin'=>3,'email'=>$eemail);
                $mangeUserIn=$this->general_model->getDataQueryStringRowDataOrdery('manage_access',$mcdata,'*','ORDER BY id DESC LIMIT 1');
                $user_id= $mangeUserIn[0]->user_id;
                if(!empty($mangeUserIn))
                {
                    if ($this->tank_auth->login(
                        $this->form_validation->set_value('username'),
                        $this->form_validation->set_value('password'),
                        $this->form_validation->set_value('remember'),
                        $data['login_by_username'],
                        $data['login_by_email'],1,$user_id))
                    {					// success

                        $userId= $this->session->userdata('user_id');
                        $result= $this->general_model->showWhere3('manage_access','type',3,'admin',3,'user_id',$userId,'');
                        $checkPermission=$result->result();
                        //   print_r($checkPermission);exit;

                        if(empty($checkPermission[0]->permission))
                        {
                            $this->session->unset_userdata('user_id');
                            $this->session->sess_destroy();
                            $data['data']['notaccess']="You have no access for Admin panel.";

                        }
                        else
                        {
//                            if($this->session->userdata('user_id')==68418){
                                redirect('quick-jump');
//                            }else{
//                                redirect('open_account');
//                            }
                        }

                    }
                    else
                    {
                        $errors = $this->tank_auth->get_error_message();

                        $data['data']['errors']= $errors;


                        if (isset($errors['banned'])) {								// banned user
                            $this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

                        } elseif (isset($errors['not_activated'])) {				// not activated user
                            //redirect('/auth/send_again/');
                            $data['data']['deactivated'] = 'deactivated';
                            //redirect(FXPP::loc_url('economic-news'));
                        } else {													// fail
                            foreach ($errors as $k => $v) {
                                $data['errors'][$k] = $this->lang->line($v);
                            }
                        }
                    }

                }
                else
                {
                    $this->session->unset_userdata('user_id');
                    $this->session->sess_destroy();
                    $data['data']['notaccess']=" Incorrect login.";
                    //    $data['data']['errors']="Sorry ! you are not allowed.";

                }
            }


            $data['data']['username']=  array(
                'name'          => 'username',
                'id'            => 'inputEmail3',
                'value'         => set_value('username', ''),
                'type'          => 'text',
                'class'         => form_error('username')|| isset($errors['username']) ?'uk-input style-form-input red-border': 'uk-input style-form-input' ,
                'placeholder'   => 'Username'
            );

            $data['data']['password']=  array(
                'name'          => 'password',
                'id'            => 'pass',
                'value'         => set_value('password', ''),
                'type'          => 'password',
                'class'         =>  form_error('password')|| isset($errors['password']) ?'uk-input style-form-input red-border': 'uk-input style-form-input' ,
                'placeholder'   => 'Password'
            );

            $data['data']['output_key']= '';
            $css = $this->template->Css();
            $js = $this->template->Js();
            $data['data']['output_key']= '';
            $data['data']['Error'] = true;

//            $this->template->title("Administration | Forexmart")
//                ->append_metadata_css("<link rel='stylesheet' href='".$css."/signin.min.css'>")
//                ->append_metadata_js("")
//                ->set_layout('clear/main')
//                ->build('layouts/clear/external_AdminSignIn',$data['data']);
            $data['class_def'] = 'default-login-background';
            $this->template->title("Administration | Forexmart")
                ->append_metadata_js("")
                ->set_layout('clear/v2_main')
                ->build('layouts/clear/v2_signin',$data['data']);
        }
//    }
}

    public function username_check($str){
        if (!is_null($user = $this->users->get_user_by_login( $this->input->post('username')))) {
            return true;
        }else{
            $this->form_validation->set_message('username_check', 'Incorrect username . Please try again.');
            return FALSE;
        }
    }
    public function password_check($str){
        $this->load->library('Tank_auth');
        if (!is_null($user = $this->users->get_user_by_loginaccount( $this->input->post('username')))) {
            $mydata=array(
                'new'=>$this->input->post('password'),
                'old'=>$user->password
            );
            if(Tank_auth::compare($mydata)){
                $newdata = array(
                    'full_name'  => $user->full_name,
                    'email'     => $user->email,
                    'logged' => 1,
                    'user_id'	=> $user->id,
                    'username'	=> $user->username,
                    'status'	=> ($user->activated == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
                );
                $this->session->set_userdata($newdata);
                redirect('Administration');
                return true;
            }else{
                $this->form_validation->set_message('password_check', 'Incorrect password . Please try again.');
                return FALSE;
            }
        }
    }


}