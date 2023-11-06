<!DOCTYPE html>
<html lang="en" dir="ltr" style=" margin-top: -10px">
<head>
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>external-style.min.css" rel="stylesheet">
    <script src="<?= $this->template->Js()?>jquery.min.js" type="text/javascript"></script>
</head>
<style type="text/css">
    .news-quotes {
        width: <?php echo $width ?>px !important;
        height: <?php echo $height ?>px !important;
    }
    .quotes {
        width: <?php echo $width ?>px !important;
        height: <?php echo $height ?>px !important;
    }

    .news-bg-header {
        color: <?php echo $header_color ?> !important;
        background-color: <?php echo $bg_header ?> !important;
        font-size: <?php echo $header_size ?> !important;
        text-align: <?php echo $header_align ?> !important;
    }

    .news-bg-date {
        color: <?php echo $date_color ?> !important;
        font-size: <?php echo $date_size ?> !important;
        font-family: <?php echo $date_font ?> !important;
    }

    .news-bg-text {
        color: <?php echo $text_color ?> !important;
        font-family: <?php echo $text_font ?> !important;
    }

    .news-read-more-link {
        color: <?php echo $date_color ?> !important;
    }

    .news-bg-body {
        background-color: <?php echo $bg_body ?> !important;
    }



    .news-bg-footer, .news-bg-page li.ilatest-page {
        color: <?php echo $footer_color ?> !important;
        background-color: <?php echo $bg_body ?> !important;
        font-family: <?php echo $footer_font ?> !important;
    }

    li.news-bg-page-active {
        color: <?php echo $bg_body ?> !important;
        background-color: <?php echo $footer_color ?> !important;
        font-family: <?php echo $footer_font ?> !important;
    }
    .news-bg-footer{
        color: <?php echo $footer_color ?> !important;
        background-color: <?php echo $bg_footer ?> !important;
        font-family: <?php echo $footer_font ?> !important;
    }
    .pagination {

        margin: 20px 0 0px 0px!important; ;

    }
</style>
<body style="background:none">
<div class="quotes news-quotes">
    <div class="panel panel-default news-bg-body">
        <div class="panel-heading quotes-heading">
            <img src="<?= $this->template->Images()?>logo.png" class="informer-logo">
        </div>
        <h5 class="comp-news-sub news-bg-header">
            Company News
        </h5>
        <div id="news_data" class="news-bg-body">
            <?php foreach ($latest_news as $key => $news) { ?>
                <div class="forexnews-holder">
                    <p class="news-date news-bg-date"><?php echo date('Y-m-d H:i', strtotime($news['date_created'])) ?></p>

                    <h2 class="forexnews-text news-bg-text">
                        <?php echo $news['headline'] ?>
                    </h2>
                    <a target="_blank" href="<?php echo base_url('news/article/' . $news['id']) ?>" class="forexnews-more news-read-more-link">Read
                        More</a>

                    <div class="clearfix"></div>
                </div>
            <?php } ?>
        </div>
        <div class="news-page-holder" id="news_pagination">
            <?php echo $latest_news_page_links ?>
        </div>
        <div class="panel-footer quotes-footer news-bg-footer">Powered by ForexMart</div>
    </div>
</div>

<script type="text/javascript">
    var baseURL = '<?php echo FXPP::loc_url() ?>';
    jQuery(document).on('click', '.latest-page a', function (e) {
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "partnership/updateNewsLatestPage/" + cur_page,
            data: {cur_page: cur_page},
            dataType: 'JSON',
            cache: false,
            success: function (page) {
//                jQuery('#updatesCurrentPage').val(cur_page);

                jQuery('#news_data').html(page.html_data);
                jQuery('#news_pagination').html(page.html_page_links);
               // console.log(page);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });
</script>
</body>
</html>