
   <link href="<?=$this->template->Css()?>informer.css" rel="stylesheet">

  <script type="text/javascript">
        $(document).ready(function () {
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

            });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
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
    <style>
        #col1,#col-a1,#col-b1,#col-c1
        {
            display: none;
        }
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
    </style>
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
        });
        
        
        
        
        
        
        
        
// iframe         
 
 function checkInteger(dataString)
 {
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
    setIfromaVal();
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
    
<script type="text/javascript" language="JavaScript">
 
    
    
//function itemsUp(name)
//{$('select[name='+name+'] option:selected').each(function(){$(this).insertBefore($(this).prev());});}
//function itemsDown(name)
//{$('select[name='+name+'] option:selected').each(function(){$(this).insertAfter($(this).next());});}
//function itemsMove(from,to)
//{obj=$('select[name='+from+'] option:selected');$('select[name='+to+']').append(obj);}
//function writeIt(id,text)
//{if(document.getElementById)
//{x=document.getElementById(id);x.innerHTML=text;}
//else if(document.all)
//{x=document.all[id];x.innerHTML=text;}
//else if(document.layers)
//{x=document.layers[id];x.document.open();x.document.write(text);x.document.close();}}
//function GetHeightInformer()
//{var h_b=0;var countTicker=document.layout.select_ticker.childElementCount;if(countTicker==0)countTicker=10;return(121+countTicker*23);}
//function iframe_update(url,params,width)
//{var sz=$('#ws').text();if(width<sz)
//{width=sz;}
//var htmlIframe='<!-- InstaForex--><iframe src="'+'https://informers.instaforex.com/'+url+'/'+params+'&t=i&i=1'+'" frameborder="0" width="'+width+'" height="'+GetHeightInformer()+'" scrolling="no" title="InstaForex is a universal Forex portal for traders"></iframe><noframes><a href="https://www.instaforex.com/">InstaForex portal</a></noframes><!-- InstaForex-->';var htmlPhp='<!-- InstaForex--><? echo file_get_contents("https://informers.instaforex.com/'+url+'/'+params+'&t=p&i=1'+'"); ?><!-- InstaForex-->';writeIt('sampleimage','<center>Updating ...</center>');writeIt('sampleimage','<center>'+htmlIframe+'</center>');document.layout2.body_samplecode.value=htmlIframe;b=$('input[name=br]:radio').filter(":checked").val();if(b=="br")
//{$('iframe').addClass('iframeborder')}
//if(b=="br_r")
//{$('iframe').removeClass('iframeborder');}}
//function getRadioButtonValue(radio)
//{for(var i=0;i<radio.length;i++)
//if(radio[i].checked){break;}
//return radio[i].value;}
//function getSelectedList(select)
//{var list='';var count=0;for(var i=0;i<select.length;i++)
//{if(count>0)list+='~';list+=''+select[i].value;count++;}
//list=list.replace(/#/g,"_");return list;}
//function widthTools()
//{if($(window).width()>1573){$('#tools').width(1020);}else{$('#tools').width(500);}}
//$(document).ready(function()
//{$(window).resize(function()
//{widthTools();});widthTools();colorSelector1_val='ff0000';colorSelector2_val='ffffff';colorSelector3_val='000000';$('#colorSelector1 div').css('backgroundColor','#'+colorSelector1_val);$('#colorSelector2 div').css('backgroundColor','#'+colorSelector2_val);$('#colorSelector3 div').css('backgroundColor','#'+colorSelector3_val);$('input[name=type_logo]:radio').change(function(){var v=$(this).filter(":checked").val();if(v=="small")
//{$('#ws').text('180');}
//if(v=="big")
//{$('#ws').text('230');}});$('input[name=akwidth]').change(function(){var sz=$('#ws').text();if($(this).val()<sz){$(this).val(sz)}
//if($(this).val()>300){$(this).val(300)}});$('textarea[name=body_samplecode]').click(function(){$(this).select();});$('textarea[name=php_samplecode]').click(function(){$(this).select();});$('input[name=part_code]').keypress(function(e)
//{if(!(e.which==8||e.which==0||(65<=e.which&&e.which<=65+25)||(97<=e.which&&e.which<=97+25)))return false;});$(function(){$("#tabs").tabs();});})</script>    
    
    
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
                        <!-- <div class="ins-tabs quotes-tab">
                            <ul role="tablist">
                                <li role="presentation"><a href="#tab1" class="ins-active" aria-controls="tab1" role="tab" data-toggle="tab" id="t1">Online Quotes</a></li>
                                <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" id="t2">ForexMart News</a></li>
                                <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" id="t3">Ticker</a></li>
                                <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab" id="t4">Graphic Button</a></li>
                            </ul><div class="clearfix"></div>
                        </div> -->
                        <?= $widget_informers_tab?>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <div class="quotes-holder">
                                    <div class="quotes">
                                        <h1>Forex Major</h1>
                                        <div class="panel panel-default">
                                            <div class="panel-heading quotes-heading">
                                                <img src="<?= $this->template->Images()?>logo.png" class="informer-logo img-responsive">
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped quotes-table">
                                                    <tr>
                                                        <th colspan="5">Forex Major</th>
                                                    </tr>
                                                    <tbody>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">EURUSD</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">GBPUSD</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">USDJPY</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">USDCHF</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">USDCAD</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">EURJPY</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">EURCHF</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">GBPJPY</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                                                            <td class="currency">GBPCHF</td>
                                                            <td><button class="btn-buy"> Buy</button></td>
                                                            <td>1.1332</td>
                                                            <td>1.1335</td>
                                                            <td><button class="btn-sell"> Sell</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-footer quotes-footer">Powered by ForexMart</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="install-holder">
                                    <a class="install-a" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse2" id="col">
                                        <h1 class="install-sub">Install Forex Major <span class="plus-sign">[+]</span></h1>
                                    </a>
                                    <a class="install-a" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse2" id="col1">
                                        <h1 class="install-sub">Install Forex Major <span class="minus-sign">[-]</span></h1>
                                    </a>
                                    <div class="row collapse" id="collapse1">
                                        <div class="col-md-5 col-sm-5">
                                            <h2 class="install-text">Settings</h2>
                                            <div class="install-settings-holder">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Width:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="majorinputwidth" class="form-control round-0 width-text" placeholder="280-380">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Choose tickers:</label>
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
                                                    <label class="col-xs-6 install-fields">Header background colour:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" id="hdbgcolor" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-3 install-fields">Font header:</label>
                                                    <div class="col-xs-9">
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
                                                            <input type="color" class="colorpicker" value="#FFFFFF" id="fhtextcolor">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-3 install-fields">Font row:</label>
                                                    <div class="col-xs-9">
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
                                                                <option value="11" selected="selected" >11 px</option>
                                                                <option value="12">12 px</option>
                                                                <option value="14">14 px</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <input type="color" class="colorpicker" value="#000000" id="tdlisttextcolor">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-apply-holder">
                                                    <button class="btn-apply" id="saveIframe">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h2 class="install-text">Informer preview</h2>
                                            <div class="preview-holder" id="iframmajorbox">
                                                <iframe id="iframetag" src="<?=  base_url('partnership/informerMajorIframe')?>?width=300&tdfcol=000&tdfsize=11&tdfont=sans-serif&hfcol=fff&hfsize=14&hfont=sans-serif&hbg=2f8bcb&tickers=" style="border: none;height:48vh; width:355px" ></iframe> 
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <h2 class="install-text">Code to insert</h2>
                                            <div class="code-holder">
                                                <p class="code-text">
                                                    Quotes are automatically updated once in 30s.<br>
                                                    Sample code. Insert it in the page body (between < body > and < /body >)
                                                </p>
                                                <h1 class="code-sub">IFRAME version</h1>
                                                <textarea rows="4" id="iframevalue" onfocus="this.select();" class="form-control round-0 iframe-text">sample</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab2">
                                <div class="col-lg-12">
                                    <h1 class="license-title">Economic Calendar</h1>
                                    <div class="calendar-holder">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="calendar-nav">
                                                    <ul role="tablist" class="queue-tab-list">
                                                        <li role="presentation"><a href="#tabs1" aria-controls="tabs1" role="tab" data-toggle="tab" id="t1">Yesterday</a></li>
                                                        <li role="presentation"><a href="#tabs2" aria-controls="tabs2" role="tab" data-toggle="tab" id="t2">Today</a></li>
                                                        <li role="presentation"><a href="#tabs3" aria-controls="tabs3" role="tab" data-toggle="tab" id="t3">Tomorrow</a></li>
                                                        <li role="presentation"><a href="#tabs4" aria-controls="tabs4" role="tab" data-toggle="tab" id="t4">This Week</a></li>
                                                        <li role="presentation"><a href="#tabs5" aria-controls="tabs5" role="tab" data-toggle="tab" id="t5">Next Week</a></li>
                                                        <li role="presentation"><a href="#"><i class="fa fa-calendar"></i></a></li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="dropdown calendar-drp">
                                                    <a class="drp-cur-time" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-clock-o"></i> Current Time: 01:32 (GMT - 5:00)
                                                        <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                        <li><a href="#">Sample</a></li>
                                                        <li><a href="#">Sample</a></li>
                                                        <li><a href="#">Sample</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="calendar-filter-holder">
                                                    <a class="calendar-filter" href="#" data-toggle="modal" data-target="#esFilter"><i class="fa fa-filter"></i> Filter</a>
                                                    <p>
                                                        All data are streaming and updated automatically.
                                                    </p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="tabs1">
                                                <div class="table-responsive">
                                                    <table class="table table-stripped calendar-tab table-hover"> 
                                                        <thead>
                                                        <tr>
                                                            <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                                            <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                                            <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                                            <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                                            <th class="ec-actual"><?=lang('cal_14');?></th>
                                                            <th class="ec-forecast"><?=lang('cal_15');?></th>
                                                            <th class="ec-prev"><?=lang('cal_16');?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Monday, August 24, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>prelim-release.png" class="prelim-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>revised-release.png" class="revised-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>speech.png" class="speech"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag us"></i> <span class="country-cur">USD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag gb"></i> <span class="country-cur">GBP</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag hk"></i> <span class="country-cur">HKD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ru"></i> <span class="country-cur">RUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ca"></i> <span class="country-cur">CAD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag br"></i> <span class="country-cur">BRL</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag nz"></i> <span class="country-cur">NZD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag cn"></i> <span class="country-cur">CNY</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tabs2">
                                                <div class="table-responsive">
                                                    <table class="table table-stripped calendar-tab table-hover"> 
                                                        <thead>
                                                        <tr>
                                                            <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                                            <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                                            <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                                            <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                                            <th class="ec-actual"><?=lang('cal_14');?></th>
                                                            <th class="ec-forecast"><?=lang('cal_15');?></th>
                                                            <th class="ec-prev"><?=lang('cal_16');?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Tuesday, August 25, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>prelim-release.png" class="prelim-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>revised-release.png" class="revised-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>speech.png" class="speech"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag us"></i> <span class="country-cur">USD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag gb"></i> <span class="country-cur">GBP</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag hk"></i> <span class="country-cur">HKD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ru"></i> <span class="country-cur">RUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ca"></i> <span class="country-cur">CAD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tabs3">
                                                <div class="table-responsive">
                                                    <table class="table table-stripped calendar-tab table-hover"> 
                                                        <thead>
                                                        <tr>
                                                            <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                                            <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                                            <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                                            <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                                            <th class="ec-actual"><?=lang('cal_14');?></th>
                                                            <th class="ec-forecast"><?=lang('cal_15');?></th>
                                                            <th class="ec-prev"><?=lang('cal_16');?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Wednesday, August 26, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7">No Records.</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tabs4">
                                                <div class="table-responsive">
                                                    <table class="table table-stripped calendar-tab table-hover"> 
                                                        <thead>
                                                        <tr>
                                                            <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                                            <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                                            <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                                            <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                                            <th class="ec-actual"><?=lang('cal_14');?></th>
                                                            <th class="ec-forecast"><?=lang('cal_15');?></th>
                                                            <th class="ec-prev"><?=lang('cal_16');?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                                <td colspan="7" class="ec-date">Friday, August 28, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7">No Records.</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Thursday, August 27, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7">No Records.</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Wednesday, August 26, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7">No Records.</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Tuesday, August 25, 2015</td>
                                                            </tr>

                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag us"></i> <span class="country-cur">USD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag gb"></i> <span class="country-cur">GBP</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag hk"></i> <span class="country-cur">HKD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ru"></i> <span class="country-cur">RUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ca"></i> <span class="country-cur">CAD</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>prelim-release.png" class="prelim-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>revised-release.png" class="revised-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>speech.png" class="speech"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Monday, August 24, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>prelim-release.png" class="prelim-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag ch"></i> <span class="country-cur">CHF</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>revised-release.png" class="revised-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag eu"></i> <span class="country-cur">EUR</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>speech.png" class="speech"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tabs5">
                                                <div class="table-responsive">
                                                    <table class="table table-stripped calendar-tab table-hover"> 
                                                        <thead>
                                                        <tr>
                                                            <th class="ec-time"><?=lang('tbl_th_1');?></th>
                                                            <th class="ec-cur"><?=lang('tbl_th_2');?></th>
                                                            <th class="ec-imp"><?=lang('tbl_th_3');?></th>
                                                            <th class="ec-events"><?=lang('tbl_th_4');?></th>
                                                            <th class="ec-actual"><?=lang('cal_14');?></th>
                                                            <th class="ec-forecast"><?=lang('cal_15');?></th>
                                                            <th class="ec-prev"><?=lang('cal_16');?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7" class="ec-date">Tuesday, August 25, 2015</td>
                                                            </tr>
                                                            <tr>
                                                                <td>01: 00</td>
                                                                <td class="f32"><i class="flag jp"></i> <span class="country-cur">JPY</span></td>
                                                                <td>
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a href="#" data-toggle="modal" data-target="#event" class="calendar-events">Sample Event</a> <a href="#"><img src="<?= $this->template->Images()?>prelim-release.png" class="prelim-release"></a></td>
                                                                <td></td>
                                                                <td>107.2</td>
                                                                <td>107.2</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <label class="number">Number of records shown per page</label>
                                                        <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                                                    </div>
                                                    <button type="submit" class="btn btn-default round-0">Go</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6 calendar-pagination">
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
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="main-legend-holder">
                                                    <h1 class="legend-title">Legend</h1>
                                                    <div class="legend1-holder">
                                                        <ul>
                                                            <li><span class="span"><img src="<?= $this->template->Images()?>speech.png" class="speech-size"></span> Speech</li>
                                                            <li><span class="span"><img src="<?= $this->template->Images()?>prelim-release.png"></span> Preliminary Release</li>
                                                            <li><span class="span"><img src="<?= $this->template->Images()?>revised-release.png"></span> Revised Release</li>
                                                        </ul>
                                                    </div>
                                                    <div class="legend1-holder legend2">
                                                        <ul>
                                                            <li>
                                                                <span class="span1">
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-low low" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                Low Volatility Expected
                                                            </li>
                                                            <li>
                                                                <span class="span1">
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-warning moderate" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                Moderate Volatility Expected
                                                            </li>
                                                            <li>
                                                                <span class="span1">
                                                                    <div class="progress calendar-progress">
                                                                        <div class="progress-bar progress-bar-danger high" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="">
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                High Volatility Expected
                                                            </li>
                                                        </ul>
                                                    </div><div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><div class="clearfix"></div>
                                <div class="install-holder">
                                    <a class="install-a" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" id="col-a">
                                        <h1 class="install-sub">Install Economic Calendar <span class="plus-sign">[+]</span></h1>
                                    </a>
                                    <a class="install-a" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" id="col-a1">
                                        <h1 class="install-sub">Install Economic Calendar <span class="minus-sign">[-]</span></h1>
                                    </a>
                                    <div class="row collapse" id="collapse2">
                                        <div class="col-md-5 col-sm-5">
                                            <h2 class="install-text">Settings</h2>
                                            <div class="install-settings-holder">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 install-fields">Width:</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control round-0 width-text txtnews" placeholder="230-300">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 install-fields">Time zones:</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control round-0 txtnews">
                                                            <option>London</option>
                                                            <option>Lougetown</option>
                                                            <option>Dressrosa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 install-fields">Number of news articles:</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control round-0 int-width txtnews">
                                                            <option>5</option>
                                                            <option>10</option>
                                                            <option>15</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Border:</label>
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
                                                    <label class="col-sm-3 install-fields">Rounding:</label>
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
                                                    <label class="col-sm-3 install-fields">Shadow:</label>
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
                                                    <label class="col-xs-6 install-fields">Background Header:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Background Body News:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Background Footer:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Links:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Color Lines:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 install-fields">Header Text:</label>
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
                                                    <label class="col-sm-4 install-fields">Date of News:</label>
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
                                                    <label class="col-sm-4 install-fields">Text News:</label>
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
                                                    <label class="col-sm-4 install-fields">Footer Text:</label>
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
                                                    <label class="col-sm-4 install-fields">Shadow:</label>
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
                                                    <button class="btn-apply">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <h2 class="install-text">Code to insert</h2>
                                            <div class="code-holder">
                                                <p class="code-text">
                                                    Quotes are automatically updated once in 30s.<br>
                                                    Sample code. Insert it in the page body (between < body > and < /body >)
                                                </p>
                                                <h1 class="code-sub">IFRAME version</h1>
                                                <textarea rows="4" class="form-control round-0 iframe-text">sample</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab3">
                                <div class="ticker-holder row quotes-holder">
                                    <div class="col-md-5 col-centered">
                                        <div class="panel panel-default ticker-panel">
                                            <div class="panel-heading ticker-heading">
                                                Currency Converter
                                            </div>
                                            <div class="panel-body">
                                                <div class="informer-converter-holder">
                                                    <label class="amount-label">CURRENCY I HAVE:</label>
                                                    <div class="converter-drp">
                                                        <div class="cur-choice f16" id="drp-cur">
                                                            <i class="flag ph flags" id="cur-flag"></i> <span id="cur-val">Philippines</span> <i class="fa fa-caret-down caret-down"></i>
                                                        </div><div class="clearfix"></div>
                                                        <div class="cur-list-holder" id="cur-list-holder">
                                                            <div class="cur-search-holder">
                                                                <input type="text" class="form-control round-0" placeholder="Type to search...">
                                                            </div>
                                                            <ul class="cur-list" id="curlist">
                                                                <li class="f16"><i class="flag al flags"></i> Albania</li>
                                                                <li class="f16"><i class="flag af flags"></i> Afghanistan</li>
                                                                <li class="f16"><i class="flag ar flags"></i> Argentina</li>
                                                                <li class="f16"><i class="flag aw flags"></i> Aruba</li>
                                                                <li class="f16"><i class="flag au flags"></i> Australia</li>
                                                                <li class="f16"><i class="flag az flags"></i> Azerbaijan</li>
                                                                <li class="f16"><i class="flag bs flags"></i> Bahamas</li>
                                                                <li class="f16"><i class="flag bb flags"></i> Barbados</li>
                                                                <li class="f16"><i class="flag by flags"></i> Belarus</li>
                                                                <li class="f16"><i class="flag bz flags"></i> Belize</li>
                                                                <li class="f16"><i class="flag bm flags"></i> Bermuda</li>
                                                                <li class="f16"><i class="flag bo flags"></i> Bolivia</li>
                                                                <li class="f16"><i class="flag ba flags"></i> Bosnia and Herzegovina</li>
                                                                <li class="f16"><i class="flag bw flags"></i> Botswana</li>
                                                                <!-- <li class="f16"><i class="flag bg flags"></i> Bulgaria</li> -->
                                                                <li class="f16"><i class="flag br flags"></i> Brazil</li>
                                                                <li class="f16"><i class="flag bn flags"></i> Brunei</li>
                                                                <li class="f16"><i class="flag kh flags"></i> Cambodia</li>
                                                                <li class="f16"><i class="flag ca flags"></i> Canada</li>
                                                                <li class="f16"><i class="flag ky flags"></i> Cayman</li>
                                                                <li class="f16"><i class="flag cl flags"></i> Chile</li>
                                                                <li class="f16"><i class="flag cn flags"></i> China</li>
                                                                <li class="f16"><i class="flag co flags"></i> Colombia</li>
                                                                <li class="f16"><i class="flag cr flags"></i> Costa Rica</li>
                                                                <li class="f16"><i class="flag hr flags"></i> Croatia</li>
                                                                <li class="f16"><i class="flag cu flags"></i> Cuba</li>
                                                                <li class="f16"><i class="flag cs flags"></i> Czech Republic</li>
                                                                <li class="f16"><i class="flag dk flags"></i> Denmark</li>
                                                                <li class="f16"><i class="flag do flags"></i> Dominican Republic</li>
                                                                <li class="f16"><i class="flag none flags"></i> East Caribbean</li>
                                                                <li class="f16"><i class="flag eg flags"></i> Egypt</li>
                                                                <li class="f16"><i class="flag sv flags"></i> El Salvador</li>
                                                                <li class="f16"><i class="flag ee flags"></i> Estonia</li>
                                                                <li class="f16"><i class="flag eu flags"></i> Euro Member</li>
                                                                <li class="f16"><i class="flag fk flags"></i> Falkland Islands</li>
                                                                <li class="f16"><i class="flag fj flags"></i> Fiji</li>
                                                                <li class="f16"><i class="flag gh flags"></i> Ghana</li>
                                                                <li class="f16"><i class="flag gi flags"></i> Gibraltar</li>
                                                                <li class="f16"><i class="flag gt flags"></i> Guatemala</li>
                                                                <li class="f16"><i class="flag gg flags"></i> Guernsey</li>
                                                                <li class="f16"><i class="flag gy flags"></i> Guyana</li>
                                                                <li class="f16"><i class="flag hn flags"></i> Honduras</li>
                                                                <li class="f16"><i class="flag hk flags"></i> Hong Kong</li>
                                                                <li class="f16"><i class="flag hu flags"></i> Hungary</li>
                                                                <li class="f16"><i class="flag is flags"></i> Iceland</li>
                                                                <li class="f16"><i class="flag in flags"></i> India</li>
                                                                <li class="f16"><i class="flag id flags"></i> Indonesia</li>
                                                                <li class="f16"><i class="flag ir flags"></i> Iran</li>
                                                                <li class="f16"><i class="flag im flags"></i> Isle of Man</li>
                                                                <li class="f16"><i class="flag il flags"></i> Israel</li>
                                                                <li class="f16"><i class="flag jm flags"></i> Jamaica</li>
                                                                <li class="f16"><i class="flag jp flags"></i> Japan</li>
                                                                <li class="f16"><i class="flag je flags"></i> Jersey</li>
                                                                <li class="f16"><i class="flag kz flags"></i> Kazakhstan</li>
                                                                <li class="f16"><i class="flag kp flags"></i> North Korea</li>
                                                                <li class="f16"><i class="flag kr flags"></i> South Korea</li>
                                                                <li class="f16"><i class="flag kg flags"></i> Kyrgyzstan</li>
                                                                <li class="f16"><i class="flag la flags"></i> Laos</li>
                                                                <li class="f16"><i class="flag lv flags"></i> Latvia</li>
                                                                <li class="f16"><i class="flag lb flags"></i> Lebanon</li>
                                                                <li class="f16"><i class="flag lr flags"></i> Liberia</li>
                                                                <li class="f16"><i class="flag lt flags"></i> Lithuania</li>
                                                                <li class="f16"><i class="flag mk flags"></i> Macedonia</li>
                                                                <li class="f16"><i class="flag my flags"></i> Malaysia</li>
                                                                <li class="f16"><i class="flag mu flags"></i> Mauritius</li>
                                                                <li class="f16"><i class="flag mx flags"></i> Mexico</li>
                                                                <li class="f16"><i class="flag mn flags"></i> Mongolia</li>
                                                                <li class="f16"><i class="flag mz flags"></i> Mozambique</li>
                                                                <li class="f16"><i class="flag na flags"></i> Namibia</li>
                                                                <li class="f16"><i class="flag np flags"></i> Nepal</li>
                                                                <li class="f16"><i class="flag bq flags"></i> Netherlands</li>
                                                                <li class="f16"><i class="flag nz flags"></i> New Zealand</li>
                                                                <li class="f16"><i class="flag ni flags"></i> Nicaragua</li>
                                                                <li class="f16"><i class="flag ng flags"></i> Nigeria</li>
                                                                <li class="f16"><i class="flag no flags"></i> Norway</li>
                                                                <li class="f16"><i class="flag om flags"></i> Oman</li>
                                                                <li class="f16"><i class="flag pk flags"></i> Pakistan</li>
                                                                <li class="f16"><i class="flag pa flags"></i> Panama</li>
                                                                <li class="f16"><i class="flag py flags"></i> Paraguay</li>
                                                                <li class="f16"><i class="flag pe flags"></i> Peru</li>
                                                                <li class="f16"><i class="flag ph flags"></i> Philippines</li>
                                                                <li class="f16"><i class="flag pl flags"></i> Poland</li>
                                                                <li class="f16"><i class="flag qa flags"></i> Qatar</li>
                                                                <li class="f16"><i class="flag ro flags"></i> Romania</li>
                                                                <li class="f16"><i class="flag ru flags"></i> Russia</li>
                                                                <li class="f16"><i class="flag sh flags"></i> Saint Helena</li>
                                                                <li class="f16"><i class="flag sa flags"></i> Saudi Arabia</li>
                                                                <li class="f16"><i class="flag rs flags"></i> Serbia</li>
                                                                <li class="f16"><i class="flag sc flags"></i> Seychelles</li>
                                                                <li class="f16"><i class="flag sg flags"></i> Singapore</li>
                                                                <li class="f16"><i class="flag sb flags"></i> Solomon Islands</li>
                                                                <li class="f16"><i class="flag so flags"></i> Somalia</li>
                                                                <li class="f16"><i class="flag za flags"></i> South Africa</li>
                                                                <li class="f16"><i class="flag lk flags"></i> Sri Lanka</li>
                                                                <li class="f16"><i class="flag se flags"></i> Sweden</li>
                                                                <li class="f16"><i class="flag ch flags"></i> Switzerland</li>
                                                                <li class="f16"><i class="flag sr flags"></i> Suriname</li>
                                                                <li class="f16"><i class="flag sy flags"></i> Syria</li>
                                                                <li class="f16"><i class="flag tw flags"></i> Taiwan</li>
                                                                <li class="f16"><i class="flag th flags"></i> Thailand</li>
                                                                <li class="f16"><i class="flag tt flags"></i> Trinidad and Tobago</li>
                                                                <li class="f16"><i class="flag tr flags"></i> Turkey</li>
                                                                <li class="f16"><i class="flag tv flags"></i> Tuvalu</li>
                                                                <li class="f16"><i class="flag ua flags"></i> Ukraine</li>
                                                                <li class="f16"><i class="flag gb flags"></i> United Kingdom</li>
                                                                <li class="f16"><i class="flag us flags"></i> United States</li>
                                                                <li class="f16"><i class="flag uy flags"></i> Uruguay</li>
                                                                <li class="f16"><i class="flag uz flags"></i> Uzbekistan</li>
                                                                <li class="f16"><i class="flag ve flags"></i> Venezuela</li>
                                                                <li class="f16"><i class="flag vn flags"></i> Vietnam</li>
                                                                <li class="f16"><i class="flag ye flags"></i> Yemen</li>
                                                                <li class="f16"><i class="flag zw flags"></i> Zimbabwe</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="amount-holder">
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="amount-label">AMOUNT:</label>
                                                                <input type="text" class="form-control round-0 cur-amount" id="" placeholder="">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="converter-switch-holder">
                                                    <div class="btn-switch-holder informer-btn-switch-holder">
                                                        <button class="btn-switch"><i class="fa fa-caret-left sleft"></i><i class="fa fa-caret-right sright"></i></button>
                                                    </div>
                                                </div>
                                                <div class="informer-converter-holder">
                                                    <label class="amount-label">CURRENCY I WANT:</label>
                                                    <div class="converter-drp">
                                                        <div class="cur-choice f16" id="drp-cur1">
                                                            <i class="flag jp flags" id="cur-flag1"></i> <span id="cur-val1">Japan</span> <i class="fa fa-caret-down caret-down"></i>
                                                        </div><div class="clearfix"></div>
                                                        <div class="cur-list-holder" id="cur-list-holder1">
                                                            <div class="cur-search-holder">
                                                                <input type="text" class="form-control round-0" placeholder="Type to search...">
                                                            </div>
                                                            <ul class="cur-list" id="curlist1">
                                                                <li class="f16"><i class="flag al flags"></i> Albania</li>
                                                                <li class="f16"><i class="flag af flags"></i> Afghanistan</li>
                                                                <li class="f16"><i class="flag ar flags"></i> Argentina</li>
                                                                <li class="f16"><i class="flag aw flags"></i> Aruba</li>
                                                                <li class="f16"><i class="flag au flags"></i> Australia</li>
                                                                <li class="f16"><i class="flag az flags"></i> Azerbaijan</li>
                                                                <li class="f16"><i class="flag bs flags"></i> Bahamas</li>
                                                                <li class="f16"><i class="flag bb flags"></i> Barbados</li>
                                                                <li class="f16"><i class="flag by flags"></i> Belarus</li>
                                                                <li class="f16"><i class="flag bz flags"></i> Belize</li>
                                                                <li class="f16"><i class="flag bm flags"></i> Bermuda</li>
                                                                <li class="f16"><i class="flag bo flags"></i> Bolivia</li>
                                                                <li class="f16"><i class="flag ba flags"></i> Bosnia and Herzegovina</li>
                                                                <li class="f16"><i class="flag bw flags"></i> Botswana</li>
                                                                <!-- <li class="f16"><i class="flag bg flags"></i> Bulgaria</li> -->
                                                                <li class="f16"><i class="flag br flags"></i> Brazil</li>
                                                                <li class="f16"><i class="flag bn flags"></i> Brunei</li>
                                                                <li class="f16"><i class="flag kh flags"></i> Cambodia</li>
                                                                <li class="f16"><i class="flag ca flags"></i> Canada</li>
                                                                <li class="f16"><i class="flag ky flags"></i> Cayman</li>
                                                                <li class="f16"><i class="flag cl flags"></i> Chile</li>
                                                                <li class="f16"><i class="flag cn flags"></i> China</li>
                                                                <li class="f16"><i class="flag co flags"></i> Colombia</li>
                                                                <li class="f16"><i class="flag cr flags"></i> Costa Rica</li>
                                                                <li class="f16"><i class="flag hr flags"></i> Croatia</li>
                                                                <li class="f16"><i class="flag cu flags"></i> Cuba</li>
                                                                <li class="f16"><i class="flag cs flags"></i> Czech Republic</li>
                                                                <li class="f16"><i class="flag dk flags"></i> Denmark</li>
                                                                <li class="f16"><i class="flag do flags"></i> Dominican Republic</li>
                                                                <li class="f16"><i class="flag none flags"></i> East Caribbean</li>
                                                                <li class="f16"><i class="flag eg flags"></i> Egypt</li>
                                                                <li class="f16"><i class="flag sv flags"></i> El Salvador</li>
                                                                <li class="f16"><i class="flag ee flags"></i> Estonia</li>
                                                                <li class="f16"><i class="flag eu flags"></i> Euro Member</li>
                                                                <li class="f16"><i class="flag fk flags"></i> Falkland Islands</li>
                                                                <li class="f16"><i class="flag fj flags"></i> Fiji</li>
                                                                <li class="f16"><i class="flag gh flags"></i> Ghana</li>
                                                                <li class="f16"><i class="flag gi flags"></i> Gibraltar</li>
                                                                <li class="f16"><i class="flag gt flags"></i> Guatemala</li>
                                                                <li class="f16"><i class="flag gg flags"></i> Guernsey</li>
                                                                <li class="f16"><i class="flag gy flags"></i> Guyana</li>
                                                                <li class="f16"><i class="flag hn flags"></i> Honduras</li>
                                                                <li class="f16"><i class="flag hk flags"></i> Hong Kong</li>
                                                                <li class="f16"><i class="flag hu flags"></i> Hungary</li>
                                                                <li class="f16"><i class="flag is flags"></i> Iceland</li>
                                                                <li class="f16"><i class="flag in flags"></i> India</li>
                                                                <li class="f16"><i class="flag id flags"></i> Indonesia</li>
                                                                <li class="f16"><i class="flag ir flags"></i> Iran</li>
                                                                <li class="f16"><i class="flag im flags"></i> Isle of Man</li>
                                                                <li class="f16"><i class="flag il flags"></i> Israel</li>
                                                                <li class="f16"><i class="flag jm flags"></i> Jamaica</li>
                                                                <li class="f16"><i class="flag jp flags"></i> Japan</li>
                                                                <li class="f16"><i class="flag je flags"></i> Jersey</li>
                                                                <li class="f16"><i class="flag kz flags"></i> Kazakhstan</li>
                                                                <li class="f16"><i class="flag kp flags"></i> North Korea</li>
                                                                <li class="f16"><i class="flag kr flags"></i> South Korea</li>
                                                                <li class="f16"><i class="flag kg flags"></i> Kyrgyzstan</li>
                                                                <li class="f16"><i class="flag la flags"></i> Laos</li>
                                                                <li class="f16"><i class="flag lv flags"></i> Latvia</li>
                                                                <li class="f16"><i class="flag lb flags"></i> Lebanon</li>
                                                                <li class="f16"><i class="flag lr flags"></i> Liberia</li>
                                                                <li class="f16"><i class="flag lt flags"></i> Lithuania</li>
                                                                <li class="f16"><i class="flag mk flags"></i> Macedonia</li>
                                                                <li class="f16"><i class="flag my flags"></i> Malaysia</li>
                                                                <li class="f16"><i class="flag mu flags"></i> Mauritius</li>
                                                                <li class="f16"><i class="flag mx flags"></i> Mexico</li>
                                                                <li class="f16"><i class="flag mn flags"></i> Mongolia</li>
                                                                <li class="f16"><i class="flag mz flags"></i> Mozambique</li>
                                                                <li class="f16"><i class="flag na flags"></i> Namibia</li>
                                                                <li class="f16"><i class="flag np flags"></i> Nepal</li>
                                                                <li class="f16"><i class="flag bq flags"></i> Netherlands</li>
                                                                <li class="f16"><i class="flag nz flags"></i> New Zealand</li>
                                                                <li class="f16"><i class="flag ni flags"></i> Nicaragua</li>
                                                                <li class="f16"><i class="flag ng flags"></i> Nigeria</li>
                                                                <li class="f16"><i class="flag no flags"></i> Norway</li>
                                                                <li class="f16"><i class="flag om flags"></i> Oman</li>
                                                                <li class="f16"><i class="flag pk flags"></i> Pakistan</li>
                                                                <li class="f16"><i class="flag pa flags"></i> Panama</li>
                                                                <li class="f16"><i class="flag py flags"></i> Paraguay</li>
                                                                <li class="f16"><i class="flag pe flags"></i> Peru</li>
                                                                <li class="f16"><i class="flag ph flags"></i> Philippines</li>
                                                                <li class="f16"><i class="flag pl flags"></i> Poland</li>
                                                                <li class="f16"><i class="flag qa flags"></i> Qatar</li>
                                                                <li class="f16"><i class="flag ro flags"></i> Romania</li>
                                                                <li class="f16"><i class="flag ru flags"></i> Russia</li>
                                                                <li class="f16"><i class="flag sh flags"></i> Saint Helena</li>
                                                                <li class="f16"><i class="flag sa flags"></i> Saudi Arabia</li>
                                                                <li class="f16"><i class="flag rs flags"></i> Serbia</li>
                                                                <li class="f16"><i class="flag sc flags"></i> Seychelles</li>
                                                                <li class="f16"><i class="flag sg flags"></i> Singapore</li>
                                                                <li class="f16"><i class="flag sb flags"></i> Solomon Islands</li>
                                                                <li class="f16"><i class="flag so flags"></i> Somalia</li>
                                                                <li class="f16"><i class="flag za flags"></i> South Africa</li>
                                                                <li class="f16"><i class="flag lk flags"></i> Sri Lanka</li>
                                                                <li class="f16"><i class="flag se flags"></i> Sweden</li>
                                                                <li class="f16"><i class="flag ch flags"></i> Switzerland</li>
                                                                <li class="f16"><i class="flag sr flags"></i> Suriname</li>
                                                                <li class="f16"><i class="flag sy flags"></i> Syria</li>
                                                                <li class="f16"><i class="flag tw flags"></i> Taiwan</li>
                                                                <li class="f16"><i class="flag th flags"></i> Thailand</li>
                                                                <li class="f16"><i class="flag tt flags"></i> Trinidad and Tobago</li>
                                                                <li class="f16"><i class="flag tr flags"></i> Turkey</li>
                                                                <li class="f16"><i class="flag tv flags"></i> Tuvalu</li>
                                                                <li class="f16"><i class="flag ua flags"></i> Ukraine</li>
                                                                <li class="f16"><i class="flag gb flags"></i> United Kingdom</li>
                                                                <li class="f16"><i class="flag us flags"></i> United States</li>
                                                                <li class="f16"><i class="flag uy flags"></i> Uruguay</li>
                                                                <li class="f16"><i class="flag uz flags"></i> Uzbekistan</li>
                                                                <li class="f16"><i class="flag ve flags"></i> Venezuela</li>
                                                                <li class="f16"><i class="flag vn flags"></i> Vietnam</li>
                                                                <li class="f16"><i class="flag ye flags"></i> Yemen</li>
                                                                <li class="f16"><i class="flag zw flags"></i> Zimbabwe</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="amount-holder">
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="amount-label">AMOUNT OF CONVERSION:</label>
                                                                <input type="text" class="form-control round-0 cur-amount" id="" placeholder="">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="cur-datepicker-holder">
                                                        <form class="form-inline">
                                                            <div class="form-group">
                                                                <label for="">INTERBANK +/-</label>
                                                                <select class="form-control round-0">
                                                                    <option>+/-0%</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">DATE:</label>
                                                                <input type="text" class="form-control round-0" id="" placeholder="">
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
                            <div role="tabpanel" class="tab-pane" id="tab4">
                                <div class="row quotes-holder">
                                    <div class="col-md-5 col-centered">
                                        <div class="panel panel-default ticker-panel">
                                            <div class="panel-heading ticker-heading">
                                                Calculator
                                            </div>
                                            <div class="panel-body">
                                                <form>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Currency Pair:</label>
                                                        <select class="form-control round-0">
                                                            <option>USD/JPY</option>
                                                            <option>USD/CHF</option>
                                                            <option>USD/CAD</option>
                                                            <option>AUD/USD</option>
                                                            <option>NZD/USD</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Leverage:</label>
                                                        <select class="form-control round-0">
                                                            <option>1:1</option>
                                                            <option>1:2</option>
                                                            <option>1:3</option>
                                                            <option>1:5</option>
                                                            <option>1:10</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Volume (lots):</label>
                                                        <input type="text" class="form-control round-0">
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Account Currency:</label>
                                                        <select class="form-control round-0">
                                                            <option>EUR</option>
                                                            <option>USD</option>
                                                            <option>GBP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <button class="calc-btn">Calculate</button>
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Current Quote:</label>
                                                        <div class="forex-calculator-input-result"><span>120.785</span></div>
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Value of 1 PIP:</label>
                                                        <div class="forex-calculator-input-result"><span>9147</span></div>
                                                    </div>
                                                    <div class="form-group forex-calculator-child-input">
                                                        <label>Margin:</label>
                                                        <div class="forex-calculator-input-result"><span>0.76</span></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="install-holder">
                                    <a class="install-a" data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse3" id="col-c">
                                        <h1 class="install-sub">Install ForexMart Calculator <span class="plus-sign">[+]</span></h1>
                                    </a>
                                    <a class="install-a" data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse3" id="col-c1">
                                        <h1 class="install-sub">Install ForexMart Calculator <span class="minus-sign">[-]</span></h1>
                                    </a>
                                    <div class="row collapse" id="collapse4">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <h2 class="install-text">Settings</h2>
                                            <div class="install-settings-holder">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Width:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control round-0 width-text txtnews" placeholder="30-600">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Height:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control round-0 width-text txtnews" placeholder="10-100">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
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
                                                </div>
                                                <label class="left">Normal</label>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Border:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>none</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>solid</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Rounding:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Shadow:</label>
                                                    <div class="col-sm-9">
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
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>none</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Background:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-size">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="left">Hovering</label>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Border:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>none</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>solid</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Rounding:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>8</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Shadow:</label>
                                                    <div class="col-sm-9">
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
                                                        <div class="col-xs-3 font-size">
                                                            <select class="form-control round-0 fsize txtnews">
                                                                <option>none</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 font-size">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Background:</label>
                                                    <div class="col-sm-9">
                                                        <div class="col-xs-3 font-size">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                            <input type="color" class="colorpicker" value="#2988CA">
                                                        </div>
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
                                            <h2 class="install-text">Code to insert</h2>
                                            <div class="code-holder">
                                                <p class="code-text">
                                                    Quotes are automatically updated once in 30s.<br>
                                                    Sample code. Insert it in the page body (between < body > and < /body >)
                                                </p>
                                                <h1 class="code-sub">IFRAME version</h1>
                                                <textarea rows="4" class="form-control round-0 iframe-text">sample</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab5">
                            <div class="quotes-holder">
                                    <div class="quotes">
                                        <h1>ForexMart News</h1>
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
                                <div class="install-holder">
                                    <a class="install-a" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5" id="col-a">
                                        <h1 class="install-sub">Install Company News <span class="plus-sign">[+]</span></h1>
                                    </a>
                                    <a class="install-a" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5" id="col-a1">
                                        <h1 class="install-sub">Install Company News <span class="minus-sign">[-]</span></h1>
                                    </a>
                                    <div class="row collapse" id="collapse5">
                                        <div class="col-md-5 col-sm-5">
                                            <h2 class="install-text">Settings</h2>
                                            <div class="install-settings-holder">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 install-fields">Width:</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control round-0 width-text txtnews" placeholder="230-300">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 install-fields">Time zones:</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control round-0 txtnews">
                                                            <option>London</option>
                                                            <option>Lougetown</option>
                                                            <option>Dressrosa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 install-fields">Number of news articles:</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control round-0 int-width txtnews">
                                                            <option>5</option>
                                                            <option>10</option>
                                                            <option>15</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 install-fields">Border:</label>
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
                                                    <label class="col-sm-3 install-fields">Rounding:</label>
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
                                                    <label class="col-sm-3 install-fields">Shadow:</label>
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
                                                    <label class="col-xs-6 install-fields">Background Header:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Background Body News:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Background Footer:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Links:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xs-6 install-fields">Color Lines:</label>
                                                    <div class="col-xs-6">
                                                        <input type="color" class="colorpicker" value="#2988CA">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 install-fields">Header Text:</label>
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
                                                    <label class="col-sm-4 install-fields">Date of News:</label>
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
                                                    <label class="col-sm-4 install-fields">Text News:</label>
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
                                                    <label class="col-sm-4 install-fields">Footer Text:</label>
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
                                                    <label class="col-sm-4 install-fields">Shadow:</label>
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
                                                    <button class="btn-apply">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h2 class="install-text">Informer preview</h2>
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
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <h2 class="install-text">Code to insert</h2>
                                            <div class="code-holder">
                                                <p class="code-text">
                                                    Quotes are automatically updated once in 30s.<br>
                                                    Sample code. Insert it in the page body (between < body > and < /body >)
                                                </p>
                                                <h1 class="code-sub">IFRAME version</h1>
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
 
    <style>
       
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
 
    </style>