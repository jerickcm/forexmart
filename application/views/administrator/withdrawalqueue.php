<style type="text/css">
    .decline-holder{
        margin: 5px 0px;
    }
    .red-border{
        border: 1px solid red;
    }
</style>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="section">
        <!-- <h1 class="">My Accounts</h1> -->
        <!-- <div class="compose-holder">
            <a href="#" class="compose">Compose</a>
        </div> -->
        <h3 class="queue-title">Withdrawal Queue</h3>
        <select class="form-control round-0 drp-queues" id="select-withdrawal-transaction">
            <option value="all">All</option>
            <option value="banktransfer">Bank Transfer</option>
            <option value="creditcard">Debit/Credit Card (CardPay)</option>
            <option value="unionpay">China UnionPay</option>
            <option value="skrill">Skrill</option>
            <option value="neteller">Neteller</option>
            <option value="webmoney">WebMoney</option>
            <option value="paxum">Paxum</option>
            <option value="ukash">Ukash</option>
            <option value="payco">PayCo</option>
            <option value="filspay">FILSPay</option>
            <option value="cashu">CashU</option>
        </select>
        <div id="withdrawal-panel-all" class="withdrawal-panel all-withdraw">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                                <tr>
                                    <th>Ref #</th>
                                    <th>Client's Name</th>
                                    <th>ForexMart Account #</th>
                                    <th>Amount Requested</th>
                                    <th>Amount to be Deducted</th>
                                    <th>Transaction Type</th>
                                    <th>Date Requested</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="all-Request-tbody">
                                <?php echo $all_withdrawal_request['Request']['Data'];?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Transaction Type</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="all-Processed-tbody">
                                <?php echo $all_withdrawal_request['Processed']['Data'];?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Transaction Type</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="all-Declined-tbody">
                                <?php echo $all_withdrawal_request['Declined']['Data'];?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-banktransfer" class="withdrawal-panel bank_transfer">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                                <tr>
                                    <th>Ref #</th>
                                    <th>Client's Name</th>
                                    <th>ForexMart Account #</th>
                                    <th>Amount Requested</th>
                                    <th>Amount to be Deducted</th>
                                    <th>Bank Account Name</th>
                                    <th>Bank Account Number</th>
                                    <th>Date Requested</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="bt-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Bank Account Name</th>
                                <th>Bank Account Number</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="bt-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Bank Account Name</th>
                                <th>Bank Account Number</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="bt-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-creditcard" class="withdrawal-panel creditcard">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" style="display:block;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="cc-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="cc-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="cc-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-unionpay" class="withdrawal-panel unionpay">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request" style="display:block;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="up-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="up-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="up-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-skrill" class="withdrawal-panel skrill">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Skrill Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="sk-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Skrill Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="sk-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Skrill Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="sk-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-neteller" class="withdrawal-panel neteller">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Neteller ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="nt-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Neteller ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="nt-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Neteller ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="nt-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-webmoney" class="withdrawal-panel webmoney">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>WebMoney ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="wm-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>WebMoney ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="wm-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>WebMoney ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="wm-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-paxum" class="withdrawal-panel paxum">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Paxum Account ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="px-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Paxum Account ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="px-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Paxum Account ID</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="px-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-ukash" class="withdrawal-panel ukash">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Ukash Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="uk-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Ukash Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="uk-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>Ukash Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="uk-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-payco" class="withdrawal-panel payco">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>PayCo Wallet</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="pc-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>PayCo Wallet</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="pc-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>PayCo Wallet</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="pc-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-filspay" class="withdrawal-panel filspay">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>FILSPay Number</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="fp-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>FILSPay Number</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="fp-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>FILSPay Number</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="fp-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="withdrawal-panel-cashu" class="withdrawal-panel cashu">
            <div class="settings-tab">
                <ul role="tablist" class="queue-tab-list">
                    <li role="presentation"><a href="javascript:void(0)" id="Request" class="tab-toggle active-set-tab">Request</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Processed" class="tab-toggle">Processed</a></li>
                    <li role="presentation"><a href="javascript:void(0)" id="Declined" class="tab-toggle">Declined</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="tab-content acct-cont admin-tab-cont">
                <div role="tabpanel" class="tab-panel-withdrawalqueue Request" id="withdrawalqueue-request">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>CashU Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="cu-Request-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Processed" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>CashU Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="cu-Processed-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div role="tabpanel" class="tab-panel-withdrawalqueue Declined" style="display: none;">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped queue-tab">
                            <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Client's Name</th>
                                <th>ForexMart Account #</th>
                                <th>CashU Account #</th>
                                <th>Amount Requested</th>
                                <th>Amount to be Deducted</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="cu-Declined-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="tab-line"></div> -->
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="" class="number">Number of records shown per page</label>
                                <input type="text" class="form-control round-0 number-text" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default round-0">Go</button>
                        </form>
                    </div>
                    <div class="col-md-6 settings-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class=""><a href="#">2</a></li>
                                <li class=""><a href="#">3</a></li>
                                <li class=""><a href="#">4</a></li>
                                <li class=""><a href="#" aria-label=""><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
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

<?php /** Preloader Modal Start */ ?>
<div id="loader-holder" class="loader-holder">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<?php /** Preloader Modal End */ ?>


<script type="text/javascript">
    var url = "<?php echo base_url();?>";
    $(function(){

        // Withdrawal queue tab
        $('.all-withdraw .tab-toggle').click(function(){
            if( !$(this).hasClass("active-set-tab") ){
                $('.all-withdraw  .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_all_withdrawalqueue();
            }
        });
        $('.bank_transfer .tab-toggle').click(function(){
            if( !$(this).hasClass("active-set-tab") ){
                $('.bank_transfer .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_banktransfer();
            }
        });
        $('.creditcard .tab-toggle').click(function(){
            if( !$(this).hasClass("active-set-tab") ){
                $('.creditcard .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_creditcard();
            }
        });
        $('.unionpay .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.unionpay .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_unionpay();
            }
        });
        $('.skrill .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.skrill .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_skrill();
            }
        });
        $('.neteller .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.neteller .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_neteller();
            }
        });
        $('.webmoney .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.webmoney .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_webmoney();
            }
        });
        $('.paxum .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.paxum .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_paxum();
            }
        });
        $('.ukash .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.ukash .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_ukash();
            }
        });

        $('.payco .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.payco .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_payco();
            }
        });

        $('.filspay .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.filspay .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_filspay();
            }
        });

        $('.cashu .tab-toggle').click(function(){
            if( ! $(this).hasClass("active-set-tab") ){
                $('.cashu .tab-toggle').removeClass("active-set-tab");
                $('div.tab-panel-withdrawalqueue').hide();
                var activeTab = $(this).attr('id');
                $(this).addClass('active-set-tab');
                $('div.tab-panel-withdrawalqueue.'+activeTab).show();
                update_cashu();
            }
        });


        // All Withdrawal Request Action
        $('.all-withdraw').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_all_withdrawalqueue(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });

        $('.all-withdraw').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            var trans_type = $('tr#'+id).children('td.transactiontype').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('All');
            $('span#trans_title_modal').html(trans_type);
        });


        // Bank Transfer Action
        $('.bank_transfer').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_banktransfer(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });

        $('.bank_transfer').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('BankTransfer');
            $('span#trans_title_modal').html('BankTransfer');
        });

        $('div#decline_modal').on('click', 'button#modal-decline-link', function(){
            var transId = $('input#trans_id').val();
            var transType = $('input#transType').val();
            var reason = $('textarea#client_comment_modal').val();
            if(reason != ''){
                var r = confirm("Are you sure you want to Decline?");
                if (r == true) {
                    switch(transType){
                        case 'All':
                            update_all_withdrawalqueue(transId, 'Declined', reason);
                        case 'BankTransfer':
                            update_banktransfer(transId, 'Declined',reason);
                            break;
                        case 'CardPay':
                            update_creditcard(transId, 'Declined',reason);
                            break;
                        case 'CUP':
                            update_unionpay(transId, 'Declined',reason);
                            break;
                        case 'Skrill':
                            update_skrill(transId, 'Declined',reason);
                            break;
                        case 'Neteller':
                            update_neteller(transId, 'Declined',reason);
                            break;
                        case 'WebMoney':
                            update_webmoney(transId, 'Declined',reason);
                            break;
                        case 'PayCo':
                            update_payco(transId, 'Declined',reason);
                            break;
                        case 'Paxum':
                            update_paxum(transId, 'Declined',reason);
                            break;
                        case 'Ukash':
                            update_ukash(transId, 'Declined', reason);
                            break;
                        case 'Filspay':
                            update_filspay(transId, 'Declined', reason);
                            break;
                        case 'CashU':
                            update_cashu(transId, 'Declined', reason);
                            break;
                    }
                    $(this).closest('tr').remove();
                    $('#decline_modal').modal('hide');
                }
            }else{
                $('textarea#client_comment_modal').addClass('red-border');
            }
        });

        $('div#decline_modal').on('hide.bs.modal', function () {
            $('textarea#client_comment_modal').removeClass("red-border");
            $('textarea#client_comment_modal').val('');
        });

        $('div#decline_modal').on("focus",'textarea',function(){
            $(this).removeClass("red-border");
        });

        // Credit Card Action
        $('.creditcard').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_creditcard(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.creditcard').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('CardPay');
            $('span#trans_title_modal').html('CardPay');
        });

        // UnionPay Action
        $('.unionpay').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_unionpay(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.unionpay').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('CUP');
            $('span#trans_title_modal').html('CUP');
        });

        // Skrill Action
        $('.skrill').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_skrill(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.skrill').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('Skrill');
            $('span#trans_title_modal').html('Skrill');
        });

        // Neteller Action
        $('.neteller').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_neteller(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.neteller').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('Neteller');
            $('span#trans_title_modal').html('Neteller');
        });

        // WebMoney Action
        $('.webmoney').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_webmoney(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.webmoney').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('WebMoney');
            $('span#trans_title_modal').html('WebMoney');
        });
        // Paxum Action
        $('.paxum').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_paxum(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.paxum').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('Paxum');
            $('span#trans_title_modal').html('Paxum');
        });
        // Ukash Action
        $('.ukash').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_ukash(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.ukash').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('Ukash');
            $('span#trans_title_modal').html('Ukash');
        });
        // PayCo Action
        $('.payco').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_payco(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.payco').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('PayCo');
            $('span#trans_title_modal').html('PayCo');
        });
        // Filspay Action
        $('.filspay').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_filspay(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.filspay').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('Filspay');
            $('span#trans_title_modal').html('Filspay');
        });

        // CashU Action
        $('.cashu').on('click','.approve-link',function(){
            var id = $(this).closest('tr').attr('id');
            var r = confirm("Are you sure you want to Approve?");
            if (r == true) {
                update_cashu(id, 'Processed');
                $(this).closest('tr').remove();
            }
        });
        $('.cashu').on('click','.decline-link',function(){
            var id = $(this).closest('tr').attr('id');
            var clientname = $('tr#'+id).children('td.clientname').text();
            var ref_num = $('tr#'+id).children('td.ref_num').text();
            $('span#ref_num_mod').html(ref_num);
            $('span#client_name_modal').html(clientname);
            $('input#trans_id').val(id);
            $('input#transType').val('CashU');
            $('span#trans_title_modal').html('CashU');
        });

        // Select withdrawal transaction
        $('#select-withdrawal-transaction').change(function(){
            var selectedWithdrawalTrans = $('#select-withdrawal-transaction').val();
            $('.withdrawal-panel').hide();
            switch(selectedWithdrawalTrans){
                case 'all':
                    update_all_withdrawalqueue();
                    break;
                case 'banktransfer':
                    update_banktransfer();
                    break;
                case 'creditcard':
                    update_creditcard();
                    break;
                case 'unionpay':
                    update_unionpay();
                    break;
                case 'skrill':
                    update_skrill();
                    break;
                case 'neteller':
                    update_neteller();
                    break;
                case 'webmoney':
                    update_webmoney();
                    break;
                case 'paxum':
                    update_paxum();
                    break;
                case 'ukash':
                    update_ukash();
                    break;
                case 'payco':
                    update_payco();
                    break;
                case 'filspay':
                    update_filspay();
                    break;
                case 'cashu':
                    update_cashu();
                    break;

            }
            $('#withdrawal-panel-'+selectedWithdrawalTrans).show();
            $('div.tab-panel-withdrawalqueue').hide();
            $('div.tab-panel-withdrawalqueue.Request').show();
        });
    });

    function update_all_withdrawalqueue(transId, action, comment){
        var status = $('.all-withdraw .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/all_withdrawalqueue_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#all-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }

    function update_banktransfer(transId, action, comment){
        var status = $('.bank_transfer .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/banktransfer_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#bt-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }

    function update_creditcard(transId, action, comment){
        var status = $('.creditcard .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/creditcard_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#cc-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }

    function update_unionpay(transId, action, comment){
        var status = $('.unionpay .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/unionpay_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#up-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_skrill(transId, action, comment){
        var status = $('.skrill .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/skrill_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#sk-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_neteller(transId, action, comment){
        var status = $('.neteller .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/neteller_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#nt-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_webmoney(transId, action, comment){
        var status = $('.webmoney .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/webmoney_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#wm-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_paxum(transId, action, comment){
        var status = $('.paxum .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/paxum_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#px-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }

    function update_ukash(transId, action, comment){
        var status = $('.ukash .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/ukash_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#uk-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_payco(transId, action, comment){
        var status = $('.payco .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/payco_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#pc-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_filspay(transId, action, comment){
        var status = $('.filspay .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/filspay_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#fp-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }
    function update_cashu(transId, action, comment){
        var status = $('.cashu .tab-toggle.active-set-tab').attr('id');
        $.ajax({
            type: 'POST',
            url: url+'administration/cashu_update',
            data: {status:status, action:action, transId:transId, comment:comment},
            dataType: 'json',
            beforeSend: function(){
                $('#loader-holder').show();
            },
            success: function(response){
                $('#loader-holder').hide();
                if(response.success){
                    $('#cu-'+status+'-tbody').html(response[status]['records']);
                }
            },
            error: function(jqXHR, textStatus){
                $('#loader-holder').hide();
            }
        });
    }

</script>