<?php $this->load->view('accounts/sidelink');?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/pagination.css">
<script src='<?=base_url()?>assets/js/pagination.js'></script>





<div class="col-lg-10 col-md-9 col-sm-9 DesignerInline">
    <div class="section">
<form action="" method="post">
            <div class="compose-holder">
                  <div class="row">
            <div class="col-md-3">
                <div class="radio">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="u.email"?"checked":"";?>  value="u.email">Email</label>
                </div>
                <div class="radio">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.full_name"?"checked":"";?>  value="p.full_name">Full Name</label>
                </div>
                <div class="radio ">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.street"?"checked":"";?>  value="p.street">Street Address</label>
                </div>
                <div class="radio ">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.city"?"checked":"";?> value="p.city">City</label>
                </div>
                <div class="radio ">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.street"?"checked":"";?>  value="p.street">State/Province</label>
                </div>
                <div class="radio ">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.country"?"checked":"";?>  value="p.country">Country</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="radio">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.zip"?"checked":"";?>  value="p.zip">Postal/Zip Code</label>
                </div>
                <div class="radio">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="c.phone1"?"checked":"";?>  value="c.phone1">Phone Number</label>
                </div>
                <div class="radio ">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="p.dob"?"checked":"";?> value="p.dob">Date of Birth</label>
                </div>
                <div class="radio ">
                    <label><input name="radio" type="radio" <?=set_value('radio')=="all"?"checked":"";?>   value="all">All</label>
                </div>

            </div>
            <div class="col-md-3">
                <input name="search" type="text" value="<?php echo set_value('search');?>" />
                <input type="submit"  value="Go"/>
            </div>
        </div>
      </div>
</form>


        <div class="table-responsive mail-tab-holder ">

            <table id="accountsTable" class="table table-striped col-md-10">
                <thead>
                    <tr>
                        <th>Account number</th>
                        <th>Full Name</th>
                        <th>Email</th>

                    </tr>
                </thead>

                <tbody>
                   <?php


                   if($user_documents) {
                       foreach ( $user_documents as $key => $value) {
                           $data['DateUp'] = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_uploaded']);

                           if ($value['accountstatus'] == 0) {
                               $request.= '<tr style="color: green">';
                           } else {
                               $request.= '<tr style="color: red">';
                           }
                           $request.= '<td class="show">' . $value['account_number'] . '</td>';
                           $request.= '<td>' . $value['full_name'] . '</td>';
                           $request.= '<td>' . $value['email'] . '</td></tr>';
                       }
                   }else{
                       $request.="<tr><td></td><td></td><td></td></tr>";
                       //$request.= '<tr><td></td><td></td><td></td><td colspan="3 class="center">'.lang("norecy").'sdfsdfsdfsdfsdfsf</td></tr>';
                   }
                   echo $request;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="display: none">
    <?php
    $request ="";

    if($user_documents) {
        foreach ( $user_documents as $key => $value) {

            $request.= '<div class="' . $value['account_number'] . '"> <table class="table table-striped col-md-10"> <tr>

                        <td>Street</td>
                        <td>City</td>
                        <td>State/Province</td>
                        <td>Country</td>
                        <td>Postal/Zip Code</td>
                        <td>Phone Number</td>
                        <td>Date of Birth</td>
                    </tr>
                    <tr>';
            $request.= '<td>' . $value['street'] . '</td>';
            $request.= '<td>' . $value['city'] . '</td>';
            $request.= '<td>' . $value['state'] . '</td>';
            $request.= '<td>' . $value['country'] . '</td>';
            $request.= '<td>' . $value['zip'] . '</td>';
            $request.= '<td>' . $value['phone1'] . '</td>';
            $request.= '<td>' . $value['dob'] . '</td></tr>';
            $request.= '</tr> </table>';




        }
    }
    echo $request;
    ?>
</div>

<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog crm-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title crm-modal-title">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p class="delete-msg">Are you sure you want to delete this <span id="title">Scheme</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btns-plain" data-dismiss="modal">CANCEL</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<style>
    .DesignerInline {
        border-left: 1px solid #ccc;
    }
    .view{ display: none;}
    .show{cursor: pointer;}
</style>

<script>
    $(document).ready(function() {

        $('#accountsTable').paginate();
    });

    $(document).on("click",".show",function(){

        $(".modal-body").html($(".102706").html());
        $("#show").modal();
    })

</script>