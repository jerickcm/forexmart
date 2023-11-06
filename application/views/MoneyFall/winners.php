<?php $this->lang->load('datatable');?>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css()?>winners-view.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <?php echo $contest_header ?>
    <div class="container" id="container_winners">
            <h3 class="text-center"> <?=lang('winners');?></h3>
            <hr>
            <p>
                <?=lang('cmf_new_01_0');?><strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday this week")))->format(' F j, Y');?></strong>
                <?=lang('cmf_new_01_1');?>
                <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday this week")))->format(' F j, Y');?></strong>.
            </p>
            <p>
                <?=lang('cmf_new_01_2');?>
                <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("monday next week ")))->format(' F j, Y');?></strong>
                <?=lang('cmf_new_01_3');?>
                <strong><?=DateTime::createFromFormat('Y/d/m',  date('Y/d/m',strtotime("friday next week")))->format(' F j, Y');?></strong>
                <?=lang('cmf_new_01_4');?>.
            </p>
            <p><?=lang('cmf_new_02');?></p>
            <p><?=lang('cmf_new_03');?></p>
            <div class="table-responsive">
                <?php //w3c validator ask to not use name attribute in table  , cellspacing="0" removed and changed to css border-spacing: 10px; remove width and put also to css ?>
                <table  id="WinnersTable" class=" table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <?=lang('x_mf4');?>
                        </th>
                        <th>
                            <?=lang('AccountNumber');?>
                        </th>
                        <th>
                            <?=lang('x_mf1');?>

                        </th>
                        <th>
                            <?=lang('x_mf5');?>
                        </th>
                        <th>
                            <?=lang('x_mf3');?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
    </div>
    <div class="week-pickers"></div>

    <div class="container">
        <?php echo $registration_link ?>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js' ></script>
<script src='https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js' ></script>
<link href='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/css/select2.min.css' rel='stylesheet' />
<script src='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/js/select2.min.js'></script>
<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css'/>
<script>
    (function($){
        var $calroot;

        function selectCurrentWeek() {
            window.setTimeout(function () {
                var t = $calroot.find('.ui-datepicker-current-day a');//.addClass('ui-state-active');
                t= t.closest('tr');
                t.find('td>a').addClass('ui-state-active');//.parent().addClass('ui-state-active');
            }, 1);

        }
        function onSelect(dateText, inst) {
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $calroot.trigger('weekselected',{
                start:startDate,
                end:endDate,
                weekOf:startDate
            });
            selectCurrentWeek();
        }
        var reqOpt = {
            onSelect:onSelect,
            showOtherMonths: true,
            selectOtherMonths: true
        };
        $.fn.weekpicker = function(options){
            var $this = this;
            $calroot = $this;

            $this.datepicker(reqOpt);
            //events
            $dprow = $this.find('.ui-datepicker');

            $dprow.on('mousemove','tr', function() {
                $(this).find('td a').addClass('ui-state-hover');
            });
            $dprow.on('mouseleave','tr', function() {
                $(this).find('td a').removeClass('ui-state-hover');
            });
        };
    })(jQuery);
</script>
<script type='text/javascript'>
    $(document).on('click', '#PublicRatings', function (e) {
        $('#PublicRatings a').addClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicWinners', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').addClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicContestRules', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicWinners a').removeClass('active');
        $('#PublicContestRules a').addClass('active');
    });

    var site_url="<?=FXPP::ajax_url('')?>";
    var table;
    $(document).ready(function() {

        $('html, body').animate({
            scrollTop: $('#container_winners').offset().top - 200
        }, 500);

        table = $('#WinnersTable').on('preXhr.dt', function ( e, settings, data ) {
            jQuery('#loader-holder').show();
        }).on('xhr.dt', function ( e, settings, json, xhr ) {
            jQuery('#loader-holder').hide();
        }).DataTable({
            "processing": false,
            "serverSide": true,
            "bFilter": true,
            "bSort": true,
            "order": [[ 4, "desc" ]],
            "oLanguage": {
                "sInfo": "<?=lang('dta_tbl_02')?>",
                "sInfoEmpty":"<?=lang('dta_tbl_03')?>",
                "sEmptyTable":"<?=lang('dta_tbl_01')?>",
                "sLengthMenu":"<?=lang('dta_tbl_07')?>",
                "sSearch":"<?=lang('dta_tbl_10')?>",
                "oPaginate": {
                    "sPrevious": "<?=lang('dta_tbl_15')?>",
                    "sNext": "<?=lang('dta_tbl_14')?>",
                  },
            },
            "ajax": {
                "url": site_url+"contest/search_winners",
                "type": "POST",
                "data": function ( d ) {
                    d.search_by = $('select[name=SearchBy]').val();
                    d.search_from = $('#searchfrom').val();
//                    d.search_to = $('#searchto').val();
                    d.search_key = $('#searchkey').val();
                }
            },
        });

        var filter_html = '<div><label><?=lang('search')?>: <select name="SearchBy" id="searchby" class="form-control round-0"><option value="0" selected="selected"><?=lang('by_contest_week')?></option><option value="1"><?=lang('by_account_number')?></option><option value="2"><?=lang('by_nickname')?></option></select>';
        filter_html += '<input type="text" id="searchkey" style="display:none" name="searchkey" class="form-control required input-adjust-accoringly" />';
        filter_html += '<div id="contest_dates_range" style="display: inline"><input type="text" id="searchfrom" name="searchfrom" class="form-control required input-adjust-accoringly week-picker" value="<?php echo $contest_date_start . '-' . $contest_date_end ?>"/>';
//        filter_html += ' <?//=lang('to')?>// <input type="text" id="searchto" name="searchto" class="form-control required input-adjust-accoringly week-picker" />';
        filter_html += '</div></label></div>';

        $('#WinnersTable_filter').html(filter_html);
        $('#WinnersTable_filter').parent('div').attr('class', 'col-sm-8');
        $('#WinnersTable_length').parent('div').attr('class', 'col-sm-4');


//        $('.week-picker').datePicker({selectWeek:true,closeOnSelect:false});
        var startDate;
        var endDate;

        function selectCurrentWeek() {
            window.setTimeout(function () {
                var t = $('.week-picker').find('.ui-datepicker-current-day a');//.addClass('ui-state-active');
                t= t.closest('tr');
                t.find('td>a').addClass('ui-state-active');//.parent().addClass('ui-state-active');
            }, 1);
        }

        $('.week-picker').datepicker( {
            showOtherMonths: true,
            selectOtherMonths: true,
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 1);
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 5);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                $(this).val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + '-' + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                var column = $('#searchby').val();
                var key1 = $('#searchfrom').val();
                console.log(key1+' from value');
//                var key2 = $('#searchto').val();
                if( column == 0 && key1 ){
                    table.draw();
                }
                selectCurrentWeek();
            },
            beforeShowDay: function(date) {
                var cssClass = '';
                if(date >= startDate && date <= endDate)
                    cssClass = 'ui-datepicker-current-day';
                if(date.getDay() != 0 && date.getDay() != 6){
                    return [true, cssClass];
                }else{
                    return [false, null];
                }
            },
            onChangeMonthYear: function(year, month, inst) {
                selectCurrentWeek();
            }
        });
//        $dprow = $(this).find('.ui-datepicker');

//       $('select[name=SearchBy]').select2();
    });


    $(document).on('mousemove','.ui-datepicker .ui-datepicker-calendar tr', function() {
        $(this).find('td a').addClass('ui-state-hover');
    });
    $(document).on('mouseleave','.ui-datepicker .ui-datepicker-calendar tr', function() {
        $(this).find('td a').removeClass('ui-state-hover');
    });

    $(document).on("change", "#searchby", function (e) {
        var column = $('#searchby').val();
        if(column == 0) {
            $('#searchkey').val('');
            $('#contest_dates_range').show();
            $('#searchkey').hide();
        }else{
            $('#searchfrom').val('');
            $('#searchto').val('');
            $('#contest_dates_range').hide();
            $('#searchkey').show();
        }
        table.draw();
    });

    $(document).on('keyup', '#searchkey', function(){
        var column = $('#searchby').val();
        var key = $(this).val();
        if( column != 0){
            table.draw();
        }
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        var div1 = $('.div1'), div3 = $('.div3'), widescreen = $('.wide-screen'), mobscreen = $('.mob-screen');
        $(window).load(function () {
            var width = $(window).width();
            if (width <= 991 && width >= 768) {
                div1.addClass('col-sm-4');
                div1.removeClass('col-sm-3');
                div3.addClass('col-sm-6');
                div3.removeClass('col-sm-4');
                widescreen.hide();
                mobscreen.show();
            } else {
                widescreen.show();
                mobscreen.hide();
            }
        });
        $(window).resize(function () {
            var width = $(window).width();
            if (width <= 991 && width >= 768) {
                div1.addClass('col-sm-4');
                div1.removeClass('col-sm-3');
                div3.addClass('col-sm-6');
                div3.removeClass('col-sm-4');
                widescreen.hide();
                mobscreen.show();
            } else {
                div1.removeClass('col-sm-4');
                div1.addClass('col-sm-3');
                div3.removeClass('col-sm-6');
                div3.addClass('col-sm-4');
                widescreen.show();
                mobscreen.hide();
            }
        });
    });
</script>


