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
</style>

<?=$sidelink;?>
<div class="col-lg-10 col-md-9 col-sm-9 DesignerInline">
    <div class="section">
        <div class="acct-tab-holder">
            <ul role="tablist" class="main-tab">
                <li role="presentation"><a id="replyto" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" class="acct-active">Reply-to</a></li>
                <li role="presentation"><a id="language" href="<?=site_url('Administration/language')?>" >Language</a></li>
                <li role="presentation"><a id="scheme" href="<?=site_url('Administration/scheme')?>" >Scheme</a></li>
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
                                        echo '<a id="ReplyTo-Delete" href="#popReplyTodelete"  data-id="'.$data->Id.'" class="ReplyTo-delete opt" data-toggle="modal"><i class="fa fa-times-circle action"></i></a>';
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
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="" class="number">Number of records shown per page</label>
                            <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-default round-0">Go</button>
                    </form>
                </div>
                <div class="col-md-6 settings-pagination">
                    <nav>
                        <ul class="pagination">
                            <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class=""><a href="#">2</a></li>
                            <li class=""><a href="#">3</a></li>
                            <li class=""><a href="#">4</a></li>
                            <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div role="tabpanel" class="row tab-pane" id="tab2">
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
                                echo '<td>'.$data->Language.'</td>';
                                echo '<td>';
                                echo ' <a href="#"><i class="fa fa-pencil action"></i></a>';
                                echo '  <a href="#popLanguagedelete"  data-id="'.$data->Id.'" class="Language-delete opt" data-toggle="modal"><i class="fa fa-times-circle action"></i></a>';
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
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="" class="number">Number of records shown per page</label>
                            <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-default round-0">Go</button>
                    </form>
                </div>
                <div class="col-md-6 settings-pagination">
                    <nav>
                        <ul class="pagination">
                            <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class=""><a href="#">2</a></li>
                            <li class=""><a href="#">3</a></li>
                            <li class=""><a href="#">4</a></li>
                            <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div role="tabpanel" class="row tab-pane" id="tab3">
                <div class="col-md-8 add-scheme-form" id="add-scheme-form">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Name of Scheme :</label>
                            <div class="col-sm-8">
                                <input type="type" class="form-control round-0" id="" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Repeats :</label>
                            <div class="col-sm-8">
                                <select class="form-control round-0">
                                    <option>Weekly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Repeats every :</label>
                            <div class="col-sm-8">
                                <select class="form-control round-0 short-text">
                                    <option>1</option>
                                </select>
                                weeks
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button class="btn-add">Add</button>
                                <button class="btn-cancel-add" data-dismiss="add-scheme-form" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="add-scheme-holder col-md-12">
                    <button class="btn-add" id="btn-add">Add</button>
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
                                echo '<td>'.$data->Scheme.'</td>';
                                echo '<td>';
                                echo ' <a href="#"><i class="fa fa-pencil action"></i></a>';
                                echo '  <a href="#popSchemedelete"  data-id="'.$data->Id.'" class="Scheme-delete opt" data-toggle="modal"><i class="fa fa-times-circle action"></i></a>';
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
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="" class="number">Number of records shown per page</label>
                            <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-default round-0">Go</button>
                    </form>
                </div>
                <div class="col-md-6 settings-pagination">
                    <nav>
                        <ul class="pagination">
                            <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class=""><a href="#">2</a></li>
                            <li class=""><a href="#">3</a></li>
                            <li class=""><a href="#">4</a></li>
                            <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$ReplyToDelete?>
<?=$LanguageDelete?>
<?=$SchemeDelete?>

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
            $('#ReplyTo-Add'+Id).addClass('display-n');
            $('#ReplyTo-Edit'+Id).removeClass('display-n')
            window.location.href = site_url+'index.php?/administration/settings';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {
            $("input#ReplyTo-"+Id).prop('type', 'hidden');
            $('label#ReplyTo-'+Id).css('display','block');
            $('#ReplyTo-Add'+Id).addClass('display-n');
            $('#ReplyTo-Edit'+Id).removeClass('display-n')
            window.location.href = site_url+'index.php?/administration/settings';
        });

        pblc['request'].always(function( jqXHR, textStatus ) {
            $("input#ReplyTo-"+Id).prop('type', 'hidden');
            $('label#ReplyTo-'+Id).css('display','block');
            $('#ReplyTo-Add'+Id).addClass('display-n');
            $('#ReplyTo-Edit'+Id).removeClass('display-n')
            window.location.href = site_url+'index.php?/administration/settings';
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
        $(".modal-body #ReplyToId").val( Id );
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
            url: site_url+"index.php?/administration/settingsreplytoadd",
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
    });

    $(document).on("click", ".Language-add", function () {
        var prvt = [];
        prvt["data"] = {
            Language: $('input[name=language]').val()
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"index.php?/administration/settingslanguageadd",
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