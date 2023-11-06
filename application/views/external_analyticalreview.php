<?php
/**
 * Created by PhpStorm.
 * User: Zeta-Joy
 * Date: 05/07/2016
 * Time: 17:10
 */
?>
<style>
    #btn-yes{
        background: #29a643;
        text-align: center;
        color: #fff;
        font-size: 16px;
        border: none;
        padding: 5px 10px;
        text-decoration: none;
    }

    #btn-yes:hover{
        text-decoration: none;
        background: #3ecd5c;
    }
</style>
<link rel='stylesheet' href='<?= $this->template->Css()?>view-analytical-review.css' type='text/css'  />
<script>
      jQuery(document).on('click', '#flag_btn', function(e){
      
           $(this).parents("li").toggleClass("open"); 
           //$('.btn-flag-dropdown').toggleClass("blockflag"); 
          e.preventDefault();          
      });
jQuery(document).on('click', '.user-account', function(e){
      
           $(this).toggleClass("open"); 
           //$('.btn-flag-dropdown').toggleClass("blockflag"); 
          e.preventDefault();          
      });      
      
    
    
      
    //PAGINATION
    var baseURL = '<?php echo FXPP::loc_url() ?>';
    jQuery(document).on('click', '.latest-page a', function(e){
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        var urlx="<?=FXPP::html_url()?>";
        var ajax_url="<?=FXPP::ajax_url()?>";
        
        var xbase="<?=  base_url()?>";
       $.post(ajax_url +"analytical-reviews/update/" + cur_page,{cur_page : cur_page,langu:urlx},function(page){
               var res = page.split("_________________________"); 
                jQuery('#latest-reviews').html(res[0]);
                jQuery('#review-pages').html(res[1]);
  
       });
       
      
        
        return false;
    });
</script>
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
                if(isset($pubs)) {
                    foreach ($pubs as $entry) {
                        
                        
                        $date = date("F j, Y", strtotime($entry->date_modified));
                          $dateMonth = date("F", strtotime($entry->date_modified));
                          $dateday = date("j", strtotime($entry->date_modified));
                          $dateyear = date("Y", strtotime($entry->date_modified));
                                                      
                          $fullDate=Fx_lang_date::getFullMonth(FXPP::html_url(),$dateMonth)." ".$dateday.", ".$dateyear;
                          
                        $time = date("h:i a", strtotime($entry->date_modified));
                        $str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                         $str=str_replace(","," ",$str);      
                         $str=str_replace("/","",$str);      
                         
                        if($entry->image !=''){  $avatar = base_url('assets/reviews/'.$entry->image); }else{ $avatar = base_url('assets/reviews/default-avatar.png');}
                      
                        
                        $wordscontent = explode(" ",$entry->content);
                        $newContent=implode(" ",array_splice($wordscontent,0,100));
                         $c = strip_tags(htmlspecialchars_decode($newContent, ENT_QUOTES));
                       // $c = strip_tags(substr(htmlspecialchars_decode($entry->content, ENT_QUOTES), 0, 600));
                      //  $c = substr( strip_tags( $entry->content, 0, 600 ) );
                        
                         ?>
                        <div class="reviews-holder">
                            <div class="row">
                                <div class="col-md-1 col-sm-2 col-xs-2 col-avatar">
                                    <div class="review-avatar-holder">
                                        <img src="<?php echo $avatar; ?>"
                                             class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-11 col-sm-10 col-xs-10 col-reviews">
                                    <p class="reviews-date"><?=$fullDate ?> <span><?= $time; ?></span></p>
                                     <p class="reviews-title" style="font-size: 15px"><?php echo $entry->full_name; ?></p>
                                   <a href="<?php echo FXPP::loc_url('analytical-reviews/read-more/' . $entry->id.'/'.$str) ?>" target="_blank" class="reviews-title"><?php echo $entry->title; ?></a>
                                   <a style="color: #555" href="<?php echo FXPP::loc_url('analytical-reviews/read-more/' . $entry->id.'/'.$str) ?>" target="_blank" class="reviews-readmore">
                                        <p class="reviews-content"><?php echo $c."..."; ?></p>
                                      </a>
                                   <a href="<?php echo FXPP::loc_url('analytical-reviews/read-more/' . $entry->id.'/'.$str) ?>" target="_blank" class="reviews-readmore"><?=lang('redm')?></a>
                                </div>
                            </div>

                        </div>
                    <?php }
                }else{ ?>
                    <p style="text-align: center;font-size: 17px;padding: 30px;color: #555;"><?=lang('no_data')?></p>
                <?php } ?>
                </div>

                <div class="col-md-12">
                    <div class="pagination-holder" id="review-pages">
                        <nav>
                            <?php echo $pagination; ?>
                        </nav>
                    </div>
                </div>
                <?php if(IPLoc::Office()){?>
                  <div class="col-sm-12" style="display: none;">
                      <a id="btn-yes" target="_blank" href="<?php echo FXPP::loc_url('analytical-reviews/yesterday')?>" class="pull-right">Yesterday's News</a>
                  </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="<?=$this->template->Js();?>jquery.js"></script>

    <script src="<?=$this->template->Js();?>bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="<?=$this->template->Js();?>jquery.easing.min.js"></script>

    <script src="<?=$this->template->Js();?>owl.carousel.js"></script>
 
    <!-- carousel for valeron page -->
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

    </div>
    </html>
