<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>

<style type="text/css">
    .decline-holder{
        margin: 5px 0px;
    }
    .red-border{
        border: 1px solid red;
    }

    .queue-tab-list > li.active > a{
        color: #fff!important;
        background: #2988CA!important;
    }

    .loader-holder {
        display: block;
    }

</style>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <!-- <h1 class="">My Accounts</h1> -->
        <!-- <div class="compose-holder">
            <a href="#" class="compose">Compose</a>
        </div> -->
<!--        <h3 class="queue-title">Withdrawal Queue</h3>-->
<!--        <select class="form-control round-0 drp-queues" id="select-withdrawal-transaction">-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue">All</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/bank-transfer">Bank Transfer</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/debit-credit-card">Debit/Credit Card (CardPay)</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/china-union-pay" selected>China UnionPay</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/skrill">Skrill</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/neteller">Neteller</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/webmoney">WebMoney</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/paxum">Paxum</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/ukash">Ukash</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/payco">PayCo</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/filspay">FILSPay</option>-->
<!--            <option value="--><?php //echo base_url();?><!--withdrawal-queue/cashu">CashU</option>-->
<!--        </select>-->

        <div class="tab-content acct-cont admin-tab-cont">
            <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request" style="display:block;">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped queue-tab withdrawalqueue-table-china-union-pay" id="request-table-china-union-pay">
                        <thead>
                        <tr>
                            <th>Ref #</th>
                            <th>Client's Name</th>
                            <th>ForexMart Account #</th>
                            <th>Amount Requested</th>
                            <th>Amount to Receive</th>
                            <th>Account #</th>
                            <th>Bank Name</th>
                            <th>Branch</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Date Requested</th>
                            <th id="hlast">Action</th>
                        </tr>
                        </thead>
                        <tbody id="up-Request-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped queue-tab withdrawalqueue-table-china-union-pay">
                        <thead>
                        <tr>
                            <th>Ref #</th>
                            <th>Client's Name</th>
                            <th>ForexMart Account #</th>
                            <th>Skrill Account #</th>
                            <th>Amount Requested</th>
                            <th>Amount to Receive</th>
                            <th>Account #</th>
                            <th>Bank Name</th>
                            <th>Branch</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="up-Processed-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped queue-tab withdrawalqueue-table-china-union-pay">
                        <thead>
                        <tr>
                            <th>Ref #</th>
                            <th>Client's Name</th>
                            <th>ForexMart Account #</th>
                            <th>Amount Requested</th>
                            <th>Amount to Receive</th>
                            <th>Account #</th>
                            <th>Bank Name</th>
                            <th>Branch</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="up-Declined-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- modal -->
<div class="modal fade" id="decline_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header popheader">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title poptitle" id="myModalLabel"> Decline - <span id="trans_title_modal"></span> </h4>
            </div>
            <div class="modal-body">
                <div class="row" id="popcheck_filter" style="margin: 0px 20px;">
                    <div class="col-sm-12 decline-holder">
                        <label>Reference #:</label> <span id="ref_num_mod"></span>
                    </div>
                    <div class="col-sm-12 decline-holder">
                        <label>Client's name:</label> <span id="client_name_modal"></span>
                    </div>
                    <div class="col-sm-12 decline-holder">
                        <label>Reason of Decline:</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea id="client_comment_modal" rows="5" cols="5" style="width: 100%;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer round-0 popfooter">
                <button type="button" id="modal-decline-link" class="btn btn-primary round-0">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<?php //hidden vars ?>
<input type="hidden" id="trans_id">
<input type="hidden" id="transType">
