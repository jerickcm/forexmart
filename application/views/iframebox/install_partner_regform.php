<div class="IframeLoder" style=" display: none; z-index:2147483647;  background: #ccc none repeat scroll 0 0; height:100%; border: none; overflow: hidden; opacity: 0.8; position: absolute; text-align: center;    width: 100%;">
    <img  style="margin-top: 90%" src="<?= $this->template->Images()?>loder.GIF" width="36" height="36" alt="loading gif"/>
</div>

<style type="text/css">
    .reg-btn-holder button {
    background: #29a643;
    padding: 13px 30px;
    font-size: 17px;
    color: #fff;
    font-family: Open Sans;
    text-transform: uppercase;
    border: none;
}
</style>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
   <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>partner-web-reg.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <script src="<?= $this->template->Js()?>jquery.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<!-- <body style="overflow: hidden; background-image:url(<?= $this->template->Images()?>partner-website-bg.jpg); background-size:cover;"> -->
<body>    
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-centered">
                    <div class="partner-reg-form-holder" style="border: solid 2px;">
                    <img src="<?= $this->template->Images()?>fxlogonew.svg" alt="" class="form-logo">
                        <h2>Sign up for free.</h2>
                        <!-- alert for successful registration -->
                        <?php $usernamex1 = $this->session->flashdata("success");
                            if((isset($usernamex1)) || ( isset($success_partner)) ) { ?>
                            <div class="alert alert-success" style="text-align: center;">
                                <?php print_r($usernamex1);  ?>
                            </div>
                         <?php  } ?>

                        <!-- alert for username duplicate -->
                        <?php  $usernamex = $this->session->flashdata("userexists");
                        if(isset($usernamex)) { ?>
                        <div class="alert alert-danger" style="text-align: center;">
                            <?php print_r($usernamex);  ?>
                        </div>
                        <?php  } ?>

                        <!-- alert for max 15 accounts per day -->
                        <?php  $usernamex2 = $this->session->flashdata("limit");
                        if(isset($usernamex2)) { ?>
                        <div class="alert alert-danger" style="text-align: center;">
                            <?php print_r($usernamex2);  ?>
                        </div>
                        <?php  } ?>

                        <form action="https://www.forexmart.com/partnership/informers_registration_form" method="post" id="parreg_widget">
                                    <?php
                                             $this->session->flashdata("userexists");
                                    ?>
                            <input type="hidden" name="form_key" value="<?php echo $form['form_key'] ?>" />
                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" class="inp-first-val regtxt <?=(form_error('username') == '') ? '' : 'red-border';?>" value="<?php echo set_value('username');?>" id="username" name="username" placeholder="">
                                <div class="error_p" id="error_username" style="color: red"><?php echo form_error('username'); ?></div>
                            </div>
                            <div class="form-group">
                                <!-- <label>Password:</label> -->
                                <input type="hidden" class="regtxt" value="password" id="password" name="password" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" class="inp-first-val regtxt <?=(form_error('email') == '') ? '' : 'red-border';?>" value="<?php echo set_value('email');?>" id="email" name="email" placeholder="">
                                <div class="error_p" id="error_email" style="color: red"><?php echo form_error('email'); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Phone:</label>
                                <input type="hidden" name="phone_code" value="<?php echo $calling_code ?>" />
                                <input type="text" class="inp-first-val regtxt <?=(form_error('phone_number') == '') ? '' : 'red-border';?>" value="<?php echo $calling_code ?>" id="phone" name="phone" placeholder="">
                                <div class="error_p" id="error_phone" style="color: red"><?php echo form_error('phone'); ?></div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="agree-checkbox"> I accept the <a href=<?= $this->template->pdf().'PA/EN_ForexMartPartnershipAgreement.pdf'?> class="reg-link">terms & conditions</a>.
                                </label>
                            </div>
                            <div class="reg-btn-holder">
                               <button type="submit" class="btn-ref-complete" id="btn-complete-reg">Join Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    

    <script type="text/javascript">
        $( document ).ready( function () {
        });


        $("#phone").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        
        
    $('form#parreg_widget').on('click', '#btn-complete-reg', function(){

        var submit = true;
        var errors = new Array();
        var pattern = /^[\w.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/;

        $("input.inp-first-val, select.inp-first-val").each(function(){

            if( "email" == this.id ) {
                if( !this.value.match( pattern ) ) {
                    submit = false;
                    errors.push( "invalid-email" );
                }
            }

            if( "phone" == this.id ){
                if($(this).val().length < $('[name=phone_code]').val().length + 5){
                    submit = false;
                    errors.push(this.name);
                }
            }

            if( "username" == this.id ){
                if($(this).val().length < 1) {
                    submit = false;
                    errors.push("username");
                    console.log($(this).val().length);
                }
            }
        });

        
        if(submit){
            if($("#agree-checkbox").is(':checked')){
                $('#parreg_widget').submit();
            }else{
                alert(" You need to agree with the terms of Service. ");
            }
            

        }else{
            // for(error in errors){
            //     // console.log(errors[error]);
            //     switch (errors[error]){
            //         case 'invalid-email':
            //             $( "#error_email").html( "<p>Invalid email.</p>" );
            //             $("input#email").css('border-color','red');
            //             break;
            //         case 'username':
            //             $( "#error_username").html( "<p>Please enter username.</p>" );
            //             $("input#username").css('border-color','red');
            //             break;
            //         case 'phone':
            //             $( "#error_"+errors[error]).html( "<p>Please enter phone number.</p>" );
            //             $("input#"+errors[error]).css('border-color','red');
            //             break;
            //     }
            // }
        }

    });


    </script>
</body>    
</html>   
   
        