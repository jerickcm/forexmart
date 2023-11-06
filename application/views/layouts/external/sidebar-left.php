<?php
if (IPLoc::IPCrpAccVerify()) {
    ?>

    <link href="<?= $this->template->Css(); ?>side-container.css" rel="stylesheet" type="text/css">

    <div class="sidebar-left">
        <?php
        if (in_array('l_a', $menu_item)) {
            ?>
            <div class="side-live-account-holder margintop">
                <a href="https://www.forexmart.com/register">
                    <img src="<?= $this->template->Images() ?>sidebar/side-live-account.png" class="img-responsive">
                </a>
            </div>

        <?php
        }

        if (in_array('l_b', $menu_item)) {
            ?>
            <div class="side-instrument-holder margintop">
                <h4>Financial Instruments</h4>

                <p>
                    ForexMart offers several types of trading instruments.
                </p>
                <ul>
                    <li><a href="<?= FXPP::www_url('Financial_instruments/forex'); ?>">
                            <div class="ins-item ins-icon1">Forex</div>
                        </a></li>
                    <li><a href="<?= FXPP::www_url('financial-instruments/shares'); ?>">
                            <div class="ins-item ins-icon2">CFD on Shares</div>
                        </a></li>
                    <li><a href="<?= FXPP::www_url('financial-instruments/spotmetals'); ?>">
                            <div class="ins-item ins-icon3">Spot Metals</div>
                        </a></li>
                    <li><a href="<?= FXPP::www_url('financial-instruments/bitcoin'); ?>">
                            <div class="ins-item ins-icon4">Bitcoin</div>
                        </a></li>
                    <li><a href="<?= FXPP::www_url('financial-instruments/ruble'); ?>">
                            <div class="ins-item ins-icon5">Ruble</div>
                        </a></li>
                </ul>
            </div>
        <?php
        }

        ///if(in_array("b", $data)){
        if (in_array('l_c', $menu_item)) {
            ?>


            <div class="side-mt4-holder margintop">
                <a href="<?= FXPP::www_url('metatrader4'); ?>">
                    <img src="<?= $this->template->Images() ?>sidebar/side-mt4-img.png" class="img-responsive">
                </a>
            </div>

        <?php
        }
        if (in_array('l_d', $menu_item)) {
            ?>
            <div class="side-bonus-holder margintop">
                <h4>Bonuses</h4>

                <p>
                    Trade more, gain more. Offering different types of bonuses is one way of expressing our profound
                    gratitude to all our clients.
                </p>

                <div class="bonuses-content">
                    <div class="bonus-row">
                        <a href="<?= FXPP::www_url('thirty-percent-bonus'); ?>">
                            <img src="<?= $this->template->Images() ?>gift-circled.png">
                            <h5>ForexMart 30% Bonus</h5>
                        </a>
                    </div>
                    <div class="bonus-row">
                        <a href="<?= FXPP::www_url('no-deposit-bonus'); ?>">
                            <img src="<?= $this->template->Images() ?>ribbon-circled.png">
                            <h5>No Deposit Bonus</h5>
                        </a>
                    </div>
                </div>
            </div>

        <?php
        }

        // if(in_array("c", $data)){
        if (in_array('l_e', $menu_item)) {
            ?>

            <div class="side-vps-holder margintop">
                <a href="<?= FXPP::www_url('vps-hosting'); ?>">
                    <img src="<?= $this->template->Images() ?>sidebar/side-vps-img.png" class="img-responsive" alt="">
                </a>
            </div>

        <?php
        }

        if (in_array('l_f', $menu_item)) {
            ?>
            <div class="side-calc-holder margintop">
                <a href="<?= FXPP::www_url('forex-calculator'); ?>">
                    <img src="<?= $this->template->Images() ?>sidebar/side-calc.png" class="img-responsive" alt="">
                </a>
            </div>
        <?php
        }
        if (in_array('l_g', $menu_item)) {
            ?>
            <div class="side-chart-holder margintop">
                <a href="<?= FXPP::www_url('forex-charts'); ?>">
                    <img src="<?= $this->template->Images() ?>sidebar/side-chart-img.png" class="img-responsive" alt="">
                </a>
            </div>
        <?php
        }
        if (in_array('l_h', $menu_item)) {
            ?>

            <div class="side-laspalmas-holder margintop">
                <a href="<?= FXPP::www_url('las-palmas'); ?>">
                    <img src="<?= $this->template->Images() ?>sidebar/side-laspalmas-img.png" class="img-responsive">
                </a>
            </div>
        <?php
        }
        if (in_array('l_i', $menu_item)) {
            ?>
            <div class="side-contact-holder margintop">
                <a href="https://www.forexmart.com/contact-us">
                    <img src="<?= $this->template->Images() ?>sidebar/side-contact-img.png" class="img-responsive">
                </a>
            </div>

        <?php
        }

        //// if(in_array("d", $data)){
        if (in_array('l_j', $menu_item)) {
            ?>
            <div class="side-regulations-holder margintop">
                <h4>License and Regulations</h4>

                <div class="reg-item">
                    <a href="https://www.forexmart.com/cysec">
                        <div class="reg-logo item-choose1"></div>
                        <div class="reg-title">Cyprus Securities and Exchange Commission</div>
                    </a>
                </div>
                <div class="reg-item">
                    <a href="https://www.forexmart.com/fca">
                        <div class="reg-logo item-choose2"></div>
                        <div class="reg-title">Financial Conduct Authority</div>
                    </a>
                </div>
                <div class="reg-item">
                    <a href="https://www.forexmart.com/amf">
                        <div class="reg-logo item-choose3"></div>
                        <div class="reg-title">Autorité des marchés financiers</div>
                    </a>
                </div>
                <div class="reg-item">
                    <a href="https://www.forexmart.com/bafin">
                        <div class="reg-logo item-choose4"></div>
                        <div class="reg-title">Federal Financial Supervisory Authority</div>
                    </a>
                </div>
                <div class="reg-item">
                    <a href="https://www.forexmart.com/consob">
                        <div class="reg-logo item-choose5"></div>
                        <div class="reg-title">Commissione Nazionale per le Società e la Borsa</div>
                    </a>
                </div>
            </div>

        <?php
        }

        //// if(in_array("d", $data)){
        if (in_array('l_k', $menu_item) && $this->input->cookie('forexmart_affiliate')=='' ) {
            ?>
            <div class="side-cashback-holder margintop">
                <a href="<?=FXPP::www_url('cashback');?>">
                    <img src="<?= $this->template->Images() ?>sidebar/side-cashback-img.png" class="img-responsive">
                </a>
            </div>

        <?php } ?>


    </div>

<?php } ?>
