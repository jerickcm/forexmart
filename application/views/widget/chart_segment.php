<script src="<?=$this->template->Js()?>highstock.min.js" type="text/javascript"></script>
<link rel='stylesheet' href='<?=$this->template->Css()?>chart_home.css'>
<style>
    div.scrolly{
        /*height: 345px;*/
        height: 540px;
        overflow-y: scroll;
    }

    @media screen and (min-width: 750px) {
        .charting{
            min-width: 450px; height: 380px; margin: 5px  auto
        }
    }
    @media screen and (max-width: 500px) {
        .charting{

        }
    }
    @media screen and (max-width: 250px) {
        .charting{

        }
    }
</style>
<script src="<?=$this->template->Js()?>cbpFWTabs.js" type="text/javascript"></script>

<div class="container">
    <div class="charttitle"><h3>Live Quotes</h3></div>
    <hr class="bottomline">
    <section>
        <div class="tabs tabs-style-line">
            <nav>
                <ul>
                    <li><a href="#section-line-1"><span>FOREX</span></a></li>
                    <li><a href="#section-line-2"><span>SHARES</span></a></li>
                    <li><a href="#section-line-3"><span>METALS</span></a></li>
                    <li><a href="#section-line-4"><span>BITCOIN</span></a></li>
                </ul>
            </nav>
            <div class="content-wrap">
                <!-- FOREX-->
                <section id="section-line-1">
                    <div class="col-md-6 scrolly">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$fx;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6 col-xs-6">
                            <div class="col-xs-12 kursbetween">
                                <span id="fxr_quotes"> EURCHF</span>
                            </div>
                            <div class="col-xs-12 kursvalue">
                                <span id="fxr_unit"> 0.00</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6 no-padding">
                            <div class="col-xs-12 bluelevel ">

                                <span id="fxr_ask">0.00</span> / <span id="fxr_bid">0.00</span>

                            </div>
                            <div class="col-xs-12 greylevel">
                                HI <span id="fxr_low">0.00</span > - LO <span id="fxr_high">0.00</span>
                            </div>
                        </div>
                        <div class="col-md-12"><div id="container1" class="charting" ></div>
                        </div>
                    </div>

                </section>
                <!-- CFD SHARES -->
                <section id="section-line-2">
                    <div class="col-md-6 scrolly">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$share;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6 col-xs-6">
                            <div class="col-xs-12 kursbetween">
                                <span id="shr_quotes"> #AAPL </span>
                            </div>
                            <div class="col-xs-12 kursvalue">
                                <span id="shr_unit">  0.00</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6 no-padding">
                            <div class="col-xs-12 bluelevel ">

                                <span id="shr_ask">0.00</span> / <span id="shr_bid">0.00</span>

                            </div>
                            <div class="col-xs-12 greylevel">
                                HI <span id="shr_low">0.00</span > - LO <span id="shr_high">0.00</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="container2" class="charting" ></div>
                        </div>
                    </div>

                </section>
                <!-- SPOT METALS -->
                <section id="section-line-3">
                    <div class="col-md-6 scrolly">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$metal;?>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6 col-xs-6">
                            <div class="col-xs-12 kursbetween">
                                <span id="mtl_quotes"> GOLD</span>
                            </div>
                            <div class="col-xs-12 kursvalue">
                                <span id="mtl_unit">  0.00</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6 no-padding">
                            <div class="col-xs-12 bluelevel ">

                                <span id="mtl_ask">0.00</span> / <span id="mtl_bid">0.00</span>

                            </div>
                            <div class="col-xs-12 greylevel">
                                HI <span id="mtl_low">0.00</span > - LO <span id="mtl_high">0.00</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="container3" class="charting" ></div>
                        </div>
                    </div>

                </section>
                <!-- BITCOIN -->
                <section id="section-line-4">
                    <div class="col-md-6 scrolly">
                        <table class="table table-responsive table-hover kurs ">
                            <tbody style="text-align:center;">
                            <?=$bt;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6 col-xs-6">
                            <div class="col-xs-12 kursbetween">
                                <span id="btc_quotes"> Bitcoin</span>
                            </div>
                            <div class="col-xs-12 kursvalue">
                                <span id="btc_unit">  0.00</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6 no-padding">
                            <div class="col-xs-12 bluelevel ">

                                <span id="btc_ask">0.00</span> / <span id="btc_bid">0.00</span>

                            </div>
                            <div class="col-xs-12 greylevel">
                                HI <span id="btc_low">0.00</span > - LO <span id="btc_high">0.00</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="container4" class="charting" ></div>
                        </div>
                    </div>
                </section>
            </div><!-- /content -->
        </div><!-- /tabs -->
    </section>
</div>
<script type="text/javascript">





Highcharts.createElement('link', {
    href: 'https://fonts.googleapis.com/css?family=Unica+One',
    rel: 'stylesheet',
    type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {

    colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
        '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, '#2a2a2b'],
                [1, '#3e3e40']
            ]
        },
        style: {
            fontFamily: '\'Unica One\', sans-serif'
        },
        plotBorderColor: '#606063'
    },
    title: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase',
            fontSize: '20px'
        }
    },
    subtitle: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase'
        }
    },
    xAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        title: {
            style: {
                color: '#A0A0A3'

            }
        }
    },
    yAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        tickWidth: 1,
        title: {
            style: {
                color: '#A0A0A3'
            }
        }
    },
    tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.85)',
        style: {
            color: '#F0F0F0'
        }
    },
    plotOptions: {
        series: {
            dataLabels: {
                color: '#B0B0B3'
            },
            marker: {
                lineColor: '#333'
            }
        },
        boxplot: {
            fillColor: '#505053'
        },
        candlestick: {
            lineColor: 'white'
        },
        errorbar: {
            color: 'white'
        }
    },
    legend: {
        itemStyle: {
            color: '#E0E0E3'
        },
        itemHoverStyle: {
            color: '#FFF'
        },
        itemHiddenStyle: {
            color: '#606063'
        }
    },
    credits: {
        style: {
            color: '#666'
        }
    },
    labels: {
        style: {
            color: '#707073'
        }
    },

    drilldown: {
        activeAxisLabelStyle: {
            color: '#F0F0F3'
        },
        activeDataLabelStyle: {
            color: '#F0F0F3'
        }
    },

    navigation: {
        buttonOptions: {
            symbolStroke: '#DDDDDD',
            theme: {
                fill: '#505053'
            }
        }
    },

    // scroll charts
    rangeSelector: {
        buttonTheme: {
            fill: '#505053',
            stroke: '#000000',
            style: {
                color: '#CCC'
            },
            states: {
                hover: {
                    fill: '#707073',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                },
                select: {
                    fill: '#000003',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                }
            }
        },
        inputBoxBorderColor: '#505053',
        inputStyle: {
            backgroundColor: '#333',
            color: 'silver'
        },
        labelStyle: {
            color: 'silver'
        }
    },

    navigator: {
        handles: {
            backgroundColor: '#666',
            borderColor: '#AAA'
        },
        outlineColor: '#CCC',
        maskFill: 'rgba(255,255,255,0.1)',
        series: {
            color: '#7798BF',
            lineColor: '#A6C7ED'
        },
        xAxis: {
            gridLineColor: '#505053'
        }
    },

    scrollbar: {
        barBackgroundColor: '#808083',
        barBorderColor: '#808083',
        buttonArrowColor: '#CCC',
        buttonBackgroundColor: '#606063',
        buttonBorderColor: '#606063',
        rifleColor: '#FFF',
        trackBackgroundColor: '#404043',
        trackBorderColor: '#404043'
    },

    // special colors for some of the
    legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
    background2: '#505053',
    dataLabelsColor: '#B0B0B3',
    textColor: '#C0C0C0',
    contrastTextColor: '#F0F0F3',
    maskColor: 'rgba(255,255,255,0.3)'
};


Highcharts.setOptions(Highcharts.theme);

$(document).on("click", ".symbolrow", function () {

    var symbol     = $('tr#'+this.id).data('symbol');
    var ask     = $('tr#'+this.id).data('ask');
    var bid     = $('tr#'+this.id).data('bid');
    var low     = $('tr#'+this.id).data('low');
    var high    = $('tr#'+this.id).data('high');

    var unit    = $('tr#'+this.id).data('unit');
    var pcpips   = $('tr#'+this.id).data('pcpips');
    var pcpercent   = $('tr#'+this.id).data('pcpercent');
    var chart='';
    switch($('tr#'+this.id).data('tab')) {
        case 'fx':
            /*fxr*/
            chart=1;
            $("#fxr_quotes").html(symbol);
            $("#fxr_unit").html(unit);
            $("#fxr_ask").html(pcpips);
            $("#fxr_bid").html(pcpercent);
            $("#fxr_low").html(low);
            $("#fxr_high").html(high  );
            break;
        case 'bt':
            /*btc*/
            chart=2;
            $("#btc_quotes").html(symbol);
            $("#btc_unit").html(unit   );
            $("#btc_ask").html(pcpips   );
            $("#btc_bid").html(pcpercent);
            $("#btc_low").html(low   );
            $("#btc_high").html(high  );
            break;
        case 'sh':
            /*shr*/
            chart=3;
            $("#shr_quotes").html(symbol);
            $("#shr_unit").html(unit   );
            $("#shr_ask").html(pcpips   );
            $("#shr_bid").html(pcpercent );
            $("#shr_low").html(low   );
            $("#shr_high").html(high  );
            break;
        case 'mt':
            /*mtl*/
            chart=4;
            $("#mtl_quotes").html(symbol);
            $("#mtl_unit").html(unit   );
            $("#mtl_ask").html(pcpips   );
            $("#mtl_bid").html(pcpercent  );
            $("#mtl_low").html(low   );
            $("#mtl_high").html(high  );
            break;
    }


    $('.'+this.id).removeClass('active');

    if($('#'+this.id).hasClass('active')){

    }else{
        $(this.id).addClass('active');
    }

    var symbol2=symbol;

    prvt["data"] = {symbol:symbol,chart:chart};
    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url + 'query/get_ch2',
        method: 'POST',
        data: prvt["data"]
    });
    pblc['request'].done(function( data ) {
        if(typeof data.chart != 'undefined'){
            var symbol = data.chart['tab'];
            var chart_generic=[];
            symbol.forEach(function(entry) {
                chart_generic.push([entry[0],entry[1]]);
            });
            if (chart==1){

                Highcharts.stockChart('container1', {
                    /*remove watermark bottom right*/
                    xAxis: {
                        crosshair: true
                    },

                    yAxis: {
                        crosshair: true
                    },
                    credits: {
                        enabled: false
                    },
                    /*remove download top right*/
                    exporting: { enabled: false },
                    rangeSelector: {
                        selected: 1,
                        enabled:false /*hide zoom bar*/
                    },
                    title: {
                        text: ''
                    },

                    series: [{
                        name: symbol2,
                        data: chart_generic,
                        tooltip: {
                            valueDecimals: 2
                        }
                    }]
                });

            }
            if (chart==2){


                Highcharts.stockChart('container4', {
                    /*remove watermark bottom right*/
                    xAxis: {
                        crosshair: true
                    },

                    yAxis: {
                        crosshair: true
                    },
                    credits: {enabled: false},
                    /*remove download top right*/
                    exporting: { enabled: false },
                    rangeSelector: {
                        selected: 1,
                        enabled:false /*hide zoom bar*/
                    },
                    title: {
                        text: ''
                    },

                    series: [{
                        name: symbol2,
                        data: chart_generic,
                        tooltip: {
                            valueDecimals: 2
                        }
                    }]
                });


            }
            if (chart==3){

                Highcharts.stockChart('container2', {
                    /*remove watermark bottom right*/
                    xAxis: {
                        crosshair: true
                    },

                    yAxis: {
                        crosshair: true
                    },
                    credits: {enabled: false},
                    /*remove download top right*/
                    exporting: { enabled: false },
                    rangeSelector: {
                        selected: 1,
                        enabled:false /*hide zoom bar*/
                    },
                    title: {
                        text: ''
                    },

                    series: [{
                        name: symbol2,
                        data: chart_generic,
                        tooltip: {
                            valueDecimals: 2
                        }
                    }]
                });


            }

            if (chart==4){

                Highcharts.stockChart('container3', {
                    xAxis: {
                        crosshair: true
                    },

                    yAxis: {
                        crosshair: true
                    },
                    /*remove watermark bottom right*/
                    credits: {enabled: false},
                    /*remove download top right*/
                    exporting: { enabled: false },
                    rangeSelector: {
                        selected: 1,
                        enabled:false /*hide zoom bar*/
                    },
                    title: {
                        text: ''
                    },

                    series: [{
                        name: symbol2,
                        data: chart_generic,
                        tooltip: {
                            valueDecimals: 2
                        }
                    }]
                });

            }
        }



    });
    pblc['request'].fail(function( jqXHR, textStatus ) {

    });


});


(function() {
    [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
        new CBPFWTabs( el );
    });
})();
var pblc = [];
var prvt = [];
var site_url = "<?=FXPP::ajax_url('')?>";

$(document).ready(function(){

    /*automatically call ajax request of data*/
    prvt["data"] = {instance:1};
    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url + 'query/get_ch1',
        method: 'POST',
        data: prvt["data"]
    });
    pblc['request'].done(function( data ) {
        /*call function populate*/
        populate(data,instance=1);
        if(typeof data.chart != 'undefined' && typeof data.chart.tab != 'undefined'){
            var EURCHF = data.chart['tab']['EURCHF'];
            var chart1=[];
            EURCHF.forEach(function(entry) {
                chart1.push([entry[0],entry[1]]);
            });

            Highcharts.stockChart('container1', {
                xAxis: {
                    crosshair: true
                },

                yAxis: {
                    crosshair: true
                },
                chart: {

                    plotBorderColor: '#606063'
                },
                /*remove watermark bottom right*/
                credits: {enabled: false},
                /*remove download top right*/
                exporting: { enabled: false },
                rangeSelector: {
                    selected: 1,
                    enabled:false /*hide zoom bar*/
                },
                title: {
                    text: ''
                },

                series: [{
                    name: 'EURCHF',
                    data: chart1,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });

            var AAPL = data.chart['tab']['AAPL'];

            var chart2=[];
            AAPL.forEach(function(entry) {
                chart2.push([entry[0],entry[1]]);
            });

            Highcharts.stockChart('container2', {
                xAxis: {
                    crosshair: true
                },

                yAxis: {
                    crosshair: true
                },
                /*remove watermark bottom right*/
                credits: {enabled: false},
                /*remove download top right*/
                exporting: { enabled: false },
                rangeSelector: {
                    selected: 1,
                    enabled:false /*hide zoom bar*/
                },
                title: {
                    text: ''
                },

                series: [{
                    name: '#AAPL',
                    data: chart2,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });


            var GOLD = data.chart['tab']['GOLD'];
            var chart3=[];

            GOLD.forEach(function(entry) {
                chart3.push([entry[0],entry[1]]);
            });

            Highcharts.stockChart('container3', {
                xAxis: {
                    crosshair: true
                },

                yAxis: {
                    crosshair: true
                },
                /*remove watermark bottom right*/
                credits: {enabled: false},
                /*remove download top right*/
                exporting: { enabled: false },
                rangeSelector: {
                    selected: 1,
                    enabled:false /*hide zoom bar*/
                },
                title: {
                    text: ''
                },

                series: [{
                    name: '#AAPL',
                    data: chart2,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });



            var Bitcoin = data.chart['tab']['Bitcoin'];
            var chart4=[];

            Bitcoin.forEach(function(entry) {
                chart4.push([entry[0],entry[1]]);
            });



            Highcharts.stockChart('container4', {
                /*remove watermark bottom right*/
                xAxis: {
                    crosshair: true
                },

                yAxis: {
                    crosshair: true
                },
                credits: {enabled: false},
                /*remove download top right*/
                exporting: { enabled: false },
                rangeSelector: {
                    selected: 1,
                    enabled:false /*hide zoom bar*/
                },
                title: {
                    text: ''
                },

                series: [{
                    name: '#Bitcoin',
                    data: chart4,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        }


    });
    pblc['request'].fail(function( jqXHR, textStatus ) {

    });

    /*timing call of ajax data every 1 minute refer to the interval2*/
    var ajax_verify = function() {
        prvt["data"] = {instance:2};
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'query/get_ch1',
            method: 'POST',
            data:prvt["data"]
        });
        pblc['request'].done(function( data ) {
            /*call function populate*/
            populate(data,instance=2);

        });
        pblc['request'].fail(function( jqXHR, textStatus ) {

        });

    }
    var x=0.1;
    var interval2 = 1000 * 60 * x; // where X is your every X minutes
    setInterval(ajax_verify, interval2);
});

function populate(data,instance) {

    if(instance==1){

        var initial_symbols = [];
        initial_symbols.push("EURCHF");
        initial_symbols.push("GOLD");
        initial_symbols.push("#AAPL");
        initial_symbols.push("#Bitcoin");

    }

    var x;
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

                if(symbol=='EURCHF'){
                    $("#fxr_quotes").html(symbol);
                    $("#fxr_unit").html(price_rate);
                    $("#fxr_ask").html(ask);
                    $("#fxr_bid").html(bid+'%');
                    $("#fxr_low").html(low);
                    $("#fxr_high").html(high);

                }else if(symbol=='GOLD'){
                    $("#mtl_quotes").html(symbol);
                    $("#mtl_unit").html(price_rate);
                    $("#mtl_ask").html(ask);
                    $("#mtl_bid").html(bid+'%');
                    $("#mtl_low").html(low);
                    $("#mtl_high").html(high);

                }else if(symbol=='#AAPL'){
                    $("#shr_quotes").html(symbol);
                    $("#shr_unit").html(price_rate);
                    $("#shr_ask").html(ask);
                    $("#shr_bid").html(bid+'%');
                    $("#shr_low").html(low);
                    $("#shr_high").html(high);

                }else if(symbol=='#Bitcoin'){
                    $("#btc_quotes").html(symbol);
                    $("#btc_unit").html(price_rate);
                    $("#btc_ask").html(ask);
                    $("#btc_bid").html(bid+'%');
                    $("#btc_low").html(low);
                    $("#btc_high").html(high);

                }
            }

        }
    }
}

</script>
