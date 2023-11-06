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
        text-align: center !important;
        margin: 0 0 10px !important;
        font-size: 12px !important;
        color: rgb(174, 21, 21) !important;
        line-height: 17px;
    }
</style>

<div class="modal fade" id="popfeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0 ">
        <div  class="modal-content round-0 modalfeedbackcontent">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle" id="myModalLabel">
                    <img src="<?= $this->template->Images()?>logo.png" alt="logo" class="img-reponsive">
                </div>
            </div>

            <div id="FeedbackFormRating" class="formshow">
                <?= form_open('feedback',array('id' => 'form_feedback')); ?>
                <?php
                if(validation_errors())
                {
                    echo '<div class="bg-danger">';
                    echo validation_errors();
                    echo '</div>';
                }
                ?>
                <div class="modal-body">
                    <p class="fback-first-line">
                        Good day! We'd love to hear your feedback about your Account.
                    </p>
                    <p class="rate-line">
                        <small>How would you rate your experience on a scale of 1-10?</small>
                    </p>
                    <div class="row">
                        <div class="col-sm-12 scale">
                            <div class="scale-holder">
                                <ul class="rate-holder">
                                    <li class="scale-first"><p></p></li>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>6</li>
                                    <li>7</li>
                                    <li>8</li>
                                    <li>9</li>
                                    <li>10</li>
                                    <li class="scale-last"><p></p></li>
                                </ul><div class="clearfix"></div>
                                <ul class="rateradio-holder">
                                    <li class="scale-first">Poor</li>
                                    <li><input type="radio" name="rate" value="1"></li>
                                    <li><input type="radio" name="rate" value="2"></li>
                                    <li><input type="radio" name="rate" value="3"></li>
                                    <li><input type="radio" name="rate" value="4"></li>
                                    <li><input type="radio" name="rate" value="5"></li>
                                    <li><input type="radio" name="rate" value="6"></li>
                                    <li><input type="radio" name="rate" value="7"></li>
                                    <li><input type="radio" name="rate" value="8"></li>
                                    <li><input type="radio" name="rate" value="9"></li>
                                    <li><input type="radio" name="rate" value="10"></li>
                                    <li class="scale-last">Excellent</li>
                                </ul><div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <p class="rate-line2">
                        <small>Should you have any specific feedback, please select a category below.(optional)</small>
                    </p>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="col-sm-3 control-label lblcat">Category</label>
                                <div class="col-sm-9">
                                    <?php

                                    $data['options'] = array(
                                        'Problem'     => 'Problem',
                                        'Suggestion'  => 'Suggestion',
                                        'Compliment'  => 'Compliment',
                                        'Other'       => 'Other',
                                    );
                                    $data['attributes'] = ' class="form-control round-0" id="select_category" ';
                                    echo form_dropdown('category', $data['options'], set_value('category', '') ,$data['attributes']);
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea rows="5" class="form-control round-0 topadjust" name="textarea"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer round-0 popfooter">

                    <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Cancel</button>

                    <?php
                    $data['button_submit']=  array(
                        'name'          => 'feedback',
                        'id'            => 'button_feedback',
                        'value'         => 'true',
                        'type'          => 'submit',
                        'class'          => 'btn btn-default round-0',
                        'content'       => 'Send Feedback'
                    );
                    ?>

                    <?= form_button($data['button_submit']);?>

                </div>
                <?= form_close();?>
            </div>
            <div id="FeedbackFormSuccess" class="formhide">
                <?= form_open('feedback-email',array('id' => 'form_feedback_sendemail')); ?>
                <?php
                if(validation_errors())
                {
                    echo '<div class="bg-danger">';
                    echo validation_errors();
                    echo '</div>';
                }
                ?>
                <div class="modal-body">
                    <p><b>
                            Thank  you very much, your feedback has been successfully submitted.
                        </b>
                    </p>
                    <p>
                        If you'd like us to follow up on your feedback, please enter your email address below. Rest assured your email will never be used for any other purpose.
                    </p>
                    <?php  $data = array(
                        'name'          => 'email',
                        'id'            => 'email',
                        'type'         => 'email',
                        'maxlength'     => '100',
                        'size'          => '50',
                        'style'          => 'width: 500px;',
                    );
                    ?>
                    <label>Email: <?= form_input($data); ?></label>
                </div>

                <div class="modal-footer round-0 popfooter">
                    <?php
                    $data['button_submit']=  array(
                        'name'          => 'feedback_email',
                        //'id'            => 'button_feedback',
                        'value'         => 'true',
                        'type'          => 'submit',
                        'class'          => 'btn btn-default round-0',
                        'content'       => 'Submit email address'
                    );
                    ?>
                    <?= form_button($data['button_submit']);?>
                    or
                    <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Close</button>
                </div>
                <?= form_close();?>

            </div>
            <div id="FeedbackFormDone" class="formhide">
                <div class="modal-body">
                    <p>
                        <b>
                            Thank  you very much, E-mail has been submitted.
                        </b>
                    </p>
                </div>
                <div class="modal-footer round-0 popfooter">
                    <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end modal -->
<?php unset($data);?>
