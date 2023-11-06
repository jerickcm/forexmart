    var page = 1;
    function check_page(page){
        console.log(page);
        if(page == 1){
            $('#bb-nav-first').prop( "disabled", true );
            $('#bb-nav-prev').prop( "disabled", true );
            $('#bb-nav-prev').css('disabled', 'disabled')
            console.log($('#bb-nav-prev').attr('disabled'));
        } else {
            $('#bb-nav-first').prop( "disabled", false );
            $('#bb-nav-prev').prop( "disabled", false );
            $('#bb-nav-prev').css('disabled', '')
        }
        if(page == 4){
            $('#bb-nav-last').prop( "disabled", true );
            $('#bb-nav-next').prop( "disabled", true );
        } else {
            $('#bb-nav-last').prop( "disabled", false );
            $('#bb-nav-next').prop( "disabled", false );
        }
    }

    $(document).ready(function () {
        check_page(page);

        $("#bb-nav-next").click(function () {
            if (page < 4)
                page++;
            check_page(page);
        });
        $("#bb-nav-prev").click(function () {
            if (page > 1)
                page--;
            check_page(page);
        });

        $("#bb-nav-first").click(function () {
            page = 1;
            check_page(page);
        });
        $("#bb-nav-last").click(function () {
            page = 4;
            check_page(page);
        });
    });