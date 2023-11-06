<style>
    .DesignerInline{
        border-left: 1px solid #ccc;
    }
    .dsiplay-b{
        display: block;
    }
    .display-n{
        display: none;
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
                <li role="presentation"><a id="replyto" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" class="acct-active">Reply-to</a></li>
                <li role="presentation"><a id="language" href="<?=site_url('administration/language')?>">Language</a></li>
                <li role="presentation"><a id="scheme" href="<?=site_url('administration/scheme')?>" >Scheme</a></li>
            </ul><div class="clearfix"></div>
        </div>

        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab1">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped reply-to-tab">
                        <thead>
                        <tr>
                            <th class="th-email">Email</th>
                            <th class="th-action">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td><input name="replyto" type="text" class="form-control round-0 email-txt"></td>
                            <td>
                                <a href="javascript:void(0)" class="ReplyTo-add"><i class="fa fa-check-circle action"></i></a>
                                <a href="javascript:void(0)"  class="ReplyTo-delete"><i class="fa fa-times-circle action"></i></a>
                            </td>
                        </tr>
                        <?php  if($tableReplyTo){
                            foreach($tableReplyTo as $data) {
                                echo '<tr>';
                                echo '<td><label id="ReplyTo-'.$data->Id.'">'.$data->ReplyTo.'</label><input id="ReplyTo-'.$data->Id.'" name="ReplyTo-'.$data->Id.'" type="hidden" value="'.$data->ReplyTo.'"  name="ReplyTo" class="form-control round-0 email-txt"></td>';
                                echo '<td>';
                                echo '<a href="#" id="ReplyTo-Edit'.$data->Id.'"><i class="fa fa-pencil action ReplyTo-edit" data-id="'.$data->Id.'"></i></a><a id="ReplyTo-Add'.$data->Id.'"  data-id="'.$data->Id.'" href="#" class="ReplyTo-nth-update display-n"><i class="fa fa-check-circle action"></i></a>';
                                echo '<a id="ReplyTo-Delete" href="#popReplyTodelete"  data-email="'.$data->ReplyTo.'" data-id="'.$data->Id.'" class="ReplyTo-delete opt" data-toggle="modal"><i class="fa fa-times-circle action"></i></a>';
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
                    <?= form_open('administration/replyto',array('id' => 'PerPageForm','class'=> 'form-inline'),''); ?>
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


<?=$ReplyToDelete?>

<script type='text/javascript'>
    var pblc = [];
    var site_url="<?=site_url('')?>";
    $(document).on("click", ".ReplyTo-nth-update", function () {
        var Id = $(this).data('id');
        var prvt = [];
        prvt["data"] = {
            ReplyTo: $("input#ReplyTo-"+Id).val(),
            Id: Id
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"index.php?/administration/settingsreplytoupdate",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $("input#ReplyTo-"+Id).prop('type', 'hidden');
            $('label#ReplyTo-'+Id).css('display','block');
            $('label#ReplyTo-'+Id).text($("input#ReplyTo-"+Id).val());
            $('#ReplyTo-Add'+Id).addClass('display-n');
            $('#ReplyTo-Edit'+Id).removeClass('display-n')
            window.location.href = site_url+'index.php?/administration/replyto';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $("input#ReplyTo-"+Id).prop('type', 'hidden');
            $('label#ReplyTo-'+Id).css('display','block');
            $('label#ReplyTo-'+Id).text($("input#ReplyTo-"+Id).val());
            $('#ReplyTo-Add'+Id).addClass('display-n');
            $('#ReplyTo-Edit'+Id).removeClass('display-n')
            window.location.href = site_url+'index.php?/administration/replyto';
        });
    });
    $(document).on("click", ".ReplyTo-edit", function () {
        var Id = $(this).data('id');
        $('input#ReplyTo-'+Id).prop('type', 'text');
        $('label#ReplyTo-'+Id).css('display','none');
        $('#ReplyTo-Add'+Id).removeClass('display-n');
        $('#ReplyTo-Edit'+Id).addClass('display-n')
    });


    $(document).on("click", ".ReplyTo-delete", function () {
        var Id = $(this).data('id');
        var email = $(this).attr('data-email');
        $(".modal-body #ReplyToId").val( Id );
        $(".modal-body #mod_email").html( email );
    });

    $(document).on("click", ".Language-delete", function () {
        var Id = $(this).data('id');
        $(".modal-body #LanguageId").val( Id );
    });

    $(document).on("click", ".Scheme-delete", function () {
        var Id = $(this).data('id');
        $(".modal-body #SchemeId").val( Id );
    });


    $(document).on("click", ".ReplyTo-add", function () {
        var prvt = [];
        prvt["data"] = {
            ReplyTo: $('input[name=replyto]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/settingsreplytoadd",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if(data.error){
                $('#error-replyTo').html(data.message);
                $('#show-error-modal').modal('toggle');
            }else{
                window.location.href = site_url+'administration/replyto';
            }
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#error-replyTo').html('Something went wrong. Please try again.');
            window.location.href = site_url+'administration/replyto';
        });
    });

    $(document).on("click", ".Language-add", function () {
        var prvt = [];
        prvt["data"] = {
            Language: $('input[name=language]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/settingslanguageadd",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            window.location.href = site_url+'administration/replyto';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            window.location.href = site_url+'administration/replyto';
        });

    });

    $().ready(function() {

        pblc['deleteReplyTo'] = $('#form_ReplyTodelete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {

                var prvt = [];
                prvt["data"] = {
                    Id: $('#ReplyToId').val()
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    window.location.href = site_url+'administration/replyto';
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    window.location.href = site_url+'administration/replyto';
                });


            }
        });
        pblc['deleteLanguage'] = $('#form_Languagedelete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {

                var prvt = [];
                prvt["data"] = {
                    Id: $('#LanguageId').val()
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    window.location.href = site_url+'administration/replyto';
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    window.location.href = site_url+'administration/replyto';
                });

            }
        });
        pblc['deleteScheme'] = $('#form_Schemedelete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {

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
                    window.location.href = site_url+'administration/replyto';
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    window.location.href = site_url+'administration/replyto';
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