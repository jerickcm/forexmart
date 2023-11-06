<!DOCTYPE html>
<html lang="en" dir="ltr" style=" margin-top: -10px">
<head>
       <link href="<?php echo $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
       <link href="<?php echo  $this->template->Css()?>external-style.min.css" rel="stylesheet">
    <script src="<?php echo  $this->template->Js()?>jquery.min.js" type="text/javascript"></script>
</head>

<?php
extract($value);
/*$width=$this->input->get('width');



 $tdfcol=$this->input->get('tdfcol');
$tdfsize=$this->input->get('tdfsize');
$tdfont=$this->input->get('tdfont');


$hfcol=$this->input->get('hfcol');
$hfsize=$this->input->get('hfsize');
$hfont=$this->input->get('hfont');
$hbg=$this->input->get('hbg');*/

//$tickersArray=array(
//'EURUSD'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'GBPUSD'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'USDJPY'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'USDCHF'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'USDCAD'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'EURJPY'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'EURCHF'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'GBPJPY'=>array('Buy'=>'1.1332','Sell'=>'1.1332'),
//'GBPCHF'=>array('Buy'=>'1.1332','Sell'=>'1.1332')
//);
//
//FXPP::print_data($tickersArray);
//
//
//$tickers=$this->input->get('tickers');
//if(!empty($tickers))
//{
//    $fromTickerBox=  explode('~',$tickers);
//    var_dump($fromTickerBox);exit;
//   $tickersArray= array_intersect_key($tickersArray, array_flip($fromTickerBox));
//
//}

?> 
 
<style>
#fcfframe td{ color:#<?=$tdfcol?>;font-size:<?=$tdfsize?>px ; font-family:<?=$tdfont?> }    
#heademajorifram{color:#<?=$hfcol?>; font-size:<?=$hfsize?>px; font-family:<?=$hfont?>; background:#<?=$hbg?>  }    
</style>


<body style=" background:none; overflow: auto">
    <div class="quotes" style="width:<?=$width?>px; min-width: 290px" >
    <div class="panel panel-default">
        <div class="panel-heading quotes-heading">
            <img src="<?= $this->template->Images()?>logo.png" class="informer-logo img-responsive">
        </div>
        <div class="table-responsive" style="overflow: hidden">
            <table class="table table-striped quotes-table" id="majorifrmatable">
                <tr>
                    <th colspan="5" id="heademajorifram">Forex Major</th>
                </tr>
                <tbody id="fcfframe">

                <?php foreach($tickersArray as $key=>$val) {?>
                    <tr id="symbol_<?php echo $val['symbol'];?>">
                        <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                        <td class="currency symbol"><?php echo $val['symbol'];?></td>
                        <td><button class="btn-buy"> Buy</button></td>
                        <td class="bid"><?php echo $val['bid'];?></td>
                        <td class="ask"><?php echo $val['ask'];?></td>
                        <td><button class="btn-sell">  Sell</button></td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="panel-footer quotes-footer">Powered by ForexMart</div>
    </div>
</div>
    <script type="text/javascript">

        var urlGet = "<?php echo $tickers;?>";
        var needQuotes = ["EURUSD", "GBPUSD", "USDJPY", "USDCHF", "USDCAD", "EURJPY", "EURCHF", "GBPJPY", "GBPCHF"];
        var pblc = [];
        var prvt = [];
        pblc['request'] = null;
        var site_url="<?= FXPP::ajax_url(); ?>";
        $(document).ready(function(){
            var forexQuotes = function() {

                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url: site_url + 'quotes/getForexQuotes?tickers='+urlGet,
                    method: 'POST',
                    data: prvt["data"]
                });
                pblc['request'].done(function( result ) {
//                console.log(result);
//                var json = JSON.parse(result);
//                jQuery.each( json, function(i, wdwadwa ) {
                    jQuery.each( result, function(i, wdwadwa ) {
                        var bid = getPrice(parseFloat(wdwadwa.bid), wdwadwa.digits);
                        var ask = getPrice(parseFloat(wdwadwa.ask), wdwadwa.digits);
                        var symbol = "#symbol_" + wdwadwa.symbol;
                        $(symbol + " td.symbol").html(wdwadwa.symbol);
                        $(symbol + " td.bid").html(bid);
                        $(symbol + " td.ask").html(ask);
                        $(symbol + " td.change").html(wdwadwa.change);
                    });
                });
                pblc['request'].fail(function( jqXHR, textStatus ) {

                });
            };
            forexQuotes();
            setInterval(function () {forexQuotes()}, 5000);
        });
        //    $(document).ready(function() {
        //        forexQuotes();
        //        setInterval(function () {forexQuotes()}, 5000);
        //    });
        //    function forexQuotes(){
        //        $.post( 'index.php?/quotes/getForexQuotes', function(result){
        //            var json = JSON.parse(result);
        //            jQuery.each( json, function(i, wdwadwa ) {
        //                var bid = getPrice(parseFloat(wdwadwa.bid), wdwadwa.digits);
        //                var ask = getPrice(parseFloat(wdwadwa.ask), wdwadwa.digits);
        //                var symbol = "#symbol_" + wdwadwa.symbol;
        //                $(symbol + " td.symbol").html(wdwadwa.symbol);
        //                $(symbol + " td.bid").html(bid);
        //                $(symbol + " td.ask").html(ask);
        //                $(symbol + " td.change").html(wdwadwa.change);
        //            });
        //        });
        //    }
        function getPrice(val, digits){return retVal = (val.toFixed(digits)).toString();}
    </script>
</body>    
</html>    