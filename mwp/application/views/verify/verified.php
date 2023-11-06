
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0!important;
        margin-left:  0!important;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        color: #333 !important;
        border: 1px solid #fff;
        border-radius: 2px;
    }
    .dataTables_paginate .paginate_button:hover {
        border:1px solid #fff!important;
    }
    .pagination {
        margin-top: 3%!important;
    }
</style>
<script type="text/javascript">
    $(window).load(function(){
        $("#check-phone-password").find(".paginate_button").css('margin-left', '0px');
        $("#check-phone-password").find(".paginate_button").css('padding', '0px');
    });
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>

<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Check query</h1>
        <!--<div class="tab-search-bar">
            <input type="text" class="tab-input-form" placeholder="Type here..."/>
            <button type="submit" class="tab-input-button green-input-button go-button">Go</button>
        </div>-->
    </div>

    <?= $this->load->view('verify/AV_tabs', NULL, TRUE);?>



    <div  class="table-container-holder table-container-border table-container-margin data-center-container" style="margin-top: 65px;">
        <table id="table" name="AccountsTable" class="table table-striped queue-tab">
            <thead>
            <tr>
                <th><?= lang('acct-ds');?></th>
                <!-- <th><?/*= lang('acct-e');*/?></th>-->
                <th><?= lang('acct-nu');?></th>
                <th><?= lang('acct-fn');?></th>
                <th>Fb/Vk/Phone Number</th>
                <th>Group</th>
                <th>Action</th>


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

<div style="clear: both"></div>
<script>
    oTable=  $("#table").DataTable();

    $(document).on('click',"#do",function(){
        $(".table-container-holder").show();
        oTable.search($("#myInputTextField").val()).draw() ;
    })

    $('#myInputTextField').keyup(function(){
        oTable.search($(this).val()).draw() ;
    })

    $(document).on('click',"input[type='checkbox']",function(){
        var cls = $(this).attr('rel')
        if($(this).is(':checked')){

            $('table .'+cls).show();
        }else{
            $('table .'+cls).hide();
        }

        console.log(cls);

    })

    $("#all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

</script>
<style>
    .dataTables_wrapper{
        clear: none!important;
    }
    table.dataTable{
        clear: none!important;
    }
    table.dataTable select{
        padding: 6px 6px!important;
    }
    .dataTables_wrapper .dataTables_info{
        clear: none!important;
    }
    /* #table th{display: none}
     #table td{display: none}*/



    .settings-tab
    {
        width: 100%;
        margin-top: 20px;
    }
    .settings-tab ul
    {
        list-style: none;
        padding: 0;
        margin-bottom: 0!important;
        border-bottom: 1px solid  #dfdfdf;
    }
    .settings-tab ul li
    {
        padding: 0;
        float: left;
        background-color: #0a9ccc;
    }
    .settings-tab ul li a
    {
        display: block;
        padding: 10px 20px;
        font-family: Open Sans;
        font-size: 14px;
        color: #333;
        transition: all ease 0.3s;
    }
    .active-set-tab
    {
        color: #fff!important;
        background: #2988CA!important;
        text-decoration: none;
    }

    .settings-tab ul li a:hover, .settings-tab ul li a:focus
    {
        text-decoration: none;
        background: #2988CA;
        color: #fff;
        transition: all ease 0.3s;
    }
</style>
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

<div class="modal fade" id="verifiedStat" tabindex="-1" role="dialog" aria-labelledby="">
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
                    <div class="col-sm-6 rght">
                        <button type="button" id="gotoDeclined" name="gotoDeclined" class="todecline btn-force">Move to Declined tab</button>
                        <button type="button" id="gotoVerified" name="gotoVerified" class="toverified btn-force">Move to Verified tab</button>

                    </div>
                </div>
                <div class="settings-tab">
                    <ul role="tablist" class="queue-tab-list">
                        <li role="presentation"><a href="#acctab3" aria-controls="tab1" role="tab" data-toggle="tab" id="v-st" class="active-set-tab"><?= lang('frstdoc');?></a></li>
                        <li role="presentation"><a href="#acctab4" aria-controls="tab2" role="tab" data-toggle="tab" id="v-nd"><?= lang('secdoc');?></a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="tab-content acct-cont admin-tab-cont">
                    <div role="tabpanel" class="row tab-pane active" id="acctab3">
                        <div class="table-responsive">
                            <table class="table table-striped queue-tab">
                                <thead>
                                <tr>
                                    <th><?= lang('modal_fn1');?></th>
                                    <th><?= lang('modal_fn2');?>  - ( View )</th>
                                    <th><?= lang('modal_fn3');?></th>
                                    <th>Date Declined | Approved</th>
                                    <th><?= lang('modal_upt');?></th>
                                </tr>
                                </thead>
                                <tbody class="firstdocument">
                                <?= $FD?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div role="tabpanel" class="row tab-pane" id="acctab4">
                        <div class="table-responsive">
                            <table class="table table-striped queue-tab">
                                <thead>
                                <tr>
                                    <th><?= lang('modal_fn1');?></th>
                                    <th><?= lang('modal_fn2');?> - ( View )</th>
                                    <th><?= lang('modal_fn3');?></th>
                                    <th>Date Declined | Approved</th>
                                    <th><?= lang('modal_upt');?></th>
                                </tr>
                                </thead>
                                <tbody class="seconddocument">
                                <?= $SD?>
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
<style type="text/css">/*  Tue, 12 Apr 2016 12:37:29 +0000 */.default-c{background-color:#d3d3d3;border-color:#d3d3d3}.default-c:hover{background-color:#d3d3d3;border-color:#d3d3d3}.displayn{display:none}.mybutton{background-color:Transparent;background-repeat:no-repeat;border:none;cursor:pointer;overflow:hidden;outline:none}div.bg-danger{background-color:#f2dede;padding:5px;font-size:12px;color:rgb(174,21,21)!important;text-align:center;border:1px solid;margin:20px}div.bg-danger p{margin:10px!important;text-align:center!important;font-size:12px!important;color:rgb(174,21,21)!important;line-height:17px}.padMAS{padding:2% 5%}.padMASform{padding:0 3%}.btnRotate{margin:2px;padding:5px 10px;background-color:#09F;border:0;color:#FFF;cursor:pointer}.imgr{text-align:left!important}.curp{cursor:pointer}</style>

<script type="text/javascript">
var site_url="<?=site_url('')?>";
var maintable;
//$.fn.dataTable.moment( 'YYYY-MMM-DD HH:mm:ss' );
$('#loader-holder').show();
$(window).load(function() {
    $('#loader-holder').hide();
});

$(document).ready(function() {

    maintable = $('#AccountsTable').DataTable( {
        searchDelay: 2000,
        "fnDrawCallback": function( oSettings ) {
            $('#loader-holder').hide();
        },
        "processing": true,
        "serverSide": true,
        stateSave: true,

        "ajax": {
            "url": site_url+"account-verification/get-verified",
            "type": "POST",
            "beforeSend": function (xhr, opts) {
                $('#loader-holder').show();
            },
            "timeout": 15000, // optional if you want to handle timeouts (which you should)
            "error": handleAjaxError // this sets up jQuery to give me errors
        },
        "columns": [
            { "data": "date_submitted" },
            { "data": "account_email" },
            { "data": "partner_type" },
            { "data": "account_number" },
            { "data": "full_name" },
            { "data": "country" },
            { "data": "action" }
        ]
    } );
    function handleAjaxError( xhr, textStatus, error ) {
        $('#loader-holder').hide();
        if ( textStatus === 'timeout' ) {
            alert( 'The server took too long to send the data.' );
        }
        else {
            alert( 'An error occurred on the server. Please try again in a minute.' );
        }
        $('#AccountsTable').fnProcessingIndicator( false );
    }
    jQuery.fn.dataTableExt.oApi.fnProcessingIndicator = function ( oSettings, onoff ) {
        if ( typeof( onoff ) == 'undefined' ) {
            onoff = true;
        }
        this.oApi._fnProcessingDisplay( oSettings, onoff );
    };
} );
var moveaccountname= false;
var moveDeclinedAccount= false;
function UpdateRequest(){
    $('#loader-holder').show();
    var prvt = [];
    prvt["data"] = {
        userid: $('.myuserid').html()
    };

    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url+"account-verification/AV_Verified_updaterequest",
        method: 'POST',
        data: prvt["data"]
    });

    pblc['request'].done(function( data ) {
//            var table = $('#AccountsTable').DataTable();
//            table.destroy();
//            $('#request').html(data.request);
//
//            $('#AccountsTable').DataTable({
//                    "order": [[ 0, "desc" ]],stateSave: true}
//            );
        maintable.draw();
        $('.firstdocument').html(data.fd);
        $('.seconddocument').html(data.sd);

        var useridP = $('.myuserid').html();
        $(".tr"+useridP+"").removeClass('displayn');
        $("#changestatus").attr('disabled' , true);
        $('#loader-holder').hide();
        if(moveaccountname){
            $('#verifiedStat').modal('hide');
            $('#Verified').modal('show');
            moveaccountname = false;
        }
        if(moveDeclinedAccount){
            $('#verifiedStat').modal('hide');
            $('#Dec').modal('show');
            moveDeclinedAccount = false;
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

    $('#AccountsTable').DataTable({
            "order": [[ 0, "desc" ]],stateSave: true}
    );
});
$(document).on("click", ".hitdisplay", function () {

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
    $("#t3").addClass("active-set-tab");
});
//    modal decline document
$(document).on("click", ".modal-nth-decline", function () {
    var Id = $(this).data('id');
    $("#DocId").val(Id);
    $("#location").val('accountverification_verifieddocuments');
    $('#verifiedStat').modal('hide');

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
$(document).on("click", ".verified-nth-decline", function () {
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
        select: 2
    };
    pblc['request'] = $.ajax({
        dataType: 'json',
        url: site_url+"account-verification/"+uri,
        method: 'POST',
        data: prvt["data"]
    });

    pblc['request'].done(function( data ) {
        UpdateRequest();
        $('#loader-holder').hide();
    });

    pblc['request'].fail(function( jqXHR, textStatus ) {
        $('#loader-holder').hide();

    });

    pblc['request'].always(function( jqXHR, textStatus ) {
        $('#loader-holder').hide();
    });
});

$(document).on("click", ".verified", function () {

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
        url: site_url+"account-verification/Pending_doc",
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
        if($("#selectaction").val()=='1'){
            $("#changestatus").addClass('default-c');
            $("#changestatus").attr('disabled' , true);
        }
    });
});


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
                SelectReason: $('select[name=SelectReason]').val(),
                SelectReasons: $('select[name=SelectReasons]').val(),
                location: $('input[name=location]').val(),
                DocId:$('input[name=DocId]').val(),
                explanation:$('textarea[name=explanation]').val(),
                explanations:$('textarea[name=explanations]').val()
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url:form.action,
                method: 'POST',
                data: prvt["data"],
            });

            pblc['request'].done(function( data ) {

                $('#popAccountVerificationDecline').modal('hide');
                $('#verifiedStat').modal('show');
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
                SelectReason: $('select[name=SelectReason]').val(),
                SelectReasons: $('select[name=SelectReasons]').val(),
                location: $('input[name=location]').val(),
                DocId:$('input[name=DocId]').val(),
                explanation:$('textarea[name=explanation]').val(),
                explanations:$('textarea[name=explanations]').val()
            };
            pblc['request'] = $.ajax({
                dataType: 'json',
                url:form.action,
                method: 'POST',
                data: prvt["data"],
            });

            pblc['request'].done(function( data ) {

                $('#popAccountVerificationDecline').modal('hide');
                $('#verifiedStat').modal('show');
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
    $('#verifiedStat').modal('show');
});
$(document).on("click", ".declinedsingle", function () {
    $('#loader-holder').show();
    $('#verifiedStat').modal('hide');
    var id = $(this).data('id');
    var prvt = [];
    prvt["data"] = {id: id};
    pblc['request'] = $.ajax({

        dataType: 'json',
        url: site_url+"account-verification/avdeclinednotessingle",
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
<!--jira FXPP-1883 move decline move verified-->
<?= $this->load->ext_view('modal', 'av_move', '', TRUE); ?>


<script src='<?php echo  $this->template->Js() ?>jquery.dataTables.min.js'></script>
<script src='<?php echo  $this->template->Js() ?>moment.min.js'></script>
<script src='<?php echo  $this->template->Js() ?>datetime-moment.min.js'></script>
<script src='<?php echo  $this->template->Js() ?>dataTables.bootstrap.min.js'></script>
<script src='<?php echo  $this->template->Js() ?>jquery.validate.min.js'></script>

<script type="text/javascript">
$(function(){
    $('#button-search').click(function(){
        var search = $('#text-box-search').val();
        $.ajax({
            'url' : site_url+'verify/search_verified',
            'type' : 'POST',
            'data' : {search:search}
        }).done(function(response){
            // $.each(response,function(i,index){
            //     $('#table').append('<tr><td>'+response.account_number+'</td></tr>');
            //     $('#table').append('<tr><td>'+response.date_created+'</td></tr>');
            // });
        });
    });
});

</script>
