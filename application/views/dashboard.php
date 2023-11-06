<style type="text/css">
    .dashboard > thead > tr > th {
        text-align: center;
    }
    .dashboard > tbody > tr > td {
        text-align: center;
    }
</style>

<h1 class="">My Accounts</h1>
<div class="col-md-9 col-sm-9" style="padding-left: 0;">
    <div class="btns">
        <a href="<?php echo base_url();?>accounts/open-trading-account" class="open-trading">Open Trading Account</a>
        <a href="<?php echo base_url();?>accounts/open-demo-account" class="open-demo">Open Demo Account</a>
    </div><div class="clearfix"></div>
</div>
<div class="col-md-3 col-sm-3" style="padding-right: 0;">
    <button class="show-hide" data-toggle="modal" data-target="#popfilter">Filters</button>
</div>
<div class="col-md-12" style="padding: 0; margin-top: 20px;">
    <div class="table-responsive">
        <table class="table table-striped dashboard" style="border: 1px solid #ccc;">
            <thead>
            <tr>
                <th>Account(s)/Actions</th>
                <th>Leverage</th>
                <th>Currency</th>
                <th>Free Margin</th>
                <th>Balance</th>
                <th>Status</th>
                <th>Type</th>
                <th>Account Type</th>
            </tr>
            </thead>
            <tbody id="accounts-table">
            <?php
            if( count($accounts) > 0 ){
                foreach( $accounts as $account ){
            ?>

            <tr>
                <td style="color: #ff0000;"><i class="fa fa-caret-down"></i></td>
                <td><?php echo $account['leverage'] ?></td >
                <td><?php echo $account['mt_currency_base'] ?></td>
                <td><?php echo $account['amount'] == '' ? 0 : $account['amount']; ?> </td>
                <td><?php echo $account['amount'] == '' ? 0 : $account['amount']; ?></td>
                <td></td>
                <td><?php echo $account['mt_type'] ? 'Trading' : 'Demo' ?></td>
                <td><?php echo $account['account_type'] ?></td>
            </tr >
            <?php
                }
            }
            ?>
            <!--
            <tr>
                <td style="color: #ff0000;">4515830 <i class="fa fa-caret-down"></i></td>
                <td>1:100</td>
                <td>USD</td>
                <td>5,000.00</td>
                <td>5,000.00</td>
                <td>Appoved</td>
                <td>demo</td>
                <td>MT4</td>
            </tr>
            <tr>
                <td style="color: #ff0000;">4515830 <i class="fa fa-caret-down"></i></td>
                <td>1:100</td>
                <td>USD</td>
                <td>5,000.00</td>
                <td>5,000.00</td>
                <td>Appoved</td>
                <td>demo</td>
                <td>MT4</td>
            </tr>
            -->
            </tbody>
        </table>
    </div>

</div>
<div class="col-md-12" style="padding: 0; margin-top: 20px;">
    <div class="deposits-holder">
        <h1>Deposit Option</h1>
        <div class="banks">
            <div id="demo">
                <div class="span12">

                    <div id="owl-demo" class="owl-carousel">
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>banktransfer.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>visa.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>mastercard.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>unionpay.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>skrill.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>neteller.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>webmoney.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>paxum.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>ukash.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>payco.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>filspay.png" alt="Lazy Owl Image"></a></div>
                        <div class="item"><a href="#"><img class="lazyOwl" data-src="<?= $this->template->Images()?>cashu.png" alt="Lazy Owl Image"></a></div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="popfilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title poptitle" id="myModalLabel">Set Filter Properties</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="popcheck_filter">
                    <div class="col-sm-4 popcheck-holder" id="mt_type_cont">
                        <label>Status</label>
                        <?php echo $mt_type; ?>
                    </div>
                    <div class="col-sm-4 popcheck-holder" id="mt_currency_base_cont">
                        <label>Currency</label>
                        <?php echo $mt_currency_base; ?>
                    </div>
                    <div class="col-sm-4 popcheck-holder" id="mt_account_set_id_cont">
                        <label>Account Type</label>
                        <?php echo $mt_account_set_id; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" id="upd-Btn" class="btn btn-primary round-0">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<script type="text/javascript">
    $(document).ready(function(){
        var baseurl = '<?php echo base_url();?>';
        $('div#popfilter').on('click', 'button#upd-Btn', function(){
            var mt_type_dts = $("#mt_type_cont input:checkbox:checked").map(function(){return $(this).val();}).toArray();
            var mt_currency_base_dts = $("#mt_currency_base_cont input:checkbox:checked").map(function(){return $(this).val();}).toArray();
            var mt_account_set_id_dts = $("#mt_account_set_id_cont input:checkbox:checked").map(function(){return $(this).val();}).toArray();
            $.ajax({
                type: 'POST',
                url: baseurl+'accounts/updateAccountsFilter',
                data: {
                    mt_type_dts:mt_type_dts,
                    mt_currency_base_dts:mt_currency_base_dts,
                    mt_account_set_id_dts:mt_account_set_id_dts
                },
                dataType: 'json'
            }).done(function(response){
                $('tbody#accounts-table').html(response);
                $('#popfilter').modal('toggle');
            });
        });
    });
</script>