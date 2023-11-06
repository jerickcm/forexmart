<style>
    label {
        display: block;
        max-width: 100%;
        margin-bottom: 0;
        font-weight: bold;
    }
    .form-group{
        margin-bottom: 0px;
    }
    table.dataTable {
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        border: 1px solid #cecece;
    }
    div.dataTables_filter {
        text-align: right;
        float: right;
    }
    .datepicker {
        z-index: 10002 !important;
    }
</style>
<?php
$start = date('m/d/Y',strtotime("yesterday"));
$end =  date('m/d/Y',strtotime("today"));
?>
<section class="content-header">
    <h1>Operations</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-balance-scale"></i> Balance</li>
        <li class="active">Operations</li>
    </ol>
</section>

<section class="content">
    <div class="box style-box">
        <div class="box-body">
            <div class="style-saldo-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <form class="form-horizontal">
                    <div class="form-group" style="width: 50%; margin-left: 25%;">
                        <label>Account Number: </label>
                        <input id="balops_acctno" name="account_number" type="text" class="form-control" placeholder="Account Number" require/>
                    </div>
                    <div class="form-group" style="width: 50%; margin-left: 25%;">
                        <label><?=lang('hot_03');?></label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control pull-right" id="date_start" name="start_date"  placeholder="" value="<?=$start; ?>">
                        </div>
                    </div>
                    <div class="form-group" style="width: 50%; margin-left: 25%;">
                        <label><?=lang('hot_04');?></label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control pull-right"  id="date_end" name="start_end" placeholder="" value="<?=$end; ?>">
                        </div>
                    </div>
                    <div class="saldo-calculate-button">
                        <a href="javascript:void(0)" class="btnsearch btn-calc hit hitW">Search</a>
                    </div>
                </form>
            </div>


            <div role="tabpanel" class="tab-pane table-responsive" id="bal" style="display: none;overflow-x: hidden;overflow-y: scroll;padding: 10px;">
                <table class="table table-striped tab-my-acct arabic-part-table arabic-trans-history-table " id="BalanceOperation" name="BalanceOperation" >
                    <thead>
                    <tr>
                        <th style="width: 60px;"><?=lang('hot_09');?></th>
                        <th><?=lang('hot_10');?></th>
                        <th><?=lang('hot_11');?></th>
                        <th><?=lang('hot_12');?></th>
                        <th><?=lang('hot_13');?></th>
                        <th><?=lang('hot_14');?></th>
                        <th><?=lang('hot_15');?></th>
                        <th><?=lang('hot_16');?></th>
                        <th><?=lang('hot_17');?></th>
                        <th><?=lang('hot_18');?></th>
                    </tr>
                    </thead>
                    <tbody id="showoff"></tbody>
                </table>
                <table class="table table-striped tab-my-acct arabic-part-table arabic-trans-history-table display-n" id="BalanceOperationBonus"   >
                    <thead>
                    <tr><th colspan="6">Bonus</th></tr>
                    <tr>
                        <th style="width: 60px;"><?=lang('hot_24');?></th>
                        <th><?=lang('hot_25');?></th>
                        <th><?=lang('hot_26');?></th>
                        <th><?=lang('hot_27');?></th>
                        <th><?=lang('hot_28');?></th>
                        <th><?=lang('hot_29');?></th>
                    </tr>
                    </thead>
                    <tbody id="balancebonus"></tbody>
                </table>
                <table class="table table-striped tab-my-acct arabic-part-table arabic-trans-history-table display-n" id="BalanceOperationDeposit" >
                    <thead>
                    <tr>
                        <th colspan="6">Deposit</th>
                    </tr>
                    <tr>
                        <th style="width: 60px;"><?=lang('hot_24');?></th>
                        <th><?=lang('hot_25');?></th>
                        <th><?=lang('hot_26');?></th>
                        <th><?=lang('hot_27');?></th>
                        <th><?=lang('hot_28');?></th>
                        <th><?=lang('hot_29');?></th>
                    </tr>
                    </thead>
                    <tbody id="balancedeposit"></tbody>
                </table>

                <table class="table table-striped tab-my-acct arabic-part-table arabic-trans-history-table display-n" id="BalanceOperationWithdraw" >
                    <thead>
                    <tr>
                        <th colspan="6">Withdraw</th>
                    </tr>
                    <tr>
                        <th style="width: 60px;"><?=lang('hot_24');?></th>
                        <th><?=lang('hot_25');?></th>
                        <th><?=lang('hot_26');?></th>
                        <th><?=lang('hot_27');?></th>
                        <th><?=lang('hot_28');?></th>
                        <th><?=lang('hot_29');?></th>
                    </tr>
                    </thead>
                    <tbody id="balancewithdraw"></tbody>
                </table>

                <table class="table table-striped tab-my-acct arabic-part-table arabic-trans-history-table display-n" id="BalanceOperationTransfer" >
                    <thead>
                    <tr>
                        <th colspan="6">Transfer</th>
                    </tr>
                    <tr>
                        <th style="width: 60px;"><?=lang('hot_24');?></th>
                        <th><?=lang('hot_25');?></th>
                        <th><?=lang('hot_26');?></th>
                        <th><?=lang('hot_27');?></th>
                        <th><?=lang('hot_28');?></th>
                        <th><?=lang('hot_29');?></th>
                    </tr>
                    </thead>
                    <tbody id="balancetransfer"></tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<script src="<?= $this->template->Js()?>jquery-ui.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<?php $this->lang->load('datatable');?>
<script type="text/javascript">
    var pblc = [];
    var prvt = [];
    var site_url="<?=FXPP::ajax_url('')?>";
    pblc['request'] = null;
    $('#date_start').datepicker();
    $('#date_end').datepicker();
    var tbl1 = $('#BalanceOperation').DataTable();
    var tbl2 = $('#BalanceOperationBonus').DataTable();
    var tbl3 = $('#BalanceOperationDeposit').DataTable();
    var tbl4 = $('#BalanceOperationWithdraw').DataTable();
    var tbl5 = $('#BalanceOperationTransfer').DataTable();

    $(document).ready(function(){

        $("#tclose").click(function(){
            $("#tcancel").removeClass("cur-active");
            $("#tbal").removeClass("cur-active");
            $("#tclose").addClass("cur-active");
        });
        $("#tbal").click(function(){
            $("#tcancel").removeClass("cur-active");
            $("#tclose").removeClass("cur-active");
            $("#tbal").addClass("cur-active");
        });
        $("#tcancel").click(function(){
            $("#tclose").removeClass("cur-active");
            $("#tbal").removeClass("cur-active");
            $("#tcancel").addClass("cur-active");
        });

        $("#ClosedTrades").DataTable({
            language: {
                emptyTable:'<?=lang('dta_tbl_01')?>',
                infoEmpty:'<?=lang('dta_tbl_03')?>',
                lengthMenu: '<?=lang('dta_tbl_07')?>',
                search: '<?=lang('dta_tbl_10')?>:',
                "paginate": {
                    "first":     '<?=lang('dta_tbl_12')?>',
                    "last":      '<?=lang('dta_tbl_13')?>',
                    "next":      '<?=lang('dta_tbl_14')?>',
                    "previous":   '<?=lang('dta_tbl_15')?>'
                },
            }
        });

    });
    $(document).on("click", ".btnsearch", function () {
        $("#bal").hide()
        var acctno =  $('#balops_acctno').val();
        var start =  $('#date_start').val();
        var end =  $('#date_end').val();
        var isnum = $.isNumeric(acctno);
        if(acctno!='' && isnum && start!='' && end!=''){
            showloader();
            var prvt = [];
            prvt["data"] = {
                account_number: $('#balops_acctno').val(),
                from: $('#date_start').val(),
                to: $('#date_end').val()
            };
            console.log(prvt["data"]);

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + "balance/HistoryOfTrades",
                method: 'POST',
                data: prvt["data"]
            });
            pblc['request'].done(function (data) {
                console.log(data);

                if(data.success){
                    tbl1.destroy();
                    $('#showoff').html(data.Closed);
                    tbl1 = $('#BalanceOperation').DataTable({
                        "bSort": false,
                        "ordering": false,
                        "info": true
                    });
                    tbl2.destroy();
                    $('#balancebonus').html(data.BalOpe_bonus);
                    tbl2 = $('#BalanceOperationBonus').DataTable({
                        "bSort": false,
                        "ordering": false,
                        "info": true
                    });
                    tbl3.destroy();
                    $('#balancedeposit').html(data.BalOpe_deposit);
                    tbl3 = $('#BalanceOperationDeposit').DataTable({
                        "bSort": false,
                        "ordering": false,
                        "info": true
                    });
                    tbl4.destroy();
                    $('#balancewithdraw').html(data.BalOpe_withdraw);
                    tbl4 = $('#BalanceOperationWithdraw').DataTable({
                        "bSort": false,
                        "ordering": false,
                        "info": true
                    });
                    tbl5.destroy();
                    $('#balancetransfer').html(data.BalOpe_transfer);
                    tbl5 = $('#BalanceOperationTransfer').DataTable({
                        "bSort": false,
                        "ordering": false,
                        "info": true
                    });
                    $("#bal").show()
                }else{
                    $("#modal-invalid").modal("show");
                }
                hideloader();
            });
            pblc['request'].fail(function (jqXHR, textStatus) { hideloader(); });
            pblc['request'].always(function (jqXHR, textStatus) { hideloader(); });

//} else if(idi=="tcancel") {

            $('#CancelledPendingOrder').DataTable();

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url + "balance/CancelledPendingOrders",
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function (data) {

                var table1 = $('#CancelledPendingOrder').DataTable();
                table1.destroy();
                $('#cancel_pen_order').html(data.Closed);
                $('#CancelledPendingOrder').DataTable();

                $('#loader-holder').hide();
            });

            pblc['request'].fail(function (jqXHR, textStatus) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function (jqXHR, textStatus) {
                $('#loader-holder').hide();
            });

//}

        }else{
            $("#modal-invalid").modal("show");
        }
    });
    $(window).resize(function () {
        $(".sorting").width("");
        $("#ClosedTrades").width("100%");
        $("#CancelledPendingOrder").width("100%");
        $("#BalanceOperation").width("100%");
        $("#BalanceOperationBonus").width("100%");
        $("#BalanceOperationDeposit").width("100%");
        $("#BalanceOperationWithdraw").width("100%");
        $("#BalanceOperationTransfer").width("100%");
        $(".dataTables_scrollHeadInner").width("100%");
    });

</script>
<div class="modal fade" id="modal-invalid" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;">Please enter a valid account number , start date and end date.</span>
                </div>
            </div>
        </div>
    </div>
</div>

