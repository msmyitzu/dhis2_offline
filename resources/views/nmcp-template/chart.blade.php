<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>National Malaria Control Programme</title>
		<meta name="_token" content="{{ csrf_token() }}" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset ('/bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
        <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/bower_components/apexchart/apexcharts.css')}}">
		<link href="{{asset ('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel='stylesheet' type="text/css" />
		<script type="text/javascript">
			window.onload = () => {
				document.body.style.cursor = 'default';
			};
		</script>
    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <!-- ./wrapper -->
        <div class="wrapper">

            <!-- Header -->
            @include('adminlte-template.header')

            <!-- Sider Bar -->
            @include('adminlte-template.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">

					<!--div class="row">
                        <div class="col-md-12">
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
									<i class="fa fa-times"></i>
								</button>
								<h4><i class="icon fa fa-info"></i> Please Note!</h4>
								For presentation purpose, some of the values are hardcoded.
								Real live data will be displayed once the project is finalized and filled with actual data.
							</div>
						</div>
					</div-->







					
            </div>
        </div>
        <script src="{{ asset ('/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{ asset('/bower_components/apexchart/apexcharts.min.js')}}"></script>
        <script src="{{ asset ('/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{ asset ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset ('bower_components/select2/dist/js/select2.min.js')}}"></script>
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
		<script src="../../bower_components/chart.js/Chart.js"></script>
		<script src="{{ asset ('bower_components/raphael/raphael.min.js')}}"></script>
		<script src="{{ asset ('bower_components/morris.js/morris.min.js')}}"></script>
		<script src="{{ asset ('js/nmcp.js')}}"></script>
		<script src="{{ asset ('js/bootbox.all.min.js') }}"></script>
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
        <script>

        	$('#chart_sdate').datepicker({
        		autoclose: true,
        		format: 'dd-mm-yyyy',
				orientation : 'bottom left'
        	}).on('changeDate', function(e){
        		var chooseDate = new Date(e.date);
        		$('#chart_edate').datepicker('setStartDate', chooseDate);
        	});

        	$('#chart_edate').datepicker({
        		autoclose: true,
        		format: 'dd-mm-yyyy',
				orientation : 'bottom left'
        	}).on('changeDate', function(e){
        		var chooseDate = new Date(e.date);
        		$('#chart_sdate').datepicker('setEndDate', chooseDate);
        	})

        	$('.select2').select2();

			$(document).ready(function(){
				var ch_opt = {
					chart: {
						height: 400,
						type: 'bar',
						toolbar:{
							show: false
						}
					},
					dataLabels: {
						enabled: false,
					},
					series:[{
						name: 'N/A',
						data : []
					}, {
						name: 'N/A',
						data : []
					}],
					xaxis:{
						categories:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
					},
					noData : {
						text : 'No Data',
						align : 'center',
						vierticalAlign : 'middle',
						style : {
							fontSize : '18px'
						}
					}
				}

				var rdt_opt = {
					chart: {
						height: 400,
						type: 'bar',
						toolbar:{
							show: false
						}
					},
					plotOptions: {
						bar: {
							barHeight: '100%',
							horizontal: true,
							endingShape: 'rounded'
						}
					},
					dataLabels: {
						enabled: false,
					},
					series: [{
						name : "N/A",
						data : []
						// data: result.examined_micro
					}, {
						name: "N/A",
						data : []
					}, {
						name: "N/A",
						data : []
						// data: result.examined_rdt
					}, {
						name: "N/A",
						data : []
						// data: result.positive_rdt
					}],
					xaxis: {
						// categories: result.rhc_names
						categories : []
					},
					noData : {
						text : 'No Data',
						align : 'center',
						vierticalAlign : 'middle',
						style : {
							fontSize : '18px'
						}
					}
				}

				var rhc_opt = {
					chart: {
						height: 400,
						type: 'bar',
						toolbar:{
                			show: false
						}
					},
					plotOptions: {
						bar: {
							horizontal: true,
						}
					},
					dataLabels: {
						enabled: false,
					},
					series: [{
						name: 'N/A',
						data : []
						// data: result.examined
					}, {
						name: 'N/A',
						data : []
						// data: result.positive
					}],
					xaxis: {
						// categories: result.rhc_names
						categories : []
					},
				}

				var per_opt = {
					chart: {
						height: 400,
						type: 'radialBar'
					},
					plotOptions: {
						radialBar: {
							dataLabels: {
								total: {
									show: true,
									Label: "Percentage",
								}
							}
						}
					},
					legend: {
						show: true,
						floating: true,
						fontSize: '16px',
						position: 'left',
						offsetX: 170,
						offsetY: 10,
						labels: {
							useSeriesColors: true,
						},
						markers: {
							size: 0
						},
						formatter: function(seriesName, opts) {
							return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
						},
						itemMargin: {
							horizontal: 1,
						}
					},
					labels: ['N/A'],
					series: [0],
				}

				var ch = new ApexCharts(document.getElementById('township-monthly-Chart'), ch_opt);
				var rdt = new ApexCharts(document.getElementById('rdt-chart'), rdt_opt);
				var rhc = new ApexCharts(document.getElementById('rhc-chart'), rhc_opt);
				var per = new ApexCharts(document.getElementById('percent-chart'), per_opt);
				ch.render();
				rdt.render();
				rhc.render();
				per.render();

			$("#update_charts").click(function(){
				var sr_code = $('#chart_sr_code').val();
				var ts_code = $("#chart_ts_code").val();
				var sdate = $("#chart_sdate").val();
				var edate = $("#chart_edate").val();
				var errMsg = '';
				if(sr_code == ''){
					errMsg += "<p>တိုင်းနှင့်ပြည်နယ်</p>";
				}
				if(ts_code == ''){
					errMsg += "<p>မြို့နယ်ရွေးပါ၊၊</p>";
				}
				if(sdate == ''){
					errMsg += "<p>စတင်သည့်ရက်ရွေးပါ။</p>";
				}
				if(edate == ''){
					errMsg += "<p>ပြီးဆုံးသည့်ရက်ရွေးပါ။</p>";
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
				}else{
					generate_ts_monthly_chart(ts_code, sdate);
					generate_micro_rdt_chart(ts_code, sdate, edate);
					generate_rhc_chart(ts_code, sdate, edate);
					generate_reported_percent(ts_code, sdate, edate);
				}
			});
			function generate_ts_monthly_chart(ts_code, sdate)
			{
				var url = "chart_exam_and_positive_all?ts_code="+ts_code+"&sdate="+sdate;
				$.ajax({url: url, success: function(result){
					console.log('this is ts : ', result);
					ch.updateOptions({
						series : [{
							name : 'Examined',
							data : result.examined
						},{
							name : 'Positive',
							data : result.positive
						}],
						noData : {
							text : 'No Data to Show',
							style : {
								fontSize : '14px'
							}
						}
					});
					// var apex_BarChart = new ApexCharts(document.querySelector('#township-monthly-Chart'),{
        			// 	chart: {
        			// 		height: '400',
        			// 		type: 'bar',
        			// 		toolbar:{
        			// 			show: false
        			// 		}
        			// 	},
        			// 	dataLabels: {
        			// 		enabled: false,
        			// 	},
        			// 	series:[{
        			// 		name: 'Examined',
        			// 		//data: [18, 17, 16, 14, 15, 16, 7, 3, 9, 4, 2, 14]
        			// 		data: result.examined
            		// 	}, {
					// 		name: 'Positive',
					// 		//data: [4, 0, 8, 4, 0, 4, 0, 0, 6, 2, 1, 0]
					// 		data: result.positive
            		// 	}],
        			// 	xaxis:{
        			// 		categories:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        			// 	},
        			// });
        			// apex_BarChart.render();
				}});
			}
			function generate_micro_rdt_chart(ts_code, sdate, edate)
			{
				var url = "chart_exam_and_positve_micrordt?ts_code="+ts_code+"&sdate="+sdate+"&edate="+edate;
				$.ajax({url: url, success: function(result){
					console.log('this is micor : ', result);
					var cat = [] ;
					if(result.rhc_names.length < 5 ){
						max = result.rhc_names.length * 50 ;
						result.rhc_names.map( data => cat.push(data) );
						rdt.updateOptions({
							chart: {
								height: 400,
								type: 'bar',
								toolbar:{
									show: false
								}
							},
							series : [{
								name : 'Examined by Micro',
								data : result.examined_micro
							},{
								name : 'Any Micro Result',
								data : result.examined_micro
							},{
								name : 'Examined by RDT',
								data : result.examined_rdt,
							},{
								name : 'Any RDT Positive',
								data : result.positive_rdt,
							}],
							xaxis : {
								categories : cat,
							}
						})
					}else{
						max = result.rhc_names.length * 50 ;
						result.rhc_names.map( data => cat.push(data) );
						rdt.updateOptions({
							chart: {
								height: result.rhc_names.length * 40,
								type: 'bar',
								toolbar:{
									show: false
								}
							},
							series : [{
								name : 'Examined by Micro',
								data : result.examined_micro
							},{
								name : 'Any Micro Result',
								data : result.examined_micro
							},{
								name : 'Examined by RDT',
								data : result.examined_rdt,
							},{
								name : 'Any RDT Positive',
								data : result.positive_rdt,
							}],
							xaxis : {
								categories : cat,
							}
						})
					}
				}});
			}
			function generate_rhc_chart(ts_code, sdate, edate)
			{
				var url = "chart_rhc_exam_and_positive?ts_code="+ts_code+"&sdate="+sdate+"&edate="+edate;

				$.ajax({url: url, success: function(result){
					console.log("this is rhc : ",result);
					var max = 400 ;
					var cat = [] ;
					if(result.rhc_names.length < 5 ){
						max = result.rhc_names.length * 50 ;
						result.rhc_names.map( data => cat.push(data) );
						rhc.updateSeries([{
								name : 'Examined',
								data : result.examined
							},{
								name : 'Any Positive',
								data : result.positive
						}]);

						rhc.updateOptions({
							chart : {
								height : 400,
								type : 'bar',
								toolbar : {
									show : false
								}
							},
							plotOptions: {
								bar: {
									horizontal: true,
								}
							},
							dataLabels: {
								enabled: false,
							},
							// series : [{
							// 	name : 'Examined',
							// 	data : result.examined
							// },{
							// 	name : 'Any Positive',
							// 	data : result.position
							// }],
							xaxis : {
								// categories : result.rhc_name
								categories : cat
							}
						});

						console.log('this is rhc cat ' ,cat);

					}else{
						max = result.rhc_names.length * 50 ;
						result.rhc_names.map( data => cat.push(data) );
						rhc.updateSeries([{
								name : 'Examined',
								data : result.examined
							},{
								name : 'Any Positive',
								data : result.positive
						}]);

						rhc.updateOptions({
							chart : {
								height : result.rhc_names.length * 40,
								type : 'bar',
								toolbar : {
									show : false
								}
							},
							plotOptions: {
								bar: {
									horizontal: true,
								}
							},
							dataLabels: {
								enabled: false,
							},
							// series : [{
							// 	name : 'Examined',
							// 	data : result.examined
							// },{
							// 	name : 'Any Positive',
							// 	data : result.position
							// }],
							xaxis : {
								// categories : result.rhc_name
								categories : cat
							}
						});

						console.log('this is rhc cat ' ,cat);
					}
				}});
			}
        	function generate_reported_percent(ts_code, sdate, edate)
			{
				var url = "chart_reported_percentages?ts_code="+ts_code+"&sdate="+sdate+"&edate="+edate;
				$.ajax({url: url, success: function(result){
					console.log("this is percent : ", result);
					if(result.percentages.length > 0){
						per.updateOptions({
							colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
							series: result.percentages,
							labels: result.hftypes,
							plotOptions: {
								radialBar: {
									offsetY: -30,
									startAngle: 0,
									endAngle: 270,
									hollow: {
										margin: 5,
										size: '30%',
										background: 'transparent',
										image: undefined,
									},
									dataLabels: {
										name: {
											show: true,
										},
										value: {
											show: true,
										}
									}
								}
							},
							legend: {
								show: true,
								floating: true,
								fontSize: '12px',
								position: 'left',
								offsetX: 100,
								offsetY: 10,
								labels: {
									useSeriesColors: true,
								},
								markers: {
									size: 0
								},
								formatter: function(seriesName, opts) {
									return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex] + '%'
								},
								itemMargin: {
									horizontal: 1,
								}
							},
							responsive: [{
								breakpoint: 480,
								options: {
									legend: {
										show: false
									}
								}
							}]
						});
					}
				}})};
			});
        </script>
        <style>
            .box-title{
				font-weight:bold;
			}

			.customLegend{
				margin:auto;
				width: 70%;
				padding-left: 5px;
				margin-top: 5px;
			}
			.customLegend td{
				padding-left: 5px;
			}
			.morris-hover{
				position:absolute;
				z-index:1000;
				background-color: black;
				opacity: 0.8;
				padding: 5px;
				border-radius: 5px;
				color: white;
			}
			label{
				line-height:30px;
			}
        </style>
    </body>
    </html>
