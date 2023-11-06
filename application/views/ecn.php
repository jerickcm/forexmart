
<div class="partnership-main-holder">
<div class="container-fluid">
<div class="row">
<div class="col-lg-2 col-md-2 col-2-left">
    <?php
    include_once('layouts/external/sidebar-left.php');
    ?>
</div>
<div class="col-lg-8 col-md-8 col-8-center">
<div class="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="license-title"><?=lang('x_ecn_ttle');?></h1>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="license-text"><?=lang('x_ecn_dsc');?></p>
                <p class="license-text">
                    <strong><?=lang('x_ecn_q1');?></strong>
                    <br/>
                    <?=lang('x_ecn_ans1');?>

                </p>
                <div class="ecn-img-holder col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php switch(FXPP::html_url()){
                    case 'en':
                    case '':
                        ?>
                            <img src="<?= $this->template->Images()?>ecn-img.png" alt="" class="img-responsive"/>
                            <?php break;
                    case 'ru': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-ru.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'jp': ?>
                        <img src="<?= $this->template->Images()?>ecn-img.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'de': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-german.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'id': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-ind.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'sa': ?>
                        <img src="<?= $this->template->Images()?>ecn-img.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'fr': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-french.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'es': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-spanish.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'it': ?>
                        <img src="<?= $this->template->Images()?>ecn-img.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'pt': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-portuguese.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'bg': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-bulgarian.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'my': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-malaysia.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'pk': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-urdu.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'pl': ?>
                        <img src="<?= $this->template->Images()?>ecn-img-polish.png" alt="" class="img-responsive"/>
                        <?php break;
                    case 'gr': ?>
                        <img src="<?= $this->template->Images()?>ecn-img.png" alt="" class="img-responsive"/>
                        <?php break;
                }
                    ?>
                </div>
                <p class="license-text">
                    <strong> <?=lang('x_ecn_q2');?></strong>
                    <br/>
                    <?=lang('x_ecn_ans2');?>
                </p>

                <ul class="demo-feats ecn-feats">
                    <li>
                        <i class="fa fa-check"></i>
                        <span class="ecn-list"><?=lang('x_ecn_res1');?></span>
                        <p>
                            <?=lang('x_ecn_det1');?>
                        </p>
                    </li>
                    <li class="clearfix"></li>
                    <li>
                        <i class="fa fa-check"></i>
                        <span class="ecn-list"><?=lang('x_ecn_res2');?></span>
                        <p>
                            <?=lang('x_ecn_det2');?>
                        </p>
                    </li>
                    <li class="clearfix"></li>
                    <li>
                        <i class="fa fa-check"></i>
                        <span class="ecn-list"><?=lang('x_ecn_res3');?></span>
                        <p>
                            <?=lang('x_ecn_det3');?>
                        </p>
                    </li>
                    <li class="clearfix"></li>
                    <li>
                        <i class="fa fa-check"></i>
                        <span class="ecn-list"><?=lang('x_ecn_res4');?></span>
                        <p>
                            <?=lang('x_ecn_det4');?>
                        </p>
                    </li>
                    <li class="clearfix"></li>
                    <li>
                        <i class="fa fa-check"></i>
                        <span class="ecn-list"><?=lang('x_ecn_res5');?></span>
                        <p>
                            <?=lang('x_ecn_det5');?>
                        </p>
                    </li>
                    <li class="clearfix"></li>
                    <li>
                        <i class="fa fa-check"></i>
                        <span class="ecn-list"><?=lang('x_ecn_res6');?></span>
                        <p>
                            <?=lang('x_ecn_det6');?>
                        </p>
                    </li>
                </ul>

                <p class="license-text">
                    <strong><?=lang('x_ecn_q3');?></strong>
                    <br/>
                    <?=lang('x_ecn_ans3');?>
                    <br/><br/>
                    <?=lang('x_ecn_tag');?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="ecn-form">
    <div class="container">
        <div class="row">
            <div class="ecn-form-parent col-lg-5 col-md-5 col-sm-7 col-xs-12 ecn-box">
                <div class="ecn-form-holder">
                    <div class="right-bonus-container">
                        <!-- form start -->
                        <!--
                        <form id="register" action="" method="post" class="form-horizontal">

                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container">
                            <label class="bonus-label">Full Name <cite class="req">*</cite></label>
                            <input name="full_name" type="text" class="form-control round-0" placeholder="Full Name" value="<?=set_value('full_name');?>"/>
                            <span class="red"><?=form_error('full_name')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container">
                            <label class="bonus-label">Email <cite class="req">*</cite></label>
                            <input name="email" type="text" class="form-control round-0" placeholder="Email" value="<?=set_value('email');?>"/>
                            <span class="red"><?=form_error('email')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-6 col-xs-12 bonus-child-container">
                            <label class="bonus-label">Account Currency <cite class="req">*</cite></label>
                            <select class="form-control round-0 required" name="mt_currency_base" id="mt_currency_base">
                                <option value="">Select</option>
                                <?php echo $account_currency_base;?>
                            </select>
                            <span class="red"><?=form_error('mt_currency_base')?></span>
                        </div>
                        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bonus-child-container">
                            <button class="btn-submit" id="complete_btn" type="button" >Submit</button>
                        </div>
                        </form> -->

                        <form action="<?=FXPP::loc_url('register/index');?>" method="post" class="form-horizontal task2163">

                            <?php /*if(form_error('email') || form_error('full_name')){*/?><!--
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php /*echo  form_error('email')*/?>
                                              <?php /*echo  form_error('full_name')*/?>
                        </div>
                        --><?php /*}*/?>

                            <div class="form-group note-group">
                                <label for="inputEmail3" class=" control-label ext-arabic-registration-content <?= (FXPP::html_url()=='sa')? 'col-lg-3 col-md-4 col-sm-12 col-xs-12' :'col-sm-3'; ?>" id="lbl_email"><?=lang('x_ecn_3');?><cite class="req">*</cite></label>
                                <div class="col-sm-10 live-trading-note ext-arabic-registration-content <?= (FXPP::html_url()=='sa')? 'col-lg-9 col-md-8 col-xs-12' :'col-sm-9'; ?>" id="div_email">
                                    <p class="note-top">(<?=lang('x_ecn_8');?>)</p>
                                    <input name="email" type="text" maxlength="128" class="form-control round-0 <?php echo form_error('email')?"red-border":""?> ext-arabic-form-control-placeholder" id="inputEmail3" placeholder="<?=lang('x_ecn_3');?>" value="<?=set_value('email');?>">
                                    <span class="red">  <?php echo  form_error('email')?> </span>
                                </div>
                            </div>
                            <div class="form-group note-group">
                                <label  class="control-label ext-arabic-registration-content <?= (FXPP::html_url()=='sa')? 'col-lg-3 col-md-4 col-sm-12 col-xs-12' :'col-sm-3 '; ?>" id="lbl_fn"><?=lang('x_ecn_4');?><cite class="req">*</cite></label>
                                <div class=" live-trading-note ext-arabic-registration-content <?= (FXPP::html_url()=='sa')? 'col-lg-9 col-md-8 col-sm-12 col-xs-12' :'col-sm-9'; ?>" id="div_fn">
                                    <p class="note-top">(<?=lang('x_ecn_9');?>)</p>
                                    <input name="full_name" type="text" maxlength="48" class="form-control round-0 <?php echo form_error('full_name')?"red-border":""?> ext-arabic-form-control-placeholder" id="full" placeholder="<?=lang('x_ecn_10');?>" value="<?=set_value('full_name');?>">
                                    <span class="red"> <?php echo  form_error('full_name')?> </span>
                                </div>
                            </div>
                            <div class="form-group note-group">
                                <label  class="control-label ext-arabic-registration-content <?= (FXPP::html_url()=='sa')? 'col-lg-3 col-md-4 col-sm-12 col-xs-12' :'col-sm-3 '; ?>" ></label>
                                <div class=" live-trading-note ext-arabic-registration-content <?= (FXPP::html_url()=='sa')? 'col-lg-9 col-md-8 col-sm-12 col-xs-12' :'col-sm-9'; ?>">
                                    <div class="ecn-cta"><button type="submit"><?=lang('x_ecn_STN');?></button></div>

                                </div>
                            </div>


                            <!-- </div> -->
                            <div class="clearfix"></div>
                            <!--  </div> -->
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ext-arabic-registration-bottom ">
                                <label class="control-label form-text">
                                    <?=lang('x_ecn_6');?>
                                </label>
                            </div>
                        </form>
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?= $DemoAndLiveLinks; ?>
    </div>
</div>

<div class="feats-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 feat">
                <a href="<?=FXPP::loc_url('why-choose-us')?>" class="feat-link">
                    <img src="<?= $this->template->Images()?>circle1.png" class="img-reponsive" width="100" alt="" />
                    <h1 class="feath1">
                        <?= lang('fts_hldr_0')?>
                    </h1>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 feat">
                <a href="<?=FXPP::loc_url('why-choose-us')?>" class="feat-link">
                    <img src="<?= $this->template->Images()?>circle2.png" alt="" class="img-reponsive" width="100"/>
                    <h1 class="feath1">
                        <?= lang('fts_hldr_1')?>
                    </h1>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 feat">
                <a href="<?=FXPP::loc_url('why-choose-us')?>" class="feat-link">
                    <img src="<?= $this->template->Images()?>circle3.png" alt="" class="img-reponsive" width="100"/>
                    <h1 class="feath1">
                        <?= lang('fts_hldr_2')?>
                    </h1>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 feat">
                <a href="<?=FXPP::loc_url('why-choose-us')?>" class="feat-link">
                    <img src="<?= $this->template->Images()?>circle4.png" alt="" class="img-reponsive" width="100"/>
                    <h1 class="feath1">
                        <?= lang('fts_hldr_3')?>
                    </h1>
                </a>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="manageedit" tabindex="-1" role="dialog" >
    <div class="modal-dialog round-0">
        <div class="modal-content bonus-modal-container ex-modal-content round-0">
            <div class="modal-header ex-modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title-sub ex-modal-title">ForexMart 30% Bonus</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 bonus-modal-img">
                        <img src="<?= $this->template->Images()?>bonus-modal-icon.png" alt="" class="img-responsive"/>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 bonus-col-centered">
                        <p><strong>Thank you for registering!</strong> We have sent your access details to your email.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>
<div class="col-lg-2 col-md-2 col-2-right">
    <?php
    include_once('layouts/external/sidebar-right.php');
    ?>
</div>
</div>
</div>
</div>

<?php

if($this->session->flashdata('message')=='done'){
    ?>

<script>

    $("#manageedit").modal('show');

</script>


<?php
}
?>

    <script type="text/javascript">
        $(document).ready(function(){
            $("head").append('<style>.ecn-form-holder{display: block;}.right-bonus-container{display: block;}.red p{font-size: 14px}</style>');
        });
    </script>

<?php if(IPLoc::Office()){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("head").append('<style>@media screen and (min-width: 992px)  {.ecn-box:lang(ru) {width: 51%!important;}.note-group .live-trading-note:lang(ru){width: 62%!important;}.ext-arabic-registration-content:lang(ru){width: 38%!important;}}</style>');
        });
    </script>
<?php } ?>

<script>
    $(document).on("click","#complete_btn",function(){
        $("#register").submit();
    })
</script>