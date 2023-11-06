<?php
if(IPLoc::IPCrpAccVerify()){ ?>

    <div class="sidebar-right">

        <?php
        ///$data=FXPP::getRandomArray($menu_item);
        ///if(in_array("a", $data)){
        if(in_array('r_a',$menu_item)){
            ?>
            <div class="side-partnership-holder margintop">
                <a href="<?= FXPP::www_url('affiliate-program'); ?>">
                    <img src="<?= $this->template->Images()?>sidebar/side-partnership-img.png" class="img-responsive">
                </a>
            </div>
        <?php }
        if(in_array('r_b',$menu_item)){ ?>

            <div class="side-thirty-percent-holder margintop">
                <a href="<?= FXPP::www_url('thirty-percent-bonus'); ?>">
                    <img src="<?= $this->template->Images()?>sidebar/thirty-percent-bonus-img.png" class="img-responsive">
                </a>
            </div>
        <?php }
        ///if(in_array("b", $data)){
        if(in_array('r_c',$menu_item)){
            ?>
            <div class="side-contest-holder margintop">
                <a href="<?= FXPP::www_url('Forex-contests/money-fall'); ?>">
                    <img src="<?= $this->template->Images()?>sidebar/side-contest.png" class="img-responsive">
                </a>
            </div>
        <?php }

        if(in_array('r_d',$menu_item)){ ?>
            <div class="side-chat-online-holder margintop">
                <a href="<?= FXPP::www_url('call-back'); ?>"></a>
            </div>
       <?php }
        //// if(in_array("c", $data)){
        if(in_array('r_e',$menu_item)){ ?>
            <div class="side-chooseus-holder margintop">
                <h4>Why Choose Us</h4>
                <div class="choose-item">
                    <a href="<?= FXPP::www_url('why-choose-us'); ?>">
                        <div class="choose item-choose1"></div>
                        <div class="choose-title">Efficient Trading Platform</div>
                    </a>
                    <div class="choose-desc">
                        Notch your way up with MetaTrader 4. <a href="#">Read More</a>
                    </div>
                </div>
                <div class="choose-item">
                    <a href="<?= FXPP::www_url('why-choose-us'); ?>">
                        <div class="choose item-choose2"></div>
                        <div class="choose-title">Adherence to Regulations</div>
                    </a>
                    <div class="choose-desc">
                        As part of industry standards <a href="#">Read More</a>
                    </div>
                </div>
                <div class="choose-item">
                    <a href="<?= FXPP::www_url('why-choose-us'); ?>">
                        <div class="choose item-choose3"></div>
                        <div class="choose-title">Substantial Educational Materials</div>
                    </a>
                    <div class="choose-desc">
                        We exert much time and effort <a href="#">Read More</a>
                    </div>
                </div>
                <div class="choose-item">
                    <a href="<?= FXPP::www_url('why-choose-us'); ?>">
                        <div class="choose item-choose4"></div>
                        <div class="choose-title">Incomparable Trade Execution</div>
                    </a>
                    <div class="choose-desc">
                        Our company has no dealing execution. <a href="#">Read More</a>
                    </div>
                </div>
                <div class="choose-item">
                    <a href="<?= FXPP::www_url('why-choose-us'); ?>">
                        <div class="choose item-choose5"></div>
                        <div class="choose-title">No Debt</div>
                    </a>
                    <div class="choose-desc">
                        In case your account balance falls below <a href="#">Read More</a>
                    </div>
                </div>
                <div class="choose-item">
                    <a href="<?= FXPP::www_url('why-choose-us'); ?>">
                        <div class="choose item-choose6"></div>
                        <div class="choose-title">Unparalleled Customer Support</div>
                    </a>
                    <div class="choose-desc">
                        We put much importance on your trading. <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        <?php }
        /// if(in_array("d", $data)){
        if(in_array('r_f',$menu_item)){?>

            <div class="side-converter-holder margintop">
                <a href="<?= FXPP::www_url('currency-conversion'); ?>">
                    <img src="<?= $this->template->Images()?>sidebar/side-currency-converter.png" class="img-responsive">
                </a>
            </div>

        <?php }
        if(in_array('r_g',$menu_item)){ ?>
            <div class="side-demo-holder margintop">
                <a href="<?= FXPP::www_url('demo-account'); ?>">
                    <img src="<?= $this->template->Images()?>sidebar/side-demo-img.png" class="img-responsive">
                </a>
            </div>

        <?php }

        if(in_array('r_h',$menu_item)){ ?>
            <div class="side-moneyfall-reg-holder margintop">
                <a href="<?= FXPP::www_url('money-fall-registration'); ?>">
                    <img src="<?= $this->template->Images()?>sidebar/side-moneyfall-reg.png" class="img-responsive">
                </a>
            </div>
           <?php }

        if(in_array('news',$menu_item)){ ?>
            <div class="side-news-holder margintop">
                <div class="side-news">
                    <h4>ForexMart NEWS</h4>
                    <div id="new-list"> </div>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            var lang = "<?=FXPP::html_url()?>";
                            if(lang === 'en'){
                                var site_url="<?=FXPP::loc_url('')?>";
                            }else{
                                var site_url="<?=FXPP::loc_url('')?>"+"/";
                            }

                            $.ajax({
                                type: 'POST',
                                dataType:'html',
                                url: site_url+'news/getMostReadForSideMenu',
                                beforeSend:function(){
                                    // $('#loader-holder').show();
                                }
                            }).done(function(response){
                                $("#new-list").html(response);
                            });
                        });
                    </script>
                </div>
            </div>
        <?php } ?>

    </div>

<?php } ?>
