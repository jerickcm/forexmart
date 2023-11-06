<style>
    .DesignerInline{
        border-left: 1px solid #ccc;
    }
    .cancel-holder .cancel-compose {
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 10px 50px;
        border: medium none;
        transition: all 0.3s ease 0s;

        display: none;
    }
</style>

<?=$sidebar;?>
<div class="col-lg-9 col-md-9 col-sm-9 DesignerInline">
    <div class="section">
        <div class="table-responsive mail-tab-holder">
            <table id="accounts_table" class="table table-striped">
                <thead>

                <tr>
                    <th>Account Number</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Date Registered</th>
                    <th>Partner Type</th>
                    <th>Country</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <?php /* foreach( $accounts as $key => $value ){ ?>
                    <tr>
                        <td><?php echo $value['account_number'] ?></td>
                        <td><?php echo $value['full_name'] ?></td>
                        <td><?php echo strtotime($value['date_registered']) ? date('m/d/Y H:i:s', strtotime($value['date_registered'])) : '' ?></td>
                        <td><?php echo array_key_exists($value['account_type'], $account_types) ? $account_types[$value['account_type']] : '' ?></td>
                        <td><?php echo $value['currency'] ?></td>
                        <td><a href="javascript:void(0)" id="account_edit" data-id="'.$data['Id'].'" class="open-edit" ><i class="fa fa-pencil action"></i></a></td>
                    </tr>
                <?php } */?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
echo $modal_manage_affiliates;
echo $this->load->ext_view('modal', 'account_update_history', '', TRUE);
echo $this->load->ext_view('modal', 'account_field_update_history', '', TRUE);
echo $this->load->ext_view('modal', 'manage_account_alert', '', TRUE);
?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css"/>
<script>
    var site_url="<?=FXPP::loc_url('')?>";
    var tblAccountUpdateHistory = $('#tblAccountUpdateHistory').DataTable();
    var tblAccountFieldUpdateHistory = $('#tblAccountFieldUpdateHistory').DataTable();

    jQuery('#accounts_table').on('preXhr.dt', function ( e, settings, data ) {
        jQuery('#loader-holder').show();
    }).on('xhr.dt', function ( e, settings, json, xhr ) {
        jQuery('#loader-holder').hide();
    }).DataTable({
        "processing": false,
        "serverSide": true,
        "bFilter": false,
        "bSort": false,
        "ajax": {
            "url": site_url+"administration/update_affiliates",
            "type": "POST"
        }
    });

    jQuery(document).on('click', '.open-edit', function(){
        var id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'POST',
            url: site_url+'administration/get_affiliate_details',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(x) {
                if(x.success){
                    jQuery('#modalAccountNumber').html(x.account_number);
                    jQuery('#accountNumber').val(x.account_number);
                    jQuery('#accountID').val(id);
                    jQuery("#ulwebname").html('');
                    for (var account in x.account_data) {
                        jQuery('[name=' + account + ']').val(x.account_data[account]);
                    }

                    jQuery('#message').text(x.account_data['message']);
                    if(x.account_data['websites'].length > 0){
                        for(var website in x.account_data['websites']){
                            if(website > 0) {
                                var website_html = '<li><div class="input-group"><input type="text" placeholder="Website" class="form-control round-0" name="websites[]" value="' + x.account_data['websites'][website] + '"/><div class="input-group-addon round-0"><a id="removeWebsite"><i class="fa fa-minus"></i></a></div></div></li>';
                            }else{
                                var website_html = '<li><div class="input-group"><input type="text" placeholder="Website" class="form-control round-0" name="websites[]" value="' + x.account_data['websites'][website] + '"/><div class="input-group-addon round-0"><a id="addWebsite"><i class="fa fa-plus"></i></a></div></div></li>';
                            }
                            jQuery("#ulwebname").append(website_html);
                        }
                    }else{
                        var website_html = '<li><div class="input-group"><input type="text" placeholder="Website" class="form-control round-0" name="websites[]" value=""/><div class="input-group-addon round-0"><a id="addWebsite"><i class="fa fa-plus"></i></a></div></li>';
                        jQuery("#ulwebname").append(website_html);
                    }

                    jQuery('#modal-manage-affiliates').modal('show');
                }
                $('#loader-holder').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#loader-holder').hide();
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    jQuery(document).on('click', '#btnAffiliateSaveChanges', function(){
        jQuery.ajax({
            type: 'POST',
            url: site_url+'administration/update_affiliate_account',
            dataType: 'json',
            data: new FormData($('#affiliateDetails')[0]),
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(x) {
                if(x.success){
                    $('#modal-manage-affiliates').modal('hide');
                    $('.manage-account-alert-title').html('Manage Accounts');
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
    });

    jQuery(document).on('click', '.open-update-history', function(){
        var id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'POST',
            url: site_url+'administration/get_account_update_history',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(data) {
                tblAccountUpdateHistory.destroy();
                $('#tblAccountUpdateHistoryRows').html(data.update_history_data);
                tblAccountUpdateHistory = $('#tblAccountUpdateHistory').DataTable({
                    "bSort": false,
                    "ordering": false,
                    "info":     false,
                    dom: 'rtp<"clear">'
                });
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

    jQuery(document).on('click', '.open-update-view', function(){
        var id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'POST',
            url: site_url+'administration/get_account_field_update_history',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(data) {
                tblAccountFieldUpdateHistory.destroy();
                $('#accountFieldUpdateHistory .manager-name').html(data.manager_name);
                $('#tblAccountFieldUpdateHistoryRows').html(data.update_field_history_data);
                tblAccountFieldUpdateHistory = $('#tblAccountFieldUpdateHistory').DataTable({
                    "bSort": false,
                    "ordering": false,
                    "info":     false,
                    dom: 'rtp<"clear">'
                });
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
