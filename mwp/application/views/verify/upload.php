
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

    .row {
        margin-left: 0!important;
    }

    .btn-up-file {
        background: #29a643;
        border-radius: 0;
        transition: all ease .3s;
        border: none;
        padding: 7px 10px;
        color: #fff;
        margin-top: 10px;
        margin-right: 15px;
        margin-bottom: 10px;
    }

    .tab-line {
        border-top: 1px solid #ddd;
        margin-bottom: 30px;
        width: 60%;
    }
    .fa-question-circle {
        color: #337ab7;
        text-decoration: none;
    }

    /*AV-tabs style*/
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

        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab4">
                <div class="col-md-12">
                    <p>
                        When a client sends documents via email, please upload them here.
                    </p>
                    <form class="form-inline acc-num-holder">
                        <div class="form-group">
                            <label for="">Enter account number:</label>
                            <input type="text" class="form-control round-0 accntnum numeric" id="accntnum" name="accntnum" />
                        </div>
                    </form>
                </div>

                    <div class="modal fade" id="modal-alert3" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
                        <div class="modal-dialog round-0">
                            <div class="modal-content round-0">
                                <div class="modal-body modal-show-body">
                                    <div class="text-center manage-credit-prize-alert-message">
                                        <span style="font-size:18px;font-weight: bold;" id="error-msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row file-up-holder step1-2">
                    <div class="col-md-1">
                        <span class="up-file-step">1</span>
                    </div>
                    <div class="col-md-3">
                        <form method="POST" id="front-id" enctype="multipart/form-data" class="uploadimage form-inline">
                            <div id="front-id" class="docs-id" style="display:none"></div>
                            <?php $docnum=$corporate_account_status==0?0:3; ?>
                            <input type="hidden" value="<?=$docnum;?>" name="doc_type"/>
                            <input type="hidden" value="" name="account_number"/>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">File: </label>
                                <div class="col-sm-10">
                                    <input id="front" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                    <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="up-file-text"><span>*</span>Colour copy of passport or the front of the ID <a href="#"><i class="fa fa-question-circle"></i></a></p>
                    </div>
                </div>
                <div class="row file-up-holder step2-2">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">

                       <form method="POST" id="back-id" enctype="multipart/form-data" class="uploadimage form-inline">
                            <div id="back-id" class="docs-id" style="display:none"></div>
                           <?php $docnum1=$corporate_account_status==0?1:4; ?>
                           <input type="hidden" value="<?=$docnum1;?>" name="doc_type"/>
                           <input type="hidden" value="" name="account_number"/>
                           <input type="hidden" value="" name="account_number"/>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">File: </label>
                                <div class="col-sm-10">
                                    <input id="back" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                    <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="up-file-text"><span>*</span>Colour copy of the back of the ID <a href="#"><i class="fa fa-question-circle"></i></a></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tab-line"></div>
                </div>
                <div class="row file-up-holder step1-2">
                    <div class="col-md-1">
                        <span class="up-file-step">2</span>
                    </div>
                    <div class="col-md-3">
                        <form method="POST" id="proof-residence" enctype="multipart/form-data" class="uploadimage form-inline">
                            <div id="proof-residence" class="docs-id" style="display:none"></div>
                            <?php $docnum2=$corporate_account_status==0?2:5; ?>
                            <input type="hidden" value="<?=$docnum2?>" name="doc_type"/>
                            <input type="hidden" value="" name="account_number"/>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">File: </label>
                                <div class="col-sm-10">
                                    <input id="fileupload" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                    <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="up-file-text"><span>*</span>Proof of Residence <a href="#"><i class="fa fa-question-circle"></i></a></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tab-line"></div>
                </div>
                <?php if($corporate_account_status==1){?>
                    <div class="row file-up-holder step1-2">
                        <div class="col-md-1">
                            <span class="up-file-step">3</span>
                        </div>

                        <div class="col-md-3">
                            <form method="POST" id="cert_of_inc" enctype="multipart/form-data" class="uploadimage form-inline">
                                <div id="cert_of_inc" class="docs-id" style="display:none"></div>
                                <input type="hidden" value="6" name="doc_type"/>
                                <input type="hidden" value="" name="account_number"/>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File: </label>
                                    <div class="col-sm-10">
                                        <input id="fileupload" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                        <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6"><p class="up-file-text"><span>*</span>Certificate of Incorporation <a href="#"><i class="fa fa-question-circle"></i></a></p></div>
                    </div>
                    <div class="row file-up-holder step2-2">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3">

                            <form method="POST" id="cert_of_gs" enctype="multipart/form-data" class="uploadimage form-inline">
                                <div id="cert_of_gs" class="docs-id" style="display:none"></div>
                                <input type="hidden" value="7" name="doc_type"/>
                                <input type="hidden" value="" name="account_number"/>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File: </label>
                                    <div class="col-sm-10">
                                        <input id="back" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                        <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <p class="up-file-text"><span>*</span>Certificate of Good Standing  <a href="#"><i class="fa fa-question-circle"></i></a></p>
                        </div>
                    </div>
                    <div class="row file-up-holder step2-2">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3">
                            <form method="POST" id="cert_of_incumbency" enctype="multipart/form-data" class="uploadimage form-inline">
                                <div id="cert_of_incumbency" class="docs-id" style="display:none"></div>
                                <input type="hidden" value="8" name="doc_type"/>
                                <input type="hidden" value="" name="account_number"/>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File: </label>
                                    <div class="col-sm-10">
                                        <input id="back" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                        <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7"><p class="up-file-text"><span>*</span>Certificate of Incumbency ,or an official documents, Listing the directors in charge <a href="#"><i class="fa fa-question-circle"></i></a></p></div>
                    </div>
                    <div class="row file-up-holder step2-2">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3">
                            <form method="POST" id="cert_of_incumbency_shareholders" enctype="multipart/form-data" class="uploadimage form-inline">
                                <div id="cert_of_incumbency_shareholders" class="docs-id" style="display:none"></div>
                                <input type="hidden" value="9" name="doc_type"/>
                                <input type="hidden" value="" name="account_number"/>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File: </label>
                                    <div class="col-sm-10">
                                        <input id="back" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                        <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6"><p class="up-file-text"><span>*</span>Certificate of Incumbency ,or an official documents, Shareholders in charge <a href="#"><i class="fa fa-question-circle"></i></a></p></div>
                    </div>
                    <div class="row file-up-holder step2-2">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3">
                            <form method="POST" id="lafs" enctype="multipart/form-data" class="uploadimage form-inline">
                                <div id="lafs" class="docs-id" style="display:none"></div>
                                <input type="hidden" value="10" name="doc_type"/>
                                <input type="hidden" value="" name="account_number"/>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File: </label>
                                    <div class="col-sm-10">
                                        <input id="back" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                        <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6"><p class="up-file-text"><span>*</span>Last Audited financial statement <a href="#"><i class="fa fa-question-circle"></i></a></p></div>
                    </div>

                    <div class="row file-up-holder step2-2">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3">
                            <form method="POST" id="aam" enctype="multipart/form-data" class="uploadimage form-inline">
                                <div id="aam" class="docs-id" style="display:none"></div>
                                <input type="hidden" value="11" name="doc_type"/>
                                <input type="hidden" value="" name="account_number"/>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File: </label>
                                    <div class="col-sm-10">
                                        <input id="back" type="file" class="filestyle" data-buttonName="btn-primary" name="filename" placeholder="Choose File">
                                        <button class="btn-up-file"><i class="fa fa-upload"></i> Upload file</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6"><p class="up-file-text"><span>*</span>Article of Association & Memorandum <a href="#"><i class="fa fa-question-circle"></i></a></p></div>
                    </div>




                    <div class="col-md-12">
                        <div class="tab-line"></div>
                    </div>

                <?php }?>
                <div class="row file-up-holder step2-2">
                    <div class="col-md-6">
                        <p>
                            Clicking "Save" will add the account to appropriate tabs.<br>
                            If the account has already been verified in MT4, it will add record to "Verified" tab<br>
                            If the account has not yet been verified in MT4, it will add record to "Pending" tab
                        </p>
                    </div>
                    <div class="col-md-2">
                        <div class="btn-uploadsave-holder">
                            <button class="btn-uploadsave">Save</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div id="docsave" class="docs-id" style="display:none"></div>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
    }
    .up-file-step {
        font-family: Open Sans;
        font-size: 50px;
        font-weight: 600;
        color: #2988ca;
        margin-top: 0;
    }
    .acc-num-holder {
        margin-bottom: 30px;
        margin-top: 30px;
    }
    .file-up-holder {
        padding: 15px;
    }
    .btn-uploadsave {
        border: none;
        color: #fff;
        background: #2988ca;
        padding: 7px 40px;
        font-family: Open Sans;
        font-size: 14px;
        transition: all ease 0.3s;
    }
    .up-file-text span {
        color: #ff0000;
    }
    p.up-file-text{
        margin-top: 45px;
    }
    .btn-uploadsave-holder{
     margin-top:10px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.fa-question-circle').tooltip({title: "<p align='left' style='padding: 5px !important;'>Accepted file format are png, jpg, gif and bmp.</p>", html: true, placement: 'right'});

        var forexmart = "<?php echo FXPP::ajax_url();?>";

        $(".uploadimage").on('submit',(function(e) {
            e.preventDefault();
            var id = this.id;
            $('div#'+id).show();
            $('div#'+id).html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            $.ajax({
                type: 'POST',
                url: forexmart+'verify/upload-documents/'+$.now(),
                dataType: 'json',
                data: new FormData(this),
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false        // To send DOMDocument or non processed data file it is set to false
            }).done(function(response){
                if(response.error){
                    if( response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>' && response.msgError_ext===false){
//                        var rtnError = response.msgError;
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>,  <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    }else{
                        var rtnError = response.msgError;
                    }

                    $('div#'+id).html('<div class="alert alert-danger">'+rtnError+'</div>');
                }else{
                    console.log(response);
                    $('div#'+id).html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
        }));

        $( ".btn-uploadsave" ).click(function() {
            var pblc = [];
            var prvt = [];
            $('#loader-holder').show();
            prvt["data"] = {
                account_number: $('input[name=accntnum]').val()
            };

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: forexmart+'verify/save',
                method: 'POST',
                data: prvt["data"]
            });
            pblc['request'].done(function( data ) {
                $('#loader-holder').hide();

                if (data.empty==true ){
                    $('div#docsave').show();
                    $("#modal-alert3").modal('show');
                    $('#error-msg').html('Account number is required.');
                    $('#error-msg').css('color', 'red');
                }
                if (data.verified=='true' ){
                    if ( data.error1=='false'){
                        $('div#docsave').show();
                        $("#modal-alert3").modal('show');
                        $('#error-msg').html('Account is now in Verified Tab');
                        $('#error-msg').css('color', 'green');
                    }
                }else{
                    if ( data.error1=='true'){
                        $('div#docsave').show();
                        $("#modal-alert3").modal('show');
                        $('#error-msg').html('API Webservice error.');
                        $('#error-msg').css('color', 'red');
                    }
                    if ( data.error1=='false'){
                        $('div#docsave').show();
                        $("#modal-alert3").modal('show');
                        $('#error-msg').html('Account is now in Pending Tab.');
                        $('#error-msg').css('color', 'green');
                    }
                }
                if (data.type=='partner' ){
                    $('div#docsave').show();
                    $("#modal-alert3").modal('show');
                    if (data.location=='1' ){
                        $('#error-msg').html('Account is now  in Verified Tab.');
                        $('#error-msg').css('color', 'green');
                    }else if(data.location=='2' ){
                        $('#error-msg').html('Account is now  in Declined Page.');
                        $('#error-msg').css('color', 'green');
                    }else{
                        $('#error-msg').html('Account is now  in Pending Page.');
                        $('#error-msg').css('color', 'green');
                    }

                }
                if (data.type=='invalid' ){
                    $('div#docsave').show();
                    $("#modal-alert3").modal('show');
                    $('#error-msg').html('Invalid account number.');
                    $('#error-msg').css('color', 'red');
                }
            });
            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
            });


        });
    });

    $(document).on({
        change: function () {
            $('input[name=account_number]').val(this.value);
            $('div#docsave').hide();
        },
        keydown: function () {
            $('input[name=account_number]').val(this.value);
            $('div#docsave').hide();
        },
    }, '.accntnum');
    $(document).on({
        change: function () {
            $('div#front-id').hide();
        },
        click: function () {
            $('div#front-id').hide();
            $('div#docsave').hide();
        },
    }, '#front');
    $(document).on({
        change: function () {
            $('div#back-id').hide();
        },
        click: function () {
            $('div#back-id').hide();
            $('div#docsave').hide();
        },
    }, '#back');
    $(document).on({
        change: function () {
            $('div#proof-residence').hide();
        },
        click: function () {
            $('div#proof-residence').hide();
            $('div#docsave').hide();
        },
    }, '#fileupload');

    $(document).ready(function (e) {
        //console.log(e);
        jQuery(".numeric").on("keypress keyup blur",function (event) {
            //console.log(event);
            if ((event.which != 8 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        jQuery(".numeric").on("blur",function (event) {
            var value=$(this).val().replace(/[^0-9.,]*/g, '');
            value=value.replace(/\.{2,}/g, '.');
            value=value.replace(/\.,/g, ',');
            value=value.replace(/\,\./g, ',');
            value=value.replace(/\,{2,}/g, ',');
            value=value.replace(/\.[0-9]+\./g, '.');
            $(this).val(value)
        });
    });
</script>
