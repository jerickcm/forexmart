<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style type="text/css">@media screen and (max-width: 768px){.ceo-letter-holder{margin: 0px;}}</style>');
    });
</script>
<?=lang('ceo') ?>
<div class="ceo-letter-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="ceo-title"><?=lang('ceo_1');?></h1>
            </div>
        </div>
    </div>
</div>
<div class="ceoletter-main-holder">
    <div class="container">
        <div class="row">
            <div class="ceo-letter-holder row">
                <div class="col-md-3">
                    <div class="ceo-info">
                        <img src="<?php echo $this->template->Images();?>ceo.png" class="img-responsive" alt="" />
                        <p class="ceo-name"><?=lang('ceo_2');?></p>
                        <p class="ceo-fx"><?=lang('ceo_3');?><span><?=lang('ceo_4');?></span></p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="ceo-letter-body-2">
                        <p class="greetings"><?=lang('ceo_5');?></p>
                        <p class="letter-body">
                            <span><?=lang('ceo_4');?></span><?=lang('ceo_6');?>
                        </p>
                        <p class="letter-body"><?=lang('ceo_7');?></p>
                        <p class="letter-body"><?=lang('ceo_8');?></p>
                        <p class="closing"><?=lang('ceo_9');?></p>
                        <img src="<?php echo $this->template->Images();?>signature.png" class="ceo-sign" alt="" />
                        <p class="ceo-name"><?=lang('ceo_2');?></p>
                        <p class="ceo-fx"><?=lang('ceo_3');?><span><?=lang('ceo_4');?></span></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ceo-letter-body-2">
                        <div class="letter-line"></div>
                        <p class="letter-body">
                            <?=lang('ceo_10');?>
                        </p>
                        <p class="letter-body">
                            <?=lang('ceo_11');?>
                        </p>
                        <p class="letter-body">
                            <?=lang('ceo_12');?>
                        </p>
                        <p class="letter-body">
                            <?=lang('ceo_13');?><a href="#"><?=lang('ceo_14');?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>