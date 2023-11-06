<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Only Traders</h1>
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
        <h1>Only Traders</h1>
    </div>
    <div  class="table-container-holder table-container-border table-container-margin data-center-container">
        <table id="OpenedTrades" class="table table-striped tab-my-acct">
            <thead>
            <tr>
                <th>
                    <?=lang('curtra_04');?>
                </th>
                <th>
                    <?=lang('curtra_05');?>
                </th>
                <th>
                    <?=lang('curtra_06');?>
                </th>
                <th>
                    <?=lang('curtra_07');?>
                </th>
                <th>
                    <?=lang('curtra_08');?>
                </th>
                <th>
                    <?=lang('curtra_09');?>
                </th>
                <th>
                    <?=lang('curtra_10');?>
                </th>
                <th>
                    <?=lang('curtra_11');?>
                </th>
                <th>
                    <?=lang('curtra_12');?>
                </th>
                <th>
                    <?=lang('curtra_13');?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?= $Opened?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>