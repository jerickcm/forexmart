
    <script type="text/javascript">
        var site_url="<?=FXPP::loc_url('')?>";
        $('form').submit(function(e) {
            e.preventDefault();
            e.returnValue = false;
            var $form = $(this);

            var site_url="<?=FXPP::loc_url('')?>";
            var pblc = [];
            pblc['request'] = null;
            var prvt = [];

            prvt["data"] = {
                login_type:0,
                fullname:$('input[name=full_name]').val(),
                email: $('input[name=email]').val()
            };

            $('#loader-holder').show();
            pblc['request'] = $.ajax({
                dataType: 'json',
//                url: site_url+"query/check_15reg_24hrs",
                url: "<?=FXPP::ajax_url('query/check_15reg_24hrs')?>",
                method: 'POST',
                data: prvt["data"]
            });

            pblc['request'].done(function( data ) {
                $('#loader-holder').hide();
                if (data.return){ //no. registration > 15
                    $('.prompt_reg').removeClass('togglealert');
                }else{
                    $form.off('submit');
                    $form.submit();
                }
            });

            pblc['request'].fail(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
                $form.off('submit');
                $form.submit();
            });

            pblc['request'].always(function( jqXHR, textStatus ) {
                $('#loader-holder').hide();
                // make sure that you are no longer handling the submit event; clear handler
//                    this.off('submit');
                // actually submit the form
//                    this.submit();
            });

        });
    </script>

