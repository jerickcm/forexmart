<select class="form-control inputdefault drp-queues" id="select-withdrawal-transaction" style="width: 250px;">
    <option value="<?php echo base_url();?>withdrawal-queue" <?=($option == 1) ? 'selected' : '';?> >All</option>
    <option value="<?php echo base_url();?>withdrawal-queue/debit-credit-card" <?=($option == 2) ? 'selected' : '';?> > CardPay </option>
    <option value="<?php echo base_url();?>withdrawal-queue/megatransfer_credit_card" <?=($option == 3) ? 'selected' : '';?> >MegaTransfer Credit Card</option>
    <option value="<?php echo base_url();?>withdrawal-queue/bank-transfer" <?=($option == 4) ? 'selected' : '';?> >Bank Transfer</option>
    <option value="<?php echo base_url();?>withdrawal-queue/paypal" <?=($option == 5) ? 'selected' : '';?> >PayPal</option>
    <option value="<?php echo base_url();?>withdrawal-queue/skrill" <?=($option == 6) ? 'selected' : '';?>>Skrill</option>
    <option value="<?php echo base_url();?>withdrawal-queue/paxum" <?=($option == 7) ? 'selected' : '';?> >Paxum</option>
    <option value="<?php echo base_url();?>withdrawal-queue/bitcoin" <?=($option == 8) ? 'selected' : '';?> >Bitcoin</option>
    <option value="<?php echo base_url();?>withdrawal-queue/neteller" <?=($option == 9) ? 'selected' : '';?>>Neteller</option>
    <option value="<?php echo base_url();?>withdrawal-queue/megatransfer" <?=($option == 10) ? 'selected' : '';?> >MegaTransfer</option>
    <option value="<?php echo base_url();?>withdrawal-queue/webmoney" <?=($option == 11) ? 'selected' : '';?> >WebMoney</option>
    <option value="<?php echo base_url();?>withdrawal-queue/payco" <?=($option == 12) ? 'selected' : '';?> >PayCo</option>
    <option value="<?php echo base_url();?>withdrawal-queue/yandex" <?=($option == 13) ? 'selected' : '';?> >Yandex</option>
    <option value="<?php echo base_url();?>withdrawal-queue/moneta" <?=($option == 14) ? 'selected' : '';?> >Moneta</option>
    <option value="<?php echo base_url();?>withdrawal-queue/sofort" <?=($option == 15) ? 'selected' : '';?> >Sofort</option>
    <option value="<?php echo base_url();?>withdrawal-queue/qiwi" <?=($option == 16) ? 'selected' : '';?> >QIWI</option>
     <option value="<?php echo base_url();?>withdrawal-queue/ukash" <?=($option == 9) ? 'selected' : '';?> >Ukash</option>
    <option value="<?php echo base_url();?>withdrawal-queue/filspay" <?=($option == 11) ? 'selected' : '';?> >FILSPay</option>
    <option value="<?php echo base_url();?>withdrawal-queue/cashu" <?=($option == 12) ? 'selected' : '';?> >CashU</option>
</select>