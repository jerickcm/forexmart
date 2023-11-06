<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-currency-conversion.css' type='text/css'  />"));
    });
</script>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title sa-right">
                    <?=lang('xnv_CC');?>
                </h1>

                <div class="row converter-holder " dir="ltr">
                    <div class="col-sm-5 ">
                        <label class="amount-label ext-arabic-amount-label">
                            <?=lang('x_curcon_1');?>
                        </label>
                        <div class="converter-drp ext-arabic-amount-label">
                            <?= form_dropdown('currencyihave', $countries, 'USD', 'dir="ltr"');?>
                        </div>
                        <div class="amount-holder">
                            <form>
                                <div class="form-group">
                                    <label  class="amount-label">
                                        <?=lang('x_curcon_2');?>

                                    </label>
                                    <input type="text" class="form-control round-0 cur-amount" id="amount" value="1" name="amount" placeholder="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-2 ">
                        <div class="btn-switch-holder ext-arabic-btn-switch-holder">
                            <a dir="ltr" class="btn-switch switchtofrom"><i class="fa fa-caret-left sleft"></i><i class="fa fa-caret-right sright"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-5 ">
                        <label  class="amount-label ext-arabic-amount-label">
                            <?=lang('x_curcon_3');?>
                        </label>
                        <div class="converter-drp">
                            <?= form_dropdown('currencyiwant', $countries, 'EUR', 'dir="ltr"');?>
                        </div>
                        <div class="amount-holder">
                            <form>
                                <div class="form-group">
                                    <label  class="amount-label ext-arabic-amount-label">
                                        <?=lang('x_curcon_4');?>
                                    </label>
                                    <input type="text" class="form-control round-0 cur-amount" id="amountofconversion" style="" name="amountofconversion" placeholder="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ext-arabic-converter-bottom">
                        <div class="cur-datepicker-holder">
                            <form class="form-inline ext-arabic-second-form-inline">
                                <div class="form-group ext-arabic-form-group-converter">
                                    <label >
                                        <?=lang('x_curcon_5');?>
                                    </label>
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
                                <div class="form-group ext-arabic-form-group-converter">

                                    <label >
                                        <?=lang('x_curcon_6');?>:
                                    </label>
                                    <input type="text" id="date_start" name="start_date" class="form-control required" />

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h1 class="cur-details-title ext-arabic-cur-details-title">
                            <?=lang('x_curcon_7');?>
                        </h1>
                        <div class="cur-details-holder ext-arabic-cur-details-holder">
                            <h1 class="headline"><span class="cur1"></span>/<span class="cur2"></span>
                                <?=lang('x_curcon_8');?>
                            </h1>
                            <p class="usd-details"><span class="cur1"></span>/<span class="cur2"></span>
                                <?=lang('x_curcon_9');?>
                                <span class="xdate"></span> @ <span class="interbank">+/- 0</span></p>

                            <p class="cur-details">
                                <?=lang('x_curcon_10');?>
                                <span class="amount"></span> <span class="cur1"></span> <i class="fa fa-long-arrow-right"></i>
                                <?=lang('x_curcon_11');?>
                                <span class="amountx"></span> <span class="cur2"></span></p>
                            <p class="cur-details">
                                <?=lang('x_curcon_12');?>
                                <span class="amount"></span> <span class="cur1"></span> <i class="fa fa-long-arrow-right"></i>
                                <?=lang('x_curcon_13');?>
                                <span class="amounty"></span> <span class="cur2"></span></p>

                        </div>
                    </div>
                </div>


                <?php /** FXPP-902 */ ?>

                <div class="row">
                    <div class="col-md-6  ext-arabic-recent-container">
                        <div class="recent-trends-holder ext-arabic-recent-details">
                            <h1>
                                <?=lang('x_curcon_14');?>
                            </h1>
                            <p>
                                <span class="cur1"></span>/<span class="cur2"> <?=lang('x_curcon_15');?></span>
                            </p>
                            <div class="recent-trend-graph-holder">
                                <div id="chartContainer" dir="ltr" style="height: 250px; width: 90%;margin: 20px"></div>
                            </div>
                            <div class="col-md-12">
                                <p class="cur-info">
                                    <?=lang('x_curcon_16');?>
                                    <a aria-expanded="false" href="#menu1" data-toggle="tab" class="hitlink">
                                        <?=lang('x_curcon_17');?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  ext-arabic-recent-container">
                        <div class="recent-details-holder ext-arabic-recent-details">
                            <h1>
                                <?=lang('x_curcon_18');?>
                            </h1>
                            <p id="bidAskSubtitle" class="minisubhead"><span class="cur1"></span>/<span class="cur2"></span>
                                <?=lang('x_curcon_19');?>
                                <span id="bidAskDate" ></span></p>
                            <table id="bidask" class="recent-details-tab ext-arabic-details-tab">
                                <thead>
                                <tr>
                                    <th class="cur-stat"></th>
                                    <th class="cur-bid">
                                        <?=lang('x_curcon_20');?>
                                        <span>
                                            <?=lang('x_curcon_21');?> 1
                                            <span class="cur1"></span>
                                        </span>
                                    </th>
                                    <th class="cur-ask">
                                        <?=lang('x_curcon_22');?>
                                        <span>
                                            <?=lang('x_curcon_23');?> 1
                                            <span class="cur1"></span></span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="left-adj-col1">
                                        <?=lang('x_curcon_24');?>
                                    </td>
                                    <td id="bidAskBidMin" class="bid"></td>
                                    <td id="bidAskAskMin" class="ask"></td>
                                </tr>
                                <tr>
                                    <td class="left-adj-col1">
                                        <?=lang('x_curcon_25');?>
                                    </td>
                                    <td id="bidAskBidAvg" class="bid"></td>
                                    <td id="bidAskAskAvg" class="ask"></td>
                                </tr>
                                <tr>
                                    <td class="left-adj-col1">
                                        <?=lang('x_curcon_26');?>
                                    </td>
                                    <td id="bidAskBidMax" class="bid"></td>
                                    <td id="bidAskAskMax" class="ask"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h1 class="cur-details-title">
                            <?=lang('x_curcon_27');?>
                        </h1>
                        <div class="settings-tab">
                            <ul role="tablist" class="queue-tab-list ext-arabic-queue-tab-list">
                                <li id="GR"  role="presentation"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" id="t3">
                                        <?=lang('x_curcon_28');?>
                                    </a></li>
                                <li id="TA" role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" id="t4">
                                        <?=lang('x_curcon_29');?>
                                    </a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content cur-tab-cont">
                            <div role="tabpanel" class="row tab-pane active" id="tab1">
                                <div class="cur-graph-holder col-md-12">
                                    <div id="chartContainer2"  dir="ltr" style="height: 350px; width: 95%;margin: 25px;">

                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="row tab-pane" id="tab2">
                                <div class="cur-table-holder col-md-12">
                                    <div class="dataTable_wrapper">
                                        <table id="Tbl_periods" style="width: 100%;" class="table table-striped glossary-tab">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <?=lang('x_curcon_6');?>
                                                </th>
                                                <th><span class="cur1"></span>/<span class="cur2"></span></th>
                                            </tr>

                                            </thead>
                                            <tbody id="tbl_p">
                                            <tr>
                                                <td>
                                                    <?=lang('x_curcon_30');?>
                                                </td>
                                                <td id="averegeClose">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?=lang('x_curcon_31');?>
                                                </td>
                                                <td id="averegeHigh">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?=lang('x_curcon_32');?>
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

    var prev='amountofconversion';
    var site_url="<?=FXPP::ajax_url()?>";
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
            url: site_url + 'Currency_conversion/apiquotes2',
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if(data.date2==null){
                $(".xdate").html(data.date);
            }else{

                $(".xdate").html(data.date2);
            }

            // limit datatable pagination
            $.fn.dataTable.ext.pager.numbers_length = 5;

            var table = $('#Tbl_periods').DataTable();
            table.destroy();
            $("#averegeClose").html(data.Close);
            $("#averegeHigh").html(data.AverageCloseHigh);
            $("#averegeLow").html(data.AverageCloseLow);
            $('#Tbl_periods tr:last').after(data.table);
            $('#Tbl_periods').DataTable({
                stateSave: true,
                language: {
                    search: "<?=lang('search');?>:",
                    lengthMenu: "<?=lang('show_entries');?>",
                    paginate: {
                        "previous": '<<',
                        "next": '>>'
                    }
                }
            });

            var JsonObject= JSON.parse(data.chart);
            $.each(JsonObject, function(key,value) {
                JsonObject[key].x= new Date (JsonObject[key].x);
            });
            chartcanvas(JsonObject);

            $("#bidAskBidMin").html(round(data.MinLow,6));
            $("#bidAskAskMin").html(round(data.MinHigh,6));

            $("#bidAskBidAvg").html(round(data.Low,6));
            $("#bidAskAskAvg").html(round(data.High,6));

            $("#bidAskBidMax").html(round(data.MaxLow,6));
            $("#bidAskAskMax").html(round(data.MaxHigh,6));
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
                url: site_url + 'Currency_conversion/apiquotes2',
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

                $("#bidAskBidMin").html(round(data.MinLow,6));
                $("#bidAskAskMin").html(round(data.MinHigh,6));

                $("#bidAskBidAvg").html(round(data.Low,6));
                $("#bidAskAskAvg").html(round(data.High,6));

                $("#bidAskBidMax").html(round(data.MaxLow,6));
                $("#bidAskAskMax").html(round(data.MaxHigh,6));
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
                url: site_url + 'Currency_conversion/apiquotes2',

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
                $("#bidAskBidMin").html(round(data.MinLow,6));
                $("#bidAskAskMin").html(round(data.MinHigh,6));

                $("#bidAskBidAvg").html(round(data.Low,6));
                $("#bidAskAskAvg").html(round(data.High,6));

                $("#bidAskBidMax").html(round(data.MaxLow,6));
                $("#bidAskAskMax").html(round(data.MaxHigh,6));

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

    function round(value, decimals) {
        return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
    }
    function chartcanvas(chartdata){
        var chart = new CanvasJS.Chart("chartContainer",
            {
                exportEnabled: true,
                zoomEnabled: true,
                zoomType: "xy",
                animationEnabled: true,
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
                exportEnabled: true,
                zoomEnabled: true,
                zoomType: "xy",
                animationEnabled: true,
                title:{
                    text: ''
                },
                legend: {
                    horizontalAlign: "right",
                    verticalAlign: "center"
                },
                axisY:{
                    labelFontSize: 16,
                    includeZero: false,

                    tickColor: "DarkSlateBlue" ,
                    tickThickness: 2,


                    gridThickness: 2,
                },
                axisX:{
                    labelFontSize: 16,

                    tickColor: "red",
                    tickThickness: 2,


                    gridThickness: 2,

                    interlacedColor: "#F0F8FF",
                    labelAutoFit: false,
                    tickLength: 2
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

        $("#t3").removeClass("active-cur-tab");
        $("#t4").addClass("active-cur-tab");

        $('#tab2').addClass('active');
        $('#tab1').removeClass('active');
    });


    $(window).load(function(){
        $("#t3").addClass("active-cur-tab");
    });

    $( document ).ready(function() {
        var $t3 = $('#t3');
        var $t4 = $('#t4');

        var req = [$t4];
        var pro = [$t3];
        $("#t3").click(function(){
            $("#t3").addClass("active-cur-tab");
            $.each(req, function(){
                $(this).removeClass("active-cur-tab");
            });
        });
        $("#t4").click(function(){
            $("#t4").addClass("active-cur-tab");
            $.each(pro, function(){
                $(this).removeClass("active-cur-tab");
            });
        });
    });

    //currency i have
    $(document).ready(function(){
        $('#curlist li').click(function() {
            $('#cur-val').text($(this).text());

            var flag = $(this).find('i');
            // alert(flag.attr('class'));
            $('#cur-flag').removeClass($('#cur-flag').attr('class')).addClass(flag.attr('class'));
            $('#cur-list-holder').hide('fast');
        });
    });
    //currency i want
    $(document).ready(function(){
        $('#curlist1 li').click(function() {
            $('#cur-val1').text($(this).text());

            var flag = $(this).find('i');
            // alert(flag.attr('class'));
            $('#cur-flag1').removeClass($('#cur-flag1').attr('class')).addClass(flag.attr('class'));
            $('#cur-list-holder1').hide('fast');
        });
    });
    $(document).ready(function(){
        $('#bidask').DataTable({
            responsive: true,
            "dom": '<"top"><"clear">t<"bottom"><"clear">'
        });
    });
</script>