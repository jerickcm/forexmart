<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 custom-r pull-r setw ext-arabic-demo-accounts">
                <h1  class="oada license-title ext-arabic-license-title sa-right">
                    <?= lang('da_h1-0');?>
                </h1>
                <p class="p_l license-text ext-arabic-license-text">
                    <?= lang('da_p0-0');?>
                </p>
                <ul class="demo-feats">
                    <li >
                        <i class="fa fa-check"></i>
                        <?= lang('da_li0-0');?>
                    </li>
                    <li><i class="fa fa-check"></i>
                        <?= lang('da_li0-1');?>
                    </li>
                    <li><i class="fa fa-check"></i>
                        <?= lang('da_li0-2');?>
                    </li>
                    <li><i class="fa fa-check"></i>
                        <?= lang('da_li0-3');?>
                    </li>
                    <li><i class="fa fa-check"></i>
                        <?= lang('da_li0-4');?>
                    </li>
                </ul>
                <p class="license-text ext-arabic-license-text">
                    <?= lang('da_p0-1');?>
                </p>
            </div>
            <div class="col-lg-6 col-md-6 custom-r pull-r setw ext-arabic-demo-accounts">
                <div class="form-holder ext-arabic-form-holder">
                    <h1  class="oada sa-right "><?= lang('da_h1-1');?></h1>
                    <form  method="post" class="form-horizontal formcustom" id="demo">
                        <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 col-md-5 control-label pull-l ext-arabic-control-label sa-flt-r sa-spe-width" id="lbl-email">
                                    <?= lang('da_lbl0-1');?>
                                    <cite class="req">*</cite></label>
                                <div class="col-sm-7 ext-arabic-control-input sa-flt-r" id="div-email">
                                    <input name="email" type="text" class="form-control round-0 <?php echo form_error('email')?"red-border":""?> ext-arabic-form-control-placeholder" id="inputEmail3" placeholder="<?= lang('da_lbl0-1');?>" value="<?=set_value('email');?>">

                  <span  class="red pull-right ">  <?php echo  form_error('email')?> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-md-5 control-label pull-l ext-arabic-control-label sa-flt-r sa-spe-width" id="lbl-fn">
                                    <?= lang('da_lbl0-2');?>
                                    <cite class="req">*</cite></label>
                                <div class="col-sm-7 ext-arabic-control-input ext-arabic-form-control-placeholder sa-flt-r" id="div-fn">
                                    <input name="full_name" type="text" class="form-control round-0 <?php echo form_error('full_name')?"red-border":""?> ext-arabic-form-control-placeholder" id="full" placeholder="<?= lang('da_lbl0-2');?>" value="<?=set_value('full_name');?>">
                                    <span class="red pull-right"> <?php echo  form_error('full_name')?> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="bsubmit col-sm-offset-2 col-sm-7 col-md-10 sa-flt-r" id="btn_submit">


                                        <button type="submit" class="btn-submit  ext-arabic-btn-submit sa-flt-r submit">
                                            <?= lang('da_lbl0-3');?>
                                        </button>


                                </div><div class="clearfix"></div>
                            </div>

                    </form>
                        <div class="form-group custome-text-center">
                            
                        <?php if(IPLoc::Office()){?>
                        <!-- <center> -->
                            <!-- <label style="text-align:center!important; min-width:136px!important;"> -->
                            <label class="llink forlabel control-label form-text ext-arabic-form-text">
                            <?= lang('da_lbl0-4');?>
                            </label>
                        <!-- </center>  -->
                        <?php }else{?>
                        <label class="llink control-label form-text ext-arabic-form-text ">
                            <?= lang('da_lbl0-4');?>
                        </label>
                          <?php }?>
                        <div class="clearfix cstm_for_link_margin"></div>



                        <a class="btn-signin ext-arabic-btn-signin llink" href="<?= FXPP::my_url('client/signin');?>" >

                                <?= lang('da_a0-1');?>

                        </a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-demo-reg.css' type='text/css'  />"));
    });
</script>

<script type="text/javascript">var language="<?=FXPP::html_url()?>";str=language.replace(/\s/g,"");if(str==="bg"){$("#lbl-email").removeClass("col-sm-2");$("#lbl-email").addClass("col-sm-3");$("#div-email").removeClass("col-sm-7");$("#div-email").addClass("col-sm-6");$("#lbl-fn").removeClass("col-sm-2");$("#lbl-fn").addClass("col-sm-3");$("#div-fn").removeClass("col-sm-7");$("#div-fn").addClass("col-sm-6")} if(str==="sa"){$("#lbl-email").removeClass("col-sm-2");$("#lbl-email").addClass("col-sm-3");$("#div-email").removeClass("col-sm-7");$("#div-email").addClass("col-sm-6");$("#lbl-fn").removeClass("col-sm-2");$("#lbl-fn").addClass("col-sm-3");$("#div-fn").removeClass("col-sm-7");$("#div-fn").addClass("col-sm-6")}$(document).ready(function(){$(window).load(function(){var width=$(window).width();if(width<=1001){$("#btn_submit").removeClass("col-md-10");$("#btn_submit").addClass("col-sm-10")}else{$("#btn_submit").addClass("col-md-10");$("#btn_submit").removeClass("col-sm-10")}});$(window).resize(function(){var width=$(window).width();if(width<=1001){$("#btn_submit").removeClass("col-md-10");$("#btn_submit").addClass("col-sm-10")}else{$("#btn_submit").addClass("col-md-10");$("#btn_submit").removeClass("col-sm-10")}})});</script>

<?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>
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


        $('#demo').validate({ // initialize the plugin
            rules: {
                email: {
                    regex: cyrillic
                },
                full_name:{
                    regex: cyrillic
                }
            },
            messages: {
                email:{
                    regex:"The characters you have entered in the Email field are not yet supported."
                },
                full_name:{
                    regex:"The characters you have entered in the Full Name field are not yet supported."
                }
            },
            submitHandler: function (form) {
                return true;
            }
        });

    });
</script>


