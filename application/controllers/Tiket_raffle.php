<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket_raffle extends MY_Controller
{
    private $js;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fx_mailer');
        $this->load->library('tank_auth');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->js    = $this->template->Js();

    }

    public function index(){

        if(!IPLoc::Office()){
            redirect('/');
        }

        $this->lang->load('ticketraffle');
        $errors = array();
        $showModalOnLoad = false;

        $login_by_username = ($this->config->item('login_by_username', 'tank_auth') AND $this->config->item('use_username', 'tank_auth'));
        $login_by_email = $this->config->item('login_by_email', 'tank_auth');

        $this->form_validation->set_rules('username', 'Log in', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $checkUserExist = $this->tank_auth->checkUserExist( $this->form_validation->set_value('username'), $this->form_validation->set_value('password'), $this->form_validation->set_value('remember'), $login_by_username, $login_by_email);
            if ($checkUserExist['isUser']) {

//                $insData = array(
//                    'user_id' => $checkUserExist['user_id']
//                );
                $id = $this->account_model->insertTicketRaffle($checkUserExist['user_id']);
                if($id){
                    $getTicketRaffleRecord = $this->account_model->getTicketRaffleRecord($checkUserExist['user_id']);
                    Fx_mailer::ticket_raffle($getTicketRaffleRecord);
                    $this->session->set_flashdata("success", 'ok');
                }else{
                    $this->session->set_flashdata("already-registered", 'ok');
                }

                $showModalOnLoad = true;

            }else{
                $showModalOnLoad = true;
                $errors = $this->tank_auth->get_error_message();
            }

        }

        if(validation_errors()){
            $showModalOnLoad = true;
        }

        $data = array(
            'errors' => $errors
        );

        $addJS = "<script>".
                "var showModal = '$showModalOnLoad';".
                "</script>";
        $data['metadata_description'] = lang('x_tr_dsc');
        $data['metadata_keyword'] = lang('x_tr_kew');
        $this->template->title(lang('x_tr_tit'))
            ->set_layout('external/main')
            ->prepend_metadata($addJS)
            ->build('ticket_raffle', $data);

            
    }

//    public function test(){
//        $getTicketRaffleRecord = $this->account_model->getTicketRaffleRecord(10211);
//        var_dump($getTicketRaffleRecord);
//        Fx_mailer::ticket_raffle($getTicketRaffleRecord);
//    }

}