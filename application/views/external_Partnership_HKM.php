<script src="<?= $this->template->Js() ?>jquery-1.11.3.min.js"></script>

    <style type="text/css">
        .thumb_overlay:after {
            content: '<?=lang('hkm_15');?>';
            position: absolute;
            left: 3rem;
            bottom: 2.75rem;
            transition: 0.3s;
            opacity: 1;
            font-family: Open Sans;
        }
    </style>

<script type="text/javascript">
    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 95) {
            $('#nav').addClass('nav-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
        }
    });

    $(document).ready(function() {
        $('.fancybox').fancybox();
    });

    $(document).ready(function () {
        var page_link = $('.page-link');
        page_link.mouseover(function () {
            $($(this).data('target')).fadeIn("fast");

        });
        page_link.mouseleave(function () {
            $($(this).data('target')).fadeOut("fast");
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-partnership-hmk.css' type='text/css'  />"));
    });
</script>

<div class="reg-form-holder">
    <div class="partner-hkm-background">
        <div class="container">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 partner-hkm-title">
                <h2 class="animated bounceInLeft"><?=lang('hkm_00')?></h2>
                <div class="hkm-btn-holder animated fadeInUp">
                    <a href="<?php echo FXPP::loc_url('register')?>"><?=lang('hkm_02')?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 secondary-partner-hkm-title">
            <h2 class="animated bounceInLeft"><?=lang('hkm_01')?></h2>
            <div class="hkm-btn-holder animated fadeInUp">
                <a href="<?php echo FXPP::loc_url('register')?>"><?=lang('hkm_02')?></a>
            </div>
        </div>
    </div>

    <div class="hkm-content-holder">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ru-ext-margin">
                    <h2 class="hkm-content-header"><?=lang('hkm_03')?></h2>
                    <div class="partner-logo-holder">

                        <?php
//                            if(FXPP::html_url() == 'ru')
//                            {
//                                echo '<img src="'.$this->template->Images().'/fxlogonew-russian-hkm.png" class="img-responsive main-logo">';
//                            }
//                            else{
//                                echo '<img src="'.$this->template->Images().'/fx-hkm-logo.png" class="img-responsive main-logo">';
//                            }

                            echo '<img src="'.$this->template->Images().'fx-hkm-logo.png" class="img-responsive main-logo" alt="" />';

                        ?>
                    </div>
                    <p class="hkm-content-text">
                        <?=lang('hkm_04')?>
                    </p>
                    <p class="hkm-content-text">
                        <?=lang('hkm_05')?>
                    </p>
                    <p class="hkm-content-text">
                        <?=lang('hkm_06')?>
                    </p>
                    <p class="hkm-content-text"><?=lang('hkm_07')?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hkm-msg-parent-holder">
                    <div class="hkm-msg-holder">
                        <p>
                            "<?=lang('hkm_08')?>"
                            <span>- <?=lang('hkm_09')?></span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hkm-msg-parent-holder">
                    <div class="hkm-msg-holder">
                        <p>
                            "<?=lang('hkm_10')?>"
                            <span>- <?=lang('hkm_11')?></span>
                        </p>
                    </div>
                </div>


                <div class="col-md-12">
                    <p class="hkm-content-text">
                        <?=lang('hkm_12')?>
                    </p>
                    <p class="hkm-content-text">
                        <?=lang('hkm_13')?>
                    </p>
                </div>

                <div class="col-md-6 gallery-main-holder hkm-gallery-main-holder">
                    <h2 class="hkm-content-header text-left"><?=lang('hkm_13')?></h2>
                    <ul class="gallery-list">
                        <li>
                            <a class="fancybox thumb" href="<?= $this->template->Images() ?>hkm/hkm-slideimg-1.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png"  alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-2.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png"  alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-3.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-4.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-5.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-6.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-7.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-8.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-9.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-10.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-11.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="fancybox thumb none" href="<?= $this->template->Images() ?>/hkm/hkm-slideimg-12.png" data-fancybox-group="gallery">
                                <img src="<?= $this->template->Images() ?>hkm-slideimg-0.png" alt="" />
                                <span class="thumb_overlay"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $data['log']=array(
        'ip'=>$_SERVER['REMOTE_ADDR'],
        'referrer'=>$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
        'date' => date("Y-m-d H:i:s")
    );
    $this->general_model->insertmy($table="team_page_logs",$data['log']);
?>