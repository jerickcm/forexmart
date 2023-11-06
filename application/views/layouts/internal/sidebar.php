<div class="col-lg-3 col-md-3 col-sm-3" style="border-right: 1px solid #ccc;">
    <div class="dl-holder">
        <?php if($this->session->flashdata('virtual_account_message')){ echo '<div style="margin-top: 10px;">' . $this->session->flashdata('virtual_account_message') . '</div>'; } ?>
        <?php if(FXPP::hasCreateVirtualAccount()){ ?>
        <h1 class="accbal-title">ForexMart Virtual Account</h1>
        <div class="form-group">
            <div class="input-group">
                <input type="text" disabled="disabled" class="form-control round-0 txt-balance" placeholder="" Value="0.00">
                <div class="input-group-addon round-0 euro-sign"><select class="form-control">
                        <?php
                        $account_curreny = FXPP::getUserAccountCurrencyBase();
                        foreach( $account_curreny as $key => $value ){
                            echo "<option value=\"$key\">$value</option>";
                        }
                        ?>
                    </select></div>
            </div>
        </div>
        <?php } ?>
            <div class="btn-virtual-holder">

                <?php if(FXPP::canCreateVirtualAccount()){ ?>
                    <a href="#" class="btn-virtual" data-toggle="modal" data-target="#virtualModal">Create Virtual Account</a>
                <?php }else{ ?>
                    <a href="#" class="btn-virtual-disable">Create Virtual Account</a>
                <?php } ?>
            </div>
        <div class="btn-deposit-holder">
<!--            <button class="btn-deposit">Deposit Funds</button>-->
            <a href="<?php echo base_url();?>transactions/deposit" class="btn-deposit">Deposit Funds</a>
        </div>
        <div class="btn-withdraw-holder">
<!--            <button class="btn-withdraw">Withdraw Funds</button>-->
            <a href="<?php echo base_url();?>transactions/withdraw" class="btn-withdraw">Withdraw Funds</a>
        </div>
        <div class="dls">
            <h1>Download platforms</h1>
            <ul class="platforms">
                <li>
                    <a href="#">
                        <img src="<?= $this->template->Images()?>fx1.png" class="img-reponsive" width="50px" height="50px" style="float: left;">
                        ForexMart Client Terminal<br><cite>MT4 Platform</cite>
                    </a>
                </li><div class="clearfix"></div>
                <li>
                    <a href="#">
                        <img src="<?= $this->template->Images()?>fx2.png" class="img-reponsive" width="50px" height="50px" style="float: left;">
                        ForexMart MultiTerminal<br><cite>Multi-MT4</cite>
                    </a>
                </li><div class="clearfix"></div>
                <li>
                    <a href="#">
                        <img src="<?= $this->template->Images()?>fx3.png" class="img-reponsive" width="50px" height="50px" style="float: left;">
                        ForexMart WebTrader<br><cite>MT4 Online</cite>
                    </a>
                </li><div class="clearfix"></div>
                <li>
                    <a href="#">
                        <img src="<?= $this->template->Images()?>fx4.png" class="img-reponsive" width="50px" height="50px" style="float: left;">
                        ForexMart iPhone<br><cite>Trader</cite>
                    </a>
                </li><div class="clearfix"></div>
                <li>
                    <a href="#">
                        <img src="<?= $this->template->Images()?>fx5.png" class="img-reponsive" width="50px" height="50px" style="float: left;">
                        ForexMart iPad<br><cite>Trader</cite>
                    </a>
                </li><div class="clearfix"></div>
                <li>
                    <a href="#">
                        <img src="<?= $this->template->Images()?>fx6.png" class="img-reponsive" width="50px" height="50px" style="float: left;">
                        ForexMart Android<br><cite>Transfer</cite>
                    </a>
                </li><div class="clearfix"></div>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="virtualModal" tabindex="-1" role="dialog" aria-labelledby="virtualModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <?php echo form_open('accounts/createVirtualAccount', array('role' => 'form', 'id' => 'createVirtualAccount')) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Virtual Account</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label for="virtualCurreny" class="col-sm-4">Currency</label>
                        <div class="col-sm-8">
                        <select name="virtual_currency" class="form-control">
                        <?php
                            $account_curreny = FXPP::getAccountCurrencyBase();
                            foreach( $account_curreny as $key => $value ){
                                echo "<option value=\"$key\">$value</option>";
                            }
                        ?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>