<?php
$result = array();
if($user_documents_all) {

    foreach ($user_documents_all as $data) {
        $id = $data['user_id'];
        if (isset($result[$id])) {
            $result[$id][] = $data;
        } else {
            $result[$id] = array($data);
        }
    }


    $arrykeyholder = array();
    $arrykeyholder = array_keys($result);
}
?>


<style>
    .default-c{
        background-color: #d3d3d3;
        border-color: #d3d3d3;
    }
    .default-c:hover{
        background-color: #d3d3d3;
        border-color: #d3d3d3;
    }
    .displayn{
        display: none;
    }
    .mybutton {
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
    }
    .centroid{
        margin:auto;
    }
    div.bg-danger {
        background-color: #f2dede;
        padding: 5px;
        font-size: 12px;
        color: rgb(174, 21, 21) !important;
        text-align: center;
        border: 1px solid;
        margin: 20px;

    }

    div.bg-danger p {
        margin: 10px 10px!important;
        text-align: center !important;
        font-size: 12px !important;
        color: rgb(174, 21, 21) !important;
        line-height: 17px;
    }
</style>



<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <?= $this->load->view('administrator/AV_tabs', NULL, TRUE);?>
        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="row tab-pane active" id="tab4">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped queue-tab">
                        <thead>
                        <tr>
                            <th><?= lang('acct-no');?></th>
                            <th><?= lang('acct-ds');?></th>
                            <th><?= lang('acct-e');?></th>
                            <th><?= lang('acct-fn');?></th>
                            <th><?= lang('acct-ipa');?></th>
                            <th><?= lang('acct-a');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if($user_documents){
                            $no=$myno+1;
                            foreach($user_documents as $key => $value) {
                                echo '<tr>';
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$value['date_uploaded'].'</td>';
                                echo '<td>'.$value['email'].'</td>';
                                echo '<td>'.$value['full_name'].'</td>';
                                echo '<td>'.$value['last_ip'].'</td>';
                                echo '<td><a href="#'.$value['id'].'"  data-userid="'.$value['user_id'].'" data-id="'.$value['id'].'" data-fullname="'.$value['full_name'].'" data-email="'.$value['email'].'" data-address="'.$value['street'].','.$value['city'].','.$value['state'].','.$this->g_m->getCountries($value['country']).','.$value['zip'].'" class="queue-action incomplete" data-toggle="modal" data-target="#incStat">'.lang("vd").'</a></td>';
                                echo '</tr>';
                                $no=$no+1;
                            }
                        }else{
                            echo '<td colspan="6 class="center">'.lang("norecy").'</td>';
                        }  ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">

                </div>
                <div class="col-md-6">
                    <?= form_open('administration/accountverification_incompletedocuments',array('id' => 'PerPageForm','class'=> 'form-inline'),''); ?>
                    <div class="form-group">
                        <label for="" class="number"><?= lang('norec');?></label>
                        <?php echo form_input($perpage);?>
                    </div>
                    <button type="submit" class="btn btn-default round-0"><?= lang('g');?></button>
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
<!-- modal -->
<div class="modal fade" id="incStat" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('acct-id');?></h4>
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
                                    <p class="acct-val accountnumber"></p>
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
                    <div class="col-sm-6">
                        <?= form_open('administration/accountverificationchangestatus',array('id' => 'FormChangeStatus','class'=> 'form-inline'),''); ?>
                        <?php
                        $datauserid = array(
                            'type'  => 'hidden',
                            'name'  => 'myuserid',
                            'id'    => 'myuserid',
                            'value' => set_value('myuserid', ''),
                            'class' => 'hiddenid'
                        );
                        ?>
                        <?= form_input($datauserid);?>
                        <?php
                        $datalocation = array(
                            'type'  => 'hidden',
                            'name'  => 'userlocation',
                            'id'    => 'userlocation',
                            'value' => set_value('location', '3'),
                            'class' => 'locationid'
                        );
                        ?>
                        <?= form_input($datalocation);?>

                        <label for="exampleInputEmail2"><?= lang('eas');?></label><br>
                            <div class="form-group">
                                <?php
                                $adddata =  'id="selectaction" name="selection" class="form-control round-0 acct-stat"';
                                $options = array(
                                    '1' => 'Verified',
                                    '2' => 'Declined'
                                );

                                ?>

                                <?= form_dropdown('selectaction', $options, '',$adddata); ?>

                            </div>
                        <button id="changestatus" disabled type="submit" class="default-c btn btn-primary round-0"><?= lang('modal_upt');?></button>
                        <?= form_close()?>
                    </div>
                </div>
                <div class="settings-tab">
                    <ul role="tablist" class="queue-tab-list">
                        <li role="presentation"><a href="#acctab7" aria-controls="tab1" role="tab" data-toggle="tab" id="i-st" class="active-set-tab"><?= lang('frstdoc');?></a></a></li>
                        <li role="presentation"><a href="#acctab8" aria-controls="tab2" role="tab" data-toggle="tab" id="i-nd"><?= lang('secdoc');?></a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="tab-content acct-cont admin-tab-cont">
                    <div role="tabpanel" class="row tab-pane active" id="acctab7">
                        <div class="table-responsive">
                            <table class="table table-striped queue-tab">
                                <thead>
                                <tr>
                                    <th><?= lang('modal_fn1');?></th>
                                    <th><?= lang('modal_fn2');?></th>
                                    <th><?= lang('modal_fn3');?></th>
                                    <th><?= lang('modal_upt');?></th>
                                </tr>
                                </thead>
                                <tbody class="firstdocument">
                                    <?php  if($result) {
                                        foreach ($arrykeyholder as &$usearraykey) {
                                            foreach ($result[$usearraykey] as $key => $value) {
                                                if ($value['doc_type']==0 or $value['doc_type']==1){

                                                    $status='';
                                                    switch ($value['status']) {
                                                        case 0: $status= lang('pending');break;
                                                        case 1: $status= lang('verified');break;
                                                        case 2: $status= lang('declined');break;
                                                        case 3: $status= lang('incomplete');break;
                                                        default:$status='';
                                                    }

                                                    if($value['doc_type']==0 ){
                                                        $doc_caption=' ( front )';
                                                    }elseif($value['doc_type']==1){
                                                        $doc_caption=' ( back )';
                                                    }

                                                    echo '<tr id="tr'.$value['id'].'" class="tr'.$value['user_id'].' fdocument">';
                                                    echo '<td><button type="button" class="mybutton hitdisplay" data-toggle="collapse" data-target="#collapseme'.$value['id'].'" data-id="'.$value['id'].'"> <span id="spn'.$value['id'].'" class="glyphicon glyphicon-plus"></span> ' . $value['client_name'] .' '. $doc_caption .'</button></td>';
                                                    echo '<td>' .$status . '</td>';
                                                    echo '<td>' . $value['date_uploaded'] . '</td>';
                                                    echo '<td><a href="#" id="incomplete-nth-approve'.$value['id'].'"  data-id="'.$value['id'].'" class="incomplete-nth-approve queue-action"  data-target="#viewAcct">'.lang('modal_apprv').'</a> |<a href="#" id="incomplete-nth-decline'.$value['id'].'"   data-id="'.$value['id'].'" class="incomplete-nth-decline queue-action"  data-target="#viewAcct">'.lang('modal_dcln').'</a></td>';
                                                    echo '</tr>';
                                                    echo '<tr id="collapseme'.$value['id'].'" class="collapse"><td colspan="4" ><div>';
                                                    echo '<img id="img'.$value['id'].'" src="'.$this->config->item('domain-my').'/assets/user_docs/'.$value['file_name'].'" class="img'.$value['user_id'].' centroid fimage img-responsive acct-ver-img"/>';
                                                    echo '</div></td></tr>';
                                                }
                                            }
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div role="tabpanel" class="row tab-pane" id="acctab8">
                        <div class="table-responsive">
                            <table class="table table-striped queue-tab">
                                <thead>
                                <tr>
                                    <th><?= lang('modal_fn1');?></th>
                                    <th><?= lang('modal_fn2');?></th>
                                    <th><?= lang('modal_fn3');?></th>
                                    <th><?= lang('modal_upt');?></th>
                                </tr>
                                </thead>
                                <tbody class="seconddocument">
                                <?php  if($result) {
                                    foreach ($arrykeyholder as &$usearraykey) {

                                        foreach ($result[$usearraykey] as $key => $value) {
                                            if ($value['doc_type']==2) {

                                                $status='';
                                                switch ($value['status']) {
                                                    case 0: $status= lang('pending');break;
                                                    case 1: $status= lang('verified');break;
                                                    case 2: $status= lang('declined');break;
                                                    case 3: $status= lang('incomplete');break;
                                                    default:$status='';
                                                }

                                                echo '<tr id="tr'.$value['id'].'" class="tr'.$value['user_id'].' sdocument">';
                                                echo '<td><button type="button" class="mybutton hitdisplay" data-toggle="collapse" data-target="#collapseme'.$value['id'].'" data-id="'.$value['id'].'"> <span id="spn'.$value['id'].'" class="glyphicon glyphicon-plus"></span> ' . $value['client_name'] . '</button></td>';

                                                echo '<td>' .$status . '</td>';
                                                echo '<td>' . $value['date_uploaded'] . '</td>';
                                                echo '<td><a href="#" id="incomplete-nth-approve'.$value['id'].'"  data-id="'.$value['id'].'" class="incomplete-nth-approve queue-action"  data-target="#viewAcct">'.lang('modal_apprv').'</a> |<a href="#" id="incomplete-nth-decline'.$value['id'].'"   data-id="'.$value['id'].'" class="incomplete-nth-decline queue-action"  data-target="#viewAcct">'.lang('modal_dcln').'</a></td>';
                                                echo '</tr>';
                                                echo '<tr id="collapseme'.$value['id'].'" class="collapse"><td colspan="4" ><div>';
                                                echo '<img id="img'.$value['id'].'" src="'.$this->config->item('domain-my').'/assets/user_docs/'.$value['file_name'].'" class="img'.$value['user_id'].' centroid fimage img-responsive acct-ver-img"/>';
                                                echo '</div></td></tr>';
                                            }
                                        }
                                    }
                                }
                                ?>
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

<script type="text/javascript">
    $(document).on("click", ".hitdisplay", function () {
        var target = $(this).data('target');
        var id = $(this).data('id');
        $(target).on("hide.bs.collapse", function(){
            $("#spn"+id+"").addClass("glyphicon-plus");
            $("#spn"+id+"").removeClass("glyphicon-minus");
        });
        $(target).on("show.bs.collapse", function(){
            $("#spn"+id+"").addClass("glyphicon-minus");
            $("#spn"+id+"").removeClass("glyphicon-plus");
        });
    });
    var site_url="<?=FXPP::loc_url('')?>";

    $(window).load(function(){
        $("#t4").addClass("active-set-tab");
    });
    //    modal decline document
    $(document).on("click", ".modal-nth-decline", function () {
        var Id = $(this).data('id');
        $("#DocId").val(Id);
        $("#location").val('accountverification_incompletedocuments');
        $('#incStat').modal('hide');
    });
    //    modal decline document
    $(document).on("click", ".incomplete-nth-approve", function () {
        var Id = $(this).data('id');
        var prvt = [];
        prvt["data"] = {
            id: Id,
            select: 1
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/documentverificationchangestatus",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {

            window.location.href = site_url+'administration/accountverification_incompletedocuments';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {

            window.location.href = site_url+'administration/accountverification_incompletedocuments';
        });

        pblc['request'].always(function( jqXHR, textStatus ) {

            window.location.href = site_url+'administration/accountverification_incompletedocuments';
        });
    });

    $(document).on("click", ".incomplete-nth-decline", function () {
        var Id = $(this).data('id');
        var prvt = [];
        prvt["data"] = {
            id: Id,
            select: 2
        };
        pblc['request'] = $.ajax({
            dataType: 'json',
            url: site_url+"administration/documentverificationchangestatus",
            method: 'POST',
            data: prvt["data"]
        });

        pblc['request'].done(function( data ) {

            window.location.href = site_url+'administration/accountverification_request';
        });

        pblc['request'].fail(function( jqXHR, textStatus ) {

            window.location.href = site_url+'administration/accountverification_request';
        });

        pblc['request'].always(function( jqXHR, textStatus ) {

            window.location.href = site_url+'administration/accountverification_request';
        });
    });



    $(document).on("click", ".incomplete", function () {
        var userid = $(this).data('userid');
        var Id = $(this).data('id');
        var fullname = $(this).data('fullname');
        var email = $(this).data('email');
        var address = $(this).data('address');
        $(".modal-body .accountnumber").text( userid );
        $(".modal-body .fullname").text( fullname );
        $(".modal-body .email").text( email );
        $(".modal-body .address").text( address );
        $("#changestatus").addClass('default-c');

        $("#myuserid").val(userid);

        $('.firstdocument').find('.fdocument').removeClass('displayn');
        $('.seconddocument').find('.sdocument').removeClass('displayn');
        $('.firstdocument').find('.fdocument').addClass('displayn');
        $('.seconddocument').find('.sdocument').addClass('displayn');

        $("#tr"+Id+"").removeClass('displayn');
        $(".tr"+userid+"").removeClass('displayn');
        $("#changestatus").attr('disabled' , true);
    });

    $(document).ready( function (){
        $('#selectaction').change(function(){
            $("#changestatus").removeClass('default-c');
            $("#changestatus").attr('disabled' , false);
        });
    });

</script>
<script type="text/javascript">

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
        pblc['FormChangeStatus'] = $('#FormChangeStatus').validate({
            rules:{
                myuserid:{required : true},
                selection:{required : true},
            },
            messages: {
            }, submitHandler: function(form) {

                if(!$("#validations").hasClass('displayn')){
                    $("#validations").addClass('displayn');
                }
                var prvt = [];
                prvt["data"] = {
                    userid: $('#myuserid').val(),
                    select: $('#selectaction').val(),
                    userlocation: $('#userlocation').val()
                };
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url:form.action,
                    method: 'POST',
                    data: prvt["data"]
                });

                pblc['request'].done(function( data ) {
                    if(data.response){
                        $("#validations").html(data.message);
                        $("#validations").removeClass('displayn');
                    }else{
                        window.location.href = site_url+'administration/accountverification_request';
                    }
                });

                pblc['request'].fail(function( jqXHR, textStatus ) {
                    $("#validations").html('System Error');
                    $("#validations").removeClass('displayn');
                });

                pblc['request'].always(function( jqXHR, textStatus ) {
                });
            }
        });

    });
</script>

<?= $this->load->ext_view('modal', 'AVdecline', '', TRUE); ?>