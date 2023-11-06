<?php header('Content-Type: text/html; charset=UTF-8');?>
<?php
if(FXPP::html_url()=='zh'){
    $this->lang->load('contestrules');
}
else{
    $this->lang->load('contestrules_zh');
}
?>

<div class="reg-form-holder">
    <?php echo $contest_header ?>
    <div class="container" id="container_rules">
        <h3 class="text-center ext-arabic-circles-list"><?= lang('ccr_h1_tit');?></h3>
        <hr>
        <ol class="circles-list ext-arabic-circles-list">
            <li class="tabcontest-title"><?= lang('ccr_i');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_i1');?></li>

                <li><?= lang('ccr_i2');?></li>
                <li><?= lang('ccr_i3');?></li>
                <li><?= str_replace('USD', $default_currency, lang('ccr_i4'));?></li>
                <ol class="boxes-list ext-arabic-boxes-list" >
                    <li><?= str_replace('USD', $default_currency, lang('ccr_a'));?></li>
                    <li><?= str_replace('USD', $default_currency, lang('ccr_b'));?></li>
                    <li><?= str_replace('USD', $default_currency, lang('ccr_c'));?></li>
                    <li><?= str_replace('USD', $default_currency, lang('ccr_d'));?></li>
                    <li><?= str_replace('USD', $default_currency, lang('ccr_e'));?></li>
                    <li><?= str_replace('USD', $default_currency, lang('ccr_f'));?></li>
                    <p><?=lang('ccr_legend_1');?></p>
                    <p><?= str_replace('USD', $default_currency, lang('ccr_legend_2'));?></p>
                </ol>

                <li><?= lang('ccr_i5');?></li>
                <li><?= lang('ccr_i6');?></li>
            </ol>
            <li class="tabcontest-title"><?= lang('ccr_ii');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_ii1');?></li>
                <li><?= lang('ccr_ii2');?></li>
                <li><?= lang('ccr_ii3');?></li>
                <li><?= lang('ccr_ii4');?></li>
                <li><?= lang('ccr_ii5');?></li>
                <li><?= lang('ccr_ii6');?></li>
                <li><?= lang('ccr_ii7');?></li>
                <li><?= lang('ccr_ii8');?></li>
                <li><?= lang('ccr_ii9');?></li>
            </ol>
            <li class="tabcontest-title"><?= lang('ccr_iii');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_iii1');?></li>
                <li><?= str_replace('USD', $default_currency, lang('ccr_iii2'));?></li>
                <li><?= lang('ccr_iii3');?></li>
                <li><?= lang('ccr_iii4');?></li>
                <li><?= lang('ccr_iii5');?></li>
                <li><?= lang('ccr_iii6');?></li>
                <li><?= lang('ccr_iii7');?></li>
                <li><?= lang('ccr_iii8');?></li>
                <li><?= lang('ccr_iii9');?></li>
                <li><?= lang('ccr_iii10');?></li>
                <li><?= lang('ccr_iii11');?></li>
            </ol>
            <li class="tabcontest-title"><?= lang('ccr_iv');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_iv1');?></li>
                <li><?= lang('ccr_iv2');?></li>
                <li><?= lang('ccr_iv3');?></li>
                <li><?= lang('ccr_iv4');?></li>
            </ol>
            <li class="tabcontest-title"><?= lang('ccr_v');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_v1');?></li>
                <li><?= lang('ccr_v2');?></li>
                <li><?= lang('ccr_v3');?></li>
                <li><?= lang('ccr_v4');?></li>
                <li><?= lang('ccr_v5');?></li>
                <li><?= lang('ccr_v6');?></li>
                <li><?= lang('ccr_v7');?></li>
                <li><?= lang('ccr_v8');?></li>
            </ol>
            <li class="tabcontest-title"><?= lang('ccr_vi');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_vi1');?></li>
                <li><?= lang('ccr_vi2');?></li>
                <li><?= lang('ccr_vi3');?></li>
                <li><?= lang('ccr_vi4');?></li>
                <li><?= lang('ccr_vi5');?></li>
                <li><?= lang('ccr_vi6');?></li>
            </ol>
            <li class="tabcontest-title"><?= lang('ccr_vii');?></li>
            <ol class="simple-list ext-arabic-simple-list">
                <li><?= lang('ccr_vii1');?></li>
                <li><?= lang('ccr_vii2');?></li>
                <li><?= lang('ccr_vii3');?></li>
            </ol>
        </ol>
    </div>
    <div class="container">
        <?php echo $registration_link ?>
    </div>
</div>


<?php if(FXPP::html_url()=='sa' and IPLOC::Office_and_Vpn()){?>
    <style type="text/css">

        .ext-arabic-simple-list {
            margin-left:0!important;
            margin-right:3em!important;
        }

        .ext-arabic-simple-list li {
            border-left:0!important;
            border-right:2px solid #CCCCCC;
            padding-left: 0!important;
            padding-right: 0.5em;
        }

        .ext-arabic-simple-list > li:before {
            right:-1em;
            left:0!important;
        }

        .ext-arabic-boxes-list {
            margin-left:0!important;
            margin-right:2em!important;
        }

        .ext-arabic-boxes-list li {
            border-right:0!important;
        }

        .ext-arabic-boxes-list > li:before , .ext-arabic-circles-list > li:before {
            right:-1.3em;
        }

        .ext-arabic-circles-list li {
            padding-left:0!important;
            padding-right:1em!important;
        }

        .ext-arabic-contest-page-top-holder #showdiv3 , .ext-arabic-onright label , .ext-arabic-onright .btn-group {
            float:left!important;
        }

        .ext-arabic-contest-page-top-holder , .ext-arabic-contest-page-top-holder #showdiv1 , .ext-arabic-ranking-place , .ext-arabic-normalfont , .ext-arabic-showing-entries {
            float:right!important;
        }

        .ext-arabic-contest-page-container , .ext-arabic-tabcpntest2 , .ext-arabic-tabcontest {
            direction:rtl;
        }

        .ext-arabic-table-responsive {
            direction:rtl;
        }

        .ext-arabic-table-responsive tr td:nth-child(3) , .ext-arabic-responsive-winners thead th {
            text-align:right!important;
        }

        .ext-arabic-onright-buttons {
            padding:0!important;
        }

        .contest-page-container{
            background: url('../images/header3.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            width:100%;
            height: 578px;
        }
        .contest-page-top-holder{
            margin-top: 16%;

        }
        .contest-page-border{
            background-color:transparent;
            width:65%;
            margin-top: 2.5%;
            padding:5px 5px;
            border:8px solid rgba(255,255,255,0.6);
            border-radius: 0px;
        }
        .contest-page-title{
            display:block;
            background-color: rgba(255,255,255,0.6);
            color:#000000;
            max-width:100%;
            margin-top: 2.5%;
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 0px !important;
            padding-right: 0px !important;
            margin: 0 auto;
            overflow: hidden;
        }
        .contest-page-title h1{
            font-family: 'Great Vibes';
            font-size: 80px;
            font-weight: 500;
            text-align: center;
            padding-left: 50px;
            line-height: 65px;
        }
        .contest-page-title h2{
            font-family: 'Open Sans';
            font-size: 50px;
            font-weight: 700;
            text-align: center;
            padding-left: 50px;
            line-height: 35px;
        }
        .btn-ranking{
            font-size: 20px;
            color:#29a643;
            font-weight: 400;
            min-width:260px;
            background-color: #fff;
            border-radius: 0px;
            border:1px solid #29a643;
            float:right;
            padding:10px 10px;
        }
        .btn-winners{
            font-size: 20px;
            color:#29a643;
            font-weight: 400;
            min-width:260px;
            background-color: #fff;
            border-radius: 0px;
            border:1px solid #29a643;
            margin:0 auto;
            padding:10px 10px;
        }

        .btn-rules{
            font-size: 20px;
            color:#29a643;
            font-weight: 400;
            min-width:260px;
            background-color: #fff;
            border-radius: 0px;
            border:1px solid #29a643;
            float:left;
            padding:10px 10px;
        }
        .btn-register{
            font-size: 20px;
            color:#fff;
            font-weight: 400;
            min-width:260px;
            padding:15px 15px;
            background-color: #29a643;
            border-radius: 0px;
            border:1px solid #29a643;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .btn-view-contest{
            font-size: 16px;
            color:#fff;
            font-weight: 400;
            min-width:220px;
            padding:10px 10px;
            background-color: #2988ca;
            border-radius: 0px;
            border:1px solid #2988ca;
        }
        .prizes-container{
            background-color: #fbfbfb;
        }
        .contest-prizes-container{
            background: url('../images/prizenew.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            width:100%;
            height: 312px;
        }
        .prizes-desc{
            background-color: #29a643;
            text-align: center;
            margin-left: 3px;
            margin-right: 3px;
        }
        .prizes-desc h4{
            font-family: 'Open Sans' sans-serif;
            font-size: 14px;
            color:#fff;
            padding:7px 0px;
            font-weight: 500;
        }
        .top-titleprizes{
            margin-top:10px !important;
            margin-bottom: 15px !important;
        }
        .table-borderless td,
        .table-borderless th {
            border: 0 !important;
        }
        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #f3f3f3;
        }
        tbody, th{
            font-size: 14px;
        }
        .no-margin{
            margin: 0;
        }
        .no-padding{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .no-border{
            border: 1px solid transparent !important;
        }
        .center{
            margin:0 auto;
        }
        .onright{
            text-align: right !important;
        }
        .tabcontest{
            display: none;
            padding-bottom: 15px;
            border-bottom: 1px solid red;
            line-height: 2em;
        }
        .tabcontest2{
            display: none;
            padding-bottom: 15px;
            border-top: 1px solid red;
            line-height: 2em;
            margin-top: 15px;
        }
        .tabcontest-title{
            color:#2988ca;
            font-weight: 700;
        }
        .normalfont{
            font-weight: normal !important;
        }
        .inputbox{
            padding:5px 5px;
            min-width:75px;
            text-align: center;
            border-radius: 4px;
            border: 1px solid #dadada;
        }
        ol.circles-list {
            list-style-type: none;
            list-style-type: decimal !ie;
            margin: 0;
            margin-left: 4em;
            padding: 0;
            counter-reset: li-counter;
        }
        ol.circles-list > li{
            position: relative;
            margin-bottom: 10px;
            padding-left: 0.5em;
            min-height: 2em;
        }
        ol.circles-list > li:before {
            position: absolute;
            top: 0;
            left: -1.33em;
            width: 1.5em;
            height: 1.5em;
            font-size: 1.5em;
            line-height: 1.2;
            text-align: center;
            color: #f5f5f5;
            border: 3px solid #c5c5c5;
            border-radius: 50%;
            background-color: #2988ca;
            content: counter(li-counter, upper-roman);
            counter-increment: li-counter;
        }
        ol.simple-list {
            list-style-type: none;
            list-style-type: decimal !ie;
            margin: 0;
            margin-left: 3em;
            padding: 0;
            counter-reset: section;
        }
        ol.simple-list > li{
            position: relative;
            margin-bottom: 20px;
            padding-left: 0.5em;
            min-height: 2em;
            border-left: 2px solid #CCCCCC;
        }
        ol.simple-list > li:before {
            position: absolute;
            top: 0;
            left: -1em;
            width: 0.8em;
            font-size: 1.5em;
            line-height: 1;
            font-weight: bold;
            text-align: right;
            color: #2988ca;
            content: counter(section);
            counter-increment: section;
        }
        ol.boxes-list {
            list-style-type: none;
            list-style-type: decimal !ie;
            margin: 0;
            margin-left: 2em;
            padding: 0;
            counter-reset: li-counter;
        }
        ol.boxes-list > li{
            position: relative;
            margin-bottom: 10px;
            padding: 0.5em;
            background-color: rgba(171,177,181,0.4);
        }
        ol.boxes-list > li:before {
            position: absolute;
            top: 0;
            left: -1.3em;
            width: 1.3em;
            height: 1.4em;
            font-size: 1.2em;
            line-height: 1.2;
            text-align: center;
            color: #f5f5f5;
            background-color:#2988ca;
            content: counter(li-counter, lower-roman);
            counter-increment: li-counter;
        }

        @media (max-width: 992px){

            .contest-page-container{
                background: url('../images/header3.jpg');
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                width:100%;
                height: 400px;
            }
            .contest-page-border{
                background-color:transparent;
                width:65%;
                margin-top: 2.5%;
                padding:5px 5px;
                border:8px solid rgba(255,255,255,0.6);
                border-radius: 0px;
            }
            .contest-page-title h1{
                font-family: 'Great Vibes';
                font-size: 50px;
                font-weight: 500;
                text-align: center;
                padding-left: 20px;
                line-height: 35px;
            }
            .contest-page-title h2{
                font-family: 'Oswald';
                font-size: 40px;
                font-weight: 700;
                text-align: center;
                padding-left: 20px;
                line-height: 35px;
            }
            .btn-ranking{
                font-size: 16px;
                color:#29a643;
                font-weight: 400;
                min-width:220px;
                background-color: #fff;
                border-radius: 0px;
                border:1px solid #29a643;
                float:none;
                padding:5px 5px;
            }
            .btn-winners{
                font-size: 16px;
                color:#29a643;
                font-weight: 400;
                min-width:220px;
                background-color: #fff;
                border-radius: 0px;
                border:1px solid #29a643;
                margin:0 auto;
                padding:5px 5px;
            }
            .btn-rules{
                font-size: 16px;
                color:#29a643;
                font-weight: 400;
                min-width:220px;
                background-color: #fff;
                border-radius: 0px;
                border:1px solid #29a643;
                float:none;
                padding:5px 5px;
            }
            .btn-register{
                font-size: 18px;
                color:#fff;
                font-weight: 400;
                min-width:220px;
                padding:10px 10px;
                background-color: #29a643;
                border-radius: 0px;
                border:1px solid #29a643;
            }
            .contest-prizes-container{
                background: url('../images/prizenew.jpg');
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                width:100%;
                height: 250px;
            }
            .prizes-desc h4{
                font-family: 'Open Sans' sans-serif;
                font-size: 12px;
                color:#fff;
                padding:6px 15px;
                font-weight: 500;
            }
        }
        @media (max-width: 767px){
            .contest-page-container{
                background: url('../images/header3.jpg');
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                width:100%;
                height: 440px;
            }
            .contest-page-border{
                background-color:transparent;
                width:100%;
                margin-top: 5%;
                padding:3px 3px;
                border:6px solid rgba(255,255,255,0.6);
                border-radius: 0px;
            }
            .contest-page-title{
                display:block;
                background-color: rgba(255,255,255,0.6);
                color:#000000;
                margin-top: 5%;
                padding-left: 0px !important;
                padding-right: 0px !important;
                margin:0 auto;
            }
            .contest-page-title h1{
                font-family: 'Great Vibes';
                font-size: 40px;
                font-weight: 500;
                text-align: center;
                padding-left: 0px;
                line-height: 25px;
            }
            .contest-page-title h2{
                font-family: 'Oswald';
                font-size: 30px;
                font-weight: 700;
                text-align: center;
                padding-left: 0px;
                line-height: 25px;
            }
            .contest-page-top-holder{
                margin-top: 10%;
            }
            .btn-ranking{
                font-size: 16px;
                color:#29a643;
                font-weight: 400;
                min-width:220px;
                background-color: #fff;
                border-radius: 0px;
                border:1px solid #29a643;
                float:none;
                padding:5px 0px;
            }
            .btn-winners{
                font-size: 16px;
                color:#29a643;
                font-weight: 400;
                min-width:220px;
                background-color: #fff;
                border-radius: 0px;
                border:1px solid #29a643;
                margin:0 auto;
                margin-top:-16%;
                padding:5px 0px;
            }
            .btn-rules{
                font-size: 16px;
                color:#29a643;
                font-weight: 400;
                min-width:220px;
                background-color: #fff;
                border-radius: 0px;
                border:1px solid #29a643;
                float:none;
                margin-top:-24%;
                padding:5px 0px;
            }
            .btn-register{
                font-size: 18px;
                color:#fff;
                font-weight: 400;
                min-width:220px;
                padding:10px 10px;
                background-color: #29a643;
                border-radius: 0px;
                margin-top:-7%;
                border:1px solid #29a643;
            }
            .contest-prizes-container{
                background: none;
            }
        }
        @media screen and (-webkit-min-device-pixel-ratio: 0) and (min-width: 768px){
            .btns:lang(sa), .btns1:lang(sa){
                margin: 0 0 0 10px!important;
            }
        }
        @media screen and (-webkit-min-device-pixel-ratio: 0) and (max-width: 767px) {
            .btns:lang(sa), .btns1:lang(sa) {
                margin: 10px auto !important;
            }
        }
    </style>
<?php }?>

<script type='text/javascript'>
    $(document).on('click', '#PublicRatings', function (e) {
        $('#PublicRatings a').addClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicWinners', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').addClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicContestRules', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').addClass('active');
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('html, body').animate({
            scrollTop: $('#container_rules').offset().top - 200
        }, 500);

        var div1 = $('.div1'), div3 = $('.div3'), widescreen = $('.wide-screen'), mobscreen = $('.mob-screen');
        $(window).load(function () {
            var width = $(window).width();
            if (width <= 991 && width >= 768) {
                div1.addClass('col-sm-4');
                div1.removeClass('col-sm-3');
                div3.addClass('col-sm-6');
                div3.removeClass('col-sm-4');
                widescreen.hide();
                mobscreen.show();
            } else {
                widescreen.show();
                mobscreen.hide();
            }
        });
        $(window).resize(function () {
            var width = $(window).width();
            if (width <= 991 && width >= 768) {
                div1.addClass('col-sm-4');
                div1.removeClass('col-sm-3');
                div3.addClass('col-sm-6');
                div3.removeClass('col-sm-4');
                widescreen.hide();
                mobscreen.show();
            } else {
                div1.removeClass('col-sm-4');
                div1.addClass('col-sm-3');
                div3.removeClass('col-sm-6');
                div3.addClass('col-sm-4');
                widescreen.show();
                mobscreen.hide();
            }
        });
    });
</script>