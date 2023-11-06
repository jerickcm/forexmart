<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Unsubscribe extends MY_Controller
{
    private $encrypt_key = '#w6ZaY;XEvxFkh}d';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mailer_model');
        $this->lang->load('unsubscribe');

    }

    public function ref($unsubscribeKey){
//        show_404();
        $getDetailsUnsubscribeKey = $this->Mailer_model->getDetailsUnsubscribeKey2($unsubscribeKey);
        if($getDetailsUnsubscribeKey){

            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_is_recipient_exist['.$unsubscribeKey.']|required|xss_clean');

            if ($this->form_validation->run()) {
                $updData = array(
                    'Unsubscribe' => 1
                );
                $updData2 = array(
                    'Active' => 0
                );
                $this->general_model->update('mailer_periodic','Unsubscribe_key',$unsubscribeKey,$updData);
                $this->general_model->update('mailer_test_recipients','Id',$getDetailsUnsubscribeKey['RecipientId'],$updData2);
                $this->session->set_flashdata("success", 'ok');
            }

            $data['unsubscribe_email'] = $getDetailsUnsubscribeKey['Email'];
            $this->template->title("ForexMart | Unsubscribe Email")
                ->set_layout('external/main')
                ->build('unsubscribe',$data);
        }else{
            show_404();
        }
    }

    public function is_recipient_exist($email, $key){
        $getRecipientPeriodic = $this->Mailer_model->getRecipientPeriodic($email, $key);

        if($getRecipientPeriodic){
            return true;
        }else{
            $this->form_validation->set_message('is_recipient_exist', 'Email does not exist.');
            return false;
        }
    }

    public function ref2($unsubscribeKey){
//        show_404();
        $getDetailsUnsubscribeKey = $this->Mailer_model->getDetailsUnsubscribeKey3($unsubscribeKey);
        if($getDetailsUnsubscribeKey){

            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_checkEmail['.$unsubscribeKey.']|required|xss_clean');

            if ($this->form_validation->run()) {
                $updData = array(
                    'Unsubscribe' => 1,
                    'Unsubscribe_date' => date('Y-m-d H:i:s', strtotime('now') )
                );
                $updData2 = array(
                    'Active' => 0
                );
                $this->general_model->update('MassMailer','Unsubscribe_key',$unsubscribeKey,$updData);
                $this->unsubscribeToStaging($unsubscribeKey);
                // $this->general_model->update('mailer_test_recipients','Id',$getDetailsUnsubscribeKey['RecipientId'],$updData2);
                $this->session->set_flashdata("success", 'ok');
            }

            $data['unsubscribe_email'] = $getDetailsUnsubscribeKey['Email'];
            $this->template->title("ForexMart | Unsubscribe Email")
                ->set_layout('external/main')
                ->build('unsubscribe',$data);
        }else{
            show_404();
        }
    }

    public function checkEmail($email, $key){
        $getRecipientPeriodic = $this->Mailer_model->getRecipientPeriodic2($email, $key);

        if($getRecipientPeriodic){
            return true;
        }else{
            $this->form_validation->set_message('checkEmail', lang('unsubs5'));
            return false;
        }
    }

    public function ref3($unsubscribeKey){
//        show_404();
        $this->load->model('Adminmailer_model');
        $getDetailsUnsubscribeKey = $this->Adminmailer_model->getDetailsByKey($unsubscribeKey);
        if($getDetailsUnsubscribeKey){
            $getEmailById = $this->Adminmailer_model->getEmailById($getDetailsUnsubscribeKey['recipient_id']);
            $data['unsubscribe_email'] = $getEmailById['Email'];
            // form
                $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_checkEmailAndKeyForAdminMail['.$unsubscribeKey.']|required|xss_clean');
                    if ($this->form_validation->run()) {
                        $array = array(
                            'Active' => 0
                        );
                        $sameEmails = $this->Adminmailer_model->getAllThisEmail($getEmailById['Email']);
                        foreach ($sameEmails as $key => $value) {
                            $this->Adminmailer_model->updatemy('mailer_recipients','Id',$value['Id'],$array);
                        }
                        $this->session->set_flashdata("success", 'ok');
                    }

            
            $this->template->title("ForexMart | Unsubscribe Email")
                ->set_layout('external/main')
                ->build('unsubscribe',$data);
        }else{
            show_404();
        }
    }

    public function checkEmailAndKeyForAdminMail($email, $key){
        $this->load->model('Adminmailer_model');

        $checkEmailAndKey = $this->Adminmailer_model->checkEmailAndKey($email, $key);

        if($checkEmailAndKey){
            return true;
        }else{
            $this->form_validation->set_message('checkEmail', lang('unsubs5'));
            return false;
        }
    }

    public function ref4($unsubscribeKey){
        $getDetailsUnsubscribeKey = $this->Mailer_model->getDetailsByKey($unsubscribeKey);
        if($getDetailsUnsubscribeKey){
            $getEmailById = $this->Mailer_model->getEmailById($getDetailsUnsubscribeKey['recipient_id']);
            $data['unsubscribe_email'] = $getEmailById['Email'];
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_checkKeyForMailerTestRecipient['.$unsubscribeKey.']|required|xss_clean');
            if ($this->form_validation->run()) {
                $array = array(
                    'Active' => 0
                );
                $this->Mailer_model->unsubcribeThisId($getDetailsUnsubscribeKey['recipient_id']);
                $this->session->set_flashdata("success", 'ok');
            }

            
            $this->template->title("ForexMart | Unsubscribe Email")
                ->set_layout('external/main')
                ->build('unsubscribe',$data);
        }else{
            show_404();
        }
    }



    public function checkKeyForMailerTestRecipient($email, $key){
        $checkEmailAndKey = $this->Mailer_model->checkEmailAndKey($email, $key);

        if($checkEmailAndKey){
            return true;
        }else{
            $this->form_validation->set_message('checkEmail', lang('unsubs5'));
            return false;
        }
    }


    public function unsubscribeToStaging($Unsubscribe_key){
        $ch = curl_init();
        $data = array('Unsubscribe_key'=> $Unsubscribe_key);

        curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/Unsubscribe/unsubscribeThisEmail");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        return $server_output;
    }

    public function subscribeToStaging($Unsubscribe_key){
        $ch = curl_init();
        $data = array('Unsubscribe_key'=> $Unsubscribe_key);

            curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/Unsubscribe/subscribeThisEmail");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close ($ch);
        return $server_output;
    }
/*FXPP-7993*/
    public function activateUnsubscribedEmail(){    
        $this->load->model('Mailer_model');
        foreach ($this->Mailer_model->getUnsubscribeEmailAfter4Months() as $key => $value) {
            $this->Mailer_model->subscribeThisEmail($value['Email']);
            print_r($this->subscribeToStaging( $value['Unsubscribe_key'] ));
        }
    }

}   

