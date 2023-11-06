<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Money_fall_registration extends MY_Controller {

	private $country_code;

	function __construct(){
		parent::__construct();
		$this->lang->load('moneyfallregistration');
		$this->lang->load('FxMailer_lang');
		$this->country_code = FXPP::getUserCountryCode() or null;
	}

	public function index(){
		require_once APPPATH . '/helpers/recaptchalib_helper.php';
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
		$this->load->library('form_validation');

		$this->load->model('General_model');
		$this->g_m = $this->General_model;

		$this->form_validation->set_rules('FullName', 'FullName', 'trim|required|xss_clean|callback_character_check');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean|callback_character_check');
		$this->form_validation->set_rules('NickName', 'NickName', 'trim|required|xss_clean|callback_character_check');
		$this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean|callback_character_check');

		$this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean|callback_character_check');
		$this->form_validation->set_rules('swapfree', 'swapfree', 'trim|xss_clean');

		$data['data']['custom_validation_success'] = '';
		$data['data']['custom_validation'] = '';
		$data['data']['custom_validation1'] = '';

		$data['data']['uniquefields'] = $this->g_m->showsfields($table = 'contestmoneyfall', 'FullName,Email,NickName');
		$data['data']['uniqueFullName'] = array();
		$data['data']['uniqueEmail'] = array();
		$data['data']['uniqueNickName'] = array();

		$data['data']['insertsuccess'] = false;

		$data['return_insert'] = false;
		foreach ($data['data']['uniquefields'] as $key => $value) {
			array_push($data['data']['uniqueNickName'], $value['NickName']);
		}

		if ($this->form_validation->run()) {
			if ($_POST["g-recaptcha-response"]) {

				if (in_array($this->input->post('NickName',true), $data['data']['uniqueNickName'])) {
					$data['data']['custom_validation'].='NickName has already been used.';
				}

				if ($data['data']['custom_validation'] == '') {

					$data['data']['gencode'] = $this->GetCodevalidate(6);
					$data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
					$data['insert'] = array(
						'FullName' => $data['data']['Fullname'] = $this->input->post('FullName',true),
						'Email' => $this->input->post('Email',true),
						'NickName' => $this->input->post('NickName',true),
						'Country' => $this->input->post('Country',true),
						'City' => $this->input->post('City',true),
						'PhoneNumber' => $this->input->post('PhoneNumber',true),
						'SwapFree' => $this->input->post('swapfree',true),
						'Code' => $data['data']['gencode'],
						'date_created' => $data['DateUp']->format('Y-m-d H:i:s')
					);

					$data['return_insert'] = $this->g_m->insertmy($table = "contestmoneyfall", $data['insert']);
				}

				if ($data['return_insert'] != false) {
					$data['insert'] = array(
						'Title' => lang('fxpp-7115-tit'),
						'FullName' => $this->input->post('FullName',true),
						'Code' => $data['data']['gencode'],
						'Email' => $this->input->post('Email',true)
					);
					Fx_mailer::MoneyFallRegistrationCode($data['insert']);
					$data['data']['insertsuccess'] = true;
				}
			} else {
				$data['data']['custom_validation1'].='Please verify reCAPTCHA';
			}
		} else {

		}


//		if(IPLoc::Office()){
			$data['data']['countries'] = $this->general_model->getAllCountries();
//		}else {
//			$data['data']['countries'] = $this->general_model->getCountries();
//		}
		//unset($data['data']['countries']['KP'], $data['data']['countries']['US'], $data['data']['countries']['MM'], $data['data']['countries']['SD'], $data['data']['countries']['SY']);
		/* country list and code */
		$data['data']['countries'] = $this->general_model->selectOptionList($data['data']['countries'], $this->country_code);

		$data['data']['calling_code'] = $this->general_model->getCallingCode($this->country_code);
		$data['data']['country_code'] = $this->country_code;
		/* country list and code coding close */
		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		$data['data']['metadata_description'] = '';
		$data['data']['metadata_keyword'] = 'ForexMart Money Fall';

		$data['data']['Operations'] = true;
//		$data['data']['PermitIP'] = IPLoc::IsPermittedIPDemoAccountContest();
		$data['data']['PermitIP'] = true;
		$js = $this->template->Js();
		$data['data']['metadata_description'] = lang('cmf_reg_dsc');
		$data['data']['metadata_keyword'] = lang('cmf_reg_kew');
		$this->template->title(lang('cmf_reg_tit'))
			->append_metadata_css("
                ")
			->append_metadata_js("
                      <script src='https://www.google.com/recaptcha/api.js'></script>
                      <script src='" . $js . "jquery.validate.min.js'></script>
                           <script src='" . $js . "pwstrength.js'></script>
                      <script type='text/javascript'>
                        $(document).ready(function(){
                            $('#tab0').addClass('active');
                              $('.registerlink').css('visibility','hidden');
                        });
                         $(document).on('change','#countrylist',function(){
							 var CName=$(this).val();
							 $.post('get-country-code',{CName:CName},function(view){ $('#PhoneNumber').val(view);});
							 $.ajax({
								type: 'POST',
								url: '" . base_url() . "register/checkCountryLimit',
								data: {country: $(this).val()},
								dataType: 'json',
								beforeSend: function(){
									$('#loader-holder').show();
								},
								success: function(response){
									if( response.banned ){
										$('#btnSubmit').attr('disabled', 'disabled');
										$('#register_restrict').modal('show');
									}else{
										$('#btnSubmit').removeAttr('disabled');
									}
									$('#loader-holder').hide();
								},
								error: function (xhr, ajaxOptions, thrownError) {
									$('#loader-holder').hide();
								}
							});
                         });
                      </script>
                ")
			->set_layout('external/main')
			->build('external_MoneyFallRegistration', $data['data']);
	}

	private function GetCodevalidate($length) {
		$loopcode = true;
		do {
			$key = '';
			$keys = array_merge(range(0, 9));

			for ($i = 0; $i < $length; $i++) {
				$key .= $keys[array_rand($keys)];
			}

			$loopcode = $this->g_m->showlike2($table = 'contestmoneyfall', $field = 'Code', $id = $key, $select = "Code");
		} while ($loopcode == true);


		return $key;
	}
	public  function character_check($str){

			if(preg_match('/[^a-zA-Z 0123456789 аБбвГгДдЕе�?ёЖжЗзИиЙйКкЛлмнПптУуФфХхЦцЧчШшЩщЪъЫыЬьЭ�?ЮюЯ�? !"#$%&()*+,\ :;?{}~@`
ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥ƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“�?–—˜™š›œŸ¨©®¯³´¸¹¾À�?ÂÃÄÅÈÉÊËÌ�?Î�?�?ÒÓÔÕÖ×ØÙÚÛÜ�?Þãðõ÷øüýþ.-_\-\_]/i', $str)){
				$this->form_validation->set_message( 'character_check', lang('validate_engrus1'). ' %s ' .lang('validate_engrus2') );
				return FALSE;
			}else{
				return TRUE;
			}


	}
}
