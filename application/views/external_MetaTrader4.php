<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-metatrader4.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
 <a name="mt4-mobile"></a>
    <div class="fm-mobile-holder">
        <div class="container">
            <h1 class="fm-page-title"> <?=lang('mt4_mob_h1_0');?></h1>
            <p class="fm-title-desc"> <?=lang('mt4_mob_desc_0');?></p>
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <ul class="fmobile-list-desc">
                        <li> <?=lang('mt4_mob_li_0');?></li>
                        <li> <?=lang('mt4_mob_li_1');?></li>
                        <li> <?=lang('mt4_mob_li_2');?></li>
                        <li> <?=lang('mt4_mob_li_3');?></li>
                        <li> <?=lang('mt4_mob_li_4');?></li>
                    </ul>
                </div>
                <div class="col-md-7 col-sm-6">
                    <img src="<?= $this->template->Images()?>mt4/img_fmobile.png" class="img-responsive img_fmobile" alt="" />
                    <div class="row img-btns-holder">
                        <p class="text-above-btn"> <?=lang('mt4_mob_h1_1');?></p>
                        <div class="col-md-offset-2 col-md-4 col-sm-offset-0 col-sm-6 col-xs-6">
                            <a href=" https://itunes.apple.com/app/metatrader-4/id496212596?l=en&mt=8" class="img-btn btn-appstore">
                                <img src="https://www.forexmart.com/assets/images/mt4/btn-appstore.png" class="img-responsive" alt="" />
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <a href="  https://play.google.com/store/apps/details?id=net.metaquotes.metatrader4" class="img-btn">
                                <img src="https://www.forexmart.com/assets/images/mt4/btn-googleplay.png" class="img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <a name="mt4-desktop"></a>
    <div class="mt4-desktop-holder">
        <div class="container mt4-parent">
            <h1 class="fm-page-title title-desktop"><?=lang('mt4_h2_0');?><b class="break-inline"><?=lang('mt4_h2_1');?></b></h1>
            <img src="<?= $this->template->Images()?>mt4/img-mt4-desktop.png" class="img-responsive img-mt4-desktop" alt="" />
        </div>
    </div>
    <div class="mt4-desktop-desc">
        <div class="container">
            <p class="fm-title-desc" style="color:#fff; text-shadow:0px 0px 5px rgba(0,0,0,0.7);"><?=lang('mt4_p_0');?></p>
            <div style="display:block; text-align:center;">
                <ul class="fdesktop-list-desc">
                    <li><i class="fa fa-check"></i><?=lang('mt4_li_0');?></li>
                    <li><i class="fa fa-check"></i><?=lang('mt4_h1_0');?></li>
                    <li><i class="fa fa-check"></i><?=lang('mt4_li_2');?></li>
                    <li><i class="fa fa-check"></i><?=lang('mt4_li_3');?></li>
                </ul>
            </div>
            <a href="https://download.mql5.com/cdn/web/tradomart.ltd/mt4/forexmart4setup.exe" id="btnReg" class="btn link-download" >
                <?=lang('mt4_DF');?>
            </a>
        </div>
    </div>

<a name="mt4-webterminal"></a>
    <div class="fm-webterminal">
        <div class="container">
            <h1 class="fm-page-title"><?=lang('mt4_wt_h1');?></h1>
            <p class="fm-title-desc"><?=lang('mt4_wt_p');?></p>
            <div class="fm-btn-container">

                <?php if(FXPP::html_url() === 'ru'){ ?>
                    <a href="https://webterminal.forexmart.com/" class="btn btn-border"><?=lang('mt4_wt_a');?> <i class="fa fa-arrow-circle-right"></i></a>
                <?php }else{ ?>
                    <a href="https://webterminal.forexmart.com/" class="btn btn-border"><?=lang('mt4_wt_a');?> <i class="fa fa-arrow-circle-right"></i></a>
                <?php } ?>

            </div>
            <img class="img-responsive fm-img-center" src="<?= $this->template->Images()?>mt4/webterminal-img-01.png" alt="" />
        </div>
        <div class="fm-webterminal-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6 fm-text-above-img">
                        <span><img src="<?= $this->template->Images()?>mt4/icon-webterminal-01.png" alt="" /></span>
                        <p>No software installation</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 fm-text-above-img">
                        <span><img src="<?= $this->template->Images()?>mt4/icon-webterminal-02.png" alt="" /></span>
                        <p>Compatibility with Windows, Mac, Linux O.S.</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 fm-text-above-img">
                        <span><img src="<?= $this->template->Images()?>mt4/icon-webterminal-03.png" alt="" /></span>
                        <p>Secured trading</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 fm-text-above-img">
                        <span><img src="<?= $this->template->Images()?>mt4/icon-webterminal-04.png" alt="" /></span>
                        <p>Synchronized in all platforms</p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 fm-text-above-img">
                        <span><img src="<?= $this->template->Images()?>mt4/icon-webterminal-05.png" alt="" /></span>
                        <p>Access multiple charts </p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 fm-text-above-img">
                        <span><img src="<?= $this->template->Images()?>mt4/icon-webterminal-06.png" alt="" /></span>
                        <p>Real-time quotes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>
<script type="application/javascript">
    jQuery('#btnReg').on('click', function(e){
        var url="<?= FXPP::ajax_url('') ?>";
        jQuery.ajax({
            type: 'POST',
            url: url+'metatrader4/download',
            dataType: 'json',
            async: false,
            data: {key:'<?php echo $form['form_key'] ?>'},
            success: function(response){
                if( !response.is_counted ){
                    e.preventDefault();
                    location.reload();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                e.preventDefault();
                location.reload();
            }
        });
    });
</script>