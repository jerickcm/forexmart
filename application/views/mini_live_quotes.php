<link href="<?php echo $this->template->Css()?>home-chart-small.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="charttitle"><h3>Live Quotes</h3></div>
    <hr class="bottomline">
    <section>
        <div class="tabs tabs-style-line">
            <nav>
                <ul>
                    <li><a href="#section-line-1"><span>FOREX</span></a></li>
                    <li><a href="#section-line-2"><span>SHARES</span></a></li>
                    <li><a href="#section-line-3"><span>METALS</span></a></li>
                    <li><a href="#section-line-4"><span>BITCOIN</span></a></li>
                </ul>
            </nav>
            <div class="content-wrap">
                <section id="section-line-1">

                    <div class="col-md-6">
                        <table class="table table-responsive table-hover kurs">
                            <tbody style="text-align:center;">
                            <tr class="active">
                                <td style="width:30%;">EUR/USD</td>
                                <td style="width:25%;" class="uptext">1.1382</td>
                                <td style="width:45%;"><span class="uplevel">0.0012 / 0.10%</span></td>
                            </tr>
                            <tr>
                                <td>AUD/USD</td>
                                <td class="downtext">0.7350</td>
                                <td><span class="downlevel">-0.0010 / -0.13%</span></td>
                            </tr>
                            <tr>
                                <td>USD/CAD</td>
                                <td class="uptext">1.2936</td>
                                <td><span class="uplevel">0.0027 / 0.21%</span></td>
                            </tr>
                            <tr>
                                <td>EUR/GBP</td>
                                <td class="uptext">0.7881</td>
                                <td><span class="uplevel">0.0010 / 0.13%</span></td>
                            </tr>
                            <tr>
                                <td>GBP/USD</td>
                                <td class="uptext">1.4443</td>
                                <td><span class="uplevel">0.0003 / 0.02%</span></td>
                            </tr>
                            <tr>
                                <td>EUR/CHF</td>
                                <td class="downtext">1.1088</td>
                                <td><span class="downlevel">-0.0008 / -0.07%</span></td>
                            </tr>
                            <tr>
                                <td>AUD/CHF</td>
                                <td class="uptext">0.5233</td>
                                <td><span class="uplevel">0.0033 / 0.03%</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6 col-xs-6 ">
                            <div class="col-xs-12 kursbetween">
                                EUR/USD
                            </div>
                            <div class="col-xs-12 kursvalue">
                                1.1382
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6 no-padding kurs-holder">
                            <div class="col-xs-12 bluelevel ">
                                0.0012 / 0.10%
                            </div>
                            <div class="col-xs-12 greylevel">
                                HI 1.1392 - LO 1.1368
                            </div>
                        </div>
                        <div class="col-md-12">
                            <img src="images/chart.jpg" class="img-responsive">
                        </div>
                    </div>

                </section>
                <section id="section-line-2"><p>2</p></section>
                <section id="section-line-3"><p>3</p></section>
                <section id="section-line-4"><p>4</p></section>
            </div><!-- /content -->
        </div><!-- /tabs -->
    </section>

</div>
<script src="<?php echo $this->template->Js()?>cbpFWTabs.js" type="text/javascript"></script>
<script>
    (function() {

        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
            new CBPFWTabs( el );
        });

    })();
</script>