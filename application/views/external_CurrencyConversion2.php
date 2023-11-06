<style>
    .selectboxit-option-icon-url{
        background-size: 16px 10px!important;
    }
    .select2-container{
        width:100%;
        height: auto;
    }
    .flag{
        margin: 0 25px 0 0px;
        padding: 2px;
    }
    .converter-drp{
        color: #000!important;
    }
    .select2-container .select2-choice{
        border-radius: 0px!important;
        height: 32px!important;
    }
    .select2-container, .select2-choice, .select2-arrow{
        border-radius: 0px!important;
    }
    #select2-drop{
        width: 457px!important;
    }
    .switchtofrom{
        cursor: pointer;
    }
    .select2-drop-active{
        border-width: medium 2px 2px!important;
    }
    .left-adj-col1{
        padding: 5px 15px;
    }
    .bid{
        padding: 0 5px;
    }
    .ask{
        padding: 0 5px;
    }
    .highlightSellBuy{
        font-size: 20px;
        font-weight: bold;
    }
    .canvasjs-chart-credit{
        display: none!important;
    }
    .bidtable{
        font-size: 16px!important;
    }
    .historicaltable{
        margin:20px;
    }
</style>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">Currency Converter</h1>
                <div class="ins-tabs">
                    <ul role="tablist">
                    </ul><div class="clearfix"></div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tool1">
                        <div class="row converter-holder">
                            <div class="col-sm-5">
                                <label for="" class="amount-label">CURRENCY I HAVE:</label>
                                <div class="converter-drp">
                                    <?= form_dropdown('currencyihave', $countries, 'USD');?>
                                </div>
                                <div class="amount-holder">
                                    <form>
                                        <div class="form-group">
                                            <label for="" class="amount-label">AMOUNT:</label>
                                            <input type="text" class="form-control round-0 cur-amount" id="amount" value="1" name="amount" placeholder="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="btn-switch-holder">
                                    <a class="btn-switch switchtofrom"><i class="fa fa-caret-left sleft"></i><i class="fa fa-caret-right sright"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label for="" class="amount-label">CURRENCY I WANT:</label>
                                <div class="converter-drp">
                                    <?= form_dropdown('currencyiwant', $countries, 'EUR');?>
                                </div>
                                <div class="amount-holder">
                                    <form>
                                        <div class="form-group">
                                            <label for="" class="amount-label">AMOUNT OF CONVERSION:</label>
                                            <input type="text" class="form-control round-0 cur-amount" id="amountofconversion" style="" name="amountofconversion" placeholder="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-5">
                                    <h3 class="headline"> <span class="cur1"></span>/<span class="cur2"></span> Details</h3>
                                    <p><span class="cur1"></span>/<span class="cur2"></span> for the 24-hour period, <span class="xdate"></span> @ <span class="interbank">+/- 0<span></p>
                                    <p class="highlightSellBuy">Selling <span class="amount"></span> <span class="cur1"></span> = you get <span class="amountx"></span> <span class="cur2"></span></p>
                                    <p class="highlightSellBuy">Buying <span class="amount"></span> <span class="cur1"></span> = you pay <span class="amounty"></span> <span class="cur2"></span></p>
                                </div>

                                <div class="col-sm-7">
                                    <div class="cur-datepicker-holder">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label for="">INTERBANK +/-</label>
                                                <?php
                                                $internbank = array(
                                                    '.00' => '+/- 0%',
                                                    '.01' => '+/- 1%',
                                                    '.02' => '+/- 2% (Typical ATM rate)',
                                                    '.03' => '+/- 3% (Typical Credit Card rate)',
                                                    '.04' => '+/- 4% ',
                                                    '.05' => '+/- 5% (Typical Kiosk rate)'
                                                );
                                                ?>
                                                <?= form_dropdown('interbank', $internbank, '.00' , 'class="form-control round-0" ');?>
                                            </div>
                                            <div class="form-group">

                                                <label for="">DATE:</label>
                                                <input type="text" id="date_start" name="start_date" class="form-control required" />

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tool2">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tool3">
                    </div>
                </div>
                <?php /** FXPP-902 */ ?>
                <div class="tab-content">
                    <ul class="nav nav-tabs">
                        <li id="RD" class="active"><a href="#home" data-toggle="tab">Rate Details</a></li>
                        <li id="HER" ><a href="#menu1" data-toggle="tab">Historical Exchange Rates</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="panel panel-default">
                                <div class="panel-body display-n" name="RateDetails">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <h3 class="headline">Recent Trends</h3>
                                            <p ><span class="cur1"></span>/<span class="cur2"></span> average daily bid price</p>
                                            <div id="chartContainer" style="height: 400px; width: 100%;margin: 50px"></div>
                                            To see detailed Forex Charts visit this <a aria-expanded="false" href="#menu1" data-toggle="tab" class="hitlink">page</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <div id="bid_ask">
                                                <div class="header">
                                                    <h3 class="headline">Rate Details</h3>
                                                    <p id="bidAskSubtitle" class="minisubhead"><span class="cur1"></span>/<span class="cur2"></span> for the chart period <span id="bidAskDate" ></span></p>
                                                </div>
                                                <table cellspacing="0" class="bidtable">
                                                    <tbody>
                                                    <tr class="head">
                                                        <th class="left-adj-col1">
                                                        </th>
                                                        <th class="bid">
                                                            <p class="column_header">Bid</p>
                                                            <p id="bidAskSell1" class="column_subhead">Sell 1 <span class="cur1"></span></p>
                                                        </th>
                                                        <th class="ask">
                                                            <p class="column_header">Ask</p>
                                                            <p id="bidAskBuy1" class="column_subhead">Buy 1 <span class="cur1"></span></p>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="left-adj-col1">MIN</td>
                                                        <td id="bidAskBidMin" class="bid"></td>
                                                        <td id="bidAskAskMin" class="ask"></td>
                                                    </tr>
                                                    <tr >
                                                        <td class="left-adj-col1">AVG</td>
                                                        <td id="bidAskBidAvg" class="bid"></td>
                                                        <td id="bidAskAskAvg" class="ask"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left-adj-col1">MAX</td>
                                                        <td id="bidAskBidMax" class="bid"></td>
                                                        <td id="bidAskAskMax" class="ask"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="menu1">
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                        <li id="GG" class="active"><a href="#graph" data-toggle="tab">Graph</a></li>
                                        <li id="TT" ><a href="#table" data-toggle="tab">Table</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="graph">
                                            <div id="chartContainer2" style="height: 400px; width: 100%;margin: 25px;">

                                            </div>
                                        </div>
                                        <div class="tab-pane historicaltable" id="table" style="margin: 20px;">

                                            <table id="Tbl_periods" style="width: 100%;" class="table table-striped glossary-tab">
                                                <thead>
                                                <th>Date</th>
                                                <th><span class="cur1"></span>/<span class="cur2"></span></th>
                                                </thead>
                                                <tbody id="tbl_p">
                                                <tr>
                                                    <td>
                                                        Period Average
                                                    </td>
                                                    <td id="averegeClose">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Period High
                                                    </td>
                                                    <td id="averegeHigh">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Period Low
                                                    </td>
                                                    <td id="averegeLow">

                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="menu2">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    <a href="#"></a>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php /** FXPP-902 */ ?>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '/' +
        (day<10 ? '0' : '') + day + '/'+
        (month<10 ? '0' : '') + month;

    $("#date_start").val(output);

    $(document).ready(function(){
        $("#date_start").datetimepicker({
            format: "YYYY/DD/MM",
            disabledDates: []

        });

        $('#Tbl_periods').DataTable({stateSave: true});
    });
</script>

<script type="text/javascript">

    var prev='amountofconversion';
    var site_url="<?=site_url('')?>";
    var img_url="<?=$this->template->Images()?>";

    var pblc = [];
    pblc['request']=null;
    var prvt = [];
    var conversionfactor = false;

    var interbank = 1;
    var InterbankFloor =1;
    function UpdateRateDetailsTab() {
        $('.amount').html($("input[name=amount]").val());
        $('.amountx').html($("input[name=amountofconversion]").val());
        $('.amounty').html(($("input[name=amount]").val()*conversionfactor)*InterbankFloor);
    }
    function UpdateRateDetailsTabLoad(newdate) {
        $('.date').html(newdate);
        $('.cur1').html($('select[name=currencyihave]').val());
        $('.cur2').html($('select[name=currencyiwant]').val());
    }
    function format(state) {
        if (!state.id) return state.text; // optgroup
        return "<img class='flag' src='"+img_url+'SFlags/'+state.id.toUpperCase()+".png' />" + state.text;
    }

    $(document).on("click", ".switchtofrom", function () {

        $("select[name=currencyihave]").select2('destroy');
        $("select[name=currencyiwant]").select2('destroy');

        var to;
        var from;

        to = $("select[name=currencyihave]").val();
        from  = $("select[name=currencyiwant]").val();

        $("select[name=currencyihave]").val(from);
        $("select[name=currencyiwant]").val(to);

        delete to;
        delete from;

        $('select[name=currencyihave]').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; }
        });
        $('select[name=currencyiwant]').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; }
        });

        $("select[name=currencyihave]").change();
    });

    $().ready(function() {

        $('select[name=interbank]').select2();
        $('select[name=currencyihave]').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; }
        });
        $('select[name=currencyiwant]').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; }
        });

        prvt["data"] = {
            from: $('select[name=currencyihave]').val(),
            to:  $('select[name=currencyiwant]').val(),
            date: $('input[name=start_date]').val()
        };

        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'index.php?/pages/apiquotes2',
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if(data.date2==null){
                $(".xdate").html(data.date);
            }else{

                $(".xdate").html(data.date2);
            }


            var table = $('#Tbl_periods').DataTable();
            table.destroy();
            $("#averegeClose").html(data.Close);
            $("#averegeHigh").html(data.AverageCloseHigh);
            $("#averegeLow").html(data.AverageCloseLow);
            $('#Tbl_periods tr:last').after(data.table);
            $('#Tbl_periods').DataTable({stateSave: true});



            var JsonObject= JSON.parse(data.chart);
            $.each(JsonObject, function(key,value) {
                JsonObject[key].x= new Date (JsonObject[key].x);
            });
            chartcanvas(JsonObject);

            $("#bidAskBidMin").html(data.MinLow);
            $("#bidAskAskMin").html(data.MinHigh);

            $("#bidAskBidAvg").html(data.Low);
            $("#bidAskAskAvg").html(data.High);

            $("#bidAskBidMax").html(data.MaxLow);
            $("#bidAskAskMax").html(data.MaxHigh);
            $("#bidAskDate").html(data.LastDate);

            $('div[name=RateDetails]').removeClass('display-n');
            UpdateRateDetailsTabLoad(data.date);

            if(data.value==false){
                conversionfactor=false;
            }else{
                conversionfactor=data.value;
            }
            $("input[name=amount]").change();

        });
        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });

        $('select[name=interbank]').change(function(){
            interbank=1;
            InterbankFloor = interbank + $('select[name=interbank]').val();
            $('.interbank').html($('select[name=interbank] option:selected').html());
            interbank = interbank - $('select[name=interbank]').val();

            if (prev=='amount') {
                $("input[name=amount]").val(($("input[name=amountofconversion]").val()/conversionfactor)*interbank);

            }else{
                $("input[name=amountofconversion]").val(($("input[name=amount]").val() * conversionfactor) * interbank);

            }
            UpdateRateDetailsTab()
        });

        $('select[name=currencyihave]').change(function(){
            $('#loader-holder').show();
            prvt["data"] = {
                from: $('select[name=currencyihave]').val(),
                to:  $('select[name=currencyiwant]').val(),
                date: $('input[name=start_date]').val()
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + 'index.php?/pages/apiquotes2',
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                if(data.date2==null){
                    $(".xdate").html(data.date);
                }else{
                    $(".xdate").html(data.date2);
                }

                var table = $('#Tbl_periods').DataTable();
                table.destroy();
                $("#averegeClose").html(data.Close);
                $("#averegeHigh").html(data.AverageCloseHigh);
                $("#averegeLow").html(data.AverageCloseLow);
                $('#Tbl_periods tr:last').after(data.table);
                $('#Tbl_periods').DataTable({stateSave: true});



                var JsonObject= JSON.parse(data.chart);
                $.each(JsonObject, function(key,value) {
                    JsonObject[key].x= new Date (JsonObject[key].x);
                });
                chartcanvas(JsonObject);

                $("#bidAskBidMin").html(data.MinLow);
                $("#bidAskAskMin").html(data.MinHigh);

                $("#bidAskBidAvg").html(data.Low);
                $("#bidAskAskAvg").html(data.High);

                $("#bidAskBidMax").html(data.MaxLow);
                $("#bidAskAskMax").html(data.MaxHigh);
                $("#bidAskDate").html(data.LastDate);

                UpdateRateDetailsTabLoad(data.date);
                if(data.value==false){
                    conversionfactor=false;
                }else{
                    conversionfactor=data.value;
                }

                $("input[name=amountofconversion]").val(($("input[name=amount]").val()*conversionfactor)*interbank);

                UpdateRateDetailsTab();

                prev='amountofconversion';
                if(isNaN($("input[name=amountofconversion]").val())){
                    $("input[name=amountofconversion]").val('');
                    prev='amountofconversion';
                }
            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

        });


        $('select[name=currencyiwant]').change(function(){
            $('#loader-holder').show();
            prvt["data"] = {
                from: $('select[name=currencyihave]').val(),
                to:  $('select[name=currencyiwant]').val(),
                date: $('input[name=start_date]').val()
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + 'index.php?/pages/apiquotes2',

                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                if(data.date2==null){
                    $(".xdate").html(data.date);
                }else{
                    $(".xdate").html(data.date2);
                }

                var table = $('#Tbl_periods').DataTable();
                table.destroy();
                $("#averegeClose").html(data.Close);
                $("#averegeHigh").html(data.AverageCloseHigh);
                $("#averegeLow").html(data.AverageCloseLow);
                $('#Tbl_periods tr:last').after(data.table);
                $('#Tbl_periods').DataTable({stateSave: true});




                var JsonObject= JSON.parse(data.chart);
                $.each(JsonObject, function(key,value) {
                    JsonObject[key].x= new Date (JsonObject[key].x);
                });
                chartcanvas(JsonObject);
                $("#bidAskBidMin").html(data.MinLow);
                $("#bidAskAskMin").html(data.MinHigh);

                $("#bidAskBidAvg").html(data.Low);
                $("#bidAskAskAvg").html(data.High);

                $("#bidAskBidMax").html(data.MaxLow);
                $("#bidAskAskMax").html(data.MaxHigh);

                $("#bidAskDate").html(data.LastDate);

                UpdateRateDetailsTabLoad(data.date);

                if(data.value==false){
                    conversionfactor=false;
                }else{
                    conversionfactor=data.value;
                }

                $("input[name=amountofconversion]").val(($("input[name=amount]").val()*conversionfactor)*interbank);

                UpdateRateDetailsTab();

                prev='amountofconversion';
                if(isNaN($("input[name=amountofconversion]").val())){
                    $("input[name=amountofconversion]").val('');
                    prev='amountofconversion';
                }
            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

        });

        $("input[name=amount]").on("change paste keyup", function() {

            $("input[name=amountofconversion]").val(($("input[name=amount]").val()*conversionfactor)*interbank);
            prev='amountofconversion';
            if(isNaN($("input[name=amountofconversion]").val())){
                $("input[name=amountofconversion]").val('');
                prev='amountofconversion';
            }

            UpdateRateDetailsTab()

        });

        $("input[name=amountofconversion]").on("change paste keyup", function() {

            $("input[name=amount]").val(($("input[name=amountofconversion]").val()/conversionfactor)*interbank);
            prev='amount';
            if(isNaN($("input[name=amountofconversion]").val())){
                $("input[name=amountofconversion]").val('');
                prev='amountofconversion';
            }

            UpdateRateDetailsTab()

        });
        $("#date_start").on("focusout", function() {
            $("select[name=currencyihave]").change();
        });
    });
</script>

<script type="text/javascript">

    function chartcanvas(chartdata){
        var chart = new CanvasJS.Chart("chartContainer",
            {
                animationEnabled: true,
                zoomEnabled: true,
                title:{
                    text: ''
                },
                legend: {
                    horizontalAlign: "right",
                    verticalAlign: "center"
                },
                axisY:{
                    includeZero: false
                },
                data: [
                    {
                        type: "line",

                        dataPoints: chartdata

                    }
                ]
            });

        chart.render();
        var chart = new CanvasJS.Chart("chartContainer2",
            {
                animationEnabled: true,
                zoomEnabled: true,
                title:{
                    text: ''
                },
                legend: {
                    horizontalAlign: "right",
                    verticalAlign: "center"
                },
                axisY:{
                    includeZero: false
                },
                data: [
                    {
                        type: "line",

                        dataPoints: chartdata

                    }
                ]
            });

        chart.render();
    }

    $(document).on("click", ".hitlink", function () {
        $('li#HER').addClass('active');
        $('li#RD').removeClass('active');
    });
</script>
