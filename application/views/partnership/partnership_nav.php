<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-partnership-nav.css' type='text/css'  />"));
    });
</script>
<?php $method = $this->router->method; ?>
<div id="partner-tabs" class="partner-tabs ext-arabic-partner-tabs">

    <ul class="list" role="tablist">
        <li role="presentation" class="<?=($method == 'friend_referrer') ? ' partner-active ' : '';?>">
            <a role="tab"  id="ps1" href="<?= FXPP::loc_url('partnership/friend-referrer');?>" class="list__item <?=($method == 'friend_referrer') ? ' partner-active ' : '';?>">
                <?= lang('pt_n_0');?>

            </a>
        </li>
        <li role="presentation" class="<?=($method == 'webmaster') ? ' partner-active' : '';?>">
            <a role="tab" id="ps2" href="<?= FXPP::loc_url('partnership/webmaster');?>"  class="list__item <?=($method == 'webmaster') ? ' partner-active' : '';?>">

                <?= lang('pt_n_1');?>

            </a>
        </li>
        <li role="presentation" class="<?=($method == 'online_partner') ? ' partner-active' : '';?>">
            <a role="tab" id="ps3"  href="<?= FXPP::loc_url('partnership/online-partner');?>" class="list__item <?=($method == 'online_partner') ? ' partner-active' : '';?>">

                <?= lang('pt_n_2');?>

            </a>
        </li>
        <li id="li4" role="presentation" class="<?=($method == 'local_online_partner') ? ' partner-active' : '';?>">
            <a role="tab"  id="ps4"  href="<?= FXPP::loc_url('partnership/local-online-partner');?>" class="list__item <?=($method == 'local_online_partner') ? ' partner-active' : '';?>">

                <?= lang('pt_n_3');?>

            </a>
        </li>
        <li role="presentation" class="<?=($method == 'local_office_partner') ? ' partner-active' : '';?>">
            <a role="tab"  id="ps5" href="<?= FXPP::loc_url('partnership/local-office-partner');?>" class="list__item <?=($method == 'local_office_partner') ? ' partner-active' : '';?>">

                <?= lang('pt_n_4');?>

            </a>
        </li>
        <li role="presentation" class="<?=($method == 'cpa') ? ' partner-active' : '';?>">
            <a role="tab" id="ps6"  href="<?= FXPP::loc_url('partnership/cpa');?>" class="list__item <?=($method == 'cpa') ? ' partner-active' : '';?>">

                <?= lang('pt_n_5');?>

            </a>
        </li>
    </ul>

    <div class="clearfix"></div>
</div>

<!--<script type="text/javascript">
    ( function( $, window, document, undefined )
    {
        'use strict';

        var $list       = $('.list'),
            $items      = $list.find('.list__item'),
            setHeights  = function()
            {
                $items.css( 'height', 'auto' );

                var perRow = Math.floor( $list.width() / $items.width() );
                if( perRow == null || perRow < 2 ) return true;

                for( var i = 0, j = $items.length; i < j; i += perRow )
                {
                    var maxHeight   = 0,
                        $row        = $items.slice( i, i + perRow );

                    $row.each( function()
                    {
                        var itemHeight = parseInt( $( this ).outerHeight() );
                        if ( itemHeight > maxHeight ) maxHeight = itemHeight;
                    });
                    $row.css( 'height', maxHeight );
                }
            };

        setHeights();
        $( window ).on( 'resize', setHeights );

    })( jQuery, window, document );
</script>-->

<script type="text/javascript">

    var pshighheight=0;
    var ps1=0;
    var ps2=0;
    var ps3=0;
    var ps4=0;
    var ps5=0;
    var ps6=0;

    $(window).load(function() {

        ps1 = parseFloat($('#ps1').height());
        ps2 = parseFloat($('#ps2').height());
        ps3 = parseFloat($('#ps3').height());
        ps4 = parseFloat($('#ps4').height());
        ps5 = parseFloat($('#ps5').height());
        ps6 = parseFloat($('#ps6').height());


        pshighheight=parseFloat(Math.round(Math.max(ps1,ps2,ps3,ps4,ps5,ps6)));
        $('#ps1').height(pshighheight);
        $('#ps2').height(pshighheight);
        $('#ps3').height(pshighheight);
        $('#ps4').height(pshighheight);
        $('#ps5').height(pshighheight);
        $('#ps6').height(pshighheight);

    });
    $(window).resize(function() {

        ps1 = parseFloat($('#ps1').height());
        ps2 = parseFloat($('#ps2').height());
        ps3 = parseFloat($('#ps3').height());
        ps4 = parseFloat($('#ps4').height());
        ps5 = parseFloat($('#ps5').height());
        ps6 = parseFloat($('#ps6').height());

        pshighheight=parseFloat(Math.round(Math.max(ps1,ps2,ps3,ps4,ps5,ps6)));


        $('#ps1').height(pshighheight);
        $('#ps2').height(pshighheight);
        $('#ps3').height(pshighheight);
        $('#ps4').height(pshighheight);
        $('#ps5').height(pshighheight);
        $('#ps6').height(pshighheight);
    });
</script>
