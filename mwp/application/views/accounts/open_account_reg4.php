<?php  $this->lang->load('register_lang'); ?>
<div class="tab-pane active" id="check-phone-password"  role="tabpanel">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Employment Details</h1>
    </div>
    <div class="div_reg1">
        <form method="POST" id="register-live" enctype="multipart/form-data" class="uploadimage">
                        <div class="clearfix"></div>
                        <div class="form-horizontal form-max-holder">
                            <div class="form-group no-margin-column">
                                <label class="col-sm-6 no-data-label">&nbsp;</label>
                                <div class="col-sm-6 no-padding-column">
                                    <p class="optional"><i class="fa fa-info-circle"></i> (<?=lang('reli_35');?>.)</p>
                                </div>
                            </div>

                            <div class="form-group block-form-group">
                                <label class="col-sm-6 right-align-label no-padding-column-label"><?=lang('reli_36');?> <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign" title="<?=lang('accept_files');?>"></i></label>
                                <div class="col-sm-6 paragraph-data form-file-input no-padding-column">
                                    <div id="s-front-id" class="docs-id" style="display:none"></div>

                                    <?php if(IPLoc::Office()){?>
                                         <div class="div-choosefile">
                                             <input type="file" name="filename[0]" class="flt-l chbt" id="s-f0" />
                                         </div>
                                    <?php }else{?>
                                        <input type="file" name="filename[0]" class="flt-l" id="s-f0"/>
                                    <?php }?>

                                    <a class="btn-up-file flt-l" name="s-front-id"  onclick="return false;">
                                        <i class="fa fa-upload"></i>
                                        <?=lang('upload_button');?>
                                    </a>
                                    <p style="float: left"><?=lang('reli_37');?></p>
                                </div>
                            </div>
                            <div class="form-group block-form-group">
                                <label class="col-sm-6 right-align-label no-padding-column-label"><?=lang('reli_38');?> <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign" title="<?=lang('accept_files');?>"></i></label>
                                <div class="col-sm-6 paragraph-data form-file-input no-padding-column">
                                    <div id="s-back-id" class="docs-id" style="display:none"></div>
                                    <?php if(IPLoc::Office()){?>
                                        <div class="div-choosefile"><input type="file" name="filename[1]" class="flt-l chbt" id="s-f1"/></div>
                                    <?php }else{?>
                                        <input type="file" name="filename[1]" class="flt-l" id="s-f1"/>
                                    <?php }?>

                                    <a class="btn-up-file flt-l" name="s-back-id"  onclick="return false;">
                                        <i class="fa fa-upload"></i>
                                        <?=lang('upload_button');?>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group form-no-data-group block-form-group">
                                <label class="col-sm-6 right-align-label no-padding-column-label"><?=lang('reli_39');?> <i style="color: blue;" class="tooltip-upload-docs glyphicon glyphicon-question-sign" title="<?=lang('accept_files');?>"></i></label>
                                <div class="col-sm-6 paragraph-data form-file-input no-padding-column">
                                    <div id="s-proof-residence" class="docs-id" style="display:none"></div>
                                    <?php if(IPLoc::Office()){?>
                                        <div class="div-choosefile"><input type="file" name="filename[2]" class="flt-l chbt" id="s-f2"></div>
                                    <?php }else{?>
                                        <input type="file" name="filename[2]" class="flt-l" id="s-f2">
                                    <?php }?>
                                    <div  >
                                    <a class="btn-up-file flt-l" name="s-proof-residence"  onclick="return false;">
                                        <i class="fa fa-upload"></i>
                                        <?=lang('upload_button');?>
                                    </a>
                                    <p style="float: left"><?=lang('reli_40');?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-no-label-group form-no-data-group form-title-max no-margin-pad-label">
                                <label class="col-sm-6 no-data-label">&nbsp;</label>
                                <div class="col-sm-6 title-form-group no-padding-column">
                                    <p><?=lang('reli_41');?></p>
                                </div>
                            </div>
                            <div class="form-group form-no-label-group form-no-data-group no-margin-column">
                                <label class="col-sm-6 no-data-label">&nbsp;</label>
                                <div class="col-sm-6 paragraph-data no-padding-column" style="display: inline-flex">
                                    <div class="checkbox-data" style="width: auto !important;">
                                        <input  type="checkbox" value="1" checked name="technical_analysis" />
                                    </div>
                                    <p>&nbsp; <?=lang('reli_42');?></p>
                                </div>
                            </div>

                            <div class="form-group form-no-label-group form-no-data-group form-title-max no-margin-pad-label">
                                <label class="col-sm-6 no-data-label">&nbsp;</label>
                                <div class="col-sm-6 title-form-group no-padding-column">
                                    <p><?=lang('reli_43');?></p>
                                </div>
                            </div>

                            <div class="form-group form-no-label-group no-margin-column" style="display: inline-flex">
                                <label class="col-sm-6 no-data-label" id="declare">&nbsp;</label>
                                <div class="col-sm-6 paragraph-data no-padding-column" id="declare_p">
                                    <div class="checkbox-data">
                                        <input id="agree-checkbox" type="checkbox" />
                                    </div>
                                    <p>&nbsp; <?=lang('reli_44');?>
                                        <a href="<?= $this->config->item('domain-www');?>/Terms-and-conditions" class="company"><?=lang('reli_45');?></a>
                                        <?=lang('reli_50')?>
                                        <a href="<?= $this->config->item('domain-www');?>/privacy-policy" class="company"><?=lang('reli_46');?></a>
                                        , <?=lang('reli_47');?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="offset-buttons-holder">
                                    <div class="anchor-back-button"><a href="#employment" aria-controls="trading" role="tab" data-toggle="tab" class='back-employment' id="back"><?=lang('reli_ba');?></a></div>
                                    <div class="anchor-submit-button">
                                        <?php if(!IPLoc::isChinaIP()){ ?>
                                            <button id="complete_btn" type="button" class="btn-submit" onclick="goog_report_conversion(); ga('send', 'event', 'button', 'click', 'complete'); return true;"><?=lang('reli_48');?></button>
                                        <?php }else{ ?>
                                            <button id="complete_btn" type="button" class="btn-submit"><?=lang('reli_48');?></button>
                                        <?php } ?>
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

<style type="text/css">
    .live-trading-note .note-top {
        float: right;
        margin-bottom: 0!important;
    }

    p {
    margin: 0 0 10px;
    }

    .live-trading-note {
        color: #adadad;
        font-size: 11px;
    }

    .req {
    color: red;
    }

    .note-group label {
       padding-top: 22px!important;
    }

    .btn-submit, .bonus-child-container button {
        color: #fff;
        background: #29a643;
        border: none;
        float: right;
        padding: 7px 30px;
    }

    .anchor-back-button a {
        line-height: 34px;
        color: #29a643;
    }

    .anchor-back-button {
        float: left;    
        margin-right: 10px;
        display: inline-block;
    }

    .offset-buttons-holder {
        float: left !important;
        margin-left: 50%;
    }

    .optional {
        color: #29a643; 
    }

    .btn-up-file {
        background: rgb(41, 166, 67) none repeat scroll 0% 0%;
        border-radius: 0px;
        transition: all 0.3s ease 0s;
        border: medium none;
        padding: 7px 10px;
        color: rgb(255, 255, 255);
        margin-top: 10px;
        margin-right: 15px;
        cursor: pointer;
    }

    .flt-l {
        float: left!important;
    }

    .right-align-label {
        text-align: right!important;
        margin-bottom: 0!important;
    }

    .title-form-group p {
        font-size: 18px;
        font-family: Georgia,'Times New Roman',serif;
        margin: 7px 0;
        text-align: left;
        color: #333;
    }

    .company {
        font-weight: 700;
        color: #2988ca;
    }

    .col-sm-6 {
        width: 30%;
    }

    .div-choosefile {
        display: inline-block;
        width: 100%;
    }

    .paragraph-data p {
    text-align: justify;
    }

    .checkbox-data input[type=checkbox]{
        float: left;
    }

    .no-padding-column {
        padding: 0!important;
    }

    .form-horizontal .form-group {
       margin-right: 0px!important; 
       margin-left: 0px!important; 
    }

    .form-max-holder .no-margin-column {
        margin: 0!important;
    }

    #declare{
        width: 44.5%;
    }

    #declare_p{
        margin-top: -25px;
    }
    .row {
       margin-right: 0px; 
       margin-left: 0px; 
    }

    .anchor-submit-button{
        float: right;
    }
</style>