<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<style>
    .dataTables_wrapper{clear: none!important;}table.dataTable{clear: none!important;} table.dataTable select{padding: 6px 6px!important;}.dataTables_wrapper .dataTables_info{clear: none!important;}
    .cldew {margin-top: 15px;margin-bottom: 15px;font-size: 15px;text-align: center;}.dataTables_wrapper , .dataTables_wrapper .dataTables_wrapper .row {display: table!important;width: 100%;}.dataTable_wrapper .dataTables_wrapper .row {margin: 0 auto!important;}.dataTables_wrapper .dataTables_paginate .paginate_button {padding:0; display: inline;margin-left: -2px!important;}.dataTables_wrapper .dataTables_paginate .paginate_button:hover {background: none;border: 1px solid #fff;} .form-control:focus {outline: none;}#table_info{display: block;float: left;padding-top: 0.755em;}#table_paginate{float: right;text-align: right;margin-top: -8px;display: block;margin-right: -36px;}table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;}#table th{background: #fff;border:none;} #table td{border: none!important;padding-left: 18px;}
    table.dataTable thead th, table.dataTable thead td{
        border-bottom: 1px solid #d0ecf6!important;
    }
    .pagination > li > a, .pagination > li > span{
        float:none;
    }
</style>
<section class="content-header">
    <h1>Incomplete Registration</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Verify</li>
        <li class="active"> Incomplete Registration</li>
    </ol>
</section>
<section class="content">
    <div class="box style-box" style="display: inline-block;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-box-initial-info">
<div class="tab-pane active" id="search-account">
    <form action="" method="post">
        <div class="tab-title-header">
            <h4 class="cldew">Clients who started registration but haven't completed it are in the table below. They will be required to complete it upon login in to the cabinet</h4>
        </div>
        <div  class="table-container-holder table-container-margin table-container-data" id="table-container-holder">
        </div>
    </form>
    <div  class="table-container-holder table-container-border table-container-margin data-center-container">
        <table id="table123" cellpadding="0" cellspacing="0" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head">
            <thead>
            <tr role="row">
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Email</th>
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Full Name</th>
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Created Date</th>
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Account Number</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<div style="clear: both"></div>
        </div>
    </div>
</section>
<!-- END ACCOUNT TABS -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<script src="<?= $this->template->Js()?>jquery-ui.js" ></script>
<script type="text/javascript">
    var site_url="<?=site_url('')?>";
    var tblAccounts = jQuery('#table123').on('preXhr.dt', function ( e, settings, data ) {
        showloader();
    }).on('xhr.dt', function ( e, settings, json, xhr ) {
        hideloader();
    }).DataTable({
        "processing": false,
        "serverSide": true,
        "bFilter": true,
        "bSort": false,
         "ajax": {
            "url": site_url+"verify/incomplete_accounts_data",
            "type": "POST",
            "data": function ( d ) {
                hideloader();
                //d.account_type = "<?php// echo $type ?>";
            }
        }
    });
    $('#verify').addClass('active');
</script>