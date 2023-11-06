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

<link href="<?= $this->template->Css()?>news.css" rel="stylesheet">

<div class="news-parent-container">
    <div class="container">
        <div class="news-container-banner">
            <img src="<?= $this->template->Images()?>newsbanner.png" class="img-responsive" alt=""/>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="forex-news-left-content">
                <div class="full-news-container">
                    <h1><?php echo $news['headline']?></h1>
                    <span><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?> | <?php echo $news['publisher'] ?></span>

                        <?php echo $news['content'] ?>

                </div>

                <?php if(count($news_images) >0){ $countImages = count($news_images);?>
                    <div class="col-md-12"  style="margin-top: -10px; margin-bottom:50px;">
                        <div id="demo" class="demo">
                            <div class="span12" style="margin:0 auto;">

                                <?php foreach($news_images as $key => $value){
                                $i = 1 ; if($i <= $countImages) {
                                    if (($i % 5) == 0) {?>
                                        <br>
                                        <?php }else{ ?>
                                        <a class="fancybox" href="<?=base_url() . 'assets/news_images/' . $value['file_name'] ?>" data-fancybox-group="gallery">

                                            <img class="news-img" alt="Offline message" src="<?=base_url() . 'assets/news_images/'.thumb('assets/news_images/'.$value['file_name'],155,140);?>"  height="140" width="155">

                                        </a>
                                        <?php }}$i++;?>

                                <?php } ?>

                            </div>
                        </div>
                    </div>

                    <?php } ?>

<!--                <div class="news-image-container">-->
<!--                    <img src="chart.jpg" align="center" width="630" height="200" class="img-responsive"/>-->
<!--                </div>-->
            </div>

            <!-- back button-->
            <div class="forex-news-left-content">
                <div class="news-back-button">
                    <a href="<?php echo FXPP::ajax_url('news');?>" class=" btn btn-primary"><?= lang('a_0_8');?></a>
                </div>
            </div>
            <!-- end back button-->

        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 forex-news-right-parent">
            <div class="forex-news-right-content">
                <div class="list-of-other-news">
                    <div class="other-news-header"><h1><?=lang('n_0_5');?></h1></div>
                    <ul>
                        <?php foreach( $most_read_news as $key => $article){ ?>
                            <li>
                                <a href="<?php echo FXPP::loc_url('news/article/' . $article['id']) ?>"><?php echo $article['headline'] ?> <span>- <?php echo  date('D M j H:i:s e Y', strtotime($article['date_published'])) ?></span></a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <?php /*
                <div class="vertical-banner">
                    <a href="https://www.forexmart.com/partnership/friend-referrer?x=YOUR_PARTNER_LINK" target="_blank" style="outline: none"><img src="https://www.forexmart.com/assets/images/banners/250x250/250x250_banner3.png" width="250" height="250" alt="Forexmart" border="0" /></a>
                </div>
                */ ?>
            </div>
        </div>
    </div>
</div>

<!-- end banner -->

<div class="all-news-main-holder">
    <div class="container">
        <div class="all-news-holder">
            <div class="row">
                <div class="col-md-12">

                    <h1 class="all-news-title"><?= lang('news_5');?><span class="hr-arrow"></span></h1>
                </div>
                <div id="all_news">
                    <?php
                    if(count($all_news) < 4){ ?>

                        <?php } foreach( $all_news as $key => $news ){
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail all-news-thumbnail">
                            <div class="thumbnail-img-holder">

                                <?php if(strlen($news['file_name'])==0){?>
                                <img src="<?= $this->template->Images()?>sample-news-img.jpg" alt="" class="img-responsive">
                                <?php }else{?>
                                <img src="<?= base_url('assets/news_images')."/".$news['file_name']?>" alt="" class="img-responsive">
                                <?php };?>
                            </div>
                            <div class="caption">
                                <h3><a href="<?php echo FXPP::ajax_url('news/article/' . $news['id']) ?>" target="_blank"><?php echo $news['headline'] ?></a></h3>
                                <small><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?></small>
                                <p>
                                    <?php echo substr(strip_tags($news['content']),0, 70). " ...";  ?>
                                    <a href="<?php echo FXPP::ajax_url('news/article/' . $news['id']) ?>"><?=lang('news_7');?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both"></div>




                    <?php
                }?>
                </div>
                <div class="col-md-12 view-more-holder">
                    <button id="all_news_btn" type="button" onclick="viewMore()" class="view-more"><?= lang('news_6');?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="https://my.forexmart.com/assets/css/loaders.css"/>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>



<script>
    viewMore2();
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



    var start2 = 0;

    function viewMore2(){

        var base_url = "<?=FXPP::ajax_url('news/all_news')?>";

        $.post(base_url,{limit:4,start:start2},function(data){
            if(data){
                $("#all_news").append(data);
                start2 = start2+4;
                $('html, body').animate({
                    scrollTop: $(window).scrollTop() + 500
                });
                $("#loader-holder").hide();
                // $("all_news_btn").attr('onclick',viewMore(4,start+4));
            }else{
                //$('#all_news_btn').remove();
            }
        })
    }

    var start = 4;
    function viewMore(){
        $("#loader-holder").show();
        var base_url = "<?=FXPP::ajax_url('news/all_news')?>";

        $.post(base_url,{limit:4,start:start},function(data){
            if(data){
                $("#all_news").append(data);
                start = start+4;
                $('html, body').animate({
                    scrollTop: $(window).scrollTop() + 500
                });
                $("#loader-holder").hide();
                // $("all_news_btn").attr('onclick',viewMore(4,start+4));
            }else{
                //$('#all_news_btn').remove();
            }
        })
    }



</script>

<!-- carousel for valeron page -->

<script src="<?= $this->template->Js()?>/jquery.fancybox.pack.js"></script>


