<style>
    .qa-holder ul li a {
        color: #337AB7;
        font-size: 15px;
        font-family: Open Sans;
        font-weight: 600;
    }
    .specificwidth{
        width: 50%;
    }
    .display-n{
        display:none
    }

</style>
<?php  $this->lang->load('Search'); ?>
<?php
$description="";
$domain_www = $this->config->item('domain-www');
$domain_my = $this->config->item('domain-my');
$uri='';
$array = array(
    //external
    // ABOUT
    array(
        lang('s_1-a').'
         <label class="display-n">'.
        lang('s_1-b').
        '</label>'
    ,lang('s_1-b')
    ,$domain_www
    ,'home')
,array(
        lang('s_2-a').'
        <label class="display-n">'.
        lang('s_2-b').
        '</label>'
    ,lang('s_2-b')
    ,$domain_www
    ,'about-us')
,array(
        lang('s_3-a').'
        <label class="display-n">'.
        lang('s_3-b').
        '</label>'
    ,lang('s_3-b')
    ,$domain_www
    ,'company-news'),
    array(
        lang('s_4-a').'
        <label class="display-n">'.
        lang('s_4-b').
        '</label>'
    ,lang('s_4-b')
    ,$domain_www
    ,'why-choose-us')
,array(
        lang('s_5-a').'
        <label class="display-n">'.
        lang('s_5-b').
        '</label>'
    ,lang('s_5-b')
    ,$domain_www
    ,'deposit-withdraw-page')
,array(
        lang('s_6-a').'
        <label class="display-n">'.
        lang('s_6-b').
        '</label>'
    ,lang('s_6-b')
    ,$domain_www
    ,'licence-and-regulations')
,array(
        lang('s_7-a').'
        <label class="display-n">'.
        lang('s_7-b').
        '</label>'
    ,lang('s_7-b')
    ,$domain_www
    ,'account-verification')
,array(
        lang('s_8-a').'
        <label class="display-n">'.
        lang('s_8-b').
        '</label>'
    ,lang('s_8-b')
    ,$domain_www
    ,'las-palmas')
    //FOREX account types
,array(
        lang('s_9-a').'
        <label class="display-n">'.
        lang('s_9-b').
        '</label>'
    ,lang('s_9-b')
    ,$domain_www
    ,'account-type')
    //FOREX account types demo
,array(
        lang('s_10-a').'
        <label class="display-n">'.
        lang('s_10-b').
        '</label>'
    ,lang('s_10-b')
    ,$domain_www
    ,'demo-account')
    //FOREX account types  ForexMart Standard
,array(
        lang('s_11-a').'
        <label class="display-n">'.
        lang('s_11-b').
        '</label>'
    ,lang('s_11-b')
    ,$domain_www
    ,'live-account')
    //FOREX account types  ForexZero Spread
,array(
        lang('s_12-a').'
        <label class="display-n">'.
        lang('s_12-b').
        '</label>'
    ,lang('s_12-b')
    ,$domain_www
    ,'live-account')
    //FOREX Trading Platforms
,array(
        lang('s_13-a').'
        <label class="display-n">'.
        lang('s_13-b').
        '</label>'
    ,lang('s_13-b')
    ,$domain_www
    ,'metatrader4')
    //FOREX Instruments  forex
,array(
        lang('s_14-a').'
        <label class="display-n">'.
        lang('s_14-b').
        '</label>'
    ,lang('s_14-b')
    ,$domain_www
    ,'financial-instruments/forex')
    //FOREX Instruments  shares
,array(
        lang('s_15-a').'
        <label class="display-n">'.
        lang('s_15-b').
        '</label>'
    ,lang('s_15-b')
    ,$domain_www
    ,'financial-instruments/shares')
    //FOREX Instruments Spot Metals
,array(
        lang('s_16-a').'
        <label class="display-n">'.
        lang('s_16-b').
        '</label>'
    ,lang('s_16-b')
    ,$domain_www
    ,'financial-instruments/spots')
    //BONUS AND OFFERS
,array(
        lang('s_17-a').'
        <label class="display-n">'.
        lang('s_17-b').
        '</label>'
    ,lang('s_17-b')
    ,$domain_www
    ,'bonuses')
    //BONUS AND OFFERS Welcome Bonus 30%
,array(
        lang('s_18-a').'
        <label class="display-n">'.
        lang('s_18-b').
        '</label>'
    ,lang('s_18-b')
    ,$domain_www
    ,'thirty-percent-bonus')

    //BONUS AND OFFERS No Deposit Bonus
,array(
        lang('s_19-a').'
        <label class="display-n">'.
        lang('s_19-b').
        '</label>'
    ,lang('s_19-b')
    ,$domain_www
    ,'no-deposit-bonus')

    //Partnership

    //Partnership Affiliate Program
,array(
        lang('s_20-a').'
        <label class="display-n">'.
        lang('s_20-b').
        '</label>'
    ,lang('s_20-b')
    ,$domain_www
    ,'partnership/advantages')
,array(
        lang('s_21-a').'
        <label class="display-n">'.
        lang('s_21-b').
        '</label>'
    ,lang('s_21-b')
    ,$domain_www
    ,'affiliate-link')
,array(
        lang('s_22-a').'
        <label class="display-n">'.
        lang('s_22-b').
        '</label>'
    ,lang('s_22-b')
    ,$domain_www
    ,'commission-specification')

    //Partnership Types of Partnership
    //Friend Referral
,array(
        lang('s_23-a').'
         <label class="display-n">'.
        lang('s_23-b').
        '</label>'
    ,lang('s_23-b')
    ,$domain_www
    ,'partnership/friend-referrer')
    //Webmaster
,array(
        lang('s_24-a').'
         <label class="display-n">'.
        lang('s_24-b').
        '</label>'
    ,lang('s_24-b')
    ,$domain_www
    ,'partnership/webmaster')
    //Online Partner
,array(
        lang('s_25-a').'
         <label class="display-n">'.
        lang('s_25-b').
        '</label>'
    ,lang('s_25-b')
    ,$domain_www
    ,'partnership/online-partner')
    //Local online partner
,array(
        lang('s_26-a').'
         <label class="display-n">'.
        lang('s_26-b').
        '</label>'
    ,lang('s_26-b')
    ,$domain_www
    ,'partnership/local-online-partner')
    //Local office partner
,array(
        lang('s_27-a').'
         <label class="display-n">'.
        lang('s_27-b').
        '</label>'
    ,lang('s_27-b')
    ,$domain_www
    ,'partnership/local-office-partner')
    //Partnership Partnership registration
,array(
        lang('s_28-a').'
         <label class="display-n">'.
        lang('s_28-b').
        '</label>'
    ,lang('s_28-b')
    ,$domain_www
    ,'partnership/friend-referrer')
    //Partnership Materials
,array(
        lang('s_29-a').'
         <label class="display-n">'.
        lang('s_29-b').
        '</label>'
    ,lang('s_29-b')
    ,$domain_www
    ,'banners')
,array(
        lang('s_30-a').'
         <label class="display-n">'.
        lang('s_30-b').
        '</label>'
    ,lang('s_30-b')
    ,$domain_www
    ,'banners')
    //CONTEST
    //registration
,array(
        lang('s_31-a').'
         <label class="display-n">'.
        lang('s_31-b').
        '</label>'
    ,lang('s_31-b')
    ,$domain_www
    ,'money-fall')
    //CONTEST
    //Ratings
,array(
        lang('s_32-a').'
         <label class="display-n">'.
        lang('s_32-b').
        '</label>'
    ,lang('s_32-b')
    ,$domain_www
    ,'contest/ratings')
    //CONTEST
    //Winners
,array(
        lang('s_33-a').'
         <label class="display-n">'.
        lang('s_33-b').
        '</label>'
    ,lang('s_33-b')
    ,$domain_www
    ,'contest/winners')
    //CONTEST
    //Contest Rules
,array(
        lang('s_34-a').'
         <label class="display-n">'.
        lang('s_34-b').
        '</label>'
    ,lang('s_34-b')
    ,$domain_www
    ,'contest/contest-rules')
    //TOOLS
    //Free VPS Hosting
,array(
        lang('s_35-a').'
         <label class="display-n">'.
        lang('s_35-b').
        '</label>'
    ,lang('s_35-b')
    ,$domain_www
    ,'vps-hosting')
    //TOOLS
    //Forex Chart
,array(
        lang('s_36-a').'
         <label class="display-n">'.
        lang('s_36-b').
        '</label>'
    ,lang('s_36-b')
    ,$domain_www
    ,'forex-charts')

    //SUPPORT
    // Contact us
,array(
        lang('s_37-a').'
         <label class="display-n">'.
        lang('s_37-b').
        '</label>'
    ,lang('s_37-b')
    ,$domain_www
    ,'contact-us')
    //SUPPORT
    // FAQ
,array(
        lang('s_38-a').'
         <label class="display-n">'.
        lang('s_38-b').
        '</label>'
    ,lang('s_38-b')
    ,$domain_www
    ,'faq')
    //SUPPORT
    // Forex Glossary
,array(
        lang('s_39-a').'
         <label class="display-n">'.
        lang('s_39-b').
        '</label>'
    ,lang('s_39-b')
    ,$domain_www
    ,'')
    //SUPPORT
    // Legal Dcoumentation
,array(
        lang('s_40-a').'
         <label class="display-n">'.
        lang('s_40-b').
        '</label>'
    ,lang('s_40-b')
    ,$domain_www
    ,'legal-documentation')
,array(
        lang('s_41-a').'
         <label class="display-n">'.
        lang('s_41-b').
        '</label>'
    ,lang('s_41-b')
    ,$domain_www
    ,'live-account')
,array(
        lang('s_42-a').'
         <label class="display-n">'.
        lang('s_42-b').
        '</label>'
    ,lang('s_42-b')
    ,$domain_www
    ,'privacy-policy')
,array(
        lang('s_43-a').'
         <label class="display-n">'.
        lang('s_43-b').
        '</label>'
    ,lang('s_43-b')
    ,$domain_www
    ,'Risk-Disclosure')
,array(
        lang('s_44-a').'
         <label class="display-n">'.
        lang('s_44-b').
        '</label>'
    ,lang('s_44-b')
    ,$domain_www
    ,'Terms-and-Conditions')
,array(
        lang('s_45-a').'
         <label class="display-n">'.
        lang('s_45-b').
        '</label>'
    ,lang('s_45-b')
    ,$domain_www
    ,'best-execution-policy')
,array(
        lang('s_46-a').'
         <label class="display-n">'.
        lang('s_46-b').
        '</label>'
    ,lang('s_46-b')
    ,$domain_www
    ,'complaint-handling-procedure')
,array(
        lang('s_47-a').'
         <label class="display-n">'.
        lang('s_47-b').
        '</label>'
    ,lang('s_47-b')
    ,$domain_www
    ,'conflict-of-interest-policy')
,array(
        lang('s_48-a').'
         <label class="display-n">'.
        lang('s_48-b').
        '</label>'
    ,lang('s_48-b')
    ,$domain_www
    ,'customer-categorisation')
,array(
        lang('s_49-a').'
         <label class="display-n">'.
        lang('s_49-b').
        '</label>'
    ,lang('s_49-b')
    ,$domain_www
    ,'investor-compensation-fund')
,array(
        lang('s_50-a').'
         <label class="display-n">'.
        lang('s_50-b').
        '</label>'
    ,lang('s_50-b')
    ,$domain_www
    ,'services')
,array(
        lang('s_51-a').'
         <label class="display-n">'.
        lang('s_51-b').
        '</label>'
    ,lang('s_51-b')
    ,$domain_www
    ,'terms-and-conditions')

    //internal

,array(
        lang('s_52-a').'
         <label class="display-n">'.
        lang('s_52-b').
        '</label>'
    ,lang('s_52-b')
    ,$domain_my
    ,'accounts')
    //side nav My Account
,array(
        lang('s_53-a').'
         <label class="display-n">'.
        lang('s_53-b').
        '</label>'
    ,lang('s_53-b')
    ,$domain_my
    ,'accounts/register')
,array(
        lang('s_54-a').'
         <label class="display-n">'.
        lang('s_54-b').
        '</label>'
    ,lang('s_54-b')
    ,$domain_my
    ,'my-account/current-trades')
,array(
        lang('s_55-a').'
         <label class="display-n">'.
        lang('s_55-b').
        '</label>'
    ,lang('s_55-b')
    ,$domain_my
    ,'my-account/current-trades')
,array(
        lang('s_56-a').'
         <label class="display-n">'.
        lang('s_56-b').
        '</label>'
    ,lang('s_56-b')
    ,$domain_my
    ,'my-account/forex-calculator')
    //side nav My Profile
,array(
        lang('s_57-a').'
         <label class="display-n">'.
        lang('s_57-b').
        '</label>'
    ,lang('s_57-b')
    ,$domain_my
    ,'profile/edit')
,array(
        lang('s_58-a').'
         <label class="display-n">'.
        lang('s_58-b').
        '</label>'
    ,lang('s_58-b')
    ,$domain_my
    ,'profile/change-password')
,array(
        lang('s_59-a').'
         <label class="display-n">'.
        lang('s_59-b').
        '</label>'
    ,lang('s_59-b')
    ,$domain_my
    ,'profile/upload-documents')
,array(
        lang('s_60-a').'
         <label class="display-n">'.
        lang('s_60-b').
        '</label>'
    ,lang('s_60-b')
    ,$domain_my
    ,'profile/platform-access')

    //side nav Finance

,array(
        lang('s_61-a').'
         <label class="display-n">'.
        lang('s_61-b').
        '</label>'
    ,lang('s_61-b')
    ,$domain_my
    ,'deposit')

,array(
        lang('s_62-a').'
         <label class="display-n">'.
        lang('s_62-b').
        '</label>'
    ,lang('s_62-b')
    ,$domain_my
    ,'withdraw')

,array(
        lang('s_63-a').'
         <label class="display-n">'.
        lang('s_63-b').
        '</label>'
    ,lang('s_63-b')
    ,$domain_my
    ,'transfer')

,array(
        lang('s_64-a').'
         <label class="display-n">'.
        lang('s_64-b').
        '</label>'
    ,lang('s_64-b')
    ,$domain_my
    ,'transaction-history')

    //side nav Bonus

,array(
        lang('s_65-a').'
         <label class="display-n">'.
        lang('s_65-b').
        '</label>'
    ,lang('s_65-b')
    ,$domain_my
    ,'bonus/bonuses')
,array(
        lang('s_66-a').'
         <label class="display-n">'.
        lang('s_66-b').
        '</label>'
    ,lang('s_66-b')
    ,$domain_my
    ,'bonus/bonuses'),

    //side nav Partnertship
    array(
        lang('s_67-a').'
         <label class="display-n">'.
        lang('s_67-b').
        '</label>'
    ,lang('s_67-b')
    ,$domain_my
    ,'partnership/commission')
,array(
        lang('s_68-a').'
         <label class="display-n">'.
        lang('s_68-b').
        '</label>'
    ,lang('s_68-b')
    ,$domain_my
    ,'partnership/clicks')
,array(
        lang('s_69-a').'
         <label class="display-n">'.
        lang('s_69-b').
        '</label>'
    ,lang('s_69-b')
    ,$domain_my
    ,'withdraw')
,array(
        lang('s_70-a').'
         <label class="display-n">'.
        lang('s_70-b').
        '</label>'
    ,lang('s_70-b')
    ,$domain_my
    ,'partnership/referrals')

);


$content='';
foreach ($array as $key => $value) {
    $content .= ' <li class="specificwidth">';
    $content .= '<a target="_blank" href="'.$value[2].'/'.$value[3].'" class="question" aria-expanded="false" >'.$value[0].'</a>';
    $content .= ' <p class="answer" >';
    $content .= ' '. $value[1].' ';
    $content .= ' </p>';
    $content .= '</li>';
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