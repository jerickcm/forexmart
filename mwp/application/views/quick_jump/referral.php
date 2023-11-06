<style type="text/css">
    div.dataTables_paginate{
        float: right;
    }
    .dataTables_info{
        display: none;
    }
    .dataTables_paginate .paginate_button {
        /*margin: 2px 0;*/
        /*white-space: nowrap;*/
    }
    a.paginate_button,span.ellipsis {
        margin: 2px 0;
        white-space: nowrap;
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
    a.previous {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    a.next {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    a.current{
        border: 1px solid #337ab7;
        color: #fff;
        background-color: #337ab7;
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
</style>

<section class="content-header">
    <h1>Referrals</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Partners</li>
        <li class="active">Referrals</li>
    </ol>
</section>
<section class="content">
    <div class="box style-box" style="display: inline-block;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-box-initial-info">
            <div  class="table-container-holder table-container-border table-container-margin data-center-container">
                <table id="referral-table" cellpadding="0" cellspacing="0" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head">
                    <thead>
                    <tr role="row">
                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Account Number</th>
                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Affiliate Code</th>
                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Partner Account</th>
                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Partner Affiliate Code</th>
                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Partner Type</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>
</section>


<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript">
    var site_url="<?=site_url('')?>";
    var tblAccounts = jQuery('#referral-table').on('preXhr.dt', function ( e, settings, data ) {
        showloader();
    }).on('xhr.dt', function ( e, settings, json, xhr ) {
        hideloader();
    }).DataTable({
        "processing": false,
        "serverSide": true,
        "bFilter": true,
        "bSort": false,
        "ajax": {
            "url": site_url+"referrals/getReferrals",
            "type": "POST",
            "data": function ( d ) {
                hideloader();
                d.account_type =1;
            }
        }
    });
</script>