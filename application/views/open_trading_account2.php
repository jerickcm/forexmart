<link href="<?= $this->template->Css()?>jquery.fileupload.css" rel="stylesheet">
<link href="<?= $this->template->Css()?>jquery.switchButton.css" rel="stylesheet">


<script src="<?= $this->template->Js()?>jquery.js"></script>

<script src="<?= $this->template->Js()?>jquery.easing.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>-->

<script src="<?= $this->template->Js()?>jquery.ui.widget.js"></script>
<script src="<?= $this->template->Js()?>jquery.switchButton.js"></script>
<script src="<?= $this->template->Js()?>jquery.iframe-transport.js"></script>
<script src="<?= $this->template->Js()?>jquery.fileupload.js"></script>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<style type="text/css">
    div.open-trading-cont{
        width: 100%;
    }
    div.step-tab-holder1 ul{
        margin-left: 0px !important;
    }
    div.step-tab-holder1 li{
        font-size: 16px;
    }
</style>

<h1 class="">Open Trading Account</h1>
<div class="open-trading-cont">
    <div class="step-tab-holder1">
        <ul>
            <li class="tabs-title1 color">
                <img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/> Personal Details
            </li>
            <li>
                <img src="<?= $this->template->Images() ?>nxt.png" class="img-reponsive" width="50"/>
            </li>
            <li class="tabs-title2">
                <img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/> Trading Account
                Details
            </li>
            <li>
                <img src="<?= $this->template->Images() ?>nxt.png" class="img-reponsive" width="50"/>
            </li>
            <li class="tabs-title3">
                <img src="<?= $this->template->Images() ?>step.png" class="img-reponsive" width="50"/> Account Confirmation
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<form action="" method="post" id="register-live">
    <div class="tab-content" style="margin-top: 30px;">
        <div role="tabpanel" class="tab-pane active row col-centered " id="personal">
            <div class="col-lg-10 col-md-10 col-centered">
                <div class="form-horizontal personal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Street address<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control round-0" placeholder="Street address" name="street">
                        </div>
                        <div class="col-sm-3 error">
                            <?php echo  form_error('street')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">City<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control round-0" placeholder="City" name="city">
                        </div>
                        <div class="col-sm-3 error">
                            <?php echo  form_error('city')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">State/Province<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control round-0" placeholder="State/Province" name="state">
                        </div>
                        <div class="col-sm-3 error">
                            <?php echo  form_error('state')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Postal/Zip Code<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control round-0" placeholder="Postal/Zip Code" name="zip">
                        </div>
                        <div class="col-sm-3 error">
                            <?php echo  form_error('zip')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone Number<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control round-0" placeholder="Phone Number" name="phone" >
                        </div>
                        <div class="col-sm-3 error">
                            <?php echo  form_error('phone')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date of Birth<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control round-0 datepicker" placeholder="Date of Birth" name="dob">
                        </div>
                        <div class="col-sm-3 error">
                            <?php echo  form_error('dob')?>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>

                        <div class="col-sm-6">
                            <label
                                style="margin-top: 20px; font-family: Georgia; font-size: 15px; margin-bottom: 0px; color: #29a643;">Trading
                                Experience</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="demo" id="labels" style="float: right;">
                                <div class="switch-wrapper">
                                    <input type="checkbox" value="1" checked name="instruments">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-6">
                            <p>Forex, CFDs & Other Instruments</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="demo" id="labels" style="float: right;">
                                <div class="switch-wrapper">
                                    <input type="checkbox" value="1" checked name="risk">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-6">
                            <p>Derivative products are suitable as part of my investment objectives and attitude towards risk
                                and I am able to assess the risks involved in trading them, including the possibility that I may
                                lose all of my capital.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="demo" id="labels" style="float: right;">
                                <div class="switch-wrapper">
                                    <input type="checkbox" value="1" checked name="experience">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-6">
                            <p>I have previous professional qualifications and/or wwork experience in the financial services
                                industry.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <a href="javascript:void(0)" aria-controls="trading" role="tab" data-toggle="tab" class="personal-next">
                                <button id="personal-next" type="button" class="btn-submit">Next</button>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="trading">
            <div class="col-lg-8 col-md-8 col-centered">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Account Tyfaawfpe<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <select class="form-control round-0" name="mt_account_set_id">
                                <?php echo $account_type;?>
                            </select>
                        </div>
                        <div class="col-sm-3 error"><?php echo  form_error('mt_account_set_id')?></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Account Currency Base<cite
                                class="req">*</cite></label>

                        <div class="col-sm-6">
                            <select class="form-control round-0" name="mt_currency_base">
                                <?php echo $account_currency_base;?>
                            </select>
                        </div>
                        <div class="col-sm-3 error"><?php echo  form_error('mt_currency_base')?></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Leverage<cite class="req">*</cite></label>

                        <div class="col-sm-6">
                            <select class="form-control round-0" name="leverage">
                                <?php echo $leverage;?>
                            </select>
                        </div>
                        <div class="col-sm-3 error"><?php echo  form_error('leverage')?></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-12">
                            <input name="swap_free" value='1' type="checkbox"/> Swap-free
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <a href="javascript:void(0)" aria-controls="account" role="tab" data-toggle="tab" class="trading-next">
                                <button id="trading-next" type="button" class="btn-submit">Next</button>
                            </a>
                            <a href="#personal" aria-controls="personal" role="tab" data-toggle="tab" class="back trading-back"
                               id="back">Back</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="account">
            <div class="col-lg-7 col-md-7 col-centered">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-5">
                        </div>
                        <div class="col-sm-7">
                            <p class="optional"><i class="fa fa-info-circle"></i> (Optional, you can upload documents later.)
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5 control-label">Colour copy of passport or the front of the
                            ID</label>

                        <div class="col-sm-7">
                            <div class="myfileupload-buttonbar ">
                                            <span class="btn btn-success fileinput-button fileup">
                                                <span>Browse...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="passport[]" multiple>
                                            </span>
                                <button class="capture">Capture From Webcam</button>
                                <p class="note">
                                    To open an FX account you must provide a full, clear and valid (colour) copy of your
                                    international passport or national I.D. card or photocard driving license, in addition to
                                    the documents required to verify your address.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5 control-label">Colour copy of the back of the ID</label>

                        <div class="col-sm-7">
                            <div class="myfileupload-buttonbar ">
                                            <span class="btn btn-success fileinput-button fileup">
                                                <span>Browse...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="utility_bill[]" multiple>
                                            </span>
                                <button class="capture">Capture From Webcam</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5 control-label">Proof of Residence</label>

                        <div class="col-sm-7">
                            <div class="myfileupload-buttonbar ">
                                            <span class="btn btn-success fileinput-button fileup">
                                                <span>Browse...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="residence[]" multiple>
                                            </span>
                                <button class="capture">Capture From Webcam</button>
                                <p class="note">
                                    Recent utility bill dated within the last six months, current local authority tax bill, or
                                    credit card statement.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5 control-label"></label>

                        <div class="col-sm-7">
                            <div class="myfileupload-buttonbar ">
                                <p class="sub">
                                    Product Update and Technical Analysis Emails
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-5">
                            <div class="demo" id="labels" style="float: right;">
                                <div class="switch-wrapper">
                                    <input type="checkbox" value="1" checked name="technical_analysis">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-7">
                            <p>I want to receive product update and Technical Analysis emails.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5 control-label"></label>

                        <div class="col-sm-7">
                            <div class="myfileupload-buttonbar ">
                                <p class="sub">
                                    Submission Confirmation
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-5 control-label"></label>

                        <div class="col-sm-7">
                            <div class="myfileupload-buttonbar ">
                                <div class="checkbox">
                                    <label class="agreement">
                                        <input id="agree" type="checkbox"> I declare that I have carefully read and fully understood the
                                        entire text of the Customer Agreement, <a href="<?= ($this->config->item('domain-www')); ?>/terms-and-conditions"> Terms and Conditions </a> of Business FX, Order
                                        Execution Policy, Conflicts of Interest Policy, <a href=" <?php echo FXPP::loc_url('privacy-policy')?>">Privacy Policy</a> with which I fully
                                        understand, accept and agree.
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <div class="col-sm-offset-5 col-sm-7">
                            <!-- <a href="#account" aria-controls="account" role="tab" data-toggle="tab">-->
                            <button id="complete_btn" type="button" class="btn-submit">Complete</button>
                            <!-- </a>-->
                            <a href="#trading" aria-controls="trading" role="tab" data-toggle="tab" class="back acc-back"
                               id="back">Back</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>

    $(function() {
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            yearRange: "-95:+0"
            //  defaultDate: '1920-01-01'

        });
    });

    $(document).on("click","#complete_btn",function(){

        if($("#agree").is(':checked')){
            $("#register-live").submit();
        }else{
            alert(" You need to agree with the terms of Service. ");
        }
    });

    $(document).ready(function(){
        $(".trading-back").click(function(){
            $(".tabs-title2").removeClass("color");
            $(".tabs-title1").addClass("color");
        });
        $(".acc-back").click(function(){
            $(".tabs-title3").removeClass("color");
            $(".tabs-title2").addClass("color");
        });
    });

    $(document).on("click","#personal-next",function(){
        var flag =true;
        $("#personal input,#personal select").each(function(){
            if($(this).val().length>0)
            {
                $(this).closest('div').next('div').text("");
                $(this).removeClass("red-border");
            }else{
                $(this).closest('div').next('div').text("This is a required field.");
                $(this).addClass("red-border");
                flag= false;
            }
        });

        if(flag){
            $(".personal-next").attr("href",'#trading');
            $(".tabs-title1").removeClass("color");
            $(".tabs-title2").addClass("color");
        }else{
            $(".personal-next").attr("href",'');
        }
    });

    $(document).on("click","#trading-next",function(){
        var flag =true;
        $("#trading select").each(function(){
            if($(this).val().length>0)
            {
                $(this).closest('div').next('div').text("");
                $(this).removeClass("red-border");
            }else{
                $(this).closest('div').next('div').text("This is a required field.");
                $(this).addClass("red-border");
                flag = false;
            }
        });

        if(flag){
            $(".trading-next").attr("href",'#account');
            $(".tabs-title2").removeClass("color");
            $(".tabs-title3").addClass("color");
        }else{
            $(".trading-next").attr("href",'');
        }

    });


    $(document).on("focus",'input,select',function(){
        $(this).removeClass("red-border");
    });

    $(function() {

        $("#labels.demo input").switchButton({
            on_label: 'YES',
            off_label: 'NO'
        });

        $("#default.demo input").switchButton({
            checked: false
        });

        $("#labels2-1.demo input").switchButton({
            show_labels: false
        });

        $("#labels2-2.demo input").switchButton({
            labels_placement: "right"
        });

        $("#labels2-3.demo input").switchButton({
            labels_placement: "left"
        });

        $("#slider-1.demo input").switchButton({
            width: 100,
            height: 40,
            button_width: 50
        });

        $("#slider-2.demo input").switchButton({
            width: 100,
            height: 40,
            button_width: 70
        });
    });

</script>
