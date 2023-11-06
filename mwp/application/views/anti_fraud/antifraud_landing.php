<style type="text/css">
    /*DataTables DO NOT REMOVE*/
    #accoutnsDetils_wrapper #accoutnsDetils_length select, #accdetailsTable_wrapper #accdetailsTable_length select, input{
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        border: 1px solid #ccc;
        border-color: #d2d6de;
        margin-bottom: 10px;
        margin-top: -7px;
    }

    #accoutnsDetils_paginate .disabled, #accdetailsTable_paginate .disabled{
        color: #777;
        background-color: #fff;
        padding: 6px 12px;
        line-height: 1.42857143;
        border: 1px solid #ddd;
    }

    #accoutnsDetils_paginate a, #accdetailsTable_paginate a{
        border-color: #ddd;
        border: 1px solid #ddd;
        margin-left: -1px;
    }

    #accoutnsDetils_paginate .current, #accdetailsTable_paginate .current{
        z-index: 3;
        color: #fff!important;
        background-color: #337ab7!important;
        border-color: #337ab7!important;
        background: none;
    }

    #accoutnsDetils_paginate a:hover, #accoutnsDetils_paginate a:focus, #accdetailsTable_paginate a:hover, #accdetailsTable_paginate a:focus{
        z-index: 2;
        color: #23527c!important;
        background: #eee;
        border-color: #ddd;
    }

    #accoutnsDetils_paginate .current:hover, #accoutnsDetils_paginate .current:focus, #accdetailsTable_paginate .current:hover, #accdetailsTable_paginate .current:focus{
        color: #fff!important;
    }

    .modal-dialog {
        margin: 50px auto;
    }

    .modal-title{
    margin-top: 10px;
    margin-bottom: -20px;
    }

    .modal-header {border-bottom: 0;}
</style>

<section class="content-header">
  <h1>
    Anti Fraud
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-shield"></i> Anti Fraud</li>
    <li class="active">Account Information</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-body">
      <div class="style-form-table-responsive">
        <?php if(!empty($apiAccounts)){?>
          <table id="accoutnsDetils" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head" role="grid">
            <thead>
              <tr role="row">
                <th class="sorting" tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">Account Number</th>
                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 361px;">Full Name </th>                                                
                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 321px;">Email </th>
                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 255px;"> City  </th>
                <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($apiAccounts as $key) {
                    $country=$key->Country;
                     if((strlen($country))<3){$country=$countryCode[$country];
                }?>
                <tr>
                    <input type="hidden" id="tdcls_<?=$key->LogIn;?>" value="<?=$key->Name."_".$key->LogIn."_".$key->Agent."_".$key->Leverage."_".$key->Email."_".$key->PhoneNumber."_".$key->City."_".$country;?>">
                    <td style="text-align: center "><?=$key->LogIn;?></td>
                    <td><?=$key->Name;?></td>                                                
                    <td><?=$key->Email;?></td>
                    <td><?=$key->City;?></td>
                    <td> <a data-target="#pendingStat" data-toggle="modal" id="<?=$key->LogIn;?>" class="viewdetailslog style-table-in-button">View Details</a></td>   
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } else{ echo "<b class='repomgs'> No Data Found </b>";}?>                              
      </div> 
    </div>
  </div>    
</section>

<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" ></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"/>
  
<script>
showloader();
$(document).ready(function() {   
    $('#accoutnsDetils').DataTable({
        "order": [[ 3, "desc" ]]
    });

    $(".emailTh").removeAttr("style");
    $(".emailTh").css("width","200px");
    hideloader();
});
</script> 

 <script>     
    $(document).on("click",".viewdetailslog",function(){
        $("#detailsAcc").html("");
        showloader();
      
    var id=$(this).attr('id');
    var list=$("#tdcls_"+id).val();
    var res = list.split("_"); 
    $("#fullName").html(res[0]);
    $("#accountNumber").html(res[1]);
    $("#agent").html(res[2]);
    $("#leverage").html(res[3]);
    $("#emailid").html(res[4]);
    $("#mobileno").html(res[5]);
    $("#city").html(res[6]);
    $("#country").html(res[7]); 
    
    var url='<?php echo site_url() ?>';
    
    var fd3 = new FormData();
    fd3.append('id',res[1]);

    $.ajax({
        type: 'POST',
        url: 'Antifraud/getAccountDetails',
        data: fd3, 
        dataType: 'json',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: false        // To send DOMDocument or non processed data file it is set to false
    }).done(function (response) {
        // console.log(response);
        hideloader();

        $('#accdetailsTable').DataTable( {
                    "data": response,
                    "blengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "destroy": true,
                    "bInfo": false,
                    "columns": [
                        // { "data": "$i" },
                        { "data": "OpenTIme" },
                        { "data": "OpenPrice" },
                        { "data": "CloseTime" },
                        { "data": "ClosePrice" },
                        { "data": "OrderTicket" },
                        { "data": "Profit" },
                        { "data": "TradeType" },
                        { "data": "Symbol" },
                        { "data": "Comment" },
                    ]
        } );
    });
 });
 </script>
 

<div class="modal fade" id="pendingStat" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-lg round-0" id="modalbodybox" style="width: 87.85%; margin-left: 12.15%">
    <div class="modal-content round-0">
      <div class="modal-header round-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">
           <section class="content-header">
              <h1>
                Anti-Fraud - Full Details
              </h1>
              <ol class="breadcrumb">
                <li><i class="fa fa-shield"></i> Anti-Fraud</li>
                <li class="active">Full Details</li>
              </ol>
            </section>
          </h4>
        </div>

        <section class="content">
          <div class="box style-box">
            <div class="box-body">
              <table id="shortNameid">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                  <ul class="style-box-personal-information">
                    <li>
                      <label>Account Number:  </label>
                      <span id="accountNumber"></span>
                    </li>
                    <li>
                      <label>Full Name:  </label>
                      <span id="fullName"></span>
                    </li>
                    <li>
                      <label>Agent:  </label>
                      <span id="agent"></span>
                    </li>
                  </ul> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                  <ul class="style-box-personal-information">
                    <li>
                      <label>Email:  </label>
                      <span id="emailid"></span>
                    </li>
                    <li>
                      <label>City:  </label>
                      <span id="city"></span>
                    </li>
                    <li>
                      <label>Leverage:  </label>
                      <span id="leverage"></span>
                    </li>
                  </ul> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 style-box-personal-container">
                  <ul class="style-box-personal-information">
                    <li>
                      <label>Phone Number:  </label>
                      <span id="mobileno"></span>
                    </li>
                    <li>
                      <label>Country:  </label>
                      <span id="country"></span>
                    </li>
                  </ul> 
                </div>        
            </div>
            
            <div class="style-form-table-responsive">
                <!-- <div role="tabpanel" class="row tab-pane active" id="acctab1"> -->
              <table id="accdetailsTable" class="table table-bordered table-striped dataTable style-form-table mid-table-head" role="grid">
                <thead>
                  <tr role="row">
                    <!-- <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">SL</th> -->
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 361px;">Open Time</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 321px;">Open Price</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Close Time</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Close Price</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Order Ticket</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Profit</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Trade Type</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Currency</th>
                    <th tabindex="0" rowspan="1" colspan="1" style="width: 255px;">Comment</th>
                  </tr>
                </thead>
                <tbody id="detailsAcc">
                </tbody>
                </table>
                <!-- </div> -->
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>