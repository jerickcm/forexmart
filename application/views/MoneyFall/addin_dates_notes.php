<div class="col-sm-5">

</div>
<div class="col-sm-3 btn-srch-holder">

</div>
<div class="col-sm-4 btn-srch-holder">
    <div class="form-group">

    </div>
</div>
<div class="clearfix"></div>

<div class="col-lg-12">
    <p>
        <?=lang('cmf_new_01_0');?>

        <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday this week")))->format(' F j, Y');?></strong>
        <?=lang('cmf_new_01_1');?>
        <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday this week")))->format(' F j, Y');?></strong>.
    </p>
    <p>
        <?=lang('cmf_new_01_2');?>
        <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday next week ")))->format(' F j, Y');?></strong>
        <?=lang('cmf_new_01_3');?>
            <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday next week")))->format(' F j, Y');?></strong>
        <?=lang('cmf_new_01_4');?>
    </p>
    <p>
        <?=lang('cmf_new_02');?>
    </p>
    <p>
        <?=lang('cmf_new_03');?>
    </p>
</div>