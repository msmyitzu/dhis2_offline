<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Register Form</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.-->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Select2 -->
    <link rel="stylesheet"
        href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css')}}"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <script>
        //bootbox.alert("အချက်အလက်များ မှားယွင်းခြင်းမဖြစ်စေရန် ဤစာမျက်နှာပေါ်တွင် browser refresh (⭮) လုပ်ခြင်း (သို့) back button (⭠) နှိပ်ခြင်း (လုံးဝ) မပြုလုပ်ရန် ကြိုတင်သတိပေးအပ်ပါသည်။");
    </script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('js/nmcp.js') }}"></script>
</head>

<body>

    {{-- <input type="hidden" id="cf_code" value="{{ $cf_code }}" /> --}}
    {{-- <input type="hidden" id="cf_link_code" value="{{ $cf_link_code }}" /> --}}


        <main>

            <div class="wrap">

            </div>

        </main>
    <!-- jQuery 3 -->
    {{-- <script src="{{ asset ('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script> --}}
    <!-- Bootstrap 3.3.7 -->
    {{-- <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
    <!-- Select2 -->
    {{-- <script src="{{ asset ('bower_components/select2/dist/js/select2.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script> --}}

    <!-- datepicker -->
    {{-- <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> --}}

    <!-- Slimscroll -->
    {{-- <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script> --}}
    <!-- FastClick -->
    {{-- <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script> --}}
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script> --}}
    <!-- DataTables -->
    {{-- <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('js/bootbox.all.min.js') }}"></script>
    {{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
    <script src="{{ asset('js/custom_inputmask.js') }}"></script>
    {{-- <!-- <script src="{{ asset ('bower_components/inputmask/dist/jquery.inputmask.bundle.js')}}"></script> --> --}}
    <script src="{{ asset('bower_components/inputmask/dist/jquery.inputmask.js') }}"></script>
    {{-- <!-- <script src="{{ asset ('bower_components/inputmask/dist/inputmask.min.js')}}"></script> --> --}}
    {{-- <!-- <script src="{{ asset ('bower_components/inputmask/dist/bindings/inputmask.binding.js')}}"></script> --> --}}
    {{-- <!-- <script src="{{ asset ('bower_components/inputmask/dist/extensions/inputmask.extensions.js')}}"></script> --> --}}
    {{-- <!-- <script src="{{ asset ('bower_components/inputmask/dist/extensions/inputmask.date.extensions.js')}}"></script> --> --}}

    <script>
        clickOnRow();

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

        $(function() {
            var toDate = new Date();
            var dd = toDate.getDate() < 10 ? `0${toDate.getDate()}` : toDate.getDate();
            var mm = toDate.getMonth() < 9 ? `0${toDate.getMonth() + 1}` : toDate.getMonth() + 1;
            var yyyy = toDate.getFullYear();
            var maxDate = `${dd}-${mm}-${yyyy}`;


            $('.dentry_date').inputmask('datetime', {
                inputFormat: 'dd-mm-yyyy',
                placeholder: '_',
                clearIncomplete: true,
                min: '09-09-0999',
                max: maxDate
            });

            $('#txt_Total_Outpatient').focus().select();

            $('#health_facility_table').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });

            //Initialize Select2 Elements
            $('.select2').select2()


            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            // $('.dentry_date').datepicker({
            //     autoclose: true,
            //     format: 'dd-mm-yyyy',
            //     todayHighlight: true,
            //     endDate : new Date()
            // }).on('change', function(){
            //     $(this).focus();
            //     // $('.bhs-name').focus();
            // });

        });

        // start 16/8/23 add by me

        function checkrcs(rdt) {
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
            highlight_row(this);
        });

        $("#data_entry_body tr td select").on('focus', function() {
            highlight_row(this);
        });

        // $(document).ready(function(){
        //     var tb = document.getElementById('data_entry_body');
        //     for (var i = 0, row ; row = tb.rows[i]; i ++){
        //         row.cells[12].children[0].value = yesno(row.cells[12].children[0].value);
        //         row.cells[13].children[0].value = yesno(row.cells[13].children[0].value);
        //     }
        // });

        function save_data_entry(button) {
            $(button).prop("disabled", true);
            $(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');
            //tpa check
            var tp_code = document.getElementById('txt_Death_Facility').getAttribute('tp_code');
            var tpa_out = $("#txt_Total_Outpatient").val();
            var u5_tpa = $("#txt_U5_Outpatient").val();
            var preg_tpa = $("#txt_Preg_Outpatient").val();
            var df = $("#txt_Death_Facility").val();
            var tpa_in = $("#txt_Total_Inpatient").val();
            var u5_in = $("#txt_U5_Inpatient").val();
            var preg_in = $("#txt_Preg_Inpatient").val();
            var errMsg = '';
            if (tpa_out == '') {
                errMsg += '<p>• အထွေထွေဆေးခန်းလာပြင်ပလူနာသစ်ပေါင်းဖြည့်ပါ</p>';
            }
            if (u5_tpa == '') {
                errMsg += '<p>• ငါးနှစ်အောက်အထွေထွေဆေးခန်းလာ(ပြင်ပ)ဖြည့်ပါ</p>';
            }
            if (preg_tpa == '') {
                errMsg += '<p>• ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(ပြင်ပ)ဖြည့်ပါ</p>';
            }
            if (df == '') {
                errMsg += '<p>• ဆေးရုံတွင်သေဆုံးသူစုစုပေါင်းဖြည့်ပါ</p>';
            }
            if (tpa_in == '') {
                errMsg += '<p>• ဆေးရုံတက်အတွင်းလူနာသစ်ပေါင်းဖြည့်ပါ</p>';
            }
            if (u5_in == '') {
                errMsg += '<p>• ငါးနှစ်အောက်အထွေအထွေဆေးခန်းလာ(အတွင်း)ဖြည့်ပါ</p>';
            }
            if (preg_in == '') {
                errMsg += '<p>• ကိုယ်ဝန်ဆောင်အထွေထွေဆေးခန်းလာ(အတွင်း)ဖြည့်ပါ</p>';
            }
            if (errMsg != '') {
                $('#txt_Total_Outpatient').css('background', '#FFC8C8');
                $('#txt_Total_Inpatient').css('background', '#FFC8C8');
                $('#txt_U5_Inpatient').css('background', '#FFC8C8');
                $('#txt_U5_Outpatient').css('background', '#FFC8C8');
                $('#txt_Preg_Inpatient').css('background', '#FFC8C8');
                $('#txt_Preg_Outpatient').css('background', '#FFC8C8');
                $('#txt_Death_Facility').css('background', '#FFC8C8');
                $(button).prop("disabled", false);
                $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                bootbox.alert(errMsg);
                return false;
            } else {
                $('#txt_Total_Outpatient').css('background', 'white');
                $('#txt_Total_Inpatient').css('background', 'white');
                $('#txt_U5_Inpatient').css('background', 'white');
                $('#txt_U5_Outpatient').css('background', 'white');
                $('#txt_Preg_Inpatient').css('background', 'white');
                $('#txt_Preg_Outpatient').css('background', 'white');
                $('#txt_Death_Facility').css('background', 'white');
                if (tp_code == '') {
                    var data = {};
                    data["cf_link_code"] = $("#cf_link_code").val();
                    data["Total_Outpatient"] = tpa_out;
                    data["U5_Outpatient"] = u5_tpa;
                    data["Preg_Outpatient"] = preg_tpa;
                    data["Death_Facility"] = df;
                    data["Total_Inpatient"] = tpa_in;
                    data["U5_Inpatient"] = u5_in;
                    data["Preg_Inpatient"] = preg_in;
                    var data_to_post = JSON.stringify(data);
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
                                //console.log("save success");
                                save_update_check = true;
                            } else {
                                console.log(result);
                            }
                        }
                    }).responseText;
                } else {
                    var data = {};
                    data["cf_link_code"] = $("#cf_link_code").val();
                    data["TP_Code"] = tp_code;
                    data["Total_Outpatient"] = tpa_out;
                    data["U5_Outpatient"] = u5_tpa;
                    data["Preg_Outpatient"] = preg_tpa;
                    data["Death_Facility"] = df;
                    data["Total_Inpatient"] = tpa_in;
                    data["U5_Inpatient"] = u5_in;
                    data["Preg_Inpatient"] = preg_in;
                    var data_to_update = JSON.stringify(data);
                    console.log(data_to_update);
                    var save_update_check = $.ajax({
                        async: false,
                        type: "POST",
                        headers: {
                            "X-CSRF_TOKEN": '{{ csrf_token() }}'
                        },
                        url: BACKEND_URL + "update_tbl_total_patient_temp/",
                        data: data_to_update,
                        success: function(result) {
                            if (result == "1") {
                                //console.log(result + " update success");
                                save_update_check = true;
                            } else {
                                save_update_check = false;
                            }
                        }
                    }).responseText;
                }
            }
            if (save_update_check == "1" || save_update_check == "2") {
                var table = document.getElementById('data_entry_body');
                var alldata = [];
                var checker = "false";
                for (var i = 0, row; row = table.rows[i]; i++) {
                    //date check
                    //check if any column left empty
                    for (var j = 1, col; col = row.cells[j]; j++) {
                        if (col.children[0].value == "" && j != 19) {
                            col.children[0].style.background = "#FFC8C8";
                            checker = "true";
                        } else {
                            col.children[0].style.background = "white";
                        }
                    }
                    //console.log(row.cells[0].getAttribute("P_Number"));
                    //Get all the data from controls inside <td>
                    var data = {};
                    data["CF_Code"] = $("#cf_code").val();
                    data["cf_link_code"] = $("#cf_link_code").val();
                    data["Row_No"] = row.cells[0].innerHTML;
                    //data["Screening_Date"] = $("#frm_year").val()+"-"+ $("#frm_month").val()+"-"+row.cells[1].children[0].value;
                    //data["Screening_Date"] = row.cells[1].children[0].value;

                    //Added on 2019-07-17
                    var dedt = row.cells[1].children[0].value.split('-');
                    if (dedt == "") {
                        bootbox.alert("Screening Date Format မှားယွင်းနေသည်။\n မသေချာလျှင် (09-09-0999) ဟုထည့်သွင်းပါ။")
                            .on('hidden.bs.modal', function() {
                                row.cells[1].children[0].focus();
                            });
                        $(button).prop("disabled", false);
                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                        return false;
                    } else {
                        dedt = dedt; //.split('-')
                        //alert(isValidDate(dedt[0], dedt[1], dedt[2]));
                        if (isValidDate(dedt[0], dedt[1], dedt[2]) == true) {
                            data["Screening_Date"] = sortDate(row.cells[1].children[0].value);
                        } else {
                            bootbox.alert(
                                    "Screening Date Format မှားယွင်းနေသည်။\n မသေချာလျှင် (09-09-0999) ဟုထည့်သွင်းပါ။")
                                .on('hidden.bs.modal', function() {
                                    row.cells[1].children[0].focus();
                                });
                            $(button).prop("disabled", false);
                            $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                            return false;
                        }
                    }
                    //Added on 2019-07-17 end

                    // data["Screening_Date"] = sortDate(row.cells[1].children[0].value);
                    var pt_name = (row.cells[2].children[0].value).replace(/"/, "");
                    pt_name = pt_name.replace(/'/, "");
                    data["Pt_Name"] = pt_name;
                    data["Age_Year"] = row.cells[3].children[0].value;
                    data["Pt_Location"] = row.cells[4].children[0].value;
                    data["Pt_Address"] = row.cells[5].children[0].value;
                    data["Sex_Code"] = row.cells[6].children[0].value;
                    data["Preg_YN"] = row.cells[7].children[0].value;
                    data["Micro_Code"] = row.cells[8].children[0].value;
                    data["RDT_Code"] = row.cells[9].children[0].value;
                    data["IOC_Code"] = row.cells[10].children[0].value;
                    data["ACT_Code"] = row.cells[11].children[0].value;
                    data["CQ_Code"] = row.cells[12].children[0].value;
                    data["PQ_Code"] = row.cells[13].children[0].value;
                    data["Referral_Code"] = row.cells[14].children[0].value;
                    data["Malaria_Death"] = row.cells[15].children[0].value;
                    data["TG_Code"] = row.cells[16].children[0].value;
                    data["travel_yn"] = row.cells[17].children[0].value;
                    data["occupation"] = row.cells[18].children[0].value;
                    data["Remark"] = row.cells[19].children[0].value;

                    /* P_Number is 0, means this is a new record */
                    if (row.cells[0].getAttribute("P_Number") == "0") {
                        alldata.push(data);
                    }
                    /* P_Number is not 0, so this is an existing record. It will be updated with the new values. */
                    else {
                        if (checker == "true") {
                            $(button).prop("disabled", false);
                            $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                            return false;
                        } else {
                            data["P_Number"] = row.cells[0].getAttribute("P_Number");
                            var data_to_update = JSON.stringify(data);
                            console.log('this is update data : ', data_to_update);
                            var xmlhttp1 = new XMLHttpRequest();
                            xmlhttp1.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    if (xmlhttp1.responseText == "1") {
                                        // bootbox.alert("Successfully updated!", function () {
                                        //     // location.href = '/';
                                        // });
                                    } else {
                                        bootbox.confirm(xmlhttp1.responseText, function(result) {
                                            if (result == true) {
                                                location.href = '/';
                                            } else {
                                                $(button).prop("disabled", false);
                                                $(button).html(
                                                    '<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                            }
                                        });
                                    }
                                }
                            }
                            xmlhttp1.open("POST", BACKEND_URL + 'update_tbl_individual_case_temp');
                            xmlhttp1.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                            xmlhttp1.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            xmlhttp1.send(data_to_update);
                        }
                    }
                }
                if (checker == "true") {
                    $(button).prop("disabled", false);
                    $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                    return false;
                } else {
                    // $(button).prop("disabled", true);
                    // $(button).html('<img src="img/default-loading.gif" style="width:20px;"/> ခေတ္တစောင့်ပါ');
                    var data_to_post = JSON.stringify(alldata);
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (xmlhttp.responseText == "1") {
                                $(button).prop('disabled', false);
                                $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                bootbox.alert("Successfully Individual Case saved!", function() {
                                    location.href = "/";
                                });
                            } else {
                                bootbox.confirm(xmlhttp.responseText, function(result) {
                                    if (result == true) {
                                        location.href = '/';
                                    } else {
                                        $(button).prop('disabled', false);
                                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                                    }
                                });
                            }
                        }
                    }
                    xmlhttp.open("POST", BACKEND_URL + 'save_tbl_individual_case_temp');
                    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    xmlhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xmlhttp.send(data_to_post);
                    // end save function
                }
            } else {
                console.log(save_update_check);
                bootbox.confirm(save_update_check, function(result) {
                    if (result == false) {
                        $(button).prop('disabled', false);
                        $(button).html('<li class="fa fa-floppy-o"></li> အားလုံးသိမ်းမည်');
                    } else {
                        location.href = '/';
                    }
                });
            }
        }

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
            console.log('this is work',row_count);
            if (row_count >= 17) {
                $(btn).prop('disabled', true);
                $(btn).html('<li class="fa fa-ban"></li> Maximun');
            } else {
                $(btn).prop('disabled', false);
                $(btn).html('<li class="fa fa-plus-square"></li> အသစ်တစ်ကြောင်းတိုးရန်');
            }
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
            $(btn).prop('disabled', true);
            $(btn).html("<li class='fa fa-spinner fa-spin'></li> ခေတ္တစောင့်ပါ");
            // var table = document.getElementById('data_entry_body');
            var row_count = get_row();
            if (row_count >= 17) {
                alert('maximum');
                //bootbox.alert('Reached Maximun Number of Rows.');
                checkBtn();
            } else {
                $.ajax({
                    type: "GET",
                    url: BACKEND_URL + "/get_patient_dataentry_row",

                    url: "/get_patient_dataentry_row",
                    }
                    data: "",
                    success: function(data) {
                        // console.log("this is new row", data);
                        $("#data_entry_body").append(data);
                        set_row_numbers();
                        checkBtn();
                        set_focus();
                    },
                    error: function(error) {
                        bootbox.alert(error.statusText);
                        checkBtn();
                    }
                    )};
                //"http://" + window.location.host +
            }

        // }

        function set_row_numbers() {
            var table = document.getElementById('data_entry_body');
            for (var i = 0, row; row = table.rows[i]; i++) {
                row.cells[0].innerHTML = i + 1;
                row.cells[20].children[0].setAttribute("rowNo", i + 1);
            }
        }
        set_row_numbers();

        function delete_row(btn) {
            var rowNum = $(btn).attr("rowNo");
            bootbox.confirm("Row အမှတ် " + rowNum + " တစ်ခုလုံးအား အပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ", function(c) {
                if (c == true) {
                    $(btn).closest('tr').remove();
                    set_row_numbers();
                }
                checkBtn();
            });
        }

        function delete_existing_row(p_number, sync, btn) {
            if (sync == "1") {
                bootbox.alert(
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
            bootbox.confirm("ယခုစာမျက်နှာအားပိတ်မည်။ သေချာပါက OK နှိပ်ပါ", function(result) {
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
                bootbox.alert("နံပါတ်များသာရိုက်သွင်းပါ");
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
                bootbox.alert("ထည့်သွင်းသောစာရင်းမှားယွင်းနေသည်။").on('hidden.bs.modal', () => {
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
                bootbox.alert("ထည့်သွင်းသောစာရင်းမှားယွင်းနေသည်။").on('hidden.bs.modal', () => {
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

</body>

<style>
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
        padding;
        0 5px;
    }

    .label-right {
        text-align: right;
    }

    .header {
        color: black;
        margin-top:20px;
        font-weight: 700;
        /* background: #D3492E; */
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

    table.dataTable thead tr {
        background-color: #4c4c4c;
        color: white;
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

    #data_entry_body>tr>td>input,
    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        padding: 0px;
        height: 30px;
    }

    #data_entry_body>tr>td>input {
        font-size: 12px;
        text-align: left;
        vertical-align: middle;
        width: 100%;
        padding: 0px;
        margin: 0px;
        border: none;
        height: 30px;
        font-weight: 600;
    }

    #data_entry_body>tr>td>select {
        font-size: 12px;
        text-align: left;
        height: 20px;
        width: 100%;
        border: none;
        height: 30px;
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

</html>
