<style type="text/css">
    div.dataTables_length select {
        width: 75px;
        display: inline-block;
        border-radius: 0;
        box-shadow: none;
        border-color: #d2d6de;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
    }
    .dataTables_length {
        width: 50%;
        float: left;
        margin-bottom: 1%;
    }

    div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
        -webkit-appearance: none;
        box-sizing: border-box;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
    }
    .dataTables_filter {
        width: 49%;
        float: right;
        margin-bottom: 1%;
    }
    div.dataTables_info {
        padding-top: 8px;
        white-space: nowrap;
        width: 50%;
        float: left;
    }
    div.dataTables_paginate {
        margin-top: 2px!important;
        margin: 0;
        white-space: nowrap;
        text-align: right;
        width: 50%;
        float: right;
    }
    a#monitor_profit_previous {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
        position: relative;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    a.paginate_button.current {
        z-index: 2;
        cursor: default;
        border-color: #337ab7;
        position: relative;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #fff;
        text-decoration: none;
        background-color: #337ab7;
        border: 1px solid #ddd;
    }
    a.paginate_button {
        position: relative;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    a#monitor_profit_next {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    div#tab1 {
        padding: 9px;
    }
    p{
        word-break: break-all;
    }
</style>

<section class="content-header">
    <h1>Manage Logs</h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-shield"></i> View Log Details</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="section">
                <div class="manage-leverage-cont">
                    <div class="table-responsive style-form-table-responsive">
                        <table id="monitor_profit" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head manage-leverage-tab">
                            <thead>
                            <tr role="row">
                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" style="width: 295px;">Email</th>
                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Name</th>
                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">User Account Number</th>
                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Modified Page</th>
                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Date Modified</th>
                                <th aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="request">
                            <?php //echo "<pre>";
                           // print_r($log);exit;
                           // foreach ($log as $key){ ?>
                                <tr>
                                    <td><?=$log['admin_email']?></td>
                                    <td><?=$log['admin_fullname']?></td>
                                    <td><?=$log['processed_users_id_accountnumber']?></td>
                                    <td><?=$log['page']?></td>
                                    <td><?=$log['date_processed']?></td>
                                    <td><a href='#' data-id='<?=$log['id']?>' data-name='<?=$log['admin_fullname']?>' data-email='<?=$log['admin_email']?>'   data-page='<?=$log['page']?>'
                                           data-accountnumber='<?=$log['processed_users_id_accountnumber']?>'  data-date_processed='<?=$log['date_processed']?>' data-info='<?=$log['data']?>'  class='hitview' data-toggle='modal' data-target='#viewInfo'> View </a></td>
                                </tr>
                            <?php// } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->load->ext_view('modal', 'av_report', '', TRUE); ?>
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script src='<?=$this->template->Js()?>moment.min.js'></script>
<script src='<?=$this->template->Js()?>datetime-moment.min.js'></script>
<style type="text/css">
    .custom1{border-left: 1px solid #ccc;}
    .my-modal-title{text-align: center;}
    .modal-custom{width: 30%;}
</style>
<script type="text/javascript">
    var pblc = [];
    pblc['request'] = null;
    if(pblc['request'] != null) pblc['request'].abort();
    var prvt = [];
    $.fn.dataTable.moment( 'YYYY-MM-DD HH:mm:ss' );
    var site_url="<?=site_url('')?>";

    var maintable;
    $(window).load(function() {
        hideloader();
    });
    $(document).ready(function() {

        function handleAjaxError( xhr, textStatus, error ) {
            hideloader();
            if ( textStatus === 'timeout' ) {
                console.log( 'The server took too long to send the data.' );
//                alert( 'The server took too long to send the data.' );
                $('#s_report').html('The server took too long to send the data.');
                $('#avreport').modal('show');
            }
            else {
                console.log( 'An error occurred on the server. Please try again in a minute.' );
//                alert( 'An error occurred on the server. Please try again in a minute.' );
                $('#s_report').html('An error occurred on the server. Please try again in a minute.');
                $('#avreport').modal('show');
            }
            $('#monitor_profit').fnProcessingIndicator( false );
        }
        jQuery.fn.dataTableExt.oApi.fnProcessingIndicator = function ( oSettings, onoff ) {
            if ( typeof( onoff ) == 'undefined' ) {
                onoff = true;
            }
            this.oApi._fnProcessingDisplay( oSettings, onoff );
        };

    } );


    function pre_def(){
        return false;
    }
    $(document).on("click", ".hitview", function () {
        $('#name').html($(this).data('name'));
        $('#email').html($(this).data('email'));
        $('#page').html($(this).data('page'));
        var manageaccheckpage=$(this).data('page');
        var accountshow;
        if ($(this).data('accountnumber')==0){
            accountshow='N/A';
        }else{
            accountshow=$(this).data('accountnumber');
        }
        $('#accntno').html(accountshow);
        $('#date').html($(this).data('date_processed'));

        var jsoncontent = $(this).data('info');
        $( "#info").empty();
        $.each(jsoncontent, function(key, value){


            // manage permission , separetor
            if(manageaccheckpage=="administration/manage-access")
            {if(key=="permission"){value = value.split(',').join(',\n');}}


            var formatted_key = key.replace('_', ' ');
            var formatted_key = formatted_key.replace('_', ' ');

            $( "#info").append( "<p><b>"+formatted_key+"</b> =  "+value+"</p>" );

        });
    });
</script>
<div class="modal fade" id="viewInfo" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0 modal-custom" >
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Administrators Logs</h4>
            </div>
            <div class="modal-body">
                <div class="section">
                    <div class="tab-content acct-cont admin-tab-cont">
                        <div id="tab1" class="row tab-pane active" role="tabpanel">
                            <div class="form-credit-prize" id="admin info">
                                <p><strong>Administrator Name : </strong> <span id="name"></span></p>
                                <p><strong>Administrator Email : </strong> <span id="email"></span></p>
                                <p><strong>Page : </strong> <span id="page"></span></p>
                                <p><strong>Account Number Processed : </strong> <span id="accntno"></span></p>
                                <p><strong>Date : </strong> <span id="date"></span></p>
                            </div>

                            <div class="form-credit-prize">
                                <br/>
                                <p><strong>Other Information</strong></p>
                                <hr/>
                                <div class="form-credit-prize" id="info">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>