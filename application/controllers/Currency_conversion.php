<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_conversion extends MY_Controller {

	public function index(){
		error_reporting(-1);
		$this->lang->load('currencyconversion');

		$data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

		$data['data']['countries'] = $this->general_model->getCurrencyV2();

		unset($data['data']['countries']['GGP']);
		unset($data['data']['countries']['TRL']);
		unset($data['data']['countries']['ANG']);
		unset($data['data']['countries']['MZN']);
		unset($data['data']['countries']['JEP']);
		unset($data['data']['countries']['IMP']);
		unset($data['data']['countries']['GHC']);
		unset($data['data']['countries']['EEK']);
		unset($data['data']['countries']['XCD']);
		unset($data['data']['countries']['TVD']);
		unset($data['data']['countries']['VEF']);

		//$data['data']['metadata_description'] = lang('x_curcon_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('x_curcon_kew');
		$this->template->title(lang('x_curcon_tit'))
			->append_metadata_css('
                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2-bootstrap.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
                  <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">
                 ')
			->append_metadata_js('
                <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
                <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
                <script src="' . $this->template->Js() . 'select2.js" type="text/javascript"></script>
                <script src="' . $this->template->Js() . 'Moment.js" type="text/javascript"></script>
                <script src="' . $this->template->Js() . 'bootstrap-datetimepicker.min.js" ></script>
                <script src="' . $this->template->Js() . 'canvasjs.min.js" ></script>
            ')
			->set_layout('external/main')
			->build('external_CurrencyConversion', $data['data']);
	}

	public function apiquotes2() {
		ini_set('max_execution_time', 300);
		if (!$this->input->is_ajax_request()) {
			die('Not authorized!');
		}
		$contents = '';

		$date = str_replace("/", "", $this->input->post('date',true));
		$handle = fopen('https://finance.yahoo.com/connection/currency-converter-cache?date=' . $date . '', 'r');
		//YYYYMMDD
		while (!feof($handle)) {
			$contents .= fread($handle, 8192);
		}
		fclose($handle);

		$contents = str_replace('/**/YAHOO.Finance.CurrencyConverter.addConversionRates(', '', $contents);
		$contents = str_replace(');', '', $contents);
		$obj = json_decode($contents, true);

		$from = $this->input->post('from',true);

		$count = 0;
		if ($from == 'USD') {
			$fromprice = 1;
			$count = $count + 1;
		}

		$to = $this->input->post('to',true);

		if ($to == 'USD') {
			$toprice = 1;
			$count = $count + 1;
		}

		foreach ($obj['list']['resources'] as $key0 => $value0) {
			$data['data']['date2'] = $value0['resource']['fields']['date'];
			if ($from != 'USD') {
				if ($from . '=X' == $value0['resource']['fields']['symbol']) {
					$fromprice = $value0['resource']['fields']['price'];
					$data['data'][$from] = $value0['resource']['fields']['price'];
					$count = $count + 1;
				}
			}
			if ($to != 'USD') {
				if ($to . '=X' == $value0['resource']['fields']['symbol']) {
					$toprice = $value0['resource']['fields']['price'];
					$data['data'][$to] = $value0['resource']['fields']['price'];

					$count = $count + 1;
				}
			}
			if ($count == 2) {
				$data['data']['date'] = $value0['resource']['fields']['utctime'];
				break;
			}
		}

		$data['data']['value'] = $toprice * (1 / $fromprice);
        list($chart, $AveOpen, $AveHigh, $AveLow, $AveClose, $MaxHigh, $MinHigh, $MaxLow, $MinLow, $LastDate, $table, $aveclosehigh, $avecloselow) = self::historicalxch($from_cur = $from, $to_cur = $to, $to_date = $this->input->post('date',true));

        $data['data']['chart'] = $chart;
        $data['data']['Open'] = $AveOpen;
        $data['data']['High'] = $AveHigh;
        $data['data']['Low'] = $AveLow;

        $data['data']['Close'] = $AveClose;
        $data['data']['AverageCloseHigh'] = $aveclosehigh;
        $data['data']['AverageCloseLow'] = $avecloselow;

        $data['data']['MaxHigh'] = $MaxHigh;
        $data['data']['MinHigh'] = $MinHigh;
        $data['data']['MaxLow'] = $MaxLow;
        $data['data']['MinLow'] = $MinLow;
        $data['data']['LastDate'] = $LastDate;
        $data['data']['table'] = $table;


		echo json_encode($data['data']);

		exit;
	}
	public function historicalxch($from_cur = '', $to_cur = '', $to_date = '') {
		$data['table'] = '';
		$data['TotalOpen'] = '';
		$data['TotalHigh'] = '';
		$data['TotalLow'] = '';
		$data['TotalClose'] = '';

		$end = DateTime::createFromFormat('Y/d/m', $to_date);

		$now = new DateTime();

		$to_dateDay = DateTime::createFromFormat('Y/d/m', $to_date);

		if ($now->format('Y-m-d') == $to_dateDay->format('Y-m-d')) { // current date is equal to post date use exchange yesterday because today exchange is not yet available
			$end->sub(new DateInterval('P1D'));
		}

		if ($to_dateDay->format('D') == 'Sat') {   // no exhange rate in saturday use friday
			$end->sub(new DateInterval('P1D'));
		} else if ($to_dateDay->format('D') == 'Sun') { // no exhange rate in sunday use friday
			$end->sub(new DateInterval('P2D'));
		}

		$begin = new DateTime($end->format("Y-m-d"));
		$begin->sub(new DateInterval('P90D'));

		$cur1 = $from_cur;
		$cur2 = $to_cur;

		$handle = '';
		$contents = '';

		if ($cur1 != 'USD') {
			$handle = fopen('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22' . $cur1 . '%3DX%22%20and%20startDate%20%3D%20%22' . $begin->format("Y-m-d") . '%22%20and%20endDate%20%3D%20%22' . $end->format("Y-m-d") . '%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=', 'r');

			while (!feof($handle)) {
				$contents .= fread($handle, 8192);
			}

			fclose($handle);

			$obj0 = json_decode($contents, true);
			$cur1_history = $obj0['query']['results']['quote'];
			$cur1_history = array_reverse($cur1_history, true);
		}
//var_dump($handle);die();
		$handle = '';
		$contents = '';
		if ($cur2 != 'USD') {

			$handle = fopen('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22' . $cur2 . '%3DX%22%20and%20startDate%20%3D%20%22' . $begin->format("Y-m-d") . '%22%20and%20endDate%20%3D%20%22' . $end->format("Y-m-d") . '%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=', 'r');

			while (!feof($handle)) {
				$contents .= fread($handle, 8192);
			}

			fclose($handle);


			$obj1 = json_decode($contents, true);
			$cur2_history = $obj1['query']['results']['quote'];
			$cur2_history = array_reverse($cur2_history, true);
		}


		$ctr = 0;

		$data_points = array();
		if ($cur1 != 'USD' and $cur2 != 'USD') {
			foreach ($cur2_history as $k => $v) {


				$point = array('x' => $v['Date'], 'y' => (1 / $cur1_history[$ctr]['Close']) * $v['Close']);

				array_push($data_points, $point);
				$data['TotalOpen'] = $data['TotalOpen'] + (1 / $cur1_history[$ctr]['Open']) * $v['Open'];
				$data['TotalHigh'] = $data['TotalHigh'] + (1 / $cur1_history[$ctr]['High']) * $v['High'];
				$data['TotalLow'] = $data['TotalLow'] + (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
				$data['TotalClose'] = $data['TotalClose'] + (1 / $cur1_history[$ctr]['Close']) * $v['Close'];

				$data['ArrayHigh'][$k] = (1 / $cur1_history[$ctr]['High']) * $v['High'];
				$data['ArrayLow'][$k] = (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
				$data['ArrayClose'][$k] = (1 / $cur1_history[$ctr]['Close']) * $v['Close'];
				$data['table'].='<tr>';
				$data['table'].='<td>' . $v['Date'] . '</td>';
				$data['table'].='<td>' . (1 / $cur1_history[$ctr]['Close']) * $v['Close'] . '</td>';
				$data['table'].='</tr>';

				$ctr = $ctr + 1;
			}
		} else if ($cur1 == 'USD') {
			foreach ($cur2_history as $k => $v) {

				$point = array('x' => $v['Date'], 'y' => (1 / 1) * $v['Close']);
				array_push($data_points, $point);
				$data['TotalOpen'] = $data['TotalOpen'] + (1 / 1) * $v['Open'];
				$data['TotalHigh'] = $data['TotalHigh'] + (1 / 1) * $v['High'];
				$data['TotalLow'] = $data['TotalLow'] + (1 / 1) * $v['Low'];
				$data['TotalClose'] = $data['TotalClose'] + (1 / 1) * $v['Close'];

				$data['ArrayHigh'][$k] = (1 / 1) * $v['High'];
				$data['ArrayLow'][$k] = (1 / 1) * $v['Low'];
				$data['ArrayClose'][$k] = (1 / 1) * $v['Close'];
				$data['table'].='<tr>';
				$data['table'].='<td>' . $v['Date'] . '</td>';
				$data['table'].='<td>' . (1 / 1) * $v['Close'] . '</td>';
				$data['table'].='</tr>';
				$ctr = $ctr + 1;
			}
		} else {
			foreach ($cur1_history as $k => $v) {

				$point = array('x' => $v['Date'], 'y' => (1 / $v['Close']) * 1);
				array_push($data_points, $point);
				$data['TotalOpen'] = $data['TotalOpen'] + (1 / $cur1_history[$ctr]['Open']) * $v['Open'];
				$data['TotalHigh'] = $data['TotalHigh'] + (1 / $cur1_history[$ctr]['High']) * $v['High'];
				$data['TotalLow'] = $data['TotalLow'] + (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
				$data['TotalClose'] = $data['TotalClose'] + (1 / $cur1_history[$ctr]['Close']) * $v['Close'];

				$data['ArrayHigh'][$k] = (1 / $cur1_history[$ctr]['High']) * $v['High'];
				$data['ArrayLow'][$k] = (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
				$data['ArrayClose'][$k] = (1 / $cur1_history[$ctr]['Close']) * $v['Close'];

				$data['table'].='<tr>';
				$data['table'].='<td>' . $v['Date'] . '</td>';
				$data['table'].='<td>' . (1 / $v['Close']) * 1 . '</td>';
				$data['table'].='</tr>';
				$ctr = $ctr + 1;
			}
		}
		if ($cur1 == 'USD') {
			$data['count'] = count($cur2_history);
		} else {
			$data['count'] = count($cur1_history);
		}

		foreach ($data_points as $k => $v) {

		}

		$data['AveOpen'] = $data['TotalOpen'] / $data['count'];
		$data['AveHigh'] = $data['TotalHigh'] / $data['count'];
		$data['AveLow'] = $data['TotalLow'] / $data['count'];

		$data['AveClose'] = $data['TotalClose'] / $data['count'];

		$data['AveCloseHigh'] = max($data['ArrayClose']);
		$data['AveCloseLow'] = min($data['ArrayClose']);

		$data['MaxHigh'] = max($data['ArrayHigh']);
		$data['MinHigh'] = min($data['ArrayHigh']);

		$data['MaxLow'] = max($data['ArrayLow']);
		$data['MinLow'] = min($data['ArrayLow']);

		$data['LastDate'] = $end->format("D, M d, Y");

		return array(json_encode($data_points, JSON_NUMERIC_CHECK), $data['AveOpen'], $data['AveHigh'], $data['AveLow'], $data['AveClose'], $data['MaxHigh'], $data['MinHigh'], $data['MaxLow'], $data['MinLow'], $data['LastDate'], $data['table'], $data['AveCloseHigh'], $data['AveCloseLow']);
	}
}
