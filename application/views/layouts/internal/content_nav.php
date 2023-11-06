<?php $class = $this->router->class; ?>
<?php $method = $this->router->method; ?>
<div class="side-nav-holder">
    <ul class="side-nav">
        <li><a href="<?php echo base_url();?>accounts" class="<?=($class == 'accounts') ? 'active-sidenav' : '';?>"><i class="fa fa-suitcase"></i><cite>My Account</cite></a></li>
        <li><a href="<?php echo base_url();?>profile" class="<?=($class == 'profile') ? 'active-sidenav' : '';?>"><i class="fa fa-user"></i><cite>My Profile</cite></a></li>
        <li><a href="<?php echo base_url();?>transactions/deposit" class="<?=($method == 'deposit') ? 'active-sidenav' : '';?>"><i class="fa fa-money"></i><cite>Deposit Funds</cite></a></li>
        <li><a href="<?php echo base_url();?>transactions/withdraw" class="<?=($method == 'withdraw') ? 'active-sidenav' : '';?>"><i class="fa fa-credit-card"></i><cite>Withdraw Funds</cite></a></li>
        <li><a href="#" class=""><i class="fa fa-download"></i><cite>Platform Downloads</cite></a></li>
    </ul><div class="clearfix"></div>
</div>

