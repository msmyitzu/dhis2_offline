var BACKEND_URL = "http://" + window.location.host + "/";

function load_lp_stateregion(target_sr_id, token) {
    if (target_sr_id != "0") {
        try {
            $("." + target_sr_id).html("<option>Loading...</option>");
            $("." + target_sr_id).prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + 'get_lp_state_region/',
                data: "",
                success: function(data) {
                    $("." + target_sr_id).html("");

                    $("." + target_sr_id).append("<option value='0'> ရွေးရန် </option>");
                    $("." + target_sr_id).prop("disabled", faltse);

                    jQuery.each(data, function(i, val) {
                        var opt = "<option value='" + val.sr_code + "'>" + val.sr_name + " | " + val.sr_name_mmr + "</option>";
                        $("." + target_sr_id).append(opt);
                    });

                }
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else {
        $("." + target_sr_id).html("");
    }
}

function set_focus(){
    var table = document.getElementById('data_entry_body');
    var i = get_row();
    table.rows[--i].cells[1].children[0].focus();
}

function load_lp_township(target_ts_id, sr_code, token, region_code) {
    if (sr_code != "0") {
        try {
            $("." + target_ts_id).html("<option>Loading...</option>");
            $("." + target_ts_id).prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + 'get_lp_township/' + sr_code,
                data: "",
                success: function(data) {
                    $("." + target_ts_id).html("");

                    $("." + target_ts_id).append("<option value='0'> ရွေးရန် </option>");
                    $("." + target_ts_id).prop("disabled", false);

                    jQuery.each(data, function(i, val) {
                        var opt = "<option value='" + val.ts_code + "'>" + val.ts_name + " | " + val.ts_name_mmr + "</option>";
                        $("." + target_ts_id).append(opt);
                    });

                    if (region_code != "") {
                        $("#select_region_code").val(region_code).trigger('change');
                    }


                }
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else {
        $("." + target_ts_id).html("");
    }
}

function load_tbl_hfm(target_control_id, ts_code, token, form_type = null) {
    console.log(ts_code);
    try {
        var form_code = "";

        if ($("#select_lp_form_cat").val() == "0") {
            // $('#select_lp_township_de').val('0').trigger('change');
            bootbox.alert("ပုံစံအမျိုးအစားရွေးပါ");
            return false;
        }

        $("#" + target_control_id).html("<option>Loading...</option>");
        $("#" + target_control_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            // url: BACKEND_URL + 'get_grab_hfconnect1/' + ts_code + "/" + $("#select_lp_form_cat").val(),
            url: BACKEND_URL + 'get_grab_hfconnect/' + ts_code ,
            data: "",
            success: function(data) {
                console.log(data);

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

function load_hfm(target_control_id, hf_code, token) {
    try {
        var form_code = "";

        if ($("#select_lp_form_cat").val() == "0") {
            bootbox.alert("ပုံစံအမျိုးအစားရွေးပါ");
            return false;
        } else if ($("#select_tbl_hfm_de").val() == "0") {
            bootbox.alert("ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ ရွေးပါ");
            return false;
        }

        $("#" + target_control_id).html("<option>Loading...</option>");
        $("#" + target_control_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_grab_hfm/' + hf_code,
            data: "",
            success: function(data) {

                $("#" + target_control_id).html("");

                $("#" + target_control_id).append("<option value='0'> ရွေးရန် </option>");
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function(i, val) {

                    if(!val.sc_name.includes("RHC")){
                        var opt = "<option value='" + val.sc_code + "'>" + val.sc_name + " | " + val.sc_name_mm + "</option>";
                        $("#" + target_control_id).append(opt);
                    }

                });
            }
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function load_lp_district(target_district_id, sr_id, token) {
    try {
        $("#" + target_district_id).html("<option>Loading...</option>");
        $("#" + target_control_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_lp_district/' + sr_id,
            data: "",
            success: function(data) {
                $("#" + target_district_id).html("");

                $("#" + target_district_id).append("<option value='0'> ရွေးရန် </option>");
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function(i, val) {
                    var opt = "<option value='" + val.d_id + "'>" + val.d_name + " | " + val.d_name_mmr + "</option>";
                    $("#" + target_district_id).append(opt);
                });
            }
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function load_lp_hftype(token) {
    try {
        $("#select_lp_hftype").html("<option>Loading...</option>");
        $("#select_lp_hftype").prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_lp_hftype',
            data: "",
            success: function(data) {
                $("#select_lp_hftype").html("");
                $("#select_lp_hftype").append("<option value='0'> ရွေးရန် </option>");
                $("#select_lp_hftype").prop("disabled", false);

                jQuery.each(data, function(i, val) {
                    var opt = "<option value='" + val.hftypeid + "'>" + val.hftypeeng + "</option>";
                    $("#select_lp_hftype").append(opt);
                });
            }
        });
    } catch (error) {
        bootbox.alert(error.message);
    }
}

function change_rhcsc_label(select_id) {
    if (select_id == "5" || select_id == "1" || select_id == "6" || select_id == "4" || select_id == "7") {
        $("#rhc_label").html("မြို့နယ်/တိုက်နယ်ဆေးရုံ/ကျန်းမာရေးဌာန");
        $("#sc_label").html("ကျန်းမာရေးဌာနခွဲ");
    } else if (select_id == "0") {
        bootbox.alert("ပုံစံအမျိုးအစားမှန်အောင်ရွေးပါ");
        return false;
    } else {
        $("#rhc_label").html("ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ");
        $("#sc_label").html("စေတနာဝန်ထမ်းကျေးရွာ");
    }
    // if($('#select_lp_township_de').val() != '0'){
    //     $('#select_lp_township_de').val('0').trigger('change');
    // }
    $('#select_lp_township_de').trigger('change');
}

function load_lp_form_cat(target_control_id, token) {
    try {
        $("#" + target_control_id).html("<option>Loading...</option>");
        $("#" + target_control_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_lp_form_cat',
            data: "",
            success: function(data) {
                $("#" + target_control_id).html("");

                $("#" + target_control_id).append("<option value='0'> ရွေးရန် </option>");
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function(i, val) {
                    var opt = "<option value='" + val.form_code + "'>" + val.form_name + "</option>";
                    $("#" + target_control_id).append(opt);
                });
            }
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function load_reportpage(select_reportpage, token) {
    try {
        if (select_reportpage == "reportby_sc") {
            $('#report_sc_page').show();
            $('#report_rhc_page').hide();
            $('#report_by_township').hide();
            $('#report_title_id').html("ကျန်းမာရေးဌာနခွဲအလိုက် အစီရင်ခံစာ");
        } else if (select_reportpage == "reportby_rhc") {
            $('#report_rhc_page').show();
            $('#report_sc_page').hide();
            $('#report_by_township').hide();
            $('#report_title_id').html("ကျန်းမာရေးဌာနအလိုက် အစီရင်ခံစာ");
        } else if (select_reportpage == "reportby_township") {
            $('#report_rhc_page').hide();
            $('#report_sc_page').hide();
            $('#report_by_township').show();
        } else if (select_reportpage == 'default') {
            $('#report_rhc_page').hide();
            $('#report_sc_page').hide();
            $('#report_by_township').hide();
        } else {
            bootbox.alert("စာရင်းချုပ်အမျိုးအစားရွှေးချယ်ပါ")
        }
    } catch (error) {
        bootbox.alert(error.message);
    }
}

function load_lp_tbl_hfm() {

    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_tbl_hfm',
            data: "",
            success: function(data) {
                $("#lp_tbl_hfm_container").html("");

                jQuery.each(data, function(i, val) {
                    var tr = "<tr>";
                    tr += "<td>" + val.SC_Code + "</td>";
                    tr += "<td>" + val.HF_Code + "</td>";
                    tr += "<td>" + val.TS_Code + "</td>";
                    tr += "<td>" + val.HFTypeID + "</td>";
                    tr += "<td>" + val.SC_Name + "</td>";
                    tr += "<td>" + val.SC_Name_MM + "</td>";
                    tr += "<td>" + val.Org + "</td>";
                    tr += "<td>" + val.MIMU_Code + "</td>";
                    tr += "<td>" + val.HF_CodeReport + "</td>";
                    tr += "<td>" + val.HF_CodeReportingUnit + "</td>";
                    tr += "<td>" + val.FocalPerson + "</td>";
                    tr += "</tr>";
                    $("#lp_tbl_hfm_container").append(tr);
                });

                $("#table_tbl_hfm_loader").hide();

                $('#table_tbl_hfm').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    "pageLength": 5,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false,
                    'select': false,
                    'scrollX': true,
                    "order": [
                        [4, "desc"]
                    ]
                });
            }
        });
    } catch (error) {
        bootbox.alert(error.message);
    }
}

function generate_table(containerid, data) {
    console.log(myObj);
}

function load_healthfacility(containerid) {
    var ts_code = $("#select_lp_township_hf").val();
    var hftypeid = $("#select_lp_hftype").val();
    $("#select_lp_hftype").prop("disabled", true);

    //$("#" + containerid).html('');
    $("#" + containerid).html(
        '<tr><td colspan="5" style="text-align:center"><img src="img/default-loading.gif" style="width:20px;"/></td></tr>'
    );

    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_grab_healthfacilitypage/' + ts_code + '/' + hftypeid,
            data: "",
            success: function(data) {
                $("#" + containerid).html('');
                if (data.length > 0) {
                    jQuery.each(data, function(i, val) {
                        var tr = "<tr>";
                        tr += "<td>" + val.SC_Name + "</td>";
                        tr += "<td>" + val.SC_Name_MM + "</td>";
                        tr += "<td>" + val.HF_Name_MM + "</td>";
                        tr += "<td>" + val.Org + "</td>";
                        tr += "<td>" + val.FocalPerson + "</td>";
                        tr += "</tr>";
                        $("#" + containerid).append(tr);
                    });
                } else {
                    var tr = '<tr><td colspan="5">No data available in table.</td></tr>';
                    $("#" + containerid).append(tr);
                }


                $("#select_lp_hftype").prop("disabled", false);
            }
        });
    } catch (error) {
        bootbox.alert(error.message);
    }
}

function highlight_row(item) {
    reset_row_border("data_entry_body");
    var row = $(item).closest("tr").children();
    row.css("border-top", "2px solid #FF6B50");
    row.css("border-bottom", "2px solid #FF6B50");
    row.first().css("border-left", "2px solid #FF6B50");
    row.last().css("border-right", "2px solid #FF6B50");
}

function reset_row_border(tablename) {
    var table = document.getElementById(tablename);
    for (var i = 0, row; row = table.rows[i]; i++) {
        $(row).children().css("border", "1px solid grey");
    }
}

function clear_data_entry() {
    /*$("#select_hfm_de").select2("val", "");
    $("#select_tbl_hfm_de").select2("val", "");
    $("#select_lp_township_de").select2("val", "");

    $("#select_lp_form_cat").val("0").trigger('change');*/
    $("#select_lp_state_region").val("0").trigger('change');
    $("#form_number").val("");
    $("#form-date").val("");
    $("#select_tbl_hfm_de").html("");
    $("#select_hfm_de").html("");
    $("#select_lp_form_cat").val("0").trigger('change');
}

function submit_data_entry_form(role_id) {
    var btn_text = show_button_loading('btn_submit_data_entry_form');
    //$("#btn_submit_data_entry_form").html('<img src="img/default-loading.gif" style="width:20px;"/>'+btn_text);

    var form_code = $("#select_lp_form_cat").val();
    // console.log(form_code);
    var form_no = $("#form_number").val(); // to make cf_link
    var sc_code = $("#select_hfm_de").val();
    var form_date = $("#form-date").val().split("/");
    var pmonth = form_date[0]; // to make cf_link
    var pyear = form_date[1]; // to make cf_link
    var role_id = role_id; //to make cf_link
    var errMsg = "";
    
    if (form_code == 0 || form_code == "0") {
        errMsg += "<p>• ပုံစံအမျိုးအစားရွေးပါ</p>";
    }
    if (form_no == "0" || form_no == "") {
        errMsg += "<p>• ပုံစံအမှတ်ဖြည့်ပါ</p>";
    }
    if ($("#select_lp_state_region").val() == "0") {
        errMsg += "<p>• ပြည်နယ်/တိုင်းဒေသကြီးရွေးပါ</p>";
    }
    if ($("#select_lp_township_de").val() == "0") {
        errMsg += "<p>• မြို့နယ်ရွေးပါ</p>";
    }
    if ($("#select_tbl_hfm_de").val() == "0" && $("#select_lp_form_cat").val() == "5" || $("#select_lp_form_cat").val() == "1" || $("#select_lp_form_cat").val() == "6" || $("#select_lp_form_cat").val() == "4" || $("#select_lp_form_cat").val() == "7") {
        errMsg += "<p>• မြို့နယ်/တိုက်နယ်ဆေးရုံ/ကျန်းမာရေးဌာနခွဲရွေးပါ </p>";
    } else {
        errMsg += "<p>• ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲရွေးပါ </p>";
    }
    if ($("#select_hfm_de").val() == "0" && $("#select_lp_form_cat").val() == "5" || $("#select_lp_form_cat").val() == "1" || $("#select_lp_form_cat").val() == "6" || $("#select_lp_form_cat").val() == "4" || $("#select_lp_form_cat").val() == "7") {
        errMsg += "<p>• ကျန်းမာရေးဌာနခွဲရွေးပါ</p>";
    } else {
        errMsg += "<p>• စေတနာဝန်ထမ်းကျေးရွာရွေးပါ</p>";
    }
    if (form_date == "") {
        errMsg += "<p>• ခုနစ်/လဖြည့်ပါ</p>";

    }
    if (errMsg != "") {
        bootbox.alert(errMsg);
        reset_button_loading('btn_submit_data_entry_form', btn_text);
        return false;
    }

    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_tbl_core_facility_temp_by_code',
            data: {
                form_code: form_code,
                form_no: form_no,
                sc_code: sc_code,
                pmonth: pmonth,
                pyear: pyear
            },
            success: function(data) {
                if (data == "0") {
                    //     var c = bootbox.confirm("ဖောင်အသစ်တစ်ခုပြုလုပ်မည်။ သေချာပါက OK နှိပ်ပါ");
                    //     if (c == false) {
                    //         reset_button_loading('btn_submit_data_entry_form', btn_text);
                    //         return false;
                    //     }
                    // } else {
                    //     $("#cf_link_code").val(data);
                    // }
                    bootbox.confirm('<p>• ဖောင်အသစ်တစ်ခုပြုလုပ်မည်။ သေချာပါက OK နှိပ်ပါ</p>', function(result) {
                        if (result == false) {
                            reset_button_loading('btn_submit_data_entry_form', btn_text);
                        } else {
                            $("#frm-patient-register-form").submit();
                        }
                    });
                } else {
                    $('#cf_link_code').val(data);
                    $("#frm-patient-register-form").submit();
                }
            }
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function show_button_loading(buttonid) {
    var button_text = $("#" + buttonid).html();
    $("#" + buttonid).html('<img src="img/default-loading.gif" style="width:20px;"/>' + button_text);
    $('#' + buttonid).prop('disabled', true);
    return button_text;
}

function reset_button_loading(buttonid, button_text) {
    $("#" + buttonid).html(button_text);
    $('#' + buttonid).prop('disabled', false);
}

function load_last_corefacility() {
    //$("#last_corefacility_container").html('<img src="img/default-loading.gif" style="width:30px;"/>');

    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + 'get_grab_last_corefacility',
            success: function(data) {
                $("#last_corefacility_container").html("");

                jQuery.each(data, function(i, val) {
                    // console.log(val);
                    $("#last_corefacility_container").append('<div class="form-group">' + val.Form_Name + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.Form_No + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.sr_name_mmr + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.ts_name_mmr + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.HFReporting + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.HFName + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.Month_Name + " " + val.PYear + '</div>');
                    $("#last_corefacility_container").append('<div class="form-group">' + val.DE_DateTime + '</div>');

                    $("#last_corefacility_container").append('<div class="form-group" style="text-align:center;"><a href="offline-forms">အချက်အလက်အားလုံးကြည့်ရန်</a></div>');
                });
            }
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function yesno(yncode) {
    switch (yncode) {
        case "0":
            return "No";
            break;
        case "1":
            return "Yes";
            break;
        case "7":
            return "N/A";
            break;
        case "9":
            return "Missing";
            break;
        case "77":
            return "N/A";
            break;
        case "99":
            return "Missing";
            break;
    }
}

function ynTxt2Code(ynTxt) {
    switch (ynTxt) {
        case 'No':
            return 0;
            break;
        case 'Yes':
            return 1;
            break;
        case 'N/A':
            return 7;
            break;
        case 'Missing':
            return 9;
            break;
    }
}

function sex_name(sexcode) {
    switch (sexcode) {
        case "0":
            return "Male";
            break;
        case "1":
            return "Female";
            break;
        case "9":
            return "Missing";
            break;
    }
}

//// Check Table Vilidation ///

function dateCheck(day, event) {
    console.log('you are in datecheck');
    var date_regx = /^(\d{1,2})(\-)(\d{1,2})(\-)(\d{4})$/;
    var input_date = $(day).val();
    var input_date_splited = input_date.split('-');
    var year = parseInt(input_date_splited[2]);
    var month = parseInt(input_date_splited[1]);
    var d = parseInt(input_date_splited[0]);
    // var tr = $(day).closest('tr');
    // var form_month = document.getElementById('frm_month').value;
    // var form_year = document.getElementById('frm_year').value;

    if (input_date != "") {
        if (!(date_regx.test(input_date))) {
            bootbox.alert('<p>• ရက်စွဲပုံစံမှားနေသည်။ "ရက်-လ-ခုနှစ်" ပုံစံရေးပါ။<strong>Eg => ("01-12-1999")</strong></p>', function() {
                // return tr.find('td:eq(1) input').value = "";
                return day.parentElement.parentElement.children[1].children[0].focus();
            });
        } else {
            if (new Date(year, month - 1, d).getTime() != new Date('9-9-999').getTime() && new Date(year, month - 1, d).getTime() > new Date().getTime()) {
                bootbox.alert('ထည့်သွင်းသောရက်စွဲမှားနေသည်။\nမသေချာလျှင်\(9-9-999\)ဟုထည့်သွင်းပါ', function() {
                    return day.parentElement.parentElement.children[1].children[0].focus();
                });
            } else {
                console.log("your date is equal with 9-9-999");
            }
        }
    }

    // } else {
    //     if (new Date(year, month - 1, day).getTime != new Date('9-9-999').getTime()) {
    //         if (new Date(year, month - 1, day).getTime() > Date.now()) {
    //             bootbox.alert('ထည့်သွင်းသောရက်စွဲမှားနေသည်။\nမသေချာလျှင်\(9-9-999\)ဟုထည့်သွင်းပါ', function() {
    //                 return tr.find('td:eq(1) input').select();
    //             });
    //         }
    //     }
    // }
}

function checkAge(age) {
    var tr = $(age).closest('tr');
    var char = parseInt($(age).val());
    var sex = tr.find('.sex, .sexvhv').val();
    var preg = tr.find('.preg, .pregvhv').val();
    if ((char >= 0) && (char <= 110)) {
        if(char <= 10 || char >= 60){
            if(sex == 1 && preg == 1 ){
                bootbox.alert("အသက် ၁၀ နှစ်နှင့် ၆၀ အတွင်းသာ \"ကိုယ်ဝန်ဆောင်\" ရွေးခွင့်ရှိသည်။", function(e){
                }).on('hidden.bs.modal',function(){
                    $(age).focus();
                });
                tr.find('.preg, .pregvhv').val( tr.find('.preg, .pregvhv').val() == '' ? '' : '0' ).trigger('change').css('cursor', 'not-allowed').prop('disabled', true);
            }else{
                tr.find('.preg, .pregvhv').val( tr.find('.preg, .pregvhv').val() == '' ? '' : '0' ).trigger('change').css('cursor', 'not-allowed').prop('disabled', true);
            }
        }else{
            tr.find('td:eq(4) select').focus();
            // tr.find('td:eq(4) select').prop('selectedIndex', 0);
            // tr.find('.sex').val('').trigger('change');
            tr.find('.preg, .pregvhv').val( tr.find('.preg, .pregvhv').val() == '0' ? '0' : '' ).trigger('change').css('cursor', 'default')
            .prop('disabled', false);
        }
    } else {
        if (char == 999) {
            tr.find('td:eq(4) select').focus();
            // tr.find('td:eq(4) select').prop('selectedIndex', 0);
        } else {
            bootbox.alert("အသက် ၁၁၀ အောက်ဖြစ်ရမည်။ (သို့) ၉၉၉ ဟုရိုက်ပါ။")
            .on('hidden.bs.modal', function(){
                $(age).focus();
            });
            tr.find('td:eq(3) input').focus();
            tr.find('td:eq(3) input').val('');
        }
    }
}

function location_changed(location) {
    var currentTR = $(location).closest('tr');
    if (location.value == '10' || location.value == '20' || location.value == '30' ) {
        currentTR.find('td:eq(5) input').prop('disabled', false);
        currentTR.find('td:eq(5) input').select();
        currentTR.find('td:eq(5) input').focus();
    } else {
        currentTR.find('td:eq(5) input').prop('disabled', true);
        currentTR.find('td:eq(5) input').val('N/A');
    }
}

function checkAddress(address) {
    var tr = $(address).closest('tr');

    if (address.value == "1") {
        //tr.find('td:eq(5) input').val()
        tr.find('td:eq(5) input').prop("disabled", true);
        tr.find('td:eq(5) input').val('0');
        tr.find('td:eq(5) input').css('cursor', 'not-allowed');
        tr.find('td:eq(6) select').prop('selectedIndex', 0);
        tr.find('td:eq(6) select').focus();
    } else if (address.value == "9") {
        tr.find('td:eq(5) input').prop("disabled", true);
        tr.find('td:eq(5) input').val('0');
        tr.find('td:eq(5) input').css('cursor', 'not-allowed');
        tr.find('td:eq(6) select').prop('selectedIndex', 0);
        tr.find('td:eq(6) input').focus();
    } else {
        tr.find('td:eq(5) input').prop("disabled", false);
        tr.find('td:eq(5) input').focus();
    }
} // not in use

function checkSex(data) {
    var tr = $(data).closest('tr');
    if (data.value == '0') {
        // tr.find('td:eq(7) select').prop('selectedIndex', 3);
        // tr.find('td:eq(7) select').prop('disabled', true);
        // tr.find('td:eq(7) select').css('cursor', 'not-allowed');
        tr.find('td:eq(7) select').val(7).trigger('change').prop('disabled', true).css('cursor', 'not-allowed');
    } else {
        var age = tr.find('td:eq(3) input').val();
        if (age < 10 || age > 60) {
            // bootbox.alert("အသက် ၁၀ နှစ်နှင့် ၆၀ အတွင်းသာ \"ကိုယ်ဝန်ဆောင်\" ရွေးခွင့်ရှိသည်။", function(e){
            // }).on('hidden.bs.modal',function(){
            //     $(data).focus();
            // });
            // tr.find('td:eq(7) select').prop('selectedIndex', 1);
            // tr.find('td:eq(7) select').prop('disabled', true);
            // tr.find('td:eq(7) select').css('cursor', 'not-allowed');
            tr.find('td:eq(7) select').val(0).trigger('change').prop('disabled', true).css('cursor', 'not-allowed');
        } else {
            //bootbox.alert("Age between 10 year and 60 year can choose preg field");
            // tr.find('td:eq(7) select').prop('selectedIndex', 1);
            // tr.find('td:eq(7) select').prop('disabled', false);
            // tr.find('td:eq(7) select').css('cursor', 'default');
            tr.find('td:eq(7) select').val(0).trigger('change').prop('disabled', false).css('cursor', 'default');
        }
    }
}

//not use
function checkRDT(rdt) {
    var tr = $(rdt).closest('tr');
    if (rdt.value == '0' || rdt.value == '7' || rdt.value == '9') {
        tr.find('td:eq(9) select, td:eq(10) select, td:eq(11) input, td:eq(12) input, td:eq(13) select, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) input, td:eq(19) input')
            .css('background', '#EEEEEE');
        tr.find('td:eq(9) select').prop('selectedIndex', 3); //in,out patient
        tr.find('td:eq(10) select').prop('selectedIndex', 8); //ACT
        tr.find('td:eq(11) select').prop('disabled', false);
        tr.find('td:eq(11) input').val('N/A'); //CQ
        tr.find('td:eq(12) input').val('N/A'); //PQ
        tr.find('td:eq(13) select').prop('selectedIndex', 3); //Referral
        tr.find('td:eq(14) select').prop('selectedIndex', 3); //MMD
        tr.find('td:eq(15) select').prop('selectedIndex', 9); //TG
        tr.find('td:eq(16) select').prop('selectedIndex', 3); //Travel Record
        tr.find('td:eq(17) select').prop('selectedIndex', 7); //Occupation
        tr.find('td:eq(18) input').val('N/A'); //Remak
        tr.find('td:eq(19) input').focus(); //focus Travel Record
    } else {
        tr.find('td:eq(9) select, td:eq(10) select, td:eq(11) input, td:eq(12) input, td:eq(13) select, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) input, td:eq(19) input')
            .css('background', '#FFC8C8');
        tr.find('td:eq(9) select').prop('selectedIndex', 0);
        tr.find('td:eq(9) select').focus();
        tr.find('td:eq(10) select').prop('selectedIndex', 0);
        tr.find('td:eq(11) input').val('');
        tr.find('td:eq(11) input').prop('disabled', false);
        tr.find('td:eq(11) input').attr('placeholder', 'ဆေးလုံးရေ');
        tr.find('td:eq(12) input').val('');
        tr.find('td:eq(12) input').attr('placeholder', 'ဆေးလုံးရေ');
        tr.find('td:eq(13) select').prop('selectedIndex', 0);
        tr.find('td:eq(14) select').prop('selectedIndex', 0);
        tr.find('td:eq(15) select').prop('selectedIndex', 0);
        tr.find('td:eq(16) select').prop('selectedIndex', 0);
        tr.find('td:eq(17) select').prop('selectedIndex', 0);
        tr.find('td:eq(18) input').attr('placeholder', 'ရွေးပါ');
        tr.find('td:eq(19) input').attr('placeholder', 'ရွေးပါ');
    }
}

function checkMpdeath(mmm) {
    var td = $(mmm).closest('tr');
    var rcs = td.find('td:eq(8) select').val();
    var rdt = td.find('td:eq(9) select').val();
    if (mmm.value == '1') {
        if ((rcs == '0' || rcs == '7' || rcs == '9') && (rdt == '0' || rdt == '7' || rdt == '9')) {
            bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။')
            .on('hidden.bs.modal', function(){
                $(mmm).focus();
            });
        } else {
            bootbox.alert("ငှက်ဖျားပိုးကြောင့်သေဆုံးခြင်းသေချာမှရွေးပါ")
            .on('hidden.bs.modal', function(){
                $(mmm).focus();
            });
        }
    }
}

function clickOnRow() {
    $('.rcs, .rdt').on('change', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var rcs = this ;
        var tr = $(this).closest("tr");
        var age = tr.find('.age').val();
        var sex = tr.find('.sex').val();
        var preg = tr.find('.preg').val();
        var rdt_value, rcs_value = '';
        if (this.className === 'rcs') {
            rdt_value = tr.find('.rdt').val();
            rcs_value = this.value;
        } else {
            rdt_value = this.value;
            rcs_value = tr.find('.rcs').val();
        }
        var positive_value = [1, 2, 3, 4];
        if (positive_value.indexOf(parseInt(rcs_value)) !== -1 || positive_value.indexOf(parseInt(rdt_value)) !== -1) {
            //positive patient
            tr.find('td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select,' +
                ' td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input').css('background', '#FFC8C8');
            tr.find('td:eq(10) select').prop('selectedIndex', 0);
            tr.find('td:eq(11) select').prop('selectedIndex', 0);
            tr.find('td:eq(12) input').val('');
            tr.find('td:eq(12) input').attr('placeholder', 'ဆေးလုံးရေ');
            tr.find('td:eq(13) input').val('');
            tr.find('td:eq(13) input').attr('placeholder', 'ဆေးလုံးရေ');
            tr.find('td:eq(14) select').prop('selectedIndex', 0);
            tr.find('td:eq(15) select').prop('selectedIndex', 0);
            tr.find('td:eq(16) select').prop('selectedIndex', 0);
            tr.find('td:eq(17) select').prop('selectedIndex', 0);
            tr.find('td:eq(18) select').prop('selectedIndex', 0);
            tr.find('td:eq(19) input').val('N/A');
        } else {
            //negative patient
            if (rcs_value == 7 && rdt_value == 7) {
                bootbox.alert("Please Fill at least one exam result.").on('hidden.bs.modal', function(){
                    $(rcs).focus();
                });
            } else {
                tr.find('td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select,' +
                    ' td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input').css('background', '');
                tr.find('td:eq(10) select').val('7').trigger('change'); //IO Cat
                tr.find('td:eq(11) select').val('7').trigger('change'); //ACT
                tr.find('td:eq(12) input').val('77');                   //CQ
                tr.find('td:eq(13) input').val('77');                   //PQ
                tr.find('td:eq(14) select').val('7').trigger('change'); //Referral
                tr.find('td:eq(15) select').val('7').trigger('change'); //MMD
                tr.find('td:eq(16) select').val('77').trigger('change');//TG
                tr.find('td:eq(17) select').val('7').trigger('change'); //Travel Record
                tr.find('td:eq(18) select').val('7').trigger('change'); //Occupation
                tr.find('td:eq(19) input').val('N/A');                  //Remark
            }
        }
    });
    $('.act').on('change', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var act = this ;
        var tr = $(this).closest('tr');
        var age = tr.find('.age').val();
        var rdt_value = tr.find('.rdt').val();
        var rcs_value = tr.find('.rcs').val();
        var positive_value = [1, 2, 3, 4];
        console.log(act.value);
        switch (this.value) {
            case '0':
                if ((positive_value.indexOf(parseInt(rcs_value)) === 0 || positive_value.indexOf(parseInt(rcs_value)) === 2) ||
                    (positive_value.indexOf(parseInt(rdt_value)) === 0 || positive_value.indexOf(parseInt(rdt_value)) === 2)) {
                    bootbox.alert('Pf or Mix Infection လူနာတွင် ACT ဆေးပေးရမည်။')
                    .on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                }
                break;
            case '1':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                        positive_value.indexOf(parseInt(rcs_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if (parseInt(age) < 1) {
                    bootbox.alert("အသက်တစ်နှစ်အောက်တွင်သုံးလုံးသာပေးသည်။").on('hidden.bs.modal', function(){
                        $(act).focus();
                    });;
                }
                break;
            case '2':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                        positive_value.indexOf(parseInt(rcs_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if (parseInt(age) >= 1 && parseInt(age) <= 4) {
                    bootbox.alert("အသက်တစ်နှစ်နှင့်လေးနှစ်တွင်ခြောက်လုံးသာပေးသည်။").on('hidden.bs.modal', function(){
                        $(act).focus();
                    });;
                }
                break;
            case '3':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                        positive_value.indexOf(parseInt(rcs_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if (parseInt(age) >= 5 && parseInt(age) <= 9) {
                    bootbox.alert("အသက်ငါးနှစ်နှင့်ကိုးနှစ်တွင်ဆယ့်နှစ်လုံးသာပေးသည်။").on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                }
                break;
            case '4':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                        positive_value.indexOf(parseInt(rcs_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                } else if (parseInt(age) >= 10 && parseInt(age) <= 14) {
                    bootbox.alert("အသက်ဆယ်နှစ်နှင့်ဆယ့်လေးနှစ်တွင်ဆယ့်ရှစ်လုံးသာပေးသည်။").on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                }
                break;
            case '7':
                if ((positive_value.indexOf(parseInt(rcs_value)) === 0 || positive_value.indexOf(parseInt(rcs_value)) === 2) ||
                    (positive_value.indexOf(parseInt(rdt_value)) === 0 || positive_value.indexOf(parseInt(rdt_value)) === 2)) {
                    bootbox.alert('Pf or Mix Infection လူနာတွင် ACT ဆေးပေးရမည်။')
                    .on('hidden.bs.modal', function(){
                        $(act).focus();
                    });
                }
                break;
        }
    });
    $('.cq, .pq').on('change', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var cqpq = this ;
        var tr = $(this).closest('tr');
        var age = tr.find('.age').val();
        var preg = tr.find('.preg').val();
        var rdt_value = tr.find('.rdt').val();
        var rcs_value = tr.find('.rcs').val();
        var cq = tr.find('.cq').val();
        var pq = tr.find('.pq').val();
        var positive_value = [1, 2, 3, 4];
        if (cqpq.className === 'cq only-integer') {
            if (parseInt(cq) > 50) {
                if (parseInt(cq) != 77 && parseInt(cq) != 99) {
                    // alert('show me');
                    bootbox.alert('ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77)')
                    .on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }else if((parseInt(cq) == 0 || parseInt(cq) == 77 || parseInt(cq) == 99)
                && (parseInt(rcs_value) == 2 || parseInt(rdt_value) == 2)) {
                    bootbox.alert('Pv ပိုးတွေ့လျှင် CQ ပေးရမည်။').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
            } else {
                if (parseInt(rcs_value) == 1 || parseInt(rdt_value) == 1 || parseInt(rcs_value) == 3 || parseInt(rdt_value) == 3 ) {
                    bootbox.alert('Pf/Mixed ပိုးတွင် CQ မပေးပါ။(N/A for 77)').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
            }
        }
        if (this.className === 'pq only-integer') {
            var pq = this.value;
            if (parseInt(pq) > 50) {
                if (parseInt(pq) != 77 && parseInt(pq) != 99) {
                    bootbox.alert('ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77)').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }else if((positive_value.indexOf(parseInt(rcs_value)) != -1 || positive_value.indexOf(parseInt(rdt_value)) != -1)
                && (parseInt(pq) == 0 || parseInt(pq) == 77 || parseInt(pq) == 99)){
                    bootbox.alert('Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
            } else {
                if (parseInt(age) < 1 || parseInt(preg) == 1) {
                    bootbox.alert('အသက်(၁)နှစ်အောက်နှင့်ကိုယ်ဝန်ဆောင်များကို PQ မပေးပါ။(N/A for 77)').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
            }
        }
    });
    $('.rdtvhv').on('change', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var rdtvhv = this ;
        var tr = $(this).closest('tr');
        var positive_value = [1, 2, 3];
        if (positive_value.indexOf(parseInt(this.value)) !== -1) { //positive patient
            tr.find('td:eq(9) select, td:eq(10) select, td:eq(11) input, td:eq(12) input, td:eq(13) select, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) input')
                .css('background', '#FFC8C8');
            // tr.find('td:eq(9) select').prop('selectedIndex', 0);
            // tr.find('td:eq(10) select').prop('selectedIndex', 0);
            // tr.find('td:eq(11) input').val('');
            // tr.find('td:eq(11) input').prop('disabled', false);
            // tr.find('td:eq(11) input').attr('placeholder', 'ဆေးလုံးရေ');
            // tr.find('td:eq(12) input').val('');
            // tr.find('td:eq(12) input').attr('placeholder', 'ဆေးလုံးရေ');
            // tr.find('td:eq(13) select').prop('selectedIndex', 0);
            // tr.find('td:eq(14) select').prop('selectedIndex', 0);
            // tr.find('td:eq(15) select').prop('selectedIndex', 0);
            // tr.find('td:eq(16) select').prop('selectedIndex', 0);
            // tr.find('td:eq(17) select').prop('selectedIndex', 0);
            tr.find('td:eq(9) select').val('').trigger('change');
            tr.find('td:eq(10) select').val('').trigger('change');
            tr.find('td:eq(11) input').val('').attr('placeholder', 'ဆေးလုံးရေ');
            tr.find('td:eq(12) input').val('').attr('placeholder', 'ဆေးလုံးရေ');
            tr.find('td:eq(13) select').val('').trigger('change');
            tr.find('td:eq(14) select').val('').trigger('change');
            tr.find('td:eq(15) select').val('').trigger('change');
            tr.find('td:eq(16) select').val('').trigger('change');
            tr.find('td:eq(17) select').val('').trigger('change');
            tr.find('td:eq(18) input').val("N/A");
        } else {
            if (parseInt(this.value) === 7) {
                bootbox.alert('ငှက်ဖျားပိုးစစ်ပေးပါ။').on('hidden.bs.modal', function(){
                    $(rdtvhv).focus();
                });
            } else {
                tr.find('td:eq(9) select, td:eq(10) select, td:eq(11) input, td:eq(12) input, td:eq(13) select, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) input')
                    .css('background', '');
                tr.find('td:eq(9) select').val(7).trigger('change'); //in,out patient
                tr.find('td:eq(10) select').val(7).trigger('change'); //ACT
                tr.find('td:eq(11) select').val(7).trigger('change')
                tr.find('td:eq(11) input').val('77'); //CQ
                tr.find('td:eq(12) input').val('77'); //PQ
                tr.find('td:eq(13) select').val(7).trigger('change'); //Referral
                tr.find('td:eq(14) select').val(7).trigger('change'); //MMD
                tr.find('td:eq(15) select').val('77').trigger('change'); //TG
                tr.find('td:eq(16) select').val(7).trigger('change'); //Travel Record
                tr.find('td:eq(17) select').val(7).trigger('change'); //Occupation
                tr.find('td:eq(18) input').val('N/A'); //Remark
            }
        }
    });
    $('.actvhv').on('change', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var actvhv = this ;
        var tr = $(this).closest('tr');
        var age = tr.find('.agevhv').val();
        var rdt_value = tr.find('.rdtvhv').val();
        var positive_value = [1, 2, 3, 4];
        switch (this.value) {
            case '0':
                if (positive_value.indexOf(parseInt(rdt_value)) === 0 || positive_value.indexOf(parseInt(rdt_value)) === 2) {
                    bootbox.alert('Pf or Mix Infection လူနာတွင် ACT ဆေးပေးရမည်။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                }
                break;
            case '1':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if (parseInt(age) < 1) {
                    bootbox.alert("အသက်(၁)နှစ်မှ(၄)နှစ်တွင်သာ Coartem - 6 ပေးသည်။").on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                }
                break;
            case '2':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if (parseInt(age) < 5) {
                    bootbox.alert("အသက်(၅)နှစ်မှ(၉)နှစ်တွင်သာ Coartem - 12 ပေးသည်။။").on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                }
                break;
            case '3':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if (parseInt(age) < 10) {
                    bootbox.alert("အသက်(၁၀)နှစ်မှ(၁၄)နှစ်တွင်သာ Coartem - 18 ပေးသည်။").on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                }
                break;
            case '4':
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox.alert('ငှက်ဖျားပိုးမရှိပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if ((positive_value.indexOf(parseInt(rdt_value)) === 1)) {
                    bootbox.alert('Pv/Non Pf ပိုးတွင် Coartem မပေးပါ။').on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                } else if (parseInt(age) < 15) {
                    bootbox.alert("အသက်(၁၅)နှင့်အထက်တွင်သာ Coartem - 24 ပေးသည်။").on('hidden.bs.modal', function(){
                        $(actvhv).focus();
                    });
                }
                break;
        }
    });
    $('.cqvhv, .pqvhv').on('change', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var cqvhv = this ;
        var tr = $(this).closest('tr');
        var age = tr.find('.agevhv').val();
        var preg = tr.find('.pregvhv').val();
        var rdt_value = tr.find('.rdtvhv').val();
        var rcs_value = tr.find('.rcsvhv').val();
        if (this.className === 'cqvhv only-integer') {
            var cq = this.value;
            if (parseInt(cq) > 50) {
                if (parseInt(cq) != 77 && parseInt(cq) != 99) {
                    bootbox.alert('ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77)').on('hidden.bs.modal', function(){
                        $(cqvhv).focus();
                    });
                }else if((parseInt(cq) == 0 || parseInt(cq) == 77 || parseInt(cq) == 99)
                && (parseInt(rcs_value) == 2 || parseInt(rdt_value) == 2)) {
                    bootbox.alert('Pv ပိုးတွေ့လျှင် CQ ပေးရမည်။').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
            } else {
                if (parseInt(rcs_value) == 1 || parseInt(rdt_value) == 1) {
                    bootbox.alert('Pf ပိုးတွင် CQ မပေးပါ။').on('hidden.bs.modal', function(){
                        $(cqvhv).focus();
                    });
                }
            }
        }
        if (this.className === 'pqvhv only-integer') {
            var pq = this.value;
            if (parseInt(pq) > 50) {
                if (parseInt(pq) != 77 && parseInt(pq) != 99) {
                    bootbox.alert('ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77)').on('hidden.bs.modal', function(){
                        $(cqvhv).focus();
                    });
                }else if((positive_value.indexOf(parseInt(rcs_value)) != -1 || positive_value.indexOf(parseInt(rdt_value)) != -1)
                && (parseInt(pq) == 0 || parseInt(pq) == 77 || parseInt(pq) == 99)){
                    bootbox.alert('Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
            } else {
                if (parseInt(age) < 1 || parseInt(preg) == 1) {
                    bootbox.alert('အသက်(၁)နှစ်အောက်နှင့်ကိုယ်ဝန်ဆောင်များကို PQ မပေးပါ။ (N/A for 77)').on('hidden.bs.modal', function(){
                        $(cqvhv).focus();
                    });
                }
                if((positive_value.indexOf(parseInt(rcs_value)) != -1 || positive_value.indexOf(parseInt(rdt_value)) != -1)
                && (parseInt(pq) == 0)){
                    bootbox.alert('Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။').on('hidden.bs.modal', function(){
                        $(cqpq).focus();
                    });
                }
                
            }
        }
    });
}