<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-tpba.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <?php 
                    if(FXPP::html_url() == 'en' || FXPP::html_url() == 'cs' || FXPP::html_url() == 'zh'){
                ?>
                <h1 class="license-title"><?= lang('tpdb_header');?></h1>
                <p class="license-sub agg"><?= lang('tpdb_p1');?></p>
                <ul class="agg-list">
                    <li><span>1.1</span><?= lang('tpdb_li1');?></li>
                    <li><span>1.2</span><?= lang('tpdb_li2');?></li>
                    <li><span>1.3</span><?= lang('tpdb_li3');?></li>
                    <li><span>1.4</span><?= lang('tpdb_li4');?></li>
                    <!-- <li><span>1.5</span><?= lang('tpdb_li5-1');?><img class="tradomart" width="101px" height="11px"  src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png" /><?= lang('tpdb_li5-2');?></li> -->
                </ul>
                <!-- <p class="license-text">
                    <?= lang('tpdb_p1-1');?>
                </p> -->
                <p class="license-sub agg"><?= lang('tpdb_p2');?></p>
                <ul class="agg-list">
                    <li><span>2.1</span><?= lang('tpdb_li21');?></li>
                    <!-- <li><span>2.2</span><?= lang('tpdb_li22');?></li>
                    <li><span>2.3</span><?= lang('tpdb_li23');?></li> -->
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p3');?></p>
                <ul class="agg-list">
                    <li><span>3.1</span><?= lang('tpdb_li31');?></li>
                    <li><span>3.2</span><?= lang('tpdb_li32');?></li>
                    <li><span>3.3</span><?= lang('tpdb_li33');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p4');?></p>
                <ul class="agg-list">
                    <li><span>4.1</span><?= lang('tpdb_li41');?></li>
                    <li><span>4.2</span><?= lang('tpdb_li42');?></li>
                    <!-- <li><span>4.3</span><?= lang('tpdb_li43');?></li> -->
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p5');?></p>
                <ul class="agg-list">
                    <!-- <li><span>5.1</span><?= lang('tpdb_li51-1');?><span class="company"><?= lang('tpdb_li51-2');?></span>&#46<?= lang('tpdb_li51-3');?></li>
                    <li><span>5.2</span><?= lang('tpdb_li52');?></li> -->
                    <li><span>5.1</span><?= lang('tpdb_li51');?></li>
                    <li><span>5.2</span><?= lang('tpdb_li52');?></li>
                    <li><span>5.3</span><?= lang('tpdb_li53');?></li>
                    <li><span>5.4</span><?= lang('tpdb_li54');?></li>
                    <li><span>5.5</span><?= lang('tpdb_li55');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p6');?></p>
                <ul class="agg-list">
                    <li><span>6.1</span><?= lang('tpdb_li61');?></li>
                    <li><span>6.2</span><?= lang('tpdb_li62');?></li>
                    <li><span>6.3</span><?= lang('tpdb_li63');?></li>
                    <li><span>6.4</span><?= lang('tpdb_li64');?></li>
                    <li><span>6.5</span><?= lang('tpdb_li65');?></li>
                    <li><span>6.6</span><?= lang('tpdb_li66');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p7');?></p>
                <ul class="agg-list">
                    <li><span>7.1</span><?= lang('tpdb_li71');?></li>
                    <li><span>7.2</span><?= lang('tpdb_li72');?></li>
                    <li><span>7.3</span><?= lang('tpdb_li73');?></li>
                        <li class="w3c_ul_div agg-list">
                            <p><span class="w3_li_p">7.3.1</span><?= lang('tpdb_li73-1');?></p>
                            <p><span class="w3_li_p">7.3.2</span><?= lang('tpdb_li73-2');?></p>
                        </li>
                    <li><span>7.4</span><?= lang('tpdb_li74');?></li>
                    <li><span>7.5</span><?= lang('tpdb_li75');?></li>
                    <li><span>7.6</span><?= lang('tpdb_li76');?></li>
                    <li><span>7.7</span><?= lang('tpdb_li77');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p8');?></p>
                    <ul class="agg-list">
                        <li><span>8.1</span><?= lang('tpdb_li81');?></li>
                    </ul>
                <p class="footnote">
                    <i><?= lang('tpdb_li82');?></i>
                </p>

                <p class="license-sub agg"><?= lang('tpdb_p9');?></p>

                    <?= str_replace('$', $default_currency_symbol, str_replace('US', $default_currency_code, lang('tpdb_li91')));?>

                <?php }else{ ?>

                <h1 class="license-title"><?= lang('tpdb_header');?></h1>
                <p class="license-sub agg"><?= lang('tpdb_p1');?></p>
                <ul class="gen-terms">
                    <li><?= lang('tpdb_li1');?></li>
                    <li><?= lang('tpdb_li2');?></li>
                    <li><?= lang('tpdb_li3');?></li>
                    <li><?= lang('tpdb_li4');?></li>
                    <li><?= lang('tpdb_li5-1');?><img class="tradomart" width="101" height="11" alt=""  src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png" /><?= lang('tpdb_li5-2');?></li>
                </ul>
                <p class="license-text">
                    <?= lang('tpdb_p1-1');?>
                </p>
                <p class="license-sub agg"><?= lang('tpdb_p2');?></p>
                <ul class="agg-list">
                    <li><span>2.1</span><?= lang('tpdb_li21');?></li>
                    <li><span>2.2</span><?= lang('tpdb_li22');?></li>
                    <li><span>2.3</span><?= lang('tpdb_li23');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p3');?></p>
                <ul class="agg-list">
                    <li><span>3.1</span><?= lang('tpdb_li31');?></li>
                    <li><span>3.2</span><?= lang('tpdb_li32');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p4');?></p>
                <ul class="agg-list">
                    <li><span>4.1</span><?= lang('tpdb_li41');?></li>
                    <li><span>4.2</span><?= lang('tpdb_li42');?></li>
                    <li><span>4.3</span><?= lang('tpdb_li43');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p5');?></p>
                <ul class="agg-list">
                    <li><span>5.1</span><?= lang('tpdb_li51-1');?><span class="company"><?= lang('tpdb_li51-2');?></span>&#46<?= lang('tpdb_li51-3');?></li>
                    <li><span>5.2</span><?= lang('tpdb_li52');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p6');?></p>
                <ul class="agg-list">
                    <li><span>6.1</span><?= lang('tpdb_li61');?></li>
                    <li><span>6.2</span><?= str_replace('USD', $default_currency, lang('tpdb_li62'));?></li>
                    <li><span>6.3</span><?= lang('tpdb_li63');?></li>
                    <li><span>6.4</span><?= lang('tpdb_li64');?></li>
                </ul>

                <p class="license-sub agg"><?= lang('tpdb_p7');?></p>
                <p class="license-text"><?= lang('tpdb_p71');?>
                </p>
                <p class="footnote">
                    <i><?= lang('tpdb_li71');?></i>
                </p>
                <p class="license-sub agg"><?= lang('tpdb_p8');?></p>

                    <?= str_replace('$', $default_currency_symbol, str_replace('US', $default_currency_code, lang('tpdb_li81')));?>

                <?php } ?>

                <?= $DemoAndLiveLinks?>
            </div>
        </div>
    </div>
</div>