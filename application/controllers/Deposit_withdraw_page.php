<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_withdraw_page extends MY_Controller {

	public function index(){
        $this->lang->load('depositwithdraw');
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		///$data['data']['metadata_description'] = lang('dw_desc');
        $data['data']['metadata_description'] = '';
        $data['data']['menu_item']=array('l_a','l_b','r_a','r_b','r_c','l_k');
        $data['data']['metadata_keyword'] = lang('dw_kew');
		$this->template->title(lang('dw_tit'))
            ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'chat-support.css">')
			->append_metadata_js("
                    <script type='text/javascript'>
                        $(document).ready(function(){
                          $('#dep').click(function(){
                                $('#with').removeClass('tab-active');
                                $('#dep').addClass('tab-active');
                            });
                             $('#with').click(function(){
                                $('#dep').removeClass('tab-active');
                                $('#with').addClass('tab-active');
                            });
                        });
                    </script>
                ")
			->set_layout('external/main')
			->build('external_DepositWithdrawPage', $data['data']);
	}
}
