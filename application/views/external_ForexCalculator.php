<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-forex-calc.css' type='text/css'  />"));
    });
</script>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title">
                  <b>  <?=lang('xnv_PIPCalc');?></b>
                </h1>
                <div class="forex-calculator-holder">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_1');?>

                        </label>
                        <?= form_dropdown('CurrencyPair', $CurrencyPair, '', 'class="form-control round-0 calc-txt"'); ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_2');?>
                        </label>
                        <?= form_dropdown('Leverage', $Leverage, '', 'class="form-control round-0 calc-txt"'); ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_3');?>
                        </label>
                        <?php $data['V'] = array(
                            'name'  => 'Volume',
                            'id'    => 'Volume',
                            'value' => '0.1',
                            'size'  => '50',
                            'class' => 'form-control round-0',
                            'max' => '100000000000',
                            'min' => '0.1',
                            'type' => 'number',
                            'step' => '0.1'
                        );  ?>
                        <?= form_input($data['V']); ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_4');?>

                        </label>
                        <?= form_dropdown('Currency', $Currency, '', 'class="form-control round-0 calc-txt"'); ?>
                    </div>
                </div>
                <div class="forex-calculator-holder secondary-forex-calculator-holder">

                    <div class="calc_l col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input first-child-calculator ext-arabic-forex-calculator-child">

                        <div class="calc-btn-holder">

                            <a href="javascript:void(0)" class="btn-calc calculate calc" id="calc">
                                <?=lang('x_fc_5');?>
                            </a>
                        </div>


                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_6');?>
                        </label>
                        <div class="forex-calculator-input-result"><span class="CurrentQuote">&zwnj;</span></div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_7');?>
                        </label>
                        <div class="forex-calculator-input-result"><span class="Valueof1PIP">&zwnj;</span></div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 forex-calculator-child-input ext-arabic-forex-calculator-child">
                        <label>
                            <?=lang('x_fc_8');?>:
                        </label>
                        <div class="forex-calculator-input-result"><span class="sMargin">&zwnj;</span></div>
                    </div>
                </div>

                <div class="content-calculator-holder bgt ext-arabic-content-calculator-holder">
                    <h1>
                        <?=lang('x_fc_9');?>:
                    </h1>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 content-calculator-child ext-arabic-content-calculator-child">
                        <label>
                            <?=lang('x_fc_10');?>
                        </label>
                        <div class="content-calculator-example dtop computations"  style="display:none;">
                            <p>
                                <?=lang('x_fc_11');?>
                                <strong><span class="volume"></span></strong>
                                <?=lang('x_fc_12');?>
                                <strong><span class="cur12"></span></strong>
                                  <?=lang('x_fc_13');?>
                                <strong><span class="cur3"></span></strong>
                                <br/>
                                  <?=lang('x_fc_14');?>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur12"></span>)</strong> = <strong><span class="CF12"></span></strong>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur23"></span>)</strong> = <strong><span class="CF23"></span></strong>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur13"></span>)</strong> = <strong><span class="CF13"></span></strong>
                                <br/><strong>
                                      <?=lang('x_fc_6');?>
                                </strong> = <strong class="result"><span class="CF12"></span> <span class="cur12"></span></strong>
                                <br/>
                                  <?=lang('x_fc_23');?>
                                <br/>
                                  <?=lang('x_fc_2');?> =
                                <strong><span class="leverage"></span></strong>
                                <br/><strong>
                                      <?=lang('x_fc_7');?>
                                </strong> = <span class="volume"></span>* 0.0001 * <span class="cur23"></span> * 100,000 <span class="RURJYPUSD1"></span>
                                <br/><strong>
                                      <?=lang('x_fc_7');?>
                                </strong> = <span class="volume"></span> * 0.0001 * <span class="CF23"></span> * 100,000 <span class="RURJYPUSD1"></span> = <span class="ValueofPIP"></span>
                                <br/>
                                  <?=lang('x_fc_22');?>
                                <strong class="result"><span class="ValueofPIP"></span> <span class="cur3"></span></strong>
                            </p>

                        </div>


                        <div class="content-calculator-example dtop SpotMetals"  style="display:none;">
                            <p>
                                  <?=lang('x_fc_11');?>
                                <strong><span class="volume"></span></strong>
                                <?=lang('x_fc_12');?>
                                <strong><span class="cur12"></span></strong>
                                  <?=lang('x_fc_13');?>
                                <strong><span class="cur3"></span></strong>
                                <br/>
                                  <?=lang('x_fc_14');?>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur12"></span>)</strong> = <strong><span class="CF12"></span></strong>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur23"></span>)</strong> = <strong><span class="CF23"></span></strong>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur13"></span>)</strong> = <strong><span class="CF13"></span></strong>
                                <br/><strong>
                                      <?=lang('x_fc_6');?>
                                </strong> = <strong class="result"><span class="CF12"></span> <span class="cur12"></span></strong>
                                <br/>
                                  <?=lang('x_fc_23');?>
                                <br/>
                                  <?=lang('x_fc_2');?> =
                                <strong><span class="leverage"></span></strong>
                                <br/><strong>
                                      <?=lang('x_fc_7');?>
                                </strong> = <span class="volume"></span> * 0.0001 * <span class="cur23"></span> * 100,000 * rate
                                <br/><strong>
                                      <?=lang('x_fc_7');?>
                                </strong> = <span class="volume"></span> * 0.0001 * <span class="CF23"></span> * 100,000 = <span class="ValueofPIP"></span> * <span class="spotrate"></span>
                                <br/>
                                  <?=lang('x_fc_22');?>
                                <strong  class="result"><span class="ValueofPIP"></span> <span class="cur3"></span></strong>
                            </p>
                        </div>


                        <div class="content-calculator-example dtop CFD" style="display:none;">
                            <p>
                                  <?=lang('x_fc_11');?>
                                <strong><span class="volume"></span></strong>
                                <?=lang('x_fc_12');?>
                                <strong><span class="cur1"></span>/<span class="cur2"></span></strong>
                                  <?=lang('x_fc_13');?>
                                <strong><span class="cur3"></span></strong>
                                <br/>
                                  <?=lang('x_fc_14');?>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur1"></span>/<span class="cur2"></span>)</strong> = <strong><span class="CF12"></span></strong>
                                <br/>
                                  <?=lang('x_fc_15');?>
                                <strong>(<span class="cur2"></span>/<span class="cur3"></span>)</strong> = <strong><span class="CF23"></span></strong>

                                <br/><strong>
                                      <?=lang('x_fc_6');?>
                                </strong> = <strong class="result"><span class="CF12"></span> <span class="cur12"></span></strong>
                                <br/>
                                  <?=lang('x_fc_23');?>
                                <br/>
                                  <?=lang('x_fc_2');?> =
                                <strong><span class="leverage"></span></strong>
                                <br/><strong>
                                      <?=lang('x_fc_7');?>
                                </strong>
                                = 0.0001 * 100,000 * <?=lang('x_fc_3');?> *   <?=lang('x_fc_15');?> (
                                <span class="cur2"></span>/<span class="cur3"></span>)
                                <br/><strong>
                                      <?=lang('x_fc_7');?>
                                </strong> = 0.0001 * 100,000 *  <span class="volume"></span> ( <span class="CF23"></span> )=  <span class="ValueofPIP"></span>
                                <br/>
                                  <?=lang('x_fc_22');?>
                                <strong  class="result"><span class="ValueofPIP"></span></strong>

                            </p>

                        </div>
                    </div>

                    <div class="hidden-calculator-divider"></div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 content-calculator-child ext-arabic-content-calculator-child">
                        <label>
                              <?=lang('x_fc_16');?>
                        </label>
                        <div class="content-calculator-example computations" style="display:none;">
                            <p>
                                <strong>
                                      <?=lang('x_fc_17');?>
                                </strong>
                                = (volume* (<?=lang('x_fc_27');?>/volume) )/  <?=lang('x_fc_2');?>  *   <?=lang('x_fc_15');?> (<?=lang('x_fc_24');?>/<?=lang('x_fc_25');?>)
                                <br/>
                                  <?=lang('x_fc_17');?> =
                                (<span class="volume"></span>*100,000)/<span class="leverage"></span> * <span class="CF13"></span> <span class="cur13"></span> = <span class="Margin"></span>
                                <br/>
                                  <?=lang('x_fc_18');?>
                                <strong  class="result"> <span class="Margin"></span> <span class="cur3"></span></strong>
                            </p>
                        </div>
                        <div class="content-calculator-example SpotMetals" style="display:none;">
                            <p>
                                <strong>
                                      <?=lang('x_fc_17');?>
                                </strong>
                                = <?=lang('x_fc_27');?> X current price * rate
                                <br/>
                                  <?=lang('x_fc_17');?> =  (volume* (L<?=lang('x_fc_27');?>/volume))*   <?=lang('x_fc_15');?> (<?=lang('x_fc_24');?>/<?=lang('x_fc_25');?>)  * rate
                                <br/>
                                  <?=lang('x_fc_17');?> =  (0.0001 *
                                <span class="volume"></span>*100,000) * <span class="CF13"></span> <span class="cur13"></span> * <span class="spotrate"></span> = <span class="Margin"></span>
                                <br/>
                                  <?=lang('x_fc_18');?>
                                <strong class="result"><span class="Margin"></span> <span class="cur3"></span></strong>
                            </p>
                        </div>
                        <div class="content-calculator-example CFD"  style="display:none;">
                            <p>
                                <strong>
                                      <?=lang('x_fc_17');?>
                                </strong>
                                = (10% PIP) * ((volume* (<?=lang('x_fc_27');?>/volume) )/  <?=lang('x_fc_2');?>)  *   <?=lang('x_fc_15');?> (<?=lang('x_fc_24');?>/<?=lang('x_fc_25');?>)
                                <br/>
                                  <?=lang('x_fc_17');?> = (0.10 *
                                <span class="ValueofPIP"></span> ) * ( <span class="volume"></span> * 100000  )/ <span class="leverage"></span> *  <span class="CF12"></span>
                                <br/>
                                  <?=lang('x_fc_18');?>
                                <strong class="result"> <span class="Margin"></span></strong>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="content-calculator-holder ext-arabic-content-calculator-holder">
                    <h1>
                          <?=lang('x_fc_19');?>
                    </h1>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 content-calculator-child ext-arabic-content-calculator-child">
                        <label>
                              <?=lang('x_fc_20');?>
                        </label>
                        <div class="content-calculator-information"><p>
                                  <?=lang('x_fc_21');?> = 1 pip *   <?=lang('x_fc_15');?> (<?=lang('x_fc_26');?>/ <?=lang('x_fc_25');?>) * <?=lang('x_fc_27');?>
                            </p></div>
                        <div class="content-calculator-example">
                            <span>
                                  <?=lang('x_fc_19');?>:
                            </span>
                            <p>
                            <p>
                                  <?=lang('x_fc_11');?> 1 lot of EUR/USD   <?=lang('x_fc_13');?> GBP
                                <br/>
                                  <?=lang('x_fc_14');?>
                                <br/>
                                  <?=lang('x_fc_15');?> (USD/GBP) = 0.6548
                                <br/>
                                  <?=lang('x_fc_23');?>
                                <br/>
                                  <?=lang('x_fc_21');?> = 0.0001 * 0.6548 * 100000 = 6.548
                                <br/>
                                <?=lang('x_fc_22');?> &#163;6.55
                            </p>
                        </div>
                    </div>
                    <div class="hidden-calculator-divider"></div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 content-calculator-child ext-arabic-content-calculator-child">
                        <label>
                              <?=lang('x_fc_16');?>
                        </label>
                        <div class="content-calculator-information"><p>
                                  <?=lang('x_fc_17');?> = <?=lang('x_fc_27');?>/  <?=lang('x_fc_2');?> *   <?=lang('x_fc_15');?> (<?=lang('x_fc_24');?> / <?=lang('x_fc_25');?>)
                            </p></div>
                        <div class="content-calculator-example">
                            <span>
                                  <?=lang('x_fc_19');?>:
                            </span>
                            <p>
                            <p>
                                  <?=lang('x_fc_11');?> 1 <?=lang('x_fc_12')?> EUR/USD <?=lang('x_fc_28')?>  <span id="leve_ru"><?=lang('x_fc_2');?></span> <?=lang('x_fc_13');?>  GBP.
                                <br/>
                                  <?=lang('x_fc_23');?>
                                <br/>
                                  <?=lang('x_fc_15');?> (EUR/GBP) = 0.7369
                                <br/>
                                  <?=lang('x_fc_2');?> = 200
                                <br/>
                                  <?=lang('x_fc_17');?> = 100000 / 200 * 0.7369 = 368.45
                                <br/>
                                  <?=lang('x_fc_18');?>  &#163;368.45
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var site_url="<?=FXPP::ajax_url(); ?>";
    var img_url="<?=$this->template->Images()?>";

    var pblc = [];
    pblc['request'] = null;
    var prvt = [];
    var conversionfactor = false;
    var SpotMetals = ["XAGUSD", "XAUUSD", "XXAU/USD" ];
    var spotrate;
    var cur1;
    var cur3;
    var Leverage;
    var Volume;

    $().ready(function(){
        $('select[name=CurrencyPair]').select2({
            matcher: function(term, text, option) {
                return text.toUpperCase().indexOf(term.toUpperCase())>=0 || option.val().toUpperCase().indexOf(term.toUpperCase())>=0;
            }
        });
        $('select[name=Leverage]').select2({});
        $('select[name=Currency]').select2({});

        $("select[name=CurrencyPair]").change(function() {

            $('select[name=Leverage]').prop("disabled", false);
            $('select[name=Leverage]').val('1:1');
            $('select[name=Leverage]').select2();


            var CFD = ['#AA','#AAL','#AAPL','#AIG','#AMZN','#AXP','#BA','#BABA','#BAC','#BARC','#BLT','#BP','#BTA','#C','#CAT','#CSCO','#CVX','#DD','#DIS','#EBAY', '#FB', '#GEN', '#GOOG', '#GS', '#GSK', '#HD', '#HPQ', '#HSBA', '#IBM', '#INTC', '#JNJ', '#JPM', '#KO', '#LLOY', '#LNKD', '#MCD', '#MMM', '#MRK', '#MSFT','#ORCL','#PFE','#PG','#T','#TRV','#TSCO','#TWTR','#UTX','#VOD','#VZ','#WFC','#WMT','#XOM','#YHOO'];

            var RUR = ['USDRUB','USDRUR'];

            if($.inArray(this.value,RUR) == -1){

            }else{
                $('select[name=Leverage]').select2('destroy');
                $('select[name=Leverage]').val('1:50');
                $('select[name=Leverage]').prop("disabled", true);
                $('select[name=Leverage]').select2();
            }

            if($.inArray(this.value,SpotMetals) == -1){

            }else{
                $('select[name=Leverage]').select2('destroy');
                $('select[name=Leverage]').val('1:100');
                $('select[name=Leverage]').prop("disabled", true);
                $('select[name=Leverage]').select2();
            }

            if($.inArray(this.value,CFD) == -1){

            }else{

                $('select[name=Leverage]').select2('destroy');
                $('select[name=Leverage]').val('1:20');
                $('select[name=Leverage]').prop("disabled", true);
                $('select[name=Leverage]').select2();
            }

        });


    });

    $(document).on("click", ".calculate", function () {
        $('#loader-holder').show();

        var split = $('select[name=CurrencyPair] option:selected').text().split('/');
        var CurrencySelected = $('select[name=Currency] option:selected').val();
        var newstring = $('select[name=CurrencyPair] option:selected').val();
        var parts = newstring.match(/[\s\S]{1,3}/g) || [];
        var Leverage = $('select[name=Leverage] option:selected').val().split(':');
        var Volume = $('input[name=Volume]').val();
        var splitname = $('select[name=CurrencyPair] option:selected').html().split('/');

        if(newstring.indexOf('#') != -1){
            parts[0]=split[0];
        }
        if(newstring.indexOf('/') != -1){
            parts[0]=split[0];
            parts[1]=split[1];
        }

        prvt["data"] = {
            cur1: parts[0],
            cur2: parts[1],
            cur3: CurrencySelected,
            cur1name: splitname[0],
            cur2name: splitname[1],

            leverage: Leverage[1],
            volume: Volume
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url + 'pages/API_CurrencyPairSpotCFD',
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {

            if (data.isCFD){
                //cfd
                $('div[name=legends]').css('display','block');
                $('.SpotMetals').css('display','none');
                $('.computations').css('display','none');
                $('.CFD').css('display','block');

                $('.CurrentQuote').html(data.CurrentQuote);
                $('.Valueof1PIP').html(data.PIPValue);
                $('.sMargin').html(data.Margin);

                $('.cur1').html(cur1=parts[0]);
                $('.cur2').html('USD');
                $('.cur3').html(cur3=CurrencySelected);

                $('.CF12').html(data.CurrentQuote);
                $('.CF23').html(data.CF23);

                $('.leverage').html(Leverage[1]);
                $('.ValueofPIP').html(data.PIPValue);
                $('.volume').html(Volume);
                $('.Margin').html(data.Margin);
            }else{

                var spots = $('select[name=CurrencyPair] option:selected').val();
                conversionfactor = data.value;

                $('.CurrentQuote').html(data.CurrentQuote);
                $('.Valueof1PIP').html(data.PIPValue);
                $('.sMargin').html(data.Margin);
                $('.Margin').html(data.Margin);

                $('.cur23').html(parts[1] +'/'+ CurrencySelected); // 23
                $('.cur12').html(parts[0] +'/'+ parts[1]); // 12
                $('.cur2').html(parts[0] +'/'+ parts[1]); // 12
                $('.cur13').html(parts[0]+'/'+ CurrencySelected); // 13
                $('.cur3').html(CurrencySelected); //3

                $('span[name=CQ]').html(data.CurrentQuote);
                $('span[name=CF23]').html(data.CF23);

                $('.volume').html(Volume);
                $('.ValueofPIP').html(data.PIPValue);
                $('.CF12').html(data.CF12);
                $('.CF23').html(data.CF23);
                $('.CF13').html(data.CF13);
                $('span[class=leverage]').html(Leverage[1]);
                $('span[name=MarginC]').html(data.Margin);

                if($.inArray(spots,SpotMetals) == -1){
                    // currency pair
                    if(splitname[1]=='RUR' || splitname[1]=='RUB'){
                        $('.RURJYPUSD1').html('* 10 ');
                    }else if( parts[0]=="USD" && parts[1]=="JPY" ){
                        $('.RURJYPUSD1').html('* 100 ');
                    }else{
                        $('.RURJYPUSD1').html('');
                    }
                    $('div[name=legends]').css('display','block');
                    $('.computations').css('display','block');
                    $('.SpotMetals').css('display','none');
                    $('.CFD').css('display','none');

                }else{
                    //spotmetals
                    if(spots=='XXAU/USD'){
                        spotrate= '5';
                    }else if(spots=='XAGUSD'){
                        spotrate= '1/2';
                    }else{
                        spotrate= '1';
                    }
                    $('.spotrate').html(spotrate);
                    $('div[name=legends]').css('display','block');
                    $('.SpotMetals').css('display','block');
                    $('.computations').css('display','none');
                    $('.CFD').css('display','none');
                }
            }
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });
    });

</script>