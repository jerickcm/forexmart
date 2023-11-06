<?php $ck=$this->session->userdata('clk'); ?>
<div class="reg-form-holder">
        <div class="container">
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-centered">
                    <h1 class="license-title h1head ext-arabic-license-title sa-right">
                        <?= lang('x_cb_0');?>
                    </h1>
                </div>
                <div class="row col-centered "> 
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 col-centered custome-cls">
                        <form action="<?php echo FXPP::loc_url('call-back')?>" method="post" id="captcha-form" name="captcha-form" autocomplete="off" class="form-horizontal form-max-holder">

                        <div class="form-holder registration-form-holder">
                            <div class="clearfix"></div>
                                <!-- validation-->
                                <div class="form-group" style="display: none;">
                                    <div class="col-sm-8 no-padding-column">
                                        <label class="col-sm-4 control-label no-padding-column-label " style="color: green;width: 100%;" id="mgsShow">
                                            <?=$this->session->flashdata('msg');?>
                                            <?php  $this->session->set_flashdata('msg', '');?>
                                        </label>
                                    </div>
                                </div>
                                <!-- validation-->
                                 <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_1');?>
                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">

                                        <input type="text" class="form-control round-0 ext-arabic-form-control-placeholder call-validation" data-msg="full name" name="name"
                                               placeholder="<?= lang('x_cb_1');?>"
                                               value="<?=($fullname) ? $fullname : set_value('name');?>">
                                        <!--<span class="red"><p>The Full Name field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_2');?>

                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">

                                        <input type="email" class="form-control round-0 ext-arabic-form-control-placeholder call-validation" data-msg="valid e-mail address" name="email"
                                               placeholder="<?= lang('x_cb_2');?>"
                                               value="<?=($email) ? $email : set_value('email');?>">
                                        <!--<span class="red"><p>The Email field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_3');?>
                                    </label>
                                    <div class="col-sm-8 no-padding-column">
                                        <input type="text" id="account_number" class="form-control round-0 ext-arabic-form-control-placeholder"  name="account_number" placeholder="<?= lang('x_cb_3');?>"  value="<?=($account_number) ? $account_number : set_value('account_number');?>">
                                        <!--<span class="red"><p>The Account Number field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_4');?>
                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                        <select class="form-control round-0 ext-arabic-form-control-select-text" name="country" id="country" >
                                            <?php echo $countries;?> 
                                        </select>
                                        <!--<span class="red"><p>The Country field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_5');?>
                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                         
                                        <input type="text" class="form-control round-0 ext-arabic-form-control-placeholder" id="phone"
                                               placeholder="<?= lang('x_cb_5');?>"
                                               value="<?=($ck!=1)?set_value('phone'):$calling_code;?>" name="phone">
                                        <!--<span class="red"><p>The Phone field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_6');?>
                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                        <select class="form-control round-0 ext-arabic-form-control-select-text" name="time">
                                            <option value="7:00 - 9:00 GMT" <?=($ck!=1)?(set_value('time')=="7:00 - 9:00 GMT")?'selected':'':'selected';?>>7:00 - 9:00 GMT</option>
                                            <option value="9:00 - 11:00 GMT" <?=($ck!=1)?(set_value('time')=="9:00 - 11:00 GMT")?'selected':'':'';?>>9:00 - 11:00 GMT</option>
                                            <option value="11:00 - 14:00 GMT" <?=($ck!=1)?(set_value('time')=="11:00 - 14:00 GMT")?'selected':'':'';?>>11:00 - 14:00 GMT</option>
                                            <option value="14:00 - 16:00 GMT" <?=($ck!=1)?(set_value('time')=="14:00 - 16:00 GMT")?'selected':'':'';?>>14:00 - 16:00 GMT</option>
                                         
                                        </select>
                                        <!--<span class="red"><p>The Preferred Time field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_7');?>
                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                        <select class="form-control round-0 ext-arabic-form-control-select-text" name="language" id="language">
                                            <option value="English" <?=($ck!=1)?(set_value('language')=="English")?'selected':'':'';?>>English</option>
                                            <option value="Czech"  <?=($ck!=1)?(set_value('language')=="Czech")?'selected':'':'';?>>Czech</option>
                                            <option value="Polish"  <?=($ck!=1)?(set_value('language')=="Polish")?'selected':'':'';?>>Polish</option>
                                            <option value="Russian"  <?=($ck!=1)?(set_value('language')=="Russian")?'selected':'':'';?>>Russian</option>
                                        </select>
                                        <!--<span class="red"><p>The Preferred Language field is required.</p> </span>-->
                                    </div>
                                </div>
                            
                             
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_8');?>

                                        <cite class="req">*</cite></label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                        <select class="form-control round-0 ext-arabic-form-control-select-text" name="subject">
                                            <option value="General Questions" <?=($ck!=1)?(set_value('subject')=="General Questions")?'selected':'':'';?>>
                                                <?= lang('x_cb_9');?>
                                            </option>
                                            <option value="Trading Account" <?=($ck!=1)?(set_value('subject')=="Trading Account")?'selected':'':'';?>>
                                                <?= lang('x_cb_10');?>
                                            </option>
                                            <option value="Personal Area" <?=($ck!=1)?(set_value('subject')=="Personal Area")?'selected':'':'';?>>
                                                <?= lang('x_cb_11');?>
                                            </option>
                                            <option value="Deposit Withdrawal" <?=($ck!=1)?(set_value('subject')=="Deposit Withdrawal")?'selected':'':'';?>>
                                                <?= lang('x_cb_12');?>
                                            </option>
                                        </select>
                                        <!--<span class="red"><p>The Subject field is required.</p> </span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? 'col-lg-4 col-md-4 col-xs-12' :''; ?>">
                                        <?= lang('x_cb_13');?>
                                    </label>  <?=($ck!=1)?set_value('comments'):'';?>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                        <input type="text" class="form-control round-0 ext-arabic-form-control-placeholder" placeholder="<?= lang('x_cb_13');?>" name="comments" value="<?=($ck!=1)?set_value('comments'):'';?>">
                                        <!--<span class="red"><p>The Phone field is required.</p> </span>-->
                                    </div>
                                </div>
 

                              <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-column-label ext-arabic-callback-content ext-arabic-callback-label <?= (FXPP::html_url()=='sa')? "col-lg-4 col-md-4 col-xs-12" :""; ?>">
                                        <?= lang('x_cb_14');?>
                                    </label>
                                    <div class="col-sm-8 no-padding-column <?= (FXPP::html_url()=='sa')? 'col-lg-8 col-md-8 col-sm-12' :''; ?>">
                                        <div class="form-group ">
                                            <div class=" mar-top">
                                                <div id="recaptcha_image" style="float: left"></div>

                                                 <a href="javascript:Recaptcha.reload()" style="float: left; line-height: 54px; margin-left: 28px;" id="captcha">
                                                    <img src="<?=$this->template->Images()?>view_refresh.png" alt="refresh captcha" class="img-responsive captcha-container ext-arabic-captcha-container" id="refresh-captcha" style="cursor: pointer;" />
                                                 </a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="col-sm-8 no-padding-column " id="errorGet" style="margin-top:20px">

                                                  <input type="text" id="recaptcha_response_field" class="ext-arabic-form-control-placeholder" style="float: left" placeholder="<?=lang('x_cb_15');?>" name="recaptcha_response_field"/>

                                                  <p style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></p> <br>

                                                   <?php echo  $recaptcha_html; ?>
                                                </div>
                                            </div>
                                         </div>
                                     </div>

                                    
                                </div> 
 
                                
                                <div class="form-group">
                                    <div class="offset-buttons-holder ext-arabic-offset-buttons-holder" >
                                        <div class="offset-submit-button"><input type="submit" value="<?= lang('x_cb_17');?>" class="btn-submit"/></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


<link href="<?= $this->template->Css() ?>custome-ex-call-back.css" rel="stylesheet">

 <script type="application/javascript">
 $(document).ready(function(){

 setTimeout(function(){
 $("#mgsShow").html("");
}, 10000);

 var ck="<?php echo $ck; ?>";
 var pld="<?php echo $pld;?>";
 var datap="<?php echo set_value('phone'); ?>";
 var n = datap.length;

 if(n<5 || ck==1)
 {

   var c_code= $("#country").val();
//    var url="<?php //echo base_url()?>//";
     var url="<?=FXPP::ajax_url(); ?>";
      $.post(url+'pages/callingCode',{c_code:c_code},function(view){
        $("#phone").val(view);
    });
 }
 });

 $(document).on("change","#country",function(){
     var c_code=$(this).val();
     var url="<?=FXPP::ajax_url()?>";
    $.post(url+'pages/callingCode',{c_code:c_code},function(view){
        $("#phone").val(view);
    });// save rowfreeze

 });

 $("#account_number").keydown(function (e) {
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

 $("#phone").keydown(function (e) {
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

<script type="text/javascript">
    // call back form validation
    $(document).ready(function(){

        $(".btn-submit").click(function(e){
            e.preventDefault();
            var submit_form = false;
            $(".custome-span").remove();
            $('.call-validation').each(function(){
                var message = $(this).data("msg");
//                var message = $(this).attr("msg");
                var values =  $(this).val();
                //console.log(values+", ");
                if(values.length <1){

                    submit_form=false;
                    $(this).closest('div').append('<span class="red custome-span"> Please enter '+message+'</span>');
                    return false;
                } else{
                    if($(this).attr("name")=='email'){
                        if(validateEmail($(this).val())==true){
                            submit_form=true;
                        } else{
                            submit_form=false;
                            $(this).closest('div').append('<span class="red custome-span"> Please enter '+message+'</span>');
                        }
                    }
                }

            });
            if(submit_form ==true){
                $("#captcha-form").submit();
            }
        });
    });



    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }

</script>

<?php $this->session->unset_userdata('clk');?>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style type="text/css">@media screen and (max-width:320px){#recaptcha_response_field{margin-left:13%!important}#recaptcha_challenge_image{margin-left:20px}.captcha-container{margin-left:50px}.form-max-holder{margin:0!important}.offset-buttons-holder{margin-top:0!important}} iframe.cstmborder{background-color: transparent;border: 0px none transparent;padding: 0px;overflow: hidden;}</style>');
    });


</script>