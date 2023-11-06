<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>


<!-- START ACCOUNT TABS -->
<div class="tab-pane active" id="search-account">
    <form action="" method="post">
        <div class="tab-title-header">
            <h1 class="all_tab_title">Incomplete Registration</h1>
            

        </div>
        <div  class="table-container-holder table-container-margin table-container-data">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <input id="thirtypercentbonus" name="radio" type="radio" <?=set_value('checkbox[1]')=="u.email"?"checked":"";?>  value="30% bonus" class="tab-checkbox filter"/>
                        <label><span class="required">*</span> 30% Bonus</label>
                    </td>
                    <td>
                        <input id="ndb" name="radio" type="radio" <?=set_value('checkbox[2]')=="p.full_name"?"checked":"";?>  value="NDB" class="tab-checkbox filter"/>
                        <label><span class="required">*</span> No deposit bonus</label>
                    </td>
                    <td>

                    </td>
                </tr>

            </table>
        </div>

    </form>

    <div  class="table-container-holder table-container-border table-container-margin data-center-container">

        <table id="table" cellpadding="0" cellspacing="0">
            <thead>
             <tr>
                 <th>Email </th>
                 <th>Full Name </th>
                 <th>Type</th>
                 <th>Date</th>
             </tr>
            </thead>
            <tbody>
            <?php foreach($inc_reg as $d){?>
                <tr>
                    <td> <?=$d->email?></td>
                    <td> <?=$d->full_name?></td>
                    <td><?php echo  $d->thirtypercentbonus == 1?"30% bonus ":"";
                        echo $d->nodepositbonus == 1?" NDB":""
                        ?></td>
                    <td> <?=$d->created?></td>
                </tr>
            <?php }?>
            </tbody>

        </table>


    </div>

</div>
<div style="clear: both"></div>
<!-- END ACCOUNT TABS -->

<style>
    .dataTables_wrapper{
        clear: none!important;
    }
    table.dataTable{
        clear: none!important;
    }
    table.dataTable select{
        padding: 6px 6px!important;
    }
    .dataTables_wrapper .dataTables_info{
        clear: none!important;
    }

</style>

<script>
  var oTable =  $("#table").DataTable({
        "bSort": false
    });
    $("#all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    $(document).on('click',".filter",function(){

        oTable.search($(this).val()).draw() ;
    })
</script>



