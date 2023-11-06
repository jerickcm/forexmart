<link href="<?= $this->template->Css()?>register_live1.css" rel="stylesheet">
<div class="contentWrapper" style="background-size:cover; background-attachment:fixed;">
    <div class="container">
        <div class="inputFormcontainer animated slideInUp">
            <div class="columnStyle1">
                <div class="panel">
                    <div class="panel-heading"><?php if(FXPP::html_url() == 'en'){ ?><h1 class="headingTitle"><?=lang('x_reg_1');?></h1><?php }else{ ?> <h1 class="headingTitle"><?=lang('x_reg_1');?></h1> <?php } ?></div>
                    <?php if(IPLoc::Office()){ $action = FXPP::loc_url("register/index");}else{ $action = FXPP::loc_url("register/index");}?>
                    <form action="<?=$action;?>" method="post" class="form-horizontal task2163" id="live">
                        <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                        <div class="panel-body">
                            <div class="inputGrpContainer">
                                <p class="note-top cl_dis1">(<?=lang('x_reg_8');?>)</p>
                                <div class="input-group inputData">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa-lg"></i></span>
                                    <input type="text" name="email"  maxlength="128" class="form_control<?php echo form_error('email')?" red-border":""?> ext-arabic-form-control-placeholder" id="inputEmail3" placeholder="<?=lang('x_reg_3');?>" value="<?=set_value('email');?>" style="outline: none!important;">
                                    <i class="fa fa-exclamation-circle fa-lg img_text_hover_show1 fa-align"></i>
                                </div>
                                <span class="red">  <?php echo  form_error('email')?> </span><p class="note-top cl_dis2">(<?=lang('x_reg_9');?>)</p>
                                <div class="input-group inputData">
                                    <span class="input-group-addon"><i class="fa fa-user fa-lg"></i></span>
                                    <input name="full_name" type="text" maxlength="48" class="form_control<?php echo form_error('full_name')?" red-border":""?> ext-arabic-form-control-placeholder" id="full" placeholder="<?=lang('x_reg_10');?>" value="<?=set_value('full_name');?>" style="outline: none!important;">
                                    <i class="fa fa-exclamation-circle fa-lg img_text_hover_show2 fa-align"></i>
                                </div>
                                    <span class="red"> <?php echo  form_error('full_name')?> </span><button type="submit" class="btn btnSubmit ext-arabic-btn-submit"><?=lang('x_reg_5');?></button>
                                <div class="">
                                    <h4 class="lightTextCenter"><?=lang('x_reg_6');?></h4>
                                    <a class="btn btnSignIn btnClassA" href="<?= FXPP::my_url('client/signin'); ?>" ><?=lang('x_reg_7');?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->load->ext_view('modal', 'reglimit_live', '', TRUE); ?>
<script src="<?= $this->template->Js() ?>jquery.rwdImageMaps.min.js"></script>
<script src="<?= $this->template->Js() ?>scrolltotop.js"></script> <!-- Gem jQuery -->
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 6,
            lazyLoad : true,
            navigation : false
        });
        $('.play').on('click',function(){ owl.trigger('autoplay.play.owl',[1000]) });
        $('.stop').on('click',function(){  owl.trigger('autoplay.stop.owl') });
        $(".img_text_hover_show1").hover(function(){
            $(".cl_dis1").css("visibility", "visible");
        }, function(){
            $(".cl_dis1").css("visibility", "hidden");

        });
        $(".img_text_hover_show2").hover(function(){
            $(".cl_dis2").css("visibility", "visible");
        }, function(){
            $(".cl_dis2").css("visibility", "hidden");
        });
        $('img[usemap]').rwdImageMaps();
        $('.page-link').mouseover(function () { $($(this).data('target')).fadeIn("fast");  });
        $('.page-link').mouseleave(function () {  $($(this).data('target')).fadeOut("fast"); });
    });
    $(".footer-toggle").click(function() {
        $(".footer-hide-menu").toggle(300, function () {
            // Animation complete.
        });
    });
    $(function() {
        $('#nig').hover(function() {
            $('#nigeria-holder').fadeIn("fast");
        }, function() {
            $('#nigeria-holder').fadeOut("fast");
        });
        $('#mal').hover(function() {
            $('#malaysia-holder').fadeIn("fast");
        }, function() {
            $('#malaysia-holder').fadeOut("fast");
        });
        $('#ind').hover(function() {
            $('#indonesia-holder').fadeIn("fast");
        }, function() {
            $('#indonesia-holder').fadeOut("fast");
        });
        $('#cy').hover(function() {
            $('#cyprus-holder').fadeIn("fast");
        }, function() {
            $('#cyprus-holder').fadeOut("fast");
        });
    });


    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 75) {
            $('#nav').addClass('nav-fix');
            $('#top').addClass('top-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
            $('#top').removeClass('top-fix');
        }
    });
</script>
<?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>
<?php if(IPLoc::Office()){?>
    <script>
        $( document ).ready( function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
            );
            $('#live').validate({ // initialize the plugin
                rules: {
                    email: { required: true, regex: cyrillic },
                    full_name:{ required: true, regex: cyrillic }
                },
//                messages: {
//                    email:{  required: "<?//=lang('validate_engrus0'); ?>//"+" Email.",  },
//                    full_name:{  required: "<?//=lang('validate_engrus0'); ?>//"+ " Full Name.", },
//                },
//                submitHandler: function (form) {
//                    return true;
//                }
            });
        });
    </script>
<?php }else{ ?>
    <script>
        $( document ).ready( function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
            );
            $('#live').validate({ // initialize the plugin
                rules: {
                    email: { required: true, regex: cyrillic },
                    full_name:{  required: true, regex: cyrillic },
                },
                messages: {
                    email:{  required: "<?=lang('validate_engrus0'); ?>"+" Email."  },
                    full_name:{  required: "<?=lang('validate_engrus0'); ?>"+ " Full Name." }
                },
                submitHandler: function (form) {
                    return true;
                }
            });
        });
    </script>
<?php } ?>