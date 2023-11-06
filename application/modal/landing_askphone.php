<?php $this->lang->load('forexmart_landing');?>
<div class="modal fade" id="landing_ask_phone" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">
                    <?=lang('validate_mobile_num')?>
                </h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="text-center">
                    <input type="text" class="form-control round-0 " maxlength="32" placeholder="Phone Number" name="phone" id="phone" value="<?= set_value('PhoneNumber','+'.$calling_code)?>">
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 submit_cancel"> <?=lang('validate_btn_cancel')?></button>
                <?php
                $data['button_submit']=  array(
                    'name'          => 'submit',
                    'id'            => 'submit',
                    'class'          => 'btn btn-default round-0 submit_phone',
                    'content'       => lang('validate_btn_submit'),
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
    $(document).on("click", ".submit_phone", function () {
        var phone='';
        phone=$("#phone").val();
        phone=phone.trim();
        $.post('<?=FXPP::www_url('forexmart_landing/landing_registration')?>',{phone:phone},function(view){
            document.getElementById("onbuttonf").click();
            window.location = '<?=FXPP::loc_url('forexmart_landing/thanks')?>';
        });
    });
</script>