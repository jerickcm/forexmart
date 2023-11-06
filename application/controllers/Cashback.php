<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cashback extends MY_Controller
{

    public function index()
    {
        //if(!IPLoc::Office()){redirect('');}
        $notChinese = (FXPP::html_url()=="zh") || (IPLoc::isChinaIP()) ?false:true;
            if ( (FXPP::isAllowedCashBack()) && ($notChinese) ) {

                $this->lang->load('whychooseus');
                $data['data']['request'] = 0;
                $data['data']['metadata_description'] = lang('wcu_dsc');
                $data['data']['metadata_keyword'] = lang('wcu_kew');
                $this->template->title("Cashback | ForexMart")
                    ->set_layout('external/main')
                    ->build('external_cash_back', $data['data']);
            } else if(!$notChinese){
                $this->template->title("Cashback | ForexMart")
                    ->set_layout('external/main')
                    ->build('Error_no_chinese','');
            }else{
                redirect('');
            }
    }

    public function cashback_request()
    {

        $notChinese = (FXPP::html_url()=="zh") || (IPLoc::isChinaIP()) ?false:true;
        $userCountry = $this->general_model->showssingle("user_profiles", "user_id", $this->session->userdata('user_id') , "country")['country'];
        $notChineseAcct = strtolower($userCountry)!=strtolower("CN")?true:false;
        if ((FXPP::isAllowedCashBack()) && ($notChinese) && ($notChineseAcct)) {
            $user_id = $this->session->userdata('user_id');

            $data['data']['request'] = 2; // already exist
            if (!$cashback = $this->general_model->showssingle("cashback_request", "user_id", $user_id, "user_id")) {


                if ($this->session->userdata('logged')) {

                    //  $ref_num = $this->general_model->showssingle("users_affiliate_code", "users_id", $user_id, "referral_affiliate_code");


                    if ($ref_num = $this->general_model->showssingle("users_affiliate_code", "users_id", $user_id, "referral_affiliate_code")) {

                        /* When an account is logged in, for as long as they don't have agents on that account yet, should be tagged as Cashback account when click on the "Join" button*/
                        if (strlen($ref_num['referral_affiliate_code']) == 0) {
                            $updated_data = array(
                                'referral_affiliate_code' => 'IHXBM',
                                'comment' => 'Cashback join'
                            );
                            $this->general_model->updatemy("users_affiliate_code", "users_id", $user_id, $updated_data);
                            $data['data']['request'] = 3; // Cashback join

                            /*End*/
                        } else {


                            $spacial_ref_code = array(
                                'dep30', 'JSMUI', 'HEVGG', 'JYUOR', 'KTVDM', 'YFURM', 'MJLHV', 'VYPHE', 'ZAGJU', 'KMSdep30', 's_hol_zar', 's_hol_ter', 's_hol_akc', 's_hol_par',
                                's_tep_for', 's_hol_opt', 'p_bezdep', 'p_bons', 'p_hol_zar', 'p_hol_ter', 'p_hol_opt', 'SEZPP', 'CJVMD', 'SJFTQ', 'VTJZV', 'MIRXG', 'EBLRV',
                                'HOEIZ', 'WMBZP', 'ODAZE', 'SSEOT', 'NKKLH', 'YQNKI', 'JLGNR'
                            );

                            if (in_array($ref_num['referral_affiliate_code'], $spacial_ref_code)) {

                                //                    $client_account = $this->general_model->showssingle("all_accounts", "user_id", $user_id, "account_number");
                                $client_account = $this->general_model->showssingle_query($user_id);
                                $partner_ref_code = $this->general_model->showssingle("partnership_affiliate_code", "affiliate_code", $ref_num['referral_affiliate_code'], "partner_id,affiliate_code");
                                //                    $ref_account_number = $this->general_model->showssingle("all_accounts", "user_id", $partner_ref_code['partner_id'], "account_number");
                                $ref_account_number = $this->general_model->showssingle_query($partner_ref_code['partner_id']);

                                $insertData = array(
                                    'client_account_number' => $client_account['account_number'],
                                    'ref_account_number' => $ref_account_number['account_number'],
                                    'created_date' => date('Y-m-d h:i:s'),
                                    'user_id' => $user_id
                                );

                                $this->general_model->insertmy("cashback_request", $insertData);
                                $data['data']['request'] = 1; // Cashback request


                            } else {
                                redirect(FXPP::loc_url('register?id=IHXBM'));
                            }
                        }
                    }

                } else {
                    redirect(FXPP::loc_url('register?id=IHXBM'));
                }

            }

            $this->lang->load('whychooseus');



            $data['data']['metadata_description'] = lang('wcu_dsc');
            $data['data']['metadata_keyword'] = lang('wcu_kew');
            $this->template->title("Cashback | ForexMart")
                ->set_layout('external/main')
                ->build('external_cash_back', $data['data']);
        } else if( (!$notChinese) || (!$notChineseAcct) ){
            $this->template->title("Cashback | ForexMart")
                ->set_layout('external/main')
                ->build('Error_no_chinese','');
        }else {
            redirect('cashback');
        }
    }

    public function cashback_request_no_chinese()
    {

        $notChinese = (FXPP::html_url()=="zh") || (IPLoc::isChinaIP()) ?false:true;
        $userCountry = $this->general_model->showssingle("user_profiles", "user_id", $this->session->userdata('user_id') , "country")['country'];
        $notChineseAcct = strtolower($userCountry)!=strtolower("CN")?true:false;
        if ((FXPP::isAllowedCashBack()) && ($notChinese) && ($notChineseAcct)) {
            $user_id = $this->session->userdata('user_id');

            $data['data']['request'] = 2; // already exist
            if (!$cashback = $this->general_model->showssingle("cashback_request", "user_id", $user_id, "user_id")) {


                if ($this->session->userdata('logged')) {

                    //  $ref_num = $this->general_model->showssingle("users_affiliate_code", "users_id", $user_id, "referral_affiliate_code");


                    if ($ref_num = $this->general_model->showssingle("users_affiliate_code", "users_id", $user_id, "referral_affiliate_code")) {

                        /* When an account is logged in, for as long as they don't have agents on that account yet, should be tagged as Cashback account when click on the "Join" button*/
                        if (strlen($ref_num['referral_affiliate_code']) == 0) {
                            $updated_data = array(
                                'referral_affiliate_code' => 'IHXBM',
                                'comment' => 'Cashback join'
                            );
                            $this->general_model->updatemy("users_affiliate_code", "users_id", $user_id, $updated_data);
                            $data['data']['request'] = 3; // Cashback join

                            /*End*/
                        } else {


                            $spacial_ref_code = array(
                                'dep30', 'JSMUI', 'HEVGG', 'JYUOR', 'KTVDM', 'YFURM', 'MJLHV', 'VYPHE', 'ZAGJU', 'KMSdep30', 's_hol_zar', 's_hol_ter', 's_hol_akc', 's_hol_par',
                                's_tep_for', 's_hol_opt', 'p_bezdep', 'p_bons', 'p_hol_zar', 'p_hol_ter', 'p_hol_opt', 'SEZPP', 'CJVMD', 'SJFTQ', 'VTJZV', 'MIRXG', 'EBLRV',
                                'HOEIZ', 'WMBZP', 'ODAZE', 'SSEOT', 'NKKLH', 'YQNKI', 'JLGNR'
                            );

                            if (in_array($ref_num['referral_affiliate_code'], $spacial_ref_code)) {

                                //                    $client_account = $this->general_model->showssingle("all_accounts", "user_id", $user_id, "account_number");
                                $client_account = $this->general_model->showssingle_query($user_id);
                                $partner_ref_code = $this->general_model->showssingle("partnership_affiliate_code", "affiliate_code", $ref_num['referral_affiliate_code'], "partner_id,affiliate_code");
                                //                    $ref_account_number = $this->general_model->showssingle("all_accounts", "user_id", $partner_ref_code['partner_id'], "account_number");
                                $ref_account_number = $this->general_model->showssingle_query($partner_ref_code['partner_id']);

                                $insertData = array(
                                    'client_account_number' => $client_account['account_number'],
                                    'ref_account_number' => $ref_account_number['account_number'],
                                    'created_date' => date('Y-m-d h:i:s'),
                                    'user_id' => $user_id
                                );

                                $this->general_model->insertmy("cashback_request", $insertData);
                                $data['data']['request'] = 1; // Cashback request


                            } else {
                                redirect(FXPP::loc_url('register?id=IHXBM'));
                            }
                        }
                    }

                } else{
                    redirect(FXPP::loc_url('register?id=IHXBM'));
                }

            }
            $this->lang->load('whychooseus');
            $data['data']['metadata_description'] = lang('wcu_dsc');
            $data['data']['metadata_keyword'] = lang('wcu_kew');
            $this->template->title("Cashback | ForexMart")
                ->set_layout('external/main')
                ->build('external_cash_back', $data['data']);

        } else if( (!$notChinese) || (!$notChineseAcct) ){
            $this->template->title("Cashback | ForexMart")
                ->set_layout('external/main')
                ->build('Error_no_chinese','');
        }else {
            redirect('cashback');
        }
    }
}
