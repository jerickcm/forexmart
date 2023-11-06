<link rel="stylesheet" href="<?= $this->template->Css()?>custom_qj.css" type="text/css"/>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<div id="accordion-container" style="border-bottom:1px solid #479edb;">
<?php
$permission=explode(",",$access['permission']);
foreach($permission as $key)
 { ?>
<?php  if($key=="qjum") {?>
     <h2 class="accordion-header <?=$menu=="index"?"active-header":"inactive-header"?>" ><label class="accordion-quick-jump"></label> Quick Jump <span class="accordion-arrow"></span></h2>
     <div class="accordion-content <?=$menu=="index"?"open-content":""?>" >
         <?= form_open('quick_jump/records',array('id' => 'quick','class'=> '', 'enctype'=>"multipart/form-data"),''); ?>
         <ul class="tabs-left">
             <li class="tb <?=$active=='login-field'?'active':''?>"><input id="account_number" name="account_number" class="tab-input-form1 numeric" type="text" style="width:100%;"></li>
             <?php foreach($permission as $key){?>
                 <?php if($key=="qjper") {?><li class="<?=$active=='personal'?'active':''?>"><a onclick="profileView()" href="Javascript:;"  >Personal</a></li><?php } ?>
                 <?php if($key=="qjall") {?>      <li class="<?=$active=='all-records'?'active':''?>"><a onclick="allRecords()" href="Javascript:;"   >All Records</a></li><?php } ?>
                 <?php if($key=="qjtra") {?>     <li class="<?=$active=='only-traders'?'active':''?>"><a href="Javascript:;"  onclick="historyOfTrades()">Only Trades</a></li><?php } ?>
                 <?php if($key=="qjgot") {?>      <li class="<?=$active=='go-to-cabinet'?'active':''?>"><a href="<?=site_url('quick_jump/go_to_cabinet')?>"  >Go to the cabinet</a></li><?php } ?>
            <?php }?>
         </ul>
         <?=form_close();?>
     </div>
 <?php } if($key=="acc") {?>
    <h2 class="accordion-header <?=$menu=="accordion-account"?"active-header":"inactive-header"?>"><label class="accordion-account"></label> Account <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-account"?"open-content":""?>">
        <ul class="tabs-left">
            <?php foreach($permission as $key){?>
            <?php //if($key=="searchacc") {?><!--<li class="<?=$active=='search-account'?'active':''?>"><a href="<?=site_url('accounts/search_account')?>" >Search for account</a></li>--><?php //} ?>
            <?php if($key=="openacc") {?><li class="<?=$active=='open-account'?'active':''?>"><a href="<?=site_url('open_account')?>"  >Open account</a></li><?php } ?>
            <?php if($key=="checkphone") {?><li class="<?=$active=='check-phone-password'?'active':''?>"><a href="<?=site_url('accounts/check_phone_password')?>"  >Check phone password</a></li><?php } ?>
            <?php if($key=="increg") {?><li class="<?=$active=='incomplete_accounts'?'active':''?>"><a href="<?=site_url('verify/incomplete_accounts')?>"  >Incomplete registration</a></li><?php } ?>
            <?php if($key=="baltran") {?><li class="<?=$active=='balance_transaction'?'active':''?>"><a href="<?=site_url('accounts/balance_transaction')?>"  >Balance Transaction</a></li><?php } ?>
            <?php }?>
        </ul>
    </div>
<?php } if($key=="fina") {?>

    <h2 class="accordion-header <?=$menu=="accordion-finance"?"active-header":"inactive-header"?>"><label class="accordion-finance"></label> Finance <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-finance"?"open-content":""?>">
        <ul class="tabs-left">
            <?php foreach($permission as $key){?>
                <?php if($key=="finbal") {?><li class="<?=$active=='credit-funds'?'active':''?>"><a href="<?=site_url('credit-funds')?>" >Balance</a></li><?php } ?>
                <?php if($key=="finmar") {?><li class="<?=$active=='cancel-funds'?'active':''?>"><a href="<?=site_url('cancel-funds')?>" >Margin</a></li><?php } ?>
                <?php if($key=="fincre") {?><li class="<?=$active=='credit-mini-bonus'?'active':''?>"><a href="<?=site_url('credit-mini-bonus')?>" >Credit</a></li><?php } ?>
            <?php }?>
        </ul>
    </div>
<?php } if($key=="ord") {?>
    <h2 class="accordion-header <?=($menu=="accordion-orders")?"active-header":"inactive-header"?>"><label class="accordion-orders"></label> Orders <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-orders"?"open-content":""?>">
        <ul class="tabs-left">
            <?php foreach($permission as $key){?>
                <?php if($key=="ordfind") {?><li class="<?=$active=='find-orders'?'active':''?>"><a href="<?=site_url('find-orders')?>" >Find order</a></li><?php } ?>
                <?php if($key=="ordmod") {?><li class="<?=$active=='find-orders'?'active':''?>"><a href="<?=site_url('orders-list')?>"  >Modify order</a></li><?php } ?>
            <?php }?>
        </ul>
    </div>
<?php } if($key=="part") {?>

    <h2 class="accordion-header <?=$menu=="accordion-partners"?"active-header":"inactive-header"?>"><label class="accordion-partners"></label> Partners <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-partners"?"open-content":""?>">
        <ul class="tabs-left">
            <?php foreach($permission as $key){?>
            <?php if($key=="parref") {?><li><a href="<?=site_url('referrals')?>"  >Referrals</a></li><?php } ?>
            <?php }?>
        </ul>
    </div>

  <?php } if($key=="vef") {?>
    <h2 class="accordion-header <?=$menu=="accordion-verify"?"active-header":"inactive-header"?>"><label class="accordion-verify"></label>  Verify <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-verify"?"open-content":""?>">
        <ul class="tabs-left">
         <?php foreach($permission as $key){?>
             <?php if($key=="verche") {?><li class="<?=$active=='check_level'?'active':''?>"><a href="<?=site_url('verify/check_level')?>" >Check Level</a></li><?php } ?>
             <?php if($key=="verque") {?><li class="<?=$active=='verify'?'active':''?>"><a href="<?=site_url('verify')?>"  >ID Check Query</a></li><?php } ?>
        <?php }?>
        </ul>
    </div>
 <?php } if($key=="mkt") {?>

    <h2 class="accordion-header <?=$menu=="accordion-marketing"?"active-header":"inactive-header"?>"><label class="accordion-marketing"></label>  Marketing <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-marketing"?"open-content":""?>">
        <ul class="tabs-left">
         <?php foreach($permission as $key){?>
            <?php if($key=="marsta") {?><li><a href="#statistics"  >Statistics</a></li><?php } ?>
        <?php }?>
        </ul>
    </div>
 <?php } if($key=="tinfo") {?>
    <h2 class="accordion-header <?=$menu=="accordion-total-information"?"active-header":"inactive-header"?>"><label class="accordion-total-information"></label>  Total Information <span class="accordion-arrow"></span></h2>
    <div class="accordion-content <?=$menu=="accordion-total-information"?"open-content":""?>">
        <ul class="tabs-left">
        <?php foreach($permission as $key){?>
            <?php if($key=="totacc") {?><li  class="<?=$active=='personal'?'active':''?>"><a href="<?=site_url('total_information')?>"  >Accounts Total</a></li><?php } ?>
            <?php if($key=="totdep") {?><li  class="<?=$active=='deposits'?'active':''?>"><a href="<?=site_url('total_information/deposits')?>"  >Deposits Total</a></li><?php } ?>
            <?php if($key=="totsal") {?><li  class="<?=$active=='saldo'?'active':''?>"><a href="<?=site_url('total_information/saldo')?>"  >Saldo Total</a></li><?php } ?>
            <?php if($key=="tottra") {?><li  class="<?=$active=='trade'?'active':''?>"><a href="<?=site_url('total_information/trade')?>"  >Trade Results Total</a></li><?php } ?>
        <?php }?>
        </ul>
    </div>
 <?php } } ?>
    <?php foreach($permission as $key){ if($key=='mana'){?>
    <h2 class="accordion-header <?=$menu=="manage-access"?"active-header":"inactive-header"?>">
        <a href="<?=site_url('manage-access')?>" style="color: white; padding: 5px 82px 7px 0;text-decoration: none;" ><label class="accordion-verify"></label> Manage Access</a></h2>
    <div></div>
    <?php } }?>
</div>

<script>
    var site_url="<?=site_url('')?>";
    var account_number='';
    function historyOfTrades(){
        var base_url1 = "<?php echo FXPP::ajax_url('quick_jump/get_account_details')?>//";
            var base_url = "<?php echo FXPP::ajax_url('quick_jump/historyOfTrades')?>";
            var account_number = $("#account_number").val();
            if (account_number.length > 5) {
                $("#loader-holder").show();
                $.ajax({
                    type: 'POST',
                    url: base_url1,
                    dataType: 'json',
                    data: { id: account_number },
                    success: function(x) {
                     if(x.success){
                         $.post(base_url, {account_number: account_number}, function (data) {
                             $("#modal-only-trades .modal-body").html(data);
                             $('.modalAccountNumber').text(account_number);
                             $('#modal-only-trades').modal('show');
                             $("#loader-holder").hide();
                         });
                     }else{
                         $("#loader-holder").hide();
                         $("#required-field").modal('show');
                         $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
                     }
                  },
                    error: function (xhr, ajaxOptions, thrownError) { $('#loader-holder').hide(); console.log(xhr.status); console.log(thrownError); }
                });
            } else {
                $("#loader-holder").hide();
                $("#required-field").modal('show');
                $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
            }

    }
    function balanceRecords(){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/balanceRecords')?>";
        var account_number = $("#account_number").val();
        if(account_number.length>5){
            $("#loader-holder").show();
            $.post(base_url,{account_number:account_number},function(data){
                $("#modal-balance-records .modal-body").html(data);
                $('.modalAccountNumber').text(account_number);
                $('#modal-balance-records').modal('show');
                $("#loader-holder").hide();
            })
        }else{
            $("#required-field").modal('show');
            $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
        }
    }

    function allRecords(){
        var base_url1 = "<?php echo FXPP::ajax_url('quick_jump/get_account_details')?>//";
            var base_url = "<?php echo FXPP::ajax_url('quick_jump/allRecords')?>";
            var account_number = $("#account_number").val();
            if(account_number.length>5){
                $("#loader-holder").show();
                $.ajax({
                    type: 'POST',
                    url: base_url1,
                    dataType: 'json',
                    data: { id: account_number },
                    success: function(x) {
                        if(x.success){
                            $.post(base_url,{account_number:account_number},function(data){
                                $("#modal-all-records .modal-body").html(data);
                                $('.modalAccountNumber').text(account_number);
                                $('#modal-all-records').modal('show');
                                $("#loader-holder").hide();
                            });
                        }else{
                            $("#loader-holder").hide();
                            $("#required-field").modal('show');
                            $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) { $('#loader-holder').hide(); console.log(xhr.status); console.log(thrownError); }
                });
            }else{
                $("#loader-holder").hide();
                $("#required-field").modal('show');
                $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
            }
    }


    function profileView(){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/get_account_details')?>//";
        var account_number1 = $("#account_number").val();
        if(account_number1.length>5){
            $.ajax({
                type: 'POST',
                url: base_url,
                dataType: 'json',
                data: {
                    id: account_number1
                },
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(x) {
                    console.log(x);
                    if(x.success){
                        if(x.corporate_acc_status ==1 || x.corporate_acc_status==2){
                            $('#modal-manage-account').modal('hide');
                            $("#modal-manage-account_corporate").modal('show');
                        } else{
                            $("#modal-manage-account_corporate").modal('hide');
                            $('#modal-manage-account').modal('show');
                        }

                        account_number = x.account_number;
                        $('.modalAccountNumber').text(x.account_number);
                        $('#accountNumber').val(x.account_number);
                        $('#accountNumber1').val(x.account_number);

                        $('#accountID').val(x.user_id);
                        $('#accountID1').val(x.user_id);
                        // Company info
                        if(x.corporate_acc_status==2){
                            jQuery('#company_id').val(x.c_id);
                            jQuery('#acct_id').val(x.account_number);
                            jQuery('#company_name').val(x.c_name);
                            jQuery('#trading_name').val(x.c_trd_name);
                            jQuery('#company_website').val(x.c_website);
                            jQuery('#business_type').val(x.c_business_type);
                            jQuery('#Contact_num').val(x.c_contact);
                        }

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

                        <?php if( $type == 1 ){ ?>
                        jQuery('input[name=swap_free]').prop('checked', x.trading_data['swap_free']);
                        jQuery('input[name=auto_leverage]').prop('checked', x.account_data['auto_leverage']);
                        jQuery('input[name=experience]:eq(0)').prop('checked', x.trading_data['trading_experience'][0]);
                        jQuery('input[name=experience]:eq(1)').prop('checked', x.trading_data['trading_experience'][1]);
                        jQuery('input[name=experience]:eq(2)').prop('checked', x.trading_data['trading_experience'][2]);
                        jQuery('#politically_exposed_person').html(x.trading_data['politically_exposed_person']);
                        jQuery('#risk').html(x.trading_data['risk']);
                        jQuery('#us_resident').html(x.employee_data['us_resident']);
                        jQuery('#us_citizen').html(x.employee_data['us_citizen']);
                        <?php } ?>

                        if(x.mt_status==0 || x.mt_status==''){
                            $("#btn_account_switch").hide();
                        } else{
                            $("#btn_account_switch").show();
                        }
                    }else{
                        $("#required-field").modal('show');
                        $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
                    }
                    $('#loader-holder').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }else{
            $("#required-field").modal('show');
            $('#quick-error-msg').text('Please enter a valid account number on Quick Jump.');
        }
    }


    $(document).ready(function (e) {
        //console.log(e);
        jQuery(".numeric").on("keypress keyup blur",function (event) {
            //console.log(event);
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        jQuery(".numeric").on("blur",function (event) {
            var value=$(this).val().replace(/[^0-9.,]*/g, '');
            value=value.replace(/\.{2,}/g, '.');
            value=value.replace(/\.,/g, ',');
            value=value.replace(/\,\./g, ',');
            value=value.replace(/\,{2,}/g, ',');
            value=value.replace(/\.[0-9]+\./g, '.');
            $(this).val(value)
        });
    });

    function checkLoginType(lt) {
        console.log('<?=$login_type?>' + ' sidelink');
        var login_type = parseFloat(lt);
        if (login_type === 1) {
            $('#leverage').prop('disabled',true);
            console.log(login_type + ' : partner');
        } else {
            $('#leverage').prop('disabled',false);
            console.log(login_type + ' : client');
        }
    }




    $(document).on('click', '#btnLiveSaveChanges1', function(){
        console.log($('#liveAccountDetails1').serialize());
        if($('#liveAccountDetails1').valid()){
            $.ajax({
                type: 'POST',
                url: site_url+'quick_jump/update_live_account1',
                dataType: 'json',
                // data: $('#live_account_details').serialize(),
                data: new FormData($('#liveAccountDetails1')[0]),
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(x) {
                    console.log(x);
                    if(x.success){
                        $('#modal-manage-account-corporate').modal('hide');
                        $('#modal-manage-account-alert1').modal('show');
                        $('.manage-account-alert-message').html(x.message);
                        $('.manage-account-alert-title').html("Personal Information");
                    }else{
                        $('#modal-manage-account-corporate').modal('hide');
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
    });
</script>
<script>
    $(document).on('click', '#btnLiveSaveChanges', function(){
        console.log(jQuery('#live_account_details').serialize());
        if($('#live_account_details').valid()){
            $.ajax({
                type: 'POST',
                url: site_url+'quick_jump/update_live_account1',
                dataType: 'json',
                // data: $('#live_account_details').serialize(),
                data: new FormData($('#live_account_details')[0]),
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(x) {
                    console.log(x);
//                    tblAccounts.ajax.reload();
                    if(x.success){
                        $('#modal-manage-account').modal('hide');
                        $('#modal-manage-account-alert1').modal('show');
                        $('.manage-account-alert-message').html(x.message);
                        $('.manage-account-alert-title').html("Personal Information");
                    }else{
                        $('#modal-manage-account').modal('hide');
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
    });
</script>


<script>
    $('#save_company_btn').click(function(){
        var c_id = $('#company_id').val();
        if(c_id==''){
            companyInformation('save');
        }else{
            companyInformation('update');
        }
    });
    function companyInformation(action){
        $('.error').hide();
        var error_status=false;

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
                url: site_url+"quick_jump/corporate-info-save",
                dataType: 'json',
                data: forgot_data,
                beforeSend: function(){
                    // $('#loader-holder').show();
                },
                success: function(x) {
                    if(x.success){
                        // console.log(x);
                        $('#loader-holder').hide();
                        $(".corp-success").css({"color":"green","font-size":"16px","margin-bottom":"10px","display":"block","text-align":"center"});
                        $(".corp-success").text(x.message);
                    }else{
                        //  $('#loader-holder').hide();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            });

        }
    }
</script>
<script>
    $(document).on('click', '#btnResetPassword', function(){
        var forgot_data = {
            email : $('input[name="email"]').val(),
            account_number : $('#accountNumber').val()
        };
        $.ajax({
            type: 'POST',
            url: site_url+'quick_jump/reset_password',
            dataType: 'json',
            data: forgot_data,
            beforeSend: function(){  $('#loader-holder').show(); },
            success: function(x) {
                if(x.success){
                    $('#modal-manage-account').modal('hide');
                    $('#modal-manage-account_corporate').modal('hide');
                    $('.reset-password-message').html(x.message);
                    $('#loader-holder').hide();
                    $('#modalResetPassword').modal('show');
                }else{
                    $('.reset-password-message').html(x.message);
                    $('#loader-holder').hide();
                    $('#modalResetPassword').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
    $(document).on('click', '#btnResetPassword1', function(){
        var forgot_data = {
            email : $('input[name="email"]').val(),
            account_number : $('#accountNumber1').val()
        };
        $.ajax({
            type: 'POST',
            url: site_url+'quick_jump/reset_password',
            dataType: 'json',
            data: forgot_data,
            beforeSend: function(){  $('#loader-holder').show(); },
            success: function(x) {
                if(x.success){
                    $('#modal-manage-account_corporate').modal('hide');
                    $('.reset-password-message').html(x.message);
                    $('#loader-holder').hide();
                    $('#modalResetPassword').modal('show');
                }else{
                    $('#loader-holder').hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
    $(document).on('click', '#btnLiveResend', function(){
        if($('#live_account_details').valid()){
            $.ajax({
                type: 'POST',
                url: site_url+'quick_jump/resend_live_account',
                dataType: 'json',
                data: new FormData($('#live_account_details')[0]),
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                beforeSend: function(){ $('#loader-holder').show(); },
                success: function(x) {
//                    tblAccounts.ajax.reload();
                    if(x.success){
                        $('#modal-manage-account').modal('hide');
                        $('#modal-manage-account-alert1').modal('show');
                        $('.manage-account-alert-message').html(x.message);
                        $('.manage-account-alert-title').html("Personal Information");
                    }else{
                        $('#modal-manage-account').modal('hide');
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
    });
    $(document).on('click', '#btnLiveResend1', function(){
        if($('#liveAccountDetails1').valid()){
            $.ajax({
                type: 'POST',
                url: site_url+'quick_jump/resend_live_account',
                dataType: 'json',
                data: new FormData($('#liveAccountDetails1')[0]),
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                beforeSend: function(){ $('#loader-holder').show(); },
                success: function(x) {
//                    tblAccounts.ajax.reload();
                    if(x.success){
                        $('#modal-manage-account-corporate').modal('hide');
                        $('#modal-manage-account-alert1').modal('show');
                        $('.manage-account-alert-message').html(x.message);
                        $('.manage-account-alert-title').html("Personal Information");
                    }else{
                        $('#modal-manage-account-corporate').modal('hide');
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
    });
    $(document).on('click', '.open-update-history', function(){
        $.ajax({
            type: 'POST',
            url: site_url+'quick_jump/get_account_update_history',
            dataType: 'json',
            data: { id: account_number },
            beforeSend: function(){   $('#loader-holder').show();  },
            success: function(data) {
                $('#tblAccountUpdateHistoryRows').html(data.update_history_data);
                $('#accountUpdateHistory_accountNumber').html(': ' + data.account_number);
                $('#loader-holder').hide();
                $('#accountUpdateHistory').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
    $(document).on('click', '.open-update-view', function(){
        var id = jQuery(this).data('id');
        var anum = jQuery(this).data('anum');
        $.ajax({
            type: 'POST',
            url: site_url+'quick_jump/get_account_field_update_history',
            dataType: 'json',
            data: {
                id: id,
                anum: anum
            },
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(data) {
//                tblAccountFieldUpdateHistory.destroy();
                $('#accountFieldUpdateHistory .manager-name').html(data.manager_name);
                $('#tblAccountFieldUpdateHistoryRows').html(data.update_field_history_data);
                $('#accountFieldUpdateHistory_accountNumber').html(': ' + data.account_number);
                $('#loader-holder').hide();
                $('#accountFieldUpdateHistory').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('.tip_name').tooltip({title: "<p align='left' style='padding: 5px !important;'>Name field should be up to 128 characters.</p>", html: true, placement: "right"});
        $('.tip_address').tooltip({title: "<p align='left' style='padding: 5px !important;'>Address field should be up to 128 characters.</p>", html: true, placement: "right"});
        $('.tip_city').tooltip({title: "<p align='left' style='padding: 5px !important;'>City field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('.tip_state').tooltip({title: "<p align='left' style='padding: 5px !important;'>State/Province field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('.tip_zip').tooltip({title: "<p align='left' style='padding: 5px !important;'>Postal/Zip Code field should be up to 16 characters.</p>", html: true, placement: "right"});
        $('.tip_telephone1, .tip_telephone2').tooltip({title: "<p align='left' style='padding: 5px !important;'>Telephone field should be up to 32 characters.</p>", html: true, placement: "right"});
        $('.tip_email1, .tip_email2, .tip_email3').tooltip({title: "<p align='left' style='padding: 5px !important;'>Email field should be up to 48 characters.</p>", html: true, placement: "right"});

            $('#c_name').tooltip({title: "<p align='left' style='padding: 5px !important;'>Company Name Field should be up to 128 characters.</p>", html: true,placement:"right"});
            $('#c_trading').tooltip({title: "<p align='left' style='padding: 5px !important;'>If you use different trading name for your company, if not you can leave it blank</p>", html: true,placement:"right"});
            $('#c_website').tooltip({title: "<p align='left' style='padding: 5px !important;'>If you have Company Website, if none you can leave it blank.</p>", html: true,placement:"right"});
            $('#c_bustype').tooltip({title: "<p align='left' style='padding: 5px !important;'>Use comma if your company have multiple business type. (e.g. Banking, Finance, Accounting).</p>", html: true,placement:"right"});
            $('#c_contact').tooltip({title: "<p align='left' style='padding: 5px !important;'>Contact Number should be up to 32 characters.</p>", html: true,placement:"right"});

    });
    jQuery(document).on('click', '#btn_account_switch', function(){
        var forgot_data = {
            email : jQuery('input[name="email"]').val(),
            account_number : jQuery('#accountNumber').val(),
            full_name : jQuery('input[name="name"]').val()
        };
        jQuery.ajax({
            type: 'POST',
            url: "<?=site_url('')?>quick_jump/switchTpoCorporateAccount",
            dataType: 'json',
            data: forgot_data,
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(x) {
                console.log(x); //FXPP-5853
                if(x.success){
                    jQuery('#modal-manage-account').modal('hide');
                    jQuery('.reset-password-message').html(x.message);
                    $('#loader-holder').hide();
                    jQuery('#switch_account').modal('show');
                }else{
                    $('#loader-holder').hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
</script>
<!--MODALS-->
<div class="modal fade" id="modalResetPassword" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" style="z-index:1999;width: 87%;">
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
<div class="modal fade" id="modal-manage-account-alert1" tabindex="-1" role="dialog" aria-labelledby="" style="width:87%;z-index:1041;">
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
<?php echo $this->load->ext_view('modal', 'manage_accounts_live', $data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'manage_account_live_corporate',$data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'account_field_update_history',$data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'account_update_history',$data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'all_records',$data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'only_trades',$data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'balance_records',$data, TRUE);?>
<?php echo $this->load->ext_view('modal', 'switch-account',$data, TRUE);?>
