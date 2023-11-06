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
    
    $('a.partnership-laspalmas-content').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#partnership-laspalmas-content').offset().top
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
	var section2Top =  $('#register-now-content').offset().top - (($('#conditions-trading-content').offset().top - $('#register-now-content').offset().top) / 2);
	var section3Top =  $('#conditions-trading-content').offset().top - (($('#partnership-laspalmas-content').offset().top - $('#conditions-trading-content').offset().top) / 2);
	var section4Top =  $('#partnership-laspalmas-content').offset().top - (($('#rpj-racing-sponsor-content').offset().top - $('#partnership-laspalmas-content').offset().top) / 2);
	var section5Top =  $('#rpj-racing-sponsor-content').offset().top - (($('#recognition-content').offset().top - $('#rpj-racing-sponsor-content').offset().top) / 2);
	var section6Top =  $('#recognition-content').offset().top - (($('#risk-free-content').offset().top - $('#recognition-content').offset().top) / 2);
	var section7Top =  $('#risk-free-content').offset().top - (($(document).height() - $('#risk-free-content').offset().top) / 2);;


	console.log(section2Top);

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
	
}
