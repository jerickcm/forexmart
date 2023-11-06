<div class="IframeLoder"
     style=" display: none; z-index:2147483647;  background: #ccc none repeat scroll 0 0; height:100%; border: none; overflow: hidden; opacity: 0.8; position: absolute; text-align: center;    width: 100%;">
    <img style="margin-top: 90%" src="<?= $this->template->Images() ?>loder.GIF" width="36" height="36"
         alt="loading gif"/>
</div>


<!DOCTYPE html>
<html lang="en" dir="ltr" style=" margin-top: -10px">
<head>
    <link href="<?= $this->template->Css() ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->template->Css() ?>external-style.min.css" rel="stylesheet">
    <script src="<?= $this->template->Js() ?>jquery.min.js" type="text/javascript"></script>
</head>

<?php
$array = array();



if($values){
$row = $values->row_array();

$array = array();
foreach( explode("&",$row['value']) as $d){
    $explode = explode("=",$d);
    $array[$explode[0]] = $explode[1];
}


$width = $array['width'];
$nborder = $array['nborder'];
$nborty = $array['nborty'];
$nborcol = $array['nborcol'];
$nround = $array['nround'];
$nshado = $array['nshado'];
$nshadocol = $array['nshadocol'];
$nbgone = $array['nbgone'];
$nbgtwo = $array['nbgtwo'];
$nfont = $array['nfont'];
$nfontcolor = $array['nfontcolor'];

$hfont = $array['hfont'];
$hfontsize = $array['hfontsize'];
$hfontcolor = $array['hfontcolor'];
$hbg = $array['hbg'];


$newborder = $nborder . "px " . $nborty . " #" . $nborcol;
$nradious = explode(" ", $nround);
$nshados = explode(" ", $nshado);
}



?>

<style>

    .forex-calculator-child-input {
        margin-top: -12px;
    }

    .forex-calculator-child-input {
        margin-top: 10px;
    }

    .boxbgcolor {
        background-image: -ms-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

        background-image: -moz-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

        background-image: -o-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #<?=$nbgtwo?>), color-stop(100, #<?=$nbgtwo?>)) !important;

        background-image: -webkit-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

        background-image: linear-gradient(to top, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;
    }

    @media only screen and (max-width: 370px) {
        .col-res {
            float: none;
            margin: 0px 8px;
            width: 302px !important;
        }

        #iframeCalculatorBox {
            width: auto !important;
        }
    }
</style>

<body style=" background:none; overflow: hidden">


<div class="col-md-5 col-centered col-res" style="width:<?= $width ?>px; max-width: 600px">


    <div class="panel panel-default ticker-panel boxbgcolor"
         style="box-shadow:<?= $nshados[0] ?>px <?= $nshados[0] ?>px <?= $nshados[0] ?>px #<?= $nshadocol ?> !important;  border-radius:<?= $nradious[0] ?>px !important;border:<?= $newborder ?>;">
        <div class="panel-heading quotes-heading">
            <img src="<?= $this->template->Images() ?>fxlogonew.svg" class="informer-logo img-responsive">
        </div>

        <div class="panel-heading ticker-heading"
             style=" background:#<?= $hbg ?> !important;color:#<?= $hfontcolor ?> !important; font-family:<?= $hfont ?> !important; font-size:<?= $hfontsize ?> !important; border-radius:<?= $nradious[0] ?>px <?= $nradious[1] ?>px 0px 0px !important;">
            <?= lang('xnv_PIPCalc'); ?>
        </div>
        <div class="panel-body" style="font-family: <?= $nfont; ?> !important; color:#<?= $nfontcolor ?> !important">
            <form>
                <div class="form-group forex-calculator-child-input">
                    <label> <?= lang('x_fc_1'); ?></label>

                    <?= form_dropdown('CurrencyPair', $CurrencyPair, '', 'class="form-control round-0 calc-txt", id="CurrencyPair"'); ?>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <label>  <?= lang('x_fc_2'); ?></label>
                    <?= form_dropdown('Leverage', $Leverage, '', 'class="form-control round-0 calc-txt" id="Leverage"'); ?>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <label>  <?= lang('x_fc_3'); ?></label>
                    <?php $data['V'] = array(
                        'name' => 'Volume',
                        'id' => 'Volume',
                        'value' => '0.1',
                        'size' => '50',
                        'class' => 'form-control round-0',
                        'max' => '100000000000',
                        'min' => '0.1',
                        'type' => 'number',
                        'step' => '0.1'
                    );  ?>
                    <?= form_input($data['V']); ?>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <label> <?= lang('x_fc_4'); ?></label>
                    <?= form_dropdown('Currency', $Currency, '', 'class="form-control round-0 calc-txt" id="Currency"'); ?>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <button class="calc-btn" type="button" id="calculate"> <?= lang('x_fc_5'); ?></button>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <label> <?= lang('x_fc_6'); ?></label>

                    <div class="forex-calculator-input-result"><span id="currentQuotaRe"></span></div>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <label>  <?= lang('x_fc_7'); ?></label>

                    <div class="forex-calculator-input-result"><span id="valueRe"></span></div>
                </div>
                <div class="form-group forex-calculator-child-input">
                    <label> <?= lang('x_fc_8'); ?></label>

                    <div class="forex-calculator-input-result"><span id="marginRe"></span></div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>

<script>

    $(document).on("click", "#calculate", function () {
        $('.IframeLoder').show();
        var site_url = "<?=FXPP::ajax_url(); ?>";


        var split = $('#CurrencyPair option:selected').text().split('/');
        var CurrencySelected = $('#Currency option:selected').val();
        var newstring = $('#CurrencyPair option:selected').val();
        var parts = newstring.match(/[\s\S]{1,3}/g) || [];
        var Leverage = $('#Leverage option:selected').val().split(':');
        var Volume = $('#Volume').val();
        var splitname = $('#CurrencyPair option:selected').html().split('/');

        if (newstring.indexOf('#') != -1) {
            parts[0] = split[0];
        }
        if (newstring.indexOf('/') != -1) {
            parts[0] = split[0];
            parts[1] = split[1];
        }


        $.post(site_url + 'pages/API_CurrencyPairSpotCFD', {cur1: parts[0], cur2: parts[1], cur3: CurrencySelected, cur1name: splitname[0], cur2name: splitname[1], leverage: Leverage[1], volume: Volume}, function (result) {
            var data = JSON.parse(result);

            $('#currentQuotaRe').html(data.CurrentQuote);
            $('#valueRe').html(data.PIPValue);
            $('#marginRe').html(data.Margin);
            $('.IframeLoder').hide();
            //  console.log(data);
        });


    });


</script>        
