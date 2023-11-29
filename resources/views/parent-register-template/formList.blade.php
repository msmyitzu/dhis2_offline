<!-- Font Awesome Icons -->
<link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>

<div class="header_bar">
   <ul class="nav navbar-nav">
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="https://mcbrs-dev2.myanmarvbdc.com/" class="" data-toggle="">
        <img src="{{ asset('img/logo.png') }}" class="user-image" alt="User Image">
        <span class="card-title"> Malaria Case-Based Reporting for VBDC Myanmar </span>
      </a>
    </li>
    <li >
        <a href="{{ url()->previous() }}" class="" id="" >Go To HomePage</a>
    </li>
  </ul>
</div>
<h2 class="form_head" style="font-weight: 600; color:rgb(44, 102, 147); padding-top:10px; padding-left:20px; text-align:center;">Form Lists</h2>

<main>
    <div class="tab-pane active " id="data_entry">
        <div class="row" >
            <div class=""style="margin-left:25px;">

                <form class="" id="frm-patient-register-form" method="post" action="patient-register-form"
                    style="font-weight: 600;">
                    {{ csrf_field() }}

                    <table id="table_grab_all_corefacility" style="width:100%" class="table table-bordered nowrap">
                        <thead>
                        <tr class="theads">
                            <!--th>No</th-->
                            <th align="right">SC_Name_MM</th>
                            <th align="left">Record</th>
                            <th align="right">Start Date</th>
                            <th align="right">End Date</th>
                            <th align="right"></th>

                        </tr>
                        </thead>
                        <tbody id="grab_all_corefacility_container" class="tbodys">
                        <tr>
                            {{-- @foreach ($health_facility as $hf ) --}}
                            <td align="right" cf_code="718009">
                                
                            </td>
                            <td align="left">150</td>
                            <td align="right">7 / 2023</td>
                            <td align="right">11 / 2023</td>

                            <td>

                            </td>

                            {{-- @endforeach --}}
                            </tr>
                            </tbody>
                        </table>

                    @extends('nmcp-template.patient-register-form')

                    <input type="hidden" id="cf_code" name="cf_code" />
                    <input type="hidden" id="cf_link_code" name="cf_link_code" />
                </form>
            </div>
        </div>
        <div class="col-md-6">

        </div>

        <!-- /.box-header with-border -->
    </div>
    <!-- /.row-->
    </div>

</main>

{{-- fontawsome 6.4.2 js 1 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
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

// $(document).ready(function() {
//         $('#datepicker').datepicker({
//             format: "mm/yyyy",
//             startView: "months",
//             minViewMode: "months",
//             autoclose: true,
//         });
//     });

    function load_tbl_hfm(target_control_id, ts_code, token, form_type = null) {

        //alert('thisejrwo');
    let form_cat = $('#select_lp_form_cat').val();


    let hf_types = [];

    if (form_cat == 2 || form_cat == 3) {
        hf_types = ['SC', 'MH', 'SU'];
    }

    try {
        var form_code = "";

        if ($("#select_lp_form_cat").val() == "0") {
            bootbox.alert("<p>• ပုံစံအမျိုးအစားရွေးပါ</p>");
            return false;
        }

        $("#" + target_control_id).html("<option>Loading...</option>");
        $("#" + target_control_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_grab_hfconnect/' + ts_code,
            data: { hf_types: hf_types },
            success: function(data) {
                //console.log('mzh', data);
                $("#" + target_control_id).html("");

                $("#" + target_control_id).append("<option value='0'> ရွေးရန် </option>");
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function(i, val) {
                    var opt = "<option value='" + val.HF_Code + "'>" + val.hf_name + " | " + val.hf_name_mm + "</option>";
                    $("#" + target_control_id).append(opt);
                });
            }
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

    function yesno(yncode) {
        switch (yncode) {
            case 0:
                return "No";
                break;
            case 1:
                return "Yes";
                break;
            case 7:
                return "N/A";
                break;
            case 9:
                return "Missing";
                break;
        }
    }


    function adjustInputWidth(input) {
            if (input.value.length <= 15 || input.value.length === 0) {
                input.style.width = "20ch"; // Default width
            } else {
                input.style.width = `${input.value.length + 2}ch`;
            }
        }


    clickOnRow();

    $(document).ready(function() {
        var table = document.getElementById('data_entry_body');
        var v = null;
        var _id = null;
        for (var i = 0, row; row = table.rows[i]; i++) {
            v = row.cells[20].children[0].getAttribute('rowNo');
            _id = row.cells[1].children[0].className + v;
            row.cells[1].children[0].setAttribute('id', _id);
        }
        var zzz = new custom_inputmask(_id, '_', '-');
    });

    // $(function() {
    //     var toDate = new Date();
    //     var dd = toDate.getDate() < 10 ? `0${toDate.getDate()}` : toDate.getDate();
    //     var mm = toDate.getMonth() < 9 ? `0${toDate.getMonth() + 1}` : toDate.getMonth() + 1;
    //     var yyyy = toDate.getFullYear();
    //     var maxDate = `${dd}-${mm}-${yyyy}`;


    //     $('.dentry_date').inputmask('datetime', {
    //         inputFormat: 'dd-mm-yyyy',
    //         placeholder: '_',
    //         clearIncomplete: true,
    //         min: '09-09-0999',
    //         max: maxDate
    //     });

    //     $('#txt_Total_Outpatient').focus().select();

    //     $('#health_facility_table').DataTable({
    //         'paging': true,
    //         'lengthChange': false,
    //         'searching': false,
    //         'ordering': true,
    //         'info': true,
    //         'autoWidth': false
    //     });

    //     //Initialize Select2 Elements
    //     $('.select2').select2()


    //     //Date picker
    //     $('#datepicker').datepicker({
    //         autoclose: true
    //     })

    //     // $('.dentry_date').datepicker({
    //     //     autoclose: true,
    //     //     format: 'dd-mm-yyyy',
    //     //     todayHighlight: true,
    //     //     endDate : new Date()
    //     // }).on('change', function(){
    //     //     $(this).focus();
    //     //     // $('.bhs-name').focus();
    //     // });

    // });

    // start 16/8/23 add by me

    function checkrcs(rdt) {
        // console.log('test',rdt);
        var tr = $(rdt).closest('tr');
        var rcs = tr.find('td:eq(8) select').val();
        if (rdt.value == '0' || rdt.value == '7' || rdt.value == '9') {
            if (rcs == '0' || rcs == '7' || rcs == '9') {
                //set all fields to N/A
                tr.find(
                        'td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input'
                    )
                    .css('background-color', 'white');
                tr.find('td:eq(10) select').prop('selectedIndex', 6); //in,out patient
                tr.find('td:eq(11) select').prop('selectedIndex', 8); //ACT
                tr.find('td:eq(12) input').val('N/A').attr('value', 7); //CQ
                tr.find('td:eq(13) input').val('N/A').attr('value', 7); //PQ
                tr.find('td:eq(14) select').prop('selectedIndex', 3); //Referral
                tr.find('td:eq(15) select').prop('selectedIndex', 3); //MMD
                tr.find('td:eq(16) select').prop('selectedIndex', 9); //TG
                tr.find('td:eq(17) select').prop('selectedIndex', 3); //Travel Record
                tr.find('td:eq(18) select').prop('selectedIndex', 7); //Occupation
                tr.find('td:eq(19) input').val('N/A'); //Remark
                tr.find('td:eq(19) input').focus();
            }
        } else {
            // go in/out field
            tr.find(
                    'td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input'
                )
                .css('background-color', '#FFC8C8');
            tr.find('td:eq(10) select').focus();
            tr.find('td:eq(10) select').prop('selectedIndex', 0); //in,out patient
            tr.find('td:eq(11) select').prop('selectedIndex', 0); //ACT
            tr.find('td:eq(12) input').val('');
            tr.find('td:eq(12) input').attr('placeholder', 'ဆေးလုံးရေ'); //CQ
            tr.find('td:eq(13) input').val('');
            tr.find('td:eq(13) input').attr('placeholder', 'ဆေးလုံးရေ'); //PQ
            tr.find('td:eq(14) select').prop('selectedIndex', 0); //Referral
            tr.find('td:eq(15) select').prop('selectedIndex', 0); //MMD
            tr.find('td:eq(16) select').prop('selectedIndex', 0); //TG
            tr.find('td:eq(17) select').prop('selectedIndex', 0); //Travel Record
            tr.find('td:eq(18) select').prop('selectedIndex', 0); //Occupation
            tr.find('td:eq(19) input').val('');
            tr.find('td:eq(19) input').attr('placeholder', 'ရေးပါ');
        }

    }
    // end 16/8/23 add by me

    // $(document).ready(function(){
    //     var table = document.getElementById('data_entry_body');
    //     var v = null ; var _id = null ;
    //     for(var i = 0, row ; row = table.rows[i]; i ++){
    //         v = row.cells[20].children[0].getAttribute('rowNo');
    //         _id = row.cells[1].children[0].className + v ;
    //         row.cells[1].children[0].setAttribute('id', _id);
    //     }
    //     var zzz = new custom_inputmask(_id, '_', '-');
    // });

    $("#data_entry_body tr td input").on('focus', function() {
        //highlight_row(this);
    });

    $("#data_entry_body tr td select").on('focus', function() {
       //highlight_row(this);
    });

    // $(document).ready(function(){
    //     var tb = document.getElementById('data_entry_body');
    //     for (var i = 0, row ; row = tb.rows[i]; i ++){
    //         row.cells[12].children[0].value = yesno(row.cells[12].children[0].value);
    //         row.cells[13].children[0].value = yesno(row.cells[13].children[0].value);
    //     }
    // });

    function save_data_entry(button) {
        //alert('hello i am new1111');
        //$(button).prop("disabled", true);
        //$(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');
        //tpa check


                var data = {};
                    data["service_provider"] = $("#service_provider").val();
                    data["data_entry"] = $("#data_entry_type").val();
                    data["state_region"] = $("#state_region").val();
                    data["township"] = $("#township").val();
                    data["rhc_health"] =$("#rhc_health").val();
                    data["sc_health"] = $("#sc_health").val();
                    data["icmv_select"] = $("#icmvSelect").val();
                    data["rp_month"] = $("#rp_month").val();
                    data["blood_test"] = $("#bloodTest").val();
                    data["condition"] = $("#conditionalSelect").val();
                    //data["cf_link_code"] = $("#cf_link_code").val();
                    data["Total_Outpatient"] = $("#txt_total_outpatient").val();
                    data["U5_Outpatient"] = $("#txt_total_child_out").val();
                    data["Preg_Outpatient"] = $("#txt_total_preg_out").val();
                    data["Total_Inpatient"] = $("#txt_total_inpatient").val();
                    data["U5_Inpatient"] = $("#txt_total_in_child").val();
                    data["Preg_Inpatient"] = $("#txt_total_preg_in").val();
                    data["Death_Facility"] = $("#txt_total_death_in").val();
                    var table = document.getElementById('data_entry_body');
            for (var i = 0, row; row = table.rows[i]; i++) {
                    data["date"] = row.cells[1].children[0].value;
                    data["Pt_Name"] = row.cells[2].children[0].value;
                    data["Age_Year"] = row.cells[3].children[0].value;
                    data["Pt_Father_Name"] = row.cells[4].children[0].value;
                    data["Pt_Location"] = row.cells[5].children[0].value;
                    data["Pt_Address"] = row.cells[6].children[0].value;
                    data["Pt_Address1"] = row.cells[7].children[0].value;
                    data["Pt_Address2"] = row.cells[8].children[0].value;
                    data["Pt_Address3"] = row.cells[9].children[0].value;
                    data["Pt_Address4"] = row.cells[10].children[0].value;
                    data["Pt_Address5"] = row.cells[11].children[0].value;
                    data["Sex_Code"] = row.cells[12].children[0].value;
                    data["Preg_YN"] = row.cells[13].children[0].value;
                    data["Micro_Code"] = row.cells[14].children[0].value;
                    data["RDT_Code"] = row.cells[15].children[0].value;
                    data["IOC_Code"] = row.cells[16].children[0].value;
                    data["ACT_Code"] = row.cells[17].children[0].value;
                    data["CQ_Code"] = row.cells[18].children[0].value;
                    data["PQ_Code"] = row.cells[19].children[0].value;
                    data["Referral_Code"] = row.cells[20].children[0].value;
                    data["Malaria_Death"] = row.cells[21].children[0].value;
                    data["TG_Code"] = row.cells[22].children[0].value;
                    data["travel_yn"] = row.cells[23].children[0].value;
                    data["occupation"] = row.cells[24].children[0].value;
                    data["Remark"] = row.cells[25].children[0].value;
            }

                var data_to_post = JSON.stringify(data);
                console.log(data);
                var save_update_check = $.ajax({
                    async: false,
                    type: "POST",
                    headers: {
                        "X-CSRF_TOKEN": '{{ csrf_token() }}'
                    },
                    url: BACKEND_URL + "save_tbl_total_patient_temp/",
                     data: data_to_post,
                    success: function(result) {

                        if (result == "1") {
                            alert('save data to tbl_individual_case');
                            //console.log("save success");
                            save_update_check = true;
                        } else {
                            console.log(result);
                        }
                    }
                 }).responseText;
                // var data_to_update = JSON.stringify(data);
                // console.log(data_to_update);
                // var save_update_check = $.ajax({
                //     async: false,
                //     type: "POST",
                //     headers: {
                //         "X-CSRF_TOKEN": '{{ csrf_token() }}'
                //     },
                //     url: BACKEND_URL + "update_tbl_total_patient_temp/",
                //     data: data_to_update,
                //     success: function(result) {
                //         if (result == "1") {
                //             //console.log(result + " update success");
                //             save_update_check = true;
                //         } else {
                //             save_update_check = false;
                //         }
                //     }
                // }).responseText;



    }

// ------------------------------------

    function isValidDate(d, m, y) {
        var thirtyDaysMonth = [9, 4, 6, 11];
        if (parseInt(d) && parseInt(m) && parseInt(y)) {
            if (parseInt(d) === 9 && parseInt(m) === 9 && parseInt(y) === 999) {
                return true;
            } else {
                if (parseInt(y) > 9999 || parseInt(m) > 12 || parseInt(d) > 31 || parseInt(y) < 1900) {
                    return false;
                }
                if (thirtyDaysMonth.includes(parseInt(m))) {
                    if (parseInt(d) > 30) {
                        return false;
                    }
                }
                if (parseInt(m) == 2) {
                    if (parseInt(d) > 28) {
                        if (parseInt(y) % 4 == 0) {
                            return true;
                        }
                        return false;
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function sortDate(dGet) {
        var aSplit = dGet.split('-');
        var temp = aSplit[0];
        aSplit[0] = aSplit[2];
        aSplit[2] = temp;
        temp = '';
        return aSplit.join('-');
    }

    function checkBtn() {
        var btn = document.getElementById('add_row');
        var row_count = get_row();
        // console.log('aaaaaa',row_count);
        // if (row_count >= 17) {
        // $(btn).prop('disabled', true);
        // $(btn).html('<li class="fa fa-ban"></li> Maximun');
        // } else {
        $(btn).prop('disabled', false);
        $(btn).html('<li class="fa fa-plus-square"></li> အသစ်တစ်ကြောင်းတိုးရန်');
        // }
    }

    function get_row() {
        //console.log(get_row);
        var table = document.getElementById('data_entry_body');
        for (var i = 0, row; row = table.rows[i]; i++) {
            var row_count = row.cells[20].children[0].getAttribute('rowNo');
        }
        return row_count;
    }

    function add_row(btn) {
    //alert('this will new rowlll');

        //$(btn).prop('disabled', true);
        $(btn).html("<li class='fa fa-spinner fa-spin'></li> ခေတ္တစောင့်ပါ");
        // var table = document.getElementById('data_entry_body');
        var row_count = get_row();
        if (row_count >= 17) {
            alert('maximum');
            //bootbox.alert('Reached Maximun Number of Rows.');
            checkBtn();
        } else {
            var select_lp_township_de = document.getElementById('select_lp_township_de');
            var value = select_lp_township_de.value;
            //var select_lp_township_de_text = e.options[e.selectedIndex].text;
            //console.log('aaaaaa',select_lp_township_de_text);
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_patient_dataentry_row/" + value,
                //url: "/dhis-offline-app/public/get_patient_dataentry_row/" + value,
                //url: "/dhis-offline-app/public/get_patient_dataentry_row/0",

                success: function(data) {
                    //alert('this isopeirepw');
                    //console.log("myitzu", data);
                    $("#data_entry_body").append(data);
                    set_row_numbers();
                    checkBtn();
                    // set_focus();
                },
                error: function(error) {
                    bootbox.alert(error.statusText);
                    checkBtn();
                }
            });
            //"http://" + window.location.host +
        }

    }

    function set_row_numbers() {
        var table = document.getElementById('data_entry_body');
        for (var i = 0, row; row = table.rows[i]; i++) {
            row.cells[0].innerHTML = i + 1;
            row.cells[26].children[0].setAttribute("rowNo", i + 1);
        }
    }

    set_row_numbers();



        function delete_row(btn) {
        // alert('this is deleted111',btn);
        var rowNum = $(btn).attr("rowNo");
        // confirm("Row အမှတ် " + rowNum + " တစ်ခုလုံးအား အပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ", function(c) {
        //     if (c == true) {
        //         $(btn).closest('tr').remove();
        //         set_row_numbers();
        //     }

        //  });

         if (confirm("Row အမှတ် " + rowNum + " တစ်ခုလုံးအား အပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ") == true){
            $(btn).closest('tr').remove();
                set_row_numbers();
         }else{
            checkBtn();
         }

    }





    function delete_existing_row(p_number, sync, btn) {
        if (sync == "1") {
            alert(
                "ဤအချက်အလက်သည် server ပေါ်သို့ပို့ဆောင်ပြီးဖြစ်ပါသဖြင့် ပြုပြင်ခြင်း၊ဖျက်ခြင်းများ ခွင့်မပြုပါ");
            return false;
        } else {
            $.ajax({
                url: BACKEND_URL + 'delete_tbl_individual_by_code/' + p_number,
                method: 'post',
                headers: {
                    "X-CSRF_TOKEN": '{{ csrf_token() }}'
                },
                success: function(result) {
                    alert(result);
                    $(btn).closest('tr').remove();
                    set_row_numbers();
                }
            });
            checkBtn();
        }
        // bootbox.alert("Call delete function of controller!");
    }

    function close_page() {
        confirm("ယခုစာမျက်နှာအားပိတ်မည်။ သေချာပါက OK နှိပ်ပါ", function(result) {
            if (result == true) {
                location.href = "/";
            }
        });
    }

    $(".num-only").keyup(function() {
        var v = $(".num-only").val();

        if ($.isNumeric(v) == false) {
            v = v.substring(0, v.length - 1);
            $(".num-only").val(v);
        }
    });

    $(".num-only").change(function() {
        var v = $(".num-only").val();

        if ($.isNumeric(v) == false) {
            alert("နံပါတ်များသာရိုက်သွင်းပါ");
            $(".num-only").val("");
        }
    });

    // $('.only-integer').on('keypress keyup blur', function(e) {
    //     if (e.which < 48 || e.which > 57) {
    //         if (e.which != 46) {
    //             e.preventDefault();
    //         }
    //     }
    // });


    $(".only-integer").on('keypress keyup blur', function(event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    // $(".dentry_age").on('keypress keyup blur', function(event) {
    //     $(this).val($(this).val().replace(/[^\d].+/, ""));
    //     if ((event.which < 48 || event.which > 57)) {
    //         event.preventDefault();
    //     }
    // });

    function chNumOut() {
        var out_u5 = parseInt($('#txt_U5_Outpatient').val());
        var out_preg = parseInt($('#txt_Preg_Outpatient').val());
        var out_total = parseInt($('#txt_Total_Outpatient').val());

        if (out_total < (out_u5 + out_preg)) {
            alert("ထည့်သွင်းသောစာရင်းမှားယွင်းနေသည်။").on('hidden.bs.modal', () => {
                $('#txt_Total_Outpatient').css('background', '#FFC8C8').focus();
            });
        } else {
            $('#txt_Total_Outpatient').css('background', '#FFFFFF');
            $('#txt_Preg_Outpatient').css('background', '#FFFFFF');
            $('#txt_U5_Outpatient').css('background', '#FFFFFF');
        }
    }

    function chNumIn() {
        var in_u5 = parseInt($('#txt_U5_Inpatient').val());
        var in_preg = parseInt($('#txt_Preg_Inpatient').val());
        var in_total = parseInt($('#txt_Total_Inpatient').val());
        if (in_total < (in_u5 + in_preg)) {
            alert("ထည့်သွင်းသောစာရင်းမှားယွင်းနေသည်။").on('hidden.bs.modal', () => {
                $('#txt_Total_Inpatient').css('background', '#FFC8C8').focus();
            });
        } else {
            $('#txt_Total_Inpatient').css('background', '#FFFFFF');
            $('#txt_Preg_Inpatient').css('background', '#FFFFFF');
            $('#txt_U5_Inpatient').css('background', '#FFFFFF');
        }
    }

    set_row_numbers();
</script>
<style>
.header_bar{
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
    background-color: #333; /* Adjust as needed */
    color: white; /* Adjust as needed */
    padding: 10px; /* Adjust as needed */
}

.upload_to_online_btn {
    margin-left: auto; /* Pushes the "Upload to Online" list item to the right */
}


.back_arrow{
    float: left;
    padding:15px 15px;
    font-size: 15px;
    color: #fff;

}
.back_arrow:hover{
    font-size: 20px;
    color: rgb(192, 193, 197);
}

    .tableCell {
        align-items:left;
        justify-content: space-between;
        display: flex;
    }
.box-body{
    margin-left:20%;
    margin-right:10%;
}
    table.dataTable thead tr th {
            text-align:center;
            padding: 5px;
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
    width: 100%;
  white-space: nowrap;
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
        background-color: #5c5c5c;
        color: white;
    }

.engRows{
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
        padding:0 5px;
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



    .table>thead>tr>th,
    .table>tbody>tr>td {
        text-align: center;
        vertical-align: middle;
        padding: 2px;
        border: 1px solid grey;
        padding: 0px;
        margin: 0px;
        font-weight: 600;
    }


    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        padding: 0px;
        width: 100%;
        height: 50px !important;
    }

    #act, #cq, #pq {
  width: 100px !important;
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
