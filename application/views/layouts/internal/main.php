<?php $class = $this->router->class; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="description" content="<?=(isset($metadata_description))? $metadata_description: '';?>">
    <meta name="keywords" content="<?=(isset($metadata_keyword))? $metadata_keyword: '';?>">

    <link rel="icon" type="image/gif" href="<?= $this->template->Images()?>icon.ico" />

    <title><?php echo $template['title']; ?></title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:700,300,600,400" rel="stylesheet" type="text/css">
    <link href="<?= $this->template->Fonts()?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->template->Css()?>bootstrap.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>internal.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>style.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>custom.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>carousel.css" rel="stylesheet">
    <?=(isset($template['metadata_css']))? $template['metadata_css']: '';?>
    <!-- jQuery -->
    <script src="<?= $this->template->Js()?>jquery.js"></script>
    <!-- Custom CSS -->
    <link href="<?= $this->template->Css()?>scrolling-nav.css" rel="stylesheet">
    <!-- Custom CSS -->

    <!-- Owl Carousel Assets -->
    <link href="<?= $this->template->Css()?>owl.carousel.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>owl.theme.css" rel="stylesheet">

    <!-- Prettify -->
    <link href="<?= $this->template->Css()?>prettify.css" rel="stylesheet">

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
    <style>
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
    </style>
    <?=(isset($template['metadata_js']))? $template['metadata_js']: '';?>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Google Tag Manager FXPP-2771 -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KHXDKN"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KHXDKN');</script>
<!-- End Google Tag Manager -->

<?php include_once('nav.php') ?>

<div class="main-content">
    <div class="container">

<!--        internal content-->
        <div class="row">

<!--            internal sidebar-->
            <?php include_once('sidebar.php') ?>
<!--            end internal sidebar-->

            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="section">

<!--                    content navigation-->
                    <?php include_once('content_nav.php') ?>
<!--                    end content navigation-->

<!--                    dynamic content-->
                    <?=(isset($template['body']))?$template['body']: ''; ?>
<!--                    end dynamic content-->

                </div>
            </div>
            <div class="col-lg-12" style="border-top: 1px solid #ccc;">
            </div>
        </div>
<!--        end internal content-->

<!--        bottom nav-->
        <?php include_once('bottom_nav.php') ?>
<!--        end bottom nav-->

    </div>
</div>

<!--  start modal -->
<?php include_once('modal_feedback.php') ?>
<!--  end modal -->

<!-- footer -->
<?php include_once('footer.php') ?>
<!-- end footer -->
<a href="#" class="cd-top cd-is-visible cd-fade-out">Top</a>
<!-- mainright -->
<?php include_once('mainright.php') ?>
<!-- mainright -->

<!-- Bootstrap Core JavaScript -->
<script src="<?= $this->template->Js()?>bootstrap.min.js"></script>

<!-- Scrolling Nav JavaScript -->
<script src="<?= $this->template->Js()?>jquery.easing.min.js"></script>
<script src="<?= $this->template->Js()?>scrolling-nav.js"></script>

<script src="<?= $this->template->Js()?>owl.carousel.js"></script>
<script src="<?= $this->template->Css()?>owl.transitions.css"></script>
<!--scroll button at right bottom corner-->
<script src="<?= $this->template->Js()?>scrolltotop.min.js"></script>
<!--scroll button at right bottom corner-->
<!-- Demo -->

<style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
</style>


<script>
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({
            items : 4,
            lazyLoad : true,
            navigation : true
        });

    });
</script>
<?=(isset($template['metadata']))?$template['metadata']: ''; ?>
</body>

</html>
