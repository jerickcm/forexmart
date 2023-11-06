<?php
// print_r($most_read_news); exit;
foreach($latest_news as $key => $news ){ ?>
    <div class="news-item">
        <a href="<?php echo FXPP::ajax_url('news/article/' . $news['id']) ?>">
            <div class="news item-news">
                <?php if($news['file_name'] == null){ ?>
                    <img src="<?= $this->template->Images()?>sample-news-img.jpg" alt="" class="img-responsive"/>
                <?php }else{ ?>
                    <img src="<?php echo base_url().'assets/news_images/'.$news['file_name']?>" alt="" class="img-responsive"/>
                <?php } ?>
            </div>
            <div class="news-title"><?php echo $news['headline'] ?></div>
        </a>
        <div class="news-desc">
            <?php echo mb_substr(strip_tags($news['content']),0, 50, "utf-8"). " ...";  ?> <a href="<?php echo FXPP::ajax_url('news/article/' . $news['id']) ?>">Read More</a>
        </div>
    </div>

<?php  } ?>
<a href="<?php echo base_url()?>news" class="news-more">More News</a>
