<style>
  td{
      width: 200px !important;
      border:1px solid #f0f0f0;
  }
</style>

<section class="content-header">
    <h1>Cabinet</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-paper-plane"></i> Quick Jump</li>
        <li>Cabinet</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box style-box" style="display: inline-block;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 style-box-initial-info">
    <div class="mini-form-container" style="width: 30%;margin-left: 35%;">
        <form method="post" action="">
            <div class="child-input-form" style="width: 100%;padding: 5px;margin-bottom:20px; ">
                <label>Search: </label>
                <input name="account_number" type="text" class="tab-input-form numeric" id="account_number2" placeholder="Search Account" value="<?=set_value('account_number')?>" style="padding: 5px;"/>
                <button type="submit" id="submittedbutton" class="tab-input-button style-table-in-button" style="padding: 7px;">Search</button>
            </div>
        </form>
    </div>
    
    <div class="modal fade" id="modal-invalid2" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;">Please enter account number.</span>
                </div>
            </div>
        </div>
    </div>
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
    <?php if (isset($noinfo)) { ?>
        <script>
            $(document).ready(function () {
                $("#modal-invalid").modal('show');
            });
        </script>
    <?php }?>

    <?php if(isset($user_info)){?>
        <div  class="table-container-holder table-container-border table-container-margin data-center-container">
            <table cellpadding="0" cellspacing="0" style="width: 70%;    margin-left: 15%;">
                <tr>
                    <td>
                        <span>Account Number : &nbsp;</span>
                        <label><?=$user_info['account_number']?></label>
                    </td>
                    <td>
                        <span>Full name: &nbsp;</span>
                        <label> <?=$user_info['full_name']?></label>
                    </td>
                    <td>
                        <label><a  href="<?php echo $this->config->item('domain-my')."/cabinet?key=".$user_info['key']."&ui=".$user_info['user_id'] ?>" target="_blank" >Client Cabinet </a></label>
                    </td>
                    <td>
                        <label><a  href="https://my.forexmart.com/partner/signin" target="_blank" >Partner Cabinet </a></label>
                    </td>
                </tr>
            </table>
        </div>
    <?php } ?>
        </div>
    </div>
</section>

<script type="application/javascript">
        $(document).on("click", "#submittedbutton", function (e) {
            showloader();
            if($("#account_number2").val() == ''){
                hideloader();
                $("#modal-invalid2").modal('show');
            console.log($("#account_number2").val() + 'a');
               event.preventDefault(e);

            }
        });
</script>