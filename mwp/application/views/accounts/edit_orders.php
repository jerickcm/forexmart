  


<div class="tab-pane active" id="check-phone-password">
 <a href="<?=site_url('orders-list')?>"  >Back order list</a>

 <b class="alertShow"><?=$result;?> </b>
 
 
 
    <div class="showTicketDiv">
        <form action="" method="post">
         <table  cellpadding="0"  cellspacing="0">
            <tbody>
              <tr>
                <th> Name   </th>
                <td> : </td>
                <td class="tdwidth"><input type="text" name="Name" value="<?php echo $order_ticket['Name']; ?>" required/> </td>
             
                <th> Phone  </th>
                <td> : </td>
                <td class="tdwidth"><input type="text" name="PhoneNumber" value="<?php echo $order_ticket['PhoneNumber']; ?>" /> </td>
             
                <th> Email  </th>
                <td> : </td>
               <td class="tdwidth"><input type="text" name="Email" value="<?php echo $order_ticket['Email']; ?>" required/> </td>
               </tr>
              <tr>                 
                 <th> State </th>
                <td> : </td>
                <td class="tdwidth"><input type="text" name="State" value="<?php echo $order_ticket['State'] ?>" required/> </td>
              
                <th> City </th>
                <td> : </td>
                <td class="tdwidth"><input type="text" name="City" value="<?php echo $order_ticket['City']; ?>" required/> </td>
                <th> Zip Code </th>
                <td> : </td>
                <td class="tdwidth"><input type="text" name="ZipCode" value="<?php echo $order_ticket['ZipCode']; ?>"required/> </td>
              </tr>
              
              <tr>
                <th> Country </th>
                <td> : </td>
                <td class="tdwidth"><input type="text" name="Country" value="<?php echo $order_ticket['Country']; ?>"required/> </td>
                 <th> Account Number  </th>
                <td> : </td>
                <td class="tdwidth"><?php echo $order_ticket['LogIn'] ?></td>
                <th> Ticket Number  </th>
                <td> : </td>
                <td class="tdwidth"><?php echo $order_ticket['Ticket']; ?></td>
              </tr>
              <tr>   
                 <tr>
                <th> Address </th>
                <td> : </td>
                <td class="tdwidth"  colspan="7"><textarea name="Address"><?php echo $order_ticket['Address']; ?></textarea> </td>
              </tr>
               
              <tr>
                <th> Comments </th>
                <td> : </td>
                <td class="tdwidth"  colspan="7"><textarea name="Comment"><?php echo $order_ticket['Comment']; ?></textarea> </td>
              </tr>
            
              <tr>
                <th> 
                    <input type="hidden" name="AccountNumber" value="<?=$order_ticket['LogIn']?>"/>
                     <input type="hidden" name="Ticket" value="<?=$order_ticket['Ticket']?>"/>
                <button type="submit" class="tab-input-button green-input-button" style="width: 120px;margin-top: 30px">Update</button>
                </th>
                
              </tr>
              
            </tbody>
        </table>
        </form>      
    </div>

</div>

 



 
<style>
.alertShow{ color: green;
    float: right;
    margin-top: -20px;
    text-align: center;
    width: 100%;
}  

/* Ticket number page css: */
.showTicketDiv{width: 100%; height:70vh;}
.showTicketDiv table{ margin: 40px}
.showTicketDiv table th,td{border: 0px solid #ccc;}
.showTicketDiv table th{padding: 13px;text-align: left;width: 140px;}
.showTicketDiv table td{min-width: 25px}

.showTicketDiv table td:nth-child(2) { text-align: center} 
.showTicketDiv table td:nth-child(5) { text-align: center} 
.showTicketDiv table td:nth-child(8) { text-align: center} 
.tdwidth{ width: 300px;padding-left: 8px;}
.tdwidth input{width: 96%; height: 30px; border: 1px solid #ccc;}    
.tdwidth textarea {width: 292px; height: 94px;}
</style>


<script>
$(document).ready(function(){
    setTimeout(function() { $(".alertShow").html(""); }, 4000);
   
});


</script>