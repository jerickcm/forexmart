<?php $this->lang->load('news');?>

<style type="text/css">
@media only screen and (min-width: 992px) and (max-width: 1999px){
    .london-location {
        left: 249px;
    }
    .paris-location {
        left: 276px;
    }
    .berlin-location {
        left: 350px;
    }
    .cyprus-location {
        bottom: -12px;
        right: 169px;
    }
}
@media only screen and (min-width: 1200px) {
    .cyprus-location{
        right: 269px;
    }
    .CyprushoverInfo{
        right: 185px;
    }
    .london-location{
        left: 350px;
    }
    .LondonhoverInfo {
        left: 268px;
    }
    .berlin-location {
        left: 445px;
    }
    .BerlinhoverInfo {
        left: 361px;
    }
    .paris-location {
        left: 380px;
    }
    .ParishoverInfo {
        left: 296px;
    }
}

    .latest-news {
        display: inline-block !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }

    .recent-list-news {
        padding:0;
        margin:0;
    }

    .recent-list-news li:first-child {
        padding-top:10px;
    }

    .recent-list-news li {
        padding:7px 10px;
        list-style-type:none;
        border-bottom:1px solid #eaeaea;
    }

    .newest-column-news {
        padding:0!important;
    }

    .column-article-header {
        border:1px solid #b8dffa!important;
        background: url(../assets/images/column-header-bg.png) #d3edff!important;
        background-repeat:no-repeat;
    }

    .column-article-image {
        margin:25px 10px 10px 10px!important;
    }

    .carousel .item, .carousel {
        height: auto !important;
        box-shadow: none !important;
        background: none !important;
    }

    .nav > li > a:hover, .nav > li > a:focus {
        background: #eee;
    }


    .news-carousel-holder {
        width:100%;
        margin:20px 0;
        display:table;
    }

    .btn-vertical-slider{ margin:0 auto; cursor:pointer; display:table; color:#2988ca;}
    a {  cursor:pointer;}
    .carousel.vertical .carousel-inner .item {
        -webkit-transition: 0.6s ease-in-out top;
        -moz-transition: 0.6s ease-in-out top;
        -ms-transition: 0.6s ease-in-out top;
        -o-transition: 0.6s ease-in-out top;
        transition: 0.6s ease-in-out top;
    }

    .carousel.vertical .active {
        top: 0;
    }

    .carousel.vertical .next {
        top: 100%;
    }

    .carousel.vertical .prev {
        top: -100%;
    }

    .carousel.vertical .next.left,
    .carousel.vertical .prev.right {
        top: 0;
    }

    .carousel.vertical .active.left {
        top: -100%;
    }

    .carousel.vertical .active.right {
        top: 100%;
    }

    .carousel.vertical .item {
        left: 0;
    }​

</style>
<div class="news-parent-container">
    <div class="container">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ext-arabic-forex-news">
            <div class="forex-news-left-content">
                <div class="forex-news-container  ext-arabic-forex-news-container">
                    <div id="myCarousel-news" class="carousel slide" data-ride="carousel">
                        <h1><?=lang('n_0_1');?></h1>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                        <?php
                            if( count($news_headlines) ){
                                $ctr = 0;
                                foreach( $news_headlines as $key => $value ){

                        ?>
                            <div class="item <?php echo ($ctr == 0) ? 'active' : '' ?>">
                                <div class="forex-news-content">
                                    <a href="<?php echo FXPP::loc_url('news2/article/' . $value['id'].'/'. $news['id2']) ?>" target="_blank"><?php echo $value['headline'] ?></a>
                                    <span><?php echo date('D M j H:i:s e Y', strtotime($value['date_published'])) ?><?php if(!empty( $value['publisher'] )) { ?> | By <a href="javascript:;" class="forex-news-author"><?php echo $value['publisher'] ?></a> <?php echo $value['job'] ?><?php } ?></span>
                                    <p><?php echo $value['summary'] ?></p>
                                    <a href="<?php echo FXPP::loc_url('news2/article/' . $value['id'].'/'. $news['id2']) ?>" class="read-more-button">
                                        <?=lang('n_0_6');?>
                                    </a>
                                </div>
                            </div>
                        <?php
                                    $ctr++;
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="two-column-news latest-news">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newest-column-news">
                        <?php if(count($top_latest_news) > 0){ ?>
                            <div class="column-article-news ext-arabic-column-article-news col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h1><?=lang('n_0_2');?></h1>
                                <?php if(IPLoc::Office()){ ?>
                                    <a href="<?php echo FXPP::www_url('feed/news') ?>" class="rss-icon"></a>
                                <?php } ?>
                                <div class="column-article-header ext-arabic-column-article-header">
                                    <div class="column-article-image ext-arabic-column-article-image">
                                        <img  alt="" src="<?php echo base_url() . 'assets/news_images/' . $top_latest_news['publisher_image'] ?>" width="75px" height="75px"/>
                                </div>
                                    <div class="column-article-information">
                                        <a href="<?php echo FXPP::loc_url('news2/article/' . $top_latest_news['id'].'/'. $top_latest_news['id2']) ?>" target="_blank"><?php echo $top_latest_news['headline'] ?></a>
                                        <span><?php echo date('D M j H:i:s e Y', strtotime($top_latest_news['date_published'])) ?></span>
                                    </div>
                                </div>
                                <div class="column-article-content ext-arabic-column-article-content">
                                    <p><?php echo $top_latest_news['summary'] ?></p>
                                    <a href="<?php echo FXPP::loc_url('news2/article/' . $top_latest_news['id'].'/'. $top_latest_new['id2']) ?>" target="_blank" class="read-more-button"><?=lang('n_0_4');?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <?php if(IPLoc::Office()){ ?>
                <?php if( count($archive_news) > 1 ){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 news-archive">
                    <ul id="ul-archive-news">
                        <?php
                        foreach( $archive_news as $key => $news ){
                        ?>
                        <li>
                            <h1><?php echo $news['headline'] ?></h1>
                            <span><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?></span>
                            <p><?php echo $news['summary'] ?> <a href="<?php echo FXPP::loc_url('news2/article/' . $news['id'].'/'. $news['id2']) ?>"><?=lang('n_0_4');?>...</a></p>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-news-pagination" id="archive-news-pagination">
                    <?php echo $archive_news_page_links ?>
                </div>
                <?php } ?>
                <?php } ?>
                <div class="forex-news-tab-container">
                    <div class="left-tabs-panel-questions">
                        <ul class="nav nav-tabs ext-arabic-nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#latest-news" role="tab" data-toggle="tab"><?=lang('n_0_2');?></a>
                            </li>
                            <li>
                                <a href="#most-read-news" role="tab" data-toggle="tab"><?=lang('n_0_3');?></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="latest-news">
                                <div class="tab-list-of-questions">
                                    <div class="tab-news-list ext-arabic-tab-news-list">
                                        <ul id="ul-latest-news" class="recent-list-news">
                                            <?php
                                            foreach( $latest_news as $key => $news ){
                                                ?>
                                                <li>
                                                    <a href="<?php echo FXPP::loc_url('news2/article/' . $news['id'].'/'. $news['id2']) ?>" target="_blank"><?php echo $news['headline'] ?></a>
                                                    <span><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?><?php if(!empty( $news['publisher'] )) { ?> | By <a href="javascript:;" class="tab-news-author"><?php echo $news['publisher'] ?></a> <?php echo $news['job'] ?><?php } ?></span>
                                                </li>
                                                <?php
                                            }
                                            /**
                                            <li>
                                            <a href="javascript:;">WATCH: Carly Rae Jepsen in Manila concert</a>
                                            <span>Mon Sep 18 18:30:00 GMT 2015 | By <a href="javascript:;" class="tab-news-author">Harvey Sawyer</a> Currency Analyst</span>
                                            </li>
                                            <li>
                                            <a href="javascript:;">PNoy dismayed with anti-88L retired generals</a>
                                            <span>Mon Sep 17 15:22:45 GMT 2015 | By <a href="javascript:;" class="tab-news-author">Sharmaine Deis</a> Writer</span>
                                            </li>
                                            <li>
                                            <a href="javascript:;">UP still top PH university in QS world rankings</a>
                                            <span>Mon Sep 14 21:42:16 GMT 2015 | By <a href="javascript:;" class="tab-news-author">Jimmy Neutron</a> Business Manager</span>
                                            </li>
                                            <li>
                                            <a href="javascript:;">Pangilinan quits as food security chief, eyes Senate seat</a>
                                            <span>Mon Sep 11 06:59:08 GMT 2015 | By <a href="javascript:;" class="tab-news-author">Jenny De Silva</a> Journalist</span>
                                            </li>
                                            <li>
                                            <a href="javascript:;">Asian shares tread water as Fed-meeting looms</a>
                                            <span>Mon Sep 14 14:07:36 GMT 2015 | By <a href="javascript:;" class="tab-news-author">Cabby Sinus</a> Scriptwriter</span>
                                            </li>
                                             */
                                            ?>

                                        </ul>
                                    </div>
                                    <div class="tab-news-pagination" id="latest-news-pagination">
                                        <?php echo $latest_news_page_links ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="most-read-news">
                                <div class="tab-news-list ext-arabic-tab-news-list">
                                    <ul id="ul-most-read-news" class="recent-list-news">
                                        <?php
                                        foreach( $most_read_news as $key => $news ){
                                            ?>
                                            <li>
                                                <a href="<?php echo FXPP::loc_url('news2/article/' . $news['id'].'/'. $article['id2']) ?>" target="_blank"><?php echo $news['headline'] ?></a>
                                                <span><?php echo date('D M j H:i:s e Y', strtotime($news['date_published'])) ?><?php if(!empty( $news['publisher'] )) { ?> | By <a href="javascript:;" class="tab-news-author"><?php echo $news['publisher'] ?></a> <?php echo $news['job'] ?><?php } ?></span>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="tab-news-pagination" id="most-read-news-pagination">
                                    <?php echo $most_read_news_page_links ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 forex-news-right-parent ext-arabic-forex-news">
            <div class="forex-news-right-content" >

                <div class="vertical-logo-holder news-carousel-holder">
                    <div id="myCarousel" class="vertical-slider carousel vertical slide col-md-12" data-ride="carousel" dir="ltr">

                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row">

                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Bank Transfer">
                                            <img  alt="" src="<?= $this->template->Images()?>banktransfer.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>

                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Debit/Credit Cards">
                                            <img  alt="" src="<?= $this->template->Images()?>ccard.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>

                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Skrill">
                                            <img  alt="" src="<?= $this->template->Images()?>skrill.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>


                                </div>
                                <!--/row-fluid-->
                            </div>
                            <!--/item-->
                            <div class="item ">
                                <div class="row">
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Neteller">
                                            <img  alt="" src="<?= $this->template->Images()?>neteller.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Megatransfer">
                                            <img  alt="" src="<?= $this->template->Images()?>megatransfer.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="PayPal">
                                            <img  alt="" src="<?= $this->template->Images()?>paypal.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>

                                </div>
                                <!--/row-fluid-->
                            </div>
                            <!--/item-->
                            <div class="item ">
                                <div class="row">
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="WebMoney">
                                            <img  alt="" src="<?= $this->template->Images()?>webmoney.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="PayCo">
                                            <img  alt="" src="<?= $this->template->Images()?>payco.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                </div>
                                <!--/row-fluid-->
                            </div>
                            <!--/item-->

                        </div>
                    </div>
                </div>

                <div class="vertical-banner">
                    <a href="<?php echo FXPP::loc_url('register');?>" target="_blank" style="outline: none"><img  alt="" src="<?= $this->template->Images()?>banner1.png" width="240" height="400" alt="Forexmart" border="0"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="feats-holder">
    <div class="container">
        <div class="row">
                    <div class="col-xs-12 col-md-12 col-md-12 map-right-container" style="margin-bottom:50px">
                        <h1 class="mapTitle"><?= lang('l1');?></h1>
                            <div class="map">
                                <div class="locationInfo">
                                    <div class="hoverInfo LondonhoverInfo">
                                        <p><?= lang('l2');?></p>
                                        <img  alt="" src="<?= $this->template->Images()?>eu-flag.png">
                                    </div>
                                    <a href="javascript:;" class="map-country-location london-location">
                                        <img  alt="" src="<?= $this->template->Images()?>london-pin.png" class="img-responsive"/>
                                        <span><?= lang('l3');?></span>
                                    </a>
                                </div>
                                <div class="locationInfo">
                                    <div class="hoverInfo ParishoverInfo">
                                        <p><?= lang('l4');?></p>
                                        <img  alt="" src="<?= $this->template->Images()?>eu-flag.png">
                                    </div>
                                    <a href="javascript:;" class="map-country-location paris-location">
                                        <img  alt="" src="<?= $this->template->Images()?>paris-pin.png" class="img-responsive"/>
                                        <span><?= lang('l5');?></span>
                                    </a>
                                </div>
                                <div class="locationInfo">
                                    <div class="hoverInfo BerlinhoverInfo">
                                        <p><?= lang('l6');?></p>
                                        <img  alt="" src="<?= $this->template->Images()?>eu-flag.png">
                                    </div>
                                    <a href="javascript:;" class="map-country-location berlin-location">
                                        <img  alt="" src="<?= $this->template->Images()?>berlin-pin.png" class="img-responsive"/>
                                        <span><?= lang('l7');?></span>
                                    </a>
                                </div>
                                <div class="locationInfo">
                                    <div class="hoverInfo CyprushoverInfo">
                                        <p><?= lang('l8');?></p>
                                        <img  alt="" src="<?= $this->template->Images()?>eu-flag.png">
                                    </div>
                                    <a href="javascript:;" class="map-country-location cyprus-location">
                                        <img  alt="" src="<?= $this->template->Images()?>cyprus-pin.png" class="img-responsive"/>
                                        <span><?= lang('l9');?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="overlappingContainer">
                            <h1 class="mapTitle">Our Location</h1>
                            <div class="mapIndicator target1">
                                <div class="hoverInfo">
                                    <p>Cyprus is a member of EU. All Cyprus companies are under MiFID Regulation</p>
                                    <img  alt="" src="images/eu-flag.png">
                                </div>
                                <a class="countryLocation" href="#">
                                    <img  alt="" src="images/cyprus-pin.png">
                                    <span>Cyprus</span>
                                </a>
                            </div>
                            <div class="mapIndicator target2">
                                <div class="hoverInfo">
                                    <p>Berlin is a member of EU. All Berlin companies are under MiFID Regulation</p>
                                    <img  alt="" src="images/eu-flag.png">
                                </div>
                                <a class="countryLocation" href="#">
                                    <img  alt="" src="images/berlin-pin.png">
                                    <span>Berlin</span>
                                </a>
                            </div>
                            <div class="mapIndicator target3">
                                <div class="hoverInfo">
                                    <p>Paris is a member of EU. All Paris companies are under MiFID Regulation</p>
                                    <img  alt="" src="images/eu-flag.png">
                                </div>
                                <a class="countryLocation" href="#">
                                    <img  alt="" src="images/paris-pin.png">
                                    <span>Paris</span>
                                </a>
                            </div>
                            <div class="mapIndicator target4">
                                <div class="hoverInfo">
                                    <p>London is a member of EU. All London companies are under MiFID Regulation</p>
                                    <img  alt="" src="images/eu-flag.png">
                                </div>
                                <a class="countryLocation" href="#">
                                    <img  alt="" src="images/london-pin.png">
                                    <span>London</span>
                                </a>
                            </div>
                        </div>  -->
                    </div>
            <?= $this->load->ext_view('modal', 'PaymentSystemCarousel', '', TRUE); ?>

        </div>
    </div>
</div>
<script language="JavaScript" type="text/javascript">

    $(document).ready(function () {

        $('.btn-vertical-slider').on('click', function () {

            if ($(this).attr('data-slide') == 'next') {
                $('#myCarousel').carousel('next');
            }
            if ($(this).attr('data-slide') == 'prev') {
                $('#myCarousel').carousel('prev')
            }

        });
    });

    var baseURL = '<?php echo FXPP::loc_url() ?>';
    jQuery(document).on('click', '.latest-page a', function(e){
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "news2/updateLatestPage/" + cur_page,
            data: {cur_page : cur_page},
            dataType: 'JSON',
            cache: false,
            success: function(page) {
//                jQuery('#updatesCurrentPage').val(cur_page);
                jQuery('#ul-latest-news').html(page.html_data);
                jQuery('#latest-news-pagination').html(page.html_page_links);
                //console.log(page);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });

    jQuery(document).on('click', '.most-read-page a', function(e){
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "news2/updateMostReadPage/" + cur_page,
            data: {cur_page : cur_page},
            dataType: 'JSON',
            cache: false,
            success: function(page) {
//                jQuery('#updatesCurrentPage').val(cur_page);
                jQuery('#ul-most-read-news').html(page.html_data);
                jQuery('#most-read-news-pagination').html(page.html_page_links);
                //console.log(page);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });
    <?php if(IPLoc::Office()){ ?>
    jQuery(document).on('click', '.archive-page a', function(e){
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('<?php echo $top_latest_news['id'] ?>/') + <?php echo strlen($top_latest_news['id'] . '/') ?>);

        jQuery.ajax({
            type: "POST",
            url: baseURL + "news2/updateArchivePage/<?php echo $top_latest_news['id'] ?>/" + cur_page,
            data: {cur_page : cur_page},
            dataType: 'JSON',
            cache: false,
            success: function(page) {
//                jQuery('#updatesCurrentPage').val(cur_page);
                jQuery('#ul-archive-news').html(page.html_data);
                jQuery('#archive-news-pagination').html(page.html_page_links);
                //console.log(page);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });
    <?php } ?>
</script>
