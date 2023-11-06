<?php
 
foreach($apiGetAccDet as $key)
{ ?>
<tr>   
  <td><?=$i++;?></td>       
       <td><?=$key->OpenTIme;?></td>
       <td><?=$key->OpenPrice;?></td>
       <td><?=$key->CloseTime;?></td>
       <td><?=$key->ClosePrice;?></td>       
       <td><?=$key->OrderTicket;?></td>
       <td><?=$key->Profit;?></td>
       <td><?=$key->TradeType;?></td>
       <td><?=$key->Symbol;?></td>
       <td><?=$key->Comment;?></td>
</tr>
 <?php }     ?>