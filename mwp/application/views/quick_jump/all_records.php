<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">All records </h1>
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
                <input name="account_number" type="text" class="tab-input-form" placeholder="Account Number" value="<?=set_value('account_number')?>"/>
                <span style="color: red"><?php echo form_error('account_number'); echo isset($msg)?$msg:"";?></span>
            </div>

            <div class="child-input-form">
                <button type="submit" class="tab-input-button green-input-button">Show</button>
            </div>
        </form>
    </div>


    <?php if(isset($user_info)){?>


        <div class="tab-title-header">
            <h1>All Records</h1>
        </div>
        <div  class="table-container-holder table-container-border table-container-margin data-center-container">
            <div class="tab-title-header">
                <h1>Personal Information</h1>
            </div>
            <table cellpadding="0" cellspacing="0">
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
                <h1>Balance Information</h1>
            </div>

            <table class="table">
                <tr>
                    <td>
                        <span>Account Number : &nbsp;</span>

                    </td>
                    <td>
                        <label><?=$LogIn?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Balance: &nbsp;</span>

                    </td>
                    <td>
                        <label> <?=$Balance?></label>
                    </td>


                </tr>
            </table>
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