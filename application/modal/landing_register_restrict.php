<style type="text/css">
    .not-available-text {
        color: #000 !important;
    }

    .bg
    {
        background: url(../assets/images/not-available-bg.png) no-repeat;
    }
    .modal-logo-title{
        width:auto;
    }
    .not-available-holder {
        margin-bottom: 0px;
    }
    .bg {
        min-height: auto;
    }
</style>
<!-- modal -->
<div class="modal fade" id="register_restrict" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">
                    <img src="<?= $this->template->Images()?>/logo.png" class="img-responsive modal-logo-title">
                </h4>
            </div>
            <div class="modal-body modal-show-body bg">
                <div class="row">
                    <div class="col-sm-4 not-available-holder">
                        <img src="<?= $this->template->Images()?>/not-available.png" class="img-responsive not-available-img">
                    </div>
                    <div class="col-sm-8 not-available-holder">
                        <p class="not-available-text">We apologize, our website is currently not available in your country.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0">
                <button type="button" data-dismiss="modal" id="btnRestrictOk" class="btn btn-primary round-0">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->