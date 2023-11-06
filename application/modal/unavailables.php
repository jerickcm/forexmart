<!-- modal -->
<div class="modal fade" id="unavailable" tabindex="-1" data-backdrop="static" role="dialog" >
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title">
                    <img src="<?= $this->template->Images()?>/logo.png" alt="" class="img-responsive modal-logo-title">
                </h4>
            </div>
            <div class="modal-body modal-show-body bg">
                <div class="row">
                    <div class="col-sm-4 not-available-holder">
                        <img src="<?= $this->template->Images()?>/not-available.png" alt="" class="img-responsive not-available-img">
                    </div>
                    <div class="col-sm-8 not-available-holder">
                        <p class="not-available-text"><span>ForexMart</span> doesn't offer its services to residents of certain jurisdictions such as the USA, North Korea, Myanmar, Sudan and Syria.</p>
                        <p class="not-available-text"> We are sorry, our service is not available in your country.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer round-0">
                <button type="button" class="btn btn-primary round-0">Update</button>
            </div> -->
        </div>
    </div>
</div>
<!-- end modal -->