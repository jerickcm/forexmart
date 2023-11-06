<style>
    .child-input-form label {
        margin-left: 40%;
    }
    .child-input-form input[type=text] {
        width: 20%!important;
        margin-left: 40%;
    }
</style>

<div class="tab-pane active" id="reg_form"  role="tabpanel">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Open Account</h1>
    </div>
    <div class="div_reg1">
        <form action="" method="post" class="form-horizontal" id="live">
            <div class="child-input-form">
                <label>Email</label>
                <input type="text" name="email" maxlength="128" class="form_control<?php echo form_error('email')?" red-border":""?> ext-arabic-form-control-placeholder" id="inputEmail3" placeholder="Email" value="<?=set_value('email')?>"/>
            </div>

            <div class="child-input-form">
                <label>Name</label>
                <input name="full_name" type="text" maxlength="48" class="form_control<?php echo form_error('full_name')?" red-border":""?> ext-arabic-form-control-placeholder" id="full" placeholder="Full name including middle name" value="<?=set_value('full_name')?>"/>
            </div>
            
            <div class="child-input-form">
                <button type="submit" id="open_account" class="tab-input-button green-input-button" style="float: none; width: 10%!important;margin-left: 45%;">Open Account</button>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
        <div class="modal-dialog round-0" style="margin-left: 40%;">
            <div class="modal-content round-0">
                <div class="modal-body modal-show-body">
                    <div class="text-center manage-credit-prize-alert-message">
                        <span style="color: red;font-size:18px;font-weight: bold;" id="error-msg">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> 

<script type="text/javascript">
    var baseurl = '<?php echo base_url();?>';

    $(document).on('click', '#open_account', function(e){
        if($('#inputEmail3').val() == '' || $('#full').val() == ''){
            $("#modal-error").modal('show');
            $("#error-msg").html('Please complete all the fields.');
            e.preventDefault();
        }

        else{
            $.ajax({
                type: 'POST',
                url: baseurl+'open_account/validate_email',
                data: {email: $('#inputEmail3').val(), full_name:$('#full').val()},
                dataType: 'json',
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(response){
    //                console.log(response);
                    if(response.success){
                        //console.log('no error');
//                        $("#reg_form").css('display','none');
//                        $("#reg_form1").css('display','block');
//                        $("#inc_id").text(response.incid);
                        window.location.href = "<?=FXPP::loc_url('open_account/open_account_reg1')?>/"+response.incid;

                    }else{
                        //console.log('error1');
                        $("#modal-error").modal('show');
                        $("#error-msg").html(response.errors);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#modal-error").modal('show');
                    $("#error-msg").html('Unknown error.');
                    $('#loader-holder').hide();
                }

            });
                $('#loader-holder').hide();
                e.preventDefault();
            }
        });
</script>