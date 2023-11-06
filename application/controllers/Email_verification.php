<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 6/6/17
 * Time: 1:39 PM
 */

class Email_verification extends MY_Controller {

    function index(){
        $get_id = $this->input->get('id', TRUE);
        if (isset($get_id)) {
            $getCode = '?id=' . $get_id;
        } else {
            $getCode = '';
        }

        $email = $this->session->userdata('email_live_activation');
        if(strlen($email)<1){
            redirect(FXPP::loc_url('register').$getCode);
        }

        $data['data']['msg'] = false;
        $this->form_validation->set_rules('resend_code', 'Activation code', 'required|xss_clean|trim');

        if ($this->form_validation->run()) {

                if( $row = $this->general_model->whereCondition('incomplete_registers',array('email'=>$email,'resend_code'=>$this->input->post('resend_code',true)))){

                    $user_data = array(
                        'email_live' => $row['email'],
                        'full_name_live' => $row['full_name'],
                        'email_live_activation'=> null
                    );

                    $this->session->set_userdata($user_data);


                    redirect(FXPP::loc_url('register/index/step2').$getCode);
                }else{
                    $data['data']['msg'] = "The activation code not matched!";
                }

        }

        $data['data']['email']=$email;
        $data['data']['metadata_description'] = "Verification page";
        $data['data']['metadata_keyword'] = "Verification page";
        $this->template->title("Verification | ForexMart")
            ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'email-verification.css">
                      ')
            ->set_layout('external/main')
            ->build('external_verification_page', $data['data']);
    }


    public function resend_code(){


        $email = $this->session->userdata('email_live_activation');
        if($row_array = $this->general_model->whereCondition('incomplete_registers',array('email'=>$email),'*','id,DESC')){
            $incomplete_registers = array(
                'email' => $row_array['email'],
                'full_name' => $row_array['full_name'],
                'resend_code'=> $row_array['resend_code']
            );
          //  $this->load->library('Fx_mailer');
            if(Fx_mailer::sendVerificationCode($incomplete_registers)){
                echo $row_array['email'];
            }else{

                echo "false";
            }
        }else{

            echo "false";
        }




    }
} 