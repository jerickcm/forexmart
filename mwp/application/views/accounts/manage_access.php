 <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<link rel="stylesheet" type="text/css" href="<?=$this->template->Css()?>custom_manage_access.css"/>
<section class="content-header">
    <h1>Manage Access</h1>
    <ol class="breadcrumb"><li class="active"><i class="fa fa-lock"></i> Manage Access</li></ol>
</section>
<section class="content">
    <div class="box style-box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 manage-access-box">
<div class="tab-pane active manageAccessmndiv"> <!--NO close div yet-->
    <?= form_open('manager-filter',array('id' => 'managerFilter','class'=> 'form-horizontal'),''); ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 manage-access-box">
        <button type="button" style="margin-left: -15px;color: #fff;font-family: Arial;font-size: 14px;background: #29a643;padding:10px;transition: all ease .3s;border:none;outline: none;" data-toggle="modal" data-target="#modal-one">
            Add new manager
        </button>
        <div id="example1_filter" class="dataTables_filter manage-access-filter" style="margin-right: -15px;">
            <select onchange="javascript:filterAcess();" name="statusActivied" class="form-control inputdefault">
                <option selected="" value="2">All</option>
                <option value="1">Active</option>
                <option value="0">Deactivated</option>
                    <option value="3">Deleted</option>
            </select>
        </div>
        <input type="submit" id="statusActivied" style="display:none">
    </div>
    <?php echo form_close()?>
    <?php if(isset($success)){?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 manage-access-box">
        <p style=" width:30%;margin-left:35%;text-align: center;color:#29a643;font-size: 14px;font-weight: bold"><?=$success;?></p>
    </div>
    <?php } ?>
    <table cellpadding="0"  cellspacing="0" id="myTable" class="table table-bordered table-striped dataTable style-form-table last-mid-table-head">
        <thead>
        <tr role="row">
            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 295px;">SI</th>
            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 361px;">Manager</th>
            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 321px;">Email</th>
            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Permission</th>
            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 255px;">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1;foreach($data as $key){?>
            <tr id="dmg_<?php echo $key['user_id']?>">
                <td style="text-align: center; padding: 0px"><?=$i++;?></td>
                <td style="padding-left: 18px;"><?php echo $key['name'];?></td>
                <td style="padding-left: 18px;"><?php echo $key['email'];?></td>
                <td class="ma-action">
                    <a type="button" data-toggle="modal" data-target="#modal-two" style=" cursor:pointer; text-decoration: none; color: dodgerblue;padding-left: 28%;" onclick="managePermisssion('<?php echo $key['name']?>','<?php echo $key['permission']?>','<?php echo $key['user_id']?>')" >Manage Permission</a>
                </td>
                <?php $userId= $this->session->userdata('user_id');  if($filter==3){ ?>
                        <td class="ma-action" style="text-align:center;"><a type="button" style="cursor: pointer;color: dodgerblue;text-align: right;text-decoration:none;">Not available</a></td>
                <?php  }else if($key['user_id']==$userId) {?>
                    <td class="ma-action" style="text-align:center;">
                        <a type="button" data-toggle="modal" data-target="#modal-three" style="cursor: pointer;color: dodgerblue;text-align: right;text-decoration:none;"  onclick="manageEdit('<?php echo $key['name']?>','<?php echo $key['email']?>','<?php echo $key['permission']?>','<?php echo $key['user_id']?>')" >Edit</a> |
                        <a style="cursor: pointer;color: dodgerblue;text-align: right;text-decoration:none;" id="<?php echo $key['user_id']?>" class="change_ac" >  <?php if($key['status']==1){echo "Deactivate";}else{echo "Activate";}?></a>
                        <input type="hidden" id="change_<?php echo $key['user_id']?>" value="<?php echo $key['status']?>"/>
                    </td>
                <?php }else{?>
                    <td class="ma-action" style="text-align:center;">
                        <a type="button" data-toggle="modal" data-target="#modal-three" style="cursor: pointer;color: dodgerblue;text-align: right;text-decoration:none;"  onclick="manageEdit('<?php echo $key['name']?>','<?php echo $key['email']?>','<?php echo $key['permission']?>','<?php echo $key['user_id']?>')" >Edit</a> |
                        <a style="cursor: pointer;color: dodgerblue;text-align: right;text-decoration:none;" id="<?php echo $key['user_id']?>" class="change_ac" ><?php if($key['status']==1){echo "Deactivate";}else{echo "Activate";}?></a> |
                        <input type="hidden" id="change_<?php echo $key['user_id']?>" value="<?php echo $key['status']?>"/>
                        <a style="cursor: pointer; color: dodgerblue;text-align: right;text-decoration:none;" id="<?php echo $key['user_id']?>" class="delstatus" >Delete</a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
        </div>
    </div>
</section>

<!--MODAL-ONE-->
                <div class="modal fade" id="modal-one" tabindex="-1" role="dialog" aria-labelledby="">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width: 70%;margin-left: 15%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add New Manager</h4>
                            </div>
                            <div class="modal-body style-customized-modal-body" id="newmanager">
                                <?= form_open('manager-add',array('id' => 'managerAdd','class'=> 'form-horizontal'),''); ?>
                                <div class="" id="addmanagerModal" style="">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="primary-modal-box">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 primary-modal-box-child" style="margin-left: 25%;margin-bottom:2%;">
                                                <div class="form-group">
                                                    <label>Email</label><input type="email" id="email" name="email" class="form-control" style="width:100%">
                                                </div>
                                                <div class="form-group">
                                                    <label>Full Name</label><input type="text" id="name" name="name" class="form-control" style="width:100%">
                                                </div>
                                                <div class="form-group passtr">
                                                    <label>Password</label><input type="password" id="password" name="password" class="form-control" style="width:100%">
                                                    <label style="color: red; float: left; font-size: 12px;" id="passwordNotice"> </label>
                                                </div>
                                                <div class="form-group passtr">
                                                    <label>Re-enter Password</label><input type="password" id="repassword" name="rePassword" class="form-control" style="width:100%">
                                                </div>
                                                <div class="form-group">
                                                    <div style="margin-top:5px;"><input type="checkbox" name="auto_generate" id="slideThree" value="None"> Auto-generated password.</div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="secondary-modal-box">
                                        <h2>Set Permission</h2>
                                        <p>Set which admin pages are accessible for the Manager</p>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="settings-permission">
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="qjum" value="qjum" onclick="subAllCheckBox('managerAdd','qjum','qjumsubdiv')" id="qjum"> Quick Jump
                                                        <ul class="qjumsubdiv subparentbox">
                                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="qjper subcls" value="qjper" rel="qjum"><span>Personal</span></li>
                                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="openacc subcls" value="openacc" rel="qjum"><span>Register</span></li>
                                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="qjgot subcls" value="qjgot" rel="qjum"><span>Go to the cabinet</span></li>
                                                        </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="bal" value="bal" onclick="subAllCheckBox('managerAdd','bal','balsubdiv')" id="bal">Balance
                                                    <ul class="balsubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="balchart subcls" value="balchart" rel="bal"><span>Chart</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="baltran subcls" value="baltran" rel="bal"><span>Transactions</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="balops subcls" value="balops" rel="bal"><span>Operations</span></li>
                                                    </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="trades" value="trades" onclick="subAllCheckBox('managerAdd','trades','tradesubdiv')" id="trades">Trades
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="fin" value="fin" onclick="subAllCheckBox('managerAdd','fin','finsubdiv')" id="fin">Finance
                                                    <ul class="finsubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="findeposit subcls" value="findeposit" rel="fin"><span>Deposit</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="finwithdrawal subcls" value="finwithdrawal" rel="fin"><span>Withdrawal</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="finequity subcls" value="finequity" rel="fin"><span>Equity</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="fincredit subcls" value="fincredit" rel="fin"><span>Credit</span></li>
                                                    </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="ver" value="ver" onclick="subAllCheckBox('managerAdd','ver','versubdiv')" id="ver">Verify
                                                    <ul class="versubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="vercheck subcls" value="vercheck" rel="ver"><span>Check Query</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="verincomplete subcls" value="verincomplete" rel="ver"><span>Incomplete Registration</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-right: 0px!important;">
                                            <div class="settings-permission">
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="info" value="info" onclick="subAllCheckBox('managerAdd','info','infosubdiv')" id="info">Information
                                                    <ul class="infosubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="infoaccounts subcls" value="infoaccounts" rel="info"><span>Total Accounts</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="infosaldo subcls" value="infosaldo" rel="info"><span>Total Saldo</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="infodeposit subcls" value="infodeposit" rel="info"><span>Total Deposit</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="infotrades subcls" value="infotrades" rel="info"><span>Total Trade Results</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="infocalcu subcls" value="infocalcu" rel="info"><span>Agent's Commission Calculator</span></li>
                                                    </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="part" value="part" onclick="subAllCheckBox('managerAdd','part','partsubdiv')" id="part">Partners
                                                    <ul class="partsubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="partreferrals subcls" value="partreferrals" rel="part"><span>Referrals</span></li>
                                                    </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="ord" value="ord" onclick="subAllCheckBox('managerAdd','ord','ordsubdiv')" id="ord">Orders
                                                    <ul class="ordsubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="ordticket subcls" value="ordticket" rel="ord"><span>Ticket</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="ordmodify subcls" value="ordmodify" rel="ord"><span>Modify</span></li>
                                                    </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="anti" value="anti" onclick="subAllCheckBox('managerAdd','anti','antisubdiv')" id="anti">Anti Fraud
                                                    <ul class="antisubdiv subparentbox">
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="antilanding subcls" value="antilanding" rel="anti"><span>Account Information</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="anticommission subcls" value="anticommission" rel="anti"><span>Commission</span></li>
                                                        <li class="checkbox"><input type="checkbox" name="permission[]" class="antiswap subcls" value="antiswap" rel="anti"><span>Swaps</span></li>
                                                    </ul>
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input type="checkbox" name="permission[]" class="access" value="mana" onclick="subAllCheckBox('managerAdd','access','accesssubdiv')" id="access">Manage Access
                                                </div>
                                                <div class="settings-permission-head checkbox">
                                                    <input id="chkSelectAll"name="chkSelectAll" type="checkbox">All
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div><!--col-lg-12-->
                                    <button id="SaveButton" class="btn btn-primary round-0" type="button" style=" background-color: #337ab7; margin-left: 45%!important;width: 10%;margin:20px;">Add</button>
                                </div>
                                <?= form_close();?>
                            </div>
                        </div>
                    </div>
                </div>

    <!--MODAL-TWO-->

    <div class="modal fade" id="modal-two" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 70%;margin-left: 15%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php if($filter==3){ $fdesc = 'Permissions'; }else{ $fdesc = 'Manage Permissions';  }?><h4 class="modal-title" id="myModalLabel"><?=$fdesc?></h4>
                </div>
                <div class="modal-body style-customized-modal-body" id="permissionmanager">
                    <?= form_open('manager-update',array('id' => 'managerUpdate','class'=> 'form-horizontal'),''); ?>
                    <div class="col-centered" id="addmanagerModal">
                        <?php if($filter==3){ $fdesc1 = 'Previous accessed by the deleted user '; }else{ $fdesc1 = 'Set which pages can be accessed by ';  }?>
                            <p class="manage-text"><?=$fdesc1?><b id="managepermisUse"></b></p>
                        <div class="secondary-modal-box">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="settings-permission" id="chk-modaltwo">
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="qjum" value="qjum" onclick="subAllCheckBox('managerUpdate','editqjum','qjumsubdiv')" id="editqjum"> Quick Jump
                                        <ul class="qjumsubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="qjper subcls" value="qjper" rel="editqjum"><span>Personal</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="openacc subcls" value="openacc" rel="editqjum"><span>Register</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="qjgot subcls" value="qjgot" rel="editqjum"><span>Go to the cabinet</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="bal" value="bal" onclick="subAllCheckBox('managerUpdate','editbal','balsubdiv')" id="editbal">Balance
                                        <ul class="balsubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="balchart subcls" value="balchart" rel="editbal"><span>Chart</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="baltran subcls" value="baltran" rel="editbal"><span>Transactions</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="balops subcls" value="balops" rel="editbal"><span>Operations</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="trades" value="trades" onclick="subAllCheckBox('managerUpdate','edittrades','tradesubdiv')" id="edittrades">Trades
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="fin" value="fin" onclick="subAllCheckBox('managerUpdate','editfin','finsubdiv')" id="editfin">Finance
                                        <ul class="finsubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="findeposit subcls" value="findeposit" rel="editfin"><span>Deposit</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="finwithdrawal subcls" value="finwithdrawal" rel="editfin"><span>Withdrawal</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="finequity subcls" value="finequity" rel="editfin"><span>Equity</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="fincredit subcls" value="fincredit" rel="editfin"><span>Credit</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="ver" value="ver" onclick="subAllCheckBox('managerUpdate','editver','versubdiv')" id="editver">Verify
                                        <ul class="versubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="vercheck subcls" value="vercheck" rel="editver"><span>Check Query</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="verincomplete subcls" value="verincomplete" rel="editver"><span>Incomplete Registration</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-right: 0!important;">
                                <div class="settings-permission">
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="info" value="info" onclick="subAllCheckBox('managerUpdate','editinfo','infosubdiv')" id="editinfo">Information
                                        <ul class="infosubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="infoaccounts subcls" value="infoaccounts" rel="editinfo"><span>Total Accounts</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="infosaldo subcls" value="infosaldo" rel="editinfo"><span>Total Saldo</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="infodeposit subcls" value="infodeposit" rel="editinfo"><span>Total Deposit</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="infotrades subcls" value="infotrades" rel="editinfo"><span>Total Trade Results</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="infocalcu subcls" value="infocalcu" rel="editinfo"><span>Agent's Commission Calculator</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="part" value="part" onclick="subAllCheckBox('managerUpdate','editpart','partsubdiv')" id="editpart">Partners
                                        <ul class="partsubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="partreferrals subcls" value="partreferrals" rel="editpart"><span>Referrals</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="ord" value="ord" onclick="subAllCheckBox('managerUpdate','editord','ordsubdiv')" id="editord">Orders
                                        <ul class="ordsubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="ordticket subcls" value="ordticket" rel="editord"><span>Ticket</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="ordmodify subcls" value="ordmodify" rel="editord"><span>Modify</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="anti" value="anti" onclick="subAllCheckBox('managerUpdate','editanti','antisubdiv')" id="editanti">Anti Fraud
                                        <ul class="antisubdiv subparentbox">
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="antilanding subcls" value="antilanding" rel="anti"><span>Account Information</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="anticommission subcls" value="anticommission" rel="editanti"><span>Commission</span></li>
                                            <li class="checkbox"><input type="checkbox" name="permission[]" class="antiswap subcls" value="antiswap" rel="editanti"><span>Swaps</span></li>
                                        </ul>
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input type="checkbox" name="permission[]" class="mana" value="mana" onclick="subAllCheckBox('managerUpdate','editaccess','accesssubdiv')" id="editaccess">Manage Access
                                    </div>
                                    <div class="settings-permission-head checkbox">
                                        <input id="chkSelectAll"name="chkSelectAll" type="checkbox">All
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <input type="hidden" name="manage_in_userid" id="manage_in_userid">
                        <?php if($filter!=3){?>
                        <button class="btn btn-primary round-0" type="submit" style=" background-color: #337ab7; float: right; margin:20px">Update</button>
                        <?php }?>
                    </div>
                    <?= form_close();?>
                </div>

            </div>
        </div>
    </div>



    <!--MODAL-THREE-->

    <div class="modal fade" id="modal-three" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 70%;margin-left:15%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Manager</h4>
                </div>
                <div class="modal-body style-customized-modal-body" id="manageedit">
                    <?= form_open('manager-edit',array('onsubmit' => 'return validateFormUpdate()','id' => 'managerEdit','class'=> 'form-horizontal'),''); ?>
                    <div class="col-sm-12 col-centered" id="addmanagerModal">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="primary-modal-box">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 primary-modal-box-child" style="margin-left: 25%;margin-bottom:2%;">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control" style="width:100%">
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" id="name" name="name" class="form-control" style="width:100%">
                                    </div>
                                    <div class="form-group passtr">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" style="width:100%">
                                        <label style="color: red; float: left; font-size: 12px;" id="passwordNotice"> </label>
                                    </div>
                                    <div class="form-group passtr">
                                        <label>Re-enter Password</label>
                                        <input type="password" id="repassword" name="rePassword" class="form-control" style="width:100%">
                                    </div>
                                    <div class="form-group">
                                        <div style="margin-top:5px;">
                                            <input type="checkbox" name="auto_generate" id="slideThree" value="None"> Auto-generated password.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="secondary-modal-box">
                                <h2>Set Permission</h2>
                                <p>Set which admin pages are accessible for the Manager</p>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="settings-permission">
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="qjum" value="qjum" onclick="subAllCheckBox('managerEdit','aeqjum','qjumsubdiv')" id="aeqjum"> Quick Jump
                                            <ul class="qjumsubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="qjper subcls" value="qjper" rel="aeqjum"><span>Personal</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="openacc subcls" value="openacc" rel="aeqjum"><span>Register</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="qjgot subcls" value="qjgot" rel="aeqjum"><span>Go to the cabinet</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="bal" value="bal" onclick="subAllCheckBox('managerEdit','aebal','balsubdiv')" id="aebal">Balance
                                            <ul class="balsubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="balchart subcls" value="balchart" rel="aebal"><span>Chart</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="baltran subcls" value="baltran" rel="aebal"><span>Transactions</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="balops subcls" value="balops" rel="aebal"><span>Operations</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="trades" value="trades" onclick="subAllCheckBox('managerEdit','aetrades','tradesubdiv')" id="aetrades">Trades
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="fin" value="fin" onclick="subAllCheckBox('managerEdit','aefin','finsubdiv')" id="aefin">Finance
                                            <ul class="finsubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="findeposit subcls" value="findeposit" rel="aefin"><span>Deposit</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="finwithdrawal subcls" value="finwithdrawal" rel="aefin"><span>Withdrawal</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="finequity subcls" value="finequity" rel="aefin"><span>Equity</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="fincredit subcls" value="fincredit" rel="aefin"><span>Credit</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="ver" value="ver" onclick="subAllCheckBox('managerEdit','aever','versubdiv')" id="aever">Verify
                                            <ul class="versubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="vercheck subcls" value="vercheck" rel="aever"><span>Check Query</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="verincomplete subcls" value="verincomplete" rel="aever"><span>Incomplete Registration</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-right:0!important;">
                                    <div class="settings-permission">
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="info" value="info" onclick="subAllCheckBox('managerEdit','aeinfo','infosubdiv')" id="aeinfo">Information
                                            <ul class="infosubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="infoaccounts subcls" value="infoaccounts" rel="aeinfo"><span>Total Accounts</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="infosaldo subcls" value="infosaldo" rel="aeinfo"><span>Total Saldo</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="infodeposit subcls" value="infodeposit" rel="aeinfo"><span>Total Deposit</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="infotrades subcls" value="infotrades" rel="aeinfo"><span>Total Trade Results</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="infocalcu subcls" value="infocalcu" rel="aeinfo"><span>Agent's Commission Calculator</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="part" value="part" onclick="subAllCheckBox('managerEdit','aepart','partsubdiv')" id="aepart">Partners
                                            <ul class="partsubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="partreferrals subcls" value="partreferrals" rel="aepart"><span>Referrals</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="ord" value="ord" onclick="subAllCheckBox('managerEdit','aeord','ordsubdiv')" id="aeord">Orders
                                            <ul class="ordsubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="ordticket subcls" value="ordticket" rel="aeord"><span>Ticket</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="ordmodify subcls" value="ordmodify" rel="aeord"><span>Modify</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="anti" value="anti" onclick="subAllCheckBox('managerEdit','aeanti','antisubdiv')" id="aeanti">Anti Fraud
                                            <ul class="antisubdiv subparentbox">
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="antilanding subcls" value="antilanding" rel="anti"><span>Account Information</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="anticommission subcls" value="anticommission" rel="aeanti"><span>Commission</span></li>
                                                <li class="checkbox"><input type="checkbox" name="permission[]" class="antiswap subcls" value="antiswap" rel="aeanti"><span>Swaps</span></li>
                                            </ul>
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input type="checkbox" name="permission[]" class="mana" value="mana" onclick="subAllCheckBox('managerEdit','aeaccess','accesssubdiv')" id="aeaccess">Manage Access
                                        </div>
                                        <div class="settings-permission-head checkbox">
                                            <input id="chkSelectAll"name="chkSelectAll" type="checkbox">All
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--col-lg-12-->
                    </div>
                        <input type="hidden" name="manage_in_userid" id="manage_in_userid">
                        <input type="hidden" name="toggleData" id="toggleData" value="0">
                        <button class="btn btn-primary round-0" type="submit" style=" background-color: #337ab7; float: right; margin:20px">Update</button>
                    </div>
                    <?=  form_close();?>
                </div>

            </div>
        </div>
    </div>


</div>
 <script type="text/javascript">
     var table;
     $(document).ready(function(){
         table = $('#myTable').DataTable({});
         $('#myTable_wrapper').removeClass('dataTables_wrapper');
         $('select[name=statusActivied]').val(<?=$filter;?>);
         if(<?=$filter;?>==3){
             $('#chk-modaltwo input[type=checkbox]').prop("disabled", true);
         }
         $('.subparentbox input[type=checkbox]').addClass('subcls');
         $('.subparentbox .checkbox').css({"padding-left":"0px"});
     });
     function filterAcess()
     {
         $("#managerFilter").submit();
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
     function managePermisssion(name,permission,userid,status)
     {
         $("#permissionmanager input[type=checkbox]").prop('checked',false);
         $("#permissionmanager #managepermisUse").html(name);
         $("#permissionmanager #manage_in_userid").val(userid);

         if(permission.trim()!="")
         {
             var a = permission.split(",");
             var index;
             for (index = a.length - 1; index >= 0; --index)
             {
                 $("#permissionmanager ."+a[index]).prop('checked', true);
             }
         }
     }
     function checkIsAlphabet(str)
     {
         if (str.match(/[a-z]/i))
         { return true;}else{ return false;}
     }
     //    Adding New Manager
     $(document).on("click","#SaveButton",function(){
         showloader();
         $("#passwordNotice").html("");
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
                     $("#newmanager #repassword").closest("td").append(" <b id='passrech' style='color:red'>  Password does not match</b>");
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
                 $("#newmanager #repassword").closest("td").append("<b id='passrech' style='color:red'>  Password does not match</b>");
             }
         }
         if(checkReemail==0)
         {
             var password= $("#password").val();
             var result=checkIsAlphabet(password);

             var finalCheck=true;
             var remember = document.getElementById('slideThree');

             if (remember.checked)
             {
                 finalCheck= true;
             }
             else
             {
                 if(result==false){ finalCheck= false;}else{ finalCheck= true;}
             }
             if(finalCheck==false)
             {
                 $("#passwordNotice").html("Minimum 1 character of Password must be A-Z");
             }
             else
             {
                 var email =$("#newmanager #email").val();
                 var url='<?php echo site_url() ?>';
                 $.post(url+'accounts/chekcAreadyEmail',{email:email},function(view){
                     if (view.trim()!="")
                     {
                         console.log('adding');
                         $("#newmanager #email").val("");
                         $("#newmanager #email").closest("td").append("<b id='alreuse' style='color:red'> This email is already in use.</b>");
                         $("#newmanager #email").focus();
                     }else{

                         $("#managerAdd").submit();
                     }
                 });
             }
         }
         hideloader();
     });
     function ajaxCall(id,status)
     {
         var url='<?php echo base_url()?>';
         $.post(url+'manager-activeDactive',{user_id:id,status:status},function(view){
         });
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
     //Deleting User
     $(document).on("click",".delstatus",function(){
         var user_id=$(this).attr("id");
         var url='<?php echo site_url()?>';
         if (confirm('Are you sure you want to delete this manager?'))
         {
             $.post(url+'manager-delete',{user_id:user_id},function(view){
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
     $(document).on("click","#resetPass",function(){
         var email=$("#managerEdit #email").val();
         var name=$("#managerEdit #name").val();
         var manage_in_userid=$("#managerEdit #manage_in_userid").val();
         var toggleData=$("#managerEdit #toggleData").val();
         $("#toggleData").val(1);
         $(this).addClass("toggleButton");
         $(this).html("Your Admin account password has just been reset");
         var url='<?php echo site_url()?>';
         $.post(url+'manager-pass-reset',{email:email,name:name,manage_in_userid:manage_in_userid,toggleData:toggleData},function(view){
             if(view!=false)
             {
                 alert("Check this '"+email+"' address for the new password");
                 $("#newpass").val(view);
             }
             else
             {
                 alert("Password reset faield");
             }
         });
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
     $(document).on("click","#slideThree",function(){
         if ($(this).is(':checked'))
         {
             $(".passtr").hide();
             $("#password").val("");
             $("#repassword").val("");
         }
         else
         {
             $(".passtr").show();
         }
     });
     $(document).on("click",".btn-close",function(){
         window.location.href.substr(0, window.location.href.indexOf('#'))
     });

    // parent and sub check box checked
    function subAllCheckBox(section,parentChebox,submaindiv)
    {
        if($("#"+parentChebox).is(':checked'))
        {
            $("#"+section).find('.'+submaindiv).find("input[type=checkbox]").prop('checked',true);
        }
        else
        {
            $("#"+section).find('.'+submaindiv).find("input[type=checkbox]").prop('checked',false);
        }


    }

    $(document).on("click",".subcls",function(){
        var result=0;
        var parentid=$(this).attr('rel') ;

        $(this).closest('.subparentbox').find('.checkbox').each(function(){
            if($(this).find("input[type=checkbox]").is(':checked'))
            { result=1;}
        });

        if(result==1)
        {
            $("#"+parentid).prop('checked',true);
        }
        else
        {
            $("#"+parentid).prop('checked',false);
        }


    });


    $('#chkSelectAll').click(function () {
    var checked_status = this.checked;
    //   alert(checked_status);
    $('input[type=checkbox]:not(#slideThree)').each(function () {
        this.checked = checked_status;
    });
})
     $('input[name="chkSelectAll"]').click(function () {
         var checked_status = this.checked;
         //   alert(checked_status);
         $('input[type=checkbox]:not(#slideThree)').each(function () {
             this.checked = checked_status;
         });
     })

</script>