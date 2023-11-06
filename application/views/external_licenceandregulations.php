<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-licenceandregulation.css' type='text/css'  />"));
    });
</script>
    <div class="formContainer">
        <div class="container">
            <h2 class="formTitle"><?= lang('lar_header');?></h2>        
             <ul class="logoList">
                <li>
                    <a class="linkLogo" href="<?=FXPP::loc_url('pages/cysec')?>"><img src="<?= $this->template->Images()?>cysec.png" alt="" class="imgList img-responsive"></a>
                    <a class="linkLogo" href="<?=FXPP::loc_url('pages/fca')?>"><img src="<?= $this->template->Images()?>fca.png" alt="" class="imgList img-responsive"></a>
                    <a class="linkLogo" href="<?=FXPP::loc_url('pages/amf')?>"><img src="<?= $this->template->Images()?>amf.png" alt="" class="imgList img-responsive"></a>
                    <a class="linkLogo" href="<?=FXPP::loc_url('pages/bafin')?>"><img src="<?= $this->template->Images()?>bafin.png" alt="" class="imgList img-responsive"></a>
                    <a class="linkLogo one" href="<?=FXPP::loc_url('pages/consob')?>"><img src="<?= $this->template->Images()?>consob.png" alt="" class="imgList img-responsive"></a>
                </li>                
            </ul>             
        </div>
    </div>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="license-text ext-arabic-license-text">
                    <img class="tradomart" width="101" height="11" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png"/>
                    <?= lang('lar_p1-1');?>
                    <a href="http://www.cysec.gov.cy/en-GB/entities/investment-firms/cypriot/71294/" target="_blank">"<?= lang('lar_p1-2');?>"</a>
                    <?= lang('lar_p1-3');?>
                </p>
                <p class="license-text">
                    <?= lang('lar_p2-1');?>
                </p>
                <p class="license-text">
                    <?php if(FXPP::html_url()!='fr'){ ?>
                        <img class="tradomart"  width="75" height="11" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-small-black.png" />
                    <?php } else {?>
                        <img class="tradomart" width="101" height="11" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png"/>
                    <?php } ?>
                    <?= lang('lar_p3-1');?>
                </p>
                <p class="license-text">
                    <?= lang('lar_p4-1');?>
                    <a href="http://ec.europa.eu/finance/securities/isd/mifid/index_en.htm" target="_blank"><?= lang('lar_p4-2');?></a>
                    <?= lang('lar_p4-3-1');?>
                    <?php if(FXPP::html_url()!='fr'){ ?>
                        <img class="tradomart" width="101" height="11" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png"/>
                    <?php } ?>
                    <?= lang('lar_p4-3-2');?>
                </p>

            </div>
            <div class="col-lg-12 adj-s">
                <?= $this->load->ext_view('modal', 'PaymentSystemCarousel', '', TRUE); ?>
            </div>
        </div>
    </div>
</div>