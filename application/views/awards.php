
<link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>external-style.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>new-external-style.css" rel="stylesheet">



<script type="text/javascript">
    $(document).ready(function () {
        $('.page-link').mouseover(function () {
            $($(this).data('target')).fadeIn("fast");

        })
        $('.page-link').mouseleave(function () {
            $($(this).data('target')).fadeOut("fast");
        });

        $(".hidden-menu").hide();
        $(".menu-button").show();

        $('.menu-button').click(function(){
            //$(".hidden-menu").slideToggle();
            //$('.hidden-menu').toggle('slow', function() {
            });
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

<style type="text/css">
    @media only screen and (max-width: 320px){
        .row {
            margin: 0px !important;
        }
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style>.carousel-inner>.item>img{position:relative;top:0;left:0;min-width:0}a:hover{cursor:default}</style>');
    });
</script>
<div class="division-container bg-awards">
    <div class="fmlogo-container">
        <img src="<?= $this->template->Images()?>awards2/bg-awards-fm.png" class="img-responsive" alt="" />
    </div>
    <div style="cursor:default;" class="row awards-mainContainer ">
        <div class="container adjusted-container">
            <div style="cursor:default;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div  class="awardsContainer">
                    <a style="cursor:default;" class="awardLink" data-toggle="modal" data-target="#fx-award2" href="#">
                        <div class="pedestal">
                            <img class="img-responsive fm_award-image grow" src="<?= $this->template->Images()?>awards2/award_item1.png" alt="" />
                        </div>
                    </a>
                </div>
            </div>
            <div style="cursor:default;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="awardsContainer">
                    <a style="cursor:default;" class="awardLink" data-toggle="modal" data-target="#fx-award2" href="#">
                        <div class="pedestal">
                            <img class="img-responsive fm_award-image grow" src="<?= $this->template->Images()?>awards2/award_item2.png" alt="" />
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="awardsContainer">
                    <a  style="cursor:default;" class="awardLink" data-toggle="modal" data-target="#fx-award2" href="#">
                        <div class="pedestal">
                            <img class="img-responsive fm_award-image grow" src="<?= $this->template->Images()?>awards2/award_item3.png" alt="" />
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="awardsContainer">
                    <a style="cursor:default;" class="awardLink" data-toggle="modal" data-target="#fx-award2" href="#">

                        <div class="pedestal">
                            <img class="img-responsive fm_award-image grow" src="<?= $this->template->Images()?>awards2/award_item4.png" alt="" />
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="division-container mobileAward_container">
    <div class="row">
        <div class="col-sm-12 col-xs-12 mobileAward2">
            <div class="mobileAward">
                <div id="award_slider" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators indicator-replace">
                        <li data-target="#award_slider" data-slide-to="0" class="active"></li>
                        <li data-target="#award_slider" data-slide-to="1"></li>
                        <li data-target="#award_slider" data-slide-to="2"></li>
                        <li data-target="#award_slider" data-slide-to="3"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?= $this->template->Images()?>awards2/trophy_1.png" alt="" />
                            <div class="carousel-caption caption-replace">
                                <h3 class="carousel-desc-title">BEST BROKER IN EUROPE 2015</h3>
                                <p>SHOWFX WORLD RECOGNIZED FOREXMART AS BEST BROKER IN EUROPE 2015</p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="<?= $this->template->Images()?>awards2/trophy_2.png" alt="" />
                            <div class="carousel-caption caption-replace">
                                <h3 class="carousel-desc-title">MOST PROSPECTIVE BROKER IN ASIA 2015</h3>
                                <p>SHOWFX WORLD RECOGNIZED FOREXMART AS MOST PROSPECTIVE BROKER IN ASIA 2015</p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="<?= $this->template->Images()?>awards2/trophy_3.png" alt="" />
                            <div class="carousel-caption caption-replace">
                                <h3 class="carousel-desc-title">BEST NEW BROKER EUROPE 2016</h3>
                                <p>INTERNATIONAL FINANCE MAGAZINE</p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="<?= $this->template->Images()?>awards2/trophy_4.png" alt="" />
                            <div class="carousel-caption caption-replace">
                                <h3 class="carousel-desc-title">BEST FOREX NEWCOMER 2016</h3>
                                <p>GLOBAL BUSINESS OUTLOOK</p>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a style="cursor:default;" class="left carousel-control" href="#award_slider"  role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a style="cursor:default;" class="right carousel-control" href="#award_slider" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="division-container bg-awardText-container">

    <div class="container">
        <h2 class="division-title lg-text" style="color:#333;"><?= lang('x_awd_0')?></h2>
        <p class="normal-p-style p-justify"> <?= lang('x_awd_ins1')?><br><br>
<!--            <?= lang('x_awd_ins2')?><br><br>-->
            <?= lang('x_awd_ins3')?><br><br>
            <?= lang('x_awd_ins4')?><br><br>
            <?= lang('x_awd_ins5')?></p>
        <div class="container">
            <?php  echo $DemoAndLiveLinks; ?>
        </div>
    </div>
</div>
    <!--   END OF MODAL -->
    <a href="#0" class="cd-top">Top</a>
    <!-- jQuery -->
    <script src="<?= $this->template->Js()?>jquery.rwdImageMaps.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('img[usemap]').rwdImageMaps();
        });
    </script>


