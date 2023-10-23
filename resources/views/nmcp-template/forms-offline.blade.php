<!DOCTYPE html>
<!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
<html>

<head>
    <meta charset="UTF-8">
    <title>National Malerial Control Programme</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
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
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/nmcp.js') }}"></script>
    <script src="{{ asset('js/bootbox.all.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <script>
        function goto_form(cf_link_code) {
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_existing_form_data/" + cf_link_code,
                success: datas => {
                    console.log(datas);
                    var formData = new FormData();
                    datas.map(data => {
                        formData.append('select_lp_form_cat', data.Form_Code);
                        formData.append('form_number', data.Form_No);
                        formData.append('select_lp_state_region', data.TS_Code.slice(0, 6));
                        formData.append('select_lp_township_de', data.TS_Code);
                        formData.append('select_tbl_hfm_de', data.HF_Code);
                        formData.append('select_hfm_de', data.SC_Code);
                        formData.append('form-date', data.PMonth + "/" + data.PYear);
                        formData.append('cf_link_code', data.cf_link_code);
                    });
                    $.ajax({
                        type: "POST",
                        url: BACKEND_URL + "patient-register-form",
                        contentType: false,
                        processData: false,
                        data: formData,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: data => {
                            // var newTab = window.open("", "_blank");
                            window.document.write(data);
                        }
                    });
                }
            });
        };

        function del_req(cf, sc_name) {
            var result = bootbox.confirm(sc_name + " နှင့်သက်ဆိုင်သောဒေတာအားလုံးဖျက်မည်။", function(result) {
                if (result == true) {
                    $.ajax({
                        method: "post",
                        url: BACKEND_URL + "delete_tbl_core_facility_by_code/" + cf,
                        data: {
                            "_token": '{{ csrf_token() }}'
                        },
                        success: function(response) {
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

        function del_individual_case(tr, pnumber, pname) {
            console.log($(tr).closest('tr'));
            if (pnumber != '') {
                var result = bootbox.confirm(pname + ' ၏အချက်အလက်ကိုဖျက်မည်။', function(result) {
                    if (result == true) {
                        $.ajax({
                            method: 'post',
                            url: BACKEND_URL + "delete_tbl_individual_by_code/" + pnumber,
                            data: {
                                "_token": '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                if (res == '1') $(tr).closest('tr').remove();
                            }
                        });
                    }
                });
            }
        }

        $(function() {
            $('#table_grab_all_corefacility').DataTable({
                'paging': true,
                'lengthChange': false,
                "pageLength": 5,
                'searching': true,
                'ordering': true,
                'info': true,
                'select': true,
                'scrollX': true,
                'autoWidth': false,
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

        function load_tbl_individual_case(cf_link_code, row) {
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

                        if (data.length > 0) {
                            jQuery.each(data, function(i, val) {
                                var tr = "<tr>";
                                tr += "<td>" + val.Row_No + "</td>";
                                var d = new Date(val.Screening_Date);
                                var mth = parseInt(d.getMonth()) + 1;
                                var scr_date = d.getDate() + "/" + mth + "/" + d.getFullYear();
                                tr += "<td>" + scr_date + "</td>";
                                var cls_name = val.Pt_Name.replace(/'/g, "");
                                tr += "<td>" + val.Pt_Name + "</td>";
                                tr += "<td>" + val.Age_Year + "</td>";
                                tr += "<td>" + val.village_mya_mmr3 + "</td>";
                                tr += "<td>" + val.Pt_Address + "</td>";
                                tr += "<td>" + sex_name(val.Sex_Code) + "</td>";
                                tr += "<td>" + yesno(val.Preg_YN) + "</td>";
                                tr += "<td>" + val.m_result + "</td>";
                                tr += "<td>" + val.r_result + "</td>";
                                tr += "<td>" + val.io_cat + "</td>";
                                tr += "<td>" + val.act_treatment + "</td>";
                                tr += "<td>" + val.CQ_Code + "</td>";
                                tr += "<td>" + val.PQ_Code + "</td>";
                                tr += "<td>" + val.t_given + "</td>";
                                tr += "<td>" + yesno(val.Referral_Code) + "</td>";
                                tr += "<td>" + yesno(val.Malaria_Death) + "</td>";
                                tr += "<td>" + yesno(val.travel_yn) + "</td>";
                                tr += "<td>" + val.occupation_name + "</td>";
                                var remark = val.Remark == "NULL" ? "-" : val.Remark;
                                tr += "<td>" + remark + "</td>";
                                tr += `<td><button class="btn btn-block btn-danger btn-xs" onclick="del_individual_case(this,${val.P_Number}, '${cls_name}');">
                                                    <li class="fa fa-trash"></li>ဖျက်ရန်
                                                </button></td></tr>`;
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

        $("tr").click(function() {
            //$(this).addClass("selected").siblings().removeClass("selected");
        });
    </script>

    <style>
        tr {
            cursor: pointer;
        }

        /*tbody tr:nth-child(odd) {background: #F5F5F5}*/
        tr.selected {
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

        .dataTables_scrollHead {
            padding: 0px;
            margin: 0px;
        }

        .sync_offline {
            color: silver;
            font-weight: bold;
        }

        /*thead th { border-bottom: 2px solid #E86156;}*/


        tbody tr:hover {
            background-color: #FFFFCB;
        }

        .table {
            margin-bottom: 0px;
        }

        #table_grab_all_corefacility thead tr th {
            vertical-align: middle;
            text-align: center;
        }

        #table_tbl_individual_case td {
            white-space: nowrap;
        }

        #table_tbl_individual_case tr:nth-child(odd) {
            /*background: #F5F5F5;*/
        }
    </style>
</body>

</html>
