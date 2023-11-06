<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contestaccounts {

    function __construct(){

    }

    public static function test(){

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->library('Fxpp_email');

        $email_data=array(
            'email' => 'trowabarton00005@gmail.com',
            'user' => 'inspectname'
        );
        $logs['is_sent'] = Fxpp_email::contest_reminder($email_data);
    }

    public static function weeklyreminder(){

        FXPP::CI()->load->model('Task_model');
        FXPP::CI()->load->library('Fxpp_email');
        $contestweekaccounts =  FXPP::CI()->Task_model->getThisWeekContestRegistrations();
        if($contestweekaccounts){
            foreach($contestweekaccounts as $key => $value ){
//                echo 'Email : '.$value['Email'] . ' Fullname : '.$value['FullName'].' Date Activated : '.$value['date_activated'].'<br/>';
                $email_data=array(
                    'email' => $value['Email'],
                    'user' => $value['FullName'],
                );
                $logs['is_sent'] = Fxpp_email::contest_reminder($email_data);
            }
        }

    }

}