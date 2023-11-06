<link href="<?= $this->template->Css()?>jquery.fancybox.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>meet-offline.css" rel="stylesheet">
<style>
    .full-news-container span{ color:#000;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
        $('.btn-reg').click(function(){ $('.btn-flag-dropdown').toggle(); });
    });
</script>

<div class="news-parent-container">
    <div class="economicnews-banner">
        <div class="container">
            <div class="row"><div class="col-md-12"><h1 class="economicnews-title"><?=lang('econews_1');?></h1><p class="economicnews-text"><?=lang('econews_2');?></p></div></div>
        </div>
    </div>
    <div class="container">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="forex-news-left-content">
                <?php if(is_array($articles) && count($articles) )
                {
                    foreach($articles as $post)
                    { $date = date("D M d, Y", strtotime($post->date_created));
                        ?>
                        <div class="full-news-container">
                            <h1><?php echo $post->title; ?></h1>
                            <span><?php echo $date; ?></span>
                            <?php
                            if(count(img_arr)>0){  $i = 0;
                                foreach ($img_arr as $item) { if ($i == 0) {
                                    $f = pathinfo($item->file_name, PATHINFO_EXTENSION);
                                    $vid = array("avi", "mp4");
                                    $cat = array_search($f,$vid);
                                    $f_type=$cat?"video":"image";
                                    ?>
                                    <div style="width:100%; position: relative;">
                                        <img src="<?= $this->template->Images()?>fmwm/fx6.png" alt="watermark" class="fx-watermark" >
                                        <?php if($f_type == "video"){?>
                                            <video style="width:100%;" controls>
                                                <source src="<?= base_url() . 'assets/economic_news/' . $item->file_name ?> ">
                                            </video>
                                        <?php }else{?>
                                            <img class="cover" alt="Economic news"  src="<?= base_url() . 'assets/economic_news/' . $item->file_name ?>" >
                                        <?php }?>
                                    </div>
                                <?php  } $i++; } }?>
                            <p>
                                <?php echo htmlspecialchars_decode($post->content, ENT_QUOTES); ?>
                            </p>
                        </div>
                    <?php     }
                }
                ?>

                <?php if(count($img_arr) >1){ ?>
                    <div class="col-md-12"  style="margin-top: -10px;">
                        <div id="demo" class="demo">
                            <div class="span12">
                                <div id="owl-demo" class="owl-carousel">
                                    <?php
                                    $x = 0;
                                    foreach($img_arr as $value) {
                                        if ($x >= 1) {
                                            $f1 = pathinfo($value->file_name, PATHINFO_EXTENSION);
                                            $vid = array("avi", "mp4");
                                            $cat = array_search($f1,$vid);
                                            $f_type=$cat?"video":"image";
                                            ?>
                                            <div class="item">
                                                <div style="position: absolute; left: 0;top: 0; z-index: 1000;"><img src="<?= $this->template->Images()?>fxwm.png" alt="fxwm"  style="width:100%;height: auto;display: block;" ></div>
                                                <a class="fancybox" href="<?= base_url(). 'assets/economic_news/' . $value->file_name ?>" data-fancybox-group="gallery">
                                                    <?php if($f_type == "video"){?>
                                                    <video style="width:300px;"controls>
                                                        <source data-src="<?= base_url() . 'assets/economic_news/' . $value->file_name ?>" >
                                                       </video>
                                                   <?php }else{?>
                                                    <img class="lazyOwl" alt="Economic news" data-src="<?= base_url(). 'assets/economic_news/' . $value->file_name ?>">
                                                        <?php }?>
                                                </a>
                                            </div>
                                        <?php }
                                        $x++;
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

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