 $(function(){
    var xhrPool = [];
    var abort = function(){
        $.each(xhrPool, function(idx, jqXHR){
            jqXHR.abort();
        });
    };

    $(document).ajaxSend(function(event, jqXHR, settings){
        xhrPool.push(jqXHR);
        if(settings.showLoader){
           showloader();
        }
    });

    $(document).ajaxComplete(function(event, jqXHR, settings){
        xhrPool = $.grep(xhrPool, function(x){
            return x!=jqXHR;
        });

        if(settings.showLoader){
            hideloader();
        }
    });


    $.ajaxSetup({
        showLoader: false
    });


    // $(document).ready( function () {
        $.fn.dataTable.ext.errMode = 'none';

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $.fn.dataTable.tables( {visible: true, api: true}).responsive.recalc().draw();

            $('.tab-panel-withdrawalqueue').hide();
            var divId = $(e.target).attr("id"); // activated tab
            $('div.'+divId).show();

            var target = $(e.target).attr("href"); // activated tab
            $(target+'-table').DataTable().draw();

        });

        $('.withdrawalqueue-table').DataTable({
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
                url: '/Withdrawal_queue/getAllWithdrawals',
                showLoader: true,
                data: function(d){
                    d.tab = $('.queue-tab-list .active').attr('id');
                    return d;
                }
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


        $('#request-table').DataTable().draw();

        // All Withdrawal Request Action
        $('.all-withdraw').on('click','.approve-link',function(){
            var transInfo = $(this).data('info'),
                transId = transInfo.Id;
            bootbox.confirm({
                title: 'Please confirm your action',
                message: "<i class='fa fa-info-circle'></i> Are you sure you want to Approve? ",
                callback: function(result){
                    if(result){
                        $.ajax({
                            type: 'POST',
                            url: '/Withdrawal_queue/all_withdrawalqueue_update',
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

        $('.all-withdraw').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var transInfo = $(this).data('info');
            $('span#ref_num_mod').html(transInfo.referenceNumber);
            $('span#client_name_modal').html(transInfo.clientName);
            $('input#trans_id').val(id);
            $('input#transType').val('All');
            $('span#trans_title_modal').html(transInfo.transactionType);
        });

        $('#decline_modal').on('hidden.bs.modal', function () {
            $('#client_comment_modal').val('');
            $('textarea#client_comment_modal').removeClass('red-border');
        });

        $('div#decline_modal').on('click', 'button#modal-decline-link', function(){
            var transId = $('input#trans_id').val();
            var transType = $('input#transType').val();
            var reason = $('textarea#client_comment_modal').val();
            if(reason != ''){
                bootbox.confirm({
                    title: 'Please confirm your action',
                    message: "<i class='fa fa-info-circle'></i> Are you sure you want to Decline?.",
                    callback: function(result){
                        if(result){
                            $.ajax({
                                type: 'POST',
                                url: '/Withdrawal_queue/all_withdrawalqueue_update',
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
    // });
});