<?php
header('X-UA-Compatible: IE=edge');
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>

<?php $class = $this->router->class; ?>
<?php ob_start("ob_gzhandler"); ?>
<!DOCTYPE html>
<html lang="<?= FXPP::html_url() ?>" dir="<?= FXPP::lang_dir(); ?>"  >
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate" />
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?=(isset($metadata_description))? $metadata_description: '';?>">
    <meta name="keywords" content="<?=(isset($metadata_keyword))? $metadata_keyword: '';?>">

    <!-- Facebook -->
    <meta property="og:title" content="<?=(isset($metadata_keyword))? $metadata_keyword: '';?>"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.forexmart.com"/>
    <meta property="og:image" content="https://www.forexmart.com/assets/images/logo_forex/forexmart.jpg" />
    <meta property="og:description" content="Forex and CFD Trading involve a significant risk to your invested capital. Please read and ensure you fully understand our Risk Disclosure."/>
    <meta property="og:site_name" content="www.forexmart.com"/>

    <!-- Twitter -->
    <meta name="twitter:title" content="<?=(isset($metadata_keyword))? $metadata_keyword: '';?> ">
    <meta name="twitter:description" content="Forex and CFD Trading involve a significant risk to your invested capital. Please read and ensure you fully understand our Risk Disclosure.">
    <meta name="twitter:image" content="https://www.forexmart.com/assets/images/fxlogofb.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link href="<?= $this->template->Css();?>font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->template->Css();?>external-style.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>new-external-style.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>slider-index-style.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>affiliate.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>rangeslider.css" rel="stylesheet">
    <!-- <link href="carousel.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <link href="<?= $this->template->Css();?>exscrolling-nav.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>airview.min.css" rel="stylesheet">
    <!-- Owl Carousel Assets -->
    <link href="<?= $this->template->Css();?>owl.carousel.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>owl.theme.css" rel="stylesheet">
    <script src="<?= $this->template->Js()?>jquery-1.11.3.min.js"></script>
    <?php if(!IPLoc::isChinaIP()){ ?><meta name="google-site-verification" content="hUTbDLfEPfAPqV6xcbcuxv_b8HIjsXKIeBHijGZbZE4" /> <?php } ?>
    <link rel="icon" type="image/gif" href="<?= $this->template->Images()?>icon.ico" />
    <title><?= $template['title']; ?></title>
    <!-- Bootstrap Core CSS -->
    <?php switch(FXPP::html_url()){
    case 'sa': case 'pk': ?>
            <link href="<?= $this->template->Css()?>bootstrap-arabic.min.css" rel="stylesheet">
    <?php break;default:?>
            <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <?php } ?>
    <link href="<?= $this->template->Css()?>style.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>custom.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>custom-external.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>external-style.min.css" rel="stylesheet">

    <?php switch(FXPP::html_url()){
        case 'sa': case 'pk': ?>
        <link href="<?= $this->template->Css()?>external-arabic-style.css" rel="stylesheet">
        <link href="<?= $this->template->Css()?>modified-style.css" rel="stylesheet">
        <link href="<?= $this->template->Css()?>custom-arabic-style.css" rel="stylesheet">
    <?php break;default:?>
    <?php } ?>
    <link href="<?= $this->template->Css()?>external-res2.min.css" rel="stylesheet">
    <?=(isset($template['metadata_css']))? $template['metadata_css']: '';?>
    <!-- Owl Carousel Assets -->
    <script type="text/javascript" src="<?= $this->template->Js()?>jquery.js"></script>
    <style type="text/css">
        .note-text{
            font-size: 10px !important;
        }
    </style>

    <style type="text/css">
        .acct-verification-text {
            color: #29A643;
            font-family: Open Sans;
            text-align: justify;
        }
        .acct-verification-text span {
            color: #333;
            }
        .img-acc-ver-holder {
            margin-top: 20px;
        }
        .img-acc-ver-holder img {
            float: none;
            margin: 0px auto;
            display: block;
            max-width: 100%;
            height: auto;
        }
        .vip-register-holder a:hover {
            background: #3bca59;
            text-decoration: none;
            transition: all ease 0.3s;
        }
        .vip-register-holder a {
            font-family: Open Sans;
            background: #29a643;
            color: #fff;
            border: 1px solid #29a643;
            text-decoration: none;
            font-size: 17px;
            padding: 15px 20px;
            display: inline-block;
            width: 200px;
            text-align: center;
            transition: all ease 0.3s;
        }

        .vip-main-title {
            color: #fff;
            font-size: 25px;
            font-family: Georgia;
            font-weight: 300;
            line-height: 35px;
            margin-top: 20px;
        }
        .vip-logos-holder {
            background: rgba(255,255,255,0.1);
            padding: 15px;
        }

        .vip-register-holder p, .vip-login-holder p:lang(cs) {
            font-family: Open Sans;
            font-size: 14px;
            color: #fff;
        }
        .vip-login-holder p
        {
            font-family: Open Sans;
            font-size: 17px;
            color: #fff;
            /*font-weight: 600;*/
        }
        .vip-login-holder a
        {
            font-family: Open Sans;
            background: #29a643;
            color: #fff;
            border: 1px solid #29a643;
            text-decoration: none;
            font-size: 17px;
            padding: 15px 20px;
            display: inline-block;
            width: 200px;
            text-align: center;
            transition: all ease 0.3s;
        }
        @media only screen and (max-width: 414px) {
            .vip-login-holder a
            {
                font-family: Open Sans;
                background: #29a643;
                color: #fff;
                border: 1px solid #29a643;
                text-decoration: none;
                font-size: 17px;
                padding: 15px 20px;
                display: inline-block;
                width: 100%!important;
                text-align: center;
                transition: all ease 0.3s;
            }
            .vip-register-holder a {
                font-family: Open Sans;
                background: #29a643;
                color: #fff;
                border: 1px solid #29a643;
                text-decoration: none;
                font-size: 17px;
                padding: 15px 20px;
                display: inline-block;
                width: 100%!important;
                text-align: center;
                transition: all ease 0.3s;
            }
        }

        #cysecLicense {
            background: rgba(0, 0, 0, 0) url("<?= $this->template->Images() ?>licence/bg-corporate.jpg") no-repeat scroll center center / cover ;
            padding: 20px !important;
        }

        .nn li .fx-drp {
            z-index: 1000;
        }
        @media only screen and (min-width: 1024px) {
            .bul_lst2:lang(jp) {
                min-width: 125px !important;
                margin: 0 !important;
                text-indent: 0.3em;
            }
        }
        @media only screen and (max-width: 991px) and (min-width: 768px) {
            #owl-demo .item img{
                max-width: 165px;
            }
        }
        @media only screen and (max-width: 768px) {
            .bul_lst2:lang(de) {margin: 0 !important;}
            #botnav_right ul li:first-child a:lang(de) {
                min-width: 210px !important;
            }
            #botnav_right ul li a:lang(de){
                min-width: 203px !important;
            }
        }
        @media (min-width: 992px){
            .col-md-6 {}
        }
        .container:lang(ru){padding-right:15px!important;padding-left:15px!important;}
        .bul_lst2:lang(ru) {margin: 0 !important;}

        .bul_lst2 {
            margin: 0px;
        }

        .id-font:lang(id){
            font-size: 10px;
            line-height: 12px;
        }

        .id-font:lang(de){
            font-size: 12px;
        }

        .id-font:lang(es){
            font-size: 12px;
        }

        .id-font:lang(bg){
            font-size: 12px;
        }

        .id-font:lang(fr){
            font-size: 12px;
        }

        .id-font:lang(pl){
            font-size: 12px;
        }
        .id-font:lang(pt){
            font-size: 12px;
        }
    </style>
    <!-- Custom CSS -->
    <style type="text/css">
        /* scrolling-nav.css inlining recommendation by google*//* Thu, 31 Mar 2016 10:47:55 +0000 */
        body{width:100%;height:100%}html{width:100%;height:100%}@media(min-width:767px){.navbar{padding:20px 0;-webkit-transition:background .5s ease-in-out,padding .5s ease-in-out;-moz-transition:background .5s ease-in-out,padding .5s ease-in-out;transition:background .5s ease-in-out,padding .5s ease-in-out}.top-nav-collapse{padding:0}}
        .navbar-brand-internal{
            min-height: 50px !important;
            padding: 0px;
            margin-top: 6px;}
        .nav-fix{
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;}
        .top-fix{
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;}
        .side-fix-holder{
            top: 35%!important;
            -webkit-top:35%!important;
            -moz-top:35%!important;
            top:35%!important;}
        .purechat.purechat-bottom-right {
            right: 40px !important;
            bottom: 0;
            z-index: 5!important;}
        .purechat-widget .purechat-expanded, .purechat-widget .purechat-collapsed-outer {
            margin-right: 0px !important;
        }
        @media screen and (max-width: 450px) {
            .purechat-widget .purechat-expanded, .purechat-widget .purechat-collapsed-outer {
                width: 250px !important;
                margin-right: -30px !important;
            }
            .collapsed-image {
                left: 42% !important;
            }
            .purechat-collapsed-outer{display: none!important;}
        }
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
        .awardtitle{
            font-family: Georgia;
            font-size: 30px;
            color: #333;
        }
        .top-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
        .rangeslider, .rangeslider__fill{
            box-shadow: none;
            border-radius: 10px;
        }
        .rangeslider__fill{
            background:#2378b4;
        }
        .rangeslider__handle{
            border:0;
            background-image: none;
            background:#878787;
            box-shadow: none;
            height: 35px;
            width: 35px;
            left: -2px;
        }
        .rangeslider__handle:after{
            background-image: none;
        }
        .rangeslider--horizontal{
            height: 15px;
            margin: 0 15px;
        }
        .fx-slider{
            position: relative;
        }
        /*Output*/
        .range-output{
            background: #fefefe;
            border: 1px solid rgba(204, 204, 204, 0.65);
            display: block;
            font-size: 24px;
            height: 60px;
            margin: 20px 18px;
            padding: 14px;
            line-height: 14px;
            text-align: right;
            vertical-align: middle;
            width: 218px
            /*padding: 12px 20px;*/
            /*border:2px solid #2378b4;*/
            /*background:#fff;*/
            /*width: 125px;*/
            /*text-align: center;*/
            /*display: block;*/
            /*margin: 20px auto;*/
            /*height: 60px;*/
            /*vertical-align: middle;*/
            /*font-size: 24px;*/
        }
        .range-output:after{
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            /* border-top: 10px solid rgb(254, 254, 254); */
            /* border-left: 8px solid rgba(204, 204, 204, 0.34); */
            /* border-right: 8px solid rgba(204, 204, 204, 0.34); */
            border-style: solid;
            left: 49px;
            border-color: #fefefe rgba(224, 216, 216, 0.25) rgba(0, 0, 0, 0) rgba(189, 174, 174, 0.13);
            top: 58px;
            border-width: 15px;
            /*content: "";*/
            /*position: absolute;*/
            /*width: 0;*/
            /*height: 0;*/
            /*border-top: 10px solid #ddd;*/
            /*border-left: 7px solid transparent;*/
            /*border-right: 7px solid transparent;*/
            /*top: 59%;*/
            /*left: 25px;*/
        }
        #owl-demo .item{margin: 3px;}
        #owl-demo .item img{display: block;height: auto;margin: 30px auto 0;}
        .side-fix li a:lang(ru){ padding: 7px 11.5px; }
        img[alt*="Yandex.Metrica"] {display: none;}.purechat , .purechat-widget ,.purechat-bottom ,.purechat-bottom-right ,.purechat-button-available ,.purechat-slideInUp ,.purechat-animated ,.purechat-widget-expanded:lang(sa){direction:ltr!important;}
        .license-title-las-palmas-page:lang(cs){font-size: 23px;}
        .btn-demo_custom,.btn-real_custom{padding: 7px 9px !important;width: 100% !important;}
        body {height: 100% !important;overflow-x: hidden !important;}

        @media screen and (min-width: 1024px) and (max-width: 1270px){
            <?php if(FXPP::html_url() != 'sa'){ ?>
                .navbar-nav {margin: 7.5px -15px !important;}
                .btn-web-terminal {font-family: Open Sans;font-size: 15px;font-weight: 400;color: #2988ca;background: none;border: 1px solid #2988ca;padding: 8px 25px;transition: all ease .3s;}
            <?php } ?>
        }
    </style>




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript"  src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">

        var www_url = "<?=FXPP::www_url();?>"; // this www_url using for all extranel js file
        $(window).bind('scroll', function() {
            if ($(window).scrollTop() > 95) {
                $('#nav').addClass('nav-fix');
                $('#navtop').addClass('top-fix');
            }
            else {
                $('#nav').removeClass('nav-fix');
                $('#navtop').removeClass('top-fix');
            }
        });
        $(document).ready(function () {
            $('.page-link').mouseover(function () {
                $($(this).data('target')).fadeIn("fast");
            });
            $('.page-link').mouseleave(function () {
                $($(this).data('target')).fadeOut("fast");
            });
            $('#nav').removeClass('nav-fix');
            $('#navtop').removeClass('top-fix');
        });
        $(function() {
            $('#nig').hover(function() {
                $('#nigeria-holder').fadeIn("fast");
                $('#nigeria-holder').fadeIn("fast");
            }, function() {
                $('#nigeria-holder').fadeOut("fast");
            });
            $('#mal').hover(function() {
                $('#malaysia-holder').fadeIn("fast");
            }, function() {
                $('#malaysia-holder').fadeOut("fast");
            });
            $('#ind').hover(function() {
                $('#indonesia-holder').fadeIn("fast");
            }, function() {
                $('#indonesia-holder').fadeOut("fast");
            });
            $('#cy').hover(function() {
                $('#cyprus-holder').fadeIn("fast");
            }, function() {
                $('#cyprus-holder').fadeOut("fast");
            });
        });
        $(window).bind('scroll', function() {
            if ($(window).scrollTop() > 75) {
                $('#nav').addClass('nav-fix');
                $('#top').addClass('top-fix');
            }else {
                $('#nav').removeClass('nav-fix');
                $('#top').removeClass('top-fix');

                //cd-is-visible
            }
        });
    </script>
    <?=(isset($template['metadata_js']))? $template['metadata_js']: '';?>

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="text/javascript">
       // $(function () {  $('[data-toggle="tooltip"]').tooltip()  });
        $(document).ready(function () {
            $('.page-link').mouseover(function () {
                $($(this).data('target')).fadeIn("fast");
            });
             $('.page-link').mouseleave(function () {
                $($(this).data('target')).fadeOut("fast");
            });
        });
         $(window).bind('scroll', function() {
             if ($(window).scrollTop() > 95) {
                 $('#nav').addClass('nav-fix');
             } else {
                 $('#nav').removeClass('nav-fix');
             }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.page-link').mouseover(function () {
                $($(this).data('target')).fadeIn("fast");
            });
            $('.page-link').mouseleave(function () {
                $($(this).data('target')).fadeOut("fast");
            });
            $(".hidden-menu").hide();
            $(".menu-button").show();
            $('.menu-button').click(function(){
                $(".hidden-menu").slideToggle();
            });
        });
        $(window).bind('scroll', function() {
            if ($(window).scrollTop() > 75) {
                $('#nav').addClass('nav-fix');
                $('#top').addClass('top-fix');
            }else {
                $('#nav').removeClass('nav-fix');
                $('#top').removeClass('top-fix');
            }
        });
    </script>

    <?php if(isset($_SESSION['user_id'])){ $ga_user_id =(string) $_SESSION['user_id']; $ga_account_number=$_SESSION['account_number'];  ?>
        <?php   if(isset($_SESSION['account_number'])){
            $ga_account_number=$_SESSION['account_number'];
        }else{
            $ga_account_number='000000';
        }
        ?>

        <script type="text/javascript">
            window.dataLayer = window.dataLayer || [];
            var usrid ='<?=$ga_user_id;?>';
            var AccountNumber ='<?php echo $ga_account_number; ?>';
            usrid='88'.concat(usrid).concat('88');
            window.dataLayer.push({
                'userID': usrid.toString(),
                'IP': "<?php echo $_SERVER['REMOTE_ADDR']; ?>",
                'AccountNumber': AccountNumber.toString()
            });
//            var dimensionValue = usrid;
//            ga('set', 'dimension2', dimensionValue);
        </script>

    <?php }else if(isset($_COOKIE['forexmart_gtm_id'])){ ?>
        <?php   if(isset($_COOKIE['forexmart_gtm_account_number'])){
            $ga_account_number= $_COOKIE['forexmart_gtm_account_number'];
        }else{
            $ga_account_number='000000';
        }
        ?>
        <script type="text/javascript">
            window.dataLayer = window.dataLayer || [];
            var usrid ='<?=$_COOKIE['forexmart_gtm_id'];?>';
            var AccountNumber ='<?php echo $ga_account_number; ?>';
            usrid='88'.concat(usrid).concat('88');
            window.dataLayer.push({
                'userID': usrid.toString(),
                'IP': "<?php echo $_SERVER['REMOTE_ADDR']; ?>",
                'AccountNumber': AccountNumber.toString()
            });
//            var dimensionValue = usrid;
//            ga('set', 'dimension', dimensionValue);

        </script>

    <?php  }else{ ?>
        <script type="text/javascript">
            window.dataLayer = window.dataLayer || [];
            var usrid ='000000';
            window.dataLayer.push({
                'userID': usrid.toString(),
                'IP': "<?php echo $_SERVER['REMOTE_ADDR']; ?>",
                'AccountNumber': '000000'
            });
        </script>
    <?php } ?>

<?php if(!IPLoc::isChinaIP()){ ?>
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-MRVPP5L');
            </script>
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-KHXDKN');
            </script>

 <?php } ?>
    <style>
        .metrica_yandex_com{width:88px; height:31px; border:0;}
        .mc_yandex_ru_watch{position:absolute; left:-9999px;}
    </style>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="overflow-y: scroll !important;">
<?php if(!IPLoc::isChinaIP()){ ?>
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MRVPP5L" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MRVPP5L');</script>
        <!-- End Google Tag Manager -->

        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-M2HH9X" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M2HH9X');</script>
        <!-- End Google Tag Manager -->

<?php } ?>

<script type="text/javascript">
    var cb = function() {
        var l = document.createElement('link'); l.rel = 'stylesheet';
        l.href = '';
        var h = document.getElementsByTagName('head')[0]; h.parentNode.insertBefore(l, h);
    };
    var raf = requestAnimationFrame || mozRequestAnimationFrame ||
        webkitRequestAnimationFrame || msRequestAnimationFrame;
    if (raf) raf(cb);
    else window.addEventListener('load', cb);
</script>
<?php include_once('nav.php') ?>
<!-- SLIDER START -->
<div class="searchscope">
    <?php if($class === 'homed'){ ?>
        <div class="banner-holder ext-arabic-banner-holder">
            <div class="container">
                <div class="row banner-content-holder">
                    <div class="home1 col-lg-4 col-sm-6 banner-content ext-arabic-banner-content" lang="<?= FXPP::html_url();?>">
                        <h1 class="banner-title" lang="<?= FXPP::html_url();?>">
                            <?=lang('x_hm_h-0')?>
                        </h1>
                        <p class="banner-text ext-arabic-banner-text">
                            <i class="fa fa-check feat-check"></i>
                            <span ><?=lang('x_hm_p_i0')?></span>
                            <br>
                            <i class="fa fa-check feat-check"></i>
                            <?=lang('x_hm_p_i1')?>
                        </p>
                        <div class="btn-holder2 ext-arabic-btn-main-holder">
                            <a href="<?php echo FXPP::loc_url('register/demo')?>">
                                <?=lang('x_hm_d_0')?>
                            </a>
                        </div>
                        <p class="open-text ext-arabic-open-text">
                            <?=lang('x_hm_p_s0')?>
                        </p>
                        <div class="btn-holder1 ext-arabic-btn-main-holder">
                            <a  hreflang="<?= FXPP::html_url();?>" lang="<?= FXPP::html_url();?>" href="<?php echo FXPP::loc_url('register')?>">
                                <?=lang('x_hm_d-a0')?>
                            </a>
                        </div>
                    </div>
                    <div class="home2 col-lg-8 col-sm-6 banner-img-holder ext-arabic-banner-img-holder">
                        <img src="<?= $this->template->Images()?>banner-img.png" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both;">
        </div>
    <!--NEWS ROW START    -->
         <div class="news-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="news">
                        <?=lang('hm_p0_0')?>
                        <cite>
                            <?=lang('hm_p0_1')?>
                        </cite>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- NEWS ROW END    -->
    <?php } ?>
</div >
<div class="searchscope">
<!-- content -->
    <?=(isset($template['body']))?$template['body']: ''; ?>
</div>
<!-- end content -->

<?php if($class !='user'){ ?>
    <?= $this->load->ext_view('modal', 'searchlocation', '', TRUE); ?>
<?php } ?>

<?php $method = array("whychooseus","callBack", "index"); ?>
<?php if(!in_array($this->router->fetch_method(), $method)){ include_once('feats_holder.php');}?>
<?php //$method = array("meetusoffline","callBack", "index"); ?>

<!--NEW FOOTER IMPLEMENTATION-->
    <?php $method2 = array("home"); ?>
    <?php if(in_array($this->router->fetch_class(), $method2)){ 
            include_once('bottom_nav_home.php');
        }
        else{
            include_once('bottom_nav.php');
        }
    ?>
<!--END OF NEW FOOTER IMPLEMENTATION-->

<!--  start modal -->
<?php include_once('modal_feedback.php') ?>
<!--  end modal -->
<?php include_once('footer.php') ?>
<a href="#" class="cd-top cd-is-visible cd-fade-out">Top</a>
<!-- mainright -->
<?php include_once('mainright.php') ?>
<!-- mainright -->
<!--For speedtest inlight-->
<!--conversion tracking fx1265-->
<script type="text/javascript">
    /* <![CDATA[ */
    goog_snippet_vars = function() {
        var w = window;
        w.google_conversion_id = 946831952;
        w.google_conversion_label = "eugtCNWBk2EQ0IS-wwM";
        w.google_remarketing_only = false;
    };
    // DO NOT CHANGE THE CODE BELOW.
    goog_report_conversion = function(url) {
        goog_snippet_vars();
        window.google_conversion_format = "3";
        window.google_is_call = true;
        var opt = new Object();
        opt.onload_callback = function() {
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        };
        var conv_handler = window['google_trackConversion'];
        if (typeof(conv_handler) == 'function') {
            conv_handler(opt);
        }
    };
    /* ]]> */
</script>
<script type="text/javascript"  src="//www.googleadservices.com/pagead/conversion_async.js"></script>
<!--conversion tracking fx1265-->
<!-- jQuery -->
<!-- Bootstrap Core JavaScript -->
    <?php switch(FXPP::html_url()){
        case 'sa': case 'pk': ?>
            <script type="text/javascript" src="<?= $this->template->Js()?>arabic/bootstrap-arabic.min.js"></script>
        <?php break;default:?>
            <script type="text/javascript" src="<?= $this->template->Js()?>bootstrap.min.js"></script>
    <?php } ?>
<!-- Scrolling Nav JavaScript -->
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.easing.min.js"></script>
<script type="application/javascript">
//    scrollingnav.js
    $(window).scroll(function(){if($(".navbar").offset().top>50){$(".navbar-fixed-top").addClass("top-nav-collapse");}else{$(".navbar-fixed-top").removeClass("top-nav-collapse");}});$(function(){$('a.page-scroll').bind('click',function(event){var $anchor=$(this);$('html, body').stop().animate({scrollTop:$($anchor.attr('href')).offset().top},1500,'easeInOutExpo');event.preventDefault();});});
</script>
<script type="text/javascript" src="<?= $this->template->Js()?>owl.carousel.js"></script>
<!--scroll button at right bottom corner-->
<script type="application/javascript">
    //scrolltotop.js set to inline google recommendation
    $(document).ready(function($){var offset=300,offset_opacity=1200,scroll_top_duration=700,$back_to_top=$('.cd-top');$(window).scroll(function(){($(this).scrollTop()>offset)?$back_to_top.addClass('cd-is-visible'):$back_to_top.removeClass('cd-is-visible cd-fade-out');if($(this).scrollTop()>offset_opacity){$back_to_top.addClass('cd-fade-out');}});$back_to_top.on('click',function(event){event.preventDefault();$('body,html').animate({scrollTop:0},scroll_top_duration);});});
</script>


<!--scroll button at right bottom corner-->
<?php if($class !='user'){ ?>
   <!-- <script async type="text/javascript" src="<?= $this->template->Js()?>listfilterAll.min.js"></script> -->
    <!-- <script async type="text/javascript" src="<?= $this->template->Js()?>listfilterMobile.min.js"></script> -->
    <!-- <script async type="text/javascript" src="<?= $this->template->Js()?>listfilterTop.min.js"></script> -->
    <script async type="text/javascript" src="<?= $this->template->Js()?>listfilterIcon.min.js"></script>
<?php } ?>
<?=(isset($template['metadata']))?$template['metadata']: ''; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 6,
            lazyLoad : true,
            navigation : false
        });
        $('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        })
        $('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        })
    });
    $(document).on("click", ".supresscookies", function () {
        var site_url="<?=FXPP::loc_url('')?>";
        var pblc = [];
        pblc['request'] = null;
        var prvt = [];
        prvt["data"] = {

        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"pages/setcookie",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {

        });

        pblc['request'].fail(function( jqXHR, textStatus ) {

        });

        pblc['request'].always(function( jqXHR, textStatus ) {
        });
    });
</script>
<!--advertising-->
<?php if(isset($_COOKIE['forexmart_conceal'])){ ?>
<?php }else if(isset($_COOKIE['forexmart_xconceal'])){ ?>
<?php }else{ ?>
    <?php if(($unavailable) === true){ ?>
        <?= $this->load->ext_view('modal', 'register_restrict2', '', TRUE); ?>
          <script type="text/javascript">
             // $(window).load(function() {
                  //Fires when the page is loaded completely
                  checkCookie2();
             // });
              /*  if(localStorage.getItem('popState') != '0'){
                    $('.reg-external').removeAttr('href');
                    $('.reg-external').attr('data-toggle', 'modal');
                    $('.reg-external').attr('data-target', '#register_restrict2');
                    $('#register_restrict2').modal('show');

                    localStorage.setItem('popState','1')
                }*/
              function setCookie2(cname,cvalue,exdays) {
                  var d = new Date();
                  d.setTime(d.getTime() + (exdays*24*60*60*1000));
                  var expires = "expires=" + d.toGMTString();
                  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
              }
              function getCookie2(cname) {
                  var name = cname + "=";
                  var ca = document.cookie.split(';');
                  for(var i = 0; i < ca.length; i++) {
                      var c = ca[i];
                      while (c.charAt(0) == ' ') {
                          c = c.substring(1);
                      }
                      if (c.indexOf(name) == 0) {
                          return c.substring(name.length, c.length);
                      }
                  }
                  return "";
              }
              function checkCookie2() {
                  var user=getCookie2("username");
                  if (user != "") {
                   //   alert("Welcome again " + user);
                  } else {
                   //   user = prompt("Please enter your name:","");
                      user = "restrict";
                     // $('.reg-external').removeAttr('href');
                     // $('.reg-external').attr('data-toggle', 'modal');
                      $('.reg-external').attr('data-target', '#register_restrict2');
                      $('#register_restrict2').modal('show');
                      if (user != "" && user != null) {
                          setCookie2("username", user, 30);
                      }
                  }
              }
          </script>
    <?php }else{ ?>
        <?php if( $this->input->cookie('forexmart_fullname') == ''){ ?>
            <?php if( $this->input->cookie('daycookie') == ''){ ?>
                <?= $this->load->ext_view('modal', 'advertising', '', TRUE); ?>
                <script type="text/javascript">
                    $('.hitside .side').css('visibility','visible');
                    $('#li-nodep').css('visibility','visible');
                    function setCookie(key, value) {
                        var expires = new Date();
                        expires.setTime(expires.getTime() + (10 * 365 * 1 * 24 * 60 * 60 * 1000));
                        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
                    }
                    function getCookie(key) {
                        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                        return keyValue ? keyValue[2] : null;
                    }
                    $(window).load(function(){
                        var cookname=getCookie('cookieName');
                        if(cookname == null){
                           // $('#popup').modal('show');  // FXPP-8255
                            $('#five').show();
                            $(".slider").simpleSlider();
                            setCookie('cookieName','showCookie');
                        }
                    });
                    var date = new Date();
                    var midnight = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 23, 59, 59);
                    var x = Math.floor((Math.random() * 1000) + 1);
                    document.cookie = 'daycookie' + "=" + x + "; " + "expires="+(midnight * 10 * 365);
                </script>
            <?php } ?>
        <?php }elseif($this->input->cookie('forexmart_fullname') != '' and $this->input->cookie('forexmart_nodepositbonus') =='1' ){ ?>
        <?php }elseif(($this->input->cookie('forexmart_fullname') != '') and ($this->input->cookie('forexmart_nodepositbonus'))=='0' and ($this->input->cookie('forexmart_datedifference')<7) ){?>
                <?php if( $this->input->cookie('daycookie') == ''){ ?>
                    <?= $this->load->ext_view('modal', 'advertising', '', TRUE); ?>
                    <script type="text/javascript">
                        $('.hitside .side').css('visibility','visible');
                        $('#li-nodep').css('visibility','visible');
                        function setCookie(key, value) {
                            var expires = new Date();
                            expires.setTime(expires.getTime() + (10 * 365 * 1 * 24 * 60 * 60 * 1000));
                            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
                        }
                        function getCookie(key) {
                            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                            return keyValue ? keyValue[2] : null;
                        }
                        $(window).load(function(){
                            var cookname=getCookie('cookieName');
                            if(cookname == null){

                              //  $('#popup').modal('show');  // FXPP-8255
                                $(".slider").simpleSlider();
                                setCookie('cookieName','showCookie');
                            }
                        });
                        var date = new Date();
                        var midnight = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 23, 59, 59);
                        var x = Math.floor((Math.random() * 1000) + 1);
                        document.cookie = 'daycookie' + "=" + x + "; " + "expires="+(midnight * 10 * 365);
                    </script>
                <?php } ?>
        <?php }elseif(($this->input->cookie('forexmart_fullname') != '') and ($this->input->cookie('forexmart_nodepositbonus'))=='0' and ($this->input->cookie('forexmart_datedifference')>7) ){?>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php
//$this->session->set_userdata("pages",$class);
FXPP::websiteTraking(); ?>
<!-- Yandex.Metrika informer -->
<!--note-->
<a href="https://metrica.yandex.com/stat/?id=34475965&from=informer"
   target="_blank" rel="nofollow"><img src="//informer.yandex.ru/informer/34475965/3_1_FFFFFFFF_EFEFEFFF_0_pageviews" class="metrica_yandex_com"
                                      alt="Yandex.Metrica" title="Yandex.Metrica: data for today (page views, visits and unique users)" onclick="try{Ya.Metrika.informer(
{i:this,id:34475965,lang:'en'}

);return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34475965 = new Ya.Metrika(
                    {id:34475965, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}
                );
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function ()
            { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        d.location.protocol == "https:" ? "https:" : "http:";
        s.src =  "<?php echo ('https://www.forexmart.com/Hosting/watch');?>";
        if (w.opera == "[object Opera]")
        { d.addEventListener("DOMContentLoaded", f, false); }
        else
        { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div ><img src="//mc.yandex.ru/watch/34475965" class="mc_yandex_ru_watch" alt="" /></div></noscript>
<script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                $("#headerAll > form > input").attr("placeholder","<?=lang('search');?>")
            },50);

            if (document.createStyleSheet){
                document.createStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400');
                document.createStyleSheet('<?= $this->template->Fonts()?>css/font-awesome.min.css');
                document.createStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans');
                document.createStyleSheet('<?= $this->template->Css()?>carousel.min.css');
                document.createStyleSheet('<?= $this->template->Css()?>owl.min.css');
            }
            else {
                $("head").append($("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' type='text/css'  />"));
                $("head").append($("<link rel='stylesheet' href='<?= $this->template->Fonts()?>css/font-awesome.min.css' type='text/css'  />"));
                $("head").append($("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'  />"));
                $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>carousel.min.css' type='text/css'  />"));
                $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>owl.min.css' type='text/css'  />"));
            }
        });
</script>
<script type="text/javascript">
    $(function(){
        $("#mysearchfieldi").attr("placeholder","<?=lang('search');?>");
        $("#searchfield").attr("placeholder","<?=lang('search');?>");
        $("#mysearchfieldt").attr("placeholder","<?=lang('search');?>");
        $("#mysearchfield").attr("placeholder","<?=lang('search');?>");
        $(".purechat.purechat-widget.purechat-bottom.purechat-bottom-right.purechat-button-available.purechat-slideInUp.purechat-animated.purechat-widget-expanded").css("direction","ltr !important");
        $("span.purechat-widget-title-link").html('chat with us!');
    });
</script>
<script type="text/javascript">
        $(document).ready(function(){
            if($("body").size()>0) {
                if (document.createStyleSheet) {
                    document.createStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400');
                    document.createStyleSheet('<?= $this->template->Fonts()?>css/font-awesome.min.css');
                    document.createStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans');
                    document.createStyleSheet('<?= $this->template->Css()?>carousel.min.css');
                    document.createStyleSheet('<?= $this->template->Css()?>owl.min.css');
                } else {
                    $("head").append($("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' type='text/css'  />"));
                    $("head").append($("<link rel='stylesheet' href='<?= $this->template->Fonts()?>css/font-awesome.min.css' type='text/css'  />"));
                    $("head").append($("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'  />"));
                    $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>carousel.min.css' type='text/css'  />"));
                    $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>owl.min.css' type='text/css'  />"));
                }
            }
        });
</script>


<script type="text/javascript">

    function setCookie(key, value) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (10 * 365 * 1 * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
    }
    function getCookie(key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }
    $(document).ready(function(){
        var curl=window.location.href;
        var urlValue = "<?php echo isset($urlValue)?$urlValue:''?>";
        var chekurl = curl.indexOf("no-deposit-bonus");
        var rchekurl = curl.indexOf("no_deposit_bonus");

        var ndbCookie = getCookie('showNdb');
        if(ndbCookie != null){
            var getSession = $.session.get("ndbSession");
            if(getSession == undefined){
                $(".fx-drp-link #li-nodep").hide();
                $(".side-fix-holder .a-last-child").hide();
                $(".ls-img2").hide();
                $("#nodepositlinkId").hide();
                $(".nodepositlink").hide();
                //$(".cb-slideshow .noDeB").hide();
                //$(".cb-slideshow .fiB").hide();
                //$(".cb-slideshow .thB").hide();
            }
            else{
                $(".side-fix-holder .a-last-child").css('display', 'block');
                //$("#nodepositlinkId").hide();
            }
        }
        else{
            //$('#popup').modal('show');
            $(".side-fix-holder .a-last-child").css('display', 'block');
            setCookie("showNdb", "setNdbAfter");
            $.session.set("ndbSession", "setNdb");
        }
    });
    (function($){
        $.session = {
            _id: null,
            _cookieCache: undefined,
            _init: function()
            {
                if (!window.name) {
                    window.name = Math.random();
                }
                this._id = window.name;
                this._initCache();
                // See if we've changed protcols
                var matches = (new RegExp(this._generatePrefix() + "=([^;]+);")).exec(document.cookie);
                if (matches && document.location.protocol !== matches[1]) {
                    this._clearSession();
                    for (var key in this._cookieCache) {
                        try {
                            window.sessionStorage.setItem(key, this._cookieCache[key]);
                        } catch (e) {};
                    }
                }
                document.cookie = this._generatePrefix() + "=" + document.location.protocol + ';path=/;expires=' + (new Date((new Date).getTime() + 120000)).toUTCString();
            },
            _generatePrefix: function()
            {
                return '__session:' + this._id + ':';
            },
            _initCache: function()
            {
                var cookies = document.cookie.split(';');
                this._cookieCache = {};
                for (var i in cookies) {
                    var kv = cookies[i].split('=');
                    if ((new RegExp(this._generatePrefix() + '.+')).test(kv[0]) && kv[1]) {
                        this._cookieCache[kv[0].split(':', 3)[2]] = kv[1];
                    }
                }
            },
            _setFallback: function(key, value, onceOnly)
            {
                var cookie = this._generatePrefix() + key + "=" + value + "; path=/";
                if (onceOnly) {
                    cookie += "; expires=" + (new Date(Date.now() + 120000)).toUTCString();
                }
                document.cookie = cookie;
                this._cookieCache[key] = value;
                return this;
            },
            _getFallback: function(key)
            {
                if (!this._cookieCache) {
                    this._initCache();
                }
                return this._cookieCache[key];
            },
            _clearFallback: function()
            {
                for (var i in this._cookieCache) {
                    document.cookie = this._generatePrefix() + i + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                }
                this._cookieCache = {};
            },
            _deleteFallback: function(key)
            {
                document.cookie = this._generatePrefix() + key + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                delete this._cookieCache[key];
            },
            get: function(key)
            {
                return window.sessionStorage.getItem(key) || this._getFallback(key);
            },
            set: function(key, value, onceOnly)
            {
                try {
                    window.sessionStorage.setItem(key, value);
                } catch (e) {}
                this._setFallback(key, value, onceOnly || false);
                return this;
            },
            'delete': function(key){
                return this.remove(key);
            },
            remove: function(key)
            {
                try {
                    window.sessionStorage.removeItem(key);
                } catch (e) {};
                this._deleteFallback(key);
                return this;
            },
            _clearSession: function()
            {
                try {
                    window.sessionStorage.clear();
                } catch (e) {
                    for (var i in window.sessionStorage) {
                        window.sessionStorage.removeItem(i);
                    }
                }
            },
            clear: function()
            {
                this._clearSession();
                this._clearFallback();
                return this;
            }
        };
        $.session._init();
    })(jQuery);
</script>
<!--affiliate-->
<a href="#0" class="cd-top">Top</a>
<!-- jQuery -->
<script src="<?= $this->template->Js()?>jquery.rwdImageMaps.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('img[usemap]').rwdImageMaps();
    });
</script>
<!-- Bootstrap Core JavaScript -->
<!-- Scrolling Nav JavaScript -->
<!-- <script src="<?= $this->template->Js()?>jquery-ui.js"></script> -->
<script src="<?= $this->template->Js()?>scrolltotop.js"></script> <!-- Gem jQuery -->

<script type="text/javascript">
    $(".footer-toggle").click(function() {
        $(".footer-hide-menu").toggle( 300, function() {
            // Animation complete.
        });
    });
    function paginationActive(){
        var pagination_active = 0;
        $(".pagination li").each(function(){

            if($(this).attr('class').trim()=="active"){
                pagination_active = 1;
            }
            if(pagination_active == 0){
                $(this).children('a').attr("rel","prev");
            }else{
                $(this).children('a').attr("rel","next");
            }

        })
    }
    paginationActive();
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5917fdcd64f23d19a89b20c2/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();


    $(document).ready(function(){

        setTimeout(function () {
            $("#tawkchat-container").find("iframe").contents().find(".round #tawkchat-minified-wrapper").hide();

        }, 1100);
    });



</script>
<!--End of Tawk.to Script-->
</body>

</html>