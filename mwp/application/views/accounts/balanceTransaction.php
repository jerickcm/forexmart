<style>
    .tab-content > .active {
        display: table;
        width:100%;
        background:#fff;
        border: 1px solid #e3e3e3 !important;
    }
    .right-tab-content {
        min-height:849px;
    }
    .main-navigation {
        width: 251px!important;
    }
    .logo-header {
        width: 251px!important;
    }
    .main-container, .footer-container {
        margin-right: 0!important;
    }
    .hitseek{
        font-family: Open Sans;
        font-size: 13px;
        font-weight: 600;
        background: #29a643;
        padding: 8px 10px;
        transition: all ease .3s;
        float: left;
        margin-left: 30px;
    }

    .other-saldo-cl{
        height: auto;
        margin-top: 70px;
        overflow: hidden;
        width: 100%;
    }
    #baltran{margin-top: 15px;}
    #baltran_filter{margin-right: 20.5%;}
    #baltran_wrapper{margin-top: 10px;}
    .dataTables_length{margin-left: 20.5%;}
    .dataTables_info{margin-left: 20.5%;}
    .table-responsive {overflow-x: hidden;}
    .dataTables_empty{text-align: center;}
    .pagination{margin: 0!important;}
    .dataTables_paginate{float: right;margin-right: 160px;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<?php

    $yes = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("yesterday")))->format('m/d/Y');
    $tod =  DateTime::createFromFormat('Y/d/m',   date('Y/d/m',strtotime("today")))->format('m/d/Y');
//    print_r($monday);
//    print_r($friday);exit;

    ?>

<!--    <div class="col-lg-10 col-md-10 col-sm-10 border-left">-->
<!--        <div class="section">-->
    <div id="tab1" class="tab-pane active tab-title-header" role="tabpanel">
        <h1 class="all_tab_title">Balance Transaction</h1>
            <div class="manage-leverage-cont other-saldo-cl">
                <div class="calculate-form-holder row">
                    <div class="" style="width: 78%;margin-left: 10%">
                        <form class="form-horizontal">
                            <!-- <div class="form-group"> -->
                                <!-- <label class="col-sm-2 control-label">Account Number:</label> -->
                                <!-- <div class="col-sm-10"> -->
                                    <!-- <textarea name="account-numbers" class="form-control round-0" style="width: 78%;"></textarea> -->
                                    <!-- <p class="separator-note" style="color: red;">*For multiple account numbers, please use comma(,) as a separator.</p> -->
                                <!-- </div> -->
                            <!-- </div> -->
                            <div class="form-group">
                                <label class="col-sm-1 control-label">From:</label>
                                <div class="col-sm-2">
                                    <div class="input-group" >
                                        <input id="datePicker1" name="date-from" type="text" class="form-control round-0" placeholder=""  value="<?php echo $yes; ?>" />

                                    </div>
                                </div>
                                <label class="col-sm-1 control-label">To:</label>
                                <div class="col-sm-2">
                                    <div class="input-group" >
                                        <input id="datePicker2" name="date-to" type="text" class="form-control round-0" placeholder="" value="<?php echo $tod; ?>">
                                    </div>
                                </div>
                                <label class="control-label"></label>
                                <div class="col-sm-3">
                                    <a href="javascript:void(0)" class="hit hitseek btn-calculate">Search</a>
                                </div>

                                <div class="modal fade" id="modal-invalid" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%";>
                                    <div class="modal-dialog round-0" style="margin-left: 41%;">
                                        <div class="modal-content round-0">
                                            <div class="modal-body modal-show-body">
                                                <div class="text-center manage-credit-prize-alert-message">
                                                    <span id="error" style="color: red;font-size:18px;font-weight: bold;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="baltran" class="table table-striped" style="width: 80%; max-width: 80%;margin-left:10%;">
                        <thead style="background: #cccccc;">
                        <tr>
                            <th class="fixwidth">Date/Time</th>
                            <th class="fixwidth wide">Comment</th>
                            <th class="fixwidth">Status</th>
                            <th class="fixwidth narrow">Account Number</th>
                            <th class="fixwidth narrow">Account Receiver</th>
                            <th class="fixwidth narrow">Amount</th>
                            <th class="fixwidth narrow">Ticket</th>
                        </tr>
                        </thead>
                        <tbody id="tr_data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!--    </div>-->

    <?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

    <style type="text/css">
        .fixwidth{
            width:15%!important;
        }
        .wide{
            width: 23%!important;
        }
        .narrow{
            width:11%!important;
        }

        #baltran td:nth-child(4), #baltran th:nth-child(4), #baltran td:nth-child(5), #baltran th:nth-child(5), #baltran td:nth-child(6), #baltran th:nth-child(6){
        text-align : center;
        }

        table.fixed { table-layout:fixed; }
        table.fixed td { overflow: hidden; }
        .hit:hover{
            text-decoration: none!important;
            color: #fff!important;
        }
        .hit:link{
            color: #fff!important;
            text-decoration: none!important;
        }
        .hit:visited{
            color: #fff!important;
            text-decoration: none!important;
        }
        .hit:active{
            color: #fff!important;
            text-decoration: none!important;
        }
    </style>
    <script type="text/javascript">
        var site_url="<?=site_url('')?>";
        
        $('#loader-holder').show();
        var pblc = [];
        pblc['request'] = null;
        if(pblc['request'] != null) pblc['request'].abort();
        $(window).load(function() {
            $('#loader-holder').hide();
        });

        $(function () {
            $('#datePicker1').datepicker();
            $('#datePicker2').datepicker();
        });

        $(document).on("click", ".hitseek", function () {
            if($('input[name=date-from]').val()!= '' && $('input[name=date-to]').val()!= ''){
            $('#loader-holder').show();
                var prvt = [];
                prvt["data"] = {
                    //accountnumbers: $('textarea[name=account-numbers]').val(),
                    from: $('input[name=date-from]').val(),
                    to: $('input[name=date-to]').val()
                };

                //console.log(prvt["data"].from > prvt["data"].to);
                if(prvt["data"].from > prvt["data"].to){
                    $('#loader-holder').hide();
                    $("#modal-invalid").modal('show');
                    $('#error').text('Invalid Date');
                }

                else{
                    pblc['request'] = $.ajax({
                    dataType: 'json',
                    url: site_url+"accounts/get_balanceTransaction",
                    method: 'POST',
                    data: prvt["data"]
                });
                pblc['request'].done(function( data ) {
                    console.log(data);
                    // $('#tr_data').html('');
                    // $('#tr_data').html(data.tr);
                    if(data.success == false){
                        $('#loader-holder').hide();
                    }

                    if ( $.fn.dataTable.isDataTable( '#baltran' ) ) {
                        var table = $('#baltran').DataTable();
                        table.destroy();

                        var tblBalTran = $('#baltran').DataTable({"language": {
                            "info": "Showing page _PAGE_ of _PAGES_",
                        }});

                        tblBalTran   
                                .clear()
                                .rows.add(data.tr)
                                .draw();
                    }
                    else {
                        var tblBalTran = $('#baltran').DataTable({"language": {
                            "info": "Showing page _PAGE_ of _PAGES_",
                        }});

                        tblBalTran   
                                .clear()
                                .rows.add(data.tr)
                                .draw();
                    }
                });
                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });
                pblc['request'].always(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });
                }
            }
            else{
                $("#modal-invalid").modal('show');
                $('#error').text('Please select date.');
            }
        });
    </script>