<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_funds extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) { // logged in

            redirect('signin');

        }

        $this->load->model('Finance_model');
        $this->load->library('Fx_mailer');
        // $this->load->library('iploc');
        $this->load->library('UserAccess');

        //for advertisement cookie
        $this->load->model('General_model');
        $this->g_m = $this->General_model;
        if ($this->session->userdata('logged')) {
            $data['cookie'] = array(
                'name' => 'fullname',
                'value' => $_SESSION['full_name'],
                'expire' => time() + (10 * 365 * 24 * 60 * 60),
                'domain' => '.forexmart.com',
                'secure' => true,
                'path' => '/',
                'prefix' => '',
                'httponly' => true,
            );
            $this->input->set_cookie($data['cookie'], true);
            $nodepositbonus = $this->g_m->showssingle2($table = 'users', $field = 'id', $id = $_SESSION['user_id'], $select = 'nodepositbonus,created,createdforadvertising');
            $data['cookie']['name'] = 'nodepositbonus';
            $data['cookie']['value'] = $nodepositbonus['nodepositbonus'];
            $this->input->set_cookie($data['cookie'], true);
            if (is_null($nodepositbonus['createdforadvertising'])) {
                $data['datecreated'] = $nodepositbonus['created'];
            } else {
                $data['datecreated'] = $nodepositbonus['createdforadvertising'];
            }
            $datecreated = DateTime::createFromFormat('Y-m-d H:i:s', $data['datecreated']);
            $datedifference = $this->g_m->difference_day($datecreated->format('Y-m-d'), $datecurrent = date('Y-m-d'));
            $data['cookie']['name'] = 'datedifference';
            $data['cookie']['value'] = $datedifference;

            $this->input->set_cookie($data['cookie'], true);
            unset($data['cookie']);
            unset($data);
        }
        //for advertisement cookie
    }

    public function  index()
    {
        if ($this->session->userdata('admin_manage')) {

            UserAccess::checkUserPermission("fina");
            $data['access'] = UserAccess::ManageAccessList();
            
            $this->form_validation->set_rules('account_number', 'Account Number', 'trim|numeric|required|xss_clean');
            $this->form_validation->set_rules('sum', 'Account Number', 'trim|numeric|required|xss_clean');
            $this->form_validation->set_rules('comment', 'Comment', 'trim|numeric|required|xss_clean');
            $success = false;

            if ($this->form_validation->run()) {
                $account_number = $this->input->post('account_number');
                $amount = $this->input->post('sum');
                $comment_id = $this->input->post('comment');
                $data['credit'] = $this->Finance_model->showssingle($table='mt4_comment',$field="id",$id=$comment_id,$select="api_method,comment",$order_by="");
                $account = $this->Finance_model->getAccountsByAccountNumber( $account_number );
                $partner =  $this->Finance_model->showt2w1j1($table="partnership",$table2="users",$field="reference_num",$id=$account_number,$select="partnership.currency,users.accountstatus,users.id",$join12="users.id=partnership.partner_id",$order="",$group="");
                if($account){
                    switch ($data['credit']['api_method']){
                        case 1:
                            //$this->credit_prize_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            redirect('Credit_funds/credit_prize_v2/'. $account['user_id'] . '/' . $account_number . '/' . $amount . '/' . true . '/' . $data["credit"]["comment"]);
                            break;
                        case 2:
                            $this->credit_ndb_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 3:
                            $this->credit_supporter_full_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 4:
                            $this->credit_supporter_part_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 5:
                            $this->credit_showfx_bonus_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 6:
                            $this->credit_30percent_bonus_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;  
                        case 7:
                            $this->credit_deposit_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        case 8:
                            if(IPLoc::Office()){
                                $type = $this->input->post('payment');
                                if(array_key_exists($type, $this->comment_transaction_type)){
                                    $this->credit_withdraw_test_v2($account, $account_number, $amount, $type, true,$data['credit']['comment']);
                                }else{
                                    $message = '<i class="fa fa-exclamation-circle"></i> Invalid payment system.';
                                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                                }
                            }else{
                                $this->credit_withdraw_v2($account, $account_number, $amount, true,$data['credit']['comment']);
                            }
                            break;
                        case 9:
                            $comment_only=($this->input->post('check')=='true')? true: false;
                            if ($comment_only==false){
                                $type='N/A';
                            }else{
                                $type = $this->input->post('payoption');
                            }

                            $this->cancel_by_withdrawal($account, $account_number, $amount, $type, true,$data['credit']['comment'],$comment_only);
                            break;
                        case 10:
                            $this->credit_mf_prize($account, $account_number, $amount,true,$data['credit']['comment']);
                            break;
                        case 11:
                            $this->credit_50percent_bonus($account, $account_number, $amount, true,$data['credit']['comment']);
                            break;
                        default:
                            $message = '<i class="fa fa-exclamation-circle"></i> Invalid fund option.';
                            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                    }
                }else if ($partner){
                    switch ($data['credit']['api_method']){
                        case 9:
                            $comment_only=($this->input->post('check')=='true')? true: false;
                            if ($comment_only==false){
                                $type='N/A';
                            }else{
                                $type = $this->input->post('payoption');
                            }

                            $this->cancel_by_withdrawalp($partner, $account_number, $amount, $type, true,$data['credit']['comment'],$comment_only);
                            break;
                        default:
                            $message = '<i class="fa fa-exclamation-circle"></i> Invalid fund option.';
                            $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                    }
                }else{
                    $message = '<i class="fa fa-exclamation-circle"></i> Invalid account number.';
                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            }else{
                $message = validation_errors('<i class="fa fa-exclamation-circle"></i> ');
                if($message){
                    $this->session->set_flashdata("result", array('message' => $message, 'success' => $success));
                }
            }
//            Admin::checkUserPermission("cancelf","manaccounts");
//            $data['access'] = Admin::ManageAccessList();
//            $this->load->model('Task_model');
//            $this->t_m=$this->Task_model;

            $data['query'] = $this->Finance_model->showssingle2_tm($table='mt4_comment',$field="comment_type",$id=0,$field2="status",$id2=1,$select="comment,id,api_method",$order_by="date_created");

//            $options = array();

            $data['comments_option']='';

            if ($data['query']) {
                foreach($data['query'] as $key => $value ){
//                    $options[$value['id']]= $value['comment'];
                    $data['comments_option'].='<option value="'.$value['id'].'" data-apimethod="'.$value['api_method'].'"> '.$value['comment'].' </option>';
                }
//                $data['comments_option'] = $this->General_model->selectOptionList($options);

            }


            $data['query'] = $this->Finance_model->showssingle2_tm($table='mt4_comment',$field="comment_type",$id=0,$field2="status",$id2=1,$select="id,comment_type,comment,value,date_created,api_method,transaction_id,payment_date,payment_option",$order_by="");
            $data['request']='';
            if ($data['query']) {
                foreach($data['query'] as $key => $value ){
                    if ($value['payment_date']==null){
                        $date='';
                    }else{
                        $date = DateTime::createFromFormat('Y-m-d H:i:s',  $value['payment_date']);
                        $date = $date->format('m/d/Y');
                    }

                    $data['request'] .= '<tr>';
                    $data['request'] .= '<td> Cancel Funds </td>';
                    $data['request'] .= '<td>' . $value['comment'] . '</td>';
                    $data['request'] .= '<td>' . $value['date_created'] . '</td>';
                    $data['request'] .= '<td>
                    <a onclick="pre_def()" data-poption="'.$value['payment_option'].'"  data-pdate="'.$date.'"  data-trid="'.$value['transaction_id'].'"   data-id="'.$value['id'].'" data-api="'.$value['api_method'].'"  data-type="'.$value['comment_type'].'"  data-comment="'.$value['comment'].'"  class="curp queue-action edit" ><i class="fa fa-pencil action "></i>

                    <a onclick="pre_def()" data-id="'.$value['id'].'" data-commenttype="Credit Funds" data-type="'.$value['comment_type'].'"  data-comment="'.$value['comment'].'"  data-date="'.$value['date_created'].'"  class="curp queue-action push_delete" data-toggle="modal" data-target="#delete"><i class="fa fa-times-circle action"></i></a>
                    </td>';
                    $data['request'] .= '</tr>';
                }
            }

            $data['payment_option'] = $this->Finance_model->selectOptionList($this->transaction_type);
            $data['payoption'] = $this->General_model->selectOptionList($this->withtdraw_transaction_type);

            $data['type'] = 7;

            $data['menu'] = "accordion-finance";
            $data['active'] = "cancel-funds";

//            $data['sidebar'] = $this->load->view('layouts/administration/manage_account_nav', $data, TRUE);
            $this->template->title("Administration | Cancel Funds")
                ->append_metadata_css("

                <link rel='stylesheet' href='".$this->template->Css()."loaders.css'>
                <link rel='stylesheet' type='text/css' href='//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css'/>
                <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css'>
                <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css.map'>

                ")
                ->append_metadata_js("
                      <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                      <script src='".$this->template->Js()."Moment.js'></script>
                      <script src='".$this->template->Js()."datetime-moment.js'></script>
                      <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                      <script src='".$this->template->Js()."jquery.validate.min.js'></script>
                        <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#manageaccounts').addClass('active-int-nav');
                            });
                      </script>
                ")
                ->set_layout('mwp/main')
                ->build('manage-accounts/cancel_funds',$data);
        }
    }

}