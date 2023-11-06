<?php $this->lang->load('news');?>

<style type="text/css">
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
                <?php /*
                <div class="forex-news-container  ext-arabic-forex-news-container">
                    <div id="myCarousel-news" class="carousel slide" data-ride="carousel">
                        <h1><?=lang('a_0_1');?></h1>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                        <?php
                            if( count($analysis_headlines) ){
                                $ctr = 0;
                                foreach( $analysis_headlines as $key => $value ){

                        ?>
                            <div class="item <?php echo ($ctr == 0) ? 'active' : '' ?>">
                                <div class="forex-news-content">
                                    <a href="<?php echo base_url('news/article/' . $value['id']) ?>" target="_blank"><?php echo $value['headline'] ?></a>
                                    <span><?php echo date('D M j H:i:s e Y', strtotime($value['date_created'])) ?><?php if(!empty( $value['publisher'] )) { ?> | By <a href="javascript:;" class="forex-news-author"><?php echo $value['publisher'] ?></a> <?php echo $value['job'] ?><?php } ?></span>
                                    <p><?php echo $value['summary'] ?></p>
                                    <a href="<?php echo base_url('news/article/' . $value['id']) ?>" class="read-more-button">
                                        <?=lang('a_0_6');?>
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
                */ ?>
                <div class="two-column-news latest-news">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newest-column-news">
                        <?php if(count($top_latest_analysis) > 0){ ?>
                            <div class="column-article-news ext-arabic-column-article-news col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h1><?=lang('a_0_7');?></h1>
                                <a href="<?php echo FXPP::www_url('feed/analysis') ?>" class="rss-icon"></a>
                                <div class="column-article-header ext-arabic-column-article-header">
                                    <div class="column-article-image ext-arabic-column-article-image">
                                        <img src="<?php echo base_url() . 'assets/analysis_images/' . $top_latest_analysis['publisher_image'] ?>" width="75px" height="75px"/>
                                    </div>
                                    <div class="column-article-information">
                                        <a href="<?php echo base_url('analysis/article/' . $top_latest_analysis['id']) ?>" target="_blank"><?php echo $top_latest_analysis['headline'] ?></a>
                                        <span><?php echo date('D M j H:i:s e Y', strtotime($top_latest_analysis['date_created'])) ?></span>
                                    </div>
                                </div>
                                <div class="column-article-content ext-arabic-column-article-content">
                                    <p><?php echo $top_latest_analysis['summary'] ?></p>
                                    <a href="<?php echo base_url('analysis/article/' . $top_latest_analysis['id']) ?>" target="_blank" class="read-more-button"><?=lang('a_0_4');?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <?php if( count($archive_analysis) > 1 ){ ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 analysis-archive">
                        <ul id="ul-archive-analysis">
                            <?php
                            foreach( $archive_analysis as $key => $analysis ){
                                ?>
                                <li>
                                    <h1><?php echo $analysis['headline'] ?></h1>
                                    <span><?php echo date('D M j H:i:s e Y', strtotime($analysis['date_created'])) ?></span>
                                    <p><?php echo $analysis['summary'] ?> <a href="<?php echo base_url('analysis/article/' . $analysis['id']) ?>">Read More...</a></p>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="tab-news-pagination" id="archive-analysis-pagination">
                        <?php echo $archive_analysis_page_links ?>
                    </div>
                <?php } ?>
                <div class="forex-news-tab-container">
                    <div class="left-tabs-panel-questions">
                        <ul class="nav nav-tabs ext-arabic-nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#latest-news" role="tab" data-toggle="tab"><?=lang('a_0_2');?></a>
                            </li>
                            <li>
                                <a href="#most-read-news" role="tab" data-toggle="tab"><?=lang('a_0_3');?></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="latest-news">
                                <div class="tab-list-of-questions">
                                    <div class="tab-news-list ext-arabic-tab-news-list">
                                        <ul id="ul-latest-news" class="recent-list-news">
                                            <?php
                                            foreach( $latest_analysis as $key => $analysis ){
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url('analysis/article/' . $analysis['id']) ?>" target="_blank"><?php echo $analysis['headline'] ?></a>
                                                    <span><?php echo date('D M j H:i:s e Y', strtotime($analysis['date_created'])) ?><?php if(!empty( $analysis['publisher'] )) { ?> | By <a href="javascript:;" class="tab-news-author"><?php echo $analysis['publisher'] ?></a> <?php echo $analysis['job'] ?><?php } ?></span>
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
                                        <?php echo $latest_analysis_page_links ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="most-read-news">
                                <div class="tab-news-list ext-arabic-tab-news-list">
                                    <ul id="ul-most-read-news" class="recent-list-news">
                                        <?php
                                        foreach( $most_read_analysis as $key => $analysis ){
                                            ?>
                                            <li>
                                                <a href="<?php echo base_url('analysis/article/' . $analysis['id']) ?>" target="_blank"><?php echo $analysis['headline'] ?></a>
                                                <span><?php echo date('D M j H:i:s e Y', strtotime($analysis['date_created'])) ?><?php if(!empty( $analysis['publisher'] )) { ?> | By <a href="javascript:;" class="tab-news-author"><?php echo $analysis['publisher'] ?></a> <?php echo $analysis['job'] ?><?php } ?></span>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="tab-news-pagination" id="most-read-news-pagination">
                                    <?php echo $most_read_analysis_page_links ?>
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
                                            <img src="<?= $this->template->Images()?>banktransfer.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>

                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Debit/Credit Cards">
                                            <img src="<?= $this->template->Images()?>ccard.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>

                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Skrill">
                                            <img src="<?= $this->template->Images()?>skrill.png" class="img-reponsive" width="150px">
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
                                            <img src="<?= $this->template->Images()?>neteller.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Megatransfer">
                                            <img src="<?= $this->template->Images()?>megatransfer.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="PayPal">
                                            <img src="<?= $this->template->Images()?>paypal.png" class="img-reponsive" width="150px">
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
                                            <img src="<?= $this->template->Images()?>webmoney.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="PayCo">
                                            <img src="<?= $this->template->Images()?>payco.png" class="img-reponsive" width="150px">
                                        </a>
                                    </div>
                                    <div class="vertical-logo-item">
                                        <a href="javascript:;" title="Paysera">
                                            <img src="<?= $this->template->Images()?>paysera.png" class="img-reponsive" width="150px">
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
                    <a href="javascript:;" target="_blank" style="outline: none"><img src="<?= $this->template->Images()?>banner1.png" width="240" height="400" alt="Forexmart" border="0"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="feats-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ext-arabic-w-map">
                <h1 class="map-title ext-arabic-map-title">Our Location</h1>
                <img src="<?= $this->template->Images()?>home/wm.png" alt="map" class="img-responsive" class="map">

                <div class="cyprus  ext-arabic-cyprus" id="indonesia">
                    <div id="cyprus-holder" class="hover-holder">
                        <div class="hover-content"><p>Cyprus is a member of EU. All Cyprus companies are under MiFID regulation.</p></div>
                        <img src="<?= $this->template->Images()?>home/contact-eu-flag.png" width="150px">
                    </div>
                    <a id="cy" href="#" class="cy">
                        <img src="<?= $this->template->Images()?>home/cyprus-pin.png" width="50px" class="img-tooltip">
                    </a>
                    <p>Cyprus</p>
                </div>
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
            url: baseURL + "analysis/updateLatestPage/" + cur_page,
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
            url: baseURL + "analysis/updateMostReadPage/" + cur_page,
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
    <?php if($top_latest_analysis){?>
    jQuery(document).on('click', '.archive-page a', function(e){
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('<?php echo $top_latest_analysis['id'] ?>/') + <?php echo strlen($top_latest_analysis['id'] . '/') ?>);

        jQuery.ajax({
            type: "POST",
            url: baseURL + "analysis/updateArchivePage/<?php echo $top_latest_analysis['id'] ?>/" + cur_page,
            data: {cur_page : cur_page},
            dataType: 'JSON',
            cache: false,
            success: function(page) {
//                jQuery('#updatesCurrentPage').val(cur_page);
                jQuery('#ul-archive-analysis').html(page.html_data);
                jQuery('#archive-analysis-pagination').html(page.html_page_links);
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
