<?php 

$widht=$this->input->get('ecalwidth');
$height=$this->input->get('height');
$numofRow=$this->input->get('numofRow');

// iframebox 
$ecalborder=$this->input->get('ecalborder');
$ecalbordercolor=$this->input->get('ecalbordercolor');
$ecalrountop=$this->input->get('ecalrountop');
$ecalrounright=$this->input->get('ecalrounright');
$ecalrounbottom=$this->input->get('ecalrounbottom');
$ecalrounleft=$this->input->get('ecalrounleft');

// div content
$ecalheadbackground=$this->input->get('ecalheadbackground');
$ecaltablebackground=$this->input->get('ecaltablebackground');
$ecalfootbackground=$this->input->get('ecalfootbackground');

//pop up data
 $nbgone=$this->input->get('ecalpopbgtop');
 $nbgtwo=$this->input->get('ecalpopbgbottom');
  
$ecalpophedfont=$this->input->get('ecalpophedfont');
$ecalpophedsize=$this->input->get('ecalpophedsize');
$ecalpophedalgin=$this->input->get('ecalpophedalgin');
$ecalpophedcolor=$this->input->get('ecalpophedcolor');

$ecalpopfootfont=$this->input->get('ecalpopfootfont');
$ecalpopfootalgin=$this->input->get('ecalpopfootalgin');
$ecalpopfootcolor=$this->input->get('ecalpopfootcolor');

$ecalpoptblfont=$this->input->get('ecalpoptblfont');
$ecalpoptblcolor=$this->input->get('ecalpoptblcolor');
//$=$this->input->get('ecalwidth');

                        
$padheight=$height-250;
$popwidth=$widht-90;
$textwidth=$widht-40;
?>



<div class="IframeLoder boxbgcolor">
    <table>
        
        <button aria-label="Close" data-dismiss="modal" id="modalclose" class="close" type="button"><span aria-hidden="true">×</span></button>
        <p class="counName" id="name"> </p>
         
        <tbody id="popbody">
            <tr>
                <td>Country</td>
                <td>:</td>
                <td id="country" class="f16"></td>
            </tr>
            <tr>
                <td>Importance</td>
                <td>:</td>
                <td id="importance">
                    
                </td>
            </tr>
            
            <tr>
                <td>Date</td>
                <td>:</td>
                <td id="date"></td>
            </tr>
            <tr>
                <td>Time</td>
                <td>:</td>
                <td id="time"></td>
            </tr>
            <tr>
                <td> 	Previous</td>
                <td>:</td>
                <td id="previous"></td>
            </tr>
            <tr>
                <td>Forecast</td>
                <td>:</td>
                <td id="forecast"></td>
            </tr>
            <tr>
                <td>Actual</td>
                <td>:</td>
                <td id="actual"></td>
            </tr>
          
        </tbody>
    </table>
    <div class="textpad" id="description">
        
 

    </div>
    
</div>



<div class="panel panel-default">
    <div class="panel-heading quotes-heading" style="background:<?='#'.$ecalheadbackground?>">
    <img src="<?= $this->template->Images()?>fxlogonew.svg" class="informer-logo img-responsive">
</div>
<div class="table-responsive">
    <table class="table table-striped quotes-table calendar-table" id="listofeconimic">
        <thead>
        <tr>
            <th colspan="2">Date</th>
            <th class="calendar-event">Event</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody >
            
          <?php foreach($calendarData as $key){
                
                $dateValue = strtotime($key->ReleaseTimestamp);                     
                $yr = date("Y", $dateValue) ." "; 
                $mon = date("M", $dateValue)." "; 
                $day = date("d", $dateValue); 
                $time = date("H:i", $dateValue); 
                $newDate=$yr."-".date("m", $dateValue)."-".$day;
                
                
                
                
                  switch($key->Importance){
                        case 'Low':
                            $barType = 'low';
                            $barClass = 'low';
                            break;
                        case 'Medium':
                            $barType = 'moderate';
                            $barClass = 'warning';
                            break;
                        case 'High':
                            $barType = 'high';
                            $barClass = 'danger';
                    }
                
              ?>
            <tr>
                <!-- <td><i class="fa fa-caret-down caret-red"></i></td> -->
                <td><?=$mon.','.$day.' '.$time?></td>
                <td class="f16"><i class="flag <?=$key->Country?>"></i></td>
                <td>
                <a href="#" data="modal"><?=$key->Name?></a>            
                </td>
                <td><?=$key->Previous?></td>
                <input type="hidden" value="<?=$key->Country.'_frz_'.$key->Actual.'_frz_'.$key->Forecast.'_frz_'.$key->Previous.'_frz_'.$key->Importance?>" class="coacforpevim">
                <input type="hidden" value="<?=$key->Name.'_frz_'.$key->ReleaseTimestamp.'_frz_'.strip_tags($key->Description)?>" class="calendardescrip">
                <input type="hidden" value="<?=$newDate.'_frz_'.$time.'_frz_'.$barClass.'_frz_'.$barType?>" class="calendardatetime">
            </tr>
            
          <?php } ?>
             
            

        </tbody>
    </table>
</div>
    <div class="panel-footer quotes-footer" style="background:#<?=$ecalfootbackground?> ">Powered by ForexMart</div>
</div>

    <!-- Bootstrap Core CSS -->
            <link href="https://www.forexmart.com/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://www.forexmart.com/assets/css/style.min.css" rel="stylesheet">
        <link href="https://www.forexmart.com/assets/css/custom.min.css" rel="stylesheet">
        <link href="https://www.forexmart.com/assets/css/custom-external.min.css" rel="stylesheet">
        <link href="https://www.forexmart.com/assets/css/external-style.min.css" rel="stylesheet">
 

                  
                <link rel="stylesheet" href="https://www.forexmart.com/assets/css/informer.css">   
                <link rel="stylesheet" href="https://www.forexmart.com/assets/css/flags16.css">   
                    <link rel="stylesheet" href="https://www.forexmart.com/assets/css/flags32.css">  
                    
                    
<link href="<?= $this->template->Css()?>loaders.css" rel="stylesheet">                     
<script src="<?= $this->template->Js()?>jquery.min.js" type="text/javascript"></script>        
<script src="<?= $this->template->Js()?>Moment.js" type="text/javascript"></script> 
 
<style>
    
    
#popbody tr td{ font-family:<?=$ecalpoptblfont?>;color:<?=$ecalpoptblcolor?>;}
      
  
.boxbgcolor{
background-image: -ms-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

background-image: -moz-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

background-image: -o-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #<?=$nbgtwo?>), color-stop(100, #<?=$nbgtwo?>)) !important;

background-image: -webkit-linear-gradient(bottom, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;

background-image: linear-gradient(to top, #<?=$nbgtwo?> 0%, #<?=$nbgone?> 100%) !important;
}    
    
    
#listofeconimic tbody td{background:<?=($ecaltablebackground=='none')?$ecaltablebackground:'#'.$ecaltablebackground?>}    
    
        
.counName{ font-family:<?=$ecalpophedfont?>;
    font-size:<?=$ecalpophedsize?>;
    font-weight: bold;
    color:<?=$ecalpophedcolor?>;
     text-align:<?=$ecalpophedalgin?>;
    margin-top: 10px;}    
.IframeLoder{display: none; background: #ffffff; height:98%; border:1px solid #ccc; overflow: hidden; position: absolute; text-align: center;    width: 100%; padding:0px 10px 10px 10px}
   
.IframeLoder .textpad{ font-family:<?=$ecalpopfootfont?>; color:<?=$ecalpopfootcolor?>; overflow:hidden;text-align:<?=$ecalpopfootalgin?>; text-overflow: ellipsis; height:<?=$padheight?>;width:<?=$textwidth?>}

.IframeLoder table{ margin-bottom: 10px;}
.IframeLoder table tbody td{padding: 3px;}
.IframeLoder table tbody td:nth-child(1){width:75px;}
.IframeLoder table tbody td:nth-child(2){width:10px; text-align: center}
.IframeLoder table tbody td:nth-child(3){width:<?=$popwidth?>;}
body{float: left}    
html{ overflow: hidden}    
 .table-responsive > .table > tbody > tr > td, .table-responsive > .table > tbody > tr > th, .table-responsive > .table > tfoot > tr > td, .table-responsive > .table > tfoot > tr > th, .table-responsive > .table > thead > tr > td, .table-responsive > .table > thead > tr > th{white-space: inherit;}   
</style>
 
<script>
$(document).on("click","#listofeconimic a",function(){    
    
     var coacforpevim=$(this).closest('tr').find(".coacforpevim").val();
   
     var base = coacforpevim.split("_frz_"); 
    var country=base[0];
    var actual=base[1];
    var forecast=base[2];
    var previous=base[3];
    var importance=base[4];
    
    
    
    
    $("#country").html(country+' '+'<i class="flag '+country+'">');
    $("#actual").html(actual);
    $("#forecast").html(forecast);
    $("#previous").html(previous);
   
     var calendardescrip=$(this).closest('tr').find(".calendardescrip").val();
     var details = calendardescrip.split("_frz_"); 
    var name=details[0];
    var ReleaseTimestamp=details[1];
    var description=details[2];
    
       $("#name").html(name);       
       
        description = description.replace("<p>", ""); 
       description = description.replace("</p>", ""); 
       $("#description").html(description);
       
       
     var calendardatetime=$(this).closest('tr').find(".calendardatetime").val();
     var frztime = calendardatetime.split("_frz_"); 
    var date=frztime[0];
    var time=frztime[1];
    var barClass=frztime[2];
    var barType=frztime[3];
     $("#date").html(date);       
      $("#time").html(time);       
    
    var processbar= '<div class="progress calendar-progress"><div class="progress-bar progress-bar-'+barClass+' '+barType+'" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div></div>';
    $("#importance").html(processbar);
    
    
$('.IframeLoder').show();
        
});

$(document).on("click","#modalclose",function(){    
$('.IframeLoder').hide();
        
});


</script>