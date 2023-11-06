<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
    public function __construct(){

        parent::__construct();
        $this->load->model('tank_auth/users');
        if(!IPLoc::Office()){redirect('');}
    }
    public function index(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
        $username = $this->input->post('username',true);
            if($result= $this->general_model->where('manage_access',array('email'=>$username,'type'=>3,'admin'=>3))){
                $row = $result->row();
                $new_password_key = array(
                    'id'=> $row->user_id,
                    'new_password_key'=>uniqid()
                );
                if($this->general_model->updatemy('users','id',$row->user_id,$new_password_key)){
                      if( $user = $this->general_model->where('user_profiles',array('user_id'=>$row->user_id))){
                          $user_info = array(
                              'full_name'=>$user->row()->full_name,
                              'email'=>$username,
                              'new_password_key'=>$new_password_key['new_password_key'],
                              'header' => 'ForexMart MWP Password reset',
                              'title' => 'You have requested to reset your password for ForexMart MWP Admin Panel.'
                          );
                          $config = array('mailtype' => 'html');
                          $this->general_model->sendEmail('reset_password', "ForexMart MWP Password reset", $username, $user_info, $config);
                          $data['msg'] = "Password reset link sent to your email. Please check your email.";
                      }
                }
            }
            else{
                $data['errorSms'] = 'Incorrect Email ! Please provide correct email.';
            }
        }
        $data['check'] = "";
        $css = $this->template->Css();
        $data['class_def'] = 'default-forgot-pass-background';
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                        <link rel='stylesheet' href='".$css."/signin.min.css'>
                ")
            ->append_metadata_js(" ")
            ->set_layout('clear/v2_main')
            ->build('forgot_password/v2_forgot_password',$data);
    }

    public function reset_password(){

        $key = $this->input->get('key',true);
        if( $user = $this->general_model->where('users',array('new_password_key'=>$key))){


         $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean', array('required' => '<i>*Password field is required</i>'));
         $this->form_validation->set_rules('re_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]', array('required' => '<i>*Confirm Password field is required</i>', 'matches' => '<i>*Password does not match</i>'));
        if ($this->form_validation->run()) {

            $password = $this->input->post('password',true);

            $this->load->model('tank_auth/Users');

            // Hash password using phpass
            $hasher = new PasswordHash(
                $this->config->item('phpass_hash_strength', 'tank_auth'),
                $this->config->item('phpass_hash_portable', 'tank_auth'));
            $hashed_password = $hasher->HashPassword($password);

            $this->users->reset_passwordNokey($user->row()->id, $hashed_password, $expire_period = 900);
            $this->general_model->updatemy('users','id',$user->row()->id,array('new_password_key'=>''));

            $data['msg'] = "Your password has been reset successfully.";

        }
         $data['username']=$user->row()->email;
        $data['class_def'] = 'default-login-background';
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->set_layout('clear/v2_main')
            ->build('forgot_password/v2_reset_password',$data);
        }else{
            redirect('');
        }
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