<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-ndb-agreement.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">
                    <?= lang('headerNDBA');?>
                </h1>
                    <p class="license-sub agg"> <?= lang('ndba_p1');?></p>
                    <ul class="agg-list">
                        <li><span>1.1 </span> <?= lang('ndba_li1');?></li>
                        <li><span>1.2 </span> <?= lang('ndba_li2');?></li>
                        <li><span>1.3 </span> <?= lang('ndba_li3');?></li>
                        <li><span>1.4 </span> <?= lang('ndba_li4');?></li>
                    </ul>
                    <p class="license-sub agg">
                        <?= lang('ndba_p2');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>2.1 </span> <?= lang('ndba_li21-1');?></li>
                        <li> <?= lang('ndba_li21-1-1');?></li>
                        <li> <?= lang('ndba_li21-1-2');?></li>
                        <li> <?= lang('ndba_li21-1-3');?></li>
                        <li> <?= lang('ndba_li21-1-4');?></li>
                        <li> <?= lang('ndba_li21-1-5');?></li>
                        <li> <?= lang('ndba_li21-1-6');?></li>
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p3');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>3.1 </span><?= lang('ndba_li31');?></li>
                        <li><span>3.2 </span><?= lang('ndba_li32');?></li>
                        <li><span>3.3 </span><?= lang('ndba_li33');?></li>
                        <li><span>3.4 </span><?= lang('ndba_li34');?></li>

                        <li><span>3.5 </span><?= lang('ndba_li35');?></li>
                        <li><span>3.6 </span><?= lang('ndba_li36');?></li>
                        <li><span>3.7 </span><?= lang('ndba_li37');?></li>
                        <li><span>3.8 </span><?= lang('ndba_li38');?></li>
                        <li><span>3.9 </span><?= lang('ndba_li39');?></li>
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p4');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>4.1 </span> <?= lang('ndba_li41');?></li>
                        <li><span>4.2 </span> <?= lang('ndba_li42');?></li>
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p5');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>5.1 </span> <?= lang('ndba_li51');?></li>
                        <li><span>5.2 </span> <?= lang('ndba_li52');?></li>
                        <li><span>5.3 </span> <?= lang('ndba_li53');?></li>
                        <li><span>5.4 </span> <?= lang('ndba_li54');?></li>
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p6');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>6.1.1 </span><?= lang('ndba_li6_1_1');?></li>
                        <li><span>6.1.2 </span><?= lang('ndba_li6_1_2');?></li>
                        <li><span>6.1.3 </span>
                            <?php echo lang('ndba_6_1_3');?>

                        </li>
                        <li>
                            <span>6.2.1 </span>
                            <?php echo lang('ndba_6_2_1');?>

                            <br/>
                            <?php echo lang('ndba_6_2_1br1');?>

                            <br/>
                            <?php echo lang('ndba_6_2_1br2');?>

                        </li>
                        <li><span>6.2.2 </span><?= lang('ndba_li6_2_2');?></li>
                        <li><span>6.3 </span><?= lang('ndba_li6_3');?></li>
                        <li><span>6.4 </span><?= lang('ndba_li6_4');?></li>
                        <li><span>6.5 </span>
                        The Client agrees that the Bonus Profit amount is canceled in full upon any withdrawal of funds from the trading account.﻿</li>  
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p7');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>7.1 </span> <?= lang('ndba_p71');?></li>
                        <li><span>7.2 </span> <?= lang('ndba_p72');?></li>
                        <li><span>7.3 </span> <?= lang('ndba_p73');?></li>
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p8');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>8.1 </span> <?= lang('ndba_p81');?></li>
                    </ul>

                    <p class="license-sub agg">
                        <?= lang('ndba_p9');?>
                    </p>
                    <ul class="agg-list">
                        <li><span>9.1 </span> <?= lang('ndba_li91');?></li>
                    </ul>

                    <p class="footnote">
                        <i><?= lang('ndba_p81-1');?></i>
                    </p>



                <?= $DemoAndLiveLinks?>

            </div>
        </div>
    </div>
</div>
<?=$check?>