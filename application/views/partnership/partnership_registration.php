<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">Partnership Registration</h1>
                <p class="license-sub">Select the type of partnership</p>
                <div class="row">
                    <div class="col-sm-3">
                        <button onclick="window.location='<?=FXPP::loc_url('partnership/friend-referrer')?>';" class="btn-part-reg"><i class="fa fa-slideshare partner-icon"></i> Friend Referrer</button>
                    </div>
                    <div class="col-sm-9">
                        <p class="partner-reg-text">
                            Let people do the work for you. All you need to do is to promote our services to potential clients and make them trade in the company. <a href="<?=site_url('partnership/friend-referrer')?>">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <button onclick="window.location='<?=FXPP::loc_url('partnership/webmaster')?>';" class="btn-part-reg"><i class="fa fa-code partner-icon"></i> Webmaster</button>
                    </div>
                    <div class="col-sm-9">
                        <p class="partner-reg-text">
                            Launching a website? Improving an existing site? ForexMart got you covered! We have designed different user-friendly, glitch-free widgets, as well as promotional materials, which can be integrated into any website. <a href="<?=site_url('partnership/webmaster')?>">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <button onclick="window.location='<?=FXPP::loc_url('partnership/online-partner')?>';" class="btn-part-reg"><i class="fa fa-share-alt partner-icon"></i> Online Partner</button>
                    </div>
                    <div class="col-sm-9">
                        <p class="partner-reg-text">
                            Cash in on the website traffic! A client who signs up to ForexMart through your advertisement or lin is automatically added to your affiliate account. <a href="<?=site_url('partnership/online-partner')?>">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <button onclick="window.location='<?=site_url('partnership/local-online-partner')?>';" class="btn-part-reg"><i class="fa fa-user partner-icon"></i> Local Online Partner</button>
                    </div>
                    <div class="col-sm-9">
                        <p class="partner-reg-text">
                            They trade, you earn. Attract new clients in your country by advertising our services on your blog site, forum, or social media accounts. <a href="<?=site_url('partnership/local-online-partner')?>">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <button onclick="window.location='<?=site_url('partnership/local-office-partner')?>';" class="btn-part-reg"><i class="fa fa-users partner-icon"></i> Local Office Partner</button>
                    </div>
                    <div class="col-sm-9">
                        <p class="partner-reg-text">
                            Become an official ForexMart representative in your area or city and expand your network of clients. A client's trading confidence is boosted through this highest level of cooperation. <a href="<?=site_url('partnership/local-office-partner')?>">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="red-line"></div>
                <div class="btn-holder">
                    <form class="form-inline">
                        <div class="form-group">
                            <button class="btn-real">Open Trading Account</button>
                        </div>
                        <div class="form-group">
                            <button class="btn-demo">Open Demo Account</button>
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

    <script type="text/javascript">
        $("input").keyup(function() {
            this.value = this.value.replace(/[^a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
        });
        $("textarea").keyup(function() {
            this.value = this.value.replace(/[^a-zA-Z АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя!"#$%&'()*+,-.\/\[\\\]\^\_\`\:\;\<\=\>\?\@\{\|\}\~\ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ]/i, "");
        });
    </script>

    <style type="text/css">
        .error{
            color:red;
            font-size: 14px;
            font-weight: normal;
            text-align: left;
        }
    </style>

    <script type="text/javascript">
        $( document ).ready( function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
            );


            $('#local_office_partner_reg').validate({ // initialize the plugin
                rules: {
                    company_name: {
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                    registration_number:{
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                    date_of_inc:{
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@  ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                    fullname:{
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                    phone_number:{
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                    skype:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                    message:{
                        required: true,
                        regex: "^[a-zA-Z 0-9 АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя@ ÇüéâäàåçêëèïîìæÆôöòûùÿ¢£¥PƒáíóúñÑ¿¬½¼¡«»¦ßµ±°•·²€„…†‡ˆ‰Š‹Œ‘’“”–—˜™š›œŸ¨©®¯³´¸¹¾ÀÁÂÃÄÅÈÉÊËÌÍÎÏÐÒÓÔÕÖ×ØÙÚÛÜÝÞãðõ÷øüýþ \.\,\+\-\/\:]*$"
                    },
                },
                messages: {
                    company_name:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Company Name " + "<?=lang('validate_engrus2'); ?>"

                    },
                    registration_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Registration Number " + "<?=lang('validate_engrus2'); ?>",
                    },
                    date_of_inc:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Date of Incorporation " + "<?=lang('validate_engrus2'); ?>",

                    },
                    fullname:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Full Name " + "<?=lang('validate_engrus2'); ?>",

                    },
                    phone_number:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Phone Number " + "<?=lang('validate_engrus2'); ?>",

                    },
                    skype:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Skype " + "<?=lang('validate_engrus2'); ?>",

                    },
                    message:{
                        regex: "<?=lang('validate_engrus1'); ?>"+" Message " + "<?=lang('validate_engrus2'); ?>",

                    },

                },
                submitHandler: function (form) {
                    return true;
                }
            });

        });
    </script>
