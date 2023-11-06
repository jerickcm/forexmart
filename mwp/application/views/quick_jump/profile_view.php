<link rel="stylesheet" href="<?= $this->template->Css()?>bootstrap.min.css">
<link rel='stylesheet' href='".$this->template->Css()."bootstrap-datepicker.min.css'>
<script type='text/javascript' src='<?= $this->template->Js()?>bootstrap-datepicker.min.js'></script>
<style>
    .dataTables_wrapper{
        clear: none!important;
    }
    table.dataTable{
        clear: none!important;
    }
    table.dataTable select{
        padding: 6px 6px!important;
    }
    .dataTables_wrapper .dataTables_info{
        clear: none!important;
    }
    #table_filter{display: none;}
    .tab-input-form {
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #555;
        margin-bottom: 20px !important;
        width: 200px !important;
        height: 37px !important;
    }
    .personal .txt-label{text-align: right; float: left; width: 136px;}
    .personal label input{float: left;}
    .personal label{text-align: left!important; float: left; width: 200px;}
    #msg{ color: #008000;}
    select{width: 172px;}
    .nav > li > a{color:#23527c}
    .nav-tabs>li.active>a{color:#29a643 !important;}
    .data-center-container table tr td{padding-left: 15px;padding-right: 15px;}
</style>


<div class="tab-pane active" id="check-phone-password" style="/*margin-top: -190px;z-index:999;position: relative;*/">
    <div  class="table-container-holder table-container-border table-container-margin data-center-container">

        <div class="tab-title-header">
            <h1 class="all_tab_title" style="margin-left: 0px!important;margin-top: 0px;">Personal Information</h1>
            <div class="tab-search-bar">
                <form method="post" id="form_accountno">
                    <input name="search" id="search_accounts" type="text" value="<?php echo set_value('search');?>" class="tab-input-form" placeholder="Type here..."/>
                    <button id="search_acc" class="tab-input-button green-input-button go-button" type="submit">Go</button>
                </form>
            </div>
        </div>
        <form id="personal_info" method="Post">
        <table class="personal" cellpadding="0" cellspacing="0">
            <!--FXPP-5564-->
            <tr>
                <td class="col-md-4"><label for="email">Email:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <input type="text" name="email" id="email" value="<?=$email['value'];?>" placeholder="email" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="name">Full Name:</label></td>
                <td class="col-md-8" id="name">
                    <div class="col-md-8">
                        <input type="text" name="full_name" id="full_name" value=" <?=$full_name['value'];?>" placeholder="Full name" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="name">Street Address:</label></td>
                <td class="col-md-8" id="street">
                    <div class="col-md-8">
                        <input type="text" name="street" id="street" value="<?=$street['value'];?>" placeholder="Street address" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="name">City:</label></td>
                <td class="col-md-8" id="city">
                    <div class="col-md-8">
                        <input type="text" name="city" id="city" value="<?=$city['value'];?>" placeholder="City" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="state">State/Province:</label></td>
                <td class="col-md-8" id="state">
                    <div class="col-md-8">
                        <input type="text" name="state" id="state" value="<?=$state['value'];?>" placeholder="State/Province" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="state">Date of Birth:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <input id="dob" name="dob" class="form-control round-0 datepicker" placeholder=""  value="<?=$dob['value'];?>" style="width: 30%;" />
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="country">Country:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <select class="form-control input-sm" id="country">
                            <?php echo $countries;?>
                        </select>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="state">Postal/Zip Code:</label></td>
                <td class="col-md-8" id="postal">
                    <div class="col-md-8">
                        <input type="text" name="zip_code" id="zip" value="<?=$zip['value'];?>" placeholder="Postal/Zip Code" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="state">Phone Number:</label></td>
                <td class="col-md-8" id="mobile">
                    <div class="col-md-8">
                        <input type="text" name="phone_number" id="phone1" value="<?=$phone1['value'];?>" placeholder="Phone Number" style="width: 100%;padding: 2px;">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <!--FXPP-5564-->
        </table>
        </form>
        <table id="tabPane" class="personal" cellpadding="0" cellspacing="0">
            <?php //echo $table_data; ?>
            <tr>
                <td class="col-md-4"><label for="leverage">Leverage:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <select class="form-control input-sm" id="leverage">
                            <?php echo $leverages;?>
                        </select>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="account_number">Account Number:</label></td>
                <td class="col-md-8" id="account_number">
                    <div class="col-md-8">
                        <?=$LogIn?>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="comment">Comment:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <?=$Comment?>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Group:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <?=$Group?>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Agent account:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <?=$Agent?>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Read only (without trading):</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <input <?=$IsReadOnly?"checked":" " ?> name="checkbox[1]" type="checkbox" value="mt.account_number" class="">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Enable one-time password:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <input name="checkbox[1]" type="checkbox" value="mt.account_number" class="">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Registered Date:</label></td>
                <td class="col-md-8" id="date_registered">
                    <div class="col-md-8">
                        <?=$RegDate?>
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Allow to change password:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <input <?=$IsEnable?"checked":" " ?> name="checkbox[10]" type="checkbox" value="mt.account_number" class="">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
            <tr>
                <td class="col-md-4"><label for="group">Send report:</label></td>
                <td class="col-md-8">
                    <div class="col-md-8">
                        <input checked name="checkbox[1]" type="checkbox" value="mt.account_number" class="">
                    </div>
                    <span class="col-md-4"></span>
                </td>
            </tr>
        </table>

        <button id="update" type="button" class="tab-input-button green-input-button">Update</button> <span id="msg"></span>
        <br>
        <span id="msg1"></span>

        <div class="tab-title-header">
            <h1>Balance Information</h1>
        </div>
        <table class="table personal">
            <tr>
                <td class="col-md-4">
                    <div class="txt-label">Account Number : &nbsp;</div>
                </td>
                <td class="col-md-8">
                    <label><?=$LogIn?></label>
                </td>
            </tr>
            <tr>
                <td class="col-md-4">
                    <div class="txt-label">Balance: &nbsp;</div>
                </td>
                <td class="col-md-8">
                    <label> <?=$Balance?></label>
                </td>
            </tr>
        </table>

        <div class="table-container-border data-center-container">
            <h2></h2>
            <ul style="height: 43px;" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Personal Log</a></li>
                <li><a onclick="allRecordsTab('<?=$LogIn?>')" data-toggle="tab" href="#menu1">All records</a></li>
                <li><a onclick="historyOfTradesTab('<?=$LogIn?>')" data-toggle="tab" href="#menu2">Only trades</a></li>
                <li><a onclick="balanceRecordsTab('<?=$LogIn?>')" data-toggle="tab" href="#menu3">Balance chart</a></li>
                <li><a onclick="balanceRecordsTab('<?=$LogIn?>')" data-toggle="tab" href="#menu4">Balance records</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <?php if($personal_log){?>
                        <div class="table-container-holder table-container-border table-container-margin data-center-container">
                            <div class="tab-title-header">
                                <h1>Personal Information Log</h1>
                            </div>
                            <table cellpadding="0" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Manager</th>
                                    <th>Field</th>
                                    <th>Old value </th>
                                    <th>New value</th>
                                    <th>Comment</th>
                                </tr>
                                <thead>
                                <?php foreach($personal_log as $d){?>
                                    <tr>
                                        <td><?=$d->date_modified?></td>
                                        <td><?=$d->full_name?></td>
                                        <td><?=$d->field?></td>
                                        <td><?=$d->old_value?></td>
                                        <td><?=$d->new_value?></td>
                                        <td><?=$d->date_modified?></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    <?php }else{?>
                        <div class="table-container-holder table-container-border table-container-margin data-center-container">
                            <span style="text-align: center;font-size: 20px;">No logs available.</span>
                        </div>
                    <?php }?>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <?php //$this->load->view('quick_jump/all_record');?>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <?php //$this->load->view('quick_jump/historyOfTrades');?>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <?php //$this->load->view('quick_jump/balance');?>
                </div>
                <div id="menu4" class="tab-pane fade">
                    <?php //$this->load->view('quick_jump/balance');?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function historyOfTradesTab(account_number){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/historyOfTrades')?>";

        if(account_number.length>5){
            $("#loader-holder").show();
            $.post(base_url,{account_number:account_number},function(data){
                $("#menu2").html(data);
                $("#loader-holder").hide();
            })

        }else{
            alert("Account number incorrect!")
        }

    }


    function balanceRecordsTab(account_number){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/balanceRecords')?>";

        if(account_number.length>5){
            $("#loader-holder").show();
            $.post(base_url,{account_number:account_number},function(data){
                $("#menu4").html(data);
                $("#loader-holder").hide();
            })

        }else{
            alert("Account number incorrect!")
        }

    }
    function allRecordsTab(account_number){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/allRecords')?>";
        if(account_number.length>5){
            $("#loader-holder").show();
            $.post(base_url,{account_number:account_number},function(data){

                $("#loader-holder").hide();
                $("#menu1").html(data);
            })
        }else{
            alert("Account number incorrect!")
        }
    }
</script>

<script>
    $(document).on("click","#update",function(){
        $("#loader-holder").show();

        var base_url = "<?php echo FXPP::ajax_url('quick_jump/update_live_account') ?>";
        var account_number = "<?=$LogIn?>";
        var name = $("#full_name").val();
        var email = $("#email").val();
        var phone_number = $("#phone1").val();
        var city = $("#city").val();
        var country = $("#country").val();
        var state   = $("#state").val();
        //var street  = $("#street").val();
        var address = $("#address").val();
        var zip_code = $("#zip").val();
        var leverage =$("#leverage").val();
        var comment = $("#comment").val();

        //var fullname = $("#FullName").val();
        var dob = $("#dob").val();
        var street = $("#StreetAddress").val();

        $.post(base_url,{comment:comment,account_number:account_number,name:name,dob:dob,email:email,phone_number:phone_number,city:city,country:country,state:state,street:street,address:address,zip_code:zip_code,leverage:leverage},function(data){
            $("#msg").html(data.message);

            setTimeout(function(){
                $("#msg").hide();
            },5000);
        });
       // if(name!='' && dob!='' && email!='' && phone_number!='' && city!='' && country!='' && state!=''  && street!='' && zip_code!='' ){
        if(name!='' && dob!='' && email!='' ){
            $.ajax({
                data: {account_number:account_number,
                    name:name,
                    dob:dob,
                    email:email,
                    phone_number:phone_number,
                    city:city,
                    country:country,
                    state:state,
                    street:street,
                    address:address,
                    zip_code:zip_code},
                async: false,
                type: "POST",
                url: '<?=FXPP::ajax_url('quick_jump/update_user_personal_info')?>',
                success: function(response) {
                    if(response.success){
                        console.log('success-user');
                        $("#msg1").html(response.message);
                        setTimeout(function(){
                            $("#msg").hide();
                        },5000);
                    }else{
                        console.log('fail-user');
                        $("#msg1").html(response.message);
                    }
                }
            });
        }else{
            console.log('not entering the shit');
        }
        $("#loader-holder").hide();

    });
</script>

<script type="text/javascript">

    $('#form_accountno').submit(function(event){
        event.preventDefault();
        viewProfile();
    });

    function checkLoginType(lt) {
        var login_type = parseFloat(lt);

        if (login_type === 1) {
            $('#leverage').prop('disabled',true);
            console.log(login_type + ' : partner');
        } else {
            $('#leverage').prop('disabled',false);
            console.log(login_type + ' : client');
        }
    }

    function viewProfiles(){
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/profileView')?>";
        var account_number = $("#search_accounts").val();
        var form_checkboxes = $('#form_accountno').serialize();

        if (account_number.length > 5) {
            $.ajax({
                type: 'POST',
                url: base_url,
                data: form_checkboxes,
                dataType: 'json',
                beforeSend: function () {
                    $("#loader-holder").show();
                },
                success: function (data) {
                    $("#loader-holder").hide();
                    var result = data.success.trim();
                    if (result === 'false') {
                        alert('Account number does not exist.');
                    } else {
                        $(".tab-pane").html(data.data);
                        checkLoginType(data.login_type);
                    }
                }
            });
        }else{
            alert("Please enter a valid account number.");
        }
    }

    $(document).ready(function () {
        $(".datepicker").datepicker({
//            changeMonth: true,
//            changeYear: true,
//            dateFormat:'yy-mm-dd',
//            yearRange: "-95:-18",
//            minDate: '-95Y',
//            maxDate: '-18Y'
        });
    });
</script>