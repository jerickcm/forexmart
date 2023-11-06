
<link href="<?php echo $this->template->Css()?>/external-style.css" rel="stylesheet">

<link href="<?php echo $this->template->Css()?>/exscrolling-nav.css" rel="stylesheet">
<link href="<?php echo $this->template->Css()?>micro-account.css" rel="stylesheet">
<link href="<?php echo $this->template->Css()?>view-liveaccounts.css" rel="stylesheet">
<?php switch ($type) {
    case 1:
        $newclass='ecn-header-wrapper1';
        break;
    case 2:
        $newclass='ecn-header-wrapper2';
        break;
    case 4:
        $newclass='ecn-header-wrapper3';
        break;
    default:
        $newclass='ecn-header-wrapper1';
}?>
<div class="container">

    <div class="ecn-header-wrapper <?php echo $newclass ?>">
        <div class="micro-account-title">
            <h2 class="ecn-main-title-holder"><?= lang('la_h1-0f');?> <b class="blacks">
                <?php
                switch ($type) {
                    case 1:
                        echo lang('la_h1-01');
                        break;
                    case 2:
                        echo lang('la_h1-02');
                        break;
                    case 4:
                        echo lang('la_h1-03');
                        break;
                }?>
            </b></h2>
        </div>
    </div>
    <?php
    if($type == 1){
        ?>
        <div class="detail-desc">
            <p><b class="isblack"><?= lang('fx_standard');?></b> <?= lang('fx_standard_1');?> <b class="isblack"><?= lang('fx_standard');?></b> <?= lang('fx_standard_2');?>.</p>
            <p><?= lang('fx_standard_3');?> <b class="isblack"><?= lang('fx_standard1');?></b> <?= lang('fx_standard_4');?> <a href="<?= FXPP::www_url()?>financial-instruments/forex"><?= lang('fx_standard_5');?>.</a><br/>
                <?= lang('fx_standard_6');?>.</p>
            <p><?= lang('fx_standard_7');?>.</p>
        </div>
        <hr>

        <?php
    } elseif($type == 2){
        ?>
        <div class="detail-desc">
            <p><?= lang('fx_zero_spread_1');?> <b class="isblack"><?= lang('fx_zero_spread');?></b>. <?= lang('fx_zero_spread_2');?><b class="isblack"></b><sup></sup><span style="color:red;">*</span>. <?= lang('fx_zero_spread_3');?>.</p>
            <p><?= lang('fx_zero_spread_4');?> <b class="isblack"><?= lang('fx_zero_spread');?></b> <?= lang('fx_zero_spread_5');?> <a href="<?= FXPP::www_url()?>financial-instruments/forex"><?= lang('fx_zero_spread_6');?>.</a><br/>
                <?= lang('fx_zero_spread_7');?>.</p>
            <p><?= lang('fx_zero_spread_8');?>.</p>
            <p class="spec-condition"><b class="isblack"></b><sup></sup><span style="color:red;">*</span><?= lang('fx_zero_spread_9');?>.</p>
        </div>
        <hr>
        <?php
    } else {
        ?>
        <div class="detail-desc">
            <p><b class="isblack"><?= lang('fx_micro');?></b> <?= lang('fx_micro_1');?>
             <?php
              if($this->uri->segment(1)=='ru'){

              } else{
                  echo '.';
              }
             ?>
            </p>
            <p><?= lang('fx_micro_2');?>.</p>
            <p><?= lang('fx_micro_3');?>
                <?php
                if($this->uri->segment(1)=='ru'){ ?>
                     <!---- Russian language no need this part ------->
               <?php } else{ ?>
                    <b class="isblack"><?= lang('fx_micro');?></b> <?= lang('fx_micro_4');?> <a href="<?= FXPP::www_url()?>financial-instruments/forex"><?= lang('fx_micro_5');?></a>.
                <?php }  ?>

                <br/>
                <?= lang('fx_micro_6');?>.</p>
            <p><?= lang('fx_micro_7');?>.</p>
        </div>
        <hr>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-lg-12 desc-area-wrapper">
            <div class="col-md-6 ecn-detail">
                <ul class="remove-padding-ipad">
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_01');?><span class="reduce-font"><?= lang('ecn_std_01');?></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_02');?><span><?= lang('ecn_std_02');?>  <b class="black">[1]</b></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_03');?><span>
                        <?php
                        switch ($type) {
                            case 1:
                                echo lang('ecn_std_03');
                                break;
                            case 2:
                                echo lang('ecn_spd_03');
                                break;
                            case 4:
                                echo lang('micro_03');
                                break;
                        }?>
                    </span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_04');?><span class="reduce-font">
                        <?php
                        switch ($type) {
                            case 1:
                                echo 'USD, EUR, GBP, RUB, MYR, IDR, THB, CNY';
                                break;
                            case 2:
                                echo 'USD, EUR, GBP, RUB, MYR, IDR, THB, CNY';
                                break;
                            case 4:
                                echo 'USD, EUR';
                                break;
                        }?></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_05');?><span>1:5000  <b class="black">[2]</b></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_06');?><span>
                        <?php
                        switch ($type) {
                            case 1:
                                echo lang('ecn_std_06');
                                break;
                            case 2:
                                echo lang('ecn_spd_06');
                                break;
                            case 4:
                                echo lang('micro_06');
                                break;
                        }?></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_07');?><span>
                        <?php
                        switch ($type) {
                            case 1:
                                echo lang('ecn_std_07');
                                break;
                            case 2:
                                echo lang('ecn_spd_07');
                                break;
                            case 4:
                                echo lang('micro_07');
                                break;
                        }?></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_08');?><span><?= lang('micro_08');?></span></li>
                    <li class="desc-area"><i class="fa fa-lg fa-check-square-o"></i><?= lang('ecn_09');?><span><?= lang('micro_09');?></span></li>
                </ul>

            </div>

            <div class="col-md-6 micro-account">

                <!--                    <h4 class="ecn-form-title"> Open a <b>Live</b> Trading <b>Account</b></h4>-->
                <div class="micro-account-form-holder">
                    <form class="form-horizontal micro-account-form" method="post" id="live">
                        <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                        <div class="form-group">
                            <label class="control-label col-sm-3 micro-account-label"><?= lang('la_lbl0');?><cite class="req">*</cite></label>
                            <div class="col-sm-9">
                                <input name="email" type="text" class="form-control round-0 <?php echo form_error('email')?"red-border":""?>" id="inputEmail3" placeholder="<?= lang('la_lbl0');?>" value="<?=set_value('email');?>">
                                <span class="red pull-r"><?php echo  form_error('email')?> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3 micro-account-label"><?= lang('la_lbl1');?><cite class="req">*</cite></label>
                            <div class="col-sm-9">
                                <input name="full_name" type="text" class="form-control round-0 <?php echo form_error('full_name')?"red-border":""?>" id="full" placeholder="<?= lang('la_lbl1');?>" value="<?=set_value('full_name');?>">
                                <span class=" red pull-r"><?php echo  form_error('full_name')?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn-submit"><?= lang('la_btn0');?></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="sign-area">
                    <h5><?= lang('ecn_13');?> <b class="blacks"><?= lang('ecn_130');?></b></h5>
                    <a target="_blank" href="<?=FXPP::my_url()?>client/signin" class="btn-signin"><?= lang('ecn_14');?></a>
                </div>
               
            </div>
        </div>
    </div>

    <hr>
    <div class="desc-bottom">
        <p><b class="black">[1]</b> - <?= lang('ecn_16');?>.</p>
        <p><b class="black">[2]</b> - <?= lang('ecn_17');?>.</p>
    </div>


</div>

<?php
if($type == 1){
    $data['log']=array(
        'ip'=>$_SERVER['REMOTE_ADDR'],
        'referrer'=>$_SERVER['HTTP_REFERER'],
        'type'=>1 //standard
    );
    $this->general_model->insertmy($table="registration_page_logs",$data['log']);
} elseif($type == 2){
    $data['log']=array(
        'ip'=>$_SERVER['REMOTE_ADDR'],
        'referrer'=>$_SERVER['HTTP_REFERER'],
        'type'=>2 //spread
    );
    $this->general_model->insertmy($table="registration_page_logs",$data['log']);
} elseif($type == 4){
    $data['log']=array(
        'ip'=>$_SERVER['REMOTE_ADDR'],
        'referrer'=>$_SERVER['HTTP_REFERER'],
        'type'=>3 //micro
    );
    $this->general_model->insertmy($table="registration_page_logs",$data['log']);
}
?>
