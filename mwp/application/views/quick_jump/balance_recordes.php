<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Balance Recordes</h1>
        <!--<div class="tab-search-bar">
            <input type="text" class="tab-input-form" placeholder="Type here..."/>
            <button type="submit" class="tab-input-button green-input-button go-button">Go</button>
        </div>-->
    </div>
    <div class="mini-form-container">
        <form method="post" action="">
            <!-- START INCORRECT RESULT -->
            <!--<div class="child-error-form incorrect-error-form">
                <p>Incorrect Data</p>
            </div>-->
            <!-- END INCORRECT RESULT -->

            <!-- START CORRECT RESULT -->

            <!-- END CORRECT RESULT -->

            <div class="child-input-form">
                <label>Login</label>
                <input name="account_number" type="text" class="tab-input-form" placeholder="Login" value="<?=set_value('account_number')?>"/>
                <span style="color: red"><?php echo form_error('account_number'); echo isset($msg)?$msg:"";?></span>
            </div>

            <div class="child-input-form">
                <button type="submit" class="tab-input-button green-input-button">Show</button>
            </div>
        </form>
    </div>


    <?php if(isset($result)){?>


        <div class="tab-title-header">
            <h1>Balance Recordes</h1>
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
    <?php } ?>
</div>