<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Check level</h1>
        <!--<div class="tab-search-bar">
            <input type="text" class="tab-input-form" placeholder="Type here..."/>
            <button type="submit" class="tab-input-button green-input-button go-button">Go</button>
        </div>-->
    </div>
    <div class="mini-form-container">
        <form method="post" action="" id="formChecklevel">
            <!-- START INCORRECT RESULT -->
            <!--<div class="child-error-form incorrect-error-form">
                <p>Incorrect Data</p>
            </div>-->
            <!-- END INCORRECT RESULT -->

            <!-- START CORRECT RESULT -->

            <!-- END CORRECT RESULT -->

            <div class="child-input-form">
                <label>Account Number</label>
                <input name="account_number" id="accnum" type="text" class="tab-input-form numeric" placeholder="Account Number" value="<?=set_value('account_number')?>"/>
                <!-- <span style="color: red"><?php //echo form_error('account_number'); echo isset($msg)?$msg:"";?></span> -->
                
                    <?php if ($msg==1){?>
                        <script type="application/javascript">
                            //console.log('luh');
                            $(document).ready(function () {
                                $("#modal-invalid").modal('show');
                            });
                        </script>
                    <?php }?>                
                
            </div>

            <div class="child-input-form">
                <button type="button" class="tab-input-button green-input-button" id="submit-checklevel" style="float:left;">Show</button>
            </div>
        </form>
    </div>

        <div class="modal fade" id="modal-invalid" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog round-0">
                <div class="modal-content round-0">
                    <div class="modal-body modal-show-body">
                        <div class="text-center manage-credit-prize-alert-message">
                            <span style="color: red;font-size:18px;font-weight: bold;">Please enter a valid account.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(isset($result) || isset($result_ac)){?>
            <div  class="table-container-holder table-container-margin table-container-data">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                           <span>Account Number: &nbsp;</span>
                            <label>
                                <?php
                                    if($result[0]->account_number){
                                        echo $result[0]->account_number;
                                    }
                                    if($result_ac){
                                        echo $result_ac;
                                    }
                                ?>
                            </label>
                        </td>
                        <td>
                            <span>Group : &nbsp;</span>
                            <label>
                                <?php
                                    if($result[0]->group){
                                        echo $result[0]->group;
                                    }
                                ?>
                            </label>
                        </td>
                        <td>
                            <?php
                                if($verifyData == 0){
                                    echo '<span>Status : &nbsp;</span><span style="color: red;">Unverified</span>';
                                }
                                if($verifyData == 1){
                                    echo '<span>Status : &nbsp;</span><span style="color: #29a643;">Verified</span>';
                                }
                            ?>

                        </td>
                    </tr>

                </table>
            </div>
        <?php } ?>
    </div>
<!--<div class="tab-title-header">-->
<script>
    $("#submit-checklevel").click(function(){
        var accnum = $('#accnum').val();
        if(accnum!=''){
            document.getElementById("formChecklevel").submit();// Form submission
        }else{
            $("#modal-invalid").modal('show');
        }

    });
</script>

