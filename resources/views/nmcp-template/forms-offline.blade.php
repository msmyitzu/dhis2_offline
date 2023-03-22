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
        <link href="{{ asset ('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
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
                                <h3 class="box-title">ဌာနချုပ်သို့မပို့ဆောင်ရသေးသော အချက်အလက်များ</h3>                            
                            </div>
                            <!-- /.box-header table_tbl_hfm-->
                            <div class="box-body">
                            <table id="table_grab_all_corefacility" class="table table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th align="right">No</th>
                                        <th align="left">Form_Name</th>
                                        <th align="right">Form_No</th>
                                        <th align="right">Form_Date</th>
                                        <th align="left">SC_Name_MM</th>
                                        <th align="left">RHC_Name_MM</th>
                                        <th align="left">TS_Name_MM</th>
                                        <th align="left">SR_Name_MM</th>
                                        <th align="left">DE_DateTime</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id="grab_all_corefacility_container">
                                    <?php 
                                        $counter = 0;
                                        $core_count = count($grab_all_corefacility_temp);
                                    ?>
                                    @foreach($grab_all_corefacility_temp as $cf)
                                        <tr title="လူနာအချက်အလက်များကြည့်ရန် နှိပ်ပါ" id="tr_{{ $cf->cf_link_code }}"
                                            onClick="load_tbl_individual_case('{{ $cf->cf_link_code }}', this)">
                                            <td align="right" cf_code="{{ $cf->CF_Code }}">{{ $core_count-- }}</td>
                                            {{--<td align="right" cf_code="{{ $cf->CF_Code }}">{{ $cf->CF_Code }}</td>--}}
                                            <td align="left">{{ $cf->form_name }}</td>
                                            <td align="left">{{ $cf->Form_No }}</td>
                                            <td align="right">{{ $cf->PMonth }}/{{ $cf->PYear }}</td>
                                            <td align="left">{{ $cf->SC_Name_MM }}</td>
                                            <td align="left">{{ $cf->HF_Name_MM }}</td>
                                            <td align="left">{{ $cf->ts_name_mmr }}</td>
                                            <td align="left">{{ $cf->sr_name_mmr }}</td>
                                            <td align="left">
                                                <?php                                                      
                                                    $date = date_create($cf->DE_DateTime);
                                                    echo date_format($date,"d/m/Y H:i");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    switch($cf->sync){
                                                        case "0": echo "<span class='sync_offline'>offline</span>"; break;
                                                        case "1": echo "<span class='sync_online'>online</span>"; break;
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" style="width:max-content">
                                                    <button title="ဖောင်သို့သွားရန်" type="buttom" class="btn btn-info btn-xs" 
                                                        onClick="goto_form('{{ $cf->cf_link_code }}')">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button title="ဖောင်ဖျက်ရန်" type="button" class="btn btn-danger btn-xs" cf_link_code="{{ $cf->cf_link_code }}" 
                                                        onClick="del_req('{{ $cf->cf_link_code }}','{{ $cf->SC_Name_MM }}');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Custom Tabs -->
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">လူနာအချက်အလက်များ</h3>  
                                <img src="img/default-loading.gif" style="width:20px; display:none;" id="patient_loader" />                          
                            </div>
                            <!-- /.box-header table_tbl_hfm-->
                            <div class="box-body">
                            <table id="table_tbl_individual_case" style="width:100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        {{--<th>P_Number</th>--}}
                                        {{--<th>CF_Code</th>--}}
                                        <th>Row No</th>
                                        <th>Screening Date</th>
                                        <th>Pt Name</th>
                                        <th>Age</th>
                                        <th>Patient Location</th>
                                        <th>Patient Address</th>
                                        <th>Sex Code</th>
                                        <th>Preg YN</th>
                                        <th>Micro Result</th>
                                        <th>RDT Result</th>
                                        <th>I/O Cat</th>
                                        <th>ACT Treatment</th>
                                        <th>CQ Code</th>
                                        <th>PQ Code</th>
                                        <th>T Given</th>
                                        <th>Referral Code</th>
                                        <th>Malaria Death</th>
                                        <th>Travel YN</th>
                                        <th>Occupation</th>
                                        <th>Remark</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="tbl_individual_case_container">
                                    
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
        <script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{ asset ('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset ('js/nmcp.js')}}"></script>
        <script src="{{ asset ('js/bootbox.all.min.js') }}"></script>
        <script src="{{ asset ('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
        <script>

            function goto_form(cf_link_code){
                $.ajax({
                    type : "GET",
                    url : BACKEND_URL + "get_existing_form_data/" + cf_link_code ,
                    success : datas => {
                        console.log(datas);
                        var formData = new FormData() ;
                        datas.map( data => {
                            formData.append('select_lp_form_cat', data.Form_Code);
                            formData.append('form_number', data.Form_No);
                            formData.append('select_lp_state_region', data.TS_Code.slice(0,6));
                            formData.append('select_lp_township_de', data.TS_Code);
                            formData.append('select_tbl_hfm_de', data.HF_Code);
                            formData.append('select_hfm_de', data.SC_Code);
                            formData.append('form-date', data.PMonth + "/" + data.PYear);
                            formData.append('cf_link_code', data.cf_link_code) ;
                        });
                        $.ajax({
                            type : "POST",
                            url : BACKEND_URL + "patient-register-form",
                            contentType: false,
                            processData: false,
                            data : formData,
                            headers : {
                                "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                            },
                            success : data => {
                                // var newTab = window.open("", "_blank");
                                window.document.write(data);
                            }  
                        });
                    }
                });
            };

            function del_req(cf, sc_name){
                var result = bootbox.confirm(sc_name + " နှင့်သက်ဆိုင်သောဒေတာအားလုံးဖျက်မည်။", function(result){
                    if(result == true){
                        $.ajax({
                            method: "post",
                            url: BACKEND_URL + "delete_tbl_core_facility_by_code/" + cf,
                            data:{"_token" : '{{ csrf_token() }}'},
                            success: function(response){
                                location.reload();
                                // $('#table_grab_all_corefacility').DataTable().ajax.reload();
                                // if ($.fn.DataTable.isDataTable("#table_grab_all_corefacility")) {
                                //     $('#table_grab_all_corefacility').DataTable().clear().destroy();
                                // }
                            }
                        });
                    }
                });
            }

            function del_individual_case(tr, pnumber, pname)
            {
                console.log($(tr).closest('tr'));
                if(pnumber != ''){
                    var result = bootbox.confirm(pname + ' ၏အချက်အလက်ကိုဖျက်မည်။', function(result){
                        if( result == true){
                            $.ajax({
                                method : 'post',
                                url : BACKEND_URL + "delete_tbl_individual_by_code/" + pnumber,
                                data:{"_token" : '{{ csrf_token() }}'},
                                success : function(res){
                                    if(res == '1') $(tr).closest('tr').remove();
                                }
                            });
                        }
                    });
                }
            }

            $(function(){
                $('#table_grab_all_corefacility').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    "pageLength": 5,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'select': true,
                    'scrollX' : true,
                    'autoWidth' : false,
                    "order": [
                        [0, "desc"]
                    ]
                });

                var table_tbl_individual_case = $('#table_tbl_individual_case').DataTable({
                    //"bDestroy": true,
                    'paging': true,
                    'lengthChange': false,
                    "pageLength": 5,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'select': false,
                    'scrollX': true,
                    "order": [
                        [0, "asc"]
                    ]
                });
            });

            $(window).on('load', () => {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            function load_tbl_individual_case(cf_link_code, row){
                //console.log(row);
                $(row).addClass("selected").siblings().removeClass("selected");
                $("#patient_loader").show();
                try {
                    $.ajax({
                        type: "GET",
                        url: window.location.origin + '/get_grab_tbl_individual_case_temp/' + cf_link_code,
                        data: "",
                        success: function(data) {
							console.log(data);

                            if ($.fn.DataTable.isDataTable("#table_tbl_individual_case")) {
                                $('#table_tbl_individual_case').DataTable().clear().destroy();
                            }

                            $("#tbl_individual_case_container").html('');
                            
                            if(data.length > 0){
                                jQuery.each(data, function(i, val) {
                                    var tr = "<tr>";
                                    tr += "<td>" + val.Row_No +"</td>";
                                    var d = new Date(val.Screening_Date);
                                    var mth = parseInt(d.getMonth())+1;
                                    var scr_date = d.getDate()+"/"+ mth +"/"+d.getFullYear();
                                    tr += "<td>" + scr_date + "</td>";
                                    var cls_name = val.Pt_Name.replace(/'/g,"");
                                    tr += "<td>" + val.Pt_Name + "</td>";
                                    tr += "<td>" + val.Age_Year + "</td>";
                                    tr += "<td>" + val.village_mya_mmr3+ "</td>";
                                    tr += "<td>" + val.Pt_Address+ "</td>";
                                    tr += "<td>" + sex_name(val.Sex_Code) + "</td>";
                                    tr += "<td>" + yesno(val.Preg_YN) + "</td>";
                                    tr += "<td>" + val.m_result + "</td>";
                                    tr += "<td>" + val.r_result+ "</td>";
                                    tr += "<td>" + val.io_cat+ "</td>";
                                    tr += "<td>" + val.act_treatment+ "</td>";
                                    tr += "<td>" + val.CQ_Code+ "</td>";
                                    tr += "<td>" + val.PQ_Code+ "</td>";
                                    tr += "<td>" + val.t_given+ "</td>";
                                    tr += "<td>" + yesno(val.Referral_Code) + "</td>";
                                    tr += "<td>" + yesno(val.Malaria_Death) + "</td>";
                                    tr += "<td>" + yesno(val.travel_yn) + "</td>";
                                    tr += "<td>" + val.occupation_name+ "</td>";
                                    var remark = val.Remark == "NULL" ? "-" : val.Remark;
                                    tr += "<td>" + remark + "</td>";
                                    tr += `<td><button class="btn btn-block btn-danger btn-xs" onclick="del_individual_case(this,${val.P_Number}, '${cls_name}');">
                                                    <li class="fa fa-trash"></li>ဖျက်ရန်
                                                </button></td></tr>` ;
                                    // tr += "<td>" + val.P_Number+ "</td>";
                                    // tr += "<td>" + val.CF_Code+ "</td>";
                                    // tr += "<td>" + remark + "</td>";
                                    $("#tbl_individual_case_container").append(tr);
                                });
                            } else {
                                /*var tr = '<tr>';
                                tr += "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
                                tr += "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
                                tr += "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
                                
                                $("#tbl_individual_case_container").append(tr);*/
                            }
                            $("#patient_loader").hide();
                            //table_tbl_individual_case.clear().draw();

                            $('#table_tbl_individual_case').DataTable({
                                'paging': false,
                                'lengthChange': false,
                                "pageLength": 20,
                                'searching': true,
                                'ordering': true,
                                'info': false,
                                'select': false,
                                'scrollX': true,
                                "order": [
                                    [0, "asc"]
                                ]
                            });
                        }
                    });
                } catch (error) {
                    bootbox.alert(error.message);
                }
            }
/*
            $("tr").click(function(){
                $(this).addClass("selected").siblings().removeClass("selected");
            })​*/

            $( "tr" ).click(function() {
                //$(this).addClass("selected").siblings().removeClass("selected");
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

            #table_grab_all_corefacility thead tr th{
                vertical-align: middle;
                text-align: center;
            }

            #table_tbl_individual_case td{
                white-space: nowrap;
            }
           
            #table_tbl_individual_case tr:nth-child(odd) {
                /*background: #F5F5F5;*/
            }
        </style>
    </body>
    </html>
