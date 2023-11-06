<style>
    .int-logo {
        width: 317px !important;
    }
    .navbar-internal{
        padding: 5px!important;
    }
    .nolinkline{
        outline: none;
    }
</style>
<nav class="navbar navbar-default navbar-internal round-0">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

                <img src="<?= $this->template->Images()?>/new-logo-internal.svg" class="navbar-brand navbar-brand-internal img-reponsive int-logo" usemap="#fxpplaspalmas">
                <map name="fxpplaspalmas">
                    <area shape="rect" coords="0,0,217,69" href="<?=FXPP::loc_url('')?>" alt="ForexMart" class="nolinkline">
                    <area shape="rect" coords="217,0,434,69" href="<?=FXPP::loc_url('las-palmas')?>" alt="LasPalmas" class="nolinkline">
                </map>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right navbar-right-internal">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?= $this->template->Images()?>/avatar.png" class="img-responsive" width="30px" style="float: left; margin-right: 8px; margin-top: -5px;"> <?php echo  strlen($this->session->userdata('full_name'))>0?$this->session->userdata('full_name'):"Sample User"?> <span class="caret"></span></a>
                    <ul  style="width: 100%;" class="dropdown-menu" role="menu">
                         
                         
                         <li><a href="<?=FXPP::loc_url('Signout/admin')?>">Log Out</a></li>
                    </ul>
                </li>
                <li><a href="#"><img src="<?= $this->template->Images()?>/flag.png" alt="" class="img-reponsive" width="30"></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>