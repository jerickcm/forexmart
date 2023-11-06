<?php $this->lang->load('datatable');?>
<div class="reg-form-holder">
    <?php echo $contest_header ?>
    <div class="container" id="container_ranking">
        <h3 class="text-center"><?=lang('cmf_contestleaders') ?></h3>
        <hr>
        <div class="table-responsive">
            <table id="rankings" class="table table-responsive table-striped table-hover table-borderless">
                <thead>
                <tr style="border-bottom: 1px solid #00aeef;">
                    <th style="text-align: center;">
                      &nbsp;
                    </th>
                    <th>
                        <?=lang('x_mf9'); ?>
                    </th>
                    <th>
                        &nbsp;
                    </th>
                    <th>
                        &nbsp;
                    </th>
                    <th>
                        &nbsp;
                    </th>
                    <th>
                        <?=lang('x_mf2');?>
                    </th>
                    <th>
                        <?=lang('x_mf7');?>
                    </th>
                    <th>
                        <?=lang('x_mf8');?>
                    </th>
                    <th>
                        <?=lang('x_mf6');?>
                    </th>

                    <th>
                       <?=lang('x_mf12');?>
                    </th>



                </tr>
                </thead>
                <tbody>
                <?php  if(isset($rankings)){

                    if(count($rankings)){
                        foreach($rankings as $key => $value) {
                            echo '<tr>';
                            echo '<td style="vertical-align:middle; text-align: center;">'.$value['rank'].'</td>';
                            echo '<td style="vertical-align:middle;"><img alt="" src="' . $this->template->Images() . 'trader_avatar.png"></td>';
                            echo '<td style="text-align:left; vertical-align:middle;"><a href="'.$this->config->item('domain-www').'/'.'contest-monitoring/trader/'.$value['account_number'].'"><u>' . $value['NickName'] . '</u></a><br>' . $value['country_name'] . '</td>';
                            echo '<td style="text-align:left; vertical-align:middle;">' . $value['NickName'] . '</td>';
                            echo '<td>'.$value['account_number'].'</td>';
                            echo '<td style="vertical-align:middle; color:#29a643;">'.$value['amount'].'</td>';
                            echo '<td style="vertical-align:middle;">'.(($value['swap_free'] == 1) ? 'YES' : 'NO').'</td>';
                            echo '<td style="vertical-align:middle;">'.$value['leverage'].'</td>';
                            echo '<td style="vertical-align:middle;">'.date('m/d/Y H:i:s', strtotime($value['created'])).'</td>';
                            echo '<td style="vertical-align:middle;">'.$value['start_end'].'</td>';

                        }
                            echo '</tr>';
                        
                        unset($data);
                    }else{
                        echo '<tr><td colspan="4" class="center">'. lang('norecy') .'</td></tr>';
                    }
                }?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <br>
        <div id="div3">
            <p><?=lang('x_mf11'); ?></p>
        </div>
    </div>

    <div class="container">
        <?php echo $registration_link ?>
    </div>
<!--</div>-->
<script type="text/javascript">
    $(document).ready(function() {
        <?php if( $isAutoScroll === true ){ ?>
        $('html, body').animate({
            scrollTop: $('#container_ranking').offset().top - 200
        }, 500);
        <?php } ?>

        $.fn.dataTable.ext.pager.numbers_length = 5;
        $("#rankings").DataTable({
            "order": [[ 5, "desc" ]],
            "aoColumns": [
                { "bSortable": true },
                { "bSortable": false },
                { "bSortable": true, "iDataSort": 3 },
                { "bSortable": true, "bSearchable": false, "bVisible": false },
                { "bSortable": true, "bSearchable": true, "bVisible": false },
                { "bSortable": true },
                { "bSortable": true },
                { "bSortable": true },
                { "bSortable": true }
                ,{ "bSortable": true }
            ],

            "oLanguage": {
                "sInfo": "<?=lang('dta_tbl_02')?>",
                "sInfoEmpty":"<?=lang('dta_tbl_03')?>",
                "sEmptyTable":"<?=lang('dta_tbl_01')?>",
                "sLengthMenu":"<?=lang('dta_tbl_07')?>",
                "sSearch":"<?=lang('dta_tbl_10')?>",
                "oPaginate": {
                    "sFirst":     '<?=lang('dta_tbl_12')?>:',
                    "sLast":      '<?=lang('dta_tbl_13')?>:',
                    "sNext":      '<?=lang('dta_tbl_14')?>:',
                    "sPrevious":   '<?=lang('dta_tbl_15')?>:'
                }
            }

        });
    });
</script>