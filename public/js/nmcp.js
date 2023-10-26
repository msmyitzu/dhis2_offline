// const { filter } = require("lodash");

var BACKEND_URL = window.location.origin + "/";
// let hfTypes = JSON.parse($('#hfTypes').val());

function isValidDate(d, m, y) {
    var thirtyDaysMonth = [4, 6, 9, 11];
    if (parseInt(d) && parseInt(m) && parseInt(y)) {
        if (parseInt(d) === 9 && parseInt(m) === 9 && parseInt(y) === 999) {
            return true;
        } else {
            if (
                parseInt(d) > 31 ||
                parseInt(m) > 12 ||
                parseInt(y) < 1900 ||
                parseInt(y) > 9999
            ) {
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

function load_lp_stateregion(target_sr_id, token, region_code) {
    if (target_sr_id != "0") {
        try {
            $("." + target_sr_id).html("<option>Loading...</option>");
            $("." + target_sr_id).prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_state_region/",
                data: "",
                success: function (data) {
                    $("." + target_sr_id).html("");
                    $("." + target_sr_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("." + target_sr_id).prop("disabled", false);

                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.sr_code +
                            "'>" +
                            val.sr_name +
                            " | " +
                            val.sr_name_mmr +
                            "</option>";
                        $("." + target_sr_id).append(opt);
                    });

                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else {
        $("." + target_sr_id).html("");
    }
}

//start for entry_2blade
function load_lp_stateregion_for_entry_2(target_sr_id, token, region_code) {
    if (target_sr_id != "0") {
        try {
            $("." + target_sr_id).html("<option>Loading...</option>");
            $("." + target_sr_id).prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_state_region_for_entry_2/",
                data: "",
                success: function (data) {
                    $("." + target_sr_id).html("");
                    $("." + target_sr_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("." + target_sr_id).prop("disabled", false);

                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.sr_code +
                            "'>" +
                            val.sr_name +
                            " | " +
                            val.sr_name_mmr +
                            "</option>";
                        $("." + target_sr_id).append(opt);
                    });

                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else {
        $("." + target_sr_id).html("");
    }
}
//end for entry_2blade

// function set_focus() {
//     var table = document.getElementById('data_entry_body');
//     var i = get_row();
//     table.rows[--i].cells[1].children[0].focus();
// }

function load_sr_lp_township(ts_id, sr_code, token, region_code) {
    if (sr_code != "0" && sr_code.length == 6) {
        try {
            $("." + ts_id).html("<option>Loading...</option>");
            $("." + ts_id).prop("disabled", true);
            //$("#select_tbl_hfm_de").html("<option>Loading...</option>");
            //$("#select_tbl_hfm_de").prop("disabled", true);
            //$("#select_hfm_de").html("<option>Loading...</option>");
            //$("#select_hfm_de").prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_township/" + sr_code,
                data: "",
                success: function (data) {
                    $("." + ts_id).html("");

                    $("." + ts_id).append(
                        "<option value='0' selected> All Township </option>"
                    );
                    $("." + ts_id).prop("disabled", false);
                    //$("#select_tbl_hfm_de").html("<option value='0'> ရွေးရန် </option>");
                    //$("#select_tbl_hfm_de").prop("disabled", false);
                    //$("#select_hfm_de").html("<option value='0'> ရွေးရန် </option>");
                    //$("#select_hfm_de").prop("disabled", false);

                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.ts_code +
                            "'>" +
                            val.ts_name +
                            "</option>";
                        $("." + ts_id).append(opt);
                    });

                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else if (sr_code.length > 6) {
        try {
            $("." + ts_id).html("<option>Loading...</option>");
            $("." + ts_id).prop("disabled", true);
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_township/" + sr_code,
                data: "",
                success: function (data) {
                    $("#" + ts_id).html("");
                    $("#" + ts_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("#" + ts_id).prop("disabled", false);
                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.ts_code +
                            "'>" +
                            val.ts_name +
                            "</option>";
                        $("#" + ts_id).append(opt);
                    });
                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else if (sr_code == "all") {
        try {
            $("." + ts_id).html("<option>Loading...</option>");
            $("." + ts_id).prop("disabled", true);
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_township/" + sr_code,
                data: "",
                success: function (data) {
                    $("#" + ts_id).html("");
                    $("#" + ts_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("#" + ts_id).prop("disabled", false);
                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.ts_code +
                            "'>" +
                            val.ts_name +
                            "</option>";
                        $("#" + ts_id).append(opt);
                    });
                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else if (sr_code == 1) {
        $("." + ts_id).html("");
        $("." + ts_id).append(
            "<option value='0' selected> မြို့နယ်အားလုံး </option>"
        );
    }
}

function load_lp_township(target_ts_id, sr_code, token, region_code) {
    if (sr_code != "0" && sr_code.length == 6) {
        try {
            $("." + target_ts_id).html("<option>Loading...</option>");
            $("." + target_ts_id).prop("disabled", true);
            //$("#select_tbl_hfm_de").html("<option>Loading...</option>");
            //$("#select_tbl_hfm_de").prop("disabled", true);
            //$("#select_hfm_de").html("<option>Loading...</option>");
            //$("#select_hfm_de").prop("disabled", true);

            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_township/" + sr_code,
                data: "",
                success: function (data) {
                    $("." + target_ts_id).html("");

                    $("." + target_ts_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("." + target_ts_id).prop("disabled", false);
                    //$("#select_tbl_hfm_de").html("<option value='0'> ရွေးရန် </option>");
                    //$("#select_tbl_hfm_de").prop("disabled", false);
                    //$("#select_hfm_de").html("<option value='0'> ရွေးရန် </option>");
                    //$("#select_hfm_de").prop("disabled", false);

                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.ts_code +
                            "'>" +
                            val.ts_name +
                            " | " +
                            val.ts_name_mmr +
                            "</option>";
                        $("." + target_ts_id).append(opt);
                    });

                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else if (sr_code.length > 6) {
        try {
            $("." + target_ts_id).html("<option>Loading...</option>");
            $("." + target_ts_id).prop("disabled", true);
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_township/" + sr_code,
                data: "",
                success: function (data) {
                    $("#" + target_ts_id).html("");
                    $("#" + target_ts_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("#" + target_ts_id).prop("disabled", false);
                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.ts_code +
                            "'>" +
                            val.ts_name +
                            " | " +
                            val.ts_name_mmr +
                            "</option>";
                        $("#" + target_ts_id).append(opt);
                    });
                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else if (sr_code == "all") {
        try {
            $("." + target_ts_id).html("<option>Loading...</option>");
            $("." + target_ts_id).prop("disabled", true);
            $.ajax({
                type: "GET",
                url: BACKEND_URL + "get_lp_township/" + sr_code,
                data: "",
                success: function (data) {
                    $("#" + target_ts_id).html("");
                    $("#" + target_ts_id).append(
                        "<option value='0'> ရွေးရန် </option>"
                    );
                    $("#" + target_ts_id).prop("disabled", false);
                    jQuery.each(data, function (i, val) {
                        var opt =
                            "<option value='" +
                            val.ts_code +
                            "'>" +
                            val.ts_name +
                            " | " +
                            val.ts_name_mmr +
                            "</option>";
                        $("#" + target_ts_id).append(opt);
                    });
                    if (region_code != "") {
                        $("#select_region_code")
                            .val(region_code)
                            .trigger("change");
                    }
                },
            });
        } catch (err) {
            bootbox.alert(err.message);
        }
    } else {
        $("." + target_ts_id).html("");
    }
}

function load_tbl_hfm(target_control_id, ts_code, token, form_type = null) {
    let form_cat = $("#select_lp_form_cat").val();
    // alert('this is formcat');

    let hf_types = [];

    if (form_cat == 2 || form_cat == 3) {
        hf_types = ["SC", "MH", "SU"];
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
            url: BACKEND_URL + "get_grab_hfconnect/" + ts_code,
            data: { hf_types: hf_types },
            success: function (data) {
                //console.log('mzh', data);
                $("#" + target_control_id).html("");

                $("#" + target_control_id).append(
                    "<option value='0'> ရွေးရန် </option>"
                );
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function (i, val) {
                    var opt =
                        "<option value='" +
                        val.HF_Code +
                        "'>" +
                        val.hf_name +
                        " | " +
                        val.hf_name_mm +
                        "</option>";
                    $("#" + target_control_id).append(opt);
                });
            },
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function load_tbl_township_hfm(target_control_id, ts_code, token) {
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
            url: BACKEND_URL + "get_grab_hfconnect_township/" + ts_code,
            data: "",
            success: function (data) {
                //     var rhc_data =[];
                //   for (let i = 0; i < data.length; i++) {
                //        if (data[i].HF_Code.includes("RH")) {
                //          rhc_data.push(data[i]);

                //           }

                //   }

                $("#" + target_control_id).html("");

                $("#" + target_control_id).append(
                    "<option value='reportby_rhc'> ရွေးရန် </option>"
                );
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function (i, val) {
                    var opt =
                        "<option value='" +
                        val.HF_Code +
                        "'>" +
                        val.hf_name +
                        " | " +
                        val.hf_name_mm +
                        "</option>";
                    $("#" + target_control_id).append(opt);
                });
            },
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function load_hfm(target_control_id, hf_code, token) {
    // let form_cat = $('#select_lp_form_cat').val();

    // let hf_types = [];

    // if (form_cat == 2 || form_cat == 3) {
    //     hf_types = ['VH'];
    // }

    try {
        var form_code = "";

        if ($("#select_lp_form_cat").val() == "0") {
            bootbox.alert("<p>• ပုံစံအမျိုးအစားရွေးပါ</p>");
            return false;
        } else if ($("#select_tbl_hfm_de").val() == "0") {
            bootbox.alert(
                "<p>• ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ ရွေးပါ</p>"
            );
            return false;
            //load_hfm
        }

        $("#" + target_control_id).html("<option>Loading...</option>");
        $("#" + target_control_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + "get_grab_hfm/" + hf_code,
            data: "", //{ hf_types: hf_types }

            success: function (data) {
                console.log(hf_code);
                console.log("hhh", data);
                $("#" + target_control_id).html("");

                $("#" + target_control_id).append(
                    "<option value='0'> ရွေးရန် </option>"
                );
                $("#" + target_control_id).prop("disabled", false);

                jQuery.each(data, function (i, val) {
                    var opt =
                        "<option value='" +
                        val.sc_code +
                        "'>" +
                        val.sc_name +
                        " | " +
                        val.sc_name_mm +
                        "</option>";
                    $("#" + target_control_id).append(opt);
                });
            },
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

// start for icmvVillage input
function load_icmv_village(service_provider) {
    //  alert('this is icmvbillage',form_code);
    var selectFormCode = document.getElementById("select_lp_form_cat");
    if (selectFormCode.value === "1") {
        document.getElementById("icmvSelect").style.display = "none";
    } else {
        document.getElementById("icmvSelect").style.display = "block";
    }
}

// end for icmvVillage input

// start for activites input

function showConditionalSelect() {
    //  alert('this is yes');
    var conditionalSelect = document.getElementById("chooseOption");
    if (conditionalSelect.value === "yes") {
        document.getElementById("conditionalSelect").style.display = "block";
    } else {
        document.getElementById("conditionalSelect").style.display = "none";
    }

    //document.getElementById("conditionalSelect").style.display = "block";
}

//function hideConditionalSelect() {
//document.getElementById("conditionalSelect").style.display = "none";
//}
document.getElementById("chooseOption").value = "selected";
//end for activites input

// function load_hfm_sc(target_control_id, hf_code, token) {
//     try {
//         var form_code = "";

//         if ($("#select_lp_form_cat").val() == "0") {
//             bootbox.alert("<p>• ပုံစံအမျိုးအစားရွေးပါ</p>");
//             return false;
//         } else if ($("#select_tbl_hfm_de").val() == "0") {
//             bootbox.alert("<p>• ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ ရွေးပါ</p>");
//             return false;
//         }

//         $("#" + target_control_id).html("<option>Loading...</option>");
//         $("#" + target_control_id).prop("disabled", true);

//         $.ajax({
//             type: "GET",
//             url: BACKEND_URL + 'get_grab_hfm/' + hf_code,
//             data: "",
//             success: function(data) {
//                 console.log('kaylet', data);
//                 var sc_data = [];
//                 for (let i = 0; i < data.length; i++) {
//                     if (data[i].sc_code.includes("SC")) {
//                         sc_data.push(data[i]);

//                     }

//                 }

//                 //    console.log('only_sc::::',sc_data);

//                 $("#" + target_control_id).html("");

//                 $("#" + target_control_id).append("<option value='0'> ရွေးရန် </option>");
//                 $("#" + target_control_id).prop("disabled", false);

//                 jQuery.each(sc_data, function(i, val) {
//                     var opt = "<option value='" + val.sc_code + "'>" + val.sc_name + " | " + val.sc_name_mm + "</option>";
//                     $("#" + target_control_id).append(opt);
//                 });
//             }
//         });
//     } catch (err) {
//         bootbox.alert(err.message);
//     }
// }

function load_lp_district(target_district_id, sr_id, token) {
    try {
        $("#" + target_district_id).html("<option>Loading...</option>");
        $("#" + target_district_id).prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + "get_lp_district/" + sr_id,
            data: "",
            success: function (data) {
                $("#" + target_district_id).html("");
                $("#" + target_district_id).append(
                    "<option value='0'> ရွေးရန် </option>"
                );
                $("#" + target_district_id).prop("disabled", false);

                jQuery.each(data, function (i, val) {
                    var opt =
                        "<option value='" +
                        val.d_code +
                        "'>" +
                        val.d_name +
                        " | " +
                        val.d_name_mmr +
                        "</option>";
                    $("#" + target_district_id).append(opt);
                });
            },
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function load_lp_hftype(token) {
    try {
        $("#select_lp_hftype").html("<option value='0'>Loading...</option>");
        $("#select_lp_hftype").prop("disabled", true);

        $.ajax({
            type: "GET",
            url: BACKEND_URL + "get_lp_hftype",
            data: "",
            success: function (data) {
                $("#select_lp_hftype").html("");

                $("#select_lp_hftype").append(
                    "<option value='0'> ရွေးရန် </option>"
                );
                $("#select_lp_hftype").prop("disabled", false);

                jQuery.each(data, function (i, val) {
                    var opt =
                        "<option value='" +
                        val.hftypeid +
                        "'>" +
                        val.hftypeeng +
                        "</option>";
                    $("#select_lp_hftype").append(opt);
                });
            },
        });
    } catch (error) {
        bootbox.alert(error.message);
    }
}

function change_rhcsc_label(select_id) {
    alert("this is onchange;");
    if (
        select_id == "5" ||
        select_id == "1" ||
        select_id == "6" ||
        select_id == "4" ||
        select_id == "7"
    ) {
        $("#rhc_label").html("မြို့နယ်/တိုက်နယ်ဆေးရုံ/ကျန်းမာရေးဌာန");
        $("#sc_label").html("ကျန်းမာရေးဌာနခွဲ");
    } else if (select_id == "0") {
        bootbox.alert("<p>• ပုံစံအမျိုးအစားမှန်အောင်ရွေးပါ</p>");
        return false;
    } else {
        $("#rhc_label").html("ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲ");
        $("#sc_label").html("စေတနာဝန်ထမ်းကျေးရွာ");
    }
    if ($("#select_lp_township_de").val() !== null) {
        if ($("#select_lp_township_de").val() != "0") {
            $("#select_lp_township_de").trigger("change");
        }
    }
}

// function load_lp_form_cat(target_control_id, token) {
//     try {
//         $("#" + target_control_id).html("<option>Loading...</option>");
//         $("#" + target_control_id).prop("disabled", true);

//         $.ajax({
//             type: "GET",
//             url: BACKEND_URL + "get_lp_form_cat",
//             data: "",
//             success: function (data) {
//                 $("#" + target_control_id).html("");

//                 $("#" + target_control_id).append(
//                     "<option value='0' selected disabled> ရွေးရန် </option>"
//                 );
//                 $("#" + target_control_id).prop("disabled", false);

//                 jQuery.each(data, function (i, val) {
//                     var opt =
//                         "<option value='" +
//                         val.form_code +
//                         "'>" +
//                         val.form_name +
//                         "</option>";
//                     $("#" + target_control_id).append(opt);
//                 });
//             },
//         });
//     } catch (err) {
//         bootbox.alert(err.message);
//     }
// }

function load_reportpage(select_reportpage, token) {
    try {
        if (select_reportpage == "reportby_sc") {
            $("#rpt_lp_township").prop("disabled", false);
            $("#report_sc_page").show();
            $("#report_rhc_page").hide();
            $("#report_by_township").hide();
            $("#report_by_stateregion").hide();
            $("#report_title_id").html("ကျန်းမာရေးဌာနခွဲအလိုက် အစီရင်ခံစာ");
        } else if (select_reportpage == "reportby_rhc") {
            $("#rpt_lp_township").prop("disabled", false);
            $("#report_rhc_page").show();
            $("#report_sc_page").hide();
            $("#report_by_township").hide();
            $("#report_by_stateregion").hide();
            $("#report_title_id").html("ကျန်းမာရေးဌာနအလိုက် အစီရင်ခံစာ");
        }
        // else if (select_reportpage == "reportby_township") {
        //     $("#rpt_lp_township").prop("disabled", false);
        //     $('#report_by_stateregion').show();
        //     $('#report_rhc_page').hide();
        //     $('#report_sc_page').hide();
        //     $('#report_by_township').hide();
        //     $('#report_title_id').html("ကျန်းမာရေးဌာနအလိုက် အစီရင်ခံစာ");
        // }
        else if (select_reportpage == "reportby_township") {
            // if ($("#rpt_lp_township").val() == null || $("#rpt_lp_township").val() == "0") {
            //     //bootbox.alert("<p>• မြို့နယ်ရွှေးချယ်ပါ</p>");
            //     $("#rpt_type").val("default").trigger('change');
            // }
            // else {
            //$("#rpt_lp_township").prop("disabled", true).select2();
            //$('#rpt_lp_township').prop('disabled', true).val('0').trigger('change')
            $("#report_rhc_page").hide();
            $("#report_sc_page").hide();
            $("#report_by_stateregion").hide();
            $("#report_by_township").show();
            // }
        } else if (select_reportpage == "default") {
            //$("#rpt_lp_township").prop("disabled", false);
            $("#report_rhc_page").hide();
            $("#report_sc_page").hide();
            $("#report_by_stateregion").hide();
            $("#report_by_township").hide();
        } else {
            //$("#rpt_lp_township").prop("disabled", false);
            bootbox.alert("<p>• စာရင်းချုပ်အမျိုးအစားရွှေးချယ်ပါ</p>");
        }
    } catch (error) {
        bootbox.alert(error.message);
    }
}

function load_lp_tbl_hfm() {
    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + "get_tbl_hfm",
            data: "",
            success: function (data) {
                $("#lp_tbl_hfm_container").html("");

                jQuery.each(data, function (i, val) {
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

                $("#table_tbl_hfm").DataTable({
                    paging: true,
                    lengthChange: false,
                    pageLength: 5,
                    searching: false,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    select: false,
                    scrollX: true,
                    order: [[4, "desc"]],
                });
            },
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
            url:
                BACKEND_URL +
                "get_grab_healthfacilitypage/" +
                ts_code +
                "/" +
                hftypeid,
            data: "",
            success: function (data) {
                $("#" + containerid).html("");

                if (data.length > 0) {
                    jQuery.each(data, function (i, val) {
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
                    var tr =
                        '<tr><td colspan="5">No data available in table.</td></tr>';
                    $("#" + containerid).append(tr);
                }

                $("#select_lp_hftype").prop("disabled", false);
            },
        });
    } catch (error) {
        bootbox.alert(error.message);
    }
}

// function highlight_row(item) {
//     reset_row_border("register-table");
//     var row = $(item).closest("tr");
//     $(row).children().css("border-top", "2px solid #FF6B50");
//     $(row).children().css("border-bottom", "2px solid #FF6B50");
//     $(row).children().first().css("border-left", "2px solid #FF6B50");
//     $(row).children().last().css("border-right", "2px solid #FF6B50");
// }

// function reset_row_border(register-table) {
//     var table = document.getElementById(register-table);
//     for (var i = 0, row; row = table.rows[i]; i++) {
//         $(row).children().css("border", "1px solid grey");
//     }
// }

function clear_data_entry() {
    /*$("#select_hfm_de").select2("val", "");
    $("#select_tbl_hfm_de").select2("val", "");
    $("#select_lp_township_de").select2("val", "");*/

    $("#select_lp_form_cat").val("0").trigger("change");
    $("#form_number").val("");
    $("#select_lp_state_region").val("0").trigger("change");
    $("#form-date").val("");
    $("#select_tbl_hfm_de").html("");
    $("#select_hfm_de").html("");
    $("#select_lp_form_cat").val("0").trigger("change");
}

function submit_data_entry_form() {
    var btn_text = show_button_loading("btn_submit_data_entry_form");
    //$("#btn_submit_data_entry_form").html('<img src="img/default-loading.gif" style="width:20px;"/>'+btn_text);

    var form_code = $("#select_lp_form_cat").val();
    var form_no = $("#form_number").val();
    var sc_code = $("#select_hfm_de").val();
    var form_date = $("#form-date").val().split("/");
    var pmonth = form_date[0];
    var pyear = form_date[1];
    var errMsg = "";

    if (form_code == null) {
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
    if ($("#select_tbl_hfm_de").val() == "0") {
        errMsg += "<p>• ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲရွေးပါ</p>";
    }
    if ($("#select_hfm_de").val() == "0") {
        errMsg += "<p>• စေတနာဝန်ထမ်းကျေးရွာရွေးပါ</p>";
    }
    if (form_date == "") {
        errMsg += "<p>• ခုနစ်/လဖြည့်ပါ</p>";
    }
    if (errMsg != "") {
        bootbox.alert(errMsg);
        reset_button_loading("btn_submit_data_entry_form", btn_text);
        return false;
    }

    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + "get_tbl_core_facility_by_code",
            data: {
                form_code: form_code,
                form_no: form_no,
                sc_code: sc_code,
                pmonth: pmonth,
                pyear: pyear,
            },
            success: function (data) {
                if (data == "") {
                    bootbox.confirm(
                        "<p>• ဖောင်အသစ်တစ်ခုပြုလုပ်မည်။ သေချာပါက OK နှိပ်ပါ</p>",
                        function (result) {
                            if (result == false) {
                                reset_button_loading(
                                    "btn_submit_data_entry_form",
                                    btn_text
                                );
                            } else {
                                $("#frm-patient-register-form").submit();
                            }
                        }
                    );
                } else {
                    $("#cf_link_code").val(data);
                    $("#frm-patient-register-form").submit();
                }
            },
        });
    } catch (err) {
        bootbox.alert(err.message);
    }
}

function delete_data_entry_form() {
    var btn_text = show_button_loading("btn_delete_data_entry_form");
    //$("#btn_submit_data_entry_form").html('<img src="img/default-loading.gif" style="width:20px;"/>'+btn_text);

    var form_code = $("#select_lp_form_cat").val();
    var form_no = $("#form_number").val();
    var sc_code = $("#select_hfm_de").val();
    var form_date = $("#form-date").val().split("/");
    var pmonth = form_date[0];
    var pyear = form_date[1];
    var errMsg = "";

    if (form_code == "") {
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
    if ($("#select_tbl_hfm_de").val() == "0") {
        errMsg += "<p>• ကျေးလက်ကျန်းမာရေးဌာန/ကျန်းမာရေးဌာနခွဲရွေးပါ</p>";
    }
    if ($("#select_hfm_de").val() == "0") {
        errMsg += "<p>• စေတနာဝန်ထမ်းကျေးရွာရွေးပါ</p>";
    }
    if (form_date == "") {
        errMsg += "<p>• လ/ခုနစ်ဖြည့်ပါ</p>";
    }
    if (errMsg != "") {
        bootbox.alert(errMsg);
        reset_button_loading("btn_submit_data_entry_form", btn_text);
        return false;
    }
    bootbox.confirm(
        "ဖောင်နှင့်သက်ဆိုင်သောဒေတာများအားအပြီးဖျက်မည်။ သေချာပါက OK နှိပ်ပါ။",
        function (result) {
            if (result == false) {
                reset_button_loading("btn_delete_data_entry_form", btn_text);
            } else {
                try {
                    $.ajax({
                        type: "GET",
                        url: BACKEND_URL + "delete_tbl_core_facility_by_code",
                        data: {
                            form_code: form_code,
                            form_no: form_no,
                            sc_code: sc_code,
                            pmonth: pmonth,
                            pyear: pyear,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == "1") {
                                bootbox.alert("ဖျက်ပြီးပါပြီ");
                                reset_button_loading(
                                    "btn_delete_data_entry_form",
                                    btn_text
                                );
                                window.location.reload();
                            } else if (data == "0") {
                                bootbox.alert(
                                    "အောက်ပါအချက်အလက်များနှင့်ကိုက်ညီသော ဖောင်မရှိပါ"
                                );
                                reset_button_loading(
                                    "btn_delete_data_entry_form",
                                    btn_text
                                );
                            } else {
                                bootbox.alert(data);
                            }
                        },
                    });
                } catch (err) {
                    bootbox.alert(err.message);
                }
            }
        }
    );
}

function show_button_loading(buttonid) {
    var button_text = $("#" + buttonid).html();
    $("#" + buttonid).html(
        '<img src="img/default-loading.gif" style="width:20px;"/>' + button_text
    );
    return button_text;
}

function reset_button_loading(buttonid, button_text) {
    $("#" + buttonid).html(button_text);
}

function load_last_corefacility() {
    //$("#last_corefacility_container").html('<img src="img/default-loading.gif" style="width:30px;"/>');

    try {
        $.ajax({
            type: "GET",
            url: BACKEND_URL + "get_grab_last_corefacility",
            success: function (data) {
                //console.log('mzh', data);
                $("#last_corefacility_container").html("");

                jQuery.each(data, function (i, val) {
                    // console.dir(val["DE_DateTime "]);
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' + val.Form_Name + "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' + val.Form_No + "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' + val.HFName + "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' + val.HFReporting + "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' + val.sr_name_mmr + "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' + val.ts_name_mmr + "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group">' +
                            val.Month_Name +
                            "  " +
                            val.PYear +
                            "</div>"
                    );
                    $("#last_corefacility_container").append(
                        '<div class="form-group" id="de-date">' +
                            val.DE_DateTime +
                            "</div>"
                    );
                    //console.log('mzz', val);
                    $("#last_corefacility_container").append(
                        '<div class="form-group" style="text-align:center;"><a href="forms">အချက်အလက်အားလုံးကြည့်ရန်</a></div>'
                    );
                });
            },
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

function ynTxt2Code(ynTxt) {
    switch (ynTxt) {
        case "No":
            return 0;
            break;
        case "Yes":
            return 1;
            break;
        case "N/A":
            return 7;
            break;
        case "Missing":
            return 9;
            break;
    }
}

function sex_name(sexcode) {
    switch (sexcode) {
        case 0:
            return "Male";
            break;
        case 1:
            return "Female";
            break;
        case 9:
            return "Missing";
            break;
    }
}

//// Check Table Vilidation //// /^(\d{1,2})\-(\d{1,2})\-(\d{4})$/;

function dateCheck(day) {
    //var date_regx = /^(\d{1,2})\-(\d{1,2})\-(\d{1,4})$/;
    var date_regx =
        /^([1-9]|0[1-9]|[12][0-9]|3[01])\-(0[1-9]|1[012])\-([0-9]{4}|[0-9]{3})$/;
    console.log(date_regx.test(day));
    if (date_regx.test(day) == false) {
        bootbox.alert(
            "<p>• ရက်စွဲမှားယွင်းနေသည်။</p>\n<p>• (dd - mm - yyyy) ပုံစံထည့်သွင်းပါ။</p>\n<p>• ရက်စွဲမပါရှိပါက (9-9-999) ပုံစံထည့်သွင်းပါ။</p>"
        );
    }

    /////////////////////////// 29 Edit ///////////////////////
    /*
    var input_date = $(day).val();
    var tr = $(day).closest('tr');
    var input_date_splitted = input_date.split('-');
    var year = parseInt(input_date_splitted[2]);
    var month = parseInt(input_date_splitted[1]);
    var d = parseInt(input_date_splitted[0]);
    var form_month = document.getElementById('frm_month').value;
    var form_year = document.getElementById('frm_year').value;
    if(input_date != "" && !date_regx.test(input_date)){
        bootbox.alert('<p>• ရက်စွဲပုံစံမှားနေသည်။ "ရက်-လ-ခုနှစ်" ပုံစံရေးပါ။<strong>Eg => ("01-12-1999")</strong></p>',function(){
            return tr.find('td:eq(1) input').select();
        });
    }else{
        if(new Date(year, (month - 1), d).getTime() != new Date('9-9-999').getTime()){
            if(new Date(year, (month - 1), d).getTime() > Date.now()){
                bootbox.alert('ထည့်သွင်းသောရက်စွဲမှားနေသည်။\nမသေချာလျှင်\(9-9-999\)ဟုထည့်သွင်းပါ', function(){
                    return tr.find('td:eq(1) input').select();
                });
            }
        }
        // else if(new Date(input_date).getTime != new Date('9-9-999').getTime()){
        //     bootbox.alert('ထည့်သွင်းသောရက်စွဲမှားနေသည်။\nမသေချာလျှင်\(9-9-999\)ဟုထည့်သွင်းပါ', function(){
        //         return;
        //     });
        // }
    }
    // var date_regx = /^(\d{1,2})\-(\d{1,2})\-(\d{4})$/;

    */
    /////////////////////////// 29 Edit ///////////////////////

    // var input_date = $(day).val();
    // if(!(date_regx.test(input_date))){
    //     bootbox.alert('<p>• ရက်စွဲပုံစံမှားနေသည်။ "ရက်-လ-ခုနှစ်" ပုံစံရေးပါ။<br><strong>("01-12-1999")</strong></p>', function(){
    //         $(day).focus();
    //     });
    // }else{

    // }

    // var month = parseInt(input_date[1], 10);
    // var year = parseInt(input_date[2], 10);
    // if (year <= parseInt(form_year,10)) {
    //     tr.find('td:eq(2) input').focus();
    // } else if (input_date[0] == '9' && input_date[1] === '9' && input_date[2] === '999') {
    //     tr.find('td:eq(2) input').focus('');
    // } else {

    //     $(day).focus();
    //     return false;
    // }
}

// Function to check the age group

//    function checkAge(input_age) {
//  // const input_age = parseInt(age.value);
//     // console.log("input_age", input_age.value);

//     if (isNaN(input_age)) {
//         alert("Please enter a valid age.");
//         return;
//     }else if(input_age >= 110){
//         alert("အသက် ၁၁၀ အောက်ဖြစ်ရမည်။ (သို့) ၉၉၉ ဟုရိုက်ပါ။");
//         return;
//     }
// }



// function filterPQ(pq) {
//     console.log("this is pq :>> ", pq.value);
//     if (pq.value == 1) {
//         return "PQ_1";
//     } else if (pq.value == 2) {
//         return "PQ_2";
//     } else if (pq.value == 4) {
//         return "PQ_4";
//     } else if (pq.value == 6) {
//         return "PQ_6";
//     } else if (pq.value == 7) {
//         return "PQ_7";
//     } else if (pq.value == 14) {
//         return "PQ_14";
//     } else if (pq.value == 21) {
//         return "PQ_21";
//     } else if (pq.value == 28) {
//         return "PQ_28";
//     } else if (pq.value == "Out") {
//         return "Out of stock";
//     } else {
//         return "N/A";
//     }
// }

// function checkCQ(cq) {
//     console.log("this is cq :>> ", cq.value);
//     if (cq.value == 1) {
//         return "CQ_1";
//     } else if (cq.value == 4) {
//         return "CQ_4";
//     } else if (cq.value == 5) {
//         return "CQ_5";
//     } else if (cq.value == 7.5) {
//         return "PQ_7.5";
//     } else if (cq.value == 10) {
//         return "CQ_10";
//     } else if (pq.value == "Out") {
//         return "Out of stock";
//     } else {
//         return "N/A";
//     }
// }

// function checkACT(act) {
//     // console.log('this is act:>> ',act.value);
//     if (act.value == 3) {
//         return "ACT_1";
//     } else if (act.value == 6) {
//         return "ACT_4";
//     } else if (act.value == 12) {
//         return "ACT_12";
//     } else if (act.value == 18) {
//         return "ACT_18";
//     } else if (act.value == 24) {
//         return "ACT_24";
//     } else if (act.value == "Other_ACT") {
//         return "Other_ACT";
//     } else if (act.value == "Out"){
//         return "Out of stock";
//     } else {
//         return "N/A";
//     }
//     return act.value;
// }


let input_age = '';
function checkAge(age) {
    var tr = $(age).closest('tr');
    var char = parseInt($(age).val());
    // var char = tr.find('.age'.val());
    // alert(char);
    var sex = tr.find('td:eq(12) select').val();
    var preg = tr.find('td:eq(13) select').val();

    if ((char >= 0) && (char <= 110)) {

        if (char <= 10 || char >= 60) {
            //checkPreg(preg);
            //let selectPreg = tr.find('td:eq(13) select').val();
            if (sex == "female" && preg == "Yes") {
                alert("အသက် ၁၀ နှစ်နှင့် ၆၀ အတွင်းသာ \"ကိုယ်ဝန်ဆောင်\" ရွေးခွင့်ရှိသည်။", function(e) {}).on('hidden.bs.modal', function() {
                    $(age).focus();
                 });
                //alert('age is more than 60');
                //alert(sextype);
                tr.find('td:eq(13) select').prop('disabled', true);
                tr.find('td:eq(13) select').css('cursor', 'not-allowed');
            } else {
                tr.find('td:eq(13) select').prop('disabled', true);
                tr.find('td:eq(13) select').css('cursor', 'not-allowed');
           }
        }
        if(char <= 1){
            input_age = 'AGE_GROUP_1';
            tr.find('td:eq(19) select,td:eq(13) select').prop('disabled', true);
            tr.find('td:eq(19) select,td:eq(13) select').css('cursor', 'not-allowed');
        }else if(char >= 1 && char <= 4) {
            tr.find('td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(19) select').css('cursor', 'default');
            input_age = 'AGE_GROUP_1_TO_4';
        } else if (char >= 5 && char <= 9) {
            tr.find('td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(19) select').css('cursor', 'default');
            input_age = 'AGE_GROUP_5_TO_9';
        } else if (char >= 10 && char <= 14) {
            tr.find('td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(19) select').css('cursor', 'default');
            input_age = 'AGE_GROUP_10_TO_14';
        } else{
            tr.find('td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(19) select').css('cursor', 'default');
            input_age = 'AGE_GROUP_15_AND_ABOVE';
        }

    }else {
        if (char == 999) {
            tr.find('td:eq(13) select').focus();
            tr.find('td:eq(13) select').prop('selectedIndex', 0);
        } else {
            alert("အသက် ၁၁၀ အောက်ဖြစ်ရမည်။ (သိ့့) ၉၉၉ ဟုရိုက်ပါ။").on('hidden.bs.modal', function() {
                $(age).focus();
                $(age).val('');
            });
        }
    }
    //  alert(input_age);

}


// function location_changed(location) {
//     var currentTR = $(location).closest('tr');
//     var local_value = (location.value);
//     console.log('mzh', local_value);
//     if (local_value === '10' || local_value == '20' || local_value == '30') {
//         currentTR.find('.other-address').prop('disabled', false);
//         currentTR.find('.other-address').val('');
//     } else {
//         currentTR.find('.other-address').val('N/A');
//         currentTR.find('.other-address').prop('disabled', true);
//     }
// }

// 13/9/23

function location_changed(location) {
    var currentTR = $(location).closest("tr");
    if (
        location.value == "10" ||
        location.value == "20" ||
        location.value == "30"
    ) {
        currentTR.find("td:eq(5) input").prop("disabled", false);
        currentTR.find("td:eq(5) input").select();
        currentTR.find("td:eq(5) input").focus();
    } else {
        currentTR.find("td:eq(5) input").prop("disabled", true);
        currentTR.find("td:eq(5) input").val("N/A");
    }
}
//13/9/23

function select_village() {
    var currentTR = $("#data_entry_body").children().closest("tr");
    var villageName = $("#select_village_list").find(":selected").text();
    //console.log('mzh', villageName);
    currentTR.find("td:eq(5) input").val(villageName);
    $("#tr-holder").val(villageName);
    $("#modal-village").modal("hide");
}

function checkSex(sextype) {
    var tr = $(sextype).closest('tr');
    var sex = tr.find('td:eq(12) select').val();
    //alert('this is sextype....',sex);

   if (sex == "male") {
    tr.find('td:eq(13) select').prop('disabled', true);
    tr.find('td:eq(13) select').css('cursor', 'not-allowed');
   } else {
    if (input_age == "AGE_GROUP_1" || input_age == "AGE_GROUP_1_TO_4" || input_age == "AGE_GROUP_5_TO_9") {
        tr.find('td:eq(13) select').prop('disabled', true);
        tr.find('td:eq(13) select').css('cursor', 'not-allowed');
    }else {
        tr.find('td:eq(13) select').prop('disabled',false);
        tr.find('td:eq(13) select').css('cursor', 'default');
    }

   }

};


function checkPreg(preg) {
    var tr = $(preg).closest('tr');
    var  select_preg = tr.find('td:eq(13) select').val();
    // console.log('hello preg is choosen :',select_preg);
    if (select_preg == "Yes") {
        tr.find('td:eq(19) select').prop('disabled', true);
        tr.find('td:eq(19) select').css('cursor', 'not-allowed');
    } else {
        tr.find('td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(19) select').css('cursor', 'default');
    }

}

function checkTestResult(rdt) {

    var tr = $(rdt).closest('tr');
    let select_check_lens = tr.find('td:eq(14) select').val();
    let select_check_rdt = tr.find('td:eq(15) select').val();
    let assum_result ='';
        if (select_check_lens == "Negative" && select_check_rdt == "Negative") {
            assum_result ='Negative';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', true);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'not-allowed');
        } else if (select_check_lens == "Negative" && select_check_rdt == "Pf") {
            assum_result='Pf';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');


        } else if (select_check_lens == "Negative" && select_check_rdt == "Pv") {
            assum_result='Pv';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');


        } else if (select_check_lens == "Negative" && select_check_rdt == "Mixed") {
            assum_result='Mixed';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');


        }else if(select_check_lens == "Negative" && select_check_rdt === "Not Exam"){
            assum_result='Negative';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', true);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'not-allowed');

        }else if(select_check_lens == "Pf" && select_check_rdt == "Negative"){
            assum_result='Pf';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');

        }else if(select_check_lens == "Pf" && select_check_rdt == "Pf"){
            assum_result='Pf';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');

        }else if(select_check_lens == "Pf" && select_check_rdt == "Pv"){
            assum_result='Mixed';
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');

    }else if(select_check_lens == "Pf" && select_check_rdt == "Mixed"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');

    }else if(select_check_lens == "Pf" && select_check_rdt == "Not Exam"){
        assum_result='Pf';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');

    }else if(select_check_lens == "Pv" && select_check_rdt == "Negative"){
        assum_result='Pv';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');

    }else if(select_check_lens == "Pv" && select_check_rdt == "Pf"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pv" && select_check_rdt == "Pv"){
        assum_result='Pv';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pv" && select_check_rdt == "Mixed"){
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
        assum_result='Mixed';
    }else if(select_check_lens == "Pv" && select_check_rdt == "Not Exam"){
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
        assum_result='Pv';
    }else if(select_check_lens == "Mixed" && select_check_rdt == "Negative"){
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
            tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
        assum_result='Mixed';
    }else if(select_check_lens == "Mixed" && select_check_rdt == "Pf"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Mixed" && select_check_rdt == "Pv"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Mixed" && select_check_rdt == "Mixed"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Mixed" && select_check_rdt == "Not Exam"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pm" && select_check_rdt == "Negative"){
        assum_result='Pm';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pm" && select_check_rdt == "Pf"){
        assum_result='Pm';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pm" && select_check_rdt == "Pv"){
        assum_result='Pv';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pm" && select_check_rdt == "Mixed"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Pm" && select_check_rdt == "Not Exam"){
        assum_result='Pm';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Po" && select_check_rdt == "Negative"){
        assum_result='Po';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Po" && select_check_rdt == "Pf"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Po" && select_check_rdt == "Pv"){
        assum_result='Pv';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Po" && select_check_rdt == "Mixed"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Po" && select_check_rdt == "Not Exam"){
        assum_result='Po';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Not Exam" && select_check_rdt == "Negative"){
        assum_result='Negtive';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', true);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'not-allowed');
    }else if(select_check_lens == "Not Exam" && select_check_rdt == "Pf"){
        assum_result='Pf';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Not Exam" && select_check_rdt == "Pv"){
        assum_result='Pv';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Not Exam" && select_check_rdt == "Mixed"){
        assum_result='Mixed';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', false);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'default');
    }else if(select_check_lens == "Not Exam" && select_check_rdt == "Not Exam"){
        assum_result='NotExam';
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').prop('disabled', true);
        tr.find('td:eq(17) select,td:eq(18) select,td:eq(19) select').css('cursor', 'not-allowed');
    }
     else {
        assum_result='Does not exist';
    }

    //alert(assum_result);
   checkAge(age);

   //alert(input_age);

    if(assum_result == 'Pf'){
        if(input_age == "AGE_GROUP_1"){
            tr.find('td:eq(18) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(18) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("3");
            $select.find("option[value='6'], option[value='12'], option[value='18'], option[value='24']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_1_TO_4"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("6");
            $select.find("option[value='3'], option[value='12'], option[value='18'], option[value='24']").prop("disabled", true);
            var $select = tr.find("td:eq(19) select");
            $select.val("1");
            $select.find("option[value='2'], option[value='4'], option[value='6'], option[value='7'], option[value='14'], option[value='21'], option[value='28']").prop("disabled", true);

        }else if(input_age == "AGE_GROUP_5_TO_9"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("12");
            $select.find("option[value='3'], option[value='6'], option[value='18'], option[value='24']").prop("disabled", true);
            var $select = tr.find("td:eq(19) select");
            $select.val("2");
            $select.find("option[value='1'], option[value='4'], option[value='6'], option[value='7'], option[value='14'], option[value='21'], option[value='28']").prop("disabled", true);

        }else if(input_age == "AGE_GROUP_10_TO_14"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("18");
            $select.find("option[value='3'], option[value='12'], option[value='6'], option[value='24']").prop("disabled", true);
            checkPreg(preg);
            // if (select_preg == "Yes") {
            //     tr.find('td:eq(19) select').prop('disabled',true);
            //     tr.find('td:eq(19) select').css('cursor', 'not-allowed');
            // } else {
                var $select = tr.find("td:eq(19) select");
                $select.val("4");
                $select.find("option[value='2'], option[value='1'], option[value='6'], option[value='7'], option[value='14'], option[value='21'], option[value='28']").prop("disabled", true);
            // }
        }else if(input_age == "AGE_GROUP_15_AND_ABOVE"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("24");
            $select.find("option[value='3'], option[value='12'], option[value='18'], option[value='6']").prop("disabled", true);
            checkPreg(preg);
            // // if (select_preg == "Yes") {
            //     tr.find('td:eq(19) select').prop('disabled',true);
            //     tr.find('td:eq(19) select').css('cursor', 'not-allowed');
            // } else {
                var $select = tr.find("td:eq(19) select");
                $select.val("6");
                $select.find("option[value='2'], option[value='4'], option[value='1'], option[value='7'], option[value='14'], option[value='21'], option[value='28']").prop("disabled", true);
            // }

        }else{
            alert(undefined);

        }

    }else if(assum_result == "Pv" || assum_result == "Po"){
        if(input_age == "AGE_GROUP_1"){
            tr.find('td:eq(17) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(17) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(18) select");
            $select.val("1");
            $select.find("option[value='4'], option[value='5'], option[value='7.5'], option[value='10']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_1_TO_4"){
            tr.find('td:eq(17) select').prop('disabled',true);
            tr.find('td:eq(17) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(19) select");
            $select.val("7");
            $select.find("option[value='2'], option[value='4'], option[value='1'], option[value='6'], option[value='14'], option[value='21'], option[value='28']").prop("disabled", true);
            var $select = tr.find("td:eq(18) select");
            $select.val("4");
            $select.find("option[value='1'], option[value='5'], option[value='7.5'], option[value='10']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_5_TO_9"){
            tr.find('td:eq(17) select').prop('disabled',true);
            tr.find('td:eq(17) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(19) select");
            $select.val("14");
            $select.find("option[value='2'], option[value='4'], option[value='1'], option[value='6'], option[value='7'], option[value='21'], option[value='28']").prop("disabled", true);
            var $select = tr.find("td:eq(18) select");
            $select.val("5");
            $select.find("option[value='1'], option[value='4'], option[value='7.5'], option[value='10']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_10_TO_14"){
            tr.find('td:eq(17) select').prop('disabled',true);
            tr.find('td:eq(17) select').css('cursor', 'not-allowed');
            checkPreg(preg);
            // if (select_preg == "Yes") {
            //     tr.find('td:eq(19) select').prop('disabled',true);
            //     tr.find('td:eq(19) select').css('cursor', 'not-allowed');
            // }else{
                var $select = tr.find("td:eq(19) select");
            $select.val("21");
            $select.find("option[value='2'], option[value='4'], option[value='1'], option[value='6'], option[value='14'], option[value='14'], option[value='28']").prop("disabled", true);
            // }
            var $select = tr.find("td:eq(18) select");
            $select.val("7.5");
            $select.find("option[value='1'], option[value='5'], option[value='4'], option[value='10']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_15_AND_ABOVE"){
            tr.find('td:eq(17) select').prop('disabled',true);
            tr.find('td:eq(17) select').css('cursor', 'not-allowed');
            checkPreg(preg);
            // if (select_preg == "Yes") {
            //     tr.find('td:eq(19) select').prop('disabled',true);
            //     tr.find('td:eq(19) select').css('cursor', 'not-allowed');
            // }else{
                var $select = tr.find("td:eq(19) select");
                $select.val("28");
                $select.find("option[value='2'], option[value='4'], option[value='1'], option[value='6'], option[value='14'], option[value='21'], option[value='7']").prop("disabled", true);
            // }
            var $select = tr.find("td:eq(18) select");
            $select.val("10");
            $select.find("option[value='1'], option[value='5'], option[value='7.5'], option[value='4']").prop("disabled", true);
        }else{

        }
    }else if(assum_result == "Mixed"){
        if(input_age == "AGE_GROUP_1"){
            tr.find('td:eq(18) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(18) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            // alert($select);
            $select.val("3");
            $select.find("option[value='24'], option[value='12'], option[value='18'], option[value='6']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_1_TO_4"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("6");
            $select.find("option[value='3'], option[value='12'], option[value='18'], option[value='24']").prop("disabled", true);
            var $select = tr.find("td:eq(19) select");
            $select.val("7");
            $select.find("option[value='1'], option[value='4'], option[value='6'], option[value='2'], option[value='14'], option[value='21'], option[value='28']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_5_TO_9"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("12");
            $select.find("option[value='3'], option[value='6'], option[value='18'], option[value='24']").prop("disabled", true);
            var $select = tr.find("td:eq(19) select");
            $select.val("14");
            $select.find("option[value='1'], option[value='4'], option[value='6'], option[value='7'], option[value='2'], option[value='21'], option[value='28']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_10_TO_14"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("18");
            $select.find("option[value='3'], option[value='6'], option[value='12'], option[value='24']").prop("disabled", true);
            checkPreg(preg);
            // if (select_preg == "Yes") {
            //     tr.find('td:eq(19) select').prop('disabled',true);
            //     tr.find('td:eq(19) select').css('cursor', 'not-allowed');
            // }else{
            var $select = tr.find("td:eq(19) select");
            $select.val("21");
            $select.find("option[value='1'], option[value='4'], option[value='6'], option[value='7'], option[value='14'], option[value='2'], option[value='28']").prop("disabled", true);
            // }
        }else if(input_age == "AGE_GROUP_15_AND_ABOVE"){
            tr.find('td:eq(18) select').prop('disabled',true);
            tr.find('td:eq(18) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(17) select");
            $select.val("24");
            $select.find("option[value='3'], option[value='6'], option[value='18'], option[value='12']").prop("disabled", true);
            checkPreg(preg);
            // if (select_preg == "Yes") {
            //     tr.find('td:eq(19) select').prop('disabled',true);
            //     tr.find('td:eq(19) select').css('cursor', 'not-allowed');
            // }else{
            var $select = tr.find("td:eq(19) select");
            $select.val("28");
            $select.find("option[value='1'], option[value='4'], option[value='6'], option[value='7'], option[value='14'], option[value='21'], option[value='2']").prop("disabled", true);
            // }
        }else{

        }
    }else if(assum_result == "Pm"){
        if(input_age == "AGE_GROUP_1"){
            tr.find('td:eq(17) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(17) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(18) select");
            $select.val("1");
            $select.find("option[value='10'], option[value='5'], option[value='7.5'], option[value='4']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_1_TO_4"){
            tr.find('td:eq(17) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(17) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(18) select");
            $select.val("4");
            $select.find("option[value='1'], option[value='5'], option[value='7.5'], option[value='10']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_5_TO_9"){
            tr.find('td:eq(17) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(17) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(18) select");
            $select.val("5");
            $select.find("option[value='1'], option[value='10'], option[value='7.5'], option[value='4']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_10_TO_14"){
            tr.find('td:eq(17) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(17) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(18) select");
            $select.val("7.5");
            $select.find("option[value='1'], option[value='5'], option[value='10'], option[value='4']").prop("disabled", true);
        }else if(input_age == "AGE_GROUP_15_AND_ABOVE"){
            tr.find('td:eq(17) select,td:eq(19) select').prop('disabled',true);
            tr.find('td:eq(17) select,td:eq(19) select').css('cursor', 'not-allowed');
            var $select = tr.find("td:eq(18) select");
            $select.val("10");
            $select.find("option[value='1'], option[value='5'], option[value='7.5'], option[value='4']").prop("disabled", true);
        }else{

        }
    }else{

    }

}




// checkRDTTest();
// checkTestResult(rcs);

// function checkRDTTest() {
//     var tr = $(rdt).closest('tr');
//     let select_check_rdt = tr.find('.rdt_test').val();
// alert('this idofioe',select_check_rdt);
// }




function checkCQvhv(row) {
    var td = $(row).closest("tr");
    var age = td.find("td:eq(3) input").val();
    var preg = td.find("td:eq(7) select").val();
    var rdt = td.find("td:eq(8) select").val();
    if (rdt == 2) {
        if (age < 1) {
            if (row.value > 1) {
                alert("ဆေးလုံးရေပိုပေးထားသည်။");
            }
        } else if (age >= 1 && age <= 4) {
            if (row.value > 4) {
                alert("ဆေးလုံးရေပိုပေးထားသည်။");
            }
        } else if (age >= 5 && age <= 9) {
            if (row.value > 5) {
                alert("ဆေးလုံးရေပိုပေးထားသည်။");
            }
        } else if (age >= 10 && age <= 14) {
            if (row.value > 7.5) {
                alert("ဆေးလုံးရေပိုပေးထားသည်။");
            }
        } else if (age >= 15) {
            if (row.value > 10) {
                alert("ဆေးလုံးရေပိုပေးထားသည်။");
            }
        }
    } else {
        if (row.value == 77 || row.value == 99) {
        } else {
            alert("ဖယ်လ်ဆီပရမ်(pf)လူနာတွင် 'CQ' မပေးပါ။");
        }
    }
}

function checkPQvhv(row) {
    var td = $(row).closest("tr");
    var age = td.find("td:eq(3) input").val();
    var preg = td.find("td:eq(7) select").val();
    if (age < 5 || preg == "1") {
        alert("အသက်(၁)နှစ်အောက်နှင့် ကိုယ်ဝန်ဆောင်လူနာများကို PQ မပေးပါ။");
    }
    //alert("Check Twice Given PQ to avoid under 1 year patient and pregnent patient");
}

function checkACTvhv(row) {
    var td = $(row).closest("tr");
    var rdt = td.find("td:eq(8) select").val();
    if (rdt == 2) {
        if (row.value > 0) {
            alert("No ACT at Pv/Non PF Patient");
        }
    }
}

function checkMpdeath(mmm) {
    var td = $(mmm).closest("tr");
    var rcs = td.find("td:eq(15) select").val();
    // console.log('rcs is myitzu :>> ',rcs.value);
    var rdt = td.find("td:eq(9) select").val();
    if (mmm.value == "1") {
        if (
            (rcs == "0" || rcs == "7" || rcs == "9") &&
            (rdt == "0" || rdt == "7" || rdt == "9")
        ) {
            alert("ငှက်ဖျားပိုးမရှိပါ။").on("hidden.bs.modal", function () {
                $(mmm).focus();
            });
        } else {
            alert("ငှက်ဖျားပိုးကြောင့်သေဆုံးခြင်းသေချာမှရွေးပါ").on(
                "hidden.bs.modal",
                () => {
                    $(mmm).focus();
                }
            );
        }
    }
}

function clickOnRow() {
    // alert("this is clickonrow");
    $(".rcs, .rdt").on("change", function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var tr = $(this).closest("tr");
        var rcs = this;
        var age = tr.find(".age").val();
        var sex = tr.find(".sex").val();
        var preg = tr.find(".preg").val();
        var rdt_value,
            rcs_value = "";
        if (this.className === "rcs") {
            rdt_value = tr.find(".rdt").val();
            rcs_value = this.value;
        } else {
            rdt_value = this.value;
            rcs_value = tr.find(".rcs").val();
        }
        var positive_value = [1, 2, 3, 4, 5];
        if (
            positive_value.indexOf(parseInt(rcs_value)) !== -1 ||
            positive_value.indexOf(parseInt(rdt_value)) !== -1
        ) {
            //positive patient
            tr.find(
                "td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select," +
                    " td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input"
            ).css("background", "#FFC8C8");
            tr.find("td:eq(10) select").prop("selectedIndex", 0);
            tr.find("td:eq(11) select").prop("selectedIndex", 0);
            tr.find("td:eq(12) input").val("");
            tr.find("td:eq(12) input").attr("placeholder", "ဆေးလုံးရေ");
            tr.find("td:eq(13) input").val("");
            tr.find("td:eq(13) input").attr("placeholder", "ဆေးလုံးရေ");
            tr.find("td:eq(14) select").prop("selectedIndex", 0);
            tr.find("td:eq(15) select").prop("selectedIndex", 0);
            tr.find("td:eq(16) select").prop("selectedIndex", 0);
            tr.find("td:eq(17) select").prop("selectedIndex", 0);
            tr.find("td:eq(18) select").prop("selectedIndex", 0);
            tr.find("td:eq(19) input").val("N/A");
        } else {
            //negative patient
            if (rcs_value == 7 && rdt_value == 7) {
                alert("Please Fill at least one exam result.").on(
                    "hidden.bs.modal",
                    function () {
                        // $(rcs).focus();
                        $(rcs).val("");
                    }
                );
            } else {
                tr.find(
                    "td:eq(10) select, td:eq(11) select, td:eq(12) input, td:eq(13) input, td:eq(14) select," +
                        " td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) select, td:eq(19) input"
                ).css("background", "");
                tr.find("td:eq(10) select").val("7").trigger("change"); //IO CAT
                tr.find("td:eq(11) select").val("7").trigger("change"); //ACT
                tr.find("td:eq(12) input").val("77"); //CQ
                tr.find("td:eq(13) input").val("77"); //PQ
                tr.find("td:eq(14) select").val("7").trigger("change"); //Referral
                tr.find("td:eq(15) select").val("7").trigger("change"); //MMD
                tr.find("td:eq(16) select").val("77").trigger("change"); //TG
                tr.find("td:eq(17) select").val("7").trigger("change"); //Travel Log
                tr.find("td:eq(18) select").val("7").trigger("change"); //Occupation
                tr.find("td:eq(19) input").val("N/A"); //Remark
            }
        }
    });
    $(".act").on("change", function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var tr = $(this).closest("tr");
        var act = this;
        var age = tr.find(".age").val();
        var rdt_value = tr.find(".rdt").val();
        var rcs_value = tr.find(".rcs").val();
        var positive_value = [1, 2, 3, 4, 5];
        switch (this.value) {
            case "0":
                if (
                    (positive_value.indexOf(parseInt(rcs_value)) === 0 ||
                        positive_value.indexOf(parseInt(rcs_value)) === 2) &&
                    (positive_value.indexOf(parseInt(rdt_value)) === 0 ||
                        positive_value.indexOf(parseInt(rdt_value)) === 2)
                ) {
                    alert("Pf or Mix Infection လူနာတွင် ACT ဆေးပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                }
                break;
            case "1":
                if (
                    !(
                        positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1
                    )
                ) {
                    alert("ငှက်ဖျားပိုးမရှိပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (
                    positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                    positive_value.indexOf(parseInt(rcs_value)) === 1
                ) {
                    bootbox
                        .alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။")
                        .on("hidden.bs.modal", function () {
                            $(act).focus();
                        });
                } else if (parseInt(age) < 1) {
                    alert("အသက်တစ်နှစ်အောက်တွင်သုံးလုံးသာပေးသည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                }
                break;
            case "2":
                if (
                    !(
                        positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1
                    )
                ) {
                    alert("ငှက်ဖျားပိုးမရှိပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (
                    positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                    positive_value.indexOf(parseInt(rcs_value)) === 1
                ) {
                    alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (parseInt(age) >= 1 && parseInt(age) <= 4) {
                    alert("အသက်တစ်နှစ်နှင့်လေးနှစ်တွင်ခြောက်လုံးသာပေးသည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                }
                break;
            case "3":
                if (
                    !(
                        positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1
                    )
                ) {
                    alert("ငှက်ဖျားပိုးမရှိပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (
                    positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                    positive_value.indexOf(parseInt(rcs_value)) === 1
                ) {
                    alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (parseInt(age) >= 5 && parseInt(age) <= 9) {
                    bootbox
                        .alert(
                            "အသက်ငါးနှစ်နှင့်ကိုးနှစ်တွင်ဆယ့်နှစ်လုံးသာပေးသည်။"
                        )
                        .on("hidden.bs.modal", function () {
                            $(act).focus();
                        });
                }
                break;
            case "4":
                if (
                    !(
                        positive_value.indexOf(parseInt(rdt_value)) !== -1 ||
                        positive_value.indexOf(parseInt(rcs_value)) !== -1
                    )
                ) {
                    alert("ငှက်ဖျားပိုးမရှိပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (
                    positive_value.indexOf(parseInt(rdt_value)) === 1 ||
                    positive_value.indexOf(parseInt(rcs_value)) === 1
                ) {
                    alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။").on(
                        "hidden.bs.modal",
                        function () {
                            $(act).focus();
                        }
                    );
                } else if (parseInt(age) >= 10 && parseInt(age) <= 14) {
                    alert(
                        "အသက်ဆယ်နှစ်နှင့်ဆယ့်လေးနှစ်တွင်ဆယ့်ရှစ်လုံးသာပေးသည်။"
                    ).on("hidden.bs.modal", function () {
                        $(act).focus();
                    });
                }
                break;
        }
    });
    $(".cq, .pq").on("change", function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var tr = $(this).closest("tr");
        var cqpq = this;
        var age = tr.find(".age").val();
        var preg = tr.find(".preg").val();
        var rdt_value = tr.find(".rdt").val();
        var rcs_value = tr.find(".rcs").val();
        var positive_value = [1, 2, 3, 4, 5];
        if (this.className === "cq only-integer") {
            //console.log(this.className);
            var cq = this.value;
            if (parseInt(cq) > 50) {
                if (parseInt(cq) != 77 && parseInt(cq) != 99) {
                    alert(
                        "ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77 or Missing for 99)"
                    ).on("hidden.bs.modal", function () {
                        $(cqpq).focus();
                    });
                } else if (
                    (parseInt(cq) == 0 ||
                        parseInt(cq) == 77 ||
                        parseInt(cq) == 99) &&
                    (parseInt(rcs_value) == 2 || parseInt(rdt_value) == 2)
                ) {
                    alert("Pv ပိုးတွေ့လျှင် CQ ပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(cqpq).focus();
                        }
                    );
                }
            } else {
                if (
                    parseInt(rcs_value) == 1 ||
                    parseInt(rdt_value) == 1 ||
                    parseInt(rcs_value) == 3 ||
                    parseInt(rdt_value) == 3
                ) {
                    alert(
                        "Pf ပိုးတွင် CQ မပေးပါ။(N/A for 77 or Missing for 99)"
                    ).on("hidden.bs.modal", function () {
                        $(cqpq).focus();
                    });
                }
                if (
                    parseInt(cq) == 0 &&
                    (parseInt(rcs_value) == 2 || parseInt(rdt_value) == 2)
                ) {
                    alert("Pv ပိုးတွေ့လျှင် CQ ပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(cqpq).focus();
                        }
                    );
                }
            }
        }
        if (this.className === "pq only-integer") {
            var pq = this.value;
            if (parseInt(pq) > 50) {
                if (parseInt(pq) != 77 && parseInt(pq) != 99) {
                    alert(
                        "ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77 or Missing for 99)"
                    ).on("hidden.bs.modal", function () {
                        $(cqpq).focus();
                    });
                } else if (
                    (positive_value.indexOf(parseInt(rcs_value)) != -1 ||
                        positive_value.indexOf(parseInt(rdt_value)) != -1) &&
                    (parseInt(pq) == 0 ||
                        parseInt(pq) == 77 ||
                        parseInt(pq) == 99)
                ) {
                    alert("Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(cqpq).focus();
                        }
                    );
                }
            } else {
                if (parseInt(age) < 1 || parseInt(preg) == 1) {
                    alert(
                        "အသက်(၁)နှစ်အောက်နှင့်ကိုယ်ဝန်ဆောင်များကို PQ မပေးပါ။(N/A for 77 or Missing for 99)"
                    ).on("hidden.bs.modal", function () {
                        $(cqpq).focus();
                    });
                }
                if (
                    (positive_value.indexOf(parseInt(rcs_value)) != -1 ||
                        positive_value.indexOf(parseInt(rdt_value)) != -1) &&
                    parseInt(pq) == 0
                ) {
                    alert("Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(cqpq).focus();
                        }
                    );
                }
            }
        }
    });
    $(".rdtvhv").on("change", function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var rdtvhv = this;
        var tr = $(this).closest("tr");
        var positive_value = [1, 2, 3];
        if (positive_value.indexOf(parseInt(this.value)) !== -1) {
            tr.find(
                "td:eq(9) select, td:eq(10) select, td:eq(11) input, td:eq(12) input, td:eq(13) select, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) input"
            ).css("background", "#FFC8C8");
            tr.find("td:eq(9) select").val("").trigger("change"); //IO CAT
            tr.find("td:eq(10) select").val("").trigger("change"); //ACT
            tr.find("td:eq(11) input").val("").attr("placeholder", "ဆေးလုံးရေ"); //CQ
            tr.find("td:eq(12) input").val("").attr("placeholder", "ဆေးလုံးရေ"); //PQ
            tr.find("td:eq(13) select").val("").trigger("change"); //Referral
            tr.find("td:eq(14) select").val("").trigger("change"); //MMD
            tr.find("td:eq(15) select").val("").trigger("change"); //TG
            tr.find("td:eq(16) select").val("").trigger("change"); //Travel Log
            tr.find("td:eq(17) select").val("").trigger("change"); //Occupation
            tr.find("td:eq(18) input").val("N/A"); //Remark
        } else {
            if (parseInt(this.value) === 7) {
                alert("ငှက်ဖျားပိုးစစ်ပေးပါ။").on(
                    "hidden.bs.modal",
                    function () {
                        // $(rdtvhv).focus();
                        $(rdtvhv).val("");
                    }
                );
            } else {
                tr.find(
                    "td:eq(9) select, td:eq(10) select, td:eq(11) input, td:eq(12) input, td:eq(13) select, td:eq(14) select, td:eq(15) select, td:eq(16) select, td:eq(17) select, td:eq(18) input"
                ).css("background", "");
                tr.find("td:eq(9) select").val("7").trigger("change"); //IO patient
                tr.find("td:eq(10) select").val("7").trigger("change"); //ACT
                tr.find("td:eq(11) input").val("77"); //CQ
                tr.find("td:eq(12) input").val("77"); //PQ
                tr.find("td:eq(13) select").val("7").trigger("change"); //Referral
                tr.find("td:eq(14) select").val("7").trigger("change"); //MMD
                tr.find("td:eq(15) select").val("77").trigger("change"); //TG
                tr.find("td:eq(16) select").val("7").trigger("change"); //Travel Log
                tr.find("td:eq(17) select").val("7").trigger("change"); //Occupation
                tr.find("td:eq(18) input").val("N/A"); //Remark
            }
        }
    });
    $(".actvhv").on("change", function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var tr = $(this).closest("tr");
        var actvhv = this;
        var age = tr.find(".agevhv").val();
        var rdt_value = tr.find(".rdtvhv").val();
        var positive_value = [1, 2, 3, 4, 5];
        switch (this.value) {
            case "0":
                if (
                    positive_value.indexOf(parseInt(rdt_value)) === 0 ||
                    positive_value.indexOf(parseInt(rdt_value)) === 2
                ) {
                    bootbox
                        .alert("Pf or Mix Infection လူနာတွင် ACT ဆေးပေးရမည်။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                }
                break;
            case "1":
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox
                        .alert("ငှက်ဖျားပိုးမရှိပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (positive_value.indexOf(parseInt(rdt_value)) === 1) {
                    bootbox
                        .alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (parseInt(age) < 1) {
                    bootbox
                        .alert("အသက်(၁)နှစ်မှ(၄)နှစ်တွင်သာ Coartem - 6 ပေးသည်။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                }
                break;
            case "2":
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox
                        .alert("ငှက်ဖျားပိုးမရှိပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (positive_value.indexOf(parseInt(rdt_value)) === 1) {
                    bootbox
                        .alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (parseInt(age) < 5) {
                    bootbox
                        .alert(
                            "အသက်(၅)နှစ်မှ(၉)နှစ်တွင်သာ Coartem - 12 ပေးသည်။။"
                        )
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                }
                break;
            case "3":
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox
                        .alert("ငှက်ဖျားပိုးမရှိပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (positive_value.indexOf(parseInt(rdt_value)) === 1) {
                    bootbox
                        .alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (parseInt(age) < 10) {
                    bootbox
                        .alert(
                            "အသက်(၁၀)နှစ်မှ(၁၄)နှစ်တွင်သာ Coartem - 18 ပေးသည်။"
                        )
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                }
                break;
            case "4":
                if (!(positive_value.indexOf(parseInt(rdt_value)) !== -1)) {
                    bootbox
                        .alert("ငှက်ဖျားပိုးမရှိပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (positive_value.indexOf(parseInt(rdt_value)) === 1) {
                    bootbox
                        .alert("Pv/Non Pf ပိုးတွင်ဖယ်လ်ဆီပရမ်မပေးပါ။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                } else if (parseInt(age) < 15) {
                    bootbox
                        .alert("အသက်(၁၅)နှင့်အထက်တွင်သာ Coartem - 24 ပေးသည်။")
                        .on("hidden.bs.modal", function () {
                            $(actvhv).focus();
                        });
                }
                break;
        }
    });
    $(".cqvhv, .pqvhv").on("change", function (e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        var tr = $(this).closest("tr");
        var cqvhv = this;
        var age = tr.find(".agevhv").val();
        var preg = tr.find(".pregvhv").val();
        var rdt_value = tr.find(".rdtvhv").val();
        var rcs_value = tr.find(".rcsvhv").val();
        if (this.className === "cqvhv only-integer") {
            var cq = this.value;
            if (parseInt(cq) > 50) {
                if (parseInt(cq) != 77 && parseInt(cq) != 99) {
                    bootbox
                        .alert(
                            "ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77 or Missing for 99)"
                        )
                        .on("hidden.bs.modal", function () {
                            $(cqvhv).focus();
                        });
                } else if (
                    (parseInt(cq) == 0 ||
                        parseInt(cq) == 77 ||
                        parseInt(cq) == 99) &&
                    (parseInt(rcs_value) == 2 || parseInt(rdt_value) == 2)
                ) {
                    bootbox
                        .alert("Pv ပိုးတွေ့လျှင် CQ ပေးရမည်။")
                        .on("hidden.bs.modal", function () {
                            $(cqpq).focus();
                        });
                }
            } else {
                if (parseInt(rcs_value) == 1 || parseInt(rdt_value) == 1) {
                    bootbox
                        .alert("Pf ပိုးတွင် CQ မပေးပါ။")
                        .on("hidden.bs.modal", function () {
                            $(cqvhv).focus();
                        });
                }
            }
        }
        if (this.className === "pqvhv only-integer") {
            var pq = this.value;
            if (parseInt(pq) > 50) {
                if (parseInt(pq) != 77 && parseInt(pq) != 99) {
                    alert(
                        "ဆေးလုံးရေ ၅၀ ထပ်ပိုမပေးသင့်ပါ။(N/A for 77 or Missing for 99)"
                    ).on("hidden.bs.modal", function () {
                        $(cqvhv).focus();
                    });
                } else if (
                    (positive_value.indexOf(parseInt(rcs_value)) != -1 ||
                        positive_value.indexOf(parseInt(rdt_value)) != -1) &&
                    (parseInt(pq) == 0 ||
                        parseInt(pq) == 77 ||
                        parseInt(pq) == 99)
                ) {
                    alert("Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(cqpq).focus();
                        }
                    );
                }
            } else {
                if (parseInt(age) < 1 || parseInt(preg) == 1) {
                    alert(
                        "အသက်(၁)နှစ်အောက်နှင့်ကိုယ်ဝန်ဆောင်များကို PQ မပေးပါ။"
                    ).on("hidden.bs.modal", function () {
                        $(cqvhv).focus();
                    });
                }
                if (
                    (positive_value.indexOf(parseInt(rcs_value)) != -1 ||
                        positive_value.indexOf(parseInt(rdt_value)) != -1) &&
                    parseInt(pq) == 0
                ) {
                    alert("Pf/Pv/Mix ပိုးအားလုံးတွင် PQ ပေးရမည်။").on(
                        "hidden.bs.modal",
                        function () {
                            $(cqpq).focus();
                        }
                    );
                }
            }
        }
    });
}
