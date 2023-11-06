<<<<<<< .mine
<?php 
if(!IPLoc::office()) 
{
?>
<?=lang('AboutUs') ?>
<div class="reg-form-holder">
    <div class="about-company-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="license-title ext-arabic-license-title sa-right">
                        <?= lang('x_b_title')?>
                    </h1>
                    <p class="about-text ext-arabic-about-text">
                        <?= lang('x_b_p1-0')?>
                        <span class="company">
                        <?= lang('x_b_p1-1')?>
                        </span>
                        <?= lang('x_b_p1-2')?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="about-img-holder">
        <div class="about-img">
            <img src="<?= $this->template->Images()?>about-img.png" alt="" class="img-responsive" alt="" />
        </div>
    </div>
||||||| .r33363
<?php 
if(!IPLoc::office()) 
{
?>
<?=lang('AboutUs') ?>
<div class="reg-form-holder">
    <div class="about-company-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="license-title ext-arabic-license-title sa-right">
                        <?= lang('x_b_title')?>
                    </h1>
                    <p class="about-text ext-arabic-about-text">
                        <?= lang('x_b_p1-0')?>
                        <span class="company">
                        <?= lang('x_b_p1-1')?>
                        </span>
                        <?= lang('x_b_p1-2')?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="about-img-holder">
        <div class="about-img">
            <img src="<?= $this->template->Images()?>about-img.png" alt="" class="img-responsive">
        </div>
    </div>
=======
<?php $this->lang->load('AboutUs'); ?>
>>>>>>> .r36655

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link href="<?= $this->template->Css();?>about/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?= $this->template->Css();?>about/bootstrap.min.css" rel="stylesheet">
     <link href="<?= $this->template->Css();?>about/external-style.css" rel="stylesheet">
    <!-- <link href="carousel.css" rel="stylesheet"> -->
    <link href="<?= $this->template->Css();?>about/jquery-1.11.3.min.js" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= $this->template->Css();?>about/exscrolling-nav.css" rel="stylesheet">    
    <link href="<?= $this->template->Css();?>about/regulation.css" rel="stylesheet">
    <link href="<?= $this->template->Css();?>about/fxabout.css" rel="stylesheet">



    <!-- <link href="css/airview.min.css" rel="stylesheet"> -->

    <!-- Owl Carousel Assets -->
   <link href="<?= $this->template->Css();?>about/owl.carousel.css" rel="stylesheet">
   <link href="<?= $this->template->Css();?>about/owl.theme.css" rel="stylesheet">



<div class="about-main-wrapper">
     
    <div class="about-header-holder">
     
            <div class="container">
                
                <div class="about-header">
                    
                    <h2>About Us</h2>
                    <p><b>ForexMart</b> | THINK <b>BIG</b> TRADE FOREX</p>
                </div>
            </div>
        </div>
        <div class="about-content-holder">

                <div class="partnership-main-holder">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-2-left">
                                <?php
                                include_once('layouts/external/sidebar-left.php');
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-8-center">


                                <div class="">
                                    <div class="row">
                                        <div class="col-md-7 col-lg-7 col-sm-7">
                                            <div class="about-content">
                                                
                                                <p>
                                                    <b>About the Company</b><br>
                                                   As your trusted forex trading partner, ForexMart is highly committed to offering the high-class trading software, giving exceptional trading experience, protecting your account against any fraudulent activity, and equipping you with significant trading knowledge.

                                                </p> 
                                                <p>  
                                              <b>Trading Software</b><br>  
                                                
                                               ForexMart  uses MetaTrader 4, the leading platform for trading forex online. We aim to provide the most advanced trading tools for you to stay on top of forex trading. MT4 is designed and developed by MetaQuotes Software Corp., a software developer for financial markets.

                                                </p>
                                                <p>
                                                    <b>Regulatory Oversight</b><br>
                                                   We adhere to the regulations set by different countries across the globe. As part of the industry standards, ForexMart separates all client funds from our assets to ensure your money is safe and available at all times. We are not in the business of proprietary trading.

                                                </p>
                                                <p>
                                                    <b>24/5 Customer Support</b><br>
                                                    At ForexMart , your trading convenience is our highest priority. We believe you are our best asset, so our support department is ready 24 hours a day and five days a week to respond to your questions regarding forex trading.
                                                    <br><br> <b>Educating Traders</b><br>
                                                   In order to make sensible, precise decisions, we have come up with various resources for all types of traders - all for free! ForexMart devotes much time and effort to give up-to-date educational materials, and sensible market analysis to discover new opportunities and improve trading.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-5 col-sm-5">
                                            <div class="about-content-img">
                                                <img src="<?= $this->template->Images()?>about-content-img.png" class="img-responsive"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-2-right">
                                <?php
                                include_once('layouts/external/sidebar-right.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <div class="about-feat-holder">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-6 about about-regulation-holder">
                        <a href="<?php echo FXPP::www_url('License') ?>">
                            <div class="about-regulation">
<!--                                <img src="<?= $this->template->Images()?>about-icon-01.png">-->
                                <p>License and Regulations</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 about about-awards-holder">
                        <a href="<?php echo FXPP::www_url('awards') ?>">
                            <div class="about-awards">
<!--                                <img src="<?= $this->template->Images()?>about-icon-02.png">-->
                                <p>Our Awards</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 about about-supp-holder">
                        <a href="<?php echo FXPP::www_url('contact-us') ?>">
                            <div class="about-supp">
<!--                                <img src="<?= $this->template->Images()?>about-icon-03.png">-->
                                <p>Professionals Support</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 about about-bonus-holder">
                        <a href="<?php echo FXPP::www_url('bonuses') ?>">
                            <div class="about-bonus">
<!--                                <img src="<?= $this->template->Images()?>about-icon-04.png">-->
                                <p>Bonus and Contests</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 about about-wide-holder">
                        <a href="<?php echo FXPP::www_url('Financial_instruments/forex') ?>">
                            <div class="about-wide">
<!--                                <img src="<?= $this->template->Images()?>about-icon-05.png">-->
                                <p>Wide choice Big Opportunities</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 about about-partner-holder">
                        <a href="<?php echo FXPP::www_url('sponsorship') ?>">
                            <div class="about-partner">
<!--                                <img src="<?= $this->template->Images()?>about-icon-06.png">-->
                                <p>Partners of ForexMart</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="about-btn-holder">
                    <a href="https://www.forexmart.com/register">START TRADING TODAY</a>
                </div>
            </div>
        </div>
    </div>

<style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
        /*width: 100%;*/
        height: auto;
        margin:0 auto;
        margin-top:30px;
    }
    </style>
    <script>
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 5,
            lazyLoad : true,
            navigation : false
        });
        $('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        })
        $('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        })
    });
    </script>
    <script src="js/scrolltotop.js"></script> <!-- Gem jQuery -->

    <script type="text/javascript">
        $(".footer-toggle").click(function() {
          $(".footer-hide-menu").toggle( 300, function() {
            // Animation complete.
          });
        });
    </script>
    <script type="text/javascript">
        // $(window).load(function(){
        //     $('#popfeedback').modal('show');
        // });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#nig').hover(function() { 
                $('#nigeria-holder').fadeIn("fast"); 
            }, function() { 
                $('#nigeria-holder').fadeOut("fast"); 
            });
            $('#mal').hover(function() { 
                $('#malaysia-holder').fadeIn("fast"); 
            }, function() { 
                $('#malaysia-holder').fadeOut("fast"); 
            });
            $('#ind').hover(function() { 
                $('#indonesia-holder').fadeIn("fast"); 
            }, function() { 
                $('#indonesia-holder').fadeOut("fast"); 
            });
            $('#cy').hover(function() { 
                $('#cyprus-holder').fadeIn("fast"); 
            }, function() { 
                $('#cyprus-holder').fadeOut("fast"); 
            });
        });
    </script>
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
            //$(".hidden-menu").slideToggle();
            });

            });
    </script>
    <script type="text/javascript">
         $(window).bind('scroll', function() {
             if ($(window).scrollTop() > 75) {
                 $('#nav').addClass('nav-fix');
                 $('#top').addClass('top-fix');
             }
             else {
                 $('#nav').removeClass('nav-fix');
                 $('#top').removeClass('top-fix');
             }
        });

        console.log('Testing logs');
    </script>
    <style>
        .top-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
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
     
 <?php //$this->load->ext_view('modal', 'exscrolling-nav', '', TRUE); ?>   
    
