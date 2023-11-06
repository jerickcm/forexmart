$(document).ready(function(){
    $('#affiliate_partn_registration').find("input[type=text], textarea").val("");
    $('#affiliate_partn_registration').find("input[type=email], textarea").val("");
    $("#status_type option:selected").prop("selected", false);
    $("#target_country option:selected").prop("selected",false);

    //$('#phone_number').intlTelInput({
    //    defaultCountry: countryAbbr,
    //    utilsScript: URL + "data/js/utils.js"
    //});

    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:'yy-mm-dd',
        yearRange: "-95:+0"
    });


    $('form#affiliate_partn_registration').on('click', '#addWebsite', function(){
        var addWebsiteLi = '<li><div class="input-group ig margin-ref"><input type="text" placeholder="Website" class="form-control round-0" name="websites[]"/><div class="input-group-addon round-0"><a id="removeWebsite"><i class="fa fa-minus"></i></a></div></div></li>';
        $('ul#ulwebname').append(addWebsiteLi);
    });

    $('form#affiliate_partn_registration').on('click', 'a#removeWebsite', function(){
        $(this).closest('li').remove();
    });


    $('form#affiliate_partn_registration').on("focus",'input, select, textarea',function(){
        $(this).parent('div').find('div.error_p').html('');
        $(this).removeClass('red-border');
    });




    $('form#affiliate_partn_registration').on('click', '#btn-complete-reg', function(){

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

            if('' == $(this).val()){
                if($(this).attr('name') != "websites[]"){
                    submit = false;
                    errors.push(this.name);
                }
            }

        });

        $("input.inp-company-field").each(function(){
            if($('#status_type').val() > 0){
                if('' == $(this).val()){
                    submit = false;
                    errors.push(this.name);
                }
            }
        });
       // $("#affiliate_partn_registration").resetForm();
        if(submit){
            if($("#agree-checkbox").is(':checked')){

                $('#affiliate_partn_registration').submit();


            }else{
                alert(" You must agree with the Terms of Service. ");
            }
        }else{
            for(error in errors){
                switch (errors[error]){
                    case 'invalid-email':
                        jQuery( "#error_email").html( "<p>Invalid email.</p>" );
                        jQuery("input#email").addClass('red-border');
                        break;
                    case 'affiliate_type':
                        jQuery( "#error_"+errors[error]).html( "<p>Affiliate type field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'fullname':
                        jQuery( "#error_"+errors[error]).html( "<p>Full name field is required.</p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'email':
                        jQuery( "#error_"+errors[error]).html( "<p>Please provide your email.</p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'phone_number':
                        jQuery( "#error_"+errors[error]).html( "<p>Phone number field is required.</p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'country':
                        jQuery( "#error_"+errors[error]).html( "<p>Country field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'target_country':
                        jQuery( "#error_"+errors[error]).html( "<p>Target Country field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'status_type':
                        jQuery( "#error_"+errors[error]).html( "<p>Status field is required.</p>" );
                        jQuery("select#"+errors[error]).addClass('red-border');
                        break;
                    case 'company_name':
                        jQuery( "#error_"+errors[error]).html( "<p>Company name field is required.</p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'registration_number':
                        jQuery( "#error_"+errors[error]).html( "<p>Registration number field is required.</p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                    case 'date_of_inc':
                        jQuery( "#error_"+errors[error]).html( "<p>Date of Incorporation field is required.</p>" );
                        jQuery("input#"+errors[error]).addClass('red-border');
                        break;
                }
            }
        }

    });

    $('form#affiliate_partn_registration').on("change","#status_type",function(){
        var statustype = jQuery(this).val();
        if(statustype > 0){
            jQuery('.company-field').show();
        }else{
            jQuery('.company-field').hide();
        }
    });



    // $( '#affiliate_partn_registration' ).each(function(){
    //     this.reset();
    // });

    // $("#affiliate_partn_registration").click(function(e) {
    //      var url = jQuery('#url_base').val(); // the script where you handle the form input.
    //     //var baseurl = '<?php echo base_url();?>';
    //     //alert(url);
    //     $.ajax({
    //
    //         type: "POST",
    //        // url: baseurl+'affiliate_program/registration',
    //          url: url+'Affiliate_program/registration',
    //         data: {
    //
    //             affiliate:affiliate_type,status:status_type,name:fullname,email:email,phnum:phone_number,skype:skype,
    //             currency:currency,country:country,target_country:target_country,websites:websites,message:message,
    //             companyn:company_name,registrationn:registration_number,dateofinc:date_of_inc,userid:user_id,
    //             partnerid:partner_id,referencenu:reference_num, phonepass:phone_password, affiliateco:affiliate_code
    //         }, // serializes the form's elements.
    //         dataType: 'json',
    //         success: function(data)
    //         {
    //             //console.log(data);
    //             alert(data.a);
    //         }
    //     });
    //
    //     e.preventDefault(); // avoid to execute the actual submit of the form.
    // })

});






