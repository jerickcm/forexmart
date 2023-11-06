<style>
    .DesignerInline{
        border-left: 1px solid #ccc;
    }
    .display-b{
        display: block;
    }
    .display-n{
        display: none;
    }
    a.btn-add{
        padding: 9px 25px;
    }
    a.btn-add:hover{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-add:link{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-add:visited{
        color: #FFF;
        text-decoration: none;
    }
    a.btn-add:active{
        color: #FFF;
        text-decoration: none;
    }
    .btn-update{
        background: #29A643 none repeat scroll 0% 0%;
        color: #FFF;
        padding: 7px 20px;
        transition: all 0.3s ease 0s;
        border: medium none;
    }
    div#error-replyTo p{
        color: red;
    }

</style>

<?=$sidelink;?>
<div class="col-lg-10 col-md-9 col-sm-9 DesignerInline">
    <div class="section">
        <div class="acct-tab-holder">
            <ul role="tablist" class="main-tab">
                <li role="presentation"><a id="replyto" href="<?=site_url('Administration/replyto')?>">Reply-to</a></li>
                <li role="presentation"><a id="language" href="<?=site_url('Administration/language')?>">Language</a></li>
                <li role="presentation"><a id="scheme" href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" class="acct-active">Scheme</a></li>
                <li role="presentation"><a id="events" href="<?=site_url('Administration/events')?>">Events</a></li>
            </ul><div class="clearfix"></div>
        </div>

        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab3">
                <div id="add-form" class="col-md-8 add-scheme-form" id="add-scheme-form">
                        <?= form_open('administration/settingsschemeadd',array('id' => 'AddForm','class'=> 'form-horizontal'),''); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Name of Scheme :</label>
                            <div class="col-sm-8">
                                <input name="Scheme" type="type" class="form-control round-0" id="" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Repeats :</label>
                            <div class="col-sm-8">
                                <select name="Mode" class="form-control round-0">
                                    <option>Yearly</option>
                                    <option>Monthly</option>
                                    <option>Weekly</option>
                                    <option>Daily</option>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="" class="col-sm-4 control-label">Repeats every :</label>-->
<!--                            <div class="col-sm-8">-->
<!--                                <select name="Repeat" class="form-control round-0 short-text">-->
<!--                                    <option>1</option>-->
<!--                                    <option>2</option>-->
<!--                                    <option>3</option>-->
<!--                                    <option>4</option>-->
<!--                                </select>-->
<!--                                weeks-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <input type="hidden" name="editmarkup" value="">
                                <button type="submit" id="btn-add" name="btn-add" class="btn-add">Add</button>
                                <button type="submit" id="btn-update" name="btn-update" class="btn-update display-n">Update</button>
                                <button type="reset" class="btn-cancel-add" data-dismiss="add-scheme-form" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    <?= form_close()?>
                </div>
                <div class="add-scheme-holder2 col-md-12">
                    <button class="btn-add open-add" id="show-add-container">Add Scheme</button>
                </div>
                <div class="table-responsive col-md-12">
                    <table class="table table-striped reply-to-tab">
                        <thead>
                        <tr>
                            <th class="th-email">Scheme</th>
                            <th class="th-action">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($tableScheme){
                            foreach($tableScheme as $data) {
                                echo '<tr>';
                                echo '<td><label id="Scheme-'.$data->Id.'">'.$data->Scheme.'</label></td>';
                                echo '<td>';
                                echo '<a  href="javascript:void(0)" id="schemeedit" data-id="'.$data->Id.'" class="open-edit" ><i class="fa fa-pencil action"></i></a>';
                                echo '<a href="#popSchemedelete" data-scheme="'.$data->Scheme.'" data-id="'.$data->Id.'" class="Scheme-delete opt" data-toggle="modal"><i class="fa fa-times-circle action"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }else{
                            echo '<td colspan="2" class="center">There are no records yet</td>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="tab-line"></div>
                </div>
                <div class="col-md-6">
                    <?= form_open('administration/scheme',array('id' => 'PerPageForm','class'=> 'form-inline'),''); ?>
                        <div class="form-group">
                            <label for="" class="number">Number of records shown per page</label>
                            <?php echo form_input($perpage);?>
                        </div>
                        <button type="submit" class="btn btn-default round-0">Go</button>
                    <?php echo form_close()?>
                </div>
                <div class="col-md-6 settings-pagination">
                    <nav>
                        <ul class="pagination">
                            <?php echo $links; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="show-error-modal" class="modal fade">
    <div class="modal-dialog modal_dialog_AS">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Mailer Error</h4>
            </div>
            <div class="modal-body">
                <div id="error-replyTo"></div>
            </div>
        </div>
    </div>
</div>


<?=$SchemeDelete?>

<script type='text/javascript'>
    var pblc = [];
    var site_url="<?=site_url('')?>";

    $(document).on('hidden.bs.modal', function () {
        $('.Scheme-delete').css('color', '#337ab7');
        $('.Scheme-delete').css('outline', 'none');
    });

    $(document).on("click", ".open-edit", function () {
        $('#add-form').addClass('add-scheme-form');
        $('.open-add').css("visibility","hidden");
        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            Id:$(this).data('id')
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/editscheme",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $('input[name=Scheme]').val(data.Scheme);
            $('select[name=Mode]').val(data.Mode);
            $('input[name=editmarkup]').val(data.Id);
            $('#add-form').removeClass('add-scheme-form');
            $('.btn-add').hide();
            $('.btn-update').show();
            $('#loader-holder').hide();
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('.btn-add').hide();
            $('.btn-update').show();
            $('#loader-holder').hide();
        });

    });


    $(document).on("click", ".open-add", function () {
        $('#add-form').removeClass('add-scheme-form');
        $('.open-add').css("visibility","hidden");
        $('.btn-add').show();
        $('.btn-update').hide();
        $('div.add-scheme-holder2').hide();
    });

    $(document).on("click", ".btn-cancel-add", function () {
        $('#add-form').addClass('add-scheme-form');
        $('.open-add').css("visibility","visible");
        $('#show-add-container').css("display","block");
        $('#show-add-container').removeClass('display-n');
        $('div.add-scheme-holder2').show();
    });

    $(document).on("click", ".Scheme-delete", function () {
        var Id = $(this).data('id');
        var schemeName = $(this).attr('data-scheme');
        $(".modal-body #SchemeId").val( Id );
        $(".modal-body #scheme_title_modal").html(schemeName);
    });

    $().ready(function() {
        pblc['AddScheme'] = $('#AddForm').validate({
            rules:{
                Scheme:{required : true},
                Mode:{required : true}
            },
            messages: {

            }, submitHandler: function(form) {
                $('#loader-holder').show();
                var prvt = [];
                prvt["data"] = {
                    Scheme: $('input[name=Scheme]').val(),
                    Mode:  $('select[name=Mode]').val(),
                    editmarkup: $('input[name=editmarkup]').val()
                };

                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    if(data.error){
                        $('#error-replyTo').html(data.message);
                        $('#show-error-modal').modal('toggle');
                        $('#loader-holder').hide();
                    }else{
                        window.location.href = site_url+'administration/scheme';
                    }
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $('#error-replyTo').html('Something went wrong. Please try again.');
                    window.location.href = site_url+'administration/scheme';
                });

            }
        });

        pblc['deleteScheme'] = $('#form_Schemedelete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {
                $('#loader-holder').show();
                var prvt = [];
                prvt["data"] = {
                    Id: $('#SchemeId').val()
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    window.location.href = site_url+'administration/scheme';
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    window.location.href = site_url+'administration/scheme';
                });

            }
        });

    });

</script>
<script type='text/javascript'>
    $(document).ready(function(){
        $('#replyto').bind( "click", function() {
            $('#replyto').addClass('acct-active');
            $('#language').removeClass('acct-active');
            $('#scheme').removeClass('acct-active');
        });
        $('#language').bind( "click", function() {
            $('#replyto').removeClass('acct-active');
            $('#language').addClass('acct-active');
            $('#scheme').removeClass('acct-active');
        });
        $('#scheme').bind( "click", function() {
            $('#replyto').removeClass('acct-active');
            $('#language').removeClass('acct-active');
            $('#scheme').addClass('acct-active');
        });
    });
</script>