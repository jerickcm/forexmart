<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">Affiliate Program</h1>
                <div class="row account-type-holder">
                    <div class="col-md-6 account-types aff-holder">
                        <h1 class="title-sub">Friend-referrer</h1>
                        <img src="<?= $this->template->Images()?>friendreferrer.png" class="img-responsive aff-program-img">
                        <p class="license-text">
                            Let people do the work for you. All you need to do is to promote our services to potential clients and make them trade in the company. When they generate profit, you earn money too.
                        </p>
                        <a href="<?php FXPP::loc_url('partnership/friend-referrer');?>" class="bonuses-read-more">Read More</a>
                    </div>
                    <div class="col-md-6 account-types aff-holder">
                        <h1 class="title-sub">Webmaster</h1>
                        <img src="<?= $this->template->Images()?>webmaster.png" class="img-responsive aff-program-img">
                        <p class="license-text">
                            Launching a website? Improving an existing site? ForexMart got you covered! We have designed different user-friendly, glitch-free widgets, as well as promotional materials, which can be integrated into any website.
                        </p>
                        <a href="<?php FXPP::loc_url('partnership/webmaster');?>" class="bonuses-read-more">Read More</a>
                    </div>
                </div>
                <div class="row account-type-holder aff-holder">
                    <div class="col-md-6 account-types">
                        <h1 class="title-sub">Online Partner</h1>
                        <img src="<?= $this->template->Images()?>ol-partner.png" class="img-responsive aff-program-img">
                        <p class="license-text">
                            Cash in on the website traffic! A client who signs up to ForexMart through your advertisment or lin is automatically added to your affiliate account. Gain profit without monitoring your referred users and their trades.
                        </p>
                        <a href="<?php FXPP::loc_url('partnership/online-partner');?>" class="bonuses-read-more">Read More</a>
                    </div>
                    <div class="col-md-6 account-types aff-holder">
                        <h1 class="title-sub">Local Online Partner</h1>
                        <img src="<?= $this->template->Images()?>local-ol-partner.png" class="img-responsive aff-program-img">
                        <p class="license-text">
                            They trade, you earn. Attract new clients in your country by advertising our services on your blog site, forum, or social media accounts.
                        </p>
                        <a href="<?php FXPP::loc_url('partnership/local-online-partner');?>" class="bonuses-read-more">Read More</a>
                    </div>
                </div>
                <div class="row account-type-holder aff-holder">
                    <div class="col-md-6 account-types">
                        <h1 class="title-sub">Local Office Partner</h1>
                        <img src="<?= $this->template->Images()?>office-partner.png" class="img-responsive aff-program-img">
                        <p class="license-text">
                            Become an official ForexMart representative in your area or city and expand your network of clients. A client's trading confidence is boosted through this highest level of cooperation. We provide the latest trading technology, competitive rates, and essential reading materials about currency trading.
                        </p>
                        <a href="<?php FXPP::loc_url('partnership/local-office-partner');?>" class="bonuses-read-more">Read More</a>
                    </div>
                </div>
                <div class="red-line"></div>
                <div class="btn-holder">
                    <form class="form-inline">
                        <div class="form-group">
                            <button id="open-trading-red" class="btn-real">Open Trading Account</button>
                        </div>
                        <div class="form-group">
                            <button id="open-demo-red" class="btn-demo">Open Demo Account</button>
                        </div>
                        <div class="form-group">
                            <label>Risk Warning: Trading CFDs involves significant risk of loss.</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"?>
    jQuery(document).ready(function(){

        jQuery('#open-trading-red').click(function() {
            document.location.href="<?php echo base_url();?>register";
        });
        jQuery('#open-demo-red').click(function() {
            document.location.href="<?php echo base_url('register/demo');?>";
        });

    });
</script>