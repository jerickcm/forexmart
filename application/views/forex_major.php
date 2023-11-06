  <?php 
  //  $majorfX=FXPP::getBuyAndSellStatsResult();
  $i=0;
   foreach($majorfX as $key){
       $i++;
       
       
   $string = str_replace(' ', '',$key['ask']);
	switch(strlen($string)) {
    case "6":
        $string=(strpos($string,"."))?$string."0":"0".$string;
        break;
    case "5":
        $string=(strpos($string,"."))?$string."00":"00".$string;
        break;
    case "4":
        $string=(strpos($string,"."))?$string."000":"000".$string;
        break;
    case "3":
        $string=(strpos($string,"."))?$string."0000":"0000".$string;
        break;	
   case "2":
        $string=(strpos($string,"."))?$string."00000":"00000".$string;
        break;
   case "1":
        $string=(strpos($string,"."))?$string."000000":"000000".$string;
        break;		
    default:
        $string;
	}       
       
       
       
       
      $stringbid = str_replace(' ', '',$key['bid']);
	switch(strlen($stringbid)) {
    case "6":
        $stringbid=(strpos($stringbid,"."))?$stringbid."0":"0".$stringbid;
        break;
    case "5":
        $stringbid=(strpos($stringbid,"."))?$stringbid."00":"00".$stringbid;
        break;
    case "4":
        $stringbid=(strpos($stringbid,"."))?$stringbid."000":"000".$stringbid;
        break;
    case "3":
        $stringbid=(strpos($stringbid,"."))?$stringbid."0000":"0000".$stringbid;
        break;	
   case "2":
        $stringbid=(strpos($stringbid,"."))?$stringbid."00000":"00000".$stringbid;
        break;
   case "1":
        $stringbid=(strpos($stringbid,"."))?$stringbid."000000":"000000".$stringbid;
        break;		
    default:
        $stringbid;
	}      
       
       
       
       
     ?>
  <tr>
          <td class="tdcls<?=$i?>">
              <a class="leftmgs" style="text-decoration: none !important;"> <?=($key['BuyVolumePercentage'])?></a>
              <b class="mainPerBox">

                    <?php 
                    $buy=str_replace("%", "",$key['BuyVolumePercentage']);
                    $sell=str_replace("%", "",$key['SellVolumePercentage']);
                    $sum=$buy+$sell;

                    $newBuy=$buy;
                    $newSell=$sell;
                    if($sum>100)
                    {
                        $minval=$sum-100;
                        if($buy>$sell){$newBuy=$buy-$minval;}
                        if($sell>$buy){$newSell=$sell-$minval;}                      
                    }

                    ?>

              <a class="byeBar"   style="width:<?=$newBuy?>%"></a>
              <a class="sellBar" style="width:<?=$newSell?>%"></a>                                                    
              </b>
              <a class="rightmgs" style="text-decoration: none !important;"><?=($key['SellVolumePercentage'])?> </a>
          </td> 
            <td class="tdcls<?=$i?>"><?=$key['symbol'] ?></td>
          <td class="tdcls<?=$i?>">
              <a target="_blank" class="btn-buy" style="width:64px" href="https://webtrader.forexmart.com">
                  <?=$stringbid?>
              </a>
          </td>
          <td class="tdcls<?=$i?>">
              <a target="_blank" class="btn-sell" style="width:64px" href="https://webtrader.forexmart.com">
                  <?=$string?>
              </a>
          </td>
    </tr>
  <?php  } ?>