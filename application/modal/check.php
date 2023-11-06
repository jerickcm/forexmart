
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-ndb-modal-check.css' type='text/css'  />"));
    });
</script>

<div class="checkmodal modal fade" id="popbonus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="checkmodal-modal-dialog modal-dialog round-0 ">
        <div  class="checkmodal-content  modal-content round-0 ">
            <div class="check-modal-body modal-body">

                <h3 class="check-h3">No Deposit Bonus</h3>

                <p class="check-ps"> Below is the "No Deposit Bonus" to be credited. The bonus is fixed.</p>
                <p class="check-ps">
                    Bonus amount: <?=(isset($bonus))? $bonus: '';?> USD
                </p>
                <p class="check-p check-mrgntp">
                    <button class="check-btn-explore btn-explore close" data-dismiss="modal" aria-label="Close">Close</button>
                </p>
            </div>

        </div>
    </div>
</div>

