<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller{

		
	function __construct()
	{	

		parent::__construct();
		$this->load->model('General_model');
		$this->g_m=$this->General_model;
		// set cookie to hide external page no deposit bonus start FXPP-2179
		if(isset($_SESSION['user_id'])) {
			$nodepositbonus = $this->g_m->showssingle2($table = 'users', $field = 'id', $id = $_SESSION['user_id'], $select = 'nodepositbonus');
			if ($nodepositbonus['nodepositbonus'] == 1) {
				$data['cookie_ndb'] = array(
					'name' => 'ndb_acquired',
					'value' => true,
					'expire' => time() + (10 * 365 * 24 * 60 * 60),
					'domain' => '.forexmart.com',
					'secure' => true,
					'path' => '/',
					'prefix' => '',
					'httponly' => true,
				);
				$this->input->set_cookie($data['cookie_ndb'], true);
				$_SESSION['cookie_ndb'] = true;
			}
		}
		// set cookie to hide external page no deposit bonus end

	}

}
