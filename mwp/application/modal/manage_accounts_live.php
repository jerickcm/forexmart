<style>
    .form-horizontal .control-label{
        font-size: 13px;
    }
    .modal{
        left:auto!important;
    }
</style>
<div class="modal fade" id="modal-manage-account" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" style="width: 87%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Account Number: <span class="modalAccountNumber"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row row-alert">
                    <div class="col-lg-12">
                        <div class="alert alert-success text-center" role="alert">
                            <i class="fa fa-check-circle"></i> Changes successfully saved.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form class="form-horizontal" id="live_account_details" enctype="multipart/form-data">
                        <input type="hidden" name="account_number" id="accountNumber" value="" />
                        <input type="hidden" name="account_id" id="accountID" value="" />
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Personal Details</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="email" maxlength="48" class="form-control round-0" placeholder="Email" Value="">
                                    <span id="email-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_email1" class="glyphicon glyphicon-question-sign tip_email1"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email(2)</label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="email2" maxlength="48" class="form-control round-0" placeholder="Email" Value="">
                                    <span id="email2-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_email2" class="glyphicon glyphicon-question-sign tip_email2"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email(3)</label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="email3" class="form-control round-0" placeholder="Email" Value="">
                                    <span id="email3-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_email3" class="glyphicon glyphicon-question-sign tip_email3"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="name" maxlength="128" class="form-control round-0" placeholder="First Name, Last Name" Value="">
                                    <span id="name-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_name" class="glyphicon glyphicon-question-sign tip_name"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Street Address <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="address" maxlength="128" class="form-control round-0" placeholder="Street Address" Value="">
                                    <span id="address-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_address" class="glyphicon glyphicon-question-sign tip_address"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">City <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="city" maxlength="32" class="form-control round-0" placeholder="City" Value="">
                                    <span id="city-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_city" class="glyphicon glyphicon-question-sign tip_city"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State/Province <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="state" maxlength="32" class="form-control round-0" placeholder="State/Province" Value="">
                                    <span id="state-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_state" class="glyphicon glyphicon-question-sign tip_state"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Country <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <select id="country" name="country" class="form-control round-0">
                                        <?php echo $this->general_model->selectOptionList($this->general_model->getCountries()); ?>
                                    </select>
                                    <span id="country-error" class="error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Postal/Zip Code <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="zip_code" maxlength="16" class="form-control round-0" placeholder="Postal/Zip Code" Value="">
                                    <span id="zip_code-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_zip" class="glyphicon glyphicon-question-sign tip_zip"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="phone_number" maxlength="32" class="form-control round-0" placeholder="Phone Number" Value="">
                                    <span id="phone_number-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_telephone1" class="glyphicon glyphicon-question-sign tip_telephone1"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number(2)</label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" name="phone_number2" maxlength="32" class="form-control round-0" placeholder="Phone Number" Value="">
                                    <span id="phone_number2-error" class="error"></span>
                                </div>
                                <i style="color: blue; vertical-align: middle;" id="tip_telephone2" class="glyphicon glyphicon-question-sign tip_telephone2"></i>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date of Birth <cite class="req">*</cite></label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" class="form-control round-0 datepicker" id="birth_date" placeholder="Date of Birth" name="birth_date">
                                    <span id="birth_date-error" class="error"></span>
                                </div>
                            </div>

                            <div class="form-group" id="div_social_media_type">
                                <label class="col-sm-3 control-label">
                                    <p id="social_media_type" name="social_media_type" class="form-control-static"></p>
                                </label>
                                <div class="col-sm-9 col-with-tooltip">
                                    <input type="text" class="form-control round-0" id="fb" name="fb">
                                </div>
                            </div>

                            <div class="form-group" >
                                <label class="col-sm-3 control-label">Password <cite class="req">*</cite></label>
                                <div class="col-sm-4">
                                    <a href="javascript:void(0)" id="btnResetPassword" class="btn-reset">Reset Password</a>
                                </div>
                                <!--                                <div class="col-sm-5">-->
                                <!--                                    <a href="javascript:void(0)" id="btn_account_switch" class="btn-switch">Switch to Corporate Account</a>-->
                                <!--                                </div>-->
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Trading Account Settings</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Type <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="account_type" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Currency Base <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="currency_base" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Leverage <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <select class="form-control round-0 required" name="leverage" id="leverage">
                                        <?php echo $this->general_model->selectOptionList($this->general_model->getLeverage(), "1:200");?>
                                    </select>
                                    <span id="leverage-error" class="error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input name="auto_leverage" value='0' type="checkbox"/> Turn off leverage auto change
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input name="swap_free" value='1' type="checkbox"/> Swap-free
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label control-label">Trading Experience</label>
                                <div class="col-sm-8">
                                    <div>
                                        <input id="agree-1" disabled="disabled" type="checkbox" name="experience" value="1"> Forex and CFD's
                                    </div>
                                    <div>
                                        <input id="agree-2" disabled="disabled" type="checkbox" name="experience" value="2"> Securities(Shares or Bonds)
                                    </div>
                                    <div>
                                        <input id="agree-3" disabled="disabled" type="checkbox" name="experience" value="3"> Other Derivative Products
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Investment Knowledge <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="investment_knowledge" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">How often do you trade? <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="trade_duration" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Politically Exposed Person <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <p id="politically_exposed_person" class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Understand Investment Risk <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <p id="risk" class="form-control-static"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Employment Details</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employment Status <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="employment_status" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Industry <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="industry" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Estimated Annual Income <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="estimated_annual_income" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Estimated Net Worth <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="estimated_net_worth" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Education Level <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="education_level" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Are you a United States Resident for Tax Purposes? <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <p id="us_resident" class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Are you a United States Citizen? <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <p id="us_citizen" class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Affiliate Code</label>
                                <div class="col-sm-8">
                                    <input type="text" name="affiliate_code" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comment</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ndb_status" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <a href="javascript:void(0)" id="btnLiveResend" class="btn-save">Re-send Access Details</a>
                    <a href="javascript:void(0)" id="btn_account_switch" class="btn-switch">Switch to Corporate Account</a>
                    <a href="javascript:void(0)" id="btnLiveSaveChanges" class="btn-save">Save Changes</a>
                    <a href="javascript:void(0)" class="btn-save open-update-history">Update History</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>

<style>
    .datepicker {
        z-index:9999 !important;
    }
</style>