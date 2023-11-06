<style>.charttitle h3,.tabs-style-line nav a{text-transform:uppercase;font-weight:700}.charttitle h3,.kurs{font-family:Open Sans}div.scrolly{height:540px;overflow-y:scroll}@media screen and (min-width:750px){.charting{min-width:450px;height:380px;margin:5px auto}}.tabs,.tabs nav ul{position:relative;margin:0 auto}.charttitle h3{font-size:22px;color:#222}.bottomline{border:1px solid #222}.tabs{overflow:hidden;width:100%}.tabs nav{text-align:center}.tabs nav ul{display:-ms-flexbox;display:-webkit-flex;display:-moz-flex;display:-ms-flex;display:flex;padding:0;max-width:1200px;list-style:none;-ms-box-orient:horizontal;-ms-box-pack:center;-webkit-flex-flow:row wrap;-moz-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-justify-content:center;-moz-justify-content:center;-ms-justify-content:center;justify-content:center}.tabs nav a,.tabs nav ul li{display:block;position:relative}.tabs nav ul li{z-index:1;margin:0;text-align:center;-webkit-flex:1;-moz-flex:1;-ms-flex:1;flex:1;padding:0!important}.tabs nav a{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;line-height:2.5}.tabs nav a span{vertical-align:middle;font-size:1em}.tabs nav li.tab-current a{color:#74777b}.tabs nav a:focus{outline:0}.tabs-style-line nav ul{max-width:none}.tabs-style-line nav ul li{border:1px solid #ccc;list-style:none}.tabs-style-line nav a{padding:.7em .4em;color:#222;text-align:center;letter-spacing:1px;font-size:20px;line-height:1;list-style:none}.tabs-style-line nav li.tab-current a{border-bottom:4px solid #2988ca!important;border-top:1px solid #c70928;color:#2988ca}.content-wrap{position:relative}.content-wrap section{display:none;margin:0 auto;padding:1em;max-width:1200px;text-align:center}.content-wrap section.content-current{display:block}.content-wrap section p{margin:0;padding:2em 0;color:rgba(40,44,42,.05);font-weight:900;font-size:5em;line-height:1}td,tr{border-bottom:1px solid #222;border-top:1px solid #222!important;height:65px!important;vertical-align:middle!important}.kurs{color:#222;font-size:20px;font-weight:700}.downlevel:before,.uplevel:before{padding-right:10px;font-family:FontAwesome;font-style:normal}.uptext{color:#2988ca}.downtext{color:#bf1e2e}.downlevel,.uplevel{display:inline-block;color:#fff;font-size:16px;padding:10px;width:100%;font-weight:400}.uplevel{background:#2988ca}.uplevel:before{content:"\f062";font-weight:400}.downlevel{background:#bf1e2e}.downlevel:before{content:"\f063";font-weight:400}.kursbetween,.kursvalue{font-size:43px;font-weight:700;text-align:left;font-family:Open Sans}.kursbetween{color:#222}.kursvalue{color:#2988ca}.bluelevel{background:#2988ca;font-family:Open Sans;font-size:36px;color:#fff;font-weight:600;padding:5px;margin-bottom:10px}.greylevel{background:#ddd;font-family:Open Sans;font-size:22px;color:#222;font-weight:500;padding:2px}.no-padding{padding:0}.gap-2{height:3em}@media screen and (max-width:1200px){td,tr{height:50px!important}.kurs{font-size:18px}.downlevel,.uplevel{font-size:14px}.kursbetween,.kursvalue{font-size:33px}.bluelevel{font-size:26px}.greylevel{font-size:16px}}@media screen and (max-width:767px){.tabs-style-line nav ul{display:block;box-shadow:none}.tabs-style-line nav ul li{display:block;-webkit-flex:none;flex:none}.tabs nav a.icon span{display:none}.tabs nav a:before{margin-right:0}td,tr{height:40px!important}.kurs{font-size:14px}.downlevel,.uplevel{font-size:10px}.kursbetween,.kursvalue{font-size:18px}.bluelevel{font-size:16px}.greylevel{font-size:12px}}.bluelevel,.greylevel{text-align:center}.cpt{padding-top:2%}</style>
<script src="<?php echo $this->template->Js()?>cbpFWTabs2.js" type="text/javascript"></script>
<div class="container">
    <div class="charttitle"><h3>Live Quotes</h3></div>
    <hr class="bottomline">
    <section>
        <div class="tabs tabs-style-line">
            <nav>
                <ul>
                    <li class="<?php echo ($tab == 0)? 'tab-current' :''?>"><a href="<?php echo fxpp::loc_url('chart/forex')?>" onclick="showloader();"><span>FOREX</span></a></li>
                    <li class="<?php echo ($tab == 1)? 'tab-current' :''?>"><a href="<?php echo fxpp::loc_url('chart/shares')?>" onclick="showloader();"><span>SHARES</span></a></li>
                    <li class="<?php echo ($tab == 2)? 'tab-current' :''?>"><a href="<?php echo fxpp::loc_url('chart/metals')?>" onclick="showloader();"><span>METALS</span></a></li>
                    <li class="<?php echo ($tab == 3)? 'tab-current' :''?>"><a href="<?php echo fxpp::loc_url('chart/bitcoin')?>" onclick="showloader();"><span>BITCOIN</span></a></li>
                </ul>
            </nav>
            <div class="content-wrap">
                <!-- FOREX-->
                <!-- CFD SHARES -->
                <section id="section-line-2" class="<?php echo ($tab == 1)? 'content-current' :''?>">
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
                        <div class="col-md-12 cpt">
                            <?php if($tab == 1){ ?>
                            <div class="loader"></div>
                            <div id="wc-ohlc-chart" style="height: 100%; width: 100%;float: left;">
                            </div>
<!--                            <a target="_blank" href="--><?php //echo fxpp::loc_url('chart')?><!--"><span>Chart</span></a>-->
                            <?php }?>
                        </div>
                    </div>
                </section>
                <!-- SPOT METALS -->
                <!-- BITCOIN -->
            </div><!-- /content -->
        </div><!-- /tabs -->
    </section>
</div>
<script type="text/javascript">

    var initialload= false
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
    var requestbarsupdate = false;

function showloader(){
    $('#loader-holder').show();
}

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

            /*shr*/
            chart=3;
            $("#shr_quotes").html(symbol);
            $("#shr_unit").html(unit   );
//            $("#shr_ask").html(pcpips   );
//            $("#shr_bid").html(pcpercent );
            $("#shr_ask").html(ask   );
            $("#shr_bid").html(bid+' %' );

            $("#shr_low").html(low   );
            $("#shr_high").html(high  );



    $('.'+this.id).removeClass('active');

    if($('#'+this.id).hasClass('active')){

    }else{
        $(this.id).addClass('active');
    }

    prvt["data"] = {tab:1};
    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url + 'query/get_tab_instruments',
        method: 'POST',
        data: prvt["data"]
    });
    pblc['request'].done(function( data ) {
        if(data.err==false){
            d_AAPL = data.AAPL;
            d_AMZN = data.AMZN;
            d_BAC = data.BAC;
            d_BARC = data.BARC;
            d_EBAY = data.EBAY;
            d_FB = data.FB;
            d_GOOG = data.GOOG;
            d_LNKD = data.LNKD;
            d_MSFT = data.MSFT;
            d_YHOO = data.YHOO;
            requestbarsupdate = true;
        }else{
            requestbarsupdate = false;
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
var local_url = "<?=FXPP::loc_url('')?>";
var chart_data='';
var chart_segment_data='';

    var first_symbol ='#AAPL';

console.log('first_symbol = '+first_symbol);
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
        console.log('first call ajax instance');
        /*call function populate*/

        if(data.r5==true){
            localStorage.setItem("symboldata", JSON.stringify(data.symbol));
        }else{
            console.log('GetSecurtiesInfo data error return');
        }
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
            console.log('second call ajax instance');

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


        prvt["data"] = {tab:1};
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'query/get_tab_instruments',
            method: 'POST',
            data: prvt["data"]
        });
        pblc['request'].done(function( data ) {
            if(data.err==false){
                d_AAPL = data.AAPL;
                d_AMZN = data.AMZN;
                d_BAC = data.BAC;
                d_BARC = data.BARC;
                d_EBAY = data.EBAY;
                d_FB = data.FB;
                d_GOOG = data.GOOG;
                d_LNKD = data.LNKD;
                d_MSFT = data.MSFT;
                d_YHOO = data.YHOO;
                requestbarsupdate = true;
            }else{
                requestbarsupdate = false;
            }
        });
        pblc['request'].fail(function( jqXHR, textStatus ) {

        });
    }
    var x=2;
    var interval2 = 1000 * 60 * x; // where X is your every X minutes
    setInterval(ajax_verify, interval2);
});

function populate(data,instance) {

    if(instance==1){

        var initial_symbols = [];
        initial_symbols.push("#AAPL");


    }
    var x;
    if (data.r5==false){
        data.symbol = $.parseJSON(localStorage.getItem("symboldata"));
    }
    for (x in data['symbol']) {
        if(instance==1){
            /*add symbol exemption GOLDgr*/
            var arr = ['AAPL','AMZN','BAC','BARC','EBAY','FB','GOOG','LNKD','MSFT','YHOO'];
            if (x!='GOLDgr'){
                if ($.inArray(x, arr) != -1){
                    chart_data +='{"Symbol":"'+data['symbol'][x]['Symbol']+'",' +
                        '"LongName":"'+data['symbol'][x]['Symbol']+'",' +
                        '"Stamp":"'+data['symbol'][x]['Timestamp']+'",' +
                        '"Bid":'+data['symbol'][x]['Bid']+',' +
                        '"Ask":'+data['symbol'][x]['Ask']+',' +
                        '"Digits":'+data['symbol'][x]['Digits']+',' +
                        '"QuoteID":"201398155",' +
                        '"AskMovement":"=",' +
                        '"BidMovement":"=",' +
                        '"IsOpen":true,' +
                        '"IsActive":true,' +
                        '"SessionGroup":"general",' +
                        '"DepthData":null},';
                }
            }

        }
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

                $("#shr_quotes").html(symbol);
                $("#shr_unit").html(price_rate);
                $("#shr_ask").html(ask);
                $("#shr_bid").html(bid+'%');
                $("#shr_low").html(low);
                $("#shr_high").html(high);


            }

        }
    }
}

</script>
