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
                                    <h3 class="box-title">All Users</h3>                            
                                </div>
                                <!-- /.box-header table_tbl_hfm-->
                                <div class="box-body">
                                <button type="button" class="btn btn-default btn-sm" id="btn_addnew" 
                                    onClick="insert_init()" >
                                    <li class="fa fa-user-plus" /> အသစ်ထည့်ရန်
                                </button>
                                <table id="table_grab_users" class="table table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>အမည်</th>
                                            <th>အီးမေးလ် (Login)</th>
                                            <th>Role ID</th>
                                            <th>Role Name</th>
                                            <th>Region Code</th>                                            
                                            <th>Region Name</th>
                                            <th width="50"></th>
                                            <th width="70"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="grab_users_container">
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user-> id }}</td>
                                                <td>{{ $user-> name }}</td>
                                                <td>{{ $user-> email }}</td>
                                                <td>{{ $user-> role_id }}</td>
                                                <td>{{ $user-> role_name_mmr }}</td>
                                                <td>{{ $user-> region_code }}</td>                                                
                                                <td>{{ $user-> region }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-warning btn-xs"
                                                        onclick="update_init(this)">
                                                        <li class="fa fa-pencil"></li> ပြင်ဆင်ရန်
                                                    </button>
                                                </td>
                                                <td>
                                                    <form method="post" action="users/delete" 
                                                        onsubmit="return confirm('{{ $user-> name }} အားအပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ။');">

                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{ $user-> id }}" name="id" />
                                                        <button type="submit" class="btn btn-block btn-danger btn-xs">
                                                            <li class="fa fa-trash"></li> အပီးဖျက်ရန်
                                                        </button>

                                                    </form>                                                    
                                                </td>
                                            </tr>                                        
                                        @endforeach
                                    </tbody>
                                </table>

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
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script-->
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
               
        <!-- DataTables -->
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        
        <script>

            $( document ).ready(function() {
                $('#table_grab_users').DataTable({
                    'paging': false,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'select': false,
                    "autoWidth": false,
                    "order": [
                        [0, "desc"]
                    ]
                });


                $("#btn_addnew").click(function(){
                    $("#btn_addnew")
                });
               

                // Initialize Select2 Elements
                $('.select2').select2();


            });

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

            function user_role_changed(role_id, region_code){     
                switch(role_id){
                    case "2": 
                            load_lp_stateregion('select_region_code', '<?=csrf_token();?>');
                        break;
                    case "3": 
                            load_lp_township('select_region_code', 'all', '<?=csrf_token();?>', region_code);
                        break;
                }      
                
            }

            function update_init(btn){
                var curIndex = $(btn).parent().parent().index();
                var table = document.getElementById("table_grab_users");

                var row = table.rows[curIndex+1];
                
                var id = row.cells[0].innerHTML;
                var name = row.cells[1].innerHTML;
                var email = row.cells[2].innerHTML;
                var role_id = row.cells[3].innerHTML;
                var region_code = row.cells[5].innerHTML;
                
                
                $("#modal-title").val("အချက်အလက်ပြုပြင်ရန်");
                $("#hidden_id").val(id);
                $("#txt_name").val(name);
                $("#txt_email").val(email);
                $("#select_user_role").val(role_id);

                user_role_changed(role_id, region_code);

                $("#userform").attr('action', 'users/update');
                
                $('#modal-addnew').modal('show');
            }

            function insert_init(){

                $('#userform').attr('action', 'users/save');                
                $("#modal-title").val("User အသစ်ထည့်ရန်");
                $("#hidden_id").val("");
                $("#txt_name").val("");
                $("#txt_email").val("");
                $("#select_user_role").val("0");
                $("#select_region_code").html("");

                $('#modal-addnew').modal('show');
            }

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

        <form method="post" action="users/save" id="userform">
        <div class="modal fade" id="modal-addnew">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">User အသစ်ထည့်ရန်</h4>
              </div>
              <div class="modal-body">
                
                
                    {{ csrf_field() }}
                    <input type="hidden" id="hidden_id" name="hidden_id" value="" />
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="txt_name" name="txt_name" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="txt_email" name="txt_email" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" class="form-control" id="txt_password" name="txt_password" required>
                    </div>

                    <div class="form-group">
                        <label for="select_user_role">Role</label>
                        <select class="form-control" name="select_user_role" 
                        id="select_user_role" required
                        onChange="user_role_changed(this.value, '')" 
                        style="width: 100%; font-size:small; padding: 5px;">
                            <option value="0">ရွေးရန်</option>
                            @foreach($user_roles as $user_role)
                                <option value="{{ $user_role->role_id }}">
                                {{ $user_role->role_name_mmr }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select_user_role">Region</label>
                        
                        <select name="select_region_code" id="select_region_code"  required                            
                            class="form-control select2 select_region_code" 
                            style="width: 100%; font-size:small; padding: 5px;">
                        </select>
                       
                    </div>
                
              
              </div>
              <div class="modal-footer">                
                <button class="btn btn-default btn-sm pull-left" data-dismiss="modal">
                    မသိမ်းပဲပိတ်မည်
                </button>
                <button class="btn btn-success btn-sm" type = "submit">
                    <li class="fa fa-floppy-o"></li> သိမ်းမည်
                </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        </form>

    </body>
    </html>
