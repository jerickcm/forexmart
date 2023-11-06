<link href="<?= $this->template->Css()?>custom_landing.css" rel="stylesheet">
<section class="content-header">
    <h1>Quick Jump</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-paper-plane"></i> Quick Jump</li>
        <li class="active">Personal</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box style-box">
        <div class="box-body">

            <div class="style-form-table-responsive">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <!--                    <select style="padding: 5px; margin-left: 30%;"><option>Account Number</option><option>Email</option></select>-->
                    <input type="text" name="search_account_number" id="search_account_number" placeholder="Enter account number or email" value="<?php echo (isset($previous))?$previous:""?>" class="account-search" style="margin-left: 30%;"><button class="style-table-in-button view-profile" id="search-btn">Search</button>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12" style="<?php echo (isset($success) && $success)?"display:block":"display:none"?>;" id="div-table">
                            <table id="verified-accounts" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head" >
                                <thead>
                                <tr role="row">
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Account Number</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Name</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Email</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Type</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Action</th>
                                </tr>
                                </thead>
                                <tbody id="info-row">
                                <?php if(isset($success)){ echo $info;  }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /.content -->
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script>
    var table = $('#verified-accounts').DataTable();
    var site_url="<?=site_url('')?>";
    $(document).on('click','#search-btn',function () {
        var account = $('#search_account_number').val();
//        var isnum = $.isNumeric(account);
        if(account!=''){
            $.ajax({
                type: 'POST',
                url: "<?php echo FXPP::ajax_url('quick-jump/search_accountNumber')?>",
                dataType: 'json',
                data: {  account:account },
                beforeSend: function(){  showloader();  },
                success: function(data) {
                    hideloader();
                    if(data.success){
                        table.destroy();
                        $('#info-row').html(data.info);
                        $('#div-table').show();
                        table = $('#verified-accounts').DataTable();
                    }else{
                        $('#error-msg').text('Please enter a valid account number or email.');
                        $('#modal-invalid2').modal('show');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    hideloader();
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }else{
            hideloader();
            $('#error-msg').text('Please enter a valid account number or email.');
            $('#modal-invalid2').modal('show');
        }
    });
</script>
<div class="modal fade" id="modal-invalid2" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;" id="error-msg"></span>
                </div>
            </div>
        </div>
    </div>
</div>