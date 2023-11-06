<style>
    .child-input-form label {
        margin-left: 20%;
    }
    .child-error-form, .child-input-form input[type=text] {
        width: 60%!important;
        margin-left: 20%;
    }
    .child-error-form p {
        text-align: center;
        padding-left: 0 !important;
    }
</style>
<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Check Phone Password</h1>
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
                <label>Account Number</label>
                <input name="account_number" id="acct_no" type="text" class="tab-input-form numeric" placeholder="Account Number" value="<?=set_value('account_number')?>"/>
                <!-- <span style="color: red"><?php //echo form_error('account_number')?></span> -->
            </div>

            <div class="child-input-form">
                <label>Phone Password</label>
                <input name="phone_password" id="phone_no" type="text" class="tab-input-form" placeholder="Phone Password" value="<?=set_value('phone_password')?>"/>
                <!-- <span style="color: red"><?php //echo form_error('phone_password')?></span> -->
            </div>
            

            <div class="child-input-form">
                <button type="submit" class="tab-input-button green-input-button" style="float: none; width: 20%!important;margin-left: 60%;">Search</button>
            </div>

            <div class="modal fade" id="modal-invalid" tabindex="-1" role="dialog" aria-labelledby="">
                <div class="modal-dialog round-0">
                    <div class="modal-content round-0">
                        <div class="modal-body modal-show-body">
                            <div class="text-center manage-credit-prize-alert-message">
                                <span style="color: red;font-size:18px;font-weight: bold;">The account does not exist.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-invalid2" tabindex="-1" role="dialog" aria-labelledby="">
                <div class="modal-dialog round-0">
                    <div class="modal-content round-0">
                        <div class="modal-body modal-show-body">
                            <div class="text-center manage-credit-prize-alert-message">
                                <span style="color: red;font-size:18px;font-weight: bold;">Invalid phone password.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-noinput" tabindex="-1" role="dialog" aria-labelledby="">
                <div class="modal-dialog round-0">
                    <div class="modal-content round-0">
                        <div class="modal-body modal-show-body">
                            <div class="text-center manage-credit-prize-alert-message">
                                <span style="color: red;font-size:18px;font-weight: bold;">Please complete all the fields.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-match" tabindex="-1" role="dialog" aria-labelledby="">
                <div class="modal-dialog round-0">
                    <div class="modal-content round-0">
                        <div class="modal-body modal-show-body">
                            <div class="text-center manage-credit-prize-alert-message">
                                <span style="color: green;font-size:18px;font-weight: bold;">Phone Password Match.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.green-input-button').click(function (e) {
            var p_number = $('#phone_no').val();
            var a_number = $('#acct_no').val();

            if ((p_number == '') || (a_number == '')){
                $(document).ready(function () {
                    $("#modal-noinput").modal('show');
                    $("#acct_no").css('border-color', 'red');
                    $("#phone_no").css('border-color', 'red');
                    e.preventDefault();
                });
            }
        });
    });
    <?php if ($result=="pp_match"){?>
        $(document).ready(function () {
            $("#modal-match").modal('show');
        });
    <?php }?>

    <?php if ($result=="acc_err"){?>
        $(document).ready(function () {
            $("#modal-invalid").modal('show');
            $("#acct_no").css('border-color', 'red');
        });
    <?php }?>

    <?php if ($result=="ph_err"){?>
        //console.log($('#phone_no').val());
        $(document).ready(function () {
            $("#modal-invalid2").modal('show');
            $("#phone_no").css('border-color', 'red');
        });
    <?php }?>

</script>
