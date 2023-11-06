<style type="text/css">
    div.dataTables_paginate {
        white-space: nowrap;
        text-align: right;
        float: right;
        margin-top: 2%;
        margin-right: -12px;
    }
    div.dataTables_paginate a.paginate_button {
        margin: 2px 0;
        white-space: nowrap;
    }
    a.previous {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    a.next {
        margin-left: 0;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    a.paginate_button.current {
        background: #337ab7;
        color: #fff;
        border: 1px solid #337ab7;
    }
    a.paginate_button {
        background: #fafafa;
        color: #666;
    }
    a.paginate_button{
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    div.dataTables_length select {
        width: 75px;
        display: inline-block;
        border-radius: 0;
        box-shadow: none;
        border-color: #d2d6de;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
    }
    .dataTables_length {
        width: 50%;
        float: left;
        margin-bottom: 1%;
    }

    div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
        -webkit-appearance: none;
        box-sizing: border-box;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
    }
    .dataTables_filter {
        width: 49%;
        float: right;
        margin-bottom: 1%;
    }
    .ellipsis {
        margin: 2px 0;
        white-space: nowrap;
        float: left;
        position: relative;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
        background: #fafafa;
    }
</style>
<?php if(isset($his_result)){?>
    <script>
        $(document).ready(function(){
            $('.breadcrumb .active').text('History of Trades');
            $( "a#tab-cur" ).parent().removeClass('active');
            $('#tab_1').removeClass('active');
            $( "a#tab-his" ).parent().addClass('active');
            $('#tab_2').addClass('active');
            $('#data-history').show();
            $('#data-current').hide();
        });
    </script>
<?php } ?>
<?php if(isset($curtrade)){?>
    <script>
        $(document).ready(function(){
            $('.breadcrumb .active').text('Current Trades');
            $( "a#tab-cur" ).parent().addClass('active');
            $('#tab_1').addClass('active');
            $( "a#tab-his" ).parent().removeClass('active');
            $('#tab_2').removeClass('active');
            $('#data-current').show();
            $('#data-his').hide();
        });
    </script>
<?php } ?>

<section class="content-header">
    <h1>Trades</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-briefcase"></i> Trades</li>
        <li class="active">Current Trades</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box style-box">
        <div class="box-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-personal-tabs">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom style-customized-navigation-tab">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" id="tab-cur">Current</a></li>
                        <li><a href="#tab_2" data-toggle="tab" id="tab-his">History</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <!--Current Tab-->
                        <div class="tab-pane active" id="tab_1">
                            <div class="mini-form-container" style="width: 30%;margin-left: 35%;">
                                <?= form_open('trades/search_current_trades',array('id' => 'searchCurrent','class'=> '', 'enctype'=>"multipart/form-data"),''); ?>
                                <label style="text-align: left; width:135px;"> Account number : </label>
                                <input id="account_number_cur" name="account_number_cur" type="text" class="tab-input-form numerical" placeholder="Account number" style="padding: 5px;" require/>
                                <button type="submit" class="tab-input-button style-table-in-button" style="padding: 7px;font-weight: normal;" id="btn_search_current">Search</button>
                                <?=form_close();?>
                            </div>
                            <div class="style-form-table-responsive" id="data-current" style="display: none;">
                                <table id="trades-current" class="table table-bordered table-striped dataTable style-form-table" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Time</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Ticket</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Type</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Volume</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Symbol</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Open Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">S/L</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">T/P</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Close Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Swaps</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Profit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($curtrade)){?>
                                        <?php foreach ($curtrade as $key){
                                            $data['volume'] = floatval($key->Volume)!=0?(floatval($key->Volume)/100):floatval($key->Volume);
                                            ?>
                                            <tr>
                                                <td><?php echo "N/A - Trade is active.";?></td>
                                                <td><?=$key->OrderTicket;?></td>
                                                <td><?=$key->TradeType;?></td>
                                                <td><?=$data['volume'];?></td>
                                                <td><?=$key->Symbol;?></td>
                                                <td><?=$key->OpenPrice;?></td>
                                                <td><?=$key->StopLoss;?></td>
                                                <td><?=$key->TakeProfit;?></td>
                                                <td><?=$key->ClosePrice;?></td>
                                                <td>N/A</td>
                                                <td><?=$key->Profit;?></td>
                                            </tr>
                                        <?php }  ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <!--History tab-->
                        <div class="tab-pane" id="tab_2">
                            <div class="mini-form-container" style="width: 30%;margin-left: 35%;">
                                <?= form_open('trades/search_history_trades',array('id' => 'searchHistory','class'=> '', 'enctype'=>"multipart/form-data"),''); ?>
                                <label style="text-align: left; width:135px;"> Account number : </label>
                                <input id="account_number_his" name="account_number_his" type="text" class="tab-input-form numerical" placeholder="Account number" style="padding: 5px;" require/>
                                <button type="submit" class="tab-input-button style-table-in-button" style="padding: 7px;font-weight: normal;" id="btn_search_history">Search</button>
                                <?=form_close();?>
                            </div>

                            <div class="style-form-table-responsive" id="data-history" style="display: none;">
                                <table id="trades-history" class="table table-bordered table-striped dataTable style-form-table" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Time</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Ticket</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Type</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Volume</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Symbol</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Open Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">S/L</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">T/P</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Close Price</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Swaps</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Profit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($trade)){?>
                                        <?php foreach ($trade as $key){
                                            $data['volume'] = floatval($key->Volume)!=0?(floatval($key->Volume)/100):floatval($key->Volume);
                                            ?>
                                            <tr>
                                                <td><?=date('Y-M-d H:i:s',strtotime($key->CloseTime));?></td>
                                                <td><?=$key->OrderTicket;?></td>
                                                <td><?=$key->TradeType;?></td>
                                                <td><?=$data['volume'];?></td>
                                                <td><?=$key->Symbol;?></td>
                                                <td><?=$key->OpenPrice;?></td>
                                                <td><?=$key->StopLoss;?></td>
                                                <td><?=$key->TakeProfit;?></td>
                                                <td><?=$key->ClosePrice;?></td>
                                                <td>N/A</td>
                                                <td><?=$key->Profit;?></td>
                                            </tr>
                                        <?php }  ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>


        </div> <!--Box body-->
    </div>
</section>
<!-- /.content -->
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<?php if(isset($trade)){?>
    <script type="text/javascript">
        $('#data-history').show();
    </script>
<?php }?>
<?php if(isset($totalTradedVolume)){?>
    <script type="text/javascript">
        $(document).ready(function(){
            var text = '<div style="display: inline;float: right;"><strong>Total Trade Volume: </strong>  <?=$totalTradedVolume?></div>';
            $("#trades-history_info").append(text);
            console.log("<?=$totalTradedVolume?>");
        })
    </script>
<?php }?>
<?php if(isset($curtotal)){?>
    <script type="text/javascript">
        $(document).ready(function(){
            var text = '<div style="display: inline;float: right;"><strong>Total Trade Volume: </strong>  <?=$curtotal?></div>';
            $("#trades-current_info").append(text);
            console.log("<?=$curtotal?>");
        })
    </script>
<?php }?>
<script>
    $('#trades-history').DataTable({
        "bSort": false,
        "ordering": false
    });
    $('#trades-current').DataTable({
        "bSort": false,
        "ordering": false
    });

    $(document).on('click','#tab-his',function(){
        $('.breadcrumb .active').text('History of Trades');
    });
    $(document).on('click','#tab-cur',function(){
        $('.breadcrumb .active').text('Current Trades');
    });
    $(document).on('click','#btn_search_current',function(){
        var base_url = "<?php echo FXPP::ajax_url('trades/search_current_trades')?>//";
        var account_number = $("#account_number_cur").val();
        var isnum = $.isNumeric(account_number);
        showloader();
        if(account_number!='' && isnum){
            document.getElementById("searchCurrent").submit();
            hideloader();
        }else{
            hideloader();
            $("#modal-invalid2").modal('show');
        }
    });
    $(document).on('click','#btn_search_history',function(){
        var base_url = "<?php echo FXPP::ajax_url('trades/search_history_trades')?>//";
        var account_number = $("#account_number_his").val();
        var isnum = $.isNumeric(account_number);
        showloader();
        if(account_number!='' && isnum){
            document.getElementById("searchHistory").submit();
            hideloader();
        }else{
            hideloader();
            $("#modal-invalid2").modal('show');
        }
    });
</script>
<div class="modal fade" id="modal-invalid2" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;">Please enter a valid account number.</span>
                </div>
            </div>
        </div>
    </div>
</div>
