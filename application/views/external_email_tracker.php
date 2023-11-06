	<div class="container">
    	<section class="fm-section-wrapper">
	    	<div class="row">
	    		<div class="col-md-12 col-sm-12 col-xs-12 fm-table-form-container">
		    		<table class="table table-striped">
		    			<thead>
		    				<tr>
		    					<th>Mail Name</th>
		    					<th>No. of mail sent</th>
		    					<th>No. of mail opened</th>
		    					<th>Open Rate</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				<tr>
		    					<td>Mass Mailing</td>
		    					<td></td>
		    					<td></td>
		    					<td></td>
		    				</tr>
		    				<tr>
		    					<td>Periodic Mailing for Client</td>
		    					<td style="text-align: center"><?= $PeriodicClient_mailSent ?></td>
		    					<td style="text-align: center"><?= $PeriodicClient_mailOpened ?></td>
		    					<td style="text-align: center"><?= $PeriodicClient_mailOpenRate ?>%</td>
		    				</tr>
		    				<tr>
		    					<td>Periodic Mailing for Partner</td>
		    					<td style="text-align: center"><?= $PeriodicPartner_mailSent ?></td>
		    					<td style="text-align: center"><?= $PeriodicPartner_mailOpened ?></td>
		    					<td style="text-align: center"><?= $PeriodicPartner_mailOpenRate ?>%</td>
		    				</tr>
		    				<tr>
		    					<td>Trade Offer</td>
		    					<td></td>
		    					<td></td>
		    					<td></td>
		    				</tr>

		    			</tbody>
		    		</table>
	    		</div>
	    		<div class="col-md-12 col-sm-12 col-xs-12 fm-grp-chart-container">
	    			<h2>Percentage of Emails</h2>
	    			<div class="row">

	    				<div class="col-md-3 col-sm-6 col-xs-12">
	    					<div class="chart_container" id="pc_chart"></div> 	
	    				</div>	    			
	    				<div class="col-md-3 col-sm-6 col-xs-12">
	    					<div class="chart_container" id="pp_chart"></div> 
	    				</div>
	    			</div>
	                <div class="chart_container" id="sample_chart"></div> 		
	    		</div>
	    	</div>
    	</section>
    </div>

 <script type="text/javascript">
	   $(function () {
	   		//CHART FOR MASS MAILING
		    // Highcharts.chart('mm_chart', {
		    //     chart: {
		    //         plotBackgroundColor: null,
		    //         plotBorderWidth: null,
		    //         plotShadow: false,
		    //         type: 'pie'
		    //     },
		    //     tooltip: {
		    //         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    //     },
		    //      plotOptions: {
		    //         pie: {
		    //             allowPointSelect: true,
		    //             cursor: 'pointer',
		    //             dataLabels: {
		    //                 enabled: false
		    //             },
		    //             showInLegend: true
		    //         }
		    //     },
		    //     series: [{
		    //         name: 'Brands',
		    //         colorByPoint: true,
		    //         data: [{
		    //             name: 'No. of Mail Sent ',
		    //             y: 30
		    //         }, {
		    //             name: 'No. of Mail Open',
		    //             y: 70,
		    //             sliced: true,
		    //             selected: true		                      
		    //         }]
		    //     }]
		    // });
			//CHART FOR PERIODIC CLIENT
			Highcharts.chart('pc_chart', {
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		         plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: false
		                },
		                showInLegend: true
		            }
		        },
		        series: [{
		            name: 'Brands',
		            colorByPoint: true,
		            data: [{
		                name: 'No. of Mail Sent',
		                y: <?=$PeriodicClient_mailOpenRate_Overall_Percent?>
		            }, {
		                name: 'No. of Mail Open',
		                y: <?= $PeriodicClient_mailOpenRate ?>,
		                sliced: true,
		                selected: true		                      
		            }]
		        }]
		    });
		    //CHART FOR PERIODIC PARTNER
			Highcharts.chart('pp_chart', {
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		         plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: false
		                },
		                showInLegend: true
		            }
		        },
		        series: [{
		            name: 'Brands',
		            colorByPoint: true,
		            data: [{
		                name: 'No. of Mail Sent',
		                y: <?=$PeriodicPartner_mailOpenRate_Overall_Percent?>
		            }, {
		                name: 'No. of Mail Open',
		                y: <?= $PeriodicPartner_mailOpenRate ?>,
		                sliced: true,
		                selected: true		                      
		            }]
		        }]
		    });
		    //CHART FOR TRADE OFFER
			// Highcharts.chart('to_chart', {
		 //        chart: {
		 //            plotBackgroundColor: null,
		 //            plotBorderWidth: null,
		 //            plotShadow: false,
		 //            type: 'pie'
		 //        },
		 //        tooltip: {
		 //            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		 //        },
		 //         plotOptions: {
		 //            pie: {
		 //                allowPointSelect: true,
		 //                cursor: 'pointer',
		 //                dataLabels: {
		 //                    enabled: false
		 //                },
		 //                showInLegend: true
		 //            }
		 //        },
		 //        series: [{
		 //            name: 'Brands',
		 //            colorByPoint: true,
		 //            data: [{
		 //                name: 'No. of Mail Sent',
		 //                y: 40
		 //            }, {
		 //                name: 'No. of Mail Open',
		 //                y: 60,
		 //                sliced: true,
		 //                selected: true		                      
		 //            }]
		 //        }]
		 //    });
		});
    </script>  