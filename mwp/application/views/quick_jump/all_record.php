<div>
    <?php if(isset($user_info)){?>


        <div class="tab-title-header">
            <h1 class="all_tab_title" style="line-height: 25px;margin-top: 15px;">All Records</h1>
        </div>
        <div  class="table-container-holder table-container-border table-container-margin data-center-container">
            <div class="tab-title-header">
                <h1>Personal Information</h1>
            </div>
            <table cellpadding="0" cellspacing="0" style="width: 95%;">
                <tr>
                    <td>
                        <span>Name : &nbsp;</span>
                        <label><?=$Name?></label>
                    </td>
                    <td>
                        <span>Email: &nbsp;</span>
                        <label> <?=$Email?></label>
                    </td>
                    <td>
                        <span>Account Number : &nbsp;</span>
                        <label><?=$LogIn?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>City: &nbsp;</span>
                        <label><?=$City?></label>
                    </td>
                    <td>
                        <span>State : &nbsp;</span>
                        <label><?=$State?></label>
                    </td>

                    <td>
                        <span>Country : &nbsp;</span>
                        <label><?=$Country?></label>
                    </td>


                </tr>
                <tr>
                    <td>
                        <span>Address : &nbsp;</span>
                        <label><?=$Address?></label>
                    </td>
                    <td>
                        <span>Phone: &nbsp;</span>
                        <label> <?=$Phone?></label>
                    </td>
                    <td>
                        <span>Group: &nbsp;</span>
                        <label><?=$Group?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Leverage : &nbsp;</span>
                        <label><?=$Leverage?></label>
                    </td>

                    <td>
                        <span>Comment : &nbsp;</span>
                        <label><?=$Comment?></label>
                    </td>
                    <td>
                        <span>Phone Number : &nbsp;</span>
                        <label><?=$PhoneNumber?></label>
                    </td>

                </tr>


            </table>

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
                            <span>Free Margin : &nbsp;</span>
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
                            <td style="width: 315px;">
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
                    <h1>Withdrawal Balance</h1>
                </div>
                <div  class="table-container-holder table-container-border table-container-margin data-center-container">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 315px;">
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



            <?php if(isset($result_finance)){?>


                <div class="tab-title-header">
                    <h1>Transaction History</h1>
                </div>
                <div  class="table-container-holder table-container-border table-container-margin data-center-container">
                    <table id="history" class="table table-striped tab-my-acct">
                        <thead>
                        <tr>
                            <th>
                               Account number
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                               Comment
                            </th>
                            <th>
                              Fund type
                            </th>
                            <th>
                                Operation
                            </th>
                            <th>
                                Ticket number
                            </th>
                            <th>
                                Date
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $finance?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $('#history').DataTable();

                </script>
            <?php } ?>

            <?php if(isset($result)){?>


                <div class="tab-title-header">
                    <h1>Only Trades</h1>
                </div>
                <div  class="table-container-holder table-container-border table-container-margin data-center-container">
                    <table id="OpenedTrades" class="table table-striped tab-my-acct srctableHide">
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
                <script>

                    $('#OpenedTrades').DataTable();
                </script>
            <?php } ?>


        </div>
        <?php if($personal_log){?>

            <div  class="table-container-holder table-container-border table-container-margin data-center-container">
                <div class="tab-title-header">


                    <h1>Personal Information Log</h1>
                </div>
                <table cellpadding="0" cellspacing="0">
                    <thead>

                    <th>Data</th>
                    <th>Manager</th>
                    <th>field</th>
                    <th>Old value </th>
                    <th> New value</th>
                    <th> comment</th>

                    <thead>
                    <?php foreach($personal_log as $d){?>
                        <tr>
                            <td><?=$d->date_modified?></td>
                            <td><?=$d->full_name?></td>
                            <td><?=$d->field?></td>
                            <td><?=$d->old_value?></td>
                            <td><?=$d->new_value?></td>
                            <td><?=$d->date_modified?></td>
                        </tr>
                    <?php }?>



                </table>
            </div>
        <?php }?>
    <?php } ?>


</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.table-container-holder select[name="OpenedTrades_length"]').css('width', '60px');
        $('#OpenedTrades_filter input[type="search"]').css('width', '100px');
    });
</script>

