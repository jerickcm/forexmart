<link href="<?= $this->template->Css()?>contest_header.css" rel="stylesheet">

     <div class="container">
         <div class="contest-page-container">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class=" contest-page-border">
                     <div class="contest-page-title"><h2><?=lang('cmf_h1_0')?></h2><h1><?=lang('cmf_h1_1')?></h1>
                     </div></div></div>

             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-top text-center">
                 <a href="<?=FXPP::loc_url('forex-contests/money-fall/ranking')?>" id="showdiv3" class="btn btn-ranking hvr-shutter-out-horizontal<?php echo $active == 1? ' btn-active': '' ?>"><?=lang('cmf_ranking')?></a>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-top text-center">
                 <a href="<?=FXPP::loc_url('forex-contests/money-fall/winners')?>" id="showdiv2" class="btn btn-winners hvr-shutter-out-horizontal<?php echo $active == 2? ' btn-active': '' ?>"><?=lang('cmf_winners')?></a>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-top text-center">
                 <a href="<?=FXPP::loc_url('forex-contests/money-fall/contest-rules')?>" id="showdiv1" class="btn btn-rules hvr-shutter-out-horizontal<?php echo $active == 3? ' btn-active': '' ?>"><?=lang('cmf_contestrules')?></a>
             </div>

             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-top text-center">
                 <a href="<?=FXPP::loc_url('forex-contests/money-fall/contest-archive')?>" class="btn btn-rules hvr-shutter-out-horizontal<?php echo $active == 4? ' btn-active': '' ?>"><?=lang('cmf_contestarchive')?></a>
             </div>

             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                 <a href="<?=FXPP::loc_url('forex-contests/money-fall/registration')?>" class="btn btn-register hvr-shutter-out-vertical"><?= lang('cmf_a_0');?></a>
             </div>
         </div>

     </div>

     <hr class="no-margin" />

     <div class="prizes-container">
         <div class="container">
             <div class="contest-prizes-container">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding no-margin">
                     <div  style=" background-image: url(<?= $this->template->Images()?>titleprizes.png); background-repeat: repeat-y;width:100%;margin: auto; max-width:384px; min-height:82px;color:#fff; font-size:18px;text-align:center;" class="img-responsive center top-titleprizes"><br><h2 style="margin-top:-8px;"><!--  CONTEST PRIZES --><?=lang('contest-prizes')?></h2></div>
                 </div>

                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-01.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('1_place')?> - <b>300 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-02.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('2_place')?> - <b>90 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-03.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('3_place')?> - <b>75 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-04.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('4_place')?> - <b>70 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-05.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('5_place')?> - <b>65 <?=$default_currency ?></b></h4></div>
                 </div>

                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-06.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('6_place')?> - <b>60 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-07.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('7_place')?> - <b>55 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-08.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('8_place')?> - <b>50 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-09.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('9_place')?> - <b>45 <?=$default_currency ?></b></h4></div>
                 </div>
                 <div class="col-md-15 col-sm-3 text-center no-padding">
                     <img src="<?= $this->template->Images()?>trophy_images/trophy-10.png" alt="" class="img-responsive center">
                     <div class="prizes-desc"><h4><?=lang('10_place')?> - <b>40 <?=$default_currency ?></b></h4></div>
                 </div>

             </div>
         </div>
     </div>


     <hr class="no-margin" />
