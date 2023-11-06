<div class="not-found-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-centered">
                <div class="not-found">
                    <div class="row">
                        <div class="col-sm-3 error-img">
                            <img src="<?= $this->template->Images()?>404.png" class="img-responsive">
                        </div>
                        <div class="col-sm-9 error-content-holder">
                            <h1 class="error-title"><?php echo $message ?></h1>
                            <p class="error-text">
                                We can't find the page you're looking for. Check out our <a href="<?php echo base_url() ?>faq">FAQ</a> for help,<br>or go to <a href="<?php echo base_url() ?>contact-us">Contact us page</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="red-line"></div>
        <div class="btn-livedemo error-bot ">
            <form class="form-inline">
                <div class="form-group">
                    <a href="<?php echo base_url() ?>register" class="col-sm-6 btn-real">
                        Open Trading Account
                    </a>
                </div>
                <div class="form-group">
                    <a href="<?php echo base_url() ?>register/demo" class="col-sm-6 btn-demo">
                        Open Demo Account
                    </a>
                </div>
                <div class="form-group">
                    <label>Risk Warning: Trading CFDs involves significant risk of loss.</label>
                </div>
            </form>
        </div>
    </div>
</div>