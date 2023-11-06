<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Forexmart ~ Monitoring Page of Copy Trading</title>
    <link href="<?= $this->template->Css()?>bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?= $this->template->Css()?>monitoring/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $this->template->Css()?>monitoring/animate.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $this->template->Css()?>monitoring/datepicker.css" type="text/css">
    <link rel="stylesheet" href="<?= $this->template->Css()?>monitoring/creative.css" type="text/css">
    <link rel="stylesheet" href="<?= $this->template->Css()?>monitoring/font-awesome.css" />
    <link rel="stylesheet" href="<?= $this->template->Css()?>monitoring/circle.css" />
</head>


<body id="page-top">

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="<?=FXPP::loc_url('monitoring')?>"> <img src="<?= $this->template->Images()?>monitoring/logo.png" class="logo"></a>
        </div>
    </div>
</nav>

<header2>
    <div class="header2-content">
    </div>
</header2>

<?=(isset($template['body']))?$template['body']: ''; ?>

<hr class="hr2">

<section id="contact" class="bottomlast">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">Let's Get In Touch!</h2>
                <hr class="primary">
                <p>Give us a call or send us an email and we will get back to you as soon as possible!</p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <i class="fa fa-phone fa-3x wow bounceIn"></i>
                <p>123-456-789</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                <p><a href="mailto:feedback@forexmart.com">feedback@forexmart.com</a></p>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="<?= $this->template->Js()?>monitoring/jquery.js"></script>
<script src="<?= $this->template->Js()?>monitoring/bootstrap.min.js"></script>
<script src="<?= $this->template->Js()?>monitoring/jquery.fittext.js"></script>
<script src="<?= $this->template->Js()?>monitoring/wow.min.js"></script>
<script src="<?= $this->template->Js()?>monitoring/bootstrap-datepicker.js"></script>
<script src="<?= $this->template->Js()?>monitoring/highcharts.js"></script>
<script src="<?= $this->template->Js()?>monitoring/exporting.js"></script>
<script src="<?= $this->template->Js()?>monitoring/jquery.easing.min.js"></script>
<script src="<?= $this->template->Js()?>monitoring/creative.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myTab a").click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
<script>
    if (top.location != location) {
        top.location.href = document.location.href ;
    }
    $(function(){
        window.prettyPrint && prettyPrint();
        $('#dp1').datepicker({
            format: 'mm-dd-yyyy'
        });
        $('#dp2').datepicker();
        $('#dp3').datepicker();
        $('#dp3').datepicker();
        $('#dpYears').datepicker();
        $('#dpMonths').datepicker();


        var startDate = new Date(2012,1,20);
        var endDate = new Date(2012,1,25);
        $('#dp4').datepicker()
            .on('changeDate', function(ev){
                if (ev.date.valueOf() > endDate.valueOf()){
                    $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                } else {
                    $('#alert').hide();
                    startDate = new Date(ev.date);
                    $('#startDate').text($('#dp4').data('date'));
                }
                $('#dp4').datepicker('hide');
            });
        $('#dp5').datepicker()
            .on('changeDate', function(ev){
                if (ev.date.valueOf() < startDate.valueOf()){
                    $('#alert').show().find('strong').text('The end date can not be less then the start date');
                } else {
                    $('#alert').hide();
                    endDate = new Date(ev.date);
                    $('#endDate').text($('#dp5').data('date'));
                }
                $('#dp5').datepicker('hide');
            });

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
            checkin.hide();
            $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout.hide();
        }).data('datepicker');
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerchart').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Balance & Equity'
            },

            xAxis: [{
                categories: ['2013-05-01',
                    '2013-09-01', '2014-05-01', '2014-09-01', '2015-01-01', '2015-05-01', '2015-09-01'],
                crosshair: true
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}k',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                },
                title: {
                    text: '',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                },
                opposite: true

            }, { // Secondary yAxis
                gridLineWidth: 0,
                title: {
                    text: '',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} k',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }

            }, { // Tertiary yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Margin',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                labels: {
                    format: '{value} k',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },

            series: [{
                name: 'Balance',
                type: 'line',
                yAxis: 1,
                data: [2.9, -2.5, 1.4, -3.2,-4.0, -7.0, -9.1],
                tooltip: {
                    valueSuffix: ' k'
                }

            }, {
                name: 'Equity',
                type: 'spline',
                yAxis: 2,
                data: [1.1, 1.6, 2.9, 1.5, 3.3, 2.5, 3.6],
                marker: {
                    enabled: true
                },
                dashStyle: 'shortdot',
                tooltip: {
                    valueSuffix: ' k'
                }

            }, {
                name: 'Profit',
                type: 'spline',
                data: [1.0, 2.4, 2.9, 2.5, 3.2, 1.2, 2.5],
                tooltip: {
                    valueSuffix: 'k'
                }
            }]
        });
    });


</script>
</body>

</html>
