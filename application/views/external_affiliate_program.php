
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->


<div class="division-container" id="affiliate-first-division">
    <div class="container">
        <div class="firstDivision">
            <h1 class="titlePage"><?=lang('affiliate_program_1')?></h1>
            <h2 class="division-title lg-text"><?=lang('affiliate_program_2')?></h2>
            <ul class="multiple-segment">
                <li class="justify-segment-rows">
                    <span class="round-container"><img src="<?php echo base_url();?>assets/images/icon-addAccount.png" class="img-responsive" alt="" /></span>
                    <h3 class="label-style1"><?=lang('affiliate_program_3')?></h3>
                </li>
                <li class><i class="fa fa-arrow-right fa-3x"></i></li>
                <li class="justify-segment-rows">
                    <span class="round-container"><img src="<?php echo base_url();?>assets/images/icon-handshake.png" class="img-responsive" alt="" /></span>
                    <h3 class="label-style1"><?=lang('affiliate_program_4')?></h3>
                </li>
                <li><i class="fa fa-arrow-right fa-3x"></i></li>
                <li class="justify-segment-rows">
                    <span class="round-container"><img src="<?php echo base_url();?>assets/images/icon-commission.png" class="img-responsive" alt="" /></span>
                    <h3 class="label-style1"><?=lang('affiliate_program_5')?></h3>
                </li>
            </ul>
            <a href="#affiliate-fifth-division"><button class=" universal-button button-style-1"><?=lang('affiliate_program_6')?></button></a>
        </div>
    </div>
</div>
<!---->
<script>
    $(function () {

        $('a[href*=#]').click(function(e) {
            //$(".tab-imgtitle").append(e.target);
            if(window.matchMedia("(max-width:497px)").matches){

                $('html,body').stop(true,true).animate({scrollTop:$('#friend').offset().top},500,'linear');
                $('html,body').stop(true,true).animate({scrollTop:$('#webmaster').offset().top},500,'linear');
                $('html,body').stop(true,true).animate({scrollTop:$('#onlinepartner').offset().top},500,'linear');
                $('html,body').stop(true,true).animate({scrollTop:$('#localonline').offset().top},500,'linear');
                $('html,body').stop(true,true).animate({scrollTop:$('#localoffice').offset().top},500,'linear');
                $('html,body').stop(true,true).animate({scrollTop:$('#cpa').offset().top},500,'linear');


            }

        });

    });
</script>


<div class="division-container" id="affiliate-second-division">
    <div class="container">
        <h2 class="division-title md-text"><?=lang('affiliate_program_7')?></h2>
        <ul class="nav nav-tabs nav-justified titleImage-tab affiliate-partner-tab">
            <li class="active">
                <a class="tab-imgtitle" data-toggle="tab" href="#friend"><span class="highlight-img"><img src="<?php echo base_url();?>assets/images/icon-best-choice.png"></span><span class="img-placer"><img src="<?php echo base_url();?>assets/images/icon-friendReferrer.png" class="img-responsive" alt="" /></span><?=lang('affiliate_program_8')?>
<!--                    <br><label style="font-size: 12px;" >Best choice to start</label>-->
                </a>

            </li>
            <li><a class="tab-imgtitle" data-toggle="tab" href="#webmaster"><span class="img-placer"><img src="<?php echo base_url();?>assets/images/icon-webmaster.png" class="img-responsive" alt="" /></span><?=lang('affiliate_program_9')?><label></label></a></li>
            <li><a class="tab-imgtitle" data-toggle="tab" href="#onlinepartner"><span class="img-placer"><img src="<?php echo base_url();?>assets/images/icon-onlinepartner.png" class="img-responsive" alt="" /></span><?=lang('affiliate_program_10')?></a></li>
            <li><a class="tab-imgtitle" data-toggle="tab" href="#localonline"><span class="img-placer"><img src="<?php echo base_url();?>assets/images/icon-localonline.png" class="img-responsive" alt="" /></span><?=lang('affiliate_program_11')?></a></li>
            <li><a class="tab-imgtitle" data-toggle="tab" href="#localoffice"><span class="img-placer"><img src="<?php echo base_url();?>assets/images/icon-localoffice.png" class="img-responsive" alt="" /></span><?=lang('affiliate_program_12')?></a></li>
            <li><a class="tab-imgtitle" data-toggle="tab" href="#cpa"><span class="img-placer"><img src="<?php echo base_url();?>assets/images/icon-cpa.png" class="img-responsive" alt="" /></span><?=lang('affiliate_program_13')?></a></li>
        </ul>
        <div class="tab-content tabcontent-body">
            <div id="friend" class="tab-pane fade in active">
                <h1>
                    <?=lang('affiliate_program_8')?>
                </h1>

                <p> <?=lang('affiliate_program_14')?></p>
                <h2 class="partner-sub"><?=lang('affiliate_program_15')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_16')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_17')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_18')?></span></li>
                </ul>
                <h2 class="partner-sub"><?=lang('affiliate_program_19')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_20')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_21')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_22')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_23')?></span></li>
                </ul>
            </div>

            <div id="webmaster" class="tab-pane">
                <h1>
                    <?=lang('affiliate_program_9')?>
                </h1>
                <p>
                    <?=lang('affiliate_program_24')?>
                </p>

                <h2 class="partner-sub"><?=lang('affiliate_program_25')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_26')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_27')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_28')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_29')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_30')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_31')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_32')?></span></li>

                </ul>
            </div>

            <div id="onlinepartner" class="tab-pane">
                <h1>
                    <?=lang('affiliate_program_10')?>
                </h1>
                <!--                <p>Launching a website? Improving an existing site? ForexMart got you covered! We have designed different user-friendly, glitch-free widgets, as well as promotional materials, which can be integrated into any website.</p>-->

                <h2 class="partner-sub"><?=lang('affiliate_program_33')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_34')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_35')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_36')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_37')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_38')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_39')?></span></li>
                </ul>
            </div>


            <div id="localonline" class="tab-pane">
                <h1>
                    <?=lang('affiliate_program_11')?>
                </h1>
                <p><?=lang('affiliate_program_40')?></p>
                <h2 class="partner-sub"><?=lang('affiliate_program_33')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_41')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_42')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_43')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_44')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_45')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_46')?></span></li>
                </ul>
            </div>

            <div id="localoffice" class="tab-pane">
                <h1>
                    
                    <?=lang('affiliate_program_47')?>
                </h1>
                <p><?=lang('affiliate_program_48')?></p>
                <h2 class="partner-sub"><?=lang('affiliate_program_33')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_49')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_50')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_51')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_52')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_53')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_54')?></span></li>
                </ul>
            </div>
            <div id="cpa" class="tab-pane">
                <h1>
                    <?=lang('affiliate_program_13')?>
                </h1>
                <p class="partner-text-ru">
                    <?=lang('affiliate_program_55')?>
                    </p>
                <h2 class="partner-sub"><?=lang('affiliate_program_56')?></h2>
                <ul class="demo-feats affiliate_partner">
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_57')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_58')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_59')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_60')?></span></li>
                    <li><i class="fa fa-check"></i><span><?=lang('affiliate_program_61')?></span></li>

                </ul>
            </div>
        </div>
    </div>
</div>

<div class="division-container" id="affiliate-third-division">
    <div class="container">
        <h2 class="division-title md-text"><?=lang('affiliate_program_62')?></h2>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 small-row">
                    <span class="roundedBox-container">
                        <img class="img-center" src="<?php echo base_url();?>assets/images/icon-pmanager.png" alt="" />
                    </span>
                <h3 class="label-style1"><?=lang('affiliate_program_63')?></h3>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 small-row">
                    <span class="roundedBox-container">
                        <img class="img-center" src="<?php echo base_url();?>assets/images/icon-techSpecialist.png" alt="" />
                    </span>
                <h3 class="label-style1"><?=lang('affiliate_program_64')?></h3>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 small-row">
                    <span class="roundedBox-container">
                        <img class="img-center" src="<?php echo base_url();?>assets/images/icon-banners.png" alt="" />
                    </span>
                <h3 class="label-style1"><?=lang('affiliate_program_65')?></h3>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 small-row">
                    <span class="roundedBox-container">
                        <img class="img-center" src="<?php echo base_url();?>assets/images/icon-paymentsSystem.png" alt="" />
                    </span>
                <h3 class="label-style1"><?=lang('affiliate_program_66')?></h3>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 small-row">
                    <span class="roundedBox-container">
                        <img class="img-center" src="<?php echo base_url();?>assets/images/icon-certificate.png" alt="" />
                    </span>
                <h3 class="label-style1"><?=lang('affiliate_program_67')?></h3>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 small-row">
                    <span class="roundedBox-container">
                        <img class="img-center" src="<?php echo base_url();?>assets/images/icon-statistics.png" alt="" />
                    </span>
                <h3 class="label-style1"><?=lang('affiliate_program_68')?></h3>
            </div>
        </div>
    </div>
</div>


<div class="division-container" id="affiliate-fourth-division">
    <div class="container">
        <h2 class="division-title lg-text"><?=lang('affiliate_program_69')?></h2>
        <p class="division-titleDetails"><?=lang('affiliate_program_70')?></p>
        <div class="row">
            <div class="col-md-6 sliders-container">

                <div class="fx-slider" id="progessber">
                    <!--                    <div id="range-output">client</div>-->
                    <input type="range" min="1" max="100" value="5"  style="width:100%;" id="client_range" >
                    <output></output>
                </div>

                <div class="fx-slider progessber2" id="progessber2">
                    <input type="range" min="1" max="100"  value="10" style="width:100%;" id="user_range">
                    <output></output>
                </div>
                <div class="" style="margin: 88px 0px;text-align: center">
                    <p class="f36" style="font-size: 38px; color: #51536c" ><?=lang('affiliate_program_71')?></p>
                    <p id="tot" style="font-size: 55px; color: #669b41"></p>
                </div>

            </div>
            <div class="col-md-6">
                <img  class="img-responsive displayImg" src="<?php echo base_url();?>assets/images/img-businessman.png" alt="" />
            </div>
        </div>
        <!-- <div class="image-overlay"><img src="<?php echo base_url();?>assets/images/img-businessman.png"></div>    -->
    </div>
</div>


<script>

    $(document).ready(function(){
        var result="<?=$postsubmited?>";
        if(result=="done") {
            $('html, body').scrollTop($('#affiliate-fifth-division').offset().top);
        }

    });

</script>


<div class="division-container" id="affiliate-fifth-division">
    <div class="container">
    <h2 class="division-title lg-text"><?=lang('affiliate_program_72')?></h2>

    <div class="aff-reg-holder">

        <!--            <h1>--><?//=lang('xnv_Parreg')?><!--</h1>-->

        <?php
        $flash = $this->session->flashdata("success");
        if(!isset($flash))
        {
            ?>
            <div class="row">
                <?= $this->load->ext_view('modal', 'reglimitprompt_p', '', TRUE); ?>
            <form method="post" id="affiliate_partn_registration" action="" name="affiliate_partn_registration">
                <!--                    <input type="hidden" name="url" id="url_base" value="--><?php //echo base_url();?><!--" />-->
                <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                <div class="col-md-6 col-sm-6">
                    <div class="inputText-groupContainer">

                        <div class="input-group ig">
                            <select class="inp-first-val form-control round-0 margin-ref select-box  registrationInput <?php echo (form_error('status_type') == "") ? "" : "red-border";?>" name="affiliate_type" id="affiliate_type">
                                <option value="">* <?=lang('x_pr_00')?></option>
                                <option value="friend-referrer"><?=lang('xnv_Frrefe')?></option>
                                <option value="webmaster"><?=lang('xnv_Web')?></option>
                                <option value="online-partner"><?=lang('xnv_Onpar')?></option>
                                <option value="local-online-partner"><?=lang('xnv_Loonpa')?></option>
                                <option value="local-office-partner"><?=lang('xnv_Loofpa')?></option>
                                <option value="cpa"><?=lang('xnv_cpa')?></option>
                            </select>
                            <div class="error_p" id="error_affiliate_type"><?php echo form_error('affiliate_type'); ?></div>
                        </div>


                        <div class="input-group ig">
                            <?php
                            $error_s = (form_error('status_type') == "") ? "" : "red-border";
                            $attr = 'id="status_type" class="select-box inp-first-val form-control registrationInput round-0 margin-ref '.$error_s.'"';
                            $stats_typ = array_merge(array('' => '* Status'), FXPP::getPartnersStatusType());
                            $selectedStatus = $this->input->post('status_type');
                            $set_value = isset($selectedStatus)?$selectedStatus:false;
                            ?>
                            <?php echo form_dropdown('status_type',$stats_typ,$selectedStatus,$attr);?>
                            <div class="error_p" id="error_status_type"><?php echo form_error('status_type'); ?></div>
                        </div>



                        <div class="input-group ig company-field ">
                            <input type="text" name="company_name" id="company_name" value="<?php echo set_value('company_name');?>" class="latin inp-company-field form-control registrationInput round-0 margin-ref <?=(form_error('company_name') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_01')?>"/>
                            <div class="error_p" id="error_company_name"><?php echo form_error('company_name'); ?></div>
                        </div>
                        <div class="input-group ig company-field">
                            <input type="text" name="registration_number" id="registration_number" value="<?php echo set_value('registration_number');?>" class="latin inp-company-field form-control registrationInput round-0 margin-ref <?=(form_error('registration_number') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_02')?>"/>
                            <div class="error_p" id="error_registration_number"><?php echo form_error('registration_number'); ?></div>
                        </div>
                        <div class="input-group ig company-field">
                            <input type="text" name="date_of_inc" id="date_of_inc" value="<?php echo set_value('date_of_inc');?>" class="latin inp-company-field datepicker form-control registrationInput round-0 margin-ref <?=(form_error('date_of_inc') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_03')?>"/>
                            <div class="error_p" id="error_date_of_inc"><?php echo form_error('date_of_inc'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname');?>" class="inp-first-val form-control registrationInput round-0 margin-ref <?=(form_error('fullname') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_04')?>" />
                            <div class="error_p" id="error_fullname"><?php echo form_error('fullname'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="email" name="email" id="email" value="<?php echo set_value('email');?>" class="latin_email inp-first-val form-control registrationInput round-0 margin-ref <?=(form_error('email') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_05')?>"/>
                            <div class="error_p" id="error_email"><?php echo form_error('email'); ?></div>
                        </div>
                        <div class="input-group ig">
                            <input type="hidden" name="phone_code" value="<?php echo $calling_code ?>" />
                            <input type="text" name="phone_number" id="phone_number" value="<?php echo $calling_code;?>" class="latin_phone inp-first-val form-control registrationInput round-0 margin-ref <?=(form_error('phone_number') == '') ? '' : 'red-border';?>" placeholder="* <?=lang('x_pr_06')?>"/>
                            <div class="error_p" id="error_phone_number"><?php echo form_error('phone_number'); ?></div>
                        </div>
                        <!--                        <div class="input-group ig margin-ref">-->
                        <!--                            <input type="text" id="phone_number" name="phone_number" class="inp-company-field inp-first-val form-control round-0 margin-ref --><?//=(form_error('phone_number') == '') ? '' : 'red-border';?><!-- ext-arabic-form-control-placeholder"/>-->
                        <!--                        </div>-->
                        <div class="input-group ig">
                            <input type="text" name="skype" id="skype" class="latin_skype form-control registrationInput round-0 margin-ref" placeholder="Skype"/>
                        </div>

                        <?php if($is_mobile['is_mobile']){ ?>
                        <input type="hidden" name="currency" value="<?php echo $is_mobile['currency']; ?>" />
                        <?php }else{ ?>
                        <div class="input-group ig">
                            <?php
                            $error_c = (form_error('currency') == "") ? "" : "red-border";
                            $attr = 'id="currency" class="select-box inp-first-val form-control registrationInput round-0 margin-ref '.$error_c.'"';
                            ?>
                            <?= form_dropdown('currency',$currency,$is_mobile['currency'],$attr);?>
                            <div class="error_p" id="error_currency"><?php echo form_error('currency'); ?></div>
                        </div>
                        <?php } ?>
                    </div>

                </div>
                <div class="col-md-6 col-sm-6">


                    <div class="input-group ig">
                        <?php
                        $error_c = (form_error('country') == "") ? "" : "red-border";
                        $attr = 'id="country" class="select-box inp-first-val form-control  registrationInput round-0 margin-ref '.$error_c.'"';
                        $country = $this->input->post('country');
                        $set_value = isset($country)?$country:false;
                        ?>
                        <?php echo form_dropdown('country',$countries,$country,$attr);?>
                        <div class="error_p" id="error_country"><?php echo form_error('country'); ?></div>
                    </div>
                    <div class="input-group ig">
                        <?php
                        $error_tc = (form_error('country') == "") ? "" : "red-border";
                        $attr = 'id="target_country" class="select-box inp-first-val form-control registrationInput round-0 margin-ref '.$error_tc.'"';
                        if(IPLoc::Office()){
                            $countries = array_merge(array('' => '* ' . lang('target')), FXPP::getAllCountries_localize());
                        }else{
                            $countries = array_merge(array('' => '* ' . lang('target')), FXPP::getCountries());
                        }
                        $target_country = $this->input->post('target_country');
                        $set_value = isset($target_country)?$target_country:false;
                        ?>
                        <?php echo form_dropdown('target_country',$countries,$set_value,$attr);?>
                        <div class="error_p" id="error_target_country"><?php echo form_error('target_country'); ?></div>
                    </div>
                    <div class="input-group ig margin-ref">
                        <input type="text" class="latin_website websites form-control  registrationInput less-marginB round-0 <?=(form_error('websites[]') == '') ? '' : 'red-border';?>" name="websites[]" placeholder="<?=lang('x_pr_07')?>">
                        <div class="input-group-addon round-0"><a id="addWebsite"><i class="fa fa-plus"></i></a></div>
                    </div>
                    <ul id="ulwebname"></ul>

                    <p class="registrationLabel p-italic"><?=lang('x_pr_08')?> (http://, https://, ftp://)</p>


                </div>
                <div class="col-md-6 col-sm-6">

                    <div class="inputText-groupContainer">
                        <div class="input-group ig">
                            <textarea type="text" id="message" name="message" class="latin form-control registrationInput less-marginB round-0 margin-ref <?=(form_error('message') == '') ? '' : 'red-border';?>" rows="6" placeholder="<?=lang('x_pr_09')?>"><?php echo set_value('message');?></textarea>
                        </div>
                        <div class="input-group ig">
                            <label class="agreement" style="font-weight: normal;">
                                <input id="agree-checkbox" type="checkbox">  <?=lang('agreeterms')?> 
                                <?php 
                                    switch(FXPP::html_url()){
                                        case 'id':
                                            $pdffile = $this->template->pdf().'PA/ID_ForexMartPartnershipAgreement.pdf';
                                            break;
                                        case 'ru':
                                            $pdffile = $this->template->pdf().'PA/RU_ForexMartPartnershipAgreement.pdf';
                                            break;
                                        default:
                                            $pdffile = $this->template->pdf().'PA/EN_ForexMartPartnershipAgreement.pdf';
                                            break;
                                    }
                                 ?>
                                <a href="<?php echo $pdffile; ?>"  target="_blank" >
                                <?=lang('terms_prtnshp')?></a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="btn-float-none">
                    <div class="input-group ig">
                        <!--                            <button type="button" class="btn-ref-complete" id="btn-complete-reg" onclick="goog_report_conversion();">Complete</button>-->
                        <button type="button" class="reset universal-button button-style-1" id="btn-complete-reg" onclick="goog_report_conversion();" ><?=lang('complete')?></button>
                    </div>
                </div>

            </form>

            <?php }else{ ?>
            <div class="ref-reg-holder-affiliate">
                <h1 style="color: #fff" class="affiliate-header"><?=lang('x_pr_10')?></h1>
                <p style="color: #fff"> <?=lang('x_pr_11')?> </p>
                <p style="color: #fff;"> <?=lang('x_pr_12')?></p>
                <p style="color: #fff;" class="add-msg"> <?=lang('x_pr_13')?></p>
                <p style="color: #fff" class="add-msg"> <?=lang('x_pr_14')?></p>
                <p style="color: #fff"> <?=lang('x_pr_15')?></p>
                <div class="input-group btn-centre-reg">
                    <button type="button" id="homeRedirect" class="btn-ref-complete">
                        <?=lang('x_pr_16')?>
                    </button>
                    <button type="button" id="acctRedirect" class="btn-ref-complete">Go to Cabinet</button>
                </div>
            </div>
            <?php } ?>


    </div>

    </div>



        <?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style type="text/css">

        @media screen and (max-width: 767px){
            .btn-float-none {
                float: none !important;
                width: 120px;
                margin: 0px auto;
            }
        }

        @media screen and (max-width: 450px) {
            .btn-centre-reg {
                margin: 0px auto;
            }
        }


        .fs-11{
            font-size:11px!important;
        }
        div.company-field{
            display: none;
        }

        ul#ulwebname {
            list-style: none;
            margin: 0 !important;
            padding: 0 !important;
        }

        i.fa-minus{
            color: red;
        }

        div.intl-tel-input{
            width: 100% !important;
        }

        ul.country-list{
            z-index: 100 !important;
        }
        ul.country-list .bg{
            min-height: 0px !important;
        }

    </style>


    <script src="<?= $this->template->Js()?>jquery.ui.widget.js"></script>
    <script src="<?= $this->template->Js()?>jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="<?= $this->template->Js()?>rangeslider.min.js"></script>
    <script>

        var client = $("#client_range").val();
        var user=$("#user_range").val();
        var total = (client*user*20)/2;
        document.getElementById("tot").innerHTML ='$'+total;

        $('#client_range').rangeslider({
            polyfill : false,
            onInit : function() {
                this.output = $( '<div class="range-output"/>' ).insertBefore( this.$range ).html( this.$element.val()+" <span style='font-size: 14px'><?=lang('affiliate_program_73')?></span>");
            },

            onSlide : function( position, value ) {
                this.output.html( value+" <span style='font-size: 14px'><?=lang('affiliate_program_73')?></span>" );
                var client = $("#client_range").val();
                var user=$("#user_range").val();
                var total = (client*user*20)/2;
                document.getElementById("tot").innerHTML ='$'+total;
                // console.log(this.output.html( value ));
            }
        });

        $('#user_range').rangeslider({
            polyfill : false,
            onInit : function() {
                this.output = $( '<div class="range-output"/>' ).insertBefore( this.$range ).html( this.$element.val()+" <span style='font-size: 14px'><?=lang('affiliate_program_74')?></span>");
            },

            onSlide : function( position, value ) {
                this.output.html( value+" <span style='font-size: 14px'><?=lang('affiliate_program_74')?></span>" );
                var client = $("#client_range").val();
                var user=$("#user_range").val();
                var total = (client*user*20)/2;
                document.getElementById("tot").innerHTML ='$'+total;
                // console.log(this.output.html( value ));
            }
        });

    </script>



    <script type="text/javascript">
        var baseurl = '<?php echo base_url();?>';

        var countryAbbr = "<?=strtolower($calling_code);?>";

        $(document).on('change', '#country, #target_country', function(){
            $.ajax({
                type: 'POST',
                url: baseurl+'register/checkCountryLimit',
                data: {country: $(this).val()},
                dataType: 'json',
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(response){
                    if( response.banned ){
                        $('#btn-complete-reg').attr('disabled', 'disabled');
                        $('#register_restrict').modal('show');
                    }else{
                        $('#btn-complete-reg').removeAttr('disabled');
                    }
                    $('#loader-holder').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            });
        });

        jQuery('#homeRedirect').click(function() {
            document.location.href="<?php echo $this->config->item('domain-my');?>/partner/signin";
        });

        jQuery('#open-trading-red').click(function() {
            document.location.href="<?php echo base_url();?>register";
        });
        jQuery('#open-demo-red').click(function() {
            document.location.href="<?php echo base_url('register/demo');?>";
        });
    </script>
        <?php if(!IPLoc::isChinaIP()){ ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        goog_snippet_vars = function() {
            var w = window;
            w.google_conversion_id = 946831952;
            w.google_conversion_label = "eugtCNWBk2EQ0IS-wwM";
            w.google_remarketing_only = false;
        }

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
            }
            var conv_handler = window['google_trackConversion'];
            if (typeof(conv_handler) == 'function') {
                conv_handler(opt);
            }
        }
        /* ]]> */
    </script>
    <script type="text/javascript"  src="//www.googleadservices.com/pagead/conversion_async.js"></script>
        <?php } ?>
        <?= $this->load->ext_view('modal', 'reglimit', '', TRUE); ?>
        <?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
        <?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>

    <style type="text/css">
        .error{
            color:red;
            font-size: 14px;
            font-weight: normal;
            text-align: left;
        }
    </style>


    <script type="text/javascript">
        $( document ).ready( function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
            );


            $('#affiliate_partn_registration').validate({ // initialize the plugin
                rules: {
                    company_name: {
                        regex: cyrillic
                    },
                    registration_number:{
                        regex: cyrillic
                    },
                    date_of_inc:{
                        regex:cyrillic
                    },
                    fullname:{
                        regex: cyrillic
                    },
                    phone_number:{
                        regex: cyrillic
                    },
                    skype:{

                        regex: cyrillic
                    },
                    message:{

                        regex: cyrillic
                    }
                },
                messages: {
                    company_name:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Company Name " + "<?=lang('validate_engrus2'); ?>"

                    },
                    registration_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Registration Number " + "<?=lang('validate_engrus2'); ?>"
                    },
                    date_of_inc:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Date of Incorporation " + "<?=lang('validate_engrus2'); ?>"

                    },
                    fullname:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Full Name " + "<?=lang('validate_engrus2'); ?>"

                    },
                    phone_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Phone Number " + "<?=lang('validate_engrus2'); ?>"

                    },
                    skype:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Skype " + "<?=lang('validate_engrus2'); ?>"

                    },
                    message:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Message " + "<?=lang('validate_engrus2'); ?>"

                    }
                },
                submitHandler: function (form) {
                    return true;
                }
            });

        });




        $("#phone_number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


    </script>

    </div>




