<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title sa-right">
                    <?=lang('EAV_h_t');?>
                </h1>

                <div class="col-sm-3 img-acc-ver-holder ext-arabic-img-acc-ver-holder">
                    <img src="<?= $this->template->Images()?>acct-ver.png" class="img-reponsive"  alt="Account Verification" />
                </div>

                <div class=" col-sm-9 ext-arabic-license-text-parent marg-bot" >
                    <p class="license-text">
                        <?=lang('EAV_p0-0');?>
                        <span class="company">
                            <?=lang('EAV_p0-1');?>
                        </span>
                        <?=lang('EAV_p0-2');?>
                        <br><br>
                        <?=lang('EAV_p0-4');?>
                        <br><br>
                        <?=lang('EAV_p0-5');?>
                        <br><br>
                    </p>
                </div>
                <p class="license-sub ext-arabic-license-sub sa-right">
                    <?=lang('EAV_p1-0');?>
                </p>
                <ul class="acct-verification-text ext-arabic-acct-verification-text">
                    <li><span>
                            <?=lang('EAV_li0-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li1-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li2-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li3-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li4-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li5-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li6-0');?>
                        </span></li>
                    <li><span>
                        <?=lang('EAV_li7-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li9-0');?>
                        </span></li>
                    <li><span>
                            <?=lang('EAV_li10-0');?>
                        </span></li>
                </ul>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-account-verification.css' type='text/css'  />"));
    });
</script>