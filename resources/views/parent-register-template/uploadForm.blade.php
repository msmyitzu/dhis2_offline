<!-- Font Awesome Icons -->
<link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />

{{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script> --}}

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>

<style>

/* HTML: <div class="loader"></div> */


	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}


    .header_bar {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 50px;
        background-color: rgb(44, 102, 147);

    }

    .navbar {
        list-style: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        /* Adjust as needed */
        color: white;
        /* Adjust as needed */
        padding: 10px;
        /* Adjust as needed */
    }

    .btnSearchs {}

    .table-bordered{
        border-top:1px solid gray !important;
        width:90% !important;
        justify-content: center !important;
        margin-left:70px;

    }

    .theads th {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        font-size: 16px !important;
    }

    .tbodys {
        margin-bottom: 0px;
        padding:10px;
        /* font-weight:0 !important; */
        font-size: 12px !important;
        color:#333;

        height: 35px;

        padding-left: 20px;
}


    .upload_to_online_btn {
        margin-left: auto;
        /* Pushes the "Upload to Online" list item to the right */
    }

    /* .form-group{
width: 100% !important;
} */

    .back_arrow {
        float: left;
        padding: 15px 15px;
        font-size: 15px;
        color: #fff;

    }

    .back_arrow:hover {
        font-size: 20px;
        color: rgb(192, 193, 197);
    }

    .tableCell {
        align-items: left;
        justify-content: space-between;
        display: flex;
    }

    .box-body {
        margin-left: 20%;
        margin-right: 10%;
    }

    table.dataTable thead tr th {
        text-align: center;
        padding: 5px;
        background-color: #7c6c6c;
    }

    .table-container {
        /* margin: 20px; */
        padding: 20px;

        overflow-x: auto;
        width: 100%;
        max-width: 100%;
        margin-bottom: 10px;
    }

    table {
        width: 80%;
        white-space: nowrap;
        margin: auto;
        vertical-align: middle;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #tbl_iop {
        font-size: 12px !important;
        font-weight: 600 !important;
        color: #555 !important;
    }

    #tbl_iop>#tbody_iop>tr:nth-child(odd),
    #tbl_iop>#tbody_iop>tr:nth-child(even) {
        text-align: right !important;
    }

    #tbody_iop>tr>td>input {
        font-size: 12px;
        font-weight: 600;
        border: none !important;
        width: 40px !important;
        height: 30px;
        border-bottom: 1px dotted gray !important;
    }

    #tbody_iop>tr>td>input:focus {
        outline: none !important;
    }

    table.dataTable thead tr {

        color: white;
    }

    .dataTables_wrapper .dataTables_paginate {
            float: right !important;
            text-align: right;
            margin-bottom: 5px;
        }

    .engRows {
        background-color: #7c6c6c !important;
    }

    .sec-row-input {
        font-size: 12px;
        border: none;
        border-bottom: 2px dotted blue;
        font-weight: 600;
        text-align: center;
        width: 35px;
    }

    .sec-label {}

    .delete_icon {
        margin: 3px;
        color: red;
    }

    .top-label-value {
        border-bottom: 2px dotted grey;
        padding: 5px 10px;
        font-weight: 600;
        color: black;
    }

    .top-label {
        font-size: 12px;
        margin-right: 35px;
        color: #555;
        font-weight: 600;
    }

    .wrap {
        padding-right: 20px;
        padding-left: 20px;
        margin-right: auto;
        margin-left: auto;
    }

    .first-row,
    .sec-row,
    .third-row {
        margin-bottom: 15px;
        padding: 0 5px;
    }

    .label-right {
        text-align: right;
    }

    .header {
        color: white;
        font-weight: 700;
        background: #D3492E;
    }

    .mmtext-12 {
        font-size: 12px;
        color: #555;
        font-weight: normal;
    }

    .mmtext-10 {
        font-size: 10px;
        color: #555;
    }

    .mmtext-8 {
        font-size: 8px;
        color: #555;
    }

    .custom-col-1 {
        width: 8.333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-2 {
        width: 16.66666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-3 {
        width: 25%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-4 {
        width: 33.33333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-5 {
        width: 41.666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-6 {
        width: 50%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-7 {
        width: 58.333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-8 {
        width: 66.666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-9 {
        width: 75%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-10 {
        width: 83.333333%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .custom-col-11 {
        width: 91.666667%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }

    th{
        border-top:1px solid gray;
    }

    .table>thead>tr>th,
    .table>tbody>tr>td {
        text-align: center;
        vertical-align: middle;
        padding: 20px;
        border: 1px solid gray;
        padding: 0px;
        margin: 0px;
        font-weight: 600;
    }

    .btn-group {

        position: relative;
        margin-top: 16px;
        /* display: inline-block; */
        vertical-align: middle;
        /* padding: 10px; */
        margin-left: 20px;
        /* align-items: center; */
    }



    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        padding: 0px;
        width: 100%;
        height: 50px !important;
    }

    #data_entry_body>tr>td>input {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        width: 100%;
        padding: 0px;
        margin: 0px;
        border: none;
        height: 50px !important;
        font-weight: 600;
    }

    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        height: 20px;
        width: 100%;
        border: none;
        height: 50px;
        font-weight: 600;
    }

    #data_entry_body>tr>td>input:focus {
        font-size: 12px;
        color: #000;
        outline: none;
        background-color: #bdbdbd !important;
    }

    #data_entry_body>tr>td>select:focus {
        outline: none;
        background-color: #bdbdbd !important;
    }

</style>

<div class="header_bar">
    <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="https://mcbrs-dev2.myanmarvbdc.com/" class="" data-toggle="">
                <img src="{{ asset('img/logo.png') }}" class="user-image" alt="User Image">
                <span class="card-title"> Malaria Case-Based Reporting for VBDC Myanmar </span>
            </a>
        </li>
        <li>
            <a href="/home" class="" id="">Go To HomePage</a>
        </li>
    </ul>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header" style="text-align:center;padding-top:20px;">
                <h3 class="box-title">သိမ်းထားသောပုံစံများ</h3>
            </div>
            <div>
                <form  method="GET" action="#">
                    <!-- <input type="hidden" name="_token" value="Eu7aH4i70ibviYKFqAcvBAELd33uD9TII5BNB7yO"> -->
                    <div class="row"style="padding:15px;">
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">တိုင်းနှင့်ပြည်နယ်</label>
                                <select class="form-control input-sm select2 search_state" name="sr_search"
                                    id="region_data" formaction="{{ route('form_search', ['type' => 'sr_search']) }}">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($state_region as $stateRegion)
                                        <option value="{{ $stateRegion->region_mmr }}">
                                            {{ $stateRegion->region_name_en }} | {{ $stateRegion->region_name_mm }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3" hidden>
                            <div class="form-group" style="width:100%;">
                                <label class="control-label">ခရိုင်</label>
                                <select id="district_data" class="form-control input-sm select2 search_township"
                                    name="ts_search"  style="width: 100%">
                                    <option value="">ရွေးပါ</option>
                                    @foreach ($district as $dst)
                                        <option value="{{ $dst->township_id }}">
                                            {{ $dst->district_name_mmr }} | {{ $dst->district_name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group" style="width:100%;">
                                <label class="control-label">မြို့နယ်</label>
                                <select id="township_data" class="form-control input-sm select2 search_township" formaction="{{ route('form_search', ['type' => 'ts_search']) }}"
                                    name="ts_search" style="width: 100%">
                                    <option value="">ရွေးပါ</option>

                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Health Facility</label>

                                <select id="hf_data" class="form-control input-sm" name="hf_search"
                                    style="width: 100%;">
                                    <option value="">ရွေးပါ</option>

                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sub Center</label>

                                <select id="subcenter_data" class="form-control input-sm " name="sub_center_search"
                                    style="width:100%;">
                                    <option value="">ရွေးပါ</option>

                                </select>

                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">VHV</label>

                                <select id="vhv_data" class="form-control input-sm " name="vhv_search"
                                    style="width:100%;">
                                    <option value="">ရွေးပါ</option>

                                </select>

                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">

                                <label class="control-label">စတင်သည့်ရက် လ/ခုနှစ်</label>
                                <input type="month" min="2022-01" class="form-control input-sm search_date" id="sdate_input"
                                    name="sdate_search" placeholder="Start Date" formaction="{{ route('form_search', ['type' => 'sdate_search']) }}" autocomplete="off"
                                    style="width: 100%;">
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">ပြီးဆုံးသည့်ရက် လ/ခုနှစ်</label>
                                <input type="month" class="form-control input-sm search_date" id="edate_input"
                                    name="edate_search" placeholder="End Date" autocomplete="off">
                                {{-- <input type="text" class="form-control text-center" id="form-date" name="form-date"
                                    autocomplete=off placeholder="လ / ခုနှစ်" readonly>
                            </div>
                        </div>--}}


                                <div class="col-md-3 col-md-offset-9" style="padding: 15px;">
                                    <div class="form-group">
                                        {{-- <label class="control-label">Search:</label> --}}
                                        <div class="input-group input-group-sm">
                                            <input type="search" class="form-control" placeholder="Search" name="search" value="{{ request()->get('search') }}">
                                            <span class="input-group-btn">
                                                <button type="submit" id="edate_search" class="btn btn-info btn-flat">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    </div>
                                </div>








                    </div>
                </form>

               <div class="tables" style="height:100%;">

                <table id="table_grab_all_corefacility" class="table table-bordered">
                    <thead>
                        <tr class="theads">
                            <!--th>No</th-->
                            <th align="right">မြို့နယ်ကျန်းမာရေးဌာန</th>
                            <th align="left">လူနာအချက်အလက်မှတ်တမ်း</th>
                            <th align="right">ရိုက်သွင်းသည့်နေ့အစ</th>
                            <th align="right">ရိုက်သွင်းသည့်နေအဆုံး</th>
                            <th align="right"></th>

                        </tr>
                    </thead>

                    @foreach ($groupedCases as $case)
                        <tbody id="grab_all_corefacility_container" class="tbodys">


                            <tr>

                                <td align="right" hidden>

                                    {{ $case->pt_current_township }}
                                </td>
                                <td align="right">

                                    {{ $case->township_name_en }}
                                </td>
                                <td align="left">{{ $case->count }}</td>
                                <td align="right">{{ $case->start_date }}</td>
                                <td align="right">{{ $case->end_date }}</td>

                                <td>
                                    {{-- <form id="" method="POST"> --}}
                                        <div class="buttons" style="width:max-content; align:center; padding-left:70px;">

                                                <a href="{{ 'formList/'.$case->pt_current_township }}">
                                                <button title="" id="form_form_{{ $case->pt_current_township }}"
                                                    type="button"
                                                    class="btn btn-info btn-xs" style="padding:5px;">
                                                    ပြင်ဆင်ရန်
                                                    {{-- <li class="fa fa-edit fa-1x"></li> --}}
                                                </button>
                                                </a>
                                            {{-- id="showPopupBtnUpload" --}}
                                            <button title="server ပေါ်သို့ပို့ဆောင်မည်" type="button"
                                                class="btn btn-success btn-xs" style="padding:5px;" id=""
                                                onClick="dhis2postData('{{ $case->pt_current_township }}')">
                                                {{-- <i class="fa fa-upload upload_to_online_btn"></i> --}}
                                                server ပေါ်သို့ပို့ဆောင်မည်
                                            </button>
                                        </div>
                                    {{-- </form> --}}
                                </td>


                            </tr>
                            {{-- @endforeach --}}

                        </tbody>
                    @endforeach
                </table>

               <div class="paginate" style="margin-left:80%;padding-left:20px;padding-right:20px;font-color:#333;font-size:14px;">
                {{ $groupedCases->links() }}
               </div>


               </div>

            </div>
            <!-- Custom Tabs -->
        </div>


        @extends('nmcp-template.patient-register-form')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- for js --}}
<script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}">
</script>
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}">
</script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/nmcp.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootbox.all.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>


            // $("body").addClass("loading");

    $( function() {
        $('.search_date').datepicker({
                    format: 'mm/yyyy',
                    viewMode: 1,
                    minViewMode: 1,
                    autoclose: true,
                });
    } );


  $(document).on({
    ajaxStart: function(){
        $("body").addClass("loading");
    },
    ajaxStop: function(){
        $("body").removeClass("loading");
    }
});
function goto_form(pt_current_township) {
    $.ajax({
        type: "GET",
        url: BACKEND_URL + "show_form_list/" + pt_current_township,
        success: function(datas) {
            // Assuming datas is an array of objects
            datas.forEach(function(data) {
                // Assuming you want to add the inputs to a form with ID form_${pt_current_township}
                var form = $(`#form_${pt_current_township}`);

                // Add or update input fields with the retrieved data
                form.find('input[name=""]').val(data.Form_Code);
                form.find('input[name="form_number"]').val(data.Form_No);
                form.find('input[name="select_lp_state_region"]').val(data.TS_Code.slice(0, 6));
                form.find('input[name="select_lp_township_de"]').val(data.TS_Code);
                form.find('input[name="select_tbl_hfm_de"]').val(data.HF_Code);
                form.find('input[name="select_hfm_de"]').val(data.SC_Code);
                form.find('input[name="form-date"]').val(data.PMonth + "/" + data.PYear);
                form.find('input[name="pt_current_township"]').val(data.pt_current_township);
                form.find('input[name="_token"]').val('{{ csrf_token() }}');

                // Submit the form
                form.prop('action', '/patient-register-form');
                form.submit();
            });
        }
    });
}













// var showPopupBtnUpload = document.getElementById("showPopupBtnUpload");
// showPopupBtnUpload.addEventListener("click", showConfirmationPopupUpload);

            // var o_sdate, o_edate;
            // $(document.ready(function() {
            //     var health_facility_table = $('#health_facility_table').DataTable({
            //         "destroy": true,
            //         'paging': true,
            //         'lengthChange': false,
            //         'searching': false,
            //         'ordering': true,
            //         'info': true,
            //         'autoWidth': false
            //     });

            //     // $('.select2').select2();

            //     //Date picker
            //     $('#datepicker').datepicker({
            //         autoclose: true
            //     });
            // }));
            // var toDay = new Date().getDate();
            // $("#form-date").datepicker({
            //     autoclose: true,
            //     format: "mm/yyyy",
            //     viewMode: "months",
            //     minViewMode: "months",
            //     // startDate: new Date(new Date().setDate(toDay - 365)),
            //     endDate: new Date()
            // });



            // Start for UploadForm blade
            $(document).ready(function() {
                // selected value in region
                $('#region_data').click(function() {
                    console.log("Hi");
                    //DisctictResult($(this).val());
                    TownShipResult($(this).val());
                });

                // selected value in district
                $('#district_data').click(function() {
                    TownShipResult($(this).val());
                });

                // selected value in township
                $('#township_data').click(function() {
                    HFResult($(this).val());
                });

                // selected value in healthfacility
                $('#hf_data').click(function() {
                    SubCenterResult($(this).val());
                });

                // selected value in Subcenter
                $('#hf_data').click(function() {
                    VHVResult($(this).val());
                });

                // var health_facility_table = $('#health_facility_table').DataTable({
                //     "destroy": true,
                //     'paging': true,
                //     'lengthChange': false,
                //     'searching': false,
                //     'ordering': true,
                //     'info': true,
                //     'autoWidth': false
                // });

                // // $('.select2').select2();

                // //Date picker
                // $('#datepicker').datepicker({
                //     autoclose: true
                // });

            });

            // get District Data form Database
            function DisctictResult(selectedValue) {
                // call  ajax method to get data from database
                // clear data from select option set
                var list = document.getElementById("district_data");
                clearSelectList(list);

                $.ajax({
                    type: "GET",
                    url: "/api/district/" + selectedValue, //this  should be replace by your server side method
                    //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        console.log('=>', data);
                        for (var i = 0; i < data.length; i++) {
                            var ele = document.createElement("option");
                            ele.value = data[i].district_name_mmr;
                            ele.innerHTML = data[i].district_name_en;
                            document.getElementById("district_data").appendChild(ele);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }

            // get Township Data form Database
            function TownShipResult(selectedValue) {
                // call  ajax method to get data from database
                // clear data from select option set
                var list = document.getElementById("township_data");
                clearSelectList(list);

                $.ajax({
                    type: "GET",
                    url: "/api/township/" + selectedValue.substring(0,
                        6), //this  should be replace by your server side method
                    //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        //console.log(data);
                        //alert(data.township_mmr);

                        for (var i = 0; i < data.length; i++) {
                            var ele = document.createElement("option");
                            ele.value = data[i].township_mmr;
                            ele.innerHTML = data[i].township_name_en;
                            document.getElementById("township_data").appendChild(ele);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }

            // get Health Facility Data form Database
            function HFResult(selectedValue) {
                // call  ajax method to get data from database
                // clear data from select option set
                var list = document.getElementById("hf_data");
                clearSelectList(list);

                $.ajax({
                    type: "GET",
                    url: "/api/healthfacility/" + selectedValue.substring(0,
                        9), //this  should be replace by your server side method
                    //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        console.log('myitzu', data);
                        //alert(data.township_mmr);

                        for (var i = 0; i < data.length; i++) {
                            var ele = document.createElement("option");
                            ele.value = data[i].health_facility_mmr;
                            ele.innerHTML = data[i].health_facility_name_en;
                            document.getElementById("hf_data").appendChild(ele);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }

            // get Subcenter Data form Database
            function SubCenterResult(selectedValue) {
                // call  ajax method to get data from database
                // clear data from select option set
                var list = document.getElementById("subcenter_data");
                clearSelectList(list);

                $.ajax({
                    type: "GET",
                    url: "/api/subcenter/" + selectedValue.substring(0,
                        11), //this  should be replace by your server side method
                    //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        console.log(data);
                        //alert(data.township_mmr);

                        for (var i = 0; i < data.length; i++) {
                            var ele = document.createElement("option");
                            ele.value = data[i].sub_center_mmr;
                            ele.innerHTML = data[i].sub_center_name_en;
                            document.getElementById("subcenter_data").appendChild(ele);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }

            function VHVResult(selectedValue) {
                // call  ajax method to get data from database
                // clear data from select option set
                var list = document.getElementById("vhv_data");
                clearSelectList(list);

                $.ajax({
                    type: "GET",
                    url: "/api/vhv/" + selectedValue.substring(0,
                        14), //this  should be replace by your server side method
                    //data: "{'value': '" + selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        console.log(data);
                        //alert(data.township_mmr);

                        for (var i = 0; i < data.length; i++) {
                            var ele = document.createElement("option");
                            ele.value = data[i].village_mmr;
                            ele.innerHTML = data[i].village_name_en;
                            document.getElementById("vhv_data").appendChild(ele);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }

            function clearSelectList(list) {
                // when length is 0, the evaluation will return false.
                while (list.options.length) {
                    // continue to remove the first option until no options remain.
                    list.remove(0);
                }
            }

            //End for UploadForm blade

            function state_and_region_tab() {
                year = $('#ts_exam_pos').find(":selected").text();
                filter_month = $("#month_filter").val();
                state_region = $('#state_region_exam_pos').find(":selected").val();
                sr_township = $("#sr_township_exam_pos").val();
                //Malaria Test
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    //  + district_name_en + '/' + health_facility_name_en+'/'+sub_center_name_en + '/'
                    url: 'malaria_test/' + region_name_en + '/' + township_name_en + '/' + village_name_en + '/' +
                        sDate + '/' + eDate,
                    beforeSend: function() {
                        $('.loader1').show();
                    },
                    success: function(data) {

                        // alert('this is found', data);
                        malaria_test.updateOptions({
                            series: [{
                                name: 'Tests',
                                data: data[1]
                            }],
                            xaxis: {
                                categories: data[0]
                            }
                        });

                    },
                    complete: function() {
                        $('.loader1').hide();
                    },
                });



            }

            function test1 () {
                console.log("Hi");
            }



            function goto_form(pt_current_township) {
            $.ajax({
                type: "GET",
                url:  BACKEND_URL +"get_existing_form_data/" + pt_current_township,
                success: datas => {


                     var formData = new FormData();
                     console.log('formData=>',formData);
                    // datas.map(data => {
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="select_lp_form_cat" value="${data.Form_Code}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="form_number" value="${data.Form_No}"/>`);
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="select_lp_state_region" value="${data.TS_Code.slice(0,6)}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="select_lp_township_de" value="${data.TS_Code}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="select_tbl_hfm_de" value="${data.HF_Code}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="select_hfm_de" value="${data.SC_Code}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="form-date" value="${data.PMonth}/${data.PYear}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="cf_link_code" value="${data.cf_link_code}"/>`
                    //         );
                    //     $(`#form_${cf_link_code}`).append(
                    //         `<input type="hidden" name="_token" value="{{ csrf_token() }}"/>`);
                    //     $(`#form_${cf_link_code}`).prop('action', '/patient-register-form');
                    //     $(`#form_${cf_link_code}`).submit();
                    // });
                }
            });
}



            function dhis2postData(hi) {
               // console.log(hi);
               var isConfirmed = window.confirm("All data will be uploaded to the server. Do you want to proceed?");
            //    $(button).prop("disabled", true);
            // $(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');

            if (isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/api/dhis2postData/" + hi,

                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function(data) {

                        console.log('dhs', data);
                        //alert(data.township_mmr);

                        alert("Data uploaded to the server.");
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);


                        console.log("not ok");
                    }
                });

            } else {
                alert("Upload canceled.");
            }

            }

        </script>
