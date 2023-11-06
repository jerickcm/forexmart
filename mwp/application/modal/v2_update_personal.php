<!-- START UPDATE PERSONAL TAB MODAL -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Details</h4>
            </div>
            <div class="modal-body style-customized-modal-body">
                <form action="" id="save-live-account" method="post" enctype="multipart/form-data">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom style-customized-navigation-tab modal-style-navigation-tab">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#modal_tab1" data-toggle="tab">Personal</a></li>
                            <li><a href="#modal_tab2" data-toggle="tab">Company</a></li>
                            <li><a href="#modal_tab3" data-toggle="tab">Trading Account Settings</a></li>
                            <li><a href="#modal_tab4" data-toggle="tab">Employment</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="modal_tab1">
                                <div class="modal-form-details col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Email <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Email" value="<?=$apiInfo['Email']?>" name="email">
                                        <input type="hidden" class="form-control" placeholder="" value="<?=$apiInfo['LogIn']?>" name="account_number">
<!--                                        <a href="javascript:;" class="modal-add-button"><i class="fa fa-plus"></i> Add Email</a>-->
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Full Name" value="<?=$apiInfo['Name']?>" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Street Address <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Street Address" value="<?=$apiInfo['Address']?>" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label>City <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="City" value="<?=$apiInfo['City']?>" name="city">
                                    </div>
                                    <div class="form-group">
                                        <label>State <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="State" value="<?=$apiInfo['State']?>" name="state">
                                    </div>
                                    <div class="form-group">
                                        <label>Country <span>*</span></label>
                                        <select id="country" name="country" class="form-control round-0"><?=$country?></select>
                                    </div>
                                    <div class="form-group">
                                        <label>Postal/Zip Code <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Postal/Zip Code" value="<?=$apiInfo['ZipCode']?>" name="zip_code">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Phone Number" value="<?=$apiInfo['PhoneNumber']?>" name="phone_number">
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth <span>*</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <?php $dob = $dbInfo['dob']!='0000-00-00'? date('m/d/Y',strtotime($dbInfo['dob'])):date('m/d/Y',strtotime('today')); ?>
                                            <input id="datePicker1" name="birth_date" type="text" class="form-control pull-right" placeholder="Date of Birth"  value="<?php echo $dob; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group personal-reset-password">
                                        <label>Password <span>*</span></label>
                                        <button id="btnResetPassword">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="modal_tab2">
                                <div class="modal-form-details col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Company Name <span>*</span></label>
                                        <input type="hidden" name="company_id" id="company_id" value=""/>
                                        <input type="hidden" name="acct_id" id="acct_id" value=""/>
                                        <input type="text" class="form-control" placeholder="Company Name" name="company_name" id="company_name" maxlength="48" value="<?=$corp1?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Company Trading Name</label>
                                        <input type="text" class="form-control" placeholder="Company Trading Name" name="trading_name" id="trading_name" maxlength="48" value="<?=$corp5?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Company Wesbite</label>
                                        <input type="text" class="form-control" placeholder="Company Wesbite" name="company_website" id="company_website" maxlength="48" cvalue="<?=$corp3?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Business Type <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Business Type" name="business_type" id="business_type" maxlength="48" value="<?=$corp4?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Contact Number" name="Contact_num" id="Contact_num" maxlength="48" value="<?=$corp2?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="modal_tab3">
                                <div class="modal-form-details col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Account Type <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Account Type" name="account_type" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Currency Base <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Account Currency Base" name="currency_base" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Leverage <span>*</span></label>
                                        <select class="form-control round-0 required" name="leverage" id="leverage"><?=$leverage;?></select>
                                    </div>
                                    <div class="form-group">
                                        <input name="auto_leverage" type="checkbox"/>
                                        <span class="modal-span-label">Turn off leverage auto change</span>
                                    </div>
                                    <div class="form-group">
                                        <input name="swap_free" value="1" type="checkbox"/>
                                        <span class="modal-span-label">Swap-free</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Trading Experience <span>*</span></label>
                                        <select class="form-control" name="experience">
                                            <option id="agree-1" value="1">Forex and CFD's</option>
                                            <option id="agree-2" value="2">Securities (Shares or Bonds)</option>
                                            <option id="agree-3" value="3">Other Derivative Products</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Investment Knowledge <span>*</span></label>
                                        <input type="text" class="form-control" name="investment_knowledge" placeholder="Investment Knowledge" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>How often do you trade? <span>*</span></label>
                                        <input name="trade_duration" type="text" class="form-control" placeholder="How often do you trade?" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Politically Exposed Person <span>*</span></label>
                                        <span id="politically_exposed_person" class="modal-span-label modal-span-label-align">No</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Understand Investment Risk <span>*</span></label>
                                        <span id="risk" class="modal-span-label modal-span-label-align">No</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="modal_tab4">
                                <div class="modal-form-details col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Employment Status <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Employment Status" name="employment_status" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Industry <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Industry" name="industry" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Estimated Annual Income <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Estimated Annual Income" name="estimated_annual_income" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Estimated Net Worth <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Estimated Net Worth" name="estimated_net_worth" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Education Level <span>*</span></label>
                                        <input type="text" class="form-control" placeholder="Education Level" name="education_level" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Are you a United States Resident for Tax Purposes? <span>*</span></label>
                                        <span id="us_resident" class="modal-span-label modal-span-label-align">No</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Are you a United States citizen? <span>*</span></label>
                                        <span id="us_citizen" class="modal-span-label modal-span-label-align">No</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Affiliate Code <span>*</span></label>
                                        <input type="text" name="affiliate_code" class="form-control" placeholder="Affiliate Code" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Comment <span>*</span></label>
                                        <input name="ndb_status" type="text" class="form-control" placeholder="Comment" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveChanges">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END UPDATE PERSONAL TAB MODAL -->