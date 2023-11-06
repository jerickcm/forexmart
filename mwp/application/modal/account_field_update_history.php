<style type="text/css">

    .table-data {
        padding: 5px 40px;
    }

    #tblAccountFieldUpdateHistory_paginate {
        text-align: right;
    }
</style>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<div class="modal fade" id="accountFieldUpdateHistory" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="width: 87%;">
    <div class="modal-dialog modal-lg round-0 ">
        <div  class="modal-content round-0 ">
            <div class="modal-header round-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center modal-show-title">
                    Update History
                </h4>
            </div>
            <div class="modal-body">
                <div class="row col-md-12">
                    <p><strong>Modified by:</strong> <span class="manager-name"></span></p>
                </div>
                <div class="row table-responsive table-data">
                    <table class="table" id="tblAccountFieldUpdateHistory">
                        <thead>
                        <tr>
                            <th>Field</th>
                            <th>Previous Value</th>
                            <th>New Value</th>
                            <th>Date Modified</th>
                        </tr>
                        </thead>
                        <tbody id="tblAccountFieldUpdateHistoryRows">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#tblAccountFieldUpdateHistory').DataTable({
                        "bSort": false,
                        "ordering": false,
                        "info":     false,
                        dom: 'rtp<"clear">'
                    });
</script>