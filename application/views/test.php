<?php $this->lang->load('calendar');?>

<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>view-test.css' type='text/css'  />"));
    });
</script>

<?php if( !empty( $calendarList ) ){ ?>
    <?php
    foreach( $calendarList as $calendar ) : ?>
        <?php

        $day = date( "l", strtotime( $calendar[0]['ReleaseDate'] ) );
        $date = date( "d", strtotime( $calendar[0]['ReleaseDate'] ) );
        $year = date( "Y", strtotime( $calendar[0]['ReleaseDate'] ) );
        $mo = date( "F", strtotime( $calendar[0]['ReleaseDate'] ) );
        switch($day){
            case 'Monday':$day = lang('monday');break;
            case 'Tuesday':$day = lang('tuesday');break;
            case 'Wednesday':$day = lang('wednesday');break;
            case 'Thursday':$day = lang('thursday');break;
            case 'Friday':$day = lang('friday');break;
            case 'Saturday':$day = lang('saturday');break;
            case 'Sunday':$day = lang('sunday');break;
        }
        switch($mo){
            case 'January':$mo=lang('jan');break;
            case 'February':$mo=lang('feb');break;
            case 'March':$mo=lang('mar');break;
            case 'April':$mo=lang('apr');break;
            case 'May':$mo=lang('may');break;
            case 'June':$mo=lang('jun');break;
            case 'July':$mo=lang('jul');break;
            case 'August':$mo=lang('aug');break;
            case 'September':$mo=lang('Sep');break;
            case 'October':$mo=lang('oct');break;
            case 'November':$mo=lang('nov');break;
            case 'December':$mo=lang('dec');break;
        }
        $disp_date= $day.', '.$date.' '.$mo.' '.$year;
        ?>

        <table class="table table-stripped calendar-tab table-hover" id="tbl_calendarEvents">
            <thead>
            <tr>
                <td colspan="7" class="ec-date"><?php echo $disp_date;?></td>
            </tr>
            <tr>
                <th class="ec-time" style="width: 10%;" id="tbl_th_1"><?=lang('tbl_th_1');?></th>
                <th class="ec-cur" style="width: 10%;" id="tbl_th_2"><?=lang('tbl_th_2');?></th>
                <th class="ec-imp" style="width: 10%;" id="tbl_th_3"><?=lang('tbl_th_3');?></th>
                <th class="ec-events" style="width: 40%;" id="tbl_th_4"><?=lang('tbl_th_4');?></th>
                <th class="ec-actual" style="width: 10%;" id="tbl_th_5"><?=lang('cal_14');?></th>
                <th class="ec-forecast" style="width: 10%;" id="tbl_th_6"><?=lang('cal_15');?></th>
                <th class="ec-prev" style="width: 10%;text-align: right;padding-right: 40px;" id="tbl_th_7"><?=lang('cal_16');?></th>
            </tr>

            </thead>
            <tbody>

            <?php foreach( $calendar as $eventItem ) : ?>
                <?php
                switch($eventItem['Importance']){
                    case 'Low':
                        $barType = 'low';
                        $barClass = 'low';
                        break;
                    case 'Medium':
                        $barType = 'moderate';
                        $barClass = 'warning';
                        break;
                    case 'High':
                        $barType = 'high';
                        $barClass = 'danger';
                }
                ?>

                <tr class="<?php echo $eventItem['Country'];?>">
                    <td><?php echo date( "H:i", strtotime( $eventItem["ReleaseDate"] ) ); ?></td>

                    <?php
                    switch($eventItem['Country']){
                        case 'uk':
                            $flag = 'gb';
                            break;
                        case 'ja':
                            $flag = 'jp';
                            break;
                        default:
                            $flag = $eventItem['Country'];
                            break;
                    }
                    ?>
                    <td class="f32"><i class="flag <?php echo $flag;?>"></i></td>

                    <td>
                        <div class="progress calendar-progress">
                            <div class="progress-bar progress-bar-<?php echo $barClass; ?> <?php echo $barType;?>" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">

                            </div>
                        </div>
                    </td>
                    <td><a href='javascript:' class='show-description' id='<?php echo $eventItem['Id'];?>'>
                            <?php echo $eventItem['Name'];?> </a></td>
                    <td><?php echo $eventItem['Actual']=$eventItem['Actual']!=''?$eventItem['Actual']:'-'; ?></td>
                    <td><?php echo $eventItem['Forecast']=$eventItem['Forecast']!=''?$eventItem['Forecast']:'-';  ?></td>
                    <td style="padding-right: 40px;text-align: right;"><?php echo $eventItem['Previous']=$eventItem['Previous']!=''?$eventItem['Previous']:'-'; ?></td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
<?php }else{ ?>
    <div style="width: 100%;background: #efeeee;text-align: center;font-size: 16px;padding: 10px;margin-bottom: 10px;"><?=lang('no_data');?></div>
<?php } ?>

<script>
    // $(function () {
    //     $('#datetimepicker').datepicker();
    //     $('#t6').datepicker();
    // });
    var site_url="<?=site_url('')?>";
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
                   // console.log(response.qrylst);
                    $('#event-description').html(description);
                    $('#event-flag').addClass(flag);

                    $('#event-importance').removeClass();
                    $('#event-importance').addClass('progress-bar progress-bar-'+importance);

                    $('#event').modal();
                }
            });

        });

        $('#t6').datepicker().on('changeDate', function(){
            console.log("calendar on change date");
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

            console.log('1');
            $.ajax({
                url: '<?=FXPP::ajax_url('calendar/getCalendarEvents');?>',
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
             console.log('2');
             $.ajax({
                url: '<?=FXPP::ajax_url('calendar/getCalendarEvents');?>',
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
            console.log('testing ' +$("input:checkbox[name=importance]:checked").val());

            $("#loader-holder").show();
            $("#filter-alert").hide();

            var arrayImportance = new Array();
            $("input:checkbox[name=importance]:checked").each(function(){
                arrayImportance.push($(this).val());
            });
            console.log('mid1');
            var arrayCountry = new Array();
            $("input:checkbox[name=country]:checked").each(function(){
                arrayCountry.push($(this).val());
            });

            console.log('mid2');
            if(arrayImportance.length == 0 && arrayCountry.length == 0){
                $("#filter-alert").show();
                $("#loader-holder").hide();

            }
            else{
                $("#filter-alert").hide();
                var getTimeZone = $('.dropdown-menu li.selected').attr('id');
                console.log($('#t6').data('datepicker'));
                console.log('test date');
               // console.log($('#t6').data('datepicker').getFormattedDate('yyyy-mm-dd'));
                //$datecreated=DateTime::createFromFormat('Y-m-d H:i:s',$data['datecreated']);
                var datepicked = $('#t6').data('datepicker');
                console.log('3');

                var urlx="<?=FXPP::ajax_url('calendar/getCalendarEvents')?>";
                var xid=$('.queue-tab-list .active').attr('id');
                xid=xid.toString();
                arrayImportance=arrayImportance.toString();
                arrayCountry=arrayCountry.toString();
                getTimeZone=getTimeZone.toString();
                datepicked=datepicked.toString();


//                $.post("https://www.forexmart.com/calendar/getCalendarEvents",{
//
//                    tab: xid,
//                    importance:arrayImportance,
//                    country: arrayCountry,
//                    time:getTimeZone,
//                    selectedDate: datepicked
//
//                },function(view){
//                    console.log("text ajax ");
//                });
//
//                return false;


                $.ajax({
                    url: urlx,
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
                        console.log('test ajax step');
                       // console.log(response);
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

            console.log('4');
            $.ajax({
                url: '<?=FXPP::ajax_url('calendar/getCalendarEvents');?>',
                //url: '/calendar/getCalendarEvents',
                type: "POST",
                data: {
                    tab: $('.queue-tab-list .active').attr('id'),
                    importance: arrayImportance,
                    country: arrayCountry,
                    time: getTimeZone,
                    language: '<?=FXPP::html_url();?>'
                    //,tbl: th1
                },
                dataType: 'json',
                showLoader: true,
                success: function(response){
                    $("#loader-holder").hide();
//                        var tbldata = response.lang_data;
//                        console.log('test '+tbldata.th1);
//                        $('th#tbl_th_1').html(tbldata.th1);
                    //  document.getElementById("tbl_th_1").innerHTML =tbldata.th1;
                    //  person.firstName + " " + person.lastName;
                    $('div#calendarList-holder').html(response.calendarList);
                }
            });
        });
    });
</script>