<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-register-demo1.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder" xmlns="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div>
            <h1 class="info-text">
                <?=lang('x_reg_2');?>

            </h1>
            <div class="col-lg-5 col-md-5 col-centered">
                <div class="form-holder">
                    <form method="post" class="form-horizontal task2163" id="register">
                       <?php /*if(form_error('email') || form_error('full_name')){*/?><!--
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php /*echo  form_error('email')*/?>
                            <?php /*echo  form_error('full_name')*/?>
                        </div>
                        --><?php /*}*/?>

                        <div class="form-group note-group">
                            <label id="lbl_email" for="inputEmail3" class="col-sm-3 control-label"><?=lang('x_reg_3');?><cite class="req">*</cite></label>
                            <div id="div_email" class="col-sm-9 live-trading-note">
                                <p class="note-top">(<?=lang('x_reg_8');?>)</p>
                                <input name="email" type="text" maxlength="128" class="form-control round-0 <?php echo form_error('email')?"red-border":""?>" id="inputEmail3" placeholder="<?=lang('x_reg_3');?>" value="<?=set_value('email');?>">
<!--                                <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="--><?php //=lang('x_reg_8');?><!--"></i></span>-->
                                <span class="red">  <?php echo  form_error('email')?> </span>
                            </div>
                        </div>
                        <div class="form-group note-group">
                            <label id="lbl_pass" class="col-sm-3 control-label"><?=lang('x_reg_4');?><cite class="req">*</cite></label>
                            <div id="div_pass" class="col-sm-9 live-trading-note">
                                <p class="note-top">(<?=lang('x_reg_9');?>)</p>
                                <input name="full_name" type="text" maxlength="48" class="form-control round-0 <?php echo form_error('full_name')?"red-border":""?>" id="full" placeholder="<?=lang('x_reg_10');?>" value="<?=set_value('full_name');?>">
<!--                                <span class="input-tooltip tab-img-holder"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="--><?php //=lang('x_reg_9');?><!--"></i></span>-->
                                <span class="red"> <?php echo  form_error('full_name')?> </span>
                            </div>
                        </div>
                        <div class="form-group sa-demo-submit">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn-submit">
                                    <?=lang('x_reg_5');?>
                                </button>
                            </div><div class="clearfix"></div>
                        </div>
                        <label class="control-label form-text" style="min-width:136px; text-align:center;">
                            <?=lang('x_reg_6');?>
                        </label>
                        <div class="clearfix"></div>
                        <button type="button" class="btn-signin" onclick="gotolink()">
                            <?=lang('x_reg_7');?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function gotolink(){
        window.location.href = "<?= FXPP::my_url('client/signin'); ?>";
    }

    var language = '<?=FXPP::html_url()?>';
    $(document).ready(function(){

        str = language.replace(/\s/g, '');
        if (str === 'my' || str === 'pt'){
            $('.col-centered').removeClass("col-lg-5");
            $('.col-centered').addClass("col-lg-6");

            $('.col-centered').removeClass("col-md-5");
            $('.col-centered').addClass("col-md-6");

            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-4");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-8");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-4");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-8");
        } else if (str === 'ru') {
            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-5");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-7");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-5");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-7");

            $(".col-centered").removeClass("col-lg-5");
            $(".col-centered").removeClass("col-md-5");
            $(".col-centered").addClass("col-lg-7");
            $(".col-centered").addClass("col-md-7");
        }
        if (str === 'id'){
            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-3");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-9");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-3");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-9");
        }
        if (str === 'it'){
            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-5");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-7");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-5");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-7");
        }



        if (str === 'bg'){
            $(".col-centered").removeClass("col-lg-5");
            $(".col-centered").removeClass("col-md-5");


            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-5");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-7");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-5");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-7");
        }
        if (str === 'jp'){
            $(".col-centered").addClass("col-lg-6");
            $(".col-centered").addClass("col-md-6");

            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-4");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-8");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-4");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-8");
        }
        if (str === 'sa'){
            $(".col-centered").addClass("col-lg-6");
            $(".col-centered").addClass("col-md-6");

            $("#lbl_email").removeClass("col-sm-2");
            $("#lbl_email").addClass("col-sm-4");

            $("#div_email").removeClass("col-sm-10");
            $("#div_email").addClass("col-sm-8");

            $("#lbl_pass").removeClass("col-sm-2");
            $("#lbl_pass").addClass("col-sm-4");

            $("#div_pass").removeClass("col-sm-10");
            $("#div_pass").addClass("col-sm-8");
        }
    });

</script>
<?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>
<?php //if(IPLoc::Office()){?>
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

            $('#register').validate({ // initialize the plugin
                rules: {
                    email: {
                        required: true,
                        regex: cyrillic
                    },
                    full_name:{
                        required: true,
                        regex: cyrillic
                    }
                },
                messages: {
                    email:{
                        required: "<?=lang('validate_demo1');?>",
                        regex: "<?=lang('validate_engrus1'); ?>"+" Email " + "<?=lang('validate_engrus2'); ?>"

                    },
                    full_name:{
                        required: "<?=lang('validate_demo2');?>",
                        regex:"<?=lang('validate_engrus1'); ?>"+" Full Name " + "<?=lang('validate_engrus2'); ?>"
                    }
                },
                submitHandler: function (form) {

                    return true;
                }
            });
        });
    </script>



<?php //}else{?>
<!--
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

            $('#register').validate({ // initialize the plugin
                rules: {
                    email: {
                        required: true,
                        regex: "^[a-zA-Z 0-9 �?аБбВвГгДдЕе�?ёЖжЗзИиЙйКкЛлМм�?нОоПпРрС�?ТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭ�?ЮюЯ�?@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“�?–—˜™š›œŸ¨©®¯³´¸¹¾À�?ÂÃÄÅÈÉÊËÌ�?Î�?�?ÒÓÔÕÖ×ØÙÚÛÜ�?Þãðõ÷øüýþ$ \.\,\+\-\_]*$"
                    },
                    full_name:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 �?аБбВвГгДдЕе�?ёЖжЗзИиЙйКкЛлМм�?нОоПпРрС�?ТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭ�?ЮюЯ�?@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“�?–—˜™š›œŸ¨©®¯³´¸¹¾À�?ÂÃÄÅÈÉÊËÌ�?Î�?�?ÒÓÔÕÖ×ØÙÚÛÜ�?Þãðõ÷øüýþ$ \.\,\+\-\_]*$"
                    },
                },
                messages: {
                    email:{
                        required: "<?=lang('validate_engrus0'); ?>"+" Email.",
                        regex: "<?=lang('validate_engrus1'); ?>"+" Email " + "<?=lang('validate_engrus2'); ?>"

                    },
                    full_name:{
                        required: "<?=lang('validate_engrus0'); ?>"+ " Full Name.",
                        regex:"<?=lang('validate_engrus1'); ?>"+" Full Name " + "<?=lang('validate_engrus2'); ?>"
                    },
                },
                submitHandler: function (form) {

                    return true;
                }
            });
        });
    </script>
-->
<?php //}?>

