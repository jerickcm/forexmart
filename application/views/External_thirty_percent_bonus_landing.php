<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="google" value="notranslate">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=lang('title');?></title>
    <link rel="icon" type="image/gif" href="<?= base_url()?>assets/images/icon.ico" />
    <!-- Bootstrap -->
    <link href="<?=$baseLink?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$baseLink?>css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?=$baseLink?>css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
    <link href="<?=$baseLink?>css/feedback-style.css" rel="stylesheet" type="text/css"/>
    <link href="<?=$baseLink?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?=$baseLink?>css/component.css" rel="stylesheet" type="text/css"/>
    <!--    <script src="<?=$baseLink?>js/bootstrap-modal.js"></script>-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- START PARALLAX -->
    <script src="<?=$baseLink?>js/modernizr.custom.37797.js"></script>
    <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
    <!--      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> -->
    <script>!window.jQuery && document.write('<script src="<?=$baseLink?>/js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="<?=$baseLink?>js/parallax.js"></script>
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
    <script src="<?=$baseLink?>js/main.js"></script>
    <link href="<?=$baseLink?>css/main-loader.css" rel="stylesheet" type="text/css"/>
    <!-- LOADER -->

    <!-- TOOLTIP -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <!-- TOOLTIP -->
    <?php if(!IPLoc::isChinaIP()){ ?>
        <?php if(IPLoc::Office()){ ?>
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-MRVPP5L');
            </script>
        <?php }else{ ?>
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-KHXDKN');
            </script>
        <?php } ?>
    <?php } ?>
</head>

<body>

<?php if(!IPLoc::isChinaIP()){ ?>
        <?php if(isset($_SESSION['user_id'])){ $ga_user_id =(string) $_SESSION['user_id']; ?>

            <script type="text/javascript">
                var usrid ='<?=$ga_user_id;?>';
                usrid='88'.concat(usrid).concat('88');
                dataLayer = [{'userID': usrid.toString()}];
            </script>

        <?php }else if(isset($_COOKIE['forexmart_gtm_id'])){ ?>

            <script type="text/javascript">
                var usrid ='<?=$_COOKIE['forexmart_gtm_id'];?>';
                usrid='88'.concat(usrid).concat('88');
                dataLayer = [{'userID': usrid.toString()}];
            </script>

        <?php } ?>

        <?php if(IPLoc::Office()){ ?>
            <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MRVPP5L" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <?php }else{ ?>
            <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KHXDKN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <?php } ?>

<?php } ?>

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
                <a class="btn btn-primary dropdown-toggle fx-btn-primary" data-toggle="dropdown" href="#"><img id="img-src" src="<?=$this->template->Images()?>flags/<?=$flag;?>"/> <!--<span class="caret"></span>--></a>
                <ul class="dropdown-menu fx-dropdown-menu">
                    <li>
                        <a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english">
                            <img src="<?=$this->template->Images()?>flags/english.png"  width="30" height="20"/>
                            <span>English</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan">
                            <img src="<?=$this->template->Images()?>flags/russia.png"  width="30" height="20"/>
                            <span>Русский</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish">
                            <img src="<?=$this->template->Images()?>flags/spain.png"  width="30" height="20"/>
                            <span>Español</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german">
                            <img src="<?=$this->template->Images()?>flags/germany.png"  width="30" height="20"/>
                            <span>German</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese">
                            <img src="<?=$this->template->Images()?>flags/portugal.png"  width="30" height="20"/>
                            <span>Portuguese</span>
                        </a>
                    </li>
                    <?php $this->load->library('IPLoc', null);
                    if(IPLoc::Office_and_Vpn()){?>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay">
                                <img src="<?=$this->template->Images()?>flags/malaysia.png"  width="30" height="20"/>
                                <span>Malay</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese">
                                <img src="<?=$this->template->Images()?>flags/japan.png"  width="30" height="20"/>
                                <span> &#26085;&#26412;&#35486;</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian">
                                <img src="<?=$this->template->Images()?>flags/indonesia.png"  width="30" height="20"/>
                                <span>Indonesian</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french">
                                <img src="<?=$this->template->Images()?>flags/france.png"  width="30" height="20"/>
                                <span> Fran&#231;ais</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak">
                                <img src="<?=$this->template->Images()?>flags/slovakia.png"  width="30" height="20"/>
                                <span>Slovak</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/urdu"><img src="<?=base_url()?>assets/images/flags/pakistan.png"  width="30" height="20"/> <span>Urdu</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/polish"><img src="<?=base_url()?>assets/images/flags/poland.png"  width="30" height="20"/> <span>Polish</span>
                            </a>
                        </li>
                    <?php }?>
                </ul>
            </div>
            <div class="fx-nav-left">
                <a class="navbar-brand fx-navbar-brand" href="#"><img src="<?=$baseLink?>images/fxlogo.svg" class="img-responsive"/></a>
                <div class="fx-navbar-brand-right ru-navbar-brand-right">
                    <span><?=lang('hd_1');?></span>
                    <span><?=lang('hd_2');?></span>
                </div>
            </div>
            <div class="fx-tagline">
                <span><?=lang('hd_1');?></span>
                <span>|</span>
                <span><?=lang('hd_2');?></span>
            </div>
        </div>
        <div id="navbar" class="collapse navbar-collapse fx-nav-right">
            <ul class="nav navbar-nav">
                <li>
                <span class="fx-email-span">

                   <a href="mailto:<?=lang('fb_email_1');?>?subject=Hi+ForexMart+Team." style="color:black" >
                       <?=lang('fb_email_1');?>
                   </a>

                </span>
                    <button href="javascript:;" class="fx-btn fx-feedback-btn ru-fx-feedback-btn" data-toggle="modal" data-target="#popfeedback">
                        <i class="feedback-icon"></i>
                        <label><?=lang('hd_fd');?></label>
                    </button>
                </li>
                <li>
                    <div class="btn-group fx-btn-group">
                        <a class="btn btn-primary dropdown-toggle fx-btn-primary" data-toggle="dropdown" href="#"><img id="img-src" src="<?=$this->template->Images()?>flags/<?=$flag;?>"/> <!--<span class="caret"></span>--></a>
                        <ul class="dropdown-menu fx-dropdown-menu">
                            <!--      <li><a href="#"><img src="<?=$baseLink?>images/flags/english.png"/> <span>English</span></a></li>
                  <li><a href="#"><img src="<?=$baseLink?>images/flags/russian.png"/> <span>Ру�?�?кий</span></a></li>
				  -->
                            <li>
                                <a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english">
                                    <img src="<?=$this->template->Images()?>flags/english.png"  width="30" height="20"/>
                                    <span>English</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan">
                                    <img src="<?=$this->template->Images()?>flags/russia.png"  width="30" height="20"/>
                                    <span>Русский</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish">
                                    <img src="<?=$this->template->Images()?>flags/spain.png"  width="30" height="20"/>
                                    <span>Español</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german">
                                    <img src="<?=$this->template->Images()?>flags/germany.png"  width="30" height="20"/>
                                    <span>German</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese">
                                    <img src="<?=$this->template->Images()?>flags/portugal.png"  width="30" height="20"/>
                                    <span>Portuguese</span>
                                </a>
                            </li>
                            <?php $this->load->library('IPLoc', null);
                            if(IPLoc::Office_and_Vpn()){?>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay">
                                        <img src="<?=$this->template->Images()?>flags/malaysia.png"  width="30" height="20"/>
                                        <span>Malay</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese">
                                        <img src="<?=$this->template->Images()?>flags/japan.png"  width="30" height="20"/>
                                        <span> &#26085;&#26412;&#35486;</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian">
                                        <img src="<?=$this->template->Images()?>flags/indonesia.png"  width="30" height="20"/>
                                        <span>Indonesian</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french">
                                        <img src="<?=$this->template->Images()?>flags/france.png"  width="30" height="20"/>
                                        <span> Fran&#231;ais</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak">
                                        <img src="<?=$this->template->Images()?>flags/slovakia.png"  width="30" height="20"/>
                                        <span>Slovak</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/bulgarian">
                                        <img src="<?=$this->template->Images()?>flags/bulgaria.png"  width="30" height="20"/>
                                        <span>Bulgarian</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/urdu"><img src="<?=base_url()?>assets/images/flags/pakistan.png"  width="30" height="20"/> <span>Urdu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/polish"><img src="<?=base_url()?>assets/images/flags/poland.png"  width="30" height="20"/> <span>Polish</span>
                                    </a>
                                </li>
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
            <h1><?=lang('slide_1');?></h1>
            <a class="get-bonus-content" href="#get-bonus-content">View</a>
        </li>
        <li>
            <h1><?=lang('slide_2');?></h1>
            <a class="register-now-content" href="#register-now-content">View</a>
        </li>
        <li>
            <h1><?=lang('slide_3');?></h1>
            <a class="conditions-trading-content" href="#conditions-trading-content">View</a>
        </li>
        <li>
            <h1><?=lang('slide_4');?></h1>
            <a class="partnership-laspalmas-content" href="#partnership-laspalmas-content">View</a>
        </li>
        <li>
            <h1><?=lang('slide_5');?></h1>
            <a class="rpj-racing-sponsor-content" href="#rpj-racing-sponsor-content">View</a>
        </li>
        <li>
            <h1><?=lang('slide_6');?></h1>
            <a class="recognition-content" href="#recognition-content">View</a>
        </li>
        <li>
            <h1><?=lang('slide_7');?></h1>
            <a class="risk-free-content" href="#risk-free-content">View</a>
        </li>
    </ul>
</nav>

<div>
    <div id="get-bonus-content"  class="first-container">
        <div class="container">
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 first-right-content first-right-content-v2 ru-first-right-content">
                <h2><?=lang('page_1_1');?></h2>
                <h1><?=lang('page_1_2');?></h1>
                <span class="secondary-first-right-content"><?=lang('page_1_3');?></span>
                <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a ru-hi-icon-wrap">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-1">
                            <span></span>
                        </a>
                        <label><?=lang('page_1_4');?></label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child hi-icon-child-v2 ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-2">
                            <span></span>
                        </a>
                        <label><?=lang('page_1_5');?></label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child hi-icon-child-v2 ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-3">
                            <span></span>
                        </a>
                        <label><?=lang('page_1_6');?></label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child hi-icon-child-v2 ru-hi-icon-child">
                        <a href="#set-3" class="hi-icon adv-43">
                            <span style="background: url(https://www.forexmart.com/assets/thirty_percent_bonus_landing/images/advantage-icon-4.png); margin: 20px auto;"></span>
                        </a>
                        <label><?=lang('page_1_7');?></label>
                    </div>
                </div>
                <button class="fx-btn get-bonus-button" href="#register-now-content"><?=lang('page_1_8');?></button>
                <div class="scroll-down scroll-down-v2 ru-scroll-down">
                    <a href="#register-now-content"></a>
                    <span><?=lang('page_1_9');?></span>
                </div>
            </div>
        </div>
    </div>

    <div id="register-now-content"  class="second-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-center-content secondary-center-content">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content secondary-right-content">
                    <div class="note-div">
                        <span><i class="15-sec-note"><img src="<?=$baseLink?>images/15-secs-note.png"/></i><?=lang('page_2_1');?></span>
                        <div class="arrow-down"></div>
                    </div>
                    <form id="register" action=""   method="post" class="form-horizontal" >
                        <input type="text" placeholder="<?=lang('page_2_2');?>"  name="full_name" onkeyup="checkBorder('full_name')" id="full_name"  value="<?=set_value('full_name');?>"
                               class="xssCheck second-right-content-input tooltip-style" data-toggle="tooltip" data-placement="top" title="<?=lang('page_2_18');?>"/>
                        <input type="text" placeholder="<?=lang('page_2_3');?>" name="email" id="email"  onkeyup="checkBorder('email')"
                               value="<?=set_value('email');?>" class="second-right-content-input tooltip-style" data-toggle="tooltip" data-placement="top" title="<?=lang('page_2_19');?>"/>
                        <button  id="actionTopButton"type="button" class="fx-btn-green ru-fx-btn-green"><?=lang('page_2_4');?></button>
                        <div class="second-right-content-condition ru-second-right-content-condition" id="conditionTop">
                            <input type="checkbox" required="required" value="1"  name="condition" id="condition" onclick="checkCondition()"/>
                            <label><?=lang('page_2_5');?><a href="<?= $this->template->pdf()?>Terms and Conditions.pdf" target="_blank"><?=lang('page_2_6');?></a></label>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content secondary-second-left-content ru-second-left-content secondary-left-content">
                    <h2><?=lang('page_2_7');?>
                        </br><?=lang('page_2_8');?>
                        </br><?=lang('page_2_9');?>
                    </h2>
                    <h3><?=lang('page_2_10');?>
                        </br><?=lang('page_2_11');?>
                    </h3>
                    <div class="non-arrow-right-content">
                        <ul>
                            <li>
                                <label><?=lang('page_2_12');?></label>
                                <span><?=lang('page_2_13');?></span>
                            </li>
                            <li>
                                <label><?=lang('page_2_14');?></label>
                                <span><?=lang('page_2_15');?></span>
                            </li>
                            <li>
                                <label class="secondary-last-label"><?=lang('page_2_16');?></label>
                                <span><?=lang('page_2_17');?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="conditions-trading-content"  class="third-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 third-center-content">
                <h2><?=lang('page_3_1');?></h2>
                <p><?=lang('page_3_2');?></p>
                <div class="conditions-content-holder first-conditions-content-holder">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-1.png" class="wobble"/>
                        <span><?=lang('page_3_3');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-2.png" class="wobble"/>
                        <span><?=lang('page_3_4');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-3.png" class="wobble"/>
                        <span><?=lang('page_3_5');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-4.png" class="wobble"/>
                        <span><?=lang('page_3_6');?></span>
                    </div>
                </div>
                <div class="conditions-content-holder">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-5.png" class="wobble"/>
                        <span><?=lang('page_3_7');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-6.png" class="wobble"/>
                        <span><?=lang('page_3_8');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-7.png" class="wobble"/>
                        <span><?=lang('page_3_9');?></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                        <img src="<?=$baseLink?>images/conditions-icon-8.png" class="wobble"/>
                        <span><?=lang('page_3_10');?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div  id="partnership-laspalmas-content" class="fourth-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fourth-left-content">
                    <h2><?=lang('page_4_1');?></h2>
                    <p><?=lang('page_4_2');?></p>
                    <ul>
                        <li><label>1</label><span><?=lang('page_4_3');?></span></li>
                        <li><label>2</label><span><?=lang('page_4_4');?></span></li>
                        <li><label>3</label><span><?=lang('page_4_5');?></span></li>
                        <li><label>4</label><span><?=lang('page_4_6');?></span></li>
                    </ul>
                    <a href="javascript:;"><?=lang('page_4_7');?></a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fourth-right-content bg-img-laspalmas">
                    <img src="<?=$baseLink?>images/ud-laspalmas-logo.png" width="" class="img-responsive"/>
                </div>
            </div>
        </div>
        <div class="fourth-container-secondary-bg">
            <img src="<?=$baseLink?>images/udlaspalmas-bg.jpg" class="img-responsive"/>
        </div>
        <div class="fourth-center-content">
            <div class="fourth-center-child ru-fourth-center-child container">
                <div class="quote-icon"></div>
                <p>
                    <?=lang('page_4_8');?>
                </p>
                <span><label><?=lang('page_4_9');?></label> <?=lang('page_4_10');?></span>
            </div>
        </div>
    </div>

    <div  id="rpj-racing-sponsor-content" class="fourth-and-half-container">
        <div class="container">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fourth-and-half-content">
                <h1><?=lang('page_5_1');?></h1>
                <p><?=lang('page_5_2');?></p>
            </div>
        </div>
    </div>

    <div id="recognition-content"  class="fifth-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
                <h2><?=lang('page_6_1');?></h2>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fifth-content-child">
                    <img src="<?=$baseLink?>images/award-1.png" width="376" height="354" class="img-responsive"/>
                    <span><?=lang('page_6_2');?></span>
                    <div class="awards-box"><span><?=lang('page_6_3');?> </br>2015</span></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fifth-content-child">
                    <img src="<?=$baseLink?>images/award-2.png" width="376" height="500" class="img-responsive"/>
                    <span><?=lang('page_6_4');?></span>
                    <div class="awards-box"><span><?=lang('page_6_5');?></span></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fifth-content-child">
                    <img src="<?=$baseLink?>images/award-3.png" width="376" height="354" class="img-responsive"/>
                    <span><?=lang('page_6_6');?></span>
                    <div class="awards-box"><span><?=lang('page_6_7');?></span></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
                <p><?=lang('page_6_8');?></p>
            </div>
        </div>
    </div>

    <div id="risk-free-content"  class="sixth-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-center-content secondary-center-content">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content secondary-right-content">
                    <div class="note-div">
                        <span><i class="15-sec-note"><img src="<?=$baseLink?>images/15-secs-note.png"/></i> <?=lang('page_7_1');?></span>
                        <div class="arrow-down"></div>
                    </div>
                    <form id="registerBottom" action=""   method="post" class="form-horizontal" >
                        <input type="text" placeholder="<?=lang('page_7_2');?>" name="full_name" onkeyup="checkBorder('full_nameBottom')" id="full_nameBottom"  value="<?=set_value('full_name');?>" class="xssCheck second-right-content-input tooltip-style"
                               data-toggle="tooltip" data-placement="top" title="<?=lang('page_7_18');?>"/>
                        <input type="text" placeholder="<?=lang('page_7_3');?>" name="email" id="emailbottom"  onkeyup="checkBorder('emailbottom')" value="<?=set_value('email');?>"
                               class="second-right-content-input tooltip-style" data-toggle="tooltip" data-placement="top" title="<?=lang('page_7_19');?>"/>
                        <button type="button" id="actionBottomButton" class="fx-btn-green ru-fx-btn-green"><?=lang('page_7_4');?></button>
                        <div class="second-right-content-condition ru-second-right-content-condition" id="conditionBottom">
                            <input type="checkbox" value="1" id="conditionb" onclick="checkConditionBottom()"/>
                            <label><?=lang('page_7_5');?><a href="<?= $this->template->pdf()?>Terms and Conditions.pdf" target="_blank"><?=lang('page_7_6');?></a></label>
                        </div>
                    </form>


                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content secondary-second-left-content ru-second-left-content secondary-left-content">
                    <h2><?=lang('page_7_7');?>
                        </br><?=lang('page_7_8');?>
                        </br><?=lang('page_7_9');?>
                    </h2>
                    <h3><?=lang('page_7_10');?>
                        </br><?=lang('page_7_11');?>
                    </h3>
                    <div class="non-arrow-right-content">
                        <ul>
                            <li>
                                <label><?=lang('page_7_12');?></label>
                                <span><?=lang('page_7_13');?></span>
                            </li>
                            <li>
                                <label><?=lang('page_7_14');?></label>
                                <span><?=lang('page_7_15');?></span>
                            </li>
                            <li>
                                <label class="secondary-last-label"><?=lang('page_7_16');?></label>
                                <span><?=lang('page_7_17');?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="seven-container number-container">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 seven-center-content">
                <ul>
                    <li><p><?=lang('page_8_1');?></p></li>
                    <li><a href="<?= $this->template->pdf()?>Privacy Policy.pdf" target="_blank"><?=lang('page_8_2');?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-child-content-holder">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 footer-child-content">
                    <p><?=lang('page_8_3');?></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-child-content">
                    <img src="<?=$baseLink?>images/mifid-img.png" width="180" height="80"/>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <?=lang('page_fedb_1');?>
                    <!--                        Good day! We'd love to hear your feedback about your Account.-->
                    </br><small>
                        <?=lang('page_fedb_2');?>
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
                                <?=lang('page_fedb_3');?>
                                <!--                                    1 - Poor-->
                            </p>
                            <p>
                                <?=lang('page_fedb_4');?>
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
                        <?=lang('page_fedb_5');?>
                        <!--                            Should you have any specific feedback, please select a category below.(optional)-->
                    </small>
                </p>
                <div class="row">
                    <div class="col-xs-8">
                        <form class="form-horizontal">
                            <div class="form-group feedback-modal-group">
                                <label class="col-sm-3 control-label lblcat">
                                    <?=lang('page_fedb_6');?>
                                    <!--                                        Category-->
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control round-0" id="category">
                                        <option value="Problem">
                                            <?=lang('page_fedb_7');?>
                                            <!--                                                Problem-->
                                        </option>
                                        <option value="Suggestion">
                                            <?=lang('page_fedb_8');?>
                                            <!--                                                Suggestion-->
                                        </option>
                                        <option value="Compliment">
                                            <?=lang('page_fedb_9');?>
                                            <!--                                                Compliment-->
                                        </option>
                                        <option value="Other">
                                            <?=lang('page_fedb_10');?>
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
                    <?=lang('page_fedb_11');?>
                    <!--                        Cancel-->
                </button>
                <button type="button" class="btn btn-primary round-0" onclick="sendFeedback()">
                    <?=lang('page_fedb_12');?>
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
                        <?=lang('page_fedb_13');?>
                        <!--                            Thanks for the Feedback-->
                    </b>
                </p>


                <div class="row" style="color:black">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <p>
                                <b>
                                    <?=lang('page_fedb_14');?>

                                </b>
                            </p>
                            <p>
                                <?=lang('page_fedb_15');?>

                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?=lang('page_fedb_16')?>
                            <!--                                Email: -->
                            <input type="email" class="form-control round-0" size="50" maxlength="100" id="feadback_email">
                            <input type="hidden" id="feadback_email_id"/>
                        </div>
                    </div>

                </div>


            </div>


            <div class="modal-footer round-0 popfooter">
                <button class="btn btn-default round-0" value="true" id="button_feedback" type="button" > <?=lang('page_fedb_17');?></button>
                <button class="btn btn-default round-0 " aria-label="Close" data-dismiss="modal" id="dismisclose" type="button">
                    <?=lang('page_fedb_18');?>
                    <!-- Close-->
                </button>

            </div>

        </div>
    </div>

</div>




<!-- end modal -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=$baseLink?>js/bootstrap.min.js"></script>
<script>
    $(".dropdown-menu li a").click(function(){
        var IMGSRC = $(this).find('img').attr('src');
        $('#img-src').attr('src',IMGSRC);
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
    });
</script>
</body>


</html>

<style>
    .second-right-content-input{ color:black; text-align:center;}

</style>
<script type="text/javascript">


    $(document).on("keydown",".xssCheck",function(e){
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,32, 110, 190]) !== -1 ||
            // Allow: Ctrl+A,Ctrl+C,Ctrl+V, Command+A
            ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.shiftKey==true || e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if (((e.keyCode < 65 || e.keyCode > 90)) ) {
            $(this).attr("data-original-title","<?=lang('page_mgs_1');?>");
            e.preventDefault();
        }
        else
        {
            $(this).attr("data-original-title","");
        }

    });


    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }


    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);

    }

    function checkBorder(id)
    {
        $("#"+id).css('border','1px solid white');
        if(id=="email"){
            $("#email").attr("data-original-title","");
        }
        if(id=="emailbottom"){
            $("#emailbottom").attr("data-original-title","");
        }

    }

    function checkCondition() {
        if($("#condition").is(':checked'))
        {
            $('#conditionTop').removeAttr('style');
        }

    }

    function checkConditionBottom() {
        if($("#conditionb").is(':checked'))
        {
            $('#conditionBottom').removeAttr('style');
        }

    }

    $(document).on("click","#actionTopButton",function(){

        var url='<?=base_url()?>';
        var full_name=$("#full_name").val();
        var email=$("#email").val();
        var condition=$("#condition").val();

        email=email.trim();
        full_name=full_name.trim();
        if(full_name!="" && email !="")
        {


            var checkemail=isEmail(email);
            if(checkemail==true)
            {


                $.post(url+'Thirty_percent_bonus_landing/checkEmail',{email:email},function(reEmail)
                {

                    reEmail= $.trim(reEmail);
                    if(reEmail=="empty")
                    {

                        if($("#condition").is(':checked'))
                        {
                            $.post('<?=FXPP::www_url('register/landing_registration')?>', {
                                email: email,
                                full_name: full_name,
                                condition: condition,
                                type:'TBL'
                            }, function (view) {
                                if (view == 404) {
                                    $("#lbl1").css('display', 'block');
                                    $("#btnloader").css('display', 'none');
                                    alert("<?=lang('page_mgs_11');?>");
                                }
                                else if (view == 405) {
                                    $("#email").css('border', '1px solid red');
                                    $("#email").attr("data-original-title", "<?=lang('page_mgs_2');?>");
                                }
                                else
                                {
                                    $("#hiddenboxMob").val('top');
                                    $('#landing_ask_phone').modal('show');
//                                    document.getElementById("onbutton").click();
//                                    $('#landing_ask_phone').modal('show');
//                                    window.location = '<?//=FXPP::loc_url('forexmart_landing/thanks')?>//';

                                }
                            });

                        }
                        else
                        {
                            $("#lbl1").css('display','block');
                            $("#conditionTop").css('border','1px solid red');
                            //$('#conditionTop').append('You must agree with the Terms of Service.');
                        }

                    }
                    else
                    {

                        $("#email").css('border','1px solid red');
                        $("#email").attr("data-original-title","<?=lang('page_mgs_3');?>");
                    }


                });

            }
            else
            {

                $("#email").css('border','1px solid red');
                $("#email").attr("data-original-title","<?=lang('page_mgs_4');?>");
            }

        }
        else
        {

            if(full_name=="" && email =="")
            {
                $('#full_name , #email').css('border','1px solid red');
                $("#full_name").attr("data-original-title","<?=lang('page_mgs_5');?>");
                $("#email").attr("data-original-title","<?=lang('page_mgs_10');?>");
            }
            else
            {
                if(full_name=="")
                {
                    $("#full_name").css('border','1px solid red');
                    $("#full_name").attr("data-original-title","<?=lang('page_mgs_5');?>");
                }
                if(email=="")
                {
                    $("#email").css('border','1px solid red');
                    $("#email").attr("data-original-title","<?=lang('page_mgs_6');?>");
                }
            }

        }

    });





    $(document).on("click","#actionBottomButton",function(){

        var url='<?=base_url()?>';
        var full_name=$("#full_nameBottom").val();
        var email=$("#emailbottom").val();
        var condition=$("#conditionb").val();

        email=email.trim();
        full_name=full_name.trim();
        if(full_name!="" && email !="")
        {


            var checkemail=isEmail(email);
            if(checkemail==true)
            {


                $.post(url+'Thirty_percent_bonus_landing/checkEmail',{email:email},function(reEmail)
                {

                    reEmail= $.trim(reEmail);
                    if(reEmail=="empty")
                    {

                        if($("#conditionb").is(':checked'))
                        {
                            $.post('<?=FXPP::www_url('register/landing_registration')?>', {
                                email: email,
                                full_name: full_name,
                                condition: condition,
                                type:'TBL'
                            }, function (view) {
                                if (view == 404) {
                                    $("#lbl1").css('display', 'block');
                                    $("#btnloader").css('display', 'none');
                                    alert("<?=lang('page_mgs_11');?>");
                                }
                                else if (view == 405) {
                                    $("#emailbottom").css('border', '1px solid red');
                                    $("#emailbottom").attr("data-original-title", "<?=lang('page_mgs_4');?>");
                                }
                                else
                                {


                                    $("#hiddenboxMob").val('bottom');
                                    $('#landing_ask_phone').modal('show');
//                                    document.getElementById("onbutton").click();
//                                    $('#landing_ask_phone').modal('show');
//                                    window.location = '<?//=FXPP::loc_url('forexmart_landing/thanks')?>//';

                                }
                            });

                        }
                        else
                        {
                            $("#lbl1").css('display','block');
                            $("#conditionBottom").css('border','1px solid red');
                            //$('#conditionTop').append('You must agree with the Terms of Service.');
                        }

                    }
                    else
                    {

                        $("#emailbottom").css('border','1px solid red');
                        $("#emailbottom").attr("data-original-title","<?=lang('page_mgs_3');?>");
                    }


                });

            }
            else
            {

                $("#emailbottom").css('border','1px solid red');
                $("#emailbottom").attr("data-original-title","<?=lang('page_mgs_4');?>");
            }

        }
        else
        {

            if(full_name=="" && email =="")
            {
                $('#full_nameBottom , #emailbottom').css('border','1px solid red');
                $("#full_nameBottom").attr("data-original-title","<?=lang('page_mgs_5');?>");
                $("#emailbottom").attr("data-original-title","<?=lang('page_mgs_10');?>");
            }
            else
            {
                if(full_name=="")
                {
                    $("#full_nameBottom").css('border','1px solid red');
                    $("#full_nameBottom").attr("data-original-title","<?=lang('page_mgs_5');?>");
                }
                if(email=="")
                {
                    $("#emailbottom").css('border','1px solid red');
                    $("#emailbottom").attr("data-original-title","<?=lang('page_mgs_6');?>");
                }
            }

        }

    });




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
            alert("<?=lang('page_mgs_8');?>");
        }
        else
        {



            var url='<?php echo site_url()?>';
            $.post(url+'thirty-percent-bonus-landing/Feedback',{message:message,category:category,rating:ratingval},function(view){

                if(view==="error")
                {
                    alert("<?=lang('page_mgs_9');?>");
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
            alert("<?=lang('page_mgs_7');?>");
        }




    });









    $(document).on("click", ".submit_cancel", function () {

        var lcoationDiv=$("#hiddenboxMob").val();

        if(lcoationDiv=="bottom")
        {
            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        }

        if(lcoationDiv=="top")
        {

            $("html, body").animate({ scrollTop:$(window.top).height()}, "slow");
        }

        return false;




        /*		$("#lbl1").css('display', 'block');
         $("#btnloader").css('display', 'none');
         $("#lbl2").css('display','block');
         $("#btnloaderf").css('display','none');
         window.location = '<?=FXPP::loc_url('thirty-percent-bonus-landing/thanks')?>';
         */
    });
    $(document).on("click", ".submit_phone", function () {
        var phone='';
        phone=$("#phone").val();
        phone=phone.trim();
        $.post('<?=FXPP::www_url('forexmart_landing/landing_registration')?>',{phone:phone},function(view){
            //   document.getElementById("onbuttonf").click();
            window.location = '<?=FXPP::loc_url('thirty-percent-bonus-landing/thanks')?>';
        });
    });


</script>


<div class="modal fade" id="landing_ask_phone" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
    <input type="hidden" id="hiddenboxMob">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title" style="color:black">
                    <?=lang('page_mob_1')?>
                </h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center">
                    <input type="text" class="form-control round-0 " maxlength="32" placeholder="<?=lang('page_mob_2')?>" name="phone" id="phone" value="<?= set_value('PhoneNumber','+'.$calling_code)?>">
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 submit_cancel"> <?=lang('page_mob_3')?></button>
                <?php
                $data['button_submit']=  array(
                    'name'          => 'submit',
                    'id'            => 'submit',
                    'class'          => 'btn btn-default round-0 submit_phone',
                    'content'       => lang('page_mob_4'),
                );
                ?>
                <?= form_button($data['button_submit']);?>
            </div>
        </div>
    </div>
</div>