<?php $this->lang->load('datatable');?>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-ratings.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <div class="container">
            <?=$addin_price_specs;?>
            <div class="row">


                <?=$addin_dates_notes;?>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?=$tab;?>
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane" id="tab1">

                                <p class="ins-notes">
                                    <?=lang('cmf_new_04');?>.
                                </p>

                            <div class="table-responsive">
                                <table id="rankings" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            <?=lang('AccountNumber');?>
                                        </th>
                                        <th>
                                            <?=lang('x_mf1');?>
                                        </th>
                                        <th>
                                            <?=lang('x_mf2');?>
                                        </th>
                                        <th>
                                            <?=lang('x_mf6');?>
                                        </th>
                                        <th>
                                            <?=lang('x_mf7');?>
                                        </th>
                                        <th>
                                            <?=lang('x_mf3');?>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  if(isset($rating)){

                                        if(count($rating)){
                                            foreach($rating as $key => $value) {
                                                echo '<tr>';
                                                echo '<td>'.$value['account_number'].'<a target="_blank" href="'.$this->config->item('domain-www').'/'.'contest-monitoring?trader='.$value['account_number'].'" class="chart"><i class="fa fa-line-chart chart"></i></a></td>';
                                                echo '<td>'.$value['NickName'].'</td>';
                                                echo '<td>'.$value['amount'].'</td>';
                                                echo '<td>'.date('m/d/Y H:i:s', strtotime($value['registration_time'])).'</td>';
                                                echo '<td>'.(($value['swap_free'] == 1) ? 'ON' : 'OFF').'</td>';
                                                echo '<td>'.$value['rank'].'</td>';
                                                echo '</tr>';
                                            }
                                            unset($data);
                                        }else{
                                            echo '<tr><td colspan="4" class="center">'. lang('norecy') .'</td></tr>';
                                        }
                                     }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div>
                <?= $DemoAndLiveLinks; ?>
            </div>
        </div>
    </div>
</div>

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
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.pager.numbers_length = 5;
        $("#rankings").DataTable({
            "order": [[ 5, "asc" ]],
//            stateSave: true,
            language: {
                emptyTable:'<?=lang('dta_tbl_01')?>',
                infoEmpty:'<?=lang('dta_tbl_03')?>',
                lengthMenu: '<?=lang('dta_tbl_07')?>',
                search: '<?=lang('dta_tbl_10')?>:',
                "paginate": {
                    "first":     '<?=lang('dta_tbl_12')?>:',
                    "last":      '<?=lang('dta_tbl_13')?>:',
                    "next":      '<?=lang('dta_tbl_14')?>:',
                    "previous":   '<?=lang('dta_tbl_15')?>:'
                }
            }
        });
    });
</script>
