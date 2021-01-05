<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>National Malerial Control Program</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- Select2 -->
        <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"-->
        <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Theme style -->
        <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
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
                            <h3 class="box-title">Health Facilities</h3>
                            <span id="table_tbl_hfm_loader"><img src='img/default-loading.gif' style="width:20px;" /></span>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <table id="table_tbl_hfm" class="table table-bordered table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>SC_Code</th>
                                        <th>HF_Code</th>
                                        <th>TS_Code</th>
                                        <th>HFTypeID</th>
                                        <th>SC_Name</th>
                                        <th>SC_Name_MM</th>
                                        <th>Org</th>
                                        <th>MIMU_Code</th>
                                        <th>HF_CodeReport</th>
                                        <th>HF_CodeReportingUnit</th>
                                        <th>FocalPerson</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="lp_tbl_hfm_container">

                                </tbody>
                            </table>
                        </div>
                        <!-- Custom Tabs -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        {{-- <script src="{{ asset ('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Select2 -->     
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script-->
        <script src="{{ asset ('bower_components/select2/dist/js/select2.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Morris.js charts -->
        <script src="{{ asset ('bower_components/raphael/raphael.min.js')}}"></script>
        <script src="{{ asset ('bower_components/morris.js/morris.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{ asset ('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <!-- jvectormap -->
        <script src="{{ asset ('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{ asset ('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset ('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset ('bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{ asset ('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <!-- datepicker -->
        <script src="{{ asset ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset ('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{--<script src="{{ asset ('bower_components/admin-lte/dist/js/pages/dashboard.js')}}"></script>--}}
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset ('bower_components/admin-lte/dist/js/demo.js')}}"></script>
        <!-- DataTables -->
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        <script>
            load_lp_tbl_hfm();

            $(function() {
                

                // Initialize Select2 Elements
                $('.select2').select2();

                //Datemask dd/mm/yyyy
                /*$('#datemask').inputmask('dd/mm/yyyy', {
                        'placeholder': 'dd/mm/yyyy'
                    })
                    //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {
                        'placeholder': 'mm/dd/yyyy'
                    })
                    //Money Euro
                $('[data-mask]').inputmask()*/

                //Date range picker
                $('#reservation').daterangepicker()
                    //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        format: 'MM/DD/YYYY h:mm A'
                    })
                    //Date range as a button
                $('#daterange-btn').daterangepicker({
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function(start, end) {
                        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    }
                )

                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                })

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    })
                    //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                        checkboxClass: 'icheckbox_minimal-red',
                        radioClass: 'iradio_minimal-red'
                    })
                    //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                    //color picker with addon
                $('.my-colorpicker2').colorpicker()

                //Timepicker
                $('.timepicker').timepicker({
                    showInputs: false
                })
            })

            load_lp_form_cat('select_lp_form_cat','<?=csrf_token();?>');

            
        </script>
        <style>
           
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

            /*table.dataTable thead tr {
                background-color: #4c4c4c;
                color: white;
            } */  
            [class^='select2'] {
                border-radius: 0px !important;
            }       
        </style>
    </body>
    </html>
