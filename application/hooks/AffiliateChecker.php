<?php
class AffiliateChecker
{
    function checker() {
        $ci =& get_instance();

        if(isset($_GET['id'])){

            $getAffiliateCode = trim(strtok($_GET['id'], '?'));

            $click = array(
                'affiliate_code' => $getAffiliateCode,
                'ip' =>$ci->input->ip_address(),
                'date' => date('Y-m-d H:i:s', strtotime(FXPP::getCurrentDateTime()))
            );
            $ci->load->model('general_model');
            $ci->general_model->insert('click', $click);

            $cookie = array(
                'name'   => 'affiliate',
                'value'  => $getAffiliateCode,
                'expire' => time() + (3600 * 24),
                'domain' => '.forexmart.com',
                'secure' => true,
                'path'   => '/',
                'prefix' => '',
                'httponly' => true,
            );
            $cookie2 = array(
                'name'   => 'account_type',
                'value'  => $ci->input->get('g'),
                'expire' => time() + (3600 * 24),
                'domain' => '.forexmart.com',
                'secure' => false,
                'path'   => '/',
                'prefix' => '',
                'httponly' => true,
            );
//            set_cookie($cookie);

            $ci->load->helper('cookie');
            $ci->input->set_cookie($cookie,true);
            $ci->input->set_cookie($cookie2,true);

            $getCookieLogs = $ci->input->cookie('forexmart_affiliate_logs');
            $getCookie = $ci->input->cookie('forexmart_affiliate');

            if(isset($getCookieLogs) AND !empty($getCookieLogs)){
                if($getCookie != $getAffiliateCode){
                    $affiliate_logs =  $getCookieLogs.'-'.$getAffiliateCode;
                }else{
                    $affiliate_logs = $getCookieLogs;
                }
            }else{
                $affiliate_logs = $getAffiliateCode;
            }

            $cookie = array(
                'name'   => 'affiliate_logs',
                'value'  => $affiliate_logs,
                'expire' => time() + (3600 * 24),
                'domain' => '.forexmart.com',
                'secure' => true,
                'path'   => '/',
                'prefix' => '',
                'httponly' => true,
            );

            $ci->load->helper('cookie');
            $ci->input->set_cookie($cookie,true);

//            echo "<script type='text/javascript'>\n";
//            echo "//<![CDATA[\n";
//            echo "console.log(", json_encode($_GET['id']), ");\n";
//            echo "//]]>\n";
//            echo "</script>";
        }
    }
}