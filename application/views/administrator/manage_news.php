<style>
    .cstm_fields{
        height: 55px;
        margin-bottom: 8px;
    }

    .cstm_fields_input {
        height: 75px;
        margin-bottom: 8px;
    }
    #markItUp{
        width:100%!important;
    }

    #editAvatar {
        cursor: pointer;
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
        display: inline-block;
        margin-top: 15px;
    }
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

    .dp-holder:hover .edit {
        display: block;
    }

    .edit {
        padding-top: 3px;
        padding-right: 20px;
        position: absolute;
        right: 0;
        top: 0;
        display: none;
    }

    .edit a {
        color: #000;
    }

    .alert {
        margin-top: 10px;
        margin-bottom: 0px;;
    }

    .checkbox input[type=checkbox]{
        margin-left: 0px;
    }
</style>


<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <div class="compose-holder">
            <button class="compose open-compose">Create</button>
        </div>
        <div class="cancel-holder">
            <button class="cancel-compose">Cancel</button>
        </div>

        <?php
        if(validation_errors()){
            echo '<div class="alert alert-danger">';
            echo validation_errors();
            echo '</div>';
        }
        if (!empty($custom_validation)){
            echo '<div class="alert alert-danger">';
            echo $custom_validation;
            echo '</div>';
        }
        if(!empty($custom_validation_success)){
            echo '<div class="alert alert-success">';
            echo $custom_validation_success;
            echo '</div>';
        }
        ?>
        <div class="row" id="compose-form">
            <?= form_open('administration/manage-news',array('id' => 'addNews','class'=> '', 'enctype'=>"multipart/form-data"),''); ?>
            <div class="col-md-11 col-centered compose-text-holder">

                <div class="col-sm-12 compose-switch-holder">
                    <div class="slideThree">
                        <input id="slideThree" name="slidebox" onclick="exefunction()" style="display: none;" checked type="checkbox">

                        <label for="slideThree"></label>
                    </div>
                    <input id="inp-active" name="active" type="hidden" value="1">
                </div>

                <div class="col-sm-9">
                    <div class="col-sm-12 cstm_fields">
                        <input name="headline" class="form-control round-0 compose-text" placeholder="Headline" type="text">
                        <label id="headline-error" class="error" for="headline"></label>
                    </div>
                    <div class="col-sm-12 cstm_fields_input">
                        <textarea name="summary" class="form-control round-0 compose-text" placeholder="Summary" style="resize: none"></textarea>
                        <label id="summary-error" class="error" for="summary"></label>
                    </div>
                    <div class="col-sm-12 cstm_fields">
                        <input name="publisher" class="form-control round-0 compose-text" placeholder="Publisher" type="text">
                        <label id="publisher-error" class="error" for="publisher"></label>
                    </div>
                    <div class="col-sm-12 cstm_fields">
                        <input name="job_description" class="form-control round-0 compose-text" placeholder="Job Description" type="text">
                        <label id="job_description-error" class="error" for="jobDescription"></label>
                    </div>
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <input id="topNewsActive" name="top_news" type="checkbox" />
                            <label for="topNewsActive">Top News</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 cstm_fields">
                    <div class="dp-holder" style="float: right;">
                        <input type="hidden" id="profileAvatar" name="publisher_avatar" value="" />
                        <input type="hidden" id="no-image" value="<?= $this->template->Images()?>avatar.png" />
                        <img src="<?php echo $this->template->Images() . 'avatar.png' ?>" id="avatar" width="100px" style="border: 1px solid #ccc;display: block;">
                        <div class="edit">
                            <a id="editAvatar"><i class="fa fa-pencil fa-lg"></i></a>
                        </div>

                        <button id="remove_avatar" class="btn-remove-avatar"  style="display: block;float: right !important;">Remove Avatar</button>
                    </div>
                </div>
                <input id="avatarUpload" type="file" name="avatar" style="visibility: hidden"/>
                <div class="col-sm-12 cstm_fields_txtarea">
                    <textarea name="markItUp" id="markItUp" ></textarea>
                </div>
                <div class="col-sm-12 add-compose-holder">
                    <button type="submit" class="btn-add">Add</button>
                </div>
                <div class="col-sm-8 update-compose-holder">
                    <a href="javascript:void(0)" class="btn-cancel open-cancel">Cancel</a>
                    <a href="javascript:void(0)" class="btn-update open-update">Update</a>
                    <input type="hidden" name="news_id" value="" />
                </div>
            </div>
            <?php echo form_close()?>
        </div>
        <div class="table-responsive mail-tab-holder">
            <table id="newsTable" class="table table-striped">
                <thead>
                <tr>
                    <th>Headline</th>
                    <th>Publisher</th>
                    <th>Job Description</th>
                    <th>Date Created</th>
                    <th>Enabled</th>
                    <th>Featured</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $news_delete ?>
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
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css"/>
<script>
    var site_url="<?=FXPP::loc_url('')?>";

    jQuery('#newsTable').on('preXhr.dt', function ( e, settings, data ) {
        jQuery('#loader-holder').show();
    }).on('xhr.dt', function ( e, settings, json, xhr ) {
        jQuery('#loader-holder').hide();
    }).DataTable({
        "processing": false,
        "serverSide": true,
        "bFilter": false,
        "bSort": false,
        "ajax": {
            "url": site_url+"administration/update_news_table",
            "type": "POST"
        }
    });

    $(document).on("click", ".open-compose", function () {
        $('textarea#markItUp').text('');
        $('input[name=headline]').val('');
        $('input[name=publisher]').val('');
        $('[name=summary]').val('');
        $("select[name=job_description]").val('');
        $('textarea#markItUp').code('');
        $("#compose-form").show();
    });


    function readInput(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                jQuery('#avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    jQuery("#avatarUpload").change(function() {
        var filename = jQuery(this).val().replace(/C:\\fakepath\\/i, '');
        jQuery("#profileAvatar").val(filename);
        readInput(this);
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

        $('#slideTopNews').change(function(){
            if($(this).is(":checked")) {
                $('#topNewsActive').val(1);
                console.log(1);
            }else{
                $('#topNewsActive').val(0);
                console.log(0);
            }
        });


    });

    $(document).on("click", "#editAvatar", function () {
        $('#avatarUpload').click();
    });

    jQuery("#remove_avatar").click(function(event){
        event.preventDefault();
        jQuery("#avatarUpload").val('');
        jQuery("#profileAvatar").val('');
        jQuery('#avatar').attr('src', jQuery('#no-image').val());
    });

    $(document).on("click", ".open-update", function () {
        $('#loader-holder').show();
        $("textarea#markItUp").val($("textarea#markItUp").code());
        data = new FormData($('#addNews')[0]);
        data.append("file", jQuery("#avatarUpload")[0].files[0]);
        pblc['request'] = $.ajax({
            type: 'POST',
            dataType: 'json',
            url: site_url+"index.php?/administration/update_news",
            method: 'POST',
            data: data,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false        // To send DOMDocument or non processed data file it is set to false
        });

        pblc['request'].done(function( data ) {
                if(data.success){
                    location.reload();
                }else{
                    console.log(data);
                }
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            //location.reload();
            console.log(jqXHR.status);
            console.log(textStatus);
        });
    });
    $(document).on("click", ".open-cancel", function () {

        $('textarea#markItUp').text('');
        $('input[name=headline]').val('');
        $('input[name=publisher]').val('');
        $('[name=summary]').val('');
        $("select[name=job_description]").val('');
        $('textarea#markItUp').code('');

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
            url: site_url+"index.php?/administration/edit_news",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $("textarea#markItUp").code(data.content);

            $('input[name=headline]').val(data.headline);
            $('input[name=publisher]').val(data.publisher);
            $('input[name=job_description]').val(data.job_description);
            $('[name=summary]').val(data.summary);
            $('input[name=news_id]').val(data.news_id);
            $('input[name=top_news]').prop('checked', data.top_news);
            $('input[name=publisher_avatar]').val(data.avatar);
            $('#avatar').attr('src', data.avatar_url);

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
        var news_id = $(this).data('id');
        $(".modal-body #deleteNewsId").val( news_id );
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

        pblc['addform'] = $('#addNews').validate({
            rules:{
                headline:{ required : true },
                publisher:{ required : true },
                job_description:{ required : true },
                summary:{ required : true }
            },
            messages: {
            }, submitHandler: function(form) {
                $('#loader-holder').show();
                form.submit();
                return true;
            }
        });

        pblc['deletemailer'] = $('#form_delete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {

                var prvt = [];
                prvt["data"] = {
                    id: $('#deleteNewsId').val()
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    location.reload();
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    location.reload();
                });

                pblc['request'].always(function( jqXHR, textStatus ) {
                    location.reload();
                });
            }
        });
    });


</script>

