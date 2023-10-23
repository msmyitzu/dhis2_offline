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
