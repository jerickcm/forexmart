 <div class="IframeLoder" style=" display: none; background: #ccc none repeat scroll 0 0; height:98%; border: none; overflow: hidden; opacity: 0.8; position: absolute; text-align: center;    width: 100%;">
                                            <img  style="margin-top: 90%" src="<?= $this->template->Images()?>loder.GIF" width="36" height="36" alt="loading gif"/>
                                        </div>


<!DOCTYPE html>
<html lang="en" dir="ltr" style=" margin-top: -10px">
<head>
       
       <link href="<?= $this->template->Css()?>external-style.min.css" rel="stylesheet"> 
       <link href="<?= $this->template->Css()?>loaders.css" rel="stylesheet"> 
       <link href="<?= $this->template->Css()?>informer.css" rel="stylesheet"> 
       <link href="<?= $this->template->Css()?>flags16.css" rel="stylesheet"> 
       <link href="<?= $this->template->Css()?>font-awesome.min.css" rel="stylesheet"> 
       
       <link href="<?= $this->template->Css()?>bootstrap-datetimepicker.css" rel="stylesheet">         
       <script src="<?= $this->template->Js()?>jquery.min.js" type="text/javascript"></script>        
       <script src="<?= $this->template->Js()?>Moment.js" type="text/javascript"></script> 
       <script src="<?= $this->template->Js()?>bootstrap-datetimepicker.min.js" type="text/javascript"></script>
       <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <style>
        .panel-default, .panel-default:hover{
            border: none!important;
        }
        .panel-body{
            border:1px solid #cecece;
            height:90%!important;
        }
        .panel-body:hover{
            border: 1px solid #c3e6fe;
            /*min-height:550px!important;*/
        }
    </style>
</head>
<?php

if($values){
$row = $values->row_array();

$array = array();
foreach( explode("&",$row['value']) as $d){
    $explode = explode("=",$d);
    $array[$explode[0]] = $explode[1];
}
// width=400&hbg=ffff80&bbg=ffffff&fbg=ffffff&fs=14&fa=left&fc=008000&hfont=Open Sans

extract($array);
    $arrow=explode("_",$arrowkey);
}
/*$curenWidht=$this->input->get('curenWidht');
$curenHeight=$this->input->get('curenHeight');
$curenFont=$this->input->get('curenFont');
$curenfontSize=$this->input->get('curenfontSize');
$curenbgcolor=$this->input->get('curenbgcolor');
$curenfontColor=$this->input->get('curenfontColor');
$curenHdFont=$this->input->get('curenHdFont');
$curenHdfontSize=$this->input->get('curenHdfontSize');
$curenHdbgColor=$this->input->get('curenHdbgColor');
$curenHdfontColor=$this->input->get('curenHdfontColor');
$arrowkey=$this->input->get('arrowkey');*/



?>
 


<div class="panel panel-default ticker-panel" style="display: table; width:<?=$curenWidht?>  !important; height:<?=$curenHeight?> !important ; font-family:<?=$curenFont?> !important; font-size:<?=$curenfontSize?>px !important; color:#<?=$curenfontColor?> !important; background:#<?=$curenbgcolor?> !important ">
   
       <div class="panel-heading quotes-heading"  style="background: #c3e6fe">
            <img src="<?= $this->template->Images()?>fxlogonew.svg" class="informer-logo img-responsive">
        </div>
    <div class="panel-heading ticker-heading" style="background:#<?=$curenHdbgColor?> !important; color:#<?=$curenHdfontColor?> !important ; font-size:<?=$curenHdfontSize?>px !important ;font-family:<?=$curenHdFont?> !important ">
        Currency Converter
    </div>
    <div class="panel-body" style="height: 95%;">
        <div class="informer-converter-holder">
            <label for="" class="amount-label">CURRENCY I HAVE:</label>
            <div class="converter-drp">
                <div class="cur-choice f16" id="drp-cur">
                    <i class="flag us flags" id="cur-flag"></i> <span id="cur-val">United States</span> <i class="fa fa-caret-down caret-down"></i>
                    <input type="hidden" id="from_county_code" value="USD">
                </div><div class="clearfix"></div>
                <div class="cur-list-holder" id="cur-list-holder">
                    <div class="cur-search-holder">
                        <input type="text" class="form-control round-0" placeholder="Type to search...">
                    </div>
                    <ul class="cur-list" id="curlist">                                                               


                        <?php foreach($countries as $key=>$val){?>
                        <li class="f16 fromcurcode" rel='<?=$key?>'><i class="flag <?=$flagelist[$key]?> flags"></i><?=$val?></li>
                        <?php }?>

                    </ul>
                </div>
            </div>
            <div class="amount-holder">
                <form>
                    <div class="form-group">
                        <label for="" class="amount-label">AMOUNT:</label>
                        <input type="text" class="form-control round-0 cur-amount" id="rawAmount" placeholder="" value="1">
                    </div>
                </form>
            </div>
        </div>
        <div class="converter-switch-holder">
            <div class="btn-switch-holder informer-btn-switch-holder">
                <button class="btn-switch" style="font-size:<?=$arrow[2]?>;">
                    <i class="fa <?=isset($arrow[0])?$arrow[0]:"fa-caret-left"?> sleft"></i>
                    <i class="fa <?=isset($arrow[1])?$arrow[1]:"fa-caret-right"?> sright"></i>
                </button>
 

                
            </div>
        </div>
        <div class="informer-converter-holder">
            <label for="" class="amount-label">CURRENCY I WANT:</label>
            <div class="converter-drp">
                <div class="cur-choice f16" id="drp-cur1">
                    <i class="flag jp flags" id="cur-flag1"></i> <span id="cur-val1">Japan Yen (JPY)</span> <i class="fa fa-caret-down caret-down"></i>
                    <input type="hidden" id="to_county_code" value="JPY">
                </div><div class="clearfix"></div>
                <div class="cur-list-holder" id="cur-list-holder1" style="height:100px;height: 180px;overflow: hidden;">
                    <div class="cur-search-holder">
                        <input type="text" class="form-control round-0" placeholder="Type to search...">
                    </div>
                    <ul class="cur-list" id="curlist1" style=" max-height: 114px;">
                      <?php foreach($countries as $key=>$val){?>
                        <li class="f16 tocurcode" rel='<?=$key?>'><i class="flag <?=$flagelist[$key]?> flags"></i><?=$val?></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="amount-holder">
                <form>
                    <div class="form-group">
                        <label for="" class="amount-label">AMOUNT OF CONVERSION:</label>
                        <input type="text" class="form-control round-0 cur-amount" id="amountofconversion" placeholder="">
                    </div>
                </form>
            </div>
            <div class="cur-datepicker-holder">

                    <div class="form-group">
                        <label for="">INTERBANK +/-</label>
                        <select class="form-control round-0" id="interbank">
                            <div style="border:1px solid blue;min-height:100px;">
                            <?php foreach($internbank as $key=>$val){?>
                            <option value="<?=$key?>"><?=$val?></option>
                            <?php } ?>
                            </div>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">DATE:</label>
                        <input type="text" class="form-control round-0 datepicker" value="<?=date("Y/d/m")?>"  id='date_start'>
                    </div>

            </div>
        </div>
    </div>
    </div>


</body>    
</html>   


<style>
.btn-switch{transform: rotate(90deg);}

    </style>

      <script type="text/javascript">
          
     
$(document).ready(function(){
   $("#date_start").datetimepicker({
       format: "YYYY/DD/MM",  
      
   });
});     
          
          
          
          
          
          
          
          
$(document).ready(function () {
    $('.page-link').mouseover(function () {
        $($(this).data('target')).fadeIn("fast");

    });
     $('.page-link').mouseleave(function () {
        $($(this).data('target')).fadeOut("fast");
    });

 $(".hidden-menu").hide();
    $(".menu-button").show();

    $('.menu-button').click(function(){
    $(".hidden-menu").slideToggle();
    });

    });
     
        
 
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
            $('#curlist li').click(function(){
                $('#cur-val').text($(this).text());
                var flag = $(this).find('i');
                // alert(flag.attr('class'));
                $('#cur-flag').removeClass($('#cur-flag').attr('class')).addClass(flag.attr('class'));
                $('#cur-list-holder').hide('fast');
                
                var contry_code=$(this).attr('rel');
                $("#from_county_code").val(contry_code)   ;
                // convert courrency function call
                 convertCurrency();
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
                var contry_code=$(this).attr('rel');
                 $("#to_county_code").val(contry_code);
                 
                 // convert courrency function call
                 convertCurrency();
            });
        });
        
 
$(document).on('dp.change', '#date_start', function() {
    convertCurrency();
});
        
 
 $(document).on("change","#interbank",function(){
     convertCurrency();
 });
    
$(document).on("click",".btn-switch",function(){
   
     
    var fromcode =$("#from_county_code").val() ;
    var tocodce = $("#to_county_code").val();
   
   var Old_from_class=$("#cur-flag").attr('class');
   var Old_to_class=$("#cur-flag1").attr('class');
   var old_from_name=$("#cur-val").html();
   var old_to_name=$("#cur-val1").html();
   
           
   $("#cur-flag").attr('class',Old_to_class);
   $("#cur-flag1").attr('class',Old_from_class);
   $("#cur-val").html(old_to_name);
   $("#cur-val1").html(old_from_name);
    $("#from_county_code").val(tocodce) ;
    $("#to_county_code").val(fromcode);
   
    convertCurrency();
});
$(document).on("keydown",".cur-amount",function(e){
  // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46,32, 8, 9, 27, 13, 110, 190]) !== -1 ||
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
 
 
function convertCurrency()
{
   $('.IframeLoder').show();
   
    var url="<?=base_url()?>";
    
    var fromcode =$("#from_county_code").val() ;
    var tocodce = $("#to_county_code").val();
    var date_start= $("#date_start").val();
  $.post(url+"Currency_conversion/apiquotes2",{from:fromcode,to:tocodce,date:date_start},function(view){
      
      
   var data = JSON.parse(view);
    // console.log(obj); 
     
      var intramount=$('#interbank').val();
      var rawamount=$("#rawAmount").val();       
     var conversionfactor=data.value;        
     var netamount=parseFloat(rawamount)*parseFloat(conversionfactor);   
     intramount=parseInt(intramount);
     var percen=(netamount*intramount)/100;
     var calculateAmount=netamount-percen;
   
    var finalAmount=(intramount==0)?netamount:calculateAmount;  
   $("#amountofconversion").val(finalAmount);
       
       $('.IframeLoder').hide(); 
      
  }) ;
   
   
}  
        

 
   
 
  
        
 </script>   
 
 <style>
     
.bootstrap-datetimepicker-widget{ top:350px !important; left: 50px !important}     


 </style>