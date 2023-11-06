<style type="text/css">/*Thu, 31 Mar 2016 09:05:24 +0000 */
    table.minimum-tab {
        margin-bottom: 0 !important
    }

    .cstm_btn:hover {
        text-decoration: none !important
    }

    .cstm_btn:link {
        text-decoration: none !important
    }

    .cstm_btn:visited {
        text-decoration: none !important
    }

    .cstm_btn:active {
        text-decoration: none !important
    }

    @media screen and (max-width: 320px) {
        .open-dw {
            padding: 7px 14px;
            font-size: 12px
        }

        .open-dw:lang(en) {
            padding: 7px 12px
        }

        .open-dw:lang(ru) {
            padding: 7px 31px
        }

        .open-dw:lang(de) {
            padding: 7px 14px
        }

        .open-dw:lang(fr) {
            padding: 7px 14px
        }
    }



    .column-instruments-profit {
        width:100%;
        margin:30px auto;
    }

    .column-instruments-profit h1 {
        font-family: Georgia;
        font-size: 20px;
        font-weight: 300;
        color: #29A643;
        padding-bottom: 15px;
        width: 100%;
        text-align: center;
    }

    .column-instruments-profit  p {
        font-family: Open Sans;
        font-size: 14px;
        font-weight: 400;
        color: #000;
        text-align: justify;
    }

    .column-instruments-profit img {
        margin:10px auto;
        border-radius:50%;
    }

    .column-instruments-profit span {
        width:80%;
        text-transform:uppercase;
        text-align:center;
        margin:0 auto;
        display:table;
        border:1px solid #29A643;
        padding:7px 5px;
    }
</style>
<div class="reg-form-holder">
<div class="container">
<div class="row">
<div class="col-lg-12">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="license-title"> <?= lang('h-1');?></h1>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="column-instruments-profit">
                            <img src="<?= $this->template->Images()?>trading-terminal.png" width="288" height="288" class="img-responsive"/>
                            <h1> <?= lang('h-2');?></h1>
                            <p><?= lang('p-1');?>
                                </br>
                                </br>
                               <a href="<?=FXPP::www_url('metatrader4')?>"> <span><strong><?= lang('btn-1');?></strong></span></a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="column-instruments-profit">
                            <img src="<?= $this->template->Images()?>pattern-graphix.png" width="288" height="288" class="img-responsive"/>
                            <h1><?= lang('h2-1');?></h1>
                            <p><?= lang('p2-1');?>
                                </br>
                                </br>
                                <a href="http://pattern-graphix.com/en">  <span><strong><?= lang('btn-2');?></strong></span></a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="column-instruments-profit">
                            <img src="<?= $this->template->Images()?>trading-account.png" width="288" height="288" class="img-responsive"/>
                            <h1><?= lang('h3-1');?></h1>
                            <p><?= lang('p3-1');?>
                                </br>
                                </br>
                                <a href="<?=FXPP::www_url('account-type')?>">  <span><strong><?= lang('btn-3');?></strong></span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?= $DemoAndLiveLinks; ?>
</div>
</div>
</div>
</div>