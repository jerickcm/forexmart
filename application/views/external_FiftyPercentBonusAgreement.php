<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-fpba.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title"><?= lang('fpdb_header');?></h1>
                <p class="license-sub agg"><?= lang('fpdb_p1');?></p>
                <ul class="gen-terms">
                    <li><?= lang('fpdb_li1');?></li>
                    <li><?= lang('fpdb_li2');?></li>
                    <li><?= lang('fpdb_li3');?></li>
                    <li><?= lang('fpdb_li4');?></li>
                    <li><?= lang('fpdb_li5-1');?><img class="tradomart" width="101" height="11" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png" /><?= lang('fpdb_li5-2');?></li>
                </ul>
                <p class="license-text">
                    <?= lang('fpdb_p1-1');?>
                </p>
                <p class="license-sub agg"><?= lang('fpdb_p2');?></p>
                <ul class="agg-list">
                    <li><span>2.1</span><?= lang('fpdb_li21');?></li>
                    <li><span>2.2</span><?= lang('fpdb_li22');?></li>
                    <li><span>2.3</span><?= lang('fpdb_li23');?></li>
                    <li><span>2.4</span><?= lang('fpdb_li24');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('fpdb_p3');?></p>
                <ul class="agg-list">
                    <li><span>3.1</span><?= lang('fpdb_li31');?></li>
                    <li><span>3.2</span><?= lang('fpdb_li32');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('fpdb_p4');?></p>
                <ul class="agg-list">
                    <li><span>4.1</span><?= lang('fpdb_li41');?></li>
                    <li><span>4.2</span><?= lang('fpdb_li42');?></li>
                    <li><span>4.3</span><?= lang('fpdb_li43');?></li>
                    <li><span>4.4</span><?= lang('fpdb_li44');?></li>
                    <li><span>4.5</span><?= lang('fpdb_li45');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('fpdb_p5');?></p>
                <ul class="agg-list">
                    <li><span>5.1</span><?= lang('fpdb_li51-1');?><span class="company"><?= lang('fpdb_li51-2');?></span>&#46;<?= lang('fpdb_li51-3');?></li>
                    <li><span>5.2</span><?= lang('fpdb_li52');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('fpdb_p6');?></p>
                <ul class="agg-list">
                    <li><span>6.1</span><?= lang('fpdb_li61');?></li>
                    <li><span>6.2</span><?= str_replace('USD', $default_currency, lang('fpdb_li62'));?></li>
                    <li><span>6.3</span><?= lang('fpdb_li63');?></li>
                    <li><span>6.4</span><?= lang('fpdb_li64');?></li>
                    <li><span>6.5</span><?= lang('fpdb_li65');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('fpdb_p7');?></p>
                <p class="license-text"><?= lang('fpdb_p71');?>
                <br>
                <p class="license-sub agg"><?= lang('fpdb_p8');?></p>
                <p class="license-text"><?= lang('fpdb_p81');?>
                </p>
                <p class="footnote">
                    <i><?= lang('fpdb_li71');?></i>
                </p>
                <?= $DemoAndLiveLinks?>
            </div>
        </div>
    </div>
</div>
