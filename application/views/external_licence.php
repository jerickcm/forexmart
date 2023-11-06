<?php $this->lang->load('license_lang'); ?>

<div class="division-container" id="cysecLicense">
    <div class="container">
        <h3 class="headingTitle-title"><?=lang('license_0');?></h3>
        <p class="short-description"><?=lang('license_01');?></p>
        <br/>
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10  col-xs-12">
                <div class="bb-custom-wrapper">
                    <div id="bb-bookblock" class="bb-bookblock">
                        <div class="bb-item">
                            <img src="<?= $this->template->Images() ?>licence/img-cysecLicense3.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="bb-item">
                            <img src="<?= $this->template->Images() ?>licence/img-cysecLicense.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="bb-item">
                            <img src="<?= $this->template->Images() ?>licence/img-cysecLicense4.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="bb-item">
                            <img src="<?= $this->template->Images() ?>licence/img-cysecLicense2.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                    <nav class="nav-bb-bookblock">
                        <a id="bb-nav-first" href="#" class="icon-boxplacer"><i class="fa fa-step-backward"></i></a>
                        <a id="bb-nav-prev" href="#" class="icon-boxplacer" style="display: none"><i class="fa fa-caret-left"></i></a>
                        <a id="bb-nav-prev1" class="icon-boxplacer" style="display: " ><i class="fa fa-caret-left"></i></a>
                        <a id="bb-nav-next" href="#" class="icon-boxplacer" style="display: "><i class="fa fa-caret-right"></i></a>
                        <a id="bb-nav-next1" class="icon-boxplacer" style="display: none"><i class="fa fa-caret-right"></i></a>
                        <a id="bb-nav-last" href="#" class="icon-boxplacer"><i class="fa fa-step-forward"></i></a>
                    </nav>
                </div>
                <div class="mobile_slider">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        <div class="item"><img src="<?= $this->template->Images() ?>licence/img-cysecLicense-mobile3.jpg" alt="" ></div>
                        <div class="item"><img src="<?= $this->template->Images() ?>licence/img-cysecLicense-mobile.jpg" alt=""></div>
                        <div class="item"><img src="<?= $this->template->Images() ?>licence/img-cysecLicense-mobile4.jpg" alt=""></div>
                        <div class="item"><img src="<?= $this->template->Images() ?>licence/img-cysecLicense-mobile2.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var page = 1;
    function check_page(page) {
        //console.log(page);
        if (page == 1) {
            $('#bb-nav-prev').attr('style','display: none');
            $('#bb-nav-prev1').attr('style','display: ');
        } else {
            $('#bb-nav-prev').attr('style','display: ');
            $('#bb-nav-prev1').attr('style','display: none');
        }
        if (page == 4) {
            $('#bb-nav-next').attr('style','display: none');
            $('#bb-nav-next1').attr('style','display: ');
        } else {
            $('#bb-nav-next').attr('style','display: ');
            $('#bb-nav-next1').attr('style','display: none');
        }
    }

    $(document).ready(function () {
        check_page(page);

        $("#bb-nav-next").click(function () {
            if (page < 4)
                page++;
            check_page(page);
        });
        $("#bb-nav-prev").click(function () {
            if (page > 1)
                page--;
            check_page(page);
        });

        $("#bb-nav-first").click(function () {
            page = 1;
            check_page(page);
        });
        $("#bb-nav-last").click(function () {
            page = 4;
            check_page(page);
        });
    });

    var Page = (function() {
        var config = {
            $bookBlock : $( '#bb-bookblock' ),
            $navNext : $( '#bb-nav-next' ),
            $navPrev : $( '#bb-nav-prev' ),
            $navFirst : $( '#bb-nav-first' ),
            $navLast : $( '#bb-nav-last' )
        },
            init = function() {
                config.$bookBlock.bookblock( {
                    speed : 800,
                    shadowSides : 0.8,
                    shadowFlip : 0.7
                } );
                initEvents();
            },
            initEvents = function() {

                var $slides = config.$bookBlock.children();

                // add navigation events
                config.$navNext.on( 'click touchstart', function() {
                    config.$bookBlock.bookblock( 'next' );
                    return false;
                } );

                config.$navPrev.on( 'click touchstart', function() {
                    config.$bookBlock.bookblock( 'prev' );
                    return false;
                } );

                config.$navFirst.on( 'click touchstart', function() {
                    config.$bookBlock.bookblock( 'first' );
                    return false;
                } );

                config.$navLast.on( 'click touchstart', function() {
                    config.$bookBlock.bookblock( 'last' );
                    return false;
                } );

                // add swipe events
                $slides.on( {
                    'swipeleft' : function( event ) {
                        config.$bookBlock.bookblock( 'next' );
                        return false;
                    },
                    'swiperight' : function( event ) {
                        config.$bookBlock.bookblock( 'prev' );
                        return false;
                    }
                } );

                // add keyboard events
                $( document ).keydown( function(e) {
                    var keyCode = e.keyCode || e.which,
                        arrow = {
                            left : 37,
                            up : 38,
                            right : 39,
                            down : 40
                        };

                    switch (keyCode) {
                        case arrow.left:
                            config.$bookBlock.bookblock( 'prev' );
                            break;
                        case arrow.right:
                            config.$bookBlock.bookblock( 'next' );
                            break;
                    }
                } );
            };

        return { init : init };
    })();
</script>
<script>
    Page.init();
</script>
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem:true
        });
    });
</script>





