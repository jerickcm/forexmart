<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MY_Controller
{
    private $transaction_type = array(
        'BT' => 'Bank Transfer',
        'CC' => 'CardPay',
        'SK' => 'Skrill',
        'UP' => 'China UnionPay',
        'NT' => 'Neteller',
        'WM' => 'WebMoney',
        'PX' => 'Paxum',
        'UK' => 'Ukash',
        'PC' => 'Payco',
        'FP' => 'FILSPay',
        'CU' => 'CashU',
        'PP' => 'PayPal',
        'QW' => 'Qiwi',
        'MT' => 'MegaTransfer',
        'YM' => 'Yandex Money',
        'BC' => 'BitCoin'
    );

    function __construct()
    {
        parent::__construct();
      //  if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        if(IPLoc::Cron()) {
            $this->load->library('WebService');
        }else{
            show_404();
        }
    }

    //This function executed every 1 minute
    public function run(){
//        self::sendNoDepositClientRequest();

       // self::sendNoDepositClientRequest24();  // limited bonus offer send after 24
        self::updateContestWinners();
        //self::testDailyComplianceReport();
        //self::testDailyVerificationAutoReport();
        self::updateSpread();
    }

    public function hourly(){
        self::cashBackProgramPerHour();
    }

    public function daily(){

        self::dailyDifferentCountryReport();
        self::dailyTotalCISCountryReport();
     //   self::dailyDifferentCountryReportFull();
        self::periodicRebate(1); // daily rebate executed
      //  self::cashBackProgram(1); // Daily cashback program
        self::limited_bonus();
       
       // self::dailyCountryReportOfRussiaAndCIS();
        self::dailyCountryReportOfNetherlands();
       // self::dailyCountryReportOfUkandIreland();

        self::sendDailyAffiliatesStatisticsReport();
        self::dailyDeposit();
        self::sendAccountBalances();
        self::sendDailyComplianceReport();
        self::sendDailyVerificationAutoReport();

        self::dailyStatistics();
        self::qiwiCheck();

        self::sendDailyDepositWithdrawal();
        self::send_ndb_report_daily();



        self::activateUnsubscribedEmail();

        //Executed every Monday 7am Server Time
        if(date('D')== 'Mon'){
            self::send_ndb_report_weekly();
        }
//        self::sendDailydemoDemoGraph();

    }

    //Executed every Sunday 7am Server Time
    public function weekly(){
        self::sendWeeklyVerificationAutoReport();
        self::periodicRebate(2);
        /*FXPP-7614*/
        $this->load->library('Contestaccounts');
        Contestaccounts::weeklyreminder();
        /*FXPP-7614*/
    }

    //Executed every Friday 7am Server Time
    public function weeklyFriday(){
        //add function here
        self::ndbAndlimitedBonusReport();
    }

    //Executed every Saturday 7am Server Time
    public function weeklySaturday(){
        //add function here
        self::moneyFallContest();

    }

    //Executed every Monday 7am Server Time
    public function weeklyMonday(){
        //add function here

        self::send_ndb_report_weekly();


    }

    //Executed every First Day of the Month
    public function monthly(){
        self::sendMonthlyAccountBalances();
        self::periodicRebate(3);
        self::monthlyDeposit();
        $this->minibonus();
        self::monthlyCountryReport();

//        self::sendMonthlyVerificationAutoReport();
    }
    

    protected function updateContestWinners(){
        date_default_timezone_set('Europe/Minsk');
        $this->load->model('account_model');
        $contest_date_start =  date('Y-m-d 00:00:00', strtotime('last monday', strtotime('tomorrow')));
        $contest_date_end = date('Y-m-d 23:59:59', strtotime('friday', strtotime($contest_date_start)));
        $contest_date_end_ext = date('Y-m-d 01:00:00', strtotime($contest_date_end) . '+1 day');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));

        if( strtotime($date_now) <= strtotime($contest_date_end_ext) && strtotime($date_now) >= strtotime($contest_date_start)) {
            //Get last week monday to sunday contest registrants
            $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
            $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
            $contest_winners = $this->account_model->getContestAccountsByDateRange($start_date, $end_date);

            $webservice_config = array(
                'server' => 'demo_new'
            );
            //Update account balances
            foreach ($contest_winners as $key => $value) {
                $webservice_config = array(
                    'server' => 'demo_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->request_demo_account_balance($value['account_number']);
                if ($WebService->request_status === 'RET_OK') {
                    $amount = $WebService->get_result('Balance');
                    $this->account_model->updateAmountByAccountNumber($value['account_number'], $amount);
                }
//                if(IPLoc::isStaging()){
                $is_activated = $this->account_model->isContestAccountActivated($value['account_number']);
                if(!$is_activated){
                    $WebServiceActivate = new WebService($webservice_config);
                    $WebServiceActivate->activate_demo_account($value['account_number']);
                    if ($WebServiceActivate->request_status === 'RET_OK') {
                        $account_info = array(
                            'user_id' => $value['user_id'],
                            'date_activated' => $date_now
                        );
                        $this->account_model->setContestAccountActivated($account_info);
                    }
                }
//                }
            }

            //Get updated contest winners
            $contest_data = $this->account_model->getContestWinners( $start_date, $end_date );

            //Update winner list
            $winners = array();
            if($contest_data){
                $rank = 0;
                $prev_value = 0;
                foreach($contest_data as $key => $value){

                    if($prev_value <> $value['amount']){
                        $rank++;
                        $prev_value = $value['amount'];
                    }

                    $winners[] = array(
                        'start_date' => $contest_date_start,
                        'end_date' => $contest_date_end,
                        'user_id' => $value['user_id'],
                        'amount' => $value['amount'],
                        'currency' => $value['mt_currency_base'],
                        'account_number' => $value['account_number'],
                        'rank' => $rank,
                        'nickname' => $value['NickName']
                    );
                }
            }
            if(count($winners) > 0) {
                $this->account_model->updateCurrentWinners($contest_date_start, $winners);
            }
        }elseif(strtotime($date_now) > strtotime($contest_date_end)){
//            if(IPLoc::isStaging()) {
            $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
            $end_date = date('Y-m-d 22:59:59', strtotime($start_date . ' +6 days'));
            $accounts = $this->account_model->getContestUnclosedAccountsByEndDate($end_date);
            $rank_update = false;
            foreach($accounts as $key => $account){
                file_put_contents('/var/www/html/forexmart.com/application/logs/contest.log', '[' . $date_now . ']' . 'Contest close account: ' . $account['account_number'] . PHP_EOL, FILE_APPEND);
                $webservice_config = array(
                    'server' => 'demo_new'
                );

                $WebServiceActivate = new WebService($webservice_config);
                $WebServiceActivate->close_demo_account($account['account_number']);

                if ($WebServiceActivate->request_status === 'RET_OK') {
                    $balance = $WebServiceActivate->get_result('Balance');
                    $equity = $WebServiceActivate->get_result('Equity');
                    $completed_time = $WebServiceActivate->get_result('CompletedTime');
                    $profit_loss = $WebServiceActivate->get_result('ProfitLoss');
                    $login = $WebServiceActivate->get_result('Login');
                    $trades_closed_count = $WebServiceActivate->get_result('TradesClosedCount');
                    $account_info = array(
                        'user_id' => $account['user_id'],
                        'equity' => $equity,
                        'completed_time' => $completed_time,
                        'profit_loss' => $profit_loss,
                        'trades_closed_count' => $trades_closed_count,
                        'date_closed' => $date_now
                    );


                    $WebService = new WebService($webservice_config);
                    $WebService->request_demo_account_balance($account['account_number']);
                    if ($WebService->request_status === 'RET_OK') {
                        $amount = $WebService->get_result('Balance');
                        $this->account_model->updateAmountByAccountNumber($account['account_number'], $amount);
                    }

                    $this->account_model->setContestWinnerBalanceByAccountNumber($login, $balance);
                    $this->account_model->setContestAccountClosed($account_info);
                    $rank_update = true;
                    file_put_contents('/var/www/html/forexmart.com/application/logs/contest.log', $WebServiceActivate->request_status . PHP_EOL, FILE_APPEND);
                }else{
                    file_put_contents('/var/www/html/forexmart.com/application/logs/contest.log', $WebServiceActivate->request_status . PHP_EOL, FILE_APPEND);
                }
            }
//            }
            if($rank_update){
                $accounts = $this->account_model->getContestWinnersByDate($contest_date_start, $contest_date_end);
                $rank = 0;
                $prev_value = 0;
                foreach($accounts as $key => $account){
                    if($prev_value <> $account['amount']){
                        $rank++;
                        $prev_value = $account['amount'];
                    }
                    $this->account_model->setContestWinnerRankByAccountNumber($account['account_number'], $rank);
                }
            }
        }
    }

    public function sendWeeklyContestRegistrants(){
        date_default_timezone_set('Europe/Minsk');
        $this->load->model('account_model');
        $start_date  = date('Y-m-d 23:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
        $end_date    = date('Y-m-d 22:59:59', strtotime($start_date . ' +6 days'));
        $start_date1 = date('Y-m-d 23:00:00', strtotime("-1 day", strtotime($start_date)));
        $end_date1   = date('Y-m-d 22:59:59', strtotime($start_date . ' +6 days'));
        $contest_participants = $this->account_model->getContestAccountsByDateRange($start_date1, $end_date1);
        $contest_start_date = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
        $contest_end_date = date('Y-m-d 23:59:59', strtotime('friday', strtotime($contest_start_date)));
        $email_data = array(
            'title' => 'MF Contest Participants [' . date('m/d/Y', strtotime($contest_start_date)) . ' - ' . date('m/d/Y', strtotime($contest_end_date)) . ']',
            'contest_participants' => $contest_participants,
            'contest_start_date' => $start_date,
            'contest_end_date' => $end_date
        );

        $config = array(
            'mailtype'=> 'html'
        );
        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);
        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        // $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('MF_participants@forexmart.com');
        // $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        // $this->email->to('vela.nightclad@gmail.com');
        // $this->email->to('sm491159@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/weekly_contest_registrants', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }

    public function sendManualWeeklyContestRegistrants(){
        date_default_timezone_set('Europe/Minsk');
        $this->load->model('account_model');
        $start_date  = '2017-01-23 00:00:00';
        $end_date    = date('Y-m-d 22:59:59', strtotime($start_date . ' +6 days'));
        $start_date1 = '2017-01-23 00:00:00';
        $end_date1   = date('Y-m-d 22:59:59', strtotime($start_date1 . ' +6 days'));
        $contest_participants = $this->account_model->getContestAccountsByDateRange($start_date1, $end_date1);
        $contest_start_date = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
        $contest_end_date = date('Y-m-d 23:59:59', strtotime('friday', strtotime($contest_start_date)));
        $email_data = array(
            'title' => 'MF Contest Participants [' . date('m/d/Y', strtotime($contest_start_date)) . ' - ' . date('m/d/Y', strtotime($contest_end_date)) . ']',
            'contest_participants' => $contest_participants,
            'contest_start_date' => $start_date,
            'contest_end_date' => $end_date
        );

        $config = array(
            'mailtype'=> 'html'
        );
        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);
        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        // $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('MF_participants@forexmart.com');
        // $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//         $this->email->to('vela.nightclad@gmail.com');
        // $this->email->to('sm491159@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/weekly_contest_registrants', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }

    protected function sendDailyComplianceReport(){
        $this->load->model('account_model');
        $this->load->model('user_model');
        $this->load->model('partnership_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        //Get Records for the last 24 hours
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $opened_client_accounts_day = $this->account_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_partner_accounts_day = $this->partnership_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_accounts_day = $opened_client_accounts_day + $opened_partner_accounts_day;

        $uploaded_client_documents_day = $this->account_model->getVerificationDocumentsCountByDate($date_last_day, $date_now);
        $uploaded_partner_documents_day = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_day, $date_now);
        $uploaded_documents_day = $uploaded_client_documents_day + $uploaded_partner_documents_day;

        $old_uploaded_client_documents_day = $this->account_model->getVerificationDocumentsCountByDate($date_last_day, $date_now, true);
        $old_uploaded_partner_documents_day = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_day, $date_now, true);
        $old_uploaded_documents_day = $old_uploaded_client_documents_day + $old_uploaded_partner_documents_day;

        $accounts_client_verified_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 1);
        $accounts_partner_verified_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 1);
        $accounts_verified_day = $accounts_client_verified_day + $accounts_partner_verified_day;

        $accounts_client_pending_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 0);
        $accounts_partner_pending_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 0);
        $accounts_pending_day = $accounts_client_pending_day + $accounts_partner_pending_day;

        $accounts_client_declined_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 2);
        $accounts_partner_declined_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 2);
        $accounts_declined_day = $accounts_client_declined_day + $accounts_partner_declined_day;

        //Get Records for the last week
        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $opened_client_accounts_week = $this->account_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_partner_accounts_week = $this->partnership_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_accounts_week = $opened_client_accounts_week + $opened_partner_accounts_week;

        $uploaded_client_documents_week = $this->account_model->getVerificationDocumentsCountByDate($date_last_week, $date_now);
        $uploaded_partner_documents_week = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_week, $date_now);
        $uploaded_documents_week = $uploaded_client_documents_week + $uploaded_partner_documents_week;

        $old_uploaded_client_documents_week = $this->account_model->getVerificationDocumentsCountByDate($date_last_week, $date_now, true);
        $old_uploaded_partner_documents_week = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_week, $date_now, true);
        $old_uploaded_documents_week = $old_uploaded_client_documents_week + $old_uploaded_partner_documents_week;

        $accounts_client_verified_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 1);
        $accounts_partner_verified_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 1);
        $accounts_verified_week = $accounts_client_verified_week + $accounts_partner_verified_week;

        $accounts_client_pending_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 0);
        $accounts_partner_pending_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 0);
        $accounts_pending_week = $accounts_client_pending_week + $accounts_partner_pending_week;

        $accounts_client_declined_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 2);
        $accounts_partner_declined_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 2);
        $accounts_declined_week = $accounts_client_declined_week + $accounts_partner_declined_week;

        //Get Records for the last month
        $date_last_month =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 month'));
        $opened_client_accounts_month = $this->account_model->getAccountsCountByDateRange($date_last_month, $date_now);
        $opened_partner_accounts_month = $this->partnership_model->getAccountsCountByDateRange($date_last_month, $date_now);
        $opened_accounts_month = $opened_client_accounts_month + $opened_partner_accounts_month;

        $uploaded_client_documents_month = $this->account_model->getVerificationDocumentsCountByDate($date_last_month, $date_now);
        $uploaded_partner_documents_month = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_month, $date_now);
        $uploaded_documents_month = $uploaded_client_documents_month + $uploaded_partner_documents_month;

        $old_uploaded_client_documents_month = $this->account_model->getVerificationDocumentsCountByDate($date_last_month, $date_now, true);
        $old_uploaded_partner_documents_month = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_month, $date_now, true);
        $old_uploaded_documents_month = $old_uploaded_client_documents_month + $old_uploaded_partner_documents_month;

        $accounts_client_verified_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 1);
        $accounts_partner_verified_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 1);
        $accounts_verified_month = $accounts_client_verified_month + $accounts_partner_verified_month;

        $accounts_client_pending_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 0);
        $accounts_partner_pending_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 0);
        $accounts_pending_month = $accounts_client_pending_month + $accounts_partner_pending_month;

        $accounts_client_declined_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 2);
        $accounts_partner_declined_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 2);
        $accounts_declined_month = $accounts_client_declined_month + $accounts_partner_declined_month;

        //Get All Records
        $date_last =  '2000-01-01 00:00:00';
        $opened_client_accounts = $this->account_model->getAccountsCountByDateRange($date_last, $date_now);
        $opened_partner_accounts = $this->partnership_model->getAccountsCountByDateRange($date_last, $date_now);
        $opened_accounts = $opened_client_accounts + $opened_partner_accounts;

        $uploaded_client_documents = $this->account_model->getVerificationDocumentsCountByDate($date_last, $date_now);
        $uploaded_partner_documents = $this->partnership_model->getVerificationDocumentsCountByDate($date_last, $date_now);
        $uploaded_documents = $uploaded_client_documents + $uploaded_partner_documents;

        $old_uploaded_client_documents = $this->account_model->getVerificationDocumentsCountByDate($date_last, $date_now, true);
        $old_uploaded_partner_documents = $this->partnership_model->getVerificationDocumentsCountByDate($date_last, $date_now, true);
        $old_uploaded_documents = $old_uploaded_client_documents + $old_uploaded_partner_documents;

        $accounts_client_verified = $this->account_model->getVerificationDocumentsCountByStatus($date_last, $date_now, 1);
        $accounts_partner_verified = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last, $date_now, 1);
        $accounts_verified = $accounts_client_verified + $accounts_partner_verified;

        $accounts_client_pending = $this->account_model->getVerificationDocumentsCountByStatus($date_last, $date_now, 0);
        $accounts_partner_pending = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last, $date_now, 0);
        $accounts_pending = $accounts_client_pending + $accounts_partner_pending;

        $accounts_client_declined = $this->account_model->getVerificationDocumentsCountByStatus($date_last, $date_now, 2);
        $accounts_partner_declined = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last, $date_now, 2);
        $accounts_declined = $accounts_client_declined + $accounts_partner_declined;

        $email_data = array(
            'opened_accounts_day' => $opened_accounts_day,
            'old_uploaded_documents_day' => $old_uploaded_documents_day,
            'uploaded_documents_day' => $uploaded_documents_day,
            'accounts_verified_day' => $accounts_verified_day > 0 ? ($accounts_verified_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0,
            'accounts_pending_day' => $accounts_pending_day > 0 ? ($accounts_pending_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0,
            'accounts_declined_day' => $accounts_declined_day > 0 ? ($accounts_declined_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0,
            'opened_accounts_week' => $opened_accounts_week,
            'old_uploaded_documents_week' => $old_uploaded_documents_week,
            'uploaded_documents_week' => $uploaded_documents_week,
            'accounts_verified_week' => $accounts_verified_week > 0 ? ($accounts_verified_week / ($uploaded_documents_week + $old_uploaded_documents_week)) * 100 : 0,
            'accounts_pending_week' => $accounts_pending_week > 0 ? ($accounts_pending_week / ($uploaded_documents_week + $old_uploaded_documents_week)) * 100 : 0,
            'accounts_declined_week' => $accounts_declined_week > 0 ? ($accounts_declined_week / ($uploaded_documents_week + $old_uploaded_documents_week)) * 100 : 0,
            'opened_accounts_month' => $opened_accounts_month,
            'old_uploaded_documents_month' => $old_uploaded_documents_month,
            'uploaded_documents_month' => $uploaded_documents_month,
            'accounts_verified_month' => $accounts_verified_month > 0 ? ($accounts_verified_month / ($uploaded_documents_month + $old_uploaded_documents_month)) * 100 : 0,
            'accounts_pending_month' => $accounts_pending_month > 0 ? ($accounts_pending_month / ($uploaded_documents_month + $old_uploaded_documents_month)) * 100 : 0,
            'accounts_declined_month' => $accounts_declined_month > 0 ? ($accounts_declined_month / ($uploaded_documents_month + $old_uploaded_documents_month)) * 100 : 0,
            'opened_accounts' => $opened_accounts,
            'old_uploaded_documents' => $old_uploaded_documents,
            'uploaded_documents' => $uploaded_documents,
            'accounts_verified' => $accounts_verified > 0 ? ($accounts_verified / ($uploaded_documents + $old_uploaded_documents)) * 100 : 0,
            'accounts_pending' => $accounts_pending > 0 ? ($accounts_pending / ($uploaded_documents + $old_uploaded_documents)) * 100 : 0,
            'accounts_declined' => $accounts_declined > 0 ? ($accounts_declined / ($uploaded_documents + $old_uploaded_documents)) * 100 : 0,
            'as_of_date' => $date_now
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('compliance-reports@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject('Daily Compliance Report');
        $this->email->message($this->load->view('email/daily_compliance_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function testDailyComplianceReport(){
        $this->load->model('account_model');
        $this->load->model('user_model');
        $this->load->model('partnership_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        //Get Records for the last 24 hours
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $opened_client_accounts_day = $this->account_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_partner_accounts_day = $this->partnership_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_accounts_day = $opened_client_accounts_day + $opened_partner_accounts_day;

        $uploaded_client_documents_day = $this->account_model->getVerificationDocumentsCountByDate($date_last_day, $date_now);
        $uploaded_partner_documents_day = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_day, $date_now);
        $uploaded_documents_day = $uploaded_client_documents_day + $uploaded_partner_documents_day;

        $old_uploaded_client_documents_day = $this->account_model->getVerificationDocumentsCountByDate($date_last_day, $date_now, true);
        $old_uploaded_partner_documents_day = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_day, $date_now, true);
        $old_uploaded_documents_day = $old_uploaded_client_documents_day + $old_uploaded_partner_documents_day;

        $accounts_client_verified_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 1);
        $accounts_partner_verified_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 1);
        $accounts_verified_day = $accounts_client_verified_day + $accounts_partner_verified_day;

        $accounts_client_pending_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 0);
        $accounts_partner_pending_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 0);
        $accounts_pending_day = $accounts_client_pending_day + $accounts_partner_pending_day;

        $accounts_client_declined_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 2);
        $accounts_partner_declined_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 2);
        $accounts_declined_day = $accounts_client_declined_day + $accounts_partner_declined_day;

        //Get Records for the last week
        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $opened_client_accounts_week = $this->account_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_partner_accounts_week = $this->partnership_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_accounts_week = $opened_client_accounts_week + $opened_partner_accounts_week;

        $uploaded_client_documents_week = $this->account_model->getVerificationDocumentsCountByDate($date_last_week, $date_now);
        $uploaded_partner_documents_week = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_week, $date_now);
        $uploaded_documents_week = $uploaded_client_documents_week + $uploaded_partner_documents_week;

        $old_uploaded_client_documents_week = $this->account_model->getVerificationDocumentsCountByDate($date_last_week, $date_now, true);
        $old_uploaded_partner_documents_week = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_week, $date_now, true);
        $old_uploaded_documents_week = $old_uploaded_client_documents_week + $old_uploaded_partner_documents_week;

        $accounts_client_verified_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 1);
        $accounts_partner_verified_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 1);
        $accounts_verified_week = $accounts_client_verified_week + $accounts_partner_verified_week;

        $accounts_client_pending_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 0);
        $accounts_partner_pending_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 0);
        $accounts_pending_week = $accounts_client_pending_week + $accounts_partner_pending_week;

        $accounts_client_declined_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 2);
        $accounts_partner_declined_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 2);
        $accounts_declined_week = $accounts_client_declined_week + $accounts_partner_declined_week;

        //Get Records for the last month
        $date_last_month =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 month'));
        $opened_client_accounts_month = $this->account_model->getAccountsCountByDateRange($date_last_month, $date_now);
        $opened_partner_accounts_month = $this->partnership_model->getAccountsCountByDateRange($date_last_month, $date_now);
        $opened_accounts_month = $opened_client_accounts_month + $opened_partner_accounts_month;

        $uploaded_client_documents_month = $this->account_model->getVerificationDocumentsCountByDate($date_last_month, $date_now);
        $uploaded_partner_documents_month = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_month, $date_now);
        $uploaded_documents_month = $uploaded_client_documents_month + $uploaded_partner_documents_month;

        $old_uploaded_client_documents_month = $this->account_model->getVerificationDocumentsCountByDate($date_last_month, $date_now, true);
        $old_uploaded_partner_documents_month = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_month, $date_now, true);
        $old_uploaded_documents_month = $old_uploaded_client_documents_month + $old_uploaded_partner_documents_month;

        $accounts_client_verified_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 1);
        $accounts_partner_verified_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 1);
        $accounts_verified_month = $accounts_client_verified_month + $accounts_partner_verified_month;

        $accounts_client_pending_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 0);
        $accounts_partner_pending_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 0);
        $accounts_pending_month = $accounts_client_pending_month + $accounts_partner_pending_month;

        $accounts_client_declined_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 2);
        $accounts_partner_declined_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 2);
        $accounts_declined_month = $accounts_client_declined_month + $accounts_partner_declined_month;

        //Get All Records
        $date_last =  '2000-01-01 00:00:00';
        $opened_client_accounts = $this->account_model->getAccountsCountByDateRange($date_last, $date_now);
        $opened_partner_accounts = $this->partnership_model->getAccountsCountByDateRange($date_last, $date_now);
        $opened_accounts = $opened_client_accounts + $opened_partner_accounts;

        $uploaded_client_documents = $this->account_model->getAllVerificationDocumentsCountByDate($date_last, $date_now);
        $uploaded_partner_documents = $this->partnership_model->getAllVerificationDocumentsCountByDate($date_last, $date_now);
        $uploaded_documents = $uploaded_client_documents + $uploaded_partner_documents;

        $old_uploaded_client_documents = $this->account_model->getAllVerificationDocumentsCountByDate($date_last, $date_now, true);
        $old_uploaded_partner_documents = $this->partnership_model->getAllVerificationDocumentsCountByDate($date_last, $date_now, true);
        $old_uploaded_documents = $old_uploaded_client_documents + $old_uploaded_partner_documents;

        $accounts_client_verified = $this->account_model->getAllVerificationDocumentsCountByStatus($date_last, $date_now, 1);
        $accounts_partner_verified = $this->partnership_model->getAllVerificationDocumentsCountByStatus($date_last, $date_now, 1);
        $accounts_verified = $accounts_client_verified + $accounts_partner_verified;

        $accounts_client_pending = $this->account_model->getAllVerificationDocumentsCountByStatus($date_last, $date_now, 0);
        $accounts_partner_pending = $this->partnership_model->getAllVerificationDocumentsCountByStatus($date_last, $date_now, 0);
        $accounts_pending = $accounts_client_pending + $accounts_partner_pending;

        $accounts_client_declined = $this->account_model->getAllVerificationDocumentsCountByStatus($date_last, $date_now, 2);
        $accounts_partner_declined = $this->partnership_model->getAllVerificationDocumentsCountByStatus($date_last, $date_now, 2);
        $accounts_declined = $accounts_client_declined + $accounts_partner_declined;

        $email_data = array(
            'opened_accounts_day' => $opened_accounts_day,
            'old_uploaded_documents_day' => $old_uploaded_documents_day,
            'uploaded_documents_day' => $uploaded_documents_day,
            'accounts_verified_day' => $accounts_verified_day > 0 ? ($accounts_verified_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0,
            'accounts_pending_day' => $accounts_pending_day > 0 ? ($accounts_pending_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0,
            'accounts_declined_day' => $accounts_declined_day > 0 ? ($accounts_declined_day / ($uploaded_documents_day + $old_uploaded_documents_day)) * 100 : 0,
            'opened_accounts_week' => $opened_accounts_week,
            'old_uploaded_documents_week' => $old_uploaded_documents_week,
            'uploaded_documents_week' => $uploaded_documents_week,
            'accounts_verified_week' => $accounts_verified_week > 0 ? ($accounts_verified_week / ($uploaded_documents_week + $old_uploaded_documents_week)) * 100 : 0,
            'accounts_pending_week' => $accounts_pending_week > 0 ? ($accounts_pending_week / ($uploaded_documents_week + $old_uploaded_documents_week)) * 100 : 0,
            'accounts_declined_week' => $accounts_declined_week > 0 ? ($accounts_declined_week / ($uploaded_documents_week + $old_uploaded_documents_week)) * 100 : 0,
            'opened_accounts_month' => $opened_accounts_month,
            'old_uploaded_documents_month' => $old_uploaded_documents_month,
            'uploaded_documents_month' => $uploaded_documents_month,
            'accounts_verified_month' => $accounts_verified_month > 0 ? ($accounts_verified_month / ($uploaded_documents_month + $old_uploaded_documents_month)) * 100 : 0,
            'accounts_pending_month' => $accounts_pending_month > 0 ? ($accounts_pending_month / ($uploaded_documents_month + $old_uploaded_documents_month)) * 100 : 0,
            'accounts_declined_month' => $accounts_declined_month > 0 ? ($accounts_declined_month / ($uploaded_documents_month + $old_uploaded_documents_month)) * 100 : 0,
            'opened_accounts' => $opened_accounts,
            'old_uploaded_documents' => $old_uploaded_documents,
            'uploaded_documents' => $uploaded_documents,
            'accounts_verified' => $accounts_verified > 0 ? ($accounts_verified / ($uploaded_documents + $old_uploaded_documents)) * 100 : 0,
            'accounts_pending' => $accounts_pending > 0 ? ($accounts_pending / ($uploaded_documents + $old_uploaded_documents)) * 100 : 0,
            'accounts_declined' => $accounts_declined > 0 ? ($accounts_declined / ($uploaded_documents + $old_uploaded_documents)) * 100 : 0,
            'as_of_date' => $date_now
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('compliance-reports@forexmart.com');
//        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject('Daily Compliance Report');
        $this->email->message($this->load->view('email/daily_compliance_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDailyAffiliatesStatisticsReport(){

           // $user_id = $this->session->userdata('user_id');
       // $aff = array('JSMUI','SEZPP','CJVMD','SJFTQ','VTJZV','MIRXG','EBLRV','HOEIZ','WMBZP','ODAZE','SSEOT','MFDCN','SYNAM','NKKLH','YQNKI','CDOBA','JLGNR','KTVDM','YFURM','HEVGG','JYUOR', 'NODEP');

        $arr = array('dep30','JSMUI','HEVGG','JYUOR','KTVDM','YFURM','MJLHV','VYPHE','ZAGJU','KMSdep30','s_hol_zar','s_hol_ter','s_hol_akc','s_hol_par','s_tep_for','s_hol_opt','p_bezdep','p_bons','p_hol_zar','p_hol_ter','p_hol_opt');

        $arr2 = array('SEZPP','CJVMD','SJFTQ','VTJZV','MIRXG','EBLRV','HOEIZ','WMBZP','ODAZE','SSEOT','MFDCN','SYNAM','NKKLH','YQNKI','CDOBA','JLGNR');

            $this->load->model('account_model');
            $date_created = date('Y-m-d', strtotime('yesterday'));
             $table = "";
            foreach($arr as $d){
                $insert_data['referrals'] = $this->account_model->getReferralByCode($d, $date_created);
                $insert_data['code1']= $d;
                $table = $table. $this->load->view('email/affliates_statistics',$insert_data,true);
            }

           // $insert_data['email'] = "ad-stats@forexmart.com";
        $insert_data['email'] = "ad-stats_2@forexmart.com";
            $insert_data['subject']  = "Ad Ref Statistics for ".date('d/m/Y', strtotime($date_created));
            $insert_data['table'] = $table;

        $this->sendAffiliatesStatics($insert_data);


        $table = "";
        foreach($arr2 as $d){
            $insert_data['referrals'] = $this->account_model->getReferralByCode($d, $date_created);
            $insert_data['code1']= $d;
            $table = $table. $this->load->view('email/affliates_statistics',$insert_data,true);
        }

       // $insert_data['email'] = "ad-stats@forexmart.com";
        $insert_data['email'] = "ad-stats_1@forexmart.com";
        $insert_data['subject']  = "Ad Ref Statistics for ".date('d/m/Y', strtotime($date_created));
        $insert_data['table'] = $table;

        $this->sendAffiliatesStatics($insert_data);



    }

    private function sendAffiliatesStatics($insert_data){
        $this->load->library('email');
        $config = array('mailtype'=> 'html' );
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        // $this->email->to('moniruzzaman-it@itgrowtech.com');
        $this->email->to($insert_data['email']);

       $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');
      //  $this->email->bcc('moniruzzaman-it@itgrowtech.com');

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/affiliates_statistics-html', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendTop10RealAcc(){

        $user_id = $this->session->userdata('user_id');
        $this->load->model('account_model');
        $insert_data['referrals'] = $this->account_model->getAccTop10ByCountry(1);
        $insert_data['country'] = $this->general_model->getCountries();

        $insert_data['email'] = "fin-stats@forexmart.com";
        //$insert_data['email'] = "moniruzzaman-it@itgrowtech.com";
        $insert_data['subject']  = "Chart of all REAL accounts from TOP 10 countries";
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to($insert_data['email']);
        $this->email->cc('agus@zondertag.net,bug.fxpp@gmail.com');

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/top10_country', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

        // $this->general_model->sendEmail('affiliates_statistics-html',$insert_data['subject'], $insert_data['email'], $insert_data,$config);
        // print_r($insert_data);


    }
    public function sendTop10DemoAcc(){

        $user_id = $this->session->userdata('user_id');
        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['referrals'] = $this->account_model->getAccTop10ByCountry(0);
        $insert_data['country'] = $this->general_model->getCountries();

         $insert_data['email'] = "fin-stats@forexmart.com";
        //$insert_data['email'] = "moniruzzaman-it@itgrowtech.com";
        $insert_data['subject']  = "Chart of all DEMO accounts from TOP 10 countries";
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to($insert_data['email']);
        $this->email->cc('agus@zondertag.net,bug.fxpp@gmail.com');

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/top10_country', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

        // $this->general_model->sendEmail('affiliates_statistics-html',$insert_data['subject'], $insert_data['email'], $insert_data,$config);
        // print_r($insert_data);


    }

    public function sendRegisteredAccounts(){
        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['country'] = $this->general_model->getCountries();
        $insert_data['country']["GB','IE"] = "UK and Ireland ";

        $date_now = date('Y-m-d', strtotime(' -1 day'));
        $countries = array(
            'ES',
//            'DE'
        );

        foreach($countries as $country) {
            $accounts = $this->account_model->getRegisteredAccountsByCountry($date_now, $country);
            $insert_data['subject']  = "Clients from ".$insert_data['country'][$country]." as of  ".date('Y-m-d', strtotime(' -1 day'));
            $email_data = array(
                'accounts' => $accounts,
                'country' => $insert_data['country'][$country],
                'as_of_date' => $date_now
            );

            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('bug.fxpp@gmail.com');
            $this->email->subject($insert_data['subject']);
            $this->email->message($this->load->view('email/daily_registered_accounts', $email_data, TRUE));
            if($this->email->send()){
                echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }
        }
    }

    // send daily Greece + Cyprus country report
    public function dailyDifferentCountryReport(){

        set_time_limit(180);
        $country = array('SK','ES','FR',"AT','DE",'PL','CZ','BG','CA');
        foreach($country as $d){
            $this->dailyCountryReport($d);
            echo "country ".$d."<br>";

        }

        $this->sendOneTimeReport2();

    }
    public function dailyDifferentCountryReportFull(){

        set_time_limit(180);
        $country = array('SK','ES','FR','DE','PL','CZ','NL','GB','IE'); //,'BG'
        foreach($country as $d){
            $this->dailyCountryReportFull($d);
            echo "country ".$d."<br>";

        }



    }

    public function dailyDifferentCountryAustriaGermany(){

        set_time_limit(180);
        $country = array("AT','DE"); //,'BG'
        foreach($country as $d){
            $this->dailyCountryReportFull($d);
            echo "country ".$d."<br>";

        }



    }
    public function dailyCountryReportOfNetherlands(){

        set_time_limit(180);
        $country = array('NL');
        foreach($country as $d){
            $this->dailyCountryReport($d);

        }

    }
    public function dailyCountryReportOfAustriaandGermany(){

        set_time_limit(180);

            $this->dailyCountryReport("AT','DE");


    }
    public function dailyCountryReportOfUkandIreland(){

        set_time_limit(180);
        $country = array("GB','IE");
        foreach($country as $d){
            $this->dailyCountryReport($d);

        }

    }
    public function dailyCountryReportOfCanada(){

        set_time_limit(180);
        $country = array('CA');
        foreach($country as $d){
            $this->dailyCountryReport($d);

        }

    }

    public function dailyCountryReportOfRussiaAndCIS(){

        set_time_limit(180);

            $this->dailyCountryReport("AM','BY','KZ','KG','MD','RU','TJ','TM','UA','UZ");

    }


    public function dailyTotalCISCountryReport(){

        $this->load->model('account_model');
        $this->load->model('general_model');
        $config = array(
            'mailtype'=> 'html'
        );
        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }


        $insert_data['subject']  = "Total Clients from Russia and CIS on  ".date('Y-m-d', strtotime(' -1 day'));

        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //$this->email->to($insert_data['email']);
        // $this->email->to("moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com");
        //$this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com,bug.fxpp@gmail.com');



        for($i=1; $i<=5; $i++){

            if($insert_data['client_country'] = $this->account_model->dailyCISCountryReport($i))
            {
                $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
                $this->email->to("clients_russia_daily_".$i."@forexmart.com");
                $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');
                $this->email->subject( $insert_data['subject']);
                if($this->email->send()){
                    echo 'sent!';
                }else{
                    echo $this->email->print_debugger();
                }
            }

        }



    }

    public function dailyCountryReport($c_code){



        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['client_country'] = $this->account_model->dailyDifferentCountryReport($c_code);

        $insert_data['country'] = $this->general_model->getCountries();
        $insert_data['country']["GB','IE"] = "UK and Ireland ";
        $insert_data['country']["AT','DE"] = "Austria and Germany ";
        $insert_data['country']["AM','BY','KZ','KG','MD','RU','TJ','TM','UA','UZ"]="Russia and CIS";

        $to_email = array(
            "ES" => 'clients_spain_daily_1@forexmart.com',
           // "DE" =>'clients_germany_daily_1@forexmart.com',
            "AT','DE" =>'clients_germany_daily_1@forexmart.com',
            "FR" =>'clients_france_daily_1@forexmart.com',
            "GB','IE"=>'clients_ukireland_daily_1@forexmart.com',
            "BG" =>'clients_bulgaria_daily_1@Forexmart.com',
            "CA" => "clients_ukireland_daily_1@forexmart.com",
            "NL" => "clients_ukireland_daily_1@forexmart.com",
            "PL" => 'clients_poland_daily_1@forexmart.com',
            "AM','BY','KZ','KG','MD','RU','TJ','TM','UA','UZ" =>'clients_russia_daily_1@forexmart.com',
            "SK" => 'clients_czech.slovak_daily_1@forexmart.com',
            "CZ" => 'clients_czech.slovak_daily_1@forexmart.com',
            "IN" => "clients_india_daily_1@forexmart.com",
            "PK" => "clients_pakistan_daily_1@forexmart.com",
            "CF" => "clients_africa_daily_1@forexmart.com",
            "JM" => "clients_jamaica_daily_1@forexmart.com",
            "AU" => "clients_australia_daily_1@forexmart.com",
            "NZ" => "clients_australia_daily_1@forexmart.com",
            "MT" => "clients_malta_daily_1@forexmart.com",
            "SG" => "clients_singapore_daily_1@forexmart.com",
            "UZ" => "clients_uzbekistan_daily_1@forexmart.com",
            "MY" => "clients_malaysia_daily_1@forexmart.com",
            "BR" => "clients_pt_br_daily_1@forexmart.com",
            "PT" => "clients_pt_br_daily_1@forexmart.com"
        );

        /*Clients from Spain sent to clients_spain_daily_1@forexmart.com
Clients from Germany to clients_germany_daily_1@forexmart.com
France to clients_france_daily_1@forexmart.com
Greek/Cypriot to clients_greece_cyprus_daily_1@forexmart.com
Bulgaria to clients_bulgaria_daily_1@Forexmart.com
UK/Ireland to clients_ukireland_daily_1@forexmart.com*/

        // $insert_data['email'] = "fin-stats@forexmart.com";
       // $insert_data['email'] = "moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com";

        if(isset($to_email[$c_code])){
            $insert_data['email'] = $to_email[$c_code];
        }else{
            $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
        }


        $insert_data['subject']  = "Total Clients from ".$insert_data['country'][$c_code]." on  ".date('Y-m-d', strtotime(' -1 day'));
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to($insert_data['email']);
       // $this->email->to("moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com");

        if(isset($to_email[$c_code])){
            $this->email->bcc('german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com,pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com');
        }else{
           // $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
            $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');
        }

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));

            $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
            if($this->email->send()){
                echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }


    }

    public function dailyCountryReportFull($c_code){

        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['client_country'] = $this->account_model->dailyDifferentCountryReportFull($c_code);

        $insert_data['country'] = $this->general_model->getCountries();
        $insert_data['country']["GB','IE"] = "UK and Ireland ";
         $insert_data['country']["AT','DE"] = "Austria and Germany ";

        $to_email = array(
            "ES" => 'clients_spain_daily_1@forexmart.com',
           // "DE" =>'clients_germany_daily_1@forexmart.com',
            "FR" =>'clients_france_daily_1@forexmart.com',
            "GB','IE"=>'clients_ukireland_daily_1@forexmart.com',
            "AT','DE"=>'clients_germany_daily_1@forexmart.com',
            "BG" =>'clients_bulgaria_daily_1@Forexmart.com'
        );

        if(isset($to_email[$c_code])){
            $insert_data['email'] = $to_email[$c_code];
        }else{
            $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
        }


        $insert_data['subject']  = "Clients from ".$insert_data['country'][$c_code]." as of  ".date('Y-m-d', strtotime(' -1 day'));
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
       // echo $insert_data['email'];
        //$this->email->to('bug.fxpp@gmail.com');

      //  echo "<br>".$insert_data['email']."<br>";
     //  $this->email->to($insert_data['email']);
        $this->email->to('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');

        if(isset($to_email[$c_code])){
            $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com');
        }else{
            // $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
            $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com');
        }

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }



    public function sendOneTimeReport(){
        //$c_code ='SK';
        //$c_code ='FR';
        //$c_code ='FR';
        //$c_code ='BG';
       // $c_code ='DE';
        // $c_code ='PL';
        //$c_code ='CZ';
        $c_code ='CS';
        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['client_country'] = $this->account_model->oneTimeReport($c_code);
        $insert_data['country'] = $this->general_model->getCountries();

       // $insert_data['email'] = "fin-stats@forexmart.com";
        //$insert_data['email'] = "moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com";
        $insert_data['email'] = "german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
        $insert_data['subject']  = "Clients from ".$insert_data['country'][$c_code]." on  ".date('d/m/Y H:i:s');
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
      //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to($insert_data['email']);
       // $this->email->cc('bug.fxpp@gmail.com');

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }
    // send daily Greece + Cyprus country report
    public function sendOneTimeReport2(){

        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['client_country'] = $this->account_model->oneTimeReport2();
        $insert_data['country'] = $this->general_model->getCountries();

        // $insert_data['email'] = "fin-stats@forexmart.com";
        // $insert_data['email'] = "moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com";
        $insert_data['email'] = "clients_greece_cyprus_daily_1@forexmart.com";
        $insert_data['subject']  = "Clients from Greece+Cyprus on  ".date('Y-m-d', strtotime(' -1 day'));
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to($insert_data['email']);
        $this->email->bcc('german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com,pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com');
        // $this->email->cc('bug.fxpp@gmail.com');

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }

    public function weeklyAffiliateStatistics(){
        $this->load->model('account_model');
        $affiliate_code = array(
            'HEVGG',
            'JYUOR',
            'JSMUI',
            'SEZPP',
            'CJVMD',
            'SJFTQ',
            'VTJZV',
            'MIRXG',
            'EBLRV',
            'HOEIZ',
            'WMBZP',
            'ODAZE',
            'SSEOT',
            'MFDCN',
            'SYNAM',
            'NKKLH',
            'YQNKI',
            'CDOBA',
            'JLGNR',
            'KTVDM',
            'YFURM',
            'KMSdep30'
        );
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $affiliate_stat = $this->account_model->getAffiliateStatisticByCode($affiliate_code);
        $webservice_config = array('server' => 'live_new');
        foreach($affiliate_stat as $key => $value){
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'account_number' => $value['reference_num'],
                'from' => date('Y-m-d H:i:s', strtotime($date_last_week)),
                'to' => date('Y-m-d H:i:s', strtotime($date_now))
            );
            $WebService->GetAgentsCommissionByDate($account_info);
            if( $WebService->request_status === 'RET_OK' ){
                $commission_list =  $WebService->get_result('CommisionList');
                $arrayObject = new ArrayObject($commission_list);
                $commission_array = $arrayObject->getArrayCopy();
                $affiliate_stat[$key]['commission_list'] = $commission_array;
                $commission_amount = 0;
                if(count($commission_array['CommissionData']) > 0){
                    foreach( $commission_array['CommissionData'] as $com_key => $com_value ){
                        $commission_amount += $com_value->Amount;
                    }
                }
                $affiliate_stat[$key]['commission_amount'] = $commission_amount;
            }
            $stat_date_count = $this->account_model->getAffiliateStatisticLastWeekByCode($value['affiliate_code'], $date_last_week);
            $affiliate_stat[$key]['total_date_count'] = $stat_date_count['total_count'];
        }

        $email_data = array(
            'accounts' => $affiliate_stat
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
        $this->email->to('ad-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
       // $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,german.pavlyak@forexmart.com');
        $this->email->subject('Weekly Statistics');
        $this->email->message($this->load->view('email/weekly_affiliate_statistics', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function manualWeeklyAffiliateStatistics(){
        $this->load->model('account_model');
        $affiliate_code = array(
            'HEVGG',
            'JYUOR',
            'JSMUI',
            'SEZPP',
            'CJVMD',
            'SJFTQ',
            'VTJZV',
            'MIRXG',
            'EBLRV',
            'HOEIZ',
            'WMBZP',
            'ODAZE',
            'SSEOT',
            'MFDCN',
            'SYNAM',
            'NKKLH',
            'YQNKI',
            'CDOBA',
            'JLGNR',
            'KTVDM',
            'YFURM',
            'KMSdep30'
        );
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $affiliate_stat = $this->account_model->getAffiliateStatisticByCode($affiliate_code);
        $webservice_config = array('server' => 'live_new');
        foreach($affiliate_stat as $key => $value){
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'account_number' => $value['reference_num'],
                'from' => date('Y-m-d H:i:s', strtotime($date_last_week)),
                'to' => date('Y-m-d H:i:s', strtotime($date_now))
            );
            $WebService->GetAgentsCommissionByDate($account_info);
            if( $WebService->request_status === 'RET_OK' ){
                $commission_list =  $WebService->get_result('CommisionList');
                $arrayObject = new ArrayObject($commission_list);
                $commission_array = $arrayObject->getArrayCopy();
                $affiliate_stat[$key]['commission_list'] = $commission_array;
                $commission_amount = 0;
                if(count($commission_array['CommissionData']) > 0){
                    foreach( $commission_array['CommissionData'] as $com_key => $com_value ){
                        $commission_amount += $com_value->Amount;
                    }
                }
                $affiliate_stat[$key]['commission_amount'] = $commission_amount;
            }
            $stat_date_count = $this->account_model->getAffiliateStatisticLastWeekByCode($value['affiliate_code'], $date_last_week);
            $affiliate_stat[$key]['total_date_count'] = $stat_date_count['total_count'];
        }

        $email_data = array(
            'accounts' => $affiliate_stat
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com');
       // $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,german.pavlyak@forexmart.com');
        $this->email->subject('Weekly Statistics');
        $this->email->message($this->load->view('email/weekly_affiliate_statistics', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function checkWeeklyAffiliates(){
        $this->load->model('account_model');
        $affiliate_code = array(
            'HEVGG',
            'JYUOR',
            'JSMUI',
            'SEZPP',
            'CJVMD',
            'SJFTQ',
            'VTJZV',
            'MIRXG',
            'EBLRV',
            'HOEIZ',
            'WMBZP',
            'ODAZE',
            'SSEOT',
            'MFDCN',
            'SYNAM',
            'NKKLH',
            'YQNKI',
            'CDOBA',
            'JLGNR',
            'KTVDM',
            'YFURM'
        );
        $affiliate_stat = $this->account_model->getAffiliateStatisticByCode($affiliate_code);

//        $webservice_config = array('server' => 'live_new');
        foreach($affiliate_stat as $key => $value){
            echo $value['reference_num'] . '<br/>';
//            $WebService = new WebService($webservice_config);
//            $account_info = array(
//                'account_number' => $value['reference_num'],
//                'from' => date('m/d/Y H:i:s A', strtotime($date_last_week)),
//                'to' => date('m/d/Y H:i:s A', strtotime($date_now))
//            );
//            $WebService->GetAgentsCommissionByDate($account_info);
//            if( $WebService->request_status === 'RET_OK' ){
//                $commission_list =  $WebService->get_result('CommisionList');
//                $arrayObject = new ArrayObject($commission_list);
//                $commission_array = $arrayObject->getArrayCopy();
//                $affiliate_stat[$key]['commission_list'] = $commission_array;
//                $commission_amount = 0;
//                if(count($commission_array) > 0){
//                    foreach( $commission_array as $com_key => $com_value ){
//                        $commission_amount += $com_value['Amount'];
//                    }
//                }
//                $affiliate_stat[$key]['commission_amount'] = $commission_amount;
//            }
//            $stat_date_count = $this->account_model->getAffiliateStatisticLastWeekByCode($value['affiliate_code'], $date_last_week);
//            $affiliate_stat[$key]['total_date_count'] = $stat_date_count['total_count'];
        }
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $account_info = array(
            'account_number' => '101889',
            'from' => date('Y-m-d H:i:s', strtotime($date_last_week)),
            'to' => date('Y-m-d H:i:s', strtotime($date_now))
        );
        $WebService->GetAgentsCommissionByDate($account_info);
        $affiliate_stat = array();
        if( $WebService->request_status === 'RET_OK' ){
            $commission_list =  $WebService->get_result('CommisionList');
            $arrayObject = new ArrayObject($commission_list);
            $commission_array = $arrayObject->getArrayCopy();
            $affiliate_stat['commission_list'] = $commission_array;
            $commission_amount = 0;
            var_dump($commission_array['CommissionData']);
            if(count($commission_array['CommissionData']) > 0){
                foreach( $commission_array['CommissionData'] as $com_key => $com_value ){
                    $commission_amount += $com_value->Amount;
                }
            }
            echo '<br/>Amount : ' . $commission_amount;
            $affiliate_stat['commission_amount'] = $commission_amount;
        }
    }

    public function dailyDeposit(){
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('user_model');
        $this->load->model('general_model');

        $date_yesterday = date('Y-m-d H:i:s', strtotime('yesterday'));

        $top_countries = $this->deposit_model->getDepositTopCountries(5, $date_yesterday, $date_yesterday);
        $top_payment_systems = $this->deposit_model->getDepositTopPaymentSystems(5, $date_yesterday, $date_yesterday);

        foreach( $top_countries as $country_key => $country_value ){

            $country_name = $this->general_model->getCountries($country_value['country']);
            $top_countries[$country_key]['country_name'] = $country_name;
        }

//        var_dump($top_countries);
//        var_dump($top_payment_systems);

        $deposit_accounts = $this->deposit_model->getDepositAccountsByDate( $date_yesterday, $date_yesterday );

        $webservice_config = array(
            'server' => 'live_new'
        );

        $deposit_array = array();

        foreach( $deposit_accounts as $key => $value ){

            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => date('Y-m-d\T00:00:00', strtotime($date_yesterday)),
                'to' => date('Y-m-d\T23:59:59', strtotime($date_yesterday))
            );
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

            $finance_records =  $WebService->get_result('FinanceRecords');
            foreach( $finance_records->FinanceRecordData as $finance_key => $finance_data ){
                if( $finance_data->Operation == 'REAL_FUND_DEPOSIT' ){
                    $deposit_array[] = array(
                        'account_number' => $finance_data->AccountNumber,
                        'amount' => $finance_data->Amount,
                        'currency' => $value['mt_currency_base'],
                        'ticket' => $finance_data->Ticket,
                        'comment' => $finance_data->Comment,
                        'payment_date' => $finance_data->Stamp,
                        'conv_amount' => $value['conv_amount']
                    );
                }
            }
//            $result = $WebService->get_all_result();
            //$arrayObject = new ArrayObject($finance_records);
//            $arrayObject2 = get_object_vars($finance_records);
//            var_dump($arrayObject2);
//            array_merge($deposit_array, $arrayObject->getArrayCopy());
        }

        $summary_array = array();

        if(count($deposit_array) > 0){
            foreach($deposit_array as $deposit_key => $deposit_value){
                $deposit_detail = $this->deposit_model->getDepositByTicket($deposit_value['ticket']);
                if($deposit_detail){
                    $deposit_array[$deposit_key]['full_name'] = $deposit_detail['full_name'];
                    $deposit_array[$deposit_key]['payment_type'] = $deposit_detail['transaction_type'];
                }else{
                    $deposit_detail2 = $this->deposit_model->getDepositByAmount($deposit_value['account_number'], $deposit_value['amount']);
                    if($deposit_detail2){
                        $deposit_array[$deposit_key]['full_name'] = $deposit_detail2['full_name'];
                        $deposit_array[$deposit_key]['payment_type'] = $deposit_detail2['transaction_type'];
                    }else{
                        $deposit_array[$deposit_key]['full_name'] = '';
                        $deposit_array[$deposit_key]['payment_type'] = '';
                        unset($deposit_array[$deposit_key]);
                    }
                }
            }

            foreach($deposit_array as $deposit_key => $deposit_value) {
                if (!$this->user_model->isUserTestByAccountNumber($deposit_value['account_number'])) {
                    $mt_comment = substr($deposit_value['comment'], 5);
                    if (!$this->user_model->isUserMicroByAccountNumber($deposit_value['account_number'])) {
                        $converted_amount = $deposit_value['amount'];
                    }else {
                        $converted_amount = $deposit_value['amount'] / 100;
                    }

                    if (!array_key_exists($mt_comment, $summary_array)) {
                        $summary_array[$mt_comment] = array(
                            'account_number' => $deposit_value['account_number'],
                            'full_name' => $deposit_value['full_name'],
                            'currency' => $deposit_value['currency'],
                            'amount' => $converted_amount,
                            'conv_amount' => $deposit_value['conv_amount'],
                            'ticket' => $deposit_value['ticket'],
                            'comment' => $deposit_value['comment'],
                            'payment_type' => $deposit_value['payment_type'],
                            'payment_date' => $deposit_value['payment_date']
                        );
                    } else {
                        $summary_array[$mt_comment]['amount'] += $converted_amount;
                        $summary_array[$mt_comment]['ticket'] .= '<br/>' . $deposit_value['ticket'];
                        $summary_array[$mt_comment]['comment'] .= '<br/>' . $deposit_value['comment'];
                    }
                }
            }
        }

        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );

        foreach($summary_array as $summary_key => $summary_value) {
            if(strtoupper($summary_value['currency']) <> 'USD'){
                $WebService = new WebService($converter_config);
                $data = array(
                    'amount' => $summary_value['amount'],
                    'from_currency' => $summary_value['currency'],
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $summary_array[$summary_key]['status'] = $WebService->request_status;
                }else{
                    $transaction_id = substr(strrchr($summary_value['comment'], "_"), 1);
                    $deposit_amount = $this->deposit_model->getDepositAmountByTransactionId($transaction_id, $summary_value['account_number']);
                    $summary_array[$summary_key]['status'] = $WebService->request_status;
                    if($deposit_amount) {
                        $converted_amount = $deposit_amount['conv_amount'];
                    }else{
                        $converted_amount = $summary_value['amount'];
                    }
                }

                $summary_array[$summary_key]['amount'] = $converted_amount;
            }
        }
//        var_dump($deposit_accounts);
        $email_data = array(
            'date_stamp' => $date_yesterday,
            'deposit_data' => $summary_array,
            'top_countries' => $top_countries,
            'top_payment_systems' => $top_payment_systems
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->to('ildar.sharipov@forexmart.com');
        $this->email->cc('german.pavlyak@forexmart.com, agus@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Daily Deposit');
        $this->email->message($this->load->view('email/daily_deposit', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyDepositManual($mode){
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('user_model');
        $this->load->model('general_model');

        $date_yesterday = '2017-02-26 00:00:00';
//        $date_yesterday = date('Y-m-d H:i:s', strtotime('yesterday'));

        $top_countries = $this->deposit_model->getDepositTopCountries(5, $date_yesterday, $date_yesterday);
        $top_payment_systems = $this->deposit_model->getDepositTopPaymentSystems(5, $date_yesterday, $date_yesterday);

        foreach( $top_countries as $country_key => $country_value ){

            $country_name = $this->general_model->getCountries($country_value['country']);
            $top_countries[$country_key]['country_name'] = $country_name;
        }

//        var_dump($top_countries);
//        var_dump($top_payment_systems);

        $deposit_accounts = $this->deposit_model->getDepositAccountsByDate( $date_yesterday, $date_yesterday );

        $webservice_config = array(
            'server' => 'live_new'
        );

        $deposit_array = array();

        foreach( $deposit_accounts as $key => $value ){

            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => date('Y-m-d\T00:00:00', strtotime($date_yesterday)),
                'to' => date('Y-m-d\T23:59:59', strtotime($date_yesterday))
            );
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

            $finance_records =  $WebService->get_result('FinanceRecords');
            foreach( $finance_records->FinanceRecordData as $finance_key => $finance_data ){
                if( $finance_data->Operation == 'REAL_FUND_DEPOSIT' ){

                    $deposit_array[] = array(
                        'account_number' => $finance_data->AccountNumber,
                        'amount' => $finance_data->Amount,
                        'currency' => $value['mt_currency_base'],
                        'ticket' => $finance_data->Ticket,
                        'comment' => $finance_data->Comment,
                        'payment_date' => $finance_data->Stamp,
                        'conv_amount' => $value['conv_amount']
                    );
                }
            }
            echo $value['account_number'] . $WebService->request_status . '<br/>';
//            $result = $WebService->get_all_result();
            //$arrayObject = new ArrayObject($finance_records);
//            $arrayObject2 = get_object_vars($finance_records);
//            var_dump($arrayObject2);
//            array_merge($deposit_array, $arrayObject->getArrayCopy());
        }

        $summary_array = array();
        var_dump($deposit_array);
        if(count($deposit_array) > 0){
            foreach($deposit_array as $deposit_key => $deposit_value){
                $deposit_detail = $this->deposit_model->getDepositByTicket($deposit_value['ticket']);
                if($deposit_detail){
                    $deposit_array[$deposit_key]['full_name'] = $deposit_detail['full_name'];
                    $deposit_array[$deposit_key]['payment_type'] = $deposit_detail['transaction_type'];
                }else{
                    $deposit_detail2 = $this->deposit_model->getDepositByAmount($deposit_value['account_number'], $deposit_value['amount']);
                    if($deposit_detail2){
                        $deposit_array[$deposit_key]['full_name'] = $deposit_detail2['full_name'];
                        $deposit_array[$deposit_key]['payment_type'] = $deposit_detail2['transaction_type'];
                    }else{
                        $deposit_array[$deposit_key]['full_name'] = '';
                        $deposit_array[$deposit_key]['payment_type'] = '';
                        unset($deposit_array[$deposit_key]);
                    }
                }
            }

            foreach($deposit_array as $deposit_key => $deposit_value) {
                if (!$this->user_model->isUserTestByAccountNumber($deposit_value['account_number'])) {
                    $mt_comment = substr($deposit_value['comment'], 5);
                    if (!$this->user_model->isUserMicroByAccountNumber($deposit_value['account_number'])) {
                        $converted_amount = $deposit_value['amount'];
                    }else {
                        $converted_amount = $deposit_value['amount'] / 100;
                    }

                    if (!array_key_exists($mt_comment, $summary_array)) {
                        $summary_array[$mt_comment] = array(
                            'account_number' => $deposit_value['account_number'],
                            'full_name' => $deposit_value['full_name'],
                            'currency' => $deposit_value['currency'],
                            'amount' => $converted_amount,
                            'conv_amount' => $deposit_value['conv_amount'],
                            'ticket' => $deposit_value['ticket'],
                            'comment' => $deposit_value['comment'],
                            'payment_type' => $deposit_value['payment_type'],
                            'payment_date' => $deposit_value['payment_date']
                        );
                    } else {
                        $summary_array[$mt_comment]['amount'] += $converted_amount;
                        $summary_array[$mt_comment]['ticket'] .= '<br/>' . $deposit_value['ticket'];
                        $summary_array[$mt_comment]['comment'] .= '<br/>' . $deposit_value['comment'];
                    }
                }
            }
        }

        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );

        foreach($summary_array as $summary_key => $summary_value) {
            if(strtoupper($summary_value['currency']) <> 'USD'){
                $WebService = new WebService($converter_config);
                $data = array(
                    'amount' => $summary_value['amount'],
                    'from_currency' => $summary_value['currency'],
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $summary_array[$summary_key]['status'] = $WebService->request_status . '|' . $summary_value['currency'];
                }else{
                    $transaction_id = substr(strrchr($summary_value['comment'], "_"), 1);
                    $deposit_amount = $this->deposit_model->getDepositAmountByTransactionId($transaction_id, $summary_value['account_number']);
                    $summary_array[$summary_key]['status'] = $WebService->request_status . '|' . $summary_value['currency'];
                    if($deposit_amount) {
                        $converted_amount = $deposit_amount['conv_amount'];
                    }else{
                        $converted_amount = $summary_value['amount'];
                    }
                }

                $summary_array[$summary_key]['amount'] = $converted_amount;
            }
        }

        print_r($summary_array);
        $email_data = array(
            'date_stamp' => $date_yesterday,
            'deposit_data' => $summary_array,
            'top_countries' => $top_countries,
            'top_payment_systems' => $top_payment_systems
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');

        if($mode == 1){
            $this->email->to('ildar.sharipov@forexmart.com');
            $this->email->cc('german.pavlyak@forexmart.com, agus@forexmart.com');
            $this->email->bcc('vela.nightclad@gmail.com');
        }else{
            $this->email->to('vela.nightclad@gmail.com');
        }

        $this->email->subject('Daily Deposit');
        $this->email->message($this->load->view('email/daily_deposit', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function monthlyDeposit(){
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('user_model');
        $this->load->model('general_model');

        $date_from = date('Y-m-01 00:00:00', strtotime('yesterday'));
        $date_to = date('Y-m-d 23:59:59', strtotime('yesterday'));

        $top_countries = $this->deposit_model->getDepositTopCountries(5, $date_from, $date_to);
        $top_payment_systems = $this->deposit_model->getDepositTopPaymentSystems(5, $date_from, $date_to);

        foreach( $top_countries as $country_key => $country_value ){

            $country_name = $this->general_model->getCountries($country_value['country']);
            $top_countries[$country_key]['country_name'] = $country_name;
        }

//        var_dump($top_countries);
//        var_dump($top_payment_systems);

        $deposit_accounts = $this->deposit_model->getDepositAccountsByDate( $date_from, $date_to );

        $webservice_config = array(
            'server' => 'live_new'
        );

        $deposit_array = array();

        foreach( $deposit_accounts as $key => $value ){

            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => date('Y-m-d\T00:00:00', strtotime($date_from)),
                'to' => date('Y-m-d\T23:59:59', strtotime($date_to))
            );
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

            $finance_records =  $WebService->get_result('FinanceRecords');
            foreach( $finance_records->FinanceRecordData as $finance_key => $finance_data ){
                if( $finance_data->Operation == 'REAL_FUND_DEPOSIT' ){
                    $deposit_array[] = array(
                        'account_number' => $finance_data->AccountNumber,
                        'amount' => $finance_data->Amount,
                        'currency' => $value['mt_currency_base'],
                        'ticket' => $finance_data->Ticket,
                        'comment' => $finance_data->Comment,
                        'payment_date' => $finance_data->Stamp,
                        'conv_amount' => $value['conv_amount']
                    );
                }
            }
//            $result = $WebService->get_all_result();
            //$arrayObject = new ArrayObject($finance_records);
//            $arrayObject2 = get_object_vars($finance_records);
//            var_dump($arrayObject2);
//            array_merge($deposit_array, $arrayObject->getArrayCopy());
        }

        $summary_array = array();
        if(count($deposit_array) > 0){
            foreach($deposit_array as $deposit_key => $deposit_value){
                $deposit_detail = $this->deposit_model->getDepositByTicket($deposit_value['ticket']);
                if($deposit_detail){
                    $deposit_array[$deposit_key]['full_name'] = $deposit_detail['full_name'];
                    $deposit_array[$deposit_key]['payment_type'] = $deposit_detail['transaction_type'];
                }else{
                    $deposit_detail2 = $this->deposit_model->getDepositByAmount($deposit_value['account_number'], $deposit_value['amount']);
                    if($deposit_detail2){
                        $deposit_array[$deposit_key]['full_name'] = $deposit_detail2['full_name'];
                        $deposit_array[$deposit_key]['payment_type'] = $deposit_detail2['transaction_type'];
                    }else{
                        $deposit_array[$deposit_key]['full_name'] = '';
                        $deposit_array[$deposit_key]['payment_type'] = '';
                        unset($deposit_array[$deposit_key]);
                    }
                }
            }

            foreach($deposit_array as $deposit_key => $deposit_value){
                if(!$this->user_model->isUserTestByAccountNumber($deposit_value['account_number'])){
                    $mt_comment = substr($deposit_value['comment'], 5);
                    if (!$this->user_model->isUserMicroByAccountNumber($deposit_value['account_number'])) {
                        $converted_amount = $deposit_value['amount'];
                    }else {
                        $converted_amount = $deposit_value['amount'] / 100;
                    }

                    if(!array_key_exists($mt_comment, $summary_array)){
                        $summary_array[$mt_comment] = array(
                            'account_number' => $deposit_value['account_number'],
                            'full_name' => $deposit_value['full_name'],
                            'currency' => $deposit_value['currency'],
                            'amount' => $converted_amount,
                            'conv_amount' => $deposit_value['conv_amount'],
                            'ticket' => $deposit_value['ticket'],
                            'comment' => $deposit_value['comment'],
                            'payment_type' => $deposit_value['payment_type'],
                            'payment_date' => $deposit_value['payment_date']
                        );
                    }else{
                        $summary_array[$mt_comment]['amount'] += $converted_amount;
                        $summary_array[$mt_comment]['ticket'] .= '<br/>' . $deposit_value['ticket'];
                        $summary_array[$mt_comment]['comment'] .= '<br/>' . $deposit_value['comment'];
                    }
                }
            }
        }

        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );

        foreach($summary_array as $summary_key => $summary_value) {
            if(strtoupper($summary_value['currency']) <> 'USD'){
                $WebService = new WebService($converter_config);
                $data = array(
                    'amount' => $summary_value['amount'],
                    'from_currency' => $summary_value['currency'],
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $summary_array[$summary_key]['status'] = $WebService->request_status . '|' . $summary_value['currency'];
                }else{
                    $transaction_id = substr(strrchr($summary_value['comment'], "_"), 1);
                    $deposit_amount = $this->deposit_model->getDepositAmountByTransactionId($transaction_id, $summary_value['account_number']);
                    $summary_array[$summary_key]['status'] = $WebService->request_status . '|' . $summary_value['currency'];
                    if($deposit_amount) {
                        $converted_amount = $deposit_amount['conv_amount'];
                    }else{
                        $converted_amount = $summary_value['amount'];
                    }
                }

                $summary_array[$summary_key]['amount'] = $converted_amount;
            }
        }
//        var_dump($deposit_accounts);
        $email_data = array(
            'deposit_data' => $summary_array,
            'top_countries' => $top_countries,
            'top_payment_systems' => $top_payment_systems,
            'header_title' => 'Monthly Deposit - ' . date('F Y', strtotime($date_from))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
//        $this->email->to('agus@forexmart.com');
        $this->email->to('ildar.sharipov@forexmart.com');
        $this->email->cc('german.pavlyak@forexmart.com, agus@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Monthly Deposit');
        $this->email->message($this->load->view('email/monthly_deposit', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function monthlyDepositManual($month, $mode){
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('user_model');
        $this->load->model('general_model');

//        $date_from = date('Y-m-01 00:00:00', strtotime('yesterday'));
//        $date_to = date('Y-m-d 23:59:59', strtotime('yesterday'));

        $date_from = date('Y-' . $month . '-01 00:00:00');
        $date_to = date('Y-m-t 00:00:00', strtotime($date_from));

        $top_countries = $this->deposit_model->getDepositTopCountries(5, $date_from, $date_to);
        $top_payment_systems = $this->deposit_model->getDepositTopPaymentSystems(5, $date_from, $date_to);

        foreach( $top_countries as $country_key => $country_value ){

            $country_name = $this->general_model->getCountries($country_value['country']);
            $top_countries[$country_key]['country_name'] = $country_name;
        }

//        var_dump($top_countries);
//        var_dump($top_payment_systems);

        $deposit_accounts = $this->deposit_model->getDepositAccountsByDate( $date_from, $date_to );

        $webservice_config = array(
            'server' => 'live_new'
        );

        $deposit_array = array();

        foreach( $deposit_accounts as $key => $value ){

            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => date('Y-m-d\T00:00:00', strtotime($date_from)),
                'to' => date('Y-m-d\T23:59:59', strtotime($date_to))
            );
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);

            $finance_records =  $WebService->get_result('FinanceRecords');
            foreach( $finance_records->FinanceRecordData as $finance_key => $finance_data ){
                if( $finance_data->Operation == 'REAL_FUND_DEPOSIT' ){
                    $deposit_array[] = array(
                        'account_number' => $finance_data->AccountNumber,
                        'amount' => $finance_data->Amount,
                        'currency' => $value['mt_currency_base'],
                        'ticket' => $finance_data->Ticket,
                        'comment' => $finance_data->Comment,
                        'payment_date' => $finance_data->Stamp,
                        'conv_amount' => $value['conv_amount']
                    );
                }
            }
//            $result = $WebService->get_all_result();
            //$arrayObject = new ArrayObject($finance_records);
//            $arrayObject2 = get_object_vars($finance_records);
//            var_dump($arrayObject2);
//            array_merge($deposit_array, $arrayObject->getArrayCopy());
        }

        $summary_array = array();
        if(count($deposit_array) > 0){
            foreach($deposit_array as $deposit_key => $deposit_value){
                $deposit_detail = $this->deposit_model->getDepositByTicket($deposit_value['ticket']);
                if($deposit_detail){
                    $deposit_array[$deposit_key]['full_name'] = $deposit_detail['full_name'];
                    $deposit_array[$deposit_key]['payment_type'] = $deposit_detail['transaction_type'];
                }else{
                    $deposit_detail2 = $this->deposit_model->getDepositByAmount($deposit_value['account_number'], $deposit_value['amount']);
                    if($deposit_detail2){
                        $deposit_array[$deposit_key]['full_name'] = $deposit_detail2['full_name'];
                        $deposit_array[$deposit_key]['payment_type'] = $deposit_detail2['transaction_type'];
                    }else{
                        $deposit_array[$deposit_key]['full_name'] = '';
                        $deposit_array[$deposit_key]['payment_type'] = '';
                        unset($deposit_array[$deposit_key]);
                    }
                }
            }

            foreach($deposit_array as $deposit_key => $deposit_value){
                if(!$this->user_model->isUserTestByAccountNumber($deposit_value['account_number'])){
                    $mt_comment = substr($deposit_value['comment'], 5);
                    $converted_amount = $deposit_value['amount'];

                    if(!array_key_exists($mt_comment, $summary_array)){
                        $summary_array[$mt_comment] = array(
                            'account_number' => $deposit_value['account_number'],
                            'full_name' => $deposit_value['full_name'],
                            'currency' => $deposit_value['currency'],
                            'amount' => $converted_amount,
                            'conv_amount' => $deposit_value['conv_amount'],
                            'ticket' => $deposit_value['ticket'],
                            'comment' => $deposit_value['comment'],
                            'payment_type' => $deposit_value['payment_type'],
                            'payment_date' => $deposit_value['payment_date']
                        );
                    }else{
                        $summary_array[$mt_comment]['amount'] += $converted_amount;
                        $summary_array[$mt_comment]['ticket'] .= '<br/>' . $deposit_value['ticket'];
                        $summary_array[$mt_comment]['comment'] .= '<br/>' . $deposit_value['comment'];
                    }
                }
            }
        }

        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );

        foreach($summary_array as $summary_key => $summary_value) {
            if(strtoupper($summary_value['currency']) <> 'USD'){
                $WebService = new WebService($converter_config);
                $data = array(
                    'amount' => $summary_value['amount'],
                    'from_currency' => $summary_value['currency'],
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $summary_array[$summary_key]['status'] = $WebService->request_status . '|' . $summary_value['currency'];
                }else{
                    $transaction_id = substr(strrchr($summary_value['comment'], "_"), 1);
                    $deposit_amount = $this->deposit_model->getDepositAmountByTransactionId($transaction_id, $summary_value['account_number']);
                    $summary_array[$summary_key]['status'] = $WebService->request_status . '|' . $summary_value['currency'];
                    if($deposit_amount) {
                        $converted_amount = $deposit_amount['conv_amount'];
                    }else{
                        $converted_amount = $summary_value['amount'];
                    }
                }

                $summary_array[$summary_key]['amount'] = $converted_amount;
            }
        }
        print_r($summary_array);
//        var_dump($deposit_accounts);
        $email_data = array(
            'deposit_data' => $summary_array,
            'top_countries' => $top_countries,
            'top_payment_systems' => $top_payment_systems,
            'header_title' => 'Monthly Deposit - ' . date('F Y', strtotime($date_from))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        if($mode == 1){
            $this->email->to('ildar.sharipov@forexmart.com');
            $this->email->cc('german.pavlyak@forexmart.com, agus@forexmart.com');
            $this->email->bcc('vela.nightclad@gmail.com');
        }else{
            $this->email->to('vela.nightclad@gmail.com');
        }
        $this->email->subject('Monthly Deposit');
        $this->email->message($this->load->view('email/monthly_deposit', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendAccountBalances(){
        $this->load->model('account_model');
        $this->load->model('user_model');

        $exclude = array(
            105469,
            101039,
            101042,
            104095,
            101043,
            104353,
            101840,
            104584,
            101821,
            105314,
            103984,
            103742,
            101028,
            105876,
            102762,
            103864,
            103626,
            104515,
            103174,
            103694
        );

        $accounts_old = $this->account_model->getAccountBalances($exclude); //get all live accounts balances
        foreach( $accounts_old as $key => $value ){
            $webservice_config = array(
                'server' => 'live_new'
            );

            $account_info = array(
                'iLogin' => $value['account_number']
            );

            $WebServiceBal = new WebService($webservice_config);
            $WebServiceBal->open_RequestAccountBalance($account_info);
            if( $WebServiceBal->request_status === 'RET_OK' ) {
                $balance = $WebServiceBal->get_result('Balance');
                $this->account_model->updateAmountByAccountNumber($value['account_number'], $balance);
            }
        }

        $accounts = $this->account_model->getAccountBalances($exclude); //get all live accounts balances
        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );
        foreach( $accounts as $key => $value ){
            if($value['micro']){
                $value['amount'] = $value['amount'] / 100;
            }

            if(strtoupper(trim($value['mt_currency_base'])) == 'USD'){
                $accounts[$key]['converted_amount'] = $value['amount'];
            } else {
                $WebService = new WebService($converter_config);
                $data = array(
                    'amount' => $value['amount'],
                    'from_currency' => $value['mt_currency_base'],
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $accounts[$key]['converted_amount'] = $converted_amount;
                }else{
                    $accounts[$key]['converted_amount'] = $value['amount'];
                }
            }

            if($accounts[$key]['converted_amount'] < 100){
                unset($accounts[$key]);
            }

            if($this->user_model->isUserTestByAccountNumber($accounts[$key]['account_number'])){
                unset($accounts[$key]);
            }
        }

        usort($accounts, function($a, $b) {
            if($a['converted_amount']==$b['converted_amount']) return 0;
            return $a['converted_amount'] < $b['converted_amount']?1:-1;
        });

        $date_now = date('Y-m-d H:i:s');
        $email_data = array(
            'accounts' => $accounts,
            'as_of_date' => $date_now
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
        $this->email->to('fin-reports@forexmart.com');
        $this->email->cc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->subject('Daily Client\'s Balances');
        $this->email->message($this->load->view('email/daily_account_balances', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendManualAccountBalances( $param = 0, $month = 1 ){

        $this->load->model('user_model');

        $webservice_config = array(
            'server' => 'live_new'
        );

//        $account_info = array(
//            'from' => '2015-11-01T00:00:00',
//            'to' => '2015-11-30T23:59:59'
//        );
        if( $param == 0 ){
            if($month == 1){
                $account_info = array(
                    'from' => '2015-11-01T00:00:00',
                    'to' => '2015-11-30T23:59:59'
                );
            }else{
                $account_info = array(
                    'from' => '2015-12-01T00:00:00',
                    'to' => '2015-12-31T23:59:59'
                );
            }
        }elseif($param == 1){
            $from = '2017-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01T00:00:00';
            $to = date('Y-m-t', strtotime($from)) . 'T23:59:59';
            $account_info = array(
                'from' => $from,
                'to' => $to
            );
        }else{
            $account_info = array(
                'from' => '2015-11-01T00:00:00',
                'to' => '2015-11-30T23:59:59'
            );
        }

        $WebServiceBal = new WebService($webservice_config);
        $WebServiceBal->get_deposits_per_account_per_day($account_info);
        $arr_balances = array();
        if( $WebServiceBal->request_status === 'RET_OK' ) {
            $balances = $WebServiceBal->get_result('WithdrawalsDepositsList');
            foreach( $balances->TotalDepositWithdrawData as $key => $balance ){

                $isUserExist = $this->user_model->checkExistingAccountNumber($balance->Account);
                if($isUserExist){
                    $isUserTest = $this->user_model->isUserTestByAccountNumber($balance->Account);
                    if(!$isUserTest){

                        if (!$this->user_model->isUserMicroByAccountNumber($balance->Account)) {
                            $balance_amount = $balance->Total;
                        }else{
                            $balance_amount = $balance->Total / 100;
                        }
                        echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance_amount . '|Real|<br/>';

                        if(array_key_exists($balance->Stamp, $arr_balances)){
                            $arr_balances[$balance->Stamp]['balance'] += $balance_amount;
                        }else{
                            $arr_balances[$balance->Stamp] = array(
                                'stamp' => $balance->Stamp,
                                'balance' => $balance_amount
                            );
                        }
                    }else{
                        echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance_amount . '|Test|<br/>';
                    }
                }else{
                    echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance_amount . '|Test|<br/>';
                }
            }
        }else{
            $WebServiceBal->request_status;
        }

        var_dump($arr_balances);
        var_dump($account_info);
//exit();
        $email_data = array(
            'balances' => $arr_balances,
            'from' => date('Y-m-d', strtotime($account_info['from'])),
            'to' => date('Y-m-d', strtotime($account_info['to']))
        );
//
//        $email_data = array(
//            'balances' => $arr_balances,
//            'from' => '2015-11-01',
//            'to' => '2015-11-30'
//        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
        $this->email->to('fin-reports@forexmart.com');
//        $this->email->to('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Total Balances');
        $this->email->message($this->load->view('email/manual_account_balances', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }



    public function sendManualTotalBalances( $param = 0, $month = 1 ){

        $this->load->model('user_model');

        $webservice_config = array(
            'server' => 'live_new'
        );

//        $account_info = array(
//            'from' => '2015-11-01T00:00:00',
//            'to' => '2015-11-30T23:59:59'
//        );
        if( $param == 0 ){
            if($month == 1){
                $account_info = array(
                    'from' => '2015-11-01T00:00:00',
                    'to' => '2015-11-30T23:59:59'
                );
            }else{
                $account_info = array(
                    'from' => '2015-12-01T00:00:00',
                    'to' => '2015-12-31T23:59:59'
                );
            }
        }elseif($param == 1){
            $from = '2017-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01T00:00:00';
            $to = date('Y-m-t', strtotime($from)) . 'T23:59:59';
            $account_info = array(
                'from' => $from,
                'to' => $to
            );
        }else{
            $account_info = array(
                'from' => '2015-11-01T00:00:00',
                'to' => '2015-11-30T23:59:59'
            );
        }

        $WebServiceBal = new WebService($webservice_config);
        $WebServiceBal->getDailyFundsWithdrawDepositByDateRange($account_info);
        $arr_balances = array();
        echo 'test';
        if( $WebServiceBal->request_status === 'RET_OK' ) {
            $balances = $WebServiceBal->get_result('DailyFunds');
            foreach( $balances->DailyFundsTotal as $key => $balance ){
                $arr_balances[$balance->TimeStamp] = array(
                    'stamp' => $balance->TimeStamp,
                    'bonus_fund' => $balance->BonusFundDeposit - $balance->BonusFundWithdraw,
                    'clients_deposit' => $balance->RealFundDeposit - $balance->RealFundWithdraw
                );

//                $isUserExist = $this->user_model->checkExistingAccountNumber($balance->Account);
//                if($isUserExist){
//                    $isUserTest = $this->user_model->isUserTestByAccountNumber($balance->Account);
//                    if(!$isUserTest){
//
//                        if (!$this->user_model->isUserMicroByAccountNumber($balance->Account)) {
//                            $balance_amount = $balance->Total;
//                        }else{
//                            $balance_amount = $balance->Total / 100;
//                        }
//                        echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance_amount . '|Real|<br/>';
//
//                        if(array_key_exists($balance->Stamp, $arr_balances)){
//                            $arr_balances[$balance->Stamp]['balance'] += $balance_amount;
//                        }else{
//                            $arr_balances[$balance->Stamp] = array(
//                                'stamp' => $balance->Stamp,
//                                'balance' => $balance_amount
//                            );
//                        }
//                    }else{
//                        echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance_amount . '|Test|<br/>';
//                    }
//                }else{
//                    echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance_amount . '|Test|<br/>';
//                }
            }
        }else{
            echo $WebServiceBal->request_status;
        }

        var_dump($arr_balances);
        var_dump($account_info);
//exit();
        $email_data = array(
            'balances' => $arr_balances,
            'from' => date('Y-m-d', strtotime($account_info['from'])),
            'to' => date('Y-m-d', strtotime($account_info['to']))
        );
//
//        $email_data = array(
//            'balances' => $arr_balances,
//            'from' => '2015-11-01',
//            'to' => '2015-11-30'
//        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('agus@forexmart.com');
//        $this->email->to('fin-reports@forexmart.com');
//        $this->email->to('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
//        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Total Balances');
        $this->email->message($this->load->view('email/manual_total_balances', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendMonthlyAccountBalances(){

        $this->load->model('user_model');

        $webservice_config = array(
            'server' => 'live_new'
        );

        $date_now = date('Y-m-d H:i:s', strtotime('now'));

        $date_last_month =  date('Y-m-01 H:i:s', strtotime($date_now . ' -1 month'));
        $date_end_last_month = date('Y-m-t H:i:s', strtotime($date_last_month));

        $account_info = array(
            'from' => date('Y-m-d\T00:00:00', strtotime($date_last_month)),
            'to' => date('Y-m-d\T23:59:59', strtotime($date_end_last_month))
        );

        $WebServiceBal = new WebService($webservice_config);
        $WebServiceBal->get_deposits_per_account_per_day($account_info);
        $arr_balances = array();
        if( $WebServiceBal->request_status === 'RET_OK' ) {
            $balances = $WebServiceBal->get_result('WithdrawalsDepositsList');
            foreach( $balances->TotalDepositWithdrawData as $key => $balance ){

                $isUserExist = $this->user_model->checkExistingAccountNumber($balance->Account);
                if($isUserExist){
                    $isUserTest = $this->user_model->isUserTestByAccountNumber($balance->Account);
                    if(!$isUserTest){
                        echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance->Total . '|Real|<br/>';

                        if(array_key_exists($balance->Stamp, $arr_balances)){
                            $arr_balances[$balance->Stamp]['balance'] += $balance->Total;
                        }else{
                            $arr_balances[$balance->Stamp] = array(
                                'stamp' => $balance->Stamp,
                                'balance' => $balance->Total
                            );
                        }
                    }else{
                        echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance->Total . '|Test|<br/>';
                    }
                }else{
                    echo '|' . $balance->Account . '|' . $balance->Stamp . '|' . $balance->Total . '|Test|<br/>';
                }
            }
        }else{
            $WebServiceBal->request_status;
        }

        var_dump($arr_balances);
        var_dump($account_info);
//exit();
        $email_data = array(
            'balances' => $arr_balances,
            'from' => date('Y-m-d', strtotime($account_info['from'])),
            'to' => date('Y-m-d', strtotime($account_info['to']))
        );
//
//        $email_data = array(
//            'balances' => $arr_balances,
//            'from' => '2015-11-01',
//            'to' => '2015-11-30'
//        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
        $this->email->to('fin-reports@forexmart.com');
//        $this->email->to('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject('Total Balances');
        $this->email->message($this->load->view('email/manual_account_balances', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function getLatestCalendarEvents(){
        $this->load->model('Calendar_model');
        $this->Calendar_model->retrieveLatestCalendar();
    }

//    protected function sendDailyRealDemoGraph(){
//        $this->load->model('account_model');
//        $this->load->model('general_model');
//        $data['dataDemoselectbox'] = $this->account_model->getTop10Country(0);
//        $data['dataRealselectbox'] = $this->account_model->getTop10Country(1);
//        $data['countries']=$this->general_model->getCountries();
//        $sort10demo = $this->account_model->getSortList('top_demo_country_sorting');
//        $sort10real = $this->account_model->getSortList('top_real_country_sorting');
//
//        if(empty($sort10real))
//        {
//            $data['dataReal']=$this->account_model->getTop10Country(1);
//        }
//        else
//        {
//            $values="";
//            $i=0;
//            foreach($sort10real as $key)
//            {
//                if($i==0){$values="'".$key->country_code."'";}
//                else{$values=$values.",'".$key->country_code."'";}
//
//                $i++;
//            }
//
//            $data['dataReal']=$this->account_model->getTop10CountrySort(1,$values);
//        }
//
//        if (empty($sort10demo)) {
//            $data['dataDemo'] = $this->account_model->getTop10Country(0);
//        } else {
//            $values = "";
//            $i = 0;
//            foreach ($sort10demo as $key) {
//                if ($i == 0) {
//                    $values = "'" . $key->country_code . "'";
//                } else {
//                    $values = $values . ",'" . $key->country_code . "'";
//                }
//                $i++;
//            }
//
//            $data['dataDemo'] = $this->account_model->getTop10CountrySort(0, $values);
//        }
//
//        $realArray="";
//        $realArrayCountry="";
//        $i=0;
//        foreach($data['dataRealselectbox'] as $key)
//        {
//
//            $country= $data['countries'][$key->countryten];
//            $result10=$this->account_model->getDemoAndRealPartUser(1,$key->countryten);
//            $realArrayCountry[$i]=$country;
//            $realArray[$country]= $result10;
//            $i++;
//        }
//
//        $data['realArray10']=$realArray;
//        $data['realArrayCountry']=$realArrayCountry;
//
//        $demoArray = "";
//        $demoArrayCountry = "";
//        $j = 0;
//        foreach ($data['dataDemoselectbox'] as $key) {
//            $country = $data['countries'][$key->countryten];
//            $result10 = $this->account_model->getDemoAndRealPartUser(0, $key->countryten);
//            $demoArrayCountry[$j] = $country;
//            $demoArray[$country] = $result10;
//            $j++;
//        }
////              echo "<pre>";
////                 print_r($demoArray);
////                 echo "---------";
////                    print_r( $demoArrayCountry);
////                 exit;
//
//
//        $data['demoArray10'] = $demoArray;
//        $data['demoArrayCountry'] = $demoArrayCountry;
//
////        $js = $this->template->Js();
////        $css = $this->template->Css();
//        $this->template->title("Administration | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/demo_graph', $data);
//    }

    public function saveGraphImage(){
        ini_set('max_execution_time', 0);
        if ($this->input->is_ajax_request() ){
//Get the base-64 string from data

            $account_type = $this->input->post('type',true);
            $filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);

//Decode the string
            $unencodedData=base64_decode($filteredData);

//Save the image
            $date = new DateTime();
            if($account_type == 1){
                $file_name = 'img_real_graph_' . $date->getTimestamp() . '.png';
            }else{
                $file_name = 'img_demo_graph_' . $date->getTimestamp() . '.png';
            }
            file_put_contents('./assets/user_docs/' . $file_name, $unencodedData);
            $email_data = array(
                'img_val' => FXPP::custom_url('assets/user_docs/' . $file_name),
            );

            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
            $this->email->to('fin-reports@forexmart.com');
            $this->email->cc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
            if($account_type == 1){
                $this->email->subject('Daily Real Accounts from Top 10 Countries');
            }else {
                $this->email->subject('Daily Demo Accounts from Top 10 Countries');
            }
            $this->email->message($this->load->view('email/daily_demo_graph', $email_data, TRUE));
            if($this->email->send()){
                //echo 'sent!';
            }else{
                //echo $this->email->print_debugger();
            }
        }else{
            show_404();
        }
    }

    public function emailTest(){
        $c_code = "DE";
        $this->load->model('account_model');
        $this->load->model('general_model');
        $insert_data['client_country'] = $this->account_model->dailyDifferentCountryReportFull($c_code);

        $insert_data['country'] = $this->general_model->getCountries();
        $insert_data['country']["GB','IE"] = "UK and Ireland ";

        $to_email = array(
            "ES" => 'clients_spain_daily_1@forexmart.com',
            "DE" =>'clients_germany_daily_1@forexmart.com',
            "FR" =>'clients_france_daily_1@forexmart.com',
            "GB','IE"=>'clients_ukireland_daily_1@forexmart.com',
            "BG" =>'clients_bulgaria_daily_1@Forexmart.com'
        );

        if(isset($to_email[$c_code])){
            $insert_data['email'] = $to_email[$c_code];
        }else{
            $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
        }


        $insert_data['subject']  = "Clients from ".$insert_data['country'][$c_code]." as of  ".date('Y-m-d', strtotime(' -1 day'));
        $config = array(
            'mailtype'=> 'html'
        );


        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        // echo $insert_data['email'];
        // $this->email->to('bug.fxpp@gmail.com');
        echo "<br>".$insert_data['email']."<br>";
        $this->email->to('bug.fxpp@gmail.com');
       // $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,bug.fxpp@gmail.com');

        if(isset($to_email[$c_code])){
            $this->email->bcc('moniruzzaman-it@itgrowtech.com');
        }else{
            // $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
            $this->email->bcc('moniruzzaman-it@itgrowtech.com');
        }

        $this->email->subject( $insert_data['subject']);
        $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function cronTest(){
//        $webservice_config = array(
//            'server' => 'currency_converter',
//            'service_id' => '505641',
//            'service_password' => '5fX#p8D^c89bQ'
//        );
//        $WebService = new WebService($webservice_config);
//        $data = array(
//            'amount' => 1,
//            'from_currency' => 'USD',
//            'to_currency' => 'EUR'
//        );
//
//        $WebService->convert_currency_amount($data);
//        var_dump($WebService->get_all_result());

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->subject('Cron Test');
//        $this->email->message($this->load->view('email/daily_registered_accounts', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }

    public function updateClientsLeverage(){
        $this->load->model('account_model');
        //$accounts = $this->account_model->getNoDepositLeverageExceed();
        $accounts = $this->account_model->getContestRegistrants();
        foreach( $accounts as $key => $account ){
            echo $account['account_number'] . ' => ' . $account['leverage'] . ': ';
            $webservice_config = array('server' => 'demo_new');
            $account_info = array(
                'iLogin' => $account['account_number'],
//                'iLeverage' => '500'
            );
            $WebService = new WebService($webservice_config);
            $WebService->request_account_details($account_info);
//            $WebService->open_ChangeAccountLeverage($account_info);
            if ($WebService->request_status === 'RET_OK') {
                echo $account['account_number'] . ' => ' . $WebService->get_result('Leverage');
//                echo 'Updated <br/>';
//                $this->account_model->updateAccountLeverage($account['account_number'], '1:500');
            }else{
                echo $account['account_number'] . ' => ' .  'Failed, ' . $WebService->request_status . ' <br/>';
            }
        }
//        $accounts = $this->account_model->getUserLeveragesByCountry('PL');
//        foreach( $accounts as $key => $account ){
//            if($account['actual_leverage'] > 100){
//                echo $account['account_number'] . ' => ' . $account['actual_leverage'] . ': ';
//                $webservice_config = array('server' => 'demo_new');
//                $account_info = array(
//                    'iLogin' => $account['account_number'],
//                    'iLeverage' => '100'
//                );
//                $WebService = new WebService($webservice_config);
//                $WebService->open_ChangeAccountLeverage($account_info);
//                if ($WebService->request_status === 'RET_OK') {
//                    echo 'Updated <br/>';
//                    $this->account_model->updateAccountLeverage($account['account_number'], '1:100');
//                }else{
//                    echo 'Failed, ' . $WebService->request_status . ' <br/>';
//                }
//            }
//        }
    }

    public function manual(){
//        $this->load->model('general_model');
//        self::dailyDeposit();
//        self::monthlyDeposit();
//        self::updateClientsLeverage();
//        self::manualDepositAmountConvertion();
//        self::manualWithdrawAmountConvertion();
//        self::sendDailyRealAccountsGraph();
//        $email_data = array(
//            'full_name' => 'test',
//            'email' => 'ezuri.claw@gmail.com',
//            'password'=> 'Udt84D3%2324',
//            'account_number'=> '1000001',
//            'trader_password'=> 'test',
//            'investor_password'=> 'test',
//            'phone_password'=> 'test',
//        );
//        $this->load->library('email');
//        $subject = "ForexMart MT4 Live Trading Account details";
//        $config = array(
//            'mailtype'=> 'html'
//        );
//        if($config != null){
//            $this->email->initialize($config);
//        }
//        $this->SMTPDebug =1;
//        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
////            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('ezuri.claw@gmail.com');
////            $this->email->to('fin-reports@forexmart.com');
////            $this->email->cc('agus@forexmart.com');
////        $this->email->to('ad-stats@forexmart.com');
////        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
////        $this->email->bcc('pptest1@forexmart.com');
//        $this->email->subject($subject);
//        $this->email->message($email_data['password']);
//        if($this->email->send()){
//            echo 'sent!';
//        }else {
//            echo $this->email->print_debugger();
//        }

//        self::manualWithdrawAmountConvertion();
//        self::sendDailyTopDemoAccountsGraph();
//        self::sendDailyRealAccountsGraph();
//        self::sendDailyDemoAccountsGraph();
//        self::sendDailyTopRealAccountsGraph();
//        self::sendDailyTopRealAccountsGraph();
//        self::sendDailyDWSAccountsGraph();
//        self::sendDailyComplianceReport();
//        self::sendDailyVerificationAutoReport();
//            self::sendWeeklyDWS();
        // create a new cURL resource
//        $ch = curl_init();
//
//        // set URL and other appropriate options
//        curl_setopt($ch, CURLOPT_URL, "https://www.forexmart.com/cron/sendDailyRealAccountsGraph");
//        curl_setopt($ch, CURLOPT_HEADER, false);
//
//        // grab URL and pass it to the browser
//        curl_exec($ch);
//
//        // close cURL resource, and free up system resources
//        curl_close($ch);
//            self::sendDailyComplianceReport();
//        self::updateContestWinners();
//        $webservice_config = array(
//            'server' => 'live_new'
//        );
//        $WebService = new WebService($webservice_config);
//        $data = array(
//            'iLogin' => 101491
//        );
//        $WebService->request_account_details($data);
//        if ($WebService->request_status === 'RET_OK') {
//            $group = $WebService->get_result('Group');
//            if (in_array(substr($group, -1), array('1', '2', '3'))) {
//                $code = substr($group, -1);
//                echo $code;
//            }
//        }else{
//            echo $WebService->request_status;
//        }
//        $region = FXPP::getUserContinentCode();
//        var_dump($region);

        self::testDailyVerificationAutoReport();
        /*$this->load->library('encrypt');
        echo $this->encrypt->encode();*/
    }

    public function testrunsched(){
        $this->load->model('Mailer_model');
        $event = 'specific';
        $getSavedSchedule = $this->Mailer_model->getSavedSchedule($event);

        if(!$getSavedSchedule){
            exit;
        }
        foreach ($getSavedSchedule as $key => $row) {
            if ($row['RunDate'] <= strtotime(date('Y-m-d H:i:s'))) {

                if ($row['Occurrence'] > 0 || $row['Occurrence_type'] == 'never') {

                    $getRecipientsofMailer = $this->Mailer_model->getRecipientsofMailer($row['Id'],$row['Mode']);

                    if($row['Mode'] != 'Once'){

                        $rundate = date('Y-m-d H:i:s', $row['RunDate']);

                        switch ($row['Mode']) {
                            case 'Weekly':
                                $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+1 week"));
                                break;
                            case 'Monthly':
                                $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+1 month"));
                                break;
                            case 'Monthly_2':
                                $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+2 month"));
                                break;
                            case 'Monthly_3':
                                $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+3 month"));
                                break;
                            case 'Monthly_6':
                                $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+6 month"));
                                break;
                        }
                        // subtract 1 to occurrence
                        switch ($row['Occurrence_type']) {
                            case 'occurrence':
                            case 'end_date':
                                $setNewOccurrence = $row['Occurrence'] - 1;
                                break;
                            case 'never':
                                $setNewOccurrence = 0;
                                break;
                        }

//                        $updMailer = array(
//                            'Occurrence' => $setNewOccurrence,
//                            'RunDate' => strtotime($nextDate)
//                        );
//
//                        $this->Mailer_model->updateSchedulesMailer($row['Id'], $updMailer);

                        foreach($getRecipientsofMailer as $r){
                            if(!empty($r['Email'])){

                                $test = $this->verifyEmail($r['Email'], 'kent86407@gmail.com');
                                $verifyEmail = ($test == 'invalid') ? false : true;

                                if($verifyEmail){
                                    echo '<pre>',print_r($r['Email'],1),'</pre>';
                                }
                            }
                        }

                    } else{
                        foreach($getRecipientsofMailer as $r){

                            if($r['sent_counter'] == 0){

                                if(!empty($r['Email'])){

                                    echo '<pre>',print_r($r['Email'],1),'</pre>';

                                    $test = $this->verifyEmail($r['Email'], 'kent86407@gmail.com');
                                    $verifyEmail = ($test == 'invalid') ? false : true;

                                    if($verifyEmail){

                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function runMailerTest(){

        $this->load->model('Mailer_model');
        $mailerId = 72;
        $getSavedSchedule = $this->Mailer_model->getSavedScheduleMailerId($mailerId);

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {
                $getRecipientsofMailer = $this->Mailer_model->getRecipientsofMailerTest($row['ScheduleId']);

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){
                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';
//                                $sentCounter = $recipient['Counter'] + 1;
//                                $updateData = array(
//                                    'Counter' => $sentCounter
//                                );
//                                $this->Mailer_model->updateRecipientCounterTest($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler('jomari@zetaol.com', $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['unsubscribe_key']);
                            }
                        }
                    }
                }
            }
        }
    }

    public function runMailerSpecificOnce(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 71;
        $getSavedSchedule = $this->Mailer_model->getSavedScheduleMailerId($mailerId);

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {
                $getRecipientsofMailer = $this->Mailer_model->getRecipientsofMailerTest($row['ScheduleId']);
                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){
                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateRecipientCounterTest($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
                            }
                        }
                    }
                }
            }
        }
    }
    public function runMailerSpecificOnceRU(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 72;
        $getSavedSchedule = $this->Mailer_model->getSavedScheduleMailerId($mailerId);

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {
                $getRecipientsofMailer = $this->Mailer_model->getRecipientsofMailerTestRU($row['ScheduleId']);
                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){
                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateRecipientCounterTest($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['unsubscribe_key']);
                            }
                        }
                    }
                }
            }
        }
    }

    public function runMailerScheduler(){

        exit;
        $this->load->model('Mailer_model');

        $event = 'specific';
        $getSavedSchedule = $this->Mailer_model->getSavedSchedule($event);

        if(!$getSavedSchedule){
            exit;
        }


        foreach ($getSavedSchedule as $key => $row) {

            if ($row['RunDate'] <= strtotime(date('Y-m-d H:i:s'))) {

                $rundate = date('Y-m-d H:i:s', $row['RunDate']);
                if ($row['Occurrence'] > 0 || $row['Occurrence_type'] == 'never') {

                    $this->load->library('encrypt');
                    $key = 'key-fxp0215';
                    $decryptPass = $this->encrypt->decode($row['Password'], $key);
                    $getRecipientsofMailer = $this->Mailer_model->getRecipientsofMailer($row['Id'],$row['Mode']);

                    if ($getRecipientsofMailer) {

                        if($row['Mode'] != 'Once'){
                            echo 'test_1';
                            switch ($row['Mode']) {
                                case 'Weekly':
                                    $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+1 week"));
                                    break;
                                case 'Monthly':
                                    $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+1 month"));
                                    break;
                                case 'Monthly_2':
                                    $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+2 month"));
                                    break;
                                case 'Monthly_3':
                                    $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+3 month"));
                                    break;
                                case 'Monthly_6':
                                    $nextDate = date('Y-m-d H:i:s', strtotime($rundate . "+6 month"));
                                    break;
                            }
                            // subtract 1 to occurrence
                            switch ($row['Occurrence_type']) {
                                case 'occurrence':
                                case 'end_date':
                                    $setNewOccurrence = $row['Occurrence'] - 1;
                                    break;
                                case 'never':
                                    $setNewOccurrence = 0;
                                    break;
                            }

                            $updMailer = array(
                                'Occurrence' => $setNewOccurrence,
                                'RunDate' => strtotime($nextDate)
                            );

                            $this->Mailer_model->updateSchedulesMailer($row['Id'], $updMailer);

                            foreach($getRecipientsofMailer as $r){
                                if(!empty($r['Email'])){


                                    $test = $this->verifyEmail($r['Email'], 'kent86407@gmail.com');
                                    $verifyEmail = ($test == 'invalid') ? false : true;

                                    if($verifyEmail){


                                        echo '<pre>',print_r($r['Email'],1),'</pre>';

                                        $sentCounter = $r['sent_counter'] + 1;
                                        $updateData = array(
                                            'sent_counter' => $sentCounter
                                        );
                                        $this->Mailer_model->updateRecipientCounter($r['Id'], $updateData);
                                        Fx_mailer::MailerScheduler($r['Email'], $row['ReplyTo'], $row['Sentfrom'], $decryptPass, $row['TextArea'], $row['Topic'], $row['Language'],$r['unsubscribe_key']);
                                    }
                                }
                            }

                        } else{
                            foreach($getRecipientsofMailer as $r){

                                if($r['sent_counter'] == 0){

                                    if(!empty($r['Email'])){


                                        $test = $this->verifyEmail($r['Email'], 'kent86407@gmail.com');
                                        $verifyEmail = ($test == 'invalid') ? false : true;

                                        if($verifyEmail){


                                            echo '<pre>',print_r($r['Email'],1),'</pre>';

                                            $sentCounter = $r['sent_counter'] + 1;
                                            $updateData = array(
                                                'sent_counter' => $sentCounter
                                            );
                                            $this->Mailer_model->updateRecipientCounter($r['Id'], $updateData);
                                            Fx_mailer::MailerScheduler($r['Email'], $row['ReplyTo'], $row['Sentfrom'], $decryptPass, $row['TextArea'], $row['Topic'], $row['Language'],$r['unsubscribe_key']);
                                        }else{
                                            $this->Mailer_model->deleteMailerConnection($r['Id']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function runMailerBonus(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 78;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runHowToGetStarted(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 83;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runNoDepositBonus(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 84;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runLasPalmas(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 85;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runEuropeanLicenseRegulation(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 86;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runDepositInsurance(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 87;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit; 

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runContestMoneyFall(){

        $this->load->model('Mailer_model');
        $mailerId = 88;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }
    public function runCallBackService(){
        exit;
        $this->load->model('Mailer_model');
        $mailerId = 91;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runFreeVpsService(){
        $this->load->model('Mailer_model');
        $mailerId = 92;
        $getSavedSchedule = $this->Mailer_model->getScheduledMailerClient($mailerId);

//      echo '<pre>',print_r($getSavedSchedule,1),'</pre>'; exit;

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {

            if ($row['Run_date'] <= strtotime(date('Y-m-d H:i:s'))) {

                $getRecipientsofMailer = $this->Mailer_model->getRecipientsClientsMailer($row['ScheduleId']);

//                echo '<pre>',print_r($getRecipientsofMailer,1),'</pre>'; exit;

                if($getRecipientsofMailer){
                    foreach($getRecipientsofMailer as $recipient){

                        if($recipient['Counter'] == 0){
                            if(!empty($recipient['Email'])){
//                                echo '<pre>',print_r($recipient['Email'],1),'</pre>';

                                $sentCounter = $recipient['Counter'] + 1;
                                $updateData = array(
                                    'Counter' => $sentCounter
                                );
                                $this->Mailer_model->updateClientRecipientCounter($recipient['ConnectionId'], $updateData);
                                Fx_mailer::MailerScheduler($recipient['Email'], $row['ReplyTo'], 'marketing@notify.forexmart.com', 'n342Z2wKV4', $row['TextArea'], $row['Topic'], $row['Language'],$recipient['Unsubscribe_key']);
//
                            }
                        }
                    }
                }
            }
        }
    }

    public function runMailerSpecialEvents(){

        exit;

        $this->load->model('Mailer_model');

        $event = 'special';
        $getSavedSchedule = $this->Mailer_model->getSavedSchedule($event);

        if(!$getSavedSchedule){
            exit;
        }

        foreach ($getSavedSchedule as $key => $row) {
            $runDate = date('m-d', $row['RunDate']);
            $dateToday = date('m-d');
            if($runDate == $dateToday){
                $this->load->library('encrypt');
                $key = 'key-fxp0215';
                $decryptPass = $this->encrypt->decode($row['Password'], $key);
                $getRecipientsofMailer = $this->Mailer_model->getRecipientsofMailer($row['Id']);
                if ($getRecipientsofMailer) {
                    foreach($getRecipientsofMailer as $r){
                        if(empty($r['Email'])){
                            $userDetails = $this->Mailer_model->getUserDetails($r['user_id']);
                            $fullname = explode(' ',($userDetails['full_name']));

                            $test = $this->verifyEmail($r['Email'], 'kent86407@gmail.com');
                            $verifyEmail = ($test == 'invalid') ? false : true;

                            if($verifyEmail){
                                $sentCounter = $r['sent_counter'] + 1;
                                $updateData = array(
                                    'sent_counter' => $sentCounter
                                );
                                $this->Mailer_model->updateRecipientCounter($r['Id'], $updateData);
                                Fx_mailer::MailerSchedulerSpecial($r['Email'], $row['ReplyTo'], $row['Sentfrom'], $decryptPass, $row['TextArea'], $row['Topic'], $row['Language'],$r['unsubscribe_key'], $fullname[0]);
                            }
                        }
                    }
                }
            }
        }
    }

    function verifyEmail($toemail, $fromemail, $getdetails = false){
        $details='';
        $email_arr = explode("@", $toemail);
        $domain = array_slice($email_arr, -1);
        $domain = $domain[0];
        // Trim [ and ] from beginning and end of domain string, respectively
        $domain = ltrim($domain, "[");
        $domain = rtrim($domain, "]");
        if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {
            $domain = substr($domain, strlen("IPv6") + 1);
        }
        $mxhosts = array();
        if( filter_var($domain, FILTER_VALIDATE_IP) )
            $mx_ip = $domain;
        else
            getmxrr($domain, $mxhosts, $mxweight);
        if(!empty($mxhosts) )
            $mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
        else {
            if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
                $record_a = dns_get_record($domain, DNS_A);
            }
            elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
                $record_a = dns_get_record($domain, DNS_AAAA);
            }
            if( !empty($record_a) )
                $mx_ip = $record_a[0]['ip'];
            else {
                $result   = "invalid";
                $details .= "No suitable MX records found.";
                return ( (true == $getdetails) ? array($result, $details) : $result );
            }
        }

        $connect = @fsockopen($mx_ip, 25);
        if($connect){
            if(preg_match("/^220/i", $out = fgets($connect, 1024))){
                fputs ($connect , "HELO $mx_ip\r\n");
                $out = fgets ($connect, 1024);
                $details .= $out."\n";

                fputs ($connect , "MAIL FROM: <$fromemail>\r\n");
                $from = fgets ($connect, 1024);
                $details .= $from."\n";
                fputs ($connect , "RCPT TO: <$toemail>\r\n");
                $to = fgets ($connect, 1024);
                $details .= $to."\n";
                fputs ($connect , "QUIT");
                fclose($connect);
                if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to)){
                    $result = "invalid";
                }
                else{
                    $result = "valid";
                }
            }
        }
        else{
            $result = "invalid";
            $details .= "Could not connect to server";
        }
        if($getdetails){
            return array($result, $details);
        }
        else{
            return $result;
        }
    }

    public function runHundredBonus(){
        exit;
        $this->load->model('Mailer_model');
        $dateToday = date('Y-m-d');

        $getAllPeriodicMailer = $this->Mailer_model->getAllPeriodicMailer($dateToday);
        FXPP::print_data($getAllPeriodicMailer);

    }

    public function runPeriodicMailer2(){
        exit;
        $this->load->model('Mailer_model');
//        $dateToday = date('Y-m-d');
        $dateToday = '2016-10-05';

        $getAllPeriodicMailer = $this->Mailer_model->getAllPeriodicMailer($dateToday);

        if(!$getAllPeriodicMailer){
            exit;
        }

//        FXPP::print_data($getAllPeriodicMailer);exit;

        foreach($getAllPeriodicMailer as $mailer){

            $className = 'Fx_mailer';
            $methodName = $mailer['MethodName'];



            if(is_callable(array($className, $methodName))){
                $args = array(
                    $mailer['Email'],
                    $mailer['Fullname'],
                    $mailer['Unsubscribe_key']
                );
                $callFunction = call_user_func_array(array($className, $methodName), $args);
                if($callFunction){
                    $updateData = array(
                        'Counter' => $mailer['Counter'] + 1
                    );
                    $this->Mailer_model->updatePeriodicCounter($mailer['Id'], $updateData);
                }
            }
        }

    }


    public function runPeriodicMailer(){
          @ini_set("output_buffering", "Off");
          @ini_set('implicit_flush', 1);
          @ini_set('zlib.output_compression', 0);
          @ini_set('max_execution_time',1200);

        $this->load->model('Mailer_model');
        $dateToday = date('Y-m-d');

        $getAllPeriodicMailer = $this->Mailer_model->getAllPeriodicMailerTag($dateToday, 0);

        if(!$getAllPeriodicMailer){
            exit;
        }

//        FXPP::print_data($getAllPeriodicMailer);exit;

        foreach($getAllPeriodicMailer as $mailer){

            $className = 'Fx_mailer';
            $methodName = $mailer['MethodName'];

            if(is_callable(array($className, $methodName))){

                $fullname = $mailer['Fullname'];
                if(empty($fullname)){
                    if($mailer['Lang'] == 'Ru'){
                        $fullname = 'Клиент';
                    }else{
                        $fullname = 'Client';
                    }
                    
                }

                $args = array(
                    $mailer['Email'],
                    $fullname,
                    $mailer['Unsubscribe_key']
                );

                $callFunction = call_user_func_array(array($className, $methodName), $args);
                if($callFunction){
                    $updateData = array(
                        'Counter' => $mailer['Counter'] + 1
                    );
                    $this->Mailer_model->updatePeriodicCounter($mailer['Id'], $updateData);
                }
            }
            
            // if(sleep(10)!=0)
            // {
            //     echo "sleep failed script terminating"; 
            //     break;
            // }
            // flush();
            // ob_flush();
        }
    }

    public function runPeriodicMailerPartner(){
          @ini_set("output_buffering", "Off");
          @ini_set('implicit_flush', 1);
          @ini_set('zlib.output_compression', 0);
          @ini_set('max_execution_time',1200);

        $this->load->model('Mailer_model');
        $dateToday = date('Y-m-d');

        $getAllPeriodicMailer = $this->Mailer_model->getAllPeriodicMailerTag($dateToday, 1);

        if(!$getAllPeriodicMailer){
            exit;
        }

//        FXPP::print_data($getAllPeriodicMailer);exit;

        foreach($getAllPeriodicMailer as $mailer){

            $className = 'Fx_mailer';
            $methodName = $mailer['MethodName'];

            if(is_callable(array($className, $methodName))){
                $fullname = $mailer['Fullname'];
                if(empty($fullname)){
                    if($mailer['Lang'] == 'Ru'){
                        $fullname = 'партнер'; 
                    }else{
                        $fullname = 'Partner'; 
                    }
                }
                $args = array(
                    $mailer['Email'],
                    $fullname,
                    $mailer['Unsubscribe_key']
                );
                $callFunction = call_user_func_array(array($className, $methodName), $args);
                if($callFunction){
                    $updateData = array(
                        'Counter' => $mailer['Counter'] + 1
                    );
                    $this->Mailer_model->updatePeriodicCounter($mailer['Id'], $updateData);
                }
            }

            //delay
            // if(sleep(15)!=0)
            // {
            //     echo "sleep failed script terminating"; 
            //     break;
            // }
            // flush();
            // ob_flush();
        }
    }

    protected function manualDepositAmountConvertion(){
        $this->load->model('deposit_model');
        $deposit = $this->deposit_model->getAllUnconvertedAmountDeposit();

        foreach($deposit as $key => $value){
            $currency = $value['currency'];
            $amount = $value['amount'];
            if($currency == 'USD') {
                $conv_amount = $amount;
            }else{

                $currency_convert_config = array(
                    'server' => 'converter',
                    'service_id' => '505641',
                    'service_password' => '5fX#p8D^c89bQ'
                );

                $WebService = new WebService($currency_convert_config);
                $data = array(
                    'amount' => $amount,
                    'from_currency' => strtoupper(trim($currency)),
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    echo $value['amount'] . ', ' . $value['currency'] . ', ' . $WebService->request_status . '<br/>';
                    $converted_amount = $WebService->get_result('ToAmount');
                    $conv_amount = number_format($converted_amount,2);
                }else{
                    echo $value['amount'] . ', ' . $value['currency'] . ', ' . $WebService->request_status . '<br/>';
                    $conv_amount = $amount;
                }
            }

            $this->deposit_model->updateConvertedAmountById($value['id'], $conv_amount);
        }
    }

    public function manualWithdrawAmountConvertion(){
        $this->load->model('withdraw_model');
        $withdraw = $this->withdraw_model->getAllUnconvertedAmountWithdraw();
        foreach($withdraw as $key => $value){
            $currency = $value['currency'];
            $amount = $value['amount'];
            if($currency == 'USD') {
                $conv_amount = $amount;
            }else{

                $currency_convert_config = array(
                    'server' => 'converter',
                    'service_id' => '505641',
                    'service_password' => '5fX#p8D^c89bQ'
                );

                $WebService = new WebService($currency_convert_config);
                $data = array(
                    'amount' => $amount,
                    'from_currency' => strtoupper(trim($currency)),
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $conv_amount = number_format($converted_amount,2);
                    echo $value['amount'] . ', ' . $value['currency'] . ', ' . $WebService->request_status . '<br/>';
                }else{
                    $conv_amount = $amount;
                    echo $value['amount'] . ', ' . $value['currency'] . ', ' . $WebService->request_status . '<br/>';
                }
            }

            $this->withdraw_model->updateConvertedAmountById($value['id'], $conv_amount);
        }
    }

    public function dailyOpenedRealAccountsGraphs(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -30 days'));
        $date_from_60 = date('Y-m-d', strtotime($date_now . ' -60 days'));
        $date_from_180 = date('Y-m-d', strtotime($date_now . ' -180 days'));
        $date_from_360 = date('Y-m-d', strtotime($date_now . ' -360 days'));
        $date_from_540 = date('Y-m-d', strtotime($date_now . ' -540 days'));

        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate( $date_from_30, $date_now );
        $real_account_chart_data_30 = array();
        foreach($real_accounts_data_30 as $key => $account){
            $real_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 60 days
        $real_accounts_data_60 = $this->account_model->getRealAccountsCountByDate( $date_from_60, $date_now );
        $real_account_chart_data_60 = array();
        foreach($real_accounts_data_60 as $key => $account){
            $real_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 180 days
        $real_accounts_data_180 = $this->account_model->getRealAccountsCountByDate( $date_from_180, $date_now );
        $real_account_chart_data_180 = array();
        foreach($real_accounts_data_180 as $key => $account){
            $real_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 360 days
        $real_accounts_data_360 = $this->account_model->getRealAccountsCountByDate( $date_from_360, $date_now );
        $real_account_chart_data_360 = array();
        foreach($real_accounts_data_360 as $key => $account){
            $real_account_chart_data_360[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 540 days
        $real_accounts_data_540 = $this->account_model->getRealAccountsCountByDate( $date_from_540, $date_now );
        $real_account_chart_data_540 = array();
        foreach($real_accounts_data_540 as $key => $account){
            $real_account_chart_data_540[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        $data['real_accounts_data_30'] = $real_account_chart_data_30;
        $data['real_accounts_data_60'] = $real_account_chart_data_60;
        $data['real_accounts_data_180'] = $real_account_chart_data_180;
        $data['real_accounts_data_360'] = $real_account_chart_data_360;
        $data['real_accounts_data_540'] = $real_account_chart_data_540;

//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_real_accounts', $data);
    }

    public function sendRealAccountsGraphs(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_real_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyOpenedRealAccountsGraphs /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
            $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->subject('Opened Real Accounts Chart');
        $this->email->message($this->load->view('email/daily_real_accounts_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyOpenedDemoAccountsGraphs(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -30 days'));
        $date_from_60 = date('Y-m-d', strtotime($date_now . ' -60 days'));
        $date_from_180 = date('Y-m-d', strtotime($date_now . ' -180 days'));
        $date_from_360 = date('Y-m-d', strtotime($date_now . ' -360 days'));
        $date_from_540 = date('Y-m-d', strtotime($date_now . ' -540 days'));

        //Get Opened Demo Accounts for 30 days
        $demo_accounts_data_30 = $this->account_model->getDemoAccountsCountByDate( $date_from_30, $date_now );
        $demo_account_chart_data_30 = array();
        foreach($demo_accounts_data_30 as $key => $account){
            $demo_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Demo Accounts for 60 days
        $demo_accounts_data_60 = $this->account_model->getDemoAccountsCountByDate( $date_from_60, $date_now );
        $demo_account_chart_data_60 = array();
        foreach($demo_accounts_data_60 as $key => $account){
            $demo_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Demo Accounts for 180 days
        $demo_accounts_data_180 = $this->account_model->getDemoAccountsCountByDate( $date_from_180, $date_now );
        $demo_account_chart_data_180 = array();
        foreach($demo_accounts_data_180 as $key => $account){
            $demo_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Demo Accounts for 360 days
        $demo_accounts_data_360 = $this->account_model->getDemoAccountsCountByDate( $date_from_360, $date_now );
        $demo_account_chart_data_360 = array();
        foreach($demo_accounts_data_360 as $key => $account){
            $demo_account_chart_data_360[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Demo Accounts for 540 days
        $demo_accounts_data_540 = $this->account_model->getDemoAccountsCountByDate( $date_from_540, $date_now );
        $demo_account_chart_data_540 = array();
        foreach($demo_accounts_data_540 as $key => $account){
            $demo_account_chart_data_540[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        $data['demo_accounts_data_30'] = $demo_account_chart_data_30;
        $data['demo_accounts_data_60'] = $demo_account_chart_data_60;
        $data['demo_accounts_data_180'] = $demo_account_chart_data_180;
        $data['demo_accounts_data_360'] = $demo_account_chart_data_360;
        $data['demo_accounts_data_540'] = $demo_account_chart_data_540;

        $this->load->view('email/element/graph_demo_accounts', $data);
    }

    public function sendDemoAccountsGraphs(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_demo_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyOpenedDemoAccountsGraphs /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
            $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->subject('Opened Demo Accounts Chart');
        $this->email->message($this->load->view('email/daily_demo_accounts_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyOpenedPartnerAccountsGraphs(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -30 days'));
        $date_from_60 = date('Y-m-d', strtotime($date_now . ' -60 days'));
        $date_from_180 = date('Y-m-d', strtotime($date_now . ' -180 days'));
        $date_from_360 = date('Y-m-d', strtotime($date_now . ' -360 days'));
        $date_from_540 = date('Y-m-d', strtotime($date_now . ' -540 days'));

        //Get Opened Partner Accounts for 30 days
        $partner_accounts_data_30 = $this->account_model->getPartnerAccountsCountByDate( $date_from_30, $date_now );
        $partner_account_chart_data_30 = array();
        foreach($partner_accounts_data_30 as $key => $account){
            $partner_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Partner Accounts for 60 days
        $partner_accounts_data_60 = $this->account_model->getPartnerAccountsCountByDate( $date_from_60, $date_now );
        $partner_account_chart_data_60 = array();
        foreach($partner_accounts_data_60 as $key => $account){
            $partner_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Partner Accounts for 180 days
        $partner_accounts_data_180 = $this->account_model->getPartnerAccountsCountByDate( $date_from_180, $date_now );
        $partner_account_chart_data_180 = array();
        foreach($partner_accounts_data_180 as $key => $account){
            $partner_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Partner Accounts for 360 days
        $partner_accounts_data_360 = $this->account_model->getPartnerAccountsCountByDate( $date_from_360, $date_now );
        $partner_account_chart_data_360 = array();
        foreach($partner_accounts_data_360 as $key => $account){
            $partner_account_chart_data_360[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Partner Accounts for 540 days
        $partner_accounts_data_540 = $this->account_model->getPartnerAccountsCountByDate( $date_from_540, $date_now );
        $partner_account_chart_data_540 = array();
        foreach($partner_accounts_data_540 as $key => $account){
            $partner_account_chart_data_540[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        $data['partner_accounts_data_30'] = $partner_account_chart_data_30;
        $data['partner_accounts_data_60'] = $partner_account_chart_data_60;
        $data['partner_accounts_data_180'] = $partner_account_chart_data_180;
        $data['partner_accounts_data_360'] = $partner_account_chart_data_360;
        $data['partner_accounts_data_540'] = $partner_account_chart_data_540;

        $this->load->view('email/element/graph_partner_accounts', $data);
    }

    public function sendPartnerAccountsGraphs(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_partner_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyOpenedPartnerAccountsGraphs /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
            $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject('Opened Partner Accounts Chart');
        $this->email->message($this->load->view('email/daily_partner_accounts_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyTopRealAccountsGraph( $days = 180 ){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));

        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        $color_array = array('#A349A4','#3F48CC','#00A2E8','#22B14C','#FFF200','#FF7F27','#ED1C24','#880015','#7F7F7F','#000000');
        $top_real_country = $this->account_model->getTopRealAccountsCountByCountry( $date_from, $date_now, 10 );
        $total_real_country = 0;
        $real_country_count = array();
        foreach($top_real_country as $key => $real_country){
            $real_country_code = $real_country['country'];
            $total_real_country += $real_country['account_count'];
            $top_real_country[$key]['name'] = $this->general_model->getCountries(strtoupper(trim($real_country_code)));
            $top_real_country[$key]['count'] = $real_country['account_count'];
            $real_country_data = $this->account_model->getRealAccountsCountByCountry( $date_from, $date_now, $real_country_code );
            foreach($real_country_data as $key1 => $real_data){
                $real_country_count[$real_country_code][] = "[". strtotime($real_data['registration_date'])*1000 .",". $real_data['registration_count'] ."]";
            }
        }

        $data['color_array'] = $color_array;
        $data['top_real_country'] = $top_real_country;
        $data['real_country_count'] = $real_country_count;
        $data['total_real_country_count'] = $total_real_country;
        $data['days'] = $days;

        $this->load->view('email/element/graph_top_real_accounts', $data);
    }

    public function sendTopRealAccountsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_top_real_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyTopRealAccountsGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'title' => 'Chart of all REAL accounts from TOP 10 countries ' . $days . ' days - ' . date('m/d/Y', strtotime('now'))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
            $this->email->to('fin-stats@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject('Real Accounts from Top 10 Countries');
        $this->email->message($this->load->view('email/daily_top_real_accounts_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyTopDemoAccountsGraph( $days = 180 ){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));

        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        $color_array = array('#A349A4','#3F48CC','#00A2E8','#22B14C','#FFF200','#FF7F27','#ED1C24','#880015','#7F7F7F','#000000');
        $top_demo_country = $this->account_model->getTopDemoAccountsCountByCountry( $date_from, $date_now, 10 );
        $total_demo_country = 0;
        $demo_country_count = array();
        foreach($top_demo_country as $key => $demo_country){
            $demo_country_code = $demo_country['country'];
            $total_demo_country += $demo_country['account_count'];
            $top_demo_country[$key]['name'] = $this->general_model->getCountries(strtoupper(trim($demo_country_code)));
            $top_demo_country[$key]['count'] = $demo_country['account_count'];
            $demo_country_data = $this->account_model->getDemoAccountsCountByCountry( $date_from, $date_now, $demo_country_code );
            foreach($demo_country_data as $key1 => $demo_data){
                $demo_country_count[$demo_country_code][] = "[". strtotime($demo_data['registration_date'])*1000 .",". $demo_data['registration_count'] ."]";
            }
        }

        $data['color_array'] = $color_array;
        $data['top_demo_country'] = $top_demo_country;
        $data['demo_country_count'] = $demo_country_count;
        $data['total_demo_country_count'] = $total_demo_country;
        $data['days'] = $days;

        $this->load->view('email/element/graph_top_demo_accounts', $data);
    }

    public function sendTopDemoAccountsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_top_demo_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyTopDemoAccountsGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'title' => 'Chart of all DEMO accounts from TOP 10 countries ' . $days . ' days - ' . date('m/d/Y', strtotime('now'))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
            $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->subject('Demo Accounts from Top 10 Countries');
        $this->email->message($this->load->view('email/daily_top_demo_accounts_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyTopPartnerAccountsGraph( $days = 180 ){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));

        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        $color_array = array('#A349A4','#3F48CC','#00A2E8','#22B14C','#FFF200','#FF7F27','#ED1C24','#880015','#7F7F7F','#000000');
        $top_partner_country = $this->account_model->getTopPartnerAccountsCountByCountry( $date_from, $date_now, 10 );
        $total_partner_country = 0;
        $partner_country_count = array();
        foreach($top_partner_country as $key => $partner_country){
            $partner_country_code = $partner_country['country'];
            $total_partner_country += $partner_country['account_count'];
            $top_partner_country[$key]['name'] = $this->general_model->getCountries(strtoupper(trim($partner_country_code)));
            $top_partner_country[$key]['count'] = $partner_country['account_count'];
            $partner_country_data = $this->account_model->getPartnerAccountsCountByCountry( $date_from, $date_now, $partner_country_code );
            foreach($partner_country_data as $key1 => $partner_data){
                $partner_country_count[$partner_country_code][] = "[". strtotime($partner_data['registration_date'])*1000 .",". $partner_data['registration_count'] ."]";
            }
        }

        $data['color_array'] = $color_array;
        $data['top_partner_country'] = $top_partner_country;
        $data['partner_country_count'] = $partner_country_count;
        $data['total_partner_country_count'] = $total_partner_country;
        $data['days'] = $days;

        $this->load->view('email/element/graph_top_partner_accounts', $data);
    }

    public function sendTopPartnerAccountsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_top_partner_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyTopPartnerAccountsGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'title' => 'Chart of all PARTNER accounts from TOP 10 countries ' . $days . ' days - ' . date('m/d/Y', strtotime('now'))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
            $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject('Partner Accounts from Top 10 Countries');
        $this->email->message($this->load->view('email/daily_top_partner_accounts_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyRealDepositsGraph($days = 180){
        $this->load->model('deposit_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        //Get Most Deposit Method
        $most_deposit = $this->deposit_model->getMostDepositMethods( $date_from, $date_now );
        $total_most_deposit = 0;
        foreach ($most_deposit as $key => $deposit) {
            $total_most_deposit += $deposit['deposit_amount'];
        }
        $most_deposit_chart_data = array();
        foreach ($most_deposit as $key => $deposit) {
            $percentage = number_format(($deposit['deposit_amount'] / $total_most_deposit) * 100, 2);
            $most_deposit_chart_data[] = "{ name: '" . strtoupper($deposit['transaction_type']) . "', y: " . $percentage . "}";
        }

        $data['most_deposit_chart_data'] = $most_deposit_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_real_deposits', $data);
    }

    public function sendRealDepositsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_real_deposits_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyRealDepositsGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'title' => 'Real Deposits : ' . $days . ' days - ' . date('m/d/Y', strtotime('now'))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
        $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->subject('Real Deposits');
        $this->email->message($this->load->view('email/daily_real_deposits_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyMostPopularCountriesGraph($days = 180){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        //Get Popular Countries for Live Accounts
        $popular_countries = $this->account_model->getPopularCountries( $date_from, $date_now, 20 );
        $total_popular_countries = 0;
        $exclude_countries = array();
        foreach ($popular_countries as $key => $country) {
            $total_popular_countries += $country['user_count'];
            $exclude_countries[] = $country['country'];
        }
        $other_popular_countries_count = $this->account_model->getOtherPopularCountriesCount( $date_from, $date_now, $exclude_countries );
        $total_popular_countries += $other_popular_countries_count;

        $popular_countries_chart_data = array();
        foreach ($popular_countries as $key => $country) {
            $percentage = number_format(($country['user_count'] / $total_popular_countries) * 100, 2);
            $country_name = addslashes($this->general_model->getCountries(strtoupper($country['country'])));

            $popular_countries_chart_data[] = "{ name: '" . (trim($country_name) == '' ? strtoupper($country['country']) : $country_name) . "', y: " . $percentage . "}";
        }
        if($other_popular_countries_count > 0) {
            $popular_countries_chart_data[] = "{ name: 'Others', y: " . number_format(($other_popular_countries_count / $total_popular_countries) * 100, 2) . "}";
        }

        $data['popular_countries_chart_data'] = $popular_countries_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_most_popular_countries', $data);
    }

    public function sendMostPopularCountriesGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_most_popular_countries_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyMostPopularCountriesGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'title' => 'Most Popular Countries : ' . $days . ' days - ' . date('m/d/Y', strtotime('now'))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->subject('Most Popular Countries');
        $this->email->message($this->load->view('email/daily_most_popular_countries_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyMostPopularDepositsGraph($days = 180){
        $this->load->model('deposit_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));

        //Get Popular Deposit Method
        $popular_deposit = $this->deposit_model->getPopularDepositMethods( $date_from, $date_now );
        $total_popular_deposit = 0;
        foreach ($popular_deposit as $key => $deposit) {
            $total_popular_deposit += $deposit['user_count'];
        }
        $popular_deposit_chart_data = array();
        foreach ($popular_deposit as $key => $deposit) {
            $percentage = number_format(($deposit['user_count'] / $total_popular_deposit) * 100, 2);
            $popular_deposit_chart_data[] = "{ name: '" . strtoupper($deposit['transaction_type']) . "', y: " . $percentage . "}";
        }

        $data['popular_deposit_chart_data'] = $popular_deposit_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_most_popular_deposits', $data);
    }

    public function sendMostPopularDepositsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_most_popular_deposits_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyMostPopularDepositsGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'title' => 'Most Popular Deposit Methods : ' . $days . ' days - ' . date('m/d/Y', strtotime('now'))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
        $this->email->to('fin-stats@forexmart.com');
//            $this->email->bcc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
        $this->email->subject('Most Popular Deposit Methods');
        $this->email->message($this->load->view('email/daily_most_popular_deposits_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function dailyDWSGraph($days = 180){
        $this->load->model('deposit_model');
        $this->load->model('withdraw_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));

        //Get deposit data for 180 days by default
        $deposits = $this->deposit_model->getDepositsByDate( $date_from, $date_now );
        $deposit_chart_data = array();
        foreach($deposits as $key => $deposit){
            $deposit_chart_data[]="[". strtotime($deposit['payment_date'])*1000 .",". number_format($deposit['amount'],2, '.', '') ."]";
        }

        //Get withdraw data for 180 days by default
        $withdrawals = $this->withdraw_model->getWithdrawalsByDate( $date_from, $date_now );
        $withdraw_chart_data = array();
        foreach($withdrawals as $key => $withdraw){
            $withdraw_chart_data[]="[". strtotime($withdraw['payment_date'])*1000 .",". number_format($withdraw['amount'],2, '.', '') ."]";
        }

        //Get saldo data for 180 days by default
        $saldos = $this->deposit_model->getAllSaldoByDate( $date_from, $date_now );
        $saldo_chart_data = array();
        foreach($saldos as $key => $saldo){
            $saldo_chart_data[]="[". strtotime($saldo['payment_date'])*1000 .",". number_format($saldo['amount'],2, '.', '') ."]";
        }

        $data['dws_chart'] = array(
            'deposit' => $deposit_chart_data,
            'withdraw' => $withdraw_chart_data,
            'saldo' => $saldo_chart_data
        );

        $data['days'] = $days;

        $this->load->view('email/element/graph_dws_accounts', $data);
    }

    public function sendDWSTopDepositsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $this->load->model('deposit_model');
        $date = new DateTime();
        $file_name = 'img_daily_dws_top_deposits_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyDWSGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));

        //Get Popular Deposit Method
        $top_deposit = $this->deposit_model->getTopDepositsByDate(20, $date_from, $date_now);
        $dws_data = array();
        $ctr = 1;
        foreach($top_deposit as $key => $value){
            $country_name = addslashes($this->general_model->getCountries(strtoupper($value['country'])));
//            $deposit_data = $this->deposit_model->getDepositByTransactionId($value['transaction_id']);
//            $tickets = array();
//            foreach($deposit_data as $d_key => $d_value){
//                $tickets[] = $d_value['mt_ticket'];
//            }
//            $comment_link = "<a href='#' class='mt-comment' data-info='" . implode(';', $tickets) . "'>View</a>";
            $dws_data[] = array(
                'full_name' => $value['full_name'],
                'country_name' => $country_name,
                'conv_amount' => number_format($value['conv_amount'],2),
                'transaction_type' => strtoupper($value['transaction_type']),
                'account_number' => $value['account_number'],
                'payment_date' => date('m/d/Y H:i:s', strtotime($value['payment_date']))
            );
            $ctr++;
        }

        $email_data = array(
            'title' => 'Top 20 Deposits : ' . $days . ' days as of ' .  date('F d, Y', strtotime('now')),
            'dws_data' => $dws_data,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('agus@forexmart.com');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Top 20 Deposits');
        $this->email->message($this->load->view('email/daily_dws_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDWSTopProcessedWithdrawGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $this->load->model('withdraw_model');
        $date = new DateTime();
        $file_name = 'img_daily_dws_top_p_withdraw_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyDWSGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));

        //Get Top 20 Processed Withdrawals
        $top_withdraw = $this->withdraw_model->getTopWithdrawalsByDate(20, $date_from, $date_now);
        $ctr = 1;
        foreach( $top_withdraw as $key => $withdraw){
            if(array_key_exists(strtoupper(trim($withdraw['transaction_type'])), $this->transaction_type)){
                $withdraw['transaction_type'] = $this->transaction_type[strtoupper(trim($withdraw['transaction_type']))];
            }
            $country_name = addslashes($this->general_model->getCountries(strtoupper($withdraw['country'])));
            $dws_data[] = array(
                'full_name' => $withdraw['full_name'],
                'country_name' => $country_name,
                'conv_amount' => number_format($withdraw['conv_amount'],2),
                'transaction_type' => $withdraw['transaction_type'],
                'account_number' => $withdraw['account_number'],
                'payment_date' => date('m/d/Y H:i:s', strtotime($withdraw['date_withdraw']))
            );
            $ctr++;
        }

        $email_data = array(
            'title' => 'Top 20 Processed Withdrawals : ' . $days . ' days as of ' .  date('F d, Y', strtotime('now')),
            'dws_data' => $dws_data,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Top 20 Processed Withdrawals');
        $this->email->message($this->load->view('email/daily_dws_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDWSLatestDepositsGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $this->load->model('deposit_model');
        $date = new DateTime();
        $file_name = 'img_daily_dws_top_deposits_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyDWSGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));

        $latest_deposit = $this->deposit_model->getLatestDepositsByDate(30, $date_from, $date_now);
        $ctr = 1;
        foreach($latest_deposit as $key => $value){
            $country_name = addslashes($this->general_model->getCountries(strtoupper($value['country'])));
            $dws_data[] = array(
                'full_name' => $value['full_name'],
                'country_name' => $country_name,
                'conv_amount' => number_format($value['conv_amount'],2),
                'transaction_type' => strtoupper($value['transaction_type']),
                'account_number' => $value['account_number'],
                'payment_date' => date('m/d/Y H:i:s', strtotime($value['payment_date']))
            );
            $ctr++;
        }

        $email_data = array(
            'title' => 'Last 30 Deposits : ' . $days . ' days as of ' .  date('F d, Y', strtotime('now')),
            'dws_data' => $dws_data,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Last 30 Deposits');
        $this->email->message($this->load->view('email/daily_dws_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDWSLatestProcessedWithdrawGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $this->load->model('withdraw_model');
        $date = new DateTime();
        $file_name = 'img_daily_dws_last_p_withdraw_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyDWSGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        //Get Last 30 Processed Withdrawals
        $latest_withdrawals = $this->withdraw_model->getLatestWithdrawalsByStatus(30, 1, $date_from, $date_now);
        $ctr = 1;
        foreach($latest_withdrawals as $key => $withdraw){
            if(array_key_exists(strtoupper(trim($withdraw['transaction_type'])), $this->transaction_type)){
                $withdraw['transaction_type'] = $this->transaction_type[strtoupper(trim($withdraw['transaction_type']))];
            }
            $country_name = addslashes($this->general_model->getCountries(strtoupper($withdraw['country'])));
            $dws_data[] = array(
                'full_name' => $withdraw['full_name'],
                'country_name' => $country_name,
                'conv_amount' => number_format($withdraw['conv_amount'],2),
                'transaction_type' => $withdraw['transaction_type'],
                'account_number' => $withdraw['account_number'],
                'payment_date' => date('m/d/Y H:i:s', strtotime($withdraw['date_withdraw']))
            );
            $ctr++;
        }

        $email_data = array(
            'title' => 'Last 30 Processed Withdrawals : ' . $days . ' days as of ' .  date('F d, Y', strtotime('now')),
            'dws_data' => $dws_data,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Last 30 Processed Withdrawals');
        $this->email->message($this->load->view('email/daily_dws_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDWSLatestRequestedWithdrawGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $this->load->model('withdraw_model');
        $date = new DateTime();
        $file_name = 'img_daily_dws_last_r_withdraw_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyDWSGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        //Get Last 30 Processed Withdrawals
        $latest_withdrawals = $this->withdraw_model->getLatestWithdrawalsByStatus(30, 0, $date_from, $date_now);
        $ctr = 1;
        foreach($latest_withdrawals as $key => $withdraw){
            if(array_key_exists(strtoupper(trim($withdraw['transaction_type'])), $this->transaction_type)){
                $withdraw['transaction_type'] = $this->transaction_type[strtoupper(trim($withdraw['transaction_type']))];
            }
            $country_name = addslashes($this->general_model->getCountries(strtoupper($withdraw['country'])));
            if(in_array($withdraw['status'], array(0, 2))){
                if( $withdraw['currency'] <> 'USD' ){
                    $converter_config = array(
                        'server' => 'converter',
                        'service_id' => '505641',
                        'service_password' => '5fX#p8D^c89bQ'
                    );

                    $WebService = new WebService($converter_config);

                    $data = array(
                        'amount' => $withdraw['amount'],
                        'from_currency' => $withdraw['currency'],
                        'to_currency' => 'USD'
                    );

                    $WebService->convert_currency_amount($data);
                    if( $WebService->request_status === 'RET_OK' ) {
                        $converted_amount = $WebService->get_result('ToAmount');
                        $amount = number_format($converted_amount,2);
                    }else{
                        $amount = $withdraw['amount'];
                    }
                }else{
                    $amount = number_format($withdraw['amount'],2);
                }
            }else{
                $amount = number_format($withdraw['conv_amount'],2);
            }

            $dws_data[] = array(
                'full_name' => $withdraw['full_name'],
                'country_name' => $country_name,
                'conv_amount' => $amount,
                'transaction_type' => $withdraw['transaction_type'],
                'account_number' => $withdraw['account_number'],
                'payment_date' => date('m/d/Y H:i:s', strtotime($withdraw['date_withdraw']))
            );
            $ctr++;
        }

        $email_data = array(
            'title' => 'Last 30 Requested Withdrawals : ' . $days . ' days as of ' .  date('F d, Y', strtotime('now')),
            'dws_data' => $dws_data,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->subject('Last 30 Requested Withdrawals');
        $this->email->message($this->load->view('email/daily_dws_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDWSLatestRejectedWithdrawGraph( $days = 180 ){
        ini_set('max_execution_time', 0);
        $this->load->model('withdraw_model');
        $date = new DateTime();
        $file_name = 'img_daily_dws_last_e_withdraw_graph_' . $days . '_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/dailyDWSGraph/' . $days . ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $date_now = date('Y-m-d', strtotime('now'));
        $date_from = date('Y-m-d', strtotime($date_now . ' -' . $days . ' days'));
        //Get Last 30 Processed Withdrawals
        $latest_withdrawals = $this->withdraw_model->getLatestWithdrawalsByStatus(30, 2, $date_from, $date_now);
        $ctr = 1;
        foreach($latest_withdrawals as $key => $withdraw){
            if(array_key_exists(strtoupper(trim($withdraw['transaction_type'])), $this->transaction_type)){
                $withdraw['transaction_type'] = $this->transaction_type[strtoupper(trim($withdraw['transaction_type']))];
            }
            $country_name = addslashes($this->general_model->getCountries(strtoupper($withdraw['country'])));
            if(in_array($withdraw['status'], array(0, 2))){
                if( $withdraw['currency'] <> 'USD' ){
                    $converter_config = array(
                        'server' => 'converter',
                        'service_id' => '505641',
                        'service_password' => '5fX#p8D^c89bQ'
                    );

                    $WebService = new WebService($converter_config);

                    $data = array(
                        'amount' => $withdraw['amount'],
                        'from_currency' => $withdraw['currency'],
                        'to_currency' => 'USD'
                    );

                    $WebService->convert_currency_amount($data);
                    if( $WebService->request_status === 'RET_OK' ) {
                        $converted_amount = $WebService->get_result('ToAmount');
                        $amount = number_format($converted_amount,2);
                    }else{
                        $amount = $withdraw['amount'];
                    }
                }else{
                    $amount = number_format($withdraw['amount'],2);
                }
            }else{
                $amount = number_format($withdraw['conv_amount'],2);
            }

            $dws_data[] = array(
                'full_name' => $withdraw['full_name'],
                'country_name' => $country_name,
                'conv_amount' => $amount,
                'transaction_type' => $withdraw['transaction_type'],
                'account_number' => $withdraw['account_number'],
                'payment_date' => date('m/d/Y H:i:s', strtotime($withdraw['date_withdraw']))
            );
            $ctr++;
        }

        $email_data = array(
            'title' => 'Last 30 Rejected Withdrawals : ' . $days . ' days as of ' .  date('F d, Y', strtotime('now')),
            'dws_data' => $dws_data,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
        $this->email->subject('Last 30 Rejected Withdrawals');
        $this->email->message($this->load->view('email/daily_dws_graph', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendWeeklyDWS(){
        $this->load->model('deposit_model');
        $this->load->model('withdraw_model');
        $date_now = date('Y-m-d H:i:s');
//        $date_now = '2016-02-28';
        $date_from = date('Y-m-d', strtotime('sunday -1 week', strtotime($date_now)));
        $date_to = date('Y-m-d', strtotime('last saturday', strtotime($date_now)));

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->getFinanceRecordByComment('FOREXMART SUPPORTER PART', date('Y-m-d 00:00:00', strtotime($date_from)), date('Y-m-d 23:59:59', strtotime($date_now)));
        $exclude_withdraw_accounts = array();
        if($WebService->request_status == 'RET_OK'){
            $finance_records = $WebService->get_result('FinanceRecords');
            $finance_data = $finance_records->FinanceRecordData;
            foreach($finance_data as $key => $data){
                $exclude_withdraw_accounts[] = $data->AccountNumber;
            }
        }

        $dws_all = $this->deposit_model->getAllSaldoByDate($date_from, $date_to, $exclude_withdraw_accounts);
        $dws_total_weekly = $this->deposit_model->getTotalSaldoByDate( $date_from, $date_to, $exclude_withdraw_accounts );
        $dws_total_supporter_withdraw = $this->withdraw_model->getTotalSupporterWithdraw( $date_from, $date_now, $exclude_withdraw_accounts );
//        echo $week_from . ' - ' .$date_now;
        $email_data = array(
            'date_from' => $date_from,
            'date_to' => $date_to,
            'dws_all' => $dws_all,
            'dws_total_weekly' => $dws_total_weekly,
            'dws_total_supporter_withdraw' => $dws_total_supporter_withdraw
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->subject('Weekly Deposits, Withdrawals and Saldo [' . $date_from . ' - ' . $date_to . ']');
        $this->email->message($this->load->view('email/weekly_dws', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            //echo $this->email->print_debugger();
        }
    }

    protected function sendOldDailyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));
//        $date_now = '2016-4-20 07:00:00';
        //Get Records for the last 24 hours
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $opened_client_day = $this->account_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_partner_day = $this->partnership_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_accounts_day = $opened_client_day + $opened_partner_day;
        $uploaded_client_documents_day = $this->user_model->getDocumentsCountByDateRange($date_last_day, $date_now);
        $uploaded_partner_documents_day = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_day, $date_now);
        $uploaded_documents_day = $uploaded_client_documents_day + $uploaded_partner_documents_day;
        $old_uploaded_client_documents_day = $this->user_model->getPendingDocumentsCountByEndDate($date_last_day, $date_last_day, $date_now);
        $old_uploaded_partner_documents_day = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_day, $date_last_day, $date_now);
        $old_uploaded_documents_day = $old_uploaded_client_documents_day + $old_uploaded_partner_documents_day;
        $client_verified_day = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_day, $date_now);
        $partner_verified_day = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_day, $date_now);
        $accounts_verified_day = $client_verified_day + $partner_verified_day;
        $client_pending_day = $this->account_model->getAccountsPendingCountByDateRange($date_last_day, $date_now);
        $partner_pending_day = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_day, $date_now);
        $accounts_pending_day = $client_pending_day + $partner_pending_day;
        $client_declined_day = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_day, $date_now);
        $partner_declined_day = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_day, $date_now);
        $accounts_declined_day = $client_declined_day + $partner_declined_day;
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_day, $date_now, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_day = ' . $uploaded_client_documents_day . '<br/>';
//        echo '$uploaded_partner_documents_day = ' . $uploaded_partner_documents_day . '<br/>';
//        echo '$old_uploaded_client_documents_day = ' . $old_uploaded_client_documents_day . '<br/>';
//        echo '$old_uploaded_partner_documents_day = ' . $old_uploaded_partner_documents_day . '<br/>';

        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country'] );
            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_day, $date_now, $top_country['country'] );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_day, $date_last_day, $date_now, 1, $top_country['country']);
            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_day, $date_last_day, $date_now, $top_country['country']);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
            'opened_accounts_day' => $opened_accounts_day,
            'old_uploaded_documents_day' => $old_uploaded_documents_day,
            'uploaded_documents_day' => $uploaded_documents_day,
            'accounts_verified_day' => $accounts_verified_day,
            'accounts_pending_day' => $accounts_pending_day,
            'accounts_declined_day' => $accounts_declined_day,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('Y-m-d', strtotime($date_now))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('auto-reports@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/daily_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function tryDailyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));
//        $date_now = '2016-4-20 07:00:00';
        //Get Records for the last 24 hours
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $opened_client_day = $this->account_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_partner_day = $this->partnership_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_accounts_day = $opened_client_day + $opened_partner_day;
        $uploaded_client_documents_day = $this->user_model->getDocumentsCountByDateRange($date_last_day, $date_now);
        $uploaded_partner_documents_day = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_day, $date_now);
        $uploaded_documents_day = $uploaded_client_documents_day + $uploaded_partner_documents_day;
        $old_uploaded_client_documents_day = $this->user_model->getPendingDocumentsCountByEndDate($date_last_day, $date_last_day, $date_now);
        $old_uploaded_partner_documents_day = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_day, $date_last_day, $date_now);
        $old_uploaded_documents_day = $old_uploaded_client_documents_day + $old_uploaded_partner_documents_day;
        $client_verified_day = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_day, $date_now);
        $partner_verified_day = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_day, $date_now);
        $accounts_verified_day = $client_verified_day + $partner_verified_day;
        $client_pending_day = $this->account_model->getAccountsPendingCountByDateRange($date_last_day, $date_now);
        $partner_pending_day = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_day, $date_now);
        $accounts_pending_day = $client_pending_day + $partner_pending_day;
        $client_declined_day = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_day, $date_now);
        $partner_declined_day = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_day, $date_now);
        $accounts_declined_day = $client_declined_day + $partner_declined_day;
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_day, $date_now, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_day = ' . $uploaded_client_documents_day . '<br/>';
//        echo '$uploaded_partner_documents_day = ' . $uploaded_partner_documents_day . '<br/>';
//        echo '$old_uploaded_client_documents_day = ' . $old_uploaded_client_documents_day . '<br/>';
//        echo '$old_uploaded_partner_documents_day = ' . $old_uploaded_partner_documents_day . '<br/>';

        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country'] );
            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_day, $date_now, $top_country['country'] );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_day, $date_last_day, $date_now, 1, $top_country['country']);
            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_day, $date_last_day, $date_now, $top_country['country']);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
            'opened_accounts_day' => $opened_accounts_day,
            'old_uploaded_documents_day' => $old_uploaded_documents_day,
            'uploaded_documents_day' => $uploaded_documents_day,
            'accounts_verified_day' => $accounts_verified_day,
            'accounts_pending_day' => $accounts_pending_day,
            'accounts_declined_day' => $accounts_declined_day,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('Y-m-d', strtotime($date_now))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/daily_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function sendDailyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));
//        $date_now = '2016-4-20 07:00:00';
        //Get Records for the last 24 hours
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $uploaded_client_documents_day = $this->account_model->getVerificationDocumentsCountByDate($date_last_day, $date_now);
        $uploaded_partner_documents_day = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_day, $date_now);
        $uploaded_documents_day = $uploaded_client_documents_day + $uploaded_partner_documents_day;

        $old_uploaded_client_documents_day = $this->account_model->getVerificationDocumentsCountByDate($date_last_day, $date_now, true);
        $old_uploaded_partner_documents_day = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_day, $date_now, true);
        $old_uploaded_documents_day = $old_uploaded_client_documents_day + $old_uploaded_partner_documents_day;

        $client_verified_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 1);
        $partner_verified_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 1);
        $accounts_verified_day = $client_verified_day + $partner_verified_day;

        $client_pending_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 0);
        $partner_pending_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 0);
        $accounts_pending_day = $client_pending_day + $partner_pending_day;

        $client_declined_day = $this->account_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 2);
        $partner_declined_day = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_day, $date_now, 2);
        $accounts_declined_day = $client_declined_day + $partner_declined_day;

        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_day, $date_now, 1, 10);
        $top_upload_countries = array();

        foreach( $top_countries as $key => $top_country ){
            $country_client_documents_count = $this->account_model->getVerificationDocumentsCountByCountryDate($date_last_day, $date_now, $top_country['country'] );
            $country_partner_documents_count = $this->partnership_model->getVerificationDocumentsCountByCountryDate($date_last_day, $date_now, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;

            $country_old_client_documents_count = $this->account_model->getVerificationDocumentsCountByCountryDate($date_last_day, $date_now, $top_country['country'], true);
            $country_old_partner_documents_count = $this->partnership_model->getVerificationDocumentsCountByCountryDate($date_last_day, $date_now, $top_country['country'], true);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;

            $country_client_verified_count = $this->account_model->getVerificationDocumentsCountByCountryStatus( $date_last_day, $date_now, $top_country['country'], 1 );
            $country_partner_verified_count = $this->partnership_model->getVerificationDocumentsCountByCountryStatus( $date_last_day, $date_now, $top_country['country'], 1 );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;

            $country_client_declined_count = $this->account_model->getVerificationDocumentsCountByCountryStatus( $date_last_day, $date_now, $top_country['country'], 2 );
            $country_partner_declined_count = $this->partnership_model->getVerificationDocumentsCountByCountryStatus( $date_last_day, $date_now, $top_country['country'], 2 );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
//            'opened_accounts_day' => $opened_accounts_day,
            'old_uploaded_documents_day' => $old_uploaded_documents_day,
            'uploaded_documents_day' => $uploaded_documents_day,
            'accounts_verified_day' => $accounts_verified_day,
            'accounts_pending_day' => $accounts_pending_day,
            'accounts_declined_day' => $accounts_declined_day,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('Y-m-d', strtotime($date_now))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('auto-reports@forexmart.com');
        $this->email->to('agus@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/daily_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function sendOldWeeklyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');
        $now = date('Y-m-d H:i:s', strtotime('last sunday'));
        $date_last_week = date('Y-m-d', strtotime('last sunday', strtotime($now)));
        $date_now = date('Y-m-d', strtotime('last saturday', strtotime($now)));
//        $date_now = date('Y-m-d H:i:s', strtotime('now'));
//        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $opened_client_week = $this->account_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_partner_week = $this->partnership_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_accounts_week = $opened_client_week + $opened_partner_week;
        $uploaded_client_documents_week = $this->user_model->getDocumentsCountByDateRange($date_last_week, $date_now);
        $uploaded_partner_documents_week = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_week, $date_now);
        $uploaded_documents_week = $uploaded_client_documents_week + $uploaded_partner_documents_week;
        $old_uploaded_client_documents_week = $this->user_model->getPendingDocumentsCountByEndDate($date_last_week, $date_last_week, $date_now);
        $old_uploaded_partner_documents_week = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_week, $date_last_week, $date_now);
        $old_uploaded_documents_week = $old_uploaded_client_documents_week + $old_uploaded_partner_documents_week;
        $client_verified_week = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_week, $date_now);
        $partner_verified_week = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_week, $date_now);
        $accounts_verified_week = $client_verified_week + $partner_verified_week;
        $client_pending_week = $this->account_model->getAccountsPendingCountByDateRange($date_last_week, $date_now);
        $partner_pending_week = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_week, $date_now);
        $accounts_pending_week = $client_pending_week + $partner_pending_week;
        $client_declined_week = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_week, $date_now);
        $partner_declined_week = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_week, $date_now);
        $accounts_declined_week = $client_declined_week + $partner_declined_week;
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_week, $date_now, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_week = ' . $uploaded_client_documents_week . '<br/>';
//        echo '$uploaded_partner_documents_week = ' . $uploaded_partner_documents_week . '<br/>';
//        echo '$old_uploaded_client_documents_week = ' . $old_uploaded_client_documents_week . '<br/>';
//        echo '$old_uploaded_partner_documents_week = ' . $old_uploaded_partner_documents_week . '<br/>';

        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_week, $date_now, 1, $top_country['country'] );
            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_week, $date_now, 1, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_week, $date_now, $top_country['country'] );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_week, $date_last_week, $date_now, 1, $top_country['country']);
            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_week, $date_last_week, $date_now, $top_country['country']);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
            'opened_accounts_week' => $opened_accounts_week,
            'old_uploaded_documents_week' => $old_uploaded_documents_week,
            'uploaded_documents_week' => $uploaded_documents_week,
            'accounts_verified_week' => $accounts_verified_week,
            'accounts_pending_week' => $accounts_pending_week,
            'accounts_declined_week' => $accounts_declined_week,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('Y-m-d', strtotime($date_now)) . ' to ' . date('Y-m-d', strtotime($date_last_week))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('auto-reports@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/weekly_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function sendWeeklyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

        $now = date('Y-m-d H:i:s', strtotime('last sunday'));
        $date_last_week = date('Y-m-d 00:00:00', strtotime('last sunday', strtotime($now)));
        $date_now = date('Y-m-d 23:59:59', strtotime('last saturday', strtotime($now)));
//        $date_now = date('Y-m-d H:i:s', strtotime('now'));
//        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
//        $opened_client_week = $this->account_model->getAccountsCountByDateRange($date_last_week, $date_now);
//        $opened_partner_week = $this->partnership_model->getAccountsCountByDateRange($date_last_week, $date_now);
//        $opened_accounts_week = $opened_client_week + $opened_partner_week;
        $uploaded_client_documents_week = $this->account_model->getVerificationDocumentsCountByDate($date_last_week, $date_now);
        $uploaded_partner_documents_week = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_week, $date_now);
        $uploaded_documents_week = $uploaded_client_documents_week + $uploaded_partner_documents_week;
//        $uploaded_client_documents_week = $this->user_model->getDocumentsCountByDateRange($date_last_week, $date_now);
//        $uploaded_partner_documents_week = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_week, $date_now);
        $old_uploaded_client_documents_week = $this->account_model->getVerificationDocumentsCountByDate($date_last_week, $date_now, true);
        $old_uploaded_partner_documents_week = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_week, $date_now, true);
        $old_uploaded_documents_week = $old_uploaded_client_documents_week + $old_uploaded_partner_documents_week;
//        $old_uploaded_client_documents_week = $this->user_model->getPendingDocumentsCountByEndDate($date_last_week, $date_last_week, $date_now);
//        $old_uploaded_partner_documents_week = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_week, $date_last_week, $date_now);
        $client_verified_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 1);
        $partner_verified_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 1);
        $accounts_verified_week = $client_verified_week + $partner_verified_week;
//        $client_verified_week = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_week, $date_now);
//        $partner_verified_week = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_week, $date_now);
        $client_pending_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 0);
        $partner_pending_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 0);
        $accounts_pending_week = $client_pending_week + $partner_pending_week;
//        $client_pending_week = $this->account_model->getAccountsPendingCountByDateRange($date_last_week, $date_now);
//        $partner_pending_week = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_week, $date_now);
        $client_declined_week = $this->account_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 2);
        $partner_declined_week = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_week, $date_now, 2);
        $accounts_declined_week = $client_declined_week + $partner_declined_week;
//        $client_declined_week = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_week, $date_now);
//        $partner_declined_week = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_week, $date_now);
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_week, $date_now, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_week = ' . $uploaded_client_documents_week . '<br/>';
//        echo '$uploaded_partner_documents_week = ' . $uploaded_partner_documents_week . '<br/>';
//        echo '$old_uploaded_client_documents_week = ' . $old_uploaded_client_documents_week . '<br/>';
//        echo '$old_uploaded_partner_documents_week = ' . $old_uploaded_partner_documents_week . '<br/>';

        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
//            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_week, $date_now, 1, $top_country['country'] );
//            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_week, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->account_model->getVerificationDocumentsCountByCountryDate($date_last_week, $date_now, $top_country['country'] );
            $country_partner_documents_count = $this->partnership_model->getVerificationDocumentsCountByCountryDate($date_last_week, $date_now, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
//            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_week, $date_last_week, $date_now, 1, $top_country['country']);
//            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_week, $date_last_week, $date_now, $top_country['country']);
            $country_old_client_documents_count = $this->account_model->getVerificationDocumentsCountByCountryDate($date_last_week, $date_now, $top_country['country'], true);
            $country_old_partner_documents_count = $this->partnership_model->getVerificationDocumentsCountByCountryDate($date_last_week, $date_now, $top_country['country'], true);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
//            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
//            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_week, $date_now, $top_country['country'] );
            $country_client_verified_count = $this->account_model->getVerificationDocumentsCountByCountryStatus( $date_last_week, $date_now, $top_country['country'], 1 );
            $country_partner_verified_count = $this->partnership_model->getVerificationDocumentsCountByCountryStatus( $date_last_week, $date_now, $top_country['country'], 1 );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
//            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
//            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_client_declined_count = $this->account_model->getVerificationDocumentsCountByCountryStatus( $date_last_week, $date_now, $top_country['country'], 2 );
            $country_partner_declined_count = $this->partnership_model->getVerificationDocumentsCountByCountryStatus( $date_last_week, $date_now, $top_country['country'], 2 );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
//            'opened_accounts_week' => $opened_accounts_week,
            'old_uploaded_documents_week' => $old_uploaded_documents_week,
            'uploaded_documents_week' => $uploaded_documents_week,
            'accounts_verified_week' => $accounts_verified_week,
            'accounts_pending_week' => $accounts_pending_week,
            'accounts_declined_week' => $accounts_declined_week,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('Y-m-d', strtotime($date_last_week)) . ' to ' . date('Y-m-d', strtotime($date_now))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('auto-reports@forexmart.com');
//        $this->email->cc('agus@forexmart.com');
        $this->email->to('auto-reports@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/weekly_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function sendOldMonthlyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));

        $date_last_month =  date('Y-m-01 H:i:s', strtotime($date_now . ' -1 month'));
        $date_end_last_month = date('Y-m-t H:i:s', strtotime($date_last_month));

        $opened_client_month = $this->account_model->getAccountsCountByDateRange($date_last_month, $date_end_last_month);
        $opened_partner_month = $this->partnership_model->getAccountsCountByDateRange($date_last_month, $date_end_last_month);
        $opened_accounts_month = $opened_client_month + $opened_partner_month;
        $uploaded_client_documents_month = $this->user_model->getDocumentsCountByDateRange($date_last_month, $date_end_last_month);
        $uploaded_partner_documents_month = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_month, $date_end_last_month);
        $uploaded_documents_month = $uploaded_client_documents_month + $uploaded_partner_documents_month;
        $old_uploaded_client_documents_month = $this->user_model->getPendingDocumentsCountByEndDate($date_last_month, $date_last_month, $date_end_last_month);
        $old_uploaded_partner_documents_month = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_month, $date_last_month, $date_end_last_month);
        $old_uploaded_documents_month = $old_uploaded_client_documents_month + $old_uploaded_partner_documents_month;
        $client_verified_month = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_month, $date_end_last_month);
        $partner_verified_month = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_month, $date_end_last_month);
        $accounts_verified_month = $client_verified_month + $partner_verified_month;
        $client_pending_month = $this->account_model->getAccountsPendingCountByDateRange($date_last_month, $date_end_last_month);
        $partner_pending_month = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_month, $date_end_last_month);
        $accounts_pending_month = $client_pending_month + $partner_pending_month;
        $client_declined_month = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_month, $date_end_last_month);
        $partner_declined_month = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_month, $date_end_last_month);
        $accounts_declined_month = $client_declined_month + $partner_declined_month;
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_month, $date_end_last_month, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_month = ' . $uploaded_client_documents_month . '<br/>';
//        echo '$uploaded_partner_documents_month = ' . $uploaded_partner_documents_month . '<br/>';
//        echo '$old_uploaded_client_documents_month = ' . $old_uploaded_client_documents_month . '<br/>';
//        echo '$old_uploaded_partner_documents_month = ' . $old_uploaded_partner_documents_month . '<br/>';

        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_month, $date_end_last_month, 1, $top_country['country'] );
            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_month, $date_end_last_month, 1, $top_country['country'] );
            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_month, $date_end_last_month, 1, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_month, $date_end_last_month, 1, $top_country['country'] );
            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_month, $date_end_last_month, $top_country['country'] );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_month, $date_end_last_month, 1, $top_country['country'] );
            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_month, $date_end_last_month, 1, $top_country['country'] );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_month, $date_last_month, $date_end_last_month, 1, $top_country['country']);
            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_month, $date_last_month, $date_end_last_month, $top_country['country']);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
            'opened_accounts_month' => $opened_accounts_month,
            'old_uploaded_documents_month' => $old_uploaded_documents_month,
            'uploaded_documents_month' => $uploaded_documents_month,
            'accounts_verified_month' => $accounts_verified_month,
            'accounts_pending_month' => $accounts_pending_month,
            'accounts_declined_month' => $accounts_declined_month,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('F', strtotime($date_last_month))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('auto-reports@forexmart.com');
        $this->email->bcc('agus@forexmart.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/monthly_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function sendMonthlyVerificationAutoReport(){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));

        $date_last_month =  date('Y-m-01 00:00:00', strtotime($date_now . ' -1 month'));
        $date_now = date('Y-m-t 23:59:59', strtotime($date_last_month));

        $uploaded_client_documents_month = $this->account_model->getVerificationDocumentsCountByDate($date_last_month, $date_now);
        $uploaded_partner_documents_month = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_month, $date_now);
        $uploaded_documents_month = $uploaded_client_documents_month + $uploaded_partner_documents_month;
//        $uploaded_client_documents_month = $this->user_model->getDocumentsCountByDateRange($date_last_month, $date_now);
//        $uploaded_partner_documents_month = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_month, $date_now);
        $old_uploaded_client_documents_month = $this->account_model->getVerificationDocumentsCountByDate($date_last_month, $date_now, true);
        $old_uploaded_partner_documents_month = $this->partnership_model->getVerificationDocumentsCountByDate($date_last_month, $date_now, true);
        $old_uploaded_documents_month = $old_uploaded_client_documents_month + $old_uploaded_partner_documents_month;
//        $old_uploaded_client_documents_month = $this->user_model->getPendingDocumentsCountByEndDate($date_last_month, $date_last_month, $date_now);
//        $old_uploaded_partner_documents_month = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_month, $date_last_month, $date_now);
        $client_verified_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 1);
        $partner_verified_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 1);
        $accounts_verified_month = $client_verified_month + $partner_verified_month;
//        $client_verified_month = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_month, $date_now);
//        $partner_verified_month = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_month, $date_now);
        $client_pending_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 0);
        $partner_pending_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 0);
        $accounts_pending_month = $client_pending_month + $partner_pending_month;
//        $client_pending_month = $this->account_model->getAccountsPendingCountByDateRange($date_last_month, $date_now);
//        $partner_pending_month = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_month, $date_now);
        $client_declined_month = $this->account_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 2);
        $partner_declined_month = $this->partnership_model->getVerificationDocumentsCountByStatus($date_last_month, $date_now, 2);
        $accounts_declined_month = $client_declined_month + $partner_declined_month;
//        $client_declined_month = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_month, $date_now);
//        $partner_declined_month = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_month, $date_now);
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_month, $date_now, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_month = ' . $uploaded_client_documents_month . '<br/>';
//        echo '$uploaded_partner_documents_month = ' . $uploaded_partner_documents_month . '<br/>';
//        echo '$old_uploaded_client_documents_month = ' . $old_uploaded_client_documents_month . '<br/>';
//        echo '$old_uploaded_partner_documents_month = ' . $old_uploaded_partner_documents_month . '<br/>';

        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_month, $date_now, 1, $top_country['country'] );
//            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_month, $date_now, 1, $top_country['country'] );
//            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_month, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->account_model->getVerificationDocumentsCountByCountryDate($date_last_month, $date_now, $top_country['country'] );
            $country_partner_documents_count = $this->partnership_model->getVerificationDocumentsCountByCountryDate($date_last_month, $date_now, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
//            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_month, $date_last_month, $date_now, 1, $top_country['country']);
//            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_month, $date_last_month, $date_now, $top_country['country']);
            $country_old_client_documents_count = $this->account_model->getVerificationDocumentsCountByCountryDate($date_last_month, $date_now, $top_country['country'], true);
            $country_old_partner_documents_count = $this->partnership_model->getVerificationDocumentsCountByCountryDate($date_last_month, $date_now, $top_country['country'], true);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
//            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_month, $date_now, 1, $top_country['country'] );
//            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_month, $date_now, $top_country['country'] );
            $country_client_verified_count = $this->account_model->getVerificationDocumentsCountByCountryStatus( $date_last_month, $date_now, $top_country['country'], 1 );
            $country_partner_verified_count = $this->partnership_model->getVerificationDocumentsCountByCountryStatus( $date_last_month, $date_now, $top_country['country'], 1 );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
//            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_month, $date_now, 1, $top_country['country'] );
//            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_month, $date_now, 1, $top_country['country'] );
            $country_client_declined_count = $this->account_model->getVerificationDocumentsCountByCountryStatus( $date_last_month, $date_now, $top_country['country'], 2 );
            $country_partner_declined_count = $this->partnership_model->getVerificationDocumentsCountByCountryStatus( $date_last_month, $date_now, $top_country['country'], 2 );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
//            'opened_accounts_month' => $opened_accounts_month,
            'old_uploaded_documents_month' => $old_uploaded_documents_month,
            'uploaded_documents_month' => $uploaded_documents_month,
            'accounts_verified_month' => $accounts_verified_month,
            'accounts_pending_month' => $accounts_pending_month,
            'accounts_declined_month' => $accounts_declined_month,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('F', strtotime($date_last_month))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('auto-reports@forexmart.com');
//        $this->email->cc('agus@forexmart.com');
        $this->email->to('auto-reports@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/monthly_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    protected function sendNoDepositClientRequest(){
        $this->load->model('deposit_model');
        $this->load->model('account_model');
        $date_request = date('Y-m-d H:i:s', strtotime('-33 hours'));
        $no_deposit_unsent = $this->deposit_model->getUnsentNoDepositByDate($date_request);

        foreach( $no_deposit_unsent as $key => $no_deposit ){
            $account_details = $this->account_model->getUserEmailByUserId($no_deposit['user_id']);
            $email_data = array(
                'title' => 'Application for No Deposit Bonus to account ' . $no_deposit['account_number']
            );
            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to($account_details[0]['email']);
//        $this->email->cc('agus@forexmart.com');
//        $this->email->to('vela.nightclad@gmail.com');
            $this->email->subject($email_data['title']);
            $this->email->message($this->load->view('email/no-deposit-request-html', $email_data, TRUE));
            if($this->email->send()){
                $this->deposit_model->updateNoDepositSentByUserID($no_deposit['user_id']);
                //echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }
        }
    }

    protected function sendNoDepositClientRequest24(){
        $this->load->model('deposit_model');
        $this->load->model('account_model');
        $date_request = date('Y-m-d H:i:s', strtotime('-58 hours'));
        $no_deposit_unsent = $this->deposit_model->getUnsentNoDepositByDate24($date_request);

        foreach( $no_deposit_unsent as $key => $no_deposit ){
            $account_details = $this->account_model->getUserEmailByUserId($no_deposit['user_id']);
            $email_data = array(
                'title' => 'Countdown to Limited Bonus! Get it now!'
            );
            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');

          //  $this->email->to($account_details[0]['email']);
            $this->email->to('agus@forexmart.com');
            $this->email->bcc('bug.fxpp@gmail.com');
            $this->email->subject($email_data['title']);
            $this->email->message($this->load->view('email/ndb_24', $email_data, TRUE));
            if($this->email->send()){
                $this->deposit_model->updateNoDepositSentByUserID24($no_deposit['user_id']);
                //echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }
        }
    }

    public function convertCountryCodes(){
        ini_set('max_execution_time', 0);
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('general_model');

        $webservice_config = array(
            'server' => 'live_new'
        );

        $WebService = new WebService($webservice_config);
        $WebService->get_accounts_country_code();
        if ($WebService->request_status === 'RET_OK') {
            $accounts = $WebService->get_result('AccountsList');
            $accounts_data = $accounts->AccountData;
            $ctr = 0;
//            var_dump($accounts_data);
            foreach($accounts_data as $key => $account){

                $user_ids = $this->user_model->getUserIdbyAccountNumber($account->LogIn);
//                var_dump($user_ids);
                if($user_ids){
                    foreach($user_ids as $user_key => $user_id ){
                        $profile = $this->user_model->getUserProfileByUserId( $user_id['user_id'] );
//                    var_dump($profile);
                        if($profile && (trim($account->Country) <> '' || !empty($profile['country']))){

                            if(trim($account->Country) == ''){
                                if(trim($profile['country']) == '' || empty($profile['country'])){
                                    $country_name = '';
                                }else{
                                    $country_name = $this->general_model->getCountries($profile['country']);
                                }
                            }else{
                                $country_name = $this->general_model->getCountries($account->Country);
                            }
//                        sleep(2000);
                            $user_details = $this->account_model->getAccountDetailsByAccountNumber($account->LogIn);
//                        var_dump($user_details);
                            if($user_details){
                                $WebService2 = new WebService($webservice_config);
                                $info = array(
                                    'account_number' => $account->LogIn,
                                    'city' => $user_details['city'],
                                    'country' => $country_name,
                                    'email' => $user_details['email'],
                                    'full_name' => $user_details['full_name'],
                                    'phone_number' => $user_details['phone1'],
                                    'state' => $user_details['state'],
                                    'street_address' => $user_details['address'],
                                    'zip_code' => $user_details['zip']
                                );

                                //$this->general_model->insert('tmp_account_update', $info);
//                            var_dump($info);
                                $test = $WebService2->update_live_account_details( $info );
                                if($WebService2->request_status == 'RET_OK'){
                                    echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':Updated</br>';
                                }else{
                                    var_dump($test);
                                    echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $WebService2->request_status . '</br>';
                                }
////
                                if($ctr > 20){
                                    break 2;
                                }else{
                                    $ctr++;
                                }
//                            unset($WebService2);
                            }
                        }else{
                            if(trim($account->Country) == ''){
                                echo $account->LogIn . ':' . $account->Country . ':N/A</br>';
                                $country_name = '';
                            }else{
                                $country_name = $this->general_model->getCountries($account->Country);
                            }
                        }

                    }
                }else{
                    if(trim($account->Country) == ''){
                            $country_name = '';
                    }else{
                        $country_name = $this->general_model->getCountries($account->Country);
                    }

                    $WebService2 = new WebService($webservice_config);
                    $info = array(
                        'account_number' => $account->LogIn,
                        'city' => $account->City,
                        'country' => $country_name,
                        'email' => $account->Email,
                        'full_name' => $account->Name,
                        'phone_number' => $account->PhoneNumber,
                        'state' => $account->State,
                        'street_address' => $account->Address,
                        'zip_code' => $account->ZipCode
                    );

                    //$this->general_model->insert('tmp_account_update', $info);
//                            var_dump($info);
                    $test = $WebService2->update_live_account_details( $info );
                    if($WebService2->request_status == 'RET_OK'){
                        echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':Updated</br>';
                    }else{
                        var_dump($test);
                        echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $WebService2->request_status . '</br>';
                    }
////
                    if($ctr > 20){
                        break 1;
                    }else{
                        $ctr++;
                    }
                }
            }
        }else{
            echo $WebService->request_status;
        }
    }

    private function get_convert_amount($currency, $amount, $to_currency = 'USD') {
        if ($currency == $to_currency) {
            $conv_amount = $amount;
        } else {
            $converter_config = array(
                'server' => 'converter'
            );

            $WebService = new WebService($converter_config);
            $data = array(
                'Amount' => $amount,
                'FromCurrency' => $currency,
                'ToCurrency' => $to_currency,
                'ServiceLogin' => '505641',
                'ServicePassword' => '5fX#p8D^c89bQ'
            );

            $ConvertCurrency = $WebService->ConvertCurrency($data);
            $resultConvertCurrency = $ConvertCurrency['ConvertCurrencyResult'];
            if ($resultConvertCurrency['Status'] === 'RET_OK') {
                $converted_amount = $resultConvertCurrency['ToAmount'];
                $conv_amount = number_format($converted_amount, 2);
            } else {
                $conv_amount = $amount;
            }
        }

        return $conv_amount;
    }



    public function periodicRebate($period=0){

        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');

        switch( $period){
            case 1:
                $from = date('Y-m-d H:i:s', strtotime('-1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            case 2:
                $from = date('Y-m-d H:i:s', strtotime('-1 week -1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            case 3:
                $from = date('Y-m-d H:i:s', strtotime('-1 month -1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            default:
                $from = date('Y-m-d H:i:s', strtotime('+1 day')); // no calculation
                $to = date('Y-m-d H:i:s', strtotime('+1 day')); // no calculation
        }


 // echo $from."<br>".$to;
        echo "<pre>";
        $webservice_config = array(
            'server' => 'live_new'
        );

        if($rebate_list  = $this->deposit_model->getRebateList($period)){

            foreach($rebate_list as $d){
                if($d->status ==1){

                    $WebService = new WebService($webservice_config);
                    $account_info = array(
                        'iAgent' => $d->reference_num, // int Agent Account Number
                        'iAccount' => $d->account_number,
                        'from' => date('Y-m-d\T00:00:00', strtotime($from)),
                        'to' => date('Y-m-d\T23:59:59', strtotime($to))
                    );

                    if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){

                       if($commission->TotalAmount>0){
                           $data_input = array(
                               'agent'=>$commission->AgentLogin,
                               'account'=>$commission->FromAccount,
                               'amount'=>$commission->TotalAmount*$d->new_value,
                               'pip'=>$d->new_value,
                               'date'=>date('Y-m-d H:i:s')
                           );
                            $this->general_model->insert('rebate_log',$data_input);

                           //================ Commission using API ==========================================

                           $accData = $this->general_model->showssingle("mt_accounts_set", "account_number", $commission->FromAccount, "*");
                           $partnerData = $this->general_model->showssingle("partnership", "reference_num", $commission->AgentLogin, "*");

                           $conv_amount = $this->get_convert_amount($accData['mt_currency_base'], $data_input['amount'], $partnerData['currency']);
                           $config = array(
                               'server' => 'live_new'
                           );
                           $WebService = new WebService($config);
                           $account_number = $accData['account_number'];
                           $WebService->update_live_deposit_balance($account_number, $conv_amount, "Rebate commission from ".$commission->AgentLogin);
                           if ($WebService->request_status === 'RET_OK') {
                               $data['mt_ticket'] = $WebService->get_result('Ticket');
                               $WebService2 = new WebService($config);
                               $WebService2->request_live_account_balance($account_number);
                               if ($WebService2->request_status === 'RET_OK') {
                                   $balance = $WebService2->get_result('Balance');
                                   $this->deposit_model->updateAccountBalance($account_number, $balance);

                                   // ================================== Deduct rebate commission


                                   $config = array(
                                       'server' => 'live_new'
                                   );
                                   $WebService = new WebService($config);
                                   $account_number = $commission->AgentLogin;
                                   $WebService->update_live_deposit_balance($account_number, -$data_input['amount'], "Rebate to ".$commission->AgentLogin." where ".$commission->FromAccount." is account number of client");
                                   if ($WebService->request_status === 'RET_OK') {
                                       $data['mt_ticket'] = $WebService->get_result('Ticket');
                                       $WebService2 = new WebService($config);
                                       $WebService2->request_live_account_balance($account_number);
                                       if ($WebService2->request_status === 'RET_OK') {
                                           $balance = $WebService2->get_result('Balance');
                                           $this->deposit_model->updatePartnerBalance($account_number, $balance);

                                       }
                                   }

                                   // ============================
                               }
                           }





                           // end ===============================================

                       }


                    }
                }
            }
        }
    }

    public function sendDailyManualVerificationAutoReport()
    {
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');

//        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_now = '2016-02-26 00:00:00';
        //Get Records for the last 24 hours
        $date_last_day = date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $opened_client_day = $this->account_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_partner_day = $this->partnership_model->getAccountsCountByDateRange($date_last_day, $date_now);
        $opened_accounts_day = $opened_client_day + $opened_partner_day;
        $uploaded_client_documents_day = $this->user_model->getDocumentsCountByDateRange($date_last_day, $date_now);
        $uploaded_partner_documents_day = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_day, $date_now);
        $uploaded_documents_day = $uploaded_client_documents_day + $uploaded_partner_documents_day;
        $old_uploaded_client_documents_day = $this->user_model->getPendingDocumentsCountByEndDate($date_last_day, $date_last_day, $date_now);
        $old_uploaded_partner_documents_day = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_day, $date_last_day, $date_now);
        $old_uploaded_documents_day = $old_uploaded_client_documents_day + $old_uploaded_partner_documents_day;
        $client_verified_day = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_day, $date_now);
        $partner_verified_day = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_day, $date_now);
        $accounts_verified_day = $client_verified_day + $partner_verified_day;
        $client_pending_day = $this->account_model->getAccountsPendingCountByDateRange($date_last_day, $date_now);
        $partner_pending_day = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_day, $date_now);
        $accounts_pending_day = $client_pending_day + $partner_pending_day;
        $client_declined_day = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_day, $date_now);
        $partner_declined_day = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_day, $date_now);
        $accounts_declined_day = $client_declined_day + $partner_declined_day;
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_day, $date_now, 1, 10);
        $top_upload_countries = array();

//        echo '$uploaded_client_documents_day = ' . $uploaded_client_documents_day . '<br/>';
//        echo '$uploaded_partner_documents_day = ' . $uploaded_partner_documents_day . '<br/>';
//        echo '$old_uploaded_client_documents_day = ' . $old_uploaded_client_documents_day . '<br/>';
//        echo '$old_uploaded_partner_documents_day = ' . $old_uploaded_partner_documents_day . '<br/>';

        foreach ($top_countries as $key => $top_country) {
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_day, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country']);
            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country']);
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country']);
            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry($date_last_day, $date_now, $top_country['country']);
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country']);
            $country_partner_declined_count = $this->partnership_model->getAccountsDeclinedCountByDateRangeCountry($date_last_day, $date_now, 1, $top_country['country']);
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_day, $date_last_day, $date_now, 1, $top_country['country']);
            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_day, $date_last_day, $date_now, $top_country['country']);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => ($country_percentage_verified > 100 ? 100 : number_format($country_percentage_verified, 2)) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
            'opened_accounts_day' => $opened_accounts_day,
            'old_uploaded_documents_day' => $old_uploaded_documents_day,
            'uploaded_documents_day' => $uploaded_documents_day,
            'accounts_verified_day' => $accounts_verified_day,
            'accounts_pending_day' => $accounts_pending_day,
            'accounts_declined_day' => $accounts_declined_day,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report on ' . date('Y-m-d', strtotime($date_now))
        );

        $config = array(
            'mailtype' => 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if ($config != null) {
            $this->email->initialize($config);
        }
        $this->SMTPDebug = 1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->to('auto-reports@forexmart.com');
//        $this->email->bcc('agus@forexmart.com');
//        $this->email->to('agus@forexmart.com');
        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/daily_verification_auto_report', $email_data, TRUE));
        if ($this->email->send()) {
            //echo 'sent!';
        } else {
            echo $this->email->print_debugger();
        }
    }

    public function sendWeeklyManualVerificationAutoReport($mode){
        $this->load->model('account_model');
        $this->load->model('partnership_model');
        $this->load->model('user_model');
        $now = date('Y-m-d H:i:s');
//        $date_last_week = date('Y-m-d', strtotime('sunday -1 week', strtotime($now)));
//        $date_now = date('Y-m-d', strtotime('saturday -1 week', strtotime($now)));
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_week =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 week'));
        $opened_client_week = $this->account_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_partner_week = $this->partnership_model->getAccountsCountByDateRange($date_last_week, $date_now);
        $opened_accounts_week = $opened_client_week + $opened_partner_week;
        $uploaded_client_documents_week = $this->user_model->getDocumentsCountByDateRange($date_last_week, $date_now);
        $uploaded_partner_documents_week = $this->user_model->getPartnersDocumentsCountByDateRange($date_last_week, $date_now);
        $uploaded_documents_week = $uploaded_client_documents_week + $uploaded_partner_documents_week;
        $old_uploaded_client_documents_week = $this->user_model->getPendingDocumentsCountByEndDate($date_last_week, $date_last_week, $date_now);
        $old_uploaded_partner_documents_week = $this->user_model->getPartnersPendingDocumentsCountByEndDate($date_last_week, $date_last_week, $date_now);
        $old_uploaded_documents_week = $old_uploaded_client_documents_week + $old_uploaded_partner_documents_week;
        $client_verified_week = $this->account_model->getAccountsVerifiedCountByDateRange($date_last_week, $date_now);
        $partner_verified_week = $this->partnership_model->getAccountsVerifiedCountByDateRange($date_last_week, $date_now);
        $accounts_verified_week = $client_verified_week + $partner_verified_week;
        $client_pending_week = $this->account_model->getAccountsPendingCountByDateRange($date_last_week, $date_now);
        $partner_pending_week = $this->partnership_model->getAccountsPendingCountByDateRange($date_last_week, $date_now);
        $accounts_pending_week = $client_pending_week + $partner_pending_week;
        $client_declined_week = $this->account_model->getAccountsDeclinedCountByDateRange($date_last_week, $date_now);
        $partner_declined_week = $this->partnership_model->getAccountsDeclinedCountByDateRange($date_last_week, $date_now);
        $accounts_declined_week = $client_declined_week + $partner_declined_week;
        $top_countries = $this->user_model->getTopCountryDocumentsByDateRange($date_last_week, $date_now, 1, 10);
        $top_upload_countries = array();
        foreach( $top_countries as $key => $top_country ){
//            $country_opened_count = $this->account_model->getAccountsCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_client_documents_count = $this->user_model->getDocumentsCountByDateRangeCountry($date_last_week, $date_now, 1, $top_country['country'] );
            $country_partner_documents_count = $this->user_model->getPartnersDocumentsCountByDateRangeCountry($date_last_week, $date_now, 1, $top_country['country'] );
            $country_documents_count = $country_client_documents_count + $country_partner_documents_count;
            $country_client_verified_count = $this->account_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_partner_verified_count = $this->partnership_model->getAccountsVerifiedCountByDateRangeCountry( $date_last_week, $date_now, $top_country['country'] );
            $country_verified_count = $country_client_verified_count + $country_partner_verified_count;
            $country_client_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_partner_declined_count = $this->account_model->getAccountsDeclinedCountByDateRangeCountry( $date_last_week, $date_now, 1, $top_country['country'] );
            $country_declined_count = $country_client_declined_count + $country_partner_declined_count;
            $country_old_client_documents_count = $this->user_model->getPendingDocumentsCountByEndDateCountry($date_last_week, $date_last_week, $date_now, 1, $top_country['country']);
            $country_old_partner_documents_count = $this->user_model->getPartnersPendingDocumentsCountByEndDateCountry($date_last_week, $date_last_week, $date_now, $top_country['country']);
            $country_old_documents_count = $country_old_client_documents_count + $country_old_partner_documents_count;
            $country_percentage_verified = $country_verified_count > 0 ? ($country_verified_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $country_percentage_declined = $country_declined_count > 0 ? ($country_declined_count / ($country_documents_count + $country_old_documents_count)) * 100 : 0;
            $top_upload_countries[] = array(
                'country_name' => $this->general_model->getCountries($top_country['country']),
                'country_documents_count' => $country_documents_count,
                'country_old_documents_count' => $country_old_documents_count,
                'country_verified_count' => $country_verified_count,
                'country_declined_count' => $country_declined_count,
                'percentage_verified' => number_format($country_percentage_verified, 2) . '%',
                'percentage_declined' => ($country_percentage_declined > 100 ? 100 : number_format($country_percentage_declined, 2)) . '%'
            );
        }

        $email_data = array(
            'opened_accounts_week' => $opened_accounts_week,
            'old_uploaded_documents_week' => $old_uploaded_documents_week,
            'uploaded_documents_week' => $uploaded_documents_week,
            'accounts_verified_week' => $accounts_verified_week,
            'accounts_pending_week' => $accounts_pending_week,
            'accounts_declined_week' => $accounts_declined_week,
            'top_countries' => $top_upload_countries,
            'as_of_date' => $date_now,
            'title' => 'Verification auto-report from ' . date('Y-m-d', strtotime($date_now)) . ' to ' . date('Y-m-d', strtotime($date_last_week))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        //var_dump($email_data);
        //$this->general_model->sendEmail('daily_compliance_report', "Daily Compliance Report", 'vela.nightclad@gmail.com', $email_data,$config);

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        if($mode == 1){
            $this->email->to('auto-reports@forexmart.com');
            $this->email->cc('agus@forexmart.com');
        }elseif($mode == 2){
            $this->email->to('agus@forexmart.com');
            $this->email->bcc('vela.nightclad@gmail.com');
        }else{
            $this->email->to('vela.nightclad@gmail.com');
        }

        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/weekly_verification_auto_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function updateQuestionMarkName(){
        ini_set('max_execution_time', 0);
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('partnership_model');

        $this->load->model('general_model');

        $webservice_config = array(
            'server' => 'demo_new'
        );

        $WebService = new WebService($webservice_config);
        $WebService->get_question_mark_name();
        if ($WebService->request_status === 'RET_OK') {
            $accounts = $WebService->get_result('AccountsList');
            $accounts_data = $accounts->AccountData;
//            $ctr = 0;
//            var_dump($accounts_data);
            foreach ($accounts_data as $key => $account) {
                $user_details = $this->account_model->getAccountDetailsByAccountNumber($account->LogIn);
                if($user_details){
                    if(trim($account->Country) == ''){
                        if(trim($user_details['country']) == '' || empty($user_details['country'])){
                            $country_name = '';
                        }else{
                            $country_name = $this->general_model->getCountries($user_details['country']);
                        }
                    }else{
                        $country_name = $this->general_model->getCountries($account->Country);
                    }

                    $WebService2 = new WebService($webservice_config);
                    $info = array(
                        'account_number' => $account->LogIn,
                        'city' => $user_details['city'],
                        'country' => $country_name,
                        'email' => $user_details['email'],
                        'full_name' => $user_details['full_name'],
                        'phone_number' => $user_details['phone1'],
                        'state' => $user_details['state'],
                        'street_address' => $user_details['address'],
                        'zip_code' => $user_details['zip']
                    );

                    //$this->general_model->insert('tmp_account_update', $info);
//                            var_dump($info);
                    $WebService2->update_live_account_details( $info );
                    if($WebService2->request_status == 'RET_OK'){
                        echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':Updated</br>';
                    }else{
                        echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':' . $WebService2->request_status . '</br>';
                    }
                }else{
                    echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':Account Doesn\'t Exist</br>';
                }
//                else{
//                    $user_details = $this->partnership_model->getAccountDetailsByAccountNumber($account->LogIn);
//                    if($user_details){
//
//                        if(trim($account->Country) == ''){
//                            if(trim($user_details['country']) == '' || empty($user_details['country'])){
//                                $country_name = '';
//                            }else{
//                                $country_name = $this->general_model->getCountries($user_details['country']);
//                            }
//                        }else{
//                            $country_name = $this->general_model->getCountries($account->Country);
//                        }
//
//                        $WebService2 = new WebService($webservice_config);
//                        $info = array(
//                            'account_number' => $account->LogIn,
//                            'city' => $user_details['city'],
//                            'country' => $country_name,
//                            'email' => $user_details['email'],
//                            'full_name' => $user_details['full_name'],
//                            'phone_number' => $user_details['phone1'],
//                            'state' => $user_details['state'],
//                            'street_address' => $user_details['address'],
//                            'zip_code' => $user_details['zip']
//                        );
//
//                        //$this->general_model->insert('tmp_account_update', $info);
////                            var_dump($info);
//                        $WebService2->update_live_account_details( $info );
//                        if($WebService2->request_status == 'RET_OK'){
//                            echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':Updated</br>';
//                        }else{
//                            echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':' . $WebService2->request_status . '</br>';
//                        }
//                    }elseif($account->LogIn == 140516){
//                        $user_details = $this->partnership_model->getAccountDetailsByAccountNumber(114119);
//                        if($user_details){
//
//                            if(trim($account->Country) == ''){
//                                if(trim($user_details['country']) == '' || empty($user_details['country'])){
//                                    $country_name = '';
//                                }else{
//                                    $country_name = $this->general_model->getCountries($user_details['country']);
//                                }
//                            }else{
//                                $country_name = $this->general_model->getCountries($account->Country);
//                            }
//
//                            $WebService2 = new WebService($webservice_config);
//                            $info = array(
//                                'account_number' => $account->LogIn,
//                                'city' => $user_details['city'],
//                                'country' => $country_name,
//                                'email' => $user_details['email'],
//                                'full_name' => $user_details['full_name'],
//                                'phone_number' => $user_details['phone1'],
//                                'state' => $user_details['state'],
//                                'street_address' => $user_details['address'],
//                                'zip_code' => $user_details['zip']
//                            );
//
//                            //$this->general_model->insert('tmp_account_update', $info);
////                            var_dump($info);
//                            $WebService2->update_live_account_details( $info );
//                            if($WebService2->request_status == 'RET_OK'){
//                                echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':Updated</br>';
//                            }else{
//                                echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':' . $WebService2->request_status . '</br>';
//                            }
//                        }
//                    }else{
//                        echo $account->LogIn . ':' . $account->Country . ':' . $country_name . ':' . $user_details['full_name'] . ':Account Doesn\'t Exist</br>';
//                    }
//                }
            }
        }
    }

    public function manualUpdateContestWinners(){
        //Get last week monday to sunday contest registrants
        $this->load->model('account_model');
        $contest_date_start =  '2016-04-25 00:00:00';
        $contest_date_end = '2015-04-29 23:59:59';
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow', strtotime($contest_date_start))));
        $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
        $contest_winners = $this->account_model->getContestAccountsByDateRange($start_date, $end_date);
        //Update account balances
        foreach ($contest_winners as $key => $value) {
            $webservice_config = array(
                'server' => 'demo_new'
            );
            $WebService = new WebService($webservice_config);
            $WebService->request_demo_account_balance($value['account_number']);
            if ($WebService->request_status === 'RET_OK') {
                $amount = $WebService->get_result('Balance');
                $this->account_model->updateAmountByAccountNumber($value['account_number'], $amount);
            }
//                if(IPLoc::isStaging()){
            $is_activated = $this->account_model->isContestAccountActivated($value['account_number']);
            if(!$is_activated){
                $WebServiceActivate = new WebService($webservice_config);
                $WebServiceActivate->activate_demo_account($value['account_number']);
                if ($WebServiceActivate->request_status === 'RET_OK') {
                    $account_info = array(
                        'user_id' => $value['user_id'],
                        'date_activated' => $date_now
                    );
                    $this->account_model->setContestAccountActivated($account_info);
                }
            }
//                }
        }

        //Get updated contest winners
        $contest_data = $this->account_model->getContestWinners( $start_date, $end_date );

        //Update winner list
        $winners = array();
        if($contest_data){
            $rank = 0;
            $prev_value = 0;
            foreach($contest_data as $key => $value){

                if($prev_value <> $value['amount']){
                    $rank++;
                    $prev_value = $value['amount'];
                }

                $winners[] = array(
                    'start_date' => $contest_date_start,
                    'end_date' => $contest_date_end,
                    'user_id' => $value['user_id'],
                    'amount' => $value['amount'],
                    'currency' => $value['mt_currency_base'],
                    'account_number' => $value['account_number'],
                    'rank' => $rank,
                    'nickname' => $value['NickName']
                );
            }
        }
        if(count($winners) > 0) {
            $this->account_model->updateCurrentWinners($contest_date_start, $winners);
        }
    }

    public function getServerTime(){
        echo FXPP::getServerTime();
        echo '<br/>';
        echo date('Y-m-d H:i:s');
        echo '<br/>';
        date_default_timezone_set('Europe/Minsk');
        echo date('Y-m-d H:i:s');
        echo '<br/>';
        echo FXPP::getCurrentDateTime();
    }

    public function manualFixLandingAccounts(){
        $this->load->model('task_model');
        $this->load->model('user_model');
        $accounts = $this->task_model->getFMLandingPartnerAccounts(100);
        ob_start();
        foreach($accounts as $key => $account){
            $webservice_config = array(
                'server' => 'demo_new'
            );

            $account_info = array(
                'iLogin' => $account['account_number'],
//                'iLeverage' => '500'
            );
            $WebService = new WebService($webservice_config);
            $WebService->request_account_details($account_info);
//            $WebService->open_ChangeAccountLeverage($account_info);
            if ($WebService->request_status === 'RET_OK') {
                echo $WebService->get_result('LogIn') . ' : ' . $WebService->request_status;
                $user_data = array(
                    'type' => 0
                );
                if($this->user_model->updateUserById($account['id'], $user_data)){
                    echo ' : Updated';
                }

            }else{
                echo $account['account_number'] . ' : ' . $WebService->request_status;
            }
            echo '<br/>';
            ob_flush();
        }
        ob_end_flush();
    }

//    private function sendMonthlyAccountBalances(){
//
//        $this->load->model('user_model');
//
//        $webservice_config = array(
//            'server' => 'live_new'
//        );
//
////        $date_now = date('Y-m-d');
//        $date_now = date('last month');
//        $date_last_day = date('Y-m-t', strtotime($date_now));
////        if(date('Y-m-d', strtotime($date_now)) === date('Y-m-d', strtotime($date_last_day))){
//
//            $account_info = array(
//                'from' => date('Y-m-01', strtotime($date_last_day)) . ' 00:00:00',
//                'to' => $date_last_day . ' 23:59:59'
//            );
//
//            $WebServiceBal = new WebService($webservice_config);
//            $WebServiceBal->get_deposits_per_account_per_day($account_info);
//            $arr_balances = array();
//            if( $WebServiceBal->request_status === 'RET_OK' ) {
//                $balances = $WebServiceBal->get_result('WithdrawalsDepositsList');
//                foreach( $balances->TotalDepositWithdrawData as $key => $balance ){
//
//                    $isUserExist = $this->user_model->checkExistingAccountNumber($balance->Account);
//                    if($isUserExist){
//                        $isUserTest = $this->user_model->isUserTestByAccountNumber($balance->Account);
//                        if(!$isUserTest){
//                            if(array_key_exists($balance->Stamp, $arr_balances)){
//                                $arr_balances[$balance->Stamp]['balance'] += $balance->Total;
//                            }else{
//                                $arr_balances[$balance->Stamp] = array(
//                                    'stamp' => $balance->Stamp,
//                                    'balance' => $balance->Total
//                                );
//                            }
//                        }
//                    }
//                }
//            }else{
//                echo $WebServiceBal->request_status;
//            }
//
//            $email_data = array(
//                'balances' => $arr_balances,
//                'from' => date('Y-m-d', strtotime($account_info['from'])),
//                'to' => date('Y-m-d', strtotime($account_info['to']))
//            );
////
////        $email_data = array(
////            'balances' => $arr_balances,
////            'from' => '2015-11-01',
////            'to' => '2015-11-30'
////        );
//
//            $config = array(
//                'mailtype'=> 'html'
//            );
//
//            $this->load->library('email');
//            if($config != null){
//                $this->email->initialize($config);
//            }
//            $this->SMTPDebug =1;
//            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
////            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('vela.nightclad@gmail.com');
////        $this->email->to('fin-reports@forexmart.com');
////            $this->email->to('agus@forexmart.com');
////        $this->email->to('ad-stats@forexmart.com');
////        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
////        $this->email->bcc('pptest1@forexmart.com');
////            $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//            $this->email->subject('Total Balances');
//            $this->email->message($this->load->view('email/manual_account_balances', $email_data, TRUE));
//            if($this->email->send()){
//                echo 'sent!';
//            }else{
//                echo $this->email->print_debugger();
//            }
////        }
//    }

    public function sendMonthlyClientAccountsCount(){

        ini_set('max_execution_time', 0);
        $this->load->model('account_model');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_month =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $date_from = date('Y-m-01 00:00:00', strtotime($date_last_month));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_last_month));
        $real_accounts = $this->account_model->getRealAccountsCountByDateRange($date_from, $date_to);
        $real_account_count = $real_accounts['registration_count'];
        $demo_accounts = $this->account_model->getDemoAccountsCountByDateRange($date_from, $date_to);
        $demo_account_count = $demo_accounts['registration_count'];
//        $unverified_real_accounts = $this->account_model->getUnverifiedRealAccountsCountByDateRange($date_from, $date_to);
//        $unverified_real_account_count = $unverified_real_accounts['registration_count'];
//        $test_real_accounts = $this->account_model->getTestRealAccountsCountByDateRange($date_from, $date_to);
//        $test_real_account_count = $test_real_accounts['registration_count'];
        $date = new DateTime();
        $file_name = $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/sendMonthlyRealAccountsGraph /var/www/html/forexmart.com/assets/reports/img_monthly_real_graph_' . $file_name);
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/sendMonthlyDemoAccountsGraph /var/www/html/forexmart.com/assets/reports/img_monthly_demo_graph_' . $file_name);

        $email_data = array(
            'real_account_count' => $real_account_count,
            'demo_account_count' => $demo_account_count,
            'from' => date('Y-m-d', strtotime($date_from)),
            'to' => date('Y-m-d', strtotime($date_to)),
            'img_real' => FXPP::loc_url('assets/reports/img_monthly_real_graph_' . $file_name),
            'img_demo' => FXPP::loc_url('assets/reports/img_monthly_demo_graph_' . $file_name)
        );
//
//        $email_data = array(
//            'balances' => $arr_balances,
//            'from' => '2015-11-01',
//            'to' => '2015-11-30'
//        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('siaful@forexmart.com');
        $this->email->to('registration-reports@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, siaful@forexmart.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject('Monthly Auto Report for Live Accounts');
        $this->email->message($this->load->view('email/monthly_auto_report_accounts', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendMonthlyRealAccountsGraph()
    {
        $this->load->model('account_model');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_month =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 month'));
        $date_from = date('Y-m-01 00:00:00', strtotime($date_last_month));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_last_month));

        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate($date_from, $date_to);
        $real_account_chart_data_30 = array();
        foreach ($real_accounts_data_30 as $key => $account) {
            $real_account_chart_data_30[] = "[" . strtotime($account['registration_date']) * 1000 . "," . $account['registration_count'] . "]";
        }

        $data['real_accounts_data_30'] = $real_account_chart_data_30;

//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_monthly_real_accounts', $data);
    }

    public function sendMonthlyDemoAccountsGraph()
    {
        $this->load->model('account_model');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_month =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 month'));
        $date_from = date('Y-m-01 00:00:00', strtotime($date_last_month));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_last_month));

        //Get Opened Demo Accounts for 30 days
        $demo_accounts_data_30 = $this->account_model->getDemoAccountsCountByDate($date_from, $date_to);
        $demo_account_chart_data_30 = array();
        foreach ($demo_accounts_data_30 as $key => $account) {
            $demo_account_chart_data_30[] = "[" . strtotime($account['registration_date']) * 1000 . "," . $account['registration_count'] . "]";
        }

        $data['demo_accounts_data_30'] = $demo_account_chart_data_30;
        $this->load->view('email/element/graph_monthly_demo_accounts', $data);
    }

    public function sendDailyClientAccountsCount(){

        ini_set('max_execution_time', 0);
        $this->load->model('account_model');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $date_from = date('Y-m-d 00:00:00', strtotime($date_last_day));
        $date_to = date('Y-m-d 23:59:59', strtotime($date_last_day));
        $real_accounts = $this->account_model->getRealAccountsCountByDateRange($date_from, $date_to);
        $real_account_count = $real_accounts['registration_count'];
        $demo_accounts = $this->account_model->getDemoAccountsCountByDateRange($date_from, $date_to);
        $demo_account_count = $demo_accounts['registration_count'];
//        $unverified_real_accounts = $this->account_model->getUnverifiedRealAccountsCountByDateRange($date_from, $date_to);
//        $unverified_real_account_count = $unverified_real_accounts['registration_count'];
//        $test_real_accounts = $this->account_model->getTestRealAccountsCountByDateRange($date_from, $date_to);
//        $test_real_account_count = $test_real_accounts['registration_count'];
        $date = new DateTime();
        $file_name = $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/sendDailyRealAccountsGraph /var/www/html/forexmart.com/assets/reports/img_daily_real_graph_' . $file_name);
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/sendDailyDemoAccountsGraph /var/www/html/forexmart.com/assets/reports/img_daily_demo_graph_' . $file_name);

        $email_data = array(
            'real_account_count' => $real_account_count,
            'demo_account_count' => $demo_account_count,
            'from' => date('Y-m-d', strtotime($date_from)),
            'to' => date('Y-m-d', strtotime($date_to)),
            'img_real' => FXPP::loc_url('assets/reports/img_daily_real_graph_' . $file_name),
            'img_demo' => FXPP::loc_url('assets/reports/img_daily_demo_graph_' . $file_name)
        );
//
//        $email_data = array(
//            'balances' => $arr_balances,
//            'from' => '2015-11-01',
//            'to' => '2015-11-30'
//        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->to('siaful@forexmart.com');
        $this->email->to('registration-reports@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com, siaful@forexmart.com');
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->subject('Daily Auto Report for Live Accounts');
        $this->email->message($this->load->view('email/daily_auto_report_accounts', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function sendDailyRealAccountsGraph()
    {
        $this->load->model('account_model');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $date_from = date('Y-m-d 00:00:00', strtotime($date_last_day . ' -1 week'));
        $date_to = date('Y-m-d 23:59:59', strtotime($date_last_day));

        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate($date_from, $date_to);
        $real_account_chart_data_30 = array();
        foreach ($real_accounts_data_30 as $key => $account) {
            $real_account_chart_data_30[] = "[" . strtotime($account['registration_date']) * 1000 . "," . $account['registration_count'] . "]";
        }

        $data['real_accounts_data_30'] = $real_account_chart_data_30;

//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_monthly_real_accounts', $data);
    }

    public function sendDailyDemoAccountsGraph()
    {
        $this->load->model('account_model');
        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $date_from = date('Y-m-d 00:00:00', strtotime($date_last_day . ' -1 week'));
        $date_to = date('Y-m-d 23:59:59', strtotime($date_last_day));

        //Get Opened Real Accounts for 30 days
        $demo_accounts_data_30 = $this->account_model->getDemoAccountsCountByDate($date_from, $date_to);
        $demo_account_chart_data_30 = array();
        foreach ($demo_accounts_data_30 as $key => $account) {
            $demo_account_chart_data_30[] = "[" . strtotime($account['registration_date']) * 1000 . "," . $account['registration_count'] . "]";
        }

        $data['demo_accounts_data_30'] = $demo_account_chart_data_30;
        $this->load->view('email/element/graph_monthly_demo_accounts', $data);
    }

    public function updateManualContestBalances(){
        $this->load->model('account_model');

        $webservice_config = array(
            'server' => 'demo_new'
        );

        $start_date = '2016-03-07 00:00:00';
        $end_date = '2016-03-11 22:59:59';
        echo date('Y-m-d', strtotime($start_date)) . '/' . date('Y-m-d', strtotime($end_date));
        echo '<br/>';
        $accounts = $this->account_model->getContestWinnersByDate($start_date, $end_date);
        $rank = 0;
        $prev_value = 0;
        foreach($accounts as $key => $account){

            echo '[' . $account['rank'] . '] ' . $account['account_number'] . ' : ' . $account['amount'] . '<br/>';

                if($prev_value <> $account['amount']){
                    $rank++;
                    $prev_value = $account['amount'];
                }
//            $WebService = new WebService($webservice_config);
//            $account_info = array(
//                'iLogin' => $account['account_number'],
//                'from' => date('Y-m-d\T01:00:00', strtotime($end_date . ' +1 day')),
//                'to' => date('Y-m-d\T01:59:59', strtotime($end_date . ' +1 day'))
//            );
//            $WebService->open_GetBalanceMonitoringDataByDate($account_info);
//            if ($WebService->request_status === 'RET_OK') {
//                $result = $WebService->get_result('BalanceMonidtoringDataList');
//                $balance = $result->BalanceMonitorData[0]->Balance;
//                echo $account['amount'] . ' = ' . $balance;
//                echo '<br/>';
//                if($balance){
                    $this->account_model->setContestWinnerRankByAccountNumber($account['account_number'], $rank);
//                }
//            }else{
//                echo "[" . $WebService->request_status . "]";
//            }
        }
    }

    public function sendNoDepositMailTest(){
        $email_data = array(
            'title' => 'Application for No Deposit Bonus to account 000000'
        );
        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//        $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('agus@forexmart.com');
//        $this->email->cc('agus@forexmart.com');
        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/no-deposit-request-html', $email_data, TRUE));
        if($this->email->send()){
            //$this->deposit_model->updateNoDepositSentByUserID($no_deposit['user_id']);
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function checkContestParticipants(){
        $this->load->model('account_model');

        $webservice_config = array(
            'server' => 'demo_new'
        );

        $start_date = '2016-06-27 00:00:00';
        $end_date = '2016-07-01 23:59:59';
        echo date('Y-m-d', strtotime($start_date)) . '/' . date('Y-m-d', strtotime($end_date));
        echo '<br/>';
        $accounts = $this->account_model->getContestWinnersByDate($start_date, $end_date);
        $rank = 0;
        $prev_value = 0;
        foreach($accounts as $key => $account){
            $WebService = new WebService($webservice_config);
            $account_info = array(
                'iLogin' => $account['account_number'],
                'from' => date('Y-m-d\T01:00:00', strtotime($end_date . ' +1 day')),
                'to' => date('Y-m-d\T01:59:59', strtotime($end_date . ' +1 day'))
            );
            $WebService->open_GetBalanceMonitoringDataByDate($account_info);
            if ($WebService->request_status === 'RET_OK') {
                $result = $WebService->get_result('BalanceMonidtoringDataList');
                $balance = $result->BalanceMonitorData[0]->Balance;
                $contest_fall = $this->account_model->getMoneyFallContestantByUserId($account['user_id']);
                echo '|' . $account['account_number'] . '|' . $contest_fall['api_completed_time'] . '|' . $contest_fall['api_profit_loss'] . '|' . $contest_fall['api_equity'] . '|' . $contest_fall['api_trades_closed_count'] . '|' . $account['amount'] . '|' . $balance . '|';
                echo '<br/>';
                if($balance){
            $this->account_model->setContestWinnerRankByAccountNumber($account['account_number'], $rank);
                }
            }else{
                echo "[" . $WebService->request_status . "]";
            }
        }
    }

    public function manualSendDWSReports(){
        $this->sendDWSTopDepositsGraph(180);
        $this->sendDWSTopDepositsGraph(360);
        $this->sendDWSTopDepositsGraph(540);
        $this->sendDWSTopProcessedWithdrawGraph(180);
        $this->sendDWSTopProcessedWithdrawGraph(360);
        $this->sendDWSTopProcessedWithdrawGraph(540);
        $this->sendDWSLatestDepositsGraph(180);
        $this->sendDWSLatestDepositsGraph(360);
        $this->sendDWSLatestDepositsGraph(540);
        $this->sendDWSLatestProcessedWithdrawGraph(180);
        $this->sendDWSLatestProcessedWithdrawGraph(360);
        $this->sendDWSLatestProcessedWithdrawGraph(540);
        $this->sendDWSLatestRequestedWithdrawGraph(180);
        $this->sendDWSLatestRequestedWithdrawGraph(360);
        $this->sendDWSLatestRequestedWithdrawGraph(540);
        $this->sendDWSLatestRejectedWithdrawGraph(180);
        $this->sendDWSLatestRejectedWithdrawGraph(360);
        $this->sendDWSLatestRejectedWithdrawGraph(540);
    }
    public function qiwiCheck(){

        if($top_up = $this->general_model->where("qiwi_top_up", array('status'=>0))){

            $this->load->library("qiwi");
            $qiwi = new qiwi();
            $qiwi->setTerminalId(1289);
            $qiwi->setPassword("7uyfwajjod");

            foreach($top_up->result() as $d){

                $qiwi->setTransactionNumber($d->txn_number);
                $qiwi->setPhone($d->phone);
                $qiwi->status_check();
                $tnx_status = $qiwi->getTnxStatusCheck();
                $status = $tnx_status['status']== 60 ? 1:0;
                if($tnx_status['status']> 100){
                    $status = 2;
                }
                $array = array(
                    'status'=>$status,
                    'status_code'=>$tnx_status['status']
                );

                $condition = array(
                    'txn_number'=>$qiwi->getTransactionNumber(),
                    'phone'=>$qiwi->getPhone()
                );
                $this->general_model->updateConditional('qiwi_top_up',$condition,$array);

            }
        }

    }

    public function sendDailyDepositWithdrawal() {
        $this->load->model('deposit_model');
        $this->load->model('withdraw_model');

        $date_now = date('Y-m-d H:i:s', strtotime('now'));
        $date_last_day =  date('Y-m-d H:i:s', strtotime($date_now . ' -1 day'));
        $date_from = date('Y-m-d 00:00:00', strtotime($date_last_day));
        $date_to = date('Y-m-d 23:59:59', strtotime($date_last_day));

        // Get all deposits the last day
        $data['date_stamp'] = $date_last_day;
        $data['deposits'] = $this->deposit_model->getDepositorsByDate($date_from, $date_to);
        foreach ($data['deposits'] as $key => $value) {
            $data['deposits'][$key]['country'] = $this->general_model->getCountries($value['country']);
        }

        // Get all withdrawals the last day
        $data['withdrawals'] = $this->withdraw_model->getWithdrawsByDate($date_from, $date_to);
        foreach ($data['withdrawals'] as $key => $value) {
            $data['withdrawals'][$key]['country'] = $this->general_model->getCountries($value['country']);
            $data['withdrawals'][$key]['transaction_type'] = $value['transaction_type'] == 'N/A' ? strtoupper($value['comment']) : strtoupper($this->transaction_type[$value['transaction_type']]);
        }

        $email_data = array(
            'title' => 'Deposits and Withdrawals Report'
        );
        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc(array('agus@forexmart.com','raihana@zetaol.com'));
        $this->email->subject($email_data['title']);
        $this->email->message($this->load->view('email/daily_deposit_withdraw_report', $data, true));
        if($this->email->send()){
            echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function monthlyTotalDepositPerPaymentGraph($days = 30){
        $this->load->model('deposit_model');
        $date_from = date('Y-m-01 00:00:00', strtotime('last month'));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_from));

        //Get Popular Deposit Method
        $most_deposit = $this->deposit_model->getDepositPerPaymentSystems( $date_from, $date_to );
        $total_most_deposit = 0;
        foreach ($most_deposit as $key => $deposit) {
            $total_most_deposit += $deposit['amount'];
        }
        $most_deposit_chart_data = array();
        foreach ($most_deposit as $key => $deposit) {
            $percentage = number_format(($deposit['amount'] / $total_most_deposit) * 100, 2);
            $most_deposit_chart_data[] = "{ name: '" . strtoupper($deposit['payment_type']) . "', y: " . $percentage . "}";
        }

        $data['most_deposit_chart_data'] = $most_deposit_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_real_deposits', $data);
    }

    public function monthlyTotalDepositPerPayment(){
        $this->load->model('deposit_model');
        $date_from = date('Y-m-01 00:00:00', strtotime('last month'));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_from));

        $date = new DateTime();
        $file_name = 'img_monthly_deposit_per_payment_graph_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/monthlyTotalDepositPerPaymentGraph /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $deposits = $this->deposit_model->getDepositPerPaymentSystems( $date_from, $date_to );
        $email_data = array(
            'title' => 'Monthly Total Deposits Per Payment System - ' . date('F', strtotime($date_from)),
            'deposit_data' => $deposits,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject('Monthly Total Deposits Per Payment System');
        $this->email->message($this->load->view('email/monthly_deposit_per_payment', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function monthlyTotalDepositPerCountryGraph($days = 30){
        $this->load->model('deposit_model');
        $date_from = date('Y-m-01 00:00:00', strtotime('last month'));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_from));

        //Get Popular Deposit Method
        $most_deposit = $this->deposit_model->getDepositPerCountries( $date_from, $date_to );
        $total_most_deposit = 0;
        foreach ($most_deposit as $key => $deposit) {
            $total_most_deposit += $deposit['amount'];
        }
        $most_deposit_chart_data = array();
        foreach ($most_deposit as $key => $deposit) {
            $percentage = number_format(($deposit['amount'] / $total_most_deposit) * 100, 2);
            $country_name = $this->general_model->getCountries($deposit['country']);
            if($country_name){
                $most_deposit_chart_data[] = "{ name: '" . strtoupper($country_name) . "', y: " . $percentage . "}";
            }else{
                $most_deposit_chart_data[] = "{ name: '" . strtoupper($deposit['country']) . "', y: " . $percentage . "}";
            }
        }

        $data['most_deposit_chart_data'] = $most_deposit_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_real_deposits', $data);
    }

    public function monthlyTotalDepositPerCountry(){
        $this->load->model('deposit_model');
        $date_from = date('Y-m-01 00:00:00', strtotime('last month'));
        $date_to = date('Y-m-t 23:59:59', strtotime($date_from));

        $date = new DateTime();
        $file_name = 'img_monthly_deposit_per_country_graph_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/monthlyTotalDepositPerCountryGraph /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $deposits = $this->deposit_model->getDepositPerCountries( $date_from, $date_to );
        foreach($deposits as $key => $value){
            $country_name = $this->general_model->getCountries($value['country']);
            if($country_name){
                $deposits[$key]['country_name'] = $country_name;
            }else{
                $deposits[$key]['country_name'] = $value['country'];
            }
        }

        $email_data = array(
            'title' => 'Monthly Total Deposits Per Country - ' . date('F', strtotime($date_from)),
            'deposit_data' => $deposits,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject('Monthly Total Deposits Per Country');
        $this->email->message($this->load->view('email/monthly_deposit_per_country', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    private function dailyStatistics(){
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('withdraw_model');
        $date_yesterday = date('Y-m-d H:i:s', strtotime('yesterday'));
        $date_from = date('Y-m-d 00:00:00', strtotime($date_yesterday));
//        $date_to = date('Y-m-d 23:59:59', strtotime($date_yesterday));
        $start_date_from = date('Y-m-01 00:00:00', strtotime($date_yesterday));
        $daily_statistic = array();

        $date_to = date('Y-m-d 23:59:59', strtotime($date_from));

        // Daily Registration Total
        $daily_demo_registration = $this->account_model->getDemoAccountsCountByDate($date_from, $date_to);

        $demo_registration_count = 0;
        foreach($daily_demo_registration as $key => $value){
            $demo_registration_count += $value['registration_count'];
        }
        $daily_real_registration = $this->account_model->getRealAccountsCountByDate($date_from, $date_to);

        $real_registration_count = 0;
        foreach($daily_real_registration as $key => $value){
            $real_registration_count += $value['registration_count'];
        }
        $daily_partner_registration = $this->account_model->getPartnerAccountsCountByDate($date_from, $date_to);

        $partner_registration_count = 0;
        foreach($daily_partner_registration as $key => $value){
            $partner_registration_count += $value['registration_count'];
        }

        //Daily Deposit Count
        $daily_deposit_count = $this->deposit_model->getDepositSumByDate( $date_from, $date_to );

        //Daily Withdraw Count
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->getFinanceRecordByComment('FOREXMART SUPPORTER PART', date('Y-m-d 00:00:00', strtotime($date_from)), date('Y-m-d 23:59:59', strtotime($date_to)));
        $daily_exclude_withdraw_accounts = array();
        if($WebService->request_status == 'RET_OK'){
            $finance_records = $WebService->get_result('FinanceRecords');
            $finance_data = $finance_records->FinanceRecordData;
            foreach($finance_data as $key => $data){
                $daily_exclude_withdraw_accounts[] = $data->AccountNumber;
            }
        }

        $daily_withdraw = $this->withdraw_model->getWithdrawSumByDate( $date_from, $date_to, $daily_exclude_withdraw_accounts );
        $daily_withdraw_total = 0;
        $daily_withdraw_count = 0;
        foreach($daily_withdraw as $d_key => $d_value){
            if($d_value['status'] == 1){
                $daily_withdraw_total += $d_value['conv_amount'];
            }
            $daily_withdraw_count += 1;
        }

        $daily_mt4_download_count = $this->user_model->getMT4DownloadCountByDate($date_from, $date_to);
        $daily_registration_count = $demo_registration_count + $real_registration_count + $partner_registration_count;
        $daily_deposit_total_amount = $daily_deposit_count['amount_deposit'];
        $daily_deposit_total_count = $daily_deposit_count['deposit_count'];
        $daily_deposit_total_actual_count = $daily_deposit_count['deposit_actual_count'];
        $daily_statistic = array(
            'date' => date('m/d/Y', strtotime($date_yesterday)),
            'mt4_download_count' => $daily_mt4_download_count,
            'registration_total' => $daily_registration_count,
            'real_registration_total' => $real_registration_count,
            'demo_registration_total' => $demo_registration_count,
            'deposit_total' => $daily_deposit_total_amount,
            'deposit_count' => $daily_deposit_total_count . ' [' . $daily_deposit_total_actual_count . ']',
            'withdraw_total' => $daily_withdraw_total,
            'withdraw_count' => $daily_withdraw_count
        );

//        var_dump($daily_statistic);

        $daily_mt4_download_count = 0;
        $daily_registration_count = 0;
        $daily_real_registration_count = 0;
        $daily_demo_registration_count = 0;
        $daily_deposit_total_amount = 0;
        $daily_deposit_total_count = 0;
        $daily_deposit_total_actual_count = 0;
        $daily_withdraw_total_amount = 0;
        $daily_withdraw_total_count = 0;
        while(strtotime($date_from) >= strtotime($start_date_from)){
            $date_to = date('Y-m-d 23:59:59', strtotime($date_from));

            // Daily Registration Total
            $daily_demo_registration = $this->account_model->getDemoAccountsCountByDate($date_from, $date_to);

            $demo_registration_count = 0;
            foreach($daily_demo_registration as $key => $value){
                $demo_registration_count += $value['registration_count'];
            }
            $daily_real_registration = $this->account_model->getRealAccountsCountByDate($date_from, $date_to);

            $real_registration_count = 0;
            foreach($daily_real_registration as $key => $value){
                $real_registration_count += $value['registration_count'];
            }
            $daily_partner_registration = $this->account_model->getPartnerAccountsCountByDate($date_from, $date_to);

            $partner_registration_count = 0;
            foreach($daily_partner_registration as $key => $value){
                $partner_registration_count += $value['registration_count'];
            }

            //Daily Deposit Count
            $daily_deposit_count = $this->deposit_model->getDepositSumByDate( $date_from, $date_to );

            //Daily Withdraw Count
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->getFinanceRecordByComment('FOREXMART SUPPORTER PART', date('Y-m-d 00:00:00', strtotime($date_from)), date('Y-m-d 23:59:59', strtotime($date_to)));
            $daily_exclude_withdraw_accounts = array();
            if($WebService->request_status == 'RET_OK'){
                $finance_records = $WebService->get_result('FinanceRecords');
                $finance_data = $finance_records->FinanceRecordData;
                foreach($finance_data as $key => $data){
                    $daily_exclude_withdraw_accounts[] = $data->AccountNumber;
                }
            }

            $daily_withdraw = $this->withdraw_model->getWithdrawSumByDate( $date_from, $date_to, $daily_exclude_withdraw_accounts );
            $daily_withdraw_total = 0;
            $daily_withdraw_count = 0;
            foreach($daily_withdraw as $d_key => $d_value){
                if($d_value['status'] == 1){
                    $daily_withdraw_total += $d_value['conv_amount'];
                }
                $daily_withdraw_count += 1;
            }

            $daily_mt4_download_count += $this->user_model->getMT4DownloadCountByDate($date_from, $date_to);
            $daily_registration_count += $demo_registration_count + $real_registration_count + $partner_registration_count;
            $daily_real_registration_count += $real_registration_count;
            $daily_demo_registration_count += $demo_registration_count;
            $daily_deposit_total_amount += $daily_deposit_count['amount_deposit'];
            $daily_deposit_total_count += $daily_deposit_count['deposit_count'];
            $daily_deposit_total_actual_count += $daily_deposit_count['deposit_actual_count'];
            $daily_withdraw_total_amount += $daily_withdraw_total;
            $daily_withdraw_total_count += $daily_withdraw_count;
//            $daily_statistic[] = array(
//                'date' => date('m/d/Y', strtotime($date_from)),
//                'mt4_download_count' => $mt4_download_count,
//                'registration_total' => $daily_registration_count,
//                'real_registration_total' => $daily_real_registration_count,
//                'demo_registration_total' => $daily_demo_registration_count,
//                'deposit_total' => $daily_deposit_count['amount_deposit'],
//                'deposit_count' => $daily_deposit_count['deposit_count'] . ' [' . $daily_deposit_count['deposit_actual_count'] . ']',
//                'withdraw_total' => $daily_withdraw_total,
//                'withdraw_count' => $daily_withdraw_count
//            );

            $date_from = date('Y-m-d 00:00:00', strtotime($date_from . ' -1 day'));
        }

        $monthly_statistic = array(
            'date' => date('F', strtotime($date_yesterday)),
            'mt4_download_count' => $daily_mt4_download_count,
            'registration_total' => $daily_registration_count,
            'real_registration_total' => $daily_real_registration_count,
            'demo_registration_total' => $daily_demo_registration_count,
            'deposit_total' => $daily_deposit_total_amount,
            'deposit_count' => $daily_deposit_total_count . ' [' . $daily_deposit_total_actual_count . ']',
            'withdraw_total' => $daily_withdraw_total_amount,
            'withdraw_count' => $daily_withdraw_total_count
        );

        // Monthly Registration Total
//        $monthly_demo_registration = $this->account_model->getDemoAccountsCountByDate($date_monthly_from, $date_monthly_to);
//        $monthly_demo_registration_count = 0;
//        foreach($monthly_demo_registration as $key => $value){
//            $monthly_demo_registration_count += $value['registration_count'];
//        }
//        $monthly_real_registration = $this->account_model->getRealAccountsCountByDate($date_monthly_from, $date_monthly_to);
//        $monthly_real_registration_count = 0;
//        foreach($monthly_real_registration as $key => $value){
//            $monthly_real_registration_count += $value['registration_count'];
//        }
//        $monthly_partner_registration = $this->account_model->getPartnerAccountsCountByDate($date_monthly_from, $date_monthly_to);
//        $monthly_partner_registration_count = 0;
//        foreach($monthly_partner_registration as $key => $value){
//            $monthly_partner_registration_count += $value['registration_count'];
//        }
//        $monthly_registration_count = $monthly_demo_registration_count + $monthly_real_registration_count + $monthly_partner_registration_count;
//
//        //Monthly Deposit Count
//        $monthly_deposit_count = $this->deposit_model->getDepositSumByDate( $date_monthly_from, $date_monthly_to );
//
//        //Monthly Withdraw Count
//        $webservice_config = array('server' => 'live_new');
//        $WebService = new WebService($webservice_config);
//        $WebService->getFinanceRecordByComment('FOREXMART SUPPORTER PART', date('Y-m-d 00:00:00', strtotime($date_monthly_from)), date('Y-m-d 23:59:59', strtotime($date_monthly_to)));
//        $monthly_exclude_withdraw_accounts = array();
//        if($WebService->request_status == 'RET_OK'){
//            $finance_records = $WebService->get_result('FinanceRecords');
//            $finance_data = $finance_records->FinanceRecordData;
//            foreach($finance_data as $key => $data){
//                $monthly_exclude_withdraw_accounts[] = $data->AccountNumber;
//            }
//        }
//
//        $monthly_withdraw = $this->withdraw_model->getWithdrawSumByDate( $date_monthly_from, $date_monthly_to, $monthly_exclude_withdraw_accounts );
////        var_dump($monthly_withdraw);
//        $monthly_withdraw_total = 0;
//        $monthly_withdraw_count = 0;
//        foreach($monthly_withdraw as $m_key => $m_value){
//            if( $m_value['status'] == 0 ){
////                if( $m_value['currency'] <> 'USD' ){
////                    $converter_config = array(
////                        'server' => 'converter',
////                        'service_id' => '505641',
////                        'service_password' => '5fX#p8D^c89bQ'
////                    );
////
////                    $WebService = new WebService($converter_config);
////
////                    $data = array(
////                        'amount' => $m_value['amount'],
////                        'from_currency' => $m_value['currency'],
////                        'to_currency' => 'USD'
////                    );
////
////                    $WebService->convert_currency_amount($data);
////                    if( $WebService->request_status === 'RET_OK' ) {
////                        $converted_amount = $WebService->get_result('ToAmount');
////                        $d_amount = $converted_amount;
////                    }else{
////                        $d_amount = $m_value['amount'];
////                    }
////                }else{
////                    $d_amount = $m_value['amount'];
////                }
//
////                $monthly_withdraw_total += $d_amount;
//            }elseif($m_value['status'] == 1){
//                $monthly_withdraw_total += $m_value['conv_amount'];
//            }
//            $monthly_withdraw_count += 1;
//        }
//
//        $monthly_mt4_download_count = $this->user_model->getMT4DownloadCountByDate($date_monthly_from, $date_monthly_to);
//        $date_last_month = date('Y-m-d H:i:s', strtotime('yesterday last month'));
//        $date_monthly_from = date('Y-m-t 00:00:00', strtotime($date_last_month));
//        $start_date_monthly_from = date('Y-m-01 00:00:00', strtotime($date_last_month));
//        $monthly_statistic = array();
//        $monthly_mt4_download_count = 0;
//        $monthly_registration_count = 0;
//        $monthly_real_registration_count = 0;
//        $monthly_demo_registration_count = 0;
//        $monthly_deposit_total_amount = 0;
//        $monthly_deposit_total_count = 0;
//        $monthly_deposit_total_actual_count = 0;
//        $monthly_withdraw_total_amount = 0;
//        $monthly_withdraw_total_count = 0;
//        while(strtotime($date_monthly_from) >= strtotime($start_date_monthly_from)){
//            $date_monthly_to = date('Y-m-d 23:59:59', strtotime($date_monthly_from));
//
//            // Daily Registration Total
//            $monthly_demo_registration = $this->account_model->getDemoAccountsCountByDate($date_monthly_from, $date_monthly_to);
//
//            $demo_registration_count = 0;
//            foreach($monthly_demo_registration as $key => $value){
//                $demo_registration_count += $value['registration_count'];
//            }
//            $monthly_real_registration = $this->account_model->getRealAccountsCountByDate($date_monthly_from, $date_monthly_to);
//
//            $real_registration_count = 0;
//            foreach($monthly_real_registration as $key => $value){
//                $real_registration_count += $value['registration_count'];
//            }
//            $monthly_partner_registration = $this->account_model->getPartnerAccountsCountByDate($date_monthly_from, $date_monthly_to);
//
//            $partner_registration_count = 0;
//            foreach($monthly_partner_registration as $key => $value){
//                $partner_registration_count += $value['registration_count'];
//            }
//
//            //Daily Deposit Count
//            $monthly_deposit_count = $this->deposit_model->getDepositSumByDate( $date_monthly_from, $date_monthly_to );
//
//            //Daily Withdraw Count
//            $webservice_config = array('server' => 'live_new');
//            $WebService = new WebService($webservice_config);
//            $WebService->getFinanceRecordByComment('FOREXMART SUPPORTER PART', date('Y-m-d 00:00:00', strtotime($date_monthly_from)), date('Y-m-d 23:59:59', strtotime($date_monthly_to)));
//            $monthly_exclude_withdraw_accounts = array();
//            if($WebService->request_status == 'RET_OK'){
//                $finance_records = $WebService->get_result('FinanceRecords');
//                $finance_data = $finance_records->FinanceRecordData;
//                foreach($finance_data as $key => $data){
//                    $monthly_exclude_withdraw_accounts[] = $data->AccountNumber;
//                }
//            }
//
//            $monthly_withdraw = $this->withdraw_model->getWithdrawSumByDate( $date_monthly_from, $date_monthly_to, $monthly_exclude_withdraw_accounts );
//            $monthly_withdraw_total = 0;
//            $monthly_withdraw_count = 0;
//            foreach($monthly_withdraw as $d_key => $d_value){
//                if($d_value['status'] == 1){
//                    $monthly_withdraw_total += $d_value['conv_amount'];
//                }
//                $monthly_withdraw_count += 1;
//            }
//
//            $monthly_mt4_download_count += $this->user_model->getMT4DownloadCountByDate($date_monthly_from, $date_monthly_to);
//            $monthly_registration_count += $demo_registration_count + $real_registration_count + $partner_registration_count;
//            $monthly_real_registration_count += $real_registration_count;
//            $monthly_demo_registration_count += $demo_registration_count;
//            $monthly_deposit_total_amount += $monthly_deposit_count['amount_deposit'];
//            $monthly_deposit_total_count += $monthly_deposit_count['deposit_count'];
//            $monthly_deposit_total_actual_count += $monthly_deposit_count['deposit_actual_count'];
//            $monthly_withdraw_total_amount += $monthly_withdraw_total;
//            $monthly_withdraw_total_count += $monthly_withdraw_count;
//
//            $date_monthly_from = date('Y-m-d 00:00:00', strtotime($date_monthly_from . ' -1 day'));
//        }
//
//        $monthly_statistic[] = array(
//            'date' => date('F', strtotime($date_last_month)),
//            'mt4_download_count' => $daily_mt4_download_count,
//            'registration_total' => $daily_registration_count,
//            'real_registration_total' => $daily_real_registration_count,
//            'demo_registration_total' => $daily_demo_registration_count,
//            'deposit_total' => $daily_deposit_total_amount,
//            'deposit_count' => $daily_deposit_total_count . ' [' . $daily_deposit_total_actual_count . ']',
//            'withdraw_total' => $daily_withdraw_total_amount,
//            'withdraw_count' => $daily_withdraw_total_count
//        );

        $email_data = array(
            'title' => 'Statistics Report as of ' . date('m/d/Y', strtotime($date_yesterday)),
            'daily_statistic' => $daily_statistic,
            'monthly_statistic' => $monthly_statistic
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
//        $this->email->to('agus@forexmart.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Daily Statistics Report');
        $this->email->message($this->load->view('email/daily_statistics', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }

    public function monthlyManualTotalDepositPerPaymentGraph($days = 30, $month = 1){
        $this->load->model('deposit_model');
        $date_from = '2016-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01 00:00:00';
        $date_to = date('Y-m-t', strtotime($date_from)) . ' 23:59:59';

        //Get Popular Deposit Method
        $most_deposit = $this->deposit_model->getDepositPerPaymentSystems( $date_from, $date_to );
        $total_most_deposit = 0;
        foreach ($most_deposit as $key => $deposit) {
            $total_most_deposit += $deposit['amount'];
        }
        $most_deposit_chart_data = array();
        foreach ($most_deposit as $key => $deposit) {
            $percentage = number_format(($deposit['amount'] / $total_most_deposit) * 100, 2);
            $most_deposit_chart_data[] = "{ name: '" . strtoupper($deposit['payment_type']) . "', y: " . $percentage . "}";
        }

        $data['most_deposit_chart_data'] = $most_deposit_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_real_deposits', $data);
    }

    public function monthlyManualTotalDepositPerPayment( $month = 1 ){
        $this->load->model('deposit_model');
        $date_from = '2016-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01 00:00:00';
        $date_to = date('Y-m-t', strtotime($date_from)) . ' 23:59:59';

        $date = new DateTime();
        $file_name = 'img_monthly_mdeposit_per_payment_graph_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/monthlyManualTotalDepositPerPaymentGraph/30/' . $month .  ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $deposits = $this->deposit_model->getDepositPerPaymentSystems( $date_from, $date_to );
        $email_data = array(
            'title' => 'Monthly Total Deposits Per Payment System - ' . date('F', strtotime($date_from)),
            'deposit_data' => $deposits,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
        
//        $this->email->to('vela.nightclad@gmail.com');
        $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        $this->email->subject('Monthly Total Deposits Per Payment System');
        $this->email->message($this->load->view('email/monthly_deposit_per_payment', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function monthlyManualTotalDepositPerCountryGraph($days = 30, $month = 1){
        $this->load->model('deposit_model');
        $date_from = '2016-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01 00:00:00';
        $date_to = date('Y-m-t', strtotime($date_from)) . ' 23:59:59';

        //Get Popular Deposit Method
        $most_deposit = $this->deposit_model->getDepositPerCountries( $date_from, $date_to );
        $total_most_deposit = 0;
        foreach ($most_deposit as $key => $deposit) {
            $total_most_deposit += $deposit['amount'];
        }
        $most_deposit_chart_data = array();
        foreach ($most_deposit as $key => $deposit) {
            $percentage = number_format(($deposit['amount'] / $total_most_deposit) * 100, 2);
            $country_name = $this->general_model->getCountries($deposit['country']);
            if($country_name){
                $most_deposit_chart_data[] = "{ name: '" . strtoupper($country_name) . "', y: " . $percentage . "}";
            }else{
                $most_deposit_chart_data[] = "{ name: '" . strtoupper($deposit['country']) . "', y: " . $percentage . "}";
            }
        }

        $data['most_deposit_chart_data'] = $most_deposit_chart_data;
        $data['days'] = $days;

        $this->load->view('email/element/graph_real_deposits', $data);
    }

    public function monthlyManualTotalDepositPerCountry($month = 1){
        $this->load->model('deposit_model');
        $date_from = '2016-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01 00:00:00';
        $date_to = date('Y-m-t', strtotime($date_from)) . ' 23:59:59';

        $date = new DateTime();
        $file_name = 'img_monthly_deposit_per_country_graph_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/monthlyManualTotalDepositPerCountryGraph/30/' . $month .  ' /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $deposits = $this->deposit_model->getDepositPerCountries( $date_from, $date_to );
        foreach($deposits as $key => $value){
            $country_name = $this->general_model->getCountries($value['country']);
            if($country_name){
                $deposits[$key]['country_name'] = $country_name;
            }else{
                $deposits[$key]['country_name'] = $value['country'];
            }
        }

        $email_data = array(
            'title' => 'Monthly Total Deposits Per Country - ' . date('F', strtotime($date_from)),
            'deposit_data' => $deposits,
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('fin-stats@forexmart.com');
      $this->email->bcc('agus@forexmart.com, vela.nightclad@gmail.com');
        //$this->email->to('vela.nightclad@gmail.com');
//        $this->email->bcc('vela.nightclad@gmail.com');
        $this->email->subject('Monthly Total Deposits Per Country');
        $this->email->message($this->load->view('email/monthly_deposit_per_country', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function manual_deposit(){
        $this->load->model('account_model');
        $this->load->model('deposit_model');

        $date = new DateTime();
        $mb_transaction_id = $date->getTimestamp();
        $amount = 66;
        $currency = 'USD';
        $status = 2;
        $user_id = 96997;
        $order_number = $date->getTimestamp();

        $conv_amount_fee = 0;
        $fee = 0;
        if ($status == 2) {
            $fee = $amount * 0.035;
            $conv_amount_fee = $this->get_convert_amount($currency, $fee);
            $amount -= $fee;
        }
        $conv_amount = $this->get_convert_amount($currency, $amount);

        $data = array(
            'transaction_id' => $mb_transaction_id,
            'reference_id' => $order_number,
            'status' => 2,
            'amount' => $amount,
            'currency' => $currency,
            'user_id' => $user_id,
            'payment_date' => date('Y-m-d H:i:s', strtotime('now')),
            'note' => 'TEST DEPOSIT',
            'transaction_type' => 'SKRILL',
            'conv_amount' => $conv_amount
        );

        if ($fee > 0) {
            $data_fee = array(
                'transaction_id' => $mb_transaction_id,
                'reference_id' => $order_number,
                'status' => 2,
                'amount' => $fee,
                'currency' => $currency,
                'user_id' => $user_id,
                'payment_date' => date('Y-m-d H:i:s', strtotime('now')),
                'note' => 'TEST DEPOSIT',
                'transaction_type' => 'SKRILL',
                'conv_amount' => $conv_amount_fee
            );
        }

        $config = array(
            'server' => 'live_new'
        );
        if ($status == 2) {
            $account = $this->account_model->getAccountByUserId($user_id);

            $WebService = new WebService($config);
            $account_number = $account['account_number'];
            $WebService->update_live_deposit_balance($account_number, $amount, 'TEST DEPOSIT');
            if ($WebService->request_status === 'RET_OK') {
                $data['mt_ticket'] = $WebService->get_result('Ticket');
                $WebService2 = new WebService($config);
                $WebService2->request_live_account_balance($account_number);
                if ($WebService2->request_status === 'RET_OK') {
                    $balance = $WebService2->get_result('Balance');
                    $this->account_model->updateAccountBalance($account_number, $balance);
                    //FXPP::extraCommission($account_number,$amount,$data['transaction_id']);  // Exatra commission update
                }
            }else{
                echo $WebService->request_status;
            }

            if ($fee > 0) {
                $WebService = new WebService($config);
                $account_number = $account['account_number'];
                $WebService->update_live_deposit_balance($account_number, $fee, 'TEST DEPOSIT');
                if ($WebService->request_status === 'RET_OK') {
                    $data_fee['mt_ticket'] = $WebService->get_result('Ticket');
                    $WebService2 = new WebService($config);
                    $WebService2->request_live_account_balance($account_number);
                    if ($WebService2->request_status === 'RET_OK') {
                        $balance = $WebService2->get_result('Balance');
                        $this->account_model->updateAccountBalance($account_number, $balance);
                    }
                }else{
                    echo 'Fee: ' . $WebService->request_status;
                }

            }
        }

        if (!$this->deposit_model->insertPayment($data)) {
            echo 'Manual Deposit failed.';
        }

        if ($fee > 0) {
            if (!$this->deposit_model->insertPayment($data_fee)) {
                echo 'Manual Deposit Fee failed.';
            }
        }
    }


    public function mailSingaporeCron(){
/*      $this->load->model('account_model');
      $selectAllUnsentEmailforSingapore = $this->account_model->selectAllUnsentEmailforSingapore();
       foreach ($selectAllUnsentEmailforSingapore as $value) {
            if ($value['start_date'] < strtotime('now') ) {
                echo $value['email'];
                echo $value['start_date'];
                echo "<br>";
                if ($value['type']==1) {
                   self::singaporePartner($value['email']);
                }else{
                   self::singaporeClient($value['email']);
                }
                $this->account_model->selectAllUnsentEmailforSingaporeCounter($value['id']);
            }
       }*/
       exit();
    $this->load->model('account_model');
      $getAllUnsentformassMailing = $this->account_model->getAllUnsentformassMailing();
       foreach ($getAllUnsentformassMailing as $value) {

                $to = $value['email'];
                $unsubscribe = $value['unsubscribe'];

                if ($value['language']=='EN') {
                   self::lasPalmasEnglishClient($to,$unsubscribe);

                }else{
                   self::lasPalmasRussianClient($to,$unsubscribe);
                }

                    $this->account_model->getAllUnsentformassMailingCounter($value['id']);
                
                echo "<br>";
            
       }
    }

    public function singaporePartner($to){
       $subject = 'ForexMart Reminds you of ShowFx World Conference in Singapore';
       $replyto = 'support@notify.forexmart.com';
      Fx_mailer::Mailertest_singapore_partner2( $to , $replyto , $subject );
    }

    public function singaporeClient($to){
       $subject = 'ForexMart Reminds you of ShowFx World Conference in Singapore';
       $replyto = 'support@notify.forexmart.com';
      Fx_mailer::Mailertest_singapore_client2( $to , $replyto , $subject );
    }


    public function monthlyCountryReport(){


        set_time_limit(380);

        $this->load->model('account_model');

        $this->load->library('email');
        $cgi = array('RU','AM','BY','KZ','KG','MD','RU','TJ','TM','UA');
        $config = array(
            'mailtype'=> 'html'
        );
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;



        $insert_data['country'] = $this->general_model->getCountries();
        $insert_data['country']['cis'] = "Russia and CIS countries";
        if($all = $this->account_model->monthlyDifferentCountryReport()){

            foreach($all as $key=>$val){
                if(in_array($val->country,$cgi)){
                    $country['cis'][] = $all[$key];
                }else{
                    if(strlen($val->country)==2){
                        $country[$val->country][] = $all[$key];
                    }

                }

            }
        }

        if(isset($country)){

            foreach($country as $k=>$d){

               if(strlen($insert_data['country'][$k])>0){

                        $insert_data['subject']  = "Monthly Client Report [".$insert_data['country'][$k]."] - ".date('F Y', strtotime(' -3 day'));

                        $insert_data['client_country'] = $d;
                        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');

                        if($k=='cis'){
                            $to = "clients_russia_daily_1@forexmart.com,clients_russia_daily_2@forexmart.com,clients_total_monthly@forexmart.com";
                            //$to = "agus@forexmart.com";
                        }else{
                            $to = "clients_total_monthly@forexmart.com";
                            //$to = "agus@forexmart.com";
                        }

                        $this->email->to($to);
                        $this->email->bcc('agus@forexmart.com');
                        $this->email->subject( $insert_data['subject']);
                        $this->email->message($this->load->view('email/oneTimeReport', $insert_data, TRUE));
                        if($this->email->send()){
                            echo 'sent!';
                        }else{
                            echo $this->email->print_debugger();
                        }

               }
            }
        }

    }


    public function MassMail(){
      $this->load->model('account_model');
      $getAllUnsentformassMailing = $this->account_model->getAllUnsentformassMailing(1);
       foreach ($getAllUnsentformassMailing as $value) {

                $to = $value['email'];
                $unsubscribe = $value['unsubscribe'];


                echo $to;
                echo $unsubscribe;

                if ($value['language']=='EN') {
                    Fx_mailer::lasPalmasEnglishClient($to,$unsubscribe);

                }else{
                  Fx_mailer::lasPalmasRussianClient($to,$unsubscribe);
                }

                $this->account_model->getAllUnsentformassMailingCounter($value['id']);
                echo "<br>";
            
       }
    }

    public function MassMail2()
    {
        $this->load->model('account_model');
        $getAllUnsentformassMailing = $this->account_model->getAllUnsentformassMailing(3);
        foreach ($getAllUnsentformassMailing as $value) {

            $to = $value['email'];
            $unsubscribe = $value['unsubscribe'];
            $login_type = $value['login_type'];


            echo $to;
            echo "<==>";
            echo $unsubscribe;
            echo "<==>";
            echo $login_type;
            echo "<br>";


            // if ($value['language'] == 'EN') {
            //     Fx_mailer::rpjmail($to, $unsubscribe);

            // } else {
            //     Fx_mailer::rpjmail_russian($to, $unsubscribe);
            // }
            // $this->account_model->getAllUnsentformassMailingCounter($value['id']);
            // echo "<br>";
            // 0 client 1 partner 3 non forex 
            switch ($login_type) {
                case '0': //client
                    if ($value['language'] == 'EN') {
                        Fx_mailer::showfxKievEventClient($to, $unsubscribe);
                    } else {
                        Fx_mailer::showfxKievEventClient_russian($to, $unsubscribe);
                    }
                    break;
                case '1': //partner
                    if ($value['language'] == 'EN') {
                        Fx_mailer::showfxKievEventPartner($to, $unsubscribe);
                    } else {
                        Fx_mailer::showfxKievEventPartner_russian($to, $unsubscribe);
                    }
                    break;
                case '3'://uploaded
                    if ($value['language'] == 'EN') {
                        Fx_mailer::showfxKievEventUploaded($to, $unsubscribe);
                    } else {
                        Fx_mailer::showfxKievEventUploaded_russian($to, $unsubscribe);
                    }
                    break;
                default:
                    Fx_mailer::showfxKievEventUploaded('mottakaquezo68@gmail.com', 'this is error $to');
                    break;
            }
            $this->account_model->getAllUnsentformassMailingCounter($value['id']);
            echo "<br>";






        }
    }



    private function minibonus(){
        // task FXPP-4516
        $this->load->library('Minibonus');
        Minibonus::mark_all_inactiveaccounts();
        Minibonus::mark_inactive_3rdtoNth();
    }



    public function testAccountBalances(){
        $this->load->model('account_model');
        $this->load->model('user_model');

        $exclude = array(
            105469,
            101039,
            101042,
            104095,
            101043,
            104353,
            101840,
            104584,
            101821,
            105314,
            103984,
            103742,
            101028,
            105876,
            102762,
            103864,
            103626,
            104515,
            103174,
            103694
        );

        $accounts_old = $this->account_model->getAccountBalances($exclude); //get all live accounts balances
        foreach( $accounts_old as $key => $value ){
            $webservice_config = array(
                'server' => 'live_new'
            );

            $account_info = array(
                'iLogin' => $value['account_number']
            );

            $WebServiceBal = new WebService($webservice_config);
            $WebServiceBal->open_RequestAccountBalance($account_info);
            if( $WebServiceBal->request_status === 'RET_OK' ) {
                $balance = $WebServiceBal->get_result('Balance');
                $this->account_model->updateAmountByAccountNumber($value['account_number'], $balance);
            }
        }

        $accounts = $this->account_model->getAccountBalances($exclude); //get all live accounts balances
        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );
        foreach( $accounts as $key => $value ){
            if($value['micro']){
                $value['amount'] = $value['amount'] / 100;
            }

            if(strtoupper(trim($value['mt_currency_base'])) == 'USD'){
                $accounts[$key]['converted_amount'] = $value['amount'];
            } else {
                $WebService = new WebService($converter_config);
                $data = array(
                    'amount' => $value['amount'],
                    'from_currency' => $value['mt_currency_base'],
                    'to_currency' => 'USD'
                );

                $WebService->convert_currency_amount($data);
                if( $WebService->request_status === 'RET_OK' ) {
                    $converted_amount = $WebService->get_result('ToAmount');
                    $accounts[$key]['converted_amount'] = $converted_amount;
                }else{
                    $accounts[$key]['converted_amount'] = $value['amount'];
                }
            }

            if($accounts[$key]['converted_amount'] < 100){
                unset($accounts[$key]);
            }

            if($this->user_model->isUserTestByAccountNumber($accounts[$key]['account_number'])){
                unset($accounts[$key]);
            }
        }

        usort($accounts, function($a, $b) {
            if($a['converted_amount']==$b['converted_amount']) return 0;
            return $a['converted_amount'] < $b['converted_amount']?1:-1;
        });

        $date_now = date('Y-m-d H:i:s');
        $email_data = array(
            'accounts' => $accounts,
            'as_of_date' => $date_now
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('vela.nightclad@gmail.com');
//        $this->email->to('fin-reports@forexmart.com');
//        $this->email->cc('agus@forexmart.com');
//        $this->email->to('ad-stats@forexmart.com');
//        $this->email->cc('german.pavlyak@forexmart.com, pmtest1@groups.forexmart.com');
//        $this->email->bcc('pptest1@forexmart.com');
        $this->email->subject('Daily Client\'s Balances');
        $this->email->message($this->load->view('email/daily_account_balances', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function testCurrencyConvert(){
        $converter_config = array(
            'server' => 'converter',
            'service_id' => '505641',
            'service_password' => '5fX#p8D^c89bQ'
        );
        $WebService = new WebService($converter_config);
        $data = array(
            'amount' => 1295.66,
            'from_currency' => 'RUB',
            'to_currency' => 'USD'
        );

        $WebService->convert_currency_amount($data);
        if( $WebService->request_status === 'RET_OK' ) {
            $converted_amount = $WebService->get_result('ToAmount');
            echo number_format($converted_amount,2);
        }else{
            echo $WebService->get_all_result();
        }
    }

    public function moneyFallContest(){

        $this->load->model('account_model');
        $this->load->library('WebService');
        $from =  date('Y-m-d 00:00:00', strtotime('last week monday', strtotime('tomorrow')));

        //  $from =  date('2016-12-12 00:00:00');
        $to = date('Y-m-d 01:00:00', strtotime('last saturday', strtotime('yesterday')));

        // $to =  date('2016-12-17 01:00:00');

        $config = array(
            'server' => 'tradings'
        );

        //  echo "<pre>";

        $data = array();
        $WebService = new WebService($config);
        if($account = $this->account_model->getWeekContestWinnersByDates($from, $to)){

            foreach($account as $d){

                $account_info = array(
                    'iLogin' => $d->account_number,
                    'start_date' => $from,
                    'end_date' => $to
                );


                $WebService->GetMoneyFallContestReport($account_info);
                if ($WebService->request_status === 'RET_OK') {

                    $num = $d->num;
                    if($d->num >1){
                        $num = $this->account_model->getWeekContestWinnersByEmail($d->email);
                    }
                    $web = $WebService->get_all_result();
                    $data[] = array(
                        'login' =>$d->account_number,
                        'name'=>$d->nickname,
                        'balance'=>$d->amount,
                        'email'=>$d->email,
                        'dup' =>$d->dup, // duplicate email of this contest
                        'LessThen2MinutesOrdersCount'=>$web['LessThen2MinutesOrdersCount'],
                        'EURUSD'=>$web['ProfitLossPercentageEURUSD'],
                        'USDJPY'=>$web['ProfitLossPercentageUSDJPY'],
                        'duplicate'=>$num,
                        'instruments' =>$web['ProfitLossAdditionalInstrumentsPercentage'],
                        'profitlosspercentage'=> $web['LessThen2MinutesOrdersProfitLossPercentage'],
                        'allOrder'=> $web['AllOrdersCount']
                    );

                }
            }
//print_r($data); exit();
            $email_data = array(
                'moneyFall'=>$data,
                'subject'   => 'MoneyFall Contest Results'
            );

            $config = array(
                'mailtype'=> 'html'
            );

            $this->load->library('email');
            if($config != null){
                $this->email->initialize($config);
            }
            $this->SMTPDebug =1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to('mf_participants@forexmart.com');
            //$this->email->to('bug.fxpp@gmail.com');
            $this->email->bcc('agus@forexmart.com');
            //
            $this->email->subject('MoneyFall Contest Results');
            $this->email->message($this->load->view('email/moneyFallContest', $email_data, TRUE));
            if($this->email->send()){
                //echo 'sent!';
            }else{
                echo $this->email->print_debugger();
            }

            // print_r($data);


        }
    }

    public function limited_bonus(){
        $this->load->model('account_model');

        $date_from = date('Y-m-d 00:00:00', strtotime(' -1 day'));
        $date_now = date('Y-m-d 23:59:59', strtotime(' -1 day'));

        $limited_bonus = array();

        if($limited = $this->account_model->getLimitedBonusByDate($date_from,$date_now)){

            foreach($limited as $d){
                $ref = "N/A";
                if(strlen($d->reference_num)>1){
                    $ref = $d->referral_affiliate_code.':'. $d->reference_num;
                }
                $limited_bonus[$d->account_number] = array('ref'=>$ref, 'country' => $d->country );
            }
        }


        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $WebService->getFinanceRecordByComment('FOREXMART LIMITED BONUS', $date_from, $date_now);
        $finance_data = array();
        if($WebService->request_status == 'RET_OK'){
            $finance_records = $WebService->get_result('FinanceRecords');
            $finance_data = $finance_records->FinanceRecordData;

        }

        $email_data = array(
            'finance_data'=>$finance_data,
            'subject'   => 'Limited Bonus Report['.date('Y-m-d', strtotime(' -1 day')).']'
        );
        $email_data['limited'] = $limited_bonus;

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('ad-stats_2@forexmart.com');
        // $this->email->to('bug.fxpp@gmail.com');
        $this->email->bcc('agus@forexmart.com');
//
        $this->email->subject($email_data['subject']);
        $this->email->message($this->load->view('email/limited_bonus_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

        //print_r($data);



    }
    public function ndbAndlimitedBonusReport(){
        $this->load->model('account_model');
        $date_from = date('Y-m-d 00:00:00', strtotime(' -7 day'));
        $date_now = date('Y-m-d 23:59:59', strtotime(' -1 day'));
        $email_data = array(
            'bonus_data'=>$this->account_model->ndbAndLimitedBonusReport($date_from,$date_now),
            'subject'   => 'NDB/Limited Bonus Applicant Report'
        );


        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to(' ad-stats_2@forexmart.com');
        //$this->email->to('bug.fxpp@gmail.com');
        $this->email->bcc('agus@forexmart.com');
        $this->email->subject($email_data['subject']);
        $this->email->message($this->load->view('email/ndb_and_hpb_report', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }

    }


    public function hundredPercent(){
      date_default_timezone_set('Europe/Minsk');
      $todayMinus3days =  date('Y-m-d H:i:s', strtotime('-3 day', strtotime(date('Y-m-d H:00:00'))));
      $plus1hr =  date('Y-m-d  H:i:s', strtotime('+1 hour', strtotime($todayMinus3days)));
      // get all by todayMinus3days on  no deposit bonus is_sent_3days 0 
      $this->load->model('account_model');
      echo $todayMinus3days;
      echo "<br>";
      echo $plus1hr;
      $ndbRequest = $this->account_model->getAllNdbRequestByDate($todayMinus3days, $plus1hr);
    // var_dump($ndbRequest );
      // print_r($ndbRequest);
      foreach ($ndbRequest as $key => $value) {
        if ($this->account_model->checkIdOnDeposittable($value['user_id'])) {
            echo $value['email'];
            echo '<br>';
            // echo $value['user_id'];
            echo '<br>';
                $parts = explode("@", $value['email']);
                $username = $parts[1];
                $domain = explode(".", $parts[1]);

            if ($domain[0] != 'yahoo') {
                if ($this->account_model->checkIfEmailSent($value['email'])) {
                        // echo $value['country'];

                    $numberOfDeposit = $this->account_model->getnumberOfDeposit($value['email']);

                    if ($numberOfDeposit < 1) {

                        if ($value['country']=='RU' or $value['country']=='AZ' or  $value['country']=='UZ' or $value['country']=='BY' or  $value['country']=='KZ' or  $value['country']=='KG' or  $value['country']=='MD' or  $value['country']=='TJ' or  $value['country']=='AM' or  $value['country']=='TM' or  $value['country']=='UA' ) {
                             Fx_mailer::HundredPercentBonus_russian($value['email']);
                        
                        }else{
                             Fx_mailer::HundredPercentBonus($value['email']);
                        }

                        $data = array(
                                'email' => $value['email'],
                                'user_id' => $value['user_id'],
                                'account_number' => $value['account_number']
                        );
                        $this->account_model->insert('mail_hundred_precent_bonus',$data);
                    }
                }
            }else{
                echo "yahoo email address detected";
            }


        }
        $is_sent_3days = array('is_sent_3days' => '1' );
        $this->account_model->updateUserDetails('no_deposit', 'id', $value['id'], $is_sent_3days);
      }
    }



    // run every monday 00:00:00
    public function trader_offer_mailing() {
        date_default_timezone_set('Europe/Minsk');
        $client = new SoapClient( "https://78w.forexmart.com:6589/TicksMngrService.svc?wsdl" );
        $TicksMngrService = $client->GetSymbolWithBiggestPriceDifferenceForLastWeek();
        $TicksMngrService = $TicksMngrService->GetSymbolWithBiggestPriceDifferenceForLastWeekResult;
        $res['Symbol'] = $TicksMngrService->Symbol;
        $res['ChangePercentageString'] = $TicksMngrService->ChangePercentageString;
        $res['From'] = date('Y-m-d h:i:s', strtotime($TicksMngrService->From));
        $dateFrom = new DateTime($TicksMngrService->From);
        $dateTo = new DateTime($TicksMngrService->To);
        $data['MostIncreasingPopularSymbol']            =  $TicksMngrService->Symbol ;                  
        $data['MostIncreasingPopularSymbolPercentage']  =  $TicksMngrService->ChangePercentageString ;                
        $data['FromDate']                               =  $dateFrom->format('d-M Y g:i e') ;
        $data['ToDate']                                 =  $dateTo->format('d-M Y g:i e') ;
        $this->load->model('Mailer_model');
        if ($data['MostIncreasingPopularSymbolPercentage'] != '') {
          $this->Mailer_model->insert_dynamic('trade_offer_mailing',$data);
        }
    }

    // sending all the emails of client on monday 01:00:00
    public function trade_offer_sender(){
        // exit;
            @ini_set("output_buffering", "Off");
            @ini_set('implicit_flush', 1);
            @ini_set('zlib.output_compression', 0);
            @ini_set('max_execution_time',0);
        $this->load->model('Mailer_model');
        $emailContent = $this->Mailer_model->getTradeOfferContent()['0'];
        // testing
        // Fx_mailer::tradermailer('test.02914@gmail.com', 'test',$emailContent);
        // exit;
        foreach ($this->Mailer_model->getAllClient($emailContent['id']) as $key => $value) {            
            $to = $value['Email'];
            $unsubscribe = $value['unsubscribekey'];
            if ($value['Language'] == 'EN' ) {
                Fx_mailer::tradermailer($to, $unsubscribe,$emailContent);
            }else{
                Fx_mailer::tradermailerRussian($to, $unsubscribe,$emailContent);
            }

            $this->Mailer_model->counterForMailerTestRecipients($value['Id'],$emailContent['id']);

            if(sleep(2)!=0)
            {
                echo "sleep failed script terminating"; 
                break;
            }

            flush();
            ob_flush();

        }
    }


  public function addMassMailerNewlyRegistered(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('memory_limit', '-1');
        $this->load->model('Mailer_model');
        $this->load->model('account_model');
        $NewlyRegForMassmailer = $this->account_model->getNewlyRegForMassmailer(date('Y-m-d', strtotime('now')));
        foreach ($NewlyRegForMassmailer as $key => $value) {
           $isEmailUnique = $this->Mailer_model->massmailuniq($value['email']);
          if ($isEmailUnique) {
              echo "<br>"; 
                $fullname = "Client";

                  if($value ['login_type'] == '1') {
                    $fullname = "Partner";
                  }

                  if (!empty($value['full_name'])) {
                     $fullname = $value['full_name'];  
                  }

              if($value['country'] == 'RU') {
                $lang = 'RU';
              }else{
                $lang = 'EN';
              }
                    $Unsubscribe_key = FXPP::generateUnsubscribeKeyMassMailer();
                    $insert = array(
                        'Email' => $value['email'],
                        'Full_name' => $fullname,
                        'Language' => $lang,
                        'Login_type' => $value['login_type'],
                        'Unsubscribe_key'   =>  $Unsubscribe_key
                    );   
          $this->Mailer_model->insert_dynamic('MassMailer',$insert);

          self::postToStaging($insert);

          }
      }
      echo "finished";
  }


  public function postToStaging($array){
        $ch = curl_init();
        $insert = array(
            'Email' => $array['Email'],
            'Full_name' => $array['Full_name'],
            'Language' => $array['Language'],
            'Login_type' => $array['Login_type'],
            'Unsubscribe_key'   =>  $array['Unsubscribe_key']
        );

        curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/Unsubscribe/insertToMassMailer");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $insert);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }

    public function cashBackProgram($period=1){

       // if(!IPLoc::Office()){redirect("");}
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');

        switch( $period){
            case 1:
                $from = date('Y-m-d H:i:s', strtotime('-1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            case 2:
                $from = date('Y-m-d H:i:s', strtotime('-1 week -1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            case 3:
                $from = date('Y-m-d H:i:s', strtotime('-1 month -1 day'));
                $to = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            default:
                $from = date('Y-m-d H:i:s', strtotime('+1 day')); // no calculation
                $to = date('Y-m-d H:i:s', strtotime('+1 day')); // no calculation
        }


        // echo $from."<br>".$to;
       // echo "<pre>"; //exit();
        $webservice_config = array(
            'server' => 'live_new'
        );

        if($cashBackList  = $this->account_model->getCashBackAccountList('IHXBM')){

            foreach($cashBackList as $d){

                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iAgent' => 239789 , // int Agent Account Number who pay cashback bonus
                    'iAccount' => $d->account_number, // Client account number who registered using "IHXBM" referal code
                    'from' => date('Y-m-d\T00:00:00', strtotime($from)),
                    'to' => date('Y-m-d\T23:59:59', strtotime($to))
                );

                if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){

                    if($commission->TotalAmount>0){
                        $data_input = array(
                            'agent'=>$commission->AgentLogin,
                            'account'=>$commission->FromAccount,
                            'amount'=>$commission->TotalAmount*1, // 1 is pip cashback=commission*pip
                            'pip'=>1,
                            'date'=>date('Y-m-d H:i:s')
                        );


                        //================ Commission using API ==========================================

                        $accData = $this->general_model->showssingle("mt_accounts_set", "account_number", $commission->FromAccount, "*");
                        $partnerData = $this->general_model->showssingle("partnership", "reference_num", $commission->AgentLogin, "*");

                        $conv_amount = $this->get_convert_amount($accData['mt_currency_base'], $data_input['amount'], $partnerData['currency']);
                        $config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($config);
                        $account_number = $accData['account_number'];
                        $WebService->update_live_deposit_balance($account_number, $conv_amount, "Cashback");
                        if ($WebService->request_status === 'RET_OK') {
                            $data['mt_ticket'] = $WebService->get_result('Ticket');
                            $WebService2 = new WebService($config);
                            $WebService2->request_live_account_balance($account_number);
                            if ($WebService2->request_status === 'RET_OK') {
                                $balance = $WebService2->get_result('Balance');
                                $this->general_model->insert('cashback_log',$data_input);
                                $this->deposit_model->updateAccountBalance($account_number, $balance);

                                // ================================== Deduct rebate commission


                                $config = array(
                                    'server' => 'live_new'
                                );
                                $WebService = new WebService($config);
                                $account_number = $commission->AgentLogin;
                                $WebService->update_live_deposit_balance($account_number, -$data_input['amount'], "Cashback to ".$commission->AgentLogin." where ".$commission->FromAccount." is account number of client");
                                if ($WebService->request_status === 'RET_OK') {
                                    $data['mt_ticket'] = $WebService->get_result('Ticket');
                                    $WebService2 = new WebService($config);
                                    $WebService2->request_live_account_balance($account_number);
                                    if ($WebService2->request_status === 'RET_OK') {
                                        $balance = $WebService2->get_result('Balance');
                                        $this->deposit_model->updatePartnerBalance($account_number, $balance);

                                    }
                                }

                                // ============================
                            }
                        }





                        // end ===============================================

                    }


                }

            }
        }
    }

    public function cashBackProgramPerHour(){

        // if(!IPLoc::Office()){redirect("");}
        $this->load->model('account_model');
        $this->load->model('deposit_model');
        $this->load->model('general_model');

        $from = date('Y-m-d H:i:s', strtotime('- 1 hour'));
        $to = date('Y-m-d H:i:s');


        // echo $from."<br>".$to;
        // echo "<pre>"; //exit();
        $webservice_config = array(
            'server' => 'live_new'
        );

        if($cashBackList  = $this->account_model->getCashBackAccountList('IHXBM')){

            foreach($cashBackList as $d){

                // checking claim the NDB
                if($d->nodepositbonus==1){continue;} // Iggnor next step;
                // No cashback if client already has another agent (affiliate)
                if($client_ref_num =$this->account_model->getClientReferralAffiliateCode($d->email)){
                   // continue; // Stop for another task FXPP-8361
                    //echo $d->email;
                   /* $spacial_ref_code = array(
                        'dep30','JSMUI','HEVGG','JYUOR','KTVDM','YFURM','MJLHV','VYPHE','ZAGJU','KMSdep30','s_hol_zar','s_hol_ter','s_hol_akc','s_hol_par',
                        's_tep_for','s_hol_opt','p_bezdep','p_bons','p_hol_zar','p_hol_ter','p_hol_opt','SEZPP','CJVMD','SJFTQ','VTJZV','MIRXG','EBLRV',
                        'HOEIZ','WMBZP','ODAZE','SSEOT','NKKLH','YQNKI','JLGNR'
                    );
                    if(sizeof($client_ref_num)==1){

                        if(!in_array($client_ref_num[0]['referral_affiliate_code'],$spacial_ref_code)){

                            continue;
                        }

                    }else{
                        continue;
                    }*/
                }


                $WebService = new WebService($webservice_config);
                $account_info = array(
                    'iAgent' => 239789 , // int Agent Account Number who pay cashback bonus
                    'iAccount' => $d->account_number, // Client account number who registered using "IHXBM" referal code
                    'from' => date('Y-m-d\TH:i:s', strtotime($from)),
                    'to' => date('Y-m-d\TH:i:s', strtotime($to))
                );

                if( $commission = $WebService->GetAgentTotalCommissionFromAccount($account_info)){

                    if($commission->TotalAmount>0){
                        $data_input = array(
                            'agent'=>$commission->AgentLogin,
                            'account'=>$commission->FromAccount,
                            'amount'=>$commission->TotalAmount*1, // 1 is pip cashback=commission*pip
                            'pip'=>1,
                            'date'=>date('Y-m-d H:i:s')
                        );


                        //================ Commission using API ==========================================

                        $accData = $this->general_model->showssingle("mt_accounts_set", "account_number", $commission->FromAccount, "*");
                        $partnerData = $this->general_model->showssingle("partnership", "reference_num", $commission->AgentLogin, "*");

                        $conv_amount = $this->get_convert_amount($accData['mt_currency_base'], $data_input['amount'], $partnerData['currency']);
                        $config = array(
                            'server' => 'live_new'
                        );
                        $WebService = new WebService($config);
                        $account_number = $accData['account_number'];
                        $WebService->update_live_deposit_balance($account_number, $conv_amount, "Cashback");
                        if ($WebService->request_status === 'RET_OK') {
                            $data['mt_ticket'] = $WebService->get_result('Ticket');
                            $WebService2 = new WebService($config);
                            $WebService2->request_live_account_balance($account_number);
                            if ($WebService2->request_status === 'RET_OK') {
                                $balance = $WebService2->get_result('Balance');
                                $this->general_model->insert('cashback_log',$data_input);
                                $this->deposit_model->updateAccountBalance($account_number, $balance);

                                // ================================== Deduct rebate commission


                                $config = array(
                                    'server' => 'live_new'
                                );
                                $WebService = new WebService($config);
                                $account_number = $commission->AgentLogin;
                                $WebService->update_live_deposit_balance($account_number, -$data_input['amount'], "Cashback to ".$commission->AgentLogin." where ".$commission->FromAccount." is account number of client");
                                if ($WebService->request_status === 'RET_OK') {
                                    $data['mt_ticket'] = $WebService->get_result('Ticket');
                                    $WebService2 = new WebService($config);
                                    $WebService2->request_live_account_balance($account_number);
                                    if ($WebService2->request_status === 'RET_OK') {
                                        $balance = $WebService2->get_result('Balance');
                                        $this->deposit_model->updatePartnerBalance($account_number, $balance);

                                    }
                                }

                                // ============================
                            }
                        }





                        // end ===============================================

                    }


                }

            }
        }
    }


//    public function contest_winners(){
//        $this->load->model('account_model');
//
//        $contest_date_start =  '2016-12-05 00:00:00';
//        $contest_date_end = '2016-12-09 23:59:59';
//
//        $start_date = '2016-11-28 00:00:00';
//        $end_date = '2016-12-04 23:59:59';
//
//        //Get updated contest winners
//        $contest_data = $this->account_model->getContestWinners( $start_date, $end_date );
//
//        //Update winner list
//        $winners = array();
//        if($contest_data){
//            $rank = 0;
//            $prev_value = 0;
//            foreach($contest_data as $key => $value){
//
//                if($prev_value <> $value['amount']){
//                    $rank++;
//                    $prev_value = $value['amount'];
//                }
//
//                $winners[] = array(
//                    'start_date' => $contest_date_start,
//                    'end_date' => $contest_date_end,
//                    'user_id' => $value['user_id'],
//                    'amount' => $value['amount'],
//                    'currency' => $value['mt_currency_base'],
//                    'account_number' => $value['account_number'],
//                    'rank' => $rank,
//                    'nickname' => $value['NickName']
//                );
//            }
//        }
//
//        if(count($winners) > 0) {
//            $this->account_model->updateCurrentWinners($contest_date_start, $winners);
//        }
//    }


    public function updateSpread() {
        $this->load->model('spread_model');
        $date = date('Y-m-d', strtotime(FXPP::getServerTime()));
        $time = date('H:i:s', strtotime(FXPP::getServerTime()) + 21600);

        $instruments = $this->spread_model->getInstrumentsByDateTime($date, $time);//GET INSTRUMENTS TO BE UPDATED AT CURRENT DATE AND TIME

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        foreach ($instruments as $key) {
            $data = array(
                'symbol' => $key['symbol'],
                'dateStart' => $key['date_start'],
                'timeStart' => $key['time_start'],
                'dateEnd' => $key['date_end'],
                'timeEnd' => $key['time_end'],
                'spread1' => $key['spread'],
                'spread2' => $key['new_spread'],
                'repeat' => $key['repeat']
            );

            if($data['repeat'] != '1') {//NON REPEATING CHANGE
                if ($date == $data['dateStart'] && $data['timeStart'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//UPDATE SPREAD IN API
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => $data['spread1'],
                            'date_start' => 0,
                            'time_start' => 0
                        );
                        $this->spread_model->updateSpread($data['symbol'], $updateData);//UPDATE SPREAD
                    } else {
                        echo $WebService->request_status;exit;
                    }
                } else if ($date == $data['dateEnd'] && $data['timeEnd'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//REVERT SPREAD IN API WHEN TIME EXPIRES
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => '',
                            'date_end' => 0,
                            'time_end' => 0
                        );
                        $this->spread_model->updateSpread($data['symbol'], $updateData);//REVERT BACK TO OLD SPREAD WHEN TIME EXPIRES
                    } else {
                        echo $WebService->request_status;exit;
                    }
                }
            } else {//REPEATING CHANGE
                $dateStart = date('Y-m-d', strtotime($data['dateStart']. "+1 days"));//SET DATE OF NEXT UPDATE
                $dateEnd = date('Y-m-d', strtotime($data['dateEnd']. "+1 days"));//SET DATE OF NEXT REVERT
                if ($date == $data['dateStart'] && $data['timeStart'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//UPDATE SPREAD IN API
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => $data['spread1'],
                            'date_start' => $dateStart
                        );
                        $this->spread_model->updateSpread($data['symbol'], $updateData);//UPDATE SPREAD
                    } else {
                        echo $WebService->request_status;exit;
                    }
                } else if ($date == $data['dateEnd'] && $data['timeEnd'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//REVERT SPREAD IN API WHEN TIME EXPIRES
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => $data['spread1'],
                            'date_end' => $dateEnd
                        );
                        $this->spread_model->updateSpread($data['symbol'], $updateData);//REVERT BACK TO OLD SPREAD WHEN TIME EXPIRES
                    } else {
                        echo $WebService->request_status;exit;
                    }
                }
            }

            /*--- SAVE LOGS FOR INSTRUMENTS ---*/
            $data2 = array(
                'from' => $key['spread'],
                'to' => $key['new_spread'],
                'date_changed' => $date,
                'time_changed' => date('H:i:s', strtotime($time))
            );
            $this->spread_model->saveInstrumentsResponse($data2, $key['symbol']);
            /*--- SAVE LOGS FOR INSTRUMENTS ---*/
        }
    }

    public function updateSpread2() {//FOR UPDATE SPREAD DEBUGGING
        echo '<pre>';
        $this->load->model('spread_model');
        $date = date('Y-m-d', strtotime(FXPP::getServerTime()));
        $time = date('H:i:s', strtotime(FXPP::getServerTime()) + 21600);
        $tomorrow = date('Y-m-d',strtotime($date . "+1 days"));

        echo 'Timezone: '.date('e').'<br/>';
        echo 'Date Time now: '.date('Y-m-d',strtotime('now')).' '.date('H:i:s', strtotime('now')).'<br/>';
        echo 'Server Date Time: ' . $date . ' ' . $time . '<br/>';
        echo 'Date Tomorrow: '.$tomorrow.'<br/>';

        $instruments = $this->spread_model->getInstrumentsByDateTime($date, $time);//GET INSTRUMENTS TO BE UPDATED AT CURRENT DATE AND TIME

        echo 'INSTRUMENTS<br/>';
        var_dump($instruments);

        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);

        foreach ($instruments as $key) {
            $data = array(
                'id' => $key['id'],
                'symbol' => $key['symbol'],
                'dateStart' => $key['date_start'],
                'timeStart' => $key['time_start'],
                'dateEnd' => $key['date_end'],
                'timeEnd' => $key['time_end'],
                'spread1' => $key['spread'],
                'spread2' => $key['new_spread'],
                'repeat' => $key['repeat']
            );
            echo '<br/>FETCHED DATA<br/>';
            var_dump($data);

            if($data['repeat'] != '1') {//NON REPEATING CHANGE
                echo 'test1';
                if ($date == $data['dateStart'] && $data['timeStart'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//UPDATE SPREAD IN API
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => $data['spread1'],
                            'date_start' => 0,
                            'time_start' => 0
                        );
                        var_dump($updateData);
                        $updateSpread = $this->spread_model->updateSpread($data['id'], $updateData);//UPDATE SPREAD
                        var_dump($updateSpread);
                    } else {
                        echo $WebService->request_status;exit;
                    }
                } else if ($date == $data['dateEnd'] && $data['timeEnd'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//REVERT SPREAD IN API WHEN TIME EXPIRES
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => '',
                            'date_end' => 0,
                            'time_end' => 0
                        );
                        $this->spread_model->updateSpread($data['id'], $updateData);//REVERT BACK TO OLD SPREAD WHEN TIME EXPIRES
                    } else {
                        echo $WebService->request_status;exit;
                    }
                }
            } else {//REPEATING CHANGE
                $dateStart = date('Y-m-d', strtotime($data['dateStart']. "+1 days"));//SET DATE OF NEXT UPDATE
                $dateEnd = date('Y-m-d', strtotime($data['dateEnd']. "+1 days"));//SET DATE OF NEXT REVERT
                if ($date == $data['dateStart'] && $data['timeStart'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//UPDATE SPREAD IN API
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => $data['spread1'],
                            'date_start' => $dateStart
                        );
                        $updateSpread = $this->spread_model->updateSpread($data['id'], $updateData);//UPDATE SPREAD
                        var_dump($updateSpread);
                    } else {
                        echo $WebService->request_status;exit;
                    }
                } else if ($date == $data['dateEnd'] && $data['timeEnd'] < $time) {
                    $WebService->change_symbol_spread($data['symbol'], $data['spread2']);//REVERT SPREAD IN API WHEN TIME EXPIRES
                    if ($WebService->request_status === 'RET_OK') {
                        $updateData = array(
                            'spread' => $data['spread2'],
                            'new_spread' => $data['spread1'],
                            'date_end' => $dateEnd
                        );
                        $updateSpread = $this->spread_model->updateSpread($data['id'], $updateData);//REVERT BACK TO OLD SPREAD WHEN TIME EXPIRES
                        var_dump($updateSpread);
                    } else {
                        echo $WebService->request_status;exit;
                    }
                }
            }

            /*--- SAVE LOGS FOR INSTRUMENTS ---*/
            $data2 = array(
                'from' => $key['spread'],
                'to' => $key['new_spread'],
                'date_changed' => $date,
                'time_changed' => date('H:i:s', strtotime($time))
            );
            echo '<br/>INSTRUMENT RESPONSE UPDATE DATA<br/>';
            var_dump($data2);
            $this->spread_model->saveInstrumentsResponse($data2, $key['id']);
            /*--- SAVE LOGS FOR INSTRUMENTS ---*/
        }
    }

// everyday 00:00
    public function saveEconomicCalendar() {
        $resEn = $this->getEconomicCalendar('en');  // en or ru
        $resRu = $this->getEconomicCalendar('ru');  // en or ru
        print_r($resEn);
        print_r($resRu);
        $this->load->model('Calendar_model');
        if ($resEn['CalendarId'] != NULL) {
            if ( $this->Calendar_model->calendarExisted( $resEn['CalendarId'] ) ) {
                $this->Calendar_model->insertMailCalendar( $resEn );
            }
        }
        if ($resRu['CalendarId'] != NULL) {
            if ( $this->Calendar_model->calendarExisted( $resRu['CalendarId'] ) ) {
                $this->Calendar_model->insertMailCalendar( $resRu );
            }
        }
    }


    private function getEconomicCalendar($lang) {
        $this->load->model('Calendar_model');
        $passDate = date('Y-m-d', strtotime('tomorrow'));
        $today = date('Y-m-d', strtotime('today'));

        $postData = array(
            'dateType' => '',
            'date' => $passDate,
            'offset' => '',
            'limit' => 1,
            'priority' => 'High',
            'country' => '',
            'time' => 2,
            'language' => $lang
        );

        $data = $this->Calendar_model->getCalendarEvents($postData);
        $res = $data[0][0];
        if ($res != NULL) {
            $res['Forecast'] = $res['Forecast'] != null ? $res['Forecast'] : NULL;
            $res['Previous'] = $res['Previous'] != null ? $res['Previous'] : NULL;
            $res['Country'] = $this->Calendar_model->countryToCurrency($res['Country']);
        }
        $res['saveDate'] = $today;
        return $res;
    }

    public function economicCalendarSenderEng() {
        ini_set("output_buffering", "Off");
        ini_set('implicit_flush', 1);
        ini_set('zlib.output_compression', 0);
        ini_set('max_execution_time', 1200);
        $this->load->model('Calendar_model');
        $now = strtotime('now');
        $lang = 'En';
        $res = $this->Calendar_model->getCalendarByDate(date('Y-m-d',  $now),$lang);
        if ($res) {
            foreach ( $this->Calendar_model->getAllClientByLangAndDate(strtoupper($lang)) as $key => $value) {
              var_dump($value);
              var_dump($res);
              
                Fx_mailer::test_economic_calendar($value['Email'],$value['unsubscribekey'] , $res);

                // delay
                if (sleep(2) != 0) {
                    echo "sleep failed script terminating";
                    break;
                }
                flush();
                ob_flush();
            }
        }
    }

    public function economicCalendarSenderRus() {
        ini_set("output_buffering", "Off");
        ini_set('implicit_flush', 1);
        ini_set('zlib.output_compression', 0);
        ini_set('max_execution_time', 1200);
        $this->load->model('Calendar_model');
        $now = strtotime('now');
        $lang = 'Ru';
        $res = $this->Calendar_model->getCalendarByDate(date('Y-m-d',  strtotime('now')),$lang);

        if ($res) {
            foreach ( $this->Calendar_model->getAllClientByLangAndDate(strtoupper($lang)) as $key => $value) {
              var_dump($value);
              var_dump($res);

                Fx_mailer::test_economic_calendar_ru($value['Email'],$value['unsubscribekey'] , $res);

              $this->Calendar_model->economicCalendarCounter($value['Id']);
              // send

                // delay
                if (sleep(2) != 0) {
                    echo "sleep failed script terminating";
                    break;
                }
                flush();
                ob_flush();
            }
        }
    }


    // NDB

    public function ndb_report_weekly(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -1 days'));

        $from =  date('Y-m-d 00:00:00', strtotime('last week sunday', strtotime('last week')));
        // $from =  date('2016-12-26 00:00:00');
        $to = date('Y-m-d 23:59:59', strtotime('last saturday', strtotime('yesterday')));



        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate_ndb( $from, $to );
        $real_account_chart_data_30 = array();
        foreach($real_accounts_data_30 as $key => $account){
            $real_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 60 days
        $real_accounts_data_60 = $this->account_model->clients_who_claimed_NDB( $from, $to );
        $real_account_chart_data_60 = array();
        foreach($real_accounts_data_60 as $key => $account){
            $real_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 180 days
        $real_accounts_data_180 = $this->account_model->clients_who_did_not_complete_registration($from,$to);
        $real_account_chart_data_180 = array();
        foreach($real_accounts_data_180 as $key => $account){
            $real_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }



        $data['real_accounts_data_30'] = $real_account_chart_data_30;
        $data['real_accounts_data_60'] = $real_account_chart_data_60;
        $data['real_accounts_data_180'] = $real_account_chart_data_180;
        $data['table'] = array(
            'registered_clients'=> count($real_accounts_data_30),
            'received_NDB'=> count($real_accounts_data_60),
            'Percentage'=>count($real_accounts_data_60)/ count($real_accounts_data_30)
        );


//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_real_accounts_ndb', $data);
    }

    public function ndb_report_daily(){
        $this->load->model('account_model');
        $date_now = date('Y-m-d', strtotime('now'));
        $date_from_30 = date('Y-m-d', strtotime($date_now . ' -1 days'));


        //Get Opened Real Accounts for 30 days
        $real_accounts_data_30 = $this->account_model->getRealAccountsCountByDate_ndb( $date_from_30, $date_now );
        $real_account_chart_data_30 = array();
        foreach($real_accounts_data_30 as $key => $account){
            $real_account_chart_data_30[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 60 days
        $real_accounts_data_60 = $this->account_model->clients_who_claimed_NDB( $date_from_30, $date_now );
        $real_account_chart_data_60 = array();
        foreach($real_accounts_data_60 as $key => $account){
            $real_account_chart_data_60[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }

        //Get Opened Real Accounts for 180 days
        $real_accounts_data_180 = $this->account_model->clients_who_did_not_complete_registration($date_from_30,$date_now);
        $real_account_chart_data_180 = array();
        foreach($real_accounts_data_180 as $key => $account){
            $real_account_chart_data_180[]="[". strtotime($account['registration_date'])*1000 .",". $account['registration_count'] ."]";
        }



        $data['real_accounts_data_30'] = $real_account_chart_data_30;
        $data['real_accounts_data_60'] = $real_account_chart_data_60;
        $data['real_accounts_data_180'] = $real_account_chart_data_180;
        $data['table'] = array(
            'registered_clients'=> count($real_accounts_data_30),
            'received_NDB'=> count($real_accounts_data_60),
            'Percentage'=>count($real_accounts_data_60)/ count($real_accounts_data_30)
        );


//        $this->template->title("Dashboard | Forexmart")
//            ->set_layout('external/main')
//            ->build('email/element/graph_real_accounts', $data);
        $this->load->view('email/element/graph_real_accounts_ndb', $data);
    }

    public function send_ndb_report_weekly(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_real_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/ndb_report_weekly /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name),
            'form'=>date('Y-m-d 00:00:00', strtotime('last week sunday', strtotime('last week'))),
            'to'=>date('Y-m-d 23:59:59', strtotime('last saturday', strtotime('yesterday')))
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//            $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
       // $this->email->to('agus@forexmart.com');
        $this->email->to('ndb-stats@forexmart.com');

        $this->email->bcc('agus@forexmart.com,bug.fxpp@gmail.com');
        $this->email->subject('NDB clients statistics weekly');
        $this->email->message($this->load->view('email/daily_real_accounts_graph_ndb', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    public function send_ndb_report_daily(){
        ini_set('max_execution_time', 0);
        $date = new DateTime();
        $file_name = 'img_daily_real_graphs_' . $date->getTimestamp() . '.png';
        shell_exec('wkhtmltoimage --quality 30 https://www.forexmart.com/cron/ndb_report_daily /var/www/html/forexmart.com/assets/reports/' . $file_name);

        $email_data = array(
            'img_val' => FXPP::loc_url('assets/reports/' . $file_name)
        );

        $config = array(
            'mailtype'=> 'html'
        );

        $this->load->library('email');
        if($config != null){
            $this->email->initialize($config);
        }
        $this->SMTPDebug =1;
        $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
//      $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
        $this->email->to('ndb-stats@forexmart.com');

        $this->email->bcc('agus@forexmart.com,bug.fxpp@gmail.com');
        $this->email->subject('NDB clients statistics daily');
        $this->email->message($this->load->view('email/daily_real_accounts_graph_ndb', $email_data, TRUE));
        if($this->email->send()){
            //echo 'sent!';
        }else{
            echo $this->email->print_debugger();
        }
    }

    // END NDB


    public function subscribeToStaging($Unsubscribe_key){
        $ch = curl_init();
        $data = array('Unsubscribe_key'=> $Unsubscribe_key);

            curl_setopt($ch, CURLOPT_URL,"http://s-www.forexmart.com/Unsubscribe/subscribeThisEmail");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close ($ch);
        return $server_output;
    }
/*FXPP-7993*/
    public function activateUnsubscribedEmail(){   
        $this->load->model('Mailer_model');
        foreach ($this->Mailer_model->getUnsubscribeEmailAfter4Months() as $key => $value) {
            $this->Mailer_model->subscribeThisEmail($value['Email']);
        
        }
    }

    public function activateUnsubscribedEmail2(){   //trade offer informer market  Economic Calendar
        $this->load->model('Mailer_model');
        foreach ($this->Mailer_model->getUnsubscribeEmailAfter4Months2() as $key => $value) {
            $this->Mailer_model->subscribeThisEmail2($value['Email']);
            print_r($value['Email']);
        }
    }

    public function sendingCopyTrade(){ 
        ini_set("output_buffering", "Off");
        ini_set('implicit_flush', 1);
        ini_set('zlib.output_compression', 0);
        ini_set('max_execution_time', 1200);
        $this->load->model('Logs_model');
        $webservice_config = array('server' => 'minifcservice');
        $WebService = new WebService($webservice_config);
        $account_info = array(
          // 'isLastOneHour' => false,
          'isLastOneHour' => true,
          'from' => '2015-12-01T00:00:00',
          'to' => '2017-12-31T23:59:59'
          );
        $WebService->open_GetAutomaticallyUnsubscribedAccounts($account_info);
        foreach ($WebService->result as $key => $value) {
            Fx_mailer::copyTrade($value->Email);
            print_r(json_encode($value));
            $this->Logs_model->insertforlogCopyTrade($value->Email,json_encode($value));
            echo "<BR>";
            if(sleep(2)!=0)
            {
                echo "sleep failed script terminating"; 
                break;
            }
            flush();
            ob_flush();
        }
    }







}