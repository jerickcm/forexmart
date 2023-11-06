<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/4/16
 * Time: 5:36 PM
 */

class Verify extends  CI_Controller {



    public function __construct(){

        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {									// logged in
            redirect('signin');
        }

        $this->load->model('account_model');
        $this->load->model('General_model');
        $this->g_m=$this->General_model;

        $this->load->library('UserAccess');
        $this->load->library('IPLoc');


    }
    function incomplete_accounts()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        UserAccess::checkUserPermission("verincomplete");
        $data['menu'] = "accordion-account";
        $data['active'] = "incomplete_accounts";

        $data['access'] = UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("  <link rel='stylesheet' href='" . $css . "summernote.css'> ")
            ->set_layout('mwp/v2_main')
            ->build('accounts/incompleteRegistration', $data);
    }

    function incomplete_accounts_data(){
        if ($this->session->userdata('admin_manage') && $this->input->is_ajax_request()) {
            set_time_limit(0);
            ini_set('memory_limit', '-1');
            $data['menu'] = "accordion-account";
            $data['active'] = "incompleted_accounts";
            $user_id = $this->session->userdata('user_id');

            $draw = (int)$this->input->post('draw');
            $start = $this->input->post('start');
            $length = $this->input->post('length');
            $search = $this->input->post('search');
            $data_accounts = $this->account_model->incompleteRegistration1(trim($search['value']));
            $row_accounts = $this->account_model->incompleteRegistration2($length, $start, trim($search['value']));
            $accounts = array();
            foreach ($row_accounts as $key => $value) {
               // print_r($value);exit;
                $dbInfo0  = $this->account_model->getshow1('mt_accounts_set','user_id',$value['user_id']);
                $dbInfo1  = $this->account_model->getshow1('partnership','partner_id',$value['user_id']);
                $dbInfo = count($dbInfo0)>0?$dbInfo0:$dbInfo1;
                $acct = count($dbInfo0)>0?$dbInfo[0]->account_number:$dbInfo[0]->reference_num;
                $info = $this->getUserdetails($acct);
                $accounts[] = array(
                    $value['email'],
                   $info['Name'],
                    $value['created'],
                    $acct
                );
            }

            $recordsTotal = $data_accounts[0]['count'];
            $recordsFiltered =  $data_accounts[0]['count'];
            $data = array(
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $accounts
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    public function getUserdetails($account_number){
        $webservice_config = array(  'server' => 'live_new'  );
        $webService = new WebService($webservice_config);
        $data = array( 'iLogin' => $account_number );
        $webService->request_account_details($data);
        if ($webService->request_status === 'RET_OK') {
            $data = $webService->get_all_result();
        }else{
            $data = false;
        }
        return $data;
    }

    public  function  index(){

        UserAccess::checkUserPermission("vef");
        
        $this->pending();
        /*$data['menu'] = "accordion-verify";
        $data['active'] = "verify";
            $data['data'] = '';
            $data['custom_validation'] = '';
            $data['custom_validation_success'] = '';
            $data['selectdefault'] = 0;
            $data['user_documents'] = $this->general_model->showt4w1jxV($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus',$id2='1','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number');
            $data['request'] .= $this->Verified_aff_request();
            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap2.css">
                         <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 ')
                ->append_metadata_js("

                           <script type='text/javascript'>
                             $(function() {
                                $('#accountverification').addClass('active-int-nav');
                             });
                          </script>
                    ")
                ->set_layout('mwp/main')
                ->build('verify/AV_verifieddocuments',$data);
            unset($data);*/

    }

    /*account verification verified*/
    public function verified(){
        UserAccess::checkUserPermission("vef");
        if($this->session->userdata('admin_manage')){
            $data['menu'] = "accordion-verify";
            $data['active'] = "verify";
            $data['av_tabs'] = "verified";
            $data['data'] = '';
            $data['custom_validation'] = '';
            $data['custom_validation_success'] = '';
            $data['selectdefault'] = 0;
            $data['request'] = $this->Verified_request();
            $data['request'] .= $this->Verified_aff_request();
            
            
            $data['access']= UserAccess::ManageAccessList();
            
            
            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                 ')
                ->append_metadata_js("

                    ")
                ->set_layout('mwp/main')
                ->build('verify/verified2',$data);
            unset($data);
        }else{
            redirect('signout/admin');
        }
    }
    /*account verification pending*/
    public function pending(){
        ini_set('memory_limit', '128M');

        UserAccess::checkUserPermission("vef");
        if($this->session->userdata('admin_manage')){

            $data['menu'] = "accordion-verify";
            $data['active'] = "verify";
            $data['av_tabs'] = "pending";
            $data['custom_validation']='';
            $data['custom_validation_success']='';
            $data['selectdefault'] = 0;
            $data['request'] = $this->Pending_request();
            $data['request'] .= $this->Pending_aff_request();
            $data['access']= UserAccess::ManageAccessList();

            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('

                 ')
                ->append_metadata_js("

                    ")

                ->set_layout('mwp/main')
                ->build('verify/AV_verifieddocuments',$data);
            unset($data);
        }else{
            redirect('signout/admin');
        }
    }

    public function declined(){
        UserAccess::checkUserPermission("vef");
        if($this->session->userdata('admin_manage')){

            $data['menu'] = "accordion-verify";
            $data['active'] = "verify";
            $data['av_tabs'] = "declined";
            $data['custom_validation']='';
            $data['custom_validation_success']='';
            $data['selectdefault'] = 0;
            $data['request'] = $this->Unverified_request();
            //$data['request'] .= $this->Unverified_aff_request();
            
            
            $data['access']= UserAccess::ManageAccessList();
            
            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('

                 ')
                ->append_metadata_js("

                    ")
                ->set_layout('mwp/main')
                ->build('verify/decline2',$data);
            // unset($data);
        }else{
            redirect('signout/admin');
        }
    }

    public function acct_ver_declined(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '2048M');

        if($this->session->userdata('admin_manage')){

            // Check permission
            $data['access']= UserAccess::ManageAccessList();

            $data['menu'] = "accordion-verify";
            $data['active'] = "verify";
            $data['av_tabs'] = "declined";
            $data['custom_validation']='';
            $data['custom_validation_success']='';
            $data['selectdefault'] = 0;

            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                    <link rel="stylesheet" href="'.$this->template->Css().'dataTables.bootstrap2.css">
                    <link rel="stylesheet" href="'.$this->template->Css().'loaders.css">
                 ')
                ->append_metadata_js("
                        <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                      <script src='".$this->template->Js()."jquery.dataTables.min.js'></script>
                      <script src='".$this->template->Js()."moment.min.js'></script>
                      <script src='".$this->template->Js()."datetime-moment.min.js'></script>
                      <script src='".$this->template->Js()."dataTables.bootstrap.min.js'></script>
                          

                          <script type='text/javascript'>
                             $(function() {
                                $('#accountverification').addClass('active-int-nav');
                             });
                          </script>
                    ")
                ->set_layout('administration/main')
                ->build('account-verification/single_declined',$data['data']);
            unset($data);
        }else{
//            redirect('signout/admin');
        }
    }

    public function check_level(){
        
        UserAccess::checkUserPermission("vef");
        
        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');


        if ($this->form_validation->run()){

            $account_number = $this->input->post('account_number');

           // $data['verifyData'] = $this->account_model->getCheckLevelData($account_number);

            $data['flag'] = false;

            if($check_level_part = $this->account_model->getCheckLevelDataPart($account_number)){
                $data['verifyData'] = $check_level_part;

                //echo $check_level_part;exit;

                $data['result_ac'] = $account_number;
                $data['flag'] = true;
            }
            else{
                if( $check_level = $this->account_model->getCheckLevel($account_number)){
                    $data['verifyData'] = $this->account_model->getCheckLevelData($account_number);

                    $data['result'] = $check_level;
                    $data['flag'] = true;
                }else{
                    $data['msg']= true;
                }
            }
        }
        else{
            $data['user_documents'] = false;
        }

        $data['menu'] = "accordion-verify";
        $data['active'] = "check_level";

        $data['status'] = array("Pending","Approved","Declined");
        
        $data['access']= UserAccess::ManageAccessList();

        $js = $this->template->Js();
        $css = $this->template->Css();
        $this->template->title("Administration | Forexmart")
            ->append_metadata_css("
                  <link rel='stylesheet' href='".$css."summernote.css'>
                ")
            ->append_metadata_js("
                      <script src='".$js."summernote.js'></script>
                      <script src='".$js."jquery.validate.js'></script>
                      <script type='text/javascript'>
                          $(document).ready(function(){
                                    $('#adm_mailer').addClass('active-sidenav');
                                                  $('#mailer').addClass('active-int-nav');
                            });
                      </script>
                ")
            ->set_layout('mwp/main')
            ->build('verify/check_level',$data);
    }
    public function Verified_request(){

        $data['user_documents'] = $this->general_model->showt4w1jxV($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus',$id2='1','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number,a.group,p.fb');

        $request='';

        if( $data['user_documents']) {

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request .= '<tr>';
                $request .= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
              //  $request .= '<td  class="display-n">'.$value['email'].'</td>';
                $request .= '<td >'.$value['account_number'].'</td>';
                $request .= '<td>'.$value['full_name'].'</td>';
                $request .= '<td >' . $value['fb'] . '</td>';
                $request .= '<td>'.$value['group'].'</td>';
              //  $request .= '<td>'.$value['last_ip'].'</td>';
                $request .= '<td><a href="#'.$value['id'].'" data-type="Client"  data-accountnumber="'.$value['account_number'].'" data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->general_model->getCountries($value['country']).','.$value['zip'].'" class="queue-action verified" data-toggle="modal" data-target="#verifiedStat">'.lang("md").'</a></td>';
                $request .= '</tr>';
            }
        }else{
            $request .= '<td colspan="6 class="center">'.lang("norecy").'</td>';
        }

        return $request;
        unset($request);
    }

    public function Verified_aff_request(){
        $data['user_documents'] = $this->general_model->showPt4w1jUV($table='user_documents',$table2='users',$table3='user_profiles',$table4='partnership',$field2='accountstatus ',$id2='1','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num,p.fb');

        $request='';

        if($data['user_documents']){

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request.= '<tr>';
                $request.= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
                $request.= '<td class="display-n">'.$value['email'].'</td>';
                $request.= '<td >'.$value['reference_num'].'</td>';
                $request.= '<td>'.$value['full_name'].'</td>';
                $request.= '<td>'.$value['fb'].'</td>';
               // $request.= '<td>'.$value['last_ip'].'</td>';
                $request .= '<td><a href="#'.$value['id'].'" data-type="Affiliate" data-accountnumber="'.$value['reference_num'].'" data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->general_model->getCountries($value['country']).','.$value['zip'].'" class="queue-action verified" data-toggle="modal" data-target="#verifiedStat">'.lang("md").'</a></td>';
                $request .= '</tr>';
                $request.= '</tr>';
            }
        }else{
            $request.= '';
        }

        return $request;
        unset($request);
    }

    public function Unverified_request(){

        $data['user_documents'] = $this->general_model->showt4w1jUV($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus',$id2='2','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,p.street,p.city,p.state,p.country,p.zip,a.account_number,p.fb');

        /*if ($this->session->userdata('user_id') == 96045) {
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            exit;
        }*/

        $request='';

        if($data['user_documents']){

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request.= '<tr>';
                $request.= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
               // $request.= '<td  class="display-n">'.$value['email'].'</td>';
                $request.= '<td >'.$value['account_number'].'</td>';
                $request.= '<td>'.$value['full_name'].'</td>';
                $request.= '<td >' . $value['fb'] . '</td>';
                $request .= '<td>'.$value['group'].'</td>';
                //$request.= '<td>'.$value['last_ip'].'</td>';
                $request.= '<td><a href="#'.$value['id'].'" data-type="Client"  data-accountnumber="'.$value['account_number'].'"  data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->general_model->getCountries($value['country']).','.$value['zip'].'" class="queue-action declined" data-toggle="modal" data-target="#declineStat">'.lang("md").'</a> |

                <a href="#' . $value['id'] . '"  data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' .$this->general_model->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action declinednotes" data-toggle="modal" data-target="#declineNotes">' . 'View reason of decline' . '</a>


                </td>';
                $request.= '</tr>';
            }
        }else{
            $request.= '<td colspan="6 class="center">'.lang("norecy").'</td>';
        }

        return $request;
        unset($request);
    }
    public function AV_Unverified_updaterequest(){
        if(!$this->input->is_ajax_request()){die('Not authorized!');}
        $data['userid'] = $this->input->post('userid');
        $data['data']['request'] = $this->Unverified_request();
        $data['data']['request'] .= $this->Unverified_aff_request();
        $data['data']['fd'] = $this->doc1($data['userid']);
        $data['data']['sd'] = $this->doc2($data['userid']);
        echo json_encode($data['data']);
        unset($data);
    }

    public function Pending_doc(){

        if(!$this->input->is_ajax_request()){die('Not authorized!');}

        $data['userid'] = $this->input->post('userid');

        $this->db->trans_start();

        $data['doc0'] =$this->general_model->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='0',$select='*');
        $data['doc1'] =$this->general_model->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='1',$select='*');
        $data['doc2'] =$this->general_model->showdoc($table='user_documents',$field1='user_id',$id1=$data['userid'],$field1='doc_type', $id2='2',$select='*');


        if (count($data['doc0'])>1){
            foreach (array_reverse($data['doc0'], true) as $key => $value) {
               $this->general_model->updatemydocs($table = "user_documents",$field1 = "user_id", $id1=$data['userid'],$field2='id',$id2=$value['id'],array( 'uploadset' => $key));
            }
        }

        if (count($data['doc1'])>1){

            foreach (array_reverse($data['doc1'], true) as $key => $value) {
               $this->general_model->updatemydocs($table = "user_documents",$field1 = "user_id", $id1=$data['userid'],$field2='id',$id2=$value['id'],array( 'uploadset' => $key));
            }
        }

        if (count($data['doc2'])>1){

            foreach (array_reverse($data['doc2'], true) as $key => $value) {
               $this->general_model->updatemydocs($table = "user_documents",$field1 = "user_id", $id1=$data['userid'],$field2='id',$id2=$value['id'],array( 'uploadset' => $key));
            }
        }


        $data['data']['fd']=$this->doc1($data['userid']);
        $data['data']['sd']=$this->doc2($data['userid']);
        $this->db->trans_complete();
        echo json_encode($data['data']);
        unset($data);

    }

    public function Unverified_aff_request(){
        $data['user_documents'] = $this->general_model->showPt4w1jUV($table='user_documents',$table2='users',$table3='user_profiles',$table4='partnership',$field2='accountstatus ',$id2='2','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num');

        $request='';

        if($data['user_documents']){

            foreach($data['user_documents'] as $key => $value) {
                $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['date_uploaded']);
                $request.= '<tr>';
                $request.= '<td>'. $data['DateUp']->format('Y-M-d H:i:s').'</td>';
                $request.= '<td class="display-n">'.$value['email'].'</td>';
                $request.= '<td >'.$value['reference_num'].'</td>';
                $request.= '<td>'.$value['full_name'].'</td>';
               /* $request.= '<td>'.$value['last_ip'].'</td>';*/
                $request.= '<td><a href="#'.$value['id'].'" data-type="Affiliate" data-accountnumber="'.$value['reference_num'].'"  data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->general_model->getCountries($value['country']).','.$value['zip'].'" class="queue-action declined" data-toggle="modal" data-target="#declineStat">'.lang("md").'</a> |


                 <a href="#' . $value['id'] . '"  data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->general_model->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action declinednotes" data-toggle="modal" data-target="#declineNotes">' . 'View reason of decline' . '</a>

                </td>';
                $request.= '</tr>';
            }
        }else{
            $request.= '';
        }

        return $request;
        unset($request);
    }
    public function Pending_request(){

        $data['user_documents'] =$this->general_model->showt4w1jx($table='user_documents',$table2='users',$table3='user_profiles',$table4='mt_accounts_set',$field2='accountstatus ',$id2='0','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,a.account_number,u.recent_fileupload,a.group,p.fb');

        $request='';
        if( $data['user_documents']) {
            foreach ( $data['user_documents'] as $key => $value) {
                if (is_null($value['recent_fileupload'])){
                    $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);
                }else{
                    $data['DateUp']=DateTime::createFromFormat('Y-m-d H:i:s',$value['recent_fileupload']);
                }

                if ($value['accountstatus'] == 0) {
                    $request.= '<tr style="color: green">';
                } else {
                    $request.= '<tr style="color: red">';
                }
                $request.= '<td>' . $data['DateUp']->format('Y-M-d H:i:s ') . '</td>';
                $request.= '<td class="display-n">' . $value['email'] . '</td>';
              //  $request.= '<td >' . $value['account_number'] . '</td>';
                $request.= '<td >' . $value['full_name'] . '</td>';
                $request.= '<td >' . $value['fb'] . '</td>';
                $request .= '<td>'.$value['group'].'</td>';
                //$request.= '<td>' . $value['last_ip'] . '</td>';
                $request.= '<td>
<a href="#' . $value['id'] . '"  data-type="Client" data-accountnumber="' . $value['account_number'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' .$this->general_model->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action request" data-toggle="modal" data-target="#pendingStat">' . lang("md") . '</a>';
            }
        }else{
            $request.= '<td colspan="6 class="center">'.lang("norecy").'</td>';
        }

        return $request;
        unset($request);
    }
    public function Pending_aff_request(){

        $data['user_documents'] = $this->general_model->showPt4w1jx($table='user_documents',$table2='users',$table3='user_profiles',$table4='partnership',$field2='accountstatus ',$id2='0','', '',$select='ud.id,ud.user_id,ud.date_uploaded,u.email,p.full_name,u.last_ip,p.street,p.city,p.state,p.country,p.zip,ud.doc_type,ud.file_name,ud.status,ud.client_name,u.accountstatus,part.reference_num');

        $request='';
        if( $data['user_documents']) {

            foreach ( $data['user_documents'] as $key => $value) {

                $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);

                if ($value['accountstatus'] == 0) {
                    $request.= '<tr style="color: green">';
                } else {
                    $request.= '<tr style="color: red">';
                }
                $request.= '<td>' . $data['DateUp']->format('Y-M-d H:i:s') . '</td>';
                $request.= '<td class="display-n">' . $value['email'] . '</td>';
                $request.= '<td >' . $value['reference_num'] . '</td>';
                $request.= '<td >' . $value['full_name'] . '</td>';
               /* $request.= '<td>' . $value['last_ip'] . '</td>';*/
                $request.= '<td>
<a href="#' . $value['id'] . '" data-type="Affilliate" data-accountnumber="' . $value['reference_num'] . '"  data-userid="' . $value['user_id'] . '" data-id="' . $value['id'] . '" data-fullname="' . $value['full_name'] . '" data-email="' . $value['email'] . '" data-address="' . $value['street'] . ',' . $value['city'] . ',' . $value['state'] . ',' . $this->general_model->getCountries($value['country']) . ',' . $value['zip'] . '" class="queue-action request" data-toggle="modal" data-target="#pendingStat">' . lang("md") . '</a>';
            }
        }else{
            $request.= '';
        }

        return $request;
        unset($request);
    }

    public function search_verified(){
        $search = $this->input->post('search');
        echo $search;
    }

public function acct_ver_verified(){
        UserAccess::checkUserPermission("vef");
        if($this->session->userdata('admin_manage')){
            $data['menu'] = "accordion-verify";
            $data['active'] = "verify";
            $data['av_tabs'] = "verified";
            $data['data'] = '';
            $data['custom_validation'] = '';
            $data['custom_validation_success'] = '';
            $data['selectdefault'] = 0;
            $data['request'] = $this->Verified_request();
            $data['request'] .= $this->Verified_aff_request();
            
            
            $data['access']= UserAccess::ManageAccessList();
            
            
            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('
                 ')
                ->append_metadata_js("

                    ")
                ->set_layout('mwp/main')
                ->build('verify/verified2',$data);
            unset($data);
        }else{
            redirect('signout/admin');
        }
    }

     public function upload(){
        
        UserAccess::checkUserPermission("vef");

        if($this->session->userdata('admin_manage')){
            $data['menu'] = "accordion-verify";
            $data['active'] = "verify";
            $data['av_tabs'] = "doseviem";
            $data['custom_validation']='';
            $data['custom_validation_success']='';
            $data['selectdefault'] = 0;
            $data['access']= UserAccess::ManageAccessList();

            $this->template->title("Administration | Forexmart")
                ->append_metadata_css('

                 ')
                ->append_metadata_js("

                    ")

                ->set_layout('mwp/main')
                ->build('verify/upload',$data);
            unset($data);
        }else{
            redirect('signout/admin');
        }

    }

        public function upload_documents(){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->helper(array('form', 'url'));

        $data['account_number']=$this->input->post('account_number');

        $data['client'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number", $this->input->post('account_number'), "*", '');
        $data['partner'] = $this->g_m->showssingle($table = "partnership","reference_num",$this->input->post('account_number'),"*",'');

        //check client account
        if($data['client']){

            $data['save-data']=$data['client'];
            $user_id =  $data['save-data']['user_id'];
            $account_type='Client';
        }
        //check partner account
        if($data['partner'] ){
            $data['save-data']=$data['partner'];
            $user_id =  $data['save-data']['partner_id'];
            $account_type='Partner';
        }
        //check invalid account
        if ($data['partner']==false and $data['client']==false){
            $data['msgError'] = 'Notice:  Invalid account number.';
            $data['error'] = true;
            echo json_encode($data);
            die();
            exit;

        }


        $data=array();

        if(!empty($_FILES['filename']['name'])){

            $this->load->helper(array('form', 'url'));
            $_FILES['userfile']['name']    = $_FILES['filename']['name'];
            $_FILES['userfile']['type']    = strtolower($_FILES['filename']['type']);
            $_FILES['userfile']['tmp_name'] = $_FILES['filename']['tmp_name'];
            $_FILES['userfile']['error']       = $_FILES['filename']['error'];
            $_FILES['userfile']['size']    = $_FILES['filename']['size'];

//            $config['file_name']     = sha1($_FILES['userfile']['name']);
            $config['file_name']     = hash('haval224,5',$_FILES['userfile']['name']);
            $config['upload_path'] = '/var/www/html/my.forexmart.com/assets/user_docs/';
            $config['allowed_types'] = 'gif|JPG|JPEG|jpg|jpeg|png|bmp|pdf|PNG';
            $config['max_size']      = '10000';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $config['overwrite']     = false; // DO NOT CHANGE
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $data['msgError']='';
            try{
                if($this->upload->do_upload()){
                    $uploadData = $this->upload->data();

                    $updData = array(
                        'user_id' => $user_id,
                        'doc_type' => $this->input->post('doc_type'),
                        'file_name' => $uploadData['file_name'],
                        'client_name' => $uploadData['client_name'],
                        'admn_upload_userid' => $this->session->userdata('user_id'),
                        'status' => 0,
                    );

                    $config['source_image'] = '/var/www/html/my.forexmart.com/assets/user_docs/'. $uploadData['file_name'];
                     FXPP::setWaterMark($config['source_image']);

                    $accountstatus= $this->g_m->showssingle($table='users',$field="id",$id=$user_id,$select="accountstatus");
                    if ($accountstatus['accountstatus']!=1){
                        $data['newupload']=array(
                            'accountstatus'=>0,
                            'recent_fileupload'=> date('Y-m-d H:i:s')
                        );
                        $this->g_m->updatemy($table="users","id",$user_id,$data['newupload']);
                    }

                    $this->g_m->insertmy($table="user_documents",$updData);
                    $data['error'] = false;

                    /*admin_log*/

                    $this->load->model('Adminslogs_model');
                    $arr=array(
                        'doc_type' => $this->input->post('doc_type'),
                        'client_name' => $uploadData['client_name'],
                        'account_type' => $account_type,
                        'Manager_IP'=>$this->input->ip_address()
                    );

                    $data['log']=array(
                        'users_id'=>$_SESSION['user_id'],
                        'page' => 'verify/upload',
                        'date_processed'=> FXPP::getCurrentDateTime(),
                        'processed_users_id'=>$user_id,
                        'data'=> json_encode($arr),
                        'processed_users_id_accountnumber' => $this->input->post('account_number'),
                        'comment'=>'',
                        'admin_fullname'=>$_SESSION['full_name'],
                        'admin_email'=>$_SESSION['email'],
                    );
                    $this->Adminslogs_model->insertmy($table="admin_log",$data['log']);

                    /*admin_log*/
                    $data['msgError'] = $this->upload->display_errors();
                    $data['msgError_ext']=false;
                }else{
                    $data['msgError'] = $this->upload->display_errors();
                    $data['error'] = true;
                    //http://php.net/manual/en/function.exif-imagetype.php
                    $data['filetype'] = exif_imagetype($_FILES['filename']['tmp_name']);
                    $data['filetype2']=strtolower($_FILES['filename']['type']);
                    $data['msgError_ext']=false;
                    switch(strtolower($_FILES['filename']['type'])){
                        case 'image/gif':
                            if (exif_imagetype($_FILES['filename']['tmp_name'])==1){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        case 'image/jpeg':
                            if (exif_imagetype($_FILES['filename']['tmp_name'])==2){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        case 'image/png':
                            if (exif_imagetype($_FILES['filename']['tmp_name'])==3){

                            }else{
                                $data['msgError_ext']=true;
                                $data['msgError'] ="There's an issue with the format of the file. Please open it in any photo editing software (e.g. paint) and save it as gif , jpg or png file.";
                            }
                            break;
                        default:
                    }

                }
            } catch(Exception $e){
                if (strpos($e->getMessage(), 'pdf') !== false) {
                    $data['msgError']="The PDF file type that you uploaded is not supported.";
                }else{
                    $data['msgError'] = $e->getMessage() ;
                }
//                $data['msgError'] =str_replace("/var/www/html/my.forexmart.com/assets/user_docs/", "",$e->getMessage() );
//                $data['msgError'] =str_replace("free parser shipped with FPDI. (See https://www.setasign.com/fpdi-pdf-parser for more details)", " upload engine.",$data['msgError'] );
                $data['error'] = true;
                $data['msgError_ext']=false;
            }
        }else{
            $data['msgError_ext']=false;
            $data['msgError'] = 'Please select a file.';
            $data['error'] = true;
        }
        echo json_encode($data);
    }

    public function save()
    {
        if ($this->input->is_ajax_request()) {

            $data['account_number'] = $this->input->post('account_number');
            $data['client'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number", $this->input->post('account_number'), "*", '');


            if (trim($this->input->post('account_number')) == '') {
                $data2['empty'] = true;
                echo json_encode($data2);
                exit;
                die();
            }
            //check client account
            if ($data['client']) {
                $account_info = array(
                    'iLogin' => $this->input->post('account_number')
                );
                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_RequestAccountDetails($account_info);
                switch ($WebService->request_status) {
                    case 'RET_OK':
                        $data2['IsReadOnly'] = $WebService->get_result('IsReadOnly');
                        if ($WebService->get_result('IsReadOnly') == false) {
                            $this->db->trans_start();
                            $data['mt_account_set'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number", $this->input->post('account_number'), "*", '');
                            $data['users'] = $this->g_m->showssingle($table = "users", "id", $data['mt_account_set']['user_id'], "*", '');
                            $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                            $data['verify'] = array(
                                'accountstatus' => 1,
                                'verified'      => $data['DateUp']->format('Y-m-d H:i:s')
                            );
                            $this->g_m->updatemy($table = "users", "id", $data['mt_account_set']['user_id'], $data['verify']);
                            $data['mts_update'] = array(
                                'mt_status' => 1
                            );
                            $this->g_m->updatemy($table = "mt_accounts_set", "user_id", $data['mt_account_set']['user_id'], $data['mts_update']);

                            $data['ProfileInfo'] = $this->g_m->showssingle($table = "user_profiles", "user_id", $data['mt_account_set']['user_id'], "full_name", '');
                            $data['DocType0'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['mt_account_set']['user_id'], 'doc_type', '0', 'status', '1', "*", '');
                            $data['DocType1'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['mt_account_set']['user_id'], 'doc_type', '1', 'status', '1', "*", '');
                            $data['DocType2'] = $this->g_m->show1st1w3($table = "user_documents", 'user_id', $data['mt_account_set']['user_id'], 'doc_type', '2', 'status', '1', "*", '');

                            if ($data['DocType0'] == false) {
                                $data['DocType0']['client_name'] = '';
                                $data['DocType0']['file_name'] = '';
                                $data['DocType0']['doc_type'] = '';
                            }
                            if ($data['DocType1'] == false) {
                                $data['DocType1']['client_name'] = '';
                                $data['DocType1']['file_name'] = '';
                                $data['DocType1']['doc_type'] = '';
                            }
                            if ($data['DocType2'] == false) {
                                $data['DocType2']['client_name'] = '';
                                $data['DocType2']['file_name'] = '';
                                $data['DocType2']['doc_type'] = '';
                            }

                            $data['senddata'] = array(

                                'Email'         => $data['users']['email'],
                                'AccountNumber' => $data['mt_account_set']['account_number'],
                                'FullName'      => $data['ProfileInfo']['full_name'],

                                'ClientName0' => $data['DocType0']['client_name'],
                                'FileName0'   => $data['DocType0']['file_name'],
                                'DocIdx0'     => $data['DocType0']['doc_type'],

                                'ClientName1' => $data['DocType1']['client_name'],
                                'FileName1'   => $data['DocType1']['file_name'],
                                'DocIdx1'     => $data['DocType1']['doc_type'],

                                'ClientName2' => $data['DocType2']['client_name'],
                                'FileName2'   => $data['DocType2']['file_name'],
                                'DocIdx2'     => $data['DocType2']['doc_type']

                            );

                            $data2['verification_status'] = 'Verified';
                            $this->load->library('Fx_mailer');
                            Fx_mailer::AccountVerificationVerifiedUser($data['senddata']);

                            /*admin_log*/
                            $this->load->model('Adminslogs_model');
                            $arr = array(
                                'process'        => 'save action button approving account',
                                'account_status' => 'approved',
                                'Manager_IP'     => $this->input->ip_address()
                            );
                            $data['log'] = array(
                                'users_id'                         => $_SESSION['user_id'],
                                'page'                             => 'verify/upload',
                                'date_processed'                   => FXPP::getCurrentDateTime(),
                                'processed_users_id'               => $data['mt_account_set']['user_id'],
                                'data'                             => json_encode($arr),
                                'processed_users_id_accountnumber' => $this->input->post('account_number'),
                                'comment'                          => 'TEST',
                                'admin_fullname'                   => $_SESSION['full_name'],
                                'admin_email'                      => $_SESSION['email'],
                            );
                            $this->Adminslogs_model->insertmy($table = "admin_log", $data['log']);
                            /*admin_log*/


                            $this->db->trans_complete();

                            $data2['verified'] = 'true';
                            $data2['error1'] = 'false';
                        } else {
                            $data2['verified'] = 'false';
                            $data2['error1'] = 'false';
                        }
                        break;
                    default:
                        $data2['verified'] = 'false';
                        $data2['error1'] = 'true';
                }
            } else {
                $data2['type'] = 'invalid';
            }

            $data['partner'] = $this->g_m->showssingle($table = "partnership", "reference_num", $this->input->post('account_number'), "*", '');
            //check partner account
            if ($data['partner']) {
                $data2['type'] = 'partner';
                $data['mt_account_set'] = $this->g_m->showssingle($table = "mt_accounts_set", "account_number", $this->input->post('account_number'), "*", '');
                $data['users'] = $this->g_m->showssingle($table = "users", "id", $data['mt_account_set']['user_id'], "*", '');
                $data2['location'] = $data['users']['accountstatus'];
            }

            echo json_encode($data2);
        }
    }
} 

