<style type="text/css">
    .cyprus{z-index:1!important;left:111px;bottom:49%}.hover-content p{color:#555;font-size:12px;font-family:Open Sans;text-align:center;margin-bottom:0;background:#f0f8ff}.hover-content{top:5px;position:absolute;margin-top:-70px!important;margin-left:-25px;z-index:1000;background:#fff;border:1px solid #eaeaea;background:#fff;background:rgba(255,255,255,0.3);width:200px;padding:5px;background:#f0f8ff!important}.banner-holder{min-height:25px!important;padding-top:20px}.benifits-img{height:auto!important}.col-lg-4.col-sm-6.banner-content{min-height:370px}.slider-ads-item{height:auto!important}.carousel{height:auto!important}..slider-ads{height:auto!important}@media screen and (max-width: 768px){.cyprus{left:96px;bottom:45%}}@media screen and (max-width: 75px){.cyprus{left:43px!important;bottom:30%!important}}@media screen and (max-width: 320px){.benifits-title:lang(jp){font-size:33px}.benifits-holder-home h1{font-size:19px}.home1 > p > span:lang(jp){font-size:14px}}@media screen and (max-width: 481px){.cyprus{bottom:34%!important;left:34px!important}}@media screen and (max-width: 414px){.cyprus{bottom:36%!important;left:34px!important}}@media screen and (max-width: 600px){.cyprus{left:72px;bottom:43%}}@media screen and (max-width: 800px){.cyprus{left:11%;bottom:44%}}.home1{margin-bottom:80px!important}.btn-holder2 a:lang(sa){padding:20px 38px!important}.open-text:lang(ru){margin-top:50px!important}.open-text:lang(es),.open-text:lang(id),.open-text:lang(de),.open-text:lang(fr),.open-text:lang(it),.open-text:lang(pt),.open-text:lang(bg),.open-text:lang(sa),.open-text:lang(jp){margin-top:40px!important}
    @media screen and (-webkit-min-device-pixel-ratio:0) and (max-width: 767px){
        .sa-mid-adj:lang(sa){padding-bottom: 40px!important;text-align: right;}
        .ext-arabic-banner-content:lang(sa) {
            margin-top: 20px!important;
        }
        .home1:lang(sa) {
            margin-bottom: 0px!important;
        }
        .col-lg-4.col-sm-6.banner-content:lang(sa) {
            min-height: 0px!important;
        }
    }
    @media screen and (-webkit-min-device-pixel-ratio:0) and (max-width: 309px){
        .btn-holder1 a:lang(sa) {
            padding: 19px 40px!important;
        }
    }
    @-moz-document url-prefix() {
        @media screen and (max-width: 767px){
            .sa-mid-adj:lang(sa){padding-bottom: 40px!important;text-align: right;}
            .ext-arabic-banner-content:lang(sa) {
                margin-top: 20px!important;
            }
            .home1:lang(sa) {
                margin-bottom: 0px!important;
            }
            .col-lg-4.col-sm-6.banner-content:lang(sa) {
                min-height: 0px!important;
            }
        }
        @media screen and (max-width: 309px){
            .btn-holder1 a:lang(sa) {
                padding: 19px 40px!important;
            }
        }
    }
    @media screen and (max-width: 320px) {
        .sa-bul_lst:lang(sa) {
            float: right;
            width: 80%;
        }

        .sa-vps-check:lang(sa) {
            float: right;
            width: 20px;
            margin: 1px 10px 0 7px;
        }

        .sa-mb-home:lang(sa) {
            margin-bottom: 100px;
        }
    }
</style>
<script type="text/javascript">
    var language = '<?=FXPP::html_url()?>';
    $(document).ready(function(){
        str = language.replace(/\s/g, '');
        if (str === 'ru'){
            $(".home1").removeClass("col-lg-4");
            $(".home1").addClass("col-lg-6");
            $(".home2").removeClass("col-lg-8");
            $(".home2").addClass("col-lg-6");
        }
    });
</script>
<div class="banner-holder ext-arabic-banner-holder">
    <div class="container">
        <div class="row banner-content-holder">
            <div class="home1 col-lg-4 col-sm-6 banner-content ext-arabic-banner-content" lang="<?= FXPP::html_url();?>">
                <h1 class="banner-title sa-right" lang="<?= FXPP::html_url();?>">
                    <?=lang('x_hm_h-0')?>
                </h1>
                <p class="banner-text ext-arabic-banner-text sa-right sa-mb-home">
                    <i class="fa fa-check feat-check sa-vps-check"></i>
                    <span class="sa-bul_lst"><?=lang('x_hm_p_i0')?></span>
                    <br>
                    <i class="fa fa-check feat-check sa-vps-check"></i>
                    <span class="sa-bul_lst"> <?=lang('x_hm_p_i1')?></span>
                </p>
                <div class="btn-holder2 ext-arabic-btn-main-holder sa-right">
                    <a href="<?php echo FXPP::loc_url('register/demo')?>">
                        <?=lang('x_hm_d_0')?>
                    </a>
                </div>
                <p class="open-text ext-arabic-open-text sa-mid-adj">
                    <?=lang('x_hm_p_s0')?>
                </p>
                <div class="btn-holder1 ext-arabic-btn-main-holder sa-right">
                    <a  hreflang="<?= FXPP::html_url();?>" lang="<?= FXPP::html_url();?>" href="<?php echo FXPP::loc_url('register')?>">
                        <?=lang('x_hm_d-a0')?>
                    </a>
                </div>
            </div>
            <div class="home2 col-lg-8 col-sm-6 banner-img-holder ext-arabic-banner-img-holder">
                <img  alt=""  src="<?= $this->template->Images()?>banner-img.png" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div style="clear: both;">
</div>

<!--NEWS ROW START    -->
<div class="news-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="news">
                    <?=lang('hm_p0_0')?>
                    <cite>
                        <?=lang('hm_p0_1')?>
                    </cite>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="cont1-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 ext-arabic-forex-major-holder">
                <div class="forex-major-holder">
                    <ul class="forex-tabs">
                        <li class="line active"><a style="border-bottom: solid;">
                                <?=lang('hm_4');?>
                            </a></li>
                    </ul>
                    <div class="clearfix"></div>

                    <div class="tab-content">
                        <div  role="tabpanel" class="tab-pane active forex-major" id="major">
                            <div class="table-responsive">
                                <table class="table table-condensed fx-table" id="tb-forex-major" style="margin-bottom: 0;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="symbol_EURUSD">
                                        <td class="symbol">EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <!-- <td class="change">61.2</td> -->
                                    </tr>
                                    <tr id="symbol_GBPUSD">
                                        <td class="symbol">GBPUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <!--<td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_USDJPY">
                                        <td class="symbol">USDJPY</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <!--<td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_USDCHF">
                                        <td class="symbol">USDCHF</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <!--<td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_USDCAD">
                                        <td class="symbol">USDCAD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                       <!-- <td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_EURJPY">
                                        <td class="symbol">EURJPY</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                       <!-- <td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_EURCHF">
                                        <td class="symbol">EURCHF</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                      <!--  <td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_GBPJPY">
                                        <td class="symbol">GBPJPY</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                      <!--  <td class="change">61.2</td>-->
                                    </tr>
                                    <tr id="symbol_GBPCHF">
                                        <td class="symbol">GBPCHF</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td class="bid">1.12454</td>
                                        <td class="ask">1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                       <!-- <td class="change">61.2</td>-->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div  role="tabpanel" class="tab-pane forex-major" id="forex">
                            <h1 class="tabscont-title">Forex</h1>
                            <div class="table-responsive">
                                <table class="table table-condensed" style="margin-bottom: 0;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div  role="tabpanel" class="tab-pane forex-major" id="metals">
                            <h1 class="tabscont-title">Metals</h1>
                            <div class="table-responsive">
                                <table class="table table-condensed" style="margin-bottom: 0;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div  role="tabpanel" class="tab-pane forex-major" id="shares">
                            <h1 class="tabscont-title">Shares</h1>
                            <div class="table-responsive">
                                <table class="table table-condensed" style="margin-bottom: 0;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div  role="tabpanel" class="tab-pane forex-major" id="futures">
                            <h1 class="tabscont-title">Futures</h1>
                            <div class="table-responsive">
                                <table class="table table-condensed" style="margin-bottom: 0;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"><?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    <tr>
                                        <td>EURUSD</td>
                                        <td><button class="btn-buy"> <?=lang('hm_0');?></button></td>
                                        <td>1.12454</td>
                                        <td>1.12470</td>
                                        <td><button class="btn-sell"> <?=lang('hm_1');?></button></td>
                                        <td>61.2</td>
                                        <td>(0.54%)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" >
                <div id="carousel-example-generic" class="carousel slide slider-ads ext-arabic-slider-ads" data-ride="carousel">
                    <!-- Indicators -->
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item slider-ads-item active ext-arabic-slider-ads-item first-ads-item">
                            <div class="slider-ads-caption ext-arabic-slider-abs-caption">
                                <h3>
                                    <?=lang('hm_n01');?>
<!--                                    Moneyfall Contest-->
                                </h3>
                            </div>
                            <p>
                                <?=lang('hm_n02');?>
<!--                                Prove your trading prowess. Join Money Fall contest now.-->
                            </p>
                            <img  alt=""  src="<?= $this->template->Images()?>moneyfall-img.png" class="img-responsive mtr-img">
                            <a class="participate-button" href="<?php echo FXPP::loc_url('money-fall') ?>">
                                <?=lang('hm_n03');?>
<!--                                Participate Now!-->
                            </a>
                        </div>
                        <div class="item slider-ads-item ext-arabic-slider-ads-item second-ads-item">
                            <div class="slider-ads-caption ext-arabic-slider-abs-caption">
                                <h3><?=lang('hm_2')?></h3>
                            </div>
                            <img  alt=""  src="<?= $this->template->Images()?>mt4-img.png" class="img-responsive mtr-img">
                            <p><?=lang('h_mt4desc')?></p>
                        </div>
                    </div>
                    <!-- Controls -->
                    <?php if(FXPP::lang_dir()=='rtl'){ ?>
                        <a class="right carousel-control slider-ads-right" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-left"></span>

                        </a>
                        <a class="left carousel-control slider-ads-left" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    <?php }else{ ?>
                        <a class="left carousel-control slider-ads-left" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control slider-ads-right" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    <?php } ?>

                </div>
                <!--
                <div class="platform-holder">
                    <h1>
                        <?=lang('hm_2')?>
                    </h1>
                    <div class="mt4img-holder">
                        <img  alt=""  src="<?= $this->template->Images()?>mt4-img.png" class="img-responsive mtr-img">
                        <p>
                            <?=lang('h_mt4desc')?>
                        </p>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
</div>


    <div class="cont2-holder">
        <div class="container">
            <div class="row">
                <h1 class="benifits-title">
                    <?= lang('x_hm0_h0');?>

                </h1>
                <div class="col-lg-4 col-md-4 col-sm-4 ext-arabic-benifits-holder"  >
                    <div class="benifits-holder-home">
                        <h1>
                            <?= lang('x_hm0_h01');?>
                        </h1>
                        <div class="benifits-img">
                            <img  alt=""  src="<?= $this->template->Images()?>home/benefit1.png" class="img-reponsive"/>
                        </div>
                        <p>
                          <?= lang('x_hm0_p01');?>
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4  ext-arabic-benifits-holder">
                    <div class="benifits-holder-home">
                        <h1>
                            <?= lang('x_hm0_h02');?>
                        </h1>
                        <div class="benifits-img">
                            <img  alt=""  src="<?= $this->template->Images()?>home/benefit2.png" class="img-reponsive"/>
                        </div>
                        <p>
                            <?= lang('x_hm0_p02');?>
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 ext-arabic-benifits-holder">
                    <div class="benifits-holder-home">
                        <h1>
                            <?= lang('x_hm0_h03');?>
                        </h1>
                        <div class="benifits-img">
                            <img  alt=""  src="<?= $this->template->Images()?>home/benefit3.png" class="img-reponsive"/>
                        </div>
                        <p>
                            <?= lang('x_hm0_p03');?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="feats-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 w-map ext-arabic-w-map">
                    <h1 class="map-title mobile-map-title">
                        <?=lang('hm_3');?>
                    </h1>
                    <img  src="<?= $this->template->Images()?>home/wm.png" alt="map" class="img-responsive" class="map" style="margin:0 auto!important;">
                    <div class="cyprus ext-arabic-cyprus" id="indonesia">
                        <div id="cyprus-holder" class="hover-holder">
                            <div class="hover-content"><p>
                                    <?=lang('hm_hover');?>
<!--                                    Cyprus is a member of EU. All Cyprus companies are under MiFID regulation.-->
                                </p></div>
                            <img  alt=""  src="<?= $this->template->Images()?>home/contact-eu-flag.png" width="150">
                        </div>
                        <a id="cy" href="#" class="cy">
                            <img  alt=""  src="<?= $this->template->Images()?>home/cyprus-pin.png" width="50" class="img-tooltip">
                        </a>
                        <p>Cyprus</p>
                    </div>
                </div>

                <?= $this->load->ext_view('modal', 'PaymentSystemCarousel', '', TRUE); ?>

            </div>
        </div>
    </div>

<style type="text/css">
    .top-20{margin-top:20px}.btn-real{background:none;border:1px solid #29a643;color:#29a643;width:100%;padding:7px 0;transition:all ease .3s}.btn-real:hover{background:#29a643;color:#fff}.btn-demo{background:none;border:1px solid #2988ca;color:#2988ca;width:100%;padding:7px 0;transition:all ease .3s}.btn-demo:hover{background:#2988ca;color:#fff}.mtr-img{position:relative!important;height:auto!important}#carousel-example-generic{box-shadow:none!important}
</style>
<script type="text/javascript">
    $(function() {
        $('#cy').hover(function() {
            $('#cyprus-holder').fadeIn("fast");
        }, function() {
            $('#cyprus-holder').fadeOut("fast");
        });
    });
</script>
<script type="text/javascript">
    var needQuotes = ["EURUSD", "GBPUSD", "USDJPY", "USDCHF", "USDCAD", "EURJPY", "EURCHF", "GBPJPY", "GBPCHF"];
    var pblc = [];
    var prvt = [];
    pblc['request'] = null;
    var site_url="<?= FXPP::ajax_url(); ?>";
    $(document).ready(function(){
        var forexQuotes = function() {

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + 'quotes/getQuotes',
                method: 'POST',
                data: prvt["data"]
            });
            pblc['request'].done(function( result ) {
//                console.log(result);
//                var json = JSON.parse(result);
//                jQuery.each( json, function(i, wdwadwa ) {
                jQuery.each( result, function(i, wdwadwa ) {
                    var bid = getPrice(parseFloat(wdwadwa.bid), wdwadwa.digits);
                    var ask = getPrice(parseFloat(wdwadwa.ask), wdwadwa.digits);
                    var symbol = "#symbol_" + wdwadwa.symbol;
                    $(symbol + " td.symbol").html(wdwadwa.symbol);
                    $(symbol + " td.bid").html(bid);
                    $(symbol + " td.ask").html(ask);
                    $(symbol + " td.change").html(wdwadwa.change);
                });
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {

            });
        };
        forexQuotes();
        setInterval(function () {forexQuotes()}, 3000);
    });
//    $(document).ready(function() {
//        forexQuotes();
//        setInterval(function () {forexQuotes()}, 5000);
//    });
//    function forexQuotes(){
//        $.post( 'index.php?/quotes/getForexQuotes', function(result){
//            var json = JSON.parse(result);
//            jQuery.each( json, function(i, wdwadwa ) {
//                var bid = getPrice(parseFloat(wdwadwa.bid), wdwadwa.digits);
//                var ask = getPrice(parseFloat(wdwadwa.ask), wdwadwa.digits);
//                var symbol = "#symbol_" + wdwadwa.symbol;
//                $(symbol + " td.symbol").html(wdwadwa.symbol);
//                $(symbol + " td.bid").html(bid);
//                $(symbol + " td.ask").html(ask);
//                $(symbol + " td.change").html(wdwadwa.change);
//            });
//        });
//    }
    function getPrice(val, digits){return retVal = (val.toFixed(digits)).toString();}
</script>