<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fx_lang_date {

    function __construct(){
        
        
    }
    

  public static function getFullMonth($lan_code="en",$fmonth="January"){
        
     $lan_code=trim($lan_code,"-");
     $lan_code=trim($lan_code,"/");
     $fmonth=trim($fmonth,"-");     
     $fmonth=trim($fmonth,"/");
      
       $lan_code=strtolower($lan_code);
       $fmonth=ucfirst($fmonth);
   
      $allMonth=array(
          'January'=>array('en'=>'January', 
                            'cz'=>'leden',
                            'cs'=>'leden',/*added*/
                            'gr'=>'Ιανουάριος',
                            'pk'=>'جنوری',
                            'pl'=>'Styczen',
                            'my'=>'Januari',
                            'bg'=>'Януари',
                            'pt'=>'Janeiro',
                            'es'=>'Enero',
                            'sa'=>'كانون الثاني',
                            'it'=>'Gennaio',
                            'fr'=>'Janvier',
                            'de'=>'Januar',
                            'id'=>'Januari',
                            'jp'=>'1月',
                            'ru'=>'Январь',),
          'February'=>array('en'=>'February', 
                            'cz'=>'únor',
                            'cs'=>'únor',/*added*/
                            'gr'=>'Φεβρουάριος',
                            'pk'=>'فروری',
                            'pl'=>'Luty',
                            'my'=>'Februari',
                            'bg'=>'Февруари',
                            'pt'=>'Fevereiro',
                            'es'=>'Febrero',
                            'sa'=>'شهر فبراير',
                            'it'=>'febbraio',
                            'fr'=>'Février',
                            'de'=>'Februar',
                            'id'=>'Februari',
                            'jp'=>'2月',
                            'ru'=>'Февраль',),
          'March'=>array('en'=>'March', 
                            'cz'=>'březen',
                            'cs'=>'březen',/*added*/
                            'gr'=>'Μάρτιος',
                            'pk'=>'مارچ',
                            'pl'=>'Marzec',
                            'my'=>'Mac',
                            'bg'=>'Март',
                            'pt'=>'Março',
                            'es'=>'Marzo',
                            'sa'=>'مارس',
                            'it'=>'marzo',
                            'fr'=>'Mars',
                            'de'=>'März',
                            'id'=>'Maret',
                            'jp'=>'行進',
                            'ru'=>'Март',),
          'April'=>array('en'=>'April', 
                            'cz'=>'duben',
                            'cs'=>'duben',/*added*/
                            'gr'=>'Απρίλιος',
                            'pk'=>'اپریل',
                            'pl'=>'Kwiecien',
                            'my'=>'April',
                            'bg'=>'Април',
                            'pt'=>'Abril',
                            'es'=>'Abril',
                            'sa'=>'أبريل',
                            'it'=>'aprile',
                            'fr'=>'Avril',
                            'de'=>'April',
                            'id'=>'April',
                            'jp'=>'4月',
                            'ru'=>'Апрель',),
          'May'=>array('en'=>'May', 
                            'cz'=>'květen',
                            'cs'=>'květen',/*added*/
                            'gr'=>'Ενδέχεται',
                            'pk'=>'مئی',
                            'pl'=>'Maj',
                            'my'=>'Mei',
                            'bg'=>'Май',
                            'pt'=>'Maio',
                            'es'=>'Mayo',
                            'sa'=>'قد',
                            'it'=>'Può',
                            'fr'=>'Mai',
                            'de'=>'Mai',
                            'id'=>'Mei',
                            'jp'=>'5月',
                            'ru'=>'Май',),
          'June'=>array('en'=>'June', 
                            'cz'=>'červen',
                            'cs'=>'červen',/*added*/
                            'gr'=>'Ιούνιος',
                            'pk'=>'جون',
                            'pl'=>'Czerwiec',
                            'my'=>'Jun',
                            'bg'=>'Юни',
                            'pt'=>'Junho',
                            'es'=>'Junio',
                            'sa'=>'يونيو',
                            'it'=>'giugno',
                            'fr'=>'Juin',
                            'de'=>'Juni',
                            'id'=>'Juni',
                            'jp'=>'六月',
                            'ru'=>'Июнь',),
          'July'=>array('en'=>'July', 
                            'cz'=>'červenec',
                            'cs'=>'červenec',/*added*/
                            'gr'=>'Ιούλιος',
                            'pk'=>'جولائی',
                            'pl'=>'Lipiec',
                            'my'=>'Julai',
                            'bg'=>'Юли',
                            'pt'=>'Julho',
                            'es'=>'Julio',
                            'sa'=>'يوليو',
                            'it'=>'luglio',
                            'fr'=>'Juillet',
                            'de'=>'Juli',
                            'id'=>'Juli',
                            'jp'=>'7月',
                            'ru'=>'Июль',),
          'August'=>array('en'=>'August', 
                            'cz'=>'srpen',
                            'cs'=>'srpen',/*added*/
                            'gr'=>'Αύγουστος',
                            'pk'=>'اگست',
                            'pl'=>'Sierpien',
                            'my'=>'Ogos',
                            'bg'=>'Август',
                            'pt'=>'Agosto',
                            'es'=>'Agosto',
                            'sa'=>'أغسطس',
                            'it'=>'agosto',
                            'fr'=>'Août',
                            'de'=>'August',
                            'id'=>'Agustus',
                            'jp'=>'8月',
                            'ru'=>'Август',),
          'September'=>array('en'=>'September', 
                            'cz'=>'září',
                            'cs'=>'září',/*added*/
                            'gr'=>'Σεπτέμβριος',
                            'pk'=>'ستمبر',
                            'pl'=>'Wrzesien',
                            'my'=>'September',
                            'bg'=>'Септември',
                            'pt'=>'Setembro',
                            'es'=>'Septiembre',
                            'sa'=>'سبتمبر',
                            'it'=>'settembre',
                            'fr'=>'Septembre',
                            'de'=>'September',
                            'id'=>'September',
                            'jp'=>'9月',
                            'ru'=>'Сентябрь',),
          'October'=>array('en'=>'October', 
                            'cz'=>'říjen',
                            'cs'=>'říjen',/*added*/
                            'gr'=>'Οκτώβριος',
                            'pk'=>'اکتوبر',
                            'pl'=>'Pazdziernik',
                            'my'=>'Oktober',
                            'bg'=>'Октомври',
                            'pt'=>'Outubro',
                            'es'=>'Octubre',
                            'sa'=>'شهر اكتوبر',
                            'it'=>'ottobre',
                            'fr'=>'Octobre',
                            'de'=>'Oktober',
                            'id'=>'Oktober',
                            'jp'=>'10月',
                            'ru'=>'Октябрь',),
          'November'=>array('en'=>'November', 
                            'cz'=>'listopad',
                            'cs'=>'listopad',/*added*/
                            'gr'=>'Νοέμβριος',
                            'pk'=>'نومبر',
                            'pl'=>'Listopad',
                            'my'=>'November',
                            'bg'=>'Ноември',
                            'pt'=>'Novembro',
                            'es'=>'Noviembre',
                            'sa'=>'شهر نوفمبر',
                            'it'=>'novembre',
                            'fr'=>'Novembre',
                            'de'=>'November',
                            'id'=>'November',
                            'jp'=>'11月',
                            'ru'=>'Ноябрь',),
          'December'=>array('en'=>'December', 
                            'cz'=>'prosinec',
                            'cs'=>'prosinec',/*added*/
                            'gr'=>'Δεκέμβριος',
                            'pk'=>'دسمبر',
                            'pl'=>'Grudzien',
                            'my'=>'Disember',
                            'bg'=>'Декември',
                            'pt'=>'Dezembro',
                            'es'=>'Diciembre',
                            'sa'=>'ديسمبر',
                            'it'=>'dicembre',
                            'fr'=>'Décembre',
                            'de'=>'Dezember',
                            'id'=>'Desember',
                            'jp'=>'12月',
                            'ru'=>'Декабрь',),
      );
        
     $getMonth= $allMonth[$fmonth][$lan_code];
     return strtoupper($getMonth);
      
      
      
      
  }
    
    
    
    
    
    
}