
<script>
    $(document).ready(function() {
        $('#image-gallery').lightSlider({
            gallery:true,
            item:1,
            thumbItem:9,
            slideMargin: 0,
            speed:1000,
            auto:true,
            loop:true,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });
    });
</script>

<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title license-title-las-palmas-page  ext-arabic-license-title">
                    <?= lang('x_lp_t') ?>
                </h1>
                <div class="palmas-main-img">
                    <img src="<?= $this->template->Images()?>laspalmas/udlaspalmas-updated-picture.png" alt="" class="img-responsive">
                    <h1 class="img-label">
                        <?= lang('x_lp_n') ?>
                    </h1>
                </div>
       
                <p class="license-text">
                    <?= lang('x_lp_1') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_2') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_3') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_4') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_5') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_6') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_7') ?>
                </p>
                <p class="license-text">
                    <?= lang('x_lp_8') ?>
                </p>
                <div class="col-md-12" dir="ltr">
                    <div class="demo-slide">
                        <div class="item">
                            <div class="clearfix cf" style="position: relative; max-width: 550px;  margin: 0 auto; margin-top: 20px;">

                                <div style="position: absolute; left: 0;top: 0; z-index: 1000;">
                                    <img src="<?= $this->template->Images()?>watermark_laspalmas1.png" alt=""  style="width:100%;height: auto;display: block;" >
                                </div>
                                
                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden" style=" height: auto!important;">
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp1.jpg">

                                        <img  src="<?= $this->template->Images()?>laspalmas2/lp1.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp2.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp2.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp3.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp3.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp4.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp4.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp5.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp5.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp6.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp6.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp7.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp7.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp8.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp8.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp9.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp9.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp10.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp10.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>

                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp11.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp11.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp12.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp12.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp13.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp13.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp14.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp14.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp15.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp15.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp16.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp16.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp17.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp17.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp18.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp18.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp19.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp19.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp20.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp20.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>

                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp21.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp21.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp22.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp22.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp23.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp23.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                    <li data-thumb="<?= $this->template->Images()?>laspalmas2/lp24.jpg">
                                        <img src="<?= $this->template->Images()?>laspalmas2/lp24.jpg" alt="" style=" height: auto;"  class="img-responsive slidepic"/>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div><div class="clearfix"></div>
                <?= $DemoAndLiveLinks; ?>
            </div>
            <div class="col-lg-12">

            </div>
        </div>
    </div>
</div>
