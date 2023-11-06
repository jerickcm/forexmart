<?php $this->lang->load('vipwinner') ?>

<style>
    .vip-main-holder
    {
        width: 100%;
        min-height: 10px;
        background: url(<?= $this->template->Images() ?>vip-bg-3.png) repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding-bottom: 30px;
    }
    .vip-title
    {
        font-family: Georgia;
        color: #333;
        font-size: 25px;
    }
    .winner-img-holder, .vip-winner-text
    {
        margin-top: 15px;
    }
    .winner-img-holder .winner-img
    {
        border: 5px solid #fff;
        box-sixing: border-box;
        box-shadow: 1px 1px 3px 1px rgba(0,0,0,0.25);
    }

    .vip-winner-text p
    {
        color: #333;
        font-family: Open Sans;
        font-size: 17px;
        font-weight: 300;
        font-style: italic;
        text-align: justify;
        line-height: 27px;
        background: rgba(255,255,255, 0.25);
        padding: 20px;
    }
    .vip-winner-text p span
    {
        display: block;
        text-align: right;
        margin-top: 11px;
        font-weight: 600;
        font-style: normal;
    }
    .vip-title-sub
    {
        font-size: 25px;
        text-align: center;
        color: #fff;
        font-family: Open Sans;
    }

    .vip-slide
    {
        background-color: transparent!important;
        box-shadow: none!important;
    }
    .slider-ads
    {
        box-shadow: none!important;
    }
    .vip-logos
    {
        /*opacity: 0.6;*/
        /*float: none;*/
        margin-right: 70px!importantp;
        /*margin: 0 auto;*/
    }
    .vip-text
    {
        font-family: Open Sans;
        font-size: 17px;
        font-weight: 300;
        color: #fff;
        margin-top: 30px;
    }
    .vip-text .span1
    {
        color: #2988ca;
        font-weight: 600;
    }
    .vip-text .span2
    {
        color: #fad000;
        font-weight: 600;
    }
    .btn-vip-trading
    {
        font-family: Open Sans;
        font-size: 20px;
        padding: 20px;
        color: #fff;
        background: #29a643;
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 40px!important;
        margin: 0 auto;
        transition: all ease 0.3s;
        max-width: 300px;
    }
    .btn-vip-trading:hover
    {
        text-decoration: none;
        background: #3ecd5c;
        transition: all ease 0.3s;
        color: #fff;
    }
    .vip-msg
    {
        font-family: Open Sans;
        font-size: 24px;
        color: #fff;
        font-weight: 400;
        margin-top: 15px;
        /*text-align: justify;*/
    }
    .vip-msg .span1
    {
        font-weight: 600;
        color: #fad001;
    }
    .vip-msg .span2
    {
        font-weight: 600;
        color: #2988ca;
    }
    .valeron-img
    {
        margin-top: 30px;
    }
    /*.vip-fx-logo
    {
        margin-top: 15px;
        float: right;
    }*/
    .vip-content-holder
    {
        padding-bottom: 20px;
        background: url(<?= $this->template->Images() ?>vip-content-bg.png) repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .vip-btn-holder
    {
        /*margin-bottom: 20px!important;*/
    }

    @media only screen and (max-width: 320px){

        .vip-register-holder:lang(es)
        {
            margin: 0px!important;
        }

        .it_padding:lang(it){
            padding-left: 15px!important;
            padding-right: 15px!important;
        }


        .vip-register-holder:lang(es)
        {
            /*
            margin-right: 30px;
            */
        }
        .vip-register-holder:lang(my)
        {
            margin-right: 10px;
        }
    }
    @media screen and (max-width: 1199px) and (min-width: 991px) {
        .vip-register-holder:lang(bg){
            margin-right: 10px !important;
        }

        .vip-btn-holder:lang(bg) {
            width: 420px !important;
        }
    }


    .vip-register-holder
    {
        float: left;
        margin-right: 50px;
        margin-top: 10px;
    }
    .vip-register-holder p
    {
        font-family: Open Sans;
        font-size: 17px;
        color: #fff;
        /*font-weight: 600;*/
    }
    .vip-register-holder a
    {
        font-family: Open Sans;
        background: #29a643;
        color: #fff;
        border: 1px solid #29a643;
        text-decoration: none;
        font-size: 17px;
        padding: 15px 20px;
        display: inline-block;
        width: 200px;
        text-align: center;
        transition: all ease 0.3s;
    }
    .vip-register-holder a:lang(my) /* my */
    {
        font-family: Open Sans;
        background: #29a643;
        color: #fff;
        border: 1px solid #29a643;
        text-decoration: none;
        font-size: 17px;
        padding: 15px 20px;
        display: inline-block;
        width: 209px;
        text-align: center;
        transition: all ease 0.3s;
    }
    .vip-register-holder a:hover
    {
        background: #3bca59;
        text-decoration: none;
        transition: all ease 0.3s;
    }
    .vip-login-holder
    {
        float: left;
        margin-top: 10px;
    }
    .vip-login-holder p
    {
        font-family: Open Sans;
        font-size: 17px;
        color: #fff;
        /*font-weight: 600;*/
    }
    .vip-login-holder p:lang(my) /* my */
    {
        font-family: Open Sans;
        font-size: 15.5px;
        color: #fff;
        height: 24px;
        /*font-weight: 600;*/
    }
    .vip-login-holder a
    {
        font-family: Open Sans;
        background: #29a643;
        color: #fff;
        border: 1px solid #29a643;
        text-decoration: none;
        font-size: 17px;
        padding: 15px 20px;
        display: inline-block;
        width: 200px;
        text-align: center;
        transition: all ease 0.3s;
    }

    .vip-login-holder a:lang(my) /* my */
    {
        font-family: Open Sans;
        background: #29a643;
        color: #fff;
        border: 1px solid #29a643;
        text-decoration: none;
        font-size: 15px;
        padding: 15px 20px;
        display: inline-block;
        width: 209px;
        height: 56px;
        text-align: center;
        transition: all ease 0.3s;
    }

    .vip-login-holder a:hover
    {
        background: #3bca59;
        text-decoration: none;
        transition: all ease 0.3s;
    }
    .vip-mechanics
    {
        padding-left: 16px;
        /*margin: 0;*/
    }
    .vip-mechanics li
    {
        color: #2988ca;
        font-size: 17px;
        font-family: Georgia;
    }
    .vip-mechanics li span
    {
        color: #333;
        font-family: Open Sans;
        font-size: 15px;
        font-weight: 300;
    }
    .vip-main-title
    {
        color: #fff!important;
        font-size: 25px;
        font-family: Georgia;
        font-weight: 300;
        line-height: 35px;
        margin-top: 20px;
    }
    .vip-txt
    {
        font-family: Open Sans;
        font-size: 17px;
        margin-top: 20px;
        line-height: 27px;
        color: #333;
        font-weight: 300;
    }
    .vip-last-text
    {
        text-align: center;
        font-size: 20px;
        font-family: Open Sans;
        color: #333;
        font-weight: 300;
        margin-top: 30px;
    }
    .vip-logos-holder
    {
        background: rgba(255,255,255,0.1);
        padding: 15px;
    }
    /*@media screen and (max-width: 1450px) {
        .vip-main-holder
        {
            background: url(../images/vip-bg-1450.png) repeat;
        }
    }
    @media screen and (max-width: 1450px) {
        .vip-col-5
        {
            width: 75%;
        }
    }*/
    @media screen and (max-width: 991px) {
        /*.vip-main-holder
        {
            background: url(../images/vip-bg-991.png) repeat;
        }
        .vip-col-5
        {
            width: 100%;
            margin-bottom: 20px;
        }*/
        .valeron-img
        {
            display: none;
        }
        .vip-msg
        {
            text-align: justify;
            margin-top: 40px;
        }
        .btn-vip-trading
        {
            margin-bottom: 15px!important;
            margin: 0 auto; cursor: pointer;
        }
    }
    @media screen and (max-width: 680px) {
        .vip-msg
        {
            margin-top: 20px;
        }
    }

    @media screen and (min-width: 992px) {
        .wide-de-lang:lang(de) {
            width: 58.666667% !important;
        }
    }




    @media screen and (max-width: 481px) {
        /*.winner-img-holder .winner-img
        {
            margin: 0 auto!important;
            float: none;
        }*/
        .vip-register-holder
        {
            margin-right: 0px;
            float: none;
            display: block;
        }
        .vip-msg
        {
            font-size: 25px;
            margin-top: 10px;
        }
        .vip-register-holder a, .vip-login-holder a
        {
            display: block;
            width: 100%;
        }

        /* my */
        .vip-register-holder a:lang(my)
        {
            display: block;
            width: 100%;
        }
        .vip-login-holder a:lang(my){
            display: block;
            width: 97%;
        }
        /* end of my */

        .vip-login-holder
        {
            float: none;
        }
        .vip-main-holder
        {
            padding-bottom: 15px;
        }
    }
    .vip-acct-text {
        width: 100%;
        padding: 10px 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        font-size: 14px;
        color: #333;
        font-family: Open Sans;
    }
    .vip-acct-lbl {
        font-size: 14px;
        color: #333;
        font-family: Open Sans;
    }

    @media screen and (min-width: 1200px) {
        .width-ru:lang(ru){
            width: 121%!important;
        }
        .float-ru:lang(ru){
            float: right!important;
            display: inline-block!important;
        }
        .margin-ru:lang(ru){
            margin-right: 0!important;
            display: inline-block!important;
        }
    }
    .margin-ru a:lang(de){
        font-size: 16px!important;
    }
    /* CSS FOR CZECH */
    .vip-main-title:lang(cs){
        color: #fff;
        font-size: 24px;
        font-family: Georgia;
        font-weight: 300;
        line-height: 35px;
        margin-top: 20px;
    }
    .vip-msg:lang(cs){
        font-family: Open Sans;
        font-size: 23px;
        color: #fff;
        font-weight: 400;
        margin-top: 15px;
    }
    /*    .vip-btn-holder:lang(cs) {
            display: inline-block;
        }
        .vip-register-holder:lang(cs) {
            float: left;
            margin-right: 40px;
            margin-top: 10px;
        }*/
    .vip-register-holder p, .vip-login-holder p:lang(cs) {
        font-family: Open Sans;
        font-size: 14px;
        color: #fff;
    }
    /* END OF CSS FOR CZECH */
</style>
<div class="vip-main-holder">
    <div class="container">
        <div class="row lang_it">
            <div class="col-md-5 wide-de-lang">
                <h2 class="vip-main-title"><?= lang('vip_L1'); ?></h2>
                <p class="vip-msg">
                    <?= lang('vip_L2'); ?>
                </p>
                <div class="vip-logos-holder">
                    <img src="<?= $this->template->Images() ?>vip-logos1.png" class="img-responsive winner-img vip-logos">
                </div>
                <div class="clearfix"></div>
                <div class="vip-btn-holder width-ru">
                    <div class="vip-register-holder margin-ru">
                        <p><?= lang('vip_L3'); ?></p>
                        <a href="<?= FXPP::www_url('register') ?>"><?= lang('vip_L4'); ?></a>
                    </div>
                    <div class="vip-login-holder float-ru">
                        <p><?= lang('vip_L5'); ?></p>
                        <a href="http://my.forexmart.com/<?= FXPP::html_url() ?>/client/signin"><?= lang('vip_L6'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <!-- <img src="images/vip-img.png" class="img-responsive valeron-img"> -->
            </div>
        </div>
    </div>
</div>
<div class="vip-content-holder">
    <div class="container it_padding">
        <div class="row">
            <div class="col-md-12">
                <p class="vip-txt">
                    <?= lang('vip_L7'); ?>
                </p>
                <h1 class="vip-title"><?= lang('vip_L8'); ?></h1>


                <p class="vip-txt">
                    <?= lang('vip_L9'); ?>
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="vip-title"><?= lang('vip_L10'); ?></h1>
            </div>
            <div class="col-md-3">
                <div class="winner-img-holder">
                    <img src="<?= $this->template->Images() ?>vip-winner-img.png" class="img-responsive winner-img">
                </div>
            </div>
            <div class="col-md-9 vip-col-9">
                <div class="vip-winner-text">
                    <p>
                        <?= lang('xw_vipwinnermsg'); ?>
                        <span>
                            <?= lang('xw_vipwinner'); ?>
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="vip-last-text"><?= lang('vip_L11'); ?> <a href="<?= FXPP::www_url('register') ?>"><?= lang('vip_L13'); ?></a></h2>
                <a  data-toggle="modal" data-target="#join"  style="cursor: pointer"  class="btn-vip-trading"><?= lang('vip_L12'); ?></a>
            </div>
        </div>
    </div>
</div>
<!-- end content -->

<div class="modal fade" id="join" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0 vip-modal-dialog" style="margin-top: 10%;width: 25%;" id="madepainbox">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <?= lang('vip_Lm1'); ?>
                </h4>
            </div>
            <div id="viewResult"  >
                <div class="modal-body modal-show-body">
                    <div class="row">
                        <div class="col-md-12" id="errorpage">
                            <p class="vip-acct-lbl"><?= lang('vip_Lm2'); ?></p>
                            <input type="text" class="vip-acct-text" id="ticId">
                        </div>
                    </div>
                </div>
                <div class="modal-footer round-0">
                    <button type="button" class="btn btn-primary round-0" onclick="submitVipTicket()"><?= lang('vip_Lm3'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .onoffres{text-align: center; height: 98px; padding: 30px;}
    @media only screen and (max-width: 1100px) {
        #madepainbox {
            width:60% !important;
        }
    }
    @media only screen and (max-width:766px) {
        #madepainbox {
            width:96% !important;
        }
    }
    @media only screen and (max-width:900px) {
        #madepainbox {
            margin-top:40% !important;
        }
    }
    @media only screen and (max-width: 400px) {
        #madepainbox {
            width:90% !important;
        }
    }

</style>

<script type="text/javascript">

    $(document).on("input", "#ticId", function () {
        $(".wrongmgs").remove();
    });

    function submitVipTicket()
    {

        $(".wrongmgs").remove();

        var url = "<?= base_url('pages/ticketRaffleVip') ?>";
        var ticId = $("#ticId").val();
        ticId = ticId.trim();
        if (ticId.length > 4)
        {

            $.post(url, {ticId: ticId}, function (cData) {


                if (cData.trim() == "frz")
                {

                    $("#errorpage").append("<i class='wrongmgs' style='color:red;'>" + '<?= lang('vip_Lm2'); ?>' + " </i>");
                }

                if (cData.trim() == "frz101")
                {

                    $("#viewResult").addClass('onoffres');
                    $("#viewResult").html("<b style='color:red'>" + '<?= lang('vip_Lm5'); ?>' + "</b>");
                }

                if (cData.trim() == "frz102")
                {

                    $("#viewResult").addClass('onoffres');
                    $("#viewResult").html("<b style='color:green'>" + '<?= lang('vip_Lm6'); ?>' + "</b>");
                }

            });
        } else
        {
            alert('<?= lang('vip_Lm7'); ?>');
        }

    }
</script>



