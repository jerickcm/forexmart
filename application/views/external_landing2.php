<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ForexMart | Landing</title>
    <link rel="icon" type="image/gif" href="<?= base_url()?>assets/images/icon.ico" />
    <!-- Bootstrap -->
    <link href="<?=base_url()?>assets/landing/css/bootstrap.min.css" rel="stylesheet">






    <?php switch(FXPP::html_url()){
        case 'en':
        case '':
            ?>
            <link href="<?=base_url()?>assets/landing/css/style_e.css" rel="stylesheet" type="text/css"/>
            <link href="<?=base_url()?>assets/landing/css/main_e.css" rel="stylesheet" type="text/css"/>
            <link href="<?=base_url()?>assets/landing/css/component_e.css" rel="stylesheet" type="text/css"/>

            <?php break;
        case 'ru': ?>

            <link href="<?=base_url()?>assets/landing/css/style.css" rel="stylesheet" type="text/css"/>
            <link href="<?=base_url()?>assets/landing/css/main.css" rel="stylesheet" type="text/css"/>
            <link href="<?=base_url()?>assets/landing/css/component.css" rel="stylesheet" type="text/css"/>


            <?php break;

    }
    ?>




    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- START PARALLAX -->
    <script src="<?=base_url()?>assets/landing/js/modernizr.custom.37797.js"></script>
    <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script>!window.jQuery && document.write('<script src="/<?=base_url()?>assets/landing/js/jquery-1.6.1.min.js"><\/script>')</script>
    <script src="<?=base_url()?>assets/landing/js/parallax.js"></script>
    <!-- END PARALLAX -->

    <!-- SCROLL -->
    <script type = "text/javascript">
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
    <script src="<?=base_url()?>assets/landing/js/main.js"></script>
    <link href="<?=base_url()?>assets/landing/css/main-loader.css" rel="stylesheet" type="text/css"/>
    <!-- LOADER -->

</head>
<body>
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
                    
                    <?php switch(FXPP::html_url()){
                        case 'en':
                        case '':
                            ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/english.png" width="30" height="20"/>
                            <?php break;
                        case 'ru': ?>
                            <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/russian.png" width="30" height="20"/>
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
                    <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?=base_url()?>assets/landing/images/flags/english.png"/> <span>English</span></a></li>
                    <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?=base_url()?>assets/landing/images/flags/russian.png"/> <span>Русский</span></a></li>
                    <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?=base_url()?>assets/landing/images/flags/malaysia.png"/> <span>Malaysia</span></a></li>
                </ul>
            </div>
            <div class="fx-nav-left">
                <a class="navbar-brand fx-navbar-brand" href="#"><img src="<?=base_url()?>assets/landing/images/fxlogo.svg" class="img-responsive"/></a>
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
                    <span class="fx-email-span"><?=lang('fxLan_topemail');?></span>
                    <button href="javascript:;" class="fx-btn fx-feedback-btn ru-fx-feedback-btn">
                        <i class="feedback-icon"></i>
                        <label><?=lang('fxLan_topeFed');?></label>
                    </button>
                </li>
                <li>
                    <div class="btn-group fx-btn-group">
                        <a class="btn btn-primary dropdown-toggle fx-btn-primary" data-toggle="dropdown" href="#">

                            <?php switch(FXPP::html_url()){
                                case 'en':
                                case '':
                                    ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/english.png" width="30" height="20"/>
                                    <?php break;
                                case 'ru': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/landing_v2/images/flags/russian.png" width="30" height="20"/>
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
                            <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?=base_url()?>assets/landing/images/flags/english.png"/> <span>English</span></a></li>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?=base_url()?>assets/landing/images/flags/russian.png"/> <span>Русский</span></a></li>
                             <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?=base_url()?>assets/landing/images/flags/malaysia.png"/> <span>Malaysia</span></a></li>
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
            <a class="get-bonus-content" href="#get-bonus-content">View</a>
        </li>
        <li>
            <h1> <?=lang('fxLan_nav_2');?></h1>
            <a class="register-now-content" href="#register-now-content">View</a>
        </li>
        <li>
            <h1> <?=lang('fxLan_nav_3');?></h1>
            <a class="conditions-trading-content" href="#conditions-trading-content">View</a>
        </li>
        <li>
            <h1><?=lang('fxLan_nav_4');?></h1>
            <a class="partnership-laspalmas-content" href="#partnership-laspalmas-content">View</a>
        </li>
        <li>
            <h1><?=lang('fxLan_nav_5');?></h1>
            <a class="recognition-content" href="#recognition-content">View</a>
        </li>
        <li>
            <h1><?=lang('fxLan_nav_6');?></h1>
            <a class="risk-free-content" href="#risk-free-content">View</a>
        </li>
    </ul>
</nav>

<div>
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
                        <div class="arrow-right-tail ru-arrow-right-tail"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content">
                    <div class="note-div">
                        <span><i class="15-sec-note"><img src="<?=base_url()?>assets/landing/images/15-secs-note.png"/></i> <?=lang('fxLan_regi_text6');?></span>
                        <div class="arrow-down"></div>
                    </div>

                    <form id="register" action="" method="post" class="form-horizontal">
                        <input type="text" placeholder="<?=lang('fxLan_regi_text7');?>" name="full_name" onkeyup="checkBorder('full_name')" id="full_name"  value="<?=set_value('full_name');?>" class="boxinput second-right-content-input" required="required"/>
                        <input type="email" placeholder="<?=lang('fxLan_regi_text8');?>"  name="email" id="email"  onkeyup="checkBorder('email')" value="<?=set_value('email');?>" class="boxinput second-right-content-input" required="required"/>
                        <button type="button" class="fx-btn-green" onclick="mySubmitFunction()"><?=lang('fxLan_regi_button');?></button>
                        <div class="second-right-content-condition" id="condidiv">
                            <input type="checkbox" required="required" value="1" name="condition" id="condition" onclick="checkCondition()"/>
                            <label><?=lang('fxLan_regi_agree1');?><a href="javascript:;"><?=lang('fxLan_regi_agree2');?></a></label>
                        </div>
                    </form>
                    <button type="button" data-toggle="modal" data-target="#myModal" id="onbutton" style="display:none">&nbsp;</button>


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
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-1.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle1');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-2.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle2');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-3.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle3');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-4.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle4');?></span>
                    </div>
                </div>
                <div class="conditions-content-holder">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-5.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle5');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-6.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle6');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-7.png" class="wobble"/>
                        <span><?=lang('fxLan_trading_cercle7');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ">
                        <img src="<?=base_url()?>assets/landing/images/conditions-icon-8.png" class="wobble"/>
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
                    <img src="<?=base_url()?>assets/landing/images/ud-laspalmas-logo.png" width="" class="img-responsive"/>
                </div>
            </div>
        </div>
        <div class="fourth-container-secondary-bg">
            <img src="<?=base_url()?>assets/landing/images/udlaspalmas-bg.png" class="img-responsive"/>
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
                    <img src="<?=base_url()?>assets/landing/images/award-1.png" width="376" height="354" class="img-responsive"/>
                    <span><?=lang('fxLan_world_text2');?></span>
                    <div class="awards-box"><span><?=lang('fxLan_world_text3');?></span></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">
                    <img src="<?=base_url()?>assets/landing/images/award-2.png" width="376" height="354" class="img-responsive"/>
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
                        <div class="arrow-right-tail ru-arrow-right-tail"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content">
                    <div class="note-div">
                        <span><i class="15-sec-note"><img src="<?=base_url()?>assets/landing/images/15-secs-note.png"/></i> <?=lang('fxLan_regi_text6');?></span>
                        <div class="arrow-down"></div>
                    </div>

                    <form id="registerf" action="" method="post" class="form-horizontal">
                        <input type="text" placeholder="<?=lang('fxLan_regi_text7');?>" name="full_name" onkeyup="checkBorderf('full_namef')" id="full_namef"  value="<?=set_value('full_name');?>" class="boxinputf second-right-content-input" required="required"/>
                        <input type="email" placeholder="<?=lang('fxLan_regi_text8');?>"  name="email" id="emailf"  onkeyup="checkBorderf('emailf')" value="<?=set_value('email');?>" class="boxinputf second-right-content-input" required="required"/>
                        <button type="button" class="fx-btn-green" onclick="mySubmitFunctionf()"><?=lang('fxLan_regi_button');?></button>
                        <div class="second-right-content-condition" id="condidivf">
                            <input type="checkbox" required="required" value="1" name="condition" id="conditionf" onclick="checkConditionf()"/>
                            <label><?=lang('fxLan_regi_agree1');?><a href="javascript:;"><?=lang('fxLan_regi_agree2');?></a></label>
                        </div>
                    </form>
                    <button type="button" data-toggle="modal" data-target="#myModal" id="onbuttonf" style="display:none">&nbsp;</button>

                </div>
            </div>
        </div>
    </div>

    <div class="seven-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 seven-center-content">
                <ul>
                    <li><p><?=lang('fxLan_footer_text1');?></p></li>
                    <li><a href="javascript:;"><?=lang('fxLan_footer_text2');?></a></li>
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
                    <img src="<?=base_url()?>assets/landing/images/mifid-img.png" width="180" height="80"/>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=base_url()?>assets/landing/js/bootstrap.min.js"></script>
<script>
    $(".dropdown-menu li a").click(function(){
        var IMGSRC = $(this).find('img').attr('src');
        $('#img-src').attr('src',IMGSRC);
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
    });
</script>
</body>
</html>




<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="top: 30vh;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">

                <p style="text-align: center;">
                    <b style="color:green;"><?=lang('fxl_01');?></b>
                    <br> <?=lang('fxl_02');?> <b id="popboxem"></b>

                </p>

            </div>
            <div class="modal-footer" style="height: 43px; padding: 3px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">

    function checkCondition()
    {

        if($("#condition").is(':checked'))
        {
            $('#condidiv').removeAttr('style');
        }


    }

    function mySubmitFunction()
    {

        $('#condidiv').css('border','1px solid none');
        $('.boxinput').css('border','1px solid white');


        var url='<?=base_url()?>';
        var full_name=$("#full_name").val();
        var email=$("#email").val();
        var condition=$("#condition").val();

        full_name=full_name.trim();
        email=email.trim();

        if(full_name!="" && email !="")
        {


            var checkemail=isEmail(email);
            if(checkemail==true)
            {


                if($("#condition").is(':checked'))
                {

                    var url='<?php echo base_url()?>';
                    $.post(url+'register/landingRgistration',{email:email,full_name:full_name,condition:condition},function(view){
                        console.log(view);
                        if(view==404)
                        {
                            alert("Registration failed please try again.");
                        }
                        else if(view==405)
                        {
                            alert("Wrong email address");
                            $("#email").css('border','1px solid red');
                        }
                        else
                        {
                            document.getElementById("onbutton").click();

                            $("#full_name").val("");
                            $("#email").val("");
                            $("#condition").prop('checked',false);
                            $('.boxinput').css('border','1px solid white');
                            $('.condition').css('border','1px solid white');
                            $("#popboxem").html(email);
                        }
                    });


                }
                else
                {
                    // alert(" You must agree with the Terms of Service. ");
                    $('#condidiv').css('border','1px solid red');
                }



            }
            else
            {
                $("#email").css('border','1px solid red');
                alert("Wrong email address");
            }







        }
        else
        {
            if(full_name=="" && email =="")
            {
                alert("Enter your Full name and Email");
                $('.boxinput').css('border','1px solid red');
            }
            else
            {
                if(full_name==""){$("#full_name").css('border','1px solid red'); alert("Enter your Full name ");}
                if(email==""){$("#email").css('border','1px solid red'); alert("Enter your Email");}
                return false;
            }
        }



    }

    function checkBorder(id)
    {
        $("#"+id).css('border','1px solid white');

    }




    /// from 2

    function checkConditionf()
    {

        if($("#conditionf").is(':checked'))
        {
            $('#condidivf').removeAttr('style');
        }


    }

    function mySubmitFunctionf()
    {

        $('#condidivf').css('border','1px solid none');
        $('.boxinputf').css('border','1px solid white');


        var url='<?=base_url()?>';
        var full_namef=$("#full_namef").val();
        var emailf=$("#emailf").val();
        var conditionf=$("#conditionf").val();

        full_namef=full_namef.trim();
        emailf=emailf.trim();

        if(full_namef!="" && emailf !="")
        {

            var checkemail =isEmail(emailf);
            if(checkemail==true)
            {
                if($("#conditionf").is(':checked'))
                {

                    var url='<?php echo base_url()?>';
                    $.post(url+'register/landingRgistration',{email:emailf,full_name:full_namef,condition:conditionf},function(view){
                        console.log(view);
                        if(view==404)
                        {
                            alert("Registration failed please try again.");
                        }
                        else if(view==405)
                        {
                            alert("Wrong email address");
                            $("#emailf").css('border','1px solid red');
                        }
                        else
                        {
                            document.getElementById("onbuttonf").click();

                            $("#full_namef").val("");
                            $("#emailf").val("");
                            $("#conditionf").prop('checked',false);
                            $('.boxinputf').css('border','1px solid white');
                            $('#conditionf').css('border','1px solid white');
                            $("#popboxem").html(emailf);
                        }
                    });


                }
                else
                {
                    // alert(" You must agree with the Terms of Service. ");
                    $('#condidivf').css('border','1px solid red');
                }
            }
            else
            {
                $("#emailf").css('border','1px solid red');
                alert("Wrong email address");
            }







        }
        else
        {
            if(full_namef=="" && emailf =="")
            {
                alert("<?=lang('fxl_03');?>");
                $('.boxinputf').css('border','1px solid red');
            }
            else
            {
                if(full_namef==""){$("#full_namef").css('border','1px solid red'); alert("Enter your Full name ");}
                if(emailf==""){$("#emailf").css('border','1px solid red'); alert("Enter your Email");}
                return false;
            }
        }



    }

    function checkBorderf(id)
    {
        $("#"+id).css('border','1px solid white');

    }


    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);

    }





    function getWindowSizeGet()
    {

        var myWidth = 0, myHeight = 0;
        if( typeof( window.innerWidth ) == 'number' ) {
            //Non-IE
            myWidth = window.innerWidth;
            myHeight = window.innerHeight;
        } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
            //IE 6+ in 'standards compliant mode'
            myWidth = document.documentElement.clientWidth;
            myHeight = document.documentElement.clientHeight;
        } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
            //IE 4 compatible
            myWidth = document.body.clientWidth;
            myHeight = document.body.clientHeight;
        }
        //window.alert( 'Width = ' + myWidth );
        return myWidth;


    }




</script>
