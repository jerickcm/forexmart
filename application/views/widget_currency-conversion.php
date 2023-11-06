<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title">ForexMart Informers</h1>
                    <p class="ins-text">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                    </p>
                    <h1 class="license-sub">Informer Type</h1>
                    <div class="ins-tab-holder">
                        <?= $widget_informers_tab?>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab3">
                                <div class="ticker-holder row quotes-holder">
                                    <div class="col-md-5 col-centered">
                                        <div class="panel panel-default ticker-panel">
                                            <div class="panel-heading ticker-heading">
                                                Currency Converter
                                            </div>
                                            <div class="panel-body">
                                                <div class="informer-converter-holder">
                                                    <label class="amount-label">
                                                        <?=lang('x_curcon_1');?>
                                                    </label>
                                                    <div class="converter-drp">
                                                        <?= form_dropdown('currencyihave', $countries, 'USD', 'dir="ltr"');?>
                                                    </div>
                                                    <div class="amount-holder">
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="amount-label">
                                                                    <?=lang('x_curcon_2');?>
                                                                </label>
                                                                <input type="text" class="form-control round-0 cur-amount" id="amount" value="1" name="amount" placeholder="">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="converter-switch-holder">
                                                    <div class="switchtofrom btn-switch-holder informer-btn-switch-holder">
                                                        <button class="btn-switch"><i class="fa fa-caret-left sleft"></i><i class="fa fa-caret-right sright"></i></button>
                                                    </div>
                                                </div>
                                                <div class="informer-converter-holder">
                                                    <label class="amount-label">
                                                        <?=lang('x_curcon_3');?>
                                                    </label>
                                                    <div class="converter-drp">
                                                        <?= form_dropdown('currencyiwant', $countries, 'EUR', 'dir="ltr"');?>
                                                    </div>
                                                    <div class="amount-holder">
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="amount-label">       <?=lang('x_curcon_4');?></label>
                                                                <input type="text" class="form-control round-0 cur-amount" id="amountofconversion" style="" name="amountofconversion" placeholder="">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="cur-datepicker-holder">
                                                        <form class="form-inline">
                                                            <div class="form-group">
                                                                <label for="">
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
                                                            <div class="form-group">
                                                                <label for="">
                                                                    <?=lang('x_curcon_6');?>:
                                                                </label>
                                                                <input type="text" id="date_start" name="start_date" class="form-control required" />
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="install-holder">
                                    <a class="install-a" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse2" id="col-b">
                                        <h1 class="install-sub">Install Currency Converter <span class="plus-sign">[+]</span></h1>
                                    </a>
                                    <a class="install-a" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse2" id="col-b1">
                                        <h1 class="install-sub">Install Currency Converte <span class="minus-sign">[-]</span></h1>
                                    </a>
                                    <div class="row collapse" id="collapse3">
                                        <div class="col-md-6 col-sm-6">
                                            <h2 class="install-text">Settings</h2>
                                            <div class="install-settings-holder">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Choose tickers:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-5 left-list">
                                                            <select size="8" class="form-control round-0" multiple>
                                                                <option>Sample 1</option>
                                                                <option>Sample 2</option>
                                                                <option>Sample 3</option>
                                                                <option>Sample 4</option>
                                                                <option>Sample 5</option>
                                                                <option>Sample 6</option>
                                                                <option>Sample 7</option>
                                                                <option>Sample 8</option>
                                                                <option>Sample 9</option>
                                                                <option>Sample 10</option>
                                                                <option>Sample 11</option>
                                                                <option>Sample 12</option>
                                                                <option>Sample 13</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-2 btn-caret-holder">
                                                            <button class="btn-caret-right"><i class="fa fa-caret-right"></i></button>
                                                            <button class="btn-caret-left"><i class="fa fa-caret-left"></i></button>
                                                            <button class="btn-caret-up"><i class="fa fa-caret-up"></i></button>
                                                            <button class="btn-caret-down"><i class="fa fa-caret-down"></i></button>
                                                        </div>
                                                        <div class="col-xs-5 right-list">
                                                            <select size="8" class="form-control round-0" multiple>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Width:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control round-0 width-text" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Height:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control round-0 width-text" placeholder="13-30">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-3 install-fields">Font:</label>
                                                    <div class="col-xs-9">
                                                        <div class="col-xs-9 font-family">
                                                            <select class="form-control round-0">
                                                                <option>Sample</option>
                                                                <option>Sample</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize">
                                                                <option>12px</option>
                                                                <option>14px</option>
                                                                <option>16px</option>
                                                                <option>18px</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Background Colour:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Gradient:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">News:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <label>Quotes:</label>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Forex Webinars:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Arrow Form:</label>
                                                    <div class="col-xs-7">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="sample" value="option1"> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i>
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="sample" value="option2"> &uarr;&darr;
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="sample" value="option3"> <i class="fa fa-chevron-up"></i><i class="fa fa-chevron-down"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Downwards Arrow colour:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Upwards Arrow colour:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Decrease Data colour:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-5 install-fields">Increase Data colour:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="btn-apply-holder">
                                                    <button class="btn-apply">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6 col-sm-6">
                                            <h2 class="install-text">Informer preview</h2>
                                            <div class="preview-holder ticker-preview">
                                                <div class="ticker">
                                                    <div class="panel panel-default ticker-panel">
                                                        <div class="panel-heading ticker-heading">
                                                            Ticker
                                                        </div>
                                                        <div class="panel-body ticker-body">
                                                            <div class="ticker-cont-holder">
                                                                <div class="ticker-cont">
                                                                    <a href="#" class="dis-scroll">disable scroll</a>
                                                                    <div class="clearfix"></div>
                                                                    <table>
                                                                        <tr>
                                                                            <td class="ticker-text">EURUSD</td>
                                                                            <td><i class="fa fa-caret-up ticker-up-arrow"></i></td>
                                                                            <td class="ticker-value-up">1.1344|1.1347</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">GBPUSD</td>
                                                                            <td><i class="fa fa-caret-down ticker-down-arrow"></i></td>
                                                                            <td class="ticker-value-down">1.5862|1.5865</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">EURUSD</td>
                                                                            <td><i class="fa fa-caret-up ticker-up-arrow"></i></td>
                                                                            <td class="ticker-value-up">1.1344|1.1347</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">GBPUSD</td>
                                                                            <td><i class="fa fa-caret-down ticker-down-arrow"></i></td>
                                                                            <td class="ticker-value-down">1.5862|1.5865</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">EURUSD</td>
                                                                            <td><i class="fa fa-caret-up ticker-up-arrow"></i></td>
                                                                            <td class="ticker-value-up">1.1344|1.1347</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">GBPUSD</td>
                                                                            <td><i class="fa fa-caret-down ticker-down-arrow"></i></td>
                                                                            <td class="ticker-value-down">1.5862|1.5865</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">EURUSD</td>
                                                                            <td><i class="fa fa-caret-up ticker-up-arrow"></i></td>
                                                                            <td class="ticker-value-up">1.1344|1.1347</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">GBPUSD</td>
                                                                            <td><i class="fa fa-caret-down ticker-down-arrow"></i></td>
                                                                            <td class="ticker-value-down">1.5862|1.5865</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">EURUSD</td>
                                                                            <td><i class="fa fa-caret-up ticker-up-arrow"></i></td>
                                                                            <td class="ticker-value-up">1.1344|1.1347</td>
                                                                            <td class="ticker-div">:</td>

                                                                            <td class="ticker-text">GBPUSD</td>
                                                                            <td><i class="fa fa-caret-down ticker-down-arrow"></i></td>
                                                                            <td class="ticker-value-down">1.5862|1.5865</td>
                                                                            <td class="ticker-div">:</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6 col-sm-6">
                                            <h2 class="install-text">Code to insert</h2>
                                            <div class="code-holder">
                                                <p class="code-text">
                                                    Quotes are automatically updated once in 30s.<br>
                                                    Sample code. Insert it in the page body (between < body > and < /body >)
                                                </p>
                                                <h1 class="code-sub">IFRAME version</h1>
                                                <textarea rows="4" class="form-control round-0 iframe-text">sample</textarea>
                                                <h1 class="code-sub">PHP version</h1>
                                                <textarea rows="4" class="form-control round-0 iframe-text">sample</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
       
                </div>
                    
                        
                    <div class="clearfix"></div>
                <?= $DemoAndLiveLinks?>
            </div>
        </div>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

<link href="<?=$this->template->Css()?>informer.css" rel="stylesheet">
<style type="text/css">
/*    added*/
/*select[name=currencyihave]{*/
    /*width: 100%!important;*/
/*}*/
/*select[name=currencyiwant]{*/
    /*width: 100%!important;*/
/*}*/

    .selectboxit-option-icon-url{background-size:16px 10px!important}.select2-container{width:100%;height:auto}.flag{margin:0 25px 0 0;padding:2px}.converter-drp{color:#000!important}.select2-container .select2-choice{border-radius:0!important;height:32px!important}.select2-container,.select2-choice,.select2-arrow{border-radius:0!important}#select2-drop{width:457px!important}.switchtofrom{cursor:pointer}.select2-drop-active{border-width:medium 2px 2px!important}.left-adj-col1{padding:5px 15px}.bid{padding:0 5px}.ask{padding:0 5px}.highlightSellBuy{font-size:20px;font-weight:bold}
                                                                                                                         /*added*/
    .fade {
        opacity: 0;
        -webkit-transition: opacity .15s linear;
        -o-transition: opacity .15s linear;
        transition: opacity .15s linear;
    }
    .fade.in {
        opacity: 0.5;
    }
    .collapse { background: none;
        display: none;
        visibility: hidden;
    }
    .collapse.in {
        display: block;
        visibility: visible;
    }
    #col1,#col-a1,#col-b1,#col-c1{
        display: none;
    }
    .nav-fix{
        position: fixed;
        top: 0;
        z-index: 9999;
        width: 100%;
        transition: all ease 0.3s;
    }
</style>

<script type="text/javascript">

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '/' +
        (day<10 ? '0' : '') + day + '/'+
        (month<10 ? '0' : '') + month;

    $("#date_start").val(output);

    var prev='amountofconversion';
    var site_url="<?=FXPP::ajax_url()?>";
    var img_url="<?=$this->template->Images()?>";
    var pblc = [];
    pblc['request']=null;
    var prvt = [];
    var conversionfactor = false;
    var interbank = 1;
    var InterbankFloor =1;




    function format(state) {
        if (!state.id) return state.text; // optgroup
        return "<img class='flag' src='"+img_url+'SFlags/'+state.id.toUpperCase()+".png' />" + state.text;
    }
    $(document).ready(function () {
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

                if(data.value==false){
                    conversionfactor=false;
                }else{
                    conversionfactor=data.value;
                }

                $("input[name=amountofconversion]").val(($("input[name=amount]").val()*conversionfactor)*interbank);

                prev='amountofconversion';
                if(isNaN($("input[name=amountofconversion]").val())){
                    $("input[name=amountofconversion]").val('');
                    prev='amountofconversion';
                }
                $('#loader-holder').hide();
            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

        });


        $("#date_start").on("focusout", function() {
            $("select[name=currencyihave]").change();
        });


        $("#date_start").datetimepicker({
            format: "YYYY/DD/MM",
            disabledDates: []
        });

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

            if(data.value==false){
                conversionfactor=false;
            }else{
                conversionfactor=data.value;
            }
            $("input[name=amount]").change();
            $('#loader-holder').hide();
        });
        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });

        $('.page-link').mouseover(function () {
            $($(this).data('target')).fadeIn("fast");


        })
        $('.page-link').mouseleave(function () {
            $($(this).data('target')).fadeOut("fast");
        });

        $(".hidden-menu").hide();
        $(".menu-button").show();

        $('.menu-button').click(function(){
            $(".hidden-menu").slideToggle();
        });


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

            if(data.value==false){
                conversionfactor=false;
            }else{
                conversionfactor=data.value;
            }

            $("input[name=amountofconversion]").val(($("input[name=amount]").val()*conversionfactor)*interbank);
            prev='amountofconversion';
            if(isNaN($("input[name=amountofconversion]").val())){
                $("input[name=amountofconversion]").val('');
                prev='amountofconversion';
            }
            $('#loader-holder').hide();
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


            if(data.value==false){
                conversionfactor=false;
            }else{
                conversionfactor=data.value;
            }

            $("input[name=amountofconversion]").val(($("input[name=amount]").val()*conversionfactor)*interbank);

            prev='amountofconversion';
            if(isNaN($("input[name=amountofconversion]").val())){
                $("input[name=amountofconversion]").val('');
                prev='amountofconversion';
            }
            $('#loader-holder').hide();
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

    });

    $("input[name=amountofconversion]").on("change paste keyup", function() {

        $("input[name=amount]").val(($("input[name=amountofconversion]").val()/conversionfactor)*interbank);
        prev='amount';
        if(isNaN($("input[name=amountofconversion]").val())){
            $("input[name=amountofconversion]").val('');
            prev='amountofconversion';
        }

    });


    $(document).ready(function(){
        $("#informer-active").focus();
    });

    $(document).ready(function(){
        $( "#col" ).click(function() {
            $("#col").hide();
            $("#col1").show();
        });
        $( "#col1" ).click(function() {
            $("#col").show();
            $("#col1").hide();
        });
        $( "#col-a" ).click(function() {
            $("#col-a").hide();
            $("#col-a1").show();
        });
        $( "#col-a1" ).click(function() {
            $("#col-a").show();
            $("#col-a1").hide();
        });
        $( "#col-b" ).click(function() {
            $("#col-b").hide();
            $("#col-b1").show();
        });
        $( "#col-b1" ).click(function() {
            $("#col-b").show();
            $("#col-b1").hide();
        });
        $( "#col-c" ).click(function() {
            $("#col-c").hide();
            $("#col-c1").show();
        });
        $( "#col-c1" ).click(function() {
            $("#col-c").show();
            $("#col-c1").hide();
        });
    })


</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#drp-cur").click(function(){
            $("#cur-list-holder").slideToggle("fast");
            $("#cur-list-holder1").hide("fast");
        });
        $("#drp-cur1").click(function(){
            $("#cur-list-holder1").slideToggle("fast");
            $("#cur-list-holder").hide("fast");
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
        });

    });











    // iframe

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
    function checkInteger(dataString){
        var xword= dataString.toLowerCase();
        var checkCar= xword.match(/#|_|a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|q|r|s|t|u|v|w|x|y|z|'|"|@|!|>|<|,|~/g);
        if(checkCar==null)
        {
            return true;
        }
        else
            false;

    }


    $(document).on("input","#majorinputwidth",function(){

        var width=$(this).val(); width= width.trim();
        if(checkInteger(width)==true)
        {if(width>380){   $(this).val(380);}}
        else{$(this).val(300);}

    });

    $(document).on("click",".btn-caret-right",function(){
        var fromoption= $("#tickers").find('option:selected').clone();
        $("#selectedtickers").append(fromoption); $("#tickers").find('option:selected').remove();

    });

    $(document).on("click",".btn-caret-left",function(){
        var fromoption= $("#selectedtickers").find('option:selected').clone();
        $("#tickers").append(fromoption);
        $("#selectedtickers").find('option:selected').remove();

    });


    $(document).on("click",".btn-caret-up",function(){
        $("#selectedtickers").find('option:selected').each(function(){
            $(this).insertBefore($(this).prev());
        });
    });
    $(document).on("click",".btn-caret-down",function(){
        $("#selectedtickers").find('option:selected').each(function(){
            $(this).insertAfter($(this).next());
        });
    });

    function setIfromaVal()
    {
        var xframe= $("#iframmajorbox").html();
        xframe=xframe.trim();
        $("#iframevalue").val(xframe);
    }


    $(document).ready(function(){
//        setIfromaVal();


    });

    $(document).on("click","#saveIframe",function()
    {
        var widthbox = document.getElementById("majorinputwidth").value;
        var hfont = document.getElementById("fontheader").value;
        var hfsize = document.getElementById("fsizeheader").value;
        var hfcol = document.getElementById("fhtextcolor").value;
        var hbg = document.getElementById("hdbgcolor").value;



        var tdfont = document.getElementById("tdlistTextFont").value;
        var tdfsize = document.getElementById("tdlisttextSize").value;
        var tdfcol = document.getElementById("tdlisttextcolor").value;


        hfcol = hfcol.replace("#", "");
        hbg = hbg.replace("#", "");
        tdfcol = tdfcol.replace("#", "");


        var allcurrency="";

        $("#selectedtickers option").each(function(){
            var curop=$(this).val();
            allcurrency=allcurrency+"_"+curop;

        });

        var furl='<?= base_url('partnership/informerMajorIframe')?>?width='+widthbox+'&tdfcol='+tdfcol+'&tdfsize='+tdfsize+'&tdfont='+tdfont+'&hfcol='+hfcol+'&hfsize='+hfsize+'&hfont='+hfont+'&hbg='+hbg+'&tickers='+allcurrency;
        $("#iframetag").attr("src",furl);
        $('#iframetag').load(document.URL + ' #iframetag');
        setIfromaVal();

    });

</script>
