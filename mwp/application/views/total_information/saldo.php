<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

<?php if(IPLoc::Office()){
    $monday = DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday this week")))->format('m/d/Y');
    $friday =  DateTime::createFromFormat('Y/d/m',   date('Y/d/m',strtotime("monday this week")))->format('m/d/Y');
?>

    <section class="content-header">
      <h1>
        Total Saldo
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-shield"></i> Information</li>
        <li class="active">Total Saldo</li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <div class="style-saldo-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <form class="form-horizontal">
                <div class="form-group">
                    <label>Account Number</label>
                    <textarea name="account-numbers" class="form-control" rows="3" placeholder="Enter Account Number/s"></textarea>
                    <span>* For multiple account numbers, please use comma (,) as a separator.</span>
                </div>
                <div class="style-saldo-picker">
                  <div class="saldo-datepicker">
                    <label>From:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="datePicker1" name="date-from" type="text" class="form-control pull-right" placeholder=""  value="<?php echo $monday; ?>" />
                    </div>
                  </div>
                  <div class="saldo-datepicker">                
                    <label>To:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="datePicker2" name="date-to" type="text" class="form-control pull-right" placeholder="" value="<?php echo $friday; ?>">
                    </div>
                  </div>
                </div>
                <div class="saldo-calculate-button">
                        <a href="javascript:void(0)" class="hit hitseek btn-calculate">Calculate</a>
                </div>
            </form>
          </div>

          <div class="style-form-table-responsive">
            <table id="compute-saldo" class="table table-bordered table-striped dataTable style-form-table mid-table-head table-saldo-right-text" role="grid" >
                <thead>
                <tr role="row">
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 295px;">Account Number</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 361px;">Name</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 321px;">Saldo</th>
                </tr>
                </thead>
                <tbody id="tr_data">
                </tbody>
            </table>
           </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="" style="width: 100%;">
        <div class="modal-dialog round-0" style="margin-left: 40%;">
            <div class="modal-content round-0">
                <div class="modal-body modal-show-body">
                    <div class="text-center manage-credit-prize-alert-message">
                        <span style="color: red;font-size:18px;font-weight: bold;" id="error-msg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?> -->

    <script type="text/javascript">
        showloader();

        var site_url="<?=site_url('')?>";
        var pblc = [];
        
        pblc['request'] = null;
        if(pblc['request'] != null) pblc['request'].abort();
        $(window).load(function() {
            hideloader();
        });

        $(function(){
            $('#datePicker1').datepicker();
            $('#datePicker2').datepicker();
        });

        $(document).on("click", ".hitseek", function () {
            showloader();
            var prvt = [];
            prvt["data"] = {
                accountnumbers: $('textarea[name=account-numbers]').val(),
                from: $('input[name=date-from]').val(),
                to: $('input[name=date-to]').val()
            };
            var acctno = $('textarea[name=account-numbers]').val();
            var string = acctno.replace(/[,]/g, '');
            var str = string.replace(/\s/g, '');
            var isnum = $.isNumeric(str);
//            console.log(string);
//            console.log(str);
//            console.log(isnum);
            if($('textarea[name=account-numbers]').val()!='' && isnum){
                pblc['request'] = $.ajax({
                    dataType: 'json',
                    url: site_url+"query/calculate_saldo",
                    method: 'POST',
                    data: prvt["data"]
                });
                pblc['request'].done(function( data ) {
//                    console.log(data);
                    if(data.msg=="There are no data yet."){
                        $('#tr_data').html('<tr><td colspan="3" style="text-align:center;">No Data Available.</td></tr>');
                    }else{
                        $('#tr_data').html(data.tr);
                    }
                });
                pblc['request'].fail(function( jqXHR, textStatus ) {
                    hideloader();
                });
                pblc['request'].always(function( jqXHR, textStatus ) {
                    hideloader();
                });
            }else{
                hideloader();
                $("#modal-error").modal('show');
                $("#error-msg").html('Please enter a valid account number.');
            }
        });
    </script>
    <?php }else{?>
        <div class="tab-pane active" id="check-phone-password">
            <div class="tab-title-header">
                <h1>Saldo Total</h1>
            </div>
        <div class="mini-form-container">
            <form method="post" action="">
                <div class="child-input-form">
                    <label>Login</label>
                    <input name="account_number" type="text" class="tab-input-form" placeholder="Login" value="<?=set_value('account_number')?>"/>
                    <span style="color: #ff0000"><?php echo form_error('account_number'); echo isset($msg)?$msg:"";?></span>
                </div>

                <div class="child-input-form">
                    <button type="submit" class="tab-input-button green-input-button">Show</button>
                </div>
            </form>
        </div>

        <?php if(isset($result)){?>
            <div class="tab-title-header">
                <h1>Saldo Total</h1>
            </div>
            <div  class="table-container-holder table-container-border table-container-margin data-center-container">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <span>Account Number : &nbsp;</span>
                            <label><?=$LogIn?></label>
                        </td>
                        <td>
                            <span>Balance: &nbsp;</span>
                            <label> <?=$Balance?></label>
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>
        </div>
    <?php }?>