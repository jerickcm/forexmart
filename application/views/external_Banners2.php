<style>

.banner-img-holder
{
    margin-top: 80px;
}

.banner-table-header
{
    font-family: Open Sans!important;
    font-weight: 700;
}
.banner-table tr td
{
    text-align: center;
    vertical-align: middle!important;
    font-family: Open Sans;
}
.btn-show-banner
{
    border: none;
    font-size: 13px;
    font-family: Open Sans;
    padding: 5px 10px;
    background: #29a643;
    color: #fff;
    transition: all ease 0.3s;
}
.btn-show-banner:hover
{
    background: #37D057;
    transition: all ease 0.3s;
}
.dl-all
{
    font-family: Open Sans;
    text-align: right!important;
}
.dl-all a
{
    color: #ff0000;
}
.donalodFile{float: right; width: 100% ! important; text-align: center; margin-top: 10px; margin-bottom: 5px;}
.forex-banners-holder { margin-bottom: 25px}
.forex-banners-title h1{ text-align: center}
.forex-banner-container{text-align: center}
textarea{margin-bottom: 20px;}

.banner-txtarea{
    width: 100%;
    height: 150px;
}
</style>

<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">
                    <?= lang('b_h_0');?>
                </h1>
                <p class="license-text">
                    <?= lang('b_p_0');?>
                </p>
                <p class="license-text">
                    <?= lang('b_p_1');?>
                </p>

                <p class="license-sub">
                    <?= lang('b_p_2');?>
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered banner-table" id="bannerTable">
                        <thead>
                            <tr class="banner-table-header">
                                <td rowspan="2" class="rowspan">#</td>
                                <td rowspan="2"><?= lang('b_p_2');?>
                                </td>
                                <td rowspan="2" class="rowspan">
                                    <?= lang('b_t_td_1');?>
                                </td>
                                <td rowspan="2" class="rowspan">
                                    <?= lang('b_t_td_2');?>
                                </td>
                                <td rowspan="2" class="rowspan">
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
         
        <img src="<?= $this->template->Images()?>/loder.GIF" class="img-responsive" style="margin-left: 114px;"  >
           
       
    </div>
</div>
<!-- end modal -->




<script>
    
    $(document).on("click",".btn-show-banner",function(){
        $('#popupd').modal('show');
        var pagename=$(this).attr("id");

        $.post('/banners/BannersShow',{pagename:pagename},function(view){

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


    $(document).ready(function(){

        $('#bannersTable').DataTable()

    });


</script>