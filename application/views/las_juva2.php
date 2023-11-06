
<link href="<?= $this->template->Css()?>jquery.fancybox.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>external-style2.min.css" rel="stylesheet">

<script type="text/javascript">

    $(document).ready(function() {
        $('.fancybox').fancybox();
    });

    $(document).ready(function () {
         $('.page-link').mouseover(function () {
            $($(this).data('target')).fadeIn("fast");

        });
         $('.page-link').mouseleave(function () {
            $($(this).data('target')).fadeOut("fast");
        });

        $(".hidden-menu").hide();
        $(".menu-button").show();

      });

    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-las-juva.css' type='text/css'  />"));
    });
     $(window).bind('scroll', function() {
         if ($(window).scrollTop() > 95) {
             $('#nav').addClass('nav-fix');
         }
         else {
             $('#nav').removeClass('nav-fix');
         }
    });
</script>

<div class="reg-form-holder">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">                       
        <div class="personal-page-holder">
          <div class="personal-info-holder row">
            <div class="col-md-3 col-sm-3">
              <div class="personal-img-holder">
                <img src="<?= $this->template->Images()?>valeron-dp.png" class="img-responsive" alt="" />
              </div>
            </div>
            <div class="col-md-9 col-sm-9" dir="ltr">
              <div class="personal-info">
                <div class="club-info-holder">
                  <span>21</span>
                  <div class="player-name">
                      <h1>
                        <?=lang('ljv_01');?>
                        <small>
                          <img src="<?= $this->template->Images()?>laspalmas-logo.png" class="laspalmas-sm-logo" alt="" />
                          <?=lang('ljv_02');?>
                        </small>
                      </h1>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <p class="p-fc">
                  <?=lang('ljv_03');?>
                  <span><?=lang('ljv_04');?></span>
                </p>
                <p>
                  <?=lang('ljv_05');?>
                  <span><?=lang('ljv_06');?></span>
                </p>
                <p>
                  <?=lang('ljv_07');?>
                  <span> <?=lang('ljv_08');?></span>
                </p>
                <p>
                  <?=lang('ljv_09');?>
                  <span><?=lang('ljv_10');?></span>
                </p>
                <p>
                  <?=lang('ljv_11');?>
                  <span><?=lang('ljv_12');?></span>
                </p>
              </div>
            </div>
            <div class="col-md-12" dir="ltr">
              <div id="demo" class="demo">
                <div class="span12">
                  <div id="owl-demo" class="owl-carousel">
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/0.jpg" data-fancybox-group="gallery">
                          <img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/0.png" src="<?= $this->template->Images()?>gallery2/0.png" alt=""/>
                      </a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/1.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/1.png" src="<?= $this->template->Images()?>gallery2/1.png" alt=""/></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/2.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/2.png" src="<?= $this->template->Images()?>gallery2/2.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/3.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/3.png" src="<?= $this->template->Images()?>gallery2/3.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/4.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/4.png" src="<?= $this->template->Images()?>gallery2/4.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/5.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/5.png" src="<?= $this->template->Images()?>gallery2/5.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/6.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/6.png" src="<?= $this->template->Images()?>gallery2/6.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/7.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/7.png" src="<?= $this->template->Images()?>gallery2/7.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/8.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/8.png" src="<?= $this->template->Images()?>gallery2/8.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/9.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/9.png" src="<?= $this->template->Images()?>gallery2/9.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/10.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/10.png" src="<?= $this->template->Images()?>gallery2/10.png" alt=""></a>
                    </div>
                    <div class="item">
                      <a class="fancybox" href="<?= $this->template->Images()?>gallery2/big/11.jpg" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery2/11.png" src="<?= $this->template->Images()?>gallery2/11.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            
        <p class="personal-info-text">
          <span><?=lang('ljv_13');?></span>
          <?=lang('ljv_14');?>
          <span><?=lang('ljv_15');?></span>)
          <?=lang('ljv_16');?>
          <a href="#"><?=lang('ljv_17');?></a>
          <?=lang('ljv_18');?>
          <span><?=lang('ljv_19');?></span>
          <?=lang('ljv_20');?>
        </p>

        <h1 class="personal-text-title"><?=lang('ljv_21');?></h1>

        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_22');?>
          <span><?=lang('ljv_23_v');?></span>
          <?=lang('ljv_23');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_24');?>
          <span><?=lang('ljv_24_v');?></span>
          <?=lang('ljv_25');?>
          <span><?=lang('ljv_26');?></span>
          <?=lang('ljv_27');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_28');?>
          <span><?=lang('ljv_29');?></span>
          <?=lang('ljv_30');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_31');?>
          <span><?=lang('ljv_32');?></span>
          <?=lang('ljv_33');?>
          <span><?=lang('ljv_34');?></span>
          <?=lang('ljv_35');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_36');?>
          <span><?=lang('ljv_37');?></span>
          <?=lang('ljv_38');?>
          <span><?=lang('ljv_39');?></span>
          <?=lang('ljv_40');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <span><?=lang('ljv_41');?></span>
          <?=lang('ljv_42');?>
          <span><?=lang('ljv_43');?></span>
          <?=lang('ljv_44');?>
          <span><?=lang('ljv_45');?></span>
          <?=lang('ljv_46');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_47');?>
          <span><?=lang('ljv_48');?></span>
          <?=lang('ljv_49');?>
        </p>
        <h1 class="personal-text-title"><?=lang('ljv_50');?></h1>

        <p class="personal-info-text ext-arabic-personal-info-text">
          <span><?=lang('ljv_51');?></span>
          <?=lang('ljv_52');?>
          <span><?=lang('ljv_53');?></span>
          <?=lang('ljv_54');?>
          <span><?=lang('ljv_55');?></span>
          <?=lang('ljv_56');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_57');?>
        </p>
        <p class="personal-info-text ext-arabic-personal-info-text">
          <?=lang('ljv_58');?>
          <span><?=lang('ljv_59');?></span>
          <?=lang('ljv_60');?>
          <span><?=lang('ljv_61');?></span>
          <?=lang('ljv_62');?>
        </p>

        <h1 class="personal-text-title"><?=lang('ljv_63');?></h1>
        
        <p class="personal-info-text ext-arabic-personal-info-text">
          <span><?=lang('ljv_64');?></span>
          <?=lang('ljv_65');?>
          <span><?=lang('ljv_66');?></span>
          <?=lang('ljv_67');?>
        </p>
      </div>
    </div>
  </div>
</div>


    <!-- carousel for valeron page -->
    
<script src="<?= $this->template->Js()?>/jquery.fancybox.pack.js"></script>    
