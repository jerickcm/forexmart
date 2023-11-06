<link href="<?= $this->template->Css()?>jquery.fancybox.css" rel="stylesheet">

<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
</script>
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
            $(".hidden-menu").slideToggle();
        });

    });
</script>
<script type="text/javascript">
    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 95) {
            $('#nav').addClass('nav-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
        }
    });
</script>

<style>
    .nav-fix
    {
        position: fixed;
        top: 0;
        z-index: 9999;
        width: 100%;
        transition: all ease 0.3s;
    }
</style>

<style>
    #owl-demo .item{
        margin: 3px;
        height: 140px!important;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
        margin:0 auto;
        margin-top: 80px;
    }
    .demo{margin-top: 0px !important}
</style>
<div class="news-parent-container">
    <div class="container">
        <div class="news-container-banner">
            <img src="<?= $this->template->Images()?>newsbanner.png" class="img-responsive"/>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="forex-news-left-content">
                <div class="full-news-container">
                    <h1><?php echo $analysis['headline']?></h1>
                    <span><?php echo date('D M j H:i:s e Y', strtotime($analysis['date_created'])) ?> | <?php echo $analysis['publisher'] ?></span>
                    <p>
                        <?php echo $analysis['content'] ?>
                    </p>
                </div>
                <?php if(count($analysis_images) >0){ ?>
                <div class="col-md-12"  style="margin-top: -10px;">
                    <div id="demo" class="demo">
                        <div class="span12">
                            <div id="owl-demo" class="owl-carousel">
                                <?php foreach($analysis_images as $key => $value){ ?>
                                <div class="item">
                                    <a class="fancybox" href="<?= FXPP::loc_url() . 'assets/analysis_images/' . $value['file_name'] ?>" data-fancybox-group="gallery"><img class="lazyOwl" alt="" data-src="<?= FXPP::loc_url() . 'assets/analysis_images/' . $value['file_name']  ?>"></a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 forex-news-right-parent">
            <div class="forex-news-right-content">
                <div class="list-of-other-news">
                    <div class="other-news-header"><h1><?=lang('a_0_5');?></h1></div>
                    <ul>
                        <?php foreach( $other_analysis as $key => $article){ ?>
                            <li>
                                <a href="<?php echo base_url('analysis/article/' . $article['id']) ?>"><?php echo $article['headline'] ?> <span>- <?php echo $article['publisher'] ?></span></a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <div class="vertical-banner">
                    <a href="https://www.forexmart.com/partnership/friend-referrer?x=YOUR_PARTNER_LINK" target="_blank" style="outline: none"><img src="https://www.forexmart.com/assets/images/banners/250x250/250x250_banner3.png" width="250" height="250" alt="Forexmart" border="0" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="feats-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="map-title">Our Location</h1>
                <img src="<?= $this->template->Images()?>home/wm.png" alt="map" class="img-responsive" class="map">

                <div class="cyprus" id="indonesia">
                    <div id="cyprus-holder" class="hover-holder">
                        <div class="hover-content"><p>Cyprus is a member of EU. All Cyprus companies are under MiFID regulation.</p></div>
                        <img src="<?= $this->template->Images()?>home/contact-eu-flag.png" alt="EU Flag" width="150px">
                    </div>
                    <a id="cy" href="#" class="cy">
                        <img src="<?= $this->template->Images()?>home/cyprus-pin.png" width="50px" alt="Cyprus" class="img-tooltip">
                    </a>
                    <p>Cyprus</p>
                </div>
            </div>
            <?= $this->load->ext_view('modal', 'PaymentSystemCarousel', '', TRUE); ?>

        </div>
    </div>
</div>
<!-- carousel for valeron page -->

<script src="<?= $this->template->Js()?>/jquery.fancybox.pack.js"></script>
<script>


    $(document).ready(function() {

        $("#owl-demo").owlCarousel({
            autoPlay : 5000, //Set AutoPlay to 3 seconds
            items : 5,
            lazyLoad : true,
            dots : false,
            navigation : false
        });
        $('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        })
        $('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        })
    });
</script>