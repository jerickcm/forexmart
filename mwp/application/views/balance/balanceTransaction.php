<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/Moment.js"></script>
<script src="<?=base_url();?>assets/js/jquery.dataTables.js"></script>
<?php

$yes = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("yesterday")))->format('m/d/Y');
$tod =  DateTime::createFromFormat('Y/d/m',   date('Y/d/m',strtotime("today")))->format('m/d/Y');
?>


<section class="content-header">
    <h1>
        Transactions
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-balance-scale"></i> Balance</li>
        <li class="active">Transactions</li>
    </ol>
</section>
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="style-calendar-box">
                <div class="style-calendar-shown">
                    <div class="style-calendar-child">
                        <label>From:</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input id="datePicker1" name="date-from" type="text" class="form-control pull-right" placeholder=""  value="<?php echo $yes; ?>" />
                        </div>
                    </div>
                    <div class="style-calendar-child">
                        <label>To:</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input id="datePicker2" name="date-to" type="text" class="form-control pull-right" placeholder="" value="<?php echo $tod; ?>">
                        </div>
                    </div>

                    <div class="datepicker-search-button">
                        <a href="javascript:void(0)" class="hitseek">Search</a>
                    </div>
                </div>

                <!-- START DEFAULT HIDDEN DATEPICKER -->
                <div class="style-calendar-hidden">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation">
                  </div>
                </div>
                <!-- END DEFAULT SHOWN DATEPICKER -->

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

            <div class="style-form-table-responsive" style="display: none;" id = "tbl_header">
                <table id="baltran" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head">
                    <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Date/Time</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 403px;">Comment</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 245px;">Account Number</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 245px;">Account Receiver</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 245px;">Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 245px;">Ticket</th>
                    </tr>
                    </thead>
                    <tbody id="tr_data">
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </section>

<script type="text/javascript">
    showloader();
    var site_url="<?=site_url('')?>";
     
    var pblc = [];
    pblc['request'] = null;
    if(pblc['request'] != null) pblc['request'].abort();
    $(window).load(function() {
        hideloader();
    });

    $(function () {
        $('#datePicker1').datepicker();
        $('#datePicker2').datepicker();
    });

    $(document).on("click", ".hitseek", function () {
        if($('input[name=date-from]').val()!= '' && $('input[name=date-to]').val()!= ''){
            showloader();
            var prvt = [];
            prvt["data"] = {
                //accountnumbers: $('textarea[name=account-numbers]').val(),
                from: $('input[name=date-from]').val(),
                to: $('input[name=date-to]').val()
            };
            
            //console.log(prvt["data"].from > prvt["data"].to);
            if(prvt["data"].from > prvt["data"].to){
                hideloader();
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

                    $('#tbl_header').css('display','block');
                    
                    if(data.success == false){
                        hideloader();
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
                            // "info": "Showing page _PAGE_ of _PAGES_",
                        }});

                        tblBalTran
                            .clear()
                            .rows.add(data.tr)
                            .draw();
                    }
                });
                pblc['request'].fail(function( jqXHR, textStatus ) {
                    hideloader();
                });
                pblc['request'].always(function( jqXHR, textStatus ) {
                    hideloader();
                });
            }
        }
        else{
            $("#modal-invalid").modal('show');
            $('#error').text('Please select date.');
        }
    });
</script>