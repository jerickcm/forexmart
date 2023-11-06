<div class="tab-title-header">
    <h1>Balance Records</h1>
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
            <td>
                <span>Equity : &nbsp;</span>
                <label><?=$Equity?></label>
            </td>
            <td>
                <span>FreeMargin : &nbsp;</span>
                <label><?=$FreeMargin?></label>
            </td>

            <td>
                <span>Margin : &nbsp;</span>
                <label><?=$Margin?></label>
            </td>
            <td>
                <span>Ticket : &nbsp;</span>
                <label><?=$Ticket?></label>
            </td>

        </tr>

    </table>
</div>
<?php if(isset($result)){?>
    <div class="tab-title-header">
        <h1>Deposit Balance</h1>
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
                    <label> <?=$deposit?></label>
                </td>
            </tr>

        </table>
    </div>

    <div class="tab-title-header">
        <h1 class="">Withdrawal Balance</h1>
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
                    <label> <?=$withdrawal?></label>
                </td>
            </tr>

        </table>
    </div>
<?php }else{ ?>

    <div class="tab-title-header">
        <h1>Balance Records</h1>

        <div  class="table-container-holder table-container-border table-container-margin data-center-container">
            <table id="OpenedTrades" class="table table-striped tab-my-acct">
                <tr>
                    <td id="tr-msg"  colspan="5"><?= $msg?> </td>
                </tr>
            </table>

        </div>

    </div>
<?php } ?>

