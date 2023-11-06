<link href="<?= $this->template->Css()?>jquery.fancybox.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>meet-offline.css" rel="stylesheet">
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

<div class="news-parent-container">
    <div class="container">

        <!--        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">-->
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="forex-news-left-content">

                <?php
                if(is_array($articles) && count($articles) )
                {
                    foreach($articles as $post)
                    { $date = date("D M d, Y", strtotime($post->date));

                        ?>
                        <div class="full-news-container">
                            <h1><?php echo $post->title; ?></h1>
                            <span><?php echo $date; ?></span>
                            <?php
                            if(count(img_arr)>0){  $i = 0;
                                foreach ($img_arr as $item) { if ($i == 0) {
                                    $f = pathinfo($item->file_name, PATHINFO_EXTENSION);
                                    $vid = array("avi", "mp4");
                                    //  $img =  array("gif", "jpeg", "jpg", "png", "bmp");
                                    $cat = array_search($f,$vid);
                                    if($cat){
                                        $f_type = "video";
                                    }else{
                                        $f_type = "image";
                                    }
                                    ?>
                                    <?php //echo $f;?>
                                    <div style="width:100%;">
                                        <?php if($f_type == "video"){?>
                                            <video style="width:100%;" controls>
                                                <source src="<?= base_url() . 'assets/offline_images/' . $item->file_name ?> ">
                                            </video>
                                        <?php }else{?>
                                            <img class="cover" alt="Offline message"   src="<?= base_url() . 'assets/offline_images/' . $item->file_name ?>" >
                                        <?php }?>
                                    </div>
                                <?php  } $i++; } }?>
<!--                            <p>-->
                                <?php echo htmlspecialchars_decode($post->content, ENT_QUOTES); ?>
<!--                            </p>-->
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
                                            if($cat){
                                                $f_type = "video";
                                            }else{
                                                $f_type = "image";
                                            }
                                            ?>
                                            <div class="item">
                                                <a class="fancybox" href="<?= base_url() . 'assets/offline_images/' . $value->file_name ?>" data-fancybox-group="gallery">
                                                    <?php if($f_type == "video"){?>
                                                    <video style="width:300px;"controls>
                                                        <source data-src="<?= base_url() . 'assets/offline_images/' . $value->file_name ?>" >
                                                       </video>
                                                   <?php }else{

                                                        ?>
                                                        <img class="lazyOwl" alt="Offline message" src="<?= base_url() . 'assets/offline_images/'. thumb('assets/offline_images/'.$value->file_name,134,213);?>">


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
        <!-- SIDE BAR -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">


            <div class="events-right-container" style="">
                <?php  if(isset($other)) {
                $head = 'Forexmart '.$heading;
                $hlink = strtolower($heading);
                ?>
                <h1>Other Events</h1>
                <div style="overflow-y:scroll;height:300px;">
                    <ul class="events-right-list">
                        <?php
                        foreach ($other as $epost) {
                            $edate = date("D M d, h:i:s Y", strtotime($epost->date));
                           // $str = preg_replace('/[[:space:]]+/', '-', $epost->title);
                            $str = "";
                            ?>
                            <li>
                                <a href="<?php echo base_url('meet-us-offline/'.$hlink.'/' . $epost->offevents_ID . '/' . $str) ;?>"
                                   target="_blank"><?php echo $epost->title; ?></a>
                                <span><?php echo $edate; ?></span>
                            </li>
                            <?php
                        }?>
                    </ul>
                </div>
                 <?php   }else{?>
                    <h1>Other Events</h1>
                    <div style="overflow-y:scroll;height:40px;">
                        <ul class="events-right-list">
                            <li>
                                <span>No events available.</span>
                            </li>
                        </ul>
                    </div>

                <?php }?>
            </div>
        </div>
        <!-- END SIDE BAR -->





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