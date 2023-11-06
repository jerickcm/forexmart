<!-- modal -->
<style>
    .formshow{
        visibility: visible;
        display: block;
    }
    .formhide{
        visibility: hidden;
        display: none;
    }
    .setsuccessheight{
        height: 285px;
    }
    div.bg-danger {
        background-color: #f2dede;
        padding: 5px;
        font-size: 12px;
        color: rgb(174, 21, 21) !important;
        text-align: center;
        border: 1px solid;
        margin: 20px;

    }

    div.bg-danger p {
        margin: 10px 10px!important;
        text-align: center !important;
        font-size: 12px !important;
        color: rgb(174, 21, 21) !important;
        line-height: 17px;
    }
    .modal-body1{
        padding: 25px 15px;
    }
    .poptitle{
        text-align: left!important;
    }

    .modal.in .modal-dialog{
        width: 350px;
    }
</style>
<div class="modal fade" id="popmailerdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0 ">
        <div  class="modal-content round-0 modalfeedbackcontent">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle" id="myModalLabel">
                    Mailer
                </div>
            </div>

            <?= form_open('administration/deletemailer_to_mailerdb',array('id' => 'form_delete')); ?>
                <div class="modal-body modal-body1">
                    <p class="check-ps">Are you sure you want to delete this mailer ?</p>
                    <input type="hidden" name="mailerId" id="mailerId" value=""/>
                </div>
                <div class="modal-footer round-0 popfooter">
                    <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Cancel</button>
                    <?php
                        $data['button_submit']=  array(
                            'name'          => 'delete',
                            'id'            => 'delete',
                            'value'         => 'true',
                            'type'          => 'submit',
                            'class'          => 'btn btn-default round-0',
                            'content'       => 'Delete'
                        );
                    ?>
                    <?= form_button($data['button_submit']);?>
                </div>
            <?= form_close();?>

        </div>
    </div>
</div>

<!-- end modal -->
<?php unset($data);?>
