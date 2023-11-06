
<style type="text/css">
    .bootstrap-tagsinput {
        width: 100%;
    }

    #show-recipients-modal .modal-dialog {
        width: 450px;
    }

    div.editable-input{
        width: 100%;
    }
    .input-sm{
        width: 100% !important;
    }
    a.email-error{
        color: red;
    }
    a.edit-recipient{
        cursor: pointer;
    }
</style>

<?=$sidelink;?>

<div class="col-lg-10 col-md-9 col-sm-9" style="border-left: 1px solid #ccc;">
    <div class="section">
        <div class="email-cont-holder">
            <div class="email-search-holder">
                <div class="row">
                    <button style="margin-left: 15px;" class="btn-set-email" id="set-email">Set Email</button>
                    <div class="form-group col-sm-4 emailsearch">
                        <div class="input-group">
                            <input type="text" class="form-control round-0" id="input-main-search" placeholder="Search...">
                            <div class="input-group-addon round-0" id="search-main-recipient" style="cursor: pointer;"><i class="fa fa-search"></i></div>
                        </div>
                    </div><div class="clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="email-form col-md-8 col-centered">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Add Email :</label>
                            <div class="col-sm-8">
<!--                                <textarea data-role="tagsinput" class="form-control round-0" rows="3"></textarea>-->
                                <input type="text" class="form-control required" name="email" id="tokenfield"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Language :</label>
                            <div class="col-sm-8">
                                <select class="form-control round-0" id="sel_language">
                                    <?php echo $language; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mailer :</label>
                            <div class="col-sm-8">
                                <select class="form-control round-0" id="sel_mailer">
                                    <?php echo $mailer; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Start Date :</label>
                            <div class="col-sm-8">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' id="date_start" name="start_date" class="form-control required" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-8">
                                <input type="radio" name="ends_on" value="never" checked /> <label> Never </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Ends on :</label>

                            <div class="col-sm-8">
                                <input type="radio" name="ends_on" value="occurrence" /> <label> After </label> <input type="text" name="number_of_send"/> <label> Occurrence </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-5">
                                <input type="radio" name="ends_on" value="end_date" /> <label> On </label>
                                <input type='text' id="end_date" name="end_date" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8 email-btn">
                                <button class="btn-add">Add</button>
                                <button class="btn-cancel-add" data-dismiss="add-scheme-form">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 email-tab">
                    <div class="table-responsive col-md-12">

                        <table class="table table-striped reply-to-tab">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Mailer</th>
                                <th style="text-align: center;">Language</th>
                                <th style="text-align: center;">Start date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_mailer">
                                <?php echo $mailer_list; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
<!--                    <div class="col-md-6">-->
<!--                        <form class="form-inline">-->
<!--                            <div class="form-group">-->
<!--                                <label for="" class="number">Number of records shown per page</label>-->
<!--                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">-->
<!--                            </div>-->
<!--                            <button type="submit" class="btn btn-default round-0">Go</button>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    <div class="col-md-6 settings-pagination">-->
<!--                        <nav>-->
<!--                            <ul class="pagination">-->
<!--                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>-->
<!--                                <li class="active"><a href="#">1</a></li>-->
<!--                                <li class=""><a href="#">2</a></li>-->
<!--                                <li class=""><a href="#">3</a></li>-->
<!--                                <li class=""><a href="#">4</a></li>-->
<!--                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>-->
<!--                            </ul>-->
<!--                        </nav>-->
<!--                    </div>-->
                </div>
            </div>

        </div>
    </div>
</div>

<!--hidden vars -->
<input type="hidden" id="mailerId" value="">

<div id="show-recipients-modal" class="modal fade recipients-modal">
    <div class="modal-dialog modal_dialog_AS">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 15px;">
                <button  style="margin-top: 8px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="input-group" style="width: 60%;float: right;margin-right: 10px;">
                    <input type="text" class="form-control round-0" id="input-search" placeholder="Search...">
                    <div class="input-group-addon round-0" id="search-recipient" style="cursor: pointer;"><i class="fa fa-search"></i></div>
                </div>
                <h4 style="line-height: 34px;" class="modal-title">Recipients</h4>
            </div>
                <div class="modal-body">
                    <table class="table table-striped reply-to-tab">
                        <tbody id="tbody_recipients">
                            <td>test</td>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="popEmaildelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0 " style="width: 350px;">
        <div  class="modal-content round-0 modalfeedbackcontent">
            <div class="modal-header popheader" style="padding: 10px 15px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title poptitle" id="myModalLabel" style="text-align: left;">
                    Email
                </div>
            </div>

            <?= form_open('administration/email_delete',array('id' => 'form_Emaildelete')); ?>
            <div class="modal-body modal-body1">
                <p class="check-ps"> Are you sure you want to delete? </p>
                <input type="hidden" name="EmailId" id="EmailId" value=""/>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" data-dismiss="modal" aria-label="Close"  class="btn btn-default round-0 ">Cancel</button>
                <button name="delete" type="submit" id="delete" value="true" class="btn btn-default round-0">Delete</button>
            </div>
            <?= form_close();?>

        </div>
    </div>
</div>


<script type="text/javascript">
    var url = "<?php echo base_url();?>";
    $( document ).ready(function() {
//        $('#tokenfield').tokenfield({
//            delimiter: [',',' ', '-', '_']
//        });

        $.fn.editable.defaults.mode = 'inline';

        $('#show-recipients-modal').on('hidden.bs.modal', function () {
            $('input#input-search').val('');
        });

        $('#form_Emaildelete').validate({
            rules:{

            },
            messages: {

            }, submitHandler: function(form) {
                $('#loader-holder').show();
                var prvt = [];
                prvt["data"] = {
                    Id: $('#EmailId').val()
                };
                $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                }).done(function( data ) {
                    window.location.href = url+'administration/email';
                }).fail(function( jqXHR, textStatus ) {
                    window.location.href = url+'administration/email';
                });

            }
        });

        $('#tokenfield')

            .on('tokenfield:createtoken', function (e) {
                var data = e.attrs.value.split('|')
                e.attrs.value = data[1] || data[0]
                e.attrs.label = data[1] ? data[0] + ' (' + data[1] + ')' : data[0]
            })

            .on('tokenfield:createdtoken', function (e) {
                // Über-simplistic e-mail validation
                var re = /\S+@\S+\.\S+/
                var valid = re.test(e.attrs.value)
                if (!valid) {
                    console.log(e.relatedTarget);
                    $(e.relatedTarget).addClass('invalid')
                }
            })

            .on('tokenfield:edittoken', function (e) {
                if (e.attrs.label !== e.attrs.value) {
                    var label = e.attrs.label.split(' (')
                    e.attrs.value = label[0] + '|' + e.attrs.value
                }
            })

            .tokenfield({
                delimiter: [',',' ']
            });

        $(document).on('click', 'a.del-recipient', function(){

            jQuery.ajax({
                type: "POST",
                url: url+'administration/del_recipient',
                data: {
                    key:$(this).attr('id'),
                    mailer_id: $(this).attr('data-mailer')
                },
                dataType: 'json',
                beforeSend: function(){

                    $('#loader-holder').show();
                },
                success: function(response){
                    var trId = $(this).attr('id');
                    $('tr#'+trId).remove();
                    $('#loader-holder').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            })
        });
        $(document).on("click", ".del-email", function () {
            var Id = $(this).data('id');
            $(".modal-body #EmailId").val( Id );
            $('#popEmaildelete').modal('toggle');
        });

        $(document).on('click', 'div#search-main-recipient', function(){
            jQuery.ajax({
                type: "POST",
                url: url+'administration/search_main_recipient',
                data: {
                    search: $('input#input-main-search').val()
                },
                dataType: 'json',
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(response){

                    $('#loader-holder').hide();

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            })
        });

        $('div#show-recipients-modal').on('click', 'div#search-recipient', function(){

            jQuery.ajax({
                type: "POST",
                url: url+'administration/search_recipient',
                data: {
                    search: $('input#input-search').val(),
                    mailerId: $('input#mailerId').val()
                },
                dataType: 'json',
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(response){
                    $('tbody#tbody_recipients').html(response.result);
                    $('#loader-holder').hide();

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            })

        });

//        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker1')
            .datetimepicker()
            .on('dp.change', function(ev){
                $('div.bootstrap-datetimepicker-widget').remove();
            });
        $('#end_date').datetimepicker()
            .on('dp.change', function(ev){
                $('div.bootstrap-datetimepicker-widget').remove();
            });

        $('#date_start').click(function(){
            $('span.input-group-addon').click();
        });

        $("input[name=ends_on]:radio").change(function () {
            var type = $(this).val();
            switch(type){
                case 'never':
                    $('input[name=number_of_send]').val('');
                    $('input[name=end_date]').val('');
                    break;
                case 'occurrence':
                    $('input[name=end_date]').val('');
                    break;
                case 'end_date':
                    $('input[name=number_of_send]').val('');
                    break;
            }
        });

        $('#sel_language').change(function(){
            jQuery.ajax({
                type: "POST",
                url: url+'administration/getMailerDefaultSetting',
                data: {language:$(this).val()},
                dataType: 'json',
                beforeSend: function(){
                    $(".email-form").show();
                    $('#set-email').hide();
                    $('#loader-holder').show();
                },
                success: function(response){
                    $('select#sel_mailer').html(response.result);
                    $(".email-form").show();
                    $('#set-email').hide();
                    $('#loader-holder').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            })
        });

        $("#set-email").click(function(){
            jQuery.ajax({
                type: "POST",
                url: url+'administration/getMailerDefaultSetting',
                data: {language:$('select#sel_language').val()},
                dataType: 'json',
                beforeSend: function(){
                    $(".email-form").show();
                    $('#set-email').hide();
                    $('#loader-holder').show();
                },
                success: function(response){
                    $('select#sel_mailer').html(response.result);
                    $(".email-form").show();
                    $('#set-email').hide();
                    $('#loader-holder').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();
                }
            })

        });

//        $(document).on('click', 'a.edit-but-recipient', function(){
//            $('.edit-recipient').editable({
//                type: 'text',
//                highlight: '#48ee07',
//                placeholder: 'Please enter valid Email address.',
//                name: 'recipient',
//                url: url+'administration/edit_recipient',
//                success: function(response) {
//                    var response = JSON.parse(response);
//                    if(response.error){
//                        $(this).addClass('email-error');
//                        alert(response.message);
//                    }else{
//                        $(this).removeClass('email-error');
//                    }
//                }
//            });
//            $('#rec-0').editable('toggle');
//        });

        $('tbody#tbody_mailer').on('click', 'a.view_recipients', function(){
            var mailerId = $(this).attr('data-recipients');
            jQuery.ajax({
                type: "POST",
                url: url+'administration/getMailerRecipients',
                data: {mailer_id:mailerId},
                dataType: 'json',
                beforeSend: function(){
                    $('#loader-holder').show();
                },
                success: function(response){
                    $('tbody#tbody_recipients').html(response.result);
                    $('#show-recipients-modal').modal('toggle');
                    $('#loader-holder').hide();

                    $('input#mailerId').val(mailerId);
                    $('.edit-recipient').editable({
                        type: 'text',
                        highlight: '#48ee07',
                        placeholder: 'Please enter valid Email address.',
                        name: 'recipient',
                        url: url+'administration/edit_recipient',
                        success: function(response) {
                            var response = JSON.parse(response);
                            if(response.error){
                                $(this).addClass('email-error');
                                alert(response.message);
                            }else{
                                $(this).removeClass('email-error');
                            }
                        }
                    });

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#loader-holder').hide();

                }
            })
        });

        $('div.email-form').on('click', 'button.btn-add', function(){
            var existingTokens = $('#tokenfield').tokenfield('getTokens');
            var recipient = new Array();
            var errors = new Array();
            var flag = true;
            var getMode = $('select#sel_mailer').find(':selected').attr('data-mode');
            $.each(existingTokens, function(index, token) {

                var re = /\S+@\S+\.\S+/
                var valid = re.test(token.value)

                if (!valid) {
                    flag = false;
                    errors.push('invalid-email');
                }else{
                    flag = true;
                    recipient.push(token.value);
                }
            });

            $('.required').each(function(){
                if('' == jQuery(this).val()){
                    flag = false;
                    errors.push(this.name);
                }
            })

            if(flag){
                var occurence_type = $('.email-form input[name=ends_on]:checked').val();
                switch(occurence_type){
                    case 'occurrence':
                        var occurrence = $('input[name=number_of_send]').val();
                        break;
                    case 'never':
                        var occurrence = 'never';
                        break;
                    case 'end_date':
                        var occurrence = $('input[name=end_date]').val();
                        break;
                }
                var pass_data = {
                    'recipients' : recipient,
                    'mailer' : $('select#sel_mailer').val(),
                    'start_date' : $('#date_start').val(),
                    'occurence_type' :  occurence_type,
                    'occurrence' : occurrence,
                    'mode' : getMode
                };
                jQuery.ajax({
                    type: "POST",
                    url: url+'administration/addScheduleMailer',
                    data: pass_data,
                    dataType: 'json',
                    beforeSend: function(){
                        $('#loader-holder').show();
                    },
                    success: function(response){
                        $('#loader-holder').hide();
                        if(!response.error){
                            window.location.href = url+'administration/email';
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('#loader-holder').hide();

                    }
                })
            }else{
                $('div.tokenfield ').css('border-color', 'red');
                for(error in errors){
                    switch (errors[error]){
                        case 'email':
                            $('div.tokenfield').css('border-color', 'red');
                            break;
                        case 'start_date':
                            $('input#date_start').css('border-color', 'red');
                            break;
                    }
                }
            }


        });

        $('div.email-form').on('click', '.btn-cancel-add', function(){
            $('.email-form').hide();
            $('#set-email').show();
        });
    });
</script>