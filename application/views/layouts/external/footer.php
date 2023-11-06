<link href="<?= $this->template->Css() ?>footer-custome-style.css" rel="stylesheet">
<?php if (FXPP::html_url() == 'id') { ?>
    <link href="<?= $this->template->Css() ?>footer-custome-style-id.css" rel="stylesheet">
<?php } ?>
<link href="<?= $this->template->Css() ?>footer-banner.css" rel="stylesheet">
<footer>
    <div class="container ext-arabic-footer-container">
        <div class="row ext-arabic-footer-row ">
            <div class="col-lg-9 col-md-9 col-sm-9 ext-arabic-footer-text-parent padding_for_it_lang" style="">
                <p class="footer-text ext-arabic-footer-text">
                    <cite>
                        <?= lang('rw'); ?>
                    </cite>
                    <?= lang('rw1'); ?>
                    <span class="company"><?= lang('rw2'); ?></span><?= lang('rw3'); ?> <a href="<?= FXPP::loc_url('risk-disclosure') ?>" target="_blank"><?= lang('rw4'); ?></a> <?= lang('rw5'); ?>
                    <br><br>
                    <span class="company"><?= lang('pn2-1'); ?></span> <?= lang('pn2-4'); ?>
                    <br><br>
                    <!--<span class="company"><?= lang('pn1-1'); ?></span> <?= lang('pn1-2'); ?> <img class="tradomart" width="101px" height="10px"  src="<?= $this->template->Images() ?>tradomart/tradomart-ltd-small-black.png" /><?= lang('pn1-3'); ?>
                    <br><br> -->
                    <span class="company"><?= lang('pn2-1'); ?></span> <?= lang('pn2-2'); ?>
                    <a href="<?= FXPP::www_url('awards') ?>"><?= lang('pn2-2-2'); ?></a>
                    <br><br>
                    <span class="company"><?= lang('pn2-1'); ?></span> <?= lang('pn2-5'); ?>
                </p>

            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 sec logoLink">
                <a href="https://www.forexmart.com/cysec"><img src="<?= $this->template->Images() ?>cysec.png" alt="" class="img-responsive"></a>
                <a href="http://ec.europa.eu/finance/securities/isd/mifid/index_en.htm"><img src="<?= $this->template->Images() ?>mifid.png" alt="" class="img-responsive "></a>
                <a href="https://www.forexmart.com/bafin"><img src="<?= $this->template->Images() ?>bafin.png" alt="" class="img-responsive"></a>
                <a href="https://www.forexmart.com/amf"><img src="<?= $this->template->Images() ?>amf.png" alt="" class="img-responsive"></a>
                <a href="https://www.forexmart.com/fca"><img src="<?= $this->template->Images() ?>fca.png" alt="" class="img-responsive"></a>
                <a href="https://www.forexmart.com/consob"><img src="<?= $this->template->Images() ?>consob.png" alt="" class="img-responsive"></a>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 ext-arabic-footer-text-parent padding_for_it_lang" style="">
                <p class="footer-text ext-arabic-footer-text">
                    <br>
                    <span class="company"><?= lang('pn2-1'); ?></span><?= lang('pn2-6'); ?> <img class="tradomart" alt="" width="101" height="10"  src="<?= $this->template->Images() ?>tradomart/tradomart-ltd-small-black.png" /> <?= lang('pn2-7'); ?>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

<div class="copyright-holder">
    <div class="container">
        <div class="row" style="margin-left: 0px !important; margin-right: 0px !important;">
            <div class="col-md-9 col-sm-9 col-xs-5 copy coprig ext-arabic-footer-copy sa-right">
                <p>&copy; 2015-<?= date('Y'); ?> <img src="<?= $this->template->Images() ?>tradomart/tradomart-ltd-small-black.png" alt="" class="trademart"></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-7 social-media-holder sosmed ext-arabic-footer-social-media">
                <ul class="social-media">
                    <?php if (FXPP::html_url() == 'ru') { ?>
                        <li><a href="https://www.facebook.com/forexmartru" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/ForexMartRu" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://vk.com/forexmart" target="_blank"><i class="fa fa-vk"></i></a></li>
                        <li><a href="https://plus.google.com/communities/111804080179853814370" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <?php } else { ?>
                        <li><a href="<?= $this->config->item('domain-facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?= $this->config->item('domain-twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <!--<li><a href="" target="_blank"><i class="fa fa-linkedin"></i></a></li>-->
                        <li><a href="<?= $this->config->item('domain-googleplus'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php if (isset($_COOKIE['forexmart_footer'])) { ?>

<?php } else { ?>
    <script type="text/javascript">
        console.log(1);
        $(window).load(function () {
            $('#footer-banner').slideToggle();
        });
        $(document).ready(function () {
            $('#footer-close').click(function () {
                $('#footer-banner').hide();
            });
        });
        $(".footer-toggle").click(function () {
            //$(".footer-hide-menu").toggle( 300, function() {
            // Animation complete.
            //});
        });

    </script>

    <!-- footer banner -->
    <div class="footer-banner-holder" id="footer-banner">
        <span id="footer-close">Close</span>
        <a href="<?= FXPP::loc_url('money-fall-registration'); ?>" class="link-banner">
            <div class="<?php echo IPLOC::location_bannertaser(); ?> ">
            </div>
        </a>
    </div>
    <?php
    $data['cookie_foot'] = array(
        'name' => 'footer',
        'value' => $_SERVER[REQUEST_URI],
        'expire' => time() + (10 * 365 * 24 * 60 * 60),
        'domain' => '.forexmart.com',
        'secure' => true,
        'path' => '/',
        'prefix' => '',
        'httponly' => true
    );
    $this->input->set_cookie($data['cookie_foot'], true);
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        var $hover = $(".a-first-child");
        setInterval(function () {
            $hover.toggleClass("hover");
        }, 3000);
        var $hover1 = $(".a-last-child");
        setInterval(function () {
            $hover1.toggleClass("hover");
        }, 3000);
        var $hover7 = $(".a-flast-child");
        setInterval(function () {
            $hover7.toggleClass("hover");
        }, 3000);
    });

    $(document).ready(function () {
        $('.hideside').click(function () {
            $('.side-fix-holder').css('display', 'none');
            $('.showside').css('right', '0');
        });
        $('.showside').click(function () {
            $(this).css('right', '-20px');
            $('.side-fix-holder').css('display', 'block');
        });
    });

    $(document).ready(function () {
        // sidebar full view
        var $hover = $(".a-first-child");
        setInterval(function () {
            $hover.toggleClass("hover");
        }, 3000);
        var $hover1 = $(".a-last-child");
        setInterval(function () {
            $hover1.toggleClass("hover");
        }, 3000);
        var $hover2 = $(".ls-img1");
        setInterval(function () {
            $hover2.toggleClass("auto-hover1");
        }, 3000);
        var $hover3 = $(".ls-img2");
        setInterval(function () {
            $hover3.toggleClass("auto-hover2");
        }, 3000);
        var $hover4 = $(".ls-img3");
        setInterval(function () {
            $hover4.toggleClass("auto-hover3");
        }, 3000);
        var $hover5 = $(".ls-img3-2s");
        setInterval(function () {
            $hover5.toggleClass("auto-hover2s");
        }, 3000);
    });

</script>

<!--script type="text/javascript">
    $(".footer-toggle").click(function() {
        $(".footer-hide-menu").toggle( 300, function() {
            // Animation complete.
        });
    });
</script-->

<link href="<?= $this->template->Css() ?>sidebar.css" rel="stylesheet">
<div id="showside" class="showside">
    <span></span>
</div>
<div class="side-fix-holder">
    <div id="hideside" class="hideside">
        <span></span>
    </div>
    <ul class="side-fix">
        <li>
            <a href="<?= FXPP::loc_url($this->config->item('live-account')) ?>" class="a-first-child">
                <p class="fix-lbl"><?= lang('st1'); ?></p>
            </a>
        </li>
        <!--<li>
            <a href="<?/*=FXPP::loc_url('no-deposit-bonus')*/?>" class="a-last-child">
                <p class="fix-lbl id-font"><?/*= lang('st2');*/?></p>
            </a>
        </li>-->
        <li>
            <a href="<?= FXPP::loc_url('chance-bonus') ?>"  class="a-flast-child chance-pop">
                <p class="fix-lbl id-font"><?= lang('st3'); ?></p>
            </a>
        </li>
    </ul>
    <ul class="side-fix-landscape">
        <li><a href="<?= FXPP::loc_url($this->config->item('live-account')) ?>" class="ls-img1"></a></li>
        <!--<li><a href="<?/*=FXPP::loc_url('no-deposit-bonus')*/?>" class="ls-img2"></a></li>-->
        <li><a href="<?= FXPP::loc_url('chance-bonus') ?>" class="ls-img3-2s"></a></li>
        <li><a href="javascript:void(Tawk_API.toggle())" class="ls-img3"></a></li>
    </ul>
</div>

<script type="text/javascript">
    $(function () {
        $('.toggleX').click(function (event) {
            event.preventDefault();
            var target = $(this).attr('href');
            $(target).toggleClass('hidden show');
            if ($('#hs-aria').html() === '×') {
                $('#hs-aria').html('+');
                $('#li-hide').addClass('mrgn');
            } else {
                $('#hs-aria').html('×');
                $('#li-hide').removeClass('mrgn');
            }
        });
    });

    function chanceOpen() {
        $('#chance').modal('show');
        $('body').addClass('test');
    }
</script>

<script type="text/javascript">
    $(function () {
        $('.toggleX').click(function (event) {
            event.preventDefault();
            var target = $(this).attr('href');
            $(target).toggleClass('hidden show');
            if ($('#hs-aria').html() === '×') {
                $('#hs-aria').html('+');
                $('#li-hide').addClass('mrgn');
            } else {
                $('#hs-aria').html('×');
                $('#li-hide').removeClass('mrgn');
            }
        });
    });
</script>
