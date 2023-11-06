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
    <title><?= $template['title']; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link href="<?= $this->template->Fonts()?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>internal-style.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>custom-administration.min.css" rel="stylesheet">
    <script src="<?= $this->template->Js()?>jquery-1.11.3.min.js"></script>

    <!-- Custom CSS -->
    <link href="<?= $this->template->Css()?>inscrolling-nav.css" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="<?= $this->template->Css()?>owl.carousel.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>owl.theme.css" rel="stylesheet">

    <!-- Prettify -->

    <link rel="stylesheet" href="<?= $this->template->Css()?>jquery.switchButton.css">
    <link rel="stylesheet" href="<?= $this->template->Css()?>jquery.fileupload.css">

    <!-- Preloader -->
    <link rel="stylesheet" href="<?= $this->template->Css()?>loaders.css"/>

    <?=(isset($template['metadata_css']))? $template['metadata_css']: '';?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <style>
        .navbar-brand-internal{
            min-height: 50px !important;
            margin-top: 6px;
            padding: 0px;
            margin-bottom: 4px;
        }
        }
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


</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <?php include_once('nav.php') ?>
    <?php include_once('internal_nav.php') ?>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <!-- content -->
                <?=(isset($template['body']))?$template['body']: ''; ?>
                <!-- end content -->
                <div class="col-lg-12 border-bottom-line"></div>
            </div>
        </div>
    </div>
    <?php include_once('bottom_nav.php') ?>
    <?php include_once('footer.php') ?>
    <a href="#" class="cd-top cd-is-visible cd-fade-out">Top</a>


<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="<?= $this->template->Js()?>bootstrap.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<!-- Scrolling Nav JavaScript -->
<script src="<?= $this->template->Js()?>jquery.easing.min.js"></script>
<script src="<?= $this->template->Js()?>scrolling-nav.js"></script>
<!--scroll button at right bottom corner-->
<script src="<?= $this->template->Js()?>scrolltotop.min.js"></script>
<!--scroll button at right bottom corner-->

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
</body>

</html>
