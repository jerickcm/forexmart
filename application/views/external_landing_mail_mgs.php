<!DOCTYPE html>
<html lang="<?= FXPP::html_url() ?>" dir="<?= FXPP::lang_dir(); ?>">
<head >

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="google" value="notranslate">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?=(isset($metadata_description))? $metadata_description: '';?>">
    <meta name="keywords" content="<?=(isset($metadata_keyword))? $metadata_keyword: '';?>">
    <meta name="google-site-verification" content="hUTbDLfEPfAPqV6xcbcuxv_b8HIjsXKIeBHijGZbZE4" />

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?=lang('fxl_dsc');?>
    </title>
    <link rel="icon" type="image/gif" href="<?= base_url()?>assets/images/icon.ico" />
    <!-- Bootstrap -->

    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/landing_v2/css/bootstrap.min.css" >

    <?php switch(FXPP::html_url()){
        case 'en':
        case '':
            ?>
            <link rel="stylesheet"  href="<?=base_url()?>assets/landing_v2/css/style_e.min.css"/>
            <link rel="stylesheet" href="<?=base_url()?>assets/landing_v2/css/main_e.min.css" />
            <link rel="stylesheet" href="<?=base_url()?>assets/landing_v2/css/component_e.min.css"/>

            <?php break;
        case 'ru': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
         case 'my': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
         case 'id': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
        case 'jp': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
        case 'de': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
        case 'fr': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
        case 'pt': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;
        case 'sk': ?>

            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/main.css" />
            <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/component.css"/>

            <?php break;

    }
    ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- START PARALLAX -->
    <script type="text/javascript" src="<?=base_url()?>assets/landing_v2/js/modernizr.custom.37797.js"></script>
    <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" >!window.jQuery && document.write('<script src="/<?=base_url()?>assets/landing_v2/js/jquery-1.6.1.min.js"><\/script>')</script>
    <!-- END PARALLAX -->

    <!-- SCROLL -->
    <script type="text/javascript">
        $(function () {
            $('#scrollToBottom').bind("click", function () {
                $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                return false;
            });
            $('#scrollToTop').bind("click", function () {
                $('html, body').animate({ scrollTop: 0 }, 1200);
                return false;
            });
        });
    </script>
    <!-- SCROLL -->

    <!-- LOADER -->
    <script type="text/javascript" src="<?=base_url()?>assets/landing_v2/js/main.js"></script>
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/landing_v2/css/main-loader.min.css" />
    <!-- LOADER -->

</head>
<body>
<!-- Google Tag Manager FXPP-2771 -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KHXDKN"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KHXDKN');</script>
<!-- End Google Tag Manager -->

<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-top fx-navbar">
    <div class="container">
        <div class="navbar-header fx-navbar-header">
            <button type="button" class="navbar-toggle collapsed fx-navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="btn-group fx-btn-group secondary-fx-btn-group">
                <a class="btn btn-primary dropdown-toggle fx-btn-primary" data-toggle="dropdown" href="#">
                    < <?php switch(FXPP::html_url()){
                        case 'en':
                        case '':
                            ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/russian.png"  width="30" height="20"/> <!-- english-->
                            <?php break;
                        case 'ru': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/russian.png"  width="30" height="20"/>
                            <?php break;
                        case 'my': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/malaysia.png" width="30" height="20"/>
                            <?php break;
                        case 'id': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/indonesian.png" width="30" height="20"/>
                            <?php break;
                        case 'de': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/germany.png" width="30" height="20"/>
                            <?php break;
                        case 'fr': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/france.png" width="30" height="20"/>
                            <?php break;
                        case 'jp': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/japan.png" width="30" height="20"/>
                            <?php break;
                        case 'sk': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/slovakia.png" width="30" height="20"/>
                            <?php break;
                        case 'pt': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/portugal.png" width="30" height="20"/>
                            <?php break;
                    }
                    ?>
                </a>
                <ul class="dropdown-menu fx-dropdown-menu">
                    <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?=base_url()?>assets/landing_v2/images/flags/english.png" width="30" height="20"/> <span>English</span></a></li>
                    <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?=base_url()?>assets/landing_v2/images/flags/russian.png" width="30" height="20"/> <span>Русский</span></a></li>
                    <?php if(IPLoc::Office()){?>
                    <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img src="<?=base_url()?>assets/landing_v2/images/flags/indonesian.png"/> <span>Indonesian</span></a></li>

                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?=base_url()?>assets/landing_v2/images/flags/malaysia.png"  width="30" height="20"/> <span>Malay</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img src="<?=base_url()?>assets/landing_v2/images/flags/japan.png"  width="30" height="20"/> <span> &#26085;&#26412;&#35486;</span></a></li>
                          <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img src="<?=base_url()?>assets/landing_v2/images/flags/germany.png"  width="30" height="20"/> <span>German</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img src="<?=base_url()?>assets/landing_v2/images/flags/france.png"  width="30" height="20"/> <span> Fran&#231;ais</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img src="<?=base_url()?>assets/landing_v2/images/flags/portugal.png"  width="30" height="20"/> <span>Portuguese</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak"><img src="<?=base_url()?>assets/landing_v2/images/flags/slovakia.png"  width="30" height="20"/> <span>Slovak</span></a></li>

                    <?php }?>
                </ul>
            </div>
            <div class="fx-nav-left">
                <a class="navbar-brand fx-navbar-brand" href="<?= FXPP::loc_url('forexmart-landing')?>"><img src="<?=base_url()?>assets/landing_v2/images/fxlogo.svg" class="img-responsive"/></a>
                <div class="fx-navbar-brand-right ru-navbar-brand-right">
                    <span> <?=lang('fxLan_logoh1');?></span>
                    <span> <?=lang('fxLan_logoh2');?></span>
                </div>
            </div>
            <div class="fx-tagline">
                <span><?=lang('fxLan_logoh1');?></span>
                <span>|</span>
                <span><?=lang('fxLan_logoh2');?></span>
            </div>
        </div>
        <div id="navbar" class="collapse navbar-collapse fx-nav-right">
            <ul class="nav navbar-nav">
                <li>
              <span class="fx-email-span">
                  <a href="mailto:<?=lang('fxLan_topemail');?>?subject=Hi+ForexMart+Team." style="color:black" >
                      <?=lang('fxLan_topemail');?>
                  </a>
              </span>
                    <button href="javascript:;" class="fx-btn fx-feedback-btn ru-fx-feedback-btn" data-toggle="modal" data-target="#popfeedback">
                        <i class="feedback-icon"></i>
                        <label>
                            <?=lang('fxLan_topeFed');?>
                        </label>
                    </button>
                </li>
                <li>
                    <div class="btn-group fx-btn-group">
                        <a class="btn btn-primary dropdown-toggle fx-btn-primary" data-toggle="dropdown" href="#">

                            <?php switch(FXPP::html_url()){
                                case 'en':
                                case '':
                                    ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/russian.png"  width="30" height="20"/> <!--- english--->
                                    <?php break;
                                case 'ru': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/russian.png"  width="30" height="20"/>
                                    <?php break;
                                case 'my': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/malaysia.png" width="30" height="20"/>
                                    <?php break;
                                case 'id': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/indonesian.png" width="30" height="20"/>
                                    <?php break;
                                case 'de': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/germany.png" width="30" height="20"/>
                                    <?php break;
                                case 'fr': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/france.png" width="30" height="20"/>
                                    <?php break;
                                case 'jp': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/japan.png" width="30" height="20"/>
                                    <?php break;
                                case 'sk': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/slovakia.png" width="30" height="20"/>
                                    <?php break;
                                case 'pt': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/portugal.png" width="30" height="20"/>
                                    <?php break;
                            }
                            ?>


                        </a>
                        <ul class="dropdown-menu fx-dropdown-menu">
                            <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?=base_url()?>assets/landing_v2/images/flags/english.png"/> <span>English</span></a></li>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?=base_url()?>assets/landing_v2/images/flags/russian.png"/> <span>Русский</span></a></li>
                            <?php if(IPLoc::Office()){?>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img src="<?=base_url()?>assets/landing_v2/images/flags/indonesian.png"/> <span>Indonesian</span></a></li>


                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?=base_url()?>assets/landing_v2/images/flags/malaysia.png"  width="30" height="20"/> <span>Malay</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img src="<?=base_url()?>assets/landing_v2/images/flags/japan.png"  width="30" height="20"/> <span> &#26085;&#26412;&#35486;</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img src="<?=base_url()?>assets/landing_v2/images/flags/germany.png"  width="30" height="20"/> <span>German</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img src="<?=base_url()?>assets/landing_v2/images/flags/france.png"  width="30" height="20"/> <span> Fran&#231;ais</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img src="<?=base_url()?>assets/landing_v2/images/flags/portugal.png"  width="30" height="20"/> <span>Portuguese</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak"><img src="<?=base_url()?>assets/landing_v2/images/flags/slovakia.png"  width="30" height="20"/> <span>Slovak</span></a></li>

                            <?php }?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<nav id="primary">
    <ul>
        <li>
            <h1><?=lang('fxLan_nav_1');?></h1>
            <a class="get-bonus-content" href="#get-bonus-content">
                <?=lang('x_fxl_01');?>
                <!--View-->
            </a>
        </li>
        <li>
            <h1> <?=lang('fxLan_nav_2');?></h1>
            <a class="register-now-content" href="#register-now-content">
                <?=lang('x_fxl_01');?>
                <!--View-->
            </a>
        </li>
        <li>
            <h1> <?=lang('fxLan_nav_3');?></h1>
            <a class="conditions-trading-content" href="#conditions-trading-content">
                <?=lang('x_fxl_01');?>
                <!--View-->
            </a>
        </li>
        <li>
            <h1><?=lang('fxLan_nav_4');?></h1>
            <a class="partnership-laspalmas-content" href="#partnership-laspalmas-content">
                <?=lang('x_fxl_01');?>
                <!--View-->
            </a>
        </li>
        <li>
            <h1><?=lang('fxLan_nav_5');?></h1>
            <a class="recognition-content" href="#recognition-content">
                <?=lang('x_fxl_01');?>
                <!--View-->
            </a>
        </li>
        <li>
            <h1><?=lang('fxLan_nav_6');?></h1>
            <a class="risk-free-content" href="#risk-free-content">
                <?=lang('x_fxl_01');?>
                <!--View-->
            </a>
        </li>
    </ul>
</nav>

<div class="one">
    <div id="get-bonus-content"  class="first-container">
        <div class="container">
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 first-right-content ru-first-right-content">
                <h2><?=lang('fxLan_bonusc1');?></h2>
                <h1><?=lang('fxLan_bonusc2');?> <span><?=lang('fxLan_bonusc3');?></span></h1>
                <!--<div class="round-icons-container">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                </div>-->
                <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-1">
                            <span></span>
                        </a>
                        <label><?=lang('fxLan_bonusCer1');?></label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-2">
                            <span></span>
                        </a>
                        <label><?=lang('fxLan_bonusCer2');?></label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-3">
                            <span></span>
                        </a>
                        <label><?=lang('fxLan_bonusCer3');?></label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-4">
                            <span></span>
                        </a>
                        <label><?=lang('fxLan_bonusCer4');?></label>
                    </div>
                </div>
                <button class="fx-btn get-bonus-button" href="#register-now-content"><?=lang('fxLan_bonusButtion');?></button>
                <div class="scroll-down">
                    <a href="#register-now-content"></a>
                    <span><?=lang('fxLan_scrollButton');?></span>
                </div>
            </div>
        </div>
    </div>
    <div id="register-now-content"  class="second-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-center-content secondary-center-content">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content secondary-right-content">
                    <div class="note-div">
                        <span><i class="15-sec-note"><img src="<?=base_url()?>assets/landing_v2/images/15-secs-note.png"/></i> <?=lang('fxLan_regi_text6');?></span>
                        <div class="arrow-down"></div>
                    </div>
                    <form id="register" action="" method="post" class="form-horizontal">
                        <input  data-toggle="tooltip" data-placement="top"  title="" type="text" placeholder="<?=lang('fxLan_regi_text7');?>" name="full_name" onkeyup="checkBorder('full_name')"
                                id="full_name"  value="<?=set_value('full_name');?>" class="boxinput second-right-content-input xssCheck" required="required" maxlength="35"/>
                        <input  data-toggle="tooltip" data-placement="top" title="" type="email" placeholder="<?=lang('fxLan_regi_text8');?>"  name="email" id="email"  onkeyup="checkBorder('email')" value="<?=set_value('email');?>" class="boxinput second-right-content-input" required="required"/>
                        <button type="button" class="fx-btn-green ru-padding" onclick="mySubmitFunction()"><?=lang('fxLan_regi_button');?></button>
                        <div class="second-right-content-condition ru-second-right-content-condition" id="condidiv">
                            <input type="checkbox" required="required" value="1" name="condition" id="condition" onclick="checkCondition()"/>
                            <label><?=lang('fxLan_regi_agree1');?><a href="<?= $this->template->pdf()?>Terms and Conditions.pdf" target="_blank" ><?=lang('fxLan_regi_agree2');?></a></label>
                        </div>
                    </form>
                    <button type="button" data-toggle="modal"  id="onbutton" style="display:none">&nbsp;</button>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content ru-second-left-content secondary-left-content">
                    <h1><?=lang('fxLan_regi_text1');?></h1>
                    <h3><?=lang('fxLan_regi_text2');?></h3>
                    <div class="arrow-right-content">
                        <ul>
                            <li><?=lang('fxLan_regi_text3');?></li>
                            <li><?=lang('fxLan_regi_text4');?></li>
                        </ul>
                        <h5><?=lang('fxLan_regi_text5');?></h5>
                        <div class="arrow-right-tail hardicon" ></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div id="conditions-trading-content"  class="third-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 third-center-content">
                <h1><?=lang('fxLan_trading_text1');?></h1>
                <p><?=lang('fxLan_trading_text2');?></p>
                <div class="conditions-content-holder first-conditions-content-holder">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-1.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle1');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-2.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle2');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-3.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle3');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-4.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle4');?></span>
                    </div>
                </div>
                <div class="conditions-content-holder">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-5.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle5');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-6.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle6');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-7.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle7');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=base_url()?>assets/landing_v2/images/conditions-icon-8.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle8');?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  id="partnership-laspalmas-content" class="fourth-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fourth-left-content">
                    <h1><?=lang('fxLan_partner_text1');?></h1>
                    <p><?=lang('fxLan_partner_text2');?></p>
                    <ul>
                        <li><label>1</label><span><?=lang('fxLan_partner_text3');?></span></li>
                        <li><label>2</label><span><?=lang('fxLan_partner_text4');?></span></li>
                        <li><label>3</label><span><?=lang('fxLan_partner_text5');?></span></li>
                        <li><label>4</label><span><?=lang('fxLan_partner_text6');?></span></li>
                    </ul>
                    <a href="javascript:;"><?=lang('fxLan_partner_text7');?></a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fourth-right-content bg-img-laspalmas">
                    <img src="<?=base_url()?>assets/landing_v2/images/ud-laspalmas-logo.png" width="" class="img-responsive"/>
                </div>
            </div>
        </div>
        <div class="fourth-container-secondary-bg">
            <img src="<?=base_url()?>assets/landing_v2/images/udlaspalmas-bg.png" class="img-responsive"/>
        </div>
        <div class="fourth-center-content">
            <div class="fourth-center-child ru-fourth-center-child container">
                <div class="quote-icon"></div>
                <p>
                    <?=lang('fxLan_partner_text8');?>
                </p>
                <span><?=lang('fxLan_partner_text9');?></span>
            </div>
        </div>
    </div>
    <div id="recognition-content"  class="fifth-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
                <h1><?=lang('fxLan_world_text1');?></h1>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">
                    <?php switch(FXPP::html_url()){
                        case 'en': case '': ?>
                            <img src="<?=base_url()?>assets/landing_v2/images/award-1en.png" width="376" height="354" class="img-responsive"/>
                            <?php break; case 'ru': ?>
                            <img src="<?=base_url()?>assets/landing_v2/images/award-1.png" width="376" height="354" class="img-responsive"/>
                            <?php break; }?>

                    <span><?=lang('fxLan_world_text2');?></span>
                    <div class="awards-box"><span><?=lang('fxLan_world_text3');?></span></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">

                    <?php switch(FXPP::html_url()){
                        case 'en': case '': ?>
                            <img src="<?=base_url()?>assets/landing_v2/images/award-2en.png" width="376" height="354" class="img-responsive"/>
                            <?php break; case 'ru': ?>
                            <img src="<?=base_url()?>assets/landing_v2/images/award-2.png" width="376" height="354" class="img-responsive"/>
                            <?php break; }?>
                    <span><?=lang('fxLan_world_text4');?></span>
                    <div class="awards-box"><span><?=lang('fxLan_world_text5');?></span></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
                <p><?=lang('fxLan_world_text6');?></p>
            </div>
        </div>
    </div>
    <div id="risk-free-content"  class="sixth-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-center-content">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content ru-second-left-content">
                    <h1><?=lang('fxLan_regi_text1');?>
                    </h1>
                    <h3><?=lang('fxLan_regi_text2');?>
                    </h3>
                    <div class="arrow-right-content ru-arrow-right-content">
                        <ul>
                            <li><?=lang('fxLan_regi_text3');?></li>
                            <li><?=lang('fxLan_regi_text4');?></li>
                        </ul>
                        <h5><?=lang('fxLan_regi_text5');?></h5>
                        <div class="arrow-right-tail ru-arrow-right-tail hardicon"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content">
                    <div class="note-div">
                        <span><i class="15-sec-note"><img src="<?=base_url()?>assets/landing_v2/images/15-secs-note.png"/></i> <?=lang('fxLan_regi_text6');?></span>
                        <div class="arrow-down"></div>
                    </div>

                    <form id="registerf" action="" method="post" class="form-horizontal">

                        <input  data-toggle="tooltip" data-placement="top" title="" type="text" placeholder="<?=lang('fxLan_regi_text7');?>" name="full_name" onkeyup="checkBorderf('full_namef')"
                                id="full_namef"  value="<?=set_value('full_name');?>" class="boxinputf second-right-content-input xssCheck" required="required" maxlength="35"/>
                        <input  data-toggle="tooltip" data-placement="top"  title="" type="email" placeholder="<?=lang('fxLan_regi_text8');?>"  name="email" id="emailf"
                                onkeyup="checkBorderf('emailf')" value="<?=set_value('email');?>" class="boxinputf second-right-content-input" required="required"/>
                        <button type="button" class="fx-btn-green ru-padding" onclick="mySubmitFunctionf()"><?=lang('fxLan_regi_button');?></button>
                        <div class="second-right-content-condition ru-second-right-content-condition" id="condidivf">
                            <input type="checkbox" required="required" value="1" name="condition" id="conditionf" onclick="checkConditionf()"/>
                            <label><?=lang('fxLan_regi_agree1');?><a href="<?= $this->template->pdf()?>Terms and Conditions.pdf" target="_blank"><?=lang('fxLan_regi_agree2');?></a></label>
                        </div>
                    </form>
                    <button type="button" data-toggle="modal" id="onbuttonf" style="display:none">&nbsp;</button>

                </div>
            </div>
        </div>
    </div>
    <div class="seven-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 seven-center-content">
                <ul>
                    <li><p><?=lang('fxLan_footer_text1');?></p></li>
                    <li><a href="<?= $this->template->pdf()?>Privacy Policy.pdf" target="_blank"><?=lang('fxLan_footer_text2');?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-child-content-holder">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 footer-child-content">
                    <p><?=lang('fxLan_footer_text3');?></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-child-content">
                    <img src="<?=base_url()?>assets/landing_v2/images/mifid-img.png" width="180" height="80"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" two successful-registration" style="width:100%;">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body-registration">
            <img class="img-responsive" src="<?=base_url()?>assets/landing_v2/images/check-icon.png" width="200" height="200">
            <h3>
                <?=lang('x_fxl_18');?>
                <!--                        Email containing your activation link has been-->
            </h3>
            <h3>
                <?=lang('x_fxl_19');?>
                <!--                        sent to -->
                <b id="popboxem"></b>
            </h3>
            <p>
                <?=lang('x_fxl_20');?>
                <!--                        To accomplish the registration, activate your account through the email that you indicated-->
            </p>
                    <span>
                        <?=lang('x_fxl_21');?>
                        <!--                        Any question left? Please, ask us!-->
                    </span>
            <a href="javascript:;">bonuses@forexmart.com</a>
        </div>
    </div>
</div>
<div class="two seven-container number-container">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 seven-center-content">
            <ul>
                <li><p><?=lang('fxLan_footer_text1');?></p></li>
                <li><a href="<?= $this->template->pdf()?>Privacy Policy.pdf" target="_blank"><?=lang('fxLan_footer_text2');?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="footer two">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-child-content-holder">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 footer-child-content">
                <p><?=lang('fxLan_footer_text3');?></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-child-content">
                <img src="<?=base_url()?>assets/landing_v2/images/mifid-img.png" width="180" height="80"/>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?=base_url()?>assets/landing_v2/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(".dropdown-menu li a").click(function(){
        var IMGSRC = $(this).find('img').attr('src');
        $('#img-src').attr('src',IMGSRC);
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
    });
</script>

</body>
</html>




<!-- Modal -->
<!--  <div class="modal fade" id="myModal" role="dialog" style="top: 30vh;">
    <div class="modal-dialog">

       Modal content
      <div class="modal-content">

        <div class="modal-body">

            <p style="text-align: center;">
                <b style="color:green;"><?=lang('fxl_01');?></b>
                <br> <?=lang('fxl_02');?> <b id="popboxem"></b>

               </p>

        </div>
        <div class="modal-footer" style="height: 43px; padding: 3px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">
              <?=lang('x_fxl_17');?>
          </button>
        </div>
      </div>

    </div>
  </div>-->


<!-- modal -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/feedback.css" />
<div class="modal fade popfeedback" id="popfeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog round-0 feedback-modal-container">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">
                    <img src="<?=base_url()?>assets/landing_v2/images/fxlogonew.svg" class="img-reponsive feedback-logo">
                </div>
            </div>
            <div class="modal-body">
                <p class="fback-first-line">
                    <?=lang('x_fxl_02');?>
                    <!--                        Good day! We'd love to hear your feedback about your Account.-->
                    </br><small>
                        <?=lang('x_fxl_03');?>
                        <!--                            How would you rate your experience on a scale of 1-10?-->
                    </small>
                </p>
                <!-- class="rate-line">
                    <small>How would you rate your experience on a scale of 1-10?</small>
                </p>-->
                <div class="row">
                    <div class="col-sm-12 scale">
                        <div class="feedback-rate-holder">
                            <p>
                                <?=lang('x_fxl_04');?>
                                <!--                                    1 - Poor-->
                            </p>
                            <p>
                                <?=lang('x_fxl_05');?>
                                <!--                                    10 - Excellent-->
                            </p>
                            <ul class="feedback-rate-list" id="listRating">
                                <li>
                                    <input type="radio" id="c1" name="rating" value="1" class="rad rating">
                                    <label for="c1">1</label>
                                </li>
                                <li>
                                    <input type="radio" id="c2"  name="rating" value="2" class="rad rating">
                                    <label for="c2">2</label>
                                </li>
                                <li>
                                    <input type="radio" id="c3"  name="rating" value="3" class="rad rating">
                                    <label for="c3">3</label>
                                </li>
                                <li>
                                    <input type="radio" id="c4"  name="rating" value="4" class="rad rating">
                                    <label for="c4">4</label>
                                </li>
                                <li>
                                    <input type="radio" id="c5"  name="rating" value="5" class="rad rating">
                                    <label for="c5">5</label>
                                </li>
                                <li>
                                    <input type="radio" id="c6"  name="rating" value="6" class="rad rating">
                                    <label for="c6">6</label>
                                </li>
                                <li>
                                    <input type="radio" id="c7"  name="rating" value="7" class="rad rating">
                                    <label for="c7">7</label>
                                </li>
                                <li>
                                    <input type="radio" id="c8" name="rating" value="8" class="rad rating">
                                    <label for="c8">8</label>
                                </li>
                                <li>
                                    <input type="radio" id="c9"  name="rating" value="9" class="rad rating">
                                    <label for="c9">9</label>
                                </li>
                                <li>
                                    <input type="radio" id="c10"  name="rating" value="10" class="rad rating">
                                    <label for="c10">10</label>
                                </li><div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="fback-second-line">
                    </br>
                    <small>
                        <?=lang('x_fxl_06');?>
                        <!--                            Should you have any specific feedback, please select a category below.(optional)-->
                    </small>
                </p>
                <div class="row">
                    <div class="col-xs-8">
                        <form class="form-horizontal">
                            <div class="form-group feedback-modal-group">
                                <label class="col-sm-3 control-label lblcat">
                                    <?=lang('x_fxl_07');?>
                                    <!--                                        Category-->
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control round-0" id="category" >
                                        <option value="Problem">
                                            <?=lang('x_fxl_08');?>
                                            <!--                                                Problem-->
                                        </option>
                                        <option value="Suggestion">
                                            <?=lang('x_fxl_09');?>
                                            <!--                                                Suggestion-->
                                        </option>
                                        <option value="Compliment">
                                            <?=lang('x_fxl_10');?>
                                            <!--                                                Compliment-->
                                        </option>
                                        <option value="Other">
                                            <?=lang('x_fxl_11');?>
                                            <!--                                                Other-->
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <textarea rows="5" class="form-control round-0" id="message"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" class="btn btn-default round-0" data-dismiss="modal" id="cancel">
                    <?=lang('x_fxl_12');?>
                    <!--                        Cancel-->
                </button>
                <button type="button" class="btn btn-primary round-0" onclick="sendFeedback()">
                    <?=lang('x_fxl_13');?>
                    <!--                        Send Feedback-->
                </button>
            </div>
        </div>
    </div>
</div>

<button href="javascript:;"  data-toggle="modal" data-target="#popfeedbacktwo" style="display:none" id="hiddenPopId"></button>



<div class="modal fade popfeedback" id="popfeedbacktwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog round-0 feedback-modal-container">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">
                    <img src="<?=base_url()?>assets/landing_v2/images/fxlogonew.svg" class="img-reponsive feedback-logo">
                </div>
            </div>
            <div class="modal-body">

                <p class="fback-first-line" style="    color: green;font-size: 17px;   text-align: center;">
                    <b>
                        <?=lang('x_fxl_14');?>
                        <!--                            Thanks for the Feedback-->
                    </b>
                </p>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <p>
                                <b>
                                    <?=lang('fxLan_feadb_02');?>

                                </b>
                            </p>
                            <p>
                                <?=lang('fxLan_feadb_03');?>

                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?=lang('x_fxl_16')?>
                            <!--                                Email: -->
                            <input type="email" class="form-control round-0" size="50" maxlength="100" id="feadback_email">
                            <input type="hidden" id="feadback_email_id"/>
                        </div>
                    </div>

                </div>


            </div>

     

                <div class="modal-footer round-0 popfooter">
                    <button class="btn btn-default round-0" value="true" id="button_feedback" type="button" > <?=lang('fxLan_feadb_04');?></button>
                    <button class="btn btn-default round-0 " aria-label="Close" data-dismiss="modal" id="dismisclose" type="button">
                        <?=lang('x_fxl_17');?>
                        <!-- Close-->
                    </button>

                </div>
           
        </div>
    </div>

</div>
<!-- end modal -->

<style type="text/css">
    .two{ display: none;}

    .arrow-right-content ul li:lang(ru){
        font-size: 12px!important;
    }
    @-moz-document url-prefix() {
        .arrow-right-content ul li:lang(ru) {
            top: -.45px !important;
        }
    }
    @media screen and (max-width: 493px){
        .ru-padding:lang(ru) {
            padding: 10px 0px!important;
        }
    }
    .recarpet{top:-2px !important;}



    /*----- FULLSCREEN MODAL -----*/
    .fullscreen-modal-registration {
        padding:0!important;
        background-size:cover;
    }

    .modal-backdrop.in {
        opacity:0.8!important;
    }

    .fullscreen-modal-registration , .fullscreen-modal-registration .modal-dialog , .fullscreen-modal-registration .modal-content {
        height:100%;
    }

    .fullscreen-modal-registration .modal-content {
        width:100%;
        background:none;
        border-radius:0;
        margin:0 auto;
        box-shadow:none;
        border:none;
    }

    .fullscreen-modal-registration .modal-header {
        border-bottom:0;
    }

    .fullscreen-modal-registration .close {
        opacity:1.0!important;
        outline:none;
        text-shadow:none!important;
    }

    .fullscreen-modal-registration .close span {
        font-size:40px!important;
        color:#fff!important;
    }

    .fullscreen-modal-registration .close span:hover {
        color:#e0e0e0!important;
    }

    .modal-footer-registration {
        position:absolute;
        bottom:0;
    }

    .modal-body-registration img {
        margin:0 auto;
        margin-top:30px;
        margin-bottom:20px;
    }

    .modal-body-registration h3 , .modal-body-registration p , .modal-body-registration span , .modal-body-registration a {
        color:#fff;
        text-align:center;
    }

    .modal-body-registration h3 {
        font-size:40px;
        background:#29a64a;
        padding:15px 25px;
        display:table;
        margin:7px auto;
    }

    .modal-body-registration p {
        font-size:20px;
        margin-top:40px;
        margin-bottom:30px;
    }

    .modal-body-registration span {
        font-size:15px;
        display:block;
    }

    .modal-body-registration a {
        font-size:20px;
        display:block;
        text-decoration:underline!important;
    }

    .fullscreen-modal .modal-dialog {
        margin:0 auto;
        width: 100%!important;
    }

    @media (min-width: 1200px) {
        .fullscreen-modal .modal-dialog {
            width: 1170px;
        }
    }

    @media (min-width: 992px) {
        .fullscreen-modal .modal-dialog {
            width: 970px;
        }
    }

    @media (min-width: 768px) {
        .fullscreen-modal .modal-dialog {
            width: 750px;
        }

    }

    .second-right-content-input{   text-align: center !important;}

    .recarpet{top:-2px !important;}
    @media only screen and (max-width: 400px) {
        .feedback-logo {
            width: 210px !important;
        }
    }


    @media only screen and (max-width: 305px) {
        .feedback-logo {
            width: 160px !important;  }
    }

</style>

<script type="application/javascript">
    $('.one').hide();
    $('.two').show();
    $(".one").css("display", "none!important");
    $(".two").css("display", "block!important");
    $('#primary').hide()
    $("#primary").css("display", "none!important");
    var emailf='<?=$_SESSION['landing_email']?>';
    $("#popboxem").html(emailf);
    
    
    
    
    
    
    
    
   
   
    function sendFeedback()
    {
        var ratingval="";
        $("#listRating li").each(function(){
            if($(this).find('.rating').is(':checked')){ratingval=$(this).find('.rating').val();}

        }) ;

        var category=$("#category").val();
        var message=$("#message").val();


        if(ratingval==="")
        {
            alert("Please select a rate.");
        }
        else
        {



            var url='<?php echo site_url()?>';
            $.post(url+'thirty-percent-bonus-landing/Feedback',{message:message,category:category,rating:ratingval},function(view){

                if(view==="error")
                {
                    alert(" Sending Failed. Please try again");
                }
                else
                {
                    document.getElementById("cancel").click();
                    document.getElementById("hiddenPopId").click();
                    $('.rating').prop('checked', false);
                    $("#message").val("");
                    $("#feadback_email_id").val(view);
                }

            });

        }

    }

   
   
   $(document).on("click","#button_feedback",function(){

        var fid=parseInt($("#feadback_email_id").val());
        var feadback_email=$("#feadback_email").val();
        var checkemail=isEmail(feadback_email);



        if(checkemail==true)
        {
            $('#loader-holder').show();



            var url='<?php echo site_url()?>';
            $.post(url+'thirty-percent-bonus-landing/feadBackEmailStore',{fid:fid,email:feadback_email},function(views){

                $("#feadback_email_id").val("");
                $("#feadback_email").val("");
                $('#loader-holder').hide();
                document.getElementById("dismisclose").click();



            });


        }
        else
        {
            $('#loader-holder').hide();
            alert("<?=lang('fxLan_feadb_01');?>");
        }




    });


   
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);

}
   
    
    
    
    
</script>

