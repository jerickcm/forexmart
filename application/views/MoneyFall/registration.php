<!-- test vic-->
<div class="reg-form-holder">
    <?php echo $contest_header ?>
    <div class="container" id="container_registration">

    </div>
    <div class="container">
        <div id="div3" style="border-top: 1px solid red;">
            <h3 class="text-center"><?= lang('cmf_reg')?></h3>
            <hr>
            <!-- start of form -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="tab0">
                        <div class="row">
                            <?php if($insertsuccess==true):?>

                                <div id="registersuccess" class="col-md-4 col-centered margin" >
                                    <h3 class="ty">
                                        <?= lang('mfr_0_0')?>
                                    </h3>
                                    <p class="suc-msg">
                                        <?= lang('mfr_0_1')?>
                                    </p>
                                    <br/>
                                    <a href="<?= FXPP::loc_url('money-fall'); ?>" class="btn-contest-reg" >
                                        <?= lang('mfr_0_2')?>
                                    </a>
                                </div>

                            <?php else: ?>

                                <div id="registerform" class="col-md-8 col-centered newmargin">

                                <?php if(isset($Operations)):?>
                                    <?php if(!$Operations):?>
                                        <div class="alert alert-info">
                                            <strong>
                                                <?= lang('mfr_0_3')?>
                                            </strong>
                                            <?= lang('mfr_0_4')?>
                                        </div>

                                    <?php else: ?>

                                            <?php if(isset($PermitIP)):?>

                                                <?php if($PermitIP):?>


                                                    <?= form_open(FXPP::www_url('contest/registration'),array('id' => 'RegisterForm','class'=> 'form-horizontal reg-frm'),''); ?>

                                                
                                                    <div class="form-group">
                                                        <div class="validation-result" id="validation-result">
                                                            <?php
                                                            if(validation_errors()){
                                                                echo '<div class="bg-danger">';
                                                                echo validation_errors();
                                                                echo '</div>';
                                                            }
                                                            if(!empty($custom_validation_success)){
                                                                echo '<div class="bg-success">';
                                                                echo $custom_validation_success;
                                                                echo '</div>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label( lang('mfr_inc_0'), 'FullName', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php if(IPLoc::Office()){ ?>
                                                                <?php $data = array(
                                                                    'name' => 'FullName',
                                                                    'id' => 'FullName',
                                                                    'type' => 'text',
                                                                    'maxlength' => '100',
                                                                    'class' => 'form-control round-0',
                                                                    'placeholder' => '',
                                                                    'value' => set_value('FullName', '')
                                                                ); ?>
                                                            <?php }else{ ?>
                                                                <?php $data = array(
                                                                    'name' => 'FullName',
                                                                    'id' => 'FullName',
                                                                    'type' => 'text',
                                                                    'maxlength' => '100',
                                                                    'class' => 'form-control round-0',
                                                                    'placeholder' => '',
                                                                    'value' => set_value('FullName', '')
                                                                ); ?>
                                                            <?php } ?>
                                                            <?php $data = array(
                                                                'name' => 'FullName',
                                                                'id' => 'FullName',
                                                                'type' => 'text',
                                                                'maxlength' => '100',
                                                                'class' => 'form-control round-0',
                                                                'placeholder' => '',

                                                                'value' => set_value('FullName', '')
                                                            ); ?>


                                                            <?= form_input($data); ?>
                                                        </div>

                                                        <div class="reqs col-sm-4 FullName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_1'), 'Email', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'Email',
                                                                'id' => 'Email',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0 latin_email',
                                                                'placeholder' => '',
                                                                'value' => set_value('Email', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_2'), 'NickName', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'NickName',
                                                                'id' => 'NickName',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0 latin',
                                                                'placeholder' => '',
                                                                'value' => set_value('NickName', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 NickName">
                                                            <?php if (!empty($custom_validation)){ echo $custom_validation; } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_3'), 'countrylist', $attributes); ?>

                                                        <div class="col-sm-5">
                                                            <select class="form-control round-0" id="countrylist" name="Country" aria-required="true" aria-invalid="false">
                                                                <?php echo $countries; ?>
                                                            </select>
                                                        </div>

                                                        <div class="reqs col-sm-4 Country">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_4'), 'City', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'City',
                                                                'id' => 'City',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0 latin',
                                                                'placeholder' => '',
                                                                'value' => set_value('City', '')
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 City">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_5'), 'PhoneNumber', $attributes); ?>

                                                        <div class="col-sm-5">
                                                            <?php $data = array(
                                                                'name' => 'PhoneNumber',
                                                                'id' => 'PhoneNumber',
                                                                'type' => 'text',
                                                                'class' => 'form-control round-0 latin_phone',
                                                                'placeholder' => '',
                                                                'value' => set_value('PhoneNumber',$calling_code)
                                                            ); ?>
                                                            <?= form_input($data); ?>
                                                        </div>
                                                        <div class="reqs col-sm-4 PhoneNumber">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label(lang('mfr_inc_6'), 'swapfree', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <?php $datac = array(
                                                                        'name'          => 'swapfree',
                                                                        'id'            => 'swapfree',
                                                                        'value'         => set_value('swapfree', 1 ,TRUE),

                                                                    ); ?>

                                                                    <?= form_checkbox($datac);?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label('', '', $attributes); ?>

                                                        <div class="col-sm-5">
                                                            <!--                                    <div class="g-recaptcha" data-sitekey="6LfWygoTAAAAAJCnjP8XzuoYFhXp7QD22QFrMgZb"></div>-->
                                                            <div class="g-recaptcha" data-sitekey="6LeJqQsTAAAAAKiXcxToS7gtj_omu_3IZHca_cwS"></div>
                                                        </div>
                                                        <div class="reqs col-sm-4 recaptcha">
                                                            <?php if (!empty($custom_validation1)){ echo $custom_validation1; } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $attributes = array('class' => 'col-sm-3 control-label contest-label'); ?>
                                                        <?= form_label('', 'cra', $attributes); ?>
                                                        <div class="col-sm-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <?php $datac = array(
                                                                        'name'          => 'cra',
                                                                        'id'            => 'cra',
                                                                        'value'         => set_value('cra', ''),
                                                                    ); ?>
                                                                    <?= form_checkbox($datac);?>
                                                                    <?= lang('mfr_0_5')?>
                                                                    <a href="<?=FXPP::loc_url('contest/contest-rules')?>"  target="_blank" class="agreement">
                                                                        <?= lang('mfr_0_6')?>
                                                                    </a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="reqs col-sm-4 cra">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label contest-label"></label>
                                                        <div class="col-sm-5">
                                                            <?php
                                                            $data = array(
                                                                'name'          => 'button',
                                                                'id'            => 'btnSubmit',
                                                                'value'         => 'true',
                                                                'type'          => 'Submit',
                                                                'content'       => lang('mfr_inc_9'),
                                                                'class'=>'btn-contest-sub',
                                                                'onclick'=>'goog_report_conversion();'
                                                            );
                                                            ?>
                                                            <?= form_button($data); ?>
                                                        </div>
                                                    </div>
                                                    <?= form_close()?>

                                                <?php else: ?>
                                                    <div class="alert alert-info">
                                                        <strong>
                                                            <?= lang('mfr_0_5')?>
                                                        </strong>
                                                        <?= lang('mfr_0_6')?>
                                                    </div>
                                                <?php endif ?>

                                            <?php else: ?>
                                                <div class="alert alert-info">
                                                    <strong>
                                                        <?= lang('mfr_0_5')?>
                                                    </strong>
                                                    <?= lang('mfr_0_6')?>
                                                </div>
                                            <?php endif?>

                                    <?php endif?>

                                <?php else: ?>

                                <?php endif ?>

                                </div>

                            <?php endif?>
                        </div>
                    </div>
                </div>
            <!-- end of form  -->
        </div>
    </div>
    <div class="container">
        <?php echo $registration_link ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        <?php if( $isAutoScroll === true ){ ?>
        $('html, body').animate({
            scrollTop: $('#container_registration').offset().top - 200
        }, 500);
        <?php } ?>
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-contest-registration.css' type='text/css'  />"));
    });
</script>

<script type='text/javascript'>

            
    var pblc = [];
    var site_url="<?=FXPP::loc_url('').''?>";
    $().ready(function() {
        $('#FullName, #Email').blur(function(){
            var email = jQuery('#Email').val();
            var full_name = jQuery('#FullName').val();
            if( $.trim(email) != '' && jQuery.trim(full_name) != '' ){
                $.ajax({
                    type: "POST",
                    url: site_url+'contest/getNickName',
                    data: {
                        email: $('#Email').val(),
                        full_name: $('#FullName').val()
                    },
                    dataType: 'json',
                    success: function(response){
                        if($.trim(response.nickname) != ''){
                            $('#NickName').val(response.nickname)
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
        pblc['RegisterForm'] = $('#RegisterForm').validate({
            errorPlacement: function(error, element) {
                if (element.attr("name") == "FullName" )
                    error.insertAfter(".FullName");
                else if  (element.attr("name") == "Email" )
                    error.insertAfter(".Email");
                else if  (element.attr("name") == "NickName" )
                    error.insertAfter(".NickName");
                else if  (element.attr("name") == "Country" )
                    error.insertAfter(".Country");
                else if  (element.attr("name") == "City" )
                    error.insertAfter(".City");
                else if  (element.attr("name") == "PhoneNumber" )
                    error.insertAfter(".PhoneNumber");
                else if  (element.attr("name") == "cra" )
                    alert('Please check the box to confirm your agreement');
            },rules:{
                FullName:{required : true},
                Email:{required : true,email: true},
                NickName:{required : true},
                Country:{required : true},
                City:{required : true},
                PhoneNumber:{required : true},
                cra:{required : true}

            },
            messages: {

            }, submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
