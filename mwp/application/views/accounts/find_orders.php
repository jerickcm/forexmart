<div id="loader-holder" class="loader-holder" style="display: hidden;">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<div class="tab-pane active tab-title-header" id="check-phone-password">
    <h1 class="all_tab_title">Find Order</h1>
    <div class="mini-form-container" style="height: 37px; margin-top: 50px; margin-left: 483px;">
        <form method="post" action="" id="form-ticket">
            <table class="ticketnum">
                <thead>
                <tr>
                    <th><label style="text-align: right; width: 185px;margin-right: 10px;">Ticket number : </label></th>
                    <th><input name="order_ticket" id="order_ticket" type="text" class="tab-input-form" placeholder="Ticket number" value="<?=set_value('order_ticket')?>" require/></th>
                    <th>  <button type="button" id="validate_account" class="tab-input-button green-input-button" style="width: 120px; margin-left:10px">Find</button></th>
                </tr>
                </thead>
            </table>


        </form>
    </div>
    <hr>

    <?php if(IPLoc::Office()){
        if(isset($ticketget)){
          ?>
        <div style="width: 80%;margin-left:10%;">
            <?php
            if($acct===true && $ticketget!=''){?>
            <table class="tbl_ticket">
                <tr class="tbl_th">
                    <td style="width: 5%;">Deal</td>
                    <td style="width: 5%;">Login</td>
                    <td style="width: 10%;">Time</td>
                    <td style="width: 5%;">Type</td>
                    <td style="width: 5%;">Symbol</td>
                    <td style="width: 5%;">Volume</td>
                    <td style="width: 5%;">Price</td>
                    <td style="width: 5%;">S/L</td>
                    <td style="width: 5%;">T/P</td>
                    <td style="width: 10%;">Time</td>
                    <td style="width: 5%;">Price</td>
                    <td style="width: 5%;">Swap</td>
                    <td style="width: 5%;">USD</td>
                    <td style="width: 10%;">Comment</td>
                </tr>
                    <tr class="tbl_td">
                        <td><?php echo $traninfo12;?></td>
                        <td><?php echo $ticketget;?></td>
                        <td><?php echo $traninfo1;?></td>
                        <td><?php echo $traninfo2;?></td>
                        <td><?php echo $traninfo3;?></td>
                        <td><?php echo $traninfo4;?></td>
                        <td><?php echo $traninfo5;?></td>
                        <td><?php echo $traninfo6;?></td>
                        <td><?php echo $traninfo7;?></td>
                        <td><?php echo $traninfo8;?></td>
                        <td><?php echo $traninfo9;?></td>
                        <td>0.00</td>
                        <td><?php echo $traninfo11;?></td>
                        <td><?php echo $traninfo10;?></td>
                    </tr>
                    <?php }else{?>
                        <div style="    text-align: center;    font-size: 17px;color:red;"> No data available</div>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <br><br>
    <?php } ?>
</div>




<script>
   $("#validate_account").click(function (){
       console.log('asdasdasd');
       var res = isNaN($('#order_ticket').val());
       if(res){ $("#modal-none").modal();}else{ document.getElementById("form-ticket").submit(); }
   });
</script>

<div class="modal fade" id="modal-none" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-body modal-show-body">
                <div class="text-center manage-credit-prize-alert-message">
                    <span style="color: red;font-size:18px;font-weight: bold;">Invalid Ticket.</span>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Ticket number page css: */
    .showTicketDiv{width: 100%; height:70vh;}
    .showTicketDiv table{ margin: 40px}
    .showTicketDiv table th,td{border: 1px solid #ccc;}
    .showTicketDiv table th{padding: 13px;text-align: left;width: 140px;}
    .showTicketDiv table td{min-width: 25px}

    .showTicketDiv table td:nth-child(2) { text-align: center}
    .showTicketDiv table td:nth-child(5) { text-align: center}
    .showTicketDiv table td:nth-child(8) { text-align: center}
    .tdwidth{ width: 300px;padding-left: 8px;}
    .tbl_ticket{border-collapse: collapse;width:100%;}
    .tbl_ticket td{border:1px solid #9a9a9a;}
    .tbl_th td{background:#ccc;font-size:15px;}
    .tbl_td td{font-size: 12px;}

</style>