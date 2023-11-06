<?php
    $site_my = "https://my.forexmart.com/";
    $site_www = "https://www.forexmart.com/";
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forexmart - Error (404)</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link href="<?= $site_www?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="<?= $site_www?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $site_www?>assets/css/external-style.css" rel="stylesheet">
    <link href="<?= $site_www?>assets/css/carousel.css" rel="stylesheet">
    <link href="<?= $site_www?>assets/css/custom.css" rel="stylesheet">
    <script src="<?= $site_www?>assets/js/jquery-1.11.3.min.js"></script>
    <!-- Custom CSS -->
    <link href="<?= $site_www?>assets/css/exscrolling-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(window).bind('scroll', function() {
            if ($(window).scrollTop() > 95) {
                $('#nav').addClass('nav-fix');
            }
            else {
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
        });
    </script>
    <script type="text/javascript">
        $(window).bind('scroll', function() {
            if ($(window).scrollTop() > 75) {
                $('#nav').addClass('nav-fix');
            }
            else {
                $('#nav').removeClass('nav-fix');
            }
        });
    </script>
    <style>
        .error-img{
            float: left!important;
        }
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
        .tradomart {
            margin-bottom: 3px;
            padding: 0px !important;
        }



        .enav,
        .enav a,
        .enav ul,
        .enav li,
        .enav div,
        .enav form,
        .enav input {
            margin: 0;
            padding: 0;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .enav a { text-decoration: none; }

        .enav li { list-style: none; }


        .enav {
            display: inline-block;
            position: relative;
            cursor: default;
            z-index: 500;
        }

        .enav > li {
            display: block;
            float: left;
        }


        .enav > li > a {
            font-family: Georgia;
            font-size: 17px;
            font-weight: 400;
            position: relative;
            display: block;
            z-index: 510;
            height: 50px;
            padding: 0 20px;
            line-height: 54px;


            color: #fcfcfc;

            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -o-transition: all .3s ease;
            -ms-transition: all .3s ease;
            transition: all .3s ease;
        }


        .enav > li:hover > a {
            background: #319ae3;
        }

        .enav > li:first-child > a {
            border-radius: 3px 0 0 3px;
            border-left: none;
        }


        .enav > li > div {
            background: #ffffff;
            border-radius: 0 0 3px 3px;
            max-height: 0;
            -webkit-transition: max-height 1s;
            -moz-transition: max-height1s;
            transition: max-height 1s;
            -o-transition: max-height 1s;
            -ms-transition: max-height 1s;

            position: fixed;

            width: 100%;
            left: 0;
            opacity: 0;
            visibility: hidden;
            overflow: hidden;
        }

        .enav > li:hover > div {
            max-height: 500px;
            opacity: 1;
            visibility: visible;
            height  :auto;
        }
        .inner-menu-panel{
            border-bottom: 5px solid #D7DCE0 !important;
            left: 0px !important;
        }


        .adjustment{
            top: 10px;
        }

        .border_bottom{
            border-bottom:2px solid #d7dce0;
        }

        .sub-menu > li:first-child a {
            border: 0px none;
        }
        .sub-menu > li:first-child a {
            border: 0px none;
        }

        .submenumain  ul {
            padding-top: 20px!important;
        }
        .sub-menu > li > a{
            border-left: 1px solid #9CAEBE;
            vertical-align: middle;
            padding: 0px 20px;
        }

        .submenutopic{
            font-weight: bold;
            color: #23527C;
        }

        .subtopic{
            color: #00A4DB;
            padding: 4px 20px !important;
        }

        .submenumain{
            float: left;
            padding-right: 40px !important;
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }
        .submenumain > ul >li {
            padding: 6px 0px;
        }
        .submenumain{
            border-left: 1px solid #9CAEBE;
        }
        .nav-fix > div.inner-menu-panel{
            top: 60px;!important;
        }

        .sub-menu {
            margin: 0px auto !important;
            overflow: hidden;
        }

        @media (min-width: 800px) {
            .sub-menu {
                width: 700px;
            }
        }
        @media (min-width: 970px) {
            .sub-menu {
                width: 1150px;
            }
        }
        @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
        }
        .btn-livedemo {
            margin-top: 30px;
            text-align: center;
            width: 100%;
        }
        .btn-livedemo {
            text-align: center;
        }
        .btn-real {
            background: transparent none repeat scroll 0% 0%;
            border: 1px solid #29A643;
            color: #29A643;
            padding: 7px 0px;
            width: 250px;
            transition: all 0.3s ease 0s;
        }
        .form-inline .form-group {
            display: inline-block;
            margin-bottom: 0px;
            vertical-align: middle;
        }
        .btn-demo {
            text-decoration: none !important;
            background: transparent none repeat scroll 0% 0%;
            border: 1px solid #2988CA;
            color: #2988CA;
            padding: 7px 0px;
            width: 250px;
            transition: all 0.3s ease 0s;
        }
        .error-bot {
            margin-bottom: 70px;
        }
        .nolinkline{
            outline: none;
        }
    </style>
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-default nd" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

                <img src="<?= $site_www?>assets/images/new-logo.svg" class="img-reponsive logo"  usemap="#fxxpplaspalmas">
                <map name="fxxpplaspalmas">
                    <area shape="rect" coords="0,0,217,69" href="<?= $site_www?>" alt="ForexMart" class="nolinkline">
                    <area shape="rect" coords="217,0,434,69" href="<?= $site_www?>las-palmas" alt="LasPalmas" class="nolinkline">
                </map>

            <div class="clearfix"></div>
        </div>
        <div class="reg-holder">
            <ul class="nav navbar-nav navbar-right ryt">
                <li><a href="<?= $site_my?>" target="_blank" class="login-external"><button class="btn-reg">Login</button></a></li>
                <li><a href="<?= $site_www?>register" target="_blank" class="login-external"><button class="btn-login">Register</button></a></li>
                <li><button class="btn-reg"><img src="<?= $site_www?>assets/images/flag.png" width="30px"/></button></li>
            </ul>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>




<div id="nav" class="nav-holder">
    <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav nn fx-navbar" id="">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a class="page-scroll" href="#page-top"></a>
                </li>
                <li class="page-link" data-target="#about">
                    <a class="page-scroll" href="#about">ABOUT</a>
                    <div class="fx-drp" id="about">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>about-us">About ForexMart</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>why-choose-us"><img src="<?= $site_www?>assets/images/choose-icon.png" class="links-icon"> Why Choose us</a></li>
                                <li><a href="<?= $site_www?>deposit-withdraw-page"><img src="<?= $site_www?>assets/images/wd-icon.png" class="links-icon"> Deposit/Withdrawal</a></li>
                                <li><a href="<?= $site_www?>licence-and-regulations"><img src="<?= $site_www?>assets/images/lr-icon.png" class="links-icon"> License and regulations</a></li>
                                <li><a href="<?= $site_www?>account-verification"><img src="<?= $site_www?>assets/images/av-icon.png" class="links-icon"> Account Verification</a></li>
                                <li><a href="<?= $site_www?>las-palmas"><img src="<?= $site_www?>assets/images/las-icon.png" class="links-icon"> UD Las Palmas</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#fx">
                    <a class="page-scroll" href="#services">TRADING</a>
                    <div class="fx-drp" id="fx">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>account-type">Account Types</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>demo-account"><img src="<?= $site_www?>assets/images/demo-icon.png" class="links-icon"> Demo Account</a></li>
                                <li><a href="<?= $site_www?>live-account"><img src="<?= $site_www?>assets/images/standard-icon.png" class="links-icon"> ForexMart Standard</a></li>
                                <li><a href="<?= $site_www?>live-account"><img src="<?= $site_www?>assets/images/standard-icon.png" class="links-icon"> ForexMart Zero Spread</a></li>
                                <li><a href="<?= $site_www?>account-type"><img src="<?= $site_www?>assets/images/acct-com-icon.png" class="links-icon"> Accounts Comparison</a></li>
                                <div class="clearfix"></div>
                            </ul>
                            <div class="nav-line"></div> <!-- line -->
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>">Trading Platforms</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>metatrader4"><img src="<?= $site_www?>assets/images/mt4-icon.png" class="links-icon"> ForexMart MT4</a></li>
                                <div class="clearfix"></div>
                            </ul>
                            <div class="nav-line"></div> <!-- line -->
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>financial-instruments">Instruments</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>financial-instruments/forex"><img src="<?= $site_www?>assets/images/forex-icon.png" class="links-icon"> Forex</a></li>
                                <li><a href="<?= $site_www?>financial-instruments/shares"><img src="<?= $site_www?>assets/images/share-icon.png" class="links-icon"> Shares</a></li>
                                <li><a href="<?= $site_www?>financial-instruments/spots"><img src="<?= $site_www?>assets/images/sm-icon.png" class="links-icon"> Spot Metals</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#bo">
                    <a class="page-scroll" href="#contact">BONUSES &#38; OFFERS</a>
                    <div class="fx-drp" id="bo">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>bonuses">Bonuses</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>thirty-percent-bonus"><img src="<?= $site_www?>assets/images/wbonus-icon.png" class="links-icon"> Welcome bonus 30%</a></li>
                                <li><a href="<?= $site_www?>no-deposit-bonus"><img src="<?= $site_www?>assets/images/ndbonus-icon.png" class="links-icon"> No deposit bonus</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#ps">
                    <a class="page-scroll" href="#services">PARTNERSHIP</a>
                    <div class="fx-drp" id="ps">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>">Affiliate Program</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>partnership/advantages"><img src="<?= $site_www?>assets/images/choose-icon.png" class="links-icon"> Advantages</a></li>
                                <li><a href="<?= $site_www?>affiliate-link"><img src="<?= $site_www?>assets/images/al-icon.png" class="links-icon"> Affiliate link</a></li>
                                <li><a href="<?= $site_www?>commission-specification"><img src="<?= $site_www?>assets/images/cs-icon.png" class="links-icon"> Commission specification</a></li>
                                <div class="clearfix"></div>
                            </ul>
                            <div class="nav-line"></div> <!-- line -->
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>types-of-partnership">Types of Partnership</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>partnership/friend-referrer"><img src="<?= $site_www?>assets/images/fr-icon.png" class="links-icon"> Friend-referrer</a></li>
                                <li><a href="<?= $site_www?>partnership/webmaster"><img src="<?= $site_www?>assets/images/web-icon.png" class="links-icon"> Webmaster</a></li>
                                <li><a href="<?= $site_www?>partnership/online-partner"><img src="<?= $site_www?>assets/images/ol-icon.png" class="links-icon"> Online partner</a></li>
                                <li><a href="<?= $site_www?>partnership/local-online-partner"><img src="<?= $site_www?>assets/images/local-icon.png" class="links-icon"> Local online partner</a></li>
                                <li><a href="<?= $site_www?>partnership/local-office-partner"><img src="<?= $site_www?>assets/images/office-icon.png" class="links-icon"> Local office partner</a></li>
                                <div class="clearfix"></div>
                            </ul>
                            <div class="nav-line"></div> <!-- line -->
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>">Partnership registration</a>
                            </div>
                            <div class="nav-line"></div> <!-- line -->
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>">Materials</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>banners"><img src="<?= $site_www?>assets/images/banner-icon.png" class="links-icon"> Banners</a></li>

                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#cts">
                    <a class="page-scroll" href="<?= $site_www?>money-fall">CONTESTS</a>
                </li>
                <li class="page-link" data-target="#tools">
                    <a class="page-scroll" href="#services">TOOLS</a>
                    <div class="fx-drp" id="tools">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder">
                                <a href="<?= $site_www?>">Tools</a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?= $site_www?>vps-hosting"><img src="<?= $site_www?>assets/images/hosting-icon.png" class="links-icon"> VPS Hosting</a></li>
                                <li><a href="<?= $site_www?>"><img src="<?= $site_www?>assets/images/chart-icon.png" class="links-icon"> Forex Chart</a></li>

                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#supt">
                    <a class="page-scroll" href="#contact">SUPPORT</a>
                    <div class="fx-drp" id="supt">
                        <div class="fx-drp-grid">
                            <ul class="fx-drp-link-sub">
                                <li><a href="<?= $site_www?>contact-us">Contact us</a></li>
                                <li><a href="<?= $site_www?>faq">FAQ</a></li>
                                <li><a href="<?= $site_www?>legal-documentation">Legal Documentation</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right search-ryt">
                <li>
                    <form class="navbar-form navbar-left search-form" role="search">
                        <div class="form-group">
                            <div class="input-group" id="headerAll" ></div>
                        </div>
                    </form>
                </li>
            </ul>

            <div class="btn-top-holder">
                <ul class="nav navbar-nav navbar-right ryt">
                    <li><button class="btn-reg1">Login</button></li>
                    <li><button class="btn-login1">Register</button></li>
                    <li><button class="btn-reg1"><img src="<?= $site_www?>assets/images/flag.png" width="30px"/></button></li>
                </ul>
            </div>

        </div>
    </div>
</div>



<div class="not-found-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-centered">
                <div class="not-found">
                    <div class="row">
                        <div class="col-sm-3 error-img">
                            <img src="<?= $site_www?>assets/images/404.png" class="img-responsive">
                        </div>
                        <div class="col-sm-9 error-content-holder">
                            <h1 class="error-title">Error (404)</h1>
                            <p class="error-text">
                                We can't find the page you're looking for. Check out our <a href="<?= $site_www?>faq">FAQ</a> for help,<br>or go to <a href="<?= $site_www?>">Home page</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="red-line"></div>
        <div class="btn-livedemo error-bot ">
            <form class="form-inline">
                <div class="form-group">
                    <a href="<?= $site_www?>register" class="col-sm-6 btn-real">
                        Open Trading Account
                    </a>
                </div>
                <div class="form-group">
                    <a href="<?= $site_www?>register/demo" class="col-sm-6 btn-demo">
                        Open Demo Account
                    </a>
                </div>
                <div class="form-group">
                    <label>Risk Warning: Trading CFDs involves significant risk of loss.</label>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end content -->
<style>
    .bot-nav li a {
        padding: 15px 6px !important;
    }
    .trademart {
        margin-bottom: 3px;
        padding: 0px !important;
    }
    .ver-line {
        padding: 15px 8px !important;
    }
</style>
<div class="bot-nav-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7 footer-menu-holder">
                <div class="footer-toggle-holder">
                    <button type="button" class="footer-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="footer-hide-menu">
                    <ul>
                        <li><a href="<?= $site_www?>legal-documentation">Legal documentation</a></li>
                        <li><a href="<?= $site_www?>risk-disclosure">Risk disclosure</a></li>
                        <li><a href="<?= $site_www?>privacy-policy">Privacy Policy</a></li>
                        <li><a href="<?= $site_www?>terms-and-conditions">Terms &#38; Conditions</a></li>


                    </ul>
                </div>
                <ul class="bot-nav">
                    <li><a href="<?= $site_www?>legal-documentation">Legal documentation</a></li>
                    <li class="ver-line">|</li>
                    <li><a href="<?= $site_www?>risk-disclosure">Risk disclosure</a></li>
                    <li class="ver-line">|</li>
                    <li><a href="<?= $site_www?>privacy-policy">Privacy Policy</a></li>
                    <li class="ver-line">|</li>
                    <li><a href="<?= $site_www?>terms-and-conditions">Terms &#38; Conditions</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 copy">
<!--                <p>&copy; 2015 <img  width="101px" height="11px" class="trademart" src="--><?//= $site_www?><!--/assets/images/tradomart/tradomart-ltd-small-white.png" /></p>-->
            </div>
            <div class="col-sm-3">
                <ul class="connect">
                    <li>
                        <a href="<?= $site_www?>contact-us"><i class="fa fa-phone phone"></i> Contact Us</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-comments"></i> Live Chat</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- footer -->
<style>
    .tradomart {
        margin-bottom: 3px;
        padding: 0px !important;
    }
</style>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <p class="footer-text">
                    <cite>Risk Warning:</cite> Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by <span class="company">ForexMart</span>, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.
                </p>
                <p class="footer-text1">
                    <span class="company">ForexMart</span> is a trading name of <img class="tradomart" width="101px" height="10px"  src="<?= $site_www?>assets/images/tradomart/tradomart-ltd-small-black.png" />, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.
                </p>
                <p class="footer-text1">
                    <span class="company">ForexMart</span> doesn't offer its services to residents of certain jurisdictions such as the USA, North Korea, Myanmar, Sudan and Syria.
                </p>
            </div>
            <div class="col-sm-3 sec">
                <a target="_blank" href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/"><img src="<?= $site_www?>assets/images/cysec.png" class="img-responsive cysec"></a>
                <a target="_blank" href="http://ec.europa.eu/finance/securities/isd/mifid/index_en.htm"><img src="<?= $site_www?>assets/images/mifid.png" class="img-responsive mifid"></a>
            </div>
        </div>
    </div>
</footer>

<div class="copyright-holder">
    <div class="container">
        <div class="row">
            <div class="col-md-9 copy">
                <p>&copy; 2015 <img class="tradomart" width="101px" height="11px"  src="<?= $site_www?>assets/images/tradomart/tradomart-ltd-small-black.png" /></p>
            </div>
            <div class="col-md-3 social-media-holder">
                <ul class="social-media">
                    <li><a href="https://www.facebook.com/ForexMart" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/ForexMartPage" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://plus.google.com/+Forexmartpage" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- end footer -->

<!-- jQuery -->
<!--<script src="js/jquery.js"></script>-->

<!-- Bootstrap Core JavaScript -->
<!--<script src="js/bootstrap.min.js"></script>-->

<!-- Scrolling Nav JavaScript -->
<!--<script src="js/jquery.easing.min.js"></script>-->
<!--<script src="js/scrolling-nav.js"></script>-->
<script type="text/javascript">
    $(".footer-toggle").click(function() {
        $(".footer-hide-menu").toggle( 300, function() {
            // Animation complete.
        });
    });
</script>
<script type="text/javascript" data-cfasync="false">(function () { var done = false;var script = document.createElement('script');script.async = true;script.type = 'text/javascript';script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';document.getElementsByTagName('HEAD').item(0).appendChild(script);script.onreadystatechange = script.onload = function (e) {if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {var w = new PCWidget({ c: '9cb3f575-0990-4efd-8c8d-a150521451f9', f: true });done = true;}};})();</script>
</body>

</html>
