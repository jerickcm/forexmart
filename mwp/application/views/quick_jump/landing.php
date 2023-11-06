<style type="text/css">
    div#verified-accounts_info {
        width: 50%;
        float: left;
    }
    div.dataTables_paginate {
        white-space: nowrap;
        text-align: right;
        float: right;
    }
    div.dataTables_paginate a.paginate_button {
        margin: 2px 0;
        white-space: nowrap;
    }
    a.previous {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    a.next {
        margin-left: 0;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    a.paginate_button.current {
        background: #337ab7;
        color: #fff;
        border: 1px solid #337ab7;
    }
    a.paginate_button {
        background: #fafafa;
        color: #666;
    }
    a.paginate_button{
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
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
    .ellipsis {
        margin: 2px 0;
        white-space: nowrap;
        float: left;
        position: relative;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
        background: #fafafa;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
</style>
<section class="content-header">
    <h1>Quick Jump</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-paper-plane"></i> Quick Jump</li>
        <li class="active">Personal</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box style-box">
        <div class="box-body">

            <div class="style-form-table-responsive">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="verified-accounts" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Account Number</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Type</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /.content -->
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script>
    var site_url="<?=site_url('')?>";
    var tblAccounts = $('#verified-accounts').on('preXhr.dt', function ( e, settings, data ) {
        showloader();
    }).on('xhr.dt', function ( e, settings, json, xhr ) {
        hideloader();
    }).DataTable({
        "processing": false,
        "serverSide": true,
        "bFilter": true,
        "bSort": true,
        "ajax": {
//            "url": site_url+"quick_jump/getVerifiedAccounts",
            "url": site_url+"quick_jump/get_all",
            "type": "POST",
            "data": function ( d ) {

            }
        }
    });
</script>