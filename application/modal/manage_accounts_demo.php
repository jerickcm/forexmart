<style type="text/css">

    .btn-reset, .btn-save{
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 10px 50px;
        border: medium none;
        transition: all 0.3s ease 0s;
        margin: 2px;
    }

    a.btn-reset:hover{
        color: #FFF;
        text-decoration: none;
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
                <div class="row">
                    <form class="form-horizontal" id="demoAccountDetails">
                        <input type="hidden" name="account_number" id="accountNumber" value="" />
                        <input type="hidden" name="account_id" id="accountID" value="" />
                        <div class="col-lg-6">
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
                                <label class="col-sm-3 control-label">Country <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <select id="country" name="country" class="form-control round-0">
                                        <?php echo $countries; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone_number" class="form-control round-0" placeholder="Phone Number" Value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                                <label class="col-sm-4 control-label">Amount <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="amount" class="form-control round-0" readonly="readonly" Value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <a href="javascript:void(0)" id="btnDemoSaveChanges" class="btn-save">Save Changes</a>
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