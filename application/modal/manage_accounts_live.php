<style type="text/css">

    #modal-manage-account .modal-dialog {
        width: 95%;
    }

    .ui-datepicker {
        z-index: 9999;
    }

    .btn-reset, .btn-save {
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 10px 50px;
        border: medium none;
        transition: all 0.3s ease 0s;
        margin: 2px;
    }

    a.btn-reset:hover, a.btn-save:hover{
        color: #FFF;
        text-decoration: none;
    }

    .row-alert {
        display: none;
    }

    #modal-manage-account .modal-footer {
        text-align: center;
    }

</style>
<div class="modal fade" id="modal-manage-account" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Account Number: <span id="modalAccountNumber"></span></h4>
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
                    <form class="form-horizontal" id="liveAccountDetails">
                        <input type="hidden" name="account_number" id="accountNumber" value="" />
                        <input type="hidden" name="account_id" id="accountID" value="" />
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Personal Details</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control round-0" placeholder="Email" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control round-0" placeholder="First Name, Last Name" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Street Address <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control round-0" placeholder="Street Address" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">City <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="city" class="form-control round-0" placeholder="City" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State/Province <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="state" class="form-control round-0" placeholder="City" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Country <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <select id="country" name="country" class="form-control round-0">
                                        <?php echo $countries; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Postal/Zip Code <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="zip_code" class="form-control round-0" placeholder="City" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone_number" class="form-control round-0" placeholder="City" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date of Birth <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control round-0 datepicker" id="birth_date" placeholder="Date of Birth" name="birth_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <a href="javascript:void(0)" id="btnResetPassword" class="btn-reset">Reset Password</a>
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
                                        <?php echo $leverage; ?>
                                    </select>
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
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <a href="javascript:void(0)" id="btnLiveSaveChanges" class="btn-save">Save Changes</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            yearRange: "-95:+0"
            //  defaultDate: '1920-01-01'

        });
    });
</script>
<style>
    .datepicker {
        z-index:9999 !important;
    }
</style>