<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $template['title']; ?></title>
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css()?>copytrading/customize.css" rel="stylesheet">
    <script type="text/javascript" src="<?= $this->template->Js()?>jquery.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="row-fluid">
        <div class="container">
            <a href="#" ><img src="<?= $this->template->Images()?>copytrading/logo.png" class="logo"></a>
        </div>
    </div>
</nav>

<?=(isset($template['body']))?$template['body']: ''; ?>

<div class="footer-bottom">
    <div class="container copyright">
        <p > &copy; 2015. All Rights Reserved</p>
    </div>
</div>
<script type="text/javascript" src="<?= $this->template->Js()?>jquery.js"></script>
<script type="text/javascript" src="<?= $this->template->Js()?>bootstrap.min.js"></script>
</body>
</html>