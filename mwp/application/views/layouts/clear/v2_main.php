<?php $class = $this->router->class; ?>
<!DOCTYPE html>
<html lang="en" class="<?=$class_def=$class_def!='default-forgot-pass-background'?'default-login-background':'default-forgot-pass-background';?>">
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
    <?=(isset($template['metadata_css']))? $template['metadata_css']: '';?>
    <?=(isset($template['metadata_js']))? $template['metadata_js']: '';?>
    <link rel="icon" type="image/gif" href="<?= $this->template->Images()?>icon.ico" />
    <title><?= $template['title']; ?></title>
    <link href="<?= $this->template->Css()?>font-awesome.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>exscrolling-nav.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= $this->template->Css()?>uikit.min.css" />
    <link rel="stylesheet" href="<?= $this->template->Css()?>v2_clear_style.css" />
    <script src="<?= $this->template->Js()?>jquery-3.1.1.min.js"></script>
    <script src="<?= $this->template->Js()?>uikit.min.js"></script>
    <script src="<?= $this->template->Js()?>uikit-core.min.js"></script>
</head>
<body>
<div class="uk-container style-form-main-container">
    <div class="style-form-container">
        <?=(isset($template['body']))?$template['body']: ''; ?>
    </div>
</div>
</body>
</html>