<link href="<?=$this->template->Css();?>econ_news.css" rel="stylesheet" type="text/css">
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<style>
    .full-news-container span{ color:#000;}
    .economic-news-thumbnail .caption {height: 150px;}
    .latest-news-article:hover{background: #f6f6f6;;}
    .all-news-row:hover{background: #f6f6f6;;}
    .all-news-img { background: #fff;   }
    .news-content-holder:hover{text-decoration: underline;}
    .fx-watermark {vertical-align: middle;width: 70%;height: auto;display: block;position: absolute;bottom: 0;right: 0; padding: 20px 40px; }
    .fx-watermark1 {vertical-align: middle;width: 70%;height: auto;display: block;position: absolute;bottom:0;right: 0; padding: 10px 30px; }
    .watermark-defaultsize{height:83px; width:auto;}
    .all-news-content-holder p{ font-size:13px; }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
        $('.btn-reg').click(function(){
            $('#flagmenu1').toggle();
            $('.btn-user-dropdown').hide();
        });
        $('#flag_btn1').click(function(){
            $('#flagmenu').toggle();
            $('.btn-user-dropdown').hide();
        });


        $('.user-account').click(function(){
            $('.btn-user-dropdown').toggle();
            $('#flagmenu1').hide();
        });
    });
    //PAGINATION
    var baseURL = '<?php echo FXPP::loc_url() ?>';
    var lang = '<?php echo FXPP::html_url(); ?>';
    var url;
    jQuery(document).on('click', '.latest-page a', function(e){
        e.preventDefault();
        if(baseURL!='https://www.forexmart.com/'){
            url = '/economic-news/update/';
        }else{ url = 'economic-news/update/';}
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        jQuery.ajax({
            type: "POST",
            url: baseURL + url + cur_page,
            data: {cur_page : cur_page,lang:lang},
            dataType: 'JSON',
            cache: false,
            success: function(page) {
//                jQuery('#updatesCurrentPage').val(cur_page);
                jQuery('#ul-latest-news').html(page.html_data);
                jQuery('#news-pages').html(page.html_page_links);
                //console.log(page);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });
</script>
</head>
<div class="economicnews-banner">
    <div class="container"><div class="row"><div class="col-md-12"><h1 class="economicnews-title"><?=lang('econews_1');?></h1><p class="economicnews-text"><?=lang('econews_2');?></p></div></div></div>
</div>
<div class="economicnews-main-holder">
    <div class="container">
        <div class="latest-economicnews-holder">
            <div class="row">
                <div class="col-md-12"><h1 class="economicnews-page-title"><?=lang('econews_3');?></h1></div>
                <?php
                if($latestnews!=false){$i=0;
                    foreach ($latestnews as $key) {if($i==0){
                        $img = isset($img)?base_url().'/assets/economic_news/'.$img:$this->template->Images().'sample-news-img.jpg';
                        $str = preg_replace('/[[:space:]]+/', '-', $key->title);
                        $rep = array(',','$','%','#','@','&','!','^','*','(',')','?','<','>','/','|','{','}','[','}');
                        $str = str_replace($rep, '-', $str);?>
                        <a href="<?php echo FXPP::loc_url('economic-news/article/' . $key->id) ?>" target="_blank" class="latest-news-article">
                            <div class="col-md-5 col-sm-5" style="position: relative;">
                                <img src="<?= $this->template->Images()?>fmwm/fx6.png"  class="fx-watermark" >
                                <div class="news-img"><img src="<?=$img?>" class="img-responsive"></div></div>
                            <div class="col-md-7 col-sm-7">
                                <div class="news-content-holder">
                                    <h2><?=$key->title;?></h2>
                                    <small><?=date("F d, Y", strtotime($key->date_created));?></small>
                                    <p><?php echo substr(strip_tags($key->content), 0, 500);?> <span style="color: #2988ca;"><?=lang('n_0_4');?></span></p>
                                </div>
                            </div>
                        </a>
                    <?php  } $i++; } }else{ echo "<div style='font-size:18px;text-align: center;'>".lang('econews_7')."</div>";}?>
                <div class="col-md-12">
                    <div class="latest-news-line"></div>
                </div>
            </div>
        </div>

        <div id="demo" class="demo more-economicnews-holder">
            <div class="row"><div class="col-md-12"><h1 class="economicnews-page-title"><?=lang('econews_5');?></h1></div></div>
            <?php  if($weeklynews!=false){ ?>
                <div class="row owl-news" id="owl-demo" class="owl-carousel" style="opacity:5!important; ">
                    <?php
                    $i = 0;
                    foreach ($weeklynews as $key) {
                        $img=isset($weeklyimg)?$weeklyimg[$i]:$this->template->Images().'sample-news-img.jpg';
                        $str = preg_replace('/[[:space:]]+/', '-', $key->title);
                        $rep = array(',','$','%','#','@','&','!','^','*','(',')','?','<','>','/','|','{','}','[','}');
                        $str = str_replace($rep, '-', $str);?>
                        <a href="<?php echo FXPP::ajax_url('economic-news/article/' . $key->id) ?>" target="_blank"><div class="item">
                                <div class="thumbnail economic-news-thumbnail" style="position: relative;">

                                    <div class="thumbnail-img-holder news-img-holder" style="position:relative;">
                                        <img src="<?= $this->template->Images()?>fmwm/fx6.png"  class="fx-watermark1 watermark-defaultsize" style="width:70%!important; height:auto!important;">
                                        <img src="<?php echo $img;?>" class="img-responsive">
                                    </div>
                                    <div class="caption">
                                        <h3><?=$key->title;?></h3>
                                        <small><?=date("F d, Y", strtotime($key->date_created));?></small>
                                        <p><?php echo substr(strip_tags($key->content), 0, 150);?>...</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php $i++; }  ?>
                </div>
            <?php }else{ echo "<div style='font-size:18px;text-align: center;'>".lang('econews_7')."</div>"; } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-news-line"></div>
                </div>
            </div>
        </div>
        <div class="all-news-holder">

            <div class="row">
                <div class="col-md-12"><h2 class="economicnews-page-title"><?=lang('econews_6');?></h2></div>
                <div id="ul-latest-news">
                    <?php if(isset($econnews)){$i = 0;
                        foreach ($econnews as $key){
                            $str = preg_replace('/[[:space:]]+/', '-', $key->title);
                            $rep = array(',','$','%','#','@','&','!','^','*','(',')','?','<','>','/','|','{','}','[','}');
                            $str = str_replace($rep, '-', $str);
                            $cont1 = strip_tags($key->content);
                            $cont = mb_substr($cont1, 0, 150);
                            $lastSpace = strrpos($cont, ' ', 0);
                            $content = mb_substr($cont,0,$lastSpace);
                            ?>
                            <a href="<?php echo FXPP::ajax_url('economic-news/article/' . $key->id) ?>" target="_blank" class="hover-econ">
                                <div class="col-md-6">
                                    <div class="row all-news-row">
                                        <div class="col-md-5 col-sm-5 col-xs-5 all-img-col" style="margin-top: 5px;position: relative;">
                                            <img src="<?= $this->template->Images()?>fmwm/fx6.png"  class="fx-watermark" >
                                            <div class="all-news-img">
                                                <img src="<?php echo $econimg[$i];?>" class="img-responsive news-img">
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-7 all-img-col">
                                            <div class="all-news-content-holder">
                                                <h2><?=$key->title;?></h2>
                                                <small><?=date("F d, Y", strtotime($key->date_created));?></small>
                                                <p><?=$content;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($allcount%2==0){?>
                                        <div class="border-bot"></div>
                                    <?php }?>
                                </div>
                            </a>
                            <?php $i++; } }else {echo "<div style='font-size:18px;text-align: center;'>".lang('econews_7')."</div>"; } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pagination-holder" id="news-pages">
                <nav>
                    <?php echo $news_pagination; ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- end content -->
<script src="<?=$this->template->Js();?>jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?=$this->template->Js();?>bootstrap.min.js"></script>
<!-- Scrolling Nav JavaScript -->
<script src="<?=$this->template->Js();?>jquery.easing.min.js"></script>
<script src="<?=$this->template->Js();?>scrolling-nav.js"></script>
<script src="<?=$this->template->Js();?>owl.carousel.js"></script>
<script src="<?=$this->template->Js();?>jquery.fancybox.pack.js"></script>
<!-- carousel for valeron page -->
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            autoPlay : 5000, //Set AutoPlay to 3 seconds
            items : 3,
            lazyLoad : true
        });
        $('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        })
        $('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        })
    });
</script>
