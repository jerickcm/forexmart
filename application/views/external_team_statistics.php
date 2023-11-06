<?php
	$js = $this->template->Js();
	$cs = $this->template->Css();
?>

<link rel="stylesheet" href="<?=$cs;?>email_tracker.css">
<link rel="stylesheet" href="<?=$cs;?>bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?=$cs;?>bootstrap-datetimepicker.css">

<script type='text/javascript' src='<?=$js;?>Moment.js'></script>
<script type='text/javascript' src='<?=$js;?>transition.js'></script>
<script type='text/javascript' src='<?=$js;?>bootstrap-datepicker.min.js'></script>
<script type='text/javascript' src='<?=$js;?>bootstrap-datetimepicker.min.js' ></script>
<script type='text/javascript' src='<?=$js;?>morris.min.js'></script>
<script type='text/javascript' src='<?=$js;?>raphael-min.js'></script>

<style type="text/css">
	body
	{
		padding: 0;
		margin: 0;
	}
	.clearfix
	{
		clear: both;
	}

	.page-wrap
	{
		width: 40%;
		margin: 40px auto;
	}
	.graphic-container
	{
		width: 100%;
		border: 1px solid #ddd;
	}
	.container-header-holder
	{
		background: #2988ca;
		color: #fff;

	}
	.container-header-holder h4
	{
		margin: 0;
		display: inline-block!important;
		font-weight: 400;
	}
	.graph-title
	{
		color: #fff;
		padding: 7px 10px;
		display: inline-block;
	}
	.graph-title:hover
	{
		text-decoration: none;
		background: #1c72ad;
		transition: all ease 0.3s;
	}
	.header-tools
	{
		margin: 0;
		padding: 0;
		float: right;
		list-style: none;
	}
	.header-tools li
	{
		float: left;
	}
	.header-tools li a
	{
		color: #fff;
		padding: 7px 10px;
		display: inline-block;
		transition: all ease 0.3s;
	}
	.header-tools li a:hover
	{
		background: #1c72ad;
		transition: all ease 0.3s;
	}
	.graph-holder
	{
		padding: 10px;
	}
	.graph-holder h2
	{
		margin: 0;
		font-family: Open Sans;
		text-decoration: center;
		font-weight: 400;
		color: #333;
		font-size: 15px;
		text-align: center;
	}
	.graph-holder .graph
	{
	}
	.graph-holder .graph p
	{
		display: table;
		height: 250px;
		vertical-align: middle;
		text-align: center;
		border: 1px solid #aaa;
		width: 100%;
	}
	.container-footer-holder
	{
		padding: 10px;
		background: #eee;
		border-top: 1px solid #ddd;
	}
	.text-form-control
	{
		border: 1px solid #ddd;
		width: 200px;
		padding: 5px 10px;
		margin-left: 7px;
		margin-right: 10px;
	}
    .bootstrap-datetimepicker-widget tr:hover {
        background-color: #808080;
    }
</style>
<div class="page-wrap">
	<div class="graphic-container">
		<div class="container-header-holder">
			<a href="#" class="graph-title"><h4><i class="fa fa-area-chart"></i> Team Statistics</h4></a>
			<ul class="header-tools">
				<li><a href="#"><i class="fa fa-expand"></i></a></li>
				<li><a href="#"><i class="fa fa-ellipsis-v"></i></a></li>
			</ul><div class="clearfix"></div>
		</div>
		<div class="graph-holder">
			<div id="samplegraph"></div>
		</div>
		<div class="container-footer-holder">
			<div class="footer-content">
				<div class="text-group">
					<div class="col-md-3">
						<div class="form-group">
							<label for="period">Period: </label>
							<select class="form-control input-sm" id="period" name="period">
								<option value="daily">Daily</option>
								<option value="weekly">Weekly</option>
								<option value="monthly">Monthly</option>
							</select>
						</div>
					</div>
                    <div class="col-md-4">
                        <label for="weekpicker">Date Selection: </label>
                        <div class="input-group" id="daily">
                            <input type="text" class="form-control input-sm" id="dailyDatePicker" required="required" placeholder="Select Date" />
                        </div>
                        <div class="input-group" id="weekly" style="display: none;">
                            <input type="text" class="form-control input-sm" id="weeklyDatePicker" required="required" placeholder="Select Date" />
                        </div>
                        <div class="input-group" id="monthly" style="display: none;">
                            <input type="text" class="form-control input-sm" id="monthlyDatePicker" required="required" placeholder="Select Date" />
                        </div>
                        <input type="hidden" id="date-selected" value="<?=$defaultDaily;?>"/>
                    </div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="team-sel">Team Selection:</label>
							<select class="form-control input-sm" id="team-sel">
								<option value="0">All</option>
								<option value="rpj">RPJ</option>
								<option value="HKM">HKM</option>
								<option value="las-palmas">Las Palmas</option>
								<!--<option value="calendar">Economic Calendar</option>-->
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<button class="btn btn-primary btnapply btn-sm" id="submit" style="margin-top: 25px;">Apply</button>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
		</div>
	</div>
</div>
<div id="loader-holder" class="loader-holder">
	<div class="loader">
		<div class="loader-inner ball-pulse">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	new Morris.Line({
		// ID of the element in which to draw the chart.
		element: 'samplegraph',
		// Chart data records -- each entry in this array corresponds to a point on
		// the chart.
		data: <?=$team_result;?>,
		// The name of the data record attribute that contains x-values.
		xkey: 'month',
		// A list of names of data record attributes that contain y-values.
		ykeys: ['value'],
		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['Total visit']
	});
</script>

<script type="text/javascript">

	$("#submit").click(function(){
		var base_url = '<?= base_url(); ?>';
		var title = $('#team-sel').val();
		var date = $('#weeklyDatePicker').val().split('-');
		var from =  $.trim(date[0]);
		var to = $.trim(date[1]);
        var value = $('#date-selected').val();
        var period = $('#period').val();
		var daily_input = $('#dailyDatePicker').val(),
			weekly_input = $('#weeklyDatePicker').val(),
			monthly_input = $('#monthlyDatePicker').val();

		if (weekly_input == '' && period == 'weekly') {
			alert('Please select date.');
		} else if (monthly_input == '' && period == 'monthly') {
			alert('Please select date.');
		} else if (daily_input == '' && period == 'daily') {
			alert('Please select date.');
		} else {
			$.ajax({
				url : 		base_url + 'pages/getSelection',
				type: 		'POST',
				dataType: 	'json',
				data: {
					title: 	title,
					from: 	from,
					to: 	to,
					value:  value,
					period: period
				},
				beforeSend:function(){
					$('#samplegraph').empty();
					$('#loader-holder').show();
				},
				success: function(response){
					console.log(response);
					$('#loader-holder').hide();
					new Morris.Line({
						element: 'samplegraph',
						data: response.output,
						xkey: 'month',
						ykeys: ['value'],
						labels: ['Total visit']
					});
				}
			});
		}
	});
</script>

<script type="text/javascript">
	var startDate;
	var endDate;

    $(document).ready(function(){
        $("#dailyDatePicker").datetimepicker({
            format: 'MM/DD/YYYY'
        });
        $("#weeklyDatePicker").datetimepicker({
            format: 'MM/DD/YYYY'
        });
        $("#monthlyDatePicker").datetimepicker({
            format: 'YYYY-MM',
            viewMode: 'months'
        });

        $('#dailyDatePicker').on('dp.change', function (e) {
            $('#date-selected').val($(this).val());
        });

        $('#weeklyDatePicker').on('dp.change', function (e) {
            var value = $(this).val();
			console.log(value);
            startDate = moment(value, "MM/DD/YYYY").day(0).format("MM/DD/YYYY");
            endDate =  moment(value, "MM/DD/YYYY").day(6).format("MM/DD/YYYY");
            $("#weeklyDatePicker").val(startDate + " - " + endDate);
            $('#date-selected').val(startDate + " - " + endDate);
        });

        $('#monthlyDatePicker').on('dp.change', function (e) {
            $('#date-selected').val($(this).val());
        });

        $('#period').on('change', function (e) {
            var value = $(this).val();

			$('#dailyDatePicker').val('');
			$('#weeklyDatePicker').val('');
			$('#monthlyDatePicker').val('');

            if (value == 'weekly') {
                $('#weekly').css('display','table');
                $('#daily').css('display','none');
                $('#monthly').css('display','none');
            } else if (value == 'monthly') {
                $('#monthly').css('display','table');
                $('#weekly').css('display','none');
                $('#daily').css('display','none');
            } else {
                $('#daily').css('display','table');
                $('#monthly').css('display','none');
                $('#weekly').css('display','none');
            }
        });
    });
</script>
