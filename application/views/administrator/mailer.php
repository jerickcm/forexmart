<style>
    .cstm_fields{
        height: 55px;
        margin-bottom: 8px;
    }
    #markItUp{
        width:100%!important;
    }
    .markItUp{
        width:100%!important;
    }
    label.error{
        color:red;
    }
    label#markItUp-error{
        font: 14px Helvetica Neue,Helvetica,Arial,sans-serif !important;
        color: red;
        font-weight: 700 !important;
    }
    .markItUpEditor{
        background: none!important;
    }
    .cstm_fields_txtarea{
        margin-top: 15px;
    }
    .DesignerInline{
        border-left: 1px solid #ccc;
    }
    .cancel-holder .cancel-compose {
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 2px 14px;
        border: medium none;
        transition: all 0.3s ease 0s;

        display: none;
    }
    .update-compose-holder{
        display: none;text-align: right;
    }

    .btn-cancel{
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 10px 50px;
        border: medium none;
        transition: all 0.3s ease 0s;
        margin: 2px;
    }
    .btn-update{
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 10px 50px;
        border: medium none;
        transition: all 0.3s ease 0s;
        margin: 2px;
    }
    a.btn-cancel:hover{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-cancel:link{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-cancel:visited{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-cancel:active{
        color: #FFF;
        text-decoration: none;
    }

    a.btn-update:hover{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-update:link{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-update:visited{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-update:active{
        color: #FFF;
        text-decoration: none;
    }
</style>

<?=$sidelink;?>
<div class="col-lg-10 col-md-9 col-sm-9 DesignerInline">
    <div class="section">
        <div class="compose-holder">
            <button class="compose open-compose">Compose</button>
        </div>

        <div class="row" id="compose-form">
            <?= form_open('administration/mailer',array('id' => 'AddForm','class'=> ''),''); ?>
            <div class="validation-result" id="validation-result">
                <?php
                if(validation_errors()){
                    echo '<div class="bg-danger">';
                    echo validation_errors();
                    echo '</div>';
                }
                if (!empty($custom_validation)){
                    echo '<div class="bg-danger">';
                    echo $custom_validation;
                    echo '</div>';
                }
                if(!empty($custom_validation_success)){
                    echo '<div class="bg-success">';
                    echo $custom_validation_success;
                    echo '</div>';
                }
                ?>
            </div>
            <div class="col-md-11 col-centered compose-text-holder">

                <div class="col-sm-12 compose-switch-holder">
                    <div class="slideThree" style="float: left;">
                        <input id="slideThree" name="slidebox" onclick="exefunction()" style="display: none;" checked type="checkbox">

                        <label for="slideThree"></label>
                    </div>
                    <input id="inp-active" name="active" type="hidden" value="1">
                    <div class="cancel-holder" style="float: right;">
<!--                        <button class="cancel-compose">Cancel</button>-->
                        <a class="cancel-compose" href="javascript:void(0);"><span class="glyphicon glyphicon-remove" style="font-size: 14px;"></span></a>
                    </div>
                </div>

                <div class="col-sm-6 cstm_fields">
                    <input name="NameOfMailing" class="form-control round-0 compose-text" placeholder="Name of mailing" type="text">
                    <label id="NameOfMailing-error" class="error" for="NameOfMailing"></label>
                </div>
                <div class="col-sm-6 cstm_fields">
                    <select name="language" data-title="test" class="form-control round-0 compose-text">
                        <option value="">Language</option>
                        <?php echo $tableLanguage;?>

                    </select>
                </div>
                <div class="col-sm-6 cstm_fields">
                    <input name="topic" class="form-control round-0 compose-text" placeholder="Topic of email" type="text">
                </div>
                <div class="col-sm-6 cstm_fields">
                    <select name="scheme" class="form-control round-0 compose-text">
                        <option value="">Recurrence Scheme</option>
                        <?php echo $tableScheme;?>
                    </select>
                </div>
                <div class="col-sm-6 cstm_fields">
<!--                    <input name="from" class="form-control round-0 compose-text" placeholder="From" type="text">-->
                    <select name="from" class="form-control round-0 compose-text" id="sel-from">
                        <option value="">From</option>
                        <?php echo $mailboxes; ?>
                    </select>
                </div>
                <div class="col-sm-6 cstm_fields">
                    <select name="replyto" class="form-control round-0 compose-text">
                        <option value="">Reply-to</option>
                        <?php echo $tableReplyTo;?>
                    </select>
                </div>
                <div class="col-sm-12 cstm_fields_txtarea">
                    <textarea name="markItUp" id="markItUp" ></textarea>
                </div>
                <div class="col-sm-12 attach-holder">
                                    <span class="btn btn-success fileinput-button attach">
                                        <span><i class="fa fa-paperclip clip"></i></span>
                                        <input id="fileupload" name="files[]" multiple="" type="file">
                                    </span>
                </div>
                <div class="col-sm-12 add-compose-holder">
                    <button type="submit" class="btn-add">Add</button>
                </div>
                <div class="col-sm-8 update-compose-holder">
                    <a href="javascript:void(0)" class="btn-cancel open-cancel">Cancel</a>
                    <a href="javascript:void(0)" class="btn-update open-update">Update</a>
                    <input type="hidden" name="mailerId" value="" />
                </div>
            </div>
            <?php echo form_close()?>
        </div>
        <div class="table-responsive mail-tab-holder">
            <table class="table table-striped">
                <thead>

                <tr>
                    <th>Name of mailing</th>
                    <th>Topic</th>
                    <th>Scheme</th>
                    <th>Sent from</th>
                    <th>Reply to</th>
                    <th>Language</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>

                <?php echo $table; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?=$MailerDelete?>

<?php /** Preloader Modal Start */ ?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<?php /** Preloader Modal End */ ?>

<div class="modal fade" id="pop-preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0 " style="width: 850px;">
        <div  class="modal-content round-0 modalfeedbackcontent">
            <div class="modal-header popheader" style="padding: 10px 15px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle" id="myModalLabel" style="text-align: left;">
                    Mailer Preview
                </div>
            </div>

            <div class="modal-body modal-body1">
                <div style="position: relative;width: 800px;margin: 0px auto;">
                    <div style="background:#2988ca;padding:10px 0;width: 100%;">
                        <img style="margin-left: 10px;" src="https://www.forexmart.com/assets/images/logo2.png">
                    </div>
                    <div style="margin-top: 3px; border-top: 1px solid #2988CA; border-bottom: 1px solid #2988CA; padding-bottom: 30px;">
                        <p style="line-height: 20px; clear: left;" id="content-message">

                        </p>
                    </div>

                    <div id="english_footer" class="mailer_footer" style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">
                        <div style="width: 620px; float: left;">
                            <div>
                                <p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                                    <span style="font-weight: 600; color: #FF0000;"> Risk Warning: </span>
                                    Foreign exchange is highly speculative and complex in nature, and may not be suitable for all investors. Forex trading may result to substantial gain or loss. Therefore, it is not advisable to invest money you cannot afford to lose. Before using the services offered by ForexMart, please acknowledge and understand the risks relative to forex trading. Seek financial advice, if necessary.
                                </p>
                            </div>
                            <div>
                                <p>
                                    <span style="font-weight: 600;color:#2988ca;">ForexMart</span> is a trading name of <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, a Cyprus Investment Firm regulated by the Cyprus Securities Exchange (CySEC) with license number 266/15.
                                </p>
                            </div>
                            <div>
                                <p>
                                    <span style='font-weight: 600;color:#2988ca;'>ForexMart</span> was named by ShowFx World as the Best Broker in Europe 2015 and Most Perspective Broker in Asia 2015.
                                </p>
                            </div>
                            <p>&copy; 2015 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>
                        </div>
                        <div style="width: 180px;float: right;">
                            <img width="124" height="76" src="https://www.forexmart.com/assets/images/cysec.png" style="width: auto;margin: 20px auto;display: block;">
                            <img width="124" height="76" src="https://www.forexmart.com/assets/images/mifid.png" style="width: auto;margin: 20px auto;display: block;">
                        </div>
                    </div>
                    <div id="russian_footer" class="mailer_footer" style="background:url(https://www.forexmart.com/assets/images/footer-bg.png); width:800px; margin-top:2px; height: 218px;border-top: 3px solid #EAEAEA;">
                        <div style="width: 620px; float: left;">
                            <div>
                                <p style="color: #5a5a5a;text-align: justify;font-size: 13px;">
                                    <span style="font-weight: 600; color: #FF0000;"> Предупреждение о рисках: </span>Торговля на Форекс имеет спекулятивный и сложный характер, и может подойти не всем инветорам. Торговля на Форекс может привести к существенной прибыли или убытку. Поэтому не рекомендуется инвестировать средства, которые вы не можете себе позволить потерять. Перед тем, как начать пользоваться услугами ФорексМарт, пожалуйста, оцените и примите риски, связанные с торговлей на Форекс. Обратитесь за независимым финансовым советом, если это необходимо.
                                </p>
                            </div>
                            <div>
                                <p>
                                    <span style="font-weight: 600;color:#2988ca;">ФорексМарт (ForexMart)</span> является торговой маркой компании <img height="10" width="101" style="margin-bottom: 3px;vertical-align: middle" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png">, Кипрской Инвестиционной Компании (CIF), регулируемой Комиссией по ценным бумагам и биржам Кипра (CySEC) с лицензией № 266/15.
                                </p>
                            </div>
                            <div>
                                <p>
                                    <span style='font-weight: 600;color:#2988ca;'>Компания ФорексМарт</span> не оказывает услуги резидентам некоторых стран, таких как США, Северная Корея, Мьянма, Судан и Сирия.
                                </p>
                            </div>
                            <p>&copy; 2015 <img style="margin-bottom: 3px;vertical-align: middle" height="10" width="101" src="https://www.forexmart.com/assets/images/tradomart-ltd-small-black.png"></p>
                        </div>
                        <div style="width: 180px;float: right;">';
                            <img width="124" height="76" src="https://www.forexmart.com/assets/images/cysec.png" style="width: auto;margin: 20px auto;display: block;">
                            <img width="124" height="76" src="https://www.forexmart.com/assets/images/mifid.png" style="width: auto;margin: 20px auto;display: block;">
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var site_url="<?=FXPP::loc_url('')?>";
    var mailer_process = null;
    $('.show-mailer').on('click', function(){

        $('#loader-holder').show();

        var dataId = $(this).attr('id');
        mailer_process = $.ajax({
            url: site_url+'Administration/getMailerMessage',
            type: "POST",
            data:{dataId:dataId},
            dataType: "json",
            success: function(response){
                $('.mailer_footer').hide();
                $('p#content-message').html(response.message);
                $('#pop-preview').modal();
                var language = response.language;
                switch(language){
                    case 'Russian':
                        $('#russian_footer').show();
                        break;
                    default :
                        $('#english_footer').show();
                }
                $('#loader-holder').hide();
            }
        });

    });

    $(document).on("click", ".open-compose", function () {
        $('textarea#markItUp').text('');
        $('input[name=NameOfMailing]').val('');
        $('input[name=topic]').val('');
        $("select[name=language]").val('');
        $("select[name=scheme]").val('');
        $("select[name=replyto]").val('');
        $("select[name=from]").val('');
        $('textarea#markItUp').code('');
        $("#compose-form").show();
    });

    $(document).ready(function() {

        $('#markItUp').summernote({
            height: 200,
                onImageUpload: function(files) {
                    $('#loader-holder').show();
                sendFile(files[0]);
            }
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: site_url+"administration/imageUploadMailer",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $('#markItUp').summernote('editor.insertImage', url);
                    $('#loader-holder').hide();
                }
            });
        }

       $('#slideThree').change(function(){
           if($(this).is(":checked")) {
               $('#inp-active').val(1);
               console.log(1);
           }else{
               $('#inp-active').val(0);
               console.log(0);
           }
       });
    });

    $(document).on("click", ".open-update", function () {
        var prvt = [];
        prvt["data"] = {
            Id:$("input#mailerId").val(),
            NameOfMailing:$("input[name=NameOfMailing]").val(),
            topic:$("input[name=topic]").val(),
            from:$("select[name=from]").val(),
            replyto:$("select[name=replyto]").val(),
            markItUp:$("textarea#markItUp").code(),
            Language:$("select[name=language]").val(),
            Scheme:$("select[name=scheme").val()
        };
        $('#loader-holder').show();
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"index.php?/administration/updatemailer",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            window.location.href = site_url+'administration';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            window.location.href = site_url+'administration';
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            window.location.href = site_url+'administration';
        });
    });
    $(document).on("click", ".open-cancel", function () {

        $('textarea#markItUp').code('');
        $('input[name=NameOfMailing]').val('');
        $('input[name=topic]').val('');
        $('input[name=from]').val('');
        $('select[name=language]').val('');
        $('select[name=scheme]').val('');
        $('select[name=replyto]').val('');
        $('input[name=mailerId]').val('');

        $('#compose-form').css("display","none");
        $('.compose').css("display","block");
        $('.cancel-holder .cancel-compose').css("display","none");
        $('.add-compose-holder').css("display","block");
        $('.update-compose-holder').css("display","none");

    });

    $(document).on("click", ".open-edit", function () {
        $('#compose-form').css("display","none");
        $('.compose').css("display","block");
        $('.cancel-holder .cancel-compose').css("display","none");
        $('.add-compose-holder').css("display","none");
        $('.update-compose-holder').css("display","block");
        var prvt = [];
        prvt["data"] = {
            Id:$(this).data('id')
        };

        $('#loader-holder').show();

        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"index.php?/administration/editmailer",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $("textarea#markItUp").code(data.TextArea);

            $('input[name=NameOfMailing]').val(data.NameOfMailing);
            $('input[name=topic]').val(data.Topic);
            $('select[name=from]').val(data.Sentfrom);
            $('select[name=language]').val(data.Language);
            $('select[name=scheme]').val(data.Scheme);
            $('select[name=replyto]').val(data.ReplyTo);
            $('input[name=mailerId]').val(data.Id);

            $('#compose-form').css("display","block");
            $('.compose').css("display","none");

            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#compose-form').css("display","block");
            $('.compose').css("display","none");
            $('#loader-holder').hide();
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#compose-form').css("display","block");
            $('.compose').css("display","none");
            $('#loader-holder').hide();
        });

    });
    $(document).on("click", ".open-delete", function () {
        var mailerId = $(this).data('id');
        $(".modal-body #mailerId").val( mailerId );
    });

    var pblc = [];
    pblc['request'] = null;
    pblc['addform']  = null;

    $(document).ready(function(){

        $('.compose').bind( "click", function() {
            $('.compose').css("display","none");
            $('.cancel-holder .cancel-compose').css("display","block");
        });
        $('.cancel-compose').bind( "click", function() {
            $('.compose').css("display","block");
            $('.cancel-holder .cancel-compose').css("display","none");
            $('#compose-form').css("display","none");
        });
    });

    $().ready(function() {

        $.validator.addMethod("noSelectedDataLanguage", function(value, element) {
            return value != "";
        }, "Please choose a language.");
        $.validator.addMethod("noSelectedDataScheme", function(value, element) {
            return value != "";
        }, "Please choose a Recurrence Scheme.");
        $.validator.addMethod("noSelectedDataReplyTo", function(value, element) {
            return value != "";
        }, "Please choose a Reply to option.");
        $.validator.addMethod("noSelectedDataFrom", function(value, element) {
            return value != "";
        }, "Please choose a From.");

        pblc['addform'] = $('#AddForm').validate({
            rules:{
                NameOfMailing:{
                    required : true
                },
                topic:{required : true},
                from:{required : true, noSelectedDataFrom: true},
                markItUp:{test : true},
                language: {noSelectedDataLanguage:true},
                scheme: {noSelectedDataScheme:true},
                replyto: {noSelectedDataReplyTo:true}
            },
            messages: {
            }, submitHandler: function(form) {

                $('#loader-holder').show();

                $.ajax({
                    url: site_url+'administration/validate_mailer',
                    type: "POST",
                    data: {nameofmailer:$('input[name=NameOfMailing]').val()},
                    dataType: "json",
                    success: function(response){
                        if(response.result){

                            $('#loader-holder').hide();
                            $('label#NameOfMailing-error').html('Name of mailing must be unique.');
                            $('label#NameOfMailing-error').show();

                        }else{
                            form.submit();
                        }
                    }
                });

//                return true;
            }
        });

        pblc['deletemailer'] = $('#form_delete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {

                var prvt = [];
                prvt["data"] = {
                    Id: $('#mailerId').val()
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    window.location.href = site_url+'administration';
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    window.location.href = site_url+'administration';
                });

                pblc['request'].always(function( jqXHR, textStatus ) {
                    window.location.href = site_url+'administration';
                });
            }
        });
    });


</script>

