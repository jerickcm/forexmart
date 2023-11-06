<?php
if(count($all_news) < 4){ ?>
    <script>
        $(document).ready(function(){
            $('#all_news_btn').remove();
        });
    </script>
<?php } foreach( $all_news as $key => $news ){
    ?>
    <div class="col-md-3 col-sm-6">
        <div class="thumbnail all-news-thumbnail">
            <div class="thumbnail-img-holder">

                <?php if(strlen($news['file_name'])==0){?>
                    <img src="<?= $this->template->Images()?>sample-news-img.jpg" alt="" class="img-responsive">
                <?php }else{?>


                    <img class="img-responsive" alt="Offline message" src="<?=base_url() . 'assets/news_images/'.thumb('assets/news_images/'.$news['file_name'],245,168);?>"  >

                <?php };?>
            </div>
            <div class="caption">
                <h3><a href="<?php echo FXPP::ajax_url('news/article/' . $news['id']) ?>" target="_blank"><?php echo $news['headline'] ?></a></h3>
                <small><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?></small>
                <p>
                    <?php echo mb_substr(strip_tags($news['content']),0, 70, "utf-8"). " ...";  ?>
                    <a href="<?php echo FXPP::ajax_url('news/article/' . $news['id']) ?>"><?=lang('news_7');?></a>
                </p>
            </div>
        </div>
    </div>




<?php
}?>
<div style="clear: both"></div>