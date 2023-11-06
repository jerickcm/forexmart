<style type="text/css">

    ul#ulwebname {
        list-style: none;
        margin: 0 !important;
        padding: 0 !important;
    }

    i.fa-minus{
        color: red;
    }

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

    #modal-manage-affiliates .modal-footer {
        text-align: center;
    }
</style>
<div class="modal fade" id="modal-manage-affiliates" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Account Number: <span id="modalAccountNumber"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" id="affiliateDetails">
                        <input type="hidden" name="account_number" id="accountNumber" value="" />
                        <input type="hidden" name="account_id" id="accountID" value="" />
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Personal Details</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <?php
                                        $attr = 'id="statusType" class="form-control round-0"';
                                        echo form_dropdown('status_type',$status_type, '', $attr);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control round-0" placeholder="First Name, Last Name" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control round-0" placeholder="Email" Value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Currency <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <select id="currency" name="currency" class="form-control round-0">
                                        <?php echo $currency; ?>
                                    </select>
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
                                <label class="col-sm-3 control-label">Target Country <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <select id="targetCountry" name="target_country" class="form-control round-0">
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
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Message</label>
                                <div class="col-sm-9">
                                    <textarea type="text" id="message" name="message" class="form-control round-0" rows="3" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Website</label>
                                <div class="col-sm-9">
                                    <ul id="ulwebname"></ul>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <a href="javascript:void(0)" id="btnAffiliateSaveChanges" class="btn-save">Save Changes</a>
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

    jQuery(document).on('click', '#addWebsite', function(){
        var website_html = '<li><div class="input-group"><input type="text" placeholder="Website" class="form-control round-0" name="websites[]"/><div class="input-group-addon round-0"><a id="removeWebsite"><i class="fa fa-minus"></i></a></div></div></li>';
        jQuery("#ulwebname").append(website_html);
    });

    jQuery(document).on('click', 'a#removeWebsite', function(){
        jQuery(this).closest("li").remove();
    });
</script>
<style>
    .datepicker {
        z-index:9999 !important;
    }
</style>