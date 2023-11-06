
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style>@media screen and (max-width: 320px){.container:lang(it){padding-right: 15px !important;padding-left: 15px !important;}}strong{color: #333!important}.mts{ margin-top: 0px !important;}</style>');
    });
</script>

<!--hypen &#45;-->
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title sa-right">
                    <?= lang('al_h_0')?>
                </h1>
                <p class="license-text ext-arabic-license-text">
                    <?= lang('al_p_0')?>
                </p>
                <p class="license-text mts">
                    <?= lang('al_p_1')?>
                </p>
                <p class="license-sub ext-arabic-license-sub sa-right">
                    <?= lang('al_p_2')?>
                </p>
                <p class="license-text ext-arabic-license-text">
                    <?= lang('al_p_3')?>
                </p>
                <ol  class="ext-arabic-ordered-list">
                    <li>
                        <?= lang('al_li_0_0')?> (<strong><?= lang('al_li_0_1')?></strong>) <?= lang('al_li_0_2')?> (<a href="<?=FXPP::loc_url('why-choose-us')?>"><?= lang('al_li_0_3a')?></a>).
                    </li>
                    <li>
                        <?= lang('al_li_1_0')?>
                        <strong><?= lang('al_li_1_1a')?></strong>,<?= lang('al_li_1_2')?>
                    </li>
                </ol>
                <p class="license-text ext-arabic-license-text">
                    <?= lang('al_p_4_0')?> &#45;
                    <strong><?= lang('al_p_4_1')?></strong>. <?= lang('al_p_4_2')?>&#45;
                    <strong><?= lang('al_p_4_3')?></strong>. <?= lang('al_p_4_4')?>
                </p>
                <p class="license-text ext-arabic-license-tex">
                    <?= lang('al_p_5_0')?>
                </p>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>
