<?php
/**
 * Created by PhpStorm.
 * User: Zeta-Joy
 * Date: 05/07/2016
 * Time: 17:10
 */
?>

<link rel='stylesheet' href='<?= $this->template->Css()?>view-analytical-review.css' type='text/css'  />

<div class="analytical-banner" style="background: url(<?= $this->template->Images()?>analytic-bg.png) repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="analytical-title"><?=lang('ar_dsc')?></h1>
                <p class="analytical-text"><?=lang('ar_line1')?></p>
            </div>
        </div>
    </div>
</div>
<div class="analytical-main-holder">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="latest-reviews">
                    <?php

                        foreach ($review as $entry) {
                            $date = date("F j, Y", strtotime($entry->date_modified));
                            $time = date("h:i a", strtotime($entry->date_modified));
                            $str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                        if($entry->image !=''){  $avatar = base_url('assets/reviews/'.$entry->image); }else{ $avatar = base_url('assets/reviews/default-avatar.png');}
                        ?>
                            <div class="" style="width:100%!important;">
                                <div class="row">
                                    <div class="col-md-1 col-sm-2 col-xs-2 col-avatar">
                                        <div class="review-avatar-holder">
                                            <img src="<?php echo $avatar; ?>"
                                                 class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-11 col-sm-10 col-xs-10 col-reviews">
                                        <p class="reviews-date"><?php echo $date; ?><span> <?php echo $time; ?></span></p>
                                        <a href="#" class="reviews-title"><?= $entry->title; ?></a>
                                        <p class="reviews-content"><?= htmlspecialchars_decode($entry->content, ENT_QUOTES); ?></p>

                                    </div>
                                </div>





                                <?php if(count($img_arr) >0){ 
                                    $numberof=count($img_arr) ;
                                    ?>
<!--                                    <div class="col-md-11"  style="margin-top: 40px;float:right;">-->
                                    <div class="col-md-11 col-sm-10 col-xs-10 col-reviews"  style="margin-top: 50px;float:right;padding:0px;">
                                        <div id="demo" class="demo">
                                            <div class="span12">
                                                <div id="owl-demo" class="owl-carousel">
                                                   

                                 <?php

                                                    foreach($img_arr as $value) {

                                                            $f1 = pathinfo($value->file_name, PATHINFO_EXTENSION);
                                                            $vid = array("avi", "mp4");
                                                            $cat = array_search($f1,$vid);
                                                            if($cat){
                                                                $f_type = "video";
                                                            }else{
                                                                $f_type = "image";
                                                            }
                                                            ?>
                                                    <?php
                                                  if($f_type == "video")
                                                   {
                                                   ?>
                                                        <div class="item">
                                                                <a class="fancybox" href="<?= base_url() . 'assets/reviews/review_photos/' . $value->file_name ?>" data-fancybox-group="gallery">
                                                              
                                                                    
                                                                    
                                                       <video style="width:300px;"controls>
                                                         <source data-src="<?= base_url() . 'assets/reviews/review_photos/' . $value->file_name ?>" >
                                                       </video>
                                                           </a>
                                                            </div>            
                                                                    
                                                   <?php 
                                                   
                                                   }else{
                                                       
                                                       ?>
                                                        <div class="item " <?=($numberof<2)?'style="width: 100% !important;height: 83vh !important;"':''?>>
                                                                <a class="fancybox" href="<?= base_url() . 'assets/reviews/review_photos/' . $value->file_name ?>" data-fancybox-group="gallery">
                                                                      
                                                       <img class="lazyOwl"  data-src="<?= base_url(). 'assets/reviews/review_photos/' . $value->file_name ?>">
                                                    
                                                          </a>
                                                            </div>
                                                         <?php
                                                         }
                                                         ?>
                                                               
                                                        <?php
                                                    }?>
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        <?php }
                    ?>
                </div>

                <div class="col-md-12">
                    <div class="pagination-holder" id="review-pages">
                        <nav>
                            <?php// echo $pagination; ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->
 
</div>
</html>
 
 