<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title">
                    <?= lang('b_h_0');?>
                </h1>
                <p class="license-text ext-arabic-license-text">
                    <?= lang('b_p_0');?>
                </p>
                <p class="license-text ext-arabic-license-text">
                    <?= lang('b_p_1');?>
                </p>

                <p class="license-sub ext-arabic-license-sub">
                    <?= lang('b_p_2');?>
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered banner-table ext-arabic-banner-table" id="bannerTable">
                        <thead>
                        <tr class="banner-table-header">
                            <td>#</td>
                            <td ><?= lang('b_p_2');?>
                            </td>
                            <td >
                                <?= lang('b_t_td_1');?>
                            </td>
                            <td>
                                <?= lang('b_t_td_2');?>
                            </td>
                            <td >
                                <?= lang('b_t_td_3');?>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $bannerList; ?>
                        </tbody>
                    </table>
                </div>
                <div class="forex-banners-container" id="ShowBannerPage" style="margin-top: 20px;">
                </div>

                <?= $DemoAndLiveLinks?>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="popupd" tabindex="-1" data-backdrop="static" role="dialog" >
    <div class="modal-dialog round-0" style="   left: 40%; position: fixed; top: 40%;">
        <img src="<?= $this->template->Images()?>/loder.GIF" class="img-responsive" style="margin-left: 114px;"  alt="" />
    </div>
</div>
<!-- end modal -->
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-banners.css' type='text/css'  />"));
    });
</script>

<script type="text/javascript">

    $(document).on("click",".btn-show-banner",function(){
        $('#popupd').modal('show');
        var pagename=$(this).attr("id");
        var lang='<?=FXPP::html_url()?>';

        $.post('<?=FXPP::ajax_url('banners/BannersShow')?>',{pagename:pagename,lang:lang},function(view){

            $("#ShowBannerPage").html(view);
            $('#popupd').modal('hide');
            // scroll position
            var Heigh=$("html").height();
            var scrolled=Heigh+320//(Heigh-((Heigh/2)/2));
            $("body, html").animate({  scrollTop:  scrolled});
        });
    });

    $(document).on("click","#ShowBannerPage textarea",function(){
        $(this).select();
    });
    // var table;
    // $(document).ready( function () {
    //     table = $('#bannerTable').DataTable({});
    // });
</script>