<?=lang('AboutUs') ?>

<div class="reg-form-holder">
    <div class="about-company-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="license-title">
                        <?= lang('x_b_title')?>
                    </h1>
                    <p class="about-text">
                        <?= lang('x_b_p1-0')?>
                        <span class="company">
                        <?= lang('x_b_p1-1')?>
                        </span>
                        <?= lang('x_b_p1-2')?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="about-img-holder">
        <div class="about-img">
            <img src="<?= $this->template->Images()?>about-img.png" class="img-responsive">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="about-sub">
                    <?= lang('x_b_st')?>
                </h2>
                <p class="about-text">

                    <span class="company">
                         <?= lang('x_b_p2-0')?>
                    </span>
                    <?= lang('x_b_p2-1')?>
                </p>
                <h2 class="about-sub">
                    <?= lang('x_b_st1')?>
                </h2>
                <p class="about-text">
                    <?=lang('x_b_p3-0');?>
                    <span class="company">
                          <?=lang('x_b_p3-1');?>
                    </span>
                    <?=lang('x_b_p3-2');?>
                </p>
                <h2 class="about-sub">
                    <?= lang('x_b_st2')?>
                </h2>
                <p class="about-text">
                    <?= lang('x_b_p4-0')?>
                    <span class="company">
                         <?= lang('x_b_p4-1')?>
                    </span>

                    <?= lang('x_b_p4-2')?>

                </p>
                <h2 class="about-sub">
                    <?= lang('x_b_st3')?>
                </h2>

                <p class="about-text">
                    <?= lang('x_b_p5-0')?>
                    <span class="company">
                          <?= lang('x_b_p5-1')?>
                    </span>
                    <?= lang('x_b_p5-2')?>
                </p>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var pblc = [];
    var prvt = [];
    var site_url="<?=site_url('')?>";
    $(document).ready(function(){
        var ajax_call = function() {
            prvt["data"] = {
                AccountNumber:1
            };

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + 'index.php?/pages/aj',
                method: 'POST',
                data: prvt["data"]
            });
            pblc['request'].done(function( data ) {

                $('td.balance').html(data.balance);
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {

            });
        };
        var interval = 1000 * 60 * .1; // where X is your every X minutes
        setInterval(ajax_call, interval);
    });
</script>