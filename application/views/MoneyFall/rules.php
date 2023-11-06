

<?php if(FXPP::html_url()=='sa' and IPLOC::Office_and_Vpn()){?>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-contest-rules.css' type='text/css'  />"));
    });
</script>
<?php }?>

<script type='text/javascript'>
    $(document).on('click', '#PublicRatings', function (e) {
        $('#PublicRatings a').addClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicWinners', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').addClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicContestRules', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').addClass('active');
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('html, body').animate({
            scrollTop: $('#container_rules').offset().top - 200
        }, 500);

        var div1 = $('.div1'), div3 = $('.div3'), widescreen = $('.wide-screen'), mobscreen = $('.mob-screen');
        $(window).load(function () {
            var width = $(window).width();
            if (width <= 991 && width >= 768) {
                div1.addClass('col-sm-4');
                div1.removeClass('col-sm-3');
                div3.addClass('col-sm-6');
                div3.removeClass('col-sm-4');
                widescreen.hide();
                mobscreen.show();
            } else {
                widescreen.show();
                mobscreen.hide();
            }
        });
        $(window).resize(function () {
            var width = $(window).width();
            if (width <= 991 && width >= 768) {
                div1.addClass('col-sm-4');
                div1.removeClass('col-sm-3');
                div3.addClass('col-sm-6');
                div3.removeClass('col-sm-4');
                widescreen.hide();
                mobscreen.show();
            } else {
                div1.removeClass('col-sm-4');
                div1.addClass('col-sm-3');
                div3.removeClass('col-sm-6');
                div3.addClass('col-sm-4');
                widescreen.show();
                mobscreen.hide();
            }
        });
    });
</script>

<div class="reg-form-holder">
    <?php echo $contest_header ?>
    <div class="container" id="container_rules">
        <h3 class="text-center ext-arabic-circles-list"><?= lang('ccr_h1_tit');?></h3>
        <hr/>
        <ol class="circles-list ext-arabic-circles-list">
            <!--General Provisions-->
            <li><span class="tabcontest-title"><?= lang('ccr_i');?></span>
                <ol class="simple-list ext-arabic-simple-list">
                    <!--Contest title - "Money Fall" (hereinafter - Contest).-->
                    <li><?= lang('ccr_i1');?></li>
                    <!--The Contest is organized by ForexMart (hereinafter - Organizer).-->
                    <li><?= lang('ccr_i2');?></li>
                    <!--It is a weekly Contest held from Monday 00:00 till Friday 23:59:59 (terminal time).-->
                    <li><?= lang('ccr_i3');?></li>
                    <!--Prize pool of each weekly contest amounts to 2000 USD* and is distributed among winners in the following way:-->
                    <!--Registration for each new Contest is open during the week preceding it. Registration finishes 1 (one) hour before the Contest starts.-->
                    <li><?= lang('ccr_i5');?></li>
                    <!--The resulting data is recorded at 12:00 GMT+3 on Saturday. The daylight saving time starts according to the U.S. standard on the second Sunday in March and ends on the first Sunday in November.-->
                    <li><?= lang('ccr_i6');?></li>
                </ol>
            </li>
            <!--Participants-->
            <li><span class="tabcontest-title"><?= lang('ccr_ii');?></span>
                <ol class="simple-list ext-arabic-simple-list">
                    <!--Every owner of a trading account with ForexMart Company can take part in the Contest weekly (hereinafter - Participant).-->
                    <li><?= lang('ccr_ii1');?></li>
                    <!--Only full-aged customers (over 18 years old) may participate in the Contest.-->
                    <li><?= lang('ccr_ii2');?></li>
                    <!--Every Participant shall sign up on the ForexMart website.-->
                    <li><?= lang('ccr_ii3');?></li>
                    <!--For participation in every weekly contest Participants open individual demo accounts.-->
                    <li><?= lang('ccr_ii4');?></li>
                    <!--The Participant agrees to provide true data, the full name identical to one specified in the ID document, available email address.-->
                    <li><?= lang('ccr_ii5');?></li>
                    <!--In case trading on two or more accounts is conducted from the same IP, the Administration reserves the right to dismiss their owner(-s) . Thus, it is strongly not recommended to employ GPRS- and 3G- modems.-->
                    <li><?= lang('ccr_ii6');?></li>
                    <!--The Organizer reserves the right to decline registration of any participant without explaining the reason or disqualify any participant during the Contest or after the Contest is over with explanation. The reason for disqualification can be opening of big volume opposite orders with the same currency pairs on different trading accounts at the same time approximately, as well as usage of errors in the quote flow for getting a guaranteed profit.-->
                    <li><?= lang('ccr_ii7');?></li>
                    <!--Registering in the Contest a Participant accepts all regulations related to the Contest.-->
                    <li><?= lang('ccr_ii8');?></li>
                    <!--The Participant's close relatives are disallowed for taking part in the same contest. If the registration data of the Contestant's account coincides with the one of another Contestant, the Company has a right to regard this matching as a reason for disqualification.-->
                    <li><?= lang('ccr_ii9');?></li>
                </ol>
            </li>
            <!--Trading terms-->
            <li><span class="tabcontest-title"><?= lang('ccr_iii');?></span>
                <ol class="simple-list ext-arabic-simple-list">
                    <!--After registration in the Contest the Participant gets a demo account.-->
                    <li><?= lang('ccr_iii1');?></li>
                    <!--Initial deposit is 5,000 USD for all Participants and it cannot be changed.-->
                    <li><?= str_replace('USD', $default_currency, lang('ccr_iii2'));?></li>
                    <!--Leverage is 1:500 by default.-->
                    <li><?= lang('ccr_iii3');?></li>
                    <!--All orders which were put at non-market price are destined to cancellation. The Contest Administration reserves the right to disqualify the account which was employed for trading at non-market quotations.-->
                    <li><?= lang('ccr_iii4');?></li>
                    <!--Participants may use Expert Advisors and any trading strategies without any restrictions.-->
                    <li><?= lang('ccr_iii5');?></li>
                    <!--Major currency pairs and cross rates are the only available trading instruments at the Contest.-->
                    <li><?= lang('ccr_iii6');?></li>
                    <!--Minimal trade volume is 0.01 lot, maximal - 1 lot.-->
                    <li><?= lang('ccr_iii7');?></li>
                    <!--Participant can change the trading account type to Swap free by contacting the Support Department.-->
                    <li><?= lang('ccr_iii8');?></li>
                    <!--The maximum number of open trades including pending orders is 5.-->
                    <li><?= lang('ccr_iii9');?></li>
                    <!--Stop-out level is 10%.-->
                    <li><?= lang('ccr_iii10');?></li>
                    <!--Other trading terms for the contest trading accounts are the same as for the live trading accounts with ForexMart.-->
                    <li><?= lang('ccr_iii11');?></li>
                </ol>
            </li>
            <!--Results Publishing-->
            <li><span class="tabcontest-title"><?= lang('ccr_iv');?></span>
                <ol class="simple-list ext-arabic-simple-list">
                    <!--Equity of Participants' accounts is available in free access on the company's website during the contest period.-->
                    <li><?= lang('ccr_iv1');?></li>
                    <!--Organizer reserves the right to publish participants' names after the Contest finishes.-->
                    <li><?= lang('ccr_iv2');?></li>
                    <!--The residential data of Participants may be published as well.-->
                    <li><?= lang('ccr_iv3');?></li>
                    <!--Contest results are published during 14 days after the Contest finishes and all checking procedures are completed.-->
                    <li><?= lang('ccr_iv4');?></li>
                </ol>
            </li>
            <!--Winners Determination-->
            <li><span class="tabcontest-title"><?= lang('ccr_v');?></span>
                <ol class="simple-list ext-arabic-simple-list">
                    <!--After the current Contest finishes all trades are closed automatically at current prices.-->
                    <li><?= lang('ccr_v1');?></li>
                    <!--The biggest balance holders will be announced as winners.-->
                    <li><?= lang('ccr_v2');?></li>
                    <!--In case two Participants have the same profit, the winner is determined by the Organizer.-->
                    <li><?= lang('ccr_v3');?></li>
                    <!--The Contest winners agree with their names publishing.-->
                    <li><?= lang('ccr_v4');?></li>
                    <!--A Participant who has taken one of the prize-winning places in the Contest cannot pretend to the prize next month. In case such precedent appears, prize will be passed to the next Participant by turns. The rank will be moved one by one.-->
                    <li><?= lang('ccr_v5');?></li>
                    <!--In order to obtain a prize, each winner shall fulfill the following requirement: at least 5% of the total profit has to be derived from trading results on EURUSD and 5% of the total profit from trading results on USDJPY.-->
                    <li><?= lang('ccr_v6');?></li>
                    <!--The Organizer reserves the right to decline the Participant's registration request without reasoning and disqualify the Participant, either during the Contest or after it has finished, upon direct or indirect evidence of attempted fraudulent operations with the prize funds.-->
                    <li><?= lang('ccr_v7');?></li>
                    <!--The Company reserves the right to decline to credit the prize money if the Participant accumulates the prizes on one or several accounts.-->
                    <li><?= lang('ccr_v8');?></li>
                </ol>
            </li>
            <!--Prize Receipt-->
            <li><span class="tabcontest-title"><?= lang('ccr_vi');?></span>
                <ol class="simple-list ext-arabic-simple-list">
                    <!--The winners should open and verify their live trading accounts within 30 days after the contest results are published.-->
                    <li><?= lang('ccr_vi1');?></li>
                    <!--The prize funds will be credited to a verified live trading account opened by the winner.-->
                    <li><?= lang('ccr_vi2');?></li>
                    <!--The winner acknowledges liability for any activity on the account opened by the Contest and Campaign Administration or by the winner himself lying within the scope of the agreements and regulations of  .-->
                    <li><?= lang('ccr_vi3');?></li>
                    <!--All prizes including the first prize cannot be withdrawn, however, any profit made over the prize amount can be withdrawn without any limits.-->
                    <li><?= lang('ccr_vi4');?></li>
                    <!--The Organizer reserves the right to declare any already given prize invalid and subject to cancellation upon direct or indirect evidence of attempted fraudulent operations with the prize funds.-->
                    <li><?= lang('ccr_vi5');?></li>
                    <!--A trading account is charged off automatically at filing an application for withdrawal. At considering the application the specialists make sure that the balance and free margin comply with the amount of funds available for withdrawing. In case of discrepancy the sum specified in the withdrawal application is credited back to the account.-->
                    <li><?= lang('ccr_vi6');?></li>
                </ol>
            </li>
            <!--Language-->
            <li class=""><span class="tabcontest-title"><?= lang('ccr_vii');?></span>
                <ol class="conrules-lang simple-list ext-arabic-simple-list">
                    <!--The language of the present rules is English.-->
                    <li><?= lang('ccr_vii1');?></li>
                    <!--For the Participant convenience, the Organizer can provide the rules in a language different from English. The translated version of the rules is of a merely informative character.-->
                    <li><?= lang('ccr_vii2');?></li>
                    <!--In case of variant readings of a translated version and the rules in English, the rules in English are considered as a prior reference standard.-->
                    <li><?= lang('ccr_vii3');?></li>
                </ol>
            </li>
        </ol>
    </div>
    <div class="container">
        <?php echo $registration_link ?>
    </div>
</div>
