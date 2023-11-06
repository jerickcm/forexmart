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
                <li role="presentation"><a id="replyto" href="<?=FXPP::loc_url('Administration/replyto')?>" >Reply-to</a></li>
                <li role="presentation"><a id="language" href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" class="acct-active">Language</a></li>
                <li role="presentation"><a id="scheme" href="<?=FXPP::loc_url('administration/scheme')?>" >Scheme</a></li>
            </ul><div class="clearfix"></div>
        </div>

        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab2">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped reply-to-tab">
                        <thead>
                        <tr>
                            <th class="th-email">Language</th>
                            <th class="th-action">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input name="language" type="text" class="form-control round-0 email-txt"></td>
                            <td>
                                <a href="javascript:void(0)" class="Language-add"><i class="fa fa-check-circle action"></i></a>
                                <a href="javascript:void(0)"  class="Language-delete"><i class="fa fa-times-circle action"></i></a>
                            </td>
                        </tr>
                        <?php
                        if($tableLanguage){
                            foreach($tableLanguage as $data) {
                                echo '<tr>';
                                echo '<td><label id="Language-'.$data->Id.'">'.$data->Language.'</label><input id="Language-'.$data->Id.'" name="Language-'.$data->Id.'" type="hidden" value="'.$data->Language.'" class="form-control round-0 email-txt"></td>';
                                echo '<td>';
                                echo '<a href="#" id="Language-Edit'.$data->Id.'"><i class="fa fa-pencil action Language-edit" data-id="'.$data->Id.'"></i></a><a id="Language-Add'.$data->Id.'"  data-id="'.$data->Id.'" href="#" class="Language-nth-update display-n"><i class="fa fa-check-circle action"></i></a>';
                                echo '  <a href="#popLanguagedelete"  data-lang="'.$data->Language.'" data-id="'.$data->Id.'" class="Language-delete opt" data-toggle="modal"><i class="fa fa-times-circle action"></i></a>';
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
                    <?= form_open('administration/language',array('id' => 'PerPageForm','class'=> 'form-inline'),''); ?>
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

<?=$LanguageDelete?>

<div id="show-error-modal" class="modal fade">
    <div class="modal-dialog modal_dialog_AS">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Language Error</h4>
            </div>
            <div class="modal-body">
                <div id="error-replyTo"></div>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    var pblc = [];
    var FXPP::loc_url="<?=FXPP::loc_url('')?>";
    $(document).on("click", ".Language-nth-update", function () {
        var Id = $(this).data('id');
        var prvt = [];
        prvt["data"] = {
            Language: $("input#Language-"+Id).val(),
            Id: Id
        };
        $('#loader-holder').show();
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: FXPP::loc_url+"administration/settingslanguageupdate",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            $("input#Language-"+Id).prop('type', 'hidden');
            $('label#Language-'+Id).css('display','block');
            $('label#Language-'+Id).text($("input#Language-"+Id).val());
            $('#Language-Add'+Id).addClass('display-n');
            $('#Language-Edit'+Id).removeClass('display-n')
            window.location.href = FXPP::loc_url+'administration/language';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
            $("input#Language-"+Id).prop('type', 'hidden');
            $('label#Language-'+Id).css('display','block');
            $('label#Language-'+Id).text($("input#Language-"+Id).val());
            $('#Language-Add'+Id).addClass('display-n');
            $('#Language-Edit'+Id).removeClass('display-n')
            window.location.href = FXPP::loc_url+'administration/language';
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $('#loader-holder').hide();
            $("input#Language-"+Id).prop('type', 'hidden');
            $('label#Language-'+Id).css('display','block');
            $('label#Language-'+Id).text($("input#Language-"+Id).val());
            $('#Language-Add'+Id).addClass('display-n');
            $('#Language-Edit'+Id).removeClass('display-n')
            window.location.href = FXPP::loc_url+'administration/language';
        });
    });
    $(document).on("click", ".Language-edit", function () {
        var Id = $(this).data('id');
        $('input#Language-'+Id).prop('type', 'text');
        $('label#Language-'+Id).css('display','none');
        $('#Language-Add'+Id).removeClass('display-n');
        $('#Language-Edit'+Id).addClass('display-n')
    });


    $(document).on("click", ".Language-delete", function () {
        var Id = $(this).data('id');
        var lang = $(this).attr('data-lang');
        $(".modal-body #LanguageId").val( Id );
        $(".modal-body #language_title").html( lang );
    });


    $(document).on("click", ".Language-add", function () {
        $('#loader-holder').show();
        var prvt = [];
        prvt["data"] = {
            Language: $('input[name=language]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: FXPP::loc_url+"administration/settingslanguageadd",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {
            if(data.error){
                $('#error-replyTo').html(data.message);
                $('#show-error-modal').modal('toggle');
                $('#loader-holder').hide();
            }else{
                window.location.href = FXPP::loc_url+'administration/language';
            }
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            window.location.href = FXPP::loc_url+'administration/language';
        });
    });

    $().ready(function() {

        pblc['deleteLanguage'] = $('#form_Languagedelete').validate({
            rules:{
            },
            messages: {

            }, submitHandler: function(form) {
                $('#loader-holder').show();

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
                    window.location.reload();
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    window.location.reload();
                });

                pblc['request'].always(function( jqXHR, textStatus ) {
                    window.location.reload();
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