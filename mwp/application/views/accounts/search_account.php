<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<style>
    .txt-label{
        text-transform: capitalize;
    }
    #table_wrapper{
        display: none;
    }
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
    .dataTables_wrapper:after{
        clear: none;
    }
    #personal_info_wrapper{
        clear: right;
    }
    .personal .txt-label{text-align: right; float: left; width: 120px;margin-left: 0px}
    .personal label input{float: left;}
    .personal label{text-align: left!important; float: left; width: 200px;}
    #msg{ color: #008000;}
    select{width: 172px;}
    .checkbox label {font-size: 14px; font-weight: 600;}
</style>

<div id="loader-holder" class="loader-holder" style="display: hidden;">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<!-- START ACCOUNT TABS -->
<div class="tab-pane active" id="search-account">
    <form action="" method="post" id="form_accountno">
        <div class="tab-title-header">
            <h1 class="all_tab_title">Search for account</h1>
            <div class="tab-search-bar">
                <input name="search" id="search_accounts" type="text" value="<?php echo set_value('search');?>"class="tab-input-form" placeholder="Type here..."/>
                <button type="submit" class="tab-input-button green-input-button go-button">Go</button>
            </div>
        </div>
        <div  class="table-container-holder table-container-margin table-container-data">
        <table cellpadding="0" cellspacing="0" id="searchAttr">
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input id="fullname" name="checkbox[2]" type="checkbox" <?=set_value('checkbox[2]')=="p.full_name"?"checked":"";?>  value="p.full_name" class="tab-checkbox"/> <span class="required">*</span> Full Name
                        </label>
                    </div>
                </td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input  id="email" name="checkbox[1]" type="checkbox" <?=set_value('checkbox[1]')=="u.email"?"checked":"";?>  value="u.email" class="tab-checkbox"/> <span class="required">*</span> Email
                        </label>
                    </div>
                </td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input id="streeta" name="checkbox[3]" type="checkbox" <?=set_value('checkbox[3]')=="p.street"?"checked":"";?>  value="p.street" class="tab-checkbox"/> <span class="required">*</span> Street Address
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input name="checkbox[4]" type="checkbox" <?=set_value('checkbox[4]')=="p.city"?"checked":"";?> value="p.city" class="tab-checkbox"/> <span class="required">*</span> City
                        </label>
                    </div>
                </td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input name="checkbox[5]" type="checkbox" <?=set_value('checkbox[5]')=="p.state"?"checked":"";?>  value="p.state" type="checkbox" class="tab-checkbox"/> <span class="required">*</span> State/Province
                        </label>
                    </div>
                </td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input name="checkbox[6]" type="checkbox" <?=set_value('checkbox[6]')=="p.country"?"checked":"";?>  value="p.country" class="tab-checkbox"/> <span class="required">*</span> Country
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input name="checkbox[7]" type="checkbox" <?=set_value('checkbox[7]')=="p.zip"?"checked":"";?>  value="p.zip" class="tab-checkbox"/> <span class="required">*</span> Postal/Zip Code
                        </label>
                    </div>
                </td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input  name="checkbox[8]" type="checkbox" <?=set_value('checkbox[8]')=="c.phone1"?"checked":"";?>  value="c.phone1" class="tab-checkbox"/> <span class="required">*</span> Phone Number
                        </label>
                    </div>
                </td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input id="dob" name="checkbox[9]" type="checkbox" <?=set_value('checkbox[9]')=="p.dob"?"checked":"";?> value="p.dob" class="tab-checkbox"/> <span class="required">*</span> Date of Birth
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input id="all" rel="col14" type="checkbox" class="tab-checkbox"/> All
                        </label>
                    </div>
                </td>
                <td>
                   <!-- <input readonly style="display: none" checked name="checkbox[10]" type="checkbox" <?/*=set_value('checkbox[10]')=="mt.account_number"?"checked":"";*/?> value="mt.account_number" class="tab-checkbox"/>
                    <label style="display: none"><span class="required">*</span> Account Number</label>-->
                </td>
                <td></td>
            </tr>
        </table>
        </div>
    </form>

    <div  class="table-container-holder table-container-border table-container-margin data-center-container">
    <?php if($user_documents['result']){
        echo '<style> #table_wrapper{ display:block !important; } </style>';
        echo '<div class="tab-title-header"><h1>Personal Information</h1></div>';
    }
    ?>
    <table cellpadding="0" cellspacing="0" class="personal" id="personal">

            <?php
                    if($user_documents) {

                        $counter = 1;
                    foreach ( $user_documents['result'] as $key => $value) {

                   // $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);
                        //echo "<tr>";
                        foreach($user_documents['column'] as $key1 => $d){
                            //print_r(key($d));

                            if($d == "account_number"){
                                    if(strlen($value->account_number)>1){
                                         echo "<td><div class='txt-label'>".$d.":&nbsp;&nbsp;</div><label> <a id='account_no' data-accountno='".$value->account_number."' data-href='".site_url('quick_jump/profile').'?ac='.$value->account_number."'>".$value->account_number."</a></label></td>";
                                     }else{
                                         echo "<td> <div class='txt-label'>".$d.":&nbsp;&nbsp;</div><label><a id='account_no' data-accountno='".$value->reference_num."' data-href='".site_url('quick_jump/profile').'?ac='.$value->reference_num."'>".$value->reference_num."</a></label></td>";
                                     }

                                 }elseif($d == "reference_num"){

                                 }else{
                                     echo "<td><div class='txt-label'>".($d == "dob" ? "Date of Birth" : ($d == "phone1" ? "Phone Number" : $d)).":&nbsp;&nbsp;</div><label>".$value->$d."</label></td>";
                                 }
                                 if($counter % 3 == 0){
                                    echo '<tr></tr>';
                                 }
                                $counter++;
                            }
                        //echo '</tr>';
                        
                    }
                    }
                    echo $request;
            ?>

        </table>
    <?php if($user_documents['result']){
        echo '<a id="update-button"><button class="tab-input-button green-input-button">Update</button></a>';
    }
    ?>

</div>
<div id="personal_info_wrapper"></div>
</div>

<div style="clear: both"></div>

<!-- END ACCOUNT TABS -->

<script>
    $("#table").DataTable({
        "bLengthChange": false
    });
    $("#all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('.txt-label').each(function(){
            var label = $(this).html();
            str = label.replace('_',' ');
            if(label == "dob"){
                $(this).html('Date of Birth')
            }else{
                $(this).html(str);
            }
            
        });
        var acc = jQuery('#account_no').data('href');
        $('#update-button').attr('href',acc);
        
    });
</script>

<script type="text/javascript">
    $('#form_accountno').submit(function(event){
        event.preventDefault();
        viewProfile();
    });

    function viewProfile(){
       var base_url = "<?php echo FXPP::ajax_url('quick_jump/profileView')?>";
       var account_number = $("#search_accounts").val();

       if (account_number.length > 5) {
           var total_checked = $('input[type="checkbox"]:checked').length;
           var form_checkboxes = $('#form_accountno').serialize();

           if (total_checked) {
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
           } else {
               alert('Please select at least 1 checkbox.');
           }
       }else{
           alert("Please enter a valid account number1.");
       }
   }

    function checkLoginType(lt) {
        var login_type = parseFloat(lt);

        if (login_type === 1) {
            $('#leverage').prop('disabled',true);
        } else {
            $('#leverage').prop('disabled',false);
        }
    }
</script>


