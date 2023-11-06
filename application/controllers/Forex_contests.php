<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forex_contests extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('account_model');
		$this->lang->load('contest');
	}

	public function index(){
		redirect(FXPP::loc_url('Forex-contests/money-fall'));
	}

	public function money_fall(){
		if(strtoupper(FXPP::getUserContinentCode()) == 'EU'){
			$default_currency = 'EUR';
		}else{
			$default_currency = 'USD';
		}
		$data['data']['default_currency'] = $default_currency;
		$data['data']['active'] = 1;
		$data['data']['contest_header'] = $this->load->view('MoneyFall/contest_header', $data['data'], TRUE);
		$data['data']['registration_link'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
		$data['data']['isAutoScroll'] = false;

		$start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
		$end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
		$contest_data = $this->account_model->getContestWinners( $start_date, $end_date );
		if($contest_data){
			$rank = 0;
			$prev_value = 0;

			$start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
			$end_dates = date('Y-m-d 23:59:59', strtotime($start_dates . ' +4 days'));

			foreach($contest_data as $key => $value){
				if($prev_value <> $value['amount']){
					$rank++;
					$prev_value = $value['amount'];
				}

				$country_name = $this->g_m->getCountries($value['country']);
				if(!is_array($country_name)){
					if($country_name){
						$contest_data[$key]['country_name'] = $country_name;
					}else{
						$contest_data[$key]['country_name'] = '';
					}
				}else{
					$contest_data[$key]['country_name'] = '';
				}
				$contest_data[$key]['rank'] = $rank;
				$contest_data[$key]['start_end'] = date("m/d/Y", strtotime($start_dates))." - ". date("m/d/Y", strtotime($end_dates));
			}
		}
		$data['data']['rankings'] = $contest_data;

		$this->template->title(lang('ran_tit'))
			->append_metadata_css("
                       <link rel='stylesheet' href='".$this->template->Css()."contestpage.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."fonts.min.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."bootstrap-datetimepicker.css'>
                 ")
			->append_metadata_js("
                        <script src='".$this->template->Js()."jquery.validate.js'></script>
                         <script type='text/javascript'>
                                $(document).ready(function(){
                                     $('#PublicRatings a').addClass('active');
                                     $('#tab0').removeClass('active');
                                        $('#tab1').addClass('active');
                                     $('#tab2').removeClass('active');
                                     $('#tab3').removeClass('active');
                                 });
                         </script>
                                  <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                       <script src='".$this->template->Js()."jquery.dataTables.js'></script>
                       <script src='".$this->template->Js()."Moment.js'></script>
                       <script src='".$this->template->Js()."bootstrap-datetimepicker.min.js'></script>
                       <script src='".$this->template->Js()."dataTables.bootstrap.js'></script>
                    ")
			->set_layout('external/main')
			->build('MoneyFall/rankings',$data['data']);
	}
}
