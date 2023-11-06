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
    <!-- Bootstrap Core CSS -->
    <!--<link rel="stylesheet" href="<?/*= $this->template->Css()*/?>style.css" type="text/css"/>
    <link rel="stylesheet" href="<?/*= $this->template->Css()*/?>vallenato.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="<?/*= $this->template->Css()*/?>bootstrap-vertical-tabs.css">
    <link rel="stylesheet" href="<?/*= $this->template->Css()*/?>bootstrap.css">-->
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>external-style.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>font-awesome.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>exscrolling-nav.css" rel="stylesheet">
    <?=(isset($template['metadata_css']))? $template['metadata_css']: '';?>


    <?=(isset($template['metadata_js']))? $template['metadata_js']: '';?>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="web-login-main">
    <div class="web-login-header">
        <div class="web-logo-holder">
            <img src="<?= $this->template->Images()?>fxlogo-light.png" class="img-responsive web-logo img-top-space">
        </div>
    </div>
    <div class="web-login-holder">
        <div class="container">

            <?=(isset($template['body']))?$template['body']: ''; ?>
        </div>
    </div>
</div>


</body>

</html>



