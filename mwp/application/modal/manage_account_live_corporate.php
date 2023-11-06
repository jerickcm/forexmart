<style>
    .form-horizontal .control-label{
        font-size: 13px;
    }
    .modal{
        left:auto!important;
    }
</style>
<div class="modal fade in" id="modal-manage-account_corporate"  style="width: 87%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center">Account Number: <span id="modalAccountNumber1" class="modalAccountNumber"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row row-alert">
                    <div class="col-lg-12">
                        <div class="alert alert-success text-center" role="alert"><i class="fa fa-check-circle"></i>Changes successfully
                            saved.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form class="form-horizontal" id="liveAccountDetails1">
                        <input type="hidden" name="account_number" id="accountNumber1" value="" />
                        <input type="hidden" name="account_id" id="accountID1" value="" />
                        <div class="col-lg-4 tabNav">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a data-toggle="tab" href="#personalDetails">Personal Details</a></li>
                                <li><a data-toggle="tab" href="#corporateAccount">Corporate Account</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="personalDetails" class="tab-pane fade in active">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email <cite class="req">*</cite></label>
                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="email" maxlength="48" class="form-control round-0" placeholder="Email" value="">
                                            <span id="email-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_email1"  class="glyphicon glyphicon-question-sign tip_email1" data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email(2)</label>
                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="email2" maxlength="48" class="form-control round-0" placeholder="Email"
                                                   value="">
                                            <span id="email2-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_email2" class="glyphicon glyphicon-question-sign tip_email2" data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email(3)</label>
                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="email3" class="form-control round-0" placeholder="Email" value="">
                                            <span id="email3-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_email3" class="glyphicon glyphicon-question-sign tip_email3" data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Full Name <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="name" maxlength="128" class="form-control round-0"
                                                   placeholder="First Name, Last Name" value="">
                                            <span id="name-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_name" class="glyphicon glyphicon-question-sign tip_name"
                                           data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Street Address <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="address" maxlength="128" class="form-control round-0" placeholder="Street Address" value="">
                                            <span id="address-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_address"
                                           class="glyphicon glyphicon-question-sign tip_address" data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">City <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="city" maxlength="32" class="form-control round-0" placeholder="City"
                                                   value="">
                                            <span id="city-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_city" class="glyphicon glyphicon-question-sign tip_city"
                                           data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">State/Province <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="state" maxlength="32" class="form-control round-0"
                                                   placeholder="State/Province" value="">
                                            <span id="state-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_state" class="glyphicon glyphicon-question-sign tip_state"
                                           data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Country <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <select id="country" name="country" class="form-control round-0 valid" aria-required="true"
                                                    aria-invalid="false">
                                                <?php echo $this->general_model->selectOptionList($this->general_model->getCountries()); ?>
                                            </select>
                                            <span id="country-error" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Postal/Zip Code <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="zip_code" maxlength="16" class="form-control round-0"  placeholder="Postal/Zip Code" value="">
                                            <span id="zip_code-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_zip" class="glyphicon glyphicon-question-sign tip_zip"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Phone Number <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="phone_number" maxlength="32" class="form-control round-0"
                                                   placeholder="Phone Number" value="">
                                            <span id="phone_number-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_telephone1"
                                           class="glyphicon glyphicon-question-sign tip_telephone1" data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Phone Number(2)</label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="phone_number2" maxlength="32" class="form-control round-0"
                                                   placeholder="Phone Number" value="">
                                            <span id="phone_number2-error" class="error"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="tip_telephone2"
                                           class="glyphicon glyphicon-question-sign tip_telephone2" data-original-title="" title=""></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Date of Birth <cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" class="form-control round-0 datepicker" id="birth_date"
                                                   placeholder="Date of Birth" name="birth_date">
                                            <span id="birth_date-error" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_social_media_type" style="display:none;">
                                        <label class="col-sm-4 control-label">
                                            <p id="social_media_type" name="social_media_type" class="form-control-static"></p>
                                        </label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" class="form-control round-0" id="fb" name="fb">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Password <cite class="req">*</cite></label>

                                        <div class="col-sm-5">
                                            <a href="javascript:void(0)" id="btnResetPassword" class="btn-reset">Reset Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="corporateAccount" class="tab-pane fade">
                                    <div class="form-group">

                                        <label class="col-sm-12 control-label corp-success" style="display: none;"></label>
                                        <label class="col-sm-4 control-label">Company Name<cite class="req">*</cite></label>
                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="hidden" name="company_id" id="company_id" value=""/>
                                            <input type="hidden" name="acct_id" id="acct_id" value=""/>
                                            <input type="text" name="company_name" id="company_name" maxlength="48" class="form-control round-0" placeholder="Company Name" value="">
                                            <span class="comp-name-error success-message" style="display: none;text-align: right;"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="c_name" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Company Trading Name</label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="trading_name" id="trading_name" maxlength="48" class="form-control round-0" placeholder="Company Trading Name" value="">
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="c_trading" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Company Website</label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="company_website" id="company_website" maxlength="48" class="form-control round-0"
                                                   placeholder="Company Website" value="">
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="c_website" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Business Type<cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="business_type" id="business_type" maxlength="48" class="form-control round-0"  placeholder="Business Type" value="">
                                            <span class="state-error error error-business-type" style="display: none;text-align: right;"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="c_bustype" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Contact Number<cite class="req">*</cite></label>

                                        <div class="col-sm-8 col-with-tooltip">
                                            <input type="text" name="Contact_num" id="Contact_num" maxlength="48" class="form-control round-0" placeholder="Contact Number" value="">
                                            <span class="zip-code-error contact-error error" style="display: none;text-align: right;"></span>
                                        </div>
                                        <i style="color: blue; vertical-align: middle;" id="c_contact" class="tooltip-upload-docs glyphicon glyphicon-question-sign"></i></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">&nbsp;</label>

                                        <div class="col-sm-8">
                                            <a href="javascript:void(0)" id="save_company_btn" class="btn-reset">Save Corporate Information</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Trading Account Settings</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Type <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="account_type" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Currency Base <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="currency_base" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Leverage <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <select class="form-control round-0 required" name="leverage" id="leverage" aria-required="true">
                                        <?php echo $this->general_model->selectOptionList($this->general_model->getLeverage(), "1:200");?>
                                    </select>
                                    <span id="leverage-error" class="error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input name="auto_leverage" value="false" type="checkbox"> Turn off leverage auto change
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input name="swap_free" value="1" type="checkbox"> Swap-free
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label control-label">Trading Experience</label>

                                <div class="col-sm-8">
                                    <div>
                                        <input id="agree-1" disabled="disabled" type="checkbox" name="experience" value="1"> Forex and CFD's
                                    </div>
                                    <div>
                                        <input id="agree-2" disabled="disabled" type="checkbox" name="experience" value="2"> Securities(Shares
                                        or Bonds)
                                    </div>
                                    <div>
                                        <input id="agree-3" disabled="disabled" type="checkbox" name="experience" value="3"> Other Derivative
                                        Products
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Investment Knowledge <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="investment_knowledge" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">How often do you trade? <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="trade_duration" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Politically Exposed Person <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <p id="politically_exposed_person" class="form-control-static">No</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Understand Investment Risk <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <p id="risk" class="form-control-static">No</p>
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
                                    <input type="text" name="employment_status" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Industry <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="industry" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Estimated Annual Income <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="estimated_annual_income" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Estimated Net Worth <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="estimated_net_worth" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Education Level <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <input type="text" name="education_level" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Are you a United States Resident for Tax Purposes? <cite
                                        class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <p id="us_resident" class="form-control-static">No</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Are you a United States Citizen? <cite class="req">*</cite></label>

                                <div class="col-sm-8">
                                    <p id="us_citizen" class="form-control-static">No</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Affiliate Code</label>

                                <div class="col-sm-8">
                                    <input type="text" name="affiliate_code" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comment</label>

                                <div class="col-sm-8">
                                    <input type="text" name="ndb_status" class="form-control round-0" readonly="readonly" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block" style="text-align: center">
                    <a href="javascript:void(0)" id="btnLiveResend1" class="btn-save">Re-send Access Details</a>
                    <a href="javascript:void(0)" id="btnLiveSaveChanges1" class="btn-save ">Save Changes</a>
                    <a href="javascript:void(0)" class="btn-save open-update-history">Update History</a>
                </div>
            </div>
        </div>
    </div>
</div>