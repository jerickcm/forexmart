<link href="<?= $this->template->Css()?>style2.css" rel="stylesheet">

<style>
    .child-input-form label{
        margin-left: 40%;
        font-size: 14px;
        color: #333;
    }
    .child-input-form span{
        color: red;
    }
    .child-input-form input[type=text] {
        width: 20%!important;
        margin-left: 40%;
        padding: 6px 12px;  
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }
</style>


<section class="content-header">
      <h1>Register Account</h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-paper-plane"></i> Quick Jump</li>
        <li class="active">Register Account</li>
      </ol>
</section>

<section class="content">
    <div class="box style-box">
        <div class="box-body">
            <form action="" method="post" class="form-horizontal" id="live">
                <div class="child-input-form">
                   <label>Email <span>*</span></label>
                    <input type="text" name="email" maxlength="128" class="form_control<?php echo form_error('email')?" red-border":""?> ext-arabic-form-control-placeholder" id="inputEmail3" placeholder="Email" value="<?=set_value('email')?>"/>
                </div>

                <div class="child-input-form">
                    <label>Name <span>*</span></label>
                    <input name="full_name" type="text" maxlength="48" class="form_control<?php echo form_error('full_name')?" red-border":""?> ext-arabic-form-control-placeholder" id="full" placeholder="Full name including middle name" value="<?=set_value('full_name')?>"/>
                </div>
                
                <div class="form-registration-btn-holder">
                    <button type="submit" id="open_account">Open Account</button>
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
</section>


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
                    if(response.success){
                        window.location.href = "<?=FXPP::loc_url('open_account/open_account_reg1')?>/"+response.incid;

                    }else{
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