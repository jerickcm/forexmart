<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-contest-tab.css' type='text/css'  />"));
    });
</script>
<ul class="contest-tab">
    <li id="PublicRatings" >
        <a id="pr" href="<?=FXPP::loc_url('contest/ratings')?>"   class="listitem ">
            <?= lang('cmf_ranking')?>
        </a>
    </li>
    <li id="PublicWinners"  >
        <a id="pw" href="<?=FXPP::loc_url('contest/winners')?>"   class="listitem  ">
            <?= lang('cmf_winners')?>
        </a>
    </li>
    <li id="PublicContestRules" >
        <a id="pcr" href="<?=FXPP::loc_url('contest/contestrules')?>"  class="listitem ">
            <?= lang('cmf_contestrules')?>
        </a>
    </li>

</ul>
<div class="clearfix"></div>

<script type="text/javascript">

    var hh=0;
    var pr=0;
    var pw=0;
    var pcr=0;


    $(window).load(function() {

        pr = parseFloat($('#pr').height());
        pw = parseFloat($('#pw').height());
        pcr = parseFloat($('#pcr').height());


        hh=parseFloat(Math.round(Math.max(pr,pw,pcr)));
        $('#pr').height(hh);
        $('#pw').height(hh);
        $('#pcr').height(hh);

    });

    $(window).resize(function() {

        pr = parseFloat($('#pr').height());
        pw = parseFloat($('#pw').height());
        pcr = parseFloat($('#pcr').height());


        hh=parseFloat(Math.round(Math.max(pr,pw,pcr)));
        $('#pr').height(hh);
        $('#pw').height(hh);
        $('#pcr').height(hh);
    });

</script>

