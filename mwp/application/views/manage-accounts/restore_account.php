<?=$sidebar;?>
<div class="col-lg-10 col-md-10 col-sm-10 DesignerInline">
    <div class="section">
        <div class="tab-content acct-cont admin-tab-cont">
            <div id="tab1" class="row tab-pane active" role="tabpanel">
                <div style="margin-left:15%">
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
                    <div class="col-lg-8 col-md-8 col-sm-8" style="width:50%">
                        <form action="" id="frmCreditPrize" method="post" enctype="multipart/form-data">
                            <div class="input-form-credit-prize">
                                <label>Account Number <b style="color:red"> * </b></label>
                                <input type="text" placeholder="Account Number" class="form-control round-0 contrl_num" id="account_number" name="account_number" required>
                            </div>
                            <div class="input-form-credit-prize">
                                <a href="javascript:void(0)"  class="btn-credit" id="btnRestore">Restore</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-credit-prize-alert" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center manage-account-alert-title">Manage Accounts</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
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

<?= $this->load->ext_view('modal', 'av_report', '', TRUE); ?>

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
        if($('#frmCreditPrize').valid()) {a
            $('#alertAmount').html('10' + ' ' + $('#currency').val());
            $('#alertAccountNumber').html($('#account_number').val());
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
//            sum:{ required : true }
        }
    });



    $(document).on("click","#btnRestore", function () {
        $.ajax({
            type: 'POST',
            url: site_url+'credit-mini-bonus/restore_accounts_v2',
            data: {account_number: $('#account_number').val()},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                if(response.success==1){
                    $('#s_report').html('Account Number '+$('#account_number').val()+ ' is restored');
                    $('#avreport').modal('show');
                }else if(response.success==2){
                   // $('#s_report').html('Account Number '+$('#account_number').val()+' has failed from restoration');
                    $('#s_report').html('Please enter a valid account number');
                    $('#avreport').modal('show');
                }else if(response.success==0){
                    $('#s_report').html('Account Number '+$('#account_number').val()+' is currently active');
                    $('#avreport').modal('show');
                }
                $('#loader-holder').hide();
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
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


<script type="application/javascript">
    var payment_transaction = '';
    var pblc = [];
    pblc['request'] = null;
    if(pblc['request'] != null) pblc['request'].abort();
    var site_url="<?=site_url('')?>";


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

        document.body.scrollTop = document.documentElement.scrollTop = 0;
        $('#loader-holder').hide();
    });


    $(document).on("click", ".push_delete", function () {
        $('td[name=c1]').html($(this).data('commenttype'));
        $('td[name=c2]').html($(this).data('comment'));
        $('td[name=c3]').html($(this).data('date'));
        $('input[name=deleteId]').data('id',$(this).data('id'));
        $('input[name=deleteId]').data('type',$(this).data('type'));
    });


    function pre_def(){
        return false;
    }

</script>
