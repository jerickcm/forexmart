<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_deposit_bonus extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('General_model');
		$this->g_m=$this->General_model;
		$this->lang->load('nodepositbonus');
	}
	public function index(){

		if(isset($_SESSION['user_id'])){
			$deposit = $this->g_m->showssingle3($table='deposit',$field="user_id",$id=$_SESSION['user_id'],$field2="status",$id2=2,$select="*",$order_by="");
			$account_details = $this->g_m->showssingle2($table='mt_accounts_set',$field='user_id',$id=$_SESSION['user_id'],$select='mt_account_set_id');
			$nodepositbonus = $this->g_m->showssingle2($table='users',$field='id',$id=$_SESSION['user_id'],$select='nodepositbonus,created,createdforadvertising');
			if(is_null($nodepositbonus['createdforadvertising'])){
				$data['datecreated']=$nodepositbonus['created'];
			}else{
				$data['datecreated']=$nodepositbonus['createdforadvertising'];
			}
			$datecreated=DateTime::createFromFormat('Y-m-d H:i:s',$data['datecreated']);
			$datedifference=$this->g_m->difference_day($datecreated->format('Y-m-d'),$datecurrent=date('Y-m-d'));

			if ($nodepositbonus['nodepositbonus']==1 OR $datedifference>7 OR $account_details['mt_account_set_id'] != 1 OR $deposit!=false){
				$data['data']['expireNoDeposit']=true;
//				redirect('');
			}else{
				$data['data']['expireNoDeposit']=false;
			}
		}

		$data['data']['bonus'] = IPLoc::bonus();
		$data['data']['check'] = $this->load->ext_view('modal', 'check', $data['data'], TRUE);
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

		//$data['data']['metadata_description'] = lang('ndb_dsc');
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = lang('ndb_kew');
		$this->template->title(lang('ndb_tit'))
			->set_layout('external/main')
			->build('external_NoDepositBonus', $data['data']);
	}
}
