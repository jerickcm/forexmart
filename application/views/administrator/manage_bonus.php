<style>
    .DesignerInline{
        border-left: 1px solid #ccc;
    }
    .cancel-holder .cancel-compose {
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 10px 50px;
        border: medium none;
        transition: all 0.3s ease 0s;

        display: none;
    }
</style>

<?=$sidebar;?>
<div class="col-lg-9 col-md-9 col-sm-9 DesignerInline">
    <div class="section">
        <div class="table-responsive mail-tab-holder">
            <div class="col-sm-12 compose-switch-holder">
                <label>
                    Manually open No Deposit Bonus tab of clients by entering their account number below
                </label>
                <div class="col-sm-6">
                    <input name="accountnumberholder" class="form-control round-0 compose-text" placeholder="Account Number" type="text">
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn-add compose-text">Open</button>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="activateAN" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Open New Deposit Bonus Tab
                </h4>

            </div>
            <div class="modal-body">
                <p>You are about to open the No Deposit Bonus tab of the following account</p>
                <p><strong>Accout Number:</strong> <span name="accountnumber"></span></p>
                <p><strong>Client's Name:</strong> <span name="fullname"></span></p>
                <p>Do you want to continue?</p>

            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" class="btn btn-default round-0 buttonresetndb">Ok</button>
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="activateDone" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Open New Deposit Bonus Tab
                </h4>

            </div>
            <div class="modal-body">
                <p><strong>Accout Number:</strong> <span name="accountnumber"></span></p>
                <p><strong>Client's Name:</strong> <span name="fullname"></span></p>
                <p>Client has been reopened to No deposit bonus tab</p>

            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="isAlreadyOpened" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Open New Deposit Bonus Tab
                </h4>

            </div>
            <div class="modal-body">
                <p><strong>Accout Number:</strong> <span name="accountnumber"></span></p>
                <p><strong>Client's Name:</strong> <span name="fullname"></span></p>
                <p>Client can only be reoponed once.</p>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var site_url="<?=FXPP::loc_url('')?>";
    var pblc = [];
    pblc['request'] = null;
    if(pblc['request'] != null) pblc['request'].abort();

    $(document).on("click", ".buttonresetndb", function () {
        $('#activateAN').modal('hide');


        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            AccountNumber:  $('input[name=accountnumberholder]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/ndb_resetdate",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if (data.update==true){
                $('#activateDone').modal('show');
            }else{
                if(data.isAlreadyOpened==true){
                    $('#isAlreadyOpened').modal('show');
                }
            }
            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });
    });
    $(document).on("click", ".btn-add", function () {

        $('#activateAN').modal('show');

        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            AccountNumber:  $('input[name=accountnumberholder]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/ndb_query",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $('span[name=fullname]').html('');
            $('span[name=accountnumber]').html('');
            $('span[name=fullname]').html(data.fullname);
            $('span[name=accountnumber]').html(data.accountnumber);
            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();

        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });

    });

</script>