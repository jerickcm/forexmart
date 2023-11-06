<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <?= $this->load->view('administrator/AV_tabs', NULL, TRUE);?>
        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab4">
                <div class="col-md-12">
                    <p>
                        When a client sends documents via email, please upload them here.
                    </p>
                    <form class="form-inline acc-num-holder">
                        <div class="form-group">
                            <label for="">Enter account number:</label>
                            <input type="text" class="form-control round-0 accntnum" id="accntnum" name="accntnum" />
                        </div>
                    </form>
                </div>
                <div class="row file-up-holder step1-2">
                    <div class="col-md-1">
                        <span class="up-file-step">1</span>
                    </div>
                    <div class="col-md-3">
                        <form method="POST" id="front-id" enctype="multipart/form-data" class="uploadimage form-inline">
                            <div id="front-id" class="docs-id" style="display:none"></div>
                            <input type="hidden" value="0" name="doc_type"/>
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
                            <input type="hidden" value="1" name="doc_type"/>
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
                            <input type="hidden" value="2" name="doc_type"/>
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

        var forexmart = "<?php echo FXPP::ajax_url();?>";

        $(".uploadimage").on('submit',(function(e) {
            e.preventDefault();
            var id = this.id;
            $('div#'+id).show();
            $('div#'+id).html('<div class="alert alert-info">Uploading file. Please wait...</div>');
            $.ajax({
                type: 'POST',
                url: forexmart+'account-verification/upload-documents/'+$.now(),
                dataType: 'json',
                data: new FormData(this),
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false        // To send DOMDocument or non processed data file it is set to false
            }).done(function(response){
                if(response.error){
                    if(response.msgError === '<p>The filetype you are attempting to upload is not allowed.</p>'){
                        var rtnError = 'The file type you are attempting to upload is not allowed. The format should be in <strong>pdf</strong>,  <strong>gif</strong>, <strong>jpg</strong>, or <strong>png</strong>.';
                    }else{
                        var rtnError = response.msgError;
                    }
                    $('div#'+id).html('<div class="alert alert-danger">'+rtnError+'</div>');
                }else{
                    $('div#'+id).html('<div class="alert alert-success">The file was uploaded successfully.</div>');
                }
            });
        }));

        $( ".btn-uploadsave" ).click(function() {

//            $( "form#front-id" ).submit();
//            $( "form#back-id" ).submit();
//            $( "form#proof-residence" ).submit();
            var pblc = [];
            var prvt = [];
            $('#loader-holder').show();
            prvt["data"] = {
                account_number: $('input[name=accntnum]').val()
            };

            pblc['request'] = $.ajax({
                dataType: 'json',
                url: forexmart+'account-verification/save',
                method: 'POST',
                data: prvt["data"]
            });
            pblc['request'].done(function( data ) {
                $('#loader-holder').hide();

                if (data.empty==true ){

                    $('div#docsave').show();
                    $('div#docsave').html('<div class="alert alert-info">* Account number is required.</div>');
                }
                if (data.verified=='true' ){
                    if ( data.error1=='false'){

                        $('div#docsave').show();
                        $('div#docsave').html('<div class="alert alert-success"> Account is now in Verified Tab</div>');
                    }
                }else{
                    if ( data.error1=='true'){

                        $('div#docsave').show();
                        $('div#docsave').html('<div class="alert alert-danger">* API Webservice error.</div>');
                    }
                    if ( data.error1=='false'){

                        $('div#docsave').show();
                        $('div#docsave').html('<div class="alert alert-info"> Account is now in Pending Tab.</div>');
                    }
                }
                if (data.type=='partner' ){
                    $('div#docsave').show();
                    if (data.location=='1' ){
                        $('div#docsave').html('<div class="alert alert-info"> Account is now  in Verified Tab.</div>');
                    }else if(data.location=='2' ){
                        $('div#docsave').html('<div class="alert alert-info"> Account is now  in Declined Page.</div>');
                    }else{
                        $('div#docsave').html('<div class="alert alert-info"> Account is now  in Pending Page.</div>');
                    }

                }
                if (data.type=='invalid' ){
                    $('div#docsave').show();
                    $('div#docsave').html('<div class="alert alert-info">* Invalid account number.</div>');
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


</script>
