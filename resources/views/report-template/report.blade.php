<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>NMCP::Reporting</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/admin-lte/dist/css/skins/skin-red.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/tableexport.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .top-label {
            padding: 20px 10px;
            color: #7E7E7E;
        }

        .top-label-value {
            border-bottom: 1px dotted gray;
            margin: 10px;
        }
    </style>

</head>

<body>
    <?php
    if ($data == null) {
        echo "<div class='alert alert-danger text-center' role='alert'>
    					<strong>အချက်အလက်မရှိပါ။ <br><a href='#' onClick='window.close();'>ပိတ်မည်</a></strong>
    				</div>";
        return false;
    }
    ?>
    <div class="wrap">
        <div>
            <div class="header">
                <span class="report-header">{{ $header_text }}</span>

                <div class="button-container">
                    <!--- <button type="button" class="btn btn-default no-print" onClick="export_excel()">
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
            <?php
			 if(isset($township)){
			 ?>
            <label class="control-label top-label">မြို့နယ်<span
                    class="top-label-value">{{ $township }}</span></label>
            <?php } ?>

            <div class="">
                <table id="report_table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <?php

						if (count($data) > 0 || count($data) != "null") {
							for($i=0; $i<1; $i++){
									$header_columns = $data[$i];
									echo "<th>No</th>" ;
									foreach($header_columns as $key=>$value){
                                        if($header_text != "Export Dashboard Data")
										$key = str_replace("_", " ", $key);
										echo "<th>". ucwords($key) ."</th>";
									}
								}
							}else{
								echo "<div class='alert alert-danger' role='alert'>
								<strong>There is no Data.</strong>
								</div>";
							}
						?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;
                        for ($i = 0; $i < count($data); $i++) {
                            echo '<tr><td>' . ++$counter . '</td>';
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
    <!-- <form action="../export" method="post" target="_blank">
  <textarea name="data"><?php echo json_encode($data); ?></textarea>
  <input type="submit" value="Export" />
 </form> -->
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <!-- Table Export JS -->
    <script src="{{ asset('js/xlsx.core.min.js') }}"></script>
    <script src="{{ asset('js/Blob.js') }}"></script>
    <script src="{{ asset('js/FileSaver.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/tableexport.min.js') }}"></script>
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
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
    <script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js" type="text/javascript">
    </script>
    <script>
        $(document).ready(function() {
            var table = document.getElementById("report_table");
            for (var i = 1; i < 2; i++) {
                var row = table.rows[1];
                for (var j = 0, col; col = row.cells[j]; j++) {
                    console.log("this is col headers : ", col);
                    //bootbox.alert(col.headers);
                    if (parseInt(col.innerHTML) || col.innerHTML == "0" && col.headers != "PYear" && col.headers
                        .toLowerCase() != "pyear" && col.headers.toLowerCase() != "year" && col.headers
                        .toLowerCase() != "monthcode") {
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
                        console.log(totalVal);
                        //console.log($("#tf_"+j).html());
                        if ($("#tf_" + j).html() == "PYear" || $("#tf_" + j).html() == "PMonth" || $("#tf_" + j)
                            .html() == "Agegroup" || $("#tf_" + j).html() == "AgeGroup" ||
                            $("#tf_" + j).html() == "No") {
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
    </style>

    <script>
        /*$('#report_table').DataTable( {
    			'paging': false,
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
    		} );*/

        $(document).ready(function() {
            var table = $('#report_table').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'select': false,
                'scrollX': true,
            });

            // $(window).on('scroll', function(e){
            // 	$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            // });

            new $.fn.dataTable.FixedHeader(table);
        });



        $('table').tableExport({
            //headers:true,
            //footers:true,
            bootstrap: true,
            footers: false,
            formats: ['xlsx', 'csv'],
            filename: "<?php echo $header_text; ?>",
        });
    </script>

</body>

</html>
