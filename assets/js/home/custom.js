var mainslider;
var sliding = false;

$(document).ready(function(){
    var ndbCookie = getCookie('showNdb');
    if(ndbCookie != null) {
        var getSession = $.session.get("ndbSession");
        if (getSession == undefined) {
            $("#a_five").remove();
            $("#five").remove();
        }
    }

    var options = {
        slides: '.slide', // The name of a slide in the slidesContainer
        swipe: false,    // Add possibility to Swipe > note that you have to include touchSwipe for this
        transition: "fade", // Accepts "slide" and "fade" for a slide or fade transition
        slideTracker: true, // Add a UL with list items to track the current slide
        slideTrackerID: 'slideposition', // The name of the UL that tracks the slides
        slideOnInterval: true, // Slide on interval
        interval: 6000, // Interval to slide on if slideOnInterval is enabled
        animateDuration: 1100, // Duration of an animation
        animationEasing: 'ease', // Accepts: linear ease in out in-out snap easeOutCubic easeInOutCubic easeInCirc easeOutCirc easeInOutCirc easeInExpo easeOutExpo easeInOutExpo easeInQuad easeOutQuad easeInOutQuad easeInQuart easeOutQuart easeInOutQuart easeInQuint easeOutQuint easeInOutQuint easeInSine easeOutSine easeInOutSine easeInBack easeOutBack easeInOutBack
        pauseOnHover: false, // Pause when user hovers the slide container
        magneticSwipe: true, // This will attach the slides to the mouse's position when swiping/dragging
        neverEnding: true // Enable this to create a 'neverending' effect.
    };

    $(".slider").simpleSlider(options);
    mainslider = $(".slider").data("simpleslider");
    /* yes, that's all! */

    $(".slider").on("beforeSliding", function(event){
        var prevSlide = event.prevSlide;
        var newSlide = event.newSlide;
        $(".slider .slide[data-index='" + prevSlide + "'] .slidecontent").fadeOut();
        $(".slider .slide[data-index='" + newSlide + "'] .slidecontent").hide();

        sliding = true;
    });

    $(".slider").on("afterSliding", function(event){
        var prevSlide = event.prevSlide;
        var newSlide = event.newSlide;
        $(".slider .slide[data-index='"+newSlide+"'] .slidecontent").fadeIn();
        var id = $(".slide[data-index='"+newSlide+"']").attr('id');
        if(id == 'eleven'){
            $(".btn-real2").attr('href',www_url+'register?id=IHXBM'); // www_url declarared in main page of layout
        }else{
            $(".btn-real2").attr('href',www_url+'register'); // www_url declarared in main page of layout
        }
        sliding = false;
    });

    /**
     * Control the slider by scrolling
     */
    $(window).bind('mousewheel', function(event) {
        if(!sliding){
            if(event.originalEvent.deltaY > 0){
                mainslider.nextSlide();
            }
            else{
                mainslider.prevSlide();
            }
        }
    });

    //Enable swiping...
    //$(".pagewrap").swipe( {
    //    //Generic swipe handler for all directions
    //
    //    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
    //
    //        var curTop = $(window).scrollTop();
    //        console.log(event);
    //        console.log(curTop);
    //        if(direction == "left"){
    //            mainslider.nextSlide();
    //
    //        }else if(direction == "right"){
    //            mainslider.prevSlide();
    //
    //        }else if(direction == 'up'){
    //            $(window).scrollTop(curTop+distance);
    //            console.log(curTop+distance);
    //        }else if(direction == "down"){
    //            $(window).scrollTop(curTop-distance)
    //            console.log(curTop-distance);
    //        }
    //    },
    //    //Default is 75px, set to 0 for demo so any distance triggers swipe
    //    threshold:0
    //});

    $(".pagewrap").swipe( {
        //Generic swipe handler for all directions
        swipeRight:function(event, direction, distance, duration, fingerCount) {

            mainslider.prevSlide();
        },
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            mainslider.nextSlide();
        },

        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });
   
});
