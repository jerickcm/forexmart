
<style>
    .default-c{
        background-color: #d3d3d3;
        border-color: #d3d3d3;
    }
    .default-c:hover{
        background-color: #d3d3d3;
        border-color: #d3d3d3;
    }
    .displayn{
        display: none;
    }
    .mybutton {
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
    }
    .centroid{
        margin:auto;
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
        margin: 10px 10px!important;
        text-align: center !important;
        font-size: 12px !important;
        color: rgb(174, 21, 21) !important;
        line-height: 17px;
    }
    .padMAS{
        padding: 2% 5%;
    }
    .padMASform{
        padding: 0% 3%;
    }
    .btnRotate {margin:2px;padding: 5px 10px;background-color: #09F;border: 0;color: #FFF;cursor: pointer;}
    .imgr{text-align: left!important;}
    .curp{cursor:pointer}
</style>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <?= $this->load->view('administrator/AV_tabs', NULL, TRUE);?>
        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab1">
                <div class="table-responsive col-md-12">
                    <table id="AccountsTable" name="AccountsTable" class="table table-striped queue-tab">
                        <thead>
                        <tr>
                            <th><?= lang('acct-ds');?></th>
                            <th class="display-n"><?= lang('acct-e');?></th>
                            <th><?= lang('acct-nu');?></th>
                            <th><?= lang('acct-fn');?></th>
                            <th><?= lang('acct-ipa');?></th>
                            <th><?= lang('acct-a');?></th>
                        </tr>
                        <tr>

                        </tr>
                        </thead>

                        <tbody id="request">
                        <?= $request?>
                        </tbody>

                    </table>
                </div>
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<div class="modal fade" id="declineSingle" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Decline Note
                </h4>
            </div>
            <div class="modal-body">
                <table id="declinedtable_single" class="table table-striped queue-tab">
                    <thead>
                    <tr>
                        <th>Document</th>
                        <th>File</th>
                        <th>Decline Reason</th>
                        <th>Explanation</th>
                    </tr>

                    </thead>
                    <tbody id="s_t_reason">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 Mainmodal">Back</button>
            </div>
        </div>
    </div>
</div>

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
                Verified account is moved <a href="<?= $this->config->item('domain-www');?>/administration/accountverification-verified-documents" >here</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pendingStat" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <?= lang('acct-mandoc');?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div id="validations" class="bg-danger displayn">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-horizontal">
                            <div class="form-group acct-grp">
                                <label for="" class="col-sm-5 control-label acct-lbl"><?= lang('an');?></label>
                                <div class="col-sm-7">
                                    <p class="acct-val myuserid display-n"></p>
                                    <p class="acct-val accountnumber"></p>
                                </div>
                            </div>
                            <div class="form-group acct-grp">
                                <label for="" class="col-sm-5 control-label acct-lbl">Account Type</label>
                                <div class="col-sm-7">
                                    <p class="acct-val accounttype "></p>
                                </div>
                            </div>
                            <div class="form-group acct-grp">
                                <label for="" class="col-sm-5 control-label acct-lbl"><?= lang('fn');?></label>
                                <div class="col-sm-7">
                                    <p class="acct-val fullname"></p>
                                </div>
                            </div>
                            <div class="form-group acct-grp">
                                <label for="" class="col-sm-5 control-label acct-lbl"><?= lang('Em');?></label>
                                <div class="col-sm-7">
                                    <p class="acct-val email"></p>
                                </div>
                            </div>
                            <div class="form-group acct-grp">
                                <label for="" class="col-sm-5 control-label acct-lbl"><?= lang('Addr');?></label>
                                <div class="col-sm-7">
                                    <p class="acct-val address"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
                <div class="settings-tab">
                    <ul role="tablist" class="queue-tab-list">
                        <li role="presentation"><a href="#acctab1" aria-controls="tab1" role="tab" data-toggle="tab" id="st" class="active-set-tab"><?= lang('frstdoc');?></a></li>
                        <li role="presentation"><a href="#acctab2" aria-controls="tab2" role="tab" data-toggle="tab" id="nd"><?= lang('secdoc');?></a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="tab-content acct-cont admin-tab-cont">
                    <div role="tabpanel" class="row tab-pane active" id="acctab1">
                        <div class="table-responsive">
                            <table class="table table-striped queue-tab">
                                <thead>
                                <tr>
                                    <th><?= lang('modal_fn1');?></th>
                                    <th><?= lang('modal_fn2');?> - ( View ) </th>
                                    <th><?= lang('modal_fn3');?></th>
                                    <th>Date Declined | Approved</th>
                                    <th><?= lang('modal_actn');?></th>
                                </tr>
                                </thead>
                                <tbody class="firstdocument">

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div role="tabpanel" class="row tab-pane" id="acctab2">
                        <div class="table-responsive">
                            <table class="table table-striped queue-tab">
                                <thead>
                                <tr>
                                    <th><?= lang('modal_fn1');?></th>
                                    <th><?= lang('modal_fn2');?> - ( View ) </th>
                                    <th><?= lang('modal_fn3');?></th>
                                    <th>Date Declined | Approved</th>
                                    <th><?= lang('modal_actn');?></th>
                                </tr>
                                </thead>
                                <tbody class="seconddocument">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end modal -->
<script type="text/javascript">
    $('#loader-holder').show();

    $(window).load(function() {
        $('#loader-holder').hide();
    });


    var site_url="<?=FXPP::loc_url('')?>";
    var moveaccountname= false;
    function UpdateRequest(){
        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            userid: $('.myuserid').html()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/AV_updaterequest",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            var table = $('#AccountsTable').DataTable({
                    stateSave: true}
            );
            table.destroy();
            $('#request').html(data.request);
            $.fn.dataTable.moment( 'YYYY-MMM-DD' );
            $('#AccountsTable').DataTable({
                    "order": [[ 0, "desc" ]]}
            );
            $('.firstdocument').html(data.fd);
            $('.seconddocument').html(data.sd);


            var useridP = $('.myuserid').html();
            $(".tr"+useridP+"").removeClass('displayn');
            $("#changestatus").attr('disabled' , true);
            $('#loader-holder').hide();
            if(moveaccountname){
                $('#pendingStat').modal('hide');
                $('#Verified').modal('show');
                moveaccountname=false;
            }
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });
        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
        });
    }


    $(document).ready(function() {
        $.fn.dataTable.moment( 'YYYY-MMM-DD' );
        $('#AccountsTable').DataTable({
            "order": [[ 0, "desc" ]],
            stateSave: true
        });
    });
    $(document).on("click",".hitdisplay", function () {

        var target = $(this).data('target');
        var id = $(this).data('id');
        $(target).on("hide.bs.collapse", function(){
            $("#spn"+id+"").addClass("glyphicon-plus");
            $("#spn"+id+"").removeClass("glyphicon-minus");
            if(!$(".tr1").hasClass("displayn")){
                $(".tr1").addClass("displayn");
                $(".tr2").addClass("displayn");
            }


        });
        $(target).on("show.bs.collapse", function(){

            $("#spn"+id+"").addClass("glyphicon-minus");
            $("#spn"+id+"").removeClass("glyphicon-plus");
            $(".tr1").removeClass("displayn");
            $(".tr2").removeClass("displayn");

        });
    });

    $(window).load(function(){
        $("#t1").addClass("active-set-tab");
    });
    //    modal decline document
    $(document).on("click", ".modal-nth-decline", function () {
        var Id = $(this).data('id');
        $("#DocId").val(Id);
        $("#location").val('accountverification');
        $('#pendingStat').modal('hide');

        var type = $(".modal-body .accounttype").text();
        if (type=='Client'){
            $('.declineClient').removeClass('display-n');
            if (!$('.declineAffiliate').hasClass('display-n')){
                $('.declineAffiliate').addClass('display-n');
            }
        }else{
            $('.declineAffiliate').removeClass('display-n');

            if (!$('.declineClient').hasClass('display-n')){
                $('.declineClient').addClass('display-n');
            }

        }

    });
    //    modal decline document
    $(document).on("click", ".request-nth-approve", function () {
        $('#loader-holder').show();

        var type = $(".modal-body .accounttype").text();
        if (type=='Client'){
            var uri='documentverificationchangestatus';
        }else{
            var uri='documentverificationchangestatus_aff';
        }

        var Id = $(this).data('id');
        var prvt = [];
        prvt["data"] = {
            id: Id,
            select: 1
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/"+uri,
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


    $(document).on("click", ".request", function () {

        $('#loader-holder').show();

        $(".collapse").removeClass('in');
        $(".allglip").addClass("glyphicon-plus");
        $(".allglip").removeClass("glyphicon-minus");

        var accountnumber = $(this).data('accountnumber');
        var userid = $(this).data('userid');
        var Id = $(this).data('id');
        var fullname = $(this).data('fullname');
        var email = $(this).data('email');
        var address = $(this).data('address');
        var type = $(this).data('type');
        $(".modal-body .accounttype").text( type );
        $(".modal-body .myuserid").text( userid );
        $(".modal-body .accountnumber").text( accountnumber );
        $(".modal-body .fullname").text( fullname );
        $(".modal-body .email").text( email );
        $(".modal-body .address").text( address );
        $("#changestatus").addClass('default-c');

        $("#myuserid").val(userid);

        $("#tr"+Id+"").removeClass('displayn');

        $(".tr"+userid+"").removeClass('displayn');

        $("#changestatus").attr('disabled' , true);


        $('.seconddocument').html('');
        $('.firstdocument').html('');
        var prvt = [];
        prvt["data"] = {
            userid: userid
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/Pending_doc",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $('.seconddocument').html(data.sd);
            $('.firstdocument').html(data.fd);
            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();

        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();

        });

    });

    $(document).ready( function (){
        $('#selectaction').bind('click', function(){
            $("#changestatus").removeClass('default-c');
            $("#changestatus").attr('disabled' , false);

            if($("#selectaction").val()=='2'){
                $("#changestatus").addClass('default-c');
                $("#changestatus").attr('disabled' , true);
            }

        });
    });

</script>
<script type="text/javascript">



    var pblc = [];

    pblc['request'] = null;
    pblc['FormChangeStatus'] = null;

    $( document ).ready(function() {
        $("#st").click(function(){
            $("#st").addClass("active-set-tab");
            $("#nd").removeClass("active-set-tab");
        });
        $("#nd").click(function(){
            $("#nd").addClass("active-set-tab");
            $("#st").removeClass("active-set-tab");
        });
        $("#v-st").click(function(){
            $("#v-st").addClass("active-set-tab");
            $("#v-nd").removeClass("active-set-tab");
        });
        $("#v-nd").click(function(){
            $("#v-nd").addClass("active-set-tab");
            $("#v-st").removeClass("active-set-tab");
        });
        $("#d-st").click(function(){
            $("#d-st").addClass("active-set-tab");
            $("#d-nd").removeClass("active-set-tab");
        });
        $("#d-nd").click(function(){
            $("#d-nd").addClass("active-set-tab");
            $("#d-st").removeClass("active-set-tab");
        });
        $("#i-st").click(function(){
            $("#i-st").addClass("active-set-tab");
            $("#i-nd").removeClass("active-set-tab");
        });
        $("#i-nd").click(function(){
            $("#i-nd").addClass("active-set-tab");
            $("#i-st").removeClass("active-set-tab");
        });
    });


    $().ready(function() {
        var pblc = [];
        pblc['request'] = null;
        if(pblc['request'] != null) pblc['request'].abort();

        pblc['form_Schemedelete'] = null;
        pblc['form_Schemedelete'] = $('.form_Schemedelete').validate({
            ignore: [],
            rules:{

            },
            messages: {

            }, submitHandler: function(form) {

                $('#loader-holder').show();

                var prvt = [];
                prvt["data"] = {
                    SelectReasons: $('select[name=SelectReasons]').val(),
                    location: $('input[name=location]').val(),
                    DocId:$('input[name=DocId]').val(),
                    explanation:$('textarea[name=explanation]').val(),
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"],
                });

                pblc['request'].done(function( data ) {
                    $('#loader-holder').hide();
                    $('#popAccountVerificationDecline').modal('hide');
                    $('#pendingStat').modal('show');
                    UpdateRequest();

                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });

                pblc['request'].always(function( jqXHR, textStatus ) {

                });
            }
        });
    });

    $().ready(function() {
        var pblc = [];
        pblc['request'] = null;
        if(pblc['request'] != null) pblc['request'].abort();

        pblc['form_Schemedelete'] = null;
        pblc['form_Schemedelete'] = $('.form_SchemedeleteA').validate({
            ignore: [],
            rules:{

            },
            messages: {

            }, submitHandler: function(form) {

                $('#loader-holder').show();

                var prvt = [];
                prvt["data"] = {
                    SelectReasons: $('select[name=SelectReasons]').val(),
                    location: $('input[name=location]').val(),
                    DocId:$('input[name=DocId]').val(),
                    explanation:$('textarea[name=explanation]').val(),
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"],
                });

                pblc['request'].done(function( data ) {
                    $('#loader-holder').hide();
                    $('#popAccountVerificationDecline').modal('hide');
                    $('#pendingStat').modal('show');
                    UpdateRequest();

                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $('#loader-holder').hide();
                });

                pblc['request'].always(function( jqXHR, textStatus ) {

                });
            }
        });
    });

    $(document).on("click", ".Mainmodal", function () {
        $('#pendingStat').modal('show');
    });
    $(document).on("click", ".declinedsingle", function () {
        $('#loader-holder').show();
        $('#pendingStat').modal('hide');
        var id = $(this).data('id');
        var prvt = [];
        prvt["data"] = {id: id};
        pblc['request'] = $.ajax({

            dataType: 'json',
            url: site_url+"administration/avdeclinednotessingle",
            method: 'POST',
            data: prvt["data"]

        });
        pblc['request'].done(function( data ) {

            $('#s_t_reason').html(data.s_t_reason);
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
<script>
    function rotateImage(degree,id) {
        $('#'+id).animate({  transform: degree }, {
            step: function(now,fx) {
                $(this).css({
                    '-webkit-transform':'rotate('+now+'deg)',
                    '-moz-transform':'rotate('+now+'deg)',
                    'transform':'rotate('+now+'deg)'
                });
            }
        });
    }
</script>
<?= $this->load->ext_view('modal', 'AVdecline', '', TRUE); ?>
