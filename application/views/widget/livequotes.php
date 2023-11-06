<!DOCTYPE html >
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/jquery-ui.css">
    <script src="<?= $this->template->Js()?>jquery-1.11.3.min.js"></script>
    <script src="<?= $this->template->Js()?>tickchart/UIControls/jquery-ui.js"></script>
    <link href="<?php echo $this->template->Css()?>chart-new.css" rel="stylesheet" type="text/css">
    <script src="<?php echo $this->template->Js()?>cbpFWTabs.js" type="text/javascript"></script>

    <script src="<?php echo $this->template->Js()?>Moment.js" type="text/javascript"></script>
    <script src="<?php echo $this->template->Js()?>datetime-moment.js" type="text/javascript"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
</head>

<body>
<script>
    function trigger_symbol (value){
        switch(value){
            case 0:
                /*forex*/
                $(".defaultforex").click();
                break;
            case 1:
                /*shares*/
                $(".defaultshares").click();
                break;
            case 2:
                /*metal*/
                $(".defaultmetals").click();
                break;
            case 3:
                /*bitcoin*/
                $(".defaultbitcoin").click();
                break;
            default:
        }
    }
</script>
<div>
    <div class="charttitle"><h3>Live Quotes</h3></div>
    <hr class="bottomline">
    <section>
        <div class="tabs tabs-style-line">
            <nav>
                <ul>
                    <li><a href="#section-line-1" onclick="trigger_symbol(0)"><span>FOREX</span></a></li>
                    <li><a href="#section-line-2" onclick="trigger_symbol(1)"><span>SHARES</span></a></li>
                    <li><a href="#section-line-3" onclick="trigger_symbol(2)"><span>METALS</span></a></li>
                    <li><a href="#section-line-4" onclick="trigger_symbol(3)"><span>BITCOIN</span></a></li>
                </ul>
            </nav>
            <div class="content-wrap newadj">
                <!-- FOREX-->
                <section id="section-line-1" class="<?php echo ($tab == 0)? 'content-current' :''?>">
                    <div class="col-md-8 scrolly noleft">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$fx;?>
                            </tbody>
                        </table>
                    </div>
                </section>
                <!-- CFD SHARES -->
                <section id="section-line-2">
                    <div class="col-md-8 scrolly noleft">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$share;?>
                            </tbody>
                        </table>
                    </div>
                </section>
                <!-- SPOT METALS -->
                <section id="section-line-3">
                    <div class="col-md-8 scrolly noleft">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">

                            <?=$metal;?>
                            </tbody>
                        </table>
                    </div>



                </section>
                <!-- BITCOIN -->
                <section id="section-line-4">
                    <div class="col-md-8 scrolly noleft">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$bt;?>
                            </tbody>
                        </table>
                    </div>
                </section>
                <div class="col-md-4 noright" >
                    <div class="col-md-6 col-xs-6">
                        <div class="col-xs-12 kursbetween">
                            <span id="fxr_quotes"> AUDUSD</span>
                        </div>
                        <div class="col-xs-12 kursvalue">
                            <span id="fxr_unit"> 0.00</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6 no-padding noright m2">
                        <div class="col-xs-12 bluelevel ">
                            <span id="fxr_ask">0.00</span> / <span id="fxr_bid">0.00</span>
                        </div>
                        <div class="col-xs-12 greylevel">
                            HI <span id="fxr_low">0.00</span > - LO <span id="fxr_high">0.00</span>
                        </div>
                    </div>
                    <div class="col-md-12 cpt noright mar-charttop">
                        <?php if($tab == 0){ ?>
                        <!--                        <div class="embed-responsive embed-responsive-16by9">-->
                        <div class="chart_container" id="chart-acct-01" style="width:340px;height: 200px;">

                        </div>
                        <!--                        </div>-->
                        <?php }?>
                    </div>
                </div>
            </div><!-- /content -->
        </div><!-- /tabs -->
    </section>
</div>
<script type="text/javascript">

var initialload= false;
var d_AUDUSD = '';
var d_EURGBP = '';
var d_EURCHF = '';
var d_EURJPY = '';
var d_EURUSD = '';
var d_GBPUSD = '';
var d_NZDUSD = '';
var d_USDCAD = '';
var d_USDCHF = '';
var d_USDJPY = '';

var d_AAPL='';
var d_AMZN='';
var d_BAC='';
var d_BARC='';
var d_EBAY= '';
var d_FB= '';
var d_GOOG= '';
var d_LNKD= '';
var d_MSFT= '';
var d_YHOO= '';

var d_GOLD = '';
var d_SILVER = '';
var d_XAUUSD = '';
var d_GOLDgr = '';
var d_XAGUSD = '';

var d_Bitcoin='';

var requestbarsupdate = false;


function showloader(){
    $('#loader-holder').show();
}

$(document).on("click", ".symbolrow", function () {
    var symbol     = $('tr#'+this.id).data('symbol');
//    console.log($('#charting').attr('src')+'/'+symbol);
    <!--    var charturl= '--><?php //echo FXPP::loc_url('tickchart/update')?><!--';-->


    var ask     = $('tr#'+this.id).data('ask');
    var bid     = $('tr#'+this.id).data('bid');
    var low     = $('tr#'+this.id).data('low');
    var high    = $('tr#'+this.id).data('high');

    var unit    = $('tr#'+this.id).data('unit');
    var pcpips   = $('tr#'+this.id).data('pcpips');
    var pcpercent   = $('tr#'+this.id).data('pcpercent');
    var chart='';


    /*fxr*/
    chart=1;
    $("#fxr_quotes").html(symbol);
    $("#fxr_unit").html(unit);
    $("#fxr_ask").html(ask);
    $("#fxr_bid").html(bid+'%')
    $("#fxr_low").html(low);
    $("#fxr_high").html(high  );


    $("#shr_quotes").html(symbol);
    $("#shr_unit").html(unit   );
    $("#shr_ask").html(ask   );
    $("#shr_bid").html(bid+' %' );

    $("#shr_low").html(low   );
    $("#shr_high").html(high  );

    $("#mtl_quotes").html(symbol);
    $("#mtl_unit").html(unit   );
    $("#mtl_ask").html(ask   );
    $("#mtl_bid").html(bid+'%');

    $("#mtl_low").html(low   );
    $("#mtl_high").html(high  );

    $('.'+this.id).removeClass('active');

    if($('#'+this.id).hasClass('active')){

    }else{
        $(this.id).addClass('active');
    }



//    prvt["data"] = {tab:0};
//    pblc['request'] = $.ajax({
//        dataType: 'json',
//        url: site_url + 'query/get_tab_instruments',
//        method: 'POST',
//        data: prvt["data"]
//    });
//    pblc['request'].done(function( data ) {
//
//        if(data.err==false){
//
//            d_AUDUSD = data.AUDUSD;
//            d_EURGBP = data.EURGBP;
//            d_EURCHF = data.EURCHF;
//            d_EURJPY = data.EURJPY;
//            d_EURUSD = data.EURUSD;
//            d_GBPUSD = data.GBPUSD;
//            d_NZDUSD = data.NZDUSD;
//            d_USDCAD = data.USDCAD;
//            d_USDCHF = data.USDCHF;
//            d_USDJPY = data.USDJPY;
//
//
//            d_AAPL = data.AAPL;
//            d_AMZN = data.AMZN;
//            d_BAC = data.BAC;
//            d_BARC = data.BARC;
//            d_EBAY = data.EBAY;
//            d_FB = data.FB;
//            d_GOOG = data.GOOG;
//            d_LNKD = data.LNKD;
//            d_MSFT = data.MSFT;
//            d_YHOO = data.YHOO;
//
//
//            d_GOLD = data.GOLD;
//            d_SILVER = data.SILVER;
//            d_XAUUSD = data.XAUUSD;
//            d_GOLDgr = data.GOLDgr;
//            d_XAGUSD = data.XAGUSD;
//
//            d_Bitcoin = data.Bitcoin;
//
//            requestbarsupdate = true;
//
//
//        }else{
//
//            requestbarsupdate = false;
//        }
//
//
//
//    });
//    pblc['request'].fail(function( jqXHR, textStatus ) {
//
//    });

    symbol = symbol.replace (/#/g, "");
    console.log(symbol);
//    $('#charting').attr('src', charturl+'/'+symbol);
//    $('#charting').prop('src', charturl+'/'+symbol);
    generatechart(symbol);
});

(function() {
    [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
        new CBPFWTabs( el );
    });
})();


var pblc = [];
var prvt = [];
var site_url = "<?=FXPP::ajax_url('')?>";
var local_url = "<?=FXPP::loc_url('')?>";

var chart_data='';
var chart_segment_data='';
var first_symbol ='AUDUSD';
var SymbolData;
var chart_first_symbol='';
$(document).ready(function(){

    /*automatically call ajax request of data*/
    prvt["data"] = {instance:1};
    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url + 'query/get_instruments',
        method: 'POST',
        data: prvt["data"]
    });
    pblc['request'].done(function( data ) {
        console.log('hit ajax');
        /*call function populate*/
        console.log(data);
        populate(data,instance=1);
    });
    pblc['request'].fail(function( jqXHR, textStatus ) {

    });

    /*timing call of ajax data every 1 minute refer to the interval2*/
    var ajax_verify = function() {
        prvt["data"] = {instance:2};
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'query/get_instruments',
            method: 'POST',
            data:prvt["data"]
        });
        pblc['request'].done(function( data ) {
//            console.log('second call ajax instance');
//
            if(data.r5==true){
                localStorage.setItem("symboldata", JSON.stringify(data.symbol));
                SymbolData=data.symbol;

            }else{
                console.log('GetSecurtiesInfo data error return');
            }
            /*call function populate*/
            populate(data,instance=2);

        });
        pblc['request'].fail(function( jqXHR, textStatus ) {

        });
    }

    var x=1000; //.15 9sec .1 6sec
    var interval2 = 1000 * 60 * x; // where X is your every X minutes
    setInterval(ajax_verify, interval2);
    console.log('passed loop');

});

function populate(data,instance) {
    console.log('hit ajax pop');
    if(instance==1){
        var initial_symbols = [];
        initial_symbols.push("AUDUSD");
    }

    var x;
    if (data.r5==false){
        data.symbol = $.parseJSON(localStorage.getItem("symboldata"));
    }
    for (x in data['symbol']) {

        var Ask=data['symbol'][x]['Ask'];
        Ask =  parseFloat(Math.round(Ask * 100) / 100).toFixed(2);

        var Bid=data['symbol'][x]['Bid'];
        Bid =  parseFloat(Math.round(Bid * 100) / 100).toFixed(2);

        var price_rate = (data['symbol'][x]['Ask']+data['symbol'][x]['Bid'])/2;
        price_rate = parseFloat(Math.round(price_rate * 100) / 100).toFixed(4);

        var PriceChangePips = parseFloat(data['symbol'][x]['PriceChangePips']);
        var PriceChangePercentage = data['symbol'][x]['PriceChangePercentage'];

        var Low = data['symbol'][x]['Low'];
        Low  =  parseFloat(Math.round(Low * 100) / 100).toFixed(2);
        if(x=='AAPL'){

            console.log('AAPL');

            console.log('Low'+Low);

        }
        var High=data['symbol'][x]['High'];
        High  =  parseFloat(Math.round(High * 100) / 100).toFixed(2);

        $('td#'+x+'_unitvalue').html(price_rate);

        if (PriceChangePips<0){

            if ($('td#'+x+'_unitvalue').hasClass('uptext')){
                $('td#'+x+'_unitvalue').removeClass('uptext');
            }

            if ($('td#'+x+'_unitvalue').hasClass('downtext')){

            }else{
                $('td#'+x+'_unitvalue').addClass('downtext');
            }


            if ($('span#'+x+'_down_icon').hasClass('uplevel')){
                $('span#'+x+'_down_icon').removeClass('uplevel');
            }

            if ($('span#'+x+'_down_icon').hasClass('downlevel')){

            }else{
                $('span#'+x+'_down_icon').addClass('downlevel');
            }

        }else{

            if ($('td#'+x+'_unitvalue').hasClass('uptext')){

            }else{
                $('td#'+x+'_unitvalue').addClass('uptext');
            }

            if ($('td#'+x+'_unitvalue').hasClass('downtext')){
                $('td#'+x+'_unitvalue').removeClass('downtext');
            }


            if ($('span#'+x+'_down_icon').hasClass('uplevel')){

            }else{
                $('span#'+x+'_down_icon').addClass('uplevel');
            }

            if ($('span#'+x+'_down_icon').hasClass('downlevel')){
                $('span#'+x+'_down_icon').removeClass('downlevel');
            }

        }

        if(isNaN(PriceChangePips)){
            PriceChangePips='0.00';
            PriceChangePercentage='0.00%';
        }

        $('span#'+x+'_low').html(PriceChangePips);
        $('span#'+x+'_high').html(PriceChangePercentage);

        $("tr#"+x+"_id").data("symbol", data['symbol'][x]['Symbol'] );
        $("tr#"+x+"_id").data("high", data['symbol'][x]['High'] );
        $("tr#"+x+"_id").data("low", data['symbol'][x]['Low'] );
        $("tr#"+x+"_id").data("ask", data['symbol'][x]['Ask']);
        $("tr#"+x+"_id").data("bid", data['symbol'][x]['Bid'] );
        $("tr#"+x+"_id").data("unit", price_rate);
        $("tr#"+x+"_id").data("pcpips", PriceChangePips);
        $("tr#"+x+"_id").data("pcpercent", PriceChangePercentage);

        if(jQuery.inArray(data['symbol'][x]['Symbol'], initial_symbols) !== -1){

            var symbol = data['symbol'][x]['Symbol'];
            var bid = data['symbol'][x]['Bid'];
            var ask = data['symbol'][x]['Ask'];
            var low = data['symbol'][x]['Low'];
            var high = data['symbol'][x]['High'] ;

            if(instance==1){

                if(symbol=='AUDUSD'){
                    $("#fxr_quotes").html(symbol);
                    $("#fxr_unit").html(price_rate);
                    $("#fxr_ask").html(ask);
                    $("#fxr_bid").html(bid+'%');
                    $("#fxr_low").html(low);
                    $("#fxr_high").html(high);

                }
            }

        }
    }
}

console.log('livequotes');
var Chart1;

Chart1 = new Highcharts.StockChart({
    chart: {
        renderTo: 'chart-acct-01',
        zoomType: 'x'
    },

//    scrollbar: {
//        enabled: true
//    },
    xAxis: {
        crosshair: true,
//        gridLineColor: '#197F07'
    },

    yAxis: {
//        gridLineColor: '#197F07',
        crosshair: true,
        gridLineWidth: 1

    },
    rangeSelector: {
        enabled: false
    },
//    navigator: {
//        enabled: true,
//        series: {
//            id: 'navigator'
//        }
//    },
//    tooltip: {
//        pointFormat: '<span class="highcharts-color-{point.colorIndex}">\u25CF</span> <b> {series.name}</b><br/>' +
//          	'Ask: {point.open}<br/>' +
//          	'High: {point.high}<br/>' +
//           	'Low: {point.low}<br/>' +
//           	'Bid: {point.close}<br/>'
//    },
    series: [
        {
//            type: 'ohlc',
            type: 'line',
            name: 'AAPL',
            data: [
            ],
            tooltip: {
                valueDecimals: 2
            }
        }
    ]
});


generatechart('AUDUSD');
function generatechart(symbol) {
    console.log('symbol :'+symbol);
    console.log('aouisai8jsdaosudah');
    var pblc = [];
    pblc['request'] = null;
    var prvt = [];
    prvt["data"] = {
        symbol:symbol
    };
    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url + "query/get_livequotes",
        method: 'POST',
        data: prvt["data"]
    });
    pblc['request'].done(function (data) {

        while(Chart1.series.length > 0)
            Chart1.series[0].remove(true);
//        Chart1.series[1].remove(true);
        //        data = Highcharts.map(data, function (config) {
        //            return {
        //                x: config[0],
        //                open: config[1],
        //                high: config[2],
        //                low: config[3],
        //                close: config[4],
        //                y: config[4] // let the closing value represent the data in single-value series
        //            };
        var minRate = 0;
        var maxRate = 0;
        var dataset = [];
        var dataset2 = [];
        $.each(data.chart, function (k, v) {

//                        dataset.push([v.date,v.ask,v.high,v.low,v.bid,v.bid]);
            dataset.push([v.date,v.ask,v.high,v.low,v.bid,v.bid]);

            dataset2.push([v.date,v.bid,v.high,v.low,v.bid,v.spread]);
            if (v.bid > maxRate) {
                maxRate = v.bid;
            }
            if (v.bid < minRate) {
                minRate = v.bid;
            }
        });
        console.log(dataset);
        Chart1.addSeries({
            name: 'Ask',
            data: dataset,
            lineWidth: 1,
            type: 'line',
            color: '#FF0000'
        });
        Chart1.addSeries({
            name: 'Bid',
            data: dataset2,
            lineWidth: 1,
            type: 'line',
            color: '#006400'
        });
    });

}

</script>
<script type="text/javascript" src="<?= $this->template->Js()?>bootstrap.min.js"></script>
<link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">

<link rel='stylesheet' href="<?= $this->template->Css()?>loaders.css">
<script type="text/javascript">
    $('#blinds').hide("slow");
</script>
<script type="text/javascript">
    $(document).ready(function(){
        if($("body").size()>0) {
            if (document.createStyleSheet) {
                document.createStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400');
                document.createStyleSheet('<?= $this->template->Fonts()?>css/font-awesome.min.css');
            } else {
                $("head").append($("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' type='text/css'  />"));
                $("head").append($("<link rel='stylesheet' href='<?= $this->template->Fonts()?>css/font-awesome.min.css' type='text/css'  />"));
            }
        }
    });
</script>


<script type="text/javascript" src="<?= $this->template->Js()?>bootstrap.min.js"></script>
<link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
</body>
</html>
