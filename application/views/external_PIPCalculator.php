<style>
    .forex-calculator-container {
        border:1px solid #dddddd;
        margin:0 auto;
        float:none;
    }
    .forex-calculator-child {
        margin:20px auto;

    }

    .modal-dialog-table table , .modal-dialog-table table tr td {
        border:1px solid #dddddd;
    }

    .forex-calculator-content {
        margin:10px auto;
        font-family: Open Sans;
    }

    .modal-dialog-search input[type=text] {
        border-radius:0;
    }

    .modal-dialog-table table tr td , .forex-calculator-content {
        font-size:13px;
    }

    .forex-calculator-content span {
        font-weight:bold;
    }

    .modal-dialog-search label {
        line-height:34px;
        margin-right:10px;
    }

    .forex-calculator-child .forex-calculator-value span {
        margin:0 auto;
    }

    .modal-dialog-table table tr td label {
        margin-bottom:0;
    }

    .forex-calculator-child .bootstrap-select , .modal-dialog-search {
        display:table;
    }

    .forex-calculator-child .dropdown-menu ul li .glyphicon {
        display:none;
    }

    .modal-dialog-search .form-control {
        display:inline-block;
    }

    .forex-calculator-child .forex-calculator-value span {
        display:block;
    }

    .forex-calculator-child .dropdown-menu ul {
        position:relative;
    }

    .modal-dialog-search label {
        float:left;
    }

    .forex-calculator-child .bootstrap-select .btn .caret , .modal-dialog-search {
        float:right;
    }

    .modal-dialog-search label {
        margin-bottom:0;
    }

    .modal-dialog-search {
        margin-bottom:10px;
    }

    .forex-calculator-child .dropdown-menu {
        padding:0;
    }

    .modal-dialog-table {
        overflow-y:scroll;
        height:400px;
    }

    .modal-dialog-table table thead th {
        padding:5px;
    }

    .modal-dialog-table table tr td {
        padding:7px 5px;
        vertical-align:middle;
    }

    .forex-calculator-child .forex-calculator-value span , .modal-dialog-table table thead th , .modal-dialog-table table tr td {
        text-align:center;
    }

    .forex-calculator-child .forex-calculator-value span {
        color:#ff0000;
        font-size:30px;
    }

    .forex-calculator-child .bootstrap-select , .forex-calculator-child .bootstrap-select .btn , .forex-calculator-child .dropdown-menu ,
    .forex-calculator-max-input .input-group , .forex-calculator-max-input .input-group input[type=text] , .modal-dialog-table table {
        width:100%;
    }

    .forex-calculator-child {
        width:90%;
    }

    .modal-dialog-search .form-control {
        width:auto!important;
    }

    .forex-calculator-child .btn-holder a {
        color: #fff;
        font-family: Open Sans;
        font-size: 17px;
        font-weight: 600;
        background: #2988ca;
        padding: 15px;
        display:block;
        transition: all ease 0.3s;
    }

    .forex-calculator-child .btn-holder a:hover {
        background: #319ae3;
    }

    .forex-calculator-child .forex-calculator-value {
        border:1px solid #2988ca;
        padding:15px 0;
    }

    .forex-calculator-child .bootstrap-select .btn .caret {
        margin-top:9px;
    }

    .forex-calculator-first-child {
        margin-top:40px;
    }

    .forex-calculator-last-child {
        margin-bottom:40px;
    }

    .forex-calculator-child .input-group input[type=text] , .forex-calculator-child .input-group .btn-default , .forex-calculator-child .bootstrap-select .btn ,
    .forex-calculator-child .dropdown-menu {
        border-radius:0;
    }

    .forex-calculator-child .dropdown-menu ul {
        max-height:250px!important;
        border:0;
    }

    .forex-calculator-child .dropdown-menu>li>a {
        padding:3px 10px;
    }

    .forex-calculator-child .input-group .btn-default {
        background:#2988ca;
        color:#fff;
        border:1px solid #2988ca;
        margin-left:5px;
        transition: all ease 0.3s;
    }

    .forex-calculator-child .input-group .btn-default:hover {
        background:#319ae3;
    }

    .forex-calculator-child label {
        margin-bottom:0;
        color:#5a5a5a;
    }
    .normalizeZI{
        z-index: 0!important;
    }

    .select2-container{
        width:100%;
        height: auto;

    }
    .select2-container .select2-choice{
        border-radius: 0px!important;
        height: 32px!important;
    }
    .select2-container .select2-choice .select2-arrow{
        border-radius: 0px!important;
    }
    .flag{
        margin: 0 25px 0 0px;
        padding: 2px;
    }
    .btn-holder {
        text-align: center!important;
    }

    a.calculate:hover{
        color: #FFF;
        text-decoration: none;
    }
    a.calculate:link{
        color: #FFF;
        text-decoration: none;
    }
    a.calculate:visited{
        color: #FFF;
        text-decoration: none;
    }
    a.calculate:active{
        color: #FFF;
        text-decoration: none;
    }
</style>

<?php /** Preloader Modal Start */ ?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<?php /** Preloader Modal End */ ?>

<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 normalizeZI">
                <h1 class="license-title">Forex Calculator</h1>
                <div class="forex-calculator-container col-lg-5 col-md-5">
                    <form>
                        <div class="forex-calculator-child forex-calculator-first-child">
                            <label>Currency Pair:</label>
                            <?= form_dropdown('conversionfactor', $getCurrencyPair, 'USD/RUB');?>
                        </div>
                        <div class="forex-calculator-child">
                            <label>Account Currency:</label>
                                <?= form_dropdown('currency', $countries, 'RUB');?>
                        </div>
                        <div class="forex-calculator-child forex-calculator-max-input">
                            <label>Trade Size (In units):</label>
                            <div class="input-group">
                                <input type="text" class="form-control " value="10,000" name="lotsize"/>
                            </div>
                        </div>
                        <div class="forex-calculator-child forex-calculator-max-input">
                            <label>Exchange rate:</label>
                            <span name="ER"></span>
                            <span name="CurrencyPair"></span>
                        </div>
                        <div class="forex-calculator-child ">
                            <div class="btn-holder">
                                <a class="calculate" href="javascript:void(0);">Calculate</a>
                            </div>
                        </div>
                        <div class="forex-calculator-child">
                            <label>Pip Value:<span name="PipCurrency"></span></label>
                            <div class="forex-calculator-value">
                                <span name="PipValue">0.00</span>
                            </div>
                        </div>
                        <div class="forex-calculator-child">
                            <label>1 Current Conversion Price: (USD/USD)</label>
                            <div class="forex-calculator-content">
                                <span>Example</span>
                                <p>Trading 1 lot of EUR/USD with an account denominated in GBP.
                                    </br>One pip = 0.0001
                                    </br>Exchange rate (USD/GBP) = 0.6548
                                    </br>1 lot = 100,000
                                    </br>Pip Value = 0.0001 * 0.6548 * 100,000 = 6.548
                                    </br>Each pip costs &#163;6.55
                                    </br>Margin Calculation
                                    </br>Margin Required = Lot Size/leverage  * exchange rate (base currency/account currency)  </p>
                                </span>
                            </div>
                            <div class="forex-calculator-content">
                                <span>Example</span>
                                <p>Trading 1 lot of EUR/USD using 1:2000 leverage on account denominated in GBP.
                                    </br>1 lot = 100,000
                                    </br>Exchange rate (USD/GBP) = 0.7369
                                    </br>Leverage = 200
                                    </br>Margin Required = 100,000/200 * 0.7369 = 368.45
                                    </br>Margin Required is &#163;368.45
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var site_url="<?=FXPP::loc_url('')?>";
        var img_url="<?=$this->template->Images()?>";

        var pblc = [];
        pblc['request']=null;
        var prvt = [];
        var conversionfactor = false;

        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='"+img_url+'SFlags/'+state.id.toUpperCase()+".png' />" + state.text;
        }

        $().ready(function() {
            $("input[name='lotsize']").keyup(function(event){
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                    event.preventDefault();
                }
                var $this = $(this);
                var num = $this.val().replace(/,/gi, "");
                var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
                $this.val(num2);
            });


          $('select[name=conversionfactor]').select2({

            });

            $('select[name=currency]').select2({
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function(m) { return m; }
            });

            $('#loader-holder').show();


            var split = $('select[name=conversionfactor] option:selected').text().split('/');
            var CurrencySelected = $('select[name=currency] option:selected').val();
            prvt["data"] = {
                from: split[1],
                to: CurrencySelected
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + 'pages/apiquotes',
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                conversionfactor=data.value;
                $('span[name=ER]').html(conversionfactor);
                $('span[name=CurrencyPair]').html( '( '+split[1]+'/'+CurrencySelected+' )' );

            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });


        });

        $(document).on("click", ".calculate", function () {
            $('#loader-holder').show();

            var LotSize =$('input[name=lotsize]').val();

            prvt["data"] = {
                ExchangeRate: conversionfactor,
                Lot:  parseFloat(LotSize.replace(',','').replace(' ','')),
                Pip: 0.0001,
            };

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + 'pages/calculate',
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                $('span[name=PipValue]').html( data.pipvalue);
                $('span[name=PipCurrency]').html(" ( " + $('select[name=currency] option:selected').val() + " ) ");

            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

        });
        $().ready(function() {

            $('select[name=conversionfactor]').change(function(){

                $('#loader-holder').show();

                var split = $('select[name=conversionfactor] option:selected').text().split('/');
                var CurrencySelected = $('select[name=currency] option:selected').val();

                prvt["data"] = {
                    from: split[1],
                    to: CurrencySelected
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url: site_url + 'pages/apiquotes',
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    conversionfactor=data.value;
                    $('span[name=ER]').html(conversionfactor);
                    $('span[name=CurrencyPair]').html( '( '+split[1]+'/'+CurrencySelected+' )' );
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });

                pblc['request'].always(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });
            });


            $('select[name=currency]').change(function(){

                $('#loader-holder').show();

                var split = $('select[name=conversionfactor] option:selected').text().split('/');
                var CurrencySelected = $('select[name=currency] option:selected').val();

                prvt["data"] = {
                    from: split[1],
                    to: CurrencySelected
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url: site_url + 'pages/apiquotes',
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    conversionfactor=data.value;
                    $('span[name=ER]').html(conversionfactor);
                    $('span[name=CurrencyPair]').html( '( '+split[1]+'/'+CurrencySelected+' )' );
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });

                pblc['request'].always(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });
            });


        });
    </script>