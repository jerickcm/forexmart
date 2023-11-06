<div class="modal fade" id="landing_ask_phone2" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">
                    In order to proceed, please enter your mobile number
                </h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center">
                    <input type="text" required="required" class="form-control round-0 <?php echo form_error('phonenumber2')?"red-border":""?>" maxlength="32" placeholder="Phone Number" name="phone2" id="phone2" value="<?= set_value('PhoneNumber','+'.$calling_code)?>">
                    <div class="error-box">
                        <span class="red"> <?php echo  form_error('phonenumber2')?> </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 submit_cancel">Cancel</button>
                <?php
                $data['button_submit']=  array(
                    'name'          => 'submit',
                    'id'            => 'submit',
                    'class'          => 'btn btn-default round-0 submit_phone2',
                    'content'       => 'submit',
                );
                ?>
                <?= form_button($data['button_submit']);?>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script type="application/javascript">
    $(document).on("click", ".submit_cancel", function () {
        $("#lbl1").css('display', 'block');
        $("#btnloader").css('display', 'none');
        $("#lbl2").css('display','block');
        $("#btnloaderf").css('display','none');
    });
    $(document).on("click", ".submit_phone2", function () {
        var  phone=$("#phone2").val();
        phone = phone.trim();
        $("#phonenumber2").val(phone);
        $("button[name='register2']").prop("type", "submit");
        $( "button#register2" ).trigger("click");
        $('form#registerf').validate();
    });

</script>