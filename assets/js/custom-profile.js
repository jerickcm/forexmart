function readInput(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            jQuery('#avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

jQuery(document).ready(function(){

    var base_url = $('#base_url').val();

    jQuery("#fileupload").change(function() {
        var filename = jQuery(this).val().replace(/C:\\fakepath\\/i, '');
        jQuery("#profileAvatar").val(filename);
        readInput(this);
    });

    jQuery("#remove_avatar").click(function(event){
        event.preventDefault();
        jQuery("#fileupload").val('');
        jQuery("#profileAvatar").val('');
        jQuery('#avatar').attr('src', jQuery('#no-image').val());
    });

    jQuery("#frmProfile").on('submit',(function(event) {
        event.preventDefault();
        jQuery('.col-alert').html('<div class="alert alert-info" style="opacity: 1;font-size: 12px; padding: 10px;margin: 20px 0px;">Updating profile...</div>');
        jQuery('.error').hide();
        jQuery.ajax({
            type: 'POST',
            url: base_url+'profile/updateProfile',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(x) {
                if(x.success){
                    console.log(x);
                    jQuery('.col-alert').html('<div class="alert alert-success" style="opacity: 1;font-size: 12px; padding: 10px;margin: 20px 0px;">' + x.error + '</div>');
                }else{
                    if(x.validation_error) {
                        jQuery('.col-alert').html('<div class="alert alert-danger" style="opacity: 1;font-size: 12px; padding: 10px;margin: 20px 0px;">' + x.error + '</div>');
                    }else{
                        jQuery('.col-alert').html('<div class="alert alert-danger" style="opacity: 1;font-size: 12px; padding: 10px;margin: 20px 0px;">Invalid input.</div>');
                        for( var item in x.error ){

                            if(x.error[item] != ''){
                                console.log(item);
                                jQuery('.' + item + '-error').html(x.error[item]);
                                jQuery('.' + item + '-error').show();
                            }
                        }
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                jQuery('.col-alert').html('');
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }));
});


