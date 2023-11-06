<link href="<?= $this->template->Css()?>nav-style.css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function() {
// If the web browser type is Safari
        if( navigator.userAgent.toLowerCase().indexOf('safari/') > -1)
        {
            $(".logo-con-saf").hide();

            $("#logo-saf-ap").append('<img src="<?= FXPP::html_url() == 'ru' ? $this->template->Images() . 'fxlogonew-russian.png' : $this->template->Images() . 'fxlogonew.png' ?>" alt="" class="img-reponsive logo logo-img logo-con-saf" usemap="#fxxpplaspalmas">');
        }
    });
</script>
<!-- Navigation -->
<?php $this->lang->load('nav');
$this->load->library('IPLoc');?>
<link href="<?= $this->template->Css()?>logo.css" rel="stylesheet">
    <?php if($this->session->userdata('URLs') == null){ ?>
        <div class="screenMsgContainer">
            <span class="screenMsg_btnClose" data-givenURL="<?= base_url(uri_string());?>"><i class="fa fa-times fa-2x"></i></span>
            <ul class=" parent-custom-size">
                <li class="xs-custom-size">
                    <img class="img_brandLogo" src="https://www.forexmart.com/assets/images/mt4/img_brandlogo.png" alt="">
                </li>
                <li class="lg-custom-size">
                    <label class="screenMsg_brandName"><?=lang('mh_brandname');?></label>
                    <p class="screnMsg_caption"><?=lang('mh_caption');?> <span class="line2" id="DLdesc"><?=lang('mh_desc_android');?></span></p>
                </li>

                <li class="md-custom-size">
                    <button class="btn btn-gdtgreen" id='DLbutton'><?=lang('mh_download');?></button>
                </li>
            </ul>
        </div>
    <?php } ?>


<nav class="navbar navbar-default hidden-navbar-default nd round-0">
    <div class="container">
    <div class="hidden-main-header">
        <div class="navbar-header page-scroll">
                <div class="navbar-header page-scroll">
                    <div class="">
                        <div class="new-logo-holder">
                            <a href="<?= FXPP::www_url(''); ?>"><img src="<?=$this->template->Images() ?>fxlogo2.svg" class="img-responsive fxlogo" alt="fx-logo"></a>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

        <div class="reg-holder ext-arabic-reg-holder">
            <ul class="xnav nav navbar-nav ext-arabic-navbar-right navbar-right ryt">
                <?php if($this->session->userdata('logged')){?>
                    <li class="user-account">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?=lang('xnv_hi');?> &#44;  <?=$this->session->userdata('full_name')?> <span class="caret user-account-caret"></span>
                        </a>
                        <ul class="dropdown-menu btn-flag-dropdown btn-user-dropdown" role="menu" id="userdd">
                            <li><a href="<?= FXPP::my_url('my-account'); ?>"> <?=lang('xnv_goto');?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?=FXPP::my_url('signout')?>"><?=lang('xnv_LO');?></a></li>
                        </ul>

                    </li>

                <?php }  else{?>
                    <?php $router =& load_class('Router', 'core');
                        if(strtolower($router->fetch_class()=='signin')){ ?>
                    <?php }else{?>

                            <?php switch(FXPP::html_url()){
                                case 'en':
                                case '':
                            ?>
                                    <li >
                                        <a href="https://webterminal.forexmart.com/" target="_blank" class="mbtn btn-reg btn-reg2 custom-b wt-padding">
                                            <?=lang('xnv_webtrader');?></a>
                                </li>

                            <?php break;
                                case 'ru': ?>
                                    <li>
                                        <a href="https://webterminal.forexmart.com/" target="_blank" class="mbtn btn-reg btn-reg2 custom-b wt-padding">
                                            <?=lang('xnv_webtrader');?>
                                        </a>
                                    </li>
                            <?php break;
                                default:
                                    ?>
                                    <li>
                                        <a href="https://webterminal.forexmart.com/" target="_blank" class="mbtn btn-reg btn-reg2 custom-b wt-padding">
                                                <?=lang('xnv_webtrader');?>
                                        </a>
                                    </li>
                                    <?php break;
                             }
                          ?>


                           <!--  <li id="" >
                                <a href="https://webtrader.forexmart.com/login" target="_blank" class="pcr login-external">
                                    <button class="mbtn btn-reg btn-reg2">
                                        <?=lang('xnv_webtrader');?>
                                    </button></a></li> -->
                            <li id="pl1">
                                <a  href="<?= FXPP::my_url('partner/signin');?>" target="_blank" class="mbtn btn-partner-reg btn-partner-reg2 custom-a"> <?=lang('xnv_PL');?> </a>
                            </li>
                            <li id="cl1" >
                                <a href="<?= FXPP::my_url('client/signin');?>" target="_blank" class="mbtn btn-reg btn-reg2 custom-b"> <?=lang('xnv_CL');?></a>
                            </li>

                    <?php }   ?>

                    <li id="r1">
                        <a target="_blank" href="<?= FXPP::loc_url('register');?>"  class="mbtn btn-reg btn-reg2 custom-c"> <?=lang('xnv_R');?> </a>
                    </li>

                <?php } ?>
                <li>


                        <div class="btn-replacement-link btn-reg btn-flag-reg btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="flag_btn" role="button">
                        <?php
//                        if(IPLoc::Office()){ print_r(FXPP::html_url());}
                        switch(FXPP::html_url()){
                            case 'en':
                            case '':
                                ?>
                                <div class="flag-sprite uk"></div>
                                <?php break;
                            case 'ru': ?>
                                <div class="flag-sprite ru"></div>
                                <?php break;
                            case 'jp': ?>
                                <div class="flag-sprite jp"></div>
                                <?php break;
                            case 'de': ?>
                                <div class="flag-sprite de"></div>
                                <?php break;
                            case 'id': ?>
                                <div class="flag-sprite id"></div>
                                <?php break;
                            case 'sa': ?>
                                <div class="flag-sprite sa"></div>
                                <?php break;
                            case 'fr': ?>
                                <div class="flag-sprite fr"></div>
                                <?php break;
                            case 'es': ?>
                                <div class="flag-sprite es"></div>
                                <?php break;
                            case 'it': ?>
                                <div class="flag-sprite it"></div>
                                <?php break;
                            case 'pt': ?>
                                <div class="flag-sprite pt"></div>
                                <?php break;
                            case 'bg': ?>
                                <div class="flag-sprite bg"></div>
                                <?php break;
                            case 'my': ?>
                                <div class="flag-sprite my"></div>
                                <?php break;
                            case 'pk': ?>
                                <div class="flag-sprite pk"></div>
                                <?php break;
                            case 'pl': ?>
                                <div class="flag-sprite pl"></div>
                                <?php break;
                            case 'gr': ?>
                                <div class="flag-sprite gr"></div>
                                <?php break;
                            case 'cs':
                                ?>
                                <div class="flag-sprite cs"></div>
                                <?php break;
                            case 'zh':
                                ?>
                                <div class="flag-sprite zh"></div>
                                <?php break;
                            case 'sk':
                            ?>
                            <div class="flag-sprite sk"></div>
                            <?php break;
                        } ?>
                        </div>



                    <ul class="dropdown-menu btn-flag-dropdown dropdown-left-width" dir="ltr" id="flagmenu1">
                        <?php if(IPLoc::Office()){ ?>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/arabic"><div class="adj_lang flag-sprite sa" ></div> Arabic</a></li>
                        <?php } ?>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/bulgarian"><div class="adj_lang flag-sprite bg"></div> Bulgarian</a></li>

                        <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/chinese"><div class="adj_lang flag-sprite zh"></div> Chinese</a></li>

                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/Czech"><div class="adj_lang flag-sprite cs"></div> Czech</a></li>
                        <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><div class="adj_lang flag-sprite uk"></div> English</a></li>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish"><div class="adj_lang flag-sprite es"></div> Espa&#241;ol</a></li>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><div class="adj_lang flag-sprite fr"></div> Fran&#231;ais</a></li>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><div class="adj_lang flag-sprite de"></div> German</a></li>
                        <?php if(IPLoc::Office()){ ?>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/greek"><div class="adj_lang flag-sprite gr"></div> Greek</a></li>
                        <?php } ?>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><div class="adj_lang flag-sprite id"></div> Indonesian</a></li>
                        <?php if(IPLoc::Office()){ ?>
                            <li style="display:none;"><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/italian"><div class="adj_lang flag-sprite it"></div> Italiano</a></li>
                        <?php } ?>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><div class="adj_lang flag-sprite jp"></div> &#26085;&#26412;&#35486;</a></li>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><div class="adj_lang flag-sprite my"></div> Malay</a></li>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/polish"><div class="adj_lang flag-sprite pl"></div> Polish</a></li>
                        <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><div class="adj_lang flag-sprite pt"></div> Portugu&#234;s</a></li>
                        <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><div class="adj_lang flag-sprite ru"></div> &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</a></li>
                        <?php if(IPLoc::Office()){ ?>
                            <li><a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/slovak"><div class="adj_lang flag-sprite sk"></div> Slovak</a></li>
                        <?php } ?>
                        <?php if(IPLoc::Office()){ ?>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/urdu"><div class="adj_lang flag-sprite pk"></div> Urdu</a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="md-reg-holder">
            <div class="hidden-reg-holder ext-arabic-hidden-reg-holder">
                <ul class="nav navbar-nav navbar-right ext-arabic-hidden-navbar-right ryt mobile-ryt">

                    <?php if($this->session->userdata('logged')){?>
                        <li id="loginname" class="loginname-drop">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?=lang('xnv_hi');?> &#44;  <?=$this->session->userdata('full_name')?> <span class="caret "></span>
                            </a>
                            <ul class="dropdown-menu btn-flag-dropdown btn-user-dropdown" role="menu" id="usermenu">
                                <li><a href="<?= FXPP::my_url('my-account'); ?>"> <?=lang('xnv_goto');?></a></li>
                                <li class="divider"></li>
                                <li><a href="<?=FXPP::my_url('signout')?>"><?=lang('xnv_LO');?></a></li>
                            </ul>



                        </li>
                    <?php }  else{?>

                        <li id="wl2">
                            <a href="https://www.forexmart.com/webterminal" target="_blank" class="mbtn btn-reg btn-reg2 custom-mbl-b">

                                <?=lang('xnv_webtrader');?>
                            </a>
                        </li>
                        <li id="pl2" ><a href="<?= FXPP::my_url('partner/signin');?>" target="_blank" class="mbtn btn-partner-reg custom-mbl-a">

                                <?=lang('xnv_PL');?>
                            </a></li>
                        <li id="cl2" >
                            <a href="<?= FXPP::my_url('client/signin');?>" target="_blank" class="mbtn btn-reg btn-reg2 btn-partner-reg custom-mbl-b">

                                <?=lang('xnv_CL');?>
                            </a></li>
                        <li id="r2">
                            <a target="_blank" href="<?= FXPP::loc_url('register');?>"  class="mbtn btn-login custom-mbl-c">
                                <?= $this->lang->line('ex_nav_reg'); ?>
                                <?=lang('xnv_R');?>
                            </a>
                        </li>

                    <?php }  ?>
                    <li class="showAlways2">
                        <div class="btn-replacement-link btn-reg-btn-tgl btn-flag-reg btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="flag_btn1" role="button">

                            <?php switch(FXPP::html_url()){
                                case 'en':
                                case '':
                                    ?>
                                    <img src="<?= $this->template->Images()?>flag.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'ru': ?>
                                    <img src="<?= $this->template->Images()?>flags/russia.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'jp': ?>
                                    <img src="<?= $this->template->Images()?>flags/japan.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'de': ?>
                                    <img src="<?= $this->template->Images()?>flags/germany.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'id': ?>
                                    <img src="<?= $this->template->Images()?>flags/indonezia.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'sa': ?>
                                    <img src="<?= $this->template->Images()?>flags/saudiarabia.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'fr': ?>
                                    <img src="<?= $this->template->Images()?>flags/france.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'es': ?>
                                    <img src="<?= $this->template->Images()?>flags/spain.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'it': ?>
                                    <img src="<?= $this->template->Images()?>flags/italy.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'pt': ?>
                                    <img src="<?= $this->template->Images()?>flags/portugal.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'bg': ?>
                                    <img src="<?= $this->template->Images()?>flags/bulgaria.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'my': ?>
                                    <img src="<?= $this->template->Images()?>flags/malaysia.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'pk': ?>
                                    <img src="<?= $this->template->Images()?>flags/pakistan.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'pl': ?>
                                    <img src="<?= $this->template->Images()?>flags/poland.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'gr': ?>
                                    <img src="<?= $this->template->Images()?>flags/greece.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'cs':?>
                                    <img src="<?= $this->template->Images()?>flags/czech.PNG" width="35" height="25" alt="" />
                                    <?php break;
                                case 'zh':
                                    ?>
                                    <img src="<?= $this->template->Images()?>flags/china.png" width="35" height="25" alt="" />
                                    <?php break;
                                case 'sk':?>
                                    <img src="<?= $this->template->Images()?>flags/slovakia.png" width="35" height="25" alt="" />
                                    <?php break;
                            }
                            ?>

                        </div>



                        <ul class="dropdown-menu btn-flag-dropdown dropdown-left-width" dir="ltr" id="flagmenu">
                            <?php if(IPLoc::Office()){ ?>
                                <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/arabic"><img class="adj_lang"  src="<?= $this->template->Images()?>flags/saudiarabia.png" width="35" height="25"  alt="Saudi Arabia Flag"> Arabic</a></li>
                            <?php } ?>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/bulgarian"><img class="adj_lang" src="<?= $this->template->Images()?>flags/bulgaria.png" width="35" height="25"  alt="Bulgaria Flag"> Bulgarian</a></li>

                            <li><a  href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/chinese"><img class="adj_lang" src="<?= $this->template->Images()?>flags/china.png" width="35" height="25"  alt="China Flag"> Chinese</a></li>

                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/Czech"><img class="adj_lang" src="<?= $this->template->Images()?>flags/czech.PNG" width="35" height="25"  alt="Czech Flag">Czech</a></li>
                            <li><a  href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english"><img class="adj_lang" src="<?= $this->template->Images()?>flag.png" width="35" height="25"  alt="English Flag"> English</a></li>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/spanish"><img  class="adj_lang" src="<?= $this->template->Images()?>flags/spain.png" width="35" height="25" alt="Spain Flag"> Espa&#241;ol</a></li>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/french"><img class="adj_lang" src="<?= $this->template->Images()?>flags/france.png" width="35" height="25" alt="France Flag"> Fran&#231;ais</a></li>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/german"><img class="adj_lang" src="<?= $this->template->Images()?>flags/germany.png" width="35" height="25" alt="Germany Flag"> German</a></li>
                            <?php if(IPLoc::Office()){ ?>
                                <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/greek"> <img class="adj_lang" src="<?= $this->template->Images()?>flags/greece.png" width="35" height="25" alt="Greece Flag">Greek</a></li>
                            <li style="display:none;"><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/italian"><img class="adj_lang" src="<?= $this->template->Images()?>flags/italy.png" width="35" height="25" alt="Italy Flag"> Italiano</a></li>
                            <?php } ?>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/indonesian"><img class="adj_lang" src="<?= $this->template->Images()?>flags/indonezia.png" width="35" height="25"  alt="Indonesian Flag"> Indonesian</a></li>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/japanese"><img class="adj_lang" src="<?= $this->template->Images()?>flags/japan.png" width="35" height="25" alt="Japan Flag"> &#26085;&#26412;&#35486;</a></li>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/malay"><img class="adj_lang" src="<?= $this->template->Images()?>flags/malaysia.png" width="35" height="25"  alt="Malaysia Flag"> Malay</a></li>
                            <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/polish"><img class="adj_lang" src="<?= $this->template->Images()?>flags/poland.png" width="35" height="25"  alt="Poland Flag"> Polish</a></li>
                            <li><a   href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/portuguese"><img class="adj_lang" src="<?= $this->template->Images()?>flags/portugal.png" width="35" height="25"  alt="Portugal Flag"> Portugu&#234;s</a></li>
                            <li><a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan"><img  class="adj_lang" src="<?= $this->template->Images()?>flags/russia.png" width="35" height="25" alt="Russia Flag"> &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</a></li>
                            <?php if(IPLoc::Office()){ ?>
                                <li><a  href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/slovak"><img class="adj_lang" src="<?= $this->template->Images()?>flags/slovakia.png" width="35" height="25"  alt="English Flag"> Slovak</a></li>
                            <?php } ?>
                            <?php if(IPLoc::Office()){ ?>
                                <li><a  href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/urdu">  <img class="adj_lang" src="<?= $this->template->Images()?>flags/pakistan.png" width="35" height="25"  alt="Pakistan Flag"> Urdu</a></li>
                            <?php } ?>


                        </ul>
                    </li>
                    <li>
                        <div class="input-group expand" id="searchtop">
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <a class="toggletop menu-icon menu-button navbar-toggle ext-arabic-menu-button menu-pos-left" id="menu-navbar" href="javascript:void(0)"></a>

    </div>


</nav>
<div id="nav" class="nav-holder" style="width: 100%;">
    <div class="container index-container ext-arabic-index-container">
        <div class="main-navigation ext-arabic-main-navigation">
            <ul class="nav navbar-nav ext-arabic-navbar-nav nn">
                <li class="page-link" data-target="#about">
                    <a onclick="false" class="c_hand "><?=lang('xnv_about');?></a>
                    <div class="fx-drp" id="about">
                        <div class="fx-drp-grid ext-arabic-search-link-grid">
                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a href="<?=FXPP::loc_url('why-choose-us')?>"><?=lang('xnv_WCu');?></a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?=FXPP::loc_url('deposit-withdraw-page')?>">
                                        <img src="<?= $this->template->Images()?>wd-icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_DW');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::loc_url('deposit-insurance')?>">
                                        <img src="<?= $this->template->Images()?>ins-icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_di');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::www_url('ecn')?>">
                                        <img src="<?= $this->template->Images()?>share-icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_ecn');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::www_url('about-us')?>">
                                        <img src="<?= $this->template->Images()?>about-us-icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_aboutforexmart');?>
                                    </a>
                                </li>
                            </ul>


                            <div class="clearfix"></div>
                            <div class="nav-line"></div>

                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder" style="font-size: 19px!important;color: #23527C!important;font-family: Georgia!important;">
                                <a href="<?=FXPP::www_url('sponsorship')?>"> <?=lang('xnv_sponsorship');?></a>
                            </div>
                            <ul class="fx-drp-link">

                                <!--<li><a href="<?//=FXPP::loc_url('rpj-racing')?>">
                                        <img src="<?//= $this->template->Images()?>RPJ4.png" alt=""  class="links-icon">
                                        <?//=lang('xnv_rpjracing');?>
                                    </a>
                                </li>-->
                                <li><a href="<?=FXPP::www_url('HKM_Zvolen')?>">
                                        <img src="<?= $this->template->Images()?>hockey_icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_hkm');?>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="nav-line"></div>
                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a href="<?=FXPP::www_url('awards')?>"><?=lang('xnv_awards');?></a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="nav-line"></div>
                            <ul class="fx-drp-link">
                                <li><a href="<?=FXPP::loc_url('licence-and-regulations')?>">
                                        <img src="<?= $this->template->Images()?>lr-icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_Lar');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::loc_url('news')?>">
                                        <img src="<?= $this->template->Images()?>banner-icon.png" alt=""  class="links-icon">
                                        <?=lang('xnv_news');?>
                                    </a>
                                </li>

                                <li><a href="<?=FXPP::www_url('meet-us-offline')?>">
                                        <img src="<?= $this->template->Images()?>meetus-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_muf');?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=FXPP::loc_url('ceo')?>">
                                        <img src="<?= $this->template->Images()?>legaldoc-icon.png" alt="" class="links-icon">
                                         <?=lang('xnv_lfCEO');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=FXPP::loc_url('License')?>">
                                        <img src="<?= $this->template->Images()?>lr-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_license');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=FXPP::loc_url('Team')?>">
                                        <img src="<?= $this->template->Images()?>team-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_team');?>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#fx">
                    <a onclick="false" class="c_hand "><?=lang('xnv_trading');?></a>
                    <div class="fx-drp" id="fx">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a href="<?=FXPP::loc_url($this->config->item('account-type'))?>">
                                    <?=lang('xnv_AT');?>
                                </a>
                            </div>
                            <ul class="fx-drp-link">
                                <li>
                                    <a href="<?=FXPP::loc_url('demo-account')?>">
                                        <img src="<?= $this->template->Images()?>demo-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_Da');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::loc_url('live-account/standard')?>"><img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_FMS');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::loc_url('live-account/spread')?>">
                                        <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_FMZS');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::loc_url('live-account/micro')?>">
                                        <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_FMMA');?>
                                    </a>
                                </li>
                                <li><a href="<?=FXPP::loc_url($this->config->item('account-type'))?>">
                                        <img src="<?= $this->template->Images()?>acct-com-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_AccCom');?>
                                    </a>
                                </li>
                                <?php  if(FXPP::html_url()!="pl"){ ?>
                                <li><a href="<?=FXPP::loc_url('leverage')?>">
                                        <img src="<?= $this->template->Images()?>leverage-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_leverage');?>
                                    </a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="<?=FXPP::loc_url('account-verification')?>">
                                        <img src="<?= $this->template->Images()?>av-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_AC');?>
                                    </a>
                                </li>
                                    <li>
                                        <a href="<?= FXPP::www_url('register');?>">
                                            <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon"  width="20">
                                            <?=lang('xnv_reg');?>
                                        </a>
                                    </li>

                            </ul>
                            <div class="clearfix"></div>
                            <div class="nav-line"></div> <!-- line -->
                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a href="<?=FXPP::loc_url('metatrader4')?>">
                                    <?=lang('xnv_TrPl');?>
                                </a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?=FXPP::loc_url('metatrader4')?>/#mt4-desktop">
                                        <img src="<?= $this->template->Images()?>mt4-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_FMMT4');?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=FXPP::loc_url('metatrader4')?>/#mt4-webterminal">
                                        <img src="<?= $this->template->Images()?>webtrader-icon.png" class="links-icon" width="20" alt="" />
                                        <?=lang('xnv_webtrader');?>
                                    </a>
                                </li>

                                <li><a href="https://www.forexmart.com/metatrader4/#mt4-mobile">
                                        <img src="<?= $this->template->Images()?>icon_mobilePlatform1.png" alt="Mobile flatform" class="links-icon">

                                          <?=lang('xnv_tpmv');?>
                                    </a>
                                </li>


                            </ul>
                            <div class="clearfix"></div>



                            <div class="nav-line"></div> <!-- line -->

                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a href="<?=FXPP::loc_url('financial-instruments')?>">
                                    <?=lang('xnv_Ins');?>
                                </a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?=FXPP::loc_url('financial-instruments/forex')?>"><img src="<?= $this->template->Images()?>forex-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_Fo');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=FXPP::loc_url('financial-instruments/shares')?>"><img src="<?= $this->template->Images()?>share-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_Sh');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=FXPP::loc_url('financial-instruments/spotmetals')?>"><img src="<?= $this->template->Images()?>sm-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_SpMe');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=FXPP::loc_url('financial-instruments/bitcoin')?>"><img src="<?= $this->template->Images()?>bitcoin2.png" alt="" class="links-icon">
                                        <?=lang('xnv_Bit');?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=FXPP::loc_url('financial-instruments/ruble')?>"><img src="<?= $this->template->Images()?>ruble-icon.png" alt="" class="links-icon">
                                        <?=(lang('xnv_ruble')=='')?'Ruble':lang('xnv_ruble');?>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#bo">
                    <a class="page-scroll c_hand " onclick="false">
                        <?=lang('xnv_BO');?>
                    </a>
                    <div class="fx-drp" id="bo">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a href="<?=FXPP::loc_url('bonuses')?>">
                                    <?=lang('xnv_Bon');?>
                                </a>
                            </div>
                            <ul class="fx-drp-link">
                                <li>
                                    <a href="<?=FXPP::loc_url('thirty-percent-bonus')?>"><img src="<?= $this->template->Images()?>wbonus-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_Web30');?>
                                    </a></li>
                                <li>
                                <li>
                                    <a href="<?=FXPP::loc_url('fifty-percent-bonus')?>"><img src="<?= $this->template->Images()?>wbonus-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_Web50');?>
                                    </a></li>
                                <li>
                                    <?php /*if (isset($_SESSION['user_id']) and isset($_SESSION['cookie_ndb']) ) { */?>
                                    <?php /*}else {*/?>
                                        <?php /*if ($this->input->cookie('forexmart_ndb_acquired') != 1 ){*/?>
                                        <?php /*}*/?>
                                    <?php /*}*/?>
                                    <a id="nodepositlinkId" href="<?=FXPP::loc_url('no-deposit-bonus')?>"><img src="<?= $this->template->Images()?>ndbonus-icon.png" alt="" class="links-icon nodepositlink">
                                        <?=lang('xnv_Nodebo');?>
                                    </a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>

                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <p class="cls-custome_demo">
                                    <?=lang('xnv_OnP');?>
                                </p>
                            </div>
                            <ul class="fx-drp-link">
                                <?php if(IPLoc::Office()){ ?>

                                    <li style="display: none;"><a href="<?=FXPP::loc_url('tiket-raffle')?>"><img src="<?= $this->template->Images()?>raffle-icon.png" alt="" class="links-icon raffle-icon">
                                            <?=lang('xnv_LPVtr');?>
                                    </a>
                                    </li>

                                <?php } ?>
                                <!-- FXPP-6585 -->
                                <li>
                                    <a href="<?=FXPP::loc_url('chance-bonus')?>"><img src="<?= $this->template->Images()?>chance-bonus-3.png" alt="" class="links-icon">
                                        <?=lang('xnv_TDraw');?>
                                    </a>
                                </li>
                                <!-- FXPP-6585 -->
                                    <?php $notChinese = ( (FXPP::html_url()=="zh") || ( IPLoc::isChinaIP() ) )?false:true;
                                    if( ($this->input->cookie('forexmart_affiliate')=='' || $this->input->cookie('forexmart_affiliate')=='IHXBM') && ($notChinese) ){ ?>
                                        <li><a href="<?=FXPP::loc_url('cashback')?>"><img src="<?= $this->template->Images()?>cashback-icon.png" class="links-icon" alt="" /> Cashback</a></li>
                                    <?php }?>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </li>

                    <li class="page-link" data-target="#ps">
                        <a class="page-scroll c_hand " onclick="false">
                            <?=lang('xnv_PAR')?>
                        </a>
                        <div class="fx-drp" id="ps">
                            <div class="fx-drp-grid">
                                <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">

                                    <?php if(IPLoc::Office()){ ?>
                                    <a href="<?=FXPP::loc_url('affiliate-program')?>">
                                        <?=lang('xnv_AffPr')?>
                                    </a>
                                    <?php } else{ ?>
                                        <a href="<?=FXPP::loc_url('affiliate-program')?>">
                                            <?=lang('xnv_AffPr')?>
                                        </a>
                                        <?php } ?>
                                </div>
                                <ul class="fx-drp-link">
                                    <li><a href="<?=FXPP::loc_url('partnership/advantages')?>">
                                            <img src="<?= $this->template->Images()?>choose-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Adv')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('affiliate-link')?>">
                                            <img src="<?= $this->template->Images()?>al-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_AffLi')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('commission-specification')?>"><img src="<?= $this->template->Images()?>cs-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Commspec')?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>

                                <div class="nav-line"></div> <!-- line -->
                                <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                    <a href="<?=FXPP::loc_url('partnership/friend-referrer')?>">
                                        <?=lang('xnv_TyofPa')?>
                                    </a>
                                </div>
                                <ul class="fx-drp-link">
                                    <li><a href="<?=FXPP::loc_url('partnership/friend-referrer')?>"><img src="<?= $this->template->Images()?>fr-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Frrefe')?>
                                        </a></li>
                                    <li><a href="<?=FXPP::loc_url('partnership/webmaster')?>"><img src="<?= $this->template->Images()?>web-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Web')?>
                                        </a></li>
                                    <li><a href="<?=FXPP::loc_url('partnership/online-partner')?>"><img src="<?= $this->template->Images()?>ol-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Onpar')?>
                                        </a></li>
                                    <li><a href="<?=FXPP::loc_url('partnership/local-online-partner')?>"><img src="<?= $this->template->Images()?>local-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Loonpa')?>
                                        </a></li>
                                    <li><a href="<?=FXPP::loc_url('partnership/local-office-partner')?>"><img src="<?= $this->template->Images()?>office-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Loofpa')?>
                                        </a></li>
                                    <li><a href="<?=FXPP::loc_url('partnership/cpa')?>"><img src="<?= $this->template->Images()?>cpa-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_cpa')?>
                                        </a></li>
                                </ul>
                                <div class="clearfix"></div>

                                <div class="nav-line"></div> <!-- line -->
                                <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                    <a href="<?=FXPP::loc_url('partnership/registration')?>">
                                        <?=lang('xnv_Parreg')?>
                                    </a>


                                </div>




                                <div class="nav-line"></div> <!-- line -->
                                <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                    <a href="#">
                                        <?=lang('xnv_Ma')?>

                                    </a>
                                </div>
                                <ul class="fx-drp-link">
                                    <li><a href="<?=FXPP::loc_url('banners')?>"><img src="<?= $this->template->Images()?>banner-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Ban')?>
                                        </a>
                                    </li>


                                    <li><a href="<?=FXPP::loc_url('logos')?>"><img src="<?= $this->template->Images()?>banner-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Logos')?>
                                        </a>
                                    </li>


                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/informers')?>"><img src="<?= $this->template->Images()?>fr-icon.png" alt="" class="links-icon" style="margin-right:6px;"><?=lang('xnv_informers')?></a>
                                    </li>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </li>
                    <li class="page-link" data-target="#cts">
                        <a class="page-scroll c_hand " href="<?=FXPP::loc_url('forex-contests/money-fall')?>">
                            <?=lang('xnv_C')?>
                        </a>
                    </li>

                <li class="page-link" data-target="#tools">
                    <a class="page-scroll c_hand " onclick="false">
                        <?=lang('xnv_Tools')?>
                    </a>
                    <div class="fx-drp" id="tools">
                        <div class="fx-drp-grid">
                            <div class="fx-drp-sub-holder ext-arabic-fx-drp-sub-holder">
                                <a class="non-clickable">
                                    <?=ucfirst(lang('xnv_Tools'));?>
                                </a>
                            </div>
                            <ul class="fx-drp-link">
                                <li><a href="<?=FXPP::loc_url('vps-hosting')?>"><img src="<?= $this->template->Images()?>hosting-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_VPSH')?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=FXPP::loc_url('currency-conversion')?>"><img src="<?= $this->template->Images()?>cc-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_CC')?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=FXPP::loc_url('forex-calculator')?>"><img src="<?= $this->template->Images()?>calc-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_PIPCalc')?>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>

                                <div class="nav-line"></div>
                                <div class="fx-drp-sub-holder">
                                    <a class="non-clickable"> <?=lang('xnv_edu')?></a>
                                </div>
                                <ul class="fx-drp-link">
                                    <li><a href="<?=FXPP::loc_url('how-to-get-started')?>"><img src="<?= $this->template->Images()?>get-started-icon.png" alt="" class="links-icon"> <?=lang('xnv_htgs')?></a></li>
                                    <li><a href="<?=FXPP::loc_url('forex-glossary')?>"><img src="<?= $this->template->Images()?>glossary-icon.png" alt="" class="links-icon"> <?=lang('xnv_glossary')?> </a></li>
                                    <li><a href="<?=base_url()?>assets/pdf/the-10-ideas-updated.pdf" target="_blank"><img src="<?= $this->template->Images()?>brochure-icon.png" alt="" class="links-icon"> <?=lang('xnv_edu_bro')?></a></li>
                                    <li><a id="presentationlink" data-toggle="modal" data-target="#presentation"><img src="<?= $this->template->Images()?>presentation-icon.png" alt="" class="links-icon"><?=lang('xnv_present')?> </a></li>
                                    <li><a href="<?=FXPP::loc_url('how-to-install-ea')?>"><img src="<?= $this->template->Images()?>install-icon.png" alt="" class="links-icon"><?=lang('xnv_install_ea')?></a></li>
                                </ul>
                            <div class="clearfix"></div>
                                <div class="nav-line"></div>
                                <div class="fx-drp-sub-holder">
                                    <a class="non-clickable"><?=lang('xnv_analytics')?></a>
                                </div>
                                <ul class="fx-drp-link">
                                    <li>
                                        <a href="<?=FXPP::loc_url('calendar')?>"><img src="<?= $this->template->Images()?>calendar-icon.png" alt="" class="links-icon"> <?=lang('xnv_j_ecalendar')?></a>
                                    </li>
                                    <?php if(IPLoc::Office()){ ?>
                                        <li>
                                            <a href="<?=FXPP::loc_url('forex-charts')?>"><img src="<?= $this->template->Images()?>chart-icon.png" alt="" class="links-icon">
                                                <?=lang('xnv_FoCh')?>
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <li><a href="<?=FXPP::loc_url('analytical-reviews')?>"><img src="<?= $this->template->Images()?>analytics-icon.png" alt="" class="links-icon"> <?=lang('xnv_analytical_reviews')?></a></li>

                                    <li><a href="<?=FXPP::loc_url('economic-news')?>"><img src="<?= $this->template->Images()?>news.png" alt="" class="links-icon"> <?=lang('xnv_econews')?></a></li>
                                </ul>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </li>
                <li class="page-link" data-target="#supt">
                    <a class="page-scroll c_hand " onclick="false">
                        <?=lang('xnv_S')?>
                    </a>
                    <div class="fx-drp" id="supt">
                        <div class="fx-drp-grid">
                            <ul class="fx-drp-link"> <!-- fx-drp-link-sub -->
                                <li>
                                    <a href="<?=FXPP::www_url('contact-us')?>">
                                        <img src="<?= $this->template->Images()?>con-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_Conus')?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=FXPP::loc_url('faq')?>">
                                        <img src="<?= $this->template->Images()?>faq-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_FAQ')?>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?=FXPP::loc_url('legal-documentation')?>">
                                        <img src="<?= $this->template->Images()?>legaldoc-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_LeDoc')?>
                                    </a>
                                </li>
                                 <li>
                                    <a href="<?=FXPP::www_url('call-back')?>">
                                        <img src="<?= $this->template->Images()?>cb-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_CaBa')?>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </li>


                <li class="page-link" data-target="#investment">
                    <a class="page-scroll c_hand " onclick="false">
                        <?=lang('xnv_investments')?>
                    </a>
                    <div class="fx-drp" id="investment">
                        <div class="fx-drp-grid">
                            <ul class="fx-drp-link">
                                <?php if(IPLoc::Office()){ ?>
                                    <li>
                                        <a href="<?=FXPP::www_url('pamm')?>">
                                            <img src="<?= $this->template->Images()?>pamm-moni-icon.png" class="links-icon" alt="" />
                                            PAMM
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="<?=FXPP::loc_url('Copytrade')?>">
                                        <img src="<?= $this->template->Images()?>icon_minifc.svg"class="links-icon" alt="" />
                                        <?=lang('xnv_copytade')?>
                                    </a>
                                </li>
                                <?php if(IPLoc::Office()){ ?>
                                    <li>
                                        <a href="<?=FXPP::loc_url('copytrader-viktor-dellos')?>">
                                            <img src="<?= $this->template->Images()?>icon_copytrader-viktor-01.png"class="links-icon" alt="" />
                                            Viktor Dellos
                                        </a>
                                    </li>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>

                </li>

            </ul>


                <ul class="nav navbar-nav navbar-right search-ryt ext-arabic-search-nyt">
                    <li>
                        <form class="navbar-form navbar-left search-form" role="search">
                            <div class="form-group">
                                <div class="input-group" id="headerAll">

                                </div>
                            </div>
                        </form>
                    </li>

                </ul>

            <div class="btn-top-holder">
                <ul class="nav navbar-nav navbar-right ryt ">
                    <li>
                        <a href="<?= FXPP::my_url('client/signin');?>" target="_blank" class="btn-reg1 custom-reg-btn">
                            <?=lang('xnv_L')?>
                        </a>
                    </li>

                    <li >
                        <a target="_blank" href="<?= FXPP::www_url('register')?>"  class="btn-reg1 custom-reg-btn">
                            <?=lang('xnv_R')?>
                        </a>
                    </li>
                    <li class="showAlways">
                        <button class="btn-reg1"><img src="<?= $this->template->Images()?>flag.png" alt="" width="30"/></button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="secondary-navigation " style="-webkit-backface-visibility: hidden;">
            <div class="hidden-menu">
                <div class="accordion" id="leftMenu">

                    <div class="accordion-group top-accordion-group hidden-top-accordion">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseZero">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                    <?=lang('xnv_LogReg');?>
                            </a>
                        </div>
                        <div id="collapseZero" class="accordion-body collapse" style="height: 0px; ">
                            <div class="accordion-inner">
                                <ul>


                                    <li class="active">
                                        <a href="<?= FXPP::my_url('partner/signin');?>" target="_blank"><img src="<?= $this->template->Images()?>partners-icon.png" alt="" width="20"/>  <?=lang('xnv_PL')?></a>
                                    </li>
                                    <li>
                                        <a href="<?= FXPP::my_url('client/signin');?>" target="_blank"><img src="<?= $this->template->Images()?>client-icon.png" alt="" width="20"/>  <?=lang('xnv_CL')?></a>
                                    </li>
                                    <li>
                                        <a href="<?= FXPP::www_url('register');?>" target="_blank"><img src="<?= $this->template->Images()?>register-icon.png" alt="" width="20"/>  <?=lang('xnv_R')?></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group top-accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseOne">
                                <i class="glyphicon glyphicon-menu-down"></i> <?=lang('xnv_about');?>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('why-choose-us')?>">
                                    <h1>
                                        <?=lang('xnv_WCu');?>
                                    </h1>
                                </a>

                                <ul>
                                    <li><a href="<?=FXPP::loc_url('deposit-withdraw-page')?>">
                                            <img src="<?= $this->template->Images()?>wd-icon.png" alt="" class="links-icon" width="20"/>
                                            <?=lang('xnv_DW');?>
                                        </a>
                                    </li>
                                    <li><a href="<?=FXPP::loc_url('deposit-insurance')?>">
                                            <img src="<?= $this->template->Images()?>ins-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_di');?>
                                        </a>
                                    </li>
                                    <li><a href="<?=FXPP::www_url('ecn')?>">
                                            <img src="<?= $this->template->Images()?>share-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_ecn');?>
                                        </a>
                                    </li>
                                    <li><a href="<?=FXPP::www_url('about-us')?>">
                                            <img src="<?= $this->template->Images()?>about-us-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_aboutforexmart');?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="accordion-inner divider-inner">
                                    <h1>
                                        <a href="<?=FXPP::www_url('sponsorship')?>"> <?=lang('xnv_sponsorship');?></a>
                                    </h1>

                                <ul>
                                   
                                    <!--<li>
                                        <a href="<?//=FXPP::loc_url('rpj-racing')?>">
                                            <img src="<?//= $this->template->Images()?>RPJ4.png" alt="" class="links-icon">
                                            <?//=lang('xnv_rpjracing');?>
                                        </a>
                                    </li>-->
                                    <li>
                                        <a href="<?=FXPP::www_url('HKM_Zvolen')?>">
                                            <img src="<?= $this->template->Images()?>hockey_icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_hkm');?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::www_url('awards')?>"> <h1><?=lang('xnv_awards');?> </h1></a>

                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('licence-and-regulations')?>">
                                            <img src="<?= $this->template->Images()?>lr-icon.png" alt="" class="links-icon" width="20"/>
                                            <?=lang('xnv_Lar');?>
                                        </a>
                                    </li>

                                    <li><a href="<?=FXPP::loc_url('news')?>">
                                            <img src="<?= $this->template->Images()?>banner-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_news');?>
                                        </a>
                                    </li>

                                    <li><a href="<?=FXPP::www_url('meet-us-offline')?>">
                                            <img src="<?= $this->template->Images()?>meetus-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_muf');?>
                                        </a>
                                    </li>

                                    <li><a href="<?=FXPP::loc_url('ceo')?>">
                                            <img src="<?= $this->template->Images()?>legaldoc-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_lfCEO');?>
                                        </a>
                                    </li>
                                    <li><a href="<?=FXPP::loc_url('License')?>">
                                        <img src="<?= $this->template->Images()?>lr-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_license');?>

                                    </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('Team')?>">
                                            <img src="<?= $this->template->Images()?>team-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_team');?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseTwo">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                <?=lang('xnv_trading');?>
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse" style="height: 0px; ">
                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url($this->config->item('account-type'))?>">
                                    <h1>
                                        <?=lang('xnv_AT');?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('demo-account')?>">
                                            <img src="<?= $this->template->Images()?>demo-icon.png" alt="" class="links-icon" width="20"/>
                                            <?=lang('xnv_Da');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('live-account/standard')?>">
                                            <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon" width="20"/>
                                            <?=lang('xnv_FMS');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('live-account/spread')?>">
                                            <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon"  width="20"/>
                                            <?=lang('xnv_FMZS');?>
                                        </a>
                                    </li>

                                    <li><a href="<?=FXPP::loc_url('live-account/micro')?>">

                                            <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon" />
                                            <?=lang('xnv_FMMA');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url($this->config->item('account-type'))?>">
                                            <img src="<?= $this->template->Images()?>acct-com-icon.png"  class="links-icon"  width="20"  alt="" />
                                            <?=lang('xnv_AccCom');?>
                                        </a>
                                    </li>
                                    <li><a href="<?=FXPP::loc_url('leverage')?>">
                                            <img src="<?= $this->template->Images()?>leverage-icon.png" class="links-icon" alt="" />
                                            <?=lang('xnv_leverage');?>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?=FXPP::loc_url('account-verification')?>">
                                            <img src="<?= $this->template->Images()?>av-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_AC');?>
                                        </a>
                                    </li>

                                    <!--                                <div class="clearfix"></div>-->
                                    <li>
                                         <a href="<?= FXPP::www_url('register');?>">
                                            <img src="<?= $this->template->Images()?>standard-icon.png" alt="" class="links-icon"  width="20">
                                            <?=lang('xnv_reg');?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>

                            </div>
                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('metatrader4')?>">
                                    <h1>
                                        <?=lang('xnv_FMMT4');?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('metatrader4')?>/#mt4-desktop">
                                            <img src="<?= $this->template->Images()?>mt4-icon.png" alt="" class="links-icon" width="20"/>
                                            <?=lang('xnv_FMMT4');?>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?=FXPP::loc_url('metatrader4')?>/#mt4-webterminal">
                                            <img src="<?= $this->template->Images()?>webtrader-icon.png" alt="" class="links-icon" width="20"/>
                                            <?=lang('xnv_webtrader');?>
                                        </a>
                                    </li>

                                    <li><a href="https://www.forexmart.com/metatrader4/#mt4-mobile">
                                            <img src="<?= $this->template->Images()?>icon_mobilePlatform1.png" alt="Mobile platform" class="links-icon">
                                            <?=lang('xnv_tpmv');?>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="accordion-inner">
                                <a href="<?=FXPP::loc_url('financial-instruments')?>">
                                    <h1>
                                        <?=lang('xnv_Ins');?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('financial-instruments/forex')?>">
                                            <img src="<?= $this->template->Images()?>forex-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Fo');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('financial-instruments/shares')?>">
                                            <img src="<?= $this->template->Images()?>share-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Sh');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('financial-instruments/spotmetals')?>">
                                            <img src="<?= $this->template->Images()?>sm-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_SpMe');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('financial-instruments/bitcoin')?>">
                                            <img src="<?= $this->template->Images()?>bitcoin2.png" alt="" class="links-icon">
                                            <?=lang('xnv_Bit');?>
                                        </a>
                                    </li>

                                        <li>
                                            <a href="<?=FXPP::loc_url('financial-instruments/ruble')?>"><img src="<?= $this->template->Images()?>ruble-icon.png" alt="" class="links-icon">
                                                <?=lang('xnv_ruble');?>
                                            </a>
                                        </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseThree">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                <?=lang('xnv_BO');?>
                            </a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse" style="height: 0px; ">

                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('bonuses')?>">
                                    <h1><?=lang('xnv_Bon');?></h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('thirty-percent-bonus')?>">
                                            <img src="<?= $this->template->Images()?>wbonus-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Web30');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('fifty-percent-bonus')?>">
                                            <img src="<?= $this->template->Images()?>wbonus-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Web50');?>
                                        </a>
                                    </li>
                                    <li>

                                        <?php /*if (isset($_SESSION['user_id']) and isset($_SESSION['cookie_ndb']) ) { */?>
                                        <?php /*}else {*/?>
                                            <?php /*if ($this->input->cookie('forexmart_ndb_acquired') != 1 ){*/?>
                                            <?php /*}*/?>
                                        <?php /*}*/?>

                                        <a href="<?=FXPP::loc_url('no-deposit-bonus')?>" class="nodepositlink">
                                            <img src="<?= $this->template->Images()?>ndbonus-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Nodebo');?>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="accordion-inner divider-inner">
                                <a href="#">
                                   <h1> <?=lang('xnv_OnP');?></h1>
                                </a>
                                <ul class="fx-drp-link link-align">

                                    <li class="ticket-raffle-hide"><a href="<?=FXPP::loc_url('tiket-raffle')?>"><img src="<?= $this->template->Images()?>raffle-icon.png" alt="" class="links-icon raffle-icon">
                                        <?=lang('xnv_LPVtr');?>
                                    </a></li>
                                    <!-- FXPP-6585 -->
                                    <li class="chance-list">
                                        <a href="<?=FXPP::loc_url('chance-bonus')?>"><img src="<?= $this->template->Images()?>chance-bonus-3.png" alt="" class="links-icon">
                                            <?=lang('xnv_TDraw');?>
                                        </a>
                                    </li>
                                      <?php $notChinese = ( (FXPP::html_url()=="zh") || ( IPLoc::isChinaIP() ) )?false:true;
                                    if( ($this->input->cookie('forexmart_affiliate')=='' || $this->input->cookie('forexmart_affiliate')=='IHXBM') && ($notChinese) ){ ?>
                                        <li><a href="<?=FXPP::loc_url('cashback')?>"><img src="<?= $this->template->Images()?>cashback-icon.png" class="links-icon" alt="" /> Cashback</a></li>
                                    <?php }?>
                                     
                                </ul>
                                <div class="clearfix"></div>
                            </div>


                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseFour">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                <?=lang('xnv_PAR')?>
                            </a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse" style="height: 0px; ">
                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('affiliate-program')?>">
                                    <h1>
                                        <?=lang('xnv_AffPr')?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/advantages')?>">
                                            <img src="<?= $this->template->Images()?>choose-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Adv')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('affiliate-link')?>">
                                            <img src="<?= $this->template->Images()?>al-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_AffLi')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('commission-specification')?>">
                                            <img src="<?= $this->template->Images()?>cs-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Commspec')?>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('partnership/friend-referrer')?>">
                                    <h1>
                                        <?=lang('xnv_TyofPa')?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/friend-referrer')?>">
                                            <img src="<?= $this->template->Images()?>fr-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Frrefe')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/webmaster')?>">
                                            <img src="<?= $this->template->Images()?>web-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Web')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/online-partner')?>">
                                            <img src="<?= $this->template->Images()?>ol-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Onpar')?>
                                        </a>
                                    </li><li>
                                        <a href="<?=FXPP::loc_url('partnership/local-online-partner')?>">
                                            <img src="<?= $this->template->Images()?>local-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Loonpa')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/local-office-partner')?>">
                                            <img src="<?= $this->template->Images()?>office-icon.png" alt=""  width="20"/>
                                            <?=lang('xnv_Loofpa')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/cpa')?>">
                                            <img src="<?= $this->template->Images()?>cpa-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_cpa')?>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('partnership/registration')?>">
                                    <h1>
                                        <?=lang('xnv_Parreg')?>
                                    </h1>
                                </a>
                            </div>
                            <div class="accordion-inner">
                                <a href="<?=FXPP::loc_url()?>">
                                    <h1>
                                        <?=lang('xnv_Ma')?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('banners')?>">
                                            <img src="<?= $this->template->Images()?>banner-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Ban')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('logos')?>">
                                            <img src="<?= $this->template->Images()?>banner-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_Logos')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('partnership/informers')?>"><img src="<?= $this->template->Images()?>fr-icon.png" alt="" class="links-icon" style="margin-right:6px;"><?=lang('xnv_informers')?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?=FXPP::loc_url('forex-contests/money-fall')?>">
                                <?=lang('xnv_C')?>
                            </a>
                        </div>
                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseFive">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                <?=lang('xnv_Tools')?>
                            </a>
                        </div>
                        <div id="collapseFive" class="accordion-body collapse" style="height: 0px; ">


                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url('partnership/friend-referrer')?>">
                                    <h1>
                                        <?=lang('xnv_Parreg')?>
                                    </h1>
                                </a>
                            </div>

                            <div class="accordion-inner divider-inner">
                                <a href="<?=FXPP::loc_url()?>">
                                    <h1>
                                        <?=ucfirst(lang('xnv_Tools'));?>
                                    </h1>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::loc_url('vps-hosting')?>">
                                            <img src="<?= $this->template->Images()?>hosting-icon.png" alt="" width="20"/>
                                           <?=lang('xnv_VPSH')?>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?=FXPP::loc_url('currency-conversion')?>">
                                            <img src="<?= $this->template->Images()?>cc-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_CC')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('forex-calculator')?>">
                                            <img src="<?= $this->template->Images()?>calc-icon.png" alt="" width="20"/>
                                            <?=lang('xnv_PIPCalc')?>
                                        </a>
                                    </li>
                                </ul>

                            </div>

                                <div class="accordion-inner divider-inner">
                                    <a href="#">
                                        <h1>
                                            <?=lang('xnv_edu')?>
                                        </h1>
                                    </a>
                                    <ul class="">
                                        <li><a href="<?=FXPP::loc_url('how-to-get-started')?>"><img src="<?= $this->template->Images()?>get-started-icon.png" alt="" class="links-icon"> <?=lang('xnv_htgs')?></a></li>
                                        <li><a href="<?=FXPP::loc_url('forex-glossary')?>"><img src="<?= $this->template->Images()?>glossary-icon.png" alt="" class="links-icon"> <?=lang('xnv_glossary')?> </a></li>
                                        <li><a href="<?=base_url()?>assets/pdf/the-10-ideas-updated.pdf" target="_blank"><img src="<?= $this->template->Images()?>brochure-icon.png" alt="" class="links-icon"> <?=lang('xnv_edu_bro')?></a></li>
                                        <li>
                                            <!-- presentationlink is dupicate ID. duplicate id not allowed-->
                                            <a id="presentationlink_1" data-toggle="modal" data-target="#presentation"><img src="<?= $this->template->Images()?>presentation-icon.png" alt="" class="links-icon"><?=lang('xnv_present')?> </a>
                                        </li>
                                        <li><a href="<?=FXPP::loc_url('how-to-install-ea')?>"><img src="<?= $this->template->Images()?>install-icon.png" alt="" class="links-icon"><?=lang('xnv_install_ea')?></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="accordion-inner divider-inner">
                                    <a href="#">
                                        <h1>
                                            <?=lang('xnv_analytics')?>
                                        </h1>
                                    </a>
                                    <ul class="">
                                        <li><a href="<?=FXPP::loc_url('calendar')?>"><img src="<?= $this->template->Images()?>calendar-icon.png" alt="" class="links-icon"> <?=lang('xnv_j_ecalendar')?></a></li>
                                        <?php if(IPLoc::Office()){ ?>
                                            <li><a href="<?=FXPP::loc_url('forex-charts')?>"><img src="<?= $this->template->Images()?>chart-icon.png" alt="" class="links-icon"><?=lang('xnv_FoCh')?> </a></li>
                                        <?php } ?>

                                        <li><a href="<?=FXPP::loc_url('analytical-reviews')?>"><img src="<?= $this->template->Images()?>analytics-icon.png" alt="" class="links-icon"> <?=lang('xnv_analytical_reviews')?></a></li>


                                        <li><a href="<?=FXPP::loc_url('economic-news')?>"><img src="<?= $this->template->Images()?>news.png" alt="" class="links-icon"> <?=lang('xnv_econews')?></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>


                        </div>
                    </div>



                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseSix">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                <?=lang('xnv_S')?>
                            </a>
                        </div>
                        <div id="collapseSix" class="accordion-body collapse" style="height: 0px; ">
                            <div class="accordion-inner">
                                <ul>
                                    <li>
                                        <a href="<?=FXPP::www_url('contact-us')?>">
                                            <img src="<?= $this->template->Images()?>con-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_Conus')?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=FXPP::loc_url('faq')?>">
                                            <img src="<?= $this->template->Images()?>faq-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_FAQ')?>
                                        </a>
                                    </li>
                                    <?php if(IPLoc::WhitelistPIPCandCC()){ ?>
                                    <!--<li>
                                        <a href="<?/*=FXPP::loc_url('forex-glossary')*/?>">
                                            <img src="<?/*= $this->template->Images()*/?>/glossary-icon.png" alt="" class="links-icon">
                                            <?/*=lang('xnv_ForGlo')*/?>
                                        </a>
                                    </li>-->
                                    <?php } ?>
                                    <li><a href="<?=FXPP::loc_url('legal-documentation')?>">
                                            <img src="<?= $this->template->Images()?>legaldoc-icon.png" alt="" class="links-icon">
                                            <?=lang('xnv_LeDoc')?>
                                        </a>
                                    </li>
                                     <li>
                                    <a href="<?=FXPP::www_url('call-back')?>">
                                        <img src="<?= $this->template->Images()?>cb-icon.png" alt="" class="links-icon">
                                        <?=lang('xnv_CaBa')?>
                                    </a>
                                  </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseSeven">
                                <i class="glyphicon glyphicon-menu-down"></i>
                                <?=lang('xnv_investments')?>
                            </a>
                        </div>
                        <div id="collapseSeven" class="accordion-body collapse" style="height: 0px; ">
                            <div class="accordion-inner">
                                <ul>
                                    <?php if(IPLoc::Office()){ ?>
                                        <li>
                                            <a href="<?=FXPP::www_url('pamm')?>">
                                                <img src="<?= $this->template->Images()?>pamm-moni-icon.png" alt="" class="links-icon" alt="" />
                                                PAMM
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="<?=FXPP::loc_url('Copytrade')?>">
                                            <img src="<?= $this->template->Images()?>icon_minifc.svg" class="links-icon" alt="" />
                                            <?=lang('xnv_copytade')?>
                                        </a>
                                    </li>

                                    <?php if(IPLoc::Office()){ ?>
                                    <li>
                                        <a href="<?=FXPP::loc_url('Copytrade')?>">
                                            <img src="<?= $this->template->Images()?>icon_copytrader-viktor-01.png" class="links-icon" alt="" />
                                            Viktor Dellos
                                        </a>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>



                    <div class="accordion-group">
                        <div class="headerAll accordion-heading accordion-search-form">
                            <div class="input-group expand input-width-search" id="mobilesearch">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="presentation" tabindex="-1" data-backdrop="static" role="dialog" style="padding-right: 0px !important;">
    <div class="modal-dialog round-0 modal-presentation">
        <div class="modal-content round-0" style="display: table;">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body modal-show-body bg">
                <div class="row">
                    <iframe sandbox="allow-same-origin allow-scripts allow-popups allow-forms" class="table-responsive" src='https://onedrive.live.com/embed?cid=573ED16FF0B49A67&resid=573ED16FF0B49A67%21122&authkey=AJiKZPTGPiGWltk&em=2&wdAr=1.7777777777777777' width='1186' height='691' style="border:none;" >
                    </iframe>
                </div>
            </div>
            <!-- <div class="modal-footer round-0">
                <button type="button" class="btn btn-primary round-0">Update</button>
            </div> -->
        </div>
    </div>
</div>

<link href="<?= $this->template->Css()?>nav-style-2.css" rel="stylesheet">
<script type="text/javascript">
    function iframeModalOpen(){

        // impostiamo gli attributi da aggiungere all'iframe es: data-src andr?ad impostare l'url dell'iframe
        $('#presentationlink').on('click', function(e) {
//            var src = $(this).attr('data-src');
            var width = $(this).attr('data-width') || 640; // larghezza dell'iframe se non impostato usa 640
            var height = $(this).attr('data-height') || 360; // altezza dell'iframe se non impostato usa 360

            var allowfullscreen = $(this).attr('data-video-fullscreen'); // impostiamo sul bottone l'attributo allowfullscreen se ?un video per permettere di passare alla modalit?tutto schermo

            // stampiamo i nostri dati nell'iframe
            $("#presentation iframe").attr({
                'height': height,
                'width': width,
                'allowfullscreen':''
            });
        });
    }
    $(document).ready(function () {
        $('.page-link').mouseover(function () {
            $($(this).data('target')).fadeIn("fast");
        });
        $('.page-link').mouseleave(function () {
            $($(this).data('target')).fadeOut("fast");
        });
        /*$(".hidden-menu").hide();
        $(".menu-button").show();
        $('.menu-button').click(function(){
            $(".hidden-menu").slideToggle();
            $(".hidden-menu").show();
        });*/
        iframeModalOpen();
    });

        $(document).ready(function(){
        (function($){jQuery.expr[':'].Contains=function(a,i,m){return(a.textContent||a.innerText||"").toUpperCase().indexOf(m[3].toUpperCase())>=0;};function listFilter(header,list){var form=$("<form>").attr({"class":"filterform","action":"#"}),input=$("<input>").attr({"id":"searchfield","class":"form-control round-0 filterinput","type":"text","placeholder":"<?=lang('search');?>"});$(form).append(input).appendTo(header);$(input).change(function(){var filter=$(this).val();if(filter){$(list).find("a:not(:Contains("+filter+"))").parent().slideUp();$(list).find("a:Contains("+filter+")").parent().slideDown();}else{$(list).find("li").slideDown();}return false;}).keyup(function(){if(!$("#searchfield").val().length==0){$(".searchscope").css('display','none');$("#searchloc").css('display','block');}else{$(".searchscope").css('display','block');$("#searchloc").css('display','none');}$(this).change();}).focus(function(){$(this).change();});}$(function(){listFilter($("#headerAll"),$(".list"));});}(jQuery));

        (function($){jQuery.expr[':'].Contains=function(a,i,m){return(a.textContent||a.innerText||"").toUpperCase().indexOf(m[3].toUpperCase())>=0;};function listFilter(header,list){var form=$("<form>").attr({"class":"filterformset","action":"#"}),input=$("<input>").attr({"id":"mysearchfield","class":"form-control round-0 filterinput","type":"text","placeholder":"<?=lang('search');?>"});$(form).append(input).appendTo(header);$(input).change(function(){var filter=$(this).val();if(filter){$(list).find("a:not(:Contains("+filter+"))").parent().slideUp();$(list).find("a:Contains("+filter+")").parent().slideDown();}else{$(list).find("li").slideDown();}return false;}).keyup(function(){if(!$("#mysearchfield").val().length==0){$(".searchscope").css('display','none');$("#searchloc").css('display','block');}else{$(".searchscope").css('display','block');$("#searchloc").css('display','none');}$(this).change();}).focus(function(){$(this).change();});}$(function(){listFilter($("#mobilesearch"),$(".list"));});}(jQuery));

        (function($){jQuery.expr[':'].Contains=function(a,i,m){return(a.textContent||a.innerText||"").toUpperCase().indexOf(m[3].toUpperCase())>=0;};function listFilter(header,list){var form=$("<form>").attr({"class":"filterformset","action":"#"}),input=$("<input>").attr({"id":"mysearchfieldt","class":"form-control hidden-search-form-control round-0 filterinput","type":"text","placeholder":"<?=lang('search');?>"});$(form).append(input).appendTo(header);$(input).change(function(){var filter=$(this).val();if(filter){$(list).find("a:not(:Contains("+filter+"))").parent().slideUp();$(list).find("a:Contains("+filter+")").parent().slideDown();}else{$(list).find("li").slideDown();}return false;}).keyup(function(){if(!$("#mysearchfieldt").val().length==0){$(".searchscope").css('display','none');$("#searchloc").css('display','block');}else{$(".searchscope").css('display','block');$("#searchloc").css('display','none');}$(this).change();}).focus(function(){$(this).change();});}$(function(){listFilter($("#searchtop"),$(".list"));});}(jQuery));

    });
</script>
<script type="text/javascript">

    $(function(){
            if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                $('#DLbutton').attr('data-loc','https://itunes.apple.com/app/metatrader-4/id496212596?l=en&mt=8');
                $('#DLdesc').html("<?= lang('mh_desc_ios')?>");
            }else if(navigator.userAgent.match(/(Android)/)){
                 $('#DLbutton').attr('data-loc','https://play.google.com/store/apps/details?id=net.metaquotes.metatrader4');
            }else{
                $('#DLbutton').attr('data-loc','https://play.google.com/store/apps/details?id=net.metaquotes.metatrader4');
                $('.screenMsgContainer').css('display','none');
            }

    });
</script>

<script type="text/javascript">

    $(function(){
        $('.screenMsg_btnClose').click(function(){
            $('.screenMsgContainer').slideUp('slow');
            var given_URL = $(this).data('givenurl');
            var site_url = "<?= base_url()?>";
            $.ajax({
                url: site_url+'Pages/mobile_header_hide_session',
                type: 'POST',
                data: {given_URL:given_URL}
            });
        });
        $('#DLbutton').click(function(){
            console.log($(this).data('loc'));
             window.location = $(this).data('loc');
        });
    });

</script>