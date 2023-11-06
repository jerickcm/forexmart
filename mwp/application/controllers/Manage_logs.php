<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_logs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {                                    // logged in
            redirect('signin');
        }
        $this->load->model('tank_auth/users');
        UserAccess::checkUserPermission("qjum");
        $this->lang->load('ForexMart_Internal', 'english');
        $this->load->model('account_model');
        $this->load->model('User_model');
        $this->load->model('Finance_model');
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        $this->load->model('Quick_model');
        $this->q_m = $this->Quick_model;
        $this->load->library('WebService');
    }
    public function index(){
        UserAccess::checkUserPermission("qjum");
        $data['active'] = 'quick-jump';
        $data['access'] = UserAccess::ManageAccessList();
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->append_metadata_css("")
            ->append_metadata_js("")
            ->set_layout('mwp/v2_main')
            ->build('quick_jump/logs', $data);
    }
    public function view(){
        UserAccess::checkUserPermission("qjum");
        $data['active'] = 'quick-jump';
        $id = $this->uri->segment(3);
        $this->load->model('Adminslogs_model');
        $data['log'] = $this->Adminslogs_model->get_log_details($id);
        $data['access'] = UserAccess::ManageAccessList();
        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("MWP | Forexmart")
            ->append_metadata_css("")
            ->append_metadata_js("")
            ->set_layout('mwp/v2_main')
            ->build('quick_jump/view_log', $data);
    }
    public function get_log(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $this->load->model('Adminslogs_model');
        $this->al_m=$this->Adminslogs_model;
        $draw = (int) $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $order =  $this->input->post('order');
        $data['user_documents0'] =  $this->al_m->show();

        $additionComi = array("add","addi", "addit", "additio","addition","additiona","additional");  // this code only additional commision page log
        $searchKeyword=(in_array(trim($search['value']), $additionComi))?"administration/set-commission":$search['value'];

        $data['user_documents1'] =  $this->al_m->showS($length, $start,strtoupper(trim($searchKeyword)),$order);
        $data['user_documents2'] =  $this->al_m->showS_countcurrent(strtoupper(trim($searchKeyword)),$order);
        if( $data['user_documents1']) {
            foreach ( $data['user_documents1'] as $key => $value) {
                $data['data'][$key]['admin_fullname'].= $value['admin_fullname'];
                $data['data'][$key]['admin_email'].= $value['admin_email'];
                $data['data'][$key]['processed_users_id_accountnumber'].=  ($value['processed_users_id_accountnumber']==0)? 'N/A': $value['processed_users_id_accountnumber'];
                $data['data'][$key]['page'].= $value['page'];
                $data['data'][$key]['date_processed'].= $value['date_processed'];
                $data['data'][$key]['data'].=  "<a href='#' data-id='".$value["id"]."' data-name='".$value["admin_fullname"]."' data-email='".$value["admin_email"]."'   data-page='".$value["page"]."'  data-accountnumber='".$value["processed_users_id_accountnumber"]."'  data-date_processed='".$value["date_processed"]."' data-info='".$value["data"]."'  class='hitview' data-toggle='modal' data-target='#viewInfo'> View </a>";
            }

        }else{
            $data['data']= array(
                "draw"=> 0,
                "recordsTotal"=>0,
                "recordsFiltered"=> 0,
                "data"=>[]
            );
            echo json_encode($data);
            unset($data);die();
        }

        $recordsTotal = count($data['user_documents0']);
//        $recordsFiltered = count($data['user_documents0']);
        $recordsFiltered = count($data['user_documents2']);

        $data['draw'] = $draw;
        $data['recordsTotal'] = $recordsTotal;
        $data['recordsFiltered'] = $recordsFiltered;
        unset($data['user_documents0']);
        unset($data['user_documents1']);
        echo json_encode($data);
        unset($data);
    }
}