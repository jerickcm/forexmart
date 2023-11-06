
<div class="fsheader">
    <div class="forexsignals" id="bgheader">
    </div>
</div>
<div class="partnership-main-holder">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-2-left">
                <?php
                include_once('layouts/external/sidebar-left.php');
                ?>
            </div>
            <div class="col-lg-8 col-md-8 col-8-center">

                <div class="analytical-main-holder" style="min-height: 400px">
                    <div class="">
                    <div class="row">
                    <div class="col-sm-12 forexsignals">
                    <h4>Bio of <?php echo $bio->name;?></h4>


                    <div class="fxsignal-wrapper">
                        <div class="col-sm-2">
                            <?php
                              if( trim($bio->url) == 'Oliver-Watts'){ ?>
                            <img src="<?= $this->template->Images()?>avatar-01-new.jpg" class="img-responsive">
                             <?php  } elseif( trim($bio->url) == 'Charlotte-McConnell'){ ?>
                                 <img src="<?= $this->template->Images()?>avatar-02-new.jpg" class="img-responsive">
                          <?php   } elseif( trim($bio->url) == 'Edward-Stephenson'){ ?>
                                 <img src="<?= $this->template->Images()?>avatar-03.jpg" class="img-responsive">
                             <?php }   ?>
                        </div>

                        <div class="col-sm-10">
                            <p><?php echo $bio->bio;?> </p>
                           </div>
                    </div>



                    </div>
                    </div>
                    </div>
                    <!-- end content -->
                    <script src="<?=$this->template->Js();?>jquery.easing.min.js"></script>


                    <script src="<?=$this->template->Js();?>owl.carousel.js"></script>


                </div>


            </div>
            <div class="col-lg-2 col-md-2 col-2-right">
                <?php
                include_once('layouts/external/sidebar-right.php');
                ?>
            </div>
        </div>
    </div>
</div>
<br>
