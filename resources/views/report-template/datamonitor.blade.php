{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>NMCP::Data Monitoring</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/tableexport.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .top-label {
            display: block;
            padding: 8px 10px;
            color: #7E7E7E;
            font-family: 'mmFont' !important;
        }

        .top-label-value {
            margin: 10px;
            border-bottom: 1px dotted gray;
            font-family: 'mmFont' !important;
            font-weight: 700;
            color: #000;
        }
    </style>
</head>

<body>
    <?php
    if ($data == null) {
        if (isset($valid_err) && $valid_err == 'true') {
            echo "<div class='alert alert-danger text-center' role='alert'>
                                                					<h4>သွေးဖောက်စစ်ဆေးသူအရေအတွက် (၁၀) ယောက်အောက်သာရှိ၍ ဖောင်အားလုံးတိုက်ဆိုင်စစ်ဆေးပါ။</h4><br><a href='#' onClick='window.close();'>ပိတ်မည်</a>
                                                				</div>";
        } elseif (isset($no_data) && $no_data == 'true') {
            echo "<div class='alert alert-danger text-center' role='alert'>
                                                						<h4>ယခုစစ်ဆေးမှုနှင့်သက်ဆိုင်သောအချက်အလက်များမရှိပါ။</h4><br><a href='#' onClick='window.close();'>ပိတ်မည်</a>
                                                					</div>";
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>
                                                						<h4>ယခုစစ်ဆေးမှုနှင့်သက်ဆိုင်သော အမှားမရှိပါ။</h4><br><a href='#' onClick='window.close();'>ပိတ်မည်</a>
                                                					</div>";
        }
        return false;
    }
    ?>
    <div class="wrap">
        <div>
            <div class="header">
                <span class="report-header">{{ $header_text }}</span>

                <div class="button-container">
                    <!-- <button type="button" class="btn btn-default no-print">
      <li class="fa fa-file-excel-o" /> <span>&nbsp;Save as Excel</span>
     </button>
     <button type="button" class="btn btn-default no-print">
      <li class="fa fa-file-pdf-o" /> <span>&nbsp;Save as PDF</span>
     </button> -->
                    <button type="button" class="btn btn-default no-print" onClick="window.print();">
                        <li class="fa fa-print"> <span>&nbsp;Print</span>
                    </button>
                    <button type="button" class="btn btn-default no-print" onClick="window.close();">Close</button>
                </div>
            </div>

            <label class='control-label top-label'>မြို့နယ်<span
                    class='top-label-value'>{{ $township }}</span></label>

            {{-- @if (isset($reported_hf_count))
                <label class="control-label top-label">ပုံစံပေးပို့သောကျန်းမာရေးဌာနစုစုပေါင်းအရေအတွက် - <span
                        class="top-label-value">{{ $reported_hf_count[0]->sum }}</span></label>

                <label class="control-label top-label">ပေးပို့သော form ပုံစံ စုစုပေါင်းအရေအတွက် - <span
                        class="top-label-value">{{ count($data) }}</span></label>

                <label class="control-label top-label">မြို့နယ်ရှိကျန်းမာရေးဌာနစုစုပေါင်း - <span
                        class="top-label-value">{{ $total_hfm }}</span></label>
            @endif --}}

            {{-- start add bymzh --}}
            @if (isset($reported_hf_count))
                <label class="control-label top-label">ပုံစံပေးပို့သောကျန်းမာရေးဌာနစုစုပေါင်းအရေအတွက် - <span
                        class="top-label-value">{{ $reported_hf_count[0]->sum }}</span></label>

                @if ($header_text === 'Number of records in Each Paper Form')
                    <label class="control-label top-label">ပေးပို့သော စုစုပေါင်းလူနာအရေအတွက် - <span
                            class="top-label-value">{{ collect($data)->sum('Number_Of_Records') }}</span></label>
                @else
                    <label class="control-label top-label">ပေးပို့သော form ပုံစံ စုစုပေါင်းအရေအတွက် - <span
                            class="top-label-value">{{ count($data) }}</span></label>
                @endif

                <label class="control-label top-label">မြို့နယ်ရှိကျန်းမာရေးဌာနစုစုပေါင်း - <span
                        class="top-label-value">{{ $total_hfm }}</span></label>
            @endif
            {{-- @php
                dd(collect($data)->sum('Number_Of_Records'));

            @endphp --}}
            {{-- end add bymzh --}}
            <div class="">
                <table id="report_table" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <?php
                            if (count($data) > 0) {
                                for ($i = 0; $i < 1; $i++) {
                                    $header_columns = $data[$i];
                                    echo '<th>No</th>';
                                    foreach ($header_columns as $key => $value) {
                                        $key = str_replace('_', ' ', $key);
                                        echo '<th>' . ucwords($key) . '</th>';
                                    }
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;
                        for ($i = 0; $i < count($data); $i++) {
                            echo '<tr>';
                            echo '<td>' . ++$counter . '</td>';
                            $current_row = $data[$i];
                            foreach ($current_row as $row) {
                                echo '<td>' . $row . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <?php

                            for ($f = 0; $f < 1; $f++) {
                                $header_columns = $data[$f];
                                $a = 1;
                                echo "<th id='tf_0'>No</th>";
                                foreach ($header_columns as $key => $value) {
                                    echo "<th id='tf_" . $a . "'>" . ucwords($key) . '</th>';
                                    $a = $a + 1;
                                }
                            }
                            ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/xlsx.core.min.js') }}"></script>
    <script src="{{ asset('js/FileSaver.js') }}"></script>
    <script src="{{ asset('js/Blob.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/tableexport.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/nmcp.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
    <script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js" type="text/javascript">
    </script>
    <style>
        * {
            font-family: calibri;
        }

        .header {
            color: white;
            font-weight: 700;
            background: #F9F9F9;
            margin-top: 0px;
            box-sizing: border-box;
            border-radius: 0px;
            width: 100%;
            border-bottom: 1px solid #DFDFDF;
            padding: 10px;
            padding-left: 10px;
            display: block;
            /*position: fixed;
   top: 0px;*/
        }

        #report_table {
            white-space: nowrap;
        }

        table.dataTable,
        table.dataTable th,
        table.dataTable td {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        /*thead{
   position: fixed;
   top: 50px;
   width: 100vh;
   display: block;
  }*/

        .report-header {
            font-size: 15px;
            color: #7E7E7E;
            margin: 0px;
            padding: 0px;
        }

        .button-container {
            float: right;
            display: block;
            margin: 0px;
            padding: 0px;
            margin-top: -7px;
            margin-right: 10px;
        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            td {
                border: 1px solid black;
                margin: 0px;
                padding: 0px;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            var table = document.getElementById("report_table");
            for (var i = 1; i < 2; i++) {
                var row = table.rows[1];
                for (var j = 0, col; col = row.cells[j]; j++) {
                    //bootbox.alert(col.headers);
                    if (parseInt(col.innerHTML) || col.innerHTML == "0" && col.headers != "PYear" && col.headers
                        .toLowerCase() != "pyear" &&
                        col.headers.toLowerCase() != "year" && col.headers.toLowerCase() != "monthcode" &&
                        col.headers != 'CQ' && col.headers != 'PQ' && col.headers != 'Form Code' && col.headers !=
                        'Row No') {
                        var totalVal = 0;
                        for (var r = 0, rw; rw = table.rows[r]; r++) {
                            if (parseInt(rw.cells[j].innerHTML) || rw.cells[j].innerHTML == "0") {
                                if (rw.cells[j].innerHTML == "0") {
                                    totalVal = totalVal + 0;
                                } else {
                                    totalVal = totalVal + parseInt(rw.cells[j].innerHTML);
                                }
                            }
                        }
                        console.log($("#tf_" + j).html());
                        if ($("#tf_" + j).html() == "PYear" || $("#tf_" + j).html() == "PMonth" || $("#tf_" + j)
                            .html() == "Agegroup" || $('#tf_' + j).html() == "Year" ||
                            $("#tf_" + j).html() == "CQ" || $("#tf_" + j).html() == "PQ" || $("#tf_" + j).html() ==
                            "Form_code" || $("#tf_" + j).html() === "Row_No" ||
                            $("#tf_" + j).html() === "Row_no" || $('#tf_' + j).html() == 'PQ_Given' || $('#tf_' + j)
                            .html() == "Pt_Location" ||
                            $('#tf_' + j).html() == "Referral" || $('#tf_' + j).html() == "Age_Year" || $('#tf_' +
                                j).html() == "age_year" || $('#tf_' + j).html() == "Form_No" ||
                            $('#tf_' + j).html() == "Screening_Date" || $('#tf_' + j).html() == "Row_count" || $(
                                '#tf_' + j).html() == "Form_Code" ||
                            $('#tf_' + j).html() == "Program_Date" || $('#tf_' + j).html() == "Data_Entry_Date" ||
                            $('#tf_' + j).html() == "Month_Delayed" || $('#tf_' + j).html() == "PYear:1" ||
                            $('#tf_' + j).html() == "No") {
                            $("#tf_" + j).html("");
                        } else {
                            $("#tf_" + j).html(totalVal);
                        }
                    } else {
                        $("#tf_" + j).html("");
                    }
                }
            }
        });

        $(document).ready(function() {
            var table = $('#report_table').DataTable({
                'paging': false,
                'autoWidth': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'select': false,
                'scrollX': true,
                fixedHeader: {
                    header: true,
                    footer: true
                }
            });

            // new $.fn.dataTable.FixedHeader( table );
        });
        $('table').tableExport({
            formants: ['xlsx', 'csv', 'txt'],
            bootstrap: true,
            footers: false,
            formats: ['xlsx', 'csv'],
            filename: '<?php echo $header_text; ?>',
            sheetname: 'sheet-one',
        });
    </script>

</body>

</html> --}}
