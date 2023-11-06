
<div class="modal fade" id="Verified" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Manage Document
                </h4>
            </div>
            <div class="modal-body">
                Account is Verified.
                Verified account is moved <a href="<?= $this->config->item('domain-m7');?>/account-verification/av-verified" >here</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Dec" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Manage Document
                </h4>
            </div>
            <div class="modal-body">
                Account is Declined.
                Declined account is moved <a href="<?= $this->config->item('domain-m7');?>/account-verification/av-declined" >here</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var prvt = [];
    $(document).on("click", ".todecline", function () {
        $('#loader-holder').show();

        var accountnumber = $(".modal-body .accountnumber").text();
        var userid =  $(".modal-body .myuserid").text();
        console.log(accountnumber);
        console.log(userid);
        prvt["data"] = {
            accountnumber: accountnumber,
            userid: userid,
        };

        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"Account_verification/declined",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if(data.move){
                moveDeclinedAccount=true;
            }
            $('#loader-holder').hide();
            if (data.error!=""){

            }
            UpdateRequest();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();

        });

        pblc['request'].always(function( jqXHR, textStatus ) {

        });
    });

    $(document).on("click", ".toverified", function () {
        $('#loader-holder').show();

        var accountnumber = $(".modal-body .accountnumber").text();
        var userid =  $(".modal-body .myuserid").text();
        var type = $(".modal-body .accounttype").text();
        if (type=='Client'){
            uri='verified';
        }else{
            uri='verified_aff';
        }
        console.log(accountnumber);
        console.log(userid);
        prvt["data"] = {
            accountnumber: accountnumber,
            userid: userid
        };


        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"Account_verification/"+uri,
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if(data.move){
                moveaccountname=true;
            }
            $('#loader-holder').hide();
            if (data.error!=""){

            }
            UpdateRequest();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();

        });

        pblc['request'].always(function( jqXHR, textStatus ) {

        });
    });
</script>