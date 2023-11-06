

<tr id="<?=$symbl_id;?>" class="symbolrow <?=$tr_cls;?>  <?php echo $symbl_default ?>" data-tab="<?=$tr_cls;?>" >

    <td id="<?=$symbl_id;?>" class="symbol" style="width:30%"> <!--first is active class-->
        <?=$symbl_value;?>
    </td>
    <td id="<?=$symbl_unitvalue;?>" class="unitvalue" style="width:25%">0.00</td> <!--class uptext or downtext-->
    <td id="<?=$symbl_hi_low;?>" class="hi-low" style="width:40%">
        <span id="<?=$symbl_down_icon;?>" class="up-down-icon uplevel"> <!--class uplevel or downlevel-->

            <span id="<?=$symbl_low;?>" class="low ">0.00</span> /<span id="<?=$symbl_high;?>" class="high">0.00</span>
        </span>
    </td>
</tr>