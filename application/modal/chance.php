
<!-- modal -->
<input type="hidden" value="<?=($this->session->userdata('logged'))? '1':'0'?>" id="isChanceLogin"/>
<div class="modal fade" id="chance" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div class="modal-title modal-show-title">
                    <img src="<?= $this->template->Images()?>/logo-fx.png" alt="" class="img-responsive modal-logo-title">
                </div>
            </div>
            <div class="modal-body modal-show-body chance-bg">
                <div class="row">
                    <div class="col-md-12">
                        <p class="modal-text chance-modal-text">
                            Every client deposited his account with $300 or more has a chance to win
                        </p>
                        <h3>$1000 <small>in our draw</small></h3>
                        <div class="chance-btn">
                            <a href="#" class ="chance-url">Make a Deposit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var IsUserLogged = $("#isChanceLogin").val();
    console.log(IsUserLogged);
    var url_dep = "<?= fxpp::my_url('deposit'); ?>"
    $("a.chance-url").attr("href", url_dep);
</script>
<!-- end modal -->