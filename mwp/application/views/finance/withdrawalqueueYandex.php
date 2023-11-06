<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<script src='<?=$this->template->Js()?>withdrawal/datatables.responsive.1.0.7.js'></script>
<link rel="stylesheet" type="text/css" href="<?=$this->template->Css()?>withdrawal.css"/>
<style type="text/css">
    .decline-holder{
        margin: 5px 0px;
    }
    .red-border{
        border: 1px solid red;
    }

    .queue-tab-list > li.active > a{
        color: #fff!important;
        background: #2988CA!important;
    }
    .dataTables_wrapper .dataTables_filter input {
        width: 200px;
    }
    table.dataTable thead > tr > th {
        padding-right: 15px;
        font-size: 13px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        padding: 0;
        margin-left: 0;
        border: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        border: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{
        border: none;
    }
    .nav-tabs-custom > .nav-tabs > li > a{
        font-family: 'Open Sans', helvetica, sans-serif;
        font-size: 15px;
    }
</style>
<section class="content-header">
    <h1>Withdrawal</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-area-chart"></i> Finance</li><li class="active">Withdrawal</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="style-withdrawals-box">
                <?=$nav?>
            </div>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <div id="withdrawal-panel-banktransfer" class="withdrawal-panel bank_transfer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-personal-tabs-withdrawal style-personal-tabs">
                <div class="settings-tab nav-tabs-custom style-customized-navigation-tab">
                <ul role="tablist" class="queue-tab-list nav nav-tabs" id="banktransfer">
                    <li role="presentation" id="Request" class="active"><a href="#request" data-toggle="tab" class="tab-toggle">Request</a></li>
                    <li role="presentation" id="Processed"><a href="#processed" data-toggle="tab" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation" id="Declined"><a href="#declined" data-toggle="tab" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered table-striped dataTable style-form-table last-mid-table-head double-column-table-head queue-tab withdrawalqueue-table-banktransfer" id="request-table-yandex">
                            <thead>
                            <tr role="row">
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Reference No.</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 361px;">Client's Name</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 321px;">ForexMart Account No.</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Amount Requested</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Amount to be Deducted</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Date Requested</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Recalled</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;" id="hlast">Status</th>
                            </tr>
                            </thead>
                            <tbody id="bt-Request-tbody"></tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered table-striped dataTable style-form-table last-mid-table-head double-column-table-head queue-tab withdrawalqueue-table-banktransfer">
                            <thead>
                            <tr role="row">
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Reference No.</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 361px;">Client's Name</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 321px;">ForexMart Account No.</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Amount Requested</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Amount to be Deducted</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Date Requested</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Recalled</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Status</th>
                            </tr>
                            </thead>
                            <tbody id="bt-Processed-tbody"></tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered table-striped dataTable style-form-table last-mid-table-head double-column-table-head queue-tab withdrawalqueue-table-banktransfer">
                            <thead>
                            <tr role="row">
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Reference No.</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 361px;">Client's Name</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 321px;">ForexMart Account No.</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Amount Requested</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Amount to be Deducted</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Date Requested</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Recalled</th>
                                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Status</th>
                            </tr>
                            </thead>
                            <tbody id="bt-Declined-tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
        </div>
    </div>
</section>

<!-- modal -->
<div class="modal fade" id="decline_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title poptitle" id="myModalLabel"> Decline - <span id="trans_title_modal"></span> </h4>
            </div>
            <div class="modal-body">
                <div class="row" id="popcheck_filter" style="margin: 0px 20px;">
                    <div class="col-sm-12 decline-holder">
                        <label>Reference #:</label> <span id="ref_num_mod"></span>
                    </div>
                    <div class="col-sm-12 decline-holder">
                        <label>Client's name:</label> <span id="client_name_modal"></span>
                    </div>
                    <div class="col-sm-12 decline-holder">
                        <label>Reason of Decline:</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea id="client_comment_modal" rows="5" cols="5" style="width: 100%;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" id="modal-decline-link" class="btn btn-primary round-0">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<?php //hidden vars ?>
<input type="hidden" id="trans_id">
<input type="hidden" id="transType">
<script type="text/javascript">
    $(function(){
//        $(document).ready(function(){
            $.fn.dataTable.ext.errMode = 'none';

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                //var target = $(e.target).attr("href") // activated tab
                $.fn.dataTable.tables( {visible: true, api: true}).responsive.recalc().draw();
            });

            $('.withdrawalqueue-table-banktransfer').DataTable({
                dom: 'ltip',
                processing : true,
                serverSide: true,
                responsive: true,
                ordering: false,
                deferLoading: 5,
                language:{
                    search: '',
                    searchPlaceholder: 'Search by Wallet or Account'
                },
                ajax:{
                    type: 'post',
                    url: "<?php echo FXPP::ajax_url('Withdrawal_queue/GetWithdrawalTransactionYM')?>//",
                    showLoader: true,
                    data: function(d){
                        d.tab = $('.queue-tab-list .active').attr('id');
                        d.activeTransaction = 'YAN';
                        return d;
                    },
                    //success:function(data){
                    //    if(data.tab!="Request"){
                    //        $('#hlast').text('Status');
                    //    }else{
                    //        $('#hlast').text('Action');
                    //    }
                    //}
                },
                drawCallback : function (oSettings) {
                    if(oSettings.fnRecordsDisplay() == 0){
                        $(oSettings.nTableWrapper)
                            .find('.dataTables_paginate, .dataTables_filter, .dataTables_length, .dataTables_info')
                            .hide();
                    }else{

                        $(oSettings.nTableWrapper)
                            .find('.dataTables_paginate, .dataTables_filter, .dataTables_length, .dataTables_info')
                            .show();
                    }
                }
            });

            $('#request-table-yandex').DataTable().draw();

            $(document).on('click','.decline-link',function(){
                var id = $(this).closest('tr').attr('id');
                var transInfo = $(this).data('info');
                $('span#ref_num_mod').html(transInfo.referenceNumber);
                $('span#client_name_modal').html(transInfo.clientName);
                $('input#trans_id').val(id);
                $('input#transType').val('All');
                $('span#trans_title_modal').html(transInfo.transactionType);
            });

            $(document).on('click', '.approve-link', function(){
                var transInfo = $(this).data('info'),
                    transId = transInfo.Id;
                bootbox.confirm({
                    title: 'Please confirm your action',
                    message: "<i class='fa fa-info-circle'></i> Are you sure you want to Approve? ",
                    callback: function(result){
                        if(result){
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo FXPP::ajax_url('Withdrawal_queue/all_withdrawalqueue_update')?>//",
                                data: {action:'Processed', transId:transId},
                                dataType: 'json',
                                beforeSend: function(){
                                    $('#loader-holder').show();
                                },
                                success: function(response){
                                    $('#loader-holder').hide();
                                    if(response.error){
                                        bootbox.alert({
                                            title: 'Transaction Error',
                                            message: response.message,
                                            show: true
                                        });
                                    }else{
                                        var activeTable = $.fn.dataTable.tables( {visible: true, api: true});
                                        activeTable.row('#row-'+transId).remove().draw();
                                    }
                                },
                                error: function(jqXHR, textStatus){
                                    $('#loader-holder').hide();
                                }
                            });
                        }
                    }
                });
            });

            $(document).on('click', 'button#modal-decline-link', function(){
                var transId = $('input#trans_id').val();
                var reason = $('textarea#client_comment_modal').val();
                if(reason != ''){
                    bootbox.confirm({
                        title: 'Please confirm your action',
                        message: "<i class='fa fa-info-circle'></i> Are you sure you want to Decline?.",
                        callback: function (result) {
                            if(result){
                                $.ajax({
                                    type: 'POST',
                                    url: "<?php echo FXPP::ajax_url('Withdrawal_queue/all_withdrawalqueue_update')?>//",
                                    data: {action:'Declined', transId:transId, comment:reason},
                                    dataType: 'json',
                                    beforeSend: function(){
                                        $('#loader-holder').show();
                                    },
                                    success: function(response){
                                        $('#loader-holder').hide();
                                        if(response.error){
                                            bootbox.alert({
                                                title: 'Transaction Error',
                                                message: response.message,
                                                show: true
                                            });
                                        }else{
                                            var activeTable = $.fn.dataTable.tables( {visible: true, api: true});
                                            activeTable.row('#row-'+transId).remove().draw();
                                            $('#decline_modal').hide();
                                        }
                                    },
                                    error: function(jqXHR, textStatus){
                                        $('#decline_modal').hide();
                                        $('#loader-holder').hide();
                                    }
                                });
                            }
                        }
                    });
                }else{
                    bootbox.alert({
                        title: 'Transaction Decline Error',
                        message: 'Reason of Decline is required.',
                        show: true
                    });
                    $('textarea#client_comment_modal').addClass('red-border');
                }
            });
            $('#select-withdrawal-transaction').change(function(){
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
            });
//        });
    });
</script>