<style>
    .tab-content > .active {
        display: table;
        width:100%;
        background:#fff;
        border: 1px solid #e3e3e3 !important;
    }
    .display-inline{
        display: inline!important;
    }
    .form-credit-prize {
        display: block;
        margin-left: 25%;
        width: 50%;
    }
    .modal-body {
        margin-top: -40px;
    }
    .right-tab-content {
        min-height:849px;
    }
    .main-navigation {
        width: 251px!important;
    }
    .logo-header {
        width: 251px!important;
    }
    .main-container, .footer-container {
        margin-right: 0!important;
    }
</style>
<!--<div class="col-lg-12 col-md-12 col-sm-12 DesignerInline">-->
<!--    <div class="section">-->
<!--        <div class="tab-content acct-cont admin-tab-cont">-->
            <div id="tab1" class="tab-pane active tab-title-header" role="tabpanel">
                <h1 class="all_tab_title">Cancel Funds</h1>
                <div style="margin-left:15%; margin-top: 50px;">
                    <?php
                    $result = $this->session->flashdata("result");
                    if(isset($result)) {
                        if ($result['success']) {
                            ?>
                            <div class="col-lg-10 col-md-10 col-sm-10 alert alert-success text-center " role="alert">
                                <?php echo $result['message'] ?>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="col-lg-10 col-md-10 col-sm-10 alert alert-danger text-center" role="alert">
                                <?php echo $result['message'] ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="col-lg-8 col-md-8 col-sm-8" style="width:50%">

                    <form action="" id="frmCancelPrize" method="post" enctype="multipart/form-data">
                        <div class="input-form-credit-prize">
                            <label>Account Number <b style="color:red"> * </b></label>
                            <?php
                            // test
                            $this->load->library('IPLoc', null);
                            if(IPLoc::Office()){
                                if ($account_number2!=null) {
                                    ?>
                                    <input type="text" placeholder="Press ENTER to search." class="form-control round-0 contrl_num" id="acct_no1" name="account_number" value="<?php echo $account_number2; ?>" required>
                                <?php }else{ ?>
                                    <input type="text" placeholder="Press ENTER to search." class="form-control round-0 contrl_num" id="acct_no1" name="account_number" required>
                                    <!-- Press <span style="font-weight:bold;">ENTER</span> to search. --> 
                                <?php }}else{?>
                                <input type="text" placeholder="Press ENTER to search." class="form-control round-0 contrl_num" id="acct_no1" name="account_number" required>
                            <?php } ?>
                        </div>
                        <div class="input-form-credit-prize">
                            <label>Currency</label>
                            <input type="text" placeholder="" class="form-control round-0 contrl_num" id="currency" name="currency" readonly>
                        </div>
                        <div class="input-form-credit-prize">
                            <label>Sum <b style="color:red"> * </b></label>
                            <input type="text" placeholder="00.00" class="form-control round-0 contrl_num numeric" id="sum" name="sum" required>
                        </div>
                        <div class="input-form-credit-prize">
                            <label>Comment</label>
                            <select class="form-control round-0" id="comment" name="comment">
                                <?php echo $comments_option ?>
                            </select>
                        </div>

                        <div class="input-form-credit-prize dep_option" style="display: none;">
                            <div class="checkbox">
                                <label><input type="checkbox" value="true" name="check" id="check" checked>(Uncheck if Payment system is unnecessary)</label>
                            </div>
                        </div>

                        <?php if(IPLoc::Office()){ ?>
                        <div class="input-form-credit-prize" id="payment" style="display: none">
                            <label>Payment System</label>
                            <select class="form-control round-0" name="payment">
                                <?php echo $payment_option ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="input-form-credit-prize dep_option" style="display: none;">
                            <label>Payment Option</label>
                            <select class="form-control round-0" id="payoption" name="payoption">
                                <?php echo $payoption ?>
                            </select>
                        </div>
                        <div class="input-form-credit-prize">
                            <input type="button" class="btn-credit" id="btnCredit" value="Apply" >
                        </div>
                    </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <form novalidate="novalidate" action="" method="post" enctype="multipart/form-data">
                            <div class="input-form-credit-prize dummy">
                                <label>Account Number</label>
                                <input aria-required="true" placeholder="Account Number" class="form-control round-0 contrl_num" >
                            </div>
                            <div class="input-form-credit-prize dummy">
                                <label>Currency</label>
                                <input placeholder="" class="form-control round-0 contrl_num" readonly="" type="text">
                            </div>
                            <div class="input-form-credit-prize dummy">
                                <label>Transaction id</label>
                                <input aria-required="true" class="form-control round-0 contrl_num numeric" required="" type="text">
                            </div>
                            <div class="input-form-credit-prize">
                                <label class="dummy">Comment</label>
                                <p class="p_alignment"><a href="#" class="showmt4comment" data-toggle="modal" data-target="#creditmodal" >Create new comment</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->






<div class="modal fade" id="modal-credit-prize-alert" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center manage-account-alert-title">Cancel Funds</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <br/><br/>
                    You are about to cancel <span id="alertAmount"></span> funds from account number <span id="alertAccountNumber"></span>.<br/><br/>

                    <span id="alertVerified"></span> Do you want to continue?
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-default round-0 ">No</button>
                    <button type="button" id="btnCreditSend" class="btn btn-default round-0 ">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" id="creditmodal" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg round-0">
            <div class="modal-content round-0">
                <div class="modal-header round-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title my-modal-title">
                        Manage MT4 comment - Cancel Funds
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="section">
                        <div class="tab-content acct-cont admin-tab-cont">
                            <div id="tab1" class="row tab-pane active display-inline" role="tabpanel">
                                <div class="form-credit-prize">
                                    <form action="" id="frmCreditPrize" method="post" enctype="multipart/form-data">
                                        <div class="input-form-credit-prize dummy"  style="    display: none;">
                                            <label>Comment Type</label>
                                            <select name="comment_type" class="form-control round-0">
                                                <option value="0" selected="selected">Cancel Funds </option>
                                            </select>
                                        </div>
                                        <div class="input-form-credit-prize existalert" style="display: none">
                                            <div class="alert alert-warning" id="existalert">

                                            </div>
                                        </div>
                                        <div class="input-form-credit-prize">
                                            <label>Comment</label>
                                            <input type="text" placeholder="" class="form-control round-0 contrl_num" id="commentedit" name="commentedit" />
                                        </div>
                                        <div class="input-form-credit-prize">
                                            <label>API method</label>
                                            <select id="api_method" name="api_method" class="form-control round-0">
                                                <option value="1" selected="selected"> API - FM_CONTEST_MF_CANCELLATION  </option>
                                                <option value="2"> API - FM NO DEPOSIT BONUS CANCELLATION </option>
                                                <option value="3"> API - FM SUPPORTER FULL CANCELLATION </option>
                                                <option value="4"> API - FM SUPPORTER PART CANCELLATION </option>
                                                <option value="5"> API - FM SHOWFX BONUS CANCELLATION </option>
                                                <option value="6"> API - FM BONUS 30% CANCELLATION </option>
<!--                                                <option value="7"> API - DEPOSIT CANCELLATION  </option>-->
<!--                                                <option value="8"> API - REAL_FUND_WITHDRAW  </option>-->
                                                <option value="9"> API - WithdrawRealFund  </option>
                                                <option value="11"> API - FM BONUS 50% CANCELLATION </option>
                                            </select>
                                        </div>
                                        <div class="input-form-credit-prize " style="display: none;">
                                            <label>Payment Option</label>
                                            <select class="form-control round-0" id="payoption" name="payoption">

                                                <option value="NT_">NETELLER</option>
                                                <option value="SK_">SKRILL</option>
                                                <option value="CP_">CARDPAY</option>
                                                <option value="PS_">WEBMONEY</option>
                                                <option value="PX_">PAXUM</option>
                                                <option value="PC_">PAYCO</option>
                                                <option value="PP_">PAYPAL</option>
                                                <option value="qw_">QIWI</option>
                                                <option value="MT_">MEGATRANSFER</option>
                                                <option value="YAN_">YANDEXMONEY</option>
                                                <option value="BITCOIN_">BITCOIN</option>



                                            </select>
                                        </div>
                                        <div class="input-form-credit-prize "  style="display: none;">
                                            <label>Payment Date</label>
                                            <input id="date" name="date" type="text" class="form-control round-0" placeholder="" value="<?php echo DateTime::createFromFormat('Y/d/m',   date('Y/d/m'))->format('m/d/Y') ?>">
                                        </div>
                                        <div class="input-form-credit-prize" name="tid" id="tid" style="display: none;">
                                            <label>Transaction id</label>
                                            <input type="text" placeholder="" class="form-control round-0 " id="transactionid" name="transactionid" >
                                        </div>
                                        <div class="input-form-credit-prize">
                                            <input type="button" class="btn-credit add" id="btnAdd" value="Add" >
                                            <input type="button" class="btn-credit update" id="btnUpdate" value="Update" >
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="mt4_table" class="table table-striped ">
                                    <thead>
                                    <tr>
                                        <th class="fixwidth">MT4 Comment</th>
                                        <th class="fixwidth">Comment Type</th>
                                        <th class="fixwidth">Date Added</th>
                                        <th class="fixwidth">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="request">
                                    <?= $request?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
        <div class="modal-dialog round-0">
            <div class="modal-content round-0">
                <div class="modal-header round-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title modal-show-title">
                        Delete Comment
                    </h4>
                </div>
                <div class="modal-body modal-body1">
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th class="fixwidth">MT4 Comment</th>
                            <th class="fixwidth">Comment Type</th>
                            <th class="fixwidth">Date Added</th>
                        </tr>
                        </thead>
                        <tbody >
                        <tr>
                            <td class="fixwidth" name="c1"></td>
                            <td class="fixwidth" name="c2"></td>
                            <td class="fixwidth" name="c3"> </td>
                        </tr>
                        </tbody >
                    </table>

                    <p class="check-ps">Are you sure you want to delete this MT4 comment?</p>
                    <input type="hidden" name="deleteId" id="deleteId" value=""/>
                </div>

                <div class="modal-footer round-0 popfooter">
                    <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Cancel</button>
                    <?php
                    $data['button_submit']=  array(
                        'name'          => 'delete',
                        'id'            => 'delete',
                        'value'         => 'true',
                        'type'          => 'submit',
                        'class'          => 'btn btn-default round-0 confirm_delete',
                        'content'       => 'Delete'
                    );
                    ?>
                    <?= form_button($data['button_submit']);?>
                </div>
            </div>
        </div>
    </div>


<style type="text/css">
    .my-modal-title{
        text-align: center;
        font-weight: bold;
    }
    .p_alignment{
        margin: 5px 0 0 0px!important;
    }
    .p_alignment a{
        font-size: 15px!important;
    }
    .dummy{
        visibility: hidden;
    }

    .p_alignment{
        margin: 5px 0 0 0px!important;
    }
    .p_alignment a{
        font-size: 15px!important;
    }
    .dummy{
        visibility: hidden;
    }
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
    .cred{
        color: red;
        font-size: 16px;
    }
    .messageid{color: green; text-align: center; float: left; width: 100%; height: 40px; margin-top: 10px;}

    .form-credit-prize {
        display:table;
        margin:40px auto;
    }

    .input-form-credit-prize {
        width:100%;
        margin:20px auto;
        display:table;
    }
    .btn-credit {
        float: right;
        padding: 7px 15px;
        border: none;
        background: #29a643;
        color: #fff;
        font-family: Open Sans;
        transition: all ease 0.3s;
    }
    .error {
        color: red;
    }
    #btnUpdate{
        display:none;
    }
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
    .curp{cursor: pointer}
</style>
<script type="text/javascript">

    var site_url="<?=FXPP::ajax_url('')?>";

    $(window).load(function() {
        $('#loader-holder').hide();
    });

    jQuery(".numeric").on("keypress keyup blur",function (event) {
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

    var table;

    jQuery('#btnCredit').on('click', function(e){
        if($('#frmCancelPrize').valid()) {
            $('#alertAmount').html($('#sum').val() + ' ' + $('#currency').val());
            $('#alertAccountNumber').html($('#acct_no1').val());
            $('#modal-credit-prize-alert').modal('show');
        }else{
            e.preventDefault();
        }

    });

    jQuery('#btnCreditSend').on('click', function(){
        if($('#frmCancelPrize').valid()){
            $('#frmCancelPrize').submit();
        }else{
            $('#modal-credit-prize-alert').modal('hide');
        }
    });


    $('#frmCancelPrize').validate({
        rules:{
            account_number:{ required : true },
            sum:{ required : true }
        }
    });

    //$('#acct_no1').on('blur', function(){
    $('#acct_no1').keypress(function(){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13') {
            $('#currency').val('');
            $.ajax({
                type: 'POST',
                url: site_url+'Credit_funds/get_account_details_v2',
                data: {account_number:$(this).val()},
                dataType: 'json',
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(response){
                    $('#loader-holder').hide();
                    $('#currency').val(response.currency);
                    if(response.verified){
                        $('#alertVerified').html('');
                    }else{
                        $('#alertVerified').html('This account is not verified yet. ');
                    }
                },
                error: function(jqXHR, textStatus){
                    $('#loader-holder').hide();
                }
            });
        }
    });

    $('#comment').on('change', function(){
        if($(this).val() == 8){
            $('#payment').show();
        }else{
            $('#payment').hide();
        }
    });

    $('#check').on('click', function(){
        var atLeastOneIsChecked =  $('input[name="check"]:checked').length > 0;
        if (atLeastOneIsChecked){
            $('#payoption').removeAttr('disabled');
        }else{
            $('#payoption').attr('disabled', 'disabled');

        }
    });

</script>


<script type="application/javascript">
    $.fn.dataTable.moment( 'YYYY-mm-dd HH:mm:ss' );
    var payment_transaction = '';
    var pblc = [];
    pblc['request'] = null;
    if(pblc['request'] != null) pblc['request'].abort();
    var site_url="<?=site_url('')?>";

    $(document).ready(function() {

        var getAPImethod= $('select#comment').find(':selected').data('apimethod').toString();

        switch (getAPImethod){
            case '9':
                $(".dep_option").css('display','block');
                $("#check").prop('checked', true);
                $("#check").attr("checked","checked");
                break;
            default:
                $(".dep_option").css('display','none');
        }

        $('#date').datepicker();

        $('#mt4_table').DataTable({
            "order": [[ 2, "desc" ]],
//            stateSave: true,
            "columnDefs": [
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 3 },
            ],
        });

        $('select[name=comment_type]').on('change', function() {
            $('#loader-holder').show();
            var prvt = [];
            prvt["data"] = {
                type:this.value
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url+"query/get_mt4comment",
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                var table = $('#mt4_table').DataTable();
                table.destroy();
                $('#request').html(data.request);

                $('#mt4_table').DataTable({
                        "order": [[ 2, "desc" ]],
//                        stateSave: true,
                        "columnDefs": [
                            { "orderable": false, "targets": 0 },
                            { "orderable": false, "targets": 3 },
                        ],
                    }
                );

                $('#loader-holder').hide();
                $('input[name=commentedit]').val('');
            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });
        });
    });

    $(document).on("click", ".update", function () {

        var selectedsymbol=$('select#comment').val();
        $('#btnUpdate').css('display','none');
        $('#btnAdd').css('display','block');
        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            id:$('#btnUpdate').data('id'),
            type:$('#btnUpdate').data('type'),
            comment: $('input[name=commentedit]').val(),
            api_method:$('select[name=api_method]').val(),
            api_comment:$("#api_method option:selected").text(),
            transactionid:$('input[name=transactionid]').val(),
            payment_option:$('select[name=payoption]').val(),
            payment_date:$('input[name=date]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"query/edit_update",
            method: 'POST',
            data: prvt["data"]
        });
        pblc['request'].done(function( data ) {
            if(data.exist==false){
                var table = $('#mt4_table').DataTable();
                table.destroy();
                $('#request').html(data.request);
                $('#mt4_table').DataTable({
                        "order": [[ 2, "desc" ]],
                        "columnDefs": [
                            { "orderable": false, "targets": 0 },
                            { "orderable": false, "targets": 3 },
                        ],
                    }
                );

                $('select#comment').empty().append(data.comments_option);
                $('select#comment').val(selectedsymbol);


                $('input[name=transactionid]').val('');
                $('input[name=commentedit]').val('');
                $('.existalert').css('display','none');
            }else{

                $('#existalert').text('This comment already exists.');
                $('.existalert').css('display','block');
            }

            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });
    });

    $(document).on("click", ".showmt4comment", function () {
        $('#btnUpdate').css('display','none');
        $('#btnAdd').css('display','block');
        $('input#commentedit').val('');
        $('.existalert').css('display','none');
    });
    $(document).on("click", ".edit", function () {
        $('input#commentedit').val('');
        $('#loader-holder').show();
        $('#btnUpdate').data('id',$(this).data('id'));
        $('#btnUpdate').data('type',$(this).data('type'));
        $('#btnUpdate').css('display','block');
        $('#btnAdd').css('display','none');
        $('input[name=commentedit]').val($(this).data('comment'));
        $("#api_method").val($(this).data('api'));
        $('#payoption').val($(this).data('poption'));
        $('input[name=date]').val($(this).data('pdate'));
        $('input[name=transactionid]').val($(this).data('trid'));

//        switch ($('select[name=api_method]').val()){
//            case '9':
//                $(".dep_option").css('display','block');
//                $('input#commentedit').val('W/D'+$("#payoption option:selected").val()+$("#transactionid").val());
//                break;
//            default:
//                $(".dep_option").css('display','none');
//
//        }

        document.body.scrollTop = document.documentElement.scrollTop = 0;
        $('#loader-holder').hide();

    });

    $(document).on("click", ".confirm_delete", function () {
        var selectedsymbol=$('select#comment').val();

        var id = $('input[name=deleteId]').data('id');
        var type = $('input[name=deleteId]').data('type');
        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            id:id,
            type:type
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"query/delete_mt4comment",
            method: 'POST',
            data: prvt["data"]
        });
        pblc['request'].done(function( data ) {
            var table = $('#mt4_table').DataTable();
            table.destroy();
            $('#request').html(data.request);

            $('#mt4_table').DataTable({
                    "order": [[ 2, "desc" ]],
//                    stateSave: true,
                    "columnDefs": [
                        { "orderable": false, "targets": 0 },
                        { "orderable": false, "targets": 3 },
                    ],
                }
            );
            $('select#comment').empty().append(data.comments_option);

            $('input[name=commentedit]').val('');
            $('#delete').modal('hide');
            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
            $('#delete').modal('hide');
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
            $('#delete').modal('hide');
        });

    });



    $(document).on("click", ".add", function () {
        var comment = $('input[name=commentedit]').val();
        comment=comment.trim();
        if(comment!=""){
            var selectedsymbol=$('select#comment').val();

            $('#loader-holder').show();
            var prvt = [];
            prvt["data"] = {
                type: $('select[name=comment_type]').val(),
                comment:$('input[name=commentedit]').val(),
                api_method:$('select[name=api_method]').val(),
                api_comment:$("#api_method option:selected").text(),
                transactionid:$('input[name=transactionid]').val(),
                payment_option:$('select[name=payoption]').val(),
                payment_date:$('input[name=date]').val()
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url: site_url+"query/add_mt4comment",
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                if(data.exist==false){
                    var table = $('#mt4_table').DataTable();
                    table.destroy();
                    $('#request').html(data.request);

                    $('#mt4_table').DataTable({
                            "order": [[ 2, "desc" ]],
                            "columnDefs": [
                                { "orderable": false, "targets": 0 },
                                { "orderable": false, "targets": 3 },
                            ],
                        }
                    );

                    $('select#comment').empty().append(data.comments_option);
                    $('select#comment').val(selectedsymbol);

                    $('input[name=transactionid]').val('');
                    $('input[name=commentedit]').val('');
                    $('.existalert').css('display','none');
                }else{

                    $('#existalert').text('This comment already exists.');
                    $('.existalert').css('display','block');
                }

                $('#loader-holder').hide();
            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });
        }else{
            if(comment=="" ) {
                $('input[name=commentedit]').css('border', '1px solid red');
                $('input[name=commentedit]').attr("data-original-title", "Enter Comment.");
            }

        }


    });

    $(document).on("click", ".push_delete", function () {
        $('td[name=c1]').html($(this).data('commenttype'));
        $('td[name=c2]').html($(this).data('comment'));
        $('td[name=c3]').html($(this).data('date'));
        $('input[name=deleteId]').data('id',$(this).data('id'));
        $('input[name=deleteId]').data('type',$(this).data('type'));
    });

    $('#api_method').on('change', function (e) {

    });
    $('#payoption').on('change', function (e) {

    });

    $("input#transactionid").on("change paste keyup", function() {

    });
    $('#comment').on('change', function (e) {
        var getAPImethod= $('select#comment').find(':selected').data('apimethod').toString();
        switch (getAPImethod){
            case '9':
                $(".dep_option").css('display','block');
                $("#check").prop('checked', true);
                $("#check").attr("checked","checked");
                break;
            default:
                $(".dep_option").css('display','none');
        }
    });
    function pre_def(){
        return false;
    }
</script>