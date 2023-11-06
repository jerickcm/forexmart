<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phl extends MY_Controller {
	public function __construct(){
		parent::__construct();

	}
	public function Test2(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
		echo 'testpage';
		$this->load->library('Minibonus');
//		Minibonus::mark_for_non_ndb2();
//		Minibonus::testcond2(15);
		Minibonus::callcredit();
		echo FXPP::getServerTime();
	}
	public function Test(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
		$date = new DateTime(FXPP::getServerTime());
		$date_db_last_update = new DateTime('2014-10-05 13:40:13');
		$diff = $date->diff($date_db_last_update);

		if (intval((($diff->format('%y') * 12) + $diff->format('%m')))>=12){
			echo 'trigger 1 year';
		}else{
			echo 'not 1 year';
		}

	}
	public function index(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
		echo 'testpage';

	}

    public function index2(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo CI_VERSION;
    }

    public function info(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        phpinfo();

    }

    public function postsize(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo ini_get('post_max_size');
    }
    public function change2(){
        $str='قابل ب';
        $str='asdadsad';
        if (preg_match(Cyrillic::register_page(), $str)) {
            echo $str;
            echo 'false';
        }else{
            echo $str;
            echo 'true';
        }
    }
    public function change(){

        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo Cyrillic::register_page();
    }


    public function SESPIN(){

        echo $_SESSION['FXPP6635'];
        if(isset($_SESSION['FXPP6635']) and $_SESSION['FXPP6635']=='GJAOV'){
            echo 11111;
        }else{
            echo 22222;
        }
    }
    public function SESPIN2(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo 'session is unsetted'.$_SESSION['FXPP6635'];
        unset($_SESSION['FXPP6635']);
        echo $_SESSION['FXPP6635'];
    }

    public function updateL(){

        if(!IPLOC::Office_and_Vpn()){
            redirect('');

        }
        die();
        /* task FXPP-6774 */
        /* https://jira1001.atlassian.net/browse/FXPP-6774 */

        $config = array(
            'server' => 'live_new'
        );

        $mtas = $this->general_model->showssingle2($table='mt_accounts_set',$field='account_number',$id=203387,$select='user_id,account_number,amount,mt_currency_base,leverage,registration_leverage');

//        var_dump($mtas);die();
        $info = array(
            'iLogin' => $mtas['account_number'],
            'iLeverage' => 5000
        );

        $WebService = new WebService($config);
        $WebService->open_ChangeAccountLeverage( $info );
        if( $WebService->request_status === 'RET_OK' ) {
            $data['lev_ratio']=array(
                'leverage'=>'1:5000',
            );
           $this->general_model->updatemy('mt_accounts_set', 'user_id', $mtas['user_id'], $data['lev_ratio']);

           echo 'update success';

        }


    }

    public function resend_partner(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');

        }
        die();

        $this->load->library('fx_mailer');

        $partnership_affiliate = array(
            'partner_id' => 164700,
            'affiliate_code' => 'XYEBN'
        );

        $partnership_authdetails = array(
            'email' => 'tutankhomon-ra@mail.ru',
//            'email' => 'trowabarton00005@gmail.com',
            'password' => '1AJpcCU',
            'fullname' => 'Бубилич Александр Николаевич',
            'phone_password' => 'AfrFbl3',
            'account_number'=>'236836',
            'trader_password' =>'1AJpcCU'
        );
        $sentemail =  $this->fx_mailer->PRS($partnership_authdetails, $partnership_affiliate);
        if($sentemail){
                echo 'email is sent';
        }else{
            echo 'email is not sent';
        }

    }
    public function recreate_cpa_missing_account(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        die();
        $webservice_config = array(
            'server' => 'live_new'
        );
        $phone_password =  FXPP::RandomizeCharacter(7);
        $service_data = array(
            'address' => '',
            'city' => '',
            'country' => 'Russian Federation',
            'email' => 'info@option-forex-bonus.ru',
            'group' => 'PaRU',
            'leverage' => '',
            'name' => 'Татарников Андрей Андреевич',
            'phone_number' => '+79025119972',
            'state' => '',
            'zip_code' => '',
            'phone_password' => $phone_password
        );

        $WebService2 = new WebService($webservice_config);
        $WebService2->open_account_standard($service_data);
        if( $WebService2->request_status === 'RET_OK' ) {
            $reference_number2 = $WebService2->get_result('LogIn');
            $partnership_details = array(
                'reference_num' => $reference_number2,
                'phone_number' =>  '+79025119972',
                'target_country' => 'RU',
                'message' => '',
                'websites' => '["option-forex-bonus.ru"]',
                'type_of_partnership' => 'cpa',
                'status_type' => 0,
                'company_name' => '',
                'registration_number' => '',
                'date_of_incorporation' => '0000-00-00 00:00:00',
                'partner_id' => 168974,
                'currency' => 'RUB',
                'phone_password' => $phone_password,
                'reference_subnum' => 239306,
                'prog_comment'=>'manually created for fxpp-FXPP-7131'
            );
            $this->general_model->insert('partnership', $partnership_details);
            echo 'API SUCCESS';
        }else{
            echo 'API error';
        }

    }
    public function burl(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
    }
    public function logvisitor(){
        die();
        /*registration_log*/
//        $this->load->model('Logs_model');
//        $data['log']=array(
//            'ip'=>$_SERVER['REMOTE_ADDR']
//        );
//
//        $LogsId = $this->Logs_model->insert_log($table="visitor_log",$data['log']);
        /*registration_log*/


        $this->lang->load('AboutUs');
        $data['data'] = '';
        //$data['data']['metadata_description'] = lang('x_abt_us_dsc');
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = lang('x_=abt_us_kew');
        $this->template->title(lang('x_abt_us_tit'))
            ->set_layout('external/main')
            ->build('external_AboutUs', $data['data']);
    }
    public function tagndb(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        /*tag ndb with morethan 2 ndb accounts*/


        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->taggingDoubeNDB();
//        $m14users= FXPP::CI()->t_m->taggingDoubeNDB_test();
//        var_dump($m14users);
        foreach($m14users as $key => $value){
            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2017/03/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => '2017-02-01T00:00:01',
                'to' => '2017-03-16T00:00:01'
            );
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $count=0;
                    $databonus=array();
                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS' and $object->Comment=='FOREXMART NO DEPOSIT BONUS'){
                            echo 'account number:'.$value['account_number'].'ticket:'.$object->Ticket.'<br>';
                             $databonus[$count]=array(
                                  'account_number'=>$value['account_number'],
                                  'ticket'=>$object->Ticket,
                                  'email'=>$value['email'],
                                  'amount'=>$object->Amount,
                                  'currency'=>$value['mt_currency_base'],
                                  'comment'=>$object->Comment,
                                  'apistamp'=>$object->Stamp
                             );
                            $count= $count+1;
                        }

                    }
                    if($count>1){
                        echo $count;
                        foreach($databonus as $key => $value){
                            var_dump($value);
                            echo '<br/>';
                            $this->general_model->insertmy($table='creditedndblog', $data=$value);
//                            $this->general_model->insertmy('',$value);
//                            FXPP::CI()->l_m->insertforlogndb($value);
                        }

//                        var_dump($databonus);echo $count;
//                        FXPP::CI()->l_m->insertbatch($databonus);
                    }
                    break;
                default:
                    echo 'not ok';
            }
        }

    }
    public function updatedatabase(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        /*tag ndb with morethan 2 ndb accounts*/


        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->taggingDoubeNDB();
        //        $m14users= FXPP::CI()->t_m->taggingDoubeNDB_test();
        //        var_dump($m14users);
        foreach($m14users as $key => $value){
            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2017/03/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => '2017-03-13T00:00:01',
                'to' => '2017-03-17T00:00:01'
            );
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $count=0;
                    $databonus = array();
                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS' and $object->Comment=='FOREXMART NO DEPOSIT BONUS'){
                            $mtas=$this->general_model->showssingle($table = "mt_accounts_set", "account_number", $value['account_number'] , "user_id", '');
                            echo 'account number:'.$value['account_number'].'ticket:'.$object->Ticket.'userid :'.$mtas['user_id'].'<br>';
//                            $mtas=$this->general_model->showssingle($table = "mt_accounts_set", "account_number", $value['account_number'] , "user_id", '');
                            $this->general_model->updatemy($table='users', $field='id', $id=$mtas['user_id'], $data=array('nodepositbonus'=>1,'ndbtag'=>1));
                        }
                    }
                    break;
                default:

            }
        }
    }

    public function tagndbfinal(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        /*tag ndb with morethan 2 ndb accounts*/
            die();

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->taggingDoubeNDB();
        //        $m14users= FXPP::CI()->t_m->taggingDoubeNDB_test();
        //        var_dump($m14users);
        foreach($m14users as $key => $value){
            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2017/03/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            $account_info = array(
                'iLogin' => $value['account_number'],
                'from' => '2017-03-01T00:00:01',
                'to' => '2017-03-21T00:00:01'
            );
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $count=0;
                    $databonus=array();
                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS' and $object->Comment=='FOREXMART NO DEPOSIT BONUS'){
                            $count = $count+1;
                        }
                        if ($object->FundType=='BONUS'){
                            echo 'account number:'.$value['account_number'].'ticket:'.$object->Ticket.' Comment:'.$object->Comment.'<br>';
                            $databonus[$count]=array(
                                'account_number'=>$value['account_number'],
                                'ticket'=>$object->Ticket,
                                'email'=>$value['email'],
                                'amount'=>$object->Amount,
                                'currency'=>$value['mt_currency_base'],
                                'comment'=>$object->Comment,
                                'apistamp'=>$object->Stamp
                            );
                        }
                    }
                    if($count>1){
                        echo $count;
                        foreach($databonus as $key => $value){
                            $this->general_model->insertmy($table='creditedndblog_finallog_m20', $data=$value);
                        }

                    }
                    break;
                default:

            };
        }

    }
    public function check_ndb_account(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        die();
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->taggingDoubeNDB2();
        foreach($m14users as $key => $value){
            $webservice_config = array('server' => 'live_new');
            $WebService2 = new WebService($webservice_config);
            $WebService2->RequestAccountFunds( $accountnumber=$value['account_number']);
            $Withrawable_BonusFund = $WebService2->get_result('Withrawable_BonusFund');
            if($Withrawable_BonusFund!=0){
                $value = array(
                    'account_number' => $accountnumber,
                             'email' => $value['email'],
                             'bonus' => $Withrawable_BonusFund,
                          'currency' => $value['mt_currency_base']
                );
                $this->general_model->insertmy($table='logfxpp_7528', $data=$value);
            }
        }
    }
    public function getandupdateleverage(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->get_ndbm1317();
        foreach($m14users as $key => $value){

            $webservice_config = array('server' => 'live_new');
            $WebServiceAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $accountnumber=$value['account_number']);
            $WebServiceAD->open_RequestAccountDetails($account_info);

            if ($WebServiceAD->request_status === 'RET_OK') {
                $group = $WebServiceAD->get_result('Group');
                $leverage = $WebServiceAD->get_result('Leverage');
                $data = array(
                    'group'=>$group ,
                    'leverage'=>$leverage
                );
                $this->general_model->updatemy($table='logfxpp_7528', $field='account_number', $id=$accountnumber, $data);

            }



        }
    }

    public function tagisndb(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->get_ndbm1317();
        foreach($m14users as $key => $value){
            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2017/03/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            $account_info = array(
                'iLogin' => $accountnumber=$value['account_number'],
                'from' => '2017-03-01T00:00:01',
                'to' => '2017-03-21T00:00:01'
            );

            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $count=0;
                    $databonus=array();

                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS' and $object->Comment=='FOREXMART NO DEPOSIT BONUS'){
                            $count = $count+1;
                        }
                    }

                    if($count>0){
                        $data = array(
                            'is_ndb'=>1 ,
                        );
                        $this->general_model->updatemy($table='logfxpp_7528', $field='account_number', $id=$accountnumber, $data);
                    }
                    break;
            }

        }
    }
    public function getweekdif(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        // 5/16/2016 is may 16 2016 monday contest falls in date may 23 to 27 reference table contestmoneyfall.date_activated  id=1287
        $request=FXPP::week_difference($date1='5/23/2016', $date2= '3/21/2017');
        var_dump($request);
    }
    function datediffInWeeks($date1, $date2)
    {
//        if($date1 > $date2) return datediffInWeeks($date2, $date1);
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        $first = DateTime::createFromFormat('m/d/Y', $date1);
        $second = DateTime::createFromFormat('m/d/Y', $date2);
        return floor($first->diff($second)->days/7);
    }
    function Stime() {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo date("Y/m/d h:i:sa");
        echo '- - - - - -';
        date_default_timezone_set('UTC');
        echo date("Y/m/d h:i:sa");
    }

    function checkrecordsof () {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        $this->load->model('Task_model');

        $datatest = $this->Task_model->getThisWeekContestRegistrations();

        var_dump($datatest);

    }
    function testemalaccount () {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        die();
        $this->load->library('Contestaccounts');
        Contestaccounts::test();
    }
    function testemalaccountx () {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        die();
        $this->load->library('Contestaccounts');
        Contestaccounts::weeklyreminder();
    }

    function checkactivendbcredited () {
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        $m14users = FXPP::CI()->t_m->get_ndbmcredited();
        foreach($m14users as $key => $value){
            $webservice_config = array('server' => 'live_new');
            $WebServiceAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $accountnumber=$value['account_number']);
            $WebServiceAD->open_RequestAccountDetails($account_info);
            if ($WebServiceAD->request_status === 'RET_OK') {
                echo 'account number : '.$accountnumber.' active <br/>';
            }else{
                echo 'account number : '.$accountnumber.' not active <br/>';
            }
        }

    }

    public function taggingactiveaccounts(){

        if (!IPLOC::Office_and_Vpn()){die();}
        die();
        /* I need to tag active accounts , update group */
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        $m14users = FXPP::CI()->t_m->get_ndbmcredited_ofall();
        foreach($m14users as $key => $value){
            $webservice_config = array('server' => 'live_new');
            $WebServiceAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $accountnumber=$value['account_number']);
            $WebServiceAD->open_RequestAccountDetails($account_info);
            if ($WebServiceAD->request_status === 'RET_OK') {
                $group = $WebServiceAD->get_result('Group');
                $data = array(
                    'group'=>$group,
                    'check_inactivity'=>1
                );
                $this->general_model->updatemy('mt_accounts_set', 'account_number', $accountnumber, $data);
                echo 'account number : '.$accountnumber.' active <br/>';
            }else{
                $data = array(
                    'check_inactivity'=>2
                );
                $this->general_model->updatemy('mt_accounts_set', 'account_number', $accountnumber, $data);
                echo 'account number : '.$accountnumber.' not active <br/>';
            }
        }
    }

    public function getacquireddate(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        /*tag ndb with morethan 2 ndb accounts*/
        die();

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $m14users= FXPP::CI()->t_m->gettest();
        foreach($m14users as $key => $value){
            $data['from'] = DateTime::createFromFormat('Y/d/m', date('2015/03/5'));
            $data['to'] = DateTime::createFromFormat('Y/d/m H:i:s', date('Y/d/m').' 23:59:59');
            $account_info = array(
                'iLogin' => $accountnumber = $value['account_number'],
                'from' => '2015-03-01T00:00:01',
                'to' => '2017-03-30T00:00:01'
            );
            $webservice_config = array('server' => 'live_new');
            $WebService = new WebService($webservice_config);
            $WebService->open_RequestAccountFinanceRecordsByDate($account_info);
            switch($WebService->request_status){
                case 'RET_OK':
                    $tradatalist = (array) $WebService->get_result('FinanceRecords');
                    $count=0;
                    $databonus=array();
                    foreach ( $tradatalist['FinanceRecordData'] as $object){
                        if ($object->FundType=='BONUS' and $object->Comment=='FOREXMART NO DEPOSIT BONUS'){
                            $data = array(
                                'ndb_date'=>$object->Stamp
                            );
                            $this->general_model->updatemy('mt_accounts_set', 'account_number', $accountnumber, $data);
                        }
                    }
                    break;
                default:

            };
        }

    }

    public function testingemail(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        /*testing email*/
        $data=array(
            'Title' =>"test",
            'FullName' => "test",
            'Code' => 'Test',
            'Email' => 'trowabarton00005@gmail.com'

        );
        Fx_mailer::MoneyFallRegistrationCode($data);

    }

    function weeklyreminder() {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }


        $this->load->library('Fxpp_email');
        $email_data=array(
            'email' => 'trowabarton00005@gmail.com',
            'user' => 'inspectname'
        );
        $logs['is_sent'] = Fxpp_email::contest_reminder($email_data);
        if($logs['is_sent']){
            echo 'email sent';
        }else{
            echo 'email failed';
        }
    }
    public function test_week(){
        if (!IPLOC::Office_and_Vpn()){die();}
//        $this->load->library('Contestaccounts');
//        Contestaccounts::weeklyreminder();
        echo 'sunday time after 11pm'. DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d 22:59:59',strtotime("sunday last week")))->format('Y-m-d H:i:s');
        echo '<br/>';
        echo 'sunday time before 11pm'. DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d 23:00:00',strtotime("sunday this week")))->format('Y-m-d H:i:s');
    }

    public function countregs(){
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('General_model');
        $this->load->model('Task_model');
        $this->g_m=$this->General_model;
        $this->t_m=$this->Task_model;

        $count=$this->t_m->count_registrationclient_F_IP( $full_name='Rieza Ali Husein', $ip='112.215.172.180');
        var_dump($count);
        echo 'count registration is :'.$count['count'];
    }
    public function countregsP(){
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('General_model');
        $this->load->model('Task_model');
        $this->g_m=$this->General_model;
        $this->t_m=$this->Task_model;

        $count=$this->t_m->count_registrationpartner_F_IP( $full_name='Maria Clove', $ip='210.213.232.29');
        var_dump($count);

        echo 'count registration is :'.$count['count'];
    }
    public function statistics(){
        if (!IPLOC::Office_and_Vpn()){die();}

        $data['data']['metadata_description'] = lang('x_abt_us_dsc');
        $data['data']['metadata_keyword'] = lang('x_abt_us_kew');
        $this->template->title(lang('x_abt_us_tit'))
            ->append_metadata_css("
            <link rel='stylesheet' href='".$this->template->Css()."statistics/style.css'>
                 ")

//                       <link rel='stylesheet' href='".$this->template->Css()."statistics/morris.css'>
            ->append_metadata_js("

            ")
//                    <script src='".$this->template->Js()."statistics/morris.min.js'></script>
//                    <script src='".$this->template->Js()."statistics/morris-data.js'></script>
//                    <script src='".$this->template->Js()."statistics/raphael-min.js'></script>
            ->set_layout('external/main')
            ->build('statistics', $data['data']);
    }
    public function check20(){

        $this->load->model('Task_model');
        $data['statdata'] = $this->Task_model->getclickstat_period_month();
        var_dump($data['statdata']);
    }
    public function check2(){
        if (!IPLOC::Office_and_Vpn()){die();}
        $webservice_config = array(
            'server' => 'chart_single'
        );

        $WebServiceLast = new WebService($webservice_config);
        $datasym = array(
            'strSymbol' => 'AUDUSD'
        );
        $WebServiceLast->open_chart_GetSymbolLatestQuoteData($datasym);
        $WSL =  $WebServiceLast->result;
        var_dump($WSL->Timestamp);

        $data_in['to'] = DateTime::createFromFormat('Y-m-d\TH:i:s',$WSL->Timestamp);
        echo  'to '.$data_in['to']->format('Y-m-d\TH:i:s');


        $data_in['from'] = date("Y-m-d\TH:i:s", strtotime("-1 hour", strtotime($WSL->Timestamp)));
        echo 'from '.$data_in['from'];
//        $data_in['from'] = DateTime::createFromFormat('Y-m-d H:i:s',  $data_in['from'] );

//        $datax = array(
//            'strSymbol' => '',
//            'from' => $data_in['from']->format('Y-m-d\TH:i:s'),
//            'to' =>
//        );
//
//        var_dump($datax);
//        echo $WSL->Timestamp;
    }
    public function checkusers(){
        if (!IPLOC::Office_and_Vpn()){die();}

        $client_account = $this->general_model->showssingle_query(6191);
        var_dump($client_account);

    }
    public function tagagents(){
        if (!IPLOC::Office_and_Vpn()){die();}
        $this->load->view('_check');
//        $this->lang->load('_check');
//        $data['data'] = '';
//        //$data['data']['metadata_description'] = lang('x_abt_us_dsc');
//        $data['data']['metadata_description'] = '';
//        $data['data']['metadata_keyword'] = lang('x_=abt_us_kew');
//        $data['data']['menu_item']=array('l_a','l_g','r_a','l_k');
//        $this->template->title(lang('x_abt_us_tit'))
//            ->set_layout('external/main')
//            ->build('_check', $data['data']);
    }

    public function prog(){

      echo '&#8465;';
      echo '&#8712;';
      echo '&#8476;';
      echo '&#953;';
      echo '&#67;';
      echo '&#75;';
      echo ' ';
      echo '&#67';
      echo ' ';
      echo '&#77;'	;
      echo '&#65;'	;
      echo '&#8501;' ;
      echo '&#71;';
      echo '&#65;';
      echo '&#76;';
      echo '&#85;';
      echo '&#83;';

    }



    function migrate() {
        if (!IPLOC::Office_and_Vpn()){die();}
        die();

        $this->load->model('Task_model');
        $this->load->model('Oldaccount_model');
        /*AN 103630 user_id 9406*/

        $user_id = 9406;
        $get_ml = $this->Oldaccount_model->showsaccount($table='migration_log',$field='user_id',$id=$user_id,$select='*');
        if($get_ml){
            echo 'migration  already done<br/>';
        }else{

            /*mt_accounts_set*/
            $get_mtas = $this->Task_model->migrate($table='mt_accounts_set',$userid=$user_id);
            if($get_mtas){
                $save_mtas = $this->Oldaccount_model->insert_log($table='mt_accounts_set',$data=$get_mtas[0]);
                if ($save_mtas){
                    echo 'mtas done<br/>';
                    $a=1;
                    $this->general_model->rowdelete1($table='mt_accounts_set',$field='user_id',$id=$user_id);
                }else{
                    $a=0;
                }
            }

            /*contacts*/
            $get_contacts = $this->Task_model->migrate($table='contacts',$userid=$user_id);
            if($get_contacts){
                $save_contacts = $this->Oldaccount_model->insert_log($table='contacts',$data=$get_contacts[0]);
                if ($save_contacts){
                    echo 'contacts done<br/>';
                    $b=1;
                    $this->general_model->rowdelete1($table='contacts',$field='user_id',$id=$user_id);
                }else{
                    $b=0;

                }
            }

            /*trading_experience*/
            $get_te = $this->Task_model->migrate($table='trading_experience',$userid=$user_id);
            if($get_te){
                $save_te = $this->Oldaccount_model->insert_log($table='trading_experience',$data=$get_te[0]);
                if ($save_te){
                    echo 'trading_experience done<br/>';
                    $c=1;
                    $this->general_model->rowdelete1($table='trading_experience',$field='user_id',$id=$user_id);
                }else{
                    $c=0;
                }
            }

            /*user_profiles*/
            $get_up = $this->Task_model->migrate($table='user_profiles',$userid=$user_id);
            if($get_up){
                $save_up = $this->Oldaccount_model->insert_log($table='user_profiles',$data=$get_up[0]);
                if ($save_up){
                    $d=1;
                    echo 'user_profiles done<br/>';
                    $this->general_model->rowdelete1($table='user_profiles',$field='user_id',$id=$user_id);
                }else{
                    $d=0;
                }
            }
            /*users*/
            $get_usrs = $this->Task_model->migrate_users($table='users',$userid=$user_id);
            if($get_usrs){
                $save_usrs = $this->Oldaccount_model->insert_log($table='users',$data=$get_usrs[0]);
                if ($save_usrs){
                    $e=1;
                    echo 'users done<br/>';
                    $this->general_model->rowdelete1($table='users',$field='id',$id=$user_id);
                }else{
                    $e=0;
                }
            }


            /*insert mov account log*/
            $movedata=array(
                'user_id'=> $user_id,
                'mt_accounts_set'=> $a,
                'contacts'=>    $b,
                'trading_experience'=>  $c,
                'user_profiles'=>   $d,
                'users'=>   $e,
            );

            $mig_log = $this->Oldaccount_model->insert_log($table='migration_log',$data=$movedata);
            if($mig_log){
                echo 'migration done<br/>';
            }

        }


    }
    function migrate2($passuser_id) {
//        die();
        if (!IPLOC::Office_and_Vpn()){die();}

        $this->load->model('Task_model');
        $this->load->model('Oldaccount_model');
        /*AN 103630 user_id 9406*/

        $user_id = $passuser_id;
        $get_ml = $this->Oldaccount_model->showsaccount($table='migration_log',$field='user_id',$id=$user_id,$select='*');
        if($get_ml){
            echo 'migration  already done<br/>';
        }else{

            /*mt_accounts_set*/
            $get_mtas = $this->Task_model->migrate($table='mt_accounts_set',$userid=$user_id);
            if($get_mtas){
                $save_mtas = $this->Oldaccount_model->insert_log($table='mt_accounts_set',$data=$get_mtas[0]);
                if ($save_mtas){
                    echo 'mtas done<br/>';
                    $a=1;
                    $this->general_model->rowdelete1($table='mt_accounts_set',$field='user_id',$id=$user_id);
                }else{
                    $a=0;
                }
            }

            /*contacts*/
            $get_contacts = $this->Task_model->migrate($table='contacts',$userid=$user_id);
            if($get_contacts){
                $save_contacts = $this->Oldaccount_model->insert_log($table='contacts',$data=$get_contacts[0]);
                if ($save_contacts){
                    echo 'contacts done<br/>';
                    $b=1;
                    $this->general_model->rowdelete1($table='contacts',$field='user_id',$id=$user_id);
                }else{
                    $b=0;

                }
            }

            /*trading_experience*/
            $get_te = $this->Task_model->migrate($table='trading_experience',$userid=$user_id);
            if($get_te){
                $save_te = $this->Oldaccount_model->insert_log($table='trading_experience',$data=$get_te[0]);
                if ($save_te){
                    echo 'trading_experience done<br/>';
                    $c=1;
                    $this->general_model->rowdelete1($table='trading_experience',$field='user_id',$id=$user_id);
                }else{
                    $c=0;
                }
            }

            /*user_profiles*/
            $get_up = $this->Task_model->migrate($table='user_profiles',$userid=$user_id);
            if($get_up){
                $save_up = $this->Oldaccount_model->insert_log($table='user_profiles',$data=$get_up[0]);
                if ($save_up){
                    $d=1;
                    echo 'user_profiles done<br/>';
                    $this->general_model->rowdelete1($table='user_profiles',$field='user_id',$id=$user_id);
                }else{
                    $d=0;
                }
            }
            /*users*/
            $get_usrs = $this->Task_model->migrate_users($table='users',$userid=$user_id);
            if($get_usrs){
                $save_usrs = $this->Oldaccount_model->insert_log($table='users',$data=$get_usrs[0]);
                if ($save_usrs){
                    $e=1;
                    echo 'users done<br/>';
                    $this->general_model->rowdelete1($table='users',$field='id',$id=$user_id);
                }else{
                    $e=0;
                }
            }


            /*insert mov account log*/
            $movedata=array(
                'user_id'=> $user_id,
                'mt_accounts_set'=> $a,
                'contacts'=>    $b,
                'trading_experience'=>  $c,
                'user_profiles'=>   $d,
                'users'=>   $e,
            );

            $mig_log = $this->Oldaccount_model->insert_log($table='migration_log',$data=$movedata);
            if($mig_log){
                echo 'migration done<br/>';
            }

        }
        return;

    }
    function movetestaccounts() {
//        die();
        if (!IPLOC::Office_and_Vpn()){die();}
        $this->load->model('Task_model');
//        $data = $this->Task_model->ptestaccount();
//        $data = $this->Task_model->allinactiveaccounts();
//        $data = $this->Task_model->jomaritestaccount();
//        $data = $this->Task_model->songtestaccount();
        $data = $this->Task_model->jtestaccount();
//        var_dump($data);
//        die();
        foreach($data as $key => $value){
            $this->migrate2($value['user_id']);
        }
//        var_dump($data);
    }

    public function checkliveactivity(){
        if (!IPLOC::Office_and_Vpn()){die();}
        $this->load->view('_check');

    }
    public function checkliveactivity2(){
        if (!IPLOC::Office_and_Vpn()){die();}
        $this->load->view('_check');

    }
    function copytrade_e() {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
//        echo 'test';
//        die();



        $this->load->library('Fxpp_email');
        $email_data=array(
            'email' => 'trowabarton00005@gmail.com',
            'AN' => '140090',
            'MAN' => '230105'
        );
        $logs['is_sent'] = Fxpp_email::ct_subscribe($email_data);
        $logs['is_sent'] = Fxpp_email::ct_unsubscribe($email_data);
        echo 'test';

    }
    function copytrade_e2() {

        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo 'test2';
        die();
    }
    public function testxx() {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo date( "Y-m-d 00:00:00",strtotime( "-4 month", strtotime('now')));
        echo '<br/>';
        echo date( "Y-m-d 23:59:59",strtotime( "-4 month", strtotime('now') ));
        echo '<br/>';
        echo date( "Y-m-d 00:00:00",strtotime( "-4 months", strtotime('now')));
        echo '<br/>';
        echo date( "Y-m-d 23:59:59",strtotime( "-4 months", strtotime('now') ));
        echo '<br/>';
        echo 'hi';
        $data['from'] = date('Y-m-d 00:00:00',  date('Y/d/m',strtotime("-4 months")));
        echo $data['from'];

//        $data['x'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y/d/m',strtotime("-4 months")));
//        $data['x']->setTime(00,00,01);
//        echo 'hello';
//        echo $data['x']->format('Y-m-d H:i:s');
//        echo $data['x']->format('Y-m-d\TH:i:s');


        $data['from'] = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("-4 months")));
        $data['from']->setTime(00,00,01);
        echo  $data['from']->format('Y-m-d\TH:i:s');
    }
    public function testx() {
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        $this->load->model('Minifc_model');
        $data= $this->Minifc_model->test();
        var_dump($data);
    }
    public function stage()
    {
        // session_write_close(); // developing a website with heavy AJAX usage
        $nlanguage = FXPP::html_url();
        $user_country = FXPP::getUserCountryCode();
        $this->lang->load('home');
        $this->lang->load('moneyfall');
        $this->lang->load('contest');
        $this->load->model('account_model');
        $this->load->model('news_model');
        $this->lang->load('Location');

        if(in_array($user_country, array('US', 'KP', 'MM', 'SD', 'SY'))){
            $data['unavailable'] = true;
        }else{
            $data['unavailable'] = false;
        }

        //        if(IPLoc::Office()){
        //Contest Monitoring
        $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
        $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
        $contest_data = $this->account_model->getContestWinnersLimit( $start_date, $end_date, 10 );
        if($contest_data){
            $rank = 0;
            $prev_value = 0;

            $start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
            $end_dates = date('Y-m-d 22:59:59', strtotime($start_dates . ' +4 days'));


            foreach($contest_data as $key => $value){
                if($prev_value <> $value['amount']){
                    $rank++;
                    $prev_value = $value['amount'];
                }
                // $contest_data[$key]['country_name'] = $this->g_m->getCountries($value['country']);
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
        $data['rankings'] = $contest_data;

        /* Get Latest News List */
        $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, $nlanguage);
        if(count($latest_news) > 0){
            $top_latest_news = $latest_news[0];
            if(!empty($top_latest_news['publisher_image'])) {
                if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
            }else{
                $top_latest_news['publisher_image'] = 'avatar.png';
            }
            unset($latest_news[0]);
        }else{
            $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, 'EN');
            if(count($latest_news) > 0){
                $top_latest_news = $latest_news[0];
                if(!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
                unset($latest_news[0]);
            }else{
                $top_latest_news = array();
            }
        }

        $top_news_images = $this->news_model->getNewsImagesByNewsId($top_latest_news['id']);

        $data['latest_news'] = $latest_news;
        $data['top_latest_news'] = $top_latest_news;
        $data['top_news_images'] = $top_news_images;
        $data['nlanguage'] = $nlanguage;
        //        }

        $sysmbolsData = FXPP::generateQuotesRow();
        $data['quotes'] = $sysmbolsData;
        // $data['metadata_description'] = lang('x_hom_dsc');
        $data['metadata_description'] = '';
        $data['metadata_keyword'] = lang('x_hom_kew');
        //        if(IPLoc::Office()){
        $css_files = "
                       <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400|Playball' rel='stylesheet' type='text/css'>
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."awardarea.css'>
                 ";
        //        }else{
        //            $css_files = "
        //                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
        //                       <link rel='stylesheet' href='".$this->template->Css()."home/mainpagecustom.css'>
        //                 ";
        //        }

        $this->template->title(lang('x_hom_tit'))
            ->append_metadata_css($css_files)
            ->append_metadata_js('
                     <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
                     <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.touchSwipe.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.simpleslider.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/custom.js" type="text/javascript"></script>
                ')
            ->set_layout('external/main')
            ->build('home_lq', $data);


        //        redirect();
    }

    public function change_contestbonus_leverage(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $webservice_config = array('server' => 'live_new');

        $gcpba= FXPP::CI()->t_m->get_contestprize_bonusaccounts();

//        var_dump($gcpba);
//        die();

        foreach($gcpba as $key => $value){

            $WebServiceAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $accountnumber=$value['account_number']);
            $WebServiceAD->open_RequestAccountDetails($account_info);

            echo  $value['account_number'].' ';
            if ($WebServiceAD->request_status === 'RET_OK') {

                $leverage = $WebServiceAD->get_result('Leverage');
                echo $leverage;
                if ($leverage > 50){
                    $info = array(
                        'iLogin' => $accountnumber,
                        'iLeverage' => 50
                    );
                    $WS_CL = new WebService($webservice_config);
                    $WS_CL->open_ChangeAccountLeverage( $info );
                    if( $WS_CL->request_status === 'RET_OK' ) {
                        echo ' greater <br/>';
                        $data = array('leverage'=>'1:50');

                        $this->general_model->updatemy($table='mt_accounts_set', $field='account_number', $id=$accountnumber, $data);

                        $datainsert = array(
                            'account_number' => $accountnumber,
                            'leverage' => 50,
                            'past_leverage' => $leverage
                        );

                        $this->general_model->insertmy($table='test_updateshowfxbonusleverage', $datainsert);

                    }else{
                        echo 'error CL <br/>';
                    }

                }else{
                    echo ' less or exact <br/>';
                }


                $this->general_model->updatemyfirst($table='credit_prize', $field='account_number',$id=$accountnumber,$field2='comment', $id2='FOREXMART SHOWFX BONUS', $tag=array('tag'=>1));

            }else{
                echo ' error RAD <br/>';
                //Error

                $this->general_model->updatemyfirst($table='credit_prize', $field='account_number', $id=$accountnumber,$field2='comment', $id2='FOREXMART SHOWFX BONUS', $tag=array('tag'=>2));
            }
        }

    }

    public function update_showfxtag(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $usfxtag= FXPP::CI()->t_m->get_showfxusers();
//        var_dump($usfxtag);
        foreach($usfxtag as $key => $value){

            $data = array('is_showfxbonus'=>'1');
            $this->general_model->updatemy($table='users', $field='id', $id=$value['id'], $data);
        }



    }
    public function update_showfxtag_ex(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
//            echo 'hello';
//        die();
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;
        $usfxtagex2 = FXPP::CI()->t_m->get_showfxusers_exhibitions2();
//        var_dump($usfxtagex2);
//        die();
        foreach($usfxtagex2 as $key => $value){

            $data = array('is_showfxbonus'=>'1');
            $this->general_model->updatemy($table='users', $field='id', $id=$value['processed_users_id'], $data);

//            $mts = $this->general_model->showssingle2($table='mt_accounts_set',$field="account_number",$id=$value['processed_users_id_accountnumber'],$select="user_id",$order_by="");
//            var_dump($mts);
//            if($mts){
//                echo 'account number '.$value['processed_users_id_accountnumber'].' user_id '.$mts['user_id'].'<br/>';
//                echo $mts['user_id'];
//                $data=array('processed_users_id'=>$mts['user_id']);
//                FXPP::CI()->t_m->update_log($table='admin_log',$field='id',$id=$value['id'],$data);

//            }else{
//                echo 'not found<br/>';
//            }
        }

    }


    public function change_contestbonus_leverage_eb(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->model('Logs_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        FXPP::CI()->l_m=FXPP::CI()->Logs_model;

        $webservice_config = array('server' => 'live_new');

        $gsfxbe= FXPP::CI()->t_m->get_showfxusers_exhibitions2();

//        var_dump($gsfxbe);die();

        foreach($gsfxbe as $key => $value){

            $WebServiceAD = new WebService($webservice_config);
            $account_info = array('iLogin' => $accountnumber=$value['processed_users_id_accountnumber']);
            $WebServiceAD->open_RequestAccountDetails($account_info);

            echo  $value['account_number'].' ';
            if ($WebServiceAD->request_status === 'RET_OK') {

                $leverage = $WebServiceAD->get_result('Leverage');
                echo $leverage;
                if ($leverage > 50){
                    $info = array(
                        'iLogin' => $accountnumber,
                        'iLeverage' => 50
                    );
                    $WS_CL = new WebService($webservice_config);
                    $WS_CL->open_ChangeAccountLeverage( $info );
                    if( $WS_CL->request_status === 'RET_OK' ) {
                        echo ' greater <br/>';
                        $data = array('leverage'=>'1:50');

                        $this->general_model->updatemy($table='mt_accounts_set', $field='account_number', $id=$accountnumber, $data);

                        $datainsert = array(
                            'account_number' => $accountnumber,
                            'leverage' => 50,
                            'past_leverage' => $leverage
                        );

                        $this->general_model->insertmy($table='test_updateshowfxbonusleverage_exhibit', $datainsert);

                    }else{
                        echo 'error CL <br/>';
                    }

                }else{
                    echo ' less or exact <br/>';
                }


//                $this->general_model->updatemyfirst($table='credit_prize', $field='account_number',$id=$accountnumber,$field2='comment', $id2='FOREXMART SHOWFX BONUS', $tag=array('tag'=>1));

            }else{
                echo ' error RAD <br/>';
                //Error

//                $this->general_model->updatemyfirst($table='credit_prize', $field='account_number', $id=$accountnumber,$field2='comment', $id2='FOREXMART SHOWFX BONUS', $tag=array('tag'=>2));
            }
        }

    }
    public function get_accounts_march(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;

        $gle= FXPP::CI()->t_m->get_liveaccount_endofmarch2017();
//        var_dump($gle);die();
        foreach($gle as $key => $value){

            $webservice_config = array('server' => 'live_new');
            $account_info = array('iLogin' => $account_number=$value['account_number']);
            $WSAD = new WebService($webservice_config);
            $WSAD->open_RequestAccountDetails($account_info);
            $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
            $data['to']->setTime(23,59,59);
            $data['to']->setDate(2017, 3, 31); //yyyy month day
            $real=0;
            $bonus=0;
            if ($WSAD->request_status === 'RET_OK') {

                $account_info = array(
                    'iLogin' => $account_number,
                    'from' =>  $WSAD->get_result('RegDate'),
                    'to' => $data['to']->format('Y-m-d\TH:i:s')
                );

                $WSTH = new WebService($webservice_config);

                $WSTH->open_RequestAccountFinanceRecordsByDate($account_info);
                switch($WSTH->request_status){
                    case 'RET_OK':
                            $FinanceRecords = (array) $WSTH->get_result('FinanceRecords');
                            if($FinanceRecords){
                                foreach ( $FinanceRecords['FinanceRecordData'] as $object){
                                     if($object->FundType=='REAL'){
                                         $real = $real + $object->Amount;
                                     }else if($object->FundType=='BONUS'){
                                         $bonus = $bonus + $object->Amount;
                                     }
                                }
                            }
                        $active=1;
                    break;
                    default:
                        $active=2;
                }

                $datam=array(
                    'active' => $active,
                       'tag' => '1',
                      'real' => $real,
                      'real_transhistory' => $real,
                     'bonus' => $bonus
                );

                $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);
            }else{
                $datam=array(
                    'active'=>'2',
                    'tag'=>'2',
                );
                $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);

            }

        }

    }

    public function tx1(){
        die();
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
        $data['to']->setTime(23,59,59);
        $data['to']->setDate(2017, 3, 31); //yyyy month day

        echo $data['to']->format('Y-m-d\TH:i:s');

        echo '<br/>';

        $var=0;
        $var= floatval($var) + floatval(-20.5);
        echo $var;
    }

    public function tagmicro2(){

        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        $gle= FXPP::CI()->t_m->tagmicro();
        foreach($gle as $key => $value){
            $isMicro = FXPP::CI()->t_m->getMicroByAccountNumber($value['account_number']);
            if($isMicro){
                $datam = array(
                    'is_micro'=>'Yes',
                    'tag_micro'=>1
                );
                $this->general_model->updatemy('test_tally_march2017', 'account_number', $value['account_number'], $datam);
            }else{
                $datam = array(
                    'is_micro'=>'No',
                    'tag_micro'=>2
                );
                $this->general_model->updatemy('test_tally_march2017', 'account_number', $value['account_number'], $datam);
            }
        }
    }
    public function trades(){
        die();

        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;

        $gttr= FXPP::CI()->t_m->tagtrades();
        foreach($gttr as $key => $value){
            $webservice_config = array('server' => 'live_new');
            $account_info = array('iLogin' =>  $account_number=$value['account_number']);
            $WSAD = new WebService($webservice_config);
            $WSAD->open_RequestAccountDetails($account_info);
            if ($WSAD->request_status === 'RET_OK') {

                $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
                $data['to']->setTime(23,59,59);
                $data['to']->setDate(2017,3,31); //yyyy month day

                $account_info = array(
                    'iLogin' => $account_number,
                    'from' =>  $WSAD->get_result('RegDate'),
                    'to' => $data['to']->format('Y-m-d\TH:i:s')
                );

                $profit=0;

                $WSTH = new WebService($webservice_config);
                $WSTH->open_GetAccountTradesHistory($account_info);
                switch($WSTH->request_status){
                    case 'RET_OK':
                        $tradatalist = (array) $WSTH->get_result('TradeDataList');
                        if($tradatalist){

                            foreach ( $tradatalist['TradeData'] as $object){
                                $profit= floatval($profit) + floatval($object->Profit);

                            }

                        }
                        break;
                }

                $datam=array(
                    'real_trading' => $profit,
                    'tag_trades' => 1
                );

                $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);

            }else{
                $datam=array(
                    'tag_trades' => 2
                );

                $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);
                }
        }


    }

    public function commissions(){

        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->t_m=FXPP::CI()->Task_model;
        $tc = FXPP::CI()->t_m->tagcommission();
//        var_dump($tc); die();

        foreach($tc as $key => $value){
            $webservice_config = array('server' => 'live_new');
            $account_info = array('iLogin' =>  $account_number=$value['account_number']);
            $WSAD = new WebService($webservice_config);
            $WSAD->open_RequestAccountDetails($account_info);
            if ($WSAD->request_status === 'RET_OK') {
                echo 'good';
                $data['to'] = DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'));
                $data['to']->setTime(23,59,59);
                $data['to']->setDate(2017,3,31); //yyyy month day

                $account_info = array(
                    'iAgent' => $account_number,
                    'from' =>  $WSAD->get_result('RegDate'),
                    'to' => $data['to']->format('Y-m-d\TH:i:s')
                );

                $WS_GATCFAAR = new WebService($webservice_config);
                $WS_GATCFAAR->open_GetAgentTotalCommissionsFromAllAccounts($account_info);
                if ($WS_GATCFAAR->request_status === 'RET_OK') {

                    $datam=array(
                        'tag_commission' => 1,
                        'real_commission' => $WS_GATCFAAR->get_result('TotalAmount')
                    );

                    $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);
                }else{
                    $datam=array(
                        'tag_commission' => 3,
                        'real_commission' => 0
                    );

                    $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);
                }

            }else{
                $datam=array(
                    'tag_commission' => 2
                );

                $this->general_model->updatemy('test_tally_march2017', 'account_number', $account_number, $datam);

            }
        }


    }
    public function ta(){
        if(!IPLOC::Office_and_Vpn()){
            redirect('');
        }
        echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
//        redirect('http://www.forexmart.com/zh/register?id=URWKB');
    }
}
