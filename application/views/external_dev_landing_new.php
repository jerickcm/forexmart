<!DOCTYPE html>
<html lang="<?= FXPP::html_url() ?>" dir="<?= FXPP::lang_dir(); ?>">
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
    <meta name="description" content="<?=(isset($metadata_description))? $metadata_description: '';?>">
    <meta name="keywords" content="<?=(isset($metadata_keyword))? $metadata_keyword: '';?>">
    <meta name="google-site-verification" content="hUTbDLfEPfAPqV6xcbcuxv_b8HIjsXKIeBHijGZbZE4" />

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?=lang('fxl_dsc');?>
    </title>
    <link rel="icon" type="image/gif" href="<?= base_url()?>assets/images/icon.ico" />
    <!-- Bootstrap -->

    <!-- Bootstrap -->
    <link href="<?= base_url()?>assets/fx_landing_new/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/fx_landing_new/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url()?>assets/fx_landing_new/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url()?>assets/fx_landing_new/css/feedback-style.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url()?>assets/fx_landing_new/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url()?>assets/fx_landing_new/css/component.css" rel="stylesheet" type="text/css"/>
<!--    <script src="<?= base_url()?>assets/fx_landing_new/js/bootstrap-modal.js"></script>-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- START PARALLAX -->
      <script src="<?= base_url()?>assets/fx_landing_new/js/modernizr.custom.37797.js"></script> 
      <!-- Grab Google CDN's jQuery. fall back to local if necessary --> 
<!--      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> -->
      <script>!window.jQuery && document.write('<script src="<?= base_url()?>assets/fx_landing_new/js/jquery-1.6.1.min.js"><\/script>')</script>
      <script src="<?= base_url()?>assets/fx_landing_new/js/parallax.js"></script>
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
    <script src="<?= base_url()?>assets/fx_landing_new/js/main.js"></script>
     <link href="<?= base_url()?>assets/fx_landing_new/css/main-loader.css" rel="stylesheet" type="text/css"/>
    <!-- LOADER -->

    <!-- TOOLTIP -->
      <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
      </script>
    <!-- TOOLTIP -->

  </head>
  <body>
    <!--<div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>-->

   
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
                            <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/english.png"  width="30" height="20"/>
                            <?php break;
                        case 'ru': ?>
                            <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/russian.png"  width="30" height="20"/>
                            <?php break;
                        case 'my': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/malaysia.png" width="30" height="20"/>
                                    <?php break;
                        case 'id': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/indonesian.png" width="30" height="20"/>
                                    <?php break;
                        case 'de': ?>
                                   <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/germany.png" width="30" height="20"/>
                                    <?php break;
                        case 'fr': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/france.png" width="30" height="20"/>
                                    <?php break;
                        case 'jp': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/japan.png" width="30" height="20"/>
                                    <?php break;
                        case 'sk': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/slovakia.png" width="30" height="20"/>
                                    <?php break;
                        case 'pt': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/portugal.png" width="30" height="20"/>
                                    <?php break;
                        case 'es': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/spain.png" width="30" height="20"/>
                                    <?php break;
                    }
                    ?>
                </a>
                <ul class="dropdown-menu fx-dropdown-menu">
                    <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/english.png"  width="30" height="20"/> <span>English</span></a></li>
                    <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/russian.png"  width="30" height="20"/> <span>Русский</span></a></li>
                <?php 
                    $this->load->library('IPLoc', null);
                    if(IPLoc::Office_and_Vpn()){?>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/malaysia.png"  width="30" height="20"/> <span>Malay</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/japan.png"  width="30" height="20"/> <span> &#26085;&#26412;&#35486;</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/indonesian.png"  width="30" height="20"/> <span>Indonesian</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/germany.png"  width="30" height="20"/> <span>German</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/france.png"  width="30" height="20"/> <span> Fran&#231;ais</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/portugal.png"  width="30" height="20"/> <span>Portuguese</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/slovakia.png"  width="30" height="20"/> <span>Slovak</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/spain.png"  width="30" height="20"/> <span>Español</span></a></li>
                <?php }?>
                </ul>
            </div>
            <div class="fx-nav-left">
                <a class="navbar-brand fx-navbar-brand" href="<?= FXPP::loc_url('forexmart-landing')?>"><img src="<?=base_url()?>assets/fx_landing_new/images/fxlogo.svg" class="img-responsive"/></a>
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
                        <label class="page">
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
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/english.png" width="30" height="20"/>
                                    <?php break;
                                case 'ru': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/russian.png" width="30" height="20"/>
                                    <?php break;
                                case 'my': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/malaysia.png" width="30" height="20"/>
                                    <?php break;
                                case 'id': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/indonesian.png" width="30" height="20"/>
                                    <?php break;


                                case 'de': ?>
                                   <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/germany.png" width="30" height="20"/>
                                    <?php break;
                                case 'fr': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/france.png" width="30" height="20"/>
                                    <?php break;
                                case 'jp': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/japan.png" width="30" height="20"/>
                                    <?php break;
                                case 'sk': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/slovakia.png" width="30" height="20"/>
                                    <?php break;
                                case 'pt': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/portugal.png" width="30" height="20"/>
                                    <?php break;
                                 case 'es': ?>
                                    <img id="img-src" src="<?=base_url()?>assets/fx_landing_new/images/flags/spain.png" width="30" height="20"/>
                                    <?php break;
                            }
                            ?>


                        </a>
                        <ul class="dropdown-menu fx-dropdown-menu">
                            <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/english.png"/> <span>English</span></a></li>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/russian.png"/> <span>Русский</span></a></li>
                        <?php 
                            $this->load->library('IPLoc', null);
                            if(IPLoc::Office_and_Vpn()){?>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/malaysia.png"  width="30" height="20"/> <span>Malay</span></a></li>
                        
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/japan.png"  width="30" height="20"/> <span> &#26085;&#26412;&#35486;</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/indonesian.png"  width="30" height="20"/> <span>Indonesian</span></a></li>                               
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/germany.png"  width="30" height="20"/> <span>German</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/france.png"  width="30" height="20"/> <span> Fran&#231;ais</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/portugal.png"  width="30" height="20"/> <span>Portuguese</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/slovakia.png"  width="30" height="20"/> <span>Slovak</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish"><img src="<?=base_url()?>assets/fx_landing_new/images/flags/spain.png"  width="30" height="20"/> <span>Español</span></a></li>
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
              <span><?=lang('page_1_3');?></span>
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
                  <a href="#set-3" class="hi-icon adv-4">
                    <span></span>
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
                  <span><i class="15-sec-note"><img src="<?= base_url()?>assets/fx_landing_new/images/15-secs-note.png"/></i> <?=lang('page_2r_1');?></span>
                  <div class="arrow-down"></div>
                </div>
                  
 

                  
                <form id="register" action="" method="post" class="form-horizontal">
                  <input type="text" name="full_name" onkeyup="checkBorder('full_name')" id="full_name"  value="<?=set_value('full_name');?>"  placeholder="<?=lang('page_2r_2');?>" class="boxinput second-right-content-input tooltip-style xssCheck" data-toggle="tooltip" data-placement="top" title="" required="required" maxlength="35"/>
                  <input type="email" name="email" id="email"  onkeyup="checkBorder('email')" value="<?=set_value('email');?>" placeholder="<?=lang('page_2r_3');?>"  class="boxinput second-right-content-input tooltip-style" data-toggle="tooltip" data-placement="top" title=""  required="required"/>
<!--                  <button type="button" class="fx-btn-green ru-fx-btn-green" onclick="mySubmitFunction()" >ОТКРЫТЬ СЧЁТ</button>-->
            
                                <button  type="button" class="fx-btn-green ru-padding" onclick="mySubmitFunction()" >
                                    <div id="btnloader"> <img src="<?= $this->template->Images()?>103.gif" class="img-responsive loader"></div>
                                    <span id="lbl1"><?=lang('page_2r_4');?></span>
                                </button>
                  
                  
                  
                   <div class="second-right-content-condition ru-second-right-content-condition" id="condidiv">
                            <input type="checkbox" required="required" value="1" name="condition" id="condition" onclick="checkCondition()"/>
                            <label class="page"><?=lang('page_2r_5');?><a href="<?= $this->template->pdf()?>Terms and Conditions.pdf" target="_blank" ><?=lang('page_2r_6');?></a></label>
                    </div>
                  
                  
                </form>
                    
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content secondary-second-left-content ru-second-left-content secondary-left-content">
                <h2><?=lang('page_2r_7');?>
                </br><?=lang('page_2r_8');?>
                </br><?=lang('page_2r_9');?>
                </h2>
                <h3><?=lang('page_2r_10');?>
                </br><?=lang('page_2r_11');?>
                </h3>
                <h4><?=lang('page_2r_12');?>:</h4>
                <div class="non-arrow-right-content">
                  <ul>
                    <li>
                      <label><?=lang('page_2r_13');?>:</label>
                      <span><?=lang('page_2r_14');?></span>
                    </li>
                    <li>
                      <label><?=lang('page_2r_15');?>:</label>
                      <span><?=lang('page_2r_16');?></span>
                    </li>
                    <li>
                      <label class="secondary-last-label"><?=lang('page_2r_17');?>:</label>
                      <span><?=lang('page_2r_18');?></span>
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
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-1.png" class="wobble"/>
                  <span><?=lang('page_3_3');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-2.png" class="wobble"/>
                  <span><?=lang('page_3_4');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-3.png" class="wobble"/>
                  <span><?=lang('page_3_5');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-4.png" class="wobble"/>
                  <span><?=lang('page_3_6');?></span>
                </div>
              </div>
              <div class="conditions-content-holder">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-5.png" class="wobble"/>
                  <span><?=lang('page_3_7');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-6.png" class="wobble"/>
                  <span><?=lang('page_3_8');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-7.png" class="wobble"/>
                  <span><?=lang('page_3_9');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url()?>assets/fx_landing_new/images/conditions-icon-8.png" class="wobble"/>
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
                <p><?=lang('page_4_2');?>:</p>
                <ul>
                  <li><label>1</label><span><?=lang('page_4_3');?></span></li>
                  <li><label>2</label><span><?=lang('page_4_4');?></span></li>
                  <li><label>3</label><span><?=lang('page_4_5');?></span></li>
                  <li><label>4</label><span><?=lang('page_4_6');?></span></li>
                </ul>
                <a href="javascript:;"><?=lang('page_4_7');?></a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fourth-right-content bg-img-laspalmas">
                <img src="<?= base_url()?>assets/fx_landing_new/images/ud-laspalmas-logo.png" width="" class="img-responsive"/>
              </div>
            </div>
          </div>
          <div class="fourth-container-secondary-bg">
            <img src="<?= base_url()?>assets/fx_landing_new/images/udlaspalmas-bg.jpg" class="img-responsive"/>
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
              <h1> <?=lang('page_5_1');?></h1>
              <p><?=lang('page_5_2');?> <span> <?=lang('page_5_3');?></span> ,  <span> <?=lang('page_5_4');?></span>   <?=lang('page_5_5');?> <span> <?=lang('page_5_6');?></span>
                <br> <?=lang('page_5_7');?>
                <br>  <?=lang('page_5_8');?>
                <br><?=lang('page_5_9');?>
                <br> <?=lang('page_5_10');?></p>
            </div> 
          </div>
        </div>

        <div id="recognition-content"  class="fifth-container">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
              <h2> <?=lang('page_6_1');?></h2>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url()?>assets/fx_landing_new/images/award-1.png" width="376" height="354" class="img-responsive"/>
                <span><?=lang('page_6_2');?></span>
                <div class="awards-box"><span><?=lang('page_6_3');?></span></div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url()?>assets/fx_landing_new/images/award-2.png" width="376" height="500" class="img-responsive"/>
                <span><?=lang('page_6_4');?></span>
                <div class="awards-box"><span><?=lang('page_6_5');?></span></div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url()?>assets/fx_landing_new/images/award-3.png" width="376" height="354" class="img-responsive"/>
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
                  <span><i class="15-sec-note"><img src="<?= base_url()?>assets/fx_landing_new/images/15-secs-note.png"/></i><?=lang('page_2r_1');?></span>
                  <div class="arrow-down"></div>
                </div>
                  <form id="registerf" action="" method="post" class="form-horizontal">
                   
                  <input type="text" id="full_namef"  value="<?=set_value('full_name');?>" name="full_name" onkeyup="checkBorderf('full_namef')" placeholder="<?=lang('page_2r_2');?>"  class="boxinputf second-right-content-input tooltip-style xssCheck" data-toggle="tooltip" data-placement="top" title="" required="required" maxlength="35"/>
                  <input type="email" onkeyup="checkBorderf('emailf')" name="email" id="emailf" value="<?=set_value('email');?>"  placeholder="<?=lang('page_2r_3');?>" class="boxinputf second-right-content-input tooltip-style" data-toggle="tooltip" data-placement="top" title=""/>
                  
                   
                  
                                 <button type="button" class="fx-btn-green ru-padding " onclick="mySubmitFunctionf()">
                                    <div id="btnloaderf" > <img src="<?= $this->template->Images()?>103.gif" class="img-responsive loader"></div>
                                    <span id="lbl2"><?=lang('page_2r_4');?></span>
                                </button>
                  
                  
                  
                  
                  <div class="second-right-content-condition ru-second-right-content-condition" id="condidivf">
                            <input style="width:6.8%;float:left;" type="checkbox" required="required" value="1" name="condition" id="conditionf" onclick="checkConditionf()"/>                        
                            <label ><?=lang('page_2r_5');?><a  href="<?= $this->template->pdf()?>Terms and Conditions.pdf" target="_blank"><?=lang('page_2r_6');?></a></label>
                        </div>
                </form>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content secondary-second-left-content ru-second-left-content secondary-left-content">
                <h2><?=lang('page_2r_7');?>
                </br><?=lang('page_2r_8');?>
                </br><?=lang('page_2r_9');?>
                </h2>
                <h3><?=lang('page_2r_10');?>
                </br><?=lang('page_2r_11');?>
                </h3>
                <h4><?=lang('page_2r_12');?>:</h4>
                <div class="non-arrow-right-content">
                  <ul>
                    <li>
                      <label><?=lang('page_2r_13');?>:</label>
                      <span><?=lang('page_2r_14');?></span>
                    </li>
                    <li>
                      <label><?=lang('page_2r_15');?>:</label>
                      <span><?=lang('page_2r_16');?></span>
                    </li>
                    <li>
                      <label class="secondary-last-label"><?=lang('page_2r_17');?>:</label>
                      <span><?=lang('page_2r_18');?></span>
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
                <img src="<?= base_url()?>assets/fx_landing_new/images/mifid-img.png" width="180" height="80"/>
              </div>
            </div>
          </div>
        </div>
      </div>
     


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= base_url()?>assets/fx_landing_new/js/bootstrap.min.js"></script>
    <script>
      $(".dropdown-menu li a").click(function(){
        var IMGSRC = $(this).find('img').attr('src');
        $('#img-src').attr('src',IMGSRC);
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
      });
    </script>
  </body>
</html>



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
            $(this).attr("data-original-title","<?=lang('fxLan_alert_01');?>");
            e.preventDefault();
        }
        else
        {
            $(this).attr("data-original-title","");
        }

    });





    function checkCondition()
    {

        if($("#condition").is(':checked'))
        {
            $('#condidiv').removeAttr('style');
        }

    }

    function pre1(){


    }
    function mySubmitFunction(){

        $('#condidiv').css('border','1px solid none');
        $('.boxinput').css('border','1px solid white');

        $("#full_name").attr("data-original-title","");
        $("#email").attr("data-original-title","");

        var url='<?=base_url()?>';
        var full_name=$("#full_name").val();
        var email=$("#email").val();
        var condition=$("#condition").val();

        email=email.trim();
        if(full_name!="" && email !="")
        {


            var checkemail=isEmail(email);

            if(checkemail==true)
            {


                var url='<?php echo base_url()?>';
                $("#btnloader").css('display','block');
                $("#lbl1").css('display','none');
                $.post(url+'Forexmart_landing/checkEmail',{email:email},function(reEmail)
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
                            }, function (view) {
                                if (view == 404) {
                                    $("#lbl1").css('display', 'block');
                                    $("#btnloader").css('display', 'none');
                                    alert("Registration Failed please try again.");
                                }
                                else if (view == 405) {
                                    $("#lbl1").css('display', 'block');
                                    $("#btnloader").css('display', 'none');
                                    //alert("Please use a valid email address.");
                                    $("#email").css('border', '1px solid red');
                                    $("#email").attr("data-original-title", "<?=lang('fxLan_Error_3');?>");
                                }
                                else {
                                    $('#landing_ask_phone').modal('show');
//                                    document.getElementById("onbutton").click();
//                                    $('#landing_ask_phone').modal('show');
//                                    window.location = '<?//=FXPP::loc_url('forexmart_landing/thanks')?>//';

                                }
                            });
//                            $('#landing_ask_phone').modal('show')
//                            if(phone!="" and sumbit==true){
    //                            $("#btnloader").show().delay(2000).fadeOut();
                                // $.post(url+'register/landing_registration',{email:email,full_name:full_name,condition:condition},function(view){

//                            }
                        }
                        else
                        {
                            $("#lbl1").css('display','block');
                            $("#btnloader").css('display','none');
                            // alert(" You must agree with the Terms of Service. ");
                            $('#condidiv').css('border','1px solid red');
                        }

                    }
                    else
                    {
                        $("#lbl1").css('display','block');
                        $("#btnloader").css('display','none');
                        $("#email").css('border','1px solid red');
                        // alert("Please use a valid email address.");
                        $("#email").attr("data-original-title","<?=lang('fxLan_alert_03');?>");
                    }


                });


            }
            else
            {

                $("#email").css('border','1px solid red');
                // alert("Please use a valid email address.");
                $("#email").attr("data-original-title","<?=lang('fxLan_Error_3');?>");

            }

        }
        else
        {

            if(full_name=="" && email =="")
            {
                //alert("Enter your Full name and Email");
                $('.boxinput').css('border','1px solid red');
                $("#full_name").attr("data-original-title","<?=lang('fxLan_Error_1');?>");
                $("#email").attr("data-original-title","<?=lang('fxLan_Error_2');?>");
            }
            else
            {
                if(full_name=="")
                {
                    $("#full_name").css('border','1px solid red');
                    //alert("Enter your Full name ");
                    $("#full_name").attr("data-original-title","<?=lang('fxLan_Error_1');?>");
                }
                if(email=="")
                {
                    $("#email").css('border','1px solid red');
                    //alert("Enter your Email");
                    $("#email").attr("data-original-title","<?=lang('fxLan_Error_2');?>");
                }
                <?php if(!$allowed_country) { ?>
                $('#register_restrict').modal('hide');
                <?php } ?>
                return false;
            }
        }

        <?php if(!$allowed_country) { ?>
        $('#register_restrict').modal('hide');
        <?php } ?>
    }
<?php if(!$allowed_country) { ?>
    function showRestriction( action ){
       $('#btnRestrictOk').attr( 'onclick', action + '()' );
       $('#register_restrict').modal('show');
    }
<?php } ?>

    function checkBorder(id)
    {
        $("#"+id).css('border','1px solid white');
        if(id=="email"){
            $("#email").attr("data-original-title","");
        }


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
        $("#full_namef").attr("data-original-title","");
        $("#emailf").attr("data-original-title","");




        var url='<?=base_url()?>';
        var full_namef=$("#full_namef").val();
        var emailf=$("#emailf").val();
        var conditionf=$("#conditionf").val();

        full_namef=full_namef.trim();
        emailf=emailf.trim();

        if(full_namef!="" && emailf !="")
        {

            var checkemail =isEmail(emailf);

            if(checkemail===true)
            {


                var url='<?php echo base_url()?>';
                $("#btnloaderf").css('display','block');
                $("#lbl2").css('display','none');
//                $.post(url+'Forexmart_landing/checkEmail',{email:emailf},function(reEmail)
                $.post('<?=FXPP::www_url('Forexmart_landing/checkEmail')?>',{email:emailf},function(reEmail)
                {
                    reEmail= $.trim(reEmail);

                    if(reEmail=="empty")
                    {


                        if($("#conditionf").is(':checked'))
                        {
                            $('#btnloaderf').show();
//                            $.post(url+'register/landing_registration',{email:emailf,full_name:full_namef,condition:conditionf},function(view){
                             $.post('<?=FXPP::www_url('register/landing_registration')?>',{email:emailf,full_name:full_namef,condition:conditionf},function(view){
                                if(view==404)
                                {
                                    $("#lbl2").css('display','block');
                                    $("#btnloaderf").css('display','none');
                                    alert("Registration Failed please try again.");
                                    $('#btnloaderf').hide();
                                }
                                else if(view==405)
                                {
                                    $("#lbl2").css('display','block');
                                    $("#btnloaderf").css('display','none');
                                    // alert("Please use a valid email address.");
                                    $("#emailf").css('border','1px solid red');
                                    $("#emailf").attr("data-original-title","<?=lang('fxLan_Error_3');?>");

                                }
                                else
                                {
                                    $('#landing_ask_phone').modal('show');
//                                    document.getElementById("onbuttonf").click();
//                                    window.location = '<?//=FXPP::loc_url('forexmart_landing/thanks')?>//';
//                                    $('#btnloaderf').hide();
//                                    $("#full_namef").val("");
//                                    $("#emailf").val("");
//                                    $("#conditionf").prop('checked',false);
//                                    $('.boxinputf').css('border','1px solid white');
//                                    $('#conditionf').css('border','1px solid white');
//                                    $("#popboxem").html(emailf);
                                }
                            });


                        }
                        else
                        {
                            $("#lbl2").css('display','block');
                            $("#btnloaderf").css('display','none');
                            // alert(" You must agree with the Terms of Service. ");
                            $('#condidivf').css('border','1px solid red');
                        }

                    }
                    else
                    {
                        $("#lbl2").css('display','block');
                        $("#btnloaderf").css('display','none');
                        $("#emailf").css('border','1px solid red');
                        // alert("Please use a valid email address.");
                        $("#emailf").attr("data-original-title","<?=lang('fxLan_alert_03');?>");
                    }
                });




            }
            else
            {
                $("#emailf").css('border','1px solid red');
                //alert("Please use a valid email address.");
                $("#emailf").attr("data-original-title","<?=lang('fxLan_Error_3');?>");

            }







        }
        else
        {
            if(full_namef=="" && emailf =="")
            {
                //alert("<?lang('fxl_03');?>");
                $('.boxinputf').css('border','1px solid red');

                $("#full_namef").attr("data-original-title","<?=lang('fxLan_Error_1');?>");
                $("#emailf").attr("data-original-title","<?=lang('fxLan_Error_2');?>");
            }
            else
            {
                if(full_namef=="")
                {
                    $("#full_namef").css('border','1px solid red');

                    $("#full_namef").attr("data-original-title","<?=lang('fxLan_Error_1');?>");
                }
                if(emailf=="")
                {
                    $("#emailf").css('border','1px solid red');
                    // alert("<?lang('fxl_03');?>");
                    $("#emailf").attr("data-original-title","<?=lang('fxLan_Error_2');?>");
                }
                return false;
            }
        }

    }


    function checkBorderf(id)
    {
        $("#"+id).css('border','1px solid white');

        if(id=="emailf"){
            $("#emailf").attr("data-original-title","");
        }

    }

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
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


    $(document).ready(function()
    {

        setTimeout(function(){

            if(browserGet()=="c")
            {

                $(".hardicon").addClass("recarpet");
            }

        }, 3000);

    });


    function browserGet()
    {
        var browser=false;

        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        var isFirefox = typeof InstallTrigger !== 'undefined';
        var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
        var isChrome = !!window.chrome && !isOpera;
        var isIE = /*@cc_on!@*/false || !!document.documentMode;

        if(isOpera===true )
        {
            browser="o";
        }
        else if(isFirefox===true )
        {
            browser="f";
        }
        else if(isSafari===true)
        {
            browser="s";
        }
        else if(isChrome===true )
        {
            browser="c";
        }
        else if(isIE===true) //IF IE > 10
        {
            browser="i";
        }

        return browser;




    }


</script>

<?= $this->load->ext_view('modal', 'landing_askphone', $calling_code, TRUE); ?>

<script type="text/javascript">
    $("input").keyup(function() {
        this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
    });
    $("textarea").keyup(function() {
        this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
    });
</script>


    <style type="text/css">
        .error{
            color:red;
            font-size: 14px;
            font-weight: normal;
            text-align: left;
        }
    </style>


<button type="button" data-toggle="modal" id="onbuttonf" style="display:none">&nbsp;</button>

<?= $this->load->ext_view('modal', 'landing_register_restrict', '', TRUE); ?>
<style type="text/css">
    .loader{margin: auto;}
    #btnloader{
        display:none;
    }
    #btnloaderf{
        display:none;
    }
    .glyphicon-refresh-animate {
        -animation: spin .7s infinite linear;
        -webkit-animation: spin2 .7s infinite linear;
    }

    @-webkit-keyframes spin2 {
        from { -webkit-transform: rotate(0deg);}
        to { -webkit-transform: rotate(360deg);}
    }

    @keyframes spin {
        from { transform: scale(1) rotate(0deg);}
        to { transform: scale(1) rotate(360deg);}
    }


    h2{ color:white!important}
    label.page{ color:white!important}
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
    input{
        color:black!important;
    }
    .scroll-down span {
        color: white!important;
    }
</style>

<!--user feadback -->



<script type="application/javascript">

    $(document).on("click","#button_feedback",function(){

        var fid=parseInt($("#feadback_email_id").val());
        var feadback_email=$("#feadback_email").val();
        var checkemail=isEmail(feadback_email);



        if(checkemail==true)
        {
            $('#loader-holder').show();



            var url='<?php echo site_url()?>';
            $.post(url+'forexmart-landing/feadBackEmailStore',{fid:fid,email:feadback_email},function(views){

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
            alert("<?=lang('page_0_1');?>");
        }
        else
        {



            var url='<?php echo site_url()?>';
            $.post(url+'forexmart-landing/Feedback',{message:message,category:category,rating:ratingval},function(view){

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



    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })



</script>


<!-- modal -->

<div class="modal fade popfeedback" id="popfeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog round-0 feedback-modal-container">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">
                    <img src="<?=base_url()?>assets/fx_landing_new/images/fxlogonew.svg" class="img-reponsive feedback-logo">
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
                                    <select class="form-control round-0" id="category">
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
                    <img src="<?=base_url()?>assets/fx_landing_new/images/fxlogonew.svg" class="img-reponsive feedback-logo">
                </div>
            </div>
            <div class="modal-body">

                <p class="fback-first-line" style="    color: green;font-size: 17px;   text-align: center;">
                    <b>
                        <?=lang('x_fxl_14');?>
                        <!--                            Thanks for the Feedback-->
                    </b>
                </p>


                <div class="row"  style="color: black;">
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
                <button type="button" class="btn btn-primary round-0" data-dismiss="modal" >
                    <?=lang('x_fxl_15');?>
                    <!--                        Done-->
                </button>

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

</div>
<?php if(FXPP::html_url()=="" or FXPP::html_url()=="en"){echo "<style>.non-arrow-right-content{ width:90%!important; }</style>";}?>

