<link href="<?= $this->template->Css()?>news.css" rel="stylesheet">

<div id="myCarousel" class="carousel slide news-carousel" data-ride="carousel">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="news-main-title" style=" display: inline-block;">  <?=lang('news_1');?></h2>

                <?php $lan = (FXPP::html_url() == '' ) ? 'en' : FXPP::html_url(); ?>
                <a href="<?php echo FXPP::www_url('feed/news2/'.$lan) ?>" class="rss-icon"> <img src="<?= $this->template->Images()?>rss-icon.png" alt="" class="img-rss" ></a>

            </div>
        </div>
    </div>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        $h = 0;
        foreach( $news_headlines as $key => $value ){
            ?>
            <li data-target="#myCarousel" data-slide-to="<?=$h;?>" class="<?=$h==0?"active":""?>"></li>
            <?php $h++; } ?>
    </ol>
    <div class="carousel-inner" role="listbox">


        <?php
        if( count($news_headlines) ){
            $ctr = 0;
            foreach( $news_headlines as $key => $value ){

                ?>

                <div class="item news-item <?=$ctr==0?"active":""?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 latest-img-holder">
                                <div class="news-img">
                                    <?php
                                    //echo $value['file_name'];
                                    if($value['file_name'] == null){?>

                                    <?php }else{?>
                                        
                                        <?php if(IPLoc::Office()){?>
                                            <img class="img-responsive" alt="Offline message" src="<?=base_url() . 'assets/news_images/'.thumb('assets/news_images/'.$value['file_name'],445,258);?>"  >
                                        <?php }else{ ?>

                                            <img src="<?= base_url('assets/news_images')."/".$value['file_name']?>" alt="" class="img-responsive">
                                        <?php } ?>

                                    <?php };?>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <div class="latest-info-holder">
                                    <h2><a style="color: #ffffff;" href="<?php echo FXPP::ajax_url('news2/article/' . $value['id'].'/'. $value['id2']) ?>" target="_blank"><?php echo $value['headline'] ?></a></h2>
                                    <small style="color: #ffffff;"><?php echo date('D M j H:i:s e Y', strtotime($value['date_published'])) ?></small>
                                    <p>
                                        <?php echo mb_substr(strip_tags($value['content']),0, 350, "utf-8"). " ...";  ?>
                                        <a href="<?php echo FXPP::ajax_url('news2/article/' . $value['id'].'/'. $value['id2']) ?>"> <?=lang('news_2');?></a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php   $ctr++; }
        } ?>




    </div>
    <a class="left cont-left-holder carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <!--<img src="<?/*= $this->template->Images()*/?>cont-left.png" class="controls-img"/>-->
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right cont-right-holder carousel-control" href="#myCarousel" role="button" data-slide="next">
        <!--<img src="<?/*= $this->template->Images()*/?>cont-right.png" class="controls-img"/>-->
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<div class="news-list-holder">
    <div class="container">
        <div class="news-list">
            <div class="news-col">
                <div class="latest-list-holder">
                    <h2> <?=lang('news_3');?></h2>


                    <?php
                    foreach( $latest_news as $key => $news ){
                        ?>

                        <div class="latest-list">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <?php if($news['file_name'] == null){ ?>
                                        <img src="<?= $this->template->Images()?>sample-news-img.jpg" alt="" class="img-responsive"/>
                                    <?php }else{ ?>

                                        <img class="img-responsive" alt="Offline message" src="<?=base_url() . 'assets/news_images/'.thumb('assets/news_images/'.$news['file_name'],62,39);?>"  >

                                    <?php } ?>
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10 latest-list-info">
                                    <h3><a href="<?php echo FXPP::ajax_url('news2/article/' . $news['id'].'/'. $news['id2']) ?>" target="_blank"><?php echo $news['headline'] ?></a></h3>
                                    <p>
                                        <?php echo mb_substr(strip_tags($news['content']),0, 70, "utf-8"). " ...";  ?>
                                        <a href="<?php echo FXPP::ajax_url('news2/article/' . $news['id'].'/'. $news['id2']) ?>"><?=lang('news_2');?></a>
                                    </p>
                                    <small><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?></small>
                                </div>
                            </div>
                        </div>


                    <?php
                    }?>

                </div>
                <div id="latest-news-links">
                    <div class="center">
                        <?=$latest_news_page_links;?>
                    </div>
                </div>
            </div>

            <div class="news-col">
                <div class="most-list-holder">
                    <h2><?=lang('news_4');?></h2>
                    <?php
                    foreach( $most_read_news as $key => $news ){
                        ?>

                        <div class="latest-list">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <?php if($news['file_name'] == null){ ?>
                                        <img src="<?= $this->template->Images()?>sample-news-img.jpg" alt="" class="img-responsive"/>
                                    <?php }else{ ?>

                                        <img class="img-responsive" alt="Offline message" src="<?=base_url() . 'assets/news_images/'.thumb('assets/news_images/'.$news['file_name'],62,39);?>"  >


                                    <?php } ?>
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10 latest-list-info">
                                    <h3><a href="<?php echo FXPP::ajax_url('news2/article/' . $news['id'].'/'. $news['id2']) ?>" target="_blank"><?php echo $news['headline'] ?></a></h3>
                                    <p>
                                        <?php echo mb_substr(strip_tags($news['content']),0, 70, "utf-8"). " ...";  ?>
                                        <a href="<?php echo FXPP::ajax_url('news2/article/' . $news['id'].'/'. $news['id2']) ?>"><?=lang('news_2');?></a>
                                    </p>
                                    <small><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?></small>
                                </div>
                            </div>
                        </div>


                    <?php
                    }?>

                </div>
                <div  id="most-read-links">
                    <div class="center">
                        <?=$most_read_news_page_links;?>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <!--         <div class="center">
            <?=$most_read_news_page_links;?>
        </div> -->

    </div>
</div>
<!-- end banner -->
<div class="all-news-main-holder">
    <div class="container">
        <div class="all-news-holder">
            <div class="row">
                <div class="col-md-12">

                    <h1 class="all-news-title"><?=lang('news_5');?><span class="hr-arrow"></span></h1>
                </div>
                <div id="all_news">
                    <?php $this->load->view('news2/all_news')?>
                </div>
                <div class="col-md-12 view-more-holder">
                    <button id="all_news_btn" type="button" onclick="viewMore()" class="view-more"><?=lang('news_6');?></button>
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
    var start = 4;
    function viewMore(){
        $("#loader-holder").show();
        var base_url = "<?=FXPP::ajax_url('news2/all_news')?>";

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
                $('#all_news_btn').remove();
            }
        })
    }
</script>

<script type="text/javascript">
    $(function(){

        var lang = "<?=FXPP::html_url()?>";
        if(lang === 'en'){
            var site_url="<?=FXPP::loc_url('')?>";
        }else{
            var site_url="<?=FXPP::loc_url('')?>"+"/";
        }
        //console.log(site_url+'news/latest_news/');
        $(document).on('click','#latest-news-links .pagination a:not(#curPage)',function(event){
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            // console.log(page);
            $.ajax({
                type: 'POST',
                url: site_url+'news2/latest_news/'+page,
                beforeSend:function(){
                    $('#loader-holder').show();

                },
            }).done(function(response){
                var obj_latest_news = jQuery.parseJSON ( response );
                $('.latest-list-holder .latest-list').remove();
                $('#latest-news-links ul').remove();
                $('#loader-holder').hide();

                $('#latest-news-links div').append(obj_latest_news.links);
                // console.log(obj_latest_news.links);

                var obj = obj_latest_news.latest_news;
                $.each(obj, function(i,value){
                    var latest_list = document.createElement("div");
                    var row = document.createElement("div");
                    var image_holder = document.createElement("div");
                    var image = document.createElement("img");
                    var div_holder = document.createElement("div");
                    var title_holder = document.createElement("h3");
                    var title = document.createElement("a");
                    var title_content = document.createTextNode(value.headline);
                    var content_holder = document.createElement("p");
                    var content = document.createTextNode(value.content);
                    var content_content = $(content).text();
                    var time_date_holder = document.createElement("small");
                    var time_date = document.createTextNode(value.date_published);


                    latest_list.classList.add('latest-list');
                    row.classList.add('row');
                    image_holder.classList.add('col-md-2');
                    image_holder.classList.add('col-sm-2');
                    image_holder.classList.add('col-xs-2');
                    image.classList.add('img-responsive');
                    if(value.file_name === null){
                        image.src = "<?= $this->template->Images()?>sample-news-img.jpg";
                    }else{
                        image.src = "<?= base_url().'assets/news_images/'?>"+value.file_name;
                    }
                    div_holder.classList.add('col-md-10');
                    div_holder.classList.add('col-sm-10');
                    div_holder.classList.add('col-xs-10');
                    div_holder.classList.add('latest-list-info');
                    title.href = "<?=FXPP::ajax_url('news2/article') ?>/"+value.id;
                    title.target = "_blank";

                    //function
                    $('.latest-list-holder').append(latest_list);
                    latest_list.appendChild(row);
                    row.appendChild(image_holder);
                    image_holder.appendChild(image);
                    row.appendChild(div_holder);
                    div_holder.appendChild(title_holder);
                    title_holder.appendChild(title);
                    title.appendChild(title_content);
                    div_holder.appendChild(content_holder);
                    content_holder.innerHTML = content_content.replace(/(<([^>]+)>)/ig,"").substr(0,70)+ '... <a href="<?=FXPP::ajax_url('news2/article') ?>/'+value.id+'/'+value.id2+'">Read More </a>';
                    div_holder.appendChild(time_date_holder);
                    time_date_holder.appendChild(time_date);



                });
            });
        });

//most read

        $(document).on('click','#most-read-links .pagination a:not(#currentPage)',function(event){
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            // console.log(page);
            $.ajax({
                type: 'POST',
                url: site_url+'news2/most_read/'+page,
                beforeSend:function(){
                    $('#loader-holder').show();

                },
            }).done(function(response){
                var obj_most_read = jQuery.parseJSON ( response );
                $('.most-list-holder .latest-list').remove();
                $('#most-read-links ul').remove();
                $('#loader-holder').hide();
                $('#most-read-links div').append(obj_most_read.links);
                // console.log(obj_latest_news.links);

                var obj = obj_most_read.most_read;
                $.each(obj, function(i,value){
                    var latest_list = document.createElement("div");
                    var row = document.createElement("div");
                    var image_holder = document.createElement("div");
                    var image = document.createElement("img");
                    var div_holder = document.createElement("div");
                    var title_holder = document.createElement("h3");
                    var title = document.createElement("a");
                    var title_content = document.createTextNode(value.headline);
                    var content_holder = document.createElement("p");
                    var content = document.createTextNode(value.content);
                    var content_content = $(content).text();
                    var time_date_holder = document.createElement("small");
                    var time_date = document.createTextNode(value.date_published);


                    latest_list.classList.add('latest-list');
                    row.classList.add('row');
                    image_holder.classList.add('col-md-2');
                    image_holder.classList.add('col-sm-2');
                    image_holder.classList.add('col-xs-2');
                    image.classList.add('img-responsive');
                    if(value.file_name === null){
                        image.src = "<?= $this->template->Images()?>sample-news-img.jpg";
                    }else{
                        image.src = "<?= base_url().'assets/news_images/'?>"+value.file_name;
                    }
                    div_holder.classList.add('col-md-10');
                    div_holder.classList.add('col-sm-10');
                    div_holder.classList.add('col-xs-10');
                    div_holder.classList.add('latest-list-info');
                    title.href = "<?=FXPP::ajax_url('news2/article') ?>/"+value.id + '/'+value.id2;
                    title.target = "_blank";

                    //function
                    $('.most-list-holder').append(latest_list);
                    latest_list.appendChild(row);
                    row.appendChild(image_holder);
                    image_holder.appendChild(image);
                    row.appendChild(div_holder);
                    div_holder.appendChild(title_holder);
                    title_holder.appendChild(title);
                    title.appendChild(title_content);
                    div_holder.appendChild(content_holder);
                    content_holder.innerHTML = content_content.replace(/(<([^>]+)>)/ig,"").substr(0,70)+ '... <a href="<?=FXPP::ajax_url('news2/article') ?>/'+value.id+'/'+value.id2+'">Read More </a>';
                    div_holder.appendChild(time_date_holder);
                    time_date_holder.appendChild(time_date);



                });
            });
        });
    });
</script>