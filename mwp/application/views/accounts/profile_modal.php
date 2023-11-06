

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Account Number: <span id="modalAccountNumber"> <?=$LogIn?></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" id="demoAccountDetails">
                        <input type="hidden" name="account_number" id="accountNumber" value=" <?=$LogIn?>" />
                        <input type="hidden" name="account_id" id="accountID" value=" <?=$LogIn?>" />
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Personal Details</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email <cite class="req">*</cite></label>
                                <div class="col-sm-9">

                                    <input class="form-control round-0" placeholder="Email" type="text" id="email" value="<?=$Email?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name <cite class="req">*</cite></label>
                                <div class="col-sm-9">

                                    <input class="form-control round-0" placeholder="First Name, Last Name" type="text" id="name" value="<?=$Name?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Country <cite class="req">*</cite></label>
                                <div class="col-sm-9">

                                    <select id="country" class="form-control round-0">
                                        <?php echo $countries;?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">City <cite class="req">*</cite></label>
                                <div class="col-sm-9">
                                    <input class="form-control round-0" type="text" id="city" value="<?=$City?>">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State <cite class="req">*</cite></label>
                                <div class="col-sm-9">


                                    <input class="form-control round-0" type="text" id="state" value="<?=$State?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Zip code <cite class="req">*</cite></label>
                                <div class="col-sm-9">

                                    <input  class="form-control round-0" type="text" id="zip_code" value="<?=$ZipCode?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Address <cite class="req">*</cite></label>
                                <div class="col-sm-9">

                                    <input  class="form-control round-0" type="text" id="address" value="<?=$Address?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number</label>
                                <div class="col-sm-9">

                                    <input class="form-control round-0" placeholder="Phone Number" type="text" id="phone_number" value="<?=$PhoneNumber?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="col-sm-12 text-center"><strong>Trading Account Settings</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Type <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="account_type" class="form-control round-0" readonly="readonly" Value="<?=$mt_account_set_id?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Account Currency Base <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="currency_base" class="form-control round-0" readonly="readonly" Value="<?=$currency_base?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Leverage <cite class="req">*</cite></label>
                                <div class="col-sm-8">

                                    <select class="form-control round-0 required" id="leverage">
                                        <?php echo $leverages;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Group <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="amount" class="form-control round-0" readonly="readonly" Value="<?=$Group?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Allow to change password <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="amount" class="form-control round-0" readonly="readonly" Value="<?=$IsEnable?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Read only(without trading) <cite class="req">*</cite></label>
                                <div class="col-sm-8">
                                    <input type="text" name="amount" class="form-control round-0" readonly="readonly" Value="<?=$IsReadOnly?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="center-block">
                    <a href="Javascript:" id="update" class="btn-save">Save Changes</a> <span id="msg"></span>
                </div>
            </div>
        </div>
    </div>
    <style>
        .personal .txt-label{text-align: right; float: left; width: 136px;}
        .personal label input{float: left;}
        .personal label{text-align: left!important; float: left; width: 200px;}
        #msg{ color: #008000;}
        select{width: 172px;}
    </style>
    <script>

        $(document).on("click","#update",function(){

            $("#loader-holder").show();
            var base_url = "<?php echo FXPP::ajax_url('quick_jump/update_live_account') ?>";

            var account_number = "<?=$LogIn?>";
            var name = $("#name").val();
            var email = $("#email").val();
            var phone_number = $("#phone_number").val();
            var city = $("#city").val();
            var country = $("#country").val();
            var state   = $("#state").val();
            var street  = $("#street").val();
            var address = $("#address").val();
            var zip_code = $("#zip_code").val();
            var leverage =$("#leverage").val();
            var comment = $("#comment").val();


            $.post(base_url,{comment:comment,account_number:account_number,name:name,email:email,phone_number:phone_number,city:city,country:country,state:state,street:street,address:address,zip_code:zip_code,leverage:leverage},function(data){
                $("#msg").html(data.message);
                $("#loader-holder").hide();
                setTimeout(function(){
                    $("#msg").hide();
                },5000);


            })



        })
    </script>
