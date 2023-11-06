<style>
    .company {
        color: #2988CA;
        font-weight: 600;
    }
</style>

<!-- footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p class="footer-text">
                    <cite>Risk Warning:</cite>Foreign exchange is highly speculative and complex in nature, and may not be suitable for all
                    investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest
                    money you cannot afford to lose. Before using the services offered by <span class="company">ForexMart</span>, please
                    acknowledge and understand the <a href="<?=FXPP::loc_url('risk-disclosure')?>">risks</a>  relative to forex trading. Seek financial advice, if necessary.
                </p>
                <p class="footer-text1">
                    <img class="tradomart"  width="101" height="11" alt="" src="<?= $this->template->Images()?>tradomart/tradomart-ltd-small-black.png" />  is regulated by Cyprus Securities and Exchange Commission(CySEC) under licence no. 266/15.
                </p>
            </div>

        </div>
    </div>
</footer>

<?php /** Preloader Modal Start */ ?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<?php /** Preloader Modal End */ ?>

<!-- end footer -->