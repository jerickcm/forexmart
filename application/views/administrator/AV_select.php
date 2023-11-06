
<?php $opt = array_fill(0, 1, FALSE); $opt[$selectdefault]=TRUE; ?>

<select class="form-control" id="ea_administration" name="ea_administration" onchange="location = this.options[this.selectedIndex].value;">
    <option value="<?=FXPP::loc_url('administration/accountverification')?>" <?= set_select('ea_administration', site_url('administration/accountverification'),$opt[0]); ?>>Live Account</option>
    <option value="<?=FXPP::loc_url('administration/av_affiliate_request')?>" <?= set_select('ea_administration', site_url('administration/av_affiliate_request'),$opt[1]); ?>>Affiliate Account</option>
</select>