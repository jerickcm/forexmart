$(document).ready(function() {
	
	redrawDotNav();
	
	/* Scroll event handler */
    $(window).bind('scroll',function(e){
    	parallaxScroll();
		redrawDotNav();
    });
    
	/* Next/prev and primary nav btn click handlers */
    $('a.get-bonus-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#get-bonus-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });

    $('.scroll-down a').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#register-now-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });

    $('.get-bonus-button').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#register-now-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });

    $('a.register-now-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#register-now-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });
	$('a.conditions-trading-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#conditions-trading-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });
   
   
    $('a.rpj-racing-sponsor-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#rpj-racing-sponsor-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
              
		});
                
            setTimeout(function(){             
                
                    var getsize=getWindowView();
                    var windoszie=getsize.split("_");
                    var mobW=windoszie[0];
                    var mobH=windoszie[1];

                    if(mobW<600)
                    {                
                      $('nav#primary a').removeClass('active');                
                      $('nav#primary a.rpj-racing-sponsor-content').addClass('active');                       
                    }
            },2000);           
                
                
    	return false;
    });

    $('a.partnership-laspalmas-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#partnership-laspalmas-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });

    $('a.recognition-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#recognition-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });

    $('a.risk-free-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#risk-free-content').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });

    /* Show/hide dot lav labels on hover */
    $('nav#primary a').hover(
    	function () {
			$(this).prev('h1').show();
		},
		function () {
			$(this).prev('h1').hide();
		}
    );
    
});

/* Scroll the background layers */
function parallaxScroll(){
	var scrolled = $(window).scrollTop();
	$('#parallax-bg1').css('top',(0-(scrolled*.25))+'px');
	$('#parallax-bg2').css('top',(0-(scrolled*.5))+'px');
	$('#parallax-bg3').css('top',(0-(scrolled*.75))+'px');
}

/* Set navigation dots to an active state as the user scrolls */
function redrawDotNav(){
	var section1Top =  0;

	// The top of each section is offset by half the distance to the previous section.
    var section1Top =  $('#get-bonus-content').offset().top - (($('#register-now-content').offset().top - $('#get-bonus-content').offset().top) / 2);
	var section2Top =  $('#register-now-content').offset().top - (($('#conditions-trading-content').offset().top - $('#register-now-content').offset().top) / 2);
	var section3Top =  $('#conditions-trading-content').offset().top - (($('#partnership-laspalmas-content').offset().top - $('#conditions-trading-content').offset().top) / 2);
	var section4Top =  $('#partnership-laspalmas-content').offset().top - (($('#rpj-racing-sponsor-content').offset().top - $('#partnership-laspalmas-content').offset().top) / 2);
	var section5Top =  $('#rpj-racing-sponsor-content').offset().top - (($('#recognition-content').offset().top - $('#rpj-racing-sponsor-content').offset().top) / 2);
	var section6Top =  $('#recognition-content').offset().top - (($('#risk-free-content').offset().top - $('#recognition-content').offset().top) / 2);
	var section7Top =  $('#risk-free-content').offset().top - (($(document).height() - $('#risk-free-content').offset().top) / 2);
 

	$('nav#primary a').removeClass('active');

 

	if($(document).scrollTop() >= section1Top && $(document).scrollTop() < section2Top){
		$('nav#primary a.get-bonus-content').addClass('active');
	} else if ($(document).scrollTop() >= section2Top && $(document).scrollTop() < section3Top){
		$('nav#primary a.register-now-content').addClass('active');
	} else if ($(document).scrollTop() >= section3Top && $(document).scrollTop() < section4Top){
		$('nav#primary a.conditions-trading-content').addClass('active');
	} else if ($(document).scrollTop() >= section4Top && $(document).scrollTop() < section5Top){
		$('nav#primary a.partnership-laspalmas-content').addClass('active');
	} else if ($(document).scrollTop() >= section5Top && $(document).scrollTop() < section6Top){
		$('nav#primary a.rpj-racing-sponsor-content').addClass('active');
	} else if ($(document).scrollTop() >= section6Top && $(document).scrollTop() < section7Top){
		$('nav#primary a.recognition-content').addClass('active');
	} else if ($(document).scrollTop() >= section7Top){
                $('nav#primary a.risk-free-content').addClass('active');
	}
        
        var xfive=isScrolledIntoView('#rpj-racing-sponsor-content');
	if(xfive==true){$('nav#primary a').removeClass('active');$('nav#primary a.rpj-racing-sponsor-content').addClass('active');};
        

    
    
    // check mobile view  
      var getsize=getWindowView();
      var windoszie=getsize.split("_");
      var mobW=windoszie[0];
      var mobH=windoszie[1];
	  
      if(mobW<600)
      {
          var newArray=["get-bonus-content","register-now-content","conditions-trading-content","partnership-laspalmas-content","rpj-racing-sponsor-content","recognition-content","risk-free-content"];
           
        var callData="";       
        jQuery.each(newArray, function(index, item){
            
            attachEvent(document.getElementById('tpblanid'), "scroll", update);
            attachEvent(window, "resize", update);            
     
                     var result=update(item);                 
			if(result==true)
			{	 
                          callData=item;                                
			} 			
		});				 
             
            setTimeout(function(){             
                   $('nav#primary a').removeClass('active');
                   callData=callData.replace(/ /g,'');
                   $('nav#primary a.'+callData).addClass('active');                  
            },100);  		 		 
      }

}

 function update(item){
     return  visibleY(document.getElementById(item)) ;
};

var visibleY = function(el){
    var top = el.getBoundingClientRect().top, rect, el = el.parentNode;
    do {
        rect = el.getBoundingClientRect();
        if (top <= rect.bottom === false)
            return false;
        el = el.parentNode;
    } while (el != document.body);
    // Check its within the document viewport
    return top <= document.documentElement.clientHeight;
};

// Stuff only for the demo
function attachEvent(element, event, callbackFunction) {
    if(element  !== null){
        if (element.addEventListener) {
            element.addEventListener(event, callbackFunction, false);
        } else if (element.attachEvent) {
            element.attachEvent('on' + event, callbackFunction);
        }
    }
};
  

function getWindowView()
{
    
var w = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;

var h = window.innerHeight
|| document.documentElement.clientHeight
|| document.body.clientHeight;

return w+"_"+h;

}


function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}



