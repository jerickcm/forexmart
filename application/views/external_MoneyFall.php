<?php $this->lang->load('datatable');?>
<style>
    .btn-contest-reg{
        padding: 19px 33px;
    }
    a.btn-contest-reg:hover{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-contest-reg:link{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-contest-reg:visited{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-contest-reg:active{
        color: #FFF;
        text-decoration: none;
    }

    .ab:hover{

        text-decoration: none;
    }
    .ab:link{

        text-decoration: none;
    }
    .ab:visited{

        text-decoration: none;
    }


    .ab:active{
        text-decoration: none;
    }

    .mob-screen {
        display: none;
    }

    .btn-contest:lang(bg) {
        width: 218px!important;
    }
    @-moz-document url-prefix() {

        @media screen and (min-width: 1018px) and (max-width: 1800px){
            .clmn1{
                width:20%
            }
            .clmn2{
                width:20%
            }
            .clmn3{
                width:30%
            }

            .clmn1:lang(fr){
                width:20%
            }
            .clmn2:lang(fr){
                width:20%
            }
            .clmn3:lang(fr){
                width:30%
            }

        }
        @media screen and (max-width: 1017px){
            .clmn1{
                width:100%
            }
            .clmn2{
                width:100%
            }
            .clmn3{
                width:100%
            }
            .clmn1:lang(fr){
                width:100%
            }
            .clmn2:lang(fr){
                width:100%
            }
            .clmn3:lang(fr){
                width:100%
            }
        }
        .main-specs-content{
            margin: 0 14px;
            margin-top: 4px;
            display: table;
        }
        .btn-contest-reg{
            padding: 4px 33px;
            margin-bottom: 25px;
        }

        .btn-contest:lang(id){
            padding: 7px 2px !important;
        }
        @media screen and (min-width: 750px) and (max-width: 966px){
            .btn-contest-reg{
                margin-top: 32px!important;
            }
        }

    }
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        @media screen and (min-width: 999px) and (max-width: 100%) {
            .clmn1 {
                width: 20%;
                padding: 0px;
            }

            .clmn2 {
                width: 20%;
            padding: 0px;
            }

            .clmn3 {
                width: 30%;
            padding: 0px;
            }
        }
        @media screen and (max-width: 998px){
            .clmn3 {
                width: 100%;
                padding: 0px;
            }
            .clmn1 {
                padding: 0px;
            }
            .clmn2 {
                padding: 0px;
            }
        }
        @media screen and (min-width: 995px) and (max-width: 1194px){
            .btn-contest-reg{
                margin-top: 131px!important;
            }
        }


    }
    @media screen and (-webkit-min-device-pixel-ratio:0) and (min-width: 998px) and (max-width: 4000px) {
        .clmn3{
            padding: 0!important;
            width: 30%;
        }
        .clmn2{
            padding: 0!important;
            width: 20%;
        }
        .clmn1{
            padding: 0!important;
            width: 20%;
        }
    }
    .my6th:lang(fr){
        font-size: 14px;

      }
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        .ccr:lang(id){
            font-size: 13px;
            padding: 8px 20px;
        }
    }
    @media screen and (max-width: 1199px) {
        .contest-btn-holder:lang(bg) {
            margin-top: 0!important;
            text-align: center;
        }
    }
    @media screen and (max-width: 671px) {
        .btn-contest:lang(bg) {
            float: none!important;
            margin: 5px auto;
            display: block!important;
        }
    }
    @media screen and (max-width: 350px) {
        .pagination > li > a, .pagination > li > span {
            padding: 6px 8px !important;
        }
    }
</style>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">


                <div class="row">
                    <h1 class="license-title col-sm-6 ext-arabic-license-title ext-arabic-contest-title">
                        <?= lang('cmf_h1_0');?>
                    </h1>
                    <div class="contest-btn-holder col-sm-6 ext-arabic-contest-btn-holder">
                        <a href="<?=FXPP::loc_url('contest/ratings')?>" class="btn-contest">
                            <?= lang('cmf_ranking');?>
                        </a>
                        <a href="<?=FXPP::loc_url('contest/winners')?>" class="btn-contest">
                            <?= lang('cmf_winners');?>
                        </a>
                        <a href="<?=FXPP::loc_url('contest/contestrules')?>" class="ccr btn-contest">
                            <?= lang('cmf_contestrules');?>
                        </a>
                    </div>
                </div>


                <div class="contest-img-holder">
                    <div class="contest-img">
                        <img src="<?= $this->template->Images()?><?= (FXPP::html_url()=='sa')? "money-contest-sa.png":"money-contest.png";?>" class="img-responsive">
                    </div>
                    <div class="prizes-holder row">
                        <div class="col-sm-12 wide-screen">
                            <div class="col-sm-3 div1 clmn1">
                                <ul class="prizes">
                                    <li><?=lang('cmf_1');?> - <span>650 <?=$default_currency ?></span> </li>
                                    <li><?=lang('cmf_2');?>- <span>500 <?=$default_currency ?></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-3 div2 clmn2">
                                <ul class="prizes"><li><?=lang('cmf_3');?> - <span>300 <?=$default_currency ?></span></li>
                                    <li><?= lang('cmf_4');?>- <span>200 <?=$default_currency ?></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 div3 clmn3">
                                <ul class="prizes">
                                    <li><?= lang('cmf_5');?>- <span>100 <?=$default_currency ?></span></li>
                                    <li><?= lang('cmf_6');?>- <span>50 <?=$default_currency ?></span> </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-12 mob-screen">
                            <div class="col-sm-3 div1 clmn1">
                                <ul class="prizes">
                                    <li><?=lang('cmf_1');?> - <span>650 <?=$default_currency ?></span> </li>
                                    <li><?=lang('cmf_2');?>- <span>500 <?=$default_currency ?></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 div3 clmn2">
                                <ul class="prizes">
                                    <li><?= lang('cmf_5');?>- <span>100 <?=$default_currency ?></span></li>
                                    <li><?= lang('cmf_6');?>- <span>50 <?=$default_currency ?></span> </li>
                                </ul>
                            </div>
                            <div class="col-sm-3 div2 clmn3">
                                <ul class="prizes">
                                    <li><?=lang('cmf_3');?> - <span>300 <?=$default_currency ?></span></li>
                                    <li class="my6th"><?= lang('cmf_4');?>- <span>200 <?=$default_currency ?></span></li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-sm-12 main-specs-content">
                            <h1 class="spec-title">
                                <?= lang('cmf_h1_1');?>
                            </h1>
                            <ul class="specs">
                                <li>
                                    <i>
                                        <?= lang('cmf_li_00');?>:
                                    </i>
                                    <span>
                                        <?= lang('cmf_li_01');?>
                                    </span>
                                </li>
                                <li><i>
                                        <?= lang('cmf_li_10');?>:
                                    </i> <span>
                                        <?= lang('cmf_li_11');?>
                                    </span></li>
                                <li><i>
                                        <?= lang('cmf_li_20');?>:
                                    </i> <span>
                                        <?= lang('cmf_li_21');?>
                                    </span></li>
                                <li><i>
                                        <?= lang('cmf_li_30');?>:
                                    </i> <span>
                                        <?= lang('cmf_li_31');?>
                                    </span></li>
                                <li><i>
                                        <?= lang('cmf_li_40');?>:
                                    </i> <span>
                                        <?= lang('cmf_li_41');?>
                                    </span></li>
                            </ul>

                            <a href="<?=FXPP::loc_url('money-fall-registration')?>" class="ab"><button class="btn-contest-reg">
                                    <?= lang('cmf_a_0');?>
                                </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <h1 class="license-title">

                </h1>
            </div>
            <div class="col-sm-3 btn-srch-holder">

            </div>
            <div class="col-sm-4 btn-srch-holder">
                <div class="form-group">

                </div>
            </div>
            <div class="clearfix"></div>

                <div class="col-lg-12">
                    <p>
                       <?=lang('cmf_new_01_0');?>
                       <?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday this week")))->format(' F j, Y');?>
                       <?=lang('cmf_new_01_1');?>
                       <?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday this week")))->format(' F j, Y');?>.
                    </p>
                    <p>
                        <?=lang('cmf_new_01_2');?>
                        <?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday next week ")))->format(' F j, Y');?>
                        <?=lang('cmf_new_01_3');?>
                        <?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday next week")))->format(' F j, Y');?>
                        <?=lang('cmf_new_01_4');?>
                    </p>
                    <p>
                        <?=lang('cmf_new_02');?>
                    </p>
                    <p>
                        <?=lang('cmf_new_03');?>
                    </p>
                </div>


            <div class="col-lg-12">
                <?=$tab;?>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane" id="tab1">

                        <p>
                            <?=lang('cmf_new_04');?>.
                        </p>

                        <div class="table-responsive">
                            <table id="rankings" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <?=lang('AccountNumber');?>
                                    </th>
                                    <th>
                                        <?=lang('x_mf1');?>
                                    </th>
                                    <th>
                                        <?=lang('x_mf2');?>
                                    </th>
                                    <th>
                                        <?=lang('x_mf3');?>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  if(isset($rating)){

                                    if(count($rating)){
                                        foreach($rating as $key => $value) {
                                            echo '<tr>';
                                            echo '<td>'.$value['account_number'].'<a target="_blank" href="'.$this->config->item('domain-www').'/'.'contest-monitoring?trader='.$value['account_number'].'" class="chart"><i class="fa fa-line-chart chart"></i></a></td>';
                                            echo '<td>'.$value['NickName'].'</td>';
                                            echo '<td>'.$value['amount'].'</td>';
                                            echo '<td>'.$value['rank'].'</td>';
                                            echo '</tr>';
                                        }
                                        unset($data);
                                    }else{
                                        echo '<tr><td colspan="4" class="center">'. lang('norecy') .'</td></tr>';
                                    }
                                }?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>


    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
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

<script>
    $(document).ready(function() {
        // limit datatable pagination
        $.fn.dataTable.ext.pager.numbers_length = 5;
        $("#rankings").DataTable({
            "order": [[ 3, "asc" ]],
//            stateSave: true,
            language: {
                emptyTable:'<?=lang('dta_tbl_01')?>',
                infoEmpty:'<?=lang('dta_tbl_03')?>',
                lengthMenu: '<?=lang('dta_tbl_07')?>',
                search: '<?=lang('dta_tbl_10')?>:',
                "paginate": {
                    "first":     '<?=lang('dta_tbl_12')?>:',
                    "last":      '<?=lang('dta_tbl_13')?>:',
                    "next":      '<?=lang('dta_tbl_14')?>:',
                    "previous":   '<?=lang('dta_tbl_15')?>:'
                },
            }
        });
    });


</script>