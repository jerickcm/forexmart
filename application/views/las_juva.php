
<link href="<?= $this->template->Css()?>jquery.fancybox.css" rel="stylesheet">

<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
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

//            $('.menu-button').click(function(){
//            $(".hidden-menu").slideToggle();
//            });

            });
    </script>
    <script type="text/javascript">
         $(window).bind('scroll', function() {
             if ($(window).scrollTop() > 95) {
                 $('#nav').addClass('nav-fix');
             }
             else {
                 $('#nav').removeClass('nav-fix');
             }
        });
    </script>

    <style>
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
        .fx-drp{
            z-index: 99;
        }
    </style>

<div class="reg-form-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="row">
                        <h1 class="license-title col-sm-6"></h1>
                    </div> -->                  
                    
                       <div class="personal-page-holder">
                        <div class="personal-info-holder row">
                            <div class="col-md-3 col-sm-3 ext-arabic-personal-img-holder">
                                <div class="personal-img-holder">
                                    <img src="<?= $this->template->Images()?>valeron-dp.png" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9" dir="ltr">
                                <div class="personal-info ext-arabic-personal-info">
                                    <div class="club-info-holder">
                                        <span>21</span>
                                        <div class="player-name ext-arabic-player-name">
                                            <h1>
                                                <?=lang('ljv_01');?>
<!--                                                Juan Valerón-->
                                                <small><img src="<?= $this->template->Images()?>laspalmas-logo.png" class="laspalmas-sm-logo">
                                                    <?=lang('ljv_02');?>
<!--                                                    UD Las Palmas-->
                                                </small></h1>
                                        </div><div class="clearfix"></div>
                                    </div>
                                    <p class="p-fc">
                                        <?=lang('ljv_03');?>
<!--                                        Full Name:-->
                                        <span>
                                            <?=lang('ljv_04');?>
<!--                                            Juan Carlos Valerón Santana-->
                                        </span></p>
                                    <p>
                                        <?=lang('ljv_05');?>
<!--                                        Date of Birth:-->
                                        <span>
                                            <?=lang('ljv_06');?>
<!--                                            June 17, 1975-->
                                        </span></p>
                                    <p>
                                        <?=lang('ljv_07');?>
<!--                                        Place of Birth:-->
                                        <span>
                                            <?=lang('ljv_08');?>
<!--                                            Arguineguín, Spain-->
                                        </span></p>
                                    <p>
                                        <?=lang('ljv_09');?>
<!--                                        Height:-->
                                        <span>
                                            <?=lang('ljv_10');?>
<!--                                            1.84 m (6 ft 1⁄2 in)-->
                                        </span></p>
                                    <p>
                                        <?=lang('ljv_11');?>
<!--                                        Playing Position:-->
                                        <span>
                                            <?=lang('ljv_12');?>
<!--                                            Attacking midfielder-->
                                        </span></p>
                                </div>
                            </div>
                            <div class="col-md-12"  style="margin-top: -10px;" dir="ltr">
                                <div id="demo" class="demo">
                                    <div class="span12">
                                        <div id="owl-demo" class="owl-carousel">
                                            <div class="item">
                                                
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/1.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_1.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/2.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_2.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/3.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_3.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/4.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_4.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/5.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_5.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/6.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_6.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/7.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_66.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/8.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_8.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/9.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_9.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/10.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_10.png"></a>
                                            </div>
                                            <div class="item">
                                                <a class="fancybox" href="<?= $this->template->Images()?>gallery/big/11.png" data-fancybox-group="gallery"><img class="lazyOwl" data-src="<?= $this->template->Images()?>gallery/big/1_11.png"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
     
                        <p class="personal-info-text">
                        <span>
                            <?=lang('ljv_13');?>
<!--                            Juan Valerón-->
                        </span>
                            <?=lang('ljv_14');?>
<!--                            (born-->
                            <span>
                                <?=lang('ljv_15');?>
<!--                                Juan Carlos Valerón Santana-->
                            </span>)
                            <?=lang('ljv_16');?>
<!--                            was born on 17 June 1975. He plays for Spanish football team-->
                            <a href="#">
                                <?=lang('ljv_17');?>
<!--                                Unión Deportiva Las Palmas-->
                            </a>
                            <?=lang('ljv_18');?>
<!--                            as an attacking midfielder. Known for his exceptional technical skills, the footballer has played in 390 games and chalked up 90 goals in La Liga for 15 seasons.-->
                            <span>
                            <?=lang('ljv_19');?>
<!--                                Valerón-->
                            </span>
                            <?=lang('ljv_20');?>
<!--                            represented Spain in two European Championships and the 2002 World Cup, which made him achieve 46 caps. He used to play for Club Atlético de Madrid, Deportivo de La Coruña, and Real Club Deportivo Mallorca.-->
                    </p>
                    <h1 class="personal-text-title">
                        <?=lang('ljv_21');?>
<!--                        Action-Packed Career-->
                    </h1>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_22');?>
<!--                        His football career started with UD Las Palmas. But he moved to the Balearic Islands and represented RCD Mallorca between 1997 and 1998 seasons.-->
                        <span>
                            <?=lang('ljv_23_v');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_23');?>
<!--                        first appearance La Liga was on 31 August 1997 with a 2-1 home win over Valencia Club de Fútbol in a 10-minute game. During his stay with RCD Mallorca, he greatly helped the club secure the much-coveted qualification for the UEFA Cup Winners’ Cup. The team closed fifth in the competition and hit the last leg of Copa del Rey. But the Futbol Club Barcelona ended their stint with a penalty shootout.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_24');?>
<!--                        Two years later, the young player joined Atlético Madrid in which he became the undisputed starter until after the club’s relegation in 2000. -->
                        <span>
                            <?=lang('ljv_24_v');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_25');?>
<!--                        also played for Deportivo and shared position with Brazilian football player Djalma Feitosa Dias (or Djalminha). In 2004,-->
                        <span>
                            <?=lang('ljv_26');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_27');?>
<!--                        spent the remainder of his booming career in Galicia.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_28');?>
<!--                        But an unfortunate incident halted him in his tracks. In January 2006,-->
                        <span>
                            <?=lang('ljv_29');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_30');?>
<!--                        sustained a knee injury that relapsed a year after. The professional footballer only managed to take part in two leagues during his recuperation period. Then, he had another surgery.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_31');?>
<!--                        The renowned footballer did not reemerge until the 2007-2008 campaign.-->
                        <span>
                            <?=lang('ljv_32');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_33');?>
<!--                        marked his comeback to Deportivo when they reaped a 3-1 home victory against Real Valladolid Club de Fútbol. This time,-->
                        <span>
                            <?=lang('ljv_34');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_35');?>
<!--                        became a significant first-team player both in Spain and Europe.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_36');?>
<!--                        Between the 2011 and 2012 seasons, the football player became Deportivo’s undeniable starter. As his team reclaimed their top flight as champions,-->
                        <span>
                            <?=lang('ljv_37');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_38');?>
<!--                        attained a career-best five goals in nearly 3,000 minute action in Segunda División. The professional player recorded 422 games and scored 32 goals. But in 2013,-->
                        <span>
                            <?=lang('ljv_39');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_40');?>
<!--                        decided to end the contract and returned to his first football team.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <span>
                            <?=lang('ljv_41');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_42');?>
<!--                        went back to UD Las Palmas again and inked a 1+1 contract. He was still a vital first-team member even after he left the club for 16 years. He gained promotion to the leading flight in 2015. Also,-->
                        <span>
                            <?=lang('ljv_43');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_44');?>
<!--                        also renewed his contract with the Amarillos and resurfaced in the top league. The 22-minute game led to a 1-2 away loss to Barcelona, his first game in the First Division after 847 days. He became the fifth oldest player to join the league. In December,-->
                        <span>
                            <?=lang('ljv_45');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_46');?>
<!--                        was promoted to one position higher after playing as a substitute versus Real Betis Balompié.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_47');?>
<!--                       The  recognized footballer played in a 2-2 friendly draw with Italy in Salerno.-->
                        <span>
                            <?=lang('ljv_48');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_49');?>
<!--                        also joined Spain’s national team at UEFA Euro in the 2002 World Cup, where they notched a 3-1 triumph against Slovenia. In Euro 2004, the team made a 1-0 win versus Russia.-->
                    </p>
                    <h1 class="personal-text-title">
                        <?=lang('ljv_50');?>
<!--                        Recognition-->
                    </h1>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <span>
                            <?=lang('ljv_51');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_52');?>
<!--                        is recognized as one of the most reputable players in Spain. His manager Juan Antonio Anquela described the football player as a reference to the nation’s football. Coach Vicente del Bosque said-->
                        <span>
                            <?=lang('ljv_53');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_54');?>
<!--                        would always suit in the country’s national team. Coach Andrés Iniesta mentioned he would pay to see-->
                        <span>
                            <?=lang('ljv_55');?>
<!--                            Valeró-->
                        </span>
                        <?=lang('ljv_56');?>
<!--                        in a football arena.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_57');?>
<!--                        National teammate and FC Barcelona manager Luis Enrique commended his pitch. Former Dutch footballers Jimmy Floyd Hasselbaink and Roy Makaay considered him as the best player they played with.-->
                    </p>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <?=lang('ljv_58');?>
<!--                        UD Las Palmas fellow Javi Castellano hailed-->
                        <span>
                            <?=lang('ljv_59');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_60');?>
<!--                        for his honesty and humility. His team’s President Miguel Ángel Ramírez was attempting to convince-->
                        <span>
                            <?=lang('ljv_61');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_62');?>
<!--                        to play another season to bid farewell to all Spanish stadia.-->
                    </p>
                    <h1 class="personal-text-title">
                        <?=lang('ljv_63');?>
<!--                        Life Outside Football-->
                    </h1>
                    <p class="personal-info-text ext-arabic-personal-info-text">
                        <span>
                            <?=lang('ljv_64');?>
<!--                            Valerón-->
                        </span>
                        <?=lang('ljv_65');?>
<!--                        , although known for his devotion to the Lord, confessed he and his family are not part of any religion. His older brother, Miguel Ángel, was a footballer and a midfielder. Together with his other sibling Pedro, they established a football club called Abrisajac, a hybrid of Biblical names Abraham, Isaac, and Jacob. Manu,-->
                        <span>
                            <?=lang('ljv_66');?>
<!--                            Valerón-->

                        </span>
                        <?=lang('ljv_67');?>
<!--                        nephew, is a Las Palmas player as well.-->
                    </p>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <style>
    #owl-demo .item{
        margin: 3px;
        height: 140px!important;
    }
    #owl-demo .item img{
        display: block;
        /*width: 100%;*/
        /*height: auto;*/
        margin:0 auto;
        margin-top: 80px;
    }
    .demo{margin-top: 0px !important}
    </style>
    <!-- carousel for valeron page -->
    
<script src="<?= $this->template->Js()?>/jquery.fancybox.pack.js"></script>    
    
    
    <script> 
        
        
        $(document).ready(function() {

            $("#owl-demo").owlCarousel({
                autoPlay : 5000, //Set AutoPlay to 3 seconds
                items : 5,
                lazyLoad : true,
                dots : false,
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