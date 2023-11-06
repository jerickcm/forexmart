<style>
    .tab-content > .active {
        /*display: inline;*/
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
        /* background: red; */
        margin-left: 25%;
        width: 50%;
    }
    .modal-body {
        margin-top: -30px;
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

    .form-control{
        width: 70%;
    }

    #div_comment{
        width: 50%!important;
    }

    #div_new_comment{
        width: 50%!important;
        margin-top: 10px;
    }

    #creditbutton{
        margin-left: -29%!important;
    }

    #comment{
        width: 100%;
    }
</style>

<!--<div class="col-lg-10 col-md-10 col-sm-10 DesignerInline">-->
<!--    <div class="section">-->
<!--        <div class="tab-content acct-cont admin-tab-cont">-->
<div id="tab1" class="tab-pane active tab-title-header" role="tabpanel">
    <h1 class="all_tab_title">Credit Funds</h1>
    <div style="margin-left:15%; margin-top: 50px;">
        <?php
        $result = $this->session->flashdata("result");
        if(isset($result)) {
            if ($result['success']) {
                ?>
                <div class="col-lg-10 col-md-10 col-sm-10 alert alert-success text-center" role="alert">
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
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <form action="" id="frmCreditPrize" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-form-credit-prize col-lg-8 col-md-8 col-sm-8">
                            <label class="lbl">Account Number <b style="color:red"> * </b></label>
                            <?php
                            // test
                            $this->load->library('IPLoc', null);
                            if(IPLoc::Office()){
                                if ($account_number2!=null) {
                                    ?>
                                    <input type="text" placeholder="Press ENTER to search." class="form-control round-0 contrl_num" id="acct_no" name="account_number" value="<?php echo $account_number2; ?>" required>
                                <?php }else{ ?>
                                    <input type="text" placeholder="Press ENTER to search." class="form-control round-0 contrl_num" id="acct_no" name="account_number" required>
                                    <!-- Press <span style="font-weight:bold;">ENTER</span> to search. --> 
                                <?php }}else{?>
                                <input type="text" placeholder="Press ENTER to search." class="form-control round-0 contrl_num" id="acct_no" name="account_number" required>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize col-lg-8 col-md-8 col-sm-8">
                            <label class="lbl">Currency</label>
                            <input type="text" placeholder="" class="form-control round-0 contrl_num" id="currency" name="currency" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize col-lg-8 col-md-8 col-sm-8">
                            <label class="lbl">Sum <b style="color:red"> * </b></label>
                            <input type="text" placeholder="00.00" class="form-control round-0 contrl_num numeric" id="sum" name="sum" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prizecol-lg-8 col-md-8 col-sm-8" id="div_comment">
                            <label class="lbl">Comment</label>
                            <select class="form-control round-0" id="comment" name="comment">
                                <?php echo $comments_option ?>
                            </select>
                        </div>
                        <div class="input-form-credit-prize col-lg-4 col-md-4 col-sm-4" id="div_new_comment">
                            <label class="dummy">Comment</label>
                            <p class="p_alignment"><a href="#" class="showmt4comment" data-toggle="modal" data-target="#creditmodal" >Create new comment</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize dep_option2 col-lg-8 col-md-8 col-sm-8" style="display: none;">
                            <div class="checkbox">
                                <label><input type="checkbox" value="true" name="check" id="check" style="float: left!important;" checked>  (Uncheck if Payment system is unnecessary)</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize dep_option2 d1 col-lg-8 col-md-8 col-sm-8" style="display: none;">
                            <label class="lbl">Payment Option</label>
                            <select class="form-control round-0" id="payoption2" name="payoption2">
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
                                <option value="BITCOIN">BITCOIN</option>
                                <option value="WIRE_TRANSFER_SL_">MegaTransfer SiauLiu</option>
                                <option value="WIRE_TRANSFER_SP_">MegaTransfer Sparkasse</option>
                                <option value="WIRE_TRANSFER_PC_">Piraeus Cyprus </option>
                                <option value="WIRE_TRANSFER_BOC_">Bank of Cyprus</option>
                                <option value="WIRE_TRANSFER_EC_">Eurobank Cyprus</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize dep_option2 d1 col-lg-8 col-md-8 col-sm-8"  style="display: none;">
                            <label class="lbl">Payment Date</label>
                            <input id="dateF" name="dateF" type="text" class="form-control round-0" placeholder="" value="<?php echo DateTime::createFromFormat('Y/d/m',   date('Y/d/m'))->format('m/d/Y') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize dep_option2 d1 col-lg-8 col-md-8 col-sm-8" name="tidF" id="tidF" style="display: none;">
                            <label class="lbl">Transaction id</label>
                            <input type="text" placeholder="" class="form-control round-0 " id="transactionidF" name="transactionidF" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize dep_option2 d1 col-lg-8 col-md-8 col-sm-8" name="TC" id="TC" style="display: none;">
                            <label class="lbl">Transaction Comment</label>
                            <input type="text" placeholder="" class="form-control round-0 " id="TC" name="TC" readonly="readonly"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-form-credit-prize col-lg-8 col-md-8 col-sm-8" id="creditbutton">
                            <input type="button" class="btn-credit" id="btnCredit" value="Credit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
        </form>
        <!--<div class="col-lg-4 col-md-4 col-sm-4">
            <form novalidate="novalidate" action="" method="post" enctype="multipart/form-data">
                <div class="input-form-credit-prize dummy">
                    <label class="lbl">Account Number</label>
                    <input aria-required="true" placeholder="Account Number" class="form-control round-0 contrl_num" >
                </div>
                <div class="input-form-credit-prize dummy">
                    <label class="lbl">Currency</label>
                    <input placeholder="" class="form-control round-0 contrl_num" readonly="" type="text">
                </div>
                <div class="input-form-credit-prize dummy">
                    <label class="lbl">Transaction id</label>
                    <input aria-required="true" class="form-control round-0 contrl_num numeric" required="" type="text">
                </div>
                <div class="input-form-credit-prize">
                    <label class="dummy">Comment</label>
                    <p class="p_alignment"><a href="#" class="showmt4comment" data-toggle="modal" data-target="#creditmodal" >Create new comment</a></p>
                </div>
            </form>
        </div>-->
    </div>
</div>
<!--        </div>--><!--END        <div class="tab-content acct-cont admin-tab-cont">-->
<!--    </div>--><!--END    <div class="section">-->
<!--</div>--><!--END<div class="col-lg-10 col-md-10 col-sm-10 DesignerInline">-->

<!--MODALS-->
<div class="modal fade" id="modal-credit-prize-alert" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center manage-account-alert-title">Credit Funds</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <br/><br/>
                    You are about to credit <span id="alertAmount"></span> bonus funds to account number <span id="alertAccountNumber"></span>.<br/><br/>
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
                    Manage MT4 comment - Credit Funds
                </h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="tab-content acct-cont admin-tab-cont">
                        <div id="tab1" class="row tab-pane active display-inline" role="tabpanel">
                            <div class="form-credit-prize">
                                <form action="" id="frmCreditPrize2" method="post" enctype="multipart/form-data">
                                    <div class="input-form-credit-prize dummy" style="display: none;">
                                        <label>Comment Type</label>
                                        <select name="comment_type" class="form-control round-0">
                                            <option value="1" selected="selected"> Credit Funds </option>
                                        </select>
                                    </div>
                                    <div class="input-form-credit-prize existalert" style="display: none">
                                        <div class="alert alert-warning" id="existalert">

                                        </div>
                                    </div>
                                    <div class="input-form-credit-prize">
                                        <label>Comment</label>
                                        <input required type="text" placeholder="" class="form-control round-0 contrl_num" id="commentedit" name="commentedit" />
                                    </div>
                                    <div class="input-form-credit-prize">
                                        <label>API method</label>
                                        <select id="api_method" name="api_method" class="form-control round-0">
                                            <option value="1" selected="selected"> API - FOREXMART CONTEST  </option>
                                            <option value="2"> API - FOREXMART NO DEPOSIT BONUS </option>
                                            <option value="3"> API - SUPPORTER FULL </option>
                                            <option value="4"> API - SUPPORTER PART </option>
                                            <option value="5"> API - SHOWFX BONUS </option>
                                            <option value="6"> API - WELCOME BONUS 30% </option>
                                            <!--                                            <option value="7"> API - DepositRealFund  </option>-->
                                            <option value="8"> API - DepositRealFund  </option>
                                            <option value="11"> API - DEPOSIT 50% BONUS  </option>
                                        </select>
                                    </div>
                                    <div class="input-form-credit-prize dep_option" style="display: none;">
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
                                    <div class="input-form-credit-prize dep_option"  style="display: none;">
                                        <label>Payment Date</label>
                                        <input id="date" name="date" type="text" class="form-control round-0" placeholder="" value="<?php echo DateTime::createFromFormat('Y/d/m',   date('Y/d/m'))->format('m/d/Y') ?>">
                                    </div>
                                    <div class="input-form-credit-prize dep_option" name="tid" id="tid" style="display: none;">
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
                            <table id="mt4_table" class="">
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
        margin: -5px 0 0 0px!important;
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
        margin:6px auto;
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
        margin-top: 5px;
    }
    .error {
        color: red;
    }

    /**/
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
    $.fn.dataTable.moment( 'YYYY-mm-dd HH:mm:ss' );
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
        if($('#frmCreditPrize').valid()) {
            $('#alertAmount').html($('#sum').val() + ' ' + $('#currency').val());
            $('#alertAccountNumber').html($('#acct_no').val());
            $('#modal-credit-prize-alert').modal('show');
        }else{
            e.preventDefault();
        }

    });

    jQuery('#btnCreditSend').on('click', function(){
        if($('#frmCreditPrize').valid()){
            $('#frmCreditPrize').submit();
        }else{
            $('#modal-credit-prize-alert').modal('hide');
        }
    });


    $('#frmCreditPrize').validate({
        rules:{
            account_number:{ required : true },
            sum:{ required : true }
        }
    });

    //$('#acct_no').on('blur', function(){
    $('#acct_no').keypress(function(){
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

    $('#commentedit').on('change', function (e) {
        switch($("#comment option:selected").data('apimethod')){
            case 7:
                $(".dep_option").css('display','block');
                break;
            default:
                $(".dep_option").css('display','none');
        }
    });

</script>

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
        <script src="<?= $this->template->Js()?>jquery-ui.js" ></script>

<script type="application/javascript">
    var payment_transaction = '';
    var pblc = [];
    pblc['request'] = null;
    if(pblc['request'] != null) pblc['request'].abort();
    var site_url="<?=site_url('')?>";

    var table;
    $(document).ready(function() {

        var getAPImethod= $('select#comment').find(':selected').data('apimethod').toString();
        switch (getAPImethod){
            case '8':
                $(".dep_option2").css('display','block');
                $("#check").prop('checked', true);
                $("#check").attr("checked","checked");
                break;
            default:
                $(".dep_option2").css('display','none');
        }


        $('#date').datepicker();
        $('#dateF').datepicker();

        table = $('#mt4_table').DataTable();
        $('#mt4_table').DataTable({
            "order": [[ 2, "desc" ]],
//            stateSave: true,
            "columnDefs": [
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 3 }
            ]
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
                //var table = $('#mt4_table').DataTable();
                var table =  $('#mt4_table').DataTable({
                        "order": [[ 2, "desc" ]],
//                        stateSave: true,
                        "columnDefs": [
                            { "orderable": false, "targets": 0 },
                            { "orderable": false, "targets": 3 },
                        ],
                    }
                );
                table.destroy();
                $('#request').html(data.request);

//                $('#mt4_table').DataTable({
//                        "order": [[ 2, "desc" ]],
////                        stateSave: true,
//                        "columnDefs": [
//                            { "orderable": false, "targets": 0 },
//                            { "orderable": false, "targets": 3 },
//                        ],
//                    }
//                );

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

        $('#btnUpdate').css('display','none');
        $('#btnAdd').css('display','block');
        $('#loader-holder').show();

        var selectedsymbol=$('select#comment').val();

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
                $('#loader-holder').hide();
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
        switch ($('select[name=api_method]').val()){
            case '7':
                $(".dep_option").css('display','block');
                $('input#commentedit').val($("#comment option:selected").val() +'_'+$("#payoption option:selected").val()+$("#transactionid").val());

                break;
            default:
                $(".dep_option").css('display','none');

        }
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
            $('#delete').modal('hide');
            $('#loader-holder').hide();

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

            $('#loader-holder').show();
            var selectedsymbol=$('select#comment').val();
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
                    $('#loader-holder').hide();
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
        switch ($('select[name=api_method]').val()){
            case '7':
                $(".dep_option").css('display','block');
                $('input#commentedit').val($("#comment option:selected").text() +'_'+$("#payoption option:selected").val() + $("#transactionid").val() );
                break;
            default:
                $(".dep_option").css('display','none');
//                $('input#commentedit').val('');
        }
    });
    $('#payoption').on('change', function (e) {
        $('input#commentedit').val($("#comment option:selected").text() +'_'+$("#payoption option:selected").val() + $("#transactionid").val() );
    });

    $("input#transactionid").on("change paste keyup", function() {
        $('input#commentedit').val($("#comment option:selected").text()+'_'+$("#payoption option:selected").val() + $("#transactionid").val() );
    });


    $('select[name=comment]').on('change', function() {
        var getAPImethod= $('select#comment').find(':selected').data('apimethod').toString();
        switch (getAPImethod){
            case '8':
                $(".dep_option2").css('display','block');
                $("#check").prop('checked', true);
                $("#check").attr("checked","checked");
                break;
            default:
                $(".dep_option2").css('display','none');
        }
    });
    $('#payoption2').on('change', function (e) {
        $('input#TC').val($("#comment option:selected").text()+'_'+$("#payoption2 option:selected").val() + $("#transactionidF").val() );
    });
    $("input#transactionidF").on("change paste keyup", function() {
        $('input#TC').val($("#comment option:selected").text()+'_'+$("#payoption2 option:selected").val() + $("#transactionidF").val() );
    });
    function pre_def(){
        return false;
    }

</script>

<script type="text/javascript">
    $( document ).ready( function () {
        $('#frmCreditPrize2').validate({ // initialize the plugin
            rules: {
                commentedit: {
                    required: true,

                },
            },
            messages: {
                commentedit:{
                    required: "Please enter a Comment.",
                },
            },
            submitHandler: function (form) {

                return true;
            }
        });
    });

    $('#check').on('click', function(){
        var atLeastOneIsChecked =  $('input[name="check"]:checked').length > 0;
        if (atLeastOneIsChecked){
            $('.d1').css('display','block');

        }else{
            $('.d1').css('display','none');
        }
    });

</script>