<link rel='stylesheet' href="<?= $this->template->Css()?>laspalmas.css">
<link rel='stylesheet' href="<?= $this->template->Css()?>lightslider2.css">

    <script>
         $(document).ready(function() {
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:1000,
                pause:5000,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
        });
    </script>
    <style>
        #player1:hover{cursor: pointer;}
    </style>

    <script type="text/javascript">
            // Set video element to variable
        $(document).ready(function() {
            var video = document.getElementById('player1');
            var videoStartTime = 0;

            $("#watch").click(function(){
                $(".vid").show();
                video.play();
                $("#aa").hide();
            });
        });
    </script>

<div class="reg-form-holder">
    <?php
     if(IPLoc::Office()){ ?>
         <div class="partnership-main-holder">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-lg-2 col-md-2 col-2-left">
                         <?php
                         include_once('layouts/external/sidebar-left.php');
                         ?>
                     </div>
                     <div class="col-lg-8 col-md-8 col-8-center">

                         <div class="">
                             <div class="row">
                                 <div class="col-lg-12">
                                     <h1 class="laspalmas-title">
                                         <?= lang('x_lp_t') ?>
                                     </h1>
<<<<<<< .mine
                                     <div class="palmas-main-img">
                                         <div class="lp-vid-holder">
                                             <video width="100%" autoplay loop id="player1" class="vw">
                                                 <source src="<?= $this->template->Images()?>laspalmas3/video/laspalmas.m4v" type="video/mp4">
                                             </video>
                                         </div>
                                     </div>
||||||| .r29281
                                     <div class="palmas-main-img">
                                         <div class="lp-vid-holder">
                                             <video width="100%" autoplay loop id="player1">
                                                 <source src="<?= $this->template->Images()?>laspalmas3/video/laspalmas.m4v" type="video/mp4">
                                             </video>
                                         </div>
                                     </div>
=======
                                <div class="palmas-main-img">
                                    <div class="lp-vid-holder">
                                        <div id="aa" class="vid-front">
                                            <img src="<?= $this->template->Images()?>laspalmas3/laspalmas-front.PNG" alt="" class="img-responsive"/>
                                        </div>
                                        <video class="vid" style="max-width: 900px;" loop id="player1" controls title="Play Video">
                                            <source src="<?= $this->template->Images()?>laspalmas3/video/laspalmas.m4v" type="video/mp4">
                                        </video>
                                        <a href="#" id="watch" class="watch"><i class="fa fa-play"></i> Watch Video</a>
                                    </div>
                                </div>
>>>>>>> .r29996

                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_1') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_2') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_3') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_4') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_5') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_6') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_7') ?>
                                     </p>
                                     <p class="laspalmas-text">
                                         <?= lang('x_lp_8') ?>
                                     </p>
                                     <div class="col-md-12" dir="ltr">

                                         <div class="demo-slide">
                                             <div class="item">
                                                 <div class="clearfix cf">
                                                     <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp1.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp1.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp2.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp2.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp3.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp3.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp4.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp4.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp5.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp5.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp6.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp6.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp7.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp7.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp8.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp8.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp9.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp9.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp10.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp10.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp11.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp11.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp12.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp12.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp13.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp13.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp14.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp14.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp15.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp15.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp16.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp16.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp17.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp17.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp18.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp18.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp19.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp19.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp20.jpg">
                                                             <img src="<?= $this->template->Images()?>laspalmas3/lp20.jpg" alt="" class="img-responsive slidepic"/>
                                                         </li>
                                                     </ul>
                                                 </div>
                                             </div>
                                         </div>
                                     </div><div class="clearfix"></div>
                                     <?= $DemoAndLiveLinks; ?>
                                 </div>
                                 <div class="col-lg-12">

                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-2 col-md-2 col-2-right">
                         <?php
                         include_once('layouts/external/sidebar-right.php');
                         ?>
                     </div>
                 </div>
             </div>
         </div>

     <?php } else{ ?>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                 <h1 class="laspalmas-title">
                     <?= lang('x_lp_t') ?>
                 </h1>
                <div class="palmas-main-img">
                    <div class="lp-vid-holder">
                        <div id="aa" class="vid-front">
                            <img src="<?= $this->template->Images()?>laspalmas3/laspalmas-front.PNG" alt="" class="img-responsive"/>
                        </div>
                        <video class="vid" style="max-width: 900px;" loop id="player1" controls title="Play Video">
                            <source src="<?= $this->template->Images()?>laspalmas3/video/laspalmas.m4v" type="video/mp4">
                        </video>
                        <a href="#" id="watch" class="watch"><i class="fa fa-play"></i> Watch Video</a>
                    </div>
                </div>

                 <p class="laspalmas-text">
                     <?= lang('x_lp_1') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_2') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_3') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_4') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_5') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_6') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_7') ?>
                 </p>
                 <p class="laspalmas-text">
                     <?= lang('x_lp_8') ?>
                 </p>
                 <div class="col-md-12" dir="ltr">

                     <div class="demo-slide">
                         <div class="item">
                             <div class="clearfix cf">
                                 <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp1.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp1.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp2.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp2.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp3.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp3.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp4.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp4.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp5.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp5.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp6.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp6.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp7.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp7.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp8.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp8.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp9.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp9.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp10.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp10.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp11.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp11.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp12.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp12.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp13.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp13.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp14.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp14.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp15.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp15.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp16.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp16.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp17.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp17.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp18.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp18.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp19.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp19.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                     <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp20.jpg">
                                         <img src="<?= $this->template->Images()?>laspalmas3/lp20.jpg" alt="" class="img-responsive slidepic"/>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div><div class="clearfix"></div>
                 <?= $DemoAndLiveLinks; ?>
             </div>
             <div class="col-lg-12">

<<<<<<< .mine
                     <p class="laspalmas-text">
                         <?= lang('x_lp_1') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_2') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_3') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_4') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_5') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_6') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_7') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_8') ?>
                     </p>
                     <div class="col-md-12" dir="ltr">

                         <div class="demo-slide">
                             <div class="item">
                                 <div class="clearfix cf">
                                     <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp1.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp1.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp2.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp2.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp3.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp3.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp4.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp4.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp5.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp5.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp6.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp6.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp7.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp7.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp8.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp8.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp9.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp9.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp10.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp10.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp11.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp11.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp12.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp12.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp13.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp13.jpg" class="img-responsive slidepic" alt=""/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp14.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp14.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp15.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp15.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp16.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp16.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp17.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp17.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp18.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp18.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp19.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp19.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp20.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp20.jpg" class="img-responsive slidepic" alt="" />
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div><div class="clearfix"></div>
                     <?= $DemoAndLiveLinks; ?>
                 </div>
                 <div class="col-lg-12">

                 </div>
||||||| .r29281
                     <p class="laspalmas-text">
                         <?= lang('x_lp_1') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_2') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_3') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_4') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_5') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_6') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_7') ?>
                     </p>
                     <p class="laspalmas-text">
                         <?= lang('x_lp_8') ?>
                     </p>
                     <div class="col-md-12" dir="ltr">

                         <div class="demo-slide">
                             <div class="item">
                                 <div class="clearfix cf">
                                     <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp1.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp1.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp2.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp2.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp3.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp3.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp4.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp4.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp5.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp5.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp6.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp6.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp7.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp7.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp8.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp8.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp9.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp9.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp10.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp10.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp11.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp11.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp12.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp12.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp13.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp13.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp14.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp14.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp15.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp15.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp16.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp16.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp17.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp17.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp18.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp18.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp19.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp19.jpg" class="img-responsive slidepic"/>
                                         </li>
                                         <li data-thumb="<?= $this->template->Images()?>laspalmas3/lp20.jpg">
                                             <img src="<?= $this->template->Images()?>laspalmas3/lp20.jpg" class="img-responsive slidepic"/>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div><div class="clearfix"></div>
                     <?= $DemoAndLiveLinks; ?>
                 </div>
                 <div class="col-lg-12">

                 </div>
=======
>>>>>>> .r29996
             </div>
         </div>
    </div>
</div>
    <?php } ?>

</div>
