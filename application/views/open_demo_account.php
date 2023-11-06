<style type="text/css">
    div.open-demo-cont{
        margin-top: 25px;
    }
</style>

<h1 class="">Open Demo Account</h1>
<div class="col-md-7 col-centered open-demo-cont">
    <form action="" method="post" class="form-horizontal open-demo-account-form" id="open_demo">
        <div class="form-group">
            <label class="col-sm-5 control-label">Account Type<cite class="req">*</cite></label>
            <div class="col-sm-7">
                <select class="form-control round-0" name="acct_type">
                    <?php echo $accountType;?>
                </select>
                <?php echo  form_error('acct_type')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">Account Currency Base<cite class="req">*</cite></label>
            <div class="col-sm-7">
                <select class="form-control round-0" name="acct_cur_base">
                    <?php echo $accountCurrencyBase;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">Leverage<cite class="req">*</cite></label>
            <div class="col-sm-7">
                <select class="form-control round-0" name="acct_leverage">
                    <?php echo $leverage;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">Amount<cite class="req">*</cite></label>
            <div class="col-sm-7">
                <select class="form-control round-0" name="acct_amt">
                    <?php echo $amount;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="button" class="btn-submit" id="btn-demo-complete">Complete</button>
            </div><div class="clearfix"></div>
        </div>
    </form>
</div>

<script type="text/javascript">

    $(document).ready(function(){

        $('div.open-demo-cont').on("focus",'select',function(){
            $(this).css('border','');
            $(this).removeClass("red-border");

        });

        $('div.open-demo-cont').on("click", "#btn-demo-complete", function(){
            flag = true;
            $("select.form-control").each(function(){
                if($(this).val().length>0){
                    $(this).removeClass("red-border");
                }else{
                    $(this).addClass("red-border");
                    // $(this).focus();
                    flag = false;
                }
            });

            if(flag){
                $("#open_demo").submit();
                // $("#next").attr("href",'#step3');
                //$("#next").click();
            }
        });
    });
</script>
