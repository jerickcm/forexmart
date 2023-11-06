<?php $this->lang->load('cashback'); ?>
<link href="<?= $this->template->Css()?>cashback.css" rel="stylesheet">



<?php if($request == 2){?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 cashback">
                <p>
                <div class="alert alert-success">
                    <strong> Cashback Request already sent!</strong>
                </div>
                </p>

            </div>
        </div>
    </div>
<?php }elseif($request == 3){ ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 cashback">
                <p>
                <div class="alert alert-success">
                    <strong> Cashback program join successfully!</strong>
                </div>
                </p>

            </div>
        </div>
    </div>

<?php }elseif($request == 1){?>


    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 cashback">
                <p>
                <div class="alert alert-success">
                    <strong> Cashback request sent successfully! </strong>
                </div>
                </p>
            </div>
        </div>
    </div>
<?php }else{?>

    <div class="cbheader">
        <div class="cashback" id="bgheader">
        </div>
    </div>

    </div>
    <div class="container">
        <div class="btn-join-holder">

            <?php  if ($this->session->userdata('logged')){?>
                <a href="<?=FXPP::loc_url('cashback/cashback_request')?>" class="btn-join"> <?=lang('cb_joinnow');?></a>
            <?php }else{?>
                <a href="<?=FXPP::loc_url('register')?>?id=IHXBM" class="btn-join"> <?=lang('cb_joinnow');?></a>
            <?php  }?>

        </div>
    </div>

<?php }?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 cashback">
            <?=lang('cb_1');?>

            <?=lang('cb_2');?>
            <ul>
                <li><?=lang('cb_li_1');?></li>
                <li><?=lang('cb_li_2');?>.</li>
                <li><?=lang('cb_li_3');?></li>
                <li><?=lang('cb_li_4');?></li>
            </ul></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="btn-register-holder">

        <?php  if ($this->session->userdata('logged')){?>
            <a href="<?=FXPP::loc_url('cashback/cashback_request')?>" class="btn-register"> <?=lang('cb_regnow');?></a>
        <?php }else{?>
            <a href="<?=FXPP::loc_url('register')?>?id=IHXBM" class="btn-register"> <?=lang('cb_regnow');?></a>
        <?php  }?>
    </div>
</div>