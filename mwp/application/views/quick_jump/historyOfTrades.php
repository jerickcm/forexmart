<div>
<?php if(isset($result)){?>
    <div class="tab-title-header">
        <h1 class="all_tab_title">Only Trades</h1>
    </div>
    <div  class="table-container-holder table-container-border table-container-margin data-center-container">
        <table id="OpenedTrades" class="table table-striped tab-my-acct">
            <thead>
            <tr>
                <th>
                    <?=lang('curtra_04');?>
                </th>
                <th>
                    <?=lang('curtra_05');?>
                </th>
                <th>
                    <?=lang('curtra_06');?>
                </th>
                <th>
                    <?=lang('curtra_07');?>
                </th>
                <th>
                    <?=lang('curtra_08');?>
                </th>
                <th>
                    <?=lang('curtra_09');?>
                </th>
                <th>
                    <?=lang('curtra_10');?>
                </th>
                <th>
                    <?=lang('curtra_11');?>
                </th>
                <th>
                    <?=lang('curtra_12');?>
                </th>
                <th>
                    <?=lang('curtra_13');?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?= $Opened?>
            </tbody>
        </table>
    </div>
<?php }else{ ?>

    <div class="tab-title-header">
        <h1>Only Trades</h1>

        <div  class="table-container-holder table-container-border table-container-margin data-center-container">
            <table id="OpenedTrades" class="table table-striped tab-my-acct">
             <tr>
                 <td id="tr-msg"  colspan="5"><?= $msg?> </td>
             </tr>
            </table>

        </div>

    </div>
<?php } ?>
</div>
