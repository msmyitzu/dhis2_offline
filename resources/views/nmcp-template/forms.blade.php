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
            <section class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">ဌာနချုပ်သို့ပို့ဆောင်ပြီးသော အချက်အလက်များ</h3>
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
                                            <th>ဖျက်ရန်</th>
                                        </tr>
                                    </thead>

                                    <tbody id="grab_all_corefacility_container">
                                        <?php $counter = count($grab_all_corefacility); ?>
                                        @foreach ($grab_all_corefacility as $cf)
                                            <tr title="လူနာအချက်အလက်များကြည့်ရန် နှိပ်ပါ"
                                                id="tr_{{ $cf->cf_link_code }}"
                                                onClick="load_tbl_individual_case('{{ $cf->cf_link_code }}', this)">
                                                {{-- <td align="right" cf_code="{{ $cf->CF_Code }}">{{ $cf->CF_Code }}</td> --}}
                                                <th align="right" cf_code="{{ $cf->CF_Code }}">{{ $counter-- }}
                                                </th>
                                                <td align="left">{{ $cf->form_name }}</td>
                                                <td align="right">{{ $cf->Form_No }}</td>
                                                <td align="right">{{ $cf->PMonth }}/{{ $cf->PYear }}</td>
                                                <td align="left">{{ $cf->SC_Name_MM }}</td>
                                                <td align="left">{{ $cf->HF_Name_MM }}</td>
                                                <td align="left">{{ $cf->ts_name_mmr }}</td>
                                                <td align="left">{{ $cf->sr_name_mmr }}</td>
                                                <td align="left">
                                                    <?php
                                                    $date = date_create($cf->DE_DateTime);
                                                    echo date_format($date, 'd/m/Y H:i');
                                                    ?>
                                                </td>
                                                <td align="center" width="100px" id="td_0{{ $cf->cf_link_code }}">
                                                    <?php if($cf->delete_requested != "1"){ ?>
                                                    <button class="btn btn-danger btn-xs"
                                                        onclick="del_req({{ $cf->cf_link_code }},{{ $cf->CF_Code }},0);">
                                                        <li class="fa fa-trash"></li> ဖျက်ရန်
                                                    </button>
                                                    <?php } else { ?>
                                                    ...
                                                    <li class="fa fa-question-circle" title="ဖျက်ခွင့်တောင်းထားသည်" />
                                                    <?php } ?>
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
                                        <img src="img/default-loading.gif" style="width:20px; display:none;"
                                            id="patient_loader" />
                                    </div>
                                    <!-- /.box-header table_tbl_hfm-->
                                    <div class="box-body">
                                        <table id="table_tbl_individual_case" style="width:100%"
                                            class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    {{-- <th>P_Number</th> --}}
                                                    <th>Row No</th>
                                                    <th>Screening Date</th>
                                                    <th>Pt Name</th>
                                                    <th>Age</th>
                                                    <th>Patient Location</th>
                                                    <th>Pt Address</th>
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
                                                    <th width="200px">ဖျက်ရန်</th>
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

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">အချက်အလက်ဖျက်ခွင့်တောင်းခြင်း</h4>
                    </div>
                    <div class="modal-body">
                        <div class="callout callout-warning">
                            <h4>သတိ</h4>

                            <p>
                                ဖျက်လိုသည့်အချက်အလက်အား သေချာစွာစစ်ဆေးပြီး မှန်ကန်မှ ပို့ပါ။ ဌာနချုပ်တွင် ဖျက်ပြီးပါက
                                ပြန်လည်ရယူနိုင်ခြင်းမရှိပါ။
                                အောက်တွင် အကြောင်းအရင်းရေးပါ။
                            </p>

                            <input type="hidden" id="delete_cf_link_code" value="" />
                            <input type="hidden" id="delete_item_id" value="" />
                            <input type="hidden" id="delete_item_type" value="" />
                        </div>
                        <textarea class="form-control" id="delete_remark" rows="3" placeholder="အကြောင်းအရင်း.."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">ပိတ်မည်</button>
                        <button type="button" class="btn btn-primary" id="btn_send"
                            onClick="send_delete_request()">
                            <li class="fa fa-send"><span style="font-family : mmFont !important">ပို့မည်</span></li>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
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
        function del_req(cf_link_code, item_id, item_type) {
            $("#delete_item_type").val(item_type);
            $("#delete_cf_link_code").val(cf_link_code);
            $("#delete_item_id").val(item_id);
            $('#modal-default').modal('show');
        }

        function send_delete_request() {
            var cf_link_code = $("#delete_cf_link_code").val();
            var item_id = $("#delete_item_id").val();
            var item_type = $("#delete_item_type").val();
            var remark = $("#delete_remark").val();

            if (remark.trim() == "") {
                bootbox.alert("အကြောင်းအရင်းရေးပါ");
                return false;
            } else {
                $("#btn_send").html("<img src='img/default-loading.gif' height='18px' />");
                $("#btn_send").prop("disabled", true);
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (xmlhttp.responseText == "1") {
                            $("#td_" + item_type + cf_link_code).html(
                                '...<li class="fa fa-question-circle" title="ဖျက်ခွင့်တောင်းထားသည်" />');
                            $('#modal-default').modal('hide');
                            $("#btn_send").prop("disabled", false);
                            $("#btn_send").html('<li class="fa fa-send" /> ပို့မည်');
                        } else {
                            bootbox.alert(xmlhttp.responseText);
                            return false;
                        }
                    }
                }

                xmlhttp.open("POST", BACKEND_URL + "/send_delete_request", true);
                xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.send("cf_link_code=" + cf_link_code + "&item_id=" + item_id + "&item_type=" + item_type +
                    "&remark=" + remark);
            }


        }


        $('#table_grab_all_corefacility').DataTable({
            'paging': true,
            'lengthChange': false,
            "pageLength": 5,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'select': true,
            'scrollX': true,
            "order": [
                [0, "desc"]
            ]
        });

        var table_tbl_individual_case = $('#table_tbl_individual_case').DataTable({
            //"bDestroy": true,
            'paging': false,
            'lengthChange': false,
            // "pageLength": 5,
            'searching': true,
            'ordering': true,
            'info': false,
            'select': false,
            'scrollX': 'true',
            "order": [
                [0, "asc"]
            ]
        });



        function load_tbl_individual_case(cf_link_code, row) {
            //console.log(row);
            $(row).addClass("selected").siblings().removeClass("selected");
            $("#patient_loader").show();
            try {
                $.ajax({
                    type: "GET",
                    url: BACKEND_URL + 'get_grab_tbl_individual_case/' + cf_link_code,
                    data: "",
                    success: function(data) {

                        if ($.fn.DataTable.isDataTable("#table_tbl_individual_case")) {
                            $('#table_tbl_individual_case').DataTable().clear().destroy();
                        }

                        $("#tbl_individual_case_container").html('');

                        //console.log(data);
                        if (data.length > 0) {
                            jQuery.each(data, function(i, val) {
                                console.log(val);
                                var tr = "<tr>";
                                tr += "<td>" + val.Row_No + "</td>";
                                // tr += "<td>" + val.P_Number+ "</td>";
                                var d = new Date(val.Screening_Date);
                                var mth = parseInt(d.getMonth()) + 1;
                                var scr_date = d.getDate() + "/" + mth + "/" + d.getFullYear();
                                tr += "<td>" + scr_date + "</td>";
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
                                if (val.delete_requested == 0) {
                                    tr +=
                                        `<td align="center" width="100px" id="td_1${val.cf_link_code}"><button class="btn btn-danger btn-xs" onclick="del_req(${cf_link_code},${val.P_Number},1);"><li class="fa fa-trash"></li> ဖျက်ရန်</button></td>`;
                                    //tr += '<td align="center" width="100px" id="td_1"'+val.cf_link_code+'><button class="btn btn-danger btn-xs" onclick="del_req('+cf_link_code+',1);"><li class="fa fa-trash"></li> ဖျက်ရန်</button></td>';
                                } else {
                                    tr +=
                                        '<td align="center" width="100px">...<li class="fa fa-question-circle" title="ဖျက်ခွင့်တောင်းထားသည်" /></td>';
                                }
                                tr += "</tr>";
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
                            // "pageLength": 5,
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

        #table_tbl_individual_case td {
            white-space: nowrap;
        }

        #table_tbl_individual_case tr:nth-child(odd) {
            /*background: #F5F5F5;*/
        }
    </style>
</body>

</html>
