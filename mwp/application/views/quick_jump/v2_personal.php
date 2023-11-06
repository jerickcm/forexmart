<style type="text/css">
    #account-transactions div.dataTables_info , div#account-trades1_info
    {
        width: 25%;
        float: left;
    }
    div.dataTables_paginate {
        white-space: nowrap;
        text-align: right;
        float: right;
    }
    div#update-history_paginate {
        white-space: nowrap;
        text-align: right;
        float: right;
        margin-top: 2%;
        margin-right: -12px;
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
    div#account-withdrawal_info , div#account-trades1_info {
        padding-top: 8px;
    }
    div#account-withdrawal_paginate , div#account-transactions_paginate{
        margin-top: -30px;
    }
    #tab_2{
        height: 500px;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .btn_set_agent{
        padding: 7px;
        width: 100%;
        color: #fff!important;
        margin: 0 auto;
        transition: all ease 0.3s;
        background: #29a643;
        border: none;
        margin-top: 2%;
    }
    .btn_edit{
        color: #fff!important;
        margin: 0 auto;
        transition: all ease 0.3s;
        background: #29a643;
        border: none;
        font-size:14px;
    }
    .btn_edit:hover{
        background: #29a643;
    }
    .btn_back{
        padding: 7px;
        text-align: center;
        outline: none;
        color: #fff!important;
        margin: 0 auto;
        transition: all ease 0.3s;
        background: #29a643;
        border: none;
    }
    #account-trades_paginate{
        margin-top:2%!important;
    }
</style>

<section class="content-header">
    <h1>Personal</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-paper-plane"></i> Quick Jump</li>
        <li>Personal</li>
        <li class="active">Full Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box style-box">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-box-initial-info">
            <div class="style-box-profile-img">
                <?php //print_r($dbInfo);exit;
                // $dp=$dbInfo['image']==''?'dist/img/user2-160x160.jpg':FXPP::www_url('user_images/'.$dbInfo['image'])?>

                <img src="<?php echo $dbInfo['image'] ? FXPP::my_url('assets/user_images/' . $dbInfo['image']) : $this->template->Images() . 'web-login-avatar.png' ?>"/>
            </div>
            <div class="style-box-profile-details">
                <ul>
                    <li>
                        <label>Account Number:</label>
                        <span id="account_number1"><?=$apiInfo['LogIn']?></span>
                    </li>
                    <li>
                        <label>Email Address:</label>
                        <span><?=$apiInfo['Email']?></span>
                    </li>
                    <li>
                        <label>Status:</label>
                        <span class="verified-indicator"><?=$status=$dbInfo['accountstatus']==1?$apiStatus.' Verified':$apiStatus.' Read only';?></span>
                    </li>
                </ul>
            </div>
            <div class="style-right-holder-btn">
                <div class="style-update-button">
                    <a id="btnUpdate">Update</a>
                </div>
                <div class="style-back-button">
                    <?= form_open('quick-jump',array('id' => 'BackSearch'),''); ?>
                    <input type="hidden" name="account" value="<?=$previousSearch;?>">
                    <button type="submit" class="btn_back">Back</button>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Personal Information</h3>
        </div>
        <div class="box-body">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Name:</label>
                        <span><?=$apiInfo['Name']?></span>
                    </li>
                    <li>
                        <label>Address:</label>
                        <span><?=$apiInfo['Address']?></span>
                    </li>
                    <li>
                        <label>City:</label>
                        <span><?=$apiInfo['City']?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>State/Province:</label>
                        <span><?=$apiInfo['State']?></span>
                    </li>
                    <li>
                        <label>Zip Code:</label>
                        <span><?=$apiInfo['ZipCode']?></span>
                    </li>
                    <li>
                        <label>Country:</label>
                        <span><?=$apiInfo['Country']?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Date of Birth:</label>
                        <span><?= $dob = $dbInfo['dob']=='0000-00-00'?'Please update date of birth':date('F d, Y', strtotime($dbInfo['dob']));?></span>
                    </li>
                    <li>
                        <label>Contact Details:</label>
                        <span><?=$apiInfo['PhoneNumber']?></span>
                    </li>
                    <li>
                        <label>Social Media:</label>
                        <span><?= $fb = $dbInfo['fb']==''?'Not available':$dbInfo['fb'];?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Affiliate Code:</label>
                        <span><?=$affiliate_code;?></span>
                    </li>
                    <?php if($logintype==1){ if(IPLoc::Office()){// print_r('testingyowadjnasdjasd='.$logintype); exit;?>
                        <li>
                            <label>Referrals:</label>
                            <span id="referral_count"><strong><?=$agentStats['user_referrals']?></strong></span>
                            <button type="button" data-toggle="modal" data-target="#set_agent" class="btn_edit">EDIT REFERRALS</button>
                        </li>
                    <?php } }else{ ?>
                        <li>
                            <label>Agent:</label>
                            <span id="current_agent"><?=$agent = $apiInfo['Agent']==0?'No agent':$apiInfo['Agent'];?></span>
                            <button type="button" data-toggle="modal" data-target="#set_agent" class="btn_edit">EDIT AGENT</button>
                        </li>
                    <?php } ?>

                    <li>
                        <label>Agent Affiliate Code:</label>
                        <span id="current_agent_code"><?=$referral_code=$referral_code==''?'N/A':$referral_code;?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Company Information</h3>
        </div>
        <div class="box-body">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Company Name:</label>
                        <span><?=$corp1=$corp1==''?'No Business account.':$corp1;?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Contact Details:</label>
                        <span><?=$corp2=$corp2==''?'No Business account.':$corp2;?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Website:</label>
                        <span><?=$corp3=$corp3==''?'No Business account.':$corp3;?></span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 style-box-personal-container">
                <ul class="style-box-personal-information">
                    <li>
                        <label>Status:</label>
                        <?php if($dbInfo['corporate_acc_status']==0){ $corpstatus = 'No Business account.';}else if($dbInfo['corporate_acc_status']==1){ $corpstatus = 'Pending'; }else if($dbInfo['corporate_acc_status']==2){ $corpstatus = 'Verified Business account'; }else if($dbInfo['corporate_acc_status']==4){ $corpstatus = 'Declined Business account'; }?>
                        <?php if($dbInfo['corporate_acc_status']!=2){?>
                            <span class="incomplete-indicator"><?=$corpstatus?></span>
                        <?php }else{?>
                            <span class="incomplete-indicator" style="color: green;"><?=$corpstatus?></span>
                        <?php }?>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-personal-tabs">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom style-customized-navigation-tab">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Personal Logs</a></li>
                        <li><a href="#tab_2" data-toggle="tab">All Records</a></li>
                        <li><a href="#tab_3" data-toggle="tab">All Trades</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="style-form-table-responsive">
                                <table id="update-history" class="table table-bordered table-striped dataTable style-form-table mid-table-head" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Modifier</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Name</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Field</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Previous Value</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">New Value</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Date Modified</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($history as $key){
                                        $who_modify = $key['manager_id'] == $key['user_id'] ? 'Client' : 'Manager';
                                        $name = $key['manager_id'] == 0 ? $key['user_name'] : $key['manager_name']; ?>
                                        <tr>
                                            <td><?=$who_modify?></td>
                                            <td><?=$name?></td>
                                            <td><?=$key['field']?></td>
                                            <td><?=$key['old_value']?></td>
                                            <td><?=$key['new_value']?></td>
                                            <td><?=date('m/d/Y h:i:s A', strtotime($key['date_modified']))?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <?php// if(IPLoc::Office()){ ?>
                            <div id="processing-loader" style="display:none;">LOADING RECORDS<img src="<?=$this->template->Images()?>loading.gif"></div>
                            <?php //} ?>
                            <h4>PROCESSED TRANSACTIONS</h4>
                            <div class="style-form-table-responsive">
                                <table id="account-transactions" class="table table-bordered table-striped dataTable style-form-table mid-table-head" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Date/Time</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Comment</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Status</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Account Receiver</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Amount</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Ticket</th>
                                    </tr>
                                    </thead>
                                    <tbody id="">
                                    <?php foreach($transactions as $key){
                                        $date = date('Y-m-d H:i:s',strtotime($key->Stamp))?>
                                        <tr>
                                            <td><?=$date?></td>
                                            <td><?=$key->Comment?></td>
                                            <td><?=$key->Status?></td>
                                            <td><?=$key->AccountReceiver?></td>
                                            <td><?=$key->Amount?></td>
                                            <td><?=$key->Ticket;?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <h4>TRADES</h4>
                            <div class="style-form-table-responsive">
                                <table id="account-trades1" class="table table-bordered table-striped dataTable style-form-table mid-table-head" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Time</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Ticket</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Type</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Volume</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Symbol</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Open Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">S/L</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">T/P</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Close Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Swaps</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Profit</th>
                                    </tr>
                                    </thead>
                                    <tbody id="trade-content1">
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>
                            <h4>WITHDRAWAL QUEUE</h4>
                            <div class="style-form-table-responsive">
                                <table id="account-withdrawal" class="table table-bordered table-striped dataTable style-form-table mid-table-head" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Ref #</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Amount Requested</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Amount to be deducted</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Transaction type</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Date Requested</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Recalled</th>
                                    </tr>
                                    </thead>
                                    <tbody id="withdrawal-content">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class="style-form-table-responsive">
                                <table id="account-trades" class="table table-bordered table-striped dataTable style-form-table mid-table-head" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Time</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Ticket</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Type</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Volume</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Symbol</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Open Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">S/L</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">T/P</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Close Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Swaps</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Profit</th>
                                    </tr>
                                    </thead>
                                    <tbody id="trade-content">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>

    </div>
</section>
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src='<?= $this->template->Js()?>jquery.validate.js'></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function () {

    });
    $('#update-history').DataTable({
        "bSort": false,
        "ordering": false,
        "info":     false,
        dom: 'rtp<"clear">'
    });
    var table = $('#account-trades').DataTable();
    $('#account-transactions').DataTable({
        "bSort": false,
        "ordering": false
    });
    var table1 = $('#account-trades1').DataTable();
    var table2 = $('#account-withdrawal').DataTable();
    $(function () {
        $('#datePicker1').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            yearRange: "-95:+0"
            //  defaultDate: '1920-01-01'
        });
    });
    $(document).ready(function () {
        $("#processing-loader").show();
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/trades')?>//";
        $.ajax({
            type: 'POST',url: base_url,dataType: 'json',
            data: {account_number:<?=$apiInfo['LogIn']?>},
            beforeSend: function(){ $('#loader-holder').show(); },
            success: function(data) {
                table.destroy();
                table1.destroy();
                if(data.flag){
                    var text = '<div style="display: inline;float: right;"><strong>Total Trade Volume: </strong> '+data.totalTradedVolume+'</div>';
                    $('#trade-content').html(data.opened);
                    $('#trade-content1').html(data.opened);
                    table = $('#account-trades').DataTable({
                        "bSort": false,
                        "ordering": false
                    });
                    $('#account-trades_info').append(text);
                    table1 = $('#account-trades1').DataTable({
                        "bSort": false,
                        "ordering": false
                    });
                    $('#account-trades1_info').append(text);
                }else{
                    $('#trade-content').html('<tr><td colspan="10">No data available.</td></td>');
                    $('#trade-content1').html('<tr><td colspan="10">No data available.</td></td>');
                }
            }
        });
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/withdrawal_queue')?>//";
        $.ajax({
            type: 'POST',url: base_url,dataType: 'json',
            data: {account_number:<?=$apiInfo['LogIn']?>},
            beforeSend: function(){ $('#loader-holder').show(); },
            success: function(data) {
                table2.destroy();
                $('#withdrawal-content').html(data.queue);
                table2 = $('#account-withdrawal').DataTable({
                    "bSort": false,
                    "ordering": false
                });
            }
        });
        $("#processing-loader").hide();

    });
    $(document).on('click', '#btnResetPassword', function(){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/reset_password')?>//";
        console.log('reset');
        var forgot_data = {
            email : '<?=$apiInfo['Email']?>',
            account_number : <?=$apiInfo['LogIn']?>
        };
        $.ajax({
            type: 'POST',
            url: base_url,
            dataType: 'json',
            data: forgot_data,
            success: function(x) {
                $('.manage-account-alert-message').html(x.message);
                $('.manage-account-alert-title').html("Personal Information");
                $('#modal-manage-account-alert').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    });

    $(document).on('click', '#btnSaveChanges', function(){
        if(($('input[name=email]').val!='') && ($('input[name=name]').val!='') && ($('input[name=address]').val!='') && ($('input[name=city]').val!='')
            && ($('input[name=state]').val!='') && ($('input[name=country]').val!='')
            && ($('input[name=zip_code]').val!='') && ($('input[name=phone_number]').val!='') && ($('input[name=birth_date]').val!='')){
            console.log('true');
            if($('#save-live-account').valid()){
                var base_url = "<?php echo FXPP::ajax_url('quick_jump/save_account')?>//";
                $.ajax({
                    type: 'POST',
                    url: base_url,
                    dataType: 'json',
                    data: new FormData($('#save-live-account')[0]),
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    beforeSend: function(){ $('#loader-holder').show(); },
                    success: function(x) {
                        if(x.success){
                            var c_id = $('#company_id').val();
                            if(c_id==''){
                                companyInformation('save');
                            }else{
                                companyInformation('update');
                            }
                            $('.manage-account-alert-message').html(x.message);
                            $('.manage-account-alert-title').html("Personal Information");
                            $('#myModal').modal('hide');
                            $('#modal-manage-account-alert').modal('show');
                        }else{
                            $('.manage-account-alert-title').html("Personal Information");
                            $('.manage-account-alert-message').html(x.message);
                            $('#modal-manage-account-alert').modal('show');
                        }
                        $('#loader-holder').hide();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('#loader-holder').hide();
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        }else{
            console.log('false');
            $('.manage-account-alert-title').html("Personal Information");
            $('.manage-account-alert-message').html('<span>Fields with <cite style="color: #ff0000;font-weigth:bold;">*</cite> are required.</span>')
            $('#modal-manage-account-alert').modal('show');
        }
    });
    function companyInformation(action){
        $('.error').hide();
        var error_status=false;
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/corporate-info-save')?>//";
        if($("#company_name").val().length<1){
            $('.comp-name-error').show();
            $('.comp-name-error').css({"display":"block!important","color":"#ff0000","float":"right"});
            $('.comp-name-error').text('Company name required');
            error_status=true;
        }
        if($("#Contact_num").val().length<1){
            $('.contact-error').show();
            $('.contact-error').css({"display":"block!important","color":"#ff0000","float":"right"});
            $('.contact-error').text('Contact number required');
            error_status=true;
        }

        if($("#business_type").val().length<1){
            $('.error-business-type').show();
            $('.error-business-type').css({"display":"block!important","color":"#ff0000","float":"right"});
            $('.error-business-type').text('Business type required');
            error_status=true;
        }
        if(error_status==false){
            var forgot_data = {
                name : $("#company_name").val(),
                number : $("#Contact_num").val(),
                business_type : $("#business_type").val(),
                company_trading_name : $("#trading_name").val(),
                company_website : $("#company_website").val(),
                acctid : $("#acct_id").val(),
                action:action
            };
            $.ajax({
                type: 'POST',
                url: base_url,
                dataType: 'json',
                data: forgot_data,
                beforeSend: function(){
                    showloader();
                },
                success: function(x) {
                    if(x.success){
                        hideloader();
                        $(".corp-success").css({"color":"green","font-size":"16px","margin-bottom":"10px","display":"block","text-align":"center"});
                        $(".corp-success").text(x.message);
                    }else{
                        //  $('#loader-holder').hide();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    hideloader();
                }
            });

        }
    }
    $(document).on('click','#btnUpdate',function () {
        showloader();
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/get_account_details')?>//";
        var account_number1 = $("#account_number1").text();
        console.log(account_number1);
        if(account_number1.length>5){
            $.ajax({
                type: 'POST',
                url: base_url,
                dataType: 'json',
                data: {
                    id: account_number1
                },
                success: function(x) {
                    console.log(x);
                    if(x.success){

                        account_number = x.account_number;
                        for (var account in x.account_data) {

                            jQuery('[name=' + account + ']').val(x.account_data[account]);

                            if (x.account_data['social_media_type'] == null)
                            {
                                if (x.account_data['fb'] == null) {
                                    $('#div_social_media_type').hide();
                                }else{
                                    $('#social_media_type').html('Facebook/Vk');
                                    $('#fb').val(x.account_data['fb']);
                                }
                            }else{
                                $('#div_social_media_type').show();
                                $('#social_media_type').html(x.account_data['social_media_type']);
                            }
                        }

                        jQuery('#company_id').val(x.c_id);
                        jQuery('#acct_id').val(x.account_number);
                        jQuery('#company_name').val(x.c_name);
                        jQuery('#trading_name').val(x.c_trd_name);
                        jQuery('#company_website').val(x.c_website);
                        jQuery('#business_type').val(x.c_business_type);
                        jQuery('#Contact_num').val(x.c_contact);

                        $('input[name=swap_free]').prop('checked', x.trading_data['swap_free']);
                        jQuery('input[name=auto_leverage]').prop('checked', x.account_data['auto_leverage']);
                        $('select[name=experience]').val(x.trading_data['trading_experience']);
//                        jQuery('input[name=experience]:eq(0)').prop('checked', x.trading_data['trading_experience'][0]);
//                        jQuery('input[name=experience]:eq(1)').prop('checked', x.trading_data['trading_experience'][1]);
//                        jQuery('input[name=experience]:eq(2)').prop('checked', x.trading_data['trading_experience'][2]);
                        jQuery('#politically_exposed_person').text(x.trading_data['politically_exposed_person']);
                        jQuery('#risk').text(x.trading_data['risk']);
                        jQuery('#us_resident').html(x.employee_data['us_resident']);
                        jQuery('#us_citizen').html(x.employee_data['us_citizen']);

                        if(x.mt_status==0 || x.mt_status==''){
                            $("#btn_account_switch").hide();
                        } else{
                            $("#btn_account_switch").show();
                        }
                        $('#myModal').modal('show');
                    }else{
//                        $("#required-field").modal('show');
//                        $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
                    }
                    hideloader();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').css({"display":"none"});
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }else{
//            $("#required-field").modal('show');
//            $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
        }
    });
</script>
<?php echo $this->load->ext_view('modal', 'v2_update_personal', '', TRUE); ?>
<!--MODALS-->
<div class="modal fade" id="modalResetPassword" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" style="z-index:1999;">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center header-message" id="header-message-switch">Reset Password</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center reset-password-message"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-manage-account-alert" tabindex="-1" role="dialog" aria-labelledby="" style="z-index:1041;">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center manage-account-alert-title"></h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center manage-account-alert-message"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="required-field" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
    <div class="modal-dialog round-0 mod1">
        <div class="modal-content round-0">
            <div class="modal-header round-0 mod2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p id="quick-error-msg"></p>
            </div>
        </div>
        <div class="arrow-left"></div>
    </div>
</div>
<div class="modal fade" id="set_agent" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
    <div class="modal-dialog round-0 mod1">
        <div class="modal-content round-0" style="width: 50%;margin-left: 25%;">
            <div class="modal-header round-0 mod2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?php if($logintype==1){ if(IPLoc::Office()){// print_r('testingyowadjnasdjasd='.$logintype); exit;?>
                <div class="modal-header round-0 mod2">
                    <Strong>Referrals:</Strong>
                    <button type="button" id="" class="btn_set_agent">Referrals</button>
                </div>
            <?php } }else{ ?>
                <div class="modal-header round-0 mod2">
                    <Strong>Set agent of account:</Strong>
                    <input type="text" value="<?=$apiInfo['Agent']?>" style="width: 100%;padding: 10px;" placeholder="Agent's account number" id="agent_account">
                    <button type="button" id="btn_set_agent" class="btn_set_agent">Set Agent</button>
                </div>
            <?php } ?>
        </div>
        <div class="arrow-left"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click','#btn_set_agent',function () {
        var agent = $('#agent_account').val();
        var old_agent = $('#current_agent').text();
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/update_agent')?>//";
        $.ajax({
            type: 'POST',url: base_url,dataType: 'json',
            data: {account_number:<?=$apiInfo['LogIn']?>,new_agent:agent,old_agent:old_agent},
            beforeSend: function(){ $('#loader-holder').show(); },
            success: function(data) {
                if(data.success){
                    $('#current_agent').html(data.agent);
                    $('#current_agent_code').html(data.code);
                    $("#set_agent").modal('hide');
                    $("#required-field").modal('show');
                    $('#quick-error-msg').text("Account's agent successfully updated.");
                }else{
                    $("#required-field").modal('show');
                    $('#quick-error-msg').text('Please enter a valid agent account');
                }
            }
        });
    });
</script>