<link href="<?= $this->template->Css() ?>jquery.fileupload.css" rel="stylesheet">
<link href="<?= $this->template->Css() ?>jquery.switchButton.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<style>.div-choosefile{display:inline-block;width:100%;}.div-choosefile input[type="button"]{ float: left; } </style>
<style type="text/css">.offset-buttons-holder { float: left !important; margin-left: 50%;  }  #personal-next,#trading-next,#complete_btn,#employment-next{ min-width: 200px;  }  .error{font-size: 14px;font-weight: normal;text-align: left;}  .btn-up-file:hover{ color: white!important; text-decoration: none!important; }  .btn-up-file{ background: rgb(41, 166, 67) none repeat scroll 0% 0%; border-radius: 0px; transition: all 0.3s ease 0s; border: medium none; padding: 7px 10px; color: rgb(255, 255, 255); margin-top: 10px; margin-right: 15px; cursor: pointer; }  .flt-l{ float: left!important; }  .switch-button-label{ margin-top: 7px; }  .auto-generate{ font-weight: bold; margin-top: 4px; float: left; }  .error{ color: red;}  .error_p{ color: red;}  .nav-fix { position: fixed; top: 0; z-index: 9999; width: 100%; transition: all ease 0.3s; }  .demo{ margin-top:0px !important;}  .form-group > .col-sm-3 { padding-left: 0 !important; }  .col-sm-6 > label {  margin-top: 7px; }  .tooltip-inner { max-width: 250px; /* If max-width does not work, try using width instead */  width: 250px; }  .red { display: block; }  .col-with-tooltip { margin-right: -14px; padding-right: 30px; }  .lvstp{  font-size: 16px  }  .step-tab-holder1 ul li{  padding: 0 2px; }  .step-tab-holder1 ul li:lang(ru){ padding: 0 6px; }  .step-tab-holder1 ul li:lang(jp){  padding: 0 15px; }  .step-tab-holder1 ul li:lang(id){ padding: 0 8px; }  .step-tab-holder1 ul li:lang(de){ padding: 0 14px; }  .step-tab-holder1 ul li:lang(fr){ padding: 0 2px; }  .step-tab-holder1 ul li:lang(it){ padding: 0 10px; }  .step-tab-holder1 ul li:lang(sa){  padding: 0 5px; }  .step-tab-holder1 ul li:lang(es){  padding: 0px; font-size: 15px!important; }  .step-tab-holder1 ul li:lang(pt){  padding: 0 4px; }  .step-tab-holder1 ul li:lang(bg){  padding: 0 10px; }  .lvstp:lang(ru){ font-size: 16px  }  .lvstp:lang(de){ font-size: 16px }  .lvstp:lang(fr){ font-size: 14px }  .lvstp:lang(it){ font-size: 16px  }  .lvstp:lang(bg){ font-size: 16px }  .pull_r{ float: right; }
    @media screen and (min-width: 300px) and (max-width: 479px){ .task2163{ width: 100%; margin: auto } }
    @media screen and (min-width: 480px) and (max-width: 1000px){ .task2163{ width: 70%; margin: auto } }
    @media screen and (min-width: 979px) and  (max-width: 1198px){  .step-tab-holder1 ul li:lang(ru){ padding: 0 0px; }  .lvstp:lang(ru) { font-size: 12px!important; }  .lvstp:lang(id) { font-size: 12px!important;  }  .step-tab-holder1 ul li:lang(de){ padding: 0 0px; }  .lvstp:lang(de) { font-size: 12px!important; }  .step-tab-holder1 ul li:lang(fr){ padding: 0 0px; }  .lvstp:lang(fr) { font-size: 12px!important; }  .step-tab-holder1 ul li:lang(it){ padding: 0 0px; }  .lvstp:lang(it) { font-size: 12px!important; }  .step-tab-holder1 ul li:lang(es){  padding: 0 0px; }  .lvstp:lang(es) {  font-size: 12px!important; }  .step-tab-holder1 ul li:lang(pt){ padding: 0 0px; }  .lvstp:lang(pt) {  font-size: 12px!important;  }  .step-tab-holder1 ul li:lang(bg){ padding: 0 0px; }  .lvstp:lang(bg) { font-size: 12px!important; }  .step-tab-holder1 ul li:lang(my){  padding: 0 0px; }  .lvstp:lang(my) { font-size: 12px!important; }  .step-tab-holder1 ul li:lang(sa){ padding: 0 0px; }  .lvstp:lang(sa) { font-size: 12px!important; }  }
    @-moz-document url-prefix() {  @media screen and  (max-width: 1198px){ .step-tab-holder1 ul li:lang(es) { margin: 0px -38px; } }  }
    @media screen and (min-width: 460px) and (max-width: 599px){ .modal-reg-alert{width: 368px!important; } }
    @media screen and (min-width: 400px) and (max-width: 460px){  .modal-reg-alert{width: 337px!important; font-size: 9pt!important;} }
    @media screen and (max-width: 400px){.modal-reg-alert{ width: 267px!important;  font-size: 10pt!important; } }
    @media screen and (max-width: 600px){.offset-buttons-holder{ float: none!important; margin-left: 0!important; }  .personal-next{ display: inline-block!important;}}
    @media screen and (-webkit-min-device-pixel-ratio:0) and (max-width: 1198px) {  .step-tab-holder1 ul li:lang(es) { font-size: 12px!important; margin: 0px -5px; }  .step-tab-holder1 ul li:lang(fr) { margin: 0px -5px; }  .step-tab-holder1 ul li:lang(sa) { margin: 0px -5px; }  }  .pull_r li{ font-size:14px!important; }
</style>

<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="step-tab-holder1">
                <ul class="pull_r">
                    <li class="tabs-title1 color lvstp"><img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/>   <?= lang('reli_h1'); ?></li>
                    <li><img src="<?= $this->template->Images() ?>nxt.png" class="img-reponsive" width="50"/></li>
                    <li class="tabs-title2 lvstp"><img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/> <?= lang('reli_h2'); ?></li>
                    <li><img src="<?= $this->template->Images() ?>nxt.png" class="img-reponsive" width="50"/></li>
                    <li class="tabs-employment lvstp"><img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/> <?= lang('reli_h3'); ?></li>
                    <li><img src="<?= $this->template->Images() ?>nxt.png" class="img-reponsive" width="50"/></li>
                    <li class="tabs-title3 lvstp"><img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/>  <?= lang('reli_h4'); ?></li>
                </ul><div class="clearfix"></div>
            </div>
            <form method="POST" id="register-live" enctype="multipart/form-data" class="uploadimage task2163">
                <div class="tab-content" style="margin-top: 30px;">
                    <div role="tabpanel" class="tab-pane active row col-centered " id="personal">
                        <div class="col-lg-7 col-md-7 col-centered">
                            <div class="form-holder registration-form-holder">
                                <div class="title-registration-form-holder"><img class="img" src="<?= $this->template->Images() ?>step.png" width="50" height="50"/><h1> <?= lang('reli_00'); ?></h1></div>
                                <div class="clearfix"></div>
                                <div class="form-horizontal personal">
                                    <div class="form-group note-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_01'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 live-trading-note">
                                            <p class="note-top"><?= lang('note-top1'); ?></p>
                                            <input type="text" class="form-control round-0 required" maxlength="128" placeholder="<?= lang('reli_01_1'); ?>" name="street" value="<?php echo isset($user_details['street']) ? $user_details['street'] : '' ?>">
                                            <!--                            <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Address field should be up to 128 characters."></i></span>-->
                                            <span class="red"><?php echo form_error('street') ?></span>
                                        </div>
                                        <!--                        <i style="color: blue; vertical-align: middle;" id="tip_address" class="glyphicon glyphicon-question-sign"></i>-->
                                    </div>
                                    <div class="form-group note-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_02'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 live-trading-note">
                                            <p class="note-top"><?= lang('note-top2'); ?></p>
                                            <input type="text" class="form-control round-0 required" maxlength="32" placeholder="<?= lang('reli_02'); ?>" name="city" value="<?php echo isset($user_details['city']) ? $user_details['city'] : '' ?>">
                                            <!--                            <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="City field should be up to 32 characters."></i></span>-->
                                            <span class="red"><?php echo form_error('city') ?></span>
                                        </div>
                                        <!--                        <i style="color: blue; vertical-align: middle;" id="tip_city" class="glyphicon glyphicon-question-sign"></i>-->
                                    </div>
                                    <div class="form-group note-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_03'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 live-trading-note">
                                            <p class="note-top"><?= lang('note-top3'); ?></p>
                                            <input type="text" class="form-control round-0 required" maxlength="32" placeholder="<?= lang('reli_03'); ?>" name="state" value="<?php echo isset($user_details['state']) ? $user_details['state'] : '' ?>">
                                            <!--                            <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="State/Province field should be up to 32 characters."></i></span>-->
                                            <span class="red"><?php echo form_error('state') ?></span>
                                        </div>
                                        <!--                        <i style="color: blue; vertical-align: middle;" id="tip_state" class="glyphicon glyphicon-question-sign"></i>-->
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_04'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8">
                                            <select class="form-control round-0 required" id="country" name="country"><?php echo $countries; ?></select>
                                            <span class="red"><?php echo form_error('country') ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group note-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_05'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 live-trading-note">
                                            <p class="note-top"><?= lang('note-top4'); ?></p>
                                            <input type="text" class="form-control round-0 required" maxlength="16" placeholder="<?= lang('reli_05'); ?>" name="zip" value="<?php echo isset($user_details['zip']) ? $user_details['zip'] : '' ?>">
                                            <!--                            <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Postal/Zip Code field should be up to 16 characters."></i></span>-->
                                            <span class="red"><?php echo form_error('zip') ?></span>
                                        </div>
                                        <!--                        <i style="color: blue; vertical-align: middle;" id="tip_zip" class="glyphicon glyphicon-question-sign"></i>-->
                                    </div>
                                    <div class="form-group note-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_06'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 live-trading-note">
                                            <p class="note-top"><?= lang('note-top5'); ?></p>
                                            <input type="text" class="form-control round-0 required" maxlength="32" placeholder="<?= lang('reli_06'); ?>" name="phone" value="<?php echo isset($user_details['phone1']) ? $user_details['phone1'] : '+' . $calling_code ?>" >
                                            <input type="hidden" name="phone_code" value="<?php echo '+' . $calling_code ?>" />
                                            <!--                            <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Telephone field should be up to 32 characters."></i></span>-->
                                            <span class="red"><?php echo form_error('phone') ?></span>
                                        </div>
                                        <!--                        <i style="color: blue; vertical-align: middle;" id="tip_phone" class="glyphicon glyphicon-question-sign"></i>-->
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><?= lang('reli_07'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control round-0 datepicker required" placeholder="<?= lang('reli_07'); ?>" name="dob" value="<?php echo isset($user_details['dob']) ? date('Y-m-d', strtotime($user_details['dob'])) : '' ?>">
                                            <span class="red"><?php echo form_error('dob') ?></span>
                                        </div>
                                    </div>
                                    <?php
                                    if (true) {
                                        echo '<input style="display: none" type="checkbox" value="1" checked  name="auto_generate">';
                                    } else {
                                        ?>
                                        <div class="pass-hide" style="display: none">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?= lang('reli_08'); ?><cite class="req">*</cite></label>
                                                <div class="col-sm-8">
                                                    <input type="text" style="display: none" id="username" name="username" value="<?php echo $this->session->userdata('email_live'); ?>">
                                                    <input fv="pass" onblur="checkPassword(this.value)" id="pass" type="password" class="form-control round-0" placeholder="<?= lang('reli_08'); ?>" name="password">
                                                    <!--  <div class="pw-meter"></div>-->
                                                    <span id="error_password" class="red"><?php echo form_error('password') ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?= lang('reli_09'); ?><cite class="req">*</cite></label>
                                                <div class="col-sm-8">
                                                    <input fv="pass" id="repass" type="password" class="form-control round-0" placeholder="<?= lang('reli_09'); ?>" name="re_password">
                                                    <span class="red"><?php echo form_error('re_password') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"></label>

                                            <div class="col-sm-3">
                                                <div class="" id="auto_generate" style="display:inline-block; float: left;">
                                                    <div class="switch-wrapper" ><input type="checkbox" value="1"  name="auto_generate"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="auto-generate"><?= lang('reli_10'); ?>.</p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="offset-buttons-holder">
                                            <a href="javascript:void(0)" aria-controls="trading" role="tab" data-toggle="tab" class="offset-submit-button personal-next"><button id="personal-next" type="button" class="btn-submit"><?= lang('reli_ne'); ?></button></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane row col-centered " id="trading">
                        <div class="col-lg-8 col-md-8 col-centered">
                            <div class="form-holder registration-form-holder">
                                <div class="title-registration-form-holder">
                                    <img class="img" src="<?= $this->template->Images() ?>step.png" width="50" height="50"/>
                                    <h1><?= lang('reli_11'); ?></h1>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-horizontal form-max-holder">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_12'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="mt_account_set_id" id="mt_account_set_id">
                                                <?php echo $account_type; ?>
                                            </select>
                                            <span class="error_p" id="error_mt_account_set_id"><?php echo form_error('mt_account_set_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_13'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="mt_currency_base" id="mt_currency_base"><?php echo $account_currency_base; ?></select>
                                            <span class="error_p" id="error_mt_currency_base"><?php echo form_error('mt_currency_base'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_14'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="leverage" id="xleverage">
                                                <?php echo $leverage; ?>
                                            </select>
                                            <span class="error_p" id="error_leverage"><?php echo form_error('leverage'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-label-group">
                                        <label class="col-sm-4 no-data-label">&nbsp;</label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="checkbox-data">
                                                <input name="swap_free"<?php echo isset($user_details['swap_free']) ? $user_details['swap_free'] ? ' checked' : '' : '' ?> value="1" type="checkbox"/>
                                                <span><?= lang('reli_15'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_16'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 paragraph-data no-padding-column"><p><?= lang('reli_17'); ?></p></div>
                                    </div>
                                    <div class="form-group form-no-data-group form-no-label-group no-margin-column">
                                        <label class="col-sm-4 no-data-label">&nbsp;</label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="checkbox-data">
                                                <input id="agree-1" type="checkbox" name="experience" <?php echo isset($user_details['trading_experience_value'][0]) ? $user_details['trading_experience_value'][0] ? ' checked' : '' : '' ?> value="1"/>
                                                <span><?= lang('reli_18'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-data-group form-no-label-group no-margin-column">
                                        <label class="col-sm-4 no-data-label">&nbsp;</label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="checkbox-data">
                                                <input id="agree-2" type="checkbox" name="experience" <?php echo isset($user_details['trading_experience_value'][0]) ? $user_details['trading_experience_value'][1] ? ' checked' : '' : '' ?> value="2"/>
                                                <span><?= lang('reli_19'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-label-group no-margin-column">
                                        <label class="col-sm-4 no-data-label">&nbsp;</label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="checkbox-data">
                                                <input id="agree-3" type="checkbox" name="experience"<?php echo isset($user_details['trading_experience_value'][0]) ? $user_details['trading_experience_value'][2] ? ' checked' : '' : '' ?> value="3"/>
                                                <span><?= lang('reli_20'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-label-group">
                                        <label class="col-sm-4 no-data-label">&nbsp;</label>
                                        <div class="col-sm-8 paragraph-data no-padding-column">
                                            <p><?= lang('reli_22'); ?>?</p>
                                        </div>
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_21'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="investment_knowledge" id="investment_knowledge"><?php echo $investment_knowledge; ?></select>
                                            <span class="error_p" id="error_investment_knowledge"><?php echo form_error('investment_knowledge'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_23'); ?>?<cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="trade_duration" id="trade_duration"><?php echo $trade_duration; ?></select>
                                            <span class="error_p" id="error_trade_duration"><?php echo form_error('trade_duration'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_24'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="data-input-choice">
                                                <input value="1"<?php echo isset($user_details['politically_exposed_person']) ? $user_details['politically_exposed_person'] ? ' checked' : '' : '' ?> id="politically_exposed_person1" type="radio" class="rdo-btn-required" name="politically_exposed_person" />
                                                <span><?= lang('reli_ye'); ?></span>
                                            </div>
                                            <div class="data-input-choice">
                                                <input value="0"<?php echo isset($user_details['politically_exposed_person']) ? $user_details['politically_exposed_person'] ? '' : ' checked' : ' checked' ?> id="politically_exposed_person" type="radio" class="rdo-btn-required" name="politically_exposed_person" />
                                                <span><?= lang('reli_no'); ?></span>
                                            </div>
                                            <span class="error_p" id="error_politically_exposed_person"><?php echo form_error('politically_exposed_person'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_25'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="data-input-choice">
                                                <input value="1"<?php echo isset($user_details['risk']) ? $user_details['risk'] ? ' checked' : '' : ' checked' ?> id="risk1" type="radio" class="rdo-btn-required" name="risk" />
                                                <span><?= lang('reli_ye'); ?></span>
                                            </div>
                                            <div class="data-input-choice">
                                                <input value="0"<?php echo isset($user_details['risk']) ? $user_details['risk'] ? '' : ' checked' : '' ?> id="risk" type="radio" class="rdo-btn-required" name="risk" />
                                                <span><?= lang('reli_no'); ?></span>
                                            </div>
                                            <span class="error_p" id="error_risk"><?php echo form_error('risk'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="position:relative;">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_34'); ?></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <input maxlength="10" type="text" class="form-control affiliate-form-control round-0" placeholder="<?= lang('reli_34'); ?>" name="affiliateCodeStr">
                                            <input type="hidden" name="affiliate_code" id="affiliate_code" value="<?php echo $referral_code; ?>">
                                            <span class="error_p" id="error_affiliate_code"></span>

                                            <div><i style="margin-top:-23px!important; color: red; float:right;" class="tooltip-affiliate glyphicon glyphicon-question-sign" data-original-title="" title=""></i></div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="offset-buttons-holder">
                                            <div class="anchor-back-button">
                                                <a href="#personal" class="trading-back" aria-controls="personal" role="tab" data-toggle="tab" id="back"><?= lang('reli_ba'); ?></a>
                                            </div>
                                            <div class="anchor-submit-button">
                                                <a href="javascript:void(0)"  aria-controls="account" role="tab" data-toggle="tab" class="trading-next"><button id="trading-next" type="button" class="btn-submit"><?= lang('reli_ne'); ?></button></a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane row col-centered " id="employment">
                        <div class="col-lg-7 col-md-7 col-centered">
                            <div class="form-holder registration-form-holder">
                                <div class="title-registration-form-holder">
                                    <img class="img" src="<?= $this->template->Images() ?>step.png" width="50" height="50"/>
                                    <h1><?= lang('reli_26'); ?></h1>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-horizontal">
                                    <?= $this->load->ext_view('modal', 'reglimitprompt', '', TRUE); ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_27'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select id="employment_status" class="form-control round-0 required" name="employment_status" id="employment_status"><?php echo $employment_status; ?></select>
                                            <span class="error_p" id="error_employment_status"><?php echo form_error('employment_status'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group industry">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_28'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select id="industry" class="form-control round-0 emp-stat-cat" name="industry" id="industry">
                                                <?php echo $industry; ?>
                                            </select>
                                            <span class="error_p" id="error_industry"><?php echo form_error('industry'); ?></span>
                                        </div>
                                    </div>
                                    <?php /*
                                      <div class="form-group source_of_funds" style="display: none">
                                      <label class="col-sm-4 control-label no-padding-column-label">Source of Funds<cite class="req">*</cite></label>
                                      <div class="col-sm-8 no-padding-column">
                                      <select id="source_of_funds" class="form-control round-0 emp-stat-cat" name="source_of_funds" id="source_of_funds">
                                      <?php echo $source_of_funds;?>
                                      </select>
                                      <span class="error_p" id="error_source_of_funds"><?php echo form_error('source_of_funds'); ?></span>
                                      </div>
                                      </div>
                                     */
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_29'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="estimated_annual_income" id="estimated_annual_income"><?php echo $estimated_annual_income; ?></select>
                                            <span class="error_p" id="error_estimated_annual_income"><?php echo form_error('estimated_annual_income'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_30'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="estimated_net_worth" id="estimated_net_worth"><?php echo $estimated_net_worth; ?></select>
                                            <span class="error_p" id="error_estimated_net_worth"><?php echo form_error('estimated_net_worth'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_31'); ?><cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <select class="form-control round-0 required" name="education_level" id="education_level"><?php echo $education_level; ?></select>
                                            <span class="error_p" id="error_education_level"><?php echo form_error('education_level'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_32'); ?>?<cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="data-input-choice">
                                                <input value="1"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : '' ?> id="us_resident" type="radio" class="rdo-btn-required" name="us_resident" />
                                                <span><?= lang('reli_ye'); ?></span>
                                            </div>
                                            <div class="data-input-choice">
                                                <input value="0"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : ' checked' ?> id="us_resident" type="radio" class="rdo-btn-required" name="us_resident" />
                                                <span><?= lang('reli_no'); ?></span>
                                            </div>
                                            <span class="error_p" id="error_us_resident"><?php echo form_error('us_resident'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-4 control-label no-padding-column-label"><?= lang('reli_33'); ?>?<cite class="req">*</cite></label>
                                        <div class="col-sm-8 no-padding-column">
                                            <div class="data-input-choice">
                                                <input value="1"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : '' ?> id="us_citizen" type="radio" name="us_citizen" class="rdo-btn-required" />
                                                <span><?= lang('reli_ye'); ?></span>
                                            </div>
                                            <div class="data-input-choice">
                                                <input value="0"<?php echo isset($user_details['us_citizen']) ? $user_details['us_citizen'] ? '' : ' checked' : ' checked' ?> id="us_citizen" type="radio" name="us_citizen" class="rdo-btn-required" />
                                                <span><?= lang('reli_no'); ?></span>
                                            </div>
                                            <span class="error_p" id="error_us_citizen"><?php echo form_error('us_citizen'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="offset-buttons-holder">
                                            <div class="anchor-back-button"><a href="#trading" class="employment-back" aria-controls="personal" role="tab" data-toggle="tab" id="back"><?= lang('reli_ba'); ?></a></div>
                                            <div class="anchor-submit-button">
                                                <a href="javascript:void(0)"  aria-controls="account" role="tab" data-toggle="tab" class="trading-next"><button id="employment-next" type="button" class="btn-submit"><?= lang('reli_ne'); ?></button></a>
                                            </div>
                                        </div><div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane row col-centered " id="account">
                        <div class="col-lg-7 col-md-7 col-centered">
                            <div class="form-holder registration-form-holder">
                                <div class="title-registration-form-holder"><img class="img" src="<?= $this->template->Images() ?>step.png" width="50" height="50"/><h1><?= lang('reli_h4'); ?></h1></div>
                                <div class="clearfix"></div>
                                <div class="form-horizontal form-max-holder">
                                    <div class="form-group no-margin-column">
                                        <label class="col-sm-6 no-data-label">&nbsp;</label>
                                        <div class="col-sm-6 no-padding-column"><p class="optional"><i class="fa fa-info-circle"></i> (<?= lang('reli_35'); ?>.)</p></div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-6 right-align-label no-padding-column-label"><?= lang('reli_36'); ?> <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i></label>
                                        <div class="col-sm-6 paragraph-data form-file-input no-padding-column">
                                            <div id="s-front-id" class="docs-id" style="display:none"></div>
                                            <?php if (IPLoc::Office()) { ?>
                                                <div class="div-choosefile"><input type="file" name="filename[0]" class="flt-l chbt" id="s-f0" /></div>
                                            <?php } else { ?><input type="file" name="filename[0]" class="flt-l" id="s-f0"/><?php } ?>
                                            <a class="btn-up-file flt-l" name="s-front-id"  onclick="return false;"><i class="fa fa-upload"></i> <?= lang('upload_button'); ?></a>
                                            <p style="float: left"><?= lang('reli_37'); ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group block-form-group">
                                        <label class="col-sm-6 right-align-label no-padding-column-label"><?= lang('reli_38'); ?> <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i></label>
                                        <div class="col-sm-6 paragraph-data form-file-input no-padding-column">
                                            <div id="s-back-id" class="docs-id" style="display:none"></div>
                                            <?php if (IPLoc::Office()) { ?>
                                                <div class="div-choosefile"><input type="file" name="filename[1]" class="flt-l chbt" id="s-f1"/></div>
                                            <?php } else { ?><input type="file" name="filename[1]" class="flt-l" id="s-f1"/><?php } ?>
                                            <a class="btn-up-file flt-l" name="s-back-id"  onclick="return false;"><i class="fa fa-upload"></i> <?= lang('upload_button'); ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-data-group block-form-group">
                                        <label class="col-sm-6 right-align-label no-padding-column-label"><?= lang('reli_39'); ?> <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i></label>
                                        <div class="col-sm-6 paragraph-data form-file-input no-padding-column">
                                            <div id="s-proof-residence" class="docs-id" style="display:none"></div>
                                            <?php if (IPLoc::Office()) { ?>
                                                <div class="div-choosefile"><input type="file" name="filename[2]" class="flt-l chbt" id="s-f2"></div>
                                            <?php } else { ?><input type="file" name="filename[2]" class="flt-l" id="s-f2"><?php } ?>
                                            <div>
                                                <a class="btn-up-file flt-l" name="s-proof-residence"  onclick="return false;"><i class="fa fa-upload"></i> <?= lang('upload_button'); ?></a>
                                                <p style="float: left"><?= lang('reli_40'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-label-group form-no-data-group form-title-max no-margin-pad-label">
                                        <label class="col-sm-6 no-data-label">&nbsp;</label><div class="col-sm-6 title-form-group no-padding-column"><p><?= lang('reli_41'); ?></p></div>
                                    </div>
                                    <div class="form-group form-no-label-group form-no-data-group no-margin-column">
                                        <label class="col-sm-6 no-data-label">&nbsp;</label>
                                        <div class="col-sm-6 paragraph-data no-padding-column" style="display: inline-flex">
                                            <div class="checkbox-data" style="width: auto !important;"><input  type="checkbox" value="1" checked name="technical_analysis" /></div>
                                            <p>&nbsp; <?= lang('reli_42'); ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group form-no-label-group form-no-data-group form-title-max no-margin-pad-label">
                                        <label class="col-sm-6 no-data-label">&nbsp;</label><div class="col-sm-6 title-form-group no-padding-column"><p><?= lang('reli_43'); ?></p></div>
                                    </div>
                                    <div class="form-group form-no-label-group no-margin-column" style="display: inline-flex">
                                        <label class="col-sm-6 no-data-label">&nbsp;</label>
                                        <div class="col-sm-6 paragraph-data no-padding-column">
                                            <div class="checkbox-data"><input id="agree-checkbox" type="checkbox" /></div>
                                            <p>&nbsp; <?= lang('reli_44'); ?>
                                                <a href="<?= $this->config->item('domain-www'); ?>/Terms-and-conditions" class="company"><?= lang('reli_45'); ?></a>
                                                <?= lang('reli_50') ?>
                                                <a href="<?= $this->config->item('domain-www'); ?>/privacy-policy" class="company"><?= lang('reli_46'); ?></a>
                                                , <?= lang('reli_47'); ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="offset-buttons-holder">
                                            <div class="anchor-back-button"><a href="#employment" aria-controls="trading" role="tab" data-toggle="tab" class='back-employment' id="back"><?= lang('reli_ba'); ?></a></div>
                                            <div class="anchor-submit-button">
                                                <?php if (!IPLoc::isChinaIP()) { ?>
                                                    <button id="complete_btn" type="button" class="btn-submit" onclick="goog_report_conversion(); ga('send', 'event', 'button', 'click', 'complete'); return true;"><?= lang('reli_48'); ?></button>
                                                <?php } else { ?><button id="complete_btn" type="button" class="btn-submit"><?= lang('reli_48'); ?></button><?php } ?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'register_restrict', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'register_alert', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'client-scoring', '', TRUE); ?>

<script src="<?= $this->template->Js() ?>jquery.easing.min.js"></script>
<script src="<?= $this->template->Js() ?>jquery-input-file-text.js"></script>
<script src="<?= $this->template->Js() ?>jquery.ui.widget.js"></script>
<script src="<?= $this->template->Js() ?>jquery.switchButton.js"></script>
<script src="<?= $this->template->Js() ?>jquery.iframe-transport.js"></script>
<script src="<?= $this->template->Js() ?>jquery.fileupload.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<?php if (IPLoc::Office()) { ?>
    <script>
                                                        function scoreCalculate(item_name, previus_score) {
                                                            var score_return = parseInt(previus_score);
                                                            var opti_item = 0;
                                                            switch (item_name) {
                                                                case 'trading_experience':
                                                                    if ($("#agree-1").is(':checked')) {
                                                                        score_return = score_return + 4;
                                                                        opti_item = 1;
                                                                    }
                                                                    if ($("#agree-2").is(':checked')) {
                                                                        score_return = score_return + 2;
                                                                        opti_item = 2;
                                                                    }
                                                                    if ($("#agree-3").is(':checked')) {
                                                                        score_return = score_return + 4;
                                                                        opti_item = 3;
                                                                    }
                                                                    break;
                                                                case 'investment_knowledge':
                                                                    var knowlege_lavel = $("#investment_knowledge").val();
                                                                    switch (knowlege_lavel) {
                                                                        case '0':
                                                                            score_return = score_return;
                                                                            opti_item = knowlege_lavel;
                                                                            break;
                                                                        case '1':
                                                                            score_return = score_return + 2;
                                                                            opti_item = knowlege_lavel;
                                                                            break;
                                                                        case '2':
                                                                            score_return = score_return + 1;
                                                                            opti_item = knowlege_lavel;
                                                                            break;
                                                                        case '3':
                                                                            score_return = score_return + 1;
                                                                            opti_item = knowlege_lavel;
                                                                            break;
                                                                    }
                                                                    break;
                                                                case 'investment_risk':
                                                                    if ($("#risk1").is(':checked')) {
                                                                        score_return = score_return + 4;
                                                                        opti_item = 'first';
                                                                    }
                                                                    if ($("#risk").is(':checked')) {
                                                                        score_return = score_return;
                                                                        opti_item = 'second';
                                                                    }
                                                                    break;
                                                                case 'trade_duration':
                                                                    var trade_duration_level = $("#trade_duration").val();
                                                                    switch (trade_duration_level) {
                                                                        case '0':
                                                                            score_return = score_return + 4;
                                                                            opti_item = trade_duration_level;
                                                                            break;
                                                                        case '1':
                                                                            score_return = score_return + 3;
                                                                            opti_item = trade_duration_level;
                                                                            break;
                                                                        case '2':
                                                                            score_return = score_return + 1;
                                                                            opti_item = trade_duration_level;
                                                                            break;
                                                                        default :
                                                                            score_return = score_return;
                                                                            opti_item = 'default';
                                                                    }
                                                                    break;
                                                                case 'employment_status':
                                                                    // var employment_status_level=$("#employment_status").val();
                                                                    score_return = score_return + 1;
                                                                    opti_item = '1';
                                                                    break;
                                                                case 'industry':
                                                                    var industry_level = $("#industry").val();
                                                                    switch (industry_level) {
                                                                        case '0':
                                                                            score_return = score_return + 3;
                                                                            opti_item = industry_level;
                                                                            break;
                                                                        case '3':
                                                                            score_return = score_return + 4;
                                                                            opti_item = industry_level;
                                                                            break;
                                                                        case '9':
                                                                            score_return = score_return + 3;
                                                                            opti_item = industry_level;
                                                                            break;
                                                                        case '13':
                                                                            score_return = score_return + 3;
                                                                            opti_item = industry_level;
                                                                            break;
                                                                        default :
                                                                            score_return = score_return + 1;
                                                                            opti_item = 'default';
                                                                    }
                                                                    break;
                                                                case 'education_level':
                                                                    var education_level = $("#education_level").val();
                                                                    switch (education_level) {
                                                                        case '0':
                                                                            score_return = score_return + 1;
                                                                            opti_item = education_level;
                                                                            break;
                                                                        case '1':
                                                                            score_return = score_return + 1;
                                                                            opti_item = education_level;
                                                                            break;
                                                                        case '2':
                                                                            score_return = score_return + 2;
                                                                            opti_item = education_level;
                                                                            break;
                                                                        case '3':
                                                                            score_return = score_return + 2;
                                                                            opti_item = education_level;
                                                                            break;
                                                                        case '4':
                                                                            score_return = score_return + 2;
                                                                            opti_item = education_level;
                                                                            break;
                                                                        default :
                                                                            score_return = score_return + 4;
                                                                            opti_item = 'default';
                                                                    }
                                                                    break;
                                                            }
                                                            return score_return;
                                                        }
                                                        $(document).on("click", "#low_scoring_submit", function () {
                                                            if ($("#low_scoring_allow").is(':checked')) {
                                                                $("#register-live").submit();
                                                                $("#myModal").modal('hide');
                                                            } else {
                                                                alert("You need to agree with risk disclosure.");
                                                            }
                                                        });
                                                        $(document).on("click", "#complete_btn", function () {
                                                            if ($("#agree-checkbox").is(':checked')) {
                                                                var client_score = 0;
                                                                client_score = parseInt(scoreCalculate('trading_experience', client_score)); // agree-1
                                                                client_score = parseInt(scoreCalculate('investment_knowledge', client_score)); // investment_knowledge
                                                                client_score = parseInt(scoreCalculate('investment_risk', client_score)); // risk1
                                                                client_score = parseInt(scoreCalculate('trade_duration', client_score));  // trade_duration
                                                                client_score = parseInt(scoreCalculate('employment_status', client_score));
                                                                client_score = parseInt(scoreCalculate('industry', client_score));
                                                                client_score = parseInt(scoreCalculate('education_level', client_score)); // education_level
                                                                if (parseInt(client_score) < 15) {
                                                                    $("#myModal").modal('show');
                                                                } else {
                                                                    $("#register-live").submit();
                                                                }
                                                            } else {
                                                                $("#modal-alert").modal('show');
                                                            }
                                                        });
    </script>
<?php } else { ?>
    <script>
        function scoreCalculate(item_name, previus_score) {
            var score_return = parseInt(previus_score);
            var opti_item = 0;
            switch (item_name) {
                case 'trading_experience':
                    if ($("#agree-1").is(':checked')) {
                        score_return = score_return + 4;
                        opti_item = 1;
                    }
                    if ($("#agree-2").is(':checked')) {
                        score_return = score_return + 2;
                        opti_item = 2;
                    }

                    if ($("#agree-3").is(':checked')) {
                        score_return = score_return + 4;
                        opti_item = 3;
                    }

                    break;

                case 'investment_knowledge':
                    var knowlege_lavel = $("#investment_knowledge").val();
                    switch (knowlege_lavel) {
                        case '0':
                            score_return = score_return;
                            opti_item = knowlege_lavel;
                            break;
                        case '1':
                            score_return = score_return + 2;
                            opti_item = knowlege_lavel;
                            break;
                        case '2':
                            score_return = score_return + 1;
                            opti_item = knowlege_lavel;
                            break;
                        case '3':
                            score_return = score_return + 1;
                            opti_item = knowlege_lavel;
                            break;
                    }
                    break;
                case 'investment_risk':
                    if ($("#risk1").is(':checked')) {
                        score_return = score_return + 4;
                        opti_item = 'first';
                    }
                    if ($("#risk").is(':checked')) {
                        score_return = score_return;
                        opti_item = 'second';
                    }
                    break;
                case 'trade_duration':
                    var trade_duration_level = $("#trade_duration").val();
                    switch (trade_duration_level) {
                        case '0':
                            score_return = score_return + 4;
                            opti_item = trade_duration_level;
                            break;
                        case '1':
                            score_return = score_return + 3;
                            opti_item = trade_duration_level;
                            break;
                        case '2':
                            score_return = score_return + 1;
                            opti_item = trade_duration_level;
                            break;
                        default :
                            score_return = score_return;
                            opti_item = 'default';
                    }
                    break;
                case 'employment_status':
                    // var employment_status_level=$("#employment_status").val();
                    score_return = score_return + 1;
                    opti_item = '1';
                    break;
                case 'industry':
                    var industry_level = $("#industry").val();
                    switch (industry_level) {
                        case '0':
                            score_return = score_return + 3;
                            opti_item = industry_level;
                            break;
                        case '3':
                            score_return = score_return + 4;
                            opti_item = industry_level;
                            break;
                        case '9':
                            score_return = score_return + 3;
                            opti_item = industry_level;
                            break;
                        case '13':
                            score_return = score_return + 3;
                            opti_item = industry_level;
                            break;
                        default :
                            score_return = score_return + 1;
                            opti_item = 'default';
                    }
                    break;
                case 'education_level':
                    var education_level = $("#education_level").val();
                    switch (education_level) {
                        case '0':
                            score_return = score_return + 1;
                            opti_item = education_level;
                            break;
                        case '1':
                            score_return = score_return + 1;
                            opti_item = education_level;
                            break;
                        case '2':
                            score_return = score_return + 2;
                            opti_item = education_level;
                            break;
                        case '3':
                            score_return = score_return + 2;
                            opti_item = education_level;
                            break;
                        case '4':
                            score_return = score_return + 2;
                            opti_item = education_level;
                            break;
                        default :
                            score_return = score_return + 4;
                            opti_item = 'default';
                    }
                    break;
            }
            return score_return;
        }
        $(document).on("click", "#low_scoring_submit", function () {
            if ($("#low_scoring_allow").is(':checked')) {
                $("#register-live").submit();
                $("#myModal").modal('hide');
            } else {
                alert("You need to agree with risk disclosure.");
            }
        });
        $(document).on("click", "#complete_btn", function () {
            if ($("#agree-checkbox").is(':checked')) {
                var client_score = 0;
                client_score = parseInt(scoreCalculate('trading_experience', client_score)); // agree-1
                client_score = parseInt(scoreCalculate('investment_knowledge', client_score)); // investment_knowledge
                client_score = parseInt(scoreCalculate('investment_risk', client_score)); // risk1
                client_score = parseInt(scoreCalculate('trade_duration', client_score));  // trade_duration
                client_score = parseInt(scoreCalculate('employment_status', client_score));
                client_score = parseInt(scoreCalculate('industry', client_score));
                client_score = parseInt(scoreCalculate('education_level', client_score)); // education_level
                // alert(client_score);
                if (parseInt(client_score) < 15) {
                    $("#myModal").modal('show');
                } else {
                    $("#register-live").submit();
                }
            } else {
                alert('<?=lang('alert_agree')?>');
            }
        });
    </script>
<?php } ?>
<script>
    $(function () {
        $('#basic.demo input').switchButton();
        $('#basic2.demo input').switchButton();
        $("#auto_generate input").switchButton({
            on_label: 'ON',
            off_label: 'OFF',
            labels_placement: "right",
            width: 50,
            height: 25,
            button_width: 25
        });
        $("#default.demo input").switchButton({checked: false});
        $("#labels2-1.demo input").switchButton({show_labels: false});
        $("#labels2-2.demo input").switchButton({labels_placement: "right"});
        $("#labels2-3.demo input").switchButton({labels_placement: "left"});
        $("#slider-1.demo input").switchButton({width: 100, height: 40, button_width: 50});
        $("#slider-2.demo input").switchButton({width: 100, height: 40, button_width: 70});
    })
</script>
<script>
    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                        );
            }
        }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });

    $(document).ready(function () {
        var isMobile = window.matchMedia("only screen and (max-width: 1328px)");
        if (isMobile.matches) {
            $('.tooltip-affiliate').tooltip({title: "<p align='left'><?= lang('tooltip_affiliate1'); ?></p>", html: true, placement: "top"});
        } else {
            $('.tooltip-affiliate').tooltip({title: "<p align='left'><?= lang('tooltip_affiliate1'); ?></p>", html: true, placement: "right"});
        }

    });


    $(document).ready(function () {

        var isMobile2 = window.matchMedia("only screen and (max-width: 767px)");
        if (isMobile2.matches) {
            $('.tooltip-upload-docs').tooltip({title: "<p align='left' style='padding: 5px !important;'><?= lang('upload_image_error'); ?></p>", html: true, placement: "top"});
        } else {
            $('.tooltip-upload-docs').tooltip({title: "<p align='left' style='padding: 5px !important;'><?= lang('upload_image_error'); ?></p>", html: true, placement: "right"});
        }

    });
    $(document).on("change", "[name=auto_generate]", function () {
        $(".pass-hide").toggle();
    });
    var baseurl = '<?php echo base_url(); ?>';
    $(document).ready(function () {

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-95:-18",
            minDate: '-95Y',
            maxDate: '-18Y'
        });
        $('#tip_address').tooltip({title: "<p align='left' style='padding: 5px !important;'>Address field should be up to 128 characters.</p>", html: true, placement: "right"});
        $('#tip_city').tooltip({title: "<p align='left' style='padding: 5px !important;'>City field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('#tip_state').tooltip({title: "<p align='left' style='padding: 5px !important;'>State/Province field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('#tip_zip').tooltip({title: "<p align='left' style='padding: 5px !important;'>Postal/Zip Code field should be up to 16 characters.</p>", html: true, placement: "right"});
        $('#tip_phone').tooltip({title: "<p align='left' style='padding: 5px !important;'>Telephone field should be up to 32 characters.</p>", html: true, placement: "right"});
    });
    $(document).on('change', '#country', function () {
        $.ajax({
            type: 'POST',
            url: baseurl + 'register/checkCountryLimit',
            data: {country: $(this).val()},
            dataType: 'json',
            beforeSend: function () {
                $('#loader-holder').show();
            },
            success: function (response) {
                if (response.banned) {
                    $('#personal-next').attr('disabled', 'disabled');
                    $('#register_restrict').modal('show');
                } else {
                    $('#personal-next').removeAttr('disabled');
                }
                if (response.leverage_list) {
                    $('#leverage').html(response.leverage_list);
                }
                $('#loader-holder').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
            }
        });
    });
    $(document).ready(function () {
        var forexmart = "<?php echo FXPP::ajax_url(); ?>";
        var pblc = [];
        pblc['request'] = null;
        if (pblc['request'] != null)
            pblc['request'].abort();

        //Document 1
        $('a[name=s-front-id]').click(function () {
            /* perform action here */
            console.log(1);
            $('div#s-front-id').show();
            $('div#s-front-id').html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            var file_data = $("#s-f0").prop("files")[0];
            console.log(file_data);
            var myFormData = new FormData();
            myFormData.append('file', file_data);
            myFormData.append('doc_type', 0);
            pblc['request'] = $.ajax({
                url: forexmart + 'query/upload/' + $.now(),
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                dataType: 'json',
                data: myFormData
            });
            pblc['request'].done(function (response) {
                if (response.error) {
                    if (response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>' && response.msgError_ext === false) {
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>, <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    } else {
                        var rtnError = response.msgError;
                    }
                    $('div#s-front-id').html('<div class="alert alert-danger">' + rtnError + '</div>');
                } else {
                    $('div#s-front-id').html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
            pblc['request'].fail(function (jqXHR, textStatus) {

            });
        });
        //Document 2
        $('a[name=s-back-id]').click(function () {
            /* perform action here */
            console.log(2);
            $('div#s-back-id').show();
            $('div#s-back-id').html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            var file_data = $("#s-f1").prop("files")[0];
            console.log(file_data);
            var myFormData = new FormData();
            myFormData.append('file', file_data);
            myFormData.append('doc_type', 1);
            pblc['request'] = $.ajax({
                url: forexmart + 'query/upload/' + $.now(),
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                dataType: 'json',
                data: myFormData
            });
            pblc['request'].done(function (response) {
                if (response.error) {
                    if (response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>') {
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>, <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    } else {
                        var rtnError = response.msgError;
                    }
                    $('div#s-back-id').html('<div class="alert alert-danger">' + rtnError + '</div>');
                } else {
                    $('div#s-back-id').html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
            pblc['request'].fail(function (jqXHR, textStatus) {

            });
        });

        //Document 3
        $('a[name=s-proof-residence]').click(function () {
            /* perform action here */
            console.log(3);
            $('div#s-proof-residence').show();
            $('div#s-proof-residence').html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            var file_data = $("#s-f2").prop("files")[0];
            console.log(file_data);
            var myFormData = new FormData();
            myFormData.append('file', file_data);
            myFormData.append('doc_type', 2);
            pblc['request'] = $.ajax({
                url: forexmart + 'query/upload/' + $.now(),
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                dataType: 'json',
                data: myFormData
            });
            pblc['request'].done(function (response) {
                if (response.error) {
                    if (response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>') {
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>, <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    } else {
                        var rtnError = response.msgError;
                    }
                    $('div#s-proof-residence').html('<div class="alert alert-danger">' + rtnError + '</div>');
                } else {
                    $('div#s-proof-residence').html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
            pblc['request'].fail(function (jqXHR, textStatus) {

            });
        });
    });
</script>
<?php if (!IPLoc::isChinaIP()) { ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        goog_snippet_vars = function () {
            var w = window;
            w.google_conversion_id = 946831952;
            w.google_conversion_label = "eugtCNWBk2EQ0IS-wwM";
            w.google_remarketing_only = false;
        }

        // DO NOT CHANGE THE CODE BELOW.
        goog_report_conversion = function (url) {
            goog_snippet_vars();
            window.google_conversion_format = "3";
            window.google_is_call = true;
            var opt = new Object();
            opt.onload_callback = function () {
                if (typeof (url) != 'undefined') {
                    window.location = url;
                }
            }
            var conv_handler = window['google_trackConversion'];
            if (typeof (conv_handler) == 'function') {
                conv_handler(opt);
            }
        }
        /* ]]> */
    </script>

    <script type="text/javascript"  src="//www.googleadservices.com/pagead/conversion_async.js"></script>
<?php } ?>
<script type="text/javascript">
    $("input").keyup(function () {
        this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
    });
    $("textarea").keyup(function () {
        this.value = this.value.replace(/[^0-9a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod(
                "regex",
                function (value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
                );
        $('#register-live').validate({// initialize the plugin
            rules: {
                street: {required: true, regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"},
                city: {required: true, regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"},
                state: {required: true, regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"},
                zip: {required: true, regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"},
                phone: {required: true, regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ$ \.\,\+\-\_\:\/]*$"},
                dob: {required: true, regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\_\:\/]*$"}
            },
            messages: {
                street: {required: "<?= lang('validate_engrus0'); ?>" + " address.", regex: "<?= lang('validate_engrus1'); ?>" + " Street Address " + "<?= lang('validate_engrus2'); ?>"},
                city: {required: "<?= lang('validate_engrus0'); ?>" + " City.", regex: "<?= lang('validate_engrus1'); ?>" + " City " + "<?= lang('validate_engrus2'); ?>"},
                state: {required: "<?= lang('validate_engrus0'); ?>" + " State.", regex: "<?= lang('validate_engrus1'); ?>" + " State " + "<?= lang('validate_engrus2'); ?>"},
                zip: {required: "<?= lang('validate_engrus0'); ?>" + " Postal/Zip Code.", regex: "<?= lang('validate_engrus1'); ?>" + " Postal/Zip Code " + "<?= lang('validate_engrus2'); ?>"},
                phone: {required: "<?= lang('validate_engrus0'); ?>" + " Phone Number.", regex: "<?= lang('validate_engrus1'); ?>" + " Phone Number " + "<?= lang('validate_engrus2'); ?>"},
                dob: {required: "<?= lang('validate_engrus0'); ?>" + " Date of Birth.", regex: "<?= lang('validate_engrus1'); ?>" + " Date of Birth " + "<?= lang('validate_engrus2'); ?>"}
            },
            submitHandler: function (form) {
                return true;
            }
        });
    });
</script>
<div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0 modal-reg-alert">
        <div class="modal-content round-0" style="width: 60%;margin-left: 20%;margin-top:30%;">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= lang('alert_agree'); ?>
            </div>
        </div>
    </div>
</div>
<?php if (IPLoc::Office()) { ?>
    <script>
        $('#s-f0').inputFileText({
            text: '<?= lang('choosefile_button'); ?>'
        });
        $('#s-f1').inputFileText({
            text: '<?= lang('choosefile_button'); ?>'
        });
        $('#s-f2').inputFileText({
            text: '<?= lang('choosefile_button'); ?>'
        });
    </script>
<?php } ?>
<script type="text/javascript">
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 95) {
            $('#nav').addClass('nav-fix');
        } else {
            $('#nav').removeClass('nav-fix');
        }
    });
    $(document).ready(function () {
        $("#next").click(function () {
            $(".info-text").text("Your Almost Done.");
        });
        $("#back").click(function () {
            $(".info-text").text("Thank you, You're half way to completing your demo account.");
        });
    });
    $(document).ready(function () {
        "use strict";
        var options = {};
        options.ui = {
            container: "#pwd-container",
            showVerdictsInsideProgressBar: true,
            viewports: {progress: ".pw-meter"}
        };
        options.common = {
            onKeyUp: function (evt, data) {
                if (data.score < 20) {
                    jQuery('.progress-bar').css('width', '20%');
                }
                if (jQuery('#pass').val() == '') {
                    jQuery('.progress-bar').css('width', '0%');
                }
            }
        };
        $('#pass').pwstrength(options);
        /*$(".personal-next").click(function(){
         $(".tabs-title1").removeClass("color");
         $(".tabs-title2").addClass("color");
         });
         $(".trading-next").click(function(){
         $(".tabs-title2").removeClass("color");
         $(".tabs-title3").addClass("color");
         });*/
        $(".employment-back").click(function () {
            $(".tabs-employment").removeClass("color");
            $(".tabs-title2").addClass("color");
        })
        $(".trading-back").click(function () {
            $(".tabs-title2").removeClass("color");
            $(".tabs-title1").addClass("color");
        });
        $(document).on("click", ".back-employment", function () {
            $(".tabs-title3").removeClass("color");
            $(".tabs-employment").addClass("color");
        });
    });
    var SaveFlag = true;
    $(document).on("click", "#personal-next", function () {
        var flag = true;
        $("#personal input.required,#personal select").each(function () {
            if ($("[name=auto_generate]").is(':checked'))
            {
                if ($(this).attr('fv') != 'pass')
                {
                    if ($(this).val().length > 0)
                    {
                        $(this).closest('div').next('span.red').html("");
                        $(this).removeClass("red-border");

                    } else {
                        $(this).closest('div').next('span.red').html("<p>This is a required field.</p>");
                        $(this).addClass("red-border");
                        $(this).focus();
                        flag = false;
                    }
                } else {
                    $(this).closest('div').next('span.red').html("");
                    $(this).removeClass("red-border");
                }
            } else {
                if ($(this).val().length > 0)
                {
                    if ($(this).attr("name") == 'phone') {
                        if ($(this).val().length < $('[name=phone_code]').val().length + 5) {
                            $(this).closest('div').next('span.red').html("<p>This is a required field.</p>");
                            $(this).addClass("red-border");
                            $(this).focus();
                            flag = false;
                        }
                    } else {
                        $(this).closest('div').next('span.red').html("");
                        $(this).removeClass("red-border");
                    }
                } else {
                    $(this).closest('div').next('span.red').html("<p>This is a required field.</p>");
                    $(this).addClass("red-border");
                    $(this).focus();

                    flag = false;
                }
            }
        });
        if (!$("[name=auto_generate]").is(':checked'))
        {
            var $pass = $("#pass").val();
            var $repass = $("#repass").val();
            if ($pass.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)) {
                $("#pass").next('span.red').text("");
                $("#pass").removeClass("red-border");

            } else {
                $("#pass").next('span.red').text("Minimum of 8 characters, combination of a-z, A-Z and at least one digit,0-9.");
                $("#pass").addClass("red-border");
                flag = false;
            }
            if ($repass.length > 1) {
                if ($pass == $repass) {
                    $("#repass").next('span.red').text("");
                    $("#repass").removeClass("red-border");
                    // var flag = true;
                } else {

                    $("#repass").next('span.red').text("Your passwords don't match.");
                    $("#repass").addClass("red-border");
                    flag = false;
                }
            } else {
                $("#repass").next('span.red').text("Re-enter password.");
                $("#repass").addClass("red-border");
                flag = false;
            }
        }
        if (flag) {
            $(".tabs-title1").removeClass("color");
            $(".tabs-title2").addClass("color");
            $(".personal-next").attr("href", '#trading');
            $(".personal-next").click();
        } else {
            $(".tabs-title1").addClass("color");
            $(".personal-next").attr("href", '');
        }
    });
    $(document).on("click", "#trading-next", function () {
        var flag = true;
        var errors = new Array();
        $('#loader-holder').show(0);
        $("#trading .required").each(function () {
            if ('' == jQuery(this).val()) {
                flag = false;
                errors.push(this.name);
            }
        });
        if ($("input[name=risk]:checked").length <= 0) {
            errors.push("risk");
            flag = false;
        }
        if (flag) {
            if (SaveFlag) {
//                FXPP-8300

                var url = "<?= FXPP::ajax_url('') ?>";
                if ($('input[name=affiliateCodeStr]').val() != '') {
                    $('#loader-holder').show();
                    jQuery.ajax({
                        type: 'POST',
                        url: url + 'register/checkAffiliateCode',
                        dataType: 'json',
                        data: {affiliate_code: $('input[name=affiliateCodeStr]').val()},
                        success: function (response) {
                            $('#loader-holder').hide();
                            if (response.error) {
                                bootbox.alert({
                                    title: 'Affiliate Code Error',
                                    message: response.message,
                                    show: true
                                });
                            } else {
                                SaveFlag = saveLiveAccount();
                            }
                        }
                    });
                } else {
                    SaveFlag = saveLiveAccount();
                    $('#trading').removeClass('active');
                    $('#employment').addClass('active');
                    $(".tabs-title2").removeClass("color");
                    $(".tabs-title3").addClass("color");
                    $('#loader-holder').hide();
                }


            } else {
                $('#trading').removeClass('active');
                $('#employment').addClass('active');
                $(".tabs-title2").removeClass("color");
                $(".tabs-title3").addClass("color");
                $('#loader-holder').hide();
            }
        } else {
            for (error in errors) {
                switch (errors[error]) {
                    case 'mt_account_set_id':
                        jQuery("#error_" + errors[error]).html("<p>The Account Type field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'mt_currency_base':
                        jQuery("#error_" + errors[error]).html("<p>The Account Currency Base field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'leverage':
                        jQuery("#error_" + errors[error]).html("<p>The Leverage field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'investment_knowledge':
                        jQuery("#error_" + errors[error]).html("<p>The Investment Knowledge Net Worth field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'trade_duration':
                        jQuery("#error_" + errors[error]).html("<p>This field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'risk':
                        jQuery("#error_" + errors[error]).html("<p>This field is required.</p>");
                        break;
                    case 'politically_exposed_person':
                        jQuery("#error_" + errors[error]).html("<p>This field is required.</p>");
                        break;
                }
            }
        }
//        var flag =true;
//        $("#trading .required").each(function(){
//            if($(this).val().length>0)
//            {
//                $(this).closest('div').next('div').text("");
//                $(this).removeClass("red-border");
//            }else{
//                $(this).closest('div').next('div').text("This is a required field.");
//                $(this).addClass("red-border");
//                flag = false;
//            }
//        });
//
//        if(flag){
//            $(".trading-next").attr("href",'#account');
//            $(".tabs-title2").removeClass("color");
//            $(".tabs-title3").addClass("color");
//        }else{
//            $(".trading-next").attr("href",'');
//        }
    });
    $(document).on("click", "#employment-next", function () {
        var flag = true;
        var errors = new Array();
        $("#employment .required").each(function () {
            if ('' == jQuery(this).val()) {
                flag = false;
                errors.push(this.name);
            }
        });
        if ($('#employment_status').val() != '') {
            if ($('#employment_status').val() == 0) {
                if ($('#industry').val() == '') {
                    errors.push("industry");
                    flag = false;
                }
            } else {
                if ($('#source_of_funds').val() == '') {
                    errors.push("source_of_funds");
                    flag = false;
                }
            }
        }
        if ($("input[name=us_citizen]:checked").length <= 0) {
            errors.push("us_citizen");
            flag = false;
        }
        if ($("input[name=us_resident]:checked").length <= 0) {
            errors.push("us_resident");
            flag = false;
        }
        if (flag) {
            var url = "<?= FXPP::ajax_url('') ?>";

                $('input#affiliate_code').val($('input[name=affiliateCodeStr]').val());
                $('#employment').removeClass('active');
                $('#account').addClass('active');
                $(".tabs-employment").removeClass("color");
                $(".tabs-title3").addClass("color");
    

        } else {
            for (error in errors) {
                switch (errors[error]) {
                    case 'employment_status':
                        jQuery("#error_" + errors[error]).html("<p>The Employment Status field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'industry':
                        jQuery("#error_" + errors[error]).html("<p>This field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'source_of_funds':
                        jQuery("#error_" + errors[error]).html("<p>The Source of Funds Status field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'estimated_annual_income':
                        jQuery("#error_" + errors[error]).html("<p>The Estimated Annual Income field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'estimated_net_worth':
                        jQuery("#error_" + errors[error]).html("<p>The Estimated Net Worth field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'education_level':
                        jQuery("#error_" + errors[error]).html("<p>The Education Level field is required.</p>");
                        jQuery("select#" + errors[error]).addClass('red-border');
                        break;
                    case 'us_citizen':
                        jQuery("#error_" + errors[error]).html("<p>This field is required.</p>");
                        break;
                    case 'us_resident':
                        jQuery("#error_" + errors[error]).html("<p>This field is required.</p>");
                        break;
                }
            }
        }
    });
    $(document).on("click", 'input,select', function () {
        jQuery(this).removeClass("red-border");
        jQuery(this).closest('div').next('div.error_p').html("");
    });
    var base_url = "<?= FXPP::ajax_url() ?>";
    function checkPassword(pass) {
        $.post(base_url + "register/passwordCheck", {pass: pass, status: "live"}, function (data) {
            if (data.trim() == "true") {
                $("#error_password").text("This password has already been used by other account under the same email.");
                $("#pass").val("");
                //alert(flg);
            } else {
                $("#error_password").text("");
            }
        })
    }
    $(document).on("change", "#employment_status", function () {
        if ($(this).val() == "0") {
            $('.source_of_funds').hide();
            $(".industry").show();
            $('#source_of_funds').val("");
            $("#industry").addClass('required');
            $('#source_of_funds').removeClass('required');

        } else {
            $(".industry").hide();
            $("#industry").val("");
            $('.source_of_funds').show();
            $('#source_of_funds').addClass('required');
            $("#industry").removeClass('required');
        }
    });
    function saveLiveAccount() {
//    var street = $("input:text[name=street]").val();
//    var city = $("input:text[name=city]").val();
//    var state = $("input:text[name=state]").val();
//    var zip = $("input:text[name=zip]").val();
//    var country = $("[name=country]").val();
//    var phone = $("input:text[name=phone]").val();
//    var dob = $("input:text[name=dob]").val();
//    var password = $("input:password[name=password]").val();
//    var re_password = $("input:password[name=re_password]").val();
//    var mt_account_set_id = $("[name=mt_account_set_id]").val();
//    var swap_free = $("[name=swap_free]").is(':checked')?1:0;
//    var mt_currency_base = $("[name=mt_currency_base]").val();
//    var leverage = $("[name=leverage]").val();
//    var experience1 = $("#agree-1").is(':checked')?1:0;
//    var experience2 = $("#agree-2").is(':checked')?1:0;
//    var experience3 = $("#agree-3").is(':checked')?1:0;
//    var experience = experience1+','+experience2+','+experience3;
//    var investment_knowledge = $("[name=investment_knowledge]").val();
//    var trade_duration = $("[name=trade_duration]").val();
//    var politically_exposed_person = $("#politically_exposed_person1").is(':checked')?1:0;
//    var risk = $("#risk1").is(':checked')?1:0;
//    var auto_generate  = $("[name=auto_generate]").is(':checked')?1:0;
//    var site_url="<?//=base_url().$this->uri->segment(1, 0).'/' ?>//";
//    $.post(site_url+"index.php?/register/saveLiveAccount",{
////    $.post(base_url+"index.php?/register/saveLiveAccount",{
//            street:street,
//            city:city,
//            state:state,
//            zip:zip,
//            country:country,
//            phone:phone,
//            dob:dob,
//            password:password,
//            re_password:re_password,
//            mt_account_set_id:mt_account_set_id,
//            swap_free:swap_free,
//            mt_currency_base:mt_currency_base,
//            leverage:leverage,
//            experience:experience,
//            investment_knowledge:investment_knowledge,
//            trade_duration:trade_duration,
//            politically_exposed_person:politically_exposed_person,
//            risk:risk,
//            auto_generate:auto_generate
//        },
//        function(data){},'json')
//    return false;
        var street = $("input:text[name=street]").val();
        var city = $("input:text[name=city]").val();
        var state = $("input:text[name=state]").val();
        var zip = $("input:text[name=zip]").val();
        var country = $("[name=country]").val();
        var phone = $("input:text[name=phone]").val();
        var dob = $("input:text[name=dob]").val();
        var skype = $("input:text[name=skype]").val();
        var password = $("input:password[name=password]").val();
        var re_password = $("input:password[name=re_password]").val();

        var mt_account_set_id = $("[name=mt_account_set_id]").val();
        var swap_free = $("[name=swap_free]").is(':checked') ? 1 : 0;
        var mt_currency_base = $("[name=mt_currency_base]").val();
        var leverage = $("[name=leverage]").val();
        var experience1 = $("#agree-1").is(':checked') ? 1 : 0;
        var experience2 = $("#agree-2").is(':checked') ? 1 : 0;
        var experience3 = $("#agree-3").is(':checked') ? 1 : 0;
        var experience = experience1 + ',' + experience2 + ',' + experience3;
        var investment_knowledge = $("[name=investment_knowledge]").val();
        var trade_duration = $("[name=trade_duration]").val();
        var politically_exposed_person = $("#politically_exposed_person1").is(':checked') ? 1 : 0;
        var risk = $("#risk1").is(':checked') ? 1 : 0;
        var auto_generate = $("[name=auto_generate]").is(':checked') ? 1 : 0;
        var affiliate_code = $("[name=affiliateCodeStr]").val();

        var pblc = [];
        var prvt = [];
        prvt["data"] = {
            street: street,
            city: city,
            state: state,
            zip: zip,
            country: country,
            phone: phone,
            dob: dob,
            password: password,
            re_password: re_password,
            mt_account_set_id: mt_account_set_id,
            swap_free: swap_free,
            mt_currency_base: mt_currency_base,
            leverage: leverage,
            experience: experience,
            investment_knowledge: investment_knowledge,
            trade_duration: trade_duration,
            politically_exposed_person: politically_exposed_person,
            risk: risk,
            auto_generate: auto_generate,
            affiliate_code: affiliate_code
        };
        pblc['request'] = null;
//    var site_url="<?//=site_url('')?>//";
        var site_url = "<?= FXPP::ajax_url(); ?>";
        pblc['request'] = $.ajax({
//        dataType: 'json',
//        url: site_url + 'index.php?/registration/saveLiveAccount',
            async: true,
            url: site_url + 'register/saveLiveAccount',
            method: 'POST',
            data: prvt["data"]
        });
        pblc['request'].done(function (result) {
            console.log(result);
//        $('div#employment').show();
            $('#loader-holder').hide();
            if (result.success) {
                $('#trading').removeClass('active');
                $('#employment').addClass('active');
                $(".tabs-title2").removeClass("color");
                $(".tabs-employment").addClass("color");
                SaveFlag = false;
            } else {
                $('.register-alert-message').html(result.error);
                $('#modal-register-alert').modal('show');
                SaveFlag = true;
            }
            if (result.registration_limit) {
                $('.prompt_reg').removeClass('togglealert');
            }
        });
        pblc['request'].fail(function (jqXHR, textStatus) {
            $('.register-alert-message').html('Request: [' + jqXHR.status + '] ' + textStatus);
            $('#modal-register-alert').modal('show');
            $('#loader-holder').hide();
            SaveFlag = true;
        });
    }
</script>

<!-- for micro accounts -->
<script type="text/javascript">
    $(document).ready(function () {

        var speardGroup = <?= strlen($this->input->cookie('forexmart_account_type'))==3 ? $this->input->cookie('forexmart_account_type') : 0 ?>;

        if (speardGroup) {
            if (speardGroup != 301) {

                $("#mt_account_set_id option[value='4']").remove();


                } else {
                    $("#mt_currency_base option:not([value='USD'])").remove();
                }
            }

            var selected = $('#mt_currency_base').val();
            //console.log(selected);
            if (<?php echo "'" . $micro . "'"; ?> == '1') {//micro
                $('#mt_account_set_id').val('4');
                var list = ["USD", "EUR"];
                $('#mt_currency_base option').filter(function () {
                    return $.inArray(this.value, list) == -1
                }).hide()
            }
            $('#mt_account_set_id').on('change', function () {
                var list = ["USD", "EUR"];
                var original = ["EUR", "USD", "GBP", "RUR", "MYR", "IDR", "THB", "CNY"];
                if ($('#mt_account_set_id').val() == 4) {
                    //$('#mt_account_set_id option[value=2]').remove();
                    $('#mt_currency_base option').filter(function () {
                    return $.inArray(this.value, list) == -1
                }).hide()
            } else {
                $('#mt_currency_base').find('option').remove()
                for (var i = 0; i < original.length; i++) {
                    $('#mt_currency_base').append("<option>" + original[i] + "</option>");
                }
                $('#mt_currency_base').val(selected);
            }
        });

    });
</script>
<!-- end of micro accounts -->



<script type="text/javascript">
    $(document).ready(function () {
        $("#xleverage option[value='1:33']").remove();
        $("#xleverage option[value='1:66']").remove();
        $("#xleverage option[value='1:88']").remove();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-flag-reg').click(function () {
            $('.btn-flag-dropdown').toggle();
        });
    });
</script>