
<link href="<?= $this->template->Css()?>searchlocation.css" rel="stylesheet">
<?php  $this->lang->load('Search'); ?>
<?php
$this->load->library('IPLoc', null);

$description="";
$domain_www =FXPP::www_url('');
$domain_my = FXPP::my_url('');
$uri='';

if (IPLoc::Office()) {
    $landing = array(
        lang('s_119-a').'
        <label class="display-n">'.
        lang('s_119-b').
        '</label>'
    ,lang('s_119-b')
    ,'none'
    ,'landing/no-deposit-bonus');
} else {
    $landing = array();
}


    $array = array(
        array(
         lang('s_1-a').'<span class="display-n">'.lang('s_1-b').'</span>'
        ,lang('s_1-b')
        ,'www'
        ,'home')
    ,array(
            lang('s_2-a').'<span class="display-n">'.lang('s_2-b').'</span>'
        ,lang('s_2-b')
        ,'www'
        ,'about-us')
    ,array(
          lang('s_3-a').'<span class="display-n">'.lang('s_3-b').'</span>'
        ,lang('s_3-b')
        ,'www'
        ,'company-news'),
        array(
            lang('s_4-a').'<span class="display-n">'.lang('s_4-b').'</span>'
        ,lang('s_4-b')
        ,'www'
        ,'why-choose-us')
    ,array(
            lang('s_5-a').'<span class="display-n">'.lang('s_5-b').'</span>'
        ,lang('s_5-b')
        ,'www'
        ,'deposit-withdraw-page')
    ,array(
            lang('s_6-a').'<span class="display-n">'.lang('s_6-b').'</span>'
        ,lang('s_6-b')
        ,'www'
        ,'licence-and-regulations')
    ,array(
            lang('s_7-a').'<span class="display-n">'.lang('s_7-b').'</span>'
        ,lang('s_7-b')
        ,'www'
        ,'account-verification')
    ,array(
            lang('s_8-a').'<span class="display-n">'.lang('s_8-b').'</span>'
        ,lang('s_8-b')
        ,'www'
        ,'las-palmas')
        //FOREX account types
    ,array(
            lang('s_9-a').'<span class="display-n">'.lang('s_9-b').'</span>'
        ,lang('s_9-b')
        ,'www'
        ,'account-type')
        //FOREX account types demo
    ,array(
            lang('s_10-a').'<span class="display-n">'.lang('s_10-b').'</span>'
        ,lang('s_10-b')
        ,'www'
        ,'demo-account')
        //FOREX account types  ForexMart Standard
    ,array(
            lang('s_11-a').'<span class="display-n">'.lang('s_11-b').'</span>'
        ,lang('s_11-b')
        ,'www'
        ,'live-account')
        //FOREX account types  ForexZero Spread
    ,array(
            lang('s_12-a').'<span class="display-n">'.lang('s_12-b').'</span>'
        ,lang('s_12-b')
        ,'www'
        ,'live-account')
        //FOREX Trading Platforms
    ,array(
            lang('s_13-a').'<span class="display-n">'.lang('s_13-b').'</span>'
        ,lang('s_13-b')
        ,'www'
        ,'metatrader4')
        //FOREX Instruments  forex
    ,array(
            lang('s_14-a').'<span class="display-n">'.lang('s_14-b').'</span>'
        ,lang('s_14-b')
        ,'www'
        ,'financial-instruments/forex')
        //FOREX Instruments  shares
    ,array(
            lang('s_15-a').'<span class="display-n">'.lang('s_15-b').'</span>'
        ,lang('s_15-b')
        ,'www'
        ,'financial-instruments/shares')
        //FOREX Instruments Spot Metals
    ,array(
            lang('s_17-a').'<span class="display-n">'.lang('s_17-b').'</span>'
        ,lang('s_17-b')
        ,'www'
        ,'bonuses')
        //BONUS AND OFFERS Welcome Bonus 30%
    ,array(
            lang('s_18-a').'<span class="display-n">'.lang('s_18-b').'</span>'
        ,lang('s_18-b')
        ,'www'
        ,'thirty-percent-bonus')

        //BONUS AND OFFERS No Deposit Bonus
    ,array(
            lang('s_19-a').'<span class="display-n">'.lang('s_19-b').'</span>'
        ,lang('s_19-b')
        ,'www'
        ,'no-deposit-bonus')

    ,array(
            lang('s_20-a').'<span class="display-n">'.lang('s_19-b').'</span>'
        ,lang('s_19-b')
        ,'www'
        ,'partnership/advantages')
    ,array(
            lang('s_21-a').'<span class="display-n">'.lang('s_21-b').'</span>'
        ,lang('s_21-b')
        ,'www'
        ,'affiliate-link')
    ,array(
            lang('s_22-a').'<span class="display-n">'.lang('s_22-b').'</span>'
        ,lang('s_22-b')
        ,'www'
        ,'commission-specification')

        //Partnership Types of Partnership
        //Friend Referral
    ,array(
            lang('s_23-a').'<span class="display-n">'.lang('s_23-b').'</span>'
        ,lang('s_23-b')
        ,'www'
        ,'partnership/friend-referrer')
        //Webmaster
    ,array(
            lang('s_24-a').'<span class="display-n">'.lang('s_24-b').'</span>'
        ,lang('s_24-b')
        ,'www'
        ,'partnership/webmaster')
        //Online Partner
    ,array(
            lang('s_25-a').'<span class="display-n">'.lang('s_25-b').'</span>'
        ,lang('s_25-b')
        ,'www'
        ,'partnership/online-partner')
        //Local online partner
    ,array(
            lang('s_26-a').'<span class="display-n">'.lang('s_26-b').'</span>'
        ,lang('s_26-b')
        ,'www'
        ,'partnership/local-online-partner')
        //Local office partner
    ,array(
            lang('s_27-a').'<span class="display-n">'.lang('s_27-b').'</span>'
        ,lang('s_27-b')
        ,'www'
        ,'partnership/local-office-partner')
        //Partnership Partnership registration
    ,array(
            lang('s_28-a').'<span class="display-n">'.lang('s_28-b').'</span>'
        ,lang('s_28-b')
        ,'www'
        ,'partnership/friend-referrer')
        //Partnership Materials
    ,array(
            lang('s_29-a').'<span class="display-n">'.lang('s_29-b').'</span>'
        ,lang('s_29-b')
        ,'www'
        ,'banners')
    ,array(
            lang('s_30-a').'<span class="display-n">'.lang('s_30-b').'</span>'
        ,lang('s_30-b')
        ,'www'
        ,'partnership/informers')
        //CONTEST
        //registration
    ,array(
            lang('s_31-a').'<span class="display-n">'.lang('s_31-b').'</span>'
        ,lang('s_31-b')
        ,'www'
        ,'forex-contests/money-fall')
        //CONTEST
        //Ratings
    ,array(
            lang('s_32-a').'<span class="display-n">'.lang('s_32-b').'</span>'
        ,lang('s_32-b')
        ,'www'
        ,'forex-contests/money-fall/ranking')
        //CONTEST
        //Winners
    ,array(
            lang('s_33-a').'<span class="display-n">'.lang('s_33-b').'</span>'
        ,lang('s_33-b')
        ,'www'
        ,'forex-contests/money-fall/winners')
        //CONTEST
        //Contest Rules
    ,array(
            lang('s_34-a').'<span class="display-n">'.lang('s_34-b').'</span>'
        ,lang('s_34-b')
        ,'www'
        ,'forex-contests/money-fall/contest-rules')
        //TOOLS
        //Free VPS Hosting
    ,array(
            lang('s_35-a').'<span class="display-n">'.lang('s_35-b').'</span>'
        ,lang('s_35-b')
        ,'www'
        ,'vps-hosting')
        //TOOLS
        //Forex Chart
    ,array(
            lang('s_36-a').'<span class="display-n">'.lang('s_36-b').'</span>'
        ,lang('s_36-b')
        ,'www'
        ,'forex-charts')

        //SUPPORT
        // Contact us
    ,array(
            lang('s_37-a').'<span class="display-n">'.lang('s_37-b').'</span>'
        ,lang('s_37-b')
        ,'www'
        ,'contact-us')
        //SUPPORT
        // FAQ
    ,array(
            lang('s_38-a').'<span class="display-n">'.lang('s_38-b').'</span>'
        ,lang('s_38-b')
        ,'www'
        ,'faq')
        //SUPPORT
        // Forex Glossary
    ,array(
            lang('s_39-a').'<span class="display-n">'.lang('s_39-b').'</span>'
        ,lang('s_39-b')
        ,'www'
        ,'')
        //SUPPORT
        // Legal Dcoumentation
    ,array(
            lang('s_40-a').'<span class="display-n">'.lang('s_40-b').'</span>'
        ,lang('s_40-b')
        ,'www'
        ,'legal-documentation')
    ,array(
            lang('s_41-a').'<span class="display-n">'.lang('s_41-b').'</span>'
        ,lang('s_41-b')
        ,'www'
        ,'live-account')
    ,array(
            lang('s_42-a').'<span class="display-n">'.lang('s_42-b').'</span>'
        ,lang('s_42-b')
        ,'www'
        ,'privacy-policy')
    ,array(
            lang('s_43-a').'<span class="display-n">'.lang('s_43-b').'</span>'
        ,lang('s_43-b')
        ,'www'
        ,'risk-disclosure')
    ,array(
            lang('s_44-a').'<span class="display-n">'.lang('s_44-b').'</span>'
        ,lang('s_44-b')
        ,'www'
        ,'terms-and-conditions')
    ,array(
            lang('s_46-a').'<span class="display-n">'.lang('s_46-b').'</span>'
        ,lang('s_46-b')
        ,'www'
        ,/*'complaint-handling-procedure'*/)
    ,array(
            lang('s_47-a').'<span class="display-n">'.lang('s_47-b').'</span>'
        ,lang('s_47-b')
        ,'www'
        ,/*'conflict-of-interest-policy'*/)
    ,array(
            lang('s_48-a').'<span class="display-n">'.lang('s_48-b').'</span>'
        ,lang('s_48-b')
        ,'www'
        ,/*'customer-categorisation'*/)
    ,array(
            lang('s_49-a').'<span class="display-n">'.lang('s_49-b').'</span>'
        ,lang('s_49-b')
        ,'www'
        ,/*'investor-compensation-fund'*/)
    ,array(
            lang('s_50-a').'<span class="display-n">'.lang('s_50-b').'</span>'
        ,lang('s_50-b')
        ,'www'
        ,/*'services'*/)
    ,array(
            lang('s_51-a').'<span class="display-n">'.lang('s_51-b').'</span>'
        ,lang('s_51-b')
        ,'www'
        ,'terms-and-conditions')

        //internal

    ,array(
            lang('s_52-a').'<span class="display-n">'.lang('s_52-b').'</span>'
        ,lang('s_52-b')
        ,$domain_my
        ,'accounts')
        //side nav My Account
    ,array(
            lang('s_53-a').'<span class="display-n">'.lang('s_53-b').'</span>'
        ,lang('s_53-b')
        ,$domain_my
        ,'accounts/register')
    ,array(
            lang('s_54-a').'<span class="display-n">'.lang('s_54-b').'</span>'
        ,lang('s_54-b')
        ,$domain_my
        ,'my-account/current-trades')
    ,array(
            lang('s_55-a'.'<span class="display-n">'.lang('s_55-b').'</span>'
        ,lang('s_55-b')
        ,$domain_my
        ,'my-account/current-trades')
    ,array(
            lang('s_56-a').'<span class="display-n">'.lang('s_56-b').'</span>'
        ,lang('s_56-b')
        ,$domain_my
        ,'my-account/forex-calculator')
        //side nav My Profile
    ,array(
            lang('s_57-a').'<span class="display-n">'.lang('s_57-b').'</span>'
        ,lang('s_57-b')
        ,$domain_my
        ,'profile/edit')
    ,array(
            lang('s_58-a').'<span class="display-n">'.lang('s_58-b').'</span>'
        ,lang('s_58-b')
        ,$domain_my
        ,'profile/change-password')
    ,array(
            lang('s_59-a').'<span class="display-n">'.lang('s_59-b').'</span>'
        ,lang('s_59-b')
        ,$domain_my
        ,'profile/upload-documents')
    ,array(
            lang('s_60-a').'<span class="display-n">'.lang('s_60-b').'</span>'
        ,lang('s_60-b')
        ,$domain_my
        ,'profile/platform-access')

        //side nav Finance

    ,array(
            lang('s_61-a').'<span class="display-n">'.lang('s_61-b').'</span>'
        ,lang('s_61-b')
        ,$domain_my
        ,'deposit')

    ,array(
            lang('s_62-a').'<span class="display-n">'.lang('s_62-b').'</span>'
        ,lang('s_62-b')
        ,$domain_my
        ,'withdraw')

    ,array(
            lang('s_63-a').'<span class="display-n">'.lang('s_63-b').'</span>'
        ,lang('s_63-b')
        ,$domain_my
        ,'transfer')

    ,array(
            lang('s_64-a').'<span class="display-n">'.lang('s_64-b').'</span>'
        ,lang('s_64-b')
        ,$domain_my
        ,'transaction-history')

        //side nav Bonus

    ,array(
            lang('s_65-a').'<span class="display-n">'.lang('s_65-b').'</span>'
        ,lang('s_65-b')
        ,$domain_my
        ,'bonus/bonuses')
    ,array(
            lang('s_66-a').'<span class="display-n">'.lang('s_66-b').'</span>'
        ,lang('s_66-b')
        ,$domain_my
        ,'bonus/bonuses'),

        //side nav Partnertship
        array(
            lang('s_67-a').'<span class="display-n">'.lang('s_67-b').'</span>'
        ,lang('s_67-b')
        ,$domain_my
        ,'partnership/commission')
    ,array(
            lang('s_68-a').'<span class="display-n">'.lang('s_68-b').'</span>'
        ,lang('s_68-b')
        ,$domain_my
        ,'partnership/clicks')
    ,array(
            lang('s_69-a').'<span class="display-n">'.lang('s_69-b').'</span>'
        ,lang('s_69-b')
        ,$domain_my
        ,'withdraw')
    ,array(
            lang('s_70-a').'<span class="display-n">'.lang('s_70-b').'</span>'
        ,lang('s_70-b')
        ,$domain_my
        ,'partnership/referrals')
    ,array(
            lang('s_71-a').'<span class="display-n">'.lang('s_71-b').'</span>'
        ,lang('s_71-b')
        ,'www'
        ,'las-juva')
    ,array(
            lang('s_72-a').'<span class="display-n">'.lang('s_72-b').'</span>'
        ,lang('s_72-b')
        ,'www'
        ,'deposit-insurance')
    ,array(
            lang('s_73-a').'<span class="display-n">'.lang('s_73-b').'</span>'
        ,lang('s_73-b')
        ,'www'
        ,'awards')
    ,array(
            lang('s_74-a').'<span class="display-n">'.lang('s_74-b').'</span>'
        ,lang('s_74-b')
        ,'www'
        ,'account-type')
    ,array(
            lang('s_75-a').'<span class="display-n">'.lang('s_75-b').'</span>'
        ,lang('s_75-b')
        ,'www'
        ,'tiket-raffle')
    ,array(
            lang('s_76-a').'<span class="display-n">'.lang('s_76-b').'</span>'
        ,lang('s_76-b')
        ,'www'
        ,'partnership/cpa')
    ,array(
            lang('s_77-a').'<span class="display-n">'.lang('s_77-b').'</span>'
        ,lang('s_77-b')
        ,'www'
        ,'logos')
    ,array(
            lang('s_78-a').'<span class="display-n">'.lang('s_78-b').'</span>'
        ,lang('s_78-b')
        ,'www'
        ,'currency-conversion')
    ,array(
            lang('s_79-a').'<span class="display-n">'.lang('s_79-b').'</span>'
        ,lang('s_79-b')
        ,'www'
        ,'forex-calculator')
    ,array(
            lang('s_80-a').'<span class="display-n">'.lang('s_80-b').'</span>'
        ,lang('s_80-b')
        ,'www'
        ,'how-to-get-started')
    ,array(
            lang('s_82-a').'<span class="display-n">'.lang('s_82-b').'</span>'
        ,lang('s_82-b')
        ,$domain_my
        ,'client/signin')
    ,array(
            lang('s_83-a').'<span class="display-n">'.lang('s_83-b').'</span>'
        ,lang('s_83-b')
        ,$domain_my
        ,'partner/signin')
    ,array(
            lang('s_83x-a').'<span class="display-n">'.lang('s_83x-b').'</span>'
        ,lang('s_83x-b')
        ,$domain_my
        ,'forgot-password')
    ,array(
            lang('s_84-a').'<span class="display-n">'.lang('s_84-b').'</span>'
        ,lang('s_84-b')
        ,$domain_my
        ,'profile/sms_security')
    ,array(
            lang('s_85-a').'<span class="display-n">'.lang('s_85-b').'</span>'
        ,lang('s_85-b')
        ,$domain_my
        ,'deposit/bank-transfer')
    ,array(
            lang('s_86-a').'<span class="display-n">'.lang('s_86-b').'</span>'
        ,lang('s_86-b')
        ,$domain_my
        ,'deposit/debit-credit-cards')
    ,array(
            lang('s_87-a').'<span class="display-n">'.lang('s_87-b').'</span>'
        ,lang('s_87-b')
        ,$domain_my
        ,'deposit/skrill')
    ,array(
            lang('s_88-a').'<span class="display-n">'.lang('s_88-b').'</span>'
        ,lang('s_88-b')
        ,$domain_my
        ,'deposit/neteller')
    ,array(
            lang('s_89-a').'<span class="display-n">'.lang('s_89-b').'</span>'
        ,lang('s_89-b')
        ,$domain_my
        ,'deposit/paxum')
    ,array(
            lang('s_89-a').'<span class="display-n">'.lang('s_89-b').'</span>'
        ,lang('s_89-b')
        ,$domain_my
        ,'deposit/webmoney')
    ,array(
            lang('s_90-a').'<span class="display-n">'.lang('s_90-b').'</span>'
        ,lang('s_90-b')
        ,$domain_my
        ,'deposit/paypal')
    ,array(
            lang('s_91-a').'<span class="display-n">'.lang('s_91-b').'</span>'
        ,lang('s_91-b')
        ,$domain_my
        ,'deposit/hipay')
    ,array(
            lang('s_92-a').'<span class="display-n">'.lang('s_92-b').'</span>'
        ,lang('s_92-b')
        ,$domain_my
        ,'deposit/payco')
    ,array(
            lang('s_93-a').'<span class="display-n">'.lang('s_93-b').'</span>'
        ,lang('s_93-b')
        ,$domain_my
        ,'deposit/sofort')

    ,array(
            lang('s_95-a').'<span class="display-n">'.lang('s_95-b').'</span>'
        ,lang('s_95-b')
        ,$domain_my
        ,'deposit/qiWi')

    ,array(
            lang('s_98-a').'<span class="display-n">'.lang('s_98-b').'</span>'
        ,lang('s_98-b')
        ,$domain_my
        ,'deposit/megaTransfer')
    ,array(
            lang('s_99-a').'<span class="display-n">'.lang('s_99-b').'</span>'
        ,lang('s_99-b')
        ,$domain_my
        ,'transfer')

    ,array(
            lang('s_103-a').'<span class="display-n">'.lang('s_103-b').'</span>'
        ,lang('s_103-b')
        ,$domain_my
        ,'mail-support/compose')
    ,array(
            lang('s_104-a').'<span class="display-n">'.lang('s_104-b').'</span>'
        ,lang('s_104-b')
        ,$domain_my
        ,'mail-support/my-mail')
    ,array(
            lang('s_105-a').'<span class="display-n">'.lang('s_105-b').'</span>'
        ,lang('s_105-b')
        ,$domain_my
        ,'rebate-system')
    ,array(
            lang('s_106-a').'<span class="display-n">'.lang('s_106-b').'</span>'
        ,lang('s_106-b')
        ,$domain_my
        ,'rebate-system/personal-rebate')
    ,array(
            lang('s_107-a').'<span class="display-n">'.lang('s_107-b').'</span>'
        ,lang('s_107-b')
        ,$domain_my
        ,'rebate-system/statistics')
    ,array(
            lang('s_108-a').'<span class="display-n">'.lang('s_108-b').'</span>'
        ,lang('s_108-b')
        ,$domain_my
        ,'withdraw/debit-credit-cards')
    ,array(
            lang('s_109-a').'<span class="display-n">'.lang('s_109-b').'</span>'
        ,lang('s_109-b')
        ,$domain_my
        ,'withdraw/skrill')
    ,array(
            lang('s_110-a').'<span class="display-n">'.lang('s_110-b').'</span>'
        ,lang('s_110-b')
        ,$domain_my
        ,'withdraw/neteller')
    ,array(
            lang('s_111-a').'<span class="display-n">'.lang('s_111-b').'</span>'
        ,lang('s_111-b')
        ,$domain_my
        ,'withdraw/paxum')

    ,array(
            lang('s_112-a').'<span class="display-n">'.lang('s_112-b').'</span>'
        ,lang('s_112-b')
        ,$domain_my
        ,'withdraw/paypal')
    ,array(
            lang('s_113-a').'<span class="display-n">'.lang('s_113-b').'</span>'
        ,lang('s_113-b')
        ,'www'
        ,'ecn')
    ,array(
            lang('s_114-a').'<span class="display-n">'.lang('s_114-b').'</span>'
        ,lang('s_114-b')
        ,'www'
        ,'rpj-racing')
    ,array(
            lang('s_115-a').'<span class="display-n">'.lang('s_115-b').'</span>'
        ,lang('s_115-b')
        ,'www'
        ,'analytical-reviews')
    ,array(
            lang('s_116-a').'<span class="display-n">'.lang('s_116-b').'</span>'
        ,lang('s_116-b')
        ,'www'
        ,'calendar')
    ,array(
            lang('s_117-a').'<span class="display-n">'.lang('s_117-b').'</span>'
        ,lang('s_117-b')
        ,'www'
        ,'HKM_Zvolen')
    ,array(
            lang('s_118-a').'<span class="display-n">'.lang('s_118-b').'</span>'
        ,lang('s_118-b')
        ,'www'
        ,'License')
    ,array(
            lang('s_120-a').'<span class="display-n">'.lang('s_120-b').'</span>'
        ,lang('s_120-b')
        ,'www'
        ,'Team')
    ,array(
            lang('s_121-a').'<span class="display-n">'.lang('s_121-b').'</span>'
        ,lang('s_121-b')
        ,'wt'
        ,'https://webtrader.forexmart.com/login')
    ,array(
            lang('s_122-a').'<span class="display-n">'.lang('s_122-b').'</span>'
        ,lang('s_122-b')
        ,'www'
        ,'chance-bonus')
    ,array(
            lang('s_123-a').'<span class="display-n">'.lang('s_123-b').'</span>'
        ,lang('s_123-b')
        ,'www'
        ,'metatrader4')
    ,array(
            lang('s_124-a').'<span class="display-n">'.lang('s_124-b').'</span>'
        ,lang('s_124-b')
        ,'www'
        ,'sponsorship')
    ,   $landing
    ));

// OLD code that is currently hidden
//
//$array = array(
//    //external
//    // ABOUT
//    array(
//        lang('s_1-a').'
//         <label class="display-n">'.
//        lang('s_1-b').
//        '</label>'
//    ,lang('s_1-b')
//    ,'www'
//    ,'home')
//,array(
//        lang('s_2-a').'
//        <label class="display-n">'.
//        lang('s_2-b').
//        '</label>'
//    ,lang('s_2-b')
//    ,'www'
//    ,'about-us')
//,array(
//        lang('s_3-a').'
//        <label class="display-n">'.
//        lang('s_3-b').
//        '</label>'
//    ,lang('s_3-b')
//    ,'www'
//    ,'company-news'),
//    array(
//        lang('s_4-a').'
//        <label class="display-n">'.
//        lang('s_4-b').
//        '</label>'
//    ,lang('s_4-b')
//    ,'www'
//    ,'why-choose-us')
//,array(
//        lang('s_5-a').'
//        <label class="display-n">'.
//        lang('s_5-b').
//        '</label>'
//    ,lang('s_5-b')
//    ,'www'
//    ,'deposit-withdraw-page')
//,array(
//        lang('s_6-a').'
//        <label class="display-n">'.
//        lang('s_6-b').
//        '</label>'
//    ,lang('s_6-b')
//    ,'www'
//    ,'licence-and-regulations')
//,array(
//        lang('s_7-a').'
//        <label class="display-n">'.
//        lang('s_7-b').
//        '</label>'
//    ,lang('s_7-b')
//    ,'www'
//    ,'account-verification')
//,array(
//        lang('s_8-a').'
//        <label class="display-n">'.
//        lang('s_8-b').
//        '</label>'
//    ,lang('s_8-b')
//    ,'www'
//    ,'las-palmas')
//    //FOREX account types
//,array(
//        lang('s_9-a').'
//        <label class="display-n">'.
//        lang('s_9-b').
//        '</label>'
//    ,lang('s_9-b')
//    ,'www'
//    ,'account-type')
//    //FOREX account types demo
//,array(
//        lang('s_10-a').'
//        <label class="display-n">'.
//        lang('s_10-b').
//        '</label>'
//    ,lang('s_10-b')
//    ,'www'
//    ,'demo-account')
//    //FOREX account types  ForexMart Standard
//,array(
//        lang('s_11-a').'
//        <label class="display-n">'.
//        lang('s_11-b').
//        '</label>'
//    ,lang('s_11-b')
//    ,'www'
//    ,'live-account')
//    //FOREX account types  ForexZero Spread
//,array(
//        lang('s_12-a').'
//        <label class="display-n">'.
//        lang('s_12-b').
//        '</label>'
//    ,lang('s_12-b')
//    ,'www'
//    ,'live-account')
//    //FOREX Trading Platforms
//,array(
//        lang('s_13-a').'
//        <label class="display-n">'.
//        lang('s_13-b').
//        '</label>'
//    ,lang('s_13-b')
//    ,'www'
//    ,'metatrader4')
//    //FOREX Instruments  forex
//,array(
//        lang('s_14-a').'
//        <label class="display-n">'.
//        lang('s_14-b').
//        '</label>'
//    ,lang('s_14-b')
//    ,'www'
//    ,'financial-instruments/forex')
//    //FOREX Instruments  shares
//,array(
//        lang('s_15-a').'
//        <label class="display-n">'.
//        lang('s_15-b').
//        '</label>'
//    ,lang('s_15-b')
//    ,'www'
//    ,'financial-instruments/shares')
//    //FOREX Instruments Spot Metals
////,array(
////        lang('s_16-a').'
////        <label class="display-n">'.
////        lang('s_16-b').
////        '</label>'
////    ,lang('s_16-b')
////    ,'www'
////   /* ,'financial-instruments/spots' */ )
////    //BONUS AND OFFERS
//,array(
//        lang('s_17-a').'
//        <label class="display-n">'.
//        lang('s_17-b').
//        '</label>'
//    ,lang('s_17-b')
//    ,'www'
//    ,'bonuses')
//    //BONUS AND OFFERS Welcome Bonus 30%
//,array(
//        lang('s_18-a').'
//        <label class="display-n">'.
//        lang('s_18-b').
//        '</label>'
//    ,lang('s_18-b')
//    ,'www'
//    ,'thirty-percent-bonus')
//
//    //BONUS AND OFFERS No Deposit Bonus
//,array(
//        lang('s_19-a').'
//        <label class="display-n">'.
//        lang('s_19-b').
//        '</label>'
//    ,lang('s_19-b')
//    ,'www'
//    ,'no-deposit-bonus')
//
//    //Partnership
//
//    //Partnership Affiliate Program
//,array(
//        lang('s_20-a').'
//        <label class="display-n">'.
//        lang('s_20-b').
//        '</label>'
//    ,lang('s_20-b')
//    ,'www'
//    ,'partnership/advantages')
//,array(
//        lang('s_21-a').'
//        <label class="display-n">'.
//        lang('s_21-b').
//        '</label>'
//    ,lang('s_21-b')
//    ,'www'
//    ,'affiliate-link')
//,array(
//        lang('s_22-a').'
//        <label class="display-n">'.
//        lang('s_22-b').
//        '</label>'
//    ,lang('s_22-b')
//    ,'www'
//    ,'commission-specification')
//
//    //Partnership Types of Partnership
//    //Friend Referral
//,array(
//        lang('s_23-a').'
//         <label class="display-n">'.
//        lang('s_23-b').
//        '</label>'
//    ,lang('s_23-b')
//    ,'www'
//    ,'partnership/friend-referrer')
//    //Webmaster
//,array(
//        lang('s_24-a').'
//         <label class="display-n">'.
//        lang('s_24-b').
//        '</label>'
//    ,lang('s_24-b')
//    ,'www'
//    ,'partnership/webmaster')
//    //Online Partner
//,array(
//        lang('s_25-a').'
//         <label class="display-n">'.
//        lang('s_25-b').
//        '</label>'
//    ,lang('s_25-b')
//    ,'www'
//    ,'partnership/online-partner')
//    //Local online partner
//,array(
//        lang('s_26-a').'
//         <label class="display-n">'.
//        lang('s_26-b').
//        '</label>'
//    ,lang('s_26-b')
//    ,'www'
//    ,'partnership/local-online-partner')
//    //Local office partner
//,array(
//        lang('s_27-a').'
//         <label class="display-n">'.
//        lang('s_27-b').
//        '</label>'
//    ,lang('s_27-b')
//    ,'www'
//    ,'partnership/local-office-partner')
//    //Partnership Partnership registration
//,array(
//        lang('s_28-a').'
//         <label class="display-n">'.
//        lang('s_28-b').
//        '</label>'
//    ,lang('s_28-b')
//    ,'www'
//    ,'partnership/friend-referrer')
//    //Partnership Materials
//,array(
//        lang('s_29-a').'
//         <label class="display-n">'.
//        lang('s_29-b').
//        '</label>'
//    ,lang('s_29-b')
//    ,'www'
//    ,'banners')
//,array(
//        lang('s_30-a').'
//         <label class="display-n">'.
//        lang('s_30-b').
//        '</label>'
//    ,lang('s_30-b')
//    ,'www'
//    ,'partnership/informers')
//    //CONTEST
//    //registration
//,array(
//        lang('s_31-a').'
//         <label class="display-n">'.
//        lang('s_31-b').
//        '</label>'
//    ,lang('s_31-b')
//    ,'www'
//    ,'forex-contests/money-fall')
//    //CONTEST
//    //Ratings
//,array(
//        lang('s_32-a').'
//         <label class="display-n">'.
//        lang('s_32-b').
//        '</label>'
//    ,lang('s_32-b')
//    ,'www'
//    ,'forex-contests/money-fall/ranking')
//    //CONTEST
//    //Winners
//,array(
//        lang('s_33-a').'
//         <label class="display-n">'.
//        lang('s_33-b').
//        '</label>'
//    ,lang('s_33-b')
//    ,'www'
//    ,'forex-contests/money-fall/winners')
//    //CONTEST
//    //Contest Rules
//,array(
//        lang('s_34-a').'
//         <label class="display-n">'.
//        lang('s_34-b').
//        '</label>'
//    ,lang('s_34-b')
//    ,'www'
//    ,'forex-contests/money-fall/contest-rules')
//    //TOOLS
//    //Free VPS Hosting
//,array(
//        lang('s_35-a').'
//         <label class="display-n">'.
//        lang('s_35-b').
//        '</label>'
//    ,lang('s_35-b')
//    ,'www'
//    ,'vps-hosting')
//    //TOOLS
//    //Forex Chart
//,array(
//        lang('s_36-a').'
//         <label class="display-n">'.
//        lang('s_36-b').
//        '</label>'
//    ,lang('s_36-b')
//    ,'www'
//    ,'forex-charts')
//
//    //SUPPORT
//    // Contact us
//,array(
//        lang('s_37-a').'
//         <label class="display-n">'.
//        lang('s_37-b').
//        '</label>'
//    ,lang('s_37-b')
//    ,'www'
//    ,'contact-us')
//    //SUPPORT
//    // FAQ
//,array(
//        lang('s_38-a').'
//         <label class="display-n">'.
//        lang('s_38-b').
//        '</label>'
//    ,lang('s_38-b')
//    ,'www'
//    ,'faq')
//    //SUPPORT
//    // Forex Glossary
//,array(
//        lang('s_39-a').'
//         <label class="display-n">'.
//        lang('s_39-b').
//        '</label>'
//    ,lang('s_39-b')
//    ,'www'
//    ,'')
//    //SUPPORT
//    // Legal Dcoumentation
//,array(
//        lang('s_40-a').'
//         <label class="display-n">'.
//        lang('s_40-b').
//        '</label>'
//    ,lang('s_40-b')
//    ,'www'
//    ,'legal-documentation')
//,array(
//        lang('s_41-a').'
//         <label class="display-n">'.
//        lang('s_41-b').
//        '</label>'
//    ,lang('s_41-b')
//    ,'www'
//    ,'live-account')
//,array(
//        lang('s_42-a').'
//         <label class="display-n">'.
//        lang('s_42-b').
//        '</label>'
//    ,lang('s_42-b')
//    ,'www'
//    ,'privacy-policy')
//,array(
//        lang('s_43-a').'
//         <label class="display-n">'.
//        lang('s_43-b').
//        '</label>'
//    ,lang('s_43-b')
//    ,'www'
//    ,'risk-disclosure')
//,array(
//        lang('s_44-a').'
//         <label class="display-n">'.
//        lang('s_44-b').
//        '</label>'
//    ,lang('s_44-b')
//    ,'www'
//    ,'terms-and-conditions')
////,array(
////        lang('s_45-a').'
////         <label class="display-n">'.
////        lang('s_45-b').
////        '</label>'
////    ,lang('s_45-b')
////    ,'www'
////    /* ,'best-execution-policy' */ )
//,array(
//        lang('s_46-a').'
//         <label class="display-n">'.
//        lang('s_46-b').
//        '</label>'
//    ,lang('s_46-b')
//    ,'www'
//    ,/*'complaint-handling-procedure'*/)
//,array(
//        lang('s_47-a').'
//         <label class="display-n">'.
//        lang('s_47-b').
//        '</label>'
//    ,lang('s_47-b')
//    ,'www'
//    ,/*'conflict-of-interest-policy'*/)
//,array(
//        lang('s_48-a').'
//         <label class="display-n">'.
//        lang('s_48-b').
//        '</label>'
//    ,lang('s_48-b')
//    ,'www'
//    ,/*'customer-categorisation'*/)
//,array(
//        lang('s_49-a').'
//         <label class="display-n">'.
//        lang('s_49-b').
//        '</label>'
//    ,lang('s_49-b')
//    ,'www'
//    ,/*'investor-compensation-fund'*/)
//,array(
//        lang('s_50-a').'
//         <label class="display-n">'.
//        lang('s_50-b').
//        '</label>'
//    ,lang('s_50-b')
//    ,'www'
//    ,/*'services'*/)
//,array(
//        lang('s_51-a').'
//         <label class="display-n">'.
//        lang('s_51-b').
//        '</label>'
//    ,lang('s_51-b')
//    ,'www'
//    ,'terms-and-conditions')
//
//    //internal
//
//,array(
//        lang('s_52-a').'
//         <label class="display-n">'.
//        lang('s_52-b').
//        '</label>'
//    ,lang('s_52-b')
//    ,$domain_my
//    ,'accounts')
//    //side nav My Account
//,array(
//        lang('s_53-a').'
//         <label class="display-n">'.
//        lang('s_53-b').
//        '</label>'
//    ,lang('s_53-b')
//    ,$domain_my
//    ,'accounts/register')
//,array(
//        lang('s_54-a').'
//         <label class="display-n">'.
//        lang('s_54-b').
//        '</label>'
//    ,lang('s_54-b')
//    ,$domain_my
//    ,'my-account/current-trades')
//,array(
//        lang('s_55-a').'
//         <label class="display-n">'.
//        lang('s_55-b').
//        '</label>'
//    ,lang('s_55-b')
//    ,$domain_my
//    ,'my-account/current-trades')
//,array(
//        lang('s_56-a').'
//         <label class="display-n">'.
//        lang('s_56-b').
//        '</label>'
//    ,lang('s_56-b')
//    ,$domain_my
//    ,'my-account/forex-calculator')
//    //side nav My Profile
//,array(
//        lang('s_57-a').'
//         <label class="display-n">'.
//        lang('s_57-b').
//        '</label>'
//    ,lang('s_57-b')
//    ,$domain_my
//    ,'profile/edit')
//,array(
//        lang('s_58-a').'
//         <label class="display-n">'.
//        lang('s_58-b').
//        '</label>'
//    ,lang('s_58-b')
//    ,$domain_my
//    ,'profile/change-password')
//,array(
//        lang('s_59-a').'
//         <label class="display-n">'.
//        lang('s_59-b').
//        '</label>'
//    ,lang('s_59-b')
//    ,$domain_my
//    ,'profile/upload-documents')
//,array(
//        lang('s_60-a').'
//         <label class="display-n">'.
//        lang('s_60-b').
//        '</label>'
//    ,lang('s_60-b')
//    ,$domain_my
//    ,'profile/platform-access')
//
//    //side nav Finance
//
//,array(
//        lang('s_61-a').'
//         <label class="display-n">'.
//        lang('s_61-b').
//        '</label>'
//    ,lang('s_61-b')
//    ,$domain_my
//    ,'deposit')
//
//,array(
//        lang('s_62-a').'
//         <label class="display-n">'.
//        lang('s_62-b').
//        '</label>'
//    ,lang('s_62-b')
//    ,$domain_my
//    ,'withdraw')
//
//,array(
//        lang('s_63-a').'
//         <label class="display-n">'.
//        lang('s_63-b').
//        '</label>'
//    ,lang('s_63-b')
//    ,$domain_my
//    ,'transfer')
//
//,array(
//        lang('s_64-a').'
//         <label class="display-n">'.
//        lang('s_64-b').
//        '</label>'
//    ,lang('s_64-b')
//    ,$domain_my
//    ,'transaction-history')
//
//    //side nav Bonus
//
//,array(
//        lang('s_65-a').'
//         <label class="display-n">'.
//        lang('s_65-b').
//        '</label>'
//    ,lang('s_65-b')
//    ,$domain_my
//    ,'bonus/bonuses')
//,array(
//        lang('s_66-a').'
//         <label class="display-n">'.
//        lang('s_66-b').
//        '</label>'
//    ,lang('s_66-b')
//    ,$domain_my
//    ,'bonus/bonuses'),
//
//    //side nav Partnertship
//    array(
//        lang('s_67-a').'
//         <label class="display-n">'.
//        lang('s_67-b').
//        '</label>'
//    ,lang('s_67-b')
//    ,$domain_my
//    ,'partnership/commission')
//,array(
//        lang('s_68-a').'
//         <label class="display-n">'.
//        lang('s_68-b').
//        '</label>'
//    ,lang('s_68-b')
//    ,$domain_my
//    ,'partnership/clicks')
//,array(
//        lang('s_69-a').'
//         <label class="display-n">'.
//        lang('s_69-b').
//        '</label>'
//    ,lang('s_69-b')
//    ,$domain_my
//    ,'withdraw')
//,array(
//        lang('s_70-a').'
//         <label class="display-n">'.
//        lang('s_70-b').
//        '</label>'
//    ,lang('s_70-b')
//    ,$domain_my
//    ,'partnership/referrals')
//,array(
//        lang('s_71-a').'
//         <label class="display-n">'.
//        lang('s_71-b').
//        '</label>'
//    ,lang('s_71-b')
//    ,'www'
//    ,'las-juva')
//,array(
//        lang('s_72-a').'
//         <label class="display-n">'.
//        lang('s_72-b').
//        '</label>'
//    ,lang('s_72-b')
//    ,'www'
//    ,'deposit-insurance')
//,array(
//        lang('s_73-a').'
//         <label class="display-n">'.
//        lang('s_73-b').
//        '</label>'
//    ,lang('s_73-b')
//    ,'www'
//    ,'awards')
//,array(
//        lang('s_74-a').'
//         <label class="display-n">'.
//        lang('s_74-b').
//        '</label>'
//    ,lang('s_74-b')
//    ,'www'
//    ,'account-type')
//,array(
//        lang('s_75-a').'
//         <label class="display-n">'.
//        lang('s_75-b').
//        '</label>'
//    ,lang('s_75-b')
//    ,'www'
//    ,'tiket-raffle')
//,array(
//        lang('s_76-a').'
//         <label class="display-n">'.
//        lang('s_76-b').
//        '</label>'
//    ,lang('s_76-b')
//    ,'www'
//    ,'partnership/cpa')
//,array(
//        lang('s_77-a').'
//         <label class="display-n">'.
//        lang('s_77-b').
//        '</label>'
//    ,lang('s_77-b')
//    ,'www'
//    ,'logos')
//,array(
//        lang('s_78-a').'
//         <label class="display-n">'.
//        lang('s_78-b').
//        '</label>'
//    ,lang('s_78-b')
//    ,'www'
//    ,'currency-conversion')
//,array(
//        lang('s_79-a').'
//         <label class="display-n">'.
//        lang('s_79-b').
//        '</label>'
//    ,lang('s_79-b')
//    ,'www'
//    ,'forex-calculator')
//,array(
//        lang('s_80-a').'
//         <label class="display-n">'.
//        lang('s_80-b').
//        '</label>'
//    ,lang('s_80-b')
//    ,'www'
//    ,'how-to-get-started')
////,array(
////        lang('s_81-a').'
////         <label class="display-n">'.
////        lang('s_81-b').
////        '</label>'
////    ,lang('s_81-b')
////    ,'www'
////    ,'call back')
//,array(
//        lang('s_82-a').'
//         <label class="display-n">'.
//        lang('s_82-b').
//        '</label>'
//    ,lang('s_82-b')
//    ,$domain_my
//    ,'client/signin')
//,array(
//        lang('s_83-a').'
//         <label class="display-n">'.
//        lang('s_83-b').
//        '</label>'
//    ,lang('s_83-b')
//    ,$domain_my
//    ,'partner/signin')
//,array(
//        lang('s_83x-a').'
//         <label class="display-n">'.
//        lang('s_83x-b').
//        '</label>'
//    ,lang('s_83x-b')
//    ,$domain_my
//    ,'forgot-password')
//,array(
//        lang('s_84-a').'
//         <label class="display-n">'.
//        lang('s_84-b').
//        '</label>'
//    ,lang('s_84-b')
//    ,$domain_my
//    ,'profile/sms_security')
//,array(
//        lang('s_85-a').'
//         <label class="display-n">'.
//        lang('s_85-b').
//        '</label>'
//    ,lang('s_85-b')
//    ,$domain_my
//    ,'deposit/bank-transfer')
//,array(
//        lang('s_86-a').'
//         <label class="display-n">'.
//        lang('s_86-b').
//        '</label>'
//    ,lang('s_86-b')
//    ,$domain_my
//    ,'deposit/debit-credit-cards')
//,array(
//        lang('s_87-a').'
//         <label class="display-n">'.
//        lang('s_87-b').
//        '</label>'
//    ,lang('s_87-b')
//    ,$domain_my
//    ,'deposit/skrill')
//,array(
//        lang('s_88-a').'
//         <label class="display-n">'.
//        lang('s_88-b').
//        '</label>'
//    ,lang('s_88-b')
//    ,$domain_my
//    ,'deposit/neteller')
//,array(
//        lang('s_89-a').'
//         <label class="display-n">'.
//        lang('s_89-b').
//        '</label>'
//    ,lang('s_89-b')
//    ,$domain_my
//    ,'deposit/paxum')
//,array(
//        lang('s_89-a').'
//         <label class="display-n">'.
//        lang('s_89-b').
//        '</label>'
//    ,lang('s_89-b')
//    ,$domain_my
//    ,'deposit/webmoney')
//,array(
//        lang('s_90-a').'
//         <label class="display-n">'.
//        lang('s_90-b').
//        '</label>'
//    ,lang('s_90-b')
//    ,$domain_my
//    ,'deposit/paypal')
//,array(
//        lang('s_91-a').'
//         <label class="display-n">'.
//        lang('s_91-b').
//        '</label>'
//    ,lang('s_91-b')
//    ,$domain_my
//    ,'deposit/hipay')
//,array(
//        lang('s_92-a').'
//         <label class="display-n">'.
//        lang('s_92-b').
//        '</label>'
//    ,lang('s_92-b')
//    ,$domain_my
//    ,'deposit/payco')
//,array(
//        lang('s_93-a').'
//         <label class="display-n">'.
//        lang('s_93-b').
//        '</label>'
//    ,lang('s_93-b')
//    ,$domain_my
//    ,'deposit/sofort')
//
////,array(
////        lang('s_94-a').'
////         <label class="display-n">'.
////        lang('s_94-b').
////        '</label>'
////    ,lang('s_94-b')
////    ,$domain_my
////    /* ,'deposit/yandexMoney'*/ )
//
//,array(
//        lang('s_95-a').'
//         <label class="display-n">'.
//        lang('s_95-b').
//        '</label>'
//    ,lang('s_95-b')
//    ,$domain_my
//    ,'deposit/qiWi')
//
////,array(
////        lang('s_96-a').'
////         <label class="display-n">'.
////        lang('s_96-b').
////        '</label>'
////    ,lang('s_96-b')
////    ,$domain_my
////    ,'deposit/paymill')
//
////,array(
////        lang('s_97-a').'
////         <label class="display-n">'.
////        lang('s_97-b').
////        '</label>'
////    ,lang('s_97-b')
////    ,$domain_my
////    ,'deposit/payments')
//,array(
//        lang('s_98-a').'
//         <label class="display-n">'.
//        lang('s_98-b').
//        '</label>'
//    ,lang('s_98-b')
//    ,$domain_my
//    ,'deposit/megaTransfer')
//,array(
//        lang('s_99-a').'
//         <label class="display-n">'.
//        lang('s_99-b').
//        '</label>'
//    ,lang('s_99-b')
//    ,$domain_my
//    ,'transfer')
////,array(
////        lang('s_100-a').'
////         <label class="display-n">'.
////        lang('s_100-b').
////        '</label>'
////    ,lang('s_100-b')
////    ,$domain_my
////    ,'invite-friend/invite-by-email')
////,array(
////        lang('s_101-a').'
////         <label class="display-n">'.
////        lang('s_101-b').
////        '</label>'
////    ,lang('s_101-b')
////    ,$domain_my
////    ,'invite-friend/my-friends')
////,array(
////        lang('s_102-a').'
////         <label class="display-n">'.
////        lang('s_102-b').
////        '</label>'
////    ,lang('s_102-b')
////    ,$domain_my
////    ,'invite-friend/statistics')
//,array(
//        lang('s_103-a').'
//         <label class="display-n">'.
//        lang('s_103-b').
//        '</label>'
//    ,lang('s_103-b')
//    ,$domain_my
//    ,'mail-support/compose')
//,array(
//        lang('s_104-a').'
//         <label class="display-n">'.
//        lang('s_104-b').
//        '</label>'
//    ,lang('s_104-b')
//    ,$domain_my
//    ,'mail-support/my-mail')
//,array(
//        lang('s_105-a').'
//         <label class="display-n">'.
//        lang('s_105-b').
//        '</label>'
//    ,lang('s_105-b')
//    ,$domain_my
//    ,'rebate-system')
//,array(
//        lang('s_106-a').'
//         <label class="display-n">'.
//        lang('s_106-b').
//        '</label>'
//    ,lang('s_106-b')
//    ,$domain_my
//    ,'rebate-system/personal-rebate')
//,array(
//        lang('s_107-a').'
//         <label class="display-n">'.
//        lang('s_107-b').
//        '</label>'
//    ,lang('s_107-b')
//    ,$domain_my
//    ,'rebate-system/statistics')
//,array(
//        lang('s_108-a').'
//         <label class="display-n">'.
//        lang('s_108-b').
//        '</label>'
//    ,lang('s_108-b')
//    ,$domain_my
//    ,'withdraw/debit-credit-cards')
//,array(
//        lang('s_109-a').'
//         <label class="display-n">'.
//        lang('s_109-b').
//        '</label>'
//    ,lang('s_109-b')
//    ,$domain_my
//    ,'withdraw/skrill')
//,array(
//        lang('s_110-a').'
//         <label class="display-n">'.
//        lang('s_110-b').
//        '</label>'
//    ,lang('s_110-b')
//    ,$domain_my
//    ,'withdraw/neteller')
//,array(
//        lang('s_111-a').'
//         <label class="display-n">'.
//        lang('s_111-b').
//        '</label>'
//    ,lang('s_111-b')
//    ,$domain_my
//    ,'withdraw/paxum')
//
//,array(
//        lang('s_112-a').'
//         <label class="display-n">'.
//        lang('s_112-b').
//        '</label>'
//    ,lang('s_112-b')
//    ,$domain_my
//    ,'withdraw/paypal')
//,array(
//        lang('s_113-a').'
//         <label class="display-n">'.
//        lang('s_113-b').
//        '</label>'
//    ,lang('s_113-b')
//    ,'www'
//    ,'ecn')
//,array(
//        lang('s_114-a').'
//        <label class="display-n">'.
//        lang('s_114-b').
//        '</label>'
//    ,lang('s_114-b')
//    ,'www'
//    ,'RPJracing')
//,array(
//        lang('s_115-a').'
//        <label class="display-n">'.
//        lang('s_115-b').
//        '</label>'
//    ,lang('s_115-b')
//    ,'www'
//    ,'analytical-reviews')
//,array(
//        lang('s_116-a').'
//        <label class="display-n">'.
//        lang('s_116-b').
//        '</label>'
//    ,lang('s_116-b')
//    ,'www'
//    ,'calendar')
//,array(
//        lang('s_117-a').'
//        <label class="display-n">'.
//        lang('s_117-b').
//        '</label>'
//    ,lang('s_117-b')
//    ,'www'
//    ,'HKM_Zvolen')
//,array(
//        lang('s_118-a').'
//        <label class="display-n">'.
//        lang('s_118-b').
//        '</label>'
//    ,lang('s_118-b')
//    ,'www'
//    ,'License')
//,array(
//        lang('s_120-a').'
//        <label class="display-n">'.
//        lang('s_120-b').
//        '</label>'
//    ,lang('s_120-b')
//    ,'www'
//    ,'Team')
//,array(
//        lang('s_121-a').'
//        <label class="display-n">'.
//        lang('s_121-b').
//        '</label>'
//    ,lang('s_121-b')
//    ,'wt'
//    ,'https://webtrader.forexmart.com/login')
//,$landing
//);


/*
 *
 *
 */

$content='';
foreach ($array as $key => $value) {
    //echo '<script type="text/javascript"> alert("test alert"); </script>';
    //echo $value[0].'<br>';
    $content .= ' <li class="specificwidth">';
    if ($value[2]=='www'){
        $url = FXPP::www_url($value[3]);
    }else if($value[2]=='wt'){
        $url= $value[3];
    }else if($value[2]=='none'){
        $url= '#';
        $stopredirection=1;
    }else{
        $url= FXPP::my_url($value[3]);
    }

    if($value[3] == 'Team'){
        $content .= '<a class="question" aria-expanded="false" >'.$value[0].'</a>';
        $content .= ' <p class="answer" >';
        $content .= ' '. $value[1].' ';
        $content .= ' </p>';
        $content .= '</li>';
    }
    else{
        if(isset($stopredirection) && $stopredirection==1){
            $content .= '<a href="'.$url.'" class="question" aria-expanded="false" >'.$value[0].'</a>';
        }else{
            $content .= '<a target="_blank" href="'.$url.'" class="question" aria-expanded="false" >'.$value[0].'</a>';
        }
        $content .= ' <p class="answer" >';
        $content .= ' '. $value[1].' ';
        $content .= ' </p>';
        $content .= '</li>';
    }
}
?>


<div id="searchloc" class="reg-form-holder" style="display: none">
    <!--<div class="reg-form-holder">-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <h1 class="license-title col-md-8">Search Results</h1>

                </div>
                <div class="qa-holder">
                    <ul class="list">
                        <?= $content ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>