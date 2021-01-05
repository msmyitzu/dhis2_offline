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
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="{{asset ('bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
        
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
                                    <h3 class="box-title">မြို့နယ်/တိုက်နယ်ဆေးရုံ/ကျန်းမာရေးဌာန/ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ</h3>                            
                                </div>
                                <!-- /.box-header table_tbl_hfm-->
                                <div class="box-body">
                                <table id="table_tbl_hfm" class="table table-bordered nowrap">
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
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                            <th>HF_CodeReport</th>
                                            <th>HF_CodeReportingUnit</th>
                                            <th>FocalPerson</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Date_Updated</th>
                                            <th>hfm_id</th>
                                        </tr>
                                    </thead>

                                    <tbody id="grab_all_corefacility_container">
                                        @foreach($tbl_hfm as $hfm)
                                            <tr>
                                                <td>{{ $hfm->SC_Code }}</td>
                                                <td>{{ $hfm->HF_Code }}</td>
                                                <td>{{ $hfm->TS_Code }}</td>
                                                <td>{{ $hfm->HFTypeID }}</td>
                                                <td>{{ $hfm->SC_Name }}</td>
                                                <td>{{ $hfm->SC_Name_MM }}</td>
                                                <td>{{ $hfm->Org }}</td>
                                                <td>{{ $hfm->MIMU_Code }}</td>
                                                <td>{{ $hfm->Longitude }}</td>
                                                <td>{{ $hfm->Latitude }}</td>
                                                <td>{{ $hfm->HF_CodeReport }}</td>
                                                <td>{{ $hfm->HF_CodeReportingUnit }}</td>
                                                <td>{{ $hfm->FocalPerson }}</td>
                                                <td>{{ $hfm->Start }}</td>
                                                <td>{{ $hfm->End }}</td>
                                                <td>{{ $hfm->Date_Updated }}</td>
                                                <td>{{ $hfm->hfm_id }}</td>
                                            </tr>                                        
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $tbl_hfm->links() }}
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
        {{-- <script src="{{ asset ('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Select2 -->     
        
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
               
        <!-- DataTables -->
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        
        <script>

            $( document ).ready(function() {
                $('#table_tbl_hfm').DataTable({
                    'paging': false,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'select': false,
                    'scrollX': true,
                    "order": [
                        [0, "desc"]
                    ]
                });
            });

        </script>

        <style>
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

            #table_tbl_hfm td{
                white-space: nowrap;
            }
        </style>
    </body>
    </html>
