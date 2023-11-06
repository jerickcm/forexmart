
<script type="text/javascript">
    $(document).ready(function () {
        $(".hidden-menu").hide();
        $(".menu-button").show();

        $('.menu-button').click(function () {
            //$('.hidden-menu').toggle('slow', function () {
            });
        });
    });
</script>

<style>
    
    @media only screen and (max-width: 320px){
           .btn-chance-holder_for_rus a:lang(ru){
            padding: 17px 0px!important;
            width: 100%!important;
        }
    }
    .chance-list {
        margin-left: -9px;
    }

    .collapse.in {
        display: block;
        visibility: visible;
        background: none!important;
    }
    .nav-fix
    {
        position: fixed;
        top: 0;
        z-index: 9999;
        width: 100%;
        transition: all ease 0.3s;
    }
    .btn-chance-holder a{
        font-size: 24px!important;
    }
    .btn-chance-holder a:lang(sa){    
        margin: 15px 0 0 0!important;	
        width: 290px!important;
    }
    .margin_right_sa:lang(sa){
        margin-right: 18px!important;
    }
</style>


<div class="chance-header-holder">
    <div class="container">
        <div class="chance-header-cont row">
            <div class="col-md-7">
                <h2> <?=lang('x_chn_h2_0');?></h2>
                <p>
                    <?=lang('x_chn_p_0');?>
                </p>
                <div class="btn-chance-holder btn-chance-holder_for_rus">
                    <a href="<?php echo FXPP::loc_url('register')?>" class="btn-chance-register"><?=lang('x_chn_but_reg');?></a>
                    <a href="<?php echo fxpp::my_url('deposit')?>" class="btn-chance-deposit"><?=lang('x_chn_but_dep');?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="chance-terms-holder">
    <div class="container">
        <div class="chance-terms">
            <a href="javascript:void(0);" data-target="#terms"  data-parent="#accordion" href="#terms" data-toggle="collapse" aria-expanded="false" aria-controls="terms"><h2><?=lang('x_chn_h2_02');?></h2></a>
            <ul id="terms" class="collapse margin_right_sa">
                <li><span><?=lang('x_chn_li_01');?></span></li>
                <li><span><?=lang('x_chn_li_02');?></span></li>
                <li><span><?=lang('x_chn_li_03');?></span></li>
                <li><span><?=lang('x_chn_li_04');?></span></li>
                <li><span><?=lang('x_chn_li_05');?></span></li>
                <li><span><?=lang('x_chn_li_06');?></span></li>
                <li><span><?=lang('x_chn_li_07');?></span></li>
                <li><span><?=lang('x_chn_li_08');?></span></li>
                <li><span><?=lang('x_chn_li_09');?></span></li>
            </ul>
        </div>
    </div>
</div>