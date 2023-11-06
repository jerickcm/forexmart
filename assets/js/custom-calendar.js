
$(document).ready( function () {

    $('body').on('click', 'a.show-description', function(){
        var id = $(this).attr('id');
        $("#loader-holder").show();
        $.ajax({
            url: '/calendar/getCalendarEventDetails',
            type: "POST",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response){

                $("#loader-holder").hide();

                var description = response.Description,
                    actual = response.Actual,
                    forecast = response.Forecast,
                    releasedate = response.ReleaseTimestamp,
                    flag = response.Flag,
                    importance = response.Importance,
                    name = response.Name,
                    previous = response.Previous;

                $('#event-title').html(name);
                $('#event-latest-release').html(releasedate);
                $('#event-actual').html(actual);
                $('#event-forecast').html(forecast);
                $('#event-previous').html(previous);
                $('#event-description').html(description);
                $('#event-flag').addClass(flag);

                $('#event-importance').removeClass();
                $('#event-importance').addClass('progress-bar progress-bar-'+importance);

                $('#event').modal();
            }
        });

    });

    $('#t6').datepicker().on('changeDate', function(){

        $("#loader-holder").show();

        var datepicked = $('#t6').data('datepicker').getFormattedDate('yyyy-mm-dd');
        $('#t6').datepicker('hide');

        var arrayImportance = new Array();
        $("input:checkbox[name=importance]:checked").each(function(){
            arrayImportance.push($(this).val());
        });

        var arrayCountry = new Array();
        $("input:checkbox[name=country]:checked").each(function(){
            arrayCountry.push($(this).val());
        });

        var getTimeZone = $('.dropdown-menu li.selected').attr('id');

        $.ajax({
            url: '/calendar/getCalendarEvents',
            type: "POST",
            data: {
                tab: $('.queue-tab-list .active').attr('id'),
                importance: arrayImportance,
                country: arrayCountry,
                time: getTimeZone,
                selectedDate: datepicked
            },
            dataType: 'json',
            success: function(response){

                $("#loader-holder").hide();

                $('input:checkbox').removeAttr('checked');
                $('div#calendarList-holder').html(response.calendarList);
            }
        });

    });

    $('.dropdown-menu li').click(function(){

        $("#loader-holder").show();

        var gmt = $(this).html();
        $('span#gmt-timezone').html(gmt);
        $('input#gmt-time').val(this.id);

        var arrayImportance = new Array();
        $("input:checkbox[name=importance]:checked").each(function(){
            arrayImportance.push($(this).val());
        });

        var arrayCountry = new Array();
        $("input:checkbox[name=country]:checked").each(function(){
            arrayCountry.push($(this).val());
        });

        var datepicked = $('#t6').data('datepicker').getFormattedDate('yyyy-mm-dd');

        $.ajax({
            url: '/calendar/getCalendarEvents',
            type: "POST",
            data: {
                tab: $('.queue-tab-list .active').attr('id'),
                importance: arrayImportance,
                country: arrayCountry,
                time: this.id,
                selectedDate: datepicked
            },
            dataType: 'json',
            showLoader: true,
            success: function(response){

                $("#loader-holder").hide();

                $('div#calendarList-holder').html(response.calendarList);
            }
        });

    });

    $('body').on('click', '#filter-calendar', function(){

        $("#loader-holder").show();
        $("#filter-alert").hide();

        var arrayImportance = new Array();
        $("input:checkbox[name=importance]:checked").each(function(){
            arrayImportance.push($(this).val());
        });

        var arrayCountry = new Array();
        $("input:checkbox[name=country]:checked").each(function(){
            arrayCountry.push($(this).val());
        });


        if(arrayImportance.length == 0 && arrayCountry.length == 0){
            $("#filter-alert").show();
            $("#loader-holder").hide();

        }
        else{
            $("#filter-alert").hide();
            var getTimeZone = $('.dropdown-menu li.selected').attr('id');
            var datepicked = $('#t6').data('datepicker').getFormattedDate('yyyy-mm-dd');

            $.ajax({
                url: '/calendar/getCalendarEvents',
                type: "POST",
                data: {
                    tab: $('.queue-tab-list .active').attr('id'),
                    importance: arrayImportance,
                    country: arrayCountry,
                    time: getTimeZone,
                    selectedDate: datepicked
                },
                dataType: 'json',
                success: function(response){

                    $("#loader-holder").hide();

                    $('input:checkbox').removeAttr('checked');
                    $('#esFilter').modal('hide');
                    $('div#calendarList-holder').html(response.calendarList);
                }
            });
        }
    });

    $('a.test[data-toggle="tab"]').on('shown.bs.tab', function(e){

        $("#loader-holder").show();

        var arrayImportance = new Array();
        $("input:checkbox[name=importance]:checked").each(function(){
            arrayImportance.push($(this).val());
        });

        var arrayCountry = new Array();
        $("input:checkbox[name=country]:checked").each(function(){
            arrayCountry.push($(this).val());
        });

        var getTimeZone = $('.dropdown-menu li.selected').attr('id');

        $.ajax({
            url: '/calendar/getCalendarEvents',
            type: "POST",
            data: {
                tab: $('.queue-tab-list .active').attr('id'),
                importance: arrayImportance,
                country: arrayCountry,
                time: getTimeZone
            },
            dataType: 'json',
            showLoader: true,
            success: function(response){

                $("#loader-holder").hide();

                $('div#calendarList-holder').html(response.calendarList);
            }
        });
    });


});