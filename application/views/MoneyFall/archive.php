<?php $this->lang->load('datatable'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("head").append($("<link rel='stylesheet' href='<?= $this->template->Css() ?>archieve-view.css' type='text/css'  />"));
    });
</script>
<div class="reg-form-holder">
    <?php echo $contest_header ?>
    <div class="container" id="container_contest_archives">
        <h3 class="text-center">Contest Leaders</h3>
        <hr />
        <div class="table-responsive">
            <table  id="Contest_ArchivesTable" class=" table table-striped" >
                <thead>
                    <tr>
                        <!-- <th>
                        <?= lang('x_mf4'); ?>
                        </th>
                        <th>
                        <?= lang('AccountNumber'); ?>
                        </th>
                        <th>
                        <?= lang('x_mf1'); ?>
                        </th>
                        <th>
                        <?= lang('x_mf5'); ?>
                        </th>
                        <th>
                        <?= lang('x_mf3'); ?>
                        </th> -->
                        <th>
                            Account
                        </th>
                        <th>
                            Nickname
                        </th>
                        <th>
                            Balance
                        </th>
                        <!--<th>
                           Rank
                        </th> -->
                        <th>
                            Swap-free
                        </th>
                        <th>
                            Leverage
                        </th>
                        <th>
                            Date Test
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="week-pickers"></div>
    <div class="hori_center"><cite> <?= lang('x_mf13') ?></cite></div>
    <div class="container">
        <?php echo $registration_link ?>
    </div>
</div>
<?= $this->load->ext_view('modal', 'preloader', '', TRUE); ?>

<script>
    (function ($) {
        var $calroot;
        function selectCurrentWeek() {
            window.setTimeout(function () {
                var t = $calroot.find('.ui-datepicker-current-day a');//.addClass('ui-state-active');
                t = t.closest('tr');
                t.find('td>a').addClass('ui-state-active');//.parent().addClass('ui-state-active');
            }, 1);
        }
        function onSelect(dateText, inst) {
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $calroot.trigger('weekselected', {
                start: startDate,
                end: endDate,
                weekOf: startDate
            });
            selectCurrentWeek();
        }
        var reqOpt = {
            onSelect: onSelect,
            showOtherMonths: true,
            selectOtherMonths: true
        };
        $.fn.weekpicker = function (options) {
            var $this = this;
            $calroot = $this;
            $this.datepicker(reqOpsearch_Contest_Archive);
            //events
            $dprow = $this.find('.ui-datepicker');
            $dprow.on('mousemove', 'tr', function () {
                $(this).find('td a').addClass('ui-state-hover');
            });
            $dprow.on('mouseleave', 'tr', function () {
                $(this).find('td a').removeClass('ui-state-hover');
            });
        };
    })(jQuery);
</script>
<script type='text/javascript'>
    $(document).on('click', '#PublicRatings', function (e) {
        $('#PublicRatings a').addClass('active');
        $('#PublicContest_Archives a').removeClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicContest_Archives', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicContest_Archives a').addClass('active');
        $('#PublicContestRules a').removeClass('active');
    });
    $(document).on('click', '#PublicContestRules', function (e) {
        $('#PublicRatings a').removeClass('active');
        $('#PublicContest_Archives a').removeClass('active');
        $('#PublicContestRules a').addClass('active');
    });

    var site_url = "<?= FXPP::ajax_url('') ?>";
    var table;
    $(document).ready(function () {
        $('html, body').animate({
            scrollTop: $('#container_contest_archives').offset().top - 200
        }, 500);
        table = $('#Contest_ArchivesTable').on('preXhr.dt', function (e, settings, data) {
            console.log(e);
            console.log(settings);
            console.log(data);
            jQuery('#loader-holder').show();
        }).on('xhr.dt', function (e, settings, json, xhr) {
            jQuery('#loader-holder').hide();
        }).DataTable({
            "processing": false,
            "serverSide": true,
            "bFilter": true,
            "bSort": false,
            "ajax": {
                "url": site_url + "contest/search_Contest_Archive",
                "type": "POST",
                "data": function (d) {
                    d.search_by = $('select[name=SearchBy]').val();
                    d.search_from = $('#searchfrom').val();
                    d.search_key = $('#searchkey').val();
                    console.log(d.search_by);
                    console.log(d.search_from);
                    console.log(d.search_key);
                }
            },
            language: {
                search: "<?= lang('search'); ?>:",
                lengthMenu: "<?= lang('show_entries'); ?>"
            }
        });



        var filter_html = '<div><label><?= lang('search') ?>:<select name="SearchBy" id="searchby" class="form-control round-0"><option value="0" selected="selected">By contest week</option><option value="1">By account number</option></select>'; // <option value="2">By nickname</option>
        filter_html += '<input type="text" id="searchkey" style="display:none" name="searchkey" class="form-control required input-adjust-accoringly" />';
        filter_html += '<div id="contest_dates_range" style="display: inline"><input type="text" id="searchfrom" name="searchfrom" class="form-control required input-adjust-accoringly week-picker" value="<?php echo $contest_date_start . '-' . $contest_date_end ?>"/>';
        //filter_html += ' <?//=lang('to')?>// <input type="text" id="searchto" name="searchto" class="form-control required input-adjust-accoringly week-picker" />';
        filter_html += '</div></label></div>';
        $('#Contest_ArchivesTable_filter').html(filter_html);
        $('#Contest_ArchivesTable_filter').parent('div').attr('class', 'col-sm-8');
        $('#Contest_ArchivesTable_length').parent('div').attr('class', 'col-sm-4');


        //$('.week-picker').datePicker({selectWeek:true,closeOnSelect:false});
        var startDate;
        var endDate;

        function selectCurrentWeek() {
            window.setTimeout(function () {
                var t = $('.week-picker').find('.ui-datepicker-current-day a');//.addClass('ui-state-active');
                t = t.closest('tr');
                t.find('td>a').addClass('ui-state-active');//.parent().addClass('ui-state-active');
            }, 1);
        }

        $('.week-picker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            onSelect: function (dateText, inst) {
                var date = $(this).datepicker('getDate');
                startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 1);
                endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 5);
                var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                $(this).val($.datepicker.formatDate(dateFormat, startDate, inst.settings) + '-' + $.datepicker.formatDate(dateFormat, endDate, inst.settings));
                var column = $('#searchby').val();
                var key1 = $('#searchfrom').val();
                //var key2 = $('#searchto').val();
                if (column == 0 && key1) {
                    table.draw();
                }
                selectCurrentWeek();
            },
            beforeShowDay: function (date) {
                var cssClass = '';
                if (date >= startDate && date <= endDate)
                    cssClass = 'ui-datepicker-current-day';
                if (date.getDay() != 0 && date.getDay() != 6) {
                    return [true, cssClass];
                } else {
                    return [false, null];
                }
            },
            onChangeMonthYear: function (year, month, inst) {
                selectCurrentWeek();
            }
        });
        //$dprow = $(this).find('.ui-datepicker');
        //$('select[name=SearchBy]').select2();
    });


    $(document).on('mousemove', '.ui-datepicker .ui-datepicker-calendar tr', function () {
        $(this).find('td a').addClass('ui-state-hover');
    });
    $(document).on('mouseleave', '.ui-datepicker .ui-datepicker-calendar tr', function () {
        $(this).find('td a').removeClass('ui-state-hover');
    });

    $(document).on("change", "#searchby", function (e) {
        var column = $('#searchby').val();
        if (column == 0) {
            $('#searchkey').val('');
            $('#contest_dates_range').show();
            $('#searchkey').hide();
        } else {
            $('#searchfrom').val('');
            $('#searchto').val('');
            $('#contest_dates_range').hide();
            $('#searchkey').show();
        }
        table.draw();
    });

    $(document).on('keyup', '#searchkey', function () {
        var column = $('#searchby').val();
        var key = $(this).val();
        if (column != 0) {
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


