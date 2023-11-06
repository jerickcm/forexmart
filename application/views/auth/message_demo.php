<style>
    .red{text-align: left; color: red;}
    .form-holder h1{text-align: left;}
    .form-text{ text-align: left;}
    .text-font{ font-family: Open Sans!important;}
</style>
<div class="reg-form-holder" xmlns="http://www.w3.org/1999/html">
    <div class="container">

        <div class="row col-centered col-lg-6 col-md-6">
            <h1><?=lang('rede_10')?></h1><br>
            <p><?=lang('rede_11')?>.</p><br>
            <label><?=lang('rede_12')?>: </label>  <?php echo $account_number; ?><br>
            <label class=""><?=lang('rede_13')?>:</label> <?php echo $trader_password; ?><br>
            <label class=""><?=lang('rede_14')?>:</label> <?php echo $investor_password; ?><br>
            <label class=""><?=lang('rede_15')?>:</label> <?php echo MT4_SERVER_DEMO ?><br><br>
            <p class=""><?=lang('rede_16')?>.</p>
            <div class="clearfix"></div>
        </div>
    </div>
</div>