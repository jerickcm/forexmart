<script>
    $(function(){
        $('#SearchInInternal').on('keyup',function(){
            $("#navsearch").attr("href","<?=FXPP::loc_url('user/search/searchstring')?>/"+ $('#SearchInInternal').val())
        });
    });
</script>
<style>
    .searchD{
        padding: 0;margin: 0
    }
    .searchA{
        padding: 15px;
    }
</style>

<nav class="navbar navbar-default round-0">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=FXPP::loc_url()?>">
                <img src="<?php echo $this->template->Images()?>fx-logo-blue.png" class="img-reponsive" width="204" alt="LOGOS" />
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left nav-search" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control round-0"id="SearchInInternal" placeholder="<?= lang('search') ?>">
                            <div  class="searchD input-group-addon round-0">
                                <a id="navsearch" class="searchA"  href="<?=FXPP::loc_url('search')?>">
                                    <i class="fa fa-search">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="<?php echo $this->template->Images()?>avatar.png" class="img-responsive" width="30" alt="" style="float: left; margin-right: 8px; margin-top: -5px;">
                        <?php echo  strlen($this->session->userdata('full_name'))>0?$this->session->userdata('full_name'):"Sample User"?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo FXPP::loc_url()?>accounts">My Account</a></li>
                        <li><a href="<?php echo FXPP::loc_url();?>profile">My Profile</a></li>
                        <li><a href="<?php echo FXPP::loc_url();?>transactions/deposit">Deposit Funds</a></li>
                        <li><a href="<?php echo FXPP::loc_url();?>transactions/withdraw">Withdraw Funds</a></li>
                        <li><a href="<?php echo FXPP::loc_url();?>profile">Platform Downloads</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=FXPP::loc_url('Signout')?>">Log Out</a></li>
                    </ul>
                </li>
                <li><a href="#"><img src="<?= $this->template->Images()?>flag.png" class="img-reponsive" width="30" alt=""></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>