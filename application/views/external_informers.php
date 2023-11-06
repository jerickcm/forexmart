<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

<?php if(IPLoc::Office()){?>
    <style>
        .width-text {
            width: 120px!important;
        }
        .license-sub{
            margin-top: 0px;
        }
        .quotes {
            margin-top: 0px;
        }
        .quotes-holder {
            padding-bottom: 0px;
            margin-top: -10px;
        }
        /*@media screen and (min-width: 1200px;){*/
            /*.mg-l{*/
                /*margin-left: 40px;*/
            /*}*/
        /*}*/
    </style>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#informer-active").focus();
    });
</script>


<script type="text/javascript">
    //     $(document).ready(function(){
    //         $("#t2").click(function(){
    //             $("#t1").removeClass("ins-active");
    //         });
    //         $("#t3").click(function(){
    //             $("#t1").removeClass("ins-active");
    //         });
    //         $("#t3").click(function(){
    //             $("#t1").removeClass("ins-active");
    //         });
    //     });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#col").click(function () {
            $("#col").hide();
            $("#col1").show();
        });
        $("#col1").click(function () {
            $("#col").show();
            $("#col1").hide();
        });
        $("#col-a").click(function () {
            $("#col-a").hide();
            $("#col-a1").show();
        });
        $("#col-a1").click(function () {
            $("#col-a").show();
            $("#col-a1").hide();
        });
        $("#col-b").click(function () {
            $("#col-b").hide();
            $("#col-b1").show();
        });
        $("#col-b1").click(function () {
            $("#col-b").show();
            $("#col-b1").hide();
        });
        $("#col-c").click(function () {
            $("#col-c").hide();
            $("#col-c1").show();
        });
        $("#col-c1").click(function () {
            $("#col-c").show();
            $("#col-c1").hide();
        });
    })


</script>

<style>
    #collapse2{
        padding-bottom: 15px;
    }
    #col1, #col-a1, #col-b1, #col-c1 {
        display: none;
    }

    .nav-fix {
        position: fixed;
        top: 0;
        z-index: 9999;
        width: 100%;
        transition: all ease 0.3s;
    }
    @media only screen and (max-width: 767px){
        .new-division-informer .informer-tabs {
            width: calc(100% /3)!important;
        }


    }
    @media only screen and (max-width: 556px){
        .new-division-informer .informer-tabs {
            width: calc(100%/2)!important;
        }
    }
    @media only screen and (max-width: 556px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 16px!important;
        }
    }
    @media only screen and (max-width: 767px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 14px!important;
        }
    }
    @media only screen and (max-width: 991px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 11px!important;
        }
    }
    @media only screen and (max-width: 1199px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 14px!important;
        }
    }
    @media only screen and (max-width: 320px){
        .col-xs-2{
            margin-left: -9px;
        }
    }
</style>
<script type="text/javascript">
$(document).ready(function () {


    $("#drp-cur").click(function () {
        $("#cur-list-holder").slideToggle("fast");
        $("#cur-list-holder1").hide("fast");
    });
    $("#drp-cur1").click(function () {
        $("#cur-list-holder1").slideToggle("fast");
        $("#cur-list-holder").hide("fast");
    });
});
//currency i have
$(document).ready(function () {
    $('#curlist li').click(function () {
        $('#cur-val').text($(this).text());
        var flag = $(this).find('i');
        // alert(flag.attr('class'));
        $('#cur-flag').removeClass($('#cur-flag').attr('class')).addClass(flag.attr('class'));
        $('#cur-list-holder').hide('fast');

        var contry_code = $(this).attr('rel');
        $("#from_county_code").val(contry_code);
        // convert courrency function call
        convertCurrency();
    });
});
//currency i want
$(document).ready(function () {
    $('#curlist1 li').click(function () {
        $('#cur-val1').text($(this).text());

        var flag = $(this).find('i');
        // alert(flag.attr('class'));
        $('#cur-flag1').removeClass($('#cur-flag1').attr('class')).addClass(flag.attr('class'));
        $('#cur-list-holder1').hide('fast');
        var contry_code = $(this).attr('rel');
        $("#to_county_code").val(contry_code);

        // convert courrency function call
        convertCurrency();
    });
});


$(document).on("change", "#interbank", function () {
    convertCurrency();
});

$(document).on("click", ".btn-switch", function () {


    var fromcode = $("#from_county_code").val();
    var tocodce = $("#to_county_code").val();

    var Old_from_class = $("#cur-flag").attr('class');
    var Old_to_class = $("#cur-flag1").attr('class');
    var old_from_name = $("#cur-val").html();
    var old_to_name = $("#cur-val1").html();


    $("#cur-flag").attr('class', Old_to_class);
    $("#cur-flag1").attr('class', Old_from_class);
    $("#cur-val").html(old_to_name);
    $("#cur-val1").html(old_from_name);
    $("#from_county_code").val(tocodce);
    $("#to_county_code").val(fromcode);

    convertCurrency();
});
$(document).on("keydown", ".cur-amount", function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 32, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A,Ctrl+C,Ctrl+V, Command+A
        ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }

});


function convertCurrency() {
    $('#loader-holder').show();
    var url = "<?=base_url()?>";

    var fromcode = $("#from_county_code").val();
    var tocodce = $("#to_county_code").val();
    var date_start = $("#date_start").val();
    $.post(url + "Currency_conversion/apiquotes2", {from: fromcode, to: tocodce, date: date_start}, function (view) {


        var data = JSON.parse(view);
        // console.log(obj);

        var intramount = $('#interbank').val();
        var rawamount = $("#rawAmount").val();
        var conversionfactor = data.value;
        var netamount = parseFloat(rawamount) * parseFloat(conversionfactor);
        intramount = parseInt(intramount);
        var percen = (netamount * intramount) / 100;
        var calculateAmount = netamount - percen;

        var finalAmount = (intramount == 0) ? netamount : calculateAmount;
        $("#amountofconversion").val(finalAmount);
        $('#loader-holder').hide();

    });


}


$(document).ready(function () {
    /* $("#date_start").datetimepicker({
     format: "YYYY/DD/MM",
     disabledDates: [],

     });*/


});
$(document).on('dp.change', '#date_start', function () {
    convertCurrency();
});


// iframe

function checkInteger(dataString) {
    var xword = dataString.toLowerCase();
    var checkCar = xword.match(/#|_|a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|q|r|s|t|u|v|w|x|y|z|'|"|@|!|>|<|,|~/g);
    if (checkCar == null) {
        return true;
    }
    else
        false;

}


$(document).on("input", "#majorinputwidth, #newsWidth", function () {

    var width = $(this).val();
    width = width.trim();
    if (checkInteger(width) == true) {
        if (width > 380) {
            $(this).val(380);
        }
    }
    else {
        $(this).val(300);
    }

});

$(document).on("click", ".btn-caret-right", function () {
    var fromoption = $("#tickers").find('option:selected').clone();
    $("#selectedtickers").append(fromoption);
    $("#tickers").find('option:selected').remove();

});

$(document).on("click", ".btn-caret-left", function () {
    var fromoption = $("#selectedtickers").find('option:selected').clone();
    $("#tickers").append(fromoption);
    $("#selectedtickers").find('option:selected').remove();

});


$(document).on("click", ".btn-caret-up", function () {
    $("#selectedtickers").find('option:selected').each(function () {
        $(this).insertBefore($(this).prev());
    });
});
$(document).on("click", ".btn-caret-down", function () {
    $("#selectedtickers").find('option:selected').each(function () {
        $(this).insertAfter($(this).next());
    });
});


function setIfromaVal() {
    var xframe = $("#iframmajorbox").html();
    xframe = xframe.trim();
    $("#iframevalue").val(xframe);
}
function loadCalculator(widthbox, heightbox) {
    $("#iframeCalculatorBox").css("width", widthbox + "px");
    $("#iframeCalculatorBox").css("height", heightbox + "px");
    var xframe = $("#calculatorbox").html();
    xframe = xframe.trim();
    $("#calculatoriframebox").val(xframe);


}


$(document).ready(function () {
    setIfromaVal();// major info
    loadCalculator('450') // calculator
    loadCurrency('350', '680');
});

$(document).on("click", "#saveIframe", function () {
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


    var allcurrency = "";

    $("#selectedtickers option").each(function () {
        var curop = $(this).val();
        if (allcurrency == '') {
            allcurrency = curop;
        } else {
            allcurrency = allcurrency + "~" + curop;
        }
    });



    var furl = '<?= FXPP::ajax_url('partnership/informerMajorIframe/1');?>';
    var url = '<?=FXPP::ajax_url('partnership/iframValues')?>';
    var session_id = '<?=session_id();?>';
    var value = 'width=' + widthbox + '&tdfcol=' + tdfcol + '&tdfsize=' + tdfsize + '&tdfont=' + tdfont + '&hfcol=' + hfcol + '&hfsize=' + hfsize + '&hfont=' + hfont + '&hbg=' + hbg + '&tickers=' + allcurrency ;
    $(".loader-holder").show();
    $.post(url,{session_id:session_id,value:value,type:1},function(data){

        furl = furl.trim()+"/"+ data.trim();
        $("#iframetag").attr("src", furl.trim());
        $("#iframeInformerTag").attr("style", "border: none; width: "+widthbox+"px; height: 669px;");


        $("#iframevalue").val($("#iframmajorbox").html().trim());
        //$('#iframeInformerTag').load(document.URL + ' #iframeInformerTag');
        $(".loader-holder").hide();
    })

});

$(document).on("blur","#i-newsWidth",function(){
    var widthbox = document.getElementById("i-newsWidth").value;

    if(widthbox <400){
        $("#i-newsWidth").val(400);
    }
    if(widthbox >450){
        $("#i-newsWidth").val(450);
    }

})

$(document).on("click", "#btnApplyInformer", function () {

    // i-newsWidth i-newsHeaderBG i-newsBodyBG i-newsFooterBG i-newsHeaderFont i-newsHeaderSize i-newsHeaderAlign i-newHeaderColor


    var widthbox = document.getElementById("i-newsWidth").value;

    if(widthbox <400){
        $("#i-newsWidth").val(400);
    }
    if(widthbox >450){
        $("#i-newsWidth").val(450);
    }



    var hbg = document.getElementById("i-newsHeaderBG").value;
    var bbg = document.getElementById("i-newsBodyBG").value;
    var fbg = document.getElementById("i-newsFooterBG").value;
    var hfont = document.getElementById("i-newsHeaderFont").value;


    var fs = document.getElementById("i-newsHeaderSize").value;
    var fa = document.getElementById("i-newsHeaderAlign").value;
    var fc = document.getElementById("i-newHeaderColor").value;


    bbg = bbg.replace("#", "");
    hbg = hbg.replace("#", "");
    fbg = fbg.replace("#", "");
    fc = fc.replace("#", "");

    console.log(widthbox);

<!--    var furl = '--><?//= base_url('partnership/informer_info_Iframe')?><!--?width=' + widthbox + '&hbg=' + hbg + '&bbg=' + bbg + '&fbg=' + fbg + '&fs=' + fs + '&fa=' + fa + '&fc=' + fc+ '&hfont='+hfont ;-->
<!--    $("#iframeInformerTag").attr("src", furl);-->
<!--    $("#iframeInformerTag").attr("style", "border: none; width: "+widthbox+"px; height: 669px;");-->
<!---->
<!--    $('#iframeInformerTag').load(document.URL + ' #iframeInformerTag');-->
<!--    $("#informer-ifrm").val($("#iframeInformer").html().trim());-->


    var furl = '<?= FXPP::ajax_url('partnership/informer_info_Iframe/6');?>';
    var url = '<?=FXPP::ajax_url('partnership/iframValues')?>';
    var session_id = '<?=session_id();?>';
    var value = 'width=' + widthbox + '&hbg=' + hbg + '&bbg=' + bbg + '&fbg=' + fbg + '&fs=' + fs + '&fa=' + fa + '&fc=' + fc+ '&hfont='+hfont ;
    $(".loader-holder").show();
    $.post(url,{session_id:session_id,value:value,type:6},function(data){

        furl = furl.trim()+"/"+ data.trim();
        $("#iframeInformerTag").attr("src", furl.trim());
        $("#iframeInformerTag").attr("style", "border: none; width: "+widthbox+"px; height: 669px;");


        $("#informer-ifrm").val($("#iframeInformer").html().trim());
        //$('#iframeInformerTag').load(document.URL + ' #iframeInformerTag');
        $(".loader-holder").hide();
    })


});

$(document).on("click", "#btnApplyNews", function () {

    // i-newsWidth i-newsHeaderBG i-newsBodyBG i-newsFooterBG i-newsHeaderFont i-newsHeaderSize i-newsHeaderAlign i-newHeaderColor

    /*newsWidth newsHeight newsNumArticles newsHeaderBG
    newsBodyBG newsFooterBG newsHeaderFont newsHeaderSize newsHeaderAlign
    newHeaderColor newsDateFont newsDateSize newsDateColor
    newsTextFont newsTextColor
    newsFooterFont  newsFooterColor*/
$("#loader-holder").show();

    var widthbox = document.getElementById("newsWidth").value;
    var newsHeight = document.getElementById("newsHeight").value;

    if(widthbox <=300){
        $("#newsWidth").val(300);
    }
    if(widthbox >=350){
        $("#newsWidth").val(350);
    }

    if(newsHeight<=580){
        $("#newsHeight").val(580);
    }

    if(newsHeight>=900){
        $("#newsHeight").val(900);
    }


    var newsWidth = document.getElementById("newsWidth").value;

    var newsNumArticles = document.getElementById("newsNumArticles").value;
    var newsHeaderBG = document.getElementById("newsHeaderBG").value.replace("#", "");
    var newsBodyBG = document.getElementById("newsBodyBG").value.replace("#", "");
    var newsFooterBG = document.getElementById("newsFooterBG").value.replace("#", "");
    var newsHeaderFont = document.getElementById("newsHeaderFont").value;
    var newsHeaderSize = document.getElementById("newsHeaderSize").value;
    var newsHeaderAlign = document.getElementById("newsHeaderAlign").value;
    var newHeaderColor = document.getElementById("newHeaderColor").value.replace("#", "");
    var newsDateFont = document.getElementById("newsDateFont").value;
    var newsDateSize = document.getElementById("newsDateSize").value;
    var newsDateColor = document.getElementById("newsDateColor").value.replace("#", "");
    var newsTextFont = document.getElementById("newsTextFont").value;

    var newsTextColor = document.getElementById("newsTextColor").value.replace("#", "");
    var newsFooterFont = document.getElementById("newsFooterFont").value;
    var newsFooterColor = document.getElementById("newsFooterColor").value.replace("#", "");


    var furl = "<?= base_url('partnership/informerNewsIframe/5');?>";
    var url = '<?=FXPP::ajax_url('partnership/iframValues')?>';
    var session_id = '<?=session_id();?>';
    var value = "width="+newsWidth+"&height="+newsHeight+"&numarticles="+newsNumArticles+"&bgheader="+newsHeaderBG+"&bgbody="+newsBodyBG+"&bgfooter="+newsFooterBG+"&headerfont="+newsHeaderFont+"&size="+newsHeaderSize+"&headeralign="+newsHeaderAlign+"&headercolor="+newHeaderColor+"&datefont="+newsDateFont+"&datesize="+newsDateSize+"&datecolor="+newsDateColor+"&textfont="+newsTextFont+"&textcolor="+newsTextColor+"&footercolor="+newsFooterColor+"&footerfont="+newsFooterFont;
    $(".loader-holder").show();
    $.post(url,{session_id:session_id,value:value,type:5},function(data){

        furl = furl.trim()+"/"+ data.trim();
        $("#iframeNewsTag_news").attr("src", furl);
        // $("#iframeNewsTag").attr("style", "border: none; width: "+newsWidth+"px; height: "+newsHeight+"px;");

        $("#iframeNewsTag_textarea").val($("#iframeNews").html().trim());

        $(".loader-holder").hide();
    })



});


// calculator;
$(document).on("click", "#savecalculIframe", function () {
    var nheight = document.getElementById("nheight").value;
    var widthbox = document.getElementById("nwidht").value;
    var nborder = document.getElementById("nborder").value;
    var nborty = document.getElementById("nborty").value;
    var nborcol = document.getElementById("nborcol").value;

    var nround_1 = document.getElementById("nround_1").value;
    var nround_2 = document.getElementById("nround_2").value;
    var nround_3 = document.getElementById("nround_3").value;
    var nround_4 = document.getElementById("nround_4").value;
    var nround = nround_1 + " " + nround_2 + " " + nround_3 + " " + nround_4;

    var nshado_1 = document.getElementById("nshado_1").value;
    var nshado_2 = document.getElementById("nshado_2").value;
    var nshado_3 = document.getElementById("nshado_3").value;
    var nshado = nshado_1 + " " + nshado_2 + " " + nshado_3;

    var nshadocol = document.getElementById("nshadocol").value;
    var nbgone = document.getElementById("nbgone").value;
    var nbgtwo = document.getElementById("nbgtwo").value;
    var nfont = document.getElementById("nfont").value;
    var nfontcolor = document.getElementById("nfontcolor").value;


    var hfont = document.getElementById("hfont").value;
    var hfontsize = document.getElementById("hfontsize").value;
    var hfontcolor = document.getElementById("hfontcolor").value;
    var hbg = document.getElementById("hbg").value;


    nborcol = nborcol.replace("#", "");
    nshadocol = nshadocol.replace("#", "");
    nfontcolor = nfontcolor.replace("#", "");
    hfontcolor = hfontcolor.replace("#", "");

    hbg = hbg.replace("#", "");
    nbgone = nbgone.replace("#", "");
    nbgtwo = nbgtwo.replace("#", "");

    widthbox = widthbox.trim();
    widthbox = parseInt(widthbox);

    if (widthbox >= 245 && widthbox <= 600) {


        var furl = "<?= base_url('partnership/informerCalculatorIframe/4');?>";
        var url = '<?=FXPP::ajax_url('partnership/iframValues')?>';
        var session_id = '<?=session_id();?>';
        var value = 'width=' + widthbox + '&nborder=' + nborder + '&nborty=' + nborty + '&nborcol=' + nborcol + '&nround=' + nround + '&nshado=' + nshado + '&nshadocol=' + nshadocol + '&nbgone=' + nbgone + '&nbgtwo=' + nbgtwo + '&nfont=' + nfont + '&nfontcolor=' + nfontcolor + '&hfont=' + hfont + '&hfontsize=' + hfontsize + '&hfontcolor=' + hfontcolor + '&hbg=' + hbg;
        $(".loader-holder").show();
        $.post(url,{session_id:session_id,value:value,type:4},function(data){

            furl = furl.trim()+"/"+ data.trim();
            $("#iframeCalculatorBox").attr("src", furl);
           // $('#iframeCalculatorBox').load(document.URL + ' #iframeCalculatorBox');

            loadCalculator(widthbox, nheight);

            $(".loader-holder").hide();
        })



        loadCalculator(widthbox, nheight);


    }
    else {
        alert("Only allow width: 245 to 600 ");
        return false;

    }

});

$(document).on("input", "#nwidht", function () {

    var width = $(this).val();
    width = width.trim();


    if (checkInteger(width) == true) {
        if (width > 600) {
            $(this).val('600');
        }

    } else {

        $(this).val('450');
    }

});


// curreny convert start


// calculator;
$(document).on("click", "#savecurrencyIframe", function () {
    var curenWidht = document.getElementById("curenWidht").value;
    var curenHeight = document.getElementById("curenHeight").value;
    var curenFont = document.getElementById("curenFont").value;
    var curenfontSize = document.getElementById("curenfontSize").value;
    var curenbgcolor = document.getElementById("curenbgcolor").value;

    var curenfontColor = document.getElementById("curenfontColor").value;
    var curenHdFont = document.getElementById("curenHdFont").value;
    var curenHdfontSize = document.getElementById("curenHdfontSize").value;
    var curenHdbgColor = document.getElementById("curenHdbgColor").value;
    var curenHdfontColor = document.getElementById("curenHdfontColor").value;

    var arrowkey = "fa-caret-left_fa-caret-right_77";
    $("#collapse3 .arrowkey").each(function () {

        if ($(this).is(':checked')) {
            arrowkey = $(this).val();
        }
    });


    curenbgcolor = curenbgcolor.replace("#", "");
    curenfontColor = curenfontColor.replace("#", "");
    curenHdbgColor = curenHdbgColor.replace("#", "");
    curenHdfontColor = curenHdfontColor.replace("#", "");


    curenWidht = curenWidht.trim();
    curenWidht = parseInt(curenWidht);

    curenHeight = curenHeight.trim();
    curenHeight = parseInt(curenHeight);


    if (curenWidht >= 380 && curenWidht <= 600) {



        var furl = "<?= base_url('partnership/informerCurrencyIframe/3');?>";
        var url = '<?=FXPP::ajax_url('partnership/iframValues')?>';
        var session_id = '<?=session_id();?>';
        var value = 'arrowkey=' + arrowkey + '&curenWidht=' + curenWidht + '&curenHeight=' + curenHeight + '&curenFont=' + curenFont + '&curenfontSize=' + curenfontSize + '&curenbgcolor=' + curenbgcolor + '&curenfontColor=' + curenfontColor + '&curenHdFont=' + curenHdFont + '&curenHdfontSize=' + curenHdfontSize + '&curenHdbgColor=' + curenHdbgColor + '&curenHdfontColor=' + curenHdfontColor;
        $(".loader-holder").show();
        $.post(url,{session_id:session_id,value:value,type:3},function(data){

            furl = furl.trim()+"/"+ data.trim();
            $("#iframeCurrencyBox").attr("src", furl);
           // $('#iframeCurrencyBox').load(document.URL + ' #iframeCurrencyBox');


            if (curenHeight >= 710 && curenHeight <= 760) {
                loadCurrency(curenWidht+20, curenHeight+30);
            }else{
                alert("Only allow hight: 710 to 760 ");
                return false;
            }

            $(".loader-holder").hide();
        })



    }
    else {
        alert("Only allow width: 380 to 600 ");
        return false;

    }



});


function loadCurrency(widthbox, heightbox) {
    $("#iframeCurrencyBox").css("width", widthbox + "px");
    $("#iframeCurrencyBox").css("height", heightbox + "px");
    var xframe = $("#currencyIframe").html();
    xframe = xframe.trim();
    $("#currencyIframeBox").val(xframe);


}

$(document).on("input", "#curenWidht", function () {

    var width = $(this).val();
    width = width.trim();


    if (checkInteger(width) == true) {
        if (width > 600) {
            $(this).val('600');
        }
        //    if(width<200){   $(this).val('200');}

    } else {

        $(this).val('350');
    }

});


$(document).on("input", "#curenHeight", function () {

    var width = $(this).val();
    width = width.trim();


    if (checkInteger(width) == true) {
        if (width >= 760) {
            $(this).val('760');
        }
        //    if(width<610){   $(this).val('610');}

    } else {

        $(this).val('710');
    }

});

//Forex Informer

$(document).ready(function () {
    var forexQuotes = function () {

        $.ajax({
            dataType: 'json',
            url: '/quotes/getForexQuotes',
            method: 'POST'
        }).done(function (result) {
            jQuery.each(result, function (i, quotes) {
                var bid = getPrice(parseFloat(quotes.bid), quotes.digits);
                var ask = getPrice(parseFloat(quotes.ask), quotes.digits);
                var symbol = "#symbol_" + quotes.symbol;
                $(symbol + " td.symbol").html(quotes.symbol);
                $(symbol + " td.bid").html(bid);
                $(symbol + " td.ask").html(ask);
                $(symbol + " td.change").html(quotes.change);
            });
        });
    };
    forexQuotes();
    setInterval(function () {
        forexQuotes()
    }, 12000);
});

function getPrice(val, digits) {
    return retVal = (val.toFixed(digits)).toString();
}


</script>


<div class="reg-form-holder">
<div class="container">
<div class="row">
<div class="col-lg-12">
<h1 class="license-title"><?=lang('inf_1');?></h1>
<h1 class="license-sub"><?=lang('inf_2');?></h1>

<div class="ins-tab-holder">



<div class="informer-tab-holder new-division-informer">
    <div class="informer-tabs">
        <a href="#tab1" aria-controls="tab1"  data-toggle="tab" id="informer-active">
            <span>Forex Major</span>
            <img src="<?= $this->template->Images() ?>informer-1.png" alt="" class="img-responsive informer-img">
        </a>
    </div>
    <div class="informer-tabs">
        <a href="#tab2" aria-controls="tab2"  data-toggle="tab">
            <span>Economic Calendar</span>
            <img src="<?= $this->template->Images() ?>informer-2.png" alt="" class="img-responsive informer-img">
        </a>
    </div>
    <div class="informer-tabs">
        <a href="#tab3" aria-controls="tab3"  data-toggle="tab">
            <span>Currency Converter</span>
            <img src="<?= $this->template->Images() ?>informer-3.png" alt="" class="img-responsive informer-img">
        </a>
    </div>
    <div class="informer-tabs" id="forex-calc">
        <a href="#tab4" aria-controls="tab4"  data-toggle="tab">
            <span>Forex calculator</span>
            <img src="<?= $this->template->Images() ?>informer-4.png" alt="" class="img-responsive informer-img">
        </a>
    </div>
    <div class="informer-tabs">
        <a href="#tab5" aria-controls="tab5"  data-toggle="tab">
            <span>Company News/ Analytics</span>
            <img src="<?= $this->template->Images() ?>informer-5.png" alt="" class="img-responsive informer-img">
        </a>
    </div>

    <div class="informer-tabs">
        <a href="#tab6" aria-controls="tab6"  data-toggle="tab">
            <span>ForexMart Informers</span>
            <img src="<?= $this->template->Images() ?>informer-6.png" alt="" class="img-responsive informer-img">
        </a>
    </div>
    <?php
     if(IPLoc::Office()){ ?>
         <div class="informer-tabs" >
             <a href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab">
                 <span style="margin-left: 0px;" >Partnership Registration</span>
                 <img src="<?= $this->template->Images() ?>informer-7.png" class="img-responsive informer-img">
             </a>
         </div>

         <div class="clearfix"></div>
     <?php } ?>

    <?php
     if(IPLoc::Office()){ ?>
         <div class="informer-tabs">
             <a href="#tab8" aria-controls="tab8" role="tab" data-toggle="tab">
                 <span>Teaser Registration</span>
                 <img src="<?= $this->template->Images() ?>informer-7.png" class="img-responsive informer-img">
             </a>
         </div>
    <?php }
    ?>

    <div class="clearfix"></div>
</div>


<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="tab1">
    <div class="quotes-holder">
        <div class="quotes">
            <h1><?=lang('inf_4');?></h1>

            <div class="panel panel-default">
                <div class="panel-heading quotes-heading">
                    <img src="<?= $this->template->Images() ?>logo.png" alt="" class="informer-logo img-responsive">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped quotes-table">
                        <tr>
                            <th colspan="5"><?=lang('inf_4');?></th>
                        </tr>
                        <tbody>

                        <?php foreach ($quotes as $key => $val) { ?>
                            <tr id="symbol_<?php echo $val['symbol']; ?>">
                                <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                <td class="currency symbol"><?php echo $val['symbol']; ?></td>
                                <td>
                                    <button class="btn-buy"> Buy</button>
                                </td>
                                <td class="bid"><?php echo $val['bid']; ?></td>
                                <td class="ask"><?php echo $val['ask']; ?></td>
                                <td>
                                    <button class="btn-sell"> Sell</button>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer quotes-footer"><?=lang('inf_8');?></div>
            </div>
        </div>
    </div>
    <div class="install-holder">
        <a class="install-a" data-toggle="collapse" href="#informer" aria-expanded="false" aria-controls="collapse2"
           id="col">
            <h1 class="install-sub"><?=lang('inf_9');?> <span class="plus-sign">[+]</span></h1>
        </a>
        <a class="install-a" data-toggle="collapse" href="#informer" aria-expanded="false" aria-controls="collapse2"
           id="col1">
            <h1 class="install-sub"><?=lang('inf_9');?> <span class="minus-sign">[-]</span></h1>
        </a>

        <div class="row collapse" id="informer">
            <div class="col-md-5 col-sm-5">
                <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_10');?></h2>

                <div class="install-settings-holder" style="margin-top: 15px;">
                    <div class="form-group row">
                        <label class="col-sm-3 install-fields"><?=lang('inf_11');?></label>

                        <div class="col-sm-9">
                            <input type="text" id="majorinputwidth" class="form-control round-0 width-text" value="300" readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 install-fields"><?=lang('inf_12');?></label>

                        <div class="col-sm-9">
                            <div class="col-xs-5 left-list">
                                <select size="8" class="form-control round-0" multiple id="tickers">
                                    <option value="EURUSD">EURUSD</option>
                                    <option value="GBPUSD">GBPUSD</option>
                                    <option value="USDJPY">USDJPY</option>
                                    <option value="USDCHF">USDCHF</option>
                                    <option value="USDCAD">USDCAD</option>
                                    <option value="EURJPY">EURJPY</option>
                                    <option value="EURCHF">EURCHF</option>
                                    <option value="GBPJPY">GBPJPY</option>
                                    <option value="GBPCHF">GBPCHF</option>
                                </select>
                            </div>
                            <div class="col-xs-2 btn-caret-holder">
                                <button class="btn-caret-right"><i class="fa fa-caret-right"></i></button>
                                <button class="btn-caret-left"><i class="fa fa-caret-left"></i></button>
                                <button class="btn-caret-up"><i class="fa fa-caret-up"></i></button>
                                <button class="btn-caret-down"><i class="fa fa-caret-down"></i></button>
                            </div>
                            <div class="col-xs-5 right-list">
                                <select size="8" class="form-control round-0" multiple id="selectedtickers">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-6 install-fields"><?=lang('inf_22');?></label>

                        <div class="col-xs-6">
                            <input type="color" id="hdbgcolor" class="colorpicker" value="#2988CA" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-3 install-fields"><?=lang('inf_23');?></label>

                        <div class="col-xs-9 ipad-text-width">
                            <div class="col-xs-7 font-family">
                                <select class="form-control round-0" id="fontheader">
                                    <option value="sans-serif">MS Sans Serif</option>
                                    <option value="Tahoma">Tahoma</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Courier">Courier</option>
                                </select>
                            </div>
                            <div class="col-xs-3 font-size">
                                <select class="form-control round-0 fsize" id="fsizeheader">
                                    <option value="9">9 px</option>
                                    <option value="10">10 px</option>
                                    <option value="11">11 px</option>
                                    <option value="12">12 px</option>
                                    <option value="14" selected="selected">14 px</option>
                                    <option value="15">15 px</option>
                                    <option value="16">16 px</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <input type="color" class="colorpicker" value="#FFFFFF" id="fhtextcolor" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-3 install-fields"><?=lang('inf_24');?></label>

                        <div class="col-xs-9 ipad-text-width">
                            <div class="col-xs-7 font-family">
                                <select class="form-control round-0" id="tdlistTextFont">
                                    <option value="sans-serif">MS Sans Serif</option>
                                    <option value="Tahoma">Tahoma</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Courier">Courier</option>

                                </select>
                            </div>
                            <div class="col-xs-3 font-size">
                                <select class="form-control round-0 fsize" id="tdlisttextSize">
                                    <option value="8">8 px</option>
                                    <option value="9">9 px</option>
                                    <option value="10">10 px</option>
                                    <option value="11" selected="selected">11 px</option>
                                    <option value="12">12 px</option>
                                    <option value="14">14 px</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <input type="color" class="colorpicker" value="#000000" id="tdlisttextcolor" />
                            </div>
                        </div>
                    </div>
                    <div class="btn-apply-holder">
                        <button class="btn-apply" id="saveIframe" style="display: block; margin: 0 auto;"><?=lang('inf_25');?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 ipad-info-chart">
                <h2 class="install-text" style="margin-top: 5px;"><?=lang('inf_26');?></h2>

                <div class="preview-holder" id="iframmajorbox">
                    <iframe id="iframetag"
                            src="<?= base_url('partnership/informerMajorIframe') ?>"
                            style="border: none;height:51vh; display: block; margin: 0 auto;"></iframe>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 ipad-width-informer">
                <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_27');?></h2>

                <div class="code-holder" style="margin-top: 15px;">
                    <p class="code-text">
                        <?=lang('inf_28');?>
                    </p>

                    <h1 class="code-sub"><?=lang('inf_29');?></h1>
                    <textarea rows="4" id="iframevalue" style="resize:vertical"  onfocus="this.select();"
                              class="form-control round-0 iframe-text">sample</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane" id="tab2">
<div class="quotes-holder">
    <div class="quotes">
        <h1><?=lang('inf_3');?></h1>

        <div class="panel panel-default">
            <div class="panel-heading quotes-heading">
                <img src="<?=base_url()?>assets/landing_v2/images/fxlogonew.svg" alt="" class="informer-logo img-responsive">
            </div>
            <div class="table-responsive">
                <table class="table table-striped quotes-table calendar-table">
                    <tr>
                        <th colspan="2"><?=lang('ecn_cal_2');?></th>
                        <th class="calendar-event"><?=lang('ecn_cal_3');?></th>
                        <th><?=lang('ecn_cal_4');?></th>
                    </tr>
                    <tbody>
                    <tr>
                        <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                        <td>May, 24 7:00</td>
                        <td class="f16"><i class="flag jp"></i></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#event">Merchandise Trade</a>
                        </td>
                        <td>-14.9% y/y</td>
                    </tr>
                    <tr>
                        <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                        <td>May, 24 7:00</td>
                        <td class="f16"><i class="flag fr"></i></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#event">Flash Services PMI</a>
                        </td>
                        <td>50.6</td>
                    </tr>
                    <tr>
                        <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                        <td>May, 24 7:00</td>
                        <td class="f16"><i class="flag ge"></i></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#event">Flash PMI Services</a>
                        </td>
                        <td>54.5</td>
                    </tr>
                    <tr>
                        <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                        <td>May, 24 7:00</td>
                        <td class="f16"><i class="flag eu"></i></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#event">Flash Services PMI</a>
                        </td>
                        <td>53.1</td>
                    </tr>
                    <tr>
                        <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                        <td>May, 24 7:00</td>
                        <td class="f16"><i class="flag us"></i></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#event">Flash PMI Services</a>
                        </td>
                        <td>50.8</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer quotes-footer"><?=lang('inf_8');?></div>
        </div>
    </div>
</div>
<div class="install-holder">
<a class="install-a" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2"
   id="col-a">
    <h1 class="install-sub"><?=lang('inf_31');?> <span class="plus-sign">[+]</span></h1>
</a>
<a class="install-a" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" id="col-a1">
    <h1 class="install-sub"><?=lang('inf_31');?> <span class="minus-sign">[-]</span></h1>
</a>

<div class="row collapse" id="collapse2">
<div class="col-md-7 col-sm-7">
<h2 class="install-text" style="margin-top: 0;"><?=lang('inf_10');?></h2>

<div class="install-settings-holder" style="margin-top: 0;">
<div class="form-group row">
    <label class="col-sm-5 install-fields"><?=lang('inf_11');?></label>

    <div class="col-sm-7">
        <input type="text" class="form-control round-0 width-text txtnews" placeholder="230-300">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-5 install-fields"><?=lang('inf_32');?></label>

    <div class="col-sm-7">
        <select class="form-control round-0 txtnews">
            <option>London</option>
            <option>Lougetown</option>
            <option>Dressrosa</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-5 install-fields"><?=lang('inf_33');?></label>

    <div class="col-sm-7">
        <select class="form-control round-0 int-width txtnews">
            <option>5</option>
            <option>10</option>
            <option>15</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_34');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 fsize int-width txtnews">
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
        <div class="col-xs-2">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_35');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 fsize shadow-txt">
                <option>8px</option>
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 fsize shadow-txt">
                <option>8px</option>
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 fsize shadow-txt">
                <option>8px</option>
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 fsize shadow-txt">
                <option>8px</option>
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_52');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 shadow-txt">
                <option>None</option>
            </select>
        </div>
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 shadow-txt">
                <option>None</option>
            </select>
        </div>
        <div class="col-xs-3 border-size">
            <select class="form-control round-0 shadow-txt">
                <option>None</option>
            </select>
        </div>
        <div class="col-xs-1">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-6 install-fields"><?=lang('inf_36');?></label>

    <div class="col-xs-6">
        <input type="color" class="colorpicker" value="#2988CA">
        <input type="color" class="colorpicker" value="#2988CA">
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-6 install-fields"><?=lang('inf_37');?></label>

    <div class="col-xs-6">
        <input type="color" class="colorpicker" value="#2988CA">
        <input type="color" class="colorpicker" value="#2988CA">
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-6 install-fields"><?=lang('inf_38');?></label>

    <div class="col-xs-6">
        <input type="color" class="colorpicker" value="#2988CA">
        <input type="color" class="colorpicker" value="#2988CA">
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-6 install-fields"><?=lang('ecn_cal_15');?></label>

    <div class="col-xs-6">
        <input type="color" class="colorpicker" value="#2988CA">
        <input type="color" class="colorpicker" value="#2988CA">
    </div>
</div>
<div class="form-group row">
    <label class="col-xs-6 install-fields"><?=lang('ecn_cal_16');?></label>

    <div class="col-xs-6">
        <input type="color" class="colorpicker" value="#2988CA">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 install-fields"><?=lang('ecn_cal_17');?></label>

    <div class="col-sm-8">
        <div class="col-xs-4 font-family">
            <select class="form-control round-0 txtnews">
                <option>Sample</option>
                <option>Sample</option>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize txtnews">
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize txtnews">
                <option>Center</option>
                <option>Normal</option>
                <option>Left</option>
                <option>Right</option>
            </select>
        </div>
        <div class="col-xs-1">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 install-fields"><?=lang('ecn_cal_18');?></label>

    <div class="col-sm-8">
        <div class="col-xs-7 font-family">
            <select class="form-control round-0 txtnews">
                <option>Sample</option>
                <option>Sample</option>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize txtnews">
                <option>12px</option>
                <option>14px</option>
                <option>16px</option>
                <option>18px</option>
            </select>
        </div>
        <div class="col-xs-1">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 install-fields"><?=lang('ecn_cal_19');?></label>

    <div class="col-sm-8">
        <div class="col-xs-10 font-family">
            <select class="form-control round-0 txtnews">
                <option>Sample</option>
                <option>Sample</option>
            </select>
        </div>
        <div class="col-xs-1">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 install-fields"><?=lang('ecn_cal_20');?></label>

    <div class="col-sm-8">
        <div class="col-xs-10 font-family">
            <select class="form-control round-0 txtnews">
                <option>Sample</option>
                <option>Sample</option>
            </select>
        </div>
        <div class="col-xs-1">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 install-fields"><?=lang('ecn_cal_21');?></label>

    <div class="col-sm-8">
        <div class="col-xs-4 font-family">
            <select class="form-control round-0 txtnews">
                <option>none</option>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize txtnews">
                <option>none</option>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize txtnews">
                <option>none</option>
            </select>
        </div>
        <div class="col-xs-1">
            <input type="color" class="colorpicker" value="#2988CA">
        </div>
    </div>
</div>
<div class="btn-apply-holder">
    <button class="btn-apply"><?=lang('inf_25');?></button>
</div>
</div>
</div>
<div class="col-md-5 col-sm-5">
    <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_27');?></h2>

    <div class="code-holder"  style="margin-top: 0;">
        <p class="code-text">
            <?=lang('inf_28');?>
        </p>

        <h1 class="code-sub"><?=lang('inf_29');?></h1>
        <textarea rows="4" class="form-control round-0 iframe-text">sample</textarea>
    </div>
</div>
</div>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="tab3">
    <div class="ticker-holder row quotes-holder">
        <div class="col-md-5 col-centered" id="currencyIframe">


            <iframe id="iframeCurrencyBox"
                    src="<?= base_url('partnership/informerCurrencyIframe') ?>"
                    style="border: medium none; width: 380px; height:720px; overflow: hidden;"></iframe>


        </div>
    </div>
    <div class="install-holder">
        <a class="install-a" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse2"
           id="col-b">
            <h1 class="install-sub"><?=lang('inf_44');?> <span class="plus-sign">[+]</span></h1>
        </a>
        <a class="install-a" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse2"
           id="col-b1">
            <h1 class="install-sub"><?=lang('inf_44');?> <span class="minus-sign">[-]</span></h1>
        </a>

        <div class="row collapse" id="collapse3">
            <div class="col-md-6 col-sm-6">
                <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_10');?></h2>

                <div class="install-settings-holder" style="margin-top: 15px;">

                    <div class="form-group row">
                        <label class="col-sm-3 install-fields"><?=lang('inf_11');?></label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control round-0 width-text" id="curenWidht" value="380"
                                   placeholder="380-600">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 install-fields"><?=lang('inf_45');?></label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control round-0 width-text" placeholder="710-760"
                                   id="curenHeight" value="710">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-3 install-fields"><?=lang('inf_46');?></label>

                        <div class="col-xs-9">
                            <div class="col-xs-9 font-family">
                                <select class="form-control round-0" id="curenFont">


                                    <option value="unset">unset</option>
                                    <option value="sans-serif">MS Sans Serif</option>

                                    <option value="Verdana">Verdana</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Courier">Courier</option>
                                </select>
                            </div>
                            <div class="col-xs-3 font-size">
                                <select class="form-control round-0 fsize" id="curenfontSize">
                                    <option value="8">8 px</option>
                                    <option value="9">9 px</option>
                                    <option value="10">10 px</option>
                                    <option value="11" selected="selected">11 px</option>
                                    <option value="12">12 px</option>
                                    <option value="14">14 px</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-5 install-fields"><?=lang('cur_conv_12');?></label>

                        <div class="col-xs-6">
                            <input type="color" class="colorpicker" value="#ffffff" id="curenbgcolor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-5 install-fields"><?=lang('inf_47');?></label>

                        <div class="col-xs-6">
                            <input type="color" class="colorpicker" value="#000000" id="curenfontColor">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-xs-5 install-fields"><?=lang('inf_48');?></label>

                        <div class="col-xs-7">
                            <label class="radio-inline">
                                <input type="radio" name="arrowkey" checked="checked" class="arrowkey"
                                       value="fa-caret-left_fa-caret-right_77"> <i class="fa fa-caret-up"></i><i
                                    class="fa fa-caret-down"></i>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="arrowkey" class="arrowkey"
                                       value="fa-long-arrow-left_fa-long-arrow-right_22"> &uarr;&darr;
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="arrowkey" class="arrowkey"
                                       value="fa-chevron-left_fa-chevron-right_35"> <i class="fa fa-chevron-up"></i><i
                                    class="fa fa-chevron-down"></i>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 install-fields"><?=lang('inf_49');?></label>

                    </div>
                    <div class="form-group row">
                        <label class="col-xs-3 install-fields"><?=lang('inf_46');?></label>

                        <div class="col-xs-9">
                            <div class="col-xs-9 font-family">
                                <select class="form-control round-0" id="curenHdFont">
                                    <option value="unset">unset</option>
                                    <option value="sans-serif">MS Sans Serif</option>
                                    <option value="Tahoma">Tahoma</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Courier">Courier</option>
                                </select>
                            </div>
                            <div class="col-xs-3 font-size">
                                <select class="form-control round-0 fsize" id="curenHdfontSize">
                                    <option value="8">8 px</option>
                                    <option value="9">9 px</option>
                                    <option value="10">10 px</option>
                                    <option value="11" selected="selected">11 px</option>
                                    <option value="12">12 px</option>
                                    <option value="14">14 px</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-5 install-fields"><?=lang('inf_40');?></label>

                        <div class="col-xs-6">
                            <input type="color" class="colorpicker" value="#2988CA" id="curenHdbgColor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-5 install-fields"> <?=lang('inf_47');?></label>

                        <div class="col-xs-6">
                            <input type="color" class="colorpicker" value="#000" id="curenHdfontColor" />
                        </div>
                    </div>


                    <div class="btn-apply-holder">
                        <button class="btn-apply" id="savecurrencyIframe"><?=lang('inf_25');?></button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_27');?></h2>

                <div class="code-holder" style="margin-top: 15px;">
                    <p class="code-text">
                       <?=lang('inf_28');?>
                    </p>

                    <h1 class="code-sub"><?=lang('inf_29');?></h1>
                    <textarea rows="4" id="currencyIframeBox" onfocus="this.select();"
                              class="form-control round-0 iframe-text"></textarea>

                </div>
            </div>


        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane" id="tab4">
<div class="row quotes-holder" id="calculatorbox" style="text-align: center">


    <iframe id="iframeCalculatorBox"
            src="<?= base_url('partnership/informerCalculatorIframe') ?>"
            style="border: none; width: inherit; height:730px;"></iframe>


</div>
<div class="install-holder">
<a class="install-a" data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse3"
   id="col-c">
    <h1 class="install-sub"><?=lang('inf_50');?> <span class="plus-sign">[+]</span></h1>
</a>
<a class="install-a" data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse3"
   id="col-c1">
    <h1 class="install-sub"><?=lang('inf_50');?> <span class="minus-sign">[-]</span></h1>
</a>

<div class="row collapse" id="collapse4">
<div class="row">
<div class="col-md-6 col-sm-6">
<h2 class="install-text" style="margin-top: 0;"><?=lang('inf_10');?></h2>

<div class="install-settings-holder" style="margin-top: 15px;">
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_11');?></label>

    <div class="col-sm-9">
        <input type="text" class="form-control round-0 width-text txtnews" placeholder="245-600" id="nwidht"
               value="450">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_45');?></label>

    <div class="col-sm-9">
        <input type="text" class="form-control round-0 width-text txtnews" placeholder="680" value="680" id="nheight"
               disabled="">
    </div>
</div>
<!--                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Effect:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-family">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>Fade</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>sequence</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>slow</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>-->
<label class="left"><?=lang('inf_51');?></label>

<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_34');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nborder">
                <option value="0">none</option>
                <option value="1" selected="selected">1</option>
                <?php for ($i = 2; $i < 7; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nborty">
                <option value="solid">solid</option>
                <option value="dotted">dotted</option>
                <option value="dashed">dashed</option>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <input type="color" class="colorpicker" value="#a9d8f9" id="nborcol">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_35');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nround_1">
                <?php for ($i = 0; $i < 16; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nround_2">
                <?php for ($i = 0; $i < 16; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nround_3">
                <?php for ($i = 0; $i < 16; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nround_4">
                <?php for ($i = 0; $i < 16; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_52');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nshado_1">
                <?php for ($i = 0; $i < 10; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nshado_2">
                <?php for ($i = 0; $i < 10; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <select class="form-control round-0 fsize" id="nshado_3">
                <?php for ($i = 0; $i < 10; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3 font-size">
            <input type="color" class="colorpicker" value="#ffffff" id="nshadocol">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_53');?></label>

    <div class="col-sm-9">
        <div class="col-xs-6 font-size">

            <select class="form-control round-0" id="nfont">

                <option value="unset">unset</option>
                <option value="sans-serif">MS Sans Serif</option>
                <option value="Tahoma">Tahoma</option>
                <option value="Verdana">Verdana</option>
                <option value="Arial">Arial</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Courier">Courier</option>


            </select>

        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_54');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <input type="color" class="colorpicker" value="#000000" id="nfontcolor">
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_55');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <input type="color" class="colorpicker" value="#ffffff" id="nbgone">
            <input type="color" class="colorpicker" value="#ffffff" id="nbgtwo">
        </div>
    </div>
</div>

<label class="left">Header</label>

<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_23');?></label>

    <div class="col-sm-9">
        <div class="col-xs-6 font-size">
            <select class="form-control round-0" id="hfont">

                <option value="unset">unset</option>
                <option value="sans-serif">MS Sans Serif</option>
                <option value="Tahoma">Tahoma</option>
                <option value="Verdana">Verdana</option>
                <option value="Arial">Arial</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Courier">Courier</option>


            </select>
        </div>


    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_56');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <select class="form-control round-0" id="hfontsize">
                <option value="9">9 px</option>
                <option value="10">10 px</option>
                <option value="11">11 px</option>
                <option value="12">12 px</option>
                <option value="14" selected="selected">14 px</option>
                <option value="15">15 px</option>
                <option value="16">16 px</option>

            </select>
        </div>
        <div class="col-xs-3 font-size">
            <input type="color" class="colorpicker" value="#000000" id="hfontcolor"
                   style="margin-left: 23px;margin-top: 2px; width: 40px">
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 install-fields"><?=lang('inf_55');?></label>

    <div class="col-sm-9">
        <div class="col-xs-3 font-size">
            <input type="color" class="colorpicker" id="hbg" value="#2988ca">
        </div>
    </div>
</div>
<div class="btn-apply-holder">
    <button class="btn-apply" id="savecalculIframe"><?=lang('inf_25');?></button>
</div>
</div>
</div>
<!-- <div class="col-md-6 col-sm-6">
    <h2 class="install-text">Informer preview</h2>
    <div class="preview-holder ticker-preview">
        <div class="ticker">
            <div class="panel panel-default ticker-panel">
                <div class="panel-heading ticker-heading">
                    ForexMart Button
                </div>
                <div class="panel-body ticker-body">
                    <button class="btn-forex">Open Account</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="col-md-6 col-sm-6">
    <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_27');?></h2>

    <div class="code-holder" style="margin-top: 15px;">
        <p class="code-text">
            <?=lang('inf_28');?>
        </p>

        <h1 class="code-sub"><?=lang('inf_29');?></h1>
        <textarea rows="4" class="form-control round-0 iframe-text" id="calculatoriframebox"
                  onfocus="this.select();"></textarea>
    </div>
</div>
</div>
</div>
</div>
</div>
<div role="tabpanel" class="tab-pane" id="tab5">
<div class="quotes-holder">
    <div class="quotes">
        <h1><?=lang('inf_57');?></h1>

        <div class="panel panel-default">
            <div class="panel-heading quotes-heading">
                <img src="<?= $this->template->Images() ?>logo.png" alt="" class="informer-logo">
            </div>
            <h5 class="comp-news-sub">
                <?=lang('inf_58');?>
            </h5>

            <div id="news_data">
                <?php foreach ($latest_news as $key => $news) { ?>
                    <div class="forexnews-holder">
                        <p class="news-date"><?php echo date('Y-m-d H:i', strtotime($news['date_created'])) ?></p>

                        <h2 class="forexnews-text">
                            <?php echo $news['headline'] ?>
                        </h2>
                        <a href="<?php echo base_url('news/article/' . $news['id']) ?>" class="forexnews-more">Read
                            More</a>

                        <div class="clearfix"></div>
                    </div>
                <?php } ?>
            </div>
            <div class="news-page-holder" id="news_pagination">
                <?php echo $latest_news_page_links ?>
            </div>
            <div class="panel-footer quotes-footer">Powered by ForexMart</div>
        </div>
    </div>
</div>
<div class="install-holder">
<a class="install-a" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5"
   id="col-a">
    <h1 class="install-sub"><?=lang('inf_59');?><span class="plus-sign">[+]</span></h1>
</a>
<a class="install-a" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5" id="col-a1">
    <h1 class="install-sub"><?=lang('inf_59');?><span class="minus-sign">[-]</span></h1>
</a>

<div class="row collapse" id="collapse5">
<div class="col-md-5 col-sm-5">
    <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_10');?></h2>

    <div class="install-settings-holder" style="margin-top: 15px;">
        <div class="form-group row">
            <label class="col-sm-5 install-fields"><?=lang('inf_11');?></label>

            <div class="col-sm-7">
                <input type="text" id="newsWidth" class="form-control round-0 width-text txtnews" placeholder="300-350" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-5 install-fields"><?=lang('inf_45');?></label>

            <div class="col-sm-7">
                <input type="text" id="newsHeight" class="form-control round-0 width-text txtnews"
                       placeholder="580-900">
            </div>
        </div>
        <div style="display: none" class="form-group row">
            <label class="col-sm-5 install-fields"><?=lang('cmpny_news_6');?></label>

            <div class="col-sm-7">
                <select id="newsNumArticles" class="form-control round-0 int-width txtnews">
                    <option value="5" selected="selected">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-6 install-fields"><?=lang('inf_36');?></label>

            <div class="col-xs-6">
                <input id="newsHeaderBG" type="color" class="colorpicker" value="#2988CA">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-6 install-fields"><?=lang('inf_37');?></label>

            <div class="col-xs-6">
                <input id="newsBodyBG" type="color" class="colorpicker" value="#FFFFFF">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-6 install-fields"><?=lang('inf_38');?></label>

            <div class="col-xs-6">
                <input id="newsFooterBG" type="color" class="colorpicker" value="#FFFFFF">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 install-fields"><?=lang('inf_41');?></label>

            <div class="col-sm-8">
                <div class="col-xs-4 font-family">
                    <select id="newsHeaderFont" class="form-control round-0 txtnews">
                        <option value="Open Sans" selected="selected">Open Sans</option>
                        <option value="sans-serif">MS Sans Serif</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier">Courier</option>
                    </select>
                </div>
                <div class="col-xs-3 font-size">
                    <select id="newsHeaderSize" class="form-control round-0 fsize txtnews">
                        <option value="8">8 px</option>
                        <option value="9">9 px</option>
                        <option value="10">10 px</option>
                        <option value="11">11 px</option>
                        <option value="12">12 px</option>
                        <option value="14" selected="selected">14 px</option>
                    </select>
                </div>
                <div class="col-xs-3 font-size">
                    <select id="newsHeaderAlign" class="form-control round-0 fsize txtnews">
                        <option value="center">Center</option>
                        <option value="left" selected="selected">Left</option>
                        <option value="right">Right</option>
                    </select>
                </div>
                <div class="col-xs-1">
                    <input id="newHeaderColor" type="color" class="colorpicker" value="#FFFFFF">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 install-fields"><?=lang('inf_60');?></label>

            <div class="col-sm-8">
                <div class="col-xs-7 font-family">
                    <select id="newsDateFont" class="form-control round-0 txtnews">
                        <option value="Open Sans" selected="selected">Open Sans</option>
                        <option value="sans-serif">MS Sans Serif</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier">Courier</option>
                    </select>
                </div>
                <div class="col-xs-3 font-size">
                    <select id="newsDateSize" class="form-control round-0 fsize txtnews">
                        <option value="8">8 px</option>
                        <option value="9">9 px</option>
                        <option value="10">10 px</option>
                        <option value="11" selected="selected">11 px</option>
                        <option value="12">12 px</option>
                        <option value="14">14 px</option>
                    </select>
                </div>
                <div class="col-xs-1">
                    <input id="newsDateColor" type="color" class="colorpicker" value="#777777">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 install-fields"><?=lang('inf_61');?></label>

            <div class="col-sm-8">
                <div class="col-xs-10 font-family">
                    <select id="newsTextFont" class="form-control round-0 txtnews">
                        <option value="Open Sans" selected="selected">Open Sans</option>
                        <option value="sans-serif">MS Sans Serif</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier">Courier</option>
                    </select>
                </div>
                <div class="col-xs-1">
                    <input id="newsTextColor" type="color" class="colorpicker" value="#000000">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 install-fields"><?=lang('inf_42');?></label>

            <div class="col-sm-8">
                <div class="col-xs-10 font-family">
                    <select id="newsFooterFont" class="form-control round-0 txtnews">
                        <option value="Open Sans" selected="selected">Open Sans</option>
                        <option value="sans-serif">MS Sans Serif</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier">Courier</option>
                    </select>
                </div>
                <div class="col-xs-1">
                    <input id="newsFooterColor" type="color" class="colorpicker" value="#2988CA">
                </div>
            </div>
        </div>
        <div class="btn-apply-holder">
            <button id="btnApplyNews" class="btn-apply"><?=lang('inf_25');?></button>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-4">
    <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_26');?></h2>

    <div class="preview-holder" id="iframeNews" style="margin-top: 15px; height: 700px">
        <iframe id="iframeNewsTag_news" onload="resize"
                src="<?= base_url('partnership/informerNewsIframe') ?>"
                style="border: none; width:355px;height: 800px;"></iframe>
        <script type="text/javascript">
            function resize() {
                document.getElementById("iframeNewsTag").height = document.getElementById("iframeNewsTag").contentWindow.document.body.scrollHeight + "px";
            }
        </script>
    </div>


    <?php /*
                                            <div class="preview-holder">
                                                <div class="quotes">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading quotes-heading">
                                                            <img src="<?= $this->template->Images()?>logo.png" class="informer-logo">
                                                        </div>
                                                        <h5 class="comp-news-sub">
                                                            Company News
                                                        </h5>
                                                        <div class="forexnews-holder">
                                                            <p class="news-date">2015-06-18 16:58 GMT+01:00</p>
                                                            <h2 class="forexnews-text">
                                                                Lorem ipsum dolor sit amet
                                                            </h2>
                                                            <a href="#" class="forexnews-more">Read More</a>
                                                            <div class="clearfix"></div>
                                                        </div> 
                                                        <div class="forexnews-holder">
                                                            <p class="news-date">2015-06-18 16:58 GMT+01:00</p>
                                                            <h2 class="forexnews-text">
                                                                Lorem ipsum dolor sit amet
                                                            </h2>
                                                            <a href="#" class="forexnews-more">Read More</a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="forexnews-holder">
                                                            <p class="news-date">2015-06-18 16:58 GMT+01:00</p>
                                                            <h2 class="forexnews-text">
                                                                Lorem ipsum dolor sit amet
                                                            </h2>
                                                            <a href="#" class="forexnews-more">Read More</a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="forexnews-holder">
                                                            <p class="news-date">2015-06-18 16:58 GMT+01:00</p>
                                                            <h2 class="forexnews-text">
                                                                Lorem ipsum dolor sit amet
                                                            </h2>
                                                            <a href="#" class="forexnews-more">Read More</a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="forexnews-holder">
                                                            <p class="news-date">2015-06-18 16:58 GMT+01:00</p>
                                                            <h2 class="forexnews-text">
                                                                Lorem ipsum dolor sit amet
                                                            </h2>
                                                            <a href="#" class="forexnews-more">Read More</a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="news-page-holder">
                                                            <ul class="pagination pagination-sm news-page">
                                                                <li class="active"><a href="#">1</a></li>
                                                                <li class=""><a href="#">2</a></li>
                                                                <li class=""><a href="#">3</a></li>
                                                                <li class=""><a href="#">&raquo;</a></li>
                                                            </ul>
                                                        </div>                                         
                                                        <div class="panel-footer quotes-footer">Powered by ForexMart</div>
                                                    </div>
                                                </div>
                                            </div>
                                        */
    ?>
</div>
<div class="col-md-3 col-sm-3">
    <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_27');?></h2>

    <div class="code-holder" style="margin-top: 15px;">
        <p class="code-text">
            <?=lang('inf_28');?>
        </p>

        <h1 class="code-sub"><?=lang('inf_29');?></h1>
        <textarea id="iframeNewsTag_textarea" rows="4" class="form-control round-0 iframe-text">sample</textarea>
    </div>
</div>
</div>
</div>
</div>

<?php
   if(IPLoc::Office()){ ?>
       <div role="tabpanel" class="tab-pane" id="tab7">
           <div class="partner-reg-main-holder">
               <div class="col-md-5 col-centered">
                   <div class="partner-reg-form-holder">
                       <img src="<?= $this->template->Images() ?>fxlogonew.svg" class="img-responsive informer-img" class="form-logo">

                       <h2>Sign up for free.</h2>
                       <form>
                           <div class="form-group">
                               <label>Username:</label>
                               <input type="text" class="regtxt" id="" placeholder="">
                           </div>
                           <div class="form-group">
                               <label>Password:</label>
                               <input type="text" class="regtxt" id="" placeholder="">
                           </div>
                           <div class="form-group">
                               <label>Email:</label>
                               <input type="text" class="regtxt" id="" placeholder="">
                           </div>
                           <div class="form-group">
                               <label>Phone:</label>
                               <input type="text" class="regtxt" id="" placeholder="">
                           </div>
                           <div class="checkbox">
                               <label>
                                   <input type="checkbox" id="agree-checkbox"> I accept the <a href=<?= $this->template->pdf().'PA/EN_ForexMartPartnershipAgreement.pdf'?> class="reg-link">terms & conditions</a>.
                               </label>
                           </div>
                           <div class="reg-btn-holder">
                               <a href="#">Join Now</a>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
           <div class="install-holder">

               <a class="install-a i-p-reg-b" data-toggle="collapse" href="#collapse7" aria-expanded="false" aria-controls="collapse7" id="col-d">
                   <h1 class="install-sub">Install Partnership Registration<span class="plus-sign">[+]</span></h1>
               </a>
               <a class="install-a i-p-reg-a" data-toggle="collapse" href="#collapse7" aria-expanded="false" aria-controls="collapse7" id="col-d1" style="display: none">
                   <h1 class="install-sub">Install Partnership Registration<span class="minus-sign">[-]</span></h1>
               </a>


               <div class="row collapse" id="collapse7">
                   <div class="preview-main-holder">
                       <div class="container">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="preview-holder">
                                       <h3>Preview</h3>
                                       <div class="partner-reg-form-holder">
                                           <img src="<?= $this->template->Images() ?>fxlogonew.svg" class="form-logo">
                                           <h2>Sign up for free.</h2>
                                           <form>
                                               <div class="form-group">
                                                   <label>Username:</label>
                                                   <input type="text" class="regtxt" id="" placeholder="">
                                               </div>
                                               <div class="form-group">
                                                   <label>Password:</label>
                                                   <input type="text" class="regtxt" id="" placeholder="">
                                               </div>
                                               <div class="form-group">
                                                   <label>Email:</label>
                                                   <input type="text" class="regtxt" id="" placeholder="">
                                               </div>
                                               <div class="form-group">
                                                   <label>Phone:</label>
                                                   <input type="text" class="regtxt" id="" placeholder="">
                                               </div>
                                               <div class="checkbox">
                                                   <label>
                                                       <input type="checkbox" id="agree-checkbox"> I accept the <a href=<?= $this->template->pdf().'PA/EN_ForexMartPartnershipAgreement.pdf'?> class="reg-link">terms & conditions</a>.
                                                   </label>
                                               </div>
                                               <div class="reg-btn-holder">
                                                   <a href="#">Join Now</a>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="registration-code-holder">
                                       <h3>Code to insert</h3>
                                       <p>
                                           Insert it in the page body (between < body > and < /body >)
                                       </p>
                                       <textarea id="iframe_parReg" class="form-control round-0" rows="4">
                                           <iframe
                                               src="<?= base_url('partnership/informers_registration_form')?>" style="border: none;height:618px; width: 100%; display: block; margin: 0 auto;">
                                           </iframe>
                                       </textarea>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
  <?php }
?>

<?php
  if(IPLoc::Office()){ ?>

      <div role="tabpanel" class="tab-pane" id="tab8">
          <div class="partner-reg-main-holder">
              <div class="col-md-5 col-centered">
                  <div class="teaser-form-container" >
                      <img src="<?= $this->template->Images() ?>fxlogonew.svg" class="img-reponsive logo-fm">
                      <div class="imageform">
                          <img src="<?= $this->template->Images() ?>teaserformrev_01.gif" class="img-reponsive logo-fm">
                      </div>
                      <form role="form">
                          <div class="form-group">
                              <label class="control-label" for="username">Username:</label>
                              <input type="username" class="form-control" id="u_name" placeholder="">
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="pwd">Password: </label>
                              <input type="password" class="form-control" id="pwd" placeholder="">
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="email">Email:</label>
                              <input type="email" class="form-control" id="email" placeholder="">
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="phone">Phone:</label>
                              <input type="phone" class="form-control" id="phone" placeholder="">
                          </div>
                          <p class="check-join">
                              <input type="checkbox" name="accept-join" id="accept-join" value="accept-join" />
                              <label for="accept-join">I accept <a href="#">terms & conditions</a>.</label>
                          </p>
                          <button type="submit" class="btn btn-regjoin">JOIN NOW</button>
                      </form>
                  </div>
              </div>
          </div>
          <div class="install-holder">


              <a class="install-a i-p-reg-a" data-toggle="collapse" href="#collapse8" aria-expanded="false" aria-controls="collapse8" id="col-d">
                  <h1 class="install-sub">Install Partnership Teaser Registration<span class="plus-sign">[+]</span></h1>
              </a>
              <a class="install-a i-p-reg-b" data-toggle="collapse" href="#collapse8" aria-expanded="false" aria-controls="collapse8" style="display: none" id="col-d1">
                  <h1 class="install-sub">Install Partnership Teaser Registration<span class="minus-sign">[-]</span></h1>
              </a>

              <div class="row collapse" id="collapse8">
                  <div class="preview-main-holder">
                      <div class="container">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="preview-holder">
                                      <h3>Preview</h3>
                                      <div class="teaser-form-container" >
                                          <img src="<?= $this->template->Images() ?>fxlogonew.svg" class="img-reponsive logo-fm">
                                          <div class="imageform">
                                              <img src="<?= $this->template->Images() ?>teaserformrev_01.gif" class="img-reponsive logo-fm">
                                          </div>
                                          <form role="form">
                                              <div class="form-group">
                                                  <label class="control-label" for="username">Username:</label>
                                                  <input type="username" class="form-control" id="u_name" placeholder="">
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label" for="pwd">Password: </label>
                                                  <input type="password" class="form-control" id="pwd" placeholder="">
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label" for="email">Email:</label>
                                                  <input type="email" class="form-control" id="email" placeholder="">
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label" for="phone">Phone:</label>
                                                  <input type="phone" class="form-control" id="phone" placeholder="">
                                              </div>
                                              <p class="check-join">
                                                  <input type="checkbox" name="accept-join" id="accept-join" value="accept-join" />
                                                  <label for="accept-join">I accept <a href="#">terms & conditions</a>.</label>
                                              </p>
                                              <button type="submit" class="btn btn-regjoin">JOIN NOW</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="registration-code-holder">
                                      <h3>Code to insert</h3>
                                      <p>
                                          Insert it in the page body (between < body > and < /body >)
                                      </p>
                                      <textarea id="iframe_parReg" class="form-control round-0" rows="4">
                                          <iframe
                                              src="<?php echo FXPP::www_url('partnership/partnership-teaser-registration')?>" style="border: none;  height:777px; width: 483px; display: block; margin: 0 auto;">
                                          </iframe>
                                      </textarea>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  <?php }
?>

<div role="tabpanel" class="tab-pane" id="tab6">
    <div class="quotes-holder">
        <div class="quotes" style="width: 100%" >
            <!--Horizontal Tab-->
            <iframe id="iframeNewsTag" onload="resizeIframe(this)" src="<?= FXPP::ajax_url('partnership/informer_info_Iframe') ?>" style="border: none; width: 100%; height: 745px; overflow: hidden"></iframe>
            <!--  chart modal -->
            <div class="informersChart-modal">
                <div class="modal fade chart" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
<!--                                <img src="images/chart-01.png">-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="install-holder">
    <a class="install-a" data-toggle="collapse" href="#collapse6" aria-expanded="false" aria-controls="collapse6"
       id="col-a">
        <h1 class="install-sub"> <?=lang('inf_84');?> <span class="plus-sign">[+]</span></h1>
    </a>
    <a class="install-a" data-toggle="collapse" href="#collapse6" aria-expanded="false" aria-controls="collapse6"
       id="col-a1">
        <h1 class="install-sub"><?=lang('inf_84');?> <span class="minus-sign">[-]</span></h1>
    </a>

    <div class="row collapse" id="collapse6">
        <div class="col-md-4 col-sm-4">
            <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_10');?></h2>

            <div class="install-settings-holder" style="margin-top: 15px;">
                <div class="form-group row">
                    <label class="col-xs-6 install-fields"><?=lang('inf_11');?></label>

                    <div class="col-sm-5">
                        <input type="number" id="i-newsWidth" class="form-control round-0 width-text txtnews" min="400" max="450" placeholder="400-450">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-6 install-fields"><?=lang('inf_36');?></label>

                    <div class="col-xs-6">
                        <input id="i-newsHeaderBG" type="color" class="colorpicker" value="#2988CA">
                    </div>
                </div>
                <div style="display: none" class="form-group row">
                    <label class="col-xs-6 install-fields"><?=lang('inf_37');?></label>

                    <div class="col-xs-6">
                        <input id="i-newsBodyBG" type="color" class="colorpicker" value="#FFFFFF">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-6 install-fields"><?=lang('inf_38');?></label>

                    <div class="col-xs-6">
                        <input id="i-newsFooterBG" type="color" class="colorpicker" value="#FFFFFF">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 install-fields"><?=lang('inf_41');?></label>

                    <div class="col-sm-8">
                        <div class="col-xs-4 font-family">
                            <select id="i-newsHeaderFont" class="form-control round-0 txtnews">
                                <option value="Open Sans" selected="selected">Open Sans</option>
                                <option value="sans-serif">MS Sans Serif</option>
                                <option value="Tahoma">Tahoma</option>
                                <option value="Verdana">Verdana</option>
                                <option value="Arial">Arial</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Courier">Courier</option>
                            </select>
                        </div>
                        <div class="col-xs-3 font-size">
                            <select id="i-newsHeaderSize" class="form-control round-0 fsize txtnews">
                                <option value="8">8 px</option>
                                <option value="9">9 px</option>
                                <option value="10">10 px</option>
                                <option value="11">11 px</option>
                                <option value="12">12 px</option>
                                <option value="14" selected="selected">14 px</option>
                            </select>
                        </div>
                        <div class="col-xs-3 font-size">
                            <select id="i-newsHeaderAlign" class="form-control round-0 fsize txtnews">
                                <option value="center">Center</option>
                                <option value="left" selected="selected">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="col-xs-1">
                            <input id="i-newHeaderColor" type="color" class="colorpicker" value="#FFFFFF">
                        </div>
                    </div>
                </div>

                <div class="btn-apply-holder">
                    <button id="btnApplyInformer" class="btn-apply"><?=lang('inf_25');?></button>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-5">
            <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_26');?></h2>
            <div class="preview-holder" id="iframeInformer" style="margin-top: 15px;">
                <iframe id="iframeInformerTag" onload="resizeIframe(this)"
                        src="<?= FXPP::ajax_url('partnership/informer_info_Iframe') ?>"
                        style="border: none; width:100%; height: 692px;"></iframe>
            </div>



        </div>
        <div class="col-md-3 col-sm-3">
            <h2 class="install-text" style="margin-top: 0;"><?=lang('inf_27');?></h2>

            <div class="code-holder" style="margin-top: 15px;">
                <p class="code-text">
                    <?=lang('inf_28');?>
                </p>

                <h1 class="code-sub">IFRAME version</h1>
                <textarea id="informer-ifrm" rows="4" class="form-control round-0 iframe-text informer-ifrm">sample</textarea>
            </div>
        </div>

        <script type="text/javascript">
            function resize() {
                document.getElementById("iframeNewsTag").height = document.getElementById("iframeNewsTag").contentWindow.document.body.scrollHeight + "px";
            }
            $("#informer-ifrm").val($("#iframeInformer").html().trim());

        </script>
    </div>
</div>
</div>
</div>

</div>


<div class="clearfix"></div>
<?= $DemoAndLiveLinks ?>
</div>
</div>
</div>
</div>


<div class="modal fade" id="event" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0 modal-lg">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">Sample Event</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="btnsocial-holder">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        <li class="social-right"><a href="#"><i class="fa fa-print"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="modal-event-content">
                        <div class="col-sm-3">
                            <div class="form-group latest-release-holder">
                                <label>Latest Release</label>

                                <p class="latest-release">Aug 25, 2015</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label >Actual</label>

                                <p class="actual">3.741B</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label >Forecast</label>

                                <p class="forecast">2.600B</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label >Previous</label>

                                <p class="previous">3.509B</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="modal-event-content">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <p class="event-modal-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-3 line-left">
                            <div class="form-group row">
                                <label class="col-sm-6" >Importance:</label>

                                <div class="col-sm-6">
                                    <div class="progress calendar-progress">
<!--                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">-->
<!--                                        </div>-->
                                        <div class="progress-bar progress-bar-danger high" role="progressbar"  aria-valuemin="0" >  </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" >Country:</label>

                                <div class="col-sm-6">
                                    <p class="f32"><i class="flag ch"></i></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" >Currency:</label>

                                <div class="col-sm-6">
                                    <p class="">CHF</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" >Source:</label>

                                <div class="col-sm-6">
                                    <a href="#">Sample</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>Release Date</th>
                                    <th>Time</th>
                                    <th>Actual</th>
                                    <th>Forecast</th>
                                    <th>Previous</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aug, 24, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 23, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 22, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 21, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                <tr>
                                    <td>Aug, 20, 2015</td>
                                    <td>04:50</td>
                                    <td>1.928%</td>
                                    <td></td>
                                    <td>2.099%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <form class="form-inline">
                            <div class="form-group">
                                <label  class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-5 calendar-pagination">
                        <nav>
                            <ul class="pagination calendar-pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer round-0">
                <button type="button" class="btn btn-primary round-0">Update</button>
            </div> -->
        </div>
    </div>
</div>


<style>
    #iframevalue{
        width: 230px;
    }
    .fade {
        opacity: 0;
        -webkit-transition: opacity .15s linear;
        -o-transition: opacity .15s linear;
        transition: opacity .15s linear;
    }

    .collapse {
        background: none;
        display: none;
        visibility: hidden;
    }

    .collapse.in {
        display: block;
        visibility: visible;
    }

    #tab3 .cur-list li {
        text-align: left
    }

    .btn-switch {
        transform: rotate(90deg);
    }

    .informer-tab-holder .informer-tabs {
        float: left;
        padding: 9px;
        width: calc(100% / 6);
    }

    .informer-converter-holder .converter-drp, .informer-converter-holder .amount-label {
        text-align: left !important;
    }

    .informer-btn-switch-holder {
        margin-top: 0 !important;
    }

    .informer-tab-holder .informer-tabs a span {
        position: absolute;
        font-family: Georgia;
        font-size: 11px;
        margin-left: 5px;
        color: #fff;
    }

    @media only screen and (max-width: 1199px) and (min-width: 992px) {
        .informer-tab-holder .informer-tabs a span {
            font-size: 11.5px !important;
            margin-left: 1px;
        }
    }

    @media only screen and (max-width: 991px) and (min-width: 768px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 11px !important;
            margin-left: 1px;
            word-wrap: break-word !important;
            display: block;
            width: 100px;
        }

        .ipad-width-informer {
            width: 18% !important;
            float: right !important;
        }

        .ipad-info-chart {
            padding-left: 0px !important;
        }

        .ipad-text-width {
            width: 73% !important;
        }
      }

    @media only screen and (max-width: 767px) and (min-width: 666px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 16px !important;
        }
    }

    @media only screen and (max-width: 665px) and (min-width: 557px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 13px !important;
            padding: .2em;
            margin-left: 0px;
        }
    }

    @media only screen and (max-width: 460px) and (min-width: 400px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 14px !important;
            padding: .1em;
            margin-left: 1px !important;
        }
    }

    @media only screen and (max-width: 399px) and (min-width: 350px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 12px !important;
            padding: .1em;
            margin-left: 1px !important;
        }
    }

    @media only screen and (max-width: 349px){
        .informer-tab-holder .informer-tabs a span {
            font-size: 11px !important;
            word-wrap: break-word;
            display: block;
            width: 100px;
        }
    }

    .calendar-table tr th {
        font-size: 11px;
    }

    .calendar-event {
        width: 40%;
    }

</style>

<script type="text/javascript">
    $(document).ready(function(){
        $( ".i-p-reg-b" ).click(function() {
            $(".i-p-reg-b").hide();
            $(".i-p-reg-a").show();
        });
        $( ".i-p-reg-a" ).click(function() {
            $(".i-p-reg-b").show();
            $(".i-p-reg-a").hide();
        });
    })
</script>

<script type="text/javascript">
    var baseURL = '<?php echo FXPP::loc_url() ?>';
    jQuery(document).on('click', '.latest-page a', function (e) {
        e.preventDefault();
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "partnership/updateNewsLatestPage/" + cur_page,
            data: {cur_page: cur_page},
            dataType: 'JSON',
            cache: false,
            success: function (page) {
//                jQuery('#updatesCurrentPage').val(cur_page);
                jQuery('#news_data').html(page.html_data);
                jQuery('#news_pagination').html(page.html_page_links);
                //console.log(page);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });
</script>


<link type="text/css" href="<?= $this->template->Css() ?>easy-responsive-tabs.css" rel="stylesheet">
<script type="application/javascript" src="<?= $this->template->Js() ?>easyResponsiveTabs.js"></script>
<script src="<?= $this->template->Js() ?>bootstrap.min.js"></script>
<script src="<?= $this->template->Js() ?>jquery.dataTables.min.js"></script>
<script src="<?= $this->template->Js() ?>dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //Horizontal Tab

        $('#informersTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'informers', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                // $info.show();
            }
        });
        $('#clientAccount').DataTable();
        $('#partnersAccount').DataTable();
    });
</script>
<script>
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        console.log(obj.contentWindow.document.body.scrollHeight + 'px');
    }

    $(document).on("change",'select',function(){
        console.log("testtt");
    })

</script>
<script type="text/javascript">
    $(function(){
        $('.dropdown-toggle').click(function(){
            var li = $(this).parent();
            if(li.hasClass('open')){
                li.removeClass('open');
            }else{
                li.addClass('open');
            }
        });
        var win_width = $('body').width()
            if(win_width <= 370){
                $('.col-res').css({
                    'width': '302px !important'
                });
                $(' #iframeCalculatorBox').css({
                    'width': 'auto !important'
                });    
                  console.log($('.col-res'));    
            }
        $('body').resize(function(){
            if(win_width <= 370){
                //
                // $(' #iframeCalculatorBox').css({
                //     'width': 'auto !important'
                // }); 
                 $('.col-res').css({
                    'width': '302px !important'
                });
                $(' #iframeCalculatorBox').css({
                    'width': 'auto !important'
                });    
                console.log($('.col-res'));    
            }
        });

    });
</script>
