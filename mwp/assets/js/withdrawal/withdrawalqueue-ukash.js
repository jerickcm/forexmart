$(function(){


    $(document).ready(function(){

        $.fn.dataTable.ext.errMode = 'none';

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            //var target = $(e.target).attr("href") // activated tab
            $.fn.dataTable.tables( {visible: true, api: true}).responsive.recalc().draw();
        });

        $('.withdrawalqueue-table-ukash').DataTable({
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
                url: site_url+'withdrawalqueue/GetWithdrawalTransactionUK',
                showLoader: true,
                data: function(d){
                    d.tab = $('.queue-tab-list .active').attr('id');
                    d.activeTransaction = 'UK';
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

        $('#request-table-ukash').DataTable().draw();

        $(document).on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var transInfo = $(this).data('info');
            $('span#ref_num_mod').html(transInfo.referenceNumber);
            $('span#client_name_modal').html(transInfo.clientName);
            $('input#trans_id').val(id);
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
                            url: site_url+'withdrawalqueue/all_withdrawalqueue_update',
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
                                url: site_url+'withdrawalqueue/all_withdrawalqueue_update',
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

    });


});