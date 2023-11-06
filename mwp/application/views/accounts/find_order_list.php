<div class="tab-pane active" id="check-phone-password">
    <div class="tab-title-header">
        <h1 class="all_tab_title">Modify Order</h1>
    </div>
    <div  style="width:100%; height: 37px; text-align:left">
        <form method="post" action="" enctype="multipart/form-data">
            <table class="ticketnum" style="width: 30%;margin-left: 29.2%;margin-top: -1px;">
                <thead>
                <tr>
                    <th><label style="text-align: right; width: 185px;margin-right: 10px;">Ticket number : </label></th>
                    <th><input name="order_ticket" type="text" class="tab-input-form" placeholder="Ticket number" value="<?=set_value('order_ticket')?>" require/></th>
                    <th>  <button type="submit" class="tab-input-button green-input-button" style="width: 120px; margin-left:10px">Find</button></th>
                </tr>
                </thead>
            </table>
        </form>
    </div>
    <hr>
   <?php  if(!empty($order_ticket['AccountNumber'])){ ?>    

    <div class="showTicketDiv">
            <div class="table-chart-holder">
                                <table class="table-chart" id="accountsTable"> 
                                    <thead>
                                        <tr>
                                            <th > Account Number </th>
                                            <th>Full Name </th> 
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th style="width:30px">City</th>
                                            <th>Country</th>
                                            <th style="width:40px; padding:0px  9px  0px 9px">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <tr>
                                            <td><?=$order_ticket['AccountNumber'];?></td>
                                            <td><?=$order_ticket['Name']?></td> 
                                            <td><?=$order_ticket['Email']?></td>
                                            <td><?=$order_ticket['PhoneNumber']?></td>
                                            <td><?=$order_ticket['City']?></td>
                                            <td><?=$order_ticket['Country']?></td>                                             
                                            <td style="padding:0px  9px  0px 9px">
                                                <a class="editbutton tab-input-button green-input-button"  href="<?=site_url('orders-edit?id='.$order_ticket['AccountNumber'].'_'.$order_ticket['Ticket'])?>" >Edit</a>
                                            </td>
                                            
                                            
                                        </tr>
                                       
                                    </tbody> 
                                </table>
                            </div>
    </div>
    
<?php } else {echo "<b style='color: red; text-align: center; float: left; width: 100%;'>".$result."</b>";}?>        
    

</div>


 
<style>
    

    #accountsTable th{ text-align: center}
    
/* Ticket number page css: */
.showTicketDiv{width: 95%; height:70vh;}
.showTicketDiv table{ margin: 40px}
.showTicketDiv table th,td{border: 1px solid #ccc;}
.showTicketDiv table th{padding: 13px;text-align: left;width: 140px;}
.showTicketDiv table td{min-width: 25px}

.showTicketDiv table td:nth-child(2) { text-align: center} 
.showTicketDiv table td:nth-child(5) { text-align: center} 
.showTicketDiv table td:nth-child(8) { text-align: center} 
.tdwidth{ width: 300px;padding-left: 8px;}
    
</style>


<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>

 <style>
        .dataTables_wrapper{
            clear: none!important;
        }
        table.dataTable{
            clear: none!important;
        }
        table.dataTable select{
            padding: 6px 6px!important;
        }
        .dataTables_wrapper .dataTables_info{
            clear: none!important;
        }
        .hidediv{display:none !important;}
        
 #accountsTable_filter label input{border: 1px solid #c2c2c2!important;
    height: 32px!important;
    margin-bottom: 30px!important;
    margin-left: 0.5em!important;
    width: 268px!important;}
        
#accountsTable_length label select{border: 1px solid #c2c2c2!important;
    height: 32px!important;
    margin-bottom: 30px!important;
    margin-left: 0.5em!important;
    width: 150px!important;}     


.editbutton{ font-weight: bold;
    line-height: 8px;
    margin: 0;
    padding: 4px 10px;
    text-decoration: none;
    width: 60px;
}
    </style>
      <!-- Javascript -->
      <script>
 
         
//           $("#accountsTable").dataTable( {
//                "pagingType": "full_numbers"
//        });
      </script>
 
