<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>National Malerial Control Program</title>
		<meta name="_token" content="{{ csrf_token() }}" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset ('bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">
		<link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset ('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
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
                            
                            @include('adminlte-template.nav-tabs')

                        </div>
                        <!-- Custom Tabs -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{ asset ('bower_components/select2/dist/js/select2.min.js')}}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset ('bower_components/raphael/raphael.min.js')}}"></script>
        <script src="{{ asset ('bower_components/morris.js/morris.min.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <script src="{{ asset ('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{ asset ('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
        <script src="{{ asset ('bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{ asset ('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ asset ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset ('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{ asset ('bower_components/admin-lte/dist/js/demo.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <script src="{{ asset ('js/popper.min.js') }}"></script>
        <script src="{{ asset ('js/bootbox.all.min.js') }}"></script>
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        <script src="{{ asset ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
		<script>
			var o_sdate, o_edate;
            $(function() {
                var health_facility_table = $('#health_facility_table').DataTable({
                    "destroy": true,
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                });

                // $('.select2').select2();

                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                });
            });
            
            $(document).ready(function(){
                $('#report_rhcsc_page').hide();
                $('#report_by_township').hide();
                
                load_lp_form_cat('select_lp_form_cat','<?=csrf_token();?>');
                //load_lp_form_cat('select_lp_form_cat_dm','<?=csrf_token();?>');
                load_last_corefacility();
			});
			
			var toDay = new Date().getDate();

            $("#form-date").datepicker({
                autoclose: true,
                format: "mm/yyyy",
                viewMode: "months",
				minViewMode: "months",
				// startDate: new Date(new Date().setDate(toDay - 365)),
				endDate: new Date()
            });

			$("#rpt-form-date").datepicker({
                autoclose: true,
                format: "mm/yyyy",
                viewMode: "months",
                minViewMode: "months",
            });

			$("#dm-form-date").datepicker({
                autoclose: true,
                format: "mm/yyyy",
                viewMode: "months",
				minViewMode: "months",
				orientation : 'bottom left'
            });

            $(".num-only").keyup(function() {
                var v = $(".num-only").val();

                if($.isNumeric(v) == false){
                    v = v.substring(0, v.length-1);
                    $(".num-only").val(v);
                }
            });

            $( ".num-only" ).change(function() {
                var v = $(".num-only").val();

                if($.isNumeric(v) == false){ 
                    bootbox.alert("ပုံစံအမှတ်အတွက် နံပါတ်များသာရိုက်သွင်းပါ");
                    $(".num-only").val("");
                }
            });


			//Below for township reporting

			$('#rpt_sdate').datepicker({
				autoclose		: true,
				format			: "dd-mm-yyyy",
				orientation 	: 'bottom left',
				todayHighlight 	: true,
			}).on('changeDate', function(date){
				var chooseDate = new Date(date.date);
				$("#rpt_edate").datepicker('setStartDate', chooseDate);
			});

			$('#rpt_edate').datepicker({
				autoclose		: true,
				format			: "dd-mm-yyyy",
				orientation 	: 'bottom left',
				todayHighlight	: true,
			}).on('changeDate', function(date){
				var chooseDate = new Date(date.date);
				$('#rpt_sdate').datepicker('setEndDate', chooseDate);
			});

			function show_ts_summary_by_period()
			{
				var valid = summary_validation();
            	if(valid){
					$("#rpt_form").attr('action', 'report/township_summary_by_period');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_summary_by_ag_form_type()
			{
				var valid = summary_validation()
				if(valid){
					$("#rpt_form").attr('action', 'report/summary_by_age_group_form_type');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

            function show_hf_reported_by_period()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/hf_reported_by_period');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_list_of_hf_no_reports()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/list_of_hf_no_reports');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_age_group_bse_result_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/age_group_bse_result_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_age_group_rdt_result_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/age_group_rdt_result_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_malaria_mortality_and_morbidity_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/malaria_mortality_and_morbidity_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_antenatal_mmm_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/antenatal_mmm_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_under5_mmm_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/under5_mmm_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_species_wise_examination_result_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/species_wise_examination_result_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_summary_report_sc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/summary_report_sc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}
			
			function show_data_in_text_sr()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/data_in_text_sr');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_summary_report_rhc()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/summary_report_rhc');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_townships_reported_by_period()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/townships_reported_by_period');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_summary_examined_report_period()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/summary_examined_report_period');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function show_summary_case_report_period()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/summary_case_report_period');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}	
			
			function show_summary_report_of_hf_sr()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/summary_report_of_hf_sr');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}	
			
			function show_township_hf_reported_percent()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/township_hf_reported_percent');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}	
			
			function show_generate_pudr_form_b()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/generate_pudr_form_b');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}	
			
			function show_generate_pudr_annex_e()
			{
				var valid = summary_validation();
				if(valid){
					$("#rpt_form").attr('action', 'report/generate_pudr_annex_e');
					$("#rpt_form").submit();
					$('#rpt_sdate').val(o_sdate);
					$('#rpt_edate').val(o_edate);
				}
			}

			function summary_validation()
			{
				o_sdate = $('#rpt_sdate').val();
            	o_edate = $('#rpt_edate').val();

				var rpt_stateregion = $('#rpt_lp_stateregion').val();
			    var rpt_township = $('#rpt_lp_township').val();
			    var rpt_sdate = $('#rpt_sdate').val();
			    var rpt_edate = $('#rpt_edate').val();
                var rpt_type = $('#rpt_type').val();
			    var errMsg = '';
			    if (rpt_stateregion == '') {
				    errMsg += '<p>•• တိုင်းနှင့်ပြည်နယ်ရွှေးပါ</</p>';
			    }
			    if (rpt_township == '' || rpt_township == null) {
				    errMsg += '<p>•• မြို့နယ်ရွှေးပါ</</p>';
			    }
			    if (rpt_sdate == '') {
				    errMsg += '<p>•• စတင်သည့်ရက်ရွှေးပါ</</p>';
			    }
			    if (rpt_edate == '') {
				    errMsg += '<p>•• ပြီးဆုံးသည့်ရက်ရွှေးပါ</</p>';
			    }
                if(rpt_type == 'default'){
                    errMsg += '<p>•• စာရင်းချုပ်အမျိုးအစားရွှေးပါ</</p>';
                }
			    if (errMsg != '') {
				    bootbox.alert(errMsg);
				    return false;
			    }
                rpt_sdate = rpt_sdate.split('-');
                var temp = rpt_sdate[0];
                rpt_sdate[0] = rpt_sdate[2];
                rpt_sdate[2] = temp;
                temp = '';
                $('#rpt_sdate').val(rpt_sdate.join('-'));
                rpt_edate = rpt_edate.split('-');
                temp = rpt_edate[0];
                rpt_edate[0] = rpt_edate[2];
                rpt_edate[2] = temp;
                temp = '';
                $('#rpt_edate').val(rpt_edate.join('-'));
                return true;
			}


			//Data Monitoring

			function show_check_no_malaria_treatment_given()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>•• ပုံစံအမျိုးအစားဖြည့်ပါ</</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>•• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>•• မြို့နယ်ဖြည့်ပါ</</p>';
				}
				if( form_date == ''){
					errMsg += '<p>•• လခုနှစ်ဖြည့်ပါ</</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_no_malaria_treatment_given');
				$("#dm_form").submit();
			}

			function show_check_malaria_pq_notgiven()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>•• ပုံစံအမျိုးအစားဖြည့်ပါ</</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>•• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>•• မြို့နယ်ဖြည့်ပါ</</p>';
				}
				if( form_date == ''){
					errMsg += '<p>•• လခုနှစ်ဖြည့်ပါ</</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_malaria_pq_notgiven');
				$("#dm_form").submit();
			}
			
			function show_check_pf_or_mix_and_act_not_given()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_pf_or_mix_and_act_not_given');
				$("#dm_form").submit();
			}

			function show_check_pv_and_cq_not_given()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_pv_and_cq_not_given');
				$("#dm_form").submit();
			}

			
			function show_check_persons_with_pregnant_and_pq_given()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_persons_with_pregnant_and_pq_given');
				$("#dm_form").submit();
			}
			
			function show_check_under_age_1_year_and_pq_given()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_under_age_1_year_and_pq_given');
				$("#dm_form").submit();
			}
			
			function show_health_facilities_reported_and_forms_returned()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/health_facilities_reported_and_forms_returned');
				$("#dm_form").submit();
			}

			function show_check_form_number_for_each_health_facility()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_form_number_for_each_health_facility');
				$("#dm_form").submit();
			}
			
			function show_number_of_records_in_each_paper_form()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/number_of_records_in_each_paper_form');
				$("#dm_form").submit();
			}
			
			function show_number_of_months_reporting_delayed()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/number_of_months_reporting_delayed');
				$("#dm_form").submit();
			}
			
			function show_check_under_5_years_and_pq_given_by_vh()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_under_5_years_and_pq_given_by_vh');
				$("#dm_form").submit();
			}

			function show_check_village_and_vhv_names_onlyvhv()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_village_and_vhv_names_onlyvhv');
				$("#dm_form").submit();
			}
			
			function show_check_persons_with_pregnant_in_irrelevant_age()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_persons_with_pregnant_in_irrelevant_age');
				$("#dm_form").submit();
			}
			
			function show_check_sex_and_pregnancy()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_sex_and_pregnancy');
				$("#dm_form").submit();
			}
            
			function show_check_patient_screening_date()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_patient_screening_date');
				$("#dm_form").submit();
			}
			
			function show_check_patient_age_blank()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_patient_age_blank');
				$("#dm_form").submit();
			}
			
			function show_check_not_exam_and_text_missing()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/check_not_exam_and_text_missing');
				$("#dm_form").submit();
			}
			
			function show_find_duplicate_cases()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/find_duplicate_cases');
				$("#dm_form").submit();
			}
			
			function show_validate_10percent_of_data_entered_for_a_month()
			{
				var form_cat = $('#select_lp_form_cat_dm').val();
				var stateregion = $('#select_lp_stateregion_dm').val();
				var township = $('#select_lp_township_dm').val();
				var form_date = $('#dm-form-date').val();
				var errMsg = '';
				if( form_cat == '0'){
					errMsg += '<p>• ပုံစံအမျိုးအစားဖြည့်ပါ</p>';
				}
				if( stateregion == '0'){
					errMsg += '<p>• ပြည်နယ်တိုင်းဒေသကြီးဖြည့်ပါ</p>';
				}
				if( township == '0' || township == null){
					errMsg += '<p>• မြို့နယ်ဖြည့်ပါ</p>';
				}
				if( form_date == ''){
					errMsg += '<p>• လခုနှစ်ဖြည့်ပါ</p>';
				}
				if(errMsg != ''){
					bootbox.alert(errMsg);
					$('#select_lp_form_cat_dm').focus();
					return false;
				}
				$("#dm_form").attr('action', 'data-monitoring/validate_10percent_of_data_entered_for_a_month');
				$("#dm_form").submit();
			}

			function summary_of_examined_cases_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/summary_of_examined_cases_national');
				$("#nrpt_form").submit();
			}
			
			function summary_of_confirmed_cases_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/summary_of_confirmed_cases_national');
				$("#nrpt_form").submit();
			}
			
			function age_group_bse_result_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/age_group_bse_result_national');
				$("#nrpt_form").submit();
			}
			
			function export_dhis2_data_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/export_dhis2_data_national');
				$("#nrpt_form").submit();
			}
			
			function pudr_form_b_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/pudr_form_b_national');
				$("#nrpt_form").submit();
			}
			
			function export_pudr_annex_e_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/export_pudr_annex_e_national');
				$("#nrpt_form").submit();
			}
			
			function age_group_rdt_result_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/age_group_rdt_result_national');
				$("#nrpt_form").submit();
			}
			
			function malaria_mortality_and_morbidity_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/malaria_mortality_and_morbidity_national');
				$("#nrpt_form").submit();
			}

			function antenatal_mmm_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/antenatal_mmm_national');
				$("#nrpt_form").submit();
			}

			function under_5_mmm_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/under_5_mmm_national');
				$("#nrpt_form").submit();
			}

			function species_wise_examination_result_national()
			{
			var nrpt_sdate = $('#nrpt_sdate').val();
			var nrpt_edate = $('#nrpt_edate').val();
			var errMsg = '';
			if(nrpt_sdate.trim() == ''){
				errMsg += '<p>• စတင်သည့်ရက်ရွှေး</p>';
			}
			if(nrpt_edate.trim() == ''){
				errMsg += '<p>• ပြီးဆုံးသည့်ရက်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/species_wise_examination_result_national');
				$("#nrpt_form").submit();
			}
			
			function find_cases_duplicated()
			{
			var nrpt_stateregion = $('#select_lp_stateregion_nrpt').val();
			var nrpt_township = $('#select_lp_township_nrpt').val();
			var errMsg = '';
			if(nrpt_stateregion.trim() == ''){
				errMsg += '<p>• တိုင်းနှင့်ပြည်နယ်ရွှေး</p>';
			}
			if(nrpt_township.trim() == ''){
				errMsg += '<p>• မြို့နယ်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/find_cases_duplicated');
				$("#nrpt_form").submit();
			}
			
			function export_dashboard_data()
			{
				var nrpt_stateregion = $('#select_lp_stateregion_nrpt').val();
			var nrpt_township = $('#select_lp_township_nrpt').val();
			var errMsg = '';
			if(nrpt_stateregion.trim() == ''){
				errMsg += '<p>• တိုင်းနှင့်ပြည်နယ်ရွှေး</p>';
			}
			if(nrpt_township.trim() == ''){
				errMsg += '<p>• မြို့နယ်ရွှေး</p>';
			}
			if(errMsg != ''){
				bootbox.alert(errMsg);
				return false;
			}
				$("#nrpt_form").attr('action', 'national-reporting/export_dashboard_data');
				$("#nrpt_form").submit();
			}

			$('.select2').select2({})
				.one('select2-focus', OpenSelect2)
				.on("select2-blur", function (e) {
					console.log('this is select event : ', e);
					$(this).one('select2-focus', OpenSelect2)
				})

				function OpenSelect2() {
				var $select2 = $(this).data('select2');
				setTimeout(function() {
					if (!$select2.opened()) { $select2.open(); }
				}, 0);  
			}

        </script>
        <style>
            .callout{
                background-color: red;
            }
            .table-control-group {
                width: 100%;
            }

            .table-control-group td {
                padding: 3px;
            }

            .table-control-group td:first-child {
                text-align: right;
                padding-top: 7px;
                padding-right: 5px;
            }

            table.dataTable tbody tr td{
                text-align: left;
            }
            table.dataTable thead tr th{
                text-align: left;
            }

            [class^='select2'] {
                border-radius: 0px !important;
            }

            .select2-selection--single:hover,
            .select2-selection--single:active,
            .select2-selection--single:focus{
                border-color: #3c8dbc !important;
            }

            .btn:hover, .btn:active, .btn:focus{
                border-color: #3c8dbc !important;
            }
        </style>
    </body>
    </html>
