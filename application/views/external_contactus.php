<link href="<?= $this->template->Css()?>contuct_us.css" rel="stylesheet">
<?php
if(IPLoc::Office()){?>
    <link href="<?= $this->template->Css()?>mapstyle-loc.css" rel="stylesheet">
<?php }?>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-contact-us.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title"><?= lang('headerCU');?></h1>
                <p class="contact-text">
                    <?= lang('ConUsDesc');?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('CusSup');?> </p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">support@forexmart.com</span></p>
                            <p><img src="<?= $this->template->Images()?>home/contact-skype.png" class="img-reponsive" width="24" title="Skype" alt="" /> : support_forexmart</p>
                            <p><img src="<?= $this->template->Images()?>home/contact-icq.png" class="img-reponsive" width="24" alt="" /> : 681451744</p>
                            <p><img src="<?= $this->template->Images()?>home/contact-yahoo.png" class="img-reponsive" width="24" title="Yahoo Messenger" alt="" /> :  forexmart_online</p>
                            <p><img src="<?= $this->template->Images()?>home/contact-telegram.png" class="img-reponsive" width="24" title="Telegram" alt="" /> : +357-96789832</p>
                            <p><img src="<?= $this->template->Images()?>home/contact-whatsapp.png" class="img-reponsive" width="24" title="Whatsapp" alt="" /> : +357-96789832</p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">24/5</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('PartDept');?> </p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">partnership@forexmart.com</span></p>
                            <p><img src="<?= $this->template->Images()?>home/contact-skype.png" class="img-reponsive" width="24" title="Skype" alt="" /> : partnership_forexmart</p>
                            <p><img src="<?= $this->template->Images()?>home/contact-icq.png" class="img-reponsive" width="24" alt="" /> : 689665309</p>
                            <p><img src="<?= $this->template->Images()?>home/contact-yahoo.png" class="img-reponsive" width="24" title="Yahoo Messenger" alt="" /> :  forexmart_partnership</p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('FinDept');?> </p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">finance@forexmart.com</span></p>
                            <p><img src="<?= $this->template->Images()?>/home/contact-skype.png" class="img-reponsive" width="24" title="Skype" alt="" /> : finance_forexmart</p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('MarkDept');?> </p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">marketing@forexmart.com</span></p>
                            <p><img src="<?= $this->template->Images()?>/home/contact-skype.png" class="img-reponsive" width="24" title="Skype" alt="" /> : marketing_forexmart</p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('GenInq');?></p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">info@forexmart.com</span></p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('VerfDept');?> </p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">verification@forexmart.com</span></p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?> : <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('BonDept');?> </p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">bonuses@forexmart.com</span></p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="contact-info-holder">
                            <p class="contact-info-title"><?= lang('TradDesk');?></p>
                            <p class="contact-info-text"><?= lang('lbl_email');?>: <span class="company">dealing@forexmart.com</span></p>
                            <p class="contact-info-text"><?=lang('lbl_WorkHr')?>: <span class="company">07:00 - 16:00 GMT</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row countryInfo">
        <div class="container">
            <div class="col-md-9 map-right-container">
                <h1 class="mapTitle"><?= lang('l1');?></h1>
                <div class="map">
                    <div class="locationInfo">
                        <div class="hoverInfo LondonhoverInfo LonInfo">
                            <p><?= lang('l2');?></p>
                            <img alt="Flag" src="<?= $this->template->Images()?>eu-flag.png">
                        </div>
                        <a href="javascript:;" class="map-country-location london-location london-loc">
                            <img src="<?= $this->template->Images()?>london-pin.png" alt="Flag" class="img-responsive"/>
                            <span><?= lang('l3');?></span>
                        </a>
                    </div>
                    <div class="locationInfo">
                        <div class="hoverInfo ParishoverInfo ParInfo">
                            <p><?= lang('l4');?></p>
                            <img src="<?= $this->template->Images()?>eu-flag.png" alt="Flag" >
                        </div>
                        <a href="javascript:;" class="map-country-location paris-location paris-loc">
                            <img src="<?= $this->template->Images()?>paris-pin.png" alt="Flag" class="img-responsive"/>
                            <span><?= lang('l5');?></span>
                        </a>
                    </div>
                    <div class="locationInfo">
                        <div class="hoverInfo BerlinhoverInfo BerInfo">
                            <p><?= lang('l6');?></p>
                            <img src="<?= $this->template->Images()?>eu-flag.png" alt="Flag" >
                        </div>
                        <a href="javascript:;" class="map-country-location berlin-location berlin-loc">
                            <img src="<?= $this->template->Images()?>berlin-pin.png" class="img-responsive" alt="Flag" />
                            <span><?= lang('l7');?></span>
                        </a>
                    </div>
                    <div class="locationInfo">
                        <div class="hoverInfo CyprushoverInfo CyprusInfo">
                            <p><?= lang('l8');?></p>
                            <img src="<?= $this->template->Images()?>eu-flag.png" alt="Flag" >
                        </div>
                        <a href="javascript:;" class="map-country-location cyprus-location cyprus-loc ">
                            <img src="<?= $this->template->Images()?>cyprus-pin.png" class="img-responsive" alt="Flag" />
                            <span><?= lang('l9');?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mapInfo">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">Limassol</h4>
                        <p class="list-group-item-text"><i class="fa fa-phone" style="color: #2988ca;font-size: 17px;"></i> +357 25722774<br><i class="fa fa-map-marker" style="color: #2988ca;font-size: 17px;"></i> Spetson 23A, Leda Court, Block B, Office B203, 4000 Mesa Geitonia, Limassol, Cyprus</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">London</h4>
                        <p class="list-group-item-text"><i class="fa fa-phone" style="color: #2988ca;font-size: 17px;"></i> +44 207 1933 236<br><i class="fa fa-map-marker" style="color: #2988ca;font-size: 17px;"></i> 80-83 Long Lane, London, EC1A 9ET, UK</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">Berlin</h4>
                        <p class="list-group-item-text"><i class="fa fa-phone" style="color: #2988ca;font-size: 17px;"></i> +493088492963<br><i class="fa fa-map-marker" style="color: #2988ca;font-size: 17px;"></i> Kurfurstendamm 23, Charlottenburg, Berlin, 10719, Germany</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">Paris</h4>
                        <p class="list-group-item-text"><i class="fa fa-phone" style="color: #2988ca;font-size: 17px;"></i> +33 970 444 050<br><i class="fa fa-map-marker" style="color: #2988ca;font-size: 17px;"></i> 7, rue de Castellane 75008 Paris, France</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function() {
        $('.cyprus-pin').hover(function() {
            $('.cyprus-info-holder').fadeIn("fast");
        }, function() {
            $('.cyprus-info-holder').fadeOut("fast");
        });
    });
</script>
