<!DOCTYPE html>
<html lang="<?= FXPP::html_url() ?>" dir="<?= FXPP::lang_dir(); ?>">
<head>
    <link rel="icon" type="image/ico" href="<?=base_url()?>assets/images/icon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ForexMart | Limited Bonus</title>
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/landing_v2/css/bootstrap.min.css" >
    <link href="<?=$this->template->Css()?>carousel/main/style.css" rel="stylesheet">

    <!-- CAROUSEL -->
    <script  type="text/javascript" src="<?= $this->template->Js()?>jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/landing_v2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$this->template->Css()?>carousel/js/jquery.flexisel.js"></script>




    <?php if(!IPLoc::isChinaIP()){ ?>
    <meta name="google-site-verification" content="hUTbDLfEPfAPqV6xcbcuxv_b8HIjsXKIeBHijGZbZE4" />
    <?php } ?>


    <input type="hidden" value="<?=($this->session->userdata('logged'))?'start':''?>" id="isloogin"/>


    <script type="text/javascript">
        $(window).load(function() {


            $("#flexiselDemo3").flexisel({
                visibleItems: 4,
                itemsToScroll: 1,
                autoPlay: {
                    enable: true,
                    interval: 5000,
                    pauseOnHover: true
                }
            });

            var numb='<?=$countDown?>';
            if(numb==0)
            {
                var isloogin=$("#isloogin").val();
                if(isloogin=="start"){
                    $('#popup').modal('show');
                }
            }

        });
    </script>
    <link href="<?=$this->template->Css()?>carousel/css/style.css" rel="stylesheet">
    <!-- counter down link-->
    <link rel="stylesheet" href="<?=$this->template->Css()?>carousel/countdown/flipclock.css">
    <script src="<?=$this->template->Css()?>carousel/countdown/flipclock.js"></script>


    <?php if(!IPLoc::isChinaIP()){ ?>
        <?php if(IPLoc::Office()){ ?>
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-MRVPP5L');
            </script>
        <?php }else{ ?>
            <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-KHXDKN');
            </script>
        <?php } ?>
    <?php } ?>


</head>
<body>

<?php if(!IPLoc::isChinaIP()){ ?>

    <?php if(isset($_SESSION['user_id'])){ $ga_user_id =(string) $_SESSION['user_id']; ?>

    <script type="text/javascript">
        var usrid ='<?=$ga_user_id;?>';
        usrid='88'.concat(usrid).concat('88');
        dataLayer = [{'userID': usrid.toString()}];
    </script>

        <?php }else if(isset($_COOKIE['forexmart_gtm_id'])){ ?>

    <script type="text/javascript">
        var usrid ='<?=$_COOKIE['forexmart_gtm_id'];?>';
        usrid='88'.concat(usrid).concat('88');
        dataLayer = [{'userID': usrid.toString()}];
    </script>

        <?php } ?>
    <?php if(IPLoc::Office()){ ?>
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MRVPP5L" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <?php }else{ ?>
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KHXDKN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <?php } ?>
    <?php } ?>


<nav class="navbar navbar-default new-version-navbar-default">
    <div class="container">
        <div class="navbar-header new-version-navbar-header">
            <button type="button" class="navbar-toggle new-version-navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="btn-group fx-btn-group secondary-new-version-btn-group">
                <a class="btn btn-primary dropdown-toggle new-version-btn-primary" data-toggle="dropdown" href="#">
                    <img id="img-src" src="<?=$this->template->Images()?>flags/<?=$flag;?>" width="42" height="25"/>
                </a>
                <ul class="dropdown-menu new-version-dropdown-menu">
                    <li>
                        <a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english">
                            <img src="<?=$this->template->Images()?>flags/english.png"  width="30" height="20"/>
                            <span>English</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan">
                            <img src="<?=$this->template->Images()?>flags/russian.png"  width="30" height="20"/>
                            <span>Русский</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="new-version-left-container">
                <a class="navbar-brand" href="#">
                    <img src="<?=$this->template->Images()?>fxlogo.svg" width="267" height="72" class="img-responsive">
                </a>
                <div class="new-version-right-navbar-brand">
                <span>
                    <?=lang('flb_01');?>
                </span>
                    <button class='new-version-cta-button2' style="background: #28a64a;border: 0;">
                        <span><?=$flb_user;?></span>
                    </button>
                </div>
            </div>
            <div class="new-version-tagline">
                <span><?=lang('flb_01');?></span>
                <button class='new-version-cta-button3' style="background: #28a64a;border: 0;">
                    <span class="second-liner-tagline"><?=$flb_user;?></span>
                </button>
            </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse new-version-right-container">
            <ul class="nav navbar-nav new-version-navbar-nav">
                <li>
                    <span>bonuses@forexmart.com</span>
                    <button type="button" class="new-version-navbar-nav-button blue-new-version-button new-version-fdback-button" data-toggle="modal" data-target="#popfeedback">
                        <i class="feedback-icon"></i>
                        <label>
                            <?=lang('flb_14');?>
                            <?php //Feedback ?>
                        </label>
                    </button>
                </li>
                <li>
                    <div class="btn-group new-version-btn-group">
                        <a class="btn btn-primary dropdown-toggle new-version-btn-primary" data-toggle="dropdown" href="#">
                            <img id="img-src" src="<?=$this->template->Images()?>flags/<?=$flag;?>" width="42" height="25"/>
                        </a>
                        <ul class="dropdown-menu new-version-dropdown-menu">
                            <li>
                                <a href="<?= $this->config->item('domain-www');?>/LanguageSwitcher/switchLang/english">
                                    <img src="<?=$this->template->Images()?>flags/english.png"  width="30" height="20"/>
                                    <span>English</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $this->config->item('domain-www'); ?>/LanguageSwitcher/switchLang/russuan">
                                    <img src="<?=$this->template->Images()?>flags/russia.png"  width="30" height="20"/>
                                    <span>Русский</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
<div class="container main-body-container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-version-main-container">
        <h1>
            <?=lang('flb_03')?>
            <?php //ARE YOU READY FOR REAL TRADING ?>
        </h1>
        <h5>
            <?=lang('flb_04')?>
            <?php //AND HIGHEST PROFIT ON FOREX? ?>
        </h5>

        <!-- START TEMPORARY BUTTON -->
        <button type="button" class="new-version-cta-button" >
            <span class="cta-button-left">
              <label>
                  <?= lang('flb_05_1');?>
                  <?php //GET ?>
                  </br>
                  <?= lang('flb_05_2');?>
                  <?php //BONUS ?>
              </label>
              <i class="cta-button-arrow"></i>
            </span>

            <span class="cta-button-right">
              <label id="cta-big-label">

                  <?=lang('flb_06_1');?>
                  <?php//+120% ?>
                  </label>
                  <label id="cta-small-label">
                  <?=lang('flb_06_2');?>
                      <?php//on first ?>
                  </br>
                  <?=lang('flb_06_3');?>
                      <?php //deposit ?>
              </label>
            </span>
        </button>
        <!-- END TEMPORARY BUTTON -->

        <?php
        if($this->session->userdata('logged'))
        {
            ?>

            <div class="limited-div-container">
                <div class="limited-div-left">
                <span>
                    <?=lang('flb_07_1');?>
                    <?php //Special offer ?>
                    </br>
                    <?=lang('flb_07_2');?>
                    <?php //is limited, remains: ?>

                </span>
                </div>
                <div class="clock" ></div>

            </div>
            <?php }else{ ?>

            <div class="xhidebox" >

            </div>

            <?php }?>


        <div class="bottom-container">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="bottom-container-child bottom-left-container">
                    <label>
                        <?=lang('flb_08_1');?>
                        <?php //97% ?>
                    </label>
                <span>
                    <?=lang('flb_08_2');?>
                    <?php //of clients are satisfied with our conditions and quality of service ?>
                </span>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="bottom-container-child bottom-right-container">
                    <span>
                       <?=lang('flb_09');?>
                        <?php //Fast deposit with no fees: ?>
                    </span>

                    <div class="nbs-flexisel-container">
                        <div class="nbs-flexisel-inner">
                            <ul id="flexiselDemo3" class="nbs-flexisel-ul" style="left: -4149.56px; display: block;">
                                <li class="nbs-flexisel-item"><img src="<?=$this->template->Images()?>visa.png" width="114" height="46"/></li>
                                <li class="nbs-flexisel-item"><img src="<?=$this->template->Images()?>skrill.png" width="114" height="46"/></li>
                                <li class="nbs-flexisel-item"><img src="<?=$this->template->Images()?>neteller.png" width="114" height="46"/></li>
                                <li class="nbs-flexisel-item"><img src="<?=$this->template->Images()?>payco.png" width="114" height="46"></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

</div>
</div>
<footer class="main-footer">
    <div class="container">
        <ul>
            <li>
                <?=lang('flb_10');?>
                <?php //Deposit your account ?>
            </li>
            <li>
                <span class="footer-right-arrow"></span>
                <span class="footer-down-arrow"></span>
            </li>
            <li>
                <?=lang('flb_11');?>
                <?php //Get bonus on your deposit ?>
            </li>
            <li>
                <span class="footer-right-arrow"></span>
                <span class="footer-down-arrow"></span>
            </li>
            <li>
                <?=lang('flb_12');?>
                <?php //Start getting profit ?>
            </li>
        </ul>

        <div class="sub-footer">
            <a href="<?= $this->template->pdf().$tracon?>">
                <label>
                    <?=lang('flb_13');?>
                    <?php //Terms and Conditions ?>
                </label>
                <i></i>
            </a>
        </div>
    </div>
</footer>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/landing_v2/css/feedback.css" />
<div class="modal fade popfeedback" id="popfeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0 feedback-modal-container">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">
                    <img src="<?=base_url()?>assets/landing_v2/images/fxlogonew.svg" class="img-reponsive feedback-logo">
                </div>
            </div>
            <div class="modal-body">
                <p class="fback-first-line">
                    <?=lang('flb_16');?>
                    <?php//Good day! We'd love to hear your feedback about your Account.?>
                    </br><small>
                    <?=lang('flb_17');?>
                    <?php//How would you rate your experience on a scale of 1-10? ?>
                </small>
                </p>
                <div class="row">
                    <div class="col-sm-12 scale">
                        <div class="feedback-rate-holder">
                            <p>
                                <?=lang('flb_18');?>
                                <?php //1 - Poor?>
                            </p>
                            <p>
                                <?=lang('flb_19');?>
                                <?php //10 - Excellent?>
                            </p>
                            <ul class="feedback-rate-list" id="listRating">
                                <li>
                                    <input type="radio" id="c1" name="rating" value="1" class="rad rating">
                                    <label for="c1">1</label>
                                </li>
                                <li>
                                    <input type="radio" id="c2"  name="rating" value="2" class="rad rating">
                                    <label for="c2">2</label>
                                </li>
                                <li>
                                    <input type="radio" id="c3"  name="rating" value="3" class="rad rating">
                                    <label for="c3">3</label>
                                </li>
                                <li>
                                    <input type="radio" id="c4"  name="rating" value="4" class="rad rating">
                                    <label for="c4">4</label>
                                </li>
                                <li>
                                    <input type="radio" id="c5"  name="rating" value="5" class="rad rating">
                                    <label for="c5">5</label>
                                </li>
                                <li>
                                    <input type="radio" id="c6"  name="rating" value="6" class="rad rating">
                                    <label for="c6">6</label>
                                </li>
                                <li>
                                    <input type="radio" id="c7"  name="rating" value="7" class="rad rating">
                                    <label for="c7">7</label>
                                </li>
                                <li>
                                    <input type="radio" id="c8" name="rating" value="8" class="rad rating">
                                    <label for="c8">8</label>
                                </li>
                                <li>
                                    <input type="radio" id="c9"  name="rating" value="9" class="rad rating">
                                    <label for="c9">9</label>
                                </li>
                                <li>
                                    <input type="radio" id="c10"  name="rating" value="10" class="rad rating">
                                    <label for="c10">10</label>
                                </li><div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="fback-second-line">
                    </br>
                    <small>
                        <?=lang('flb_20');?>
                        <?php//Should you have any specific feedback, please select a category below.(optional)?>
                    </small>
                </p>
                <div class="row">
                    <div class="col-xs-8">
                        <form class="form-horizontal">
                            <div class="form-group feedback-modal-group">
                                <label class="col-sm-3 control-label lblcat">
                                    <?=lang('flb_21');?>
                                    <?php//Category?>
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control round-0" id="category">
                                        <option value="Problem">
                                            <?=lang('flb_22');?>
                                            <?php//Problem?>
                                        </option>
                                        <option value="Suggestion">
                                            <?=lang('flb_23');?>
                                            <?php//Suggestion?>
                                        </option>
                                        <option value="Compliment">
                                            <?=lang('flb_24');?>
                                            <?php// Compliment?>
                                        </option>
                                        <option value="Other">
                                            <?=lang('flb_25');?>
                                            <?php//Other?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <textarea rows="5" class="form-control round-0" id="message"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" class="btn btn-default round-0" data-dismiss="modal" id="cancel">
                    <?=lang('flb_26');?>
                    <?php//Cancel?>
                </button>
                <button type="button" class="btn btn-primary round-0" onclick="sendFeedback()">
                    <?=lang('flb_27');?>
                    <?php//Send Feedback?>
                </button>
            </div>
        </div>
    </div>
</div>

<button href="javascript:;"  data-toggle="modal" data-target="#popfeedbacktwo" style="display:none" id="hiddenPopId"></button>
<div class="modal fade popfeedback" id="popfeedbacktwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog round-0 feedback-modal-container">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle feedback-modal-title" id="myModalLabel">
                    <img src="<?=base_url()?>assets/landing_v2/images/fxlogonew.svg" class="img-reponsive feedback-logo">
                </div>
            </div>
            <div class="modal-body">

                <p class="fback-first-line" style="    color: green;font-size: 17px;   text-align: center;">
                    <b>
                        <?=lang('flb_28');?>
                        <!--                            Thanks for the Feedback-->
                    </b>
                </p>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <p>
                                <b>
                                    <?=lang('fxLan_feadb_02');?>

                                </b>
                            </p>
                            <p>
                                <?=lang('fxLan_feadb_03');?>

                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?=lang('flb_30')?>
                            <!--                                Email: -->
                            <input type="email" class="form-control round-0" size="50" maxlength="100" id="feadback_email">
                            <input type="hidden" id="feadback_email_id"/>
                        </div>
                    </div>

                </div>


            </div>

            <div class="modal-footer round-0 popfooter">
                <div class="modal-footer round-0 popfooter">
                    <button class="btn btn-default round-0" value="true" id="button_feedback" type="button" > <?=lang('fxLan_feadb_04');?></button>
                    <button class="btn btn-default round-0 " aria-label="Close" data-dismiss="modal" id="dismisclose" type="button">
                        <?=lang('fxLan_feadb_05');?>
                        <!-- Close-->
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>
<form action="" id="secret_form" method="">
    <input type="hidden" id="secret" name="secret">
</form>
</body>

</html>

<input type="hidden" id="lanSecond" value="<?=lang('flb_35')."_".lang('flb_35s');?>">
<input type="hidden" id="lanMinute" value="<?=lang('flb_34')."_".lang('flb_34s');?>">
<input type="hidden" id="lanHour" value="<?=lang('flb_33')."_".lang('flb_33s');?>">

<script type="text/javascript">
    $(document).on("click",".new-version-cta-button",function(){
        $("#secret_form").attr('action','https://my.forexmart.com/deposit-limited-bonus');
        $("#secret_form").attr('method','POST');
        var secretshh = '67fyuvhbk901u2iohkje7iuj45etdg789oiyhkj67ryufgh';
        $('#secret').val(secretshh);
        $('#secret_form').submit();
    });

    $(document).on("click",".new-version-cta-button2",function(){
        $("#secret_form").attr('action','https://my.forexmart.com/deposit-limited-bonus');
        $("#secret_form").attr('method','POST');
        var secretshh = '67fyuvhbk901u2iohkje7iuj45etdg789oiyhkj67ryufgh';
        $('#secret').val(secretshh);
        $('#secret_form').submit();
    });

    $(document).on("click",".new-version-cta-button3",function(){
        $("#secret_form").attr('action','https://my.forexmart.com/deposit-limited-bonus');
        $("#secret_form").attr('method','POST');
        var secretshh= '67fyuvhbk901u2iohkje7iuj45etdg789oiyhkj67ryufgh';
        $('#secret').val(secretshh);
        $('#secret_form').submit();
    });
</script>

<!--- counter down code -->
<script type="text/javascript">
    var clock;
    var dys="<?= lang('flb_32');?>";
    var hrs="<?= lang('flb_33');?>";
    var min="<?= lang('flb_34');?>";
    var sec="<?= lang('flb_35');?>";
    $(document).ready(function() {
        var clock;
        var isloogin=$("#isloogin").val();
        clock = $('.clock').FlipClock({
            clockFace: 'DailyCounter',
            autoStart: false,
            callbacks: {
                stop: function() {
                    //  $('.message').html('The clock has stopped!')


                    if(isloogin=="start"){
                        $('#popup').modal('show');
                    }

                }
            }
        });

        if(isloogin=="start"){
            var numb='<?=$countDown?>';
        }else{var numb=0;}
        console.log(numb);
        //  numb=0;
        numb=parseInt(numb);
        clock.setTime(numb);
        clock.setCountdown(true);
        clock.start();

        //$(".flip-clock-wrapper").css("width","353px")
        // $(".flip-clock-wrapper").append("<br><label class='lebelbox'>"+dys+"</label>");
        // $(".flip-clock-wrapper").append("<label class='lebelbox'>"+hrs+"</label>");
        // $(".flip-clock-wrapper").append("<label class='lebelbox'>"+min+"</label>");
        // $(".flip-clock-wrapper").append("<label class='landec'>"+sec+"</label>");

        $(".flip-clock-wrapper").append("<br><label class='lebelbox' id='daysclock'>"+dys+"</label>");
        $(".flip-clock-wrapper").append("<label class='lebelbox'     id='hoursclock'>"+hrs+"</label>");
        $(".flip-clock-wrapper").append("<label class='lebelbox'     id='minuteclock'>"+min+"</label>");
        $(".flip-clock-wrapper").append("<label class='lebelbox'     id='secondclock'>"+sec+"</label>");
    });


    $(document).on("click","#button_feedback",function(){

        var fid=parseInt($("#feadback_email_id").val());
        var feadback_email=$("#feadback_email").val();
        var checkemail=isEmail(feadback_email);



        if(checkemail==true)
        {
            $('#loader-holder').show();
            var url='<?php echo site_url()?>';
            $.post(url+'Forexmart_limited_bonus/feadBackEmailStore',{fid:fid,email:feadback_email},function(views){
                $("#feadback_email_id").val("");
                $("#feadback_email").val("");
                $('#loader-holder').hide();
                document.getElementById("dismisclose").click();
            });
        }
        else
        {
            $('#loader-holder').hide();
            alert("<?=lang('fxLan_feadb_01');?>");
        }




    });


    function sendFeedback(){
        var ratingval="";
        $("#listRating li").each(function(){
            if($(this).find('.rating').is(':checked')){ratingval=$(this).find('.rating').val();}

        }) ;

        var category=$("#category").val();
        var message=$("#message").val();


        if(ratingval==="")
        {
            alert("Please select a rate.");
        }
        else
        {
            var url='<?php echo site_url()?>';
            $.post(url+'Forexmart_limited_bonus/Feedback',{message:message,category:category,rating:ratingval},function(view){

                if(view==="error")
                {
                    alert(" Sending Failed. Please try again");
                }
                else
                {
                    document.getElementById("cancel").click();
                    document.getElementById("hiddenPopId").click();
                    $('.rating').prop('checked', false);
                    $("#message").val("");
                    $("#feadback_email_id").val(view);
                }

            });

        }

    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);

    }


</script>

<style type="text/css">
    .flip-clock-wrapper ul:nth-child(2){ margin-right:7px }
    .flip-clock-wrapper ul:nth-child(4){ margin-right:7px }
    .flip-clock-wrapper ul:nth-child(6){ margin-right:7px }
    .lebelbox{float:left; width:77px; margin-right:8px ; color: white;}
    .clock{ width:353px; float: right}




    @media (max-width: 370px) {

        .flip-clock-wrapper{ margin: 0px !important; text-align: left !important; width: 264px !important}
        .flip-clock-wrapper ul {
            padding: 0 !important;
            width: 28px !important;
        }


        .lebelbox {

            margin-right: 9px !important;
            width: 68px !important;
        }



        .limited-div-container {
            display: -moz-popup !important;
            float: left;
            padding-left: 3px !important;
            position: unset !important;
        }

        #minuteclock{margin-left: -16px !important;}
        #hoursclock{margin-left: -10px !important;}
        #secondclock{margin-left: -20px !important;}


    }


    @media (max-width: 380px) {
        .feedback-logo{ width: 250px}
    }


    @media (max-width: 325px) {
        .feedback-logo{ width: 200px}
    }


    @media (max-width:420px) {
        .limited-div-container{ width: 355px !important; margin: 30px auto 30px 13px !important}
        .flip-clock-wrapper{ width: 305px !important;}
        .flip-clock-wrapper ul{ width: 35px !important ; padding: 0px !important}
        #daysclock{margin-left:8px; margin-right:35px !important; width: 27px !important}
        #hoursclock{ width: 58px !important; margin-right:0px; margin-left: 10px !important;}
        #minuteclock{margin-left:10px; margin-right:0px}
        #secondclock {
            margin-left: -12px !important;
            padding: 0 !important;
            text-align: right;
        }
    }

    @media (max-width:390px) {
        .limited-div-container{ width: 317px !important; margin: 30px auto 30px 13px !important}
        .flip-clock-wrapper{ width: 280px !important;}
        .flip-clock-wrapper ul{ width: 32px !important }
        #daysclock{margin-left:8px; margin-right:35px !important; width: 27px !important}
        #hoursclock{ width: 58px !important; margin-right:0px}
        #minuteclock{margin-left:-4px; margin-right:0px}
        #secondclock {
            margin-left: -22px !important;
            padding: 0 !important;
            text-align: right;
        }
    }



    @media (max-width:360px) {
        .limited-div-container{ width: 300px !important; margin: 30px auto 30px 13px !important}
        .flip-clock-wrapper{ width: 250px !important;}
        .flip-clock-wrapper ul{ width: 25px !important }
        #daysclock{margin-left:8px; margin-right:35px !important; width: 27px !important}
        #hoursclock{ width: 58px !important; margin-right:0px; margin-left: -10px !important}
        #minuteclock{margin-left:-24px; margin-right:0px}
        #secondclock {
            margin-left: -45px !important;
            padding: 0 !important;
            text-align: right;
        }
    }


    @media (max-width:320px) {
        .limited-div-container{ width: 244px !important; margin: 30px auto 30px 24px !important}
        .flip-clock-wrapper{ width: 221px !important;}
        .flip-clock-wrapper ul{ width: 25px !important }
        #daysclock{margin-left:8px; margin-right:35px !important; width: 27px !important}
        #hoursclock{ width: 58px !important; margin-right:0px;  margin-left: -10px !important;}
        #minuteclock{margin-left:-24px; margin-right:0px}
        #secondclock {
            margin-left: -45px !important;
            padding: 0 !important;
            text-align: right;
        }
    }


    @media (max-width:300px) {
        .limited-div-container{ width: 244px !important; margin: 30px auto 30px 2px !important}
        .flip-clock-wrapper{ width: 221px !important;}
        .flip-clock-wrapper ul{ width: 25px !important }
        #daysclock{margin-left:8px; margin-right:35px !important; width: 27px !important}
        #hoursclock{ width: 58px !important; margin-right:0px}
        #minuteclock{margin-left:-24px; margin-right:0px}
        #secondclock {
            margin-left: -45px !important;
            padding: 0 !important;
            text-align: right;
        }
    }












    .xhidebox{display: table;
        margin: 30px auto;
        padding: 10px;
        position: relative; border:none; height: 100px;}



</style>

<div class="modal fade" id="popup" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" data-keyboard="false" >
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0" style="padding: 0px">

                <h3 class="modal-title modal-show-title cgrts">
                    <b style="text-align: center; width: 100%; float: left;"><?=lang('flb_36');?></b>
                </h3>
            </div>
            <div class="modal-body modal-show-body">
                <div class="row">
                    <p style="font-family: Georgia; text-align: center; padding: 0px 4px; font-size: 19px;"><?=lang('flb_37');?></p>
                </div>
            </div>
        </div>
    </div>
</div>


