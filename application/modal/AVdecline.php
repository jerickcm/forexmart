<style>
    .s_adjst{
        margin: 20px 5px;
        width: 558px;
        padding: 8px;
    }
    .tarea_adjst{
        margin: 20px 5px;
        width: 558px;
        padding: 8px;
        height: 162px;
    }
    .check-ps{font-weight: bold;}
    .display-n{
        display: none;
    }
</style>

<div class="modal fade" id="popAccountVerificationDecline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0 ">
        <div  class="modal-content round-0 modalfeedbackcontent">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle" id="myModalLabel">
                    <img src="<?= $this->template->Images()?>logo.png" alt="logo" class="img-reponsive">
                </div>
            </div>
            <?= form_open('administration/AccountVerificationDecline_Aff',array('class' => 'form_SchemedeleteA display-n declineAffiliate' )); ?>
            <div class="modal-body modal-body1">
                <div class="form-group acct-grp">
                    <p class="check-ps" style="font-weight: bold;">
                        Reason for declining document
                    </p>
                </div>
                <div class="form-group acct-grp">
                    <?php $options = array(
                        '0'    => 'Account holder did not reached the age limit.',
                        '1'    => 'Address provided and address on document do not match.',
                        '2'    => 'Document is altered or modified without proper certification from issuer.',
                        '3'    => 'Document is corrupt and cannot be opened.',
                        '4'    => 'Document is expired.',

                        '5'    => 'Document is password protected.',
                        '6'    => 'Document presented page mismatch.',
                        '7'    => 'Document presented shows a photo without identity details.',
                        '8'    => 'Document presented shows no proof of identity.',
                        '9'    => 'Document scanned from the wrong side.',

                        '10'    => 'Document shows lack of issuer signatures.',
                        '11'    => 'Document shows no country of issuance.',
                        '12'    => 'Document shows no signature of the account holder.',
                        '13'    => 'Invalid document.',
                        '14'    => 'Low resolution scanned document.',

                        '15'    => 'Missing pages on scanned document.',
                        '16'    => 'Name of the account holder and name on the document mismatch.',
                        '17'    => 'No images found on the scanned document.',
                        '18'    => 'No second document submitted.',
                        '19'    => 'Poor quality scanned document.',

                        '20'    => 'Poor quality scanned images.',
                        '21'    => 'Same document submitted on the previous.',
                        '22'    => 'Translation required.',
                    );
                    $attr =' class="s_adjst" ';
                    ?>
                    <?= form_dropdown('SelectReasons', $options, '', $attr);?>
                </div>
                <div class="form-group acct-grp">
                    <?php $data = array(
                        'name'          => 'explanation',
                        'id'            => 'explanation',
                        'value'         => '',
                        'maxlength'     => '256',
                        'size'          => '50',
                        'class' => 'tarea_adjst'
                    ); ?>
                    <?= form_textarea($data);?>
                </div>
                <input type="hidden" name="DocId" id="DocId" value=""/>
                <input type="hidden" name="location" id="location" value=""/>

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
                    'content'       => 'Decline'
                );
                ?>
                <?= form_button($data['button_submit']);?>
            </div>
            <?= form_close();?>

            <?= form_open('administration/AccountVerificationDecline',array('class' => 'form_Schemedelete display-n declineClient')); ?>
            <div class="modal-body modal-body1">
                <div class="form-group acct-grp">
                    <p class="check-ps" style="font-weight: bold;">
                        Reason for declining document
                    </p>
                </div>
                <div class="form-group acct-grp">
                    <?php $options = array(
                        '0'    => 'Account holder did not reached the age limit.',
                        '1'    => 'Address provided and address on document do not match.',
                        '2'    => 'Document is altered or modified without proper certification from issuer.',
                        '3'    => 'Document is corrupt and cannot be opened.',
                        '4'    => 'Document is expired.',

                        '5'    => 'Document is password protected.',
                        '6'    => 'Document presented page mismatch.',
                        '7'    => 'Document presented shows a photo without identity details.',
                        '8'    => 'Document presented shows no proof of identity.',
                        '9'    => 'Document scanned from the wrong side.',

                        '10'    => 'Document shows lack of issuer signatures.',
                        '11'    => 'Document shows no country of issuance.',
                        '12'    => 'Document shows no signature of the account holder.',
                        '13'    => 'Invalid document.',
                        '14'    => 'Low resolution scanned document.',

                        '15'    => 'Missing pages on scanned document.',
                        '16'    => 'Name of the account holder and name on the document mismatch.',
                        '17'    => 'No images found on the scanned document.',
                        '18'    => 'No second document submitted.',
                        '19'    => 'Poor quality scanned document.',

                        '20'    => 'Poor quality scanned images.',
                        '21'    => 'Same document submitted on the previous.',
                        '22'    => 'Translation required.',
                    );
                    $attr =' class="s_adjst" ';
                    ?>
                    <?= form_dropdown('SelectReasons', $options, '', $attr);?>
                </div>
                <div class="form-group acct-grp">
                    <?php $data = array(
                        'name'          => 'explanation',
                        'id'            => 'explanation',
                        'value'         => '',
                        'maxlength'     => '256',
                        'size'          => '50',
                        'class' => 'tarea_adjst'
                    ); ?>
                    <?= form_textarea($data);?>
                </div>
                <input type="hidden" name="DocId" id="DocId" value=""/>
                <input type="hidden" name="location" id="location" value=""/>

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
                    'content'       => 'Decline'
                );
                ?>
                <?= form_button($data['button_submit']);?>
            </div>
            <?= form_close();?>
        </div>
    </div>
</div>
</div>

<!-- end modal -->
<?php unset($data);?>
