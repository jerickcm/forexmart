    <style>
        .nav-fix
        {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            transition: all ease 0.3s;
        }
    </style>
    <script type="text/javascript">
 
$(document).on("click","#SaveButton",function(){
    
    var checkReemail=0;
    
    $("#newmanager #password").removeAttr("style");
    $("#newmanager #repassword").removeAttr("style");
    $("#newmanager #name").removeAttr("style");
    $("#newmanager #email").removeAttr("style");
    $("#newmanager #passrech").remove();
    $("#newmanager #alreuse").remove();
    
    
    
    var pass=$("#newmanager #password").val();
    var repass=$("#newmanager #repassword").val();
    var name=$("#newmanager #name").val();
    var email=$("#newmanager #email").val();
    
   
    
    if(email.trim()=="" || name.trim()=="")
    {
        checkReemail=1;
        if(email.trim()=="") { $("#newmanager #email").css("border","1px solid red");}else{$("#newmanager #email").removeAttr("style");}
        if(name.trim()=="") { $("#newmanager #name").css("border","1px solid red");}else{$("#newmanager #name").removeAttr("style");}
        
        
    }
    else if(pass.trim()=="" || repass.trim()=="" )
    {
        
            var checkBox=0;           
            var remember = document.getElementById('slideThree');
            if (remember.checked)
            {
                 
            }else{ 
                    checkReemail=1;
                    if(pass.trim()=="") { $("#newmanager #password").css("border","1px solid red");}
                    else if(pass.trim()!=repass.trim())
                    {
                        checkReemail=1;
                         $("#newmanager #repassword").css("border","1px solid red");
                          $("#newmanager #repassword").closest("div").append("<b id='passrech' style='color:red'>  Password does not match</b>");
                    }else{
                        $("#newmanager #password").removeAttr("style");
                        $("#newmanager #repassword").removeAttr("style");
                    }
 
            }
          
     }else if(pass.trim()!=repass.trim())
            {
                var remember = document.getElementById('slideThree');
                    if (remember.checked)
                    {
                        return true;
                    }else{ 
                         checkReemail=1;
                         $("#newmanager #repassword").css("border","1px solid red");
                         $("#newmanager #repassword").closest("div").append("<b id='passrech' style='color:red'>  Password does not match</b>");                            
                    }
            }
            
   
        if(checkReemail==0)
            {
                    var email =$("#newmanager #email").val();
                    var url='<?php echo base_url() ?>';
               $.post(url+'administration/chekcAreadyEmail',{email:email},function(view){
                       
                        if (view.trim()!="")
                        {
                            $("#newmanager #email").val("");
                            $("#newmanager #email").closest("div").append("<b id='alreuse' style='color:red'> This email is already in use.</b>");
                             $("#newmanager #email").focus();                            
                        }else{
                            
                            $("#managerAdd").submit();
                        }

                  });
             
             }
 });    
    
  $(document).on("click","#onoff",function(){
     var remember = document.getElementById('slideThree');
            if (remember.checked)
            {
               $("#newmanager .posPassworad").show();
            }else{
                 
               $("#newmanager .posPassworad").hide(); 
               $("#newmanager #password").val("");
                        $("#newmanager #repassword").val("");
               
            } 
      
  })
  
        


 

    </script>
     
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" ></script> 
    <script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css"/>
<script>
    
  $(document).ready(function() {
    $('#manage_access').DataTable({
         "bLengthChange": false,
         "order": [],
         "bFilter":false,
         "oLanguage": { "oPaginate": {"sNext": "»","sPrevious": "«"}}
        
    });
    
  
  
} );
 
 
 function managePermisssion(name,permission,userid)
 {
     
      
    $("#managepermisssion input[type=checkbox]").prop('checked',false);
    
    $("#managepermisssion #managepermisUse").html(name);
    $("#managepermisssion #manage_in_userid").val(userid);
      
     if(permission.trim()!="")
     {
          var a = permission.split(","); 
          var index; 
        for (index = a.length - 1; index >= 0; --index) {
           $("#managepermisssion ."+a[index]).prop('checked', true);
        }
         
     }
     
 }
 
 function manageEdit(name,email,permission,userid)
 {
     
      
    $("#manageedit input[type=checkbox]").prop('checked',false);
    
    $("#manageedit #name").val(name);
    $("#manageedit #email").val(email);
    $("#manageedit #manage_in_userid").val(userid);
      
     if(permission.trim()!="")
     {
          var a = permission.split(","); 
          var index; 
        for (index = a.length - 1; index >= 0; --index) {
           $("#manageedit ."+a[index]).prop('checked', true);
        }
         
     }
     
 }
 $(document).on("click","#resetPass",function(){    
     
     if($("#toggleData").val()==1)
     {
        $(this).removeClass("toggleButton");   
        $("#toggleData").val(0);
       
     }else{
          $("#toggleData").val(1); 
        $(this).addClass("toggleButton");
     }
    
});
 
 function validateFormUpdate()
{
     
    $("#manageedit #name").removeAttr("style");
    $("#manageedit #email").removeAttr("style");
    
 
    var name=$("#manageedit #name").val();
    var email=$("#manageedit #email").val();
    
    if(email.trim()=="" || name.trim()=="")
    {
        if(email.trim()=="") { $("#manageedit #email").css("border","1px solid red");}else{$("#manageedit #email").removeAttr("style");}
        if(name.trim()=="") { $("#manageedit #name").css("border","1px solid red");}else{$("#manageedit #name").removeAttr("style");}
        
        return false;
    }
  
  }
  $(document).on("click",".change_ac",function(){
      
      var id =$(this).attr("id");
       var status=$("#change_"+id).val();
        if(status==1)
        {
            ajaxCall(id,0);
            $("#change_"+id).val(0);
            $(this).html("Activate");;
        }else{
            ajaxCall(id,1);
             $("#change_"+id).val(1);
             $(this).html("Deactivate");
        }
  });
  
  function ajaxCall(id,status)
  {
      var url='<?php echo base_url()?>';
      $.post(url+'administration/ManagerActiveDeactive',{user_id:id,status:status},function(view){     
     
    });
      
  }
  
 function filterAcess()
 {
     $("#managerFilter").submit();
     
 }
 
 $(document).on("click",".delstatus",function(){
     var user_id=$(this).attr("id");
      var url='<?php echo base_url()?>';
      
        if (confirm('Are you sure you want to delete this manager?')) 
        {

             $.post(url+'administration/AdminMangeDelete',{user_id:user_id},function(view){  
                
                    if(view==true || view==1)
                    {
                        $("#dmg_"+user_id).css("display","none");
                        $("#dmg_"+user_id).remove();
                        alert("Deleted successfully");
                        
                    }
                    else
                    {
                        alert("Failed to Delete !");
                    }

                }) ;
         }
     
 });
 

 </script>
 <style>
  table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after {
    display: none;
}
.toggleButton{background: gray !important;color:#999 !important}
     
 </style>
 
 
  <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section">
                        <!-- <h1 class="">My Accounts</h1> -->
                          <?= form_open('administration/filterManager',array('id' => 'managerFilter','class'=> 'form-horizontal'),''); ?>
                        <div class="add-manager-holder">
                            <a  style="cursor: pointer"data-toggle="modal" data-target="#addmanager">Add new manager</a>
                          
                            <select style="float: right; height: 30px; padding-left: 4px; width: 200px;" name="statusActivied" onchange="filterAcess()">
                                <option value="2" <?php echo $filter==2?'selected':'';?>>All</option>
                                <option value="1" <?php echo $filter==1?'selected':'';?>>Active</option>
                                <option value="0" <?php echo $filter==0?'selected':'';?> >Deactivated</option>
                            </select>
                            <input type="submit" style="display:none" id="statusActivied">
                       
                        </div>
                         <?php echo form_close()?>
                        <div class="table-responsive mail-tab-holder manage-access-tab" style="overflow-x: hidden">
                            <table class="table table-striped" id="manage_access">
                                <thead>
                                    <tr>
                                        <th class="manage-access-tab-title" style="width: 200px">Manager</th>
                                        <th style="width: 230px">Email</th>
                                        <th class="ma-permission">Permission</th>
                                        <th class="ma-access" style="text-align: right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($data as $key){?>
                                    <tr id="dmg_<?php echo $key['user_id']?>">
                                        <td><?php echo $key['name'];?></td>
                                        <td><?php echo $key['email'];?></td>
                                        <td class="ma-action">
                                            <a style="cursor: pointer" onclick="managePermisssion('<?php echo $key['name']?>','<?php echo $key['permission']?>','<?php echo $key['user_id']?>')" data-toggle="modal" data-target="#managepermisssion">Manage Permission</a>
                                        </td>
                                        <td class="ma-action" style="text-align: right">
                                            <a style="cursor: pointer" onclick="manageEdit('<?php echo $key['name']?>','<?php echo $key['email']?>','<?php echo $key['permission']?>','<?php echo $key['user_id']?>')" data-toggle="modal" data-target="#manageedit">Edit</a> |
                                            <a style="cursor: pointer" id="<?php echo $key['user_id']?>" class="change_ac" ><?php if($key['status']==1){echo "Deactivate";}else{echo "Activate";}?></a> | 
                                            <input type="hidden" id="change_<?php echo $key['user_id']?>" value="<?php echo $key['status']?>"/>
                                            <a style="cursor: pointer" id="<?php echo $key['user_id']?>" class="delstatus" >Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
<!--                        <div class="row">
                            <div class="col-md-6">
                               
                                <p class="lincense-text">
                                    Showing 1 to 5 of 5 entries
                                </p>
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
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    
    
    
    
    <!-- modal -->
    <div class="modal fade" id="addmanager" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog round-0">
            <div class="modal-content round-0"> 
                <?= form_open('administration/ManagerAdd',array('id' => 'managerAdd','class'=> 'form-horizontal'),''); ?>
                <div class="modal-header round-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title-sub">Add New Manager</h4>
                </div>
                <div class="modal-body" id="newmanager">
                    <div class="row">
                        <div class="col-sm-10 col-centered">
<!--                            <form class="form-horizontal">-->
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control round-0" name="email" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Full Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control round-0" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group posPassworad">
                                    <label for="" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control round-0" name="password" id="password">
                                    </div>
                                </div>
                                <div class="form-group posPassworad">
                                    <label for="" class="col-sm-4 control-label">Re-enter Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control round-0" name="rePassword" id="repassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="slideThree">
                                            <input type="checkbox" value="None" id="slideThree" name="auto_generate" style="display: none;" />
                                            <label for="slideThree" id="onoff"></label>
                                        </div>
                                        <label>Auto-generated password.</label>
                                    </div>
                                </div>
                                <label>Set Permission</label>
                                <p class="manage-text">Set which admin pages are accessible for the Manager</p>
                                <div class="chk-permission-holder">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="mailer" class="mailer" name="permission[]"> Mailer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="acveri" class="acveri" name="permission[]"> Account Verification
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="manacces" class="manacces" name="permission[]"> Manage Access
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="withdqueue" class="withdqueue" name="permission[]"> Withdrawal Queue
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="manaccounts" class="manaccounts" name="permission[]"> Manage Accounts
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="mannews" class="mannews" name="permission[]"> Manage News
                                        </label>
                                    </div>
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer round-0">
                    <button type="button" class="btn btn-primary round-0" id="SaveButton" >Save</button>
                </div>
                    <?php echo form_close()?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="manageedit" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog round-0">
            <div class="modal-content round-0">
                <div class="modal-header round-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title-sub">Edit Manager</h4>
                </div>
                <?= form_open('administration/ManagerEdit',array('onsubmit' => 'return validateFormUpdate()','id' => 'managerEdit','class'=> 'form-horizontal'),''); ?>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-10 col-centered">
<!--                            <form class="form-horizontal">-->
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control round-0" name="email" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Full Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control round-0" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <a style="cursor: pointer" id="resetPass" class="manage-reset-password">Reset Password</a>
                                        
                                    </div>
                                </div>
                                <label>Set Permission</label>
                                <p class="manage-text">Set which pages are accessible for this Manager.</p>
                                          <div class="chk-permission-holder">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="mailer" class="mailer" name="permission[]"> Mailer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="acveri" class="acveri" name="permission[]"> Account Verification
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="manacces" class="manacces" name="permission[]"> Manage Access
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="withdqueue" class="withdqueue" name="permission[]"> Withdrawal Queue
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="manaccounts" class="manaccounts" name="permission[]"> Manage Accounts
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="mannews" class="mannews" name="permission[]"> Manage News
                                        </label>
                                    </div>
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                </div>
                  <input type="hidden" name="manage_in_userid" id="manage_in_userid">
                  <input type="hidden" name="toggleData" id="toggleData" value="0">
                <div class="modal-footer round-0">
                    <button type="submit" class="btn btn-primary round-0">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="managepermisssion" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog round-0">
            <div class="modal-content round-0">
                <div class="modal-header round-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title-sub">Manage Permission</h4>
                </div>
                 <?= form_open('administration/ManagerAccessUpdate',array('id' => 'managerAccess','class'=> 'form-horizontal'),''); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-10 col-centered">
                            
                                <p class="manage-text">Set which pages can be accessed by <span id="managepermisUse">John Smith</span></p>
                                          <div class="chk-permission-holder">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="mailer" class="mailer" name="permission[]"> Mailer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="acveri" class="acveri" name="permission[]"> Account Verification
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="manacces" class="manacces" name="permission[]"> Manage Access
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="withdqueue" class="withdqueue" name="permission[]"> Withdrawal Queue
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="manaccounts" class="manaccounts" name="permission[]"> Manage Accounts
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="mannews" class="mannews" name="permission[]"> Manage News
                                        </label>
                                    </div>
                                </div>
                             
                        </div>
                    </div>
                </div>
                <input type="hidden" name="manage_in_userid" id="manage_in_userid">
                <div class="modal-footer round-0">
                    <button type="submit" class="btn btn-primary round-0">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editbonus" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog round-0">
            <div class="modal-content round-0">
                <div class="modal-header round-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Bonus</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-centered">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Account Number:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control round-0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Sum:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control round-0">
                                    </div>
                                    <label for="" class="col-sm-1 control-label">USD</label>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">30% bonus:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control round-0">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="control-label">USD</label>
                                        <a href="#" class="cancel-bonus">Cancel Bonus</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer round-0">
                    <button type="button" class="btn btn-primary round-0">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    
    
     
    <!-- jQuery -->
 
 

    