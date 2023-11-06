<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>advertising.min.css' type='text/css'  />"));
    });
</script>
<div class="modal fade" id="popup" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close supresscookies" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title cgrts">
                    <?= lang('pop_01');?>!
                </h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="row">
                    <div class="no-deposit-image-holder">
                        <img src="<?= $this->template->Images()?>modal-show-img.png" alt="" class="img-responsive ribbon" />
                        <img src="<?= $this->template->Images()?>logo-prev.png" width="219" height="48" alt="" class="img-responsive hidden-image-deposit c-pad"/>
                    </div>
                    <div class="sign-back">
                        <p class="modal-show-text">
                            <?= lang('pop_02');?>
                        </p>
                        <span class="up-to">
                            <?= lang('pop_03');?>
                        </span>
                        <p class="no-deposit-needed">
                            <?php /*echo lang('pop_04');*/?> <!--removed by task FXPP-7448-->
                        </p>
                        <div class="btn-modal-show-holder">
                            <a href="<?= $this->config->item('domain-www');?>/account-type" class="btn-modal-show advrt">
                                <?= lang('pop_05');?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>