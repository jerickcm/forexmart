<!DOCTYPE html>
<html lang="en">
<?php $class = $this->router->class; ?>
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
    <link rel="stylesheet" href="<?= $this->template->Css()?>style.css" type="text/css"/>
    <link rel="stylesheet" href="<?= $this->template->Css()?>vallenato.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="<?= $this->template->Css()?>bootstrap-vertical-tabs.css">
    <link rel="stylesheet" href="<?= $this->template->Css()?>bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?= $this->template->Js()?>bootstrap.min.js"></script>
    <script src="<?= $this->template->Js()?>vallenato.js" type="text/javascript" charset="utf-8"></script>

    <?=(isset($template['metadata_js']))? $template['metadata_js']: '';?>
    

</head>


<body>
<style>
    .logginright {
        float: right;
        padding: 10px 0px 0px 10px;
        height: 80%;
        margin-right: 27px;
    }
    .popdiv{
        padding: 5px;
        margin-left: 40px;
        /*width: 203px!important;*/
        right: 7px;
        font-size;15px;
        color: #000000!important;
    }
    .popdiv:hover{
        background: #b9defb;
    }
    .tab-content > .active {
        display: table;
        width:100%;
        background:#fff;
        border: 1px solid #e3e3e3 !important;
    }
    .right-tab-content {
        min-height:849px;
    }
    .logo-header , .main-navigation {
        width: 250px;
    }
    .main-container{
        margin-right: 0;
    }
    .tab-title-header h1{
        margin-left: 30px;
    }
    .hdr_right{
        position: relative;
    }

</style>
        <div class="main-header">
            <div class="logo-header" style="float: left">
                <img src="<?= $this->template->Images()?>logo.png" width="230" height="50" alt="ForexMart Logo"/>
            </div>
            <div class="logginright">
                <div class="hdr_right">
                <b class="lavator">
                    <img src="<?= $this->template->Images()?>web-login-avatar.png" style="width: 30px; height: 30px;"/>
                </b>
                <a class="nameAvatar"><?=$this->session->userdata('full_name');?> </a>
                <img src="<?= $this->template->Images()?>dropdown_icon.gif" class="downimg"/>
                </div>
                <div class="popdiv">
                <a href="<?=site_url('Signout')?>" style="text-decoration: none;color:#000;font-size: 15px;"> Log out</a>
                 </div>
            </div>
           
        </div>

        <div class="main-wrapper">
            <div class="main-navigation">
                <?php include_once('sidelink.php') ?>
            </div>
            <div class="main-container">
                <?php //include_once('manage_account_nav.php') ?>
                <div class="tab-content right-tab-content">
                          <?=(isset($template['body']))?$template['body']: ''; ?>
                 </div>
             </div>
            <?php /*include_once('footer.php') */?>
        </div>

                    <!-- content -->
        <div id="loader-holder" class="loader-holder">
            <div class="loader">
                <div class="loader-inner ball-pulse">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <!-- content -->



                    <!-- jQuery -->

</body>

</html>


<style>

.downimg{color: red; float: left; margin-left: 5px; margin-top: 8px; cursor: pointer}    
.nameAvatar{float: left; width: auto; height: 26px; padding-top: 5px; text-align: center;margin: 0 10px;}    
.logginright{float: right;padding: 10px 0px 0px 10px; height: 80%; margin-right: 27px;}
.lavator{border: 1px solid #ccc;
    float: left;
    height: 30px;
    margin-right: 6px;
    width: 30px;}    
.popdiv{ background: white none repeat scroll 0 0;
    border: 1px solid #ccc;
    display: none;
    float: right;
    /*height: 28px;*/
    margin-top: 33px;
    /*padding-top: 10px;*/
    position: absolute;
    text-align: center;
    width: 135px;
    z-index: 2147483647 !important;} 
.popdiv a:hover{color: blue; }

.loader-holder {
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 9999;
    background: rgba(0,0,0,0.8);
    top: 0;
    left: 0;
    display: none;
}
.loader {
    margin-left: 47%;
    margin-top: 20%;
}
.tr-msg{text-align: center}


</style>

<style>
    .open-content{display: block}
    .active-header1 , .active-header1:hover , .inactive-header1:hover {
        background:#0c6eb2;
        color: #fff;
        font-weight:normal;
        text-shadow:none;
        border-bottom:1px solid #085e9a;
    }
    .open-content1{display: block}
    .tab-input-form1 {
        padding: 7px 10px!important;
    }
    .tab-input-form1 {
        color: #555;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    }
    .tab-input-form1, .tab-select-form {
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }

</style>
<link rel="stylesheet" href="<?= $this->template->Css()?>loaders.css">
<script type="text/javascript">
    $(document).on("click",".downimg",function(){
        $(".popdiv").toggle();
    });

    $(document).ready(function(){
        $("#check-phone-password").removeClass('tab-pane');
    });

</script>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>