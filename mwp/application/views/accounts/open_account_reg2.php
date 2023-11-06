<?php  $this->lang->load('register_lang'); ?>
<div class="tab-pane active" id="check-phone-password"  role="tabpanel">
        <div class="tab-title-header">
            <h1 class="all_tab_title">Employment Details</h1>
        </div>
        <div class="div_reg1">
            <form method="POST" id="register-live2" enctype="multipart/form-data" class="uploadimage">
                <div role="tabpanel" class="tab-pane row col-centered " id="employment">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-holder registration-form-holder">
                            <div class="clearfix"></div>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_27');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select id="employment_status" class="form-control round-0 required" name="employment_status" id="employment_status">
                                            <?php echo $employment_status;?>
                                        </select>
                                        <span class="error_p" id="error_employment_status"><?php echo form_error('employment_status'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group industry">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_28');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select id="industry" class="form-control round-0 emp-stat-cat" name="industry" id="industry">
                                            <?php echo $industry;?>
                                        </select>
                                        <span class="error_p" id="error_industry"><?php echo form_error('industry'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_29');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select class="form-control round-0 required" name="estimated_annual_income" id="estimated_annual_income">
                                            <?php echo $estimated_annual_income;?>
                                        </select>
                                        <span class="error_p" id="error_estimated_annual_income"><?php echo form_error('estimated_annual_income'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_30');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select class="form-control round-0 required" name="estimated_net_worth" id="estimated_net_worth">
                                            <?php echo $estimated_net_worth;?>
                                        </select>
                                        <span class="error_p" id="error_estimated_net_worth"><?php echo form_error('estimated_net_worth'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_31');?><cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <select class="form-control round-0 required" name="education_level" id="education_level">
                                            <?php echo $education_level;?>
                                        </select>
                                        <span class="error_p" id="error_education_level"><?php echo form_error('education_level'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group block-form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_32');?>?<cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <div class="data-input-choice">
                                            <input value="1"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : '' ?> id="us_resident" type="radio" class="rdo-btn-required" name="us_resident" />
                                            <span><?=lang('reli_ye');?></span>
                                        </div>
                                        <div class="data-input-choice">
                                            <input value="0"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : ' checked' ?> id="us_resident" type="radio" class="rdo-btn-required" name="us_resident" />
                                            <span><?=lang('reli_no');?></span>
                                        </div>
                                        <span class="error_p" id="error_us_resident"><?php echo form_error('us_resident'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group block-form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label"><?=lang('reli_33');?>?<cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column">
                                        <div class="data-input-choice">
                                            <input value="1"<?php echo isset($user_details['us_resident']) ? $user_details['us_resident'] ? '' : ' checked' : '' ?> id="us_citizen" type="radio" name="us_citizen" class="rdo-btn-required" />
                                            <span><?=lang('reli_ye');?></span>
                                        </div>
                                        <div class="data-input-choice">
                                            <input value="0"<?php echo isset($user_details['us_citizen']) ? $user_details['us_citizen'] ? '' : ' checked' : ' checked' ?> id="us_citizen" type="radio" name="us_citizen" class="rdo-btn-required" />
                                            <span><?=lang('reli_no');?></span>
                                        </div>
                                        <span class="error_p" id="error_us_citizen"><?php echo form_error('us_citizen'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="offset-buttons-holder">
                                        <div class="anchor-back-button"><a href="#trading" class="employment-back" aria-controls="personal" role="tab" data-toggle="tab" id="back2"><?=lang('reli_ba');?></a></div>
                                        <div class="anchor-submit-button">
                                            <a href="javascript:void(0)"  aria-controls="account" role="tab" data-toggle="tab" class="trading-next">
                                                <button id="employment-next" type="button" class="btn-submit"><?=lang('reli_ne');?></button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
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
        margin-right: 16px;
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
        margin-left: 80%;
    }

    .row {
       margin-right: 0px; 
       margin-left: 0px; 
    }
</style>

<script type="text/javascript">
      $(document).on("click","#employment-next",function(){
        var flag = true;
        var errors = new Array();

        $("#employment .required").each(function(){
            if('' == jQuery(this).val()){
                flag = false;
                errors.push(this.name);
            }
        });

        if($('#employment_status').val() != ''){
            if($('#employment_status').val() == 0){
                if($('#industry').val() == ''){
                    errors.push( "industry" );
                    flag = false;
                }
            }else{
                if($('#source_of_funds').val() == ''){
                    errors.push( "source_of_funds" );
                    flag = false;
                }
            }
        }


        if ($("input[name=us_citizen]:checked").length<=0){
            errors.push( "us_citizen" );
            flag = false;
        }
        if ($("input[name=us_resident]:checked").length<=0){
            errors.push( "us_resident" );
            flag = false;
        }

        if(flag){
//            var url = '<?php //echo base_url();?>//';
            var url="<?= FXPP::ajax_url('') ?>";

            if($('input[name=affiliateCodeStr]').val() != ''){
                $('#loader-holder').show();
                jQuery.ajax({
                    type: 'POST',
                    url: url+'open-account/checkAffiliateCode',
                    dataType: 'json',
                    data: {affiliate_code:$('input[name=affiliateCodeStr]').val()},
                    success: function(response){
                        $('#loader-holder').hide();
                        if(response.error){
                            bootbox.alert({
                                title: 'Affiliate Code Error',
                                message: response.message,
                                show: true
                            });
                        }else{
//                            console.log('test2');
//                            $(".trading-next").attr("href",'#account');
                            $('input#affiliate_code').val($('input[name=affiliateCodeStr]').val());

                            $('#employment').removeClass('active');
                            $('#account').addClass('active');

                            $(".tabs-employment").removeClass("color");
                            $(".tabs-title3").addClass("color");
                        }
                    }
                });
            }else{
//                console.log('test1');
//                $(".trading-next").attr("href",'#account');
                $(".tabs-employment").removeClass("color");
                $(".tabs-title3").addClass("color");
                $('#employment').removeClass('active');
                $('#account').addClass('active');

            }


        }else{
            for(error in errors){
                switch (errors[error]){

                    case 'employment_status':
                        jQuery("#error_"+errors[error]).html( "<p>The Employment Status field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'industry':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'source_of_funds':
                        jQuery("#error_"+errors[error]).html( "<p>The Source of Funds Status field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'estimated_annual_income':
                        jQuery("#error_"+errors[error]).html( "<p>The Estimated Annual Income field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'estimated_net_worth':
                        jQuery("#error_"+errors[error]).html( "<p>The Estimated Net Worth field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'education_level':
                        jQuery("#error_"+errors[error]).html( "<p>The Education Level field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;

                    case 'us_citizen':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        break;
                    case 'us_resident':
                        jQuery("#error_"+errors[error]).html( "<p>This field is required.</p>" );
                        break;

                }
            }
        }
    });


</script>