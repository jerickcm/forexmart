<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>

<style>
   .dataTables_wrapper .dataTables_filter input { margin-left: 0.7em; }
    .dataTables_wrapper .dataTables_info{ clear: none!important; }
    .dataTables_wrapper , .dataTables_wrapper .dataTables_wrapper .row {  display: table!important; width: 100%; }
    .dataTable_wrapper .dataTables_wrapper .row {  margin: 0 auto!important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { padding: 0; display: inline-block;  margin: -1px!important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: none;  border: 1px solid #fff; }
    .form-control:focus {  outline: none; }
    #table_info{ display: block; float: left; padding-top: 0.755em; }
    #table_paginate{  float: right; text-align: right;  margin-top: -8px; display: block; margin-right: -36px; }
    table.dataTable thead th, table.dataTable thead td { padding: 10px 18px;   }
    #table th{ background: #fff;   }
    #table td{  border: none!important;  padding-left: 18px;  }
    .dataTables_wrapper .dataTables_filter {  float: left!important;  margin-left: -120%;  }
    .col-sm-6 {  width: 27%; float: right; }
    #tbl_affiliates_info{  margin-left: 39%;  }
    .dataTables_wrapper .dataTables_paginate {  float: right; margin-right: 26%; margin-top: -1%; text-align: right;  padding-top: 0.25em;  }
    .tbl_acct1 th{ background: #eff9ff; }
    #tbl_affiliates th, #tbl_affiliates td{ text-align: center;border: 1px solid #d0ecf6; border-bottom:1px solid #ccc!IMPORTANT; }
   div.dataTables_paginate ul.pagination{     margin-right: 16px;}
    table.tbl_acct1 th, table.tbl_acct1 td{
        text-align: center;
        padding:6px;
        border: 1px solid #d0ecf6;
        border-bottom: 1px solid #ccc!IMPORTANT;
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
     <div class="mini-form-container" style="width: 30%;margin-left: 35%;">
        <form method="post" action="" enctype="multipart/form-data"  id="form-ticket">
         <label style="text-align: left; width:135px;"> Account number : </label>
         <input id="account_number1" name="account_number" type="text" class="tab-input-form numerical" placeholder="Account number" style="padding: 5px;" require/>
         <button type="submit" class="tab-input-button style-table-in-button" style="padding: 7px;font-weight: normal;" id="submitedbutton">Search</button>
        </form>
    </div>
    <hr>
    <div class="showTicketDiv">
        <div class="table-chart-holder" style="width: 68%; margin: auto;">
            <?php if(isset($info)) {?>
            <table class="tbl_acct1 table table-bordered table-striped dataTable style-form-table last-mid-table-head" style="width: 100%;margin-bottom: 2%;">
                <thead>
                <tr role="row">
                    <th style="width: 295px;">Partner Account</th>
                    <th style="width: 361px;">Acct Name</th>
                    <th style="width: 321px;">Type</th>
                    <th style="width: 255px;">Affiliate Code</th>
<!--                    <th>Type</th>-->
                </tr>
                <?php foreach ($info as $key){
//                    echo "<pre>";
//                    print_r($key);exit;
                    if($key['login_type']==0){
                        $type = 'client';
                        $acct = $key['LogIn'];
                        $acode = $key['affiliate_code'];
                        $rcode = 'Regular';
                        $cpa = 'n/a';
                    }else{
                        $type='Partner';
                        $acct = $key['reference_num'];
                        $acode = $key['affiliate_code'];
                        $rcode = $key['type_of_partnership'];
                        if($key['reference_subnum']!=''){ $cpa = $key['reference_subnum']; }else{ $cpa = 'n/a';}
                    }?>
                    <tr>
                        <td><?=$acct;?></td>
                        <td><?=$key['Name'];?></td>
                        <td><?=$rcode;?></td>
                        <td><?=$acode;?></td>

                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

<div  class="table-container-holder table-container-border table-container-margin data-center-container">
    <?php if (isset($info1)) { ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 style="text-align: center;">REFERRALS</h4>
        </div>
        <table class="table table-bordered table-striped dataTable style-form-table last-mid-table-head" cellpadding="0" cellspacing="0" id="tbl_affiliates" style=" text-align:center;width:68%;margin-left: 16%;    margin-bottom: 15px!important;">
            <thead>
            <tr role="row">
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Client Account</th>
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Name</th>
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Type</th>
                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Affiliate Code</th>
            </tr>
            </thead>
            <tbody>
            <?php  foreach ($info1 as $entry){ if(!empty($entry)){ ?>
                        <tr>
                            <td><?=$entry[0]['account_number'];?></td>
                            <td><?=$name= isset($entry[0]['Name'])?$entry[0]['Name']:$entry[0]['full_name'];?></td>
                            <td>Regular</td>
                            <td><?=$entry[0]['affiliate_code'];?></td>
                        </tr>
            <?php }  } ?>
            </tbody>

        </table>
    <?php } ?>
    <?php } if (isset($noinfo)) { ?>
        <script>
            $(document).ready(function () {
                $("#modal-invalid").modal('show');
            });
        </script>
    <?php }?>
</div>
        </div>
    </div>
</section>


<script>
    var table123;
    table123 = $('#tbl_affiliates').DataTable({ } );
    $('#tbl_affiliates th').removeClass('sorting');
</script>

<div class="modal fade" id="modal-invalid" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;">The account does not exist.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-invalid2" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;">Please enter account number.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function (e) {
        $(document).on("click", "#submitedbutton", function (e) {
            if($("#account_number1").val() == ''){
                $("#modal-invalid2").modal('show');
               event.preventDefault(e);
            }
        });
        //console.log(e);
        jQuery(".numerical").on("keypress keyup blur",function (event) {
            console.log(event);
            if ((event.which != 8 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        jQuery(".numerical").on("blur",function (event) {
            var value=$(this).val().replace(/[^0-9.,]*/g, '');
            value=value.replace(/\.{2,}/g, '.');
            value=value.replace(/\.,/g, ',');
            value=value.replace(/\,\./g, ',');
            value=value.replace(/\,{2,}/g, ',');
            value=value.replace(/\.[0-9]+\./g, '.');
            $(this).val(value)
        });
    });
</script>