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
	<link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
	<link href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset ('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
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
                    
                    <div class="row">
                        <div class="col-md-12">                                
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">မြို့နယ်/တိုက်နယ်ဆေးရုံ/ကျန်းမာရေးဌာန/ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ</h3>                            
                                </div>
                                <!-- /.box-header table_tbl_hfm-->
								<div class="box-body">
									<div class="col-md-6">
										<div class="form-group">
											<label for="" class="col-md-3 control-label" align="right">တိုင်းနှင့်ပြည်နယ်</label>
											<div class="col-md-6">
												<select id="select_lp_stateregion_hf" class="form-control select2" 
												@if(session('role_id') !== '3')
													onChange="load_lp_township('select_lp_township_hf', this.value, '<?= csrf_token() ?>','')"
												@endif
												>
													<option value="0" selected="selected">ရွေးရန်</option>
													@foreach ($lp_state_region as $sr)
														<option value="{{ $sr->sr_code}}" <?php echo session('role_id') == '3' ? 'selected' : '' ?>>
															{{ $sr->sr_name}} | {{ $sr->sr_name_mmr}}
														</option>
													@endforeach
												</select>
											</div>
										</div><br/><br/>
										<div class="form-group">
											<label for="" class="col-md-3 control-label" align="right">မြို့နယ်</label>
											<div class="col-md-6">
												<?php 
													if(session('role_id') === '3'){
												?>
													<select id="select_lp_township_hf" class="form-control select2 select_lp_township_hf" onChange="load_lp_hftype('<?= csrf_token() ?>')">
														<option value="0">ရွေးရန်</option>
														@foreach($lp_township as $ts)
															<option value="{{ $ts->ts_code }}" <?php echo session('role_id') == '3' ? 'selected' : '' ?>>
																{{ $ts->ts_name }} | {{ $ts->ts_name_mmr }}
															</option>
														@endforeach
													</select>
												<?php	
													}else {
												?>
													<select id="select_lp_township_hf" class="form-control select2 select_lp_township_hf" onChange="load_lp_hftype('<?= csrf_token() ?>')">
													</select>
												<?php } ?>
											</div>
										</div><br/><br/>
										<div class="form-group">
											<label for="" class="col-md-3 control-label" align="right">ဌာနအမျိုးအစား</label>
											<div class="col-md-6">
												<select id="select_lp_hftype" class="form-control select2" >
												</select>
											</div>
										</div>																
									</div>
									<div class="col-md-12">
										<!--div class="row">
											<button type="button" class="btn btn-sm btn-default mmbtn" onClick="insert_init()">
												<li class="fa fa-plus-square"></li> အသစ်ထည့်ရန်
											</button>		
										</div-->
										<table id="table_tbl_hfm" class="table table-bordered dataTable text-nowrap" style="width:100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>ကျန်းမာရေးဌာနအမည်</th>
													<th>Health Facility Name</th>
													<th>ပင်မကျန်းမာရေးဌာန</th>
													<th>အဖွဲ့အစည်း</th>
													@if(session('role_id') === '1')
														<th>Latitude</th>
														<th>Longitude</th>
														<th>MIMU Code</th>
														<th>HF CodeReport</th>
														<th>HF CodeReportingUnit</th>
													@endif
													<th>ဆက်သွယ်ရန်</th>                                    
													<th width="70">Status</th>                                    
													<th width="100">ပြင်ရန်</th>                                    
													<th width="100">ဖျက်ရန်</th>                                    
												</tr>
											</thead>

											<tbody id="grab_all_hf_container">

											</tbody>
										</table>
									</div>
								</div>								
                            </div>
                        </div>
                    </div>  

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
		<script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Select2 -->     
        <script src="{{ asset ('bower_components/select2/dist/js/select2.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        <!-- datepicker -->
        <script src="{{ asset ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <script>
		$(function(){
			$('#select_lp_township_hf').trigger('change');
		});
        $('.select2').select2();
        var table_tbl_hfm = $('#table_tbl_hfm').DataTable({
        	'retrieve': true,
			'paging': false,
            'searching': true,
            'ordering': true,
            'info': false,
            'select': false,
            "autoWidth": true,
            "scrollX": true, 
            "lengthChange" : false,
        });
		function load_healthfacility_admin(ts_code, hftypeid) {				
			$("#select_lp_hftype").prop("disabled", true);

			$("#grab_all_hf_container").html(
				'<tr><td colspan="9" style="text-align:center"><img src="img/default-loading.gif" style="width:20px;"/></td></tr>'
			);

			try {
				$.ajax({
					type: "GET",
					url: BACKEND_URL + 'get_grab_healthfacilitypage/' + ts_code + '/' + hftypeid,
					data: "",
					success: function(data) {

						if($.fn.dataTable.isDataTable('#table_tbl_hfm')){
							$('#table_tbl_hfm').DataTable().clear().destroy();
						}

						$("#grab_all_hf_container").html('');
						console.log(data);
						if (data.length > 0) {
							jQuery.each(data, function(i, val) {
								var tr = "<tr>";
								tr += "<td>" + (i+1) + "</td>";
								tr += "<td>" + val.SC_Name + "</td>";
								tr += "<td>" + val.SC_Name_MM + "</td>";
								tr += "<td>" + val.HF_Name_MM + "</td>";
								tr += "<td>" + val.Org + "</td>";
								<?php if(session('role_id') === '1'){ ?>
									tr += "<td>" + val.Latitude + "</td>";
									tr += "<td>" + val.Longitude + "</td>";
									tr += "<td>" + val.MIMU_Code + "</td>";
									tr += "<td>" + val.HF_CodeReport + "</td>";
									tr += "<td>" + val.HF_CodeReportingUnit + "</td>";
								<?php } ?>
								tr += "<td>" + val.FocalPerson + "</td>";
								
								<?php
									if(session("role_id") == "1"){
								?>

									tr += '<td valign="middle" style="padding:0px;"><select class="status_select" onChange="update_hfm_status('+val.hfm_id+',this)" id="status_'+val.hfm_id+'"><option value="1">Active</option><option value="0">Inactive</option></select></td>';
									tr += '<td><button type="button" class="btn btn-block btn-warning btn-xs" onclick="update_init('+val.hfm_id+')"><li class="fa fa-pencil"></li> ပြင်ဆင်ရန်</button></td>';
									tr += '<td><button type="submit" onClick=delete_hfm('+val.hfm_id+',"'+val.SC_Name_MM+'",this) class="btn btn-block btn-danger btn-xs"><li class="fa fa-trash"></li> အပီးဖျက်ရန်</button></td>';
								
								<?php
									} else {
								?>
									if(val.status == "1"){
										tr += "<td class='bg-success'> Active </td>";
									} else {
										tr += "<td class='bg-danger'> Inactive </td>";
									}
									tr += "<td> - </td><td> - </td>";
								<?php
									}
								?>

								tr += "</tr>";
								$("#grab_all_hf_container").append(tr);

								$("#status_"+val.hfm_id).val(val.status);

								if(val.status == "1"){
									$("#status_"+val.hfm_id).removeClass("bg-danger");
									$("#status_"+val.hfm_id).addClass("bg-success");
								}
								if(val.status == "0"){
									$("#status_"+val.hfm_id).removeClass("bg-success");
									$("#status_"+val.hfm_id).addClass("bg-danger");
								}});							
						} else {
							//var tr = '<tr><td colspan="14">အချက်အလက်မရှိပါ</td></tr>';
							//$("#grab_all_hf_container").append(tr);
						}
						$("#select_lp_hftype").prop("disabled", false);

						// if($.fn.dataTable.isDataTable('#table_tbl_hfm')){
						// 	//$('#table_tbl_hfm').DataTable().clear().destroy();
						// 	table_tbl_hfm = $('#table_tbl_hfm').DataTable({
						// 		'retrieve': true,
						// 		'paging': false,
						//            'searching': true,
						//            'ordering': true,
						//            'info': false,
						//            'select': false,
						//            "autoWidth": true,
						//            "scrollX": true, 
						//            "lengthChange" : false
						// 	});
						// }else{
						// 	$('#table_tbl_hfm').DataTable({
						//        	'retrieve': true,
						// 		'paging': false,
						//            'searching': true,
						//            'ordering': true,
						//            'info': false,
						//            'select': false,
						//            "autoWidth": true,
						//            "scrollX": true,
						//            "lengthChange" : false 
						// 	});
						// }
					$('#table_tbl_hfm').DataTable({
						'retrieve': true,
						'paging': false,
						'searching': true,
						'ordering': true,
						'info': false,
						'select': false,
						"autoWidth": true,
						"scrollX": true,
						"lengthChange" : false 
					});
					}
				});
			} catch (error) {
				alert(error.message);
			}
		}

		function delete_hfm(hfm_id, sc_name_mm, ctrl)
		{
			$(ctrl).prop("disabled", true);		
			var result = confirm(sc_name_mm + " အားအပီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ။");
			if (result) {
				//alert("ဖျက်ခွင့်မပြုသေးပါ။ ကိုစိုင်းထံ ဆက်သွယ်ပါ။");
				//return false;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if(xmlhttp.responseText == "1"){
							$(ctrl).prop("disabled", false);	
							var ts_code = $("#select_lp_township_hf").val();
							var hftypeid = $("#select_lp_hftype").val();
							load_healthfacility_admin(ts_code, hftypeid);
						} else {
							alert(xmlhttp.responseText);
							$(ctrl).prop("disabled", false);	
						}
					}
				}

				xmlhttp.open("POST", BACKEND_URL + 'delete_tbl_hfm/'+hfm_id);
				xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
				xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
				xmlhttp.send();
			}
		}

		function update_hfm_status(hfm_id, ctrl)
		{
			$(ctrl).prop("disabled", true);				
			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(xmlhttp.responseText == "1"){
						$(ctrl).prop("disabled", false);	
						if(ctrl.value == "1"){
							$(ctrl).removeClass("bg-danger");
							$(ctrl).addClass("bg-success");								
						}
						if(ctrl.value == "0"){
							$(ctrl).removeClass("bg-success");
							$(ctrl).addClass("bg-danger");
						}
					} else {
						alert(xmlhttp.responseText);
						$(ctrl).prop("disabled", false);	
					}
				}
			}

			xmlhttp.open("POST", BACKEND_URL + 'update_tbl_hfm_status/'+hfm_id+'/'+ctrl.value);
			xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
			xmlhttp.send();
		}

		function hftype_changed(hftypeid)
		{
			location.href = "/health-facilities/" + hftypeid;
		}

		$( "#select_lp_hftype" ).change(function() {
			var sr_code = $("#select_lp_stateregion_hf").val();
			var ts_code = $("#select_lp_township_hf").val();
			var hftypeid = $("#select_lp_hftype").val();
			
			if(sr_code.trim()!="" && ts_code.trim()!="" && hftypeid!="0"){
				//console.log(sr_code +"/"+ts_code+"/"+hftypeid);
				load_healthfacility_admin(ts_code, hftypeid);
			}
		});

		function update_init(hfm_id){
			
			var lp_stateregion = $("#select_lp_stateregion_hf").val();
			var lp_township = $("#select_lp_township_hf").val();
			var lp_hftype = $("#select_lp_hftype").val();

			var err = "";

			if(lp_stateregion == "0"){
				err += "တိုင်းနှင့်ပြည်နယ်ရွေးပါ\n";
			}
			if(lp_township == null || lp_township == "0"){
				err += "မြို့နယ်ရွေးပါ\n";
			}
			if(lp_hftype == null || lp_hftype == "0"){
				err += "ဌာနအမျိုးအစားရွေးပါ\n";
			}

			if(err == ""){
				$('#txt_lp_stateregion').val(lp_stateregion);
				$('#txt_lp_township').val(lp_township);
				$('#txt_lp_hftype').val(lp_hftype);
			}
			else {
				alert(err);
			}

			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
					$("#hidden_id").val(hfm_id);
					$("#modal-title").val("အချက်အလက်ပြုပြင်ရန်");                
					$("#hfform").attr('action', 'health-facility/update');                
					$('#modal-addnew').modal('show');
					
					try {
						var data = JSON.parse(xmlhttp.responseText);
						//console.log(data);
						//alert(data.SC_Name);
						$("#txt_sc_name").val(data.SC_Name);
						$("#txt_sc_name_mm").val(data.SC_Name_MM);
						$("#txt_org").val(data.Org);
						$("#txt_MIMU_Code").val(data.MIMU_Code);
						$("#txt_Longitude").val(data.Longitude);
						$("#txt_Latitude").val(data.Latitude);
						$("#txt_HF_CodeReport").val(data.HF_CodeReport);
						$("#txt_HF_CodeReportingUnit").val(data.HF_CodeReportingUnit);
						$("#txt_FocalPerson").val(data.FocalPerson);
						$("#txt_Start").val(data.Start);
						$("#txt_End").val(data.End);
						$("#txt_status").val(data.status);

					}
					catch(err) {
						alert(err.message);
					}
					
				}
			}

			xmlhttp.open("GET", BACKEND_URL + 'health-facility/'+hfm_id);
			xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
			xmlhttp.send();
			
			
		}

		function insert_init(){
			$('#hfform').attr('action', 'health-facility/save');                
			$("#modal-title").val("ကျန်းမာရေးဌာနအသစ်ထည့်ရန်");
			$("#hidden_id").val("");
			
			var lp_stateregion = $("#select_lp_stateregion_hf").val();
			var lp_township = $("#select_lp_township_hf").val();
			var lp_hftype = $("#select_lp_hftype").val();

			var err = "";

			if(lp_stateregion == "0"){
				err += "တိုင်းနှင့်ပြည်နယ်ရွေးပါ\n";
			}
			if(lp_township == null || lp_township == "0"){
				err += "မြို့နယ်ရွေးပါ\n";
			}
			if(lp_hftype == null || lp_hftype == "0"){
				err += "ဌာနအမျိုးအစားရွေးပါ\n";
			}

			if(err == ""){
				$('#txt_lp_stateregion').val(lp_stateregion);
				$('#txt_lp_township').val(lp_township);
				$('#txt_lp_hftype').val(lp_hftype);
				$('#modal-addnew').modal('show');
			}
			else {
				alert(err);
			}
			
		}

		document.addEventListener("DOMContentLoaded", function() {
			var elements = document.getElementsByClassName("form-control");
			for (var i = 0; i < elements.length; i++) {
				elements[i].oninvalid = function(e) {
					e.target.setCustomValidity("");
					if (!e.target.validity.valid) {
						e.target.setCustomValidity("ဖြည့်ပါ");
					}
				};
				elements[i].oninput = function(e) {
					e.target.setCustomValidity("");
				};
			}
		});
		
		function save_hf()
		{
			/*
			$("#txt_sc_name").val(data.SC_Name);
			$("#txt_sc_name_mm").val(data.SC_Name_MM);
			$("#txt_org").val(data.Org);
			$("#txt_MIMU_Code").val(data.MIMU_Code);
			$("#txt_Longitude").val(data.Longitude);
			$("#txt_Latitude").val(data.Latitude);
			$("#txt_HF_CodeReport").val(data.HF_CodeReport);
			$("#txt_HF_CodeReportingUnit").val(data.HF_CodeReportingUnit);
			$("#txt_FocalPerson").val(data.FocalPerson);
			$("#txt_Start").val(data.Start);
			$("#txt_End").val(data.End);
			$("#txt_status").val(data.status);

			var sr_code = $("#select_lp_stateregion_hf").val();
			var ts_code = $("#select_lp_township_hf").val();
			var hftypeid = $("#select_lp_hftype").val();

			$('#txt_lp_stateregion').val(lp_stateregion);
				$('#txt_lp_township').val(lp_township);
				$('#txt_lp_hftype').val(lp_hftype);
			*/
			var url = $("#hfform").attr('action');    
			//alert(url);
			var data = new FormData();
			data.append('txt_lp_stateregion', $( '#select_lp_stateregion_hf' ).val());
			data.append('txt_lp_township', $( '#select_lp_township_hf' ).val());
			data.append('txt_lp_hftype', $( '#select_lp_hftype' ).val());
			data.append('txt_sc_name', $( '#txt_sc_name' ).val());
			data.append('txt_sc_name_mm', $( '#txt_sc_name_mm' ).val());
			data.append('txt_org', $( '#txt_org' ).val());
			data.append('txt_MIMU_Code', $( '#txt_MIMU_Code' ).val());
			data.append('txt_Longitude', $( '#txt_Longitude' ).val());
			data.append('txt_Latitude', $( '#txt_Latitude' ).val());
			data.append('txt_HF_CodeReport', $( '#txt_HF_CodeReport' ).val());
			data.append('txt_HF_CodeReportingUnit', $( '#txt_HF_CodeReportingUnit' ).val());
			data.append('txt_FocalPerson', $( '#txt_FocalPerson' ).val());
			data.append('txt_Start', $( '#txt_Start' ).val());
			data.append('txt_End', $( '#txt_End' ).val());
			data.append('txt_status', $( '#select_status' ).val());

			if(url == "health-facility/update"){
				data.append('hidden_id', $( '#hidden_id' ).val());
			}
			
			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(xmlhttp.responseText == "1"){
						var sr_code = $("#select_lp_stateregion_hf").val();
						var ts_code = $("#select_lp_township_hf").val();
						var hftypeid = $("#select_lp_hftype").val();
			
						if(sr_code.trim()!="" && ts_code.trim()!="" && hftypeid!="0"){
							load_healthfacility_admin(ts_code, hftypeid);
						}
					}
					else{
						document.write(xmlhttp.responseText);
					}
				}					
			}

			xmlhttp.open("POST", BACKEND_URL + url);
			//xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
			xmlhttp.send(data);
		}
        </script>
		<style>
			.control-label{
				padding-top: 11px;
				margin-bottom: 0;
				font-weight: 700;
			}
			.bg-active{}
			.bg-inactive{}
			.mmbtn{
				margin-right: 15px;
				margin-bottom: 15px;
				float: right;
			}
			.status_select{
				width: 100%;
				height: 35px;
				border:none;
				margin-top: 2px;
			}

            tr{
                cursor:pointer;
            }
            /*tbody tr:nth-child(odd) {background: #F5F5F5}*/
            tr.selected{
                color: #EA4A2D;
                /*font-weight: bold;*/
                background-color: #FBFBA5;
            }
            .dataTables_wrapper .dataTables_paginate {
                float: right;
                text-align: right;
                margin-bottom: 5px;
            }

           .dataTables_wrapper .dataTables_filter {
                float: right;
                text-align: right;
                margin-bottom: 5px;
            }
            .dataTables_wrapper .dataTables_filter input {
                margin-left: 5px;
            }
            .dataTables_scrollHead{
                padding: 0px;
                margin: 0px;
            }
            .sync_offline{
                color: silver;
                font-weight:bold;
            }
            /*thead th { border-bottom: 2px solid #E86156;}*/
            

            tbody tr:hover{
                background-color: #FFFFCB;
            }
            
            .table{
                margin-bottom: 0px;
            }

            #table_tbl_hfm tbody td,
            #table_tbl_hfm tbody th{
                white-space: nowrap;
            }

			.select2{
				font-size: small;
				padding-bottom: 5px;
				padding-top: 5px;
			}
			
        </style>
		<form method="post" action="health-facility/save" id="hfform">
			<div class="modal fade" id="modal-addnew">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="modal-title">ကျန်းမာရေးဌာနအသစ်ထည့်ရန်</h4>
				  </div>
				  <div class="modal-body" style="height: 500px; overflow-y:hidden; overflow-y:scroll;">               
                
						{{ csrf_field() }}
						<input type="hidden" id="hidden_id" name="hidden_id" value="" />

						<input type="hidden" id="txt_lp_stateregion" name="txt_lp_stateregion"> 
						<input type="hidden" id="txt_lp_township" name="txt_lp_township">
						<input type="hidden" id="txt_lp_hftype" name="txt_lp_hftype">

						<div class="form-group">
							<label for="exampleInputEmail1">ဌာနအမည် (ENG)</label>
							<input type="text" class="form-control" id="txt_sc_name" name="txt_sc_name" required>
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">ဌာနအမည်</label>
							<input type="text" class="form-control" id="txt_sc_name_mm" name="txt_sc_name_mm" required>
						</div>                                  
              
						<div class="form-group">
							<label for="exampleInputEmail1">Organization</label>
							<input type="text" class="form-control" id="txt_org" name="txt_org" required>
						</div>  
						
						<div class="form-group">
							<label>MIMU_Code</label>
							<input type="text" class="form-control" id="txt_MIMU_Code" name="txt_MIMU_Code">
						</div>
						<div class="form-group">
							<label>Longitude</label>
							<input type="text" class="form-control" id="txt_Longitude" name="txt_Longitude">
						</div>   
						<div class="form-group">
							<label>Latitude</label>
							<input type="text" class="form-control" id="txt_Latitude" name="txt_Latitude">
						</div>   
						<div class="form-group">
							<label>HF_CodeReport</label>
							<input type="text" class="form-control" id="txt_HF_CodeReport" name="txt_HF_CodeReport" required>
						</div>   
						<div class="form-group">
							<label>HF_CodeReportingUnit</label>
							<input type="text" class="form-control" id="txt_HF_CodeReportingUnit" name="txt_HF_CodeReportingUnit" required>
						</div>   
						<div class="form-group">
							<label>FocalPerson</label>
							<input type="text" class="form-control" id="txt_FocalPerson" name="txt_FocalPerson">
						</div>   
						<div class="form-group">
							<label>Start</label>
							<input type="text" class="form-control rpt_datepicker" id="txt_Start" name="txt_Start">
						</div>   
						<div class="form-group">
							<label>End</label>
							<input type="text" class="form-control rpt_datepicker" id="txt_End" name="txt_End">
						</div>   
						<div class="form-group">
							<label>Status</label>
							<select id="select_status" name="select_status" class="form-control">
								<option value="0">Inactive</option>
								<option value="1" selected>Active</option>
							</select>
						</div>   

				  </div>

				  <div class="modal-footer">                
					<button class="btn btn-default btn-sm pull-left" data-dismiss="modal">
						မသိမ်းပဲပိတ်မည်
					</button>
					<!--button class="btn btn-success btn-sm" type = "submit">
						<li class="fa fa-floppy-o"></li> သိမ်းမည်
					</button-->
					<input type="button" class="btn btn-success btn-sm" value="သိမ်းမည်" onClick="save_hf()" />
				  </div>
				</div>
				<!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
        </form>
		<script>
			//$('.rpt_datepicker').datepicker({ format: 'yyyy-mm-dd'});		
		</script>
    </body>
    </html>
