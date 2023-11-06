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
    <link href="<?= base_url('assets/assets_of_landing_page/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/assets_of_landing_page/css/style.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/assets_of_landing_page/css/bootstrap-modal.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/assets_of_landing_page/css/feedback-style.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/assets_of_landing_page/css/main.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/assets_of_landing_page/css/component.css')?>" rel="stylesheet" type="text/css"/>
    
    <link href="<?= base_url('assets/assets_of_landing_page/css/owl.carousel.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/assets_of_landing_page/css/owl.theme.default.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/assets_of_landing_page/css/new-style.css')?>" rel="stylesheet" type="text/css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- START PARALLAX -->
      <script src="<?= base_url('assets/assets_of_landing_page/js/modernizr.custom.37797.js')?>"></script> 
      <!-- Grab Google CDN's jQuery. fall back to local if necessary --> 
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
      <script>!window.jQuery && document.write('<script src="<?= base_url('assets/assets_of_landing_page/js/jquery-1.6.1.min.js')?>"><\/script>')</script>
      <script src="<?= base_url('assets/assets_of_landing_page/js/parallax.js')?>"></script>
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
    <script src="<?= base_url('assets/assets_of_landing_page/js/main.js')?>"></script>
     <link href="<?= base_url('assets/assets_of_landing_page/css/main-loader.css')?>" rel="stylesheet" type="text/css"/>
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
                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/english.png')?>"  width="30" height="20"/>
                            <?php break;
                        case 'ru': ?>
                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/russian.png')?>"  width="30" height="20"/>
                            <?php break;
                        case 'my': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/malaysia.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'id': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/indonesian.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'de': ?>
                                   <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/germany.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'fr': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/france.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'jp': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/japan.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'sk': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/slovakia.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'pt': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/portugal.png')?>" width="30" height="20"/>
                                    <?php break;
                        case 'es': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/spain.png')?>" width="30" height="20"/>
                                    <?php break;
                    }
                    ?>
                </a>
            
            
               <ul class="dropdown-menu fx-dropdown-menu">
                    <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/english.png')?>"  width="30" height="20"/> <span>English</span></a></li>
                    <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/russian.png')?>"  width="30" height="20"/> <span>Русский</span></a></li>
                <?php 
                    $this->load->library('IPLoc', null);
                    if(IPLoc::Office_and_Vpn()){?>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/malaysia.png')?>"  width="30" height="20"/> <span>Malay</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/japan.png')?>"  width="30" height="20"/> <span> &#26085;&#26412;&#35486;</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/indonesian.png')?>"  width="30" height="20"/> <span>Indonesian</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/germany.png')?>"  width="30" height="20"/> <span>German</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/france.png')?>"  width="30" height="20"/> <span> Fran&#231;ais</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/portugal.png')?>"  width="30" height="20"/> <span>Portuguese</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/slovakia.png')?>"  width="30" height="20"/> <span>Slovak</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/spain.png')?>"  width="30" height="20"/> <span>Español</span></a></li>
                <?php }?>
                </ul>
              
              
          </div>
           <div class="fx-nav-left">
            <a class="navbar-brand fx-navbar-brand" href="<?= FXPP::loc_url('forexmart-landing')?>">
                <img src="<?= base_url('assets/assets_of_landing_page/images/fxlogo.png')?>" class="img-responsive"/></a>
            <div class="fx-navbar-brand-right ru-navbar-brand-right">
              <span><?=lang('fxLan_logoh1');?></span>
              <span><?=lang('fxLan_logoh2');?></span>
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
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/english.png')?>"  width="30" height="20"/>
                                    <?php break;
                                case 'ru': ?>
                                    <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/russian.png')?>"  width="30" height="20"/>
                                    <?php break;
                                case 'my': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/malaysia.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'id': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/indonesian.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'de': ?>
                                           <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/germany.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'fr': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/france.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'jp': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/japan.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'sk': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/slovakia.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'pt': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/portugal.png')?>" width="30" height="20"/>
                                            <?php break;
                                case 'es': ?>
                                            <img id="img-src" src="<?= base_url('assets/assets_of_landing_page/images/flags/spain.png')?>" width="30" height="20"/>
                                            <?php break;
                            }
                            ?>


                        </a>
                       <ul class="dropdown-menu fx-dropdown-menu">
                        <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/english.png')?>"  width="30" height="20"/> <span>English</span></a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/russian.png')?>"  width="30" height="20"/> <span>Русский</span></a></li>
                        <?php 
                            $this->load->library('IPLoc', null);
                            if(IPLoc::Office_and_Vpn()){?>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/malaysia.png')?>"  width="30" height="20"/> <span>Malay</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/japan.png')?>"  width="30" height="20"/> <span> &#26085;&#26412;&#35486;</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/indonesian.png')?>"  width="30" height="20"/> <span>Indonesian</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/germany.png')?>"  width="30" height="20"/> <span>German</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/france.png')?>"  width="30" height="20"/> <span> Fran&#231;ais</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/portugal.png')?>"  width="30" height="20"/> <span>Portuguese</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/slovak"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/slovakia.png')?>"  width="30" height="20"/> <span>Slovak</span></a></li>
                                <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish"><img src="<?= base_url('assets/assets_of_landing_page/images/flags/spain.png')?>"  width="30" height="20"/> <span>Español</span></a></li>
                        <?php }?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <nav class="primary" id="primary">
        <ul>
          <li>
            <h1><?=lang('slide_1');?></h1>
            <a class="get-bonus-content" href="#get-bonus-content">View</a>
          </li>
          <li>
            <h1><?=lang('slide_2');?></h1>
            <a class="risk-free-content-1" href="#risk-free-content-1">View</a>
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
            <h1><?=lang('slide_8');?></h1>
            <a class="hkm-sponsor-content" href="#hkm-sponsor-content">View</a>
          </li>
          <li>
            <h1><?=lang('slide_6');?></h1>
            <a class="recognition-content" href="#recognition-content">View</a>
          </li>
          <li>
            <h1><?=lang('slide_2');?></h1>
            <a class="risk-free-content" href="#risk-free-content">View</a>
          </li>
        </ul>
      </nav>

      <div>
        <div id="get-bonus-content"  class="first-container">
          <div class="container">
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 first-right-content first-right-content-v2 ru-first-right-content">
              <h2 class="first-container-title"><?=lang('fxLan_bonusc1');?></h2>
              <p class="first-container-cont"><?=lang('fxLan_bonusc2');?> <span><?=lang('fxLan_bonusc3');?></span></p>
              <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a ru-hi-icon-wrap row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child ru-hi-icon-child">
                  <a href="#set-3" class="hi-icon adv-1">
                    <span></span>
                  </a>
                  <label><?=lang('fxLan_bonusCer1');?></label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child hi-icon-child-v2 ru-hi-icon-child">
                  <a href="#set-3" class="hi-icon adv-2">
                    <span></span>
                  </a>
                  <label><?=lang('fxLan_bonusCer2');?></label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child hi-icon-child-v2 ru-hi-icon-child">
                  <a href="#set-3" class="hi-icon adv-3">
                    <span></span>
                  </a>
                  <label><?=lang('fxLan_bonusCer3New');?></label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hi-icon-child hi-icon-child-v2 ru-hi-icon-child">
                  <a href="#set-3" class="hi-icon adv-4">
                    <span></span>
                  </a>
                  <label><?=lang('fxLan_bonusCer4');?></label>
                </div>
              </div>
              
			    <button class="fx-btn get-bonus-button btnbuttonregicall" href="#risk-free-content-1"><?=lang('fxLan_bonusButtion');?></button>
                <div class="scroll-down">
                    <a href="#register-now-content" class="btnbuttonregicall"></a>
                    <span><?=lang('fxLan_scrollButton');?></span>
                </div>
			  
            </div>
          </div>
        </div>

        <div id="risk-free-content-1"  class="sixth-container number-container se-slope">
          <div class="container se-slope-content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-center-content secondary-center-content">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content secondary-right-content">
                <div class="note-div">
                  <span><i class="15-sec-note"><img src="<?= base_url('assets/assets_of_landing_page/images/15-secs-note.png')?>"/></i><?=lang('page_2r_1');?> </span>
                  <div class="arrow-down"></div>
                </div>
                   
                <form  id="register" action="" method="post">
                    
                  <input type="text"  class="second-right-content-input tooltip-style boxinput xssCheck" 
                         data-toggle="tooltip" data-placement="top" required="required" maxlength="35"
                          title="" type="text" placeholder="<?=lang('fxLan_regi_text7');?>"
                          accept="" name="full_name" onkeyup="checkBorder('full_name')"
                          id="full_name"  value="<?=set_value('full_name');?>" />
                     
                  <input type="email" placeholder="Email" class="second-right-content-input tooltip-style boxinput" 
                         data-toggle="tooltip" data-placement="top" required="required" 
                         title="" placeholder="<?=lang('fxLan_regi_text8');?>"  
                         name="email" id="email"  onkeyup="checkBorder('email')" value="<?=set_value('email');?>"/>
                  
                  
                  
                   <button  type="button" class="fx-btn-green ru-padding" onclick="mySubmitFunction('<?=($allowed_country)?0:1?>')">
                                    <div id="btnloader"> <img src="<?= $this->template->Images()?>103.gif" class="img-responsive loader"></div>
                                    <span id="lbl1"><?=lang('page_2r_4');?></span>
                </button>
                  
                  <div class="second-right-content-condition ru-second-right-content-condition" id="condidiv">
                      <input required="required" value="1" name="condition" id="condition" onclick="checkCondition()" type="checkbox">
                      <label><?=lang('page_2r_5');?><a href="<?=  base_url('assets/pdf/Terms and Conditions.pdf')?>"><?=lang('page_2r_6');?></a></label>
                  </div>
                </form>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content secondary-second-left-content ru-second-left-content secondary-left-content">
                <h2><?=lang('fxLan_regi_text1');?>
                </h2>
                <h3><?=lang('fxLan_regi_text2');?> 
                </h3>
                
                <div class="arrow-right-content posrel">
                                            <ul>
                            <li><?=lang('fxLan_regi_text3');?> </li>
                            <li><?=lang('fxLan_regi_text4');?> </li>
                        </ul>
                        <h5 class="cstm_fnt_size"><?=lang('fxLan_regi_text5');?>  </h5>
                        <div class="arrow-right-tail hardicon"></div>
                    </div>
              </div>
            </div>
          </div>
        </div>

        <div id="conditions-trading-content"  class="third-container number-container">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 third-center-content">
              <h2><?=lang('fxLan_trading_text1');?></h2>
              <p><?=lang('fxLan_trading_text2');?> </p>
              <div class="conditions-content-holder first-conditions-content-holder">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-1.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle1');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-2.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle2');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-3.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle3');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-4.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle4');?> </span>
                </div>
              </div>
              <div class="conditions-content-holder">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-5.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle5');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-6.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle6');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-7.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle7');?></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 conditions-content-child ru-conditions-content-child">
                  <img src="<?= base_url('assets/assets_of_landing_page/images/conditions-icon-8.png')?>" class="wobble"/>
                  <span><?=lang('fxLan_trading_cercle8');?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div  id="partnership-laspalmas-content" class="fourth-container laspalmas-holder">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fourth-left-content">
                <h2><?=lang('page_4_1');?></h2>
                <p><?=lang('page_4_2');?> : </p>
                <ul>
                   <li><label>1</label><span><?=lang('page_4_3');?></span></li>
                  <li><label>2</label><span><?=lang('page_4_4');?></span></li>
                  <li><label>3</label><span><?=lang('page_4_5');?></span></li>
                  <li><label>4</label><span><?=lang('page_4_6');?></span></li>                   
                </ul>
                <a href="javascript:;"><?=lang('page_4_7');?></a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 fourth-right-content bg-img-laspalmas">
                <img src="<?= base_url('assets/assets_of_landing_page/images/ud-laspalmas-logo.png')?>" width="" class="img-responsive"/>
              </div>
            </div>
          </div>

          

          <div class="fourth-container-secondary-bg">
            <img src="<?= base_url('assets/assets_of_landing_page/images/udlaspalmas-bg.jpg')?>" class="img-responsive"/>
          </div>
        </div>

        <div class="carousel-holder">
          <div id="demo" class="demo container-fluid">
            <div class="span12 row">
                <div id="owl-demo1" class="owl-carousel col-md-12 carousel-col">
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/1.jpg"')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/2.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/3.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/4.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/5.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/6.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/7.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/8.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/9.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/10.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/11.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/12.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/13.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/14.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/15.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/16.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/17.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/18.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/19.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/20.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/21.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/22.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/23.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/24.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/laspalmas/25.jpg')?>" alt="Lazy Owl Image"></a></div>
                </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="fourth-center-content">
          <div class="fourth-center-child ru-fourth-center-child container">
            <div class="quote-icon"></div>
            <p>
                <?=lang('fxLan_partner_text8');?>
              
            </p>
            <span><?=lang('fxLan_partner_text9');?> </span>
          </div>
        </div>

        <div  id="rpj-racing-sponsor-content" class="fourth-and-half-container rpj-section-holder">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fourth-and-half-content">
                   <h1><?=lang('x_fxl_24');?></h1>
                <p>
                    <?=lang('landing_exnew_0');?> 
                   </p>
                                 
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-holder rpj-carousel">
          <div id="demo" class="demo container-fluid">
            <div class="span12 row">
                <div id="owl-demo2" class="owl-carousel col-md-12 carousel-col">
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/1.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/2.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/3.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/4.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/5.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/1.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/2.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/3.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/4.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/rpj/5.jpg')?>" alt="Lazy Owl Image"></a></div>
                </div>
            </div>
          </div>
        </div><div class="clearfix"></div>
        <div class="fourth-center-content">
          <div class="fourth-center-child ru-fourth-center-child container">
            <div class="quote-icon"></div>
            <p>
                <?=lang('landing_exnew_1');?>              
            </p>
            <span><?=lang('fxLan_partner_text9');?> </span>
          </div>
        </div>

        <div  id="hkm-sponsor-content" class="fourth-container hkm-holder">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fourth-left-content">
                <h2><?=lang('landing_exnew_00');?></h2>
                <p>
                 <?=lang('landing_exnew_2');?>                    
                </p>
                <p>
                     <?=lang('landing_exnew_3');?> 
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-holder hkm-carousel">
          <div id="demo" class="demo container-fluid">
            <div class="span12 row">
                <div id="owl-demo3" class="owl-carousel col-md-12 carousel-col">
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/1.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/2.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/3.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/4.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/5.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/1.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/2.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/3.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/4.jpg')?>" alt="Lazy Owl Image"></a></div>
                    <div class="item"><a href="#"><img class="lazyOwl" src="<?= base_url('assets/assets_of_landing_page/images/hkm/5.jpg')?>" alt="Lazy Owl Image"></a></div>
                </div>
            </div>
          </div>
        </div><div class="clearfix"></div>
        <div class="fourth-center-content">
          <div class="fourth-center-child ru-fourth-center-child container">
            <div class="quote-icon"></div>
            <p> 
              <?=lang('landing_exnew_4');?>
            </p>
            <span><?=lang('fxLan_partner_text9');?></span>
          </div>
        </div>
       
        

        

        <div id="recognition-content"  class="fifth-container awards-section-holder">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
              <h2><?=lang('page_6_1');?></h2>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url('assets/assets_of_landing_page/images/award-1.png')?>" width="376" height="354" class="img-responsive"/>
                <span><?=lang('page_6_2');?></span>
                <div class="awards-box"><span><?=lang('page_6_3');?></span></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url('assets/assets_of_landing_page/images/award-2.png')?>" width="376" height="500" class="img-responsive"/>
                <span><?=lang('x_fxl_22');?></span>
                <div class="awards-box"><span><?=lang('page_6_5');?>  </span></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url('assets/assets_of_landing_page/images/award-3.png')?>" width="376" height="354" class="img-responsive"/>
                <span><?=lang('page_6_2');?> </span>
                <div class="awards-box"><span><?=lang('page_6_7');?> </span></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fifth-content-child">
                <img src="<?= base_url('assets/assets_of_landing_page/images/award-4.png')?>" width="376" height="354" class="img-responsive"/>
                <span><?=lang('page_6_6');?> </span>
                <div class="awards-box"><span><?=lang('page_6_7');?> </span></div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-center-content">
              <p>
			  <?=lang('page_6_8');?> 
			   </p>
            </div>
          </div>
        </div>
        <div id="risk-free-content"  class="sixth-container number-container se-slope slope-form1">
          <div class="container se-slope-content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-center-content secondary-center-content">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 second-right-content secondary-right-content">
                <div class="note-div">
                  <span><i class="15-sec-note"><img src="<?= base_url('assets/assets_of_landing_page/images/15-secs-note.png')?>"/></i> <?=lang('fxLan_regi_text6');?> </span>
                  <div class="arrow-down"></div>
                </div>
           
				
				      
                <form  id="registertwo" action="" method="post">
                    
                  <input type="text"  class="second-right-content-input tooltip-style boxinputtwo xssCheck" 
                         data-toggle="tooltip" data-placement="top" required="required" maxlength="35"
                          title="" type="text" placeholder="<?=lang('fxLan_regi_text7');?>"
                          accept="" name="full_nametwo" onkeyup="checkBorder('full_nametwo')"
                          id="full_nametwo"  value="<?=set_value('full_name');?>" />
                     
                  <input type="email" placeholder="Email" class="second-right-content-input tooltip-style boxinputtwo" 
                         data-toggle="tooltip" data-placement="top" required="required" 
                         title="" placeholder="<?=lang('fxLan_regi_text8');?>"  
                         name="emailtwo" id="emailtwo"  onkeyup="checkBorder('emailtwo')" value="<?=set_value('email');?>"/>
                  
                   
                  
                   <button  type="button" class="fx-btn-green ru-padding" onclick="mySubmitFunctionTwo('<?=($allowed_country)?0:1?>')">
                                    <div id="btnloadertwo"> <img src="<?= $this->template->Images()?>103.gif" class="img-responsive loader"></div>
                                    <span id="lbl1two"><?=lang('page_2r_4');?></span>
                </button>
                  
                  <div class="second-right-content-condition ru-second-right-content-condition" id="condidivtwo">
                      <input required="required" value="1" name="condition" id="conditiontwo" onclick="checkConditionTwo()" type="checkbox">
                      <label><?=lang('page_2r_5');?><a href="<?=  base_url('assets/pdf/Terms and Conditions.pdf')?>"><?=lang('page_2r_6');?></a></label>
                  </div>
                </form>
				
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 second-left-content secondary-second-left-content ru-second-left-content secondary-left-content">
                <h2><?=lang('fxLan_regi_text1');?> 
                </h2>
                <h3><?=lang('fxLan_regi_text2');?>
                </h3>
                <!-- <div class="non-arrow-right-content">
                  <ul>
                    <li>
                      <label>Ваш депозит:</label>
                      <span>$100</span>
                    </li>
                    <li>
                      <label>Бонус ForexMart:</label>
                      <span>$30</span>
                    </li>
                    <li>
                      <label class="secondary-last-label">Поступит на счёт:</label>
                      <span>$130</span>
                    </li>
                  </ul>
                </div> -->
                <div class="arrow-right-content posrel">
                                            <ul>
                            <li><?=lang('fxLan_regi_text3');?></li>
                            <li><?=lang('fxLan_regi_text4');?></li>
                        </ul>
                        <h5 class="cstm_fnt_size"><?=lang('fxLan_regi_text5');?></h5>
                        <div class="arrow-right-tail hardicon"></div>
                    </div>
              </div>
            </div>
          </div>
        </div>

        <div class="seven-container number-container slant">
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
                <img src="<?= base_url('assets/assets_of_landing_page/images/mifid-img.png')?>" width="180" height="80"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      
      
<!--      fead back box -->
      
      <div class="modal fade popfeedback in" id="popfeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog round-0 feedback-modal-container">
          <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">
                    <img src="<?= base_url('assets/assets_of_landing_page/images/fxlogonew.svg')?>" class="feedback-logo">
                </div>
            </div>
            <div class="modal-body">
              <p class="fback-first-line">
                 <?=lang('x_fxl_02');?>
                  <br><small>
                      <?=lang('x_fxl_03');?>
                  </small>
              </p>
                <div class="row">
                  <div class="col-sm-12 scale">
                    <div class="feedback-rate-holder">
                        <p><?=lang('x_fxl_04');?> </p>
                        <p><?=lang('x_fxl_05');?> </p>
                        <ul class="feedback-rate-list" id="listRating">
                            <li>
                                <input type="radio" id="c1" name="rating" value="1" class="rad rating">
                                <label for="c1">1</label>
                            </li>
                            <li>
                                <input type="radio" id="c2" name="rating" value="2" class="rad rating">
                                <label for="c2">2</label>
                            </li>
                            <li>
                                <input type="radio" id="c3" name="rating" value="3" class="rad rating">
                                <label for="c3">3</label>
                            </li>
                            <li>
                                <input type="radio" id="c4" name="rating" value="4" class="rad rating">
                                <label for="c4">4</label>
                            </li>
                            <li>
                                <input type="radio" id="c5" name="rating" value="5" class="rad rating">
                                <label for="c5">5</label>
                            </li>
                            <li>
                                <input type="radio" id="c6" name="rating" value="6" class="rad rating">
                                <label for="c6">6</label>
                            </li>
                            <li>
                                <input type="radio" id="c7" name="rating" value="7" class="rad rating">
                                <label for="c7">7</label>
                            </li>
                            <li>
                                <input type="radio" id="c8" name="rating" value="8" class="rad rating">
                                <label for="c8">8</label>
                            </li>
                            <li>
                                <input type="radio" id="c9" name="rating" value="9" class="rad rating">
                                <label for="c9">9</label>
                            </li>
                            <li>
                                <input type="radio" id="c10" name="rating" value="10" class="rad rating">
                                <label for="c10">10</label>
                            </li><div class="clearfix"></div>
                        </ul>
                    </div>
                  </div>
                </div>
                <p class="fback-second-line">
                    <br>
                    <small>
                        <?=lang('x_fxl_06');?>                      <!--                            Should you have any specific feedback, please select a category below.(optional)-->
                    </small>
                </p>
                <div class="row">
                    <div class="col-xs-8">
                        <form class="form-horizontal">
                            <div class="form-group feedback-modal-group">
                              <label for="" class="col-sm-3 control-label lblcat">   <?=lang('x_fxl_07');?> </label>
                              <div class="col-sm-9">
                               <select class="form-control round-0" id="category">
                                        <option value="Problem">
                                            <?=lang('x_fxl_08');?>                                          <!--                                                Problem-->
                                        </option>
                                        <option value="Suggestion">
                                             <?=lang('x_fxl_09');?>                                          <!--                                                Suggestion-->
                                        </option>
                                        <option value="Compliment">
                                            <?=lang('x_fxl_10');?>                                    <!--                                                Compliment-->
                                        </option>
                                        <option value="Other">
                                            <?=lang('x_fxl_11');?>                                       <!--                                                Other-->
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
              <button type="button" class="btn btn-default round-0" data-dismiss="modal" id="cancel"> <?=lang('x_fxl_12');?> </button>
              <button type="button" class="btn btn-primary round-0" onclick="sendFeedback()"> <?=lang('x_fxl_13');?> </button>
            </div>
          </div>
        </div>
      </div>

<!--// email enter popup box-->
<button href="javascript:;"  data-toggle="modal" data-target="#popfeedbacktwo" style="display:none" id="hiddenPopId"></button>
 <div class="modal fade popfeedback in" id="popfeedbacktwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">


    <div class="modal-dialog round-0 feedback-modal-container">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">                 
                    <img src="<?= base_url('assets/assets_of_landing_page/images/fxlogonew.svg')?>" class="img-reponsive feedback-logo">
                </div>
            </div>
            <div class="modal-body">

                <p class="fback-first-line" style="    color: green;font-size: 17px;   text-align: center;">
                    <b>
                        <?=lang('x_fxl_14');?> <!--                            Thanks for the Feedback-->
                    </b>
                </p>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group feadbackbodytwo">
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
                        <div class="col-sm-12" style="color:black">
                           <?=lang('x_fxl_16')?>                         <!--                                Email: -->
                            <input class="form-control round-0" size="50" maxlength="100" id="feadback_email" type="email">
                            <input id="feadback_email_id" value="" type="hidden">
                        </div>
                    </div>

                </div>


            </div>

            <div class="modal-footer round-0 popfooter">
                <button type="button" class="btn btn-primary round-0" data-dismiss="modal" style="color:black">
                    <?=lang('x_fxl_15');?>   <!--                        Done-->
                </button>

                <div class="modal-footer round-0 popfooter">
                    <button class="btn btn-default round-0" value="true" id="button_feedback" type="button">  <?=lang('fxLan_feadb_04');?></button>
                    <button class="btn btn-default round-0 " aria-label="Close" data-dismiss="modal" id="dismisclose" type="button">
                       <?=lang('x_fxl_17');?>         <!-- Close-->
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>









      <!-- end modal -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= base_url('assets/assets_of_landing_page/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/assets_of_landing_page/js/owl.carousel.js')?>"></script>
	<script src="<?php // base_url('assets/assets_of_landing_page/js/bootstrap-modal.js')?>"></script>
    <script>
      $(document).ready(function() {

          $("#owl-demo1").owlCarousel({
              autoPlay: 3000, //Set AutoPlay to 3 seconds
              items : 6,
              lazyLoad : true,
              navigation : false
          });

          $("#owl-demo2").owlCarousel({
              autoPlay: 3000, //Set AutoPlay to 3 seconds
              items : 6,
              lazyLoad : true,
              navigation : false
          });

          $("#owl-demo3").owlCarousel({
              autoPlay: 3000, //Set AutoPlay to 3 seconds
              items : 6,
              lazyLoad : true,
              navigation : false
          });

      });
    </script>
    <script>
      $(".dropdown-menu li a").click(function(){
        var IMGSRC = $(this).find('img').attr('src');
        $('#img-src').attr('src',IMGSRC);
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
      });
	  
	  
$(document).on("click",".btnbuttonregicall",function(){
$("a.risk-free-content-1").click();
});
	  
    </script>
    
  </body>
</html>




<script src="<?= base_url('assets/assets_of_landing_page/js/customise.js')?>"></script>

<script type="application/javascript">
     var url="<?=site_url()?>";
function sendFeedback()
    {
        
        var ratingval=getRatting();    
        var category=$("#category").val();
        var message=$("#message").val();
        if(ratingval)
        {
            $.post(url+'forexmart-landing/Feedback',{message:message,category:category,rating:ratingval},function(view){ 
                if(view==="error") { alert("<?=  lang('landing_some_1')?>"); }
                else
                {
                    document.getElementById("cancel").click();
                    document.getElementById("hiddenPopId").click();
                    $('.rating').prop('checked', false);
                    $("#message").val("");
                    $("#feadback_email_id").val(view);
                } 
            });

        } else { alert("<?=lang('page_0_1');?>");}
    }

  $(document).on("click","#button_feedback",function(){

        var fid=parseInt($("#feadback_email_id").val());
        var feadback_email=$("#feadback_email").val();
        var checkemail=isEmail(feadback_email);
        if(checkemail==true)
        {
            $('#loader-holder').show();
 
            $.post(url+'forexmart-landing/feadBackEmailStore',{fid:fid,email:feadback_email},function(views){

                $("#feadback_email_id").val("");
                $("#feadback_email").val("");
                $('#loader-holder').hide();
                document.getElementById("dismisclose").click();
            });
        }else{$('#loader-holder').hide();  alert("<?=lang('fxLan_feadb_01');?>");}
});
 
   $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
 
 
 function mySubmitFunction(num){
 num = num.replace(/\s/g,''); 
            if(num ==0){

                $('#condidiv').css('border', '1px solid none');
                $('.boxinput').css('border', '1px solid white');
                $("#full_name").attr("data-original-title", "");
                $("#email").attr("data-original-title", "");                
                var full_name = $("#full_name").val();
                var email = $("#email").val();
                var condition = $("#condition").val();
                email = email.trim();
                if (full_name != "" && email != "") {

                    var checkemail = isEmail(email);
                    if (checkemail == true) {
 
                        $("#btnloader").css('display', 'block');                      
                        $.post(url + 'Forexmart_landing/checkEmail', {email: email}, function (reEmail) {

                            reEmail = $.trim(reEmail);
                            if (reEmail == "empty") {
                                if ($("#condition").is(':checked')) {

                                    $.post('<?=FXPP::www_url('register/landing_registration')?>', {
                                        email: email,
                                        full_name: full_name,
                                        condition: condition,
                                    }, function (view) {
                                        if (view == 404) {                                            
                                            alert("<?=lang('landing_some_2');?>");
                                        }
                                        else if (view == 405) {                                            
                                            $("#email").css('border', '1px solid red');
                                            $("#email").attr("data-original-title", "<?=lang('fxLan_Error_3');?>");
                                        }
                                        else {                                           
                                            $('#landing_ask_phone').modal('show');  
                                             $('#landing_ask_phone').css("position","fixed");
                                                $("#btnloader").css('display', 'none');  
                                                 $("#full_name").val("");
                                                 $("#email").val("");
                                        }
                                    });

                                }
                                else {
                                    $("#lbl1").css('display', 'block');
                                    $("#btnloader").css('display', 'none');
                                    $('#condidiv').css('border', '1px solid red');
                                }

                            }
                            else {
                                $("#lbl1").css('display', 'block');
                                $("#btnloader").css('display', 'none');
                                $("#email").css('border', '1px solid red');
                                $("#email").attr("data-original-title", "<?=lang('fxLan_alert_03');?>");
                            }


                        });


                    }
                    else {

                        $("#email").css('border', '1px solid red');
                        $("#email").attr("data-original-title", "<?=lang('fxLan_Error_3');?>");

                    }

                }
                else {

                    if (full_name == "" && email == "") {
                        $('.boxinput').css('border', '1px solid red');
                        $("#full_name").attr("data-original-title", "<?=lang('fxLan_Error_1');?>");
                        $("#email").attr("data-original-title", "<?=lang('fxLan_Error_2');?>");
                    }
                    else {
                        if (full_name == "") {
                            $("#full_name").css('border', '1px solid red');
                            $("#full_name").attr("data-original-title", "<?=lang('fxLan_Error_1');?>");
                        }
                        if (email == "") {
                            $("#email").css('border', '1px solid red');
                            $("#email").attr("data-original-title", "<?=lang('fxLan_Error_2');?>");
                        }

                        return false;
                    }
                }
                
                
            }else{
                checkCookie2(1);
            }

    }
     
 
 
 
 function mySubmitFunctionTwo(num){
 num = num.replace(/\s/g,''); 
            if(num ==0){

                $('#condidivtwo').css('border', '1px solid none');
                $('.boxinputtwo').css('border', '1px solid white');
                $("#full_nametwo").attr("data-original-title", "");
                $("#emailtwo").attr("data-original-title", "");                
                var full_name = $("#full_nametwo").val();
                var email = $("#emailtwo").val();                
				 var condition = $("#conditiontwo").val();
                email = email.trim();
                if (full_name != "" && email != "") {

                    var checkemail = isEmail(email);
                    if (checkemail == true) {
 
                        $("#btnloadertwo").css('display', 'block');                      
                        $.post(url + 'Forexmart_landing/checkEmail', {email: email}, function (reEmail) {

                            reEmail = $.trim(reEmail);
                            if (reEmail == "empty") {
                                if ($("#conditiontwo").is(':checked')) {

                                    $.post('<?=FXPP::www_url('register/landing_registration')?>', {
                                        email: email,
                                        full_name: full_name,
                                        condition: condition,
                                    }, function (view) {
                                        if (view == 404) {                                            
                                            alert("<?=lang('landing_some_2');?>");
                                        }
                                        else if (view == 405) {                                            
                                            $("#emailtwo").css('border', '1px solid red');
                                            $("#emailtwo").attr("data-original-title", "<?=lang('fxLan_Error_3');?>");
                                        }
                                        else {                                           
                                            $('#landing_ask_phone').modal('show');  
                                             $('#landing_ask_phone').css("position","fixed");
                                                $("#btnloadertwo").css('display', 'none');  
                                                 $("#full_nametwo").val("");
                                                 $("#emailtwo").val("");
                                        }
                                    });

                                }
                                else {
                                    $("#lbl1two").css('display', 'block');
                                    $("#btnloadertwo").css('display', 'none');
                                    $('#condidivtwo').css('border', '1px solid red');
                                }

                            }
                            else {
                                $("#lbl1two").css('display', 'block');
                                $("#btnloadertwo").css('display', 'none');
                                $("#emailtwo").css('border', '1px solid red');
                                $("#emailtwo").attr("data-original-title", "<?=lang('fxLan_alert_03');?>");
                            }


                        });


                    }
                    else {

                        $("#emailtwo").css('border', '1px solid red');
                        $("#emailtwo").attr("data-original-title", "<?=lang('fxLan_Error_3');?>");

                    }

                }
                else {

                    if (full_name == "" && email == "") {
                        $('.boxinputtwo').css('border', '1px solid red');
                        $("#full_nametwo").attr("data-original-title", "<?=lang('fxLan_Error_1');?>");
                        $("#emailtwo").attr("data-original-title", "<?=lang('fxLan_Error_2');?>");
                    }
                    else {
                        if (full_name == "") {
                            $("#full_nametwo").css('border', '1px solid red');
                            $("#full_name").attr("data-original-title", "<?=lang('fxLan_Error_1');?>");
                        }
                        if (email == "") {
                            $("#emailtwo").css('border', '1px solid red');
                            $("#emailtwo").attr("data-original-title", "<?=lang('fxLan_Error_2');?>");
                        }

                        return false;
                    }
                }
                
                
            }else{
                checkCookie2(2);
            }

    }
 
     
</script>
 
<?= $this->load->ext_view('modal', 'landing_register_restrict', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'landing_register_restrict2', '', TRUE); ?> 

<!-- ask phone number -->

<style>
   #btnloader{
        display:none;
    }
	#btnloadertwo{
        display:none;
    }
	
.fback-second-line{color:#333;}    
.feadbackbodytwo {color:#333;}
.modalbodytext{color:#333;}
#landing_ask_phone{color:#333 !important;}
</style>    
 
<div class="modal fade" id="landing_ask_phone" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">
                    <?=lang('validate_mobile_num')?>
                </h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center">
                    <input type="text" class="form-control round-0 " maxlength="32" placeholder="Phone Number" name="phone" id="phone" value="<?= set_value('PhoneNumber','+'.$calling_code)?>">
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 submit_cancel"> <?=lang('validate_btn_cancel')?></button>
                <?php
                $data['button_submit']=  array(
                    'name'          => 'submit',
                    'id'            => 'submit',
                    'class'          => 'btn btn-default round-0 submit_phone',
                    'content'       => lang('validate_btn_submit'),
                );
                ?>
                <?= form_button($data['button_submit']);?>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script type="application/javascript">
    $(document).on("click", ".submit_cancel", function () {
        $("#lbl1").css('display', 'block');
        $("#btnloader").css('display', 'none');
        $("#lbl2").css('display','block');
        $("#btnloaderf").css('display','none');
    });
    $(document).on("click", ".submit_phone", function () {
        var phone='';
        phone=$("#phone").val();
        phone=phone.trim();
        $.post('<?=FXPP::www_url('forexmart_landing/landing_registration')?>',{phone:phone},function(view){
            $(".submit_cancel").click();
            window.location = '<?=FXPP::loc_url('forexmart_landing/thanks')?>';
        });
    });
</script>
